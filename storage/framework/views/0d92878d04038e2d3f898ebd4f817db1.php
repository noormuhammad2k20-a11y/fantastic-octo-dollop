<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Table Dimensions (Rows x Cols)</label>
                    <div class="d-flex gap-2">
                        <input type="number" id="rows-count" class="form-control" value="2" min="2" max="10">
                        <span class="align-self-center">x</span>
                        <input type="number" id="cols-count" class="form-control" value="2" min="2" max="10">
                        <button class="btn btn-outline-primary px-4" id="btn-resize" style="min-width: 280px; max-width: 100%;">Resize Table</button>
                    </div>
                </div>
                <div class="table-responsive rounded-3 border mb-4">
                    <table class="table table-bordered mb-0 text-center" id="contingency-table">
                        <thead class="bg-light small fw-bold">
                            <tr>
                                <th style="width:120px;">Category</th>
                                <!-- Cols will be injected -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Rows will be injected -->
                        </tbody>
                    </table>
                </div>
                <div class="row g-3">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#ef4444;box-shadow:0 4px 12px rgba(239,68,68,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Chi-Square
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Chi-Square Statistic (χ²)</span>
                <div class="output-hero-value" id="res-chi">0.00</div>
                <span class="output-hero-unit" id="res-sig">Significant Result</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">P-Value</span>
                        <span class="value" id="res-p">0.0000</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Degrees of Freedom</span>
                        <span class="value" id="res-df">1</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Cramer's V</span>
                        <span class="value" id="res-v">0.00</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-info-circle me-2 text-danger"></i>Expected Values Table</h6>
                <div class="table-responsive rounded-3 border" id="expected-table-container"></div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Results
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jstat/1.9.6/jstat.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const table = $('contingency-table');
    
    function buildTable(rows, cols) {
        const thead = table.querySelector('thead tr');
        const tbody = table.querySelector('tbody');
        thead.innerHTML = '<th style="width:120px;">Category</th>';
        for(let j=1; j<=cols; j++) thead.innerHTML += `<th>Col ${j}</th>`;
        
        tbody.innerHTML = '';
        for(let i=1; i<=rows; i++) {
            let rowHtml = `<td class="bg-light fw-bold">Row ${i}</td>`;
            for(let j=1; j<=cols; j++) {
                rowHtml += `<td><input type="number" class="form-control text-center cell-input" value="10"></td>`;
            }
            const tr = document.createElement('tr');
            tr.innerHTML = rowHtml;
            tbody.appendChild(tr);
        }
    }

    $('btn-resize').addEventListener('click', () => {
        buildTable(parseInt($('rows-count').value), parseInt($('cols-count').value));
    });

    function calculate() {
        const rowCount = table.querySelectorAll('tbody tr').length;
        const colCount = table.querySelectorAll('thead th').length - 1;
        const data = [];
        table.querySelectorAll('tbody tr').forEach(tr => {
            const row = Array.from(tr.querySelectorAll('input')).map(input => parseFloat(input.value) || 0);
            data.push(row);
        });

        const rowTotals = data.map(row => row.reduce((a, b) => a + b, 0));
        const colTotals = Array(colCount).fill(0).map((_, j) => data.reduce((acc, row) => acc + row[j], 0));
        const grandTotal = rowTotals.reduce((a, b) => a + b, 0);

        if (grandTotal === 0) return;

        let chiSq = 0;
        const expected = [];
        for(let i=0; i<rowCount; i++) {
            expected[i] = [];
            for(let j=0; j<colCount; j++) {
                const exp = (rowTotals[i] * colTotals[j]) / grandTotal;
                expected[i][j] = exp;
                if (exp > 0) chiSq += Math.pow(data[i][j] - exp, 2) / exp;
            }
        }

        const df = (rowCount - 1) * (colCount - 1);
        const pValue = 1 - jStat.chisquare.cdf(chiSq, df);
        const v = Math.sqrt(chiSq / (grandTotal * Math.min(rowCount - 1, colCount - 1)));

        $('res-chi').textContent = chiSq.toFixed(4);
        $('res-p').textContent = pValue.toFixed(6);
        $('res-df').textContent = df;
        $('res-v').textContent = v.toFixed(4);
        $('res-sig').textContent = pValue < 0.05 ? "Significant" : "Not Significant";

        // Build Expected Table
        let expHtml = '<table class="table table-sm text-center mb-0"><thead class="bg-light small"><tr><th>-</th>';
        for(let j=1; j<=colCount; j++) expHtml += `<th>Col ${j}</th>`;
        expHtml += '</tr></thead><tbody>';
        for(let i=0; i<rowCount; i++) {
            expHtml += `<tr><td class="fw-bold">Row ${i+1}</td>`;
            for(let j=0; j<colCount; j++) expHtml += `<td>${expected[i][j].toFixed(2)}</td>`;
            expHtml += '</tr>';
        }
        expHtml += '</tbody></table>';
        $('expected-table-container').innerHTML = expHtml;

        $('results-card').style.display = 'block';
        $('results-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    $('btn-calculate').addEventListener('click', calculate);
    buildTable(2, 2);
});
</script>

<style>
.stats-suite-rebuilt .calculator-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
.stats-suite-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.2rem; margin-bottom: 2.5rem; }
.stats-suite-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #0f172a; }
.stats-suite-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; }
.stats-suite-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.stats-suite-rebuilt .form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; margin-bottom: 0.6rem; display: block; }
.btn-primary-stats { color: #fff; border: none; border-radius: 12px; transition: all 0.3s; }
.btn-dark-stats { background: #0f172a; color: #fff; border: none; border-radius: 12px; }
.output-card-themed { background: #fff; border: 2px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; margin-top: 1rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px solid rgba(0,0,0,0.05); }
.output-hero-label { font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; }
.output-hero-value { font-size: 4rem; font-weight: 900; color: #0f172a; margin: 0.5rem 0; }
.cell-input { border: none; border-bottom: 2px solid #f1f5f9; border-radius: 0; padding: 0.5rem; font-weight: 600; }
.cell-input:focus { box-shadow: none; border-color: #ef4444; }
.stat-pill { background: #f8fafc; padding: 1.2rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: center; }
.stat-pill .label { font-size: 0.7rem; font-weight: 700; color: #64748b; text-transform: uppercase; }
.stat-pill .value { font-size: 1.4rem; font-weight: 800; color: #0f172a; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\chi-square-calculator.blade.php ENDPATH**/ ?>