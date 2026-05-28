<div class="row g-4 basen-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Number A</label>
                        <input type="text" id="val-a" class="form-control form-control-lg text-uppercase fw-bold" value="1011">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Operation</label>
                        <select id="op-sel" class="form-select form-select-lg text-center fw-bold">
                            <option value="add">+</option>
                            <option value="sub">-</option>
                            <option value="mul">×</option>
                            <option value="div">÷</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Number B</label>
                        <input type="text" id="val-b" class="form-control form-control-lg text-uppercase fw-bold" value="1101">
                    </div>
                </div>

                <div class="row mt-4 g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Calculation Base</label>
                        <select id="base-sel" class="form-select form-select-lg rounded-3">
                            <option value="2" selected>Base 2 (Binary)</option>
                            <option value="8">Base 8 (Octal)</option>
                            <option value="10">Base 10 (Decimal)</option>
                            <option value="16">Base 16 (Hex)</option>
                        </select>
                    </div>
                    <div class="col-md-12 d-flex align-items-end">
                        <button class="btn d-block mx-auto btn-outline-teal py-3 px-5 fw-bold rounded-pill shadow-sm"" id="clear-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-trash-alt me-2"></i>Clear All</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:170;--tool-color:#0d9488;--tool-bg:rgba(20,184,166,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Result (Base <span id="out-base-label">2</span>)</span>
                <div class="output-hero-value text-uppercase" id="out-val">11000</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-scroll me-2 text-primary"></i>Calculation Steps (via Decimal)</h6>
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
        const a = $('val-a').value.trim();
        const b = $('val-b').value.trim();
        const op = $('op-sel').value;
        const base = parseInt($('base-sel').value);
        $('out-base-label').textContent = base;

        if (!a || !b) return;

        try {
            const decA = parseInt(a, base);
            const decB = parseInt(b, base);
            if (isNaN(decA) || isNaN(decB)) {
                $('out-val').textContent = 'Invalid';
                return;
            }

            let decRes;
            switch(op) {
                case 'add': decRes = decA + decB; break;
                case 'sub': decRes = decA - decB; break;
                case 'mul': decRes = decA * decB; break;
                case 'div': decRes = Math.floor(decA / decB); break;
            }

            const result = decRes.toString(base).toUpperCase();
            $('out-val').textContent = result;

            let steps = [];
            steps.push(`<strong>1. Convert to Decimal:</strong>`);
            steps.push(`${a}₁₀ = ${decA}`);
            steps.push(`${b}₁₀ = ${decB}`);
            steps.push(`<br><strong>2. Perform Operation in Decimal:</strong>`);
            steps.push(`${decA} ${$('op-sel').options[$('op-sel').selectedIndex].text} ${decB} = ${decRes}`);
            steps.push(`<br><strong>3. Convert Result back to Base ${base}:</strong>`);
            steps.push(`${decRes}₁₀ = <strong>${result}</strong> in Base ${base}`);

            $('math-steps').innerHTML = steps.join('<br>');
        } catch(e) {
            $('out-val').textContent = 'Error';
        }
    }

    ['val-a','val-b','op-sel','base-sel'].forEach(id => $(id).addEventListener('input', calculate));
    $('clear-btn').addEventListener('click', () => { $('val-a').value=''; $('val-b').value=''; calculate(); });

    calculate();
});
</script>

<style>
.basen-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.basen-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.basen-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.basen-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.basen-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.basen-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }
.btn-outline-teal { border: 1.5px solid #ccfbf1; color: #0d9488; font-weight: 600; border-radius: 12px; transition: all 0.2s; }
.btn-outline-teal:hover { background: #14b8a6; color: #fff; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

