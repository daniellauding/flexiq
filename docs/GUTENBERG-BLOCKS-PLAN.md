# FlexIQ Gutenberg Blocks Architecture Plan

**Project:** FlexIQ WordPress Block Theme  
**WordPress Version:** 6.9.1  
**Theme Location:** `themes/flexiq/`  
**Status:** Planning Phase - NO CODE IMPLEMENTATION YET  
**Created:** 2026-02-11

---

## 📋 Executive Summary

This document outlines the complete Gutenberg block architecture for the FlexIQ block theme. All blocks are designed to integrate seamlessly with the existing `theme.json` design system and support Full Site Editing (FSE).

### Design System Foundation (from theme.json)

**Colors:**
- Primary: `#0F1B2D` (Dark blue)
- Secondary: `#2563EB` (Blue)
- Accent: `#06B6D4` (Cyan)
- Base: `#FFFFFF`
- Base Alt: `#F1F5F9`
- Contrast: `#0F172A`

**Typography:**
- Font Family: Inter (heading & body)
- Font Sizes: Fluid with clamp()
- Line Heights: 1.2 (headings), 1.6 (body)

**Spacing:**
- Scale: 0.25rem → 6rem (8 steps)
- Content Width: 800px
- Wide Width: 1200px

---

## 🏗️ Proposed File Structure

```
themes/flexiq/
├── style.css                          # Theme header
├── theme.json                         # Existing design system
├── functions.php                      # Block registration & theme setup
│
├── assets/
│   ├── css/
│   │   └── blocks/                   # Compiled block styles
│   │       ├── hero.css
│   │       ├── feature-cards.css
│   │       └── testimonials.css
│   ├── js/
│   │   └── blocks/                   # Compiled block scripts
│   └── fonts/                        # Inter fonts (already referenced)
│
├── src/                              # Source files (build target)
│   └── blocks/
│       ├── hero/
│       │   ├── block.json
│       │   ├── edit.js
│       │   ├── save.js
│       │   ├── index.js
│       │   ├── editor.scss
│       │   └── style.scss
│       ├── feature-cards/
│       ├── text-image-section/
│       ├── call-to-action/
│       ├── testimonials/
│       └── ...
│
├── inc/                              # PHP includes
│   ├── block-registration.php       # Register custom blocks
│   ├── block-patterns.php           # Register patterns
│   └── template-parts.php           # Template part logic
│
├── patterns/                         # Block patterns
│   ├── hero-homepage.php
│   ├── services-grid.php
│   ├── testimonials-section.php
│   └── contact-section.php
│
├── templates/                        # FSE templates
│   ├── index.html                    # Fallback
│   ├── front-page.html               # Homepage
│   ├── page.html                     # Pages
│   ├── single.html                   # Blog posts
│   ├── archive.html                  # Archives
│   ├── page-karriar.html             # Career page
│   └── page-kontakt.html             # Contact page
│
├── parts/                            # Template parts
│   ├── header.html                   # Navigation block (to be created)
│   ├── footer.html                   # Footer block (to be created)
│   └── sidebar.html
│
├── styles/                           # Style variations
│   └── professional-dark.json        # Optional dark mode
│
├── package.json                      # Build config
├── webpack.config.js                 # Custom webpack (optional)
└── README.md                         # Theme documentation
```

---

## 🧱 Block Architecture Overview

### Block Categories

```php
// Custom block category for FlexIQ blocks
register_block_category('flexiq', [
    'title' => __('FlexIQ Blocks', 'flexiq'),
    'icon'  => 'building',
]);
```

### Block Naming Convention

- **Namespace:** `flexiq/`
- **Format:** `flexiq/block-name`
- **Examples:** `flexiq/hero`, `flexiq/feature-cards`, `flexiq/testimonials`

---

## 1️⃣ Hero Block

### Purpose
Large, impactful section for homepage and landing pages with headline, subheading, CTA buttons, and background media support.

### Block Specification

**Block Name:** `flexiq/hero`  
**Category:** `flexiq`  
**Supports:** Full width alignment, background colors, spacing

### File Structure

```
src/blocks/hero/
├── block.json           # Block metadata
├── index.js             # Block registration
├── edit.js              # Editor component
├── save.js              # Frontend output
├── editor.scss          # Editor styles
└── style.scss           # Frontend styles
```

### block.json

```json
{
  "$schema": "https://schemas.wp.org/trunk/block.json",
  "apiVersion": 3,
  "name": "flexiq/hero",
  "title": "Hero",
  "category": "flexiq",
  "icon": "cover-image",
  "description": "Large hero section with headline, subheading, and CTA buttons",
  "keywords": ["hero", "banner", "cta", "header"],
  "version": "1.0.0",
  "textdomain": "flexiq",
  "supports": {
    "align": ["wide", "full"],
    "anchor": true,
    "color": {
      "background": true,
      "text": true,
      "gradients": true
    },
    "spacing": {
      "margin": true,
      "padding": true,
      "blockGap": true
    },
    "typography": {
      "fontSize": true,
      "lineHeight": true
    }
  },
  "attributes": {
    "headline": {
      "type": "string",
      "default": "Rätt kompetens vid rätt tillfälle"
    },
    "subheading": {
      "type": "string",
      "default": "FlexIQ hjälper företag att snabbt förstärka sin organisation med kvalificerade konsulter."
    },
    "backgroundType": {
      "type": "string",
      "enum": ["color", "image", "video", "gradient"],
      "default": "gradient"
    },
    "backgroundImage": {
      "type": "object",
      "default": null
    },
    "backgroundVideo": {
      "type": "string",
      "default": ""
    },
    "overlayOpacity": {
      "type": "number",
      "default": 0.3
    },
    "minHeight": {
      "type": "string",
      "default": "600px"
    },
    "contentAlignment": {
      "type": "string",
      "enum": ["left", "center", "right"],
      "default": "center"
    },
    "verticalAlignment": {
      "type": "string",
      "enum": ["top", "center", "bottom"],
      "default": "center"
    }
  },
  "editorScript": "file:./index.js",
  "editorStyle": "file:./editor.scss",
  "style": "file:./style.scss"
}
```

### Component Structure (Pseudo-code)

**edit.js:**
```javascript
// Edit component for Block Editor
import { useBlockProps, InspectorControls, InnerBlocks, MediaUpload } from '@wordpress/block-editor';
import { PanelBody, SelectControl, RangeControl, ToggleControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
  const { headline, subheading, backgroundType, minHeight, contentAlignment } = attributes;
  
  const blockProps = useBlockProps({
    className: `hero-block align-${contentAlignment}`,
    style: {
      minHeight: minHeight
    }
  });

  return (
    <>
      {/* Inspector Controls (Sidebar settings) */}
      <InspectorControls>
        <PanelBody title="Background Settings">
          <SelectControl
            label="Background Type"
            value={backgroundType}
            options={[
              { label: 'Color', value: 'color' },
              { label: 'Image', value: 'image' },
              { label: 'Video', value: 'video' },
              { label: 'Gradient', value: 'gradient' }
            ]}
            onChange={(value) => setAttributes({ backgroundType: value })}
          />
          
          {backgroundType === 'image' && (
            <MediaUpload
              onSelect={(media) => setAttributes({ backgroundImage: media })}
              render={({ open }) => <Button onClick={open}>Select Image</Button>}
            />
          )}
          
          <RangeControl
            label="Overlay Opacity"
            value={overlayOpacity}
            onChange={(value) => setAttributes({ overlayOpacity: value })}
            min={0}
            max={1}
            step={0.1}
          />
        </PanelBody>
        
        <PanelBody title="Layout">
          <SelectControl
            label="Content Alignment"
            value={contentAlignment}
            options={[
              { label: 'Left', value: 'left' },
              { label: 'Center', value: 'center' },
              { label: 'Right', value: 'right' }
            ]}
          />
        </PanelBody>
      </InspectorControls>

      {/* Block Content */}
      <div {...blockProps}>
        {/* Background Layer */}
        <div className="hero-background">
          {/* Render background based on type */}
        </div>
        
        {/* Content Container */}
        <div className="hero-content">
          <InnerBlocks
            template={[
              ['core/heading', { 
                level: 1, 
                placeholder: 'Enter headline...',
                fontSize: 'xx-large',
                textColor: 'base'
              }],
              ['core/paragraph', { 
                placeholder: 'Enter subheading...',
                fontSize: 'large',
                textColor: 'base'
              }],
              ['core/buttons', {
                layout: { type: 'flex', justifyContent: contentAlignment }
              }, [
                ['core/button', { 
                  text: 'För Företag',
                  backgroundColor: 'secondary'
                }],
                ['core/button', { 
                  text: 'Bli Konsult',
                  backgroundColor: 'accent'
                }]
              ]]
            ]}
            templateLock={false}
          />
        </div>
      </div>
    </>
  );
}
```

