<div class="row g-4 gram-schmidt-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-12">
                        <label class="form-label-custom">Vector Dimension</label>
                        <select id="vector-dim" class="form-select form-select-lg rounded-3">
                            <option value="2">2D Vectors</option>
                            <option value="3" selected>3D Vectors</option>
                            <option value="4">4D Vectors</option>
                        </select>
                    </div>
                    <div class="col-md-12 text-end d-flex align-items-end justify-content-end">
                        <button class="btn btn-outline-teal w-100 py-2 rounded-3" id="add-vector" style="min-width: 280px; max-width: 100%;"><i class="fas fa-plus me-2"></i>Add Vector</button>
                    </div>
                </div>

                <div id="vector-inputs" class="d-flex flex-column gap-3 mb-4">
                    <!-- Dynamic inputs -->
                </div>

                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="form-check form-switch p-3 bg-light rounded-3 border">
                            <input class="form-check-input ms-0 me-2" type="checkbox" id="normalize-opt" checked>
                            <label class="form-check-label fw-bold small" for="normalize-opt">Orthonormalize (Unit length)</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Precision</label>
                        <select id="precision-sel" class="form-select form-select-lg rounded-3">
                            <option value="2">2 Decimal Places</option>
                            <option value="4">4 Decimal Places</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:170;--tool-color:#0d9488;--tool-bg:rgba(20,184,166,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Resulting Basis (U)</span>
                <div class="output-hero-value fs-5" id="out-basis">Result will appear here</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2 text-primary"></i>Mathematical Process</h6>
                <div class="bg-white p-4 rounded-4 border shadow-sm small text-secondary overflow-auto" id="math-steps">
                    Steps...
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-solution" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Basis</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const container = $('vector-inputs');

    function createVectorInput(vals = []) {
        const dim = parseInt($('vector-dim').value);
        const count = container.querySelectorAll('.vector-row').length + 1;
        const row = document.createElement('div');
        row.className = 'vector-row p-3 bg-white border rounded-3 animate__animated animate__fadeIn';
        
        let inputsHtml = `<div class="d-flex gap-2 align-items-center">
            <span class="fw-bold small text-muted" style="min-width:30px">v${count}</span>`;
        for (let i = 0; i < dim; i++) {
            inputsHtml += `<input type="number" class="form-control text-center v-cell" value="${vals[i] || 0}" step="any">`;
        }
        inputsHtml += `<button class="btn btn-link text-danger remove-v"><i class="fas fa-times"></i></button></div>`;
        
        row.innerHTML = inputsHtml;
        container.appendChild(row);

        row.querySelectorAll('input').forEach(i => i.addEventListener('input', calculate));
        row.querySelector('.remove-v').addEventListener('click', () => {
            if (container.querySelectorAll('.vector-row').length > 1) {
                row.remove();
                reindex();
                calculate();
            }
        });
        calculate();
    }

    function reindex() {
        container.querySelectorAll('.vector-row').forEach((r, i) => {
            r.querySelector('.text-muted').textContent = `v${i+1}`;
        });
    }

    function dot(v1, v2) { return v1.reduce((sum, val, i) => sum + val * v2[i], 0); }
    function sub(v1, v2) { return v1.map((val, i) => val - v2[i]); }
    function scale(v, s) { return v.map(val => val * s); }
    function norm(v) { return Math.sqrt(dot(v, v)); }

    function calculate() {
        const dim = parseInt($('vector-dim').value);
        const rows = container.querySelectorAll('.vector-row');
        const vs = Array.from(rows).map(r => Array.from(r.querySelectorAll('.v-cell')).map(i => parseFloat(i.value) || 0));
        const p = parseInt($('precision-sel').value);
        const shouldNormalize = $('normalize-opt').checked;

        let us = [];
        let steps = [];

        vs.forEach((v, i) => {
            let u = [...v];
            steps.push(`<strong>Calculating u${i+1}:</strong>`);
            steps.push(`u${i+1} = v${i+1}${i > 0 ? ' - ' + Array.from({length: i}, (_, k) => `proj_{u${k+1}}(v${i+1})`).join(' - ') : ''}`);
            
            for (let j = 0; j < i; j++) {
                const projScale = dot(v, us[j]) / dot(us[j], us[j]);
                const proj = scale(us[j], projScale);
                u = sub(u, proj);
                steps.push(`&nbsp;&nbsp;proj_{u${j+1}}(v${i+1}) = (${dot(v, us[j]).toFixed(p)} / ${dot(us[j], us[j]).toFixed(p)})u${j+1} = [${proj.map(x => x.toFixed(p)).join(', ')}]`);
            }
            us.push(u);
            steps.push(`&nbsp;&nbsp;u${i+1} = [${u.map(x => x.toFixed(p)).join(', ')}]`);

            if (shouldNormalize) {
                const n = norm(u);
                if (n > 1e-9) {
                    const e = scale(u, 1/n);
                    steps.push(`&nbsp;&nbsp;Normalize: e${i+1} = u${i+1} / ||u${i+1}|| = [${e.map(x => x.toFixed(p)).join(', ')}]`);
                }
            }
            steps.push('<br>');
        });

        let finalBasis = us.map(u => {
            if (shouldNormalize) {
                const n = norm(u);
                return n > 1e-9 ? scale(u, 1/n) : u;
            }
            return u;
        });

        $('out-basis').innerHTML = finalBasis.map((b, i) => `u${i+1}: [${b.map(x => x.toFixed(p)).join(', ')}]`).join('<br>');
        $('math-steps').innerHTML = steps.join('<br>');
    }

    $('vector-dim').addEventListener('change', () => {
        container.innerHTML = '';
        createVectorInput([1, 0, 0]);
        createVectorInput([1, 1, 0]);
        createVectorInput([1, 1, 1]);
    });

    $('add-vector').addEventListener('click', () => createVectorInput());
    $('normalize-opt').addEventListener('change', calculate);
    $('precision-sel').addEventListener('change', calculate);

    $('copy-solution').addEventListener('click', function() {
        navigator.clipboard.writeText($('out-basis').innerText).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    // Init
    createVectorInput([1, 0, 0]);
    createVectorInput([1, 1, 0]);
    createVectorInput([1, 1, 1]);
});
</script>

<style>
.gram-schmidt-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.gram-schmidt-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.gram-schmidt-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.gram-schmidt-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.gram-schmidt-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.gram-schmidt-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }
.btn-outline-teal { border: 1.5px solid #ccfbf1; color: #0d9488; font-weight: 600; border-radius: 12px; transition: all 0.2s; }
.btn-outline-teal:hover { background: #14b8a6; color: #fff; border-color: #14b8a6; }
.v-cell { font-weight: bold; border-radius: 8px !important; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\gram-schmidt-calculator.blade.php ENDPATH**/ ?>