{{-- ═══════════════════════════════════════════════════════════════════ --}}
{{-- SALARY TAX CALCULATOR PAKISTAN — GOLD STANDARD REBUILT           --}}
{{-- ═══════════════════════════════════════════════════════════════════ --}}

<div class="tax-calc-pro tax-rebuilt" id="taxCalcApp">
    
    <div class="row g-4">
        {{-- Dashboard Tabs --}}
        <div class="col-lg-12">
            <div class="tax-tabs-bar">
                <button class="tax-tab active" data-tab="calculator"><i class="fas fa-calculator me-1"></i> Calculator</button>
                <button class="tax-tab" data-tab="breakdown"><i class="fas fa-chart-pie me-1"></i> Breakdown</button>
                <button class="tax-tab" data-tab="comparison"><i class="fas fa-exchange-alt me-1"></i> Comparison</button>
                <button class="tax-tab" data-tab="insights"><i class="fas fa-lightbulb me-1"></i> Insights</button>
            </div>
        </div>

        {{-- ═══════════ TAB 1: CALCULATOR ═══════════ --}}
        <div class="col-lg-12 tax-panel active" id="panel-calculator">
            <div class="row g-4">
                {{-- Inputs --}}
                <div class="col-lg-12">
                    <div class="calculator-card">
                        
                        <div class="calculator-body">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label-custom">Monthly Basic Salary</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light fw-bold">PKR</span>
                                        <input type="number" id="txMonthlySalary" class="form-control form-control-lg" placeholder="e.g. 150000" min="0">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label-custom">Monthly Bonus</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light fw-bold">PKR</span>
                                        <input type="number" id="txBonus" class="form-control form-control-lg" placeholder="0" min="0" value="0">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label-custom">Monthly Allowances</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light fw-bold">PKR</span>
                                        <input type="number" id="txAllowances" class="form-control form-control-lg" placeholder="0" min="0" value="0">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label-custom">Monthly Deductions</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light fw-bold">PKR</span>
                                        <input type="number" id="txDeductions" class="form-control form-control-lg" placeholder="0" min="0" value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="annual-summary-badge mt-4">
                                <div class="d-flex align-items-center">
                                    <div class="me-3 p-2 rounded-circle bg-white shadow-sm" style="color:#6366f1">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <div>
                                        <span class="small text-muted text-uppercase fw-bold ls-1">Annual Taxable Income</span>
                                        <div class="h4 fw-800 mb-0" id="txAnnualDisplay" style="color:#1e293b">PKR 0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Result Summary --}}
                <div class="col-lg-12">
                    <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(99,102,241,.04);">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-4 text-center border-end">
                                <span class="output-hero-label">ANNUAL TAX LIABILITY</span>
                                <div class="output-hero-value" id="rsAnnualTax" style="font-size: 2.8rem;">PKR 0</div>
                                <span class="output-hero-unit" id="rsEffectiveRateLabel">0% Effective Rate</span>
                                
                                <div class="mini-chart-wrap mt-4">
                                    <canvas id="miniDonut" width="160" height="160"></canvas>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);">
                                            <span class="stat-card-label">MONTHLY TAX</span>
                                            <span class="stat-card-value text-danger" id="rsMonthlyTax">PKR 0</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);">
                                            <span class="stat-card-label">NET ANNUAL SALARY</span>
                                            <span class="stat-card-value text-success" id="rsNetSalary">PKR 0</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);">
                                            <span class="stat-card-label">NET MONTHLY TAKE-HOME</span>
                                            <span class="stat-card-value text-primary" id="rsNetMonthly">PKR 0</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);">
                                            <span class="stat-card-label">DAILY INCOME</span>
                                            <span class="stat-card-value text-warning" id="rsDailyIncome">PKR 0</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="row g-2 mt-4">
                                    <div class="col-md-3"><button class="btn btn-dark w-100 py-2 fw-bold rounded-3" onclick="TaxCalc.exportPDF()"><i class="fas fa-file-pdf me-2"></i>PDF</button></div>
                                    <div class="col-md-3"><button class="btn btn-outline-dark w-100 py-2 fw-bold rounded-3" onclick="TaxCalc.exportCSV()"><i class="fas fa-file-csv me-2"></i>CSV</button></div>
                                    <div class="col-md-3"><button class="btn btn-outline-dark w-100 py-2 fw-bold rounded-3" onclick="TaxCalc.shareLink()"><i class="fas fa-share-alt me-2"></i>Share</button></div>
                                    <div class="col-md-3"><button class="btn btn-outline-dark w-100 py-2 fw-bold rounded-3" onclick="TaxCalc.saveToHistory()"><i class="fas fa-save me-2"></i>Save</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- History Panel --}}
                <div class="col-lg-12" id="historyPanel" style="display:none;">
                    <div class="calculator-card border-warning">
                        <div class="calculator-header">
                            <div class="tool-icon-circle" style="background:rgba(245,158,11,.1);color:#f59e0b"><i class="fas fa-history"></i></div>
                            <div>
                                <h4>Recent Calculations</h4>
                                <p>Your saved salary calculations</p>
                            </div>
                        </div>
                        <div class="calculator-body">
                            <div id="historyList" class="row g-2"></div>
                            <div class="mt-3"><button class="btn btn-sm btn-outline-danger rounded-pill" onclick="TaxCalc.clearHistory()"><i class="fas fa-trash me-2"></i>Clear History</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════ TAB 2: BREAKDOWN ═══════════ --}}
        <div class="col-lg-12 tax-panel" id="panel-breakdown">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="calculator-card h-100">
                        <div class="calculator-header">
                            <div class="tool-icon-circle" style="background:rgba(34,197,94,.1);color:#22c55e"><i class="fas fa-layer-group"></i></div>
                            <div><h4>Slab-wise Breakdown</h4><p>Detailed tax calculation per FBR bracket</p></div>
                        </div>
                        <div class="calculator-body">
                            <div id="slabAccordion" class="slab-accordion"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="calculator-card h-100">
                        <div class="calculator-header">
                            <div class="tool-icon-circle" style="background:rgba(59,130,246,.1);color:#3b82f6"><i class="fas fa-chart-bar"></i></div>
                            <div><h4>Tax Distribution</h4><p>Visualizing tax across all slabs</p></div>
                        </div>
                        <div class="calculator-body d-flex align-items-center justify-content-center">
                            <canvas id="slabBarChart" width="400" height="300" style="max-width:100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════ TAB 3: COMPARISON ═══════════ --}}
        <div class="col-lg-12 tax-panel" id="panel-comparison">
            <div class="calculator-card">
                <div class="calculator-header">
                    <div class="tool-icon-circle" style="background:rgba(239,68,68,.1);color:#ef4444"><i class="fas fa-balance-scale"></i></div>
                    <div><h4>Year-to-Year Comparison</h4><p>Compare liability: FY 2024-25 vs FY 2023-24</p></div>
                </div>
                <div class="calculator-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle border-0" id="comparisonTable">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 rounded-start">Metric</th>
                                    <th class="border-0">FY 2023-24</th>
                                    <th class="border-0">FY 2024-25</th>
                                    <th class="border-0 rounded-end">Difference</th>
                                </tr>
                            </thead>
                            <tbody id="comparisonBody"></tbody>
                        </table>
                    </div>
                    <div id="comparisonInsight" class="mt-4"></div>
                </div>
            </div>
        </div>

        {{-- ═══════════ TAB 4: INSIGHTS ═══════════ --}}
        <div class="col-lg-12 tax-panel" id="panel-insights">
            <div class="calculator-card">
                <div class="calculator-header">
                    <div class="tool-icon-circle" style="background:rgba(245,158,11,.1);color:#f59e0b"><i class="fas fa-brain"></i></div>
                    <div><h4>Financial Intelligence</h4><p>Smart insights based on your income profile</p></div>
                </div>
                <div class="calculator-body">
                    <div id="insightsList" class="row g-3">
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-calculator fa-3x mb-3 text-light"></i>
                            <p class="text-muted">Enter your salary details to unlock insights.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('seo_content')
