<div class="tool-interactive-container">
    <div class="card border-0 shadow-sm p-4 mb-4 bg-white rounded-4">
        <div class="row g-3 align-items-end mb-4">
            <div class="col-md-5">
                <label class="form-label fw-bold small text-uppercase text-muted">Base Name / Keyword</label>
                <input type="text" id="tt-base" class="form-control border-2" placeholder="e.g. Gamer / Star">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold small text-uppercase text-muted">Vibe</label>
                <select id="tt-vibe" class="form-select border-2">
                    <option value="aesthetic">Aesthetic</option>
                    <option value="cool">Cool & Rare</option>
                    <option value="funny">Funny</option>
                    <option value="og">OG Style</option>
                </select>
            </div>
            <div class="col-md-4">
                <button id="tt-generate-btn" class="btn btn-accent px-4 py-2 w-100 fw-bold rounded-3">
                    <i class="fab fa-tiktok me-2"></i> Generate Usernames
                </button>
            </div>
        </div>

        <div id="tt-results-container" class="d-none">
            <h5 class="fw-bold mb-3">Available Usernames</h5>
            <div class="row g-2" id="tt-results-list">
                <!-- Result items will be injected here -->
            </div>
        </div>

        <div id="tt-placeholder" class="text-center py-5">
            <div class="opacity-25 mb-3"><i class="fab fa-tiktok fa-4x text-dark"></i></div>
            <h5 class="text-muted">Find your rare TikTok username</h5>
        </div>
    </div>
</div>

<style>
    .btn-accent { background: #000000; color: white; border: none; transition: 0.3s; }
    .btn-accent:hover { background: #333333; transform: translateY(-1px); }
    .tt-user-item { background: #f8f9fa; border: 2px solid transparent; border-radius: 10px; padding: 12px 20px; font-weight: 500; cursor: pointer; transition: 0.2s; position: relative; overflow: hidden; }
    .tt-user-item:hover { border-color: #fe2c55; background: #fff5f7; }
    .tt-copy-hint { position: absolute; top: 50%; right: 15px; transform: translateY(-50%); opacity: 0; transition: 0.2s; color: #fe2c55; font-size: 0.8rem; }
    .tt-user-item:hover .tt-copy-hint { opacity: 1; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const generateBtn = document.getElementById('tt-generate-btn');
    const baseInput = document.getElementById('tt-base');
    const vibeSelect = document.getElementById('tt-vibe');
    const resultsContainer = document.getElementById('tt-results-container');
    const resultsList = document.getElementById('tt-results-list');
    const placeholder = document.getElementById('tt-placeholder');

    generateBtn.addEventListener('click', function() {
        const base = baseInput.value.trim();
        if (!base) return alert('Please enter a base name');

        generateBtn.disabled = true;
        generateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Searching...';

        fetch('{{ route('social.generate', ['type' => 'tiktok-username']) }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ base: base, vibe: vibeSelect.value })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                placeholder.classList.add('d-none');
                resultsContainer.classList.remove('d-none');
                resultsList.innerHTML = '';
                
                data.results.forEach(u => {
                    const col = document.createElement('div');
                    col.className = 'col-md-4 col-sm-6';
                    col.innerHTML = `
                        <div class="tt-user-item">
                            <span>@${u}</span>
                            <span class="tt-copy-hint">Copy</span>
                        </div>
                    `;
                    const item = col.querySelector('.tt-user-item');
                    item.addEventListener('click', () => copyToClipboard(u, item));
                    resultsList.appendChild(col);
                });
            }
        })
        .finally(() => {
            generateBtn.disabled = false;
            generateBtn.innerHTML = '<i class="fab fa-tiktok me-2"></i> Generate Usernames';
        });
    });

    function copyToClipboard(text, element) {
        navigator.clipboard.writeText(text).then(() => {
            const original = element.innerHTML;
            element.classList.add('bg-success', 'text-white');
            element.innerHTML = `<i class="fas fa-check me-2"></i> Copied!`;
            setTimeout(() => {
                element.classList.remove('bg-success', 'text-white');
                element.innerHTML = original;
            }, 1000);
        });
    }
});
</script>
