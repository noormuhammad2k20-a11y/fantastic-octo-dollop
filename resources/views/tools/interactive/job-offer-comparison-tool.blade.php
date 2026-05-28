<div class="row g-4 job-comp-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(236, 72, 153, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #EC4899, #BE185D); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#4c0519; letter-spacing: -0.5px;">Executive Total Comp Analyzer</h4>
                    <p class="text-muted small mb-0">Beyond base salary—model stock options, 401k matches, and cost-of-living adjustments to find your true earning power.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Offer A --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border-top border-4 border-pink h-100 shadow-sm" style="background: #fdf2f8;">
                            <h6 class="fw-black text-pink text-uppercase small mb-4 tracking-wider">Strategic Offer A</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Base Salary</label>
                                    <input type="number" id="base-a" class="form-control border-0 bg-white rounded-3 fw-bold" value="120000">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Signing Bonus</label>
                                    <input type="number" id="sign-a" class="form-control border-0 bg-white rounded-3 fw-bold" value="5000">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Annual Bonus (%)</label>
                                    <input type="number" id="bonus-a" class="form-control border-0 bg-white rounded-3 fw-bold" value="10">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Stock / Equity (Yr)</label>
                                    <input type="number" id="equity-a" class="form-control border-0 bg-white rounded-3 fw-bold" value="15000">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">401k Match (%)</label>
                                    <input type="number" id="match-a" class="form-control border-0 bg-white rounded-3 fw-bold" value="4">
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Location Index (100 = Avg)</label>
                                    <input type="number" id="coli-a" class="form-control border-0 bg-white rounded-3 fw-bold" value="100">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Offer B --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border-top border-4 border-slate h-100 shadow-sm" style="background: #f8fafc;">
                            <h6 class="fw-black text-slate text-uppercase small mb-4 tracking-wider">Strategic Offer B</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Base Salary</label>
                                    <input type="number" id="base-b" class="form-control border-0 bg-white rounded-3 fw-bold" value="135000">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Signing Bonus</label>
                                    <input type="number" id="sign-b" class="form-control border-0 bg-white rounded-3 fw-bold" value="0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Annual Bonus (%)</label>
                                    <input type="number" id="bonus-b" class="form-control border-0 bg-white rounded-3 fw-bold" value="5">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Stock / Equity (Yr)</label>
                                    <input type="number" id="equity-b" class="form-control border-0 bg-white rounded-3 fw-bold" value="0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">401k Match (%)</label>
                                    <input type="number" id="match-b" class="form-control border-0 bg-white rounded-3 fw-bold" value="3">
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Location Index (100 = Avg)</label>
                                    <input type="number" id="coli-b" class="form-control border-0 bg-white rounded-3 fw-bold" value="115">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 330; --tool-color: #EC4899; --tool-bg: rgba(236, 72, 153, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">PREFERRED CAREER MOVE</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-verdict">Offer A</div>
                <div class="badge bg-pink-soft text-pink px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-diff">+$4,200 Adjusted TC Value</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Charts/Stats --}}
                    <div class="col-md-8">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="stat-card p-4 rounded-4 border-pink border-start border-4 bg-light">
                                    <div class="small fw-bold text-muted mb-1 uppercase">ADJUSTED TC: OFFER A</div>
                                    <div class="h3 fw-bold mb-0 text-dark" id="out-tc-a">$0</div>
                                    <div class="small text-muted mt-2">Nominal: <span id="out-nom-a">$0</span></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="stat-card p-4 rounded-4 border-slate border-start border-4 bg-light">
                                    <div class="small fw-bold text-muted mb-1 uppercase">ADJUSTED TC: OFFER B</div>
                                    <div class="h3 fw-bold mb-0 text-dark" id="out-tc-b">$0</div>
                                    <div class="small text-muted mt-2">Nominal: <span id="out-nom-b">$0</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 class="fw-bold small mb-2 uppercase opacity-50">Earning Efficiency Ratio</h6>
                            <div class="progress rounded-pill overflow-hidden shadow-sm" style="height: 25px; background: #f1f5f9;">
                                <div id="bar-a" class="progress-bar bg-pink" style="width: 50%">A</div>
                                <div id="bar-b" class="progress-bar bg-slate-500" style="width: 50%">B</div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-4 border-start">
                        <div class="vstack gap-2 ps-md-3">
                            <button class="btn d-block mx-auto btn-pink rounded-pill fw-bold text-white shadow-sm py-3 px-5" id="copy-summary">
                                <i class="fas fa-file-invoice-dollar me-2"></i>Copy TC Breakdown
                            </button>
                            <button class="btn btn-outline-dark w-100 py-2 rounded-pill fw-bold" id="reset-calc">
                                <i class="fas fa-rotate-left me-2"></i>Reset Comparison
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const inputs = ['base-a', 'sign-a', 'bonus-a', 'equity-a', 'match-a', 'coli-a',
                    'base-b', 'sign-b', 'bonus-b', 'equity-b', 'match-b', 'coli-b'];

    function calculate(){
        const getVal = id => parseFloat($(id).value) || 0;
        
        let bA = getVal('base-a'), sA = getVal('sign-a'), bnA = getVal('bonus-a'), eA = getVal('equity-a'), mA = getVal('match-a'), cA = getVal('coli-a');
        let bB = getVal('base-b'), sB = getVal('sign-b'), bnB = getVal('bonus-b'), eB = getVal('equity-b'), mB = getVal('match-b'), cB = getVal('coli-b');

        // Nominal TC
        let nomA = bA + sA + (bA * (bnA/100)) + eA + (bA * (mA/100));
        let nomB = bB + sB + (bB * (bnB/100)) + eB + (bB * (mB/100));

        // Adjusted TC (Normalized by COLI)
        let adjA = cA > 0 ? (nomA / (cA/100)) : nomA;
        let adjB = cB > 0 ? (nomB / (cB/100)) : nomB;

        // Update UI
        $('out-tc-a').textContent = '$' + Math.round(adjA).toLocaleString();
        $('out-tc-b').textContent = '$' + Math.round(adjB).toLocaleString();
        $('out-nom-a').textContent = '$' + Math.round(nomA).toLocaleString();
        $('out-nom-b').textContent = '$' + Math.round(nomB).toLocaleString();

        const verdict = $('out-verdict');
        const diffE = $('out-diff');
        const diff = Math.abs(adjA - adjB);

        if(adjA > adjB) {
            verdict.textContent = 'Offer A';
            verdict.style.color = '#EC4899';
            diffE.textContent = `+$${Math.round(diff).toLocaleString()} Adjusted TC Advantage`;
        } else if(adjB > adjA) {
            verdict.textContent = 'Offer B';
            verdict.style.color = '#64748b';
            diffE.textContent = `+$${Math.round(diff).toLocaleString()} Adjusted TC Advantage`;
        } else {
            verdict.textContent = 'Equal Value';
            diffE.textContent = 'Identical Adjusted TC';
        }

        const totalAdj = adjA + adjB;
        if(totalAdj > 0) {
            let pctA = (adjA / totalAdj) * 100;
            let pctB = (adjB / totalAdj) * 100;
            $('bar-a').style.width = pctA + '%';
            $('bar-b').style.width = pctB + '%';
            $('bar-a').textContent = Math.round(pctA) + '%';
            $('bar-b').textContent = Math.round(pctB) + '%';
        }
    }

    inputs.forEach(id => $(id).addEventListener('input', calculate));

    $('reset-calc').addEventListener('click', () => {
        $('base-a').value = 120000; $('sign-a').value = 5000; $('bonus-a').value = 10;
        $('equity-a').value = 15000; $('match-a').value = 4; $('coli-a').value = 100;
        $('base-b').value = 135000; $('sign-b').value = 0; $('bonus-b').value = 5;
        $('equity-b').value = 0; $('match-b').value = 3; $('coli-b').value = 115;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Job Comparison Analysis\nBest Move: ${$('out-verdict').textContent}\nAdvantage: ${$('out-diff').textContent}\nOffer A Adj TC: ${$('out-tc-a').textContent}\nOffer B Adj TC: ${$('out-tc-b').textContent}\nGenerated by ToolsHub Career`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.job-comp-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#4c0519;opacity:.7;margin-bottom:8px;display:block}
.job-comp-rebuilt .calculator-card { transition: none; }
.btn-pink { background: #EC4899; color: #fff; }
.btn-pink:hover { background: #BE185D; color: #fff; }
.text-pink { color: #EC4899; }
.bg-pink-soft { background: #FDF2F8; }
.bg-pink { background-color: #EC4899 !important; }
.bg-slate { background-color: #f8fafc; }
.border-pink { border-color: #EC4899 !important; }
.border-slate { border-color: #64748b !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.stat-card { background: #fff; }
</style>