<section class="seo-section professional-seo-content py-5">
    <div class="container-fluid p-0">
        <h2 class="h1 fw-800 mb-4">Pakistan Salary Tax Calculator <span class="text-primary">FY 2024-25</span></h2>
        <div class="row g-4">
            <div class="col-lg-8">
                <p class="lead">The most advanced and accurate <strong>Pakistan Salary Tax Calculator</strong> for the current financial year. Designed for salaried individuals and freelancers to plan their finances with precision.</p>
                <div class="mt-4">
                    <h4 class="fw-bold mb-3">Understanding the FBR Tax Framework</h4>
                    <p>The Government of Pakistan, through the Federal Board of Revenue (FBR), implemented new tax slabs for the financial year 2024-25. This calculator uses these official slabs to provide an instant, slab-wise breakdown of your income tax liability.</p>
                    <p>For FY 2024-25, the exemption limit remains at <strong>PKR 600,000</strong> annually. For income above this threshold, progressive rates apply ranging from 5% to 35%.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="p-4 rounded-4 bg-light border-start border-4 border-primary">
                    <h5 class="fw-bold mb-3"><i class="fas fa-shield-alt me-2 text-primary"></i>100% Client-Side</h5>
                    <p class="small mb-0">Your financial data never leaves your computer. All calculations are performed instantly in your browser, ensuring absolute privacy and data security.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('faq_content')
