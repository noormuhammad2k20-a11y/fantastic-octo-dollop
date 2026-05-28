<div class="row g-4 magic-square-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Square Order (n × n)</label>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary active flex-grow-1 py-3 order-btn" data-val="3">3 × 3</button>
                        <button class="btn btn-outline-primary flex-grow-1 py-3 order-btn" data-val="5">5 × 5</button>
                        <button class="btn btn-outline-primary flex-grow-1 py-3 order-btn" data-val="7">7 × 7</button>
                        <button class="btn btn-outline-primary flex-grow-1 py-3 order-btn" data-val="9">9 × 9</button>
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-primary me-1"></i> <strong>Magic Constant:</strong> M = n(n² + 1) / 2. For 3x3, the sum is always 15.
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Magic Constant</span>
                <div class="output-hero-value" id="out-constant">15</div>
                <div class="mt-2 text-muted fw-bold" id="out-meta">Order: 3 × 3</div>
            </div>

            <div class="mt-4">
                <div class="table-responsive">
                    <table class="table table-bordered text-center fw-bold fs-4 bg-white shadow-sm mx-auto" id="out-grid" style="width: auto;">
                        
                    </table>
                </div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Square Matrix</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    let order = 3;
    const outConst = document.getElementById('out-constant');
    const outMeta = document.getElementById('out-meta');
    const outGrid = document.getElementById('out-grid');

    function generateMagicSquare(n){
        let square = Array(n).fill().map(() => Array(n).fill(0));
        let i = 0;
        let j = Math.floor(n / 2);

        for(let num=1; num <= n*n; num++){
            square[i][j] = num;
            let ni = (i - 1 + n) % n;
            let nj = (j + 1) % n;

            if(square[ni][nj] !== 0){
                i = (i + 1) % n;
            } else {
                i = ni;
                j = nj;
            }
        }
        return square;
    }

    function calculate(){
        const n = order;
        const magicConstant = (n * (n * n + 1)) / 2;
        outConst.textContent = magicConstant;
        outMeta.textContent = `Order: ${n} × ${n}`;

        const matrix = generateMagicSquare(n);
        let html = "";
        matrix.forEach(row => {
            html += "<tr>";
            row.forEach(cell => {
                html += `<td style="width: 60px; height: 60px; vertical-align: middle; color:#7c3aed;">${cell}</td>`;
            });
            html += "</tr>";
        });
        outGrid.innerHTML = html;
    }

    document.querySelectorAll('.order-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.order-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            order = parseInt(btn.dataset.val);
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        const matrix = Array.from(outGrid.querySelectorAll('tr')).map(tr => 
            Array.from(tr.querySelectorAll('td')).map(td => td.innerText).join('\t')
        ).join('\n');
        navigator.clipboard.writeText(matrix);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.magic-square-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.magic-square-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.magic-square-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.magic-square-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.magic-square-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.magic-square-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.magic-square-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.magic-square-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.magic-square-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.magic-square-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

@media (max-width: 768px) {
    .magic-square-rebuilt .output-hero-value { font-size: 2.5rem; }
    .magic-square-rebuilt td { width: 40px !important; height: 40px !important; font-size: 1rem !important; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\magic-square-generator.blade.php ENDPATH**/ ?>