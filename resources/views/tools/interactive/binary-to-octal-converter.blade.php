<div class="row g-4 bin2oct-calc-rebuilt">
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
        <div class="output-card-themed" style="--tool-hue:150;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Octal Result</span>
                <div class="output-hero-value" id="out-oct">332</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2 text-primary"></i>3-Bit Grouping Steps</h6>
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

        // Pad to multiple of 3
        while (bin.length % 3 !== 0) bin = '0' + bin;

        const oct = parseInt(bin, 2).toString(8);
        $('out-oct').textContent = oct;

        let steps = [];
        steps.push(`<strong>1. Group bits into 3-bit sets:</strong>`);
        let groups = bin.match(/.{3}/g);
        steps.push(groups.join(' | '));

        steps.push(`<br><strong>2. Map each group to Octal:</strong>`);
        let map = groups.map(n => `${n} = ${parseInt(n, 2).toString(8)}`);
        steps.push(map.join('<br>'));

        steps.push(`<br><strong>Result:</strong> ${oct}`);
        $('math-steps').innerHTML = steps.join('<br>');
    }

    $('bin-in').addEventListener('input', calculate);
    calculate();
});
</script>

<style>
.bin2oct-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.bin2oct-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.bin2oct-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.bin2oct-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.bin2oct-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.bin2oct-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>
