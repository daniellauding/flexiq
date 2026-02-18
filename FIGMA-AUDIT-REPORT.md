# FlexIQ Figma Design Audit
*Jämförelse: Figma (node 178:19317) vs implementerat tema*

## ✅ Git Status
- Pushat till: https://github.com/daniellauding/flexiq.git
- Branch: main (commit ac130ff)
- **OBS**: WordPress core (wordpress/) är inkluderat i repot — lägg till .gitignore för framtida commits

---

## 🎨 Design Tokens — Jämförelse

### Färger (Figma → CSS)
| Figma | Hex | CSS-variabel | Status |
|-------|-----|--------------|--------|
| Primary/text dark | `#0c2212` | `--color-primary: #0c2212` | ✅ Match |
| Accent green | `#5fdf81` | `--color-accent: #5fdf81` | ✅ Match |
| Hero background | `#f8f6ea` | `--color-cream: #f1e4c4` | ⚠️ Nära men ej exakt |
| Section bg blue | `#f6fcff` | `--color-mint: #f0fff4` | ⚠️ Nära men ej exakt |
| Section bg green | `#f3fbf5` | saknas separat | ❌ Saknas |
| Button primary | `#193ec6` | `--color-info-dark: #193ec6` | ✅ Match (fel variabelnamn) |
| Number accent | `#5fdf81` | `--color-accent` | ✅ Match |
| Body text muted | `#2c2c2c` | saknas | ❌ Saknas |

### Typografi (Figma → CSS)
| Element | Figma | CSS | Status |
|---------|-------|-----|--------|
| Font family | Satoshi | Satoshi (installerad) | ✅ |
| Hero H1 | 96px / w900 | `--text-5xl: 3rem (48px)` | ❌ För liten (96px vs 48px) |
| Section H2 | 48px / w700 | `--text-4xl: 2.25rem (36px)` | ⚠️ Nära, men ej exakt |
| Value prop | 58px / w700 | saknas | ❌ Saknas |
| Body large | 24px / w500 | `--text-xl: 1.25rem (20px)` | ⚠️ Lite för liten |
| Body | 20px / w500 | `--text-lg: 1.125rem (18px)` | ⚠️ Lite för liten |
| Intro label | 14px / w400 | `--text-sm: 0.875rem (14px)` | ✅ Match |
| Number accent | 30px / w700 | saknas | ❌ Saknas |

---

## 📄 Sektioner — Vad Figma har vs Implementation

### ✅ Implementerat
1. **Navigation/Header** — logo + nav-links + CTA-knapp
2. **Hero** — rubrik + ingress + CTA-knappar
3. **Value Prop** — stor rubrik + brödtext (2 col)
4. **Våra kompetenser** — 3-col med ikoner (services pattern)
5. **Varför välja oss** — 6-grid med numrerade punkter (01-06)
6. **Gör ett move** — 2-col CTA (för kandidat / för företag)
7. **Artiklar** — 3 article cards + "Visa alla" knapp
8. **Redo att sätta igång** — kontaktformulär + telefon
9. **Footer** — logo + kolumner + sociala

### ❌ Saknas i implementationen
- **Hero background**: Gradient + klot-animation (cirklarna Ellipse 1-3 i `#000000`)
- **Topbar label**: "Ett konsultbolag för tjänsTemannasektorn" ovanför H1
- **Exakta sektionsbakgrunder**: `#f6fcff`, `#f3fbf5` (används för "Våra kompetenser" och "Gör ett move")
- **Kontaktformulär i footer/CTA**: Design har ett inbäddat form-element

---

## 🧩 Block Patterns — Status

| Pattern | Fil | Status |
|---------|-----|--------|
| Hero | `flexiq-hero.php` | ✅ Finns |
| Services 3-col | `flexiq-services.php` | ✅ Finns |
| CTA Banner | `flexiq-cta.php` | ✅ Finns |
| About | `flexiq-about.php` | ✅ Finns |
| Contact | `flexiq-contact.php` | ✅ Finns |
| Stats | `stats-three-column.php` | ✅ Finns |
| Numbered features (01-06) | ❌ Saknas | ❌ BEHÖVS |
| Article cards grid | ❌ Saknas | ❌ BEHÖVS |
| Dual CTA (kandidat/företag) | ❌ Saknas | ❌ BEHÖVS |

---

## 🔧 Åtgärdslista (Prioriterad)

### P0 — Kritiska fixar
1. **Hero H1 font-size**: Öka till 72-96px (responsivt)
2. **Sektionsbakgrunder**: Lägg till `#f6fcff` och `#f3fbf5` som tokens
3. **Body text `#2c2c2c`**: Lägg till som `--color-gray-850-warm`
4. **Numrerade features pattern**: Skapa block pattern för 01-06-grid

### P1 — Viktiga förbättringar  
5. **Hero topbar-label**: Liten etikett ovanför H1
6. **Artikel-cards pattern**: 3-col kortgrid med bild/titel/datum
7. **Dual CTA pattern**: Kandidat vs Företag 2-col

### P2 — Nice to have
8. **Hero gradientbakgrund**: Radial gradient + circle-dekorationer
9. **Kontaktformulär**: Inbyggt i sista sektionen

---

## 🌐 Deploy till Webhotel via FTP

### Vad som ska upp på webhotellet (INTE hela repot)

```
wp-content/
  themes/
    flexiq/          ← Bara detta mappen!
      style.css
      theme.json
      functions.php
      assets/
      templates/
      parts/
      patterns/
```

### Steg-för-steg FTP-deploy

**1. Installera WordPress på webhotellet**
- Ladda ner WordPress från wordpress.org/latest.zip
- Ladda upp via FTP till publika mappen (public_html eller www)
- Skapa MySQL-databas i webhotellets kontrollpanel (cPanel/Plesk)
- Kör WordPress-installationen via webbläsaren

**2. Ladda upp temat via FTP**
```bash
# Lokalt — packa ihop temat
cd /Users/lume/Work/external/flexiq
zip -r flexiq-theme.zip themes/flexiq/

# FTP med FileZilla eller Cyberduck:
# Host: ftp.webhotellet.se
# Ladda upp flexiq/ till: wp-content/themes/flexiq/
```

**3. Alternativt: Ladda upp som zip via wp-admin**
- wp-admin → Utseende → Teman → Lägg till nytt → Ladda upp tema
- Välj flexiq-theme.zip
- Aktivera temat

**4. Konfigurera wp-admin**
- Inställningar → Läsning: Sätt startsida = "Startsida" (statisk sida)
- Skapa sida "Startsida" med mallen "Hem"
- Installera Block Patterns via Utseende → Redigera (block editor)

### Rekommenderat gratis webhotel för test
- **Loopia** (svensk): loopia.se
- **One.com**: one.com/sv
- **Hostinger**: hostinger.se (billigast)

---

## 📊 Sammanfattning

| Kategori | Poäng | Kommentar |
|----------|-------|-----------|
| Färg-tokens | 6/8 | 2 saknas/fel |
| Typografi | 4/8 | Hero H1 för liten |
| Sektioner | 7/9 | 2 saknas |
| Block Patterns | 5/8 | 3 saknas |
| **Totalt** | **22/33 (67%)** | Bra grund, fixar behövs |
