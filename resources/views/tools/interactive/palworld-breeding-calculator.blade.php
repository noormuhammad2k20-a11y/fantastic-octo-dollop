<div class="row g-4 palworld-calculator-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4 border-bottom pb-4 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light border-info-subtle">
                            <h6 class="fw-bold mb-3 text-info"><i class="fas fa-mars me-2"></i>Male Parent Info</h6>
                            <label class="form-label-custom">Breeding Power (Hidden Stat)</label>
                            <input type="number" id="pal-p1" class="form-control form-control-lg border-info-subtle mb-3" value="300" min="10" max="1500">
                            
                            <label class="form-label-custom">Has Desired Passive 1? (e.g. Legend)</label>
                            <select id="pal-p1-s1" class="form-select border-info-subtle">
                                <option value="yes" selected>Yes, possesses skill</option>
                                <option value="no">No, does not</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light border-danger-subtle">
                            <h6 class="fw-bold mb-3 text-danger"><i class="fas fa-venus me-2"></i>Female Parent Info</h6>
                            <label class="form-label-custom">Breeding Power (Hidden Stat)</label>
                            <input type="number" id="pal-p2" class="form-control form-control-lg border-danger-subtle mb-3" value="50" min="10" max="1500">
                            
                            <label class="form-label-custom">Has Desired Passive 2? (e.g. Musclehead)</label>
                            <select id="pal-p2-s1" class="form-select border-danger-subtle">
                                <option value="yes">Yes, possesses skill</option>
                                <option value="no" selected>No, does not</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Extraneous Passives (Both Parents)</label>
                        <select id="pal-junk" class="form-select form-select-lg border-secondary-subtle">
                            <option value="0" selected>0 (Perfect Parents)</option>
                            <option value="1">1 Random Passive</option>
                            <option value="2">2+ Random Passives</option>
                            <option value="4">4+ Random Passives (Bad Pool)</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-auto">
                        <div class="form-check form-switch card p-3 flex-grow-1 shadow-sm bg-light border-0">
                            <input class="form-check-input ms-0 me-2" type="checkbox" id="pal-inc">
                            <label class="form-check-label fw-bold d-block text-dark mt-1" for="pal-inc">Use Cake / Incubator Boost</label>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 pt-3 border-top d-flex gap-2 w-100 flex-wrap">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 pal-quick" data-p1="350" data-p2="350" data-s1="yes" data-s2="yes" data-j="0">Anubis (Perfect 2-Skill Pair)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 pal-quick" data-p1="10" data-p2="150" data-s1="no" data-s2="no" data-j="4">Jetragon (Wild Capture Pool)</button>
                    <button type="button" class="btn btn-primary rounded-pill px-5 fw-bold ms-auto" id="pal-calc-btn" style="min-width: 280px; max-width: 100%;">Predict Offspring</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="pal-output-card" style="--tool-hue:171;--tool-color:#14b8a6;--tool-bg:rgba(20,184,166,.04);">
            <div class="output-hero mb-2">
                <span class="output-hero-label text-uppercase">OFFSPRING BREEDING POWER</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-power" style="font-size:5rem;">0</span>
                </div>
                <div class="mt-2 text-dark fw-bold small">Rarity Tier: <span id="out-tier" class="text-teal">Common</span></div>
            </div>

            <div class="row mt-4 justify-content-center g-3">
                <div class="col-md-5">
                    <div class="stat-card" style="border-top: 5px solid #a855f7; background: white;">
                        <span class="stat-card-label text-start" style="color:#a855f7;">Chance to Inherit P1 Skill</span>
                        <span class="stat-card-value text-dark text-center mt-2 pt-1 border-top" id="out-chance1">0%</span>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="stat-card" style="border-top: 5px solid #f59e0b; background: white;">
                        <span class="stat-card-label text-start text-warning">Chance to Inherit Both</span>
                        <span class="stat-card-value text-dark text-center mt-2 pt-1 border-top" id="out-chance2">0%</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-dna text-success me-2"></i>Genetics Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark fw-bold mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="pal-copy-btn" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-share-alt me-2 text-info"></i>Share Breeding Strategy
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const p1E = $('pal-p1'), p2E = $('pal-p2');
    const s1E = $('pal-p1-s1'), s2E = $('pal-p2-s1'), junkE = $('pal-junk');

    function calculate() {
        const p1 = parseInt(p1E.value) || 0;
        const p2 = parseInt(p2E.value) || 0;
        
        // Exact Palworld Breeding Math: Child Power = Floor((P1 + P2) / 2)
        const childPower = Math.floor((p1 + p2) / 2);
        $('out-power').textContent = childPower;

        const outCard = $('pal-output-card');
        const tierEl = $('out-tier');

        if(childPower <= 150) {
            tierEl.textContent = "Legendary / End-Game";
            tierEl.style.color = '#a855f7';
            outCard.style.setProperty('--tool-hue', '285');
            outCard.style.setProperty('--tool-color', '#a855f7');
        } else if (childPower <= 500) {
            tierEl.textContent = "Rare / Mid-Game";
            tierEl.style.color = '#3b82f6';
            outCard.style.setProperty('--tool-hue', '210');
            outCard.style.setProperty('--tool-color', '#3b82f6');
        } else {
            tierEl.textContent = "Common / Early-Game";
            tierEl.style.color = '#14b8a6';
            outCard.style.setProperty('--tool-hue', '171');
            outCard.style.setProperty('--tool-color', '#14b8a6');
        }

        // Inheritance logic (approximate datamined probabilities)
        let has1 = s1E.value === 'yes';
        let has2 = s2E.value === 'yes';
        let junk = parseInt(junkE.value);
        
        // Base chances
        let chance1 = 0;
        let chanceBoth = 0;

        if (has1 && !has2) {
            chance1 = 40;
            chanceBoth = 0;
        } else if (!has1 && has2) {
            chance1 = 0;
            chanceBoth = 0;
        } else if (has1 && has2) {
            chance1 = 40;
            chanceBoth = 20; // Harder to get exactly both
        }

        // Junk pool dilutes inheritance heavily
        if (junk === 1) {
            chance1 *= 0.8;
            chanceBoth *= 0.5;
        } else if (junk === 2) {
            chance1 *= 0.5;
            chanceBoth *= 0.2;
        } else if (junk >= 4) {
            chance1 *= 0.2;
            chanceBoth *= 0.05;
        }

        $('out-chance1').textContent = Math.round(chance1) + "%";
        $('out-chance2').textContent = has1 && has2 ? Math.round(chanceBoth) + "%" : "0%";

        const ins = [];
        ins.push(`The resulting child will attempt to locate a Pal in the database with a Breeding Power as close to <strong>${childPower}</strong> as possible.`);
        
        if (junk > 0) {
            ins.push(`<strong>Warning:</strong> You have junk passives in the breeding pool. This severely dilutes the probability of passing down your desired traits. Try breeding these parents with blank pals first to isolate the desired skills.`);
        }

        if (has1 && has2 && junk === 0) {
            ins.push(`This is a perfectly isolated breeding pair. You have maximized the mathematical odds of passing down both target skills.`);
        }

        if (childPower < 150) {
            ins.push(`This breeding combination targets elite/legendary Pals (e.g., Jetragon, Frostallion, or Blazamut).`);
        } else if (childPower > 1000) {
            ins.push(`This combination yields very common Pals (e.g., Chikipi or Lamball).`);
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-flask text-teal me-2 mt-1" style="color:#14b8a6"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [p1E, p2E, s1E, s2E, junkE].forEach(el => {
        el.addEventListener('input', calculate);
        el.addEventListener('change', calculate);
    });

    $('pal-calc-btn').addEventListener('click', calculate);

    document.querySelectorAll('.pal-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            p1E.value = btn.dataset.p1;
            p2E.value = btn.dataset.p2;
            s1E.value = btn.dataset.s1;
            s2E.value = btn.dataset.s2;
            junkE.value = btn.dataset.j;
            calculate();
        });
    });

    $('pal-copy-btn').addEventListener('click', function(){
        const text = `Breed: ${p1E.value} + ${p2E.value}\nTarget Power: ${$('out-power').textContent}\nTier: ${$('out-tier').textContent}\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2 text-success"></i> Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.palworld-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(20,184,166,.05)}
.palworld-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.palworld-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.palworld-calculator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.palworld-calculator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.palworld-calculator-rebuilt .form-label-custom{font-size:.70rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}
.text-teal { color: #14b8a6; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); transition: all 0.3s ease;}
.output-hero{text-align:center;padding:1.5rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.85rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem; color:var(--tool-color);}
.output-hero-value{font-weight:900;line-height:1; letter-spacing: -2px;}
.stat-card{background:#fff;border:1px solid #f1f5f9;border-radius:12px;padding:1.5rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%; box-shadow: 0 4px 6px rgba(0,0,0,0.02);}
.stat-card:hover { transform: translateY(-3px); }
.stat-card-label{display:block;font-size:.60rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;margin-bottom:5px;}
.stat-card-value{font-weight:900;display:block;line-height:1.2; font-size:2.5rem; letter-spacing: -1px;}

@media (max-width: 768px) {
    .palworld-calculator-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem !important; }
}
</style>

