<?php

namespace App\Services\Seo;

use Illuminate\Support\Str;

class SeoScanner
{
    private string $body;
    private string $url;
    private array $issues = [];
    private array $metaData = [];

    public function __construct(string $body, string $url)
    {
        $this->body = $body;
        $this->url = $url;
    }

    /**
     * Perform full SEO scan (13 checks).
     */
    public function scan(): array
    {
        $cacheKey = 'seo:scan:' . md5($this->url . $this->body);
        
        return \Illuminate\Support\Facades\Cache::store(config('cache.default') === 'redis' ? 'redis' : 'file')->remember($cacheKey, 3600 * 24, function () {
            $this->extractMeta();
            $this->checkIndexStatus();
            $this->validateStructure();
            $this->validateMobile();
            $this->validateSocial();
            $this->validateStructuredData();
            $this->validateContentQuality();
            $this->validateTwitterCards();

            $score = $this->calculateScore();

            return [
                'seo_score' => $score,
                'index_status' => $this->metaData['index_status'] ?? 'indexed',
                'meta_data' => $this->metaData,
                'issues' => $this->issues,
                'checked_at' => now(),
            ];
        });
    }

    /**
     * Extract <title>, <meta description>, <link rel="canonical">
     */
    private function extractMeta(): void
    {
        // Title
        if (preg_match('/<title>(.*?)<\/title>/is', $this->body, $matches)) {
            $title = trim($matches[1]);
            $this->metaData['title'] = $title;
            $len = mb_strlen($title);
            if ($len < 50) $this->issues[] = 'title_too_short';
            if ($len > 60) $this->issues[] = 'title_too_long';
        } else {
            $this->metaData['title'] = null;
            $this->issues[] = 'missing_title';
        }

        // Description - Flexible regex for attributes across newlines
        if (preg_match('/<meta[^>]*name=["\']description["\'][^>]*content=["\'](.*?)["\']/is', $this->body, $matches)) {
            $desc = trim($matches[1]);
            $this->metaData['description'] = $desc;
            $len = mb_strlen($desc);
            if ($len < 120) $this->issues[] = 'description_too_short';
            if ($len > 160) $this->issues[] = 'description_too_long';
        } else {
            $this->metaData['description'] = null;
            $this->issues[] = 'missing_description';
        }

        // Canonical
        if (preg_match('/<link[^>]*rel=["\']canonical["\'][^>]*href=["\'](.*?)["\']/is', $this->body, $matches)) {
            $this->metaData['canonical'] = $matches[1];
        } else {
            $this->metaData['canonical'] = null;
            $this->issues[] = 'missing_canonical';
        }
    }

    /**
     * Check for noindex tags.
     */
    private function checkIndexStatus(): void
    {
        if (str_contains($this->body, 'noindex')) {
            $this->metaData['index_status'] = 'noindex';
            $this->issues[] = 'noindex_detected';
        } else {
            $this->metaData['index_status'] = 'indexed';
        }
    }

    /**
     * Validate H1, Alt tags.
     */
    private function validateStructure(): void
    {
        // H1 count
        $h1Count = preg_match_all('/<h1/is', $this->body, $matches);
        $this->metaData['h1_count'] = $h1Count;
        if ($h1Count === 0) $this->issues[] = 'missing_h1';
        if ($h1Count > 1) $this->issues[] = 'multiple_h1';

        // Alt tags — count images with and without alt
        $totalImages = preg_match_all('/<img[^>]*>/is', $this->body, $imgMatches);
        $imagesWithAlt = 0;
        if ($totalImages > 0) {
            foreach ($imgMatches[0] as $imgTag) {
                if (preg_match('/alt=["\'][^"\']+["\']/i', $imgTag)) {
                    $imagesWithAlt++;
                }
            }
            $this->metaData['images_total'] = $totalImages;
            $this->metaData['images_with_alt'] = $imagesWithAlt;
            if ($imagesWithAlt < $totalImages) {
                $this->issues[] = 'missing_alt_tags';
            }
        }
    }

    /**
     * Validate Viewport, Breadcrumbs, and AdSense compliance.
     */
    private function validateMobile(): void
    {
        // Viewport
        if (!str_contains($this->body, 'name="viewport"')) {
            $this->issues[] = 'missing_viewport';
        }

        // Breadcrumbs
        if (!str_contains($this->body, 'breadcrumb')) {
            $this->issues[] = 'missing_breadcrumbs';
        }

        // INTERNAL LINKS (Minimum 5 related tools)
        $linkCount = preg_match_all('/<a[^>]*class=["\']tool-card["\'][^>]*>/is', $this->body, $matches);
        if ($linkCount < 5) {
            $this->issues[] = 'not_enough_internal_links';
        }

        // ADSENSE COMPLIANCE: Fake Buttons / Deceptive UI
        if (preg_match('/<button[^>]*>Download Now<\/button>/is', $this->body) || 
            preg_match('/<a[^>]*>Download Now<\/a>/is', $this->body)) {
            // If "Download Now" exists without being part of the process result
            if (!str_contains($this->body, 'id="result-section"')) {
                $this->issues[] = 'deceptive_ui_button';
            }
        }
    }

