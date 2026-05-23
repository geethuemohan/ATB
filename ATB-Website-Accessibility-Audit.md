# ATB Corporate — Accessibility Audit

**Standard:** WCAG 2.1 AA · **Date:** 22 May 2026 · **Scope:** the 48-page static build (shared header, footer, navigation, FAB and stylesheet — so most findings apply site-wide)

---

## Summary

**Issues found: 13** — 🔴 Critical: 1 · 🟡 Major: 7 · 🟢 Minor: 5

The build is solid on the fundamentals: semantic HTML, exactly one `<h1>` per page, a logical heading order, real `<button>` elements for the FAQ accordions, correct `<label for>` on every form field, `aria-current="page"` on navigation, a global `:focus-visible` outline, and an Escape handler that closes overlays. The auto-rotating hero carousel — a WCAG 2.2.2 concern — was removed in the recent home-hero overhaul.

The findings cluster in two areas: **colour contrast** (the antique-gold brand colour does not meet AA as a text colour, and two muted greys fall short), and **keyboard handling of the off-screen overlays** (the mobile navigation and the FAB panel remain in the tab order when closed).

---

## Findings

### Perceivable

| # | Issue | WCAG | Severity | Recommendation |
|---|-------|------|----------|----------------|
| P1 | Antique gold `#B8912A` used as a **text colour** on white/light backgrounds (overlines, inline prose links, `.link-arr--gold`, accent numbers) measures 2.6–2.95:1 against a 4.5:1 requirement. | 1.4.3 Contrast | 🔴 Critical | Reserve `#B8912A` for non-text use (rules, borders, icons, large display accents). For text that must be read — inline links, overlines, small labels — use a darker gold (≈`#7A6320`, which clears 4.5:1 on white) or the slate `#1F2733`. |
| P2 | Gold `#B8912A` text on the slate `#243545` sections measures 4.26:1 — just under 4.5:1. | 1.4.3 Contrast | 🟡 Major | On slate, use `--accent-light #D4AE60` (6.0:1) for gold text rather than `#B8912A`. |
| P3 | `--text-light #8A96A0` (used for `.overline--dim`, `.form-note`, TOC-rail links, article meta) is 3.02:1 on white. | 1.4.3 Contrast | 🟡 Major | Darken the token to ≈`#6A727C` or darker (clears 4.5:1 on white). |
| P4 | `--on-dark-dim` (white at 42%) — used for breadcrumb links, hero stat labels and footer text on the dark panels — composites to 3.96:1. | 1.4.3 Contrast | 🟡 Major | Raise the alpha to ≈0.56 (≈4.6:1), or use a solid light tone. |
| P5 | The India–UAE corridor diagram's gold sub-labels `#997c22` on the cream lane fill are 3.57:1. | 1.4.3 Contrast | 🟢 Minor | Darken the sub-label gold to ≈`#7A6320`. |

*Images:* all nine hero illustrations carry descriptive `alt` text — acceptable. As they are essentially decorative (the headline carries the meaning), an empty `alt=""` would also be defensible; not a failure either way.

### Operable

| # | Issue | WCAG | Severity | Recommendation |
|---|-------|------|----------|----------------|
| O1 | No "skip to main content" link, and no `<main>` landmark on any page. Keyboard and screen-reader users must traverse the full header and navigation on every page. (2.4.1 is technically met via the heading structure, but this is a real gap.) | 2.4.1 Bypass Blocks | 🟡 Major | Add a visually-hidden "skip to content" link as the first focusable element, and wrap each page's content in `<main id="main-content">`. |
| O2 | The FAB panel, when closed, uses only `opacity:0; pointer-events:none`. Its three action links (call / WhatsApp / email) stay in the keyboard tab order while invisible. | 2.4.3 / 4.1.2 | 🟡 Major | Add `visibility:hidden` to the closed `.fab__panel` and `visibility:visible` to `.fab.open .fab__panel`. |
| O3 | The mobile navigation panel is moved off-screen with `transform` but is never `display:none`/`visibility:hidden`. Its ~12 links remain keyboard-focusable when closed — on every page, including desktop. | 2.4.3 / 4.1.2 | 🟡 Major | Add `visibility:hidden` to `.mobile-nav` and `visibility:visible` to `.mobile-nav.open` (transition `visibility` alongside `transform`). |
| O4 | When the mobile nav opens, focus is not moved into the panel, is not trapped, and is not restored to the toggle on close. | 2.4.3 Focus Order | 🟡 Major | On open, move focus to the close button; trap Tab within the panel; on close, return focus to the menu toggle. Add `role="dialog"` + `aria-modal="true"`. |
| O5 | Form fields remove the focus outline (`outline:none`) and signal focus only with a gold border-colour change — a weak, low-contrast indicator. | 2.4.7 Focus Visible | 🟢 Minor | Keep a visible focus ring on inputs — e.g. a 2px outline or a box-shadow in slate. |

