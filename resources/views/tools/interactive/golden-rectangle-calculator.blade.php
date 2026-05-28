<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4 align-items-end">
                <div class="col-md-5">
                    <label class="form-label-custom">Width (Short Side)</label>
                    <div class="input-group-v2">
                        <input type="number" step="any" class="form-control-v2" id="gold-width" value="10">
                    </div>
                </div>
                <div class="col-md-2 text-center pb-2">
                    <i class="fas fa-exchange-alt text-muted"></i>
                </div>
                <div class="col-md-5">
                    <label class="form-label-custom">Length (Long Side)</label>
                    <div class="input-group-v2">
                        <input type="number" step="any" class="form-control-v2" id="gold-length" value="16.1803">
                    </div>
                </div>
            </div>
            <div class="mt-4 p-3 rounded-4 bg-light border text-center">
                <div class="text-secondary small fw-bold">Current Ratio: <span id="gold-ratio-display" class="text-primary">1.61803</span></div>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div class="card tool-card-stacked shadow-sm border-0" id="gold-result-card">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(217,119,6,.1);color:#d97706">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-dark">Geometric Properties</h5>
                </div>
                <div class="header-actions">
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2" id="gold-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-copy me-1"></i> Copy
                    </button>
                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3" id="gold-pdf" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-file-pdf me-1"></i> PDF
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="step-item">
                        <span class="step-num">1</span>
                        <div><div class="fw-bold small">Golden Ratio (φ)</div><div class="text-secondary small">φ = (1 + √5) / 2 ≈ 1.61803398875</div></div>
                    </div>
                    <div class="step-item">
                        <span class="step-num">2</span>
                        <div><div class="fw-bold small">Formula</div><div class="text-secondary small" id="gold-formula">Length = Width × φ</div></div>
                    </div>
                    <div class="step-item">
                        <span class="step-num">3</span>
                        <div><div class="fw-bold small">Total Area</div><div class="text-secondary small" id="gold-area">161.8033 units²</div></div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="p-3 bg-white border rounded-4 shadow-sm">
                        <svg viewBox="0 0 162 100" style="max-width: 100%; height: auto;">
                            <rect width="161.8" height="100" fill="rgba(217,119,6,0.05)" stroke="#d97706" stroke-width="1" />
                            <line x1="100" y1="0" x2="100" y2="100" stroke="#d97706" stroke-width="0.5" stroke-dasharray="2,2" />
                            <path d="M 100,100 A 100,100 0 0,1 0,0" fill="none" stroke="#d97706" stroke-width="1.5" />
                            <text x="50" y="55" font-size="8" fill="#d97706" text-anchor="middle">Square</text>
                            <text x="130" y="55" font-size="8" fill="#d97706" text-anchor="middle">Ratio</text>
                        </svg>
                        <div class="mt-2 text-muted small">Golden Rectangle Spiral</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label-custom { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 0.5rem; display: block; }
    .form-control-v2 { border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 0.6rem 0.75rem; font-size: 1.1rem; color: #1e293b; width: 100%; transition: all 0.2s; font-weight: 600; }
    .form-control-v2:focus { border-color: #d97706; box-shadow: 0 0 0 4px rgba(217,119,6,0.1); outline: none; }
    .step-item { display: flex; align-items: flex-start; margin-bottom: 1rem; padding: 0.75rem; background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; }
    .step-num { width: 22px; height: 22px; background: #d97706; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: 800; margin-right: 0.75rem; flex-shrink: 0; margin-top: 2px; }
    
    @media print {
        .card:not(#gold-result-card), .header-actions, .header-v2, footer, nav, .sidebar { display: none !important; }
        .card#gold-result-card { border: none !important; box-shadow: none !important; margin: 0 !important; width: 100% !important; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const PHI = (1 + Math.sqrt(5)) / 2;
    const wInput = document.getElementById('gold-width');
    const lInput = document.getElementById('gold-length');

    function updateFromWidth() {
        const w = parseFloat(wInput.value) || 0;
        const l = w * PHI;
        lInput.value = l.toFixed(5);
        calculate();
    }

    function updateFromLength() {
        const l = parseFloat(lInput.value) || 0;
        const w = l / PHI;
        wInput.value = w.toFixed(5);
        calculate();
    }

    function calculate() {
        const w = parseFloat(wInput.value) || 0;
        const l = parseFloat(lInput.value) || 0;
        const ratio = l / w;
        
        document.getElementById('gold-ratio-display').textContent = ratio.toFixed(5);
        document.getElementById('gold-area').textContent = `${(w * l).toFixed(4)} units²`;
        document.getElementById('gold-formula').textContent = `${l.toFixed(2)} = ${w.toFixed(2)} × 1.618`;
    }

    wInput.addEventListener('input', updateFromWidth);
    lInput.addEventListener('input', updateFromLength);
    
    document.getElementById('gold-reset').addEventListener('click', () => {
        wInput.value = 10;
        updateFromWidth();
    });

    document.getElementById('gold-copy').addEventListener('click', function() {
        const text = `Golden Rectangle Report\n${'='.repeat(30)}\nWidth: ${wInput.value}\nLength: ${lInput.value}\nRatio: ${document.getElementById('gold-ratio-display').textContent}\n\nGenerated via ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    document.getElementById('gold-pdf').addEventListener('click', () => window.print());

    calculate();
});
</script>

