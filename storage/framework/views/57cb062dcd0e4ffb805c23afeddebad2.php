<div class="row g-4 pe-ratio-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Current Stock Price</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="price" class="form-control form-control-lg rounded-3 border-start-0" value="250" step="0.01">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Earnings per Share (EPS)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="eps" class="form-control form-control-lg rounded-3 border-start-0" value="12.5" step="0.01">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="p-3 bg-light rounded-3 border-start border-4 border-primary">
                            <small class="fw-bold text-muted d-block mb-1">Calculate EPS from Net Income:</small>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input type="number" id="income" class="form-control form-control-sm" placeholder="Net Income">
                                </div>
                                <div class="col-md-6">
                                    <input type="number" id="shares" class="form-control form-control-sm" placeholder="Shares Outstanding">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-primary btn-lg px-4 rounded-pill shadow-sm" id="btn-calculate"><i class="fas fa-calculator me-2"></i>Calculate P/E Ratio</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:217;--tool-color:#3b82f6;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">P/E Ratio (Multiple)</span>
                <div class="output-hero-value" id="out-pe">—</div>
                <div class="mt-2" id="out-badge">—</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Earnings Yield</span><span class="stat-card-value text-primary" id="out-yield">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Time to Recoup</span><span class="stat-card-value" id="out-recoup">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Market Value / $1 Earnings</span><span class="stat-card-value" id="out-val">—</span></div></div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-info-circle me-2 text-primary"></i>Valuation Insight</h6>
                <div class="p-3 bg-light rounded-3 small" id="valuation-text">
                    Enter values to see insight...
                </div>
                <div class="mt-3">
                    <h7 class="fw-bold small text-muted">Sector Averages (Reference):</h7>
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        <span class="badge bg-white border text-dark p-2">Tech: 25-35x</span>
                        <span class="badge bg-white border text-dark p-2">Finance: 10-15x</span>
                        <span class="badge bg-white border text-dark p-2">Utilities: 15-20x</span>
                        <span class="badge bg-white border text-dark p-2">S&P 500: ~20x</span>
                    </div>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Analysis</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const priceEl=$('price'), epsEl=$('eps');
    const incomeEl=$('income'), sharesEl=$('shares');

    function calculate(){
        // Auto-update EPS
        const inc = parseFloat(incomeEl.value);
        const sh = parseFloat(sharesEl.value);
        if(!isNaN(inc) && !isNaN(sh) && sh > 0){
            epsEl.value = (inc / sh).toFixed(2);
        }

        const p = parseFloat(priceEl.value);
        const e = parseFloat(epsEl.value);

        if(isNaN(p) || isNaN(e) || e <= 0) return;

        const pe = p / e;
        const yield = (1 / pe) * 100;

        $('out-pe').textContent = pe.toFixed(2) + 'x';
        $('out-yield').textContent = yield.toFixed(2) + '%';
        $('out-recoup').textContent = pe.toFixed(1) + ' Years';
        $('out-val').textContent = '$' + pe.toFixed(2);

        let badgeClass = 'bg-secondary';
        let badgeText = 'Neutral';
        let valText = '';

        if(pe < 15){
            badgeClass = 'bg-success';
            badgeText = 'Potential Value';
            valText = 'A lower P/E ratio may indicate that the stock is undervalued, or that investors expect lower growth in the future.';
        } else if(pe < 25){
            badgeClass = 'bg-info';
            badgeText = 'Standard Growth';
            valText = 'This range is typical for established companies with steady earnings growth.';
        } else {
            badgeClass = 'bg-danger';
            badgeText = 'High Growth / Premium';
            valText = 'A high P/E indicates investors expect high future earnings growth, or that the stock is currently overvalued.';
        }

        $('out-badge').innerHTML = `<span class="badge ${badgeClass} fs-6 px-3 rounded-pill">${badgeText}</span>`;
        $('valuation-text').textContent = valText;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        priceEl.value=250; epsEl.value=12.5; incomeEl.value=''; sharesEl.value='';
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `P/E Ratio Valuation\nP/E Ratio: ${$('out-pe').textContent}\nEarnings Yield: ${$('out-yield').textContent}\nStock Price: $${priceEl.value}\nEPS: $${epsEl.value}\n— ToolsHub Investing`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.pe-ratio-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.pe-ratio-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.pe-ratio-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.pe-ratio-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.pe-ratio-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.pe-ratio-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.pe-ratio-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.pe-ratio-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.pe-ratio-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.pe-ratio-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}

@media (max-width: 768px) {
    .pe-ratio-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .pe-ratio-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\pe-ratio-calculator.blade.php ENDPATH**/ ?>