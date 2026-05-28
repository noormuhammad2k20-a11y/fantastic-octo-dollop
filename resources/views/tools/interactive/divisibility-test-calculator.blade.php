<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label-custom">Number to Test</label>
                        <input type="number" id="div-number" class="form-control form-control-lg rounded-3" placeholder="e.g. 144" value="144" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Custom Divisor (Opt)</label>
                        <input type="number" id="div-custom" class="form-control form-control-lg rounded-3" placeholder="e.g. 12" value="12" min="1">
                    </div>
                </div>
                <div class="mt-4 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-purple me-1" style="color:#a855f7"></i> Divisibility means dividing a number by another without leaving a remainder.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="div-output-card" style="--tool-hue:270;--tool-color:#7e22ce;--tool-bg:rgba(168, 85, 247, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Custom Divisor Status</span>
                <div class="output-hero-value" id="out-div-result">Is Divisible</div>
                <span class="output-hero-unit" id="out-div-equation">144 ÷ 12 = 12</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Number Tested</span><span class="stat-card-value" id="out-div-num">144</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Pass Count</span><span class="stat-card-value" id="out-div-count">6</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Result Status</span><span class="stat-card-value" id="out-div-status">Pass</span></div></div>
            </div>


            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="div-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Report
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function calculate() {
        const num = parseFloat($('div-number').value);
        let customRaw = $('div-custom').value.trim();
        let customDiv = customRaw === '' ? null : parseFloat(customRaw);
        
        if (isNaN(num) || num < 0) {
            $('out-div-result').textContent = '--';
            $('out-div-equation').textContent = 'Waiting for input...';
            $('out-div-num').textContent = '--';
            $('out-div-count').textContent = '--';
            $('out-div-status').textContent = '--';
            return;
        }

        $('out-div-num').textContent = num;

        // Custom Divisor
        if (customDiv !== null) {
            if (isNaN(customDiv) || customDiv === 0) {
                showError('Cannot divide by zero.');
            } else {
                const isDiv = num % customDiv === 0;
                $('out-div-result').textContent = isDiv ? 'Is Divisible' : 'Not Divisible';
                $('out-div-status').textContent = isDiv ? 'Pass' : 'Fail';
                $('out-div-result').style.color = isDiv ? '#10b981' : '#ef4444';
                
                if (isDiv) {
                    $('out-div-equation').textContent = `${num} ÷ ${customDiv} = ${num / customDiv}`;
                } else {
                    const remainder = num % customDiv;
                    $('out-div-equation').textContent = `${num} ÷ ${customDiv} = ${Math.floor(num/customDiv)} Rem ${remainder}`;
                }
            }
        } else {
            $('out-div-result').textContent = 'No Custom Test';
            $('out-div-result').style.color = 'var(--tool-color)';
            $('out-div-equation').textContent = 'Enter a custom divisor above';
            $('out-div-status').textContent = '--';
        }

        // Standard Tests
        const standardTests = [2, 3, 4, 5, 6, 8, 9, 10];
        let passCount = 0;

        standardTests.forEach(test => {
            const isDiv = num % test === 0;
            if (isDiv) passCount++;
        });
        
        $('out-div-count').textContent = passCount;
    }

    function showError(msg) {
        $('out-div-result').textContent = 'Error';
        $('out-div-result').style.color = '#ef4444';
        $('out-div-equation').textContent = msg;
        $('out-div-status').textContent = 'Error';
    }

    ['div-number', 'div-custom'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    $('div-copy').addEventListener('click', function() {
        const num = $('div-number').value;
        const result = $('out-div-result').textContent;
        const text = `Divisibility Test Results\nNumber: ${num}\nStatus: ${result}\n— ToolsHub Performance`;
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
.output-hero-value { font-size:3rem; font-weight:900; line-height:1.2; margin-bottom:.5rem; color:var(--tool-color); transition: color 0.3s; }
.output-hero-unit { display:block; font-size:.95rem; font-weight:600; color:#94a3b8; }

.stat-card { background:#fff; padding:1.25rem; border-radius:16px; text-align:center; border:1px solid #f1f5f9; transition: all 0.3s; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
.stat-card-label { display:block; font-size:0.65rem; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.25rem; }
.stat-card-value { display:block; font-size:1.25rem; font-weight:800; color:#1e293b; }

.div-test-box:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
</style>
