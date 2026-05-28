<div class="row g-4 oct-to-bin-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Octal Number</label>
                    <input type="text" id="oct-input" class="form-control form-control-lg font-monospace" placeholder="e.g. 752" value="10">
                    <div class="mt-2 d-flex gap-2">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-val="7">7</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-val="52">52</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-val="123">123</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-val="777">777</button>
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-primary me-1"></i> <strong>Simple Rule:</strong> Every octal digit corresponds to exactly 3 binary bits.
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:210;--tool-color:#2563eb;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Binary Result</span>
                <div class="output-hero-value font-monospace" id="out-binary" style="word-break: break-all; font-size: 2.5rem;">—</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-12">
                    <div class="stat-card">
                        <span class="stat-card-label">Digit Mapping</span>
                        <div id="out-mapping" class="d-flex flex-wrap gap-2 mt-2">
                            {{-- Dynamic Mapping --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Binary</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('oct-input');
    const outBin = document.getElementById('out-binary');
    const outMap = document.getElementById('out-mapping');

    function calculate(){
        let val = input.value.trim();
        if(!val) { reset(); return; }

        if(!/^[0-7]+$/.test(val)){
            outBin.textContent = 'Invalid';
            outMap.innerHTML = '';
            return;
        }

        let binary = "";
        let mappingHTML = "";

        val.split('').forEach(digit => {
            const bits = parseInt(digit, 8).toString(2).padStart(3, '0');
            binary += bits;
            mappingHTML += `
                <div class="p-2 border rounded bg-white text-center" style="min-width: 60px;">
                    <div class="fw-bold text-primary">${digit}</div>
                    <div class="small text-muted font-monospace">${bits}</div>
                </div>
            `;
        });

        // Remove leading zeros for clean display, but keep at least one digit
        const cleanBinary = binary.replace(/^0+/, '') || "0";
        
        outBin.textContent = cleanBinary;
        outMap.innerHTML = mappingHTML;
    }

    function reset(){
        outBin.textContent = '—';
        outMap.innerHTML = '';
    }

    input.addEventListener('input', calculate);

    document.querySelectorAll('.oct-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            input.value = btn.dataset.val;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        const val = outBin.textContent;
        if(val === '—') return;
        navigator.clipboard.writeText(val);
        const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.oct-to-bin-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.oct-to-bin-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.oct-to-bin-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.oct-to-bin-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.oct-to-bin-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.oct-to-bin-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.oct-to-bin-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.oct-to-bin-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.oct-to-bin-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.oct-to-bin-rebuilt .output-hero-value { font-weight: 900; color: var(--tool-color); line-height: 1.2; margin: .5rem 0; }

.oct-to-bin-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; }
.oct-to-bin-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }

@media (max-width: 768px) {
    .oct-to-bin-rebuilt .output-hero-value { font-size: 1.75rem !important; }
}
</style>