<section class="seo-section py-5 bg-white rounded-4 border my-4">
    <div class="container-fluid">
        <h2 class="fw-800 mb-4 text-center">Frequently Asked Questions</h2>
        <div class="accordion accordion-flush" id="taxFaqAccordion">
            <div class="accordion-item border-bottom">
                <h2 class="accordion-header"><button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#tfaq1">What are the FBR tax slabs for 2024-25?</button></h2>
                <div id="tfaq1" class="accordion-collapse collapse" data-bs-parent="#taxFaqAccordion"><div class="accordion-body">Salaried slabs range from 0% (up to 600k) to 35% (above 4.1M). This calculator applies the cumulative fixed tax plus percentage-based tax on the excess amount in each bracket.</div></div>
            </div>
            <div class="accordion-item border-bottom">
                <h2 class="accordion-header"><button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#tfaq2">How is my monthly tax calculated?</button></h2>
                <div id="tfaq2" class="accordion-collapse collapse" data-bs-parent="#taxFaqAccordion"><div class="accordion-body">We calculate your annual taxable income (Monthly x 12), determine the total annual tax based on FBR slabs, and then divide that total by 12 to get your monthly tax deduction.</div></div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header"><button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#tfaq3">Is this tool updated with the 2024 Budget?</button></h2>
                <div id="tfaq3" class="accordion-collapse collapse" data-bs-parent="#taxFaqAccordion"><div class="accordion-body">Yes! This calculator is fully compliant with the Finance Act 2024 and uses the latest tax slabs effective from July 1, 2024.</div></div>
            </div>
        </div>
    </div>
