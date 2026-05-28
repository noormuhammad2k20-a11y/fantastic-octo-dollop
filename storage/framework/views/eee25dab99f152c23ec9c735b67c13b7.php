<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label-custom">Point P (x₁, y₁, z₁)</label>
                    <div class="row g-2">
                        <div class="col-4"><input type="number" step="any" class="form-control-v2" id="pp-x1" value="1"></div>
                        <div class="col-4"><input type="number" step="any" class="form-control-v2" id="pp-y1" value="2"></div>
                        <div class="col-4"><input type="number" step="any" class="form-control-v2" id="pp-z1" value="3"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Plane Equation (Ax + By + Cz + D = 0)</label>
                    <div class="row g-2">
                        <div class="col-3"><input type="number" step="any" class="form-control-v2" id="pp-a" value="2" placeholder="A"></div>
                        <div class="col-3"><input type="number" step="any" class="form-control-v2" id="pp-b" value="-1" placeholder="B"></div>
                        <div class="col-3"><input type="number" step="any" class="form-control-v2" id="pp-c" value="1" placeholder="C"></div>
                        <div class="col-3"><input type="number" step="any" class="form-control-v2" id="pp-d" value="4" placeholder="D"></div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <button class="btn btn-primary rounded-pill px-5 py-2 fw-bold" id="pp-calculate" style="min-width: 280px; max-width: 100%; background:#8b5cf6; border-color:#8b5cf6">
                        <i class="fas fa-bolt me-2"></i> Calculate Distance
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card tool-card-stacked shadow-sm border-0" id="pp-result-card" style="display: none;">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981">
                        <i class="fas fa-check"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-dark">Distance Result</h5>
                </div>
                <div class="header-actions">
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2" id="pp-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-copy me-1"></i> Copy
                    </button>
                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3" id="pp-pdf" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-file-pdf me-1"></i> PDF
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 px-4 pb-4 text-center">
            <div class="result-hero p-4 rounded-4 mb-4" style="background: #f5f3ff;">
                <span class="text-purple small fw-bold text-uppercase" style="color:#8b5cf6">Shortest Distance (d)</span>
                <div class="display-3 fw-black text-purple mb-0" id="pp-answer" style="color:#8b5cf6">3.6742</div>
            </div>
            <div class="text-start" id="pp-steps-box">
                <h6 class="fw-bold text-dark mb-3"><i class="fas fa-stream me-2 text-purple" style="color:#8b5cf6"></i>Calculation Steps</h6>
                <div id="pp-steps-content"></div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label-custom { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 0.5rem; display: block; }
    .form-control-v2 { border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 0.5rem; font-size: 1rem; color: #1e293b; width: 100%; transition: all 0.2s; font-weight: 600; text-align: center; }
    .form-control-v2:focus { border-color: #8b5cf6; box-shadow: 0 0 0 4px rgba(139,92,246,0.1); outline: none; }
    .step-item { display: flex; align-items: flex-start; margin-bottom: 0.75rem; padding: 0.75rem; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; }
    .step-num { width: 24px; height: 24px; background: #8b5cf6; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 800; margin-right: 0.75rem; flex-shrink: 0; margin-top: 2px; }
    @media print {
        .card:not(#pp-result-card), .header-actions, .header-v2, footer, nav, .sidebar { display: none !important; }
        .card#pp-result-card { border: none !important; box-shadow: none !important; margin: 0 !important; width: 100% !important; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const x1 = parseFloat(document.getElementById('pp-x1').value);
        const y1 = parseFloat(document.getElementById('pp-y1').value);
        const z1 = parseFloat(document.getElementById('pp-z1').value);
        const a = parseFloat(document.getElementById('pp-a').value);
        const b = parseFloat(document.getElementById('pp-b').value);
        const c = parseFloat(document.getElementById('pp-c').value);
        const d = parseFloat(document.getElementById('pp-d').value);

        if ([x1, y1, z1, a, b, c, d].some(isNaN)) return;
        if (a === 0 && b === 0 && c === 0) { alert("A, B, and C cannot all be zero."); return; }

        const numerator = Math.abs(a * x1 + b * y1 + c * z1 + d);
        const denominator = Math.sqrt(a * a + b * b + c * c);
        const dist = numerator / denominator;

        document.getElementById('pp-answer').textContent = dist.toFixed(4);
        
        let steps = `
            <div class="step-item"><span class="step-num">1</span><div><strong>Formula:</strong> d = |Ax₁ + By₁ + Cz₁ + D| / √(A² + B² + C²)</div></div>
            <div class="step-item"><span class="step-num">2</span><div><strong>Numerator:</strong> |(${a}×${x1}) + (${b}×${y1}) + (${c}×${z1}) + ${d}| = |${a*x1 + b*y1 + c*z1 + d}| = ${numerator}</div></div>
            <div class="step-item"><span class="step-num">3</span><div><strong>Denominator:</strong> √(${a}² + ${b}² + ${c}²) = √${a*a + b*b + c*c} = ${denominator.toFixed(4)}</div></div>
            <div class="step-item"><span class="step-num">4</span><div><strong>Result:</strong> ${numerator} / ${denominator.toFixed(4)} = ${dist.toFixed(4)}</div></div>
        `;
        document.getElementById('pp-steps-content').innerHTML = steps;
        document.getElementById('pp-result-card').style.display = 'block';
    }

    document.getElementById('pp-calculate').addEventListener('click', calculate);
    document.getElementById('pp-reset').addEventListener('click', () => {
        ['pp-x1','pp-y1','pp-z1','pp-a','pp-b','pp-c','pp-d'].forEach(id => document.getElementById(id).value = '');
        document.getElementById('pp-result-card').style.display = 'none';
    });
    document.getElementById('pp-copy').addEventListener('click', function() {
        navigator.clipboard.writeText(document.getElementById('pp-result-card').innerText);
        this.innerHTML = 'Copied';
        setTimeout(() => this.innerHTML = '<i class="far fa-copy me-1"></i> Copy', 2000);
    });
    document.getElementById('pp-pdf').addEventListener('click', () => window.print());
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\point-to-plane-distance-calculator.blade.php ENDPATH**/ ?>