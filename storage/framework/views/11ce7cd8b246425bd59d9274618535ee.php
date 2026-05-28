<div class="row g-4 whip-modern">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(59, 130, 246, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-blue" style="background: linear-gradient(135deg, #3B82F6, #2563EB); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-person-running"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e3a8a; letter-spacing: -0.5px;">WHIP Efficiency Architect</h4>
                    <p class="text-muted small mb-0">Measure a pitcher's ability to keep runners off the basepaths with pinpoint accuracy.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-blue-50 border border-blue-100 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-blue-800 opacity-70">Walks (BB)</h6>
                            <input type="number" id="walks" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h4 mb-0" value="2" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-indigo-50 border border-indigo-100 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-indigo-800 opacity-70">Hits Allowed (H)</h6>
                            <input type="number" id="hits" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h4 mb-0" value="5" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-slate-50 border border-slate-200 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-slate-700 opacity-70">Innings Pitched (IP)</h6>
                            <input type="number" id="ip" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h4 mb-0" value="6.0" step="0.1" min="0.1">
                            <small class="text-muted mt-2 d-block">Use .1 for 1 out, .2 for 2 outs</small>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-bb="32" data-h="128" data-ip="217.0">Pedro '00 (0.737)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-bb="45" data-h="160" data-ip="200.0">Elite (1.025)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-bb="60" data-h="190" data-ip="200.0">League Avg (1.250)</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 210; --tool-color: #3B82F6; --tool-bg: rgba(59, 130, 246, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">EFFICIENCY RATING</span>
                <div class="output-hero-value display-2 fw-900 my-2 text-blue-900" id="out-rating">EXCELLENT</div>
                <div class="badge bg-blue-soft text-blue px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-whip">1.167 WHIP</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-12">
                        <h6 class="fw-bold small mb-3 uppercase text-center opacity-50">Traffic Density (Runners Per Inning)</h6>
                        <div class="d-flex justify-content-center gap-2 mb-2" id="traffic-lights">
                            <i class="fas fa-user-check fa-2x text-blue"></i>
                            <i class="fas fa-user-check fa-2x text-blue"></i>
                            <i class="fas fa-user-check fa-2x text-muted opacity-20"></i>
                            <i class="fas fa-user-check fa-2x text-muted opacity-20"></i>
                            <i class="fas fa-user-check fa-2x text-muted opacity-20"></i>
                        </div>
                        <p class="text-center small text-muted mb-0" id="traffic-desc">Low traffic — Pitcher is in control.</p>
                    </div>

                    <div class="col-md-6 text-center">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-1 uppercase opacity-50">Total Baserunners</h6>
                            <div class="h3 fw-900 mb-0" id="stat-runners">7</div>
                        </div>
                    </div>

                    <div class="col-md-6 text-center">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-1 uppercase opacity-50">Baserunner %</h6>
                            <div class="h3 fw-900 mb-0" id="stat-percent">28.5%</div>
                        </div>
                    </div>

                    
                    <div class="col-12 border-top pt-4">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto btn-blue rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Pitching Report
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
    const bbIn = $('walks'), hIn = $('hits'), ipIn = $('ip');

    function calculate(){
        const bb = parseFloat(bbIn.value) || 0;
        const h = parseFloat(hIn.value) || 0;
        let ipRaw = parseFloat(ipIn.value) || 0;

        // Convert IP (e.g., 6.1 to 6.333)
        const wholeIP = Math.floor(ipRaw);
        const fractionIP = (ipRaw % 1).toFixed(1);
        let ip = wholeIP;
        if (fractionIP == 0.1) ip += 0.3333;
        else if (fractionIP == 0.2) ip += 0.6666;

        const whip = ip > 0 ? (bb + h) / ip : 0;
        const runners = bb + h;
        const percent = ip > 0 ? (runners / (ip * 3 + runners) * 100) : 0; 

        $('out-whip').textContent = whip.toFixed(3) + ' WHIP';
        $('stat-runners').textContent = runners;
        $('stat-percent').textContent = percent.toFixed(1) + '%';

        let rating = '', traffic = '', trafficClass = '';
        if (whip <= 0.90) { rating = 'LEGENDARY'; traffic = 'Ghost Town — Impossible to reach.'; trafficClass = 'text-blue'; }
        else if (whip <= 1.10) { rating = 'ELITE'; traffic = 'Low traffic — Pitcher is in control.'; trafficClass = 'text-blue'; }
        else if (whip <= 1.25) { rating = 'GREAT'; traffic = 'Moderate — Manageable stress.'; trafficClass = 'text-info'; }
        else if (whip <= 1.40) { rating = 'AVERAGE'; traffic = 'Congested — High pressure innings.'; trafficClass = 'text-warning'; }
        else { rating = 'POOR'; traffic = 'Gridlock — Constant baserunners.'; trafficClass = 'text-danger'; }

        $('out-rating').textContent = rating;
        $('traffic-desc').textContent = traffic;
        
        const icons = $('traffic-lights').querySelectorAll('i');
        const count = Math.min(5, Math.ceil(whip * 2)); 
        icons.forEach((icon, idx) => {
            if(idx < count){
                icon.className = `fas fa-user-check fa-2x ${trafficClass}`;
                icon.style.opacity = '1';
            } else {
                icon.className = `fas fa-user-check fa-2x text-muted`;
                icon.style.opacity = '0.2';
            }
        });
    }

    [bbIn, hIn, ipIn].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            bbIn.value = btn.dataset.bb;
            hIn.value = btn.dataset.h;
            ipIn.value = btn.dataset.ip;
            calculate();
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Pitching WHIP Report\nGrade: ${$('out-rating').textContent}\nWHIP: ${$('out-whip').textContent}\nStats: ${bbIn.value} BB / ${hIn.value} H in ${ipIn.value} IP\nGenerated by ToolsHub Sports Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => {
        bbIn.value = 2; hIn.value = 5; ipIn.value = 6.0;
        calculate();
    });

    calculate();
});
</script>

<style>
.whip-modern .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e3a8a;opacity:.7;margin-bottom:8px;display:block}
.btn-blue { background: #3B82F6; color: #fff; transition: all .3s; }
.btn-blue:hover { background: #2563EB; color: #fff; transform: translateY(-2px); }
.bg-blue-soft { background: #EFF6FF; color: #3B82F6; }
.bg-blue-50 { background-color: #f8fbff; }
.bg-indigo-50 { background-color: #f9faff; }
.bg-slate-50 { background-color: #f8fafc; }
.fw-900 { font-weight: 900; }
.pulse-blue { animation: blue-pulse 2s infinite; }
@keyframes blue-pulse { 0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); } 100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); } }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\whip-calculator.blade.php ENDPATH**/ ?>