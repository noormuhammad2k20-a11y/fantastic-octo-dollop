<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Confidence Level (%)</label>
                        <select id="input-confidence" class="form-select form-select-lg">
                            <option value="95">95% (Z = 1.96)</option>
                            <option value="99">99% (Z = 2.58)</option>
                            <option value="90">90% (Z = 1.645)</option>
                            <option value="99.9">99.9% (Z = 3.29)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Margin of Error (%)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">±</span>
                            <input type="number" id="input-error" class="form-control form-control-lg" value="5" step="0.1">
                            <span class="input-group-text bg-light">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Population Size (Optional)</label>
                        <input type="number" id="input-pop" class="form-control form-control-lg" placeholder="Leave blank if infinite" value="">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Response Proportion (%)</label>
                        <input type="number" id="input-p" class="form-control form-control-lg" value="50" step="1">
                        <small class="text-muted">Use 50% for maximum safety if unknown.</small>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12 d-flex gap-2">
                        <button class="btn btn-primary-stats flex-grow-1 py-3 fw-bold" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#059669;box-shadow:0 4px 12px rgba(5,150,105,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Sample Size
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:150;--tool-color:#059669;--tool-bg:rgba(5,150,105,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Recommended Sample Size</span>
                <div class="output-hero-value" id="res-n">0</div>
                <span class="output-hero-unit">Participants Needed</span>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-success"></i>Required Sample Sizes for Comparisons</h6>
                <div class="table-responsive rounded-3 border">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Confidence</th>
                                <th>±3% Error</th>
                                <th>±5% Error</th>
                                <th class="text-end pe-4">±10% Error</th>
                            </tr>
                        </thead>
                        <tbody id="comparison-table"></tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Recommendations
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const btnCalc = $('btn-calculate');
    const resultsCard = $('results-card');

    const zMap = { "90": 1.645, "95": 1.96, "99": 2.576, "99.9": 3.291 };

    function calcN(z, e, p, pop) {
        let n = (z*z * p * (1-p)) / (e*e);
        if (pop && pop > 0) {
            n = n / (1 + (n - 1) / pop);
        }
        return Math.ceil(n);
    }

    function calculate() {
        const conf = $('input-confidence').value;
        const z = zMap[conf];
        const error = parseFloat($('input-error').value) / 100;
        const p = parseFloat($('input-p').value) / 100;
        const pop = parseFloat($('input-pop').value);

        if (isNaN(error) || error <= 0) return;

        const n = calcN(z, error, p, pop);
        $('res-n').textContent = n.toLocaleString();

        // Comparison Table
        const tbody = $('comparison-table');
        tbody.innerHTML = '';
        Object.keys(zMap).forEach(lvl => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="ps-4 fw-bold">${lvl}%</td>
                <td>${calcN(zMap[lvl], 0.03, p, pop)}</td>
                <td>${calcN(zMap[lvl], 0.05, p, pop)}</td>
                <td class="text-end pe-4">${calcN(zMap[lvl], 0.10, p, pop)}</td>
            `;
            tbody.appendChild(tr);
        });

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
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
.table thead th { font-size: 0.75rem; text-transform: uppercase; color: #64748b; padding: 1rem; }
</style>

