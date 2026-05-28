<div class="row g-4 geometry-calc-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-12">
                        <label class="form-label-custom">Select Shape</label>
                        <select id="in-shape" class="form-select form-select-lg rounded-3 border-primary" style="border-width: 2px;">
                            <option value="circle">Circle (Circumference)</option>
                            <option value="square">Square</option>
                            <option value="rectangle" selected>Rectangle</option>
                            <option value="triangle">Triangle</option>
                        </select>
                    </div>
                </div>

                <div id="inputs-container">
                    {{-- Dynamic inputs injected here --}}
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-8">
                        <label class="form-label-custom">Unit</label>
                        <select id="in-unit" class="form-select form-select-lg rounded-3">
                            <option value="mm">mm</option>
                            <option value="cm" selected>cm</option>
                            <option value="m">m</option>
                            <option value="in">in</option>
                            <option value="ft">ft</option>
                            <option value="yd">yd</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Precision</label>
                        <select id="in-precision" class="form-select form-select-lg rounded-3">
                            <option value="2" selected>2 places</option>
                            <option value="4">4 places</option>
                            <option value="6">6 places</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow-sm" id="btn-calc"><i class="fas fa-calculator me-2"></i>Calculate Perimeter</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill px-4" id="btn-reset"><i class="fas fa-undo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12 d-none" id="output-wrapper">
        <div class="output-card-themed" style="--tool-hue:210;--tool-color:#2563eb;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero text-center">
                <span class="output-hero-label">Calculated Perimeter</span>
                <div class="output-hero-value" id="out-perimeter">—</div>
                <div class="mt-1 text-muted fw-medium" id="out-unit-display">units</div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-square-root-variable me-2 text-primary"></i>Calculation Steps</h6>
                <div class="p-4 bg-white rounded-4 border border-light-subtle shadow-sm">
                    <div class="step-item mb-4">
                        <div class="step-label">1. Perimeter Formula</div>
                        <div class="step-formula" id="step-formula">—</div>
                    </div>
                    <div class="step-item mb-4">
                        <div class="step-label">2. Substitution</div>
                        <div class="step-formula" id="step-substitution">—</div>
                    </div>
                    <div class="step-item">
                        <div class="step-label">3. Final Result</div>
                        <div class="step-formula" id="step-final">—</div>
                    </div>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-5 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy"><i class="fas fa-copy me-2"></i>Copy Results</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const container = $('inputs-container');
    const shapeSelector = $('in-shape');

    const inputConfigs = {
        circle: `<div class="row g-3"><div class="col-md-12"><label class="form-label-custom">Radius (r)</label><input type="number" id="in-r" class="form-control form-control-lg rounded-3" value="5" step="any"></div></div>`,
        square: `<div class="row g-3"><div class="col-md-12"><label class="form-label-custom">Side Length (s)</label><input type="number" id="in-s" class="form-control form-control-lg rounded-3" value="10" step="any"></div></div>`,
        rectangle: `<div class="row g-3"><div class="col-md-6"><label class="form-label-custom">Length (l)</label><input type="number" id="in-l" class="form-control form-control-lg rounded-3" value="15" step="any"></div><div class="col-md-6"><label class="form-label-custom">Width (w)</label><input type="number" id="in-w" class="form-control form-control-lg rounded-3" value="10" step="any"></div></div>`,
        triangle: `<div class="row g-3"><div class="col-md-4"><label class="form-label-custom">Side a</label><input type="number" id="in-a" class="form-control form-control-lg rounded-3" value="5" step="any"></div><div class="col-md-4"><label class="form-label-custom">Side b</label><input type="number" id="in-b" class="form-control form-control-lg rounded-3" value="5" step="any"></div><div class="col-md-4"><label class="form-label-custom">Side c</label><input type="number" id="in-c" class="form-control form-control-lg rounded-3" value="5" step="any"></div></div>`
    };

    function updateInputs(){
        container.innerHTML = inputConfigs[shapeSelector.value];
        // Add event listeners to new inputs
        container.querySelectorAll('input').forEach(el => el.addEventListener('input', calculate));
        calculate();
    }

    function calculate(){
        const shape = shapeSelector.value;
        const prec = parseInt($('in-precision').value);
        const unit = $('in-unit').value;
        let p = 0, formula = '', sub = '';

        if(shape === 'circle'){
            const r = parseFloat($('in-r').value);
            if(isNaN(r) || r <= 0) return hideOutput();
            p = 2 * Math.PI * r;
            formula = 'P = 2 \\pi r';
            sub = `P = 2 \\times ${Math.PI.toFixed(4)} \\times ${r}`;
        } else if(shape === 'square'){
            const s = parseFloat($('in-s').value);
            if(isNaN(s) || s <= 0) return hideOutput();
            p = 4 * s;
            formula = 'P = 4s';
            sub = `P = 4 \\times ${s}`;
        } else if(shape === 'rectangle'){
            const l = parseFloat($('in-l').value);
            const w = parseFloat($('in-w').value);
            if(isNaN(l) || isNaN(w) || l <= 0 || w <= 0) return hideOutput();
            p = 2 * (l + w);
            formula = 'P = 2(l + w)';
            sub = `P = 2(${l} + ${w})`;
        } else if(shape === 'triangle'){
            const a = parseFloat($('in-a').value);
            const b = parseFloat($('in-b').value);
            const c = parseFloat($('in-c').value);
            if(isNaN(a) || isNaN(b) || isNaN(c) || a <= 0 || b <= 0 || c <= 0) return hideOutput();
            p = a + b + c;
            formula = 'P = a + b + c';
            sub = `P = ${a} + ${b} + ${c}`;
        }

        const fP = p.toFixed(prec);
        $('out-perimeter').textContent = fP;
        $('out-unit-display').textContent = unit;
        $('step-formula').textContent = formula;
        $('step-substitution').textContent = sub;
        $('step-final').textContent = `P = ${fP} \text{ ${unit}}`;
        $('output-wrapper').classList.remove('d-none');
    }

    function hideOutput(){ $('output-wrapper').classList.add('d-none'); }

    shapeSelector.addEventListener('change', updateInputs);
    $('btn-calc').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        shapeSelector.value = 'rectangle';
        updateInputs();
        hideOutput();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Perimeter Calculation (${shapeSelector.value})\n` +
                     `--------------------------\n` +
                     `Shape: ${shapeSelector.options[shapeSelector.selectedIndex].text}\n` +
                     `Perimeter: ${$('out-perimeter').textContent} ${$('in-unit').value}\n` +
                     `— ToolsHub Geometry Solver`;
        
        navigator.clipboard.writeText(text).then(()=>{
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            this.classList.replace('btn-dark', 'btn-success');
            setTimeout(()=>{
                this.innerHTML = original;
                this.classList.replace('btn-success', 'btn-dark');
            }, 2000);
        });
    });

    ['change'].forEach(evt => {
        $('in-unit').addEventListener(evt, calculate);
        $('in-precision').addEventListener(evt, calculate);
    });

    updateInputs();
});
</script>

<style>
.geometry-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 15px 30px -5px rgba(0,0,0,.04)}
.geometry-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.geometry-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b;letter-spacing:-0.5px}
.geometry-calc-rebuilt .calculator-header p{margin:0;font-size:.95rem;color:#64748b}
.geometry-calc-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.75rem;flex-shrink:0}
.geometry-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:1px;margin-bottom:.6rem;display:block}

.geometry-calc-rebuilt .output-card-themed{background:var(--tool-bg);border:2px solid #fff;border-radius:32px;padding:3rem;margin-top:2rem;box-shadow:0 20px 40px rgba(0,0,0,.03);position:relative;overflow:hidden}
.geometry-calc-rebuilt .output-hero-label{font-size:1rem;font-weight:700;color:var(--tool-color);text-transform:uppercase;letter-spacing:2px;display:block;margin-bottom:.5rem}
.geometry-calc-rebuilt .output-hero-value{font-size:4.5rem;font-weight:900;color:#1e293b;line-height:1;margin-bottom:.5rem;word-break:break-all}

.geometry-calc-rebuilt .step-item{border-left:3px solid var(--tool-color);padding-left:1.5rem;position:relative}
.geometry-calc-rebuilt .step-label{font-size:.85rem;font-weight:700;color:#64748b;margin-bottom:.5rem}
.geometry-calc-rebuilt .step-formula{font-family:'Cambria','Cochin',Georgia,Times,'Times New Roman',serif;font-style:italic;font-size:1.25rem;color:#1e293b;background:#f8fafc;padding:.75rem 1.25rem;border-radius:12px;display:inline-block;min-width:200px}

@media (max-width: 768px) {
    .geometry-calc-rebuilt .calculator-card{padding:1.5rem}
    .geometry-calc-rebuilt .output-card-themed{padding:2rem 1.5rem}
    .geometry-calc-rebuilt .output-hero-value{font-size:3rem}
}
</style>
