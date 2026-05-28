<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label-custom">Input Data Set</label>
                        <textarea id="data-input" class="form-control form-control-lg font-monospace" rows="5" placeholder="Enter numbers separated by commas, spaces, or new lines...&#10;e.g., 2, 3, 3, 5, 7, 10, 10, 10, 15">2, 3, 3, 5, 7, 10, 10, 10, 15</textarea>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12 d-flex gap-2">
                        <button class="btn btn-primary-stats flex-grow-1 py-3 fw-bold" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#f59e0b;box-shadow:0 4px 12px rgba(245,158,11,0.2)">
                            <i class="fas fa-play me-2"></i>Find Mode
                        </button>
                        <button class="btn btn-outline-secondary px-4" onclick="location.reload()">
                            <i class="fas fa-undo"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:40;--tool-color:#d97706;--tool-bg:rgba(245,158,11,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Statistical Mode (Mo)</span>
                <div class="output-hero-value" id="res-mode">0</div>
                <span class="output-hero-unit" id="res-mode-type">Unimodal</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Frequency of Mode</span>
                        <span class="value" id="res-freq">0</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Total Unique Values</span>
                        <span class="value" id="res-unique">0</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-table me-2 text-warning"></i>Frequency Distribution Table</h6>
                <div class="table-responsive rounded-3 border">
                    <table class="table table-hover mb-0" id="freq-table">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Value</th>
                                <th>Frequency</th>
                                <th class="text-end pe-4">Percentage</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
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
    const input = $('data-input');
    const btnCalc = $('btn-calculate');
    const resultsCard = $('results-card');

    function calculate() {
        const data = input.value.split(/[\s,;\n]+/).filter(x => x.trim() !== '' && !isNaN(x)).map(Number);
        if (data.length === 0) return;

        const freqMap = {};
        data.forEach(n => freqMap[n] = (freqMap[n] || 0) + 1);

        const uniqueVals = Object.keys(freqMap).map(Number).sort((a,b) => a-b);
        let maxFreq = 0;
        uniqueVals.forEach(v => { if(freqMap[v] > maxFreq) maxFreq = freqMap[v]; });

        const modes = uniqueVals.filter(v => freqMap[v] === maxFreq);
        
        if (maxFreq === 1 && data.length > 1) {
            $('res-mode').textContent = "None";
            $('res-mode-type').textContent = "No repeating values";
        } else {
            $('res-mode').textContent = modes.join(', ');
            $('res-mode-type').textContent = modes.length === 1 ? "Unimodal" : (modes.length === 2 ? "Bimodal" : "Multimodal");
        }

        $('res-freq').textContent = maxFreq;
        $('res-unique').textContent = uniqueVals.length;

        // Fill Table
        const tbody = $('freq-table').querySelector('tbody');
        tbody.innerHTML = '';
        uniqueVals.sort((a,b) => freqMap[b] - freqMap[a]).forEach(v => {
            const tr = document.createElement('tr');
            if (freqMap[v] === maxFreq && maxFreq > 1) tr.classList.add('table-warning');
            tr.innerHTML = `
                <td class="ps-4 fw-bold">${v}</td>
                <td>${freqMap[v]}</td>
                <td class="text-end pe-4 text-muted">${((freqMap[v]/data.length)*100).toFixed(1)}%</td>
            `;
            tbody.appendChild(tr);
        });

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
    $('btn-copy').addEventListener('click', function() {
        const text = `Mode: ${$('res-mode').textContent}\nFrequency: ${$('res-freq').textContent}\nToolsHub Statistics`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
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
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px solid rgba(0,0,0,0.05); }
.output-hero-label { font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; }
.output-hero-value { font-size: 4rem; font-weight: 900; color: #0f172a; margin: 0.5rem 0; }
.stat-pill { background: #f8fafc; padding: 1.2rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: center; }
.stat-pill .label { font-size: 0.7rem; font-weight: 700; color: #64748b; text-transform: uppercase; }
.stat-pill .value { font-size: 1.4rem; font-weight: 800; color: #0f172a; }
.table thead th { font-size: 0.75rem; text-transform: uppercase; color: #64748b; padding: 1rem; border: none; }
.table tbody td { padding: 1rem; vertical-align: middle; border-color: #f1f5f9; }
</style>

