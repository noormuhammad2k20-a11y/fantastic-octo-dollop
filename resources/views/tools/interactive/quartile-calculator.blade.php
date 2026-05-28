<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label-custom">Input Data Set</label>
                        <textarea id="data-input" class="form-control form-control-lg font-monospace" rows="5" placeholder="Enter numbers...&#10;e.g. 10, 15, 20, 25, 30, 35, 40">10, 15, 20, 25, 30, 35, 40</textarea>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#7c3aed;box-shadow:0 4px 12px rgba(124,58,237,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Quartiles
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(124,58,237,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Interquartile Range (IQR)</span>
                <div class="output-hero-value" id="res-iqr">0.00</div>
                <span class="output-hero-unit">Measure of Variability</span>
            </div>

            <div class="row g-4 mt-4 text-center">
                <div class="col-md-3">
                    <div class="stat-pill">
                        <span class="label">Minimum</span>
                        <span class="value" id="res-min">0</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-pill border-primary" style="border-width: 2px;">
                        <span class="label">Q1 (25th)</span>
                        <span class="value" id="res-q1">0</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-pill border-primary" style="border-width: 2px;">
                        <span class="label">Q2 (Median)</span>
                        <span class="value" id="res-q2">0</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-pill border-primary" style="border-width: 2px;">
                        <span class="label">Q3 (75th)</span>
                        <span class="value" id="res-q3">0</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-pill">
                        <span class="label">Maximum</span>
                        <span class="value" id="res-max">0</span>
                    </div>
                </div>
            </div>

            <div class="mt-5 p-4 rounded-4 bg-light border">
                <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Five-Number Summary</h6>
                <p class="mb-0">The data is split into 4 equal groups: [Min] → Q1 (25%) → Median (50%) → Q3 (75%) → [Max].</p>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Results
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
        const data = $('data-input').value.split(/[\s,;\n]+/).filter(v => v.trim() !== '' && !isNaN(v)).map(Number).sort((a,b) => a-b);
        if (data.length < 4) {
            alert('At least 4 data points are recommended for quartile calculation.');
            return;
        }

        const q1 = math.quantileSeq(data, 0.25);
        const q2 = math.median(data);
        const q3 = math.quantileSeq(data, 0.75);
        const iqr = q3 - q1;

        $('res-min').textContent = data[0];
        $('res-q1').textContent = q1;
        $('res-q2').textContent = q2;
        $('res-q3').textContent = q3;
        $('res-max').textContent = data[data.length-1];
        $('res-iqr').textContent = iqr;

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
.stat-pill { background: #f8fafc; padding: 1rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: center; height: 100%; }
.stat-pill .label { font-size: 0.65rem; font-weight: 700; color: #64748b; text-transform: uppercase; }
.stat-pill .value { font-size: 1.2rem; font-weight: 800; color: #0f172a; }
</style>

