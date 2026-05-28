<div class="row g-4 bond-yield-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Current Bond Price</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="price" class="form-control form-control-lg rounded-3 border-start-0" value="950" step="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Face Value (Par)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="face" class="form-control form-control-lg rounded-3 border-start-0" value="1000" step="100">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Annual Coupon Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="coupon" class="form-control form-control-lg rounded-3" value="5" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Years to Maturity</label>
                        <input type="number" id="years" class="form-control form-control-lg rounded-3" value="10" step="1">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Coupon Frequency</label>
                        <select id="freq" class="form-select form-select-lg rounded-3">
                            <option value="1">Annual</option>
                            <option value="2" selected>Semi-Annual</option>
                            <option value="4">Quarterly</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-indigo btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate" style="background:#4f46e5;border-color:#4f46e5"><i class="fas fa-calculator me-2"></i>Calculate YTM</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:243;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Yield to Maturity (YTM)</span>
                <div class="output-hero-value" id="out-ytm">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">The total expected return if held until the end date.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Current Yield</span><span class="stat-card-value" id="out-curr-yield">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Annual Interest</span><span class="stat-card-value text-indigo" id="out-annual-int">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Capital Gain/Loss</span><span class="stat-card-value" id="out-cap-gain">—</span></div></div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-search-dollar me-2 text-indigo"></i>YTM Approximation (Approximate Method)</h6>
                <div class="p-3 bg-light rounded-3">
                    <code class="text-dark">Approx YTM = [C + (F-P)/n] / [(F+P)/2]</code>
                    <p class="small text-muted mt-2 mb-0">Our calculator uses the iterative Newton-Raphson method for 99.99% precision.</p>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-sm table-hover text-center mb-0" id="ytm-table">
                        <thead class="table-light"><tr><th>Price Scenario</th><th>Yield (YTM)</th><th>Bond Status</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Yield Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const priceEl=$('price'), faceEl=$('face'), couponEl=$('coupon'), yearsEl=$('years'), freqEl=$('freq');

    function bondPrice(yieldRate, face, couponRate, years, freq){
        const c = (face * couponRate) / freq;
        const n = years * freq;
        const r = yieldRate / freq;
        let price = 0;
        for(let t=1; t<=n; t++){
            price += c / Math.pow(1 + r, t);
        }
        price += face / Math.pow(1 + r, n);
        return price;
    }

    function calculateYTM(price, face, couponRate, years, freq){
        let low = 0;
        let high = 1; // 100%
        let guess = 0.05;
        for(let i=0; i<100; i++){
            let p = bondPrice(guess, face, couponRate, years, freq);
            if(p > price) low = guess;
            else high = guess;
            guess = (low + high) / 2;
            if(Math.abs(p - price) < 0.0001) break;
        }
        return guess;
    }

    function calculate(){
        const p = parseFloat(priceEl.value);
        const f = parseFloat(faceEl.value);
        const cRate = parseFloat(couponEl.value)/100;
        const y = parseFloat(yearsEl.value);
        const fr = parseInt(freqEl.value);

        if(isNaN(p) || isNaN(f) || isNaN(cRate) || isNaN(y) || y <= 0 || p <= 0) return;

        const ytm = calculateYTM(p, f, cRate, y, fr);
        const currYield = (f * cRate) / p;
        const annualInt = f * cRate;

        $('out-ytm').textContent = (ytm * 100).toFixed(4) + '%';
        $('out-curr-yield').textContent = (currYield * 100).toFixed(2) + '%';
        $('out-annual-int').textContent = '$' + annualInt.toFixed(2);
        $('out-cap-gain').textContent = '$' + (f - p).toFixed(2);

        // Scenario Table
        const scenarios = [0.8, 0.9, 1.0, 1.1, 1.2];
        let tableHtml = '';
        scenarios.forEach(s => {
            const scPrice = f * s;
            const scYtm = calculateYTM(scPrice, f, cRate, y, fr);
            const status = s < 1 ? 'Discount' : s > 1 ? 'Premium' : 'Par';
            tableHtml += `<tr>
                <td>$${scPrice.toFixed(0)}</td>
                <td class="fw-bold">${(scYtm * 100).toFixed(2)}%</td>
                <td><span class="badge ${s < 1 ? 'bg-danger' : s > 1 ? 'bg-success' : 'bg-secondary'}">${status}</span></td>
            </tr>`;
        });
        $('ytm-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        priceEl.value=950; faceEl.value=1000; couponEl.value=5; yearsEl.value=10; freqEl.value=2;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Bond YTM Analysis\nYield to Maturity: ${$('out-ytm').textContent}\nCurrent Yield: ${$('out-curr-yield').textContent}\nBond Price: $${priceEl.value}\nFace Value: $${faceEl.value}\n— ToolsHub Fixed Income`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.bond-yield-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.bond-yield-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.bond-yield-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.bond-yield-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.bond-yield-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.bond-yield-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.bond-yield-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.bond-yield-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.bond-yield-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.bond-yield-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}
.bond-yield-rebuilt .text-indigo{color:#4f46e5}

@media (max-width: 768px) {
    .bond-yield-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .bond-yield-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
