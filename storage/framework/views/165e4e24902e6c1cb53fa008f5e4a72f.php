<div class="row g-4 square-list-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Start From</label>
                        <input type="number" id="start-in" class="form-control form-control-lg" value="1" min="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Count (n)</label>
                        <input type="number" id="count-in" class="form-control form-control-lg" value="25" min="1" max="1000">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill sq-quick" data-count="20">First 20</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill sq-quick" data-count="100">First 100</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill sq-quick" data-count="500">First 500</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:45;--tool-color:#a16207;--tool-bg:rgba(234,179,8,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Last Square</span>
                <div class="output-hero-value" id="out-last">625</div>
                <div class="mt-2 text-muted fw-bold" id="out-meta">Range: 1² to 25²</div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-th me-2 text-warning"></i>Square Sequence Table</h6>
            <div class="table-responsive bg-white border rounded-3 p-2">
                <table class="table table-sm table-hover mb-0 text-center small">
                    <thead class="table-light"><tr><th>n</th><th>n² (Square)</th><th>Difference</th></tr></thead>
                    <tbody id="out-table"></tbody>
                </table>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy List (CSV)</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const startIn = document.getElementById('start-in');
    const countIn = document.getElementById('count-in');
    const outLast = document.getElementById('out-last');
    const outMeta = document.getElementById('out-meta');
    const outTable = document.getElementById('out-table');

    function calculate(){
        const start = parseInt(startIn.value);
        const count = parseInt(countIn.value);

        if(isNaN(start) || isNaN(count) || count < 1) return;

        let tableHTML = "";
        let prevSquare = Math.pow(start - 1, 2);
        let lastVal = 0;
        const end = start + count - 1;

        for(let i=start; i<=end; i++){
            const sq = i * i;
            lastVal = sq;
            const diff = sq - prevSquare;
            tableHTML += `<tr><td>${i}</td><td class="fw-bold text-primary">${sq.toLocaleString()}</td><td class="text-muted small">+${diff.toLocaleString()}</td></tr>`;
            prevSquare = sq;
        }

        outLast.textContent = lastVal.toLocaleString();
        outMeta.textContent = `Range: ${start}² to ${end}²`;
        outTable.innerHTML = tableHTML;
    }

    [startIn, countIn].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.sq-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            startIn.value = 1;
            countIn.value = btn.dataset.count;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        const items = Array.from(outTable.querySelectorAll('tr')).map(tr => tr.cells[1].innerText.replace(/,/g, ''));
        navigator.clipboard.writeText(items.join(', '));
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.square-list-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.square-list-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.square-list-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.square-list-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.square-list-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.square-list-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.square-list-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.square-list-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.square-list-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.square-list-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

@media (max-width: 768px) {
    .square-list-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\square-numbers-list.blade.php ENDPATH**/ ?>