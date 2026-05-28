<div class="row g-4 puppy-calc-rebuilt">
    {{-- KaTeX Core Assets --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

    {{-- Input Card --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                {{-- Unit Toggle --}}
                <div class="d-flex justify-content-between align-items-center mb-4 p-2 rounded-3" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <span class="small fw-bold text-secondary ps-2">Measurement Unit</span>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-secondary px-3 py-1 fw-bold active btn-unit-toggle" data-unit="lbs">Lbs (Pounds)</button>
                        <button type="button" class="btn btn-outline-secondary px-3 py-1 fw-bold btn-unit-toggle" data-unit="kg">Kg (Kilograms)</button>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Current Puppy Weight</label>
                        <div class="input-group">
                            <input type="number" id="pup-weight" class="form-control form-control-lg rounded-start font-monospace" min="0.1" step="0.1" value="12">
                            <span class="input-group-text bg-light fw-bold unit-txt">lbs</span>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Puppy Age</label>
                        <div class="d-flex gap-2">
                            <input type="number" id="pup-age" class="form-control form-control-lg font-monospace flex-grow-1" min="1" step="0.5" value="12">
                            <select id="pup-age-type" class="form-select form-select-lg" style="width: 120px;">
                                <option value="weeks" selected>Weeks</option>
                                <option value="months">Months</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label-custom">Estimated Adult Breed Size</label>
                        <select id="pup-size" class="form-select form-select-lg">
                            <option value="small">Small Breed (<20 lbs / 9 kg)</option>
                            <option value="medium" selected>Medium Breed (20-50 lbs / 9-23 kg)</option>
                            <option value="large">Large Breed (50-100 lbs / 23-45 kg)</option>
                            <option value="giant">Giant Breed (>100 lbs / 45 kg)</option>
                        </select>
                    </div>
                </div>

                {{-- Presets Quick Action --}}
                <div class="mt-4 pt-3 border-top">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Breed Presets:</span>
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 pup-preset" data-weight="2.5" data-age="12" data-age-type="weeks" data-size="small">🐾 Chihuahua (12w)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 pup-preset" data-weight="15.0" data-age="16" data-age-type="weeks" data-size="medium">🦊 French Bulldog (16w)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 pup-preset" data-weight="16.5" data-age="8" data-age-type="weeks" data-size="large">🐶 Golden Retriever (8w)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 pup-preset" data-weight="85.0" data-age="24" data-age-type="weeks" data-size="giant">🦁 Great Dane (24w)</button>
                    </div>
                </div>

                <div class="mt-3 p-3 rounded-3 small text-secondary" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <i class="fas fa-circle-info me-1 text-primary"></i> <strong>Prediction Model Info:</strong> The linear formula is highly reliable for medium breeds but can overestimate large breeds. The Veterinary Growth Curve model interpolates biological growth velocity points for superior accuracy.
                </div>
            </div>
        </div>
    </div>

    {{-- Output Card --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="puppy-output-card" style="--tool-hue: 250; --tool-color: #6366f1; --tool-bg: rgba(99, 102, 241, 0.04); transition: all 0.3s ease;">
            
            <div class="row g-4">
                {{-- Left: Vet Curve Result --}}
                <div class="col-md-6 border-end-md">
                    <div class="text-center py-2 h-100 d-flex flex-column justify-content-center">
                        <span class="output-hero-label text-primary fw-bold uppercase mb-1">
                            <i class="fas fa-chart-line me-1"></i> Veterinary Growth Curve Estimate
                        </span>
                        <div class="d-flex align-items-baseline justify-content-center gap-2">
                            <div class="output-hero-value text-primary" id="out-pup-vet" style="font-size:3.75rem; font-weight:900; letter-spacing: -2px;">40.0</div>
                            <span class="fs-4 fw-bold text-muted unit-txt">lbs</span>
                        </div>
                        <p class="small text-secondary px-3 mt-2">
                            Recommended. Accounts for the typical sigmoid growth trajectory of different size classes.
                        </p>
                    </div>
                </div>

                {{-- Right: Linear LaTeX Result --}}
                <div class="col-md-6">
                    <div class="text-center py-2 h-100 d-flex flex-column justify-content-center">
                        <span class="output-hero-label text-secondary fw-bold uppercase mb-1">
                            <i class="fas fa-calculator me-1"></i> Standard Linear Projection
                        </span>
                        <div class="d-flex align-items-baseline justify-content-center gap-2">
                            <div class="output-hero-value text-secondary" id="out-pup-linear" style="font-size:3.75rem; font-weight:900; letter-spacing: -2px;">52.0</div>
                            <span class="fs-4 fw-bold text-muted unit-txt">lbs</span>
                        </div>
                        
                        {{-- LaTeX Formula --}}
                        <div class="d-inline-block mx-auto mt-2 p-2 rounded bg-light border" id="katex-formula-box" style="font-size: 0.85rem; max-width: 90%;">
                            {{-- Populated by KaTeX --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stat Cards --}}
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Current Weight</span>
                        <span class="stat-card-value" id="out-pup-cur">12 lbs</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Age in Weeks</span>
                        <span class="stat-card-value" id="out-pup-wk">12.0 wks</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Growth Complete</span>
                        <span class="stat-card-value text-indigo" id="out-pup-pct">32%</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Maturity Age</span>
                        <span class="stat-card-value" id="out-pup-mature">48 weeks</span>
                    </div>
                </div>
            </div>

            {{-- Growth Milestones Panel --}}
            <div class="mt-4 p-4 rounded-4" style="background: rgba(255, 255, 255, 0.8); border: 1px solid #e2e8f0;">
                <h5 class="fw-bold mb-3 d-flex align-items-center text-dark" style="font-size:1.05rem;">
                    <i class="fas fa-stethoscope text-primary me-2"></i> Veterinary Developmental Milestones
                </h5>
                <p class="small text-secondary mb-3" id="out-pup-insights-desc">
                    Your puppy is entering their rapid physical development phase. Ensure structural bones develop healthily.
                </p>
                <div class="row g-3" id="out-pup-guidelines-list">
                    {{-- Guidelines populated dynamically --}}
                </div>
            </div>

            {{-- Report Copier (No Download Buttons) --}}
            <div class="mt-4 border-top pt-3 text-center">
                <button type="button" class="btn btn-dark btn-lg py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-pup-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i> Copy Growth Report
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputWeight = document.getElementById('pup-weight');
    const inputAge = document.getElementById('pup-age');
    const selectAgeType = document.getElementById('pup-age-type');
    const selectSize = document.getElementById('pup-size');
    const toggleButtons = document.querySelectorAll('.btn-unit-toggle');

    let unit = 'lbs';

    // Vet growth curve datasets (Weeks -> Growth Percentage)
    const curves = {
        small: [
            { w: 4, p: 0.10 }, { w: 8, p: 0.22 }, { w: 12, p: 0.38 }, 
            { w: 16, p: 0.53 }, { w: 20, p: 0.68 }, { w: 24, p: 0.80 }, 
            { w: 28, p: 0.88 }, { w: 32, p: 0.94 }, { w: 36, p: 1.00 }, { w: 104, p: 1.00 }
        ],
        medium: [
            { w: 4, p: 0.08 }, { w: 8, p: 0.18 }, { w: 12, p: 0.32 }, 
            { w: 16, p: 0.46 }, { w: 20, p: 0.58 }, { w: 24, p: 0.69 }, 
            { w: 28, p: 0.78 }, { w: 32, p: 0.85 }, { w: 36, p: 0.90 }, 
            { w: 40, p: 0.95 }, { w: 44, p: 0.98 }, { w: 48, p: 1.00 }, { w: 104, p: 1.00 }
        ],
        large: [
            { w: 4, p: 0.06 }, { w: 8, p: 0.14 }, { w: 12, p: 0.24 }, 
            { w: 16, p: 0.35 }, { w: 20, p: 0.45 }, { w: 24, p: 0.55 }, 
            { w: 28, p: 0.64 }, { w: 32, p: 0.72 }, { w: 36, p: 0.79 }, 
            { w: 40, p: 0.84 }, { w: 44, p: 0.88 }, { w: 48, p: 0.92 }, 
            { w: 52, p: 0.95 }, { w: 78, p: 1.00 }, { w: 104, p: 1.00 }
        ],
        giant: [
            { w: 4, p: 0.04 }, { w: 8, p: 0.10 }, { w: 12, p: 0.17 }, 
            { w: 16, p: 0.26 }, { w: 20, p: 0.35 }, { w: 24, p: 0.44 }, 
            { w: 28, p: 0.52 }, { w: 32, p: 0.60 }, { w: 36, p: 0.67 }, 
            { w: 40, p: 0.73 }, { w: 44, p: 0.78 }, { w: 48, p: 0.82 }, 
            { w: 52, p: 0.85 }, { w: 78, p: 0.95 }, { w: 104, p: 1.00 }
        ]
    };

    function getPercentage(weeks, size) {
        const curve = curves[size];
        if (weeks <= curve[0].w) return curve[0].p;
        if (weeks >= curve[curve.length - 1].w) return curve[curve.length - 1].p;
        
        for (let i = 0; i < curve.length - 1; i++) {
            const p1 = curve[i];
            const p2 = curve[i+1];
            if (weeks >= p1.w && weeks <= p2.w) {
                const ratio = (weeks - p1.w) / (p2.w - p1.w);
                return p1.p + ratio * (p2.p - p1.p);
            }
        }
        return 1.0;
    }

    function calculate() {
        const weight = parseFloat(inputWeight.value) || 0;
        let ageVal = parseFloat(inputAge.value) || 0;
        const ageType = selectAgeType.value;
        const size = selectSize.value;

        // Convert to weeks
        let weeks = ageVal;
        if (ageType === 'months') {
            weeks = ageVal * 4.348;
        }

        // Clip weeks safely
        weeks = Math.max(4, Math.min(104, weeks));

        // 1. Linear Projection: Weight / weeks * 52
        let linearEstimate = (weight / weeks) * 52;
        linearEstimate = Math.round(linearEstimate * 10) / 10;

        // 2. Vet Growth Curve
        const growthPercentage = getPercentage(weeks, size);
        let vetEstimate = weight / growthPercentage;
        vetEstimate = Math.round(vetEstimate * 10) / 10;

        // Populate results
        document.getElementById('out-pup-vet').innerText = vetEstimate;
        document.getElementById('out-pup-linear').innerText = linearEstimate;

        document.getElementById('out-pup-cur').innerText = weight + ' ' + unit;
        document.getElementById('out-pup-wk').innerText = Math.round(weeks * 10)/10 + ' wks';
        document.getElementById('out-pup-pct').innerText = Math.round(growthPercentage * 100) + '%';
        
        let maturityText = '36 weeks';
        if (size === 'medium') maturityText = '48 weeks';
        else if (size === 'large') maturityText = '78 weeks';
        else if (size === 'giant') maturityText = '104 weeks';
        document.getElementById('out-pup-mature').innerText = maturityText;

        // Render KaTeX block
        const formulaBox = document.getElementById('katex-formula-box');
        if (window.katex) {
            try {
                katex.render(
                    `Adult\\ Weight = \\frac{${weight}\\ ${unit}}{${Math.round(weeks * 10)/10}\\ wks} \\times 52 = ${linearEstimate}\\ ${unit}`, 
                    formulaBox, 
                    { displayMode: false, throwOnError: false }
                );
            } catch (err) {
                formulaBox.innerText = `Adult Weight = (${weight} / ${Math.round(weeks * 10)/10}) * 52 = ${linearEstimate}`;
            }
        }

        // Developmental Milestone Insights
        let desc = '';
        let milestones = [];

        if (weeks < 12) {
            desc = 'Very rapid initial development. Skeletal plates are fragile. Focus on vaccine socialization, building chewing habits, and feeding controlled meals.';
            milestones.push({ icon: 'fa-cubes', title: 'Puppy Socialization', desc: 'Expose them to sounds, textures, and safe humans before week 12.' });
            milestones.push({ icon: 'fa-shield-virus', title: 'Parvo & Distemper Protect', desc: 'Core immunization boosters are essential at 8 and 12 weeks.' });
        } else if (weeks < 26) {
            desc = 'Rapid juvenile adolescent phase. Adult teeth are erupting. Highly active growth requiring stable calcium-to-phosphorus ratios.';
            milestones.push({ icon: 'fa-tooth', title: 'Teething Mitigation', desc: 'Provide soft chew toys to alleviate standard teething soreness.' });
            milestones.push({ icon: 'fa-scale-unbalanced', title: 'Caloric Safeguard', desc: 'Never overfeed; heavy puppies put excess strain on adolescent hip sockets.' });
        } else {
            desc = 'Approaching physical skeletal maturity. Growth velocity drops significantly as puppy approaches full adult structural dimensions.';
            milestones.push({ icon: 'fa-dog', title: 'Surgical Timing', desc: 'Spay/neuter timing for large breeds is often recommended after growth completes (9-18 months) to allow growth plate sealing.' });
            milestones.push({ icon: 'fa-dumbbell', title: 'Agility Limitations', desc: 'Avoid high-impact jumping and running on concrete until skeleton is fully fused.' });
        }

        // Size-specific bonus insight
        if (size === 'giant') {
            milestones.push({ icon: 'fa-bone', title: 'Skeletal Rate', desc: 'Giant breeds develop up to 2 full years. Feed large-breed growth diets to limit rapid growth spurts.' });
        } else if (size === 'small') {
            milestones.push({ icon: 'fa-bolt', title: 'Calorie Burn', desc: 'Small breeds have extremely high metabolic rates. They mature very early (9 months).' });
        }

        document.getElementById('out-pup-insights-desc').innerText = desc;

        const container = document.getElementById('out-pup-guidelines-list');
        container.innerHTML = milestones.map(m => `
            <div class="col-md-6">
                <div class="d-flex align-items-start gap-3 p-3 rounded-3" style="background:#f8fafc; border:1px solid #f1f5f9;">
                    <div class="fs-4 text-indigo" style="opacity: 0.85;"><i class="fas ${m.icon}"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1 small text-dark">${m.title}</h6>
                        <p class="mb-0 text-muted small" style="line-height:1.3;">${m.desc}</p>
                    </div>
                </div>
            </div>
        `).join('');
    }

    // Toggle logic
    toggleButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            toggleButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            unit = this.dataset.unit;
            
            // Adjust current value label and numeric conversion
            const weightVal = parseFloat(inputWeight.value) || 0;
            if (unit === 'kg') {
                inputWeight.value = Math.round((weightVal / 2.2046) * 10) / 10;
            } else {
                inputWeight.value = Math.round((weightVal * 2.2046) * 10) / 10;
            }

            document.querySelectorAll('.unit-txt').forEach(t => t.innerText = unit);
            calculate();
        });
    });

    // Presets
    document.querySelectorAll('.pup-preset').forEach(btn => {
        btn.addEventListener('click', function() {
            const rawWeight = parseFloat(this.dataset.weight);
            const age = parseFloat(this.dataset.age);
            const ageType = this.dataset.ageType;
            const size = this.dataset.size;

            // Convert raw weight (preset is stored in lbs)
            if (unit === 'kg') {
                inputWeight.value = Math.round((rawWeight / 2.2046) * 10) / 10;
            } else {
                inputWeight.value = rawWeight;
            }

            inputAge.value = age;
            selectAgeType.value = ageType;
            selectSize.value = size;

            calculate();
        });
    });

    // Wire inputs
    inputWeight.addEventListener('input', calculate);
    inputAge.addEventListener('input', calculate);
    selectAgeType.addEventListener('change', calculate);
    selectSize.addEventListener('change', calculate);

    // Clipboard Copy
    document.getElementById('btn-pup-copy').addEventListener('click', function() {
        const weight = inputWeight.value;
        const weeks = document.getElementById('out-pup-wk').innerText;
        const vetEst = document.getElementById('out-pup-vet').innerText;
        const linEst = document.getElementById('out-pup-linear').innerText;
        const growthComp = document.getElementById('out-pup-pct').innerText;

        const text = `Puppy Weight & Size Prediction\n━━━━━━━━━━━━━━━━━━━━━━\nCurrent Weight: ${weight} ${unit}\nAge: ${weeks}\nGrowth Completed: ${growthComp}\n━━━━━━━━━━━━━━━━━━━━━━\nVeterinary Curve Estimate: ${vetEst} ${unit}\nLinear Projection: ${linEst} ${unit}\n━━━━━━━━━━━━━━━━━━━━━━\nCalculated instantly via ToolsHub Puppy Health`;
        
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
.puppy-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 1.75rem; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.02); }
.puppy-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; }
.puppy-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.puppy-calc-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; }
.puppy-calc-rebuilt .tool-icon-circle { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.puppy-calc-rebuilt .form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; display: block; }

.puppy-calc-rebuilt .output-card-themed { background: #ffffff; border-radius: 24px; padding: 2rem; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 10px 30px rgba(0,0,0,0.03); margin-top: 1.5rem; }
.puppy-calc-rebuilt .stat-card { background: #f8fafc; padding: 1rem; border-radius: 14px; border: 1px solid rgba(0, 0, 0, 0.01); text-align: center; }
.puppy-calc-rebuilt .stat-card-label { display: block; font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.25rem; }
.puppy-calc-rebuilt .stat-card-value { font-size: 1.05rem; font-weight: 800; color: #1e293b; }

@media (min-width: 768px) {
    .border-end-md { border-end: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0; }
}
.puppy-calc-rebuilt .uppercase { text-transform: uppercase; letter-spacing: 0.5px; }
</style>
