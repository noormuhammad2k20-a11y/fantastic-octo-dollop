<?php
/**
 * scripts/sync_tools_master.php
 * Synchronizes tool.txt with calculator_configs.json.
 * Refined version.
 */

$toolFile = 'd:\\Xamp\\htdocs\\ToolsHub\\tool.txt';
$configFile = 'd:\\Xamp\\htdocs\\ToolsHub\\calculator_configs.json';

if (!file_exists($toolFile)) {
    die("tool.txt not found.\n");
}

$lines = file($toolFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$configs = json_decode(file_get_contents($configFile), true) ?: [];

$newCount = 0;
$totalProcessed = 0;

// Bad keys to remove from previous run
$blacklist = [
    'aapki-website-par-finance-tools-bohot-strong-hain-sirf-yeh-specific-tools-missing-hain',
    'math-calculators-missing',
    'advanced-math-operations-1-49',
    'yeh-category-completely-missing-hai'
];

foreach ($blacklist as $badKey) {
    if (isset($configs[$badKey])) {
        unset($configs[$badKey]);
        echo "REMOVED BAD KEY: $badKey\n";
    }
}

foreach ($lines as $line) {
    $line = trim($line);
    
    // Skip based on various "header" or "commentary" patterns
    if (empty($line)) continue;
    if (preg_match('/^\(.*\)$/', $line)) continue; // (Parenthetical comments)
    if (preg_match('/^[^\w\d\s]+$/u', $line)) continue; // Only symbols
    if (mb_strpos($line, '🧮') !== false && mb_stripos($line, 'CALCULATORS') !== false) continue;
    if (mb_strpos($line, '💰') !== false && mb_stripos($line, 'CALCULATORS') !== false) continue;
    if (mb_strpos($line, '⚕️') !== false && mb_stripos($line, 'CALCULATORS') !== false) continue;
    if (mb_strpos($line, '🎲') !== false && mb_stripos($line, 'RANDOMNESS') !== false) continue;
    if (preg_match('/^[A-Z0-9\s&()\-]+$/', $line) && !preg_match('/[a-z]/', $line)) continue; // ALL CAPS HEADERS
    if (preg_match('/\(1-\d+\)/', $line)) continue; // (1-49) style

    // Clean name: remove "123. " format
    $name = preg_replace('/^\d+[\.\s]+/', '', $line);
    $name = trim($name);

    if (empty($name)) continue;
    if (strlen($name) < 3) continue;

    // Generate slug
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
    
    // Final check for bogus slugs
    if (empty($slug) || strlen($slug) < 3) continue;
    if (in_array($slug, $blacklist)) continue;

    $totalProcessed++;

    if (!isset($configs[$slug])) {
        $configs[$slug] = [
            'mode' => 'pro',
            'inputs' => [
                'basic' => []
            ],
            'engine_formula' => 'pending_logic'
        ];
        $newCount++;
        echo "NEW: Added $slug ($name)\n";
    }
}

// Sort alphabetically
ksort($configs);

$json = json_encode($configs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
if (file_put_contents($configFile, $json)) {
    echo "\nSUCCESS: Total tools in config: " . count($configs) . "\n";
    echo "NEW TOOLS ADDED: $newCount\n";
    echo "TOTAL TOOLS PROCESSED FROM tool.txt: $totalProcessed\n";
} else {
    echo "\nERROR: Failed to write to calculator_configs.json\n";
}
