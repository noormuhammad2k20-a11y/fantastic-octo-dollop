<div class="row g-4 strategy-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(20, 184, 166, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #14B8A6, #0D9488); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-chess-king"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#0f172a; letter-spacing: -0.5px;">Account Strategy & Velocity Command</h4>
                    <p class="text-muted small mb-0">Model complex issuer rules like Chase 5/24, Citi 1/6, and Amex velocity limits. Plan your application sequence for maximum approval odds.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Velocity Metrics --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Velocity Profile</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">New Cards (Past 24 Mo)</label>
                                    <input type="number" id="v-24mo" class="form-control border-0 bg-white rounded-3 fw-bold h4 mb-0 py-2" value="3">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Hard Inq (Past 6 Mo)</label>
                                    <input type="number" id="v-6mo-inq" class="form-control border-0 bg-white rounded-3 fw-bold h4 mb-0 py-2" value="1">
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Months Since Last Card</label>
                                    <input type="number" id="v-last-card" class="form-control border-0 bg-white rounded-3 fw-bold" value="4">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Issuer Target --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-teal">
                            <h6 class="fw-bold small mb-3 uppercase text-teal opacity-70">Target Issuer</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Primary Lender Rule</label>
                                <select id="v-issuer" class="form-select border-0 bg-light rounded-3 fw-bold">
                                    <option value="chase">Chase (5/24 Rule)</option>
                                    <option value="citi">Citi (1/6 Inquiry Sensitivity)</option>
                                    <option value="amex">Amex (2/90 Velocity + Pop-up Jail)</option>
                                    <option value="cap1">Capital One (Rule of 1/6 months)</option>
                                </select>
                            </div>
                            <div class="form-check form-switch p-0 d-flex align-items-center justify-content-between">
                                <label class="form-check-label fw-bold small text-muted">Existing Relationship / Deposits?</label>
                                <input class="form-check-input ms-0" type="checkbox" id="v-rel">
                            </div>
                            <div class="small text-muted mt-2">Active accounts or large deposits can sometimes bypass strict velocity rules.</div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-c="4" data-i="0">At the Brink (4/24)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-c="0" data-i="0">Clean Slate (0/24)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-c="5" data-i="2">Over the Edge (5+/24)</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 175; --tool-color: #14B8A6; --tool-bg: rgba(20, 184, 166, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">APPROVAL PROBABILITY</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-status">HIGH</div>
                <div class="badge bg-teal-soft text-teal px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-verdict">Strategic Alignment: Clear</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Summary --}}
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">RULE COMPLIANCE</th>
                                        <th class="text-muted small fw-bold py-3 text-end">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold" id="lbl-rule-1">5/24 Status</td>
                                        <td class="py-3 text-end fw-bold" id="val-rule-1">3 / 5</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold" id="lbl-rule-2">Inquiry Velocity</td>
                                        <td class="py-3 text-end" id="val-rule-2">Low Risk</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">Wait Until Next App</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="val-wait">0 Months</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Advice --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Command Recommendation</h6>
                            <div class="p-3 rounded-4 bg-teal-50 border border-teal-100 mb-4">
                                <div class="small fw-bold text-teal-900" id="out-advice">Loading tactical analysis...</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-teal rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-export me-2"></i>Copy Eligibility Report
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
    const inputs = ['v-24mo', 'v-6mo-inq', 'v-last-card', 'v-issuer', 'v-rel'];

    function calculate(){
        let c24 = parseInt($('v-24mo').value) || 0;
        let inq = parseInt($('v-6mo-inq').value) || 0;
        let last = parseInt($('v-last-card').value) || 0;
        let issuer = $('v-issuer').value;
        let rel = $('v-rel').checked;

        let status = 'HIGH'; let verdict = 'Strategic Alignment: Clear'; let col = '#10b981';
        let rule1 = ''; let rule2 = ''; let wait = 0;
        let advice = '';

        if(issuer === 'chase') {
            rule1 = `${c24} / 5 Slots Used`;
            rule2 = inq > 2 ? 'Inquiry Sensitive' : 'Safe';
            if(c24 >= 5) {
                status = 'LOW (AUTO-DENY)'; verdict = '5/24 Limit Reached'; col = '#ef4444';
                advice = "You are over the 5/24 limit. Chase will automatically deny any new credit card application until you drop to 4/24.";
                wait = 6; // Placeholder
            } else if(c24 === 4) {
                status = 'MODERATE'; verdict = '1 Slot Remaining'; col = '#f59e0b';
                advice = "You have exactly one slot left before hitting 5/24. Prioritize a high-value Chase business card first if possible.";
            } else {
                advice = "You are well within the 5/24 boundaries. Safe to apply for most Chase products.";
            }
        } else if(issuer === 'citi') {
            rule1 = `${inq} / 6 Inquiries`;
            rule2 = last < 6 ? 'New Account Sensitive' : 'Safe';
            if(inq >= 6) {
                status = 'LOW'; verdict = 'Excessive Inquiries'; col = '#ef4444';
                advice = "Citi is notoriously sensitive to hard pulls. 6 inquiries in 6 months is an automatic barrier for most.";
                wait = 3;
            } else {
                advice = "Inquiry velocity looks manageable. Citi 1/6 rule (one app per 6 months) should be observed.";
            }
        } else if(issuer === 'amex') {
            rule1 = 'Velocity: 2/90';
            rule2 = c24 > 6 ? 'Pop-up Jail Risk' : 'Safe';
            if(last < 3) {
                status = 'MODERATE'; verdict = 'Velocity Warning'; col = '#f59e0b';
                advice = "Observe the 2/90 rule (max 2 credit cards in 90 days). You may also face 'Pop-up Jail' (denial of SUB) if velocity is too high.";
            } else {
                advice = "Amex is generally the most lenient on velocity, provided you aren't currently in their bonus blacklist.";
            }
        }

        if(rel) {
            advice += " Existing relationship detected: approval odds may be slightly higher than models suggest.";
            if(status === 'LOW') status = 'LOW-MODERATE';
        }

        $('out-status').textContent = status;
        $('out-status').style.color = col;
        $('out-verdict').textContent = verdict;
        $('val-rule-1').textContent = rule1;
        $('val-rule-2').textContent = rule2;
        $('val-wait').textContent = wait + ' Months';
        $('out-advice').textContent = advice;
    }

    inputs.forEach(id => $(id).addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            $('v-24mo').value = btn.dataset.c;
            $('v-6mo-inq').value = btn.dataset.i;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        $('v-24mo').value = 3; $('v-6mo-inq').value = 1; $('v-last-card').value = 4;
        $('v-issuer').value = 'chase'; $('v-rel').checked = false;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Credit Strategy Eligibility Report\nIssuer: ${$('v-issuer').value}\nStatus: ${$('out-status').textContent}\nAdvice: ${$('out-advice').textContent}\nGenerated by ToolsHub Command Center`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.strategy-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#0f172a;opacity:.7;margin-bottom:8px;display:block}
.strategy-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-teal { background: #14B8A6; color: #fff; transition: all .3s; }
.btn-teal:hover { background: #0D9488; color: #fff; transform: translateY(-2px); }
.text-teal { color: #14B8A6; }
.text-teal-900 { color: #0f172a; }
.bg-teal-soft { background: #F0FDFA; }
.bg-teal-50 { background-color: #f8fafc; }
.bg-teal { background-color: #14B8A6 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