</section>
@endsection


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const TAX_SLABS = {
        '2024-25': [
            { min: 0,       max: 600000,   rate: 0,    fixed: 0 },
            { min: 600001,  max: 1200000,  rate: 0.05, fixed: 0 },
            { min: 1200001, max: 2200000,  rate: 0.15, fixed: 30000 },
            { min: 2200001, max: 3200000,  rate: 0.25, fixed: 180000 },
            { min: 3200001, max: 4100000,  rate: 0.30, fixed: 430000 },
            { min: 4100001, max: Infinity, rate: 0.35, fixed: 700000 },
        ],
        '2023-24': [
            { min: 0,       max: 600000,   rate: 0,    fixed: 0 },
            { min: 600001,  max: 1200000,  rate: 0.025,fixed: 0 },
            { min: 1200001, max: 2400000,  rate: 0.125,fixed: 15000 },
            { min: 2400001, max: 3600000,  rate: 0.225,fixed: 165000 },
            { min: 3600001, max: 6000000,  rate: 0.275,fixed: 435000 },
            { min: 6000001, max: Infinity, rate: 0.35, fixed: 1095000 },
        ]
    };

    const SLAB_LABELS = {
        '2024-25': ['0 – 600k', '600k – 1.2M', '1.2M – 2.2M', '2.2M – 3.2M', '3.2M – 4.1M', 'Above 4.1M'],
        '2023-24': ['0 – 600k', '600k – 1.2M', '1.2M – 2.4M', '2.4M – 3.6M', '3.6M – 6M', 'Above 6M']
    };

    function calculateTax(annualIncome, year = '2024-25') {
        const slabs = TAX_SLABS[year];
        let tax = 0; let activeSlabIndex = 0;
        const slabBreakdown = [];

        for (let i = 0; i < slabs.length; i++) {
            const slab = slabs[i];
            if (annualIncome <= slab.max || slab.max === Infinity) {
                const prevMax = i > 0 ? slabs[i-1].max : 0;
                const taxableInSlab = Math.max(0, annualIncome - prevMax);
                tax = slab.fixed + (taxableInSlab * slab.rate);
                activeSlabIndex = i;
                break;
            }
        }

        let remaining = annualIncome;
        for (let i = 0; i < slabs.length; i++) {
            const slab = slabs[i];
            const prevMax = i > 0 ? slabs[i-1].max : 0;
            const slabWidth = slab.max === Infinity ? Infinity : slab.max - prevMax;
            const incomeInSlab = Math.max(0, Math.min(remaining, slabWidth));
            const slabTax = incomeInSlab * slab.rate;
            slabBreakdown.push({ income: incomeInSlab, tax: slabTax, rate: slab.rate });
            remaining = Math.max(0, remaining - incomeInSlab);
        }

        return { tax, activeSlabIndex, slabBreakdown };
    }

    function fmt(n) { return 'PKR ' + Math.round(n).toLocaleString('en-PK'); }
    function fmtShort(n) { 
        if(n >= 100000) return (n/100000).toFixed(1) + 'L';
        if(n >= 1000) return (n/1000).toFixed(0) + 'K';
        return n;
    }

    const els = {
        salary: document.getElementById('txMonthlySalary'),
        bonus: document.getElementById('txBonus'),
        allowances: document.getElementById('txAllowances'),
        deductions: document.getElementById('txDeductions'),
        annualDisplay: document.getElementById('txAnnualDisplay'),
        annualTax: document.getElementById('rsAnnualTax'),
        monthlyTax: document.getElementById('rsMonthlyTax'),
        netSalary: document.getElementById('rsNetSalary'),
        netMonthly: document.getElementById('rsNetMonthly'),
        daily: document.getElementById('rsDailyIncome'),
        effRate: document.getElementById('rsEffectiveRateLabel')
    };

    let currentResult = null;

    function recalculate() {
        const m = parseFloat(els.salary.value) || 0;
        const b = parseFloat(els.bonus.value) || 0;
        const a = parseFloat(els.allowances.value) || 0;
        const d = parseFloat(els.deductions.value) || 0;
        const annualIncome = (m + b + a - d) * 12;

        els.annualDisplay.textContent = fmt(Math.max(0, annualIncome));
        const res = calculateTax(Math.max(0, annualIncome), '2024-25');
        const resPrev = calculateTax(Math.max(0, annualIncome), '2023-24');
        currentResult = { annualIncome, monthly: m, bonus: b, allowances: a, deductions: d, current: res, prev: resPrev };

        els.annualTax.textContent = fmt(res.tax);
        els.monthlyTax.textContent = fmt(res.tax / 12);
        els.netSalary.textContent = fmt(annualIncome - res.tax);
        els.netMonthly.textContent = fmt((annualIncome - res.tax) / 12);
        els.daily.textContent = fmt((annualIncome - res.tax) / 365);
        els.effRate.textContent = annualIncome > 0 ? (res.tax / annualIncome * 100).toFixed(2) + '% Effective Rate' : '0% Effective Rate';

        drawMiniDonut(res.tax, annualIncome);
        updateBreakdown(res, '2024-25');
        updateComparison(res, resPrev, annualIncome);
        updateInsights(res, resPrev, annualIncome);
    }

    [els.salary, els.bonus, els.allowances, els.deductions].forEach(el => el.addEventListener('input', recalculate));

    function drawMiniDonut(tax, income) {
        const canvas = document.getElementById('miniDonut');
        const ctx = canvas.getContext('2d');
        const dpr = window.devicePixelRatio || 1;
        canvas.width = 160 * dpr; canvas.height = 160 * dpr;
        canvas.style.width = '160px'; canvas.style.height = '160px';
        ctx.scale(dpr, dpr);
        ctx.clearRect(0, 0, 160, 160);
        const cx = 80, cy = 80, r = 55, lw = 15;
        const ratio = income > 0 ? tax / income : 0;
        ctx.beginPath(); ctx.arc(cx, cy, r, 0, Math.PI * 2);
        ctx.strokeStyle = '#f1f5f9'; ctx.lineWidth = lw; ctx.stroke();
        if(ratio > 0){
            ctx.beginPath(); ctx.arc(cx, cy, r, -Math.PI/2, -Math.PI/2 + (Math.PI*2*ratio));
            ctx.strokeStyle = '#ef4444'; ctx.lineWidth = lw; ctx.lineCap = 'round'; ctx.stroke();
        }
        ctx.fillStyle = '#1e293b'; ctx.font = 'bold 16px Inter'; ctx.textAlign = 'center';
        ctx.fillText((ratio*100).toFixed(1) + '%', cx, cy+5);
    }

    function updateBreakdown(res, year) {
        const labels = SLAB_LABELS[year];
        let html = '';
        res.slabBreakdown.forEach((s, i) => {
            const active = s.income > 0 ? 'slab-active' : '';
            const rate = (TAX_SLABS[year][i].rate * 100) + '%';
            html += `
            <div class="slab-item ${active}">
                <div class="slab-header" onclick="this.parentElement.classList.toggle('open')">
                    <div class="slab-info"><span class="slab-badge">${rate}</span><span class="slab-range">PKR ${labels[i]}</span></div>
                    <div class="slab-tax-amt">${s.income > 0 ? fmt(s.tax) : '—'}</div>
                    <i class="fas fa-chevron-down slab-chevron"></i>
                </div>
                <div class="slab-detail">
                    <p class="mb-1">Income in slab: <strong>${fmt(s.income)}</strong></p>
                    <p class="mb-0">Tax from this bracket: <strong>${fmt(s.tax)}</strong></p>
                </div>
            </div>`;
        });
        document.getElementById('slabAccordion').innerHTML = html;
        drawBarChart(res.slabBreakdown, labels);
    }

    function drawBarChart(breakdown, labels) {
        const canvas = document.getElementById('slabBarChart');
        const ctx = canvas.getContext('2d');
        const dpr = window.devicePixelRatio || 1;
        const W = 400, H = 240;
        canvas.width = W * dpr; canvas.height = H * dpr;
        canvas.style.width = W + 'px'; canvas.style.height = H + 'px';
        ctx.scale(dpr, dpr);
        const max = Math.max(...breakdown.map(s => s.tax), 1);
        breakdown.forEach((s, i) => {
            const bw = 40, gap = 20;
            const x = 40 + i * (bw + gap);
            const h = (s.tax / max) * 160;
            const y = 200 - h;
            ctx.fillStyle = s.tax > 0 ? '#6366f1' : '#f1f5f9';
            ctx.fillRect(x, y, bw, h);
            if(s.tax > 0){
                ctx.fillStyle = '#1e293b'; ctx.font = '9px Inter'; ctx.textAlign = 'center';
                ctx.fillText(fmtShort(s.tax), x + bw/2, y - 5);
            }
            ctx.fillStyle = '#64748b'; ctx.font = '9px Inter'; ctx.fillText('S' + (i+1), x + bw/2, 215);
        });
    }

    function updateComparison(curr, prev, income) {
        const diff = curr.tax - prev.tax;
        const html = `
            <tr><td class="fw-bold">Annual Tax</td><td>${fmt(prev.tax)}</td><td>${fmt(curr.tax)}</td><td class="${diff > 0 ? 'text-danger' : 'text-success'}">${diff > 0 ? '+' : ''}${fmt(diff)}</td></tr>
            <tr><td class="fw-bold">Monthly Tax</td><td>${fmt(prev.tax/12)}</td><td>${fmt(curr.tax/12)}</td><td class="${diff > 0 ? 'text-danger' : 'text-success'}">${diff > 0 ? '+' : ''}${fmt(diff/12)}</td></tr>
            <tr><td class="fw-bold">Net Salary</td><td>${fmt(income - prev.tax)}</td><td>${fmt(income - curr.tax)}</td><td class="${diff < 0 ? 'text-success' : 'text-danger'}">${-diff > 0 ? '+' : ''}${fmt(-diff)}</td></tr>
        `;
        document.getElementById('comparisonBody').innerHTML = html;
        const insight = document.getElementById('comparisonInsight');
        if(income > 0) {
            if(diff > 0) insight.innerHTML = `<div class="p-3 rounded-3 bg-danger-subtle text-danger small"><i class="fas fa-arrow-up me-2"></i>Tax increased by <strong>${fmt(diff)}</strong> vs last year.</div>`;
            else if(diff < 0) insight.innerHTML = `<div class="p-3 rounded-3 bg-success-subtle text-success small"><i class="fas fa-arrow-down me-2"></i>Tax decreased by <strong>${fmt(Math.abs(diff))}</strong> vs last year!</div>`;
            else insight.innerHTML = `<div class="p-3 rounded-3 bg-info-subtle text-info small"><i class="fas fa-equals me-2"></i>No change in tax liability.</div>`;
        }
    }

    function updateInsights(res, prev, income) {
        const container = document.getElementById('insightsList');
        if(income <= 0) return;
        const insights = [
            {icon:'fa-wallet', color:'#6366f1', title:'Monthly Take-home', desc:'Your estimated net monthly income after tax is <strong>'+fmt((income - res.tax)/12)+'</strong>.'},
            {icon:'fa-percentage', color:'#22c55e', title:'Effective Rate', desc:'Your effective tax rate is <strong>'+(res.tax/income*100).toFixed(2)+'%</strong>.'},
            {icon:'fa-layer-group', color:'#f59e0b', title:'Top Slab', desc:'Your marginal tax rate (top slab) is <strong>'+(TAX_SLABS['2024-25'][res.activeSlabIndex].rate*100)+'%</strong>.'}
        ];
        container.innerHTML = insights.map(i => `
            <div class="col-md-4">
                <div class="insight-card p-3 rounded-4 border h-100 transition-all">
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2 p-2 rounded-3" style="background:${i.color}15; color:${i.color}"><i class="fas ${i.icon}"></i></div>
                        <div class="fw-bold small">${i.title}</div>
                    </div>
                    <p class="small text-muted mb-0">${i.desc}</p>
                </div>
            </div>
        `).join('');
    }

    window.TaxCalc = {
        exportPDF() {
            const { jsPDF } = window.jspdf; const doc = new jsPDF();
            doc.text('Pakistan Salary Tax Report', 14, 20);
            doc.text('Taxable Income: ' + fmt(currentResult.annualIncome), 14, 30);
            doc.text('Annual Tax: ' + fmt(currentResult.current.tax), 14, 40);
            doc.save('tax-report.pdf');
        },
        exportCSV() {
            let csv = 'Field,Value\nIncome,' + currentResult.annualIncome + '\nTax,' + currentResult.current.tax;
            const blob = new Blob([csv], { type: 'text/csv' });
            const a = document.createElement('a'); a.href = URL.createObjectURL(blob); a.download = 'tax.csv'; a.click();
        },
        shareLink() {
            const url = window.location.origin + window.location.pathname + '?salary=' + els.salary.value;
            navigator.clipboard.writeText(url).then(() => alert('Link copied!'));
        },
        saveToHistory() {
            const h = JSON.parse(localStorage.getItem('txHist') || '[]');
            h.unshift({val: els.salary.value, date: new Date().toLocaleDateString()});
            localStorage.setItem('txHist', JSON.stringify(h.slice(0,5)));
            loadHistory();
        },
        clearHistory() { localStorage.removeItem('txHist'); loadHistory(); }
    };

    function loadHistory() {
        const h = JSON.parse(localStorage.getItem('txHist') || '[]');
        const list = document.getElementById('historyList');
        if(!h.length) { document.getElementById('historyPanel').style.display = 'none'; return; }
        document.getElementById('historyPanel').style.display = 'block';
        list.innerHTML = h.map(item => `
            <div class="col-md-4">
                <div class="p-3 bg-light rounded-3 border small" style="cursor:pointer" onclick="document.getElementById('txMonthlySalary').value='${item.val}'; document.getElementById('txMonthlySalary').dispatchEvent(new Event('input'))">
                    <div class="text-muted mb-1">${item.date}</div>
                    <div class="fw-bold">PKR ${item.val}/mo</div>
                </div>
            </div>
        `).join('');
    }

    document.querySelectorAll('.tax-tab').forEach(t => t.addEventListener('click', function(){
        document.querySelectorAll('.tax-tab, .tax-panel').forEach(x => x.classList.remove('active'));
        this.classList.add('active'); document.getElementById('panel-'+this.dataset.tab).classList.add('active');
    }));

    loadHistory(); recalculate();
});
</script>

