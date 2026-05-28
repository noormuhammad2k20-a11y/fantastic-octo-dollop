<div class="row g-4">
    {{-- Input Card --}}
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label-custom mb-0">Text to Repeat</label>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light-custom" id="btn-sample" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-vial me-1"></i> Sample
                            </button>
                            <button class="btn btn-sm btn-light-custom" id="btn-clear" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-trash-alt me-1"></i> Clear
                            </button>
                        </div>
                    </div>
                    <textarea id="input-text" class="form-control tool-textarea" rows="4" placeholder="Type something to repeat..."></textarea>
                </div>

                <div class="options-grid p-4 rounded-4" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label-custom">Repeat Count</label>
                            <input type="number" id="repeat-count" class="form-control" value="10" min="1" max="100000">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Separator</label>
                            <select id="separator" class="form-select">
                                <option value="\n" selected>Newline</option>
                                <option value=" ">Space</option>
                                <option value=", ">Comma</option>
                                <option value="">None</option>
                                <option value="custom">Custom...</option>
                            </select>
                        </div>
                        <div id="custom-sep-wrapper" class="col-md-3 d-none">
                            <label class="form-label-custom">Custom Separator</label>
                            <input type="text" id="custom-separator" class="form-control" placeholder="e.g. ---">
                        </div>
                        <div class="col-md-3 d-flex flex-column justify-content-end">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="add-numbers">
                                <label class="form-check-label small fw-bold" for="add-numbers">Add Line Numbers</label>
                            </div>
                        </div>
                        <div class="col-12 text-end">
                            <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-generate" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-copy me-2"></i> Generate Repetitions
                            </button>
                        </div>
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
                    <i class="fas fa-layer-group fs-4 me-2" style="color:#4f46e5"></i>
                    <h6 class="fw-bold mb-0">Generated Output</h6>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary" id="btn-undo" disabled>
                        <i class="fas fa-undo me-1"></i> Undo
                    </button>
                    <button class="btn btn-sm btn-outline-primary" id="btn-download" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download me-1"></i> Download
                    </button>
                    <button class="btn btn-primary btn-sm px-4" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Result
                    </button>
                </div>
            </div>
            
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="10" readonly placeholder="Repeated text will appear here..."></textarea>
            
            <div class="mt-3 p-3 bg-white rounded-3 border d-flex justify-content-between align-items-center small text-secondary">
                <div id="stats-text"><i class="fas fa-info-circle me-1"></i> Ready to generate</div>
                <div class="badge bg-light text-primary border" id="limit-badge">Limit: 100k</div>
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
.form-control, .form-select { border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 0.75rem 1rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const btnGenerate = document.getElementById('btn-generate');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');
    const btnUndo = document.getElementById('btn-undo');
    
    const countInput = document.getElementById('repeat-count');
    const sepSelect = document.getElementById('separator');
    const customSepInput = document.getElementById('custom-separator');
    const customWrapper = document.getElementById('custom-sep-wrapper');
    const addNumbersCheck = document.getElementById('add-numbers');
    const statsText = document.getElementById('stats-text');

    let history = [];

    sepSelect.addEventListener('change', () => {
        if (sepSelect.value === 'custom') customWrapper.classList.remove('d-none');
        else customWrapper.classList.add('d-none');
    });

    btnGenerate.addEventListener('click', () => {
        const text = input.value;
        const count = parseInt(countInput.value);
        if (!text || isNaN(count) || count < 1) return;

        if (output.value) {
            history.push(output.value);
            btnUndo.disabled = false;
        }

        btnGenerate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Generating...';
        btnGenerate.disabled = true;

        setTimeout(() => {
            let sep = sepSelect.value;
            if (sep === '\\n') sep = '\n';
            else if (sep === 'custom') sep = customSepInput.value || '';

            let result = "";
            const addNumbers = addNumbersCheck.checked;

            if (addNumbers) {
                let items = [];
                for (let i = 1; i <= count; i++) {
                    items.push(`${i}. ${text}`);
                }
                result = items.join(sep);
            } else {
                result = Array(count).fill(text).join(sep);
            }

            output.value = result;
            statsText.innerHTML = `<i class="fas fa-check-circle text-success me-1"></i> Generated <strong>${count}</strong> repetitions. Length: <strong>${result.length}</strong> chars.`;

            btnGenerate.innerHTML = '<i class="fas fa-copy me-2"></i> Generate Repetitions';
            btnGenerate.disabled = false;
            
            output.classList.add('border-primary');
            setTimeout(() => output.classList.remove('border-primary'), 500);
        }, 300);
    });

    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        statsText.innerHTML = '<i class="fas fa-info-circle me-1"></i> Ready to generate';
        history = [];
        btnUndo.disabled = true;
    });

    btnSample.addEventListener('click', () => {
        input.value = "I love ToolsHub!";
        countInput.value = 5;
        sepSelect.value = "\\n";
        btnGenerate.click();
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
        a.download = `repeated-${Date.now()}.txt`;
        a.click();
        URL.revokeObjectURL(url);
    });
});
</script>

