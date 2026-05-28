<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            
            <div class="p-3 rounded-4 mb-4" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3 letter-spacing-1"><i class="fas fa-magic text-primary me-2"></i>Quick Actions</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="btn-sample-pos">Positive Correlation</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="btn-sample-neg">Negative Correlation</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="btn-sample-none">No Correlation</button>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-12">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Data Input</h6>
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">X Values (Independent)</label>
                                <textarea id="calc-data-x" class="form-control form-control-lg rounded-3" rows="3" placeholder="e.g., 1, 2, 3, 4, 5"></textarea>
                                <div class="invalid-feedback">Invalid data or mismatched count.</div>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Y Values (Dependent)</label>
                                <textarea id="calc-data-y" class="form-control form-control-lg rounded-3" rows="3" placeholder="e.g., 2.5, 3.7, 5.1, 6.8, 8.0"></textarea>
                                <div class="invalid-feedback">Invalid data or mismatched count.</div>
                            </div>
                            <div class="col-md-2">
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
                    <i class="fas fa-chart-line me-2"></i> Generate Plot
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
                        <i class="fas fa-chart-line text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Regression Analysis</h5>
                        <p class="text-muted small mb-0">Trendline and correlation</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-12">
                    <div class="p-3 rounded-4 bg-white border shadow-sm text-center overflow-x-auto break-words" style="min-height: 400px;">
                        <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">Scatter Plot</h6>
                        <div style="position: relative; height: 350px; width: 100%;">
                            <canvas id="scatterCanvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Items (n)</div>
                        <div class="h4 fw-bold mb-0 text-dark" id="out-count">0</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Correlation (r)</div>
                        <div class="h4 fw-bold mb-0 text-primary" id="out-r">0</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Slope (m)</div>
                        <div class="h4 fw-bold mb-0 text-primary" id="out-slope">0</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Y-Intercept (b)</div>
                        <div class="h4 fw-bold mb-0 text-success" id="out-intercept">0</div>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 bg-light border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">
                    <i class="fas fa-square-root-variable text-primary me-2"></i>Linear Regression Model
                </h6>
                <div class="d-flex flex-column gap-3 overflow-x-auto">
                    <div id="math-equation"></div>
                    <div id="math-r2"></div>
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
    const dataXE = document.getElementById('calc-data-x');
    const dataYE = document.getElementById('calc-data-y');
    const precE = document.getElementById('calc-precision');
    
    const resultCard = document.getElementById('result-card');
    const outCount = document.getElementById('out-count');
    const outR = document.getElementById('out-r');
    const outSlope = document.getElementById('out-slope');
    const outIntercept = document.getElementById('out-intercept');
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
        dataXE.classList.remove('is-invalid');
        dataYE.classList.remove('is-invalid');
        
        const rawX = dataXE.value.split(/[\s,]+/).filter(x => x.trim() !== '').map(Number);
        const rawY = dataYE.value.split(/[\s,]+/).filter(x => x.trim() !== '').map(Number);
        
        if (rawX.length < 2 || rawX.some(isNaN) || rawY.length !== rawX.length || rawY.some(isNaN)) {
            dataXE.classList.add('is-invalid');
            dataYE.classList.add('is-invalid');
            return;
        }

        const prec = parseInt(precE.value);
        const n = rawX.length;
        
        let sumX = 0, sumY = 0, sumXY = 0, sumX2 = 0, sumY2 = 0;
        const chartData = [];
        
        for (let i = 0; i < n; i++) {
            const x = rawX[i];
            const y = rawY[i];
            sumX += x;
            sumY += y;
            sumXY += (x * y);
            sumX2 += (x * x);
            sumY2 += (y * y);
            chartData.push({x: x, y: y});
        }

        const meanX = sumX / n;
        const meanY = sumY / n;

        // Slope (m)
        const denominator = (n * sumX2 - sumX * sumX);
        const slope = denominator === 0 ? 0 : (n * sumXY - sumX * sumY) / denominator;
        
        // Intercept (b)
        const intercept = meanY - slope * meanX;

        // Correlation (r)
        const rDenom = Math.sqrt((n * sumX2 - sumX * sumX) * (n * sumY2 - sumY * sumY));
        const r = rDenom === 0 ? 0 : (n * sumXY - sumX * sumY) / rDenom;
        const r2 = r * r;

        outCount.textContent = n;
        outR.textContent = r.toFixed(prec);
        outSlope.textContent = slope.toFixed(prec);
        outIntercept.textContent = intercept.toFixed(prec);

        // Calculate line of best fit points
        const minX = Math.min(...rawX);
        const maxX = Math.max(...rawX);
        const lineData = [
            {x: minX, y: slope * minX + intercept},
            {x: maxX, y: slope * maxX + intercept}
        ];

        // Chart Update
        const ctx = document.getElementById('scatterCanvas').getContext('2d');
        if (chartInstance) {
            chartInstance.destroy();
        }
        chartInstance = new Chart(ctx, {
            type: 'scatter',
            data: {
                datasets: [{
                    label: 'Data Points',
                    data: chartData,
                    backgroundColor: 'rgba(79, 70, 229, 0.7)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    pointRadius: 6,
                    pointHoverRadius: 8
                },
                {
                    type: 'line',
                    label: 'Line of Best Fit',
                    data: lineData,
                    borderColor: 'rgba(239, 68, 68, 0.8)',
                    borderWidth: 2,
                    borderDash: [5, 5],
                    fill: false,
                    pointRadius: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: false,
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom'
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });

        // Math Update
        setTimeout(() => {
            const op = intercept < 0 ? '-' : '+';
            renderMath('math-equation', `y = ${slope.toFixed(prec)}x ${op} ${Math.abs(intercept).toFixed(prec)}`);
            renderMath('math-r2', `R^2 = ${r2.toFixed(prec)} \\quad (\\text{Coefficient of Determination})`);
        }, 100);

        resultCard.classList.remove('d-none');
        resultCard.scrollIntoView({ behavior: 'smooth' });
    }

    btnCalculate.addEventListener('click', calculate);

    document.getElementById('btn-sample-pos').addEventListener('click', () => {
        dataXE.value = "1, 2, 3, 4, 5, 6, 7, 8";
        dataYE.value = "2.1, 3.8, 6.2, 8.5, 9.9, 12.1, 14.5, 16.0";
        calculate();
    });
    document.getElementById('btn-sample-neg').addEventListener('click', () => {
        dataXE.value = "10, 20, 30, 40, 50, 60";
        dataYE.value = "95, 82, 65, 45, 30, 15";
        calculate();
    });
    document.getElementById('btn-sample-none').addEventListener('click', () => {
        dataXE.value = "1, 5, 2, 8, 3, 9, 4, 7";
        dataYE.value = "5, 1, 9, 2, 4, 8, 3, 7";
        calculate();
    });

    document.getElementById('btn-reset').addEventListener('click', () => {
        dataXE.value = "";
        dataYE.value = "";
        dataXE.classList.remove('is-invalid');
        dataYE.classList.remove('is-invalid');
        resultCard.classList.add('d-none');
        if (chartInstance) {
            chartInstance.destroy();
            chartInstance = null;
        }
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\scatter-plot-maker.blade.php ENDPATH**/ ?>