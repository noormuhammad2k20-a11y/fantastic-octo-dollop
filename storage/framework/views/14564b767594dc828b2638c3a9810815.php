<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Dataset (comma, space, or newline separated)</label>
                        <textarea id="sn-input" class="form-control form-control-lg rounded-3" rows="4" placeholder="e.g. 42, 7, -19, 0, 100, 3.14">42, 7, -19, 0, 100, 3.14</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="sn-output-card" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(139, 92, 246, 0.04); transition: all 0.4s;">
            <div class="output-hero mb-4">
                <span class="output-hero-label"><i class="fas fa-arrow-up-1-9 me-1"></i>Ascending Order</span>
                <div class="p-3 bg-white border rounded-3 text-start fs-5 fw-bold" id="out-sn-asc" style="word-wrap: break-word; color:#1e293b; max-height: 150px; overflow-y: auto; border-color: rgba(139, 92, 246, 0.2) !important;">
                    -19, 0, 3.14, 7, 42, 100
                </div>
            </div>

            <div class="output-hero mb-4">
                <span class="output-hero-label"><i class="fas fa-arrow-down-9-1 me-1"></i>Descending Order</span>
                <div class="p-3 bg-white border rounded-3 text-start fs-5 fw-bold" id="out-sn-desc" style="word-wrap: break-word; color:#1e293b; max-height: 150px; overflow-y: auto; border-color: rgba(245, 158, 11, 0.2) !important;">
                    100, 42, 7, 3.14, 0, -19
                </div>
            </div>

            <div class="row g-3">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Total Items</span><span class="stat-card-value" id="out-sn-count">6</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Smallest</span><span class="stat-card-value" id="out-sn-min">-19</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Largest</span><span class="stat-card-value" id="out-sn-max">100</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Median</span><span class="stat-card-value" id="out-sn-median">5.07</span></div></div>
            </div>

            <div class="d-flex gap-3 justify-content-center mt-4 flex-wrap">
                <button class="btn btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm flex-grow-1" id="sn-copy-asc" style="max-width: 280px;">
                    <i class="fas fa-copy me-2"></i>Copy Ascending
                </button>
                <button class="btn btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm flex-grow-1" id="sn-copy-desc" style="max-width: 280px;">
                    <i class="fas fa-copy me-2"></i>Copy Descending
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function calculate() {
        const rawInput = $('sn-input').value;
        const numbers = rawInput.split(/[\s,]+/).map(n => parseFloat(n)).filter(n => !isNaN(n));
        
        if (numbers.length === 0) {
            $('out-sn-asc').textContent = '--';
            $('out-sn-desc').textContent = '--';
            $('out-sn-count').textContent = '0';
            $('out-sn-min').textContent = '--';
            $('out-sn-max').textContent = '--';
            $('out-sn-median').textContent = '--';
            return;
        }

        const asc = [...numbers].sort((a, b) => a - b);
        const desc = [...numbers].sort((a, b) => b - a);

        const formatNum = num => Number.isInteger(num) ? num.toLocaleString() : parseFloat(num.toFixed(4)).toLocaleString();

        $('out-sn-asc').textContent = asc.map(formatNum).join(', ');
        $('out-sn-desc').textContent = desc.map(formatNum).join(', ');

        const count = numbers.length;
        const min = asc[0];
        const max = asc[count - 1];
        const median = count % 2 === 0 
            ? (asc[count/2 - 1] + asc[count/2]) / 2 
            : asc[Math.floor(count/2)];

        $('out-sn-count').textContent = count;
        $('out-sn-min').textContent = formatNum(min);
        $('out-sn-max').textContent = formatNum(max);
        $('out-sn-median').textContent = formatNum(median);
    }

    $('sn-input').addEventListener('input', calculate);

    function copyToClipboard(id, btn) {
        const text = $(id).textContent;
        navigator.clipboard.writeText(text).then(() => {
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => { btn.innerHTML = originalHTML; }, 2000);
        });
    }

    $('sn-copy-asc').addEventListener('click', function() { copyToClipboard('out-sn-asc', this); });
    $('sn-copy-desc').addEventListener('click', function() { copyToClipboard('out-sn-desc', this); });

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
.output-hero { text-align:center; padding:1.5rem; background:#fff; border-radius:16px; box-shadow:0 2px 12px rgba(0,0,0,.03); border:1px solid rgba(0,0,0,.05); }
.output-hero-label { display:block; font-size:.75rem; font-weight:800; color:#64748b; text-transform:uppercase; letter-spacing:1px; margin-bottom:1rem; text-align: left; }

.stat-card { background:#fff; padding:1.25rem; border-radius:16px; text-align:center; border:1px solid #f1f5f9; transition: all 0.3s; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
.stat-card-label { display:block; font-size:0.65rem; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.25rem; }
.stat-card-value { display:block; font-size:1.25rem; font-weight:800; color:#1e293b; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\sort-numbers.blade.php ENDPATH**/ ?>