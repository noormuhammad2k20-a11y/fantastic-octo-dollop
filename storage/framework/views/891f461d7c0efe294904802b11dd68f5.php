<div class="row g-4 five-num-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Dataset</label>
                    <textarea id="data-input" class="form-control form-control-lg font-monospace" rows="4" placeholder="e.g. 10, 20, 30, 40, 50, 60, 70">10, 20, 30, 40, 50, 60, 70</textarea>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill fn-quick" data-val="5, 12, 18, 24, 30, 45, 60">Odd Count</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill fn-quick" data-val="10, 20, 30, 40, 50, 60">Even Count</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:45;--tool-color:#a16207;--tool-bg:rgba(234,179,8,.04);">
            <div class="output-hero">
                <span class="output-hero-label">The Summary</span>
                <div class="mt-4">
                    <div class="row g-2">
                        <div class="col"><div class="stat-card border-warning py-3"><span class="stat-card-label">Min</span><span class="stat-card-value fs-4" id="out-min">10</span></div></div>
                        <div class="col"><div class="stat-card border-warning py-3"><span class="stat-card-label">Q1</span><span class="stat-card-value fs-4" id="out-q1">20</span></div></div>
                        <div class="col"><div class="stat-card border-warning py-3"><span class="stat-card-label">Med</span><span class="stat-card-value fs-4" id="out-med">40</span></div></div>
                        <div class="col"><div class="stat-card border-warning py-3"><span class="stat-card-label">Q3</span><span class="stat-card-value fs-4" id="out-q3">60</span></div></div>
                        <div class="col"><div class="stat-card border-warning py-3"><span class="stat-card-label">Max</span><span class="stat-card-value fs-4" id="out-max">70</span></div></div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Range</span>
                        <span class="stat-card-value" id="out-range">60</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">IQR</span>
                        <span class="stat-card-value" id="out-iqr">40</span>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-grip-lines me-2 text-warning"></i>Box Plot Analysis</h6>
            <div class="bg-white border rounded-3 p-4">
                <div class="position-relative" style="height: 40px; background: #f1f5f9; border-radius: 20px;">
                    <div id="box-plot-range" style="position: absolute; height: 4px; background: #a16207; top: 18px; left: 0; right: 0;"></div>
                    <div id="box-plot-box" style="position: absolute; height: 20px; background: rgba(234,179,8,.3); border: 2px solid #a16207; top: 10px; left: 25%; right: 25%;"></div>
                    <div id="box-plot-med" style="position: absolute; height: 30px; width: 3px; background: #a16207; top: 5px; left: 50%;"></div>
                </div>
                <div class="d-flex justify-content-between mt-2 x-small text-muted">
                    <span>Min</span>
                    <span>Q1</span>
                    <span>Median</span>
                    <span>Q3</span>
                    <span>Max</span>
                </div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Five-Number Summary</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('data-input');
    const outMin = document.getElementById('out-min');
    const outQ1 = document.getElementById('out-q1');
    const outMed = document.getElementById('out-med');
    const outQ3 = document.getElementById('out-q3');
    const outMax = document.getElementById('out-max');
    const outRange = document.getElementById('out-range');
    const outIqr = document.getElementById('out-iqr');
    
    const bRange = document.getElementById('box-plot-range');
    const bBox = document.getElementById('box-plot-box');
    const bMed = document.getElementById('box-plot-med');

    function getMedian(arr){
        const n = arr.length;
        if(n === 0) return 0;
        if(n % 2 === 0) return (arr[n/2 - 1] + arr[n/2]) / 2;
        return arr[Math.floor(n/2)];
    }

    function calculate(){
        const val = input.value;
        const numbers = val.split(/[,\s\n]+/).map(n => parseFloat(n.trim())).filter(n => !isNaN(n));

        if(numbers.length < 4){
            reset();
            return;
        }

        const sorted = numbers.sort((a, b) => a - b);
        const min = sorted[0];
        const max = sorted[sorted.length - 1];
        const med = getMedian(sorted);
        
        const mid = Math.floor(sorted.length / 2);
        let q1, q3;
        if(sorted.length % 2 === 0){
            q1 = getMedian(sorted.slice(0, mid));
            q3 = getMedian(sorted.slice(mid));
        } else {
            q1 = getMedian(sorted.slice(0, mid));
            q3 = getMedian(sorted.slice(mid + 1));
        }

        const iqr = q3 - q1;
        const range = max - min;

        outMin.textContent = min.toLocaleString();
        outMax.textContent = max.toLocaleString();
        outMed.textContent = med.toLocaleString();
        outQ1.textContent = q1.toLocaleString();
        outQ3.textContent = q3.toLocaleString();
        outRange.textContent = range.toLocaleString();
        outIqr.textContent = iqr.toLocaleString();

        // Visual Map
        const getPct = (v) => ((v - min) / range) * 100;
        bRange.style.left = getPct(min) + '%';
        bRange.style.width = (getPct(max) - getPct(min)) + '%';
        bBox.style.left = getPct(q1) + '%';
        bBox.style.width = (getPct(q3) - getPct(q1)) + '%';
        bMed.style.left = getPct(med) + '%';
    }

    function reset(){
        [outMin, outQ1, outMed, outQ3, outMax, outRange, outIqr].forEach(el => el.textContent = '—');
    }

    input.addEventListener('input', calculate);

    document.querySelectorAll('.fn-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            input.value = btn.dataset.val;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        const text = `Five-Number Summary\nMin: ${outMin.textContent}\nQ1: ${outQ1.textContent}\nMedian: ${outMed.textContent}\nQ3: ${outQ3.textContent}\nMax: ${outMax.textContent}`;
        navigator.clipboard.writeText(text);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.five-num-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.five-num-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.five-num-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.five-num-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.five-num-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.five-num-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.five-num-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.five-num-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.five-num-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }

.five-num-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; text-align: center; }
.five-num-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.five-num-rebuilt .stat-card-value { font-weight: 900; color: #1e293b; }

.x-small { font-size: 0.65rem; }
@media (max-width: 768px) {
    .five-num-rebuilt .stat-card-value { font-size: 1rem !important; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\five-number-summary-calculator.blade.php ENDPATH**/ ?>