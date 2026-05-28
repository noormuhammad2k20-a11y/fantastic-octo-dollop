<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="input-text" class="form-control tool-textarea" rows="8" placeholder="Paste your text here..."></textarea>
            
            <div class="mt-4">
                <label class="form-label small fw-bold text-secondary text-uppercase mb-3">Conversion Modes</label>
                <div class="row g-3">
                    <div class="col-6 col-md-3 col-lg-2"><button class="btn btn-mode w-100" data-mode="upper">UPPERCASE</button></div>
                    <div class="col-6 col-md-3 col-lg-2"><button class="btn btn-mode w-100" data-mode="lower">lowercase</button></div>
                    <div class="col-6 col-md-3 col-lg-2"><button class="btn btn-mode w-100" data-mode="title">Title Case</button></div>
                    <div class="col-6 col-md-3 col-lg-2"><button class="btn btn-mode w-100" data-mode="sentence">Sentence case</button></div>
                    <div class="col-6 col-md-3 col-lg-2"><button class="btn btn-mode w-100" data-mode="capitalize">Capitalize</button></div>
                    <div class="col-6 col-md-3 col-lg-2"><button class="btn btn-mode w-100" data-mode="inverse">iNVERSE cASE</button></div>
                    
                    <div class="col-6 col-md-3 col-lg-2"><button class="btn btn-mode w-100" data-mode="camel">camelCase</button></div>
                    <div class="col-6 col-md-3 col-lg-2"><button class="btn btn-mode w-100" data-mode="pascal">PascalCase</button></div>
                    <div class="col-6 col-md-3 col-lg-2"><button class="btn btn-mode w-100" data-mode="snake">snake_case</button></div>
                    <div class="col-6 col-md-3 col-lg-2"><button class="btn btn-mode w-100" data-mode="kebab">kebab-case</button></div>
                    <div class="col-6 col-md-3 col-lg-2"><button class="btn btn-mode w-100" data-mode="constant">CONSTANT_CASE</button></div>
                    <div class="col-6 col-md-3 col-lg-2"><button class="btn btn-mode w-100" data-mode="alternating">aLtErNaTiNg</button></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-magic text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Transformed Result</h5>
                        <p class="text-muted small mb-0" id="stats-text">Converted and ready</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" id="btn-undo" disabled>
                        <i class="fas fa-undo me-1"></i> Undo
                    </button>
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3" id="btn-download" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download me-1"></i> Download
                    </button>
                    <button class="btn btn-success btn-sm rounded-pill px-4" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="8" readonly placeholder="Your transformed text will appear here..."></textarea>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }

    .tool-card-stacked { border-radius: 20px; background: #fff; }

    .icon-box { 
        width: 48px; 
        height: 48px; 
        border-radius: 14px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 1.25rem;
    }

    .tool-textarea { 
        border: 1.5px solid var(--border-color); 
        border-radius: 16px; 
        padding: 1.25rem; 
        background: #fff; 
        transition: all 0.3s ease; 
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        line-height: 1.6;
    }

    .tool-textarea:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .btn-mode { 
        background: #fff; 
        border: 1.5px solid var(--border-color); 
        color: #475569; 
        font-weight: 600; 
        font-size: 0.8rem; 
        padding: 0.75rem 0.5rem; 
        border-radius: 12px; 
        transition: all 0.2s ease;
    }
    .btn-mode:hover { border-color: var(--primary-color); color: var(--primary-color); background: var(--primary-soft); }
    .btn-mode.active { background: var(--primary-color); color: #fff; border-color: var(--primary-color); box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3); }

    .transition-all { transition: all 0.2s ease; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const btnClear = document.getElementById('btn-clear');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');
    const btnUndo = document.getElementById('btn-undo');
    const modeButtons = document.querySelectorAll('[data-mode]');
    const statsText = document.getElementById('stats-text');

    let history = [];
    let currentMode = null;

    function transform(mode) {
        const val = input.value;
        if (!val) {
            output.value = '';
            return;
        }

        if (output.value && mode !== currentMode) {
            history.push(output.value);
            btnUndo.disabled = false;
        }
        currentMode = mode;

        let result = '';
        const words = val.trim().split(/[\s_-]+/);

        switch(mode) {
            case 'upper': result = val.toUpperCase(); break;
            case 'lower': result = val.toLowerCase(); break;
            case 'title': 
                result = val.toLowerCase().replace(/\b\w/g, l => l.toUpperCase());
                break;
            case 'sentence':
                result = val.toLowerCase().replace(/(^\s*\w|[.!?]\s*\w)/g, c => c.toUpperCase());
                break;
            case 'capitalize':
                result = val.split('\n').map(line => line.charAt(0).toUpperCase() + line.slice(1)).join('\n');
                break;
            case 'inverse':
                result = val.split('').map(c => c === c.toUpperCase() ? c.toLowerCase() : c.toUpperCase()).join('');
                break;
            case 'camel':
                result = words.map((w, i) => i === 0 ? w.toLowerCase() : w.charAt(0).toUpperCase() + w.slice(1).toLowerCase()).join('');
                break;
            case 'pascal':
                result = words.map(w => w.charAt(0).toUpperCase() + w.slice(1).toLowerCase()).join('');
                break;
            case 'snake':
                result = words.map(w => w.toLowerCase()).join('_');
                break;
            case 'kebab':
                result = words.map(w => w.toLowerCase()).join('-');
                break;
            case 'constant':
                result = words.map(w => w.toUpperCase()).join('_');
                break;
            case 'alternating':
                result = val.split('').map((c, i) => i % 2 === 0 ? c.toLowerCase() : c.toUpperCase()).join('');
                break;
        }
        output.value = result;
        
        const chars = result.length;
        const wordCount = result.trim() ? result.trim().split(/\s+/).length : 0;
        statsText.textContent = `Words: ${wordCount} | Characters: ${chars}`;
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
        statsText.textContent = 'Converted and ready';
        modeButtons.forEach(b => b.classList.remove('active'));
        history = [];
        btnUndo.disabled = true;
        currentMode = null;
    });

    btnUndo.addEventListener('click', () => {
        if (history.length > 0) {
            output.value = history.pop();
            if (history.length === 0) btnUndo.disabled = true;
        }
    });

    btnCopy.addEventListener('click', () => {
        if (!output.value) return;
        navigator.clipboard.writeText(output.value);
        const originalText = btnCopy.innerHTML;
        btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        btnCopy.classList.replace('btn-success', 'btn-dark');
        setTimeout(() => {
            btnCopy.innerHTML = originalText;
            btnCopy.classList.replace('btn-dark', 'btn-success');
        }, 2000);
    });

    btnDownload.addEventListener('click', () => {
        if (!output.value) return;
        const blob = new Blob([output.value], { type: 'text/plain' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `case-converted-${Date.now()}.txt`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    });
});
</script>

