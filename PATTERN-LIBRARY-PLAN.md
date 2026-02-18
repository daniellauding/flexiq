# FlexIQ Block Pattern Library - Comprehensive Plan

**Version:** 1.0  
**Date:** 2026-02-11  
**Purpose:** Complete roadmap for building a professional, modern pattern library for FlexIQ recruitment website

---

## Table of Contents

1. [Executive Summary](#executive-summary)
2. [Audit of Existing Patterns](#audit-of-existing-patterns)
3. [Pattern Library Roadmap](#pattern-library-roadmap)
4. [Responsive Design Strategy](#responsive-design-strategy)
5. [Implementation Priorities](#implementation-priorities)
6. [Swedish Content Guidelines](#swedish-content-guidelines)
7. [Design System Integration](#design-system-integration)

---

## Executive Summary

### Current State
- **5 patterns exist:** hero, services, about, contact, cta
- **Design system:** Fully defined with Satoshi typography, dark green/accent green colors, 8px spacing
- **Target:** Professional recruitment website for tech talent
- **Brand:** Modern, intelligent, business-driven (not HR-fluff)

### Goal
Build a complete pattern library covering all use cases for a modern recruitment website with:
- **25-30 total patterns** across 11 categories
- **Mobile-first responsive design** with touch-friendly interactions
- **Swedish content** aligned with FlexIQ brand voice
- **Design system consistency** using defined tokens

### Timeline Estimate
- **Phase 1 (Must-Have):** 12 patterns, ~3-4 weeks
- **Phase 2 (Should-Have):** 8 patterns, ~2-3 weeks
- **Phase 3 (Nice-to-Have):** 5-8 patterns, ~2 weeks

---

## Audit of Existing Patterns

### ✅ Pattern 1: Hero (`flexiq/hero`)

**What Works:**
- Strong visual hierarchy with 9xl heading
- Clear dual CTA (accent + secondary buttons)
- Good spacing and centered layout
- Swedish content is clear and direct
- Uses design tokens consistently

**What Needs Variants:**
- Only one layout (centered text)
- No image/media support
- No background video option
- No split layout (text + image)
- No reduced height version

**Recommendation:** Keep as "Hero - Centered" and add 3-4 more hero variants

---

### ✅ Pattern 2: Services (`flexiq/services`)

**What Works:**
- Clean 3-column card layout
- Excellent hierarchy: H2 → H3 → H4 → Body → Meta
- Good use of card style with hover effects
- "Passar er som" meta text is effective
- Proper spacing between columns and sections

**What Needs Variants:**
- Only 3-column layout (needs 2-col and 4-col)
- No icon support above headings
- No image option for services
- No alternating layout option

**Recommendation:** Keep as "Services - 3 Column Cards" and add icon/image variants

---

### ✅ Pattern 3: About (`flexiq/about`)

**What Works:**
- Excellent use of cream background for visual break
- Centered text with constrained width (800px) for readability
- Good line-height (1.8) for body text
- Three paragraphs flow well
- CTA at bottom completes the section

**What Needs Variants:**
- Only centered text (no image support)
- No founder/team intro option
- No mission/vision split
- No timeline/story format

**Recommendation:** Keep as "About - Centered Text" and add image-based variants

---

### ✅ Pattern 4: Contact (`flexiq/contact`)

**What Works:**
- Three contact methods in cards (email, phone, location)
- Emoji icons are friendly and modern
- Good spacing and hierarchy
- Final CTA button completes the flow

**What Needs Variants:**
- No contact form integration
- No map embed option
- No office hours/availability info
- No social media links
- No team contact cards

**Recommendation:** Keep as "Contact - Info Cards" and add form/map variants

---

### ✅ Pattern 5: CTA (`flexiq/cta`)

**What Works:**
- Strong dark background (primary color)
- White text pops well
- Dual CTAs (accent + secondary)
- Constrained width (900px) keeps focus

**What Needs Variants:**
- Only full-width banner style
- No inline CTA (smaller, within content)
- No sticky bottom bar option
- No image/background option
- No urgency/scarcity variant

**Recommendation:** Keep as "CTA - Banner" and add 3-4 more CTA variants

---

### 📊 Audit Summary

| Pattern | Status | Reusability | Needs Variants | Priority |
|---------|--------|-------------|----------------|----------|
| Hero | ✅ Good | High | Yes (4 variants) | P0 |
| Services | ✅ Good | High | Yes (3 variants) | P1 |
| About | ✅ Good | Medium | Yes (3 variants) | P1 |
| Contact | ✅ Good | Medium | Yes (4 variants) | P1 |
| CTA | ✅ Good | High | Yes (4 variants) | P0 |

**Overall Assessment:** Existing patterns are well-built and consistent with design system. They provide a strong foundation but need more variants to cover all use cases.

---

## Pattern Library Roadmap

### Category 1: Hero Variations (5 patterns total)

#### 🎯 Hero 1: Centered (EXISTING)
- **Status:** ✅ Complete
- **Use Case:** Homepage, landing pages
- **Features:** Large centered heading, subtitle, dual CTAs
- **Swedish Content:** "Hitta rätt tech-talang. Snabbt."

---

#### 🎯 Hero 2: Split Layout (Text + Image)
- **Priority:** P0 (Must-Have)
- **Layout:** 50/50 split, text left, image/illustration right
- **Features:**
  - Heading + subtitle on left
  - Image/video/illustration on right
  - CTAs below text
  - Background: white or cream
- **Responsive:** Stack vertically on mobile (image on top)
- **Swedish Content Example:**
  ```
  H1: "Rätt person. Rätt plats. Rätt nu."
  Subtitle: "Vi matchar tech-talanger med svenska techbolag. Snabbt, transparent och utan krångel."
  CTA1: "Se våra tjänster"
  CTA2: "Boka samtal"
  ```
- **Design Notes:**
  - Image should have border-radius: 20px (--radius-lg)
  - Consider adding subtle shadow
  - Image could be team photo, office, or abstract illustration

---

#### 🎯 Hero 3: Full-Width Background Image
- **Priority:** P1 (Should-Have)
- **Layout:** Full viewport height, background image with overlay
- **Features:**
  - Dark overlay (rgba(12, 34, 18, 0.8) - primary with opacity)
  - White text centered
  - Larger than default (viewport height)
  - Optional: scroll indicator at bottom
- **Responsive:** Adjust height on mobile (70vh instead of 100vh)
- **Swedish Content Example:**
  ```
  H1: "Bygg team som fungerar"
  Subtitle: "FlexIQ rekryterar och bemannar IT-roller till svenska techbolag"
  CTA: "Kom igång"
  ```
- **Design Notes:**
  - Background image: team working, tech office, or abstract
  - Ensure text readability with overlay
  - Consider parallax scroll effect

---

#### 🎯 Hero 4: Compact (Reduced Height)
- **Priority:** P1 (Should-Have)
- **Layout:** Smaller hero for sub-pages
- **Features:**
  - Less padding (spacing-10 instead of spacing-12)
  - Smaller heading (7xl instead of 9xl)
  - Single CTA or no CTA
  - Breadcrumb support
- **Responsive:** Even more compact on mobile
- **Swedish Content Example:**
  ```
  H1: "Våra Tjänster"
  Subtitle: "Rekrytering, bemanning och tech talent search"
  ```
- **Use Cases:**
  - Service pages
  - About page
  - Blog listing
  - Contact page header

---

#### 🎯 Hero 5: Video Background
- **Priority:** P2 (Nice-to-Have)
- **Layout:** Full-width with looping video background
- **Features:**
  - Muted autoplay video
  - Dark overlay for text readability
  - Pause/play control (accessibility)
  - Fallback to image if video fails
- **Responsive:** Show poster image on mobile (save bandwidth)
- **Swedish Content:** Same as Hero 3
- **Design Notes:**
  - Video should be short loop (10-15 seconds)
  - Subtle office/work scenes
  - Ensure accessibility (no motion for users with preference)

---

### Category 2: Content Sections (6 patterns)

#### 📝 Content 1: Text + Image (Side-by-Side)
- **Priority:** P0 (Must-Have)
- **Layout:** 50/50 grid, alternating left/right
- **Features:**
  - Heading + body text on one side
  - Image on other side
  - Optional CTA button
  - Can be reversed (image first)
- **Variants:**
  - Text left, image right
  - Image left, text right
- **Responsive:** Stack on mobile, image always on top
- **Swedish Content Example:**
  ```
  H2: "Så fungerar vår rekryteringsprocess"
  Body: "Vi tar hand om hela flödet – från kravprofil till signerat avtal. Ni får färre kandidater, men alla är relevanta. Vi screenar, intervjuar och kvalificerar, så ni kan fokusera på att hitta rätt match."
  CTA: "Läs mer om processen →"
  ```
- **Design Notes:**
  - Use cream or white background
  - Image should have border-radius
  - Optional: add subtle border or shadow to image

---

#### 📝 Content 2: Feature Grid (3 or 4 columns)
- **Priority:** P0 (Must-Have)
- **Layout:** Grid of feature boxes with icon + heading + description
- **Features:**
  - Icon or emoji at top
  - Heading (H3 or H4)
  - Short description (2-3 sentences)
  - Optional: link to learn more
- **Variants:**
  - 3 columns (desktop)
  - 4 columns (desktop, wider screens)
  - 2 columns (tablet)
  - 1 column (mobile)
- **Responsive:** Auto-reflow based on screen size
- **Swedish Content Example:**
  ```
  Feature 1:
  Icon: ⚡
  Title: "Snabb matchning"
  Body: "Vi levererar kvalificerade kandidater inom 7 dagar från kick-off"
  
  Feature 2:
  Icon: 🎯
  Title: "Hög träffsäkerhet"
  Body: "95% av våra placeringar klarar provanställningen"
  
  Feature 3:
  Icon: 🤝
  Title: "Transparent process"
  Body: "Ni får full insyn och kontinuerliga uppdateringar"
  ```
- **Design Notes:**
  - Use card style with subtle shadow
  - Icons can be emoji or SVG
  - Consider adding hover effect (lift + shadow)

---

#### 📝 Content 3: Benefits List (Large Text)
- **Priority:** P1 (Should-Have)
- **Layout:** Vertical list of benefits with large text and checkmarks
- **Features:**
  - Checkmark or icon before each item
  - Large, bold text (2xl or 3xl)
  - Optional: subtext under each benefit
  - Clean, scannable layout
- **Responsive:** Same on all devices, just scales
- **Swedish Content Example:**
  ```
  ✅ Spara 40+ timmar per rekrytering
  ✅ Få kvalificerade kandidater inom 7 dagar
  ✅ 95% lyckad provanställning
  ✅ Full transparens i hela processen
  ✅ Ingen bindningstid eller uppsägningstid
  ```
- **Design Notes:**
  - Use accent-light green (#b0eaa9) for checkmarks
  - Generous spacing between items (spacing-4)
  - Center-align or left-align based on context

---

#### 📝 Content 4: Process Timeline (Steps)
- **Priority:** P1 (Should-Have)
- **Layout:** Horizontal or vertical timeline with numbered steps
- **Features:**
  - Step number in circle
  - Heading for each step
  - Description text
  - Visual connector line between steps
- **Variants:**
  - Horizontal (desktop)
  - Vertical (mobile)
- **Responsive:** Switch from horizontal to vertical on tablet
- **Swedish Content Example:**
  ```
  Step 1: "Kick-off & Behovsanalys"
  → "Vi lär känna er kultur, tech stack och exakt vad ni söker"
  
  Step 2: "Sourcing & Screening"
  → "Vi hittar och kvalificerar kandidater från vårt nätverk och marknaden"
  
  Step 3: "Intervju & Matchning"
  → "Vi presenterar 3-5 topkandidater som passar era krav"
  
  Step 4: "Anställning & Uppföljning"
  → "Vi stöttar under introduktion och följer upp efter 30/60/90 dagar"
  ```
- **Design Notes:**
  - Use accent color (#5fdf81) for step numbers
  - Connector line: 2px solid, gray-200
  - Each step in a card or clean layout

---

#### 📝 Content 5: Stats/Numbers Showcase (Revised)
- **Priority:** P0 (Must-Have)
- **Layout:** Large numbers with labels, 3-4 columns
- **Features:**
  - Huge number (8xl or 9xl font)
  - Label below number
  - Optional: supporting text
  - Background: cream or white
- **Note:** Pattern already exists as `stats-three-column.php` but needs revision
- **Responsive:** 2 columns on tablet, 1 column on mobile
- **Swedish Content Example:**
  ```
  95% → Lyckad provanställning
  7 dagar → Genomsnittlig tid till första kandidat
  200+ → Placeringar senaste året
  4.8/5 → Kundnöjdhet (Trustpilot)
  ```
- **Design Notes:**
  - Use black (900) for numbers
  - Use gray-400 for labels
  - Consider animating numbers on scroll (count-up effect)

---

#### 📝 Content 6: Accordion / Collapsible Sections
- **Priority:** P2 (Nice-to-Have)
- **Layout:** Stacked accordion items, one open at a time
- **Features:**
  - Heading with expand/collapse icon
  - Hidden body text (shows on click)
  - Smooth animation
  - Optional: allow multiple open at once
- **Responsive:** Same on all devices
- **Swedish Content Example:**
  ```
  Q: "Hur lång tid tar en rekrytering?"
  A: "Från kick-off till första presentation: 7-10 dagar. Från start till signerat avtal: 4-8 veckor beroende på roll och tillgänglighet."
  
  Q: "Vad kostar det?"
  A: "Vi arbetar med success fee: 15-20% av årslön vid anställning. Inga dolda avgifter, inga uppstartskostnader."
  ```
- **Design Notes:**
  - Use arrow icon that rotates on open
  - Add border between items
  - Consider using WordPress core Accordion block with custom styling

---

### Category 3: Team/Staff Patterns (3 patterns)

#### 👥 Team 1: Team Grid (3-4 columns)
- **Priority:** P1 (Should-Have)
- **Layout:** Grid of team member cards
- **Features:**
  - Photo (square or circle)
  - Name (H4)
  - Role/title
  - Optional: short bio (1-2 sentences)
  - Optional: LinkedIn link
- **Responsive:** 3 columns → 2 → 1
- **Swedish Content Example:**
  ```
  Name: "Daniel Lauding"
  Role: "VD & Grundare"
  Bio: "15 års erfarenhet av tech-rekrytering. Älskar att matcha rätt person med rätt roll."
  LinkedIn: [icon link]
  ```
- **Design Notes:**
  - Photo: border-radius: 50% (circle) or 20px (rounded square)
  - Use card style with hover effect
  - Consider grayscale photos with color on hover

---

#### 👥 Team 2: Featured Team Member (Large)
- **Priority:** P2 (Nice-to-Have)
- **Layout:** Single large team member showcase
- **Features:**
  - Large photo (half screen)
  - Name, role, bio
  - Quote or statement
  - Social links
- **Use Case:**
  - Founder story
  - Expert spotlight
  - "Meet our team" hero
- **Responsive:** Stack photo on top of text on mobile
- **Swedish Content Example:**
  ```
  Name: "Daniel Lauding"
  Role: "VD & Grundare"
  Quote: "Jag startade FlexIQ för att tech-rekrytering ska vara snabbt, transparent och utan krångel. Vi fokuserar på kvalitet, inte kvantitet."
  Bio: [longer text about background, why FlexIQ, vision]
  ```

---

#### 👥 Team 3: Team List (Minimal)
- **Priority:** P2 (Nice-to-Have)
- **Layout:** Simple list with small photo + name + role
- **Features:**
  - Compact layout
  - Name, role only (no bio)
  - Optional: email or phone
- **Use Case:**
  - Full team overview
  - Department listing
  - Contact directory
- **Responsive:** Same on all devices
- **Swedish Content Example:**
  ```
  [Photo] Daniel Lauding – VD & Grundare – daniel@flexiq.se
  [Photo] Anna Svensson – Tech Recruiter – anna@flexiq.se
  [Photo] Erik Karlsson – Senior Consultant – erik@flexiq.se
  ```

---

### Category 4: Testimonials/Reviews (4 patterns)

#### 💬 Testimonial 1: Carousel/Slider
- **Priority:** P0 (Must-Have)
- **Layout:** Full-width carousel with one testimonial visible at a time
- **Features:**
  - Quote text (large, centered)
  - Author name, company, role
  - Optional: author photo
  - Arrow navigation (prev/next)
  - Dot indicators
  - Auto-advance (optional)
- **Responsive:** Same layout, just scales
- **Swedish Content Example:**
  ```
  Quote: "FlexIQ hittade vår nya Tech Lead på 8 dagar. Professionellt, transparent och rätt match direkt."
  Author: "Maria Andersson"
  Role: "CTO, TechStartup AB"
  Company Logo: [optional]
  ```
- **Design Notes:**
  - Use cream or primary background
  - Large quote icon or quotation marks
  - Consider Swiper.js or native WordPress block

---

#### 💬 Testimonial 2: Grid (3 columns)
- **Priority:** P0 (Must-Have)
- **Layout:** 3-column grid of testimonial cards
- **Features:**
  - Quote (shorter than carousel)
  - Author name, company
  - Star rating (optional)
  - Photo (optional)
- **Responsive:** 3 → 2 → 1 columns
- **Swedish Content Example:**
  ```
  "Snabb, transparent och professionell rekrytering. Rekommenderar starkt!"
  – Jonas Berg, Produktchef, DevCo
  ⭐⭐⭐⭐⭐
  ```
- **Design Notes:**
  - Use card style with subtle shadow
  - Star rating in accent color
  - Keep quotes concise (2-3 sentences max)

---

#### 💬 Testimonial 3: Single Large Quote
- **Priority:** P1 (Should-Have)
- **Layout:** One large testimonial as section break
- **Features:**
  - Huge quote text (5xl or 6xl)
  - Author info below
  - Optional: background color or image
  - Center-aligned
- **Use Case:**
  - Homepage social proof
  - Break between sections
  - Featured client quote
- **Swedish Content Example:**
  ```
  "Vi har sparat 40+ timmar per rekrytering sedan vi började jobba med FlexIQ"
  – Anna Nilsson, HR-chef, ScaleUp Inc
  ```
- **Design Notes:**
  - Use italic font style for quote
  - Large quotation marks as design element
  - Cream or primary background

---

#### 💬 Testimonial 4: Logo Wall + Quote
- **Priority:** P2 (Nice-to-Have)
- **Layout:** Client logos in grid + quote above/below
- **Features:**
  - Heading: "Bolag vi jobbat med"
  - Logo grid (6-12 logos)
  - Optional: quote from one client
- **Responsive:** Logos reflow, 4 → 3 → 2 columns
- **Swedish Content Example:**
  ```
  H2: "Bolag som litar på oss"
  Logos: [TechCo, StartupAB, DevStudio, ScaleUp...]
  Quote: "FlexIQ är vår go-to partner för alla tech-rekryteringar"
  ```
- **Design Notes:**
  - Logos in grayscale, color on hover
  - Equal sizing and spacing
  - Use white or cream background

---

### Category 5: FAQ/Accordion (2 patterns)

#### ❓ FAQ 1: Standard Accordion
- **Priority:** P1 (Should-Have)
- **Layout:** Vertical list of FAQ items
- **Features:**
  - Question as heading (H4)
  - Expandable answer
  - Icon (+ or arrow) that rotates on open
  - One open at a time (optional: allow multiple)
- **Responsive:** Same on all devices
- **Swedish Content Example:**
  ```
  Q: "Hur lång tid tar en rekrytering?"
  A: "Genomsnittlig tid från kick-off till första presentation är 7-10 dagar. Från start till signerat avtal: 4-8 veckor."
  
  Q: "Vad kostar det?"
  A: "Vi arbetar med success fee (endast vid lyckad rekrytering). 15-20% av årslön. Inga dolda avgifter."
  
  Q: "Vilka roller rekryterar ni?"
  A: "Vi specialiserar oss på IT-roller: utvecklare, designers, projektledare, tech leads, arkitekter, DevOps m.fl."
  ```
- **Design Notes:**
  - Use border-bottom between items
  - Smooth expand/collapse animation (300ms)
  - Consider WordPress core Accordion block

---

#### ❓ FAQ 2: Two-Column FAQ
- **Priority:** P2 (Nice-to-Have)
- **Layout:** Two columns of non-collapsible Q&A
- **Features:**
  - Question in bold
  - Answer below
  - No expand/collapse (all visible)
- **Use Case:**
  - Shorter FAQs
  - Key info that should always be visible
- **Responsive:** 2 columns → 1 column on mobile
- **Swedish Content:** Same as FAQ 1

---

### Category 6: Pricing Tables (2 patterns)

#### 💰 Pricing 1: Three-Tier Pricing
- **Priority:** P1 (Should-Have)
- **Layout:** 3 columns, highlight middle option
- **Features:**
  - Plan name
  - Price or "Kontakta oss"
  - Feature list with checkmarks
  - CTA button
  - Optional: "Mest populär" badge
- **Responsive:** 3 → 1 columns on mobile (stack)
- **Swedish Content Example:**
  ```
  Plan 1: "Rekrytering"
  Price: "15-20% av årslön"
  Features:
  ✅ Full rekryteringsprocess
  ✅ Sourcing & screening
  ✅ 3-5 kvalificerade kandidater
  ✅ 90 dagars garanti
  CTA: "Kom igång"
  
  Plan 2: "Bemanning" [POPULÄRAST]
  Price: "Från 650 kr/h"
  Features:
  ✅ Konsulter redo att börja
  ✅ Flexibel tidsperiod
  ✅ Erfarna IT-specialister
  ✅ Ingen bindningstid
  CTA: "Boka samtal"
  
  Plan 3: "Tech Talent Search"
  Price: "Kontakta oss"
  Features:
  ✅ Headhunting av nischroller
  ✅ Proaktiv sourcing
  ✅ Senior-nivå fokus
  ✅ Dedikerad recruiter
  CTA: "Diskutera behov"
  ```
- **Design Notes:**
  - Middle column slightly elevated (box-shadow)
  - Use accent-light for "Populärast" badge
  - Checkmarks in accent color

---

#### 💰 Pricing 2: Comparison Table
- **Priority:** P2 (Nice-to-Have)
- **Layout:** Feature comparison table
- **Features:**
  - Rows: features
  - Columns: plans
  - Checkmarks or "–" for included/not included
- **Responsive:** Horizontal scroll on mobile (table in scrollable container)
- **Swedish Content Example:**
  ```
  Feature | Rekrytering | Bemanning | Tech Talent Search
  --------|-------------|-----------|-------------------
  Sourcing & screening | ✅ | ✅ | ✅
  Intervjuer | ✅ | – | ✅
  Garanti | 90 dagar | – | 180 dagar
  Bindningstid | – | – | –
  ```

---

### Category 7: Newsletter Signup (2 patterns)

#### 📧 Newsletter 1: Inline Form
- **Priority:** P1 (Should-Have)
- **Layout:** Centered form with heading + email input + button
- **Features:**
  - Heading: "Håll dig uppdaterad"
  - Subtext: brief description
  - Email input field
  - Submit button (accent color)
  - Privacy text/GDPR checkbox
- **Responsive:** Same on all devices
- **Swedish Content Example:**
  ```
  H2: "Få tips om tech-rekrytering"
  Subtitle: "Varje månad delar vi insikter om hur du hittar och behåller rätt tech-talang"
  Placeholder: "Din e-postadress"
  Button: "Prenumerera"
  Privacy: "Vi skickar aldrig spam. Avsluta prenumeration när som helst."
  ```
- **Design Notes:**
  - Use cream background
  - Input + button in same row (desktop)
  - Stack on mobile
  - Consider Mailchimp or Newsletter plugin integration

---

#### 📧 Newsletter 2: Modal/Popup
- **Priority:** P2 (Nice-to-Have)
- **Layout:** Popup modal triggered by scroll or exit intent
- **Features:**
  - Close button (X)
  - Heading
  - Email input
  - Submit button
  - Optional: incentive ("Få vår guide gratis")
- **Swedish Content Example:**
  ```
  H3: "Innan du går..."
  Body: "Få vår gratis guide: '5 misstag att undvika vid tech-rekrytering'"
  Input: "E-postadress"
  Button: "Ladda ner nu"
  ```
- **Design Notes:**
  - Don't be annoying (delay trigger, respect dismissal)
  - Accessible (ESC to close, focus trap)
  - Consider only on certain pages (not every visit)

---

### Category 8: Call-to-Actions (CTA) (5 patterns total)

#### 📢 CTA 1: Banner (EXISTING)
- **Status:** ✅ Complete
- **Use Case:** End of page, between sections

---

#### 📢 CTA 2: Inline (Small)
- **Priority:** P0 (Must-Have)
- **Layout:** Small CTA within content flow
- **Features:**
  - Compact height
  - Short heading + button
  - Optional: background color or border
- **Responsive:** Same on all devices
- **Swedish Content Example:**
  ```
  "Behöver ni hjälp att rekrytera? [Boka samtal →]"
  ```
- **Design Notes:**
  - Can be cream background or just bordered box
  - Keep minimal to not interrupt reading flow

---

#### 📢 CTA 3: Split (Text + Form)
- **Priority:** P1 (Should-Have)
- **Layout:** Two columns – text left, form right
- **Features:**
  - Heading + description on left
  - Contact form on right
  - Form fields: name, email, message
  - Submit button
- **Responsive:** Stack on tablet/mobile
- **Swedish Content Example:**
  ```
  H2: "Redo att komma igång?"
  Body: "Berätta om ert behov så återkommer vi inom 24 timmar"
  Form: Name, Email, Company, Message, [Submit]
  ```

---

#### 📢 CTA 4: Sticky Bottom Bar
- **Priority:** P2 (Nice-to-Have)
- **Layout:** Fixed bar at bottom of viewport
- **Features:**
  - Sticky position (always visible)
  - Short message + button
  - Close/dismiss option
  - Appears on scroll
- **Responsive:** Full width on all devices
- **Swedish Content Example:**
  ```
  "Behöver ni tech-talang? Boka ett kostnadsfritt samtal → [Boka nu]"
  ```
- **Design Notes:**
  - Use primary or accent-light background
  - Respect user if they dismiss it (cookie/session)
  - Consider A/B testing conversion

---

#### 📢 CTA 5: Card with Icon
- **Priority:** P1 (Should-Have)
- **Layout:** Card-based CTA with large icon/emoji
- **Features:**
  - Icon at top
  - Heading
  - Short text
  - Button
- **Responsive:** Same on all devices
- **Swedish Content Example:**
  ```
  Icon: 📞
  H3: "Prata med oss"
  Body: "Osäker på vilken lösning som passar er? Ring oss för ett snabbt samtal."
  Button: "Ring nu"
  ```

---

### Category 9: Footer Variations (2 patterns)

#### 🦶 Footer 1: Multi-Column
- **Priority:** P0 (Must-Have)
- **Layout:** 4 columns with links, contact, social
- **Features:**
  - Column 1: Logo + tagline
  - Column 2: Navigation links
  - Column 3: Services links
  - Column 4: Contact info + social icons
  - Bottom bar: Copyright, privacy policy, terms
- **Responsive:** 4 → 2 → 1 columns
- **Swedish Content Example:**
  ```
  Col 1:
  [FlexIQ Logo]
  "Rätt tech-talang. Snabbt."
  
  Col 2: "Om Oss"
  - Om FlexIQ
  - Vårt team
  - Karriär
  - Blogg
  
  Col 3: "Tjänster"
  - Rekrytering
  - Bemanning
  - Tech Talent Search
  
  Col 4: "Kontakt"
  hej@flexiq.se
  +46 (0) 00 000 00 00
  [LinkedIn] [Instagram]
  
  Bottom:
  © 2026 FlexIQ AB | Privacy Policy | Terms
  ```
- **Design Notes:**
  - Dark background (primary color)
  - White text
  - Social icons in accent color on hover

---

#### 🦶 Footer 2: Minimal (Single Row)
- **Priority:** P2 (Nice-to-Have)
- **Layout:** Single row with logo + links + social
- **Features:**
  - Logo on left
  - Links in center
  - Social icons on right
  - Copyright below
- **Responsive:** Stack vertically on mobile
- **Use Case:**
  - Landing pages
  - Campaign sites
  - Minimal sites

---

### Category 10: Navigation Patterns (2 patterns)

#### 🧭 Navigation 1: Header (Standard)
- **Priority:** P0 (Must-Have)
- **Layout:** Logo left, menu center/right, CTA button
- **Features:**
  - Logo (links to home)
  - Main navigation links
  - CTA button (accent color)
  - Sticky on scroll (optional)
  - Mobile hamburger menu
- **Responsive:** Hamburger menu on tablet/mobile
- **Swedish Content Example:**
  ```
  Logo: [FlexIQ]
  Links: Hem | Tjänster | Om oss | Blogg | Kontakt
  CTA: "Boka samtal"
  ```
- **Design Notes:**
  - White background with shadow on scroll
  - Use design system navigation styles
  - Smooth hamburger animation

---

#### 🧭 Navigation 2: Mega Menu
- **Priority:** P2 (Nice-to-Have)
- **Layout:** Dropdown with multiple columns
- **Features:**
  - Hover to expand
  - Multiple columns (services, resources, company)
  - Icons or images for each item
  - Featured content (e.g., latest blog post)
- **Responsive:** Full-screen mobile menu
- **Use Case:**
  - Large sites with many pages
  - Complex service offerings

---

### Category 11: Specialty Patterns (3 patterns)

#### 🎨 Specialty 1: Image Gallery (Grid)
- **Priority:** P2 (Nice-to-Have)
- **Layout:** Grid of images with lightbox
- **Features:**
  - Equal-sized images in grid
  - Click to open in lightbox
  - Caption support
- **Use Case:**
  - Office photos
  - Team events
  - Portfolio/case studies
- **Responsive:** 4 → 3 → 2 → 1 columns

---

#### 🎨 Specialty 2: Video Section
- **Priority:** P1 (Should-Have)
- **Layout:** Embedded video with heading/description
- **Features:**
  - Video embed (YouTube, Vimeo, or self-hosted)
  - Play button overlay
  - Heading + description around video
- **Use Case:**
  - Company intro video
  - Service explainer
  - Customer testimonial video
- **Swedish Content Example:**
  ```
  H2: "Så fungerar FlexIQ"
  Body: "Se hur vi matchar rätt tech-talang med rätt företag"
  [Video: 2-minute explainer]
  ```

---

#### 🎨 Specialty 3: Job Board / Openings List
- **Priority:** P2 (Nice-to-Have)
- **Layout:** List of job openings with filtering
- **Features:**
  - Job title
  - Location
  - Job type (remote, hybrid, on-site)
  - Filter by category
  - "Apply" button links to job page
- **Swedish Content Example:**
  ```
  H2: "Lediga uppdrag"
  
  Job 1:
  "Senior Backend Developer (Node.js)"
  Stockholm | Hybrid | Heltid
  [Läs mer →]
  
  Job 2:
  "UX Designer"
  Remote | Konsultuppdrag 6 mån
  [Läs mer →]
  ```
- **Design Notes:**
  - Use card or list layout
  - Consider integration with job board plugin
  - Filter options: location, type, seniority

---

## Responsive Design Strategy

### Mobile-First Approach

All patterns should be designed for mobile first, then enhanced for larger screens.

**Breakpoints (from design system):**
```css
- Mobile: < 640px (default)
- Tablet: 640px - 1024px
- Desktop: 1024px - 1536px
- Large Desktop: > 1536px
```

### Touch-Friendly Sizing

**Minimum touch targets:**
- Buttons: 48px × 48px (minimum)
- Links in nav: 44px height
- Form inputs: 48px height
- Icon buttons: 44px × 44px

**Spacing on mobile:**
- Section padding: `spacing-8` (64px) instead of `spacing-12`
- Card padding: `spacing-3` (24px) instead of `spacing-4`
- Gap between elements: `spacing-3` minimum

### Responsive Typography

Use `clamp()` for fluid typography:

```css
/* Hero heading */
font-size: clamp(2rem, 5vw, 6rem);

/* Body text */
font-size: clamp(1rem, 1.5vw, 1.25rem);
```

Alternatively, use design system font sizes with responsive adjustments:
- `9xl` (hero) → `5xl` (mobile)
- `7xl` (h2) → `3xl` (mobile)
- `4xl` (h3) → `2xl` (mobile)

### Layout Patterns

**Desktop → Mobile transformations:**

| Desktop Layout | Mobile Layout |
|----------------|---------------|
| 3-4 columns | 1 column (stack) |
| 2 columns (50/50) | 1 column (stack) |
| Sidebar + content | Stack (content first) |
| Horizontal navigation | Hamburger menu |
| Inline form (row) | Stacked form (column) |

### Image Optimization

**Responsive images:**
- Use `srcset` for different sizes
- WebP format with fallback
- Lazy loading for images below fold
- Aspect ratio boxes to prevent layout shift

**Recommended sizes:**
- Hero images: 1920px (desktop), 1024px (tablet), 640px (mobile)
- Content images: 1280px (desktop), 768px (tablet), 480px (mobile)
- Team photos: 400px × 400px
- Thumbnails: 200px × 200px

### Performance Considerations

- **Critical CSS**: Inline above-fold styles
- **Lazy load**: Images, videos, heavy components
- **Reduce animations on mobile**: Respect `prefers-reduced-motion`
- **Touch gestures**: Swipe for carousels, pinch-to-zoom for images

---

## Implementation Priorities

### Phase 1: Must-Have (P0) – 12 Patterns
**Timeline:** 3-4 weeks  
**Goal:** Cover essential use cases for homepage and key pages

| Pattern | Category | Complexity | Time Est. |
|---------|----------|------------|-----------|
| Hero 2: Split Layout | Hero | Medium | 1 day |
| Content 1: Text + Image | Content | Medium | 1 day |
| Content 2: Feature Grid | Content | Medium | 1 day |
| Content 5: Stats (Revised) | Content | Low | 0.5 day |
| Testimonial 1: Carousel | Testimonials | High | 2 days |
| Testimonial 2: Grid | Testimonials | Medium | 1 day |
| CTA 2: Inline | CTA | Low | 0.5 day |
| Footer 1: Multi-Column | Footer | Medium | 1 day |
| Navigation 1: Standard Header | Navigation | High | 2 days |

**Total:** ~10 days of development

### Phase 2: Should-Have (P1) – 10 Patterns
**Timeline:** 2-3 weeks  
**Goal:** Add depth and variety to content sections

| Pattern | Category | Complexity | Time Est. |
|---------|----------|------------|-----------|
| Hero 3: Full-Width BG Image | Hero | Medium | 1 day |
| Hero 4: Compact | Hero | Low | 0.5 day |
| Content 3: Benefits List | Content | Low | 0.5 day |
| Content 4: Process Timeline | Content | High | 1.5 days |
| Team 1: Team Grid | Team | Medium | 1 day |
| Testimonial 3: Single Large | Testimonials | Low | 0.5 day |
| FAQ 1: Accordion | FAQ | Medium | 1 day |
| Pricing 1: Three-Tier | Pricing | Medium | 1.5 days |
| Newsletter 1: Inline Form | Newsletter | Medium | 1 day |
| CTA 3: Split Form | CTA | Medium | 1 day |
| Specialty 2: Video Section | Specialty | Low | 0.5 day |

**Total:** ~10 days of development

### Phase 3: Nice-to-Have (P2) – 8 Patterns
**Timeline:** 2 weeks  
**Goal:** Polish and advanced features

| Pattern | Category | Complexity | Time Est. |
|---------|----------|------------|-----------|
| Hero 5: Video Background | Hero | High | 2 days |
| Content 6: Accordion | Content | Medium | 1 day |
| Team 2: Featured Member | Team | Medium | 1 day |
| Team 3: Team List | Team | Low | 0.5 day |
| Testimonial 4: Logo Wall | Testimonials | Low | 0.5 day |
| FAQ 2: Two-Column | FAQ | Low | 0.5 day |
| Pricing 2: Comparison Table | Pricing | Medium | 1 day |
| Newsletter 2: Modal | Newsletter | High | 1.5 days |
| CTA 4: Sticky Bottom | CTA | Medium | 1 day |
| Footer 2: Minimal | Footer | Low | 0.5 day |
| Navigation 2: Mega Menu | Navigation | High | 2 days |
| Specialty 1: Image Gallery | Specialty | Medium | 1 day |
| Specialty 3: Job Board | Specialty | High | 2 days |

**Total:** ~14 days of development

---

## Swedish Content Guidelines

### Brand Voice
FlexIQ's content should be:
- **Direct and clear** - No fluff, get to the point
- **Professional but approachable** - Smart, not stuffy
- **Action-oriented** - Focus on outcomes and results
- **Transparent** - Honest about process, pricing, timelines

**Avoid:**
- HR-jargon and corporate speak
- Overly salesy language
- Generic "we do everything" claims
- Passive voice

### Content Patterns

**Headlines:**
- Short and punchy (5-7 words max)
- Benefit-focused, not feature-focused
- Use strong verbs

✅ Good: "Hitta rätt tech-talang. Snabbt."  
❌ Bad: "FlexIQ erbjuder rekryteringstjänster inom IT-sektorn"

**Body Text:**
- Short paragraphs (2-3 sentences)
- Scannable bullet points
- Concrete numbers and timelines
- "Er/ni" instead of "du" (professional, not too casual)

**CTAs:**
- Clear action: "Boka samtal", "Se tjänster", "Kontakta oss"
- Add value: "Boka kostnadsfritt samtal", "Se hur vi jobbar"
- Avoid: "Läs mer", "Klicka här" (too generic)

### Swedish-Specific Considerations

**Terminology:**
- "Rekrytering" not "recruitment"
- "Bemanning" not "staffing"
- "Tech-talang" or "IT-kompetens" not "tech talent"
- "Konsult" not "consultant"

**Formality:**
- Use "ni/er" for professional tone
- Avoid slang or overly casual language
- Keep it conversational but respectful

**Numbers and Data:**
- Use Swedish number format: 95% (not 95 %)
- Use metric units
- Be specific: "7 dagar" not "snabbt"

### Content Templates

**Service Description:**
```
[Service Name]
[One-line benefit]

[2-3 sentences explaining what it is and how it works]

"Passar er som:" [specific use case]

[CTA]
```

**Testimonial:**
```
"[Specific outcome or benefit in 1-2 sentences]"
– [Name], [Role], [Company]
```

**FAQ:**
```
Q: [Direct question users would ask]
A: [Specific, honest answer with numbers/timelines if relevant]
```

---

## Design System Integration

### Using Design Tokens

All patterns MUST use design system tokens for consistency:

**Colors:**
```php
<!-- Background colors -->
backgroundColor="primary"     <!-- #0c2212 dark green -->
backgroundColor="cream"        <!-- #f1e4c4 warm bg -->
backgroundColor="white"        <!-- #ffffff -->
backgroundColor="gray-800"     <!-- #171717 dark bg -->

<!-- Text colors -->
textColor="white"
textColor="black"
textColor="gray-300"           <!-- #737373 secondary text -->
textColor="accent"             <!-- #5fdf81 green highlight -->
```

**Spacing:**
```php
<!-- Section padding -->
padding:{"top":"var:preset|spacing|12","bottom":"var:preset|spacing|12"}

<!-- Common spacing values -->
spacing|2   = 16px
spacing|3   = 24px
spacing|4   = 32px
spacing|6   = 48px
spacing|8   = 64px
spacing|10  = 80px
spacing|12  = 96px
```

**Typography:**
```php
<!-- Font sizes -->
fontSize="9xl"   <!-- Hero (8rem/128px) -->
fontSize="7xl"   <!-- H2 (4.5rem/72px) -->
fontSize="5xl"   <!-- H3 (3rem/48px) -->
fontSize="2xl"   <!-- H4 (1.5rem/24px) -->
fontSize="xl"    <!-- Large body (1.25rem/20px) -->
fontSize="lg"    <!-- Body (1.125rem/18px) -->
fontSize="base"  <!-- Default (1rem/16px) -->

<!-- Font weights -->
fontWeight="900"  <!-- Black (hero, h2) -->
fontWeight="700"  <!-- Bold (headings, buttons) -->
fontWeight="500"  <!-- Medium (body text) -->

<!-- Letter spacing -->
letterSpacing="-0.03em"  <!-- -3% for large text -->
letterSpacing="-0.02em"  <!-- -2% for headings -->
```

### WordPress Block Styles

**Core styles to use:**
```php
<!-- Card style -->
className="is-style-card"

<!-- Button styles -->
className="is-style-primary"    <!-- Dark button -->
className="is-style-secondary"  <!-- Outlined button -->
className="is-style-accent"     <!-- Green button -->

<!-- Section wrapper -->
className="section"
```

### Custom CSS Classes

Create reusable classes in theme's `style.css`:

```css
/* Hero variations */
.hero-split { /* split layout styles */ }
.hero-fullscreen { /* full viewport height */ }

/* Card hover effects */
.card-hover:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-card-hover);
  transition: var(--transition-base);
}

/* Timeline connector */
.timeline-step::after {
  content: '';
  position: absolute;
  width: 2px;
  background: var(--color-gray-200);
  /* ... */
}
```

### Accessibility Requirements

**All patterns must include:**

1. **Semantic HTML**
   - Proper heading hierarchy (H1 → H2 → H3...)
   - Use `<nav>`, `<main>`, `<article>`, `<aside>` etc.
   - Buttons for actions, links for navigation

2. **ARIA Labels**
   - `aria-label` for icon-only buttons
   - `aria-expanded` for accordions
   - `aria-hidden="true"` for decorative elements

3. **Keyboard Navigation**
   - All interactive elements focusable
   - Visible focus states
   - Tab order makes sense

4. **Color Contrast**
   - Text on white: black (#000) or gray-900 (#0a0a0a)
   - Text on primary: white (#fff)
   - Text on cream: black or primary
   - All combinations meet WCAG AA (4.5:1 for normal, 3:1 for large)

5. **Responsive Images**
   - Always include alt text
   - Use `loading="lazy"` for below-fold images
   - Provide width/height to prevent layout shift

### Pattern File Structure

Each pattern PHP file should follow this structure:

```php
<?php
/**
 * Title: [Human-readable name]
 * Slug: flexiq/[pattern-slug]
 * Categories: flexiq, [additional-category]
 * Description: [Brief description of use case]
 * Keywords: [comma, separated, keywords]
 * Viewport Width: 1400 (optional, for wide patterns)
 */
?>

<!-- wp:group with full alignment and section class -->
<!-- Outer container with background color and spacing -->

  <!-- wp:group with constrained layout -->
  <!-- Inner container with max-width -->
  
    <!-- Pattern content here -->
    <!-- Use semantic headings, proper spacing, design tokens -->
    
  <!-- /wp:group -->
  
<!-- /wp:group -->
```

### Testing Checklist

Before marking a pattern as complete, test:

- [ ] Displays correctly in Block Editor
- [ ] Responsive on mobile (< 640px)
- [ ] Responsive on tablet (640-1024px)
- [ ] Responsive on desktop (> 1024px)
- [ ] Uses only design system colors
- [ ] Uses design system spacing
- [ ] Uses design system typography
- [ ] Accessible (keyboard nav, screen reader, color contrast)
- [ ] Performance (no unnecessary inline styles, optimized images)
- [ ] Swedish content is natural and on-brand
- [ ] Works with default WordPress themes (Twenty Twenty-Five)
- [ ] Works with FlexIQ theme

---

## Summary & Next Steps

### Deliverables

This plan defines:
✅ **25-30 total patterns** across 11 categories  
✅ **3-phase implementation** (Must-Have, Should-Have, Nice-to-Have)  
✅ **Responsive strategy** with mobile-first approach  
✅ **Swedish content** guidelines and examples  
✅ **Design system integration** using existing tokens  
✅ **Estimated timeline:** 8-10 weeks total

### Immediate Actions

1. **Review & Approve** this plan with stakeholders
2. **Prioritize Phase 1** patterns (12 patterns, ~3-4 weeks)
3. **Set up pattern development workflow:**
   - Create pattern PHP files in `themes/flexiq/patterns/`
   - Test in local WordPress environment
   - Document each pattern in README
   - Version control with Git
4. **Create sample content** in Swedish for testing
5. **Build one pattern fully** as a reference/template for others

### Long-Term Vision

- **Pattern Library Documentation Site** - Interactive showcase of all patterns
- **Pattern Variants** - Easy switching between layout variations
- **Dynamic Content** - Patterns that pull from WordPress database (team members, jobs, etc.)
- **A/B Testing** - Track which patterns convert best
- **User Feedback** - Iterate based on real usage data

---

**Ready to build!** 🚀

This pattern library will give FlexIQ a professional, modern, and flexible website that can scale with the business.
