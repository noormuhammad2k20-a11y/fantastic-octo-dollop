<div class="row g-4 balatro-calculator-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4 border-bottom pb-4 mb-4">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Played Hand Type</label>
                        <select id="bal-hand" class="form-select form-select-lg rounded-3 border-secondary-subtle">
                            <option value="10,2" selected>High Card (10x2)</option>
                            <option value="20,2">Pair (20x2)</option>
                            <option value="30,3">Two Pair (30x3)</option>
                            <option value="30,3">Three of a Kind (30x3)</option>
                            <option value="40,4">Straight (30x4)</option>
                            <option value="40,4">Flush (40x4)</option>
                            <option value="60,7">Full House (40x4)</option>
                            <option value="60,7">Four of a Kind (60x7)</option>
                            <option value="100,8">Straight Flush (100x8)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Planet Level</label>
                        <div class="input-group">
                            <input type="number" id="bal-planet" class="form-control form-control-lg border-secondary-subtle rounded-start-3" value="1" min="1" max="100">
                            <span class="input-group-text bg-light border-secondary-subtle rounded-end-3 text-muted">Lv</span>
                        </div>
                        <span class="small text-muted mt-1 d-block">Each level adds roughly +15 Chips, +2 Mult natively.</span>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Played Cards Chip Total</label>
                        <input type="number" id="bal-cards" class="form-control form-control-lg border-primary-subtle rounded-3" value="35" min="0" max="999">
                        <span class="small text-muted mt-1 d-block">Sum the chip value of the 5 cards actually played.</span>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-12 mb-2"><h6 class="fw-bold text-dark"><i class="fas fa-hat-wizard me-2 text-warning"></i>Joker Engine Modifiers</h6></div>
                    
                    <div class="col-md-4">
                        <label class="form-label-custom text-primary">+ Flat Chips (Blue)</label>
                        <input type="number" id="bal-plus-chips" class="form-control form-control-lg rounded-3 border-primary-subtle" value="50" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom text-danger">+ Flat Mult (Red)</label>
                        <input type="number" id="bal-plus-mult" class="form-control form-control-lg rounded-3 border-danger-subtle" value="15" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom text-warning">x Multiplier (X-Mult)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-warning-subtle text-muted rounded-start-3 fw-bold">X</span>
                            <input type="number" id="bal-x-mult" class="form-control form-control-lg border-warning-subtle rounded-end-3" value="3" min="1" step="0.5">
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex gap-2 w-100 flex-wrap">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 bal-quick" data-h="40,4" data-p="3" data-c="50" data-f="0" data-fm="20" data-x="1.5">Mid-Game Flush Setup</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 bal-quick" data-h="60,7" data-p="10" data-c="80" data-f="200" data-fm="50" data-x="9">End-Game Engine (Baron/Mime)</button>
                    <button type="button" class="btn btn-primary rounded-pill px-5 fw-bold ms-auto" id="bal-calc-btn" style="min-width: 280px; max-width: 100%;">Score Hand</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="bal-output-card" style="--tool-hue:24;--tool-color:#f97316;--tool-bg:rgba(249,115,22,.04);">
            <div class="output-hero">
                <span class="output-hero-label text-uppercase">PROJECTED HAND SCORE</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-total" style="font-size:5rem;">0</span>
                </div>
                <div class="mt-2 text-dark fw-bold small">Score Bracket: <span id="out-bracket" class="text-orange">Ante 1</span></div>
            </div>

            <div class="row g-3 mt-3 justify-content-center">
                <div class="col-md-5">
                    <div class="stat-card" style="border-top: 5px solid #3b82f6; background: white;">
                        <span class="stat-card-label text-start text-primary">FINAL CHIPS (BLUE)</span>
                        <span class="stat-card-value text-dark text-center mt-2 pt-1 border-top" id="out-chips" style="font-size:2.5rem;">0</span>
                    </div>
                </div>
                <div class="col-md-1 d-flex align-items-center justify-content-center">
                    <i class="fas fa-times fs-3 text-muted"></i>
                </div>
                <div class="col-md-5">
                    <div class="stat-card" style="border-top: 5px solid #ef4444; background: white;">
                        <span class="stat-card-label text-start text-danger">FINAL MULT (RED)</span>
                        <span class="stat-card-value text-dark text-center mt-2 pt-1 border-top" id="out-mult" style="font-size:2.5rem;">0</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2"></i>Balatro Math Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="bal-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Engine Stats
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="bal-reset" style="min-width: 280px; max-width: 100%;">Reset Desk</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const handE = $('bal-hand'), pLvlE = $('bal-planet'), pCardsE = $('bal-cards');
    const fChipsE = $('bal-plus-chips'), fMultE = $('bal-plus-mult'), xMultE = $('bal-x-mult');

    function formatNumber(num) {
        if (num >= 1000000000) return (num / 1000000000).toFixed(2) + ' B';
        if (num >= 1000000) return (num / 1000000).toFixed(2) + ' M';
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function calculate() {
        const hVals = handE.value.split(','); // [baseChips, baseMult]
        let bC = parseInt(hVals[0]);
        let bM = parseInt(hVals[1]);

        let pLevel = parseInt(pLvlE.value)||1;
        let cChips = parseInt(pCardsE.value)||0;

        let jChips = parseInt(fChipsE.value)||0;
        let jMult = parseInt(fMultE.value)||0;
        let xMult = parseFloat(xMultE.value)||1;

        // Apply planet levels (generic approximation: +15 chips, +2 mult per level past 1)
        if(pLevel > 1) {
            bC += (pLevel - 1) * 15;
            bM += (pLevel - 1) * 2;
        }

        const totalChips = bC + cChips + jChips;
        const totalMult = (bM + jMult) * xMult;

        const score = totalChips * totalMult;

        $('out-chips').textContent = formatNumber(totalChips);
        $('out-mult').textContent = formatNumber(totalMult);
        $('out-total').textContent = formatNumber(score);

        const outCard = $('bal-output-card');
        const verdictEl = $('out-bracket');

        if(score > 100000000) {
            verdictEl.textContent = "Endless Mode (Ante 11+)";
            verdictEl.style.color = '#ef4444';
            outCard.style.setProperty('--tool-hue', '0');
            outCard.style.setProperty('--tool-color', '#ef4444');
        } else if (score > 100000) {
            verdictEl.textContent = "Late Game (Ante 7-8)";
            verdictEl.style.color = '#8b5cf6';
            outCard.style.setProperty('--tool-hue', '262');
            outCard.style.setProperty('--tool-color', '#8b5cf6');
        } else {
            verdictEl.textContent = "Early-Mid Game";
            verdictEl.style.color = '#f97316';
            outCard.style.setProperty('--tool-hue', '24');
            outCard.style.setProperty('--tool-color', '#f97316');
        }

        const ins = [];
        ins.push(`Base Hand yields ${bC} Chips and ${bM} Mult before Joker effects are applied.`);
        
        if (xMult > 1) {
            ins.push(`Your X-Mult is boosting your final score output dramatically by <strong>${xMult}x</strong>. Ensure these trigger last in the Joker queue.`);
        } else {
            ins.push(`You currently have zero X-Mult multipliers. You will struggle to pass Ante 5 without finding a Polychrome card or X-Mult Joker.`);
        }

        if (jChips < 50 && totalChips < 150) {
            ins.push(`Your Chip pool is very low. A $+Chips$ joker would provide more value than a $+Mult$ joker at this stage.`);
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-caret-right text-muted me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [handE, pLvlE, pCardsE, fChipsE, fMultE, xMultE].forEach(el => {
        el.addEventListener('input', calculate);
        el.addEventListener('change', calculate);
    });

    $('bal-calc-btn').addEventListener('click', calculate);

    document.querySelectorAll('.bal-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            handE.value = btn.dataset.h;
            pLvlE.value = btn.dataset.p;
            fChipsE.value = btn.dataset.c;
            pCardsE.value = btn.dataset.f;
            fMultE.value = btn.dataset.fm;
            xMultE.value = btn.dataset.x;
            calculate();
        });
    });

    $('bal-reset').addEventListener('click', ()=>{
        handE.value = "10,2"; pLvlE.value = 1; pCardsE.value = 35;
        fChipsE.value = 50; fMultE.value = 15; xMultE.value = 3;
        calculate();
    });

    $('bal-copy-btn').addEventListener('click', function(){
        const text = `Balatro Hand:\nChips: ${$('out-chips').textContent} x Mult: ${$('out-mult').textContent}\nTotal Score: ${$('out-total').textContent}\nGenerated via ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2 text-success"></i> Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.balatro-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(249,115,22,.05)}
.balatro-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.balatro-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.balatro-calculator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.balatro-calculator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.balatro-calculator-rebuilt .form-label-custom{font-size:.70rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}
.text-orange { color: #f97316; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); transition: all 0.3s ease;}
.output-hero{text-align:center;padding:1.5rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.85rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem; color:var(--tool-color);}
.output-hero-value{font-weight:900;line-height:1; letter-spacing: -2px; color:#0f172a;}
.stat-card{background:#fff;border:1px solid #f1f5f9;border-radius:12px;padding:1.5rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%; box-shadow: 0 4px 6px rgba(0,0,0,0.02);}
.stat-card:hover { transform: translateY(-3px); }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;margin-bottom:5px; color:#64748b;}
.stat-card-value{font-weight:900;display:block;line-height:1.2; letter-spacing: -1px;}

@media (max-width: 768px) {
    .balatro-calculator-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
    .output-hero-value { font-size: 3rem !important; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\balatro-calculator.blade.php ENDPATH**/ ?>