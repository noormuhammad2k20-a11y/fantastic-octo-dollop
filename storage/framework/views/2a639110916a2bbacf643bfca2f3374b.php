<div class="tool-interactive-container">
    <div class="card border-0 shadow-sm p-4 mb-4 bg-white rounded-4">
        <div class="row g-3 align-items-end mb-4">
            <div class="col-md-5">
                <label class="form-label fw-bold small text-uppercase text-muted">What's your photo about?</label>
                <input type="text" id="cap-topic" class="form-control border-2" placeholder="e.g. Sunset at the beach">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold small text-uppercase text-muted">Tone</label>
                <select id="cap-tone" class="form-select border-2">
                    <option value="fun">Fun & Casual</option>
                    <option value="professional">Professional</option>
                    <option value="aesthetic">Aesthetic / Short</option>
                    <option value="funny">Funny / Witty</option>
                </select>
            </div>
            <div class="col-md-4">
                <button id="cap-generate-btn" class="btn btn-accent px-4 py-2 w-100 fw-bold rounded-3 text-white">
                    <i class="fas fa-magic me-2"></i> Generate Captions
                </button>
            </div>
        </div>

        <div id="cap-results-container" class="d-none">
            <h5 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
                <span>Captions for You</span>
                <button id="cap-copy-all" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Copy All</button>
            </h5>
            <div id="cap-results-list" class="list-group gap-2">
                <!-- Result items will be injected here -->
            </div>
        </div>

        <div id="cap-placeholder" class="text-center py-5">
            <div class="opacity-25 mb-3"><i class="fas fa-quote-right fa-4x text-accent-ig"></i></div>
            <h5 class="text-muted">Enter a topic to generate perfect captions</h5>
        </div>
    </div>
</div>

<style>
    .btn-accent { background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d); border: none; transition: 0.3s; }
    .btn-accent:hover { transform: translateY(-1px); opacity: 0.9; }
    .cap-item { border: 2px solid #f8f9fa !important; border-radius: 12px !important; transition: 0.2s; cursor: pointer; padding: 20px !important; line-height: 1.6; }
    .cap-item:hover { border-color: #c13584 !important; background: #fff5fa !important; }
    .text-accent-ig { color: #c13584; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const generateBtn = document.getElementById('cap-generate-btn');
    const topicInput = document.getElementById('cap-topic');
    const toneSelect = document.getElementById('cap-tone');
    const resultsContainer = document.getElementById('cap-results-container');
    const resultsList = document.getElementById('cap-results-list');
    const placeholder = document.getElementById('cap-placeholder');
    const copyAllBtn = document.getElementById('cap-copy-all');

    let currentCaptions = [];

    generateBtn.addEventListener('click', function() {
        const topic = topicInput.value.trim();
        if (!topic) return alert('Please describe your photo');

        generateBtn.disabled = true;
        generateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Thinking...';

        fetch('<?php echo e(route('social.generate', ['type' => 'instagram-caption'])); ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
            body: JSON.stringify({ topic: topic, tone: toneSelect.value })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                currentCaptions = data.results;
                placeholder.classList.add('d-none');
                resultsContainer.classList.remove('d-none');
                resultsList.innerHTML = '';
                
                data.results.forEach(caption => {
                    const item = document.createElement('div');
                    item.className = 'list-group-item cap-item mb-2';
                    item.innerHTML = `
                        <div class="d-flex justify-content-between align-items-start">
                            <span>${caption}</span>
                            <i class="fas fa-copy text-accent-ig opacity-50 ms-3"></i>
                        </div>
                    `;
                    item.addEventListener('click', () => copyToClipboard(caption, item));
                    resultsList.appendChild(item);
                });
            }
        })
        .finally(() => {
            generateBtn.disabled = false;
            generateBtn.innerHTML = '<i class="fas fa-magic me-2"></i> Generate Captions';
        });
    });

    copyAllBtn.addEventListener('click', () => {
        copyToClipboard(currentCaptions.join('\n\n'), copyAllBtn, true);
    });

    function copyToClipboard(text, element, isButton = false) {
        navigator.clipboard.writeText(text).then(() => {
            const original = element.innerHTML;
            if (isButton) {
                element.innerHTML = '<i class="fas fa-check"></i> Copied!';
                setTimeout(() => element.innerHTML = original, 1500);
            } else {
                element.innerHTML = `<span class="text-success fw-bold"><i class="fas fa-check me-2"></i> Copied to Clipboard!</span>`;
                setTimeout(() => element.innerHTML = original, 1500);
            }
        });
    }
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\instagram-caption-generator.blade.php ENDPATH**/ ?>