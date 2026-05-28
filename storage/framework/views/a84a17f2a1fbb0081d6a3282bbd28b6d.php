<div class="row g-4 bin2hex-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Binary Input</label>
                        <input type="text" id="bin-in" class="form-control form-control-lg fw-bold text-center" value="11011010">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Hexadecimal Result</span>
                <div class="output-hero-value text-uppercase" id="out-hex">DA</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2 text-primary"></i>Nibble Grouping Steps</h6>
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
        let bin = $('bin-in').value.trim();
        if (!bin) return;

        // Pad to multiple of 4
        while (bin.length % 4 !== 0) bin = '0' + bin;

        const hex = parseInt(bin, 2).toString(16).toUpperCase();
        $('out-hex').textContent = hex;

        let steps = [];
        steps.push(`<strong>1. Group bits into 4-bit nibbles:</strong>`);
        let nibbles = bin.match(/.{4}/g);
        steps.push(nibbles.join(' | '));

        steps.push(`<br><strong>2. Map each nibble to Hex:</strong>`);
        let map = nibbles.map(n => `${n} = ${parseInt(n, 2).toString(16).toUpperCase()}`);
        steps.push(map.join('<br>'));

        steps.push(`<br><strong>Result:</strong> ${hex}`);
        $('math-steps').innerHTML = steps.join('<br>');
    }

    $('bin-in').addEventListener('input', calculate);
    calculate();
});
</script>

<style>
.bin2hex-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.bin2hex-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.bin2hex-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.bin2hex-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.bin2hex-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.bin2hex-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\binary-to-hex-converter.blade.php ENDPATH**/ ?>