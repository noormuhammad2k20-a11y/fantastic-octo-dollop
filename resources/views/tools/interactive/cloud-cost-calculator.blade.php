<div class="row g-4 cloud-cost-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Row 1: Instances & Storage --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Virtual Machine Instances</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-server"></i></span>
                            <input type="number" id="instance-count" class="form-control form-control-lg border-start-0" value="5">
                            <input type="number" id="hourly-rate" class="form-control form-control-lg" value="0.12" step="0.01" placeholder="$/hr">
                        </div>
                        <small class="text-muted">Count × Avg Hourly Rate ($)</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Block Storage (GB)</label>
                        <div class="input-group">
                            <input type="number" id="storage-gb" class="form-control form-control-lg border-end-0" value="500">
                            <span class="input-group-text bg-light border-start-0">GB</span>
                        </div>
                        <small class="text-muted">Estimated at $0.10 per GB/mo</small>
                    </div>

                    {{-- Row 2: Networking & Discount --}}
                    <div class="col-md-4">
                        <label class="form-label-custom">Data Egress (GB/mo)</label>
                        <div class="input-group">
                            <input type="number" id="egress-gb" class="form-control form-control-lg border-end-0" value="100">
                            <span class="input-group-text bg-light border-start-0">GB</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Commitment Type</label>
                        <select id="reserve-discount" class="form-select form-select-lg">
                            <option value="0" selected>On-Demand (0%)</option>
                            <option value="15">1-Year Reserved (15%)</option>
                            <option value="40">3-Year Reserved (40%)</option>
                            <option value="70">Spot Instance (~70%)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Support Tier</label>
                        <select id="support-tier" class="form-select form-select-lg">
                            <option value="0" selected>Basic (Free)</option>
                            <option value="100">Developer ($100)</option>
                            <option value="1000">Business ($1000)</option>
                            <option value="15000">Enterprise ($15k)</option>
                        </select>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 cloud-quick" data-i="2" data-h="0.06" data-s="50">🌱 Startup MVP</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 cloud-quick" data-i="12" data-h="0.25" data-s="2000">🚀 Mid-Market</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 cloud-quick" data-i="150" data-h="1.20" data-s="50000">🏢 Enterprise</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:190;--tool-color:#0891b2;--tool-bg:rgba(8,145,178,.06);">
            <div class="output-hero">
                <span class="output-hero-label">MONTHLY RUN RATE</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-unit">$</span>
                    <span class="output-hero-value" id="out-monthly-total">582</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-annual-burn">Annualized Burn: $6,984</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#0891b2; background: rgba(8,145,178,.02);">
                        <span class="stat-card-label">COMPUTE COST</span>
                        <span class="stat-card-value text-info" id="out-compute-cost">$432</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#10b981; background: rgba(16,185,129,.02);">
                        <span class="stat-card-label">EFFICIENCY SAVINGS</span>
                        <span class="stat-card-value text-success" id="out-savings">-$0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#f59e0b; background: rgba(245,158,11,.02);">
                        <span class="stat-card-label">STORAGE & DATA</span>
                        <span class="stat-card-value text-warning" id="out-data-cost">$59</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-microchip text-info me-2"></i>Cost Optimization Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="cloud-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Architecture Quote
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="cloud-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="cloud-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Export for Finance
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const instE = $('instance-count'), rateE = $('hourly-rate'), 
          storE = $('storage-gb'), egrE = $('egress-gb'),
          discE = $('reserve-discount'), suppE = $('support-tier');

    function calculate(){
        let inst = parseFloat(instE.value) || 0;
        let rate = parseFloat(rateE.value) || 0;
        let storage = parseFloat(storE.value) || 0;
        let egress = parseFloat(egrE.value) || 0;
        let discount = (parseFloat(discE.value) || 0) / 100;
        let support = parseFloat(suppE.value) || 0;

        // Monthly compute hours = 730
        const rawCompute = inst * rate * 730;
        const computeDiscounted = rawCompute * (1 - discount);
        const savingsValue = rawCompute - computeDiscounted;

        // Storage cost (~$0.10 per GB)
        const storageCost = storage * 0.10;
        
        // Egress cost (~$0.09 per GB after first 100GB in some regions)
        const egressCost = Math.max(0, (egress - 10) * 0.08); // Simple model

        const total = computeDiscounted + storageCost + egressCost + support;

        // Update UI
        $('out-monthly-total').textContent = Math.round(total).toLocaleString();
        $('out-annual-burn').textContent = `Annualized Burn: $${Math.round(total * 12).toLocaleString()}`;
        
        $('out-compute-cost').textContent = '$' + Math.round(computeDiscounted).toLocaleString();
        $('out-savings').textContent = '-$' + Math.round(savingsValue).toLocaleString();
        $('out-data-cost').textContent = '$' + Math.round(storageCost + egressCost).toLocaleString();

        // Insights
        const ins = [];
        if(discount === 0 && total > 500) {
            ins.push('<strong>Cost Risk</strong>: You are using On-Demand pricing. Switching to 1-Year Reserved instances could save you up to <strong>15%</strong> immediately.');
        }

        if(egress > 500) {
            ins.push('High data egress detected. Consider a <strong>Cloud CDN</strong> or private direct connect to reduce bandwidth costs.');
        }

        if(support > 1000) {
            ins.push('Premium support tier active. Ensure your infrastructure criticality warrants this overhead.');
        }

        if(inst > 50 && discount < 0.4) {
            ins.push('Scaling Note: At this volume, negotiation for Enterprise Discounts (EDP) or sustained use credits is recommended.');
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-info me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [instE, rateE, storE, egrE, discE, suppE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.cloud-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            instE.value = btn.dataset.i;
            rateE.value = btn.dataset.h;
            storE.value = btn.dataset.s;
            calculate();
        });
    });

    $('cloud-reset').addEventListener('click', ()=>{
        instE.value = 5;
        rateE.value = 0.12;
        storE.value = 500;
        egrE.value = 100;
        discE.value = 0;
        suppE.value = 0;
        calculate();
    });

    $('cloud-copy-btn').addEventListener('click', function(){
        const text = `Cloud Cost Forecast\nMonthly Total: $${$('out-monthly-total').textContent}\nCompute: ${$('out-compute-cost').textContent}\nEfficiency Savings: ${$('out-savings').textContent}\nGenerated by ToolsHub Infrastructure Optimizer`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Quote Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.cloud-cost-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(8,145,178,.05)}
.cloud-cost-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.cloud-cost-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.cloud-cost-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.cloud-cost-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.cloud-cost-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:2rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .cloud-cost-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
