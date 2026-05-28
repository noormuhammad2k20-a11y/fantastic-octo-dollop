<div class="row g-4 sim-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(59, 130, 246, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #3B82F6, #2563EB); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-magic"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e3a8a; letter-spacing: -0.5px;">FICO Score Simulation Engine</h4>
                    <p class="text-muted small mb-0">Predict the future of your credit. Model complex scenarios like debt consolidation, account closures, or missed payments before they happen.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Base Score --}}
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Current Baseline</h6>
                            <div class="mb-5 text-center">
                                <div class="display-4 fw-900 text-blue mb-2" id="v-base-display">650</div>
                                <input type="range" id="v-base" class="form-range color-blue" min="300" max="850" value="650" step="1">
                                <div class="d-flex justify-content-between px-1 small text-muted">
                                    <span>300 (Poor)</span>
                                    <span>850 (Elite)</span>
                                </div>
                            </div>
                            <div class="vstack gap-2" id="sim-multi-toggles">
                                <label class="form-label-custom">Scenario Modifiers</label>
                                <div class="form-check form-switch p-3 border rounded-3 bg-white mb-2 shadow-sm transition-all sim-toggle-wrap">
                                    <input class="form-check-input" type="checkbox" id="v-high-util" checked>
                                    <label class="form-check-label fw-bold small">Currently Maxed Out? (>90%)</label>
                                </div>
                                <div class="form-check form-switch p-3 border rounded-3 bg-white mb-2 shadow-sm transition-all sim-toggle-wrap">
                                    <input class="form-check-input" type="checkbox" id="v-old-profile">
                                    <label class="form-check-label fw-bold small">Mature Profile? (7+ Years)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-blue">
                            <h6 class="fw-bold small mb-3 uppercase text-blue opacity-70">Simulation Decisons</h6>
                            <div class="row g-3" id="sim-action-grid">
                                {{-- Positive --}}
                                <div class="col-md-6">
                                    <button class="btn btn-outline-blue w-100 p-3 text-start rounded-4 sim-action-btn" data-v="payoff">
                                        <div class="fw-bold small mb-1"><i class="fas fa-check-circle me-1"></i> Pay Off All Cards</div>
                                        <div class="x-small text-muted opacity-70 lh-sm">Eliminate all revolving debt.</div>
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-outline-blue w-100 p-3 text-start rounded-4 sim-action-btn" data-v="limit">
                                        <div class="fw-bold small mb-1"><i class="fas fa-arrow-up me-1"></i> +$10k Limit Increase</div>
                                        <div class="x-small text-muted opacity-70 lh-sm">Request CLI across portfolio.</div>
                                    </button>
                                </div>
                                {{-- Negative --}}
                                <div class="col-md-6">
                                    <button class="btn btn-outline-red w-100 p-3 text-start rounded-4 sim-action-btn" data-v="late">
                                        <div class="fw-bold small mb-1 text-danger"><i class="fas fa-exclamation-triangle me-1"></i> 30-Day Late Pay</div>
                                        <div class="x-small text-muted opacity-70 lh-sm">Miss one payment cycle.</div>
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-outline-red w-100 p-3 text-start rounded-4 sim-action-btn" data-v="close">
                                        <div class="fw-bold small mb-1 text-danger"><i class="fas fa-times-circle me-1"></i> Close Oldest Card</div>
                                        <div class="x-small text-muted opacity-70 lh-sm">Purge credit history anchor.</div>
                                    </button>
                                </div>
                                <div class="col-12 mt-3">
                                    <button class="btn btn-light w-100 rounded-pill py-2 fw-bold text-muted border" id="sim-clear">
                                        <i class="fas fa-undo me-2"></i>Clear All Actions
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 215; --tool-color: #3B82F6; --tool-bg: rgba(59, 130, 246, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">SIMULATED FICO PROJECTION</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-sim-score">650</div>
                <div class="badge bg-blue-soft text-blue px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-delta">NO CHANGE</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Logic Explanation --}}
                    <div class="col-md-8">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Scientific Explanation</h6>
                        <div class="p-4 rounded-4 bg-light-soft border-0" style="background: #f8fafc;">
                            <div class="d-flex gap-3">
                                <div class="text-blue h4 mb-0"><i class="fas fa-microchip"></i></div>
                                <div class="small fw-medium text-dark lh-base" id="out-explanation">
                                    Adjust your baseline score and select actions above to trigger the FICO neural simulation.
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mt-3">
                            <div class="col-md-6">
                                <div class="p-3 rounded-4 bg-blue-50 border border-blue-100 h-100">
                                    <div class="x-small fw-bold text-blue uppercase mb-1">Impact Tier</div>
                                    <div class="fw-black h5 mb-0" id="out-tier">FAIR</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-4 bg-blue-50 border border-blue-100 h-100">
                                    <div class="x-small fw-bold text-blue uppercase mb-1">Volatility Risk</div>
                                    <div class="fw-black h5 mb-0" id="out-vol">LOW</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-4 border-start">
                        <div class="ps-md-4">
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-blue rounded-pill fw-bold text-white shadow-sm py-3 px-5" id="copy-summary">
                                    <i class="fas fa-download me-2"></i>Export Sim Results
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-pill fw-bold" id="reset-calc">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Simulator
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
    const baseE = $('v-base'), highUtilE = $('v-high-util'), oldProfileE = $('v-old-profile');
    let activeActions = new Set();

    function calculate(){
        let base = parseInt(baseE.value) || 650;
        let isHighUtil = highUtilE.checked;
        let isOld = oldProfileE.checked;
        
        $('v-base-display').textContent = base;

        let delta = 0;
        let explanation = "Adjust your baseline score and select actions above to trigger the FICO neural simulation.";

        if(activeActions.size > 0) {
            explanation = "";
            activeActions.forEach(act => {
                if(act === 'payoff') {
                    let boost = isHighUtil ? 45 : 15;
                    delta += boost;
                    explanation += "• Paying off revolving debt eliminates high utilization penalties. ";
                }
                if(act === 'limit') {
                    let boost = isHighUtil ? 15 : 5;
                    delta += boost;
                    explanation += "• A CLI lower your utilization ratio mathematically. ";
                }
                if(act === 'late') {
                    let drop = base > 700 ? 90 : 40;
                    delta -= drop;
                    explanation += "• Missed payments are catastrophic for high scores, wiping out years of progress. ";
                }
                if(act === 'close') {
                    let drop = isOld ? 25 : 10;
                    delta -= drop;
                    explanation += "• Closing an old account shrinks credit age and available limit simultaneously. ";
                }
            });
        }

        let newScore = Math.min(850, Math.max(300, base + delta));
        $('out-sim-score').textContent = newScore;
        
        let deltaText = delta === 0 ? 'NO CHANGE' : (delta > 0 ? '+' + delta : delta) + ' POINTS';
        $('out-delta').textContent = deltaText;
        $('out-delta').className = `badge ${delta >= 0 ? 'bg-blue-soft text-blue' : 'bg-red-soft text-red'} px-4 py-2 rounded-pill fw-bold shadow-sm`;

        let tier = 'FAIR'; let col = '#3B82F6';
        if(newScore >= 800) { tier = 'ELITE'; col = '#10b981'; }
        else if(newScore >= 740) { tier = 'PRIME'; col = '#22c55e'; }
        else if(newScore >= 670) { tier = 'GOOD'; col = '#6366f1'; }
        else if(newScore < 580) { tier = 'POOR'; col = '#ef4444'; }

        $('out-sim-score').style.color = col;
        $('out-tier').textContent = tier;
        $('out-tier').style.color = col;
        $('out-explanation').textContent = explanation || "No significant impact modeled for this configuration.";
        $('out-vol').textContent = activeActions.has('late') ? 'CRITICAL' : (activeActions.size > 1 ? 'MODERATE' : 'LOW');
    }

    [baseE, highUtilE, oldProfileE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.sim-action-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            let v = btn.dataset.v;
            if(activeActions.has(v)) {
                activeActions.delete(v);
                btn.classList.remove('active-sim');
            } else {
                activeActions.add(v);
                btn.classList.add('active-sim');
            }
            calculate();
        });
    });

    $('sim-clear').addEventListener('click', () => {
        activeActions.clear();
        document.querySelectorAll('.sim-action-btn').forEach(b => b.classList.remove('active-sim'));
        calculate();
    });

    $('reset-calc').addEventListener('click', () => {
        baseE.value = 650; highUtilE.checked = true; oldProfileE.checked = false;
        $('sim-clear').click();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `FICO Simulation Projection\nSimulated Score: ${$('out-sim-score').textContent}\nNet Impact: ${$('out-delta').textContent}\nTier: ${$('out-tier').textContent}\nGenerated by ToolsHub SimEngine`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Projection Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.sim-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e3a8a;opacity:.7;margin-bottom:8px;display:block}
.sim-rebuilt .calculator-card { transition: none; }
.btn-blue { background: #3B82F6; color: #fff; }
.btn-blue:hover { background: #2563EB; color: #fff; }
.btn-outline-blue { border-color: #3B82F6; color: #3B82F6; }
.btn-outline-blue:hover, .btn-outline-blue.active-sim { background: #3B82F6; color: #fff; border-color: #3B82F6; }
.btn-outline-red { border-color: #EF4444; color: #EF4444; }
.btn-outline-red:hover, .btn-outline-red.active-sim { background: #EF4444; color: #fff; border-color: #EF4444; }
.text-blue { color: #3B82F6; }
.bg-blue-soft { background: #EFF6FF; }
.bg-red-soft { background: #FEF2F2; }
.text-red { color: #EF4444; }
.bg-blue-50 { background-color: #f8fafc; }
.bg-blue { background-color: #3B82F6 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.x-small { font-size: 0.65rem; }
</style>

