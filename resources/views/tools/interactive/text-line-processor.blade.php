<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="input-text" class="form-control tool-textarea" rows="8" placeholder="Enter lines here..."></textarea>
            
            <div class="mt-4 p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                <div class="row g-4">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-secondary">Add Prefix</label>
                        <input type="text" id="prefix" class="form-control" placeholder="e.g. - ">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-secondary">Add Suffix</label>
                        <input type="text" id="suffix" class="form-control" placeholder="e.g. ,">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-secondary">Line Numbering</label>
                        <select id="numbering" class="form-select">
                            <option value="none">None</option>
                            <option value="1. ">1. </option>
                            <option value="(1) ">(1) </option>
                            <option value="[1] ">[1] </option>
                            <option value="1) ">1) </option>
                            <option value="custom">Custom...</option>
                        </select>
                    </div>
                    <div id="custom-num-wrapper" class="col-md-3 d-none">
                        <label class="form-label small fw-bold text-secondary">Pattern (use %n)</label>
                        <input type="text" id="custom-num-pattern" class="form-control" placeholder="%n: ">
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap gap-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check-trim">
                                <label class="form-check-label small fw-semibold" for="check-trim">Trim Lines</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check-empty">
                                <label class="form-check-label small fw-semibold" for="check-empty">Remove Empty</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check-reverse">
                                <label class="form-check-label small fw-semibold" for="check-reverse">Reverse Content</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-secondary">Line Action</label>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary w-100" id="btn-sort" style="min-width: 280px; max-width: 100%;">Sort A-Z</button>
                            <button class="btn btn-outline-secondary w-100" id="btn-shuffle" style="min-width: 280px; max-width: 100%;">Shuffle</button>
                        </div>
                    </div>

                    <div class="col-md-6 d-flex align-items-end">
                        <button class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm transition-all" id="btn-process" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-sync me-2"></i> Process Lines
                        </button>
                    </div>
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
                        <i class="fas fa-check-double text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Processed Result</h5>
                        <p class="text-muted small mb-0" id="stats-text">Formatted and ready for use</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" id="btn-undo" disabled>
                        <i class="fas fa-undo me-1"></i> Undo
                    </button>
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3" id="btn-download" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download me-1"></i> Download
                    </button>
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Result
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="8" readonly placeholder="Result will appear here..."></textarea>
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

    .btn-light-custom { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-custom:hover { background: #e2e8f0; color: #1e293b; }

    .transition-all { transition: all 0.2s ease; }
    
    .form-check-input:checked { background-color: var(--primary-color); border-color: var(--primary-color); }

    .form-control, .form-select { border: 1.5px solid var(--border-color); border-radius: 10px; padding: 0.625rem 0.75rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const btnProcess = document.getElementById('btn-process');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');
    const btnUndo = document.getElementById('btn-undo');
    const btnSort = document.getElementById('btn-sort');
    const btnShuffle = document.getElementById('btn-shuffle');
    
    const prefixInput = document.getElementById('prefix');
    const suffixInput = document.getElementById('suffix');
    const numberingSelect = document.getElementById('numbering');
    const customNumWrapper = document.getElementById('custom-num-wrapper');
    const customNumPattern = document.getElementById('custom-num-pattern');
    const checkTrim = document.getElementById('check-trim');
    const checkEmpty = document.getElementById('check-empty');
    const checkReverse = document.getElementById('check-reverse');
    const statsText = document.getElementById('stats-text');

    let history = [];

    numberingSelect.addEventListener('change', () => {
        if (numberingSelect.value === 'custom') customNumWrapper.classList.remove('d-none');
        else customNumWrapper.classList.add('d-none');
    });

    function processLines(manualLines = null) {
        const text = input.value;
        if (!text.trim() && !manualLines) return;

        if (output.value) {
            history.push(output.value);
            btnUndo.disabled = false;
        }

        btnProcess.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing...';
        btnProcess.disabled = true;

        setTimeout(() => {
            let lines = manualLines || text.split(/\r?\n/);
            const pVal = prefixInput.value;
            const sVal = suffixInput.value;
            const nMode = numberingSelect.value;

            if (checkTrim.checked) lines = lines.map(l => l.trim());
            if (checkEmpty.checked) lines = lines.filter(l => l.length > 0);
            if (checkReverse.checked) lines = lines.map(l => l.split('').reverse().join(''));

            const result = lines.map((line, i) => {
                let numStr = "";
                if (nMode === 'custom') {
                    numStr = customNumPattern.value.replace('%n', (i + 1));
                } else if (nMode !== 'none') {
                    numStr = nMode.replace('1', (i + 1));
                }
                return `${numStr}${pVal}${line}${sVal}`;
            });

            output.value = result.join('\n');
            statsText.textContent = `Lines: ${result.length} | Characters: ${output.value.length}`;

            btnProcess.innerHTML = '<i class="fas fa-sync me-2"></i> Process Lines';
            btnProcess.disabled = false;
        }, 300);
    }

    btnProcess.addEventListener('click', () => processLines());

    btnSort.addEventListener('click', () => {
        let lines = (output.value || input.value).split(/\r?\n/);
        lines.sort((a, b) => a.localeCompare(b));
        processLines(lines);
    });

    btnShuffle.addEventListener('click', () => {
        let lines = (output.value || input.value).split(/\r?\n/);
        for (let i = lines.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [lines[i], lines[j]] = [lines[j], lines[i]];
        }
        processLines(lines);
    });

    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        statsText.textContent = 'Formatted and ready for use';
        history = [];
        btnUndo.disabled = true;
    });

    btnSample.addEventListener('click', () => {
        input.value = "Apple\nBanana\nCherry\nDate\nEggplant";
        prefixInput.value = "Item: ";
        suffixInput.value = " (Fresh)";
        numberingSelect.value = "1. ";
        processLines();
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
        a.download = `processed-lines-${Date.now()}.txt`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    });
});
</script>

