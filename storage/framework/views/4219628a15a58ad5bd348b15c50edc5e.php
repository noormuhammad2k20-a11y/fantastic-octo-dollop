<div class="row g-4 cohen-d-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3 text-primary">Group 1</h6>
                        <label class="form-label-custom small">Mean (x₁)</label>
                        <input type="number" id="m1" class="form-control mb-2" value="50">
                        <label class="form-label-custom small">Std. Deviation (s₁)</label>
                        <input type="number" id="sd1" class="form-control mb-2" value="10">
                        <label class="form-label-custom small">Sample Size (n₁)</label>
                        <input type="number" id="n1" class="form-control" value="30">
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3 text-indigo">Group 2</h6>
                        <label class="form-label-custom small">Mean (x₂)</label>
                        <input type="number" id="m2" class="form-control mb-2" value="45">
                        <label class="form-label-custom small">Std. Deviation (s₂)</label>
                        <input type="number" id="sd2" class="form-control mb-2" value="12">
                        <label class="form-label-custom small">Sample Size (n₂)</label>
                        <input type="number" id="n2" class="form-control" value="30">
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Effect Size (Cohen's d)</span>
                <div class="output-hero-value" id="out-d">0.45</div>
                <div class="mt-2 text-muted fw-bold" id="out-interpretation">Magnitude: Small to Medium</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-12">
                    <div class="stat-card">
                        <span class="stat-card-label">Pooled Standard Deviation (sₚ)</span>
                        <span class="stat-card-value" id="out-pooled">11.05</span>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Reference Scale</h6>
            <div class="bg-white border rounded-3 p-3">
                <div class="d-flex justify-content-between mb-1 small"><span>0.2</span> <span>0.5</span> <span>0.8</span></div>
                <div class="progress" style="height: 10px;">
                    <div id="d-marker" class="progress-bar bg-primary" style="width: 45%;"></div>
                </div>
                <div class="d-flex justify-content-between mt-1 text-muted x-small">
                    <span>Small</span> <span>Medium</span> <span>Large</span>
                </div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Calculation Result</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const inputs = ['m1', 'sd1', 'n1', 'm2', 'sd2', 'n2'].map(id => document.getElementById(id));
    const outD = document.getElementById('out-d');
    const outInt = document.getElementById('out-interpretation');
    const outPooled = document.getElementById('out-pooled');
    const dMarker = document.getElementById('d-marker');

    function calculate(){
        const [m1, sd1, n1, m2, sd2, n2] = inputs.map(el => parseFloat(el.value));

        if(inputs.some(el => isNaN(parseFloat(el.value))) || n1 < 1 || n2 < 1) return;

        // Pooled SD = sqrt( ((n1-1)sd1^2 + (n2-1)sd2^2) / (n1+n2-2) )
        const pooledVar = ((n1 - 1) * Math.pow(sd1, 2) + (n2 - 1) * Math.pow(sd2, 2)) / (n1 + n2 - 2);
        const sPooled = Math.sqrt(pooledVar);
        
        // Cohen's d = (M1 - M2) / sPooled
        const d = Math.abs(m1 - m2) / sPooled;

        outD.textContent = d.toFixed(3);
        outPooled.textContent = sPooled.toFixed(3);

        let interp = "Negligible";
        let percent = (d / 1.2) * 100; // Cap at 1.2 for bar
        if(d >= 0.8) interp = "Large Effect";
        else if(d >= 0.5) interp = "Medium Effect";
        else if(d >= 0.2) interp = "Small Effect";
        
        outInt.textContent = `Magnitude: ${interp}`;
        dMarker.style.width = `${Math.min(100, percent)}%`;
    }

    inputs.forEach(el => el.addEventListener('input', calculate));

    document.getElementById('btn-copy').addEventListener('click', function(){
        navigator.clipboard.writeText(`Cohen's d: ${outD.textContent}\nInterpretation: ${outInt.textContent}`);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.cohen-d-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.cohen-d-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.cohen-d-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.cohen-d-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.cohen-d-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.cohen-d-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.cohen-d-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.cohen-d-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.cohen-d-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.cohen-d-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

.cohen-d-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; text-align: center; }
.cohen-d-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.cohen-d-rebuilt .stat-card-value { font-size: 1.15rem; font-weight: 700; color: #1e293b; }

.x-small { font-size: 0.65rem; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\cohen-d-calculator.blade.php ENDPATH**/ ?>