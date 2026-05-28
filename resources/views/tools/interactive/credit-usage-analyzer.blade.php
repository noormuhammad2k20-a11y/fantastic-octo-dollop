<div class="row g-4 rewards-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(59, 130, 246, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #3B82F6, #1D4ED8); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e3a8a; letter-spacing: -0.5px;">Net Rewards & Yield Analyzer</h4>
                    <p class="text-muted small mb-0">Calculate if your credit card is actually "free". Model the true net gain of cashback and points vs interest charges, annual fees, and opportunity costs.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Earnings --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Earnings Potential</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Avg Monthly Spend ($)</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                    <input type="number" id="v-spend" class="form-control border-0 bg-white fw-bold" value="2500">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Points Yield (%)</label>
                                    <input type="number" id="v-yield" class="form-control border-0 bg-white rounded-3 fw-bold" value="2.0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Redemption Boost</label>
                                    <select id="v-boost" class="form-select border-0 bg-white rounded-3 fw-bold">
                                        <option value="1.0">1.0x (Cashback)</option>
                                        <option value="1.25">1.25x (Portal)</option>
                                        <option value="1.5">1.5x (Elite Transfer)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Frictions --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-blue">
                            <h6 class="fw-bold small mb-3 uppercase text-blue opacity-70">Financial Frictions</h6>
                            <div class="mb-4">
                                <label class="form-label-custom text-danger">Average Balance Carried ($)</label>
                                <div class="input-group bg-light rounded-3 border">
                                    <span class="input-group-text border-0 bg-light opacity-40">$</span>
                                    <input type="number" id="v-carry" class="form-control border-0 bg-light fw-bold text-danger" value="0">
                                </div>
                                <div class="small text-muted mt-1">Interest kills rewards.</div>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">APR (%)</label>
                                    <input type="number" id="v-apr" class="form-control border-0 bg-light rounded-3 fw-bold" value="24.99">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Annual Fee ($)</label>
                                    <input type="number" id="v-fee" class="form-control border-0 bg-light rounded-3 fw-bold" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="5000" data-y="3" data-f="695">The Plat Life (High Fee)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="1500" data-y="1.5" data-f="0">Basic No-Fee Saver</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="2000" data-y="2" data-c="3000">The Interest Trap</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 215; --tool-color: #3B82F6; --tool-bg: rgba(59, 130, 246, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">NET ANNUAL PROFIT</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-net">$0</div>
                <div class="badge bg-blue-soft text-blue px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">PROFITABLE</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Table --}}
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">P&L BREAKDOWN</th>
                                        <th class="text-muted small fw-bold py-3 text-end">ANNUAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold text-success">Gross Rewards Earned</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-gross">+$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold text-danger">Total Interest Paid</td>
                                        <td class="py-3 text-end" id="tbl-int">-$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold text-danger">Fixed Annual Fees</td>
                                        <td class="py-3 text-end" id="tbl-fee">-$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">True Reward Yield</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-yield">0%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Efficiency Gauge</h6>
                            <div class="mb-4">
                                <div class="progress rounded-pill overflow-hidden shadow-sm" style="height: 12px; background: #f1f5f9;">
                                    <div id="bar-earn" class="progress-bar bg-blue" style="width: 80%"></div>
                                    <div id="bar-loss" class="progress-bar bg-danger opacity-50" style="width: 20%"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-1 px-1 small fw-bold">
                                    <span class="text-blue">Earnings</span>
                                    <span class="text-danger">Losses</span>
                                </div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-blue rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-export me-2"></i>Copy Rewards Report
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
    const inputs = ['v-spend', 'v-yield', 'v-boost', 'v-carry', 'v-apr', 'v-fee'];

    function calculate(){
        let spend = parseFloat($('v-spend').value) || 0;
        let pointsYield = parseFloat($('v-yield').value) || 0;
        let boost = parseFloat($('v-boost').value) || 1;
        let carry = parseFloat($('v-carry').value) || 0;
        let apr = (parseFloat($('v-apr').value) || 0) / 100;
        let fee = parseFloat($('v-fee').value) || 0;

        let annualSpend = spend * 12;
        let grossEarned = annualSpend * (pointsYield / 100) * boost;
        let totalInterest = carry * apr;
        let netProfit = grossEarned - totalInterest - fee;
        let trueYield = annualSpend > 0 ? (netProfit / annualSpend) * 100 : 0;

        // Update UI
        $('out-net').textContent = (netProfit >= 0 ? '$' : '-$') + Math.abs(Math.round(netProfit)).toLocaleString();
        $('tbl-gross').textContent = '+$' + Math.round(grossEarned).toLocaleString();
        $('tbl-int').textContent = '-$' + Math.round(totalInterest).toLocaleString();
        $('tbl-fee').textContent = '-$' + Math.round(fee).toLocaleString();
        $('tbl-yield').textContent = trueYield.toFixed(2) + '%';
        $('tbl-yield').style.color = trueYield < 0 ? '#ef4444' : '#10b981';

        let status = 'PROFITABLE'; let col = '#10b981';
        if(netProfit < 0) { status = 'NEGATIVE YIELD'; col = '#ef4444'; }
        else if(totalInterest > 0) { status = 'INTEREST DRAIN'; col = '#f59e0b'; }

        $('out-status').textContent = status;
        $('out-status').style.color = col;
        $('out-net').style.color = col;

        let earnWeight = grossEarned;
        let lossWeight = totalInterest + fee;
        let totalWeight = earnWeight + lossWeight;
        if(totalWeight > 0) {
            $('bar-earn').style.width = (earnWeight / totalWeight * 100) + '%';
            $('bar-loss').style.width = (lossWeight / totalWeight * 100) + '%';
        }
    }

    inputs.forEach(id => $(id).addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            $('v-spend').value = btn.dataset.s;
            $('v-yield').value = btn.dataset.y;
            $('v-fee').value = btn.dataset.f;
            $('v-carry').value = btn.dataset.c || 0;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        $('v-spend').value = 2500; $('v-yield').value = 2.0; $('v-boost').value = 1.0;
        $('v-carry').value = 0; $('v-apr').value = 24.99; $('v-fee').value = 0;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Credit Card Net Yield Report\nAnnual Profit: ${$('out-net').textContent}\nTrue Yield: ${$('tbl-yield').textContent}\nStatus: ${$('out-status').textContent}\nGenerated by ToolsHub Rewards Vault`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.rewards-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e3a8a;opacity:.7;margin-bottom:8px;display:block}
.rewards-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-blue { background: #3B82F6; color: #fff; transition: all .3s; }
.btn-blue:hover { background: #1D4ED8; color: #fff; transform: translateY(-2px); }
.text-blue { color: #3B82F6; }
.text-blue-900 { color: #1e3a8a; }
.bg-blue-soft { background: #EFF6FF; }
.bg-blue { background-color: #3B82F6 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

