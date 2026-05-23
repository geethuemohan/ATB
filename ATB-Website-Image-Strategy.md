# ATB Corporate — Website Image Strategy & Specification

**Prepared:** May 2026
**Purpose:** Guidance for the developer, designer and content team on whether, where and how to introduce imagery into the ATB Corporate website. The site currently ships with no photographic or illustrative content imagery; this document sets out a deliberate, selective image programme rather than a blanket "add pictures" instruction.

---

## 1. Position: restraint is the right default

The site today is, by design, almost entirely image-free. Its visual identity comes from typography (Cormorant Garamond and Inter), the slate-and-gold palette, generous whitespace, the dark hero panel and clean geometric detailing — not from photography.

For a boutique cross-border advisory firm, that restraint is an asset, not a gap:

- **Premium positioning.** The advisory, legal and consulting firms that read as most credible online tend to use very little imagery, and what they use is real and specific. Generic stock photography — handshakes, glass towers, "diverse team around a laptop" — actively cheapens a premium professional brand. More images would not make this site feel more premium; the wrong images would make it feel less so.
- **Performance.** With effectively no images, the site is extremely light and fast. Images are almost always the heaviest assets on a page. Every image added is a performance cost, so each one must earn its place.

The recommendation is therefore **not** "add imagery throughout." It is a **small, curated, high-quality image set**, placed only where it does real work — and a firm "no" to decorative stock photography.

---

## 2. The five lenses

A brief, honest read on each consideration:

- **SEO** — Images are a minor ranking factor. They earn a little image-search traffic and can support rich results, *provided* they carry descriptive file names and alt text. Mostly they matter by *not hurting* — i.e. not slowing the page. Modest upside; discipline required.
- **AI / AEO** — Answer engines parse text first; images help them least directly. The exception: **diagrams that encode structure**, with good alt text and captions, genuinely aid machine comprehension, and a clear branded share image helps AI surfaces present the brand. Diagrams help; decorative photos barely register.
- **Premium feel** — The decisive lens. Fewer, better, real images. Stock imagery is a downgrade. This lens argues *against* volume.
- **Comprehension** — The genuine case *for* imagery. The site explains complex structuring concepts in prose; some of that is far clearer as a **diagram**. This is where images earn their keep — as explanatory visuals, not decoration.
- **Load performance** — Images are the main performance risk. Anything added must follow the format and size specs in Section 6 so the site stays fast.

**Conclusion:** the highest-value visuals for this site are **real team photography** (trust) and **custom diagrams** (comprehension) — not decorative photography.

---

## 3. Where images earn their place

### Priority 1 — Essential

**Team photography (About page).** An advisory firm is its people. The About page already includes two team-photo slots — for the two co-founding partners — currently rendering each partner's initial as a placeholder. These should be replaced with real, commissioned headshots, shot to one consistent treatment (background, crop, lighting). This is the single most valuable imagery on the site, and a direct **EEAT signal**: Google and AI systems weigh demonstrable expertise and real, named people. Commissioned, not stock.

**Knowledge Series article images (4).** Each of the four articles should have one featured image — used on the article page header and as the thumbnail on the Insights index. This lifts the Insights index above text-only cards, improves social-share appearance, and populates the `Article` structured-data `image` field. They can be restrained, abstract or editorial — they need not be literal illustrations of the topic. (Note: the Insights card design would need a thumbnail area added — a small build change.)

### Priority 2 — High value: explanatory diagrams

A small set of **custom diagrams** for the pages that explain structures and processes — for example: the India–UAE corridor structure, holding-company and entity options, the GCC operating models (captive / build-operate-transfer / hybrid), the ADGM–DIFC–GIFT City comparison, and the CEPA rules-of-origin flow.

**Strong recommendation: build these as inline SVG in the existing brand style** (slate/gold, clean line work) — not raster images. Inline SVG costs essentially nothing in load time, stays razor-sharp at any size and on any screen, and — being bespoke — reinforces the premium, expert feel. The site already uses SVG fluently for its icons, so this is a natural extension rather than a new technique. Done well, these diagrams are the imagery most likely to lift both comprehension and AEO performance.

### Priority 3 — Optional

