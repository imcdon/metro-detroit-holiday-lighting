# Metro Detroit Holiday Lighting

Custom PHP marketing site for [metrodetroitholidaylighting.com](https://metrodetroitholidaylighting.com). Built by Webstar Business Services.

## Local (XAMPP)

`http://localhost/webstar-business-solutions/clients/metro-detroit-holiday-lighting/`

## Photo workflow

Drop full-resolution exports into `assets/img/Untitled Export/`, then sync into gitignored masters and web-ready gallery JPEGs + WebP variants:

```bash
# Bloomfield Hills
python bin/sync-bloomfield-exports.py

# Ranch Estates
python bin/sync-ranch-exports.py

# Rebuild WebP width ladder from existing gallery JPEGs
python bin/optimize-mdhl-gallery.py --variants-only

php bin/check-missing-images.php
```

Serve paths always point at `assets/img/gallery/` (never `Untitled Export/`). Templates use `mdhl_picture()` for responsive WebP + JPEG fallback.

## Git (canonical)

This folder is its own repository. **Do not** commit site changes to `imcdon/webstar`.

```bash
git status
git commit -m "Describe change"
git push origin main
```

## Live (Reclaim cPanel)

1. Git Version Control → clone `https://github.com/imcdon/metro-detroit-holiday-lighting.git` to `$HOME/repositories/metro-detroit-holiday-lighting` (not `public_html`).
2. **Update from Remote** → **Deploy HEAD Commit** (runs [`.cpanel.yml`](.cpanel.yml) → `$HOME/public_html`).
4. Once on server: copy `includes/mail-config.example.php` → `includes/mail-config.php` and set SMTP (see [DEPLOY.md](DEPLOY.md)).

## Staging (Webstar)

Optional preview: rsync or copy deploy into `webstarbusinessservices.com` `public_html/clients/metro-detroit-holiday-lighting/`. HTTP Basic uses Client Portal credentials (`includes/staging-users.php`).

See [DEPLOY.md](DEPLOY.md) for full checklists.