# ATB Corporate — Kadence Migration Readiness Audit

**Target platform:** WordPress + Kadence · **Host:** Hostinger · **Date:** 22 May 2026 · **Scope:** the 48-page static build → a WordPress/Kadence rebuild

---

## Summary

The static build is in good shape to migrate: clean semantic HTML, one shared stylesheet and one shared script, a small and consistent set of components, and per-page SEO metadata already written. That makes the rebuild mostly a matter of *mapping*, not *rescuing*.

The single most important thing to understand up front: this is **not a file import**. WordPress/Kadence pages are rebuilt with blocks. The static HTML, CSS and JS become a *specification* — they tell the build exactly what content, layout, styling and metadata each page needs — but they are not pasted into WordPress wholesale. A handful of components and the stylesheet's design tokens carry over as real code (into a child theme); everything else is reconstructed with Kadence blocks and patterns.

Three areas need genuine care, and the rest is routine:

1. **SEO preservation** — every page already has hand-written title, description, Open Graph, Twitter and JSON-LD data. None of it should be lost in translation. This is the highest-risk part of the migration.
2. **The URL / redirect map** — the site's flat `.html` URLs will all change to WordPress permalinks. Every old URL needs a 301 redirect to its new address.
3. **Three custom components with no native Kadence equivalent** — the floating action button, the Insights category filter, and the long-form table-of-contents side rail. Each needs a deliberate plan rather than an assumption that Kadence "just does it."

Everything else — header, footer, hero, FAQ, cards, CTA bands — maps cleanly onto Kadence's native building blocks.

---

## 1. Confirmed target stack

The stack below is confirmed. Only two items carry a cost — Kadence Pro and ShortPixel — and everything else is free or already in place.

| Component | Choice | Cost |
|---|---|---|
| Hosting | Hostinger (current) — consider Kinsta / WP Engine when ready to scale | Existing |
| WordPress | Yes | Free |
| Kadence Theme | **Pro — buy now** | $199/yr (includes Blocks Pro) |
| Kadence Blocks | **Pro — included with the theme licence** | Included |
| SEO | Rank Math | Free |
| Redirects | Redirection (John Godley) | Free |
| Caching | LiteSpeed Cache | Free |
| Caching alternative | WP Rocket — **do not buy** | — |
| Forms | Fluent Forms | Free |
| Backups | UpdraftPlus → Google Drive | Free |
| Security | Wordfence + WPS Hide Login | Free |
| Image compression | ShortPixel | ~$5/month |
| Analytics | Site Kit by Google (GA4) | Free |
| Staging | Hostinger staging, or WP Staging | Free |
| Rank Math Pro | Deferred — reassess at 6 months | — |

**One gap worth closing:** the list has no dedicated **SMTP plugin**, and reliable form-email delivery needs one (see §9). FluentSMTP is free and made by the same team as Fluent Forms, so it is the natural pick — treat it as a small addition to the stack rather than a separate evaluation.

---

## 2. How the migration actually works

The static build delivers four things to the WordPress rebuild:

- **Content** — the exact, final copy for all 48 pages.
- **A design specification** — the stylesheet defines the colours, type scale, spacing and component styling to reproduce.
- **A component inventory** — the repeated pieces that should become reusable Kadence patterns and template parts.
- **SEO metadata** — the per-page `<title>`, description, Open Graph, Twitter and JSON-LD already written into each file.

The work itself is: provision WordPress on Hostinger (on a **staging site** — see §12), set up global styles, build the header and footer once as template parts, build the shared sections once as patterns, then assemble each page from those patterns and paste in the content. The static CSS is not "imported" — its tokens and any genuinely bespoke component CSS move into a **child theme stylesheet**, and the rest is replaced by Kadence's own styling controls.

---

## 3. Site structure & content model

**Pages vs Posts.** The four Insights articles are editorial, dated, and already have a category filter — they should become **Posts** under a **category taxonomy** (UAE, India, GCC, etc., matching the existing `data-category` values). The Insights index becomes the blog/archive page. The remaining ~43 pages are evergreen and should be **Pages**.

**Page hierarchy.** The pillar/sub-page relationships (UAE → ADGM, DIFC, Tax, Business Setup…; India → …; GCC → …) map naturally to **parent/child Pages**. A custom post type is *not* needed unless these pages require their own custom fields or a distinct editorial workflow — for ~43 evergreen pages, Pages with hierarchy is simpler and lighter. (Revisit only if the content model grows.)

**Navigation.** The header's dropdown navigation becomes a standard **WordPress Menu**, with the dropdown structure expressed as menu nesting. The `aria-current` "active page" behaviour is automatic in WordPress.

**Legal & utility.** Privacy Policy and Terms become Pages. The custom 404 becomes the theme's 404 template (Kadence lets you design it as a template).

---

