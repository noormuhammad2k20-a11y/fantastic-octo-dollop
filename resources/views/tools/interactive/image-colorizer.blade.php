<div class="interactive-tool-grid colorizer-tool">
    <!-- Input Card -->
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="mb-4">
                <label class="form-label-custom">Upload Black & White Image</label>
                <div class="upload-dropzone-custom" id="colorizerDropZone">
                    <i class="fas fa-cloud-upload-alt fa-3x text-accent mb-3"></i>
                    <h5 class="mb-1">Click or Drag Your Image Here</h5>
                    <p class="text-muted small mb-0">Supports JPG, PNG, WebP — Max 20MB</p>
                    <input type="file" id="colorizerFileInput" class="d-none" accept="image/jpeg,image/png,image/webp">
                </div>
                <div id="colorizerFileInfo" class="text-center small text-success fw-bold mt-2 d-none">
                    <i class="fas fa-image me-1"></i> <span id="colorizerFileName"></span>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label-custom">Color Mode</label>
                    <select id="colorizerMode" class="form-control-custom">
                        <option value="natural" selected>Natural Tones</option>
                        <option value="warm">Warm Tones</option>
                        <option value="cool">Cool Tones</option>
                        <option value="vintage">Vintage</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Color Intensity</label>
                    <select id="colorizerIntensity" class="form-control-custom">
                        <option value="0.5">Subtle</option>
                        <option value="0.75" selected>Balanced</option>
                        <option value="1.0">Vivid</option>
                    </select>
                </div>
            </div>

            <button id="colorizerBtn" class="btn d-block mx-auto btn-accent py-3 px-5 fw-bold rounded-pill shadow-sm" disabled>
                <i class="fas fa-magic me-2"></i> Colorize Image
            </button>

            <div id="colorizerLoading" class="text-center py-4 d-none">
                <div class="spinner-border text-accent" role="status">
                    <span class="visually-hidden">Processing...</span>
                </div>
                <p class="mt-3 text-muted">Applying color transformation...</p>
            </div>
        </div>
    </div>

    <!-- Result Card (Before/After Slider) -->
    <div class="result-panel">
        <div class="calculator-card h-100">
            <div class="calculator-header mb-3">
                <div class="tool-icon-circle" style="background: var(--accent-soft); color: var(--accent);">
                    <i class="fas fa-adjust"></i>
                </div>
                <div>
                    <h4>Before / After</h4>
                    <p>Drag the slider to compare</p>
                </div>
            </div>

            <div id="colorizerResultArea" class="d-none">
                <div class="ba-slider-container" id="baSliderContainer">
                    <canvas id="colorizerAfterCanvas" class="ba-canvas"></canvas>
                    <div class="ba-overlay" id="baOverlay">
                        <canvas id="colorizerBeforeCanvas" class="ba-canvas"></canvas>
                    </div>
                    <div class="ba-handle" id="baHandle">
                        <div class="ba-handle-line"></div>
                        <div class="ba-handle-circle">
                            <i class="fas fa-arrows-alt-h"></i>
                        </div>
                        <div class="ba-handle-line"></div>
                    </div>
                    <span class="ba-label ba-label-left">Before</span>
                    <span class="ba-label ba-label-right">After</span>
                </div>

                <a id="colorizerDownloadBtn" href="#" class="btn btn-accent w-100 py-3 fw-bold text-decoration-none d-block text-center mt-3" download="colorized-image.png">
                    <i class="fas fa-download me-2"></i> Download Colorized Image
                </a>
            </div>

            <div id="colorizerEmpty" class="text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-fill-drip fa-3x" style="color: var(--border-color);"></i>
                </div>
                <p class="text-muted small">Upload a black & white image and click colorize to see the result here.</p>
            </div>
        </div>
    </div>
</div>

@section('seo_content')

@endsection

