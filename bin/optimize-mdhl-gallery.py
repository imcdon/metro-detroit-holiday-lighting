"""Generate web-ready gallery JPEGs + WebP width variants from masters (re-run anytime).

Usage:
  python bin/optimize-mdhl-gallery.py
  python bin/optimize-mdhl-gallery.py --project bloomfield-hills
  python bin/optimize-mdhl-gallery.py --project ranch-estates
  python bin/optimize-mdhl-gallery.py --project all
  python bin/optimize-mdhl-gallery.py --variants-only   # rebuild WebP + manifest from gallery JPEGs
"""
from __future__ import annotations

import argparse
import json
import re
from pathlib import Path

from PIL import Image, ImageOps

ROOT = Path(__file__).resolve().parents[1]
GALLERY = ROOT / "assets" / "img" / "gallery"
MANIFEST_PATH = GALLERY / ".variants-manifest.json"

# Tune here; masters are never overwritten.
JPEG_QUALITY = 90
WEBP_QUALITY = 82
TIER_A_LONG_EDGE = 2400  # landing heroes + key section photos
TIER_B_LONG_EDGE = 2000  # gallery index shots
VARIANT_WIDTHS = (800, 1280, 1600)

PROJECTS: dict[str, dict] = {
    "bloomfield-hills": {
        "masters": ROOT / "assets" / "img" / "masters" / "bloomfield-hills",
        "glob": "mdhl-bloomfield-hills-*.jpg",
        "tier_a": frozenset({"1", "4", "5", "6", "7", "8", "9", "11", "12"}),
    },
    "ranch-estates": {
        "masters": ROOT / "assets" / "img" / "masters" / "ranch-estates",
        "glob": "mdhl-ranch-estates-*.jpg",
        "tier_a": frozenset({"1", "8", "9", "11", "14"}),
    },
}

STEM_NUM = re.compile(r"-(\d+)$")


def resize_long_edge(im: Image.Image, long_edge: int) -> Image.Image:
    w, h = im.size
    if max(w, h) <= long_edge:
        return im.copy()
    if w >= h:
        nw = long_edge
        nh = max(1, round(h * long_edge / w))
    else:
        nh = long_edge
        nw = max(1, round(w * long_edge / h))
    return im.resize((nw, nh), Image.Resampling.LANCZOS)


def resize_width(im: Image.Image, width: int) -> Image.Image:
    w, h = im.size
    if w <= width:
        return im.copy()
    nh = max(1, round(h * width / w))
    return im.resize((width, nh), Image.Resampling.LANCZOS)


def tier_for_name(name: str, tier_a: frozenset[str]) -> int:
    stem = Path(name).stem
    m = STEM_NUM.search(stem)
    num = m.group(1) if m else ""
    return TIER_A_LONG_EDGE if num in tier_a else TIER_B_LONG_EDGE


def export_jpeg(src: Path, dst: Path, long_edge: int) -> Image.Image:
    im = Image.open(src)
    im = ImageOps.exif_transpose(im)
    im = im.convert("RGB")
    out = resize_long_edge(im, long_edge)
    dst.parent.mkdir(parents=True, exist_ok=True)
    out.save(
        dst,
        "JPEG",
        quality=JPEG_QUALITY,
        optimize=True,
        progressive=True,
    )
    kb = dst.stat().st_size / 1024
    print(f"{src.name} -> {dst.name}: {out.size[0]}x{out.size[1]}, {kb:.1f} KB JPEG")
    return out


