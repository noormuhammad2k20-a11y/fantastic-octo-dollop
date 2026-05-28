<div class="row g-4 affiliate-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(180, 83, 9, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #B45309, #78350F); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#451a03; letter-spacing: -0.5px;">Affiliate EPC & ROAS Strategist</h4>
                    <p class="text-muted small mb-0">Optimize marketing conversion pipelines and calculate high-fidelity Earnings Per Click benchmarks.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Conversion Metrics --}}
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Conversion Traffic Data</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom">Total Revenue Generated</label>
                                    <div class="input-group">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-start-3 text-muted small">$</span>
                                        <input type="number" id="v-rev" class="form-control border-0 bg-white shadow-sm rounded-end-3 fw-bold h5 mb-0" value="1000">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Total Traffic (Clicks)</label>
                                    <input type="number" id="v-clicks" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="500">
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Ad Spend / Investment</label>
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-white shadow-sm rounded-start-3 text-muted small">$</span>
                                    <input type="number" id="v-spend" class="form-control border-0 bg-white shadow-sm rounded-end-3 fw-bold h5 mb-0" value="200">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Target Benchmarks --}}
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-amber">
                            <h6 class="fw-bold small mb-3 uppercase text-amber opacity-70">Strategic Benchmarks</h6>
                            <div class="vstack gap-3 text-center">
                                <div class="p-3 rounded-4 bg-amber-50 border border-amber-100">
                                    <div class="small fw-bold text-amber-900 mb-1">PROFIT MARGIN</div>
                                    <div class="h5 fw-900 text-amber-900 mb-0" id="out-margin">80%</div>
                                </div>
                                <div class="p-3 rounded-4 bg-amber-50 border border-amber-100">
                                    <div class="small fw-bold text-amber-900 mb-1">CAMPAIGN TIER</div>
                                    <div class="badge bg-amber text-white" id="out-tier">ELITE PERFORMANCE</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-r="500" data-c="1000" data-s="100">Low Cost / High Volume</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-r="2000" data-c="500" data-s="800">High Value / Low Volume</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-r="5000" data-c="10000" data-s="3000">Scale Mode</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 35; --tool-color: #B45309; --tool-bg: rgba(180, 83, 9, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">EARNINGS PER CLICK (EPC)</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-epc">$2.00</div>
                <div class="badge bg-amber-soft text-amber px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">OPTIMIZED CONVERSION</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Efficiency Matrix --}}
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Efficiency Intelligence Matrix</h6>
                        <div class="row g-2">
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">ROAS</div><div class="h5 fw-bold mb-0" id="out-roas">5.0x</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">ROI</div><div class="h5 fw-bold mb-0" id="out-roi">400%</div></div></div>
                            <div class="col-12">
                                <div class="p-3 rounded-4 bg-amber-50 border border-amber-100 mt-2">
                                    <div class="small fw-bold text-amber-900 mb-1">BREAK-EVEN CPC TARGET</div>
                                    <div class="small text-muted lh-base" id="out-be">You can afford to pay up to <strong>$2.00</strong> per click to stay profitable.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Strategy Export</h6>
                            <div class="p-3 rounded-4 bg-amber-50 border border-amber-100 mb-4">
                                <div class="small fw-bold text-amber-900 lh-base" id="out-advice">Campaign is highly efficient. Consider scaling traffic volume by 20-30%.</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-amber rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-clipboard-check me-2"></i>Copy Strategy Report
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Tracker
                                </button>
                            </div>
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
    const revE = $('v-rev'), clickE = $('v-clicks'), spendE = $('v-spend');

    function calculate(){
        const rev = parseFloat(revE.value) || 0;
        const clicks = parseFloat(clickE.value) || 1;
        const spend = parseFloat(spendE.value) || 1;

        const epc = rev / clicks;
        const roas = rev / spend;
        const roi = ((rev - spend) / spend) * 100;
        const margin = ((rev - spend) / rev) * 100;

        $('out-epc').textContent = '$' + epc.toFixed(2);
        $('out-roas').textContent = roas.toFixed(2) + 'x';
        $('out-roi').textContent = Math.round(roi) + '%';
        $('out-margin').textContent = Math.round(margin) + '%';
        $('out-be').innerHTML = `You can afford to pay up to <strong>$${epc.toFixed(2)}</strong> per click to stay profitable.`;

        // Tiering
        let tier = 'STANDARD';
        let color = '#B45309';
        if(roas > 10) tier = 'GOD TIER';
        else if(roas > 4) tier = 'ELITE';
        else if(roas < 1) tier = 'NEGATIVE';

        $('out-tier').textContent = tier + ' PERFORMANCE';
        $('out-status').textContent = roas > 1 ? 'PROFITABLE CAMPAIGN' : 'LOSS DETECTED';

        let advice = "Campaign is profitable. Focus on increasing click-through rates (CTR).";
        if(roas < 1) advice = "WARNING: Cost exceeds revenue. Optimize your landing page or reduce CPC bid.";
        if(roas > 5) advice = "Excellent scaling potential. Increase daily budget to capture more volume.";
        $('out-advice').textContent = advice;
    }

    [revE, clickE, spendE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => { 
            revE.value = btn.dataset.r; clickE.value = btn.dataset.c; spendE.value = btn.dataset.s; 
            calculate(); 
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Campaign Strategy Report\nRevenue: $${revE.value}\nEPC: ${$('out-epc').textContent}\nROAS: ${$('out-roas').textContent}\nROI: ${$('out-roi').textContent}\nGenerated by ToolsHub Affiliate Strategist`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Report Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { revE.value = 1000; clickE.value = 500; spendE.value = 200; calculate(); });

    calculate();
});
</script>

<style>
.affiliate-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#451a03;opacity:.7;margin-bottom:8px;display:block}
.affiliate-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-amber { background: #B45309; color: #fff; transition: all .3s; }
.btn-amber:hover { background: #92400E; color: #fff; transform: translateY(-2px); }
.bg-amber-soft { background: #FFFBEB; color: #B45309; }
.bg-amber-50 { background-color: #fffaf0; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

