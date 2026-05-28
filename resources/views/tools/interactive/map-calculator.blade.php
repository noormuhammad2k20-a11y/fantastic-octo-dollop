@include('tools.partials.medical-disclaimer')

<div class="row g-4 vital-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(20, 184, 166, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-icon" style="background: linear-gradient(135deg, #14B8A6, #0D9488); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#134e4a; letter-spacing: -0.5px;">Mean Arterial Pressure (MAP) Analyst</h4>
                    <p class="text-muted small mb-0">Clinical-grade perfusion analysis and cardiovascular health extraction.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Vitals --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Core Vitals</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom">Systolic (SBP)</label>
                                    <div class="input-group">
                                        <input type="number" id="v-sbp" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="120">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">mmHg</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Diastolic (DBP)</label>
                                    <div class="input-group">
                                        <input type="number" id="v-dbp" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="80">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">mmHg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Heart Rate (Pulse)</label>
                                <div class="input-group">
                                    <input type="number" id="v-hr" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="72">
                                    <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">BPM</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Biometrics --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-teal">
                            <h6 class="fw-bold small mb-3 uppercase text-teal opacity-70">Biometric Context</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom">Patient Age</label>
                                    <input type="number" id="v-age" class="form-control border-0 bg-light rounded-3 fw-bold" value="35">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Measurement State</label>
                                    <select id="v-state" class="form-select border-0 bg-light rounded-3 fw-bold">
                                        <option value="rest">At Rest</option>
                                        <option value="post">Post-Exercise</option>
                                        <option value="stress">Acute Stress</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Perfusion Goal (Minimum)</label>
                                <select id="v-goal" class="form-select border-0 bg-light rounded-3 fw-bold">
                                    <option value="65">Standard ICU (65 mmHg)</option>
                                    <option value="70">Normal Healthy (70 mmHg)</option>
                                    <option value="80">Hypertensive Target (80 mmHg)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="120" data-d="80">Normal BP</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="140" data-d="90">Stage 1 HTN</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="90" data-d="60">Hypotension</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 170; --tool-color: #14B8A6; --tool-bg: rgba(20, 184, 166, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">CALCULATED MEAN ARTERIAL PRESSURE</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-map">93</div>
                <div class="badge bg-teal-soft text-teal px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">OPTIMAL PERFUSION</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Insight --}}
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Clinical Insight Pipeline</h6>
                        <div class="vstack gap-3" id="out-insights">
                            {{-- JS Injected --}}
                        </div>
                    </div>

                    {{-- Stats --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Secondary Metrics</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <div class="p-3 rounded-4 bg-teal-50 border border-teal-100 text-center">
                                        <div class="small fw-bold text-teal-900 opacity-60">Pulse Pressure</div>
                                        <div class="h5 fw-900 text-teal-900 mb-0" id="out-pp">40</div>
                                        <div class="small text-muted">mmHg</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 rounded-4 bg-teal-50 border border-teal-100 text-center">
                                        <div class="small fw-bold text-teal-900 opacity-60">Rate-Pressure Product</div>
                                        <div class="h5 fw-900 text-teal-900 mb-0" id="out-rpp">8640</div>
                                        <div class="small text-muted">mmHg·BPM</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-teal rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-medical me-2"></i>Copy Clinical Note
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
    const sbpE = $('v-sbp'), dbpE = $('v-dbp'), hrE = $('v-hr'), ageE = $('v-age'), stateE = $('v-state'), goalE = $('v-goal');

    function calculate(){
        const sbp = parseFloat(sbpE.value) || 0;
        const dbp = parseFloat(dbpE.value) || 0;
        const hr = parseFloat(hrE.value) || 0;
        const goal = parseFloat(goalE.value) || 65;

        // MAP Formula: DBP + 1/3(SBP - DBP)
        const map = dbp + (1/3 * (sbp - dbp));
        const pp = sbp - dbp;
        const rpp = sbp * hr;

        $('out-map').textContent = Math.round(map);
        $('out-pp').textContent = pp;
        $('out-rpp').textContent = rpp;

        // Status
        let status = "NORMAL";
        let color = "#14B8A6";
        if (map < goal) { status = "LOW PERFUSION"; color = "#ef4444"; }
        else if (map > 110) { status = "HYPERTENSIVE"; color = "#f59e0b"; }
        
        $('out-status').textContent = status;
        $('out-status').style.backgroundColor = color + '15';
        $('out-status').style.color = color;

        // Insights
        let ins = [];
        if(map < 60) ins.push({t: 'CRITICAL', d: 'MAP below 60 mmHg indicates possible shock and inadequate organ perfusion.', c: 'danger'});
        else if(map < 65) ins.push({t: 'WARNING', d: 'Borderline perfusion. Monitoring required for vital organ health.', c: 'warning'});
        else ins.push({t: 'STABLE', d: 'Mean arterial pressure is within acceptable physiological limits for tissue oxygenation.', c: 'success'});

        if(pp > 60) ins.push({t: 'WIDENED PP', d: 'High pulse pressure can indicate arterial stiffness or valve issues.', c: 'info'});
        if(rpp > 12000) ins.push({t: 'MYOCARDIAL DEMAND', d: 'High heart work detected. Oxygen demand of the heart is elevated.', c: 'info'});

        $('out-insights').innerHTML = ins.map(i => `
            <div class="p-3 rounded-4 border border-${i.c}-soft bg-${i.c}-50">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <span class="badge bg-${i.c} text-white">${i.t}</span>
                    <span class="fw-bold small text-dark">Interpretation</span>
                </div>
                <p class="small text-muted mb-0 lh-base">${i.d}</p>
            </div>
        `).join('');
    }

    [sbpE, dbpE, hrE, ageE, stateE, goalE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            sbpE.value = btn.dataset.s;
            dbpE.value = btn.dataset.d;
            calculate();
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `MAP Clinical Analysis\nSBP/DBP: ${sbpE.value}/${dbpE.value} mmHg\nCalculated MAP: ${$('out-map').textContent} mmHg\nPulse Pressure: ${$('out-pp').textContent} mmHg\nStatus: ${$('out-status').textContent}\nGenerated by ToolsHub Vital Analyst`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('reset-calc').addEventListener('click', () => {
        sbpE.value = 120; dbpE.value = 80; hrE.value = 72; calculate();
    });

    calculate();
});
</script>

<style>
.vital-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#134e4a;opacity:.7;margin-bottom:8px;display:block}
.vital-rebuilt .calculator-card { transition: all 0.3s ease; }
.pulse-icon { animation: heart-pulse 2s infinite; }
@keyframes heart-pulse { 0% { transform: scale(1); } 50% { transform: scale(1.05); } 100% { transform: scale(1); } }
.btn-teal { background: #14B8A6; color: #fff; transition: all .3s; }
.btn-teal:hover { background: #0D9488; color: #fff; transform: translateY(-2px); }
.bg-teal-soft { background: #F0FDFA; color: #14B8A6; }
.bg-teal-50 { background-color: #f0fdfa; }
.bg-danger-50 { background-color: #fef2f2; }
.bg-warning-50 { background-color: #fffbeb; }
.bg-success-50 { background-color: #f0fdf4; }
.bg-info-50 { background-color: #f0f9ff; }
.border-danger-soft { border-color: #fee2e2 !important; }
.border-warning-soft { border-color: #fef3c7 !important; }
.border-success-soft { border-color: #dcfce7 !important; }
.border-info-soft { border-color: #e0f2fe !important; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

