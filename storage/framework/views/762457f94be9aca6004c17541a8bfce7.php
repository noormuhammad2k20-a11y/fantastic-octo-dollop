<div class="row g-4 graph-degree-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Enter Edges</label>
                    <textarea id="graph-edges" class="form-control form-control-lg rounded-3" rows="4" placeholder="e.g., 1-2, 2-3, 3-1, 1-4"></textarea>
                    <div class="form-text mt-2">Enter edges as pairs separated by hyphens (e.g., 1-2) or spaces. Use commas or newlines between edges.</div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Calculate Degrees
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:210;--tool-color:#2563eb;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Total Degree Sum</span>
                <div class="output-hero-value" id="out-total-degree">0</div>
                <span class="output-hero-unit" id="out-lemma">$\sum \text{deg}(v) = 2|E|$</span>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-md-4">
                    <div class="stat-card p-3 rounded-3 border bg-white">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Vertices (V)</div>
                        <div class="fs-4 fw-bold" id="out-v">0</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-3 rounded-3 border bg-white">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Edges (E)</div>
                        <div class="fs-4 fw-bold" id="out-e">0</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-3 rounded-3 border bg-white">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Average Degree</div>
                        <div class="fs-4 fw-bold" id="out-avg">0</div>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-list-ol me-2 text-primary"></i>Vertex Degree Distribution</h6>
            <div class="table-responsive rounded-3 border">
                <table class="table table-hover mb-0" id="degree-table">
                    <thead class="table-light">
                        <tr>
                            <th>Vertex</th>
                            <th>Degree</th>
                            <th>Neighbors</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Mathematical Validation</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Graph Summary
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function calculate() {
        const input = $('graph-edges').value.trim();
        if (!input) return;

        const edgePairs = input.split(/[\s,\n]+/).filter(e => e.includes('-') || e.includes(' '));
        const adj = {};
        let edgeCount = 0;

        edgePairs.forEach(pair => {
            const nodes = pair.split(/[- ]+/).filter(n => n !== '');
            if (nodes.length >= 2) {
                const u = nodes[0], v = nodes[1];
                if (!adj[u]) adj[u] = new Set();
                if (!adj[v]) adj[v] = new Set();
                adj[u].add(v);
                adj[v].add(u);
                edgeCount++;
            }
        });

        const vertices = Object.keys(adj);
        let totalDegree = 0;
        const results = vertices.map(v => {
            const deg = adj[v].size;
            totalDegree += deg;
            return { v, deg, neighbors: Array.from(adj[v]).join(', ') };
        });

        $('out-total-degree').textContent = totalDegree;
        $('out-v').textContent = vertices.length;
        $('out-e').textContent = edgeCount;
        $('out-avg').textContent = vertices.length ? (totalDegree / vertices.length).toFixed(2) : 0;

        const tbody = $('degree-table').querySelector('tbody');
        tbody.innerHTML = '';
        results.sort((a, b) => b.deg - a.deg).forEach(r => {
            const tr = document.createElement('tr');
            tr.innerHTML = `<td><code>${r.v}</code></td><td><span class="badge bg-primary rounded-pill">${r.deg}</span></td><td class="small text-muted">${r.neighbors}</td>`;
            tbody.appendChild(tr);
        });

        let stepsHtml = `<p><b>Handshaking Lemma:</b> In any undirected graph, the sum of the degrees of all vertices is exactly twice the number of edges.</p>`;
        stepsHtml += `<p class="text-center my-3 fs-5">$\\sum_{v \\in V} \\text{deg}(v) = 2|E|$</p>`;
        stepsHtml += `<ul class="ps-3 mt-2">`;
        stepsHtml += `<li class="mb-2"><b>Sum of Degrees:</b> ${totalDegree}</li>`;
        stepsHtml += `<li class="mb-2"><b>2 $\\times$ Edges:</b> $2 \\times ${edgeCount} = ${2 * edgeCount}$</li>`;
        if (totalDegree === 2 * edgeCount) {
            stepsHtml += `<li class="text-success fw-bold"><i class="fas fa-check-circle me-1"></i> Lemma Verified: ${totalDegree} = ${2 * edgeCount}</li>`;
        } else {
            stepsHtml += `<li class="text-danger fw-bold"><i class="fas fa-exclamation-triangle me-1"></i> Discrepancy Found: Are there duplicate edges or self-loops?</li>`;
        }
        stepsHtml += `</ul>`;

        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('math-steps')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('graph-edges').value = '';
        $('output-section').style.display = 'none';
    });

    $('btn-copy-results').addEventListener('click', function() {
        const text = `Graph Summary\nVertices: ${$('out-v').textContent}\nEdges: ${$('out-e').textContent}\nDegree Sum: ${$('out-total-degree').textContent}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

});
</script>

<style>
.graph-degree-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.graph-degree-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.graph-degree-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.graph-degree-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.graph-degree-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.graph-degree-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

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
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(59,130,246,0.2); }
.output-hero-label { display: block; font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
.output-hero-value { font-size: 4rem; font-weight: 900; color: #0f172a; line-height: 1; margin-bottom: 0.5rem; }
.output-hero-unit { font-size: 1rem; color: #64748b; font-weight: 500; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\graph-degree-validator.blade.php ENDPATH**/ ?>