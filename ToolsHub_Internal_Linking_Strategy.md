# ToolsHub — Internal Linking Strategy (1,429 Tools)

> Poora system programmatic hai. Ek baar code lagao — sab 1,429 tools pe automatically kaam karega.

---

## 5 Types of Links — Priority Order

| # | Type | Tools covered | SEO impact | Effort |
|---|---|---|---|---|
| 1 | Breadcrumbs | All 1,429 | High | 30 min |
| 2 | Related tools widget | All 1,429 | Very high | 1 hr |
| 3 | Category hub pages | 51 categories | Very high | 2 hr |
| 4 | Cross-category keyword links | ~400 tools | High | 2 hr |
| 5 | Footer tool clusters | All | Medium | 1 hr |

---

## Step 1 — Breadcrumbs (30 min)

Har tool page pe: `Home > Finance & Tax > Mortgage Calculator`

### `app/Http/Controllers/ToolController.php` mein add karo:

```php
public function show($slug)
{
    $tool     = $this->findTool($slug);
    $category = config('tools.categories.' . $tool['category']) ?? null;

    $breadcrumbs = [
        ['label' => 'Home',           'url' => route('home')],
        ['label' => $category['name'] ?? 'Tools',
         'url'   => route('category', $tool['category'])],
        ['label' => $tool['name'],    'url' => null],
    ];

    return view('tools.show', compact('tool', 'breadcrumbs'));
}
```

### `resources/views/partials/breadcrumbs.blade.php`:

```blade
<nav aria-label="Breadcrumb">
    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
        @foreach($breadcrumbs as $i => $crumb)
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                @if($crumb['url'])
                    <a href="{{ $crumb['url'] }}" itemprop="item">
                        <span itemprop="name">{{ $crumb['label'] }}</span>
                    </a>
                @else
                    <span itemprop="name">{{ $crumb['label'] }}</span>
                @endif
                <meta itemprop="position" content="{{ $i + 1 }}" />
            </li>
            @if(!$loop->last) <li class="separator">/</li> @endif
        @endforeach
    </ol>
</nav>
```

### Tool layout mein include karo (`resources/views/layouts/tool.blade.php`):

```blade
@include('partials.breadcrumbs')
```

---

## Step 2 — Related Tools Widget (Most Important)

### `app/Services/RelatedToolsService.php` — naya file banao:

```php
<?php

namespace App\Services;

use Illuminate\Support\Collection;

class RelatedToolsService
{
    /**
     * Ek tool ke liye related tools nikalte hain.
     * Priority: same category → slug keyword match → same score range
     */
    public function getRelated(array $currentTool, int $limit = 6): Collection
    {
        $allTools = $this->getAllTools();

        // Step 1: Same category ke tools (current tool ko exclude karo)
        $sameCat = $allTools
            ->where('category', $currentTool['category'])
            ->where('slug', '!=', $currentTool['slug'])
            ->shuffle()
            ->take($limit);

        if ($sameCat->count() >= $limit) {
            return $sameCat;
        }

        // Step 2: Agar same category mein kam tools hain toh keyword match karo
        $keywords = $this->extractKeywords($currentTool['slug']);

        $keywordMatch = $allTools
            ->where('slug', '!=', $currentTool['slug'])
            ->whereNotIn('slug', $sameCat->pluck('slug'))
            ->filter(function ($tool) use ($keywords) {
                foreach ($keywords as $kw) {
                    if (str_contains($tool['slug'], $kw)) return true;
                }
                return false;
            })
            ->take($limit - $sameCat->count());

        return $sameCat->merge($keywordMatch)->take($limit);
    }

    /**
     * Slug se keywords nikalta hai
     * "mortgage-calculator" → ["mortgage", "calculator", "loan"]
     */
    private function extractKeywords(string $slug): array
    {
        $parts = explode('-', $slug);

        // Common synonyms mapping
        $synonyms = [
            'mortgage'   => ['loan', 'repayment', 'amortization'],
            'bmi'        => ['body', 'weight', 'health'],
            'vat'        => ['tax', 'gst', 'percentage'],
            'converter'  => ['convert', 'calculator'],
            'calculator' => ['calc', 'compute'],
            'generator'  => ['generate', 'maker', 'creator'],
            'slope'      => ['linear', 'intercept', 'gradient'],
            'finance'    => ['loan', 'interest', 'payment', 'debt'],
        ];

        $keywords = $parts;
        foreach ($parts as $part) {
            if (isset($synonyms[$part])) {
                $keywords = array_merge($keywords, $synonyms[$part]);
            }
        }

        // Stop words hata do
        $stopWords = ['to', 'from', 'and', 'of', 'a', 'the', 'in', 'for'];
        return array_diff(array_unique($keywords), $stopWords);
    }

    private function getAllTools(): Collection
    {
        // tools.php + pro_calculators.php dono se load karo
        $tools = collect(config('tools.tools', []));
        $pro   = collect(config('tools.pro_calculators', []));
        return $tools->merge($pro);
    }
}
```

