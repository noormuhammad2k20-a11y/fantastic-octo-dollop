<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Services\Seo\SeoSchemaGenerator;
use App\Services\Seo\PseoModifierEngine;

class SeoToolController extends Controller
{
    /**
     * Lazy-loaded SEO pages cache (per-request).
     * Avoids loading the massive 4.2MB config file on every request via config().
     */
    protected static ?array $seoPages = null;

    /**
     * Load SEO pages only when needed (lazy).
     */
    protected static function getSeoPages(): array
    {
        if (self::$seoPages === null) {
            $path = storage_path('seo_pages.php');
            if (file_exists($path)) {
                $data = include $path;
                self::$seoPages = $data['pages'] ?? [];
            } else {
                self::$seoPages = [];
            }
        }
        return self::$seoPages;
    }

    /**
     * Display an SEO landing page.
     */
    public function show(string $slug, string $params = null)
    {
        $seoPages = self::getSeoPages();
        
        // 1. Direct hit in seo_pages.php cache
        if (isset($seoPages[$slug])) {
            $page = $seoPages[$slug];
            $toolSlug = $page['tool_slug'] ?? $slug;
            return $this->renderSeoPage($toolSlug, $page, $slug);
        }

        // 2. Try to resolve via P-SEO Modifier Engine dynamically
        $modifiedTool = PseoModifierEngine::resolveModifier($slug);
        if ($modifiedTool) {
            // Treat the generated modifier output as an on-the-fly 'seo page'
            $page = [
                'h1' => $modifiedTool['h1'],
                'title' => $modifiedTool['title'],
                'meta_description' => $modifiedTool['description'],
                'article' => $modifiedTool['seo_article'],
                'faq' => $modifiedTool['faq'] ?? [],
            ];
            
            // Render it via the same pipeline, but pass the modified tool config directly
            return $this->renderSeoPage($modifiedTool['slug'], $page, $slug, $modifiedTool);
        }

        // 3. Fallback to regular ToolController for base tools
        return (new ToolController())->show($slug, $params);
    }

