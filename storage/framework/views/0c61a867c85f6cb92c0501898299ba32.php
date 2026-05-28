<div class="row g-4 age-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(79, 70, 229, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #4F46E5, #3730A3); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e1b4b; letter-spacing: -0.5px;">Average Age of Accounts (AAoA) Architect</h4>
                    <p class="text-muted small mb-0">Manage the "Vintage" of your credit profile. Average age accounts for 15% of your FICO score. Model the impact of new applications before you apply.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div id="age-acct-list" class="vstack gap-3 mb-4">
                    
                </div>

                <div class="d-flex flex-wrap gap-2 pt-3 border-top">
                    <button class="btn btn-indigo rounded-pill px-4 fw-bold shadow-sm" id="add-acct-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-plus-circle me-2"></i>Add Active Account
                    </button>
                    <button class="btn btn-outline-indigo rounded-pill px-4 fw-bold" id="add-closed-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-archive me-2"></i>Add Closed Account
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 235; --tool-color: #4F46E5; --tool-bg: rgba(79, 70, 229, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">AVERAGE AGE OF ACCOUNTS</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-avg-age">0.0 Yrs</div>
                <div class="badge bg-indigo-soft text-indigo px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">NEEDS IMPROVEMENT</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">PORTFOLIO METRICS</th>
                                        <th class="text-muted small fw-bold py-3 text-end">DATA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Oldest Tradeline</td>
                                        <td class="py-3 text-end text-indigo fw-bold" id="tbl-oldest">0 Months</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Newest Tradeline</td>
                                        <td class="py-3 text-end" id="tbl-newest">0 Months</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">AAoA Scoring Impact</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-impact">POOR</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Impact Simulation</h6>
                            <div class="p-3 rounded-4 bg-light border mb-4">
                                <p class="small text-muted mb-2">If you open <strong id="sim-new-val">1</strong> new account today:</p>
                                <div class="h5 fw-bold mb-0 text-indigo" id="sim-res">New AAoA: 0.0 Yrs</div>
                                <div class="range-container mt-2">
                                    <input type="range" class="form-range" id="sim-count" min="1" max="5" value="1">
                                </div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-indigo rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-invoice me-2"></i>Copy Age Profile
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
    const list = $('age-acct-list');

    function createRow(age = 12, isClosed = false){
        const row = document.createElement('div');
        row.className = 'p-3 rounded-4 bg-white border d-flex align-items-center gap-3 shadow-sm acct-item';
        row.dataset.closed = isClosed ? "1" : "0";
        row.innerHTML = `
            <div class="flex-shrink-0 text-indigo opacity-50">
                <i class="fas ${isClosed ? 'fa-archive' : 'fa-credit-card'} fa-lg"></i>
            </div>
            <div class="flex-grow-1">
                <label class="form-label-custom mb-1">${isClosed ? 'Closed Account' : 'Active Account'} Age (Months)</label>
                <input type="number" class="form-control border-0 bg-light rounded-3 fw-bold acct-age" value="${age}">
            </div>
            <button class="btn btn-red-soft btn-sm rounded-3 rm-acct"><i class="fas fa-trash"></i></button>
        `;
        row.querySelector('.acct-age').addEventListener('input', calculate);
        row.querySelector('.rm-acct').addEventListener('click', () => { row.remove(); calculate(); });
        list.appendChild(row);
        calculate();
    }

    function calculate(){
        const items = document.querySelectorAll('.acct-item');
        let total = 0, count = 0, oldest = 0, newest = 9999;

        items.forEach(item => {
            let age = parseInt(item.querySelector('.acct-age').value) || 0;
            total += age;
            count++;
            if(age > oldest) oldest = age;
            if(age < newest) newest = age;
        });

        if(count === 0) newest = 0;

        let avgM = count > 0 ? (total / count) : 0;
        let avgY = (avgM / 12).toFixed(1);

        $('out-avg-age').textContent = avgY + ' Yrs';
        $('tbl-oldest').textContent = oldest + ' Months';
        $('tbl-newest').textContent = newest + ' Months';

        let status = 'NEEDS IMPROVEMENT'; let impact = 'POOR'; let col = '#ef4444';
        if(avgM >= 108) { status = 'EXCEPTIONAL'; impact = 'ELITE'; col = '#10b981'; }
        else if(avgM >= 84) { status = 'STRONG'; impact = 'GOOD'; col = '#22c55e'; }
        else if(avgM >= 60) { status = 'FAIR'; impact = 'AVERAGE'; col = '#f59e0b'; }

        $('out-status').textContent = status;
        $('out-status').style.color = col;
        $('tbl-impact').textContent = impact;
        $('tbl-impact').style.color = col;

        // Simulator
        let simCount = parseInt($('sim-count').value);
        $('sim-new-val').textContent = simCount;
        let simAvg = (total / (count + simCount)) / 12;
        $('sim-res').textContent = `New AAoA: ${simAvg.toFixed(1)} Yrs`;
    }

    $('add-acct-btn').addEventListener('click', () => createRow(12, false));
    $('add-closed-btn').addEventListener('click', () => createRow(60, true));
    $('sim-count').addEventListener('input', calculate);

    $('reset-calc').addEventListener('click', () => {
        list.innerHTML = '';
        createRow(120); createRow(24); createRow(6);
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Average Credit Age Profile\nAAoA: ${$('out-avg-age').textContent}\nOldest: ${$('tbl-oldest').textContent}\nScoring Impact: ${$('tbl-impact').textContent}\nGenerated by ToolsHub Heritage Pro`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Profile Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    // Init
    createRow(120); createRow(24); createRow(6);
});
</script>

<style>
.age-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e1b4b;opacity:.7;margin-bottom:4px;display:block}
.age-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-indigo { background: #4F46E5; color: #fff; transition: all .3s; }
.btn-indigo:hover { background: #3730A3; color: #fff; transform: translateY(-2px); }
.btn-outline-indigo { border-color: #4F46E5; color: #4F46E5; }
.btn-red-soft { background: #FEF2F2; color: #ef4444; border: 1px solid #fee2e2; }
.text-indigo { color: #4F46E5; }
.bg-indigo-soft { background: #EEF2FF; }
.bg-indigo { background-color: #4F46E5 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\credit-history-age-calculator.blade.php ENDPATH**/ ?>