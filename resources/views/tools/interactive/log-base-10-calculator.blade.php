<div class="row g-4 log-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Input Value (x)</label>
                        <input type="number" id="log-in" class="form-control form-control-lg rounded-3" value="100" step="any">
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
                        <button class="btn d-block mx-auto btn-outline-warning py-3 px-5 fw-bold rounded-pill shadow-sm"" id="reset-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-redo me-2"></i>Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:35;--tool-color:#d97706;--tool-bg:rgba(245,158,11,.04);">
            <div class="row g-4">
                <div class="col-md-12">
                    <div class="output-hero mb-3">
                        <span class="output-hero-label">Common Log: log<sub>10</sub>(x)</span>
                        <div class="output-hero-value" id="out-log">2.0000</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="output-hero">
                        <span class="output-hero-label">Antilog: 10<sup>x</sup></span>
                        <div class="output-hero-value fs-4" id="out-antilog">1e+100</div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Logarithmic Rules</h6>
                <div class="bg-white p-3 rounded-3 border small text-secondary">
                    <ul class="mb-0">
                        <li>log<sub>10</sub>(10) = 1</li>
                        <li>log<sub>10</sub>(1) = 0</li>
                        <li>log<sub>10</sub>(x × y) = log<sub>10</sub>x + log<sub>10</sub>y</li>
                        <li>log<sub>10</sub>(x / y) = log<sub>10</sub>x - log<sub>10</sub>y</li>
                    </ul>
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
            $('out-log').textContent = "Undefined (x > 0 required)";
        } else {
            $('out-log').textContent = Math.log10(x).toFixed(p);
        }

        const antilog = Math.pow(10, x);
        $('out-antilog').textContent = antilog > 1e6 ? antilog.toExponential(4) : antilog.toFixed(p);
    }

    $('log-in').addEventListener('input', calculate);
    $('precision-sel').addEventListener('change', calculate);
    $('reset-btn').addEventListener('click', () => { $('log-in').value = 100; calculate(); });

    calculate();
});
</script>

<style>
.log-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.log-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.log-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.log-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.log-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.log-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

