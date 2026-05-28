<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div id="groups-container">
                    <div class="group-input-card mb-4 p-4 rounded-4 border bg-light">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label-custom">Group 1 Name</label>
                                <input type="text" class="form-control group-name" value="Group A">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label-custom">Data (Numbers separated by commas/spaces)</label>
                                <textarea class="form-control group-data font-monospace" rows="2">10, 12, 14, 15, 18</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="group-input-card mb-4 p-4 rounded-4 border bg-light">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label-custom">Group 2 Name</label>
                                <input type="text" class="form-control group-name" value="Group B">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label-custom">Data</label>
                                <textarea class="form-control group-data font-monospace" rows="2">20, 22, 24, 25, 28</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="group-input-card mb-4 p-4 rounded-4 border bg-light">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label-custom">Group 3 Name</label>
                                <input type="text" class="form-control group-name" value="Group C">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label-custom">Data</label>
                                <textarea class="form-control group-data font-monospace" rows="2">30, 32, 34, 35, 38</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2 mb-4">
                    <button class="btn btn-outline-secondary flex-grow-1" id="btn-add-group" style="min-width: 280px; max-width: 100%;"><i class="fas fa-plus me-2"></i>Add Group</button>
                    <button class="btn btn-outline-danger" id="btn-remove-group" style="min-width: 280px; max-width: 100%;"><i class="fas fa-trash"></i></button>
                </div>
                <div class="row g-3">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#f97316;box-shadow:0 4px 12px rgba(249,115,22,0.2)">
                            <i class="fas fa-play me-2"></i>Perform ANOVA Test
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:25;--tool-color:#f97316;--tool-bg:rgba(249,115,22,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">F-Statistic (F-Ratio)</span>
                <div class="output-hero-value" id="res-f">0.00</div>
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
                        <span class="label">Alpha (α)</span>
                        <span class="value">0.05</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-table me-2 text-warning"></i>ANOVA Summary Table</h6>
                <div class="table-responsive rounded-3 border">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light text-uppercase small fw-bold">
                            <tr>
                                <th class="ps-4">Source</th>
                                <th>SS</th>
                                <th>df</th>
                                <th>MS</th>
                                <th class="text-end pe-4">F</th>
                            </tr>
                        </thead>
                        <tbody id="anova-table"></tbody>
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
    const container = $('groups-container');
    
    $('btn-add-group').addEventListener('click', () => {
        const count = container.children.length + 1;
        const div = document.createElement('div');
        div.className = 'group-input-card mb-4 p-4 rounded-4 border bg-light';
        div.innerHTML = `
            <div class="row g-3">
                <div class="col-md-4"><label class="form-label-custom">Group ${count} Name</label><input type="text" class="form-control group-name" value="Group ${String.fromCharCode(64+count)}"></div>
                <div class="col-md-8"><label class="form-label-custom">Data</label><textarea class="form-control group-data font-monospace" rows="2"></textarea></div>
            </div>`;
        container.appendChild(div);
    });

    $('btn-remove-group').addEventListener('click', () => {
        if(container.children.length > 2) container.removeChild(container.lastChild);
    });

    function calculate() {
        const groups = Array.from(container.children).map(card => {
            const data = card.querySelector('.group-data').value.split(/[\s,;\n]+/).filter(v => v.trim() !== '' && !isNaN(v)).map(Number);
            return data;
        }).filter(g => g.length > 0);

        if (groups.length < 3) {
            alert('ANOVA requires at least 3 groups.');
            return;
        }

        const k = groups.length; // number of groups
        const ns = groups.map(g => g.length);
        const N = ns.reduce((a, b) => a + b, 0);
        const means = groups.map(g => jStat.mean(g));
        const grandMean = jStat.mean([].concat(...groups));

        // Sum of Squares Between (SSB)
        const ssb = groups.reduce((acc, g, i) => acc + g.length * Math.pow(means[i] - grandMean, 2), 0);
        const dfb = k - 1;
        const msb = ssb / dfb;

        // Sum of Squares Within (SSW)
        const ssw = groups.reduce((acc, g, i) => {
            const groupSumSq = g.reduce((sum, x) => sum + Math.pow(x - means[i], 2), 0);
            return acc + groupSumSq;
        }, 0);
        const dfw = N - k;
        const msw = ssw / dfw;

        const f = msb / msw;
        const p = 1 - jStat.centralF.cdf(f, dfb, dfw);

        $('res-f').textContent = f.toFixed(4);
        $('res-p').textContent = p.toFixed(6);
        $('res-sig').textContent = p < 0.05 ? "Statistically Significant" : "Not Significant";
        $('res-sig').className = p < 0.05 ? "output-hero-unit text-success fw-bold" : "output-hero-unit text-danger fw-bold";

        const tbody = $('anova-table');
        tbody.innerHTML = `
            <tr><td class="ps-4 fw-bold">Between Groups</td><td>${ssb.toFixed(2)}</td><td>${dfb}</td><td>${msb.toFixed(2)}</td><td class="text-end pe-4">${f.toFixed(4)}</td></tr>
            <tr><td class="ps-4 fw-bold">Within Groups</td><td>${ssw.toFixed(2)}</td><td>${dfw}</td><td>${msw.toFixed(2)}</td><td class="text-end pe-4">-</td></tr>
            <tr class="table-light"><td class="ps-4 fw-bold">Total</td><td>${(ssb+ssw).toFixed(2)}</td><td>${N-1}</td><td>-</td><td class="text-end pe-4">-</td></tr>
        `;

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
.stat-pill .label { font-size: 0.7rem; font-weight: 700; color: #64748b; text-transform: uppercase; }
.stat-pill .value { font-size: 1.4rem; font-weight: 800; color: #0f172a; }
.table th { font-size: 0.7rem; color: #64748b; padding: 1rem; }
.table td { padding: 1rem; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\anova-calculator.blade.php ENDPATH**/ ?>