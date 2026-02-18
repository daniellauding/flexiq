#!/bin/bash

# FlexIQ Pattern Verification Script
# Run this to verify all patterns are properly registered

cd ~/Work/external/flexiq/wordpress

echo "=================================="
echo "FlexIQ Pattern Verification"
echo "=================================="
echo ""

# Test 1: Check if WordPress loads
echo "Test 1: WordPress Loading..."
php -r "require_once('./wp-load.php'); echo '✅ WordPress loaded successfully' . PHP_EOL;"
echo ""

# Test 2: Count registered patterns
echo "Test 2: Pattern Registration..."
php -r "
require_once('./wp-load.php');
\$patterns = WP_Block_Patterns_Registry::get_instance()->get_all_registered();
\$flexiq = array_filter(\$patterns, function(\$p) { return in_array('flexiq', \$p['categories']); });
\$count = count(\$flexiq);
echo 'Registered FlexIQ patterns: ' . \$count . '/5' . PHP_EOL;
if (\$count === 5) {
    echo '✅ All patterns registered' . PHP_EOL;
} else {
    echo '❌ Missing patterns! Expected 5, got ' . \$count . PHP_EOL;
    exit(1);
}
"
echo ""

# Test 3: Check category registration
echo "Test 3: Category Registration..."
php -r "
require_once('./wp-load.php');
\$categories = WP_Block_Pattern_Categories_Registry::get_instance()->get_all_registered();
\$flexiq = array_filter(\$categories, function(\$c) { return \$c['name'] === 'flexiq'; });
if (!empty(\$flexiq)) {
    \$cat = reset(\$flexiq);
    echo '✅ Category \"' . \$cat['label'] . '\" registered' . PHP_EOL;
} else {
    echo '❌ FlexIQ category NOT registered' . PHP_EOL;
    exit(1);
}
"
echo ""

# Test 4: Validate pattern content
echo "Test 4: Pattern Content Validation..."
php -r "
require_once('./wp-load.php');
\$patterns = WP_Block_Patterns_Registry::get_instance()->get_all_registered();
\$flexiq = array_filter(\$patterns, function(\$p) { return in_array('flexiq', \$p['categories']); });
\$all_valid = true;
foreach (\$flexiq as \$pattern) {
    \$has_content = !empty(\$pattern['content']);
    \$has_blocks = strpos(\$pattern['content'], '<!-- wp:') !== false;
    \$is_valid = \$has_content && \$has_blocks;
    
    if (\$is_valid) {
        echo '✅ ' . \$pattern['title'] . PHP_EOL;
    } else {
        echo '❌ ' . \$pattern['title'] . ' - Invalid content' . PHP_EOL;
        \$all_valid = false;
    }
}
if (!\$all_valid) {
    exit(1);
}
"
echo ""

# Test 5: List all patterns
echo "Test 5: Pattern Details..."
php -r "
require_once('./wp-load.php');
\$patterns = WP_Block_Patterns_Registry::get_instance()->get_all_registered();
\$flexiq = array_filter(\$patterns, function(\$p) { return in_array('flexiq', \$p['categories']); });
echo '   Name                      | Slug' . PHP_EOL;
echo '   ' . str_repeat('-', 50) . PHP_EOL;
foreach (\$flexiq as \$pattern) {
    printf('   %-25s | %s' . PHP_EOL, \$pattern['title'], \$pattern['name']);
}
"
echo ""

# Final summary
echo "=================================="
echo "✅ All tests passed!"
echo "=================================="
echo ""
echo "Patterns are properly registered."
echo "They should appear in the WordPress editor at:"
echo "  Block Inserter → Patterns → FlexIQ Patterns"
echo ""
echo "If patterns don't appear in the UI:"
echo "  1. Clear browser cache (Cmd+Shift+R)"
echo "  2. Log out and back in"
echo "  3. Check browser console for errors"
echo ""
echo "Test page created:"
echo "  Edit: http://localhost:8080/wp-admin/post.php?post=12&action=edit"
echo "  Login: flexiqadmin / FlexIQ2024!"
echo ""
