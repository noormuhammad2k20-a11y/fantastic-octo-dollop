<?php
$file = 'd:/Xamp/htdocs/ToolsHub/config/tools.php';
$content = file_get_contents($file);

$content = str_replace(
    "'h1' => 'Volume of Ellipsoid Calculator',",
    "'h1' => 'Ellipsoid Volume Calculator',",
    $content
);

$content = str_replace(
    "'h1' => 'Volume of Sphere Calculator',",
    "'h1' => 'Sphere Volume Calculator',",
    $content
);

file_put_contents($file, $content);
echo "H1s updated successfully.\n";
