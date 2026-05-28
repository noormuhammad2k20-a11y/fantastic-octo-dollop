<?php
$file = 'config/pro_calculators.php';
$content = file_get_contents($file);

// We only want to target the tools from 'business_valuation_pro' onwards
// These are the 78 new tools.
// They all follow the pattern 'something_something_pro' => [

$pattern = "/'([a-z0-9_]+)_pro' => \[/";
$replacement = function($matches) {
    $slug = str_replace('_', '-', $matches[1]);
    return "'$slug-pro' => [";
};

// We need to be careful not to touch the 'engine' values inside the config, 
// because those must match the JS methods which use underscores.
// The regex above specifically targets the ARRAY KEYS at the start of the line (or with some indent).

$newContent = preg_replace_callback($pattern, $replacement, $content);

file_put_contents($file, $newContent);
echo "Migration complete. Check GDPR for example.\n";
