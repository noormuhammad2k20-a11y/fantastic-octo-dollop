<div class="row g-4 math-suite-modernized">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border bg-light">
                            <label class="form-label-custom">First Number (z₁)</label>
                            <div class="row g-2">
                                <div class="col-6"><input type="number" id="z1-real" class="form-control" placeholder="Real" value="3"></div>
                                <div class="col-6"><input type="number" id="z1-imag" class="form-control" placeholder="Imaginary" value="4"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-center justify-content-center">
                        <select id="input-op" class="form-select form-select-lg text-center fw-bold border-2" style="border-color:#10b981">
                            <option value="add">+</option>
                            <option value="sub">−</option>
                            <option value="mul">×</option>
                            <option value="div">÷</option>
                            <option value="pow">z₁ ^ n</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border bg-light" id="z2-container">
                            <label class="form-label-custom" id="z2-label">Second Number (z₂)</label>
                            <div class="row g-2" id="z2-inputs">
                                <div class="col-6"><input type="number" id="z2-real" class="form-control" placeholder="Real" value="1"></div>
                                <div class="col-6"><input type="number" id="z2-imag" class="form-control" placeholder="Imaginary" value="2"></div>
                            </div>
                            <div class="row g-2 d-none" id="pow-input">
                                <div class="col-12"><input type="number" id="input-n" class="form-control" placeholder="Exponent (n)" value="2"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#10b981;box-shadow:0 4px 12px rgba(16,185,129,0.2)">
                            <i class="fas fa-play me-2"></i>Execute Operation
                        </button>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-load-example" style="min-width: 280px; max-width: 100%;">Load Example (3+4i / 1+2i)</button>
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-reset" style="min-width: 280px; max-width: 100%;">Reset All</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:150;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Result (Cartesian Form)</span>
                <div class="output-hero-value" id="res-cartesian">2.2 + 0.4i</div>
                <span class="output-hero-unit" id="res-polar">r = 2.236, θ = 10.3°</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Magnitude (r)</span>
                        <span class="value" id="res-mag">2.236</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Phase (θ)</span>
                        <span class="value" id="res-phase">10.3°</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Conjugate (z*)</span>
                        <span class="value" id="res-conj">2.2 - 0.4i</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-success"></i>Operational Breakdown</h6>
                <div class="table-responsive rounded-3 border bg-white">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr><th>Step</th><th>Description</th><th class="text-end">Value</th></tr>
                        </thead>
                        <tbody id="steps-table"></tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Complex Result
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const opSelect = $('input-op');
    const z2Inputs = $('z2-inputs');
    const powInput = $('pow-input');
    const z2Label = $('z2-label');

    opSelect.addEventListener('change', () => {
        if(opSelect.value === 'pow') {
            z2Inputs.classList.add('d-none');
            powInput.classList.remove('d-none');
            z2Label.textContent = "Power (n)";
        } else {
            z2Inputs.classList.remove('d-none');
            powInput.classList.add('d-none');
            z2Label.textContent = "Second Number (z₂)";
        }
    });

    function calculate() {
        const r1 = parseFloat($('z1-real').value) || 0;
        const i1 = parseFloat($('z1-imag').value) || 0;
        const op = opSelect.value;
        
        const z1 = math.complex(r1, i1);
        let result, steps = [];

        if (op === 'pow') {
            const n = parseFloat($('input-n').value) || 1;
            result = math.pow(z1, n);
            steps.push({ s: "1", d: "Initialize Exponentiation", v: `z₁^${n}` });
            steps.push({ s: "2", d: "De Moivre Application", v: "r^n(cos nθ + i sin nθ)" });
        } else {
            const r2 = parseFloat($('z2-real').value) || 0;
            const i2 = parseFloat($('z2-imag').value) || 0;
            const z2 = math.complex(r2, i2);

            if (op === 'add') result = math.add(z1, z2);
            else if (op === 'sub') result = math.subtract(z1, z2);
            else if (op === 'mul') result = math.multiply(z1, z2);
            else if (op === 'div') result = math.divide(z1, z2);

            steps.push({ s: "1", d: "Initialize Operands", v: `z₁=${z1.toString()}, z₂=${z2.toString()}` });
            steps.push({ s: "2", d: "Apply Operator", v: op.toUpperCase() });
        }

        const re = result.re, im = result.im;
        const mag = math.abs(result);
        const phase = math.arg(result) * (180 / Math.PI);

        $('res-cartesian').textContent = `${re.toFixed(4)} ${im >= 0 ? '+' : '-'} ${Math.abs(im).toFixed(4)}i`;
        $('res-polar').textContent = `r = ${mag.toFixed(4)}, θ = ${phase.toFixed(2)}°`;
        $('res-mag').textContent = mag.toFixed(4);
        $('res-phase').textContent = phase.toFixed(2) + "°";
        $('res-conj').textContent = `${re.toFixed(4)} ${im >= 0 ? '-' : '+'} ${Math.abs(im).toFixed(4)}i`;

        $('steps-table').innerHTML = steps.map(s => `<tr><td>${s.s}</td><td>${s.d}</td><td class="text-end fw-bold font-monospace">${s.v}</td></tr>`).join('');
        
        $('results-card').style.display = 'block';
        $('results-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => { location.reload(); });
});
</script>

<style>
.math-suite-modernized .calculator-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
.math-suite-modernized .calculator-header { display: flex; align-items: center; gap: 1.2rem; margin-bottom: 2.5rem; }
.math-suite-modernized .calculator-header h4 { margin: 0; font-weight: 800; color: #0f172a; }
.math-suite-modernized .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; }
.math-suite-modernized .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.math-suite-modernized .form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; margin-bottom: 0.6rem; display: block; }
.btn-primary-stats { color: #fff; border: none; border-radius: 12px; transition: all 0.3s; }
.btn-dark-stats { background: #0f172a; color: #fff; border: none; border-radius: 12px; }
.output-card-themed { background: #fff; border: 2px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; margin-top: 1rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px solid rgba(0,0,0,0.05); }
.output-hero-label { font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; }
.output-hero-value { font-size: 3.5rem; font-weight: 900; color: #0f172a; margin: 0.5rem 0; }
.stat-pill { background: #f8fafc; padding: 1.2rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: center; }
</style>