### Service ko `ToolController` mein inject karo:

```php
use App\Services\RelatedToolsService;

class ToolController extends Controller
{
    public function __construct(private RelatedToolsService $relatedTools) {}

    public function show($slug)
    {
        $tool    = $this->findTool($slug);
        $related = $this->relatedTools->getRelated($tool, 6);

        return view('tools.show', compact('tool', 'related', 'breadcrumbs'));
    }
}
```

### `resources/views/partials/related-tools.blade.php`:

```blade
@if($related->isNotEmpty())
<section class="related-tools" aria-label="Related tools">
    <h2 class="related-title">Related Tools</h2>
    <div class="related-grid">
        @foreach($related as $tool)
            <a href="{{ route('tool', $tool['slug']) }}"
               class="related-card"
               title="{{ $tool['name'] }}">
                <span class="related-icon">
                    <i class="fas {{ $tool['icon'] ?? 'fa-calculator' }}"></i>
                </span>
                <span class="related-name">{{ $tool['name'] }}</span>
                @if(isset($tool['description']))
                    <span class="related-desc">
                        {{ Str::limit($tool['description'], 60) }}
                    </span>
                @endif
            </a>
        @endforeach
    </div>
</section>
@endif
```

### CSS (apni existing stylesheet mein add karo):

```css
.related-tools { margin: 2.5rem 0; }
.related-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; }
.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 12px;
}
.related-card {
    display: flex;
    flex-direction: column;
    gap: 4px;
    padding: 12px;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    text-decoration: none;
    color: inherit;
    transition: border-color .15s, box-shadow .15s;
}
.related-card:hover {
    border-color: #6366f1;
    box-shadow: 0 2px 8px rgba(99,102,241,.1);
}
.related-name { font-size: 0.85rem; font-weight: 500; }
.related-desc { font-size: 0.75rem; color: #6b7280; line-height: 1.3; }
```

---

## Step 3 — Category Hub Pages (Sabse Zyada Link Juice)

### Route add karo (`routes/web.php`):

```php
Route::get('/tools/{category}', [CategoryController::class, 'show'])
     ->name('category')
     ->where('category', '[a-z0-9-]+');
```

### `app/Http/Controllers/CategoryController.php`:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(string $slug)
    {
        $categories = config('tools.categories');

        abort_unless(isset($categories[$slug]), 404);

        $category = $categories[$slug];

        // Is category ke saare tools
        $allTools  = collect(config('tools.tools', []))
                       ->merge(config('tools.pro_calculators', []));

        $tools = $allTools
            ->where('category', $slug)
            ->sortBy('name')
            ->values();

        // Sub-groups (slug prefix se auto-group)
        $groups = $tools->groupBy(function ($tool) {
            // "loan-repayment-calculator", "loan-payoff-calculator" → "Loan"
            $parts = explode('-', $tool['slug']);
            return ucfirst($parts[0]);
        })->sortKeys();

        // Related categories (sibling categories)
        $related = collect($categories)
            ->except($slug)
            ->random(min(4, count($categories) - 1));

        $breadcrumbs = [
            ['label' => 'Home',            'url' => route('home')],
            ['label' => $category['name'], 'url' => null],
        ];

        return view('category.show', compact(
            'category', 'slug', 'tools', 'groups', 'related', 'breadcrumbs'
        ));
    }
}
```

### `resources/views/category/show.blade.php`:

```blade
@extends('layouts.app')

