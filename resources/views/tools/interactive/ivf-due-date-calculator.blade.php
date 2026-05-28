<div class="row g-4 ivf-calc-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Procedure Type</label>
                    <div class="d-flex gap-2 flex-wrap" id="ivf-proc-group">
                        <button type="button" class="btn btn-outline-preg active flex-grow-1" data-proc="blast"><i class="fas fa-certificate me-1"></i>Blastocyst (Day 5)</button>
                        <button type="button" class="btn btn-outline-preg flex-grow-1" data-proc="day3"><i class="fas fa-cube me-1"></i>Embryo (Day 3)</button>
                        <button type="button" class="btn btn-outline-preg flex-grow-1" data-proc="retrieval"><i class="fas fa-vial me-1"></i>Egg Retrieval</button>
                        <button type="button" class="btn btn-outline-preg flex-grow-1" data-proc="iui"><i class="fas fa-syringe me-1"></i>IUI Date</button>
                    </div>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom" id="ivf-date-label">Transfer Date</label>
                        <input type="date" id="ivf-date" class="form-control form-control-lg rounded-3">
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Select:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 ivf-quick" data-days="0">Today</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 ivf-quick" data-days="-7">1 Week Ago</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 ivf-quick" data-days="-14">2 Weeks Ago</button>
                </div>

                <div class="mt-3 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-primary me-1"></i> <strong>How it works:</strong> Unlike LMP-based calculations, IVF dating is highly precise. We adjust the 266-day post-ovulation timeline based on the specific age of your embryo at transfer.
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Estimated Due Date</span>
                <div class="output-hero-value" id="out-edd">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-countdown">— days remaining</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Pregnancy Week</span><span class="stat-card-value" id="out-weeks">—</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Trimester</span><span class="stat-card-value" id="out-trimester">—</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Conception Date</span><span class="stat-card-value" id="out-conception">—</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-calendar-alt me-2 text-danger"></i>Clinical Milestones</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered text-center small mb-0" id="out-milestones">
                    <thead class="table-light"><tr><th>Milestone</th><th>Date</th><th>Week</th></tr></thead>
                    <tbody></tbody>
                </table>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="ivf-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Timeline</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    let proc='blast';
    const dateEl=$('ivf-date');

    // Set default date to today
    dateEl.value = new Date().toISOString().split('T')[0];

    function fmt(d){return d.toLocaleDateString(undefined,{year:'numeric',month:'long',day:'numeric'})}
    function addDays(d,n){const r=new Date(d);r.setDate(r.getDate()+n);return r}

    function calculate(){
        const inputDate = new Date(dateEl.value);
        if(isNaN(inputDate.getTime())) return;

        let edd, conception;
        // Logic: edd is 266 days from ovulation. 
        // Ovulation is roughly procedure date - offset.
        if(proc==='blast'){ // Day 5
            edd = addDays(inputDate, 261);
            conception = addDays(inputDate, -5);
        } else if(proc==='day3'){ // Day 3
            edd = addDays(inputDate, 263);
            conception = addDays(inputDate, -3);
        } else if(proc==='retrieval' || proc==='iui'){
            edd = addDays(inputDate, 266);
            conception = inputDate;
        }

        const now = new Date();
        const lmpRef = addDays(conception, -14); // 40-week timeline starts 2 weeks before conception
        const elapsedDays = Math.floor((now - lmpRef)/(864e5));
        const weeks = Math.floor(elapsedDays/7);
        const days = elapsedDays % 7;
        const daysRemaining = Math.max(0, Math.ceil((edd - now)/864e5));
        
        $('out-edd').textContent = fmt(edd);
        $('out-countdown').textContent = daysRemaining + ' days remaining';
        $('out-weeks').textContent = (weeks >= 0 ? weeks : 0) + 'w ' + (days >=0 ? days : 0) + 'd';
        $('out-trimester').textContent = weeks < 13 ? '1st' : weeks < 27 ? '2nd' : '3rd';
        $('out-conception').textContent = conception.toLocaleDateString(undefined, {month:'short', day:'numeric'});

        // Milestones
        const milestones = [
            {name:'Gestational Sac check', days:35}, // 5 weeks
            {name:'Heartbeat check', days:42},      // 6 weeks
            {name:'Nuchal Scan window', days:84},    // 12 weeks
            {name:'Anatomy Scan', days:140},         // 20 weeks
            {name:'Viability Milestone', days:168},  // 24 weeks
            {name:'Glucose Test', days:189},         // 27 weeks
            {name:'Full Term', days:259},            // 37 weeks
        ];

        $('out-milestones').querySelector('tbody').innerHTML = milestones.map(m=>{
            const d = addDays(lmpRef, m.days);
            const w = Math.floor(m.days/7);
            const past = d < now;
            return `<tr class="${past?'table-success opacity-75':''}"><td>${m.name}</td><td>${fmt(d)}</td><td>${w}</td></tr>`;
        }).join('');
    }

    // Interaction
    document.querySelectorAll('[data-proc]').forEach(btn=>{
        btn.addEventListener('click',()=>{
            proc = btn.dataset.proc;
            document.querySelectorAll('[data-proc]').forEach(b=>b.classList.remove('active'));
            btn.classList.add('active');
            $('ivf-date-label').textContent = (proc==='blast'||proc==='day3') ? 'Transfer Date' : proc==='retrieval' ? 'Retrieval Date' : 'Procedure Date';
            calculate();
        });
    });

    dateEl.addEventListener('input', calculate);

    document.querySelectorAll('.ivf-quick').forEach(btn=>{
        btn.addEventListener('click',()=>{
            const d = new Date();
            d.setDate(d.getDate() + parseInt(btn.dataset.days));
            dateEl.value = d.toISOString().split('T')[0];
            calculate();
        });
    });

    $('ivf-copy').addEventListener('click', function(){
        const text = `IVF Pregnancy Timeline\nDue Date: ${$('out-edd').textContent}\nCurrent Stage: ${$('out-weeks').textContent}\nMethod: ${proc}\n— ToolsHub Fertility`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.ivf-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.ivf-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.ivf-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.ivf-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.ivf-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.ivf-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.ivf-calc-rebuilt .btn-outline-preg{border:2px solid #f1f5f9;color:#64748b;font-weight:600;border-radius:12px;padding:.75rem 1rem;transition:all .2s;background:#f8fafc}
.ivf-calc-rebuilt .btn-outline-preg:hover{background:#fdf2f8;color:#db2777;border-color:#f9a8d4}
.ivf-calc-rebuilt .btn-outline-preg.active{background:#db2777;color:#fff;border-color:#db2777;box-shadow:0 4px 12px rgba(219,39,119,.25)}
</style>
