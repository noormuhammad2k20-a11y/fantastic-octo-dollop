<?php echo $__env->make('tools.partials.medical-disclaimer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="row g-4 blood-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(220, 38, 38, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #DC2626, #B91C1C); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#7f1d1d; letter-spacing: -0.5px;">BP & MAP Optimizer</h4>
                    <p class="text-muted small mb-0">Complete cardiovascular risk stratification and blood pressure staging engine.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Measurement Entry</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom">Systolic (Top)</label>
                                    <div class="input-group">
                                        <input type="number" id="v-sbp" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="120">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">mmHg</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Diastolic (Bottom)</label>
                                    <div class="input-group">
                                        <input type="number" id="v-dbp" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="80">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">mmHg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Observation Context</label>
                                <select id="v-context" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                    <option value="office">🏥 Clinic / Office Setting</option>
                                    <option value="home">🏠 Home Monitoring</option>
                                    <option value="ambulatory">⌚ Ambulatory (24h)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-red">
                            <h6 class="fw-bold small mb-3 uppercase text-red opacity-70">Patient Profile</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Hypertension Stage Target</label>
                                <select id="v-target" class="form-select border-0 bg-light rounded-3 fw-bold py-2">
                                    <option value="120">Normal (< 120/80)</option>
                                    <option value="130">Elevated (120-129)</option>
                                    <option value="140">Stage 1 (130-139)</option>
                                </select>
                            </div>
                            <div class="p-3 rounded-4 bg-red-50 border border-red-100">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="small fw-bold text-red-900">BP STAGE</span>
                                    <span class="badge bg-red text-white" id="out-stage">NORMAL</span>
                                </div>
                                <div class="progress" style="height: 6px; background: #fee2e2;">
                                    <div class="progress-bar bg-red" id="out-prog" style="width: 50%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 0; --tool-color: #DC2626; --tool-bg: rgba(220, 38, 38, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">BLOOD PRESSURE ANALYSIS</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-map">93</div>
                <div class="badge bg-red-soft text-red px-4 py-2 rounded-pill fw-bold shadow-sm">MAP (mmHg)</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Cardiovascular Risk Matrix</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless align-middle mb-0">
                                <tbody>
                                    <tr>
                                        <td class="py-2 text-muted fw-bold small">PULSE PRESSURE</td>
                                        <td class="py-2 text-end fw-bold text-red" id="out-pp">40 mmHg</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-muted fw-bold small">HEART WORKLOAD</td>
                                        <td class="py-2 text-end fw-bold text-red" id="out-work">STABLE</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-muted fw-bold small">AHA/ACC CATEGORY</td>
                                        <td class="py-2 text-end fw-bold text-red" id="out-cat">NORMAL</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Clinical Note</h6>
                            <div class="p-3 rounded-4 bg-red-50 border border-red-100 mb-4">
                                <p class="small fw-bold text-red-900 mb-0 lh-base" id="out-advice">Synchronizing metrics...</p>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-red rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy BP Record
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
    const sbpE = $('v-sbp'), dbpE = $('v-dbp'), ctxE = $('v-context');

    function calculate(){
        const sbp = parseFloat(sbpE.value) || 0;
        const dbp = parseFloat(dbpE.value) || 0;
        
        const map = dbp + (1/3 * (sbp - dbp));
        const pp = sbp - dbp;

        $('out-map').textContent = Math.round(map);
        $('out-pp').textContent = pp + ' mmHg';

        // AHA Staging
        let stage = "NORMAL";
        let color = "#10b981";
        let prog = 25;
        let advice = "Your blood pressure is within the healthy range. Continue regular monitoring and a heart-healthy lifestyle.";

        if(sbp >= 180 || dbp >= 120) { 
            stage = "CRISIS"; color = "#991b1b"; prog = 100; 
            advice = "HYPERTENSIVE CRISIS. Consult your doctor immediately if you have chest pain or shortness of breath.";
        }
        else if(sbp >= 140 || dbp >= 90) { 
            stage = "STAGE 2"; color = "#dc2626"; prog = 85; 
            advice = "Hypertension Stage 2. Medical evaluation is recommended to discuss management strategies.";
        }
        else if(sbp >= 130 || dbp >= 80) { 
            stage = "STAGE 1"; color = "#f59e0b"; prog = 65; 
            advice = "Hypertension Stage 1. Lifestyle modifications and monitoring are essential.";
        }
        else if(sbp >= 120) { 
            stage = "ELEVATED"; color = "#facc15"; prog = 45; 
            advice = "Blood pressure is elevated. Monitor trends closely and consider sodium reduction.";
        }

        $('out-stage').textContent = stage;
        $('out-stage').style.backgroundColor = color;
        $('out-prog').style.width = prog + '%';
        $('out-prog').style.backgroundColor = color;
        $('out-cat').textContent = stage;
        $('out-cat').style.color = color;
        $('out-pp').style.color = pp > 60 ? '#ef4444' : color;
        $('out-advice').textContent = advice;
        $('out-work').textContent = map > 110 ? 'HIGH' : 'STABLE';
        $('out-work').style.color = map > 110 ? '#ef4444' : '#10b981';
    }

    [sbpE, dbpE, ctxE].forEach(e => e.addEventListener('input', calculate));

    $('copy-summary').addEventListener('click', function(){
        const txt = `BP & MAP Summary\nBP: ${sbpE.value}/${dbpE.value} mmHg\nCategory: ${$('out-stage').textContent}\nMAP: ${$('out-map').textContent} mmHg\nGenerated by ToolsHub BP Optimizer`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Record Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('reset-calc').addEventListener('click', () => {
        sbpE.value = 120; dbpE.value = 80; calculate();
    });

    calculate();
});
</script>

<style>
.blood-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#7f1d1d;opacity:.7;margin-bottom:8px;display:block}
.blood-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-red { background: #DC2626; color: #fff; transition: all .3s; }
.btn-red:hover { background: #B91C1C; color: #fff; transform: translateY(-2px); }
.bg-red-soft { background: #FEF2F2; color: #DC2626; }
.bg-red-50 { background-color: #fef2f2; }
.bg-red { background-color: #DC2626 !important; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\bp-map-calculator.blade.php ENDPATH**/ ?>