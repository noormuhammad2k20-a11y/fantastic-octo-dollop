<div class="row g-4 risk-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(249, 146, 60, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #FB923C, #C2410C); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-shield-virus"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#431407; letter-spacing: -0.5px;">Underwriting Risk Analyzer</h4>
                    <p class="text-muted small mb-0">Evaluate financial stability and potential default probability using professional underwriting metrics.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Cash Flow Metrics</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Monthly Net Income</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                    <input type="number" id="risk-inc" class="form-control border-0 bg-white fw-bold" value="5000">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Total Monthly Debt (P&I + Others)</label>
                                    <input type="number" id="risk-debt" class="form-control border-0 bg-white rounded-3 fw-bold" value="2000">
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Reserves & History</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Total Liquid Reserves</label>
                                <div class="input-group bg-light rounded-3 border">
                                    <span class="input-group-text border-0 bg-light opacity-40">$</span>
                                    <input type="number" id="risk-sav" class="form-control border-0 bg-light fw-bold" value="10000">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Credit Status</label>
                                    <select id="risk-del" class="form-select border-0 bg-light rounded-3 fw-bold">
                                        <option value="0">Pristine</option>
                                        <option value="1">Minor (30d)</option>
                                        <option value="2">Major (60d+)</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Job Stability (Yrs)</label>
                                    <input type="number" id="risk-tenure" class="form-control border-0 bg-light rounded-3 fw-bold" value="3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-i="8000" data-d="1500" data-s="50000">Prime Profile</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-i="4000" data-d="1800" data-s="2000">Subprime Profile</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 30; --tool-color: #FB923C; --tool-bg: rgba(249, 146, 60, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">OVERALL RISK ASSESSMENT</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-risk-label">MODERATE</div>
                <div class="badge bg-orange-soft text-orange px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-risk-sub">Confidence Score: 78%</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">KEY PERFORMANCE INDICATORS</th>
                                        <th class="text-muted small fw-bold py-3 text-end">RATING</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Debt-to-Income (DTI)</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-dti">0%</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Reserve Ratio (Months)</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-reserves">0 Mo</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Stability Score</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-stability">Strong</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">Default Probability</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-prob">0%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold mb-3 uppercase small opacity-50">Risk Exposure Gauge</h6>
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="small fw-bold">Safe Zone</span>
                                    <span class="small fw-bold">Danger</span>
                                </div>
                                <div class="progress rounded-pill overflow-hidden shadow-sm" style="height: 20px; background: #f1f5f9;">
                                    <div id="bar-risk" class="progress-bar" style="width: 50%; background: linear-gradient(90deg, #10b981, #fbbf24, #ef4444);"></div>
                                </div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-orange rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-shield me-2"></i>Copy Risk Profile
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Analyzer
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
    const incE = $('risk-inc'), debtE = $('risk-debt'), savE = $('risk-sav'),
          delE = $('risk-del'), tenureE = $('risk-tenure');

    function calculate(){
        let inc = parseFloat(incE.value) || 0;
        let debt = parseFloat(debtE.value) || 0;
        let sav = parseFloat(savE.value) || 0;
        let del = parseInt(delE.value) || 0;
        let tenure = parseFloat(tenureE.value) || 0;

        let dti = inc > 0 ? (debt / inc) * 100 : 100;
        let reserves = debt > 0 ? (sav / debt) : (sav > 0 ? 12 : 0);
        
        // Probability Model
        let score = 0;
        if(dti > 45) score += 40; else if(dti > 36) score += 20;
        if(reserves < 1) score += 30; else if(reserves < 3) score += 15;
        if(del === 1) score += 25; else if(del >= 2) score += 50;
        if(tenure < 1) score += 15; else if(tenure >= 5) score -= 10;
        
        score = Math.max(2, Math.min(98, score));
        
        let label = "LOW"; let col = "#10b981";
        if(score > 70) { label = "SEVERE"; col = "#991b1b"; }
        else if(score > 50) { label = "HIGH"; col = "#ef4444"; }
        else if(score > 30) { label = "MODERATE"; col = "#f59e0b"; }

        // Update UI
        $('out-risk-label').textContent = label;
        $('out-risk-label').style.color = col;
        $('out-risk-sub').textContent = `Default Probability: ${score.toFixed(1)}%`;
        
        $('tbl-dti').textContent = dti.toFixed(1) + '%';
        $('tbl-reserves').textContent = reserves.toFixed(1) + ' Mo';
        $('tbl-stability').textContent = tenure >= 3 ? 'Strong' : 'Developing';
        $('tbl-prob').textContent = score.toFixed(1) + '%';
        
        $('bar-risk').style.width = score + '%';
    }

    [incE, debtE, savE, delE, tenureE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            incE.value = btn.dataset.i;
            debtE.value = btn.dataset.d;
            savE.value = btn.dataset.s;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        incE.value = 5000; debtE.value = 2000; savE.value = 10000;
        delE.value = 0; tenureE.value = 3;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Underwriting Risk Profile\nRisk Level: ${$('out-risk-label').textContent}\nDefault Probability: ${$('tbl-prob').textContent}\nDTI: ${$('tbl-dti').textContent}\nGenerated by ToolsHub Risk AI`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.risk-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#431407;opacity:.7;margin-bottom:8px;display:block}
.risk-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-orange { background: #FB923C; color: #fff; transition: all .3s; }
.btn-orange:hover { background: #C2410C; color: #fff; transform: translateY(-2px); }
.text-orange { color: #FB923C; }
.bg-orange-soft { background: #FFF7ED; }
.bg-orange { background-color: #FB923C !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/tools/interactive/loan-default-risk-calculator.blade.php ENDPATH**/ ?>