**save.js:**
```javascript
// Frontend output
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

export default function Save({ attributes }) {
  const { backgroundType, backgroundImage, minHeight, contentAlignment } = attributes;
  
  const blockProps = useBlockProps.save({
    className: `hero-block align-${contentAlignment}`,
    style: {
      minHeight: minHeight
    }
  });

  return (
    <div {...blockProps}>
      {/* Background layer with conditional rendering */}
      <div className="hero-background" data-background-type={backgroundType}>
        {backgroundType === 'image' && backgroundImage && (
          <img src={backgroundImage.url} alt="" />
        )}
        <div className="hero-overlay"></div>
      </div>
      
      <div className="hero-content">
        <InnerBlocks.Content />
      </div>
    </div>
  );
}
```

### Styling Strategy (SCSS)

**style.scss:**
```scss
// Frontend styles
.hero-block {
  position: relative;
  min-height: 600px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  
  .hero-background {
    position: absolute;
    inset: 0;
    z-index: 0;
    
    img, video {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    
    .hero-overlay {
      position: absolute;
      inset: 0;
      background: rgba(15, 27, 45, 0.3); // Use theme color with opacity
    }
  }
  
  .hero-content {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: var(--wp--style--global--wide-size);
    padding: var(--wp--preset--spacing--60) var(--wp--preset--spacing--30);
    text-align: center;
    
    &.align-left {
      text-align: left;
    }
    
    &.align-right {
      text-align: right;
    }
  }
  
  // Responsive
  @media (max-width: 768px) {
    min-height: 400px;
    
    .hero-content {
      padding: var(--wp--preset--spacing--50) var(--wp--preset--spacing--30);
    }
  }
}
```

### Block Pattern Integration

```php
<?php
/**
 * Title: Hero - Homepage
 * Slug: flexiq/hero-homepage
 * Categories: flexiq
 * Keywords: hero, homepage, banner
 */
?>
<!-- wp:flexiq/hero {"backgroundType":"gradient","minHeight":"700px","align":"full"} -->
<div class="wp-block-flexiq-hero alignfull">
  <!-- wp:heading {"level":1,"fontSize":"xx-large","textColor":"base"} -->
  <h1>Rätt kompetens vid rätt tillfälle</h1>
  <!-- /wp:heading -->
  
  <!-- wp:paragraph {"fontSize":"large","textColor":"base-alt"} -->
  <p>FlexIQ hjälper företag att snabbt förstärka sin organisation med kvalificerade konsulter.</p>
  <!-- /wp:paragraph -->
  
  <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
  <div class="wp-block-buttons">
    <!-- wp:button {"backgroundColor":"secondary"} -->
    <div class="wp-block-button"><a class="wp-block-button__link has-secondary-background-color">För Företag</a></div>
    <!-- /wp:button -->
    
    <!-- wp:button {"backgroundColor":"accent"} -->
    <div class="wp-block-button"><a class="wp-block-button__link has-accent-background-color">Bli Konsult</a></div>
    <!-- /wp:button -->
  </div>
  <!-- /wp:buttons -->
</div>
<!-- /wp:flexiq/hero -->
```

---

## 2️⃣ Header/Navigation Block

### Purpose
Custom header with logo placement, menu items, and mobile responsiveness. Integrates with WordPress navigation menus.

### Block Specification

**Type:** Template Part (parts/header.html) + Custom Block  
**Block Name:** `flexiq/header`  
**Approach:** Hybrid - Use core/navigation with custom wrapper block

### File Structure

```
parts/
└── header.html                  # Template part

src/blocks/header/
├── block.json
├── index.js
├── edit.js
├── save.js
└── style.scss
```

### Implementation Strategy

**Option 1: Pure Template Part (Recommended for FSE)**
Use core blocks in `parts/header.html`:

```html
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-background-color has-background">
  
  <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
  <div class="wp-block-group">
    
    <!-- wp:site-logo {"width":150} /-->
    
    <!-- wp:navigation {"layout":{"type":"flex","justifyContent":"right"},"fontSize":"small"} /-->
    
  </div>
  <!-- /wp:group -->
  
</div>
<!-- /wp:group -->
```

**Option 2: Custom Header Block**
If more control is needed:

```json
// block.json
{
  "apiVersion": 3,
  "name": "flexiq/header",
  "title": "FlexIQ Header",
  "category": "theme",
  "supports": {
    "align": ["full"],
    "color": {
      "background": true
    },
    "spacing": {
      "padding": true
    }
  },
  "attributes": {
    "logoSize": {
      "type": "number",
      "default": 150
    },
    "stickyHeader": {
      "type": "boolean",
      "default": true
    },
    "transparentOnScroll": {
      "type": "boolean",
      "default": false
    }
  }
}
```

### Styling (SCSS)

```scss
// Header styles
.site-header {
  position: sticky;
  top: 0;
  z-index: 100;
  background: var(--wp--preset--color--base);
  box-shadow: var(--wp--preset--shadow--sm);
  transition: var(--wp--custom--transition--default);
  
  &.is-transparent {
    background: transparent;
    
    &.is-scrolled {
      background: var(--wp--preset--color--base);
    }
  }
  
  .header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--wp--preset--spacing--30) var(--wp--preset--spacing--40);
    max-width: var(--wp--style--global--wide-size);
    margin: 0 auto;
  }
  
  .site-logo {
    a {
      display: block;
    }
    
    img {
      height: auto;
      max-width: 150px;
    }
  }
  
  // Navigation styles
  .wp-block-navigation {
    &__container {
      gap: var(--wp--preset--spacing--40);
    }
    
    &-item {
      a {
        font-family: var(--wp--preset--font-family--heading);
        font-weight: 500;
        font-size: var(--wp--preset--font-size--small);
        text-transform: uppercase;
        letter-spacing: 0.025em;
        color: var(--wp--preset--color--primary);
        text-decoration: none;
        padding: var(--wp--preset--spacing--20) var(--wp--preset--spacing--30);
        transition: var(--wp--custom--transition--default);
        
        &:hover,
        &:focus {
          color: var(--wp--preset--color--secondary);
        }
      }
      
      &.current-menu-item a {
        color: var(--wp--preset--color--secondary);
        font-weight: 600;
      }
    }
  }
  
  // Mobile menu toggle
  .wp-block-navigation__responsive-container-open,
  .wp-block-navigation__responsive-container-close {
    color: var(--wp--preset--color--primary);
  }
  
  // Mobile styles
  @media (max-width: 768px) {
    .header-container {
      padding: var(--wp--preset--spacing--20) var(--wp--preset--spacing--30);
    }
    
    .site-logo img {
      max-width: 120px;
    }
  }
}
```

### JavaScript Enhancement (Optional)

```javascript
// Add scroll behavior for transparent header
document.addEventListener('DOMContentLoaded', () => {
  const header = document.querySelector('.site-header');
  
  if (header && header.classList.contains('is-transparent')) {
    let lastScroll = 0;
    
    window.addEventListener('scroll', () => {
      const currentScroll = window.pageYOffset;
      
      if (currentScroll > 50) {
        header.classList.add('is-scrolled');
      } else {
        header.classList.remove('is-scrolled');
      }
      
      lastScroll = currentScroll;
    });
  }
});
```

