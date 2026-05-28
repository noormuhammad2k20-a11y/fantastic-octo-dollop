<div class="row g-4 matrix-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <!-- Matrix A -->
                    <div class="col-md-12">
                        <div class="p-3 bg-light rounded-4 border mb-3">
                            <label class="form-label-custom">Matrix A</label>
                            <div class="d-flex gap-2 mb-3">
                                <select id="m1-rows" class="form-select form-select-sm">
                                    <option value="2">2 Rows</option>
                                    <option value="3" selected>3 Rows</option>
                                </select>
                                <select id="m1-cols" class="form-select form-select-sm">
                                    <option value="2">2 Cols</option>
                                    <option value="3" selected>3 Cols</option>
                                </select>
                            </div>
                            <div id="m1-grid" class="d-flex flex-column gap-1 align-items-center"></div>
                        </div>
                    </div>
                    <!-- Matrix B -->
                    <div class="col-md-12">
                        <div class="p-3 bg-light rounded-4 border">
                            <label class="form-label-custom">Matrix B</label>
                            <div class="d-flex gap-2 mb-3">
                                <select id="m2-rows" class="form-select form-select-sm">
                                    <option value="2">2 Rows</option>
                                    <option value="3" selected>3 Rows</option>
                                </select>
                                <select id="m2-cols" class="form-select form-select-sm">
                                    <option value="2">2 Cols</option>
                                    <option value="3" selected>3 Cols</option>
                                </select>
                            </div>
                            <div id="m2-grid" class="d-flex flex-column gap-1 align-items-center"></div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4 g-3 align-items-center">
                    <div class="col-md-12">
                        <label class="form-label-custom">Operation</label>
                        <select id="op-sel" class="form-select form-select-lg rounded-3 border-primary text-primary fw-bold">
                            <option value="add">A + B (Addition)</option>
                            <option value="sub">A - B (Subtraction)</option>
                            <option value="mul">A × B (Multiplication)</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Precision</label>
                        <select id="precision-sel" class="form-select form-select-lg rounded-3">
                            <option value="0">Integers</option>
                            <option value="2">2 Decimals</option>
                        </select>
                    </div>
                    <div class="col-md-12 d-flex gap-2">
                        <button class="btn btn-dark flex-grow-1 py-3 rounded-3" id="swap-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-exchange-alt me-2"></i>Swap A/B</button>
                        <button class="btn btn-outline-danger py-3 rounded-3" id="clear-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:210;--tool-color:#2563eb;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Result Matrix</span>
                <div id="out-matrix" class="d-flex flex-column gap-1 align-items-center mt-3">
                    <!-- Result grid -->
                </div>
            </div>



            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Result Matrix</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function createGrid(target, rows, cols) {
        const grid = $(target);
        grid.innerHTML = '';
        for (let i = 0; i < rows; i++) {
            const rowDiv = document.createElement('div');
            rowDiv.className = 'd-flex gap-1';
            for (let j = 0; j < cols; j++) {
                const input = document.createElement('input');
                input.type = 'number';
                input.className = 'form-control matrix-cell text-center';
                input.value = Math.floor(Math.random() * 5);
                input.dataset.row = i;
                input.dataset.col = j;
                input.style.width = '50px';
                input.addEventListener('input', calculate);
                rowDiv.appendChild(input);
            }
            grid.appendChild(rowDiv);
        }
        calculate();
    }

    function getMatrix(gridId, rows, cols) {
        const matrix = [];
        for (let i = 0; i < rows; i++) {
            matrix[i] = [];
            for (let j = 0; j < cols; j++) {
                const el = $(gridId).querySelector(`[data-row="${i}"][data-col="${j}"]`);
                matrix[i][j] = parseFloat(el.value) || 0;
            }
        }
        return matrix;
    }

    function calculate() {
        const r1 = parseInt($('m1-rows').value), c1 = parseInt($('m1-cols').value);
        const r2 = parseInt($('m2-rows').value), c2 = parseInt($('m2-cols').value);
        const op = $('op-sel').value;
        const p = parseInt($('precision-sel').value);

        const A = getMatrix('m1-grid', r1, c1);
        const B = getMatrix('m2-grid', r2, c2);
        let C = [];

        if ((op === 'add' || op === 'sub') && (r1 !== r2 || c1 !== c2)) {
            $('out-matrix').innerHTML = '<div class="alert alert-warning py-2 small">Matrices must have same dimensions for +/-</div>';
            return;
        }

        if (op === 'mul' && c1 !== r2) {
            $('out-matrix').innerHTML = '<div class="alert alert-warning py-2 small">A columns must match B rows for multiplication</div>';
            return;
        }

        if (op === 'add' || op === 'sub') {
            for (let i = 0; i < r1; i++) {
                C[i] = [];
                for (let j = 0; j < c1; j++) {
                    C[i][j] = op === 'add' ? A[i][j] + B[i][j] : A[i][j] - B[i][j];
                }
            }
        } else if (op === 'mul') {
            for (let i = 0; i < r1; i++) {
                C[i] = [];
                for (let j = 0; j < c2; j++) {
                    let sum = 0;
                    let expr = [];
                    for (let k = 0; k < c1; k++) {
                        let prod = A[i][k] * B[k][j];
                        sum += prod;
                        expr.push(`(${A[i][k]}×${B[k][j]})`);
                    }
                    C[i][j] = sum;
                }
            }
        }

        // Render result
        const out = $('out-matrix');
        out.innerHTML = '';
        C.forEach(row => {
            const rowDiv = document.createElement('div');
            rowDiv.className = 'd-flex gap-1';
            row.forEach(val => {
                const span = document.createElement('span');
                span.className = 'badge bg-white text-dark border p-2 fs-6';
                span.style.minWidth = '50px';
                span.textContent = val.toFixed(p);
                rowDiv.appendChild(span);
            });
            out.appendChild(rowDiv);
        });


    }

    $('m1-rows').addEventListener('change', e => createGrid('m1-grid', e.target.value, $('m1-cols').value));
    $('m1-cols').addEventListener('change', e => createGrid('m1-grid', $('m1-rows').value, e.target.value));
    $('m2-rows').addEventListener('change', e => createGrid('m2-grid', e.target.value, $('m2-cols').value));
    $('m2-cols').addEventListener('change', e => createGrid('m2-grid', $('m2-rows').value, e.target.value));
    $('op-sel').addEventListener('change', calculate);
    $('precision-sel').addEventListener('change', calculate);

    $('swap-btn').addEventListener('click', () => {
        // Simple swap logic placeholder
        alert('Swap feature: Use inputs to manually swap for now.');
    });

    $('clear-btn').addEventListener('click', () => {
        document.querySelectorAll('.matrix-cell').forEach(c => c.value = '0');
        calculate();
    });

    // Init
    createGrid('m1-grid', 3, 3);
    createGrid('m2-grid', 3, 3);
});
</script>

<style>
.matrix-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.matrix-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.matrix-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.matrix-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.matrix-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.matrix-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }
.matrix-cell { font-weight: bold; border-radius: 6px !important; padding: 2px !important; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\matrix-calculator.blade.php ENDPATH**/ ?>