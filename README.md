# Metro Detroit Holiday Lighting

Custom PHP marketing site for [metrodetroitholidaylighting.com](https://metrodetroitholidaylighting.com). Built by Webstar Business Services.

## Local (XAMPP)

`http://localhost/webstar-business-solutions/clients/metro-detroit-holiday-lighting/`

## Git (canonical)

This folder is its own repository. **Do not** commit site changes to `imcdon/webstar`.

```bash
git status
git commit -m "Describe change"
git push origin main
```

## Live (Reclaim cPanel)

1. Git Version Control → clone this repo to `$HOME/repositories/metro-detroit-holiday-lighting` (not `public_html`).
2. Add a **read-only deploy key** in GitHub → Settings → Deploy keys.
3. **Update from Remote** → **Deploy HEAD Commit** (runs [`.cpanel.yml`](.cpanel.yml) → `$HOME/public_html`).
4. Once on server: copy `includes/mail-config.example.php` → `includes/mail-config.php` and set SMTP (see [DEPLOY.md](DEPLOY.md)).

## Staging (Webstar)

Optional preview: rsync or copy deploy into `webstarbusinessservices.com` `public_html/clients/metro-detroit-holiday-lighting/`. HTTP Basic uses Client Portal credentials (`includes/staging-users.php`).

See [DEPLOY.md](DEPLOY.md) for full checklists.