@include('tools.partials.medical-disclaimer')

<div class="row g-4 ascvd-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Demographics --}}
                    <div class="col-md-4">
                        <label class="form-label-custom">Age (40-79)</label>
                        <input type="number" id="ascvd-age" class="form-control form-control-lg rounded-3" value="55" min="40" max="79">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Gender</label>
                        <select id="ascvd-gender" class="form-select form-select-lg rounded-3">
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Race</label>
                        <select id="ascvd-race" class="form-select form-select-lg rounded-3">
                            <option value="white" selected>White / Other</option>
                            <option value="black">African American</option>
                        </select>
                    </div>

                    {{-- Labs --}}
                    <div class="col-md-4">
                        <label class="form-label-custom">Total Cholesterol</label>
                        <div class="input-group">
                            <input type="number" id="ascvd-tc" class="form-control form-control-lg" value="200">
                            <span class="input-group-text bg-light fw-bold text-muted">mg/dL</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">HDL Cholesterol</label>
                        <div class="input-group">
                            <input type="number" id="ascvd-hdl" class="form-control form-control-lg" value="50">
                            <span class="input-group-text bg-light fw-bold text-muted">mg/dL</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Systolic BP</label>
                        <div class="input-group">
                            <input type="number" id="ascvd-sbp" class="form-control form-control-lg" value="120">
                            <span class="input-group-text bg-light fw-bold text-muted">mmHg</span>
                        </div>
                    </div>

                    {{-- History --}}
                    <div class="col-md-12">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="form-check form-switch p-3 border rounded-3 bg-light-subtle h-100">
                                    <input class="form-check-input ms-0 me-3" type="checkbox" id="ascvd-bp-meds">
                                    <label class="form-check-label fw-bold small text-uppercase" for="ascvd-bp-meds">BP Medication?</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch p-3 border rounded-3 bg-light-subtle h-100">
                                    <input class="form-check-input ms-0 me-3" type="checkbox" id="ascvd-diabetes">
                                    <label class="form-check-label fw-bold small text-uppercase" for="ascvd-diabetes">Diabetic?</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch p-3 border rounded-3 bg-light-subtle h-100">
                                    <input class="form-check-input ms-0 me-3" type="checkbox" id="ascvd-smoker">
                                    <label class="form-check-label fw-bold small text-uppercase" for="ascvd-smoker">Current Smoker?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="ascvd-output-card" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.04);">
            <div class="output-hero">
                <span class="output-hero-label">10-Year Heart Disease Risk</span>
                <div class="output-hero-value" id="out-ascvd-val" style="font-size:3.5rem">--</div>
                <span class="output-hero-unit">%</span>
            </div>

            <div class="position-relative mt-4 mb-1 px-4">
                <div class="progress rounded-pill" style="height:12px;background:#e2e8f0">
                    <div id="ascvd-bar" class="progress-bar rounded-pill" style="width:0%;background:#ef4444;transition:all .5s"></div>
                </div>
            </div>
            <div class="d-flex justify-content-between small text-muted px-4 mb-4"><span>Low (<5%)</span><span>Borderline</span><span>High (>20%)</span></div>

            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Risk Category</span>
                        <span class="stat-card-value text-danger" id="out-ascvd-cat">-</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Assessment</span>
                        <span class="stat-card-value" id="out-ascvd-assess">-</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border border-opacity-10 border-danger shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-stethoscope me-2 text-danger"></i>Clinical Interpretation</h6>
                <div id="ascvd-advice" class="small text-secondary"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="ascvd-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Risk Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const inputs = ['ascvd-age', 'ascvd-gender', 'ascvd-race', 'ascvd-tc', 'ascvd-hdl', 'ascvd-sbp', 'ascvd-bp-meds', 'ascvd-diabetes', 'ascvd-smoker'];

    function calculate(){
        const age = parseFloat($('ascvd-age').value);
        const gender = $('ascvd-gender').value;
        const race = $('ascvd-race').value;
        const tc = parseFloat($('ascvd-tc').value);
        const hdl = parseFloat($('ascvd-hdl').value);
        const sbp = parseFloat($('ascvd-sbp').value);
        const bpMed = $('ascvd-bp-meds').checked;
        const dia = $('ascvd-diabetes').checked;
        const smo = $('ascvd-smoker').checked;

        if (age < 40 || age > 79) {
            $('out-ascvd-val').textContent = "--";
            $('ascvd-advice').innerHTML = "ASCVD risk estimation is validated for ages 40-79.";
            return;
        }

        // Pooled Cohort Equation Coefficients (2013)
        const coeffs = {
            female_white: { lnAge:-29.799, lnAgeSq:4.884, lnTC:13.540, lnAgeTC:-3.114, lnHdl:-13.578, lnAgeHdl:3.012, lnSbpTr:2.019, lnAgeSbpTr:0, lnSbpUn:1.957, lnAgeSbpUn:0, smk:7.574, ageSmk:-1.665, dia:0.661, s0:0.9665, mn: -29.18 },
            female_black: { lnAge:17.114, lnAgeSq:0, lnTC:0.940, lnAgeTC:0, lnHdl:-18.920, lnAgeHdl:4.475, lnSbpTr:29.291, lnAgeSbpTr:-6.432, lnSbpUn:27.820, lnAgeSbpUn:-6.087, smk:0.691, ageSmk:0, dia:0.874, s0:0.9533, mn: 86.61 },
            male_white: { lnAge:12.344, lnAgeSq:0, lnTC:11.853, lnAgeTC:-2.664, lnHdl:-7.990, lnAgeHdl:1.769, lnSbpTr:1.797, lnAgeSbpTr:0, lnSbpUn:1.764, lnAgeSbpUn:0, smk:7.837, ageSmk:-1.795, dia:0.658, s0:0.9144, mn: 61.18 },
            male_black: { lnAge:2.469, lnAgeSq:0, lnTC:0.302, lnAgeTC:0, lnHdl:-0.307, lnAgeHdl:0, lnSbpTr:1.916, lnAgeSbpTr:0, lnSbpUn:1.809, lnAgeSbpUn:0, smk:0.549, ageSmk:0, dia:0.645, s0:0.8954, mn: 19.54 }
        };

        const c = coeffs[gender + "_" + race];
        const lnAge = Math.log(age);
        const lnTC = Math.log(tc);
        const lnHdl = Math.log(hdl);
        const lnSbp = Math.log(sbp);

        let sum = (c.lnAge * lnAge) + (c.lnAgeSq * Math.pow(lnAge, 2)) + (c.lnTC * lnTC) + (c.lnAgeTC * lnAge * lnTC) + (c.lnHdl * lnHdl) + (c.lnAgeHdl * lnAge * lnHdl);
        
        if (bpMed) {
            sum += (c.lnSbpTr * lnSbp) + (c.lnAgeSbpTr * lnAge * lnSbp);
        } else {
            sum += (c.lnSbpUn * lnSbp) + (c.lnAgeSbpUn * lnAge * lnSbp);
        }

        sum += (c.smk * (smo ? 1 : 0)) + (c.ageSmk * lnAge * (smo ? 1 : 0)) + (c.dia * (dia ? 1 : 0));

        const risk = 100 * (1 - Math.pow(c.s0, Math.exp(sum - c.mn)));
        const finalRisk = Math.min(100, Math.max(0, risk.toFixed(1)));

        $('out-ascvd-val').textContent = finalRisk;

        // UI Updates
        let cat = "", assess = "", color = "#10b981", advice = "";
        let pct = Math.min(100, (finalRisk / 30) * 100);

        if (finalRisk < 5) {
            cat = "Low Risk"; assess = "Healthy"; color = "#059669";
            advice = "Your 10-year risk of ASCVD is low. Maintain a heart-healthy diet and regular exercise.";
        } else if (finalRisk < 7.5) {
            cat = "Borderline"; assess = "Moderate"; color = "#d97706";
            advice = "Borderline risk. Discuss lifestyle modifications and potentially statin therapy with your physician.";
        } else if (finalRisk < 20) {
            cat = "Intermediate"; assess = "Warning"; color = "#ea580c";
            advice = "Intermediate risk. Standard practice recommends moderate-to-high intensity statins for this profile.";
        } else {
            cat = "High Risk"; assess = "Critical"; color = "#dc2626";
            advice = "High 10-year risk. Immediate cardiovascular risk reduction strategies are recommended by major guidelines.";
        }

        $('out-ascvd-cat').textContent = cat;
        $('out-ascvd-cat').style.color = color;
        $('out-ascvd-assess').textContent = assess;
        $('ascvd-bar').style.width = pct + "%";
        $('ascvd-bar').style.background = color;
        $('ascvd-advice').innerHTML = advice;
        $('ascvd-output-card').style.setProperty('--tool-color', color);
    }

    inputs.forEach(id => $(id).addEventListener('change', calculate));
    inputs.forEach(id => $(id).addEventListener('input', calculate));
    
    $('ascvd-copy').addEventListener('click', function(){
        const text=`ASCVD Risk Report\n10-Year Risk: ${$('out-ascvd-val').textContent}%\nCategory: ${$('out-ascvd-cat').textContent}\n— ToolsHub Health Analytics`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o, 2000)});
    });

    calculate();
});
</script>

<style>
.ascvd-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.ascvd-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.ascvd-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.ascvd-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.ascvd-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.ascvd-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>

