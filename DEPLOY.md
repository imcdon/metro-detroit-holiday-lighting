# Metro Detroit Holiday Lighting — deploy

| Environment | URL |
|-------------|-----|
| **Local** | `http://localhost/webstar-business-solutions/clients/metro-detroit-holiday-lighting/` |
| **Staging** | `https://webstarbusinessservices.com/clients/metro-detroit-holiday-lighting/` (HTTP Basic; optional rsync from this repo) |
| **Live** | `https://metrodetroitholidaylighting.com` |

**Source of truth:** standalone GitHub repo (this directory). Do **not** push MDHL changes to `imcdon/webstar`.

**Gate:** On for `*.webstarbusinessservices.com`; off on localhost and `metrodetroitholidaylighting.com`.

## Live deploy (Reclaim cPanel)

**Server IP (GoDaddy A record):** `138.197.163.92`

1. cPanel → **Git Version Control** → **Create/Clone**.
2. **Clone URL:** `git@github.com:imcdon/metro-detroit-holiday-lighting.git` (or HTTPS).
3. **Repository path:** `/home/YOURUSER/repositories/metro-detroit-holiday-lighting` — **not** `public_html`.
4. GitHub → repo **Deploy keys** → paste cPanel’s public key (read-only).
5. **Update from Remote** → **Deploy HEAD Commit** (runs [`.cpanel.yml`](.cpanel.yml)).
6. Remove leftover **WordPress** files in `public_html` if rsync did not overwrite everything (`wp-content`, etc.).
7. **SSL:** AutoSSL after DNS is pointed at Reclaim.
8. **Mail (one-time, server only):** copy [`includes/mail-config.example.php`](includes/mail-config.example.php) to `includes/mail-config.php` on the server; create `noreply@metrodetroitholidaylighting.com` in cPanel if using SMTP. Otherwise the form falls back to PHP `mail()`.

### Each update

```text
git push origin main
```

Then cPanel → Git → **Update from Remote** → **Deploy HEAD Commit**.

## Staging on Webstar (optional)

Deploy is **not** tied to the webstar monorepo. To refresh staging, rsync this repo to  
`$HOME/public_html/clients/metro-detroit-holiday-lighting/` on the Webstar host, or clone this repo into that path and deploy there.

Portal **Open preview** still uses the `/clients/...` URL. Credentials: Client Portal users in `includes/staging-users.php`.

## Strategy docs

- [docs/COMPETITOR-ANALYSIS.md](docs/COMPETITOR-ANALYSIS.md)
- [docs/CLIENT-INPUTS.md](docs/CLIENT-INPUTS.md)
- [docs/GBP-AND-LIVE-PARITY.md](docs/GBP-AND-LIVE-PARITY.md)

## Contact form

Delivers to `metrodetroitholidaylighting@gmail.com`. SMTP via `includes/mail-config.php` when present; else `mail()`.

## Photos / testimonials

Gallery: drop images in `assets/img/gallery/`. Testimonials: [`docs/CLIENT-INPUTS.md`](docs/CLIENT-INPUTS.md) → `$testimonials` in `includes/config.php`.