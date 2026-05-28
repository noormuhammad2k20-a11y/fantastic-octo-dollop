<div class="row g-4 pregnancy-calc-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Calculation Basis</label>
                    <div class="d-flex gap-2 flex-wrap">
                        <button type="button" class="btn btn-outline-preg active flex-grow-1 py-3" data-mode="lmp"><i class="fas fa-calendar-alt me-2"></i>Last Period (LMP)</button>
                        <button type="button" class="btn btn-outline-preg flex-grow-1 py-3" data-mode="conception"><i class="fas fa-heart me-2"></i>Conception</button>
                        <button type="button" class="btn btn-outline-preg flex-grow-1 py-3" data-mode="ivf"><i class="fas fa-flask me-2"></i>IVF Transfer</button>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom" id="preg-date-label">First Day of Last Period</label>
                        <input type="date" id="preg-date" class="form-control form-control-lg rounded-3">
                    </div>
                    <div class="col-md-6" id="preg-cycle-wrap">
                        <label class="form-label-custom">Average Cycle Length</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="range" id="preg-cycle" class="form-range flex-grow-1" min="20" max="45" value="28" style="accent-color:#ec4899">
                            <span class="badge rounded-pill px-3 py-2" id="preg-cycle-val" style="background:#fdf2f8;color:#db2777;font-weight:700;min-width:80px">28 Days</span>
                        </div>
                    </div>
                    <div class="col-md-6" id="preg-ivf-type-wrap" style="display:none">
                        <label class="form-label-custom">Embryo Age</label>
                        <select id="preg-ivf-type" class="form-select form-select-lg rounded-3">
                            <option value="3">Day 3 Transfer</option>
                            <option value="5" selected>Day 5 Transfer (Blastocyst)</option>
                        </select>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Select:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 preg-quick" data-action="week8">🗓️ ~8 Weeks Ago</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 preg-quick" data-action="week20">🗓️ ~20 Weeks Ago</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" id="preg-reset" style="min-width: 280px; max-width: 100%;">Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="preg-theme" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.06);">
            <div class="output-hero">
                <span class="output-hero-label">ESTIMATED DUE DATE (EDD)</span>
                <div class="output-hero-value" id="out-edd">—</div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-countdown" style="letter-spacing:2px;color:#db2777;">Calculating Timeline...</div>
            </div>

            <div class="row g-3 mt-3 text-center">
                <div class="col-4">
                    <div class="stat-card" style="border-top: 4px solid #db2777; background: #fff;">
                        <span class="stat-card-label">CURRENT WEEK</span>
                        <span class="stat-card-value" id="out-weeks">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card" style="border-top: 4px solid #10b981; background: #fff;">
                        <span class="stat-card-label">TRIMESTER</span>
                        <span class="stat-card-value" id="out-trimester">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card" style="border-top: 4px solid #6366f1; background: #fff;">
                        <span class="stat-card-label">DAYS REMAINING</span>
                        <span class="stat-card-value" id="out-days">—</span>
                    </div>
                </div>
            </div>

            <div class="mt-5 px-3">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex justify-content-between">
                    <span><i class="fas fa-chart-line text-danger me-2"></i>Gestational Progress</span>
                    <span id="out-pct-text">0% Complete</span>
                </h6>
                <div class="progress rounded-pill shadow-sm mb-1" style="height:12px; background:#e2e8f0;">
                    <div id="out-progress" class="progress-bar rounded-pill" style="width:0%; background:linear-gradient(90deg, #f9a8d4, #db2777); transition: width 1s cubic-bezier(0.1, 0.5, 0.5, 1);"></div>
                </div>
                <div class="d-flex justify-content-between x-small text-muted fw-bold mt-1">
                    <span>Conception</span>
                    <span>13w (T1)</span>
                    <span>27w (T2)</span>
                    <span>40w (Due)</span>
                </div>
            </div>

            <div class="mt-5 p-4 bg-white rounded-4 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-flag-checkered text-primary me-2"></i>Pregnancy Milestones
                </h6>
                <div class="table-responsive">
                    <table class="table table-hover mb-0 text-center small align-middle" id="out-milestones">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 text-muted small">Milestone Event</th>
                                <th class="border-0 text-muted small">Target Date</th>
                                <th class="border-0 text-muted small">Week Index</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="preg-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calendar-check me-2 text-info"></i>Copy Milestone Plan
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="preg-share-btn" style="min-width: 280px; max-width: 100%;">
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
    let mode = 'lmp';
    const dateEl = $('preg-date'), cycleEl = $('preg-cycle'), cycleVal = $('preg-cycle-val'), ivfType = $('preg-ivf-type');

    // Default to 10 weeks ago
    const def = new Date(); def.setDate(def.getDate() - 70);
    dateEl.value = def.toISOString().split('T')[0];

    function fmt(d){return d.toLocaleDateString(undefined, {year:'numeric', month:'long', day:'numeric'})}

    function calculate(){
        const inputDate = new Date(dateEl.value);
        if(isNaN(inputDate.getTime())) return;
        
        const cycle = parseInt(cycleEl.value) || 28;
        cycleVal.textContent = cycle + ' Days';

        let edd;
        if(mode === 'lmp'){
            edd = new Date(inputDate.getTime() + (280 + (cycle - 28)) * 864e5);
        } else if(mode === 'conception'){
            edd = new Date(inputDate.getTime() + 266 * 864e5);
        } else {
            const embryoAge = parseInt(ivfType.value) || 5;
            edd = new Date(inputDate.getTime() + (266 - embryoAge) * 864e5);
        }

        const now = new Date();
        const lmpRef = mode === 'lmp' ? inputDate : new Date(edd.getTime() - 280 * 864e5);
        
        const elapsedDays = Math.floor((now - lmpRef) / 864e5);
        const weeks = Math.floor(elapsedDays / 7);
        const daysPart = elapsedDays % 7;
        const remainDays = Math.max(0, Math.ceil((edd - now) / 864e5));
        const pct = Math.min(100, Math.max(0, (elapsedDays / 280) * 100));
        
        const trimester = weeks < 13 ? '1st' : weeks < 27 ? '2nd' : '3rd';

        $('out-edd').textContent = fmt(edd);
        $('out-weeks').textContent = `${weeks}w ${daysPart}d`;
        $('out-trimester').textContent = trimester;
        $('out-days').textContent = remainDays;
        $('out-countdown').textContent = `${remainDays} Days to Arrival`;
        $('out-progress').style.width = pct + '%';
        $('out-pct-text').textContent = pct.toFixed(1) + '% Complete';

        // Milestones
        const milestones = [
            {name: 'Conception Estimate', wk: 2},
            {name: 'End of 1st Trimester', wk: 13},
            {name: 'Anatomy Scan Window', wk: 20},
            {name: 'Viability Point', wk: 24},
            {name: '3rd Trimester Begins', wk: 27},
            {name: 'Full Term Pregnancy', wk: 39},
            {name: 'Due Date', wk: 40}
        ];

        $('out-milestones').querySelector('tbody').innerHTML = milestones.map(m => {
            const mDate = new Date(lmpRef.getTime() + (m.wk * 7 * 864e5));
            const past = mDate < now;
            return `<tr class="${past ? 'table-success opacity-75' : ''}">
                <td class="fw-bold text-muted">${m.name}</td>
                <td class="fw-bold text-dark">${fmt(mDate)}</td>
                <td><span class="badge rounded-pill bg-light text-dark border">${m.wk} Weeks</span></td>
            </tr>`;
        }).join('');
    }

    [dateEl, cycleEl, ivfType].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('[data-mode]').forEach(btn => {
        btn.onclick = () => {
            mode = btn.dataset.mode;
            document.querySelectorAll('[data-mode]').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            $('preg-date-label').textContent = mode === 'lmp' ? 'First Day of Last Period' : mode === 'conception' ? 'Date of Conception' : 'IVF Transfer Date';
            $('preg-cycle-wrap').style.display = mode === 'lmp' ? '' : 'none';
            $('preg-ivf-type-wrap').style.display = mode === 'ivf' ? '' : 'none';
            calculate();
        };
    });

    document.querySelectorAll('.preg-quick').forEach(btn => {
        btn.onclick = () => {
            const d = new Date();
            const w = parseInt(btn.dataset.action.replace('week', ''));
            d.setDate(d.getDate() - (w * 7));
            dateEl.value = d.toISOString().split('T')[0];
            calculate();
        };
    });

    $('preg-reset').onclick = () => {
        const d = new Date(); d.setDate(d.getDate() - 70);
        dateEl.value = d.toISOString().split('T')[0];
        cycleEl.value = 28;
        calculate();
    };

    $('preg-copy-btn').onclick = function(){
        const text = `Pregnancy Due Date Report\nEDD: ${$('out-edd').textContent}\nCurrent Status: ${$('out-weeks').textContent} (${$('out-trimester').textContent} Trimester)\nRemaining: ${$('out-days').textContent} Days\n— ToolsHub Health`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(()=>this.innerHTML=o,2000);
        });
    };

    calculate();
});
</script>

<style>
.pregnancy-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(219,39,119,.05)}
.pregnancy-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.pregnancy-calc-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.pregnancy-calc-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.pregnancy-calc-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.pregnancy-calc-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.btn-outline-preg{border:2px solid #fce7f3;color:#be185d;font-weight:700;border-radius:16px;transition:all .3s cubic-bezier(0.4,0,0.2,1)}
.btn-outline-preg:hover{background:#fdf2f8;border-color:#f9a8d4;color:#db2777}
.btn-outline-preg.active{background:#db2777;border-color:#db2777;color:#fff;box-shadow:0 10px 20px rgba(219,39,119,0.2)}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:3.5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-2px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:1.3rem;font-weight:800;display:block;line-height:1.2}
.x-small{font-size: 0.75rem;}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .pregnancy-calc-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 2.5rem; }
}
</style>

