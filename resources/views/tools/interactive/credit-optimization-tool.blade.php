<div class="row g-4 lab-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(168, 85, 247, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #A855F7, #7E22CE); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-flask"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#2e1065; letter-spacing: -0.5px;">Credit Optimization Laboratory</h4>
                    <p class="text-muted small mb-0">Experiment with debt paydowns and limit increases to engineer your perfect FICO score. Model the exact point-boost before taking action.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                {{-- Quick Presets --}}
                <div class="mb-4 p-3 rounded-4 bg-purple-50 border border-purple-100">
                    <h6 class="fw-bold small mb-3 uppercase text-purple opacity-70">Tactical Experiments</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-white btn-sm rounded-pill px-3 shadow-sm border lab-preset" data-l="10000" data-b="8000" data-cli="10000" data-p="0">Massive CLI Boost</button>
                        <button class="btn btn-white btn-sm rounded-pill px-3 shadow-sm border lab-preset" data-l="10000" data-b="8000" data-cli="0" data-p="7000">Aggressive Paydown</button>
                        <button class="btn btn-white btn-sm rounded-pill px-3 shadow-sm border lab-preset" data-l="10000" data-b="8000" data-cli="5000" data-p="2000">The Hybrid Strategy</button>
                        <button class="btn btn-white btn-sm rounded-pill px-3 shadow-sm border lab-preset" data-l="15000" data-b="2000" data-cli="0" data-p="0">Reset Lab</button>
                    </div>
                </div>

                <div class="row g-4">
                    {{-- Baseline --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Current Baseline</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Total Combined Limits</label>
                                    <div class="input-group input-group-lg bg-white rounded-3 border">
                                        <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                        <input type="number" id="l-lim" class="form-control border-0 bg-white fw-bold" value="10000">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom text-danger">Total Combined Balances</label>
                                    <div class="input-group input-group-lg bg-white rounded-3 border">
                                        <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                        <input type="number" id="l-bal" class="form-control border-0 bg-white fw-bold text-danger" value="8500">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-purple">
                            <h6 class="fw-bold small mb-3 uppercase text-purple opacity-70">Proposed Engineering</h6>
                            <div class="mb-4">
                                <label class="form-label-custom text-purple">Limit Increase (CLI) Granted</label>
                                <div class="input-group bg-light rounded-3 border">
                                    <span class="input-group-text border-0 bg-light opacity-40">+$</span>
                                    <input type="number" id="l-cli" class="form-control border-0 bg-light fw-bold text-purple" value="5000">
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom text-success">Target Debt Paydown</label>
                                <div class="input-group bg-light rounded-3 border">
                                    <span class="input-group-text border-0 bg-light opacity-40">-$</span>
                                    <input type="number" id="l-pay" class="form-control border-0 bg-light fw-bold text-success" value="1000">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 270; --tool-color: #A855F7; --tool-bg: rgba(168, 85, 247, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">OPTIMIZED UTILIZATION</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-new-util">0%</div>
                <div class="badge bg-purple-soft text-purple px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-impact-label">BOOST: +0 PTS ESTIMATED</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Detail --}}
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">ENGINEERING RESULTS</th>
                                        <th class="text-muted small fw-bold py-3 text-end">BASELINE</th>
                                        <th class="text-muted small fw-bold py-3 text-end text-purple">NEW</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Utilization Ratio</td>
                                        <td class="py-3 text-end" id="tbl-util-old">0%</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-util-new">0%</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Available Liquidity</td>
                                        <td class="py-3 text-end" id="tbl-liq-old">$0</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-liq-new">$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">FICO Tier Status</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-tier-old">POOR</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-tier-new">POOR</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold mb-3 uppercase small opacity-50">Impact Projection</h6>
                            <div class="p-3 rounded-4 bg-purple-50 border border-purple-100 mb-4">
                                <div class="small fw-bold text-purple-900" id="out-advice">Loading lab data...</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-purple rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-microscope me-2"></i>Copy Optimization Blueprint
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Lab
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
    const inputs = ['l-lim', 'l-bal', 'l-cli', 'l-pay'];

    function calculate(){
        let cLim = parseFloat($('l-lim').value) || 1;
        let cBal = parseFloat($('l-bal').value) || 0;
        let cli = parseFloat($('l-cli').value) || 0;
        let pay = parseFloat($('l-pay').value) || 0;

        let nLim = cLim + cli;
        let nBal = Math.max(0, cBal - pay);

        let oUtil = (cBal / cLim) * 100;
        let nUtil = nLim > 0 ? (nBal / nLim) * 100 : 0;

        let delta = oUtil - nUtil;
        let boost = 0;
        if(delta > 50) boost = 60; else if(delta > 30) boost = 40; else if(delta > 10) boost = 15; else if(delta > 5) boost = 5;

        // Update UI
        $('out-new-util').textContent = nUtil.toFixed(1) + '%';
        $('out-impact-label').textContent = `ESTIMATED BOOST: +${boost} TO +${boost+20} PTS`;
        $('out-impact-label').style.backgroundColor = delta > 10 ? '#f0fdf4' : '#faf5ff';
        $('out-impact-label').style.color = delta > 10 ? '#10b981' : '#7e22ce';

        $('tbl-util-old').textContent = oUtil.toFixed(1) + '%';
        $('tbl-util-new').textContent = nUtil.toFixed(1) + '%';
        $('tbl-liq-old').textContent = '$' + Math.round(cLim - cBal).toLocaleString();
        $('tbl-liq-new').textContent = '$' + Math.round(nLim - nBal).toLocaleString();

        const getTier = (u) => u <= 10 ? 'ELITE' : (u <= 30 ? 'PRIME' : (u <= 50 ? 'FAIR' : 'POOR'));
        $('tbl-tier-old').textContent = getTier(oUtil);
        $('tbl-tier-new').textContent = getTier(nUtil);

        let advice = '';
        if(nUtil <= 10) advice = "Engineering Complete: You have reached the 'Elite' utilization tier. FICO penalty for utilization is now zero.";
        else if(nUtil <= 30) advice = "Good progress: You are in the 'Prime' zone. A few more paydowns will unlock the maximum score boost.";
        else advice = "Warning: Utilization remains high. Lenders still view this profile as higher risk despite the improvements.";
        $('out-advice').textContent = advice;
    }

    inputs.forEach(id => $(id).addEventListener('input', calculate));

    document.querySelectorAll('.lab-preset').forEach(btn => {
        btn.addEventListener('click', () => {
            $('l-lim').value = btn.dataset.l;
            $('l-bal').value = btn.dataset.b;
            $('l-cli').value = btn.dataset.cli;
            $('l-pay').value = btn.dataset.p;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        $('l-lim').value = 15000; $('l-bal').value = 5000; $('l-cli').value = 0; $('l-pay').value = 0;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Credit Optimization Blueprint\nTarget Utilization: ${$('out-new-util').textContent}\nProjected Boost: ${$('out-impact-label').textContent}\nAdvice: ${$('out-advice').textContent}\nGenerated by ToolsHub Credit Lab`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Blueprint Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.lab-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#2e1065;opacity:.7;margin-bottom:8px;display:block}
.lab-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-purple { background: #A855F7; color: #fff; transition: all .3s; }
.btn-purple:hover { background: #7E22CE; color: #fff; transform: translateY(-2px); }
.text-purple { color: #A855F7; }
.text-purple-900 { color: #2e1065; }
.bg-purple-soft { background: #FAF5FF; }
.bg-purple-50 { background-color: #fdfaff; }
.bg-purple { background-color: #A855F7 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

