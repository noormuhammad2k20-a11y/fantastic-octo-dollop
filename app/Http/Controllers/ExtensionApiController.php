<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\ToolAnalytics;

class ExtensionApiController extends Controller
{
    /**
     * Return lightweight tool metadata for the extension search/list.
     * Excludes heavy SEO content to keep extension snappy.
     */
    public function toolsMeta(Request $request)
    {
        $tools = Config::get('tools.tools', []);
        $proCalculators = Config::get('pro_calculators', []);
        
        $meta = [];
        
        // Merge standard tools
        foreach ($tools as $slug => $tool) {
            $meta[] = [
                'slug' => $slug,
                'title' => $tool['h1'] ?? ($tool['title'] ?? 'Tool'),
                'icon' => $tool['icon'] ?? 'fas fa-tools',
                'category' => $tool['category'] ?? 'utility',
            ];
        }
        
        // Merge pro calculators
        foreach ($proCalculators as $slug => $tool) {
            $meta[] = [
                'slug' => $slug,
                'title' => $tool['h1'] ?? ($tool['title'] ?? 'Calculator'),
                'icon' => $tool['icon'] ?? 'fas fa-calculator',
                'category' => $tool['category'] ?? 'finance',
            ];
        }
        
        return response()->json([
            'status' => 'success',
            'count' => count($meta),
            'tools' => $meta
        ]);
    }

    /**
     * Return top 10 trending tools based on website analytics.
     */
    public function trending(Request $request)
    {
        $trending = ToolAnalytics::orderBy('view_count', 'desc')
            ->take(12)
            ->get();
            
        return response()->json([
            'status' => 'success',
            'trending' => $trending
        ]);
    }

    /**
     * Track extension-specific usage events (anonymous).
     */
    public function trackEvent(Request $request)
    {
        $validated = $request->validate([
            'event' => 'required|string',
            'tool_slug' => 'nullable|string',
            'version' => 'nullable|string',
        ]);
        
        // Log event for internal metrics
        \Illuminate\Support\Facades\Log::info('Extension Event: ' . json_encode($validated));
        
        return response()->json(['status' => 'recorded']);
    }

    /**
     * Sync favorites (V2 feature, currently placeholder).
     */
    public function syncFavorites(Request $request)
    {
        return response()->json(['status' => 'not_available', 'message' => 'Sync available in V2']);
    }
}
