<div class="row g-4 probability-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(244, 63, 94, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #F43F5E, #BE123C); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-dice"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#4c0519; letter-spacing: -0.5px;">Approval Odds & Risk Probability Analyzer</h4>
                    <p class="text-muted small mb-0">Model your "Lender Profile" using credit, income, and DTI metrics. Estimate the probability of approval for various financial products.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Profile Core</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Current Credit Score</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <input type="number" id="v-score" class="form-control border-0 bg-white fw-bold" value="680">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Annual Gross Income ($)</label>
                                    <input type="number" id="v-income" class="form-control border-0 bg-white rounded-3 fw-bold" value="65000">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Monthly Debt Payments ($)</label>
                                    <input type="number" id="v-debt" class="form-control border-0 bg-white rounded-3 fw-bold" value="800">
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-rose">
                            <h6 class="fw-bold small mb-3 uppercase text-rose opacity-70">Lending Scenario</h6>
                            <div class="mb-4">
                                <label class="form-label-custom text-rose">Financial Product Type</label>
                                <select id="v-prod" class="form-select border-0 bg-light rounded-3 fw-bold">
                                    <option value="prime_card">Premium Credit Card (FICO 720+)</option>
                                    <option value="auto">Auto Loan (Secured)</option>
                                    <option value="mortgage">Mortgage (FHA/Conventional)</option>
                                    <option value="personal">Unsecured Personal Loan</option>
                                </select>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Employment Stability</label>
                                    <select id="v-job" class="form-select border-0 bg-light rounded-3 fw-bold">
                                        <option value="2">2+ Years at current job</option>
                                        <option value="1">6-24 Months</option>
                                        <option value="0">Less than 6 months</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="780" data-i="120000">Top Tier Profile</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="620" data-i="45000">Rebuilding Profile</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 345; --tool-color: #F43F5E; --tool-bg: rgba(244, 63, 94, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">APPROVAL PROBABILITY</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-prob">0%</div>
                <div class="badge bg-rose-soft text-rose px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">MODERATE ODDS</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">RISK VECTOR ANALYSIS</th>
                                        <th class="text-muted small fw-bold py-3 text-end">SCORE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">FICO Score Sufficiency</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-fico-res">PASS</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Debt-to-Income (DTI) Ratio</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-dti-res">0%</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">Overall Approval Grade</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-grade">GOOD</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Underwriting Confidence</h6>
                            <div class="mb-4">
                                <div class="progress rounded-pill overflow-hidden shadow-sm" style="height: 15px; background: #f1f5f9;">
                                    <div id="bar-prob" class="progress-bar bg-rose" style="width: 50%"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-1 px-1 small fw-bold text-muted">
                                    <span>Denial</span>
                                    <span>Approval</span>
                                </div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-rose rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-invoice me-2"></i>Copy Approval Profile
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset
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
    const inputs = ['v-score', 'v-income', 'v-debt', 'v-prod', 'v-job'];

    function calculate(){
        let score = parseInt($('v-score').value) || 0;
        let income = parseFloat($('v-income').value) || 1;
        let debt = parseFloat($('v-debt').value) || 0;
        let prod = $('v-prod').value;
        let job = parseInt($('v-job').value);

        let dti = (debt / (income / 12)) * 100;
        $('tbl-dti-res').textContent = dti.toFixed(1) + '%';
        $('tbl-dti-res').style.color = dti > 45 ? '#ef4444' : (dti > 36 ? '#f59e0b' : '#10b981');

        // Risk Engine
        let prob = 0;
        let center = 680;
        if(prod === 'prime_card') center = 720;
        if(prod === 'mortgage') center = 640;
        if(prod === 'auto') center = 600;

        // Base Prob from Score
        prob = 50 + ((score - center) / 2);
        
        // Job Penalty
        if(job === 0) prob -= 20;
        if(job === 1) prob -= 5;

        // DTI Penalty
        if(dti > 50) prob -= 40;
        else if(dti > 40) prob -= 15;

        prob = Math.min(99, Math.max(1, prob));

        // Update UI
        $('out-prob').textContent = Math.round(prob) + '%';
        $('bar-prob').style.width = prob + '%';
        
        let status = ''; let col = '';
        if(prob >= 80) { status = 'EXCELLENT ODDS'; col = '#10b981'; }
        else if(prob >= 60) { status = 'GOOD ODDS'; col = '#22c55e'; }
        else if(prob >= 40) { status = 'MODERATE'; col = '#f59e0b'; }
        else { status = 'LOW PROBABILITY'; col = '#ef4444'; }

        $('out-status').textContent = status;
        $('out-status').style.color = col;
        $('tbl-grade').textContent = status.split(' ')[0];
        $('tbl-grade').style.color = col;
        $('bar-prob').style.backgroundColor = col;

        $('tbl-fico-res').textContent = score >= center ? 'PASS' : 'WEAK';
        $('tbl-fico-res').style.color = score >= center ? '#10b981' : '#ef4444';
    }

    inputs.forEach(id => $(id).addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            $('v-score').value = btn.dataset.s;
            $('v-income').value = btn.dataset.i;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        $('v-score').value = 680; $('v-income').value = 65000; $('v-debt').value = 800;
        $('v-prod').value = 'prime_card'; $('v-job').value = '2';
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Approval Probability Analysis\nOdds: ${$('out-prob').textContent}\nStatus: ${$('out-status').textContent}\nDTI: ${$('tbl-dti-res').textContent}\nGenerated by ToolsHub Risk AI`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Profile Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.probability-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#4c0519;opacity:.7;margin-bottom:8px;display:block}
.probability-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-rose { background: #F43F5E; color: #fff; transition: all .3s; }
.btn-rose:hover { background: #BE123C; color: #fff; transform: translateY(-2px); }
.text-rose { color: #F43F5E; }
.text-rose-900 { color: #4c0519; }
.bg-rose-soft { background: #FFF1F2; }
.bg-rose { background-color: #F43F5E !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\credit-risk-probability-calculator.blade.php ENDPATH**/ ?>