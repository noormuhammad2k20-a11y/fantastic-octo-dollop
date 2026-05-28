<div class="tool-interactive-container">
    <div class="card border-0 shadow-sm overflow-hidden bg-white" style="border-radius: var(--radius-lg);">
        <div class="bg-light p-2 d-flex justify-content-center border-bottom">
            <ul class="nav nav-pills custom-pill-tabs" id="ltvTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold px-4" id="ltv-calc-tab" data-bs-toggle="pill" data-bs-target="#ltv-pills-calc" type="button" role="tab">
                        <i class="fas fa-calculator me-2"></i> Calculator
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold px-4" id="ltv-chart-tab" data-bs-toggle="pill" data-bs-target="#ltv-pills-chart" type="button" role="tab">
                        <i class="fas fa-tachometer-alt me-2"></i> Risk Chart
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold px-4" id="ltv-table-tab" data-bs-toggle="pill" data-bs-target="#ltv-pills-table" type="button" role="tab">
                        <i class="fas fa-question-circle me-2"></i> Details
                    </button>
                </li>
            </ul>
        </div>

        <div class="tab-content p-4" id="ltvTabsContent">
            <!-- Calculator Tab -->
            <div class="tab-pane fade show active" id="ltv-pills-calc" role="tabpanel">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-uppercase text-muted">Loan Amount ($)</label>
                            <input type="number" id="ltv-loan" class="form-control border-2 fw-black" value="200000" step="1000">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-uppercase text-muted">Asset Value / Appraised Price ($)</label>
                            <input type="number" id="ltv-value" class="form-control border-2 fw-black" value="250000" step="1000">
                        </div>

                        <div class="p-3 rounded-4 bg-light border border-dashed">
                            <h6 class="fw-bold small mb-2"><i class="fas fa-shield-alt text-primary me-1"></i> Lending Benchmark</h6>
                            <p class="small text-muted mb-0">Lenders typically prefer an <strong>LTV of 80% or lower</strong> to offer the best interest rates and avoid PMI.</p>
                        </div>
                    </div>

                    <div class="col-lg-5 text-center">
                        <div class="card border-0 bg-accent-soft p-4 h-100 vstack justify-content-center shadow-xs" style="border-radius: 16px;">
                            <p class="text-muted small text-uppercase fw-bold mb-1">Loan-to-Value Ratio</p>
                            <div id="res-ltv-val" class="fw-black text-accent mb-0" style="font-size: 3.5rem; letter-spacing: -2px;">80.0%</div>
                            <span id="res-ltv-status" class="badge rounded-pill bg-success px-3 py-2 fw-bold mb-4 align-self-center mt-2">Low Risk</span>
                            
                            <hr class="my-3 border-accent-soft">
                            
                            <div class="vstack gap-2 text-start px-2">
                                <div class="d-flex justify-content-between small fw-bold">
                                    <span class="text-muted">Equity Amount:</span>
                                    <span id="res-ltv-equity" class="text-dark">$50,000</span>
                                </div>
                                <div class="d-flex justify-content-between small fw-bold">
                                    <span class="text-muted">Equity %:</span>
                                    <span id="res-ltv-equity-perc" class="text-dark">20%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Tab -->
            <div class="tab-pane fade" id="ltv-pills-chart" role="tabpanel">
                <div class="py-4 text-center">
                    <h6 class="fw-bold text-muted small text-uppercase mb-4">LTV Risk visualization</h6>
                    <div class="progress rounded-pill shadow-sm bg-white border mx-auto" style="height: 25px; max-width: 500px; padding: 4px;">
                        <div id="ltv-bar-loan" class="progress-bar bg-primary rounded-pill me-1" role="progressbar" style="width: 80%;"></div>
                        <div id="ltv-bar-equity" class="progress-bar bg-success rounded-pill" role="progressbar" style="width: 20%;"></div>
                    </div>
                    <div class="d-flex justify-content-center gap-4 mt-3 small fw-bold">
                        <span class="text-primary"><i class="fas fa-circle me-1 small"></i> Loan (Debt)</span>
                        <span class="text-success"><i class="fas fa-circle me-1 small"></i> Equity (Yours)</span>
                    </div>
                    
                    <div class="mt-4 vstack gap-2 max-width-auto" style="max-width: 400px; margin: 0 auto;">
                        <div class="d-flex justify-content-between p-2 rounded-3 bg-light border">
                            <span class="small fw-bold">LTV < 80%</span>
                            <span class="badge bg-success">Low Risk</span>
                        </div>
                         <div class="d-flex justify-content-between p-2 rounded-3 bg-light border">
                            <span class="small fw-bold">LTV 80-95%</span>
                            <span class="badge bg-warning text-dark">Medium Risk</span>
                        </div>
                         <div class="d-flex justify-content-between p-2 rounded-3 bg-light border">
                            <span class="small fw-bold">LTV > 95%</span>
                            <span class="badge bg-danger">High Risk</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Details Tab -->
            <div class="tab-pane fade" id="ltv-pills-table" role="tabpanel">
                <div class="p-3 bg-light rounded-4">
                    <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-1"></i> Calculation Details</h6>
                    <p class="small text-muted">
                        <strong>The LTV Ratio</strong> is calculated by dividing the loan amount by the appraised value of the asset.
                    </p>
                    <div class="bg-white p-3 rounded-3 border mb-3 text-center">
                        <code class="h5 text-dark fw-bold">LTV = Loan / Value × 100</code>
                    </div>
                    <p class="small text-muted mb-0">
                        For example, a **$200,000** loan on a **$250,000** house results in an **80% LTV**. If the house value drops to **$190,000**, your LTV becomes **105%**, meaning you are "underwater" on the loan.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="bg-light p-3 d-flex justify-content-between align-items-center border-top">
            <span class="small text-muted fw-bold"><i class="fas fa-balance-scale text-accent me-1"></i> Balance your debt and equity today.</span>
            <button class="btn btn-sm btn-outline-secondary rounded-pill px-4 shadow-sm fw-bold" onclick="window.print()">
                <i class="fas fa-print me-1"></i> Export LTV Profile
            </button>
        </div>
    </div>
