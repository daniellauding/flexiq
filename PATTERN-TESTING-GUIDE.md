# FlexIQ Block Patterns - Testing Guide

## ✅ Backend Verification Complete

All backend systems have been verified and are working correctly:

- ✅ **5 patterns registered** (flexiq/hero, services, about, contact, cta)
- ✅ **Pattern category registered** ("FlexIQ Patterns")
- ✅ **Valid block markup** in all patterns
- ✅ **Patterns can be parsed** and inserted
- ✅ **No caching plugins** interfering
- ✅ **Admin permissions** verified

## 📋 Manual UI Testing Required

### Step 1: Access WordPress Admin
1. Open browser and go to: **http://localhost:8080/wp-admin**
2. Login with:
   - **Username:** flexiqadmin
   - **Password:** FlexIQ2024!

### Step 2: Create New Page
1. Click on **Pages → Add New** in the sidebar
2. Wait for the block editor to load

### Step 3: Access Block Inserter
1. Click the **"+" (plus)** button in the top-left corner of the editor
2. The Block Inserter panel should open on the left side

### Step 4: Navigate to Patterns
1. Click on the **"Patterns"** tab at the top of the Block Inserter
2. You should see a list of pattern categories

### Step 5: Verify FlexIQ Patterns Category
**✓ Expected Result:**
- You should see a category called **"FlexIQ Patterns"**
- Click on it to expand

**❌ If you DON'T see "FlexIQ Patterns":**
- Check browser console for JavaScript errors (F12 → Console tab)
- Try hard-refreshing the page (Ctrl+Shift+R or Cmd+Shift+R)
- Clear browser cache and reload

### Step 6: Verify All 5 Patterns Appear
Under "FlexIQ Patterns" category, you should see:

1. **FlexIQ Hero** - Hero section med huvudrubrik, underrubrik och CTA-knappar
2. **FlexIQ Services (3-column)** - Tre tjänster i kolumner
3. **FlexIQ About (Om oss)** - Om oss-sektion med rubrik och beskrivning
4. **FlexIQ Contact** - Kontaktsektion med rubrik och kontaktinformation
5. **FlexIQ CTA Banner** - Call-to-action banner

### Step 7: Test Pattern Insertion
1. Click on **"FlexIQ Hero"** pattern
2. The pattern should be inserted into the editor
3. Verify that:
   - ✓ Pattern appears in the editor canvas
   - ✓ Design system styles are applied (check fonts, colors, spacing)
   - ✓ You can click and edit text within the pattern
   - ✓ You can drag and move the entire pattern

### Step 8: Test All 5 Patterns
Repeat Step 7 for each of the 5 patterns:
- FlexIQ Hero ✓ / ❌
- FlexIQ Services ✓ / ❌
- FlexIQ About ✓ / ❌
- FlexIQ Contact ✓ / ❌
- FlexIQ CTA Banner ✓ / ❌

## 🔍 Troubleshooting

### Issue: Patterns don't appear in inserter
**Solutions:**
1. Hard refresh the editor page (Cmd+Shift+R)
2. Clear WordPress transient cache:
   ```bash
   cd ~/Work/external/flexiq/wordpress
   php -r "require_once('./wp-load.php'); wp_cache_flush(); echo 'Cache cleared!';"
   ```
3. Check browser console for JavaScript errors
4. Verify theme is active:
   - Go to Appearance → Themes
   - Ensure "FlexIQ" is the active theme

### Issue: Patterns appear but don't render correctly
**Solutions:**
1. Check if design system CSS is loaded:
   - Open browser inspector (F12)
   - Go to Network tab → Filter by CSS
   - Look for: design-system.css, components.css, fonts.css
2. Verify theme assets are accessible:
   ```bash
   curl -I http://localhost:8080/wp-content/themes/flexiq/assets/css/design-system.css
   ```
3. Check for CSS conflicts in browser inspector

### Issue: Can insert patterns but can't edit them
**Solutions:**
1. Click directly on the text you want to edit
2. Try clicking the block toolbar at the top
3. Use the "List View" button (three horizontal lines) to select specific blocks

## 🎯 Expected Behavior

### When Working Correctly:

1. **Block Inserter** opens when you click the "+" button
2. **Patterns tab** shows "FlexIQ Patterns" category
3. **5 patterns** are visible under the category
4. **Clicking a pattern** inserts it into the editor
5. **Pattern renders** with proper styling (Satoshi font, green colors, proper spacing)
6. **Pattern is editable** - you can click text and modify it
7. **Pattern is movable** - you can drag it up/down the page

### Design System Verification:

When patterns are inserted, verify these design system elements:

- **Typography:** Satoshi font family
- **Colors:** 
  - Primary: Dark green (#0c2212)
  - Accent: Light green (#5fdf81)
  - Cream background: (#f1e4c4)
- **Spacing:** Base-8 spacing scale (0.5rem, 1rem, 1.5rem, 2rem, etc.)
- **Border radius:** Rounded corners on buttons (full radius pill shape)
- **Shadows:** Subtle card shadows on hover

## 📸 Screenshot Documentation

If patterns are working, please take screenshots of:

1. Block Inserter showing "FlexIQ Patterns" category
2. List of all 5 patterns in the category
3. Each pattern inserted in the editor
4. Front-end preview of a page with all patterns

## ✅ Success Criteria

The fix is complete when:

- [ ] "FlexIQ Patterns" category appears in Block Inserter
- [ ] All 5 patterns are visible in the category
- [ ] Patterns can be inserted with one click
- [ ] Patterns render with correct design system styles
- [ ] Patterns are fully editable
- [ ] Patterns are drag-and-droppable
- [ ] No console errors when inserting patterns

## 🔧 Technical Details

### Pattern Files Location:
```
~/Work/external/flexiq/wordpress/wp-content/themes/flexiq/patterns/
├── flexiq-hero.php
├── flexiq-services.php
├── flexiq-about.php
├── flexiq-contact.php
└── flexiq-cta.php
```

### Registration Code Location:
```
~/Work/external/flexiq/wordpress/wp-content/themes/flexiq/functions.php
```

### Pattern Registration Verified:
```bash
# Verify patterns are registered (should show 5)
cd ~/Work/external/flexiq/wordpress
php -r "require_once('./wp-load.php'); \$p = WP_Block_Patterns_Registry::get_instance()->get_all_registered(); \$f = array_filter(\$p, fn(\$x) => in_array('flexiq', \$x['categories'])); echo count(\$f) . ' patterns registered';"
```

---

**Last Updated:** 2026-02-11 03:15 PST  
**Status:** Backend ✅ | UI Testing Required 🔄  
**Next Step:** Manual UI verification in WordPress admin
