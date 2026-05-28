<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

<div class="row g-2 construction-suite-rebuilt mx-auto" style="max-width: 800px;">
    <div class="col-12">
        <div class="calculator-card">
            <div class="calculator-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="tool-icon-circle" style="background:rgba(234,88,12,.05);color:#ea580c"><i class="fas fa-fan"></i></div>
                    <h5 class="mb-0 fw-bold">HVAC Sizing Calculator</h5>
                </div>
                <div class="d-flex gap-1">
                    <button class="btn btn-dark btn-sm rounded-pill px-3 fw-bold" id="btn-calc">Calculate</button>
                    <button class="btn btn-light btn-sm rounded-pill px-3 border" id="btn-reset">Reset</button>
                </div>
            </div>
            <div class="calculator-body mt-2">
                <div class="row g-2">
                    <div class='col-6 col-md-4 mb-2'><label class='form-label-custom'>Area (sq ft)</label><input type='number' id='calc-area' class='form-control form-control-sm rounded-2 shadow-none border-secondary-subtle py-1' value='1500' step='1'></div><div class='col-6 col-md-4 mb-2'><label class='form-label-custom'>Ceiling (ft)</label><input type='number' id='calc-ceiling-height' class='form-control form-control-sm rounded-2 shadow-none border-secondary-subtle py-1' value='8' step='1'></div><div class='col-6 col-md-4 mb-2'><label class='form-label-custom'>Sun</label><select id='calc-sun-exposure' class='form-select form-select-sm rounded-2 shadow-none border-secondary-subtle py-1'><option value='low' >Shaded</option><option value='med' >Normal</option><option value='high' >Sunny</option></select></div><div class='col-6 col-md-4 mb-2'><label class='form-label-custom'>Insulation</label><select id='calc-insulation' class='form-select form-select-sm rounded-2 shadow-none border-secondary-subtle py-1'><option value='poor' >Poor</option><option value='avg' >Average</option><option value='good' >Good</option></select></div><div class='col-6 col-md-4 mb-2'><label class='form-label-custom'>Zone</label><select id='calc-climate' class='form-select form-select-sm rounded-2 shadow-none border-secondary-subtle py-1'><option value='1' >Zone 1</option><option value='2' >Zone 2</option><option value='3' >Zone 3</option><option value='4' >Zone 4</option><option value='5' >Zone 5</option></select></div>
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
            katex.render("BTU = Area \\times Base \\times Sun \\times Insulation", $('latex-formula'), {throwOnError: false, displayMode: true});
        } else setTimeout(renderFormula, 100);
    }
    renderFormula();

        function calculate() {
        const a = parseFloat($('calc-area').value)||0, h = parseFloat($('calc-ceiling-height').value)||8, zone = parseInt($('calc-climate').value)||3;
        const btu = a * {1:50,2:45,3:40,4:35,5:30}[zone] * (h/8);
        $('res-main').textContent = Math.round(btu).toLocaleString();
        $('res-unit').textContent = 'BTU/hr';
        $('res-details').innerHTML = `<div class="stat-box"><div class="small text-muted">Tonnage</div><div class="fw-bold">${(btu/12000).toFixed(1)} Tons</div></div>`;
    }
    $('btn-calc').addEventListener('click', calculate);
    ['calc-area','calc-ceiling-height','calc-climate'].forEach(id=>$(id).addEventListener('change',calculate));
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
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\hvac-sizing-calculator.blade.php ENDPATH**/ ?>