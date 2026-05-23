# ATB Corporate — Languages & Translation Strategy Brief

**Question addressed:** whether, and how, to offer the website in languages beyond English · **Date:** 22 May 2026 · **Context:** the 48-page site, an India–UAE cross-border advisory practice, migrating to WordPress/Kadence

---

## The bottom line

**Launch English-only, as planned.** English already reaches essentially the entire audience ATB is built for — investors, family offices and corporate decision-makers operate in English in both the UAE and India. Translation is therefore not a necessity; it is a reach, credibility and SEO opportunity.

Of the possible languages, **Arabic is the one candidate worth a deliberate, phased addition** — not for all 48 pages, but for a curated subset of high-intent pages, added on the WordPress build once analytics show real demand. **Hindi adds little** for this particular B2B audience. And whatever is decided, the work belongs on the WordPress site, not the static build.

The rest of this brief is the reasoning behind that, and what each path would involve.

---

## 1. Does ATB actually need a multilingual site?

The honest answer is that it does not *need* one — but it could *benefit* from one.

ATB's audience is a narrow, senior B2B segment: businesses entering new markets, investors, and family offices doing cross-border work between India and the UAE. That segment operates in English almost universally. In the UAE, business, legal and financial affairs are conducted in English; the free zones ATB advises on — ADGM and DIFC — are English-medium by design, with English common law systems; government portals are bilingual Arabic/English. In India, the entire corporate, legal, investment and advisory world works in English. So an English-only site already speaks to the whole target audience in a language they read fluently.

That reframes the decision. Translation is not about *access* — it is about *advantage*:

**The case for adding Arabic.** It reaches Arabic-preferring clients and, importantly, Arabic-language *searchers* in the UAE — a search space with far less competition than English. It signals local commitment and rootedness, which carries weight with Emirati clients, family offices and government-adjacent audiences. For a firm whose UAE presence is part of its identity, an Arabic site is a credibility marker.

**The case against.** It costs money to produce and, more significantly, money and effort *forever* to maintain. The audience already reads English. Regulatory and tax content is difficult to translate well. And a half-maintained second language can read as worse than none at all.

The balance: worth doing, eventually, for Arabic — but as a considered growth step, not a launch requirement.

---

## 2. Which languages

**Arabic** — the realistic candidate. Relevant to the UAE market, valuable for search visibility, meaningful as a trust signal. It is also the most involved to implement, because it is right-to-left (see §3).

**Hindi** — low value for this audience. India's corporate, investor and family-office segment works in English; Hindi-language B2B advisory content would add little incremental reach, and Hindi is not even the prevailing language across much of India — including Bengaluru, where ATB's India office sits. Skip it unless a specific client segment later makes a clear case.

**Other languages** — not warranted.

So in practice this is a single, binary question: **English-only, or English plus Arabic.**

---

## 3. What Arabic actually involves — right-to-left

Arabic is written right-to-left, so an Arabic version is not just translated text — the whole layout mirrors. Navigation, text alignment, the hero composition, the skyline image placement, icons with direction, and the reading order of cards and columns all flip. WordPress has RTL support built in, and Kadence supports RTL, so this is well-trodden ground — but it is real work:

- A dedicated **Arabic webfont** is required; the current display and body fonts (Cormorant Garamond, Inter) do not cover Arabic script. The Arabic face should be chosen to sit comfortably beside the English brand typography.
- Every page needs a **layout QA pass** in RTL — mirrored layouts always surface a few elements that need adjustment.
- Mixed-direction content (an Arabic page that still contains English terms, e.g. "ADGM", "DIFC", or figures) needs care so the text flows correctly.

None of this is a blocker. It simply means an Arabic version carries more build and testing effort than a same-direction language would.

---

## 4. Approach options

| Option | What it is | Verdict |
|---|---|---|
| Full site, professionally translated | All 48 pages in Arabic | Highest cost and the largest forever-maintenance burden. Hard to justify when the audience reads English. |
| **Curated subset, professionally translated** | ~8–12 high-intent pages (home, the UAE pillar and key UAE sub-pages, core service pages, contact) | **Recommended path if ATB proceeds.** Captures most of the value for a fraction of the cost and upkeep. |
| Machine translation, unreviewed | Auto-translate everything, no human check | Not appropriate for a professional advisory firm. Regulatory and tax content will contain errors. |
| Machine translation + expert review | AI produces a draft; a domain expert reviews and corrects it in context | A pragmatic middle ground — fast and affordable, with quality controlled. Pairs well with the right plugin (see §5). |

The sensible combination is the **curated subset**, produced by **machine draft plus expert review** or by direct professional translation — covering the pages that actually drive enquiries, not the long tail.

---

## 5. The plugin layer (WordPress / Kadence)

Multilingual capability in WordPress is plugin-driven. Four realistic options:

