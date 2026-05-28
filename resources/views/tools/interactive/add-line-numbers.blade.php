<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="input-text" class="form-control tool-textarea mb-4" rows="10" placeholder="Paste your lines here..."></textarea>
            
            <div class="p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                <div class="row g-4 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Starting Number</label>
                        <input type="number" id="start-num" class="form-control form-control-lg rounded-3" value="1" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Padding Style</label>
                        <select id="pad-style" class="form-select form-select-lg rounded-3">
                            <option value="none">No Padding (1, 2, 10)</option>
                            <option value="zero" selected>Zero Padding (01, 02, 10)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm transition-all" id="btn-process" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-plus-circle me-2"></i> Add Numbers
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
                        <i class="fas fa-sort-numeric-down text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Numbered Output</h5>
                        <p class="text-muted small mb-0" id="stats-text">Indexed and formatted text</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Result
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <textarea id="output-text" class="form-control tool-textarea bg-white font-monospace" rows="12" readonly placeholder="Result will appear here..."></textarea>
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
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .tool-textarea { 
        border: 1.5px solid var(--border-color); border-radius: 16px; 
        padding: 1.25rem; background: #fff; transition: all 0.3s ease; 
        font-family: 'Inter', sans-serif; font-size: 1rem; line-height: 1.6;
    }
    .tool-textarea:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-control-lg, .form-select-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }

    .transition-all { transition: all 0.2s ease; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const startNumInput = document.getElementById('start-num');
    const padStyleInput = document.getElementById('pad-style');
    const btnProcess = document.getElementById('btn-process');
    const btnCopy = document.getElementById('btn-copy');
    const btnClear = document.getElementById('btn-clear');
    const statsText = document.getElementById('stats-text');

    btnProcess.addEventListener('click', () => {
        const text = input.value;
        if (!text) return;

        btnProcess.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing...';
        btnProcess.disabled = true;

        setTimeout(() => {
            const lines = text.split(/\r?\n/);
            const startNum = parseInt(startNumInput.value) || 1;
            const padSize = (startNum + lines.length - 1).toString().length;
            
            const formatted = lines.map((line, i) => {
                let numStr = (startNum + i).toString();
                if (padStyleInput.value === 'zero') {
                    numStr = numStr.padStart(padSize, '0');
                }
                return `${numStr}. ${line}`;
            }).join('\n');
            
            output.value = formatted;
            statsText.textContent = `Numbered ${lines.length} lines successfully`;
            
            btnProcess.innerHTML = '<i class="fas fa-plus-circle me-2"></i> Add Numbers';
            btnProcess.disabled = false;
            
            output.scrollIntoView({ behavior: 'smooth' });
        }, 300);
    });

    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        statsText.textContent = 'Indexed and formatted text';
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

