# Frontend & WordPress Expert Skills

## 🎨 Frontend Best Practices

### CSS/Tailwind
- Mobile-first approach
- CSS custom properties for theming
- Logical properties (margin-inline, padding-block)
- Container queries where useful
- Aspect-ratio for media
- Gap instead of margins for spacing
- clamp() for fluid typography

### Performance
- Critical CSS inlined
- Lazy load below-fold images
- Preload fonts (woff2)
- Responsive images with srcset
- Avoid layout shifts (reserve space)
- Defer non-critical JS

### Modern CSS
```css
/* Fluid typography */
font-size: clamp(1rem, 0.5rem + 2vw, 1.5rem);

/* Container queries */
@container (min-width: 400px) { ... }

/* Logical properties */
margin-inline: auto;
padding-block: 1rem;

/* Modern color */
color: oklch(70% 0.15 250);
```

### Animation
- Use transform/opacity only
- will-change sparingly
- prefers-reduced-motion support
- CSS animations > JS when possible

---

## 🔧 WordPress Block Theme Mastery

### theme.json Structure
```json
{
  "$schema": "https://schemas.wp.org/wp/6.5/theme.json",
  "version": 3,
  "settings": {
    "color": { "palette": [...] },
    "typography": { "fontFamilies": [...] },
    "layout": { "contentSize": "800px", "wideSize": "1200px" }
  },
  "styles": {
    "color": { "background": "var(--wp--preset--color--base)" },
    "typography": { "fontFamily": "var(--wp--preset--font-family--body)" }
  }
}
```

### Template Hierarchy
```
templates/
├── index.html          (fallback)
├── front-page.html     (homepage)
├── page.html           (pages)
├── single.html         (posts)
├── archive.html        (archives)
├── 404.html            (not found)
├── page-styles.html    (style guide)
└── page-{slug}.html    (specific pages)

parts/
├── header.html
├── footer.html
└── sidebar.html
```

### Block Patterns
```php
<?php
/**
 * Title: Hero Section
 * Slug: flexiq/hero
 * Categories: featured
 * Keywords: hero, banner, cta
 */
?>
<!-- wp:group {"layout":{"type":"constrained"}} -->
...
<!-- /wp:group -->
```

### Style Variations
```json
// styles/professional.json
{
  "$schema": "https://schemas.wp.org/wp/6.5/theme.json",
  "version": 3,
  "title": "Professional",
  "settings": {},
  "styles": {
    "color": {
      "background": "#1a1a2e",
      "text": "#eaeaea"
    }
  }
}
```

---

## 🧱 Gutenberg Block Development

### Block Structure
```
src/blocks/hero/
├── block.json
├── edit.js
├── save.js
├── index.js
├── editor.scss
└── style.scss
```

### block.json
```json
{
  "$schema": "https://schemas.wp.org/trunk/block.json",
  "apiVersion": 3,
  "name": "flexiq/hero",
  "title": "Hero",
  "category": "theme",
  "icon": "cover-image",
  "supports": {
    "align": ["wide", "full"],
    "color": { "background": true, "text": true },
    "spacing": { "margin": true, "padding": true }
  }
}
```

### InnerBlocks Pattern
```jsx
<InnerBlocks
  template={[
    ['core/heading', { level: 1 }],
    ['core/paragraph', {}],
    ['core/buttons', {}]
  ]}
  templateLock="all"
/>
```

---

## 📦 Build Pipeline

### @wordpress/scripts
```json
{
  "scripts": {
    "build": "wp-scripts build",
    "start": "wp-scripts start",
    "lint:js": "wp-scripts lint-js",
    "lint:css": "wp-scripts lint-style"
  }
}
```

### Tailwind + WordPress
```js
// tailwind.config.js
module.exports = {
  content: [
    './templates/**/*.html',
    './parts/**/*.html',
    './patterns/**/*.php',
    './src/**/*.{js,jsx}'
  ],
  theme: {
    extend: {
      colors: {
        // Match theme.json
        primary: 'var(--wp--preset--color--primary)',
        secondary: 'var(--wp--preset--color--secondary)'
      }
    }
  }
}
```

---

## 🎯 FlexIQ Specific

### Design Tokens
- Primary: Modern, professional (NOT orange/beige)
- Secondary: Accent color with character
- Neutral scale for text/backgrounds
- Success/Warning/Error states

### Typography
- Headings: Modern sans-serif (Inter, Plus Jakarta Sans)
- Body: Readable, clean
- Fluid scaling with clamp()

### Components to Build
1. Hero with CTA
2. Services grid (3-col)
3. Testimonials
4. Team cards
5. Contact form
6. Location cards (Karlskrona, etc)
7. Job listings
8. Article cards
