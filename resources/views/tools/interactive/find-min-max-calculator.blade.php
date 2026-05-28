<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Enter Data (comma or space separated)</label>
                        <textarea id="fmm-input" class="form-control form-control-lg rounded-3" rows="3" placeholder="e.g. 45, -12, 89, 0, 104, 3.14">45, -12, 89, 0, 104, 3.14</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="fmm-output-card" style="--tool-hue:30;--tool-color:#c2410c;--tool-bg:rgba(234, 88, 12, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Dataset Extremes</span>
                <div class="row align-items-center">
                    <div class="col-6 border-end">
                        <div class="output-hero-value" id="out-fmm-min" style="font-size: 2.5rem;">-12</div>
                        <span class="output-hero-unit text-uppercase fw-bold" style="color:var(--tool-color)"><i class="fas fa-arrow-down me-1"></i> Minimum</span>
                    </div>
                    <div class="col-6">
                        <div class="output-hero-value" id="out-fmm-max" style="font-size: 2.5rem;">104</div>
                        <span class="output-hero-unit text-uppercase fw-bold" style="color:#f59e0b"><i class="fas fa-arrow-up me-1"></i> Maximum</span>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Total Count (n)</span><span class="stat-card-value" id="out-fmm-count">6</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Range</span><span class="stat-card-value" id="out-fmm-range">116</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Mean (Avg)</span><span class="stat-card-value" id="out-fmm-mean">38.69</span></div></div>
            </div>


            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="fmm-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Statistics
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function calculate() {
        const rawInput = $('fmm-input').value;
        const numbers = rawInput.split(/[\s,]+/).map(n => parseFloat(n)).filter(n => !isNaN(n));
        
        if (numbers.length === 0) {
            $('out-fmm-min').textContent = '--';
            $('out-fmm-max').textContent = '--';
            $('out-fmm-count').textContent = '--';
            $('out-fmm-range').textContent = '--';
            $('out-fmm-mean').textContent = '--';
            return;
        }

        const min = Math.min(...numbers);
        const max = Math.max(...numbers);
        const count = numbers.length;
        const range = max - min;
        const sum = numbers.reduce((a, b) => a + b, 0);
        const avg = sum / count;

        const formatNum = num => Number.isInteger(num) ? num.toString() : parseFloat(num.toFixed(4)).toString();

        $('out-fmm-min').textContent = formatNum(min);
        $('out-fmm-max').textContent = formatNum(max);
        $('out-fmm-count').textContent = count;
        $('out-fmm-range').textContent = formatNum(range);
        $('out-fmm-mean').textContent = formatNum(avg);
    }

    $('fmm-input').addEventListener('input', calculate);

    $('fmm-copy').addEventListener('click', function() {
        const min = $('out-fmm-min').textContent;
        const max = $('out-fmm-max').textContent;
        const text = `Min & Max Results\nMinimum: ${min}\nMaximum: ${max}\nRange: ${$('out-fmm-range').textContent}\n— ToolsHub Performance`;
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
.output-hero-unit { display:block; font-size:.85rem; }

.stat-card { background:#fff; padding:1.25rem; border-radius:16px; text-align:center; border:1px solid #f1f5f9; transition: all 0.3s; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
.stat-card-label { display:block; font-size:0.65rem; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.25rem; }
.stat-card-value { display:block; font-size:1.25rem; font-weight:800; color:#1e293b; }
</style>