---

## 3️⃣ Footer Block

### Purpose
Multi-column footer with company info, navigation links, social media, and copyright.

### Block Specification

**Type:** Template Part (parts/footer.html)  
**Approach:** Use core blocks with custom pattern

### File Structure

```
parts/
└── footer.html                  # Template part

patterns/
└── footer-default.php          # Footer pattern
```

### Template Part (footer.html)

```html
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|50"}}},"backgroundColor":"primary","textColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-primary-background-color has-base-color has-text-color has-background">
  
  <!-- wp:columns {"align":"wide"} -->
  <div class="wp-block-columns alignwide">
    
    <!-- wp:column -->
    <div class="wp-block-column">
      <!-- wp:heading {"level":3,"fontSize":"large","textColor":"base"} -->
      <h3>FlexIQ</h3>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {"fontSize":"small"} -->
      <p>Rätt kompetens vid rätt tillfälle. Vi hjälper företag att snabbt förstärka sin organisation.</p>
      <!-- /wp:paragraph -->
      
      <!-- wp:social-links {"iconColor":"base","iconColorValue":"#FFFFFF","size":"has-small-icon-size","className":"is-style-logos-only"} -->
      <ul class="wp-block-social-links has-small-icon-size has-icon-color is-style-logos-only">
        <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
        <!-- wp:social-link {"url":"#","service":"twitter"} /-->
        <!-- wp:social-link {"url":"#","service":"facebook"} /-->
      </ul>
      <!-- /wp:social-links -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column -->
    <div class="wp-block-column">
      <!-- wp:heading {"level":4,"fontSize":"medium","textColor":"base"} -->
      <h4>Företag</h4>
      <!-- /wp:heading -->
      
      <!-- wp:list -->
      <ul>
        <li><a href="/foretag/anlita-konsult">Anlita konsult</a></li>
        <li><a href="/foretag/rekrytering">Rekrytering</a></li>
        <li><a href="/artiklar">Artiklar</a></li>
      </ul>
      <!-- /wp:list -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column -->
    <div class="wp-block-column">
      <!-- wp:heading {"level":4,"fontSize":"medium","textColor":"base"} -->
      <h4>Karriär</h4>
      <!-- /wp:heading -->
      
      <!-- wp:list -->
      <ul>
        <li><a href="/karriar/bli-konsult">Bli konsult</a></li>
        <li><a href="/karriar/lediga-jobb">Lediga jobb</a></li>
        <li><a href="/karriar/regga-cv">Registrera CV</a></li>
      </ul>
      <!-- /wp:list -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column -->
    <div class="wp-block-column">
      <!-- wp:heading {"level":4,"fontSize":"medium","textColor":"base"} -->
      <h4>Om FlexIQ</h4>
      <!-- /wp:heading -->
      
      <!-- wp:list -->
      <ul>
        <li><a href="/om-flexiq">Om oss</a></li>
        <li><a href="/om-flexiq/karlskrona">Karlskrona</a></li>
        <li><a href="/kontakt">Kontakt</a></li>
      </ul>
      <!-- /wp:list -->
    </div>
    <!-- /wp:column -->
    
  </div>
  <!-- /wp:columns -->
  
  <!-- wp:separator {"backgroundColor":"base-alt","className":"is-style-wide"} -->
  <hr class="wp-block-separator has-text-color has-base-alt-color has-alpha-channel-opacity has-base-alt-background-color has-background is-style-wide"/>
  <!-- /wp:separator -->
  
  <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
  <div class="wp-block-group">
    <!-- wp:paragraph {"fontSize":"small"} -->
    <p>&copy; 2026 FlexIQ. Alla rättigheter förbehållna.</p>
    <!-- /wp:paragraph -->
    
    <!-- wp:paragraph {"fontSize":"small"} -->
    <p>
      <a href="/integritetspolicy">Integritetspolicy</a> | 
      <a href="/anvandarvillkor">Användarvillkor</a>
    </p>
    <!-- /wp:paragraph -->
  </div>
  <!-- /wp:group -->
  
</div>
<!-- /wp:group -->
```

### Footer Styling (SCSS)

```scss
// Footer styles
.site-footer {
  .wp-block-columns {
    margin-bottom: var(--wp--preset--spacing--50);
    
    .wp-block-column {
      h3, h4 {
        margin-bottom: var(--wp--preset--spacing--30);
      }
      
      ul {
        list-style: none;
        padding: 0;
        
        li {
          margin-bottom: var(--wp--preset--spacing--20);
          
          a {
            color: var(--wp--preset--color--base-alt);
            text-decoration: none;
            transition: var(--wp--custom--transition--default);
            
            &:hover {
              color: var(--wp--preset--color--accent);
            }
          }
        }
      }
    }
  }
  
  .wp-block-separator {
    margin: var(--wp--preset--spacing--50) 0;
  }
  
  // Social links
  .wp-block-social-links {
    margin-top: var(--wp--preset--spacing--30);
    
    a {
      transition: var(--wp--custom--transition--default);
      
      &:hover {
        opacity: 0.7;
      }
    }
  }
  
  // Responsive
  @media (max-width: 768px) {
    .wp-block-columns {
      flex-direction: column;
      gap: var(--wp--preset--spacing--50);
    }
  }
}
```

---

## 4️⃣ Feature Cards Block

### Purpose
Grid of feature cards for showcasing services, benefits, or key points. Supports icons, headings, and descriptions.

### Block Specification

**Block Name:** `flexiq/feature-cards`  
**Category:** `flexiq`  
**Type:** Container block with repeatable inner items

### File Structure

```
src/blocks/feature-cards/
├── block.json
├── index.js
├── edit.js
├── save.js
└── style.scss

src/blocks/feature-card-item/
├── block.json
├── index.js
├── edit.js
├── save.js
└── style.scss
```

### Container Block (flexiq/feature-cards)

```json
// block.json
{
  "apiVersion": 3,
  "name": "flexiq/feature-cards",
  "title": "Feature Cards",
  "category": "flexiq",
  "icon": "grid-view",
  "description": "Display features in a responsive card grid",
  "supports": {
    "align": ["wide", "full"],
    "color": {
      "background": true
    },
    "spacing": {
      "padding": true,
      "margin": true
    }
  },
  "attributes": {
    "columns": {
      "type": "number",
      "default": 3
    },
    "cardStyle": {
      "type": "string",
      "enum": ["default", "bordered", "elevated"],
      "default": "default"
    },
    "iconPosition": {
      "type": "string",
      "enum": ["top", "left"],
      "default": "top"
    }
  },
  "providesContext": {
    "flexiq/cardStyle": "cardStyle",
    "flexiq/iconPosition": "iconPosition"
  }
}
```

### Child Block (flexiq/feature-card-item)

```json
// block.json
{
  "apiVersion": 3,
  "name": "flexiq/feature-card-item",
  "title": "Feature Card",
  "parent": ["flexiq/feature-cards"],
  "category": "flexiq",
  "icon": "admin-page",
  "supports": {
    "color": {
      "background": true,
      "text": true
    },
    "spacing": {
      "padding": true
    }
  },
  "attributes": {
    "icon": {
      "type": "string",
      "default": "star"
    },
    "iconColor": {
      "type": "string",
      "default": "secondary"
    },
    "title": {
      "type": "string",
      "default": "Feature Title"
    },
    "description": {
      "type": "string",
      "default": "Feature description goes here."
    }
  },
  "usesContext": ["flexiq/cardStyle", "flexiq/iconPosition"]
}
```

### Component Structure (Pseudo-code)

