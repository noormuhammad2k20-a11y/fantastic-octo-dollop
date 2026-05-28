<?php
// Revert the 5 existing social media tools back to social.generate
$dir = 'd:/Xamp/htdocs/ToolsHub/resources/views/tools/interactive/';
$socialTools = [
    'youtube-title-generator.blade.php',
    'instagram-bio-generator.blade.php',
    'tiktok-username-generator.blade.php',
    'instagram-caption-generator.blade.php',
    'youtube-description-generator.blade.php',
];
foreach ($socialTools as $file) {
    $path = $dir . $file;
    if (file_exists($path)) {
        $content = file_get_contents($path);
        if (strpos($content, 'ai.generate') !== false) {
            $content = str_replace('ai.generate', 'social.generate', $content);
            file_put_contents($path, $content);
            echo "Reverted: {$file}\n";
        }
    }
}
echo "Done.\n";
