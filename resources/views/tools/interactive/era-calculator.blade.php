<div class="row g-4 era-modern">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(30, 64, 175, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-blue" style="background: linear-gradient(135deg, #1E3A8A, #3B82F6); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-baseball-bat-ball"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e3a8a; letter-spacing: -0.5px;">ERA Precision Engine</h4>
                    <p class="text-muted small mb-0">Calculate Earned Run Average with professional league standards and innings-out logic.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Basic Stats --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-blue-50 border border-blue-100 h-100 position-relative overflow-hidden">
                            <div class="position-absolute top-0 end-0 p-3 opacity-10">
                                <i class="fas fa-mound fa-4x rotate-12"></i>
                            </div>
                            <h6 class="fw-bold small mb-3 uppercase text-blue-800 opacity-70">Pitching Stats</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Earned Runs</label>
                                    <input type="number" id="earned-runs" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="3" min="0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Innings Pitched</label>
                                    <input type="number" id="innings-pitched" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="9.0" step="0.1">
                                    <div class="text-muted mt-1" style="font-size: 0.7rem;">Use .1 or .2 for outs</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- League Context --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-indigo-50 border border-indigo-100 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-indigo-800 opacity-70">League Format</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Standard Game Length</label>
                                    <select id="standard-innings" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold text-indigo-900">
                                        <option value="9">9 Innings (MLB/Professional)</option>
                                        <option value="7">7 Innings (Softball / High School)</option>
                                        <option value="6">6 Innings (Little League)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-er="38" data-ip="304.2" data-std="9">Gibson '68 (1.12)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-er="34" data-ip="232.0" data-std="9">Pedro '00 (1.32)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-er="45" data-ip="200.0" data-std="9">Elite (2.03)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-er="100" data-ip="200.0" data-std="9">Average (4.50)</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 220; --tool-color: #1E3A8A; --tool-bg: rgba(30, 58, 138, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">PITCHING GRADE</span>
                <div class="output-hero-value display-2 fw-900 my-2 text-blue-900" id="out-perf">EXCELLENT</div>
                <div class="badge bg-blue-soft text-blue px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-era">3.00 ERA</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4 text-center">
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-2 uppercase opacity-50">Converted IP</h6>
                            <div class="h3 fw-900 mb-0" id="stat-actual-ip">9.0</div>
                            <small class="text-muted">Actual Mathematical IP</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-2 uppercase opacity-50">Runs per 9</h6>
                            <div class="h3 fw-900 mb-0 text-primary" id="stat-runs-nine">3.00</div>
                            <small class="text-muted" id="stat-runs-label">based on 9 innings</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-2 uppercase opacity-50">Efficiency</h6>
                            <div class="h3 fw-900 mb-0" id="stat-benchmark">TOP 10%</div>
                            <div class="progress mt-2" style="height: 6px;">
                                <div id="efficiency-bar" class="progress-bar bg-blue" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-12 border-top pt-4">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto btn-blue rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy ERA Report
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
    const erInput = $('earned-runs');
    const ipInput = $('innings-pitched');
    const stdSelect = $('standard-innings');

    function calculate(){
        const er = parseFloat(erInput.value) || 0;
        const ipRaw = parseFloat(ipInput.value) || 0;
        const standard = parseFloat(stdSelect.value) || 9;

        if (ipRaw > 0) {
            // Convert baseball notation (e.g., 6.1 to 6.333)
            const wholeIP = Math.floor(ipRaw);
            const decimalPart = (ipRaw - wholeIP).toFixed(1);
            let outs = 0;
            if (decimalPart == 0.1) outs = 1;
            else if (decimalPart == 0.2) outs = 2;
            
            const actualIP = wholeIP + (outs / 3);
            const era = (er * standard) / actualIP;

            $('out-era').textContent = era.toFixed(2) + ' ERA';
            $('stat-actual-ip').textContent = actualIP.toFixed(3);
            $('stat-runs-nine').textContent = era.toFixed(2);
            $('stat-runs-label').textContent = `based on ${standard} innings`;

            let rating = '';
            let benchmark = '';
            let barWidth = 0;

            if (era < 2.0) { rating = 'LEGENDARY'; benchmark = 'HISTORIC'; barWidth = 100; }
            else if (era < 3.0) { rating = 'ELITE'; benchmark = 'TOP 5%'; barWidth = 90; }
            else if (era < 3.8) { rating = 'EXCELLENT'; benchmark = 'TOP 15%'; barWidth = 75; }
            else if (era < 4.5) { rating = 'AVERAGE'; benchmark = 'LEAGUE AVG'; barWidth = 50; }
            else if (era < 5.5) { rating = 'BELOW AVG'; benchmark = 'BOTTOM 30%'; barWidth = 30; }
            else { rating = 'POOR'; benchmark = 'REPLACEMENT'; barWidth = 15; }

            $('out-perf').textContent = rating;
            $('stat-benchmark').textContent = benchmark;
            $('efficiency-bar').style.width = barWidth + '%';
        } else {
            $('out-perf').textContent = 'READY';
            $('out-era').textContent = 'ENTER STATS';
            $('stat-actual-ip').textContent = '0.0';
            $('stat-runs-nine').textContent = '0.00';
            $('efficiency-bar').style.width = '0%';
        }
    }

    [erInput, ipInput, stdSelect].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            erInput.value = btn.dataset.er;
            ipInput.value = btn.dataset.ip;
            stdSelect.value = btn.dataset.std;
            calculate();
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `ERA Performance Report\nGrade: ${$('out-perf').textContent}\nERA: ${$('out-era').textContent}\nInnings: ${ipInput.value} (${stdSelect.options[stdSelect.selectedIndex].text})\nGenerated by ToolsHub Sports Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => {
        erInput.value = 3; ipInput.value = 9.0; stdSelect.value = 9;
        calculate();
    });

    calculate();
});
</script>

<style>
.era-modern .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e3a8a;opacity:.7;margin-bottom:8px;display:block}
.era-modern .calculator-card { transition: all 0.3s ease; }
.btn-blue { background: #1E3A8A; color: #fff; transition: all .3s; }
.btn-blue:hover { background: #1e3a8a; color: #fff; transform: translateY(-2px); }
.bg-blue-soft { background: #EFF6FF; color: #1E3A8A; }
.bg-blue-50 { background-color: #f8faff; }
.bg-indigo-50 { background-color: #f9faff; }
.fw-900 { font-weight: 900; }
.pulse-blue { animation: blue-pulse 2s infinite; }
@keyframes blue-pulse { 0% { box-shadow: 0 0 0 0 rgba(30, 58, 138, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(30, 58, 138, 0); } 100% { box-shadow: 0 0 0 0 rgba(30, 58, 138, 0); } }
</style>


