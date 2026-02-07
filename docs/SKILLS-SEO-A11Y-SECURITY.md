# SEO, Accessibility & Security Guidelines

## 🔍 SEO Best Practices

### Meta & Structure
- Unique `<title>` per page (50-60 chars)
- Meta descriptions (150-160 chars)
- Proper heading hierarchy (single H1, logical H2-H6)
- Semantic HTML5 elements (`<article>`, `<section>`, `<nav>`, `<main>`)
- Schema.org structured data (Organization, LocalBusiness, BreadcrumbList)

### Technical SEO
- XML sitemap (`/sitemap.xml`)
- robots.txt with sitemap reference
- Canonical URLs on all pages
- Open Graph & Twitter Card meta tags
- Hreflang for multilingual (future)
- Clean URL structure (`/om-oss/` not `/?page_id=123`)

### Performance (Core Web Vitals)
- LCP < 2.5s (Largest Contentful Paint)
- FID < 100ms (First Input Delay)
- CLS < 0.1 (Cumulative Layout Shift)
- Lazy load images below fold
- Preload critical assets
- Responsive images with srcset

### WordPress SEO
- Yoast SEO or Rank Math plugin ready
- Breadcrumbs with schema markup
- Image alt texts (descriptive)
- Internal linking structure

---

## ♿ Accessibility (WCAG 2.1 AA)

### Keyboard Navigation
- All interactive elements keyboard accessible
- Visible focus indicators (min 2px, 3:1 contrast)
- Logical tab order
- Skip-to-content link

### Screen Readers
- Semantic HTML (buttons, links, headings, landmarks)
- ARIA labels where needed
- Alt text on all images
- Form labels properly associated
- Error messages linked to inputs

### Visual
- Color contrast 4.5:1 (text) / 3:1 (large text)
- Don't rely on color alone for information
- Resizable text (up to 200%)
- Visible focus states

### Forms
- Labels for all inputs
- Error messages clear and specific
- Required fields marked
- Fieldsets for grouped inputs

### Media
- Captions for video
- Transcripts for audio
- Pause/stop controls for animations
- Reduce motion preference respected

### WordPress Accessibility
- Use theme.json for accessible color palette
- Block patterns with proper structure
- Navigation with proper ARIA
- Contact forms with labels

---

## 🔒 Security Best Practices

### WordPress Hardening
- Hide WordPress version
- Disable XML-RPC if not needed
- Limit login attempts
- Strong admin passwords
- Two-factor authentication ready
- Regular updates (core, themes, plugins)

### Headers
```
X-Content-Type-Options: nosniff
X-Frame-Options: SAMEORIGIN
X-XSS-Protection: 1; mode=block
Referrer-Policy: strict-origin-when-cross-origin
Content-Security-Policy: default-src 'self'
Permissions-Policy: camera=(), microphone=(), geolocation=()
```

### HTTPS
- Force HTTPS everywhere
- HSTS header
- Secure cookies

### Forms
- CSRF protection (nonces)
- Input validation and sanitization
- Rate limiting on submissions
- Honeypot fields for spam

### File Security
- Disable directory listing
- Protect wp-config.php
- Secure file permissions
- Disable file editing in admin

### Database
- Custom table prefix (not wp_)
- Prepared statements for queries
- Regular backups

### .htaccess Security Rules
```apache
# Protect wp-config.php
<files wp-config.php>
order allow,deny
deny from all
</files>

# Disable directory browsing
Options -Indexes

# Protect .htaccess
<files .htaccess>
order allow,deny
deny from all
</files>
```

---

## Implementation Checklist

### SEO ✅
- [ ] Unique titles per page
- [ ] Meta descriptions
- [ ] Schema.org markup
- [ ] XML sitemap
- [ ] robots.txt
- [ ] OG/Twitter cards
- [ ] Image optimization
- [ ] Clean URLs

### Accessibility ✅
- [ ] Keyboard navigation
- [ ] Skip link
- [ ] Focus indicators
- [ ] Color contrast checked
- [ ] Alt texts
- [ ] Form labels
- [ ] Heading hierarchy
- [ ] ARIA landmarks

### Security ✅
- [ ] Security headers
- [ ] HTTPS forced
- [ ] Login protection
- [ ] CSRF tokens
- [ ] Input sanitization
- [ ] File permissions
- [ ] Backups configured
