#!/bin/bash
#
# FlexIQ Theme Sync Script
# Syncs theme files from source to WordPress installation
#

SOURCE_DIR="$HOME/Work/external/flexiq/themes/flexiq"
TARGET_DIR="$HOME/Work/external/flexiq/wordpress/wp-content/themes/flexiq"

echo "=== FlexIQ Theme Sync ==="
echo ""
echo "Source: $SOURCE_DIR"
echo "Target: $TARGET_DIR"
echo ""

# Check if source directory exists
if [ ! -d "$SOURCE_DIR" ]; then
    echo "❌ Error: Source directory not found!"
    exit 1
fi

# Check if target directory exists
if [ ! -d "$TARGET_DIR" ]; then
    echo "❌ Error: Target directory not found!"
    echo "   Is WordPress installed?"
    exit 1
fi

# Sync files (excluding .git and other unnecessary files)
echo "📦 Syncing theme files..."
rsync -av \
    --exclude='.git' \
    --exclude='.gitignore' \
    --exclude='node_modules' \
    --exclude='.DS_Store' \
    --exclude='*.log' \
    "$SOURCE_DIR/" "$TARGET_DIR/"

if [ $? -eq 0 ]; then
    echo ""
    echo "✅ Theme files synced successfully!"
    echo ""
    echo "Synced files:"
    echo "  - functions.php"
    echo "  - patterns/"
    echo "  - assets/"
    echo "  - templates/"
    echo "  - parts/"
    echo "  - style.css"
    echo "  - theme.json"
else
    echo ""
    echo "❌ Error: Sync failed!"
    exit 1
fi
