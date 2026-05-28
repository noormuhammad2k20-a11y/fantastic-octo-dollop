<div class="row g-4 collatz-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Starting Number (n)</label>
                    <input type="number" id="n-input" class="form-control form-control-lg" value="27" min="1">
                    <div class="mt-2 d-flex gap-2">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill collatz-quick" data-val="7">7 (16 steps)</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill collatz-quick" data-val="27">27 (111 steps)</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill collatz-quick" data-val="871">871 (178 steps)</button>
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-danger me-1"></i> <strong>Rules:</strong> If even, divide by 2 (n/2). If odd, triple and add one (3n+1).
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(239,68,68,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Total Steps</span>
                <div class="output-hero-value" id="out-steps">111</div>
                <div class="mt-2 text-muted fw-bold" id="out-peak">Peak Value: 9,232</div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-line me-2 text-danger"></i>Visualization Path</h6>
            <div class="bg-white border rounded-3 p-3 overflow-auto" style="max-height: 400px;">
                <div id="out-path" class="d-flex flex-wrap gap-2">
                    
                </div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Sequence Path</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const nInput = document.getElementById('n-input');
    const outSteps = document.getElementById('out-steps');
    const outPeak = document.getElementById('out-peak');
    const outPath = document.getElementById('out-path');

    function calculate(){
        let n = parseInt(nInput.value);
        if(isNaN(n) || n < 1) return;

        let path = [n];
        let steps = 0;
        let peak = n;

        while(n > 1 && steps < 1000){ // Safety limit
            if(n % 2 === 0){
                n = n / 2;
            } else {
                n = 3 * n + 1;
            }
            path.push(n);
            if(n > peak) peak = n;
            steps++;
        }

        outSteps.textContent = steps;
        outPeak.textContent = `Peak Value: ${peak.toLocaleString()}`;

        outPath.innerHTML = path.map((val, i) => `
            <div class="d-flex align-items-center">
                <div class="badge ${val===1?'bg-danger':'bg-light text-dark'} border p-2 font-monospace">
                    <span class="text-muted small me-1">#${i}:</span> ${val.toLocaleString()}
                </div>
                ${i < path.length - 1 ? '<i class="fas fa-chevron-right mx-1 text-muted" style="font-size:0.7rem"></i>' : ''}
            </div>
        `).join('');
    }

    nInput.addEventListener('input', calculate);

    document.querySelectorAll('.collatz-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            nInput.value = btn.dataset.val;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        const text = Array.from(outPath.querySelectorAll('.badge')).map(b => b.innerText).join(' -> ');
        navigator.clipboard.writeText(text);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.collatz-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.collatz-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.collatz-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.collatz-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.collatz-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.collatz-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.collatz-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.collatz-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.collatz-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.collatz-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

@media (max-width: 768px) {
    .collatz-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\collatz-conjecture-calculator.blade.php ENDPATH**/ ?>