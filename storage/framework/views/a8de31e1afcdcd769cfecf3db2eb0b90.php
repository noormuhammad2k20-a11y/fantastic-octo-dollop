<div class="row g-4 tracker-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(139, 92, 246, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #8B5CF6, #6D28D9); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#2e1065; letter-spacing: -0.5px;">FICO Scoring Architecture Tracker</h4>
                    <p class="text-muted small mb-0">Decode the 5 pillars of your credit score. Model how payment history, utilization, and account age interact to determine your lending tier.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Core Pillars (65%)</h6>
                            <div class="mb-4">
                                <label class="form-label-custom text-danger">Missed Payments (Last 24 Mo)</label>
                                <input type="number" id="v-miss" class="form-control border-0 bg-white rounded-3 fw-bold text-danger h4 py-2" value="0">
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Total Combined Limits</label>
                                    <input type="number" id="v-lim" class="form-control border-0 bg-white rounded-3 fw-bold" value="30000">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Total Combined Balances</label>
                                    <input type="number" id="v-bal" class="form-control border-0 bg-white rounded-3 fw-bold" value="3000">
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-purple">
                            <h6 class="fw-bold small mb-3 uppercase text-purple opacity-70">Secondary Pillars (35%)</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom">Avg Account Age (Yrs)</label>
                                    <input type="number" id="v-age" class="form-control border-0 bg-light rounded-3 fw-bold" value="6">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Hard Inq (12 Mo)</label>
                                    <input type="number" id="v-inq" class="form-control border-0 bg-light rounded-3 fw-bold" value="1">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label-custom">Credit Mix Quality</label>
                                <select id="v-mix" class="form-select border-0 bg-light rounded-3 fw-bold">
                                    <option value="1">Sparse (Cards only)</option>
                                    <option value="2">Balanced (Cards + Auto/Student)</option>
                                    <option value="3">Advanced (Cards + Installment + Mortgage)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-p="850">850 Elite Profile</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-p="740">740 Prime Profile</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-p="util">Utilization Crash</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-p="miss">Missed Payment Impact</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 260; --tool-color: #8B5CF6; --tool-bg: rgba(139, 92, 246, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">ESTIMATED FICO RANGE</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-score">740-780</div>
                <div class="badge bg-purple-soft text-purple px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-verdict">PRIME TIER</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Scoring Pillar Health</h6>
                        <div class="vstack gap-3" id="pillar-bars">
                            
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Critical Risk Profile</h6>
                            <div class="p-3 rounded-4 bg-purple-50 border border-purple-100 mb-4">
                                <div class="small fw-bold text-purple-900" id="out-risk">No major risks detected. Profile is healthy.</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-purple rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-invoice me-2"></i>Copy Score Blueprint
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
    const inputs = ['v-miss', 'v-lim', 'v-bal', 'v-age', 'v-inq', 'v-mix'];

    function renderPillar(label, pct, col){
        return `
            <div class="mb-1">
                <div class="d-flex justify-content-between mb-1">
                    <span class="small fw-bold text-muted">${label}</span>
                    <span class="small fw-bold" style="color:${col}">${pct}%</span>
                </div>
                <div class="progress rounded-pill overflow-hidden" style="height: 8px; background: #f1f5f9;">
                    <div class="progress-bar" style="width: ${pct}%; background: ${col};"></div>
                </div>
            </div>
        `;
    }

    function calculate(){
        let miss = parseInt($('v-miss').value) || 0;
        let lim = parseFloat($('v-lim').value) || 1;
        let bal = parseFloat($('v-bal').value) || 0;
        let age = parseFloat($('v-age').value) || 0;
        let inq = parseInt($('v-inq').value) || 0;
        let mix = parseInt($('v-mix').value);

        let util = (bal / lim) * 100;
        let base = 850;
        
        // Penalties
        let pHist = miss * 75;
        let pUtil = util > 90 ? 100 : (util > 50 ? 60 : (util > 30 ? 30 : (util > 10 ? 10 : 0)));
        let pAge = age >= 10 ? 0 : (age >= 5 ? 15 : (age >= 2 ? 40 : 60));
        let pInq = inq * 5;
        let pMix = mix === 3 ? 0 : (mix === 2 ? 15 : 40);

        let final = Math.max(300, base - pHist - pUtil - pAge - pInq - pMix);
        $('out-score').textContent = (final - 10) + ' - ' + (final + 10);

        let verdict = 'SUBPRIME'; let col = '#ef4444';
        if(final >= 800) { verdict = 'ELITE'; col = '#10b981'; }
        else if(final >= 740) { verdict = 'PRIME'; col = '#22c55e'; }
        else if(final >= 670) { verdict = 'GOOD'; col = '#6366f1'; }
        else if(final >= 580) { verdict = 'FAIR'; col = '#f59e0b'; }

        $('out-verdict').textContent = verdict + ' TIER';
        $('out-verdict').style.color = col;
        $('out-score').style.color = col;

        // Risk
        let risk = "No major risks detected.";
        if(miss > 0) risk = "CRITICAL: Recent missed payments are the single largest factor suppressing your score.";
        else if(util > 30) risk = "WARNING: High utilization is causing significant scoring penalties. Pay down balances below 10%.";
        $('out-risk').textContent = risk;

        // Pillars
        let html = '';
        html += renderPillar('Payment History (35%)', Math.max(0, 100 - (miss * 25)), miss > 0 ? '#ef4444' : '#10b981');
        html += renderPillar('Amounts Owed (30%)', Math.max(0, 100 - util), util > 30 ? '#f59e0b' : '#10b981');
        html += renderPillar('Length of History (15%)', Math.min(100, (age / 10) * 100), age < 3 ? '#f59e0b' : '#10b981');
        html += renderPillar('Credit Mix (10%)', (mix/3)*100, mix < 2 ? '#f59e0b' : '#10b981');
        html += renderPillar('New Credit (10%)', Math.max(0, 100 - (inq * 10)), inq > 2 ? '#f59e0b' : '#10b981');
        $('pillar-bars').innerHTML = html;
    }

    inputs.forEach(id => $(id).addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            let p = btn.dataset.p;
            if(p === '850') { $('v-miss').value=0; $('v-lim').value=100000; $('v-bal').value=500; $('v-age').value=15; $('v-inq').value=0; $('v-mix').value=3; }
            if(p === 'util') { $('v-miss').value=0; $('v-lim').value=10000; $('v-bal').value=9500; $('v-age').value=5; $('v-inq').value=0; $('v-mix').value=2; }
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        $('v-miss').value=0; $('v-lim').value=30000; $('v-bal').value=3000; $('v-age').value=6; $('v-inq').value=1; $('v-mix').value=2;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `FICO Scoring Blueprint\nRange: ${$('out-score').textContent}\nTier: ${$('out-verdict').textContent}\nRisk: ${$('out-risk').textContent}\nGenerated by ToolsHub Architecture Pro`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Blueprint Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.tracker-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#2e1065;opacity:.7;margin-bottom:8px;display:block}
.tracker-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-purple { background: #8B5CF6; color: #fff; transition: all .3s; }
.btn-purple:hover { background: #6D28D9; color: #fff; transform: translateY(-2px); }
.text-purple { color: #8B5CF6; }
.text-purple-900 { color: #2e1065; }
.bg-purple-soft { background: #F5F3FF; }
.bg-purple-50 { background-color: #fdfaff; }
.bg-purple { background-color: #8B5CF6 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\credit-score-tracker.blade.php ENDPATH**/ ?>