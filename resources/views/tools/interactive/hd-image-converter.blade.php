@php
    $targetSize = $page['target_size'] ?? '';
    $prefillVal = '';
    $prefillUnit = 'kb';
    if ($targetSize) {
        $prefillVal = (int)preg_replace('/[^0-9]/', '', $targetSize);
        $prefillUnit = str_contains(strtolower($targetSize), 'mb') ? 'mb' : 'kb';
    }
@endphp
<div class="row g-4">
    <!-- Input Card -->
    <div class="col-lg-8">
        <div class="calculator-card h-100">
            

            <div class="mb-4">
                <label class="form-label-custom">Upload Image</label>
                <div class="p-4 border-2 border-dashed rounded-3 text-center bg-light-subtle upload-dropzone mb-3" style="border-radius: var(--radius-md) !important; cursor: pointer;" onclick="document.getElementById('imageInput').click()">
                    <i class="fas fa-images fa-3x text-accent mb-3"></i>
                    <h5 class="mb-1">Click or Drag Image Here</h5>
                    <p class="text-muted small mb-0">Supports JPG, PNG, WebP. Max 20MB.</p>
                    <input type="file" id="imageInput" class="d-none" accept="image/jpeg,image/png,image/webp">
                </div>
                <div id="fileSelectionInfo" class="text-center small text-success fw-bold d-none">
                    <i class="fas fa-image me-1"></i> <span id="selectedFileName"></span>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12">
                    <label class="form-label-custom mb-2">Target File Size (Optional)</label>
                </div>
                <div class="col-md-6">
                    <input type="number" id="targetFileSize" class="form-control border-0 shadow-sm py-2" placeholder="Value (e.g., 100)" style="border-radius: var(--radius-md);" value="{{ $prefillVal }}">
                </div>
                <div class="col-md-6">
                    <select id="targetFileSizeUnit" class="form-select border-0 shadow-sm py-2" style="border-radius: var(--radius-md);">
                        <option value="kb" {{ $prefillUnit === 'kb' ? 'selected' : '' }}>KB</option>
                        <option value="mb" {{ $prefillUnit === 'mb' ? 'selected' : '' }}>MB</option>
                    </select>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label-custom">Output Format</label>
                    <select id="outputFormat" class="form-select border-0 shadow-sm py-2" style="border-radius: var(--radius-md);">
                        <option value="jpg">JPG (High Quality)</option>
                        <option value="png">PNG (Lossless)</option>
                        <option value="webp">WebP (Optimized)</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Target Size (Longest Side)</label>
                    <select id="targetSize" class="form-select border-0 shadow-sm py-2" style="border-radius: var(--radius-md);">
                        <option value="1920">Full HD (1080p / 1920px)</option>
                        <option value="2560">QHD (1440p / 2560px)</option>
                        <option value="3840">4K Ultra HD (3840px)</option>
                        <option value="keep">Keep Original Resolution</option>
                    </select>
                </div>
            </div>

            <button id="convertBtn" class="btn d-block mx-auto -accent mt-2 py-3 px-5 fw-bold rounded-pill shadow-sm">
                <i class="fas fa-magic me-2"></i> Enhance & Convert
            </button>

            <div id="loadingState" class="text-center py-5 d-none">
                <div class="spinner-border text-accent" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Processing high-resolution image...</p>
            </div>
        </div>
    </div>

    <!-- Output Card -->
    <div class="col-lg-4">
        <div class="calculator-card h-100">
            <div class="calculator-header mb-4">
                <div class="tool-icon-circle" style="background: var(--accent-soft); color: var(--accent);">
                    <i class="fas fa-photo-video"></i>
                </div>
                <div>
                    <h4>Result Preview</h4>
                    <p>Optimized image output</p>
                </div>
            </div>

            <div id="resultsArea" class="d-none">
                <div class="alert alert-success border-0 shadow-sm d-flex align-items-center mb-4 p-3" style="border-radius: var(--radius-md);">
                    <i class="fas fa-check-circle me-3 fs-4 text-success"></i>
                    <div class="small fw-bold">Conversion Success!</div>
                </div>

                <div class="mb-4 text-center">
                    <img id="imagePreview" src="" class="img-fluid rounded shadow-sm border" style="max-height: 250px; border-radius: var(--radius-md);">
                </div>

                <a id="downloadBtn" href="#" class="btn-accent w-100 py-3 fw-bold text-center text-decoration-none d-block" download>
                    <i class="fas fa-download me-2"></i> Download HD Image
                </a>
            </div>

            <div id="emptyResults" class="text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-image fa-3x text-light-subtle"></i>
                </div>
                <p class="text-muted small">Upload an image and click convert to see the high-definition result here.</p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const convertBtn = document.getElementById('convertBtn');
    const imageInput = document.getElementById('imageInput');
    const loadingState = document.getElementById('loadingState');
    const resultsArea = document.getElementById('resultsArea');
    const imagePreview = document.getElementById('imagePreview');
    const downloadBtn = document.getElementById('downloadBtn');

    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            document.getElementById('fileSelectionInfo').classList.remove('d-none');
            document.getElementById('selectedFileName').textContent = this.files[0].name;
        }
    });

    convertBtn.addEventListener('click', async function() {
        if (!imageInput.files[0]) {
            alert('Please select an image first');
            return;
        }

        convertBtn.disabled = true;
        loadingState.classList.remove('d-none');
        resultsArea.classList.add('d-none');
        document.getElementById('emptyResults').classList.remove('d-none');

        const formData = new FormData();
        formData.append('file', imageInput.files[0]);
        formData.append('format', document.getElementById('outputFormat').value);
        formData.append('size', document.getElementById('targetSize').value);
        formData.append('target_file_size', document.getElementById('targetFileSize').value);
        formData.append('target_unit', document.getElementById('targetFileSizeUnit').value);

        try {
            const response = await fetch('{{ route("tool.process", ["tool" => "hd-image-converter"]) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            });

            const data = await response.json();

            if (data.success && data.processed_filename) {
                // Use the new preview route for real-time display
                const previewUrl = '{{ route("tool.preview", ["filename" => ":filename"]) }}'.replace(':filename', data.processed_filename);
                imagePreview.src = previewUrl;
                
                // Calculate a clean download name
                let downloadName = data.processed_filename;
                const format = document.getElementById('outputFormat').value;
                
                // If filename is a UUID or missing extension, give it a generic friendly name
                if (downloadName.length > 30 && !downloadName.includes('processed_') || !downloadName.includes('.')) {
                    downloadName = `converted-hd-image.${format}`;
                }

                downloadBtn.href = data.download_url;
                downloadBtn.setAttribute('download', downloadName);
                
                resultsArea.classList.remove('d-none');
                document.getElementById('emptyResults').classList.add('d-none');
            } else {
                alert(data.message || 'Failed to process image. Please try again with different settings.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred during processing');
        } finally {
            convertBtn.disabled = false;
            loadingState.classList.add('d-none');
        }
    });
});
</script>
