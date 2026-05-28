<div class="row g-4 fraction-reduction-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-12">
                        <div class="form-check form-switch p-0 ms-0 d-flex align-items-center">
                            <label class="form-label-custom mb-0 me-3" for="is-mixed">Mixed Fraction Mode</label>
                            <input class="form-check-input ms-0" type="checkbox" id="is-mixed" style="width: 3em; height: 1.5em; cursor: pointer;">
                        </div>
                    </div>

                    
                    <div class="col-md-4 d-none" id="whole-container">
                        <label class="form-label-custom">Whole Number</label>
                        <input type="number" id="input-whole" class="form-control form-control-lg" value="0" placeholder="e.g. 2">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Numerator</label>
                        <input type="number" id="input-num" class="form-control form-control-lg" value="8" placeholder="e.g. 8">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Denominator</label>
                        <input type="number" id="input-den" class="form-control form-control-lg" value="12" placeholder="e.g. 12">
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Examples:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 fraction-quick" data-n="24" data-d="36">8/12 → 2/3</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 fraction-quick" data-n="105" data-d="45">105/45 → 7/3</button>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 fraction-quick" data-w="2" data-n="4" data-d="8" data-m="true">2 4/8 → 2 1/2</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:210;--tool-color:#3b82f6;--tool-bg:rgba(59,130,246,.06);">
            <div class="output-hero">
                <span class="output-hero-label">SIMPLIFIED FRACTION</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-result">2/3</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-type">Type: Proper Fraction</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#10b981; background: rgba(16,185,129,.02);">
                        <span class="stat-card-label">DECIMAL VALUE</span>
                        <span class="stat-card-value text-success" id="out-decimal">0.6667</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#3b82f6; background: rgba(59,130,246,.02);">
                        <span class="stat-card-label">PERCENTAGE</span>
                        <span class="stat-card-value text-primary" id="out-percent">66.67%</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#f59e0b; background: rgba(245,158,11,.02);">
                        <span class="stat-card-label">GCD (DIVISOR)</span>
                        <span class="stat-card-value text-warning" id="out-gcd">4</span>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-microscope text-primary me-2"></i>Mathematical Analysis
                </h6>
                <div id="out-analysis" class="small text-secondary">
                    <p class="mb-0">Find the Greatest Common Divisor (GCD) of 8 and 12, which is 4. Divide both terms by 4 to get 2/3.</p>
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-12">
                    <button class="btn btn-outline-secondary w-100 rounded-3 border-0 py-2 small opacity-50" id="btn-reset">Reset Calculator</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const isMixedE = $('is-mixed'), wholeE = $('input-whole'), 
          numE = $('input-num'), denE = $('input-den'),
          wholeCont = $('whole-container');

    function gcd(a, b) {
        return b ? gcd(b, a % b) : a;
    }

    function calculate(){
        let w = parseInt(wholeE.value) || 0;
        let n = parseInt(numE.value) || 0;
        let d = parseInt(denE.value) || 1;
        let isM = isMixedE.checked;

        if (d === 0) {
            $('out-result').textContent = 'Error';
            $('out-analysis').innerHTML = '<span class="text-danger">Denominator cannot be zero.</span>';
            return;
        }

        // Handle negative signs
        let sign = (n * d < 0) ? -1 : 1;
        n = Math.abs(n);
        d = Math.abs(d);

        let common = gcd(n, d);
        let simpleN = n / common;
        let simpleD = d / common;

        let resultText = "";
        let analysisText = "";

        if (isM) {
            // Mixed fraction logic
            // Add extra numerator from whole number for processing
            let totalN = (w * d) + n;
            let totalCommon = gcd(totalN, d);
            let finalN = totalN / totalCommon;
            let finalD = d / totalCommon;

            let finalWhole = Math.floor(finalN / finalD);
            let remN = finalN % finalD;

            if (remN === 0) {
                resultText = `${finalWhole}`;
            } else {
                resultText = finalWhole !== 0 ? `${finalWhole} ${remN}/${finalD}` : `${remN}/${finalD}`;
            }
            
            $('out-type').textContent = "Type: Mixed Fraction";
            analysisText = `The mixed fraction ${w} ${n}/${d} is equivalent to the improper fraction ${totalN}/${d}. The GCD is ${totalCommon}. Simplified: ${resultText}.`;
        } else {
            // Simple fraction logic
            resultText = simpleD === 1 ? `${sign * simpleN}` : `${sign * simpleN}/${simpleD}`;
            $('out-type').textContent = n > d ? "Type: Improper Fraction" : (n === d ? "Type: Whole Number" : "Type: Proper Fraction");
            analysisText = `The Greatest Common Divisor (GCD) of ${n} and ${d} is ${common}. Dividing both by ${common} results in ${resultText}.`;
        }

        // Stats
        let decimal = isM ? w + (n / d) : (sign * n / d);
        $('out-result').textContent = resultText;
        $('out-decimal').textContent = decimal.toFixed(4);
        $('out-percent').textContent = (decimal * 100).toFixed(2) + '%';
        $('out-gcd').textContent = common;
        $('out-analysis').innerHTML = `<p class="mb-0">${analysisText}</p>`;
    }

    isMixedE.addEventListener('change', () => {
        wholeCont.classList.toggle('d-none', !isMixedE.checked);
        calculate();
    });

    [wholeE, numE, denE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.fraction-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            if (btn.dataset.m) {
                isMixedE.checked = true;
                wholeCont.classList.remove('d-none');
                wholeE.value = btn.dataset.w;
            } else {
                isMixedE.checked = false;
                wholeCont.classList.add('d-none');
            }
            numE.value = btn.dataset.n;
            denE.value = btn.dataset.d;
            calculate();
        });
    });

    $('btn-reset').addEventListener('click', () => {
        isMixedE.checked = false;
        wholeCont.classList.add('d-none');
        wholeE.value = 0;
        numE.value = 8;
        denE.value = 12;
        calculate();
    });

    calculate();
});
</script>

<style>
.fraction-reduction-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(59,130,246,.05)}
.fraction-reduction-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.fraction-reduction-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.fraction-reduction-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.fraction-reduction-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.fraction-reduction-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:2rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .fraction-reduction-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\reduce-fractions-calculator.blade.php ENDPATH**/ ?>