<?php

namespace App\Services\Seo;

/**
 * Unified Structured Data (JSON-LD @graph) generator for all tool pages.
 *
 * Produces a single, fully connected @graph containing:
 *  - Organization (with @id for cross-referencing)
 *  - WebSite (with SearchAction for sitelinks search box)
 *  - SoftwareApplication / WebApplication
 *  - BreadcrumbList
 *  - FAQPage (when FAQ data is provided)
 */
class SeoSchemaGenerator
{
    protected string $siteUrl;
    protected string $siteName;
    protected array $orgConfig;

    public function __construct()
    {
        $this->siteUrl = rtrim(url('/'), '/');
        $this->siteName = config('seo.site_name', 'ToolsHub');
        $this->orgConfig = config('seo.organization', [
            'name' => 'ToolsHub',
            'url' => $this->siteUrl,
            'logo' => '/images/logo.png',
            'type' => 'Organization'
        ]);
    }

    /**
     * Generate a fully connected @graph JSON-LD string.
     *
     * @param array       $tool        Tool configuration array
     * @param string      $currentUrl  The canonical URL of the current page
     * @param array|null  $faq         Array of FAQ items
     * @param array|null  $categoryData Category metadata
     * @return string     JSON-LD string ready for embedding
     */
    public function generate(array $tool, string $currentUrl, ?array $faq = null, ?array $categoryData = null): string
    {
        $orgId = $this->siteUrl . '/#organization';
        $siteId = $this->siteUrl . '/#website';
        $pageId = $currentUrl . '/#webpage';
        $appId = $currentUrl . '/#software-app';

        $graph = [];

        // ─── 1. Organization ───────────────────────────────────────
        $graph[] = [
            '@type' => $this->orgConfig['type'] ?? 'Organization',
            '@id'   => $orgId,
            'name'  => $this->orgConfig['name'] ?? $this->siteName,
            'url'   => $this->orgConfig['url'] ?? $this->siteUrl,
            'logo'  => [
                '@type'      => 'ImageObject',
                'url'        => str_starts_with($this->orgConfig['logo'] ?? '/images/logo.png', 'http') ? $this->orgConfig['logo'] : asset($this->orgConfig['logo'] ?? 'images/logo.png'),
                'width'      => 512,
                'height'     => 512,
            ],
            'sameAs' => $this->orgConfig['sameAs'] ?? [],
        ];

        // ─── 2. WebSite + SearchAction ─────────────────────────────
        $graph[] = [
            '@type'           => 'WebSite',
            '@id'             => $siteId,
            'name'            => $this->siteName,
            'url'             => $this->siteUrl,
            'publisher'       => ['@id' => $orgId],
            'potentialAction' => [
                '@type'       => 'SearchAction',
                'target'      => $this->siteUrl . '/?q={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];

        // ─── 3. WebPage ────────────────────────────────────────────
        $graph[] = [
            '@type'       => 'WebPage',
            '@id'         => $pageId,
            'url'         => $currentUrl,
            'name'        => $tool['title'] ?? ($tool['h1'] ?? 'Online Tool'),
            'description' => $tool['description'] ?? '',
            'isPartOf'    => ['@id' => $siteId],
            'about'       => ['@id' => $orgId],
            'mainEntity'  => ['@id' => $appId],
        ];

        // ─── 3. BreadcrumbList ─────────────────────────────────────
        $breadcrumbItems = [];
        $position = 1;

        $breadcrumbItems[] = [
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => 'Home',
            'item'     => $this->siteUrl,
        ];

        if ($categoryData && !empty($tool['category'])) {
            $breadcrumbItems[] = [
                '@type'    => 'ListItem',
                'position' => $position++,
                'name'     => $categoryData['name'] ?? ucfirst($tool['category']),
                'item'     => $this->siteUrl . '/' . $tool['category'],
            ];
        }

        $breadcrumbItems[] = [
            '@type'    => 'ListItem',
            'position' => $position,
            'name'     => $tool['h1'] ?? ($tool['title'] ?? ($tool['name'] ?? 'Tool')),
            'item'     => $currentUrl,
        ];

        $graph[] = [
            '@type'           => 'BreadcrumbList',
            '@id'             => $currentUrl . '/#breadcrumb',
            'itemListElement' => $breadcrumbItems,
        ];

        // ─── 4. SoftwareApplication ────────────────────────────────
        $appNode = [
            '@type'               => 'SoftwareApplication',
            '@id'                 => $appId,
            'name'                => $tool['h1'] ?? ($tool['title'] ?? ($tool['name'] ?? 'Online Tool')),
            'description'         => $tool['description'] ?? ($tool['subtitle'] ?? ''),
            'url'                 => $currentUrl,
            'applicationCategory' => 'UtilitiesApplication',
            'operatingSystem'     => 'Any',
            'offers'              => [
                '@type'         => 'Offer',
                'price'         => '0',
                'priceCurrency' => 'USD',
            ],
            'author'              => ['@id' => $orgId],
            'isPartOf'            => ['@id' => $pageId], // SoftwareApp is part of the WebPage
        ];

        $graph[] = $appNode;

        // ─── 5. HowTo (conditional) ────────────────────────────────
        if (!empty($tool['custom_steps']) || !empty($tool['instructions'])) {
            $steps = [];
            $position = 1;
            
            $sourceSteps = $tool['custom_steps'] ?? $tool['instructions'];
            
            foreach ($sourceSteps as $step) {
                if (is_array($step)) {
                    $steps[] = [
                        '@type' => 'HowToStep',
                        'position' => $position++,
                        'name' => strip_tags($step['title'] ?? 'Step'),
                        'text' => strip_tags($step['description'] ?? ''),
                    ];
                } elseif (is_string($step)) {
                    $steps[] = [
                        '@type' => 'HowToStep',
                        'position' => $position++,
                        'name' => 'Step ' . $position,
                        'text' => strip_tags($step),
                    ];
                }
            }

            if (!empty($steps)) {
                $graph[] = [
                    '@type' => 'HowTo',
                    '@id' => $currentUrl . '/#howto',
                    'name' => 'How to use ' . ($tool['h1'] ?? $tool['title'] ?? 'this tool'),
                    'step' => $steps,
                    'isPartOf' => ['@id' => $pageId],
                ];
            }
        }

        // ─── 6. FAQPage (conditional) ──────────────────────────────
        // v13: If no custom FAQ, pull PAA questions with real answers from DB
        if (empty($faq)) {
            $paaFromDb = \Illuminate\Support\Facades\DB::table('semantic_keywords')
                ->where('tool_slug', $tool['slug'] ?? '')
                ->where('keyword_type', 'paa')
                ->where('is_active', 1)
                ->whereNotNull('answer')
                ->limit(7)
                ->get(['keyword', 'answer']);

            if ($paaFromDb->isNotEmpty()) {
                $faq = $paaFromDb->map(fn($r) => [
                    'q' => $r->keyword,
                    'a' => $r->answer,
                ])->toArray();
            }
        }

        if (!empty($faq) && is_array($faq)) {
            $faqEntities = [];
            foreach ($faq as $item) {
                $question = strip_tags($item['q'] ?? ($item['question'] ?? ''));
                $answer   = strip_tags($item['a'] ?? ($item['answer'] ?? ''));

                if (empty($question) || empty($answer)) {
                    continue;
                }

                $faqEntities[] = [
                    '@type'          => 'Question',
                    'name'           => $question,
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text'  => $answer,
                    ],
                ];
            }

            if (!empty($faqEntities)) {
                $graph[] = [
                    '@type'      => 'FAQPage',
                    '@id'        => $currentUrl . '/#faq',
                    'mainEntity' => $faqEntities,
                    'isPartOf'   => ['@id' => $pageId],
                ];
            }
        }

        // ─── Assemble @graph ───────────────────────────────────────
        $schema = [
            '@context' => 'https://schema.org',
            '@graph'   => $graph,
        ];

        return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
