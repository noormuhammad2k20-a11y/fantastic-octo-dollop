<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label-custom">Input Parameter</label>
                    <select class="form-select-v2" id="cc-mode">
                        <option value="r">Radius (r)</option>
                        <option value="d">Diameter (d)</option>
                        <option value="c">Circumference (C)</option>
                        <option value="a">Area (A)</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Value</label>
                    <input type="number" step="any" class="form-control-v2" id="cc-val" value="5">
                </div>
                <div class="col-md-6 mt-4">
                    <label class="form-label-custom">Decimal Precision</label>
                    <select class="form-select-v2" id="cc-precision">
                        <option value="2" selected>2 Places</option>
                        <option value="4">4 Places</option>
                        <option value="8">8 Places</option>
                    </select>
                </div>
                <div class="col-12 mt-4">
                    <button class="btn btn-danger rounded-pill px-5 py-2 fw-bold" id="cc-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-bolt me-2"></i> Solve Circle
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card tool-card-stacked shadow-sm border-0" id="cc-result-card" style="display: none;">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981">
                        <i class="fas fa-check"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-dark">Geometry Results</h5>
                </div>
                <div class="header-actions">
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2" id="cc-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-copy me-1"></i> Copy
                    </button>
                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3" id="cc-pdf" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-file-pdf me-1"></i> PDF
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="p-3 bg-light rounded-4 border text-center">
                        <span class="text-secondary small fw-bold text-uppercase d-block mb-1">Radius</span>
                        <div class="h4 fw-black text-danger mb-0" id="cc-res-r">5</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 bg-light rounded-4 border text-center">
                        <span class="text-secondary small fw-bold text-uppercase d-block mb-1">Diameter</span>
                        <div class="h4 fw-black text-danger mb-0" id="cc-res-d">10</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 bg-light rounded-4 border text-center">
                        <span class="text-secondary small fw-bold text-uppercase d-block mb-1">Circumference</span>
                        <div class="h4 fw-black text-danger mb-0" id="cc-res-c">31.42</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 bg-light rounded-4 border text-center">
                        <span class="text-secondary small fw-bold text-uppercase d-block mb-1">Area</span>
                        <div class="h4 fw-black text-danger mb-0" id="cc-res-a">78.54</div>
                    </div>
                </div>
            </div>
            
            <div id="cc-steps-box">
                <h6 class="fw-bold text-dark mb-3"><i class="fas fa-stream me-2 text-danger"></i>Step-by-Step Formulas</h6>
                <div id="cc-steps-content"></div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label-custom { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 0.5rem; display: block; }
    .form-control-v2, .form-select-v2 { border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 0.6rem 0.75rem; font-size: 1.1rem; color: #1e293b; width: 100%; transition: all 0.2s; font-weight: 600; }
    .form-control-v2:focus, .form-select-v2:focus { border-color: #ef4444; box-shadow: 0 0 0 4px rgba(239,68,68,0.1); outline: none; }
    .step-item { display: flex; align-items: flex-start; margin-bottom: 0.75rem; padding: 0.75rem; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; }
    .step-num { width: 24px; height: 24px; background: #ef4444; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 800; margin-right: 0.75rem; flex-shrink: 0; margin-top: 2px; }
    @media print {
        .card:not(#cc-result-card), .header-actions, .header-v2, footer, nav, .sidebar { display: none !important; }
        .card#cc-result-card { border: none !important; box-shadow: none !important; margin: 0 !important; width: 100% !important; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const mode = document.getElementById('cc-mode').value;
        const val = parseFloat(document.getElementById('cc-val').value);
        const prec = parseInt(document.getElementById('cc-precision').value);
        const PI = Math.PI;

        if (isNaN(val) || val <= 0) return;

        let r, d, c, a;
        let steps = "";

        if (mode === 'r') {
            r = val; d = r * 2; c = 2 * PI * r; a = PI * r * r;
            steps = `<div class="step-item"><span class="step-num">1</span><div>Given Radius (r) = ${r}</div></div>`;
        } else if (mode === 'd') {
            d = val; r = d / 2; c = PI * d; a = PI * r * r;
            steps = `<div class="step-item"><span class="step-num">1</span><div>Calculate Radius: r = d / 2 = ${val} / 2 = ${r}</div></div>`;
        } else if (mode === 'c') {
            c = val; r = c / (2 * PI); d = r * 2; a = PI * r * r;
            steps = `<div class="step-item"><span class="step-num">1</span><div>Calculate Radius: r = C / (2π) = ${val} / (2π) = ${r.toFixed(prec)}</div></div>`;
        } else if (mode === 'a') {
            a = val; r = Math.sqrt(a / PI); d = r * 2; c = 2 * PI * r;
            steps = `<div class="step-item"><span class="step-num">1</span><div>Calculate Radius: r = √(A / π) = √(${val} / π) = ${r.toFixed(prec)}</div></div>`;
        }

        steps += `
            <div class="step-item"><span class="step-num">2</span><div><strong>Diameter:</strong> d = 2r = ${d.toFixed(prec)}</div></div>
            <div class="step-item"><span class="step-num">3</span><div><strong>Circumference:</strong> C = 2πr = ${c.toFixed(prec)}</div></div>
            <div class="step-item"><span class="step-num">4</span><div><strong>Area:</strong> A = πr² = ${a.toFixed(prec)}</div></div>
        `;

        document.getElementById('cc-res-r').textContent = r.toFixed(prec);
        document.getElementById('cc-res-d').textContent = d.toFixed(prec);
        document.getElementById('cc-res-c').textContent = c.toFixed(prec);
        document.getElementById('cc-res-a').textContent = a.toFixed(prec);
        document.getElementById('cc-steps-content').innerHTML = steps;
        document.getElementById('cc-result-card').style.display = 'block';
    }

    document.getElementById('cc-calculate').addEventListener('click', calculate);
    document.getElementById('cc-reset').addEventListener('click', () => {
        document.getElementById('cc-val').value = 5;
        document.getElementById('cc-result-card').style.display = 'none';
    });
    document.getElementById('cc-copy').addEventListener('click', function() {
        navigator.clipboard.writeText(document.getElementById('cc-result-card').innerText);
        this.innerHTML = 'Copied';
        setTimeout(() => this.innerHTML = '<i class="far fa-copy me-1"></i> Copy', 2000);
    });
    document.getElementById('cc-pdf').addEventListener('click', () => window.print());
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\circle-calculator.blade.php ENDPATH**/ ?>