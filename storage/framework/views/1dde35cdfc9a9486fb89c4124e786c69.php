<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Total Amount</label>
                        <input type="number" id="dtp-total" class="form-control form-control-lg rounded-3 mb-3" placeholder="e.g. 1000" value="1000">
                    </div>
                </div>
                <label class="form-label-custom">Ratio (Part A : Part B)</label>
                <div class="row g-2 align-items-center">
                    <div class="col-5">
                        <input type="number" id="dtp-ratio-a" class="form-control form-control-lg text-center fw-bold" placeholder="Part A" value="3" min="0">
                    </div>
                    <div class="col-2 text-center fs-3 fw-bold text-muted">:</div>
                    <div class="col-5">
                        <input type="number" id="dtp-ratio-b" class="form-control form-control-lg text-center fw-bold" placeholder="Part B" value="2" min="0">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="dtp-output-card" style="--tool-hue:200;--tool-color:#0284c7;--tool-bg:rgba(56, 189, 248, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Calculated Distribution</span>
                <div class="row align-items-center">
                    <div class="col-6 border-end">
                        <div class="output-hero-value" id="out-dtp-part-a" style="font-size: 2.5rem;">600</div>
                        <span class="output-hero-unit text-uppercase fw-bold" style="color:var(--tool-color)">Part A</span>
                    </div>
                    <div class="col-6">
                        <div class="output-hero-value" id="out-dtp-part-b" style="font-size: 2.5rem;">400</div>
                        <span class="output-hero-unit text-uppercase fw-bold" style="color:#f59e0b">Part B</span>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Total Ratio</span><span class="stat-card-value" id="out-dtp-total-parts">5</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Value of 1 Part</span><span class="stat-card-value" id="out-dtp-one-part">200</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Split Ratio</span><span class="stat-card-value" id="out-dtp-ratio-display">3 : 2</span></div></div>
            </div>


            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="dtp-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Distribution
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function calculate() {
        const total = parseFloat($('dtp-total').value);
        const ratioA = parseFloat($('dtp-ratio-a').value);
        const ratioB = parseFloat($('dtp-ratio-b').value);
        
        if (isNaN(total) || isNaN(ratioA) || isNaN(ratioB)) {
            $('out-dtp-part-a').textContent = '--';
            $('out-dtp-part-b').textContent = '--';
            $('out-dtp-total-parts').textContent = '--';
            $('out-dtp-one-part').textContent = '--';
            $('out-dtp-ratio-display').textContent = '--';
            return;
        }

        const totalParts = ratioA + ratioB;
        if (totalParts === 0) {
            showError('Total ratio cannot be zero.');
            return;
        }

        const valA = (ratioA / totalParts) * total;
        const valB = (ratioB / totalParts) * total;
        const onePart = total / totalParts;

        const formatNum = num => Number.isInteger(num) ? num.toString() : parseFloat(num.toFixed(4)).toString();

        $('out-dtp-part-a').textContent = formatNum(valA);
        $('out-dtp-part-b').textContent = formatNum(valB);
        $('out-dtp-total-parts').textContent = totalParts;
        $('out-dtp-one-part').textContent = formatNum(onePart);
        $('out-dtp-ratio-display').textContent = `${ratioA} : ${ratioB}`;
    }

    function showError(msg) {
        $('out-dtp-part-a').textContent = '--';
        $('out-dtp-part-b').textContent = '--';
        $('out-dtp-total-parts').textContent = '--';
        $('out-dtp-one-part').textContent = '--';
        $('out-dtp-ratio-display').textContent = '--';
    }

    ['dtp-total', 'dtp-ratio-a', 'dtp-ratio-b'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    $('dtp-copy').addEventListener('click', function() {
        const a = $('out-dtp-part-a').textContent;
        const b = $('out-dtp-part-b').textContent;
        const tot = $('dtp-total').value;
        const text = `Ratio Distribution Results\nTotal: ${tot}\nPart A: ${a}\nPart B: ${b}\n— ToolsHub Performance`;
        navigator.clipboard.writeText(text).then(() => {
            const originalHTML = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => { this.innerHTML = originalHTML; }, 2000);
        });
    });

    calculate();
});
</script>

<style>
.tri-calc-rebuilt .calculator-card { background:#fff; border:1px solid #e5e7eb; border-radius:20px; padding:2rem; box-shadow:0 4px 24px rgba(0,0,0,.04); }
.tri-calc-rebuilt .calculator-header { display:flex; align-items:center; gap:1rem; margin-bottom:2rem; }
.tri-calc-rebuilt .calculator-header h4 { margin:0; font-weight:800; color:#1e293b; }
.tri-calc-rebuilt .calculator-header p { margin:0; font-size:.9rem; color:#64748b; }
.tri-calc-rebuilt .tool-icon-circle { width:56px; height:56px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:1.4rem; flex-shrink:0; }
.tri-calc-rebuilt .form-label-custom { font-size:.8rem; font-weight:700; color:#475569; text-transform:uppercase; letter-spacing:.5px; margin-bottom:.4rem; display:block; }

.output-card-themed { background:var(--tool-bg); border:1px solid rgba(0,0,0,.05); border-radius:20px; padding:2rem; box-shadow:0 4px 24px rgba(0,0,0,.04); transition:all .4s }
.output-hero { text-align:center; padding:2rem; background:#fff; border-radius:16px; margin-bottom:2rem; box-shadow:0 2px 12px rgba(0,0,0,.03); border:1px solid rgba(0,0,0,.05); }
.output-hero-label { display:block; font-size:.85rem; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:1px; margin-bottom:1rem; }
.output-hero-value { font-weight:900; line-height:1.2; margin-bottom:.5rem; color:var(--tool-color); }
.output-hero-unit { display:block; font-size:.85rem; font-weight:600; color:#94a3b8; }

.stat-card { background:#fff; padding:1.25rem; border-radius:16px; text-align:center; border:1px solid #f1f5f9; transition: all 0.3s; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
.stat-card-label { display:block; font-size:0.65rem; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.25rem; }
.stat-card-value { display:block; font-size:1.25rem; font-weight:800; color:#1e293b; }

.segment-bar { transition:transform .2s; }
.segment-bar:hover { transform:translateX(4px); }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\divide-into-two-parts.blade.php ENDPATH**/ ?>