<div class="row g-4 pivot-calc-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Previous High</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="high" class="form-control form-control-lg rounded-3 border-start-0" value="152.50" step="0.01">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Previous Low</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="low" class="form-control form-control-lg rounded-3 border-start-0" value="148.00" step="0.01">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Previous Close</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="close" class="form-control form-control-lg rounded-3 border-start-0" value="151.00" step="0.01">
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-warning btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate" style="background:#f59e0b;border-color:#f59e0b"><i class="fas fa-calculator me-2"></i>Calculate Levels</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:38;--tool-color:#f59e0b;--tool-bg:rgba(245,158,11,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Main Pivot Point (PP)</span>
                <div class="output-hero-value" id="out-pp">—</div>
                <div class="mt-2 text-muted fw-bold">The central axis for the current trading period.</div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 text-center"><i class="fas fa-sort-amount-up me-2 text-warning"></i>Calculated Support & Resistance Levels</h6>
                
                <div class="row g-2 text-center mt-3">
                    <div class="col-12"><div class="p-2 border rounded-3 bg-soft-danger"><small class="d-block fw-bold text-danger">Resistance 3 (R3)</small><span class="fs-5 fw-bold" id="out-r3">—</span></div></div>
                    <div class="col-12"><div class="p-2 border rounded-3"><small class="d-block fw-bold text-muted">Resistance 2 (R2)</small><span class="fs-5 fw-bold" id="out-r2">—</span></div></div>
                    <div class="col-12"><div class="p-2 border rounded-3"><small class="d-block fw-bold text-muted">Resistance 1 (R1)</small><span class="fs-5 fw-bold" id="out-r1">—</span></div></div>
                    
                    <div class="col-12 my-2"><div class="p-3 border-2 border-warning rounded-3 bg-light"><small class="d-block fw-bold text-warning">Pivot Point (PP)</small><span class="fs-4 fw-bold" id="out-pp-list">—</span></div></div>
                    
                    <div class="col-12"><div class="p-2 border rounded-3"><small class="d-block fw-bold text-muted">Support 1 (S1)</small><span class="fs-5 fw-bold" id="out-s1">—</span></div></div>
                    <div class="col-12"><div class="p-2 border rounded-3"><small class="d-block fw-bold text-muted">Support 2 (S2)</small><span class="fs-5 fw-bold" id="out-s2">—</span></div></div>
                    <div class="col-12"><div class="p-2 border rounded-3 bg-soft-success"><small class="d-block fw-bold text-success">Support 3 (S3)</small><span class="fs-5 fw-bold" id="out-s3">—</span></div></div>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Levels</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const highEl=$('high'), lowEl=$('low'), closeEl=$('close');

    function calculate(){
        const h = parseFloat(highEl.value);
        const l = parseFloat(lowEl.value);
        const c = parseFloat(closeEl.value);

        if(isNaN(h) || isNaN(l) || isNaN(c) || h < l) return;

        const pp = (h + l + c) / 3;
        
        // Standard Formula
        const r1 = (pp * 2) - l;
        const s1 = (pp * 2) - h;
        const r2 = pp + (h - l);
        const s2 = pp - (h - l);
        const r3 = highEl.value * 1.0 + 2 * (pp - l); // Alternative R3 = H + 2*(PP - L)
        const s3 = lowEl.value * 1.0 - 2 * (h - pp);  // Alternative S3 = L - 2*(H - PP)

        $('out-pp').textContent = '$' + pp.toFixed(2);
        $('out-pp-list').textContent = '$' + pp.toFixed(2);
        
        $('out-r1').textContent = '$' + r1.toFixed(2);
        $('out-r2').textContent = '$' + r2.toFixed(2);
        $('out-r3').textContent = '$' + r3.toFixed(2);
        
        $('out-s1').textContent = '$' + s1.toFixed(2);
        $('out-s2').textContent = '$' + s2.toFixed(2);
        $('out-s3').textContent = '$' + s3.toFixed(2);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        highEl.value=152.50; lowEl.value=148.00; closeEl.value=151.00;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Pivot Points (Standard)\nR3: ${$('out-r3').textContent}\nR2: ${$('out-r2').textContent}\nR1: ${$('out-r1').textContent}\nPP: ${$('out-pp').textContent}\nS1: ${$('out-s1').textContent}\nS2: ${$('out-s2').textContent}\nS3: ${$('out-s3').textContent}\n— ToolsHub Trading`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.pivot-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.pivot-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.pivot-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.pivot-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.pivot-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.pivot-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.pivot-calc-rebuilt .bg-soft-danger{background:rgba(239,68,68,.05)}
.pivot-calc-rebuilt .bg-soft-success{background:rgba(34,197,94,.05)}

@media (max-width: 768px) {
    .pivot-calc-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .pivot-calc-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
