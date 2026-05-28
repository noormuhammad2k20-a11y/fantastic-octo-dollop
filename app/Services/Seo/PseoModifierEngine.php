<?php

namespace App\Services\Seo;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;

class PseoModifierEngine
{
    /**
     * Tries to resolve a given slug against known modifiers.
     * Returns the modified tool config array if matched, null otherwise.
     */
    public static function resolveModifier(string $slug): ?array
    {
        // For performance, cache the resolution result
        return Cache::store(config('cache.default') === 'redis' ? 'redis' : 'file')->remember('pseo:modifier:'.$slug, 3600 * 24, function () use ($slug) {
            $modifiers = config('seo.modifiers', []);
            $tools = config('tools.tools', []);
            $proCalculators = config('pro_calculators', []);
            $allTools = array_merge($tools, $proCalculators);

            foreach ($modifiers as $modifierKey => $modifierConfig) {
                $pattern = $modifierConfig['pattern'];

                // Convert pattern to regex
                // e.g. '{slug}-free-online' -> '^(.*?)-free-online$'
                // 'bulk-{slug}' -> '^bulk-(.*?)$'
                
                $regex = '/^' . str_replace('{slug}', '(.*)', preg_quote($pattern, '/')) . '$/i';

                if (preg_match($regex, $slug, $matches)) {
                    $baseSlug = $matches[1];

                    // Verify the base slug is an actual tool
                    if (isset($allTools[$baseSlug])) {
                        return self::buildModifiedTool($allTools[$baseSlug], $baseSlug, $modifierKey, $modifierConfig);
                    }
                }
            }

            return null;
        });
    }

    /**
     * Constructs the customized tool definition based on the modifier templates.
     */
    protected static function buildModifiedTool(array $baseTool, string $baseSlug, string $modifierKey, array $modifierConfig): array
    {
        $modifiedTool = $baseTool;
        $modifiedTool['slug'] = $baseSlug; // Important: The tool processor logic still needs the base slug
        $modifiedTool['pseo_modifier'] = $modifierKey; // Flag that this is a P-SEO generated page
        
        $baseName = $baseTool['name'] ?? $baseTool['title'] ?? 'Tool';
        $baseName = str_replace(['Calculator', 'Converter', 'Generator', 'Tool'], '', $baseName);
        $baseName = trim($baseName);

        // Apply templates
        $modifiedTool['title'] = str_replace('{tool_name}', $baseName, $modifierConfig['title_template']);
        $modifiedTool['description'] = str_replace('{tool_name}', $baseName, $modifierConfig['description_template']);
        $modifiedTool['h1'] = str_replace('{tool_name}', $baseName, $modifierConfig['h1_template']);

        // Generate tailored SEO article
        $modifiedTool['seo_article'] = self::generateTailoredArticle($modifiedTool, $modifierKey, $baseName);
        
        // Generate tailored FAQ
        $modifiedTool['faq'] = self::generateTailoredFaq($modifiedTool, $modifierKey, $baseName);

        return $modifiedTool;
    }

    protected static function generateTailoredArticle(array $tool, string $modifierKey, string $baseName): string
    {
        $h1 = $tool['h1'];
        $desc = $tool['description'];
        
        $article = "<h2>The Ultimate $h1 Guide</h2>\n";
        $article .= "<p>$desc</p>\n";
        $article .= "<p>In today's fast-paced digital world, finding reliable and high-performance utilities is critical. Our $h1 solution is engineered specifically to address these modern demands.</p>\n";
        
        if ($modifierKey === 'bulk') {
            $article .= "<h3>Why Batch Process $baseName?</h3>\n";
            $article .= "<p>Processing files individually is tedious. With our bulk processing engine, you can queue multiple files simultaneously, leveraging advanced client-side processing to get results instantly without overloading your network.</p>\n";
        } elseif ($modifierKey === 'high-performance') {
            $article .= "<h3>Optimized for Speed and Precision</h3>\n";
            $article .= "<p>We've implemented cutting-edge WebAssembly (Wasm) and highly optimized JavaScript workers to ensure that your $baseName operations execute at native speeds right in your browser.</p>\n";
        } elseif (in_array($modifierKey, ['for-mac', 'for-windows', 'for-mobile'])) {
            $platform = str_replace('for-', '', $modifierKey);
            $article .= "<h3 style='text-transform:capitalize;'>Seamless Integration on $platform</h3>\n";
            $article .= "<p>Unlike native applications that require installation and system resources, our $h1 runs entirely within your browser environment. It is fully cross-platform compatible and optimized for $platform.</p>\n";
        }

        $article .= "<h3>Security and Privacy First</h3>\n";
        $article .= "<p>All calculations and operations for the $h1 are performed securely. We prioritize your privacy, ensuring that sensitive data is handled locally whenever possible.</p>\n";

        return $article;
    }

    protected static function generateTailoredFaq(array $tool, string $modifierKey, string $baseName): array
    {
        $faqs = [];
        $h1 = $tool['h1'];

        $faqs[] = [
            'question' => "Is the $h1 completely free to use?",
            'answer'   => "Yes! You can use our $h1 tool 100% free of charge without creating an account or downloading any software."
        ];

        if ($modifierKey === 'bulk') {
            $faqs[] = [
                'question' => "How many files can I process with the $h1 at once?",
                'answer'   => "Our bulk engine allows you to queue a large number of files depending on your system's memory. It processes them sequentially or in parallel for maximum efficiency."
            ];
        } elseif ($modifierKey === 'high-performance') {
            $faqs[] = [
                'question' => "Why is this $h1 faster than other tools?",
                'answer'   => "We utilize optimized algorithms and client-side processing where possible, meaning no wait times for server uploads or queueing."
            ];
        } elseif ($modifierKey === 'api') {
            $faqs[] = [
                'question' => "How do I integrate the $h1 API?",
                'answer'   => "You can access our REST endpoints programmatically. Currently, we support standard JSON requests and responses for easy integration."
            ];
        } else {
            $faqs[] = [
                'question' => "Does the $h1 work on mobile devices?",
                'answer'   => "Absolutely. Our tools are fully responsive and work seamlessly on iPhones, iPads, and Android devices."
            ];
        }

        return $faqs;
    }
}