    /**
     * Validate Open Graph tags.
     */
    private function validateSocial(): void
    {
        $hasOgTitle = str_contains($this->body, 'property="og:title"');
        $hasOgDesc = str_contains($this->body, 'property="og:description"');
        
        if (!$hasOgTitle || !$hasOgDesc) {
            $this->issues[] = 'missing_og_tags';
        }
        
        $this->metaData['og_tags'] = [
            'has_title' => $hasOgTitle,
            'has_desc' => $hasOgDesc
        ];
    }

    /**
     * Validate JSON-LD.
     */
    private function validateStructuredData(): void
    {
        if (str_contains($this->body, 'application/ld+json')) {
            $this->metaData['has_json_ld'] = true;
        } else {
            $this->metaData['has_json_ld'] = false;
            $this->issues[] = 'missing_json_ld';
        }
    }

    /**
     * Validate content quality: word count, keyword density, content-to-code ratio.
     */
    private function validateContentQuality(): void
    {
        // Strip HTML to get visible text
        $textContent = strip_tags($this->body);
        $textContent = preg_replace('/\s+/', ' ', $textContent);
        $wordCount = str_word_count($textContent);

        $this->metaData['word_count'] = $wordCount;

        // Thin content check — pages under 300 words
        if ($wordCount < 300) {
            $this->issues[] = 'thin_content';
        }

        // Content-to-code ratio (text bytes / total bytes)
        $textBytes = strlen($textContent);
        $totalBytes = strlen($this->body);
        $ratio = $totalBytes > 0 ? round(($textBytes / $totalBytes) * 100, 1) : 0;
        $this->metaData['content_ratio'] = $ratio;

        if ($ratio < 10) {
            $this->issues[] = 'low_content_ratio';
        }

        // Keyword density — use the tool slug as primary keyword
        $slug = basename(parse_url($this->url, PHP_URL_PATH) ?? '');
        $keywords = explode('-', $slug);
        $primaryKeyword = implode(' ', $keywords);
        $lowerText = strtolower($textContent);
        $keywordCount = substr_count($lowerText, strtolower($primaryKeyword));

        $density = $wordCount > 0 ? round(($keywordCount / $wordCount) * 100, 2) : 0;
        $this->metaData['keyword_density'] = $density;
        $this->metaData['primary_keyword'] = $primaryKeyword;

        // Keyword density too low (under 0.5%) or too high (over 3%)
        if ($density < 0.3 && $wordCount >= 300) {
            $this->issues[] = 'low_keyword_density';
        }
        if ($density > 3.5) {
            $this->issues[] = 'keyword_stuffing';
        }
    }

    /**
     * Validate Twitter Card meta tags.
     */
    private function validateTwitterCards(): void
    {
        $hasTwitterCard = str_contains($this->body, 'name="twitter:card"') || str_contains($this->body, 'property="twitter:card"');
        $hasTwitterTitle = str_contains($this->body, 'name="twitter:title"') || str_contains($this->body, 'property="twitter:title"');

        $this->metaData['twitter_card'] = [
            'has_card' => $hasTwitterCard,
            'has_title' => $hasTwitterTitle,
        ];

        if (!$hasTwitterCard || !$hasTwitterTitle) {
            $this->issues[] = 'missing_twitter_cards';
        }

        // Hreflang check
        if (!str_contains($this->body, 'hreflang=')) {
            $this->issues[] = 'missing_hreflang';
        }
    }

    /**
     * Calculate 0-100 score.
     * Categories: Meta(15), Structure(15), Social(10), Mobile(10), Index(10), Content(20), Advanced(20)
     */
    private function calculateScore(): int
    {
        $score = 0;

        // Meta Tags (15 points)
        if (!in_array('missing_title', $this->issues)) $score += 7;
        if (!in_array('missing_description', $this->issues)) $score += 8;

        // Structure (15 points)
        if (!in_array('missing_h1', $this->issues) && !in_array('multiple_h1', $this->issues)) $score += 8;
        if (!in_array('missing_json_ld', $this->issues)) $score += 7;

        // Social & OG (10 points)
        if (!in_array('missing_og_tags', $this->issues)) $score += 5;
        if (!in_array('missing_canonical', $this->issues)) $score += 5;

        // Mobile (10 points)
        if (!in_array('missing_viewport', $this->issues)) $score += 10;

        // Index (10 points)
        if (($this->metaData['index_status'] ?? '') === 'indexed') $score += 10;

        // Content Quality (20 points)
        if (!in_array('thin_content', $this->issues)) $score += 10;
        if (!in_array('low_content_ratio', $this->issues)) $score += 5;
        if (!in_array('low_keyword_density', $this->issues) && !in_array('keyword_stuffing', $this->issues)) $score += 5;

        // Advanced SEO (20 points)
        if (!in_array('missing_twitter_cards', $this->issues)) $score += 5;
        if (!in_array('missing_hreflang', $this->issues)) $score += 5;
        if (!in_array('missing_alt_tags', $this->issues)) $score += 5;
        if (!in_array('missing_breadcrumbs', $this->issues)) $score += 5;

        // Penalties
        if (in_array('deceptive_ui_button', $this->issues)) $score -= 10;
        if (in_array('keyword_stuffing', $this->issues)) $score -= 5;

        return max(0, min(100, $score));
    }
}
