<div class="row g-4 standard-deviation-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Enter Data Points</label>
                    <textarea id="sd-data" class="form-control form-control-lg rounded-3" rows="3" placeholder="e.g., 10, 12, 23, 23, 16, 23, 21, 16">10, 12, 23, 23, 16, 23, 21, 16</textarea>
                    <div class="form-text mt-2">Enter numbers separated by commas, spaces, or newlines.</div>
                </div>

                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Calculation Type</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-custom active flex-grow-1" data-type="sample">Sample (n-1)</button>
                            <button type="button" class="btn btn-outline-custom flex-grow-1" data-type="population">Population (N)</button>
                        </div>
                    </div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Compute Stats
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
                <span class="output-hero-label">Standard Deviation (σ or s)</span>
                <div class="output-hero-value" id="out-sd">0.00</div>
                <span class="output-hero-unit" id="out-summary">Sample Stats</span>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-md-4">
                    <div class="stat-card p-3 rounded-3 border bg-white text-center">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Mean (μ)</div>
                        <div class="fs-4 fw-bold text-primary" id="out-mean">0</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-3 rounded-3 border bg-white text-center">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Variance</div>
                        <div class="fs-4 fw-bold text-primary" id="out-variance">0</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-3 rounded-3 border bg-white text-center">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Sum of Squares</div>
                        <div class="fs-4 fw-bold text-primary" id="out-ss">0</div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Mathematical Breakdown</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Summary
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let calcType = 'sample';

    document.querySelectorAll('[data-type]').forEach(btn => {
        btn.addEventListener('click', () => {
            calcType = btn.dataset.type;
            document.querySelectorAll('[data-type]').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    function calculate() {
        const input = $('sd-data').value;
        const data = input.split(/[\s,]+/).map(n => parseFloat(n)).filter(n => !isNaN(n));
        
        if (data.length < 2) {
            alert('Please enter at least 2 data points.');
            return;
        }

        const n = data.length;
        const mean = data.reduce((a, b) => a + b) / n;
        const ss = data.reduce((a, b) => a + Math.pow(b - mean, 2), 0);
        const variance = (calcType === 'sample') ? ss / (n - 1) : ss / n;
        const sd = Math.sqrt(variance);

        $('out-sd').textContent = sd.toFixed(4);
        $('out-mean').textContent = mean.toFixed(4);
        $('out-variance').textContent = variance.toFixed(4);
        $('out-ss').textContent = ss.toFixed(4);
        $('out-summary').textContent = `${calcType.charAt(0).toUpperCase() + calcType.slice(1)} Stats (n=${n})`;

        let stepsHtml = `<p><b>Statistical Measures:</b></p>`;
        stepsHtml += `<ul class="ps-3">`;
        stepsHtml += `<li class="mb-2"><b>Mean (Average):</b> $\\mu = \\frac{\\sum x_i}{n} = ${mean.toFixed(4)}$</li>`;
        stepsHtml += `<li class="mb-2"><b>Sum of Squares (SS):</b> $\\sum (x_i - \\mu)^2 = ${ss.toFixed(4)}$</li>`;
        if (calcType === 'sample') {
            stepsHtml += `<li class="mb-2"><b>Sample Variance:</b> $s^2 = \\frac{SS}{n-1} = \\frac{${ss.toFixed(4)}}{${n-1}} = ${variance.toFixed(4)}$</li>`;
        } else {
            stepsHtml += `<li class="mb-2"><b>Population Variance:</b> $\\sigma^2 = \\frac{SS}{N} = \\frac{${ss.toFixed(4)}}{${n}} = ${variance.toFixed(4)}$</li>`;
        }
        stepsHtml += `</ul>`;

        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('math-steps')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('sd-data').value = '10, 12, 23, 23, 16, 23, 21, 16';
        $('output-section').style.display = 'none';
    });

    $('btn-copy-results').addEventListener('click', function() {
        const text = `Stats Report\nMean: ${$('out-mean').textContent}\nStd Dev: ${$('out-sd').textContent}\nVariance: ${$('out-variance').textContent}`;
        navigator.clipboard.writeText(text);
    });
});
</script>

<style>
.standard-deviation-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.standard-deviation-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.standard-deviation-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.standard-deviation-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.standard-deviation-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

.btn-outline-custom { border: 1.5px solid #e2e8f0; color: #64748b; font-weight: 600; border-radius: 14px; padding: 0.8rem 1rem; transition: all 0.2s; background: white; }
.btn-outline-custom.active { background: #10b981; color: #fff; border-color: #10b981; box-shadow: 0 4px 15px rgba(16,185,129,0.2); }

.quick-actions-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; }
.btn-primary-action { background: #1e293b; color: #fff; border: none; border-radius: 14px; padding: 1rem; font-weight: 700; transition: all 0.2s; }
.btn-primary-action:hover { background: #0f172a; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.btn-secondary-action { background: #f1f5f9; color: #475569; border: none; border-radius: 14px; padding: 1rem; font-weight: 600; transition: all 0.2s; }

.output-card-themed { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; margin-top: 2rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(16,185,129,0.2); }
</style>

