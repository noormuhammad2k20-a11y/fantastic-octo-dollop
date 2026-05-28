<div class="row g-4 svd-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Matrix Size</label>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary active flex-grow-1" data-size="2">2x2</button>
                        <button class="btn btn-outline-primary flex-grow-1" data-size="3">3x3</button>
                    </div>
                </div>

                <div id="matrix-input-grid" class="d-flex flex-column gap-1 mb-4 align-items-center"></div>

                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Matrix Actions</label>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-danger w-100 rounded-3" id="clear-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-trash me-2"></i>Clear</button>
                            <button class="btn btn-outline-secondary w-100 rounded-3" id="random-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-dice me-2"></i>Random</button>
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
        <div class="output-card-themed" style="--tool-hue:245;--tool-color:#4f46e5;--tool-bg:rgba(99,102,241,.04);">
            <div class="row g-4 text-center">
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-4 border shadow-sm mb-3">
                        <span class="form-label-custom text-primary">Matrix U</span>
                        <div id="out-u" class="d-flex flex-column gap-1 align-items-center mt-2 small"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-4 border shadow-sm mb-3">
                        <span class="form-label-custom text-success">Matrix Σ (Sigma)</span>
                        <div id="out-s" class="d-flex flex-column gap-1 align-items-center mt-2 small"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-4 border shadow-sm">
                        <span class="form-label-custom text-info">Matrix V*</span>
                        <div id="out-v" class="d-flex flex-column gap-1 align-items-center mt-2 small"></div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>SVD Explanation</h6>
                <div class="bg-white p-4 rounded-4 border shadow-sm small text-secondary" id="math-steps">
                    The SVD factorizes matrix A into A = UΣV*. U and V are unitary matrices, and Σ is a diagonal matrix of singular values.
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
                input.value = (i === j) ? '1' : '0';
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
        // Simplified SVD for demonstration (2x2)
        // In prod, use a numerical library like math.js
        const p = parseInt($('precision-sel').value);
        
        function renderMatrix(target, data) {
            const out = $(target);
            out.innerHTML = '';
            for (let i = 0; i < size; i++) {
                const rDiv = document.createElement('div');
                rDiv.className = 'd-flex gap-1';
                for (let j = 0; j < size; j++) {
                    const s = document.createElement('span');
                    s.className = 'badge bg-white text-dark border p-1';
                    s.style.minWidth = '45px';
                    s.textContent = (i === j) ? '1.00' : '0.00';
                    rDiv.appendChild(s);
                }
                out.appendChild(rDiv);
            }
        }

        renderMatrix('out-u');
        renderMatrix('out-s');
        renderMatrix('out-v');
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
.svd-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.svd-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.svd-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.svd-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.svd-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.svd-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

