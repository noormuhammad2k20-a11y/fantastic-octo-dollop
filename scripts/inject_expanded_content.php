<?php
/**
 * Robust SEO Content Injection Script
 * Reads expansion from JSON and updates storage/seo_pages.php
 */

$jsonFile = __DIR__ . '/../tmp/math_expansion.json';
$seoFile = __DIR__ . '/../storage/seo_pages.php';

if (!file_exists($jsonFile)) {
    die("Error: Expansion JSON not found at $jsonFile\n");
}

if (!file_exists($seoFile)) {
    die("Error: SEO Pages file not found at $seoFile\n");
}

$expansion = json_decode(file_get_contents($jsonFile), true);
if (!$expansion) {
    die("Error: Failed to decode expansion JSON\n");
}

echo "Loading SEO pages (17MB)... This may take a moment.\n";
ini_set('memory_limit', '1024M');
$existing = include $seoFile;

if (!isset($existing['pages'])) {
    die("Error: 'pages' key not found in seo_pages.php\n");
}

$updatedCount = 0;
foreach ($expansion as $slug => $articleContent) {
    if (isset($existing['pages'][$slug])) {
        $existing['pages'][$slug]['article'] = $articleContent;
        $updatedCount++;
    } else {
        echo "Warning: Slug '$slug' not found in seo_pages.php\n";
    }
}

echo "Generating exported array...\n";
$export = var_export($existing, true);
$content = "<?php\n\nreturn " . $export . ";\n";

echo "Writing to temporary file...\n";
$tempFile = $seoFile . '.tmp';
if (file_put_contents($tempFile, $content)) {
    echo "Verifying temporary file syntax...\n";
    exec("php -l " . escapeshellarg($tempFile), $output, $returnVar);
    if ($returnVar === 0) {
        if (rename($tempFile, $seoFile)) {
            echo "Successfully expanded SEO content for $updatedCount math tools in storage/seo_pages.php\n";
        } else {
            echo "Error: Failed to rename temporary file to $seoFile\n";
        }
    } else {
        echo "Error: Syntax check failed for the new content. Check $tempFile\n";
        print_r($output);
    }
} else {
    echo "Error: Failed to write to temporary file $tempFile\n";
}
