@php
    $inputId = $input['id'] ?? uniqid('input_');
    $inputLabel = $input['label'] ?? $input['name'] ?? \Illuminate\Support\Str::title(str_replace(['_', '-'], ' ', $inputId));
    $inputType = $input['type'] ?? 'text';
    // Fix: Fallback for select default boolean casting
    $inputDefault = $input['default'] ?? $input['value'] ?? '';
@endphp

<div class="form-group-custom mb-4 position-relative">
    <div class="d-flex justify-content-between align-items-center mb-1">
        <label class="form-label-custom mb-0" for="pro-{{ $inputId }}">{{ $inputLabel }}</label>
        <div class="input-quick-actions" data-target="pro-{{ $inputId }}">
            @if($inputType !== 'select' && $inputType !== 'checkbox' && $inputType !== 'toggle')
                <button type="button" class="btn-action-icon btn-copy-paste" title="Paste from Clipboard" data-action="paste"><i class="fas fa-paste"></i></button>
            @endif
            @if($inputType === 'number' || $inputType === 'slider')
                <button type="button" class="btn-action-icon btn-random" title="Generate Random Value" data-action="random"><i class="fas fa-random"></i></button>
            @endif
            @if($inputType !== 'select')
                <button type="button" class="btn-action-icon btn-reset" title="Reset Field" data-action="reset"><i class="fas fa-undo"></i></button>
            @endif
        </div>
    </div>
    
    <div class="input-wrapper-refined">
        @if($inputType === 'select')
            <select id="pro-{{ $inputId }}" class="form-select form-select-custom" data-id="{{ $inputId }}">
                @foreach($input['options'] ?? [] as $val => $option)
                    @php
                        $optVal = is_array($option) ? ($option['value'] ?? $val) : $val;
                        $optLabel = is_array($option) ? ($option['label'] ?? $option) : $option;
                    @endphp
                    <option value="{{ $optVal }}" {{ $inputDefault == $optVal ? 'selected' : '' }}>{{ $optLabel }}</option>
                @endforeach
            </select>

        @elseif($inputType === 'checkbox' || $inputType === 'toggle')
            <div class="form-check form-switch custom-switch-lg p-3 border rounded bg-white shadow-sm">
                <input class="form-check-input ms-0 me-2" type="checkbox" id="pro-{{ $inputId }}" data-id="{{ $inputId }}" {{ $inputDefault ? 'checked' : '' }}>
                <span class="text-secondary small fw-bold text-uppercase">{{ $input['description'] ?? 'Enable this option' }}</span>
            </div>

        @elseif($inputType === 'textarea')
            <textarea id="pro-{{ $inputId }}" class="form-control form-control-custom" placeholder="{{ $input['placeholder'] ?? 'Enter data here...' }}" data-id="{{ $inputId }}" rows="4">{{ $inputDefault }}</textarea>

        @elseif($inputType === 'slider')
            <div class="range-slider-container p-2 border rounded bg-white shadow-sm">
                <input type="range" 
                       id="pro-{{ $inputId }}" 
                       class="form-range range-slider-custom w-100" 
                       value="{{ empty($inputDefault) ? '0' : $inputDefault }}"
                       data-id="{{ $inputId }}"
                       @if(isset($input['min'])) min="{{ $input['min'] }}" @endif
                       @if(isset($input['max'])) max="{{ $input['max'] }}" @endif
                       @if(isset($input['step'])) step="{{ $input['step'] }}" @endif
                       oninput="document.getElementById('display-{{ $inputId }}').textContent = this.value">
                <div class="range-value-display ms-2" id="display-{{ $inputId }}">{{ empty($inputDefault) ? '0' : $inputDefault }}</div>
            </div>

        @else
            @if(!empty($input['unit']))
                <div class="input-group">
                    <input type="{{ $inputType }}" 
                           id="pro-{{ $inputId }}" 
                           class="form-control form-control-custom" 
                           placeholder="{{ $input['placeholder'] ?? '' }}"
                           value="{{ $inputDefault }}"
                           data-id="{{ $inputId }}"
                           @if($inputType === 'number' && isset($input['min'])) min="{{ $input['min'] }}" @endif
                           @if($inputType === 'number' && isset($input['max'])) max="{{ $input['max'] }}" @endif
                           @if($inputType === 'number' && isset($input['step'])) step="{{ $input['step'] }}" @endif>
                    <select class="form-select unit-selector" id="pro-{{ $inputId }}-unit" data-id="{{ $inputId }}_unit">
                        <option value="mm">mm</option>
                        <option value="cm" selected>cm</option>
                        <option value="m">m</option>
                        <option value="in">in</option>
                        <option value="ft">ft</option>
                        <option value="yd">yd</option>
                    </select>
                </div>
            @else
                <input type="{{ $inputType }}" 
                       id="pro-{{ $inputId }}" 
                       class="form-control form-control-custom" 
                       placeholder="{{ $input['placeholder'] ?? '' }}"
                       value="{{ $inputDefault }}"
                       data-id="{{ $inputId }}"
                       @if($inputType === 'number' && isset($input['min'])) min="{{ $input['min'] }}" @endif
                       @if($inputType === 'number' && isset($input['max'])) max="{{ $input['max'] }}" @endif
                       @if($inputType === 'number' && isset($input['step'])) step="{{ $input['step'] }}" @endif>
            @endif
        @endif
        
        <div id="pro-hint-{{ $inputId }}" class="input-guided-hint small text-muted mt-2 d-flex align-items-center" style="min-height: 1.5rem;">
            <!-- Hints injected via JS -->
        </div>

        @if(!empty($input['quick_actions']))
            <div class="input-specific-chips d-flex flex-wrap gap-2 mt-2">
                @foreach($input['quick_actions'] as $chip)
                    <button type="button" class="btn-input-chip" data-target="pro-{{ $inputId }}" data-value="{{ $chip['value'] ?? '' }}">
                        {{ $chip['label'] ?? '' }}
                    </button>
                @endforeach
            </div>
        @endif
    </div>
</div>
