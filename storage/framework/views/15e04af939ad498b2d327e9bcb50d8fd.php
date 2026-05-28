<div class="row g-4 number-randomizer-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Minimum Range</label>
                        <input type="number" id="num-min" class="form-control form-control-lg" value="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Maximum Range</label>
                        <input type="number" id="num-max" class="form-control form-control-lg" value="100">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Quantity to Generate</label>
                        <input type="number" id="num-count" class="form-control form-control-lg" value="1" min="1" max="5000">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Sorting</label>
                        <select id="num-sort" class="form-select form-select-lg">
                            <option value="none" selected>None (Random order)</option>
                            <option value="asc">Ascending (Small to Large)</option>
                            <option value="desc">Descending (Large to Small)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Unique Results</label>
                        <div class="form-check form-switch pt-2">
                            <input class="form-check-input" type="checkbox" id="num-unique" checked>
                            <label class="form-check-label" for="num-unique">Allow duplicates</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Exclude Numbers</label>
                        <input type="text" id="num-exclude" class="form-control form-control-lg" placeholder="e.g., 13, 7">
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-indigo fw-bold text-white py-3 px-5 fw-bold rounded-pill shadow-sm"" id="generate-btn" style="min-width: 280px; max-width: 100%; background:#4f46e5">
                        <i class="fas fa-play-circle me-2"></i>Generate Numbers
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="num-output-card" style="--tool-hue:240;--tool-color:#4338ca;--tool-bg:rgba(79,70,229,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Result</span>
                <div class="output-hero-value fs-1" id="primary-result">0</div>
                <span class="output-hero-unit" id="num-range-label">Range: 1 - 100</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4">
                    <div class="p-2 bg-white border rounded-3 text-center">
                        <div class="small text-muted mb-1">Sum</div>
                        <div class="fw-bold" id="stat-sum">0</div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-2 bg-white border rounded-3 text-center">
                        <div class="small text-muted mb-1">Avg</div>
                        <div class="fw-bold" id="stat-avg">0</div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-2 bg-white border rounded-3 text-center">
                        <div class="small text-muted mb-1">Mode</div>
                        <div class="fw-bold" id="stat-mode">-</div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2 text-primary"></i>Generated List</h6>
                <textarea id="results-text" class="form-control bg-white" rows="5" readonly></textarea>
            </div>
            
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-dark flex-grow-1 py-3 fw-bold rounded-3" id="copy-btn" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy List
                </button>
                <button class="btn btn-outline-dark px-4 py-3 fw-bold rounded-3" id="download-txt" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-download"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.number-randomizer-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.number-randomizer-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.number-randomizer-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.number-randomizer-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.number-randomizer-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.number-randomizer-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    $('generate-btn').addEventListener('click', generateNumbers);

    function generateNumbers() {
        const min = parseInt($('num-min').value);
        const max = parseInt($('num-max').value);
        const count = parseInt($('num-count').value) || 1;
        const allowDuplicates = $('num-unique').checked;
        const sort = $('num-sort').value;
        const exclude = $('num-exclude').value.split(',').map(n => parseInt(n.trim())).filter(n => !isNaN(n));
        
        if (isNaN(min) || isNaN(max)) {
            alert('Please enter valid range numbers.');
            return;
        }
        if (min > max) {
            alert('Min must be less than or equal to Max.');
            return;
        }

        const possibleRange = max - min + 1;
        if (!allowDuplicates && count > (possibleRange - exclude.length)) {
            alert(`Cannot generate ${count} unique numbers in this range with the specified exclusions.`);
            return;
        }

        const results = [];
        const used = new Set(exclude);

        let iterations = 0;
        const maxIterations = 100000; // Safety break

        while (results.length < count && iterations < maxIterations) {
            const r = Math.floor(Math.random() * (max - min + 1)) + min;
            if (allowDuplicates || !used.has(r)) {
                results.push(r);
                if (!allowDuplicates) used.add(r);
            }
            iterations++;
        }

        if (sort === 'asc') results.sort((a, b) => a - b);
        else if (sort === 'desc') results.sort((a, b) => b - a);

        displayResults(results, min, max);
    }

    function displayResults(results, min, max) {
        $('primary-result').textContent = results[0];
        $('num-range-label').textContent = `Range: ${min} - ${max}`;
        $('results-text').value = results.join(', ');
        
        const sum = results.reduce((a, b) => a + b, 0);
        $('stat-sum').textContent = sum.toLocaleString();
        $('stat-avg').textContent = (sum / results.length).toFixed(2);
        
        // Simple mode calculation
        const counts = {};
        results.forEach(n => counts[n] = (counts[n] || 0) + 1);
        let mode = results[0], maxCount = 0;
        for (const n in counts) {
            if (counts[n] > maxCount) {
                maxCount = counts[n];
                mode = n;
            }
        }
        $('stat-mode').textContent = maxCount > 1 ? mode : '-';

        $('num-output-card').classList.remove('d-none');
        $('num-output-card').scrollIntoView({ behavior: 'smooth' });
    }

    $('copy-btn').addEventListener('click', function() {
        $('results-text').select();
        document.execCommand('copy');
        const o = this.innerHTML;
        this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    $('download-txt').addEventListener('click', function() {
        const content = $('results-text').value;
        const blob = new Blob([content], { type: 'text/plain' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'random_numbers.txt';
        a.click();
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\number-randomizer.blade.php ENDPATH**/ ?>