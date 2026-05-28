<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            
            <div class="p-3 rounded-4 mb-4" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3 letter-spacing-1"><i class="fas fa-bolt text-warning me-2"></i>Income Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 planner-quick" data-i="3000">🥗 Entry Level ($3k)</button>
                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 planner-quick" data-i="7500">💼 Professional ($7.5k)</button>
                    <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3 planner-quick" data-i="15000">🏢 Executive ($15k)</button>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Income & Profile</h6>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Monthly Net Income</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" id="monthly-income" class="form-control form-control-lg rounded-3" value="5000">
                            </div>
                        </div>
                        <div>
                            <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Risk Profile</label>
                            <select id="risk-profile" class="form-select form-select-lg rounded-3">
                                <option value="conservative">Conservative (Safety First)</option>
                                <option value="moderate" selected>Moderate (Balanced Growth)</option>
                                <option value="aggressive">Aggressive (Wealth Building)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Current Spending</h6>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Current 'Needs'</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" id="current-needs" class="form-control form-control-lg rounded-3" value="2800">
                            </div>
                            <small class="text-muted">Essentials, Rent, Utilities</small>
                        </div>
                        <div>
                            <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Current 'Wants'</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" id="current-wants" class="form-control form-control-lg rounded-3" value="1200">
                            </div>
                            <small class="text-muted">Dining, Hobbies, Travel</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-brain me-2"></i> Generate AI Plan
                </button>
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-chart-pie text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Financial Execution Plan</h5>
                        <p class="text-muted small mb-0">AI-optimized budget allocation</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="planner-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Plan
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-primary mb-0" id="out-savings">$0</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">Target Monthly Savings (20%)</p>
                    <div class="mt-2 text-muted fw-bold small" id="out-total-budget">Total Managed Budget: $5,000</div>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Needs (50%)</div>
                                <div class="h4 fw-bold mb-0 text-dark" id="out-needs-cap">$0</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Wants (30%)</div>
                                <div class="h4 fw-bold mb-0 text-pink" id="out-wants-cap">$0</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 rounded-4 bg-primary text-white text-center shadow-sm">
                                <div class="small fw-bold text-uppercase mb-1 opacity-75">AI Recommended Strategy</div>
                                <div class="h5 fw-bold mb-0" id="out-strategy">Index Funds</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 bg-white border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-shield-alt text-primary me-2"></i>AI Budget Compliance Audit
                </h6>
                <div id="out-insights" class="small text-secondary">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }

    .tool-card-stacked { border-radius: 24px; background: #fff; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-control-lg, .form-select-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.1rem; padding: 0.75rem 1rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }
    
    .input-group-text { background: #f8fafc; border: 1.5px solid var(--border-color); border-right: none; border-radius: 12px 0 0 12px; font-weight: bold; color: #64748b; }
    .input-group .form-control { border-left: none; }

    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .text-pink { color: #ec4899; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const incE = document.getElementById('monthly-income');
    const riskE = document.getElementById('risk-profile');
    const needsE = document.getElementById('current-needs');
    const wantsE = document.getElementById('current-wants');
    
    const resultCard = document.getElementById('result-card');
    const outSavings = document.getElementById('out-savings');
    const outTotalBudget = document.getElementById('out-total-budget');
    const outNeedsCap = document.getElementById('out-needs-cap');
    const outWantsCap = document.getElementById('out-wants-cap');
    const outStrategy = document.getElementById('out-strategy');
    const outInsights = document.getElementById('out-insights');
    const btnCalculate = document.getElementById('btn-calculate');

    function calculate() {
        const inc = parseFloat(incE.value) || 0;
        const cNeeds = parseFloat(needsE.value) || 0;
        const cWants = parseFloat(wantsE.value) || 0;
        const risk = riskE.value;

        if (inc <= 0) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // 50/30/20 Rule
            const targetNeeds = inc * 0.5;
            const targetWants = inc * 0.3;
            const targetSavings = inc * 0.2;

            // Investment Strategy
            let strategy = 'High Yield Savings';
            if (risk === 'moderate') strategy = 'Index Funds (60/40 Portfolio)';
            if (risk === 'aggressive') strategy = 'Growth Stocks & Dynamic Assets';

            outSavings.textContent = '$' + Math.round(targetSavings).toLocaleString();
            outTotalBudget.textContent = `Total Managed Budget: $${Math.round(inc).toLocaleString()}`;
            outNeedsCap.textContent = '$' + Math.round(targetNeeds).toLocaleString();
            outWantsCap.textContent = '$' + Math.round(targetWants).toLocaleString();
            outStrategy.textContent = strategy;

            // AI Audit Insights
            const ins = [];
            const needsDiff = cNeeds - targetNeeds;
            const wantsDiff = cWants - targetWants;

            if (needsDiff > 0) {
                ins.push(`<strong>Needs Over Budget</strong>: You are overspending on essentials by <strong>$${Math.round(needsDiff).toLocaleString()}</strong>. Prioritize lowering fixed costs.`);
            } else {
                ins.push('<strong>Optimal Essentials</strong>: Your needs are within the 50% threshold. You have a solid foundation.');
            }

            if (wantsDiff > 0) {
                ins.push(`<strong>Lifestyle Inflation</strong>: Discretionary spending is <strong>$${Math.round(wantsDiff).toLocaleString()}</strong> above target. Consider "conscious spending" cuts.`);
            } else {
                ins.push('<strong>Disciplined Lifestyle</strong>: Your "wants" are under control, maximizing your wealth-building velocity.');
            }

            if (targetSavings > 1500) {
                ins.push('<strong>Wealth Accelerator</strong>: High savings rate detected. You are on the fast track to financial independence.');
            }

            outInsights.innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-primary me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-brain me-2"></i> Generate AI Plan';
            btnCalculate.disabled = false;
        }, 600);
    }

    btnCalculate.addEventListener('click', calculate);

    document.querySelectorAll('.planner-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            incE.value = btn.dataset.i;
            calculate();
        });
    });

    document.getElementById('planner-reset').addEventListener('click', () => {
        incE.value = 5000;
        riskE.value = 'moderate';
        needsE.value = 2800;
        wantsE.value = 1200;
        resultCard.classList.add('d-none');
    });

    document.getElementById('planner-copy-btn').addEventListener('click', function() {
        const text = `AI Financial Execution Plan\nMonthly Income: $${incE.value}\nSavings Target: ${outSavings.textContent}\nStrategy: ${outStrategy.textContent}\nAllocations: 50% Needs, 30% Wants, 20% Savings\nGenerated by ToolsHub AI Planner`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-1"></i> Plan Copied!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\ai-financial-planner.blade.php ENDPATH**/ ?>