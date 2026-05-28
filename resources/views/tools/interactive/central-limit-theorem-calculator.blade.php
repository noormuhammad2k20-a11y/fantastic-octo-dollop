<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Population Distribution</label>
                        <select id="input-dist" class="form-select form-select-lg">
                            <option value="uniform">Uniform (Flat)</option>
                            <option value="exponential">Exponential (Skewed)</option>
                            <option value="bimodal">Bimodal (Two Peaks)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Sample Size (n)</label>
                        <input type="range" id="input-n" class="form-range" min="2" max="100" value="30">
                        <div class="text-center fw-bold text-primary mt-1" id="n-display">n = 30</div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Number of Samples to Draw</label>
                        <input type="number" id="input-count" class="form-control form-control-lg" value="1000" step="100" max="5000">
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#3b82f6;box-shadow:0 4px 12px rgba(59,130,246,0.2)">
                            <i class="fas fa-play me-2"></i>Run Simulation
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:210;--tool-color:#3b82f6;--tool-bg:rgba(59,130,246,.04); display: none;">
            <div class="output-hero mb-4">
                <span class="output-hero-label">Distribution of Sample Means</span>
                <div style="height: 350px; width: 100%; margin-top: 1.5rem;">
                    <canvas id="cltChart"></canvas>
                </div>
            </div>

            <div class="mt-5 p-4 rounded-4 bg-light border">
                <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>CLT Insights</h6>
                <p id="res-insight" class="mb-0">With n = 30, the distribution is already showing a clear bell shape. The mean of these sample means is approximately equal to the population mean.</p>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" onclick="location.reload()">
                    <i class="fas fa-redo me-2"></i>Reset Simulation
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const btnCalc = $('btn-calculate');
    const nInput = $('input-n');
    let chartInstance = null;

    nInput.addEventListener('input', () => { $('n-display').textContent = `n = ${nInput.value}`; });

    function getSample(dist, n) {
        let sample = [];
        for(let i=0; i<n; i++) {
            if(dist === 'uniform') sample.push(Math.random() * 100);
            else if(dist === 'exponential') sample.push(-Math.log(1 - Math.random()) * 20);
            else if(dist === 'bimodal') sample.push(Math.random() > 0.5 ? (Math.random() * 20 + 20) : (Math.random() * 20 + 60));
        }
        return sample.reduce((a,b)=>a+b, 0) / n;
    }

    function calculate() {
        const dist = $('input-dist').value;
        const n = parseInt(nInput.value);
        const count = parseInt($('input-count').value);

        const sampleMeans = [];
        for(let i=0; i<count; i++) sampleMeans.push(getSample(dist, n));

        // Create Histogram Data
        const min = Math.min(...sampleMeans);
        const max = Math.max(...sampleMeans);
        const binCount = 30;
        const binWidth = (max - min) / binCount;
        const bins = Array(binCount).fill(0);
        const labels = [];

        for(let i=0; i<binCount; i++) {
            const start = min + (i * binWidth);
            labels.push(start.toFixed(1));
            sampleMeans.forEach(val => {
                if(val >= start && val < (start + binWidth)) bins[i]++;
            });
        }

        if(chartInstance) chartInstance.destroy();
        const ctx = $('cltChart').getContext('2d');
        chartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Frequency',
                    data: bins,
                    backgroundColor: 'rgba(59,130,246,0.7)',
                    borderColor: '#3b82f6',
                    borderWidth: 1,
                    barPercentage: 1.2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
                    x: { ticks: { maxTicksLimit: 10 } }
                }
            }
        });

        $('res-insight').innerHTML = `After drawing <strong>${count}</strong> samples of size <strong>n=${n}</strong> from a <strong>${dist}</strong> population, the resulting distribution of sample means follows a normal distribution. Notice how higher values of <strong>n</strong> make the curve narrower and more symmetric.`;
        $('results-card').style.display = 'block';
        $('results-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
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
.output-hero { background: #fff; border-radius: 20px; border: 1px solid #f1f5f9; padding: 2rem; }
</style>

