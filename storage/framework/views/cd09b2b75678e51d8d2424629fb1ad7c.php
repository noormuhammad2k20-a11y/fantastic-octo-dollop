<div class="row g-4 half-life-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Initial Amount (N₀)</label>
                        <input type="number" id="hl-n0" class="form-control form-control-lg rounded-3" value="100" step="any">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Half-Life (t₁/₂)</label>
                        <input type="number" id="hl-h" class="form-control form-control-lg rounded-3" value="5" step="any">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Time Elapsed (t)</label>
                        <input type="number" id="hl-t" class="form-control form-control-lg rounded-3" value="10" step="any">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Remaining Amount (Nₜ)</label>
                        <input type="number" id="hl-nt" class="form-control form-control-lg rounded-3" placeholder="Calculated if empty" step="any">
                    </div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Calculate Remaining
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:25;--tool-color:#ea580c;--tool-bg:rgba(249,115,22,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Remaining Substance N(t)</span>
                <div class="output-hero-value" id="out-hl-nt">0.00</div>
                <span class="output-hero-unit" id="out-hl-summary">After 2 half-lives</span>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-md-6">
                    <div class="stat-card p-3 rounded-3 border bg-white text-center">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Decay Constant (λ)</div>
                        <div class="fs-5 fw-bold text-primary" id="out-hl-lambda">0.1386</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card p-3 rounded-3 border bg-white text-center">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Percent Remaining</div>
                        <div class="fs-5 fw-bold text-success" id="out-hl-percent">25%</div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Mathematical Breakdown</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
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

    function calculate() {
        const n0 = parseFloat($('hl-n0').value);
        const h = parseFloat($('hl-h').value);
        const t = parseFloat($('hl-t').value);

        if (isNaN(n0) || isNaN(h) || isNaN(t)) return;

        const numHalfLives = t / h;
        const nt = n0 * Math.pow(0.5, numHalfLives);
        const lambda = Math.log(2) / h;
        const percent = (nt / n0) * 100;

        $('out-hl-nt').textContent = nt.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 4});
        $('out-hl-summary').textContent = `After ${numHalfLives.toFixed(2)} half-lives`;
        $('out-hl-lambda').textContent = lambda.toFixed(6);
        $('out-hl-percent').textContent = percent.toFixed(2) + '%';

        let stepsHtml = `<p>The half-life decay is calculated using the formula:</p>`;
        stepsHtml += `<p class="text-center my-3 fs-5">$N(t) = N_0 \left(\frac{1}{2}\right)^{t/t_{1/2}}$</p>`;
        stepsHtml += `<ul class="ps-3 mt-2">`;
        stepsHtml += `<li class="mb-2"><b>Initial Amount ($N_0$):</b> ${n0}</li>`;
        stepsHtml += `<li class="mb-2"><b>Half-Life ($t_{1/2}$):</b> ${h}</li>`;
        stepsHtml += `<li class="mb-2"><b>Time Elapsed ($t$):</b> ${t}</li>`;
        stepsHtml += `<li class="mb-2"><b>Decay Constant ($\lambda$):</b> $\frac{\ln(2)}{t_{1/2}} \approx ${lambda.toFixed(6)}$</li>`;
        stepsHtml += `<li class="mb-2"><b>Calculation:</b> $N(t) = ${n0} \times (0.5)^{${t}/${h}} = ${n0} \times ${(Math.pow(0.5, numHalfLives)).toFixed(6)} \approx ${nt.toFixed(4)}$</li>`;
        stepsHtml += `</ul>`;

        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('math-steps')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('hl-n0').value = '100';
        $('hl-h').value = '5';
        $('hl-t').value = '10';
        $('hl-nt').value = '';
        $('output-section').style.display = 'none';
    });

    $('btn-copy-results').addEventListener('click', function() {
        const text = `Half-Life Report\nInitial: ${$('hl-n0').value}\nRemaining: ${$('out-hl-nt').textContent}\nTime: ${$('hl-t').value}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Results Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

});
</script>

<style>
.half-life-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.half-life-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.half-life-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.half-life-calc-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.half-life-calc-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.half-life-calc-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

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
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(249,115,22,0.2); }
.output-hero-label { display: block; font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
.output-hero-value { font-size: 3.5rem; font-weight: 900; color: #0f172a; line-height: 1; margin-bottom: 0.5rem; }
.output-hero-unit { font-size: 1rem; color: #64748b; font-weight: 500; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\half-life-calculator.blade.php ENDPATH**/ ?>