<div class="row g-4 ln-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Input Value (x)</label>
                        <input type="number" id="log-in" class="form-control form-control-lg rounded-3 border-pink" value="10" step="any">
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
                        <button class="btn d-block mx-auto btn-outline-pink py-3 px-5 fw-bold rounded-pill shadow-sm"" id="reset-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-leaf me-2"></i>Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04);">
            <div class="row g-4">
                <div class="col-md-12">
                    <div class="output-hero mb-3">
                        <span class="output-hero-label">Natural Log: ln(x)</span>
                        <div class="output-hero-value" id="out-log">2.3026</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="output-hero">
                        <span class="output-hero-label">Exponential: e<sup>x</sup></span>
                        <div class="output-hero-value fs-4" id="out-antilog">22026.46</div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Euler's Number (e)</h6>
                <div class="bg-white p-3 rounded-3 border small text-secondary">
                    e is a mathematical constant approximately equal to <strong>2.718281828</strong>.
                    It is the base of the natural logarithm.
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
            $('out-log').textContent = Math.log(x).toFixed(p);
        }

        const antilog = Math.exp(x);
        $('out-antilog').textContent = antilog > 1e9 ? antilog.toExponential(4) : antilog.toFixed(p);
    }

    $('log-in').addEventListener('input', calculate);
    $('precision-sel').addEventListener('change', calculate);
    $('reset-btn').addEventListener('click', () => { $('log-in').value = 10; calculate(); });

    calculate();
});
</script>

<style>
.ln-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.ln-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.ln-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.ln-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.ln-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.ln-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }
.btn-outline-pink { border: 1.5px solid #fce7f3; color: #db2777; font-weight: 600; border-radius: 12px; transition: all 0.2s; }
.btn-outline-pink:hover { background: #ec4899; color: #fff; border-color: #ec4899; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

