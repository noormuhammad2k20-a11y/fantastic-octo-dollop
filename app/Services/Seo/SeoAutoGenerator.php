<?php

namespace App\Services\Seo;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class SeoAutoGenerator
{
    /**
     * Generate a default meta description for a tool.
     */
    public static function generateDescription(array $tool): string
    {
        $cacheKey = 'seo:desc:' . md5($tool['h1'] ?? $tool['title'] ?? $tool['name'] ?? 'tool');
        
        return Cache::store(config('cache.default') === 'redis' ? 'redis' : 'file')->remember($cacheKey, 3600 * 24, function () use ($tool) {
            $name = $tool['h1'] ?? $tool['title'] ?? $tool['name'] ?? 'Online Tool';
            $category = $tool['category'] ?? 'Utility';
            $lowerName = strtolower($name);
            
            $actions = [
                'calculator' => ['calculate accurate results instantly', 'perform complex calculations with precision', 'get instant estimates'],
                'converter' => ['convert files quickly without quality loss', 'switch formats seamlessly online', 'transform your files securely'],
                'generator' => ['generate unique data instantly', 'create custom outputs securely', 'build random and secure content'],
                'compressor' => ['reduce file sizes drastically while keeping quality', 'shrink your files for easier sharing', 'compress data instantly online'],
                'formatter' => ['beautify and format your code or text', 'clean up your text instantly', 'structure your data perfectly'],
                'extractor' => ['extract essential data from your files', 'pull out the information you need quickly', 'parse and extract content securely'],
                'downloader' => ['download media safely and fast', 'save online content to your device', 'grab your favorite media seamlessly']
            ];

            $actionChoices = ['process your data seamlessly', 'handle your files efficiently', 'get instant results online'];
            foreach ($actions as $key => $choices) {
                if (str_contains($lowerName, $key)) {
                    $actionChoices = $choices;
                    break;
                }
            }

            $action = $actionChoices[array_rand($actionChoices)];

            $templates = [
                "Use the free {$name} to {$action}. Our {$category} tool is fast, secure, and requires no installation.",
                "Looking for a {$name}? Easily {$action} directly in your browser. 100% free and secure on ToolsHub.",
                "The {$name} helps you {$action}. It's a professional-grade {$category} utility that works instantly online.",
                "Instantly {$action} with our {$name}. A fully free {$category} tool with no signup required.",
                "Access the best {$name} to {$action}. Secure, fast, and completely free to use right now."
            ];

            $desc = $templates[array_rand($templates)];
            
            // Maximum 155 chars for description to ensure it fits in most mobile SERPs
            if (strlen($desc) > 155) {
                return Str::limit($desc, 152, '...'); 
            }
            return $desc;
        });
    }

    /**
     * Generate a default title if missing.
     */
    public static function generateTitle(array $tool): string
    {
        $cacheKey = 'seo:title:' . md5($tool['h1'] ?? $tool['title'] ?? $tool['name'] ?? 'tool');

        return Cache::store(config('cache.default') === 'redis' ? 'redis' : 'file')->remember($cacheKey, 3600 * 24, function () use ($tool) {
            $name = $tool['h1'] ?? $tool['title'] ?? $tool['name'] ?? 'Professional Online Tool';
            $category = $tool['category'] ?? 'Utility';
            
            $presets = [
                "{$name} - 100% Free Online {$category} Tool | ToolsHub",
                "Free {$name} | Fast & Secure {$category} Utility",
                "Best {$name} Online — No Signup Required | ToolsHub",
            ];
            
            $title = $presets[array_rand($presets)];
            // Ensure the title doesn't exceed 60 chars
            return Str::limit($title, 60, '');
        });
    }

    public static function generateFaq(array $tool): array
    {
        $cacheKey = 'seo:faq:v3:' . md5($tool['h1'] ?? $tool['name'] ?? 'tool');

        return Cache::store(config('cache.default') === 'redis' ? 'redis' : 'file')->remember($cacheKey, 3600 * 24, function () use ($tool) {
            $name = $tool['h1'] ?? $tool['name'] ?? 'this tool';
            $category = $tool['category'] ?? 'utility';
            $lowerName = strtolower($name);
            $actionWord = str_contains($lowerName, 'calculator') ? 'calculations' : 
                          (str_contains($lowerName, 'converter') ? 'conversions' : 'processing');
            
            return [
                [
                    'q' => "How exactly does the {$name} work?",
                    'a' => "The {$name} utilizes advanced algorithms to perform {$actionWord} directly in your browser. By processing the specific parameters you input, it delivers highly accurate outputs tailored to your exact requirements."
                ],
                [
                    'q' => "Who can benefit the most from using this {$category} tool?",
                    'a' => "This tool is ideal for professionals, students, and everyday users who need quick and reliable {$actionWord}. Whether you are working on a complex project or simply need a fast solution, our {$name} provides professional-grade results."
                ],
                [
                    'q' => "Are the results from the {$name} accurate and reliable?",
                    'a' => "Yes, the {$name} is built on industry-standard formulas and best practices. We continuously test and refine our {$category} tools to ensure they produce precise, error-free results that you can confidently use for your tasks."
                ],
                [
                    'q' => "What are the common use cases for a {$name}?",
                    'a' => "Common applications involve scenarios where manual {$actionWord} would be too time-consuming or prone to human error. Our tool automates these workflows, allowing you to focus on analysis and productivity."
                ],
                [
                    'q' => "Can I use the {$name} for professional or academic projects?",
                    'a' => "Absolutely. The outputs generated by the {$name} are designed to meet rigorous professional and academic standards. Many of our users integrate these results directly into their reports, presentations, and daily workflows."
                ],
                [
                    'q' => "How can I get the best results when using this {$category} tool?",
                    'a' => "To achieve the most accurate outcomes, ensure that all input data you provide to the {$name} is correct and properly formatted. Double-checking your parameters before processing will yield the highest quality {$actionWord}."
                ],
                [
                    'q' => "Does the {$name} support advanced {$actionWord}?",
                    'a' => "Our {$name} is equipped to handle both basic and advanced scenarios within its {$category} category. It is optimized to manage complex variables smoothly, providing comprehensive results without any performance lag."
                ]
            ];
        });
    }

    /**
     * Generate dynamic instructions for a tool.
     */
    public static function generateInstructions(array $tool): array
    {
        $cacheKey = 'seo:instructions:' . md5($tool['h1'] ?? $tool['name'] ?? 'tool');

        return Cache::store(config('cache.default') === 'redis' ? 'redis' : 'file')->remember($cacheKey, 3600 * 24, function () use ($tool) {
            $name = $tool['h1'] ?? $tool['name'] ?? 'tool';
            $type = $tool['type'] ?? 'standard';
            
            if ($type === 'interactive' || in_array(($tool['processor'] ?? ''), ['pro_calculator', 'pro'])) {
                return [
                    "Enter your data or parameters into the interactive input fields provided above.",
                    "Review the results which are updated in real-time as you modify your inputs.",
                    "Copy the final output or analysis to your clipboard for your own use."
                ];
            }
            
            return [
                "Upload your file by dragging it into the designated upload zone or clicking to browse.",
                "Adjust any tool-specific options (like quality or format) and click the 'Process' button.",
                "Once processing is complete, preview your result and click 'Download' to save it to your device."
            ];
        });
    }
}
