@php
    $items = $items ?? [];
@endphp

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb mb-0 py-2 px-3 bg-light rounded-pill d-flex flex-wrap border">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}" class="text-decoration-none text-secondary">
                <i class="fas fa-home me-1"></i> Home
            </a>
        </li>
        @foreach($items as $item)
            @if($loop->last)
                <li class="breadcrumb-item active text-primary fw-bold" aria-current="page">
                    {{ $item['name'] }}
                </li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{ $item['url'] }}" class="text-decoration-none text-secondary">
                        {{ $item['name'] }}
                    </a>
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
