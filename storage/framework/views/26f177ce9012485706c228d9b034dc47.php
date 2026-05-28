<div class="row g-4 catalan-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Number of Terms (n)</label>
                    <input type="number" id="n-input" class="form-control form-control-lg" value="10" min="0" max="25">
                    <div class="mt-2 text-muted small">
                        Limit is 25 to avoid integer overflow (C₂₅ ≈ 4.8 × 10¹²).
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-primary me-1"></i> <strong>Formula:</strong> Cₙ = (1 / (n+1)) * (2n! / (n! * n!))
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:170;--tool-color:#0d9488;--tool-bg:rgba(20,184,166,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Current Catalan (Cₙ)</span>
                <div class="output-hero-value" id="out-current">16,796</div>
                <div class="mt-2 text-muted fw-bold" id="out-meta">n = 10</div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-list me-2 text-teal"></i>Catalan Sequence</h6>
            <div class="bg-white border rounded-3 p-3">
                <div id="out-list" class="d-flex flex-wrap gap-2">
                    
                </div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Sequence</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const nInput = document.getElementById('n-input');
    const outCurrent = document.getElementById('out-current');
    const outMeta = document.getElementById('out-meta');
    const outList = document.getElementById('out-list');

    function factorial(n){
        let res = BigInt(1);
        for(let i=2; i<=n; i++) res *= BigInt(i);
        return res;
    }

    function calculate(){
        const n = parseInt(nInput.value);
        if(isNaN(n) || n < 0) return;
        
        // Catalan formula: (2n)! / ((n+1)! * n!)
        function getCatalan(idx){
            const top = factorial(2 * idx);
            const bot = factorial(idx + 1) * factorial(idx);
            return top / bot;
        }

        const current = getCatalan(n);
        outCurrent.textContent = current.toLocaleString();
        outMeta.textContent = `n = ${n}`;

        let listHTML = "";
        for(let i=0; i<=n; i++){
            const val = getCatalan(i);
            listHTML += `
                <div class="badge bg-light text-dark border p-2 fw-normal" style="font-size: 0.9rem;">
                    <span class="text-muted small">C<sub>${i}</sub>:</span> <span class="fw-bold text-teal">${val.toLocaleString()}</span>
                </div>
            `;
        }
        outList.innerHTML = listHTML;
    }

    nInput.addEventListener('input', calculate);

    document.getElementById('btn-copy').addEventListener('click', function(){
        const text = Array.from(outList.querySelectorAll('.badge')).map(b => b.innerText).join('\n');
        navigator.clipboard.writeText(text);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.catalan-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.catalan-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.catalan-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.catalan-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.catalan-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.catalan-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.catalan-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.catalan-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.catalan-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.catalan-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; word-break: break-all; }

@media (max-width: 768px) {
    .catalan-rebuilt .output-hero-value { font-size: 2rem; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\catalan-number-generator.blade.php ENDPATH**/ ?>