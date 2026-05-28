<div class="row g-4 period-calculator-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">First Day of Last Period</label>
                        <input type="date" id="per-date" class="form-control form-control-lg rounded-3">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Average Cycle Length</label>
                        <div class="input-group">
                            <input type="number" id="per-cycle" class="form-control form-control-lg rounded-start-3" value="28" min="21" max="45">
                            <span class="input-group-text bg-light rounded-end-3 text-muted fw-bold">Days</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Average Period Length</label>
                        <div class="input-group">
                            <input type="number" id="per-length" class="form-control form-control-lg rounded-start-3" value="5" min="2" max="10">
                            <span class="input-group-text bg-light rounded-end-3 text-muted fw-bold">Days</span>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-sm btn-outline-primary ms-auto rounded-pill px-4 py-2 fw-bold" id="per-calc-btn" style="min-width: 280px; max-width: 100%;">Calculate Cycle</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:330;--tool-color:#ec4899;--tool-bg:rgba(236,72,153,.04);">
            <div class="output-hero">
                <span class="output-hero-label">NEXT EXPECTED PERIOD</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-next-date" style="font-size:3.5rem;">Select Date</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-countdown">--</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <div class="stat-card" style="border-left: 5px solid #a855f7; background: #fff;">
                        <span class="stat-card-label text-start">Estimated Ovulation</span>
                        <span class="stat-card-value text-dark text-start mt-2" id="out-ovu-date">--</span>
                        <div class="small text-muted mt-2 text-start">Approx. 14 days before next period</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card" style="border-left: 5px solid #ec4899; background: #fff;">
                        <span class="stat-card-label text-start">Fertile Window</span>
                        <span class="stat-card-value text-dark text-start mt-2" id="out-fertile-window">--</span>
                        <div class="small text-muted mt-2 text-start">Highest chance of conception</div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-clipboard-list text-primary me-2"></i>Cycle Insights
                </h6>
                <div id="out-insights" class="small text-secondary">
                    <p>Please enter the first day of your last period to generate insights.</p>
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="per-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-pink"></i>Copy Schedule
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="per-reset" style="min-width: 280px; max-width: 100%;">Reset Fields</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="per-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Summary
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const dateE = $('per-date'), cycleE = $('per-cycle'), lengthE = $('per-length');
    
    // Default today
    dateE.valueAsDate = new Date();

    function calculate(){
        if(!dateE.value) return;
        
        let lastPeriod = new Date(dateE.value);
        let cycle = parseInt(cycleE.value) || 28;
        let length = parseInt(lengthE.value) || 5;
        
        // Ensure invalid dates don't crash
        if(isNaN(lastPeriod.getTime())) return;

        // Next Period
        let nextPeriod = new Date(lastPeriod);
        nextPeriod.setDate(nextPeriod.getDate() + cycle);
        
        // Luteal phase is generally 14 days
        let ovulation = new Date(nextPeriod);
        ovulation.setDate(ovulation.getDate() - 14);
        
        // Fertile Window: 5 days before ovulation up to the day of ovulation
        let fertileStart = new Date(ovulation);
        fertileStart.setDate(fertileStart.getDate() - 5);
        let fertileEnd = new Date(ovulation);
        fertileEnd.setDate(fertileEnd.getDate() + 1);

        const options = { weekday: 'short', month: 'short', day: 'numeric', year: 'numeric' };
        
        $('out-next-date').textContent = nextPeriod.toLocaleDateString(undefined, {month: 'long', day:'numeric', year:'numeric'});
        $('out-ovu-date').textContent = ovulation.toLocaleDateString(undefined, options);
        $('out-fertile-window').textContent = `${fertileStart.toLocaleDateString(undefined, {month:'short', day:'numeric'})} - ${fertileEnd.toLocaleDateString(undefined, {month:'short', day:'numeric'})}`;

        // Countdown
        const today = new Date();
        today.setHours(0,0,0,0);
        const diffTime = nextPeriod - today;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        if (diffDays > 0) {
            $('out-countdown').textContent = `In ${diffDays} Days`;
        } else if (diffDays === 0) {
            $('out-countdown').textContent = `Starts Today`;
        } else {
            $('out-countdown').textContent = `Overdue by ${Math.abs(diffDays)} Days`;
        }

        // Insights
        const ins = [];
        ins.push(`Your cycle relies on an estimated <strong>${cycle} day</strong> rhythm and a <strong>${length} day</strong> menstruation phase.`);
        if(diffDays >= 0 && diffDays <= 3) {
            ins.push('You are approaching your period. PMS symptoms may occur.');
        } else if (diffTime < 0) {
            ins.push('Your period is currently overdue based on the calculated rhythm.');
        } else {
            let ovuDiff = Math.ceil((ovulation - today) / (1000 * 60 * 60 * 24));
            if(ovuDiff >= 0 && ovuDiff <= 5) {
                ins.push('You are entering or currently inside your fertile window.');
            }
        }
        
        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-info-circle text-primary me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [dateE, cycleE, lengthE].forEach(el => el.addEventListener('input', calculate));
    $('per-calc-btn').addEventListener('click', calculate);

    $('per-reset').addEventListener('click', ()=>{
        dateE.valueAsDate = new Date();
        cycleE.value = 28;
        lengthE.value = 5;
        calculate();
    });

    $('per-copy-btn').addEventListener('click', function(){
        const text = `Cycle Tracker\nNext Period: ${$('out-next-date').textContent}\nFertile Window: ${$('out-fertile-window').textContent}\nEst. Ovulation: ${$('out-ovu-date').textContent}\nGenerated via ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.period-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(236,72,153,.05)}
.period-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.period-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.period-calculator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.period-calculator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.period-calculator-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-2px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:1px solid #f1f5f9;border-radius:12px;padding:1.5rem;text-align:left;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%; box-shadow: 0 4px 6px rgba(0,0,0,0.02);}
.stat-card:hover { transform: translateX(5px); }
.stat-card-label{display:block;font-size:.70rem;font-weight:800;text-transform:uppercase;color:#64748b;letter-spacing:1px;margin-bottom:4px}
.stat-card-value{font-size:1.15rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }
.fa-calendar-pink:before { content: "\f133"; } /* Calendar icon fallback */
.text-pink { color: #ec4899; }

@media (max-width: 768px) {
    .period-calculator-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
    .output-hero-value { font-size: 2.5rem !important; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\period-calculator.blade.php ENDPATH**/ ?>