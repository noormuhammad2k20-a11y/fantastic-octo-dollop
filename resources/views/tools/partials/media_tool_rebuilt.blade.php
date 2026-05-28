@php
    $tool = (array)$tool;
    $mediaType = $tool['category'] ?? 'video';
    $accentColor = match($mediaType) {
        'video' => '#3b82f6',
        'audio' => '#8b5cf6',
        'image' => '#ec4899',
        default => '#3b82f6'
    };
    $accentHue = match($mediaType) {
        'video' => '217',
        'audio' => '258',
        'image' => '330',
        default => '217'
    };
@endphp

<div class="media-rebuilt-container" style="--media-accent: {{ $accentColor }}; --media-accent-h: {{ $accentHue }};">
    
    {{-- ════════════ INPUT CARD (12 COLUMNS) ════════════ --}}
    <div class="media-card input-card shadow-sm" id="media-input-card">
        <div class="media-header">
            <div class="media-icon-circle">
                <i class="{{ $tool['icon'] ?? 'fas fa-file-video' }}"></i>
            </div>
            <div>
                <h4>{{ $tool['h1'] ?? $tool['title'] }}</h4>
                <p>{{ $tool['description'] ?? $tool['subtitle'] }}</p>
            </div>
        </div>

        {{-- Drop Zone --}}
        <div class="media-drop-zone mb-4" id="media-drop-zone">
            <div class="dz-icon">
                <i class="fas fa-cloud-upload-alt"></i>
            </div>
            <h5 class="fw-bold">Drag & Drop Your {{ strtoupper($mediaType) }} Here</h5>
            <p class="text-muted small">or click to browse from your device</p>
            
            <div class="selected-file d-none" id="selected-file-info">
                <div class="d-flex align-items-center justify-content-center gap-3 p-3 bg-white rounded-4 border shadow-sm">
                    <div class="media-icon-circle" style="width: 42px; height: 42px; font-size: 1rem;">
                        <i class="fas fa-file"></i>
                    </div>
                    <div class="text-start">
                        <div class="fw-bold small file-name">filename.mp4</div>
                        <div class="text-muted smaller file-size">2.4 MB</div>
                    </div>
                    <button type="button" class="btn btn-sm btn-light rounded-circle remove-file">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
        <input type="file" id="media-file-input" accept="{{ $tool['accepted_types'] ?? '*' }}" hidden>

        {{-- Pro-Level Options --}}
        @if(!empty($tool['options']))
            <div class="pro-options-container">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="fw-bold small text-muted uppercase tracking-wider"><i class="fas fa-sliders-h me-1"></i> Professional Configuration</span>
                    <hr class="flex-grow-1 opacity-10">
                </div>
                
                <div class="pro-options-grid">
                    @foreach($tool['options'] as $option)
                        <div class="option-group">
                            <label>{{ $option['label'] ?? $option['name'] }}</label>
                            @if($option['type'] === 'select')
                                <select class="media-select" name="{{ $option['name'] }}" id="opt-{{ $option['name'] }}">
                                    @foreach($option['choices'] ?? [] as $val => $lbl)
                                        <option value="{{ $val }}" {{ ($option['default'] ?? '') == $val ? 'selected' : '' }}>
                                            {{ $lbl }}
                                        </option>
                                    @endforeach
                                </select>
                            @elseif($option['type'] === 'number')
                                <input type="number" class="media-input" id="opt-{{ $option['name'] }}" value="{{ $option['default'] ?? '' }}">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Quick Presets --}}
        <div class="quick-actions-bar">
            <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-warning me-1"></i>Quick Presets:</span>
            <button type="button" class="btn-quick" data-preset="high-quality">✨ Max Quality</button>
            <button type="button" class="btn-quick" data-preset="web-optimized">🌐 Web Optimized</button>
            <button type="button" class="btn-quick" data-preset="small-size">📱 Mobile Ready</button>
        </div>

        {{-- Process Button --}}
        <div class="mt-5">
            <button type="button" class="btn-process-media" id="btn-process-media">
                <i class="fas fa-cog fa-spin-hover"></i> 
                <span>Process File Now</span>
            </button>
        </div>
    </div>

    {{-- ════════════ OUTPUT CARD (12 COLUMNS) ════════════ --}}
    <div class="output-card-themed" id="media-output-card">
        <div class="output-hero">
            <span class="output-hero-label">Processing Status</span>
            <div class="output-hero-status" id="output-status-text">Uploading File...</div>
            
            {{-- Multi-Stage Progress --}}
            <div class="progress-container">
                <div class="stages-line">
                    <div class="stage-dot active" id="stage-1" data-label="Upload">1</div>
                    <div class="stage-dot" id="stage-2" data-label="Encoding">2</div>
                    <div class="stage-dot" id="stage-3" data-label="Done">3</div>
                </div>
                <div class="progress-track">
                    <div class="progress-fill" id="media-progress-fill" style="width: 0%;"></div>
                </div>
                <div class="text-center mt-2 small fw-bold text-muted" id="media-progress-percent">0%</div>
            </div>
        </div>

        {{-- Result Result --}}
        <div class="result-showcase d-none" id="result-showcase">
            <div class="media-preview-area" id="media-preview-area">
                {{-- Player injected via JS --}}
                <div class="text-white text-center opacity-50">
                    <i class="fas fa-play-circle fa-4x mb-2"></i>
                    <p class="small fw-bold">Preview will appear here</p>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-4 text-center border">
                        <div class="small fw-bold text-muted text-uppercase mb-1">Status</div>
                        <div class="fw-black text-success"><i class="fas fa-check-circle me-1"></i> Success</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-4 text-center border">
                        <div class="small fw-bold text-muted text-uppercase mb-1">New Size</div>
                        <div class="fw-black text-primary" id="res-new-size">--</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-4 text-center border">
                        <div class="small fw-bold text-muted text-uppercase mb-1">Optimization</div>
                        <div class="fw-black text-info" id="res-reduction">--</div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <a href="#" id="btn-download-media" class="btn btn-dark w-100 py-3 fw-bold rounded-4 shadow">
                        <i class="fas fa-download me-2 text-primary"></i>Download Result
                    </a>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-outline-dark w-100 py-3 fw-bold rounded-4 reset-tool">
                        <i class="fas fa-redo me-2"></i>Convert Another
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/media-engine.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    window.mediaEngine = new MediaEngine({
        slug: '{{ $tool['slug'] }}',
        processUrl: "{{ route('tool.process', $tool['slug']) }}",
        acceptedTypes: {!! json_encode(explode(',', $tool['accepted_types'] ?? '')) !!},
        maxSizeMB: {{ $tool['max_size_mb'] ?? 500 }},
        mediaType: '{{ $mediaType }}'
    });
});
</script>
@endpush
