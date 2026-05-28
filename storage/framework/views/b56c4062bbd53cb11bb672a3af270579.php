<div class="row g-4 stirling-numbers-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Value n</label>
                        <input type="number" id="stirl-n" class="form-control form-control-lg rounded-3" value="5" min="0" max="25" step="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Value k</label>
                        <input type="number" id="stirl-k" class="form-control form-control-lg rounded-3" value="3" min="0" max="25" step="1">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Number Type</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-custom active flex-grow-1" data-stype="2nd">2nd Kind $S(n, k)$</button>
                            <button type="button" class="btn btn-outline-custom flex-grow-1" data-stype="1st">1st Kind $s(n, k)$</button>
                        </div>
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
        <div class="output-card-themed" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04);">
            <div class="output-hero">
                <span class="output-hero-label" id="out-label">Stirling Number $S(5, 3)$</span>
                <div class="output-hero-value" id="out-result">0</div>
                <span class="output-hero-unit" id="out-desc">Ways to partition n elements into k non-empty subsets.</span>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Mathematical Breakdown</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let stirlingType = '2nd';

    document.querySelectorAll('[data-stype]').forEach(btn => {
        btn.addEventListener('click', () => {
            stirlingType = btn.dataset.stype;
            document.querySelectorAll('[data-stype]').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    function stirling2(n, k) {
        if (k === 0 && n === 0) return 1;
        if (k === 0 || k > n) return 0;
        if (k === 1 || k === n) return 1;
        // Recurrence: S(n,k) = k*S(n-1,k) + S(n-1,k-1)
        const table = Array.from({ length: n + 1 }, () => Array(k + 1).fill(0));
        for (let i = 0; i <= n; i++) {
            table[i][0] = 0;
            if (i <= k) table[i][i] = 1;
        }
        table[0][0] = 1;
        for (let i = 1; i <= n; i++) {
            for (let j = 1; j < i && j <= k; j++) {
                table[i][j] = j * table[i - 1][j] + table[i - 1][j - 1];
            }
        }
        return table[n][k];
    }

    function stirling1(n, k) {
        if (k === 0 && n === 0) return 1;
        if (k === 0 || k > n) return 0;
        if (k === n) return 1;
        // Recurrence: s(n,k) = (n-1)*s(n-1,k) + s(n-1,k-1) (unsigned)
        const table = Array.from({ length: n + 1 }, () => Array(k + 1).fill(0));
        for (let i = 0; i <= n; i++) {
            if (i <= k) table[i][i] = 1;
        }
        table[0][0] = 1;
        for (let i = 1; i <= n; i++) {
            for (let j = 1; j < i && j <= k; j++) {
                table[i][j] = (i - 1) * table[i - 1][j] + table[i - 1][j - 1];
            }
        }
        return table[n][k];
    }

    function calculate() {
        const n = parseInt($('stirl-n').value);
        const k = parseInt($('stirl-k').value);

        if (isNaN(n) || isNaN(k)) return;

        let result = 0;
        let formula = '';
        let desc = '';

        if (stirlingType === '2nd') {
            result = stirling2(n, k);
            formula = `$S(${n}, ${k})$`;
            desc = `Ways to partition a set of ${n} elements into ${k} non-empty subsets.`;
            $('out-label').innerHTML = `Stirling Number of 2nd Kind ${formula}`;
        } else {
            result = stirling1(n, k);
            formula = `$s(${n}, ${k})$`;
            desc = `Number of ways to arrange ${n} objects into ${k} non-empty cycles.`;
            $('out-label').innerHTML = `Stirling Number of 1st Kind (Unsigned) ${formula}`;
        }

        $('out-result').textContent = result.toLocaleString();
        $('out-desc').textContent = desc;

        let stepsHtml = `<p><b>Recurrence Relation:</b></p>`;
        if (stirlingType === '2nd') {
            stepsHtml += `<p class="text-center my-3 fs-5">$S(n, k) = k S(n-1, k) + S(n-1, k-1)$</p>`;
        } else {
            stepsHtml += `<p class="text-center my-3 fs-5">$s(n, k) = (n-1) s(n-1, k) + s(n-1, k-1)$</p>`;
        }
        stepsHtml += `<p>For $n=${n}$ and $k=${k}$, the calculated value is <b>${result}</b>.</p>`;

        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('math-steps')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('stirl-n').value = '5';
        $('stirl-k').value = '3';
        $('output-section').style.display = 'none';
    });

    $('btn-copy-results').addEventListener('click', function() {
        navigator.clipboard.writeText($('out-result').textContent);
    });
});
</script>

<style>
.stirling-numbers-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.stirling-numbers-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.stirling-numbers-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.stirling-numbers-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.stirling-numbers-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.stirling-numbers-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

.btn-outline-custom { border: 1.5px solid #e2e8f0; color: #64748b; font-weight: 600; border-radius: 14px; padding: 0.8rem 1rem; transition: all 0.2s; font-size: 0.9rem; background: white; }
.btn-outline-custom:hover { background: #f8fafc; border-color: #cbd5e1; color: #1e293b; }
.btn-outline-custom.active { background: #ec4899; color: #fff; border-color: #ec4899; box-shadow: 0 4px 15px rgba(236,72,153,0.2); }

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
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(236,72,153,0.2); }
.output-hero-label { display: block; font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
.output-hero-value { font-size: 4rem; font-weight: 900; color: #0f172a; line-height: 1; margin-bottom: 0.5rem; }
.output-hero-unit { font-size: 1rem; color: #64748b; font-weight: 500; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\stirling-numbers-calculator.blade.php ENDPATH**/ ?>