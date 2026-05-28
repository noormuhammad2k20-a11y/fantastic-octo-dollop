<div class="row g-4 trace-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Matrix Size (n x n)</label>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-orange active flex-grow-1" data-size="2">2x2</button>
                        <button class="btn btn-outline-orange flex-grow-1" data-size="3">3x3</button>
                        <button class="btn btn-outline-orange flex-grow-1" data-size="4">4x4</button>
                        <button class="btn btn-outline-orange flex-grow-1" data-size="5">5x5</button>
                    </div>
                </div>

                <div id="matrix-input-grid" class="d-flex flex-column gap-1 mb-4 align-items-center"></div>

                <div class="row g-3">
                    <div class="col-md-12">
                        <button class="btn btn-outline-danger w-100 rounded-3" id="clear-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-trash-alt me-2"></i>Clear Matrix</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:25;--tool-color:#ea580c;--tool-bg:rgba(249,115,22,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Matrix Trace tr(A)</span>
                <div class="output-hero-value" id="out-trace">0</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-calculator me-2 text-primary"></i>Calculation Steps</h6>
                <div class="bg-white p-4 rounded-4 border shadow-sm small text-secondary" id="math-steps">
                    Steps...
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let size = 2;

    function createGrid(n) {
        size = n;
        const grid = $('matrix-input-grid');
        grid.innerHTML = '';
        for (let i = 0; i < n; i++) {
            const rDiv = document.createElement('div');
            rDiv.className = 'd-flex gap-1';
            for (let j = 0; j < n; j++) {
                const input = document.createElement('input');
                input.type = 'number';
                input.className = 'form-control matrix-cell text-center';
                input.value = (i === j) ? Math.floor(Math.random() * 10) : '0';
                input.dataset.row = i;
                input.dataset.col = j;
                input.style.width = '60px';
                input.addEventListener('input', calculate);
                rDiv.appendChild(input);
            }
            grid.appendChild(rDiv);
        }
        calculate();
    }

    function calculate() {
        let sum = 0;
        let elements = [];
        for (let i = 0; i < size; i++) {
            const val = parseFloat(document.querySelector(`.matrix-cell[data-row="${i}"][data-col="${i}"]`).value) || 0;
            sum += val;
            elements.push(`a${i+1}${i+1} (${val})`);
        }

        $('out-trace').textContent = sum;
        $('math-steps').innerHTML = `
            <strong>1. Identify diagonal elements:</strong><br>
            ${elements.join(', ')}<br><br>
            <strong>2. Calculate Sum:</strong><br>
            tr(A) = ${elements.map(e => e.split(' ')[1].replace('(','').replace(')','')).join(' + ')} = <strong>${sum}</strong>
        `;
    }

    document.querySelectorAll('[data-size]').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('[data-size]').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            createGrid(parseInt(btn.dataset.size));
        });
    });

    $('clear-btn').addEventListener('click', () => {
        document.querySelectorAll('.matrix-cell').forEach(c => c.value = '0');
        calculate();
    });

    createGrid(2);
});
</script>

<style>
.trace-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.trace-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.trace-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.trace-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.trace-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.trace-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }
.btn-outline-orange { border: 1.5px solid #ffedd5; color: #ea580c; font-weight: 600; border-radius: 12px; transition: all 0.2s; }
.btn-outline-orange:hover, .btn-outline-orange.active { background: #f97316; color: #fff; border-color: #f97316; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\matrix-trace-calculator.blade.php ENDPATH**/ ?>