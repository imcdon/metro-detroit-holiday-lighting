"""Copy Ranch Estates exports from assets/img/Untitled Export/ into masters, then optimize gallery.

Naming: mdhl-ranch-estates-1.jpg … 15.jpg → same name in masters/ranch-estates/
"""
from __future__ import annotations

import re
import subprocess
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
EXPORT = ROOT / "assets" / "img" / "Untitled Export"
MASTERS = ROOT / "assets" / "img" / "masters" / "ranch-estates"
PATTERN = re.compile(r"^mdhl-ranch-estates-(\d+)\.jpg$", re.I)


def main() -> None:
    if not EXPORT.is_dir():
        raise SystemExit(f"export folder missing: {EXPORT}")
    MASTERS.mkdir(parents=True, exist_ok=True)

    copies: list[tuple[Path, Path]] = []
    for src in sorted(EXPORT.glob("mdhl-ranch-estates-*.jpg")):
        if not PATTERN.match(src.name):
            continue
        copies.append((src, MASTERS / src.name))

    if not copies:
        print(f"No ranch exports found in {EXPORT}")
        return

    for src, dst in copies:
        dst.write_bytes(src.read_bytes())
        print(f"{src.name} -> masters/ranch-estates/{dst.name}")

    opt = ROOT / "bin" / "optimize-mdhl-gallery.py"
    subprocess.check_call(
        [sys.executable, str(opt), "--project", "ranch-estates"],
        cwd=ROOT,
    )


if __name__ == "__main__":
    main()
