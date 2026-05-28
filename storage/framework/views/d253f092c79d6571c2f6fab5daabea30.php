<div class="row g-4 forge-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(185, 28, 28, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm press-motion" style="background: linear-gradient(135deg, #B91C1C, #7F1D1D); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-microchip"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#450a0a; letter-spacing: -0.5px;">Industrial Forge: Molding Analyst</h4>
                    <p class="text-muted small mb-0">High-fidelity manufacturing cost modeling. Factor in multi-cavity tooling, resin market rates, and machine cycle efficiency.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Production Dynamics</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom">Order Quantity</label>
                                    <div class="input-group">
                                        <input type="number" id="v-qty" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="5000">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">UNITS</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Mold Cavitation</label>
                                    <select id="v-cav" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                        <option value="1">1-Cavity (Single)</option>
                                        <option value="2">2-Cavity</option>
                                        <option value="4" selected>4-Cavity (High Vol)</option>
                                        <option value="8">8-Cavity (Enterprise)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Material Resin</label>
                                    <select id="v-mat" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                        <option value="2.50">ABS (General Purpose)</option>
                                        <option value="1.80">PP (Polypropylene)</option>
                                        <option value="4.20">PC (Polycarbonate)</option>
                                        <option value="5.50">Nylon (Glass Filled)</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Part Weight (Grams)</label>
                                    <div class="input-group">
                                        <input type="number" id="v-weight" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="25">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">G</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-red">
                            <h6 class="fw-bold small mb-3 uppercase text-red opacity-70">Tooling & Cycle</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Mold Tooling Type</label>
                                <select id="v-tooling" class="form-select border-0 bg-light rounded-3 fw-bold py-2">
                                    <option value="8000">Aluminum (Proto / 10k Cycles)</option>
                                    <option value="15000" selected>P20 Steel (50k Cycles)</option>
                                    <option value="35000">H13 Hardened (500k+ Cycles)</option>
                                </select>
                            </div>
                            <div class="vstack gap-2">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Tight Tolerance Requirement</label>
                                    <input class="form-check-input" type="checkbox" id="v-tol">
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Overmolding / Insertion</label>
                                    <input class="form-check-input" type="checkbox" id="v-over">
                                </div>
                                <hr class="my-1 opacity-10">
                                <div class="p-3 rounded-3 bg-red-50 border border-red-100 text-center">
                                    <div class="small fw-bold text-red-900">EST. UNIT COST</div>
                                    <div class="h5 fw-900 text-red-900 mb-0" id="out-unit-cost">$0.85</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-q="1000" data-w="10" data-t="8000">Proto Production</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-q="50000" data-w="30" data-t="15000">Consumer Mass Run</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-q="500000" data-w="100" data-t="35000">Enterprise Scale</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 0; --tool-color: #B91C1C; --tool-bg: rgba(185, 28, 28, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL MANUFACTURING INVESTMENT</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-total">$19,250</div>
                <div class="badge bg-red-soft text-red px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-amort">AMORTIZED OVER 5,000 UNITS</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Cost Distribution Matrix</h6>
                        <div class="row g-2">
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">MOLD TOOLING (CAPEX)</div><div class="h5 fw-bold mb-0" id="out-tooling-cost">$15,000</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">RAW RESIN</div><div class="h5 fw-bold mb-0" id="out-resin">$1,250</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">MACHINE OPEX</div><div class="h5 fw-bold mb-0" id="out-machine">$3,000</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">BREAK-EVEN UNIT</div><div class="h5 fw-bold mb-0" id="out-be">#4200</div></div></div>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Forge Insight</h6>
                            <div class="p-3 rounded-4 bg-red-50 border border-red-100 mb-4 text-red">
                                <i class="fas fa-industry me-2"></i>
                                <span class="small fw-bold" id="out-advice">High cavitation (4+) significantly reduces machine time but increases initial tooling Capex.</span>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-red rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-microchip me-2"></i>Copy Build Sheet
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Forge
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
    const qtyE = $('v-qty'), cavE = $('v-cav'), matE = $('v-mat'), weightE = $('v-weight'), toolE = $('v-tooling');
    const tolE = $('v-tol'), overE = $('v-over');

    function calculate(){
        const qty = parseFloat(qtyE.value) || 0;
        const cav = parseFloat(cavE.value);
        const matRate = parseFloat(matE.value);
        const weight = parseFloat(weightE.value) || 0;
        const toolBase = parseFloat(toolE.value);

        // Tooling Cost (Scales slightly with cavitation)
        const toolingTotal = toolBase * (1 + (cav - 1) * 0.15);
        
        // Material Cost
        const resinTotal = (qty * weight / 1000) * matRate * 1.05; // 5% scrap
        
        // Machine Time Cost ($65/hr base)
        const cycleTime = 20 + (weight / 5); // Secs per shot
        const totalShots = qty / cav;
        const totalMachineHrs = (totalShots * cycleTime) / 3600;
        let machineRate = 65;
        if(tolE.checked) machineRate += 15;
        if(overE.checked) machineRate += 25;
        
        const opexTotal = totalMachineHrs * machineRate;
        const grandTotal = toolingTotal + resinTotal + opexTotal;
        const unitCost = grandTotal / (qty || 1);

        $('out-total').textContent = '$' + Math.round(grandTotal).toLocaleString();
        $('out-unit-cost').textContent = '$' + unitCost.toFixed(3);
        $('out-amort').textContent = `AMORTIZED OVER ${qty.toLocaleString()} UNITS`;
        
        $('out-tooling-cost').textContent = '$' + Math.round(toolingTotal).toLocaleString();
        $('out-resin').textContent = '$' + Math.round(resinTotal).toLocaleString();
        $('out-machine').textContent = '$' + Math.round(opexTotal).toLocaleString();
        
        // Break-even (Target unit cost $1.50)
        const beUnit = toolingTotal / (1.50 - (unitCost - toolingTotal/qty));
        $('out-be').textContent = '#' + Math.max(0, Math.round(beUnit)).toLocaleString();

        let adv = "Standard production run. P20 Steel mold recommended for durability.";
        if(qty > 100000 && cav < 4) adv = "Warning: High volume detected with low cavitation. Increasing cavitation could save significant machine time.";
        if(tolE.checked) adv = "Tight tolerance selected. Ensure your mold maker uses H13 hardened steel for thermal stability.";
        $('out-advice').textContent = adv;
    }

    [qtyE, cavE, matE, weightE, toolE, tolE, overE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => { 
            qtyE.value = btn.dataset.q; weightE.value = btn.dataset.w; toolE.value = btn.dataset.t;
            calculate(); 
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Injection Molding Build Sheet\nQuantity: ${qtyE.value} UNITS\nUnit Cost: ${$('out-unit-cost').textContent}\nTotal Est: ${$('out-total').textContent}\nGenerated by Industrial Forge Molding Analyst`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Build Sheet Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { qtyE.value = 5000; calculate(); });

    calculate();
});
</script>

<style>
.forge-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#450a0a;opacity:.7;margin-bottom:8px;display:block}
.forge-rebuilt .calculator-card { transition: all 0.3s ease; }
.press-motion { animation: forge-press 4s infinite ease-in-out; }
@keyframes forge-press { 0%, 100% { transform: scale(1); } 50% { transform: scale(0.9) translateY(2px); } }
.btn-red { background: #B91C1C; color: #fff; transition: all .3s; }
.btn-red:hover { background: #991B1B; color: #fff; transform: translateY(-2px); }
.bg-red-soft { background: #FEF2F2; color: #B91C1C; }
.bg-red-50 { background-color: #fffafb; }
.border-red { border-color: #fecaca !important; }
.text-red { color: #B91C1C !important; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\injection-molding-cost-calculator.blade.php ENDPATH**/ ?>