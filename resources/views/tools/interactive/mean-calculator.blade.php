<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label-custom">Input Data Set</label>
                        <textarea id="data-input" class="form-control form-control-lg font-monospace" rows="5" placeholder="Enter numbers separated by commas, spaces, or new lines...&#10;e.g., 12, 15, 24, 18, 30">12, 15, 24, 18, 30</textarea>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="appendDemoData()">Sample Data</button>
                            <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="clearData()">Clear</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Input Delimiter</label>
                        <select id="data-delimiter" class="form-select form-select-lg">
                            <option value="auto">Auto-Detect (Smart)</option>
                            <option value=",">Comma (,)</option>
                            <option value=" ">Space ( )</option>
                            <option value="\n">New Line</option>
                            <option value=";">Semicolon (;)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Decimal Precision</label>
                        <select id="data-precision" class="form-select form-select-lg">
                            <option value="2">2 Decimal Places</option>
                            <option value="4">4 Decimal Places</option>
                            <option value="0">Whole Numbers</option>
                            <option value="max">Maximum Precision</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12 d-flex gap-2">
                        <button class="btn btn-primary-stats flex-grow-1 py-3 fw-bold" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-play me-2"></i>Calculate Results
                        </button>
                        <button class="btn btn-outline-secondary px-4" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-undo"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:220;--tool-color:#2563eb;--tool-bg:rgba(37,99,235,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Arithmetic Mean (x̄)</span>
                <div class="output-hero-value" id="res-mean">0</div>
                <span class="output-hero-unit">Average Value</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Sum (Σx)</span>
                        <span class="value" id="res-sum">0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Sample Size (n)</span>
                        <span class="value" id="res-count">0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Range</span>
                        <span class="value" id="res-range">0</span>
                    </div>
                </div>
            </div>

            <div class="step-container mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-primary"></i>Step-by-Step Calculation</h6>
                <div class="step-card mb-3">
                    <div class="step-header">Step 1: Identify and Clean Data</div>
                    <div class="step-body">
                        <p>We extracted <strong id="step-n">0</strong> valid numerical values from your input:</p>
                        <div id="data-preview" class="p-3 bg-white rounded border font-monospace small mb-2 overflow-auto" style="max-height: 100px;"></div>
                    </div>
                </div>
                <div class="step-card mb-3">
                    <div class="step-header">Step 2: Calculate the Sum (Σ)</div>
                    <div class="step-body">
                        <p>Summing all the values together:</p>
                        <div class="formula-block" id="step-sum-formula">Σx = ...</div>
                    </div>
                </div>
                <div class="step-card mb-3">
                    <div class="step-header">Step 3: Apply Mean Formula</div>
                    <div class="step-body">
                        <p>Divide the sum by the count of values (n):</p>
                        <div class="formula-block text-center py-3">
                            <span class="fs-5">x̄ = Σx / n</span><br>
                            <span class="fs-4 mt-2 d-inline-block" id="step-final-formula">x̄ = 0 / 0 = 0</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Results
                </button>
                <button class="btn btn-outline-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-download" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-download me-2"></i>Download CSV
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const input = $('data-input');
    const btnCalc = $('btn-calculate');
    const btnReset = $('btn-reset');
    const resultsCard = $('results-card');

    function parseData() {
        const raw = input.value;
        const delim = $('data-delimiter').value;
        let vals = [];
        
        if (delim === 'auto') {
            vals = raw.split(/[\s,;\n]+/).filter(x => x.trim() !== '');
        } else if (delim === '\\n') {
            vals = raw.split('\n').filter(x => x.trim() !== '');
        } else {
            vals = raw.split(delim).filter(x => x.trim() !== '');
        }

        return vals.map(v => v.trim()).filter(v => v !== '' && !isNaN(v)).map(Number);
    }

    function calculate() {
        const data = parseData();
        if (data.length === 0) {
            alert('Please enter a valid numerical dataset.');
            return;
        }

        const precision = $('data-precision').value;
        const fmt = (val) => {
            if (precision === 'max') return val;
            return Number(val.toFixed(parseInt(precision)));
        };

        try {
            const sum = math.sum(data);
            const count = data.length;
            const mean = sum / count;
            const range = math.max(data) - math.min(data);

            // Update UI
            $('res-mean').textContent = fmt(mean).toLocaleString();
            $('res-sum').textContent = sum.toLocaleString();
            $('res-count').textContent = count;
            $('res-range').textContent = range.toLocaleString();

            // Step by Step
            $('step-n').textContent = count;
            $('data-preview').textContent = data.join(', ');
            $('step-sum-formula').textContent = `Σx = ${data.join(' + ')} = ${sum}`;
            $('step-final-formula').textContent = `x̄ = ${sum} / ${count} = ${fmt(mean)}`;

            resultsCard.style.display = 'block';
            resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } catch (e) {
            console.error(e);
            alert('An error occurred during calculation. Please check your data.');
        }
    }

    btnCalc.addEventListener('click', calculate);
    btnReset.addEventListener('click', () => {
        input.value = '';
        resultsCard.style.display = 'none';
        input.focus();
    });

    $('btn-copy').addEventListener('click', function() {
        const mean = $('res-mean').textContent;
        const sum = $('res-sum').textContent;
        const count = $('res-count').textContent;
        const text = `Mean Calculation Results:\nMean: ${mean}\nSum: ${sum}\nCount: ${count}\n\nGenerated via ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('btn-download').addEventListener('click', function() {
        const data = parseData();
        const csvContent = "data:text/csv;charset=utf-8," + "Value\n" + data.join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "dataset_mean.csv");
        document.body.appendChild(link);
        link.click();
    });

    window.appendDemoData = function() {
        const samples = [
            "15, 22, 18, 25, 30",
            "10.5, 20.3, 15.8, 12.2",
            "100, 200, 300, 400, 500",
            "-5, 0, 5, 10, 15"
        ];
        input.value = samples[Math.floor(Math.random() * samples.length)];
        calculate();
    };

    window.clearData = function() {
        input.value = '';
        resultsCard.style.display = 'none';
    };
});
</script>

<style>
.stats-suite-rebuilt .calculator-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
.stats-suite-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.2rem; margin-bottom: 2.5rem; }
.stats-suite-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #0f172a; letter-spacing: -0.5px; }
.stats-suite-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.stats-suite-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.stats-suite-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }
.stats-suite-rebuilt .form-control-custom { border: 2px solid #f1f5f9; border-radius: 12px; padding: 1rem; transition: all 0.2s; font-size: 1rem; }
.stats-suite-rebuilt .form-control-custom:focus { border-color: #2563eb; background: #fff; box-shadow: 0 0 0 4px rgba(37,99,235,0.1); }
.btn-primary-stats { background: #2563eb; color: #fff; border: none; border-radius: 12px; transition: all 0.3s; box-shadow: 0 4px 12px rgba(37,99,235,0.2); }
.btn-primary-stats:hover { background: #1d4ed8; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(37,99,235,0.3); }
.btn-dark-stats { background: #0f172a; color: #fff; border: none; border-radius: 12px; }
.btn-outline-stats { border: 2px solid #e2e8f0; color: #475569; border-radius: 12px; font-weight: 600; }
.output-card-themed { background: #fff; border: 2px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; margin-top: 1rem; position: relative; overflow: hidden; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px solid rgba(37,99,235,0.1); }
.output-hero-label { font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; letter-spacing: 1px; }
.output-hero-value { font-size: 4rem; font-weight: 900; color: #0f172a; line-height: 1.1; margin: 0.5rem 0; }
.output-hero-unit { font-size: 1rem; color: #64748b; font-weight: 500; }
.stat-pill { background: #f8fafc; padding: 1.2rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: center; }
.stat-pill .label { font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 0.4rem; }
.stat-pill .value { font-size: 1.4rem; font-weight: 800; color: #0f172a; }
.step-card { background: #f8fafc; border-radius: 16px; border: 1px solid #f1f5f9; overflow: hidden; }
.step-header { background: #fff; padding: 1rem 1.5rem; font-weight: 700; color: #1e293b; border-bottom: 1px solid #f1f5f9; font-size: 0.95rem; }
.step-body { padding: 1.5rem; color: #475569; font-size: 0.95rem; }
.formula-block { background: #0f172a; color: #e2e8f0; padding: 1.5rem; border-radius: 12px; font-family: 'Courier New', Courier, monospace; overflow-x: auto; }
</style>

