<div class="row g-4 cli-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(245, 158, 11, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #F59E0B, #D97706); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#451a03; letter-spacing: -0.5px;">Credit Limit (CLI) Optimizer</h4>
                    <p class="text-muted small mb-0">Hack your utilization ratio without paying down debt. Calculate exactly how much additional credit limit you need to hit your target score tier.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Spend & Target --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Spending & Goals</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Avg. Monthly Statement Balance ($)</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                    <input type="number" id="v-spend" class="form-control border-0 bg-white fw-bold" value="3500">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Target Utilization (%)</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="range" id="v-target-util" class="form-range color-amber" min="1" max="30" value="9" step="1">
                                        <span class="badge bg-amber-soft text-amber p-2" id="v-target-label">9%</span>
                                    </div>
                                    <div class="small text-muted mt-1">Under 10% is considered elite/optimal.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Current Limits --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-amber">
                            <h6 class="fw-bold small mb-3 uppercase text-amber opacity-70">Current Exposure</h6>
                            <div class="mb-4">
                                <label class="form-label-custom text-amber">Combined Total Credit Limit</label>
                                <div class="input-group input-group-lg bg-light rounded-3 border">
                                    <span class="input-group-text border-0 bg-light opacity-40">$</span>
                                    <input type="number" id="v-lim" class="form-control border-0 bg-light fw-bold" value="10000">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Modeling Credit Pull Impact</label>
                                    <select id="v-pull" class="form-select border-0 bg-light rounded-3 fw-bold">
                                        <option value="0">Soft Pull (No score impact)</option>
                                        <option value="5">Hard Pull (-5 Pts typical)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-t="1">Ultra Elite (1%)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-t="29">Safety Zone (29%)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-t="9">Standard Sweet Spot (9%)</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 35; --tool-color: #F59E0B; --tool-bg: rgba(245, 158, 11, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL CREDIT LIMIT NEEDED</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-req-lim">$0</div>
                <div class="badge bg-amber-soft text-amber px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-shortfall">CLI Shortfall: +$0</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Stats --}}
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">UTILIZATION DIAGNOSTIC</th>
                                        <th class="text-muted small fw-bold py-3 text-end">VALUES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Current Utilization</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-cur-util">0%</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Target Utilization</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-tar-util">0%</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">FICO Scoring Potential</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-impact">OPTIMAL</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold mb-3 uppercase small opacity-50">Strategy Progress</h6>
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="small fw-bold text-muted">Gap to Target</span>
                                    <span class="small fw-bold text-amber" id="out-gap-pct">0%</span>
                                </div>
                                <div class="progress rounded-pill overflow-hidden shadow-sm" style="height: 12px; background: #f1f5f9;">
                                    <div id="bar-gap" class="progress-bar bg-amber" style="width: 50%"></div>
                                </div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-amber rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-invoice me-2"></i>Copy Optimization Plan
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
    const spendE = $('v-spend'), limE = $('v-lim'), targetE = $('v-target-util');

    function calculate(){
        let spend = parseFloat(spendE.value) || 0;
        let lim = parseFloat(limE.value) || 0;
        let target = parseFloat(targetE.value) || 1;

        $('v-target-label').textContent = target + '%';

        let curUtil = lim > 0 ? (spend / lim) * 100 : 0;
        
        // Req Lim = spend / (target/100)
        let reqLim = spend / (target / 100);
        let shortfall = Math.max(0, reqLim - lim);

        // Update UI
        $('out-req-lim').textContent = '$' + Math.round(reqLim).toLocaleString();
        $('out-shortfall').textContent = shortfall > 0 ? `CLI Shortfall: +$${Math.round(shortfall).toLocaleString()}` : 'Target Achieved';
        
        $('tbl-cur-util').textContent = curUtil.toFixed(1) + '%';
        $('tbl-cur-util').style.color = curUtil > 30 ? '#ef4444' : (curUtil > 10 ? '#f59e0b' : '#10b981');
        
        $('tbl-tar-util').textContent = target + '%';

        let impact = 'POOR'; let col = '#ef4444';
        if(curUtil <= 10) { impact = 'OPTIMAL'; col = '#10b981'; }
        else if(curUtil <= 30) { impact = 'GOOD'; col = '#22c55e'; }
        else if(curUtil <= 50) { impact = 'FAIR'; col = '#f59e0b'; }

        $('tbl-impact').textContent = impact;
        $('tbl-impact').style.color = col;

        let gapPct = reqLim > 0 ? (lim / reqLim) * 100 : 0;
        $('out-gap-pct').textContent = Math.min(100, gapPct).toFixed(0) + '% Match';
        $('bar-gap').style.width = Math.min(100, gapPct) + '%';
    }

    [spendE, limE, targetE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            targetE.value = btn.dataset.t;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        spendE.value = 3500; limE.value = 10000; targetE.value = 9;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Credit Limit (CLI) Optimization Plan\nTarget Utilization: ${$('tbl-tar-util').textContent}\nLimit Required: ${$('out-req-lim').textContent}\nShortfall: ${$('out-shortfall').textContent}\nGenerated by ToolsHub CLI Pro`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Plan Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.cli-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#451a03;opacity:.7;margin-bottom:8px;display:block}
.cli-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-amber { background: #F59E0B; color: #fff; transition: all .3s; }
.btn-amber:hover { background: #D97706; color: #fff; transform: translateY(-2px); }
.text-amber { color: #F59E0B; }
.text-amber-900 { color: #451a03; }
.bg-amber-soft { background: #FFFBEB; }
.bg-amber { background-color: #F59E0B !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.color-amber::-webkit-slider-thumb { background: #F59E0B; }
.color-amber::-moz-range-thumb { background: #F59E0B; }
</style>

