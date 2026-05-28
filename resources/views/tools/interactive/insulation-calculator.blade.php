<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

<div class="row g-2 construction-suite-rebuilt mx-auto" style="max-width: 800px;">
    <div class="col-12">
        <div class="calculator-card">
            <div class="calculator-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="tool-icon-circle" style="background:rgba(234,88,12,.05);color:#ea580c"><i class="fas fa-layer-group"></i></div>
                    <h5 class="mb-0 fw-bold">Insulation Calculator</h5>
                </div>
                <div class="d-flex gap-1">
                    <button class="btn btn-dark btn-sm rounded-pill px-3 fw-bold" id="btn-calc">Calculate</button>
                    <button class="btn btn-light btn-sm rounded-pill px-3 border" id="btn-reset">Reset</button>
                </div>
            </div>
            <div class="calculator-body mt-2">
                <div class="row g-2">
                    <div class='col-6 col-md-4 mb-2'><label class='form-label-custom'>Area (sq ft)</label><input type='number' id='calc-total-area' class='form-control form-control-sm rounded-2 shadow-none border-secondary-subtle py-1' value='1000' step='1'></div><div class='col-6 col-md-4 mb-2'><label class='form-label-custom'>R-Value</label><select id='calc-ins-thickness' class='form-select form-select-sm rounded-2 shadow-none border-secondary-subtle py-1'><option value='r13' >R-13</option><option value='r19' >R-19</option><option value='r30' >R-30</option><option value='r38' >R-38</option></select></div><div class='col-6 col-md-4 mb-2'><label class='form-label-custom'>Spacing</label><select id='calc-joist-spacing' class='form-select form-select-sm rounded-2 shadow-none border-secondary-subtle py-1'><option value='16' >16" OC</option><option value='24' >24" OC</option></select></div><div class='col-6 col-md-4 mb-2'><label class='form-label-custom'>Wastage</label><select id='calc-wastage' class='form-select form-select-sm rounded-2 shadow-none border-secondary-subtle py-1'><option value='0' >0%</option><option value='5' selected>5%</option><option value='10' >10%</option><option value='15' >15%</option></select></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="output-card-themed" style="--tool-hue:25;--tool-color:#c2410c;--tool-bg:#fff;">
            <div class="row align-items-center">
                <div class="col-md-5 text-center text-md-start border-end-md">
                    <span class="output-hero-label">Result</span>
                    <div class="output-hero-value" id="res-main">-</div>
                    <span class="output-hero-unit" id="res-unit">Units</span>
                </div>
                <div class="col-md-7" id="res-details">
                    <!-- Details injected here -->
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="calculator-card p-2 text-center" style="background: #fafafa;">
            <div id="latex-formula" class="small opacity-75"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    function renderFormula() {
        if (typeof katex !== 'undefined') {
            katex.render("Rolls = \\frac{Area}{Roll Area} \\times (1 + W)", $('latex-formula'), {throwOnError: false, displayMode: true});
        } else setTimeout(renderFormula, 100);
    }
    renderFormula();

        function calculate() {
        const a = parseFloat($('calc-total-area').value)||0, r = $('calc-ins-thickness').value, wast = parseFloat($('calc-wastage').value)||0;
        const rolls = Math.ceil(a / {r13:40, r19:48.9, r30:31, r38:25}[r] * (1+wast/100));
        $('res-main').textContent = rolls;
        $('res-unit').textContent = 'Rolls';
        $('res-details').innerHTML = `<div class="stat-box"><div class="small text-muted">Rating</div><div class="fw-bold text-uppercase">${r}</div></div>`;
    }
    $('btn-calc').addEventListener('click', calculate);
    ['calc-total-area','calc-ins-thickness'].forEach(id=>$(id).addEventListener('change',calculate));
    calculate();
});
</script>

<style>
.construction-suite-rebuilt .calculator-card{background:#fff;border:1px solid #edf2f7;border-radius:12px;padding:1rem;box-shadow:0 1px 3px rgba(0,0,0,.05)}
.construction-suite-rebuilt .tool-icon-circle{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:0.9rem}
.construction-suite-rebuilt .form-label-custom{font-size:.65rem;font-weight:700;color:#718096;text-transform:uppercase;letter-spacing:.3px;margin-bottom:.2rem;display:block}
.output-card-themed{background:#fff;border:1px solid #edf2f7;border-radius:12px;padding:1rem;box-shadow:0 1px 3px rgba(0,0,0,.05)}
.output-hero-label{display:block;font-size:.65rem;font-weight:700;color:#718096;text-transform:uppercase;margin-bottom:0}
.output-hero-value{font-size:1.75rem;font-weight:800;color:var(--tool-color);line-height:1}
.output-hero-unit{font-size:.8rem;font-weight:600;color:#718096;display:block}
.stat-box{background:#f8fafc;border-radius:8px;padding:0.5rem 0.75rem;border-left:3px solid var(--tool-color)}
@media (min-width: 768px) { .border-end-md { border-right: 1px solid #edf2f7; } }
</style>