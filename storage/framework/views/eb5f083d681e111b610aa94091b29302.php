<div class="tool-interactive-container">
    <div class="card border-0 shadow-sm overflow-hidden bg-white" style="border-radius: var(--radius-lg);">
        <!-- Tabs Header -->
        <div class="bg-light p-2 d-flex justify-content-center border-bottom">
            <ul class="nav nav-pills custom-pill-tabs" id="stockTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold px-4" id="stock-calc-tab" data-bs-toggle="pill" data-bs-target="#stock-pills-calc" type="button" role="tab">
                        <i class="fas fa-calculator me-2"></i> Calculator
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold px-4" id="stock-chart-tab" data-bs-toggle="pill" data-bs-target="#stock-pills-chart" type="button" role="tab">
                        <i class="fas fa-chart-bar me-2"></i> Break-even
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold px-4" id="stock-table-tab" data-bs-toggle="pill" data-bs-target="#stock-pills-table" type="button" role="tab">
                        <i class="fas fa-th-list me-2"></i> Holdings
                    </button>
                </li>
            </ul>
        </div>

        <div class="tab-content p-4" id="stockTabsContent">
            <!-- Calculator Tab -->
            <div class="tab-pane fade show active" id="stock-pills-calc" role="tabpanel">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div id="buy-rows">
                            <!-- Rows injected -->
                            <div class="row g-2 mb-3 align-items-end buy-row" data-index="0">
                                <div class="col-6">
                                    <label class="form-label small fw-bold text-muted">1st Purchase Price ($)</label>
                                    <input type="number" class="form-control border-2 fw-bold buy-price" value="150" step="0.01">
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-bold text-muted">Quantity</label>
                                    <input type="number" class="form-control border-2 fw-bold buy-qty" value="10" step="1">
                                </div>
                            </div>
                            <div class="row g-2 mb-3 align-items-end buy-row" data-index="1">
                                <div class="col-6">
                                    <label class="form-label small fw-bold text-muted">2nd Purchase Price ($)</label>
                                    <input type="number" class="form-control border-2 fw-bold buy-price" value="140" step="0.01">
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-bold text-muted">Quantity</label>
                                    <input type="number" class="form-control border-2 fw-bold buy-qty" value="15" step="1">
                                </div>
                            </div>
                        </div>

                        <button id="add-buy-row" class="btn btn-sm btn-outline-accent rounded-pill px-3 fw-bold mt-2">
                            <i class="fas fa-plus me-1"></i> Add Another Buy
                        </button>

                        <div class="mt-4 p-3 rounded-4 bg-light border border-dashed">
                            <label class="form-label small fw-bold text-muted">Current Market Price ($)</label>
                            <input type="number" id="market-price" class="form-control border-1 fw-bold bg-white" value="145" step="0.01">
                            <p class="small text-muted mt-2 mb-0 italic">Enter the current price to see your profit/loss status.</p>
                        </div>
                    </div>

                    <div class="col-lg-5 text-center">
                        <div class="card border-0 bg-accent-soft p-4 h-100 vstack justify-content-center shadow-xs" style="border-radius: 16px;">
                            <p class="text-muted small text-uppercase fw-bold mb-1">Average Purchase Price</p>
                            <div id="res-stock-avg" class="fw-black text-accent mb-0" style="font-size: 3.5rem; letter-spacing: -2px;">$144.0</div>
                            <span id="res-stock-status" class="badge rounded-pill bg-success px-3 py-2 fw-bold mb-4 align-self-center mt-2 d-none">In Profit</span>
                            
                            <hr class="my-3 border-accent-soft">
                            
                            <div class="vstack gap-2 text-start px-2">
                                <div class="d-flex justify-content-between small fw-bold">
                                    <span class="text-muted">Total Units:</span>
                                    <span id="res-stock-qty" class="text-dark">25</span>
                                </div>
                                <div class="d-flex justify-content-between small fw-bold">
                                    <span class="text-muted">Total Invested:</span>
                                    <span id="res-stock-invested">$3,600</span>
                                </div>
                                <div class="d-flex justify-content-between small fw-bold">
                                    <span class="text-muted">Unrealized P&L:</span>
                                    <span id="res-stock-pnl" class="text-success">+$25.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Tab -->
            <div class="tab-pane fade" id="stock-pills-chart" role="tabpanel">
                <div class="py-4 text-center">
                    <h6 class="fw-bold text-muted small text-uppercase mb-4">Break-even Visualization</h6>
                    <div class="d-flex align-items-center justify-content-center mb-4 gap-4">
                        <div class="text-center p-3 rounded-4 border bg-wash" style="width: 140px;">
                            <small class="text-muted fw-bold d-block">AVG COST</small>
                            <span id="chart-avg-val" class="h5 fw-black text-accent">$144</span>
                        </div>
                        <i class="fas fa-arrows-left-right text-muted mx-2"></i>
                        <div class="text-center p-3 rounded-4 border bg-wash" style="width: 140px;">
                            <small class="text-muted fw-bold d-block">MARKET</small>
                            <span id="chart-market-val" class="h5 fw-black text-dark">$145</span>
                        </div>
                    </div>
                    <div class="progress rounded-pill shadow-sm" style="height: 15px; background: #eee;">
                        <div id="stock-p-bar" class="progress-bar bg-success" role="progressbar" style="width: 60%;"></div>
                    </div>
                    <p class="small text-muted italic mt-3 px-3">
                        "Average Price = Total Investment / Total Shares"
                    </p>
                </div>
            </div>

            <!-- Table Tab -->
            <div class="tab-pane fade" id="stock-pills-table" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0">Entry #</th>
                                <th class="border-0 text-end">Price ($)</th>
                                <th class="border-0 text-end">Qty</th>
                                <th class="border-0 text-end pe-4">Subtotal ($)</th>
                            </tr>
                        </thead>
                        <tbody id="stock-table-body" class="small">
                            <!-- Rows injected -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="bg-light p-3 d-flex justify-content-between align-items-center border-top">
            <span class="small text-muted fw-bold"><i class="fas fa-chart-line text-accent me-1"></i> Smarter averaging, better exits.</span>
            <button class="btn btn-sm btn-accent rounded-pill px-4 shadow-sm fw-bold" onclick="window.print()">
                <i class="fas fa-file-pdf me-1"></i> Save holdings
            </button>
        </div>
    </div>
