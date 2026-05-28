<div class="row g-4 airbnb-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(255, 90, 95, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #FF5A5F, #D70466); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-bed"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#484848; letter-spacing: -0.5px;">Airbnb Profit Planner</h4>
                    <p class="text-muted small mb-0">Optimize your short-term rental revenue by modeling occupancy and seasonal trends.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Column 1: Pricing & Volume --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light h-100 border">
                            <h6 class="fw-bold small mb-3 text-uppercase opacity-50">Earnings & Traffic</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Avg. Nightly Rate</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                    <input type="number" id="ab-nightly" class="form-control border-0 bg-white fw-bold" value="150">
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <label class="form-label-custom mb-0">Target Occupancy (%)</label>
                                    <span class="fw-bold text-coral" id="ab-occ-val">65%</span>
                                </div>
                                <input type="range" class="form-range color-coral" id="ab-occupancy" min="0" max="100" step="5" value="65">
                                <div class="small text-muted mt-1">(Effective: <span id="ab-nights-val">20</span> nights / month)</div>
                            </div>
                            <div class="row g-2">
                                <div class="col-6">
                                    <label class="form-label-custom">Seasonality</label>
                                    <select id="ab-season" class="form-select border-0 bg-white rounded-3 fw-bold">
                                        <option value="1.0">Off-Season (1.0x)</option>
                                        <option value="1.5" selected>Shoulder (1.5x)</option>
                                        <option value="2.2">Peak Season (2.2x)</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Stays / Month</label>
                                    <input type="number" id="ab-stays" class="form-control border-0 bg-white rounded-3 fw-bold" value="5">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Column 2: Operation & Fixed Costs --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white">
                            <h6 class="fw-bold small mb-3 text-uppercase opacity-50">Operating Costs</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Rent / Mortgage</label>
                                    <input type="number" id="ab-fixed" class="form-control border-0 bg-light rounded-3 fw-bold" value="1800">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Cleaning Fee / Stay</label>
                                    <input type="number" id="ab-cleaning" class="form-control border-0 bg-light rounded-3 fw-bold" value="85">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Utilities & Web</label>
                                    <input type="number" id="ab-utils" class="form-control border-0 bg-light rounded-3 fw-bold" value="350">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Software & Ops</label>
                                    <input type="number" id="ab-ops" class="form-control border-0 bg-light rounded-3 fw-bold" value="75">
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="form-label-custom">Platform Fee (Airbnb: 3%)</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="ab-fee-toggle" checked>
                                    <label class="form-check-label small fw-bold text-muted">Include Host Service Fee</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-n="250" data-o="85" data-f="2500">Luxury Penthouse</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-n="85" data-o="50" data-f="900">Budget Studio</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-n="150" data-o="65" data-f="1800">Standard Rental</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 0; --tool-color: #FF5A5F; --tool-bg: rgba(255, 90, 95, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">ESTIMATED MONTHLY PROFIT</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-profit">$0</div>
                <div class="d-flex justify-content-center gap-2">
                    <span class="badge bg-coral-soft text-coral px-3 py-2 rounded-pill fw-bold" id="out-margin-label">Profit Margin: 0%</span>
                    <span class="badge bg-coral-soft text-coral px-3 py-2 rounded-pill fw-bold" id="out-rev-annual">$0 / yr</span>
                </div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Breakdown --}}
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">REVENUE & EXPENSE FLOW</th>
                                        <th class="text-muted small fw-bold py-3 text-end">MONTHLY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Gross Booking Revenue</td>
                                        <td class="py-3 fw-bold text-end text-success" id="tbl-gross">$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Cleaning Fees (Pass-through)</td>
                                        <td class="py-3 fw-bold text-end text-success" id="tbl-cleaning">+$0</td>
                                    </tr>
                                    <tr class="text-danger">
                                        <td class="py-3 fw-bold">Platform Service Fees (3%)</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-fees">-$0</td>
                                    </tr>
                                    <tr class="text-danger">
                                        <td class="py-3 fw-bold">Fixed Costs (Rent/Ops)</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-fixed">-$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black h5 mb-0">NET EARNINGS</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-net">$0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Summary & Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold mb-3 uppercase small opacity-50">Business Health</h6>
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="small fw-bold">Efficiency Score</span>
                                    <span class="small fw-bold" id="out-score">0%</span>
                                </div>
                                <div class="progress rounded-pill" style="height: 12px; background: #f1f5f9;">
                                    <div id="bar-score" class="progress-bar bg-coral" style="width: 50%"></div>
                                </div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-coral rounded-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy P&L Summary
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Planner
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
    const nightlyE = $('ab-nightly'), occE = $('ab-occupancy'), seasonE = $('ab-season'),
          staysE = $('ab-stays'), fixedE = $('ab-fixed'), cleanE = $('ab-cleaning'),
          utilsE = $('ab-utils'), opsE = $('ab-ops'), feeE = $('ab-fee-toggle');

    function calculate(){
        let nightly = parseFloat(nightlyE.value) || 0;
        let occ = (parseFloat(occE.value) || 0) / 100;
        let mult = parseFloat(seasonE.value) || 1;
        let stays = parseInt(staysE.value) || 0;
        
        let rent = parseFloat(fixedE.value) || 0;
        let cleanFee = parseFloat(cleanE.value) || 0;
        let utils = parseFloat(utilsE.value) || 0;
        let ops = parseFloat(opsE.value) || 0;
        
        let nights = Math.round(30 * occ);
        $('ab-occ-val').textContent = (occ * 100) + '%';
        $('ab-nights-val').textContent = nights;

        let bookingRev = (nightly * mult) * nights;
        let cleanRev = cleanFee * stays;
        let grossTotal = bookingRev + cleanRev;
        
        let platformFee = feeE.checked ? (bookingRev * 0.03) : 0;
        let totalFixed = rent + utils + ops;
        
        // We assume cleaning fees go to cleaners, but they are revenue first
        // If the user wants profit, they either pay cleaners or do it themselves. 
        // We'll treat cleaning revenue as neutral for profit (offset by cost)
        let netProfit = bookingRev - platformFee - totalFixed;
        let margin = grossTotal > 0 ? (netProfit / grossTotal) * 100 : 0;

        // Update UI
        $('out-profit').textContent = '$' + Math.round(netProfit).toLocaleString();
        $('out-margin-label').textContent = 'Profit Margin: ' + Math.round(margin) + '%';
        $('out-rev-annual').textContent = '$' + Math.round(netProfit * 12).toLocaleString() + ' / yr';
        
        $('tbl-gross').textContent = '$' + Math.round(bookingRev).toLocaleString();
        $('tbl-cleaning').textContent = '+$' + Math.round(cleanRev).toLocaleString();
        $('tbl-fees').textContent = '-$' + Math.round(platformFee).toLocaleString();
        $('tbl-fixed').textContent = '-$' + Math.round(totalFixed).toLocaleString();
        $('tbl-net').textContent = '$' + Math.round(netProfit).toLocaleString();

        $('out-score').textContent = Math.round(margin) + '%';
        $('bar-score').style.width = Math.max(0, Math.min(100, margin)) + '%';
    }

    [nightlyE, occE, seasonE, staysE, fixedE, cleanE, utilsE, opsE, feeE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            nightlyE.value = btn.dataset.n;
            occE.value = btn.dataset.o;
            fixedE.value = btn.dataset.f;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        nightlyE.value = 150; occE.value = 65; seasonE.value = "1.5";
        staysE.value = 5; fixedE.value = 1800; cleanE.value = 85;
        utilsE.value = 350; opsE.value = 75; feeE.checked = true;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Airbnb P&L Estimate\nNet Profit: ${$('out-profit').textContent}\nMargin: ${$('out-score').textContent}\nOccupancy: ${occE.value}%\nGenerated by ToolsHub Hospitality`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.airbnb-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#484848;opacity:.7;margin-bottom:8px;display:block}
.airbnb-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-coral { background: #FF5A5F; color: #fff; transition: all .3s; }
.btn-coral:hover { background: #D70466; color: #fff; transform: translateY(-2px); }
.text-coral { color: #FF5A5F; }
.bg-coral-soft { background: #FFF1F2; }
.bg-coral { background-color: #FF5A5F !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.color-coral::-webkit-slider-thumb { background: #FF5A5F; }
.color-coral::-moz-range-thumb { background: #FF5A5F; }
.uppercase { text-transform: uppercase; }
</style>

