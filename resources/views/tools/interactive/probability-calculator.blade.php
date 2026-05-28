<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Probability of Event A [P(A)]</label>
                        <input type="number" id="input-pa" class="form-control form-control-lg" value="0.5" step="0.01" min="0" max="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Probability of Event B [P(B)]</label>
                        <input type="number" id="input-pb" class="form-control form-control-lg" value="0.5" step="0.01" min="0" max="1">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Relationship Type</label>
                        <select id="input-type" class="form-select form-select-lg">
                            <option value="independent">Independent Events</option>
                            <option value="mutually_exclusive">Mutually Exclusive Events</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#14b8a6;box-shadow:0 4px 12px rgba(20,184,166,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Probabilities
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:170;--tool-color:#14b8a6;--tool-bg:rgba(20,184,166,.04); display: none;">
            <div class="output-hero mb-4">
                <span class="output-hero-label">P(A ∪ B) - Union</span>
                <div class="output-hero-value" id="res-union">0.75</div>
                <span class="output-hero-unit">Either Event Occurs</span>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Intersection P(A ∩ B)</span>
                        <span class="value" id="res-inter">0.25</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Complement P(A')</span>
                        <span class="value" id="res-compa">0.50</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Conditional P(A|B)</span>
                        <span class="value" id="res-cond">0.50</span>
                    </div>
                </div>
            </div>

            <div class="mt-5 p-4 rounded-4 bg-light border">
                <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-teal"></i>Relationship Notes</h6>
                <p id="res-note" class="mb-0 small">For independent events, the occurrence of one does not affect the other. P(A ∩ B) = P(A) * P(B).</p>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Probabilities
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
        const pa = parseFloat($('input-pa').value);
        const pb = parseFloat($('input-pb').value);
        const type = $('input-type').value;

        if (isNaN(pa) || isNaN(pb) || pa < 0 || pa > 1 || pb < 0 || pb > 1) return;

        let inter, union, condAB, note;

        if (type === 'independent') {
            inter = pa * pb;
            union = pa + pb - inter;
            condAB = pa;
            note = "For independent events: P(A ∩ B) = P(A) * P(B) and P(A ∪ B) = P(A) + P(B) - P(A ∩ B).";
        } else {
            inter = 0;
            union = Math.min(1, pa + pb);
            condAB = 0;
            note = "For mutually exclusive events: P(A ∩ B) = 0 and P(A ∪ B) = P(A) + P(B).";
        }

        $('res-union').textContent = union.toFixed(4);
        $('res-inter').textContent = inter.toFixed(4);
        $('res-compa').textContent = (1 - pa).toFixed(4);
        $('res-cond').textContent = pb > 0 ? condAB.toFixed(4) : "0.0000";
        $('res-note').textContent = note;

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
</style>

