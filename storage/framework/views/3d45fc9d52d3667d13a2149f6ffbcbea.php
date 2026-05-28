<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div id="groups-container">
                    <div class="group-input-card mb-4 p-4 rounded-4 border bg-light">
                        <div class="row g-3">
                            <div class="col-md-4"><label class="form-label-custom">Group A</label><input type="text" class="form-control group-name" value="Treatment 1"></div>
                            <div class="col-md-8"><label class="form-label-custom">Data</label><textarea class="form-control group-data font-monospace" rows="2">1, 3, 5, 7, 9</textarea></div>
                        </div>
                    </div>
                    <div class="group-input-card mb-4 p-4 rounded-4 border bg-light">
                        <div class="row g-3">
                            <div class="col-md-4"><label class="form-label-custom">Group B</label><input type="text" class="form-control group-name" value="Treatment 2"></div>
                            <div class="col-md-8"><label class="form-label-custom">Data</label><textarea class="form-control group-data font-monospace" rows="2">2, 4, 6, 8, 10</textarea></div>
                        </div>
                    </div>
                    <div class="group-input-card mb-4 p-4 rounded-4 border bg-light">
                        <div class="row g-3">
                            <div class="col-md-4"><label class="form-label-custom">Group C</label><input type="text" class="form-control group-name" value="Control"></div>
                            <div class="col-md-8"><label class="form-label-custom">Data</label><textarea class="form-control group-data font-monospace" rows="2">5, 5, 5, 5, 5</textarea></div>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2 mb-4">
                    <button class="btn btn-outline-indigo flex-grow-1" id="btn-add-group" style="min-width: 280px; max-width: 100%;"><i class="fas fa-plus me-2"></i>Add Group</button>
                    <button class="btn btn-outline-danger" id="btn-remove-group" style="min-width: 280px; max-width: 100%;"><i class="fas fa-trash"></i></button>
                </div>
                <div class="row g-3">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#6366f1;box-shadow:0 4px 12px rgba(99,102,241,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate H-Statistic
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:240;--tool-color:#6366f1;--tool-bg:rgba(99,102,241,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">H-Statistic (Kruskal-Wallis)</span>
                <div class="output-hero-value" id="res-h">0.00</div>
                <span class="output-hero-unit" id="res-sig">Statistically Significant</span>
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
                        <span class="label">Degrees of Freedom (k-1)</span>
                        <span class="value" id="res-df">0</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-indigo"></i>Rank Sum Analysis</h6>
                <div class="table-responsive rounded-3 border">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light small">
                            <tr>
                                <th class="ps-4">Group</th>
                                <th>Count (n)</th>
                                <th>Sum of Ranks (R)</th>
                                <th class="text-end pe-4">Mean Rank</th>
                            </tr>
                        </thead>
                        <tbody id="rank-table"></tbody>
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
                <div class="col-md-4"><label class="form-label-custom">Group ${count}</label><input type="text" class="form-control group-name" value="Group ${String.fromCharCode(64+count)}"></div>
                <div class="col-md-8"><label class="form-label-custom">Data</label><textarea class="form-control group-data font-monospace" rows="2"></textarea></div>
            </div>`;
        container.appendChild(div);
    });

    $('btn-remove-group').addEventListener('click', () => { if(container.children.length > 2) container.removeChild(container.lastChild); });

    function calculate() {
        const groups = Array.from(container.children).map(card => {
            return {
                name: card.querySelector('.group-name').value,
                data: card.querySelector('.group-data').value.split(/[\s,;\n]+/).filter(v => v.trim() !== '' && !isNaN(v)).map(Number)
            };
        }).filter(g => g.data.length > 0);

        if (groups.length < 2) return;

        // Combine all data for ranking
        const allData = [];
        groups.forEach((g, idx) => {
            g.data.forEach(val => allData.push({ val, groupIdx: idx }));
        });

        // Sort for ranking
        allData.sort((a, b) => a.val - b.val);

        // Assign Ranks (handle ties)
        let i = 0;
        while (i < allData.length) {
            let j = i;
            while (j < allData.length && allData[j].val === allData[i].val) j++;
            const rank = (i + 1 + j) / 2; // Average rank for ties
            for (let k = i; k < j; k++) allData[k].rank = rank;
            i = j;
        }

        const N = allData.length;
        const k = groups.length;
        const rankSums = Array(k).fill(0);
        allData.forEach(item => rankSums[item.groupIdx] += item.rank);

        // H Formula: [12 / (N(N+1))] * sum(R^2 / n) - 3(N+1)
        let sumPart = 0;
        groups.forEach((g, idx) => {
            sumPart += (Math.pow(rankSums[idx], 2) / g.data.length);
        });

        let H = (12 / (N * (N + 1))) * sumPart - 3 * (N + 1);
        
        // Tie Correction
        const ties = {};
        allData.forEach(item => ties[item.val] = (ties[item.val] || 0) + 1);
        let T = 0;
        Object.values(ties).forEach(count => { if(count > 1) T += (Math.pow(count, 3) - count); });
        if (T > 0) {
            H = H / (1 - T / (Math.pow(N, 3) - N));
        }

        const df = k - 1;
        const pValue = 1 - jStat.chisquare.cdf(H, df);

        $('res-h').textContent = H.toFixed(4);
        $('res-p').textContent = pValue.toFixed(6);
        $('res-df').textContent = df;
        $('res-sig').textContent = pValue < 0.05 ? "Significant" : "Not Significant";

        const tbody = $('rank-table');
        tbody.innerHTML = '';
        groups.forEach((g, idx) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="ps-4 fw-bold">${g.name}</td>
                <td>${g.data.length}</td>
                <td>${rankSums[idx].toFixed(1)}</td>
                <td class="text-end pe-4">${(rankSums[idx]/g.data.length).toFixed(2)}</td>
            `;
            tbody.appendChild(tr);
        });

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
.btn-outline-indigo { border: 2.5px solid #e0e7ff; color: #4f46e5; font-weight: 700; border-radius: 14px; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\kruskal-wallis-test-calculator.blade.php ENDPATH**/ ?>