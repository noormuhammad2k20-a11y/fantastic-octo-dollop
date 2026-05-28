<div class="row g-4 plum-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(30, 64, 175, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm ripple-effect" style="background: linear-gradient(135deg, #1E40AF, #1E3A8A); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-faucet-drip"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e3a8a; letter-spacing: -0.5px;">Fluid Dynamics: Plumbing Estimator</h4>
                    <p class="text-muted small mb-0">Professional grade estimation for residential plumbing. Factor in emergency premiums, material quality, and job complexity.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Service Definition</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom">Estimated Labor Time</label>
                                    <div class="input-group">
                                        <input type="number" id="v-hrs" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="2">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">HOURS</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Call-Out / Service Fee</label>
                                    <div class="input-group">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-start-3 text-muted small">$</span>
                                        <input type="number" id="v-fee" class="form-control border-0 bg-white shadow-sm rounded-end-3 fw-bold h5 mb-0" value="85">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Job Category & Intensity</label>
                                <select id="v-type" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                    <option value="125">Routine Maintenance ($125/hr)</option>
                                    <option value="175">Standard Repair ($175/hr)</option>
                                    <option value="250">Emergency / After-Hours ($250/hr)</option>
                                    <option value="210">New Fixture Installation ($210/hr)</option>
                                    <option value="350">Main Line / Sewer Work ($350/hr)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-blue">
                            <h6 class="fw-bold small mb-3 uppercase text-blue opacity-70">Logistics & Materials</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Parts & Materials Grade</label>
                                <select id="v-parts" class="form-select border-0 bg-light rounded-3 fw-bold py-2">
                                    <option value="50">Basic Replacement Parts (+$50)</option>
                                    <option value="250">Mid-Range Fixtures (+$250)</option>
                                    <option value="850">Luxury / Commercial Hardware (+$850)</option>
                                    <option value="0">Labor Only (Parts Provided)</option>
                                </select>
                            </div>
                            <div class="vstack gap-2">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Difficult Access Modifier</label>
                                    <input class="form-check-input" type="checkbox" id="v-access">
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Warranty & Insurance (+5%)</label>
                                    <input class="form-check-input" type="checkbox" id="v-insure" checked>
                                </div>
                                <hr class="my-1 opacity-10">
                                <div class="p-3 rounded-3 bg-blue-50 border border-blue-100 text-center">
                                    <div class="small fw-bold text-blue-900">PRIORITY LEVEL</div>
                                    <div class="h5 fw-900 text-blue-900 mb-0" id="out-priority">STANDARD RESPONSE</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-h="1" data-t="175" data-f="85">Leaking Faucet</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-h="3" data-t="250" data-f="150">Midnight Burst Pipe</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-h="5" data-t="210" data-f="0">Full Toilet/Sink Install</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 220; --tool-color: #1E40AF; --tool-bg: rgba(30, 64, 175, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">ESTIMATED SERVICE TOTAL</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-total">$435</div>
                <div class="badge bg-blue-soft text-blue px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-unit">$175.00 PER HOUR</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Invoice Projection</h6>
                        <div class="row g-2">
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">LABOR TOTAL</div><div class="h5 fw-bold mb-0" id="out-lab">$350</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">FIXED FEES</div><div class="h5 fw-bold mb-0" id="out-fixed">$85</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">PARTS/MATERIALS</div><div class="h5 fw-bold mb-0" id="out-parts-cost">$0</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">SURCHARGES</div><div class="h5 fw-bold mb-0" id="out-sur">$0</div></div></div>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Service Insight</h6>
                            <div class="p-3 rounded-4 bg-blue-50 border border-blue-100 mb-4 text-blue">
                                <i class="fas fa-droplet me-2"></i>
                                <span class="small fw-bold" id="out-advice">Emergency rates apply for services after 6 PM or on weekends. </span>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-blue rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-invoice me-2"></i>Copy Service Estimate
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Estimator
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
    const hrsE = $('v-hrs'), feeE = $('v-fee'), typeE = $('v-type'), partsE = $('v-parts'), accessE = $('v-access'), insureE = $('v-insure');

    function calculate(){
        const hrs = parseFloat(hrsE.value) || 0;
        const rate = parseFloat(typeE.value);
        const fee = parseFloat(feeE.value) || 0;
        const parts = parseFloat(partsE.value);

        let labor = hrs * rate;
        if(accessE.checked) labor *= 1.25; // 25% difficulty multiplier

        let sur = 0;
        if(insureE.checked) sur = (labor + fee + parts) * 0.05;

        const total = labor + fee + parts + sur;

        $('out-total').textContent = '$' + Math.round(total).toLocaleString();
        $('out-unit').textContent = '$' + rate.toFixed(2) + ' PER HOUR';
        
        $('out-lab').textContent = '$' + Math.round(labor).toLocaleString();
        $('out-fixed').textContent = '$' + Math.round(fee).toLocaleString();
        $('out-parts-cost').textContent = '$' + Math.round(parts).toLocaleString();
        $('out-sur').textContent = '$' + Math.round(sur).toLocaleString();

        let prio = "STANDARD RESPONSE";
        if(rate >= 250) prio = "EMERGENCY PRIORITY";
        else if(hrs >= 4) prio = "FULL DAY SERVICE";
        $('out-priority').textContent = prio;

        let adv = "Preventative maintenance can save up to 60% on future emergency call-outs.";
        if(rate >= 250) adv = "Emergency premium detected. Scheduling for next business day could save approx. $75/hr.";
        if(accessE.checked) adv = "Tight space access required. Ensure the area is cleared to avoid additional labor charges.";
        $('out-advice').textContent = adv;
    }

    [hrsE, feeE, typeE, partsE, accessE, insureE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => { 
            hrsE.value = btn.dataset.h; typeE.value = btn.dataset.t; feeE.value = btn.dataset.f;
            calculate(); 
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Plumbing Service Estimate\nLabor: ${hrsE.value} Hours @ ${$('out-unit').textContent}\nStatus: ${$('out-priority').textContent}\nTotal Est: ${$('out-total').textContent}\nGenerated by Fluid Dynamics Estimator`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Estimate Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { hrsE.value = 2; feeE.value = 85; calculate(); });

    calculate();
});
</script>

<style>
.plum-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e3a8a;opacity:.7;margin-bottom:8px;display:block}
.plum-rebuilt .calculator-card { transition: all 0.3s ease; }
.ripple-effect { position: relative; overflow: hidden; }
.ripple-effect::after { content: ""; display: block; position: absolute; width: 100%; height: 100%; top: 0; left: 0; pointer-events: none; background-image: radial-gradient(circle, #fff 10%, transparent 10.01%); background-repeat: no-repeat; background-position: 50%; transform: scale(10, 10); opacity: 0; transition: transform .5s, opacity 1s; }
.btn-blue { background: #1E40AF; color: #fff; transition: all .3s; }
.btn-blue:hover { background: #1E3A8A; color: #fff; transform: translateY(-2px); }
.bg-blue-soft { background: #EFF6FF; color: #1E40AF; }
.bg-blue-50 { background-color: #f8fbff; }
.border-blue { border-color: #bfdbfe !important; }
.text-blue { color: #1E40AF !important; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\plumbing-cost-calculator.blade.php ENDPATH**/ ?>