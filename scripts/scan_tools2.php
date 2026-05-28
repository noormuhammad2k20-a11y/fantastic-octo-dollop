<?php
$toolsConfig = require 'd:/Xamp/htdocs/ToolsHub/config/tools.php';

$requested = [
    'AI Image Generator', 'QR Code Generator', 'PNG to WEBP Converter', 'PNG to TIFF Converter', 
    'PNG to GIF Converter', 'PNG to HEIC Converter', 'HEIC to WEBP Converter', 'HEIC to ICO Converter', 
    'HEIC to TIFF Converter', 'HEIC to GIF Converter', 'HEIC to SVG Converter', 'TTF to SVG Converter', 
    'AVIF to SVG Converter', 'DWG to SVG Converter', 'PNG to JSON Converter',
    'PDF to Image', 'PDF to XML', 'PDF to PUB', 'PDF to HEIC', 'PDF to OFX',
    'CSV to OFX', 'CSV to QIF', 'VCF to CSV', 'CSV to vCard', 'OFX to QFX',
    'OFX to Excel', 'OFX to QBO', 'OFX to PDF', 'Excel to OFX',
    'Facebook Video Downloader', 'Facebook Reels Downloader', 'HD Video Downloader',
    'YouTube Thumbnail Grabber', 'TikTok Video Downloader', 'Instagram Video Downloader',
    'Sitemap Extractor', 'robots.txt Extractor', 'URL Shortener'
];

$existingTitles = array_map('strtolower', array_column($toolsConfig, 'title'));
$existingSlugs = array_keys($toolsConfig);

// Also build some loose matching words
$missing = [];
$found = [];

foreach ($requested as $req) {
    $reqLabel = strtolower($req);
    $reqSlug = strtolower(str_replace(' ', '-', $req));
    $reqSlug = str_replace('-converter', '', $reqSlug);
    $reqSlug = str_replace('-downloader', '', $reqSlug);

    $isFound = false;
    foreach ($toolsConfig as $slug => $tool) {
        $title = strtolower($tool['title'] ?? '');
        if ($title === $reqLabel || $slug === $reqSlug || strpos($title, str_replace(' converter', '', $reqLabel)) !== false) {
            // Strict duplicate check is slightly nuanced, but title matching or slug matching indicates existence.
            if ($reqLabel === 'facebook video downloader' && strpos($title, 'facebook') !== false) {
                 // Might exist as facebook-video-downloader
                 if($slug === 'facebook-video-downloader') $isFound = true;
            }
            if ($title === $reqLabel || strpos($slug, $reqSlug) !== false) {
                 $isFound = true;
                 break;
            }
        }
    }
    
    // Explicit manual check for some common ones
    if (in_array($reqSlug, $existingSlugs) || in_array($reqLabel, $existingTitles)) {
        $isFound = true;
    }
    if (isset($toolsConfig[$reqSlug]) || isset($toolsConfig[$reqSlug . '-converter'])) {
        $isFound = true;
    }
    
    // Check specific known slugs if requested lacks suffix
    $slugMap = [
        'ai image generator' => 'ai-image-generator',
        'qr code generator' => 'qr-code-generator',
        'png to webp converter' => 'png-to-webp',
        'youtube thumbnail grabber' => 'youtube-thumbnail-downloader',
        'url shortener' => 'url-shortener'
    ];
    if (isset($slugMap[$reqLabel]) && isset($toolsConfig[$slugMap[$reqLabel]])) {
        $isFound = true;
    }

    if ($isFound) {
        $found[] = $req;
    } else {
        $missing[] = $req;
    }
}

echo "=== FOUND (SKIPPING) ===\n";
foreach ($found as $f) {
    echo "- $f\n";
}

echo "\n=== MISSING (TO ADD) ===\n";
foreach ($missing as $m) {
    echo "- $m\n";
}

file_put_contents('d:/Xamp/htdocs/ToolsHub/scripts/scan_report2.json', json_encode([
    'requested' => count($requested),
    'found' => $found,
    'missing' => $missing
], JSON_PRETTY_PRINT));
