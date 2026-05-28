<div class="row g-4 snowball-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(14, 165, 233, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #0EA5E9, #0284C7); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-snowflake"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#0c4a6e; letter-spacing: -0.5px;">Debt Snowball Momentum Engine</h4>
                    <p class="text-muted small mb-0">Harness psychological momentum. Pay off your smallest debts first to build "wins" and fuel your journey toward total financial freedom.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div id="snow-debt-list" class="vstack gap-3 mb-4">
                    {{-- JS Injected Debt Rows --}}
                </div>

                <div class="p-4 rounded-4 bg-light border border-dashed text-center">
                    <button class="btn btn-sky rounded-pill px-4 fw-bold shadow-sm mb-3" id="add-debt" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-plus-circle me-2"></i>Add New Debt
                    </button>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <label class="form-label-custom text-sky">Extra Monthly Snowball Surge ($)</label>
                            <div class="input-group input-group-lg bg-white rounded-4 border">
                                <span class="input-group-text border-0 bg-white opacity-40">+$</span>
                                <input type="number" id="v-extra" class="form-control border-0 bg-white fw-bold text-sky" value="250">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-p="starter">Starter CC Kit</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-p="heavy">Heavy Burden</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 195; --tool-color: #0EA5E9; --tool-bg: rgba(14, 165, 233, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">ESTIMATED DEBT FREE DATE</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-date">0 Months</div>
                <div class="badge bg-sky-soft text-sky px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">ACCELERATED PATH</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Payoff Table --}}
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">SNOWBALL ANATOMY</th>
                                        <th class="text-muted small fw-bold py-3 text-end">METRICS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Total Interest Loss</td>
                                        <td class="py-3 text-end text-danger fw-bold" id="tbl-total-int">$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Total Principal Burden</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-total-prin">$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">First Debt "Win" In</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-win">0 Months</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Summary Gauge --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Psychological Momentum</h6>
                            <div class="p-3 rounded-4 bg-sky-50 border border-sky-100 mb-4">
                                <div class="small fw-bold text-sky-900 lh-base" id="out-advice">Loading plan data...</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-sky rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-export me-2"></i>Copy Payoff Roadmap
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Planner
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
    const list = $('snow-debt-list');

    function createRow(name = 'Debt', bal = 1500, min = 50, apr = 22){
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
                    <label class="form-label-custom mb-1">APR (%)</label>
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

    function calculate(){
        const items = document.querySelectorAll('.debt-item');
        let extra = parseFloat($('v-extra').value) || 0;
        
        let debts = Array.from(items).map(item => ({
            bal: parseFloat(item.querySelector('.d-bal').value) || 0,
            min: parseFloat(item.querySelector('.d-min').value) || 0,
            apr: parseFloat(item.querySelector('.d-apr').value) || 0
        })).sort((a,b) => a.bal - b.bal);

        let totalPrin = debts.reduce((a,b) => a + b.bal, 0);
        let totalInt = 0;
        let months = 0;
        let firstWin = 0;

        let sim = debts.map(d => ({...d, r: d.apr/100/12}));
        let sanity = 0;

        while(sim.some(d => d.bal > 0) && sanity < 1200){
            sanity++;
            months++;
            let currentSnowball = extra;
            
            // Add minimums of finished debts
            sim.forEach(d => { if(d.bal <= 0) currentSnowball += d.min; });

            let targetFound = false;
            sim.forEach((d, idx) => {
                if(d.bal <= 0) return;
                
                let iChg = d.bal * d.r;
                totalInt += iChg;
                d.bal += iChg;

                let pay = d.min;
                if(!targetFound){
                    targetFound = true;
                    pay += currentSnowball;
                }

                if(pay > d.bal) {
                    if(!targetFound) currentSnowball = pay - d.bal; // spill
                    pay = d.bal;
                }
                d.bal -= pay;
                if(idx === 0 && d.bal <= 0 && firstWin === 0) firstWin = months;
            });
        }

        // Update UI
        $('out-date').textContent = months >= 1200 ? 'Interest Loop' : (months >= 12 ? (months/12).toFixed(1) + ' Years' : months + ' Months');
        $('out-date').style.color = months >= 1200 ? '#ef4444' : '#0EA5E9';
        $('tbl-total-int').textContent = '$' + Math.round(totalInt).toLocaleString();
        $('tbl-total-prin').textContent = '$' + Math.round(totalPrin).toLocaleString();
        $('tbl-win').textContent = firstWin + ' Months';

        let advice = '';
        if(months >= 1200) advice = "CRITICAL: Interest accrual exceeds your total payments. Increase your monthly snowball surge immediately to break the cycle.";
        else if(months <= 24) advice = "EXCELLENT: You have a high-velocity plan. You will clear your first debt in " + firstWin + " months, creating powerful psychological momentum.";
        else advice = "STEADY: Your plan is sound. Focus on staying consistent until the first debt is eliminated to trigger the snowball effect.";
        $('out-advice').textContent = advice;
    }

    $('v-extra').addEventListener('input', calculate);
    $('add-debt').addEventListener('click', () => createRow('New Debt', 1000, 40, 18));
    
    $('reset-calc').addEventListener('click', () => {
        list.innerHTML = '';
        createRow('Credit Card 1', 1500, 50, 24);
        createRow('Store Card', 3500, 100, 21);
        createRow('Personal Loan', 8000, 200, 12);
        $('v-extra').value = 250;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Debt Snowball Payoff Plan\nTotal Debt: ${$('tbl-total-prin').textContent}\nDebt Free Date: ${$('out-date').textContent}\nFirst Win: ${$('tbl-win').textContent}\nGenerated by ToolsHub Snowball Pro`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Roadmap Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    // Init
    createRow('Credit Card 1', 1500, 50, 24);
    createRow('Store Card', 3500, 100, 21);
    createRow('Personal Loan', 8000, 200, 12);
});
</script>

<style>
.snowball-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#0c4a6e;opacity:.7;margin-bottom:4px;display:block}
.snowball-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-sky { background: #0EA5E9; color: #fff; transition: all .3s; }
.btn-sky:hover { background: #0284C7; color: #fff; transform: translateY(-2px); }
.btn-red-soft { background: #FEF2F2; color: #ef4444; border: 1px solid #fee2e2; }
.text-sky { color: #0EA5E9; }
.text-sky-900 { color: #0c4a6e; }
.bg-sky-soft { background: #F0F9FF; }
.bg-sky-50 { background-color: #f8fafc; }
.bg-sky { background-color: #0EA5E9 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

