# FlexIQ WordPress Local Setup

## ✅ Installation Complete!

WordPress är nu installerat och konfigurerat lokalt utan Docker.

## 📋 System Information

### Server
- **URL:** http://localhost:8080
- **PHP Version:** 8.2.30
- **MySQL Version:** 9.6.0
- **WordPress Version:** 6.9.1

### Database Configuration
- **Database Name:** flexiq_local
- **Database User:** flexiq
- **Database Password:** flexiq123
- **Database Host:** localhost

### Admin Credentials
- **Admin URL:** http://localhost:8080/wp-admin
- **Username:** flexiqadmin
- **Password:** FlexIQ2024!
- **Email:** admin@flexiq.local

### Active Theme
- **Theme Name:** FlexIQ
- **Theme Version:** 1.0.0
- **Theme Type:** Block Theme (Full Site Editing)
- **Location:** ~/Work/external/flexiq/wordpress/wp-content/themes/flexiq/

## 🚀 Starting the Server

To start the WordPress development server:

```bash
cd ~/Work/external/flexiq/wordpress
/opt/homebrew/opt/php@8.2/bin/php -S localhost:8080
```

**Note:** The PHP server is currently running in the background (PID: 64816)

## 🛠 Services Management

### Start MySQL
```bash
brew services start mysql
```

### Stop MySQL
```bash
brew services stop mysql
```

### Restart MySQL
```bash
brew services restart mysql
```

### Check MySQL Status
```bash
brew services list | grep mysql
```

## 📁 Project Structure

```
~/Work/external/flexiq/
├── wordpress/                    # WordPress installation
│   ├── wp-content/
│   │   └── themes/
│   │       └── flexiq/          # Active theme
│   │           ├── style.css
│   │           ├── theme.json
│   │           ├── templates/
│   │           │   ├── index.html
│   │           │   └── home.html
│   │           └── parts/
│   │               ├── header.html
│   │               └── footer.html
│   └── wp-config.php            # WordPress configuration
├── themes/                       # Source theme (copy to wordpress/wp-content/themes/)
│   └── flexiq/
└── SETUP.md                      # This file
```

## 🎨 Theme Development

The FlexIQ theme is a modern block theme with Full Site Editing support. To customize:

1. **Site Editor:** http://localhost:8080/wp-admin/site-editor.php
2. **Theme Files:** Edit files in `~/Work/external/flexiq/wordpress/wp-content/themes/flexiq/`
3. **Template Files:** Located in `templates/` directory
4. **Theme Parts:** Located in `parts/` directory (header, footer, etc.)

## 📝 Next Steps

1. **Configure Permalinks:** Settings > Permalinks (recommended: Post name)
2. **Create Pages:** Pages > Add New
3. **Create Menu:** Appearance > Editor > Navigation
4. **Add Content:** Use the Block Editor to add content
5. **Customize Styles:** Appearance > Editor > Styles

## 🔧 Troubleshooting

### PHP Not Found
Add PHP to your PATH:
```bash
export PATH="/opt/homebrew/opt/php@8.2/bin:$PATH"
export PATH="/opt/homebrew/opt/php@8.2/sbin:$PATH"
```

### MySQL Connection Error
1. Check MySQL is running: `brew services list | grep mysql`
2. Verify database credentials in `wp-config.php`
3. Test MySQL connection: `mysql -uflexiq -pflexiq123 flexiq_local`

### Theme Not Showing
1. Verify theme files exist in `wp-content/themes/flexiq/`
2. Check that `templates/index.html` exists
3. Clear WordPress cache

## 🔐 Security Notes

- **Change default password** after initial setup
- **Use strong passwords** for production
- **Backup database** regularly
- **Keep WordPress updated**

## 📚 Resources

- **WordPress Codex:** https://codex.wordpress.org/
- **Block Editor Handbook:** https://developer.wordpress.org/block-editor/
- **Theme Handbook:** https://developer.wordpress.org/themes/
- **Full Site Editing:** https://developer.wordpress.org/block-editor/how-to-guides/themes/

---

**Setup completed:** 2026-02-11
**Setup by:** OpenClaw WordPress Setup Agent
