<div class="row g-4 crypto-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #0f172a; box-shadow: 0 4px 30px rgba(16, 185, 129, .1);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #10B981, #059669); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fab fa-bitcoin"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#f8fafc; letter-spacing: -0.5px;">Crypto Profit & Yield Architect</h4>
                    <p class="text-slate-400 small mb-0">Decode your trading performance. Model profit, ROI, and tax liabilities across multiple network fee profiles and staking scenarios.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-slate-900 border border-slate-800 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-slate-500">Position Entry/Exit</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom text-slate-300">Buy Price ($)</label>
                                    <input type="number" id="v-buy" class="form-control border-0 bg-slate-800 text-white rounded-3 fw-bold" value="60000">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom text-emerald-400">Sell Price ($)</label>
                                    <input type="number" id="v-sell" class="form-control border-0 bg-slate-800 text-white rounded-3 fw-bold" value="72000">
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom text-slate-300">Quantity (Coins)</label>
                                <input type="number" id="v-qty" class="form-control border-0 bg-slate-800 text-white rounded-3 fw-bold" value="0.5" step="0.001">
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border border-emerald-500/20 h-100 shadow-sm bg-slate-900">
                            <h6 class="fw-bold small mb-3 uppercase text-emerald-500 opacity-70">Network & Yield</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom text-slate-300">Network Fees ($)</label>
                                    <input type="number" id="v-fee" class="form-control border-0 bg-slate-800 text-white rounded-3 fw-bold" value="50">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom text-slate-300">Staking APY (%)</label>
                                    <input type="number" id="v-apy" class="form-control border-0 bg-slate-800 text-white rounded-3 fw-bold" value="0">
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom text-slate-300">Hold Duration (Days)</label>
                                <input type="number" id="v-days" class="form-control border-0 bg-slate-800 text-white rounded-3 fw-bold" value="30">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top border-slate-800 d-flex flex-wrap gap-2">
                    <button class="btn btn-slate-800 rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load text-white" data-b="60000" data-s="100000">The Moon Path</button>
                    <button class="btn btn-slate-800 rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load text-white" data-b="2500" data-s="3500">ETH Stake & Hodl</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 150; --tool-color: #10B981; --tool-bg: rgba(16, 185, 129, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">NET TRADING PROFIT</span>
                <div class="output-hero-value display-1 fw-900 my-2 neon-glow" id="out-profit">$0</div>
                <div class="badge bg-emerald-soft text-emerald px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-roi">+0% ROI</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">PERFORMANCE METRICS</th>
                                        <th class="text-muted small fw-bold py-3 text-end">VALUATION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Gross Capital Deployed</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-invested">$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Staking Rewards Accrued</td>
                                        <td class="py-3 text-end text-success fw-bold" id="tbl-staking">+$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Estimated Tax Drag (20%)</td>
                                        <td class="py-3 text-end text-danger" id="tbl-tax">-$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">Post-Tax Net Gain</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-net">$0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Market Intelligence</h6>
                            <div class="p-3 rounded-4 bg-slate-50 border border-slate-100 mb-4">
                                <div class="small fw-bold text-slate-700 lh-base" id="out-advice">Position analysis pending...</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-emerald rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-export me-2"></i>Copy Trade Blueprint
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
    const inputs = ['v-buy', 'v-sell', 'v-qty', 'v-fee', 'v-apy', 'v-days'];

    function calculate(){
        let buy = parseFloat($('v-buy').value) || 0;
        let sell = parseFloat($('v-sell').value) || 0;
        let qty = parseFloat($('v-qty').value) || 0;
        let fee = parseFloat($('v-fee').value) || 0;
        let apy = (parseFloat($('v-apy').value) || 0) / 100;
        let days = parseFloat($('v-days').value) || 1;

        let invested = buy * qty;
        let grossSell = sell * qty;
        let priceProfit = grossSell - invested - fee;
        
        // Staking calc: Daily compounded is complex, using simple linear for tool utility
        let stakingRewards = invested * (apy / 365) * days;
        let netProfit = priceProfit + stakingRewards;
        let roi = invested > 0 ? (netProfit / invested) * 100 : 0;
        let estTax = netProfit > 0 ? netProfit * 0.20 : 0;
        let postTax = netProfit - estTax;

        // Update UI
        $('out-profit').textContent = (netProfit >= 0 ? '$' : '-$') + Math.abs(Math.round(netProfit)).toLocaleString();
        $('out-roi').textContent = (roi >= 0 ? '+' : '') + roi.toFixed(2) + '% ROI';
        $('tbl-invested').textContent = '$' + Math.round(invested).toLocaleString();
        $('tbl-staking').textContent = '+$' + stakingRewards.toFixed(2);
        $('tbl-tax').textContent = '-$' + Math.round(estTax).toLocaleString();
        $('tbl-net').textContent = '$' + Math.round(postTax).toLocaleString();

        let col = netProfit >= 0 ? '#10b981' : '#ef4444';
        $('out-profit').style.color = col;
        $('out-roi').style.backgroundColor = col + '20';
        $('out-roi').style.color = col;

        let advice = '';
        if(netProfit < 0) advice = "ALERT: Your position is currently underwater. Including fees, you are operating at a net loss.";
        else if(roi > 50) advice = "BULLISH: You have achieved high-alpha returns. Consider securing partial profits to cover your initial cost basis.";
        else advice = "STEADY: Your trade is profitable. Ensure you account for 20% estimated tax liability on these gains.";
        $('out-advice').textContent = advice;
    }

    inputs.forEach(id => $(id).addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            $('v-buy').value = btn.dataset.b;
            $('v-sell').value = btn.dataset.s;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        $('v-buy').value = 60000; $('v-sell').value = 72000; $('v-qty').value = 0.5;
        $('v-fee').value = 50; $('v-apy').value = 0; $('v-days').value = 30;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Crypto Trading Blueprint\nNet Profit: ${$('out-profit').textContent}\nROI: ${$('out-roi').textContent}\nPost-Tax Gain: ${$('tbl-net').textContent}\nGenerated by ToolsHub Crypto Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Blueprint Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.crypto-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#94a3b8;opacity:.7;margin-bottom:8px;display:block}
.crypto-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-emerald { background: #10B981; color: #fff; transition: all .3s; }
.btn-emerald:hover { background: #059669; color: #fff; transform: translateY(-2px); }
.text-emerald { color: #10B981; }
.text-slate-400 { color: #94a3b8; }
.text-slate-300 { color: #cbd5e1; }
.bg-slate-900 { background-color: #0f172a; }
.bg-slate-800 { background-color: #1e293b; }
.bg-emerald-soft { background: #ecfdf5; }
.neon-glow { text-shadow: 0 0 15px rgba(16, 185, 129, 0.3); }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\crypto-profit-calculator.blade.php ENDPATH**/ ?>