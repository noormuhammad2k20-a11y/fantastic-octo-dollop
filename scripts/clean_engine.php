<?php
/**
 * scripts/clean_engine.php
 * Removes incorrectly appended stubs from the engine file.
 */

$enginePath = 'd:\\Xamp\\htdocs\\ToolsHub\\public\\js\\pro-calculator-engine.js';
$engine = file_get_contents($enginePath);

// Find the last legitimate part of the class
$marker = "    formatCurrency(val) {
        return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(val);
    }
}";

$pos = strpos($engine, $marker);
if ($pos !== false) {
    $cleanEngine = substr($engine, 0, $pos + strlen($marker));
    $cleanEngine .= "\n\n// Global initialization\ndocument.addEventListener('DOMContentLoaded', () => {\n    new ProCalculatorEngine('pro-calculator-container');\n});\n";
    file_put_contents($enginePath, $cleanEngine);
    echo "Engine cleaned and restored to valid state.\n";
} else {
    echo "Marker not found. Manual cleanup required.\n";
}
