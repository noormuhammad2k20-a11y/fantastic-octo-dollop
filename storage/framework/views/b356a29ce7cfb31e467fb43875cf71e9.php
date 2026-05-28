<div class="row g-4 mtg-calculator-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4 border-bottom pb-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Defending Player's Life</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-danger-subtle text-muted fw-bold rounded-start-3"><i class="fas fa-heart text-danger"></i></span>
                            <input type="number" id="mtg-life" class="form-control form-control-lg border-danger-subtle rounded-end-3" value="40" min="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Attacker's Total Power</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-warning-subtle text-muted fw-bold rounded-start-3"><i class="fas fa-fist-raised text-warning"></i></span>
                            <input type="number" id="mtg-atk" class="form-control form-control-lg border-warning-subtle rounded-end-3" value="10" min="0">
                        </div>
                    </div>
                </div>

                
                <div class="row g-3">
                    <div class="col-12 mb-2"><h6 class="fw-bold text-dark"><i class="fas fa-khanda me-2 text-primary"></i>Combat Modifiers & Blockers</h6></div>
                    
                    <div class="col-md-4">
                        <label class="form-label-custom text-muted">Total Blocker Toughness</label>
                        <input type="number" id="mtg-blk" class="form-control form-control-lg rounded-3 border-secondary-subtle" value="0" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom text-purple">Existing Commander Dmg</label>
                        <input type="number" id="mtg-cmd-prev" class="form-control form-control-lg rounded-3 border-secondary-subtle" value="0" min="0" max="21">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom text-success">Existing Poison Counters</label>
                        <input type="number" id="mtg-psn-prev" class="form-control form-control-lg rounded-3 border-success-subtle" value="0" min="0" max="10">
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-check form-switch card p-3 flex-grow-1 shadow-sm bg-light border-0 h-100">
                            <input class="form-check-input ms-0 me-2" type="checkbox" id="mtg-trample" checked>
                            <label class="form-check-label fw-bold d-block text-dark mt-1" for="mtg-trample">Trample <br><span class="small text-muted fw-normal">Damage bleeds thru blockers</span></label>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-check form-switch card p-3 flex-grow-1 shadow-sm bg-light border-0 h-100">
                            <input class="form-check-input ms-0 me-2 border-primary" type="checkbox" id="mtg-is-cmd">
                            <label class="form-check-label fw-bold d-block text-primary mt-1" for="mtg-is-cmd">Is Commander? <br><span class="small text-muted fw-normal">Tracks ≥21 Lethal</span></label>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-check form-switch card p-3 flex-grow-1 shadow-sm bg-light border-0 h-100">
                            <input class="form-check-input ms-0 me-2 border-success" type="checkbox" id="mtg-is-infect">
                            <label class="form-check-label fw-bold d-block text-success mt-1" for="mtg-is-infect">Infect / Toxic <br><span class="small text-muted fw-normal">Deals damage in Poison</span></label>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex gap-2 w-100 flex-wrap">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Spells:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 mtg-quick" data-p="+3" data-t="on">Giant Growth</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 mtg-quick" data-p="*2" data-t="keep">Unleash (x2 Pwr)</button>
                    <button type="button" class="btn btn-primary rounded-pill px-5 fw-bold ms-auto" id="mtg-calc-btn" style="min-width: 280px; max-width: 100%;">Resolve Combat Phase</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="mtg-output-card" style="--tool-hue:210;--tool-color:#3b82f6;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero mb-2">
                <span class="output-hero-label text-uppercase">Opponent Status</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-status" style="font-size:3.5rem;">Survives</span>
                </div>
            </div>

            <div class="row g-3 mt-3 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card" style="border-top: 5px solid #ef4444; background: white;">
                        <span class="stat-card-label text-start text-danger">Remaining Life Total</span>
                        <span class="stat-card-value text-dark text-start mt-2 pt-1 border-top" id="out-life">40</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card" style="border-top: 5px solid #a855f7; background: white;">
                        <span class="stat-card-label text-start text-purple" style="color:#a855f7;">Commander Damage Taken</span>
                        <span class="stat-card-value text-dark text-start mt-2 pt-1 border-top" id="out-cmd">0 / 21</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="stat-card" style="border-top: 5px solid #10b981; background: white;">
                        <span class="stat-card-label text-start text-success">Poison Counters Given</span>
                        <span class="stat-card-value text-dark text-start mt-2 pt-1 border-top" id="out-psn">0 / 10</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-scroll text-dark me-2"></i>Trigger Logic
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>
            
            <button class="btn d-block mx-auto btn-dark fw-bold mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="mtg-reset" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-undo me-2"></i>Reset Step
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const lifeE = $('mtg-life'), atkE = $('mtg-atk'), blkE = $('mtg-blk');
    const cmdPrevE = $('mtg-cmd-prev'), psnPrevE = $('mtg-psn-prev');
    const trampleE = $('mtg-trample'), cmdE = $('mtg-is-cmd'), infE = $('mtg-is-infect');

    function calculate() {
        let life = parseInt(lifeE.value)||0;
        let atk = parseInt(atkE.value)||0;
        let blk = parseInt(blkE.value)||0;

        let cmdPrev = parseInt(cmdPrevE.value)||0;
        let psnPrev = parseInt(psnPrevE.value)||0;

        // Combat Math
        let damageToPlayer = 0;
        if(blk > 0) {
            if(trampleE.checked) {
                damageToPlayer = Math.max(0, atk - blk);
            } else {
                damageToPlayer = 0; // Blocked completely
            }
        } else {
            damageToPlayer = atk; // Unblocked
        }

        // Apply Damage
        let newLife = life;
        let newCmd = cmdPrev;
        let newPsn = psnPrev;

        if (damageToPlayer > 0) {
            if(infE.checked) {
                newPsn += damageToPlayer;
            } else {
                newLife -= damageToPlayer;
                if(cmdE.checked) newCmd += damageToPlayer;
            }
        }

        $('out-life').textContent = Math.max(0, newLife);
        $('out-cmd').textContent = `${newCmd} / 21`;
        $('out-psn').textContent = `${newPsn} / 10`;

        const outCard = $('mtg-output-card');
        const verdictEl = $('out-status');
        const ins = [];

        let lethal = false;

        if(newLife <= 0) {
            lethal = true;
            verdictEl.textContent = "Lethal (Life = 0)";
            ins.push('Opponent lost due to normal damage reducing their life total to zero or less.');
        } else if (newCmd >= 21) {
            lethal = true;
            verdictEl.textContent = "Lethal (21 CMDR Dmg)";
            ins.push('Opponent lost via Commander Damage rule (≥21 from a single commander).');
        } else if (newPsn >= 10) {
            lethal = true;
            verdictEl.textContent = "Lethal (10 Poison)";
            ins.push('Opponent lost due to state-based actions: possessing 10 or more poison counters.');
        } else {
            verdictEl.textContent = "Survives!";
            outCard.style.setProperty('--tool-hue', '210');
            outCard.style.setProperty('--tool-color', '#3b82f6');
            verdictEl.style.color = '#3b82f6';
        }

        if(lethal) {
            outCard.style.setProperty('--tool-hue', '0');
            outCard.style.setProperty('--tool-color', '#ef4444');
            verdictEl.style.color = '#ef4444';
        }

        if (blk > 0) {
            if (trampleE.checked) {
                if(damageToPlayer > 0) ins.push(`Trample: ${blk} damage was assigned to blockers, and the remaining ${damageToPlayer} damage trampled over.`);
                else ins.push(`Trample: Attacker's power was not high enough to trample over the ${blk} toughness.`);
            } else {
                ins.push('Creature was blocked without Trample. All damage was absorbed by the defending creatures regardless of toughness.');
            }
        }

        if(ins.length===0 && damageToPlayer > 0) ins.push(`Direct hit for ${damageToPlayer} damage.`);

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-caret-right text-muted me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [lifeE, atkE, blkE, cmdPrevE, psnPrevE, trampleE, cmdE, infE].forEach(el => {
        el.addEventListener('input', calculate);
        el.addEventListener('change', calculate);
    });

    $('mtg-calc-btn').addEventListener('click', calculate);

    document.querySelectorAll('.mtg-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            const p = btn.dataset.p;
            if(p.startsWith('+')) {
                atkE.value = (parseInt(atkE.value)||0) + parseInt(p.substring(1));
            } else if (p.startsWith('*')) {
                atkE.value = (parseInt(atkE.value)||0) * parseInt(p.substring(1));
            }

            if(btn.dataset.t === 'on') trampleE.checked = true;
            calculate();
        });
    });

    $('mtg-reset').addEventListener('click', ()=>{
        lifeE.value=40; atkE.value=10; blkE.value=0;
        cmdPrevE.value=0; psnPrevE.value=0;
        trampleE.checked=true; cmdE.checked=false; infE.checked=false;
        calculate();
    });

    calculate();
});
</script>

<style>
.mtg-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(168,85,247,.05)}
.mtg-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.mtg-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.mtg-calculator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.mtg-calculator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.mtg-calculator-rebuilt .form-label-custom{font-size:.70rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}
.text-purple { color: #a855f7; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); transition: all 0.3s ease;}
.output-hero{text-align:center;padding:1.5rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.85rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem; color:var(--tool-color);}
.output-hero-value{font-weight:900;line-height:1; letter-spacing: -2px;}
.stat-card{background:#fff;border:1px solid #f1f5f9;border-radius:12px;padding:1.5rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%; box-shadow: 0 4px 6px rgba(0,0,0,0.02);}
.stat-card:hover { transform: translateY(-3px); }
.stat-card-label{display:block;font-size:.60rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;margin-bottom:5px;}
.stat-card-value{font-weight:900;display:block;line-height:1.2; font-size:1.6rem; letter-spacing: -1px;}

@media (max-width: 768px) {
    .mtg-calculator-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
    .output-hero-value { font-size: 2.5rem !important; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\mtg-damage-calculator.blade.php ENDPATH**/ ?>