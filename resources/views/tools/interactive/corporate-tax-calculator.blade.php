<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            {{-- Quick Presets --}}
            <div class="p-3 rounded-4 mb-4" style="background:#f8fafc;border:1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-magic text-primary me-2"></i>Quick Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-revenue="500000" data-cogs="200000" data-opex="100000" data-deductions="25000" data-credits="5000" data-rate="21" data-state="0">Small Business</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-revenue="5000000" data-cogs="2000000" data-opex="1500000" data-deductions="200000" data-credits="50000" data-rate="21" data-state="5">Mid-Size Corp</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-revenue="50000000" data-cogs="20000000" data-opex="15000000" data-deductions="2000000" data-credits="500000" data-rate="21" data-state="7.5">Enterprise</button>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px">Revenue &amp; Costs</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Gross Revenue</label>
                                <div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="ct-revenue" class="form-control form-control-lg rounded-end-3" value="500000" min="0"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">COGS</label>
                                <div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="ct-cogs" class="form-control form-control-lg rounded-end-3" value="200000" min="0"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Operating Expenses</label>
                                <div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="ct-opex" class="form-control form-control-lg rounded-end-3" value="100000" min="0"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px">Tax Parameters</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Federal Tax Rate</label>
                                <div class="input-group"><input type="number" id="ct-rate" class="form-control form-control-lg rounded-start-3" value="21" min="0" max="100" step="0.5"><span class="input-group-text bg-light fw-bold">%</span></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">State Tax Rate</label>
                                <div class="input-group"><input type="number" id="ct-state" class="form-control form-control-lg rounded-start-3" value="0" min="0" max="20" step="0.5"><span class="input-group-text bg-light fw-bold">%</span></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Deductions</label>
                                <div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="ct-deductions" class="form-control form-control-lg rounded-end-3" value="25000" min="0"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Tax Credits</label>
                                <div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="ct-credits" class="form-control form-control-lg rounded-end-3" value="5000" min="0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" id="btn-calculate" style="min-width:280px;max-width:100%">
                    <i class="fas fa-calculator me-2"></i> Calculate Tax
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(34,197,94,.1);"><i class="fas fa-check-circle" style="color:#22c55e"></i></div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Tax Analysis</h5>
                        <p class="text-muted small mb-0">Complete corporate tax breakdown</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width:120px"><i class="fas fa-copy me-1"></i> Copy Report</button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-dark mb-0" id="out-total-tax">$0</div>
                    <p class="text-muted fw-bold text-uppercase small" style="letter-spacing:1px">Total Tax Liability</p>
                    <div class="mt-2"><span class="badge rounded-pill px-4 py-2 fw-bold" id="out-status" style="background:#dcfce7;color:#16a34a">LOW TAX BURDEN</span></div>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Net Profit (Pre-Tax)</div>
                                <div class="h4 fw-bold mb-0 text-primary" id="out-pretax">$0</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">After-Tax Income</div>
                                <div class="h4 fw-bold mb-0 text-success" id="out-aftertax">$0</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Effective Rate</div>
                                <div class="h4 fw-bold mb-0 text-warning" id="out-effective">0%</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">State Tax</div>
                                <div class="h4 fw-bold mb-0 text-info" id="out-state-tax">$0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>Tax Distribution</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#3b82f6" id="bar-federal">Federal</div>
                <div class="progress-bar" style="background:#8b5cf6" id="bar-state">State</div>
                <div class="progress-bar" style="background:#22c55e" id="bar-after">After-Tax</div>
            </div>

            <div class="p-4 rounded-4 bg-light border shadow-sm mt-4">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted" style="letter-spacing:1px"><i class="fas fa-lightbulb text-warning me-2"></i>Tax Insights</h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy2" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy Summary</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-reset2" style="min-width:280px;max-width:100%"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>