</div>

<style>
    .bg-accent-soft { background-color: rgba(255, 106, 0, 0.05); }
    .btn-outline-accent { border-color: #FF6A00; color: #FF6A00; }
    .btn-outline-accent:hover { background: #FF6A00; color: white; }
    .bg-wash { background: #fdfdfd; }
    
    .buy-row input { transition: border-color 0.2s ease; }
    .buy-row input:focus { border-color: #FF6A00; box-shadow: 0 0 0 0.2rem rgba(255, 106, 0, 0.1); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const buyRows = document.getElementById('buy-rows');
    const addBtn = document.getElementById('add-buy-row');
    const marketInput = document.getElementById('market-price');

    addBtn.addEventListener('click', () => {
        const count = buyRows.querySelectorAll('.buy-row').length + 1;
        const div = document.createElement('div');
        div.className = 'row g-2 mb-3 align-items-end buy-row';
        div.innerHTML = `
            <div class="col-6">
                <label class="form-label small fw-bold text-muted">${count}${getOrdinal(count)} Purchase Price ($)</label>
                <input type="number" class="form-control border-2 fw-bold buy-price" value="0" step="0.01">
            </div>
            <div class="col-6">
                <label class="form-label small fw-bold text-muted">Quantity</label>
                <input type="number" class="form-control border-2 fw-bold buy-qty" value="0" step="1">
            </div>
        `;
        buyRows.appendChild(div);
        attachEvents();
        calculate();
    });

    function getOrdinal(n) {
        let s = ["th", "st", "nd", "rd"], v = n % 100;
        return (s[(v - 20) % 10] || s[v] || s[0]);
    }

    function attachEvents() {
        buyRows.querySelectorAll('input').forEach(el => {
            el.removeEventListener('input', calculate);
            el.addEventListener('input', calculate);
        });
        marketInput.addEventListener('input', calculate);
    }

    function calculate() {
        let totalQty = 0;
        let totalInvested = 0;
        const rowsReport = [];

        buyRows.querySelectorAll('.buy-row').forEach((row, i) => {
            const p = parseFloat(row.querySelector('.buy-price').value) || 0;
            const q = parseFloat(row.querySelector('.buy-qty').value) || 0;
            if (q > 0) {
                totalQty += q;
                totalInvested += (p * q);
                rowsReport.push({ num: i+1, price: p, qty: q, sub: (p * q) });
            }
        });

        const avgPrice = totalQty > 0 ? totalInvested / totalQty : 0;
        const marketPrice = parseFloat(marketInput.value) || 0;
        const pnl = (marketPrice - avgPrice) * totalQty;

        // Update UI
        document.getElementById('res-stock-avg').innerText = '$' + avgPrice.toFixed(2);
        document.getElementById('res-stock-qty').innerText = totalQty;
        document.getElementById('res-stock-invested').innerText = '$' + totalInvested.toLocaleString(undefined, { maximumFractionDigits: 0 });
        
        const pnlEl = document.getElementById('res-stock-pnl');
        pnlEl.innerText = (pnl >= 0 ? '+' : '-') + '$' + Math.abs(pnl).toFixed(2);
        pnlEl.className = pnl >= 0 ? 'text-success' : 'text-danger';

        const statusEl = document.getElementById('res-stock-status');
        if (totalQty > 0) {
            statusEl.classList.remove('d-none');
            statusEl.innerText = pnl >= 0 ? 'In Profit' : 'In Loss';
            statusEl.className = 'badge rounded-pill px-3 py-2 fw-bold mb-4 align-self-center mt-2 ' + (pnl >= 0 ? 'bg-success' : 'bg-danger');
        } else {
            statusEl.classList.add('d-none');
        }

        // Chart/Table
        document.getElementById('chart-avg-val').innerText = '$' + avgPrice.toFixed(2);
        document.getElementById('chart-market-val').innerText = '$' + marketPrice.toFixed(2);
        
        const pBar = document.getElementById('stock-p-bar');
        if (marketPrice > 0) {
            let ratio = (marketPrice / avgPrice) * 100;
            pBar.style.width = Math.min(100, ratio) + '%';
            pBar.className = 'progress-bar ' + (marketPrice >= avgPrice ? 'bg-success' : 'bg-warning');
        }

        updateTable(rowsReport);
    }

    function updateTable(data) {
        const body = document.getElementById('stock-table-body');
        body.innerHTML = data.map(d => `
            <tr>
                <td class="fw-bold">Entry #${d.num}</td>
                <td class="text-end">$${d.price.toFixed(2)}</td>
                <td class="text-end">${d.qty}</td>
                <td class="text-end pe-4 fw-bold">$${d.sub.toLocaleString()}</td>
            </tr>
        `).join('');
    }

    attachEvents();
    calculate();
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\stock-average-calculator.blade.php ENDPATH**/ ?>