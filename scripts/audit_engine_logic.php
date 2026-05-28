<?php
/**
 * Logic Audit Script
 * Verifies that all registered tools have a corresponding method in the JS engine.
 */

$enginePath = __DIR__ . '/../public/js/pro-calculator-engine.js';
$configPath = __DIR__ . '/../config/tools.php';

if (!file_exists($enginePath) || !file_exists($configPath)) {
    die("Critical Error: Missing engine or config file.\n");
}

$engineContent = file_get_contents($enginePath);
$config = include $configPath;
$tools = $config['tools'] ?? [];

$missing = [];
$total = 0;
$found = 0;

foreach ($tools as $slug => $data) {
    if (($data['processor'] ?? '') === 'pro_calculator') {
        $total++;
        $formula = $data['pro_config']['engine_formula'] ?? null;
        if ($formula) {
            if (strpos($engineContent, $formula . '(') !== false) {
                $found++;
            } else {
                $missing[$slug] = $formula;
            }
        }
    }
}

echo "Total Pro Tools: $total\n";
echo "Found Logic: $found\n";
echo "Missing Logic: " . count($missing) . "\n\n";

if (count($missing) > 0) {
    echo "MISSING FORMULAS:\n";
    foreach ($missing as $slug => $f) {
        echo "- $slug: $f\n";
    }
} else {
    echo "✅ ALL LOGIC MAPPINGS VERIFIED!\n";
}
