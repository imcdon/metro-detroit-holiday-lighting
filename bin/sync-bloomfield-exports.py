"""Copy Bloomfield exports from assets/img/Untitled Export/ into masters, then optimize gallery.

Naming in Untitled Export:
  - Direct: mdhl-bloomfield-hills-7.jpg … 11.jpg → same slot in masters/
  - Legacy drop names: 1→7, 2→8, 3→9, 4→11
"""
from __future__ import annotations

import re
import subprocess
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
EXPORT = ROOT / "assets" / "img" / "Untitled Export"
MASTERS = ROOT / "assets" / "img" / "masters" / "bloomfield-hills"
GALLERY = ROOT / "assets" / "img" / "gallery"
SLOTS = frozenset({"7", "8", "9", "11"})
LEGACY = {"1": "7", "2": "8", "3": "9", "4": "11"}
PATTERN = re.compile(r"^mdhl-bloomfield-hills-(\d+)\.jpg$", re.I)


def main() -> None:
    if not EXPORT.is_dir():
        raise SystemExit(f"export folder missing: {EXPORT}")
    MASTERS.mkdir(parents=True, exist_ok=True)

    copies: list[tuple[Path, Path]] = []
    direct_slots: set[str] = set()

    for src in sorted(EXPORT.glob("mdhl-bloomfield-hills-*.jpg")):
        m = PATTERN.match(src.name)
        if not m:
            continue
        num = m.group(1)
        if num in SLOTS:
            direct_slots.add(num)
            dst = MASTERS / src.name
            copies.append((src, dst))

    for src in sorted(EXPORT.glob("mdhl-bloomfield-hills-*.jpg")):
        m = PATTERN.match(src.name)
        if not m:
            continue
        num = m.group(1)
        target = LEGACY.get(num)
        if target is None:
            continue
        if target in direct_slots:
            continue
        dst = MASTERS / f"mdhl-bloomfield-hills-{target}.jpg"
        copies.append((src, dst))

    if not copies:
        print(f"No exports found in {EXPORT}")
        return

    # Dedupe by destination; direct slot files are collected before legacy aliases.
    by_dst: dict[Path, Path] = {}
    for src, dst in copies:
        by_dst[dst] = src

    for dst, src in sorted(by_dst.items(), key=lambda x: x[0].name):
        dst.write_bytes(src.read_bytes())
        print(f"{src.name} -> masters/{dst.name}")

    for n in ("1", "2", "3", "4"):
        stray = GALLERY / f"mdhl-bloomfield-hills-{n}.jpg"
        if stray.is_file():
            stray.unlink()
            print(f"removed gallery/{stray.name}")

    opt = ROOT / "bin" / "optimize-mdhl-gallery.py"
    subprocess.check_call([sys.executable, str(opt)], cwd=ROOT)


if __name__ == "__main__":
    main()