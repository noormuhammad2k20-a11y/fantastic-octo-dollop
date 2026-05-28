<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Enter Numbers (comma, space, or newline separated)</label>
                        <textarea id="sum-input" class="form-control form-control-lg rounded-3" rows="4" placeholder="e.g. 15, 25, 35.5, -10">15, 25, 35.5, -10</textarea>
                    </div>
                </div>
                <div class="mt-4 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-success me-1"></i> The sum is the result of adding all provided numbers together.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="sum-output-card" style="--tool-hue:140;--tool-color:#16a34a;--tool-bg:rgba(34, 197, 94, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Final Sum Result</span>
                <div class="output-hero-value" id="out-sum-result">65.5</div>
                <div class="output-hero-unit text-truncate px-3" id="out-sum-equation">15 + 25 + 35.5 - 10 = 65.5</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Numbers Count</span><span class="stat-card-value" id="out-sum-count">4</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Average</span><span class="stat-card-value" id="out-sum-avg">16.37</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Smallest</span><span class="stat-card-value" id="out-sum-min">-10</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Largest</span><span class="stat-card-value" id="out-sum-max">35.5</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-list-ol me-2 text-success"></i>Calculation Breakdown</h6>
            <div class="d-flex flex-column gap-2" id="out-sum-breakdown">
                <!-- Breakdown will be injected here via JS -->
            </div>

            <div class="mt-4" id="out-sum-insights">
                <h6 class="fw-bold mb-3"><i class="fas fa-lightbulb me-2 text-warning"></i>Mathematical Logic</h6>
                <div class="bg-white p-3 rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-success me-2"></i>Summation is the addition of a sequence of numbers. The result is the total amount of all values combined.
                </div>
            </div>
            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="sum-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Solution
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function calculate() {
        const rawInput = $('sum-input').value;
        const numbers = rawInput.split(/[\s,]+/).map(n => parseFloat(n)).filter(n => !isNaN(n));
        
        if (numbers.length === 0) {
            $('out-sum-result').textContent = '--';
            $('out-sum-equation').textContent = 'Waiting for input...';
            $('out-sum-count').textContent = '0';
            $('out-sum-avg').textContent = '--';
            $('out-sum-min').textContent = '--';
            $('out-sum-max').textContent = '--';
            $('out-sum-breakdown').innerHTML = '<div class="text-center py-4 text-muted"><i class="fas fa-keyboard mb-2 d-block fs-2"></i>Enter numbers to calculate</div>';
            return;
        }

        let sum = 0;
        let breakdownHTML = '';
        let min = numbers[0], max = numbers[0];
        const eqParts = [];

        numbers.forEach((num, index) => {
            const prev = sum;
            sum += num;
            if (num < min) min = num;
            if (num > max) max = num;
            
            eqParts.push(num < 0 ? `(${num})` : num.toLocaleString());
            
            if (index > 0) {
                breakdownHTML += `
                    <div class="breakdown-item p-3 rounded-3 border-start border-4 bg-white shadow-sm mb-2" style="border-color: #22c55e">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-emerald-soft text-emerald rounded-pill mb-1">Step ${index}</span>
                                <div class="fw-bold text-dark">${prev.toLocaleString()} + ${num.toLocaleString()}</div>
                            </div>
                            <div class="fs-5 fw-bold text-success">= ${sum.toLocaleString()}</div>
                        </div>
                    </div>
                `;
            }
        });

        const avg = sum / numbers.length;
        const format = n => Number.isInteger(n) ? n.toLocaleString() : parseFloat(n.toFixed(4)).toLocaleString();

        $('out-sum-result').textContent = format(sum);
        $('out-sum-equation').textContent = eqParts.join(' + ') + ' = ' + format(sum);
        $('out-sum-count').textContent = numbers.length;
        $('out-sum-avg').textContent = format(avg);
        $('out-sum-min').textContent = format(min);
        $('out-sum-max').textContent = format(max);
        $('out-sum-breakdown').innerHTML = breakdownHTML || '<div class="text-center py-3 text-muted">Only one number entered.</div>';
    }

    $('sum-input').addEventListener('input', calculate);

    $('sum-copy').addEventListener('click', function() {
        const text = `Sum Calculation\nInput: ${$('sum-input').value}\nTotal Sum: ${$('out-sum-result').textContent}\n— ToolsHub Performance`;
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
.output-hero-label { display:block; font-size:.85rem; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:1px; margin-bottom:.5rem; }
.output-hero-value { font-size:3.5rem; font-weight:900; line-height:1.2; margin-bottom:.5rem; color:var(--tool-color); }
.output-hero-unit { display:block; font-size:.85rem; font-weight:600; color:#94a3b8; }

.stat-card { background:#fff; padding:1.25rem; border-radius:16px; text-align:center; border:1px solid #f1f5f9; transition: all 0.3s; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
.stat-card-label { display:block; font-size:0.65rem; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.25rem; }
.stat-card-value { display:block; font-size:1.25rem; font-weight:800; color:#1e293b; }

.breakdown-item { transition: transform 0.2s; }
.breakdown-item:hover { transform: translateX(5px); }
.bg-emerald-soft { background: rgba(16, 185, 129, 0.1); }
.text-emerald { color: #10b981; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\sum-calculator.blade.php ENDPATH**/ ?>