<style>
    .tool-card-stacked { border-radius: 24px; background: #fff; }
    .icon-box { width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
    .form-control-lg, .form-select-lg { border: 1.5px solid #e2e8f0; font-size: 1.05rem; padding: 0.75rem 1rem; }
    .form-control:focus, .form-select:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79,70,229,.1); }
    .input-group-text { background: #f8fafc; border: 1.5px solid #e2e8f0; font-weight: bold; color: #64748b; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const fmt = v => '$' + Math.round(v).toLocaleString();
    const fmtP = v => v.toFixed(1) + '%';

    function calculate() {
        const revenue = parseFloat($('ct-revenue').value) || 0;
        const cogs = parseFloat($('ct-cogs').value) || 0;
        const opex = parseFloat($('ct-opex').value) || 0;
        const deductions = parseFloat($('ct-deductions').value) || 0;
        const credits = parseFloat($('ct-credits').value) || 0;
        const fedRate = parseFloat($('ct-rate').value) || 0;
        const stateRate = parseFloat($('ct-state').value) || 0;

        const grossProfit = revenue - cogs;
        const netProfit = grossProfit - opex;
        const taxableIncome = Math.max(0, netProfit - deductions);

        const federalTax = Math.max(0, taxableIncome * (fedRate / 100) - credits);
        const stateTax = taxableIncome * (stateRate / 100);
        const totalTax = federalTax + stateTax;
        const afterTax = netProfit - totalTax;
        const effectiveRate = netProfit > 0 ? (totalTax / netProfit) * 100 : 0;

        $('out-total-tax').textContent = fmt(totalTax);
        $('out-pretax').textContent = fmt(netProfit);
        $('out-aftertax').textContent = fmt(afterTax);
        $('out-effective').textContent = fmtP(effectiveRate);
        $('out-state-tax').textContent = fmt(stateTax);

        // Status badge
        const st = $('out-status');
        if (effectiveRate <= 15) { st.textContent = 'LOW TAX BURDEN'; st.style.background = '#dcfce7'; st.style.color = '#16a34a'; }
        else if (effectiveRate <= 25) { st.textContent = 'MODERATE TAX BURDEN'; st.style.background = '#fef3c7'; st.style.color = '#d97706'; }
        else { st.textContent = 'HIGH TAX BURDEN'; st.style.background = '#fee2e2'; st.style.color = '#dc2626'; }

        // Progress bars
        if (revenue > 0) {
            const fPct = (federalTax / revenue) * 100;
            const sPct = (stateTax / revenue) * 100;
            const aPct = Math.max(0, (afterTax / revenue) * 100);
            $('bar-federal').style.width = fPct + '%'; $('bar-federal').textContent = Math.round(fPct) + '% Fed';
            $('bar-state').style.width = sPct + '%'; $('bar-state').textContent = sPct > 2 ? Math.round(sPct) + '% State' : '';
            $('bar-after').style.width = aPct + '%'; $('bar-after').textContent = Math.round(aPct) + '% Retained';
        }

        // Insights
        const ins = [];
        ins.push(`Gross profit of <strong>${fmt(grossProfit)}</strong> from <strong>${fmt(revenue)}</strong> revenue (${revenue > 0 ? ((grossProfit/revenue)*100).toFixed(1) : 0}% margin).`);
        ins.push(`Taxable income after <strong>${fmt(deductions)}</strong> in deductions: <strong>${fmt(taxableIncome)}</strong>.`);
        if (credits > 0) ins.push(`Tax credits of <strong>${fmt(credits)}</strong> reduced your federal liability.`);
        if (stateRate > 0) ins.push(`State tax at ${stateRate}% adds <strong>${fmt(stateTax)}</strong> to your total burden.`);
        ins.push(`Your effective tax rate is <strong>${fmtP(effectiveRate)}</strong> vs. statutory ${fedRate}% federal rate.`);
        if (effectiveRate < fedRate) ins.push('🎯 Your effective rate is below the statutory rate — deductions & credits are working in your favor.');
        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    $('btn-calculate').addEventListener('click', function() {
        this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing...';
        this.disabled = true;
        setTimeout(() => { calculate(); this.innerHTML = '<i class="fas fa-calculator me-2"></i> Calculate Tax'; this.disabled = false; }, 400);
    });

    // Auto-calculate on input
    ['ct-revenue','ct-cogs','ct-opex','ct-deductions','ct-credits','ct-rate','ct-state'].forEach(id => $(id).addEventListener('input', calculate));

    // Presets
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            $('ct-revenue').value = btn.dataset.revenue;
            $('ct-cogs').value = btn.dataset.cogs;
            $('ct-opex').value = btn.dataset.opex;
            $('ct-deductions').value = btn.dataset.deductions;
            $('ct-credits').value = btn.dataset.credits;
            $('ct-rate').value = btn.dataset.rate;
            $('ct-state').value = btn.dataset.state;
            calculate();
        });
    });

    // Reset
    function resetForm() {
        $('ct-revenue').value = 500000; $('ct-cogs').value = 200000; $('ct-opex').value = 100000;
        $('ct-deductions').value = 25000; $('ct-credits').value = 5000; $('ct-rate').value = 21; $('ct-state').value = 0;
        calculate();
    }
    $('btn-reset').addEventListener('click', resetForm);
    $('btn-reset2').addEventListener('click', resetForm);

    // Copy
    function copyReport() {
        const t = `Corporate Tax Report\nRevenue: ${$('ct-revenue').value}\nTotal Tax: ${$('out-total-tax').textContent}\nAfter-Tax Income: ${$('out-aftertax').textContent}\nEffective Rate: ${$('out-effective').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(t).then(() => {
            ['btn-copy','btn-copy2'].forEach(id => { const b = $(id); if(b){const o=b.innerHTML;b.innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(()=>b.innerHTML=o,2000);} });
        });
    }
    $('btn-copy').addEventListener('click', copyReport);
    $('btn-copy2').addEventListener('click', copyReport);

    calculate();
});
</script>
