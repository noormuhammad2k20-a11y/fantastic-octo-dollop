<div class="row g-4 dog-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label-custom">Dog's Chronological Age (Years)</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="range" id="dog-age-slider" min="0" max="20" step="0.5" value="4" class="form-range flex-grow-1">
                            <input type="number" id="dog-age-input" min="0" max="20" step="0.1" value="4" class="form-control form-control-lg rounded-3 text-center font-monospace" style="width: 100px;">
                        </div>
                        <span class="text-muted small mt-1 d-block">Supports fractional ages (e.g. 2.5 years for 30 months)</span>
                    </div>
                    
                    <div class="col-md-7">
                        <label class="form-label-custom">Dog Weight Class (Adult Size)</label>
                        <div class="row g-2" id="dog-size-selector">
                            <div class="col-6 col-sm-3">
                                <div class="size-card-custom active" data-size="small" data-rate="4">
                                    <div class="size-dot" style="background:#10b981;"></div>
                                    <span class="d-block fw-bold small">Small</span>
                                    <span class="text-muted tiny">Under 20 lbs</span>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="size-card-custom" data-size="medium" data-rate="5">
                                    <div class="size-dot" style="background:#6366f1;"></div>
                                    <span class="d-block fw-bold small">Medium</span>
                                    <span class="text-muted tiny">21 - 50 lbs</span>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="size-card-custom" data-size="large" data-rate="6">
                                    <div class="size-dot" style="background:#f59e0b;"></div>
                                    <span class="d-block fw-bold small">Large</span>
                                    <span class="text-muted tiny">51 - 90 lbs</span>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="size-card-custom" data-size="giant" data-rate="7">
                                    <div class="size-dot" style="background:#ef4444;"></div>
                                    <span class="d-block fw-bold small">Giant</span>
                                    <span class="text-muted tiny">Over 90 lbs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 pt-3 border-top">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Canine Presets:</span>
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 dog-preset" data-age="0.5" data-size="medium">🐶 Puppy (6 mo)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 dog-preset" data-age="2" data-size="small">🐕 Small Breed Adult (2 yrs)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 dog-preset" data-age="4" data-size="medium">🦴 Medium Adult (4 yrs)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 dog-preset" data-age="6" data-size="large">🏆 Large Adult (6 yrs)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 dog-preset" data-age="8" data-size="giant">🦁 Giant Senior (8 yrs)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 dog-preset" data-age="13" data-size="small">👵 Small Senior (13 yrs)</button>
                    </div>
                </div>

                <div class="mt-3 p-3 rounded-3 small text-secondary" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <i class="fas fa-circle-info me-1 text-warning"></i> <strong>Canine Aging Science:</strong> Different breeds age at wildly different rates. Giant breeds mature slower initially but age rapidly after age 2, while smaller breeds remain youthful much longer.
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="dog-output-card" style="--tool-hue: 24; --tool-color: #d97706; --tool-bg: rgba(217, 119, 6, 0.04); transition: all 0.3s ease;">
            <div class="output-hero text-center py-2">
                <span class="output-hero-label">Canine Biological Equivalent</span>
                <div class="d-flex align-items-baseline justify-content-center gap-2">
                    <div class="output-hero-value" id="out-dog-human" style="font-size:4rem; font-weight:900; letter-spacing: -2px;">32</div>
                    <span class="fs-4 fw-bold text-muted">Human Years</span>
                </div>
                <div class="d-inline-block hero-status-pill mt-2" id="out-dog-stage">Adult</div>
            </div>

            
            <div class="mt-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="small text-muted fw-bold">Canine Lifespan Spectrum</span>
                    <span class="small fw-bold text-warning" id="out-dog-spectrum-text">Adult Stage</span>
                </div>
                <div class="position-relative">
                    <div class="progress rounded-pill" style="height: 12px; background: #e2e8f0;">
                        <div id="out-dog-bar" class="progress-bar rounded-pill" style="width: 30%; background: #d97706; transition: all 0.5s ease;"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between small text-muted px-1 mt-1 tiny fw-bold uppercase">
                    <span>Puppy</span>
                    <span>Junior</span>
                    <span>Adult</span>
                    <span>Mature</span>
                    <span>Senior</span>
                    <span>Geriatric</span>
                </div>
            </div>

            
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Chronological Age</span>
                        <span class="stat-card-value" id="out-dog-age">4.0 yrs</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Size Class</span>
                        <span class="stat-card-value text-capitalize" id="out-dog-size">Small</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Annual Aging Rate</span>
                        <span class="stat-card-value" id="out-dog-rate">+4 yrs/yr</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Senior Threshold</span>
                        <span class="stat-card-value" id="out-dog-milestone">7 yrs left</span>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 p-4 rounded-4" style="background: rgba(255, 255, 255, 0.8); border: 1px solid #e2e8f0;">
                <h5 class="fw-bold mb-3 d-flex align-items-center text-dark" style="font-size:1.05rem;">
                    <i class="fas fa-stethoscope text-primary me-2"></i> Size-Specific Veterinary Guidelines
                </h5>
                <p class="small text-secondary mb-3" id="out-dog-insights-desc">
                    Your dog is in their peak health years. They are active, fully mature, and require general health monitoring.
                </p>
                <div class="row g-3" id="out-dog-guidelines-list">
                    
                </div>
            </div>

            
            <div class="mt-4 border-top pt-3 text-center">
                <button type="button" class="btn btn-dark btn-lg py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-dog-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i> Copy Biological Report
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('dog-age-slider');
    const input = document.getElementById('dog-age-input');
    const sizeCards = document.querySelectorAll('.size-card-custom');

    let size = 'small';
    let annualRate = 4;

    // Standard clinical thresholds (Seniors vary based on size class)
    const lifeStages = [
        { name: 'Puppy', min: 0, max: 0.75, clr: '#3b82f6', bg: 'rgba(59, 130, 246, 0.05)', bar: 10, desc: 'Canine babyhood. High energy, rapid physical growth, and high vaccination/training priorities.' },
        { name: 'Junior', min: 0.75, max: 2, clr: '#10b981', bg: 'rgba(16, 185, 129, 0.05)', bar: 25, desc: 'Equivalent to a human teenager. Rapidly reaching full structural growth. Maintain strict behavior training.' },
        { name: 'Adult', min: 2, max: 6, clr: '#6366f1', bg: 'rgba(99, 102, 241, 0.05)', bar: 45, desc: 'Your canine is in their physical peak. Standard diet, high activity, and basic wellness checkups are standard.' }
    ];

    function calculate() {
        const age = parseFloat(input.value) || 0;
        let humanAge = 0;

        // Size-specific calculations:
        // Year 1 = 15 human years.
        // Year 2 = +9 human years (Total 24).
        // Year 3+ = +4 (Small), +5 (Medium), +6 (Large), +7 (Giant) per year.
        if (age < 1) {
            humanAge = age * 15;
        } else if (age < 2) {
            humanAge = 15 + (age - 1) * 9;
        } else {
            humanAge = 24 + (age - 2) * annualRate;
        }

        humanAge = Math.round(humanAge * 10) / 10;

        // Determine size-based senior limits
        let seniorAge = 11; // Small
        if (size === 'medium') seniorAge = 9;
        else if (size === 'large') seniorAge = 8;
        else if (size === 'giant') seniorAge = 6;

        let geriatricAge = seniorAge + 3;

        // Classify stage
        let stageName = 'Adult';
        let stageColor = '#6366f1';
        let stageBg = 'rgba(99, 102, 241, 0.05)';
        let stageBar = 45;
        let stageDesc = 'Your canine is in their physical peak. Standard diet, high activity, and basic wellness checkups are recommended.';

        if (age < 0.75) {
            stageName = 'Puppy';
            stageColor = '#3b82f6';
            stageBg = 'rgba(59, 130, 246, 0.05)';
            stageBar = 12;
            stageDesc = 'Canine babyhood. Extremely rapid physical growth. High nutritional energy and core vaccine/booster priorities.';
        } else if (age < 2) {
            stageName = 'Junior';
            stageColor = '#10b981';
            stageBg = 'rgba(16, 185, 129, 0.05)';
            stageBar = 28;
            stageDesc = 'Teenage equivalence. Developing permanent behavior traits. Focus on healthy muscle building and consistent training.';
        } else if (age >= geriatricAge) {
            stageName = 'Geriatric';
            stageColor = '#dc2626';
            stageBg = 'rgba(220, 38, 38, 0.05)';
            stageBar = 95;
            stageDesc = 'Advanced age. Joint comfort, kidney care, easy food access, and specialized senior diets are vital here.';
        } else if (age >= seniorAge) {
            stageName = 'Senior';
            stageColor = '#ea580c';
            stageBg = 'rgba(234, 88, 12, 0.05)';
            stageBar = 80;
            stageDesc = 'Senior canine years. High vulnerability to arthritis, cardiovascular shifts, and vision loss. Wellness testing twice yearly.';
        } else if (age >= (seniorAge - 3)) {
            stageName = 'Mature';
            stageColor = '#f59e0b';
            stageBg = 'rgba(245, 158, 11, 0.05)';
            stageBar = 65;
            stageDesc = 'Middle age equivalence. Dog is active but might play for shorter intervals. Balance caloric intake to prevent obesity.';
        }

        // Display results
        document.getElementById('out-dog-human').innerText = humanAge;
        
        const stagePill = document.getElementById('out-dog-stage');
        stagePill.innerText = stageName;
        stagePill.style.background = stageBg;
        stagePill.style.color = stageColor;
        stagePill.style.border = `1.5px solid ${stageColor}30`;

        document.getElementById('out-dog-spectrum-text').innerText = stageName + ' Stage';
        document.getElementById('out-dog-spectrum-text').style.color = stageColor;
        document.getElementById('out-dog-bar').style.width = stageBar + '%';
        document.getElementById('out-dog-bar').style.background = stageColor;

        document.getElementById('out-dog-age').innerText = age + ' yrs';
        document.getElementById('out-dog-size').innerText = size;
        document.getElementById('out-dog-rate').innerText = '+' + annualRate + ' yrs/yr';
        
        const seniorDiff = seniorAge - age;
        document.getElementById('out-dog-milestone').innerText = seniorDiff > 0 ? Math.round(seniorDiff * 10)/10 + ' yrs left' : 'Senior Age';

        document.getElementById('out-dog-insights-desc').innerText = stageDesc;

        // Custom clinical recommendations based on size & stage
        let recs = [];
        if (stageName === 'Puppy' || stageName === 'Junior') {
            recs.push({ icon: 'fa-baby-carriage', title: 'Growth Balance', desc: 'Feed a calcium-controlled diet, specifically essential for giant breed skeleton development.' });
            recs.push({ icon: 'fa-graduation-cap', title: 'Behavior Foundation', desc: 'Establish clear boundaries and complete social immunization by week 16.' });
        } else if (stageName === 'Adult' || stageName === 'Mature') {
            recs.push({ icon: 'fa-dumbbell', title: 'Cardio Fitness', desc: 'Large/Giant breeds need active heart support; Small breeds benefit from quick agility.' });
            recs.push({ icon: 'fa-tooth', title: 'Dental Hygiene', desc: 'Small breeds have cramped dental arches; schedule brushings twice weekly.' });
        } else {
            recs.push({ icon: 'fa-capsules', title: 'Joint Lubrication', desc: 'Initiate daily glucosamine and chondroitin intake immediately.' });
            recs.push({ icon: 'fa-stethoscope', title: 'Senior Lab Tests', desc: 'Twice-yearly blood screening (CBC and kidney metrics) is recommended.' });
        }

        if (size === 'giant' || size === 'large') {
            recs.push({ icon: 'fa-shield-heart', title: 'Bloat Prevention (GDV)', desc: 'Use slow-feed bowls. Prevent heavy exercise within 60 minutes after big meals.' });
        } else {
            recs.push({ icon: 'fa-person-falling-burst', title: 'Patellar Support', desc: 'Small breeds easily suffer luxating patellas. Stop them from high furniture jumps.' });
        }

        const guidelinesContainer = document.getElementById('out-dog-guidelines-list');
        guidelinesContainer.innerHTML = recs.map(r => `
            <div class="col-md-6">
                <div class="d-flex align-items-start gap-3 p-3 rounded-3" style="background:#f8fafc; border:1px solid #f1f5f9;">
                    <div class="fs-4 text-warning" style="opacity: 0.85; color: ${stageColor} !important;"><i class="fas ${r.icon}"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1 small text-dark">${r.title}</h6>
                        <p class="mb-0 text-muted small" style="line-height:1.3;">${r.desc}</p>
                    </div>
                </div>
            </div>
        `).join('');

        // Apply theme color
        document.getElementById('dog-output-card').style.setProperty('--tool-color', stageColor);
        document.getElementById('dog-output-card').style.setProperty('--tool-bg', stageBg);
    }

    // Wiring listeners
    slider.addEventListener('input', function() {
        input.value = this.value;
        calculate();
    });

    input.addEventListener('input', function() {
        let val = parseFloat(this.value) || 0;
        val = Math.max(0, Math.min(20, val));
        slider.value = val;
        calculate();
    });

    // Size Selection
    sizeCards.forEach(card => {
        card.addEventListener('click', function() {
            sizeCards.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            size = this.dataset.size;
            annualRate = parseInt(this.dataset.rate);
            calculate();
        });
    });

    // Presets
    document.querySelectorAll('.dog-preset').forEach(btn => {
        btn.addEventListener('click', function() {
            const age = this.dataset.age;
            const pSize = this.dataset.size;

            input.value = age;
            slider.value = age;
            size = pSize;

            sizeCards.forEach(c => {
                if (c.dataset.size === pSize) {
                    c.classList.add('active');
                    annualRate = parseInt(c.dataset.rate);
                } else {
                    c.classList.remove('active');
                }
            });

            calculate();
        });
    });

    // Clipboard Copy
    document.getElementById('btn-dog-copy').addEventListener('click', function() {
        const age = input.value;
        const hAge = document.getElementById('out-dog-human').innerText;
        const stage = document.getElementById('out-dog-stage').innerText;
        
        const text = `Canine Biological Age Report\n━━━━━━━━━━━━━━━━━━━━━━\nChronological Age: ${age} years\nSize Class: ${size.charAt(0).toUpperCase() + size.slice(1)} Breed\nHuman Equivalent: ${hAge} years\nLife Stage: ${stage}\n━━━━━━━━━━━━━━━━━━━━━━\nCare insights calculated instantly via ToolsHub Pets`;
        
        navigator.clipboard.writeText(text).then(() => {
            const orig = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check-double me-2"></i> Report Copied!';
            setTimeout(() => this.innerHTML = orig, 2000);
        });
    });

    calculate();
});
</script>

