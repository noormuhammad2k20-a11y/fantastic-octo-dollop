<div class="row g-4 matrix-inverse-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4 text-center">
                    <label class="form-label-custom mb-3">Matrix Dimension</label>
                    <div class="d-flex justify-content-center gap-3">
                        <button class="btn btn-outline-custom active" data-dim="2">2 x 2</button>
                        <button class="btn btn-outline-custom" data-dim="3">3 x 3</button>
                    </div>
                </div>

                <div id="matrix-input-container" class="d-flex justify-content-center mb-4">
                    <!-- Dynamic Input Grid -->
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Find Inverse
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-pdf" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-file-pdf"></i>
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-svg" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-project-diagram"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:210;--tool-color:#2563eb;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Determinant ($|A|$)</span>
                <div class="output-hero-value" id="out-det">0</div>
                <span class="output-hero-unit" id="out-invertible">Non-Singular</span>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm text-center">
                <h6 class="fw-bold mb-4 text-uppercase ls-1">Inverse Matrix ($A^{-1}$)</h6>
                <div id="inverse-display" class="fs-4 font-monospace"></div>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Mathematical Steps</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Inverse Matrix
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let currentDim = 2;

    function renderInputs() {
        const container = $('matrix-input-container');
        container.innerHTML = '';
        const grid = document.createElement('div');
        grid.style.display = 'grid';
        grid.style.gridTemplateColumns = `repeat(${currentDim}, 1fr)`;
        grid.style.gap = '10px';
        grid.style.maxWidth = currentDim === 2 ? '200px' : '300px';

        for (let i = 0; i < currentDim * currentDim; i++) {
            const input = document.createElement('input');
            input.type = 'number';
            input.className = 'form-control text-center fw-bold mat-cell';
            input.value = (i % (currentDim + 1) === 0) ? 1 : 0; // Identity matrix default
            grid.appendChild(input);
        }
        container.appendChild(grid);
    }

    document.querySelectorAll('[data-dim]').forEach(btn => {
        btn.addEventListener('click', () => {
            currentDim = parseInt(btn.dataset.dim);
            document.querySelectorAll('[data-dim]').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            renderInputs();
        });
    });

    function getMatrix() {
        const cells = document.querySelectorAll('.mat-cell');
        const mat = [];
        for (let i = 0; i < currentDim; i++) {
            mat.push([]);
            for (let j = 0; j < currentDim; j++) {
                mat[i].push(parseFloat(cells[i * currentDim + j].value) || 0);
            }
        }
        return mat;
    }

    function determinant(m) {
        if (m.length === 2) return m[0][0] * m[1][1] - m[0][1] * m[1][0];
        return m[0][0] * (m[1][1] * m[2][2] - m[1][2] * m[2][1]) -
               m[0][1] * (m[1][0] * m[2][2] - m[1][2] * m[2][0]) +
               m[0][2] * (m[1][0] * m[2][1] - m[1][1] * m[2][0]);
    }

    function calculate() {
        const A = getMatrix();
        const det = determinant(A);
        
        $('out-det').textContent = det.toFixed(2);
        
        if (Math.abs(det) < 1e-9) {
            $('out-invertible').textContent = 'Singular (Not Invertible)';
            $('inverse-display').innerHTML = '<div class="text-danger">Inverse does not exist for determinant = 0.</div>';
            $('output-section').style.display = 'block';
            return;
        }

        $('out-invertible').textContent = 'Non-Singular (Invertible)';
        let inv;
        if (currentDim === 2) {
            inv = [
                [A[1][1]/det, -A[0][1]/det],
                [-A[1][0]/det, A[0][0]/det]
            ];
        } else {
            // Adjoint for 3x3
            inv = Array.from({length: 3}, () => Array(3).fill(0));
            for (let i = 0; i < 3; i++) {
                for (let j = 0; j < 3; j++) {
                    // Cofactor
                    let minor = [];
                    for (let r = 0; r < 3; r++) {
                        if (r === i) continue;
                        let row = [];
                        for (let c = 0; c < 3; c++) {
                            if (c === j) continue;
                            row.push(A[r][c]);
                        }
                        minor.push(row);
                    }
                    let val = (minor[0][0] * minor[1][1] - minor[0][1] * minor[1][0]);
                    inv[j][i] = ((i + j) % 2 === 0 ? 1 : -1) * val / det; // Transpose and divide
                }
            }
        }

        let invHtml = `<div class="d-flex justify-content-center gap-3">`;
        inv.forEach(row => {
            invHtml += `<div class="d-flex flex-column">` + row.map(v => `<div class="p-2 border m-1 rounded bg-light" style="min-width:60px">${v.toFixed(3)}</div>`).join('') + `</div>`;
        });
        invHtml += `</div>`;
        $('inverse-display').innerHTML = invHtml;

        let stepsHtml = `<p>The inverse is calculated using the adjoint method: $A^{-1} = \\frac{1}{|A|} \\text{adj}(A)$.</p>`;
        stepsHtml += `<p>1. Determinant $|A| = ${det.toFixed(4)}$</p>`;
        stepsHtml += `<p>2. Calculated cofactors and transposed to find adj(A).</p>`;
        stepsHtml += `<p>3. Multiplied by $1/${det.toFixed(4)}$.</p>`;

        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', renderInputs);
    
    renderInputs();
});
</script>

<style>
.matrix-inverse-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.matrix-inverse-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.matrix-inverse-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.matrix-inverse-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.matrix-inverse-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.matrix-inverse-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

.btn-outline-custom { border: 1.5px solid #e2e8f0; color: #64748b; font-weight: 600; border-radius: 14px; padding: 0.8rem 1.5rem; transition: all 0.2s; background: white; }
.btn-outline-custom.active { background: #3b82f6; color: #fff; border-color: #3b82f6; box-shadow: 0 4px 15px rgba(59,130,246,0.2); }

.quick-actions-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 1rem; }
.btn-primary-action { background: #1e293b; color: #fff; border: none; border-radius: 14px; padding: 1rem; font-weight: 700; transition: all 0.2s; }
.btn-primary-action:hover { background: #0f172a; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.btn-secondary-action { background: #f1f5f9; color: #475569; border: none; border-radius: 14px; padding: 1rem; font-weight: 600; transition: all 0.2s; }
.btn-secondary-action:hover { background: #e2e8f0; color: #1e293b; }

.mat-cell { width: 100%; height: 60px; font-size: 1.2rem; border-radius: 12px; }

.output-card-themed { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; margin-top: 2rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(59,130,246,0.2); }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\matrix-inverse-calculator.blade.php ENDPATH**/ ?>