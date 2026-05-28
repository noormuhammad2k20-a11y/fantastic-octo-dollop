<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            
            <div class="p-3 rounded-4 mb-4" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3 letter-spacing-1"><i class="fas fa-magic text-primary me-2"></i>Quick Actions</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="btn-sample-normal">Normal Distribution</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="btn-sample-skewed">Skewed Data</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="btn-sample-bimodal">Bimodal Data</button>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-12">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Data Input</h6>
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Data Set (Comma separated)</label>
                                <textarea id="calc-data" class="form-control form-control-lg rounded-3" rows="3" placeholder="e.g., 2, 4, 4, 5, 5, 5, 6, 6, 7, 9"></textarea>
                                <div class="invalid-feedback">Please enter valid numerical data.</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Number of Bins</label>
                                <select id="calc-bins" class="form-select form-select-lg rounded-3">
                                    <option value="auto">Auto (Sturges' Formula)</option>
                                    <option value="5">5 Bins</option>
                                    <option value="10">10 Bins</option>
                                    <option value="15">15 Bins</option>
                                    <option value="20">20 Bins</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-chart-line me-2"></i> Generate Histogram
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
                        <h5 class="mb-0 fw-bold text-dark">Frequency Distribution</h5>
                        <p class="text-muted small mb-0">Visual analysis</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-12">
                    <div class="p-3 rounded-4 bg-white border shadow-sm text-center overflow-x-auto break-words" style="min-height: 400px;">
                        <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">Histogram Chart</h6>
                        <div style="position: relative; height: 350px; width: 100%;">
                            <canvas id="histogramCanvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Total Items (n)</div>
                        <div class="h4 fw-bold mb-0 text-primary" id="out-count">0</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Mean</div>
                        <div class="h4 fw-bold mb-0 text-primary" id="out-mean">0</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Bin Width</div>
                        <div class="h4 fw-bold mb-0 text-success" id="out-width">0</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Range</div>
                        <div class="h4 fw-bold mb-0 text-primary" id="out-range">0</div>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 bg-light border shadow-sm overflow-x-auto">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">
                    <i class="fas fa-table text-primary me-2"></i>Frequency Table
                </h6>
                <table class="table table-hover table-bordered mb-0 bg-white">
                    <thead class="table-light">
                        <tr>
                            <th>Bin Range</th>
                            <th>Frequency</th>
                            <th>Relative Frequency</th>
                        </tr>
                    </thead>
                    <tbody id="out-table-body">
                    </tbody>
                </table>
            </div>

            <div class="p-4 rounded-4 bg-light border shadow-sm mt-4">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">
                    <i class="fas fa-square-root-variable text-primary me-2"></i>Sturges' Rule (Auto Bins)
                </h6>
                <div class="d-flex flex-column gap-3 overflow-x-auto">
                    <div id="math-sturges"></div>
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
    
    .table th { font-weight: 600; color: #475569; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
    .table td { color: #1e293b; vertical-align: middle; }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dataE = document.getElementById('calc-data');
    const binsE = document.getElementById('calc-bins');
    
    const resultCard = document.getElementById('result-card');
    const outCount = document.getElementById('out-count');
    const outMean = document.getElementById('out-mean');
    const outWidth = document.getElementById('out-width');
    const outRange = document.getElementById('out-range');
    const outTableBody = document.getElementById('out-table-body');
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
        
        if (rawData.length < 2 || rawData.some(isNaN)) {
            dataE.classList.add('is-invalid');
            return;
        }

        const data = rawData.sort((a, b) => a - b);
        const min = data[0];
        const max = data[data.length - 1];
        const count = data.length;
        const mean = data.reduce((a, b) => a + b, 0) / count;
        const dataRange = max - min;

        let numBins = binsE.value === 'auto' ? Math.ceil(1 + 3.322 * Math.log10(count)) : parseInt(binsE.value);
        if (numBins < 1) numBins = 1;
        
        let binWidth = dataRange / numBins;
        // Avoid width 0
        if (binWidth === 0) binWidth = 1;

        const bins = Array(numBins).fill(0);
        const labels = [];
        const tableHtml = [];

        for (let i = 0; i < numBins; i++) {
            const start = min + (i * binWidth);
            const end = i === numBins - 1 ? max : min + ((i + 1) * binWidth);
            labels.push(`${start.toFixed(1)} - ${end.toFixed(1)}`);
        }

        data.forEach(val => {
            let binIndex = Math.floor((val - min) / binWidth);
            if (binIndex >= numBins) binIndex = numBins - 1; // inclusive upper bound
            bins[binIndex]++;
        });

        for (let i = 0; i < numBins; i++) {
            const relFreq = (bins[i] / count) * 100;
            tableHtml.push(`
                <tr>
                    <td>${labels[i]}</td>
                    <td class="fw-bold">${bins[i]}</td>
                    <td>${relFreq.toFixed(1)}%</td>
                </tr>
            `);
        }

        outCount.textContent = count;
        outMean.textContent = mean.toFixed(2);
        outWidth.textContent = binWidth.toFixed(2);
        outRange.textContent = dataRange.toFixed(2);
        outTableBody.innerHTML = tableHtml.join('');

        // Chart Update
        const ctx = document.getElementById('histogramCanvas').getContext('2d');
        if (chartInstance) {
            chartInstance.destroy();
        }
        chartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Frequency',
                    data: bins,
                    backgroundColor: 'rgba(79, 70, 229, 0.7)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 1,
                    barPercentage: 1.0,
                    categoryPercentage: 1.0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: false,
                scales: {
                    x: {
                        grid: { display: false }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // Math Update
        setTimeout(() => {
            renderMath('math-sturges', `k = 1 + 3.322 \\log_{10}(n) = 1 + 3.322 \\log_{10}(${count}) \\approx ${Math.ceil(1 + 3.322 * Math.log10(count))}`);
        }, 100);

        resultCard.classList.remove('d-none');
        resultCard.scrollIntoView({ behavior: 'smooth' });
    }

    btnCalculate.addEventListener('click', calculate);

    document.getElementById('btn-sample-normal').addEventListener('click', () => {
        dataE.value = Array.from({length: 100}, () => {
            let u = 0, v = 0;
            while(u === 0) u = Math.random(); //Converting [0,1) to (0,1)
            while(v === 0) v = Math.random();
            return Math.round((Math.sqrt( -2.0 * Math.log( u ) ) * Math.cos( 2.0 * Math.PI * v )) * 10 + 50);
        }).join(', ');
        calculate();
    });
    
    document.getElementById('btn-sample-skewed').addEventListener('click', () => {
        dataE.value = "1, 2, 2, 3, 3, 3, 4, 4, 5, 6, 8, 10, 15, 22";
        calculate();
    });

    document.getElementById('btn-sample-bimodal').addEventListener('click', () => {
        dataE.value = "10, 12, 11, 10, 13, 11, 35, 36, 34, 38, 35, 36";
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
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\histogram-maker.blade.php ENDPATH**/ ?>