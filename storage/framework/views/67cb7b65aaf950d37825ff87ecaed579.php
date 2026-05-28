<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0" style="word-break: break-word;">
        
        <div class="card-body-v2 p-4" style="overflow-x: auto;">
            
            <div class="p-3 rounded-4 mb-4" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3 letter-spacing-1"><i class="fas fa-bolt text-warning me-2"></i>Quick Actions</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-saas rounded-pill px-4" id="btn-calc"><i class="fas fa-calculator me-2"></i>Calculate Volume</button>
                    <button type="button" class="btn btn-saas-secondary rounded-pill px-4" id="btn-reset-fields"><i class="fas fa-undo me-2"></i>Reset Fields</button>
                    
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-8">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Ellipsoid Semi-Axes</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Semi-Axis (a)</label>
                                <input type="number" id="in-axis-a" class="form-control form-control-lg rounded-3" value="5" step="any" min="0">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Semi-Axis (b)</label>
                                <input type="number" id="in-axis-b" class="form-control form-control-lg rounded-3" value="4" step="any" min="0">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Semi-Axis (c)</label>
                                <input type="number" id="in-axis-c" class="form-control form-control-lg rounded-3" value="3" step="any" min="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Settings</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Unit</label>
                                <select id="in-unit" class="form-select form-select-lg rounded-3">
                                    <option value="mm">mm</option>
                                    <option value="cm" selected>cm</option>
                                    <option value="m">m</option>
                                    <option value="in">in</option>
                                    <option value="ft">ft</option>
                                    <option value="yd">yd</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Precision</label>
                                <select id="in-precision" class="form-select form-select-lg rounded-3">
                                    <option value="0">0 decimals</option>
                                    <option value="1">1 decimal</option>
                                    <option value="2">2 decimals</option>
                                    <option value="3" selected>3 decimals</option>
                                    <option value="4">4 decimals</option>
                                    <option value="5">5 decimals</option>
                                    <option value="6">6 decimals</option>
                                    <option value="7">7 decimals</option>
                                    <option value="8">8 decimals</option>
                                    <option value="9">9 decimals</option>
                                    <option value="10">10 decimals</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-3 bg-light rounded-4 border">
                <p class="mb-0 small text-muted fw-bold text-center" id="formula-display">
                    Formula: $$V = \frac{4}{3}\pi a b c$$
                </p>
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none" style="word-break: break-word;">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark fs-5">Calculation Result</h5>
                        <p class="text-muted small mb-0">Volume and surface area analysis</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy-result">
                        <i class="fas fa-copy me-1"></i> Copy Results
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4" style="overflow-x: auto;">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-6 text-center border-end">
                    <div class="display-5 fw-bold text-dark mb-0" id="out-volume">0</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1 mt-2">Volume (<span class="out-unit-3"></span>)</p>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="display-5 fw-bold text-dark mb-0" id="out-surface">0</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1 mt-2">Approx. Surface Area (<span class="out-unit-2"></span>)</p>
                </div>
            </div>

            <div class="p-4 rounded-4 bg-light border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">
                    <i class="fas fa-info-circle text-primary me-2"></i>Geometric Properties
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --danger-soft: #fef2f2;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }
    .bg-danger-soft { background-color: var(--danger-soft); }

    .tool-card-stacked { border-radius: 24px; background: #fff; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .btn-saas {
        background: var(--primary-color);
        color: white;
        font-weight: 600;
        border: none;
        transition: all 0.2s ease;
        box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
    }
    .btn-saas:hover {
        background: #4338ca;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 6px 8px -1px rgba(79, 70, 229, 0.3);
    }

    .btn-saas-secondary {
        background: #f1f5f9;
        color: #475569;
        font-weight: 600;
        border: none;
        transition: all 0.2s ease;
    }
    .btn-saas-secondary:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    .form-control-lg, .form-select-lg { 
        border: 1.5px solid var(--border-color); 
        border-radius: 12px; 
        font-size: 1.1rem; 
        padding: 0.75rem 1rem; 
    }
    .form-control:focus, .form-select:focus { 
        border-color: var(--primary-color); 
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); 
        outline: none; 
    }
    
    .letter-spacing-1 { letter-spacing: 1px; }
    
    @media (max-width: 768px) {
        .display-5 { font-size: 2rem; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const axisA = document.getElementById('in-axis-a');
    const axisB = document.getElementById('in-axis-b');
    const axisC = document.getElementById('in-axis-c');
    const unitE = document.getElementById('in-unit');
    const precisionE = document.getElementById('in-precision');
    
    const resultCard = document.getElementById('result-card');
    const outVolume = document.getElementById('out-volume');
    const outSurface = document.getElementById('out-surface');
    const outUnit3 = document.querySelectorAll('.out-unit-3');
    const outUnit2 = document.querySelectorAll('.out-unit-2');
    const outInsights = document.getElementById('out-insights');
    
    const btnCalc = document.getElementById('btn-calc');
    const btnReset = document.getElementById('btn-reset-fields');
    const btnCopyFormula = document.getElementById('btn-copy-formula');
    const btnCopyResult = document.getElementById('btn-copy-result');

    function calculate() {
        const a = parseFloat(axisA.value);
        const b = parseFloat(axisB.value);
        const c = parseFloat(axisC.value);
        const u = unitE.value;
        const p = parseInt(precisionE.value);
        
        if (isNaN(a) || isNaN(b) || isNaN(c) || a <= 0 || b <= 0 || c <= 0) {
            alert('Please enter valid positive numbers for all semi-axes.');
            return;
        }

        const pi = Math.PI;
        
        // Ellipsoid Volume
        const volume = (4/3) * pi * a * b * c;
        
        // Approximate Surface Area (Knud Thomsen's formula)
        const p_val = 1.6075;
        const sa = 4 * pi * Math.pow(((Math.pow(a*b, p_val) + Math.pow(a*c, p_val) + Math.pow(b*c, p_val))/3), (1/p_val));
        
        // Update UI
        outVolume.textContent = volume.toFixed(p);
        outSurface.textContent = sa.toFixed(p);
        
        outUnit3.forEach(el => el.textContent = u + '³');
        outUnit2.forEach(el => el.textContent = u + '²');
        
        const isSphere = (a === b && b === c);
        
        const ins = [
            `<strong>Type:</strong> ${isSphere ? 'Perfect Sphere' : 'Scalene Ellipsoid'}`,
            `<strong>Longest Axis:</strong> ${Math.max(a, b, c).toFixed(p)} ${u} (Semi)`,
            `<strong>Shortest Axis:</strong> ${Math.min(a, b, c).toFixed(p)} ${u} (Semi)`,
            `Uses high-precision Pi (π ≈ ${pi.toFixed(9)})`
        ];

        outInsights.innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;

        resultCard.classList.remove('d-none');
        resultCard.scrollIntoView({ behavior: 'smooth' });
    }

    btnCalc.addEventListener('click', calculate);

    btnReset.addEventListener('click', () => {
        axisA.value = '';
        axisB.value = '';
        axisC.value = '';
        resultCard.classList.add('d-none');
        axisA.focus();
    });

    btnCopyFormula.addEventListener('click', function() {
        navigator.clipboard.writeText('V = (4/3) * π * a * b * c').then(() => {
            const btn = this;
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => { btn.innerHTML = originalHTML; }, 2000);
        });
    });

    btnCopyResult.addEventListener('click', function() {
        const u = unitE.value;
        const text = `Ellipsoid Properties (a: ${axisA.value}, b: ${axisB.value}, c: ${axisC.value} ${u})\nVolume: ${outVolume.textContent} ${u}³\nSurface Area: ${outSurface.textContent} ${u}²`;
        
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalHTML; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\volume-ellipsoid-calculator.blade.php ENDPATH**/ ?>