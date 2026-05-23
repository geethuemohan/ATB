# ATB Corporate — Website Developer Handoff

**Prepared:** May 2026
**Artifact:** Static multi-file HTML website, ready for import into WordPress (Kadence theme).
**Purpose:** This document is the reference for the developer importing the static build into the CMS. It is not part of the website and should not be published.

---

## 1. Overview

The site is a complete static build: hand-written, semantic HTML5 with a single shared stylesheet and a single shared script. It opens and runs from the file system or any static host with no build step. Every page uses relative links, so the folder can be moved or hosted anywhere as-is.

- **48 HTML pages**
- **Shared assets:** `assets/atb-styles.css`, `assets/atb-main.js`, `assets/favicon.svg`, `assets/atb-og.png`
- **Root files:** `sitemap.xml`, `robots.txt`
- **Fonts:** Cormorant Garamond (display) and Inter (body), loaded from Google Fonts in each page `<head>`.

---

## 2. Design tokens

All design values are CSS custom properties defined at the top of `assets/atb-styles.css`. Key brand values:

- **Slate** `#243545` — primary brand colour
- **Antique Gold** `#B8912A` — accent
- **Display typeface** — Cormorant Garamond
- **Body typeface** — Inter

When rebuilding in Kadence, map these to the theme's global colours and typography so future content matches.

---

## 3. Page inventory (48 pages)

**Core (7)** — index, uae, india, services, about-us, insights, contact-us

**Service pages (6)** — adgm-difc-gift-city-structures, global-capability-centres, transaction-advisory, trade, market-intelligence, outsourced-finance

**Knowledge Series articles (4)** — insight-uae-jurisdiction-selection, insight-uae-company-setup-cost, insight-uae-corporate-tax-transfer-pricing, insight-uae-entry-strategy

**UAE sub-pages (5)** — uae-structuring, uae-adgm, uae-difc, uae-tax, uae-business-setup

**India sub-pages (5)** — india-structuring, india-business-setup, india-gift-city, india-tax, india-sez-and-incentives

**Global Capability Centres sub-pages (5)** — india-gcc-structures, india-gcc-locations-and-incentives, india-gcc-tax-structuring, india-gcc-operational-and-workforce-planning, india-uae-gcc-structures

**Transaction Advisory sub-pages (2)** — transaction-advisory-india-inbound, transaction-advisory-uae-inbound

**Cross-Border Trade sub-pages (3)** — trade-india-uae-cepa, trade-distribution-channels, trade-cross-border-trade-risk

**Market Intelligence sub-pages (3)** — market-intelligence-uae-research, market-intelligence-india-research, market-intelligence-strategic

**Outsourced Finance sub-pages (3)** — uae-taxation, india-taxation, accounting-outsourced-services

**Corridor pillar (1)** — india-uae-business-structuring

**Legal & utility (4)** — privacy-policy, terms-of-use, 404, about-us-selected-work

---

## 4. Shared components — convert to template parts

The following blocks are byte-identical across all 48 pages. In WordPress/Kadence they should become a single header template, footer template and reusable block — edit once, not 48 times.

- **Top bar** — office hours + LinkedIn link.
- **Header / primary navigation** — logo, six-item nav (UAE · India · Services · About · Insights · Contact Us). UAE, India and Services carry dropdowns.
- **Mobile navigation** — slide-in panel mirroring the desktop nav.
- **Footer** — four columns (brand, Services, Company, Contact) plus the legal bar.
- **Floating Action Button (FAB)** — call / WhatsApp / email.

**Current-page state:** each page marks its own nav item with `aria-current="page"`. Sub-pages mark their parent section (UAE sub-pages mark "UAE", service sub-pages mark "Services", etc.). Reproduce this in the template logic.

**Navigation note:** "India–UAE Business Structuring" deliberately appears in **both** the UAE and the India dropdowns — it is the corridor bridge page and is relevant from either market. This is intentional, not a duplication error.

---

## 5. JavaScript (`assets/atb-main.js`)

One vanilla-JS file, no dependencies. It powers: sticky-header shadow on scroll, the homepage hero rotator, the FAB toggle, the mobile-nav open/close, the FAQ accordions, the Insights subject filter (sticky sidebar + mobile dropdown), and the long-form "On This Page" floating side rail with scroll-spy. All behaviour is feature-detected and degrades gracefully if the script is absent.

---

## 6. SEO, metadata & structured data

**Embedded in the build.** Every one of the 47 indexable pages (all except `404.html`) carries a complete metadata block in `<head>`:

- `<link rel="canonical">` pointing to the intended production URL (see section 7).
- Open Graph and Twitter Card tags for link previews on LinkedIn, WhatsApp and similar.
- A default share image, `assets/atb-og.png` (1200×630) — a clean branded placeholder (slate field, gold monogram and wordmark), to be refined when real imagery is commissioned.
- JSON-LD structured data in an `@graph` block: `Organization` on every page, `WebSite` on the homepage, `BreadcrumbList` on every interior page, `Service` on the service and topic pages, and `Article` on the four Knowledge Series pieces. All 47 validate cleanly.

**Avoid duplicate tags in WordPress.** Rank Math will generate canonical, Open Graph and schema itself. Treat the build's embedded metadata as the reference for the *values*, but let Rank Math own the output — do not ship both, or pages will emit duplicate tags.

**FAQ schema is deliberately not in the static build.** Google no longer shows FAQ rich results for commercial sites, and FAQ schema is best generated and maintained by the CMS. FAQ questions are already marked up as `<h3>` (semantic and AI-readable); add FAQ schema in WordPress via Rank Math on the pages that have an FAQ section.

