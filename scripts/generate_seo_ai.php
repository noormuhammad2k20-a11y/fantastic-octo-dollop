<?php
/**
 * Generate SEO pages for AI & Name Generators
 */

$toolsConfig = include __DIR__ . '/../config/tools.php';
$aiTools = array_keys(array_filter($toolsConfig, function($t) {
    return in_array($t['category'] ?? '', ['ai-content', 'name-generator']);
}));

$pages = [];
foreach ($aiTools as $mainSlug) {
    if(!isset($toolsConfig[$mainSlug])) continue;
    $tool = $toolsConfig[$mainSlug];
    $name = $tool['title'] ?? ucfirst(str_replace('-', ' ', $mainSlug));
    $desc = $tool['description'] ?? 'Generate awesome content using AI.';
    
    // Create base variation
    $pages[$mainSlug] = [
        'tool_slug' => $mainSlug,
        'h1' => $name . " – Free Online Tool",
        'title' => $name . " - Free & Unlimited | ToolsHub",
        'meta_description' => "Use our completely free $name. $desc No signup required. Instant creation from your browser.",
        'article' => "## How to use the $name\n\nThe **$name** is an essential resource for anyone looking to generate creative text and names instantly. Whether you are a professional, a creator, or just having fun, having the right generator is the first step toward success. Our tool is designed to be mobile-friendly and highly accurate.\n\n### Why Use this $name?\n\n1. **High Quality Results**: Our generation logic is robust and tailored for professional use.\n2. **Speed**: Get results in real-time instantly.\n3. **Free & Unlimited**: No rate limits, no API keys, and no payment required.\n\n### Key Features\n\n- Professional interface with premium card-based layout.\n- Wide variety of customizable parameters.\n- Works perfectly on all devices (iOS, Android, Windows Desktop).\n\n### How to Use\n\nSimply input your preferences into the fields above. For example, select your parameters and click Generate. The results will appear instantly below, where you can copy them to your clipboard with one click.",
        'faq' => [
            ['q' => "What is the $name?", 'a' => "It's a digital web application that allows you to easily generate high-quality text, ideas, and names."],
            ['q' => "Is this $name free to use?", 'a' => "Yes, all our tools on ToolsHub are 100% free with no hidden charges or subscriptions."],
            ['q' => "Is my input secure?", 'a' => "Absolutely. All processing is algorithmic and we do not store your inputs or the generated content on our servers."],
        ],
        'instructions' => [
            "Input your desired parameters in the designated fields.",
            "Click the Generate button to run the algorithm.",
            "Review the real-time generated outputs in the result panel.",
            "Click the Copy icon to save your chosen result to your clipboard."
        ],
        'canonical' => '/' . $mainSlug,
    ];
}

$seoFile = __DIR__ . '/../storage/seo_pages.php';

$existing = [];
if (file_exists($seoFile)) {
    $existing = include $seoFile;
}

if (!isset($existing['pages'])) {
    $existing = ['pages' => []];
}

// Only add if not already present
foreach ($pages as $slug => $pageData) {
    if (!isset($existing['pages'][$slug])) {
        $existing['pages'][$slug] = $pageData;
    } else {
        // Optionally update it, but here we just merge newly missing ones or replace them
        $existing['pages'][$slug] = array_merge($existing['pages'][$slug], $pageData);
    }
}

$content = "<?php\n\nreturn " . var_export($existing, true) . ";\n";
file_put_contents($seoFile, $content);

echo "Successfully added/updated " . count($pages) . " SEO pages to storage/seo_pages.php\n";
