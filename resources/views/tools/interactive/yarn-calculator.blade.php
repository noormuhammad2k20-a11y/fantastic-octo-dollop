<div class="row g-4 yarn-calculator-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Row 1: Project Type and Yarn Weight --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Select Project Type</label>
                        <select id="yarn-project" class="form-select rounded-3 border-indigo-custom">
                            <option value="scarf" selected>🧣 Scarf / Cowl</option>
                            <option value="hat">🤠 Beanie / Hat</option>
                            <option value="socks">🧦 Pair of Socks</option>
                            <option value="sweater">🧥 Adult Sweater / Cardigan</option>
                            <option value="baby_blanket">👶 Baby Blanket</option>
                            <option value="full_blanket">🛏️ Full Size Blanket</option>
                            <option value="mittens">🧤 Mittens / Gloves</option>
                            <option value="shawl">👗 Shawl / Wrap</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Yarn Weight Class & Gauge</label>
                        <select id="yarn-weight" class="form-select rounded-3">
                            <option value="lace">Lace (Weight 0) - Fingering / 2-ply</option>
                            <option value="fingering">Super Fine (Weight 1) - Sock / Fingering</option>
                            <option value="sport">Fine (Weight 2) - Sport / Baby</option>
                            <option value="dk">Light (Weight 3) - DK / Light Worsted</option>
                            <option value="worsted" selected>Medium (Weight 4) - Worsted / Afghan / Aran</option>
                            <option value="bulky">Bulky (Weight 5) - Chunky / Craft</option>
                            <option value="super_bulky">Super Bulky (Weight 6) - Roving</option>
                        </select>
                    </div>

                    {{-- Row 2: Skein properties and padding --}}
                    <div class="col-md-4">
                        <label class="form-label-custom">Skein Length (Per Ball)</label>
                        <div class="input-group">
                            <input type="number" id="skein-length" class="form-control rounded-start-3" value="220" min="1">
                            <span class="input-group-text rounded-end-3 bg-light text-muted fw-bold unit-text">yards</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Safety Overage Padding</label>
                        <select id="yarn-safety" class="form-select rounded-3">
                            <option value="1.0">0% Extra (Exact estimate)</option>
                            <option value="1.1" selected>+10% Extra (Recommended cushion)</option>
                            <option value="1.15">+15% Extra (Cables / intricate textures)</option>
                            <option value="1.2">+20% Extra (Loose crochet / fringe)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Preferred Unit</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-indigo active flex-grow-1 py-2 fw-bold rounded-3 unit-toggle-btn" data-unit="yards">
                                Yards
                            </button>
                            <button type="button" class="btn btn-outline-indigo flex-grow-1 py-2 fw-bold rounded-3 unit-toggle-btn" data-unit="meters">
                                Meters
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Manual override checkbox and input --}}
                <div class="mt-4 p-3 rounded-3 bg-light border">
                    <div class="form-check form-switch mb-0">
                        <input class="form-check-input" type="checkbox" id="override-switch">
                        <label class="form-check-label fw-bold text-secondary small" for="override-switch">Override standard project yardage with custom requirements</label>
                    </div>
                    <div id="override-input-panel" class="mt-2 d-none">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label-custom-small text-muted">Enter Custom Required Length</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="custom-yarn-req" class="form-control" value="500">
                                    <span class="input-group-text unit-text">yards</span>
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
        <div class="output-card-themed" style="--tool-hue:250;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,.04);">
            <div class="output-hero">
                <span class="output-hero-label">RECOMMENDED PURCHASE SIZE</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value text-indigo" id="out-skeins-needed">2</span>
                    <span class="output-hero-unit">Skeins / Balls</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-yarn-status">Calculated for Worsted yarn</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-6 col-md-4 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Base Length Required</span>
                        <span class="stat-card-value text-dark" id="out-base-length">250 yards</span>
                    </div>
                </div>
                <div class="col-6 col-md-4 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Total Length (Padded)</span>
                        <span class="stat-card-value text-dark" id="out-total-length">275 yards</span>
                    </div>
                </div>
                <div class="col-12 col-md-4 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Skein Length Used</span>
                        <span class="stat-card-value text-dark" id="out-skein-length-stat">220 yards</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-scissors text-indigo me-2"></i>Knit & Crochet Gauge Suggestions
                </h6>
                <div id="out-yarn-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-2.5 px-4 fw-bold rounded-pill shadow-sm w-100" id="yarn-copy-btn">
                        <i class="fas fa-copy me-2 text-indigo"></i>Copy Yarn Recipe
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="yarn-reset">Reset Fields</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-2.5 px-4 fw-bold rounded-pill shadow-sm w-100" id="yarn-share-btn">
                        <i class="fas fa-share-alt me-2"></i>Share Shopping List
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const yarnProjectE = $('yarn-project'),
          yarnWeightE = $('yarn-weight'),
          skeinLengthE = $('skein-length'),
          yarnSafetyE = $('yarn-safety'),
          overrideSwitchE = $('override-switch'),
          overrideInputPanelE = $('override-input-panel'),
          customYarnReqE = $('custom-yarn-req');

    let currentUnit = 'yards';

    // Matrix lookup (Base yardage required for project at worsted weight, scales with weight)
    const baseProjectYardages = {
        'scarf': 250,
        'hat': 150,
        'socks': 250,
        'sweater': 1100,
        'baby_blanket': 800,
        'full_blanket': 2500,
        'mittens': 100,
        'shawl': 500
    };

    // Weight multiplier factor (Lace needs more yardage because stitch area is smaller)
    const weightMultipliers = {
        'lace': 1.6,
        'fingering': 1.4,
        'sport': 1.2,
        'dk': 1.1,
        'worsted': 1.0,
        'bulky': 0.8,
        'super_bulky': 0.6
    };

    // Recommended needle / hook sizes
    const gaugeGuidelines = {
        'lace': { needle: 'US 000-1 (1.5mm - 2.25mm)', hook: 'US Steel 6-8 (1.6mm - 1.4mm)', ply: '2-ply / Lace' },
        'fingering': { needle: 'US 1-3 (2.25mm - 3.25mm)', hook: 'US B-1 to E-4 (2.25mm - 3.5mm)', ply: '4-ply / Sock' },
        'sport': { needle: 'US 3-5 (3.25mm - 3.75mm)', hook: 'US E-4 to 7 (3.5mm - 4.5mm)', ply: '5-ply / Sport' },
        'dk': { needle: 'US 5-7 (3.75mm - 4.5mm)', hook: 'US 7 to I-9 (4.5mm - 5.5mm)', ply: '8-ply / Double Knit' },
        'worsted': { needle: 'US 7-9 (4.5mm - 5.5mm)', hook: 'US I-9 to K-10.5 (5.5mm - 6.5mm)', ply: '10-ply / Aran' },
        'bulky': { needle: 'US 9-11 (5.5mm - 8.0mm)', hook: 'US K-10.5 to M-13 (6.5mm - 9.0mm)', ply: '12-ply / Chunky' },
        'super_bulky': { needle: 'US 11-17 (8.0mm - 12.0mm)', hook: 'US M-13 to Q (9.0mm - 15.0mm)', ply: 'Roving / Super Chunky' }
    };

    function calculateYarn() {
        const project = yarnProjectE.value;
        const weight = yarnWeightE.value;
        const ballLength = parseFloat(skeinLengthE.value) || 200;
        const safetyFactor = parseFloat(yarnSafetyE.value) || 1.1;

        let baseYardage = baseProjectYardages[project] * weightMultipliers[weight];

        if (overrideSwitchE.checked) {
            let customVal = parseFloat(customYarnReqE.value) || 500;
            // The custom input is entered in the current display unit.
            // Standardizing back to yards internally for base lookup if unit is meters
            baseYardage = currentUnit === 'meters' ? (customVal / 0.9144) : customVal;
        }

        let baseVal = baseYardage;
        let paddedVal = baseYardage * safetyFactor;
        let finalBallLen = ballLength;

        let displayUnit = 'yards';

        if (currentUnit === 'meters') {
            // Convert to meters
            baseVal = baseVal * 0.9144;
            paddedVal = paddedVal * 0.9144;
            displayUnit = 'meters';
        }

        // Calculate Skeins Needed (rounded up)
        const skeinsNeeded = Math.ceil(paddedVal / finalBallLen);

        $('out-skeins-needed').textContent = isNaN(skeinsNeeded) || skeinsNeeded <= 0 ? '0' : skeinsNeeded;
        $('out-base-length').textContent = `${baseVal.toFixed(0)} ${displayUnit}`;
        $('out-total-length').textContent = `${paddedVal.toFixed(0)} ${displayUnit}`;
        $('out-skein-length-stat').textContent = `${finalBallLen.toFixed(0)} ${displayUnit}`;

        // Weight text formatting
        const weightLabels = {
            'lace': 'Lace', 'fingering': 'Fingering', 'sport': 'Sport',
            'dk': 'DK / Light', 'worsted': 'Worsted / Aran', 'bulky': 'Bulky / Chunky',
            'super_bulky': 'Super Bulky'
        };
        $('out-yarn-status').textContent = `Recommended for ${weightLabels[weight]} Yarn Weight`;

        // Dynamic insights
        const guideline = gaugeGuidelines[weight];
        let insightHtml = `<ul class="list-unstyled mb-0">
            <li class="mb-2"><i class="fas fa-circle-info text-indigo me-1"></i> Recommended knitting needle size: <strong>${guideline.needle}</strong>.</li>
            <li class="mb-2"><i class="fas fa-hashtag text-indigo me-1"></i> Recommended crochet hook size: <strong>${guideline.hook}</strong>.</li>
            <li class="mb-2"><i class="fas fa-globe text-indigo me-1"></i> Yarn specification standard: <strong>${guideline.ply}</strong>.</li>
            <li class="mb-2"><i class="fas fa-check-circle text-success me-1"></i> We have added a <strong>${Math.round((safetyFactor - 1)*100)}% safety cushion</strong>. This covers swatch testing and tails.</li>
        </ul>`;

        $('out-yarn-insights').innerHTML = insightHtml;
    }

    // Handle Switch Toggle
    overrideSwitchE.addEventListener('change', () => {
        if (overrideSwitchE.checked) {
            overrideInputPanelE.classList.remove('d-none');
        } else {
            overrideInputPanelE.classList.add('d-none');
        }
        calculateYarn();
    });

    // Handle Unit Toggle
    document.querySelectorAll('.unit-toggle-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const unit = btn.dataset.unit;
            if (unit === currentUnit) return;

            document.querySelectorAll('.unit-toggle-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Convert inputs
            let currentSkeinLen = parseFloat(skeinLengthE.value) || 200;
            let currentCustomVal = parseFloat(customYarnReqE.value) || 500;

            if (unit === 'meters') {
                skeinLengthE.value = (currentSkeinLen * 0.9144).toFixed(0);
                customYarnReqE.value = (currentCustomVal * 0.9144).toFixed(0);
                document.querySelectorAll('.unit-text').forEach(el => el.textContent = 'meters');
            } else {
                skeinLengthE.value = (currentSkeinLen / 0.9144).toFixed(0);
                customYarnReqE.value = (currentCustomVal / 0.9144).toFixed(0);
                document.querySelectorAll('.unit-text').forEach(el => el.textContent = 'yards');
            }

            currentUnit = unit;
            calculateYarn();
        });
    });

    // Listeners
    [yarnProjectE, yarnWeightE, skeinLengthE, yarnSafetyE, customYarnReqE].forEach(el => {
        el.addEventListener('input', calculateYarn);
    });

    // Reset fields
    $('yarn-reset').addEventListener('click', () => {
        yarnProjectE.value = 'scarf';
        yarnWeightE.value = 'worsted';
        skeinLengthE.value = currentUnit === 'yards' ? '220' : '200';
        yarnSafetyE.value = '1.1';
        overrideSwitchE.checked = false;
        overrideInputPanelE.classList.add('d-none');
        customYarnReqE.value = currentUnit === 'yards' ? '500' : '450';
        calculateYarn();
    });

    // Copy specifications
    $('yarn-copy-btn').addEventListener('click', function(){
        const projectText = overrideSwitchE.checked ? 'Custom Length' : yarnProjectE.options[yarnProjectE.selectedIndex].text;
        const text = `Yarn Estimator & Shopping List:\n` +
                     `-------------------------------------------\n` +
                     `Project Design: ${projectText}\n` +
                     `Target Yarn Weight: ${yarnWeightE.options[yarnWeightE.selectedIndex].text}\n` +
                     `Skein length: ${skeinLengthE.value} ${currentUnit} per ball\n` +
                     `-------------------------------------------\n` +
                     `Skeins to Purchase: ${$('out-skeins-needed').textContent} balls\n` +
                     `Total length: ${$('out-total-length').textContent}\n` +
                     `Calculated via ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied Shopping List!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    // Share link simple implementation
    $('yarn-share-btn').addEventListener('click', function(){
        const dummyUrl = window.location.href;
        navigator.clipboard.writeText(dummyUrl).then(()=>{
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied URL Link!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculateYarn();
});
</script>

<style>
.yarn-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:1.5rem;box-shadow:0 8px 48px rgba(79,70,229,.03)}
.yarn-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:1.25rem}
.yarn-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.25rem}
.yarn-calculator-rebuilt .calculator-header p{margin:0;font-size:0.875rem;color:#64748b;line-height:1.6}
.yarn-calculator-rebuilt .tool-icon-circle{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem;flex-shrink:0}
.yarn-calculator-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.yarn-calculator-rebuilt .form-label-custom-small{font-size:.7rem;font-weight:700;color:#475569;margin-bottom:.4rem;display:block}
.yarn-calculator-rebuilt .border-indigo-custom{border:2px solid #4f46e5}
.yarn-calculator-rebuilt .btn-outline-indigo{border-color:#4f46e5; color:#4f46e5; border-width:2.5px}
.yarn-calculator-rebuilt .btn-outline-indigo.active{background-color:#4f46e5; border-color:#4f46e5; color:#fff}
.yarn-calculator-rebuilt .btn-outline-indigo:hover{background-color:rgba(79,70,229,.1); color:#4f46e5}
.yarn-calculator-rebuilt .btn-outline-indigo.active:hover{background-color:#4f46e5; color:#fff}
.text-indigo{color:#4f46e5!important}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:1.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:1.25rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:1rem}
.output-hero-label{display:block;font-size:.75rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:0.5rem}
.output-hero-value{font-size:2.25rem;font-weight:900;line-height:1;letter-spacing:-2px}
.stat-card{border:2.5px solid #f1f5f9;border-radius:16px;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1px;margin-bottom:4px}
.stat-card-value{font-size:1.15rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .yarn-calculator-rebuilt .calculator-card { padding: 1rem; }
    .output-card-themed { padding: 1rem; }
    .output-hero-value { font-size: 1.6rem; }
}
</style>
