<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            
            <div class="p-3 rounded-4 mb-4" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3 letter-spacing-1"><i class="fas fa-magic text-primary me-2"></i>Quick Actions</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="btn-sample-fast">Fast Initial Growth</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="btn-sample-slow">Slow Steady Growth</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="btn-sample-decay">Logarithmic Decay</button>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-12">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Model Parameters</h6>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Initial Value (a)</label>
                                <input type="number" id="calc-a" class="form-control form-control-lg rounded-3" value="10" step="any">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Growth Factor (b)</label>
                                <input type="number" id="calc-b" class="form-control form-control-lg rounded-3" value="5" step="any">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Time / X Value (x)</label>
                                <input type="number" id="calc-x" class="form-control form-control-lg rounded-3" value="20" step="any" min="0.0001">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Decimals</label>
                                <select id="calc-precision" class="form-select form-select-lg rounded-3">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3" selected>3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-calculator me-2"></i> Calculate Growth
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-chart-area text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Logarithmic Projection</h5>
                        <p class="text-muted small mb-0">Model evaluation and visualization</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-12">
                    <div class="p-3 rounded-4 bg-white border shadow-sm text-center overflow-x-auto break-words" style="min-height: 400px;">
                        <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">Growth Curve</h6>
                        <div style="position: relative; height: 350px; width: 100%;">
                            <canvas id="growthCanvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-12">
                    <div class="p-3 rounded-4 bg-light border text-center h-100 d-flex flex-column justify-content-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Result at x = <span id="out-x-val">0</span></div>
                        <div class="display-5 fw-bold mb-0 text-primary" id="out-y">0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-control-lg, .form-select-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.1rem; padding: 0.75rem 1rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }
    
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .break-words { word-break: break-word; }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const aE = document.getElementById('calc-a');
    const bE = document.getElementById('calc-b');
    const xE = document.getElementById('calc-x');
    const precE = document.getElementById('calc-precision');
    
    const resultCard = document.getElementById('result-card');
    const outXVal = document.getElementById('out-x-val');
    const outY = document.getElementById('out-y');
    const btnCalculate = document.getElementById('btn-calculate');
    
    let chartInstance = null;

    function renderMath(elementId, formula) {
        if (typeof katex !== 'undefined') {
            katex.render(formula, document.getElementById(elementId), {
                throwOnError: false,
                displayMode: true
            });
        }
    }

    function calculate() {
        xE.classList.remove('is-invalid');
        
        const a = parseFloat(aE.value);
        const b = parseFloat(bE.value);
        const x = parseFloat(xE.value);
        
        if (isNaN(a) || isNaN(b) || isNaN(x) || x <= 0) {
            if (x <= 0) xE.classList.add('is-invalid');
            return;
        }

        const prec = parseInt(precE.value);
        
        const y = a + b * Math.log(x);

        outXVal.textContent = x.toString();
        outY.textContent = y.toFixed(prec);

        // Calculate line points
        const maxX = x * 1.5 < 10 ? 10 : x * 1.5;
        const lineData = [];
        const numPoints = 50;
        const step = maxX / numPoints;
        
        for (let i = 1; i <= numPoints; i++) {
            const currentX = i * step;
            lineData.push({x: currentX, y: a + b * Math.log(currentX)});
        }

        // Chart Update
        const ctx = document.getElementById('growthCanvas').getContext('2d');
        if (chartInstance) {
            chartInstance.destroy();
        }
        chartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                datasets: [{
                    label: 'Logarithmic Curve',
                    data: lineData,
                    borderColor: 'rgba(79, 70, 229, 1)',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    pointRadius: 0,
                    pointHoverRadius: 6
                },
                {
                    label: 'Evaluation Point',
                    data: [{x: x, y: y}],
                    backgroundColor: '#ef4444',
                    borderColor: '#ef4444',
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    showLine: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: false,
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom',
                        title: { display: true, text: 'Time (x)' }
                    },
                    y: {
                        title: { display: true, text: 'Value (y)' }
                    }
                },
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });

        // Math Update
        setTimeout(() => {
            const op = b < 0 ? '-' : '+';
            renderMath('math-equation', `y(x) = a + b \\ln(x)`);
            renderMath('math-step', `y(${x}) = ${a} ${op} ${Math.abs(b)} \\ln(${x}) = ${y.toFixed(prec)}`);
        }, 100);

        resultCard.classList.remove('d-none');
        resultCard.scrollIntoView({ behavior: 'smooth' });
    }

    btnCalculate.addEventListener('click', calculate);

    document.getElementById('btn-sample-fast').addEventListener('click', () => {
        aE.value = 5; bE.value = 15; xE.value = 20; calculate();
    });
    document.getElementById('btn-sample-slow').addEventListener('click', () => {
        aE.value = 100; bE.value = 2; xE.value = 50; calculate();
    });
    document.getElementById('btn-sample-decay').addEventListener('click', () => {
        aE.value = 50; bE.value = -10; xE.value = 30; calculate();
    });

    document.getElementById('btn-reset').addEventListener('click', () => {
        aE.value = "10"; bE.value = "5"; xE.value = "20";
        xE.classList.remove('is-invalid');
        resultCard.classList.add('d-none');
        if (chartInstance) {
            chartInstance.destroy();
            chartInstance = null;
        }
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\logarithmic-growth-calculator.blade.php ENDPATH**/ ?>