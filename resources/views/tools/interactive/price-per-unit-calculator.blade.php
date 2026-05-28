<div class="row g-4 price-unit-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(14, 165, 233, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #0EA5E9, #0284C7); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-scale-balanced"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#0c4a6e; letter-spacing: -0.5px;">Unit Price Battle</h4>
                    <p class="text-muted small mb-0">Decode marketing tricks and find the true lowest price by comparing unit-to-unit value.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Item A --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border-start border-4 border-info h-100" style="background: #f0f9ff;">
                            <h6 class="fw-black text-info text-uppercase small mb-4 tracking-wider">Product A</h6>
                            <div class="mb-3">
                                <label class="form-label-custom">Price ($)</label>
                                <input type="number" id="pa-price" class="form-control border-0 bg-white rounded-3 fw-bold" value="5.99" step="0.01">
                            </div>
                            <div class="row g-2">
                                <div class="col-6">
                                    <label class="form-label-custom">Pack Size (e.g. 6)</label>
                                    <input type="number" id="pa-pack" class="form-control border-0 bg-white rounded-3 fw-bold" value="1">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Unit Qty (e.g. 12)</label>
                                    <input type="number" id="pa-qty" class="form-control border-0 bg-white rounded-3 fw-bold" value="16">
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="form-label-custom">Unit Name (e.g. oz)</label>
                                <input type="text" id="pa-unit" class="form-control border-0 bg-white rounded-3 fw-bold" value="oz">
                            </div>
                        </div>
                    </div>

                    {{-- Item B --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border-start border-4 border-primary h-100" style="background: #eff6ff;">
                            <h6 class="fw-black text-primary text-uppercase small mb-4 tracking-wider">Product B</h6>
                            <div class="mb-3">
                                <label class="form-label-custom">Price ($)</label>
                                <input type="number" id="pb-price" class="form-control border-0 bg-white rounded-3 fw-bold" value="9.49" step="0.01">
                            </div>
                            <div class="row g-2">
                                <div class="col-6">
                                    <label class="form-label-custom">Pack Size</label>
                                    <input type="number" id="pb-pack" class="form-control border-0 bg-white rounded-3 fw-bold" value="1">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Unit Qty</label>
                                    <input type="number" id="pb-qty" class="form-control border-0 bg-white rounded-3 fw-bold" value="32">
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="form-label-custom">Unit Name</label>
                                <input type="text" id="pb-unit" class="form-control border-0 bg-white rounded-3 fw-bold" value="oz">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 200; --tool-color: #0EA5E9; --tool-bg: rgba(14, 165, 233, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">THE BETTER VALUE IS</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-verdict">Product B</div>
                <div class="badge bg-white text-info px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-savings">Save 15% / unit</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Price Breakdown --}}
                    <div class="col-md-8">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="stat-card p-4 rounded-4 border-start border-4 border-info bg-light">
                                    <div class="small fw-bold text-muted mb-1 uppercase">PRODUCT A UNIT PRICE</div>
                                    <div class="h3 fw-bold mb-0 text-dark" id="out-unit-a">$0.00 / oz</div>
                                    <div class="small text-muted mt-2" id="out-total-a">Total: 16 oz</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="stat-card p-4 rounded-4 border-start border-4 border-primary bg-light">
                                    <div class="small fw-bold text-muted mb-1 uppercase">PRODUCT B UNIT PRICE</div>
                                    <div class="h3 fw-bold mb-0 text-dark" id="out-unit-b">$0.00 / oz</div>
                                    <div class="small text-muted mt-2" id="out-total-b">Total: 32 oz</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-4 border-start d-flex flex-column justify-content-center">
                        <div class="vstack gap-2 ps-md-3">
                            <button class="btn d-block mx-auto btn-info rounded-pill fw-bold text-white shadow-sm py-3 px-5" id="copy-summary">
                                <i class="fas fa-copy me-2"></i>Copy Comparison
                            </button>
                            <button class="btn btn-outline-dark w-100 py-2 rounded-pill fw-bold" id="reset-calc">
                                <i class="fas fa-rotate-left me-2"></i>Clear All
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
    const paPrice = $('pa-price'), paPack = $('pa-pack'), paQty = $('pa-qty'), paUnit = $('pa-unit'),
          pbPrice = $('pb-price'), pbPack = $('pb-pack'), pbQty = $('pb-qty'), pbUnit = $('pb-unit');

    function calculate(){
        let pA = parseFloat(paPrice.value) || 0, packA = parseFloat(paPack.value) || 1, qtyA = parseFloat(paQty.value) || 0;
        let pB = parseFloat(pbPrice.value) || 0, packB = parseFloat(pbPack.value) || 1, qtyB = parseFloat(pbQty.value) || 0;
        
        let totalQtyA = packA * qtyA;
        let totalQtyB = packB * qtyB;
        
        let unitA = totalQtyA > 0 ? (pA / totalQtyA) : 0;
        let unitB = totalQtyB > 0 ? (pB / totalQtyB) : 0;

        // Update UI Breakdown
        $('out-unit-a').textContent = '$' + unitA.toFixed(3) + ' / ' + paUnit.value;
        $('out-unit-b').textContent = '$' + unitB.toFixed(3) + ' / ' + pbUnit.value;
        $('out-total-a').textContent = `Total: ${totalQtyA} ${paUnit.value}`;
        $('out-total-b').textContent = `Total: ${totalQtyB} ${pbUnit.value}`;

        const verdict = $('out-verdict');
        const savings = $('out-savings');

        if(unitA > 0 && unitB > 0) {
            if(unitA < unitB) {
                verdict.textContent = 'Product A';
                verdict.style.color = '#0EA5E9';
                let s = ((unitB - unitA) / unitB) * 100;
                savings.textContent = `Save ${s.toFixed(1)}% per unit`;
            } else if(unitB < unitA) {
                verdict.textContent = 'Product B';
                verdict.style.color = '#2563EB';
                let s = ((unitA - unitB) / unitA) * 100;
                savings.textContent = `Save ${s.toFixed(1)}% per unit`;
            } else {
                verdict.textContent = 'Equal Value';
                verdict.style.color = '#64748b';
                savings.textContent = 'Prices are identical';
            }
        } else {
            verdict.textContent = 'Incomplete';
            savings.textContent = 'Enter values for both';
        }
    }

    [paPrice, paPack, paQty, paUnit, pbPrice, pbPack, pbQty, pbUnit].forEach(e => e.addEventListener('input', calculate));

    $('reset-calc').addEventListener('click', () => {
        paPrice.value = 5.99; paPack.value = 1; paQty.value = 16;
        pbPrice.value = 9.49; pbPack.value = 1; pbQty.value = 32;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Unit Price Comparison\nBetter Value: ${$('out-verdict').textContent}\nSavings: ${$('out-savings').textContent}\nGenerated by ToolsHub Smart Shopper`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.price-unit-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#0c4a6e;opacity:.7;margin-bottom:8px;display:block}
.price-unit-rebuilt .calculator-card { transition: none; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.stat-card { background: #fff; }
</style>

