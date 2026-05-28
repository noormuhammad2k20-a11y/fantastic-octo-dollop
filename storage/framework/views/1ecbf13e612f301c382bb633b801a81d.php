<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label-custom">Value x (positive)</label>
                    <input type="number" step="any" class="form-control-v2" id="bf-x" value="2.5">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Value y (positive)</label>
                    <input type="number" step="any" class="form-control-v2" id="bf-y" value="3.5">
                </div>
                <div class="col-12 mt-4">
                    <button class="btn btn-primary rounded-pill px-5 py-2 fw-bold" id="bf-calculate" style="min-width: 280px; max-width: 100%; background:#8b5cf6; border-color:#8b5cf6">
                        <i class="fas fa-bolt me-2"></i> Compute B(x, y)
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card tool-card-stacked shadow-sm border-0" id="bf-result-card" style="display: none;">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981">
                        <i class="fas fa-check"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-dark">Function Result</h5>
                </div>
                <div class="header-actions">
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2" id="bf-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-copy me-1"></i> Copy
                    </button>
                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3" id="bf-pdf" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-file-pdf me-1"></i> PDF
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="result-hero p-4 rounded-4 text-center mb-4" style="background: #f5f3ff;">
                <span class="text-purple small fw-bold text-uppercase" style="color:#8b5cf6">Beta Function Value</span>
                <div class="display-4 fw-black text-purple mb-0" id="bf-answer" style="color:#8b5cf6">0.0381</div>
            </div>
            <div id="bf-steps-box">
                <h6 class="fw-bold text-dark mb-3"><i class="fas fa-info-circle me-2 text-purple" style="color:#8b5cf6"></i>Calculation Details</h6>
                <div id="bf-steps-content"></div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label-custom { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 0.5rem; display: block; }
    .form-control-v2 { border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 0.6rem 0.75rem; font-size: 1.1rem; color: #1e293b; width: 100%; transition: all 0.2s; font-weight: 600; }
    .form-control-v2:focus { border-color: #8b5cf6; box-shadow: 0 0 0 4px rgba(139,92,246,0.1); outline: none; }
    .step-item { display: flex; align-items: flex-start; margin-bottom: 0.75rem; padding: 0.75rem; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; }
    .step-num { width: 24px; height: 24px; background: #8b5cf6; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 800; margin-right: 0.75rem; flex-shrink: 0; margin-top: 2px; }
    @media print {
        .card:not(#bf-result-card), .header-actions, .header-v2, footer, nav, .sidebar { display: none !important; }
        .card#bf-result-card { border: none !important; box-shadow: none !important; margin: 0 !important; width: 100% !important; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Lanczos approximation for Gamma function
    function gamma(z) {
        const g = 7;
        const p = [0.99999999999980993, 676.5203681218851, -1259.1392167224028, 771.32342877765313, -176.61502916214059, 12.507343278686905, -0.13857109526572012, 9.9843695780195716e-6, 1.5056327351493116e-7];
        if (z < 0.5) return Math.PI / (Math.sin(Math.PI * z) * gamma(1 - z));
        z -= 1;
        let x = p[0];
        for (let i = 1; i < g + 2; i++) x += p[i] / (z + i);
        const t = z + g + 0.5;
        return Math.sqrt(2 * Math.PI) * Math.pow(t, z + 0.5) * Math.exp(-t) * x;
    }

    function calculate() {
        const x = parseFloat(document.getElementById('bf-x').value);
        const y = parseFloat(document.getElementById('bf-y').value);

        if (isNaN(x) || isNaN(y) || x <= 0 || y <= 0) {
            alert("Values must be positive real numbers.");
            return;
        }

        const gx = gamma(x);
        const gy = gamma(y);
        const gxy = gamma(x + y);
        const beta = (gx * gy) / gxy;

        document.getElementById('bf-answer').textContent = beta.toFixed(6);
        
        let steps = `
            <div class="step-item"><span class="step-num">1</span><div><strong>Definition:</strong> B(x, y) = Γ(x)Γ(y) / Γ(x+y)</div></div>
            <div class="step-item"><span class="step-num">2</span><div><strong>Compute Γ(${x}):</strong> ${gx.toFixed(6)}</div></div>
            <div class="step-item"><span class="step-num">3</span><div><strong>Compute Γ(${y}):</strong> ${gy.toFixed(6)}</div></div>
            <div class="step-item"><span class="step-num">4</span><div><strong>Compute Γ(${x}+${y}):</strong> ${gxy.toFixed(6)}</div></div>
            <div class="step-item"><span class="step-num">5</span><div><strong>Final Result:</strong> (${gx.toFixed(4)} × ${gy.toFixed(4)}) / ${gxy.toFixed(4)} = ${beta.toFixed(6)}</div></div>
        `;
        document.getElementById('bf-steps-content').innerHTML = steps;
        document.getElementById('bf-result-card').style.display = 'block';
    }

    document.getElementById('bf-calculate').addEventListener('click', calculate);
    document.getElementById('bf-reset').addEventListener('click', () => {
        document.getElementById('bf-x').value = 2.5;
        document.getElementById('bf-y').value = 3.5;
        document.getElementById('bf-result-card').style.display = 'none';
    });
    document.getElementById('bf-copy').addEventListener('click', function() {
        navigator.clipboard.writeText(document.getElementById('bf-steps-box').innerText);
        const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check"></i>';
        setTimeout(() => this.innerHTML = o, 2000);
    });
    document.getElementById('bf-pdf').addEventListener('click', () => window.print());
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\beta-function-calculator.blade.php ENDPATH**/ ?>