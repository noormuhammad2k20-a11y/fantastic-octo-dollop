<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage with all tool categories.
     */
    /**
     * Get the consolidated list of categories.
     */
    private function getCategories()
    {
        $categories = config('tools.categories') ?? [];
        
        $categories['uncategorized-tools'] = [
            'name' => 'Uncategorized Tools',
            'icon' => 'fas fa-box-open',
            'color' => 'utils',
            'description' => 'A collection of tools that do not belong to a specific category or are currently unlisted.'
        ];
        
        return $categories;
    }


    /**
     * Get the consolidated list of tools.
     */
    private function getTools()
    {
        $tools = config('tools.tools');
        $proCalculators = config('pro_calculators') ?? [];
        $allTools = array_merge($tools, $proCalculators);
        
        $categories = config('tools.categories') ?? [];
        
        foreach ($allTools as $slug => &$tool) {
            $cat = $tool['category'] ?? null;
            
            $isUndefinedCategory = $cat && !isset($categories[$cat]);
            $isUnlistedCategory = $cat && isset($categories[$cat]) && !empty($categories[$cat]['unlisted']);
            $isDirectlyUnlisted = !empty($tool['unlisted']);
            
            if (!$cat || $isUndefinedCategory || $isUnlistedCategory || $isDirectlyUnlisted) {
                $tool['category'] = 'uncategorized-tools';
                if (isset($tool['unlisted'])) {
                    $tool['unlisted'] = false;
                }
            }
        }
        
        return $allTools;
    }

    /**
     * Display the homepage with all tool categories.
     */
    public function index()
    {
        $tools = $this->getTools();
        $categories = $this->getCategories();

        $totalToolsCount = count($tools);
        
        // Fetch dynamic popular tools from the database
        $topSlugs = [];
        try {
            $topSlugs = \App\Models\ToolAnalytics::orderByDesc('view_count')
                ->limit(12)
                ->pluck('tool_slug')
                ->toArray();
        } catch (\Exception $e) { 
            \Illuminate\Support\Facades\Log::error("Failed to fetch popular tools: " . $e->getMessage()); 
        }

        $popularTools = [];
        foreach ($topSlugs as $slug) {
            if (isset($tools[$slug])) {
                $popularTools[$slug] = $tools[$slug];
            }
        }

        // Fallback for new installations or empty analytics tables
        if (count($popularTools) < 12) {
            foreach (array_slice($tools, 0, 24, true) as $fSlug => $fTool) {
                if (!isset($popularTools[$fSlug])) {
                    $popularTools[$fSlug] = $fTool;
                }
                if (count($popularTools) >= 12) break;
            }
        }

        // Prepare lightweight tools list for JS Live Search
        $searchTools = collect($tools)->map(function ($t, $slug) {
            return [
                'slug' => $slug,
                'name' => $t['h1'] ?? $t['name'] ?? 'Tool',
                'description' => $t['description'] ?? '',
                'icon' => $t['icon'] ?? 'fas fa-tools',
                'category' => $t['category'] ?? ''
            ];
        })->values()->toArray();

        // Pass mapping of categories to avoid view logic processing counts
        $categoryCounts = collect($tools)->countBy('category')->toArray();

        return view('home', compact('categories', 'popularTools', 'searchTools', 'totalToolsCount', 'categoryCounts'));
    }

    /**
     * Display tools within a specific category.
     */
    public function showCategory($slug)
    {
        $categories = $this->getCategories();
        
        if (!isset($categories[$slug])) {
            abort(404, 'Category not found');
        }

        $tools = $this->getTools();
        
        $categoryName = $categories[$slug]['name'] ?? 'Category';
        $category = $categories[$slug];
        
        // Filter tools for this category
        $categoryTools = collect($tools)->filter(function ($t) use ($slug) {
            return isset($t['category']) && $t['category'] === $slug;
        })->toArray();

        $totalToolsCount = count($tools); // For global header/footer usage

        return view('category', compact('categoryName', 'category', 'categoryTools', 'slug', 'totalToolsCount'));
    }
}