<style>
.dog-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 1.75rem; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.02); }
.dog-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; }
.dog-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.dog-calc-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; }
.dog-calc-rebuilt .tool-icon-circle { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.dog-calc-rebuilt .form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; display: block; }

.dog-calc-rebuilt .size-card-custom { background: #f8fafc; border: 1.5px solid #e2e8f0; padding: 0.75rem 0.5rem; border-radius: 12px; cursor: pointer; transition: all 0.2s ease; text-align: center; position: relative; }
.dog-calc-rebuilt .size-card-custom:hover { border-color: #cbd5e1; background: #f1f5f9; }
.dog-calc-rebuilt .size-card-custom.active { background: #fff; border-color: #1e293b; box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
.dog-calc-rebuilt .size-card-custom.active .fw-bold { color: #1e293b; }
.dog-calc-rebuilt .size-dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; margin-bottom: 0.25rem; }
.dog-calc-rebuilt .tiny { font-size: 0.65rem; display: block; margin-top: 0.15rem; }

.dog-calc-rebuilt .output-card-themed { background: #ffffff; border-radius: 24px; padding: 2rem; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 10px 30px rgba(0,0,0,0.03); margin-top: 1.5rem; }
.dog-calc-rebuilt .hero-status-pill { display: inline-block; padding: 0.4rem 1.25rem; border-radius: 100px; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; }

.dog-calc-rebuilt .stat-card { background: #f8fafc; padding: 1rem; border-radius: 14px; border: 1px solid rgba(0, 0, 0, 0.01); text-align: center; }
.dog-calc-rebuilt .stat-card-label { display: block; font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.25rem; }
.dog-calc-rebuilt .stat-card-value { font-size: 1.05rem; font-weight: 800; color: #1e293b; }

.dog-calc-rebuilt .tiny { font-size: 0.68rem; }
.dog-calc-rebuilt .uppercase { text-transform: uppercase; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\dog-years-to-human-years-calculator.blade.php ENDPATH**/ ?>