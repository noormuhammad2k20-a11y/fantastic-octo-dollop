<?php $__env->startPush('styles'); ?>
<style>
    :root {
        --gs-hue: 142;
        --gs-primary: hsl(var(--gs-hue), 70%, 45%);
        --gs-primary-light: hsl(var(--gs-hue), 70%, 95%);
        --gs-primary-glow: hsla(var(--gs-hue), 70%, 45%, 0.15);
        --gs-bg-glass: rgba(255, 255, 255, 0.8);
        --gs-border: 1px solid rgba(0, 0, 0, 0.08);
        --gs-radius: 24px;
        --gs-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
    }

    .gs-rebuilt { font-family: 'Inter', sans-serif; color: #1e293b; }
    
    .gs-card {
        background: var(--gs-bg-glass);
        backdrop-filter: blur(12px);
        border: var(--gs-border);
        border-radius: var(--gs-radius);
        padding: 2rem;
        box-shadow: var(--gs-shadow);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 2rem;
        overflow: hidden;
        word-break: break-word;
    }
    
    .gs-card-output {
        background: linear-gradient(135deg, hsla(var(--gs-hue), 70%, 45%, 0.03), hsla(var(--gs-hue), 70%, 65%, 0.06));
        border: 2px solid var(--gs-primary-glow);
    }

    .gs-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
    .gs-icon-box {
        width: 60px; height: 60px; border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; background: var(--gs-primary-light); color: var(--gs-primary);
        box-shadow: 0 10px 25px var(--gs-primary-glow);
        flex-shrink: 0;
    }
    .gs-header h4 { margin: 0; font-weight: 700; letter-spacing: -0.5px; font-size: 1.5rem; color: #0f172a; }
    .gs-header p { margin: 0; color: #64748b; font-size: 0.95rem; }

    .gs-label { font-size: 0.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #475569; margin-bottom: 0.75rem; display: block; }
    .gs-input {
        border-radius: 16px !important; border: 2px solid #f1f5f9 !important;
        padding: 1rem 1.25rem !important; font-size: 1.1rem !important; font-weight: 600 !important;
        transition: all 0.2s !important; background: #fff !important;
    }
    .gs-input:focus { border-color: var(--gs-primary) !important; box-shadow: 0 0 0 4px var(--gs-primary-glow) !important; outline: none; }
    
    .gs-hero { text-align: center; padding-bottom: 2rem; border-bottom: 2px solid rgba(0,0,0,0.03); }
    .gs-hero-label { font-size: 0.8rem; font-weight: 900; letter-spacing: 3px; color: #64748b; text-transform: uppercase; margin-bottom: 0.75rem; display: block; }
    .gs-hero-value { font-size: 4rem; font-weight: 900; color: #0f172a; line-height: 1; letter-spacing: -2px; margin-bottom: 0.5rem; word-break: break-all; }
    
    .gs-stat-card {
        background: #fff; border: 1px solid rgba(0,0,0,0.05); border-radius: 20px;
        padding: 1.25rem 1rem; text-align: center; height: 100%;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .gs-stat-card:hover { transform: translateY(-4px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .gs-stat-label { font-size: 0.65rem; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.2px; margin-bottom: 0.4rem; display: block; }
    .gs-stat-value { font-size: 1.5rem; font-weight: 900; color: #0f172a; display: block; }

    .gs-progress-wrapper { background: #fff; padding: 2rem; border-radius: 24px; border: 1px solid rgba(0,0,0,0.05); margin-top: 2rem; }
    .gs-progress { height: 32px; border-radius: 100px; background: #f1f5f9; overflow: hidden; display: flex; }
    .gs-progress-bar { height: 100%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.8rem; color: #fff; transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1); }

    .proj-scroll { max-height: 400px; overflow-y: auto; border-radius: 16px; border: 1px solid #f1f5f9; }
    .gs-table { font-size: 0.85rem; }
    .gs-table thead { position: sticky; top: 0; background: #0f172a; color: #fff; z-index: 10; }
    .gs-table th { padding: 1rem; }
    .gs-table td { padding: 0.75rem 1rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }

    @media (max-width: 768px) {
        .gs-card { padding: 1.5rem; }
        .gs-header { flex-direction: column; text-align: center; gap: 0.75rem; }
        .gs-icon-box { width: 48px; height: 48px; font-size: 1.25rem; border-radius: 14px; margin: 0 auto; }
        .gs-header h4 { font-size: 1.25rem; }
        .gs-hero-value { font-size: 2.5rem; }
        .gs-stat-value { font-size: 1.25rem; }
    }

    @media print {
        .gs-card:not(.gs-card-output), .btn, .gs-presets, #sg-toggle-table { display: none !important; }
        .gs-card-output { border: none; box-shadow: none; padding: 0; }
        .proj-scroll { max-height: none !important; overflow: visible !important; }
    }
</style>
<?php $__env->stopPush(); ?>

<div class="gs-rebuilt">
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="gs-card">
                <div class="gs-header">
                    <div class="gs-icon-box"><i class="fas fa-piggy-bank"></i></div>
                    <div>
                        <h4>Savings Goal Planner</h4>
                        <p>Plan your path to financial freedom with precise target-based projections.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="gs-label">Financial Goal</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="sg-goal" class="form-control gs-input border-start-0" value="50000" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Initial Balance</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="sg-current" class="form-control gs-input border-start-0" value="5000" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Annual Return (%)</label>
                        <input type="number" id="sg-rate" class="form-control gs-input" value="7.5" step="0.1" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Time Horizon (Years)</label>
                        <input type="number" id="sg-years" class="form-control gs-input" value="10" min="1" max="50">
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Inflation Rate (%)</label>
                        <input type="number" id="sg-inflation" class="form-control gs-input" value="3" step="0.1" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Contribution Frequency</label>
                        <select id="sg-freq" class="form-select gs-input">
                            <option value="12" selected>Monthly</option>
                            <option value="26">Bi-Weekly</option>
                            <option value="52">Weekly</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Compounding</label>
                        <select id="sg-compound" class="form-select gs-input">
                            <option value="12" selected>Monthly</option>
                            <option value="4">Quarterly</option>
                            <option value="1">Annually</option>
                            <option value="365">Daily</option>
                        </select>
                    </div>
                </div>

                <div class="mt-5 gs-presets">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="fw-bold small text-uppercase text-muted"><i class="fas fa-bolt text-warning me-1"></i> Quick Goals:</span>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 sg-quick" data-g="10000" data-y="2">🏖️ Vacation $10K</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 sg-quick" data-g="100000" data-y="10">🏠 Down Payment</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 sg-quick" data-g="1000000" data-y="30">🎯 Millionaire</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label">Required Monthly Savings</span>
                    <div class="gs-hero-value"><span class="fs-2 text-muted opacity-50 me-2">$</span><span id="sg-monthly">0</span></div>
                    <div class="mt-2"><span class="badge rounded-pill px-4 py-2 fs-6 fw-bold shadow-sm" id="sg-badge">ACHIEVABLE</span></div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Total Contributions</span>
                            <span class="gs-stat-value text-primary" id="sg-contributed">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Interest Earned</span>
                            <span class="gs-stat-value text-success" id="sg-earned">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Future Real Value</span>
                            <span class="gs-stat-value text-warning" id="sg-real">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Goal Target</span>
                            <span class="gs-stat-value" style="color: #8b5cf6;" id="sg-target">$0</span>
                        </div>
                    </div>
                </div>

                <div class="gs-progress-wrapper">
                    <h6 class="fw-bold small text-uppercase text-muted mb-3 d-flex justify-content-between">
                        <span><i class="fas fa-chart-pie me-2 text-primary"></i>Growth Breakdown</span>
                        <span id="sg-progress-text">Contributions vs Interest</span>
                    </h6>
                    <div class="gs-progress">
                        <div class="gs-progress-bar" id="sg-bar-contrib" style="background: #3b82f6; width: 80%;">Contributions</div>
                        <div class="gs-progress-bar" id="gs-bar-interest" style="background: #10b981; width: 20%;">Interest</div>
                    </div>
                </div>

                <div class="mt-4 p-4 bg-white rounded-4 border shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold small text-uppercase text-muted mb-0"><i class="fas fa-table me-2 text-primary"></i>Year-by-Year Projection</h6>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 fw-bold" id="sg-toggle-table">Show Details</button>
                    </div>
                    <div id="sg-table-container" style="display:none;">
                        <div class="proj-scroll mt-3">
                            <table class="table gs-table mb-0">
                                <thead><tr><th>Year</th><th>Age (Year)</th><th>Contributions</th><th>Interest</th><th>End Balance</th></tr></thead>
                                <tbody id="sg-table-body"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="sg-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Analysis
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="sg-reset">
                        <i class="fas fa-rotate-left me-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const fmt = v => '$' + Math.round(v).toLocaleString('en-US');
    let yearlyData = [];

    function calculate(){
        const goal = parseFloat($('sg-goal').value) || 0;
        const current = parseFloat($('sg-current').value) || 0;
        const rate = (parseFloat($('sg-rate').value) || 0) / 100;
        const years = parseInt($('sg-years').value) || 1;
        const inf = (parseFloat($('sg-inflation').value) || 0) / 100;
        const n = parseInt($('sg-compound').value);
        const freq = parseInt($('sg-freq').value);

        const fvCurrent = current * Math.pow(1 + rate/n, n * years);
        const gap = Math.max(0, goal - fvCurrent);

        const periodicRate = rate / freq;
        const totalPeriods = freq * years;
        let payment = 0;
        if(gap > 0){
            if(periodicRate === 0){
                payment = gap / totalPeriods;
            } else {
                payment = gap * periodicRate / (Math.pow(1 + periodicRate, totalPeriods) - 1);
            }
        }

        const monthlyEquiv = payment * freq / 12;

        yearlyData = [];
        let balance = current;
        let totalContrib = current;
        const stepRate = rate / freq;

        for(let yr = 1; yr <= years; yr++){
            let yrStartBalance = balance;
            let yrContrib = 0;
            for(let f = 1; f <= freq; f++){
                const interest = balance * stepRate;
                balance += interest + payment;
                yrContrib += payment;
            }
            totalContrib += yrContrib;
            yearlyData.push({
                year: yr,
                contributions: totalContrib,
                interest: balance - totalContrib,
                balance: balance
            });
        }

        const totalInterest = balance - totalContrib;
        const realValue = balance / Math.pow(1 + inf, years);

        $('sg-monthly').textContent = Math.round(monthlyEquiv).toLocaleString('en-US');
        $('sg-contributed').textContent = fmt(totalContrib);
        $('sg-earned').textContent = fmt(totalInterest);
        $('sg-real').textContent = fmt(realValue);
        $('sg-target').textContent = fmt(goal);

        const badge = $('sg-badge');
        if(monthlyEquiv > 5000){ badge.textContent = '🔥 AGGRESSIVE'; badge.style.background = '#ef4444'; }
        else if(monthlyEquiv > 1500){ badge.textContent = '🚀 AMBITIOUS'; badge.style.background = '#f59e0b'; }
        else { badge.textContent = '✅ ACHIEVABLE'; badge.style.background = '#10b981'; }

        if(balance > 0){
            const cp = (totalContrib / balance) * 100;
            $('sg-bar-contrib').style.width = cp + '%';
            $('sg-bar-contrib').textContent = Math.round(cp) + '% Contrib';
            const iBar = $('gs-bar-interest');
            iBar.style.width = (100-cp) + '%';
            iBar.textContent = Math.round(100-cp) + '% Interest';
            $('sg-progress-text').textContent = `${Math.round(cp)}% Contributions • ${Math.round(100-cp)}% Compound Interest`;
        }

        $('sg-table-body').innerHTML = yearlyData.map(r => `<tr>
            <td class="fw-bold">Year ${r.year}</td>
            <td>+${r.year} yr</td>
            <td class="text-primary">${fmt(r.contributions)}</td>
            <td class="text-success">${fmt(r.interest)}</td>
            <td class="fw-bold">${fmt(r.balance)}</td>
        </tr>`).join('');
    }

    ['sg-goal','sg-current','sg-rate','sg-years','sg-inflation','sg-compound','sg-freq'].forEach(id => {
        $(id).addEventListener('input', calculate);
        $(id).addEventListener('change', calculate);
    });

    $('sg-toggle-table').addEventListener('click', function(){
        const c = $('sg-table-container');
        if(c.style.display === 'none'){
            c.style.display = '';
            this.textContent = 'Hide Details';
        } else {
            c.style.display = 'none';
            this.textContent = 'Show Details';
        }
    });

    document.querySelectorAll('.sg-quick').forEach(btn => btn.addEventListener('click', () => {
        $('sg-goal').value = btn.dataset.g;
        $('sg-years').value = btn.dataset.y;
        calculate();
    }));

    $('sg-copy').addEventListener('click', function(){
        const text = `Savings Goal Plan\nMonthly Savings: $${$('sg-monthly').textContent}\nGoal: ${$('sg-target').textContent}\nDuration: ${$('sg-years').value} Years\nInterest Earned: ${$('sg-earned').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('sg-reset').addEventListener('click', () => location.reload());
    calculate();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\savings-goal-calculator.blade.php ENDPATH**/ ?>