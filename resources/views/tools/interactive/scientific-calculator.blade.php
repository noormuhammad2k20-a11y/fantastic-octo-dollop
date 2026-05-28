<div class="row g-4 scientific-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="calc-display mb-4">
                    <div id="calc-history" class="calc-history-text"></div>
                    <div id="calc-main-display" class="calc-main-text">0</div>
                </div>

                <div class="scientific-grid">
                    <!-- Functions -->
                    <button class="btn btn-calc-fn" data-op="sin">sin</button>
                    <button class="btn btn-calc-fn" data-op="cos">cos</button>
                    <button class="btn btn-calc-fn" data-op="tan">tan</button>
                    <button class="btn btn-calc-fn" data-op="deg">deg/rad</button>
                    
                    <button class="btn btn-calc-fn" data-op="log">log</button>
                    <button class="btn btn-calc-fn" data-op="ln">ln</button>
                    <button class="btn btn-calc-fn" data-op="sqrt">√</button>
                    <button class="btn btn-calc-fn" data-op="pow">xⁿ</button>

                    <!-- Row 1 -->
                    <button class="btn btn-calc-clear" id="btn-clear" style="min-width: 280px; max-width: 100%;">AC</button>
                    <button class="btn btn-calc-op" data-val="(">(</button>
                    <button class="btn btn-calc-op" data-val=")">)</button>
                    <button class="btn btn-calc-op" data-val="/">÷</button>

                    <!-- Row 2 -->
                    <button class="btn btn-calc-num" data-val="7">7</button>
                    <button class="btn btn-calc-num" data-val="8">8</button>
                    <button class="btn btn-calc-num" data-val="9">9</button>
                    <button class="btn btn-calc-op" data-val="*">×</button>

                    <!-- Row 3 -->
                    <button class="btn btn-calc-num" data-val="4">4</button>
                    <button class="btn btn-calc-num" data-val="5">5</button>
                    <button class="btn btn-calc-num" data-val="6">6</button>
                    <button class="btn btn-calc-op" data-val="-">−</button>

                    <!-- Row 4 -->
                    <button class="btn btn-calc-num" data-val="1">1</button>
                    <button class="btn btn-calc-num" data-val="2">2</button>
                    <button class="btn btn-calc-num" data-val="3">3</button>
                    <button class="btn btn-calc-op" data-val="+">+</button>

                    <!-- Row 5 -->
                    <button class="btn btn-calc-num" data-val="0">0</button>
                    <button class="btn btn-calc-num" data-val=".">.</button>
                    <button class="btn btn-calc-num" data-val="PI">π</button>
                    <button class="btn btn-calc-equals" id="btn-equals" style="min-width: 280px; max-width: 100%;">=</button>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-secondary-action flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2"></i>Copy Result
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mainDisplay = document.getElementById('calc-main-display');
    const historyDisplay = document.getElementById('calc-history');
    let currentInput = '0';
    let isRad = true;

    function updateDisplay() {
        mainDisplay.textContent = currentInput;
    }

    document.querySelectorAll('.btn-calc-num').forEach(btn => {
        btn.addEventListener('click', () => {
            const val = btn.dataset.val;
            if (val === 'PI') {
                currentInput = currentInput === '0' ? Math.PI.toString() : currentInput + Math.PI;
            } else {
                currentInput = currentInput === '0' ? val : currentInput + val;
            }
            updateDisplay();
        });
    });

    document.querySelectorAll('.btn-calc-op').forEach(btn => {
        btn.addEventListener('click', () => {
            const val = btn.dataset.val;
            currentInput += ' ' + val + ' ';
            updateDisplay();
        });
    });

    document.getElementById('btn-clear').addEventListener('click', () => {
        currentInput = '0';
        historyDisplay.textContent = '';
        updateDisplay();
    });

    document.querySelectorAll('.btn-calc-fn').forEach(btn => {
        btn.addEventListener('click', () => {
            const op = btn.dataset.op;
            if (op === 'deg') {
                isRad = !isRad;
                btn.textContent = isRad ? 'rad' : 'deg';
                return;
            }
            // Simple wrapper for demo; in production use a math library
            try {
                let num = eval(currentInput.replace('÷', '/').replace('×', '*'));
                if (op === 'sin') num = isRad ? Math.sin(num) : Math.sin(num * Math.PI / 180);
                if (op === 'cos') num = isRad ? Math.cos(num) : Math.cos(num * Math.PI / 180);
                if (op === 'tan') num = isRad ? Math.tan(num) : Math.tan(num * Math.PI / 180);
                if (op === 'log') num = Math.log10(num);
                if (op === 'ln') num = Math.log(num);
                if (op === 'sqrt') num = Math.sqrt(num);
                
                historyDisplay.textContent = op + '(' + currentInput + ')';
                currentInput = num.toString();
                updateDisplay();
            } catch (e) {
                currentInput = 'Error';
                updateDisplay();
            }
        });
    });

    document.getElementById('btn-equals').addEventListener('click', () => {
        try {
            const expression = currentInput.replace(/×/g, '*').replace(/÷/g, '/');
            const result = eval(expression);
            historyDisplay.textContent = currentInput + ' =';
            currentInput = result.toString();
            updateDisplay();
        } catch (e) {
            currentInput = 'Error';
            updateDisplay();
        }
    });

    document.getElementById('btn-copy').addEventListener('click', () => {
        navigator.clipboard.writeText(mainDisplay.textContent);
    });
});
</script>

<style>
.scientific-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); max-width: 500px; margin: 0 auto; }
.scientific-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2rem; }
.scientific-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.scientific-calc-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; }
.scientific-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }

.calc-display { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 1.5rem; text-align: right; min-height: 100px; display: flex; flex-direction: column; justify-content: center; }
.calc-history-text { font-size: 0.85rem; color: #94a3b8; margin-bottom: 0.25rem; min-height: 1.2rem; }
.calc-main-text { font-size: 2.2rem; font-weight: 700; color: #1e293b; word-break: break-all; }

.scientific-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.75rem; }
.scientific-grid .btn { border-radius: 12px; padding: 1rem 0; font-weight: 600; font-size: 1.1rem; border: 1px solid #e2e8f0; transition: all 0.2s; }
.scientific-grid .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.05); }

.btn-calc-num { background: #fff; color: #334155; }
.btn-calc-op { background: #f1f5f9; color: #3b82f6; border-color: transparent; }
.btn-calc-fn { background: #eff6ff; color: #2563eb; font-size: 0.9rem !important; }
.btn-calc-clear { background: #fef2f2; color: #ef4444; border-color: transparent; }
.btn-calc-equals { background: #2563eb; color: #fff; border-color: transparent; grid-column: span 1; }
.btn-calc-equals:hover { background: #1d4ed8; color: #fff; }

.quick-actions-grid { display: flex; gap: 0.75rem; }
.btn-secondary-action { background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; border-radius: 12px; padding: 0.8rem; font-weight: 600; }
</style>

