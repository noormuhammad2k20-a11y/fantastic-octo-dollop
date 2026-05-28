<div class="row g-4 octal-converter-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Octal Number</label>
                    <input type="text" id="oct-input" class="form-control form-control-lg font-monospace" placeholder="e.g. 177" value="10">
                    <div class="mt-2 d-flex gap-2">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-val="7">7</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-val="10">10</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-val="77">77</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-val="524">524</button>
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-info me-1"></i> <strong>Note:</strong> Octal (Base-8) uses digits 0 through 7.
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:200;--tool-color:#0284c7;--tool-bg:rgba(2,132,199,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Decimal (Base 10)</span>
                <div class="output-hero-value" id="out-decimal">—</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Binary (Base 2)</span>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="stat-card-value font-monospace" id="out-binary">—</span>
                            <button class="btn btn-sm btn-link p-0 text-decoration-none" onclick="copyId('out-binary')"><i class="fas fa-copy"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Hexadecimal (Base 16)</span>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="stat-card-value font-monospace" id="out-hex">—</span>
                            <button class="btn btn-sm btn-link p-0 text-decoration-none" onclick="copyId('out-hex')"><i class="fas fa-copy"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-table me-2 text-info"></i>Conversion Table</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered text-center small mb-0">
                    <thead class="table-light">
                        <tr><th>Base</th><th>Value</th></tr>
                    </thead>
                    <tbody id="out-table">
                        <tr><td>Base 32</td><td id="base-32">—</td></tr>
                        <tr><td>Base 36</td><td id="base-36">—</td></tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy-all" style="min-width: 280px; max-width: 100%;"><i class="fas fa-share-alt me-2"></i>Copy All Values</button>
            </div>
        </div>
    </div>
</div>

<script>
function copyId(id){
    const el = document.getElementById(id);
    if(el.textContent === '—') return;
    navigator.clipboard.writeText(el.textContent);
}

document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('oct-input');
    
    function calculate(){
        let val = input.value.trim();
        if(!val) { reset(); return; }

        if(!/^[0-7]+$/.test(val)){
            document.getElementById('out-decimal').textContent = 'Invalid';
            return;
        }

        const decimal = parseInt(val, 8);
        document.getElementById('out-decimal').textContent = decimal.toLocaleString();
        document.getElementById('out-binary').textContent = decimal.toString(2);
        document.getElementById('out-hex').textContent = decimal.toString(16).toUpperCase();
        document.getElementById('base-32').textContent = decimal.toString(32).toUpperCase();
        document.getElementById('base-36').textContent = decimal.toString(36).toUpperCase();
    }

    function reset(){
        document.getElementById('out-decimal').textContent = '—';
        document.getElementById('out-binary').textContent = '—';
        document.getElementById('out-hex').textContent = '—';
        document.getElementById('base-32').textContent = '—';
        document.getElementById('base-36').textContent = '—';
    }

    input.addEventListener('input', calculate);
    
    document.querySelectorAll('.oct-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            input.value = btn.dataset.val;
            calculate();
        });
    });

    document.getElementById('btn-copy-all').addEventListener('click', function(){
        const dec = document.getElementById('out-decimal').textContent;
        if(dec === '—') return;
        const text = `Octal: ${input.value}\nDecimal: ${dec}\nBinary: ${document.getElementById('out-binary').textContent}\nHex: ${document.getElementById('out-hex').textContent}`;
        navigator.clipboard.writeText(text);
        const o = this.innerHTML; this.innerHTML = 'Copied All!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.octal-converter-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.octal-converter-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.octal-converter-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.octal-converter-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.octal-converter-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.octal-converter-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.octal-converter-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.octal-converter-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.octal-converter-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.octal-converter-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

.octal-converter-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; }
.octal-converter-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.octal-converter-rebuilt .stat-card-value { font-size: 1.15rem; font-weight: 700; color: #1e293b; word-break: break-all; }

@media (max-width: 768px) {
    .octal-converter-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\octal-converter.blade.php ENDPATH**/ ?>