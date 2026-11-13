# Stitch export — Beranda ARUNA

Source: [Stitch](https://stitch.withgoogle.com) project **Modern Waste Bank Redesign**
(`4913390228588446235`), screen **Beranda - ARUNA (Animasi Hero Halus)**
(`8b8582b668b54e848c01d71b61f1d4dd`).

| File | What it is |
| --- | --- |
| `beranda-aruna.html` | Full screen source (Tailwind CDN + inline CSS + JS). Image `src`s rewritten to `assets/`. |
| `screenshot.png` | Full-page render, 2560 × 14074 (desktop). |
| `previews/preview-01…06.png` | The screenshot sliced into six viewable sections, 1200 px wide. |
| `assets/` | The five photos used by the design, pulled from the temporary `lh3.googleusercontent.com/aida-public` URLs. |

## Design tokens

Colors (Material 3 style naming, as declared in the `tailwind.config` block):

| Token | Hex | Use |
| --- | --- | --- |
| `primary` | `#002217` | Deep forest green — headings, primary buttons, footer CTA band |
| `primary-container` | `#0f382a` | Button hover |
| `secondary` | `#2c694e` | Eyebrow labels, icons, positive deltas |
| `secondary-fixed` / `secondary-container` | `#b1f0ce` / `#aeeecb` | Soft green chips |
| `surface` / `background` | `#faf9f5` | Warm off-white page background |
| `surface-container-low` | `#f4f4f0` | Inset panels, stat tiles |
| `surface-container-high` | `#e9e8e4` | Range-track fill |
| `outline-variant` | `#e2e1dc` | The 1 px hairline borders everywhere |
| `on-surface` | `#1b1c1a` | Body text |
| `on-surface-variant` | `#545a55` | Muted body text |

Typography:

- Display / headlines — **Newsreader** serif, weight 300–400, tight tracking. Italic `<em>` used for accent phrases in the h1.
- Body / UI — **Plus Jakarta Sans**, 300–500.
- Numerals — small mono accents for step numbers (`01`–`04`) and timestamps.
- Icons — Material Symbols Outlined.

Shape: very restrained. `rounded-lg` (0.25 rem) on buttons/cards, `rounded-xl` (0.5 rem) on the hero card and section cards. Borders do the work; shadows are almost absent
(`0 4px 24px rgba(0,34,23,0.04)`).

## Section order

1. **Fixed header** — 80 px, `bg-[#faf9f5]/90` + `backdrop-blur-md`, hairline bottom border. Logo mark + ARUNA / "Bank Sampah Digital", 6 nav links, "Masuk Admin", "Gabung Nasabah" button.
2. **Hero** — 12-col grid, 7/5 split. Left: pill eyebrow, serif h1 with italic accent, lead paragraph, 2 CTAs, 3 hairline benefits. Right: interactive "hero card" — photo with floating chips, two stat tiles, a serif pull-quote.
3. **Metrics band** — 4-up hairline table on white (`12.450+ Kg`, `1.284+ Warga`, `Rp 45,2 Jt+`, `18 Ton CO2`).
4. **Kalkulator** — 4 garbage categories with `data-rate`/`data-unit`, a range slider, live rupiah + CO₂ estimate.
5. **4 Langkah** — numbered `01`–`04` columns, each with a `border-t border-primary` rule.
6. **Katalog harga** — 4 price cards, each with category chip, "Naik +5%" style delta, price range panel, tip.
7. **Keunggulan** — 4 icon cards.
8. **Testimoni** — 3 serif-italic quote cards with `Verified` marks.
9. **Galeri** — 4 photo cards with category chips and date/location footers.
10. **FAQ** — native `<details>` accordion (first open), `group-open:rotate-180` chevron, plus a WhatsApp support banner.
11. **CTA band** — full-bleed `bg-primary`, white heading, two buttons.
12. **Footer** — 5-col grid, office info, legal row.

## The "Animasi Hero Halus" (smooth hero animation)

This is what the screen name refers to. All of it lives in `<style>` + the final `<script>`:

- `@keyframes subtleBobbing` (±5 px, 3.8 s) and `subtleBobbingAlt` (±3.5 px, 4.4 s), staggered by `0.7 s` / `1.2 s` → `.float-bob-1/2/3` on the chips and stat tiles.
- `.hero-card` lifts `-translate-y-2` and casts a bigger shadow on hover.
- `mousemove` tilt: max **6.5°** on both axes via `perspective(900px) rotateX/rotateY`, reset on `mouseleave`. Bounds are recached on scroll/resize/enter.
- `.sheen-layer` — a skewed white gradient that sweeps left → right on `.hero-card:hover` over 0.85 s.
- `prefers-reduced-motion: reduce` disables the bobbing, the tilt and the sheen.

## Interactions to port

- Calculator: `Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 })`, `co2 = weight * 0.9` kg.
- Category buttons swap `border-primary bg-surface-container-low` ↔ `border-outline-variant bg-white`.
- Calculator rates are static demo values (PET 4.500/kg, kardus 2.800/kg, logam 12.000/kg, UCO 7.000/L).

## Notes

- The screen is **DESKTOP** (2560 × 14074).
- Nav links carry `data-path` attributes (`beranda`, `tentang-kami`, …) that suggest a multi-page routing map.
- Tailwind is loaded from `cdn.tailwindcss.com`, so `beranda-aruna.html` needs internet to render; the JS and images are local.
