<?php
/**
 * scripts/refactor_engine.php
 * Automated senior-level refactoring for ProCalculatorEngine.js.
 */

$enginePath = 'd:\\Xamp\\htdocs\\ToolsHub\\public\\js\\pro-calculator-engine.js';
$configPath = 'd:\\Xamp\\htdocs\\ToolsHub\\calculator_configs.json';

$engine = file_get_contents($enginePath);
$config = json_decode(file_get_contents($configPath), true);

// 1. Extract logic mapping from switch
preg_match_all('/case \'([^\']+)\': results = this\.([^\(]+)\(this\.state\); break;/', $engine, $matches);
$mapping = [];
for ($i = 0; $i < count($matches[1]); $i++) {
    $slug = $matches[1][$i];
    $method = $matches[2][$i];
    $mapping[$method] = $slug;
}

// 2. Refactor calculate() method to use dynamic mapping
$newCalculate = "    calculate() {
        const formula = this.config.engine_formula;
        if (typeof this[formula] === 'function') {
            const results = this[formula](this.state);
            if (results) this.renderResults(results);
        } else {
            console.warn(`Engine formula '\${formula}' is either missing logic or incorrectly mapped.`);
        }
    }";

// Find and replace calculate method
$engine = preg_replace('/    calculate\(\) \{.*?switch \(formula\) \{.*?\}\s+\}/s', $newCalculate, $engine);

// 3. Rename existing calcX methods to match their slug
foreach ($mapping as $method => $slug) {
    if ($method === $slug) continue;
    // We only rename if the method name is different from the slug
    // Ensure we only replace method definitions: "methodname(s) {"
    $engine = str_replace("    $method(s) {", "    $slug(s) {", $engine);
}

// 4. Identify all unique formulas from config
$allFormulas = [];
foreach ($config as $tool) {
    if (isset($tool['engine_formula'])) {
        $allFormulas[] = $tool['engine_formula'];
    }
}
$allFormulas = array_unique($allFormulas);

// 5. Check for missing methods
$implemented = [];
// Find all method names in the current state of $engine
preg_match_all('/    ([a-z0-9_]+)\(s\) \{/i', $engine, $matches);
$implemented = $matches[1];

$missing = array_diff($allFormulas, $implemented);

// 6. Generate placeholders for missing formulas
$stubs = "";
foreach ($missing as $formula) {
    if ($formula === 'pending_logic') continue;
    $stubs .= "\n    $formula(s) {\n        console.log(\"Formula $formula triggered with:\", s);\n        return { mainValue: \"Coming Soon\", mainLabel: \"$formula Status\", insights: [\"This calculation logic is being finalized.\"] };\n    }\n";
}

// Append stubs before the closing brace of the class (last '}')
$lastBracePos = strrpos($engine, '}');
$engine = substr_replace($engine, $stubs, $lastBracePos, 0);

// 7. Save the refactored engine
file_put_contents($enginePath, $engine);

echo "Refactored! Total Formulas: " . count($allFormulas) . "\n";
echo "Implemented/Renamed: " . count($implemented) . "\n";
echo "Appended Stubs: " . count($missing) . "\n";
