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
            
            $action = 'process your data and files seamlessly';
            $lowerName = strtolower($name);
            
            if (str_contains($lowerName, 'calculator')) $action = 'calculate complex results accurately and instantly';
            elseif (str_contains($lowerName, 'converter')) $action = 'convert files quickly between formats with high quality';
            elseif (str_contains($lowerName, 'generator')) $action = 'generate unique content, passwords, or data securely';
            elseif (str_contains($lowerName, 'compressor')) $action = 'reduce file sizes easily without losing quality';
            elseif (str_contains($lowerName, 'formatter')) $action = 'format and beautify code or text for better readability';
            elseif (str_contains($lowerName, 'extractor')) $action = 'extract important data or resources from your files';
            elseif (str_contains($lowerName, 'downloader')) $action = 'download media safely and efficiently from various sources';

            $desc = "{$name}: Use our professional-grade {$category} tool to {$action}. Fast, secure, and 100% free online utility with no signup or install required on ToolsHub.";
            
            // Maximum 155 chars for description to ensure it fits in most mobile SERPs
            return Str::limit($desc, 155, ''); 
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

    /**
     * Generate a dynamic FAQ for a tool based on its name and category.
     */
    public static function generateFaq(array $tool): array
    {
        $cacheKey = 'seo:faq:' . md5($tool['h1'] ?? $tool['name'] ?? 'tool');

        return Cache::store(config('cache.default') === 'redis' ? 'redis' : 'file')->remember($cacheKey, 3600 * 24, function () use ($tool) {
            $name = $tool['h1'] ?? $tool['name'] ?? 'this tool';
            $category = $tool['category'] ?? 'utility';
            
            return [
                [
                    'q' => "Is it free to use the {$name}?",
                    'a' => "Yes, our {$name} is 100% free to use. ToolsHub provides over 1,500 professional-grade utilities without any subscription or hidden fees."
                ],
                [
                    'q' => "Are my files secure when using the {$name}?",
                    'a' => "Absolutely. We prioritize your privacy. All files uploaded to our {$category} tools are processed on secure servers and automatically deleted immediately after processing."
                ],
                [
                    'q' => "Do I need to install any software for {$name}?",
                    'a' => "No installation is required. ToolsHub is a cloud-based platform, meaning you can use the {$name} directly in your web browser on any device."
                ],
                [
                    'q' => "Which browsers support the {$name}?",
                    'a' => "Our tools are optimized for all modern web browsers, including Google Chrome, Mozilla Firefox, Safari, and Microsoft Edge, as well as mobile browsers on iOS and Android."
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
