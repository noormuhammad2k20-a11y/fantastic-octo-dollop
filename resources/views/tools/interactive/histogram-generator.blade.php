<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label-custom">Input Data Set</label>
                        <textarea id="data-input" class="form-control form-control-lg font-monospace" rows="4" placeholder="Enter numbers...&#10;e.g. 1, 2, 2, 3, 3, 3, 4, 4, 5">1, 2, 2, 3, 3, 3, 4, 4, 5</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Number of Bins</label>
                        <input type="number" id="input-bins" class="form-control form-control-lg" value="5" min="2" max="50">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Chart Color</label>
                        <select id="input-color" class="form-select form-select-lg">
                            <option value="rgba(79,70,229,0.8)">Indigo (Default)</option>
                            <option value="rgba(16,185,129,0.8)">Emerald Green</option>
                            <option value="rgba(245,158,11,0.8)">Amber Orange</option>
                            <option value="rgba(239,68,68,0.8)">Rose Red</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#4f46e5;box-shadow:0 4px 12px rgba(79,70,229,0.2)">
                            <i class="fas fa-chart-area me-2"></i>Generate Histogram
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:245;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,.04); display: none;">
            <div class="output-hero mb-4">
                <span class="output-hero-label">Data Distribution</span>
                <div style="height: 350px; width: 100%; margin-top: 1.5rem;">
                    <canvas id="histogramChart"></canvas>
                </div>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Mean</span>
                        <span class="value" id="res-mean">0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Std Dev</span>
                        <span class="value" id="res-std">0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Sample Size</span>
                        <span class="value" id="res-n">0</span>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-download" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-download me-2"></i>Download Chart (PNG)
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const btnCalc = $('btn-calculate');
    const resultsCard = $('results-card');
    let chartInstance = null;

    function calculate() {
        const data = $('data-input').value.split(/[\s,;\n]+/).filter(v => v.trim() !== '' && !isNaN(v)).map(Number).sort((a,b) => a-b);
        if (data.length === 0) return;

        const binCount = parseInt($('input-bins').value);
        const min = Math.min(...data);
        const max = Math.max(...data);
        const range = max - min;
        const binWidth = range / binCount;

        const bins = Array(binCount).fill(0);
        const labels = [];

        for(let i=0; i<binCount; i++) {
            const start = min + (i * binWidth);
            const end = min + ((i + 1) * binWidth);
            labels.push(`${start.toFixed(1)} - ${end.toFixed(1)}`);
            
            data.forEach(val => {
                if (i === binCount - 1) {
                    if (val >= start && val <= max) bins[i]++;
                } else {
                    if (val >= start && val < end) bins[i]++;
                }
            });
        }

        $('res-mean').textContent = math.mean(data).toFixed(2);
        $('res-std').textContent = math.std(data).toFixed(2);
        $('res-n').textContent = data.length;

        if (chartInstance) chartInstance.destroy();

        const ctx = $('histogramChart').getContext('2d');
        chartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Frequency',
                    data: bins,
                    backgroundColor: $('input-color').value,
                    borderColor: $('input-color').value.replace('0.8', '1'),
                    borderWidth: 1,
                    barPercentage: 1,
                    categoryPercentage: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
                    x: { grid: { display: false } }
                }
            }
        });

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
    $('btn-download').addEventListener('click', () => {
        const link = document.createElement('a');
        link.download = 'histogram.png';
        link.href = $('histogramChart').toDataURL();
        link.click();
    });
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
.output-hero { background: #fff; border-radius: 20px; border: 1px solid #f1f5f9; padding: 2rem; }
.output-hero-label { font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; display: block; text-align: center; }
.stat-pill { background: #f8fafc; padding: 1.2rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: center; }
.stat-pill .label { font-size: 0.7rem; font-weight: 700; color: #64748b; text-transform: uppercase; }
.stat-pill .value { font-size: 1.4rem; font-weight: 800; color: #0f172a; }
</style>

