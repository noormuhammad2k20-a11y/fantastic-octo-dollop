<div class="interactive-tool-grid youtube-to-mp3">
    <div class="row g-4">
        <!-- Input Card -->
        <div class="col-lg-8">
            <div class="calculator-card h-100">
                

                <div class="calculator-body">
                    <div class="form-group-custom mb-4">
                        <label class="form-label-custom">YouTube Video URL</label>
                        <div class="input-group shadow-sm" style="border-radius: var(--radius-md); overflow: hidden;">
                            <span class="input-group-text bg-white border-0"><i class="fab fa-youtube text-danger"></i></span>
                            <input type="url" id="youtube-url" class="form-control border-0 py-3" placeholder="https://www.youtube.com/watch?v=..." required style="background: var(--bg-surface);">
                        </div>
                    </div>

                    <div class="alert alert-info py-3 border-0 shadow-sm" style="font-size: 0.9rem; border-radius: 12px; background-color: var(--accent-soft); color: var(--accent);">
                        <i class="fas fa-info-circle me-2"></i> <strong>Premium Extraction:</strong> High-quality 192kbps MP3 will be extracted automatically.
                    </div>

                    <button class="btn d-block mx-auto -accent mt-4 fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm" id="convert-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-bolt me-2"></i> Convert to MP3
                    </button>
                </div>
            </div>
        </div>

        <!-- Output Card -->
        <div class="col-lg-4">
            <div class="calculator-card h-100">
                <div class="calculator-header mb-4">
                    <div class="tool-icon-circle" style="background: var(--accent-soft); color: var(--accent);">
                        <i class="fas fa-download"></i>
                    </div>
                    <div>
                        <h4>Download</h4>
                        <p>Ready to save</p>
                    </div>
                </div>

                <!-- Empty State -->
                <div id="emptyResults" class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-music fa-3x text-light-subtle"></i>
                    </div>
                    <p class="text-muted small">Enter a YouTube URL and click convert to see the download link here.</p>
                </div>

                <!-- Loading State -->
                <div id="loading-container" class="text-center py-5 d-none">
                    <div class="spinner-border text-accent mb-3" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h5>Extracting Audio...</h5>
                    <p class="text-muted small">Processing your request. Please wait...</p>
                </div>

                <!-- Result State -->
                <div id="result-container" class="d-none">
                    <div class="text-center p-4 bg-light rounded-4 mb-4" style="border: 1px dashed var(--border-color);">
                        <div class="text-success small mb-2 text-uppercase letter-spacing-1 fw-bold">Success!</div>
                        <div class="fs-4 fw-bold text-accent mb-3">Audio Ready</div>
                        
                        <div class="small text-start p-3 bg-white rounded-3 shadow-sm">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Format:</span>
                                <span class="fw-bold">MP3</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Quality:</span>
                                <span class="fw-bold text-accent">192kbps</span>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="btn-accent w-100 py-3 d-block text-decoration-none text-white fw-bold shadow-sm" id="download-link" style="border-radius: var(--radius-md);">
                        <i class="fas fa-download me-2"></i> Download MP3
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const convertBtn = document.getElementById('convert-btn');
    const urlInput = document.getElementById('youtube-url');
    const resultContainer = document.getElementById('result-container');
    const loadingContainer = document.getElementById('loading-container');
    const downloadLink = document.getElementById('download-link');

    convertBtn.addEventListener('click', function() {
        const url = urlInput.value.trim();
        if (!url) {
            alert('Please paste a valid YouTube URL');
            return;
        }

        // Show loading
        loadingContainer.classList.remove('d-none');
        resultContainer.classList.add('d-none');
        document.getElementById('emptyResults').classList.add('d-none');
        convertBtn.disabled = true;
 
        const formData = new FormData();
        formData.append('url', url);
        formData.append('_token', '<?php echo e(csrf_token()); ?>');
 
        fetch('<?php echo e(route("tool.process", ["tool" => $slug])); ?>', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            loadingContainer.classList.add('d-none');
            convertBtn.disabled = false;
 
            if (data.success && data.results && data.results[0].success) {
                resultContainer.classList.remove('d-none');
                downloadLink.href = data.results[0].download_url;
                downloadLink.setAttribute('download', 'youtube_audio.mp3');
            } else {
                document.getElementById('emptyResults').classList.remove('d-none');
                alert(data.message || 'Failed to extract audio. Please check the URL.');
            }
        })
        .catch(error => {
            loadingContainer.classList.add('d-none');
            document.getElementById('emptyResults').classList.remove('d-none');
            convertBtn.disabled = false;
            console.error('Error:', error);
            alert('An error occurred during extraction.');
        });
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\youtube-to-mp3.blade.php ENDPATH**/ ?>