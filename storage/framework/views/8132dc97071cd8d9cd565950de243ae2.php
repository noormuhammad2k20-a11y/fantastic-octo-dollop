<div class="row g-4 usage-modern">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(239, 68, 68, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-red" style="background: linear-gradient(135deg, #EF4444, #B91C1C); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-fire"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#7f1d1d; letter-spacing: -0.5px;">Usage Rate Architect</h4>
                    <p class="text-muted small mb-0">Quantify a player's offensive footprint by measuring the percentage of team plays they conclude.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-red-50 border border-red-100 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-red-800 opacity-70">Individual Workload</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">FGA</label>
                                    <input type="number" id="fga" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="18" min="0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">FTA</label>
                                    <input type="number" id="fta" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="6" min="0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Turnovers</label>
                                    <input type="number" id="to" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="3" min="0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Minutes</label>
                                    <input type="number" id="player_mins" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="34" min="1">
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-slate-50 border border-slate-200 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-slate-700 opacity-70">Team Opportunity</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Team FGA</label>
                                    <input type="number" id="team_fga" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="88" min="0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Team FTA</label>
                                    <input type="number" id="team_fta" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="22" min="0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Team TO</label>
                                    <input type="number" id="team_to" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="14" min="0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Team Mins</label>
                                    <input type="number" id="team_mins" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="240" min="1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-fga="24" data-fta="10" data-to="5" data-pm="34" data-tf="88" data-tf2="22" data-tt="15" data-tm="240">Westbrook '17 (41.7%)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-fga="27" data-fta="10" data-to="3" data-pm="40" data-tf="80" data-tf2="25" data-tt="12" data-tm="240">Kobe '06 (38.7%)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-fga="18" data-fta="6" data-to="3" data-pm="34" data-tf="90" data-tf2="20" data-tt="14" data-tm="240">All-Star (28.4%)</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 0; --tool-color: #EF4444; --tool-bg: rgba(239, 68, 68, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">USAGE PERCENTAGE (USG%)</span>
                <div class="output-hero-value display-2 fw-900 my-2 text-red-900" id="out-usage">28.4%</div>
                <div class="badge bg-red-soft text-red px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-role">PRIMARY OFFENSIVE OPTION</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-12 text-center">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Court Gravity</h6>
                        <div class="gravity-viz mx-auto mb-3 d-flex align-items-center justify-content-center" id="gravity-circle" style="width: 120px; height: 120px; border-radius: 50%; border: 2px dashed #EF4444; transition: all 0.5s ease;">
                            <i class="fas fa-fire fa-3x text-red-500" id="gravity-icon"></i>
                        </div>
                        <p class="small text-muted mb-0" id="gravity-desc">High gravity — Defense must stay attached.</p>
                    </div>

                    <div class="col-md-6 text-center">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-1 uppercase opacity-50">Possession Ending Plays</h6>
                            <div class="h3 fw-900 mb-0" id="stat-plays">23.6</div>
                        </div>
                    </div>

                    <div class="col-md-6 text-center">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-1 uppercase opacity-50">Team Possession Share</h6>
                            <div class="h3 fw-900 mb-0" id="stat-share">1/4.2</div>
                        </div>
                    </div>

                    
                    <div class="col-12 border-top pt-4">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto btn-red rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Usage Report
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
    const inputs = ['fga', 'fta', 'to', 'player_mins', 'team_fga', 'team_fta', 'team_to', 'team_mins'];

    function calculate(){
        const fga = parseFloat($('fga').value) || 0;
        const fta = parseFloat($('fta').value) || 0;
        const to = parseFloat($('to').value) || 0;
        const pm = parseFloat($('player_mins').value) || 1;
        
        const tfga = parseFloat($('team_fga').value) || 1;
        const tfta = parseFloat($('team_fta').value) || 1;
        const tto = parseFloat($('team_to').value) || 1;
        const tm = parseFloat($('team_mins').value) || 240;

        // Formula: 100 * ((FGA + 0.44 * FTA + TO) * (Team_MP / 5)) / (MP * (Team_FGA + 0.44 * Team_FTA + Team_TO))
        const playerFactor = fga + (0.44 * fta) + to;
        const teamFactor = tfga + (0.44 * tfta) + tto;
        
        const usage = 100 * (playerFactor * (tm / 5)) / (pm * teamFactor);
        const finalUsage = isFinite(usage) ? usage : 0;

        $('out-usage').textContent = finalUsage.toFixed(1) + '%';
        $('stat-plays').textContent = playerFactor.toFixed(1);
        $('stat-share').textContent = '1 / ' + (teamFactor / playerFactor).toFixed(1);

        let role = '', gravity = '', scale = 1, opacity = 0.5;
        if (finalUsage >= 35) { role = 'HISTORIC USAGE'; gravity = 'Extreme — Entire offense runs through player.'; scale = 1.4; opacity = 1; }
        else if (finalUsage >= 30) { role = 'ELITE OFFENSIVE ENGINE'; gravity = 'High — Defense must rotate constantly.'; scale = 1.25; opacity = 0.8; }
        else if (finalUsage >= 25) { role = 'PRIMARY OPTION'; gravity = 'Significant — Key focal point.'; scale = 1.1; opacity = 0.6; }
        else if (finalUsage >= 20) { role = 'CORE ROTATION'; gravity = 'Standard — Active participant.'; scale = 1.0; opacity = 0.4; }
        else { role = 'SUPPORTING ROLE'; gravity = 'Low — Offense flows elsewhere.'; scale = 0.8; opacity = 0.2; }

        $('out-role').textContent = role;
        $('gravity-desc').textContent = gravity;
        $('gravity-circle').style.transform = `scale(${scale})`;
        $('gravity-icon').style.opacity = opacity;
    }

    inputs.forEach(id => $(id).addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            $('fga').value = btn.dataset.fga;
            $('fta').value = btn.dataset.fta;
            $('to').value = btn.dataset.to;
            $('player_mins').value = btn.dataset.pm;
            $('team_fga').value = btn.dataset.tf;
            $('team_fta').value = btn.dataset.tf2;
            $('team_to').value = btn.dataset.tt;
            $('team_mins').value = btn.dataset.tm;
            calculate();
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Basketball Usage Report\nUSG%: ${$('out-usage').textContent}\nRole: ${$('out-role').textContent}\nGenerated by ToolsHub Sports Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => {
        $('fga').value = 18; $('fta').value = 6; $('to').value = 3; $('player_mins').value = 34;
        $('team_fga').value = 88; $('team_fta').value = 22; $('team_to').value = 14; $('team_mins').value = 240;
        calculate();
    });

    calculate();
});
</script>

<style>
.usage-modern .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#7f1d1d;opacity:.7;margin-bottom:8px;display:block}
.btn-red { background: #EF4444; color: #fff; transition: all .3s; }
.btn-red:hover { background: #B91C1C; color: #fff; transform: translateY(-2px); }
.bg-red-soft { background: #FEF2F2; color: #EF4444; }
.bg-red-50 { background-color: #fffafb; }
.gravity-viz { transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
.pulse-red { animation: red-pulse 2s infinite; }
@keyframes red-pulse { 0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); } 100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); } }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/tools/interactive/usage-rate-calculator.blade.php ENDPATH**/ ?>