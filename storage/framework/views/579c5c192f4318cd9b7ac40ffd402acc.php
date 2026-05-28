<div class="row g-4 oct-to-hex-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Octal Number</label>
                    <input type="text" id="oct-input" class="form-control form-control-lg font-monospace" placeholder="e.g. 177" value="10">
                    <div class="mt-2 d-flex gap-2">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-val="10">10</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-val="77">77</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-val="1234">1234</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-val="7777">7777</button>
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-primary me-1"></i> <strong>Efficiency:</strong> We convert Octal to Binary first, then group by 4 bits for the final Hex value.
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Hexadecimal Result</span>
                <div class="output-hero-value" id="out-hex">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-meta">Base 16</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Decimal Value</span><span class="stat-card-value" id="out-decimal">—</span></div></div>
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Binary Value</span><span class="stat-card-value font-monospace" id="out-binary">—</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-shoe-prints me-2 text-pink"></i>Conversion Steps</h6>
            <div id="out-steps" class="steps-container">
                
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Hex Result</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('oct-input');
    const outHex = document.getElementById('out-hex');
    const outDec = document.getElementById('out-decimal');
    const outBin = document.getElementById('out-binary');
    const outSteps = document.getElementById('out-steps');

    function calculate(){
        let val = input.value.trim();
        if(!val) { reset(); return; }

        if(!/^[0-7]+$/.test(val)){
            outHex.textContent = 'Invalid';
            outSteps.innerHTML = '';
            return;
        }

        const decimal = parseInt(val, 8);
        const hex = decimal.toString(16).toUpperCase();
        const binaryRaw = decimal.toString(2);
        const binaryPadded = val.split('').map(d => parseInt(d, 8).toString(2).padStart(3, '0')).join('');

        outHex.textContent = hex;
        outDec.textContent = decimal.toLocaleString();
        outBin.textContent = binaryRaw;

        let stepsHTML = `
            <div class="step-item mb-3">
                <div class="step-label text-pink">Step 1: Octal to Binary (3-bits each)</div>
                <div class="p-3 bg-white border rounded small">
                    <div class="d-flex flex-wrap gap-3">
                        ${val.split('').map(d => `<div><span class="fw-bold text-primary">${d}</span> → <span class="font-monospace">${parseInt(d, 8).toString(2).padStart(3, '0')}</span></div>`).join('')}
                    </div>
                    <div class="mt-2 font-monospace text-muted">Full Binary: ${binaryPadded}</div>
                </div>
            </div>
            <div class="step-item mb-3">
                <div class="step-label text-pink">Step 2: Group Binary into 4-bits</div>
                <div class="p-3 bg-white border rounded small">
                    <div class="font-monospace">${binaryRaw.padStart(Math.ceil(binaryRaw.length/4)*4, '0').match(/.{1,4}/g).join(' ')}</div>
                </div>
            </div>
            <div class="step-item">
                <div class="step-label text-pink">Step 3: Convert Groups to Hex</div>
                <div class="p-3 bg-white border rounded">
                    Result: <span class="fw-bold text-primary">${hex}</span>
                </div>
            </div>
        `;
        outSteps.innerHTML = stepsHTML;
    }

    function reset(){
        outHex.textContent = '—';
        outDec.textContent = '—';
        outBin.textContent = '—';
        outSteps.innerHTML = '';
    }

    input.addEventListener('input', calculate);

    document.querySelectorAll('.oct-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            input.value = btn.dataset.val;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        const val = outHex.textContent;
        if(val === '—') return;
        navigator.clipboard.writeText(val);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.oct-to-hex-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.oct-to-hex-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.oct-to-hex-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.oct-to-hex-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.oct-to-hex-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.oct-to-hex-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.oct-to-hex-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.oct-to-hex-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.oct-to-hex-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.oct-to-hex-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

.oct-to-hex-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; }
.oct-to-hex-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.oct-to-hex-rebuilt .stat-card-value { font-size: 1.15rem; font-weight: 700; color: #1e293b; word-break: break-all; }

.oct-to-hex-rebuilt .step-label { font-size: .85rem; font-weight: 700; color: #475569; margin-bottom: .5rem; display: flex; align-items: center; gap: .5rem; }
.oct-to-hex-rebuilt .step-label::before { content: ''; width: 6px; height: 6px; background: var(--tool-color); border-radius: 50%; }

@media (max-width: 768px) {
    .oct-to-hex-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\octal-to-hex-converter.blade.php ENDPATH**/ ?>