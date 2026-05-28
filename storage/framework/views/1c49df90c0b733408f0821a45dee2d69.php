<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label-custom">Input Array (Integers separated by commas)</label>
                        <textarea id="data-input" class="form-control form-control-lg font-monospace" rows="4" placeholder="e.g. 170, 45, 75, 90, 802, 24, 2, 66">170, 45, 75, 90, 802, 24, 2, 66</textarea>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#d946ef;box-shadow:0 4px 12px rgba(217,70,239,0.2)">
                            <i class="fas fa-play me-2"></i>Run Radix Sort
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:300;--tool-color:#d946ef;--tool-bg:rgba(217,70,239,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Sorted Array</span>
                <div class="output-hero-value fs-3" id="res-array" style="word-break: break-all;">[2, 24, 45, 66, 75, 90, 170, 802]</div>
                <span class="output-hero-unit" id="res-passes">3 Passes Completed</span>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-pink"></i>Pass-by-Pass Breakdown</h6>
                <div id="passes-container"></div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Steps
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
        let arr = $('data-input').value.split(/[\s,;\n]+/).filter(v => v.trim() !== '' && !isNaN(v)).map(Number);
        if (arr.length === 0) return;

        const max = Math.max(...arr);
        let exp = 1;
        let passCount = 0;
        const passesHtml = [];

        while (Math.floor(max / exp) > 0) {
            passCount++;
            let buckets = Array.from({ length: 10 }, () => []);
            arr.forEach(num => {
                const digit = Math.floor(num / exp) % 10;
                buckets[digit].push(num);
            });

            let bucketInfo = buckets.map((b, i) => `<strong>${i}:</strong> [${b.join(', ')}]`).filter((s, i) => buckets[i].length > 0).join(' | ');

            arr = [].concat(...buckets);
            passesHtml.push(`
                <div class="step-card mb-4">
                    <div class="step-header">Pass ${passCount} (Digit at ${exp}'s place)</div>
                    <div class="step-body">
                        <div class="mb-2 text-muted small">Buckets:</div>
                        <div class="p-3 bg-light rounded-3 mb-3 small font-monospace">${bucketInfo}</div>
                        <div class="fw-bold">Current State: [${arr.join(', ')}]</div>
                    </div>
                </div>
            `);
            exp *= 10;
        }

        $('res-array').textContent = `[${arr.join(', ')}]`;
        $('res-passes').textContent = `${passCount} Passes Completed`;
        $('passes-container').innerHTML = passesHtml.join('');

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
.step-card { background: #f8fafc; border-radius: 16px; border: 1px solid #f1f5f9; overflow: hidden; }
.step-header { background: #fff; padding: 1rem 1.5rem; font-weight: 700; border-bottom: 1px solid #f1f5f9; }
.step-body { padding: 1.5rem; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\radix-sort-calculator.blade.php ENDPATH**/ ?>