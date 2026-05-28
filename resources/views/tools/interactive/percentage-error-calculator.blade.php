<div class="row g-4 percent-error-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Theoretical (Accepted) Value</label>
                        <input type="number" id="theoretical" class="form-control form-control-lg" placeholder="e.g. 9.81" value="9.81" step="any">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Experimental (Measured) Value</label>
                        <input type="number" id="experimental" class="form-control form-control-lg" placeholder="e.g. 9.50" value="9.50" step="any">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill err-quick" data-t="100" data-e="95">95% Yield</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill err-quick" data-t="32" data-e="33">Ice Temp</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill err-quick" data-t="120" data-e="115">BP Test</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(239,68,68,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Percentage Error</span>
                <div class="output-hero-value" id="out-error">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-status">Status: —</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Absolute Error</span>
                        <span class="stat-card-value text-danger" id="out-abs">—</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Accuracy Score</span>
                        <span class="stat-card-value text-success" id="out-accuracy">—</span>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-equals me-2 text-danger"></i>Calculation Steps</h6>
            <div class="bg-white border rounded-3 p-4">
                <div class="text-center font-monospace mb-3" style="font-size: 1.1rem;">
                    PE = | (E - T) / T | × 100%
                </div>
                <div id="out-steps" class="small text-muted border-top pt-3">
                    {{-- Dynamic Steps --}}
                </div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Error Report</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const tEl = document.getElementById('theoretical');
    const eEl = document.getElementById('experimental');
    const outErr = document.getElementById('out-error');
    const outStatus = document.getElementById('out-status');
    const outAbs = document.getElementById('out-abs');
    const outAcc = document.getElementById('out-accuracy');
    const outSteps = document.getElementById('out-steps');

    function calculate(){
        const t = parseFloat(tEl.value);
        const e = parseFloat(eEl.value);

        if(isNaN(t) || isNaN(e) || t === 0){
            reset();
            if(t === 0) outErr.textContent = 'NaN';
            return;
        }

        const absErr = Math.abs(e - t);
        const percentErr = (absErr / Math.abs(t)) * 100;
        const accuracy = 100 - percentErr;

        outErr.textContent = percentErr.toFixed(2) + '%';
        outAbs.textContent = absErr.toFixed(4);
        outAcc.textContent = Math.max(0, accuracy).toFixed(2) + '%';
        
        let status = "Highly Accurate";
        let statusColor = "#10b981";
        if(percentErr > 10) { status = "Low Accuracy"; statusColor = "#ef4444"; }
        else if(percentErr > 5) { status = "Acceptable"; statusColor = "#f59e0b"; }
        
        outStatus.innerHTML = `Status: <span style="color:${statusColor}">${status}</span>`;

        outSteps.innerHTML = `
            <div>1. Absolute Difference: |${e} - ${t}| = <strong>${absErr.toFixed(4)}</strong></div>
            <div>2. Divide by Theoretical: ${absErr.toFixed(4)} / |${t}| = <strong>${(absErr/Math.abs(t)).toFixed(6)}</strong></div>
            <div>3. Multiply by 100: Result = <strong>${percentErr.toFixed(4)}%</strong></div>
        `;
    }

    function reset(){
        outErr.textContent = '—';
        outStatus.textContent = 'Status: —';
        outAbs.textContent = '—';
        outAcc.textContent = '—';
        outSteps.innerHTML = '';
    }

    tEl.addEventListener('input', calculate);
    eEl.addEventListener('input', calculate);

    document.querySelectorAll('.err-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            tEl.value = btn.dataset.t;
            eEl.value = btn.dataset.e;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        if(outErr.textContent === '—') return;
        const text = `Percentage Error Report\nTheoretical: ${tEl.value}\nExperimental: ${eEl.value}\nError: ${outErr.textContent}\nAccuracy: ${outAcc.textContent}`;
        navigator.clipboard.writeText(text);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(()=>this.innerHTML=o, 2000);
    });

    calculate();
});
</script>

<style>
.percent-error-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.percent-error-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.percent-error-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.percent-error-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.percent-error-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.percent-error-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.percent-error-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.percent-error-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.percent-error-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.percent-error-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

.percent-error-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; }
.percent-error-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.percent-error-rebuilt .stat-card-value { font-size: 1.15rem; font-weight: 700; color: #1e293b; }

@media (max-width: 768px) {
    .percent-error-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

