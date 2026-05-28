<div class="row g-4 avalanche-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(99, 102, 241, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #6366F1, #4F46E5); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-mountain"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e1b4b; letter-spacing: -0.5px;">Debt Avalanche Mathematical Optimizer</h4>
                    <p class="text-muted small mb-0">Follow the path of absolute mathematical efficiency. Prioritize highest interest rates first to minimize the total cost of debt and maximize long-term savings.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div id="ava-debt-list" class="vstack gap-3 mb-4">
                    
                </div>

                <div class="p-4 rounded-4 bg-light border border-dashed text-center">
                    <button class="btn btn-indigo rounded-pill px-4 fw-bold shadow-sm mb-3" id="add-debt" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-plus-circle me-2"></i>Add New Debt
                    </button>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <label class="form-label-custom text-indigo">Extra Monthly Avalanche Surge ($)</label>
                            <div class="input-group input-group-lg bg-white rounded-4 border">
                                <span class="input-group-text border-0 bg-white opacity-40">+$</span>
                                <input type="number" id="v-extra" class="form-control border-0 bg-white fw-bold text-indigo" value="250">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-p="starter">CC & Loan Mix</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-p="heavy">High APR Crisis</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 245; --tool-color: #6366F1; --tool-bg: rgba(99, 102, 241, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">MATHEMATICAL DEBT FREE DATE</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-date">0 Months</div>
                <div class="badge bg-indigo-soft text-indigo px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">EFFICIENCY MAXIMIZED</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">AVALANCHE METRICS</th>
                                        <th class="text-muted small fw-bold py-3 text-end">VALUES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Total Interest Extracted</td>
                                        <td class="py-3 text-end text-danger fw-bold" id="tbl-total-int">$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Interest Savings vs Snowball</td>
                                        <td class="py-3 text-end text-success fw-bold" id="tbl-savings">$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">Interest Bleed Per Day</td>
                                        <td class="py-3 fw-black text-end h5 mb-0 text-danger" id="tbl-bleed">-$0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Efficiency Analytics</h6>
                            <div class="p-3 rounded-4 bg-indigo-50 border border-indigo-100 mb-4">
                                <div class="small fw-bold text-indigo-900 lh-base" id="out-advice">Calculating mathematical optimal path...</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-indigo rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-export me-2"></i>Copy Payoff Roadmap
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
    const list = $('ava-debt-list');

    function createRow(name = 'Debt', bal = 2500, min = 75, apr = 29.99){
        const row = document.createElement('div');
        row.className = 'p-3 rounded-4 bg-white border debt-item shadow-sm';
        row.innerHTML = `
            <div class="row g-3 align-items-center">
                <div class="col-md-3">
                    <label class="form-label-custom mb-1">Debt Label</label>
                    <input type="text" class="form-control border-0 bg-light rounded-3 fw-bold d-name" value="${name}">
                </div>
                <div class="col-md-3">
                    <label class="form-label-custom mb-1">Balance ($)</label>
                    <input type="number" class="form-control border-0 bg-light rounded-3 fw-bold d-bal" value="${bal}">
                </div>
                <div class="col-md-2">
                    <label class="form-label-custom mb-1">Min Pay ($)</label>
                    <input type="number" class="form-control border-0 bg-light rounded-3 fw-bold d-min" value="${min}">
                </div>
                <div class="col-md-2">
                    <label class="form-label-custom mb-1 text-danger">APR (%)</label>
                    <input type="number" class="form-control border-0 bg-light rounded-3 fw-bold d-apr" value="${apr}">
                </div>
                <div class="col-md-2 text-end">
                    <button class="btn btn-red-soft btn-sm rounded-3 rm-debt"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        `;
        row.querySelectorAll('input').forEach(i => i.addEventListener('input', calculate));
        row.querySelector('.rm-debt').addEventListener('click', () => {
            if(document.querySelectorAll('.debt-item').length > 1) { row.remove(); calculate(); }
        });
        list.appendChild(row);
        calculate();
    }

    function runSim(debts, extra, order = 'apr'){
        let sorted = [...debts];
        if(order === 'apr') sorted.sort((a,b) => b.apr - a.apr || b.bal - a.bal);
        else sorted.sort((a,b) => a.bal - b.bal); // snowball comparison

        let active = sorted.map(d => ({...d, r: d.apr/100/12}));
        let months = 0; let totalInt = 0;
        let sanity = 0;

        while(active.some(d => d.bal > 0) && sanity < 1200){
            sanity++; months++;
            let snowball = extra;
            active.forEach(d => { if(d.bal <= 0) snowball += d.min; });

            let targetFound = false;
            active.forEach(d => {
                if(d.bal <= 0) return;
                let iChg = d.bal * d.r;
                totalInt += iChg;
                d.bal += iChg;

                let pay = d.min;
                if(!targetFound){ targetFound = true; pay += snowball; }
                if(pay > d.bal) pay = d.bal;
                d.bal -= pay;
            });
        }
        return { mo: months, int: totalInt, broken: sanity >= 1200 };
    }

    function calculate(){
        const items = document.querySelectorAll('.debt-item');
        let extra = parseFloat($('v-extra').value) || 0;
        
        let debts = Array.from(items).map(item => ({
            bal: parseFloat(item.querySelector('.d-bal').value) || 0,
            min: parseFloat(item.querySelector('.d-min').value) || 0,
            apr: parseFloat(item.querySelector('.d-apr').value) || 0
        }));

        let avaRes = runSim(debts, extra, 'apr');
        let snowRes = runSim(debts, extra, 'bal');

        let totalPrin = debts.reduce((a,b) => a + b.bal, 0);
        let dailyBleed = debts.reduce((a,b) => a + (b.bal * (b.apr/100/365)), 0);

        // Update UI
        $('out-date').textContent = avaRes.broken ? 'Loop Detected' : (avaRes.mo >= 12 ? (avaRes.mo/12).toFixed(1) + ' Years' : avaRes.mo + ' Months');
        $('out-date').style.color = avaRes.broken ? '#ef4444' : '#6366F1';
        $('tbl-total-int').textContent = '$' + Math.round(avaRes.int).toLocaleString();
        $('tbl-savings').textContent = '$' + Math.round(Math.max(0, snowRes.int - avaRes.int)).toLocaleString();
        $('tbl-bleed').textContent = '-$' + dailyBleed.toFixed(2);

        let advice = '';
        if(avaRes.broken) advice = "CRITICAL: Interest is growing faster than your payments. You must increase your monthly surge or seek debt restructuring.";
        else if(snowRes.int - avaRes.int > 500) advice = "OPTIMAL: The Avalanche method is saving you significantly more than Snowball. Stick to this mathematically superior path.";
        else advice = "MATHEMATICAL: You are currently on the most efficient interest-minimization path. Every extra dollar saved here is a direct gain in net worth.";
        $('out-advice').textContent = advice;
    }

    $('v-extra').addEventListener('input', calculate);
    $('add-debt').addEventListener('click', () => createRow('New Debt', 5000, 150, 18));
    
    $('reset-calc').addEventListener('click', () => {
        list.innerHTML = '';
        createRow('Credit Card 1', 2500, 75, 29.99);
        createRow('Amex Gold', 6000, 150, 24.99);
        createRow('Auto Loan', 15000, 300, 6.5);
        $('v-extra').value = 250;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Debt Avalanche Optimization Plan\nInterest Savings: ${$('tbl-savings').textContent}\nDebt Free Date: ${$('out-date').textContent}\nDaily Bleed: ${$('tbl-bleed').textContent}\nGenerated by ToolsHub Avalanche Pro`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Roadmap Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    // Init
    createRow('Credit Card 1', 2500, 75, 29.99);
    createRow('Amex Gold', 6000, 150, 24.99);
    createRow('Auto Loan', 15000, 300, 6.5);
});
</script>

<style>
.avalanche-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e1b4b;opacity:.7;margin-bottom:4px;display:block}
.avalanche-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-indigo { background: #6366F1; color: #fff; transition: all .3s; }
.btn-indigo:hover { background: #4F46E5; color: #fff; transform: translateY(-2px); }
.btn-red-soft { background: #FEF2F2; color: #ef4444; border: 1px solid #fee2e2; }
.text-indigo { color: #6366F1; }
.text-indigo-900 { color: #1e1b4b; }
.bg-indigo-soft { background: #EEF2FF; }
.bg-indigo-50 { background-color: #f8faff; }
.bg-indigo { background-color: #6366F1 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\debt-avalanche-calculator.blade.php ENDPATH**/ ?>