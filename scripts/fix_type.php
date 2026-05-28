<?php
$file = 'd:/Xamp/htdocs/ToolsHub/config/tools.php';
$content = file_get_contents($file);

// For scientific-notation-calculator and significant-figures-calculator,
// add 'type' => 'interactive' before 'processor' line
$slugs = ['scientific-notation-calculator', 'significant-figures-calculator'];

foreach ($slugs as $slug) {
    $lines = explode("\n", $content);
    $found = false;
    for ($i = 0; $i < count($lines); $i++) {
        if (strpos($lines[$i], "'" . $slug . "'") !== false && strpos($lines[$i], '=>') !== false) {
            // Found the slug, now look for processor line without type before it
            for ($j = $i + 1; $j < min($i + 20, count($lines)); $j++) {
                if (strpos($lines[$j], "'processor'") !== false) {
                    // Check if type exists in lines between slug and processor
                    $hasType = false;
                    for ($k = $i; $k < $j; $k++) {
                        if (strpos($lines[$k], "'type'") !== false) {
                            $hasType = true;
                            break;
                        }
                    }
                    if (!$hasType) {
                        // Insert type line before processor
                        $indent = str_repeat(' ', strlen($lines[$j]) - strlen(ltrim($lines[$j])));
                        array_splice($lines, $j, 0, [$indent . "'type' => 'interactive',"]);
                        $content = implode("\n", $lines);
                        echo "Added 'type' => 'interactive' to $slug at line $j\n";
                    } else {
                        echo "$slug already has type key\n";
                    }
                    $found = true;
                    break;
                }
            }
            break;
        }
    }
    if (!$found) echo "Could not find processor for $slug\n";
}

file_put_contents($file, $content);
echo "Done\n";
