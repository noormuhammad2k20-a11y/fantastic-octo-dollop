<div class="row g-4 set-theory-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Set A</label>
                        <textarea id="set-a" class="form-control form-control-lg rounded-3" rows="3" placeholder="e.g., 1, 2, 3, a, b">1, 2, 3, 4, 5</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Set B</label>
                        <textarea id="set-b" class="form-control form-control-lg rounded-3" rows="3" placeholder="e.g., 3, 4, 5, b, c">4, 5, 6, 7, 8</textarea>
                    </div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Compute All
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="row g-4">
                <!-- Union -->
                <div class="col-md-6">
                    <div class="stat-card p-4 rounded-3 border bg-white h-100">
                        <div class="small text-muted mb-2 text-uppercase fw-bold ls-1">Union ($A \cup B$)</div>
                        <div class="fs-5 fw-bold text-success mb-2" id="out-union">{}</div>
                        <div class="small text-secondary">All unique elements from both sets.</div>
                    </div>
                </div>
                <!-- Intersection -->
                <div class="col-md-6">
                    <div class="stat-card p-4 rounded-3 border bg-white h-100">
                        <div class="small text-muted mb-2 text-uppercase fw-bold ls-1">Intersection ($A \cap B$)</div>
                        <div class="fs-5 fw-bold text-primary mb-2" id="out-intersect">{}</div>
                        <div class="small text-secondary">Elements common to both sets.</div>
                    </div>
                </div>
                <!-- Difference A-B -->
                <div class="col-md-6">
                    <div class="stat-card p-4 rounded-3 border bg-white h-100">
                        <div class="small text-muted mb-2 text-uppercase fw-bold ls-1">Difference ($A \setminus B$)</div>
                        <div class="fs-5 fw-bold text-danger mb-2" id="out-diff-ab">{}</div>
                        <div class="small text-secondary">Elements in A but not in B.</div>
                    </div>
                </div>
                <!-- Symmetric Difference -->
                <div class="col-md-6">
                    <div class="stat-card p-4 rounded-3 border bg-white h-100">
                        <div class="small text-muted mb-2 text-uppercase fw-bold ls-1">Symmetric Difference ($A \Delta B$)</div>
                        <div class="fs-5 fw-bold text-warning mb-2" id="out-sym-diff">{}</div>
                        <div class="small text-secondary">Elements in either A or B, but not both.</div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Set Cardinality & Analysis</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Detailed Set Report
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function parseSet(str) {
        return new Set(str.split(/[\s,]+/).filter(x => x !== ''));
    }

    function setToStr(s) {
        return s.size === 0 ? '∅ (Empty Set)' : '{ ' + Array.from(s).join(', ') + ' }';
    }

    function calculate() {
        const setA = parseSet($('set-a').value);
        const setB = parseSet($('set-b').value);

        const union = new Set([...setA, ...setB]);
        const intersect = new Set([...setA].filter(x => setB.has(x)));
        const diffAB = new Set([...setA].filter(x => !setB.has(x)));
        const diffBA = new Set([...setB].filter(x => !setA.has(x)));
        const symDiff = new Set([...diffAB, ...diffBA]);

        $('out-union').textContent = setToStr(union);
        $('out-intersect').textContent = setToStr(intersect);
        $('out-diff-ab').textContent = setToStr(diffAB);
        $('out-sym-diff').textContent = setToStr(symDiff);

        let stepsHtml = `<ul class="ps-3 mt-2">`;
        stepsHtml += `<li class="mb-2"><b>Cardinality of A ($|A|$):</b> ${setA.size}</li>`;
        stepsHtml += `<li class="mb-2"><b>Cardinality of B ($|B|$):</b> ${setB.size}</li>`;
        stepsHtml += `<li class="mb-2"><b>Cardinality of Union ($|A \\cup B|$):</b> ${union.size}</li>`;
        stepsHtml += `<li class="mb-2"><b>Cardinality of Intersection ($|A \\cap B|$):</b> ${intersect.size}</li>`;
        stepsHtml += `<li class="mb-2"><b>Disjoint Check:</b> ${intersect.size === 0 ? '<span class="text-success">Sets are Disjoint</span>' : 'Sets are not disjoint'}</li>`;
        stepsHtml += `</ul>`;

        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('math-steps')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('set-a').value = '1, 2, 3, 4, 5';
        $('set-b').value = '4, 5, 6, 7, 8';
        $('output-section').style.display = 'none';
    });

    $('btn-copy-results').addEventListener('click', function() {
        const text = `Set Report\nA: ${$('set-a').value}\nB: ${$('set-b').value}\nUnion: ${$('out-union').textContent}\nIntersection: ${$('out-intersect').textContent}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

});
</script>

<style>
.set-theory-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.set-theory-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.set-theory-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.set-theory-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.set-theory-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.set-theory-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

.quick-actions-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; }
.btn-primary-action { background: #1e293b; color: #fff; border: none; border-radius: 14px; padding: 1rem; font-weight: 700; transition: all 0.2s; }
.btn-primary-action:hover { background: #0f172a; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.btn-secondary-action { background: #f1f5f9; color: #475569; border: none; border-radius: 14px; padding: 1rem; font-weight: 600; transition: all 0.2s; }
.btn-secondary-action:hover { background: #e2e8f0; color: #1e293b; }

@media (max-width: 768px) {
    .quick-actions-grid { grid-template-columns: 1fr 1fr; }
    .btn-primary-action { grid-column: span 2; }
}

.output-card-themed { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; margin-top: 2rem; }
.stat-card { transition: all 0.2s; }
.stat-card:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\set-theory-calculator.blade.php ENDPATH**/ ?>