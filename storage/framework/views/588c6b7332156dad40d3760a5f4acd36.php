<div class="row g-4 log2-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Input Value (x)</label>
                        <input type="number" id="log-in" class="form-control form-control-lg rounded-3 border-success" value="64" step="any">
                    </div>
                </div>

                <div class="row mt-4 g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Precision</label>
                        <select id="precision-sel" class="form-select form-select-lg rounded-3">
                            <option value="4">4 Decimals</option>
                            <option value="8">8 Decimals</option>
                        </select>
                    </div>
                    <div class="col-md-12 d-flex align-items-end">
                        <button class="btn d-block mx-auto btn-outline-success py-3 px-5 fw-bold rounded-pill shadow-sm"" id="reset-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-sync me-2"></i>Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:150;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="row g-4">
                <div class="col-md-12">
                    <div class="output-hero mb-3">
                        <span class="output-hero-label">Binary Log: log<sub>2</sub>(x)</span>
                        <div class="output-hero-value" id="out-log">6.0000</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="output-hero">
                        <span class="output-hero-label">Power of 2: 2<sup>x</sup></span>
                        <div class="output-hero-value fs-4" id="out-antilog">1.84e+19</div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-microchip me-2 text-primary"></i>CS Significance</h6>
                <div class="bg-white p-3 rounded-3 border small text-secondary">
                    Binary logs help determine the number of bits required to represent values or the levels in balanced binary trees.
                    <div class="mt-2 fw-bold text-dark">log<sub>2</sub>(x) = ln(x) / ln(2)</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function calculate() {
        const x = parseFloat($('log-in').value);
        const p = parseInt($('precision-sel').value);

        if (x <= 0) {
            $('out-log').textContent = "NaN";
        } else {
            $('out-log').textContent = Math.log2(x).toFixed(p);
        }

        const antilog = Math.pow(2, x);
        $('out-antilog').textContent = antilog > 1e9 ? antilog.toExponential(4) : antilog.toFixed(p);
    }

    $('log-in').addEventListener('input', calculate);
    $('precision-sel').addEventListener('change', calculate);
    $('reset-btn').addEventListener('click', () => { $('log-in').value = 64; calculate(); });

    calculate();
});
</script>

<style>
.log2-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.log2-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.log2-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.log2-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.log2-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.log2-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\log-base-2-calculator.blade.php ENDPATH**/ ?>