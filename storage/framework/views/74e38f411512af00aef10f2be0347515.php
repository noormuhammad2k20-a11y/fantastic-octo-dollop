<div class="row g-4 pkmn-calculator-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Attacker's Level</label>
                        <input type="number" id="pk-lvl" class="form-control form-control-lg rounded-3 border-danger-subtle" value="50" min="1" max="100">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Attacker Stat (Atk/SpA)</label>
                        <input type="number" id="pk-att" class="form-control form-control-lg rounded-3 border-danger-subtle" value="150" min="1" max="999">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Defender Stat (Def/SpD)</label>
                        <input type="number" id="pk-def" class="form-control form-control-lg rounded-3 border-primary-subtle" value="100" min="1" max="999">
                    </div>

                    
                    <div class="col-md-6 mt-4">
                        <label class="form-label-custom">Move Base Power</label>
                        <div class="input-group">
                            <input type="number" id="pk-pow" class="form-control form-control-lg rounded-start-3 border-secondary-subtle" value="90" min="10" max="300">
                            <span class="input-group-text bg-light rounded-end-3 text-muted fw-bold border-secondary-subtle">BP</span>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label class="form-label-custom">Type Effectiveness</label>
                        <select id="pk-eff" class="form-select form-select-lg rounded-3 border-secondary-subtle">
                            <option value="0.25">4x Resist (0.25x)</option>
                            <option value="0.5">Resisted (0.5x)</option>
                            <option value="1" selected>Neutral (1x)</option>
                            <option value="2">Super Effective (2x)</option>
                            <option value="4">4x Super Effective (4x)</option>
                        </select>
                    </div>

                    
                    <div class="col-md-4 mt-4">
                        <div class="form-check form-switch card p-3 flex-grow-1 shadow-sm bg-light border-0 h-100">
                            <input class="form-check-input ms-0 me-2" type="checkbox" id="pk-stab" checked>
                            <label class="form-check-label fw-bold d-block text-dark mt-1" for="pk-stab">STAB (Same Type) <br><span class="small text-muted fw-normal">1.5x Multiplier</span></label>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-check form-switch card p-3 flex-grow-1 shadow-sm bg-light border-0 h-100">
                            <input class="form-check-input ms-0 me-2" type="checkbox" id="pk-weather">
                            <label class="form-check-label fw-bold d-block text-dark mt-1" for="pk-weather">Weather Boost <br><span class="small text-muted fw-normal">1.5x Multiplier</span></label>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <label class="form-label-custom">Held Item (Attacker)</label>
                        <select id="pk-item" class="form-select border-secondary-subtle p-3">
                            <option value="1" selected>No Damage Item</option>
                            <option value="1.3">Life Orb (1.3x)</option>
                            <option value="1.5">Choice Band/Specs (1.5x)</option>
                            <option value="1.2">Expert Belt (1.2x)</option>
                        </select>
                    </div>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex gap-2 w-100 flex-wrap">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 pk-quick" data-l="50" data-a="150" data-d="100" data-p="90" data-e="1" data-i="13">Standard VGC Setup</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 pk-quick" data-l="100" data-a="300" data-d="200" data-p="120" data-e="2" data-i="15">Nuke (Lv100 / Super Eff / Choice)</button>
                    <button type="button" class="btn btn-primary rounded-pill px-5 fw-bold ms-auto" id="pk-calc-btn" style="min-width: 280px; max-width: 100%;">Roll Damage</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.04);">
            <div class="output-hero">
                <span class="output-hero-label text-uppercase">DAMAGE ESTIMATE (GUARANTEED SPREAD)</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-dmg-min" style="font-size:4rem;">52</span>
                    <span class="fs-2 text-muted fw-bold px-2">-</span>
                    <span class="output-hero-value" id="out-dmg-max" style="font-size:4rem;">62</span>
                </div>
                <div class="mt-2 text-dark fw-bold small">Raw Hit Points Damaged</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <div class="stat-card" style="border-top: 5px solid #ef4444; background: white;">
                        <span class="stat-card-label text-start">Max Roll (100% rng)</span>
                        <span class="stat-card-value text-danger text-start mt-2 pt-1 border-top"><span id="stat-max">62</span> HP</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card" style="border-top: 5px solid #f59e0b; background: white;">
                        <span class="stat-card-label text-start">Min Roll (85% rng)</span>
                        <span class="stat-card-value text-warning text-start mt-2 pt-1 border-top"><span id="stat-min">52</span> HP</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-chart-line text-dark me-2"></i>Competitive Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="pk-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Calc to Clipboard
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="pk-reset" style="min-width: 280px; max-width: 100%;">Reset Stats</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="pk-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Battle Output
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const lvlE = $('pk-lvl'), attE = $('pk-att'), defE = $('pk-def'), powE = $('pk-pow'),
          effE = $('pk-eff'), itemE = $('pk-item'), stabE = $('pk-stab'), weathE = $('pk-weather');

    function calculate() {
        const L = parseInt(lvlE.value) || 50;
        const A = parseInt(attE.value) || 1;
        const D = parseInt(defE.value) || 1;
        const P = parseInt(powE.value) || 0;
        
        let modifier = parseFloat(effE.value);
        if(stabE.checked) modifier *= 1.5;
        if(weathE.checked) modifier *= 1.5;
        modifier *= parseFloat(itemE.value);

        // Core Pokemon Damage Formula:
        // Damage = ((((2 * Level / 5 + 2) * AttackStat * AttackPower / DefenseStat) / 50) + 2) * STAB * Weakness/Resistance * RandomNumber / 100
        const base = Math.floor( Math.floor( Math.floor(2 * L / 5 + 2) * P * A / D ) / 50 ) + 2;
        
        const rawWithMods = base * modifier;
        
        const minRoll = Math.floor(rawWithMods * 0.85);
        const maxRoll = Math.floor(rawWithMods * 1.00);

        $('out-dmg-min').textContent = minRoll;
        $('out-dmg-max').textContent = maxRoll;
        $('stat-min').textContent = minRoll;
        $('stat-max').textContent = maxRoll;

        const maxPctRaw = (100).toFixed(1);

        const ins = [];
        if(parseFloat(effE.value) > 1) {
            ins.push(`Super Effective hit identified. You are dealing exactly <strong>${effE.value}x</strong> critical weakness damage.`);
        } else if (parseFloat(effE.value) < 1) {
            ins.push(`Warning: The defender resists this move. Damage is severely throttled to <strong>${effE.value}x</strong>.`);
        }
        
        if (parseFloat(itemE.value) > 1) {
            ins.push(`Your Held Item is augmenting raw output by ${Math.round((parseFloat(itemE.value)-1)*100)}%.`);
        }

        if (maxRoll < 50 && L >= 50) {
            ins.push(`This is a very weak hit for competitive environments. Consider Swords Dance / Nasty Plot setup or switching your defender target.`);
        } else if (maxRoll > 150) {
            ins.push(`This is a massive damage roll. Highly likely to OHKO (One-Hit-Knockout) sweepers and frail attackers.`);
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-info-circle text-muted me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [lvlE, attE, defE, powE, effE, itemE, stabE, weathE].forEach(el => {
        el.addEventListener('input', calculate);
        el.addEventListener('change', calculate);
    });
    
    $('pk-calc-btn').addEventListener('click', calculate);

    document.querySelectorAll('.pk-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            lvlE.value = btn.dataset.l;
            attE.value = btn.dataset.a;
            defE.value = btn.dataset.d;
            powE.value = btn.dataset.p;
            effE.value = btn.dataset.e;
            let iv = btn.dataset.i;
            if(iv == '13') itemE.value = '1.3';
            else if(iv == '15') itemE.value = '1.5';
            else itemE.value = '1';
            
            stabE.checked = true;
            calculate();
        });
    });

    $('pk-reset').addEventListener('click', ()=>{
        lvlE.value = 50; attE.value = 150; defE.value = 100;
        powE.value = 90; effE.value = 1; itemE.value = 1;
        stabE.checked = true; weathE.checked = false;
        calculate();
    });

    $('pk-copy-btn').addEventListener('click', function(){
        const text = `PKMN Dmg Calc (Lv${lvlE.value}):\nAtk: ${attE.value} vs Def: ${defE.value}\nBP: ${powE.value} | Mods: ${itemE.options[itemE.selectedIndex].text}\nResult Spread: ${$('out-dmg-min').textContent} - ${$('out-dmg-max').textContent} HP\nGenerated via ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2 text-success"></i> Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.pkmn-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(239,68,68,.05)}
.pkmn-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.pkmn-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.pkmn-calculator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.pkmn-calculator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.pkmn-calculator-rebuilt .form-label-custom{font-size:.70rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); transition: all 0.3s ease;}
.output-hero{text-align:center;padding:1.5rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.85rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem; color:var(--tool-color);}
.output-hero-value{font-weight:900;line-height:1; letter-spacing: -2px; color:#0f172a;}
.stat-card{background:#fff;border:1px solid #f1f5f9;border-radius:12px;padding:1.5rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%; box-shadow: 0 4px 6px rgba(0,0,0,0.02);}
.stat-card:hover { transform: translateY(-3px); }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;margin-bottom:5px; color:#64748b;}
.stat-card-value{font-weight:900;display:block;line-height:1.2; font-size:1.8rem;}

@media (max-width: 768px) {
    .pkmn-calculator-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
    .output-hero-value { font-size: 3rem !important; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\pokemon-damage-calculator.blade.php ENDPATH**/ ?>