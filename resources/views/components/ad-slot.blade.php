{{-- resources/views/components/ad-slot.blade.php --}}
@props(['type' => 'banner', 'class' => ''])

@if(config('ads.enabled'))
    <div class="ad-slot-container {{ $class }} my-4 text-center">
        {{-- ════════════ ADSENSE CODE GOES HERE ════════════ --}}
        <!-- [AdSense Placeholder: {{ $type }}] -->
        <div class="ad-placeholder-inner" style="min-height: 90px; background: rgba(0,0,0,0.02); border-radius: 8px;">
            {{-- This content only shows if config('ads.enabled') is true --}}
        </div>
    </div>
@endif
