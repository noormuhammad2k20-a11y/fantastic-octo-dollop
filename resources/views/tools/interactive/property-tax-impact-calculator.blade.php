<div class="row g-4 tax-impact-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Base Property Data --}}
                    <div class="col-12 mb-1">
                        <h6 class="fw-bold mb-0 text-uppercase letter-spacing-1 text-muted small"><i class="fas fa-home text-warning me-2"></i>Property Tax Baseline</h6>
                        <hr class="mt-2 mb-0 opacity-10">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Current Property Assessed Value</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="tax-value" class="form-control form-control-lg border-start-0 ps-0" value="450000" step="1000">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Annual Property Tax Rate</label>
                        <div class="input-group">
                            <input type="number" id="tax-rate" class="form-control form-control-lg border-end-0" value="1.85" step="0.05">
                            <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom tooltip-label" title="Current Annual Tax Bill (Updates Automatically)">Current Annual Tax Bill</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-receipt"></i></span>
                            <div class="form-control form-control-lg border-start-0 ps-0 text-dark fw-bold bg-light" id="tax-annual-current">
                                $8,325
                            </div>
                        </div>
                    </div>

                    {{-- Long Term Projections --}}
                    <div class="col-12 mb-1 mt-4">
                        <h6 class="fw-bold mb-0 text-uppercase letter-spacing-1 text-muted small"><i class="fas fa-chart-line text-warning me-2"></i>Future Growth Projections</h6>
                        <hr class="mt-2 mb-0 opacity-10">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom" title="How much assessments rise per year">Yearly Reassessment Hike (%)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-level-up-alt"></i></span>
                            <input type="number" id="tax-hike" class="form-control form-control-lg border-start-0 ps-0" value="3.5" step="0.1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Years to Project</label>
                        <select id="tax-years" class="form-select form-select-lg">
                            <option value="5">5 Years (Short-Term)</option>
                            <option value="10">10 Years</option>
                            <option value="15" selected>15 Years (Mid-Term)</option>
                            <option value="30">30 Years (Full Mortgage)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Simulate Tax Reform Reset</label>
                        <select id="tax-cap" class="form-select form-select-lg">
                            <option value="0" selected>None (Uncapped)</option>
                            <option value="2">Cap Hikes at 2% / yr</option>
                            <option value="5">Cap Hikes at 5% / yr</option>
                        </select>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 align-items-center">
                    <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 tax-quick" data-r="0.5" data-h="2">Low Tax State (e.g. CO/Haw)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 tax-quick" data-r="2.4" data-h="5">High Tax State (e.g. NJ/TX)</button>
                    <div class="flex-grow-1"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#d97706;--tool-bg:#fffbeb;">
            <div class="row align-items-center mb-4">
                <div class="col-md-7 text-center text-md-start">
                    <span class="output-hero-label text-warning-dark">TOTAL TAXES PAID</span>
                    <div class="d-flex align-items-baseline justify-content-center justify-content-md-start">
                        <h2 class="output-hero-value m-0 text-dark" id="out-total-tax">$0</h2>
                        <span class="ms-2 fw-bold text-muted" id="out-year-label">over 15 years</span>
                    </div>
                </div>
                <div class="col-md-5 mt-4 mt-md-0">
                    <div class="payment-box">
                        <span class="stat-card-label">FINAL YEAR MONTHLY COST</span>
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <span class="fs-2 fw-black text-warning-dark" id="out-monthly-final">$0</span><span class="text-muted fw-bold ms-1 pb-1">/mo</span>
                        </div>
                        <div class="small text-secondary fw-bold mt-1" id="out-monthly-start">Starting at $0/mo</div>
                    </div>
                </div>
            </div>

            {{-- Tax Impact Visualizer Timeline --}}
            <div class="mt-4 p-4 bg-white rounded-4 border shadow-sm">
                <h6 class="fw-bold mb-4 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-chart-area text-warning me-2"></i>Tax Liability Growth Trajectory
                </h6>
                
                <div class="tax-ladder-container">
                    <div class="tax-ladder-row">
                        <div class="ladder-label">Year 1</div>
                        <div class="ladder-bar-wrap w-100"><div class="ladder-fill bg-warning" id="bar-y1"></div></div>
                        <div class="ladder-val text-dark fw-bold" id="val-y1">$0</div>
                    </div>
                    <div class="tax-ladder-row mt-3">
                        <div class="ladder-label">Year <span id="label-mid">5</span></div>
                        <div class="ladder-bar-wrap w-100"><div class="ladder-fill bg-warning opacity-75" id="bar-mid"></div></div>
                        <div class="ladder-val text-dark fw-bold" id="val-mid">$0</div>
                    </div>
                    <div class="tax-ladder-row mt-3">
                        <div class="ladder-label">Year <span id="label-end">15</span></div>
                        <div class="ladder-bar-wrap w-100"><div class="ladder-fill bg-danger opacity-75" id="bar-end"></div></div>
                        <div class="ladder-val text-danger fw-bold" id="val-end">$0</div>
                    </div>
                </div>
                
                <div class="mt-3 text-center small text-muted fw-bold">
                    Property Assessed Value Grows from <span id="out-prop-start" class="text-dark"></span> to <span id="out-prop-end" class="text-dark"></span>
                </div>
            </div>

            {{-- Insight Box --}}
            <div class="mt-4 print-hide">
                <div class="alert alert-soft-warning border-warning d-flex align-items-start gap-3 mb-0">
                    <i class="fas fa-building fs-4 mt-1 text-warning-dark"></i>
                    <div>
                        <h6 class="fw-bold mb-1 text-warning-dark">Tax-to-Principal Ratio Insight</h6>
                        <p class="mb-0 small" id="out-tip">Calculating insights...</p>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-4 print-hide">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="tax-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-warning"></i>Copy Tax Impact Report
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="tax-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Export Summary
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const fmtC = val => new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD', maximumFractionDigits: 0}).format(val);
    
    const els = {
        val: $('tax-value'), rate: $('tax-rate'),
        hike: $('tax-hike'), yrs: $('tax-years'), cap: $('tax-cap')
    };

    function calculateImpact() {
        const startVal = parseFloat(els.val.value) || 0;
        const taxRate = parseFloat(els.rate.value) || 0;
        let hike = parseFloat(els.hike.value) || 0;
        const yrs = parseInt(els.yrs.value) || 15;
        const cap = parseFloat(els.cap.value) || 0;

        // Apply Hard Caps if necessary (e.g. Prop 13 or similar limits)
        if(cap > 0 && hike > cap) {
            hike = cap;
        }

        const startAnnual = startVal * (taxRate / 100);
        $('tax-annual-current').textContent = fmtC(startAnnual);

        let totalTaxes = 0;
        let currentPropVal = startVal;
        
        let valMid = 0;
        let taxMid = 0;

        const midYear = Math.floor(yrs / 2);

        for (let i = 1; i <= yrs; i++) {
            let annualTax = currentPropVal * (taxRate / 100);
            totalTaxes += annualTax;
            
            if (i === midYear) {
                valMid = currentPropVal;
                taxMid = annualTax;
            }

            // End of year, value grows
            currentPropVal *= (1 + (hike / 100));
        }

        const endVal = currentPropVal;
        const endAnnualTax = endVal * (taxRate / 100);

        $('out-total-tax').textContent = fmtC(totalTaxes);
        $('out-year-label').textContent = `over ${yrs} years`;

        $('out-monthly-start').textContent = `Starting at ${fmtC(startAnnual/12)}/mo`;
        $('out-monthly-final').textContent = fmtC(endAnnualTax/12);

        // Logic for ladder
        const maxBarVal = endAnnualTax;
        $('bar-y1').style.width = ((startAnnual / maxBarVal) * 100) + '%';
        $('val-y1').textContent = fmtC(startAnnual);
        
        $('label-mid').textContent = midYear;
        $('bar-mid').style.width = ((taxMid / maxBarVal) * 100) + '%';
        $('val-mid').textContent = fmtC(taxMid);

        $('label-end').textContent = yrs;
        $('bar-end').style.width = '100%';
        $('val-end').textContent = fmtC(endAnnualTax);

        $('out-prop-start').textContent = fmtC(startVal);
        $('out-prop-end').textContent = fmtC(endVal);

        // Insight Logic
        const propPercentPaid = (totalTaxes / startVal) * 100;
        let insight = `Over ${yrs} years, you will pay <strong>${propPercentPaid.toFixed(1)}%</strong> of your original home's purchase price just in local property taxes. `;
        
        if (propPercentPaid > 50) {
            insight += `This is a tremendous long-term wealth drain. In high-tax jurisdictions, you essentially buy your house twice every 25-30 years.`;
        } else if (propPercentPaid > 20) {
            insight += `This represents a significant drag on equity building. Ensure this fits your long-term fixed-income retirement strategy.`;
        } else {
            insight += `This is a manageable tax burden relative to the property's value.`;
        }
        
        $('out-tip').innerHTML = insight;
    }

    // Event Listeners
    Object.values(els).forEach(el => el.addEventListener('input', calculateImpact));
    
    // Presets
    document.querySelectorAll('.tax-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            els.rate.value = e.target.dataset.r;
            els.hike.value = e.target.dataset.h;
            calculateImpact();
        });
    });

    $('tax-reset').addEventListener('click', () => {
        els.val.value = 450000; els.rate.value = 1.85; 
        els.hike.value = 3.5; els.yrs.value = 15; els.cap.value = 0;
        calculateImpact();
    });

    $('tax-copy-btn').addEventListener('click', function(){
        const text = `Property Tax Impact Forecast (${els.yrs.value} Years):\nStart Value: ${fmtC(els.val.value)} | Rate: ${els.rate.value}%\nProjected Taxes Paid: ${$('out-total-tax').textContent}\nFinal Year Tax Bill: ${$('val-end').textContent} (${$('out-monthly-final').textContent}/mo)\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculateImpact();
});
</script>

<style>
.tax-impact-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(217,119,6,.05)}
.tax-impact-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.tax-impact-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.tax-impact-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.tax-impact-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.tax-impact-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}

.text-warning-dark { color: #b45309 !important; }
.bg-soft-warning { background-color: #fffbeb !important; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem}
.output-hero-value{font-size:3.5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-2.5px}

.alert-soft-warning { background-color: #fefce8; color: #854d0e; }

.payment-box { background:#fff; border: 2px solid #e5e7eb; border-radius: 16px; padding: 1.5rem; text-align: left; }
.stat-card-label {font-size:.7rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:4px; display:block;}

.tax-ladder-row { display: flex; align-items: center; gap: 15px; }
.ladder-label { min-width: 60px; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; color: #64748b; }
.ladder-bar-wrap { background: #f1f5f9; height: 32px; border-radius: 16px; overflow: hidden; flex-grow: 1; position: relative;}
.ladder-fill { height: 100%; min-width: 5px; border-radius: 16px; transition: width 0.6s cubic-bezier(0.2, 0.8, 0.2, 1); }
.ladder-val { min-width: 80px; text-align: right; }

@media (max-width: 768px) {
    .tax-impact-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 2.5rem; }
}
@media print {
    .print-hide { display: none !important; }
    .output-card-themed { border: 1px solid #000; box-shadow: none; background: #fff !important; }
}
</style>

