<div class="row g-4 cat-calc-rebuilt">
    {{-- Input Card --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Cat's Chronological Age (Years)</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="range" id="cat-age-slider" min="0" max="25" step="0.5" value="5" class="form-range flex-grow-1">
                            <input type="number" id="cat-age-input" min="0" max="25" step="0.1" value="5" class="form-control form-control-lg rounded-3 text-center font-monospace" style="width: 100px;">
                        </div>
                        <span class="text-muted small mt-1 d-block">Supports fractional ages (e.g. 1.5 years for 18 months)</span>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Feline Lifestyle & Environment</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn-toggle-custom active flex-grow-1" id="btn-lifestyle-indoor" data-value="indoor">
                                <i class="fas fa-home me-2"></i> Indoor
                            </button>
                            <button type="button" class="btn-toggle-custom flex-grow-1" id="btn-lifestyle-outdoor" data-value="outdoor">
                                <i class="fas fa-tree me-2"></i> Outdoor
                            </button>
                        </div>
                        <span class="text-muted small mt-1 d-block">Outdoor cats age faster due to increased environmental exposure.</span>
                    </div>
                </div>

                {{-- Presets Quick Action --}}
                <div class="mt-4 pt-3 border-top">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Feline Presets:</span>
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 cat-preset" data-age="0.5" data-lifestyle="indoor">🐱 Kitten (6 mo)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 cat-preset" data-age="1.5" data-lifestyle="indoor">🐈 Junior (18 mo)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 cat-preset" data-age="5" data-lifestyle="indoor">🏠 Prime Adult (Indoor)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 cat-preset" data-age="5" data-lifestyle="outdoor">🌲 Prime Adult (Outdoor)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 cat-preset" data-age="12" data-lifestyle="indoor">👵 Senior (12 yrs)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 cat-preset" data-age="18" data-lifestyle="indoor">🐾 Geriatric (18 yrs)</button>
                    </div>
                </div>

                <div class="mt-3 p-3 rounded-3 small text-secondary" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <i class="fas fa-circle-info me-1 text-primary"></i> <strong>Feline Aging Fact:</strong> Cats grow extremely fast in their first two years. A 1-year-old cat is roughly equivalent to a 15-year-old human, and a 2-year-old is equivalent to a 24-year-old human. After age 2, they stabilize and age 4–7 years per calendar year.
                </div>
            </div>
        </div>
    </div>

    {{-- Output Card --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="cat-output-card" style="--tool-hue: 240; --tool-color: #6366f1; --tool-bg: rgba(99, 102, 241, 0.04); transition: all 0.3s ease;">
            <div class="output-hero text-center py-2">
                <span class="output-hero-label">Feline Biological Equivalent</span>
                <div class="d-flex align-items-baseline justify-content-center gap-2">
                    <div class="output-hero-value" id="out-cat-human" style="font-size:4rem; font-weight:900; letter-spacing: -2px;">36</div>
                    <span class="fs-4 fw-bold text-muted">Human Years</span>
                </div>
                <div class="d-inline-block hero-status-pill mt-2" id="out-cat-stage">Adult</div>
            </div>

            {{-- Feline Lifespan Spectrum --}}
            <div class="mt-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="small text-muted fw-bold">Feline Lifespan Spectrum</span>
                    <span class="small fw-bold text-indigo" id="out-spectrum-text">Adult Stage</span>
                </div>
                <div class="position-relative">
                    <div class="progress rounded-pill" style="height: 12px; background: #e2e8f0;">
                        <div id="out-cat-bar" class="progress-bar rounded-pill" style="width: 25%; background: #6366f1; transition: all 0.5s ease;"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between small text-muted px-1 mt-1 tiny fw-bold uppercase">
                    <span>Kitten</span>
                    <span>Junior</span>
                    <span>Adult</span>
                    <span>Mature</span>
                    <span>Senior</span>
                    <span>Geriatric</span>
                </div>
            </div>

            {{-- Stat Cards --}}
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Chronological Age</span>
                        <span class="stat-card-value" id="out-cat-age">5 yrs</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Lifestyle</span>
                        <span class="stat-card-value text-capitalize" id="out-cat-lifestyle">Indoor</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Aging Rate</span>
                        <span class="stat-card-value" id="out-cat-rate">+4 yrs/yr</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Senior Threshold</span>
                        <span class="stat-card-value" id="out-cat-milestone">6 yrs left</span>
                    </div>
                </div>
            </div>

            {{-- Vet Insights Panel --}}
            <div class="mt-4 p-4 rounded-4" style="background: rgba(255, 255, 255, 0.8); border: 1px solid #e2e8f0;">
                <h5 class="fw-bold mb-3 d-flex align-items-center text-dark" style="font-size:1.05rem;">
                    <i class="fas fa-stethoscope text-primary me-2"></i> Veterinary Care Guidelines
                </h5>
                <p class="small text-secondary mb-3" id="out-cat-insights-desc">
                    Your cat is currently in their prime adult years. They are active, fully mature, and require basic health maintenance.
                </p>
                <div class="row g-3" id="out-cat-guidelines-list">
                    {{-- Guidelines populated dynamically --}}
                </div>
            </div>

            {{-- Report Copier (No Download Buttons) --}}
            <div class="mt-4 border-top pt-3 text-center">
                <button type="button" class="btn btn-dark btn-lg py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-cat-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i> Copy Biological Report
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('cat-age-slider');
    const input = document.getElementById('cat-age-input');
    const btnIndoor = document.getElementById('btn-lifestyle-indoor');
    const btnOutdoor = document.getElementById('btn-lifestyle-outdoor');

    let lifestyle = 'indoor';

    const lifeStages = [
        { name: 'Kitten', min: 0, max: 0.5, clr: '#3b82f6', bg: 'rgba(59, 130, 246, 0.05)', bar: 10, desc: 'Feline infancy. Kittens grow rapidly and require high-calorie kitten food, complete vaccinations, and lots of interactive play.' },
        { name: 'Junior', min: 0.5, max: 2, clr: '#10b981', bg: 'rgba(16, 185, 129, 0.05)', bar: 25, desc: 'Equivalent to a human teenager. Cats at this stage are exploring their boundaries. Keep playing and maintain a steady diet.' },
        { name: 'Adult', min: 2, max: 6, clr: '#6366f1', bg: 'rgba(99, 102, 241, 0.05)', bar: 45, desc: 'Your cat is in their peak health and physical prime. Focus on maintaining a healthy weight and mental stimulation.' },
        { name: 'Mature', min: 6, max: 10, clr: '#fbbf24', bg: 'rgba(251, 191, 36, 0.05)', bar: 65, desc: 'Equivalent to middle age. Your cat may begin slowing down slightly. Monitor their activity levels and adjust diet to avoid obesity.' },
        { name: 'Senior', min: 10, max: 14, clr: '#ea580c', bg: 'rgba(234, 88, 12, 0.05)', bar: 80, desc: 'Senior cat years. Subtle symptoms of joint stiffness or dental issues might appear. Set up twice-yearly veterinary wellness checkups.' },
        { name: 'Geriatric', min: 14, max: 99, clr: '#dc2626', bg: 'rgba(220, 38, 38, 0.05)', bar: 95, desc: 'Advanced age. Felines can live long, comfortable lives here with warm resting areas, easily accessible food/water, and direct joint care.' }
    ];

    function calculate() {
        const age = parseFloat(input.value) || 0;
        let humanAge = 0;

        // Veterinary formula logic
        if (age < 1) {
            humanAge = age * 15;
        } else if (age < 2) {
            humanAge = 15 + (age - 1) * 9;
        } else {
            const extraRate = lifestyle === 'indoor' ? 4 : 7;
            humanAge = 24 + (age - 2) * extraRate;
        }

        humanAge = Math.round(humanAge * 10) / 10;

        // Classify stage
        let stage = lifeStages[lifeStages.length - 1];
        for (let s of lifeStages) {
            if (age <= s.max) {
                stage = s;
                break;
            }
        }

        // Display results
        document.getElementById('out-cat-human').innerText = humanAge;
        
        const stagePill = document.getElementById('out-cat-stage');
        stagePill.innerText = stage.name;
        stagePill.style.background = stage.bg;
        stagePill.style.color = stage.clr;
        stagePill.style.border = `1.5px solid ${stage.clr}30`;

        document.getElementById('out-spectrum-text').innerText = stage.name + ' Stage';
        document.getElementById('out-spectrum-text').style.color = stage.clr;
        document.getElementById('out-cat-bar').style.width = stage.bar + '%';
        document.getElementById('out-cat-bar').style.background = stage.clr;

        document.getElementById('out-cat-age').innerText = age + ' yrs';
        document.getElementById('out-cat-lifestyle').innerText = lifestyle;
        document.getElementById('out-cat-rate').innerText = '+' + (lifestyle === 'indoor' ? 4 : 7) + ' yrs/yr';
        
        const seniorDiff = 10 - age;
        document.getElementById('out-cat-milestone').innerText = seniorDiff > 0 ? seniorDiff + ' yrs left' : 'Senior Age';

        document.getElementById('out-cat-insights-desc').innerText = stage.desc;

        // Custom recommendations lists based on stage & lifestyle
        let recs = [];
        if (stage.name === 'Kitten' || stage.name === 'Junior') {
            recs.push({ icon: 'fa-baby-carriage', title: 'Caloric Intake', desc: 'Provide growth-formulated food loaded with protein and fats.' });
            recs.push({ icon: 'fa-shield-virus', title: 'Immunization schedule', desc: 'Ensure all primary core vaccines (FVRCP) are completed.' });
        } else if (stage.name === 'Adult' || stage.name === 'Mature') {
            recs.push({ icon: 'fa-scale-balanced', title: 'Weight Management', desc: 'Indoor cats are highly susceptible to obesity. Measure exact food portions.' });
            recs.push({ icon: 'fa-dumbbell', title: 'Physical Activity', desc: 'Encourage laser or toy play sessions at least twice daily.' });
        } else {
            recs.push({ icon: 'fa-bed', title: 'Joint Support', desc: 'Provide orthopaedic beds and ramps if jumping onto higher spaces becomes difficult.' });
            recs.push({ icon: 'fa-droplet', title: 'Hydration Monitoring', desc: 'Senior cats suffer from kidney disease. Keep multiple water sources or fountains.' });
        }

        if (lifestyle === 'outdoor') {
            recs.push({ icon: 'fa-bug', title: 'Parasite Defense', desc: 'Crucial monthly flea, tick, and heartworm preventative treatment.' });
        } else {
            recs.push({ icon: 'fa-feather', title: 'Environmental Enrichment', desc: 'Provide scratching posts and window perches to keep indoor minds active.' });
        }

        const guidelinesContainer = document.getElementById('out-cat-guidelines-list');
        guidelinesContainer.innerHTML = recs.map(r => `
            <div class="col-md-6">
                <div class="d-flex align-items-start gap-3 p-3 rounded-3" style="background:#f8fafc; border:1px solid #f1f5f9;">
                    <div class="fs-4 text-primary" style="opacity: 0.85;"><i class="fas ${r.icon}"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1 small text-dark">${r.title}</h6>
                        <p class="mb-0 text-muted small" style="line-height:1.3;">${r.desc}</p>
                    </div>
                </div>
            </div>
        `).join('');

        // Apply theme color
        document.getElementById('cat-output-card').style.setProperty('--tool-color', stage.clr);
        document.getElementById('cat-output-card').style.setProperty('--tool-bg', stage.bg);
    }

    // Wiring listeners
    slider.addEventListener('input', function() {
        input.value = this.value;
        calculate();
    });

    input.addEventListener('input', function() {
        let val = parseFloat(this.value) || 0;
        val = Math.max(0, Math.min(25, val));
        slider.value = val;
        calculate();
    });

    btnIndoor.addEventListener('click', function() {
        btnOutdoor.classList.remove('active');
        this.classList.add('active');
        lifestyle = 'indoor';
        calculate();
    });

    btnOutdoor.addEventListener('click', function() {
        btnIndoor.classList.remove('active');
        this.classList.add('active');
        lifestyle = 'outdoor';
        calculate();
    });

    // Presets
    document.querySelectorAll('.cat-preset').forEach(btn => {
        btn.addEventListener('click', function() {
            const age = this.dataset.age;
            const lStyle = this.dataset.lifestyle;

            input.value = age;
            slider.value = age;
            lifestyle = lStyle;

            if (lStyle === 'indoor') {
                btnOutdoor.classList.remove('active');
                btnIndoor.classList.add('active');
            } else {
                btnIndoor.classList.remove('active');
                btnOutdoor.classList.add('active');
            }

            calculate();
        });
    });

    // Clipboard Copy
    document.getElementById('btn-cat-copy').addEventListener('click', function() {
        const age = input.value;
        const hAge = document.getElementById('out-cat-human').innerText;
        const stage = document.getElementById('out-cat-stage').innerText;
        
        const text = `Feline Biological Age Report\n━━━━━━━━━━━━━━━━━━━━━━\nChronological Age: ${age} years\nLifestyle: ${lifestyle.charAt(0).toUpperCase() + lifestyle.slice(1)}\nHuman Equivalent: ${hAge} years\nLife Stage: ${stage}\n━━━━━━━━━━━━━━━━━━━━━━\nCare insights calculated instantly via ToolsHub Pets`;
        
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
.cat-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 1.75rem; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.02); }
.cat-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; }
.cat-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.cat-calc-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; }
.cat-calc-rebuilt .tool-icon-circle { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.cat-calc-rebuilt .form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; display: block; }

.cat-calc-rebuilt .btn-toggle-custom { background: #f8fafc; border: 1.5px solid #e2e8f0; padding: 0.75rem 1rem; border-radius: 12px; font-weight: 700; cursor: pointer; transition: all 0.2s ease; color: #64748b; }
.cat-calc-rebuilt .btn-toggle-custom.active { background: #1e293b; color: white; border-color: #1e293b; }

.cat-calc-rebuilt .output-card-themed { background: #ffffff; border-radius: 24px; padding: 2rem; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 10px 30px rgba(0,0,0,0.03); margin-top: 1.5rem; }
.cat-calc-rebuilt .hero-status-pill { display: inline-block; padding: 0.4rem 1.25rem; border-radius: 100px; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; }

.cat-calc-rebuilt .stat-card { background: #f8fafc; padding: 1rem; border-radius: 14px; border: 1px solid rgba(0, 0, 0, 0.01); text-align: center; }
.cat-calc-rebuilt .stat-card-label { display: block; font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.25rem; }
.cat-calc-rebuilt .stat-card-value { font-size: 1.05rem; font-weight: 800; color: #1e293b; }

.cat-calc-rebuilt .tiny { font-size: 0.68rem; }
.cat-calc-rebuilt .uppercase { text-transform: uppercase; }
</style>
