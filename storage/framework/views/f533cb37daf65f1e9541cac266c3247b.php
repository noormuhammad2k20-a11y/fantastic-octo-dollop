<div class="row g-4 ffb-calculator-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4 border-bottom pb-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">League Scoring Settings</label>
                        <select id="ffb-scoring" class="form-select form-select-lg border-primary-subtle">
                            <option value="1">Standard (No PPR)</option>
                            <option value="1.2">Half PPR</option>
                            <option value="1.4" selected>Full PPR</option>
                            <option value="1.8">TE Premium (1.5 PPR for TEs)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Current Team Status</label>
                        <select id="ffb-status" class="form-select form-select-lg border-primary-subtle">
                            <option value="contender">Win-Now Contender</option>
                            <option value="middle">Middle of the Pack</option>
                            <option value="rebuild" selected>Rebuilding</option>
                        </select>
                    </div>
                </div>

                
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-4 border">
                            <h6 class="fw-bold mb-3 text-primary d-flex align-items-center">
                                <i class="fas fa-arrow-down me-2"></i> You Are Receiving
                            </h6>
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-white small text-muted fw-bold border-primary-subtle">Win-Now Value</span>
                                <input type="number" id="ffb-a-win" class="form-control border-primary-subtle" value="80" min="0">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-white small text-muted fw-bold border-primary-subtle">Dynasty Equity</span>
                                <input type="number" id="ffb-a-dyn" class="form-control border-primary-subtle" value="150" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-4 border">
                            <h6 class="fw-bold mb-3 text-danger d-flex align-items-center">
                                <i class="fas fa-arrow-up me-2"></i> You Are Sending
                            </h6>
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-white small text-muted fw-bold border-danger-subtle">Win-Now Value</span>
                                <input type="number" id="ffb-b-win" class="form-control border-danger-subtle" value="120" min="0">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-white small text-muted fw-bold border-danger-subtle">Dynasty Equity</span>
                                <input type="number" id="ffb-b-dyn" class="form-control border-danger-subtle" value="90" min="0">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex gap-2 w-100 flex-wrap">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 ffb-quick" data-aw="15" data-ad="200" data-bw="100" data-bd="60" data-s="rebuild">Trading Vet for Picks (Rebuild)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 ffb-quick" data-aw="120" data-ad="80" data-bw="40" data-bd="150" data-s="contender">Selling Picks for Vet (Contender)</button>
                    <button type="button" class="btn btn-primary rounded-pill px-5 fw-bold ms-auto" id="ffb-calc-btn" style="min-width: 280px; max-width: 100%;">Score Trade</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="ffb-output-card" style="--tool-hue:210;--tool-color:#3b82f6;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero mb-2">
                <span class="output-hero-label text-uppercase">Trade Conclusion</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-verdict" style="font-size:3rem;">Fair Trade</span>
                </div>
            </div>

            <div class="row g-3 mt-3 justify-content-center">
                <div class="col-md-6">
                    <div class="stat-card" style="border-top: 5px solid #22c55e; background: white;">
                        <span class="stat-card-label text-start text-success">Context Adjusted Score (You)</span>
                        <span class="stat-card-value text-dark text-start mt-2 pt-1 border-top" id="out-y-score" style="font-size:2.5rem;">0</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card" style="border-top: 5px solid #ef4444; background: white;">
                        <span class="stat-card-label text-start text-danger">Context Adjusted Score (Them)</span>
                        <span class="stat-card-value text-dark text-start mt-2 pt-1 border-top" id="out-t-score" style="font-size:2.5rem;">0</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-gavel text-primary me-2"></i>GM Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const scoreE = $('ffb-scoring'), statusE = $('ffb-status');
    const awE = $('ffb-a-win'), adE = $('ffb-a-dyn');
    const bwE = $('ffb-b-win'), bdE = $('ffb-b-dyn');

    function calculate() {
        let aw = parseFloat(awE.value)||0; let ad = parseFloat(adE.value)||0;
        let bw = parseFloat(bwE.value)||0; let bd = parseFloat(bdE.value)||0;

        let status = statusE.value;
        let modifier = parseFloat(scoreE.value); // Just a numeric scaling factor for visual differences

        // Valuation weightings based on status
        let winWeight = 1.0;
        let dynWeight = 1.0;

        if (status === 'contender') {
            winWeight = 1.4;
            dynWeight = 0.8;
        } else if (status === 'rebuild') {
            winWeight = 0.5;
            dynWeight = 1.5;
        }

        let yourScore = ((aw * winWeight) + (ad * dynWeight)) * modifier;
        let theirScore = ((bw * winWeight) + (bd * dynWeight)) * modifier;

        $('out-y-score').textContent = Math.round(yourScore);
        $('out-t-score').textContent = Math.round(theirScore);

        const diff = Math.abs(yourScore - theirScore);
        const max = Math.max(yourScore, theirScore);
        const ratio = max > 0 ? (diff / max) * 100 : 0;

        const outCard = $('ffb-output-card');
        const verdictEl = $('out-verdict');

        if (yourScore > theirScore && ratio > 15) {
            verdictEl.textContent = "Smash Accept (You win)";
            verdictEl.style.color = '#10b981';
            outCard.style.setProperty('--tool-hue', '142');
            outCard.style.setProperty('--tool-color', '#10b981');
        } else if (theirScore > yourScore && ratio > 15) {
            verdictEl.textContent = "Reject (You lose value)";
            verdictEl.style.color = '#ef4444';
            outCard.style.setProperty('--tool-hue', '0');
            outCard.style.setProperty('--tool-color', '#ef4444');
        } else {
            verdictEl.textContent = "Fair Trade";
            verdictEl.style.color = '#3b82f6';
            outCard.style.setProperty('--tool-hue', '210');
            outCard.style.setProperty('--tool-color', '#3b82f6');
        }

        const ins = [];
        if (status === 'rebuild' && aw > bw) {
            ins.push('Warning: You are acquiring win-now points during a rebuild. This works against your objective.');
        }
        if (status === 'contender' && ad > bd && aw < bw) {
            ins.push('Warning: You are trading away your win-now assets for future picks while trying to compete. This hurts your championship odds.');
        }

        if (ratio < 10) ins.push('This trade is statistically even considering your team context.');
        
        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-info-circle text-primary me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [scoreE, statusE, awE, adE, bwE, bdE].forEach(el => el.addEventListener('input', calculate));
    $('ffb-calc-btn').addEventListener('click', calculate);

    document.querySelectorAll('.ffb-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            awE.value = btn.dataset.aw;
            adE.value = btn.dataset.ad;
            bwE.value = btn.dataset.bw;
            bdE.value = btn.dataset.bd;
            statusE.value = btn.dataset.s;
            calculate();
        });
    });

    calculate();
});
</script>

<style>
.ffb-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(59,130,246,.05)}
.ffb-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.ffb-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.ffb-calculator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.ffb-calculator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.ffb-calculator-rebuilt .form-label-custom{font-size:.70rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}
.fa-football-helmet:before { content: "\f44e"; } /* Fallback to standard football icon if helmet missing */

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); transition: all 0.3s ease;}
.output-hero{text-align:center;padding:1.5rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.85rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem; color:var(--tool-color);}
.output-hero-value{font-weight:900;line-height:1; letter-spacing: -2px;}
.stat-card{background:#fff;border:1px solid #f1f5f9;border-radius:12px;padding:1.5rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%; box-shadow: 0 4px 6px rgba(0,0,0,0.02);}
.stat-card:hover { transform: translateY(-3px); }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;margin-bottom:5px;}
.stat-card-value{font-weight:900;display:block;line-height:1.2; letter-spacing: -1px;}

@media (max-width: 768px) {
    .ffb-calculator-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
    .output-hero-value { font-size: 2.5rem !important; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\fantasy-football-trade.blade.php ENDPATH**/ ?>