def write_webp_variants(im: Image.Image, stem: str) -> list[dict]:
    """Write WebP files for each width <= image width. Returns variant metadata."""
    variants: list[dict] = []
    w, h = im.size
    for width in VARIANT_WIDTHS:
        if width > w:
            continue
        resized = resize_width(im, width)
        out_name = f"{stem}-{width}w.webp"
        out_path = GALLERY / out_name
        resized.save(out_path, "WEBP", quality=WEBP_QUALITY, method=4)
        kb = out_path.stat().st_size / 1024
        print(f"  -> {out_name}: {resized.size[0]}x{resized.size[1]}, {kb:.1f} KB WebP")
        variants.append(
            {
                "width": resized.size[0],
                "height": resized.size[1],
                "file": out_name,
                "format": "webp",
            }
        )
    # Always emit a WebP at the full JPEG width if no ladder width matched exactly.
    if not variants or variants[-1]["width"] < w:
        out_name = f"{stem}-{w}w.webp"
        out_path = GALLERY / out_name
        im.save(out_path, "WEBP", quality=WEBP_QUALITY, method=4)
        kb = out_path.stat().st_size / 1024
        print(f"  -> {out_name}: {w}x{h}, {kb:.1f} KB WebP (full)")
        variants.append(
            {
                "width": w,
                "height": h,
                "file": out_name,
                "format": "webp",
            }
        )
    return variants


def load_manifest() -> dict:
    if MANIFEST_PATH.is_file():
        try:
            return json.loads(MANIFEST_PATH.read_text(encoding="utf-8"))
        except json.JSONDecodeError:
            return {}
    return {}


def save_manifest(data: dict) -> None:
    GALLERY.mkdir(parents=True, exist_ok=True)
    MANIFEST_PATH.write_text(
        json.dumps(data, indent=2, sort_keys=True) + "\n",
        encoding="utf-8",
    )
    print(f"Wrote {MANIFEST_PATH.relative_to(ROOT)}")


def process_project(project: str) -> int:
    cfg = PROJECTS[project]
    masters: Path = cfg["masters"]
    if not masters.is_dir():
        print(f"masters folder missing (skip): {masters}")
        return 0

    sources = sorted(masters.glob(cfg["glob"]))
    if not sources:
        print(f"no masters matching {cfg['glob']} in {masters}")
        return 0

    manifest = load_manifest()
    for src in sources:
        long_edge = tier_for_name(src.name, cfg["tier_a"])
        dst = GALLERY / src.name
        out = export_jpeg(src, dst, long_edge)
        stem = Path(src.name).stem
        variants = write_webp_variants(out, stem)
        manifest[src.name] = {
            "width": out.size[0],
            "height": out.size[1],
            "jpeg": src.name,
            "variants": variants,
        }

    save_manifest(manifest)
    print(
        f"Done {project}: {len(sources)} files (Q{JPEG_QUALITY}, "
        f"A={TIER_A_LONG_EDGE}px, B={TIER_B_LONG_EDGE}px, WebP Q{WEBP_QUALITY})"
    )
    return len(sources)


def variants_from_gallery() -> int:
    """Rebuild WebP variants + manifest from existing gallery JPEGs (both shoots + others)."""
    jpegs = sorted(
        p
        for p in GALLERY.glob("*.jpg")
        if not re.search(r"-\d+w\.jpg$", p.name, re.I)
    )
    if not jpegs:
        print(f"no gallery JPEGs in {GALLERY}")
        return 0

    manifest = load_manifest()
    count = 0
    for src in jpegs:
        im = Image.open(src)
        im = ImageOps.exif_transpose(im)
        im = im.convert("RGB")
        stem = src.stem
        variants = write_webp_variants(im, stem)
        manifest[src.name] = {
            "width": im.size[0],
            "height": im.size[1],
            "jpeg": src.name,
            "variants": variants,
        }
        count += 1
        print(f"{src.name}: variants ok")

    save_manifest(manifest)
    print(f"Done variants-only: {count} gallery JPEGs")
    return count


def main() -> None:
    parser = argparse.ArgumentParser(description="Optimize MDHL gallery images")
    parser.add_argument(
        "--project",
        choices=["bloomfield-hills", "ranch-estates", "all"],
        default="all",
        help="Which masters folder to export (default: all)",
    )
    parser.add_argument(
        "--variants-only",
        action="store_true",
        help="Skip masters; rebuild WebP variants from gallery JPEGs",
    )
    args = parser.parse_args()

    if args.variants_only:
        variants_from_gallery()
        return

    projects = list(PROJECTS) if args.project == "all" else [args.project]
    total = 0
    for project in projects:
        total += process_project(project)
    if total == 0:
        raise SystemExit("No files processed")


if __name__ == "__main__":
    main()
