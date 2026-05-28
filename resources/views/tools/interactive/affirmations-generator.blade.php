<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4 align-items-end">
                <div class="col-md-5">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Category</label>
                    <select id="category" class="form-select form-select-lg rounded-3 shadow-sm">
                        <option value="confidence">💪 Confidence & Power</option>
                        <option value="wealth">💰 Wealth & Abundance</option>
                        <option value="health">🌿 Health & Wellness</option>
                        <option value="love">💖 Love & Relationships</option>
                        <option value="success">🚀 Success & Career</option>
                        <option value="selfcare">🧘 Self-Love & Care</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Quantity</label>
                    <select id="count" class="form-select form-select-lg rounded-3 shadow-sm">
                        <option value="5">5 Affirmations</option>
                        <option value="10" selected>10 Affirmations</option>
                        <option value="15">15 Affirmations</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm transition-all" id="btn-generate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-magic me-2"></i> Generate
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-sparkles text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Your Affirmations</h5>
                        <p class="text-muted small mb-0">Click any affirmation to copy it</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy-all" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy All
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div id="affirmation-list" class="list-group list-group-flush gap-3 border-0">
                {{-- Affirmations will be injected here --}}
            </div>
            
            <div class="mt-4 p-4 rounded-4 bg-light border text-center shadow-sm">
                <p class="mb-0 small text-secondary italic">"Affirmations are a powerful tool for neuroplasticity. Repeat these daily to reshape your cognitive patterns."</p>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --warning-soft: #fffbeb;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }
    .bg-warning-soft { background-color: var(--warning-soft); }

    .tool-card-stacked { border-radius: 24px; background: #fff; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-control-lg, .form-select-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.1rem; padding: 0.75rem 1rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }
    
    .affirmation-item {
        border: 1.5px solid var(--border-color) !important;
        border-radius: 16px !important;
        padding: 1.25rem 1.5rem !important;
        transition: all 0.2s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
    }
    .affirmation-item:hover {
        border-color: var(--primary-color) !important;
        background: var(--primary-soft) !important;
        transform: translateX(5px);
    }
    .affirmation-text {
        font-size: 1.05rem;
        font-weight: 500;
        color: #1e293b;
        margin-bottom: 0;
        line-height: 1.5;
    }
    .copy-hint {
        opacity: 0;
        transition: opacity 0.2s;
        color: var(--primary-color);
        font-size: 0.9rem;
    }
    .affirmation-item:hover .copy-hint {
        opacity: 1;
    }

    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryE = document.getElementById('category');
    const countE = document.getElementById('count');
    const btnGenerate = document.getElementById('btn-generate');
    const resultCard = document.getElementById('result-card');
    const listE = document.getElementById('affirmation-list');

    btnGenerate.addEventListener('click', function() {
        btnGenerate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Manifesting...';
        btnGenerate.disabled = true;

        fetch('{{ route("ai.generate", ["type" => "affirmations"]) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                category: categoryE.value,
                count: countE.value
            })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                listE.innerHTML = '';
                data.results.forEach(text => {
                    const item = document.createElement('div');
                    item.className = 'affirmation-item';
                    item.innerHTML = `
                        <p class="affirmation-text">${text}</p>
                        <span class="copy-hint fw-bold ms-3"><i class="fas fa-copy me-1"></i> Copy</span>
                    `;
                    item.onclick = () => {
                        navigator.clipboard.writeText(text).then(() => {
                            const hint = item.querySelector('.copy-hint');
                            hint.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
                            setTimeout(() => hint.innerHTML = '<i class="fas fa-copy me-1"></i> Copy', 2000);
                        });
                    };
                    listE.appendChild(item);
                });
                
                resultCard.classList.remove('d-none');
                resultCard.scrollIntoView({ behavior: 'smooth' });
            }
        })
        .catch(err => {
            console.error(err);
        })
        .finally(() => {
            btnGenerate.innerHTML = '<i class="fas fa-magic me-2"></i> Generate';
            btnGenerate.disabled = false;
        });
    });

    document.getElementById('btn-copy-all').addEventListener('click', function() {
        const texts = Array.from(document.querySelectorAll('.affirmation-text')).map(p => p.textContent).join('\n');
        navigator.clipboard.writeText(texts).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-1"></i> All Copied!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
