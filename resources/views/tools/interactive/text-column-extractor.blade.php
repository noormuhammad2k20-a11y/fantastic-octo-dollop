<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="input-text" class="form-control tool-textarea" rows="8" placeholder="Paste your data here..."></textarea>
            
            <div class="mt-4 p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                <div class="row g-4">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-secondary">Column Index</label>
                        <input type="number" id="column-index" class="form-control" value="1" min="1">
                        <div class="form-text x-small">1-based index</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-secondary">Delimiter</label>
                        <select id="delimiter" class="form-select">
                            <option value="," selected>Comma (,)</option>
                            <option value="\t">Tab (\t)</option>
                            <option value="|">Pipe (|)</option>
                            <option value=";">Semicolon (;)</option>
                            <option value="space">Space</option>
                            <option value="custom">Custom...</option>
                        </select>
                    </div>
                    <div id="custom-delim-wrapper" class="col-md-3 d-none">
                        <label class="form-label small fw-bold text-secondary">Custom Char</label>
                        <input type="text" id="custom-delimiter" class="form-control" placeholder="Delimiter">
                    </div>
                    <div class="col-md-3 d-flex flex-column justify-content-end">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="skip-header">
                            <label class="form-check-label small fw-semibold" for="skip-header">Skip First Row</label>
                        </div>
                    </div>
                    <div class="col-md-12 text-end">
                        <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-extract" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-filter me-2"></i> Extract Column
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
                        <i class="fas fa-file-export text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Extracted Result</h5>
                        <p class="text-muted small mb-0" id="stats-text">Isolated data column</p>
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
    .x-small { font-size: 0.75rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const btnExtract = document.getElementById('btn-extract');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');
    const btnUndo = document.getElementById('btn-undo');
    
    const colIdxInput = document.getElementById('column-index');
    const delimSelect = document.getElementById('delimiter');
    const customDelimInput = document.getElementById('custom-delimiter');
    const customWrapper = document.getElementById('custom-delim-wrapper');
    const skipHeaderCheck = document.getElementById('skip-header');
    const statsText = document.getElementById('stats-text');

    let history = [];

    delimSelect.addEventListener('change', () => {
        if (delimSelect.value === 'custom') {
            customWrapper.classList.remove('d-none');
        } else {
            customWrapper.classList.add('d-none');
        }
    });

    function extract() {
        const text = input.value;
        if (!text.trim()) return;

        if (output.value) {
            history.push(output.value);
            btnUndo.disabled = false;
        }

        btnExtract.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Extracting...';
        btnExtract.disabled = true;

        setTimeout(() => {
            let delimiter = delimSelect.value;
            if (delimiter === '\\t') delimiter = '\t';
            else if (delimiter === 'space') delimiter = ' ';
            else if (delimiter === 'custom') delimiter = customDelimInput.value || ',';

            const idx = parseInt(colIdxInput.value) - 1;
            let lines = text.split(/\r?\n/);
            
            if (skipHeaderCheck.checked && lines.length > 0) {
                lines.shift();
            }

            const result = lines.map(line => {
                const parts = line.split(delimiter);
                return parts[idx] !== undefined ? parts[idx].trim() : "";
            }).filter(item => item !== "");

            output.value = result.join('\n');
            statsText.textContent = `Extracted: ${result.length} lines | Total Original: ${lines.length + (skipHeaderCheck.checked ? 1 : 0)}`;

            btnExtract.innerHTML = '<i class="fas fa-filter me-2"></i> Extract Column';
            btnExtract.disabled = false;
        }, 300);
    }

    btnExtract.addEventListener('click', extract);

    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        statsText.textContent = 'Isolated data column';
        history = [];
        btnUndo.disabled = true;
    });

    btnSample.addEventListener('click', () => {
        input.value = "ID,Name,Email,City\n1,John Doe,john@example.com,New York\n2,Jane Smith,jane@test.com,London\n3,Bob Johnson,bob@gmail.com,Paris";
        colIdxInput.value = 3;
        delimSelect.value = ",";
        skipHeaderCheck.checked = true;
        extract();
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
        a.download = `extracted-column-${Date.now()}.txt`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    });
});
</script>

