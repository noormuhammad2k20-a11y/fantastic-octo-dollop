<div class="row g-4 sum-of-integers-modern">
    <!-- Input Section -->
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label-custom">Upper Limit (n)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-hashtag text-secondary"></i></span>
                            <input type="number" id="sum-n" class="form-control form-control-lg border-start-0" value="100" min="1" step="1" placeholder="e.g. 100">
                        </div>
                        <div class="form-text mt-2">Find the sum of all integers from 1 up to this value.</div>
                    </div>
                </div>

                <div class="row mt-4 g-3">
                    <div class="col-md-6">
                        <button class="btn btn-dark w-100 py-3 fw-bold rounded-3 shadow-sm" id="btn-calculate">
                            <i class="fas fa-calculator me-2"></i>Calculate Sum
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-light w-100 py-3 fw-bold rounded-3 border" id="btn-reset">
                            <i class="fas fa-redo me-2"></i>Reset
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-light w-100 py-3 fw-bold rounded-3 border" id="btn-copy">
                            <i class="fas fa-copy me-2"></i>Copy Results
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Output Section -->
    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue: 140; --tool-color: #059669; --tool-bg: rgba(16, 185, 129, 0.04);">
            <div class="output-hero">
                <span class="output-hero-label">Arithmetic Series Sum</span>
                <div class="output-hero-value" id="out-sum">0</div>
                <span class="output-hero-unit" id="out-summary">for n = 100</span>
            </div>

            <!-- Metric Grid -->
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Formula</span>
                        <span class="stat-card-value" style="font-size: 1rem;">$n(n+1)/2$</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Terms (n)</span>
                        <span class="stat-card-value" id="stat-n">100</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Last Term</span>
                        <span class="stat-card-value" id="stat-last">100</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Average</span>
                        <span class="stat-card-value" id="stat-avg">50.5</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const nInput = $('sum-n');
    const outSum = $('out-sum');
    const outSummary = $('out-summary');
    const statN = $('stat-n');
    const statLast = $('stat-last');
    const statAvg = $('stat-avg');
    const outputSection = $('output-section');

    function calculate() {
        const n = parseInt(nInput.value);
        if (isNaN(n) || n < 1) {
            outputSection.style.display = 'none';
            return;
        }

        // Logic: n(n+1)/2
        const sum = (n * (n + 1)) / 2;
        const average = sum / n;

        // UI Updates
        outSum.textContent = sum.toLocaleString();
        outSummary.textContent = `Sum of first ${n} integers`;
        statN.textContent = n.toLocaleString();
        statLast.textContent = n.toLocaleString();
        statAvg.textContent = average.toLocaleString(undefined, { maximumFractionDigits: 2 });

        outputSection.style.display = 'block';
    }

    $('btn-calculate').addEventListener('click', calculate);
    
    nInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') calculate();
    });

    $('btn-reset').addEventListener('click', () => {
        nInput.value = '100';
        outputSection.style.display = 'none';
        nInput.focus();
    });

    $('btn-copy').addEventListener('click', () => {
        const text = `Sum of first ${nInput.value} integers: ${outSum.textContent}`;
        navigator.clipboard.writeText(text).then(() => {
            const originalBtn = $('btn-copy').innerHTML;
            $('btn-copy').innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => $('btn-copy').innerHTML = originalBtn, 2000);
        });
    });
});
</script>

<style>
    .sum-of-integers-modern .calculator-card { background: #fff; border-radius: 24px; padding: 2.5rem; border: 1px solid #f1f5f9; box-shadow: 0 10px 40px rgba(0,0,0,0.03); }
    .sum-of-integers-modern .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--tool-color); background: var(--tool-bg); margin-bottom: 1.5rem; }
    .sum-of-integers-modern .form-label-custom { font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.75rem; display: block; }
    .sum-of-integers-modern .input-group-text { border-color: #e2e8f0; }
    .sum-of-integers-modern .form-control { border-color: #e2e8f0; font-weight: 600; color: #1e293b; }
    .sum-of-integers-modern .form-control:focus { border-color: var(--tool-color); box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1); }
    
    .math-display { padding: 1rem; background: #f8fafc; border-radius: 12px; margin: 1rem 0; font-size: 1.1rem; color: #1e293b; text-align: center; }
    .step-number { width: 32px; height: 32px; border-radius: 50%; background: var(--tool-color); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem; }
    .bg-primary-soft { background: rgba(5, 150, 105, 0.1); }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\sum-of-positive-integers-calculator.blade.php ENDPATH**/ ?>