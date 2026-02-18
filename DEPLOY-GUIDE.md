# FlexIQ — Deploy till Webhotel (FTP + WordPress)

## Vad du behöver
- FTP-uppgifter från webhotellet (host, user, password)
- Tillgång till webhotellets kontrollpanel (cPanel / Plesk / Loopia)
- FileZilla (gratis FTP-klient): filezilla-project.org

---

## STEG 1: Installera WordPress på webhotellet

### Alternativ A — Auto-install (enklast, de flesta webhotell)
1. Logga in på kontrollpanelen (cPanel / Loopia / Binero)
2. Hitta "WordPress" eller "Installera applikationer" / "Softaculous"
3. Klicka **Installera WordPress**
4. Fyll i:
   - URL: din domän (t.ex. flexiq.se)
   - Admin-användarnamn + lösenord (spara dessa!)
   - Admin-e-post
5. Klicka **Installera** — klart på 2 minuter

### Alternativ B — Manuell install
1. Ladda ner WordPress: https://wordpress.org/latest.zip
2. Packa upp och ladda upp alla filer via FTP till `public_html/`
3. Skapa MySQL-databas i kontrollpanelen
4. Öppna din domän i webbläsaren → följ installationsguiden

---

## STEG 2: Packa ihop temat lokalt

Öppna terminalen och kör:

```bash
cd /Users/lume/Work/external/flexiq

# Skapa en zip av bara temat (INTE hela WordPress-kärnan)
zip -r flexiq-theme.zip themes/flexiq/ \
  --exclude "*.DS_Store" \
  --exclude "*/.git/*"

echo "Skapad: flexiq-theme.zip"
ls -lh flexiq-theme.zip
```

---

## STEG 3: Ladda upp temat

### Alternativ A — Via wp-admin (enklast)
1. Gå till: `dindomän.se/wp-admin`
2. Logga in med admin-uppgifterna från Steg 1
3. **Utseende → Teman → Lägg till nytt tema**
4. Klicka **Ladda upp tema**
5. Välj `flexiq-theme.zip`
6. Klicka **Installera nu**
7. Klicka **Aktivera**

### Alternativ B — Via FTP (FileZilla)
1. Öppna FileZilla
2. Fyll i:
   - **Värd:** ftp.dindomän.se (från webhotellet)
   - **Användarnamn:** ditt FTP-login
   - **Lösenord:** ditt FTP-lösenord
   - **Port:** 21
3. Klicka **Snabbkoppling**
4. Navigera till: `public_html/wp-content/themes/`
5. Dra `themes/flexiq/` från vänster (lokalt) till höger (server)
6. Vänta tills uppladdningen är klar (~2-5 min)
7. Gå till wp-admin → Utseende → Teman → Aktivera FlexIQ

---

## STEG 4: Konfigurera WordPress

### 4.1 Sätt startsidan
1. **Sidor → Lägg till ny**
2. Titel: `Startsida`
3. Välj mallen **Hem** (i sidopanelen under "Sidmall")
4. Publicera
5. **Inställningar → Läsning**
6. Välj **En statisk sida**
7. Förstasida: `Startsida`
8. Spara

### 4.2 Aktivera Satoshi-fonterna
Fonterna är redan i temat (`/assets/fonts/`) — de laddas automatiskt via `fonts.css`.

### 4.3 Skapa navigation
1. **Utseende → Menyer** (eller via block editor i header)
2. Skapa en meny med:
   - Om oss
   - Tjänster
   - Karriär
   - Blogg
   - Kontakt
3. Sätt som **Primär meny**

---

## STEG 5: Importera startsidans innehåll

Startsidan har all content i `home.html` (template) — den visas automatiskt.

Men om du vill redigera innehållet i block-editorn:
1. Gå till **Sidor → Startsida → Redigera**
2. Klicka på `+` → **Patterns** → **FlexIQ Patterns**
3. Dra in de patterns du vill ha:
   - FlexIQ Hero
   - FlexIQ Numbered Features (01-06)
   - FlexIQ Dual CTA (Din karriär / För företag)
   - FlexIQ Article Cards
   - Osv.

---

## STEG 6: Kontrollera att allt funkar

Gå igenom denna checklista:

```
□ Startsidan visas med alla 7 sektioner
□ Satoshi-fonten laddas (rubrikerna ser rätt ut)
□ Hero H1 är stor (clamp 48-96px)
□ Grön accent #5fdf81 syns på 01-06 siffrorna
□ Blå knappar #193ec6 syns
□ Sektionsbakgrunderna #f6fcff och #f3fbf5 syns
□ Navigation fungerar
□ Footer visas korrekt
□ Mobilvy ser bra ut (testa via Chrome DevTools)
```

---

## STEG 7: Plugins att installera (rekommenderade)

Gå till **Plugins → Lägg till nytt** och installera:

| Plugin | Varför |
|--------|--------|
| **Yoast SEO** | SEO-metadata, sitemap |
| **WP Forms Lite** | Kontaktformulär |
| **UpdraftPlus** | Backup |
| **W3 Total Cache** | Snabbare laddning |

---

## Felsökning

### "Theme is missing the style.css stylesheet"
→ Du har laddat upp fel mapp. Kontrollera att `style.css` finns direkt i `flexiq/`-mappen, inte i en undermapp.

### Fonterna visas inte
→ Kontrollera att `assets/fonts/` finns på servern via FTP. Satoshi-filerna ska finnas där.

### Startsidan visar standard WordPress-innehåll
→ Gå till Inställningar → Läsning och sätt statisk startsida.

### Patterns syns inte i editorn
→ Kontrollera att temat är aktiverat. Patterns registreras automatiskt via `functions.php`.

---

## Git → FTP-workflow (för framtida uppdateringar)

När du gjort ändringar lokalt:

```bash
# 1. Pusha till GitHub (du har redan gjort det)
git push origin main

# 2. Packa om temat
cd /Users/lume/Work/external/flexiq
zip -r flexiq-theme-update.zip themes/flexiq/

# 3. Ladda upp via wp-admin eller FTP
# wp-admin → Utseende → Teman → Uppdatera (installera igen)
# ELLER ladda upp via FTP och skriv över filerna
```

---

## Ditt tema i ett nötskal

```
flexiq/
  themes/
    flexiq/
      style.css          ← Temametadata (namn, version)
      theme.json         ← Design tokens (färger, spacing)
      functions.php      ← PHP-logik, patterns, scripts
      assets/
        css/
          design-system.css  ← Alla CSS-variabler + utilities
          components.css     ← Komponent-stilar
          fonts.css          ← Satoshi font-face
        fonts/             ← Satoshi .woff2-filer
      templates/
        home.html          ← STARTSIDAN (7 sektioner från Figma)
        page.html          ← Standardsida
        index.html         ← Blogg/arkiv
        single.html        ← Enstaka inlägg
      parts/
        header.html        ← Header/navigation
        footer.html        ← Footer
      patterns/
        flexiq-hero.php
        flexiq-services.php
        flexiq-numbered-features.php  ← NY (01-06 grid)
        flexiq-dual-cta.php           ← NY (Kandidat/Företag)
        flexiq-articles.php           ← NY (3 artikelkort)
        flexiq-cta.php
        flexiq-about.php
        flexiq-contact.php
        stats-three-column.php
```

**GitHub:** https://github.com/daniellauding/flexiq
