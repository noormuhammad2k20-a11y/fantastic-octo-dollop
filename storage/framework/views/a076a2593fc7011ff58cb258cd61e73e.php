<div class="tool-interactive-container">
    <div class="card border-0 shadow-sm overflow-hidden bg-white" style="border-radius: var(--radius-lg);">
        <div class="bg-light p-2 d-flex justify-content-center border-bottom">
            <ul class="nav nav-pills custom-pill-tabs" id="cacTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold px-4" id="cac-calc-tab" data-bs-toggle="pill" data-bs-target="#cac-pills-calc" type="button" role="tab">
                        <i class="fas fa-calculator me-2"></i> Calculator
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold px-4" id="cac-ratio-tab" data-bs-toggle="pill" data-bs-target="#cac-pills-ratio" type="button" role="tab">
                        <i class="fas fa-balance-scale me-2"></i> LTV:CAC Ratio
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold px-4" id="cac-logic-tab" data-bs-toggle="pill" data-bs-target="#cac-pills-logic" type="button" role="tab">
                        <i class="fas fa-info-circle me-2"></i> Details
                    </button>
                </li>
            </ul>
        </div>

        <div class="tab-content p-4" id="cacTabsContent">
            <!-- Calculator Tab -->
            <div class="tab-pane fade show active" id="cac-pills-calc" role="tabpanel">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-uppercase text-muted">Total Marketing & Sales Cost ($)</label>
                            <input type="number" id="cac-cost" class="form-control border-2 fw-black" value="5000" step="100">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-uppercase text-muted">New Customers Acquired</label>
                            <input type="number" id="cac-customers" class="form-control border-2 fw-black" value="100" step="1">
                        </div>

                        <div class="p-3 rounded-4 bg-light border border-dashed">
                            <h6 class="fw-bold small mb-2"><i class="fas fa-rocket text-accent me-1"></i> Growth Efficiency</h6>
                            <p class="small text-muted mb-0">CAC measures how much you spend to get one customer. Lower is usually better, but it must be balanced with LTV.</p>
                        </div>
                    </div>

                    <div class="col-lg-5 text-center">
                        <div class="card border-0 bg-accent-soft p-4 h-100 vstack justify-content-center shadow-xs" style="border-radius: 16px;">
                            <p class="text-muted small text-uppercase fw-bold mb-1">Cost Per Acquisition</p>
                            <div id="res-cac-val" class="fw-black text-accent mb-0" style="font-size: 3.5rem; letter-spacing: -2px;">$50</div>
                            <span id="res-cac-status" class="badge rounded-pill bg-success px-3 py-2 fw-bold mb-4 align-self-center mt-2">Efficient</span>
                            
                            <hr class="my-3 border-accent-soft">
                            
                            <div class="vstack gap-2 text-start px-2">
                                <div class="d-flex justify-content-between small fw-bold">
                                    <span class="text-muted">Daily Goal (Avg):</span>
                                    <span id="res-cac-daily" class="text-dark">3.33 / day</span>
                                </div>
                                <div class="d-flex justify-content-between small fw-bold">
                                    <span class="text-muted">Total Spend:</span>
                                    <span id="res-cac-spend" class="text-dark">$5,000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ratio Tab -->
            <div class="tab-pane fade" id="cac-pills-ratio" role="tabpanel">
                <div class="py-4 text-center">
                    <h6 class="fw-bold text-muted small text-uppercase mb-4">LTV to CAC Ratio Analysis</h6>
                    <div class="row g-3 justify-content-center mb-4">
                        <div class="col-md-5">
                            <label class="form-label small fw-bold text-muted">Customer Lifetime Value ($)</label>
                            <input type="number" id="cac-ltv" class="form-control border-1 text-center font-monospace" value="150" step="10">
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-center gap-3 mb-4">
                        <div class="text-center p-3 rounded-4 border bg-wash" style="width: 150px;">
                            <small class="text-muted fw-bold d-block">LTV</small>
                            <span id="ratio-ltv-val" class="h5 fw-black text-success">$150</span>
                        </div>
                        <span class="h4 text-muted fw-bold">/</span>
                        <div class="text-center p-3 rounded-4 border bg-wash" style="width: 150px;">
                            <small class="text-muted fw-bold d-block">CAC</small>
                            <span id="ratio-cac-val" class="h5 fw-black text-danger">$50</span>
                        </div>
                        <span class="h4 text-muted fw-bold">=</span>
                        <div class="text-center p-3 rounded-4 bg-accent-soft border border-accent shadow-sm" style="width: 150px;">
                            <small class="text-accent fw-bold d-block text-uppercase">Ratio</small>
                            <span id="ratio-final-val" class="h4 fw-black text-accent">3.0</span>
                        </div>
                    </div>
                    
                    <div class="progress rounded-pill shadow-sm" style="height: 12px; max-width: 500px; margin: 0 auto; background: #eee;">
                        <div id="ratio-bar" class="progress-bar bg-accent" role="progressbar" style="width: 60%;"></div>
                    </div>
                    <p class="small text-muted italic mt-3 px-3">
                        <i class="fas fa-info-circle me-1"></i> A <strong>3:1 ratio</strong> is widely considered the industry benchmark for healthy SaaS growth.
                    </p>
                </div>
            </div>

            <!-- Logic Tab -->
            <div class="tab-pane fade" id="cac-pills-logic" role="tabpanel">
                <div class="p-3 bg-light rounded-4">
                    <h6 class="fw-bold mb-3"><i class="fas fa-brain me-1"></i> Acquisition Logic</h6>
                    <div class="bg-white p-3 rounded-3 border mb-3 text-center">
                        <code class="h5 text-dark fw-bold">CAC = Total Spend / Customers Acquired</code>
                    </div>
                    <ul class="list-unstyled mb-0 vstack gap-2 small">
                         <li class="d-flex gap-2">
                             <i class="fas fa-check-circle text-success mt-1"></i>
                             <span><strong>Spend:</strong> Includes ad budgets, creative costs, and sales team overhead.</span>
                         </li>
                         <li class="d-flex gap-2">
                             <i class="fas fa-check-circle text-success mt-1"></i>
                             <span><strong>Customers:</strong> Only accounts for non-organic customers driven by the spend.</span>
                         </li>
                         <li class="d-flex gap-2">
                             <i class="fas fa-check-circle text-success mt-1"></i>
                             <span><strong>Sustainable Growth:</strong> If CAC exceeds LTV, the business is losing money on every customer.</span>
                         </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="bg-light p-3 d-flex justify-content-between align-items-center border-top">
            <span class="small text-muted fw-bold"><i class="fas fa-chart-line text-accent me-1"></i> Scaling smarter, one customer at a time.</span>
            <button class="btn btn-sm btn-outline-secondary rounded-pill px-4 shadow-sm fw-bold" onclick="window.print()">
                <i class="fas fa-print me-1"></i> Print P&L Summary
            </button>
        </div>
    </div>
