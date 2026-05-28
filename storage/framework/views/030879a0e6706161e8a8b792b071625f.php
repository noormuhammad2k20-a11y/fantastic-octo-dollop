<div class="row g-4">
    <!-- Input Card -->
    <div class="col-lg-8">
        <div class="calculator-card h-100">
            

            <div class="mb-4">
                <label class="form-label-custom">Select Media File</label>
                <div class="p-4 border-2 border-dashed rounded-3 text-center bg-light-subtle upload-dropzone mb-3" style="border-radius: var(--radius-md) !important; cursor: pointer;" onclick="document.getElementById('mediaInput').click()">
                    <i class="fas fa-file-video fa-3x text-accent mb-3"></i>
                    <h5 class="mb-1">Choose Media File</h5>
                    <p class="text-muted small mb-0">Drag and drop or click to upload. Max 500MB.</p>
                    <input type="file" id="mediaInput" class="d-none" accept="video/*,audio/*">
                </div>
                <div id="fileSelectionInfo" class="text-center small text-success fw-bold d-none">
                    <i class="fas fa-film me-1"></i> <span id="selectedFileName"></span>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label-custom">Target Category</label>
                    <select id="targetType" class="form-select border-0 shadow-sm py-2" style="border-radius: var(--radius-md);">
                        <option value="video">Convert to Video</option>
                        <option value="audio">Convert to Audio</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Output Format</label>
                    <select id="outputFormat" class="form-select border-0 shadow-sm py-2" style="border-radius: var(--radius-md);">
                        <!-- Options will be dynamic -->
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label-custom" id="optLabel">Quality / Bitrate</label>
                    <select id="outputQuality" class="form-select border-0 shadow-sm py-2" style="border-radius: var(--radius-md);">
                        <option value="high">High (Maximum Fidelity)</option>
                        <option value="medium">Medium (Balanced)</option>
                        <option value="low">Low (Small File)</option>
                    </select>
                </div>
            </div>

            <button id="convertBtn" class="btn d-block mx-auto -accent mt-2 py-3 px-5 fw-bold rounded-pill shadow-sm">
                <i class="fas fa-sync-alt me-2"></i> Start Professional Conversion
            </button>

            <div id="loadingState" class="text-center py-5 d-none">
                <div class="spinner-border text-accent" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Processing your media file... Please wait.</p>
            </div>
        </div>
    </div>

    <!-- Output Card -->
    <div class="col-lg-4">
        <div class="calculator-card h-100">
            <div class="calculator-header mb-4">
                <div class="tool-icon-circle" style="background: var(--accent-soft); color: var(--accent);">
                    <i class="fas fa-check-double"></i>
                </div>
                <div>
                    <h4>Output</h4>
                    <p>Processed file result</p>
                </div>
            </div>

            <div id="resultsArea" class="d-none text-center">
                <div class="alert alert-success border-0 shadow-sm mb-4 p-3" style="border-radius: var(--radius-md);">
                    <i class="fas fa-check-circle me-2 text-success"></i> Conversion Success!
                </div>
                
                <div class="p-5 bg-light rounded border border-light-subtle mb-4" style="border-radius: var(--radius-md);">
                    <i class="fas fa-file-export fa-5x text-accent opacity-25"></i>
                </div>

                <a id="downloadBtn" href="#" class="btn-accent w-100 py-3 fw-bold text-center text-decoration-none d-block shadow-sm" download>
                    <i class="fas fa-download me-2"></i> Download Converted File
                </a>
            </div>

            <div id="emptyResults" class="text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-sliders-h fa-3x text-light-subtle"></i>
                </div>
                <p class="text-muted small">Configure your settings and click convert to generate your file.</p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const targetType = document.getElementById('targetType');
    const outputFormat = document.getElementById('outputFormat');
    const optLabel = document.getElementById('optLabel');
    const convertBtn = document.getElementById('convertBtn');
    const mediaInput = document.getElementById('mediaInput');
    const loadingState = document.getElementById('loadingState');
    const resultsArea = document.getElementById('resultsArea');
    const downloadBtn = document.getElementById('downloadBtn');

    const formats = {
        video: ['mp4', 'mkv', 'avi', 'webm', 'mov'],
        audio: ['mp3', 'wav', 'aac', 'flac', 'ogg']
    };

    function updateFormats() {
        const type = targetType.value;
        outputFormat.innerHTML = '';
        formats[type].forEach(f => {
            const opt = document.createElement('option');
            opt.value = f;
            opt.textContent = f.toUpperCase();
            outputFormat.appendChild(opt);
        });
        optLabel.textContent = type === 'video' ? 'Video Quality' : 'Audio Bitrate';
    }

    targetType.addEventListener('change', updateFormats);
    updateFormats();

    mediaInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            document.getElementById('fileSelectionInfo').classList.remove('d-none');
            document.getElementById('selectedFileName').textContent = this.files[0].name;
        }
    });

    convertBtn.addEventListener('click', async function() {
        if (!mediaInput.files[0]) {
            alert('Please select a media file');
            return;
        }

        convertBtn.disabled = true;
        loadingState.classList.remove('d-none');
        resultsArea.classList.add('d-none');
        document.getElementById('emptyResults').classList.remove('d-none');

        const formData = new FormData();
        formData.append('file', mediaInput.files[0]);
        formData.append('format', outputFormat.value);
        formData.append('quality', document.getElementById('outputQuality').value);

        try {
            // We'll map this to the universal pro converter endpoint
            const response = await fetch('<?php echo e(route("tool.process", ["tool" => "video-audio-pro"])); ?>', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                const url = '<?php echo e(url("storage")); ?>/' + data.processed_path;
                downloadBtn.href = url;
                downloadBtn.setAttribute('download', data.processed_filename);
                resultsArea.classList.remove('d-none');
                document.getElementById('emptyResults').classList.add('d-none');
            } else {
                alert(data.message || 'Failed to convert media');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred during conversion');
        } finally {
            convertBtn.disabled = false;
            loadingState.classList.add('d-none');
        }
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\video-audio-pro.blade.php ENDPATH**/ ?>