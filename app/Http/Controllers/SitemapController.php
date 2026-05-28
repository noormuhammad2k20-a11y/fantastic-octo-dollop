<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

/**
 * SitemapController — Generates chunked XML sitemaps and a sitemap index.
 *
 * Structure:
 *   /sitemap.xml           → Sitemap index pointing to child sitemaps
 *   /sitemap-tools.xml     → All base tool URLs from config/tools.php
 *   /sitemap-seo-N.xml     → P-SEO pages (max 5,000 per file)
 *   /sitemap-categories.xml → Category landing pages
 *   /sitemap-static.xml    → Legal/about/policy pages
 */
class SitemapController extends Controller
{
    protected const MAX_URLS_PER_SITEMAP = 5000;
    protected const CACHE_TTL_SECONDS = 3600; // 1 hour

    /**
     * Sitemap Index — /sitemap.xml
     */
    public function index(): Response
    {
        $xml = Cache::remember('sitemap:index', self::CACHE_TTL_SECONDS, function () {
            $siteUrl = rtrim(config('app.url', url('/')), '/');
            $now = now()->toW3cString();

            $sitemaps = [];

            // Always include tools and static
            $sitemaps[] = ['loc' => $siteUrl . '/sitemap-tools.xml', 'lastmod' => $now];
            $sitemaps[] = ['loc' => $siteUrl . '/sitemap-categories.xml', 'lastmod' => $now];
            $sitemaps[] = ['loc' => $siteUrl . '/sitemap-static.xml', 'lastmod' => $now];

            // Calculate how many P-SEO sitemap chunks we need
            $seoPageCount = $this->getSeoPageCount();
            $chunks = max(1, (int) ceil($seoPageCount / self::MAX_URLS_PER_SITEMAP));

            for ($i = 1; $i <= $chunks; $i++) {
                $sitemaps[] = ['loc' => $siteUrl . '/sitemap-seo-' . $i . '.xml', 'lastmod' => $now];
            }

            return $this->renderSitemapIndex($sitemaps);
        });

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=utf-8']);
    }

    /**
     * Base tools sitemap — /sitemap-tools.xml
     */
    public function tools(): Response
    {
        $xml = Cache::remember('sitemap:tools', self::CACHE_TTL_SECONDS, function () {
            $siteUrl = rtrim(config('app.url', url('/')), '/');
            $tools = config('tools.tools') ?? [];

            $urls = [];
            foreach ($tools as $slug => $tool) {
                $urls[] = [
                    'loc'        => $siteUrl . '/' . $slug,
                    'changefreq' => 'weekly',
                    'priority'   => '0.8',
                ];
            }

            return $this->renderUrlset($urls);
        });

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=utf-8']);
    }

    /**
     * P-SEO pages sitemap (paginated) — /sitemap-seo-{page}.xml
     */
    public function seoPages(int $page = 1): Response
    {
        $cacheKey = 'sitemap:seo:' . $page;

        $xml = Cache::remember($cacheKey, self::CACHE_TTL_SECONDS, function () use ($page) {
            $siteUrl = rtrim(config('app.url', url('/')), '/');
            $allSeoPages = $this->loadSeoPages();

            $slugs = array_keys($allSeoPages);
            $offset = ($page - 1) * self::MAX_URLS_PER_SITEMAP;
            $chunk = array_slice($slugs, $offset, self::MAX_URLS_PER_SITEMAP);

            $urls = [];
            foreach ($chunk as $slug) {
                $seoPage = $allSeoPages[$slug];
                $canonicalSlug = $seoPage['canonical'] ?? $slug;
                $canonicalSlug = ltrim($canonicalSlug, '/');

                $urls[] = [
                    'loc'        => $siteUrl . '/' . $canonicalSlug,
                    'changefreq' => 'monthly',
                    'priority'   => '0.6',
                ];
            }

            return $this->renderUrlset($urls);
        });

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=utf-8']);
    }

    /**
     * Category pages sitemap — /sitemap-categories.xml
     */
    public function categories(): Response
    {
        $xml = Cache::remember('sitemap:categories', self::CACHE_TTL_SECONDS, function () {
            $siteUrl = rtrim(config('app.url', url('/')), '/');
            $categories = config('tools.categories') ?? [];

            $urls = [];
            foreach ($categories as $slug => $category) {
                $urls[] = [
                    'loc'        => $siteUrl . '/' . $slug,
                    'changefreq' => 'weekly',
                    'priority'   => '0.9',
                ];
            }

            return $this->renderUrlset($urls);
        });

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=utf-8']);
    }

    /**
     * Static pages sitemap — /sitemap-static.xml
     */
    public function staticPages(): Response
    {
        $xml = Cache::remember('sitemap:static', self::CACHE_TTL_SECONDS, function () {
            $siteUrl = rtrim(config('app.url', url('/')), '/');

            $urls = [
                ['loc' => $siteUrl, 'changefreq' => 'daily', 'priority' => '1.0'],
                ['loc' => $siteUrl . '/privacy-policy', 'changefreq' => 'yearly', 'priority' => '0.3'],
                ['loc' => $siteUrl . '/terms-of-service', 'changefreq' => 'yearly', 'priority' => '0.3'],
                ['loc' => $siteUrl . '/about-us', 'changefreq' => 'monthly', 'priority' => '0.4'],
                ['loc' => $siteUrl . '/contact-us', 'changefreq' => 'yearly', 'priority' => '0.3'],
                ['loc' => $siteUrl . '/disclaimer', 'changefreq' => 'yearly', 'priority' => '0.2'],
            ];

            return $this->renderUrlset($urls);
        });

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=utf-8']);
    }

    // ──────────────────────────────────────────────────────────────
    //  Helpers
    // ──────────────────────────────────────────────────────────────

    /**
     * Load P-SEO pages from the storage file (lazy, same as SeoToolController).
     */
    protected function loadSeoPages(): array
    {
        $path = storage_path('seo_pages.php');
        if (file_exists($path)) {
            $data = include $path;
            return $data['pages'] ?? [];
        }
        return [];
    }

    /**
     * Count total P-SEO pages without loading the full array into working memory.
     */
    protected function getSeoPageCount(): int
    {
        return Cache::remember('sitemap:seo-count', self::CACHE_TTL_SECONDS, function () {
            return count($this->loadSeoPages());
        });
    }

    /**
     * Render a <sitemapindex> XML string.
     */
    protected function renderSitemapIndex(array $sitemaps): string
    {
        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($sitemaps as $sitemap) {
            $xml .= "  <sitemap>\n";
            $xml .= "    <loc>" . htmlspecialchars($sitemap['loc'], ENT_XML1, 'UTF-8') . "</loc>\n";
            if (!empty($sitemap['lastmod'])) {
                $xml .= "    <lastmod>" . $sitemap['lastmod'] . "</lastmod>\n";
            }
            $xml .= "  </sitemap>\n";
        }

        $xml .= '</sitemapindex>';
        return $xml;
    }

    /**
     * Render a <urlset> XML string.
     */
    protected function renderUrlset(array $urls): string
    {
        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars($url['loc'], ENT_XML1, 'UTF-8') . "</loc>\n";
            if (!empty($url['lastmod'])) {
                $xml .= "    <lastmod>" . $url['lastmod'] . "</lastmod>\n";
            }
            if (!empty($url['changefreq'])) {
                $xml .= "    <changefreq>" . $url['changefreq'] . "</changefreq>\n";
            }
            if (!empty($url['priority'])) {
                $xml .= "    <priority>" . $url['priority'] . "</priority>\n";
            }
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';
        return $xml;
    }
}