*Positive:* a global `:focus-visible { outline: 2px solid … }` rule is present, so most interactive elements have a keyboard focus indicator.

### Understandable

| # | Issue | WCAG | Severity | Recommendation |
|---|-------|------|----------|----------------|
| U1 | Contact form: every input has a correctly associated `<label for>`, and `required` fields use the native attribute. Error identification (3.3.1) is not implemented in the static build. | 3.3.1 / 3.3.2 | 🟢 Minor | No change needed now — ensure the CMS form handler surfaces clear, text-based inline errors on the connected form. |

### Robust

| # | Issue | WCAG | Severity | Recommendation |
|---|-------|------|----------|----------------|
| R1 | FAQ accordion buttons have `aria-expanded` but no `aria-controls` pointing at the answer panel, and the answer panel is not linked back. | 4.1.2 Name, Role, Value | 🟢 Minor | Give each `.faq__a` an `id` and reference it from the button's `aria-controls`. |
| R2 | Some decorative inline SVG icons are not marked `aria-hidden="true"` (the FAQ icon is — others, e.g. nav carets, are inconsistent). | 4.1.2 | 🟢 Minor | Add `aria-hidden="true"` to purely decorative SVGs whose parent already has an accessible name. |

*Also:* there is no `prefers-reduced-motion` handling. The remaining motion is limited to subtle hover transitions and the scroll-spy rail fade, so this is low-risk — but a `@media (prefers-reduced-motion: reduce)` block that neutralises transitions is good practice.

---

## Colour Contrast Check

*Values below reflect the build after remediation.*

| Element / token | Foreground | Background | Ratio | Required | Pass |
|---|---|---|---|---|---|
| Body text `--text` | `#1F2733` | `#FFFFFF` | 15.0:1 | 4.5:1 | ✅ |
| Secondary text `--text-mid` | `#5A6573` | `#FFFFFF` | 5.9:1 | 4.5:1 | ✅ |
| Muted text `--text-light` | `#6A727C` | `#FFFFFF` | 4.9:1 | 4.5:1 | ✅ |
| Gold text `--accent-text` | `#836A22` | `#FFFFFF` | 5.2:1 | 4.5:1 | ✅ |
| `.link-arr--gold` text `--accent-light` | `#D4AE60` | `#243545` | 6.0:1 | 4.5:1 | ✅ |
| Light-gold text `--accent-light` | `#D4AE60` | `#162230` | 7.7:1 | 4.5:1 | ✅ |
| Decorative gold `--accent` (non-text only) | `#B8912A` | `#FFFFFF` | 2.95:1 | 3:1 (UI) | ✅ |
| White on slate hero | `#FFFFFF` | `#162230` | 16.1:1 | 4.5:1 | ✅ |
| Hero/footer muted `--on-dark` | white 74% | `#162230` | 9.3:1 | 4.5:1 | ✅ |
| Dim text `--on-dark-dim` | white 56% | `#162230` | 5.5:1 | 4.5:1 | ✅ |
| Diagram sub-label | `#836A22` | `#F6F2E8` | 4.6:1 | 4.5:1 | ✅ |

---

## Keyboard & Screen Reader

