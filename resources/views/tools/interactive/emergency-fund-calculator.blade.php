<div class="row g-4 emergency-fund-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Row 1: Expenses & Months --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Monthly Living Expenses</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="monthly-exp" class="form-control form-control-lg border-start-0" value="3500">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Target Safety Net (Months)</label>
                        <div class="input-group">
                            <input type="number" id="target-months" class="form-control form-control-lg border-end-0" value="6" min="1" max="36">
                            <span class="input-group-text bg-light border-start-0">Months</span>
                        </div>
                    </div>

                    {{-- Row 2: Current Status --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Currently Saved</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="saved-amt" class="form-control form-control-lg border-start-0" value="5000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Monthly Contribution</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="monthly-save" class="form-control form-control-lg border-start-0" value="400">
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 fund-quick" data-m="3">🛡️ Bare Minimum (3mo)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 fund-quick" data-m="6">🏰 Solid Guard (6mo)</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 fund-quick" data-m="12">🏛️ Fortress (12mo)</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:140;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.06);">
            <div class="output-hero">
                <span class="output-hero-label">TOTAL FUNDING GOAL</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-unit">$</span>
                    <span class="output-hero-value" id="out-goal">21,000</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-months-to-goal">Time to Goal: 40 Months</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#10b981; background: rgba(16,185,129,.02);">
                        <span class="stat-card-label">SAVINGS GAP</span>
                        <span class="stat-card-value text-success" id="out-gap">$16,000</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#3b82f6; background: rgba(59,130,246,.02);">
                        <span class="stat-card-label">CURRENT STATUS</span>
                        <span class="stat-card-value text-primary" id="out-current-status">1.4 Mo</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#f59e0b; background: rgba(245,158,11,.02);">
                        <span class="stat-card-label">FUNDED %</span>
                        <span class="stat-card-value text-warning" id="out-funded-pct">23%</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-shield-halved text-success me-2"></i>Safety Net Breakdown
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="fund-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-success"></i>Copy Saving Targets
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="fund-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="fund-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Plan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const expE = $('monthly-exp'), targetE = $('target-months'), 
          savedE = $('saved-amt'), contribE = $('monthly-save');

    function calculate(){
        let exp = parseFloat(expE.value) || 0;
        let months = parseFloat(targetE.value) || 0;
        let saved = parseFloat(savedE.value) || 0;
        let contrib = parseFloat(contribE.value) || 0;

        if(exp <= 0) return;

        const goal = exp * months;
        const gap = Math.max(0, goal - saved);
        const fundedPct = goal > 0 ? (saved / goal) * 100 : 0;
        const currentMonths = exp > 0 ? saved / exp : 0;
        
        // Time to goal
        let monthsToGoal = 0;
        if(gap > 0) {
            monthsToGoal = contrib > 0 ? gap / contrib : Infinity;
        }

        // Update UI
        $('out-goal').textContent = Math.round(goal).toLocaleString();
        $('out-months-to-goal').textContent = gap > 0 
            ? `Time to Goal: ${monthsToGoal === Infinity ? 'Indefinite' : Math.ceil(monthsToGoal) + ' Months'}`
            : 'STATUS: FULLY FUNDED';
        
        $('out-gap').textContent = '$' + Math.round(gap).toLocaleString();
        $('out-current-status').textContent = currentMonths.toFixed(1) + ' Mo';
        $('out-funded-pct').textContent = (fundedPct > 100 ? 100 : Math.round(fundedPct)) + '%';

        // Insights
        const ins = [];
        if(gap === 0) {
            ins.push('<strong>Fortress Achieved</strong>: Your emergency fund is fully funded according to your target. You have superior financial resilience.');
        } else {
            ins.push(`You have <strong>${currentMonths.toFixed(1)} months</strong> of expenses covered. Financial experts recommend at least 3-6 months.`);
        }

        if(months < 3) {
            ins.push('Note: A target below 3 months is risky for most households. Consider aiming for at least 90 days of survival funds.');
        }

        if(gap > 0 && contrib > 0) {
            ins.push(`At your current rate of $${contrib}/mo, you will reach your safety goal in <strong>${Math.ceil(monthsToGoal)} months</strong>.`);
        } else if(gap > 0 && contrib === 0) {
            ins.push('Alert: You currently have a funding gap but no monthly contribution set. Start small to build your buffer.');
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [expE, targetE, savedE, contribE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.fund-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            targetE.value = btn.dataset.m;
            calculate();
        });
    });

    $('fund-reset').addEventListener('click', ()=>{
        expE.value = 3500;
        targetE.value = 6;
        savedE.value = 5000;
        contribE.value = 400;
        calculate();
    });

    $('fund-copy-btn').addEventListener('click', function(){
        const text = `Emergency Fund Planner\nFunding Goal: $${$('out-goal').textContent}\nCurrent Coverage: ${$('out-current-status').textContent}\nFunding Progress: ${$('out-funded-pct').textContent}\nGenerated by ToolsHub Financial Safety Planner`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Plan Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.emergency-fund-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(16,185,129,.05)}
.emergency-fund-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.emergency-fund-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.emergency-fund-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.emergency-fund-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.emergency-fund-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
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
    .emergency-fund-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
