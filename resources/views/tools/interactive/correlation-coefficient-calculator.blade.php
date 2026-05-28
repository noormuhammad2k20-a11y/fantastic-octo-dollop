<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Variable X Dataset</label>
                        <textarea id="input-x" class="form-control form-control-lg font-monospace" rows="5" placeholder="e.g. 10, 20, 30, 40, 50">10, 20, 30, 40, 50</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Variable Y Dataset</label>
                        <textarea id="input-y" class="form-control form-control-lg font-monospace" rows="5" placeholder="e.g. 15, 25, 35, 45, 55">15, 25, 35, 45, 55</textarea>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#10b981;box-shadow:0 4px 12px rgba(16,185,129,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Correlation
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:150;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Correlation Coefficient (r)</span>
                <div class="output-hero-value" id="res-r">0.0000</div>
                <span class="output-hero-unit" id="res-desc">Perfect Positive Correlation</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Coefficient of Determination (r²)</span>
                        <span class="value" id="res-r2">0.0000</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Relationship Strength</span>
                        <span class="value fs-6" id="res-strength">Very Strong</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Sample Size (n)</span>
                        <span class="value" id="res-n">0</span>
                    </div>
                </div>
            </div>

            <div class="mt-5 p-4 rounded-4 bg-light border">
                <h6 class="fw-bold mb-3"><i class="fas fa-chart-line me-2 text-success"></i>Interpretation Scale</h6>
                <div class="d-flex flex-column gap-2 small">
                    <div class="d-flex justify-content-between"><span>+1.0</span><span class="fw-bold">Perfect Positive</span></div>
                    <div class="d-flex justify-content-between"><span>+0.7 to +0.9</span><span class="fw-bold">Strong Positive</span></div>
                    <div class="d-flex justify-content-between"><span>+0.4 to +0.6</span><span class="fw-bold">Moderate Positive</span></div>
                    <div class="d-flex justify-content-between"><span>0.0</span><span class="fw-bold">No Relationship</span></div>
                    <div class="d-flex justify-content-between"><span>-1.0</span><span class="fw-bold">Perfect Negative</span></div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Summary
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

    function calculate() {
        const x = $('input-x').value.split(/[\s,;\n]+/).filter(v => v.trim() !== '' && !isNaN(v)).map(Number);
        const y = $('input-y').value.split(/[\s,;\n]+/).filter(v => v.trim() !== '' && !isNaN(v)).map(Number);

        if (x.length !== y.length || x.length < 2) {
            alert('Datasets must have same size and at least 2 points.');
            return;
        }

        const n = x.length;
        const meanX = math.mean(x);
        const meanY = math.mean(y);

        let numerator = 0;
        let denX = 0;
        let denY = 0;

        for(let i=0; i<n; i++) {
            numerator += (x[i] - meanX) * (y[i] - meanY);
            denX += Math.pow(x[i] - meanX, 2);
            denY += Math.pow(y[i] - meanY, 2);
        }

        const r = numerator / Math.sqrt(denX * denY);
        const r2 = r * r;

        $('res-r').textContent = r.toFixed(6);
        $('res-r2').textContent = r2.toFixed(6);
        $('res-n').textContent = n;

        let strength = "";
        let desc = "";
        const absR = Math.abs(r);

        if (absR >= 0.9) strength = "Very Strong";
        else if (absR >= 0.7) strength = "Strong";
        else if (absR >= 0.4) strength = "Moderate";
        else if (absR >= 0.2) strength = "Weak";
        else strength = "Negligible";

        if (r > 0) desc = strength + " Positive Correlation";
        else if (r < 0) desc = strength + " Negative Correlation";
        else desc = "No Linear Relationship";

        if (r === 1) desc = "Perfect Positive Correlation";
        if (r === -1) desc = "Perfect Negative Correlation";

        $('res-desc').textContent = desc;
        $('res-strength').textContent = strength;

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
});
</script>

<style>
.stats-suite-rebuilt .calculator-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
.stats-suite-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.2rem; margin-bottom: 2.5rem; }
.stats-suite-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #0f172a; }
.stats-suite-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; }
.stats-suite-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.stats-suite-rebuilt .form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; margin-bottom: 0.6rem; display: block; }
.btn-primary-stats { color: #fff; border: none; border-radius: 12px; transition: all 0.3s; }
.btn-dark-stats { background: #0f172a; color: #fff; border: none; border-radius: 12px; }
.output-card-themed { background: #fff; border: 2px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; margin-top: 1rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px solid rgba(0,0,0,0.05); }
.output-hero-label { font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; }
.output-hero-value { font-size: 4rem; font-weight: 900; color: #0f172a; margin: 0.5rem 0; }
.stat-pill { background: #f8fafc; padding: 1.2rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: center; }
.stat-pill .label { font-size: 0.7rem; font-weight: 700; color: #64748b; text-transform: uppercase; }
.stat-pill .value { font-size: 1.4rem; font-weight: 800; color: #0f172a; }
</style>

