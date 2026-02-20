# FlexIQ Dev Guide — CSS & WordPress FSE

**Beginner-friendly guide för att bygga FlexIQ pixel-perfect.**

---

## 📁 Projektstruktur

```
themes/flexiq/
├── assets/
│   └── css/
│       ├── design-system.css        ← Tokens + global styles
│       └── components/
│           ├── header.css           ← Sticky header styles
│           └── footer.css           ← Footer styles (white bg, no padding)
├── parts/                           ← FSE template parts
│   ├── header.html                  ← Header markup
│   └── footer.html                  ← Footer markup
├── templates/                       ← Full page templates
│   ├── front-page.html              ← Homepage (static front page)
│   └── page.html                    ← Default page template
└── patterns/                        ← Reusable block patterns
    ├── hero-section.php
    ├── feature-grid.php
    └── cta-section.php
```

---

## 🎨 CSS-arkitektur

### 1. **design-system.css** — Grund
- **CSS Custom Properties** (CSS-variabler) från Figma
- Typography, spacing, colors, borders
- Global reset + base styles
- **Importerar** alla component-CSS via `@import`

### 2. **components/*.css** — Per komponent
- Header (sticky, nav, buttons)
- Footer (white bg, links, illustration)
- Patterns (om de behöver extra styles utöver Gutenberg-inställningar)

### 3. **Patterns** — Återanvändbart innehåll
- Skapas i Gutenberg Editor eller via PHP-filer i `patterns/`
- Använder design-system tokens via inline styles eller CSS-klasser
- **Exempel:** Hero med CTA-knapp, Feature Grid (01-06), Testimonials

---

## 🔧 När använda vad?

| **Uppgift** | **Verktyg** | **Var** |
|---|---|---|
| Layout (kolumner, spacing) | Gutenberg FSE Editor | `parts/*.html`, `templates/*.html` |
| Colors, fonts, shadows | CSS Custom Properties | `design-system.css` |
| Sticky header, footer styles | Component CSS | `components/header.css`, `components/footer.css` |
| Återanvändbar sektion (hero, CTA) | Block Pattern | `patterns/*.php` eller Gutenberg → "Create Pattern" |
| Button hover effects, animations | CSS | `components/*.css` eller inline i `design-system.css` |

---

## 🚀 Workflow

### **Steg 1: Design-tokens klara?**
✅ Ja — `design-system.css` har alla Figma-färger, spacing, fonts.

### **Steg 2: Bygg komponenter**
1. **Header** — `parts/header.html` + `components/header.css`
   - Sticky: `position: sticky; top: 0; z-index: 100;`
   - Green CTA-knapp: `background: var(--color-accent);`
2. **Footer** — `parts/footer.html` + `components/footer.css`
   - White bg: `background-color: var(--color-white);`
   - No padding: `padding: 0;`
3. **Sections** — Skapa patterns i Gutenberg eller PHP

### **Steg 3: Testa lokalt**
```bash
cd ~/Work/external/flexiq
open http://localhost:8080  # WordPress dev server
```

### **Steg 4: Sync till webhotel**
```bash
# Rsync theme till live webhotel (FTP)
rsync -avz themes/flexiq/ USERNAME@HOST:/path/to/wp-content/themes/flexiq/
```

eller använd FTP (Cyberduck, FileZilla):
- Host: `109.235.174.18`
- User: `wp-flexiq.flexiq.se`
- Pass: `Flexiq123@`
- Upload: `/public_html/wp-content/themes/flexiq/`

---

## 📝 Gutenberg vs CSS — När göra vad?

### **Designa i Gutenberg när:**
- Du placerar blocks (columns, images, buttons)
- Du sätter spacing mellan sections
- Du skapar återanvändbara patterns
- Du justerar block-level settings (text alignment, width)

### **Skriv CSS när:**
- Du behöver hover effects
- Du vill sticky header
- Du vill custom animations
- Gutenberg's UI inte räcker (t.ex. grid gap <20px)

