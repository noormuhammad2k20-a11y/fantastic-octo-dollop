<div class="row g-4 mmm-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Dataset (comma or space separated)</label>
                    <textarea id="data-input" class="form-control form-control-lg font-monospace" rows="5" placeholder="e.g. 4, 8, 15, 16, 23, 42">4, 8, 15, 16, 23, 42</textarea>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill mmm-quick" data-val="1, 2, 2, 3, 4">Simple Mode</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill mmm-quick" data-val="10, 20, 30, 40, 50, 60">Even Count</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill mmm-quick" data-val="5, 15, 5, 20, 15, 30">Bi-modal</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:230;--tool-color:#4f46e5;--tool-bg:rgba(99,102,241,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Primary Results</span>
                <div class="row g-3 mt-2">
                    <div class="col-md-4">
                        <div class="stat-card border-primary shadow-sm">
                            <span class="stat-card-label">Mean (Average)</span>
                            <span class="stat-card-value text-primary fs-3" id="out-mean">20.67</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card border-primary shadow-sm">
                            <span class="stat-card-label">Median (Middle)</span>
                            <span class="stat-card-value text-primary fs-3" id="out-median">15.5</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card border-primary shadow-sm">
                            <span class="stat-card-label">Mode (Common)</span>
                            <span class="stat-card-value text-primary fs-3" id="out-mode">None</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-3"><div class="stat-card py-2"><span class="stat-card-label">Range</span><span class="stat-card-value small" id="out-range">38</span></div></div>
                <div class="col-md-3"><div class="stat-card py-2"><span class="stat-card-label">Min</span><span class="stat-card-value small" id="out-min">4</span></div></div>
                <div class="col-md-3"><div class="stat-card py-2"><span class="stat-card-label">Max</span><span class="stat-card-value small" id="out-max">42</span></div></div>
                <div class="col-md-3"><div class="stat-card py-2"><span class="stat-card-label">Count</span><span class="stat-card-value small" id="out-count">6</span></div></div>
            </div>



            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Full Summary</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('data-input');
    const outMean = document.getElementById('out-mean');
    const outMedian = document.getElementById('out-median');
    const outMode = document.getElementById('out-mode');
    const outRange = document.getElementById('out-range');
    const outMin = document.getElementById('out-min');
    const outMax = document.getElementById('out-max');
    const outCount = document.getElementById('out-count');
    const outSorted = document.getElementById('out-sorted');

    function calculate(){
        const val = input.value;
        const numbers = val.split(/[,\s\n]+/).map(n => parseFloat(n.trim())).filter(n => !isNaN(n));

        if(numbers.length === 0){
            reset();
            return;
        }

        const n = numbers.length;
        const sorted = [...numbers].sort((a, b) => a - b);
        
        // Mean
        const mean = numbers.reduce((a, b) => a + b, 0) / n;

        // Median
        let median;
        if(n % 2 === 0){
            median = (sorted[n/2 - 1] + sorted[n/2]) / 2;
        } else {
            median = sorted[Math.floor(n/2)];
        }

        // Mode
        const freq = {};
        numbers.forEach(num => freq[num] = (freq[num] || 0) + 1);
        let maxFreq = 0;
        let modes = [];
        for(let key in freq){
            if(freq[key] > maxFreq){
                maxFreq = freq[key];
                modes = [key];
            } else if(freq[key] === maxFreq && maxFreq > 1){
                modes.push(key);
            }
        }
        const modeText = (maxFreq <= 1) ? 'None' : modes.join(', ');

        // Range
        const min = sorted[0];
        const max = sorted[n-1];
        const range = max - min;

        outMean.textContent = mean.toLocaleString(undefined, {maximumFractionDigits: 4});
        outMedian.textContent = median.toLocaleString(undefined, {maximumFractionDigits: 4});
        outMode.textContent = modeText;
        outRange.textContent = range.toLocaleString();
        outMin.textContent = min.toLocaleString();
        outMax.textContent = max.toLocaleString();
        outCount.textContent = n;


    }

    function reset(){
        [outMean, outMedian, outMode, outRange, outMin, outMax, outCount].forEach(el => el.textContent = '—');
        outSorted.innerHTML = '';
    }

    input.addEventListener('input', calculate);

    document.querySelectorAll('.mmm-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            input.value = btn.dataset.val;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        const text = `Stats Summary\nMean: ${outMean.textContent}\nMedian: ${outMedian.textContent}\nMode: ${outMode.textContent}\nRange: ${outRange.textContent}`;
        navigator.clipboard.writeText(text);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.mmm-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.mmm-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.mmm-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.mmm-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.mmm-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.mmm-calc-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.mmm-calc-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.mmm-calc-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.mmm-calc-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }

.mmm-calc-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; text-align: center; }
.mmm-calc-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.mmm-calc-rebuilt .stat-card-value { font-weight: 900; color: #1e293b; }

@media (max-width: 768px) {
    .mmm-calc-rebuilt .stat-card-value { font-size: 1.5rem !important; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\mean-median-mode-calculator.blade.php ENDPATH**/ ?>