    /**
     * Renders the SEO tool page
     */
    protected function renderSeoPage(string $toolSlug, array $page, string $slug, array $prebuiltTool = null)
    {
        
        $tools = config('tools.tools');
        $proCalculators = config('pro_calculators') ?? [];
        
        if (!$prebuiltTool) {
            if (!isset($tools[$toolSlug]) && !isset($proCalculators[$toolSlug])) {
                abort(404, "Tool definition for '{$toolSlug}' not found in any config.");
            }
            $tool = isset($tools[$toolSlug]) ? (array)$tools[$toolSlug] : (array)$proCalculators[$toolSlug];
            $tool['slug'] = $toolSlug;
        } else {
            $tool = $prebuiltTool;
        }

        // Track the tool view dynamically
        try {
            \App\Models\ToolAnalytics::firstOrCreate(['tool_slug' => $toolSlug])->increment('view_count');
        } catch (\Exception $e) { \Illuminate\Support\Facades\Log::warning('ToolAnalytics tracking failed: ' . $e->getMessage()); }

        // Merge SEO specific data into tool config for the view
        $tool['title'] = $page['title'];
        $tool['description'] = $page['meta_description'];
        $tool['h1'] = $page['h1'];

        // Render article. If it already contains HTML tags, use it directly to prevent escaping. 
        // Otherwise, process as Markdown.
        $rawArticle = $page['article'] ?? $this->generateDefaultArticle($page);
        if (str_contains($rawArticle, '<p>') || str_contains($rawArticle, '<h2>') || str_contains($rawArticle, '<h3>')) {
            $tool['seo_article'] = $rawArticle;
        } else {
            $tool['seo_article'] = Str::markdown($rawArticle, ['html_input' => 'allow']);
        }

        $tool['faq'] = $page['faq'] ?? \App\Services\Seo\SeoAutoGenerator::generateFaq($tool);
        $tool['instructions'] = $page['instructions'] ?? \App\Services\Seo\SeoAutoGenerator::generateInstructions($tool);
        
        // Pre-set default options from the SEO config
        if (isset($page['default_options']) && is_array($tool['options'] ?? null)) {
            foreach ($tools[$toolSlug]['options'] as $index => $option) {
                if (isset($page['default_options'][$option['name']])) {
                    $tool['options'][$index]['default'] = $page['default_options'][$option['name']];
                }
            }
            // Also pass specific target values if needed for the frontend
            $tool['target_values'] = $page['default_options'];
        }

        $relatedSlugs = $page['related_slugs'] ?? $page['internal_links'] ?? [];
        $relatedTools = [];
        
        // Build related sections (mix of SEO pages and tools)
        foreach ($relatedSlugs as $relSlug) {
            $relSlug = ltrim($relSlug, '/');
            if (isset($seoPages[$relSlug])) {
                $relPage = $seoPages[$relSlug];
                $relToolSlug = $relPage['tool_slug'] ?? $relSlug;
                $icon = $tools[$relToolSlug]['icon'] ?? ($proCalculators[$relToolSlug]['icon'] ?? 'fas fa-tools');
                
                $relatedTools[$relSlug] = [
                    'h1' => $relPage['h1'],
                    'description' => $relPage['meta_description'],
                    'icon' => $icon,
                ];
            } elseif (isset($tools[$relSlug]) || isset($proCalculators[$relSlug])) {
                $relTool = $tools[$relSlug] ?? $proCalculators[$relSlug];
                $relatedTools[$relSlug] = [
                    'h1' => $relTool['h1'] ?? $relTool['title'],
                    'description' => $relTool['description'],
                    'icon' => $relTool['icon'],
                ];
            }
        }
        
        // Ensure at least 12 related tools for SEO (Internal Linking)
        if (count($relatedTools) < 12) {
            $currentKeys = array_keys($relatedTools);
            $filler = collect(config('tools.tools'))
                ->where('category', $tool['category'] ?? 'utility')
                ->forget(array_merge([$slug], $currentKeys))
                ->shuffle()
                ->take(12 - count($relatedTools));

            foreach ($filler as $fSlug => $fTool) {
                $relatedTools[$fSlug] = [
                    'h1' => $fTool['h1'] ?? ($fTool['title'] ?? 'Tool'),
                    'description' => $fTool['description'] ?? ($fTool['subtitle'] ?? ''),
                    'icon' => $fTool['icon'] ?? 'fas fa-tools',
                ];
            }
        }

        // Unified JSON-LD @graph schema
        $categories = config('tools.categories');
        $categoryData = $categories[$tool['category'] ?? ''] ?? null;
        $faqData = $tool['faq'] ?? null;
        $schemaGenerator = new SeoSchemaGenerator();
        $schemaMarkup = $schemaGenerator->generate($tool, url()->current(), $faqData, $categoryData);
        View::share('schemaMarkup', $schemaMarkup);

        return view('tools.seo_tool', compact('tool', 'slug', 'tools', 'relatedTools', 'page', 'schemaMarkup'));
    }


    /**
     * Temporary mock for article generation (will be replaced with actual content in config)
     */
    protected function generateDefaultArticle($page)
    {
        return "This is a high-quality SEO optimized article about " . $page['h1'] . ". It explains why you need to " . strtolower($page['h1']) . " and how our tool provides the best solution. We focus on speed, security, and quality.";
    }

    /**
     * Temporary mock for FAQ generation
     */
    protected function generateDefaultFaq($page)
    {
        return [
            ['q' => "How do I " . strtolower($page['h1']) . "?", 'a' => "Simply upload your file and click process. It's that easy!"],
            ['q' => "Is it free to " . strtolower($page['h1']) . "?", 'a' => "Yes, our tool is 100% free and requires no registration."],
        ];
    }
}
