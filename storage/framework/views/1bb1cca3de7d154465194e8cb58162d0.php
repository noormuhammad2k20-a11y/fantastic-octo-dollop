<?php echo $__env->make('tools.partials.medical-disclaimer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="row g-4 calcium-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Serum Calcium</label>
                        <div class="input-group">
                            <input type="number" id="ca-measured" class="form-control form-control-lg rounded-3" value="8.5" step="0.1">
                            <span class="input-group-text bg-light fw-bold text-muted">mg/dL</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Serum Albumin</label>
                        <div class="input-group">
                            <input type="number" id="ca-albumin" class="form-control form-control-lg rounded-3" value="4.0" step="0.1">
                            <span class="input-group-text bg-light fw-bold text-muted">g/dL</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="ca-output-card" style="--tool-hue:45;--tool-color:#f59e0b;--tool-bg:rgba(245,158,11,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Corrected Calcium Level</span>
                <div class="output-hero-value" id="out-ca-val" style="font-size:3.5rem">8.50</div>
                <span class="output-hero-unit">mg/dL</span>
            </div>

            <div class="position-relative mt-4 mb-1 px-4">
                <div class="progress rounded-pill" style="height:12px;background:#e2e8f0">
                    <div id="ca-bar" class="progress-bar rounded-pill" style="width:50%;background:#10b981;transition:all .5s"></div>
                </div>
            </div>
            <div class="d-flex justify-content-between small text-muted px-4 mb-4"><span>Low (<8.5)</span><span>Normal</span><span>High (>10.5)</span></div>

            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Correction Adjustment</span>
                        <span class="stat-card-value" id="out-ca-offset">0.00 mg/dL</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Assessment</span>
                        <span class="stat-card-value text-success" id="out-ca-assess">Normal</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border border-opacity-10 border-warning shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-stethoscope me-2 text-warning"></i>Clinical Insight</h6>
                <div id="ca-advice" class="small text-secondary"></div>
                <div class="mt-3 p-3 rounded-3 bg-light small border">
                    <i class="fas fa-info-circle text-info me-2"></i><strong>Note:</strong> 40-50% of serum calcium is bound to albumin. Correction is necessary when albumin is abnormal.
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="ca-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Lab Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const mEl=$('ca-measured'), aEl=$('ca-albumin');

    function calculate(){
        const measured = parseFloat(mEl.value)||0;
        const albumin = parseFloat(aEl.value)||0;

        if(measured<=0 || albumin<=0) return;

        // Corrected Ca = Measured Ca + 0.8 * (4.0 - Albumin)
        const offset = 0.8 * (4.0 - albumin);
        const corrected = measured + offset;

        $('out-ca-val').textContent = corrected.toFixed(2);
        $('out-ca-offset').textContent = (offset >= 0 ? '+' : '') + offset.toFixed(2) + " mg/dL";

        let assess = "", color = "#10b981", advice = "";
        let pct = 0;

        if(corrected < 8.5) {
            assess = "Hypocalcemia"; color = "#f59e0b";
            pct = 25;
            advice = "Low corrected calcium levels may require further investigation into Vitamin D deficiency or parathyroid function.";
        } else if(corrected > 10.5) {
            assess = "Hypercalcemia"; color = "#ef4444";
            pct = 75;
            advice = "Elevated corrected calcium levels should be evaluated for hyperparathyroidism or malignancy.";
        } else {
            assess = "Normal"; color = "#10b981";
            pct = 50;
            advice = "Corrected calcium level is within the normal physiological range (8.5 - 10.5 mg/dL).";
        }

        $('out-ca-assess').textContent = assess;
        $('out-ca-assess').style.color = color;
        $('ca-bar').style.width = pct + "%";
        $('ca-bar').style.background = color;
        $('ca-advice').innerHTML = advice;
        $('ca-output-card').style.setProperty('--tool-color', color);
    }

    [mEl, aEl].forEach(e=>e.addEventListener('input', calculate));
    
    $('ca-copy').addEventListener('click', function(){
        const text=`Corrected Calcium Report\nMeasured: ${mEl.value} mg/dL\nAlbumin: ${aEl.value} g/dL\nResult: ${$('out-ca-val').textContent} mg/dL\n— ToolsHub BioLabs`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o, 2000)});
    });

    calculate();
});
</script>

<style>
.calcium-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.calcium-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.calcium-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.calcium-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.calcium-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.calcium-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\corrected-calcium-calculator.blade.php ENDPATH**/ ?>