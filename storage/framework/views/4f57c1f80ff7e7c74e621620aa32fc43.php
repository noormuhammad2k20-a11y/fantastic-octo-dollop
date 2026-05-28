<div class="row g-4 dec2bin-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Decimal Input</label>
                        <input type="number" id="dec-in" class="form-control form-control-lg fw-bold text-center" value="255">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4338ca;--tool-bg:rgba(79,70,229,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Binary Result</span>
                <div class="output-hero-value" id="out-bin">11111111</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2 text-primary"></i>Successive Division Steps</h6>
                <div class="bg-white p-4 rounded-4 border shadow-sm small text-secondary overflow-auto" id="math-steps">
                    Steps...
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function calculate() {
        let dec = parseInt($('dec-in').value);
        if (isNaN(dec)) return;

        const bin = dec.toString(2);
        $('out-bin').textContent = bin;

        let steps = [];
        let quotient = dec;
        let bits = [];
        
        if (quotient === 0) steps.push(`0 ÷ 2 = 0 remainder <strong>0</strong>`);
        
        while (quotient > 0) {
            let rem = quotient % 2;
            steps.push(`${quotient} ÷ 2 = ${Math.floor(quotient / 2)} remainder <strong>${rem}</strong>`);
            bits.push(rem);
            quotient = Math.floor(quotient / 2);
        }

        steps.push(`<br>Result (reading remainders bottom-up): <strong>${bin}</strong>`);
        $('math-steps').innerHTML = steps.join('<br>');
    }

    $('dec-in').addEventListener('input', calculate);
    calculate();
});
</script>

<style>
.dec2bin-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.dec2bin-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.dec2bin-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.dec2bin-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.dec2bin-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.dec2bin-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\decimal-to-binary-converter.blade.php ENDPATH**/ ?>