## 4. Components → Kadence

| Component | In the static build | Kadence home | Notes |
|---|---|---|---|
| Header + dropdown nav | Repeated markup + sticky-shadow JS | **Header Builder** (template part) | Sticky, transparent-over-hero, and the mobile toggle are all native settings. Built once. |
| Footer | Repeated markup | **Footer Builder** (template part) | Built once, edited once. |
| Home hero (`.hero`) | Section markup + CSS | **Pattern** (Row Layout) | Per-page content; the recent horizon-band image change is the spec to reproduce. |
| Interior hero (`.page-hero`) | Section markup + CSS | **Pattern** (Row Layout) | Set the optional "Minimum Height" here — this is where the deferred #84 decision is made, with rendered pages in view. |
| FAQ accordion | Markup + JS | **Accordion block** | Native; resolves accessibility finding R1 (the block manages `aria-expanded` / `aria-controls`). |
| Related-pages section | Markup + CSS | **Pattern** | |
| CTA bands | Markup + CSS | **Pattern** | |
| Breadcrumbs | Markup | Kadence breadcrumb, or the SEO plugin's breadcrumb block | Pick one source so markup stays consistent. |
| Cards (service, article, feature, num) | Markup + CSS | Kadence patterns built from Row/Column + the existing card CSS in the child theme | |
| Floating action button (FAB) | Markup + JS | **No native equivalent** — custom | A Kadence Element (hooked sitewide) holding the markup, plus the small toggle script. See §5. |
| Insights category filter | Markup + JS | **No native equivalent** | Recommend native category archives instead of client-side filtering. See §5. |
| Long-form TOC side rail + scroll-spy | Built entirely by JS | **No native equivalent** — plugin or custom | A table-of-contents plugin, or a small custom block. See §5. |
| India–UAE corridor diagram | Inline SVG | **Custom HTML block** (paste the SVG inline) | Do not upload as an `.svg` file unless the Safe SVG plugin is installed — WordPress blocks SVG uploads by default for security. Inline is simpler. |
| Skyline line-art images | PNGs in `assets/images` | **Media Library** | Convert to WebP on upload (LiteSpeed Cache can do this automatically). |

### Navigation specification

The static build's header and mobile menu now carry the agreed top-level order — build the WordPress menu to match:

**Home · About · UAE · India · Services · Insights · Contact Us**

`UAE` and `India` stay as standard dropdowns — their existing dropdowns already list the relevant sub-pages. `Services` should be built as a **mega-menu**: hovering it opens a single panel with the six service pillars as columns, each column listing that pillar's sub-pages. Kadence Pro's mega-menu feature supports this directly. Each column header is itself a link to the pillar page; the items beneath link to the sub-pages. This adds the third navigation level the static build does not have; a hover fly-out was considered and rejected in favour of the mega-menu, which is more robust on touch screens and for keyboard and screen-reader users.

| Pillar (column header → pillar page) | Sub-pages listed beneath |
|---|---|
| ADGM, DIFC & GIFT City Structures | *(no dedicated sub-pages — column is the pillar link alone)* |
| Global Capability Centres | India GCC Structures · India GCC Location & Incentive Strategy · India GCC Tax & Transfer Pricing · India GCC Operational & Workforce Planning · India–UAE GCC Structures |
| Transaction Advisory | India Inbound · UAE Inbound |
| Cross-Border Trade | India–UAE CEPA · Distribution & Channels · Cross-Border Trade Risk |
| Market Intelligence | UAE Research · India Research · Strategic Coordination |
| Outsourced Finance | UAE Taxation · India Taxation · Accounting & Outsourced Services |

A new top-level **Home** item was added at the client's request, alongside the logo (which also links home). The current page should be marked with `aria-current="page"` on its menu item — Kadence handles this automatically for WordPress menus.

---

## 5. Custom JavaScript

`atb-main.js` contains six behaviours. Most are replaced by native Kadence functionality; three are not.

| Behaviour | Kadence equivalent | Action |
|---|---|---|
| Sticky-header shadow on scroll | Native sticky header | Drop the custom JS. |
| FAQ accordion | Accordion block | Drop the custom JS; rebuild with the block. |
| Mobile nav open/close + focus trap | Native mobile menu | Use the native menu, but **re-test keyboard focus** — the static build has a hand-written focus trap and focus-restore; confirm Kadence's mobile menu behaves acceptably for keyboard users, and add a fix if not. |
| FAB toggle (open/close, Escape, click-outside) | None | Keep — it is ~15 lines. Load it via the child theme or a code-snippets plugin, not pasted into theme files. |
| Insights subject filter | None | **Recommended:** drop the client-side filter and use native **category archive pages** — each subject becomes a real URL, which is better for SEO and needs no JavaScript. If a single-page filtered view is important to keep, use a filter plugin or port the existing script. |
| TOC side rail + scroll-spy | None | Use a table-of-contents plugin (several handle scroll-spy), or rebuild as a small custom block reusing the existing script. |

