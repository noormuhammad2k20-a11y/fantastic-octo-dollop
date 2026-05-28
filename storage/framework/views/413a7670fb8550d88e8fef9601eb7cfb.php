<div class="row g-4 gap-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(245, 158, 11, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #F59E0B, #D97706); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-arrows-alt-h"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#451a03; letter-spacing: -0.5px;">Utilization Gap & Score Booster</h4>
                    <p class="text-muted small mb-0">Identify the exact "Gap" between your current utilization and your scoring goals. Calculate the required capital to unlock your next credit tier.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Current Standing</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Total Combined Limits</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                    <input type="number" id="v-lim" class="form-control border-0 bg-white fw-bold" value="15000">
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom text-danger">Total Outstanding Balances</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                    <input type="number" id="v-bal" class="form-control border-0 bg-white fw-bold text-danger" value="7500">
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-orange">
                            <h6 class="fw-bold small mb-3 uppercase text-orange opacity-70">Gap Target</h6>
                            <div class="mb-5 text-center">
                                <div class="display-5 fw-900 text-orange mb-2" id="v-goal-display">10%</div>
                                <input type="range" id="v-goal" class="form-range color-orange" min="1" max="90" value="10" step="1">
                                <div class="d-flex justify-content-between px-1 small text-muted">
                                    <span>AZEO (1%)</span>
                                    <span>Risky (90%)</span>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom text-orange">Current FICO Score (Est.)</label>
                                <input type="number" id="v-score" class="form-control border-0 bg-light rounded-3 fw-bold" value="680">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-g="1">Target AZEO (1%)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-g="28.9">Standard Threshold (28.9%)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-g="8.9">Elite Benchmark (8.9%)</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 35; --tool-color: #F59E0B; --tool-bg: rgba(245, 158, 11, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">REQUIRED CAPITAL INJECTION</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-gap">$0</div>
                <div class="badge bg-orange-soft text-orange px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-boost">ESTIMATED BOOST: +0 PTS</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">GAP ANALYSIS</th>
                                        <th class="text-muted small fw-bold py-3 text-end">METRICS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Current Utilization Ratio</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-util">0%</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Maximum Allowed Target Balance</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-tar-bal">$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">FICO Multiplier Risk</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-risk">LOW</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Strategic Advice</h6>
                            <div class="p-3 rounded-4 bg-orange-50 border border-orange-100 mb-4">
                                <div class="small fw-bold text-orange-900 lh-base" id="out-advice">Loading profile data...</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-orange rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-export me-2"></i>Copy Paydown Blueprint
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
    const limE = $('v-lim'), balE = $('v-bal'), goalE = $('v-goal'), scoreE = $('v-score');

    function calculate(){
        let lim = parseFloat(limE.value) || 1;
        let bal = parseFloat(balE.value) || 0;
        let goal = parseInt(goalE.value) || 10;
        let score = parseInt(scoreE.value) || 650;

        $('v-goal-display').textContent = goal + '%';

        let ur = (bal / lim) * 100;
        let targetBal = lim * (goal / 100);
        let gap = Math.max(0, bal - targetBal);

        // Score Impact Model
        let delta = ur - goal;
        let boost = 0;
        if(delta > 50) boost = 65; else if(delta > 30) boost = 40; else if(delta > 10) boost = 15; else if(delta > 5) boost = 8;

        // Update UI
        $('out-gap').textContent = '$' + Math.round(gap).toLocaleString();
        $('out-boost').textContent = `ESTIMATED BOOST: +${boost} TO +${boost+15} PTS`;
        $('tbl-util').textContent = ur.toFixed(1) + '%';
        $('tbl-tar-bal').textContent = '$' + Math.round(targetBal).toLocaleString();

        let risk = 'LOW'; let col = '#10b981';
        if(ur >= 60) { risk = 'CRITICAL'; col = '#ef4444'; }
        else if(ur >= 30) { risk = 'MODERATE'; col = '#f59e0b'; }
        $('tbl-risk').textContent = risk;
        $('tbl-risk').style.color = col;

        let advice = '';
        if(gap > 0) advice = `You need to inject ${$('out-gap').textContent} into your debt to cross the ${goal}% threshold and unlock significant scoring potential.`;
        else advice = "You have already optimized this gap! Any further paydowns will have diminishing returns on your FICO score.";
        $('out-advice').textContent = advice;
    }

    [limE, balE, goalE, scoreE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            goalE.value = btn.dataset.g;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        limE.value = 15000; balE.value = 7500; goalE.value = 10; scoreE.value = 680;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Utilization Gap Blueprint\nRequired Paydown: ${$('out-gap').textContent}\nTarget Ratio: ${goalE.value}%\nProjected Boost: ${$('out-boost').textContent}\nGenerated by ToolsHub Gap Analyzer`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Blueprint Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.gap-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#451a03;opacity:.7;margin-bottom:8px;display:block}
.gap-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-orange { background: #F59E0B; color: #fff; transition: all .3s; }
.btn-orange:hover { background: #D97706; color: #fff; transform: translateY(-2px); }
.text-orange { color: #F59E0B; }
.text-orange-900 { color: #451a03; }
.bg-orange-soft { background: #FFFBEB; }
.bg-orange-50 { background-color: #fffcf0; }
.bg-orange { background-color: #F59E0B !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.color-orange::-webkit-slider-thumb { background: #F59E0B; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\credit-utilization-ratio.blade.php ENDPATH**/ ?>