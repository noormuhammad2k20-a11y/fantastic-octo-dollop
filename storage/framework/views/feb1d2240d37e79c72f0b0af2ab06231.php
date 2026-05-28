<div class="row g-4 orthocenter-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Vertex A (x₁, y₁)</label>
                        <div class="input-group">
                            <input type="number" id="x1" class="form-control form-control-lg" value="0" step="any">
                            <input type="number" id="y1" class="form-control form-control-lg" value="0" step="any">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Vertex B (x₂, y₂)</label>
                        <div class="input-group">
                            <input type="number" id="x2" class="form-control form-control-lg" value="8" step="any">
                            <input type="number" id="y2" class="form-control form-control-lg" value="0" step="any">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Vertex C (x₃, y₃)</label>
                        <div class="input-group">
                            <input type="number" id="x3" class="form-control form-control-lg" value="2" step="any">
                            <input type="number" id="y3" class="form-control form-control-lg" value="6" step="any">
                        </div>
                    </div>
                </div>

                <div class="row mt-4 g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Precision</label>
                        <select id="precision-sel" class="form-select form-select-lg rounded-3">
                            <option value="2">2 Decimal Places</option>
                            <option value="4">4 Decimal Places</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Actions</label>
                        <button class="btn btn-outline-primary w-100 rounded-3" id="reset-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-undo me-2"></i>Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04);">
            <div class="output-hero text-center">
                <span class="output-hero-label">Orthocenter (H)</span>
                <div class="output-hero-value" id="out-ortho">(2.00, 2.00)</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-project-diagram me-2 text-primary"></i>Step-by-Step Altitude Derivation</h6>
                <div class="bg-white p-4 rounded-4 border shadow-sm small text-secondary" id="math-steps">
                    Calculating...
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-ortho" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Orthocenter Point</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function calculate() {
        const x1 = parseFloat($('x1').value) || 0, y1 = parseFloat($('y1').value) || 0;
        const x2 = parseFloat($('x2').value) || 0, y2 = parseFloat($('y2').value) || 0;
        const x3 = parseFloat($('x3').value) || 0, y3 = parseFloat($('y3').value) || 0;
        const p = parseInt($('precision-sel').value);

        let steps = [];

        // Slopes of sides
        const mAB = (x2 - x1) === 0 ? Infinity : (y2 - y1) / (x2 - x1);
        const mBC = (x3 - x2) === 0 ? Infinity : (y3 - y2) / (x3 - x2);
        const mAC = (x3 - x1) === 0 ? Infinity : (y3 - y1) / (x3 - x1);

        steps.push(`<strong>1. Slopes of triangle sides:</strong>`);
        steps.push(`m(AB) = ${mAB === Infinity ? 'Undefined' : mAB.toFixed(p)}`);
        steps.push(`m(BC) = ${mBC === Infinity ? 'Undefined' : mBC.toFixed(p)}`);

        // Slopes of altitudes (negative reciprocals)
        const hC = mAB === 0 ? Infinity : (mAB === Infinity ? 0 : -1 / mAB);
        const hA = mBC === 0 ? Infinity : (mBC === Infinity ? 0 : -1 / mBC);

        steps.push(`<br><strong>2. Slopes of altitudes:</strong>`);
        steps.push(`m(altitude through C) = ${hC === Infinity ? 'Undefined' : hC.toFixed(p)}`);
        steps.push(`m(altitude through A) = ${hA === Infinity ? 'Undefined' : hA.toFixed(p)}`);

        // Equations of altitudes: y - y0 = m(x - x0)
        // Alt 1 through C(x3, y3): y = hC(x - x3) + y3
        // Alt 2 through A(x1, y1): y = hA(x - x1) + y1

        let Hx, Hy;

        if (hC === Infinity) {
            Hx = x3;
            Hy = hA * (Hx - x1) + y1;
        } else if (hA === Infinity) {
            Hx = x1;
            Hy = hC * (Hx - x3) + y3;
        } else {
            // Solve: hC(x - x3) + y3 = hA(x - x1) + y1
            // hCx - hCx3 + y3 = hAx - hAx1 + y1
            // (hC - hA)x = hCx3 - y3 - hAx1 + y1
            Hx = (hC * x3 - y3 - hA * x1 + y1) / (hC - hA);
            Hy = hC * (Hx - x3) + y3;
        }

        steps.push(`<br><strong>3. Intersection of Altitudes:</strong>`);
        steps.push(`Alt 1: y = ${hC === Infinity ? 'x = ' + x3 : hC.toFixed(p) + '(x - ' + x3 + ') + ' + y3}`);
        steps.push(`Alt 2: y = ${hA === Infinity ? 'x = ' + x1 : hA.toFixed(p) + '(x - ' + x1 + ') + ' + y1}`);
        
        if (isNaN(Hx) || isNaN(Hy) || !isFinite(Hx) || !isFinite(Hy)) {
             $('out-ortho').textContent = "Collinear Points";
             $('math-steps').innerHTML = "The points are collinear and do not form a triangle.";
             return;
        }

        $('out-ortho').textContent = `(${Hx.toFixed(p)}, ${Hy.toFixed(p)})`;
        steps.push(`<br><strong>Final Orthocenter (H):</strong> (${Hx.toFixed(p)}, ${Hy.toFixed(p)})`);

        $('math-steps').innerHTML = steps.join('<br>');
    }

    ['x1','y1','x2','y2','x3','y3','precision-sel'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    $('reset-btn').addEventListener('click', () => {
        $('x1').value = 0; $('y1').value = 0;
        $('x2').value = 8; $('y2').value = 0;
        $('x3').value = 2; $('y3').value = 6;
        calculate();
    });

    $('copy-ortho').addEventListener('click', function() {
        navigator.clipboard.writeText($('out-ortho').textContent).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.orthocenter-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.orthocenter-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.orthocenter-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.orthocenter-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.orthocenter-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.orthocenter-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\triangle-orthocenter-calculator.blade.php ENDPATH**/ ?>