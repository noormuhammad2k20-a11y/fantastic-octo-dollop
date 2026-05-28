<div class="row g-4 inquiry-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(239, 68, 68, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #EF4444, #991B1B); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-search-dollar"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#450a0a; letter-spacing: -0.5px;">Hard Inquiry Impact Tracker</h4>
                    <p class="text-muted small mb-0">Forecast score volatility from credit applications. Understand "rate shopping" grouping and inquiry expiration windows.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Profile Strength</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Current Estimated Score</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <input type="number" id="inq-base" class="form-control border-0 bg-white fw-bold" value="720">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Total Active Accounts</label>
                                    <input type="number" id="inq-total-accts" class="form-control border-0 bg-white rounded-3 fw-bold" value="8">
                                    <div class="small text-muted mt-1">Larger profiles are more resilient to inquiries.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-red">
                            <h6 class="fw-bold small mb-3 uppercase text-red opacity-70">Application Velocity</h6>
                            <div class="mb-4">
                                <label class="form-label-custom text-red">New Inquiries (Last 12 Mo)</label>
                                <div class="d-flex align-items-center gap-2">
                                    <button class="btn btn-red-soft btn-sm rounded-3 inq-step" data-dir="-1" data-id="inq-12" style="min-width: 280px; max-width: 100%;">-</button>
                                    <input type="number" id="inq-12" class="form-control text-center border-0 bg-light rounded-3 fw-bold h3 mb-0 py-2" value="1">
                                    <button class="btn btn-red-soft btn-sm rounded-3 inq-step" data-dir="1" data-id="inq-12" style="min-width: 280px; max-width: 100%;">+</button>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Old Inquiries (13-24 Mo)</label>
                                <input type="number" id="inq-24" class="form-control border-0 bg-light rounded-3 fw-bold" value="0">
                                <div class="small text-muted mt-1">Zero score impact, but visible to lenders.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-v="5">Mortgage Shopping (Grouped)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-v="1">Single Card App</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 0; --tool-color: #EF4444; --tool-bg: rgba(239, 68, 68, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">PROJECTED SCORE IMPACT</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-pts">0 PTS</div>
                <div class="badge bg-red-soft text-red px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">SAFE / LOW IMPACT</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">INQUIRY AUDIT</th>
                                        <th class="text-muted small fw-bold py-3 text-end">VALUES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Estimated Adjusted Score</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-adj-score">0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Denial Probability Lift</td>
                                        <td class="py-3 text-end text-danger" id="tbl-denial">+0%</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">Months to Recover</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-recovery">0 Months</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Strategic Advice</h6>
                            <div class="p-3 rounded-4 bg-red-50 border border-red-100 mb-4">
                                <div class="small fw-bold text-red-900" id="out-advice">Your inquiry level is healthy. Lenders usually only worry when you have 4+ inquiries in 6 months.</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-red rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-radiation me-2"></i>Copy Inquiry Analysis
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset
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
    const baseE = $('inq-base'), inq12E = $('inq-12'), inq24E = $('inq-24'), acctsE = $('inq-total-accts');

    function calculate(){
        let base = parseInt(baseE.value) || 720;
        let i12 = parseInt(inq12E.value) || 0;
        let accts = parseInt(acctsE.value) || 1;

        // FICO Logic: Impact is lower for larger profiles.
        let factor = accts > 15 ? 3 : (accts > 5 ? 5 : 8);
        let pts = i12 * factor;
        if(pts > 50) pts = 50; // Cap

        let adj = Math.max(300, base - pts);
        let denialLift = i12 * 4;

        // Update UI
        $('out-pts').textContent = pts === 0 ? '0 PTS' : '-' + pts + ' PTS';
        $('tbl-adj-score').textContent = adj;
        $('tbl-denial').textContent = '+' + denialLift + '%';
        $('tbl-recovery').textContent = i12 > 0 ? '12 Months' : '0 Months';

        let status = ''; let advice = ''; let col = '';
        if(i12 >= 6) {
            status = 'CRITICAL RISK'; col = '#991b1b';
            advice = "STOP applying immediately. Your profile is flagged as 'credit seeking'. Expect automatic denials regardless of your score.";
        } else if(i12 >= 3) {
            status = 'CAUTION'; col = '#f59e0b';
            advice = "You are entering the risk zone. Consider waiting 6 months before your next major application.";
        } else {
            status = 'SAFE / LOW IMPACT'; col = '#10b981';
            advice = "Your application velocity is within normal lender tolerance levels.";
        }

        $('out-status').textContent = status;
        $('out-status').style.color = col;
        $('out-advice').textContent = advice;
    }

    [baseE, inq12E, inq24E, acctsE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.inq-step').forEach(btn => {
        btn.addEventListener('click', () => {
            let el = $(btn.dataset.id);
            el.value = Math.max(0, (parseInt(el.value)||0) + parseInt(btn.dataset.dir));
            calculate();
        });
    });

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            if(btn.dataset.v === '5') {
                // Grouped Mortgage
                inq12E.value = 1;
                alert("Mortgage/Auto rate shopping pulls within 14-45 days are grouped as ONE inquiry for FICO scoring.");
            } else {
                inq12E.value = 1;
            }
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        baseE.value = 720; inq12E.value = 1; inq24E.value = 0; acctsE.value = 8;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Credit Inquiry Impact Analysis\nImpact: ${$('out-pts').textContent}\nRisk Status: ${$('out-status').textContent}\nAdvice: ${$('out-advice').textContent}\nGenerated by ToolsHub Credit Guard`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.inquiry-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#450a0a;opacity:.7;margin-bottom:8px;display:block}
.inquiry-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-red { background: #EF4444; color: #fff; transition: all .3s; }
.btn-red:hover { background: #991B1B; color: #fff; transform: translateY(-2px); }
.btn-red-soft { background: #FEF2F2; color: #EF4444; border: 1px solid #FEE2E2; }
.text-red { color: #EF4444; }
.text-red-900 { color: #450a0a; }
.bg-red-soft { background: #FEF2F2; }
.bg-red { background-color: #EF4444 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\credit-inquiry-impact.blade.php ENDPATH**/ ?>