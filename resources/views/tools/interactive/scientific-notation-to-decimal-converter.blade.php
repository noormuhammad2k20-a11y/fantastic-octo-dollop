<div class="row g-4 sci-to-dec-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-7">
                        <label class="form-label-custom">Coefficient (m)</label>
                        <input type="number" id="coeff" class="form-control form-control-lg" placeholder="e.g. 1.23" value="1.23" step="any">
                    </div>
                    <div class="col-md-5">
                        <label class="form-label-custom">Exponent (n)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">× 10^</span>
                            <input type="number" id="exp" class="form-control form-control-lg" placeholder="e.g. 5" value="5">
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill sci-quick" data-c="6.022" data-e="23">Avogadro</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill sci-quick" data-c="3" data-e="8">Light Speed</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill sci-quick" data-c="1" data-e="-6">Micro</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:230;--tool-color:#4f46e5;--tool-bg:rgba(99,102,241,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Decimal Result</span>
                <div class="output-hero-value" id="out-decimal" style="word-break: break-all; font-size: 2.5rem;">—</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Engineering Notation</span><span class="stat-card-value" id="out-eng">—</span></div></div>
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">E-Notation</span><span class="stat-card-value font-monospace" id="out-e">—</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-info-circle me-2 text-indigo"></i>Explanation</h6>
            <div class="bg-white border rounded-3 p-3">
                <div id="out-logic">Move the decimal point <strong>n</strong> places to the right (if positive) or left (if negative).</div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Decimal</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const cEl = document.getElementById('coeff');
    const eEl = document.getElementById('exp');
    const outDec = document.getElementById('out-decimal');
    const outEng = document.getElementById('out-eng');
    const outE = document.getElementById('out-e');
    const outLogic = document.getElementById('out-logic');

    function calculate(){
        const c = parseFloat(cEl.value);
        const e = parseInt(eEl.value);

        if(isNaN(c) || isNaN(e)){
            reset();
            return;
        }

        const result = c * Math.pow(10, e);
        
        // Format result to avoid scientific notation in the decimal view if possible
        // using toFixed but removing trailing zeros
        let decimalStr = result.toLocaleString('en-US', {useGrouping: false, maximumFractionDigits: 20});
        if(Math.abs(e) > 20) decimalStr = result.toString(); // Fallback for extreme numbers

        outDec.textContent = decimalStr;
        outE.textContent = `${c}e${e}`;
        
        // Engineering Notation (exponent multiple of 3)
        const engExp = Math.floor(e / 3) * 3;
        const engCoeff = c * Math.pow(10, e - engExp);
        outEng.textContent = `${engCoeff} × 10^${engExp}`;

        const direction = e >= 0 ? 'right' : 'left';
        outLogic.innerHTML = `Move the decimal point <strong>${Math.abs(e)}</strong> places to the <strong>${direction}</strong>.`;
    }

    function reset(){
        outDec.textContent = '—';
        outEng.textContent = '—';
        outE.textContent = '—';
        outLogic.textContent = 'Move the decimal point n places...';
    }

    cEl.addEventListener('input', calculate);
    eEl.addEventListener('input', calculate);

    document.querySelectorAll('.sci-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            cEl.value = btn.dataset.c;
            eEl.value = btn.dataset.e;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        const val = outDec.textContent;
        if(val === '—') return;
        navigator.clipboard.writeText(val);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(()=>this.innerHTML=o, 2000);
    });

    calculate();
});
</script>

<style>
.sci-to-dec-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.sci-to-dec-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.sci-to-dec-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.sci-to-dec-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.sci-to-dec-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.sci-to-dec-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.sci-to-dec-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.sci-to-dec-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.sci-to-dec-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.sci-to-dec-rebuilt .output-hero-value { font-weight: 900; color: var(--tool-color); line-height: 1.2; margin: .5rem 0; }

.sci-to-dec-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; }
.sci-to-dec-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.sci-to-dec-rebuilt .stat-card-value { font-size: 1.15rem; font-weight: 700; color: #1e293b; word-break: break-all; }

@media (max-width: 768px) {
    .sci-to-dec-rebuilt .output-hero-value { font-size: 1.75rem !important; }
}
</style>

