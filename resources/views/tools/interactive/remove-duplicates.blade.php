<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="input-text" class="form-control tool-textarea" rows="10" placeholder="Paste your list here..."></textarea>
            
            <div class="mt-4 p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <h6 class="fw-bold text-dark mb-3">Cleaning Options</h6>
                        <div class="d-flex flex-wrap gap-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check-case" checked>
                                <label class="form-check-label small fw-semibold" for="check-case">Case Sensitive</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check-trim" checked>
                                <label class="form-check-label small fw-semibold" for="check-trim">Trim Lines</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check-empty" checked>
                                <label class="form-check-label small fw-semibold" for="check-empty">Remove Empty</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-secondary">Sort Result</label>
                        <select id="sort-select" class="form-select">
                            <option value="none" selected>Original Order</option>
                            <option value="asc">A to Z</option>
                            <option value="desc">Z to A</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6 d-flex align-items-end">
                        <button class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm transition-all" id="btn-process" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-filter me-2"></i> Remove Duplicates
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Output Card --}}
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Clean Result</h5>
                        <p class="text-muted small mb-0" id="stats-text">Redundancy removed</p>
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
                        <i class="fas fa-copy me-1"></i> Copy List
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="10" readonly placeholder="Result will appear here..."></textarea>
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
    
    const checkCase = document.getElementById('check-case');
    const checkTrim = document.getElementById('check-trim');
    const checkEmpty = document.getElementById('check-empty');
    const sortSelect = document.getElementById('sort-select');
    const statsText = document.getElementById('stats-text');

    let history = [];

    function process() {
        const text = input.value;
        if (!text.trim()) return;

        if (output.value) {
            history.push(output.value);
            btnUndo.disabled = false;
        }

        btnProcess.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Removing...';
        btnProcess.disabled = true;

        setTimeout(() => {
            let lines = text.split(/\r?\n/);
            const originalCount = lines.length;

            if (checkTrim.checked) lines = lines.map(l => l.trim());
            if (checkEmpty.checked) lines = lines.filter(l => l.length > 0);

            let uniqueLines = [];
            let seen = new Set();

            lines.forEach(line => {
                let key = checkCase.checked ? line : line.toLowerCase();
                if (!seen.has(key)) {
                    seen.add(key);
                    uniqueLines.push(line);
                }
            });

            if (sortSelect.value === 'asc') {
                uniqueLines.sort((a, b) => a.localeCompare(b));
            } else if (sortSelect.value === 'desc') {
                uniqueLines.sort((a, b) => b.localeCompare(a));
            }

            output.value = uniqueLines.join('\n');
            
            const removed = originalCount - uniqueLines.length;
            statsText.textContent = `Original: ${originalCount} | Final: ${uniqueLines.length} | Removed: ${removed}`;

            btnProcess.innerHTML = '<i class="fas fa-filter me-2"></i> Remove Duplicates';
            btnProcess.disabled = false;
        }, 400);
    }

    btnProcess.addEventListener('click', process);

    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        statsText.textContent = 'Redundancy removed';
        history = [];
        btnUndo.disabled = true;
    });

    btnSample.addEventListener('click', () => {
        input.value = "Apple\nBanana\napple\nCherry\nBanana\n\nDate\nApple\n   Eggplant   ";
        process();
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
        a.download = `clean-list-${Date.now()}.txt`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    });
});
</script>

