# Changelog

All notable changes to Retro Hacker Terminal. Versions are incremental per delivered revision.

## 1.9.0 - 2026-11-10
- New custom 404 page: a terminal window plays a fake "intrusion" (port scan, path bruteforce, payload injection) that ends in `ACCESS_DENIED :: 404`, with a glitching 404 title, replay button and search form.
- The simulation is vanilla JavaScript (`assets/js/404.js`, loaded only on 404 pages), prints fake text only, makes no network requests, escapes the requested path, and respects `prefers-reduced-motion`.
- Responsive down to 320px.

## 1.8.0 - 2026-11-10
- Made the theme generic for any WordPress site: the default sidebar counter now counts all published posts ("POST_LOG") instead of a hard-coded "defacement" category.
- New Customizer section **Terminal Counter**: set the counter title and an optional category slug to count.
- Removed the site-specific REST route (`deepquest/v1/defacement-count`) and the hard-coded "EDU_USE_ONLY" footer text (now shows HTTP/HTTPS).
- Header status shows `CONN_SECURE` only on HTTPS (otherwise `CONN_OPEN`).
- Removed site-specific strings from the typing prompt and code-block label.

## 1.7.0 - 2026-11-10
- Renamed the theme from "DeepQuest Terminal" to "Retro Hacker Terminal" (theme header, docs, footer kernel string). The text domain and folder slug are unchanged, so existing translations and file paths keep working.

## 1.6.0 - 2026-11-10
- Fully responsive: verified with headless Chrome at 1440, 1024, 900, 768, 600, 480, 390, 360 and 320px with no horizontal page scroll.
- Added the missing base styles for template classes (header grid, terminal banner, post cards, single post, pagination, post navigation, search form, comment threads, `.screen-reader-text`).
- Defined CSS variables that were referenced but missing (`--bg-card`, `--border`, `--green-dark`, ...).
- Long URLs and titles wrap; code blocks and tables scroll inside their own box; images, iframes and embeds are fluid.
- Sidebar becomes a 2-column grid on tablets and a single column on phones.
- Nav dropdowns and search form are no longer clipped; tap targets (44px) no longer break inline links or the menu button.
- Inputs use 16px text on mobile to prevent iOS zoom-on-focus.
- Added a theme screenshot (`screenshot.png`).

## 1.5.1 - 2026-11-10
- Fixed a fatal error on posts with comments: removed the undefined `deepquest_comment` callback from `comments.php`.
- Fixed a stray `}` in `style.css` that caused browsers to drop the `.nav-inner` rule (nav search not pinned right).

## 1.5.0 - 2026-11-10
- Removed the public PHP version row from the footer (no server fingerprinting).
- Added `Requires at least`, `Tested up to`, `Requires PHP` to the theme header.
- Added README, readme.txt, LICENSE and CHANGELOG for the public GitHub release.

## 1.4.0
- Full responsive overhaul: breakpoints at 900px, 600px and 400px.
- Mobile hamburger menu (`OPEN_MENU` / `CLOSE_MENU`) with click-outside and resize handling.
- JavaScript rewritten in vanilla JS and enqueued via `wp_enqueue_script()` (no jQuery).
- Removed duplicated inline JS from `footer.php`; 44px touch targets; responsive images and embeds.

## 1.3.0
- Fixed the sidebar dropping below the posts on Safari, Chrome and Zen: removed the extra
  `.site-wrapper` / `.site-main` divs so `#primary` and `#secondary` are direct flex children of `#content`.

## 1.2.0
- Added explicit `flex-direction`, `flex-wrap` and `-webkit-` prefixes to the layout.

## 1.1.0
- Removed the WordPress version/engine rows from the footer.
- Nav bar `flex-wrap: nowrap` with prefixed flexbox for Safari.

## 1.0.0
- Initial release: phosphor-green CRT theme with scanlines, vignette, flicker, glow,
  typing terminal prompt, nav search, sidebar widgets and system-info footer.
