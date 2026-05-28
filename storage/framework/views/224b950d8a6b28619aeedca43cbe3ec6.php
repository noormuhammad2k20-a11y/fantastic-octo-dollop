<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label-custom">Semi-major Axis (a)</label>
                    <div class="input-group-v2">
                        <span class="input-group-text-v2"><i class="fas fa-arrows-alt-h"></i></span>
                        <input type="number" step="any" class="form-control-v2" id="ell-a" value="10">
                    </div>
                    <p class="text-muted small mt-2">The longest radius of the ellipse.</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Semi-minor Axis (b)</label>
                    <div class="input-group-v2">
                        <span class="input-group-text-v2"><i class="fas fa-arrows-alt-v"></i></span>
                        <input type="number" step="any" class="form-control-v2" id="ell-b" value="5">
                    </div>
                    <p class="text-muted small mt-2">The shortest radius of the ellipse.</p>
                </div>
                <div class="col-12 mt-4">
                    <label class="form-label-custom">Calculation Method</label>
                    <select class="form-select-v2" id="ell-method">
                        <option value="ramanujan2">Ramanujan's Formula 2 (Highly Accurate)</option>
                        <option value="ramanujan1">Ramanujan's Formula 1 (Simple)</option>
                        <option value="basic">Basic Approximation [π(a+b)]</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card tool-card-stacked shadow-sm border-0" id="ell-result-card">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(236,72,153,.1);color:#ec4899">
                        <i class="fas fa-infinity"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-dark">Circumference Result</h5>
                </div>
                <div class="header-actions">
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2" id="ell-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-copy me-1"></i> Copy
                    </button>
                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3" id="ell-pdf" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-file-pdf me-1"></i> PDF
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="result-hero p-4 rounded-4 mb-4 text-center" style="background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%);">
                        <span class="text-secondary small fw-bold text-uppercase">Perimeter (C)</span>
                        <div class="display-4 fw-black text-pink mb-0" style="color:#db2777" id="ell-answer">48.4422</div>
                    </div>
                    
                    <div id="ell-steps-box">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-square-root-alt me-2 text-pink" style="color:#db2777"></i>Step-by-Step Breakdown</h6>
                        <div id="ell-steps-content">
                            <!-- Steps dynamically injected -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 text-center mt-4 mt-lg-0">
                    <div class="p-4 bg-white border rounded-4 shadow-sm position-relative">
                        <svg viewBox="0 0 100 100" style="max-width: 100%; height: auto;">
                            <ellipse id="svg-ellipse" cx="50" cy="50" rx="40" ry="20" fill="none" stroke="#ec4899" stroke-width="2" stroke-dasharray="2,2" />
                            <line x1="50" y1="50" x2="90" y2="50" stroke="#64748b" stroke-width="1" />
                            <text x="70" y="45" font-size="5" fill="#64748b">a</text>
                            <line x1="50" y1="50" x2="50" y2="30" stroke="#64748b" stroke-width="1" />
                            <text x="52" y="40" font-size="5" fill="#64748b">b</text>
                            <circle cx="50" cy="50" r="1.5" fill="#1e293b" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label-custom { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 0.5rem; display: block; }
    .input-group-v2 { position: relative; display: flex; align-items: stretch; width: 100%; }
    .input-group-text-v2 { display: flex; align-items: center; padding: 0.5rem 0.75rem; font-size: 0.875rem; color: #64748b; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 10px 0 0 10px; border-right: none; }
    .form-control-v2, .form-select-v2 { border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 0.5rem 0.75rem; font-size: 1rem; color: #1e293b; width: 100%; transition: all 0.2s; }
    .input-group-v2 .form-control-v2 { border-radius: 0 10px 10px 0; }
    .form-control-v2:focus, .form-select-v2:focus { border-color: #8b5cf6; box-shadow: 0 0 0 4px rgba(139,92,246,0.1); outline: none; }
    .step-item { display: flex; align-items: flex-start; margin-bottom: 0.75rem; padding: 0.75rem; background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; }
    .step-num { width: 24px; height: 24px; background: #db2777; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 800; margin-right: 0.75rem; flex-shrink: 0; margin-top: 2px; }
    
    @media print {
        .card:not(#ell-result-card), .header-actions, .header-v2, footer, nav, .sidebar { display: none !important; }
        .card#ell-result-card { border: none !important; box-shadow: none !important; margin: 0 !important; width: 100% !important; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const a = parseFloat(document.getElementById('ell-a').value) || 0;
        const b = parseFloat(document.getElementById('ell-b').value) || 0;
        const method = document.getElementById('ell-method').value;
        const container = document.getElementById('ell-steps-content');
        
        if (a <= 0 || b <= 0) {
            document.getElementById('ell-answer').textContent = "—";
            container.innerHTML = '<div class="text-danger small fw-bold">Please enter positive values for a and b.</div>';
            return;
        }

        let c = 0;
        let steps = [];

        if (method === 'basic') {
            c = Math.PI * (a + b);
            steps = [
                {t: "Basic Approximation", d: "C ≈ π(a + b)"},
                {t: "Substitution", d: `C ≈ π(${a} + ${b}) = π(${a+b})`},
                {t: "Final Value", d: `C ≈ ${c.toFixed(6)}`}
            ];
        } else if (method === 'ramanujan1') {
            c = Math.PI * (3 * (a + b) - Math.sqrt((3 * a + b) * (a + 3 * b)));
            steps = [
                {t: "Ramanujan Formula 1", d: "C ≈ π[3(a+b) - √((3a+b)(a+3b))]"},
                {t: "Term Calculation", d: `3(a+b) = ${3*(a+b)}, (3a+b) = ${3*a+b}, (a+3b) = ${a+3*b}`},
                {t: "Root Calculation", d: `√(${3*a+b} × ${a+3*b}) = √${(3*a+b)*(a+3*b)} = ${Math.sqrt((3*a+b)*(a+3*b)).toFixed(4)}`},
                {t: "Final Value", d: `C ≈ ${c.toFixed(6)}`}
            ];
        } else {
            const h = Math.pow(a - b, 2) / Math.pow(a + b, 2);
            c = Math.PI * (a + b) * (1 + (3 * h) / (10 + Math.sqrt(4 - 3 * h)));
            steps = [
                {t: "Ramanujan Formula 2", d: "C ≈ π(a+b)[1 + 3h / (10 + √(4-3h))]"},
                {t: "Calculate h parameter", d: `h = (a-b)² / (a+b)² = ${(a-b)*(a-b)} / ${(a+b)*(a+b)} = ${h.toFixed(6)}`},
                {t: "Solve for Circumference", d: `Numerator: 3h = ${(3*h).toFixed(6)}, Denominator: 10 + √(4 - ${(3*h).toFixed(4)})`},
                {t: "Final Value", d: `C ≈ ${c.toFixed(6)}`}
            ];
        }

        document.getElementById('ell-answer').textContent = c.toFixed(4);
        container.innerHTML = steps.map((s, i) => `
            <div class="step-item">
                <span class="step-num">${i+1}</span>
                <div>
                    <div class="fw-bold text-dark small">${s.t}</div>
                    <div class="text-secondary small font-monospace">${s.d}</div>
                </div>
            </div>
        `).join('');

        // SVG Update
        const rx = a >= b ? 40 : 40 * (a/b);
        const ry = b >= a ? 40 : 40 * (b/a);
        document.getElementById('svg-ellipse').setAttribute('rx', rx);
        document.getElementById('svg-ellipse').setAttribute('ry', ry);
    }

    ['ell-a', 'ell-b', 'ell-method'].forEach(id => document.getElementById(id).addEventListener('input', calculate));
    
    document.getElementById('ell-reset').addEventListener('click', () => {
        document.getElementById('ell-a').value = 10;
        document.getElementById('ell-b').value = 5;
        calculate();
    });

    document.getElementById('ell-copy').addEventListener('click', function() {
        const text = `Ellipse Circumference Report\n${'='.repeat(30)}\na: ${document.getElementById('ell-a').value}, b: ${document.getElementById('ell-b').value}\nResult: ${document.getElementById('ell-answer').textContent}\n\nGenerated via ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    document.getElementById('ell-pdf').addEventListener('click', () => window.print());

    calculate();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\ellipse-circumference-calculator.blade.php ENDPATH**/ ?>