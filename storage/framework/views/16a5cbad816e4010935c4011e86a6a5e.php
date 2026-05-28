<div class="row g-4 hex2bin-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Hex Input</label>
                        <input type="text" id="hex-in" class="form-control form-control-lg fw-bold text-center text-uppercase" value="ABCD">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Binary Result</span>
                <div class="output-hero-value font-monospace fs-4" id="out-bin">1010 1011 1100 1101</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2 text-primary"></i>Digit-by-Digit Mapping</h6>
                <div class="bg-white p-4 rounded-4 border shadow-sm small text-secondary" id="math-steps">
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

        let binArr = [];
        let steps = [];
        
        for (let char of hex) {
            let dec = parseInt(char, 16);
            if (isNaN(dec)) continue;
            let bin = dec.toString(2).padStart(4, '0');
            binArr.push(bin);
            steps.push(`${char} → <strong>${bin}</strong>`);
        }

        $('out-bin').textContent = binArr.join(' ');
        $('math-steps').innerHTML = steps.join('<br>');
    }

    $('hex-in').addEventListener('input', calculate);
    calculate();
});
</script>

<style>
.hex2bin-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.hex2bin-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.hex2bin-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.hex2bin-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.hex2bin-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.hex2bin-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\hex-to-binary-converter.blade.php ENDPATH**/ ?>