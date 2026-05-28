<div class="row g-4 coc-calculator-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4 border-bottom pb-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Army Camp Capacity</label>
                        <div class="input-group">
                            <input type="number" id="coc-camp" class="form-control form-control-lg border-warning-subtle rounded-start-3" value="280" min="20" max="320">
                            <span class="input-group-text bg-light border-warning-subtle rounded-end-3 text-muted fw-bold">Housing Space</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Spell Factory Capacity</label>
                        <div class="input-group">
                            <input type="number" id="coc-spell-cap" class="form-control form-control-lg border-info-subtle rounded-start-3" value="11" min="2" max="11">
                            <span class="input-group-text bg-light border-info-subtle rounded-end-3 text-muted fw-bold">Slots</span>
                        </div>
                    </div>

                    <div class="col-md-6 mt-4">
                        <div class="form-check form-switch card p-3 flex-grow-1 shadow-sm bg-light border-0 h-100">
                            <input class="form-check-input ms-0 me-2" type="checkbox" id="coc-boost">
                            <label class="form-check-label fw-bold d-block text-dark mt-1" for="coc-boost">Training Potion Boost <br><span class="small text-muted fw-normal">4x Training Speed</span></label>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-check form-switch card p-3 flex-grow-1 shadow-sm bg-light border-0 h-100">
                            <input class="form-check-input ms-0 me-2" type="checkbox" id="coc-gp">
                            <label class="form-check-label fw-bold d-block text-dark mt-1" for="coc-gp">Gold Pass Active <br><span class="small text-muted fw-normal">20% Time/Cost Reduction</span></label>
                        </div>
                    </div>
                </div>

                {{-- Troop Builder --}}
                <div class="row g-3">
                    <div class="col-12 mb-2"><h6 class="fw-bold text-dark"><i class="fas fa-users me-2 text-warning"></i>Troop Composition</h6></div>
                    
                    <div class="col-md-4">
                        <label class="form-label-custom text-muted">Barbarians (1 space)</label>
                        <input type="number" id="t-barb" class="form-control form-control-lg rounded-3 border-secondary-subtle troop-input" value="0" min="0" data-space="1" data-cost="500" data-time="5">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom text-muted">Archers (1 space)</label>
                        <input type="number" id="t-arch" class="form-control form-control-lg rounded-3 border-secondary-subtle troop-input" value="0" min="0" data-space="1" data-cost="1000" data-time="6">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom text-muted">Giants (5 space)</label>
                        <input type="number" id="t-giant" class="form-control form-control-lg rounded-3 border-secondary-subtle troop-input" value="0" min="0" data-space="5" data-cost="4000" data-time="30">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom text-muted">Balloons (5 space)</label>
                        <input type="number" id="t-loon" class="form-control form-control-lg rounded-3 border-secondary-subtle troop-input" value="0" min="0" data-space="5" data-cost="4500" data-time="30">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom text-muted">Wizards (4 space)</label>
                        <input type="number" id="t-wiz" class="form-control form-control-lg rounded-3 border-secondary-subtle troop-input" value="0" min="0" data-space="4" data-cost="4500" data-time="30">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom text-muted">Dragons (20 space)</label>
                        <input type="number" id="t-drag" class="form-control form-control-lg rounded-3 border-secondary-subtle troop-input" value="0" min="0" data-space="20" data-cost="25000" data-time="180">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom text-muted">P.E.K.K.A (25 space)</label>
                        <input type="number" id="t-pekka" class="form-control form-control-lg rounded-3 border-secondary-subtle troop-input" value="0" min="0" data-space="25" data-cost="32000" data-time="180">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom text-muted">Lava Hound (30 space)</label>
                        <input type="number" id="t-lava" class="form-control form-control-lg rounded-3 border-secondary-subtle troop-input border-dark" value="0" min="0" data-space="30" data-cost="0" data-dark="450" data-time="300">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom text-muted">Golem (30 space)</label>
                        <input type="number" id="t-golem" class="form-control form-control-lg rounded-3 border-secondary-subtle troop-input border-dark" value="0" min="0" data-space="30" data-cost="0" data-dark="600" data-time="300">
                    </div>
                </div>

                {{-- Spell Builder --}}
                <div class="row g-3 mt-3">
                    <div class="col-12 mb-2"><h6 class="fw-bold text-dark"><i class="fas fa-flask me-2 text-info"></i>Spells</h6></div>
                    
                    <div class="col-md-3 col-6">
                        <label class="form-label-custom text-info">Lightning (1)</label>
                        <input type="number" class="form-control rounded-3 border-info-subtle spell-input" value="0" min="0" data-space="1" data-cost="28000" data-time="180">
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label-custom text-info">Rage (2)</label>
                        <input type="number" class="form-control rounded-3 border-info-subtle spell-input" value="0" min="0" data-space="2" data-cost="36000" data-time="360">
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label-custom text-info">Heal (2)</label>
                        <input type="number" class="form-control rounded-3 border-info-subtle spell-input" value="0" min="0" data-space="2" data-cost="30000" data-time="360">
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label-custom text-info">Freeze (1)</label>
                        <input type="number" class="form-control rounded-3 border-info-subtle spell-input" value="0" min="0" data-space="1" data-cost="20000" data-time="180">
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 pt-3 border-top d-flex gap-2 w-100 flex-wrap">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 coc-quick" data-troops='{"t-drag":14}' data-spells="[0,4,0,3]" data-camp="280" data-scamp="11">TH11 Mass Dragon</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 coc-quick" data-troops='{"t-golem":2,"t-pekka":3,"t-wiz":15,"t-loon":2}' data-spells="[0,2,2,0]" data-camp="240" data-scamp="9">GoWiPe (Classic)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 coc-quick" data-troops='{"t-lava":3,"t-loon":26}' data-spells="[0,4,0,3]" data-camp="220" data-scamp="11">LavaLoon</button>
                    <button type="button" class="btn btn-primary rounded-pill px-5 fw-bold ms-auto" id="coc-calc-btn" style="min-width: 280px; max-width: 100%;">Analyze Army</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="coc-output-card" style="--tool-hue:45;--tool-color:#eab308;--tool-bg:rgba(234,179,8,.04);">
            <div class="row text-center mb-4 border-bottom pb-4">
                <div class="col-6">
                    <span class="d-block text-uppercase text-warning fw-bold small letter-spacing-1 mb-2">Troop Space</span>
                    <div class="d-flex justify-content-center align-items-baseline gap-1">
                        <span class="fs-1 fw-bold text-dark" id="out-space">0</span>
                        <span class="text-muted fw-bold">/ <span id="out-max-space">280</span></span>
                    </div>
                </div>
                <div class="col-6">
                    <span class="d-block text-uppercase text-info fw-bold small letter-spacing-1 mb-2">Spell Space</span>
                    <div class="d-flex justify-content-center align-items-baseline gap-1">
                        <span class="fs-1 fw-bold text-dark" id="out-s-space">0</span>
                        <span class="text-muted fw-bold">/ <span id="out-max-s-space">11</span></span>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 5px solid #d946ef; background: white;">
                        <span class="stat-card-label text-start" style="color:#d946ef">Total Elixir Cost</span>
                        <span class="stat-card-value text-dark text-start mt-2 pt-1 border-top"><span id="out-elixir">0</span></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 5px solid #111827; background: white;">
                        <span class="stat-card-label text-start text-dark">Dark Elixir Cost</span>
                        <span class="stat-card-value text-dark text-start mt-2 pt-1 border-top"><span id="out-dark">0</span></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 5px solid #eab308; background: white;">
                        <span class="stat-card-label text-start text-warning">Training Time</span>
                        <span class="stat-card-value text-dark text-start mt-2 pt-1 border-top" id="out-time">0m 0s</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-meteor text-dark me-2"></i>Deployment Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="coc-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-warning"></i>Copy Arsenal Request
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="coc-reset" style="min-width: 280px; max-width: 100%;">Wipe Army</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const campE = $('coc-camp'), scampE = $('coc-spell-cap');
    const bPotion = $('coc-boost'), bGp = $('coc-gp');

    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function calculate() {
        let maxC = parseInt(campE.value) || 0;
        let maxS = parseInt(scampE.value) || 0;
        $('out-max-space').textContent = maxC;
        $('out-max-s-space').textContent = maxS;

        let totalSpace = 0;
        let totalElixir = 0;
        let totalDark = 0;
        let maxTrainTime = 0; // In CoC, multiple barracks divide the queue time. Approximation used.
        let totalRawTime = 0;

        // Troops
        document.querySelectorAll('.troop-input').forEach(el => {
            let count = parseInt(el.value) || 0;
            if(count > 0) {
                totalSpace += count * parseInt(el.dataset.space);
                if(el.dataset.cost) totalElixir += count * parseInt(el.dataset.cost);
                if(el.dataset.dark) totalDark += count * parseInt(el.dataset.dark);
                totalRawTime += count * parseInt(el.dataset.time);
            }
        });

        // Spells Space
        let spellSpace = 0;
        document.querySelectorAll('.spell-input').forEach(el => {
            let count = parseInt(el.value) || 0;
            if(count > 0) {
                spellSpace += count * parseInt(el.dataset.space);
                totalElixir += count * parseInt(el.dataset.cost);
                totalRawTime += count * parseInt(el.dataset.time); // Spells queue separately but added into general wait pool for brevity
            }
        });

        // Modifiers
        if(bGp.checked) {
            totalElixir *= 0.8;
            totalDark *= 0.8;
            totalRawTime *= 0.8;
        }

        if(bPotion.checked) {
            totalRawTime /= 4;
        }

        // Divide training time by general barrack efficiency (assuming 4 barracks + 2 dark barracks active simultaneously speeds up).
        // Since summer 2022 update, all troops train in a single queue sequentially, meaning raw time is exact. 
        let finalTimeSecs = totalRawTime;

        $('out-space').textContent = totalSpace;
        $('out-s-space').textContent = spellSpace;
        
        $('out-elixir').textContent = formatNumber(Math.round(totalElixir));
        $('out-dark').textContent = formatNumber(Math.round(totalDark));
        
        let m = Math.floor(finalTimeSecs / 60);
        let s = Math.floor(finalTimeSecs % 60);
        $('out-time').textContent = `${m}m ${s}s`;

        const outCard = $('coc-output-card');
        const ins = [];

        if (totalSpace > maxC) {
            $('out-space').style.color = '#ef4444';
            ins.push('<span class="text-danger fw-bold"><i class="fas fa-exclamation-triangle me-1"></i> You have exceeded your Army Camp capacity! Your queue will stall.</span>');
            outCard.style.setProperty('--tool-hue', '0');
            outCard.style.setProperty('--tool-color', '#ef4444');
        } else {
            $('out-space').style.color = '';
            outCard.style.setProperty('--tool-hue', '45');
            outCard.style.setProperty('--tool-color', '#eab308');
        }

        if (spellSpace > maxS) {
            $('out-s-space').style.color = '#ef4444';
            ins.push('<span class="text-danger fw-bold"><i class="fas fa-exclamation-triangle me-1"></i> You have exceeded your Spell Factory capacity!</span>');
        } else {
            $('out-s-space').style.color = '';
        }

        if (totalDark > 0) {
            ins.push(`This composition drains Dark Elixir (${formatNumber(Math.round(totalDark))}). Ensure your raid yields exceed this cost.`);
        }

        if (bGp.checked) ins.push('Gold Pass 20% discount applied to costs and time.');

        if(ins.length === 0) {
            if(totalSpace === maxC && totalSpace > 0) ins.push("Army camps perfectly maxed. You are ready to attack.");
            else ins.push("Add troops or spells above to generate insights.");
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-caret-right text-muted me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    document.querySelectorAll('.troop-input, .spell-input').forEach(el => {
        el.addEventListener('input', calculate);
        el.addEventListener('change', calculate);
    });

    [campE, scampE, bPotion, bGp].forEach(el => el.addEventListener('change', calculate));

    $('coc-calc-btn').addEventListener('click', calculate);

    $('coc-reset').addEventListener('click', ()=>{
        document.querySelectorAll('.troop-input, .spell-input').forEach(el => el.value = 0);
        calculate();
    });

    document.querySelectorAll('.coc-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            document.querySelectorAll('.troop-input, .spell-input').forEach(el => el.value = 0);
            
            campE.value = btn.dataset.camp;
            scampE.value = btn.dataset.scamp;

            const t = JSON.parse(btn.dataset.troops);
            for(let key in t) {
                if($(key)) $(key).value = t[key];
            }

            const s = JSON.parse(btn.dataset.spells);
            const spells = document.querySelectorAll('.spell-input');
            s.forEach((val, i)=>{
                if(spells[i]) spells[i].value = val;
            });
            
            calculate();
        });
    });

    $('coc-copy-btn').addEventListener('click', function(){
        const text = `Clash of Clans Army Built:\nCapacity: ${$('out-space').textContent}/${campE.value}\nElixir: ${$('out-elixir').textContent}\nDark Elixir: ${$('out-dark').textContent}\nTrain Time: ${$('out-time').textContent}\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2 text-warning"></i> Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.coc-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(234,179,8,.05)}
.coc-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.coc-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.coc-calculator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.coc-calculator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.coc-calculator-rebuilt .form-label-custom{font-size:.70rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); transition: all 0.3s ease;}
.stat-card{background:#fff;border:1px solid #f1f5f9;border-radius:12px;padding:1.5rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%; box-shadow: 0 4px 6px rgba(0,0,0,0.02);}
.stat-card:hover { transform: translateY(-3px); }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;margin-bottom:5px;}
.stat-card-value{font-weight:900;display:block;line-height:1.2; font-size:1.6rem; letter-spacing: -1px;}
.letter-spacing-1 { letter-spacing: 1px;}

@media (max-width: 768px) {
    .coc-calculator-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
}
</style>

