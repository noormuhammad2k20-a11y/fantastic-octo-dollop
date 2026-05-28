<div class="row g-4 hex2dec-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Hex Input</label>
                        <input type="text" id="hex-in" class="form-control form-control-lg fw-bold text-center text-uppercase" value="2FA">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Decimal Result (Base 10)</span>
                <div class="output-hero-value" id="out-dec">762</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2 text-primary"></i>Positional Notation Steps</h6>
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
        const hex = $('hex-in').value.trim().toUpperCase();
        if (!hex) return;

        const dec = parseInt(hex, 16);
        if (isNaN(dec)) {
            $('out-dec').textContent = 'Invalid Hex';
            return;
        }

        $('out-dec').textContent = dec;

        let steps = [];
        let chars = hex.split('').reverse();
        let terms = [];
        chars.forEach((char, i) => {
            let val = parseInt(char, 16);
            terms.push(`(${val} × 16<sup>${i}</sup>)`);
        });
        
        steps.push(`<strong>Expansion:</strong>`);
        steps.push(terms.reverse().join(' + '));
        
        let sumTerms = chars.map((char, i) => parseInt(char, 16) * Math.pow(16, i)).reverse();
        steps.push(`<br><strong>Values:</strong>`);
        steps.push(`${sumTerms.join(' + ')} = <strong>${dec}</strong>`);

        $('math-steps').innerHTML = steps.join('<br>');
    }

    $('hex-in').addEventListener('input', calculate);
    calculate();
});
</script>

<style>
.hex2dec-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.hex2dec-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.hex2dec-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.hex2dec-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.hex2dec-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.hex2dec-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\hex-to-decimal-converter.blade.php ENDPATH**/ ?>