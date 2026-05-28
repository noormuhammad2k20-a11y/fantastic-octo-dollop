<div class="row g-4">
    {{-- Input Card --}}
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label-custom mb-0">Original Content</label>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light-custom" id="btn-sample" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-vial me-1"></i> Sample
                            </button>
                            <button class="btn btn-sm btn-light-custom" id="btn-clear" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-trash-alt me-1"></i> Clear
                            </button>
                        </div>
                    </div>
                    <textarea id="input-text" class="form-control tool-textarea" rows="10" placeholder="Type or paste your text here..."></textarea>
                </div>

                <div class="options-grid p-4 rounded-4" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <label class="form-label-custom mb-3">Transformation Mode</label>
                    <div class="row g-3">
                        <div class="col-6 col-md-4 col-lg-2"><button class="btn btn-mode w-100" data-mode="chars"><i class="fas fa-font me-1"></i> Characters</button></div>
                        <div class="col-6 col-md-4 col-lg-2"><button class="btn btn-mode w-100" data-mode="words"><i class="fas fa-italic me-1"></i> Words</button></div>
                        <div class="col-6 col-md-4 col-lg-2"><button class="btn btn-mode w-100" data-mode="lines"><i class="fas fa-align-left me-1"></i> Lines</button></div>
                        <div class="col-6 col-md-4 col-lg-3"><button class="btn btn-mode w-100" data-mode="words-line"><i class="fas fa-stream me-1"></i> Words per Line</button></div>
                        <div class="col-6 col-md-4 col-lg-3"><button class="btn btn-mode w-100" data-mode="chars-line"><i class="fas fa-text-width me-1"></i> Chars per Line</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,0.04);">
            <div class="output-header d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exchange-alt fs-4 me-2" style="color:#4f46e5"></i>
                    <h6 class="fw-bold mb-0">Transformed Result</h6>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-light-custom" id="btn-undo" disabled>
                        <i class="fas fa-undo"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-primary" id="btn-download" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download me-1"></i> Download
                    </button>
                    <button class="btn btn-primary btn-sm px-4" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy
                    </button>
                </div>
            </div>
            
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="10" readonly placeholder="Result will appear here..."></textarea>
            
            <div class="mt-3 p-3 bg-white rounded-3 border d-flex justify-content-between align-items-center small text-secondary">
                <div id="stats-text"><i class="fas fa-info-circle me-1"></i> Waiting for input</div>
                <div class="badge bg-light text-primary border" id="mode-badge">Inert</div>
            </div>
        </div>
    </div>
</div>

<style>
.calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2rem; }
.calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2rem; }
.calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.02em; }
.calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; flex-shrink: 0; }
.form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; display: block; }
.tool-textarea { border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 1.25rem; font-family: 'Inter', sans-serif; font-size: 1rem; transition: all 0.2s; }
.tool-textarea:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79,70,229,0.1); outline: none; }
.btn-light-custom { background: #f1f5f9; border: none; color: #475569; font-weight: 600; border-radius: 10px; }
.btn-light-custom:hover { background: #e2e8f0; color: #1e293b; }
.output-card-themed { background: var(--tool-bg); border: 1px solid rgba(79,70,229,0.1); border-radius: 24px; padding: 2rem; }
.btn-mode { background: #fff; border: 1.5px solid #e2e8f0; color: #475569; font-weight: 600; font-size: 0.85rem; padding: 0.75rem 0.5rem; border-radius: 12px; transition: all 0.2s; }
.btn-mode:hover { border-color: #4f46e5; color: #4f46e5; background: #f8fafc; }
.btn-mode.active { background: #4f46e5; color: #fff; border-color: #4f46e5; box-shadow: 0 4px 12px rgba(79,70,229,0.2); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
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
            document.getElementById('mode-badge').textContent = 'Inert';
            return;
        }

        if (output.value && mode !== currentMode) {
            history.push(output.value);
            btnUndo.disabled = false;
        }
        currentMode = mode;
        document.getElementById('mode-badge').textContent = mode.toUpperCase();

        let res = '';
        switch(mode) {
            case 'chars': res = val.split('').reverse().join(''); break;
            case 'words': res = val.split(/\s+/).reverse().join(' '); break;
            case 'lines': res = val.split(/\r?\n/).reverse().join('\n'); break;
            case 'words-line': res = val.split(/\r?\n/).map(line => line.split(/\s+/).reverse().join(' ')).join('\n'); break;
            case 'chars-line': res = val.split(/\r?\n/).map(line => line.split('').reverse().join('')).join('\n'); break;
        }

        output.value = res;
        statsText.innerHTML = `<i class="fas fa-check-circle text-success me-1"></i> Transformation: <strong>${mode}</strong> | Length: <strong>${res.length}</strong>`;
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
        statsText.innerHTML = '<i class="fas fa-info-circle me-1"></i> Waiting for input';
        document.getElementById('mode-badge').textContent = 'Inert';
        modeButtons.forEach(b => b.classList.remove('active'));
        history = [];
        btnUndo.disabled = true;
    });

    btnSample.addEventListener('click', () => {
        input.value = "The quick brown fox\njumps over\nthe lazy dog";
        const firstMode = document.querySelector('[data-mode="chars"]');
        firstMode.click();
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
        const btn = btnCopy;
        const old = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        btn.classList.replace('btn-primary', 'btn-dark');
        setTimeout(() => {
            btn.innerHTML = old;
            btn.classList.replace('btn-dark', 'btn-primary');
        }, 2000);
    });

    btnDownload.addEventListener('click', () => {
        if (!output.value) return;
        const blob = new Blob([output.value], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `reversed-text-${Date.now()}.txt`;
        a.click();
        URL.revokeObjectURL(url);
    });
});
</script>

