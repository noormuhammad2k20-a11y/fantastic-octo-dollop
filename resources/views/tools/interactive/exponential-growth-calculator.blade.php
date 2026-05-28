<div class="row g-4 exponential-growth-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Initial Amount (N₀)</label>
                        <input type="number" id="growth-n0" class="form-control form-control-lg rounded-3" value="100" step="any">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Growth Rate (%)</label>
                        <input type="number" id="growth-rate" class="form-control form-control-lg rounded-3" value="5" step="0.1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Time Periods (t)</label>
                        <input type="number" id="growth-t" class="form-control form-control-lg rounded-3" value="10" step="any">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Growth Type</label>
                        <select id="growth-type" class="form-select form-control-lg rounded-3">
                            <option value="discrete">Discrete (Fixed Rate per period)</option>
                            <option value="continuous">Continuous (Exponential e^rt)</option>
                        </select>
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
        <div class="output-card-themed" style="--tool-hue:140;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Final Amount N(t)</span>
                <div class="output-hero-value" id="out-nt">0.00</div>
                <span class="output-hero-unit" id="out-summary">After 10 periods</span>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-md-6">
                    <div class="stat-card p-3 rounded-3 border bg-white text-center">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Total Gain</div>
                        <div class="fs-4 fw-bold text-success" id="out-gain">0.00</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card p-3 rounded-3 border bg-white text-center">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Growth Factor</div>
                        <div class="fs-4 fw-bold text-primary" id="out-factor">0x</div>
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
        const n0 = parseFloat($('growth-n0').value);
        const r = parseFloat($('growth-rate').value) / 100;
        const t = parseFloat($('growth-t').value);
        const type = $('growth-type').value;

        if (isNaN(n0) || isNaN(r) || isNaN(t)) return;

        let nt = 0;
        let formula = '';
        if (type === 'discrete') {
            nt = n0 * Math.pow(1 + r, t);
            formula = `$N(t) = N_0(1 + r)^t$`;
        } else {
            nt = n0 * Math.exp(r * t);
            formula = `$N(t) = N_0 e^{rt}$`;
        }

        const gain = nt - n0;
        const factor = nt / n0;

        $('out-nt').textContent = nt.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        $('out-summary').textContent = `After ${t} periods at ${r*100}% growth`;
        $('out-gain').textContent = gain.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        $('out-factor').textContent = factor.toFixed(2) + 'x';

        let stepsHtml = `<p>The exponential growth is calculated using the ${type} model:</p>`;
        stepsHtml += `<p class="text-center my-3 fs-5">${formula}</p>`;
        stepsHtml += `<ul class="ps-3 mt-2">`;
        stepsHtml += `<li class="mb-2"><b>Initial Value ($N_0$):</b> ${n0}</li>`;
        stepsHtml += `<li class="mb-2"><b>Growth Rate ($r$):</b> ${r} (${r*100}%)</li>`;
        stepsHtml += `<li class="mb-2"><b>Time ($t$):</b> ${t}</li>`;
        if (type === 'discrete') {
            stepsHtml += `<li class="mb-2"><b>Calculation:</b> $N(t) = ${n0} \times (1 + ${r})^{${t}} = ${n0} \times ${(Math.pow(1+r, t)).toFixed(4)} \\approx ${nt.toFixed(2)}$</li>`;
        } else {
            stepsHtml += `<li class="mb-2"><b>Calculation:</b> $N(t) = ${n0} \times e^{${r} \times ${t}} = ${n0} \times e^{${(r*t).toFixed(4)}} \\approx ${nt.toFixed(2)}$</li>`;
        }
        stepsHtml += `</ul>`;

        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('math-steps')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('growth-n0').value = '100';
        $('growth-rate').value = '5';
        $('growth-t').value = '10';
        $('output-section').style.display = 'none';
    });

    $('btn-copy-results').addEventListener('click', function() {
        const text = `Exponential Growth Report\n------------------------\nInitial: ${$('growth-n0').value}\nRate: ${$('growth-rate').value}%\nTime: ${$('growth-t').value}\nFinal: ${$('out-nt').textContent}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Results Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

});
</script>

<style>
.exponential-growth-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.exponential-growth-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.exponential-growth-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.exponential-growth-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.exponential-growth-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.exponential-growth-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

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
.output-hero-value { font-size: 3.5rem; font-weight: 900; color: #0f172a; line-height: 1; margin-bottom: 0.5rem; }
.output-hero-unit { font-size: 1rem; color: #64748b; font-weight: 500; }
</style>