**feature-cards/edit.js:**
```javascript
import { useBlockProps, InspectorControls, useInnerBlocksProps } from '@wordpress/block-editor';
import { PanelBody, RangeControl, SelectControl } from '@wordpress/components';

const ALLOWED_BLOCKS = ['flexiq/feature-card-item'];

export default function Edit({ attributes, setAttributes }) {
  const { columns, cardStyle, iconPosition } = attributes;
  
  const blockProps = useBlockProps({
    className: `feature-cards columns-${columns} style-${cardStyle}`
  });
  
  const innerBlocksProps = useInnerBlocksProps(blockProps, {
    allowedBlocks: ALLOWED_BLOCKS,
    template: [
      ['flexiq/feature-card-item', { icon: 'star', title: 'Kvalitet' }],
      ['flexiq/feature-card-item', { icon: 'performance', title: 'Snabbhet' }],
      ['flexiq/feature-card-item', { icon: 'people', title: 'Träffsäkerhet' }]
    ],
    orientation: 'horizontal'
  });

  return (
    <>
      <InspectorControls>
        <PanelBody title="Layout Settings">
          <RangeControl
            label="Columns"
            value={columns}
            onChange={(value) => setAttributes({ columns: value })}
            min={2}
            max={4}
          />
          
          <SelectControl
            label="Card Style"
            value={cardStyle}
            options={[
              { label: 'Default', value: 'default' },
              { label: 'Bordered', value: 'bordered' },
              { label: 'Elevated', value: 'elevated' }
            ]}
            onChange={(value) => setAttributes({ cardStyle: value })}
          />
          
          <SelectControl
            label="Icon Position"
            value={iconPosition}
            options={[
              { label: 'Top', value: 'top' },
              { label: 'Left', value: 'left' }
            ]}
            onChange={(value) => setAttributes({ iconPosition: value })}
          />
        </PanelBody>
      </InspectorControls>

      <div {...innerBlocksProps} />
    </>
  );
}
```

**feature-card-item/edit.js:**
```javascript
import { useBlockProps, RichText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';
import { Icon } from '@wordpress/icons';

export default function Edit({ attributes, setAttributes, context }) {
  const { icon, iconColor, title, description } = attributes;
  const { 'flexiq/cardStyle': cardStyle, 'flexiq/iconPosition': iconPosition } = context;
  
  const blockProps = useBlockProps({
    className: `feature-card icon-${iconPosition} style-${cardStyle}`
  });

  return (
    <>
      <InspectorControls>
        <PanelBody title="Card Settings">
          <TextControl
            label="Icon"
            value={icon}
            onChange={(value) => setAttributes({ icon: value })}
            help="Enter WordPress icon name"
          />
          
          <SelectControl
            label="Icon Color"
            value={iconColor}
            options={[
              { label: 'Primary', value: 'primary' },
              { label: 'Secondary', value: 'secondary' },
              { label: 'Accent', value: 'accent' }
            ]}
            onChange={(value) => setAttributes({ iconColor: value })}
          />
        </PanelBody>
      </InspectorControls>

      <div {...blockProps}>
        <div className={`card-icon has-${iconColor}-color`}>
          <Icon icon={icon} size={48} />
        </div>
        
        <RichText
          tagName="h3"
          value={title}
          onChange={(value) => setAttributes({ title: value })}
          placeholder="Card title..."
          className="card-title"
        />
        
        <RichText
          tagName="p"
          value={description}
          onChange={(value) => setAttributes({ description: value })}
          placeholder="Card description..."
          className="card-description"
        />
      </div>
    </>
  );
}
```

### Styling (SCSS)

```scss
// Feature Cards Container
.feature-cards {
  display: grid;
  gap: var(--wp--preset--spacing--40);
  
  &.columns-2 {
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    
    @media (min-width: 768px) {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  
  &.columns-3 {
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    
    @media (min-width: 1024px) {
      grid-template-columns: repeat(3, 1fr);
    }
  }
  
  &.columns-4 {
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    
    @media (min-width: 1200px) {
      grid-template-columns: repeat(4, 1fr);
    }
  }
}

// Individual Feature Card
.feature-card {
  padding: var(--wp--preset--spacing--50);
  border-radius: var(--wp--preset--border-radius--medium);
  transition: var(--wp--custom--transition--default);
  
  // Icon positioning
  &.icon-top {
    text-align: center;
    
    .card-icon {
      margin-bottom: var(--wp--preset--spacing--30);
    }
  }
  
  &.icon-left {
    display: flex;
    gap: var(--wp--preset--spacing--30);
    text-align: left;
    
    .card-icon {
      flex-shrink: 0;
    }
  }
  
  // Card styles
  &.style-default {
    background: transparent;
  }
  
  &.style-bordered {
    border: 1px solid var(--wp--preset--color--border);
    
    &:hover {
      border-color: var(--wp--preset--color--secondary);
    }
  }
  
  &.style-elevated {
    background: var(--wp--preset--color--base);
    box-shadow: var(--wp--preset--shadow--md);
    
    &:hover {
      box-shadow: var(--wp--preset--shadow--lg);
      transform: translateY(-4px);
    }
  }
  
  .card-icon {
    color: var(--wp--preset--color--secondary);
    
    svg {
      width: 48px;
      height: 48px;
    }
  }
  
  .card-title {
    font-family: var(--wp--preset--font-family--heading);
    font-size: var(--wp--preset--font-size--large);
    font-weight: 600;
    margin-bottom: var(--wp--preset--spacing--20);
    color: var(--wp--preset--color--primary);
  }
  
  .card-description {
    font-size: var(--wp--preset--font-size--medium);
    color: var(--wp--preset--color--muted);
    line-height: var(--wp--custom--line-height--normal);
  }
}
```

### Block Pattern

```php
<?php
/**
 * Title: Feature Cards - Services
 * Slug: flexiq/feature-cards-services
 * Categories: flexiq
 */
?>
<!-- wp:flexiq/feature-cards {"columns":3,"cardStyle":"elevated","align":"wide"} -->
<div class="wp-block-flexiq-feature-cards columns-3 style-elevated alignwide">
  
  <!-- wp:flexiq/feature-card-item {"icon":"analytics","iconColor":"secondary","title":"Affärsnära matchning"} -->
  <div class="wp-block-flexiq-feature-card-item">
    <p>Vi förstår era affärsbehov och matchar rätt konsult mot rätt uppdrag med hög träffsäkerhet.</p>
  </div>
  <!-- /wp:flexiq/feature-card-item -->
  
  <!-- wp:flexiq/feature-card-item {"icon":"performance","iconColor":"accent","title":"Snabba beslutsvägar"} -->
  <div class="wp-block-flexiq-feature-card-item">
    <p>Korta ledtider och snabba processer när tiden är kritisk för er organisation.</p>
  </div>
  <!-- /wp:flexiq/feature-card-item -->
  
  <!-- wp:flexiq/feature-card-item {"icon":"groups","iconColor":"success","title":"Kvalificerade konsulter"} -->
  <div class="wp-block-flexiq-feature-card-item">
    <p>Handplockade specialister med rätt kompetens och erfarenhet för era utmaningar.</p>
  </div>
  <!-- /wp:flexiq/feature-card-item -->
  
</div>
<!-- /wp:flexiq/feature-cards -->
```

---

## 5️⃣ Text + Image Section Block

### Purpose
Flexible content block combining text and images in various layouts (side-by-side, stacked, reversed).

### Block Specification

**Block Name:** `flexiq/text-image-section`  
**Category:** `flexiq`  
**Type:** Composite block with InnerBlocks

### block.json

```json
{
  "apiVersion": 3,
  "name": "flexiq/text-image-section",
  "title": "Text + Image Section",
  "category": "flexiq",
  "icon": "align-pull-left",
  "description": "Flexible content section with text and image",
  "supports": {
    "align": ["wide", "full"],
    "color": {
      "background": true
    },
    "spacing": {
      "padding": true,
      "margin": true
    }
  },
  "attributes": {
    "imagePosition": {
      "type": "string",
      "enum": ["left", "right"],
      "default": "right"
    },
    "imageUrl": {
      "type": "string",
      "default": ""
    },
    "imageAlt": {
      "type": "string",
      "default": ""
    },
    "imageId": {
      "type": "number"
    },
    "contentWidth": {
      "type": "string",
      "enum": ["50-50", "60-40", "40-60"],
      "default": "50-50"
    },
    "verticalAlignment": {
      "type": "string",
      "enum": ["top", "center", "bottom"],
      "default": "center"
    },
    "stackOnMobile": {
      "type": "boolean",
      "default": true
    }
  }
}
```

