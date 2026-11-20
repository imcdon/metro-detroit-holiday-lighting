"""Generate web-ready Bloomfield gallery JPEGs from masters (re-run anytime)."""
from __future__ import annotations

from pathlib import Path

from PIL import Image, ImageOps

ROOT = Path(__file__).resolve().parents[1]
MASTERS = ROOT / "assets" / "img" / "masters" / "bloomfield-hills"
GALLERY = ROOT / "assets" / "img" / "gallery"

# Tune here; masters are never overwritten.
JPEG_QUALITY = 90
TIER_A_LONG_EDGE = 2400  # landing heroes + key section photos
TIER_B_LONG_EDGE = 2000  # gallery index shots
TIER_A = frozenset({"1", "4", "5", "6", "7", "8", "9", "11", "12"})


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


def tier_for_name(name: str) -> int:
    stem = Path(name).stem
    num = stem.rsplit("-", 1)[-1]
    return TIER_A_LONG_EDGE if num in TIER_A else TIER_B_LONG_EDGE


def export_one(src: Path, dst: Path) -> None:
    im = Image.open(src)
    im = ImageOps.exif_transpose(im)
    im = im.convert("RGB")
    long_edge = tier_for_name(src.name)
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
    print(f"{src.name} -> {dst.name}: {out.size[0]}x{out.size[1]}, {kb:.1f} KB")


def main() -> None:
    if not MASTERS.is_dir():
        raise SystemExit(f"masters folder missing: {MASTERS}")

    sources = sorted(MASTERS.glob("mdhl-bloomfield-hills-*.jpg"))
    if not sources:
        raise SystemExit(f"no masters in {MASTERS}")

    for src in sources:
        dst = GALLERY / src.name
        export_one(src, dst)

    print(
        f"Done: {len(sources)} files (Q{JPEG_QUALITY}, "
        f"A={TIER_A_LONG_EDGE}px, B={TIER_B_LONG_EDGE}px)"
    )


if __name__ == "__main__":
    main()