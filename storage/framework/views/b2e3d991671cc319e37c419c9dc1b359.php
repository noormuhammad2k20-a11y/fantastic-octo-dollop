<div class="row g-4 base-converter-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Input Value</label>
                        <input type="text" id="base-input" class="form-control form-control-lg rounded-3" value="255" placeholder="Enter number...">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">From Base</label>
                        <select id="base-from" class="form-select form-control-lg rounded-3">
                            <option value="2">Binary (Base 2)</option>
                            <option value="8">Octal (Base 8)</option>
                            <option value="10" selected>Decimal (Base 10)</option>
                            <option value="16">Hexadecimal (Base 16)</option>
                            <option value="custom">Custom Base...</option>
                        </select>
                        <input type="number" id="custom-from" class="form-control mt-2" placeholder="Custom base (2-36)" style="display:none">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">To Base</label>
                        <select id="base-to" class="form-select form-control-lg rounded-3">
                            <option value="2" selected>Binary (Base 2)</option>
                            <option value="8">Octal (Base 8)</option>
                            <option value="10">Decimal (Base 10)</option>
                            <option value="16">Hexadecimal (Base 16)</option>
                            <option value="custom">Custom Base...</option>
                        </select>
                        <input type="number" id="custom-to" class="form-control mt-2" placeholder="Custom base (2-36)" style="display:none">
                    </div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Convert Now
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:230;--tool-color:#4f46e5;--tool-bg:rgba(99,102,241,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Converted Result</span>
                <div class="output-hero-value fs-2" id="out-result" style="word-break: break-all;">0</div>
                <span class="output-hero-unit" id="out-summary">Base 10 to Base 2</span>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-md-3">
                    <div class="stat-card p-3 rounded-3 border bg-white">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Binary</div>
                        <div class="fw-bold text-truncate" id="out-bin">0</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card p-3 rounded-3 border bg-white">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Octal</div>
                        <div class="fw-bold text-truncate" id="out-oct">0</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card p-3 rounded-3 border bg-white">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Decimal</div>
                        <div class="fw-bold text-truncate" id="out-dec">0</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card p-3 rounded-3 border bg-white">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Hex</div>
                        <div class="fw-bold text-truncate" id="out-hex">0</div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Conversion Logic</h6>
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

    $('base-from').addEventListener('change', (e) => {
        $('custom-from').style.display = e.target.value === 'custom' ? 'block' : 'none';
    });
    $('base-to').addEventListener('change', (e) => {
        $('custom-to').style.display = e.target.value === 'custom' ? 'block' : 'none';
    });

    function calculate() {
        let input = $('base-input').value.trim();
        let fromBase = $('base-from').value === 'custom' ? parseInt($('custom-from').value) : parseInt($('base-from').value);
        let toBase = $('base-to').value === 'custom' ? parseInt($('custom-to').value) : parseInt($('base-to').value);

        if (!input || isNaN(fromBase) || isNaN(toBase)) return;

        try {
            const decVal = parseInt(input, fromBase);
            if (isNaN(decVal)) throw new Error('Invalid input for base');

            const result = decVal.toString(toBase).toUpperCase();
            
            $('out-result').textContent = result;
            $('out-summary').textContent = `Base ${fromBase} to Base ${toBase}`;

            $('out-bin').textContent = decVal.toString(2);
            $('out-oct').textContent = decVal.toString(8);
            $('out-dec').textContent = decVal.toString(10);
            $('out-hex').textContent = decVal.toString(16).toUpperCase();

            let stepsHtml = `<p><b>Process:</b></p>`;
            stepsHtml += `<ol class="ps-3">`;
            stepsHtml += `<li>Convert input <code>${input}</code> from Base ${fromBase} to Decimal (Base 10): <b>${decVal}</b></li>`;
            stepsHtml += `<li>Convert Decimal <code>${decVal}</code> to Base ${toBase}: <b>${result}</b></li>`;
            stepsHtml += `</ol>`;

            $('math-steps').innerHTML = stepsHtml;
            $('output-section').style.display = 'block';
            $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
        } catch (e) {
            alert('Error: ' + e.message);
        }
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('base-input').value = '255';
        $('output-section').style.display = 'none';
    });

    $('btn-copy-results').addEventListener('click', function() {
        navigator.clipboard.writeText($('out-result').textContent);
    });
});
</script>

<style>
.base-converter-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.base-converter-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.base-converter-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.base-converter-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.base-converter-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

.quick-actions-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; }
.btn-primary-action { background: #1e293b; color: #fff; border: none; border-radius: 14px; padding: 1rem; font-weight: 700; transition: all 0.2s; }
.btn-primary-action:hover { background: #0f172a; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.btn-secondary-action { background: #f1f5f9; color: #475569; border: none; border-radius: 14px; padding: 1rem; font-weight: 600; transition: all 0.2s; }

.output-card-themed { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; margin-top: 2rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(99,102,241,0.2); }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\number-base-converter.blade.php ENDPATH**/ ?>