<div class="row g-4 rebound-modern">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(245, 158, 11, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-amber" style="background: linear-gradient(135deg, #F59E0B, #D97706); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-basketball"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#92400e; letter-spacing: -0.5px;">Rebound Rate Architect</h4>
                    <p class="text-muted small mb-0">Quantify a player's rebounding dominance by calculating the percentage of available boards grabbed.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-amber-50 border border-amber-100 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-amber-800 opacity-70">Player Performance</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Total Rebounds</label>
                                    <input type="number" id="rebounds" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="12" min="0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Minutes Played</label>
                                    <input type="number" id="player_mins" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="32" min="1">
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-slate-50 border border-slate-200 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-slate-700 opacity-70">Team & Game Context</h6>
                            <div class="row g-3">
                                <div class="col-4">
                                    <label class="form-label-custom">Team Mins</label>
                                    <input type="number" id="team_mins" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="240" min="1">
                                </div>
                                <div class="col-4">
                                    <label class="form-label-custom">Team REB</label>
                                    <input type="number" id="team_reb" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="45" min="0">
                                </div>
                                <div class="col-4">
                                    <label class="form-label-custom">Opp REB</label>
                                    <input type="number" id="opp_reb" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="42" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-r="15" data-pm="30" data-tm="240" data-tr="40" data-or="35">Elite Glass Cleaner</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-r="8" data-pm="32" data-tm="240" data-tr="45" data-or="40">Average Forward</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-r="3" data-pm="28" data-tm="240" data-tr="42" data-or="44">Backcourt Guard</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 35; --tool-color: #F59E0B; --tool-bg: rgba(245, 158, 11, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">REBOUND PERCENTAGE</span>
                <div class="output-hero-value display-2 fw-900 my-2 text-amber-900" id="out-rate">17.2%</div>
                <div class="badge bg-amber-soft text-amber px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-grade">ALL-STAR GLASS CLEANER</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-12 text-center">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Cleaning Strength</h6>
                        <div class="position-relative mx-auto mb-3" style="width: 100px; height: 100px;">
                            <i class="fas fa-basketball-hoop fa-5x text-slate-200"></i>
                            <div class="position-absolute bottom-0 start-0 w-100 overflow-hidden" id="glass-fill" style="height: 50%; transition: height 0.5s ease;">
                                <i class="fas fa-basketball-hoop fa-5x text-amber-500"></i>
                            </div>
                        </div>
                        <p class="small text-muted mb-0" id="glass-desc">Strong presence on the boards.</p>
                    </div>

                    <div class="col-md-6 text-center">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-1 uppercase opacity-50">Total Opportunities</h6>
                            <div class="h3 fw-900 mb-0" id="stat-opps">87</div>
                        </div>
                    </div>

                    <div class="col-md-6 text-center">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-1 uppercase opacity-50">Per 36 Extrapolation</h6>
                            <div class="h3 fw-900 mb-0" id="stat-p36">13.5 REB</div>
                        </div>
                    </div>

                    
                    <div class="col-12 border-top pt-4">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto btn-amber rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Player Report
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto btn-outline-dark rounded-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Calculator
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
    const rebIn = $('rebounds'), pmIn = $('player_mins'), tmIn = $('team_mins'), trIn = $('team_reb'), orIn = $('opp_reb');

    function calculate(){
        const r = parseFloat(rebIn.value) || 0;
        const pm = parseFloat(pmIn.value) || 1;
        const tm = parseFloat(tmIn.value) || 240;
        const tr = parseFloat(trIn.value) || 0;
        const or = parseFloat(orIn.value) || 0;

        // Formula: 100 * (REB * (Team_MP / 5)) / (MP * (Team_REB + Opp_REB))
        const rate = 100 * (r * (tm / 5)) / (pm * (tr + or));
        const finalRate = isFinite(rate) ? rate : 0;
        const opps = tr + or;
        const p36 = (r / pm) * 36;

        $('out-rate').textContent = finalRate.toFixed(1) + '%';
        $('stat-opps').textContent = Math.round(opps);
        $('stat-p36').textContent = p36.toFixed(1) + ' REB';

        let grade = '', desc = '', fill = 0;
        if (finalRate >= 20) { grade = 'ELITE GLASS CLEANER'; desc = 'Top-tier board dominance.'; fill = 100; }
        else if (finalRate >= 15) { grade = 'ALL-STAR CLEANER'; desc = 'High-level rebounding presence.'; fill = 75; }
        else if (finalRate >= 10) { grade = 'RELIABLE BOARDER'; desc = 'Solid contribution on the glass.'; fill = 50; }
        else if (finalRate >= 5) { grade = 'ROTATION REBOUNDER'; desc = 'Situational rebounding impact.'; fill = 25; }
        else { grade = 'WEAK ON GLASS'; desc = 'Needs to improve floor positioning.'; fill = 10; }

        $('out-grade').textContent = grade;
        $('glass-desc').textContent = desc;
        $('glass-fill').style.height = fill + '%';
    }

    [rebIn, pmIn, tmIn, trIn, orIn].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            rebIn.value = btn.dataset.r;
            pmIn.value = btn.dataset.pm;
            tmIn.value = btn.dataset.tm;
            trIn.value = btn.dataset.tr;
            orIn.value = btn.dataset.or;
            calculate();
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Basketball Rebounding Report\nRate: ${$('out-rate').textContent}\nGrade: ${$('out-grade').textContent}\nStats: ${rebIn.value} REB in ${pmIn.value} MIN\nGenerated by ToolsHub Sports Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => {
        rebIn.value = 12; pmIn.value = 32; tmIn.value = 240; trIn.value = 45; orIn.value = 42;
        calculate();
    });

    calculate();
});
</script>

<style>
.rebound-modern .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#92400e;opacity:.7;margin-bottom:8px;display:block}
.btn-amber { background: #F59E0B; color: #fff; transition: all .3s; }
.btn-amber:hover { background: #D97706; color: #fff; transform: translateY(-2px); }
.bg-amber-soft { background: #FFFBEB; color: #D97706; }
.bg-amber-50 { background-color: #fffdf5; }
.pulse-amber { animation: amber-pulse 2s infinite; }
@keyframes amber-pulse { 0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(245, 158, 11, 0); } 100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); } }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\rebound-rate-calculator.blade.php ENDPATH**/ ?>