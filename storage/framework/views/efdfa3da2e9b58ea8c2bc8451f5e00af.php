<div class="row g-4 fraction-to-decimal-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-12">
                        <div class="form-check form-switch p-0 ms-0 d-flex align-items-center">
                            <label class="form-label-custom mb-0 me-3" for="is-mixed-dec">Mixed Fraction Mode</label>
                            <input class="form-check-input ms-0" type="checkbox" id="is-mixed-dec" style="width: 3em; height: 1.5em; cursor: pointer;">
                        </div>
                    </div>

                    
                    <div class="col-md-3 d-none" id="whole-container-dec">
                        <label class="form-label-custom">Whole Number</label>
                        <input type="number" id="input-whole-dec" class="form-control form-control-lg" value="0" placeholder="e.g. 2">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Numerator</label>
                        <input type="number" id="input-num-dec" class="form-control form-control-lg" value="3" placeholder="e.g. 3">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Denominator</label>
                        <input type="number" id="input-den-dec" class="form-control form-control-lg" value="4" placeholder="e.g. 4">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Precision</label>
                        <select id="input-precision" class="form-select form-select-lg">
                            <option value="2">2 Decimal Places</option>
                            <option value="4" selected>4 Decimal Places</option>
                            <option value="6">6 Decimal Places</option>
                            <option value="8">8 Decimal Places</option>
                            <option value="10">10 Decimal Places</option>
                        </select>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 f-to-d-quick" data-n="1" data-d="2">1/2 → 0.5</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 f-to-d-quick" data-n="3" data-d="8">3/8 → 0.375</button>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 f-to-d-quick" data-n="1" data-d="3">1/3 → 0.33...</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:35;--tool-color:#f59e0b;--tool-bg:rgba(245,158,11,.06);">
            <div class="output-hero">
                <span class="output-hero-label">DECIMAL EQUIVALENT</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-decimal-val">0.75</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-repeating">Non-Repeating Decimal</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <div class="stat-card" style="border-color:#10b981; background: rgba(16,185,129,.02);">
                        <span class="stat-card-label">PERCENTAGE</span>
                        <span class="stat-card-value text-success" id="out-percent-dec">75%</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card" style="border-color:#3b82f6; background: rgba(59,130,246,.02);">
                        <span class="stat-card-label">SIMPLIFIED FORM</span>
                        <span class="stat-card-value text-primary" id="out-simple-dec">3/4</span>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-chart-pie text-warning me-2"></i>Conversion Logic
                </h6>
                <div id="out-analysis-dec" class="small text-secondary">
                    <p class="mb-0">To convert 3/4 to a decimal, divide the numerator (3) by the denominator (4). 3 ÷ 4 = 0.75.</p>
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-12">
                    <button class="btn btn-outline-secondary w-100 rounded-3 border-0 py-2 small opacity-50" id="btn-reset-dec">Reset Converter</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const isMixedE = $('is-mixed-dec'), wholeE = $('input-whole-dec'), 
          numE = $('input-num-dec'), denE = $('input-den-dec'),
          precE = $('input-precision'),
          wholeCont = $('whole-container-dec');

    function gcd(a, b) {
        return b ? gcd(b, a % b) : a;
    }

    function calculate(){
        let w = parseInt(wholeE.value) || 0;
        let n = parseInt(numE.value) || 0;
        let d = parseInt(denE.value) || 1;
        let p = parseInt(precE.value) || 4;
        let isM = isMixedE.checked;

        if (d === 0) {
            $('out-decimal-val').textContent = 'Error';
            $('out-analysis-dec').innerHTML = '<span class="text-danger">Denominator cannot be zero.</span>';
            return;
        }

        let decimalValue = isM ? w + (n / d) : (n / d);
        let sign = decimalValue < 0 ? "-" : "";
        let absDec = Math.abs(decimalValue);

        // Update UI
        $('out-decimal-val').textContent = decimalValue.toFixed(p);
        $('out-percent-dec').textContent = (decimalValue * 100).toFixed(2) + '%';
        
        // Simplified Form
        let common = gcd(Math.abs(n), Math.abs(d));
        let sn = Math.abs(n) / common;
        let sd = Math.abs(d) / common;
        let simplified = isM ? (w !== 0 ? `${w} ${sn}/${sd}` : `${sn}/${sd}`) : `${n < 0 ? '-' : ''}${sn}/${sd}`;
        $('out-simple-dec').textContent = simplified;

        // Repeating Check (Simple heuristic for powers of 2 and 5)
        let tempD = sd;
        while(tempD % 2 === 0) tempD /= 2;
        while(tempD % 5 === 0) tempD /= 5;
        let isRepeating = tempD !== 1;
        
        $('out-repeating').textContent = isRepeating ? "Repeating Decimal Detected" : "Non-Repeating Decimal";
        $('out-repeating').className = isRepeating ? "mt-2 text-warning fw-bold small" : "mt-2 text-muted fw-bold small";

        // Analysis
        let analysis = "";
        if (isM) {
            analysis = `The mixed fraction ${w} ${n}/${d} is converted by adding the whole part (${w}) to the result of ${n} ÷ ${d}. Result: ${decimalValue.toFixed(p)}.`;
        } else {
            analysis = `To convert ${n}/${d} to a decimal, divide the numerator (${n}) by the denominator (${d}). Result: ${decimalValue.toFixed(p)}.`;
        }
        $('out-analysis-dec').innerHTML = `<p class="mb-0">${analysis}</p>`;
    }

    isMixedE.addEventListener('change', () => {
        wholeCont.classList.toggle('d-none', !isMixedE.checked);
        calculate();
    });

    [wholeE, numE, denE, precE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.f-to-d-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            isMixedE.checked = false;
            wholeCont.classList.add('d-none');
            numE.value = btn.dataset.n;
            denE.value = btn.dataset.d;
            calculate();
        });
    });

    $('btn-reset-dec').addEventListener('click', () => {
        isMixedE.checked = false;
        wholeCont.classList.add('d-none');
        wholeE.value = 0;
        numE.value = 3;
        denE.value = 4;
        precE.value = 4;
        calculate();
    });

    calculate();
});
</script>

<style>
.fraction-to-decimal-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(245,158,11,.05)}
.fraction-to-decimal-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.fraction-to-decimal-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.fraction-to-decimal-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.fraction-to-decimal-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.fraction-to-decimal-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
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
    .fraction-to-decimal-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\fraction-to-decimal-calculator.blade.php ENDPATH**/ ?>