@section('faq_content')
<!-- Custom FAQ for Image Colorizer -->
<section class="seo-section" style="padding-top: 0;">
    <h2>Frequently Asked Questions</h2>
    <div class="faq-section">
        <div class="accordion" id="colorizerFaqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#clfaq1">
                        Does the Image Colorizer use AI?
                    </button>
                </h2>
                <div id="clfaq1" class="accordion-collapse collapse" data-bs-parent="#colorizerFaqAccordion">
                    <div class="accordion-body">
                        The colorizer uses advanced tone-mapping algorithms that intelligently analyze the brightness values in your image and apply appropriate color palettes. The processing runs entirely in your browser using Canvas API, providing instant results without server-side computation.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#clfaq2">
                        Are my images safe and private?
                    </button>
                </h2>
                <div id="clfaq2" class="accordion-collapse collapse" data-bs-parent="#colorizerFaqAccordion">
                    <div class="accordion-body">
                        Absolutely. All processing happens locally in your browser. Your images are never uploaded to any server, ensuring 100% privacy. No data is collected, stored, or shared.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#clfaq3">
                        Is the Image Colorizer free to use?
                    </button>
                </h2>
                <div id="clfaq3" class="accordion-collapse collapse" data-bs-parent="#colorizerFaqAccordion">
                    <div class="accordion-body">
                        Yes, completely free! There are no charges, no subscriptions, and no limits. You can colorize as many images as you want without creating an account.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#clfaq4">
                        Does it work on very old or damaged photos?
                    </button>
                </h2>
                <div id="clfaq4" class="accordion-collapse collapse" data-bs-parent="#colorizerFaqAccordion">
                    <div class="accordion-body">
                        Yes! The tool works on any grayscale or black and white image, including old and slightly damaged photographs. For best results, we recommend scanning old photos at a high resolution first. The colorization algorithm works with whatever brightness data is available in the image.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('related_tools')
<!-- Related Tools -->
<section class="seo-section related-tools-section" style="padding-top: 0;">
    <div class="category-header">
        <div><h2>Related Tools</h2></div>
    </div>
    <div class="row g-3">
        @php
            $colorizerRelated = [
                'hd-image-converter' => $tools['hd-image-converter'] ?? null,
                'resize-image' => $tools['resize-image'] ?? null,
                'crop-image' => $tools['crop-image'] ?? null,
                'jpg-to-png' => $tools['jpg-to-png'] ?? null,
                'cartoon-image-maker' => $tools['cartoon-image-maker'] ?? null,
                'image-compressor' => $tools['image-compressor'] ?? null,
            ];
        @endphp
        @foreach($colorizerRelated as $relSlug => $relTool)
            @if($relTool)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ url('/' . $relSlug) }}" class="tool-card">
                        <div class="tool-icon">
                            <i class="{{ $relTool['icon'] }}"></i>
                        </div>
                        <div class="tool-body">
                            <h3 class="tool-name">{{ $relTool['h1'] }}</h3>
                            <p class="tool-desc">{{ $relTool['description'] }}</p>
                        </div>
                        <span class="tool-arrow">Use tool <i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
