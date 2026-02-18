# Design System Page Setup Guide

This guide explains how to set up the FlexIQ Design System showcase page at `/designsystem`.

## Quick Setup (WP-CLI)

If you have WP-CLI installed, run this command from the WordPress root directory:

```bash
wp post create \
  --post_type=page \
  --post_title='Design System' \
  --post_name='designsystem' \
  --post_status=publish \
  --page_template='page-designsystem.html'
```

## Manual Setup (WordPress Admin)

1. **Log in to WordPress Admin**
   - Navigate to: http://claudebot.taild61ab7.ts.net:8080/wp-admin

2. **Create New Page**
   - Go to: Pages → Add New
   - Title: `Design System`
   - Permalink slug: `designsystem` (click "Edit" next to permalink and change it)

3. **Select Template**
   - In the Page sidebar (right side), under "Template"
   - Select: `page-designsystem.html`

4. **Publish**
   - Click "Publish" button
   - Visit: http://claudebot.taild61ab7.ts.net:8080/designsystem

## What's Included

The design system page showcases:

### 1. Typography
- Font families (Satoshi Regular, Medium, Bold, Black)
- Heading styles (H1-H6)
- Body text sizes
- Font weights and letter spacing

### 2. Colors
- Primary colors (Brand greens)
- Neutral grays (Full scale)
- Semantic colors (Success, Error, Warning, Info)
- Additional colors (Cream, Mint, Pink)
- **Interactive**: Click any color swatch to copy the hex code

### 3. Spacing System
- Base-8 spacing scale (8px to 128px)
- Visual demonstrations with bars
- Layout spacing tokens

### 4. Buttons
- Three variants: Primary, Secondary, Accent
- Three sizes: Small, Medium, Large
- States: Default, Hover, Active, Disabled
- **Interactive**: Hover to see state changes

### 5. Lists
- Unordered lists
- Ordered lists
- Proper typography and spacing

### 6. Components
- Cards with hover effects
- Form elements (inputs, selects, textareas)
- **Interactive**: Hover over cards to see elevation effects

### 7. Responsive Behavior
- Breakpoint visualization
- Mobile (320px-767px)
- Tablet (768px-1023px)
- Desktop (1024px+)
- Responsive typography with fluid scaling

### 8. Code Snippets
- CSS examples showing how to use design tokens
- **Interactive**: Click "Copy" button on code blocks

## Interactive Features

The design system page includes JavaScript enhancements:

### Color Swatches
- **Click** any color swatch to copy the hex code to clipboard
- Visual feedback shows "Copied: #hexcode"

### Code Blocks
- **Click** "Copy" button to copy code snippets
- Button changes to "Copied!" for confirmation

### Scroll Spy
- Table of Contents highlights current section
- Auto-updates as you scroll

### Back to Top Button
- Floating button appears after scrolling down
- Click to smooth scroll back to top
- **Keyboard**: Press `T` to scroll to top

### Keyboard Shortcuts
- `T` - Scroll to top
- `?` - Show keyboard shortcuts help

## Files Created

```
wp-content/themes/flexiq/
├── templates/
│   └── page-designsystem.html          # Page template
├── assets/
│   ├── css/
│   │   └── design-system-showcase.css  # Showcase styles
│   └── js/
│       └── design-system-showcase.js   # Interactive features
└── functions.php                       # Updated with enqueues
```

## Customization

### Modify Content
Edit: `wp-content/themes/flexiq/templates/page-designsystem.html`

### Modify Styles
Edit: `wp-content/themes/flexiq/assets/css/design-system-showcase.css`

### Modify Interactive Features
Edit: `wp-content/themes/flexiq/assets/js/design-system-showcase.js`

### Design Tokens
All design tokens are defined in:
- `wp-content/themes/flexiq/assets/css/design-system.css`
- Reference: `~/Work/external/flexiq/docs/design-system.md`

## Browser Support

- **Modern Browsers**: Full support (Chrome, Firefox, Safari, Edge)
- **Interactive Features**: Requires JavaScript
- **Clipboard API**: Used for copy functionality (fallback included)
- **CSS Custom Properties**: Required (IE11 not supported)

## Accessibility Features

- **Semantic HTML**: Proper heading hierarchy
- **Focus States**: Visible focus indicators for keyboard navigation
- **ARIA Labels**: Screen reader friendly
- **Color Contrast**: WCAG AA compliant
- **Reduced Motion**: Respects `prefers-reduced-motion`
- **High Contrast**: Supports `prefers-contrast: high`
- **Keyboard Navigation**: Full keyboard support

## Responsive Design

The page is fully responsive:

- **Mobile-first**: Base styles for small screens
- **Fluid Typography**: Uses CSS `clamp()` for responsive scaling
- **Flexible Grids**: Auto-fit layouts adapt to screen size
- **Touch-friendly**: Adequate touch target sizes (44x44px minimum)

### Breakpoints
```css
/* Tablet and below */
@media (max-width: 768px)

/* Mobile */
@media (max-width: 480px)
```

## Performance

- **Conditional Loading**: CSS/JS only loads on the design system page
- **Optimized Assets**: Minimal dependencies
- **No External Resources**: All assets self-hosted
- **Print Styles**: Optimized for printing/PDF export

## Troubleshooting

### Page doesn't load
1. Clear WordPress cache
2. Check template is selected in page settings
3. Verify theme is active

### Styles not applied
1. Check browser console for CSS errors
2. Verify CSS file path in functions.php
3. Clear browser cache (Cmd+Shift+R / Ctrl+Shift+R)

### Interactive features not working
1. Check browser console for JavaScript errors
2. Verify JavaScript file is loading
3. Ensure JavaScript is enabled in browser

### Colors/spacing looks wrong
1. Verify `design-system.css` is loaded first
2. Check CSS custom properties are supported
3. Inspect elements to see computed values

## Future Enhancements

Potential additions:

- [ ] Search/filter functionality
- [ ] Dark mode toggle
- [ ] Export design tokens (JSON, SCSS, etc.)
- [ ] Icon library showcase
- [ ] Animation/transition examples
- [ ] Grid system documentation
- [ ] Accessibility checker
- [ ] Component code generator

## Resources

- **Figma Design**: [FlexIQ Design File](https://www.figma.com/design/rGJampH62z4wondvSJlcIg/FlexIQ)
- **Design System Docs**: `~/Work/external/flexiq/docs/design-system.md`
- **WordPress Docs**: [Block Theme Handbook](https://developer.wordpress.org/themes/block-themes/)

## Support

For issues or questions:
1. Check this documentation
2. Review the source files
3. Consult the main design system documentation

---

**Version**: 1.0  
**Created**: February 2026  
**Last Updated**: February 2026
