<div class="interactive-tool-grid instagram-audio-downloader">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="row g-4">
                <div class="col-md-12">
                    <label class="form-label-custom">Instagram Link (URL)</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-link text-secondary"></i></span>
                        <input type="text" id="instagram-url" class="form-control-custom form-control-lg border-start-0" placeholder="https://www.instagram.com/reels/XXXXX/" style="padding-left: 0;">
                    </div>
                </div>
            </div>

            <div class="d-flex gap-3 mt-4">
                <button type="button" class="btn btn-accent flex-grow-1 py-3 fw-bold" id="process-instagram" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-download me-2"></i> Extract Audio
                </button>
            </div>
        </div>
    </div>

    <!-- Result / Preview Section -->
    <div class="result-panel">
        <div class="result-card-v2 d-flex flex-column align-items-center justify-content-center p-4 bg-white rounded shadow-sm border h-100" id="result-container">
            <div id="result-placeholder" class="text-center opacity-50 py-5">
                <i class="fas fa-music fa-3x mb-3 text-secondary"></i>
                <h5>Ready to Process</h5>
                <p class="small">Paste a valid Instagram link to start extraction.</p>
            </div>

            <div id="result-content" class="d-none w-100 text-center">
                <div class="bg-light p-4 rounded mb-4 border d-flex align-items-center justify-content-center" style="min-height: 120px;">
                    <div class="audio-wave">
                        <span></span><span></span><span></span><span></span><span></span>
                    </div>
                </div>
                
                <h5 class="mb-1 text-truncate px-3" id="audio-title">Instagram Audio File</h5>
                <p class="text-secondary small mb-4" id="audio-size">Calculating size...</p>

                <div class="d-flex gap-2 w-100 mt-auto">
                    <button class="btn btn-primary flex-grow-1" id="download-mp3" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download me-2"></i> Download MP3
                    </button>
                </div>
            </div>

            <div id="loading-spinner" class="d-none text-center py-5">
                <div class="spinner-border text-accent mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h5>Fetching Content...</h5>
                <p class="small text-secondary">Searching Instagram's servers</p>
            </div>

            <div id="error-message" class="d-none text-center py-5 text-danger">
                <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                <h5>Extraction Failed</h5>
                <p class="small">Please ensure the link is public and valid.</p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlInput = document.getElementById('instagram-url');
    const processBtn = document.getElementById('process-instagram');
    const placeholder = document.getElementById('result-placeholder');
    const content = document.getElementById('result-content');
    const spinner = document.getElementById('loading-spinner');
    const errorMsg = document.getElementById('error-message');
    const downloadBtn = document.getElementById('download-mp3');
    const audioTitle = document.getElementById('audio-title');

    function showState(state) {
        placeholder.classList.add('d-none');
        content.classList.add('d-none');
        spinner.classList.add('d-none');
        errorMsg.classList.add('d-none');

        if (state === 'placeholder') placeholder.classList.remove('d-none');
        if (state === 'content') content.classList.remove('d-none');
        if (state === 'spinner') spinner.classList.remove('d-none');
        if (state === 'error') errorMsg.classList.remove('d-none');
    }

    let currentDownloadUrl = '';
    let currentFilename = '';

    processBtn.addEventListener('click', function() {
        const url = urlInput.value.trim();
        
        if (!url) {
            alert('Please paste an Instagram link.');
            return;
        }

        showState('spinner');

        // Real API Call
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
            if (data.success && data.results && data.results[0].success) {
                const result = data.results[0];
                currentDownloadUrl = result.download_url;
                currentFilename = result.processed_filename;
                audioTitle.textContent = result.name || 'extracted_audio.mp3';
                document.getElementById('audio-size').textContent = (result.new_size / 1024 / 1024).toFixed(2) + ' MB';
                showState('content');
            } else {
                showState('error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showState('error');
        });
    });

    downloadBtn.addEventListener('click', function() {
        if (currentDownloadUrl) {
            alert('Download starting... (Backend link required for actual file generation)');
            window.location.href = currentDownloadUrl;
        }
    });
});
</script>

<style>
.interactive-tool-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
}
@media (min-width: 992px) {
    .interactive-tool-grid {
        grid-template-columns: 1.5fr 1fr;
    }
}
.calculator-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    padding: 2rem;
    border: 1px solid rgba(0,0,0,0.05);
}
.calculator-header {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #eee;
}
.tool-icon-circle {
    width: 60px;
    height: 60px;
    background: rgba(var(--accent-rgb), 0.1);
    color: var(--accent);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
}
.form-label-custom {
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    color: var(--text-dark);
}
.form-control-custom {
    border-radius: 8px;
    padding: 0.75rem 1rem;
    border: 1px solid #ddd;
    width: 100%;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.form-control-custom:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(var(--accent-rgb), 0.1);
}

/* Audio Wave Animation */
.audio-wave {
    display: flex;
    align-items: center;
    gap: 4px;
    height: 40px;
}
.audio-wave span {
    width: 4px;
    height: 10px;
    background: var(--accent);
    border-radius: 4px;
    animation: wave 1s infinite ease-in-out;
}
.audio-wave span:nth-child(2) { height: 30px; animation-delay: 0.1s; }
.audio-wave span:nth-child(3) { height: 40px; animation-delay: 0.2s; }
.audio-wave span:nth-child(4) { height: 25px; animation-delay: 0.3s; }
.audio-wave span:nth-child(5) { height: 15px; animation-delay: 0.4s; }

@keyframes wave {
    0%, 100% { transform: scaleY(1); }
    50% { transform: scaleY(0.5); }
}

.input-group-text {
    border-radius: 8px 0 0 8px;
}
.form-control-lg {
    border-radius: 0 8px 8px 0 !important;
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\instagram-audio-downloader.blade.php ENDPATH**/ ?>