<div class="row g-4">
    <!-- Input Card -->
    <div class="col-lg-8">
        <div class="calculator-card h-100">
            

            <div class="mb-4">
                <label for="videoInput" class="form-label-custom">Select Video File</label>
                <div class="p-4 border-2 border-dashed rounded-3 text-center bg-light-subtle upload-dropzone mb-3" style="border-radius: var(--radius-md) !important; cursor: pointer;" onclick="document.getElementById('videoInput').click()">
                    <i class="fas fa-cloud-upload-alt fa-3x text-accent mb-3"></i>
                    <h5 class="mb-1">Click or Drag Video Here</h5>
                    <p class="text-muted small mb-0">Supports MP4, MKV, AVI, MOV. Max 50MB.</p>
                    <input type="file" id="videoInput" class="d-none" accept="video/*">
                </div>
                <div id="fileSelectionInfo" class="text-center small text-success fw-bold d-none">
                    <i class="fas fa-file-video me-1"></i> <span id="selectedFileName"></span>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label-custom">Output Format</label>
                    <select id="audioFormat" class="form-select border-0 shadow-sm py-2" style="border-radius: var(--radius-md);">
                        <option value="mp3">MP3 (Universal)</option>
                        <option value="wav">WAV (Lossless)</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Audio Bitrate</label>
                    <select id="audioBitrate" class="form-select border-0 shadow-sm py-2" style="border-radius: var(--radius-md);">
                        <option value="320">320 kbps (Best)</option>
                        <option value="256">256 kbps</option>
                        <option value="192" selected>192 kbps (High)</option>
                        <option value="128">128 kbps (Standard)</option>
                    </select>
                </div>
            </div>

            <button id="extractBtn" class="btn d-block mx-auto -accent mt-2 py-3 px-5 fw-bold rounded-pill shadow-sm">
                <i class="fas fa-music me-2"></i> Extract Audio Now
            </button>

            <div id="loadingState" class="text-center py-5 d-none">
                <div class="spinner-border text-accent" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Extracting audio track... Please wait.</p>
            </div>
        </div>
    </div>

    <!-- Output Card -->
    <div class="col-lg-4">
        <div class="calculator-card h-100">
            <div class="calculator-header mb-4">
                <div class="tool-icon-circle" style="background: var(--accent-soft); color: var(--accent);">
                    <i class="fas fa-headphones"></i>
                </div>
                <div>
                    <h4>Extracted Audio</h4>
                    <p>Download your result</p>
                </div>
            </div>

            <div id="resultsArea" class="d-none">
                <div class="alert alert-success border-0 shadow-sm d-flex align-items-center mb-4 p-3" style="border-radius: var(--radius-md);">
                    <i class="fas fa-check-circle me-3 fs-4 text-success"></i>
                    <div class="small fw-bold">Ready for Download!</div>
                </div>

                <div class="mb-4 text-center">
                    <div class="p-4 bg-light rounded border border-light-subtle mb-3" style="border-radius: var(--radius-md);">
                        <i class="fas fa-file-audio fa-4x text-accent opacity-50"></i>
                    </div>
                </div>

                <a id="downloadBtn" href="#" class="btn-accent w-100 py-3 fw-bold text-center text-decoration-none d-block" download>
                    <i class="fas fa-download me-2"></i> Download Audio
                </a>
            </div>

            <div id="emptyResults" class="text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-wave-square fa-3x text-light-subtle"></i>
                </div>
                <p class="text-muted small">Upload a video and click extract to see your audio result here.</p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const extractBtn = document.getElementById('extractBtn');
    const videoInput = document.getElementById('videoInput');
    const loadingState = document.getElementById('loadingState');
    const resultsArea = document.getElementById('resultsArea');
    const downloadBtn = document.getElementById('downloadBtn');

    videoInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            document.getElementById('fileSelectionInfo').classList.remove('d-none');
            document.getElementById('selectedFileName').textContent = this.files[0].name;
        }
    });

    extractBtn.addEventListener('click', async function() {
        if (!videoInput.files[0]) {
            alert('Please select a video file first');
            return;
        }

        extractBtn.disabled = true;
        loadingState.classList.remove('d-none');
        resultsArea.classList.add('d-none');
        document.getElementById('emptyResults').classList.remove('d-none');

        const formData = new FormData();
        formData.append('file', videoInput.files[0]);
        formData.append('format', document.getElementById('audioFormat').value);
        formData.append('bitrate', document.getElementById('audioBitrate').value);

        try {
            const response = await fetch('<?php echo e(route("tool.process", ["tool" => "free-audio-extractor"])); ?>', {
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
                alert(data.message || 'Failed to extract audio');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred during extraction');
        } finally {
            extractBtn.disabled = false;
            loadingState.classList.add('d-none');
        }
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\free-audio-extractor.blade.php ENDPATH**/ ?>