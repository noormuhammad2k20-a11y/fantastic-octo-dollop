<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Group 1 Data</label>
                        <textarea id="input-g1" class="form-control form-control-lg font-monospace" rows="4" placeholder="e.g. 10, 12, 14, 15, 18">10, 12, 14, 15, 18</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Group 2 Data</label>
                        <textarea id="input-g2" class="form-control form-control-lg font-monospace" rows="4" placeholder="e.g. 20, 22, 24, 25, 28">20, 22, 24, 25, 28</textarea>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#ef4444;box-shadow:0 4px 12px rgba(239,68,68,0.2)">
                            <i class="fas fa-play me-2"></i>Run T-Test
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">T-Statistic</span>
                <div class="output-hero-value" id="res-t">0.00</div>
                <span class="output-hero-unit" id="res-sig">Significant Result</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">P-Value</span>
                        <span class="value" id="res-p">0.0000</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Degrees of Freedom</span>
                        <span class="value" id="res-df">0</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-danger"></i>Group Statistics</h6>
                <div class="table-responsive rounded-3 border">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light small">
                            <tr>
                                <th class="ps-4">Group</th>
                                <th>n</th>
                                <th>Mean</th>
                                <th class="text-end pe-4">Std Dev</th>
                            </tr>
                        </thead>
                        <tbody id="stats-table"></tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Summary
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jstat/1.9.6/jstat.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const btnCalc = $('btn-calculate');
    const resultsCard = $('results-card');

    function calculate() {
        const g1 = $('input-g1').value.split(/[\s,;\n]+/).filter(v => v.trim() !== '' && !isNaN(v)).map(Number);
        const g2 = $('input-g2').value.split(/[\s,;\n]+/).filter(v => v.trim() !== '' && !isNaN(v)).map(Number);

        if (g1.length < 2 || g2.length < 2) {
            alert('Each group needs at least 2 data points.');
            return;
        }

        const m1 = jStat.mean(g1), m2 = jStat.mean(g2);
        const v1 = jStat.variance(g1), v2 = jStat.variance(g2);
        const n1 = g1.length, n2 = g2.length;

        // Pooled Variance
        const df = n1 + n2 - 2;
        const pooledVar = ((n1 - 1) * v1 + (n2 - 1) * v2) / df;
        const se = Math.sqrt(pooledVar * (1/n1 + 1/n2));
        const t = (m1 - m2) / se;
        const p = 2 * (1 - jStat.studentt.cdf(Math.abs(t), df));

        $('res-t').textContent = t.toFixed(4);
        $('res-p').textContent = p.toFixed(6);
        $('res-df').textContent = df;
        $('res-sig').textContent = p < 0.05 ? "Significant Result" : "Not Significant";

        $('stats-table').innerHTML = `
            <tr><td class="ps-4 fw-bold">Group 1</td><td>${n1}</td><td>${m1.toFixed(2)}</td><td class="text-end pe-4">${jStat.stdev(g1).toFixed(2)}</td></tr>
            <tr><td class="ps-4 fw-bold">Group 2</td><td>${n2}</td><td>${m2.toFixed(2)}</td><td class="text-end pe-4">${jStat.stdev(g2).toFixed(2)}</td></tr>
        `;

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
.stat-pill { background: #f8fafc; padding: 1.2rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: center; }
</style>

