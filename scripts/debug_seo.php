<?php
$data = include 'd:/Xamp/htdocs/ToolsHub/storage/seo_pages.php';
$pages = array_keys($data['pages'] ?? []);
echo "Total SEO pages: " . count($pages) . "\n";
echo "Math tools check:\n";
$mathSlugs = [
    'antilog-calculator',
    'beta-function-calculator',
    'binomial-coefficient-calculator',
    'binomial-probability-calculator',
    'bitwise-calculator',
    'central-limit-theorem-calculator',
    'chinese-remainder-theorem-calculator',
    'combination-calculator',
    'complementary-error-function-calculator',
    'complex-number-calculator',
    'continued-fraction-calculator',
    'derangement-calculator',
    'dijkstra-calculator',
    'entropy-calculator',
    'error-function-calculator',
    'euler-totient-calculator',
    'exponential-decay-calculator',
    'exponential-growth-calculator',
    'exponential-integral-calculator',
    'exponents-calculator',
    'factorial-calculator',
    'fibonacci-calculator',
    'gamma-function-calculator',
    'gcd-calculator',
    'golden-ratio-calculator'
];

foreach ($mathSlugs as $slug) {
    echo "$slug: " . (in_array($slug, $pages) ? "EXISTS" : "MISSING") . "\n";
}
