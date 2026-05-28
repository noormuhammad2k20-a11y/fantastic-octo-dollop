<div class="row g-4 lu-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Matrix Size</label>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-warning active flex-grow-1" data-size="2">2x2</button>
                        <button class="btn btn-outline-warning flex-grow-1" data-size="3">3x3</button>
                        <button class="btn btn-outline-warning flex-grow-1" data-size="4">4x4</button>
                    </div>
                </div>

                <div id="matrix-input-grid" class="d-flex flex-column gap-2 mb-4 align-items-center"></div>

                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Actions</label>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-danger w-100 rounded-3" id="clear-matrix" style="min-width: 280px; max-width: 100%;"><i class="fas fa-trash-alt me-2"></i>Clear</button>
                            <button class="btn btn-outline-secondary w-100 rounded-3" id="random-matrix" style="min-width: 280px; max-width: 100%;"><i class="fas fa-dice me-2"></i>Random</button>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Precision</label>
                        <select id="precision-sel" class="form-select form-select-lg rounded-3">
                            <option value="2">2 Decimal Places</option>
                            <option value="4">4 Decimal Places</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:35;--tool-color:#d97706;--tool-bg:rgba(245,158,11,.04);">
            <div class="row g-4">
                <div class="col-md-12">
                    <div class="output-hero mb-3">
                        <span class="output-hero-label">Lower Matrix (L)</span>
                        <div id="out-l" class="mt-2 d-flex flex-column gap-1 align-items-center"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="output-hero">
                        <span class="output-hero-label">Upper Matrix (U)</span>
                        <div id="out-u" class="mt-2 d-flex flex-column gap-1 align-items-center"></div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-scroll me-2 text-primary"></i>Decomposition Steps</h6>
                <div class="bg-white p-4 rounded-4 border shadow-sm small text-secondary overflow-auto" id="math-steps">
                    Steps...
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Matrices</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let matrixSize = 2;

    function createGrid(size) {
        matrixSize = size;
        const grid = $('matrix-input-grid');
        grid.innerHTML = '';
        for (let i = 0; i < size; i++) {
            const row = document.createElement('div');
            row.className = 'd-flex gap-1';
            for (let j = 0; j < size; j++) {
                const input = document.createElement('input');
                input.type = 'number';
                input.className = 'form-control matrix-cell text-center';
                input.value = (i === j) ? '2' : '1';
                input.dataset.row = i;
                input.dataset.col = j;
                input.style.width = '60px';
                input.addEventListener('input', calculate);
                row.appendChild(input);
            }
            grid.appendChild(row);
        }
        calculate();
    }

    function calculate() {
        const n = matrixSize;
        const A = [];
        for (let i = 0; i < n; i++) {
            A[i] = [];
            for (let j = 0; j < n; j++) {
                const el = document.querySelector(`.matrix-cell[data-row="${i}"][data-col="${j}"]`);
                A[i][j] = parseFloat(el.value) || 0;
            }
        }

        const p = parseInt($('precision-sel').value);
        let L = Array.from({length: n}, () => Array(n).fill(0));
        let U = Array.from({length: n}, () => Array(n).fill(0));
        let steps = [];

        for (let i = 0; i < n; i++) {
            // Upper
            for (let k = i; k < n; k++) {
                let sum = 0;
                for (let j = 0; j < i; j++) sum += (L[i][j] * U[j][k]);
                U[i][k] = A[i][k] - sum;
            }
            // Lower
            for (let k = i; k < n; k++) {
                if (i === k) L[i][i] = 1;
                else {
                    let sum = 0;
                    for (let j = 0; j < i; j++) sum += (L[k][j] * U[j][i]);
                    if (U[i][i] === 0) {
                        $('out-l').innerHTML = '<div class="alert alert-danger">Singular Matrix</div>';
                        return;
                    }
                    L[k][i] = (A[k][i] - sum) / U[i][i];
                }
            }
        }

        function renderMatrix(target, data) {
            const out = $(target);
            out.innerHTML = '';
            data.forEach(row => {
                const rDiv = document.createElement('div');
                rDiv.className = 'd-flex gap-1';
                row.forEach(v => {
                    const s = document.createElement('span');
                    s.className = 'badge bg-white text-dark border p-2';
                    s.style.minWidth = '50px';
                    s.textContent = v.toFixed(p);
                    rDiv.appendChild(s);
                });
                out.appendChild(rDiv);
            });
        }

        renderMatrix('out-l', L);
        renderMatrix('out-u', U);

        steps.push(`Doolittle's algorithm applied: A = LU`);
        steps.push(`L: unit lower triangular, U: upper triangular.`);
        $('math-steps').innerHTML = steps.join('<br>');
    }

    document.querySelectorAll('[data-size]').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('[data-size]').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            createGrid(parseInt(btn.dataset.size));
        });
    });

    $('clear-matrix').addEventListener('click', () => {
        document.querySelectorAll('.matrix-cell').forEach(c => c.value = '0');
        calculate();
    });

    $('random-matrix').addEventListener('click', () => {
        document.querySelectorAll('.matrix-cell').forEach(c => c.value = Math.floor(Math.random() * 10) + 1);
        calculate();
    });

    $('precision-sel').addEventListener('change', calculate);

    createGrid(2);
});
</script>

<style>
.lu-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.lu-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.lu-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.lu-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.lu-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.lu-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }
.btn-outline-warning { border: 1.5px solid #fef3c7; color: #d97706; font-weight: 600; border-radius: 12px; transition: all 0.2s; }
.btn-outline-warning:hover, .btn-outline-warning.active { background: #f59e0b; color: #fff; border-color: #f59e0b; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

