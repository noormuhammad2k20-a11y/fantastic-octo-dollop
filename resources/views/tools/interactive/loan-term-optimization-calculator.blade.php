<div class="row g-4 term-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(14, 165, 233, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #0EA5E9, #0284C7); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-sliders-h"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#0c4a6e; letter-spacing: -0.5px;">Term Optimization Matrix</h4>
                    <p class="text-muted small mb-0">Navigate the trade-off between monthly affordability and long-term interest costs. Find your financial "Sweet Spot".</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Parameters --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Loan Parameters</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Total Loan Amount</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                    <input type="number" id="v-amt" class="form-control border-0 bg-white fw-bold" value="30000">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Base Interest Rate (%)</label>
                                    <input type="number" id="v-rate" class="form-control border-0 bg-white rounded-3 fw-bold" value="6.5">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Dynamic Slider --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-sky">
                            <h6 class="fw-bold small mb-3 uppercase text-sky opacity-70">Duration Control</h6>
                            <div class="mb-5 text-center">
                                <div class="display-5 fw-900 text-sky mb-2" id="v-term-display">60 Mo</div>
                                <input type="range" id="v-term" class="form-range color-sky" min="12" max="360" value="60" step="12">
                                <div class="d-flex justify-content-between px-1 small text-muted">
                                    <span>1 Yr</span>
                                    <span>30 Yrs</span>
                                </div>
                            </div>
                            <div class="form-check form-switch p-0 d-flex align-items-center justify-content-between">
                                <label class="form-check-label fw-bold small text-muted">Tiered Rate Modeling (Short = Lower %)</label>
                                <input class="form-check-input ms-0" type="checkbox" id="v-tiered">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 195; --tool-color: #0EA5E9; --tool-bg: rgba(14, 165, 233, .04);">
            <div class="output-hero text-center py-5">
                <div class="row g-0 justify-content-center">
                    <div class="col-md-4 border-end">
                        <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">MONTHLY PAYMENT</span>
                        <div class="output-hero-value h1 fw-900 my-2" id="out-pmt">$0.00</div>
                    </div>
                    <div class="col-md-4">
                        <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL INTEREST</span>
                        <div class="output-hero-value h1 fw-900 my-2 text-sky" id="out-int">$0</div>
                    </div>
                </div>
                <div class="badge bg-sky-soft text-sky px-4 py-2 rounded-pill fw-bold shadow-sm mt-3" id="out-summary">Select a term to analyze efficiency</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Matrix --}}
                    <div class="col-md-8">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Comparative Term Matrix</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="small fw-bold py-2">TERM</th>
                                        <th class="small fw-bold py-2">PAYMENT</th>
                                        <th class="small fw-bold py-2 text-end">TOTAL COST</th>
                                        <th class="small fw-bold py-2 text-end">INTEREST</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-matrix">
                                    {{-- JS Driven --}}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-4 border-start">
                        <div class="ps-md-4">
                            <div class="p-3 rounded-4 bg-sky-50 border border-sky-100 mb-4">
                                <h6 class="fw-bold small mb-2 uppercase opacity-50">Cost of Borrowing</h6>
                                <div class="h4 fw-bold text-sky-900 mb-0" id="out-cost-pct">0%</div>
                                <div class="small text-muted mt-1">Extra paid per $1 borrowed</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-sky rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Optimal Profile
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
    const amtE = $('v-amt'), rateE = $('v-rate'), termE = $('v-term'), tieredE = $('v-tiered');

    function pmt(rate, nper, pv) {
        if(rate === 0) return pv / nper;
        return (pv * rate) / (1 - Math.pow(1 + rate, -nper));
    }

    function calculate(){
        let principal = parseFloat(amtE.value) || 0;
        let baseRate = parseFloat(rateE.value) || 0;
        let selectedTerm = parseInt(termE.value) || 12;
        let isTiered = tieredE.checked;

        $('v-term-display').textContent = selectedTerm + ' Mo';

        // Helper to get rate for a term
        const getRate = (m) => {
            if(!isTiered) return baseRate;
            // Simplified tier: +0.25% for every 12 months over 36
            let extra = Math.max(0, Math.floor((m - 36) / 12) * 0.25);
            return baseRate + extra;
        };

        // Current Selection
        let currentRate = getRate(selectedTerm);
        let p = pmt(currentRate/100/12, selectedTerm, principal);
        let i = (p * selectedTerm) - principal;

        $('out-pmt').textContent = '$' + p.toFixed(2);
        $('out-int').textContent = '$' + Math.round(i).toLocaleString();
        $('out-cost-pct').textContent = ((i / principal) * 100).toFixed(1) + '%';
        $('out-summary').textContent = `Total Repayment: $${Math.round(principal + i).toLocaleString()}`;

        // Build Matrix
        let matrixHtml = '';
        const tiers = [12, 24, 36, 48, 60, 72, 84];
        tiers.forEach(t => {
            let tr = getRate(t);
            let tp = pmt(tr/100/12, t, principal);
            let ti = (tp * t) - principal;
            let isCurrent = t === selectedTerm;
            matrixHtml += `
                <tr class="${isCurrent ? 'bg-sky-soft fw-bold' : ''}">
                    <td class="py-2">${t} Mo</td>
                    <td class="py-2">$${tp.toFixed(0)}</td>
                    <td class="py-2 text-end">$${Math.round(principal + ti).toLocaleString()}</td>
                    <td class="py-2 text-end text-danger">$${Math.round(ti).toLocaleString()}</td>
                </tr>
            `;
        });
        $('tbl-matrix').innerHTML = matrixHtml;
    }

    [amtE, rateE, termE, tieredE].forEach(e => e.addEventListener('input', calculate));

    $('reset-calc').addEventListener('click', () => {
        amtE.value = 30000; rateE.value = 6.5; termE.value = 60; tieredE.checked = false;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Loan Term Optimization\nSelected Term: ${$('v-term-display').textContent}\nMonthly Payment: ${$('out-pmt').textContent}\nTotal Interest: ${$('out-int').textContent}\nGenerated by ToolsHub Optimizer`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.term-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#0c4a6e;opacity:.7;margin-bottom:8px;display:block}
.term-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-sky { background: #0EA5E9; color: #fff; transition: all .3s; }
.btn-sky:hover { background: #0284C7; color: #fff; transform: translateY(-2px); }
.text-sky { color: #0EA5E9; }
.text-sky-900 { color: #0c4a6e; }
.bg-sky-soft { background: #F0F9FF; }
.bg-sky-50 { background-color: #f8fafc; }
.bg-sky { background-color: #0EA5E9 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.color-sky::-webkit-slider-thumb { background: #0EA5E9; }
.color-sky::-moz-range-thumb { background: #0EA5E9; }
</style>

