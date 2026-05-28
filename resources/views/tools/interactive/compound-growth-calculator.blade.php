<div class="row g-4 compound-growth-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Initial Value (P)</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" id="principal" class="form-control form-control-lg" value="1000">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Growth Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg" value="7" step="0.1">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Periods (Years)</label>
                        <input type="number" id="periods" class="form-control form-control-lg" value="10">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Compounding Frequency</label>
                        <select id="frequency" class="form-select form-select-lg">
                            <option value="1">Annually (1/year)</option>
                            <option value="4">Quarterly (4/year)</option>
                            <option value="12">Monthly (12/year)</option>
                            <option value="365">Daily (365/year)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:150;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Future Value</span>
                <div class="output-hero-value" id="out-future">$1,967.15</div>
                <div class="mt-2 text-muted fw-bold" id="out-gain">Total Growth: +$967.15</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Total Percentage Gain</span><span class="stat-card-value text-success" id="out-percent">96.72%</span></div></div>
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Effective Annual Rate</span><span class="stat-card-value" id="out-ear">7.00%</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-area me-2 text-success"></i>Yearly Forecast</h6>
            <div class="table-responsive bg-white border rounded-3 p-2">
                <table class="table table-sm table-hover mb-0 small">
                    <thead class="table-light"><tr><th>Year</th><th>Interest</th><th>Total Value</th></tr></thead>
                    <tbody id="out-table"></tbody>
                </table>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Growth Forecast</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const pIn = document.getElementById('principal');
    const rIn = document.getElementById('rate');
    const tIn = document.getElementById('periods');
    const fIn = document.getElementById('frequency');
    const outFuture = document.getElementById('out-future');
    const outGain = document.getElementById('out-gain');
    const outPercent = document.getElementById('out-percent');
    const outEar = document.getElementById('out-ear');
    const outTable = document.getElementById('out-table');

    function calculate(){
        const P = parseFloat(pIn.value);
        const r = parseFloat(rIn.value) / 100;
        const t = parseInt(tIn.value);
        const n = parseInt(fIn.value);

        if(isNaN(P) || isNaN(r) || isNaN(t) || t < 1) return;

        // A = P(1 + r/n)^(nt)
        const futureValue = P * Math.pow(1 + r/n, n * t);
        const gain = futureValue - P;
        const percent = (gain / P) * 100;
        const ear = (Math.pow(1 + r/n, n) - 1) * 100;

        outFuture.textContent = '$' + futureValue.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        outGain.textContent = `Total Growth: +$${gain.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        outPercent.textContent = percent.toFixed(2) + '%';
        outEar.textContent = ear.toFixed(2) + '%';

        let tableHTML = "";
        let currentBalance = P;
        for(let i=1; i<=Math.min(t, 25); i++){
            const nextBalance = P * Math.pow(1 + r/n, n * i);
            const interest = nextBalance - currentBalance;
            tableHTML += `<tr><td>Year ${i}</td><td>$${interest.toLocaleString(undefined, {maximumFractionDigits:2})}</td><td class="fw-bold">$${nextBalance.toLocaleString(undefined, {maximumFractionDigits:2})}</td></tr>`;
            currentBalance = nextBalance;
        }
        outTable.innerHTML = tableHTML;
    }

    [pIn, rIn, tIn, fIn].forEach(el => el.addEventListener('input', calculate));

    document.getElementById('btn-copy').addEventListener('click', function(){
        navigator.clipboard.writeText(`Future Value: ${outFuture.textContent}\nTotal Gain: ${outGain.textContent}`);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.compound-growth-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.compound-growth-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.compound-growth-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.compound-growth-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.compound-growth-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.compound-growth-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.compound-growth-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.compound-growth-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.compound-growth-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.compound-growth-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

.compound-growth-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; text-align: center; }
.compound-growth-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.compound-growth-rebuilt .stat-card-value { font-size: 1.15rem; font-weight: 700; color: #1e293b; }

@media (max-width: 768px) {
    .compound-growth-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

