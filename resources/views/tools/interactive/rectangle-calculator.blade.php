<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label-custom">Length (l)</label>
                    <input type="number" step="any" class="form-control-v2" id="rc-l" value="10">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Width (w)</label>
                    <input type="number" step="any" class="form-control-v2" id="rc-w" value="5">
                </div>
                <div class="col-md-6 mt-4">
                    <label class="form-label-custom">Decimal Precision</label>
                    <select class="form-select-v2" id="rc-precision">
                        <option value="2" selected>2 Places</option>
                        <option value="4">4 Places</option>
                        <option value="8">8 Places</option>
                    </select>
                </div>
                <div class="col-12 mt-4">
                    <button class="btn btn-primary rounded-pill px-5 py-2 fw-bold" id="rc-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-bolt me-2"></i> Solve Rectangle
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div class="card tool-card-stacked shadow-sm border-0" id="rc-result-card" style="display: none;">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981">
                        <i class="fas fa-check"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-dark">Geometric Summary</h5>
                </div>
                <div class="header-actions">
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2" id="rc-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-copy me-1"></i> Copy
                    </button>
                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3" id="rc-pdf" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-file-pdf me-1"></i> PDF
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-4 border text-center">
                        <span class="text-secondary small fw-bold text-uppercase d-block mb-1">Area</span>
                        <div class="h3 fw-black text-primary mb-0" id="rc-res-a">50</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-4 border text-center">
                        <span class="text-secondary small fw-bold text-uppercase d-block mb-1">Perimeter</span>
                        <div class="h3 fw-black text-primary mb-0" id="rc-res-p">30</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-4 border text-center">
                        <span class="text-secondary small fw-bold text-uppercase d-block mb-1">Diagonal</span>
                        <div class="h3 fw-black text-primary mb-0" id="rc-res-d">11.18</div>
                    </div>
                </div>
            </div>
            
            <div id="rc-steps-box">
                <h6 class="fw-bold text-dark mb-3"><i class="fas fa-stream me-2 text-primary"></i>Solution Breakdown</h6>
                <div id="rc-steps-content"></div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label-custom { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 0.5rem; display: block; }
    .form-control-v2, .form-select-v2 { border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 0.6rem 0.75rem; font-size: 1.1rem; color: #1e293b; width: 100%; transition: all 0.2s; font-weight: 600; }
    .form-control-v2:focus, .form-select-v2:focus { border-color: #3b82f6; box-shadow: 0 0 0 4px rgba(59,130,246,0.1); outline: none; }
    .step-item { display: flex; align-items: flex-start; margin-bottom: 0.75rem; padding: 0.75rem; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; }
    .step-num { width: 24px; height: 24px; background: #3b82f6; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 800; margin-right: 0.75rem; flex-shrink: 0; margin-top: 2px; }
    @media print {
        .card:not(#rc-result-card), .header-actions, .header-v2, footer, nav, .sidebar { display: none !important; }
        .card#rc-result-card { border: none !important; box-shadow: none !important; margin: 0 !important; width: 100% !important; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const l = parseFloat(document.getElementById('rc-l').value);
        const w = parseFloat(document.getElementById('rc-w').value);
        const prec = parseInt(document.getElementById('rc-precision').value);

        if (isNaN(l) || isNaN(w) || l <= 0 || w <= 0) return;

        const a = l * w;
        const p = 2 * (l + w);
        const d = Math.sqrt(l * l + w * w);

        document.getElementById('rc-res-a').textContent = a.toFixed(prec);
        document.getElementById('rc-res-p').textContent = p.toFixed(prec);
        document.getElementById('rc-res-d').textContent = d.toFixed(prec);
        
        let steps = `
            <div class="step-item"><span class="step-num">1</span><div><strong>Area:</strong> l × w = ${l} × ${w} = ${a.toFixed(prec)}</div></div>
            <div class="step-item"><span class="step-num">2</span><div><strong>Perimeter:</strong> 2(l + w) = 2(${l} + ${w}) = 2(${l+w}) = ${p.toFixed(prec)}</div></div>
            <div class="step-item"><span class="step-num">3</span><div><strong>Diagonal:</strong> √(l² + w²) = √(${l}² + ${w}²) = √(${l*l + w*w}) = ${d.toFixed(prec)}</div></div>
        `;
        document.getElementById('rc-steps-content').innerHTML = steps;
        document.getElementById('rc-result-card').style.display = 'block';
    }

    document.getElementById('rc-calculate').addEventListener('click', calculate);
    document.getElementById('rc-reset').addEventListener('click', () => {
        document.getElementById('rc-l').value = 10;
        document.getElementById('rc-w').value = 5;
        document.getElementById('rc-result-card').style.display = 'none';
    });
    document.getElementById('rc-copy').addEventListener('click', function() {
        navigator.clipboard.writeText(document.getElementById('rc-result-card').innerText);
        this.innerHTML = 'Copied';
        setTimeout(() => this.innerHTML = '<i class="far fa-copy me-1"></i> Copy', 2000);
    });
    document.getElementById('rc-pdf').addEventListener('click', () => window.print());
});
</script>

