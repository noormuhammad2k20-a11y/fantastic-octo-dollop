<div class="row g-4 roi-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Total Ad Budget</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light fw-bold">$</span>
                            <input type="number" id="fb-budget" class="form-control form-control-lg" value="1000" min="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Industry Niche</label>
                        <select id="fb-industry" class="form-select form-select-lg">
                            <option value="ecommerce">E-Commerce</option>
                            <option value="b2b">B2B / SaaS</option>
                            <option value="realestate">Real Estate</option>
                            <option value="fitness">Fitness & Health</option>
                            <option value="local">Local Business / Service</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Ad Objective</label>
                        <select id="fb-objective" class="form-select form-select-lg">
                            <option value="traffic">Traffic (Link Clicks)</option>
                            <option value="leads">Lead Generation</option>
                            <option value="sales">Conversions (Sales)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:214;--tool-color:#1877f2;--tool-bg:rgba(24,119,242,.04);">
            <div class="output-hero">
                <span class="output-hero-label">ESTIMATED RESULTS</span>
                <div class="output-hero-value" id="fb-est-results">1,250 Clicks</div>
                <span class="output-hero-unit" id="fb-est-reach">Estimated Reach: 50,000 - 80,000</span>
            </div>
            
            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <div class="stat-card" style="border-color:#e5e7eb;background:#fff;padding:1.5rem;border-radius:16px;text-align:center;border:1px solid #e5e7eb">
                        <span class="form-label-custom mb-1">Average CPC</span>
                        <span class="fs-4 fw-bold" id="fb-cpc">$0.80</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card" style="border-color:#e5e7eb;background:#fff;padding:1.5rem;border-radius:16px;text-align:center;border:1px solid #e5e7eb">
                        <span class="form-label-custom mb-1">Average CPM</span>
                        <span class="fs-4 fw-bold" id="fb-cpm">$14.50</span>
                    </div>
                </div>
            </div>

            <div class="mt-4" id="fb-insights"></div>
            
            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="fb-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2"></i>Copy Result
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="fb-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-rotate-left me-2"></i>Reset Fields
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function fmt(v){ return Math.round(v).toLocaleString(); }
    
    const benchmarks = {
        ecommerce: { cpc: 0.70, cpm: 12.00, cpl: 15.00, cpa: 25.00 },
        b2b: { cpc: 2.50, cpm: 18.00, cpl: 45.00, cpa: 120.00 },
        realestate: { cpc: 1.80, cpm: 15.00, cpl: 35.00, cpa: 150.00 },
        fitness: { cpc: 1.20, cpm: 10.00, cpl: 20.00, cpa: 40.00 },
        local: { cpc: 0.90, cpm: 11.00, cpl: 18.00, cpa: 30.00 }
    };

    function calculate() {
        const budget = parseFloat($('fb-budget').value) || 0;
        const ind = $('fb-industry').value;
        const obj = $('fb-objective').value;
        
        if (budget <= 0) {
            $('fb-est-results').textContent = '0';
            $('fb-est-reach').textContent = 'Estimated Reach: 0';
            $('fb-cpc').textContent = '$0.00';
            $('fb-cpm').textContent = '$0.00';
            $('fb-insights').innerHTML = '';
            return;
        }

        const bData = benchmarks[ind];
        let cpc = bData.cpc;
        let cpm = bData.cpm;
        let resultCost = 0;
        let resultLabel = '';

        if (obj === 'traffic') {
            resultCost = cpc;
            resultLabel = 'Clicks';
        } else if (obj === 'leads') {
            resultCost = bData.cpl;
            resultLabel = 'Leads';
        } else if (obj === 'sales') {
            resultCost = bData.cpa;
            resultLabel = 'Sales / Conversions';
        }

        const estResults = budget / resultCost;
        const estImpressions = (budget / cpm) * 1000;
        // Reach is usually 70-85% of impressions due to frequency
        const reachLow = estImpressions * 0.7;
        const reachHigh = estImpressions * 0.85;

        $('fb-est-results').textContent = fmt(estResults) + ' ' + resultLabel;
        $('fb-est-reach').textContent = `Estimated Reach: ${fmt(reachLow)} - ${fmt(reachHigh)}`;
        $('fb-cpc').textContent = '$' + cpc.toFixed(2);
        $('fb-cpm').textContent = '$' + cpm.toFixed(2);

        let ins = [];
        ins.push(`Based on your budget of $${budget}, you are projected to acquire approx. <strong>${fmt(estResults)} ${resultLabel}</strong>.`);
        ins.push(`Your ads will be seen an estimated <strong>${fmt(estImpressions)} times</strong> (Impressions).`);
        
        if (obj === 'leads' || obj === 'sales') {
            ins.push(`Your Cost Per ${resultLabel === 'Leads' ? 'Lead' : 'Acquisition (CPA)'} benchmark is $${resultCost.toFixed(2)}.`);
        }
        
        if (budget < 300) {
            ins.push('Note: Budgets under $300/month may struggle to exit the learning phase quickly. Expect higher initial volatility.');
        } else {
            ins.push('Your budget provides enough data to exit the Facebook learning phase quickly for optimal delivery.');
        }

        $('fb-insights').innerHTML = '<h6 class="fw-bold mb-3"><i class="fas fa-lightbulb me-2 text-warning"></i>Campaign Insights</h6>' + 
                                     '<ul class="list-unstyled mb-0">' + 
                                     ins.map(i => `<li class="mb-2 pb-1" style="font-size:0.9rem"><i class="fas fa-check-circle text-success me-2"></i>${i}</li>`).join('') + 
                                     '</ul>';
    }

    ['fb-budget', 'fb-industry', 'fb-objective'].forEach(id => $(id).addEventListener('input', calculate));
    $('fb-industry').addEventListener('change', calculate);
    $('fb-objective').addEventListener('change', calculate);

    $('fb-copy').addEventListener('click', function() {
        const ind = $('fb-industry').options[$('fb-industry').selectedIndex].text;
        const t = `Facebook Ad Estimates (${ind})\nBudget: $${$('fb-budget').value}\n${$('fb-est-results').textContent}\n${$('fb-est-reach').textContent}\nAvg CPC: ${$('fb-cpc').textContent}\nAvg CPM: ${$('fb-cpm').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(t).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('fb-reset').addEventListener('click', () => {
        $('fb-budget').value = 1000;
        $('fb-industry').value = 'ecommerce';
        $('fb-objective').value = 'traffic';
        calculate();
    });

    calculate();
});
</script>

<style>
.roi-rebuilt .calculator-card { background:#fff; border:1px solid #e5e7eb; border-radius:20px; padding:2rem; box-shadow:0 4px 24px rgba(0,0,0,.04); }
.roi-rebuilt .calculator-header { display:flex; align-items:center; gap:1.25rem; margin-bottom:2rem; }
.roi-rebuilt .calculator-header h4 { margin:0; font-weight:800; color:#1e293b; font-size:1.4rem; }
.roi-rebuilt .calculator-header p { margin:0; font-size:0.95rem; color:#64748b; }
.roi-rebuilt .tool-icon-circle { width:60px; height:60px; border-radius:16px; display:flex; align-items:center; justify-content:center; font-size:1.6rem; flex-shrink:0; }
.roi-rebuilt .form-label-custom { font-size:.8rem; font-weight:700; color:#475569; text-transform:uppercase; letter-spacing:.8px; margin-bottom:.5rem; display:block; }
.roi-rebuilt .output-card-themed { background:var(--tool-bg); border:1px solid rgba(0,0,0,.05); border-radius:20px; padding:2rem; }
.roi-rebuilt .output-hero { background:#fff; border-radius:16px; padding:2rem; text-align:center; box-shadow:0 4px 12px rgba(0,0,0,.02); border:1px solid rgba(0,0,0,.04); }
.roi-rebuilt .output-hero-label { font-size:.85rem; font-weight:700; color:#64748b; letter-spacing:1px; display:block; margin-bottom:.5rem; }
.roi-rebuilt .output-hero-value { font-size:2.5rem; font-weight:800; color:var(--tool-color); line-height:1.2; margin-bottom:.5rem; }
.roi-rebuilt .output-hero-unit { font-size:1rem; font-weight:700; color:#475569; }
.roi-rebuilt .overflow-x-auto { overflow-x: auto; }
.roi-rebuilt .break-words { word-break: break-word; }
@media(max-width:768px){ 
    .roi-rebuilt .calculator-card, .roi-rebuilt .output-card-themed { padding:1.5rem; }
    .roi-rebuilt .output-hero-value { font-size:2rem; }
    .roi-rebuilt .calculator-header h4 { font-size:1.2rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\facebook-ad-cost-calculator.blade.php ENDPATH**/ ?>