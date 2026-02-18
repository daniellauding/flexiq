# FlexIQ Theme - Font Installation

## Satoshi Font Family

The FlexIQ theme uses **Satoshi** as its primary typeface. This font needs to be installed in this directory for the theme to display correctly.

### Required Font Files

Place the following font files in this directory (`/themes/flexiq/assets/fonts/`):

```
✓ Satoshi-Regular.woff2
✓ Satoshi-Regular.woff
✓ Satoshi-Medium.woff2
✓ Satoshi-Medium.woff
✓ Satoshi-Bold.woff2
✓ Satoshi-Bold.woff
✓ Satoshi-Black.woff2
✓ Satoshi-Black.woff
```

### Where to Get Satoshi

**Option 1: Purchase from Indian Type Foundry**
- Website: https://www.fontshare.com/fonts/satoshi
- **Note:** Satoshi is available for FREE on Fontshare for personal and commercial use

**Option 2: Alternative Fonts**

If Satoshi is not available, the theme includes fallback fonts, but for the best experience, use one of these alternatives:

1. **Inter** (Free, Google Fonts)
   - Most similar to Satoshi
   - Download: https://fonts.google.com/specimen/Inter
   - Weights needed: 400, 500, 700, 900

2. **DM Sans** (Free, Google Fonts)
   - Similar geometric style
   - Download: https://fonts.google.com/specimen/DM+Sans
   - Weights needed: 400, 500, 700

3. **Outfit** (Free, Google Fonts)
   - Rounded geometric alternative
   - Download: https://fonts.google.com/specimen/Outfit
   - Weights needed: 400, 500, 700, 900

### Installation Instructions

#### Method 1: Direct Installation (Recommended)

1. Download Satoshi font files from Fontshare
2. Convert to WOFF2 and WOFF formats if needed (use https://transfonter.org/)
3. Copy the 8 required files to this directory
4. Verify the theme loads correctly

#### Method 2: Use Google Fonts (Alternative)

If you want to use a Google Font alternative instead:

1. Edit `/themes/flexiq/assets/css/fonts.css`
2. Comment out the Satoshi @font-face declarations
3. Add Google Fonts link to your theme's `functions.php`:

```php
function flexiq_enqueue_google_fonts() {
    wp_enqueue_style( 
        'flexiq-google-fonts', 
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap', 
        array(), 
        null 
    );
}
add_action( 'wp_enqueue_scripts', 'flexiq_enqueue_google_fonts' );
```

4. Update the `--font-primary` variable in `/themes/flexiq/assets/css/design-system.css`:

```css
--font-primary: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
```

### Font Weights Used

The FlexIQ design system uses these specific weights:

- **Regular (400):** Minimal use, light text
- **Medium (500):** Body text, standard content
- **Bold (700):** Headers, navigation, emphasis
- **Black (900):** Hero text, major headlines, CTAs

### Performance Optimization

For better performance, preload the most critical fonts. Add this to your theme's `header.php` or via `functions.php`:

```html
<link rel="preload" 
      href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Satoshi-Bold.woff2" 
      as="font" 
      type="font/woff2" 
      crossorigin>

<link rel="preload" 
      href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Satoshi-Medium.woff2" 
      as="font" 
      type="font/woff2" 
      crossorigin>
```

### Troubleshooting

**Fonts not loading?**

1. Check browser console for 404 errors
2. Verify file paths are correct
3. Ensure WOFF2 files are served with correct MIME type
4. Clear WordPress cache and browser cache
5. Check file permissions (should be readable by web server)

**Incorrect font weights?**

1. Verify all 4 weight files are present
2. Check that font-weight values in CSS match the installed weights
3. Some browsers may need the WOFF fallback if WOFF2 is not supported

### License Information

**Satoshi:** Free for personal and commercial use via Fontshare
- License: https://www.fontshare.com/licenses/fontshare-eula

Make sure to comply with the font's license terms when using it in your project.

---

**Last Updated:** 2026-02-11  
**Theme Version:** 1.0.0
