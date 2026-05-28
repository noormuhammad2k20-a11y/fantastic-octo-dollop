<div class="row g-4 vat-calc-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Base Amount</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="amount" class="form-control form-control-lg rounded-3 border-start-0" value="1000" step="0.01">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Tax Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="20" step="0.1">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Calculation Direction</label>
                        <div class="d-flex gap-3">
                            <div class="form-check custom-radio">
                                <input class="form-check-input" type="radio" name="direction" id="add-vat" value="add" checked>
                                <label class="form-check-label fw-bold" for="add-vat">Add VAT (Net to Gross)</label>
                            </div>
                            <div class="form-check custom-radio">
                                <input class="form-check-input" type="radio" name="direction" id="remove-vat" value="remove">
                                <label class="form-check-label fw-bold" for="remove-vat">Remove VAT (Gross to Net)</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-danger btn-lg px-4 rounded-pill shadow-sm" id="btn-calculate"><i class="fas fa-calculator me-2"></i>Calculate Tax</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Total Amount</span>
                <div class="output-hero-value" id="out-total">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">Final value including/excluding tax components.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Net Amount</span><span class="stat-card-value" id="out-net">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">VAT Amount</span><span class="stat-card-value text-danger" id="out-tax">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Effective Rate</span><span class="stat-card-value" id="out-eff-rate">—</span></div></div>
            </div>

            <div class="mt-4 p-3 bg-white rounded-3 border overflow-x-auto">
                <h6 class="fw-bold mb-3"><i class="fas fa-globe me-2 text-danger"></i>Common Global VAT Rates</h6>
                <div class="row g-2">
                    <div class="col-6 col-md-3"><button class="btn btn-outline-dark btn-sm w-100 preset-rate" data-rate="20">UK (20%)</button></div>
                    <div class="col-6 col-md-3"><button class="btn btn-outline-dark btn-sm w-100 preset-rate" data-rate="19">Germany (19%)</button></div>
                    <div class="col-6 col-md-3"><button class="btn btn-outline-dark btn-sm w-100 preset-rate" data-rate="15">NZ (15%)</button></div>
                    <div class="col-6 col-md-3"><button class="btn btn-outline-dark btn-sm w-100 preset-rate" data-rate="5">UAE (5%)</button></div>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Calculation</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const amountEl=$('amount'), rateEl=$('rate');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD'});

    function calculate(){
        const a = parseFloat(amountEl.value);
        const r = parseFloat(rateEl.value)/100;
        const mode = document.querySelector('input[name="direction"]:checked').value;

        if(isNaN(a) || isNaN(r)) return;

        let net, tax, total;
        if(mode === 'add'){
            net = a;
            tax = a * r;
            total = a + tax;
        } else {
            total = a;
            net = a / (1 + r);
            tax = total - net;
        }

        $('out-total').textContent = nf.format(total);
        $('out-net').textContent = nf.format(net);
        $('out-tax').textContent = nf.format(tax);
        $('out-eff-rate').textContent = rateEl.value + '%';
        $('out-summary').textContent = mode === 'add' ? 'Amount with Tax added.' : 'Amount with Tax removed.';
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        amountEl.value=1000; rateEl.value=20; $('add-vat').checked=true;
        calculate();
    });

    document.querySelectorAll('.preset-rate').forEach(btn => {
        btn.addEventListener('click', function(){
            rateEl.value = this.dataset.rate;
            calculate();
        });
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `VAT Calculation\nTotal: ${$('out-total').textContent}\nNet: ${$('out-net').textContent}\nTax (${rateEl.value}%): ${$('out-tax').textContent}\n— ToolsHub Tax Tools`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.vat-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.vat-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.vat-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.vat-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.vat-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.vat-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.vat-calc-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.vat-calc-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.vat-calc-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.vat-calc-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}
.vat-calc-rebuilt .custom-radio .form-check-input:checked { background-color: #ef4444; border-color: #ef4444; }

@media (max-width: 768px) {
    .vat-calc-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .vat-calc-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
