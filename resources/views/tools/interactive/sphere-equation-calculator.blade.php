<div class="row g-4 sphere-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Center Coordinates (h, k, l)</label>
                        <div class="input-group">
                            <span class="input-group-text">h</span>
                            <input type="number" id="sphere-h" class="form-control form-control-lg" value="0" step="any">
                            <span class="input-group-text">k</span>
                            <input type="number" id="sphere-k" class="form-control form-control-lg" value="0" step="any">
                            <span class="input-group-text">l</span>
                            <input type="number" id="sphere-l" class="form-control form-control-lg" value="0" step="any">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Sphere Radius (r)</label>
                        <div class="input-group">
                            <input type="number" id="sphere-r" class="form-control form-control-lg" value="5" min="0" step="any">
                            <span class="input-group-text bg-light"><i class="fas fa-ruler-combined"></i></span>
                        </div>
                    </div>
                </div>

                <div class="row mt-4 g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Calculation Precision</label>
                        <select id="precision-sel" class="form-select form-select-lg rounded-3">
                            <option value="2">2 Decimal Places</option>
                            <option value="4">4 Decimal Places</option>
                            <option value="8">8 Decimal Places</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Quick Actions</label>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-danger w-100 rounded-3" id="reset-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-sync-alt me-2"></i>Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:350;--tool-color:#e11d48;--tool-bg:rgba(244,63,94,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Standard Form Equation</span>
                <div class="output-hero-value fs-3" id="out-eqn">(x - 0)² + (y - 0)² + (z - 0)² = 25</div>
            </div>

            <div class="row g-3 mt-4 text-center">
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">Volume (V)</div>
                        <div class="fw-bold fs-5 text-primary" id="out-vol">523.60</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">Surface Area (A)</div>
                        <div class="fw-bold fs-5 text-success" id="out-sa">314.16</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">Radius Squared (r²)</div>
                        <div class="fw-bold fs-5 text-warning" id="out-r2">25</div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-scroll me-2 text-primary"></i>Step-by-Step Derivation</h6>
                <div class="bg-white p-4 rounded-4 border shadow-sm small text-secondary" id="math-steps">
                    Calculating...
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-eqn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Equation</button>
                </div>
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="download-result" style="min-width: 280px; max-width: 100%;"><i class="fas fa-file-pdf me-2"></i>Download Result</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function calculate() {
        const h = parseFloat($('sphere-h').value) || 0;
        const k = parseFloat($('sphere-k').value) || 0;
        const l = parseFloat($('sphere-l').value) || 0;
        const r = parseFloat($('sphere-r').value) || 0;
        const p = parseInt($('precision-sel').value);

        const r2 = r * r;
        const vol = (4/3) * Math.PI * Math.pow(r, 3);
        const sa = 4 * Math.PI * r2;

        const hSign = h >= 0 ? '-' : '+';
        const kSign = k >= 0 ? '-' : '+';
        const lSign = l >= 0 ? '-' : '+';
        
        const hVal = Math.abs(h);
        const kVal = Math.abs(k);
        const lVal = Math.abs(l);

        const eqn = `(x ${hSign} ${hVal})² + (y ${kSign} ${kVal})² + (z ${lSign} ${lVal})² = ${r2.toFixed(p)}`;
        $('out-eqn').textContent = eqn.replace(' - 0', '').replace(' + 0', '');
        $('out-vol').textContent = vol.toFixed(p);
        $('out-sa').textContent = sa.toFixed(p);
        $('out-r2').textContent = r2.toFixed(p);

        let steps = [];
        steps.push(`<strong>1. Identify Center (C) and Radius (r):</strong>`);
        steps.push(`Center (h, k, l) = (${h}, ${k}, ${l})`);
        steps.push(`Radius (r) = ${r}`);

        steps.push(`<br><strong>2. Standard Form Formula:</strong>`);
        steps.push(`(x - h)² + (y - k)² + (z - l)² = r²`);

        steps.push(`<br><strong>3. Substitute Values:</strong>`);
        steps.push(`(x - (${h}))² + (y - (${k}))² + (z - (${l}))² = (${r})²`);
        steps.push(`<strong>${eqn}</strong>`);

        steps.push(`<br><strong>4. Calculate Properties:</strong>`);
        steps.push(`Volume = (4/3)πr³ = (4/3) × π × ${r}³ = <strong>${vol.toFixed(p)}</strong>`);
        steps.push(`Surface Area = 4πr² = 4 × π × ${r}² = <strong>${sa.toFixed(p)}</strong>`);

        $('math-steps').innerHTML = steps.join('<br>');
    }

    ['sphere-h','sphere-k','sphere-l','sphere-r','precision-sel'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    $('reset-btn').addEventListener('click', () => {
        $('sphere-h').value = 0; $('sphere-k').value = 0; $('sphere-l').value = 0; $('sphere-r').value = 5;
        calculate();
    });

    $('copy-eqn').addEventListener('click', function() {
        navigator.clipboard.writeText($('out-eqn').textContent).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.sphere-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.sphere-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.sphere-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.sphere-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.sphere-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.sphere-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

