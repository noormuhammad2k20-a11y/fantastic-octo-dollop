<div class="row g-4 scientific-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Decimal Number</label>
                        <input type="text" id="num-in" class="form-control form-control-lg fw-bold text-center" value="1234567.89">
                    </div>
                </div>

                <div class="row mt-4 g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Significant Figures</label>
                        <select id="sig-figs" class="form-select form-select-lg rounded-3">
                            <option value="2">2 Sig Figs</option>
                            <option value="4" selected>4 Sig Figs</option>
                            <option value="6">6 Sig Figs</option>
                        </select>
                    </div>
                    <div class="col-md-12 d-flex align-items-end">
                        <button class="btn d-block mx-auto btn-outline-pink py-3 px-5 fw-bold rounded-pill shadow-sm"" id="reset-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-undo me-2"></i>Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04);">
            <div class="row g-3 text-center">
                <div class="col-md-12">
                    <div class="p-4 bg-white rounded-4 border shadow-sm mb-3">
                        <span class="form-label-custom text-primary">Scientific Notation</span>
                        <div class="fs-4 fw-bold" id="out-sci">1.235 × 10⁶</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-4 bg-white rounded-4 border shadow-sm mb-3">
                        <span class="form-label-custom text-success">Engineering Notation</span>
                        <div class="fs-4 fw-bold" id="out-eng">1.235 × 10⁶</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-4 bg-white rounded-4 border shadow-sm">
                        <span class="form-label-custom text-info">E-Notation</span>
                        <div class="fs-4 fw-bold" id="out-e">1.235e+6</div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Rules and Formatting</h6>
                <div class="bg-white p-3 rounded-3 border small text-secondary">
                    Scientific notation uses a coefficient between 1 and 10. Engineering notation uses powers that are multiples of 3.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function calculate() {
        let val = parseFloat($('num-in').value);
        if (isNaN(val)) return;

        let sig = parseInt($('sig-figs').value);
        
        // Scientific
        let sci = val.toExponential(sig - 1);
        let [coeff, exp] = sci.split('e');
        $('out-sci').innerHTML = `${coeff} × 10<sup>${parseInt(exp)}</sup>`;
        $('out-e').textContent = sci;

        // Engineering
        let engExp = Math.floor(parseInt(exp) / 3) * 3;
        let engCoeff = val / Math.pow(10, engExp);
        $('out-eng').innerHTML = `${engCoeff.toPrecision(sig)} × 10<sup>${engExp}</sup>`;
    }

    $('num-in').addEventListener('input', calculate);
    $('sig-figs').addEventListener('change', calculate);
    calculate();
});
</script>

<style>
.scientific-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.scientific-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.scientific-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.scientific-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.scientific-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.scientific-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

