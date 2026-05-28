<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-4 mb-4" style="background-color: #fffbeb; border: 1.5px solid #fef3c7;">
                <h6 class="text-warning fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-lightbulb me-2"></i>Common Polyhedra</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-warning btn-sm rounded-pill px-3 eul-preset" data-v="4" data-e="6" data-f="4">Tetrahedron</button>
                    <button type="button" class="btn btn-outline-warning btn-sm rounded-pill px-3 eul-preset" data-v="8" data-e="12" data-f="6">Cube</button>
                    <button type="button" class="btn btn-outline-warning btn-sm rounded-pill px-3 eul-preset" data-v="6" data-e="12" data-f="8">Octahedron</button>
                    <button type="button" class="btn btn-outline-warning btn-sm rounded-pill px-3 eul-preset" data-v="20" data-e="30" data-f="12">Dodecahedron</button>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <label class="form-label-custom">Vertices (V)</label>
                    <input type="number" class="form-control-v2" id="eul-v" value="8">
                </div>
                <div class="col-md-4">
                    <label class="form-label-custom">Edges (E)</label>
                    <input type="number" class="form-control-v2" id="eul-e" value="12">
                </div>
                <div class="col-md-4">
                    <label class="form-label-custom">Faces (F)</label>
                    <input type="number" class="form-control-v2" id="eul-f" value="6">
                </div>
            </div>
        </div>
    </div>

    
    <div class="card tool-card-stacked shadow-sm border-0" id="eul-result-card">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(79,70,229,.1);color:#4f46e5">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-dark">Euler Summary</h5>
                </div>
                <div class="header-actions">
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2" id="eul-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-copy me-1"></i> Copy Steps
                    </button>
                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3" id="eul-pdf" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-file-pdf me-1"></i> Export PDF
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row">
                <div class="col-lg-6">
                    <div class="result-hero p-4 rounded-4 mb-4 text-center" style="background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);">
                        <span class="text-secondary small fw-bold text-uppercase">Characteristic (χ)</span>
                        <div class="display-3 fw-black text-indigo mb-0" style="color:#4f46e5" id="eul-answer">2</div>
                        <div class="text-indigo small fw-bold mt-1" id="eul-status">Convex Polyhedron</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div id="eul-steps-box">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-stream me-2 text-indigo"></i>Verification Logic</h6>
                        <div class="step-item">
                            <span class="step-num">1</span>
                            <div>
                                <div class="fw-bold small">Formula Definition</div>
                                <div class="text-secondary small">V - E + F = χ</div>
                            </div>
                        </div>
                        <div class="step-item">
                            <span class="step-num">2</span>
                            <div>
                                <div class="fw-bold small">Substitute Values</div>
                                <div class="text-secondary small" id="eul-step-sub">8 - 12 + 6 = χ</div>
                            </div>
                        </div>
                        <div class="step-item">
                            <span class="step-num">3</span>
                            <div>
                                <div class="fw-bold small">Final Computation</div>
                                <div class="text-secondary small font-monospace" id="eul-step-final">-4 + 6 = 2</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label-custom { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 0.5rem; display: block; }
    .form-control-v2 { border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 0.6rem 0.75rem; font-size: 1.1rem; color: #1e293b; width: 100%; transition: all 0.2s; font-weight: 600; }
    .form-control-v2:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79,70,229,0.1); outline: none; }
    .step-item { display: flex; align-items: flex-start; margin-bottom: 0.75rem; padding: 0.75rem; background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; }
    .step-num { width: 24px; height: 24px; background: #4f46e5; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 800; margin-right: 0.75rem; flex-shrink: 0; margin-top: 2px; }
    
    @media print {
        .card:not(#eul-result-card), .header-actions, .header-v2, footer, nav, .sidebar { display: none !important; }
        .card#eul-result-card { border: none !important; box-shadow: none !important; margin: 0 !important; width: 100% !important; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const v = parseInt(document.getElementById('eul-v').value) || 0;
        const e = parseInt(document.getElementById('eul-e').value) || 0;
        const f = parseInt(document.getElementById('eul-f').value) || 0;
        
        const chi = v - e + f;
        
        document.getElementById('eul-answer').textContent = chi;
        document.getElementById('eul-step-sub').textContent = `${v} - ${e} + ${f} = χ`;
        document.getElementById('eul-step-final').textContent = `${v - e} + ${f} = ${chi}`;
        
        const statusEl = document.getElementById('eul-status');
        if (chi === 2) {
            statusEl.textContent = "Convex Polyhedron (Euler Characteristic)";
            statusEl.style.color = "#4f46e5";
        } else if (chi === 0) {
            statusEl.textContent = "Torus / Ring Surface";
            statusEl.style.color = "#f59e0b";
        } else {
            statusEl.textContent = "Non-Convex or Complex Topology";
            statusEl.style.color = "#64748b";
        }
    }

    ['eul-v', 'eul-e', 'eul-f'].forEach(id => document.getElementById(id).addEventListener('input', calculate));
    
    document.querySelectorAll('.eul-preset').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('eul-v').value = btn.dataset.v;
            document.getElementById('eul-e').value = btn.dataset.e;
            document.getElementById('eul-f').value = btn.dataset.f;
            calculate();
        });
    });

    document.getElementById('eul-reset').addEventListener('click', () => {
        document.getElementById('eul-v').value = 8;
        document.getElementById('eul-e').value = 12;
        document.getElementById('eul-f').value = 6;
        calculate();
    });

    document.getElementById('eul-copy').addEventListener('click', function() {
        const text = `Euler Characteristic Report\n${'='.repeat(30)}\nV: ${document.getElementById('eul-v').value}, E: ${document.getElementById('eul-e').value}, F: ${document.getElementById('eul-f').value}\nχ = ${document.getElementById('eul-answer').textContent}\n\nGenerated via ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    document.getElementById('eul-pdf').addEventListener('click', () => window.print());

    calculate();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\euler-characteristic-calculator.blade.php ENDPATH**/ ?>