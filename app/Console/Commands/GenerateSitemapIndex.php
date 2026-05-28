<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateSitemapIndex extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     */
    protected $description = 'Generate static XML sitemaps for all base tools and P-SEO variants across all locales.';

    protected $urlsPerFile = 5000;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Sitemap Generation...');

        $locales = config('seo.locales', ['en' => ['hreflang' => 'en', 'default' => true]]);
        $modifiers = config('seo.modifiers', []);
        $tools = array_merge(config('tools.tools', []), config('pro_calculators', []));

        $allUrls = [];
        $baseUrl = rtrim(config('app.url', 'https://toolshub.com'), '/');

        // Static pages
        $staticPages = ['/', '/about-us', '/contact-us', '/privacy-policy', '/terms-of-service'];
        foreach ($staticPages as $page) {
            foreach ($locales as $localeCode => $localeData) {
                $localePrefix = $localeCode === 'en' ? '' : '/' . $localeCode;
                $url = $baseUrl . $localePrefix . ($page === '/' ? '' : $page);
                $allUrls[] = [
                    'loc' => $url,
                    'priority' => $page === '/' ? '1.0' : '0.5',
                    'changefreq' => 'weekly'
                ];
            }
        }

        // Categories
        $categories = config('tools.categories', []);
        foreach (array_keys($categories) as $categorySlug) {
            foreach ($locales as $localeCode => $localeData) {
                $localePrefix = $localeCode === 'en' ? '' : '/' . $localeCode;
                $allUrls[] = [
                    'loc' => $baseUrl . $localePrefix . '/' . $categorySlug,
                    'priority' => '0.8',
                    'changefreq' => 'weekly'
                ];
            }
        }

        // Tools + P-SEO Variants
        $totalTools = count($tools);
        $this->output->progressStart($totalTools);

        foreach ($tools as $slug => $tool) {
            // Base Tool
            foreach ($locales as $localeCode => $localeData) {
                $localePrefix = $localeCode === 'en' ? '' : '/' . $localeCode;
                $allUrls[] = [
                    'loc' => $baseUrl . $localePrefix . '/' . $slug,
                    'priority' => '0.9',
                    'changefreq' => 'daily'
                ];
            }

            // P-SEO Variants
            foreach ($modifiers as $modifierKey => $modifierData) {
                $variantSlug = str_replace('{slug}', $slug, $modifierData['pattern']);
                foreach ($locales as $localeCode => $localeData) {
                    $localePrefix = $localeCode === 'en' ? '' : '/' . $localeCode;
                    $allUrls[] = [
                        'loc' => $baseUrl . $localePrefix . '/' . $variantSlug,
                        'priority' => '0.7',
                        'changefreq' => 'weekly'
                    ];
                }
            }

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
        $this->info('Generated ' . count($allUrls) . ' total URLs.');

        // Clean existing sitemap files
        $publicPath = public_path();
        $existingFiles = File::glob($publicPath . '/sitemap-*.xml');
        foreach ($existingFiles as $file) {
            File::delete($file);
        }

        // Chunk and Write Sitemaps
        $chunks = array_chunk($allUrls, $this->urlsPerFile);
        $sitemapFiles = [];

        foreach ($chunks as $index => $chunk) {
            $fileIndex = $index + 1;
            $filename = "sitemap-pages-{$fileIndex}.xml";
            $sitemapFiles[] = $filename;

            $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

            foreach ($chunk as $urlData) {
                $xml .= "  <url>\n";
                $xml .= "    <loc>" . htmlspecialchars($urlData['loc']) . "</loc>\n";
                if (isset($urlData['changefreq'])) {
                    $xml .= "    <changefreq>" . $urlData['changefreq'] . "</changefreq>\n";
                }
                if (isset($urlData['priority'])) {
                    $xml .= "    <priority>" . $urlData['priority'] . "</priority>\n";
                }
                $xml .= "  </url>\n";
            }

            $xml .= '</urlset>';

            File::put($publicPath . '/' . $filename, $xml);
        }

        // Write Sitemap Index
        $indexXml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $indexXml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        $now = now()->toW3cString();
        foreach ($sitemapFiles as $file) {
            $indexXml .= "  <sitemap>\n";
            $indexXml .= "    <loc>" . $baseUrl . '/' . $file . "</loc>\n";
            $indexXml .= "    <lastmod>" . $now . "</lastmod>\n";
            $indexXml .= "  </sitemap>\n";
        }

        $indexXml .= '</sitemapindex>';
        File::put($publicPath . '/sitemap.xml', $indexXml);

        $this->info('Sitemap index and ' . count($sitemapFiles) . ' chunk files generated successfully in public/.');
    }
}