---

## 🎯 Sticky Header — Exempel

**CSS** (`components/header.css`):
```css
.wp-block-template-part[data-area="header"] {
  position: sticky;
  top: 0;
  z-index: 100;
  background: var(--color-white);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}
```

**Markup** (`parts/header.html`):
```html
<!-- wp:group {"tagName":"header","align":"full"} -->
<header class="wp-block-group alignfull">
  <!-- Navigation, logo, CTA button -->
</header>
<!-- /wp:group -->
```

---

## 🎨 Footer — White bg, no padding

**CSS** (`components/footer.css`):
```css
.wp-block-template-part[data-area="footer"],
footer {
  background-color: var(--color-white);
  padding: 0;
}

footer.wp-block-group {
  padding: var(--spacing-8) var(--section-padding-x) var(--spacing-4);
}
```

**Markup** (`parts/footer.html`):
```html
<!-- wp:group {"tagName":"footer","align":"full"} -->
<footer class="wp-block-group alignfull">
  <!-- Footer content (nav, illustration, copyright) -->
</footer>
<!-- /wp:group -->
```

---

## 🔄 Block Patterns — Hur skapa

### **Metod 1: Via Gutenberg (enklast)**
1. Öppna en sida i Gutenberg Editor
2. Bygg din sektion (t.ex. hero med heading + button)
3. Markera alla blocks → "Create Pattern"
4. Namnge: "Hero Section"
5. Kategorisera: "FlexIQ Sections"
6. Pattern sparas och syns i "Patterns" → "FlexIQ Sections"

### **Metod 2: Via PHP-fil (mer kontroll)**
```php
<?php
/**
 * Title: Hero Section
 * Slug: flexiq/hero-section
 * Categories: flexiq-sections
 */
?>
<!-- wp:group {"align":"full","backgroundColor":"hero-bg"} -->
<section class="wp-block-group alignfull has-hero-bg-background-color">
  <!-- wp:heading {"level":1} -->
  <h1>Vi transformerar din personal resa</h1>
  <!-- /wp:heading -->

  <!-- wp:buttons -->
  <div class="wp-block-buttons">
    <!-- wp:button {"backgroundColor":"button","textColor":"white"} -->
    <div class="wp-block-button">
      <a class="wp-block-button__link has-white-color has-button-background-color">Kontakta oss</a>
    </div>
    <!-- /wp:button -->
  </div>
  <!-- /wp:buttons -->
</section>
<!-- /wp:group -->
```

Spara som `patterns/hero-section.php`.

---

## 🧪 Testing Workflow

1. **Lokal dev** — Testa på `localhost:8080`
2. **Figma jämförelse** — Öppna Figma sida vid sida, justera CSS
3. **Responsiv** — Testa mobile (DevTools → Toggle device toolbar)
4. **Live deploy** — Rsync eller FTP → testa på https://www.flexiq.se/

---

## 🚨 Vanliga misstag

❌ **Att tänka på:**
- `parts/header.html` heter INTE `header.php` (WordPress FSE = `.html`)
- CSS Custom Properties måste definieras i `:root` (inte `body`)
- `@import` i CSS fungerar bara om CSS-filen laddas via `<link>` i HTML

✅ **Best practices:**
- Använd design tokens (`var(--spacing-4)`) ALLTID, inte hardcodade värden
- En component = en CSS-fil (header.css, footer.css, hero.css)
- Testa i både Chrome och Safari (Safari kan rendera annorlunda)

---

## 📚 Resurser

- **WordPress FSE Docs:** https://developer.wordpress.org/block-editor/
- **FlexIQ Figma:** https://www.figma.com/design/rGJampH62z4wondvSJlcIg/FlexIQ
- **Design System:** `/themes/flexiq/docs/design-system.md`

---

**Ready to build! 🚀**

Börja med header (sticky) och footer (white, no padding), sen bygg patterns sektion för sektion.
