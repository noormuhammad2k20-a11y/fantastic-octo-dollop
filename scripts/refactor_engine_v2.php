<?php
/**
 * scripts/refactor_engine_v2.php
 * Automated refactoring with corrected class insertion and duplicate prevention.
 */

$enginePath = 'd:\\Xamp\\htdocs\\ToolsHub\\public\\js\\pro-calculator-engine.js';
$configPath = 'd:\\Xamp\\htdocs\\ToolsHub\\calculator_configs.json';

$engine = file_get_contents($enginePath);
$config = json_decode(file_get_contents($configPath), true);

// 1. Refactor calculate() method (in case it wasn't already correctly replaced)
$newCalculate = "    calculate() {
        const formula = this.config.engine_formula;
        if (typeof this[formula] === 'function') {
            const results = this[formula](this.state);
            if (results) this.renderResults(results);
        } else {
            console.warn(`Engine formula '\${formula}' is either missing logic or incorrectly mapped.`);
        }
    }";

// Replace old switch-based calculate if it exists
$engine = preg_replace('/    calculate\(\) \{.*?switch \(formula\) \{.*?\}\s+\}/s', $newCalculate, $engine);

// 2. Identify all unique formulas from config
$allFormulas = [];
foreach ($config as $tool) {
    if (isset($tool['engine_formula'])) {
        $allFormulas[] = $tool['engine_formula'];
    }
}
$allFormulas = array_unique($allFormulas);

// 3. Scan for existing implemented methods (to avoid duplicates)
preg_match_all('/    ([a-z0-9_]+)\(s\) \{/i', $engine, $matches);
$implemented = array_unique($matches[1]);

$missing = array_diff($allFormulas, $implemented);

// 4. Generate placeholders for truly missing formulas
$stubs = "";
foreach ($missing as $formula) {
    if ($formula === 'pending_logic') continue;
    // Extra safety: double check if the method is already in the file string
    if (strpos($engine, "    $formula(s) {") !== false) continue;
    
    $stubs .= "\n    $formula(s) {\n        console.log(\"Formula $formula triggered with:\", s);\n        return { mainValue: \"Coming Soon\", mainLabel: \"$formula Status\", insights: [\"This calculation logic is being finalized.\"] };\n    }\n";
}

// 5. Insert stubs BEFORE the formatCurrency method
$insertionPoint = "    formatCurrency(val) {";
if (strpos($engine, $insertionPoint) !== false) {
    $engine = str_replace($insertionPoint, $stubs . "\n" . $insertionPoint, $engine);
    file_put_contents($enginePath, $engine);
    echo "Refactored! Total Formulas: " . count($allFormulas) . "\n";
    echo "Existing Methods: " . count($implemented) . "\n";
    echo "Newly Appended Stubs: " . count($missing) . "\n";
} else {
    echo "Insertion point 'formatCurrency' not found. Refactor aborted.\n";
}
