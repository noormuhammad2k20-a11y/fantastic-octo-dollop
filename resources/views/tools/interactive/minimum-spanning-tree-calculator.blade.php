<div class="row g-4 mst-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Enter Weighted Edges</label>
                    <textarea id="mst-edges" class="form-control form-control-lg rounded-3" rows="4" placeholder="e.g., A-B:4, B-C:8, A-C:2"></textarea>
                    <div class="form-text mt-2">Format: Vertex1-Vertex2:Weight (e.g., 1-2:10). Separate multiple edges with commas or newlines.</div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Calculate MST
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Total MST Weight</span>
                <div class="output-hero-value" id="out-mst-weight">0</div>
                <span class="output-hero-unit">sum of selected edge weights</span>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-check-circle me-2 text-success"></i>Edges in Minimum Spanning Tree</h6>
            <div class="table-responsive rounded-3 border">
                <table class="table table-hover mb-0" id="mst-table">
                    <thead class="table-light">
                        <tr>
                            <th>Edge</th>
                            <th>Weight</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Mathematical Logic (Kruskal's)</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy MST Summary
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    class UnionFind {
        constructor(elements) {
            this.parent = {};
            elements.forEach(e => this.parent[e] = e);
        }
        find(i) {
            if (this.parent[i] === i) return i;
            return this.parent[i] = this.find(this.parent[i]);
        }
        union(i, j) {
            const rootI = this.find(i);
            const rootJ = this.find(j);
            if (rootI !== rootJ) {
                this.parent[rootI] = rootJ;
                return true;
            }
            return false;
        }
    }

    function calculate() {
        const input = $('mst-edges').value.trim();
        if (!input) return;

        const edgeStrings = input.split(/[\s,\n]+/).filter(e => e.includes('-') && e.includes(':'));
        const edges = [];
        const vertices = new Set();

        edgeStrings.forEach(s => {
            const parts = s.split(':');
            const nodes = parts[0].split('-');
            if (nodes.length >= 2 && parts[1]) {
                const u = nodes[0].trim(), v = nodes[1].trim(), w = parseFloat(parts[1]);
                if (!isNaN(w)) {
                    edges.push({ u, v, w, original: s });
                    vertices.add(u);
                    vertices.add(v);
                }
            }
        });

        // Kruskal's Algorithm
        edges.sort((a, b) => a.w - b.w);
        const uf = new UnionFind(vertices);
        const mst = [];
        let totalWeight = 0;

        edges.forEach(edge => {
            if (uf.union(edge.u, edge.v)) {
                mst.push(edge);
                totalWeight += edge.w;
            }
        });

        $('out-mst-weight').textContent = totalWeight;

        const tbody = $('mst-table').querySelector('tbody');
        tbody.innerHTML = '';
        edges.forEach(e => {
            const inMst = mst.includes(e);
            const tr = document.createElement('tr');
            tr.className = inMst ? 'table-success' : '';
            tr.innerHTML = `
                <td><code>${e.u} ↔ ${e.v}</code></td>
                <td>${e.w}</td>
                <td>${inMst ? '<span class="badge bg-success">Selected</span>' : '<span class="text-muted">Cycle Avoided</span>'}</td>
            `;
            tbody.appendChild(tr);
        });

        let stepsHtml = `<p><b>Kruskal's Algorithm Steps:</b></p>`;
        stepsHtml += `<ol class="ps-3 mt-2">`;
        stepsHtml += `<li class="mb-1">Sort all edges by weight in ascending order.</li>`;
        stepsHtml += `<li class="mb-1">Iterate through sorted edges and add them to the MST if they don't form a cycle.</li>`;
        stepsHtml += `<li class="mb-1">Total weight of MST = ${totalWeight}.</li>`;
        stepsHtml += `</ol>`;
        stepsHtml += `<p class="mt-2 text-muted">The resulting tree connects all ${vertices.size} vertices with minimum possible total edge weight.</p>`;

        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('mst-edges').value = '';
        $('output-section').style.display = 'none';
    });

    $('btn-copy-results').addEventListener('click', function() {
        const text = `Minimum Spanning Tree\nTotal Weight: ${$('out-mst-weight').textContent}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

});
</script>

<style>
.mst-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.mst-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.mst-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.mst-calc-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.mst-calc-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.mst-calc-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

.quick-actions-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; }
.btn-primary-action { background: #1e293b; color: #fff; border: none; border-radius: 14px; padding: 1rem; font-weight: 700; transition: all 0.2s; }
.btn-primary-action:hover { background: #0f172a; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.btn-secondary-action { background: #f1f5f9; color: #475569; border: none; border-radius: 14px; padding: 1rem; font-weight: 600; transition: all 0.2s; }
.btn-secondary-action:hover { background: #e2e8f0; color: #1e293b; }

@media (max-width: 768px) {
    .quick-actions-grid { grid-template-columns: 1fr 1fr; }
    .btn-primary-action { grid-column: span 2; }
}

.output-card-themed { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; margin-top: 2rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(16,185,129,0.2); }
.output-hero-label { display: block; font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
.output-hero-value { font-size: 4rem; font-weight: 900; color: #0f172a; line-height: 1; margin-bottom: 0.5rem; }
.output-hero-unit { font-size: 1rem; color: #64748b; font-weight: 500; }
</style>

