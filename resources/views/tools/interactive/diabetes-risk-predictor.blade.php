<div class="row g-4 diab-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Row 1: Age & Gender --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Current Age Bracket</label>
                        <select id="diab-age" class="form-select form-select-lg rounded-3">
                            <option value="0">Under 40 years</option>
                            <option value="1">40 - 49 years</option>
                            <option value="2">50 - 59 years</option>
                            <option value="3" selected>60 years or older</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Biological Gender</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-danger flex-grow-1 py-2 fw-bold rounded-3 gender-btn" data-gender="1">
                                <i class="fas fa-mars me-2"></i>Male (+1)
                            </button>
                            <button type="button" class="btn btn-outline-danger active flex-grow-1 py-2 fw-bold rounded-3 gender-btn" data-gender="0">
                                <i class="fas fa-venus me-2"></i>Female
                            </button>
                        </div>
                    </div>

                    {{-- Row 2: BMI & Blood Pressure --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Body Mass Index (BMI) Category</label>
                        <select id="diab-bmi" class="form-select form-select-lg rounded-3">
                            <option value="0">Healthy Weight (Below 25)</option>
                            <option value="1">Overweight (25 - 29.9)</option>
                            <option value="2" selected>Obese (30 - 39.9)</option>
                            <option value="3">Morbidly Obese (40+)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">High Blood Pressure History</label>
                        <div class="form-check form-switch card p-3 flex-grow-1 border-2">
                            <input class="form-check-input ms-0 me-2" type="checkbox" id="diab-bp">
                            <label class="form-check-label fw-bold" for="diab-bp">Diagnosed / Medication (+1)</label>
                        </div>
                    </div>

                    {{-- Row 3: Family & Activity --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Family History (Parents/Siblings)</label>
                        <div class="form-check form-switch card p-3 flex-grow-1 border-2">
                            <input class="form-check-input ms-0 me-2" type="checkbox" id="diab-family">
                            <label class="form-check-label fw-bold" for="diab-family">History of Diabetes (+1)</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Sedentary Lifestyle</label>
                        <div class="form-check form-switch card p-3 flex-grow-1 border-2">
                            <input class="form-check-input ms-0 me-2" type="checkbox" id="diab-active">
                            <label class="form-check-label fw-bold" for="diab-active">Physically Inactive (+1)</label>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Risk Profiles:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 diab-quick" data-a="0" data-g="0" data-f="0" data-b="0" data-ac="0" data-bm="0">🥗 Healthy Lifestyle</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 diab-quick" data-a="2" data-g="1" data-f="1" data-b="1" data-ac="1" data-bm="2">⚠️ At-Risk Profile</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="diab-theme" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.06);">
            <div class="output-hero">
                <span class="output-hero-label">CUMULATIVE RISK SCORE</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-score">--</span>
                    <span class="output-hero-unit">/ 10</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;">Determining Risk...</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#ef4444; background: #fff;">
                        <span class="stat-card-label">PROBABILITY TIER</span>
                        <span class="stat-card-value" id="out-tier">Medium</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#1e293b; background: #fff;">
                        <span class="stat-card-label">CLINICAL ACTION</span>
                        <span class="stat-card-value" id="out-action" style="font-size: 1.2rem;">Monitoring</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#3b82f6; background: #fff;">
                        <span class="stat-card-label">NEXT STEP</span>
                        <span class="stat-card-value" style="font-size: 1.1rem; color:#3b82f6">Lab Consult</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-clipboard-check text-danger me-2"></i>Medical Guidance & Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="diab-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Risk Assessment
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="diab-reset" style="min-width: 280px; max-width: 100%;">Reset Assessment</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="diab-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Summary
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const ageE = $('diab-age'), bmiE = $('diab-bmi'),
          bpE = $('diab-bp'), famE = $('diab-family'), activeE = $('diab-active');
    
    let currentGender = '0'; // Female default

    function calculate(){
        let score = parseInt(ageE.value) + parseInt(currentGender) + parseInt(bmiE.value);
        if(bpE.checked) score += 1;
        if(famE.checked) score += 1;
        if(activeE.checked) score += 1;

        $('out-score').textContent = score;

        let status = '', tier = '', action = '', hue = 0, color = '#ef4444';
        
        if(score <= 3) {
            status = 'Low Risk'; tier = 'Low (1%)'; action = 'Prevention'; hue = 140; color = '#10b981';
        } else if(score === 4) {
            status = 'Moderate Risk'; tier = 'Moderate (5%)'; action = 'Screening'; hue = 45; color = '#f59e0b';
        } else {
            status = 'High Clinical Risk'; tier = 'High (10%+)'; action = 'Consult MD'; hue = 0; color = '#ef4444';
        }

        const outStatus = $('out-status');
        outStatus.textContent = status;
        outStatus.style.color = color;
        $('out-tier').textContent = tier;
        $('out-tier').style.color = color;
        $('out-action').textContent = action;
        
        const theme = $('diab-theme');
        theme.style.setProperty('--tool-hue', hue);
        theme.style.setProperty('--tool-color', color);
        theme.style.setProperty('--tool-bg', `hsla(${hue}, 100%, 50%, 0.05)`);

        // Insights
        const ins = [];
        if(score >= 5) {
            ins.push('<strong>Urgent:</strong> Your score suggests a high probability of pre-diabetes or undiagnosed Type 2 Diabetes.');
            ins.push('Schedule a Fasting Plasma Glucose (FPG) or Glycated Hemoglobin (A1C) test with your doctor.');
        } else if (score === 4) {
             ins.push('You are in the transition zone. Small lifestyle changes now can significantly delay or prevent onset.');
        } else {
            ins.push('Maintain your healthy baseline. Regular physical activity reduces metabolic risk by up to 50%.');
        }
        
        if(parseInt(bmiE.value) >= 2) {
            ins.push('Weight management is the most effective way to lower metabolic resistance.');
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-danger me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [ageE, bmiE, bpE, famE, activeE].forEach(el => el.addEventListener('change', calculate));

    document.querySelectorAll('.gender-btn').forEach(btn => {
        btn.addEventListener('click', ()=>{
            currentGender = btn.dataset.gender;
            document.querySelectorAll('.gender-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            calculate();
        });
    });

    document.querySelectorAll('.diab-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            ageE.value = btn.dataset.a;
            currentGender = btn.dataset.g;
            famE.checked = btn.dataset.f === '1';
            bpE.checked = btn.dataset.b === '1';
            activeE.checked = btn.dataset.ac === '1';
            bmiE.value = btn.dataset.bm;
            
            document.querySelectorAll('.gender-btn').forEach(b => {
                b.classList.toggle('active', b.dataset.gender === currentGender);
            });
            calculate();
        });
    });

    $('diab-reset').addEventListener('click', ()=>{
        ageE.value = 0; famE.checked = false; bpE.checked = false; activeE.checked = false; bmiE.value = 0;
        calculate();
    });

    $('diab-copy-btn').addEventListener('click', function(){
        const text = `Diabetes Risk Assessment Summary\nScore: ${$('out-score').textContent}/10\nStatus: ${$('out-status').textContent}\nTier: ${$('out-tier').textContent}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Summary Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.diab-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(239,68,68,.05)}
.diab-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.diab-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.diab-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.diab-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.diab-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.diab-rebuilt .btn-outline-danger{border-color:#ef4444; color:#ef4444; border-width:2.5px}
.diab-rebuilt .btn-outline-danger.active{background-color:#ef4444; border-color:#ef4444; color:#fff}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:1.8rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .diab-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
