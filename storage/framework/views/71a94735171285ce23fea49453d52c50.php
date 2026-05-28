<div class="row g-4 percent-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-12 p-3 bg-light rounded-3 border">
                        <label class="form-label-custom">What is</label>
                        <div class="d-flex align-items-center gap-2">
                            <input type="number" id="p1" class="form-control form-control-lg text-center" value="20" style="width: 100px;">
                            <span class="fw-bold">% of</span>
                            <input type="number" id="x1" class="form-control form-control-lg" value="500">
                            <span class="fw-bold">?</span>
                        </div>
                        <div class="mt-2 text-primary fw-bold">Result: <span id="res1">100</span></div>
                    </div>

                    
                    <div class="col-md-12 p-3 bg-light rounded-3 border">
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <input type="number" id="x2" class="form-control form-control-lg text-center" value="50" style="width: 100px;">
                            <span class="fw-bold">is what % of</span>
                            <input type="number" id="y2" class="form-control form-control-lg" value="200">
                            <span class="fw-bold">?</span>
                        </div>
                        <div class="mt-2 text-primary fw-bold">Result: <span id="res2">25%</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Common Benchmarks</span>
                <div class="mt-3 d-flex flex-wrap justify-content-center gap-3">
                    <div class="stat-card px-4"><span class="stat-card-label">10%</span><span class="stat-card-value" id="tip-10">—</span></div>
                    <div class="stat-card px-4"><span class="stat-card-label">15%</span><span class="stat-card-value" id="tip-15">—</span></div>
                    <div class="stat-card px-4"><span class="stat-card-label">20%</span><span class="stat-card-value" id="tip-20">—</span></div>
                </div>
            </div>



            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" onclick="location.reload()"><i class="fas fa-undo me-2"></i>Reset All Fields</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const p1 = document.getElementById('p1');
    const x1 = document.getElementById('x1');
    const res1 = document.getElementById('res1');

    const x2 = document.getElementById('x2');
    const y2 = document.getElementById('y2');
    const res2 = document.getElementById('res2');

    const t10 = document.getElementById('tip-10');
    const t15 = document.getElementById('tip-15');
    const t20 = document.getElementById('tip-20');

    function calc1(){
        const p = parseFloat(p1.value);
        const x = parseFloat(x1.value);
        if(!isNaN(p) && !isNaN(x)){
            const r = (p / 100) * x;
            res1.textContent = r.toLocaleString(undefined, {maximumFractionDigits: 4});
            updateTips(x);
        }
    }

    function calc2(){
        const x = parseFloat(x2.value);
        const y = parseFloat(y2.value);
        if(!isNaN(x) && !isNaN(y) && y !== 0){
            const r = (x / y) * 100;
            res2.textContent = r.toFixed(2).replace(/\.00$/, '') + '%';
        }
    }

    function updateTips(base){
        if(!isNaN(base)){
            t10.textContent = (base * 0.1).toLocaleString();
            t15.textContent = (base * 0.15).toLocaleString();
            t20.textContent = (base * 0.2).toLocaleString();
        }
    }

    p1.addEventListener('input', calc1);
    x1.addEventListener('input', calc1);
    x2.addEventListener('input', calc2);
    y2.addEventListener('input', calc2);

    calc1();
    calc2();
});
</script>

<style>
.percent-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.percent-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.percent-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.percent-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.percent-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.percent-calc-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.percent-calc-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.percent-calc-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.percent-calc-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }

.percent-calc-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; min-width: 120px; }
.percent-calc-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.percent-calc-rebuilt .stat-card-value { font-size: 1.15rem; font-weight: 700; color: #1e293b; }

@media (max-width: 768px) {
    .percent-calc-rebuilt .stat-card { flex-grow: 1; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\percentage-calculator.blade.php ENDPATH**/ ?>