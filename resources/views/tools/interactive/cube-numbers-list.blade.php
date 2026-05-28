<div class="row g-4 cube-list-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
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
                        <input type="number" id="count-in" class="form-control form-control-lg" value="20" min="1" max="500">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill cube-quick" data-count="10">First 10</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill cube-quick" data-count="50">First 50</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill cube-quick" data-count="100">First 100</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:200;--tool-color:#0284c7;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Last Cube in List</span>
                <div class="output-hero-value" id="out-last">8,000</div>
                <div class="mt-2 text-muted fw-bold" id="out-meta">Range: 1³ to 20³</div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-th me-2 text-info"></i>The Cube Sequence</h6>
            <div class="bg-white border rounded-3 p-3 overflow-auto" style="max-height: 400px;">
                <div id="out-grid" class="row g-2">
                    {{-- Dynamic Grid --}}
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-dark flex-grow-1 py-3 fw-bold rounded-3" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy List as CSV</button>
                <button class="btn btn-outline-dark px-4 py-3 fw-bold rounded-3" id="btn-download" style="min-width: 280px; max-width: 100%;"><i class="fas fa-file-download"></i></button>
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
    const outGrid = document.getElementById('out-grid');

    function calculate(){
        const start = parseInt(startIn.value);
        const count = parseInt(countIn.value);

        if(isNaN(start) || isNaN(count) || count < 1) return;

        let gridHTML = "";
        let lastVal = 0;
        const end = start + count - 1;

        for(let i = start; i <= end; i++){
            const cube = Math.pow(i, 3);
            lastVal = cube;
            gridHTML += `
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="p-2 border rounded bg-light text-center h-100">
                        <div class="small text-muted">${i}³</div>
                        <div class="fw-bold text-primary">${cube.toLocaleString()}</div>
                    </div>
                </div>
            `;
        }

        outLast.textContent = lastVal.toLocaleString();
        outMeta.textContent = `Range: ${start}³ to ${end}³`;
        outGrid.innerHTML = gridHTML;
    }

    [startIn, countIn].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.cube-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            startIn.value = 1;
            countIn.value = btn.dataset.count;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        const items = Array.from(outGrid.querySelectorAll('.fw-bold')).map(el => el.innerText.replace(/,/g, ''));
        navigator.clipboard.writeText(items.join(', '));
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    document.getElementById('btn-download').addEventListener('click', function(){
        const items = Array.from(outGrid.querySelectorAll('.fw-bold')).map(el => el.innerText.replace(/,/g, ''));
        const blob = new Blob([items.join('\n')], {type: 'text/plain'});
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `cube-numbers-${startIn.value}-to-${parseInt(startIn.value)+parseInt(countIn.value)-1}.txt`;
        a.click();
    });

    calculate();
});
</script>

<style>
.cube-list-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.cube-list-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.cube-list-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.cube-list-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.cube-list-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.cube-list-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.cube-list-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.cube-list-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.cube-list-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.cube-list-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

@media (max-width: 768px) {
    .cube-list-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

