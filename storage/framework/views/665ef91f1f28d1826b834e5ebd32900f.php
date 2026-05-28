<div class="tool-interactive-container">
    <div class="card border-0 shadow-sm p-4 mb-4 bg-white rounded-4">
        <div class="row g-3 align-items-end mb-4">
            <div class="col-md-5">
                <label class="form-label fw-bold small text-uppercase text-muted">Video Topic / Main Keywords</label>
                <input type="text" id="ytd-topic" class="form-control border-2" placeholder="e.g. How to grow a YouTube channel">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold small text-uppercase text-muted">Tone</label>
                <select id="ytd-tone" class="form-select border-2">
                    <option value="seo">SEO Optimized</option>
                    <option value="engaging">Engaging / Community</option>
                    <option value="clickbait">Clickbait / Viral</option>
                    <option value="professional">Professional / Business</option>
                    <option value="educational">Educational / Tutorial</option>
                    <option value="ai">AI Optimized</option>
                </select>
            </div>
            <div class="col-md-4">
                <button id="ytd-generate-btn" class="btn btn-accent px-4 py-2 w-100 fw-bold rounded-3 text-white">
                    <i class="fas fa-magic me-2"></i> Generate Descriptions
                </button>
            </div>
        </div>

        <div id="ytd-results-container" class="d-none">
            <h5 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
                <span>AI Generated Descriptions</span>
                <span class="badge bg-danger rounded-pill px-3">5 Results</span>
            </h5>
            <div id="ytd-results-list" class="vstack gap-4">
                <!-- Result blocks will be injected here -->
            </div>
        </div>

        <div id="ytd-placeholder" class="text-center py-5">
            <div class="opacity-25 mb-3"><i class="fas fa-file-alt fa-4x text-danger"></i></div>
            <h5 class="text-muted">Enter your video topic to generate SEO-perfect descriptions</h5>
        </div>
    </div>
</div>

<style>
    .btn-accent { background: #ff0000; border: none; transition: 0.3s; }
    .btn-accent:hover { background: #cc0000; transform: translateY(-1px); }
    .desc-block { border: 2px solid #f8f9fa; border-radius: 15px; padding: 25px; background: #fff; transition: 0.3s; position: relative; }
    .desc-block:hover { border-color: #ff000022; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .desc-content { white-space: pre-wrap; font-family: 'Inter', sans-serif; font-size: 0.95rem; color: #444; line-height: 1.6; max-height: 300px; overflow-y: auto; padding: 15px; background: #fcfcfc; border-radius: 10px; border: 1px solid #eee; }
    .copy-badge { position: absolute; top: 15px; right: 15px; cursor: pointer; transition: 0.2s; }
    .copy-badge:hover { transform: scale(1.1); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const generateBtn = document.getElementById('ytd-generate-btn');
    const topicInput = document.getElementById('ytd-topic');
    const toneSelect = document.getElementById('ytd-tone');
    const resultsContainer = document.getElementById('ytd-results-container');
    const resultsList = document.getElementById('ytd-results-list');
    const placeholder = document.getElementById('ytd-placeholder');

    generateBtn.addEventListener('click', function() {
        const topic = topicInput.value.trim();
        if (!topic) return alert('Please enter a video topic');

        generateBtn.disabled = true;
        generateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Generating AI Content...';

        fetch('<?php echo e(route('social.generate', ['type' => 'youtube-description'])); ?>', {
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
                
                data.results.forEach((desc, index) => {
                    const block = document.createElement('div');
                    block.className = 'desc-block';
                    block.innerHTML = `
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-light text-dark border fw-bold text-uppercase small">Variation ${index + 1}</span>
                            <button class="btn btn-sm btn-outline-danger rounded-pill copy-btn px-3">
                                <i class="fas fa-copy me-2"></i> Copy Description
                            </button>
                        </div>
                        <div class="desc-content">${desc}</div>
                    `;
                    
                    const btn = block.querySelector('.copy-btn');
                    btn.addEventListener('click', () => copyToClipboard(desc, btn));
                    resultsList.appendChild(block);
                });
                
                window.scrollTo({ top: resultsContainer.offsetTop - 100, behavior: 'smooth' });
            }
        })
        .catch(err => alert('Error generating descriptions. Please try again.'))
        .finally(() => {
            generateBtn.disabled = false;
            generateBtn.innerHTML = '<i class="fas fa-magic me-2"></i> Generate Descriptions';
        });
    });

    function copyToClipboard(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            const original = btn.innerHTML;
            btn.classList.add('btn-success');
            btn.classList.remove('btn-outline-danger');
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => {
                btn.classList.remove('btn-success');
                btn.classList.add('btn-outline-danger');
                btn.innerHTML = original;
            }, 2000);
        });
    }
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\youtube-description-generator.blade.php ENDPATH**/ ?>