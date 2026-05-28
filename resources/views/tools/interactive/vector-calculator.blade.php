<div class="row g-4 vector-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-12">
                        <label class="form-label-custom">Vector Dimension</label>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-info active flex-grow-1" data-dim="2">2D Vectors</button>
                            <button class="btn btn-outline-info flex-grow-1" data-dim="3">3D Vectors</button>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="p-3 bg-light rounded-4 border">
                            <label class="form-label-custom text-primary">Vector A</label>
                            <div class="d-flex gap-2">
                                <input type="number" id="ax" class="form-control text-center" value="3" step="any">
                                <input type="number" id="ay" class="form-control text-center" value="4" step="any">
                                <input type="number" id="az" class="form-control text-center d-none" value="0" step="any">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="p-3 bg-light rounded-4 border">
                            <label class="form-label-custom text-success">Vector B</label>
                            <div class="d-flex gap-2">
                                <input type="number" id="bx" class="form-control text-center" value="1" step="any">
                                <input type="number" id="by" class="form-control text-center" value="2" step="any">
                                <input type="number" id="bz" class="form-control text-center d-none" value="0" step="any">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4 g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Operation</label>
                        <select id="op-sel" class="form-select form-select-lg rounded-3 border-info fw-bold">
                            <option value="add">Addition (A + B)</option>
                            <option value="sub">Subtraction (A - B)</option>
                            <option value="dot">Dot Product (A · B)</option>
                            <option value="cross">Cross Product (A × B)</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Precision</label>
                        <select id="precision-sel" class="form-select form-select-lg rounded-3">
                            <option value="2">2 Decimals</option>
                            <option value="4">4 Decimals</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:200;--tool-color:#0284c7;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Resultant Vector / Value</span>
                <div class="output-hero-value" id="out-result">[4, 6]</div>
            </div>

            <div class="row g-3 mt-4 text-center">
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">Magnitude |A|</div>
                        <div class="fw-bold fs-5" id="out-mag-a">5.00</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">Magnitude |B|</div>
                        <div class="fw-bold fs-5" id="out-mag-b">2.24</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">Angle (θ)</div>
                        <div class="fw-bold fs-5 text-primary" id="out-angle">10.3°</div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2 text-primary"></i>Solution Steps</h6>
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
    let dim = 2;

    function calculate() {
        const ax = parseFloat($('ax').value) || 0, ay = parseFloat($('ay').value) || 0, az = parseFloat($('az').value) || 0;
        const bx = parseFloat($('bx').value) || 0, by = parseFloat($('by').value) || 0, bz = parseFloat($('bz').value) || 0;
        const op = $('op-sel').value;
        const p = parseInt($('precision-sel').value);

        const A = [ax, ay, az];
        const B = [bx, by, bz];

        const magA = Math.sqrt(ax*ax + ay*ay + (dim === 3 ? az*az : 0));
        const magB = Math.sqrt(bx*bx + by*by + (dim === 3 ? bz*bz : 0));
        const dot = ax*bx + ay*by + (dim === 3 ? az*bz : 0);
        const angle = Math.acos(Math.min(1, Math.max(-1, dot / (magA * magB)))) * (180 / Math.PI);

        $('out-mag-a').textContent = magA.toFixed(p);
        $('out-mag-b').textContent = magB.toFixed(p);
        $('out-angle').textContent = isNaN(angle) ? '0°' : angle.toFixed(1) + '°';

        let res = '', steps = [];

        if (op === 'add') {
            const r = [ax+bx, ay+by, az+bz];
            res = dim === 3 ? `[${r[0].toFixed(p)}, ${r[1].toFixed(p)}, ${r[2].toFixed(p)}]` : `[${r[0].toFixed(p)}, ${r[1].toFixed(p)}]`;
            steps.push(`Addition: A + B = [ax+bx, ay+by, az+bz]`);
        } else if (op === 'sub') {
            const r = [ax-bx, ay-by, az-bz];
            res = dim === 3 ? `[${r[0].toFixed(p)}, ${r[1].toFixed(p)}, ${r[2].toFixed(p)}]` : `[${r[0].toFixed(p)}, ${r[1].toFixed(p)}]`;
        } else if (op === 'dot') {
            res = dot.toFixed(p);
            steps.push(`Dot Product: A · B = ax*bx + ay*by + az*bz`);
        } else if (op === 'cross') {
            if (dim === 2) {
                res = (ax*by - ay*bx).toFixed(p);
                steps.push(`2D Cross Product (Scalar): ax*by - ay*bx`);
            } else {
                const cx = ay*bz - az*by;
                const cy = az*bx - ax*bz;
                const cz = ax*by - ay*bx;
                res = `[${cx.toFixed(p)}, ${cy.toFixed(p)}, ${cz.toFixed(p)}]`;
                steps.push(`3D Cross Product: [ay*bz - az*by, az*bx - ax*bz, ax*by - ay*bx]`);
            }
        }

        $('out-result').textContent = res;
        $('math-steps').innerHTML = steps.join('<br>');
    }

    document.querySelectorAll('[data-dim]').forEach(btn => {
        btn.addEventListener('click', () => {
            dim = parseInt(btn.dataset.dim);
            document.querySelectorAll('[data-dim]').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            if (dim === 2) {
                $('az').classList.add('d-none'); $('bz').classList.add('d-none');
            } else {
                $('az').classList.remove('d-none'); $('bz').classList.remove('d-none');
            }
            calculate();
        });
    });

    ['ax','ay','az','bx','by','bz','op-sel','precision-sel'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    calculate();
});
</script>

<style>
.vector-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.vector-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.vector-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.vector-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.vector-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.vector-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }
.btn-outline-info { border: 1.5px solid #e0f2fe; color: #0284c7; font-weight: 600; border-radius: 12px; transition: all 0.2s; }
.btn-outline-info:hover, .btn-outline-info.active { background: #0ea5e9; color: #fff; border-color: #0ea5e9; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>
