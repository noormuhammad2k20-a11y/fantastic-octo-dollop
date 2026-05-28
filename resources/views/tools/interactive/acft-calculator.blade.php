<div class="row g-4 acft-calculator-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Row 1: Demographics --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Gender Profile</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-success active flex-grow-1 py-2 fw-bold rounded-3 acft-gender-btn" data-gender="male">
                                <i class="fas fa-mars me-2"></i>Male
                            </button>
                            <button type="button" class="btn btn-outline-success flex-grow-1 py-2 fw-bold rounded-3 acft-gender-btn" data-gender="female">
                                <i class="fas fa-venus me-2"></i>Female
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Age Group</label>
                        <select id="acft-age" class="form-select form-select-lg rounded-3">
                            <option value="17-21">17-21 Years</option>
                            <option value="22-26">22-26 Years</option>
                            <option value="27-31" selected>27-31 Years</option>
                            <option value="32-36">32-36 Years</option>
                            <option value="37-41">37-41 Years</option>
                            <option value="42-46">42-46 Years</option>
                            <option value="47-51">47-51 Years</option>
                            <option value="52-56">52-56 Years</option>
                            <option value="57-61">57-61 Years</option>
                            <option value="62+">62+ Years</option>
                        </select>
                    </div>

                    {{-- Row 2: Events 1-3 --}}
                    <div class="col-md-4">
                        <label class="form-label-custom">MDL <span class="text-lowercase text-muted fw-normal ml-1">(Max Deadlift)</span></label>
                        <div class="input-group">
                            <input type="number" id="acft-mdl" class="form-control form-control-lg rounded-start-3" value="140" placeholder="Lbs">
                            <span class="input-group-text rounded-end-3 bg-light text-muted fw-bold">lbs</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">SPT <span class="text-lowercase text-muted fw-normal ml-1">(Standing Power Throw)</span></label>
                        <div class="input-group">
                            <input type="number" id="acft-spt" class="form-control form-control-lg rounded-start-3" value="4.5" step="0.1" placeholder="Meters">
                            <span class="input-group-text rounded-end-3 bg-light text-muted fw-bold">m</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">HRP <span class="text-lowercase text-muted fw-normal ml-1">(Hand-Release Push-up)</span></label>
                        <div class="input-group">
                            <input type="number" id="acft-hrp" class="form-control form-control-lg rounded-start-3 rounded-end-3" value="10" placeholder="Reps">
                        </div>
                    </div>

                    {{-- Row 3: Events 4-6 --}}
                    <div class="col-md-4">
                        <label class="form-label-custom">SDC <span class="text-lowercase text-muted fw-normal ml-1">(Sprint-Drag-Carry)</span></label>
                        <div class="input-group">
                            <input type="number" id="acft-sdc-min" class="form-control form-control-lg rounded-start-3" value="3" placeholder="Min">
                            <span class="input-group-text bg-light border-start-0 border-end-0 text-muted">:</span>
                            <input type="number" id="acft-sdc-sec" class="form-control form-control-lg border-start-0 rounded-end-3" value="0" placeholder="Sec">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">PLK <span class="text-lowercase text-muted fw-normal ml-1">(Plank)</span></label>
                        <div class="input-group">
                            <input type="number" id="acft-plk-min" class="form-control form-control-lg rounded-start-3" value="2" placeholder="Min">
                            <span class="input-group-text bg-light border-start-0 border-end-0 text-muted">:</span>
                            <input type="number" id="acft-plk-sec" class="form-control form-control-lg border-start-0 rounded-end-3" value="9" placeholder="Sec">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">2MR <span class="text-lowercase text-muted fw-normal ml-1">(2-Mile Run)</span></label>
                        <div class="input-group">
                            <input type="number" id="acft-run-min" class="form-control form-control-lg rounded-start-3" value="22" placeholder="Min">
                            <span class="input-group-text bg-light border-start-0 border-end-0 text-muted">:</span>
                            <input type="number" id="acft-run-sec" class="form-control form-control-lg border-start-0 rounded-end-3" value="0" placeholder="Sec">
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 acft-quick" data-p="min">🟢 Minimum Passing</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 acft-quick" data-p="avg">🟡 Average (~450)</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 acft-quick" data-p="max">🔥 Max Score (600)</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:142;--tool-color:#16a34a;--tool-bg:rgba(22,163,74,.04);">
            <div class="output-hero">
                <span class="output-hero-label">TOTAL ACFT SCORE</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-acft-total">360</span>
                    <span class="output-hero-unit">/ 600</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-acft-status">Result: Passing</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-6 col-md-2 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.6rem;">MDL</span>
                        <span class="stat-card-value text-dark" id="s-mdl">60</span>
                    </div>
                </div>
                <div class="col-6 col-md-2 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.6rem;">SPT</span>
                        <span class="stat-card-value text-dark" id="s-spt">60</span>
                    </div>
                </div>
                <div class="col-6 col-md-2 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.6rem;">HRP</span>
                        <span class="stat-card-value text-dark" id="s-hrp">60</span>
                    </div>
                </div>
                <div class="col-6 col-md-2 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.6rem;">SDC</span>
                        <span class="stat-card-value text-dark" id="s-sdc">60</span>
                    </div>
                </div>
                <div class="col-6 col-md-2 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.6rem;">PLK</span>
                        <span class="stat-card-value text-dark" id="s-plk">60</span>
                    </div>
                </div>
                <div class="col-6 col-md-2 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.6rem;">2MR</span>
                        <span class="stat-card-value text-dark" id="s-run">60</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-clipboard-list text-primary me-2"></i>Performance Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="acft-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-success"></i>Copy PT Scorecard
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="acft-reset" style="min-width: 280px; max-width: 100%;">Reset Fields</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="acft-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Score
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const ageE = $('acft-age'), mdlE = $('acft-mdl'), sptE = $('acft-spt'), hrpE = $('acft-hrp'),
          sdcMinE = $('acft-sdc-min'), sdcSecE = $('acft-sdc-sec'),
          plkMinE = $('acft-plk-min'), plkSecE = $('acft-plk-sec'),
          runMinE = $('acft-run-min'), runSecE = $('acft-run-sec');
    
    let gender = 'male';

    function calcACFT() {
        const mdl = parseInt(mdlE.value) || 0;
        const spt = parseFloat(sptE.value) || 0;
        const hrp = parseInt(hrpE.value) || 0;
        
        const sdc = (parseInt(sdcMinE.value)||0)*60 + (parseInt(sdcSecE.value)||0);
        const plk = (parseInt(plkMinE.value)||0)*60 + (parseInt(plkSecE.value)||0);
        const run = (parseInt(runMinE.value)||0)*60 + (parseInt(runSecE.value)||0);

        // Approximate scoring logic matching previous implementation
        let s_mdl = Math.min(100, Math.max(0, Math.round(((mdl - 140)/(340 - 140)*40)+60)));
        if(mdl < 140) s_mdl = 0;

        let s_spt = Math.min(100, Math.max(0, Math.round(((spt - 4.5)/(12.5 - 4.5)*40)+60)));
        if(spt < 4.5) s_spt = 0;

        let s_hrp = Math.min(100, Math.max(0, Math.round(((hrp - 10)/(60 - 10)*40)+60)));
        if(hrp < 10) s_hrp = 0;

        const sdc_max = gender === 'female' ? 210 : 180;
        const sdc_min = gender === 'female' ? 110 : 93;
        let s_sdc = Math.min(100, Math.max(0, Math.round(100 - ((sdc - sdc_min)/(sdc_max - sdc_min)*40))));
        if(sdc > sdc_max) s_sdc = 0;

        let s_plk = Math.min(100, Math.max(0, Math.round(((plk - 129)/(260 - 129)*40)+60)));
        if(plk < 129) s_plk = 0;

        const run_max = gender === 'female' ? 1500 : 1320;
        const run_min = gender === 'female' ? 950 : 802;
        let s_run = Math.min(100, Math.max(0, Math.round(100 - ((run - run_min)/(run_max - run_min)*40))));
        if(run > run_max) s_run = 0;

        const total = s_mdl + s_spt + s_hrp + s_sdc + s_plk + s_run;

        $('out-acft-total').textContent = total;
        $('s-mdl').textContent = s_mdl; $('s-spt').textContent = s_spt;
        $('s-hrp').textContent = s_hrp; $('s-sdc').textContent = s_sdc;
        $('s-plk').textContent = s_plk; $('s-run').textContent = s_run;

        let status = "Needs Improvement";
        if(total >= 540) status = "Elite Performance";
        else if(total >= 480) status = "Outstanding";
        else if(total >= 420) status = "Excellent";
        else if(total >= 360) status = "Passing";
        $('out-acft-status').textContent = `Result: ${status}`;

        const ins = [];
        if(s_mdl<60 || s_spt<60 || s_hrp<60 || s_sdc<60 || s_plk<60 || s_run<60) {
            ins.push('<span class="text-danger"><i class="fas fa-times-circle me-1"></i> Failing Event Detected. Minimum of 60 points required per event.</span>');
            $('out-acft-status').textContent = `Result: Failing`;
            $('out-acft-total').style.color = '#ef4444';
        } else {
            ins.push('<span class="text-success"><i class="fas fa-check-circle me-1"></i> You reached the minimum passing score across all 6 events.</span>');
            $('out-acft-total').style.color = '';
        }
        
        let weakest = Math.min(s_mdl, s_spt, s_hrp, s_sdc, s_plk, s_run);
        if(weakest >= 60) ins.push(`Lowest performing event scored ${weakest} points. Prioritize this movement pattern.`);
        if(total >= 540) ins.push('You are performing at the highest tier across the cohort.');

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2">${i}</li>`).join('')}</ul>`;
    }

    [ageE, mdlE, sptE, hrpE, sdcMinE, sdcSecE, plkMinE, plkSecE, runMinE, runSecE].forEach(el => {
        el.addEventListener('input', calcACFT);
    });

    document.querySelectorAll('.acft-gender-btn').forEach(btn => {
        btn.addEventListener('click', ()=>{
            gender = btn.dataset.gender;
            document.querySelectorAll('.acft-gender-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            calcACFT();
        });
    });

    document.querySelectorAll('.acft-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            let t = btn.dataset.p;
            if(t === 'min') {
                mdlE.value=140; sptE.value=4.5; hrpE.value=10;
                sdcMinE.value=3; sdcSecE.value=0; plkMinE.value=2; plkSecE.value=9; runMinE.value=22; runSecE.value=0;
                if(gender==='female'){sdcMinE.value=3; sdcSecE.value=30; runMinE.value=25;}
            } else if (t === 'avg') {
                mdlE.value=200; sptE.value=7.5; hrpE.value=30;
                sdcMinE.value=2; sdcSecE.value=15; plkMinE.value=3; plkSecE.value=15; runMinE.value=18; runSecE.value=0;
            } else if (t === 'max') {
                mdlE.value=340; sptE.value=12.5; hrpE.value=60;
                sdcMinE.value=1; sdcSecE.value=33; plkMinE.value=4; plkSecE.value=20; runMinE.value=13; runSecE.value=22;
                if(gender==='female'){sdcMinE.value=1; sdcSecE.value=50; runMinE.value=15; runSecE.value=50;}
            }
            calcACFT();
        });
    });

    $('acft-reset').addEventListener('click', ()=>{
        mdlE.value=0; sptE.value=0; hrpE.value=0;
        sdcMinE.value=0; sdcSecE.value=0; plkMinE.value=0; plkSecE.value=0; runMinE.value=0; runSecE.value=0;
        calcACFT();
    });

    $('acft-copy-btn').addEventListener('click', function(){
        const text = `ACFT Scorecard\nTotal Score: ${$('out-acft-total').textContent}/600\nResult: ${$('out-acft-status').textContent.split(': ')[1]}\nMDL:${$('s-mdl').textContent} SPT:${$('s-spt').textContent} HRP:${$('s-hrp').textContent}\nSDC:${$('s-sdc').textContent} PLK:${$('s-plk').textContent} 2MR:${$('s-run').textContent}\nGenerated via ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calcACFT();
});
</script>

<style>
.acft-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(22,163,74,.05)}
.acft-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.acft-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.acft-calculator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.acft-calculator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.acft-calculator-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.acft-calculator-rebuilt .btn-outline-success{border-color:#16a34a; color:#16a34a; border-width:2.5px}
.acft-calculator-rebuilt .btn-outline-success.active{background-color:#16a34a; border-color:#16a34a; color:#fff}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{border:2.5px solid #f1f5f9;border-radius:16px;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1px;margin-bottom:4px}
.stat-card-value{font-size:1.5rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .acft-calculator-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
