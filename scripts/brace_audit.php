<?php
$content = file_get_contents(__DIR__ . '/../public/js/pro-calculator-engine.js');
$lines = explode("\n", $content);
$level = 0;

foreach ($lines as $i => $line) {
    $lineNum = $i + 1;
    // Simple count (ignoring strings/regex for now as a heuristic)
    $opens = substr_count($line, '{');
    $closes = substr_count($line, '}');
    
    $oldLevel = $level;
    $level += $opens;
    $level -= $closes;
    
    if ($level == 0 && $oldLevel > 0) {
        echo "Level 0 reached at Line $lineNum: $line\n";
    }
}
echo "Final level: $level\n";
