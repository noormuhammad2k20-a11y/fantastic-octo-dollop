<div class="row g-4">
    {{-- Input Card --}}
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label-custom mb-0">Source List (One per line)</label>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light-custom" id="btn-sample" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-vial me-1"></i> Sample
                            </button>
                            <button class="btn btn-sm btn-light-custom" id="btn-clear" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-trash-alt me-1"></i> Clear
                            </button>
                        </div>
                    </div>
                    <textarea id="input-text" class="form-control tool-textarea" rows="8" placeholder="Enter one item per line..."></textarea>
                </div>

                <div class="options-grid p-4 rounded-4" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-4">
                            <label class="form-label-custom">Sort Order</label>
                            <select id="sort-order" class="form-select">
                                <option value="short" selected>Shortest to Longest</option>
                                <option value="long">Longest to Shortest</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-switch mb-0 ms-md-2">
                                <input class="form-check-input" type="checkbox" id="check-unique">
                                <label class="form-check-label small fw-bold" for="check-unique">Remove Duplicates</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm transition-all" id="btn-sort" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-sort-amount-down me-2"></i> Sort by Length
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
                    <i class="fas fa-list-ol fs-4 me-2" style="color:#4f46e5"></i>
                    <h6 class="fw-bold mb-0">Length-Sorted Result</h6>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary btn-sm px-4" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Result
                    </button>
                </div>
            </div>
            
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="8" readonly placeholder="Result will appear here..."></textarea>
            
            <div class="mt-3 p-3 bg-white rounded-3 border d-flex justify-content-between align-items-center small text-secondary">
                <div id="stats-text"><i class="fas fa-info-circle me-1"></i> Ready for sorting</div>
                <div class="badge bg-light text-primary border" id="mode-badge">Logic: Natural Length</div>
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
.form-select { border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 0.75rem 1rem; }
.form-check-input:checked { background-color: #4f46e5; border-color: #4f46e5; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const btnSort = document.getElementById('btn-sort');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    const btnCopy = document.getElementById('btn-copy');
    const sortOrder = document.getElementById('sort-order');
    const checkUnique = document.getElementById('check-unique');
    const statsText = document.getElementById('stats-text');

    function performSort() {
        const text = input.value.trim();
        if (!text) {
            output.value = '';
            statsText.innerHTML = '<i class="fas fa-info-circle me-1"></i> Ready for sorting';
            return;
        }

        btnSort.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Sorting...';
        btnSort.disabled = true;

        setTimeout(() => {
            let lines = text.split(/\r?\n/).filter(l => l.trim().length > 0);
            
            if (checkUnique.checked) {
                lines = [...new Set(lines)];
            }

            lines.sort((a, b) => {
                if (sortOrder.value === 'short') {
                    return a.length - b.length || a.localeCompare(b);
                } else {
                    return b.length - a.length || b.localeCompare(a);
                }
            });

            output.value = lines.join('\n');
            statsText.innerHTML = `<i class="fas fa-check-circle text-success me-1"></i> Sorted <strong>${lines.length}</strong> lines by length successfully.`;
            
            btnSort.innerHTML = '<i class="fas fa-sort-amount-down me-2"></i> Sort by Length';
            btnSort.disabled = false;
            
            output.classList.add('border-primary');
            setTimeout(() => output.classList.remove('border-primary'), 500);
        }, 300);
    }

    btnSort.addEventListener('click', performSort);

    btnClear.addEventListener('click', () => { 
        input.value = ''; 
        output.value = ''; 
        statsText.innerHTML = '<i class="fas fa-info-circle me-1"></i> Ready for sorting';
    });

    btnSample.addEventListener('click', () => {
        input.value = "Short line\nThis is a much longer line than the first one\nMedium length line here\nTiny\nMassive extra long line of text for testing purposes";
        performSort();
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
});
</script>

