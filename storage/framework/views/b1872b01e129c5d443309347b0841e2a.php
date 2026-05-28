<div class="row g-4 war-modern">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(79, 70, 229, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-indigo" style="background: linear-gradient(135deg, #4F46E5, #3730A3); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-shield-cat"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e1b4b; letter-spacing: -0.5px;">WAR Value Architect</h4>
                    <p class="text-muted small mb-0">Estimate a player's Wins Above Replacement by aggregating offensive and defensive contributions.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-indigo-50 border border-indigo-100 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-indigo-800 opacity-70">Offensive Value</h6>
                            <div class="mb-3">
                                <label class="form-label-custom">Batting Runs</label>
                                <input type="number" id="batting" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="25" step="0.1">
                            </div>
                            <div>
                                <label class="form-label-custom">Baserunning Runs</label>
                                <input type="number" id="base" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="2" step="0.1">
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-emerald-50 border border-emerald-100 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-emerald-800 opacity-70">Defensive Value</h6>
                            <div class="mb-3">
                                <label class="form-label-custom">Fielding Runs</label>
                                <input type="number" id="fielding" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="5" step="0.1">
                            </div>
                            <div>
                                <label class="form-label-custom">Positional Adj.</label>
                                <input type="number" id="pos" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="2.5" step="0.1">
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-slate-50 border border-slate-200 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-slate-700 opacity-70">League Adjustments</h6>
                            <div class="mb-3">
                                <label class="form-label-custom">League Runs</label>
                                <input type="number" id="league" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="1.5" step="0.1">
                            </div>
                            <div>
                                <label class="form-label-custom">Replacement Runs</label>
                                <input type="number" id="rep" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="15" step="0.1">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-bat="65.4" data-base="1.2" data-f="0.8" data-p="2.5" data-l="4.2" data-r="21.5">Judge '22 (10.6)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-bat="58.2" data-base="3.5" data-f="-10.5" data-p="-12.5" data-l="5.1" data-r="25.0">Ohtani '23 (10.0)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-bat="20.0" data-base="1.0" data-f="5.0" data-p="2.5" data-l="1.5" data-r="15.0">All-Star (4.5)</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 245; --tool-color: #4F46E5; --tool-bg: rgba(79, 70, 229, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">ESTIMATED PLAYER VALUE</span>
                <div class="output-hero-value display-1 fw-900 my-2 text-indigo-900" id="out-war">5.1</div>
                <div class="badge bg-indigo-soft text-indigo px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-tier">ALL-STAR LEVEL</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-12">
                        <h6 class="fw-bold small mb-3 uppercase text-center opacity-50">Value Comparison Scale</h6>
                        <div class="position-relative mb-4 pt-2">
                            <div class="progress rounded-pill shadow-sm overflow-hidden" style="height: 12px;">
                                <div class="progress-bar bg-slate-300" style="width: 20%"></div>
                                <div class="progress-bar bg-blue-400" style="width: 20%"></div>
                                <div class="progress-bar bg-indigo-500" style="width: 20%"></div>
                                <div class="progress-bar bg-purple-600" style="width: 20%"></div>
                                <div class="progress-bar bg-amber-500" style="width: 20%"></div>
                            </div>
                            <div class="position-absolute top-0" id="war-marker" style="left: 51%; transform: translateX(-50%); transition: left 0.5s ease;">
                                <div class="bg-indigo-900 text-white px-2 py-1 rounded-pill small fw-bold shadow">▼</div>
                            </div>
                            <div class="d-flex justify-content-between mt-2 small fw-bold opacity-50 px-1">
                                <span>Repl</span>
                                <span>Starter</span>
                                <span>All-Star</span>
                                <span>MVP</span>
                                <span>Historic</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 text-center">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-1 uppercase opacity-50">Total Runs Above Average</h6>
                            <div class="h3 fw-900 mb-0" id="stat-runs">36.5</div>
                        </div>
                    </div>

                    <div class="col-md-6 text-center">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-1 uppercase opacity-50">Win Conversion Ratio</h6>
                            <div class="h3 fw-900 mb-0">10:1</div>
                            <small class="text-muted">Runs to Win ratio</small>
                        </div>
                    </div>

                    
                    <div class="col-12 border-top pt-4">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <button class="btn d-block mx-auto btn-indigo rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Sabermetric Summary
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
    const inputs = ['batting', 'base', 'fielding', 'pos', 'league', 'rep'];

    function calculate(){
        const bat = parseFloat($('batting').value) || 0;
        const base = parseFloat($('base').value) || 0;
        const fld = parseFloat($('fielding').value) || 0;
        const pos = parseFloat($('pos').value) || 0;
        const lea = parseFloat($('league').value) || 0;
        const rep = parseFloat($('rep').value) || 0;

        const totalRuns = bat + base + fld + pos + lea + rep;
        const war = totalRuns / 10; // Standard 10 runs = 1 win approximation

        $('out-war').textContent = war.toFixed(1);
        $('stat-runs').textContent = totalRuns.toFixed(1);

        let tier = '', markerPos = 0;
        if (war >= 8) { tier = 'MVP / LEGENDARY'; markerPos = 90; }
        else if (war >= 5) { tier = 'ALL-STAR LEVEL'; markerPos = 70; }
        else if (war >= 2) { tier = 'SOLID STARTER'; markerPos = 50; }
        else if (war >= 0) { tier = 'ROTATION / BENCH'; markerPos = 30; }
        else { tier = 'BELOW REPLACEMENT'; markerPos = 10; }

        $('out-tier').textContent = tier;
        $('war-marker').style.left = markerPos + '%';
    }

    inputs.forEach(id => $(id).addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            $('batting').value = btn.dataset.bat;
            $('base').value = btn.dataset.base;
            $('fielding').value = btn.dataset.f;
            $('pos').value = btn.dataset.p;
            $('league').value = btn.dataset.l;
            $('rep').value = btn.dataset.r;
            calculate();
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Sabermetric WAR Report\nValue: ${$('out-war').textContent} Wins\nTier: ${$('out-tier').textContent}\nTotal Runs Above Replacement: ${$('stat-runs').textContent}\nGenerated by ToolsHub Sports Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    calculate();
});
</script>

<style>
.war-modern .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#4f46e5;opacity:.7;margin-bottom:8px;display:block}
.btn-indigo { background: #4F46E5; color: #fff; transition: all .3s; }
.btn-indigo:hover { background: #3730A3; color: #fff; transform: translateY(-2px); }
.bg-indigo-soft { background: #EEF2FF; color: #4F46E5; }
.bg-indigo-50 { background-color: #f7f8ff; }
.bg-emerald-50 { background-color: #f0fdf4; }
.bg-slate-50 { background-color: #f8fafc; }
.fw-900 { font-weight: 900; }
.pulse-indigo { animation: indigo-pulse 2s infinite; }
@keyframes indigo-pulse { 0% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(79, 70, 229, 0); } 100% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); } }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\war-calculator.blade.php ENDPATH**/ ?>