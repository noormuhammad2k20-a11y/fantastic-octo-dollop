<div class="row g-4 commission-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-purple">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-12 mb-1">
                        <h6 class="fw-bold mb-0 text-uppercase letter-spacing-1 text-muted small"><i class="fas fa-tag text-purple me-2"></i>The Transaction</h6>
                        <hr class="mt-2 mb-0 opacity-10">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Final Sale Price</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="com-price" class="form-control form-control-lg border-start-0 ps-0 text-purple fw-bold" value="500000" step="1000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Commission Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="com-total" class="form-control form-control-lg border-end-0 fw-bold" value="6" step="0.5">
                            <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                        </div>
                    </div>

                    
                    <div class="col-12 mb-1 mt-4">
                        <h6 class="fw-bold mb-0 text-uppercase letter-spacing-1 text-muted small"><i class="fas fa-pie-chart text-purple me-2"></i>Commission Allocations</h6>
                        <hr class="mt-2 mb-0 opacity-10">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom tooltip-label" title="Standard is 50% to Listing, 50% to Buyer">Agent Split (Listing / Buyer)</label>
                        <select id="com-agent-split" class="form-select form-select-lg">
                            <option value="50" selected>50% / 50% (Equal)</option>
                            <option value="60">60% Listing / 40% Buyer</option>
                            <option value="40">40% Listing / 60% Buyer</option>
                            <option value="100">100% Listing (No Buyer Agent)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom tooltip-label" title="How much the agent keeps vs the brokerage">Listing Brokerage Split (%)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted">Agent</span>
                            <input type="number" id="com-broker-split" class="form-control form-control-lg border-start-0 border-end-0 text-center" value="70" step="5">
                            <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Misc Broker/Admin Fees ($)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-minus"></i></span>
                            <input type="number" id="com-fees" class="form-control form-control-lg border-start-0 ps-0" value="295" step="10">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#8b5cf6;--tool-bg:#f5f3ff;">
            
            <div class="row text-center mb-5">
                <div class="col-12">
                    <span class="output-hero-label text-purple">SELLER NET PROCEEDS</span>
                    <h1 class="output-hero-value display-1 text-dark m-0" id="out-seller-net">$0</h1>
                    <p class="text-muted small mt-2 fw-bold mb-0">Sale Price minus Total Commissions</p>
                </div>
            </div>

            <div class="row align-items-center mb-4">
                <div class="col-12 text-center">
                    <div class="split-visualizer mx-auto">
                        <div class="split-bar seller-cut" id="bar-seller" data-bs-toggle="tooltip" title="Seller Note"></div>
                        <div class="split-bar list-cut" id="bar-list" data-bs-toggle="tooltip" title="Listing Side"></div>
                        <div class="split-bar buy-cut" id="bar-buy" data-bs-toggle="tooltip" title="Buyer Side"></div>
                    </div>
                    <div class="d-flex justify-content-center gap-4 mt-3 flex-wrap">
                        <div class="legend-badge seller-badge">Seller: <span id="pct-seller">94</span>%</div>
                        <div class="legend-badge list-badge">Listing Side: <span id="pct-list">3</span>%</div>
                        <div class="legend-badge buy-badge">Buyer Side: <span id="pct-buy">3</span>%</div>
                    </div>
                </div>
            </div>

            <hr class="opacity-10 my-4">

            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="breakdown-card border-list">
                        <div class="bc-header bg-list text-white">
                            <i class="fas fa-home me-2"></i> LISTING SIDE
                        </div>
                        <div class="bc-body">
                            <div class="fs-2 fw-black text-dark text-center mb-3" id="out-list-gross">$0</div>
                            <div class="d-flex justify-content-between small text-muted mb-1">
                                <span>Agent Take-Home:</span> <strong class="text-dark" id="out-list-agent">$0</strong>
                            </div>
                            <div class="d-flex justify-content-between small text-muted mb-1">
                                <span>Brokerage Cut:</span> <strong class="text-dark" id="out-list-broker">$0</strong>
                            </div>
                            <div class="d-flex justify-content-between small text-muted">
                                <span>Flat Fees:</span> <strong class="text-dark" id="out-list-fees">$0</strong>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="breakdown-card border-buy">
                        <div class="bc-header bg-buy text-white">
                            <i class="fas fa-user-tag me-2"></i> BUYER SIDE
                        </div>
                        <div class="bc-body">
                            <div class="fs-2 fw-black text-dark text-center mb-3" id="out-buy-gross">$0</div>
                            <div class="d-flex justify-content-between small text-muted mb-1">
                                <span>Agent Take-Home*:</span> <strong class="text-dark" id="out-buy-agent">$0</strong>
                            </div>
                            <div class="text-center mt-3 small opacity-50 fst-italic">
                                *Assumes identical broker split on buyer side.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="breakdown-card border-total text-center">
                        <div class="bc-header bg-total text-white">
                            <i class="fas fa-money-bill-wave me-2"></i> TOTAL FEES
                        </div>
                        <div class="bc-body d-flex flex-column justify-content-center h-75">
                            <div class="fs-1 fw-black text-total mb-0" id="out-total-fees">$0</div>
                            <div class="small text-muted fw-bold mt-1">Total Commission Paid</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-5 print-hide">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="com-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-purple"></i>Copy Split Report
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Print Breakdown
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const fmtC = val => new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD', maximumFractionDigits: 0}).format(val);
    
    const els = {
        price: $('com-price'), rate: $('com-total'),
        splitA: $('com-agent-split'), splitB: $('com-broker-split'), fees: $('com-fees')
    };

    function calculateComm() {
        const price = parseFloat(els.price.value) || 0;
        const totalRate = parseFloat(els.rate.value) || 0;
        const agentSp = parseFloat(els.splitA.value) || 50;
        const brokSp = parseFloat(els.splitB.value) || 70;
        const flatFee = parseFloat(els.fees.value) || 0;

        // Totals
        const totalComm = price * (totalRate / 100);
        const sellerNet = price - totalComm;

        // Sides
        const listSidePct = agentSp / 100;
        const buySidePct = 1 - listSidePct;

        const listGross = totalComm * listSidePct;
        const buyGross = totalComm * buySidePct;

        // Listing Sub-splits
        const listAgentBase = listGross * (brokSp / 100);
        const listBrokerBase = listGross - listAgentBase;
        
        const listAgentNet = Math.max(0, listAgentBase - flatFee);
        const listBrokerNet = listBrokerBase + flatFee; // Assuming flat fee goes to broker!

        // Buyer Sub-splits
        const buyAgentNet = buyGross * (brokSp / 100); // Assumed identical split

        // Update UI Text
        $('out-seller-net').textContent = fmtC(sellerNet);
        $('out-total-fees').textContent = fmtC(totalComm);

        $('out-list-gross').textContent = fmtC(listGross);
        $('out-list-agent').textContent = fmtC(listAgentNet);
        $('out-list-broker').textContent = fmtC(listBrokerNet);
        $('out-list-fees').textContent = fmtC(flatFee);

        $('out-buy-gross').textContent = fmtC(buyGross);
        $('out-buy-agent').textContent = fmtC(buyAgentNet);

        // Update Visualizer Bar
        if (price > 0) {
            $('bar-seller').style.width = ((sellerNet / price) * 100) + '%';
            $('bar-list').style.width = ((listGross / price) * 100) + '%';
            $('bar-buy').style.width = ((buyGross / price) * 100) + '%';
            
            $('pct-seller').textContent = ((sellerNet / price) * 100).toFixed(1);
            $('pct-list').textContent = ((listGross / price) * 100).toFixed(1);
            $('pct-buy').textContent = ((buyGross / price) * 100).toFixed(1);
        }
    }

    // Listeners
    Object.values(els).forEach(el => el.addEventListener('input', calculateComm));
    
    $('com-copy').addEventListener('click', function(){
        const text = `Real Estate Commission Split:\nSale Price: ${fmtC(els.price.value)}\nSeller Net: ${$('out-seller-net').textContent}\nTotal Commissions: ${$('out-total-fees').textContent}\nListing Agent Takes: ${$('out-list-agent').textContent}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculateComm();
});
</script>

<style>
.commission-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(139,92,246,.08)}
.commission-calc-rebuilt .border-purple { border-top: 4px solid #8b5cf6; }
.commission-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.commission-calc-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.commission-calc-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.commission-calc-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.commission-calc-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}

.text-purple { color: #8b5cf6 !important; }
.bg-purple-soft { background-color: #f5f3ff !important; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem}
.output-hero-value{font-weight:900;letter-spacing:-2.5px;text-shadow: 0 4px 12px rgba(0,0,0,.05);}

/* Split Visualizer */
.split-visualizer { width: 100%; max-width: 800px; height: 32px; border-radius: 16px; background: #e2e8f0; display: flex; overflow: hidden; box-shadow: inset 0 2px 4px rgba(0,0,0,.05); }
.split-bar { height: 100%; transition: width 0.8s cubic-bezier(0.2, 0.8, 0.2, 1); }
.seller-cut { background: #1e293b; }
.list-cut { background: #ec4899; }
.buy-cut { background: #06b6d4; }

.legend-badge { padding: 4px 12px; border-radius: 12px; font-weight: 800; font-size: 0.85rem; color: #fff; }
.seller-badge { background: #1e293b; }
.list-badge { background: #ec4899; }
.buy-badge { background: #06b6d4; }

/* Breakdown Cards */
.breakdown-card { background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,.03); height:100%; }
.bc-header { padding: 12px; text-align: center; font-weight: 800; font-size: 0.85rem; letter-spacing: 1px; }
.bc-body { padding: 1.5rem; }

.bg-list { background: #ec4899; }
.border-list { border: 2px solid #ec4899; }

.bg-buy { background: #06b6d4; }
.border-buy { border: 2px solid #06b6d4; }

.bg-total { background: #8b5cf6; }
.border-total { border: 2px solid #8b5cf6; }
.text-total { color: #8b5cf6; }

@media (max-width: 768px) {
    .commission-calc-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3rem; }
}
@media print {
    .print-hide { display: none !important; }
    .output-card-themed { border: 1px solid #000; box-shadow: none; background: #fff !important; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\real-estate-commissions.blade.php ENDPATH**/ ?>