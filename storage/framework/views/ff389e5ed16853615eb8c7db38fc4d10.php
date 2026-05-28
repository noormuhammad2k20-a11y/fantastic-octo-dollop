<div class="row g-4 period-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">First Day of Last Period</label>
                        <input type="date" id="period-date" class="form-control form-control-lg rounded-3">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Average Cycle Length</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="range" id="period-cycle" class="form-range flex-grow-1" min="15" max="50" value="28" style="accent-color:#ec4899">
                            <span class="badge rounded-pill px-3 py-2" id="period-cycle-val" style="background:#fdf2f8;color:#db2777;font-weight:700;min-width:80px">28 Days</span>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Adjust:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 period-preset" data-days="-28">Last Month</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 period-preset" data-days="-14">2 Weeks Ago</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" id="period-reset" style="min-width: 280px; max-width: 100%;">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="period-theme" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.06);">
            <div class="output-hero">
                <span class="output-hero-label">PREDICTED NEXT PERIOD</span>
                <div class="output-hero-value" id="out-next">—</div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;color:#db2777;">Cycle Prediction Generated</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center px-2">
                    <i class="fas fa-history text-secondary me-2"></i>Upcoming 6-Month Schedule
                </h6>
                <div class="table-responsive rounded-4 border bg-white shadow-sm">
                    <table class="table table-hover mb-0 text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3 small uppercase fw-bold text-muted border-0">Cycle No.</th>
                                <th class="py-3 small uppercase fw-bold text-muted border-0">Predicted Start Date</th>
                                <th class="py-3 small uppercase fw-bold text-muted border-0">Status</th>
                            </tr>
                        </thead>
                        <tbody id="out-upcoming"></tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-info-circle text-info me-2"></i>Health Logic & Assumptions
                </h6>
                <div class="small text-secondary">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i>Predictions are based on a fixed cycle arithmetic. Individual cycles may vary by 2-5 days due to stress, diet, or hormone fluctuations.</li>
                        <li class="d-flex align-items-start"><i class="fas fa-shield-alt text-primary me-2 mt-1"></i>If your cycle is consistently shorter than 21 days or longer than 35 days, clinical consultation is advised.</li>
                    </ul>
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="period-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Cycle Schedule
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="period-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Tracking
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const dEl = $('period-date'), cEl = $('period-cycle'), cVal = $('period-cycle-val');
    
    // Set default to 2 weeks ago
    const def = new Date();
    def.setDate(def.getDate() - 14);
    dEl.value = def.toISOString().split('T')[0];

    function calculate(){
        const lmp = new Date(dEl.value);
        if(isNaN(lmp.getTime())) return;
        
        const cycle = parseInt(cEl.value);
        cVal.textContent = cycle + ' Days';

        const fmt = d => d.toLocaleDateString(undefined, {weekday: 'short', month:'long', day:'numeric', year:'numeric'});
        
        let rows = '';
        for(let i=1; i<=6; i++){
            const nextDate = new Date(lmp.getTime() + (i * cycle * 864e5));
            const dateStr = fmt(nextDate);
            if(i === 1) $('out-next').textContent = dateStr;
            
            rows += `
                <tr>
                    <td class="fw-bold text-muted py-3">#${i}</td>
                    <td class="fw-bold text-dark py-3">${dateStr}</td>
                    <td class="py-3"><span class="badge rounded-pill bg-light text-success border px-3">Predicted</span></td>
                </tr>
            `;
        }
        $('out-upcoming').innerHTML = rows;
    }

    [dEl, cEl].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.period-preset').forEach(btn => {
        btn.onclick = () => {
            const d = new Date();
            d.setDate(d.getDate() + parseInt(btn.dataset.days));
            dEl.value = d.toISOString().split('T')[0];
            calculate();
        };
    });

    $('period-reset').onclick = () => {
        const d = new Date(); d.setDate(d.getDate() - 14);
        dEl.value = d.toISOString().split('T')[0];
        cEl.value = 28;
        calculate();
    };

    $('period-copy-btn').onclick = function(){
        const text = `Predicted Menstrual Cycle Schedule\nNext Period: ${$('out-next').textContent}\nBased on ${cEl.value}-day cycle length.\n— ToolsHub Health`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Schedule Copied!';
            setTimeout(()=>this.innerHTML=o,2000);
        });
    };

    calculate();
});
</script>

<style>
.period-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(219,39,119,.05)}
.period-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.period-calc-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.period-calc-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.period-calc-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.period-calc-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:3rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-1px}

@media (max-width: 768px) {
    .period-calc-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 2rem; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\menstrual-cycle-calculator.blade.php ENDPATH**/ ?>