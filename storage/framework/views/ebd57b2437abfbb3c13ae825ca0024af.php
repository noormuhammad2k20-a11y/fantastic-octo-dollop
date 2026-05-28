<div class="row g-4 combat-calculator-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4 border-bottom pb-4 mb-4">
                    <div class="col-12">
                        <label class="form-label-custom">Select Game Engine</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-dark active flex-grow-1 py-3 fw-bold rounded-3 com-engine-btn" data-engine="osrs">
                                <i class="fas fa-dragon me-2"></i>Old School RuneScape
                            </button>
                            <button type="button" class="btn btn-outline-dark flex-grow-1 py-3 fw-bold rounded-3 com-engine-btn" data-engine="blox">
                                <i class="fas fa-ship me-2"></i>Blox Fruits
                            </button>
                        </div>
                    </div>
                </div>

                <!-- OSRS INPUTS -->
                <div id="osrs-module" class="engine-module row g-3">
                    <div class="col-12 mb-2"><h6 class="fw-bold text-dark"><i class="fas fa-fist-raised me-2 text-warning"></i>Combat Skills</h6></div>
                    
                    <div class="col-4 col-md-3">
                        <label class="form-label-custom text-muted">Attack</label>
                        <input type="number" id="osrs-att" class="form-control form-control-lg rounded-3 border-secondary-subtle" value="1" min="1" max="99">
                    </div>
                    <div class="col-4 col-md-3">
                        <label class="form-label-custom text-muted">Strength</label>
                        <input type="number" id="osrs-str" class="form-control form-control-lg rounded-3 border-secondary-subtle" value="1" min="1" max="99">
                    </div>
                    <div class="col-4 col-md-3">
                        <label class="form-label-custom text-muted">Defence</label>
                        <input type="number" id="osrs-def" class="form-control form-control-lg rounded-3 border-secondary-subtle" value="1" min="1" max="99">
                    </div>
                    <div class="col-4 col-md-3">
                        <label class="form-label-custom text-muted">Hitpoints</label>
                        <input type="number" id="osrs-hp" class="form-control form-control-lg rounded-3 border-danger-subtle" value="10" min="10" max="99">
                    </div>
                    <div class="col-4 col-md-4">
                        <label class="form-label-custom text-muted">Ranged</label>
                        <input type="number" id="osrs-rng" class="form-control form-control-lg rounded-3 border-success-subtle" value="1" min="1" max="99">
                    </div>
                    <div class="col-4 col-md-4">
                        <label class="form-label-custom text-muted">Magic</label>
                        <input type="number" id="osrs-mag" class="form-control form-control-lg rounded-3 border-primary-subtle" value="1" min="1" max="99">
                    </div>
                    <div class="col-4 col-md-4">
                        <label class="form-label-custom text-muted">Prayer</label>
                        <input type="number" id="osrs-pry" class="form-control form-control-lg rounded-3 border-warning-subtle" value="1" min="1" max="99">
                    </div>

                    <div class="col-12 mt-4 mt-md-3">
                        <div class="form-check form-switch card p-3 flex-grow-1 shadow-sm bg-light">
                            <input class="form-check-input ms-0 me-2 border-dark" type="checkbox" id="osrs-potions">
                            <label class="form-check-label fw-bold" for="osrs-potions">Assume Super Combat / Ranging Potions active</label>
                        </div>
                    </div>
                </div>

                <!-- BLOX FRUITS INPUTS -->
                <div id="blox-module" class="engine-module row g-3" style="display:none;">
                    <div class="col-12 mb-2"><h6 class="fw-bold text-dark"><i class="fas fa-meteor me-2 text-danger"></i>Stat Points</h6></div>
                    
                    <div class="col-6 col-md-3">
                        <label class="form-label-custom text-muted">Melee</label>
                        <input type="number" id="bx-melee" class="form-control form-control-lg rounded-3 border-danger-subtle" value="1" min="1" max="2550">
                    </div>
                    <div class="col-6 col-md-3">
                        <label class="form-label-custom text-muted">Defense</label>
                        <input type="number" id="bx-def" class="form-control form-control-lg rounded-3 border-primary-subtle" value="1" min="1" max="2550">
                    </div>
                    <div class="col-6 col-md-3">
                        <label class="form-label-custom text-muted">Sword</label>
                        <input type="number" id="bx-sword" class="form-control form-control-lg rounded-3 border-secondary-subtle" value="1" min="1" max="2550">
                    </div>
                    <div class="col-6 col-md-3">
                        <label class="form-label-custom text-muted">Fruit</label>
                        <input type="number" id="bx-fruit" class="form-control form-control-lg rounded-3 border-warning-subtle" value="1" min="1" max="2550">
                    </div>

                    <div class="col-md-6 mt-4">
                        <label class="form-label-custom">Accessory Buffs</label>
                        <select id="bx-accessory" class="form-select form-select-lg rounded-3">
                            <option value="1">No Accessory (1x)</option>
                            <option value="1.1">+10% Damage (Hunter Cape)</option>
                            <option value="1.15">+15% Fruit/Sword Damage</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6 mt-4">
                        <label class="form-label-custom">Race V4 Awakening</label>
                        <div class="form-check form-switch card p-3 flex-grow-1 shadow-sm bg-light">
                            <input class="form-check-input ms-0 me-2 border-danger" type="checkbox" id="bx-v4">
                            <label class="form-check-label fw-bold text-danger" for="bx-v4">V4 Active (+10% Stats)</label>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex gap-2 w-100 flex-wrap">
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-4 me-auto" id="com-reset" style="min-width: 280px; max-width: 100%;">Reset Stats</button>
                    <button type="button" class="btn btn-dark rounded-pill px-5 fw-bold" id="com-calc-btn" style="min-width: 280px; max-width: 100%;">Load Engine Result</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="com-output-card" style="--tool-hue:292;--tool-color:#d946ef;--tool-bg:rgba(217,70,239,.04);">
            <div class="output-hero">
                <span class="output-hero-label text-uppercase" id="out-hero-label">OSRS COMBAT LEVEL</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-hero-val" style="font-size:5rem;">3</span>
                </div>
                <div class="mt-2 text-dark fw-bold small">Tier Bracket: <span id="out-tier" class="text-primary">Novice</span></div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 5px solid #64748b; background: white;">
                        <span class="stat-card-label text-start" id="stat1-label">Base Defensive Lv</span>
                        <span class="stat-card-value text-dark text-start mt-2 pt-1 border-top" id="stat1-val">1</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 5px solid #ef4444; background: white;">
                        <span class="stat-card-label text-start" id="stat2-label">Melee DPS Rating</span>
                        <span class="stat-card-value text-dark text-start mt-2 pt-1 border-top" id="stat2-val">1</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 5px solid #f59e0b; background: white;">
                        <span class="stat-card-label text-start" id="stat3-label">Combat Class</span>
                        <span class="stat-card-value text-dark text-start mt-2 pt-1 border-top" id="stat3-val" style="font-size:1.1rem">Balanced</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-crosshairs text-dark me-2"></i>Build Insights
                </h6>
                <div id="out-insights" class="small text-secondary">
                    <!-- Javascript replaces this -->
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="com-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Build Export
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="com-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Build Profile
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    let activeEngine = 'osrs';

    const osrsMods = { a:$('osrs-att'), s:$('osrs-str'), d:$('osrs-def'), h:$('osrs-hp'), r:$('osrs-rng'), m:$('osrs-mag'), p:$('osrs-pry'), pots:$('osrs-potions') };
    const bxMods = { m:$('bx-melee'), d:$('bx-def'), s:$('bx-sword'), f:$('bx-fruit'), v4:$('bx-v4'), acc:$('bx-accessory') };

    function clamp(val, min, max) { return Math.max(min, Math.min(max, val)); }

    function calculate() {
        const outCard = $('com-output-card');
        const ins = [];

        if (activeEngine === 'osrs') {
            outCard.style.setProperty('--tool-hue', '40');
            outCard.style.setProperty('--tool-color', '#fbbf24');
            $('out-hero-label').textContent = "OSRS COMBAT LEVEL";
            
            const a = clamp(parseInt(osrsMods.a.value)||1, 1, 99);
            const s = clamp(parseInt(osrsMods.s.value)||1, 1, 99);
            const d = clamp(parseInt(osrsMods.d.value)||1, 1, 99);
            const h = clamp(parseInt(osrsMods.h.value)||10, 10, 99);
            const r = clamp(parseInt(osrsMods.r.value)||1, 1, 99);
            const m = clamp(parseInt(osrsMods.m.value)||1, 1, 99);
            const p = clamp(parseInt(osrsMods.p.value)||1, 1, 99);
            
            const base = 0.25 * (d + h + Math.floor(p/2));
            const melee = 0.325 * (a + s);
            const range = 0.325 * (Math.floor(r * 1.5));
            const mage = 0.325 * (Math.floor(m * 1.5));

            const final = Math.floor(base + Math.max(melee, range, mage));
            $('out-hero-val').textContent = final;

            $('stat1-label').textContent = 'Base Defensive Rating';
            $('stat1-val').textContent = Math.floor(base);
            $('stat2-label').textContent = 'Highest Offense';
            $('stat2-val').textContent = parseFloat(Math.max(melee, range, mage).toFixed(1));
            
            let cclass = "Melee Dominant";
            if(range > melee && range > mage) cclass = "Range Dominant";
            if(mage > melee && mage > range) cclass = "Magic Dominant";
            if(Math.abs(melee - range) < 2 || Math.abs(melee - mage) < 2) cclass = "Hybrid / Tribrided";
            
            $('stat3-label').textContent = 'Combat Class';
            $('stat3-val').textContent = cclass;

            let tier = "Novice (Lv 3-30)";
            if(final > 30) tier = "Adept (Lv 31-70)";
            if(final > 70) tier = "Veteran (Lv 71-100)";
            if(final > 100) tier = "Elite (Lv 101-125)";
            if(final === 126) tier = "Maxed (Lv 126)";
            $('out-tier').textContent = tier;

            ins.push(`Your combat level is highly dependent on your <strong>${cclass.split(' ')[0]}</strong> skills.`);
            if(melee > range && melee > mage) ins.push("Leveling Attack and Strength yields the fastest combat level increases for your build.");
            if(osrsMods.pots.checked) ins.push("With Super Combat potions active, your effective melee damage rolls increase by approx 18-20%. Ensure your prayer flicking timing adapts to the boosted max hits.");

        } else if (activeEngine === 'blox') {
            outCard.style.setProperty('--tool-hue', '220');
            outCard.style.setProperty('--tool-color', '#3b82f6');
            $('out-hero-label').textContent = "TOTAL BLOX FRUIT MASTERY";

            let m = clamp(parseInt(bxMods.m.value)||1, 1, 2550);
            let d = clamp(parseInt(bxMods.d.value)||1, 1, 2550);
            let s = clamp(parseInt(bxMods.s.value)||1, 1, 2550);
            let f = clamp(parseInt(bxMods.f.value)||1, 1, 2550);

            let mult = parseFloat(bxMods.acc.value);
            if(bxMods.v4.checked) mult += 0.10; // V4 adds 10% stats dynamically to output logic

            const total = m + d + s + f;
            
            $('out-hero-val').textContent = total;

            $('stat1-label').textContent = 'Tank Potential (HP)';
            $('stat1-val').textContent = formatNum(Math.floor((d * 5) * mult)); // Approximate blox HP scaling
            
            $('stat2-label').textContent = 'Energy Output';
            $('stat2-val').textContent = formatNum(Math.floor((m * 5) * mult)); // Approximate stam/energy
            
            // Sub class logic
            let cclass = "Hybrid";
            if (f > s && f > m) cclass = "Fruit Main (Blox)";
            else if (s > f && s > m) cclass = "Sword Main";
            else if (m > f && m > s) cclass = "Melee/Fighting Style";

            $('stat3-label').textContent = 'Primary Build';
            $('stat3-val').textContent = cclass;

            let tier = "Sea 1 (Beginner)";
            if(total > 2000) tier = "Sea 2 (Advanced)";
            if(total > 6000) tier = "Sea 3 (Endgame)";
            if(total >= 10200) tier = "Awakened Max (God)";
            $('out-tier').textContent = tier;

            ins.push(`You are utilizing a <strong>${cclass}</strong> point distribution.`);
            if(mult > 1) ins.push(`Accessory and V4 modifiers are increasing your raw damage and defenses by <strong>${Math.round((mult-1)*100)}%</strong> globally.`);
            if(m < 1000 && total > 3000) ins.push("Warning: Your melee is low, limiting your Dash/Energy generation during PvP combat.");
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-caret-right text-muted me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    function formatNum(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Engine Switcher
    document.querySelectorAll('.com-engine-btn').forEach(btn => {
        btn.addEventListener('click', ()=>{
            document.querySelectorAll('.com-engine-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            activeEngine = btn.dataset.engine;
            
            $('osrs-module').style.display = activeEngine === 'osrs' ? 'flex' : 'none';
            $('blox-module').style.display = activeEngine === 'blox' ? 'flex' : 'none';
            calculate();
        });
    });

    $('com-reset').addEventListener('click', ()=>{
        Object.values(osrsMods).forEach(el => {
            if(el.type === 'checkbox') el.checked=false;
            else el.value = el.id === 'osrs-hp' ? 10 : 1;
        });
        Object.values(bxMods).forEach(el => {
            if(el.type === 'checkbox') el.checked=false;
            else if(el.tagName === 'SELECT') el.value = 1;
            else el.value = 1;
        });
        calculate();
    });

    $('com-calc-btn').addEventListener('click', calculate);

    // Event listeners for automatic calculation
    document.querySelectorAll('.engine-module input, .engine-module select').forEach(el => {
        el.addEventListener('input', calculate);
        el.addEventListener('change', calculate);
    });

    $('com-copy-btn').addEventListener('click', function(){
        const text = `Gaming Combat Export (${activeEngine.toUpperCase()})\nRating: ${$('out-hero-val').textContent}\nTier: ${$('out-tier').textContent}\nBuild: ${$('stat3-val').textContent}\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2 text-success"></i> Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.combat-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(0,0,0,.03)}
.combat-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.combat-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.combat-calculator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.combat-calculator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.combat-calculator-rebuilt .form-label-custom{font-size:.70rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}
.combat-calculator-rebuilt .btn-outline-dark.active{background-color:#212529; color:#fff;}
.combat-calculator-rebuilt .fa-swords { font-family: "Font Awesome 5 Free"; font-weight: 900; content: "\f71d"; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); transition: all 0.3s ease;}
.output-hero{text-align:center;padding:1.5rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.85rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem; color:var(--tool-color);}
.output-hero-value{font-weight:900;line-height:1; letter-spacing: -2px;}
.stat-card{background:#fff;border:1px solid #f1f5f9;border-radius:12px;padding:1.5rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%; box-shadow: 0 4px 6px rgba(0,0,0,0.02);}
.stat-card:hover { transform: translateY(-5px); }
.stat-card-label{display:block;font-size:.60rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;margin-bottom:5px; color:#64748b;}
.stat-card-value{font-weight:900;display:block;line-height:1.2; font-size:1.5rem;}

@media (max-width: 768px) {
    .combat-calculator-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem !important; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\gaming-combat-calculator.blade.php ENDPATH**/ ?>