<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div id="items-container">
                    <div class="row g-3 mb-3 item-row">
                        <div class="col-md-6">
                            <label class="form-label-custom">Value (x)</label>
                            <input type="number" class="form-control val-input" value="90">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Weight (w)</label>
                            <input type="number" class="form-control weight-input" value="1">
                        </div>
                    </div>
                    <div class="row g-3 mb-3 item-row">
                        <div class="col-md-6">
                            <input type="number" class="form-control val-input" value="80">
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control weight-input" value="2">
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2 mb-4">
                    <button class="btn btn-outline-warning flex-grow-1" id="btn-add-item" style="min-width: 280px; max-width: 100%;"><i class="fas fa-plus me-2"></i>Add Row</button>
                    <button class="btn btn-outline-danger" id="btn-remove-item" style="min-width: 280px; max-width: 100%;"><i class="fas fa-trash"></i></button>
                </div>
                <div class="row g-3">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#f59e0b;box-shadow:0 4px 12px rgba(245,158,11,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Weighted Mean
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:40;--tool-color:#f59e0b;--tool-bg:rgba(245,158,11,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Weighted Average</span>
                <div class="output-hero-value" id="res-avg">0.00</div>
                <span class="output-hero-unit">Final Result</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Total Weight (Σw)</span>
                        <span class="value" id="res-total-w">0</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Sum (Σwx)</span>
                        <span class="value" id="res-total-wx">0</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-warning"></i>Calculation Table</h6>
                <div class="table-responsive rounded-3 border">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light small">
                            <tr>
                                <th class="ps-4">Value (x)</th>
                                <th>Weight (w)</th>
                                <th class="text-end pe-4">Contribution (w * x)</th>
                            </tr>
                        </thead>
                        <tbody id="calc-table"></tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Results
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const container = $('items-container');

    $('btn-add-item').addEventListener('click', () => {
        const div = document.createElement('div');
        div.className = 'row g-3 mb-3 item-row';
        div.innerHTML = `
            <div class="col-md-6"><input type="number" class="form-control val-input"></div>
            <div class="col-md-6"><input type="number" class="form-control weight-input" value="1"></div>
        `;
        container.appendChild(div);
    });

    $('btn-remove-item').addEventListener('click', () => { if(container.children.length > 1) container.removeChild(container.lastChild); });

    function calculate() {
        const rows = Array.from(container.querySelectorAll('.item-row'));
        let totalWX = 0;
        let totalW = 0;
        const tbody = $('calc-table');
        tbody.innerHTML = '';

        rows.forEach(row => {
            const x = parseFloat(row.querySelector('.val-input').value) || 0;
            const w = parseFloat(row.querySelector('.weight-input').value) || 0;
            const wx = w * x;
            totalWX += wx;
            totalW += w;

            const tr = document.createElement('tr');
            tr.innerHTML = `<td class="ps-4">${x}</td><td>${w}</td><td class="text-end pe-4">${wx.toFixed(2)}</td>`;
            tbody.appendChild(tr);
        });

        const avg = totalW !== 0 ? totalWX / totalW : 0;

        $('res-avg').textContent = avg.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 4});
        $('res-total-w').textContent = totalW;
        $('res-total-wx').textContent = totalWX.toFixed(2);

        $('results-card').style.display = 'block';
        $('results-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    $('btn-calculate').addEventListener('click', calculate);
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
.stat-pill { background: #f8fafc; padding: 1.2rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: center; }
</style>

