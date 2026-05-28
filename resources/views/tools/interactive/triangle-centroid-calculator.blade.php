<div class="row g-4 centroid-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom text-primary">Vertex A (x₁, y₁)</label>
                        <div class="input-group">
                            <input type="number" id="x1" class="form-control form-control-lg" value="0" step="any">
                            <input type="number" id="y1" class="form-control form-control-lg" value="0" step="any">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom text-success">Vertex B (x₂, y₂)</label>
                        <div class="input-group">
                            <input type="number" id="x2" class="form-control form-control-lg" value="6" step="any">
                            <input type="number" id="y2" class="form-control form-control-lg" value="0" step="any">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom text-info">Vertex C (x₃, y₃)</label>
                        <div class="input-group">
                            <input type="number" id="x3" class="form-control form-control-lg" value="3" step="any">
                            <input type="number" id="y3" class="form-control form-control-lg" value="6" step="any">
                        </div>
                    </div>
                </div>

                <div class="row mt-4 g-3 align-items-end">
                    <div class="col-md-12">
                        <label class="form-label-custom">Precision</label>
                        <select id="precision-sel" class="form-select form-select-lg rounded-3">
                            <option value="2">2 Decimal Places</option>
                            <option value="4">4 Decimal Places</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-outline-warning py-3 px-5 fw-bold rounded-pill shadow-sm" id="reset-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-undo me-2"></i>Reset Coordinates</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:40;--tool-color:#d97706;--tool-bg:rgba(245,158,11,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Centroid Coordinates (G)</span>
                <div class="output-hero-value" id="out-centroid">(3.00, 2.00)</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-check me-2 text-primary"></i>Mathematical Breakdown</h6>
                <div class="bg-white p-4 rounded-4 border shadow-sm small text-secondary">
                    <div id="math-steps">Calculating...</div>
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-centroid" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Centroid Point</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function calculate() {
        const x1 = parseFloat($('x1').value) || 0;
        const y1 = parseFloat($('y1').value) || 0;
        const x2 = parseFloat($('x2').value) || 0;
        const y2 = parseFloat($('y2').value) || 0;
        const x3 = parseFloat($('x3').value) || 0;
        const y3 = parseFloat($('y3').value) || 0;
        const p = parseInt($('precision-sel').value);

        const Gx = (x1 + x2 + x3) / 3;
        const Gy = (y1 + y2 + y3) / 3;

        $('out-centroid').textContent = `(${Gx.toFixed(p)}, ${Gy.toFixed(p)})`;

        let steps = [];
        steps.push(`<strong>1. Centroid Formula:</strong>`);
        steps.push(`Gx = (x₁ + x₂ + x₃) / 3`);
        steps.push(`Gy = (y₁ + y₂ + y₃) / 3`);

        steps.push(`<br><strong>2. Substitute X coordinates:</strong>`);
        steps.push(`Gx = (${x1} + ${x2} + ${x3}) / 3 = ${x1+x2+x3} / 3 = <strong>${Gx.toFixed(p)}</strong>`);

        steps.push(`<br><strong>3. Substitute Y coordinates:</strong>`);
        steps.push(`Gy = (${y1} + ${y2} + ${y3}) / 3 = ${y1+y2+y3} / 3 = <strong>${Gy.toFixed(p)}</strong>`);

        steps.push(`<br><strong>Final Centroid Point (G):</strong> (${Gx.toFixed(p)}, ${Gy.toFixed(p)})`);

        $('math-steps').innerHTML = steps.join('<br>');
    }

    ['x1','y1','x2','y2','x3','y3','precision-sel'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    $('reset-btn').addEventListener('click', () => {
        $('x1').value = 0; $('y1').value = 0;
        $('x2').value = 6; $('y2').value = 0;
        $('x3').value = 3; $('y3').value = 6;
        calculate();
    });

    $('copy-centroid').addEventListener('click', function() {
        navigator.clipboard.writeText($('out-centroid').textContent).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.centroid-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.centroid-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.centroid-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.centroid-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.centroid-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.centroid-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

