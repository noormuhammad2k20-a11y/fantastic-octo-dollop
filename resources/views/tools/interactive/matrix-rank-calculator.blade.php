<div class="row g-4 rank-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-12">
                        <label class="form-label-custom">Rows</label>
                        <select id="m-rows" class="form-select form-select-lg rounded-3">
                            <option value="2">2 Rows</option>
                            <option value="3" selected>3 Rows</option>
                            <option value="4">4 Rows</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Cols</label>
                        <select id="m-cols" class="form-select form-select-lg rounded-3">
                            <option value="2">2 Cols</option>
                            <option value="3" selected>3 Cols</option>
                            <option value="4">4 Cols</option>
                        </select>
                    </div>
                </div>

                <div id="matrix-input-grid" class="d-flex flex-column gap-1 mb-4 align-items-center"></div>

                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Actions</label>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-success w-100 rounded-3" id="random-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-dice me-2"></i>Random</button>
                            <button class="btn btn-outline-danger w-100 rounded-3" id="clear-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-trash me-2"></i>Clear</button>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Precision</label>
                        <select id="precision-sel" class="form-select form-select-lg rounded-3">
                            <option value="2">2 Decimals</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:150;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Matrix Rank</span>
                <div class="output-hero-value" id="out-rank">0</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-layer-group me-2 text-primary"></i>Row Echelon Form (REF)</h6>
                <div id="out-ref" class="d-flex flex-column gap-1 align-items-center bg-white p-3 rounded-3 border"></div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Explanation</h6>
                <div class="bg-white p-4 rounded-4 border shadow-sm small text-secondary" id="math-steps">
                    The rank is the number of non-zero rows in the Row Echelon Form.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function createGrid() {
        const rows = parseInt($('m-rows').value);
        const cols = parseInt($('m-cols').value);
        const grid = $('matrix-input-grid');
        grid.innerHTML = '';
        for (let i = 0; i < rows; i++) {
            const rDiv = document.createElement('div');
            rDiv.className = 'd-flex gap-1';
            for (let j = 0; j < cols; j++) {
                const input = document.createElement('input');
                input.type = 'number';
                input.className = 'form-control matrix-cell text-center';
                input.value = '0';
                input.dataset.row = i;
                input.dataset.col = j;
                input.style.width = '55px';
                input.addEventListener('input', calculate);
                rDiv.appendChild(input);
            }
            grid.appendChild(rDiv);
        }
        calculate();
    }

    function calculate() {
        const rows = parseInt($('m-rows').value);
        const cols = parseInt($('m-cols').value);
        let A = [];
        for (let i = 0; i < rows; i++) {
            A[i] = [];
            for (let j = 0; j < cols; j++) {
                const el = document.querySelector(`.matrix-cell[data-row="${i}"][data-col="${j}"]`);
                A[i][j] = parseFloat(el.value) || 0;
            }
        }

        let rank = 0;
        let mat = JSON.parse(JSON.stringify(A));
        let pivotRow = 0;
        for (let j = 0; j < cols && pivotRow < rows; j++) {
            let maxRow = pivotRow;
            for (let i = pivotRow + 1; i < rows; i++) {
                if (Math.abs(mat[i][j]) > Math.abs(mat[maxRow][j])) maxRow = i;
            }

            if (Math.abs(mat[maxRow][j]) > 1e-9) {
                // Swap
                [mat[pivotRow], mat[maxRow]] = [mat[maxRow], mat[pivotRow]];
                // Elimination
                for (let i = pivotRow + 1; i < rows; i++) {
                    const factor = mat[i][j] / mat[pivotRow][j];
                    for (let k = j; k < cols; k++) {
                        mat[i][k] -= factor * mat[pivotRow][k];
                    }
                }
                pivotRow++;
                rank++;
            }
        }

        $('out-rank').textContent = rank;
        const refOut = $('out-ref');
        refOut.innerHTML = '';
        mat.forEach(row => {
            const rDiv = document.createElement('div');
            rDiv.className = 'd-flex gap-1';
            row.forEach(v => {
                const s = document.createElement('span');
                s.className = 'badge bg-light text-dark border p-2';
                s.style.minWidth = '50px';
                s.textContent = parseFloat(v.toFixed(2));
                rDiv.appendChild(s);
            });
            refOut.appendChild(rDiv);
        });
    }

    $('m-rows').addEventListener('change', createGrid);
    $('m-cols').addEventListener('change', createGrid);
    $('random-btn').addEventListener('click', () => {
        document.querySelectorAll('.matrix-cell').forEach(c => c.value = Math.floor(Math.random() * 10));
        calculate();
    });
    $('clear-btn').addEventListener('click', () => {
        document.querySelectorAll('.matrix-cell').forEach(c => c.value = '0');
        calculate();
    });

    createGrid();
});
</script>

<style>
.rank-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.rank-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.rank-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.rank-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.rank-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.rank-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

