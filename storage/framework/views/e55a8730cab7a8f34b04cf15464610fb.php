<div class="row g-4">
    
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label-custom mb-0">List Items (One per line)</label>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light-custom" id="btn-sample">
                                <i class="fas fa-vial me-1"></i> Sample
                            </button>
                            <button class="btn btn-sm btn-light-custom" id="btn-clear">
                                <i class="fas fa-trash-alt me-1"></i> Clear
                            </button>
                        </div>
                    </div>
                    <textarea id="input-text" class="form-control tool-textarea" rows="8" placeholder="e.g.&#10;user_1&#10;user_2&#10;user_3"></textarea>
                </div>

                <div class="options-grid p-4 rounded-4" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <div class="row g-4 align-items-end">
                        <div class="col-md-8">
                            <label class="form-label-custom">Quote Character & Type</label>
                            <select id="quote-type" class="form-select">
                                <option value="'">Single Quote (') - Recommended for strings</option>
                                <option value="&quot;">Double Quote (")</option>
                                <option value="none">None - For numbers</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm transition-all" id="btn-convert">
                                <i class="fas fa-magic me-2"></i> Convert to SQL
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,0.04);">
            <div class="output-header d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-code fs-4 me-2" style="color:#4f46e5"></i>
                    <h6 class="fw-bold mb-0">SQL Result Clause</h6>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary btn-sm px-4" id="btn-copy">
                        <i class="fas fa-copy me-1"></i> Copy Clause
                    </button>
                </div>
            </div>
            
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="6" readonly placeholder="Your SQL list will appear here..."></textarea>
            
            <div class="mt-3 p-3 bg-white rounded-3 border d-flex justify-content-between align-items-center small text-secondary">
                <div id="stats-text"><i class="fas fa-info-circle me-1"></i> Ready for conversion</div>
                <div class="badge bg-light text-primary border" id="mode-badge">IN Clause Mode</div>
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
.tool-textarea { border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 1.25rem; font-family: 'Fira Code', monospace; font-size: 0.95rem; transition: all 0.2s; }
.tool-textarea:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79,70,229,0.1); outline: none; }
.btn-light-custom { background: #f1f5f9; border: none; color: #475569; font-weight: 600; border-radius: 10px; }
.btn-light-custom:hover { background: #e2e8f0; color: #1e293b; }
.output-card-themed { background: var(--tool-bg); border: 1px solid rgba(79,70,229,0.1); border-radius: 24px; padding: 2rem; }
.form-select { border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 0.75rem 1rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const btnConvert = document.getElementById('btn-convert');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    const btnCopy = document.getElementById('btn-copy');
    const quoteSelect = document.getElementById('quote-type');
    const statsText = document.getElementById('stats-text');

    function convert() {
        const text = input.value.trim();
        if (!text) {
            output.value = '';
            statsText.innerHTML = '<i class="fas fa-info-circle me-1"></i> Ready for conversion';
            return;
        }

        btnConvert.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing...';
        btnConvert.disabled = true;

        setTimeout(() => {
            const items = text.split(/\r?\n/).map(i => i.trim()).filter(i => i.length > 0);
            const q = quoteSelect.value === 'none' ? '' : quoteSelect.value;
            
            const result = items.map(i => {
                const escaped = i.replace(new RegExp(q, 'g'), q + q);
                return q + escaped + q;
            }).join(', ');

            output.value = `IN (${result})`;
            statsText.innerHTML = `<i class="fas fa-check-circle text-success me-1"></i> Converted <strong>${items.length}</strong> items successfully.`;
            
            btnConvert.innerHTML = '<i class="fas fa-magic me-2"></i> Convert to SQL';
            btnConvert.disabled = false;
            
            output.classList.add('border-primary');
            setTimeout(() => output.classList.remove('border-primary'), 500);
        }, 300);
    }

    btnConvert.addEventListener('click', convert);

    btnClear.addEventListener('click', () => { 
        input.value = ''; 
        output.value = ''; 
        statsText.innerHTML = '<i class="fas fa-info-circle me-1"></i> Ready for conversion';
    });

    btnSample.addEventListener('click', () => {
        input.value = "apple\nbanana\ncherry\norange";
        convert();
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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\text-to-sql-list.blade.php ENDPATH**/ ?>