### Component Structure (Pseudo-code)

```javascript
// edit.js
import { useBlockProps, InnerBlocks, MediaUpload, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl, ToggleControl, Button } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
  const { imagePosition, imageUrl, contentWidth, verticalAlignment, stackOnMobile } = attributes;
  
  const blockProps = useBlockProps({
    className: `text-image-section image-${imagePosition} split-${contentWidth} align-${verticalAlignment}`
  });

  return (
    <>
      <InspectorControls>
        <PanelBody title="Layout">
          <SelectControl
            label="Image Position"
            value={imagePosition}
            options={[
              { label: 'Left', value: 'left' },
              { label: 'Right', value: 'right' }
            ]}
            onChange={(value) => setAttributes({ imagePosition: value })}
          />
          
          <SelectControl
            label="Content Width Ratio"
            value={contentWidth}
            options={[
              { label: '50 / 50', value: '50-50' },
              { label: '60 / 40', value: '60-40' },
              { label: '40 / 60', value: '40-60' }
            ]}
            onChange={(value) => setAttributes({ contentWidth: value })}
          />
          
          <SelectControl
            label="Vertical Alignment"
            value={verticalAlignment}
            options={[
              { label: 'Top', value: 'top' },
              { label: 'Center', value: 'center' },
              { label: 'Bottom', value: 'bottom' }
            ]}
            onChange={(value) => setAttributes({ verticalAlignment: value })}
          />
          
          <ToggleControl
            label="Stack on Mobile"
            checked={stackOnMobile}
            onChange={(value) => setAttributes({ stackOnMobile: value })}
          />
        </PanelBody>
        
        <PanelBody title="Image">
          <MediaUpload
            onSelect={(media) => setAttributes({ 
              imageUrl: media.url,
              imageId: media.id,
              imageAlt: media.alt
            })}
            allowedTypes={['image']}
            value={imageId}
            render={({ open }) => (
              <Button onClick={open} variant="secondary">
                {imageUrl ? 'Replace Image' : 'Select Image'}
              </Button>
            )}
          />
        </PanelBody>
      </InspectorControls>

      <div {...blockProps}>
        {/* Content Column */}
        <div className="content-column">
          <InnerBlocks
            template={[
              ['core/heading', { level: 2, placeholder: 'Section heading...' }],
              ['core/paragraph', { placeholder: 'Add your content here...' }],
              ['core/buttons', {}]
            ]}
            templateLock={false}
          />
        </div>
        
        {/* Image Column */}
        <div className="image-column">
          {imageUrl ? (
            <img src={imageUrl} alt={imageAlt} />
          ) : (
            <div className="placeholder">
              <p>Select an image</p>
            </div>
          )}
        </div>
      </div>
    </>
  );
}
```

### Styling (SCSS)

```scss
.text-image-section {
  display: grid;
  gap: var(--wp--preset--spacing--60);
  align-items: center;
  
  // Layout splits
  &.split-50-50 {
    grid-template-columns: 1fr 1fr;
  }
  
  &.split-60-40 {
    &.image-right {
      grid-template-columns: 60fr 40fr;
    }
    &.image-left {
      grid-template-columns: 40fr 60fr;
    }
  }
  
  &.split-40-60 {
    &.image-right {
      grid-template-columns: 40fr 60fr;
    }
    &.image-left {
      grid-template-columns: 60fr 40fr;
    }
  }
  
  // Image position
  &.image-left {
    .image-column {
      order: -1;
    }
  }
  
  // Vertical alignment
  &.align-top {
    align-items: flex-start;
  }
  
  &.align-center {
    align-items: center;
  }
  
  &.align-bottom {
    align-items: flex-end;
  }
  
  .content-column {
    padding: var(--wp--preset--spacing--40);
  }
  
  .image-column {
    img {
      width: 100%;
      height: auto;
      border-radius: var(--wp--preset--border-radius--large);
      box-shadow: var(--wp--preset--shadow--lg);
    }
  }
  
  // Mobile responsive
  @media (max-width: 768px) {
    grid-template-columns: 1fr !important;
    gap: var(--wp--preset--spacing--40);
    
    .image-column,
    .content-column {
      order: 0;
    }
    
    .content-column {
      padding: 0;
    }
  }
}
```

---

## 6️⃣ Call-to-Action Block

### Purpose
Prominent CTA section with headline, description, and buttons. Used for lead generation and conversion points.

### Block Specification

**Block Name:** `flexiq/cta`  
**Category:** `flexiq`  
**Type:** Simple block with styled container

### block.json

```json
{
  "apiVersion": 3,
  "name": "flexiq/cta",
  "title": "Call to Action",
  "category": "flexiq",
  "icon": "megaphone",
  "description": "Prominent call-to-action section",
  "supports": {
    "align": ["wide", "full"],
    "color": {
      "background": true,
      "text": true,
      "gradients": true
    },
    "spacing": {
      "padding": true,
      "margin": true
    }
  },
  "attributes": {
    "style": {
      "type": "string",
      "enum": ["boxed", "fullwidth", "minimal"],
      "default": "boxed"
    },
    "textAlignment": {
      "type": "string",
      "enum": ["left", "center", "right"],
      "default": "center"
    }
  }
}
```

### Component Structure (Pseudo-code)

```javascript
// edit.js
import { useBlockProps, InnerBlocks, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
  const { style, textAlignment } = attributes;
  
  const blockProps = useBlockProps({
    className: `cta-block style-${style} align-${textAlignment}`
  });

  return (
    <>
      <InspectorControls>
        <PanelBody title="CTA Settings">
          <SelectControl
            label="Style"
            value={style}
            options={[
              { label: 'Boxed', value: 'boxed' },
              { label: 'Full Width', value: 'fullwidth' },
              { label: 'Minimal', value: 'minimal' }
            ]}
            onChange={(value) => setAttributes({ style: value })}
          />
          
          <SelectControl
            label="Text Alignment"
            value={textAlignment}
            options={[
              { label: 'Left', value: 'left' },
              { label: 'Center', value: 'center' },
              { label: 'Right', value: 'right' }
            ]}
            onChange={(value) => setAttributes({ textAlignment: value })}
          />
        </PanelBody>
      </InspectorControls>

      <div {...blockProps}>
        <InnerBlocks
          template={[
            ['core/heading', { 
              level: 2, 
              placeholder: 'Redo att förstärka er organisation?',
              textAlign: textAlignment
            }],
            ['core/paragraph', { 
              placeholder: 'Kontakta oss idag för en kostnadsfri konsultation.',
              align: textAlignment
            }],
            ['core/buttons', { 
              layout: { 
                type: 'flex', 
                justifyContent: textAlignment 
              }
            }, [
              ['core/button', { 
                text: 'Kontakta oss',
                backgroundColor: 'secondary'
              }]
            ]]
          ]}
          templateLock={false}
        />
      </div>
    </>
  );
}
```

### Styling (SCSS)

