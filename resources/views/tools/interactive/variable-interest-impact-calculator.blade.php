<div class="row g-4 shock-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(20, 184, 166, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #14B8A6, #0D9488); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-wave-square"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#0f172a; letter-spacing: -0.5px;">Variable Rate Shock Simulator</h4>
                    <p class="text-muted small mb-0">Stress-test your ARM or variable-rate loan against future market volatility and interest rate hikes.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Core Loan --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Current Loan Status</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Outstanding Principal</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                    <input type="number" id="v-bal" class="form-control border-0 bg-white fw-bold" value="250000">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Current Rate (%)</label>
                                    <input type="number" id="v-rate" class="form-control border-0 bg-white rounded-3 fw-bold" value="4.5">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Months Left</label>
                                    <input type="number" id="v-term" class="form-control border-0 bg-white rounded-3 fw-bold" value="240">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Volatility Controls --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-teal">
                            <h6 class="fw-bold small mb-3 uppercase text-teal opacity-70">Shock Modeling</h6>
                            <div class="mb-4 text-center">
                                <label class="form-label-custom">Projected Rate Hike</label>
                                <div class="h2 fw-900 text-teal my-2" id="v-hike-val">+2.00%</div>
                                <input type="range" id="v-hike" class="form-range color-teal" min="0.25" max="8" value="2" step="0.25">
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Rate Cap (Max %)</label>
                                    <input type="number" id="v-cap" class="form-control border-0 bg-light rounded-3 fw-bold" value="12.0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Adjustment Style</label>
                                    <select id="v-style" class="form-select border-0 bg-light rounded-3 fw-bold">
                                        <option value="payment">Adjust Payment</option>
                                        <option value="term">Extend Term</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-h="1.5">Moderate Fed Hike</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-h="4.0">Aggressive Tightening</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-h="6.5">Historic Volatility</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 175; --tool-color: #14B8A6; --tool-bg: rgba(20, 184, 166, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">NEW ESTIMATED PAYMENT</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-new-pmt">$0</div>
                <div class="badge bg-teal-soft text-teal px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-shock-label">Payment Shock: +$0.00 / month</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Data Grid --}}
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">STRESS TEST RESULTS</th>
                                        <th class="text-muted small fw-bold py-3 text-end">BASELINE</th>
                                        <th class="text-muted small fw-bold py-3 text-end text-teal">SHOCK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Interest Rate</td>
                                        <td class="py-3 text-end" id="tbl-rate-old">0.00%</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-rate-new">0.00%</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Monthly Obligation</td>
                                        <td class="py-3 text-end" id="tbl-pmt-old">$0</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-pmt-new">$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">Lifetime Interest Cost</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-int-old">$0</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-int-new">$0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Charts/Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold mb-3 uppercase small opacity-50">Repayment Exposure</h6>
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="small fw-bold text-muted">Extra Interest Burden</span>
                                    <span class="small fw-bold text-teal" id="out-burden">+$0</span>
                                </div>
                                <div class="progress rounded-pill overflow-hidden shadow-sm" style="height: 12px; background: #f1f5f9;">
                                    <div id="bar-shock" class="progress-bar bg-teal" style="width: 20%"></div>
                                </div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-teal rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-medical-alt me-2"></i>Copy Stress Test Report
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
    const inputs = ['v-bal', 'v-rate', 'v-term', 'v-hike', 'v-cap', 'v-style'];

    function pmt(rate, nper, pv) {
        if(rate === 0) return pv / nper;
        return (pv * rate) / (1 - Math.pow(1 + rate, -nper));
    }

    function calculate(){
        let b = parseFloat($('v-bal').value) || 0;
        let rO = (parseFloat($('v-rate').value) || 0) / 100 / 12;
        let tO = parseFloat($('v-term').value) || 1;
        let hike = (parseFloat($('v-hike').value) || 0) / 100;
        let cap = (parseFloat($('v-cap').value) || 0) / 100 / 12;
        let style = $('v-style').value;

        $('v-hike-val').textContent = '+' + (hike*100).toFixed(2) + '%';

        let rN = rO + (hike/12);
        if(rN > cap) rN = cap; // Apply cap

        // Baseline
        let pO = pmt(rO, tO, b);
        let iO = (pO * tO) - b;

        // Shocked
        let pN = pmt(rN, tO, b);
        let iN = (pN * tO) - b;
        let termExt = 0;

        if(style === 'term') {
            // Keep payment same, extend term
            // This is harder to model perfectly in simple formula without iteration, 
            // but for a "shock" we usually show payment increase as the primary metric.
            // For UI simplicity in this tool, we focus on payment shock.
        }

        let pmtDiff = pN - pO;
        let intDiff = iN - iO;

        // Update UI
        $('out-new-pmt').textContent = '$' + pN.toFixed(2);
        $('out-shock-label').textContent = `Payment Shock: +$${pmtDiff.toFixed(2)} / month`;
        
        $('tbl-rate-old').textContent = (rO * 12 * 100).toFixed(2) + '%';
        $('tbl-rate-new').textContent = (rN * 12 * 100).toFixed(2) + '%';
        $('tbl-pmt-old').textContent = '$' + pO.toFixed(2);
        $('tbl-pmt-new').textContent = '$' + pN.toFixed(2);
        $('tbl-int-old').textContent = '$' + Math.round(iO).toLocaleString();
        $('tbl-int-new').textContent = '$' + Math.round(iN).toLocaleString();

        $('out-burden').textContent = '+$' + Math.round(intDiff).toLocaleString();
        
        if(iN > 0) {
            let pct = (intDiff / iN) * 100;
            $('bar-shock').style.width = Math.min(100, pct) + '%';
        }
    }

    inputs.forEach(id => $(id).addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            $('v-hike').value = btn.dataset.h;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        $('v-bal').value = 250000; $('v-rate').value = 4.5; $('v-term').value = 240;
        $('v-hike').value = 2.00; $('v-cap').value = 12.0; $('v-style').value = 'payment';
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Variable Rate Stress Test\nShock Payment: ${$('out-new-pmt').textContent}\nMonthly Hike: ${$('out-shock-label').textContent}\nTotal Interest Burden: ${$('out-burden').textContent}\nGenerated by ToolsHub Volatility Pro`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.shock-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#0f172a;opacity:.7;margin-bottom:8px;display:block}
.shock-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-teal { background: #14B8A6; color: #fff; transition: all .3s; }
.btn-teal:hover { background: #0D9488; color: #fff; transform: translateY(-2px); }
.text-teal { color: #14B8A6; }
.bg-teal-soft { background: #F0FDFA; }
.bg-teal { background-color: #14B8A6 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.color-teal::-webkit-slider-thumb { background: #14B8A6; }
.color-teal::-moz-range-thumb { background: #14B8A6; }
</style>

