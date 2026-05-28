<?php
$file = 'd:/Xamp/htdocs/ToolsHub/config/tools.php';
$content = file_get_contents($file);

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

$lines = explode("\n", $content);
$changes = 0;

foreach ($tools as $slug => $h1) {
    $inBlock = false;
    $blockStart = -1;
    
    for ($i = 0; $i < count($lines); $i++) {
        // Find the slug line
        if (strpos($lines[$i], "'" . $slug . "'") !== false && strpos($lines[$i], '=>') !== false) {
            $inBlock = true;
            $blockStart = $i;
            continue;
        }
        
        if ($inBlock) {
            // Update type
            if (preg_match("/('type')\s*=>\s*'[^']*'/", $lines[$i])) {
                $lines[$i] = preg_replace("/('type')\s*=>\s*'[^']*'/", "'type' => 'interactive'", $lines[$i]);
                $changes++;
            }
            
            // Update processor
            if (preg_match("/('processor')\s*=>\s*'[^']*'/", $lines[$i])) {
                $lines[$i] = preg_replace("/('processor')\s*=>\s*'[^']*'/", "'processor' => 'interactive'", $lines[$i]);
                $changes++;
            }
            
            // Update h1 
            if (preg_match("/('h1')\s*=>\s*'[^']*'/", $lines[$i])) {
                $lines[$i] = preg_replace("/('h1')\s*=>\s*'[^']*'/", "'h1' => '" . addslashes($h1) . "'", $lines[$i]);
                $changes++;
            }
            
            // Stop after finding the next tool block (next slug key at same indent)
            if ($i > $blockStart + 2 && preg_match("/^\s{8}'[a-z]+-[a-z]/", $lines[$i]) && strpos($lines[$i], $slug) === false) {
                $inBlock = false;
            }
        }
    }
}

$newContent = implode("\n", $lines);
file_put_contents($file, $newContent);
echo "Config updated with $changes changes across " . count($tools) . " tools.\n";
