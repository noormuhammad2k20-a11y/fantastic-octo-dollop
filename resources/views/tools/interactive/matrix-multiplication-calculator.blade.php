<div class="row g-4 matrix-multiplication-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3">Matrix A Dimensions</h6>
                        <div class="d-flex gap-2 mb-3">
                            <input type="number" id="mat-a-r" class="form-control text-center" value="2" min="1" max="5">
                            <span class="align-self-center">×</span>
                            <input type="number" id="mat-a-c" class="form-control text-center" value="3" min="1" max="5">
                        </div>
                        <div id="matrix-a-inputs" class="d-grid gap-2"></div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3">Matrix B Dimensions</h6>
                        <div class="d-flex gap-2 mb-3">
                            <input type="number" id="mat-b-r" class="form-control text-center" value="3" readonly>
                            <span class="align-self-center">×</span>
                            <input type="number" id="mat-b-c" class="form-control text-center" value="2" min="1" max="5">
                        </div>
                        <div id="matrix-b-inputs" class="d-grid gap-2"></div>
                    </div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Multiply Matrices
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:140;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Result Matrix (C)</span>
                <div id="result-matrix-display" class="d-flex justify-content-center py-4"></div>
                <span class="output-hero-unit" id="out-dim-summary">2 x 2 Result</span>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Step-by-Step Multiplications</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Resulting Matrix
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function renderMatrix(containerId, r, c) {
        const container = $(containerId);
        container.innerHTML = '';
        container.style.gridTemplateColumns = `repeat(${c}, 1fr)`;
        for (let i = 0; i < r * c; i++) {
            const input = document.createElement('input');
            input.type = 'number';
            input.className = `form-control text-center fw-bold ${containerId}-cell`;
            input.value = Math.floor(Math.random() * 5);
            container.appendChild(input);
        }
    }

    function syncDimensions() {
        const ar = parseInt($('mat-a-r').value);
        const ac = parseInt($('mat-a-c').value);
        const bc = parseInt($('mat-b-c').value);
        $('mat-b-r').value = ac;
        
        renderMatrix('matrix-a-inputs', ar, ac);
        renderMatrix('matrix-b-inputs', ac, bc);
    }

    $('mat-a-r').addEventListener('change', syncDimensions);
    $('mat-a-c').addEventListener('change', syncDimensions);
    $('mat-b-c').addEventListener('change', syncDimensions);

    function calculate() {
        const ar = parseInt($('mat-a-r').value);
        const ac = parseInt($('mat-a-c').value);
        const bc = parseInt($('mat-b-c').value);

        const aCells = document.querySelectorAll('.matrix-a-inputs-cell');
        const bCells = document.querySelectorAll('.matrix-b-inputs-cell');

        const A = [], B = [];
        for (let i = 0; i < ar; i++) {
            A.push([]);
            for (let j = 0; j < ac; j++) A[i].push(parseFloat(aCells[i * ac + j].value) || 0);
        }
        for (let i = 0; i < ac; i++) {
            B.push([]);
            for (let j = 0; j < bc; j++) B[i].push(parseFloat(bCells[i * bc + j].value) || 0);
        }

        const C = Array.from({length: ar}, () => Array(bc).fill(0));
        let stepsHtml = `<div class="table-responsive"><table class="table table-sm"><thead><tr><th>Entry</th><th>Calculation</th><th>Result</th></tr></thead><tbody>`;

        for (let i = 0; i < ar; i++) {
            for (let j = 0; j < bc; j++) {
                let sum = 0;
                let calc = [];
                for (let k = 0; k < ac; k++) {
                    let term = A[i][k] * B[k][j];
                    sum += term;
                    calc.push(`${A[i][k]} &times; ${B[k][j]}`);
                }
                C[i][j] = sum;
                stepsHtml += `<tr><td>C<sub>${i+1},${j+1}</sub></td><td>${calc.join(' + ')}</td><td><b>${sum}</b></td></tr>`;
            }
        }
        stepsHtml += `</tbody></table></div>`;

        let resHtml = `<div class="d-flex flex-column gap-2">`;
        C.forEach(row => {
            resHtml += `<div class="d-flex gap-2">` + row.map(v => `<div class="p-2 border rounded bg-white fw-bold" style="min-width:60px">${v}</div>`).join('') + `</div>`;
        });
        resHtml += `</div>`;

        $('result-matrix-display').innerHTML = resHtml;
        $('out-dim-summary').textContent = `${ar} x ${bc} Resulting Matrix`;
        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', syncDimensions);

    syncDimensions();
});
</script>

<style>
.matrix-multiplication-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.matrix-multiplication-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.matrix-multiplication-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.matrix-multiplication-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.matrix-multiplication-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

.quick-actions-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; }
.btn-primary-action { background: #1e293b; color: #fff; border: none; border-radius: 14px; padding: 1rem; font-weight: 700; transition: all 0.2s; }
.btn-primary-action:hover { background: #0f172a; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.btn-secondary-action { background: #f1f5f9; color: #475569; border: none; border-radius: 14px; padding: 1rem; font-weight: 600; transition: all 0.2s; }

.output-card-themed { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; margin-top: 2rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(16,185,129,0.2); }
</style>

