<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            
            <div class="p-3 rounded-4 mb-4" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3 letter-spacing-1"><i class="fas fa-magic text-primary me-2"></i>Quick Actions</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="btn-sample-1">High Variance</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="btn-sample-2">Low Variance</button>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-12">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Data Input</h6>
                        <div class="row g-3">
                            <div class="col-md-9">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Data Set (Comma separated)</label>
                                <textarea id="calc-data" class="form-control form-control-lg rounded-3" rows="3" placeholder="e.g., 3, 8, 8, 8, 8, 9, 9, 9, 9"></textarea>
                                <div class="invalid-feedback">Please enter valid numerical data.</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Decimals</label>
                                <select id="calc-precision" class="form-select form-select-lg rounded-3">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3" selected>3</option>
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
                    <i class="fas fa-calculator me-2"></i> Calculate MAD
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
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Deviation Analysis</h5>
                        <p class="text-muted small mb-0">Metrics and step-by-step breakdown</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center h-100">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Items (n)</div>
                        <div class="h4 fw-bold mb-0 text-dark" id="out-n">0</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center h-100">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Mean (&mu;)</div>
                        <div class="h4 fw-bold mb-0 text-primary" id="out-mean">0</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center h-100 border-primary">
                        <div class="small fw-bold text-uppercase text-primary mb-1">MAD</div>
                        <div class="h3 fw-bold mb-0 text-primary" id="out-mad">0</div>
                    </div>
                </div>
            </div>

            <div class="row g-4 align-items-start mb-4">
                <div class="col-lg-6">
                    <div class="p-4 rounded-4 bg-light border shadow-sm h-100 overflow-x-auto">
                        <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">
                            <i class="fas fa-table text-primary me-2"></i>Step-by-step Deviations
                        </h6>
                        <table class="table table-hover table-bordered mb-0 bg-white text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Data ($x_i$)</th>
                                    <th>Deviation ($x_i - \mu$)</th>
                                    <th>Absolute ($|x_i - \mu|$)</th>
                                </tr>
                            </thead>
                            <tbody id="out-table-body">
                            </tbody>
                            <tfoot class="table-light fw-bold">
                                <tr>
                                    <td colspan="2" class="text-end">Sum:</td>
                                    <td id="out-sum-abs">0</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 rounded-4 bg-light border shadow-sm h-100">
                        <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">
                            <i class="fas fa-square-root-variable text-primary me-2"></i>Underlying Formulas
                        </h6>
                        <div class="d-flex flex-column gap-3 overflow-x-auto">
                            <div id="math-mean"></div>
                            <div id="math-mad"></div>
                        </div>
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
    
    .table th { font-weight: 600; color: #475569; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
    .table td { color: #1e293b; vertical-align: middle; }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dataE = document.getElementById('calc-data');
    const precE = document.getElementById('calc-precision');
    
    const resultCard = document.getElementById('result-card');
    const outN = document.getElementById('out-n');
    const outMean = document.getElementById('out-mean');
    const outMad = document.getElementById('out-mad');
    const outSumAbs = document.getElementById('out-sum-abs');
    const outTableBody = document.getElementById('out-table-body');
    const btnCalculate = document.getElementById('btn-calculate');

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

        const prec = parseInt(precE.value);
        const n = rawData.length;
        
        // Mean
        const sum = rawData.reduce((acc, val) => acc + val, 0);
        const mean = sum / n;
        
        // MAD
        let sumAbsDev = 0;
        const tableHtml = [];
        
        rawData.forEach(val => {
            const dev = val - mean;
            const absDev = Math.abs(dev);
            sumAbsDev += absDev;
            
            // Limit table items to 100 to prevent browser lockup for large datasets
            if (tableHtml.length < 100) {
                tableHtml.push(`
                    <tr>
                        <td>${val}</td>
                        <td>${dev.toFixed(prec)}</td>
                        <td>${absDev.toFixed(prec)}</td>
                    </tr>
                `);
            }
        });

        if (n > 100) {
            tableHtml.push(`<tr><td colspan="3" class="text-muted fst-italic">... and ${n - 100} more items ...</td></tr>`);
        }

        const mad = sumAbsDev / n;

        outN.textContent = n;
        outMean.textContent = mean.toFixed(prec);
        outMad.textContent = mad.toFixed(prec);
        outSumAbs.textContent = sumAbsDev.toFixed(prec);
        outTableBody.innerHTML = tableHtml.join('');

        // Math Update
        setTimeout(() => {
            renderMath('math-mean', `\\mu = \\frac{\\sum x_i}{n} = \\frac{${sum.toFixed(prec)}}{${n}} = ${mean.toFixed(prec)}`);
            renderMath('math-mad', `\\text{MAD} = \\frac{\\sum |x_i - \\mu|}{n} = \\frac{${sumAbsDev.toFixed(prec)}}{${n}} = ${mad.toFixed(prec)}`);
        }, 100);

        resultCard.classList.remove('d-none');
        resultCard.scrollIntoView({ behavior: 'smooth' });
    }

    btnCalculate.addEventListener('click', calculate);

    document.getElementById('btn-sample-1').addEventListener('click', () => {
        dataE.value = "10, 50, 100, 150, 200, 500";
        calculate();
    });
    document.getElementById('btn-sample-2').addEventListener('click', () => {
        dataE.value = "10, 11, 10, 12, 11, 10, 11";
        calculate();
    });

    document.getElementById('btn-reset').addEventListener('click', () => {
        dataE.value = "";
        dataE.classList.remove('is-invalid');
        resultCard.classList.add('d-none');
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\mean-absolute-deviation-calculator.blade.php ENDPATH**/ ?>