@php $tool = (array)$tool; @endphp
{{-- ════════════ UPLOAD ZONE ════════════ --}}

<div class="upload-zone-wrapper">
    <div class="upload-zone" id="upload-zone">
        <div class="upload-icon">
            <i class="fas fa-cloud-upload-alt"></i>
        </div>
        <h3>Drag & Drop Your {{ ($tool['supports_batch'] ?? false) ? 'Files' : 'File' }} Here</h3>
        <p>or <span class="browse-link">browse files</span> from your device</p>
        <p class="file-info">
            <i class="fas fa-info-circle"></i>
            Accepted:
            @php
                $types = $tool['accepted_types'] ?? '';
                if (is_array($types)) $types = implode(', ', $types);
            @endphp
            {{ strtoupper(str_replace(['image/', 'video/', 'application/', ','], ['', '', '', ', '], $types)) }}
            @if(isset($tool['max_size_mb']))
                &bull; Max {{ $tool['max_size_mb'] }}MB
            @endif
        </p>

        {{-- Selected file info --}}
        <div class="selected-file">
            <div class="file-icon"><i class="{{ $tool['icon'] ?? 'fas fa-file' }}"></i></div>
            <div class="file-details">
                <div class="name">filename.jpg</div>
                <div class="size">2.4 MB</div>
            </div>
            <button type="button" class="remove-file" title="Remove file">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    {{-- Hidden file input --}}
    <input type="file" id="file-input" accept="{{ $tool['accepted_types'] ?? '*' }}" {{ ($tool['supports_batch'] ?? false) ? 'multiple' : '' }} hidden>

    {{-- ════════════ TOOL OPTIONS ════════════ --}}
    @php
        $hasUioptions = false;
        if (isset($tool['options']) && is_array($tool['options'])) {
            foreach($tool['options'] as $opt) {
                if (is_array($opt) && isset($opt['name'], $opt['type'])) {
                    $hasUioptions = true;
                    break;
                }
            }
        }
    @endphp

    @if($hasUioptions)
    <div class="tool-options-container" id="tool-options">
        <div class="options-card">
            <h4><i class="fas fa-sliders-h"></i> Configuration Options</h4>
            <div class="options-grid">
                @foreach($tool['options'] as $option)
                    @if(is_array($option) && isset($option['name'], $option['type']))
                    <div class="option-group">
                        <label for="opt-{{ $option['name'] }}">{{ $option['label'] ?? $option['name'] }}</label>

                        @if($option['type'] === 'select')
                            <select name="{{ $option['name'] }}" id="opt-{{ $option['name'] }}">
                                @foreach($option['choices'] ?? [] as $val => $lbl)
                                    <option value="{{ $val }}" {{ ($option['default'] ?? '') == $val ? 'selected' : '' }}>
                                        {{ $lbl }}
                                    </option>
                                @endforeach
                            </select>

                        @elseif($option['type'] === 'slider')
                            <div class="slider-group">
                                <div class="slider-info">
                                    <span class="slider-value">{{ $option['default'] ?? 0 }}%</span>
                                </div>
                                <input type="range" 
                                    name="{{ $option['name'] }}" 
                                    class="option-slider" 
                                    id="opt-{{ $option['name'] }}"
                                    min="{{ $option['min'] ?? 0 }}" 
                                    max="{{ $option['max'] ?? 100 }}" 
                                    step="{{ $option['step'] ?? 1 }}"
                                    value="{{ $option['default'] ?? 50 }}"
                                    data-default="{{ $option['default'] ?? 50 }}">
                            </div>

                        @elseif($option['type'] === 'number')
                            <input type="number" 
                                name="{{ $option['name'] }}" 
                                id="opt-{{ $option['name'] }}"
                                value="{{ $option['default'] ?? '' }}"
                                min="{{ $option['min'] ?? '' }}" 
                                max="{{ $option['max'] ?? '' }}">

                        @elseif($option['type'] === 'checkbox')
                            <div class="checkbox-group">
                                <input type="checkbox" 
                                    name="{{ $option['name'] }}" 
                                    id="opt-{{ $option['name'] }}" 
                                    {{ ($option['default'] ?? false) ? 'checked' : '' }}>
                                <label for="opt-{{ $option['name'] }}">{{ $option['label'] ?? $option['name'] }}</label>
                            </div>

                        @elseif($option['type'] === 'text')
                            <input type="text" 
                                name="{{ $option['name'] }}" 
                                id="opt-{{ $option['name'] }}"
                                value="{{ $option['default'] ?? '' }}"
                                placeholder="{{ $option['placeholder'] ?? '' }}">
                        @endif
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @else
    <div id="tool-options" style="display:none;"></div>
    @endif

    {{-- Process Button --}}
    <div class="text-center">
        <button class="btn-accent btn-accent-lg btn-process" id="btn-process">
            <i class="fas fa-cog"></i> Process File
        </button>
    </div>
</div>
