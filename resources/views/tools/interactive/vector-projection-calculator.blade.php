<div class="row g-4 projection-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="p-3 bg-light rounded-4 border">
                            <label class="form-label-custom text-primary">Vector A (Projected)</label>
                            <div class="d-flex gap-2">
                                <input type="number" id="ax" class="form-control text-center" value="1" step="any">
                                <input type="number" id="ay" class="form-control text-center" value="2" step="any">
                                <input type="number" id="az" class="form-control text-center" value="3" step="any">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="p-3 bg-light rounded-4 border">
                            <label class="form-label-custom text-success">Vector B (Base)</label>
                            <div class="d-flex gap-2">
                                <input type="number" id="bx" class="form-control text-center" value="4" step="any">
                                <input type="number" id="by" class="form-control text-center" value="0" step="any">
                                <input type="number" id="bz" class="form-control text-center" value="0" step="any">
                            </div>
                        </div>
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
                    <div class="col-md-12 text-end d-flex align-items-end">
                        <button class="btn d-block mx-auto btn-outline-success py-3 px-5 fw-bold rounded-pill shadow-sm"" id="reset-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-undo me-2"></i>Reset Vectors</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:150;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Vector Projection proj<sub>B</sub>(A)</span>
                <div class="output-hero-value fs-4" id="out-proj">[1.00, 0.00, 0.00]</div>
            </div>

            <div class="row g-3 mt-4 text-center">
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">Scalar Projection (comp<sub>B</sub>A)</div>
                        <div class="fw-bold fs-5" id="out-comp">1.00</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">Dot Product (A·B)</div>
                        <div class="fw-bold fs-5" id="out-dot">4.00</div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-scroll me-2 text-primary"></i>Mathematical Steps</h6>
                <div class="bg-white p-4 rounded-4 border shadow-sm small text-secondary" id="math-steps">
                    Steps...
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function calculate() {
        const ax = parseFloat($('ax').value) || 0, ay = parseFloat($('ay').value) || 0, az = parseFloat($('az').value) || 0;
        const bx = parseFloat($('bx').value) || 0, by = parseFloat($('by').value) || 0, bz = parseFloat($('bz').value) || 0;
        const p = parseInt($('precision-sel').value);

        const dotAB = ax*bx + ay*by + az*bz;
        const magB2 = bx*bx + by*by + bz*bz;
        const magB = Math.sqrt(magB2);

        if (magB2 === 0) {
            $('out-proj').textContent = "Undefined (B is zero vector)";
            return;
        }

        const scalar = dotAB / magB;
        const vecScale = dotAB / magB2;
        const proj = [bx * vecScale, by * vecScale, bz * vecScale];

        $('out-proj').textContent = `[${proj.map(x => x.toFixed(p)).join(', ')}]`;
        $('out-comp').textContent = scalar.toFixed(p);
        $('out-dot').textContent = dotAB.toFixed(p);

        let steps = [];
        steps.push(`<strong>1. Dot Product (A · B):</strong>`);
        steps.push(`(${ax}×${bx}) + (${ay}×${by}) + (${az}×${bz}) = ${dotAB.toFixed(p)}`);
        
        steps.push(`<br><strong>2. Magnitude Squared of B (|B|²):</strong>`);
        steps.push(`${bx}² + ${by}² + ${bz}² = ${magB2.toFixed(p)}`);

        steps.push(`<br><strong>3. Vector Projection Formula:</strong>`);
        steps.push(`proj<sub>B</sub>(A) = ((A · B) / |B|²) B`);
        steps.push(`proj<sub>B</sub>(A) = (${dotAB.toFixed(p)} / ${magB2.toFixed(p)}) [${bx}, ${by}, ${bz}]`);
        steps.push(`proj<sub>B</sub>(A) = ${vecScale.toFixed(p)} [${bx}, ${by}, ${bz}] = <strong>[${proj.map(x => x.toFixed(p)).join(', ')}]</strong>`);

        $('math-steps').innerHTML = steps.join('<br>');
    }

    ['ax','ay','az','bx','by','bz','precision-sel'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    calculate();
});
</script>

<style>
.projection-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.projection-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.projection-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.projection-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.projection-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.projection-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

