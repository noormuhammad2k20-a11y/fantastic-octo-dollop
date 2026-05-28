<div class="row g-4 extended-euclidean-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Integer a</label>
                        <input type="number" id="euc-a" class="form-control form-control-lg rounded-3" value="240" step="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Integer b</label>
                        <input type="number" id="euc-b" class="form-control form-control-lg rounded-3" value="46" step="1">
                    </div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Calculate
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:45;--tool-color:#d97706;--tool-bg:rgba(245,158,11,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Greatest Common Divisor (GCD)</span>
                <div class="output-hero-value" id="out-gcd">0</div>
                <span class="output-hero-unit" id="out-identity">ax + by = gcd</span>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-md-6">
                    <div class="stat-card p-3 rounded-3 border bg-white text-center">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Coefficient x</div>
                        <div class="fs-4 fw-bold text-primary" id="out-x">0</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card p-3 rounded-3 border bg-white text-center">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Coefficient y</div>
                        <div class="fs-4 fw-bold text-primary" id="out-y">0</div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2 text-primary"></i>Step-by-Step Iterations</h6>
                <div class="table-responsive">
                    <table class="table table-hover table-sm" id="iteration-table">
                        <thead class="table-light">
                            <tr>
                                <th>Step</th>
                                <th>Quotient (q)</th>
                                <th>Remainder (r)</th>
                                <th>x</th>
                                <th>y</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Mathematical Verification</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Bezout's Identity
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function extendedGCD(a, b) {
        let x = 0, y = 1, u = 1, v = 0;
        let iterations = [];
        let step = 0;

        while (a !== 0) {
            let q = Math.floor(b / a);
            let r = b % a;
            let m = x - u * q;
            let n = y - v * q;
            
            iterations.push({ step: ++step, q, r, x: u, y: v, oldA: a, oldB: b });
            
            b = a;
            a = r;
            x = u;
            y = v;
            u = m;
            v = n;
        }
        
        return { gcd: b, x, y, iterations };
    }

    function calculate() {
        const a = parseInt($('euc-a').value);
        const b = parseInt($('euc-b').value);

        if (isNaN(a) || isNaN(b)) return;

        const result = extendedGCD(a, b);
        
        $('out-gcd').textContent = result.gcd;
        $('out-x').textContent = result.x;
        $('out-y').textContent = result.y;
        $('out-identity').textContent = `${a}(${result.x}) + ${b}(${result.y}) = ${result.gcd}`;

        const tbody = $('iteration-table').querySelector('tbody');
        tbody.innerHTML = '';
        result.iterations.forEach(row => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${row.step}</td>
                <td>${row.q}</td>
                <td>${row.r}</td>
                <td>${row.x}</td>
                <td>${row.y}</td>
            `;
            tbody.appendChild(tr);
        });

        let stepsHtml = `<p>According to Bézout's Identity, for any integers $a$ and $b$, there exist integers $x$ and $y$ such that:</p>`;
        stepsHtml += `<p class="text-center my-3 fs-5">$ax + by = \text{gcd}(a, b)$</p>`;
        stepsHtml += `<p>For $a = ${a}$ and $b = ${b}$:</p>`;
        stepsHtml += `<ul class="ps-3">`;
        stepsHtml += `<li>$\text{gcd}(${a}, ${b}) = ${result.gcd}$</li>`;
        stepsHtml += `<li>$x = ${result.x}$</li>`;
        stepsHtml += `<li>$y = ${result.y}$</li>`;
        stepsHtml += `</ul>`;
        stepsHtml += `<div class="alert alert-info mt-2"><b>Check:</b> $${a}(${result.x}) + ${b}(${result.y}) = ${a * result.x} + ${b * result.y} = ${a * result.x + b * result.y}$</div>`;

        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('math-steps')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('euc-a').value = '240';
        $('euc-b').value = '46';
        $('output-section').style.display = 'none';
    });

    $('btn-copy-results').addEventListener('click', function() {
        navigator.clipboard.writeText($('out-identity').textContent).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied Identity!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

});
</script>

<style>
.extended-euclidean-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.extended-euclidean-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.extended-euclidean-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.extended-euclidean-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.extended-euclidean-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.extended-euclidean-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

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
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(245,158,11,0.2); }
.output-hero-label { display: block; font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
.output-hero-value { font-size: 4rem; font-weight: 900; color: #0f172a; line-height: 1; margin-bottom: 0.5rem; }
.output-hero-unit { font-size: 1rem; color: #64748b; font-weight: 500; }
</style>

