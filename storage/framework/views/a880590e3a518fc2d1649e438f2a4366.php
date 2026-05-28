<div class="row g-4 pest-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(13, 148, 136, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm radar-scan" style="background: linear-gradient(135deg, #0D9488, #0F766E); color:#BEF264; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-bug-slash"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#134e4a; letter-spacing: -0.5px;">Exterminator Pro: Bio-Shield Analyst</h4>
                    <p class="text-muted small mb-0">Professional pest management estimation. Calculate treatment costs based on species profile, infestation density, and property scale.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Target Identification</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom">Property Surface Area</label>
                                    <div class="input-group">
                                        <input type="number" id="v-sqft" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="2000">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">SQFT</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Pest Species Profile</label>
                                    <select id="v-pest" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                        <option value="150">General Insects (Ants/Roaches)</option>
                                        <option value="850">Termite Barrier System</option>
                                        <option value="1200">Bed Bug Thermal Treatment</option>
                                        <option value="350">Rodent Exclusion & Control</option>
                                        <option value="550">Wildlife Trapping/Removal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Infestation Severity Matrix</label>
                                <div class="btn-group w-100 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                    <input type="radio" class="btn-check" name="v-level" id="l-low" value="1.0" checked>
                                    <label class="btn btn-outline-teal py-3 small fw-bold" for="l-low">Low / Preventative</label>
                                    <input type="radio" class="btn-check" name="v-level" id="l-med" value="1.5">
                                    <label class="btn btn-outline-teal py-3 small fw-bold" for="l-med">Medium / Visible</label>
                                    <input type="radio" class="btn-check" name="v-level" id="l-high" value="2.8">
                                    <label class="btn btn-outline-teal py-3 small fw-bold" for="l-high">High / Crisis</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-teal">
                            <h6 class="fw-bold small mb-3 uppercase text-teal opacity-70">Program Logistics</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Treatment Cadence</label>
                                <select id="v-freq" class="form-select border-0 bg-light rounded-3 fw-bold py-2">
                                    <option value="1.0">One-Time Remediation</option>
                                    <option value="0.7">Quarterly Maintenance (per visit)</option>
                                    <option value="0.6">Monthly Shield (per visit)</option>
                                </select>
                            </div>
                            <div class="vstack gap-2">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Eco-Friendly / Pet-Safe Bio</label>
                                    <input class="form-check-input" type="checkbox" id="v-eco" checked>
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Interior & Exterior Scope</label>
                                    <input class="form-check-input" type="checkbox" id="v-scope" checked>
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">12-Month Re-service Warranty</label>
                                    <input class="form-check-input" type="checkbox" id="v-warranty">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="1500" data-p="150">House Ant Treatment</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="2500" data-p="850">Full Termite Protection</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="1000" data-p="1200">Apartment Bed Bug Heat</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 175; --tool-color: #0D9488; --tool-bg: rgba(13, 148, 136, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL TREATMENT ESTIMATE</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-total">$325</div>
                <div class="badge bg-teal-soft text-teal px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-unit">SECURE SHIELD ACTIVE</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Cost Allocation Matrix</h6>
                        <div class="row g-2">
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">BASE SERVICE</div><div class="h5 fw-bold mb-0" id="out-base">$150</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">AREA SCALAR</div><div class="h5 fw-bold mb-0" id="out-area">$75</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">ADD-ONS/ECO</div><div class="h5 fw-bold mb-0" id="out-eco">$50</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">SEVERITY PREMIUM</div><div class="h5 fw-bold mb-0" id="out-sev">$50</div></div></div>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Exterminator Insight</h6>
                            <div class="p-3 rounded-4 bg-teal-50 border border-teal-100 mb-4 text-teal">
                                <i class="fas fa-microscope me-2"></i>
                                <span class="small fw-bold" id="out-advice">Early detection of termites can save homeowners an average of $3,500 in structural repairs.</span>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-teal rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-shield me-2"></i>Copy Service Report
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Parameters
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
    const sqftE = $('v-sqft'), pestE = $('v-pest'), freqE = $('v-freq');
    const ecoE = $('v-eco'), scopeE = $('v-scope'), warrantyE = $('v-warranty');

    function calculate(){
        const sqft = parseFloat(sqftE.value) || 0;
        const base = parseFloat(pestE.value);
        const severity = parseFloat(document.querySelector('input[name="v-level"]:checked').value);
        const freqMult = parseFloat(freqE.value);

        const areaScalar = (sqft / 1000) * 45;
        const ecoPremium = ecoE.checked ? 65 : 0;
        const warrantyCost = warrantyE.checked ? 120 : 0;
        const scopeBonus = scopeE.checked ? 0 : -35;

        const baseTotal = (base + areaScalar + ecoPremium + scopeBonus) * severity * freqMult;
        const grandTotal = baseTotal + warrantyCost;

        $('out-total').textContent = '$' + Math.round(grandTotal).toLocaleString();
        $('out-unit').textContent = freqMult < 1 ? 'PER VISIT ESTIMATE' : 'ONE-TIME SERVICE ESTIMATE';
        
        $('out-base').textContent = '$' + Math.round(base).toLocaleString();
        $('out-area').textContent = '$' + Math.round(areaScalar).toLocaleString();
        $('out-eco').textContent = '$' + Math.round(ecoPremium + warrantyCost).toLocaleString();
        $('out-sev').textContent = severity > 1 ? '$' + Math.round(baseTotal - (base + areaScalar)).toLocaleString() : '$0';

        let adv = "Regular quarterly treatments are recommended for year-round insect exclusion.";
        if(severity > 2) adv = "High infestation detected. Professional inspection and heat/chemical combination likely required.";
        if(base >= 850) adv = "Termite barrier treatment is a long-term property investment. Ensure 5-year guarantee is provided.";
        $('out-advice').textContent = adv;
    }

    [sqftE, pestE, freqE, ecoE, scopeE, warrantyE].forEach(e => e.addEventListener('input', calculate));
    document.querySelectorAll('input[name="v-level"]').forEach(e => e.addEventListener('change', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => { 
            sqftE.value = btn.dataset.s; pestE.value = btn.dataset.p;
            calculate(); 
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Pest Management Estimate\nTarget: ${pestE.options[pestE.selectedIndex].text}\nSeverity: ${document.querySelector('input[name="v-level"]:checked').nextElementSibling.textContent}\nTotal Est: ${$('out-total').textContent}\nGenerated by Bio-Shield Analyst`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Report Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { sqftE.value = 2000; calculate(); });

    calculate();
});
</script>

<style>
.pest-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#134e4a;opacity:.7;margin-bottom:8px;display:block}
.pest-rebuilt .calculator-card { transition: all 0.3s ease; }
.radar-scan { position: relative; animation: scan-pulse 4s infinite linear; }
@keyframes scan-pulse { 0% { box-shadow: 0 0 0 0 rgba(190, 242, 100, 0.4); } 70% { box-shadow: 0 0 0 20px rgba(190, 242, 100, 0); } 100% { box-shadow: 0 0 0 0 rgba(190, 242, 100, 0); } }
.btn-teal { background: #0D9488; color: #fff; transition: all .3s; }
.btn-teal:hover { background: #0F766E; color: #fff; transform: translateY(-2px); }
.btn-outline-teal { color: #0D9488; border: 1px solid #0D9488; }
.btn-check:checked + .btn-outline-teal { background: #0D9488; color: #fff; border-color: #0D9488; }
.bg-teal-soft { background: #F0FDFA; color: #0D9488; }
.bg-teal-50 { background-color: #f7ffff; }
.border-teal { border-color: #99f6e4 !important; }
.text-teal { color: #0D9488 !important; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\pest-control-cost-calculator.blade.php ENDPATH**/ ?>