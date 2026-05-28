<div class="row g-4 data-analyzer-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 10px 40px rgba(244, 63, 94, 0.08);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #f43f5e, #be123c); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-arrows-alt-v"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#4c0519; letter-spacing: -0.5px;">Data Set Intelligence</h4>
                    <p class="text-muted small mb-0">Instantly extract range, averages, and statistical extremes from any list of numbers.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="p-4 rounded-4 bg-light border">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Input Data Set</h6>
                            <textarea id="v-input" class="form-control border-0 bg-white shadow-sm rounded-4 p-4" style="min-height: 150px; font-family: 'Inter', sans-serif; font-size: 1.1rem; font-weight: 500;" placeholder="Paste numbers here (e.g. 10, 45.5, 22, -5, 100)"></textarea>
                            <div class="mt-3 d-flex flex-wrap gap-2">
                                <button class="btn btn-sm btn-white border shadow-sm rounded-pill px-3 fw-bold preset-btn" data-list="12, 45, 78, 23, 56, 89, 10, 4, 67">Sample Data</button>
                                <button class="btn btn-sm btn-outline-danger border shadow-sm rounded-pill px-3 fw-bold" id="clear-input" style="min-width: 280px; max-width: 100%;">Clear All</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 345; --tool-color: #f43f5e; --tool-bg: rgba(244, 63, 94, .04);">
            <div class="p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="p-4 rounded-4 bg-white border shadow-sm text-center">
                                    <h6 class="fw-bold small mb-2 uppercase opacity-50">Minimum Value</h6>
                                    <div class="h2 fw-black text-rose" id="out-min">—</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-4 rounded-4 bg-white border shadow-sm text-center border-rose-200">
                                    <h6 class="fw-bold small mb-2 uppercase opacity-50">Maximum Value</h6>
                                    <div class="h2 fw-black text-rose" id="out-max">—</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-4 rounded-4 bg-white border shadow-sm d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fw-bold small mb-0 uppercase opacity-50">Range Coverage</h6>
                                        <div class="h4 fw-black text-dark mb-0" id="out-range">0</div>
                                    </div>
                                    <div class="text-end">
                                        <div class="badge bg-rose-soft text-rose px-3 py-2 rounded-pill fw-bold" id="out-count">0 Elements</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-white border shadow-sm h-100">
                            <h6 class="fw-bold small mb-4 uppercase opacity-50">Statistical Summary</h6>
                            <div class="vstack gap-4">
                                <div class="d-flex justify-content-between align-items-center pb-2 border-bottom">
                                    <span class="fw-bold text-muted">Arithmetic Mean (Avg)</span>
                                    <span class="h5 fw-black text-dark mb-0" id="out-avg">0.00</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center pb-2 border-bottom">
                                    <span class="fw-bold text-muted">Median Value</span>
                                    <span class="h5 fw-black text-dark mb-0" id="out-median">0.00</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-muted">Summation</span>
                                    <span class="h5 fw-black text-dark mb-0" id="out-sum">0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="p-4 bg-white border-top rounded-bottom-5">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button class="btn btn-rose rounded-pill px-4 fw-bold text-white shadow-sm" id="copy-stats" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-copy me-2"></i>Copy Analysis
                        </button>
                        <button class="btn btn-outline-secondary rounded-pill px-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-undo me-2"></i>Reset
                        </button>
                    </div>
                    <div class="text-muted small fw-bold uppercase">
                        Precision: <span class="text-rose">Up to 4 Decimal Places</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('v-input');
    const outMin = document.getElementById('out-min');
    const outMax = document.getElementById('out-max');
    const outRange = document.getElementById('out-range');
    const outCount = document.getElementById('out-count');
    const outAvg = document.getElementById('out-avg');
    const outMedian = document.getElementById('out-median');
    const outSum = document.getElementById('out-sum');

    function analyze() {
        const raw = input.value.split(/[\s,\n]+/).filter(x => x.trim() !== "" && !isNaN(x));
        const nums = raw.map(Number);
        
        if (nums.length === 0) {
            [outMin, outMax, outRange, outAvg, outMedian, outSum].forEach(el => el.textContent = '—');
            outCount.textContent = '0 Elements';
            return;
        }

        const min = Math.min(...nums);
        const max = Math.max(...nums);
        const sum = nums.reduce((a, b) => a + b, 0);
        const avg = sum / nums.length;
        
        const sorted = [...nums].sort((a, b) => a - b);
        const mid = Math.floor(sorted.length / 2);
        const median = sorted.length % 2 !== 0 ? sorted[mid] : (sorted[mid - 1] + sorted[mid]) / 2;

        outMin.textContent = min.toLocaleString();
        outMax.textContent = max.toLocaleString();
        outRange.textContent = (max - min).toLocaleString();
        outCount.textContent = `${nums.length} Elements`;
        outAvg.textContent = avg.toFixed(2).toLocaleString();
        outMedian.textContent = median.toLocaleString();
        outSum.textContent = sum.toLocaleString();
    }

    input.addEventListener('input', analyze);

    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            input.value = btn.dataset.list;
            analyze();
        });
    });

    document.getElementById('clear-input').addEventListener('click', () => {
        input.value = '';
        analyze();
    });

    document.getElementById('reset-calc').addEventListener('click', () => {
        input.value = '';
        analyze();
    });

    document.getElementById('copy-stats').addEventListener('click', function() {
        const text = `Data Analysis Report\nMin: ${outMin.textContent}\nMax: ${outMax.textContent}\nRange: ${outRange.textContent}\nAvg: ${outAvg.textContent}\nMedian: ${outMedian.textContent}\nSum: ${outSum.textContent}`;
        navigator.clipboard.writeText(text).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

    analyze();
});
</script>

<style>
.data-analyzer-rebuilt .form-label-custom { font-size:.7rem; font-weight:900; text-transform:uppercase; letter-spacing:1px; color:#f43f5e; opacity:.7; margin-bottom:8px; display:block; }
.fw-black { font-weight: 900; }
.uppercase { text-transform: uppercase; }
.text-rose { color: #f43f5e !important; }
.bg-rose-soft { background-color: rgba(244, 63, 94, 0.1); }
.border-rose-200 { border-color: #fecdd3 !important; }

.btn-rose { background: #f43f5e; color: #fff; border: none; transition: all 0.3s; }
.btn-rose:hover { background: #e11d48; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(244, 63, 94, 0.3); }

.btn-white { background: #fff; color: #f43f5e; border: 1px solid #fecdd3; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\find-minimum-and-maximum.blade.php ENDPATH**/ ?>