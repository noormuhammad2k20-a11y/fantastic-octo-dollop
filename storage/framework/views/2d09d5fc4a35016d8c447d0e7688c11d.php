<div class="tool-interactive-container">
    <div class="card border-0 shadow-sm p-4 mb-4 bg-white rounded-4">
        <div class="row g-3 align-items-end mb-4">
            <div class="col-md-5">
                <label class="form-label fw-bold small text-uppercase text-muted">Video Topic / Keywords</label>
                <input type="text" id="yt-topic" class="form-control border-2" placeholder="e.g. How to Bake a Cake">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold small text-uppercase text-muted">Tone</label>
                <select id="yt-tone" class="form-select border-2">
                    <option value="clickbait">Clickbait / Viral</option>
                    <option value="seo">SEO Optimized</option>
                    <option value="emotional">Emotional / Story</option>
                    <option value="educational">Educational</option>
                </select>
            </div>
            <div class="col-md-4">
                <button id="yt-generate-btn" class="btn btn-accent px-4 py-2 w-100 fw-bold rounded-3">
                    <i class="fas fa-magic me-2"></i> Generate Titles
                </button>
            </div>
        </div>

        <div id="yt-results-container" class="d-none">
            <h5 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
                <span>Generated Titles</span>
                <span class="badge bg-light text-muted fw-normal" style="font-size: 0.7rem;">CTR Optimized</span>
            </h5>
            <div id="yt-results-list" class="list-group gap-2">
                <!-- Result items will be injected here -->
            </div>
        </div>
        
        <div id="yt-placeholder" class="text-center py-5">
            <div class="opacity-25 mb-3"><i class="fab fa-youtube fa-4x text-danger"></i></div>
            <h5 class="text-muted">Enter a topic to generate viral titles</h5>
        </div>
    </div>
</div>

<style>
    .btn-accent { background: #ff0000; color: white; border: none; transition: 0.3s; }
    .btn-accent:hover { background: #cc0000; transform: translateY(-1px); }
    .list-group-item-action { border-radius: 12px !important; border: 2px solid #f8f9fa !important; transition: 0.2s; cursor: pointer; }
    .list-group-item-action:hover { border-color: #ff0000 !important; background: #fff5f5; }
    .copy-icon { opacity: 0; transition: 0.2s; }
    .list-group-item-action:hover .copy-icon { opacity: 1; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const generateBtn = document.getElementById('yt-generate-btn');
    const topicInput = document.getElementById('yt-topic');
    const toneSelect = document.getElementById('yt-tone');
    const resultsContainer = document.getElementById('yt-results-container');
    const resultsList = document.getElementById('yt-results-list');
    const placeholder = document.getElementById('yt-placeholder');

    generateBtn.addEventListener('click', function() {
        const topic = topicInput.value.trim();
        if (!topic) return alert('Please enter a topic');

        generateBtn.disabled = true;
        generateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Generating...';

        fetch('<?php echo e(route('social.generate', ['type' => 'youtube-title'])); ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
            body: JSON.stringify({ topic: topic, tone: toneSelect.value })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                placeholder.classList.add('d-none');
                resultsContainer.classList.remove('d-none');
                resultsList.innerHTML = '';
                
                data.results.forEach(title => {
                    const item = document.createElement('div');
                    item.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3 mb-2';
                    item.innerHTML = `
                        <span class="fw-medium">${title}</span>
                        <i class="fas fa-copy text-danger copy-icon"></i>
                    `;
                    item.addEventListener('click', () => copyToClipboard(title, item));
                    resultsList.appendChild(item);
                });
            }
        })
        .finally(() => {
            generateBtn.disabled = false;
            generateBtn.innerHTML = '<i class="fas fa-magic me-2"></i> Generate Titles';
        });
    });

    function copyToClipboard(text, element) {
        navigator.clipboard.writeText(text).then(() => {
            const original = element.innerHTML;
            element.innerHTML = `<span class="text-success fw-bold"><i class="fas fa-check me-2"></i> Copied!</span>`;
            setTimeout(() => element.innerHTML = original, 2000);
        });
    }
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\youtube-title-generator.blade.php ENDPATH**/ ?>