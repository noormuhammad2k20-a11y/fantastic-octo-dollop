<div class="row g-4 pizza-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(245, 158, 11, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-orange" style="background: linear-gradient(135deg, #F59E0B, #D97706); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-pizza-slice"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#78350f; letter-spacing: -0.5px;">Pizza Value Architect</h4>
                    <p class="text-muted small mb-0">Compare crust geometry and price-per-inch to find the ultimate cheesy ROI.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-orange-50 border border-orange-100 h-100 position-relative overflow-hidden">
                            <div class="position-absolute top-0 end-0 p-3 opacity-10">
                                <i class="fas fa-pizza-slice fa-4x rotate-12"></i>
                            </div>
                            <h6 class="fw-bold small mb-3 uppercase text-orange-800 opacity-70">Pizza Alpha (Standard)</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Diameter</label>
                                    <div class="input-group">
                                        <input type="number" id="p1-size" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="10">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">IN</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-start-3 text-muted small">$</span>
                                        <input type="number" id="p1-price" class="form-control border-0 bg-white shadow-sm rounded-end-3 fw-bold h5 mb-0" value="12">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="form-label-custom">Quantity</label>
                                <input type="range" class="form-range custom-orange-range" id="p1-qty" min="1" max="10" value="1">
                                <div class="d-flex justify-content-between small fw-bold text-orange-900 mt-1">
                                    <span>1 Pie</span>
                                    <span id="p1-qty-val">1</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-amber-50 border border-amber-100 h-100 position-relative overflow-hidden">
                            <div class="position-absolute top-0 end-0 p-3 opacity-10">
                                <i class="fas fa-pizza-slice fa-4x -rotate-12"></i>
                            </div>
                            <h6 class="fw-bold small mb-3 uppercase text-amber-800 opacity-70">Pizza Beta (Upsell)</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom text-amber-900">Diameter</label>
                                    <div class="input-group">
                                        <input type="number" id="p2-size" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="14">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">IN</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom text-amber-900">Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-start-3 text-muted small">$</span>
                                        <input type="number" id="p2-price" class="form-control border-0 bg-white shadow-sm rounded-end-3 fw-bold h5 mb-0" value="18">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="form-label-custom text-amber-900">Quantity</label>
                                <input type="range" class="form-range custom-amber-range" id="p2-qty" min="1" max="10" value="1">
                                <div class="d-flex justify-content-between small fw-bold text-amber-900 mt-1">
                                    <span>1 Pie</span>
                                    <span id="p2-qty-val">1</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-p1s="10" data-p1p="10" data-p2s="14" data-p2p="18">Standard vs Large</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-p1s="12" data-p1p="15" data-p2s="12" data-p2p="25" data-p2q="2">BOGO Deal Test</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-p1s="7" data-p1p="5" data-p2s="18" data-p2p="20">Personal vs Party</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 35; --tool-color: #F59E0B; --tool-bg: rgba(245, 158, 11, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">OPTIMAL VALUE CHOICE</span>
                <div class="output-hero-value display-2 fw-900 my-2 text-orange-900" id="out-winner">PIZZA BETA</div>
                <div class="badge bg-orange-soft text-orange px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-savings">SAVE 24% PER SQ INCH</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4 text-center">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Pizza Alpha Metrics</h6>
                            <div class="vstack gap-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="small text-muted">Total Area:</span>
                                    <span class="fw-bold" id="p1-area">78.5 sq in</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="small text-muted">Cost / Sq In:</span>
                                    <span class="fw-bold" id="p1-unit">$0.15</span>
                                </div>
                                <div class="progress mt-2" style="height: 6px;">
                                    <div id="p1-bar" class="progress-bar bg-orange" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Pizza Beta Metrics</h6>
                            <div class="vstack gap-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="small text-muted">Total Area:</span>
                                    <span class="fw-bold" id="p2-area">153.9 sq in</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="small text-muted">Cost / Sq In:</span>
                                    <span class="fw-bold" id="p2-unit">$0.12</span>
                                </div>
                                <div class="progress mt-2" style="height: 6px;">
                                    <div id="p2-bar" class="progress-bar bg-orange" style="width: 80%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-12 border-top pt-4">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto btn-orange rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-receipt me-2"></i>Copy Value Report
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto btn-outline-dark rounded-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Comparison
                                </button>
                            </div>
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
    const p1s = $('p1-size'), p1p = $('p1-price'), p1q = $('p1-qty');
    const p2s = $('p2-size'), p2p = $('p2-price'), p2q = $('p2-qty');

    function calculate(){
        const s1 = parseFloat(p1s.value) || 0;
        const pr1 = parseFloat(p1p.value) || 0;
        const q1 = parseInt(p1q.value) || 1;
        
        const s2 = parseFloat(p2s.value) || 0;
        const pr2 = parseFloat(p2p.value) || 0;
        const q2 = parseInt(p2q.value) || 1;

        $('p1-qty-val').textContent = q1;
        $('p2-qty-val').textContent = q2;

        const area1 = Math.PI * Math.pow(s1/2, 2) * q1;
        const area2 = Math.PI * Math.pow(s2/2, 2) * q2;

        const unit1 = area1 > 0 ? pr1 / area1 : 0;
        const unit2 = area2 > 0 ? pr2 / area2 : 0;

        $('p1-area').textContent = area1.toFixed(1) + ' sq in';
        $('p2-area').textContent = area2.toFixed(1) + ' sq in';
        
        $('p1-unit').textContent = '$' + unit1.toFixed(4);
        $('p2-unit').textContent = '$' + unit2.toFixed(4);

        if(unit1 > 0 && unit2 > 0){
            const winner = unit1 < unit2 ? 'PIZZA ALPHA' : 'PIZZA BETA';
            const savings = Math.abs((unit1 - unit2) / Math.max(unit1, unit2) * 100);
            
            $('out-winner').textContent = winner;
            $('out-savings').textContent = `SAVE ${Math.round(savings)}% PER SQ INCH`;
            
            const maxUnit = Math.max(unit1, unit2);
            $('p1-bar').style.width = (unit1 / maxUnit * 100) + '%';
            $('p2-bar').style.width = (unit2 / maxUnit * 100) + '%';
        } else {
            $('out-winner').textContent = 'READY TO COMPARE';
            $('out-savings').textContent = 'ENTER DETAILS ABOVE';
        }
    }

    [p1s, p1p, p1q, p2s, p2p, p2q].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            p1s.value = btn.dataset.p1s;
            p1p.value = btn.dataset.p1p;
            p1q.value = btn.dataset.p1q || 1;
            p2s.value = btn.dataset.p2s;
            p2p.value = btn.dataset.p2p;
            p2q.value = btn.dataset.p2q || 1;
            calculate();
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Pizza Value Report\nWinner: ${$('out-winner').textContent}\nAlpha: ${$('p1-unit').textContent}/sqin\nBeta: ${$('p2-unit').textContent}/sqin\nGenerated by ToolsHub Pizza Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => {
        p1s.value = 10; p1p.value = 12; p1q.value = 1;
        p2s.value = 14; p2p.value = 18; p2q.value = 1;
        calculate();
    });

    calculate();
});
</script>

<style>
.pizza-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#78350f;opacity:.7;margin-bottom:8px;display:block}
.pizza-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-orange { background: #F59E0B; color: #fff; transition: all .3s; }
.btn-orange:hover { background: #D97706; color: #fff; transform: translateY(-2px); }
.bg-orange-soft { background: #FFFBEB; color: #F59E0B; }
.bg-orange-50 { background-color: #fffbf0; }
.bg-amber-50 { background-color: #fffdf5; }
.fw-900 { font-weight: 900; }
.custom-orange-range::-webkit-slider-thumb { background: #F59E0B; }
.custom-amber-range::-webkit-slider-thumb { background: #D97706; }
.pulse-orange { animation: orange-pulse 2s infinite; }
@keyframes orange-pulse { 0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(245, 158, 11, 0); } 100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); } }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\pizza-value-calculator.blade.php ENDPATH**/ ?>