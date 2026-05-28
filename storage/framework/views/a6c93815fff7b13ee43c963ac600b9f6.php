<div class="row g-4 math-suite-modernized">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Radius (r)</label>
                        <input type="number" id="input-r" class="form-control form-control-lg" value="5" step="0.1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Angle (θ)</label>
                        <div class="input-group">
                            <input type="number" id="input-angle" class="form-control form-control-lg" value="45" step="1">
                            <select id="input-unit" class="form-select form-select-lg" style="max-width: 120px;">
                                <option value="deg">Degrees</option>
                                <option value="rad">Radians</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#f59e0b;box-shadow:0 4px 12px rgba(245,158,11,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Sector Metrics
                        </button>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-semi" style="min-width: 280px; max-width: 100%;">Semi-Circle (180°)</button>
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-reset" style="min-width: 280px; max-width: 100%;">Reset</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:40;--tool-color:#f59e0b;--tool-bg:rgba(245,158,11,.04); display: none;">
            <div class="output-hero mb-4">
                <span class="output-hero-label">Sector Area (A)</span>
                <div class="output-hero-value" id="res-area">9.8175</div>
                <span class="output-hero-unit" id="res-unit-area">units²</span>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Arc Length (s)</span>
                        <span class="value" id="res-arc">3.927</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Chord Length (c)</span>
                        <span class="value" id="res-chord">3.827</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Perimeter (s + 2r)</span>
                        <span class="value" id="res-peri">13.927</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-square-root-variable me-2 text-warning"></i>Mathematical Equations</h6>
                <div class="p-4 rounded-4 bg-white border">
                    <div class="mb-3">
                        <span class="badge bg-warning text-dark me-2">Area</span>
                        <code class="fs-5">A = (θ/360) × πr² = (<span class="step-angle">45</span>/360) × π × <span class="step-r">5</span>²</code>
                    </div>
                    <div class="mb-3">
                        <span class="badge bg-warning text-dark me-2">Arc Length</span>
                        <code class="fs-5">s = (θ/360) × 2πr</code>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Results
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

    function calculate() {
        const r = parseFloat($('input-r').value);
        let angle = parseFloat($('input-angle').value);
        const unit = $('input-unit').value;

        if (isNaN(r) || isNaN(angle) || r <= 0) return;

        let thetaRad;
        if (unit === 'deg') {
            thetaRad = angle * (Math.PI / 180);
        } else {
            thetaRad = angle;
            angle = angle * (180 / Math.PI); // Convert to deg for steps
        }

        const area = 0.5 * r * r * thetaRad;
        const arc = r * thetaRad;
        const chord = 2 * r * Math.sin(thetaRad / 2);
        const peri = arc + 2 * r;

        $('res-area').textContent = area.toFixed(4);
        $('res-arc').textContent = arc.toFixed(4);
        $('res-chord').textContent = chord.toFixed(4);
        $('res-peri').textContent = peri.toFixed(4);

        document.querySelectorAll('.step-angle').forEach(el => el.textContent = angle.toFixed(1));
        document.querySelectorAll('.step-r').forEach(el => el.textContent = r);

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
    $('btn-semi').addEventListener('click', () => { $('input-angle').value = 180; $('input-unit').value = 'deg'; calculate(); });
});
</script>

<style>
.math-suite-modernized .calculator-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
.math-suite-modernized .calculator-header { display: flex; align-items: center; gap: 1.2rem; margin-bottom: 2.5rem; }
.math-suite-modernized .calculator-header h4 { margin: 0; font-weight: 800; color: #0f172a; }
.math-suite-modernized .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; }
.math-suite-modernized .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.math-suite-modernized .form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; margin-bottom: 0.6rem; display: block; }
.btn-primary-stats { color: #fff; border: none; border-radius: 12px; transition: all 0.3s; }
.btn-dark-stats { background: #0f172a; color: #fff; border: none; border-radius: 12px; }
.output-card-themed { background: #fff; border: 2px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; margin-top: 1rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px solid rgba(0,0,0,0.05); }
.output-hero-label { font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; }
.output-hero-value { font-size: 3.5rem; font-weight: 900; color: #0f172a; margin: 0.5rem 0; }
.stat-pill { background: #f8fafc; padding: 1.2rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: center; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\area-of-a-sector-calculator.blade.php ENDPATH**/ ?>