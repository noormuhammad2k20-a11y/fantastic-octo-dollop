<div class="interactive-tool-grid cartoon-maker-tool">
    <!-- Input Card -->
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="mb-4">
                <label class="form-label-custom">Upload Your Photo</label>
                <div class="upload-dropzone-custom" id="cartoonDropZone">
                    <i class="fas fa-cloud-upload-alt fa-3x text-accent mb-3"></i>
                    <h5 class="mb-1">Click or Drag Your Image Here</h5>
                    <p class="text-muted small mb-0">Supports JPG, PNG, WebP — Max 20MB</p>
                    <input type="file" id="cartoonFileInput" class="d-none" accept="image/jpeg,image/png,image/webp">
                </div>
                <div id="cartoonFileInfo" class="text-center small text-success fw-bold mt-2 d-none">
                    <i class="fas fa-image me-1"></i> <span id="cartoonFileName"></span>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label-custom">Effect Intensity</label>
                    <select id="cartoonIntensity" class="form-control-custom">
                        <option value="light">Light Cartoon</option>
                        <option value="medium" selected>Medium Cartoon</option>
                        <option value="heavy">Heavy Cartoon</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Edge Style</label>
                    <select id="cartoonEdgeStyle" class="form-control-custom">
                        <option value="bold" selected>Bold Edges</option>
                        <option value="subtle">Subtle Edges</option>
                        <option value="none">No Edges</option>
                    </select>
                </div>
            </div>

            <button id="cartoonConvertBtn" class="btn d-block mx-auto btn-accent py-3 px-5 fw-bold rounded-pill shadow-sm" disabled>
                <i class="fas fa-magic me-2"></i> Convert to Cartoon
            </button>

            <div id="cartoonLoading" class="text-center py-4 d-none">
                <div class="spinner-border text-accent" role="status">
                    <span class="visually-hidden">Processing...</span>
                </div>
                <p class="mt-3 text-muted">Applying cartoon effect...</p>
            </div>
        </div>
    </div>

    <!-- Result Card -->
    <div class="result-panel">
        <div class="calculator-card h-100">
            <div class="calculator-header mb-3">
                <div class="tool-icon-circle" style="background: var(--accent-soft); color: var(--accent);">
                    <i class="fas fa-image"></i>
                </div>
                <div>
                    <h4>Result Preview</h4>
                    <p>Your cartoon image will appear here</p>
                </div>
            </div>

            <div id="cartoonResultArea" class="d-none">
                <div class="cartoon-preview-grid mb-3">
                    <div class="preview-pane">
                        <span class="preview-label">Original</span>
                        <canvas id="cartoonOriginalCanvas" class="preview-canvas"></canvas>
                    </div>
                    <div class="preview-pane">
                        <span class="preview-label">Cartoon</span>
                        <canvas id="cartoonResultCanvas" class="preview-canvas"></canvas>
                    </div>
                </div>
                <a id="cartoonDownloadBtn" href="#" class="btn btn-accent w-100 py-3 fw-bold text-decoration-none d-block text-center" download="cartoon-image.png">
                    <i class="fas fa-download me-2"></i> Download Cartoon Image
                </a>
            </div>

            <div id="cartoonEmpty" class="text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-palette fa-3x" style="color: var(--border-color);"></i>
                </div>
                <p class="text-muted small">Upload an image and click convert to see your cartoon result here.</p>
            </div>
        </div>
    </div>
</div>