- **Office / location photography** — tasteful architectural shots of, or evoking, the Abu Dhabi and Bengaluru locations, on the Contact or About page. Adds legitimacy. Optional.
- **Homepage hero** — the current hero (light content panel beside the dark practice-areas panel) works well with no photograph. A hero image is optional and carries real risk; if explored at all, it should be abstract or architectural and strictly brand-consistent — never a literal stock business scene.

### Explicitly avoid

Decorative stock photography on the service and sub-pages — skylines, handshakes, generic "business" scenes. These pages are text-led advisory content and the existing prose-and-card layout is already on-brand. Stock imagery here would dilute the positioning and slow the pages for no gain.

---

## 4. Placement by page / template

| Page / template | Imagery |
|---|---|
| Homepage | None required — keep the current hero treatment. Hero image optional (Priority 3). |
| About Us | Two commissioned team headshots (essential); optional office shot. |
| About — Selected Work | None — the content is deliberately anonymised; no client imagery. |
| Contact | Optional office / location photography. |
| Insights index | A thumbnail per article (drawn from the article featured images). |
| Knowledge Series articles (×4) | One featured image each; optional in-article diagram. |
| Service & sub-pages | No decorative photography. A custom inline-SVG diagram only where a concept genuinely needs visualising (Priority 2). |
| Legal pages / 404 | None. |

---

## 5. Indicative volume

A disciplined programme is roughly:

- 2 commissioned team headshots.
- 4 article featured images.
- 5–8 custom diagrams (inline SVG).
- 0–2 optional office / location photographs.

Total in the order of **a dozen to fifteen assets** — a curated set, not a library. If a brief ever calls for many more than this, treat that as a signal to revisit the strategy.

---

## 6. Technical specification

For every raster image added:

- **Format** — AVIF or WebP as the primary format, with a JPEG fallback. Diagrams: inline SVG (no raster).
- **Responsive** — supply 2–3 widths and use `srcset` / `sizes` so each device downloads only what it needs.
- **Dimensions** — set explicit `width` and `height` (or `aspect-ratio`) on every `<img>` to prevent layout shift (CLS).
- **Lazy-loading** — `loading="lazy"` on all below-the-fold images; any above-the-fold hero image stays eager and is ideally preloaded.
- **File-size budget** — well under 200 KB per photographic image after compression; headshots and article images typically 80–150 KB.
- **Suggested dimensions** — team headshots ~600×750; article featured images ~1200×675 (16:9); social/OG images 1200×630.
- **File naming** — lower-case, hyphenated, descriptive: e.g. `team-firstname-surname.webp`, `insight-uae-jurisdiction-selection-cover.webp`. No spaces, no generic `IMG_1234`.
- **Alt text** — every image needs it. Describe the content meaningfully for people and search engines (for a headshot: `"<Name>, <Role>, ATB Corporate"`); strictly decorative images take an empty `alt=""`. Diagrams need a real textual description of what they show.
- **Image sitemap** — once images are in place, Rank Math can include them in the sitemap; descriptive filenames and alt text are what earn image-search visibility.

---

## 7. Sourcing & brand consistency

- **Commission, don't stock.** Team and office photography should be commissioned to one consistent visual treatment. If any licensed or stock imagery is ever unavoidable, it must be quietly abstract or architectural and run through a consistent treatment (for example a slate duotone) so the site reads as one brand, not a scrapbook.
- **Diagrams** should be produced in the existing design language — slate `#243545`, antique gold `#B8912A`, the same line weights and typography — so they sit as though they were always part of the site.
- **The share image** (`assets/atb-og.png`) is already in place as a branded default. Per-section variants can follow later but are not required for launch.

---

## 8. Notes for the developer

- The build currently contains no `<img>` elements; introducing images is purely additive.
- In WordPress / Kadence, use the theme's responsive image handling (it emits `srcset` and lazy-loads by default) and keep to the format and size budgets above.
- Inline-SVG diagrams can be placed directly in page content or built as reusable blocks / patterns.
- The Insights card component will need a thumbnail area added if article featured images are adopted.
- Re-test Core Web Vitals (LCP, CLS) after imagery is added — it is the single change most likely to move them.

*End of image strategy document.*
