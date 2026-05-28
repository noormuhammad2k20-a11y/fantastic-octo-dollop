<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                <div class="col-md-4">
                    <label class="form-label-custom">Solve For</label>
                    <select class="form-select-v2" id="py-solve-for">
                        <option value="c">Hypotenuse (c)</option>
                        <option value="a">Leg A</option>
                        <option value="b">Leg B</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label-custom" id="label-val1">Leg A</label>
                    <input type="number" step="any" class="form-control-v2 py-input" id="py-val1" value="3">
                </div>
                <div class="col-md-4">
                    <label class="form-label-custom" id="label-val2">Leg B</label>
                    <input type="number" step="any" class="form-control-v2 py-input" id="py-val2" value="4">
                </div>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div class="card tool-card-stacked shadow-sm border-0 d-none" id="py-result-card">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-dark">Solution Breakdown</h5>
                </div>
                <div class="header-actions">
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2" id="py-copy">
                        <i class="far fa-copy me-1"></i> Copy
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="result-stats-grid mb-4">
                        <div class="tri-stat primary">
                            <span class="tri-stat-label" id="result-label">Hypotenuse (c)</span>
                            <div class="tri-stat-value" id="result-value">5.000</div>
                        </div>
                        <div class="row g-3 mt-1">
                            <div class="col-6">
                                <div class="tri-stat">
                                    <span class="tri-stat-label">Area</span>
                                    <div class="tri-stat-value" id="result-area">6.00</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="tri-stat">
                                    <span class="tri-stat-label">Perimeter</span>
                                    <div class="tri-stat-value" id="result-perimeter">12.00</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="py-steps">
                        <h6 class="fw-bold text-dark mb-3">Calculation Steps</h6>
                        <div id="py-steps-content"></div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="p-4 bg-white border rounded-4 shadow-sm">
                        <svg id="py-svg" viewBox="0 0 120 120" style="max-width: 100%; height: auto; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.05));">
                            <path id="svg-triangle" d="M20,100 L100,100 L20,20 Z" fill="rgba(99,102,241,0.1)" stroke="#6366f1" stroke-width="2" stroke-linejoin="round" />
                            <rect id="svg-square" x="20" y="90" width="10" height="10" fill="none" stroke="#6366f1" stroke-width="1" />
                            <text x="55" y="112" font-size="8" font-weight="bold" fill="#6366f1" text-anchor="middle" id="svg-text-a">a</text>
                            <text x="12" y="60" font-size="8" font-weight="bold" fill="#6366f1" text-anchor="middle" id="svg-text-b">b</text>
                            <text x="65" y="55" font-size="8" font-weight="bold" fill="#6366f1" text-anchor="middle" id="svg-text-c">c</text>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label-custom { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 0.5rem; display: block; }
    .form-control-v2, .form-select-v2 { border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 0.6rem 0.75rem; font-size: 1rem; color: #1e293b; width: 100%; transition: all 0.2s; font-weight: 600; }
    .form-control-v2:focus, .form-select-v2:focus { border-color: #6366f1; box-shadow: 0 0 0 4px rgba(99,102,241,0.1); outline: none; }
    .tri-stat { background: #f8fafc; padding: 1.25rem; border-radius: 16px; border: 1px solid #e2e8f0; text-align: center; transition: all 0.3s ease; }
    .tri-stat.primary { background: #eef2ff; border-color: #c7d2fe; }
    .tri-stat-label { font-size: 0.7rem; font-weight: 800; text-transform: uppercase; color: #64748b; display: block; margin-bottom: 0.25rem; }
    .tri-stat-value { font-size: 1.5rem; font-weight: 800; color: #1e293b; }
    .step-item { display: flex; align-items: flex-start; margin-bottom: 0.75rem; padding: 0.75rem; background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; }
    .step-num { width: 22px; height: 22px; background: #6366f1; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: 800; margin-right: 0.75rem; flex-shrink: 0; margin-top: 2px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const solveFor = document.getElementById('py-solve-for');
    const val1 = document.getElementById('py-val1');
    const val2 = document.getElementById('py-val2');
    const label1 = document.getElementById('label-val1');
    const label2 = document.getElementById('label-val2');
    const resultCard = document.getElementById('py-result-card');
    
    const $=id=>document.getElementById(id);

    function updateLabels() {
        const mode = solveFor.value;
        if(mode === 'c') {
            label1.textContent = 'Leg A (Side 1)';
            label2.textContent = 'Leg B (Side 2)';
        } else if(mode === 'a') {
            label1.textContent = 'Hypotenuse (c)';
            label2.textContent = 'Leg B (Side 2)';
        } else {
            label1.textContent = 'Hypotenuse (c)';
            label2.textContent = 'Leg A (Side 1)';
        }
        calculate();
    }

    function calculate() {
        const mode = solveFor.value;
        const v1 = parseFloat(val1.value) || 0;
        const v2 = parseFloat(val2.value) || 0;
        let result = 0, area = 0, perimeter = 0;
        let steps = [];

        if(v1 <= 0 || v2 <= 0) {
            resultCard.classList.add('d-none');
            return;
        }

        resultCard.classList.remove('d-none');

        if(mode === 'c') {
            result = Math.sqrt(v1 * v1 + v2 * v2);
            area = 0.5 * v1 * v2;
            perimeter = v1 + v2 + result;
            $('result-label').textContent = 'Hypotenuse (c)';
            steps = [
                {t: 'Identify Formula', d: 'c = √(a² + b²)'},
                {t: 'Substitute Values', d: `c = √(${v1}² + ${v2}²)`},
                {t: 'Simplify', d: `c = √(${v1*v1} + ${v2*v2}) = √${v1*v1 + v2*v2}`},
                {t: 'Solve', d: `c = ${result.toFixed(4)}`}
            ];
            updateSVG(v1, v2, result);
        } else if(mode === 'a') {
            if(v1 <= v2) {
                $('result-value').textContent = 'Error';
                $('py-steps-content').innerHTML = '<div class="alert alert-danger py-2 small">Hypotenuse must be longer than the leg.</div>';
                return;
            }
            result = Math.sqrt(v1 * v1 - v2 * v2);
            area = 0.5 * result * v2;
            perimeter = v1 + v2 + result;
            $('result-label').textContent = 'Leg A';
            steps = [
                {t: 'Identify Formula', d: 'a = √(c² - b²)'},
                {t: 'Substitute Values', d: `a = √(${v1}² - ${v2}²)`},
                {t: 'Simplify', d: `a = √(${v1*v1} - ${v2*v2}) = √${v1*v1 - v2*v2}`},
                {t: 'Solve', d: `a = ${result.toFixed(4)}`}
            ];
            updateSVG(result, v2, v1);
        } else {
            if(v1 <= v2) {
                $('result-value').textContent = 'Error';
                $('py-steps-content').innerHTML = '<div class="alert alert-danger py-2 small">Hypotenuse must be longer than the leg.</div>';
                return;
            }
            result = Math.sqrt(v1 * v1 - v2 * v2);
            area = 0.5 * v1 * result; // wait v1 is c, v2 is a
            area = 0.5 * result * v2;
            perimeter = v1 + v2 + result;
            $('result-label').textContent = 'Leg B';
            steps = [
                {t: 'Identify Formula', d: 'b = √(c² - a²)'},
                {t: 'Substitute Values', d: `b = √(${v1}² - ${v2}²)`},
                {t: 'Simplify', d: `b = √(${v1*v1} - ${v2*v2}) = √${v1*v1 - v2*v2}`},
                {t: 'Solve', d: `b = ${result.toFixed(4)}`}
            ];
            updateSVG(v2, result, v1);
        }

        $('result-value').textContent = result.toLocaleString(undefined, {minimumFractionDigits: 3, maximumFractionDigits: 3});
        $('result-area').textContent = area.toLocaleString(undefined, {maximumFractionDigits: 2});
        $('result-perimeter').textContent = perimeter.toLocaleString(undefined, {maximumFractionDigits: 2});

        $('py-steps-content').innerHTML = steps.map((s, i) => `
            <div class="step-item">
                <span class="step-num">${i+1}</span>
                <div>
                    <div class="fw-bold small text-dark">${s.t}</div>
                    <div class="text-muted small font-monospace">${s.d}</div>
                </div>
            </div>
        `).join('');
    }

    function updateSVG(a, b, c) {
        const max = Math.max(a, b);
        const scale = 80 / max;
        const sa = a * scale;
        const sb = b * scale;
        
        // Vertices: (20, 100), (20+sa, 100), (20, 100-sb)
        $('svg-triangle').setAttribute('d', `M20,100 L${20+sa},100 L20,${100-sb} Z`);
        $('svg-text-a').setAttribute('x', 20 + sa/2);
        $('svg-text-a').textContent = a.toFixed(1);
        $('svg-text-b').setAttribute('y', 100 - sb/2);
        $('svg-text-b').textContent = b.toFixed(1);
        $('svg-text-c').setAttribute('x', 20 + sa/2 + 5);
        $('svg-text-c').setAttribute('y', 100 - sb/2 - 5);
        $('svg-text-c').textContent = c.toFixed(1);
    }

    solveFor.addEventListener('change', updateLabels);
    val1.addEventListener('input', calculate);
    val2.addEventListener('input', calculate);
    $('py-reset').addEventListener('click', () => {
        val1.value = 3; val2.value = 4; solveFor.value = 'c'; updateLabels();
    });
    $('py-copy').addEventListener('click', function() {
        const text = `Pythagorean Solution\nResult: ${$('result-value').textContent}\nArea: ${$('result-area').textContent}\nPerimeter: ${$('result-perimeter').textContent}`;
        navigator.clipboard.writeText(text);
        const btn = this; const original = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied';
        setTimeout(() => btn.innerHTML = original, 2000);
    });

    updateLabels();
});
</script>