The guiding principle: **minimise surviving custom JS.** What genuinely remains (the FAB, possibly the TOC and the filter) belongs in a child theme or a snippets plugin — never pasted into theme template files, which are overwritten on theme updates.

---

## 6. Styling & design tokens

The stylesheet splits cleanly into two destinations.

**Global styles → Kadence settings.** The design tokens — the slate and gold brand colours (including the recent `--accent` / `--accent-text` split), the text colours, the surface colours, and the type scale — map onto **Kadence's Global Colors palette and typography settings**. Set these once in the Kadence Customizer and they cascade across every block. Buttons, links, base spacing and headings can be driven largely by Kadence global styles, which removes a chunk of custom CSS.

**Bespoke component CSS → child theme.** The genuinely custom pieces — the hero, the cards, the corridor diagram, the TOC rail, the FAB, the contrast-tuned tokens, the `prefers-reduced-motion` block — go into a **child theme stylesheet**. A child theme (rather than Kadence's Customizer "Additional CSS") keeps this maintainable, version-controllable, and safe across theme updates.

Do not aim to transplant `atb-styles.css` verbatim. Treat it as the reference; let Kadence's global styling absorb everything it can, and keep custom CSS to the parts Kadence cannot express.

---

## 7. Fonts

The build uses **Cormorant Garamond** (display) and **Inter** (body). Kadence can load Google Fonts natively, but for performance and for privacy compliance — the audience spans the UAE, India and the EU — the fonts should be **self-hosted locally** rather than fetched from Google's servers. Kadence has a local-fonts option; confirm both families and all required weights are installed, and that the type scale matches the static spec.

---

## 8. Images & media

All assets — the skyline line-art PNGs, the Open Graph image (`atb-og.png`), the favicon, and any diagram exports — move into the **Media Library**. Recommendations:

- Compress images and serve them as **WebP** using **ShortPixel** (the confirmed image-optimisation tool); WordPress lazy-loads images by default.
- The **corridor diagram** is inline SVG — keep it inline in a Custom HTML block rather than uploading an `.svg` file.
- **`alt` text already exists** in the static build for every meaningful image — preserve it; do not let the rebuild drop it.
- Set the **favicon** (Site Icon) and the default **social share image** globally.

---

## 9. Contact form

The static contact form has correctly associated labels and native `required` attributes but no submission handler. In WordPress it is rebuilt with **Fluent Forms** (the confirmed forms plugin). The rebuild must add:

- **Spam protection** — a honeypot, or a privacy-respecting challenge. (Note: an external CAPTCHA adds a third-party dependency and a privacy consideration; a honeypot is lighter.)
- **Reliable delivery** — route submissions through an **SMTP plugin** (FluentSMTP — free, pairs with Fluent Forms) to a real mailbox (the build already references `info@atbcorporate.com`). Do not rely on default PHP mail.
- **Inline, text-based error messages** — this also resolves accessibility finding **U1**; the form block handles field-level error identification natively.

---

## 10. SEO preservation

This is the highest-care part of the migration. Every page in the static build already carries hand-written metadata: a unique `<title>` and meta description, canonical URL, Open Graph tags (title, description, image, type, URL), Twitter card tags, JSON-LD structured data, the `lang` attribute, and a clean single-`h1` heading structure. **None of this should be lost.**

Recommended approach:

1. **Extract everything first.** Before touching WordPress, pull every page's current title, description and any custom schema into a single sheet — 48 rows. This becomes the checklist that proves nothing was dropped.
2. **Install one SEO plugin** (Rank Math recommended) and enter each page's title and description from that sheet. The plugin then generates canonicals, the XML sitemap, and `robots.txt`.
3. **Open Graph / Twitter** — the plugin generates these from the page metadata; set the global default share image and confirm per-page overrides where the static build had them.
4. **Structured data** — the plugin auto-generates Organization, WebSite and BreadcrumbList schema. Any *custom* schema in the static build — for example FAQPage schema on FAQ sections, or Service schema on service pages — must be reconfigured deliberately; it will not appear on its own.
5. **Headings** — the build is already correct (one `h1` per page, logical order); ensure the block rebuild keeps it that way.

The risk is silent omission — a page that quietly loses its description or schema. The extraction sheet in step 1 is what prevents that.

---

## 11. URLs & redirects

The static site uses flat `.html` URLs (`uae-taxation.html`, `india-gift-city.html`, and so on). WordPress uses extension-less permalinks (`/uae-taxation/`, `/india-gift-city/`). **Every URL on the site will change.**

Required:

- Set the permalink structure deliberately (`/%postname%/`) **before** building content.
- Build a **redirect map**: every old `.html` path → its new permalink, served as a **301 (permanent) redirect**. The Redirection plugin manages this cleanly; on LiteSpeed it can also be done at server level.
- Audit for any **hardcoded `.html` internal links** — in a block rebuild internal links are normally re-pointed naturally, but confirm none survive (especially inside pasted Custom HTML blocks).

How critical this is depends on one fact to confirm: **is the static site already live and indexed at these `.html` URLs?** If yes, the 301 map is essential to preserve search ranking and avoid 404s. If the site has never launched, it matters less — but setting clean permalinks deliberately is still worth doing once, up front.

---

## 12. Hosting, performance & launch (Hostinger)

- **Build on staging.** Use Hostinger's hPanel staging environment (or WP Staging). Build and QA the whole site on staging, then push to live — never build directly on the production domain.
- **WordPress setup** — Hostinger one-click install, current PHP 8.x, current WordPress.
- **Caching** — most Hostinger plans run the **LiteSpeed** web server; use **LiteSpeed Cache** for page caching and asset optimisation. WP Rocket is deliberately *not* bought — LiteSpeed Cache covers the same ground at no cost.
- **Image optimisation** — **ShortPixel** handles compression and WebP (see §8). To avoid double-processing, leave LiteSpeed Cache's own image optimisation off.
- **SSL** — enable Hostinger's free SSL and force HTTPS sitewide.
- **Backups** — **UpdraftPlus** backing up to **Google Drive**, alongside Hostinger's own automatic backups — two independent restore paths.
- **Security** — **Wordfence** (firewall and malware scanning) plus **WPS Hide Login** (moves the login page off the default `/wp-admin`). Add strong admin credentials and two-factor authentication on the admin account.
- **Analytics** — **Site Kit by Google**, connected to a **GA4** property, installed at launch so data collection starts from day one.
- **Email** — route form mail via SMTP to a real mailbox — see §9.
- **Performance budget** — keep the plugin list lean. Each plugin in the confirmed stack earns its place; resist adding more.
- **Scaling later** — Hostinger is right for launch. If traffic grows enough to need it, Kinsta or WP Engine are the managed-hosting step up; nothing in this build locks that out.

---

## 13. Accessibility carry-over

The recent accessibility audit fixes must survive the rebuild — most do so naturally:

- **R1 (FAQ `aria-controls`)** — resolved automatically by the Kadence Accordion block.
- **R2 (decorative SVGs `aria-hidden`)** — handle as the pages are rebuilt; Kadence icon blocks mark decorative icons correctly.
- **Skip link + `<main>` landmark** — Kadence outputs a `<main>` landmark and supports a skip link; confirm both are present after the theme is set up.
- **Colour contrast** — preserved automatically, because the contrast-tuned tokens live in the child theme's global colours.
- **`prefers-reduced-motion`** — carry the existing media-query block into the child theme stylesheet.
- **Mobile-menu keyboard focus** — the one item to actively test: the static build has a hand-written focus trap; verify the native Kadence mobile menu is acceptable for keyboard users (see §5).

A short keyboard-and-screen-reader re-test after the rebuild is worthwhile — the same closing recommendation as the accessibility audit itself.

---

## 14. Recommended migration sequence

1. Provision WordPress + Kadence on a **Hostinger staging site**.
2. Set **global styles** — brand colours, the type scale, self-hosted fonts.
3. Build the **header and footer** template parts.
4. Build the **shared patterns** once — hero, interior hero, cards, related-pages, CTA bands, FAB.
5. Build **page templates** — a generic content page, a pillar page, an Insight post — and confirm them before scaling.
6. **Assemble all 48 pages** from the patterns; paste in the final content.
7. Build the **contact form** and wire up SMTP delivery.
8. Install the **SEO plugin**; enter per-page metadata from the extraction sheet; reconfigure custom schema.
9. Build the **redirect map** and set permalinks.
10. **QA** — links, responsive behaviour, accessibility re-test, form test, cross-browser check.
11. **Go live** — push staging to production, force HTTPS, submit the sitemap.
12. **Post-launch** — confirm redirects resolve, check search-console coverage, verify analytics and form delivery.

---

## 15. Open decisions

The stack itself is settled (§1). What remains:

- **SMTP plugin** — not in the confirmed list, but needed for reliable form email. FluentSMTP is the natural pick (§9) — a small addition to confirm.
- **Insights filter** — native category archive pages (recommended) versus keeping a single-page filtered view (§5).
- **Is the static site already live and indexed?** This sets how critical the 301 redirect map is (§11).
- **Rank Math Pro** — already scheduled: deferred for now, reassess at six months once there is search-console data to judge it against.

---

*This audit is a planning document. It should be revisited with the build team before work starts, and the open decisions in §15 settled first.*

*End of Kadence migration readiness audit.*
