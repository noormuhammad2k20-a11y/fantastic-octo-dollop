<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            
            <div class="p-3 rounded-4 mb-4" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3 letter-spacing-1"><i class="fas fa-magic text-primary me-2"></i>Quick Actions</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="btn-sample-diff">Significant Difference</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="btn-sample-sim">Similar Groups</button>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-12">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Test Parameters</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Group 1 Data</label>
                                <textarea id="calc-g1" class="form-control form-control-lg rounded-3" rows="3" placeholder="e.g., 20, 22, 19, 24, 25"></textarea>
                                <div class="invalid-feedback">Requires at least 2 numbers.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Group 2 Data</label>
                                <textarea id="calc-g2" class="form-control form-control-lg rounded-3" rows="3" placeholder="e.g., 28, 30, 27, 29, 32"></textarea>
                                <div class="invalid-feedback">Requires at least 2 numbers.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Significance Level (&alpha;)</label>
                                <select id="calc-alpha" class="form-select form-select-lg rounded-3">
                                    <option value="0.01">0.01 (1%)</option>
                                    <option value="0.05" selected>0.05 (5%)</option>
                                    <option value="0.10">0.10 (10%)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Hypothesis</label>
                                <select id="calc-tails" class="form-select form-select-lg rounded-3">
                                    <option value="2" selected>Two-tailed (G1 &ne; G2)</option>
                                    <option value="1">One-tailed (G1 &gt; G2 or G1 &lt; G2)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-calculator me-2"></i> Run Test
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
                        <i class="fas fa-check-double text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Test Results</h5>
                        <p class="text-muted small mb-0">U-statistic and significance</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-12">
                    <div class="p-3 rounded-4 bg-white border shadow-sm text-center">
                        <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">Conclusion</h6>
                        <div class="h3 fw-bold mb-2" id="out-conclusion">Evaluating...</div>
                        <p class="text-muted mb-0" id="out-conclusion-sub"></p>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="p-3 rounded-4 bg-light border text-center h-100">
                        <div class="small fw-bold text-uppercase text-muted mb-1">U-Statistic</div>
                        <div class="h4 fw-bold mb-0 text-primary" id="out-u">0</div>
                        <div class="x-small text-muted mt-1" id="out-u-details"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-4 bg-light border text-center h-100">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Z-Score (Approx)</div>
                        <div class="h4 fw-bold mb-0 text-primary" id="out-z">0</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-4 bg-light border text-center h-100">
                        <div class="small fw-bold text-uppercase text-muted mb-1">P-Value</div>
                        <div class="h4 fw-bold mb-0 text-dark" id="out-p">0</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-4 bg-light border text-center h-100">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Mean Ranks</div>
                        <div class="x-small fw-bold text-secondary" id="out-mean-ranks"></div>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 bg-light border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">
                    <i class="fas fa-square-root-variable text-primary me-2"></i>Underlying Formulas
                </h6>
                <div class="d-flex flex-column gap-3 overflow-x-auto">
                    <div id="math-u1"></div>
                    <div id="math-u2"></div>
                    <div id="math-z"></div>
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
    .x-small { font-size: 0.75rem; }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const g1E = document.getElementById('calc-g1');
    const g2E = document.getElementById('calc-g2');
    const alphaE = document.getElementById('calc-alpha');
    const tailsE = document.getElementById('calc-tails');
    
    const resultCard = document.getElementById('result-card');
    const outConclusion = document.getElementById('out-conclusion');
    const outConclusionSub = document.getElementById('out-conclusion-sub');
    const outU = document.getElementById('out-u');
    const outUDetails = document.getElementById('out-u-details');
    const outZ = document.getElementById('out-z');
    const outP = document.getElementById('out-p');
    const outMeanRanks = document.getElementById('out-mean-ranks');
    const btnCalculate = document.getElementById('btn-calculate');

    function renderMath(elementId, formula) {
        if (typeof katex !== 'undefined') {
            katex.render(formula, document.getElementById(elementId), {
                throwOnError: false,
                displayMode: true
            });
        }
    }

    // Normal CDF approximation for p-value
    function normalCDF(x) {
        let t = 1 / (1 + 0.2316419 * Math.abs(x));
        let d = 0.3989423 * Math.exp(-x * x / 2);
        let prob = d * t * (0.3193815 + t * (-0.3565638 + t * (1.781478 + t * (-1.821256 + t * 1.330274))));
        if (x > 0) prob = 1 - prob;
        return prob;
    }

    function calculate() {
        g1E.classList.remove('is-invalid');
        g2E.classList.remove('is-invalid');
        
        const arr1 = g1E.value.split(/[\s,]+/).filter(x => x.trim() !== '').map(Number);
        const arr2 = g2E.value.split(/[\s,]+/).filter(x => x.trim() !== '').map(Number);
        
        if (arr1.length < 2 || arr1.some(isNaN)) g1E.classList.add('is-invalid');
        if (arr2.length < 2 || arr2.some(isNaN)) g2E.classList.add('is-invalid');
        
        if (g1E.classList.contains('is-invalid') || g2E.classList.contains('is-invalid')) return;

        const n1 = arr1.length;
        const n2 = arr2.length;
        const alpha = parseFloat(alphaE.value);
        const tails = parseInt(tailsE.value);

        // Combine and rank
        const combined = [];
        arr1.forEach(v => combined.push({val: v, group: 1}));
        arr2.forEach(v => combined.push({val: v, group: 2}));
        
        combined.sort((a, b) => a.val - b.val);

        // Assign ranks with tie handling
        let i = 0;
        while (i < combined.length) {
            let j = i;
            while (j < combined.length && combined[j].val === combined[i].val) {
                j++;
            }
            let rankSum = 0;
            for (let k = i; k < j; k++) rankSum += (k + 1);
            let avgRank = rankSum / (j - i);
            for (let k = i; k < j; k++) combined[k].rank = avgRank;
            i = j;
        }

        let r1 = 0, r2 = 0;
        combined.forEach(item => {
            if (item.group === 1) r1 += item.rank;
            else r2 += item.rank;
        });

        const u1 = n1 * n2 + (n1 * (n1 + 1)) / 2 - r1;
        const u2 = n1 * n2 + (n2 * (n2 + 1)) / 2 - r2;
        const u = Math.min(u1, u2);

        // Z-score approximation
        const meanU = (n1 * n2) / 2;
        // Tie correction could be added here for highly rigorous stats, but simple variance is:
        const varU = (n1 * n2 * (n1 + n2 + 1)) / 12;
        const stdU = Math.sqrt(varU);
        const z = (u - meanU) / stdU;

        // P-value
        let p = normalCDF(z);
        if (tails === 2) p = p * 2;
        
        // Output format
        outU.textContent = u;
        outUDetails.innerHTML = `U&#8321;: ${u1} | U&#8322;: ${u2}`;
        outZ.textContent = z.toFixed(3);
        outP.textContent = p < 0.0001 ? '< 0.0001' : p.toFixed(4);
        outMeanRanks.innerHTML = `G1: ${(r1/n1).toFixed(1)}<br>G2: ${(r2/n2).toFixed(1)}`;

        if (p <= alpha) {
            outConclusion.textContent = 'Significant Difference';
            outConclusion.className = 'h3 fw-bold mb-2 text-success';
            outConclusionSub.innerHTML = `The test <strong>rejects</strong> the null hypothesis (p &le; ${alpha}).`;
        } else {
            outConclusion.textContent = 'No Significant Difference';
            outConclusion.className = 'h3 fw-bold mb-2 text-danger';
            outConclusionSub.innerHTML = `The test <strong>fails to reject</strong> the null hypothesis (p &gt; ${alpha}).`;
        }

        // Math Update
        setTimeout(() => {
            renderMath('math-u1', `U_1 = n_1 n_2 + \\frac{n_1(n_1+1)}{2} - R_1 = ${n1}(${n2}) + \\frac{${n1}(${n1+1})}{2} - ${r1} = ${u1}`);
            renderMath('math-u2', `U_2 = n_1 n_2 + \\frac{n_2(n_2+1)}{2} - R_2 = ${n1}(${n2}) + \\frac{${n2}(${n2+1})}{2} - ${r2} = ${u2}`);
            renderMath('math-z', `Z = \\frac{U - \\mu_U}{\\sigma_U} \\approx ${z.toFixed(3)}`);
        }, 100);

        resultCard.classList.remove('d-none');
        resultCard.scrollIntoView({ behavior: 'smooth' });
    }

    btnCalculate.addEventListener('click', calculate);

    document.getElementById('btn-sample-diff').addEventListener('click', () => {
        g1E.value = "10, 12, 14, 15, 11, 13";
        g2E.value = "25, 28, 22, 29, 30, 26";
        calculate();
    });
    document.getElementById('btn-sample-sim').addEventListener('click', () => {
        g1E.value = "15, 17, 14, 18, 16, 15";
        g2E.value = "14, 16, 15, 17, 18, 16";
        calculate();
    });

    document.getElementById('btn-reset').addEventListener('click', () => {
        g1E.value = ""; g2E.value = "";
        g1E.classList.remove('is-invalid'); g2E.classList.remove('is-invalid');
        resultCard.classList.add('d-none');
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\mann-whitney-u-test-calculator.blade.php ENDPATH**/ ?>