@section('title', $category['name'] . ' — ' . $tools->count() . ' Free Tools')
@section('description', 'Browse ' . $tools->count() . ' free ' . strtolower($category['name']) . ' tools and calculators.')

@section('content')
@include('partials.breadcrumbs')

<h1>{{ $category['name'] }}</h1>
<p class="cat-count">{{ $tools->count() }} free tools</p>

{{-- Grouped listing with anchor links (great for internal linking) --}}
@foreach($groups as $groupName => $groupTools)
    <section id="{{ Str::slug($groupName) }}">
        <h2>{{ $groupName }}</h2>
        <div class="tools-grid">
            @foreach($groupTools as $tool)
                <a href="{{ route('tool', $tool['slug']) }}" class="tool-card">
                    <strong>{{ $tool['name'] }}</strong>
                    @if(isset($tool['description']))
                        <span>{{ Str::limit($tool['description'], 80) }}</span>
                    @endif
                </a>
            @endforeach
        </div>
    </section>
@endforeach

{{-- Related categories --}}
<section class="related-cats">
    <h2>Related Categories</h2>
    <div class="cats-grid">
        @foreach($related as $catSlug => $cat)
            <a href="{{ route('category', $catSlug) }}" class="cat-card">
                <i class="fas {{ $cat['icon'] }}"></i>
                {{ $cat['name'] }}
            </a>
        @endforeach
    </div>
</section>
@endsection
```

---

## Step 4 — Cross-Category Keyword Links (Slug Matching)

Yeh automatically tool descriptions mein related tools ke links inject karta hai.

### `app/Services/CrossLinkerService.php`:

```php
<?php

namespace App\Services;

use Illuminate\Support\Collection;

class CrossLinkerService
{
    /**
     * Cross-category link mapping
     * Key: current tool ki category
     * Values: jin categories ke tools ko link karna hai
     */
    private array $crossMap = [
        'finance'     => ['investment', 'business', 'real-estate', 'tax'],
        'health'      => ['fitness', 'nutrition', 'clinical'],
        'math'        => ['statistics', 'algebra', 'geometry'],
        'calculators' => ['unit-converter', 'math', 'science'],
        'business'    => ['finance', 'marketing', 'productivity'],
        'science'     => ['physics', 'chemistry', 'math'],
        'webmaster'   => ['seo', 'web-seo-tools', 'generators'],
        'astrology'   => ['lifestyle', 'generators'],
        'health'      => ['fitness', 'kitchen', 'lifestyle'],
    ];

    /**
     * Ek tool ke liye cross-category tools nikalte hain (max 3)
     */
    public function getCrossLinks(array $tool, int $limit = 3): Collection
    {
        $relatedCategories = $this->crossMap[$tool['category']] ?? [];

        if (empty($relatedCategories)) return collect();

        $allTools = collect(config('tools.tools', []))
                      ->merge(config('tools.pro_calculators', []));

        return $allTools
            ->whereIn('category', $relatedCategories)
            ->where('slug', '!=', $tool['slug'])
            ->shuffle()
            ->take($limit);
    }
}
```

### Tool view mein use karo:

```blade
{{-- Tool page ke neeche, related tools ke baad --}}
@if($crossLinks->isNotEmpty())
<aside class="cross-links">
    <h3>You might also need</h3>
    <ul>
        @foreach($crossLinks as $cl)
            <li>
                <a href="{{ route('tool', $cl['slug']) }}">
                    {{ $cl['name'] }}
                </a>
                <span class="cross-cat">{{ config('tools.categories.' . $cl['category'] . '.name') }}</span>
            </li>
        @endforeach
    </ul>
