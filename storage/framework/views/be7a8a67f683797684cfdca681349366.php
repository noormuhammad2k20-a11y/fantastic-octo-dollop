<div class="row g-4 math-suite-modernized">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label-custom">Periodic Function f(t)</label>
                        <input type="text" id="input-func" class="form-control form-control-lg font-monospace" value="t" placeholder="e.g. t, sin(t), abs(t)">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Period (T)</label>
                        <input type="text" id="input-period" class="form-control" value="2*pi">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Number of Terms (n)</label>
                        <input type="number" id="input-terms" class="form-control" value="5" min="1" max="50">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Integration Steps (h)</label>
                        <input type="number" id="input-steps" class="form-control" value="1000" min="100" max="10000">
                    </div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#7c3aed;box-shadow:0 4px 12px rgba(124,58,237,0.2)">
                            <i class="fas fa-microchip me-2"></i>Compute Coefficients
                        </button>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-square" style="min-width: 280px; max-width: 100%;">Square Wave (sgn(sin(t)))</button>
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-sawtooth" style="min-width: 280px; max-width: 100%;">Sawtooth (t mod 2*pi)</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(124,58,237,.04); display: none;">
            <div class="output-hero mb-4">
                <span class="output-hero-label">Constant Term</span>
                <div class="output-hero-value" id="res-a0">0.00</div>
                <span class="output-hero-unit">Coefficient a₀ / 2</span>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-4"><i class="fas fa-table me-2 text-primary"></i>Coefficient Spectrum (aₙ, bₙ)</h6>
                <div class="table-responsive rounded-3 border bg-white">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr><th>n</th><th>aₙ (Cosine Term)</th><th>bₙ (Sine Term)</th><th class="text-end">Magnitude (cₙ)</th></tr>
                        </thead>
                        <tbody id="coeffs-table"></tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Coefficients
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const btnCalc = $('btn-calculate');
    const resultsCard = $('results-card');

    function integrate(funcStr, a, b, steps) {
        const h = (b - a) / steps;
        let sum = 0;
        const code = math.compile(funcStr);
        
        for (let i = 0; i <= steps; i++) {
            const t = a + i * h;
            const weight = (i === 0 || i === steps) ? 1 : 2;
            try {
                sum += weight * code.evaluate({ t: t });
            } catch (e) { sum += 0; }
        }
        return (h / 2) * sum;
    }

    function calculate() {
        const funcStr = $('input-func').value;
        const T_str = $('input-period').value;
        const n_terms = parseInt($('input-terms').value);
        const steps = parseInt($('input-steps').value);

        const T = math.evaluate(T_str);
        const omega = (2 * Math.PI) / T;

        // a0 = (2/T) * integrate(f(t), -T/2, T/2)
        const a0 = (2 / T) * integrate(funcStr, -T/2, T/2, steps);
        $('res-a0').textContent = (a0 / 2).toFixed(6);

        let tableHtml = '';
        for (let n = 1; n <= n_terms; n++) {
            const an = (2 / T) * integrate(`${funcStr} * cos(${n} * ${omega} * t)`, -T/2, T/2, steps);
            const bn = (2 / T) * integrate(`${funcStr} * sin(${n} * ${omega} * t)`, -T/2, T/2, steps);
            const mag = Math.sqrt(an*an + bn*bn);

            tableHtml += `
                <tr>
                    <td>${n}</td>
                    <td class="font-monospace">${an.toFixed(6)}</td>
                    <td class="font-monospace">${bn.toFixed(6)}</td>
                    <td class="text-end fw-bold">${mag.toFixed(6)}</td>
                </tr>
            `;
        }

        $('coeffs-table').innerHTML = tableHtml;
        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
    $('btn-square').addEventListener('click', () => { $('input-func').value = "sgn(sin(t))"; calculate(); });
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
.output-hero-value { font-size: 3rem; font-weight: 900; color: #0f172a; margin: 0.5rem 0; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\fourier-series-coefficients.blade.php ENDPATH**/ ?>