**Source spec SEO blocks.** The source `.docx` files (in the client's "Main Pages" and "Sub-Pages for Service Pages" folders) each contain a full SEO block — title, meta description, keywords, schema notes and an internal-link map. The build's titles and descriptions are set, but several run longer than the 50–60 / 150–160-character ideal; the spec documents hold correctly-sized, keyword-validated versions. Map the spec values into Rank Math's title and description fields at import.

---

## 7. URL structure & permalinks

The source specs each propose a canonical slug, but they are unconfirmed (every one is marked "[CONFIRM SLUG]") and internally inconsistent — some nested, some flat, some long-winded. The build already uses clean, consistent, descriptive flat filenames, which is the better scheme.

**Recommendation — adopt the build's flat filenames as the permalinks.** The rule is simple:

> WordPress permalink = the static filename, with `.html` removed and a trailing slash added.

So `uae-structuring.html` → `/uae-structuring/`, `india-gift-city.html` → `/india-gift-city/`, and so on for every page (the full filename list is in section 3). Two exceptions:

- `index.html` → `/` (the site root).
- `trade-india-uae-cepa.html` → `/india-uae-cepa/` — the shorter slug its own spec requires, with a **301 redirect** from the old `/cepa-trade-commercial-structuring`.

The `<link rel="canonical">` tags and `sitemap.xml` in this build already use these target URLs (`https://atbcorporate.com/<slug>/`), so they need no further change once the WordPress permalinks are set to match.

**Why flat rather than nested:** a flat URL is independent of where the page sits in the menu, so the site can be reorganised later without breaking URLs — important here because several pages (the corridor page, the GCC and Trade pages) sit across more than one section and have no single natural parent.

At launch, keep the trailing-slash convention consistent, and **301-redirect every existing live URL** that has inbound links or indexed traffic to its new permalink.

---

## 8. Internal linking & the Related Pages section

Internal linking on this site has two layers, handled differently in WordPress.

**The Related Pages section.** Every content page — the pillar pages, all service and topic sub-pages, and the Knowledge Series articles (40 pages in total) — ends with a "Related Pages" block: a four-card grid of curated links to topically related pages, placed just before the closing call-to-action band. Markup is `<section class="section section--warm" id="related">` using `.related-grid` / `.related-card`; styling is in `assets/atb-styles.css` under the "RELATED PAGES" heading. In WordPress this should become a **reusable Kadence pattern** — the card design built once, the four links then curated per page in the editor. It is editorial and stable; it does not need to change when new articles are published.

**Contextual inline links.** Links woven into body prose (for example throughout the India–UAE Business Structuring page). These are part of the page copy and carry across with the content at import.

**Ongoing linking after launch.** The client will add Knowledge Series articles over time. To keep this maintainable with no code editing:

- Set up the Knowledge Series as WordPress **Posts** (or a custom post type) with a **category/tag taxonomy** matching the Insights subject filter (Market Entry, Tax, Structuring, and so on).
- Use an **automatic related-posts mechanism** — a Kadence Posts block or a lightweight related-posts plugin driven by that taxonomy — for article-to-article linking. A newly tagged article then surfaces automatically in the related blocks of its siblings, with no manual linking.
- **Rank Math** includes internal-link suggestions while editing; enable this so the client can link a new article to relevant service pages in a couple of clicks.
- Article-to-service-page links remain editorial — the Related Pages pattern is where they are managed.

Each source content `.docx` also contains an internal-link map; reconcile that with the Related Pages curation at import, and re-point all links to the final permalink structure.

---

## 9. Launch checklist

- [ ] **404 page** — the server must return a genuine **HTTP 404** status for unresolved paths (not 200). Configure via the Kadence 404 template or a 404 plugin. Keep `meta robots` = `noindex, follow`.
- [ ] **Sitemap** — `sitemap.xml` lists the 47 indexable pages by their target permalink URLs (see section 7; 404 excluded). Once in WordPress, let **Rank Math regenerate the sitemap** and replace this static file.
- [ ] **robots.txt** — update the `Sitemap:` line if the final sitemap URL differs.
- [ ] **301 redirects** — set redirects from any old/previous URLs that have inbound links or indexed traffic, plus the CEPA redirect noted above.
- [ ] **Internal links** — currently relative `.html` links. Re-point to the final permalink structure at import.
- [ ] **Legal review** — the Privacy Policy and Terms of Use spec documents both state they should be reviewed by a UAE-qualified solicitor (and an India-qualified solicitor for the data-protection provisions) before launch.
- [ ] **Analytics** — wire Google Analytics / GTM; the 404 spec asks for a `404_error` event carrying the requested path.
- [ ] **Favicon** — `assets/favicon.svg` is referenced site-wide; add `.ico`/PNG fallbacks if older-browser support is required.
- [ ] **Forms** — the Contact page form is static markup; connect it to the CMS form handler or a form plugin.

---

## 10. Notes

- The site is fully self-contained: no frameworks, no build tooling, no external JS dependencies beyond Google Fonts.
- Colour, type and spacing are centralised in `assets/atb-styles.css` via CSS variables — change a token once and it cascades.
- Long-form sub-pages share a consistent structure (page hero with breadcrumb, intro + "On This Page" table of contents, anchored content sections, FAQ accordion, Related Pages section, closing band) so they map cleanly to a single Kadence template.

*End of handoff document.*
