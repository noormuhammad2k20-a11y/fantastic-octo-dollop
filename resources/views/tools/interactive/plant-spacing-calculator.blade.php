<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Bed Dimensions --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Bed Dimensions</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Width (ft)</label>
                                <input type="number" id="area-w" class="form-control form-control-lg rounded-3" value="4" min="0.5" step="0.5">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Length (ft)</label>
                                <input type="number" id="area-l" class="form-control form-control-lg rounded-3" value="8" min="0.5" step="0.5">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Plant Spacing & Pattern --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Plant Specs</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Spacing (inches)</label>
                                <input type="number" id="spacing" class="form-control form-control-lg rounded-3" value="6" min="1" step="0.5">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Layout Pattern</label>
                                <select id="pattern" class="form-select form-select-lg rounded-3">
                                    <option value="grid" selected>Rectangular Grid</option>
                                    <option value="offset">Offset (Hexagonal)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Presets --}}
            <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-w="4" data-l="8" data-s="6" data-p="grid">
                    Raised Bed (4x8, 6" spacing)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-w="10" data-l="20" data-s="12" data-p="offset">
                    Garden Plot (10x20, 12" offset)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-w="1.5" data-l="3" data-s="4" data-p="grid">
                    Window Box (1.5x3, 4" spacing)
                </button>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-success btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="background-color: #137333; border-color: #137333;">
                    <i class="fas fa-leaf me-2"></i> Optimize Layout
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background-color: #e6f4ea; color: #137333;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Planting Geometry Plan</h5>
                        <p class="text-muted small mb-0">Recommended plant totals and space utilization metrics</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="background-color: #137333; border-color: #137333;">
                        <i class="fas fa-copy me-1"></i> Copy Planting Guide
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="display-3 fw-bold mb-1" style="color: #137333;" id="result-total-plants">128</div>
                <p class="text-muted mb-0 fw-bold text-uppercase small letter-spacing-1" id="result-efficiency-label">GRID LAYOUT OPTIMIZED</p>
            </div>

            <div class="row g-4">
                {{-- Stats Grid --}}
                <div class="col-md-4">
                    <div class="p-3 rounded-4 border bg-light text-center">
                        <h6 class="fw-bold small mb-1 text-uppercase text-muted">Total Area</h6>
                        <div class="h3 fw-bold mb-0 text-dark" id="out-area">32 sq ft</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 border bg-light text-center">
                        <h6 class="fw-bold small mb-1 text-uppercase text-muted">Density</h6>
                        <div class="h3 fw-bold mb-0 text-dark" id="out-density">4 plants/sq ft</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 border bg-light text-center">
                        <h6 class="fw-bold small mb-1 text-uppercase text-muted">Layout Grid</h6>
                        <div class="h3 fw-bold mb-0 text-dark" id="out-rc">9 x 17</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }
    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }
    .form-control-lg, .form-select-lg { border: 1.5px solid #cbd5e1; border-radius: 12px; font-size: 1rem; }
    .form-control:focus, .form-select:focus { border-color: #137333; box-shadow: 0 0 0 4px rgba(19, 115, 51, 0.1); outline: none; }
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #f1f5f9 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const areaW = document.getElementById('area-w');
    const areaL = document.getElementById('area-l');
    const spacingIn = document.getElementById('spacing');
    const patternIn = document.getElementById('pattern');
    const resultCard = document.getElementById('result-card');
    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    function calculateSpacing() {
        const w = parseFloat(areaW.value) || 0;
        const l = parseFloat(areaL.value) || 0;
        const s = parseFloat(spacingIn.value) || 1;
        const pattern = patternIn.value;

        if (w <= 0 || l <= 0 || s <= 0) {
            alert("Please enter valid width, length, and plant spacing.");
            return;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Plotting Layout...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            const wIn = w * 12;
            const lIn = l * 12;
            
            let total = 0;
            let rows = 0;
            let cols = 0;

            if(pattern === 'grid') {
                cols = Math.floor(wIn / s) + 1;
                rows = Math.floor(lIn / s) + 1;
                total = rows * cols;
                document.getElementById('result-efficiency-label').textContent = 'LINEAR GRID OPTIMIZED';
                document.getElementById('out-rc').textContent = `${cols} x ${rows}`;
            } else {
                // Hexagonal offset pattern
                const rowHeight = s * 0.866;
                cols = Math.floor(wIn / s) + 1;
                rows = Math.floor(lIn / rowHeight) + 1;
                
                // Estimate density offset
                total = Math.floor((wIn * lIn) / (s * s * 0.866)) || 0;
                document.getElementById('result-efficiency-label').textContent = 'HEXAGONAL OFFSET (MAX DENSITY)';
                document.getElementById('out-rc').textContent = `~${rows} offset rows`;
            }

            const areaSqFt = w * l;
            const density = areaSqFt > 0 ? (total / areaSqFt).toFixed(1) : 0;

            document.getElementById('result-total-plants').textContent = total;
            document.getElementById('out-area').textContent = areaSqFt.toFixed(1) + ' sq ft';
            document.getElementById('out-density').textContent = density + ' plants / sq ft';

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-leaf me-2"></i> Optimize Layout';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculateSpacing);

    btnReset.addEventListener('click', () => {
        areaW.value = 4;
        areaL.value = 8;
        spacingIn.value = 6;
        patternIn.value = 'grid';
        resultCard.classList.add('d-none');
    });

    // Preset buttons
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            areaW.value = this.dataset.w;
            areaL.value = this.dataset.l;
            spacingIn.value = this.dataset.s;
            patternIn.value = this.dataset.p;
            calculateSpacing();
        });
    });

    btnCopy.addEventListener('click', function() {
        const total = document.getElementById('result-total-plants').textContent;
        const eff = document.getElementById('result-efficiency-label').textContent;
        const area = document.getElementById('out-area').textContent;
        const density = document.getElementById('out-density').textContent;
        const rc = document.getElementById('out-rc').textContent;

        const text = `GARDEN PLANTING PLAN SUMMARY\n` +
                     `============================\n` +
                     `Bed Size: ${areaW.value} ft x ${areaL.value} ft (${area})\n` +
                     `Plant Spacing: ${spacingIn.value} inches\n` +
                     `Layout Style: ${patternIn.options[patternIn.selectedIndex].text}\n\n` +
                     `TOTAL PLANTS REQUIRED: ${total}\n` +
                     `Layout Density: ${density}\n` +
                     `Layout Geometry: ${rc}\n` +
                     `Status: ${eff}\n\n` +
                     `Generated via ToolsHub Plant Spacing Calculator.`;

        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied Planting Plan!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
