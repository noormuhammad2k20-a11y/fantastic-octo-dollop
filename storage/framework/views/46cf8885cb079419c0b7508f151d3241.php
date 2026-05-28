<div class="row g-4 tip-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(245, 158, 11, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #F59E0B, #D97706); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#451a03; letter-spacing: -0.5px;">Premium Tip & Bill Splitter</h4>
                    <p class="text-muted small mb-0">Calculate gratuity, tax adjustments, and fair splits for any group dining experience.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Bill Amount</label>
                        <div class="input-group input-group-lg bg-light rounded-4 border overflow-hidden">
                            <span class="input-group-text border-0 bg-light opacity-50">$</span>
                            <input type="number" id="tip-bill" class="form-control border-0 bg-light fw-bold" value="85.50" step="0.01">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Sales Tax (%)</label>
                        <div class="input-group input-group-lg bg-light rounded-4 border overflow-hidden">
                            <input type="number" id="tip-tax" class="form-control border-0 bg-light fw-bold" value="8.25" step="0.05">
                            <span class="input-group-text border-0 bg-light opacity-50">%</span>
                        </div>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="tip-pretax-toggle" checked>
                            <label class="form-check-label small fw-bold text-muted">Tip on Pre-Tax amount</label>
                        </div>
                    </div>

                    
                    <div class="col-md-12">
                        <div class="p-4 rounded-4 bg-light border">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <label class="form-label-custom mb-0">Gratuity Level</label>
                                <span class="h4 fw-bold text-amber mb-0" id="tip-pct-val">18%</span>
                            </div>
                            <input type="range" class="form-range color-amber" id="tip-pct" min="0" max="40" step="1" value="18">
                            
                            <div class="d-flex flex-wrap gap-2 mt-4">
                                <button class="btn btn-white rounded-pill px-4 fw-bold shadow-sm service-btn" data-v="10">😞 Poor (10%)</button>
                                <button class="btn btn-white rounded-pill px-4 fw-bold shadow-sm service-btn" data-v="15">😊 Good (15%)</button>
                                <button class="btn btn-amber rounded-pill px-4 fw-bold shadow-sm service-btn active" data-v="18">🤩 Great (18%)</button>
                                <button class="btn btn-white rounded-pill px-4 fw-bold shadow-sm service-btn" data-v="25">💎 Elite (25%)</button>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Number of People</label>
                        <div class="input-group input-group-lg bg-white rounded-4 border">
                            <button class="btn btn-outline-amber border-0 px-3" id="split-minus"><i class="fas fa-minus"></i></button>
                            <input type="number" id="tip-split" class="form-control border-0 text-center fw-bold" value="1" min="1">
                            <button class="btn btn-outline-amber border-0 px-3" id="split-plus"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <div class="w-100 p-3 bg-light rounded-4 border d-flex justify-content-between align-items-center">
                            <span class="small fw-bold text-muted uppercase">Round Up Total?</span>
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" id="tip-round">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 35; --tool-color: #F59E0B; --tool-bg: rgba(245, 158, 11, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL PER PERSON</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-per-person">$0.00</div>
                <div class="badge bg-amber-soft text-amber px-4 py-2 rounded-pill fw-bold" id="out-summary">Split 1 Way</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4 align-items-center">
                    <div class="col-md-8">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="stat-card p-3 rounded-4 border text-center bg-light">
                                    <div class="small fw-bold text-muted mb-1">TIP AMOUNT</div>
                                    <div class="h4 fw-bold mb-0 text-amber" id="out-tip-total">$0.00</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card p-3 rounded-4 border text-center bg-light">
                                    <div class="small fw-bold text-muted mb-1">SALES TAX</div>
                                    <div class="h4 fw-bold mb-0 text-dark" id="out-tax-total">$0.00</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card p-3 rounded-4 border text-center bg-light">
                                    <div class="small fw-bold text-muted mb-1">GRAND TOTAL</div>
                                    <div class="h4 fw-bold mb-0 text-dark" id="out-bill-total">$0.00</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 border-start">
                        <div class="vstack gap-2 ps-md-3">
                            <button class="btn d-block mx-auto btn-amber rounded-pill fw-bold text-white shadow-sm py-3 px-5" id="copy-split">
                                <i class="fas fa-copy me-2"></i>Copy Split Info
                            </button>
                            <button class="btn btn-outline-dark w-100 py-2 rounded-pill fw-bold" id="reset-calc">
                                <i class="fas fa-rotate-left me-2"></i>Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const billE = $('tip-bill'), taxE = $('tip-tax'), pretaxE = $('tip-pretax-toggle'),
          pctE = $('tip-pct'), splitE = $('tip-split'), roundE = $('tip-round');

    function calculate(){
        let billTotal = parseFloat(billE.value) || 0;
        let taxPct = (parseFloat(taxE.value) || 0) / 100;
        let tipPct = (parseFloat(pctE.value) || 0) / 100;
        let splitCount = parseInt(splitE.value) || 1;
        
        $('tip-pct-val').textContent = pctE.value + '%';

        // Math
        let billPreTax = billTotal / (1 + taxPct);
        let taxAmt = billTotal - billPreTax;
        
        let tipBasis = pretaxE.checked ? billPreTax : billTotal;
        let tipAmt = tipBasis * tipPct;
        
        let grandTotal = billTotal + tipAmt;
        if(roundE.checked) {
            grandTotal = Math.ceil(grandTotal);
            tipAmt = grandTotal - billTotal;
        }

        let perPerson = grandTotal / splitCount;

        // Update UI
        $('out-per-person').textContent = '$' + perPerson.toFixed(2);
        $('out-tip-total').textContent = '$' + tipAmt.toFixed(2);
        $('out-tax-total').textContent = '$' + taxAmt.toFixed(2);
        $('out-bill-total').textContent = '$' + grandTotal.toFixed(2);
        $('out-summary').textContent = splitCount > 1 ? `Split ${splitCount} Ways` : 'Individual Bill';
    }

    [billE, taxE, pretaxE, pctE, splitE, roundE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.service-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.service-btn').forEach(b => b.classList.remove('btn-amber', 'active'));
            document.querySelectorAll('.service-btn').forEach(b => b.classList.add('btn-white'));
            btn.classList.remove('btn-white');
            btn.classList.add('btn-amber', 'active');
            pctE.value = btn.dataset.v;
            calculate();
        });
    });

    $('split-plus').addEventListener('click', () => { splitE.value = parseInt(splitE.value) + 1; calculate(); });
    $('split-minus').addEventListener('click', () => { if(splitE.value > 1) { splitE.value = parseInt(splitE.value) - 1; calculate(); } });

    $('reset-calc').addEventListener('click', () => {
        billE.value = 85.50; taxE.value = 8.25; pctE.value = 18; splitE.value = 1;
        pretaxE.checked = true; roundE.checked = false;
        calculate();
    });

    $('copy-split').addEventListener('click', function(){
        const txt = `Bill Summary\nTotal: ${$('out-bill-total').textContent}\nTip: ${$('out-tip-total').textContent}\nPer Person: ${$('out-per-person').textContent}\nGenerated by ToolsHub Diner`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.tip-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#451a03;opacity:.7;margin-bottom:8px;display:block}
.tip-rebuilt .calculator-card { transition: none; }
.btn-amber { background: #F59E0B; color: #fff; }
.btn-amber:hover { background: #D97706; color: #fff; }
.text-amber { color: #F59E0B; }
.bg-amber-soft { background: #FEF3C7; }
.bg-amber { background-color: #F59E0B !important; }
.btn-white { background: #fff; border: 1px solid #e2e8f0; color: #475569; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.color-amber::-webkit-slider-thumb { background: #F59E0B; }
.color-amber::-moz-range-thumb { background: #F59E0B; }
.uppercase { text-transform: uppercase; }
.btn-outline-amber { border: 2px solid #F59E0B; color: #F59E0B; font-weight: 700; }
.btn-outline-amber:hover { background: #F59E0B; color: #fff; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\tip-calculator.blade.php ENDPATH**/ ?>