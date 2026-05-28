@include('tools.partials.medical-disclaimer')

<div class="row g-4 medical-tool-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="calculator-header p-4 bg-white border-bottom d-flex align-items-center gap-3">
                <div class="tool-icon-circle bg-danger-soft text-danger" style="width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                    <i class="fas fa-shield-virus"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold text-dark">Absolute Neutrophil Count (ANC)</h4>
                    <p class="mb-0 text-muted small">Quantify infection risk in neutropenic patients</p>
                </div>
            </div>

            <div class="calculator-body p-4 bg-white">
                <form id="calculatorForm">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-dark small mb-2">Total WBC Count</label>
                            <div class="input-group input-group-lg">
                                <input type="number" id="wbc" class="form-control fw-bold" placeholder="5000" value="5000" required>
                                <span class="input-group-text bg-light-subtle text-muted small fw-bold">cells/µL</span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold text-dark small mb-2">Neutrophils / Segs</label>
                            <div class="input-group input-group-lg">
                                <input type="number" step="0.1" id="segs" class="form-control fw-bold" placeholder="50" value="50" required>
                                <span class="input-group-text bg-light-subtle text-muted fw-bold">%</span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold text-dark small mb-2">Bands (Immature)</label>
                            <div class="input-group input-group-lg">
                                <input type="number" step="0.1" id="bands" class="form-control fw-bold" placeholder="0" value="0" required>
                                <span class="input-group-text bg-light-subtle text-muted fw-bold">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn d-block mx-auto btn-danger btn-lg rounded-pill fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm">
                            <i class="fas fa-calculator me-2"></i>Calculate ANC
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div id="resultsCard" class="output-card-themed card border-0 shadow-lg rounded-4 overflow-hidden d-none" style="--tool-hue:0;--tool-color:#dc3545;--tool-bg:rgba(220,53,69,.04);">
            <div class="card-body p-0">
                <div class="main-result-hero text-center py-5" style="background: linear-gradient(135deg, rgba(220,53,69,.08) 0%, rgba(220,53,69,.02) 100%);">
                    <span class="text-uppercase tracking-widest text-muted fw-bold small mb-2 d-block">Absolute Neutrophil Count</span>
                    <div class="d-flex justify-content-center align-items-baseline gap-2">
                        <span class="display-1 fw-black text-dark" id="resultValue">--</span>
                        <span class="h2 fw-bold text-danger">cells/µL</span>
                    </div>
                </div>

                <div class="result-details p-4">
                    <div class="row align-items-center mb-4">
                        <div class="col-md-5 text-center border-end-md">
                            <div id="gaugeContainer" class="mb-3">
                                <!-- medical_gauge will render here -->
                            </div>
                        </div>
                        <div class="col-md-7 ps-md-4">
                            <div class="insight-badge mb-3 d-inline-block">
                                <span class="badge rounded-pill px-3 py-2" id="statusBadge">Checking...</span>
                            </div>
                            <h5 class="fw-bold mb-3">Clinical Severity</h5>
                            <p id="interpretationText" class="text-secondary small-lg mb-0 text-start">
                                Neutropenia increases the risk of life-threatening bacterial and fungal infections.
                            </p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <div class="stat-item p-3 border rounded-4 bg-white text-center">
                                <span class="stat-label">Neutrophil %</span>
                                <div class="stat-value text-danger" id="neutroPercent">--</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-item p-3 border rounded-4 bg-white text-center">
                                <span class="stat-label">Risk Category</span>
                                <div class="stat-value small" id="riskLevel">--</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const calc = new ProCalculatorEngine();
    
    const ui = {
        form: document.getElementById('calculatorForm'),
        resultsCard: document.getElementById('resultsCard'),
        gauge: document.getElementById('gaugeContainer'),
        value: document.getElementById('resultValue'),
        badge: document.getElementById('statusBadge'),
        text: document.getElementById('interpretationText'),
        neutroPercent: document.getElementById('neutroPercent'),
        riskLevel: document.getElementById('riskLevel')
    };

    ui.form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const data = {
            wbc: parseFloat(document.getElementById('wbc').value),
            segs: parseFloat(document.getElementById('segs').value),
            bands: parseFloat(document.getElementById('bands').value)
        };

        const result = calc.anc_calculator_calc(data);
        
        ui.resultsCard.classList.remove('d-none');
        ui.resultsCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

        ui.value.textContent = Math.round(result.anc).toLocaleString();
        ui.badge.textContent = result.status;
        ui.badge.className = `badge rounded-pill px-3 py-2 bg-${result.color}-soft text-${result.color}`;
        ui.text.textContent = result.interpretation;
        ui.neutroPercent.textContent = (data.segs + data.bands).toFixed(1) + '%';
        ui.riskLevel.textContent = result.status;

        // Gauge: Reference 0 - 2000+
        ui.gauge.innerHTML = calc.medical_gauge(result.anc, 0, 2000, [
            { threshold: 500, color: '#ef4444' },  // Severe
            { threshold: 1000, color: '#f97316' }, // Moderate
            { threshold: 1500, color: '#f59e0b' }, // Mild
            { threshold: 2000, color: '#10b981' }  // Normal
        ]);
    });
});
</script>

<style>
.bg-primary-soft { background-color: rgba(13, 110, 253, 0.1); }
.bg-success-soft { background-color: rgba(25, 135, 84, 0.1); color: #198754; }
.bg-danger-soft { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; }
.bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); color: #ffc107; }
.medical-tool-rebuilt .display-1 { font-size: 5rem; letter-spacing: -2px; font-weight: 900; }
.medical-tool-rebuilt .fw-black { font-weight: 900; }
.medical-tool-rebuilt .tracking-widest { letter-spacing: 0.2em; }
.medical-tool-rebuilt .stat-item { padding: 1.25rem; background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #f1f5f9; }
.medical-tool-rebuilt .stat-label { font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 0.25rem; display: block; }
.medical-tool-rebuilt .stat-value { font-size: 1.125rem; font-weight: 800; color: #1e293b; }
@media (min-width: 768px) { .border-end-md { border-right: 1px solid #dee2e6; } }
</style>