# Changelog

All notable changes to DeepQuest Terminal. Versions are incremental per delivered revision.

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
