<div class="row g-4 iqr-calc-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Dataset</label>
                    <textarea id="data-input" class="form-control form-control-lg font-monospace" rows="4" placeholder="e.g. 7, 7, 31, 31, 47, 75, 87, 115, 116, 119, 119">7, 7, 31, 31, 47, 75, 87, 115, 116, 119, 119</textarea>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill iqr-quick" data-val="1, 2, 3, 4, 5, 6, 7">Small Set</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill iqr-quick" data-val="10, 20, 30, 40, 50, 60, 70, 80">Even Set</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Interquartile Range (IQR)</span>
                <div class="output-hero-value" id="out-iqr">85</div>
                <div class="mt-2 text-muted fw-bold" id="out-meta">Q3 - Q1</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">1st Quartile (Q1)</span>
                        <span class="stat-card-value" id="out-q1">31</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">2nd Quartile (Q2/Med)</span>
                        <span class="stat-card-value" id="out-q2">75</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">3rd Quartile (Q3)</span>
                        <span class="stat-card-value" id="out-q3">116</span>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-project-diagram me-2 text-pink"></i>Outlier Detection (Tukey's Fences)</h6>
            <div class="bg-white border rounded-3 p-3">
                <div class="row g-2 text-center small">
                    <div class="col-6"><div class="p-2 border rounded bg-light">Lower Fence: <span id="out-lower" class="fw-bold">-96.5</span></div></div>
                    <div class="col-6"><div class="p-2 border rounded bg-light">Upper Fence: <span id="out-upper" class="fw-bold">243.5</span></div></div>
                </div>
                <div class="mt-3 text-muted x-small italic text-center">Values outside these boundaries are potential outliers.</div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Summary</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('data-input');
    const outIqr = document.getElementById('out-iqr');
    const outQ1 = document.getElementById('out-q1');
    const outQ2 = document.getElementById('out-q2');
    const outQ3 = document.getElementById('out-q3');
    const outLower = document.getElementById('out-lower');
    const outUpper = document.getElementById('out-upper');

    function getMedian(arr){
        const n = arr.length;
        if(n === 0) return 0;
        if(n % 2 === 0) return (arr[n/2 - 1] + arr[n/2]) / 2;
        return arr[Math.floor(n/2)];
    }

    function calculate(){
        const val = input.value;
        const numbers = val.split(/[,\s\n]+/).map(n => parseFloat(n.trim())).filter(n => !isNaN(n));

        if(numbers.length < 4){
            reset();
            return;
        }

        const sorted = numbers.sort((a, b) => a - b);
        const n = sorted.length;

        const q2 = getMedian(sorted);
        
        let q1, q3;
        const mid = Math.floor(n / 2);
        if(n % 2 === 0){
            q1 = getMedian(sorted.slice(0, mid));
            q3 = getMedian(sorted.slice(mid));
        } else {
            // Include median in both halves for some methods, but standard is exclude
            q1 = getMedian(sorted.slice(0, mid));
            q3 = getMedian(sorted.slice(mid + 1));
        }

        const iqr = q3 - q1;
        const lower = q1 - 1.5 * iqr;
        const upper = q3 + 1.5 * iqr;

        outIqr.textContent = iqr.toLocaleString(undefined, {maximumFractionDigits: 4});
        outQ1.textContent = q1.toLocaleString(undefined, {maximumFractionDigits: 4});
        outQ2.textContent = q2.toLocaleString(undefined, {maximumFractionDigits: 4});
        outQ3.textContent = q3.toLocaleString(undefined, {maximumFractionDigits: 4});
        outLower.textContent = lower.toLocaleString(undefined, {maximumFractionDigits: 4});
        outUpper.textContent = upper.toLocaleString(undefined, {maximumFractionDigits: 4});
    }

    function reset(){
        [outIqr, outQ1, outQ2, outQ3, outLower, outUpper].forEach(el => el.textContent = '—');
    }

    input.addEventListener('input', calculate);

    document.querySelectorAll('.iqr-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            input.value = btn.dataset.val;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        const text = `IQR Summary\nQ1: ${outQ1.textContent}\nMedian: ${outQ2.textContent}\nQ3: ${outQ3.textContent}\nIQR: ${outIqr.textContent}`;
        navigator.clipboard.writeText(text);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.iqr-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.iqr-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.iqr-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.iqr-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.iqr-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.iqr-calc-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.iqr-calc-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.iqr-calc-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.iqr-calc-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.iqr-calc-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

.iqr-calc-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; text-align: center; }
.iqr-calc-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.iqr-calc-rebuilt .stat-card-value { font-size: 1.15rem; font-weight: 700; color: #1e293b; }

.x-small { font-size: 0.65rem; }
.italic { font-style: italic; }
</style>