</section>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('colorizerDropZone');
    const fileInput = document.getElementById('colorizerFileInput');
    const colorizeBtn = document.getElementById('colorizerBtn');
    const loading = document.getElementById('colorizerLoading');
    const resultArea = document.getElementById('colorizerResultArea');
    const emptyState = document.getElementById('colorizerEmpty');
    const beforeCanvas = document.getElementById('colorizerBeforeCanvas');
    const afterCanvas = document.getElementById('colorizerAfterCanvas');
    const downloadBtn = document.getElementById('colorizerDownloadBtn');
    const modeSelect = document.getElementById('colorizerMode');
    const intensitySelect = document.getElementById('colorizerIntensity');

    let selectedFile = null;

    // Drag & Drop
    dropZone.addEventListener('click', () => fileInput.click());
    dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.classList.add('drag-active'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('drag-active'));
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('drag-active');
        if (e.dataTransfer.files[0]) { fileInput.files = e.dataTransfer.files; handleFile(e.dataTransfer.files[0]); }
    });
    fileInput.addEventListener('change', () => { if (fileInput.files[0]) handleFile(fileInput.files[0]); });

    function handleFile(file) {
        if (file.size > 20 * 1024 * 1024) { alert('File too large. Max 20MB.'); return; }
        selectedFile = file;
        document.getElementById('colorizerFileInfo').classList.remove('d-none');
        document.getElementById('colorizerFileName').textContent = file.name;
        colorizeBtn.disabled = false;
    }

    colorizeBtn.addEventListener('click', function() {
        if (!selectedFile) return;
        colorizeBtn.disabled = true;
        loading.classList.remove('d-none');
        resultArea.classList.add('d-none');
        emptyState.classList.add('d-none');

        const reader = new FileReader();
        reader.onload = function(e) {
            const img = new Image();
            img.onload = function() {
                processColorize(img);
                colorizeBtn.disabled = false;
                loading.classList.add('d-none');
            };
            img.onerror = function() {
                alert('Failed to load image.');
                colorizeBtn.disabled = false;
                loading.classList.add('d-none');
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(selectedFile);
    });

    function processColorize(img) {
        const mode = modeSelect.value;
        const intensity = parseFloat(intensitySelect.value);

        let w = img.width, h = img.height;
        const maxDim = 1920;
        if (w > maxDim || h > maxDim) {
            const scale = maxDim / Math.max(w, h);
            w = Math.round(w * scale);
            h = Math.round(h * scale);
        }

        // Draw B&W (before)
        beforeCanvas.width = w; beforeCanvas.height = h;
        const bCtx = beforeCanvas.getContext('2d');
        bCtx.drawImage(img, 0, 0, w, h);

        // Convert to actual grayscale for before
        const bData = bCtx.getImageData(0, 0, w, h);
        const bd = bData.data;
        for (let i = 0; i < bd.length; i += 4) {
            const gray = 0.299 * bd[i] + 0.587 * bd[i+1] + 0.114 * bd[i+2];
            bd[i] = bd[i+1] = bd[i+2] = gray;
        }
        bCtx.putImageData(bData, 0, 0);

        // Draw colorized (after)
        afterCanvas.width = w; afterCanvas.height = h;
        const aCtx = afterCanvas.getContext('2d');
        aCtx.drawImage(img, 0, 0, w, h);

        const aData = aCtx.getImageData(0, 0, w, h);
        const ad = aData.data;

        // Color palettes for different modes
        const palettes = {
            natural: [
                { range: [0, 50], h: 30, s: 0.15 },     // Dark: subtle warm brown
                { range: [50, 100], h: 25, s: 0.25 },    // Mid-dark: earthy
                { range: [100, 150], h: 35, s: 0.35 },   // Mid: golden warmth
                { range: [150, 200], h: 40, s: 0.3 },    // Mid-light: warm light
                { range: [200, 256], h: 45, s: 0.2 },    // Bright: soft warm
            ],
            warm: [
                { range: [0, 50], h: 15, s: 0.2 },
                { range: [50, 100], h: 20, s: 0.4 },
                { range: [100, 150], h: 30, s: 0.5 },
                { range: [150, 200], h: 35, s: 0.45 },
                { range: [200, 256], h: 40, s: 0.3 },
            ],
            cool: [
                { range: [0, 50], h: 220, s: 0.15 },
                { range: [50, 100], h: 210, s: 0.3 },
                { range: [100, 150], h: 200, s: 0.35 },
                { range: [150, 200], h: 195, s: 0.3 },
                { range: [200, 256], h: 190, s: 0.2 },
            ],
            vintage: [
                { range: [0, 50], h: 35, s: 0.1 },
                { range: [50, 100], h: 30, s: 0.2 },
                { range: [100, 150], h: 38, s: 0.25 },
                { range: [150, 200], h: 42, s: 0.2 },
                { range: [200, 256], h: 45, s: 0.15 },
            ]
        };

        const palette = palettes[mode] || palettes.natural;

        for (let i = 0; i < ad.length; i += 4) {
            const gray = 0.299 * ad[i] + 0.587 * ad[i+1] + 0.114 * ad[i+2];

            // Find the matching palette entry
            let hue = 30, sat = 0.2;
            for (const p of palette) {
                if (gray >= p.range[0] && gray < p.range[1]) {
                    hue = p.h;
                    sat = p.s * intensity;
                    break;
                }
            }

            // Convert gray + hue + saturation to RGB via HSL
            const l = gray / 255;
            const s = sat;
            const hNorm = hue / 360;

            const hue2rgb = (p, q, t) => {
                if (t < 0) t += 1;
                if (t > 1) t -= 1;
                if (t < 1/6) return p + (q - p) * 6 * t;
                if (t < 1/2) return q;
                if (t < 2/3) return p + (q - p) * (2/3 - t) * 6;
                return p;
            };

            let r, g, b;
            if (s === 0) {
                r = g = b = l;
            } else {
                const q = l < 0.5 ? l * (1 + s) : l + s - l * s;
                const p = 2 * l - q;
                r = hue2rgb(p, q, hNorm + 1/3);
                g = hue2rgb(p, q, hNorm);
                b = hue2rgb(p, q, hNorm - 1/3);
            }

            ad[i]     = Math.min(255, Math.max(0, Math.round(r * 255)));
            ad[i + 1] = Math.min(255, Math.max(0, Math.round(g * 255)));
            ad[i + 2] = Math.min(255, Math.max(0, Math.round(b * 255)));
        }

        aCtx.putImageData(aData, 0, 0);

        // Show result area
        resultArea.classList.remove('d-none');
        emptyState.classList.add('d-none');

        downloadBtn.href = afterCanvas.toDataURL('image/png');
        downloadBtn.download = 'colorized-' + (selectedFile ? selectedFile.name.replace(/\.[^.]+$/, '') : 'image') + '.png';

        // Reset slider
        initBeforeAfterSlider();
    }

    // Before/After Slider
    function initBeforeAfterSlider() {
        const container = document.getElementById('baSliderContainer');
        const overlay = document.getElementById('baOverlay');
        const handle = document.getElementById('baHandle');

        let isDragging = false;

        function setPosition(x) {
            const rect = container.getBoundingClientRect();
            let pos = ((x - rect.left) / rect.width) * 100;
            pos = Math.max(0, Math.min(100, pos));
            overlay.style.width = pos + '%';
            handle.style.left = pos + '%';
        }

        // Set initial 50%
        overlay.style.width = '50%';
        handle.style.left = '50%';

        container.addEventListener('mousedown', (e) => { isDragging = true; setPosition(e.clientX); });
        document.addEventListener('mousemove', (e) => { if (isDragging) setPosition(e.clientX); });
        document.addEventListener('mouseup', () => { isDragging = false; });

        container.addEventListener('touchstart', (e) => { isDragging = true; setPosition(e.touches[0].clientX); }, { passive: true });
        document.addEventListener('touchmove', (e) => { if (isDragging) setPosition(e.touches[0].clientX); }, { passive: true });
        document.addEventListener('touchend', () => { isDragging = false; });
    }
});
</script>

