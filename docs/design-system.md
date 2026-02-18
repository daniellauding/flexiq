# FlexIQ Design System

**Version:** 1.0  
**Last Updated:** 2026-02-11  
**Figma File:** [FlexIQ Design](https://www.figma.com/design/rGJampH62z4wondvSJlcIg/FlexIQ?node-id=120-16369)

---

## Table of Contents

1. [Typography System](#typography-system)
2. [Color Palette](#color-palette)
3. [Spacing System](#spacing-system)
4. [Components](#components)
5. [Design Tokens](#design-tokens)
6. [CSS Custom Properties](#css-custom-properties)
7. [WordPress theme.json](#wordpress-themejson)

---

## Typography System

### Primary Typeface: Satoshi

**Font Family:** Satoshi  
**Weights Used:** Regular (400), Medium (500), Bold (700), Black (900)

### Type Scale

#### Display / Hero Text
```
H1 (Hero Large)
- Font Size: 182px
- Font Weight: 900 (Black) / 700 (Bold)
- Line Height: 209px (115%)
- Letter Spacing: -5.46px (-3%)
- Use: Main hero headlines

H2 (Display)
- Font Size: 126px
- Font Weight: 900 (Black)
- Line Height: 152px (120%)
- Letter Spacing: -2.53px (-2%)
- Use: Section headers, key messages
```

#### Headings
```
H3
- Font Size: 120px
- Font Weight: 700 (Bold)
- Line Height: 216px (180%)
- Letter Spacing: -3.6px (-3%)
- Use: Major section titles

H4
- Font Size: 96px
- Font Weight: 900 (Black) / 700 (Bold)
- Line Height: 96px (100%)
- Letter Spacing: -1.92px (-2%)
- Use: Sub-section headers

H5
- Font Size: 87px
- Font Weight: 700 (Bold)
- Line Height: 157px (180%)
- Letter Spacing: -2.62px (-3%)
- Use: Component titles, card headers

H6
- Font Size: 72px
- Font Weight: 700 (Bold)
- Line Height: 86px (120%)
- Letter Spacing: -1.44px (-2%)
- Use: Smaller headings, labels
```

#### Body Text
```
Body Large
- Font Size: 64px
- Font Weight: 700 (Bold)
- Line Height: 115px (180%)
- Letter Spacing: -1.92px (-3%)
- Use: Large body text, introductions

Body Medium
- Font Size: 56px
- Font Weight: 500 (Medium)
- Line Height: 101px (180%)
- Letter Spacing: -1.68px (-3%)
- Use: Standard body text

Body Small
- Font Size: 48px
- Font Weight: 500 (Medium)
- Line Height: 86px (180%)
- Letter Spacing: -1.44px (-3%)
- Use: Secondary text, descriptions

Body XSmall
- Font Size: 40px
- Font Weight: 500 (Medium) / 700 (Bold)
- Line Height: 72px (180%)
- Letter Spacing: -1.2px (-3%)
- Use: Caption text, metadata
```

#### Navigation
```
Navigation Item
- Font Size: 112px
- Font Weight: 700 (Bold)
- Line Height: 129px (115%)
- Letter Spacing: -2.24px (-2%)
- Use: Main navigation links
```

### Typography Notes

- **Letter Spacing Pattern:** Typically -2% to -3% of font size for tighter, modern look
- **Line Height Pattern:** 
  - Headings: 100-120% for tight, impactful text
  - Interactive elements: 115%
  - Body text: 140-180% for readability
- **Font Weights:**
  - Black (900): Hero text, major headlines, CTAs
  - Bold (700): Headers, navigation, emphasis
  - Medium (500): Body text, standard content
  - Regular (400): Minimal use, light text

---

## Color Palette

### Primary Colors

```css
/* Brand Dark Green - Primary brand color */
--color-primary: #0c2212;
--color-primary-rgb: 12, 34, 18;

/* Accent Green - Interactive elements, highlights */
--color-accent: #5fdf81;
--color-accent-rgb: 95, 223, 129;

/* Light Green - Secondary accent, hover states */
--color-accent-light: #b0eaa9;
--color-accent-light-rgb: 176, 234, 169;
```

### Neutrals

```css
/* Black & Dark Grays */
--color-black: #000000;
--color-gray-900: #0a0a0a;
--color-gray-850: #0f0f0f;
--color-gray-800: #171717;
--color-gray-750: #1e1e1e;
--color-gray-700: #1f1f1f;

/* Medium Grays */
--color-gray-600: #283832;
--color-gray-500: #444444;
--color-gray-400: #525252;
--color-gray-300: #737373;

/* Light Grays */
--color-gray-200: #d9d9d9;
--color-gray-150: #ebebeb;
--color-gray-100: #f0f0f0;
--color-gray-75: #f1f1f1;
--color-gray-50: #f5f5f5;
--color-gray-25: #fafafa;

/* White */
--color-white: #ffffff;
```

### Accent & Semantic Colors

```css
/* Cream/Beige - Secondary backgrounds */
--color-cream: #f1e4c4;
--color-cream-dark: #d4b698;

/* Semantic Colors */
--color-success: #1ab682;
--color-success-light: #5ce038;
--color-error: #ef3c33;
--color-error-dark: #b63d36;
--color-warning: #f1ad2b;
--color-info: #007aeb;
--color-info-dark: #193ec6;

/* Additional Accent */
--color-mint: #f0fff4;
--color-pink: #efb3d9;
--color-navy: #001e4d;
--color-brown: #381d11;
```

### Color Usage Guidelines

**Primary Use Cases:**
- `--color-primary` (#0c2212): Backgrounds, headers, dark sections
- `--color-accent` (#5fdf81): CTAs, highlights, active states
- `--color-accent-light` (#b0eaa9): Hover states, lighter accents
- `--color-cream` (#f1e4c4): Warm backgrounds, contrast sections

**Text Colors:**
- Primary text: `--color-black` or `--color-gray-900`
- Secondary text: `--color-gray-300` or `--color-gray-400`
- Text on dark: `--color-white` or `--color-gray-25`
- Text on accent: `--color-primary` or `--color-black`

**Backgrounds:**
- Default: `--color-white`
- Dark sections: `--color-primary`, `--color-gray-800`
- Accent sections: `--color-cream`, `--color-mint`
- Overlays: `--color-black` with opacity

---

## Spacing System

### Base Unit: 8px

FlexIQ uses an 8-point spacing system for consistent spacing and alignment.

```css
--spacing-1: 8px;     /* 0.5rem */
--spacing-2: 16px;    /* 1rem */
--spacing-3: 24px;    /* 1.5rem */
--spacing-4: 32px;    /* 2rem */
--spacing-5: 40px;    /* 2.5rem */
--spacing-6: 48px;    /* 3rem */
--spacing-8: 64px;    /* 4rem */
--spacing-10: 80px;   /* 5rem */
--spacing-12: 96px;   /* 6rem */
--spacing-16: 128px;  /* 8rem */
--spacing-20: 160px;  /* 10rem */
--spacing-24: 192px;  /* 12rem */
--spacing-32: 256px;  /* 16rem */
```

### Layout Spacing

```css
/* Section spacing */
--section-padding-y: 96px;     /* Vertical padding for sections */
--section-padding-x: 48px;     /* Horizontal padding for sections */
--section-gap: 128px;          /* Gap between major sections */

/* Component spacing */
--component-gap: 48px;         /* Gap between components */
--card-padding: 32px;          /* Internal card padding */
--card-gap: 24px;              /* Gap between cards */

/* Inline spacing */
--inline-gap-sm: 16px;         /* Small inline gaps */
--inline-gap-md: 24px;         /* Medium inline gaps */
--inline-gap-lg: 32px;         /* Large inline gaps */
```

### Container Widths

```css
--container-sm: 640px;
--container-md: 768px;
--container-lg: 1024px;
--container-xl: 1280px;
--container-2xl: 1536px;
--container-max: 1920px;
```

---

## Components

### Buttons

#### Primary Button (Dark)
```css
.button-primary {
  background: var(--color-gray-800);  /* #171717 */
  color: var(--color-white);
  border-radius: 9999px;              /* Fully rounded */
  padding: 16px 32px;
  font-family: 'Satoshi', sans-serif;
  font-weight: 700;
  font-size: 87px;
  line-height: 157px;
  letter-spacing: -2.62px;
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
}

.button-primary:hover {
  background: var(--color-black);
  transform: translateY(-2px);
}

.button-primary:active {
  transform: translateY(0);
}

.button-primary:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}
```

#### Secondary Button (Outlined)
```css
.button-secondary {
  background: rgba(255, 255, 255, 0.1);
  color: var(--color-white);
  border: 2px solid var(--color-gray-200);  /* #d4d4d4 */
  border-radius: 9999px;
  padding: 16px 32px;
  font-family: 'Satoshi', sans-serif;
  font-weight: 700;
  font-size: 87px;
  line-height: 157px;
  letter-spacing: -2.62px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.button-secondary:hover {
  background: rgba(255, 255, 255, 0.2);
  border-color: var(--color-white);
}
```

#### Accent Button (Green)
```css
.button-accent {
  background: var(--color-accent-light);  /* #b0eaa9 */
  color: var(--color-primary);
  border-radius: 9999px;
  padding: 16px 32px;
  font-family: 'Satoshi', sans-serif;
  font-weight: 700;
  font-size: 87px;
  line-height: 157px;
  letter-spacing: -2.62px;
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
}

.button-accent:hover {
  background: var(--color-accent);  /* #5fdf81 */
}
```

### Navigation

#### Main Navigation
```css
.nav-main {
  background: var(--color-white);
  padding: 24px 48px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.nav-item {
  font-family: 'Satoshi', sans-serif;
  font-weight: 700;
  font-size: 112px;
  line-height: 129px;
  letter-spacing: -2.24px;
  color: var(--color-black);
  text-decoration: none;
  transition: color 0.3s ease;
}

.nav-item:hover {
  color: var(--color-accent);
}

.nav-item.active {
  color: var(--color-primary);
}
```

### Cards

```css
.card {
  background: var(--color-white);
  border-radius: 20px;
  padding: 32px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
}

.card:hover {
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
  transform: translateY(-4px);
}

.card-title {
  font-family: 'Satoshi', sans-serif;
  font-weight: 700;
  font-size: 120px;
  line-height: 216px;
  letter-spacing: -3.6px;
  color: var(--color-black);
  margin-bottom: 24px;
}

.card-body {
  font-family: 'Satoshi', sans-serif;
  font-weight: 500;
  font-size: 56px;
  line-height: 101px;
  letter-spacing: -1.68px;
  color: var(--color-gray-300);
}
```

### Hero Section

```css
.hero {
  background: var(--color-primary);
  color: var(--color-white);
  padding: 128px 48px;
  text-align: center;
}

.hero-title {
  font-family: 'Satoshi', sans-serif;
  font-weight: 900;
  font-size: 182px;
  line-height: 209px;
  letter-spacing: -5.46px;
  margin-bottom: 32px;
}

.hero-subtitle {
  font-family: 'Satoshi', sans-serif;
  font-weight: 700;
  font-size: 96px;
  line-height: 96px;
  letter-spacing: -1.92px;
  opacity: 0.9;
}
```

### Footer

```css
.footer {
  background: var(--color-primary);
  color: var(--color-white);
  padding: 64px 48px 32px;
}

.footer-text {
  font-family: 'Satoshi', sans-serif;
  font-weight: 500;
  font-size: 48px;
  line-height: 86px;
  letter-spacing: -1.44px;
  opacity: 0.8;
}
```

---

## Design Tokens

### Border Radius

```css
--radius-sm: 4px;
--radius-md: 8px;
--radius-lg: 20px;
--radius-xl: 48px;
--radius-2xl: 80px;
--radius-full: 9999px;      /* Fully rounded (buttons) */
```

### Shadows

```css
/* Elevation system */
--shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.04);
--shadow-md: 0 4px 8px rgba(0, 0, 0, 0.06);
--shadow-lg: 0 8px 16px rgba(0, 0, 0, 0.08);
--shadow-xl: 0 12px 24px rgba(0, 0, 0, 0.1);
--shadow-2xl: 0 24px 48px rgba(0, 0, 0, 0.12);

/* Specific use cases */
--shadow-card: 0 4px 16px rgba(0, 0, 0, 0.08);
--shadow-card-hover: 0 8px 24px rgba(0, 0, 0, 0.12);
--shadow-button: 0 2px 8px rgba(0, 0, 0, 0.1);
```

### Transitions

```css
--transition-fast: 150ms ease;
--transition-base: 300ms ease;
--transition-slow: 500ms ease;

/* Easing functions */
--ease-in: cubic-bezier(0.4, 0, 1, 1);
--ease-out: cubic-bezier(0, 0, 0.2, 1);
--ease-in-out: cubic-bezier(0.4, 0, 0.2, 1);
```

### Z-Index Scale

```css
--z-base: 0;
--z-dropdown: 100;
--z-sticky: 200;
--z-fixed: 300;
--z-modal-backdrop: 400;
--z-modal: 500;
--z-popover: 600;
--z-tooltip: 700;
```

---

## CSS Custom Properties

Complete CSS custom properties file for the FlexIQ design system:

```css
:root {
  /* Colors - Primary */
  --color-primary: #0c2212;
  --color-accent: #5fdf81;
  --color-accent-light: #b0eaa9;
  
  /* Colors - Neutrals */
  --color-black: #000000;
  --color-white: #ffffff;
  --color-gray-900: #0a0a0a;
  --color-gray-850: #0f0f0f;
  --color-gray-800: #171717;
  --color-gray-750: #1e1e1e;
  --color-gray-700: #1f1f1f;
  --color-gray-600: #283832;
  --color-gray-500: #444444;
  --color-gray-400: #525252;
  --color-gray-300: #737373;
  --color-gray-200: #d9d9d9;
  --color-gray-150: #ebebeb;
  --color-gray-100: #f0f0f0;
  --color-gray-75: #f1f1f1;
  --color-gray-50: #f5f5f5;
  --color-gray-25: #fafafa;
  
  /* Colors - Accent & Semantic */
  --color-cream: #f1e4c4;
  --color-cream-dark: #d4b698;
  --color-success: #1ab682;
  --color-success-light: #5ce038;
  --color-error: #ef3c33;
  --color-error-dark: #b63d36;
  --color-warning: #f1ad2b;
  --color-info: #007aeb;
  --color-info-dark: #193ec6;
  --color-mint: #f0fff4;
  --color-pink: #efb3d9;
  --color-navy: #001e4d;
  --color-brown: #381d11;
  
  /* Typography - Font Families */
  --font-primary: 'Satoshi', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  
  /* Typography - Font Sizes (scaled for web) */
  --text-xs: 0.75rem;   /* 12px */
  --text-sm: 0.875rem;  /* 14px */
  --text-base: 1rem;    /* 16px */
  --text-lg: 1.125rem;  /* 18px */
  --text-xl: 1.25rem;   /* 20px */
  --text-2xl: 1.5rem;   /* 24px */
  --text-3xl: 1.875rem; /* 30px */
  --text-4xl: 2.25rem;  /* 36px */
  --text-5xl: 3rem;     /* 48px */
  --text-6xl: 3.75rem;  /* 60px */
  --text-7xl: 4.5rem;   /* 72px */
  --text-8xl: 6rem;     /* 96px */
  --text-9xl: 8rem;     /* 128px */
  
  /* Typography - Font Weights */
  --font-regular: 400;
  --font-medium: 500;
  --font-semibold: 600;
  --font-bold: 700;
  --font-black: 900;
  
  /* Typography - Line Heights */
  --leading-none: 1;
  --leading-tight: 1.15;
  --leading-snug: 1.2;
  --leading-normal: 1.5;
  --leading-relaxed: 1.8;
  
  /* Spacing */
  --spacing-1: 0.5rem;   /* 8px */
  --spacing-2: 1rem;     /* 16px */
  --spacing-3: 1.5rem;   /* 24px */
  --spacing-4: 2rem;     /* 32px */
  --spacing-5: 2.5rem;   /* 40px */
  --spacing-6: 3rem;     /* 48px */
  --spacing-8: 4rem;     /* 64px */
  --spacing-10: 5rem;    /* 80px */
  --spacing-12: 6rem;    /* 96px */
  --spacing-16: 8rem;    /* 128px */
  --spacing-20: 10rem;   /* 160px */
  --spacing-24: 12rem;   /* 192px */
  --spacing-32: 16rem;   /* 256px */
  
  /* Layout */
  --container-sm: 640px;
  --container-md: 768px;
  --container-lg: 1024px;
  --container-xl: 1280px;
  --container-2xl: 1536px;
  --container-max: 1920px;
  
  /* Border Radius */
  --radius-sm: 4px;
  --radius-md: 8px;
  --radius-lg: 20px;
  --radius-xl: 48px;
  --radius-2xl: 80px;
  --radius-full: 9999px;
  
  /* Shadows */
  --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.04);
  --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.06);
  --shadow-lg: 0 8px 16px rgba(0, 0, 0, 0.08);
  --shadow-xl: 0 12px 24px rgba(0, 0, 0, 0.1);
  --shadow-2xl: 0 24px 48px rgba(0, 0, 0, 0.12);
  --shadow-card: 0 4px 16px rgba(0, 0, 0, 0.08);
  --shadow-card-hover: 0 8px 24px rgba(0, 0, 0, 0.12);
  
  /* Transitions */
  --transition-fast: 150ms ease;
  --transition-base: 300ms ease;
  --transition-slow: 500ms ease;
  
  /* Z-Index */
  --z-base: 0;
  --z-dropdown: 100;
  --z-sticky: 200;
  --z-fixed: 300;
  --z-modal-backdrop: 400;
  --z-modal: 500;
  --z-popover: 600;
  --z-tooltip: 700;
}
```

---

## WordPress theme.json

Complete WordPress `theme.json` structure for FlexIQ:

```json
{
  "$schema": "https://schemas.wp.org/trunk/theme.json",
  "version": 2,
  "settings": {
    "color": {
      "palette": [
        {
          "slug": "primary",
          "color": "#0c2212",
          "name": "Primary Dark Green"
        },
        {
          "slug": "accent",
          "color": "#5fdf81",
          "name": "Accent Green"
        },
        {
          "slug": "accent-light",
          "color": "#b0eaa9",
          "name": "Light Green"
        },
        {
          "slug": "black",
          "color": "#000000",
          "name": "Black"
        },
        {
          "slug": "white",
          "color": "#ffffff",
          "name": "White"
        },
        {
          "slug": "gray-900",
          "color": "#0a0a0a",
          "name": "Gray 900"
        },
        {
          "slug": "gray-800",
          "color": "#171717",
          "name": "Gray 800"
        },
        {
          "slug": "gray-600",
          "color": "#283832",
          "name": "Gray 600"
        },
        {
          "slug": "gray-500",
          "color": "#444444",
          "name": "Gray 500"
        },
        {
          "slug": "gray-400",
          "color": "#525252",
          "name": "Gray 400"
        },
        {
          "slug": "gray-300",
          "color": "#737373",
          "name": "Gray 300"
        },
        {
          "slug": "gray-200",
          "color": "#d9d9d9",
          "name": "Gray 200"
        },
        {
          "slug": "gray-100",
          "color": "#f0f0f0",
          "name": "Gray 100"
        },
        {
          "slug": "gray-50",
          "color": "#f5f5f5",
          "name": "Gray 50"
        },
        {
          "slug": "cream",
          "color": "#f1e4c4",
          "name": "Cream"
        },
        {
          "slug": "cream-dark",
          "color": "#d4b698",
          "name": "Dark Cream"
        },
        {
          "slug": "success",
          "color": "#1ab682",
          "name": "Success"
        },
        {
          "slug": "error",
          "color": "#ef3c33",
          "name": "Error"
        },
        {
          "slug": "warning",
          "color": "#f1ad2b",
          "name": "Warning"
        },
        {
          "slug": "info",
          "color": "#007aeb",
          "name": "Info"
        }
      ],
      "gradients": [],
      "duotone": [],
      "custom": true,
      "customGradient": true,
      "customDuotone": true,
      "defaultPalette": false,
      "defaultGradients": false,
      "defaultDuotone": false
    },
    "typography": {
      "fontFamilies": [
        {
          "fontFamily": "Satoshi, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif",
          "name": "Satoshi",
          "slug": "satoshi"
        }
      ],
      "fontSizes": [
        {
          "slug": "xs",
          "size": "0.75rem",
          "name": "Extra Small"
        },
        {
          "slug": "sm",
          "size": "0.875rem",
          "name": "Small"
        },
        {
          "slug": "base",
          "size": "1rem",
          "name": "Base"
        },
        {
          "slug": "lg",
          "size": "1.125rem",
          "name": "Large"
        },
        {
          "slug": "xl",
          "size": "1.25rem",
          "name": "Extra Large"
        },
        {
          "slug": "2xl",
          "size": "1.5rem",
          "name": "2X Large"
        },
        {
          "slug": "3xl",
          "size": "1.875rem",
          "name": "3X Large"
        },
        {
          "slug": "4xl",
          "size": "2.25rem",
          "name": "4X Large"
        },
        {
          "slug": "5xl",
          "size": "3rem",
          "name": "5X Large"
        },
        {
          "slug": "6xl",
          "size": "3.75rem",
          "name": "6X Large"
        },
        {
          "slug": "7xl",
          "size": "4.5rem",
          "name": "7X Large"
        },
        {
          "slug": "8xl",
          "size": "6rem",
          "name": "8X Large"
        },
        {
          "slug": "9xl",
          "size": "8rem",
          "name": "9X Large"
        }
      ],
      "fontWeights": [
        {
          "slug": "regular",
          "weight": "400",
          "name": "Regular"
        },
        {
          "slug": "medium",
          "weight": "500",
          "name": "Medium"
        },
        {
          "slug": "semibold",
          "weight": "600",
          "name": "Semibold"
        },
        {
          "slug": "bold",
          "weight": "700",
          "name": "Bold"
        },
        {
          "slug": "black",
          "weight": "900",
          "name": "Black"
        }
      ],
      "lineHeight": true,
      "customFontSize": true,
      "fluid": true
    },
    "spacing": {
      "spacingScale": {
        "steps": 0
      },
      "spacingSizes": [
        {
          "slug": "1",
          "size": "0.5rem",
          "name": "1"
        },
        {
          "slug": "2",
          "size": "1rem",
          "name": "2"
        },
        {
          "slug": "3",
          "size": "1.5rem",
          "name": "3"
        },
        {
          "slug": "4",
          "size": "2rem",
          "name": "4"
        },
        {
          "slug": "5",
          "size": "2.5rem",
          "name": "5"
        },
        {
          "slug": "6",
          "size": "3rem",
          "name": "6"
        },
        {
          "slug": "8",
          "size": "4rem",
          "name": "8"
        },
        {
          "slug": "10",
          "size": "5rem",
          "name": "10"
        },
        {
          "slug": "12",
          "size": "6rem",
          "name": "12"
        },
        {
          "slug": "16",
          "size": "8rem",
          "name": "16"
        },
        {
          "slug": "20",
          "size": "10rem",
          "name": "20"
        }
      ],
      "units": ["px", "em", "rem", "vh", "vw", "%"],
      "padding": true,
      "margin": true,
      "blockGap": true,
      "customSpacingSize": true
    },
    "layout": {
      "contentSize": "1280px",
      "wideSize": "1536px"
    },
    "custom": {
      "spacing": {
        "section-padding-y": "6rem",
        "section-padding-x": "3rem",
        "section-gap": "8rem",
        "component-gap": "3rem",
        "card-padding": "2rem",
        "card-gap": "1.5rem"
      },
      "borderRadius": {
        "sm": "4px",
        "md": "8px",
        "lg": "20px",
        "xl": "48px",
        "2xl": "80px",
        "full": "9999px"
      },
      "shadows": {
        "sm": "0 1px 2px rgba(0, 0, 0, 0.04)",
        "md": "0 4px 8px rgba(0, 0, 0, 0.06)",
        "lg": "0 8px 16px rgba(0, 0, 0, 0.08)",
        "xl": "0 12px 24px rgba(0, 0, 0, 0.1)",
        "2xl": "0 24px 48px rgba(0, 0, 0, 0.12)",
        "card": "0 4px 16px rgba(0, 0, 0, 0.08)",
        "card-hover": "0 8px 24px rgba(0, 0, 0, 0.12)"
      },
      "transitions": {
        "fast": "150ms ease",
        "base": "300ms ease",
        "slow": "500ms ease"
      }
    }
  },
  "styles": {
    "color": {
      "background": "var(--wp--preset--color--white)",
      "text": "var(--wp--preset--color--black)"
    },
    "typography": {
      "fontFamily": "var(--wp--preset--font-family--satoshi)",
      "fontSize": "var(--wp--preset--font-size--base)",
      "fontWeight": "var(--wp--custom--font-weight--regular)",
      "lineHeight": "1.5"
    },
    "spacing": {
      "padding": {
        "top": "0",
        "right": "var(--wp--preset--spacing--4)",
        "bottom": "0",
        "left": "var(--wp--preset--spacing--4)"
      },
      "blockGap": "var(--wp--preset--spacing--4)"
    },
    "elements": {
      "link": {
        "color": {
          "text": "var(--wp--preset--color--primary)"
        },
        ":hover": {
          "color": {
            "text": "var(--wp--preset--color--accent)"
          }
        }
      },
      "h1": {
        "typography": {
          "fontFamily": "var(--wp--preset--font-family--satoshi)",
          "fontSize": "var(--wp--preset--font-size--8xl)",
          "fontWeight": "900",
          "lineHeight": "1.15",
          "letterSpacing": "-0.03em"
        }
      },
      "h2": {
        "typography": {
          "fontFamily": "var(--wp--preset--font-family--satoshi)",
          "fontSize": "var(--wp--preset--font-size--7xl)",
          "fontWeight": "900",
          "lineHeight": "1.2",
          "letterSpacing": "-0.02em"
        }
      },
      "h3": {
        "typography": {
          "fontFamily": "var(--wp--preset--font-family--satoshi)",
          "fontSize": "var(--wp--preset--font-size--6xl)",
          "fontWeight": "700",
          "lineHeight": "1.8",
          "letterSpacing": "-0.03em"
        }
      },
      "h4": {
        "typography": {
          "fontFamily": "var(--wp--preset--font-family--satoshi)",
          "fontSize": "var(--wp--preset--font-size--5xl)",
          "fontWeight": "900",
          "lineHeight": "1",
          "letterSpacing": "-0.02em"
        }
      },
      "h5": {
        "typography": {
          "fontFamily": "var(--wp--preset--font-family--satoshi)",
          "fontSize": "var(--wp--preset--font-size--4xl)",
          "fontWeight": "700",
          "lineHeight": "1.8",
          "letterSpacing": "-0.03em"
        }
      },
      "h6": {
        "typography": {
          "fontFamily": "var(--wp--preset--font-family--satoshi)",
          "fontSize": "var(--wp--preset--font-size--3xl)",
          "fontWeight": "700",
          "lineHeight": "1.2",
          "letterSpacing": "-0.02em"
        }
      },
      "button": {
        "color": {
          "background": "var(--wp--preset--color--gray-800)",
          "text": "var(--wp--preset--color--white)"
        },
        "typography": {
          "fontFamily": "var(--wp--preset--font-family--satoshi)",
          "fontSize": "var(--wp--preset--font-size--xl)",
          "fontWeight": "700",
          "letterSpacing": "-0.03em"
        },
        "border": {
          "radius": "9999px"
        },
        "spacing": {
          "padding": {
            "top": "1rem",
            "right": "2rem",
            "bottom": "1rem",
            "left": "2rem"
          }
        },
        ":hover": {
          "color": {
            "background": "var(--wp--preset--color--black)"
          }
        }
      }
    },
    "blocks": {
      "core/button": {
        "border": {
          "radius": "9999px"
        },
        "color": {
          "background": "var(--wp--preset--color--gray-800)",
          "text": "var(--wp--preset--color--white)"
        },
        "typography": {
          "fontWeight": "700"
        }
      },
      "core/heading": {
        "typography": {
          "fontFamily": "var(--wp--preset--font-family--satoshi)"
        }
      }
    }
  }
}
```

---

## Implementation Notes

### Font Loading

To use Satoshi font in your WordPress theme or website, you'll need to include it via:

1. **Self-hosted:** Download Satoshi and add to `/fonts/` directory
2. **CDN:** Use a font CDN service

Example CSS for self-hosted:

```css
@font-face {
  font-family: 'Satoshi';
  src: url('/fonts/Satoshi-Regular.woff2') format('woff2'),
       url('/fonts/Satoshi-Regular.woff') format('woff');
  font-weight: 400;
  font-style: normal;
  font-display: swap;
}

@font-face {
  font-family: 'Satoshi';
  src: url('/fonts/Satoshi-Medium.woff2') format('woff2'),
       url('/fonts/Satoshi-Medium.woff') format('woff');
  font-weight: 500;
  font-style: normal;
  font-display: swap;
}

@font-face {
  font-family: 'Satoshi';
  src: url('/fonts/Satoshi-Bold.woff2') format('woff2'),
       url('/fonts/Satoshi-Bold.woff') format('woff');
  font-weight: 700;
  font-style: normal;
  font-display: swap;
}

@font-face {
  font-family: 'Satoshi';
  src: url('/fonts/Satoshi-Black.woff2') format('woff2'),
       url('/fonts/Satoshi-Black.woff') format('woff');
  font-weight: 900;
  font-style: normal;
  font-display: swap;
}
```

### Responsive Typography

The Figma design uses very large font sizes. For web implementation, you should use a responsive scale. Here's a suggested approach:

```css
/* Mobile-first approach */
:root {
  --text-hero: clamp(2rem, 5vw, 4rem);
  --text-h1: clamp(1.875rem, 4vw, 3.75rem);
  --text-h2: clamp(1.5rem, 3vw, 3rem);
  --text-h3: clamp(1.25rem, 2.5vw, 2.25rem);
  --text-h4: clamp(1.125rem, 2vw, 1.875rem);
  --text-body-lg: clamp(1rem, 1.5vw, 1.25rem);
  --text-body: clamp(0.875rem, 1.25vw, 1rem);
}
```

### Accessibility Considerations

1. **Color Contrast:** Ensure all text meets WCAG AA standards (4.5:1 for normal text, 3:1 for large text)
2. **Focus States:** Add visible focus indicators for keyboard navigation
3. **Minimum Touch Targets:** Ensure buttons are at least 44x44px for mobile
4. **Semantic HTML:** Use proper heading hierarchy (H1→H2→H3, etc.)

### Performance Recommendations

1. **Font Loading:** Use `font-display: swap` to prevent FOIT (Flash of Invisible Text)
2. **Subset Fonts:** Only include required character sets and weights
3. **CSS Variables:** Use CSS custom properties for easy theming and dark mode
4. **Image Optimization:** Compress and use modern formats (WebP, AVIF)

---

## Version History

- **v1.0** (2026-02-11): Initial design system documentation extracted from Figma

---

## Resources

- **Figma File:** [FlexIQ Design](https://www.figma.com/design/rGJampH62z4wondvSJlcIg/FlexIQ?node-id=120-16369)
- **Satoshi Font:** [Font source/license information]
- **WordPress Documentation:** [Block Editor Handbook](https://developer.wordpress.org/block-editor/)

---

*This design system document was generated through READ-ONLY analysis of the FlexIQ Figma file. No modifications were made to the original design.*
