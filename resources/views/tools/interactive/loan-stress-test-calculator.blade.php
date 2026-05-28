<div class="row g-4 stress-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(99, 102, 241, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #6366F1, #4338CA); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e1b4b; letter-spacing: -0.5px;">Financial Resilience Stress Test</h4>
                    <p class="text-muted small mb-0">Model worst-case scenarios—layoffs, medical emergencies, and high inflation—to measure your survival runway.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Financial Base --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Current Monthly Base</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Total Net Income</label>
                                    <div class="input-group input-group-lg bg-white rounded-3 border">
                                        <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                        <input type="number" id="s-inc" class="form-control border-0 bg-white fw-bold" value="5000">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Total Living Expenses</label>
                                    <div class="input-group input-group-lg bg-white rounded-3 border">
                                        <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                        <input type="number" id="s-exp" class="form-control border-0 bg-white fw-bold" value="3800">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Liquid Emergency Fund ($)</label>
                                    <input type="number" id="s-reserves" class="form-control border-0 bg-white rounded-3 fw-bold" value="15000">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Stress Vectors --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-indigo">
                            <h6 class="fw-bold small mb-3 uppercase text-indigo opacity-70">Stress Multipliers</h6>
                            <div class="mb-4">
                                <label class="form-label-custom text-danger">Income Shock (-%)</label>
                                <div class="d-flex align-items-center gap-3">
                                    <input type="range" id="v-drop" class="form-range color-indigo" min="0" max="100" value="25" step="5">
                                    <span class="badge bg-indigo-soft text-indigo p-2" id="v-drop-label">-25%</span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label-custom text-danger">Inflation Surge (+%)</label>
                                <div class="d-flex align-items-center gap-3">
                                    <input type="range" id="v-jump" class="form-range color-indigo" min="0" max="50" value="10" step="5">
                                    <span class="badge bg-indigo-soft text-indigo p-2" id="v-jump-label">+10%</span>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Emergency Event ($)</label>
                                <input type="number" id="v-event" class="form-control border-0 bg-light rounded-3 fw-bold" value="2000">
                                <div class="small text-muted mt-1">One-time medical or repair bill</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-d="100" data-j="10">Total Job Loss</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-d="0" data-j="25">Hyper Inflation</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-d="50" data-j="50">Dual Crisis</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 230; --tool-color: #6366F1; --tool-bg: rgba(99, 102, 241, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">SURVIVAL RUNWAY (MONTHS)</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-runway">0.0</div>
                <div class="badge bg-indigo-soft text-indigo px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-verdict">RESILIENT</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Detail --}}
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">STRESS AUDIT</th>
                                        <th class="text-muted small fw-bold py-3 text-end">NORMAL</th>
                                        <th class="text-muted small fw-bold py-3 text-end text-danger">STRESSED</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Monthly Income</td>
                                        <td class="py-3 text-end" id="tbl-inc-old">$0</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-inc-new">$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Monthly Expenses</td>
                                        <td class="py-3 text-end" id="tbl-exp-old">$0</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-exp-new">$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">Net Burn Rate</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-burn-old">$0</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-burn-new">$0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold mb-3 uppercase small opacity-50">Resilience Gauge</h6>
                            <div class="mb-4 text-center">
                                <div class="progress rounded-pill overflow-hidden shadow-sm" style="height: 15px; background: #f1f5f9;">
                                    <div id="bar-runway" class="progress-bar bg-indigo" style="width: 50%"></div>
                                </div>
                                <div class="small text-muted mt-2">Target: 6+ Months Runway</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-indigo rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-shield me-2"></i>Copy Stress Profile
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Simulator
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
    const inputs = ['s-inc', 's-exp', 's-reserves', 'v-drop', 'v-jump', 'v-event'];

    function calculate(){
        let inc = parseFloat($('s-inc').value) || 0;
        let exp = parseFloat($('s-exp').value) || 0;
        let res = parseFloat($('s-reserves').value) || 0;
        let drop = (parseFloat($('v-drop').value) || 0) / 100;
        let jump = (parseFloat($('v-jump').value) || 0) / 100;
        let event = parseFloat($('v-event').value) || 0;

        $('v-drop-label').textContent = '-' + (drop * 100).toFixed(0) + '%';
        $('v-jump-label').textContent = '+' + (jump * 100).toFixed(0) + '%';

        let sInc = inc * (1 - drop);
        let sExp = exp * (1 + jump);
        
        let oldBurn = inc - exp;
        let sBurn = sInc - sExp;

        // Runway calculation
        // Subtract event from reserves first
        let netReserves = Math.max(0, res - event);
        let runway = 0;
        if(sBurn < 0) {
            runway = netReserves / Math.abs(sBurn);
        } else {
            runway = 99; // Indefinite
        }

        // Update UI
        $('out-runway').textContent = runway >= 99 ? '∞' : runway.toFixed(1);
        
        let verdict = $('out-verdict');
        if(runway >= 6) { verdict.textContent = 'RESILIENT'; verdict.className = 'badge bg-teal-soft text-teal px-4 py-2 rounded-pill fw-bold shadow-sm'; }
        else if(runway >= 3) { verdict.textContent = 'VULNERABLE'; verdict.className = 'badge bg-warning-soft text-warning px-4 py-2 rounded-pill fw-bold shadow-sm'; }
        else { verdict.textContent = 'CRITICAL'; verdict.className = 'badge bg-red-soft text-red px-4 py-2 rounded-pill fw-bold shadow-sm'; }

        $('tbl-inc-old').textContent = '$' + Math.round(inc).toLocaleString();
        $('tbl-inc-new').textContent = '$' + Math.round(sInc).toLocaleString();
        $('tbl-exp-old').textContent = '$' + Math.round(exp).toLocaleString();
        $('tbl-exp-new').textContent = '$' + Math.round(sExp).toLocaleString();
        $('tbl-burn-old').textContent = (oldBurn >= 0 ? '+' : '-') + '$' + Math.abs(Math.round(oldBurn)).toLocaleString();
        $('tbl-burn-new').textContent = (sBurn >= 0 ? '+' : '-') + '$' + Math.abs(Math.round(sBurn)).toLocaleString();

        let runwayPct = Math.min(100, (runway / 12) * 100);
        $('bar-runway').style.width = runwayPct + '%';
    }

    inputs.forEach(id => $(id).addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            $('v-drop').value = btn.dataset.d;
            $('v-jump').value = btn.dataset.j;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        $('s-inc').value = 5000; $('s-exp').value = 3800; $('s-reserves').value = 15000;
        $('v-drop').value = 25; $('v-jump').value = 10; $('v-event').value = 2000;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Financial Resilience Stress Test\nRunway: ${$('out-runway').textContent} Months\nVerdict: ${$('out-verdict').textContent}\nStressed Monthly Burn: ${$('tbl-burn-new').textContent}\nGenerated by ToolsHub Resilience AI`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.stress-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e1b4b;opacity:.7;margin-bottom:8px;display:block}
.stress-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-indigo { background: #6366F1; color: #fff; transition: all .3s; }
.btn-indigo:hover { background: #4338CA; color: #fff; transform: translateY(-2px); }
.text-indigo { color: #6366F1; }
.bg-indigo-soft { background: #EEF2FF; }
.bg-indigo { background-color: #6366F1 !important; }
.bg-teal-soft { background: #f0fdf4; }
.text-teal { color: #10b981; }
.bg-warning-soft { background: #fffbeb; }
.text-warning { color: #d97706; }
.bg-red-soft { background: #fef2f2; }
.text-red { color: #ef4444; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.color-indigo::-webkit-slider-thumb { background: #6366F1; }
.color-indigo::-moz-range-thumb { background: #6366F1; }
</style>

