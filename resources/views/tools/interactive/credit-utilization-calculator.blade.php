<div class="row g-4 utilization-bench-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(99, 102, 241, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #6366F1, #4F46E5); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e1b4b; letter-spacing: -0.5px;">Utilization Benchmarking & Target Optimizer</h4>
                    <p class="text-muted small mb-0">Beyond just a ratio. Model your credit health against FICO "High Achiever" benchmarks. Set target goals and discover the exact paydown required to hit them.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Parameters --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Current Metrics</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Combined Credit Balances ($)</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                    <input type="number" id="v-bal" class="form-control border-0 bg-white fw-bold text-danger" value="1500">
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Combined Credit Limits ($)</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                    <input type="number" id="v-lim" class="form-control border-0 bg-white fw-bold" value="5000">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Targets --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-indigo">
                            <h6 class="fw-bold small mb-3 uppercase text-indigo opacity-70">Target Benchmark</h6>
                            <div class="mb-4">
                                <label class="form-label-custom text-indigo">Desired Utilization Goal (%)</label>
                                <select id="v-target" class="form-select border-0 bg-light rounded-3 fw-bold">
                                    <option value="1">1% (AZEO / Elite Tier)</option>
                                    <option value="10" selected>10% (Optimal Tier)</option>
                                    <option value="28.9">28.9% (Standard "Good" Limit)</option>
                                </select>
                            </div>
                            <div class="p-3 rounded-4 bg-indigo-50 border border-indigo-100">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i class="fas fa-bullseye text-indigo"></i>
                                    <span class="small fw-bold text-indigo-900 uppercase">Target Balance</span>
                                </div>
                                <div class="h3 fw-900 mb-0 text-indigo-900" id="out-target-bal">$500</div>
                                <div class="x-small text-muted mt-1" id="out-paydown-required">Required Paydown: $1,000</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-b="4500" data-l="5000">Maxed Out Scenario</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-b="400" data-l="10000">Thin File / Low Spend</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 235; --tool-color: #6366F1; --tool-bg: rgba(99, 102, 241, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">CURRENT UTILIZATION RATIO</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-util">30%</div>
                <div class="badge bg-indigo-soft text-indigo px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">MODERATE IMPACT</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Stats --}}
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">BENCHMARK COMPARISON</th>
                                        <th class="text-muted small fw-bold py-3 text-end">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">FICO "High Achiever" Avg</td>
                                        <td class="py-3 text-end text-success fw-bold">7.0%</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Standard Risk Threshold</td>
                                        <td class="py-3 text-end text-danger fw-bold">29.9%</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">Liquidity Availability</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-avail">$3,500</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Actions/Gauge --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Scoring Health Gauge</h6>
                            <div class="mb-4">
                                <div class="progress rounded-pill overflow-hidden shadow-sm" style="height: 12px; background: #f1f5f9;">
                                    <div id="bar-util" class="progress-bar bg-indigo" style="width: 30%"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-1 px-1 x-small fw-bold text-muted">
                                    <span>PRIME</span>
                                    <span>RISKY</span>
                                    <span>CRITICAL</span>
                                </div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-indigo rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-export me-2"></i>Copy Benchmark Report
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
    const balE = $('v-bal'), limE = $('v-lim'), targetE = $('v-target');

    function calculate(){
        let bal = parseFloat(balE.value) || 0;
        let lim = parseFloat(limE.value) || 1;
        let targetPct = parseFloat(targetE.value) || 10;

        let util = (bal / lim) * 100;
        let avail = Math.max(0, lim - bal);
        
        let targetBal = lim * (targetPct / 100);
        let paydownRequired = Math.max(0, bal - targetBal);

        // Update UI
        $('out-util').textContent = Math.round(util) + '%';
        $('tbl-avail').textContent = '$' + Math.round(avail).toLocaleString();
        $('out-target-bal').textContent = '$' + Math.round(targetBal).toLocaleString();
        $('out-paydown-required').textContent = `Required Paydown: $${Math.round(paydownRequired).toLocaleString()}`;
        
        $('bar-util').style.width = Math.min(100, util) + '%';

        let status = 'MODERATE IMPACT'; let col = '#6366f1';
        if(util <= 10) { status = 'ELITE STANDING'; col = '#10b981'; }
        else if(util <= 30) { status = 'GOOD STANDING'; col = '#3b82f6'; }
        else if(util > 50) { status = 'CRITICAL IMPACT'; col = '#ef4444'; }

        $('out-status').textContent = status;
        $('out-status').style.color = col;
        $('out-util').style.color = col;
        $('bar-util').style.backgroundColor = col;
    }

    [balE, limE, targetE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            balE.value = btn.dataset.b;
            limE.value = btn.dataset.l;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        balE.value = 1500; limE.value = 5000; targetE.value = 10;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Credit Utilization Benchmark\nRatio: ${$('out-util').textContent}\nTarget Paydown: ${$('out-paydown-required').textContent}\nStatus: ${$('out-status').textContent}\nGenerated by ToolsHub Benchmark Pro`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.utilization-bench-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e1b4b;opacity:.7;margin-bottom:8px;display:block}
.utilization-bench-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-indigo { background: #6366F1; color: #fff; transition: all .3s; }
.btn-indigo:hover { background: #4F46E5; color: #fff; transform: translateY(-2px); }
.text-indigo { color: #6366F1; }
.text-indigo-900 { color: #1e1b4b; }
.bg-indigo-soft { background: #EEF2FF; }
.bg-indigo-50 { background-color: #f8faff; }
.bg-indigo { background-color: #6366F1 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.x-small { font-size: 0.65rem; }
</style>

