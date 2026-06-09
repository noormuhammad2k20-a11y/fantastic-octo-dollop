<div class="interactive-card">
    <div class="interactive-header">
        <h4><i class="<?php echo e($tool['icon'] ?? 'fas fa-square-root-alt'); ?>"></i> <?php echo e($tool['h1'] ?? 'Quadratic Formula Calculator'); ?></h4>
        <div class="header-actions">
            <button class="btn btn-sm btn-outline-secondary" id="btn-reset-qfc"><i class="fas fa-redo me-1"></i> Reset</button>
        </div>
    </div>

    <div class="interactive-body">
        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-11 col-lg-9">
                <div class="equation-box text-center">
                    <p class="text-muted mb-4 fw-bold">Solve for the roots of any quadratic equation: ax² + bx + c = 0</p>
                    <div class="d-flex flex-wrap align-items-center justify-content-center gap-2 gap-md-3">
                        <div class="input-group-custom">
                            <input type="number" id="qfc-a" class="form-control text-center fw-bold" value="1">
                        </div>
                        <div class="equation-text">x² +</div>
                        <div class="input-group-custom">
                            <input type="number" id="qfc-b" class="form-control text-center fw-bold" value="-3">
                        </div>
                        <div class="equation-text">x +</div>
                        <div class="input-group-custom">
                            <input type="number" id="qfc-c" class="form-control text-center fw-bold" value="2">
                        </div>
                        <div class="equation-text">= 0</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="action-bar text-center mb-5">
            <button class="btn btn-lg btn-accent px-5 py-3 fw-bold shadow-sm" id="btn-calc-qfc">
                <i class="fas fa-calculator me-2"></i> Calculate Roots
            </button>
        </div>

        <div class="results-container" id="qfc-results">
            <div class="row g-4 justify-content-center">
                <div class="col-md-5">
                    <div class="result-box text-center">
                        <span class="result-label">Root 1 (x₁)</span>
                        <div id="out-qfc-x1" class="result-value">2</div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="result-box text-center">
                        <span class="result-label">Root 2 (x₂)</span>
                        <div id="out-qfc-x2" class="result-value">1</div>
                    </div>
                </div>
                <div class="col-12 text-center mt-4">
                    <span id="out-qfc-type" class="badge-custom">Two Distinct Real Roots</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .interactive-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.03);
        border: 1px solid #f0f0f0;
        margin-bottom: 3rem;
    }
    .interactive-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px dashed #e5e7eb;
    }
    .interactive-header h4 {
        margin: 0;
        font-weight: 800;
        color: #111827;
        letter-spacing: -0.5px;
    }
    .equation-box {
        background: #f9fafb;
        border-radius: 20px;
        padding: 35px 25px;
        border: 1px solid #e5e7eb;
    }
    .input-group-custom {
        width: 110px;
    }
    .input-group-custom .form-control {
        border-radius: 14px;
        border: 2px solid #e5e7eb;
        padding: 12px 10px;
        font-size: 1.35rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #ffffff;
        color: #1f2937;
    }
    .input-group-custom .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 4px rgba(255, 107, 0, 0.1);
        outline: none;
    }
    .equation-text {
        font-size: 1.6rem;
        font-weight: 800;
        color: #4b5563;
    }
    .btn-accent {
        background: var(--accent);
        color: white;
        border: none;
        border-radius: 14px;
        transition: all 0.3s ease;
    }
    .btn-accent:hover {
        background: #e65100;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 107, 0, 0.25);
        color: white;
    }
    .results-container {
        background: #ffffff;
        border-radius: 20px;
        padding: 35px;
        border: 2px solid #f3f4f6;
        box-shadow: inset 0 2px 10px rgba(0,0,0,0.01);
    }
    .result-box {
        background: #f8f9fa;
        border-radius: 16px;
        padding: 25px;
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    .result-box:hover {
        border-color: var(--accent);
        background: #fff;
        box-shadow: 0 4px 15px rgba(255, 107, 0, 0.05);
    }
    .result-label {
        font-size: 0.8rem;
        font-weight: 800;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 12px;
        display: block;
    }
    .result-value {
        font-size: 2.2rem;
        font-weight: 900;
        color: var(--accent);
        word-break: break-all;
        line-height: 1.2;
    }
    .badge-custom {
        display: inline-block;
        padding: 10px 24px;
        border-radius: 50px;
        font-size: 0.95rem;
        font-weight: 800;
        background: rgba(255, 107, 0, 0.1);
        color: var(--accent);
        border: 1px solid rgba(255, 107, 0, 0.2);
    }
    
    @media (max-width: 768px) {
        .interactive-card { padding: 25px; border-radius: 16px; }
        .equation-box { padding: 25px 15px; }
        .equation-text { font-size: 1.3rem; }
        .input-group-custom { width: 85px; }
        .input-group-custom .form-control { font-size: 1.15rem; padding: 10px; }
        .result-value { font-size: 1.8rem; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const elA = document.getElementById('qfc-a');
    const elB = document.getElementById('qfc-b');
    const elC = document.getElementById('qfc-c');
    const outX1 = document.getElementById('out-qfc-x1');
    const outX2 = document.getElementById('out-qfc-x2');
    const outType = document.getElementById('out-qfc-type');
    const btnCalc = document.getElementById('btn-calc-qfc');
    const btnReset = document.getElementById('btn-reset-qfc');

    function calcQfc() {
        const a = parseFloat(elA.value);
        const b = parseFloat(elB.value) || 0;
        const c = parseFloat(elC.value) || 0;
        
        if(!a || a === 0) {
            outX1.innerText = 'NaN';
            outX2.innerText = 'NaN';
            outType.innerText = "Not a quadratic equation (a cannot be 0)";
            return;
        }

        const discriminant = (b * b) - (4 * a * c);
        let x1, x2, type;

        if (discriminant > 0) {
            const root = Math.sqrt(discriminant);
            x1 = ((-b + root) / (2 * a)).toFixed(4).replace(/\.?0+$/, '');
            x2 = ((-b - root) / (2 * a)).toFixed(4).replace(/\.?0+$/, '');
            type = "Two Distinct Real Roots";
        } else if (discriminant === 0) {
            x1 = (-b / (2 * a)).toFixed(4).replace(/\.?0+$/, '');
            x2 = x1;
            type = "One Real Root (Repeated)";
        } else {
            const real = (-b / (2 * a)).toFixed(4).replace(/\.?0+$/, '');
            const imag = (Math.sqrt(Math.abs(discriminant)) / (2 * a)).toFixed(4).replace(/\.?0+$/, '');
            const rPart = real === "0" ? "" : real;
            x1 = `${rPart} + ${imag}i`;
            x2 = `${rPart} - ${imag}i`;
            type = "Two Complex Roots";
        }

        outX1.innerText = x1;
        outX2.innerText = x2;
        outType.innerText = type;
        
        // Add a subtle animation to show it updated
        const resultsBox = document.getElementById('qfc-results');
        resultsBox.style.opacity = '0.5';
        setTimeout(() => {
            resultsBox.style.opacity = '1';
            resultsBox.style.transition = 'opacity 0.3s ease';
        }, 50);
    }

    function resetQfc() {
        elA.value = 1;
        elB.value = -3;
        elC.value = 2;
        calcQfc();
    }

    [elA, elB, elC].forEach(el => {
        el.addEventListener('input', calcQfc);
    });

    btnCalc.addEventListener('click', calcQfc);
    btnReset.addEventListener('click', resetQfc);

    // Initial calculation
    calcQfc();
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/tools/interactive/quadratic-formula-calculator.blade.php ENDPATH**/ ?>