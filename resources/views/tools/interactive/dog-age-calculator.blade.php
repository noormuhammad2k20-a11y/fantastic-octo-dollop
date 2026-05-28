<div class="row g-4 dog-age-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Row 1: Age --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Dog's Age</label>
                        <div class="input-group">
                            <input type="number" id="dog-years" class="form-control form-control-lg rounded-start-3" value="3" min="0" max="25" placeholder="Years">
                            <span class="input-group-text bg-light border-start-0 border-end-0 text-muted">Yrs</span>
                            <input type="number" id="dog-months" class="form-control form-control-lg border-start-0" value="0" min="0" max="11" placeholder="Mo">
                            <span class="input-group-text bg-light rounded-end-3 text-muted">Mos</span>
                        </div>
                    </div>
                    
                    {{-- Row 2: Weight Size --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Breed Size Profile</label>
                        <select id="dog-size" class="form-select form-select-lg rounded-3">
                            <option value="small">Small (20 lbs or less)</option>
                            <option value="medium" selected>Medium (21-50 lbs)</option>
                            <option value="large">Large (51-100 lbs)</option>
                            <option value="giant">Giant (Over 100 lbs)</option>
                        </select>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 dog-quick" data-y="0" data-m="6" data-s="small">🐶 Puppy (6mo Small)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 dog-quick" data-y="5" data-m="0" data-s="medium">🐕 Adult (5yr Mid)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 dog-quick" data-y="10" data-m="0" data-s="large">🦴 Senior (10yr Large)</button>
                    <button type="button" class="btn btn-sm btn-outline-primary ms-auto rounded-pill px-3 fw-bold" id="dog-calc-btn" style="min-width: 280px; max-width: 100%;">Calculate Age</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:35;--tool-color:#f59e0b;--tool-bg:rgba(245,158,11,.04);">
            <div class="output-hero">
                <span class="output-hero-label">HUMAN EQUIVALENT AGE</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-human-age">29</span>
                    <span class="output-hero-unit">Years Old</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-life-stage">Life Stage: Adult</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <div class="stat-card" style="border-color:#10b981; background: rgba(16,185,129,.02);">
                        <span class="stat-card-label">BIOLOGICAL MILESTONE</span>
                        <span class="stat-card-value text-success" id="out-milestone" style="font-size:1.3rem;">Peak Adulthood</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card" style="border-color:#3b82f6; background: rgba(59,130,246,.02);">
                        <span class="stat-card-label">AGING RATE</span>
                        <span class="stat-card-value text-primary" id="out-aging-rate" style="font-size:1.3rem;">Medium</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-clipboard-list text-primary me-2"></i>Veterinary Health Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="dog-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Result
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="dog-reset" style="min-width: 280px; max-width: 100%;">Reset Fields</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="dog-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Analysis
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const yearsE = $('dog-years'), monthsE = $('dog-months'), sizeE = $('dog-size');
    
    function calculate(){
        let y = parseInt(yearsE.value) || 0;
        let m = parseInt(monthsE.value) || 0;
        const size = sizeE.value;
        
        let totalYears = y + (m / 12);
        if(totalYears <= 0) return;
        
        let humanAge = 0;

        // Modern AVMA-style calculation model
        if(totalYears <= 1) {
            humanAge = totalYears * 15; // 1 yr = 15
        } else if (totalYears <= 2) {
            humanAge = 15 + ((totalYears - 1) * 9); // 2 yr = 24
        } else {
            let base = 24;
            let yearsPastTwo = totalYears - 2;
            let multiplier = 4;
            
            switch(size) {
                case 'small': multiplier = 4; break;
                case 'medium': multiplier = 5; break;
                case 'large': multiplier = 6; break; // Approximated
                case 'giant': multiplier = 7; break;
            }
            humanAge = base + (yearsPastTwo * multiplier);
        }

        humanAge = Math.round(humanAge * 10) / 10;
        
        // Output Update
        $('out-human-age').textContent = Math.floor(humanAge);
        
        // Life Stage
        let stage = 'Puppy';
        if (totalYears >= 1 && totalYears < 6) stage = 'Adult';
        if (totalYears >= 6 && totalYears < 10) stage = 'Senior';
        if (totalYears >= 10) stage = 'Geriatric';
        $('out-life-stage').textContent = `Life Stage: ${stage}`;

        // Biological Milestone
        let milestone = 'Early Development';
        if(stage === 'Adult') milestone = 'Peak Vitality';
        if(stage === 'Senior') milestone = 'Aging Process Active';
        if(stage === 'Geriatric') milestone = 'Advanced Aging';
        $('out-milestone').textContent = milestone;

        // Aging Rate
        $('out-aging-rate').textContent = (size === 'giant' ? 'Accelerated' : (size === 'large' ? 'Fast' : (size === 'medium' ? 'Standard' : 'Slow')));

        // Insights
        const ins = [];
        if (stage === 'Puppy') {
            ins.push('Focus on vaccination schedules and proper socialization strategies.');
            ins.push('High-calorie nutritional support is required for optimal growth.');
        } else if (stage === 'Adult') {
            ins.push('Maintain annual veterinary check-ups to establish health baselines.');
            ins.push('Ensure regular physical activity and monitor weight markers.');
        } else if (stage === 'Senior' || stage === 'Geriatric') {
            ins.push('Schedule bi-annual vet exams emphasizing metabolic and joint health.');
            ins.push('Consider transitioning to a senior diet rich in Omega-3/Joint supplements.');
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-primary me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [yearsE, monthsE, sizeE].forEach(el => el.addEventListener('input', calculate));
    $('dog-calc-btn').addEventListener('click', calculate);

    document.querySelectorAll('.dog-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            yearsE.value = btn.dataset.y;
            monthsE.value = btn.dataset.m;
            sizeE.value = btn.dataset.s;
            calculate();
        });
    });

    $('dog-reset').addEventListener('click', ()=>{
        yearsE.value = 3;
        monthsE.value = 0;
        sizeE.value = 'medium';
        calculate();
    });

    $('dog-copy-btn').addEventListener('click', function(){
        const text = `Dog to Human Age Conversion\nDog Age: ${yearsE.value} Yr ${monthsE.value} Mo\nHuman Equivalent: ${$('out-human-age').textContent} Years Old\nLife Stage: ${$('out-life-stage').textContent.replace('Life Stage: ', '')}\nGenerated via ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Result Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.dog-age-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(245,158,11,.05)}
.dog-age-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.dog-age-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.dog-age-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.dog-age-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.dog-age-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:1.8rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .dog-age-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
