<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Original Gravity (OG)</label>
                        <input type="number" id="og" class="form-control form-control-lg rounded-3" placeholder="e.g. 1.050" step="0.001" min="1.000">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Final Gravity (FG)</label>
                        <input type="number" id="fg" class="form-control form-control-lg rounded-3" placeholder="e.g. 1.010" step="0.001" min="1.000">
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-bolt me-2"></i> Calculate ABV
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
            
            <div class="mt-4 p-3 rounded-4 bg-light border-dashed text-center">
                <span class="small text-muted"><i class="fas fa-info-circle me-1"></i> <strong>Standard Formula:</strong> ABV = (OG - FG) × 131.25</span>
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
                        <h5 class="mb-0 fw-bold text-dark">Brewing Result</h5>
                        <p class="text-muted small mb-0">Analysis of your batch's alcohol content</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Analysis
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 px-4 pb-4 text-center">
            <div class="display-3 fw-bold text-primary mb-2" id="result-abv">0.00%</div>
            <p class="text-muted mb-4 fw-bold text-uppercase small letter-spacing-1">Alcohol By Volume</p>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Attenuation</div>
                        <div class="h3 fw-bold mb-0 text-dark" id="stat-attenuation">0.0%</div>
                        <p class="small text-muted mb-0">Percentage of sugar converted</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Gravity Difference</div>
                        <div class="h3 fw-bold mb-0 text-dark" id="stat-diff">0.000</div>
                        <p class="small text-muted mb-0">Total drop in density</p>
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

    .form-control-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.1rem; padding: 0.75rem 1rem; }
    .form-control:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }

    .transition-all { transition: all 0.2s ease; }
    
    .letter-spacing-1 { letter-spacing: 1px; }
    .border-dashed { border: 1.5px dashed var(--border-color); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ogIn = document.getElementById('og');
    const fgIn = document.getElementById('fg');
    const resultCard = document.getElementById('result-card');
    const resultAbv = document.getElementById('result-abv');
    const statAttenuation = document.getElementById('stat-attenuation');
    const statDiff = document.getElementById('stat-diff');
    const btnCalculate = document.getElementById('btn-calculate');

    function calculateABV() {
        const og = parseFloat(ogIn.value);
        const fg = parseFloat(fgIn.value);

        if (isNaN(og) || isNaN(fg)) {
            alert("Please enter valid Gravity values.");
            return;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Calculating...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            const abv = (og - fg) * 131.25;
            const diff = og - fg;
            const attenuation = og > 1 ? ((og - fg) / (og - 1)) * 100 : 0;

            resultAbv.innerText = abv.toFixed(2) + "%";
            statDiff.innerText = diff.toFixed(3);
            statAttenuation.innerText = attenuation.toFixed(1) + "%";

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-bolt me-2"></i> Calculate ABV';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculateABV);

    document.getElementById('btn-reset').addEventListener('click', () => {
        ogIn.value = '';
        fgIn.value = '';
        resultCard.classList.add('d-none');
    });

    document.getElementById('btn-copy').addEventListener('click', function() {
        const text = `Brewing Analysis:\nOG: ${ogIn.value}\nFG: ${fgIn.value}\nABV: ${resultAbv.innerText}\nAttenuation: ${statAttenuation.innerText}\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied Result!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>

