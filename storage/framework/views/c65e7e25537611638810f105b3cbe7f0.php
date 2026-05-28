<div class="row g-4 estate-tax-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Gross Asset Value</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="total-assets" class="form-control form-control-lg border-start-0" value="15500000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Debts & Mortgages</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="total-debts" class="form-control form-control-lg border-start-0" value="500000">
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Filing Status</label>
                        <select id="marital-status" class="form-select form-select-lg">
                            <option value="single">Single (Standard Exemption)</option>
                            <option value="married" selected>Married (Double Exemption)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Exemption Limit ($)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="fed-exemption" class="form-control form-control-lg border-start-0" value="13610000" step="10000">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">State Tax Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="state-rate" class="form-control form-control-lg border-end-0" value="0" min="0" max="20">
                            <span class="input-group-text bg-light border-start-0">%</span>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 estate-quick" data-a="5000000">🏛️ Standard Estate</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 estate-quick" data-a="25000000">🏰 High Net Worth</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 estate-quick" data-a="100000000">🤴 Ultra HNW</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(124,58,237,.06);">
            <div class="output-hero">
                <span class="output-hero-label">TOTAL ESTIMATED ESTATE TAX</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-unit">$</span>
                    <span class="output-hero-value" id="out-tax-total">0</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-net-inheritance">Net Estate to Heirs: $15,000,000</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#7c3aed; background: rgba(124,58,237,.02);">
                        <span class="stat-card-label">NET TAXABLE ESTATE</span>
                        <span class="stat-card-value text-purple" id="out-taxable">$0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#10b981; background: rgba(16,185,129,.02);">
                        <span class="stat-card-label">FEDERAL TAX</span>
                        <span class="stat-card-value text-success" id="out-fed-tax">$0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#f59e0b; background: rgba(245,158,11,.02);">
                        <span class="stat-card-label">EFFECTIVE RATE</span>
                        <span class="stat-card-value text-warning" id="out-eff-rate">0%</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-file-invoice-dollar text-purple me-2"></i>Tax Liability Assessment
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="estate-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-purple"></i>Copy Tax Summary
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="estate-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="estate-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Send to Lawyer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const assetsE = $('total-assets'), debtE = $('total-debts'), 
          statusE = $('marital-status'), exemptE = $('fed-exemption'), stateE = $('state-rate');

    function calculate(){
        let assets = parseFloat(assetsE.value) || 0;
        let debts = parseFloat(debtE.value) || 0;
        let status = statusE.value;
        let baseExempt = parseFloat(exemptE.value) || 0;
        let stateRate = (parseFloat(stateE.value) || 0) / 100;

        const netEstate = assets - debts;
        
        // Multiplier for marital status (portability)
        const activeExempt = status === 'married' ? baseExempt * 2 : baseExempt;

        const taxableEstate = Math.max(0, netEstate - activeExempt);

        // Federal Tax (Roughly 40% for the top bracket above the exemption)
        const fedTax = taxableEstate * 0.40;
        
        // State Tax (Rough estimate)
        const stateTax = taxableEstate * stateRate;

        const totalTax = fedTax + stateTax;
        const netInheritance = netEstate - totalTax;
        const effRate = netEstate > 0 ? (totalTax / netEstate) * 100 : 0;

        // Update UI
        $('out-tax-total').textContent = Math.round(totalTax).toLocaleString();
        $('out-net-inheritance').textContent = `Net Estate to Heirs: $${Math.round(netInheritance).toLocaleString()}`;
        
        $('out-taxable').textContent = '$' + Math.round(taxableEstate).toLocaleString();
        $('out-fed-tax').textContent = '$' + Math.round(fedTax).toLocaleString();
        $('out-eff-rate').textContent = effRate.toFixed(1) + '%';

        // Insights
        const ins = [];
        if(taxableEstate === 0) {
            ins.push('<strong>Shielded Estate</strong>: Your current assets are fully covered by the federal exemption. No federal estate tax is estimated.');
        } else {
            ins.push(`Your taxable estate is estimated at <strong>$${Math.round(taxableEstate).toLocaleString()}</strong> after exemptions.`);
        }

        if(status === 'single' && netEstate > baseExempt) {
            ins.push('Note: Marital portability could double your exemption. Consider consulting a professional on joint estate planning.');
        }

        if(effRate > 15) {
            ins.push('<strong>High Tax Impact</strong>: More than 15% of your wealth is lost to taxes. Explore trusts, gifting strategies, or life insurance to cover liquidity.');
        }

        if(stateRate > 0) {
            ins.push(`State tax of ${stateE.value}% added. Ensure this matches your specific state's inheritance/estate tax laws.`);
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-purple me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [assetsE, debtE, statusE, exemptE, stateE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.estate-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            assetsE.value = btn.dataset.a;
            calculate();
        });
    });

    $('estate-reset').addEventListener('click', ()=>{
        assetsE.value = 15500000;
        debtE.value = 500000;
        statusE.value = 'married';
        exemptE.value = 13610000;
        stateE.value = 0;
        calculate();
    });

    $('estate-copy-btn').addEventListener('click', function(){
        const text = `Estate Tax Assessment\nTotal Tax Liability: $${$('out-tax-total').textContent}\nNet to Heirs: ${$('out-net-inheritance').textContent}\nEffective Rate: ${$('out-eff-rate').textContent}\nGenerated by ToolsHub Wealth Transfer Planner`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Summary Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.estate-tax-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(124,58,237,.05)}
.estate-tax-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.estate-tax-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.estate-tax-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.estate-tax-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.estate-tax-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:2rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .estate-tax-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\estate-tax-calculator.blade.php ENDPATH**/ ?>