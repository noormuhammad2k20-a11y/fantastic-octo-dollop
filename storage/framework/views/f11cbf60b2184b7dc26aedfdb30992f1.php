<div class="row g-4 pb-ratio-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Market Price per Share</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="price" class="form-control form-control-lg rounded-3 border-start-0" value="150" step="0.01">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Book Value per Share</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="bvps" class="form-control form-control-lg rounded-3 border-start-0" value="45" step="0.01">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="p-3 bg-light rounded-3 border-start border-4 border-info">
                            <small class="fw-bold text-muted d-block mb-1">Don't have BVPS? Calculate it here:</small>
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <input type="number" id="assets" class="form-control form-control-sm" placeholder="Total Assets">
                                </div>
                                <div class="col-md-4">
                                    <input type="number" id="liabilities" class="form-control form-control-sm" placeholder="Total Liab.">
                                </div>
                                <div class="col-md-4">
                                    <input type="number" id="shares" class="form-control form-control-sm" placeholder="Shares Out.">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-teal btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate" style="background:#14b8a6;border-color:#14b8a6"><i class="fas fa-calculator me-2"></i>Calculate P/B Ratio</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:171;--tool-color:#14b8a6;--tool-bg:rgba(20,184,166,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Price to Book (P/B) Ratio</span>
                <div class="output-hero-value" id="out-pb">—</div>
                <div class="mt-2" id="out-badge">—</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Market Premium</span><span class="stat-card-value" id="out-premium">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Equity Multiple</span><span class="stat-card-value text-teal" id="out-multiple">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Book % of Price</span><span class="stat-card-value" id="out-book-pct">—</span></div></div>
            </div>

            <div class="mt-4 p-3 bg-white rounded-3 border overflow-x-auto">
                <h6 class="fw-bold mb-3 text-teal"><i class="fas fa-info-circle me-2"></i>Valuation Interpretation</h6>
                <div class="p-3 bg-light rounded-3 small" id="valuation-text">
                    Enter values to see interpretation...
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Valuation</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const priceEl=$('price'), bvpsEl=$('bvps');
    const assetsEl=$('assets'), liabEl=$('liabilities'), sharesEl=$('shares');

    function calculate(){
        // Auto-update BVPS if helper fields used
        const a = parseFloat(assetsEl.value);
        const l = parseFloat(liabEl.value);
        const s = parseFloat(sharesEl.value);
        if(!isNaN(a) && !isNaN(l) && !isNaN(s) && s > 0){
            bvpsEl.value = ((a - l) / s).toFixed(2);
        }

        const p = parseFloat(priceEl.value);
        const b = parseFloat(bvpsEl.value);

        if(isNaN(p) || isNaN(b) || b <= 0) return;

        const pb = p / b;
        const premium = ((pb - 1) * 100).toFixed(1);
        const bookPct = (1/pb * 100).toFixed(1);

        $('out-pb').textContent = pb.toFixed(2);
        $('out-premium').textContent = (pb > 1 ? '+' : '') + premium + '%';
        $('out-multiple').textContent = pb.toFixed(2) + 'x';
        $('out-book-pct').textContent = bookPct + '%';

        let badgeClass = 'bg-secondary';
        let badgeText = 'Neutral';
        let valText = '';

        if(pb < 1){
            badgeClass = 'bg-success';
            badgeText = 'Potential Value';
            valText = 'The stock is trading below its book value. This could indicate the stock is undervalued or the market expects poor future performance.';
        } else if(pb < 3){
            badgeClass = 'bg-info';
            badgeText = 'Fair Value';
            valText = 'Typical for stable, healthy companies. The premium over book value represents expected future growth.';
        } else {
            badgeClass = 'bg-danger';
            badgeText = 'Premium Value';
            valText = 'High P/B ratios suggest investors expect high returns on assets or significant intangible growth potential.';
        }

        $('out-badge').innerHTML = `<span class="badge ${badgeClass} fs-6 px-3 rounded-pill">${badgeText}</span>`;
        $('valuation-text').textContent = valText;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        priceEl.value=150; bvpsEl.value=45; assetsEl.value=''; liabEl.value=''; sharesEl.value='';
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `P/B Ratio Valuation\nRatio: ${$('out-pb').textContent}\nPremium: ${$('out-premium').textContent}\nPrice: $${priceEl.value}\nBVPS: $${bvpsEl.value}\n— ToolsHub Investing`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.pb-ratio-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.pb-ratio-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.pb-ratio-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.pb-ratio-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.pb-ratio-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.pb-ratio-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.pb-ratio-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.pb-ratio-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.pb-ratio-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.pb-ratio-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}
.pb-ratio-rebuilt .text-teal{color:#14b8a6}

@media (max-width: 768px) {
    .pb-ratio-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .pb-ratio-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\price-to-book-ratio-calculator.blade.php ENDPATH**/ ?>