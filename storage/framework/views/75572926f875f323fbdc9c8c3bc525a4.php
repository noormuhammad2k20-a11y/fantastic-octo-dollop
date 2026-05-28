<div class="row g-4 ratio-to-percent-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3 align-items-center">
                    <div class="col">
                        <label class="form-label-custom">Part (A)</label>
                        <input type="number" id="v1" class="form-control form-control-lg text-center" placeholder="e.g. 1" value="1" step="any">
                    </div>
                    <div class="col-auto pt-4">
                        <span class="fs-4 fw-bold text-muted">:</span>
                    </div>
                    <div class="col">
                        <label class="form-label-custom">Whole (B)</label>
                        <input type="number" id="v2" class="form-control form-control-lg text-center" placeholder="e.g. 4" value="4" step="any">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill ratio-quick" data-v1="1" data-v2="2">1:2 (50%)</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill ratio-quick" data-v1="3" data-v2="4">3:4 (75%)</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill ratio-quick" data-v1="1" data-v2="5">1:5 (20%)</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill ratio-quick" data-v1="1" data-v2="10">1:10 (10%)</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:150;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Equivalent Percentage</span>
                <div class="output-hero-value" id="out-percent">25%</div>
                <div class="mt-2 text-muted fw-bold" id="out-decimal">Decimal: 0.25</div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-brain me-2 text-success"></i>Understanding the Result</h6>
            <div class="p-3 bg-white border rounded-3 small">
                <div id="out-viz" class="mb-3">
                    
                </div>
                <div id="out-text">A ratio of <strong>1:4</strong> means the first part represents <strong>25%</strong> of the whole.</div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Percentage</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const v1El = document.getElementById('v1');
    const v2El = document.getElementById('v2');
    const outPer = document.getElementById('out-percent');
    const outDec = document.getElementById('out-decimal');
    const outTxt = document.getElementById('out-text');
    const outViz = document.getElementById('out-viz');

    function calculate(){
        const v1 = parseFloat(v1El.value);
        const v2 = parseFloat(v2El.value);

        if(isNaN(v1) || isNaN(v2) || v2 === 0){
            outPer.textContent = '—';
            outDec.textContent = 'Decimal: —';
            outViz.innerHTML = '';
            outTxt.innerHTML = 'Please enter valid numbers.';
            return;
        }

        const decimal = v1 / v2;
        const percent = decimal * 100;

        outPer.textContent = percent.toFixed(2).replace(/\.00$/, '') + '%';
        outDec.textContent = `Decimal: ${decimal.toFixed(4).replace(/\.?0+$/, '')}`;
        
        outViz.innerHTML = `
            <div class="progress" style="height: 24px; border-radius: 12px; background: #f1f5f9;">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" 
                     style="width: ${Math.min(100, percent)}%; background-color: #10b981;"></div>
            </div>
        `;

        outTxt.innerHTML = `A ratio of <strong>${v1}:${v2}</strong> means the first part represents <strong>${percent.toFixed(2).replace(/\.00$/, '')}%</strong> of the whole.`;
    }

    v1El.addEventListener('input', calculate);
    v2El.addEventListener('input', calculate);

    document.querySelectorAll('.ratio-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            v1El.value = btn.dataset.v1;
            v2El.value = btn.dataset.v2;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        if(outPer.textContent === '—') return;
        navigator.clipboard.writeText(outPer.textContent);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.ratio-to-percent-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.ratio-to-percent-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.ratio-to-percent-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.ratio-to-percent-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.ratio-to-percent-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.ratio-to-percent-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.ratio-to-percent-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.ratio-to-percent-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.ratio-to-percent-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.ratio-to-percent-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

@media (max-width: 768px) {
    .ratio-to-percent-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\ratio-to-percentage-calculator.blade.php ENDPATH**/ ?>