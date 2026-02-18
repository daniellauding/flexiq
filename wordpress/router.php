<?php
/**
 * Router for PHP built-in server
 * Handles static files and WordPress routing
 */

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $path;

// Get file extension
$ext = pathinfo($file, PATHINFO_EXTENSION);

// Handle directory requests - look for index.php
if (is_dir($file)) {
    $indexFile = rtrim($file, '/') . '/index.php';
    if (file_exists($indexFile)) {
        $file = $indexFile;
        $ext = 'php';
    }
}

// If it's a PHP file that exists, run it directly
if (is_file($file) && $ext === 'php') {
    return false; // Let PHP run it
}

// Serve static files directly
if (is_file($file)) {
    // Set correct MIME types
    $mimeTypes = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'eot' => 'application/vnd.ms-fontobject',
    ];
    
    if (isset($mimeTypes[$ext])) {
        header('Content-Type: ' . $mimeTypes[$ext]);
    }
    
    return readfile($file);
}

// Let WordPress handle the request
require_once __DIR__ . '/index.php';
