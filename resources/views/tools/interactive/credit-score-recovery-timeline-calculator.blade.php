<div class="row g-4 recovery-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(34, 197, 94, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #22C55E, #15803D); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#064e3b; letter-spacing: -0.5px;">Credit Resilience & Recovery Planner</h4>
                    <p class="text-muted small mb-0">Model the lifecycle of negative marks. Track when collections, late payments, and inquiries will lose their "sting" and finally expire.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Negative Mark Profile --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Primary Negative Mark</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Incident Type</label>
                                <select id="rec-type" class="form-select border-0 bg-white rounded-3 fw-bold">
                                    <option value="7_late">Late Payment (30-90 Days)</option>
                                    <option value="7_coll">Collection / Charge-Off</option>
                                    <option value="10_bk">Bankruptcy (Chapter 7)</option>
                                    <option value="7_bk">Bankruptcy (Chapter 13)</option>
                                    <option value="2_inq">Hard Inquiry</option>
                                    <option value="7_judg">Public Record / Judgment</option>
                                </select>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Months Since Incident Occurred</label>
                                    <div class="input-group input-group-lg bg-white rounded-3 border">
                                        <input type="number" id="rec-passed" class="form-control border-0 bg-white fw-bold" value="12">
                                        <span class="input-group-text border-0 bg-white opacity-40">Months</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Status Modeling --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-green">
                            <h6 class="fw-bold small mb-3 uppercase text-green opacity-70">Current Context</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Current Estimated Score</label>
                                <input type="number" id="rec-score" class="form-control border-0 bg-light rounded-3 fw-bold" value="620">
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Active Dispute in Progress?</label>
                                    <select id="rec-dispute" class="form-select border-0 bg-light rounded-3 fw-bold">
                                        <option value="0">No active disputes</option>
                                        <option value="1">Validation letter sent</option>
                                        <option value="2">Bureau investigation active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-t="7_late" data-p="24">Old Late (2yr+)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-t="10_bk" data-p="1">Fresh Bankruptcy</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-t="2_inq" data-p="18">Aging Inquiry</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 145; --tool-color: #22C55E; --tool-bg: rgba(34, 197, 94, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">ESTIMATED EXPIRATION IN</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-rem">6.0 Yrs</div>
                <div class="badge bg-green-soft text-green px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-verdict">Slight Impact Remaining</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Recovery Timeline --}}
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Score Impact Life-Cycle</h6>
                        <div class="timeline-container ps-3 border-start border-2 border-light position-relative">
                            <div class="timeline-item mb-4 position-relative">
                                <div class="dot position-absolute bg-danger" style="width:12px; height:12px; border-radius:50%; left:-21px; top:4px;"></div>
                                <div class="fw-bold small text-muted uppercase mb-1">Phase 1: Peak Impact (0-24 Mo)</div>
                                <div class="small fw-bold text-dark" id="rec-p1">Incident is fresh; lenders see high risk.</div>
                            </div>
                            <div class="timeline-item mb-4 position-relative">
                                <div class="dot position-absolute bg-warning" id="dot-2" style="width:12px; height:12px; border-radius:50%; left:-21px; top:4px;"></div>
                                <div class="fw-bold small text-muted uppercase mb-1">Phase 2: Aging Period (24-60 Mo)</div>
                                <div class="small fw-bold text-dark" id="rec-p2">Impact begins to fade. "Healing" phase active.</div>
                            </div>
                            <div class="timeline-item position-relative">
                                <div class="dot position-absolute bg-success" id="dot-3" style="width:12px; height:12px; border-radius:50%; left:-21px; top:4px;"></div>
                                <div class="fw-bold small text-muted uppercase mb-1">Phase 3: Final Expiration (60-120 Mo)</div>
                                <div class="small fw-bold text-dark" id="rec-p3">Negligible score impact. Mark removed from report.</div>
                            </div>
                        </div>
                    </div>

                    {{-- Insights --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Strategic Advice</h6>
                            <div class="p-3 rounded-4 bg-green-50 border border-green-100 mb-4">
                                <div class="small fw-bold text-green-900" id="out-advice">Loading profile...</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-green rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-export me-2"></i>Copy Recovery Milestones
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
    const typeE = $('rec-type'), passedE = $('rec-passed'), scoreE = $('rec-score'), disputeE = $('rec-dispute');

    function calculate(){
        let type = typeE.value;
        let passed = parseInt(passedE.value) || 0;
        
        let totalLife = 84; // Default 7 yrs
        if(type === '10_bk') totalLife = 120;
        if(type === '2_inq') totalLife = 24;
        
        let rem = Math.max(0, totalLife - passed);
        let rY = (rem / 12).toFixed(1);
        
        $('out-rem').textContent = rY + ' Yrs';
        
        // Status & Advice
        let verdict = ''; let advice = '';
        if(passed < 24) {
            verdict = 'MAXIMUM IMPACT';
            advice = "This incident is fresh. Focus on 100% on-time payments for other accounts to 'dilute' this mark's weight.";
            $('dot-2').style.opacity = '0.3';
            $('dot-3').style.opacity = '0.3';
        } else if(passed < 60 && totalLife > 24) {
            verdict = 'MODERATE RECOVERY';
            advice = "The 'sting' of this mark is fading. Lenders still see it, but it carries much less weight than it did in the first 2 years.";
            $('dot-2').style.opacity = '1';
            $('dot-3').style.opacity = '0.3';
        } else if(rem > 0) {
            verdict = 'NEGLIGIBLE IMPACT';
            advice = "You are in the home stretch. This mark has almost zero impact on your FICO score now. It's just waiting for the clock to run out.";
            $('dot-2').style.opacity = '1';
            $('dot-3').style.opacity = '1';
        } else {
            verdict = 'EXPIRED / ELIGIBLE FOR REMOVAL';
            advice = "This mark should no longer be on your report. If it is, file a dispute immediately to have it purged.";
            $('out-rem').textContent = 'EXPIRED';
        }

        $('out-verdict').textContent = verdict;
        $('out-advice').textContent = advice;
    }

    [typeE, passedE, scoreE, disputeE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            typeE.value = btn.dataset.t;
            passedE.value = btn.dataset.p;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        typeE.value = '7_late'; passedE.value = 12; scoreE.value = 620; disputeE.value = 0;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Credit Recovery Timeline\nExpiration: ${$('out-rem').textContent}\nStatus: ${$('out-verdict').textContent}\nStrategic Advice: ${$('out-advice').textContent}\nGenerated by ToolsHub Repair Pro`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.recovery-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#064e3b;opacity:.7;margin-bottom:8px;display:block}
.recovery-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-green { background: #22C55E; color: #fff; transition: all .3s; }
.btn-green:hover { background: #15803D; color: #fff; transform: translateY(-2px); }
.text-green { color: #22C55E; }
.text-green-900 { color: #064e3b; }
.bg-green-soft { background: #F0FDF4; }
.bg-green-50 { background-color: #f8fafc; }
.bg-green { background-color: #22C55E !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.timeline-item { padding-left: 20px; }
</style>

