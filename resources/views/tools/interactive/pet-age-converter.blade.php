<div class="row g-4 pet-age-rebuilt">
    {{-- Input Card --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Select Pet Species</label>
                        <select id="pet-species" class="form-select form-select-lg">
                            <option value="cat" selected>🐱 Cat (Feline)</option>
                            <option value="dog">🐕 Dog (Canine)</option>
                            <option value="rabbit">🐰 Rabbit (Lagomorph)</option>
                            <option value="horse">🐎 Horse (Equine)</option>
                            <option value="budgie">🦜 Budgerigar / Cockatiel</option>
                            <option value="parrot">🦅 Large Parrot (Macaw / Cockatoo)</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-custom">Pet's Chronological Age (Years)</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="range" id="pet-age-slider" min="0" max="25" step="0.5" value="3" class="form-range flex-grow-1">
                            <input type="number" id="pet-age-input" min="0" max="25" step="0.1" value="3" class="form-control form-control-lg rounded-3 text-center font-monospace" style="width: 100px;">
                        </div>
                        <span class="text-muted small mt-1 d-block" id="pet-age-help">Supports decimals (e.g. 1.5 yrs)</span>
                    </div>
                </div>

                {{-- Dynamic Sub-Options --}}
                <div id="sub-options-container" class="mt-4 pt-3 border-top" style="display: none;">
                    {{-- Dogs Sub-Option --}}
                    <div id="sub-options-dog" class="sub-option-block" style="display: none;">
                        <label class="form-label-custom">Canine Weight Class (Adult Size)</label>
                        <div class="d-flex gap-2 flex-wrap">
                            <button type="button" class="btn btn-sm btn-outline-secondary px-3 active btn-sub-dog" data-rate="4" data-size="small">Small (<20 lbs)</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary px-3 btn-sub-dog" data-rate="5" data-size="medium">Medium (21-50 lbs)</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary px-3 btn-sub-dog" data-rate="6" data-size="large">Large (51-90 lbs)</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary px-3 btn-sub-dog" data-rate="7" data-size="giant">Giant (>90 lbs)</button>
                        </div>
                    </div>

                    {{-- Cats Sub-Option --}}
                    <div id="sub-options-cat" class="sub-option-block" style="display: none;">
                        <label class="form-label-custom">Feline Environment</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary px-4 active btn-sub-cat" data-lifestyle="indoor">Indoor Environment</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary px-4 btn-sub-cat" data-lifestyle="outdoor">Outdoor Environment</button>
                        </div>
                    </div>
                </div>

                {{-- Presets Quick Action --}}
                <div class="mt-4 pt-3 border-top">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Species Presets:</span>
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 pet-preset" data-species="cat" data-age="2" data-sub="indoor">🐱 Indoor Cat (2 yrs)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 pet-preset" data-species="dog" data-age="6" data-sub="giant">🐕 Giant Dog (6 yrs)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 pet-preset" data-species="rabbit" data-age="4">🐰 Rabbit (4 yrs)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 pet-preset" data-species="horse" data-age="12">🐎 Horse (12 yrs)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 pet-preset" data-species="parrot" data-age="25">🦜 Macaw Parrot (25 yrs)</button>
                    </div>
                </div>

                <div class="mt-3 p-3 rounded-3 small text-secondary" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <i class="fas fa-circle-info me-1 text-success"></i> <strong>Multi-Species Standard:</strong> Smaller home pets like rabbits and birds mature very quickly but have highly distinct senior stages compared to dogs and cats. Large parrots live up to 80 years, aging highly gradually over decades.
                </div>
            </div>
        </div>
    </div>

    {{-- Output Card --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="pet-output-card" style="--tool-hue: 150; --tool-color: #10b981; --tool-bg: rgba(16, 185, 129, 0.04); transition: all 0.3s ease;">
            <div class="output-hero text-center py-2">
                <span class="output-hero-label">Human Biological Age Equivalent</span>
                <div class="d-flex align-items-baseline justify-content-center gap-2">
                    <div class="output-hero-value" id="out-pet-human" style="font-size:4rem; font-weight:900; letter-spacing: -2px;">28</div>
                    <span class="fs-4 fw-bold text-muted">Human Years</span>
                </div>
                <div class="d-inline-block hero-status-pill mt-2" id="out-pet-stage">Adult</div>
            </div>

            {{-- Animal Lifespan Spectrum --}}
            <div class="mt-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="small text-muted fw-bold">Comparative Lifespan Spectrum</span>
                    <span class="small fw-bold text-success" id="out-pet-spectrum-text">Adult Stage</span>
                </div>
                <div class="position-relative">
                    <div class="progress rounded-pill" style="height: 12px; background: #e2e8f0;">
                        <div id="out-pet-bar" class="progress-bar rounded-pill" style="width: 30%; background: #10b981; transition: all 0.5s ease;"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between small text-muted px-1 mt-1 tiny fw-bold uppercase">
                    <span>Infancy</span>
                    <span>Adolescent</span>
                    <span>Prime</span>
                    <span>Mature</span>
                    <span>Senior</span>
                    <span>Geriatric</span>
                </div>
            </div>

            {{-- Stat Cards --}}
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Species</span>
                        <span class="stat-card-value text-capitalize" id="out-pet-lbl-species">Cat</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Chronological Age</span>
                        <span class="stat-card-value" id="out-pet-lbl-age">3.0 yrs</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Annual Aging Rate</span>
                        <span class="stat-card-value" id="out-pet-lbl-rate">+4 yrs/yr</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Senior Milestone</span>
                        <span class="stat-card-value" id="out-pet-lbl-milestone">7 yrs left</span>
                    </div>
                </div>
            </div>

            {{-- Vet Insights Panel --}}
            <div class="mt-4 p-4 rounded-4" style="background: rgba(255, 255, 255, 0.8); border: 1px solid #e2e8f0;">
                <h5 class="fw-bold mb-3 d-flex align-items-center text-dark" style="font-size:1.05rem;">
                    <i class="fas fa-stethoscope text-primary me-2"></i> Veterinary & Avian Care Milestones
                </h5>
                <p class="small text-secondary mb-3" id="out-pet-insights-desc">
                    Your pet is in their prime healthy adult years. Maintain standard checkups.
                </p>
                <div class="row g-3" id="out-pet-guidelines-list">
                    {{-- Guidelines populated dynamically --}}
                </div>
            </div>

            {{-- Report Copier (No Download Buttons) --}}
            <div class="mt-4 border-top pt-3 text-center">
                <button type="button" class="btn btn-dark btn-lg py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-pet-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i> Copy Biological Report
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectSpecies = document.getElementById('pet-species');
    const slider = document.getElementById('pet-age-slider');
    const input = document.getElementById('pet-age-input');

    // Sub options
    const containerSub = document.getElementById('sub-options-container');
    const blockDog = document.getElementById('sub-options-dog');
    const blockCat = document.getElementById('sub-options-cat');
    const btnsDog = document.querySelectorAll('.btn-sub-dog');
    const btnsCat = document.querySelectorAll('.btn-sub-cat');

    // Sub state
    let dogSize = 'small';
    let dogRate = 4;
    let catLifestyle = 'indoor';

    const speciesProfiles = {
        cat: { maxAge: 25, label: 'Cat', hue: 150, clr: '#10b981', bg: 'rgba(16, 185, 129, 0.05)' },
        dog: { maxAge: 20, label: 'Dog', hue: 24, clr: '#d97706', bg: 'rgba(217, 119, 6, 0.05)' },
        rabbit: { maxAge: 15, label: 'Rabbit', hue: 320, clr: '#db2777', bg: 'rgba(219, 39, 119, 0.05)' },
        horse: { maxAge: 40, label: 'Horse', hue: 200, clr: '#0284c7', bg: 'rgba(2, 132, 199, 0.05)' },
        budgie: { maxAge: 20, label: 'Budgie', hue: 60, clr: '#ca8a04', bg: 'rgba(202, 138, 4, 0.05)' },
        parrot: { maxAge: 80, label: 'Large Parrot', hue: 270, clr: '#7c3aed', bg: 'rgba(124, 58, 237, 0.05)' }
    };

    function calculate() {
        const species = selectSpecies.value;
        const age = parseFloat(input.value) || 0;
        
        let humanAge = 0;
        let rateLabel = '+4 yrs/yr';
        let seniorAge = 10;
        let geriatricAge = 14;

        if (species === 'cat') {
            if (age < 1) {
                humanAge = age * 15;
            } else if (age < 2) {
                humanAge = 15 + (age - 1) * 9;
            } else {
                const add = catLifestyle === 'indoor' ? 4 : 7;
                humanAge = 24 + (age - 2) * add;
            }
            rateLabel = '+' + (catLifestyle === 'indoor' ? '4' : '7') + ' yrs/yr';
            seniorAge = 11;
            geriatricAge = 15;

        } else if (species === 'dog') {
            if (age < 1) {
                humanAge = age * 15;
            } else if (age < 2) {
                humanAge = 15 + (age - 1) * 9;
            } else {
                humanAge = 24 + (age - 2) * dogRate;
            }
            rateLabel = '+' + dogRate + ' yrs/yr';
            
            if (dogSize === 'small') { seniorAge = 11; geriatricAge = 14; }
            else if (dogSize === 'medium') { seniorAge = 9; geriatricAge = 12; }
            else if (dogSize === 'large') { seniorAge = 8; geriatricAge = 11; }
            else { seniorAge = 6; geriatricAge = 9; }

        } else if (species === 'rabbit') {
            if (age < 1) {
                humanAge = age * 16;
            } else if (age < 2) {
                humanAge = 16 + (age - 1) * 8;
            } else {
                humanAge = 24 + (age - 2) * 6;
            }
            rateLabel = '+6 yrs/yr';
            seniorAge = 7;
            geriatricAge = 10;

        } else if (species === 'horse') {
            if (age < 1) {
                humanAge = age * 12;
            } else if (age < 2) {
                humanAge = 12 + (age - 1) * 10;
            } else {
                humanAge = 22 + (age - 2) * 2.5;
            }
            rateLabel = '+2.5 yrs/yr';
            seniorAge = 20;
            geriatricAge = 28;

        } else if (species === 'budgie') {
            if (age < 1) {
                humanAge = age * 18;
            } else {
                humanAge = 18 + (age - 1) * 4;
            }
            rateLabel = '+4 yrs/yr';
            seniorAge = 10;
            geriatricAge = 14;

        } else if (species === 'parrot') {
            if (age < 1) {
                humanAge = age * 10;
            } else {
                humanAge = 10 + (age - 1) * 1.15;
            }
            rateLabel = '+1.15 yrs/yr';
            seniorAge = 45;
            geriatricAge = 60;
        }

        humanAge = Math.round(humanAge * 10) / 10;

        // Classify stage
        let stageName = 'Adult';
        let stageBar = 40;
        let stageDesc = 'Pet is in their healthy adult prime.';

        if (age < (seniorAge * 0.15)) {
            stageName = 'Infancy';
            stageBar = 12;
            stageDesc = 'Infant stage. High dependence, rapid growth, and structural bone building.';
        } else if (age < (seniorAge * 0.3)) {
            stageName = 'Adolescent';
            stageBar = 26;
            stageDesc = 'Adolescent phase. Developing behavioral habits and sexual/structural maturity.';
        } else if (age >= geriatricAge) {
            stageName = 'Geriatric';
            stageBar = 95;
            stageDesc = 'Advanced geriatric age. Joint relief, specialized senior diet, and warm resting setups are essential.';
        } else if (age >= seniorAge) {
            stageName = 'Senior';
            stageBar = 80;
            stageDesc = 'Senior biological age. Watch for arthritis, organ shifts, and visual decline. Twice-yearly wellness screenings.';
        } else if (age >= (seniorAge - 3)) {
            stageName = 'Mature';
            stageBar = 65;
            stageDesc = 'Middle age. Activity levels might decline. Ensure caloric levels are adapted to avoid weight gain.';
        }

        // Output text fields
        document.getElementById('out-pet-human').innerText = humanAge;
        
        const stagePill = document.getElementById('out-pet-stage');
        stagePill.innerText = stageName;
        
        const profile = speciesProfiles[species];
        stagePill.style.background = profile.bg;
        stagePill.style.color = profile.clr;
        stagePill.style.border = `1.5px solid ${profile.clr}30`;

        document.getElementById('out-pet-spectrum-text').innerText = stageName + ' Stage';
        document.getElementById('out-pet-spectrum-text').style.color = profile.clr;
        document.getElementById('out-pet-bar').style.width = stageBar + '%';
        document.getElementById('out-pet-bar').style.background = profile.clr;

        // Stat cards
        document.getElementById('out-pet-lbl-species').innerText = profile.label;
        document.getElementById('out-pet-lbl-age').innerText = age + ' yrs';
        document.getElementById('out-pet-lbl-rate').innerText = rateLabel;
        
        const seniorDiff = seniorAge - age;
        document.getElementById('out-pet-lbl-milestone').innerText = seniorDiff > 0 ? Math.round(seniorDiff * 10)/10 + ' yrs left' : 'Senior';

        document.getElementById('out-pet-insights-desc').innerText = stageDesc;

        // Populate Veterinary Guidelines dynamically
        let guidelines = [];
        if (species === 'cat') {
            guidelines.push({ icon: 'fa-cat', title: 'Kidney Safeguard', desc: 'Felines easily develop kidney fatigue. Supply moisture-rich wet food or fountains.' });
            guidelines.push({ icon: 'fa-feather', title: 'Mental Toy Play', desc: 'Keep brains active with vertical towers, scratch posts, and puzzle toys.' });
        } else if (species === 'dog') {
            guidelines.push({ icon: 'fa-bone', title: 'Hip and Joints', desc: 'Start glucosamine supplements early for active dog sizes to support cartilages.' });
            guidelines.push({ icon: 'fa-tooth', title: 'Oral Hygiene', desc: 'Small breeds have narrow jaws; brush teeth weekly to avoid bacteria.' });
        } else if (species === 'rabbit') {
            guidelines.push({ icon: 'fa-carrot', title: 'Hay Requirement', desc: 'Rabbits need unlimited fresh Timothy Hay (80% of diet) for gastrointestinal health.' });
            guidelines.push({ icon: 'fa-scissors', title: 'Dental Wear', desc: 'Rabbit teeth grow continuously; provide apple wood logs to wear them down.' });
        } else if (species === 'horse') {
            guidelines.push({ icon: 'fa-shield-heart', title: 'Equine Colic Defense', desc: 'Supply constant water. Prevent feeding directly on sandy floor to avoid colic.' });
            guidelines.push({ icon: 'fa-horse-head', title: 'Hoof Trimming', desc: 'Farrier hoof trims every 6 to 8 weeks are critical to maintain structural angles.' });
        } else {
            // Birds
            guidelines.push({ icon: 'fa-feather-pointed', title: 'Respiratory Safety', desc: 'Avian lungs are ultra-sensitive. NEVER use non-stick Teflon pans or aerosols nearby.' });
            guidelines.push({ icon: 'fa-sun', title: 'UVB Exposure', desc: 'Birds need synthesized Vitamin D3. Provide bird-safe window sunning or avian UVB bulbs.' });
        }

        const containerList = document.getElementById('out-pet-guidelines-list');
        containerList.innerHTML = guidelines.map(g => `
            <div class="col-md-6">
                <div class="d-flex align-items-start gap-3 p-3 rounded-3" style="background:#f8fafc; border:1px solid #f1f5f9;">
                    <div class="fs-4" style="opacity: 0.85; color: ${profile.clr} !important;"><i class="fas ${g.icon}"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1 small text-dark">${g.title}</h6>
                        <p class="mb-0 text-muted small" style="line-height:1.3;">${g.desc}</p>
                    </div>
                </div>
            </div>
        `).join('');

        // Apply theme color
        document.getElementById('pet-output-card').style.setProperty('--tool-color', profile.clr);
        document.getElementById('pet-output-card').style.setProperty('--tool-bg', profile.bg);
    }

    function syncSpeciesLimits() {
        const species = selectSpecies.value;
        const profile = speciesProfiles[species];

        // Update Slider Limits
        slider.max = profile.maxAge;
        if (parseFloat(slider.value) > profile.maxAge) {
            slider.value = Math.round(profile.maxAge / 2);
            input.value = slider.value;
        }

        // Show/hide suboptions
        if (species === 'dog') {
            containerSub.style.display = 'block';
            blockDog.style.display = 'block';
            blockCat.style.display = 'none';
        } else if (species === 'cat') {
            containerSub.style.display = 'block';
            blockDog.style.display = 'none';
            blockCat.style.display = 'block';
        } else {
            containerSub.style.display = 'none';
        }

        document.getElementById('pet-age-help').innerText = `Max standard age for ${profile.label} is ${profile.maxAge} years`;
        calculate();
    }

    // Wiring listeners
    selectSpecies.addEventListener('change', syncSpeciesLimits);

    slider.addEventListener('input', function() {
        input.value = this.value;
        calculate();
    });

    input.addEventListener('input', function() {
        let val = parseFloat(this.value) || 0;
        const max = parseFloat(slider.max);
        val = Math.max(0, Math.min(max, val));
        slider.value = val;
        calculate();
    });

    // Dog Sub logic
    btnsDog.forEach(btn => {
        btn.addEventListener('click', function() {
            btnsDog.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            dogSize = this.dataset.size;
            dogRate = parseInt(this.dataset.rate);
            calculate();
        });
    });

    // Cat Sub logic
    btnsCat.forEach(btn => {
        btn.addEventListener('click', function() {
            btnsCat.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            catLifestyle = this.dataset.lifestyle;
            calculate();
        });
    });

    // Presets
    document.querySelectorAll('.pet-preset').forEach(btn => {
        btn.addEventListener('click', function() {
            const spec = this.dataset.species;
            const age = parseFloat(this.dataset.age);
            const sub = this.dataset.sub;

            selectSpecies.value = spec;
            syncSpeciesLimits();

            input.value = age;
            slider.value = age;

            if (spec === 'dog' && sub) {
                dogSize = sub;
                btnsDog.forEach(b => {
                    if (b.dataset.size === sub) {
                        b.classList.add('active');
                        dogRate = parseInt(b.dataset.rate);
                    } else {
                        b.classList.remove('active');
                    }
                });
            } else if (spec === 'cat' && sub) {
                catLifestyle = sub;
                btnsCat.forEach(b => {
                    if (b.dataset.lifestyle === sub) {
                        b.classList.add('active');
                    } else {
                        b.classList.remove('active');
                    }
                });
            }

            calculate();
        });
    });

    // Clipboard Copy
    document.getElementById('btn-pet-copy').addEventListener('click', function() {
        const species = selectSpecies.value;
        const age = input.value;
        const hAge = document.getElementById('out-pet-human').innerText;
        const stage = document.getElementById('out-pet-stage').innerText;
        const label = speciesProfiles[species].label;

        const text = `Pet Age Biological Report\n━━━━━━━━━━━━━━━━━━━━━━\nSpecies: ${label}\nChronological Age: ${age} years\nHuman Equivalent: ${hAge} years\nLife Stage: ${stage}\n━━━━━━━━━━━━━━━━━━━━━━\nCare insights calculated instantly via ToolsHub Pets`;
        
        navigator.clipboard.writeText(text).then(() => {
            const orig = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check-double me-2"></i> Report Copied!';
            setTimeout(() => this.innerHTML = orig, 2000);
        });
    });

    // Init
    syncSpeciesLimits();
});
</script>

<style>
.pet-age-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 1.75rem; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.02); }
.pet-age-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; }
.pet-age-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.pet-age-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; }
.pet-age-rebuilt .tool-icon-circle { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.pet-age-rebuilt .form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; display: block; }

.pet-age-rebuilt .sub-option-block { animation: fadeInSlide 0.25s ease forwards; }

@keyframes fadeInSlide {
    from { opacity: 0; transform: translateY(4px); }
    to { opacity: 1; transform: translateY(0); }
}

.pet-age-rebuilt .output-card-themed { background: #ffffff; border-radius: 24px; padding: 2rem; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 10px 30px rgba(0,0,0,0.03); margin-top: 1.5rem; }
.pet-age-rebuilt .hero-status-pill { display: inline-block; padding: 0.4rem 1.25rem; border-radius: 100px; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; }

.pet-age-rebuilt .stat-card { background: #f8fafc; padding: 1rem; border-radius: 14px; border: 1px solid rgba(0, 0, 0, 0.01); text-align: center; }
.pet-age-rebuilt .stat-card-label { display: block; font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.25rem; }
.pet-age-rebuilt .stat-card-value { font-size: 1.05rem; font-weight: 800; color: #1e293b; }

.pet-age-rebuilt .tiny { font-size: 0.68rem; }
.pet-age-rebuilt .uppercase { text-transform: uppercase; }
</style>
