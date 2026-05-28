<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-4 mb-4" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-bolt text-warning me-2"></i>Quick Examples</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 root-ex" data-num="25" data-deg="2">√25</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 root-ex" data-num="27" data-deg="3">∛27</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 root-ex" data-num="256" data-deg="4">⁴√256</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 root-ex" data-num="2" data-deg="2">√2</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 root-ex" data-num="1000" data-deg="3">∛1000</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 root-ex" data-num="7776" data-deg="5">⁵√7776</button>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Number (Radicand)</label>
                    <input type="number" id="root-num" class="form-control form-control-lg rounded-3" value="25" step="any" tabindex="1">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Root Degree (n)</label>
                    <select id="root-deg-sel" class="form-select form-select-lg rounded-3">
                        <option value="2" selected>2 — Square Root (√)</option>
                        <option value="3">3 — Cube Root (∛)</option>
                        <option value="4">4 — Fourth Root</option>
                        <option value="5">5 — Fifth Root</option>
                        <option value="custom">Custom...</option>
                    </select>
                </div>
                <div class="col-md-4" id="root-custom-wrap" style="display:none">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Custom Root Degree</label>
                    <input type="number" id="root-custom-deg" class="form-control form-control-lg rounded-3" value="6" min="2" step="1">
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Decimal Precision</label>
                    <select id="root-prec" class="form-select rounded-3">
                        <option value="4">4 decimal places</option>
                        <option value="6" selected>6 decimal places</option>
                        <option value="8">8 decimal places</option>
                        <option value="10">10 decimal places</option>
                    </select>
                </div>
            </div>

            <div class="mt-4 p-3 rounded-4" style="background:#ecfeff;border:1.5px solid #a5f3fc">
                <p class="mb-0 small text-secondary"><i class="fas fa-info-circle me-2" style="color:#0ea5e9"></i>
                    <strong>nth Root Formula:</strong> <sup>n</sup>√x = x<sup>1/n</sup>. The nth root of x is the value that, when raised to the nth power, equals x.
                </p>
            </div>
        </div>
    </div>

    
    <div class="card tool-card-stacked shadow-sm border-0" id="root-result-card">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Step-by-Step Solution</h5>
                        <p class="text-muted small mb-0">Detailed root computation breakdown</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="root-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i> Copy Steps</button>
                    <button class="btn btn-dark btn-sm rounded-pill px-3" id="root-pdf" style="min-width: 280px; max-width: 100%;"><i class="fas fa-file-pdf me-1"></i> Download PDF</button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="p-4 rounded-4 d-inline-block" style="background:#ecfeff;border:2px solid #a5f3fc;min-width:260px">
                    <span class="d-block small fw-bold text-uppercase text-muted mb-1" style="letter-spacing:1px" id="root-eq-label">√25 =</span>
                    <div class="display-3 fw-bold" style="color:#0891b2" id="root-answer">5</div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">Exact?</span><span class="stat-card-value" id="root-out-exact">Yes</span></div></div>
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">As Fraction</span><span class="stat-card-value" id="root-out-frac">5/1</span></div></div>
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">As Exponent</span><span class="stat-card-value" id="root-out-exp">25^(1/2)</span></div></div>
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">Squared</span><span class="stat-card-value" id="root-out-squared">25</span></div></div>
            </div>

            <div class="p-4 rounded-4 bg-light border" id="root-steps-box">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2" style="color:#0ea5e9"></i>Solution Steps</h6>
                <div id="root-steps" class="small text-secondary"></div>
            </div>
        </div>
    </div>
</div>

