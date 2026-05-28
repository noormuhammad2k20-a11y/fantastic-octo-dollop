<?php
/**
 * scripts/analyze_engine.php
 * Identifies all missing engine formulas to be implemented.
 */

$configFile = 'd:\\Xamp\\htdocs\\ToolsHub\\calculator_configs.json';
$engineFile = 'd:\\Xamp\\htdocs\\ToolsHub\\public\\js\\pro-calculator-engine.js';

$config = json_decode(file_get_contents($configFile), true);
$engine = file_get_contents($engineFile);

$allFormulas = [];
foreach ($config as $tool) {
    if (isset($tool['engine_formula'])) {
        $allFormulas[] = $tool['engine_formula'];
    }
}
$allFormulas = array_unique($allFormulas);

$missingFormulas = [];
foreach ($allFormulas as $formula) {
    if (strpos($engine, "    $formula(s) {") === false && 
        strpos($engine, "    $formula (s) {") === false &&
        strpos($engine, "    $formula: function") === false) {
        $missingFormulas[] = $formula;
    }
}

echo "Total Formulas: " . count($allFormulas) . "\n";
echo "Missing Formulas: " . count($missingFormulas) . "\n";
echo "Missing List: " . implode(',', $missingFormulas) . "\n";
