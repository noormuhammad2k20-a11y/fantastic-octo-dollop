<div class="row g-4 entropy-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Input Mode</label>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-outline-custom active flex-grow-1" data-mode="text">🔤 Text String</button>
                        <button type="button" class="btn btn-outline-custom flex-grow-1" data-mode="probs">📊 Probabilities</button>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label-custom" id="input-label">Enter Text Data</label>
                    <textarea id="entropy-input" class="form-control form-control-lg rounded-3" rows="4" placeholder="Enter message or data here..."></textarea>
                    <div class="form-text mt-2" id="input-hint">Shannon entropy measures the uncertainty or average information in this message.</div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Calculate
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:210;--tool-color:#2563eb;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Shannon Entropy (H)</span>
                <div class="output-hero-value" id="out-entropy">0.0000</div>
                <span class="output-hero-unit">bits per symbol</span>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-md-4">
                    <div class="stat-card p-3 rounded-3 border bg-white">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Unique Symbols</div>
                        <div class="fs-4 fw-bold" id="out-unique">0</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-3 rounded-3 border bg-white">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Total Length</div>
                        <div class="fs-4 fw-bold" id="out-length">0</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-3 rounded-3 border bg-white">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Efficiency</div>
                        <div class="fs-4 fw-bold" id="out-efficiency">0%</div>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-list-ol me-2 text-primary"></i>Symbol Frequencies & Probabilities</h6>
            <div class="table-responsive rounded-3 border">
                <table class="table table-hover mb-0" id="freq-table">
                    <thead class="table-light">
                        <tr>
                            <th>Symbol</th>
                            <th>Count</th>
                            <th>Probability (p)</th>
                            <th>Info (-log₂p)</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Mathematical Breakdown</h6>
                <div class="math-steps small text-secondary" id="math-steps">
                    <!-- Steps will be injected here -->
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Detailed Report
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let currentMode = 'text';

    const modes = {
        text: {
            label: 'Enter Text Data',
            hint: 'Shannon entropy measures the uncertainty or average information in this message.',
            placeholder: 'Enter message or data here...'
        },
        probs: {
            label: 'Enter Probabilities',
            hint: 'Enter comma or space separated probabilities. They must sum to 1.0.',
            placeholder: 'e.g., 0.5, 0.25, 0.25'
        }
    };

    document.querySelectorAll('[data-mode]').forEach(btn => {
        btn.addEventListener('click', () => {
            currentMode = btn.dataset.mode;
            document.querySelectorAll('[data-mode]').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            $('input-label').textContent = modes[currentMode].label;
            $('input-hint').textContent = modes[currentMode].hint;
            $('entropy-input').placeholder = modes[currentMode].placeholder;
            $('output-section').style.display = 'none';
        });
    });

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('entropy-input').value = '';
        $('output-section').style.display = 'none';
    });

    function calculate() {
        const input = $('entropy-input').value.trim();
        if (!input) return;

        let symbols = [];
        let counts = {};
        let total = 0;
        let entropy = 0;
        let results = [];

        if (currentMode === 'text') {
            total = input.length;
            for (let char of input) {
                counts[char] = (counts[char] || 0) + 1;
            }
            for (let char in counts) {
                let p = counts[char] / total;
                let info = -Math.log2(p);
                entropy += p * info;
                results.push({ symbol: char === ' ' ? 'Space' : char, count: counts[char], p, info });
            }
        } else {
            const parts = input.split(/[\s,]+/).map(Number).filter(n => !isNaN(n) && n > 0);
            total = parts.reduce((a, b) => a + b, 0);
            // If total isn't 1, normalize or warn? Information theory usually assumes sum p = 1.
            // We'll normalize to be helpful.
            for (let i = 0; i < parts.length; i++) {
                let p = parts[i] / total;
                let info = -Math.log2(p);
                entropy += p * info;
                results.push({ symbol: `P${i+1}`, count: parts[i], p, info });
            }
            total = results.length; // In prob mode, "length" is number of categories
        }

        // Display results
        $('out-entropy').textContent = entropy.toFixed(4);
        $('out-unique').textContent = results.length;
        $('out-length').textContent = currentMode === 'text' ? input.length : results.length;
        
        const maxH = Math.log2(results.length || 1);
        const efficiency = maxH > 0 ? (entropy / maxH) * 100 : 0;
        $('out-efficiency').textContent = efficiency.toFixed(1) + '%';

        const tbody = $('freq-table').querySelector('tbody');
        tbody.innerHTML = '';
        results.sort((a, b) => b.p - a.p).forEach(r => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><code>${r.symbol}</code></td>
                <td>${r.count}</td>
                <td>${r.p.toFixed(4)}</td>
                <td>${r.info.toFixed(4)} bits</td>
            `;
            tbody.appendChild(tr);
        });

        // Math Steps
        let stepsHtml = `<p>The entropy $H(X)$ is calculated using the formula: $H(X) = - \sum_{i=1}^n p(x_i) \log_2 p(x_i)$</p>`;
        stepsHtml += `<ol class="ps-3 mt-2">`;
        results.forEach(r => {
            stepsHtml += `<li class="mb-1">For symbol <b>${r.symbol}</b>: $p = ${r.p.toFixed(4)}$, contribution $= -(${r.p.toFixed(4)} \times \log_2(${r.p.toFixed(4)})) \approx ${(r.p * r.info).toFixed(4)}$ bits.</li>`;
        });
        stepsHtml += `</ol>`;
        stepsHtml += `<p class="mt-3 fw-bold text-primary">Total Entropy = ${entropy.toFixed(4)} bits per symbol.</p>`;
        $('math-steps').innerHTML = stepsHtml;

        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
        
        // Re-render MathJax if present
        if (window.MathJax) MathJax.typesetPromise([$('math-steps')]);
    }

    $('btn-copy-results').addEventListener('click', function() {
        const text = `Entropy Calculation Report\n------------------------\nTotal Entropy: ${$('out-entropy').textContent} bits/symbol\nUnique Symbols: ${$('out-unique').textContent}\nEfficiency: ${$('out-efficiency').textContent}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

    // Mock PDF/SVG actions

});
</script>

<style>
.entropy-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.entropy-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.entropy-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.entropy-calc-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.entropy-calc-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.entropy-calc-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

.btn-outline-custom { border: 1.5px solid #e2e8f0; color: #64748b; font-weight: 600; border-radius: 14px; padding: 0.8rem 1rem; transition: all 0.2s; font-size: 0.9rem; background: white; }
.btn-outline-custom:hover { background: #f8fafc; border-color: #cbd5e1; color: #1e293b; }
.btn-outline-custom.active { background: #3b82f6; color: #fff; border-color: #3b82f6; box-shadow: 0 4px 15px rgba(59,130,246,0.2); }

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
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(59,130,246,0.2); }
.output-hero-label { display: block; font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
.output-hero-value { font-size: 4rem; font-weight: 900; color: #0f172a; line-height: 1; margin-bottom: 0.5rem; }
.output-hero-unit { font-size: 1rem; color: #64748b; font-weight: 500; }

.stat-card { transition: transform 0.2s; }
.stat-card:hover { transform: translateY(-3px); }
.ls-1 { letter-spacing: 1px; }

.math-steps p { margin-bottom: 0.5rem; }
.math-steps ol li { margin-bottom: 0.5rem; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\entropy-calculator.blade.php ENDPATH**/ ?>