<div class="row g-4 bey-calc-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Face Value (Par)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="face-val" class="form-control form-control-lg rounded-3 border-start-0" value="1000" step="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Purchase Price</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="price" class="form-control form-control-lg rounded-3 border-start-0" value="980" step="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Days to Maturity</label>
                        <input type="number" id="days" class="form-control form-control-lg rounded-3" value="90" step="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Year Basis</label>
                        <select id="basis" class="form-select form-select-lg rounded-3">
                            <option value="365">365 Days (Standard)</option>
                            <option value="366">366 Days (Leap Year)</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-primary btn-lg px-4 rounded-pill shadow-sm" id="btn-calculate"><i class="fas fa-calculator me-2"></i>Calculate BEY</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:217;--tool-color:#3b82f6;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Bond Equivalent Yield</span>
                <div class="output-hero-value" id="out-bey">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">Annualized yield on a 365-day basis.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Bank Discount Yield</span><span class="stat-card-value" id="out-discount">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Dollar Discount</span><span class="stat-card-value text-primary" id="out-dollar">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Effective Annual Yield</span><span class="stat-card-value" id="out-eay">—</span></div></div>
            </div>

            <div class="mt-4 p-3 bg-white rounded-3 border overflow-x-auto">
                <h6 class="fw-bold mb-3"><i class="fas fa-table me-2 text-primary"></i>Yield Conversion Matrix</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="yield-table">
                        <thead class="table-light"><tr><th>Days Left</th><th>BEY</th><th>Bank Discount</th><th>EAY</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Yield Analysis</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const faceEl=$('face-val'), priceEl=$('price'), daysEl=$('days'), basisEl=$('basis');

    function calculate(){
        const f = parseFloat(faceEl.value);
        const p = parseFloat(priceEl.value);
        const d = parseFloat(daysEl.value);
        const b = parseInt(basisEl.value);

        if(isNaN(f) || isNaN(p) || isNaN(d) || d <= 0 || p <= 0) return;

        const dollarDiscount = f - p;
        // BEY = [(F-P)/P] * (Basis/Days)
        const bey = (dollarDiscount / p) * (b / d);
        // Bank Discount Yield = [(F-P)/F] * (360/Days)
        const discountYield = (dollarDiscount / f) * (360 / d);
        // EAY = (1 + bey * d/b)^(b/d) - 1
        const eay = Math.pow(1 + (dollarDiscount / p), b / d) - 1;

        $('out-bey').textContent = (bey * 100).toFixed(4) + '%';
        $('out-discount').textContent = (discountYield * 100).toFixed(4) + '%';
        $('out-dollar').textContent = '$' + dollarDiscount.toFixed(2);
        $('out-eay').textContent = (eay * 100).toFixed(4) + '%';

        // Matrix
        const daySteps = [30, 60, 90, 180, 270, 360];
        let tableHtml = '';
        daySteps.forEach(ds => {
            const dsBey = (dollarDiscount / p) * (b / ds);
            const dsDisc = (dollarDiscount / f) * (360 / ds);
            const dsEay = Math.pow(1 + (dollarDiscount / p), b / ds) - 1;
            tableHtml += `<tr>
                <td>${ds}</td>
                <td class="fw-bold">${(dsBey * 100).toFixed(3)}%</td>
                <td>${(dsDisc * 100).toFixed(3)}%</td>
                <td>${(dsEay * 100).toFixed(3)}%</td>
            </tr>`;
        });
        $('yield-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        faceEl.value=1000; priceEl.value=980; daysEl.value=90; basisEl.value=365;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Bond Equivalent Yield Report\nBEY: ${$('out-bey').textContent}\nBank Discount: ${$('out-discount').textContent}\nEAY: ${$('out-eay').textContent}\nDays: ${daysEl.value}\n— ToolsHub Fixed Income`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.bey-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.bey-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.bey-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.bey-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.bey-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.bey-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.bey-calc-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.bey-calc-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.bey-calc-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.bey-calc-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}

@media (max-width: 768px) {
    .bey-calc-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .bey-calc-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
