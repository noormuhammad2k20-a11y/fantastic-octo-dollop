<div class="row g-4 dental-calculator-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Row 1: Implants --}}
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label-custom mb-0">Total Number of Implants</label>
                            <span class="badge bg-primary fs-6" id="implant-count-display">1</span>
                        </div>
                        <input type="range" class="form-range custom-range" id="den-implants" min="1" max="10" step="1" value="1">
                        <div class="d-flex justify-content-between text-muted small mt-1">
                            <span>1 Tooth</span>
                            <span>All-on-4 (Full Arch)</span>
                            <span>10 Teeth</span>
                        </div>
                    </div>

                    {{-- Row 2: Add-ons --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Include Crown & Abutment?</label>
                        <select id="den-crown" class="form-select form-select-lg rounded-3">
                            <option value="yes" selected>Yes (Full Restoration - +$1,500/ea)</option>
                            <option value="no">No (Implant Post Only - +$0)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Bone Graft Required?</label>
                        <select id="den-graft" class="form-select form-select-lg rounded-3">
                            <option value="no" selected>No Extraction/Graft Needed</option>
                            <option value="simple">Simple Graft (+$500/site)</option>
                            <option value="complex">Complex/Sinus Lift (+$1,200/site)</option>
                        </select>
                    </div>

                    {{-- Row 3: Insurance --}}
                    <div class="col-md-12">
                        <label class="form-label-custom">Estimated Dental Insurance Coverage</label>
                        <div class="input-group">
                            <input type="number" id="den-ins" class="form-control form-control-lg rounded-start-3" value="0" min="0" max="100">
                            <span class="input-group-text bg-light rounded-end-3 text-muted fw-bold">%</span>
                        </div>
                        <span class="small text-muted mt-1 d-block"><i class="fas fa-info-circle me-1"></i>Most plans cap out at an annual maximum (e.g., $1500). This estimator assumes a percentage deduction without caps for simplicity.</span>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 den-quick" data-i="1" data-c="yes" data-g="no">🦷 Single Post</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 den-quick" data-i="1" data-c="yes" data-g="simple">🦷 Single + Graft</button>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 den-quick ms-auto fw-bold" data-i="4" data-c="yes" data-g="complex">😬 All-on-4 (Full Arch)</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:200;--tool-color:#0ea5e9;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero">
                <span class="output-hero-label">OUT OF POCKET ESTIMATE</span>
                <div class="d-flex justify-content-center align-items-baseline gap-1" style="font-size:4rem;">
                    <span class="text-secondary fw-bold" style="font-size:2.5rem;">$</span>
                    <span class="output-hero-value" id="out-pocket">3,500</span>
                </div>
                <div class="mt-2 text-muted fw-bold small">Gross Total Cost: $<span id="out-gross">3,500</span></div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 4px solid #64748b; background: #fff;">
                        <span class="stat-card-label">Surgical (Posts)</span>
                        <span class="stat-card-value text-dark" id="out-surgical">$1,500</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 4px solid #3b82f6; background: #fff;">
                        <span class="stat-card-label">Restorative (Crowns)</span>
                        <span class="stat-card-value text-dark" id="out-restorative">$1,500</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 4px solid #f59e0b; background: #fff;">
                        <span class="stat-card-label">Prep & Grafts</span>
                        <span class="stat-card-value text-dark" id="out-graft">$500</span>
                    </div>
                </div>
                
                <div class="col-12 mt-3">
                    <div class="d-flex justify-content-between align-items-center p-3 bg-white border rounded-3 text-success fw-bold">
                        <span><i class="fas fa-shield-alt me-2"></i>Estimated Insurance Coverage</span>
                        <span id="out-insurance-saved">-$0</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-file-invoice-dollar text-primary me-2"></i>Financial Advisory
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="den-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Financial Summary
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="den-reset" style="min-width: 280px; max-width: 100%;">Reset Options</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="den-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-envelope me-2"></i>Email Quote to Self
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const impE = $('den-implants'), crownE = $('den-crown'), graftE = $('den-graft'), insE = $('den-ins'), dispE = $('implant-count-display');
    
    // Average Cost Variables (in USD)
    const COST_POST = 1500;
    const COST_CROWN = 1500;
    const COST_GRAFT_SIMPLE = 500;
    const COST_GRAFT_COMPLEX = 1200;

    function formatUsd(num) {
        return num.toLocaleString('en-US');
    }

    function calculate(){
        dispE.textContent = impE.value;
        let count = parseInt(impE.value) || 1;
        let c = crownE.value;
        let g = graftE.value;
        let insPercentage = parseInt(insE.value) || 0;

        let surgicalCost = count * COST_POST;
        let restorativeCost = (c === 'yes') ? (count * COST_CROWN) : 0;
        
        let graftCost = 0;
        if(g === 'simple') graftCost = count * COST_GRAFT_SIMPLE;
        if(g === 'complex') graftCost = count * COST_GRAFT_COMPLEX;
        
        // Full Arch Logic - All-on-4 usually has a flat package rate rather than per tooth.
        // We will do a generic approximation: 4 posts + 1 full bridge.
        if(count >= 4 && count <= 8 && c === 'yes') {
            // Give a "Bulk" discount approximation
            surgicalCost = surgicalCost * 0.85;
            restorativeCost = restorativeCost * 0.70; 
        }

        let grossTotal = surgicalCost + restorativeCost + graftCost;
        let insuranceEst = grossTotal * (insPercentage / 100);
        let outOfPocket = grossTotal - insuranceEst;

        $('out-surgical').textContent = '$' + formatUsd(Math.round(surgicalCost));
        $('out-restorative').textContent = '$' + formatUsd(Math.round(restorativeCost));
        $('out-graft').textContent = '$' + formatUsd(Math.round(graftCost));
        $('out-gross').textContent = formatUsd(Math.round(grossTotal));
        $('out-pocket').textContent = formatUsd(Math.round(outOfPocket));
        $('out-insurance-saved').textContent = '-$' + formatUsd(Math.round(insuranceEst));

        // Insights
        const ins = [];
        ins.push(`You are preparing for a <strong>Tier ${count > 3 ? '3 (Complex)' : (count > 1 ? '2 (Multiple)' : '1 (Standard)')}</strong> procedure.`);
        if(g === 'complex') {
            ins.push('Sinus lifts and complex grafts require a 3-6 month healing latency before placing the implant post.');
        }
        if(insPercentage > 0) {
            ins.push('Warning: Dental insurance policies typically impose an absolute annual max (e.g., $1,500 - $2,000). Your out-of-pocket costs may be heavily modified if you breach this cap.');
        }
        ins.push('Ask your oral surgeon about payment plans. CareCredit or similar lenders often provide 0% APR pacing for 12-24 months.');
        
        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-chevron-right text-primary me-2 mt-1" style="font-size:0.7rem;"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [impE, crownE, graftE, insE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.den-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            impE.value = btn.dataset.i;
            crownE.value = btn.dataset.c;
            graftE.value = btn.dataset.g;
            calculate();
        });
    });

    $('den-reset').addEventListener('click', ()=>{
        impE.value = 1;
        crownE.value = 'yes';
        graftE.value = 'no';
        insE.value = 0;
        calculate();
    });

    $('den-copy-btn').addEventListener('click', function(){
        const text = `Dental Implant Estimate\nImplants: ${impE.value}\nGross Total: $${$('out-gross').textContent}\nEst. Out of Pocket: $${$('out-pocket').textContent}\nGenerated via ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Quote Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.dental-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(14,165,233,.05)}
.dental-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.dental-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.dental-calculator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.dental-calculator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.dental-calculator-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.75rem;display:block}

/* Custom Range Slider Styling */
.custom-range {
  -webkit-appearance: none;
  width: 100%;
  height: 8px;
  background: #e2e8f0;
  border-radius: 5px;
  outline: none;
}
.custom-range::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background: #0ea5e9;
  cursor: pointer;
  box-shadow: 0 0 10px rgba(14,165,233,0.5);
}

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-weight:900;color:#0f172a;line-height:1;letter-spacing:-2px}
.stat-card{background:#fff;border:1px solid #f1f5f9;border-radius:12px;padding:1.5rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%; box-shadow: 0 4px 6px rgba(0,0,0,0.02);}
.stat-card:hover { transform: translateY(-5px); }
.stat-card-label{display:block;font-size:.70rem;font-weight:800;text-transform:uppercase;color:#64748b;letter-spacing:1px;margin-bottom:6px}
.stat-card-value{font-size:1.5rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .dental-calculator-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
}
</style>
