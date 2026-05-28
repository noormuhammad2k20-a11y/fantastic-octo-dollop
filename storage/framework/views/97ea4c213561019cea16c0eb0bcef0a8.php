<div class="row g-4 fibonacci-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Number of Terms (n)</label>
                        <input type="number" id="fib-n" class="form-control form-control-lg rounded-3" value="10" min="1" max="500">
                        <div class="form-text mt-2">Generate the first n terms of the sequence. For n > 78, values exceed standard integer precision.</div>
                    </div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Generate Sequence
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-pdf" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-file-pdf me-2"></i>PDF
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-svg" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-project-diagram me-2"></i>SVG
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">n-th Fibonacci Number ($F_n$)</span>
                <div class="output-hero-value" id="out-fn" style="word-break: break-all; font-size: 2.5rem;">0</div>
                <span class="output-hero-unit" id="out-summary">for n = 10</span>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-list me-2 text-primary"></i>Sequence Visualization</h6>
                <div class="d-flex flex-wrap gap-2" id="sequence-display"></div>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Mathematical Properties</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Sequence
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function calculate() {
        const n = parseInt($('fib-n').value);
        if (isNaN(n) || n < 1) return;

        let sequence = [];
        if (n >= 1) sequence.push(BigInt(0));
        if (n >= 2) sequence.push(BigInt(1));

        for (let i = 2; i < n; i++) {
            sequence.push(sequence[i - 1] + sequence[i - 2]);
        }

        const fn = sequence[n - 1];
        $('out-fn').textContent = fn.toString();
        $('out-summary').textContent = `The ${n}-th term of the sequence`;

        const seqDiv = $('sequence-display');
        seqDiv.innerHTML = '';
        sequence.forEach((val, i) => {
            const span = document.createElement('span');
            span.className = 'badge bg-light text-dark border p-2 fw-normal';
            span.style.fontSize = '0.9rem';
            span.innerHTML = `<small class="text-muted mr-1">${i}:</small> ${val.toString()}`;
            seqDiv.appendChild(span);
        });

        const phi = (1 + Math.sqrt(5)) / 2;
        let stepsHtml = `<p>The Fibonacci sequence is defined by the recurrence relation:</p>`;
        stepsHtml += `<p class="text-center my-3 fs-5">$F_n = F_{n-1} + F_{n-2}$</p>`;
        stepsHtml += `<p>With seed values $F_0 = 0, F_1 = 1$.</p>`;
        stepsHtml += `<ul class="ps-3">`;
        stepsHtml += `<li class="mb-2"><b>Golden Ratio Approximation:</b> As $n$ increases, the ratio $F_n/F_{n-1}$ approaches $\\phi \\approx ${phi.toFixed(6)}$.</li>`;
        if (n > 1) {
            const ratio = Number(sequence[n-1]) / Number(sequence[n-2]);
            stepsHtml += `<li class="mb-2"><b>Current Ratio ($F_{${n-1}}/F_{${n-2}}$):</b> ${ratio.toFixed(10)}</li>`;
        }
        stepsHtml += `<li class="mb-2"><b>Binet's Formula:</b> $F_n = \\frac{\\phi^n - (1-\\phi)^n}{\\sqrt{5}}$</li>`;
        stepsHtml += `</ul>`;

        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('math-steps')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('fib-n').value = '10';
        $('output-section').style.display = 'none';
    });

    $('btn-copy-results').addEventListener('click', function() {
        const terms = Array.from($('sequence-display').children).map(s => s.textContent.split(': ')[1]).join(', ');
        navigator.clipboard.writeText(terms).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Sequence Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

    $('btn-pdf').addEventListener('click', () => alert('Generating PDF Report...'));
    $('btn-svg').addEventListener('click', () => alert('Exporting SVG Visualization...'));
});
</script>

<style>
.fibonacci-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.fibonacci-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.fibonacci-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.fibonacci-calc-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.fibonacci-calc-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.fibonacci-calc-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

.quick-actions-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 1rem; }
.btn-primary-action { background: #1e293b; color: #fff; border: none; border-radius: 14px; padding: 1rem; font-weight: 700; transition: all 0.2s; }
.btn-primary-action:hover { background: #0f172a; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.btn-secondary-action { background: #f1f5f9; color: #475569; border: none; border-radius: 14px; padding: 1rem; font-weight: 600; transition: all 0.2s; }
.btn-secondary-action:hover { background: #e2e8f0; color: #1e293b; }

@media (max-width: 768px) {
    .quick-actions-grid { grid-template-columns: 1fr 1fr; }
    .btn-primary-action { grid-column: span 2; }
}

.output-card-themed { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; margin-top: 2rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(139,92,246,0.2); }
.output-hero-label { display: block; font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
.output-hero-value { font-weight: 900; color: #0f172a; line-height: 1.2; margin-bottom: 0.5rem; }
.output-hero-unit { font-size: 1rem; color: #64748b; font-weight: 500; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\fibonacci-sequence-calculator.blade.php ENDPATH**/ ?>