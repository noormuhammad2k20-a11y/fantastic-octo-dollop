<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Select Distribution / Test</label>
                        <select id="test-type" class="form-select form-select-lg">
                            <option value="z">Z-test (Standard Normal)</option>
                            <option value="t">T-test (Student's T)</option>
                            <option value="chi">Chi-Square Test</option>
                            <option value="f">F-test (ANOVA)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Test Statistic Score</label>
                        <input type="number" id="input-score" class="form-control form-control-lg" value="2.0" step="0.01">
                    </div>
                    
                    <div id="df-row" class="col-md-6" style="display:none;">
                        <label class="form-label-custom">Degrees of Freedom (df)</label>
                        <input type="number" id="input-df" class="form-control form-control-lg" value="10" min="1">
                    </div>
                    <div id="df2-row" class="col-md-6" style="display:none;">
                        <label class="form-label-custom">Degrees of Freedom 2 (df2)</label>
                        <input type="number" id="input-df2" class="form-control form-control-lg" value="10" min="1">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-custom">Tails</label>
                        <select id="input-tails" class="form-select form-select-lg">
                            <option value="2">Two-tailed (≠)</option>
                            <option value="1">One-tailed (Left or Right)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Significance Level (α)</label>
                        <select id="input-alpha" class="form-select form-select-lg">
                            <option value="0.05">0.05 (Default)</option>
                            <option value="0.01">0.01 (Strict)</option>
                            <option value="0.10">0.10 (Liberal)</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12 d-flex gap-2">
                        <button class="btn btn-primary-stats flex-grow-1 py-3 fw-bold" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#8b5cf6;box-shadow:0 4px 12px rgba(139,92,246,0.2)">
                            <i class="fas fa-flask me-2"></i>Calculate P-Value
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:260;--tool-color:#8b5cf6;--tool-bg:rgba(139,92,246,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Calculated P-Value</span>
                <div class="output-hero-value" id="res-p">0.0000</div>
                <span class="output-hero-unit" id="res-sig-status">Statistically Significant</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Null Hypothesis (H₀)</span>
                        <span class="value fs-6" id="res-null">Reject</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Confidence Level</span>
                        <span class="value" id="res-confidence">95%</span>
                    </div>
                </div>
            </div>

            <div class="mt-5 p-4 rounded-4 bg-light border">
                <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Interpretation</h6>
                <p id="res-interpretation" class="mb-0">The results suggest that there is a 5% probability that the observed results occurred by random chance.</p>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Results
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jstat/1.9.6/jstat.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const btnCalc = $('btn-calculate');
    const resultsCard = $('results-card');
    const testType = $('test-type');

    testType.addEventListener('change', () => {
        const val = testType.value;
        $('df-row').style.display = (val === 't' || val === 'chi' || val === 'f') ? 'block' : 'none';
        $('df2-row').style.display = (val === 'f') ? 'block' : 'none';
    });

    function calculate() {
        const type = testType.value;
        const score = parseFloat($('input-score').value);
        const df = parseFloat($('input-df').value);
        const df2 = parseFloat($('input-df2').value);
        const tails = parseInt($('input-tails').value);
        const alpha = parseFloat($('input-alpha').value);

        let pValue = 0;

        try {
            if (type === 'z') {
                pValue = 1 - jStat.ztest(score, tails);
                // Note: jStat.ztest returns p-value differently sometimes. Let's use CDF.
                const cdf = jStat.normal.cdf(Math.abs(score), 0, 1);
                pValue = tails === 2 ? 2 * (1 - cdf) : (1 - cdf);
            } else if (type === 't') {
                const cdf = jStat.studentt.cdf(Math.abs(score), df);
                pValue = tails === 2 ? 2 * (1 - cdf) : (1 - cdf);
            } else if (type === 'chi') {
                pValue = 1 - jStat.chisquare.cdf(score, df);
            } else if (type === 'f') {
                pValue = 1 - jStat.centralF.cdf(score, df, df2);
            }

            if (isNaN(pValue)) throw new Error("Invalid Input");
            
            pValue = Math.max(0, Math.min(1, pValue));

            $('res-p').textContent = pValue.toFixed(5);
            const isSig = pValue < alpha;
            $('res-sig-status').textContent = isSig ? "Statistically Significant" : "Not Significant";
            $('res-sig-status').className = isSig ? "output-hero-unit text-success fw-bold" : "output-hero-unit text-danger fw-bold";
            $('res-null').textContent = isSig ? "Reject H₀" : "Fail to Reject H₀";
            $('res-confidence').textContent = ((1 - alpha) * 100) + "%";

            $('res-interpretation').innerHTML = isSig 
                ? `Since p (${pValue.toFixed(5)}) is <strong>less than</strong> α (${alpha}), we reject the null hypothesis. There is sufficient evidence to suggest a significant effect.`
                : `Since p (${pValue.toFixed(5)}) is <strong>greater than</strong> α (${alpha}), we fail to reject the null hypothesis. There is not enough evidence to suggest a significant effect.`;

            resultsCard.style.display = 'block';
            resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } catch (e) {
            alert('Please check your inputs. Ensure scores and degrees of freedom are valid numbers.');
        }
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

