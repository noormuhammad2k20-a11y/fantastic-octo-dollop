<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4">
        <div class="card-header-v2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3">
                        <i class="fas fa-font text-primary"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Input Text</h5>
                        <p class="text-muted small mb-0">Enter text for professional case transformation</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-light-v2 btn-sm" id="btn-clear" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-trash-alt me-1"></i> Clear
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2">
            <textarea id="input-text" class="form-control tool-textarea" rows="8" placeholder="Paste your text here..."></textarea>
            
            <div class="mt-4">
                <label class="form-label small fw-bold text-muted text-uppercase mb-3">Professional Modes</label>
                <div class="row g-2">
                    <div class="col-6 col-md-3"><button class="btn btn-outline-v2 w-100" data-mode="snake">snake_case</button></div>
                    <div class="col-6 col-md-3"><button class="btn btn-outline-v2 w-100" data-mode="kebab">kebab-case</button></div>
                    <div class="col-6 col-md-3"><button class="btn btn-outline-v2 w-100" data-mode="camel">camelCase</button></div>
                    <div class="col-6 col-md-3"><button class="btn btn-outline-v2 w-100" data-mode="pascal">PascalCase</button></div>
                    
                    <div class="col-6 col-md-3"><button class="btn btn-outline-v2 w-100" data-mode="dot">dot.case</button></div>
                    <div class="col-6 col-md-3"><button class="btn btn-outline-v2 w-100" data-mode="path">path/case</button></div>
                    <div class="col-6 col-md-3"><button class="btn btn-outline-v2 w-100" data-mode="constant">CONSTANT_CASE</button></div>
                    <div class="col-6 col-md-3"><button class="btn btn-outline-v2 w-100" data-mode="header">Header-Case</button></div>

                    <div class="col-6 col-md-3"><button class="btn btn-outline-v2 w-100" data-mode="sentence">Sentence case</button></div>
                    <div class="col-6 col-md-3"><button class="btn btn-outline-v2 w-100" data-mode="title">Title Case</button></div>
                    <div class="col-6 col-md-3"><button class="btn btn-outline-v2 w-100" data-mode="upper">UPPERCASE</button></div>
                    <div class="col-6 col-md-3"><button class="btn btn-outline-v2 w-100" data-mode="lower">lowercase</button></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Output Card --}}
    <div class="card tool-card-stacked">
        <div class="card-header-v2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3">
                        <i class="fas fa-magic text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Converted Result</h5>
                        <p class="text-muted small mb-0">Ready for implementation</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-primary-v2 btn-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Result
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2">
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="8" readonly placeholder="Result will appear here..."></textarea>
        </div>
    </div>
</div>

<style>
    .tool-card-stacked { border: 1px solid #edf2f7; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); background: #fff; }
    .card-header-v2 { padding: 1.25rem 1.5rem; background: #fcfcfd; border-bottom: 1px solid #f1f5f9; }
    .card-body-v2 { padding: 1.5rem; }
    .icon-box { width: 40px; height: 40px; border-radius: 10px; background: #f8fafc; display: flex; align-items: center; justify-content: center; }
    .tool-textarea { border: 1px solid #e2e8f0; border-radius: 12px; padding: 1rem; background: #f9fafb; transition: all 0.2s; font-family: 'Inter', sans-serif; }
    .btn-primary-v2 { background: #4f46e5; color: white; border: none; font-weight: 600; padding: 0.5rem 1rem; border-radius: 8px; }
    .btn-outline-v2 { border: 2px solid #f1f5f9; background: #fff; color: #475569; font-weight: 600; border-radius: 10px; padding: 10px; font-size: 0.85rem; transition: all 0.2s; }
    .btn-outline-v2:hover { border-color: #4f46e5; color: #4f46e5; background: #f5f3ff; }
    .btn-outline-v2.active { background: #4f46e5; color: white; border-color: #4f46e5; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const modeButtons = document.querySelectorAll('[data-mode]');
    const btnCopy = document.getElementById('btn-copy');
    const btnClear = document.getElementById('btn-clear');

    function transform(mode) {
        let val = input.value.trim();
        if (!val) return;

        let words = val.split(/[\s_\-\.\/]+/).filter(w => w.length > 0);
        let result = '';

        switch(mode) {
            case 'snake': result = words.map(w => w.toLowerCase()).join('_'); break;
            case 'kebab': result = words.map(w => w.toLowerCase()).join('-'); break;
            case 'dot': result = words.map(w => w.toLowerCase()).join('.'); break;
            case 'path': result = words.map(w => w.toLowerCase()).join('/'); break;
            case 'constant': result = words.map(w => w.toUpperCase()).join('_'); break;
            case 'header': result = words.map(w => w.charAt(0).toUpperCase() + w.slice(1).toLowerCase()).join('-'); break;
            case 'camel':
                result = words.map((w, i) => i === 0 ? w.toLowerCase() : w.charAt(0).toUpperCase() + w.slice(1).toLowerCase()).join('');
                break;
            case 'pascal':
                result = words.map(w => w.charAt(0).toUpperCase() + w.slice(1).toLowerCase()).join('');
                break;
            case 'sentence':
                result = val.charAt(0).toUpperCase() + val.slice(1).toLowerCase();
                break;
            case 'title':
                result = words.map(w => w.charAt(0).toUpperCase() + w.slice(1).toLowerCase()).join(' ');
                break;
            case 'upper': result = val.toUpperCase(); break;
            case 'lower': result = val.toLowerCase(); break;
        }

        output.value = result;
        output.style.borderColor = '#10b981';
        setTimeout(() => output.style.borderColor = '#e2e8f0', 800);
    }

    modeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            modeButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            transform(btn.getAttribute('data-mode'));
        });
    });

    input.addEventListener('input', () => {
        const activeBtn = document.querySelector('[data-mode].active');
        if (activeBtn) transform(activeBtn.getAttribute('data-mode'));
    });

    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        modeButtons.forEach(b => b.classList.remove('active'));
    });

    btnCopy.addEventListener('click', () => {
        if (!output.value) return;
        navigator.clipboard.writeText(output.value);
        const originalText = btnCopy.innerHTML;
        btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        setTimeout(() => btnCopy.innerHTML = originalText, 2000);
    });
});
</script>

