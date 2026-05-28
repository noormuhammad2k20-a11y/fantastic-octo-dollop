<div class="row g-4 octal-calc-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label-custom">First Octal Number</label>
                        <input type="text" id="num1" class="form-control form-control-lg font-monospace" placeholder="e.g. 75" value="10">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label-custom">Operation</label>
                        <select id="operator" class="form-select form-select-lg fw-bold">
                            <option value="+">+</option>
                            <option value="-">-</option>
                            <option value="*">×</option>
                            <option value="/">÷</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label-custom">Second Octal Number</label>
                        <input type="text" id="num2" class="form-control form-control-lg font-monospace" placeholder="e.g. 12" value="5">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-n1="77" data-n2="1">77 + 1</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-n1="100" data-n2="10">100 - 10</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-n1="12" data-n2="12">12 × 12</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:170;--tool-color:#0d9488;--tool-bg:rgba(20,184,166,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Result (Octal)</span>
                <div class="output-hero-value" id="out-result">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-decimal">Decimal: —</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Binary Result</span><span class="stat-card-value font-monospace" id="out-binary">—</span></div></div>
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Hex Result</span><span class="stat-card-value font-monospace" id="out-hex">—</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-list-ol me-2 text-teal"></i>Process Breakdown</h6>
            <div class="bg-white border rounded-3 p-3">
                <div id="step-1" class="mb-2">1. Convert inputs to decimal...</div>
                <div id="step-2" class="mb-2">2. Perform arithmetic...</div>
                <div id="step-3">3. Convert back to octal...</div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Octal Result</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const n1El = document.getElementById('num1');
    const n2El = document.getElementById('num2');
    const opEl = document.getElementById('operator');
    const outRes = document.getElementById('out-result');
    const outDec = document.getElementById('out-decimal');
    const outBin = document.getElementById('out-binary');
    const outHex = document.getElementById('out-hex');

    function calculate(){
        let v1 = n1El.value.trim();
        let v2 = n2El.value.trim();
        let op = opEl.value;

        if(!v1 || !v2){
            reset();
            return;
        }

        // Validate Octal
        if(!/^[0-7]+$/.test(v1) || !/^[0-7]+$/.test(v2)){
            outRes.textContent = 'Invalid';
            outDec.textContent = 'Please enter digits 0-7 only.';
            return;
        }

        const d1 = parseInt(v1, 8);
        const d2 = parseInt(v2, 8);
        let resDec;

        switch(op){
            case '+': resDec = d1 + d2; break;
            case '-': resDec = d1 - d2; break;
            case '*': resDec = d1 * d2; break;
            case '/': resDec = d2 !== 0 ? Math.floor(d1 / d2) : NaN; break;
        }

        if(isNaN(resDec)){
            outRes.textContent = 'Error';
            outDec.textContent = 'Math Error (Division by Zero?)';
            return;
        }

        const resOct = (resDec < 0 ? '-' : '') + Math.abs(resDec).toString(8);
        
        outRes.textContent = resOct;
        outDec.textContent = `Decimal: ${resDec}`;
        outBin.textContent = (resDec < 0 ? '-' : '') + Math.abs(resDec).toString(2);
        outHex.textContent = (resDec < 0 ? '-' : '') + Math.abs(resDec).toString(16).toUpperCase();

        document.getElementById('step-1').innerHTML = `1. Convert <strong>${v1}<sub>8</sub></strong> to <strong>${d1}<sub>10</sub></strong> and <strong>${v2}<sub>8</sub></strong> to <strong>${d2}<sub>10</sub></strong>`;
        document.getElementById('step-2').innerHTML = `2. Calculation: <strong>${d1} ${op === '*' ? '×' : op === '/' ? '÷' : op} ${d2} = ${resDec}</strong>`;
        document.getElementById('step-3').innerHTML = `3. Convert <strong>${resDec}<sub>10</sub></strong> to octal: <strong>${resOct}<sub>8</sub></strong>`;
    }

    function reset(){
        outRes.textContent = '—';
        outDec.textContent = 'Decimal: —';
        outBin.textContent = '—';
        outHex.textContent = '—';
        document.getElementById('step-1').textContent = '1. Convert inputs to decimal...';
        document.getElementById('step-2').textContent = '2. Perform arithmetic...';
        document.getElementById('step-3').textContent = '3. Convert back to octal...';
    }

    n1El.addEventListener('input', calculate);
    n2El.addEventListener('input', calculate);
    opEl.addEventListener('change', calculate);

    document.querySelectorAll('.oct-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            n1El.value = btn.dataset.n1;
            n2El.value = btn.dataset.n2;
            opEl.value = btn.textContent.includes('+') ? '+' : btn.textContent.includes('-') ? '-' : btn.textContent.includes('×') ? '*' : '/';
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        const val = outRes.textContent;
        if(val === '—' || val === 'Invalid') return;
        navigator.clipboard.writeText(val).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.octal-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.octal-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.octal-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.octal-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.octal-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.octal-calc-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.octal-calc-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.octal-calc-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.octal-calc-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.octal-calc-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

.octal-calc-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; }
.octal-calc-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.octal-calc-rebuilt .stat-card-value { font-size: 1.15rem; font-weight: 700; color: #1e293b; }

@media (max-width: 768px) {
    .octal-calc-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

