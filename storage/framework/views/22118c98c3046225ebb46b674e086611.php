<div class="row g-4 math-suite-modernized">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Input Value</label>
                        <input type="number" id="input-val" class="form-control form-control-lg" value="10" step="0.1">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Input Type</label>
                        <select id="input-type" class="form-select form-select-lg">
                            <option value="side">Side Length (a)</option>
                            <option value="altitude">Altitude (h)</option>
                            <option value="area">Area (A)</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Unit</label>
                        <select id="input-unit" class="form-select form-select-lg">
                            <option value="unit">Units</option>
                            <option value="cm">cm</option>
                            <option value="in">in</option>
                            <option value="ft">ft</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#10b981;box-shadow:0 4px 12px rgba(16,185,129,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Triangle Metrics
                        </button>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-reset" style="min-width: 280px; max-width: 100%;">Reset Fields</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:150;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04); display: none;">
            <div class="output-hero mb-4">
                <span class="output-hero-label">Calculated Area</span>
                <div class="output-hero-value" id="res-area">43.3013</div>
                <span class="output-hero-unit" id="res-unit-area">units²</span>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="stat-pill">
                        <span class="label">Side (a)</span>
                        <span class="value" id="res-side">10</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-pill">
                        <span class="label">Altitude (h)</span>
                        <span class="value" id="res-alt">8.66</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-pill">
                        <span class="label">Perimeter (P)</span>
                        <span class="value" id="res-peri">30</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-pill">
                        <span class="label">Semi-Perimeter</span>
                        <span class="value" id="res-semi">15</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-circle-nodes me-2 text-success"></i>Circles & Advanced Geometry</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border bg-white d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:48px;height:48px;color:#10b981">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <div>
                                <div class="small text-muted text-uppercase fw-bold">Incircle Radius (r)</div>
                                <div class="fs-5 fw-bold" id="res-incircle">2.887</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border bg-white d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:48px;height:48px;color:#10b981">
                                <i class="fas fa-circle-notch"></i>
                            </div>
                            <div>
                                <div class="small text-muted text-uppercase fw-bold">Circumcircle Radius (R)</div>
                                <div class="fs-5 fw-bold" id="res-circum">5.774</div>
                            </div>
                        </div>
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
        const val = parseFloat($('input-val').value);
        const type = $('input-type').value;
        const unit = $('input-unit').value;

        if (isNaN(val) || val <= 0) return;

        let a;
        if (type === 'side') a = val;
        else if (type === 'altitude') a = val / (Math.sqrt(3) / 2);
        else if (type === 'area') a = Math.sqrt((4 * val) / Math.sqrt(3));

        const area = (Math.sqrt(3) / 4) * a * a;
        const h = (Math.sqrt(3) / 2) * a;
        const p = 3 * a;
        const inR = a / (2 * Math.sqrt(3));
        const circR = a / Math.sqrt(3);

        $('res-area').textContent = area.toFixed(4);
        $('res-side').textContent = a.toFixed(4);
        $('res-alt').textContent = h.toFixed(4);
        $('res-peri').textContent = p.toFixed(4);
        $('res-semi').textContent = (p/2).toFixed(4);
        $('res-incircle').textContent = inR.toFixed(4);
        $('res-circum').textContent = circR.toFixed(4);
        $('res-unit-area').textContent = unit + "²";

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => { location.reload(); });
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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\area-of-equilateral-triangle-calculator.blade.php ENDPATH**/ ?>