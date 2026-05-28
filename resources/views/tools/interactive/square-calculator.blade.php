<div class="row g-4 square-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Input Value</label>
                        <input type="number" id="sq-input" class="form-control form-control-lg rounded-3" value="10" step="any">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Input Type</label>
                        <select id="sq-type" class="form-select form-select-lg rounded-3">
                            <option value="side">Side Length (a)</option>
                            <option value="perimeter">Perimeter (P)</option>
                            <option value="area">Area (A)</option>
                            <option value="diagonal">Diagonal (d)</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-4 g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Calculation Precision</label>
                        <select id="precision-sel" class="form-select form-select-lg rounded-3">
                            <option value="2">2 Decimal Places</option>
                            <option value="4">4 Decimal Places</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Quick Actions</label>
                        <button class="btn btn-outline-info w-100 rounded-3" id="reset-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-redo me-2"></i>Reset Calculator</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:200;--tool-color:#0284c7;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Calculated Side Length</span>
                <div class="output-hero-value" id="out-side">10</div>
                <span class="output-hero-unit">Units</span>
            </div>

            <div class="row g-3 mt-4 text-center">
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">Area (A)</div>
                        <div class="fw-bold fs-5" id="out-area">100</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">Perimeter (P)</div>
                        <div class="fw-bold fs-5" id="out-peri">40</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">Diagonal (d)</div>
                        <div class="fw-bold fs-5" id="out-diag">14.14</div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-calculator me-2 text-primary"></i>Mathematical Steps</h6>
                <div class="bg-white p-4 rounded-4 border shadow-sm small text-secondary" id="math-steps">
                    Calculating...
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-all" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy All Results</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function calculate() {
        const val = parseFloat($('sq-input').value) || 0;
        const type = $('sq-type').value;
        const p = parseInt($('precision-sel').value);
        let a, P, A, d;
        let steps = [];

        if (val <= 0) {
            $('out-side').textContent = '0';
            $('out-area').textContent = '0';
            $('out-peri').textContent = '0';
            $('out-diag').textContent = '0';
            $('math-steps').innerHTML = 'Please enter a positive value.';
            return;
        }

        switch(type) {
            case 'side':
                a = val;
                steps.push(`Given Side (a) = ${a}`);
                break;
            case 'perimeter':
                P = val;
                a = P / 4;
                steps.push(`Given Perimeter (P) = ${P}`);
                steps.push(`Side (a) = P / 4 = ${P} / 4 = ${a}`);
                break;
            case 'area':
                A = val;
                a = Math.sqrt(A);
                steps.push(`Given Area (A) = ${A}`);
                steps.push(`Side (a) = √A = √${A} = ${a.toFixed(p)}`);
                break;
            case 'diagonal':
                d = val;
                a = d / Math.sqrt(2);
                steps.push(`Given Diagonal (d) = ${d}`);
                steps.push(`Side (a) = d / √2 = ${d} / 1.4142 = ${a.toFixed(p)}`);
                break;
        }

        P = 4 * a;
        A = a * a;
        d = a * Math.sqrt(2);

        $('out-side').textContent = a.toFixed(p);
        $('out-peri').textContent = P.toFixed(p);
        $('out-area').textContent = A.toFixed(p);
        $('out-diag').textContent = d.toFixed(p);

        steps.push(`<br><strong>Calculations:</strong>`);
        steps.push(`Perimeter (P) = 4a = 4 × ${a.toFixed(p)} = <strong>${P.toFixed(p)}</strong>`);
        steps.push(`Area (A) = a² = ${a.toFixed(p)}² = <strong>${A.toFixed(p)}</strong>`);
        steps.push(`Diagonal (d) = a√2 = ${a.toFixed(p)} × 1.4142 = <strong>${d.toFixed(p)}</strong>`);

        $('math-steps').innerHTML = steps.join('<br>');
    }

    ['sq-input','sq-type','precision-sel'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    $('reset-btn').addEventListener('click', () => {
        $('sq-input').value = 10; $('sq-type').value = 'side';
        calculate();
    });

    $('copy-all').addEventListener('click', function() {
        const text = `Square Properties\nSide: ${$('out-side').textContent}\nPerimeter: ${$('out-peri').textContent}\nArea: ${$('out-area').textContent}\nDiagonal: ${$('out-diag').textContent}`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.square-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.square-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.square-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.square-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.square-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.square-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

