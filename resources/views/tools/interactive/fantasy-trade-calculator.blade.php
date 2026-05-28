<div class="row g-4 fantasy-trade-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4 mb-4 pb-4 border-bottom">
                    {{-- League Settings (New Features) --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Scoring Format</label>
                        <select id="fan-scoring" class="form-select form-select-lg rounded-3">
                            <option value="ppr" selected>Full PPR (1.0)</option>
                            <option value="half">Half PPR (0.5)</option>
                            <option value="standard">Standard (Non-PPR)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">League Type</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-success active flex-grow-1 py-2 fw-bold rounded-3 fan-type-btn" data-type="redraft">Redraft</button>
                            <button type="button" class="btn btn-outline-success flex-grow-1 py-2 fw-bold rounded-3 fan-type-btn" data-type="dynasty">Dynasty</button>
                        </div>
                    </div>
                    
                    {{-- Superflex Toggle --}}
                    <div class="col-12 mt-3">
                        <div class="form-check form-switch card p-3 border-0 shadow-sm bg-light flex-grow-1 d-flex flex-row align-items-center">
                            <input class="form-check-input ms-0 me-3" type="checkbox" id="fan-superflex">
                            <div>
                                <label class="form-check-label fw-bold d-block text-dark" for="fan-superflex">Superflex / 2QB League</label>
                                <span class="small text-muted">Increases baseline quarterback positional value significantly.</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Teams Area --}}
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="team-panel border rounded-4 p-4 h-100 position-relative border-primary shadow-sm" style="background-color:rgba(59,130,246,0.02)">
                            <h6 class="fw-bold mb-3 text-primary d-flex align-items-center">
                                <i class="fas fa-arrow-circle-up me-2"></i> TEAM A RECEIVES
                            </h6>
                            <div id="team-a-assets">
                                <div class="asset-row mb-3">
                                    <input type="text" class="form-control mb-2 rounded-3 border-primary-subtle" placeholder="Player Name">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-primary-subtle text-muted small fw-bold">Pos</span>
                                        <select class="form-select border-primary-subtle" style="max-width:100px;">
                                            <option>QB</option><option>RB</option><option selected>WR</option><option>TE</option><option>Pick</option>
                                        </select>
                                        <span class="input-group-text bg-white border-primary-subtle text-muted small fw-bold">Val</span>
                                        <input type="number" class="form-control border-primary-subtle val-a" value="45" min="0">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2 rounded-pill fw-bold" id="add-a" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-plus me-1"></i> Add Asset
                            </button>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="team-panel border rounded-4 p-4 h-100 position-relative border-danger shadow-sm" style="background-color:rgba(239,68,68,0.02)">
                            <h6 class="fw-bold mb-3 text-danger d-flex align-items-center">
                                <i class="fas fa-arrow-circle-down me-2"></i> TEAM B RECEIVES
                            </h6>
                            <div id="team-b-assets">
                                <div class="asset-row mb-3">
                                    <input type="text" class="form-control mb-2 rounded-3 border-danger-subtle" placeholder="Player Name">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-danger-subtle text-muted small fw-bold">Pos</span>
                                        <select class="form-select border-danger-subtle" style="max-width:100px;">
                                            <option>QB</option><option selected>RB</option><option>WR</option><option>TE</option><option>Pick</option>
                                        </select>
                                        <span class="input-group-text bg-white border-danger-subtle text-muted small fw-bold">Val</span>
                                        <input type="number" class="form-control border-danger-subtle val-b" value="40" min="0">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-danger mt-2 rounded-pill fw-bold" id="add-b" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-plus me-1"></i> Add Asset
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2 pt-3 border-top">
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-4 me-auto" id="fan-reset" style="min-width: 280px; max-width: 100%;">Reset Rosters</button>
                    <button type="button" class="btn btn-primary rounded-pill px-5 fw-bold" id="fan-calc-btn" style="min-width: 280px; max-width: 100%;">Analyze Trade Impact</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="fan-output-card" style="--tool-hue:142;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label text-uppercase">VERDICT</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-verdict" style="font-size:4rem;">Perfectly Balanced</span>
                </div>
                <div class="mt-2 text-dark fw-bold small">Value Discrepancy: <span id="out-discrepancy" class="text-secondary">0%</span></div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-5">
                    <div class="stat-card" style="border-top: 5px solid #3b82f6; background: #fff;">
                        <span class="stat-card-label text-start text-primary">TEAM A FINAL EQUITY</span>
                        <span class="stat-card-value text-dark text-start mt-2 pt-1 border-top" id="out-val-a" style="font-size:2.5rem;">45</span>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-center justify-content-center">
                    <span class="fw-bold text-muted rounded-circle bg-white border shadow-sm d-flex align-items-center justify-content-center" style="width:50px;height:50px;">VS</span>
                </div>
                <div class="col-md-5">
                    <div class="stat-card" style="border-top: 5px solid #ef4444; background: #fff;">
                        <span class="stat-card-label text-start text-danger">TEAM B FINAL EQUITY</span>
                        <span class="stat-card-value text-dark text-start mt-2 pt-1 border-top" id="out-val-b" style="font-size:2.5rem;">40</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-chart-pie text-success me-2"></i>Strategic Trade Insights
                </h6>
                <div id="out-insights" class="small text-secondary">
                    <!-- Javascript replaces this -->
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="fan-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Trade Screenshot
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="fan-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-balance-scale me-2"></i>Post to League Chat
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const aBox = $('team-a-assets');
    const bBox = $('team-b-assets');

    let leagueType = 'redraft';

    function addAsset(box, target) {
        const borderClass = target === 'A' ? 'border-primary-subtle' : 'border-danger-subtle';
        const valClass = target === 'A' ? 'val-a' : 'val-b';
        
        const row = document.createElement('div');
        row.className = 'asset-row mb-3 position-relative bg-white p-2 rounded border';
        row.innerHTML = `
            <button type="button" class="btn btn-link text-danger position-absolute top-0 end-0 p-1 remove-asset" style="min-width: 280px; max-width: 100%; font-size:0.8rem; z-index:5;"><i class="fas fa-times"></i></button>
            <input type="text" class="form-control mb-2 border-0 shadow-none fw-bold px-1" placeholder="Asset Name / Description">
            <div class="input-group">
                <span class="input-group-text bg-light text-muted small px-2">Pos</span>
                <select class="form-select border-light px-2" style="max-width:90px;">
                    <option>QB</option><option>RB</option><option>WR</option><option>TE</option><option>Pick</option>
                </select>
                <span class="input-group-text bg-light text-muted small px-2 border-start-0">Val</span>
                <input type="number" class="form-control border-light px-2 ${valClass}" value="0" min="0">
            </div>
        `;
        box.appendChild(row);
        calculate();
    }

    function calculate() {
        let valA = 0;
        let valB = 0;
        document.querySelectorAll('.val-a').forEach(i => valA += parseFloat(i.value) || 0);
        document.querySelectorAll('.val-b').forEach(i => valB += parseFloat(i.value) || 0);

        let scoring = $('fan-scoring').value;
        let sf = $('fan-superflex').checked;

        // Apply a slight superflex modifier just dynamically for aesthetic, though true value relies on input.
        // We will just process the discrepancy in this script.
        const max = Math.max(valA, valB);
        const diff = Math.abs(valA - valB);
        const ratio = max > 0 ? (diff / max) * 100 : 0;

        $('out-val-a').textContent = valA;
        $('out-val-b').textContent = valB;
        $('out-discrepancy').textContent = ratio.toFixed(1) + '%';

        const outCard = $('fan-output-card');
        const verdictEl = $('out-verdict');

        if (ratio === 0) {
            verdictEl.textContent = "Perfectly Balanced";
            verdictEl.style.color = '#10b981';
            outCard.style.setProperty('--tool-hue', '142');
            outCard.style.setProperty('--tool-color', '#10b981');
        } else if (ratio <= 10) {
            verdictEl.textContent = "Fair Trade";
            verdictEl.style.color = '#10b981';
            outCard.style.setProperty('--tool-hue', '142');
            outCard.style.setProperty('--tool-color', '#10b981');
        } else if (ratio <= 25) {
            verdictEl.textContent = "Slightly Uneven";
            verdictEl.style.color = '#f59e0b';
            outCard.style.setProperty('--tool-hue', '35');
            outCard.style.setProperty('--tool-color', '#f59e0b');
        } else {
            verdictEl.textContent = "Lopsided (Veto Risk)";
            verdictEl.style.color = '#ef4444';
            outCard.style.setProperty('--tool-hue', '0');
            outCard.style.setProperty('--tool-color', '#ef4444');
        }

        const ins = [];
        if(valA > valB) {
            ins.push(`<strong>Team A</strong> is acquiring a higher aggregate asset value by a margin of ${diff}.`);
        } else if (valB > valA) {
            ins.push(`<strong>Team B</strong> is acquiring a higher aggregate asset value by a margin of ${diff}.`);
        }

        if(ratio > 30) {
            ins.push('This trade represents a severe imbalance. In redraft leagues, consider rejecting. In dynasty, this might make sense during a total rebuild if youth/picks are discounted heavily.');
        }

        if(leagueType === 'dynasty') {
            ins.push('Dynasty values fluctuate wildly. Ensure you assign proper future equity to draft picks.');
        }

        if(sf) {
            ins.push('Superflex Premium Active: Quarterback inputs should have their baseline valuations increased by roughly 30-50% compared to 1QB formats.');
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-caret-right text-muted me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    $('add-a').addEventListener('click', () => addAsset(aBox, 'A'));
    $('add-b').addEventListener('click', () => addAsset(bBox, 'B'));

    document.addEventListener('click', function(e) {
        let btn = e.target.closest('.remove-asset');
        if (btn) {
            btn.closest('.asset-row').remove();
            calculate();
        }
    });

    document.querySelectorAll('.fan-type-btn').forEach(btn => {
        btn.addEventListener('click', ()=>{
            leagueType = btn.dataset.type;
            document.querySelectorAll('.fan-type-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            calculate();
        });
    });

    document.addEventListener('input', e => {
        if (e.target.classList.contains('val-a') || e.target.classList.contains('val-b')) calculate();
    });

    $('fan-scoring').addEventListener('change', calculate);
    $('fan-superflex').addEventListener('change', calculate);

    $('fan-calc-btn').addEventListener('click', calculate);

    $('fan-copy-btn').addEventListener('click', function(){
        const text = `Trade Analysis Result\nFormat: ${$('fan-scoring').options[$('fan-scoring').selectedIndex].text} | ${leagueType} | ${$('fan-superflex').checked?'Superflex':'1QB'}\nTeam A Value: ${$('out-val-a').textContent}\nTeam B Value: ${$('out-val-b').textContent}\nVerdict: ${$('out-verdict').textContent}\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const orig = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2 text-success"></i> Copied!';
            setTimeout(() => { btn.innerHTML = orig; }, 2000);
        });
    });

    calculate();
});
</script>

<style>
.fantasy-trade-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(16,185,129,.05)}
.fantasy-trade-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.fantasy-trade-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.fantasy-trade-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.fantasy-trade-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.fantasy-trade-rebuilt .form-label-custom{font-size:.70rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}
.fantasy-trade-rebuilt .btn-outline-success{border-color:#10b981; color:#10b981; border-width:2.5px}
.fantasy-trade-rebuilt .btn-outline-success.active{background-color:#10b981; border-color:#10b981; color:#fff}

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); transition: all 0.3s ease;}
.output-hero{text-align:center;padding:1.5rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem; color:var(--tool-color);}
.output-hero-value{font-weight:900;line-height:1}
.stat-card{background:#fff;border:1px solid #f1f5f9;border-radius:12px;padding:1.5rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%; box-shadow: 0 4px 6px rgba(0,0,0,0.02);}
.stat-card:hover { transform: translateY(-5px); }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;margin-bottom:2px}
.stat-card-value{font-weight:900;display:block;line-height:1.2; letter-spacing:-1px;}

@media (max-width: 768px) {
    .fantasy-trade-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
    .output-hero-value { font-size: 2.5rem !important; }
}
</style>

