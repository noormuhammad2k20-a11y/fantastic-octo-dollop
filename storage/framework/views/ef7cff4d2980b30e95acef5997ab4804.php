<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-5">
                        <label class="form-label-custom">Operand A (Decimal)</label>
                        <input type="number" id="input-a" class="form-control form-control-lg" value="12">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label-custom">Operator</label>
                        <select id="input-op" class="form-select form-select-lg">
                            <option value="&">AND (&)</option>
                            <option value="|">OR (|)</option>
                            <option value="^">XOR (^)</option>
                            <option value="~">NOT (~)</option>
                            <option value="<<">Left Shift (<<)</option>
                            <option value=">>">Right Shift (>>)</option>
                        </select>
                    </div>
                    <div class="col-md-5" id="col-b">
                        <label class="form-label-custom">Operand B (Decimal / Shift)</label>
                        <input type="number" id="input-b" class="form-control form-control-lg" value="5">
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#0f172a;box-shadow:0 4px 12px rgba(15,23,42,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Result
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:210;--tool-color:#0f172a;--tool-bg:rgba(15,23,42,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Result (Decimal)</span>
                <div class="output-hero-value" id="res-dec">0</div>
                <span class="output-hero-unit" id="res-bin">00000000</span>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-binary me-2"></i>Binary Visualization</h6>
                <div class="p-4 rounded-4 bg-dark text-light font-monospace" id="binary-viz">
                    A: 00001100<br>
                    B: 00000101<br>
                    ----------<br>
                    R: 00000100
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Result
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const btnCalc = $('btn-calculate');
    const resultsCard = $('results-card');

    $('input-op').addEventListener('change', (e) => {
        $('col-b').style.opacity = (e.target.value === '~') ? '0' : '1';
    });

    function toBin(num) {
        return (num >>> 0).toString(2).padStart(8, '0');
    }

    function calculate() {
        const a = parseInt($('input-a').value) || 0;
        const b = parseInt($('input-b').value) || 0;
        const op = $('input-op').value;

        let res = 0;
        let viz = `A: ${toBin(a)} (${a})\n`;
        
        if (op === '&') { res = a & b; viz += `B: ${toBin(b)} (${b})\n& ----------\nR: ${toBin(res)} (${res})`; }
        else if (op === '|') { res = a | b; viz += `B: ${toBin(b)} (${b})\n| ----------\nR: ${toBin(res)} (${res})`; }
        else if (op === '^') { res = a ^ b; viz += `B: ${toBin(b)} (${b})\n^ ----------\nR: ${toBin(res)} (${res})`; }
        else if (op === '~') { res = ~a; viz = `A: ${toBin(a)} (${a})\n~ ----------\nR: ${toBin(res)} (${res})`; }
        else if (op === '<<') { res = a << b; viz += `S: ${b} bits\n<< ---------\nR: ${toBin(res)} (${res})`; }
        else if (op === '>>') { res = a >> b; viz += `S: ${b} bits\n>> ---------\nR: ${toBin(res)} (${res})`; }

        $('res-dec').textContent = res;
        $('res-bin').textContent = toBin(res);
        $('binary-viz').innerHTML = viz.replace(/\n/g, '<br>');

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
});
</script>

<style>
.stats-suite-rebuilt .calculator-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
.stats-suite-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.2rem; margin-bottom: 2.5rem; }
.stats-suite-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #0f172a; }
.stats-suite-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; }
.stats-suite-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.stats-suite-rebuilt .form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; margin-bottom: 0.6rem; display: block; }
.btn-primary-stats { color: #fff; border: none; border-radius: 12px; transition: all 0.3s; }
.btn-dark-stats { background: #0f172a; color: #fff; border: none; border-radius: 12px; }
.output-card-themed { background: #fff; border: 2px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; margin-top: 1rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px solid rgba(0,0,0,0.05); }
.output-hero-label { font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; }
.output-hero-value { font-size: 4rem; font-weight: 900; color: #0f172a; margin: 0.5rem 0; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\bitwise-calculator.blade.php ENDPATH**/ ?>