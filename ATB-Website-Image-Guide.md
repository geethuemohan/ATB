# ATB Corporate — Line-Art Image Production Guide

**Prepared:** May 2026
**Purpose:** The production spec for the site's line-art hero illustrations — what to draw, at what size, and how each one is processed into the brand palette. Hand this to anyone generating or commissioning new images so every one matches. The *rationale* for where images belong is in `ATB-Website-Image-Strategy.md`; this document is the *how*.

---

## 1. What the line-art hero image is

A fine-line illustration of a real, recognisable place relevant to the page — a city skyline or a landmark — recoloured to the brand palette and set into the page hero, bleeding off the right edge. It is custom line art, never stock photography. The UAE skyline already live on `uae.html` is the reference.

---

## 2. What to supply — per image

- **Subject** — the specific place for that page (see the list in section 6). It must be genuinely recognisable.
- **Style** — a fine, even-weight line drawing. Pure linework only: no fills, no shading, no colour wash, no background scenery. Match the density and delicacy of the UAE / Dubai reference drawings already supplied.
- **Ink & background** — dark linework (black or dark grey) on a **plain white background**, nothing else. The delivered ink colour does not matter — it is recoloured in processing — but the background must be clean white.
- **Composition** — landscape. The subject spans the **full width** of the frame and occupies roughly the **lower two-thirds**, with open empty "sky" above it. That empty upper band is essential: it is what lets the headline sit clear and the image bleed cleanly.
- **Resolution** — large. **At least 2000 px wide**; ~2400 × 1100 is ideal.
- **Aspect ratio** — landscape, roughly **2:1 to 2.5:1**.
- **File format** — PNG.

Supplying clean line art on white (rather than a pre-coloured file) is preferred — the recolour is done at implementation so every image ends up identical in tone.

---

## 3. Brand palette

| Role | Hex | RGB |
|---|---|---|
| Hero background — slate | `#162230` | 22, 34, 48 |
| Brand slate — primary | `#243545` | 36, 53, 69 |
| **Line-art gold — the colour the linework becomes** | **`#A98E55`** | **169, 142, 85** |
| Antique gold — accent | `#B8912A` | 184, 145, 42 |
| Accent light gold | `#D4AE60` | 212, 174, 96 |

---

## 4. Processing (done at implementation — recorded here so it can be reproduced)

Each supplied drawing is:

1. **Recoloured** — the linework is mapped to the line-art gold `#A98E55` (a muted, antique gold — deliberately not a bright, saturated one, so the skyline stays a restrained backdrop). Tonal depth is preserved by setting each pixel's opacity from the inverted brightness of the original (`alpha = (255 − luminance) × B`, capped at 255), then eased to ~78% overall so the skyline supports rather than competes with the headline. The multiplier `B` is **tuned per source** so every image lands at the same ink weight regardless of how dark or pale the supplied drawing is: a firmly-inked drawing uses ~1.4, a fainter one up to ~2.1. The target is roughly **5–6% of pixels at full strength** — check a new image against the existing four and adjust `B` until it matches.
2. **Background dropped** — white becomes fully transparent.
3. **Cropped to ~2.2:1**, trimming any sparse end so the skyline meets the frame on a substantial building. This is what makes it bleed convincingly off the page edge rather than tapering into an empty gutter.
4. **Exported** as a palette-optimised PNG — target **under 100 KB** (typically 50–80 KB).

---

## 5. Final asset spec

- **Format** — PNG, transparent background, palette-optimised (256 colours).
- **Location** — `assets/images/`.
- **File naming** — lowercase, hyphenated, descriptive: `uae-skyline.png`, `abu-dhabi-skyline.png`, `gift-city-skyline.png`.
- **Display** — fixed **720 px wide** in the page hero, bleeding **40 px** off the right edge, with a soft left-edge fade (CSS mask). Below 1080 px the hero stacks and the image sits under the text.
- **Alt text** — a plain description of the place: e.g. `Line illustration of the Abu Dhabi skyline`.

---

## 6. Where the line-art images are used

Line-art heroes are used **only on pages with a genuine, specific place to depict**. Pages whose subject is abstract (tax, structuring, advisory process) do **not** get a decorative image — they are served by an explanatory diagram or left as clean type. This keeps the image set curated, not templated.

**Line-art hero image:**

| Page | Subject to draw |
|---|---|
| `index.html` (home) | Combined UAE + India skyline, linked across the corridor — the flagship hero |
| `uae.html` | UAE skyline *(done)* |
| `india.html` | India skyline — India Gate, Gateway of India, a temple gopuram, modern towers |
| `uae-adgm.html` | Abu Dhabi skyline — Al Maryah Island, Etihad Towers, ADNOC HQ, Sheikh Zayed Grand Mosque, Capital Gate |
| `uae-difc.html` | Dubai / DIFC skyline — the DIFC Gate building, Emirates Towers, Burj Khalifa |
| `india-gift-city.html` | GIFT City skyline — the GIFT City towers, Gandhinagar |
| `global-capability-centres.html` | A modern Indian tech / office campus — buildings, walkways, landscaping (a campus reads more clearly than a city skyline for GCCs) |
| `india-uae-business-structuring.html` | A combined India + UAE skyline — the corridor *(optional; page also carries a diagram)* |

**Explanatory diagram instead of an image** (better for comprehension and AI answer engines): `adgm-difc-gift-city-structures.html` (ADGM vs DIFC vs GIFT City comparison), the structuring pages (holding / entity options), `trade-india-uae-cepa.html` (CEPA rules-of-origin flow), `global-capability-centres.html` (captive / build-operate-transfer / hybrid models).

**Photography:** `about-us.html` (two commissioned team headshots), `contact-us.html` (optional office photograph).

**Knowledge Series:** the four articles each take one cover image — these may use the same line-art treatment (restrained, architectural or abstract).

**No hero image:** the remaining text-led service and topic pages, legal pages and 404. Restraint on these pages is the design, not a gap.

---

*End of image guide.*
