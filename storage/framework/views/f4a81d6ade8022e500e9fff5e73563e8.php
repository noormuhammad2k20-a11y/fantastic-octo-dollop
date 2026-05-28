<div class="row g-4 gaussian-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label-custom">Mean (μ)</label>
                        <input type="number" id="gauss-mean" class="form-control form-control-lg" value="0" step="any">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Standard Dev (σ)</label>
                        <input type="number" id="gauss-sd" class="form-control form-control-lg" value="1" step="any" min="0.001">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Quantity</label>
                        <input type="number" id="gauss-count" class="form-control form-control-lg" value="1000" min="1" max="10000">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Decimals</label>
                        <input type="number" id="gauss-decimals" class="form-control form-control-lg" value="4" min="0" max="10">
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-primary py-3 px-5 fw-bold rounded-pill shadow-sm" id="gauss-generate" style="min-width: 280px; max-width: 100%; background:#8b5cf6;border:none;">
                        <i class="fas fa-magic me-2"></i>Generate Dataset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="gauss-output-card" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04);">
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-6">
                    <div class="p-3 bg-white border rounded-3 text-center">
                        <div class="small text-muted text-uppercase fw-bold mb-1">Generated Mean</div>
                        <div class="h5 mb-0 fw-black text-primary" id="stat-mean">0</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-3 bg-white border rounded-3 text-center">
                        <div class="small text-muted text-uppercase fw-bold mb-1">Generated SD</div>
                        <div class="h5 mb-0 fw-black text-primary" id="stat-sd">0</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-3 bg-white border rounded-3 text-center">
                        <div class="small text-muted text-uppercase fw-bold mb-1">Min Value</div>
                        <div class="h5 mb-0 fw-black" id="stat-min">0</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-3 bg-white border rounded-3 text-center">
                        <div class="small text-muted text-uppercase fw-bold mb-1">Max Value</div>
                        <div class="h5 mb-0 fw-black" id="stat-max">0</div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-chart-line me-2 text-primary"></i>Histogram Distribution</h6>
                <div class="bg-white border rounded-3 p-4" style="height: 250px; position: relative;">
                    <div class="histogram-container" id="gauss-histogram">
                        <!-- Bars injected here -->
                    </div>
                </div>
            </div>

            <div>
                <h6 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-database me-2 text-primary"></i>Raw Data</span>
                </h6>
                <textarea id="gauss-data" class="form-control bg-white" rows="6" readonly></textarea>
            </div>
            
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-dark flex-grow-1 py-3 fw-bold rounded-3" id="copy-data" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Data
                </button>
                <button class="btn btn-outline-dark px-4 py-3 fw-bold rounded-3" id="download-csv" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-download"></i> CSV
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.gaussian-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.gaussian-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.gaussian-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.gaussian-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.gaussian-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.gaussian-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}

.histogram-container {
    display: flex;
    align-items: flex-end;
    justify-content: center;
    height: 100%;
    width: 100%;
    gap: 2px;
}
.hist-bar {
    background: #8b5cf6;
    flex-grow: 1;
    border-radius: 4px 4px 0 0;
    transition: height 0.5s ease;
    min-height: 1px;
    opacity: 0.8;
}
.hist-bar:hover { opacity: 1; background: #6d28d9; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    // Box-Muller transform
    function randomGaussian(mean, sd) {
        let u = 0, v = 0;
        while(u === 0) u = Math.random();
        while(v === 0) v = Math.random();
        let num = Math.sqrt(-2.0 * Math.log(u)) * Math.cos(2.0 * Math.PI * v);
        return num * sd + mean;
    }

    $('gauss-generate').addEventListener('click', generateData);

    function generateData() {
        const mean = parseFloat($('gauss-mean').value) || 0;
        const sd = parseFloat($('gauss-sd').value) || 1;
        const count = parseInt($('gauss-count').value) || 1000;
        const decimals = parseInt($('gauss-decimals').value) || 0;

        if (count > 50000) {
            alert('Max quantity is 50,000 to prevent browser crash.');
            return;
        }

        const data = [];
        let sum = 0;
        let min = Infinity;
        let max = -Infinity;

        for (let i = 0; i < count; i++) {
            const val = randomGaussian(mean, sd);
            data.push(val);
            sum += val;
            if (val < min) min = val;
            if (val > max) max = val;
        }

        const actualMean = sum / count;
        let varianceSum = 0;
        data.forEach(val => {
            varianceSum += Math.pow(val - actualMean, 2);
        });
        const actualSD = Math.sqrt(varianceSum / count);

        // Render stats
        $('stat-mean').textContent = actualMean.toFixed(decimals);
        $('stat-sd').textContent = actualSD.toFixed(decimals);
        $('stat-min').textContent = min.toFixed(decimals);
        $('stat-max').textContent = max.toFixed(decimals);

        // Format data string
        const formattedData = data.map(v => v.toFixed(decimals));
        $('gauss-data').value = formattedData.join('\n');

        // Draw Histogram (approx 40 bins)
        drawHistogram(data, min, max, 40);

        $('gauss-output-card').classList.remove('d-none');
        $('gauss-output-card').scrollIntoView({ behavior: 'smooth' });
    }

    function drawHistogram(data, min, max, binsCount) {
        const container = $('gauss-histogram');
        container.innerHTML = '';
        
        if (data.length === 0 || min === max) return;

        const binWidth = (max - min) / binsCount;
        const bins = new Array(binsCount).fill(0);

        data.forEach(val => {
            let binIdx = Math.floor((val - min) / binWidth);
            if (binIdx >= binsCount) binIdx = binsCount - 1; // Edge case for exact max
            bins[binIdx]++;
        });

        const maxBinCount = Math.max(...bins);

        bins.forEach((count, i) => {
            const bar = document.createElement('div');
            bar.className = 'hist-bar';
            const heightPct = maxBinCount > 0 ? (count / maxBinCount * 100) : 0;
            bar.style.height = `${heightPct}%`;
            
            const binStart = (min + i * binWidth).toFixed(2);
            bar.title = `Range: ~${binStart}\nCount: ${count}`;
            
            container.appendChild(bar);
        });
    }

    $('copy-data').addEventListener('click', function() {
        $('gauss-data').select();
        document.execCommand('copy');
        const o = this.innerHTML;
        this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    $('download-csv').addEventListener('click', function() {
        const content = "Value\n" + $('gauss-data').value;
        const blob = new Blob([content], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'gaussian_distribution.csv';
        a.click();
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\gaussian-distribution-generator.blade.php ENDPATH**/ ?>