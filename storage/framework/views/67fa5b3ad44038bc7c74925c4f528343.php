<div class="row g-4 math-suite-modernized">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label-custom">Graph Edges (Source, Target, Weight)</label>
                        <div id="edges-container">
                            <div class="row g-2 mb-2 edge-row">
                                <div class="col-4"><input type="text" class="form-control src-node" placeholder="A" value="A"></div>
                                <div class="col-4"><input type="text" class="form-control tgt-node" placeholder="B" value="B"></div>
                                <div class="col-4"><input type="number" class="form-control weight" placeholder="Weight" value="5"></div>
                            </div>
                            <div class="row g-2 mb-2 edge-row">
                                <div class="col-4"><input type="text" class="form-control src-node" placeholder="B" value="B"></div>
                                <div class="col-4"><input type="text" class="form-control tgt-node" placeholder="C" value="C"></div>
                                <div class="col-4"><input type="number" class="form-control weight" placeholder="Weight" value="3"></div>
                            </div>
                            <div class="row g-2 mb-2 edge-row">
                                <div class="col-4"><input type="text" class="form-control src-node" placeholder="A" value="A"></div>
                                <div class="col-4"><input type="text" class="form-control tgt-node" placeholder="C" value="C"></div>
                                <div class="col-4"><input type="number" class="form-control weight" placeholder="Weight" value="10"></div>
                            </div>
                        </div>
                        <button class="btn btn-outline-primary btn-sm mt-2" id="btn-add-edge" style="min-width: 280px; max-width: 100%;"><i class="fas fa-plus me-1"></i>Add Edge</button>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Start Node</label>
                        <input type="text" id="input-start" class="form-control" value="A">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">End Node</label>
                        <input type="text" id="input-end" class="form-control" value="C">
                    </div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#2563eb;box-shadow:0 4px 12px rgba(37,99,235,0.2)">
                            <i class="fas fa-route me-2"></i>Find Shortest Path
                        </button>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-example" style="min-width: 280px; max-width: 100%;">Complex Example</button>
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-reset" style="min-width: 280px; max-width: 100%;">Reset</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:220;--tool-color:#2563eb;--tool-bg:rgba(37,99,235,.04); display: none;">
            <div class="output-hero mb-4">
                <span class="output-hero-label">Shortest Path Found</span>
                <div class="output-hero-value fs-2" id="res-path">A → B → C</div>
                <span class="output-hero-unit" id="res-weight">Total Weight: 8</span>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-4"><i class="fas fa-stream me-2 text-primary"></i>Path Decomposition</h6>
                <div class="table-responsive rounded-3 border bg-white">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr><th>Step</th><th>Edge</th><th>Cumulative Weight</th></tr>
                        </thead>
                        <tbody id="steps-table"></tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Path
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const container = $('edges-container');

    $('btn-add-edge').addEventListener('click', () => {
        const div = document.createElement('div');
        div.className = 'row g-2 mb-2 edge-row';
        div.innerHTML = `
            <div class="col-4"><input type="text" class="form-control src-node"></div>
            <div class="col-4"><input type="text" class="form-control tgt-node"></div>
            <div class="col-4"><input type="number" class="form-control weight"></div>
        `;
        container.appendChild(div);
    });

    function calculate() {
        const edges = [];
        const nodes = new Set();
        document.querySelectorAll('.edge-row').forEach(row => {
            const u = row.querySelector('.src-node').value.trim();
            const v = row.querySelector('.tgt-node').value.trim();
            const w = parseFloat(row.querySelector('.weight').value);
            if (u && v && !isNaN(w)) {
                edges.push({ u, v, w });
                nodes.add(u); nodes.add(v);
            }
        });

        const start = $('input-start').value.trim();
        const end = $('input-end').value.trim();

        if (!nodes.has(start) || !nodes.has(end)) {
            alert('Start or End node not found in edge list.');
            return;
        }

        // Dijkstra Algorithm
        const distances = {};
        const previous = {};
        const pq = new Set(nodes);

        nodes.forEach(node => {
            distances[node] = Infinity;
            previous[node] = null;
        });
        distances[start] = 0;

        while (pq.size > 0) {
            let u = null;
            pq.forEach(node => {
                if (u === null || distances[node] < distances[u]) u = node;
            });

            if (u === end || distances[u] === Infinity) break;
            pq.delete(u);

            edges.forEach(edge => {
                if (edge.u === u && pq.has(edge.v)) {
                    const alt = distances[u] + edge.w;
                    if (alt < distances[edge.v]) {
                        distances[edge.v] = alt;
                        previous[edge.v] = u;
                    }
                }
            });
        }

        if (distances[end] === Infinity) {
            alert('No path found.');
            return;
        }

        const path = [];
        let curr = end;
        while (curr !== null) {
            path.unshift(curr);
            curr = previous[curr];
        }

        $('res-path').textContent = path.join(' → ');
        $('res-weight').textContent = `Total Weight: ${distances[end]}`;

        let stepsHtml = '';
        let cumWeight = 0;
        for (let i = 0; i < path.length - 1; i++) {
            const u = path[i];
            const v = path[i+1];
            const edge = edges.find(e => e.u === u && e.v === v);
            cumWeight += edge.w;
            stepsHtml += `<tr><td>${i+1}</td><td>${u} → ${v}</td><td>${cumWeight}</td></tr>`;
        }
        $('steps-table').innerHTML = stepsHtml;

        $('results-card').style.display = 'block';
        $('results-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => { location.reload(); });
});
</script>

<style>
.math-suite-modernized .calculator-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
.math-suite-modernized .calculator-header { display: flex; align-items: center; gap: 1.2rem; margin-bottom: 2.5rem; }
.math-suite-modernized .calculator-header h4 { margin: 0; font-weight: 800; color: #0f172a; }
.math-suite-modernized .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; }
.math-suite-modernized .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.math-suite-modernized .form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; margin-bottom: 0.6rem; display: block; }
.btn-primary-stats { color: #fff; border: none; border-radius: 12px; transition: all 0.3s; }
.btn-dark-stats { background: #0f172a; color: #fff; border: none; border-radius: 12px; }
.output-card-themed { background: #fff; border: 2px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; margin-top: 1rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px solid rgba(0,0,0,0.05); }
.output-hero-label { font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; }
.output-hero-value { font-size: 3rem; font-weight: 900; color: #0f172a; margin: 0.5rem 0; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\dijkstras-shortest-path-calculator.blade.php ENDPATH**/ ?>