<?php
$file = 'd:/Xamp/htdocs/ToolsHub/config/tools.php';
$content = file_get_contents($file);
$lines = explode("\n", $content);

$tools = [
    'chemical-equation-balancer' => 'Chemical Equation Balancer',
    'molar-mass-calculator' => 'Molar Mass Calculator',
    'ideal-gas-law-calculator' => 'Ideal Gas Law Calculator',
    'ph-calculator' => 'pH Calculator',
    'molarity-calculator' => 'Molarity Calculator',
    'percent-yield-calculator' => 'Percent Yield Calculator',
    'boiling-point-calculator' => 'Boiling Point Calculator',
    'scientific-notation-calculator' => 'Scientific Notation Calculator',
    'significant-figures-calculator' => 'Significant Figures Calculator',
    'grams-to-moles-calculator' => 'Grams to Moles Calculator',
    'empirical-formula-calculator' => 'Empirical Formula Calculator',
    'mole-gram-particle-converter' => 'Mole Gram Particle Converter',
    'stoichiometry-calculator' => 'Stoichiometry Calculator',
    'titration-calculator' => 'Titration Calculator',
    'banana-radiation-calculator' => 'Banana Radiation Calculator',
    'falling-through-earth' => 'Falling Through Earth',
    'penny-drop-impact' => 'Penny Drop Impact',
    'chemistry-equation-balancer' => 'Chemistry Equation Balancer',
    'solution-dilution-calc' => 'Solution Dilution Calc',
    'periodic-table-analyzer' => 'Periodic Table Analyzer',
    'ph-poh-calculator' => 'pH pOH Calculator',
    'chemical-element-lookup' => 'Chemical Element Lookup',
    'reaction-yield-calc' => 'Reaction Yield Calc',
    'refractive-index-calc' => 'Refractive Index Calc',
    'sourdough-bakers-calc' => 'Sourdough Bakers Calc',
    'coffee-brew-optimizer' => 'Coffee Brew Optimizer',
];

$changes = 0;

foreach ($tools as $slug => $h1) {
    // Find the slug line index
    $slugLine = -1;
    for ($i = 0; $i < count($lines); $i++) {
        if (strpos($lines[$i], "'" . $slug . "'") !== false && strpos($lines[$i], '=>') !== false) {
            $slugLine = $i;
            break;
        }
    }
    if ($slugLine === -1) {
        echo "SKIP: $slug not found\n";
        continue;
    }
    
    // Only search within +50 lines of the slug (the tool's config block)
    $end = min($slugLine + 50, count($lines) - 1);
    $typeFixed = false;
    $procFixed = false;
    $h1Fixed = false;
    
    for ($j = $slugLine + 1; $j <= $end; $j++) {
        // Stop if we hit the next tool key (same indent level)
        if ($j > $slugLine + 2 && preg_match("/^\s{8}'[a-z]/", $lines[$j]) && strpos($lines[$j], '=>') !== false) {
            break;
        }
        
        if (!$typeFixed && preg_match("/^(\s+'type'\s*=>\s*)'[^']*'(.*)$/", $lines[$j], $m)) {
            $lines[$j] = $m[1] . "'interactive'" . $m[2];
            $typeFixed = true;
            $changes++;
        }
        
        if (!$procFixed && preg_match("/^(\s+'processor'\s*=>\s*)'[^']*'(.*)$/", $lines[$j], $m)) {
            $lines[$j] = $m[1] . "'interactive'" . $m[2];
            $procFixed = true;
            $changes++;
        }
        
        if (!$h1Fixed && preg_match("/^(\s+'h1'\s*=>\s*)'[^']*'(.*)$/", $lines[$j], $m)) {
            $lines[$j] = $m[1] . "'" . $h1 . "'" . $m[2];
            $h1Fixed = true;
            $changes++;
        }
    }
    
    echo "$slug: type=" . ($typeFixed?"Y":"N") . " proc=" . ($procFixed?"Y":"N") . " h1=" . ($h1Fixed?"Y":"N") . "\n";
}

file_put_contents($file, implode("\n", $lines));
echo "\nTotal changes: $changes\n";