</div>

<style>
    .bg-accent-soft { background-color: rgba(255, 106, 0, 0.05); }
    .text-accent { color: #FF6A00 !important; }
    .fw-black { font-weight: 900; }
    .bg-wash { background: #fdfdfd; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const costInput = document.getElementById('cac-cost');
    const customersInput = document.getElementById('cac-customers');
    const ltvInput = document.getElementById('cac-ltv');

    [costInput, customersInput, ltvInput].forEach(el => {
        el.addEventListener('input', calculate);
    });

    function calculate() {
        const cost = parseFloat(costInput.value) || 0;
        const customers = parseFloat(customersInput.value) || 0;
        const ltv = parseFloat(ltvInput.value) || 0;

        if (customers === 0) return;

        const cac = cost / customers;
        const ratio = cac > 0 ? ltv / cac : 0;

        // Update UI
        document.getElementById('res-cac-val').innerText = '$' + Math.round(cac).toLocaleString();
        document.getElementById('res-cac-spend').innerText = '$' + Math.round(cost).toLocaleString();
        document.getElementById('res-cac-daily').innerText = (customers / 30).toFixed(2) + ' / day';
        
        const statusEl = document.getElementById('res-cac-status');
        if (ratio >= 3) {
            statusEl.innerText = 'High Efficiency';
            statusEl.className = 'badge rounded-pill px-3 py-2 fw-bold mb-4 align-self-center mt-2 bg-success';
        } else if (ratio >= 1.5) {
            statusEl.innerText = 'Efficient';
            statusEl.className = 'badge rounded-pill px-3 py-2 fw-bold mb-4 align-self-center mt-2 bg-warning text-dark';
        } else {
            statusEl.innerText = 'Inefficient';
            statusEl.className = 'badge rounded-pill px-3 py-2 fw-bold mb-4 align-self-center mt-2 bg-danger';
        }

        // Ratio Tab Update
        document.getElementById('ratio-ltv-val').innerText = '$' + Math.round(ltv).toLocaleString();
        document.getElementById('ratio-cac-val').innerText = '$' + Math.round(cac).toLocaleString();
        document.getElementById('ratio-final-val').innerText = ratio.toFixed(1);
        
        const barWidth = Math.min(100, (ratio / 5) * 100); // 5.0 is max visual ratio
        document.getElementById('ratio-bar').style.width = barWidth + '%';
        document.getElementById('ratio-bar').className = `progress-bar ${ratio >= 3 ? 'bg-success' : (ratio >= 1.5 ? 'bg-warning' : 'bg-danger')}`;
    }

    calculate();
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\cac-calculator.blade.php ENDPATH**/ ?>