<style>
.tax-rebuilt .tax-tabs-bar { display: flex; gap: 8px; overflow-x: auto; padding: 6px; background: #fff; border: 1px solid #e5e7eb; border-radius: 16px; margin-bottom: 1.5rem; }
.tax-rebuilt .tax-tab { flex: 1; border: none; background: transparent; padding: 10px 20px; border-radius: 12px; font-weight: 700; font-size: 0.85rem; color: #64748b; white-space: nowrap; transition: all 0.2s; }
.tax-rebuilt .tax-tab.active { background: #6366f1; color: #fff; box-shadow: 0 4px 12px rgba(99,102,241,0.2); }
.tax-rebuilt .tax-panel { display: none; }
.tax-rebuilt .tax-panel.active { display: block; animation: fadeInUp 0.4s ease forwards; }
.tax-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,0.04); }
.tax-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2rem; }
.tax-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.tax-rebuilt .tool-icon-circle { width: 60px; height: 60px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.tax-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .8px; margin-bottom: .5rem; display: block; }
.tax-rebuilt .annual-summary-badge { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 1.25rem; }
.tax-rebuilt .ls-1 { letter-spacing: 1px; }
.tax-rebuilt .fw-800 { font-weight: 800; }
.tax-rebuilt .slab-item { border: 1px solid #e5e7eb; border-radius: 12px; margin-bottom: 8px; overflow: hidden; }
.tax-rebuilt .slab-header { display: flex; align-items: center; justify-content: space-between; padding: 12px 16px; cursor: pointer; }
.tax-rebuilt .slab-badge { background: #f1f5f9; color: #475569; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
.tax-rebuilt .slab-detail { max-height: 0; overflow: hidden; transition: max-height 0.3s ease; background: #f8fafc; }
.tax-rebuilt .slab-item.open .slab-detail { max-height: 100px; padding: 12px 16px; border-top: 1px solid #e5e7eb; }
.tax-rebuilt .slab-active { border-color: #6366f1; background: #f5f3ff; }
.tax-rebuilt .slab-active .slab-badge { background: #6366f1; color: #fff; }
@keyframes fadeInUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
</style>
