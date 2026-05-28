<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                <div class="col-md-12">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Conversion Parameters</h6>
                        <div class="row g-3 align-items-end">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Acres (ac)</label>
                                <input type="number" id="input-val" class="form-control form-control-lg rounded-3" value="1" step="any" min="0">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Decimal Precision</label>
                                <select id="precision-val" class="form-select form-select-lg rounded-3">
                                    <option value="0">0 Decimal Places</option>
                                    <option value="2">2 Decimal Places</option>
                                    <option value="4" selected>4 Decimal Places</option>
                                    <option value="6">6 Decimal Places</option>
                                    <option value="8">8 Decimal Places</option>
                                    <option value="10">10 Decimal Places</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mt-4 d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-val" data-val="1">1 ac</button>
                            <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-val" data-val="5">5 ac</button>
                            <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-val" data-val="10">10 ac</button>
                            <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-val" data-val="50">50 ac</button>
                            <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-val" data-val="100">100 ac</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-calculator me-2"></i> Convert Now
                </button>
                <a href="/hectares-to-acres-converter" class="btn btn-outline-secondary btn-lg rounded-pill px-4 shadow-sm transition-all ms-2" title="Swap Units"><i class="fas fa-exchange-alt"></i></a>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Conversion Result</h5>
                        <p class="text-muted small mb-0">High-precision calculation output</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 120px;">
                        <i class="fas fa-copy me-1"></i> Copy
                    </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-12 text-center">
                    <div class="p-4 rounded-4 bg-light border">
                        <div class="display-4 fw-bold text-primary mb-2" id="out-result">0.0000</div>
                        <p class="text-muted fw-bold text-uppercase small letter-spacing-1 mb-0">Hectares (ha)</p>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }

    .tool-card-stacked { border-radius: 24px; background: #fff; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-control-lg, .form-select-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.1rem; padding: 0.75rem 1rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }
    
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    
    .mjx-chtml { margin: 0 !important; }
</style>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputE = document.getElementById('input-val');
    const precisionE = document.getElementById('precision-val');
    
    const resultCard = document.getElementById('result-card');
    const outResult = document.getElementById('out-result');
    
    const btnCalculate = document.getElementById('btn-calculate');

    function escapeHtml(unsafe) {
        return (unsafe || '').toString()
             .replace(/&/g, "&amp;")
             .replace(/</g, "&lt;")
             .replace(/>/g, "&gt;")
             .replace(/"/g, "&quot;")
             .replace(/'/g, "&#039;");
    }

    function calculate() {
        let val = parseFloat(inputE.value);
        if (isNaN(val)) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Converting...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            let res = (function(val) { return (val * 0.40468564224); })(val);
            
            const precision = parseInt(precisionE.value);
            
            // Format result
            let formattedRes = res.toFixed(precision);
            // Remove trailing zeros if after decimal point
            if (formattedRes.includes('.')) {
                formattedRes = formattedRes.replace(/\.?0+$/, '');
            }
            if(formattedRes === '') formattedRes = '0';
            
            outResult.textContent = formattedRes;

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-calculator me-2"></i> Convert Now';
            btnCalculate.disabled = false;
        }, 300);
    }

    btnCalculate.addEventListener('click', calculate);

    document.querySelectorAll('.quick-val').forEach(btn => {
        btn.addEventListener('click', () => {
            inputE.value = btn.dataset.val;
            calculate();
        });
    });

    precisionE.addEventListener('change', () => {
        if(!resultCard.classList.contains('d-none')) {
            calculate();
        }
    });

    document.getElementById('btn-reset').addEventListener('click', () => {
        inputE.value = '1';
        resultCard.classList.add('d-none');
    });

    document.getElementById('btn-copy').addEventListener('click', function() {
        const text = `${inputE.value} ac = ${outResult.textContent} ha\\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>