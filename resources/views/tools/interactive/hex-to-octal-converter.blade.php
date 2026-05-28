<div class="row g-4 hex-to-oct-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Hexadecimal Number</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">0x</span>
                        <input type="text" id="hex-input" class="form-control form-control-lg border-start-0 font-monospace text-uppercase" placeholder="e.g. FF3C" value="FF">
                    </div>
                    <div class="mt-2 d-flex gap-2">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill hex-quick" data-val="A">0xA</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill hex-quick" data-val="FF">0xFF</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill hex-quick" data-val="100">0x100</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill hex-quick" data-val="ABCD">0xABCD</button>
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-primary me-1"></i> <strong>Pro Tip:</strong> We first convert Hex to Binary, then group binary into 3-bit segments for the final Octal value.
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Octal Result</span>
                <div class="output-hero-value" id="out-octal">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-meta">Base 8</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Decimal Value</span><span class="stat-card-value" id="out-decimal">—</span></div></div>
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Binary Value</span><span class="stat-card-value font-monospace" id="out-binary" style="font-size: 0.9rem;">—</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-stream me-2 text-primary"></i>Step-by-Step Conversion</h6>
            <div id="out-steps" class="steps-container">
                {{-- Dynamic Steps --}}
            </div>

            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-dark flex-grow-1 py-3 fw-bold rounded-3" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Result</button>
                <button class="btn btn-outline-dark px-4 py-3 fw-bold rounded-3" onclick="window.print()"><i class="fas fa-download"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const hexInput = document.getElementById('hex-input');
    const outOctal = document.getElementById('out-octal');
    const outDecimal = document.getElementById('out-decimal');
    const outBinary = document.getElementById('out-binary');
    const outSteps = document.getElementById('out-steps');

    function calculate(){
        let hex = hexInput.value.trim().toUpperCase();
        if(!hex){
            reset();
            return;
        }

        // Validate
        if(!/^[0-9A-F]+$/.test(hex)){
            outOctal.textContent = 'Invalid';
            outSteps.innerHTML = '<div class="alert alert-danger py-2">Invalid Hexadecimal characters found.</div>';
            return;
        }

        // 1. Hex to Decimal
        const decimal = parseInt(hex, 16);
        // 2. Decimal to Binary (padded to 4 bits per hex digit)
        const binaryRaw = decimal.toString(2);
        const binaryPadded = hex.split('').map(char => parseInt(char, 16).toString(2).padStart(4, '0')).join('');
        // 3. Decimal to Octal
        const octal = decimal.toString(8);

        outOctal.textContent = octal;
        outDecimal.textContent = decimal.toLocaleString();
        outBinary.textContent = binaryPadded.match(/.{1,4}/g).join(' ');

        // Generate Steps
        let stepsHTML = `
            <div class="step-item mb-3">
                <div class="step-label">Step 1: Convert Hex to Binary (4-bits each)</div>
                <div class="step-content p-3 bg-white border rounded">
                    <div class="d-flex flex-wrap gap-3 text-center">
                        ${hex.split('').map(char => `
                            <div>
                                <div class="fw-bold text-primary">${char}</div>
                                <div class="small text-muted">↓</div>
                                <div class="font-monospace">${parseInt(char, 16).toString(2).padStart(4, '0')}</div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </div>
            <div class="step-item mb-3">
                <div class="step-label">Step 2: Group Binary into 3-bits (from right)</div>
                <div class="step-content p-3 bg-white border rounded">
                    <div class="font-monospace text-break">${binaryPadded}</div>
                    <div class="small text-muted mt-2">Grouped for Base 8:</div>
                    <div class="fw-bold text-success mt-1">${binaryRaw.padStart(Math.ceil(binaryRaw.length/3)*3, '0').match(/.{1,3}/g).join(' ')}</div>
                </div>
            </div>
            <div class="step-item">
                <div class="step-label">Step 3: Convert Groups to Octal</div>
                <div class="step-content p-3 bg-white border rounded">
                    Result: <span class="fw-bold text-primary">${octal}</span>
                </div>
            </div>
        `;
        outSteps.innerHTML = stepsHTML;
    }

    function reset(){
        outOctal.textContent = '—';
        outDecimal.textContent = '—';
        outBinary.textContent = '—';
        outSteps.innerHTML = '';
    }

    hexInput.addEventListener('input', calculate);

    document.querySelectorAll('.hex-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            hexInput.value = btn.dataset.val;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        const val = outOctal.textContent;
        if(val === '—') return;
        navigator.clipboard.writeText(val).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

    calculate();
});
</script>

<style>
.hex-to-oct-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.hex-to-oct-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.hex-to-oct-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.hex-to-oct-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.hex-to-oct-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.hex-to-oct-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.hex-to-oct-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.hex-to-oct-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.hex-to-oct-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.hex-to-oct-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

.hex-to-oct-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; }
.hex-to-oct-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.hex-to-oct-rebuilt .stat-card-value { font-size: 1.15rem; font-weight: 700; color: #1e293b; }

.hex-to-oct-rebuilt .step-label { font-size: .85rem; font-weight: 700; color: #475569; margin-bottom: .5rem; display: flex; align-items: center; gap: .5rem; }
.hex-to-oct-rebuilt .step-label::before { content: ''; width: 6px; height: 6px; background: var(--tool-color); border-radius: 50%; }

@media (max-width: 768px) {
    .hex-to-oct-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

