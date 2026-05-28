@include('tools.partials.medical-disclaimer')

<div class="row g-4 bun-ratio-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6 border-end-md">
                        <label class="form-label-custom">Blood Urea Nitrogen</label>
                        <div class="input-group">
                            <input type="number" id="bun-val" class="form-control form-control-lg" value="15">
                            <span class="input-group-text bg-light fw-bold text-muted">mg/dL</span>
                        </div>
                        <div class="mt-2 small text-muted"><i class="fas fa-info-circle me-1"></i>Standard BUN range: 7-20 mg/dL</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Serum Creatinine</label>
                        <div class="input-group">
                            <input type="number" id="scr-val" class="form-control form-control-lg" value="1.0" step="0.1">
                            <span class="input-group-text bg-light fw-bold text-muted">mg/dL</span>
                        </div>
                        <div class="mt-2 small text-muted"><i class="fas fa-info-circle me-1"></i>Standard Cr range: 0.6-1.2 mg/dL</div>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 bun-quick" data-bun="30" data-scr="1.1">Pre-renal (30:1)</button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 bun-quick" data-bun="20" data-scr="2.5">Intrinsic (8:1)</button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 bun-quick" data-bun="15" data-scr="1.0">Normal (15:1)</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="bun-output-card" style="--tool-hue:200;--tool-color:#0ea5e9;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Calculated Ratio</span>
                <div class="output-hero-value" id="out-bun-val" style="font-size:3.5rem">15.0</div>
                <span class="output-hero-unit">: 1</span>
            </div>

            <div class="position-relative mt-4 mb-1 px-4">
                <div class="progress rounded-pill" style="height:12px;background:#e2e8f0">
                    <div id="bun-bar" class="progress-bar rounded-pill" style="width:50%;background:#10b981;transition:all .5s"></div>
                </div>
            </div>
            <div class="d-flex justify-content-between small text-muted px-4 mb-4"><span>Intrinsic (<10)</span><span>Normal</span><span>Pre-renal (>20)</span></div>

            <div class="stats-grid mt-4">
                <div class="row g-3 text-center">
                    <div class="col-md-6">
                        <div class="stat-card">
                            <span class="stat-card-label">Classification</span>
                            <span class="stat-card-value" id="out-bun-class">Normal</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card">
                            <span class="stat-card-label">Assessment</span>
                            <span class="stat-card-value text-info" id="out-bun-assess">Stable</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border border-opacity-10 border-info shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-stethoscope me-2 text-info"></i>Clinical Interpretation</h6>
                <div id="bun-advice" class="small text-secondary"></div>
                <div class="mt-3 p-3 rounded-3 bg-light small border">
                    <i class="fas fa-circle-exclamation text-warning me-2"></i><strong>Note:</strong> High ratios can also be caused by gastrointestinal bleeding or high protein intake.
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="bun-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Clinical Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const bEl=$('bun-val'), sEl=$('scr-val');

    function calculate(){
        const bun = parseFloat(bEl.value)||0;
        const scr = parseFloat(sEl.value)||0;

        if(bun<=0 || scr<=0) return;

        const ratio = bun / scr;
        $('out-bun-val').textContent = ratio.toFixed(1);

        let cls = "", assess = "", color = "#10b981", advice = "";
        let pct = Math.min(100, (ratio/40)*100);

        if(ratio > 20) {
            cls = "Pre-renal"; assess = "Dehydrated"; color = "#f59e0b";
            advice = "<strong>Pre-renal Pattern (>20:1):</strong> Suggests decreased renal perfusion (dehydration, CHF, shock) or a high nitrogen load (GI bleed, steroids). The kidneys are functional but under-perfused.";
        } else if(ratio < 10) {
            cls = "Intrinsic"; assess = "Renal Injury"; color = "#dc2626";
            advice = "<strong>Intrinsic Renal Pattern (<10:1):</strong> Suggests acute tubular necrosis (ATN), glomerulonephritis, or severe chronic kidney disease where the kidney cannot reabsorb urea.";
        } else {
            cls = "Normal Ratio"; assess = "Post-renal/Chronic"; color = "#10b981";
            advice = "<strong>Normal or Mix (10-20:1):</strong> Normal kidney function or potentially post-renal obstruction (if labs are overall elevated).";
        }

        $('out-bun-class').textContent = cls;
        $('out-bun-class').style.color = color;
        $('out-bun-assess').textContent = assess;
        $('out-bun-assess').style.color = color;
        $('bun-bar').style.width = Math.min(100, (ratio/40)*100) + "%";
        $('bun-bar').style.background = color;
        $('bun-advice').innerHTML = advice;
        $('bun-output-card').style.setProperty('--tool-color', color);
    }

    [bEl, sEl].forEach(e=>e.addEventListener('input', calculate));
    document.querySelectorAll('.bun-quick').forEach(btn=>{btn.addEventListener('click',()=>{
        bEl.value=btn.dataset.bun; sEl.value=btn.dataset.scr;
        calculate();
    })});

    $('bun-copy').addEventListener('click',function(){
        const text=`BUN/Cr Ratio Report\nBUN: ${bEl.value} mg/dL\nCreatinine: ${sEl.value} mg/dL\nRatio: ${$('out-bun-val').textContent}:1\nClassification: ${$('out-bun-class').textContent}\n— ToolsHub BioLabs`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });
    calculate();
});
</script>

<style>
.bun-ratio-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.bun-ratio-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.bun-ratio-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.bun-ratio-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.bun-ratio-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.bun-ratio-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
@media (min-width: 768px) { .border-end-md { border-right: 1px solid #f1f5f9; padding-right: 2rem; } .bun-ratio-calc-rebuilt .col-md-6:last-child { padding-left: 2rem; } }
</style>