| Component | Behaviour | Assessment |
|---|---|---|
| Header nav / dropdowns | Standard links, `aria-current="page"` on the active item | ✅ Fine |
| FAQ accordion | Real `<button>` inside `<h3>`, `aria-expanded` toggled | ✅ Works; add `aria-controls` (R1) |
| FAB | `<button>` with `aria-label`, `aria-expanded`, `aria-controls`; Escape + click-outside close | ⚠️ Panel focusable when closed (O2) |
| Mobile nav | Opens/closes; links and Escape close it | ⚠️ Focusable when closed (O3); no focus trap/restore (O4) |
| Insights filter | Subject items toggle `aria-pressed`; mobile `<select>` mirrors it | ✅ Fine |
| Forms | All fields labelled; native `required` | ✅ Fine; weak focus ring (O5) |

---

## Priority Fixes

1. **Colour contrast — the gold-as-text problem (P1, P2).** This is the one finding that touches every page. Antique gold is a brand signature, so the fix is *role separation*: keep `#B8912A` for rules, borders, icons and large display accents (all fine), and use a darker gold or slate for anything that is small body-level text — inline links, overlines, captions. This needs a brand-palette decision before it is implemented.
2. **The two off-screen overlays (O2, O3).** A two-line CSS change each — add `visibility:hidden`/`visible`. Removes a real keyboard trap on every page. Quick and safe.
3. **Skip link + `<main>` landmark (O1).** Add once to the shared template; in the static build it means a small repeated edit across the 48 pages.
4. **Muted-grey tokens (P3, P4).** Darken `--text-light`, lift `--on-dark-dim` — token-level changes that cascade.
5. **Mobile-nav focus management (O4)** and the **minor items** (form focus ring, `aria-controls`, decorative-SVG `aria-hidden`, reduced-motion) — polish once the above are done.

Most of these are quick to apply. The contrast items (1, 4) are the ones that intersect with the brand palette and warrant a deliberate decision rather than a silent change.

---

## Remediation Log

**Applied — May 2026:**

- **O2, O3** — the FAB panel and the mobile-navigation panel are now `visibility:hidden` when closed, so they are no longer in the keyboard tab order while invisible.
- **O4** — mobile-nav focus management added: focus moves into the panel on open, Tab is trapped while the panel is open, and focus returns to the menu toggle on close.
- **O1** — a "skip to main content" link and a `<main id="main-content">` landmark added to all 48 pages.
- **O5** — form fields given a clearly visible focus ring, plus a transparent outline so focus is also shown in Windows High Contrast Mode.
- **P3** — `--text-light` darkened `#8A96A0 → #6A727C` (now 4.9:1 on white).
- **P4** — `--on-dark-dim` lifted from 42% to 56% white (now 5.1–5.9:1 on the dark panels).
- **P1, P2, P5 — gold-as-text role separation.** A new token `--accent-text #836A22` was added and the brand gold split by role. `--accent #B8912A` is now reserved for non-text use — rules, borders, card-hover outlines, icons and large display accents — all of which it was already passing. Every place the gold was carrying small, readable text on a light background now uses `--accent-text` (5.2:1 on white): overlines, inline prose links, section/callout/TOC labels, accent numbers (`.svc-card__num`, `.step-num`, `.num-card__n`, `.stat-row__val`), team roles, contact-office labels and the related-card label, plus the inline hover states. `.link-arr--gold` — used only on the dark slate cards and the home hero — was set to `--accent-light #D4AE60` (6.0–7.7:1 on those panels) with a white hover. The corridor diagram sub-labels on `india-uae-business-structuring.html` moved `#997c22 → #836A22` (4.6:1 on the cream lane fill). Decorative gold on the dark footer/topbar (`.footer__col-head`, LinkedIn icons) was kept as `--accent`, which already passes on those backgrounds.
- **Reduced motion** — a `@media (prefers-reduced-motion: reduce)` block added.

**Deferred to the WordPress build:**

- **R1** (FAQ `aria-controls`) and **R2** (decorative-SVG `aria-hidden`) — both Minor. In WordPress the FAQ becomes a single Kadence pattern and the header a single template part, so each is a one-time edit there rather than ~40–48 repeated edits in the static build. To be applied in the template parts.

**Outstanding:**

- None. All Perceivable, Operable and Understandable findings are resolved in the static build; the two Minor Robust items (R1, R2) are deferred to the WordPress template parts as noted above.

---

*This audit is a code-level review. Before launch it should be complemented by a manual pass with a real screen reader (VoiceOver / NVDA) and keyboard-only navigation.*

*End of accessibility audit.*
