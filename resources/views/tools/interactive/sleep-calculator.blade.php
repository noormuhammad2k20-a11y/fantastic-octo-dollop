<div class="row g-4 sleep-calc-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Sleep Strategy</label>
                    <div class="d-flex gap-2 flex-wrap">
                        <button type="button" class="btn btn-outline-sleep active flex-grow-1 py-3 fw-bold" data-mode="now"><i class="fas fa-bed me-2"></i>Sleep NOW</button>
                        <button type="button" class="btn btn-outline-sleep flex-grow-1 py-3 fw-bold" data-mode="wake"><i class="fas fa-sun me-2"></i>I Need to Wake up at...</button>
                        <button type="button" class="btn btn-outline-sleep flex-grow-1 py-3 fw-bold" data-mode="bed"><i class="fas fa-clock me-2"></i>I'm Going to bed at...</button>
                    </div>
                </div>

                <div id="sleep-time-input" style="display:none">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label-custom" id="sleep-time-label">Target Time</label>
                            <input type="time" id="sleep-time" class="form-control form-control-lg rounded-3" value="07:00">
                        </div>
                    </div>
                </div>

                <div class="row g-4 mt-1">
                    <div class="col-md-6">
                        <label class="form-label-custom">Demographic Profile</label>
                        <select id="sleep-age" class="form-select form-select-lg rounded-3">
                            <option value="teen">Teen (14-17) — 8-10h</option>
                            <option value="adult" selected>Adult (18-64) — 7-9h</option>
                            <option value="senior">Senior (65+) — 7-8h</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Sleep Latency (Min to Fall Asleep)</label>
                        <input type="number" id="sleep-latency" class="form-control form-control-lg rounded-3" value="15" min="0" max="60" step="5">
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Standard Targets:</span>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 sleep-quick" data-action="wake6">☀️ 6:00 AM</button>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 sleep-quick" data-action="wake7">☀️ 7:00 AM</button>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 sleep-quick" data-action="wake8">☀️ 8:00 AM</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" id="sleep-reset" style="min-width: 280px; max-width: 100%;">Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="sleep-theme" style="--tool-hue:240;--tool-color:#6366f1;--tool-bg:rgba(99,102,241,.06);">
            <div class="output-hero">
                <span class="output-hero-label" id="out-sleep-title">OPTIMAL WAKE TIMES</span>
                <div class="output-hero-value" id="out-sleep-main">—</div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-sleep-subtitle" style="letter-spacing:1px;color:#6366f1;">Assuming Immediate Sleep</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 px-1">
                    <i class="fas fa-layer-group text-primary me-2"></i>Scientific Cycle Options
                </h6>
                <div id="out-sleep-cycles" class="d-flex flex-column gap-3"></div>
            </div>

            <div class="row g-3 mt-4 text-center">
                <div class="col-6">
                    <div class="stat-card" style="border-top: 4px solid #6366f1; background: #fff;">
                        <span class="stat-card-label">REC. DURATION</span>
                        <span class="stat-card-value text-primary" id="out-rec-hours">—</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-card" style="border-top: 4px solid #10b981; background: #fff;">
                        <span class="stat-card-label">ADAPTATION SCORE</span>
                        <span class="stat-card-value text-success" id="out-quality">—</span>
                    </div>
                </div>
            </div>

            <div class="mt-5 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2"></i>Sleep Optimization Insights
                </h6>
                <div class="small text-secondary fw-medium">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i>Humans sleep in 90-minute cycles. Waking at the end of a cycle ensures you feel alert rather than groggy.</li>
                        <li class="d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i>Consistent wake times strengthen the circadian rhythm, leading to faster sleep onset.</li>
                    </ul>
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="sleep-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Sleep Plan
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="sleep-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Analysis
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    let mode='now';
    const timeInput=$('sleep-time'), latencyEl=$('sleep-latency'), ageEl=$('sleep-age');
    const recMap={teen:'8-10h',adult:'7-9h',senior:'7-8h'};
    const recCycles={teen:6,adult:5,senior:5};

    function fmtT(d){return d.toLocaleTimeString([],{hour:'2-digit',minute:'2-digit'})}

    function calculate(){
        const latency = parseInt(latencyEl.value)||15;
        const age = ageEl.value;
        $('out-rec-hours').textContent = recMap[age];
        const cycles=[6,5,4,3];
        let times=[];

        if(mode==='now'){
            $('out-sleep-title').textContent='OPTIMAL WAKE TIMES';
            $('out-sleep-subtitle').textContent='If you go to sleep now';
            const start = new Date();
            times = cycles.map(c=>{const d=new Date(start);d.setMinutes(d.getMinutes()+latency+(c*90));return{time:d,c}});
        } else if(mode==='wake'){
            $('out-sleep-title').textContent='OPTIMAL BEDTIMES';
            $('out-sleep-subtitle').textContent='To wake at '+timeInput.value;
            const [h,m]=timeInput.value.split(':').map(Number);
            const wake=new Date();wake.setHours(h,m,0,0);
            if(wake<new Date()) wake.setDate(wake.getDate()+1);
            times = cycles.map(c=>{const d=new Date(wake);d.setMinutes(d.getMinutes()-latency-(c*90));return{time:d,c}});
        } else {
            $('out-sleep-title').textContent='OPTIMAL WAKE TIMES';
            $('out-sleep-subtitle').textContent='If you go to bed at '+timeInput.value;
            const [h,m]=timeInput.value.split(':').map(Number);
            const bed=new Date();bed.setHours(h,m,0,0);
            if(bed<new Date()) bed.setDate(bed.getDate()+1);
            times = cycles.map(c=>{const d=new Date(bed);d.setMinutes(d.getMinutes()+latency+(c*90));return{time:d,c}});
        }

        $('out-sleep-main').textContent = times.length?fmtT(times[0].time):'—';

        const idealC = recCycles[age]||5;
        $('out-sleep-cycles').innerHTML = times.map((t,i)=>{
            const hrs = (t.c*1.5).toFixed(1);
            const isRec = t.c === idealC;
            return `<div class="p-3 rounded-4 border ${isRec?'border-primary bg-primary-subtle shadow-sm':'bg-white shadow-xs'} d-flex justify-content-between align-items-center transition-all" style="${isRec?'background:rgba(99,102,241,0.08)!important;':''}">
                <div>
                    <span class="fw-900 d-block fs-5 text-dark">${fmtT(t.time)}</span>
                    <span class="small text-muted fw-bold">${t.c} Cycles · ${hrs} Hours</span>
                </div>
                ${isRec?'<span class="badge rounded-pill bg-primary px-3 py-2 fw-bold text-uppercase" style="font-size:0.6rem;letter-spacing:1px;">★ Recommended</span>':'<span class="badge rounded-pill bg-light text-muted border px-3 py-2 fw-bold uppercase" style="font-size:0.6rem;letter-spacing:1px;">Cycle Option</span>'}
            </div>`;
        }).join('');

        const bestC = times[0]?.c||0;
        $('out-quality').textContent = bestC >= 6 ? 'Excellent' : bestC >= 5 ? 'Good' : 'Minimal';
    }

    document.querySelectorAll('[data-mode]').forEach(btn=>{
        btn.onclick = () => {
            mode = btn.dataset.mode;
            document.querySelectorAll('[data-mode]').forEach(b=>b.classList.remove('active'));
            btn.classList.add('active');
            $('sleep-time-input').style.display = mode==='now'?'none':'';
            $('sleep-time-label').textContent = mode==='wake'?'Required Wake Time':'Planned Bedtime';
            calculate();
        };
    });

    [timeInput,latencyEl,ageEl].forEach(e=>e.addEventListener('input',calculate));

    document.querySelectorAll('.sleep-quick').forEach(btn=>{
        btn.onclick = () => {
            document.querySelector('[data-mode="wake"]').click();
            if(btn.dataset.action==='wake6') timeInput.value='06:00';
            if(btn.dataset.action==='wake7') timeInput.value='07:00';
            if(btn.dataset.action==='wake8') timeInput.value='08:00';
            calculate();
        };
    });

    $('sleep-reset').onclick = () => {
        document.querySelector('[data-mode="now"]').click();
        latencyEl.value=15; ageEl.value='adult'; calculate();
    };

    $('sleep-copy-btn').onclick = function(){
        const text = `Personalized Sleep Strategy\nTarget: ${$('out-sleep-main').textContent}\nCycles: ${recCycles[ageEl.value]} Recommended\n— ToolsHub Sleep`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Plan Copied!';
            setTimeout(()=>this.innerHTML=o,2000);
        });
    };

    calculate();
});
</script>

<style>
.sleep-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(99,102,241,.05)}
.sleep-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.sleep-calc-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.sleep-calc-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.sleep-calc-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.sleep-calc-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.btn-outline-sleep{border:2px solid #e0e7ff;color:#4338ca;font-weight:700;border-radius:16px;transition:all .3s cubic-bezier(0.4,0,0.2,1)}
.btn-outline-sleep:hover{background:#eef2ff;border-color:#a5b4fc;color:#4f46e5}
.btn-outline-sleep.active{background:#6366f1;border-color:#6366f1;color:#fff;box-shadow:0 10px 20px rgba(99,102,241,0.2)}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:4.5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:1.5rem;font-weight:800;display:block;line-height:1.2}
.fw-900 { font-weight: 900; }
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .sleep-calc-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3rem; }
}
</style>

