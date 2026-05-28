@include('tools.partials.medical-disclaimer')

<div class="row g-4 fena-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6 border-end-md">
                        <label class="form-label-custom text-primary">Serum Labs</label>
                        <div class="mb-3">
                            <label class="small text-muted mb-1">Serum Sodium (SNa)</label>
                            <div class="input-group">
                                <input type="number" id="fena-sna" class="form-control form-control-lg" value="140">
                                <span class="input-group-text bg-light fw-bold">mEq/L</span>
                            </div>
                        </div>
                        <div>
                            <label class="small text-muted mb-1">Serum Creatinine (SCr)</label>
                            <div class="input-group">
                                <input type="number" id="fena-scr" class="form-control form-control-lg" value="1.2" step="0.01">
                                <span class="input-group-text bg-light fw-bold">mg/dL</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom text-success">Urine Labs</label>
                        <div class="mb-3">
                            <label class="small text-muted mb-1">Urine Sodium (UNa)</label>
                            <div class="input-group">
                                <input type="number" id="fena-una" class="form-control form-control-lg" value="20">
                                <span class="input-group-text bg-light fw-bold">mEq/L</span>
                            </div>
                        </div>
                        <div>
                            <label class="small text-muted mb-1">Urine Creatinine (UCr)</label>
                            <div class="input-group">
                                <input type="number" id="fena-ucr" class="form-control form-control-lg" value="100">
                                <span class="input-group-text bg-light fw-bold">mg/dL</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Clinical Scenarios:</span>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 fena-quick" data-sna="140" data-scr="1.2" data-una="10" data-ucr="100">Dehydration (<1%)</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 fena-quick" data-sna="140" data-scr="2.5" data-una="50" data-ucr="40">ATN (>2%)</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="fena-output-card" style="--tool-hue:35;--tool-color:#f59e0b;--tool-bg:rgba(245,158,11,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Calculated FENa</span>
                <div class="output-hero-value" id="out-fena-val" style="font-size:3.5rem">0.86</div>
                <span class="output-hero-unit">%</span>
            </div>

            <div class="position-relative mt-4 mb-1 px-4">
                <div class="progress rounded-pill" style="height:12px;background:#e2e8f0">
                    <div id="fena-bar" class="progress-bar rounded-pill" style="width:20%;background:#10b981;transition:all .5s"></div>
                </div>
            </div>
            <div class="d-flex justify-content-between small text-muted px-4 mb-4"><span>Pre-renal (<1%)</span><span>Mixed</span><span>Intrinsic (>2%)</span></div>

            <div class="mt-4 p-4 rounded-4 bg-white border border-opacity-10 border-warning shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-stethoscope me-2 text-warning"></i>Differential Diagnosis</h6>
                <div id="fena-advice" class="small text-secondary"></div>
                <div class="mt-3 p-3 rounded-3 bg-light small border">
                    <i class="fas fa-circle-info text-info me-2"></i><strong>Note:</strong> FENa is less reliable in patients taking diuretics. Consider FEUrea in those cases.
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="fena-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy FENa Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const snaEl=$('fena-sna'), scrEl=$('fena-scr'), unaEl=$('fena-una'), ucrEl=$('fena-ucr');

    function calculate(){
        const sna = parseFloat(snaEl.value)||0;
        const scr = parseFloat(scrEl.value)||0;
        const una = parseFloat(unaEl.value)||0;
        const ucr = parseFloat(ucrEl.value)||0;

        if(sna<=0 || scr<=0 || ucr<=0) return;

        // FENa = ((UNA * SCR) / (SNA * UCR)) * 100
        const fena = ((una * scr) / (sna * ucr)) * 100;
        $('out-fena-val').textContent = fena.toFixed(2);

        let color = "#10b981";
        let advice = "";
        let pct = Math.min(100, (fena/4)*100);

        if(fena < 1) {
            color = "#059669";
            advice = "<strong>Pre-renal Azotemia:</strong> Suggests dehydration, congestive heart failure, or renal artery stenosis. The kidneys are appropriately conserving sodium.";
        } else if(fena > 2) {
            color = "#dc2626";
            advice = "<strong>Intrinsic Renal Failure:</strong> Strongly suggestive of Acute Tubular Necrosis (ATN). The kidneys have lost the ability to concentrate urine and conserve sodium.";
        } else {
            color = "#d97706";
            advice = "<strong>Indeterminate:</strong> FENa between 1-2% is less specific and may be seen in various conditions including early ATN or chronic kidney disease.";
        }

        $('fena-bar').style.width = pct + "%";
        $('fena-bar').style.background = color;
        $('fena-advice').innerHTML = advice;
        $('fena-output-card').style.setProperty('--tool-color', color);
    }

    [snaEl, scrEl, unaEl, ucrEl].forEach(e=>e.addEventListener('input', calculate));
    document.querySelectorAll('.fena-quick').forEach(btn=>{btn.addEventListener('click',()=>{
        snaEl.value=btn.dataset.sna; scrEl.value=btn.dataset.scr;
        unaEl.value=btn.dataset.una; ucrEl.value=btn.dataset.ucr;
        calculate();
    })});

    $('fena-copy').addEventListener('click',function(){
        const text=`FENa Report\nResult: ${$('out-fena-val').textContent}%\nLabs: SNa ${snaEl.value}, SCr ${scrEl.value}, UNa ${unaEl.value}, UCr ${ucrEl.value}\n— ToolsHub Medical`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });
    calculate();
});
</script>

<style>
.fena-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.fena-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.fena-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.fena-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.fena-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.fena-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
@media (min-width: 768px) { .border-end-md { border-right: 1px solid #f1f5f9; padding-right: 2rem; } .fena-calc-rebuilt .col-md-6:last-child { padding-left: 2rem; } }
</style>

