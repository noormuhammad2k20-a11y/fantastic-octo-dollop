@include('tools.partials.medical-disclaimer')

<div class="row g-4 sodium-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Measured Sodium</label>
                        <div class="input-group">
                            <input type="number" id="na-measured" class="form-control form-control-lg rounded-3" value="140" step="0.1">
                            <span class="input-group-text bg-light fw-bold text-muted">mEq/L</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Serum Glucose</label>
                        <div class="input-group">
                            <input type="number" id="na-glucose" class="form-control form-control-lg rounded-3" value="100" step="1">
                            <span class="input-group-text bg-light fw-bold text-muted">mg/dL</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="na-output-card" style="--tool-hue:200;--tool-color:#0ea5e9;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Corrected Sodium Level</span>
                <div class="output-hero-value" id="out-na-val" style="font-size:3.5rem">140.0</div>
                <span class="output-hero-unit">mEq/L</span>
            </div>

            <div class="position-relative mt-4 mb-1 px-4">
                <div class="progress rounded-pill" style="height:12px;background:#e2e8f0">
                    <div id="na-bar" class="progress-bar rounded-pill" style="width:50%;background:#10b981;transition:all .5s"></div>
                </div>
            </div>
            <div class="d-flex justify-content-between small text-muted px-4 mb-4"><span>Low (<135)</span><span>Normal</span><span>High (>145)</span></div>

            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Dilutional Offset</span>
                        <span class="stat-card-value" id="out-na-offset">0.0 mEq/L</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Assessment</span>
                        <span class="stat-card-value text-success" id="out-na-assess">Normal</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border border-opacity-10 border-info shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-stethoscope me-2 text-info"></i>Clinical Insight</h6>
                <div id="na-advice" class="small text-secondary"></div>
                <div class="mt-3 p-3 rounded-3 bg-light small border">
                    <i class="fas fa-info-circle text-info me-2"></i><strong>Note:</strong> Elevated glucose creates an osmotic gradient that shifts water out of cells, diluting the measured serum sodium.
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="na-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Sodium Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const nEl=$('na-measured'), gEl=$('na-glucose');

    function calculate(){
        const measured = parseFloat(nEl.value)||0;
        const glucose = parseFloat(gEl.value)||0;

        if(measured<=0 || glucose<=0) return;

        // Corrected Na = Measured + 1.6 * (Glucose - 100) / 100
        const offset = 1.6 * ((glucose - 100) / 100);
        const corrected = measured + offset;

        $('out-na-val').textContent = corrected.toFixed(1);
        $('out-na-offset').textContent = (offset >= 0 ? '+' : '') + offset.toFixed(1) + " mEq/L";

        let assess = "", color = "#10b981", advice = "";
        let pct = 0;

        if(corrected < 135) {
            assess = "Hyponatremia"; color = "#f59e0b";
            pct = 25;
            advice = "True hyponatremia remains after accounting for the osmotic effects of glucose.";
        } else if(corrected > 145) {
            assess = "Hypernatremia"; color = "#ef4444";
            pct = 75;
            advice = "Corrected sodium is elevated, indicating a total body water deficit relative to sodium.";
        } else {
            assess = "Normal"; color = "#10b981";
            pct = 50;
            advice = "Corrected sodium is within the normal reference range (135 - 145 mEq/L).";
        }

        $('out-na-assess').textContent = assess;
        $('out-na-assess').style.color = color;
        $('na-bar').style.width = pct + "%";
        $('na-bar').style.background = color;
        $('na-advice').innerHTML = advice;
        $('na-output-card').style.setProperty('--tool-color', color);
    }

    [nEl, gEl].forEach(e=>e.addEventListener('input', calculate));
    
    $('na-copy').addEventListener('click', function(){
        const text=`Corrected Sodium Report\nMeasured: ${nEl.value} mEq/L\nGlucose: ${gEl.value} mg/dL\nResult: ${$('out-na-val').textContent} mEq/L\n— ToolsHub BioLabs`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o, 2000)});
    });

    calculate();
});
</script>

<style>
.sodium-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.sodium-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.sodium-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.sodium-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.sodium-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.sodium-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>

