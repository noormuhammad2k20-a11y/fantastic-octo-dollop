<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

<div class="row g-4 resistor-color-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body pt-3">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
                
                <div class="row g-3 align-items-center mb-4">
                    <div class="col-md-4">
                        <label class="form-label-custom">Resistor Band Count</label>
                        <select id="resistor-bands" class="form-select form-select-sm rounded-3 shadow-none border-secondary-subtle">
                            <option value="4" selected>4-Band Resistor</option>
                            <option value="5">5-Band Resistor</option>
                            <option value="6">6-Band Resistor</option>
                        </select>
                    </div>
                    <div class="col-md-8 text-center">
                        
                        <div class="p-2 border rounded-3 bg-light shadow-inner d-flex justify-content-center align-items-center" style="min-height: 80px;">
                            <svg viewBox="0 0 350 70" width="100%" height="70" style="max-width: 320px;">
                                <!-- Resistor leads -->
                                <line x1="10" y1="35" x2="340" y2="35" stroke="#94a3b8" stroke-width="6" stroke-linecap="round"/>
                                <!-- Body -->
                                <rect x="60" y="15" width="230" height="40" rx="10" fill="#fef08a" stroke="#e2e8f0" stroke-width="2"/>
                                <path d="M 60,15 A 10,10 0 0,0 60,55" fill="#fef08a"/>
                                <path d="M 290,15 A 10,10 0 0,1 290,55" fill="#fef08a"/>
                                
                                <!-- Stripes -->
                                <rect id="svg-band1" x="90" y="15" width="10" height="40" fill="#475569" rx="1"/>
                                <rect id="svg-band2" x="120" y="15" width="10" height="40" fill="#d97706" rx="1"/>
                                <rect id="svg-band3" x="150" y="15" width="10" height="40" fill="#dc2626" rx="1"/>
                                <rect id="svg-band4" x="180" y="15" width="10" height="40" fill="#fbbf24" rx="1"/>
                                <rect id="svg-band5" x="210" y="15" width="10" height="40" fill="#a855f7" rx="1"/>
                                <rect id="svg-band6" x="240" y="15" width="10" height="40" fill="#b45309" rx="1"/>
                            </svg>
                        </div>
                    </div>
                </div>

                
                <div class="row g-2" id="color-selectors-container">
                    <!-- Dynamic selectors injected by JS -->
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 resistor-preset" data-bands="4" data-colors="brown,black,red,gold">🎚️ Standard 1kΩ ±5%</button>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 resistor-preset" data-bands="5" data-colors="yellow,violet,black,brown,brown">🎚️ Precision 4.7kΩ ±1%</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-4" id="resistor-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="resistor-theme" style="--tool-hue:250;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,.03);">
            <div class="output-hero py-3 text-center">
                <span class="output-hero-label text-uppercase small fw-bold tracking-wider">Equivalent Resistance</span>
                <div class="d-flex justify-content-center align-items-baseline gap-1 mt-1">
                    <span class="output-hero-value fw-black text-2xl" id="out-value" style="color:#4f46e5;">1.0</span>
                    <span class="output-hero-unit text-muted small fw-bold" id="out-unit">kΩ</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;color:#4f46e5;">Tolerance: ±5%</div>
            </div>

            <div class="row g-2 mt-3">
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Value in Ohms</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-ohms">1,000 Ω</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Tolerance Range</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-range">950 to 1,050 Ω</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Temp Coefficient</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-ppm">—</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Standard Series</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-series">E24 / E96</span>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-calculator text-danger me-2"></i>Mathematical Concatenation
                </h6>
                <div id="latex-formula" class="my-3 overflow-x-auto text-center py-2" style="font-size: 1.1rem;"></div>
                <div id="latex-substitution" class="small text-secondary overflow-x-auto text-center border-top pt-2"></div>
            </div>

            
            <div class="mt-3 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-stethoscope text-danger me-2"></i>Resistor Quality Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            
            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-2 px-4 fw-bold rounded-pill shadow-sm" id="resistor-copy-btn" style="min-width: 250px;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Resistor Code Report
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const bandsSel = $('resistor-bands'), selectorsContainer = $('color-selectors-container'),
          latexF = $('latex-formula'), latexSub = $('latex-substitution');

    const colors = {
        black:  { name: 'Black',  val: 0, mult: 1,      tol: null,  ppm: null,  hex: '#000000', text: '#ffffff' },
        brown:  { name: 'Brown',  val: 1, mult: 10,     tol: 1,     ppm: 100,   hex: '#964B00', text: '#ffffff' },
        red:    { name: 'Red',    val: 2, mult: 100,    tol: 2,     ppm: 50,    hex: '#FF0000', text: '#ffffff' },
        orange: { name: 'Orange', val: 3, mult: 1000,   tol: null,  ppm: 15,    hex: '#FFA500', text: '#000000' },
        yellow: { name: 'Yellow', val: 4, mult: 10000,  tol: null,  ppm: 25,    hex: '#FFFF00', text: '#000000' },
        green:  { name: 'Green',  val: 5, mult: 100000, tol: 0.5,   ppm: null,  hex: '#008000', text: '#ffffff' },
        blue:   { name: 'Blue',   val: 6, mult: 1000000,tol: 0.25,  ppm: 10,    hex: '#0000FF', text: '#ffffff' },
        violet: { name: 'Violet', val: 7, mult: 10000000,tol: 0.1,  ppm: 5,     hex: '#EE82EE', text: '#000000' },
        grey:   { name: 'Grey',   val: 8, mult: null,    tol: 0.05,  ppm: null,  hex: '#808080', text: '#ffffff' },
        white:  { name: 'White',  val: 9, mult: null,    tol: null,  ppm: null,  hex: '#FFFFFF', text: '#000000' },
        gold:   { name: 'Gold',   val: null, mult: 0.1,  tol: 5,     ppm: null,  hex: '#D4AF37', text: '#000000' },
        silver: { name: 'Silver', val: null, mult: 0.01, tol: 10,    ppm: null,  hex: '#C0C0C0', text: '#000000' }
    };

    function renderMath() {
        if (typeof katex !== 'undefined') {
            const count = parseInt(bandsSel.value);
            if (count === 4) {
                katex.render("R = (\\text{Digit}_1 \\times 10 + \\text{Digit}_2) \\times 10^{\\text{Multiplier}}", latexF, {throwOnError: false, displayMode: true});
            } else {
                katex.render("R = (\\text{Digit}_1 \\times 100 + \\text{Digit}_2 \\times 10 + \\text{Digit}_3) \\times 10^{\\text{Multiplier}}", latexF, {throwOnError: false, displayMode: true});
            }
        } else {
            setTimeout(renderMath, 100);
        }
    }

    function buildSelectors() {
        const count = parseInt(bandsSel.value);
        selectorsContainer.innerHTML = '';

        const schema = [];
        if (count === 4) {
            schema.push({ id: 1, label: 'Band 1 (Digit)', filter: c => colors[c].val !== null });
            schema.push({ id: 2, label: 'Band 2 (Digit)', filter: c => colors[c].val !== null });
            schema.push({ id: 3, label: 'Band 3 (Multiplier)', filter: c => colors[c].mult !== null });
            schema.push({ id: 4, label: 'Band 4 (Tolerance)', filter: c => colors[c].tol !== null });
        } else if (count === 5) {
            schema.push({ id: 1, label: 'Band 1 (Digit)', filter: c => colors[c].val !== null });
            schema.push({ id: 2, label: 'Band 2 (Digit)', filter: c => colors[c].val !== null });
            schema.push({ id: 3, label: 'Band 3 (Digit)', filter: c => colors[c].val !== null });
            schema.push({ id: 4, label: 'Band 4 (Multiplier)', filter: c => colors[c].mult !== null });
            schema.push({ id: 5, label: 'Band 5 (Tolerance)', filter: c => colors[c].tol !== null });
        } else if (count === 6) {
            schema.push({ id: 1, label: 'Band 1 (Digit)', filter: c => colors[c].val !== null });
            schema.push({ id: 2, label: 'Band 2 (Digit)', filter: c => colors[c].val !== null });
            schema.push({ id: 3, label: 'Band 3 (Digit)', filter: c => colors[c].val !== null });
            schema.push({ id: 4, label: 'Band 4 (Multiplier)', filter: c => colors[c].mult !== null });
            schema.push({ id: 5, label: 'Band 5 (Tolerance)', filter: c => colors[c].tol !== null });
            schema.push({ id: 6, label: 'Band 6 (Temp Coeff)', filter: c => colors[c].ppm !== null });
        }

        const colWidth = count === 4 ? 'col-md-3' : count === 5 ? 'col-md-2' : 'col-md-2';

        schema.forEach(band => {
            let selectHtml = `<div class="${colWidth}"><label class="form-label-custom">${band.label}</label>`;
            selectHtml += `<select id="res-band-${band.id}" class="form-select form-select-sm rounded-3 shadow-none border-secondary-subtle select-color-styled">`;
            
            Object.keys(colors).forEach(c => {
                if (band.filter(c)) {
                    selectHtml += `<option value="${c}">${colors[c].name}</option>`;
                }
            });
            selectHtml += `</select></div>`;
            selectorsContainer.insertAdjacentHTML('beforeend', selectHtml);
        });

        // Set default selections
        if (count === 4) {
            $('res-band-1').value = 'brown';
            $('res-band-2').value = 'black';
            $('res-band-3').value = 'red';
            $('res-band-4').value = 'gold';
        } else if (count === 5) {
            $('res-band-1').value = 'yellow';
            $('res-band-2').value = 'violet';
            $('res-band-3').value = 'black';
            $('res-band-4').value = 'brown';
            $('res-band-5').value = 'brown';
        } else if (count === 6) {
            $('res-band-1').value = 'yellow';
            $('res-band-2').value = 'violet';
            $('res-band-3').value = 'black';
            $('res-band-4').value = 'brown';
            $('res-band-5').value = 'brown';
            $('res-band-6').value = 'brown';
        }

        // Re-bind listeners
        for (let i = 1; i <= count; i++) {
            $(`res-band-${i}`).addEventListener('change', calculate);
        }

        calculate();
    }

    function calculate() {
        const count = parseInt(bandsSel.value);
        renderMath();

        let b1 = $('res-band-1').value,
            b2 = $('res-band-2').value,
            b3 = $('res-band-3').value,
            b4 = $('res-band-4').value,
            b5 = count >= 5 ? $('res-band-5').value : null,
            b6 = count === 6 ? $('res-band-6').value : null;

        // Hide unused bands in SVG
        $('svg-band5').style.display = count >= 5 ? 'block' : 'none';
        $('svg-band6').style.display = count === 6 ? 'block' : 'none';

        // Update SVG band colors
        $('svg-band1').setAttribute('fill', colors[b1].hex);
        $('svg-band2').setAttribute('fill', colors[b2].hex);
        $('svg-band3').setAttribute('fill', colors[b3].hex);
        $('svg-band4').setAttribute('fill', colors[b4].hex);
        if (count >= 5) $('svg-band5').setAttribute('fill', colors[b5].hex);
        if (count === 6) $('svg-band6').setAttribute('fill', colors[b6].hex);

        let resistance = 0;
        let tolerance = 0;
        let tempCoeff = null;

        if (count === 4) {
            let dig = colors[b1].val * 10 + colors[b2].val;
            let mult = colors[b3].mult;
            resistance = dig * mult;
            tolerance = colors[b4].tol;
        } else {
            let dig = colors[b1].val * 100 + colors[b2].val * 10 + colors[b3].val;
            let mult = colors[b4].mult;
            resistance = dig * mult;
            tolerance = colors[b5].tol;
            if (count === 6) {
                tempCoeff = colors[b6].ppm;
            }
        }

        // Format run-time outputs
        let displayVal = resistance;
        let displayUnit = 'Ω';
        if (resistance >= 1e6) {
            displayVal = resistance / 1e6;
            displayUnit = 'MΩ';
        } else if (resistance >= 1000) {
            displayVal = resistance / 1000;
            displayUnit = 'kΩ';
        }

        $('out-value').textContent = displayVal.toFixed(displayVal % 1 === 0 ? 0 : 2);
        $('out-unit').textContent = displayUnit;
        $('out-status').textContent = `Tolerance: ±${tolerance}%`;

        $('out-ohms').textContent = resistance.toLocaleString() + ' Ω';
        
        const minVal = resistance * (1 - tolerance/100);
        const maxVal = resistance * (1 + tolerance/100);
        $('out-range').textContent = `${minVal.toLocaleString()} to ${maxVal.toLocaleString()} Ω`;
        $('out-ppm').textContent = tempCoeff ? `${tempCoeff} ppm/K` : '—';
        $('out-series').textContent = count >= 5 ? 'E96 / E192' : 'E24';

        // Substitution LaTeX
        if (typeof katex !== 'undefined') {
            let subStr = '';
            if (count === 4) {
                subStr = `R = (${colors[b1].val} \\times 10 + ${colors[b2].val}) \\times 10^{\\log_{10}(${colors[b3].mult})} = ${resistance.toLocaleString()}\\Omega`;
            } else {
                subStr = `R = (${colors[b1].val} \\times 100 + ${colors[b2].val} \\times 10 + ${colors[b3].val}) \\times 10^{\\log_{10}(${colors[b4].mult})} = ${resistance.toLocaleString()}\\Omega`;
            }
            katex.render(subStr, latexSub, {throwOnError: false, displayMode: true});
        }

        // Insights
        let insights = [];
        if (tolerance <= 1) {
            insights.push("High precision resistor. Ideal for operational amplifier feedback and sensitive measurement stages.");
        } else {
            insights.push("General purpose tolerance resistor. Best suited for pull-up/pull-down lines and LED limiters.");
        }
        if (tempCoeff && tempCoeff <= 15) {
            insights.push("Highly temperature-stable trace substrate. Perfect for high-frequency or temperature-critical sensor circuitry.");
        }
        insights.push("E24 Standard series increments standard resistors in 24 steps per decade.");

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${insights.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-primary me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    bandsSel.addEventListener('change', buildSelectors);

    document.querySelectorAll('.resistor-preset').forEach(btn => {
        btn.onclick = () => {
            bandsSel.value = btn.dataset.bands;
            buildSelectors();
            const cols = btn.dataset.colors.split(',');
            for (let i = 1; i <= cols.length; i++) {
                $(`res-band-${i}`).value = cols[i-1];
            }
            calculate();
        };
    });

    $('resistor-reset').onclick = () => {
        bandsSel.value = '4';
        buildSelectors();
    };

    $('resistor-copy-btn').onclick = function() {
        let text = `Resistor Stripe Value Analysis\n`;
        text += `Resistor Configuration: ${bandsSel.options[bandsSel.selectedIndex].text}\n`;
        text += `Value: ${$('out-value').textContent} ${$('out-unit').textContent} (${$('out-ohms').textContent})\n`;
        text += `Tolerance Range: ${$('out-range').textContent}\n`;
        if (bandsSel.value === '6') {
            text += `Temperature Coefficient: ${$('out-ppm').textContent}\n`;
        }
        text += `Calculated at ToolsHub Electronics`;
        
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; 
            this.innerHTML = '<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    };

    // Initialize
    buildSelectors();
});
</script>

<style>
.resistor-color-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 8px 48px rgba(79,70,229,.04); }
.resistor-color-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.resistor-color-rebuilt .calculator-header h5 { margin: 0; font-weight: 900; color: #0f172a; font-size: 1.25rem; }
.resistor-color-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; line-height: 1.5; }
.resistor-color-rebuilt .tool-icon-circle { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
.resistor-color-rebuilt .form-label-custom { font-size: .65rem; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: .4rem; display: block; }
.output-card-themed { background: var(--tool-bg); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.03); transition: all .4s ease; }
.output-hero { border-bottom: 1px solid rgba(0,0,0,.04); }
.output-hero-label { display: block; font-size: .7rem; letter-spacing: 2px; color: #64748b; }
.output-hero-value { font-size: 3rem; font-weight: 900; line-height: 1; letter-spacing: -2px; }
.output-hero-unit { font-size: 1.25rem; font-weight: 800; margin-left: 4px; }
.stat-card { transition: all .3s ease; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,.02); }
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\resistor-color-code-calculator.blade.php ENDPATH**/ ?>