```scss
.cta-block {
  padding: var(--wp--preset--spacing--70) var(--wp--preset--spacing--50);
  
  &.style-boxed {
    background: linear-gradient(135deg, var(--wp--preset--color--secondary), var(--wp--preset--color--accent));
    color: var(--wp--preset--color--base);
    border-radius: var(--wp--preset--border-radius--large);
    box-shadow: var(--wp--preset--shadow--xl);
    max-width: var(--wp--style--global--wide-size);
    margin: 0 auto;
  }
  
  &.style-fullwidth {
    background: var(--wp--preset--color--primary);
    color: var(--wp--preset--color--base);
  }
  
  &.style-minimal {
    background: transparent;
    border: 2px solid var(--wp--preset--color--border);
    border-radius: var(--wp--preset--border-radius--medium);
  }
  
  h2 {
    font-size: var(--wp--preset--font-size--x-large);
    margin-bottom: var(--wp--preset--spacing--30);
  }
  
  p {
    font-size: var(--wp--preset--font-size--large);
    margin-bottom: var(--wp--preset--spacing--40);
    opacity: 0.9;
  }
  
  .wp-block-buttons {
    gap: var(--wp--preset--spacing--30);
  }
  
  @media (max-width: 768px) {
    padding: var(--wp--preset--spacing--50) var(--wp--preset--spacing--30);
    
    h2 {
      font-size: var(--wp--preset--font-size--large);
    }
    
    p {
      font-size: var(--wp--preset--font-size--medium);
    }
  }
}
```

---

## 7️⃣ Testimonials Block

### Purpose
Display customer testimonials/reviews with quotes, author info, and optional company logos.

### Block Specification

**Block Name:** `flexiq/testimonials`  
**Category:** `flexiq`  
**Type:** Container with repeatable testimonial items

### File Structure

```
src/blocks/testimonials/
├── block.json
├── index.js
├── edit.js
├── save.js
└── style.scss

src/blocks/testimonial-item/
├── block.json
├── index.js
├── edit.js
├── save.js
└── style.scss
```

### Container Block (flexiq/testimonials)

```json
{
  "apiVersion": 3,
  "name": "flexiq/testimonials",
  "title": "Testimonials",
  "category": "flexiq",
  "icon": "format-quote",
  "description": "Display customer testimonials",
  "supports": {
    "align": ["wide", "full"],
    "color": {
      "background": true
    },
    "spacing": {
      "padding": true,
      "margin": true
    }
  },
  "attributes": {
    "columns": {
      "type": "number",
      "default": 2
    },
    "layout": {
      "type": "string",
      "enum": ["grid", "carousel"],
      "default": "grid"
    },
    "showCompanyLogo": {
      "type": "boolean",
      "default": true
    }
  },
  "providesContext": {
    "flexiq/showCompanyLogo": "showCompanyLogo"
  }
}
```

### Child Block (flexiq/testimonial-item)

```json
{
  "apiVersion": 3,
  "name": "flexiq/testimonial-item",
  "title": "Testimonial",
  "parent": ["flexiq/testimonials"],
  "category": "flexiq",
  "icon": "format-quote",
  "supports": {
    "color": {
      "background": true
    }
  },
  "attributes": {
    "quote": {
      "type": "string",
      "default": ""
    },
    "authorName": {
      "type": "string",
      "default": ""
    },
    "authorTitle": {
      "type": "string",
      "default": ""
    },
    "authorImage": {
      "type": "object",
      "default": null
    },
    "companyName": {
      "type": "string",
      "default": ""
    },
    "companyLogo": {
      "type": "object",
      "default": null
    },
    "rating": {
      "type": "number",
      "default": 5
    }
  },
  "usesContext": ["flexiq/showCompanyLogo"]
}
```

### Component Structure (Pseudo-code)

**testimonials/edit.js:**
```javascript
import { useBlockProps, useInnerBlocksProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, RangeControl, SelectControl, ToggleControl } from '@wordpress/components';

const ALLOWED_BLOCKS = ['flexiq/testimonial-item'];

export default function Edit({ attributes, setAttributes }) {
  const { columns, layout, showCompanyLogo } = attributes;
  
  const blockProps = useBlockProps({
    className: `testimonials-block columns-${columns} layout-${layout}`
  });
  
  const innerBlocksProps = useInnerBlocksProps(blockProps, {
    allowedBlocks: ALLOWED_BLOCKS,
    template: [
      ['flexiq/testimonial-item', {}],
      ['flexiq/testimonial-item', {}]
    ]
  });

  return (
    <>
      <InspectorControls>
        <PanelBody title="Layout">
          <RangeControl
            label="Columns"
            value={columns}
            onChange={(value) => setAttributes({ columns: value })}
            min={1}
            max={3}
          />
          
          <SelectControl
            label="Layout Type"
            value={layout}
            options={[
              { label: 'Grid', value: 'grid' },
              { label: 'Carousel', value: 'carousel' }
            ]}
            onChange={(value) => setAttributes({ layout: value })}
          />
          
          <ToggleControl
            label="Show Company Logos"
            checked={showCompanyLogo}
            onChange={(value) => setAttributes({ showCompanyLogo: value })}
          />
        </PanelBody>
      </InspectorControls>

      <div {...innerBlocksProps} />
    </>
  );
}
```

**testimonial-item/edit.js:**
```javascript
import { useBlockProps, RichText, InspectorControls, MediaUpload } from '@wordpress/block-editor';
import { PanelBody, TextControl, RangeControl, Button } from '@wordpress/components';

export default function Edit({ attributes, setAttributes, context }) {
  const { quote, authorName, authorTitle, companyName, rating, authorImage, companyLogo } = attributes;
  const { 'flexiq/showCompanyLogo': showCompanyLogo } = context;
  
  const blockProps = useBlockProps({
    className: 'testimonial-item'
  });

  return (
    <>
      <InspectorControls>
        <PanelBody title="Author">
          <MediaUpload
            onSelect={(media) => setAttributes({ authorImage: media })}
            allowedTypes={['image']}
            render={({ open }) => (
              <Button onClick={open} variant="secondary">
                {authorImage ? 'Change Photo' : 'Add Photo'}
              </Button>
            )}
          />
          
          <TextControl
            label="Author Name"
            value={authorName}
            onChange={(value) => setAttributes({ authorName: value })}
          />
          
          <TextControl
            label="Author Title"
            value={authorTitle}
            onChange={(value) => setAttributes({ authorTitle: value })}
          />
        </PanelBody>
        
        <PanelBody title="Company">
          <TextControl
            label="Company Name"
            value={companyName}
            onChange={(value) => setAttributes({ companyName: value })}
          />
          
          {showCompanyLogo && (
            <MediaUpload
              onSelect={(media) => setAttributes({ companyLogo: media })}
              allowedTypes={['image']}
              render={({ open }) => (
                <Button onClick={open} variant="secondary">
                  {companyLogo ? 'Change Logo' : 'Add Logo'}
                </Button>
              )}
            />
          )}
        </PanelBody>
        
        <PanelBody title="Rating">
          <RangeControl
            label="Stars"
            value={rating}
            onChange={(value) => setAttributes({ rating: value })}
            min={1}
            max={5}
          />
        </PanelBody>
      </InspectorControls>

      <div {...blockProps}>
        {/* Rating stars */}
        <div className="testimonial-rating">
          {'★'.repeat(rating)}
        </div>
        
        {/* Quote */}
        <RichText
          tagName="blockquote"
          value={quote}
          onChange={(value) => setAttributes({ quote: value })}
          placeholder="Enter testimonial quote..."
          className="testimonial-quote"
        />
        
        {/* Author info */}
        <div className="testimonial-author">
          {authorImage && (
            <img 
              src={authorImage.url} 
              alt={authorName} 
              className="author-image"
            />
          )}
          
          <div className="author-details">
            <RichText
              tagName="cite"
              value={authorName}
              onChange={(value) => setAttributes({ authorName: value })}
              placeholder="Author name"
              className="author-name"
            />
            
            <RichText
              tagName="p"
              value={authorTitle}
              onChange={(value) => setAttributes({ authorTitle: value })}
              placeholder="Title"
              className="author-title"
            />
          </div>
        </div>
        
        {/* Company logo */}
        {showCompanyLogo && companyLogo && (
          <div className="company-logo">
            <img src={companyLogo.url} alt={companyName} />
          </div>
        )}
      </div>
    </>
  );
}
```

### Styling (SCSS)

