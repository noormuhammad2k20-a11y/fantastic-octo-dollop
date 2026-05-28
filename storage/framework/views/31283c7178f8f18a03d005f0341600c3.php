<div class="row g-4 euler-totient-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Enter an Integer (n)</label>
                        <input type="number" id="totient-n" class="form-control form-control-lg rounded-3" value="36" min="1" step="1" placeholder="e.g., 36">
                        <div class="form-text mt-2">Euler's totient function φ(n) counts integers k such that 1 ≤ k ≤ n and gcd(n, k) = 1.</div>
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
        <div class="output-card-themed" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Totient Value φ(n)</span>
                <div class="output-hero-value" id="out-phi">0</div>
                <span class="output-hero-unit" id="out-n-label">for n = 36</span>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-md-6">
                    <div class="stat-card p-3 rounded-3 border bg-white">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Prime Factors</div>
                        <div class="fs-5 fw-bold" id="out-factors">-</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card p-3 rounded-3 border bg-white">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Coprimality Ratio</div>
                        <div class="fs-5 fw-bold" id="out-ratio">0%</div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Mathematical Breakdown</h6>
                <div class="math-steps small text-secondary" id="math-steps">
                    <!-- Steps -->
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Results
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function getPrimeFactors(n) {
        const factors = new Set();
        let d = 2;
        let temp = n;
        while (d * d <= temp) {
            while (temp % d === 0) {
                factors.add(d);
                temp /= d;
            }
            d++;
        }
        if (temp > 1) factors.add(temp);
        return Array.from(factors);
    }

    function calculate() {
        const n = parseInt($('totient-n').value);
        if (isNaN(n) || n < 1) return;

        if (n === 1) {
            $('out-phi').textContent = '1';
            $('out-n-label').textContent = 'for n = 1';
            $('out-factors').textContent = 'None';
            $('out-ratio').textContent = '100%';
            $('math-steps').innerHTML = '<p>By definition, $\phi(1) = 1$.</p>';
            $('output-section').style.display = 'block';
            return;
        }

        const factors = getPrimeFactors(n);
        let phi = n;
        let formula = `${n}`;
        factors.forEach(p => {
            phi = phi * (p - 1) / p;
            formula += ` \\times (1 - \\frac{1}{${p}})`;
        });

        $('out-phi').textContent = Math.round(phi);
        $('out-n-label').textContent = `for n = ${n}`;
        $('out-factors').textContent = factors.join(', ');
        $('out-ratio').textContent = ((phi / n) * 100).toFixed(1) + '%';

        let stepsHtml = `<p>Euler's product formula states:</p>`;
        stepsHtml += `<p class="text-center my-3">$\\phi(n) = n \\prod_{p|n} (1 - \\frac{1}{p})$</p>`;
        stepsHtml += `<ul class="ps-3 mt-2">`;
        stepsHtml += `<li class="mb-2"><b>Step 1:</b> Find prime factors of $n = ${n}$. Prime factors are: $\{${factors.join(', ')}\}$.</li>`;
        stepsHtml += `<li class="mb-2"><b>Step 2:</b> Apply the product formula:</li>`;
        stepsHtml += `<li class="mb-2">$\\phi(${n}) = ${formula} = ${Math.round(phi)}$</li>`;
        stepsHtml += `</ul>`;
        stepsHtml += `<p class="mt-3 text-success fw-bold">Result: There are ${Math.round(phi)} integers less than or equal to ${n} that are relatively prime to it.</p>`;

        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('math-steps')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('totient-n').value = '36';
        $('output-section').style.display = 'none';
    });

    $('btn-copy-results').addEventListener('click', function() {
        const text = `Euler's Totient Report (n=${$('totient-n').value})\nφ(n): ${$('out-phi').textContent}\nPrime Factors: ${$('out-factors').textContent}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Results Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

});
</script>

<style>
.euler-totient-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.euler-totient-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.euler-totient-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.euler-totient-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.euler-totient-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.euler-totient-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\euler-totient-calculator.blade.php ENDPATH**/ ?>