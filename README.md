# CLF WordPress Theme — "Bold Conviction" — Setup Guide

Custom WordPress theme for the Charlotte Leadership Forum. Deep navy / parchment / rust palette, Manrope + Playfair Display + DM Mono typography, cinematic imagery, scroll-reveal animations.

---

## 1. Install the Theme

1. In WP admin: **Appearance → Themes → Add New → Upload Theme**
2. Upload `clf.zip`
3. Click **Activate**

If you previously installed the old "clf-wordpress-theme", this is a separate theme — activate this one and delete the old one.

---

## 2. Create the Pages (or run the setup plugin)

The **CLF Theme Setup** plugin (separate zip) creates everything below with one click: Tools → CLF Setup. Otherwise, manually:

| Page Title | Slug        | Template     |
|------------|-------------|--------------|
| Home       | `/`         | *(front-page.php automatically)* |
| Experience | `experience`| **Experience** |
| Our Story  | `our-story` | **Our Story**  |
| Alumni     | `alumni`    | **Alumni**     |
| Apply      | `apply`     | **Apply**      |
| Give       | `give`      | **Give**       |

Then **Settings → Reading** → static front page → "Home".

---

## 3. Navigation Menus

**Appearance → Menus**:
- **Primary Navigation**: Experience, Our Story, Alumni, Give, then Apply with CSS class `nav-cta` (enable "CSS Classes" under Screen Options)
- **Footer Navigation**: Experience, Our Story, Give, plus a Custom Link `mailto:` for contact

---

## 4. What's Editable Where

| Content | Where to edit |
|---|---|
| Hero heading (2 lines), subtext, kicker note | Customizer → CLF Content → Home Page |
| Stats bar (numbers, labels, italic note) | Customizer → CLF Content → Home Page |
| Mission statement | Customizer → CLF Content → Home Page |
| Testimonial quote + attribution (home) | Customizer → CLF Content → Home Page |
| Contact email, PayPal URL, mailing address | Customizer → CLF Content → Contact & Footer |
| Page titles & subtitles | Page editor (Title + Excerpt box) |
| "Our approach" (Experience), "How it began" (Our Story) body text | Page editor body — leave empty to keep the designed default copy |
| Nav & footer links | Appearance → Menus |
| Founders, timeline, leaders, testimonials, class directory | In the PHP templates (`page-templates/`) — structured design content |

---

## 5. Apply Form

The 5-step Apply flow renders but does not submit anywhere yet. Wire it to WPForms, Gravity Forms, or a custom handler — all fields have `name` attributes. See comments in `page-templates/template-apply.php`.

---

## Theme File Map

```
clf/
├── style.css                    Theme declaration + Bold Conviction design system
├── functions.php                Setup, fonts, nav walker, customizer, clf_icon() SVG helper
├── header.php                   Nav (dark by default; pages can set clf-nav-light)
├── footer.php                   Footer
├── front-page.php               Home page
├── page.php                     Fallback page template
├── index.php                    WordPress-required fallback
├── page-templates/              Experience, Our Story, Alumni, Apply, Give
├── template-parts/              Shared partials
└── assets/
    ├── images/                  Design imagery (hero, retreats, textures)
    └── js/clf-main.js           Scroll reveals, mobile nav, form steps, give toggles
```

### Design notes
- Pages set `$GLOBALS['clf_page_class']` before `get_header()` to scope page-specific styles and switch the nav to its light variant.
- Page-specific CSS lives in an inline `<style>` block at the top of each template; everything shared is in `style.css`.
- Icons are inline SVGs via `clf_icon( $name, $size )` — no icon-font CDN dependency.