</div>

<style>
    .bg-accent-soft { background-color: rgba(255, 106, 0, 0.05); }
    .text-accent { color: #FF6A00 !important; }
    .fw-black { font-weight: 900; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loanInput = document.getElementById('ltv-loan');
    const valueInput = document.getElementById('ltv-value');

    [loanInput, valueInput].forEach(el => {
        el.addEventListener('input', calculate);
    });

    function calculate() {
        const loan = parseFloat(loanInput.value) || 0;
        const value = parseFloat(valueInput.value) || 0;

        if (value === 0) return;

        const ltv = (loan / value) * 100;
        const equity = value - loan;
        const equityPerc = 100 - ltv;

        // Update UI
        document.getElementById('res-ltv-val').innerText = ltv.toFixed(1) + '%';
        document.getElementById('res-ltv-equity').innerText = '$' + Math.max(0, Math.round(equity)).toLocaleString();
        document.getElementById('res-ltv-equity-perc').innerText = Math.max(0, equityPerc.toFixed(1)) + '%';
        
        const statusEl = document.getElementById('res-ltv-status');
        if (ltv <= 80) {
            statusEl.innerText = 'Low Risk';
            statusEl.className = 'badge rounded-pill px-3 py-2 fw-bold mb-4 align-self-center mt-2 bg-success';
        } else if (ltv <= 95) {
            statusEl.innerText = 'Medium Risk';
            statusEl.className = 'badge rounded-pill px-3 py-2 fw-bold mb-4 align-self-center mt-2 bg-warning text-dark';
        } else {
            statusEl.innerText = 'High Risk';
            statusEl.className = 'badge rounded-pill px-3 py-2 fw-bold mb-4 align-self-center mt-2 bg-danger';
        }

        // Charts
        const loanRatio = Math.min(100, ltv);
        document.getElementById('ltv-bar-loan').style.width = loanRatio + '%';
        document.getElementById('ltv-bar-equity').style.width = (100 - loanRatio) + '%';
    }

    calculate();
});
</script>