</aside>
@endif
```

---

## Step 5 — Homepage Category Links (L1 → L2)

### `resources/views/home.blade.php` mein categories grid:

```blade
{{-- Homepage pe har category ka card aur tool count --}}
<section class="categories-grid">
    @foreach(config('tools.categories') as $slug => $cat)
        @php
            $count = collect(config('tools.tools'))
                       ->merge(config('tools.pro_calculators'))
                       ->where('category', $slug)
                       ->count();
        @endphp
        @if($count > 0)
        <a href="{{ route('category', $slug) }}" class="category-card">
            <i class="fas {{ $cat['icon'] }}"></i>
            <strong>{{ $cat['name'] }}</strong>
            <span>{{ $count }} tools</span>
        </a>
        @endif
    @endforeach
</section>
```

---

## Step 6 — Footer Tool Clusters (Link Juice Distribution)

Footer mein popular tools ke quick links — har page pe render hoga, matlab 1,429 × N links.

### `app/View/Composers/FooterComposer.php`:

```php
<?php

namespace App\View\Composers;

use Illuminate\View\View;

class FooterComposer
{
    public function compose(View $view): void
    {
        // Cache karo — footer har page pe load hota hai
        $clusters = cache()->remember('footer_clusters', 3600, function () {
            $allTools = collect(config('tools.tools', []))
                          ->merge(config('tools.pro_calculators', []));

            // Top 6 categories se 5 tools each
            $topCats = ['finance', 'health', 'calculators',
                        'math', 'text', 'webmaster'];

            return collect($topCats)->mapWithKeys(function ($cat) use ($allTools) {
                $catName = config('tools.categories.' . $cat . '.name', $cat);
                $tools   = $allTools->where('category', $cat)
                                    ->sortBy('name')
                                    ->take(5)
                                    ->values();
                return [$catName => $tools];
            });
        });

        $view->with('footerClusters', $clusters);
    }
}
```

### `AppServiceProvider.php` mein register karo:

```php
use App\View\Composers\FooterComposer;

public function boot(): void
{
    View::composer('partials.footer', FooterComposer::class);
}
```

### `resources/views/partials/footer.blade.php`:

```blade
<footer>
    <div class="footer-clusters">
        @foreach($footerClusters as $catName => $tools)
            <div class="footer-col">
                <h4>{{ $catName }}</h4>
                <ul>
                    @foreach($tools as $tool)
                        <li>
                            <a href="{{ route('tool', $tool['slug']) }}">
                                {{ $tool['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</footer>
```

---

## Caching — Important!

Yeh sab services 1,429 tools ko har request pe scan karte hain. Cache zaroor lagao:

```php
// ToolController mein
public function show($slug)
{
    $tool    = $this->findTool($slug);
    $related = cache()->remember(
        "related_{$slug}",
        86400,  // 24 ghante
        fn() => $this->relatedTools->getRelated($tool, 6)
    );

    return view('tools.show', compact('tool', 'related'));
}
```

Cache clear karne ka command (`tools.php` badlne ke baad):
```bash
php artisan cache:clear
```

---

## Expected Results Timeline

| Week | Action | Expected change |
|---|---|---|
| Week 1 | Breadcrumbs + Related widget | Crawl depth giregi, bounce rate giregi |
| Week 2 | Category hub pages live | Google inhe index karega, hub pages rank karne lagengi |
| Week 3 | Cross-category links | More pages Google ke radar pe aane lagengi |
| Week 4–6 | Google re-crawl | Rankings improve hone shuru hongi |
| Month 2–3 | Full effect | +40–60% organic traffic estimated |

---

## Quick Check — Minimum Links Per Page

Har tool page pe verify karo:

- [ ] Breadcrumb: 2 links (Home, Category)
- [ ] Related tools widget: 6 links
- [ ] Cross-category "also need": 3 links
- [ ] Footer: ~30 links (5 cats × 6 tools)
- [ ] Category hub link in nav/header: 1 link

**Minimum per page: ~42 internal links** — Google "not enough internal links" ka issue khatam.
