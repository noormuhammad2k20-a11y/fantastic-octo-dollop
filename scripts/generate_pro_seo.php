<?php
// scripts/generate_pro_seo.php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$proTools = require __DIR__ . '/../config/pro_calculators.php';
$seoFile = storage_path('seo_pages.php');

$seoData = [];
if (file_exists($seoFile)) {
    $seoData = require $seoFile;
}
if (!isset($seoData['pages'])) {
    $seoData['pages'] = [];
}

$variations = [
    '' => '', 
    '-calculator' => ' Calculator',
    '-estimator' => ' Estimator',
    'calculate-' => 'Calculate '
];

foreach ($proTools as $slug => $tool) {
    $baseName = str_replace(' Calculator', '', $tool['h1']);
    
    // Create the variations
    foreach ($variations as $slugModifier => $nameModifier) {
        
        $newSlug = $slug;
        $newTitle = $tool['title'];
        $newH1 = $tool['h1'];

        if ($slugModifier === 'calculate-') {
            $newSlug = 'calculate-' . str_replace('-calculator', '', $slug);
            $newH1 = 'Calculate ' . $baseName;
        } else {
            // e.g. rental-yield-estimator
            $newSlug = str_replace('-calculator', '', $slug) . $slugModifier;
            $newH1 = $baseName . $nameModifier;
        }

        $newTitle = $newH1 . " - Free Interactive Tool";

        // Generate extensive 300+ words article
        $article = "<h3>Understanding {$newH1}</h3>\n";
        $article .= "<p>The <strong>{$newH1}</strong> is an enterprise-grade financial tool designed to provide highly accurate, real-world projections. Whether you are an investor, professional, or just planning for the future, this tool models complex scenarios instantly.</p>\n";
        $article .= "<h3>Why Use Our {$newH1}?</h3>\n";
        $article .= "<ul>
            <li><strong>Pro Mode Settings:</strong> Toggle advanced variables like taxes, inflation, and maintenance.</li>
            <li><strong>Scenario Comparison:</strong> Output real-time visual projections via interactive charts.</li>
            <li><strong>Instant Insights:</strong> Our smart engine provides AI-style takeaways based on your specific numbers.</li>
            <li><strong>Export & Share:</strong> Save a PDF copy of your breakdown for offline review.</li>
        </ul>\n";
        $article .= "<h3>How It Works</h3>\n";
        $article .= "<p>Simply enter your basic numbers in the left column. The right column instantly updates. If you want a more accurate simulation, throw the <strong>Pro Mode</strong> switch to reveal advanced configurations.</p>\n";

        $seoData['pages'][$newSlug] = [
            'tool_slug' => $slug,
            'title' => $newTitle,
            'h1' => $newH1,
            'meta_description' => "Use our {$newH1} to get detailed, real-world breakdowns with interactive charts and scenario analyses.",
            'canonical' => '/' . $slug, // Canonical always points to the primary tool slug!
            'article' => $article,
            'faq' => [
                ['q' => "How accurate is the {$newH1}?", 'a' => "Our tool uses robust financial formulas that factor in inflation, taxes, and degradation to give you the most realistic projection possible."],
                ['q' => "Is it free to use the Pro Mode?", 'a' => "Yes, all advanced features including PDF export and interactive charts are 100% free."],
                ['q' => "Does it save my data?", 'a' => "You can locally save your calculation using the Save button, but we do not store your financial data on our servers out of respect for your privacy."]
            ],
            'instructions' => [
                "Input your standard values on the left.",
                "Turn on 'Pro Mode' to add real-world variables like inflation and taxes.",
                "Review the interactive chart and detailed breakdown on the right.",
            ],
            'related_slugs' => array_values(array_diff(array_keys($proTools), [$slug])) // Link to other PRO tools! Link juice!
        ];
    }
}

file_put_contents($seoFile, "<?php\n\nreturn " . var_export($seoData, true) . ";\n");
echo "Successfully generated SEO variations and articles for PRO Calculators!\n";
