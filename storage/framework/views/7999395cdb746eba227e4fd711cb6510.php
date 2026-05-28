<div class="row g-4 base-conv-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Input Number</label>
                        <input type="text" id="base-val" class="form-control form-control-lg rounded-3 fw-bold text-uppercase" value="255" placeholder="e.g. FF or 1011">
                    </div>
                </div>

                <div class="row mt-4 g-3">
                    <div class="col-md-5">
                        <label class="form-label-custom">From Base</label>
                        <select id="base-from" class="form-select form-select-lg rounded-3">
                            <option value="2">2 (Binary)</option>
                            <option value="8">8 (Octal)</option>
                            <option value="10" selected>10 (Decimal)</option>
                            <option value="16">16 (Hex)</option>
                            <option value="36">36 (Base 36)</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end justify-content-center pb-2">
                        <button class="btn btn-outline-indigo rounded-circle" id="swap-bases" style="min-width: 280px; max-width: 100%; width:45px;height:45px"><i class="fas fa-retweet"></i></button>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label-custom">To Base</label>
                        <select id="base-to" class="form-select form-select-lg rounded-3">
                            <option value="2" selected>2 (Binary)</option>
                            <option value="8">8 (Octal)</option>
                            <option value="10">10 (Decimal)</option>
                            <option value="16">16 (Hex)</option>
                            <option value="36">36 (Base 36)</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 p-3 bg-light rounded-3 border">
                    <label class="form-label-custom mb-2">Popular Bases</label>
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-sm btn-outline-secondary px-3" onclick="setBases(10, 2)">Dec to Bin</button>
                        <button class="btn btn-sm btn-outline-secondary px-3" onclick="setBases(2, 10)">Bin to Dec</button>
                        <button class="btn btn-sm btn-outline-secondary px-3" onclick="setBases(10, 16)">Dec to Hex</button>
                        <button class="btn btn-sm btn-outline-secondary px-3" onclick="setBases(16, 10)">Hex to Dec</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4338ca;--tool-bg:rgba(79,70,229,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Converted Value</span>
                <div class="output-hero-value fs-2 text-uppercase" id="out-val">11111111</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2 text-primary"></i>Conversion Steps</h6>
                <div class="bg-white p-4 rounded-4 border shadow-sm small text-secondary overflow-auto" id="math-steps">
                    Steps will appear here...
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-val" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Result</button>
                </div>
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="download-result" style="min-width: 280px; max-width: 100%;"><i class="fas fa-file-export me-2"></i>Export Steps</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function setBases(from, to) {
    document.getElementById('base-from').value = from;
    document.getElementById('base-to').value = to;
    document.getElementById('base-val').dispatchEvent(new Event('input'));
}

document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function calculate() {
        const val = $('base-val').value.trim();
        const from = parseInt($('base-from').value);
        const to = parseInt($('base-to').value);
        
        if (!val) {
            $('out-val').textContent = '0';
            return;
        }

        try {
            let decimalVal = parseInt(val, from);
            if (isNaN(decimalVal)) {
                $('out-val').textContent = 'Invalid Input';
                return;
            }

            const result = decimalVal.toString(to);
            $('out-val').textContent = result;

            let steps = [];
            steps.push(`<strong>Step 1: Convert ${val} (Base ${from}) to Decimal:</strong>`);
            let digits = val.split('');
            let expansion = [];
            let sum = 0;
            digits.reverse().forEach((d, i) => {
                let dVal = parseInt(d, from);
                let pVal = Math.pow(from, i);
                sum += dVal * pVal;
                expansion.push(`(${dVal} × ${from}<sup>${i}</sup>)`);
            });
            steps.push(`${expansion.reverse().join(' + ')} = <strong>${sum}</strong>`);

            steps.push(`<br><strong>Step 2: Convert ${sum} (Decimal) to Base ${to}:</strong>`);
            let quotient = sum;
            let remainders = [];
            while (quotient > 0) {
                let rem = quotient % to;
                remainders.push(rem.toString(to).toUpperCase());
                steps.push(`${quotient} ÷ ${to} = ${Math.floor(quotient / to)} remainder <strong>${rem.toString(to).toUpperCase()}</strong>`);
                quotient = Math.floor(quotient / to);
            }
            steps.push(`<br>Result (reading remainders bottom-up): <strong>${result.toUpperCase()}</strong>`);

            $('math-steps').innerHTML = steps.join('<br>');
        } catch (e) {
            $('out-val').textContent = 'Error';
        }
    }

    $('base-val').addEventListener('input', calculate);
    $('base-from').addEventListener('change', calculate);
    $('base-to').addEventListener('change', calculate);
    
    $('swap-bases').addEventListener('click', () => {
        const temp = $('base-from').value;
        $('base-from').value = $('base-to').value;
        $('base-to').value = temp;
        calculate();
    });

    calculate();
});
</script>

<style>
.base-conv-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.base-conv-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.base-conv-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.base-conv-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.base-conv-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.base-conv-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }
.btn-outline-indigo { border: 1.5px solid #e0e7ff; color: #4338ca; transition: all 0.2s; }
.btn-outline-indigo:hover { background: #4f46e5; color: #fff; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\base-converter.blade.php ENDPATH**/ ?>