```scss
.testimonials-block {
  display: grid;
  gap: var(--wp--preset--spacing--50);
  
  &.columns-1 {
    grid-template-columns: 1fr;
  }
  
  &.columns-2 {
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  }
  
  &.columns-3 {
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  }
  
  &.layout-carousel {
    // Carousel styles would go here (requires JS)
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    grid-auto-flow: column;
    grid-auto-columns: minmax(350px, 1fr);
  }
}

.testimonial-item {
  background: var(--wp--preset--color--base);
  border: 1px solid var(--wp--preset--color--border);
  border-radius: var(--wp--preset--border-radius--large);
  padding: var(--wp--preset--spacing--50);
  box-shadow: var(--wp--preset--shadow--md);
  transition: var(--wp--custom--transition--default);
  
  &:hover {
    box-shadow: var(--wp--preset--shadow--lg);
    transform: translateY(-4px);
  }
  
  .testimonial-rating {
    color: var(--wp--preset--color--warning);
    font-size: var(--wp--preset--font-size--large);
    margin-bottom: var(--wp--preset--spacing--30);
  }
  
  .testimonial-quote {
    font-size: var(--wp--preset--font-size--medium);
    font-style: italic;
    color: var(--wp--preset--color--contrast);
    line-height: var(--wp--custom--line-height--loose);
    margin-bottom: var(--wp--preset--spacing--40);
    border-left: 4px solid var(--wp--preset--color--secondary);
    padding-left: var(--wp--preset--spacing--30);
    
    &::before {
      content: '"';
      font-size: 3rem;
      color: var(--wp--preset--color--secondary);
      opacity: 0.3;
      line-height: 0;
    }
  }
  
  .testimonial-author {
    display: flex;
    align-items: center;
    gap: var(--wp--preset--spacing--30);
    margin-bottom: var(--wp--preset--spacing--30);
    
    .author-image {
      width: 60px;
      height: 60px;
      border-radius: var(--wp--preset--border-radius--full);
      object-fit: cover;
    }
    
    .author-details {
      .author-name {
        font-family: var(--wp--preset--font-family--heading);
        font-weight: 600;
        font-size: var(--wp--preset--font-size--medium);
        color: var(--wp--preset--color--primary);
        display: block;
        margin-bottom: var(--wp--preset--spacing--10);
      }
      
      .author-title {
        font-size: var(--wp--preset--font-size--small);
        color: var(--wp--preset--color--muted);
        margin: 0;
      }
    }
  }
  
  .company-logo {
    padding-top: var(--wp--preset--spacing--30);
    border-top: 1px solid var(--wp--preset--color--border);
    
    img {
      max-height: 40px;
      width: auto;
      opacity: 0.6;
    }
  }
}

// Mobile responsive
@media (max-width: 768px) {
  .testimonials-block {
    grid-template-columns: 1fr !important;
  }
  
  .testimonial-item {
    padding: var(--wp--preset--spacing--40);
  }
}
```

---

## 📦 Build & Development Setup

### Package Configuration

**package.json:**
```json
{
  "name": "flexiq-theme",
  "version": "1.0.0",
  "description": "FlexIQ WordPress Block Theme",
  "scripts": {
    "build": "wp-scripts build",
    "start": "wp-scripts start",
    "lint:js": "wp-scripts lint-js",
    "lint:css": "wp-scripts lint-style",
    "format": "wp-scripts format"
  },
  "devDependencies": {
    "@wordpress/scripts": "^28.0.0"
  },
  "dependencies": {
    "@wordpress/block-editor": "^14.0.0",
    "@wordpress/blocks": "^13.0.0",
    "@wordpress/components": "^28.0.0",
    "@wordpress/element": "^6.0.0",
    "@wordpress/i18n": "^5.0.0"
  }
}
```

### Block Registration (PHP)

**functions.php:**
```php
<?php
/**
 * FlexIQ Theme Functions
 *
 * @package FlexIQ
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function flexiq_setup() {
    // Add theme support
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    
    // Load translations
    load_theme_textdomain('flexiq', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'flexiq_setup');

/**
 * Register custom block category
 */
function flexiq_block_categories($categories) {
    return array_merge(
        $categories,
        [
            [
                'slug'  => 'flexiq',
                'title' => __('FlexIQ Blocks', 'flexiq'),
                'icon'  => 'building',
            ],
        ]
    );
}
add_filter('block_categories_all', 'flexiq_block_categories');

/**
 * Register custom blocks
 */
function flexiq_register_blocks() {
    // Auto-register all blocks in src/blocks/
    $blocks = [
        'hero',
        'feature-cards',
        'feature-card-item',
        'text-image-section',
        'call-to-action',
        'testimonials',
        'testimonial-item',
    ];
    
    foreach ($blocks as $block) {
        $block_path = get_template_directory() . '/src/blocks/' . $block;
        
        if (file_exists($block_path . '/block.json')) {
            register_block_type($block_path);
        }
    }
}
add_action('init', 'flexiq_register_blocks');

/**
 * Enqueue block assets
 */
function flexiq_enqueue_block_assets() {
    // Enqueue global block styles
    wp_enqueue_style(
        'flexiq-blocks',
        get_template_directory_uri() . '/assets/css/blocks.css',
        [],
        wp_get_theme()->get('Version')
    );
    
    // Enqueue block scripts (if needed)
    wp_enqueue_script(
        'flexiq-blocks-js',
        get_template_directory_uri() . '/assets/js/blocks.js',
        [],
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'flexiq_enqueue_block_assets');

/**
 * Load block patterns
 */
require_once get_template_directory() . '/inc/block-patterns.php';
```

**inc/block-patterns.php:**
```php
<?php
/**
 * Block Patterns Registration
 *
 * @package FlexIQ
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register block patterns
 */
function flexiq_register_block_patterns() {
    // Register pattern category
    register_block_pattern_category(
        'flexiq',
        [
            'label' => __('FlexIQ Patterns', 'flexiq'),
        ]
    );
    
    // Register patterns from /patterns/ directory
    $pattern_files = glob(get_template_directory() . '/patterns/*.php');
    
    foreach ($pattern_files as $pattern_file) {
        $pattern_slug = basename($pattern_file, '.php');
        
        ob_start();
        include $pattern_file;
        $pattern_content = ob_get_clean();
        
        // Extract pattern metadata from comments
        $pattern_data = flexiq_parse_pattern_metadata($pattern_content);
        
        if (!empty($pattern_data['slug'])) {
            register_block_pattern(
                'flexiq/' . $pattern_data['slug'],
                [
                    'title'       => $pattern_data['title'] ?? $pattern_slug,
                    'description' => $pattern_data['description'] ?? '',
                    'categories'  => explode(',', $pattern_data['categories'] ?? 'flexiq'),
                    'keywords'    => explode(',', $pattern_data['keywords'] ?? ''),
                    'content'     => $pattern_content,
                ]
            );
        }
    }
}
add_action('init', 'flexiq_register_block_patterns');

/**
 * Parse pattern metadata from PHP comments
 *
 * @param string $content Pattern file content
 * @return array Pattern metadata
 */
function flexiq_parse_pattern_metadata($content) {
    preg_match_all('/\*\s+(\w+):\s+(.+)/', $content, $matches, PREG_SET_ORDER);
    
    $metadata = [];
    foreach ($matches as $match) {
        $metadata[strtolower($match[1])] = trim($match[2]);
    }
    
    return $metadata;
}
```

---

## 🎨 Integration with Design System

### Using theme.json Variables in Blocks

All custom blocks should utilize the design tokens defined in `theme.json`:

**Colors:**
```scss
// Use theme color presets
background: var(--wp--preset--color--primary);
color: var(--wp--preset--color--base);
border-color: var(--wp--preset--color--border);
```

**Typography:**
```scss
// Use theme font families
font-family: var(--wp--preset--font-family--heading);
font-family: var(--wp--preset--font-family--body);

// Use theme font sizes
font-size: var(--wp--preset--font-size--medium);
font-size: var(--wp--preset--font-size--xx-large);
```

**Spacing:**
```scss
// Use theme spacing scale
padding: var(--wp--preset--spacing--40) var(--wp--preset--spacing--30);
margin-bottom: var(--wp--preset--spacing--50);
gap: var(--wp--preset--spacing--30);
```

