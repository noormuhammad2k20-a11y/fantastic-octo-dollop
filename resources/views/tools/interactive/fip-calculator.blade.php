<div class="row g-4 fip-modern">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(79, 70, 229, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-indigo" style="background: linear-gradient(135deg, #4F46E5, #818CF8); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#312e81; letter-spacing: -0.5px;">FIP Sabermetric Hub</h4>
                    <p class="text-muted small mb-0">Measure pitching effectiveness independent of fielding defense and batted-ball luck.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Power & Control Groups --}}
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-indigo-50 border border-indigo-100 h-100 position-relative overflow-hidden">
                            <h6 class="fw-bold small mb-3 uppercase text-indigo-800 opacity-70">Power Metrics</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Home Runs (HR)</label>
                                    <input type="number" id="hr" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-3" value="1" min="0">
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Strikeouts (K)</label>
                                    <input type="number" id="k" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="8" min="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-blue-50 border border-blue-100 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-blue-800 opacity-70">Control Metrics</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Walks (BB)</label>
                                    <input type="number" id="bb" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-3" value="2" min="0">
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Hit By Pitch (HBP)</label>
                                    <input type="number" id="hbp" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="0" min="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-slate-50 border border-slate-100 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-slate-800 opacity-70">Environment</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Innings Pitched (IP)</label>
                                    <input type="number" id="ip" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-3" value="6.0" step="0.1">
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">FIP Constant</label>
                                    <input type="number" id="constant" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="3.10" step="0.01">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-hr="0" data-k="12" data-bb="1" data-hbp="0" data-ip="9.0">Dominant Start</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-hr="2" data-k="4" data-bb="4" data-hbp="1" data-ip="5.0">Struggling Outing</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-hr="1" data-k="7" data-bb="2" data-hbp="0" data-ip="6.2">Standard Quality</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 240; --tool-color: #4F46E5; --tool-bg: rgba(79, 70, 229, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">PITCHER EFFECTIVENESS</span>
                <div class="output-hero-value display-2 fw-900 my-2 text-indigo-900" id="out-rating">GREAT</div>
                <div class="badge bg-indigo-soft text-indigo px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-fip">3.10 FIP</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4 text-center">
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-2 uppercase opacity-50">K/9 Ratio</h6>
                            <div class="h3 fw-900 mb-0" id="stat-k9">12.0</div>
                            <small class="text-muted">Strikeouts per 9 innings</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-2 uppercase opacity-50">Reliability Grade</h6>
                            <div class="h3 fw-900 mb-0" id="stat-benchmark">TOP 15%</div>
                            <div class="progress mt-2" style="height: 6px;">
                                <div id="efficiency-bar" class="progress-bar bg-indigo" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-12 border-top pt-4">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto btn-indigo rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-microchip me-2"></i>Copy Sabermetric Data
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto btn-outline-dark rounded-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Parameters
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
    const hrIn = $('hr'), bbIn = $('bb'), hbpIn = $('hbp'), kIn = $('k'), ipIn = $('ip'), constIn = $('constant');

    function calculate(){
        const hr = parseFloat(hrIn.value) || 0;
        const bb = parseFloat(bbIn.value) || 0;
        const hbp = parseFloat(hbpIn.value) || 0;
        const k = parseFloat(kIn.value) || 0;
        const ipRaw = parseFloat(ipIn.value) || 1;
        const constant = parseFloat(constIn.value) || 3.10;

        // Baseball IP Conversion
        const wholeIP = Math.floor(ipRaw);
        const decimalPart = (ipRaw - wholeIP).toFixed(1);
        let outs = 0;
        if (decimalPart == 0.1) outs = 1;
        else if (decimalPart == 0.2) outs = 2;
        const actualIP = wholeIP + (outs / 3);

        if (actualIP > 0) {
            const fip = ((13 * hr + 3 * (bb + hbp) - 2 * k) / actualIP) + constant;
            const k9 = (k * 9) / actualIP;

            $('out-fip').textContent = fip.toFixed(2) + ' FIP';
            $('stat-k9').textContent = k9.toFixed(1);

            let rating = '';
            let benchmark = '';
            let barWidth = 0;

            if (fip < 2.5) { rating = 'LEGENDARY'; benchmark = 'TOP 1%'; barWidth = 100; }
            else if (fip < 3.0) { rating = 'EXCELLENT'; benchmark = 'TOP 5%'; barWidth = 90; }
            else if (fip < 3.5) { rating = 'GREAT'; benchmark = 'TOP 15%'; barWidth = 75; }
            else if (fip < 4.0) { rating = 'AVERAGE'; benchmark = 'LEAGUE AVG'; barWidth = 50; }
            else if (fip < 4.5) { rating = 'BELOW AVG'; benchmark = 'BOTTOM 30%'; barWidth = 30; }
            else { rating = 'POOR'; benchmark = 'REPLACEMENT'; barWidth = 15; }

            $('out-rating').textContent = rating;
            $('stat-benchmark').textContent = benchmark;
            $('efficiency-bar').style.width = barWidth + '%';
        }
    }

    [hrIn, bbIn, hbpIn, kIn, ipIn, constIn].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            hrIn.value = btn.dataset.hr;
            kIn.value = btn.dataset.k;
            bbIn.value = btn.dataset.bb;
            hbpIn.value = btn.dataset.hbp;
            ipIn.value = btn.dataset.ip;
            calculate();
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Pitching FIP Report\nRating: ${$('out-rating').textContent}\nFIP Score: ${$('out-fip').textContent}\nK/9: ${$('stat-k9').textContent}\nGenerated by ToolsHub Sports Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => {
        hrIn.value = 1; kIn.value = 8; bbIn.value = 2; hbpIn.value = 0; ipIn.value = 6.0; constIn.value = 3.10;
        calculate();
    });

    calculate();
});
</script>

<style>
.fip-modern .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#4f46e5;opacity:.7;margin-bottom:8px;display:block}
.btn-indigo { background: #4F46E5; color: #fff; transition: all .3s; }
.btn-indigo:hover { background: #4338ca; color: #fff; transform: translateY(-2px); }
.bg-indigo-soft { background: #EEF2FF; color: #4F46E5; }
.bg-indigo-50 { background-color: #f5f6ff; }
.bg-blue-50 { background-color: #f8faff; }
.bg-slate-50 { background-color: #f8fafc; }
.fw-900 { font-weight: 900; }
.pulse-indigo { animation: indigo-pulse 2s infinite; }
@keyframes indigo-pulse { 0% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(79, 70, 229, 0); } 100% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); } }
</style>