| Plugin | Model | Strengths | Watch-outs |
|---|---|---|---|
| **TranslatePress** | Freemium; Pro per-site licence | Visual, front-end translation — you translate directly on the live design; AI draft (DeepL/Google) then human review; solid RTL handling | Pro needed for more than one extra language and the SEO add-on |
| WPML | Paid, annual | The most established; fully separated content per language; granular string control; broad plugin compatibility | Heavier; steeper setup; translation managed in the admin, not visually |
| Polylang | Freemium; Pro | Lightweight; separate post per language; usable free tier | More manual; full features and some SEO need Pro |
| Weglot | SaaS subscription | Fastest setup; translation managed externally | Recurring cost scales with word count and traffic; content hosted off-site |

For ATB's situation — a design-heavy Kadence build, a curated subset of pages, and regulatory content that needs in-context review — **TranslatePress is the natural fit**: you translate visually on the real page, you can AI-draft then have an expert correct it in place, and its RTL support is good. **WPML** is the alternative if ATB later decides it wants a fully separated, full-site bilingual presence. Either must be confirmed to play well with **Rank Math** (the chosen SEO plugin) — both have established Rank Math compatibility, but it should be verified at build time.

---

## 6. SEO implications

A translated site is, in SEO terms, a second site. Done properly that is an asset; done carelessly it is a liability.

- Each language should live at its **own indexable URLs** — a subdirectory structure (`/ar/...`) is the standard, clean choice.
- **`hreflang` tags** must connect each English page to its Arabic counterpart so search engines serve the right version; the multilingual plugin generates these.
- The **XML sitemap** must include both language sets — Rank Math and the multilingual plugin coordinate this.
- **Avoid on-the-fly translation without real URLs** — content that is not separately indexable earns no search value.
- The upside is genuine: Arabic-language search in the UAE is far less contested than English, so well-translated pages can rank with comparatively little effort.
- The risk is equally real: thin or machine-only translated content can *drag down* perceived site quality. This is another argument for a curated, well-translated subset over a sprawling, lightly-translated whole.

---

## 7. The real cost is maintenance, not build

The build cost of a translated site is a one-off. The maintenance cost is permanent. **Every** future content change — a new service, an updated tax figure, a new Insights article, a revised fee note — has to be re-translated, or the two language versions drift apart. A drifted, half-current second language looks worse than no second language at all.

This single fact is the strongest argument for keeping any translated set **small and curated**. Translating ten stable, high-value pages is a manageable ongoing commitment. Translating and forever maintaining all 48 is a standing obligation that competes with actual client work.

Cost components to budget, if proceeding: professional legal/financial translation (priced per word or per page — rates vary by provider and should be quoted directly; domain-experienced translators cost more and are worth it), the plugin licence, an Arabic webfont licence if not free, and a recurring QA pass on each content release.

---

## 8. Quality and risk — regulatory content

ATB's content is precise by nature: tax treatment, structuring options, regulatory thresholds, jurisdiction-specific terms. A mistranslation here is not a cosmetic error — it is a credibility risk and potentially a liability one. Two safeguards:

- Use a translator with **genuine legal or financial domain experience**, or the AI-draft-plus-expert-review model — never unreviewed machine output for this material.
- Keep the **English version authoritative**. For the legal pages especially (Privacy Policy, Terms of Use), the Arabic should be a convenience translation with a short note that the English text governs in case of any discrepancy.

---

## 9. Timing — where this sits in the project

**Do not translate the static build.** The site is being rebuilt in WordPress/Kadence, and multilingual capability is a WordPress plugin feature. Any RTL or translation work done on the static HTML now would simply be discarded.

The sound sequence is:

1. Launch the site **English-only**, as planned.
2. Let it run for a few months.
3. Read the **Site Kit / GA4 data** — visitor language preference, country, and which pages Arabic-region visitors land on. This turns the Arabic question from a guess into an evidence-based decision.
4. If the data (or direct client feedback) shows meaningful Arabic-preferring or UAE-Arabic-search demand, **add Arabic then** — for the curated subset, on the live WordPress site.

Adding a language later is straightforward. Building it prematurely, before there is evidence anyone wants it, is effort spent ahead of need.

---

## 10. Recommendation

A phased, evidence-led approach:

**Phase 1 — now.** Launch and run the site in English only. This is already the plan, and it is the right call: English reaches the whole target audience.

**Phase 2 — post-launch, data-driven.** Once Site Kit/GA4 has a few months of data, review Arabic-region traffic and language signals. If they justify it, add **Arabic for a curated subset** of roughly ten high-intent pages — home, the UAE pillar page and its key sub-pages, the core service pages, and contact — implemented with **TranslatePress** on the WordPress build, translated professionally or AI-drafted with expert review, and QA'd for RTL. Keep English authoritative.

**Hindi and other languages.** Not recommended. Revisit only if a specific, evidenced client need emerges.

The guiding principle throughout: a small, accurate, well-maintained translated set is worth far more than a large, drifting one — and the decision to build it should follow evidence of demand, not precede it.

---

*This brief is a strategy document. The Arabic decision should be revisited with real analytics data after launch; plugin and translation pricing should be quoted directly at that point, as both move over time.*

*End of languages & translation strategy brief.*