<style>
    .tool-card-stacked { border-radius: 24px; background: #fff; }
    .icon-box { width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }
    .step-item { padding: 0.75rem 1rem; background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; margin-bottom: 0.5rem; }
    .step-num { display: inline-flex; width: 28px; height: 28px; border-radius: 50%; background: #0ea5e9; color: #fff; align-items: center; justify-content: center; font-weight: 800; font-size: 0.8rem; margin-right: 0.75rem; flex-shrink: 0; }

    @media print {
        .card:not(#root-result-card), .header-actions, .header-v2, .p-3.rounded-4, .mt-4.p-3.rounded-4, footer, nav, .sidebar { display: none !important; }
        .card#root-result-card { border: none !important; box-shadow: none !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
        #root-result-card .display-3 { font-size: 3.5rem !important; }
        .step-item { page-break-inside: avoid; border: 1px solid #eee !important; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const numE = document.getElementById('root-num');
    const degSelE = document.getElementById('root-deg-sel');
    const customDegE = document.getElementById('root-custom-deg');
    const customWrap = document.getElementById('root-custom-wrap');
    const precE = document.getElementById('root-prec');

    degSelE.addEventListener('change', () => {
        customWrap.style.display = degSelE.value === 'custom' ? '' : 'none';
        calculate();
    });

    function getDegree() {
        return degSelE.value === 'custom' ? (parseInt(customDegE.value) || 2) : parseInt(degSelE.value);
    }

    function rootSymbol(n) {
        if (n === 2) return '√';
        if (n === 3) return '∛';
        if (n === 4) return '⁴√';
        return `<sup>${n}</sup>√`;
    }

    function fmt(n) { return parseFloat(n.toFixed(parseInt(precE.value))); }

    function isPerfectRoot(x, n) {
        if (x < 0 && n % 2 === 0) return false;
        const root = Math.round(Math.pow(Math.abs(x), 1/n));
        return Math.pow(root, n) === Math.abs(x);
    }

    function calculate() {
        const x = parseFloat(numE.value);
        const n = getDegree();
        if (isNaN(x) || isNaN(n) || n < 1) return;

        const steps = [];
        let result;

        if (x < 0 && n % 2 === 0) {
            document.getElementById('root-answer').textContent = 'Undefined (even root of negative)';
            document.getElementById('root-steps').innerHTML = '<div class="alert alert-warning mb-0">Even roots of negative numbers are not real numbers.</div>';
            return;
        }

        if (x < 0 && n % 2 !== 0) {
            result = -Math.pow(Math.abs(x), 1/n);
        } else {
            result = Math.pow(x, 1/n);
        }

        steps.push({ text: `<strong>Given:</strong> x = ${x}, root degree n = ${n}` });
        steps.push({ text: `<strong>Formula:</strong> ${rootSymbol(n)}${x} = ${x}<sup>1/${n}</sup>` });
        steps.push({ text: `<strong>Exponent form:</strong> ${x}<sup>${fmt(1/n)}</sup>` });
        steps.push({ text: `<strong>Result:</strong> ${rootSymbol(n)}${x} = <strong>${fmt(result)}</strong>` });

        const isExact = isPerfectRoot(x, n);
        if (isExact) {
            steps.push({ text: `<strong>Perfect ${n === 2 ? 'square' : n === 3 ? 'cube' : 'power'}:</strong> ${Math.round(result)}<sup>${n}</sup> = ${x} ✓` });
        } else {
            steps.push({ text: `<strong>Note:</strong> This is an irrational number (non-terminating decimal)` });
        }

        const verify = Math.pow(result, n);
        steps.push({ text: `<strong>Verification:</strong> ${fmt(result)}<sup>${n}</sup> = ${fmt(verify)} ≈ ${x} ✓` });

        document.getElementById('root-answer').textContent = fmt(result);
        document.getElementById('root-eq-label').innerHTML = `${rootSymbol(n)}${x} =`;
        document.getElementById('root-out-exact').textContent = isExact ? 'Yes ✓' : 'No (irrational)';
        document.getElementById('root-out-frac').textContent = isExact ? `${Math.round(result)}/1` : '≈ ' + fmt(result);
        document.getElementById('root-out-exp').textContent = `${x}^(1/${n})`;
        document.getElementById('root-out-squared').textContent = fmt(result * result);

        document.getElementById('root-steps').innerHTML = steps.map((st, i) =>
            `<div class="step-item d-flex align-items-start"><span class="step-num">${i+1}</span><span>${st.text}</span></div>`
        ).join('');
    }

    [numE, customDegE, precE].forEach(el => el.addEventListener('input', calculate));
    degSelE.addEventListener('change', calculate);

    document.querySelectorAll('.root-ex').forEach(btn => {
        btn.addEventListener('click', () => {
            numE.value = btn.dataset.num;
            const d = btn.dataset.deg;
            if (['2','3','4','5'].includes(d)) { degSelE.value = d; customWrap.style.display = 'none'; }
            else { degSelE.value = 'custom'; customDegE.value = d; customWrap.style.display = ''; }
            calculate();
        });
    });

    document.getElementById('root-reset').addEventListener('click', () => {
        numE.value = 25; degSelE.value = '2'; customWrap.style.display = 'none'; calculate();
    });

    document.getElementById('root-copy').addEventListener('click', function() {
        const title = "Root Calculation Report\n" + "=".repeat(30) + "\n";
        const answer = `Result: ${document.getElementById('root-answer').textContent}\n`;
        const steps = document.getElementById('root-steps-box').innerText.replace('Solution Steps', '').trim();
        const text = title + answer + "\n" + steps + "\n\nGenerated via ToolsHub";
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-1"></i> Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    document.getElementById('root-pdf').addEventListener('click', function() {
        window.print();
    });

    calculate();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\roots-calculator.blade.php ENDPATH**/ ?>