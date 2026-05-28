<div class="row g-4 implied-vol-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Underlying Stock Price</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="stock" class="form-control form-control-lg rounded-3 border-start-0" value="150" step="0.01">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Strike Price</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="strike" class="form-control form-control-lg rounded-3 border-start-0" value="155" step="0.01">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Market Option Price</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="market-price" class="form-control form-control-lg rounded-3 border-start-0" value="3.50" step="0.01">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Days to Expiration</label>
                        <input type="number" id="days" class="form-control form-control-lg rounded-3" value="30" step="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Risk-Free Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rf" class="form-control form-control-lg rounded-3" value="4.0" step="0.1">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Option Type</label>
                        <select id="type" class="form-select form-select-lg rounded-3">
                            <option value="call" selected>Call Option</option>
                            <option value="put">Put Option</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-violet btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate" style="background:#8b5cf6;border-color:#8b5cf6"><i class="fas fa-calculator me-2"></i>Calculate IV</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:262;--tool-color:#8b5cf6;--tool-bg:rgba(139,92,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Calculated Implied Volatility</span>
                <div class="output-hero-value" id="out-iv">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">Market's expected annualized standard deviation.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Intrinsic Value</span><span class="stat-card-value text-violet" id="out-intrinsic">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Time Value</span><span class="stat-card-value" id="out-time">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Moneyness</span><span class="stat-card-value" id="out-money">—</span></div></div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-microscope me-2 text-violet"></i>IV Sensitivity (Price Changes)</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="sens-table">
                        <thead class="table-light"><tr><th>Option Price</th><th>Estimated IV</th><th>Delta vs Current</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Volatility Data</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const stockEl=$('stock'), strikeEl=$('strike'), mpEl=$('market-price'), daysEl=$('days'), rfEl=$('rf'), typeEl=$('type');

    // Normal distribution CDF
    function normCDF(x) {
        let t = 1 / (1 + 0.2316419 * Math.abs(x));
        let d = 0.3989423 * Math.exp(-x * x / 2);
        let p = d * t * (0.3193815 + t * (-0.3565638 + t * (1.781478 + t * (-1.821256 + t * 1.330274))));
        return x > 0 ? 1 - p : p;
    }

    // Black-Scholes Formula
    function bsPrice(S, K, T, r, v, type) {
        if(T <= 0) return type === 'call' ? Math.max(0, S - K) : Math.max(0, K - S);
        let d1 = (Math.log(S / K) + (r + v * v / 2) * T) / (v * Math.sqrt(T));
        let d2 = d1 - v * Math.sqrt(T);
        if(type === 'call') {
            return S * normCDF(d1) - K * Math.exp(-r * T) * normCDF(d2);
        } else {
            return K * Math.exp(-r * T) * normCDF(-d2) - S * normCDF(-d1);
        }
    }

    // Bisection Method to find IV
    function findIV(S, K, T, r, targetPrice, type) {
        let low = 0.0001; // 0.01%
        let high = 5.0;   // 500%
        let mid = 0.5;
        
        // Quick intrinsic value check
        let intrinsic = type === 'call' ? Math.max(0, S - K) : Math.max(0, K - S);
        if(targetPrice <= intrinsic) return 0; // IV approaches 0 if price is at or below intrinsic

        for(let i=0; i<100; i++){
            mid = (low + high) / 2;
            let price = bsPrice(S, K, T, r, mid, type);
            if(Math.abs(price - targetPrice) < 0.001) break;
            if(price > targetPrice) high = mid;
            else low = mid;
        }
        return mid;
    }

    function calculate(){
        const S = parseFloat(stockEl.value);
        const K = parseFloat(strikeEl.value);
        const P = parseFloat(mpEl.value);
        const T = parseFloat(daysEl.value) / 365.0;
        const r = parseFloat(rfEl.value) / 100.0;
        const type = typeEl.value;

        if(isNaN(S) || isNaN(K) || isNaN(P) || isNaN(T) || T <= 0) return;

        const intrinsic = type === 'call' ? Math.max(0, S - K) : Math.max(0, K - S);
        const timeVal = Math.max(0, P - intrinsic);
        const iv = findIV(S, K, T, r, P, type);

        let money = 'ATM';
        if(type === 'call') money = S > K ? 'ITM' : (S < K ? 'OTM' : 'ATM');
        else money = S < K ? 'ITM' : (S > K ? 'OTM' : 'ATM');

        if(iv === 0 || iv >= 4.99){
            $('out-iv').textContent = 'Calculation Error / Invalid Price';
        } else {
            $('out-iv').textContent = (iv * 100).toFixed(2) + '%';
        }

        $('out-intrinsic').textContent = '$' + intrinsic.toFixed(2);
        $('out-time').textContent = '$' + timeVal.toFixed(2);
        $('out-money').textContent = money;

        // Table
        const multipliers = [0.8, 0.9, 1.1, 1.2];
        let tableHtml = '';
        multipliers.forEach(m => {
            const scPrice = P * m;
            const scIv = findIV(S, K, T, r, scPrice, type);
            const diff = scIv - iv;
            let scDisplay = (scIv * 100).toFixed(2) + '%';
            if(scIv === 0 || scIv >= 4.99) scDisplay = 'N/A';

            tableHtml += `<tr>
                <td>$${scPrice.toFixed(2)}</td>
                <td class="fw-bold">${scDisplay}</td>
                <td class="${diff > 0 ? 'text-success' : 'text-danger'}">${scIv > 0 && iv > 0 ? (diff > 0 ? '+' : '') + (diff * 100).toFixed(2) + '%' : '-'}</td>
            </tr>`;
        });
        $('sens-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        stockEl.value=150; strikeEl.value=155; mpEl.value=3.50; daysEl.value=30; rfEl.value=4.0; typeEl.value='call';
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Implied Volatility Analysis\nIV: ${$('out-iv').textContent}\nStock: $${stockEl.value} | Strike: $${strikeEl.value}\nOption Price: $${mpEl.value} (${typeEl.options[typeEl.selectedIndex].text})\n— ToolsHub Options`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.implied-vol-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.implied-vol-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.implied-vol-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.implied-vol-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.implied-vol-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.implied-vol-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.implied-vol-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.implied-vol-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.implied-vol-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.implied-vol-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}
.implied-vol-rebuilt .text-violet{color:#8b5cf6}

@media (max-width: 768px) {
    .implied-vol-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .implied-vol-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\implied-volatility-calculator.blade.php ENDPATH**/ ?>