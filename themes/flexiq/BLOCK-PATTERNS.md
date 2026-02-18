# FlexIQ Block Patterns Documentation

**Version:** 1.0  
**Created:** 2026-02-11  
**Theme:** FlexIQ

---

## Overview

This document describes the WordPress Block Patterns created for the FlexIQ theme. These patterns provide ready-to-use sections that follow the FlexIQ design system and include Swedish content optimized for tech recruitment.

All patterns are **drag-and-drop ready** in the WordPress block inserter and can be customized through the block editor.

---

## Available Patterns

### 1. Hero Section (`flexiq/hero`)

**File:** `patterns/flexiq-hero.php`  
**Category:** FlexIQ Patterns, Featured  
**Use case:** Homepage hero section with main headline and CTAs

**Features:**
- Large headline: "Hitta rätt tech-talang. Snabbt."
- Descriptive subtitle about FlexIQ's services
- Two CTA buttons:
  - Primary (Accent): "Berätta om ert behov"
  - Secondary (Outlined): "Se hur vi jobbar"
- Dark primary background (#0c2212)
- Full-width cover block
- Centered content layout

**Design System Integration:**
- Typography: Hero title (900 weight, -3% letter-spacing)
- Colors: Primary background, white text
- Buttons: Accent and secondary styles
- Spacing: Section padding with responsive values

**Customization:**
- Edit headline and subtitle text
- Change CTA button links (default: #contact, #services)
- Adjust background image or color
- Modify spacing via block settings

---

### 2. Services 3-Column (`flexiq/services`)

**File:** `patterns/flexiq-services.php`  
**Category:** FlexIQ Patterns  
**Use case:** Display three service offerings in a card grid

**Features:**
- Section heading: "Så hjälper vi er"
- Three service cards:
  1. **Rekrytering** - Long-term hiring solution
  2. **Bemanning & Konsulter** - Flexible staffing
  3. **Tech Talent Search** - Executive search/headhunting
- Each card includes:
  - Service name (H3)
  - Tagline (H4)
  - Description paragraph
  - "Passar er som" (Use case) callout
- CTA button at bottom: "Boka ett kostnadsfritt samtal"

**Design System Integration:**
- Card component styling with hover effects
- Shadow and border-radius from design tokens
- Typography scale: H2, H3, H4, body text
- Spacing: Card padding and gap system
- Colors: White background, gray text for secondary info

**Customization:**
- Edit service descriptions
- Add/remove service columns
- Change card styling (background, shadow)
- Modify CTA button link and text
- Adjust grid gap and column width

---

### 3. About Section (`flexiq/about`)

**File:** `patterns/flexiq-about.php`  
**Category:** FlexIQ Patterns  
**Use case:** Company introduction / "Om oss" section

**Features:**
- Section heading: "Vem vi är"
- Three paragraphs describing FlexIQ:
  - Company mission and differentiation
  - Working method (no mass applications)
  - Value proposition (speed, transparency, experience)
- CTA button: "Läs mer om vårt arbetssätt →"
- Cream background (#f1e4c4) for visual contrast
- Constrained width (800px) for readability

**Design System Integration:**
- Typography: H2 heading, large body text (1.125rem-1.5rem)
- Colors: Cream background, black text
- Line height: 1.8 for readability
- Letter spacing: -3% for modern look
- Centered text alignment

**Customization:**
- Edit company description paragraphs
- Change background color
- Adjust content width constraint
- Modify CTA button link
- Add images or icons

---

### 4. Contact Section (`flexiq/contact`)

**File:** `patterns/flexiq-contact.php`  
**Category:** FlexIQ Patterns  
**Use case:** Contact information section with multiple channels

**Features:**
- Section heading: "Kontakta oss"
- Introductory text with response time promise (24h)
- Three contact method cards:
  - 📧 **E-post:** hej@flexiq.se
  - 📞 **Telefon:** +46 (0) 00 000 00 00
  - 📍 **Plats:** Stockholm, Sverige
- CTA button: "Skicka ett meddelande" (mailto link)
- ID anchor: `#contact` for internal navigation

**Design System Integration:**
- Card components with consistent styling
- Three-column grid layout
- Typography: H2, H3, body text
- Colors: White background, card shadows
- Spacing: Section and card padding

**Customization:**
- Update contact details (email, phone, location)
- Add/remove contact methods
- Replace emojis with icons
- Add contact form
- Modify grid layout (2-column for tablet, etc.)
- Update CTA button action

---

### 5. CTA Banner (`flexiq/cta`)

**File:** `patterns/flexiq-cta.php`  
**Category:** FlexIQ Patterns  
**Use case:** Call-to-action banner for conversion

**Features:**
- Bold headline: "Redo att bygga ert drömteam?"
- Value proposition subtitle
- Two CTA buttons:
  - Primary (Accent): "Boka kostnadsfritt samtal"
  - Secondary (Outlined): "Ring oss direkt"
- Dark primary background (#0c2212)
- White text for high contrast
- Centered content layout

**Design System Integration:**
- Typography: Large heading (H2, 3.75rem), XL body
- Colors: Primary background, white text
- Buttons: Accent and secondary styles
- Spacing: Reduced vertical padding (10 vs 12)

**Customization:**
- Edit headline and subtitle
- Change CTA button links
- Modify background color
- Adjust text alignment
- Add background image or gradient

---

## How to Use Block Patterns

### In WordPress Editor

1. **Create/Edit a page or post**
2. **Click the "+" (Add block) button**
3. **Click the "Patterns" tab**
4. **Select "FlexIQ Patterns" category**
5. **Click on the pattern you want to insert**
6. **Customize the content** using the block editor

### Pattern Registration

All patterns are automatically registered via `functions.php`:

```php
function flexiq_register_block_patterns() {
    register_block_pattern_category(
        'flexiq',
        array( 'label' => __( 'FlexIQ Patterns', 'flexiq' ) )
    );
    
    $pattern_files = array(
        'flexiq-hero.php',
        'flexiq-services.php',
        'flexiq-about.php',
        'flexiq-contact.php',
        'flexiq-cta.php',
    );
    
    foreach ( $pattern_files as $pattern_file ) {
        $pattern_path = get_template_directory() . '/patterns/' . $pattern_file;
        if ( file_exists( $pattern_path ) ) {
            require $pattern_path;
        }
    }
}
add_action( 'init', 'flexiq_register_block_patterns' );
```

### Creating New Patterns

To create additional block patterns:

1. **Create a new PHP file** in `patterns/` directory
2. **Add pattern header:**
   ```php
   <?php
   /**
    * Title: Pattern Name
    * Slug: flexiq/pattern-slug
    * Categories: flexiq
    * Description: Pattern description
    */
   ?>
   ```
3. **Add WordPress block markup** (HTML comments format)
4. **Register in functions.php** by adding filename to `$pattern_files` array
5. **Test in block editor**

---

## Design System Integration

### CSS Classes Used

All patterns integrate with the FlexIQ design system via CSS classes and custom properties:

**From `design-system.css`:**
- Color variables: `--color-primary`, `--color-accent`, `--color-cream`, etc.
- Spacing variables: `--spacing-*`, `--section-padding-*`
- Typography variables: `--text-*`, `--font-*`, `--leading-*`

**From `components.css`:**
- `.hero` - Hero section styling
- `.is-style-card` - Card component style
- `.button-primary`, `.button-secondary`, `.button-accent` - Button styles
- `.section` - Standard section padding

**WordPress Block Styles:**
- `.is-style-hero` - Applied to wp:cover for hero sections
- `.is-style-primary` - Primary button style
- `.is-style-secondary` - Secondary button style
- `.is-style-accent` - Accent button style
- `.is-style-card` - Card container style

### Responsive Design

All patterns use responsive units and spacing:

- **Typography:** `clamp()` functions for fluid font sizes
- **Spacing:** CSS custom properties that adjust via media queries
- **Layout:** WordPress core responsive grid (wp:columns)
- **Breakpoints:**
  - Mobile: < 480px
  - Tablet: < 768px
  - Desktop: > 768px

---

## Swedish Content Guidelines

All patterns use Swedish content following FlexIQ's tone of voice:

**Tone:**
- Professional but conversational
- Specific, not fluffy ("generiska annonser" → concrete)
- Focus on customer benefit
- Use "ni" and "vi" (personal)

**Key Phrases:**
- "Hitta rätt tech-talang. Snabbt."
- "Snabbt, transparent och utan krångel"
- "Rekryteringsbyrån som förstår tech"

**CTA Variations:**
- Primary: "Berätta om ert behov", "Boka kostnadsfritt samtal"
- Secondary: "Se hur vi jobbar", "Läs mer"
- Action: "Skicka ett meddelande", "Ring oss direkt"

---

## Testing Checklist

Before deploying patterns, verify:

- [ ] All patterns appear in block inserter
- [ ] Pattern category "FlexIQ Patterns" is visible
- [ ] Content is in Swedish
- [ ] Typography scales responsively
- [ ] Colors match design system
- [ ] Buttons have correct styles (primary/secondary/accent)
- [ ] Cards have hover effects
- [ ] Spacing is consistent
- [ ] Links work correctly
- [ ] Patterns work on mobile/tablet/desktop
- [ ] Patterns are editable in block editor

---

## File Structure

```
themes/flexiq/
├── patterns/
│   ├── flexiq-hero.php
│   ├── flexiq-services.php
│   ├── flexiq-about.php
│   ├── flexiq-contact.php
│   └── flexiq-cta.php
├── functions.php (pattern registration)
├── assets/
│   └── css/
│       ├── design-system.css
│       └── components.css
└── BLOCK-PATTERNS.md (this file)
```

---

## Troubleshooting

### Patterns Not Showing in Editor

1. Check that `functions.php` has pattern registration code
2. Verify pattern files exist in `patterns/` directory
3. Ensure pattern header is correct (Title, Slug, Categories)
4. Clear WordPress cache
5. Check browser console for errors

### Styling Issues

1. Verify `design-system.css` and `components.css` are enqueued
2. Check that CSS custom properties are defined in `:root`
3. Inspect element to see if classes are applied
4. Test with WordPress default theme to rule out conflicts
5. Check `theme.json` color palette registration

### Content Not Updating

1. Patterns are templates - editing one instance doesn't affect others
2. To update all uses, edit the pattern file and re-insert
3. Consider using Reusable Blocks for globally synced content

---

## Version History

- **v1.0** (2026-02-11): Initial block patterns created
  - Hero section
  - Services 3-column
  - About section
  - Contact section
  - CTA banner

---

## Resources

- **WordPress Block Editor Handbook:** [developer.wordpress.org/block-editor](https://developer.wordpress.org/block-editor/)
- **Block Patterns Guide:** [developer.wordpress.org/block-editor/reference-guides/block-api/block-patterns](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-patterns/)
- **FlexIQ Design System:** `/docs/design-system.md`
- **Website Content:** `flexiq-website-content.md`

---

**Maintained by:** FlexIQ Development Team  
**Last Updated:** 2026-02-11
