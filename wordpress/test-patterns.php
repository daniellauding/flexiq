<?php
/**
 * Test script to verify block patterns are registered
 */

// Load WordPress
define('WP_USE_THEMES', false);
require_once(__DIR__ . '/wp-load.php');

echo "=== FlexIQ Pattern Registration Test ===\n\n";

// Check if pattern registration functions exist
if (function_exists('flexiq_register_pattern_category')) {
    echo "✓ flexiq_register_pattern_category() function exists\n";
} else {
    echo "✗ flexiq_register_pattern_category() function NOT FOUND\n";
}

if (function_exists('flexiq_load_patterns')) {
    echo "✓ flexiq_load_patterns() function exists\n";
} else {
    echo "✗ flexiq_load_patterns() function NOT FOUND\n";
}

echo "\n";

// Get all registered patterns
$registry = WP_Block_Patterns_Registry::get_instance();
$all_patterns = $registry->get_all_registered();

echo "Total registered patterns: " . count($all_patterns) . "\n\n";

// Filter FlexIQ patterns
$flexiq_patterns = array_filter($all_patterns, function($pattern) {
    return isset($pattern['categories']) && in_array('flexiq', $pattern['categories']);
});

echo "FlexIQ patterns found: " . count($flexiq_patterns) . "\n\n";

if (count($flexiq_patterns) > 0) {
    echo "Registered FlexIQ Patterns:\n";
    echo "==========================\n";
    foreach ($flexiq_patterns as $name => $pattern) {
        echo "- {$name}\n";
        echo "  Title: {$pattern['title']}\n";
        if (isset($pattern['description'])) {
            echo "  Description: {$pattern['description']}\n";
        }
        echo "  Categories: " . implode(', ', $pattern['categories']) . "\n\n";
    }
} else {
    echo "❌ NO FlexIQ patterns registered!\n\n";
    echo "Debugging information:\n";
    
    // Check pattern directory
    $patterns_dir = get_template_directory() . '/patterns/';
    echo "Pattern directory: {$patterns_dir}\n";
    echo "Directory exists: " . (is_dir($patterns_dir) ? 'YES' : 'NO') . "\n";
    
    if (is_dir($patterns_dir)) {
        $files = glob($patterns_dir . '*.php');
        echo "Pattern files found: " . count($files) . "\n";
        foreach ($files as $file) {
            echo "  - " . basename($file) . "\n";
        }
    }
}

// Check pattern categories
echo "\n=== Pattern Categories ===\n";
$categories = WP_Block_Pattern_Categories_Registry::get_instance()->get_all_registered();
foreach ($categories as $category) {
    if ($category['name'] === 'flexiq' || strpos($category['label'], 'FlexIQ') !== false) {
        echo "✓ Found category: {$category['name']} - {$category['label']}\n";
    }
}
