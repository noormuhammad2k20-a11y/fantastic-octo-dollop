<div class="row g-4 avg-dev-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Dataset</label>
                    <textarea id="data-input" class="form-control form-control-lg font-monospace" rows="4" placeholder="e.g. 5, 10, 15, 20">5, 10, 15, 20</textarea>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill dev-quick" data-val="2, 4, 6, 8">Low Variance</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill dev-quick" data-val="1, 10, 50, 100">High Variance</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:45;--tool-color:#a16207;--tool-bg:rgba(234,179,8,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Mean Absolute Deviation (MAD)</span>
                <div class="output-hero-value" id="out-mad">5</div>
                <div class="mt-2 text-muted fw-bold" id="out-mean">Mean (x̄): 12.5</div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-list-ol me-2 text-warning"></i>Step-by-Step Deviation</h6>
            <div class="table-responsive bg-white border rounded-3 p-2">
                <table class="table table-sm table-hover mb-0 text-center small">
                    <thead class="table-light"><tr><th>Value (x)</th><th>Distance from Mean |x - x̄|</th></tr></thead>
                    <tbody id="out-table"></tbody>
                </table>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy MAD Result</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('data-input');
    const outMad = document.getElementById('out-mad');
    const outMean = document.getElementById('out-mean');
    const outTable = document.getElementById('out-table');

    function calculate(){
        const val = input.value;
        const numbers = val.split(/[,\s\n]+/).map(n => parseFloat(n.trim())).filter(n => !isNaN(n));

        if(numbers.length === 0){
            outMad.textContent = '—';
            outMean.textContent = 'Mean (x̄): —';
            outTable.innerHTML = '';
            return;
        }

        const sum = numbers.reduce((a, b) => a + b, 0);
        const mean = sum / numbers.length;
        
        const deviations = numbers.map(n => Math.abs(n - mean));
        const mad = deviations.reduce((a, b) => a + b, 0) / numbers.length;

        outMad.textContent = mad.toLocaleString(undefined, {maximumFractionDigits: 4});
        outMean.textContent = `Mean (x̄): ${mean.toLocaleString(undefined, {maximumFractionDigits: 4})}`;

        let html = "";
        numbers.forEach((n, i) => {
            html += `<tr><td>${n}</td><td class="text-danger fw-bold">${deviations[i].toLocaleString(undefined, {maximumFractionDigits: 4})}</td></tr>`;
        });
        outTable.innerHTML = html;
    }

    input.addEventListener('input', calculate);

    document.querySelectorAll('.dev-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            input.value = btn.dataset.val;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        navigator.clipboard.writeText(outMad.textContent);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.avg-dev-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.avg-dev-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.avg-dev-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.avg-dev-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.avg-dev-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.avg-dev-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.avg-dev-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.avg-dev-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.avg-dev-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.avg-dev-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

@media (max-width: 768px) {
    .avg-dev-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\average-deviation-calculator.blade.php ENDPATH**/ ?>