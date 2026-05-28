<div class="row g-4 ovu-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">First Day of Last Period (LMP)</label>
                        <input type="date" id="ovu-date" class="form-control form-control-lg rounded-3">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Average Cycle Length</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="range" id="ovu-cycle" class="form-range flex-grow-1" min="20" max="45" value="28" style="accent-color:#ec4899">
                            <span class="badge rounded-pill px-3 py-2" id="ovu-cycle-val" style="background:#fdf2f8;color:#db2777;font-weight:700;min-width:80px">28 Days</span>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Adjust:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 ovu-preset" data-days="0">LMP Today</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 ovu-preset" data-days="-14">LMP 2 Weeks Ago</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" id="ovu-reset" style="min-width: 280px; max-width: 100%;">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="ovu-theme" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.06);">
            <div class="output-hero">
                <span class="output-hero-label">EXPECTED OVULATION DATE</span>
                <div class="output-hero-value" id="out-ovulation">—</div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;">Fertility Window Identified</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 4px solid #db2777; background: #fff;">
                        <span class="stat-card-label">FERTILE WINDOW START</span>
                        <span class="stat-card-value" id="out-start">—</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 4px solid #10b981; background: #fff;">
                        <span class="stat-card-label">FERTILE WINDOW END</span>
                        <span class="stat-card-value" id="out-end">—</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 4px solid #6366f1; background: #fff;">
                        <span class="stat-card-label">NEXT EXPECTED PERIOD</span>
                        <span class="stat-card-value" id="out-next">—</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2"></i>Conception Science & Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="ovu-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Fertility Report
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="ovu-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Assessment
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const dEl = $('ovu-date'), cEl = $('ovu-cycle'), cVal = $('ovu-cycle-val');
    
    // Set default to today
    const def = new Date();
    dEl.value = def.toISOString().split('T')[0];

    function calculate(){
        const lmp = new Date(dEl.value);
        if(isNaN(lmp.getTime())) return;
        
        const cycle = parseInt(cEl.value);
        cVal.textContent = cycle + ' Days';

        // Prediction Logic
        // Ovulation is roughly cycle - 14 days after LMP
        const ovulation = new Date(lmp.getTime() + (cycle - 14) * 864e5);
        const fertStart = new Date(ovulation.getTime() - (5 * 864e5));
        const fertEnd = new Date(ovulation.getTime() + (1 * 864e5));
        const nextPeriod = new Date(lmp.getTime() + cycle * 864e5);

        const fmt = d => d.toLocaleDateString(undefined, {month:'long', day:'numeric', year:'numeric'});
        const smFmt = d => d.toLocaleDateString(undefined, {month:'short', day:'numeric'});

        $('out-ovulation').textContent = fmt(ovulation);
        $('out-start').textContent = smFmt(fertStart);
        $('out-end').textContent = smFmt(fertEnd);
        $('out-next').textContent = fmt(nextPeriod);

        // Insights
        const ins = [];
        ins.push(`Your peak fertility lasts for approximately <strong>6 days</strong>, ending on the day of ovulation.`);
        ins.push(`Conception is most likely during the <strong>3 days</strong> leading up to and including ovulation.`);
        ins.push(`Sperm can live inside the female body for up to <strong>5 days</strong>, meaning sex before ovulation can lead to pregnancy.`);
        
        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [dEl, cEl].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.ovu-preset').forEach(btn => {
        btn.onclick = () => {
            const d = new Date();
            d.setDate(d.getDate() + parseInt(btn.dataset.days));
            dEl.value = d.toISOString().split('T')[0];
            calculate();
        };
    });

    $('ovu-reset').onclick = () => {
        dEl.value = new Date().toISOString().split('T')[0];
        cEl.value = 28;
        calculate();
    };

    $('ovu-copy-btn').onclick = function(){
        const text = `Ovulation & Fertility Report\nLMP: ${dEl.value}\nEst. Ovulation: ${$('out-ovulation').textContent}\nFertile Window: ${$('out-start').textContent} - ${$('out-end').textContent}\nNext Period: ${$('out-next').textContent}\n— ToolsHub Health`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Results Copied!';
            setTimeout(()=>this.innerHTML=o,2000);
        });
    };

    calculate();
});
</script>

<style>
.ovu-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(219,39,119,.05)}
.ovu-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.ovu-calc-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.ovu-calc-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.ovu-calc-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.ovu-calc-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:3.5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-2px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:1.3rem;font-weight:800;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .ovu-calc-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 2.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\ovulation-calculator.blade.php ENDPATH**/ ?>