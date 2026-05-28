<div class="tool-interactive-container">
    <div class="card border-0 shadow-sm p-4 mb-4 bg-white rounded-4">
        <div class="row g-3 align-items-end mb-4">
            <div class="col-md-5">
                <label class="form-label fw-bold small text-uppercase text-muted">Your Name / Keyword</label>
                <input type="text" id="bio-name" class="form-control border-2" placeholder="e.g. John Doe / Fitness Coach">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold small text-uppercase text-muted">Style</label>
                <select id="bio-category" class="form-select border-2">
                    <option value="aesthetic">Aesthetic & Chill</option>
                    <option value="business">Professional Business</option>
                    <option value="funny">Funny & Witty</option>
                    <option value="cool">Cool & Stylish</option>
                </select>
            </div>
            <div class="col-md-4">
                <button id="bio-generate-btn" class="btn btn-accent px-4 py-2 w-100 fw-bold rounded-3">
                    <i class="fab fa-instagram me-2"></i> Generate Bios
                </button>
            </div>
        </div>

        <div id="bio-results-container" class="d-none">
            <h5 class="fw-bold mb-3">Suggested Bios</h5>
            <div id="bio-results-list" class="row g-3">
                <!-- Result items will be injected here -->
            </div>
        </div>

        <div id="bio-placeholder" class="text-center py-5">
            <div class="opacity-25 mb-3"><i class="fab fa-instagram fa-4x text-accent"></i></div>
            <h5 class="text-muted">Enter your name or category to get started</h5>
        </div>
    </div>
</div>

<style>
    .btn-accent { background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); color: white; border: none; transition: 0.3s; }
    .btn-accent:hover { opacity: 0.9; transform: translateY(-1px); }
    .bio-card { border: 2px solid #f8f9fa; border-radius: 15px; padding: 20px; transition: 0.3s; cursor: pointer; white-space: pre-wrap; font-size: 0.9rem; position: relative; }
    .bio-card:hover { border-color: #dc2743; background: #fff5f5; }
    .copy-overlay { position: absolute; top: 10px; right: 10px; opacity: 0; transition: 0.2s; }
    .bio-card:hover .copy-overlay { opacity: 1; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const generateBtn = document.getElementById('bio-generate-btn');
    const nameInput = document.getElementById('bio-name');
    const categorySelect = document.getElementById('bio-category');
    const resultsContainer = document.getElementById('bio-results-container');
    const resultsList = document.getElementById('bio-results-list');
    const placeholder = document.getElementById('bio-placeholder');

    generateBtn.addEventListener('click', function() {
        const name = nameInput.value.trim();
        if (!name) return alert('Please enter a name or keyword');

        generateBtn.disabled = true;
        generateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Generating...';

        fetch('{{ route('social.generate', ['type' => 'instagram-bio']) }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ name: name, category: categorySelect.value })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                placeholder.classList.add('d-none');
                resultsContainer.classList.remove('d-none');
                resultsList.innerHTML = '';
                
                data.results.forEach(bio => {
                    const col = document.createElement('div');
                    col.className = 'col-md-6';
                    col.innerHTML = `
                        <div class="bio-card bg-light h-100">
                            <i class="fas fa-copy text-danger copy-overlay"></i>
                            <div>${bio}</div>
                        </div>
                    `;
                    const card = col.querySelector('.bio-card');
                    card.addEventListener('click', () => copyToClipboard(bio, card));
                    resultsList.appendChild(col);
                });
            }
        })
        .finally(() => {
            generateBtn.disabled = false;
            generateBtn.innerHTML = '<i class="fab fa-instagram me-2"></i> Generate Bios';
        });
    });

    function copyToClipboard(text, element) {
        navigator.clipboard.writeText(text).then(() => {
            const original = element.innerHTML;
            element.innerHTML = `<div class="text-center py-4"><span class="text-success fw-bold"><i class="fas fa-check me-2"></i> Copied!</span></div>`;
            setTimeout(() => element.innerHTML = original, 1500);
        });
    }
});
</script>