<?php $__env->startSection('seo_content'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('faq_content'); ?>
<!-- Custom FAQ for Cartoon Image Maker -->
<section class="seo-section" style="padding-top: 0;">
    <h2>Frequently Asked Questions</h2>
    <div class="faq-section">
        <div class="accordion" id="cartoonFaqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cfaq1">
                        Is the Cartoon Image Maker free to use?
                    </button>
                </h2>
                <div id="cfaq1" class="accordion-collapse collapse" data-bs-parent="#cartoonFaqAccordion">
                    <div class="accordion-body">
                        Yes, 100% free! There are no hidden charges, no subscriptions, and no limits on how many images you can convert. You can use the tool as many times as you like without creating an account.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cfaq2">
                        Is my image safe? Are photos uploaded to a server?
                    </button>
                </h2>
                <div id="cfaq2" class="accordion-collapse collapse" data-bs-parent="#cartoonFaqAccordion">
                    <div class="accordion-body">
                        Your images are completely safe. All processing happens locally in your web browser using the Canvas API. Your photos are never uploaded to any server, making this tool 100% private and secure.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cfaq3">
                        What image formats are supported?
                    </button>
                </h2>
                <div id="cfaq3" class="accordion-collapse collapse" data-bs-parent="#cartoonFaqAccordion">
                    <div class="accordion-body">
                        The Cartoon Image Maker supports JPG/JPEG, PNG, and WebP formats. These cover the vast majority of photo formats used on the web and by smartphone cameras.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cfaq4">
                        Does the cartoon effect reduce image quality?
                    </button>
                </h2>
                <div id="cfaq4" class="accordion-collapse collapse" data-bs-parent="#cartoonFaqAccordion">
                    <div class="accordion-body">
                        The cartoon effect intentionally simplifies colors and adds stylized edges, which is part of the artistic transformation. The output image maintains the same resolution as your original photo, so there is no loss in image dimensions or sharpness beyond the intended artistic effect.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('related_tools'); ?>
<!-- Related Tools -->
<section class="seo-section related-tools-section" style="padding-top: 0;">
    <div class="category-header">
        <div><h2>Related Tools</h2></div>
    </div>
    <div class="row g-3">
        <?php
            $cartoonRelated = [
                'image-to-gif' => $tools['image-to-gif'] ?? null,
                'resize-image' => $tools['resize-image'] ?? null,
                'crop-image' => $tools['crop-image'] ?? null,
                'gif-maker' => $tools['gif-maker'] ?? null,
                'image-colorizer' => $tools['image-colorizer'] ?? null,
                'image-compressor' => $tools['image-compressor'] ?? null,
            ];
        ?>
        <?php $__currentLoopData = $cartoonRelated; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relSlug => $relTool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($relTool): ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="<?php echo e(url('/' . $relSlug)); ?>" class="tool-card">
                        <div class="tool-icon">
                            <i class="<?php echo e($relTool['icon']); ?>"></i>
                        </div>
                        <div class="tool-body">
                            <h3 class="tool-name"><?php echo e($relTool['h1']); ?></h3>
                            <p class="tool-desc"><?php echo e($relTool['description']); ?></p>
                        </div>
                        <span class="tool-arrow">Use tool <i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('cartoonDropZone');
    const fileInput = document.getElementById('cartoonFileInput');
    const convertBtn = document.getElementById('cartoonConvertBtn');
    const loading = document.getElementById('cartoonLoading');
    const resultArea = document.getElementById('cartoonResultArea');
    const emptyState = document.getElementById('cartoonEmpty');
    const originalCanvas = document.getElementById('cartoonOriginalCanvas');
    const resultCanvas = document.getElementById('cartoonResultCanvas');
    const downloadBtn = document.getElementById('cartoonDownloadBtn');
    const intensitySelect = document.getElementById('cartoonIntensity');
    const edgeStyleSelect = document.getElementById('cartoonEdgeStyle');

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
        document.getElementById('cartoonFileInfo').classList.remove('d-none');
        document.getElementById('cartoonFileName').textContent = file.name;
        convertBtn.disabled = false;
    }

    convertBtn.addEventListener('click', function() {
        if (!selectedFile) return;
        convertBtn.disabled = true;
        loading.classList.remove('d-none');
        resultArea.classList.add('d-none');
        emptyState.classList.add('d-none');

        const reader = new FileReader();
        reader.onload = function(e) {
            const img = new Image();
            img.onload = function() {
                processCartoon(img);
                convertBtn.disabled = false;
                loading.classList.add('d-none');
            };
            img.onerror = function() {
                alert('Failed to load image.');
                convertBtn.disabled = false;
                loading.classList.add('d-none');
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(selectedFile);
    });

    function processCartoon(img) {
        const intensity = intensitySelect.value;
        const edgeStyle = edgeStyleSelect.value;

        // Limit canvas size for performance
        let w = img.width, h = img.height;
        const maxDim = 1920;
        if (w > maxDim || h > maxDim) {
            const scale = maxDim / Math.max(w, h);
            w = Math.round(w * scale);
            h = Math.round(h * scale);
        }

        // Draw original
        originalCanvas.width = w; originalCanvas.height = h;
        const origCtx = originalCanvas.getContext('2d');
        origCtx.drawImage(img, 0, 0, w, h);

        // Process cartoon
        resultCanvas.width = w; resultCanvas.height = h;
        const ctx = resultCanvas.getContext('2d');
        ctx.drawImage(img, 0, 0, w, h);

        const imageData = ctx.getImageData(0, 0, w, h);
        const data = imageData.data;

        // Step 1: Color Quantization (Posterize)
        const levels = intensity === 'heavy' ? 4 : intensity === 'medium' ? 6 : 10;
        const step = 255 / levels;
        for (let i = 0; i < data.length; i += 4) {
            data[i]     = Math.round(Math.round(data[i] / step) * step);     // R
            data[i + 1] = Math.round(Math.round(data[i + 1] / step) * step); // G
            data[i + 2] = Math.round(Math.round(data[i + 2] / step) * step); // B
        }

        // Step 2: Slight saturation boost for cartoon vibrance
        for (let i = 0; i < data.length; i += 4) {
            const r = data[i], g = data[i+1], b = data[i+2];
            const gray = 0.299 * r + 0.587 * g + 0.114 * b;
            const satBoost = 1.3;
            data[i]     = Math.min(255, Math.max(0, gray + (r - gray) * satBoost));
            data[i + 1] = Math.min(255, Math.max(0, gray + (g - gray) * satBoost));
            data[i + 2] = Math.min(255, Math.max(0, gray + (b - gray) * satBoost));
        }

        ctx.putImageData(imageData, 0, 0);

        // Step 3: Edge Detection & Overlay
        if (edgeStyle !== 'none') {
            const edgeCanvas = document.createElement('canvas');
            edgeCanvas.width = w; edgeCanvas.height = h;
            const edgeCtx = edgeCanvas.getContext('2d');
            edgeCtx.drawImage(img, 0, 0, w, h);
            const edgeData = edgeCtx.getImageData(0, 0, w, h);
            const ed = edgeData.data;

            // Sobel edge detection
            const edgeResult = new Uint8ClampedArray(w * h);
            for (let y = 1; y < h - 1; y++) {
                for (let x = 1; x < w - 1; x++) {
                    const idx = (y * w + x);
                    const getGray = (xx, yy) => {
                        const i = (yy * w + xx) * 4;
                        return 0.299 * ed[i] + 0.587 * ed[i+1] + 0.114 * ed[i+2];
                    };
                    const gx = -getGray(x-1,y-1) - 2*getGray(x-1,y) - getGray(x-1,y+1)
                               +getGray(x+1,y-1) + 2*getGray(x+1,y) + getGray(x+1,y+1);
                    const gy = -getGray(x-1,y-1) - 2*getGray(x,y-1) - getGray(x+1,y-1)
                               +getGray(x-1,y+1) + 2*getGray(x,y+1) + getGray(x+1,y+1);
                    edgeResult[idx] = Math.min(255, Math.sqrt(gx * gx + gy * gy));
                }
            }

            // Overlay edges on the posterized image
            const threshold = edgeStyle === 'bold' ? 40 : 70;
            const finalData = ctx.getImageData(0, 0, w, h);
            const fd = finalData.data;
            for (let y = 0; y < h; y++) {
                for (let x = 0; x < w; x++) {
                    const idx = y * w + x;
                    if (edgeResult[idx] > threshold) {
                        const pi = idx * 4;
                        const alpha = edgeStyle === 'bold' ? 0.85 : 0.5;
                        fd[pi]     = fd[pi] * (1 - alpha);
                        fd[pi + 1] = fd[pi + 1] * (1 - alpha);
                        fd[pi + 2] = fd[pi + 2] * (1 - alpha);
                    }
                }
            }
            ctx.putImageData(finalData, 0, 0);
        }

        // Show result
        resultArea.classList.remove('d-none');
        emptyState.classList.add('d-none');
        downloadBtn.href = resultCanvas.toDataURL('image/png');
        downloadBtn.download = 'cartoon-' + (selectedFile ? selectedFile.name.replace(/\.[^.]+$/, '') : 'image') + '.png';
    }
});
</script>

<style>
.cartoon-maker-tool {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
}
@media (min-width: 992px) {
    .cartoon-maker-tool { grid-template-columns: 1.2fr 1fr; }
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
.cartoon-preview-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
}
.preview-pane {
    position: relative;
    border-radius: var(--radius-md, 12px);
    overflow: hidden;
    border: 1px solid var(--border-color);
    background: #fafafa;
}
.preview-pane .preview-canvas {
    width: 100%;
    height: auto;
    display: block;
}
.preview-label {
    position: absolute;
    top: 8px; left: 8px;
    background: rgba(0,0,0,0.65);
    color: #fff;
    font-size: 0.7rem;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 20px;
    z-index: 2;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\cartoon-image-maker.blade.php ENDPATH**/ ?>