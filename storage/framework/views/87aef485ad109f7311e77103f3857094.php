<div class="row g-4 ops-modern">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(185, 28, 28, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-red" style="background: linear-gradient(135deg, #B91C1C, #EF4444); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-arrow-up-right-dots"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#7f1d1d; letter-spacing: -0.5px;">OPS Hitting Architect</h4>
                    <p class="text-muted small mb-0">Combine On-base Percentage and Slugging into a single metric of offensive dominance.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-red-50 border border-red-100 h-100 position-relative overflow-hidden">
                            <div class="position-absolute top-0 end-0 p-3 opacity-10">
                                <i class="fas fa-person-walking-dashed-line fa-4x rotate-12"></i>
                            </div>
                            <h6 class="fw-bold small mb-3 uppercase text-red-800 opacity-70">On-Base % (OBP)</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">OBP Rating</label>
                                    <div class="input-group">
                                        <input type="number" id="obp" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="0.350" step="0.001" min="0" max="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-orange-50 border border-orange-100 h-100 position-relative overflow-hidden">
                            <div class="position-absolute top-0 end-0 p-3 opacity-10">
                                <i class="fas fa-bolt fa-4x -rotate-12"></i>
                            </div>
                            <h6 class="fw-bold small mb-3 uppercase text-orange-800 opacity-70">Slugging % (SLG)</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">SLG Rating</label>
                                    <div class="input-group">
                                        <input type="number" id="slg" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="0.450" step="0.001" min="0" max="4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-obp="0.609" data-slg="0.812">Bonds '04 (1.422)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-obp="0.516" data-slg="0.846">Ruth '20 (1.362)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-obp="0.400" data-slg="0.600">MVP Standard (1.000)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-obp="0.320" data-slg="0.410">Average (0.730)</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 0; --tool-color: #B91C1C; --tool-bg: rgba(185, 28, 28, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">OFFENSIVE GRADE</span>
                <div class="output-hero-value display-2 fw-900 my-2 text-red-900" id="out-rating">GREAT</div>
                <div class="badge bg-red-soft text-red px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-ops">.800 OPS</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    <div class="col-12">
                        <h6 class="fw-bold small mb-3 uppercase text-center opacity-50">Contribution Breakdown</h6>
                        <div class="progress rounded-pill shadow-sm" style="height: 30px;">
                            <div id="obp-bar" class="progress-bar bg-red" style="width: 44%;" data-bs-toggle="tooltip" title="OBP Contribution">OBP</div>
                            <div id="slg-bar" class="progress-bar bg-orange" style="width: 56%;" data-bs-toggle="tooltip" title="SLG Contribution">SLG</div>
                        </div>
                        <div class="d-flex justify-content-between mt-2 px-2 small fw-bold">
                            <span class="text-red" id="obp-contrib">44% OBP</span>
                            <span class="text-orange" id="slg-contrib">56% SLG</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border bg-light h-100 text-center">
                            <h6 class="fw-bold small mb-2 uppercase opacity-50">Combined Value</h6>
                            <div class="h3 fw-900 mb-0" id="stat-combined">.350 + .450</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border bg-light h-100 text-center">
                            <h6 class="fw-bold small mb-2 uppercase opacity-50">League Benchmark</h6>
                            <div class="h3 fw-900 mb-0" id="stat-benchmark">TOP 10%</div>
                        </div>
                    </div>

                    
                    <div class="col-12 border-top pt-4">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto btn-red rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Hitting Report
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
    const obpInput = $('obp');
    const slgInput = $('slg');

    function calculate(){
        const obp = parseFloat(obpInput.value) || 0;
        const slg = parseFloat(slgInput.value) || 0;
        const ops = obp + slg;

        const format = val => val.toFixed(3).substring(val < 1 ? 1 : 0);

        $('out-ops').textContent = format(ops) + ' OPS';
        $('stat-combined').textContent = `${format(obp)} + ${format(slg)}`;

        // Breakdown Bars
        if(ops > 0){
            const obpWidth = (obp / ops) * 100;
            const slgWidth = (slg / ops) * 100;
            $('obp-bar').style.width = obpWidth + '%';
            $('slg-bar').style.width = slgWidth + '%';
            $('obp-contrib').textContent = Math.round(obpWidth) + '% OBP';
            $('slg-contrib').textContent = Math.round(slgWidth) + '% SLG';
        }

        let rating = '';
        let benchmark = '';
        if (ops >= 1.050) { rating = 'LEGENDARY'; benchmark = 'HISTORIC'; }
        else if (ops >= 0.950) { rating = 'ELITE'; benchmark = 'TOP 1%'; }
        else if (ops >= 0.850) { rating = 'ALL-STAR'; benchmark = 'TOP 5%'; }
        else if (ops >= 0.750) { rating = 'GREAT'; benchmark = 'TOP 20%'; }
        else if (ops >= 0.650) { rating = 'AVERAGE'; benchmark = 'LEAGUE AVG'; }
        else { rating = 'POOR'; benchmark = 'BELOW AVG'; }

        $('out-rating').textContent = rating;
        $('stat-benchmark').textContent = benchmark;
    }

    [obpInput, slgInput].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            obpInput.value = btn.dataset.obp;
            slgInput.value = btn.dataset.slg;
            calculate();
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Hitting OPS Report\nGrade: ${$('out-rating').textContent}\nOPS: ${$('out-ops').textContent}\nComponents: OBP ${obpInput.value} / SLG ${slgInput.value}\nGenerated by ToolsHub Sports Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => {
        obpInput.value = 0.350; slgInput.value = 0.450;
        calculate();
    });

    calculate();
});
</script>

<style>
.ops-modern .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#b91c1c;opacity:.7;margin-bottom:8px;display:block}
.btn-red { background: #B91C1C; color: #fff; transition: all .3s; }
.btn-red:hover { background: #991b1b; color: #fff; transform: translateY(-2px); }
.bg-red-soft { background: #FEF2F2; color: #B91C1C; }
.bg-red-50 { background-color: #fffafb; }
.bg-orange-50 { background-color: #fffbf0; }
.bg-red { background-color: #B91C1C; }
.bg-orange { background-color: #F59E0B; }
.fw-900 { font-weight: 900; }
.pulse-red { animation: red-pulse 2s infinite; }
@keyframes red-pulse { 0% { box-shadow: 0 0 0 0 rgba(185, 28, 28, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(185, 28, 28, 0); } 100% { box-shadow: 0 0 0 0 rgba(185, 28, 28, 0); } }
</style>


<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\ops-calculator.blade.php ENDPATH**/ ?>