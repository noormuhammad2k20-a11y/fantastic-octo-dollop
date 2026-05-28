<div class="row g-4 cyber-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #020617; box-shadow: 0 4px 30px rgba(239, 68, 68, .1);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-danger" style="background: linear-gradient(135deg, #EF4444, #991B1B); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; border: 1px solid rgba(239, 68, 68, 0.3);">
                    <i class="fas fa-shield-virus"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#f8fafc; letter-spacing: -0.5px;">Cyber Breach Impact Matrix</h4>
                    <p class="text-slate-400 small mb-0">Quantifying financial liability, regulatory exposure, and remediation costs for data exfiltration events.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Breach Scope --}}
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-slate-900 border border-slate-800 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-slate-500">Breach Parameters</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom text-slate-400">Total Records Compromised</label>
                                    <input type="number" id="v-records" class="form-control border-0 bg-slate-800 text-white shadow-sm rounded-3 fw-bold h5 mb-0" value="5000">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom text-slate-400">Industry Vertical</label>
                                    <select id="v-industry" class="form-select border-0 bg-slate-800 text-white shadow-sm rounded-3 fw-bold">
                                        <option value="9.44">Healthcare (High Risk)</option>
                                        <option value="5.97">Financial Services</option>
                                        <option value="4.45" selected>Technology / SaaS</option>
                                        <option value="3.50">Retail / Education</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom text-slate-400">Detection Window (Days to Find)</label>
                                <div class="input-group">
                                    <input type="number" id="v-days" class="form-control border-0 bg-slate-800 text-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="212">
                                    <span class="input-group-text border-0 bg-slate-800 text-slate-500 small">days</span>
                                </div>
                                <div class="small text-slate-600 mt-2">Avg. detection time in 2023 was 204 days.</div>
                            </div>
                        </div>
                    </div>

                    {{-- Data Sensitivity --}}
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-slate-900 border-red-900/30">
                            <h6 class="fw-bold small mb-3 uppercase text-red-500 opacity-70">Exfiltrated Data Vectors</h6>
                            <div class="vstack gap-3">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-slate-300">Personal Health Info (PHI)</label>
                                    <input class="form-check-input" type="checkbox" id="v-phi">
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-slate-300">Financial / PII Records</label>
                                    <input class="form-check-input" type="checkbox" id="v-pii" checked>
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-slate-300">Intellectual Property</label>
                                    <input class="form-check-input" type="checkbox" id="v-ip">
                                </div>
                                <hr class="border-slate-800 my-1">
                                <div class="p-3 rounded-3 bg-red-900/10 border border-red-900/30 text-center">
                                    <div class="small fw-bold text-red-400">GDPR/CCPA RISK</div>
                                    <div class="h5 fw-900 text-red-500 mb-0" id="out-fine">HIGH EXPOSURE</div>
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
        <div class="output-card-themed" style="--tool-hue: 0; --tool-color: #EF4444; --tool-bg: rgba(239, 68, 68, .04);">
            <div class="output-hero text-center py-5" style="background: radial-gradient(circle at center, rgba(239, 68, 68, 0.05) 0%, transparent 70%);">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small text-red-600">PROJECTED TOTAL BREACH COST</span>
                <div class="output-hero-value display-1 fw-900 my-2 text-slate-900" id="out-total">$2.2M</div>
                <div class="badge bg-red-soft text-red px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-per-record">$164 per record</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Cost Matrix --}}
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Financial Liability Matrix</h6>
                        <div class="row g-2">
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">LEGAL & REGULATORY</div><div class="h5 fw-bold mb-0 text-red" id="out-legal">$450k</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">LOST BUSINESS</div><div class="h5 fw-bold mb-0 text-red" id="out-lost">$1.2M</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">NOTIFICATION</div><div class="h5 fw-bold mb-0 text-red" id="out-notify">$120k</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">REMEDIATION</div><div class="h5 fw-bold mb-0 text-red" id="out-fix">$430k</div></div></div>
                        </div>
                    </div>

                    {{-- Risk Advice --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Mitigation Roadmap</h6>
                            <div class="p-3 rounded-4 bg-red-50 border border-red-100 mb-4">
                                <div class="small fw-bold text-red-900 mb-1">CRITICAL INCIDENT ALERT</div>
                                <div class="small text-muted lh-base" id="out-advice">Detection window exceeds average by 12%. Costs increase exponentially after 200 days.</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-red rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-shield me-2"></i>Copy Risk Assessment
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Clear Matrix
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
    const recE = $('v-records'), indE = $('v-industry'), daysE = $('v-days'), phiE = $('v-phi'), piiE = $('v-pii'), ipE = $('v-ip');

    function calculate(){
        const recs = parseFloat(recE.value) || 0;
        const baseCostPerRec = parseFloat(indE.value) * 35; // Scalar for demo
        const days = parseFloat(daysE.value) || 200;

        // Modifiers
        let mod = 1.0;
        if(phiE.checked) mod += 0.45;
        if(piiE.checked) mod += 0.25;
        if(ipE.checked) mod += 0.35;
        if(days > 200) mod += (days - 200) * 0.005;

        const perRec = baseCostPerRec * mod;
        const total = recs * perRec;

        $('out-total').textContent = total > 1e6 ? '$' + (total/1e6).toFixed(1) + 'M' : '$' + Math.round(total).toLocaleString();
        $('out-per-record').textContent = '$' + Math.round(perRec) + ' per record';

        // Distribution
        $('out-legal').textContent = '$' + Math.round(total * 0.25).toLocaleString();
        $('out-lost').textContent = '$' + Math.round(total * 0.45).toLocaleString();
        $('out-notify').textContent = '$' + Math.round(total * 0.10).toLocaleString();
        $('out-fix').textContent = '$' + Math.round(total * 0.20).toLocaleString();

        $('out-fine').textContent = (phiE.checked || piiE.checked) ? 'HIGH EXPOSURE' : 'MODERATE';
        
        let adv = "Implement incident response playbooks to reduce detection time.";
        if(days > 250) adv = "CRITICAL: Extended breach window. Costs are 30% higher than baseline.";
        if(phiE.checked) adv = "Sensitive health data involved. HIPAA fines may apply regardless of notification speed.";
        $('out-advice').textContent = adv;
    }

    [recE, indE, daysE, phiE, piiE, ipE].forEach(e => e.addEventListener('input', calculate));

    $('copy-summary').addEventListener('click', function(){
        const txt = `Cyber Breach Risk Report\nRecords: ${recE.value}\nProjected Cost: ${$('out-total').textContent}\nCost/Record: ${$('out-per-record').textContent}\nGenerated by ToolsHub Cyber Analyst`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Assessment Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { recE.value = 5000; daysE.value = 212; calculate(); });

    calculate();
});
</script>

<style>
.cyber-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#94a3b8;opacity:.7;margin-bottom:8px;display:block}
.cyber-rebuilt .calculator-card { transition: all 0.3s ease; }
.pulse-danger { animation: pulse-danger 2s infinite; }
@keyframes pulse-danger { 0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); } 100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); } }
.btn-red { background: #EF4444; color: #fff; transition: all .3s; }
.btn-red:hover { background: #DC2626; color: #fff; transform: translateY(-2px); }
.bg-red-soft { background: #FEF2F2; color: #EF4444; }
.bg-red-50 { background-color: #fff9f9; }
.text-slate-400 { color: #94a3b8; }
.bg-slate-900 { background-color: #020617; }
.bg-slate-800 { background-color: #0f172a; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>