**Shadows:**
```scss
// Use theme shadow presets
box-shadow: var(--wp--preset--shadow--md);
box-shadow: var(--wp--preset--shadow--lg);
```

**Border Radius:**
```scss
// Use theme border radius
border-radius: var(--wp--preset--border-radius--medium);
border-radius: var(--wp--preset--border-radius--large);
```

**Custom Properties:**
```scss
// Use custom theme properties
line-height: var(--wp--custom--line-height--normal);
letter-spacing: var(--wp--custom--letter-spacing--tight);
transition: var(--wp--custom--transition--default);
```

### Block Supports Configuration

Enable theme.json supports in all blocks:

```json
{
  "supports": {
    "align": ["wide", "full"],
    "anchor": true,
    "color": {
      "background": true,
      "text": true,
      "gradients": true,
      "link": true
    },
    "spacing": {
      "margin": true,
      "padding": true,
      "blockGap": true
    },
    "typography": {
      "fontSize": true,
      "lineHeight": true,
      "fontFamily": true,
      "fontWeight": true,
      "letterSpacing": true
    },
    "shadow": true
  }
}
```

---

## 🚀 Implementation Roadmap

### Phase 1: Foundation (Week 1-2)
- [ ] Set up build pipeline (@wordpress/scripts)
- [ ] Create basic file structure
- [ ] Configure package.json and webpack
- [ ] Set up block registration in functions.php
- [ ] Create block patterns registration system

### Phase 2: Core Blocks (Week 3-4)
- [ ] **Hero Block** - Priority 1
  - [ ] Create block.json
  - [ ] Build edit component
  - [ ] Build save component
  - [ ] Add styling (SCSS)
  - [ ] Create block patterns
  - [ ] Test responsive behavior

- [ ] **Header/Navigation** - Priority 1
  - [ ] Create template part
  - [ ] Style core/navigation block
  - [ ] Add mobile menu functionality
  - [ ] Implement sticky header (optional)

- [ ] **Footer** - Priority 1
  - [ ] Create template part
  - [ ] Build multi-column layout
  - [ ] Add social links integration
  - [ ] Style footer sections

### Phase 3: Content Blocks (Week 5-6)
- [ ] **Feature Cards Block** - Priority 2
  - [ ] Create container and item blocks
  - [ ] Implement grid layouts
  - [ ] Add icon support
  - [ ] Create card style variations
  - [ ] Build block patterns

- [ ] **Text + Image Section** - Priority 2
  - [ ] Create block with InnerBlocks
  - [ ] Add image position controls
  - [ ] Implement responsive layouts
  - [ ] Create block patterns

### Phase 4: Advanced Blocks (Week 7-8)
- [ ] **Call-to-Action Block** - Priority 2
  - [ ] Build styled container
  - [ ] Add layout variations
  - [ ] Create block patterns

- [ ] **Testimonials Block** - Priority 3
  - [ ] Create container and item blocks
  - [ ] Add rating system
  - [ ] Implement grid/carousel layouts
  - [ ] Add company logo support

### Phase 5: Polish & Testing (Week 9-10)
- [ ] Cross-browser testing
- [ ] Mobile responsiveness testing
- [ ] Performance optimization
- [ ] Accessibility audit (WCAG 2.1 AA)
- [ ] Documentation updates
- [ ] Create block pattern library
- [ ] User testing with content editors

---

## ✅ Best Practices & Guidelines

### Block Development Standards

1. **Naming Conventions**
   - Use kebab-case for block names
   - Prefix all custom blocks with `flexiq/`
   - Use descriptive, self-explanatory names

2. **Accessibility**
   - Include proper ARIA labels
   - Ensure keyboard navigation works
   - Test with screen readers
   - Maintain color contrast ratios (WCAG AA)

3. **Performance**
   - Minimize JavaScript in blocks
   - Use CSS transforms for animations
   - Lazy load images below the fold
   - Optimize asset loading

4. **Responsive Design**
   - Mobile-first approach
   - Test on multiple devices
   - Use fluid typography (clamp())
   - Stack layouts appropriately on mobile

5. **Code Quality**
   - Follow WordPress coding standards
   - Use ESLint and Stylelint
   - Write semantic HTML
   - Document complex logic

6. **Block Supports**
   - Enable relevant theme.json supports
   - Use design system tokens
   - Allow color and spacing customization
   - Support wide and full alignments

7. **InnerBlocks Usage**
   - Use for flexible content areas
   - Define sensible default templates
   - Control allowed blocks when needed
   - Use templateLock appropriately

### Integration with Existing Systems

**Design System Alignment:**
- All blocks must use colors from theme.json palette
- Typography should match defined scales
- Spacing must use the 8-step spacing system
- Shadows and borders use predefined presets

**Content Strategy:**
- Blocks should support FlexIQ's brand voice
- Enable easy content updates by non-developers
- Provide helpful placeholder text in Swedish
- Include tooltips and help text where needed

**SEO & Performance:**
- Semantic HTML structure
- Proper heading hierarchy
- Image optimization with srcset
- Minimal JavaScript dependencies

---

## 📝 Notes & Considerations

### Typography Note
- The brief mentions "Satoshi font från fontshare"
- **Current theme.json uses Inter font**
- Decision needed: Replace Inter with Satoshi or keep Inter?
- If Satoshi is required:
  - Download from Fontshare
  - Add font files to `assets/fonts/`
  - Update theme.json fontFace declarations
  - Update CSS font-family references

### WordPress Version Compatibility
- Theme requires WordPress 6.9+
- Uses Block API v3
- Supports Full Site Editing (FSE)
- Compatible with Gutenberg plugin latest

### Browser Support
- Modern browsers (Chrome, Firefox, Safari, Edge)
- ES6+ JavaScript supported
- CSS Grid and Flexbox required
- No IE11 support needed

### Scalability Considerations
- Block architecture supports future additions
- Pattern-based approach enables rapid page building
- Template parts allow site-wide updates
- Design system enables consistent styling

### Future Enhancements (Post-Launch)
- [ ] Advanced carousel functionality for testimonials
- [ ] Video background support for Hero block
- [ ] Contact form block integration
- [ ] Blog post grid block
- [ ] Team member cards block
- [ ] Location/office cards block
- [ ] Job listings block
- [ ] Statistics/counter block

---

## 📚 Reference Links

**WordPress Documentation:**
- [Block Editor Handbook](https://developer.wordpress.org/block-editor/)
- [theme.json Reference](https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json/)
- [Block API](https://developer.wordpress.org/block-editor/reference-guides/block-api/)
- [InnerBlocks](https://github.com/WordPress/gutenberg/tree/trunk/packages/block-editor/src/components/inner-blocks)

**Tools & Resources:**
- [@wordpress/scripts](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-scripts/)
- [Create Block Tool](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-create-block/)
- [Block Support Reference](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/)

**Design References:**
- FlexIQ Design Brief: `docs/BRIEF.md`
- Frontend Best Practices: `docs/SKILLS-FRONTEND-WP.md`

---

## ✨ Summary

This architecture plan provides a complete roadmap for implementing custom Gutenberg blocks for the FlexIQ WordPress theme. The blocks are designed to:

1. **Integrate seamlessly** with the existing theme.json design system
2. **Support Full Site Editing** with flexible patterns and template parts
3. **Enable content creators** to build professional pages without code
4. **Maintain brand consistency** through design tokens and predefined styles
5. **Perform optimally** with modern web standards and best practices

The modular structure allows for incremental development, testing, and deployment. Each block is self-contained with its own styling and functionality, while sharing the global design system.

**Next Steps:**
1. Review and approve this architecture plan
2. Set up development environment with build tools
3. Begin Phase 1: Foundation setup
4. Implement blocks in priority order
5. Create comprehensive block pattern library

---

**Document Version:** 1.0  
**Status:** Planning Complete - Ready for Implementation  
**Last Updated:** 2026-02-11
