<?php

$tools_path = 'd:/Xamp/htdocs/ToolsHub/config/tools.php';
$tool_txt_path = 'd:/Xamp/htdocs/ToolsHub/tool.txt';

if (!file_exists($tools_path) || !file_exists($tool_txt_path)) {
    die("Files missing.\n");
}

$active_tools = include $tools_path;
$active_slugs = array_keys($active_tools['tools']);

$tool_txt_content = file_get_contents($tool_txt_path);
$lines = explode("\n", $tool_txt_content);

$missing_tools = [];
foreach ($lines as $line) {
    $line = trim($line);
    // Skip empty lines and headers
    if (empty($line) || preg_match('/^[⚽🔒🛠️]|\(Missing\)/u', $line)) {
        continue;
    }
    
    // Remove leading numbers (e.g., "819. ")
    $name = preg_replace('/^\d+\.\s+/', '', $line);
    
    // Generate a potential slug from the name
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
    
    // Check if the slug exists in the active slugs
    if (!in_array($slug, $active_slugs)) {
        $missing_tools[] = [
            'name' => $name,
            'slug' => $slug
        ];
    }
}

echo "Total Tools in tool.txt Analyzed: " . count($lines) . "\n";
echo "Total Missing Tools: " . count($missing_tools) . "\n\n";

foreach ($missing_tools as $m) {
    echo "- " . $m['name'] . " (" . $m['slug'] . ")\n";
}
