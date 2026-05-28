<div class="row g-4">
    <!-- Input Card -->
    <div class="col-lg-8">
        <div class="calculator-card h-100">
            

            <div class="mb-4">
                <label for="youtubeUrl" class="form-label-custom">YouTube Shorts URL</label>
                <div class="input-group shadow-sm" style="border-radius: var(--radius-md); overflow: hidden;">
                    <span class="input-group-text bg-white border-0"><i class="fab fa-youtube text-danger"></i></span>
                    <input type="url" class="form-control border-0 py-3" id="youtubeUrl" placeholder="https://youtube.com/shorts/..." required style="background: var(--bg-surface);">
                </div>
                <div class="form-text mt-3 opacity-75">Paste the link of the YouTube Shorts you want to save.</div>
            </div>

            <button id="convertBtn" class="btn d-block mx-auto -accent mt-4 fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm">
                <i class="fas fa-file-download me-2"></i> Download Short
            </button>
        </div>
    </div>

    <!-- Output Card -->
    <div class="col-lg-4">
        <div class="calculator-card h-100">
            <div class="calculator-header mb-4">
                <div class="tool-icon-circle" style="background: var(--accent-soft); color: var(--accent);">
                    <i class="fas fa-video"></i>
                </div>
                <div>
                    <h4>Result</h4>
                    <p>Ready for download</p>
                </div>
            </div>

            <!-- Empty State -->
            <div id="emptyResults" class="text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-mobile-alt fa-3x text-light-subtle"></i>
                </div>
                <p class="text-muted small">Your downloaded short will appear here.</p>
            </div>

            <!-- Loading State -->
            <div id="loadingState" class="text-center py-5 d-none">
                <div class="spinner-border text-accent mb-3" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h5>Processing Short...</h5>
                <p class="text-muted small">This will only take a few seconds.</p>
            </div>

            <!-- Result Area -->
            <div id="resultsArea" class="d-none">
                <div class="text-center p-4 bg-light rounded-4 mb-4" style="border: 1px dashed var(--border-color);">
                    <div class="text-success small mb-2 text-uppercase fw-bold">Success!</div>
                    <div class="fs-4 fw-bold text-accent mb-3">Short Ready</div>
                    <div class="small text-muted">High-quality MP4 conversion complete.</div>
                </div>

                <a id="downloadLink" href="#" class="btn-accent w-100 py-3 fw-bold text-white text-decoration-none d-block shadow-sm text-center" download style="border-radius: var(--radius-md);">
                    <i class="fas fa-download me-2"></i> Download Video
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const convertBtn = document.getElementById('convertBtn');
    const loadingState = document.getElementById('loadingState');
    const resultsArea = document.getElementById('resultsArea');
    const downloadLink = document.getElementById('downloadLink');

    convertBtn.addEventListener('click', async function() {
        const url = document.getElementById('youtubeUrl').value.trim();
        if (!url) {
            alert('Please enter a valid YouTube Shorts URL');
            return;
        }

        convertBtn.disabled = true;
        loadingState.classList.remove('d-none');
        resultsArea.classList.add('d-none');
        document.getElementById('emptyResults').classList.add('d-none');
        
        try {
            const response = await fetch('{{ route("tool.process", ["tool" => "youtube-shorts-downloader"]) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ url: url })
            });
            
            const data = await response.json();
            
            if (data.success && data.results && data.results[0].success) {
                downloadLink.href = data.results[0].download_url;
                resultsArea.classList.remove('d-none');
            } else {
                document.getElementById('emptyResults').classList.remove('d-none');
                alert(data.message || 'Failed to process Shorts URL');
            }
        } catch (error) {
            console.error('Error:', error);
            document.getElementById('emptyResults').classList.remove('d-none');
            alert('An error occurred during download phase.');
        } finally {
            convertBtn.disabled = false;
            loadingState.classList.add('d-none');
        }
    });
});
</script>
