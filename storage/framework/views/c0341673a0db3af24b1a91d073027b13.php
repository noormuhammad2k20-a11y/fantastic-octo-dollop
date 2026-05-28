<div class="row g-4 split-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(139, 92, 246, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #8B5CF6, #7C3AED); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-users-viewfinder"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e1b4b; letter-spacing: -0.5px;">Group Bill Splitter Pro</h4>
                    <p class="text-muted small mb-0">The ultimate fintech tool for dividing checks, handling discounts, and managing service fees.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Check Amount</label>
                        <div class="input-group input-group-lg bg-light rounded-4 border overflow-hidden">
                            <span class="input-group-text border-0 bg-light opacity-50">$</span>
                            <input type="number" id="split-total" class="form-control border-0 bg-light fw-bold" value="120.00" step="0.01">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Split Between</label>
                        <div class="input-group input-group-lg bg-light rounded-4 border overflow-hidden">
                            <input type="number" id="split-count" class="form-control border-0 bg-light fw-bold text-center" value="4" min="1">
                            <span class="input-group-text border-0 bg-light opacity-50 pe-3">People</span>
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Tip Percentage (%)</label>
                        <div class="input-group bg-light rounded-3 border">
                            <input type="number" id="split-tip" class="form-control border-0 bg-light fw-bold" value="15">
                            <span class="input-group-text border-0 bg-light opacity-50">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Discount (Fixed $)</label>
                        <div class="input-group bg-light rounded-3 border">
                            <span class="input-group-text border-0 bg-light opacity-50">$</span>
                            <input type="number" id="split-discount" class="form-control border-0 bg-light fw-bold" value="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Service Fee (Fixed $)</label>
                        <div class="input-group bg-light rounded-3 border">
                            <span class="input-group-text border-0 bg-light opacity-50">$</span>
                            <input type="number" id="split-fee" class="form-control border-0 bg-light fw-bold" value="0">
                        </div>
                    </div>

                    
                    <div class="col-md-12">
                        <div class="p-3 bg-light rounded-4 border d-flex flex-wrap gap-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="split-tip-gross" checked>
                                <label class="form-check-label small fw-bold text-muted">Tip on Total Amount</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="split-round">
                                <label class="form-check-label small fw-bold text-muted">Round up individuals</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 260; --tool-color: #8B5CF6; --tool-bg: rgba(139, 92, 246, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">EACH PERSON PAYS</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-per-person">$0.00</div>
                <div class="badge bg-violet-soft text-violet px-4 py-2 rounded-pill fw-bold" id="out-summary">Split 4 Ways</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-8">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="stat-card p-3 rounded-4 border text-center">
                                    <div class="small fw-bold text-muted mb-1 uppercase">Subtotal</div>
                                    <div class="h5 fw-bold mb-0 text-dark" id="out-sub">$0.00</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card p-3 rounded-4 border text-center">
                                    <div class="small fw-bold text-muted mb-1 uppercase">Total Tip</div>
                                    <div class="h5 fw-bold mb-0 text-success" id="out-tip">$0.00</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card p-3 rounded-4 border text-center">
                                    <div class="small fw-bold text-muted mb-1 uppercase">Final Bill</div>
                                    <div class="h5 fw-bold mb-0 text-dark" id="out-total">$0.00</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-light rounded-4 border border-dashed">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="small fw-bold text-muted uppercase">Bill Allocation</span>
                                <span class="small fw-bold text-violet" id="out-alloc">100% Bill</span>
                            </div>
                            <div class="progress rounded-pill overflow-hidden" style="height: 12px; background: #e2e8f0;">
                                <div id="bar-base" class="progress-bar bg-violet" style="width: 80%"></div>
                                <div id="bar-tip" class="progress-bar bg-emerald" style="width: 20%"></div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-4 border-start">
                        <div class="vstack gap-2 ps-md-3">
                            <button class="btn d-block mx-auto btn-violet rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-share-nodes me-2"></i>Copy Split Breakdown
                            </button>
                            <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-rotate-left me-2"></i>Reset Bill
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
    const totalE = $('split-total'), countE = $('split-count'), tipE = $('split-tip'),
          discountE = $('split-discount'), feeE = $('split-fee'), 
          tipGrossE = $('split-tip-gross'), roundE = $('split-round');

    function calculate(){
        let checkAmt = parseFloat(totalE.value) || 0;
        let peopleCount = parseInt(countE.value) || 1;
        let tipPct = (parseFloat(tipE.value) || 0) / 100;
        let discount = parseFloat(discountE.value) || 0;
        let serviceFee = parseFloat(feeE.value) || 0;

        let subtotal = Math.max(0, checkAmt - discount + serviceFee);
        
        let tipBasis = tipGrossE.checked ? checkAmt : subtotal;
        let totalTip = tipBasis * tipPct;
        
        let grandTotal = subtotal + totalTip;
        let perPerson = grandTotal / peopleCount;
        
        if(roundE.checked) {
            perPerson = Math.ceil(perPerson);
            grandTotal = perPerson * peopleCount;
            totalTip = grandTotal - subtotal;
        }

        // Update UI
        $('out-per-person').textContent = '$' + perPerson.toFixed(2);
        $('out-sub').textContent = '$' + subtotal.toFixed(2);
        $('out-tip').textContent = '$' + totalTip.toFixed(2);
        $('out-total').textContent = '$' + grandTotal.toFixed(2);
        $('out-summary').textContent = `Split ${peopleCount} Way${peopleCount > 1 ? 's' : ''}`;

        if(grandTotal > 0) {
            let basePct = (subtotal / grandTotal) * 100;
            let tipPctActual = (totalTip / grandTotal) * 100;
            $('bar-base').style.width = basePct + '%';
            $('bar-tip').style.width = tipPctActual + '%';
            $('out-alloc').textContent = `${Math.round(basePct)}% Bill | ${Math.round(tipPctActual)}% Tip`;
        }
    }

    [totalE, countE, tipE, discountE, feeE, tipGrossE, roundE].forEach(e => e.addEventListener('input', calculate));

    $('reset-calc').addEventListener('click', () => {
        totalE.value = 120.00; countE.value = 4; tipE.value = 15;
        discountE.value = 0; feeE.value = 0;
        tipGrossE.checked = true; roundE.checked = false;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Group Bill Split\nTotal: ${$('out-total').textContent}\nPer Person: ${$('out-per-person').textContent}\nSplit by ${countE.value} people\nGenerated by ToolsHub Finance`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.split-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e1b4b;opacity:.7;margin-bottom:8px;display:block}
.split-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-violet { background: #8B5CF6; color: #fff; transition: all .3s; }
.btn-violet:hover { background: #7C3AED; color: #fff; transform: translateY(-2px); }
.text-violet { color: #8B5CF6; }
.bg-violet-soft { background: #EDE9FE; }
.bg-violet { background-color: #8B5CF6 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.bg-emerald { background-color: #10b981 !important; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\split-bill-calculator.blade.php ENDPATH**/ ?>