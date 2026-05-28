<div class="row g-4 oct-to-dec-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Octal Number</label>
                    <input type="text" id="oct-input" class="form-control form-control-lg font-monospace" placeholder="e.g. 52" value="10">
                    <div class="mt-2 d-flex gap-2">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-val="7">7</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-val="10">10</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-val="100">100</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill oct-quick" data-val="1777">1777</button>
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-primary me-1"></i> <strong>Formula:</strong> Value = Σ (Digit × 8<sup>Position</sup>)
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Decimal Result</span>
                <div class="output-hero-value" id="out-decimal">—</div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-calculator me-2 text-violet"></i>Mathematical Expansion</h6>
            <div id="out-expansion" class="p-3 bg-white border rounded-3 font-monospace text-center">
                {{-- Dynamic Expansion --}}
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Decimal</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('oct-input');
    const outDec = document.getElementById('out-decimal');
    const outExp = document.getElementById('out-expansion');

    function calculate(){
        let val = input.value.trim();
        if(!val) { reset(); return; }

        if(!/^[0-7]+$/.test(val)){
            outDec.textContent = 'Invalid';
            outExp.innerHTML = 'Please enter valid octal digits (0-7).';
            return;
        }

        const digits = val.split('');
        const len = digits.length;
        let decimal = 0;
        let expansion = [];

        digits.forEach((digit, index) => {
            const pos = len - 1 - index;
            const power = Math.pow(8, pos);
            const subtotal = parseInt(digit, 8) * power;
            decimal += subtotal;
            expansion.push(`(${digit} × 8<sup>${pos}</sup>)`);
        });

        outDec.textContent = decimal.toLocaleString();
        outExp.innerHTML = expansion.join(' + ') + ' = <span class="text-primary fw-bold">' + decimal + '</span>';
    }

    function reset(){
        outDec.textContent = '—';
        outExp.innerHTML = '';
    }

    input.addEventListener('input', calculate);

    document.querySelectorAll('.oct-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            input.value = btn.dataset.val;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        const val = outDec.textContent.replace(/,/g, '');
        if(val === '—') return;
        navigator.clipboard.writeText(val);
        const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.oct-to-dec-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.oct-to-dec-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.oct-to-dec-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.oct-to-dec-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.oct-to-dec-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.oct-to-dec-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.oct-to-dec-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.oct-to-dec-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.oct-to-dec-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.oct-to-dec-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

@media (max-width: 768px) {
    .oct-to-dec-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

