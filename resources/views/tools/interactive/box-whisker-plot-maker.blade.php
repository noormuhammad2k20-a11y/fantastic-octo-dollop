<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            {{-- Quick Actions --}}
            <div class="p-3 rounded-4 mb-4" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3 letter-spacing-1"><i class="fas fa-magic text-primary me-2"></i>Quick Actions</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="btn-sample-small">Load Small Sample</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="btn-sample-wide">Load Wide Spread</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="btn-sample-close">Load Close Range</button>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-12">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Data Input</h6>
                        <div class="row g-3">
                            <div class="col-md-9">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Data Set (Comma separated numbers)</label>
                                <textarea id="calc-data" class="form-control form-control-lg rounded-3" rows="3" placeholder="e.g., 12, 15, 17, 18, 20, 22, 25, 30"></textarea>
                                <div class="invalid-feedback">Please enter valid numerical data.</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Decimal Places</label>
                                <select id="calc-precision" class="form-select form-select-lg rounded-3">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2" selected>2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
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

    {{-- Result Card --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-chart-pie text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Plot & Five-Number Summary</h5>
                        <p class="text-muted small mb-0">Distribution analysis</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-12">
                    <div class="p-3 rounded-4 bg-white border shadow-sm text-center overflow-x-auto break-words">
                        <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">Visualization</h6>
                        <div style="position: relative; height: 350px; width: 100%;">
                            <canvas id="boxPlotCanvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Minimum</div>
                        <div class="h4 fw-bold mb-0 text-primary" id="out-min">0</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">First Quartile (Q1)</div>
                        <div class="h4 fw-bold mb-0 text-primary" id="out-q1">0</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Median (Q2)</div>
                        <div class="h4 fw-bold mb-0 text-success" id="out-median">0</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Third Quartile (Q3)</div>
                        <div class="h4 fw-bold mb-0 text-primary" id="out-q3">0</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Maximum</div>
                        <div class="h4 fw-bold mb-0 text-primary" id="out-max">0</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Interquartile Range (IQR)</div>
                        <div class="h4 fw-bold mb-0 text-dark" id="out-iqr">0</div>
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
<script src="https://cdn.jsdelivr.net/npm/@sgratzl/chartjs-chart-boxplot"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dataE = document.getElementById('calc-data');
    const precE = document.getElementById('calc-precision');
    
    const resultCard = document.getElementById('result-card');
    const outMin = document.getElementById('out-min');
    const outQ1 = document.getElementById('out-q1');
    const outMedian = document.getElementById('out-median');
    const outQ3 = document.getElementById('out-q3');
    const outMax = document.getElementById('out-max');
    const outIqr = document.getElementById('out-iqr');
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
        dataE.classList.remove('is-invalid');
        const rawData = dataE.value.split(/[\s,]+/).filter(x => x.trim() !== '').map(Number);
        
        if (rawData.length < 4 || rawData.some(isNaN)) {
            dataE.classList.add('is-invalid');
            return;
        }

        const prec = parseInt(precE.value);
        const data = rawData.sort((a, b) => a - b);
        
        const min = data[0];
        const max = data[data.length - 1];

        const getMedian = (arr) => {
            const mid = Math.floor(arr.length / 2);
            return arr.length % 2 !== 0 ? arr[mid] : (arr[mid - 1] + arr[mid]) / 2;
        };

        const median = getMedian(data);
        const lowerHalf = data.slice(0, Math.floor(data.length / 2));
        const upperHalf = data.slice(Math.ceil(data.length / 2));
        
        const q1 = getMedian(lowerHalf);
        const q3 = getMedian(upperHalf);
        const iqr = q3 - q1;
        
        const lowerBound = q1 - 1.5 * iqr;
        const upperBound = q3 + 1.5 * iqr;

        outMin.textContent = min.toFixed(prec);
        outQ1.textContent = q1.toFixed(prec);
        outMedian.textContent = median.toFixed(prec);
        outQ3.textContent = q3.toFixed(prec);
        outMax.textContent = max.toFixed(prec);
        outIqr.textContent = iqr.toFixed(prec);

        // Chart Update
        const ctx = document.getElementById('boxPlotCanvas').getContext('2d');
        if (chartInstance) {
            chartInstance.destroy();
        }
        chartInstance = new Chart(ctx, {
            type: 'boxplot',
            data: {
                labels: ['Data Set'],
                datasets: [{
                    label: 'Distribution',
                    backgroundColor: 'rgba(79, 70, 229, 0.2)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 2,
                    outlierColor: '#ef4444',
                    padding: 10,
                    itemRadius: 3,
                    data: [data]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: false,
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // Math Update
        setTimeout(() => {
            renderMath('math-iqr', `\\text{IQR} = Q_3 - Q_1 = ${q3.toFixed(prec)} - ${q1.toFixed(prec)} = ${iqr.toFixed(prec)}`);
            renderMath('math-lower', `\\text{Lower Bound} = Q_1 - 1.5 \\times \\text{IQR} = ${q1.toFixed(prec)} - 1.5 \\times ${iqr.toFixed(prec)} = ${lowerBound.toFixed(prec)}`);
            renderMath('math-upper', `\\text{Upper Bound} = Q_3 + 1.5 \\times \\text{IQR} = ${q3.toFixed(prec)} + 1.5 \\times ${iqr.toFixed(prec)} = ${upperBound.toFixed(prec)}`);
        }, 100);

        resultCard.classList.remove('d-none');
        resultCard.scrollIntoView({ behavior: 'smooth' });
    }

    btnCalculate.addEventListener('click', calculate);

    document.getElementById('btn-sample-small').addEventListener('click', () => {
        dataE.value = "5, 7, 8, 12, 14, 18";
        calculate();
    });
    document.getElementById('btn-sample-wide').addEventListener('click', () => {
        dataE.value = "1, 10, 50, 100, 200, 500";
        calculate();
    });
    document.getElementById('btn-sample-close').addEventListener('click', () => {
        dataE.value = "10, 11, 10, 12, 11, 10.5";
        calculate();
    });

    document.getElementById('btn-reset').addEventListener('click', () => {
        dataE.value = "";
        dataE.classList.remove('is-invalid');
        resultCard.classList.add('d-none');
        if (chartInstance) {
            chartInstance.destroy();
            chartInstance = null;
        }
    });
});
</script>
