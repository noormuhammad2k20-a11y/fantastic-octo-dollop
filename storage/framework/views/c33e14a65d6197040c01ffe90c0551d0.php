<div class="row g-4 ab-hr-modern">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(30, 64, 175, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-blue" style="background: linear-gradient(135deg, #1E40AF, #3B82F6); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-baseball"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e3a8a; letter-spacing: -0.5px;">AB/HR Power Architect</h4>
                    <p class="text-muted small mb-0">Measure home run frequency and power hitting efficiency with professional precision.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-blue-50 border border-blue-100 h-100 position-relative overflow-hidden">
                            <div class="position-absolute top-0 end-0 p-3 opacity-10">
                                <i class="fas fa-bat-ball fa-4x rotate-12"></i>
                            </div>
                            <h6 class="fw-bold small mb-3 uppercase text-blue-800 opacity-70">Plate Discipline</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Total At Bats (AB)</label>
                                    <div class="input-group">
                                        <input type="number" id="at-bats" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="500" min="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-indigo-50 border border-indigo-100 h-100 position-relative overflow-hidden">
                            <div class="position-absolute top-0 end-0 p-3 opacity-10">
                                <i class="fas fa-fire fa-4x -rotate-12"></i>
                            </div>
                            <h6 class="fw-bold small mb-3 uppercase text-indigo-800 opacity-70">Power Stats</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Home Runs (HR)</label>
                                    <div class="input-group">
                                        <input type="number" id="home-runs" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="30" min="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-ab="573" data-hr="73">Bonds '01 (6.52)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-ab="540" data-hr="60">Ruth '27 (9.00)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-ab="600" data-hr="40">Elite Season (15.0)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-ab="600" data-hr="15">Average (40.0)</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 220; --tool-color: #1E40AF; --tool-bg: rgba(30, 64, 175, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">FREQUENCY RATING</span>
                <div class="output-hero-value display-2 fw-900 my-2 text-blue-900" id="out-rating">ELITE</div>
                <div class="badge bg-blue-soft text-blue px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-abhr">16.67 AB / HR</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4 text-center">
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-2 uppercase opacity-50">Ratio Ratio</h6>
                            <div class="h3 fw-900 mb-0" id="stat-ratio">1:16.7</div>
                            <small class="text-muted">1 HR every ~17 AB</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-2 uppercase opacity-50">HR Percentage</h6>
                            <div class="h3 fw-900 mb-0 text-primary" id="stat-pct">6.0%</div>
                            <small class="text-muted">of At Bats</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-2 uppercase opacity-50">Performance</h6>
                            <div class="h3 fw-900 mb-0" id="stat-benchmark">TOP 5%</div>
                            <div class="progress mt-2" style="height: 6px;">
                                <div id="power-bar" class="progress-bar bg-blue" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-12 border-top pt-4">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto btn-blue rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Performance Report
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
    const abInput = $('at-bats');
    const hrInput = $('home-runs');

    function calculate(){
        const ab = parseFloat(abInput.value) || 0;
        const hr = parseFloat(hrInput.value) || 0;

        if (hr > 0 && ab > 0) {
            const abhr = ab / hr;
            const hrPct = (hr / ab) * 100;
            
            $('out-abhr').textContent = abhr.toFixed(2) + ' AB / HR';
            $('stat-pct').textContent = hrPct.toFixed(1) + '%';
            $('stat-ratio').textContent = `1:${abhr.toFixed(1)}`;

            let rating = '';
            let benchmark = '';
            let color = '#1E40AF';
            let barWidth = 0;

            if (abhr < 10) {
                rating = 'LEGENDARY';
                benchmark = 'HISTORIC';
                barWidth = 100;
            } else if (abhr < 15) {
                rating = 'ELITE';
                benchmark = 'TOP 1%';
                barWidth = 90;
            } else if (abhr < 20) {
                rating = 'ALL-STAR';
                benchmark = 'TOP 5%';
                barWidth = 75;
            } else if (abhr < 30) {
                rating = 'ABOVE AVG';
                benchmark = 'TOP 20%';
                barWidth = 50;
            } else if (abhr < 45) {
                rating = 'AVERAGE';
                benchmark = 'LEAGUE AVG';
                barWidth = 30;
            } else {
                rating = 'CONTACT HITTER';
                benchmark = 'BELOW AVG';
                barWidth = 15;
            }

            $('out-rating').textContent = rating;
            $('stat-benchmark').textContent = benchmark;
            $('power-bar').style.width = barWidth + '%';
        } else {
            $('out-rating').textContent = 'READY';
            $('out-abhr').textContent = 'ENTER STATS ABOVE';
            $('stat-pct').textContent = '0.0%';
            $('stat-ratio').textContent = '0:0';
            $('stat-benchmark').textContent = 'N/A';
            $('power-bar').style.width = '0%';
        }
    }

    [abInput, hrInput].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            abInput.value = btn.dataset.ab;
            hrInput.value = btn.dataset.hr;
            calculate();
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Baseball Power Report\nRating: ${$('out-rating').textContent}\nAB/HR Ratio: ${$('out-abhr').textContent}\nHR Percentage: ${$('stat-pct').textContent}\nGenerated by ToolsHub Sports Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => {
        abInput.value = 500;
        hrInput.value = 30;
        calculate();
    });

    calculate();
});
</script>

<style>
.ab-hr-modern .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e3a8a;opacity:.7;margin-bottom:8px;display:block}
.ab-hr-modern .calculator-card { transition: all 0.3s ease; }
.btn-blue { background: #1E40AF; color: #fff; transition: all .3s; }
.btn-blue:hover { background: #1e3a8a; color: #fff; transform: translateY(-2px); }
.bg-blue-soft { background: #EFF6FF; color: #1E40AF; }
.bg-blue-50 { background-color: #f8faff; }
.bg-indigo-50 { background-color: #f9faff; }
.fw-900 { font-weight: 900; }
.pulse-blue { animation: blue-pulse 2s infinite; }
@keyframes blue-pulse { 0% { box-shadow: 0 0 0 0 rgba(30, 64, 175, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(30, 64, 175, 0); } 100% { box-shadow: 0 0 0 0 rgba(30, 64, 175, 0); } }
</style>


<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/tools/interactive/at-bats-per-home-run-calculator.blade.php ENDPATH**/ ?>