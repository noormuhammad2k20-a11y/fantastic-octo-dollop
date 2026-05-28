<?php

namespace App\View\Composers;

use Illuminate\View\View;

class FooterComposer
{
    public function compose(View $view): void
    {
        // Cache the footer clusters for 1 hour to avoid re-computing on every page load
        $clusters = cache()->remember('footer_tool_clusters', 3600, function () {
            $allTools = collect(config('tools.tools', []))
                          ->merge(config('pro_calculators', []));

            // Top 6 most link-worthy categories
            $topCats = ['finance', 'health', 'calculators', 'math', 'text', 'webmaster'];

            // Try to use ToolAnalytics for popularity ordering, otherwise fall back to alphabetical
            $popularSlugs = [];
            try {
                $popularSlugs = \App\Models\ToolAnalytics::orderByDesc('view_count')
                    ->pluck('view_count', 'tool_slug')
                    ->toArray();
            } catch (\Exception $e) {
                // Analytics table may not exist yet
            }

            return collect($topCats)->mapWithKeys(function ($cat) use ($allTools, $popularSlugs) {
                $catName = config('tools.categories.' . $cat . '.name', ucfirst($cat));

                $catTools = $allTools->filter(function ($tool) use ($cat) {
                    return ($tool['category'] ?? '') === $cat;
                });

                // Sort by popularity if analytics data exists, otherwise alphabetically
                if (!empty($popularSlugs)) {
                    $catTools = $catTools->sortByDesc(function ($tool, $slug) use ($popularSlugs) {
                        return $popularSlugs[$slug] ?? 0;
                    });
                } else {
                    $catTools = $catTools->sortBy(function ($tool) {
                        return $tool['name'] ?? $tool['h1'] ?? '';
                    });
                }

                $tools = $catTools->take(5)->map(function ($tool, $slug) {
                    $tool['slug'] = $slug;
                    return $tool;
                })->values();

                return [$catName => $tools];
            })->filter(function ($tools) {
                return $tools->isNotEmpty();
            });
        });

        $view->with('footerClusters', $clusters);
    }
}
