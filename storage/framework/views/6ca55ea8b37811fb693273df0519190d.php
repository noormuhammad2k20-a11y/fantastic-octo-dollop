<div class="row g-4">
    <!-- Input Card -->
    <div class="col-lg-8">
        <div class="calculator-card h-100">
            

            <div class="mb-4">
                <label for="youtubeUrl" class="form-label-custom">YouTube Video URL</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fab fa-youtube" style="color: #FF0000;"></i></span>
                    <input type="url" class="form-control-custom border-start-0 ps-0" id="youtubeUrl" placeholder="https://www.youtube.com/watch?v=..." required>
                </div>
                <div class="form-text mt-2">Paste the link of the video you want to analyze.</div>
            </div>

            <button id="extractTagsBtn" class="btn d-block mx-auto -accent mt-2 py-3 px-5 fw-bold rounded-pill shadow-sm">
                <i class="fas fa-search me-2"></i> Extract Tags
            </button>

            <div id="loadingState" class="text-center py-5 d-none">
                <div class="spinner-border text-accent" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Analyzing video metadata...</p>
            </div>
        </div>
    </div>

    <!-- Output Card -->
    <div class="col-lg-4">
        <div class="calculator-card h-100">
            <div class="calculator-header mb-4">
                <div class="tool-icon-circle" style="background: var(--accent-soft); color: var(--accent);">
                    <i class="fas fa-tags"></i>
                </div>
                <div>
                    <h4>Tags Result</h4>
                    <p>Extracted video keywords</p>
                </div>
            </div>

            <div id="resultsArea" class="d-none">
                <div class="alert alert-success border-0 shadow-sm d-flex align-items-center mb-4 p-3" style="border-radius: var(--radius-md);">
                    <i class="fas fa-check-circle me-3 fs-4 text-success"></i>
                    <div class="small">Found <span id="tagCount" class="fw-bold">0</span> tags.</div>
                </div>

                <div class="mb-4">
                    <div id="tagsContainer" class="p-3 bg-light rounded border border-light-subtle d-flex flex-wrap gap-2 mb-3" style="border-radius: var(--radius-md); max-height: 300px; overflow-y: auto;">
                        <span class="text-muted small">No tags extracted yet.</span>
                    </div>
                    <textarea id="rawTags" class="form-control d-none"></textarea>
                </div>

                <button id="copyTagsBtn" class="btn d-block mx-auto -outline-custom py-3 px-5 fw-bold rounded-pill shadow-sm">
                    <i class="fas fa-copy me-2"></i> Copy All Tags
                </button>
            </div>

            <div id="emptyResults" class="text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-clipboard-list fa-3x text-light-subtle"></i>
                </div>
                <p class="text-muted small">Enter a YouTube URL and click extract to see results here.</p>
            </div>
        </div>
    </div>
</div>

<style>
    .tag-item {
        background: #fff;
        border: 1px solid var(--border-color);
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--text-secondary);
        transition: all var(--transition-normal);
        box-shadow: var(--shadow-sm);
    }
    .tag-item:hover {
        background: var(--accent-soft);
        border-color: var(--accent);
        color: var(--accent);
        transform: translateY(-2px);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const extractBtn = document.getElementById('extractTagsBtn');
    const loadingState = document.getElementById('loadingState');
    const resultsArea = document.getElementById('resultsArea');
    const tagsContainer = document.getElementById('tagsContainer');
    const tagCount = document.getElementById('tagCount');
    const rawTags = document.getElementById('rawTags');
    const copyBtn = document.getElementById('copyTagsBtn');

    extractBtn.addEventListener('click', async function() {
        const url = document.getElementById('youtubeUrl').value.trim();
        if (!url) {
            alert('Please enter a valid YouTube URL');
            return;
        }

        extractBtn.disabled = true;
        loadingState.classList.remove('d-none');
        resultsArea.classList.add('d-none');
        document.getElementById('emptyResults').classList.remove('d-none');

        try {
            const response = await fetch('<?php echo e(route("tool.process", ["tool" => "youtube-tag-extractor"])); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({ url: url })
            });

            const data = await response.json();

            if (data.success) {
                const tags = data.content.split('\n').filter(t => t.trim() !== "");
                tagsContainer.innerHTML = '';
                
                if (tags.length === 0 || (tags.length === 1 && tags[0].includes("No tags found"))) {
                    tagsContainer.innerHTML = '<span class="text-muted italic">No tags found for this video.</span>';
                    tagCount.textContent = '0';
                    rawTags.value = '';
                } else {
                    tags.forEach(tag => {
                        const span = document.createElement('span');
                        span.className = 'tag-item';
                        span.textContent = tag.trim();
                        tagsContainer.appendChild(span);
                    });
                    tagCount.textContent = tags.length;
                    rawTags.value = tags.join(', ');
                }
                
                resultsArea.classList.remove('d-none');
                document.getElementById('emptyResults').classList.add('d-none');
            } else {
                alert(data.message || 'Failed to extract tags');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred during extraction');
        } finally {
            extractBtn.disabled = false;
            loadingState.classList.add('d-none');
        }
    });

    copyBtn.addEventListener('click', function() {
        rawTags.classList.remove('d-none');
        rawTags.select();
        document.execCommand('copy');
        rawTags.classList.add('d-none');
        
        const originalText = copyBtn.innerHTML;
        copyBtn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
        copyBtn.classList.replace('btn-outline-secondary', 'btn-success');
        
        setTimeout(() => {
            copyBtn.innerHTML = originalText;
            copyBtn.classList.replace('btn-success', 'btn-outline-secondary');
        }, 2000);
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\youtube-tag-extractor.blade.php ENDPATH**/ ?>