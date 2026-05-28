<div class="row g-4 linear-solver-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4 text-center">
                    <div class="btn-group w-100 p-1 bg-light rounded-3">
                        <button type="button" class="btn btn-white shadow-sm border-0 active-toggle py-2" id="toggle-single" style="min-width: 280px; max-width: 100%;">Single Variable</button>
                        <button type="button" class="btn btn-light border-0 py-2" id="toggle-system" style="min-width: 280px; max-width: 100%;">2x2 System</button>
                    </div>
                </div>

                <div id="single-variable-inputs">
                    <div class="row g-3 align-items-center justify-content-center">
                        <div class="col-auto"><input type="number" id="sv-a" class="form-control text-center" value="2" style="width:80px"></div>
                        <div class="col-auto fs-5">x +</div>
                        <div class="col-auto"><input type="number" id="sv-b" class="form-control text-center" value="3" style="width:80px"></div>
                        <div class="col-auto fs-5">=</div>
                        <div class="col-auto"><input type="number" id="sv-c" class="form-control text-center" value="11" style="width:80px"></div>
                    </div>
                    <div class="form-text text-center mt-3">Solving: $ax + b = c$</div>
                </div>

                <div id="system-inputs" style="display:none">
                    <div class="row g-2 align-items-center mb-2">
                        <div class="col-auto"><input type="number" id="s1-a" class="form-control" value="1" style="width:70px"></div>
                        <div class="col-auto">x +</div>
                        <div class="col-auto"><input type="number" id="s1-b" class="form-control" value="1" style="width:70px"></div>
                        <div class="col-auto">y =</div>
                        <div class="col-auto"><input type="number" id="s1-c" class="form-control" value="5" style="width:70px"></div>
                    </div>
                    <div class="row g-2 align-items-center">
                        <div class="col-auto"><input type="number" id="s2-a" class="form-control" value="1" style="width:70px"></div>
                        <div class="col-auto">x -</div>
                        <div class="col-auto"><input type="number" id="s2-b" class="form-control" value="1" style="width:70px"></div>
                        <div class="col-auto">y =</div>
                        <div class="col-auto"><input type="number" id="s2-c" class="form-control" value="1" style="width:70px"></div>
                    </div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Solve Equation
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:140;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Solution</span>
                <div class="output-hero-value fs-1" id="out-result">x = 4</div>
                <span class="output-hero-unit" id="out-summary">Perfect Match Found</span>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let mode = 'single';

    $('toggle-single').addEventListener('click', () => {
        mode = 'single';
        $('single-variable-inputs').style.display = 'block';
        $('system-inputs').style.display = 'none';
        $('toggle-single').classList.add('btn-white', 'shadow-sm', 'active-toggle');
        $('toggle-system').classList.remove('btn-white', 'shadow-sm', 'active-toggle');
    });

    $('toggle-system').addEventListener('click', () => {
        mode = 'system';
        $('single-variable-inputs').style.display = 'none';
        $('system-inputs').style.display = 'block';
        $('toggle-system').classList.add('btn-white', 'shadow-sm', 'active-toggle');
        $('toggle-single').classList.remove('btn-white', 'shadow-sm', 'active-toggle');
    });

    function calculate() {
        let result = "";

        if (mode === 'single') {
            const a = parseFloat($('sv-a').value);
            const b = parseFloat($('sv-b').value);
            const c = parseFloat($('sv-c').value);

            if (a === 0) {
                if (b === c) {
                    result = "Infinite Solutions";
                } else {
                    result = "No Solution";
                }
            } else {
                const x = (c - b) / a;
                result = `x = ${x.toFixed(4).replace(/\.?0+$/, "")}`;
            }
        } else {
            const a1 = parseFloat($('s1-a').value), b1 = parseFloat($('s1-b').value), c1 = parseFloat($('s1-c').value);
            const a2 = parseFloat($('s2-a').value), b2 = parseFloat($('s2-b').value), c2 = parseFloat($('s2-c').value);

            const D = a1 * b2 - a2 * b1;
            if (Math.abs(D) < 1e-9) {
                result = "No Unique Solution";
            } else {
                const x = (c1 * b2 - c2 * b1) / D;
                const y = (a1 * c2 - a2 * c1) / D;
                result = `x = ${x.toFixed(3)}, y = ${y.toFixed(3)}`;
            }
        }

        $('out-result').textContent = result;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('out-result')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
});
</script>

<style>
.linear-solver-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.active-toggle { font-weight: 700; color: #1e293b !important; }
.quick-actions-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; }
.btn-primary-action { background: #1e293b; color: #fff; border: none; border-radius: 14px; padding: 1rem; font-weight: 700; transition: all 0.2s; }
.output-card-themed { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; margin-top: 2rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(16,185,129,0.2); }
</style>

