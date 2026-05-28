@php
    $items = $items ?? [];
@endphp

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb mb-0 py-2 px-3 bg-light rounded-pill d-flex flex-wrap border"
        itemscope itemtype="https://schema.org/BreadcrumbList">
        <li class="breadcrumb-item"
            itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="{{ route('home') }}" class="text-decoration-none text-secondary" itemprop="item">
                <i class="fas fa-home me-1"></i>
                <span itemprop="name">Home</span>
            </a>
            <meta itemprop="position" content="1" />
        </li>
        @foreach($items as $i => $item)
            @if($loop->last)
                <li class="breadcrumb-item active text-primary fw-bold" aria-current="page"
                    itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">{{ $item['name'] }}</span>
                    <meta itemprop="position" content="{{ $i + 2 }}" />
                </li>
            @else
                <li class="breadcrumb-item"
                    itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ $item['url'] }}" class="text-decoration-none text-secondary" itemprop="item">
                        <span itemprop="name">{{ $item['name'] }}</span>
                    </a>
                    <meta itemprop="position" content="{{ $i + 2 }}" />
                </li>
            @endif
        @endforeach
    </ol>
</nav>

<style>
    .breadcrumb-item + .breadcrumb-item::before { content: "\f105"; font-family: "Font Awesome 6 Free"; font-weight: 900; color: #6c757d; font-size: 0.8rem; vertical-align: middle; }
    .breadcrumb-item.active { color: var(--accent) !important; }
    .breadcrumb { font-size: 0.85rem; }
</style>