<style>
.colorizer-tool {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
}
@media (min-width: 992px) {
    .colorizer-tool { grid-template-columns: 1.2fr 1fr; }
}
.upload-dropzone-custom {
    padding: 2.5rem 1.5rem;
    border: 2px dashed var(--border-color);
    border-radius: var(--radius-md, 12px);
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: var(--bg-light, #f8f9fa);
}
.upload-dropzone-custom:hover, .upload-dropzone-custom.drag-active {
    border-color: var(--accent);
    background: rgba(var(--accent-rgb, 99,102,241), 0.05);
    transform: translateY(-2px);
}

/* Before/After Slider */
.ba-slider-container {
    position: relative;
    width: 100%;
    overflow: hidden;
    border-radius: var(--radius-md, 12px);
    border: 1px solid var(--border-color);
    cursor: ew-resize;
    user-select: none;
    -webkit-user-select: none;
}
.ba-canvas {
    display: block;
    width: 100%;
    height: auto;
}
.ba-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 50%;
    height: 100%;
    overflow: hidden;
}
.ba-overlay .ba-canvas {
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    min-width: 0;
    object-fit: cover;
}
.ba-handle {
    position: absolute;
    top: 0;
    left: 50%;
    width: 4px;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 10;
    transform: translateX(-50%);
    pointer-events: none;
}
.ba-handle-line {
    flex: 1;
    width: 3px;
    background: #fff;
    box-shadow: 0 0 6px rgba(0,0,0,0.4);
}
.ba-handle-circle {
    width: 40px; height: 40px;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    display: flex; align-items: center; justify-content: center;
    color: var(--accent);
    font-size: 1rem;
    flex-shrink: 0;
}
.ba-label {
    position: absolute;
    bottom: 10px;
    background: rgba(0,0,0,0.6);
    color: #fff;
    font-size: 0.7rem;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    z-index: 5;
}
.ba-label-left { left: 10px; }
.ba-label-right { right: 10px; }
</style>
