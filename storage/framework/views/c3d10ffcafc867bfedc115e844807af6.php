<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

<div class="row g-4 pf-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body pt-3">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
                <div class="row g-3 mb-3">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Calculation Task</label>
                        <select id="pf-mode" class="form-select form-select-sm rounded-3 shadow-none border-secondary-subtle">
                            <option value="basic" selected>Compute Power Components & PF</option>
                            <option value="correction">Size Correction Capacitance (kVAR & µF)</option>
                        </select>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Electrical Wiring Phase</label>
                        <select id="pf-phase" class="form-select form-select-sm rounded-3 shadow-none border-secondary-subtle">
                            <option value="single" selected>Single-Phase AC</option>
                            <option value="three">Three-Phase AC (Symmetrical)</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3">
                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Active/Real Power ($P$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="pf-power" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="10" step="any" min="0.01">
                            <select id="pf-power-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 75px;">
                                <option value="1">W</option>
                                <option value="1000" selected>kW</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-3" id="voltage-container">
                        <label class="form-label-custom">Line Voltage ($V$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="pf-voltage" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="230" step="any" min="1">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold">V</span>
                        </div>
                    </div>

                    
                    <div class="col-md-3" id="frequency-container" style="display: none;">
                        <label class="form-label-custom">AC Line Frequency ($f$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="pf-freq" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="50" step="any" min="1">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold">Hz</span>
                        </div>
                    </div>

                    
                    <div class="col-md-3" id="apparent-container">
                        <label class="form-label-custom">Apparent Power ($S$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="pf-apparent" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="12" step="any" min="0.01">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold">kVA</span>
                        </div>
                    </div>

                    
                    <div class="col-md-3" id="current-pf-container" style="display: none;">
                        <label class="form-label-custom">Current Power Factor ($PF_1$)</label>
                        <input type="number" id="pf-current-val" class="form-control form-control-sm rounded-3 shadow-none border-secondary-subtle" value="0.75" step="0.01" min="0.1" max="1.0">
                    </div>

                    
                    <div class="col-md-3" id="target-pf-container" style="display: none;">
                        <label class="form-label-custom">Target Power Factor ($PF_2$)</label>
                        <input type="number" id="pf-target-val" class="form-control form-control-sm rounded-3 shadow-none border-secondary-subtle" value="0.95" step="0.01" min="0.1" max="1.0">
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 pf-preset" data-mode="correction" data-phase="three" data-power="45" data-volt="480" data-curr="0.70" data-target="0.95">⚡ 3-Phase Correction (45kW Motor)</button>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 pf-preset" data-mode="basic" data-phase="single" data-power="10" data-apparent="12.5" data-volt="230">⚡ Single-Phase Basic (10kW / 12.5kVA)</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-4" id="pf-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.03);">
            <div class="output-hero py-3 text-center">
                <span class="output-hero-label text-uppercase small fw-bold tracking-wider" id="out-hero-label">Calculated Power Factor</span>
                <div class="d-flex justify-content-center align-items-baseline gap-1 mt-1">
                    <span class="output-hero-value fw-black text-2xl" id="out-value" style="color:#ef4444;">0.83</span>
                    <span class="output-hero-unit text-muted small fw-bold" id="out-unit">PF</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;color:#ef4444;">Lagging Phase</div>
            </div>

            <div class="row g-2 mt-3">
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;" id="stat1-label">Reactive Power (Q)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-stat1">6.63 kVAR</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;" id="stat2-label">Apparent Power (S)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-stat2">12.00 kVA</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;" id="stat3-label">Phase Winding Angle</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-stat3">33.6°</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;" id="stat4-label">Full Load Current</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-stat4">52.2 A</span>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-calculator text-danger me-2"></i>AC Power Equation
                </h6>
                <div id="latex-formula" class="my-3 overflow-x-auto text-center py-2" style="font-size: 1.1rem;"></div>
                <div id="latex-substitution" class="small text-secondary overflow-x-auto text-center border-top pt-2"></div>
            </div>

            
            <div class="mt-3 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-stethoscope text-danger me-2"></i>Inductive Line Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            
            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-2 px-4 fw-bold rounded-pill shadow-sm" id="pf-copy-btn" style="min-width: 250px;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Power Factor Specs
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const modeEl = $('pf-mode'), phaseEl = $('pf-phase'),
          powerEl = $('pf-power'), powerUnitEl = $('pf-power-unit'),
          voltageEl = $('pf-voltage'), freqEl = $('pf-freq'),
          apparentEl = $('pf-apparent'), currPFEl = $('pf-current-val'), targetPFEl = $('pf-target-val'),
          latexF = $('latex-formula'), latexSub = $('latex-substitution');

    function renderMath() {
        if (typeof katex !== 'undefined') {
            const mode = modeEl.value;
            if (mode === 'basic') {
                katex.render("PF = \\cos(\\theta) = \\frac{P}{S}, \\quad Q = \\sqrt{S^2 - P^2}", latexF, {throwOnError: false, displayMode: true});
            } else {
                katex.render("Q_c = P(\\tan(\\theta_1) - \\tan(\\theta_2)), \\quad C = \\frac{Q_c}{2\\pi f V^2}", latexF, {throwOnError: false, displayMode: true});
            }
        } else {
            setTimeout(renderMath, 100);
        }
    }

    function handleModeChange() {
        const mode = modeEl.value;
        if (mode === 'basic') {
            $('apparent-container').style.display = 'block';
            $('frequency-container').style.display = 'none';
            $('current-pf-container').style.display = 'none';
            $('target-pf-container').style.display = 'none';
            
            $('out-hero-label').textContent = 'Calculated Power Factor';
            
            $('stat1-label').textContent = 'Reactive Power (Q)';
            $('stat2-label').textContent = 'Apparent Power (S)';
            $('stat3-label').textContent = 'Phase Winding Angle';
            $('stat4-label').textContent = 'Full Load Current';
        } else {
            $('apparent-container').style.display = 'none';
            $('frequency-container').style.display = 'block';
            $('current-pf-container').style.display = 'block';
            $('target-pf-container').style.display = 'block';
            
            $('out-hero-label').textContent = 'Required Correction Capacitor';
            
            $('stat1-label').textContent = 'Capacitor Size (C)';
            $('stat2-label').textContent = 'Required kVAR rating';
            $('stat3-label').textContent = 'Current kVAR';
            $('stat4-label').textContent = 'Target Winding Current';
        }
        calculate();
    }

    function calculate() {
        const mode = modeEl.value;
        const phase = phaseEl.value;
        const p = parseFloat(powerEl.value) * parseFloat(powerUnitEl.value);
        const volt = parseFloat(voltageEl.value);
        const freq = parseFloat(freqEl.value);
        const s = parseFloat(apparentEl.value) * 1000; // to VA
        const currPf = parseFloat(currPFEl.value);
        const targetPf = parseFloat(targetPFEl.value);

        if (isNaN(p) || p <= 0 || isNaN(volt) || volt <= 0) return;

        renderMath();

        if (mode === 'basic') {
            if (isNaN(s) || s <= 0 || s < p) {
                $('out-value').textContent = '—';
                $('out-insights').innerHTML = '<div class="text-danger small fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>Apparent Power (kVA) must be greater than or equal to Real Power (kW).</div>';
                return;
            }

            const pf = p / s;
            const q = Math.sqrt(s * s - p * p);
            const theta = Math.acos(pf) * (180 / Math.PI);

            // Phase Current computation
            let current = 0;
            if (phase === 'single') {
                current = s / volt;
            } else {
                current = s / (Math.sqrt(3) * volt);
            }

            $('out-value').textContent = pf.toFixed(3);
            $('out-unit').textContent = 'PF';

            $('out-stat1').textContent = (q / 1000).toFixed(2) + ' kVAR';
            $('out-stat2').textContent = (s / 1000).toFixed(2) + ' kVA';
            $('out-stat3').textContent = theta.toFixed(1) + '°';
            $('out-stat4').textContent = current.toFixed(1) + ' A';

            if (typeof katex !== 'undefined') {
                const subStr = `PF = \\frac{${(p/1000).toFixed(1)}kW}{${(s/1000).toFixed(1)}kVA} = ${pf.toFixed(3)}`;
                katex.render(subStr, latexSub, {throwOnError: false, displayMode: true});
            }

            // Insights
            let insights = [];
            if (pf < 0.8) {
                insights.push(`Very low power factor of **${pf.toFixed(2)}**. Large inductive loads are causing phase delays, leading to high reactive currents and potential utility penalties.`);
            } else if (pf < 0.95) {
                insights.push("Average industrial power factor. Sizable savings can be secured by installing shunt capacitor corrections.");
            } else {
                insights.push("Excellent energy efficiency! Power factor is near unity, minimizing heat losses in cables.");
            }
            insights.push(`Your RLC phase angle lag is **${theta.toFixed(1)}°**.`);

            $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${insights.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-danger me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;

        } else {
            if (isNaN(currPf) || currPf <= 0 || currPf > 1 || isNaN(targetPf) || targetPf <= 0 || targetPf > 1) return;
            if (currPf >= targetPf) {
                $('out-value').textContent = '—';
                $('out-insights').innerHTML = '<div class="text-danger small fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>Target Power Factor must be greater than current Power Factor.</div>';
                return;
            }

            const theta1 = Math.acos(currPf);
            const theta2 = Math.acos(targetPf);

            const q1 = p * Math.tan(theta1);
            const q2 = p * Math.tan(theta2);
            const qc = q1 - q2; // required capacitor reactive power in VAR

            // Required Capacitance
            let capacitance = 0;
            if (phase === 'single') {
                capacitance = qc / (2 * Math.PI * freq * volt * volt);
            } else {
                // Assuming wye-connected capacitor bank where V is line voltage
                capacitance = qc / (2 * Math.PI * freq * volt * volt);
            }

            const capUf = capacitance * 1e6;

            const dispCap = capUf >= 1000 ? (capUf / 1000).toFixed(2) + ' mF' : capUf.toFixed(1) + ' µF';
            $('out-value').textContent = dispCap.split(' ')[0];
            $('out-unit').textContent = dispCap.split(' ')[1];

            $('out-stat1').textContent = dispCap;
            $('out-stat2').textContent = (qc / 1000).toFixed(2) + ' kVAR';
            $('out-stat3').textContent = (q1 / 1000).toFixed(2) + ' kVAR';

            const finalS = p / targetPf;
            let finalCurrent = 0;
            if (phase === 'single') {
                finalCurrent = finalS / volt;
            } else {
                finalCurrent = finalS / (Math.sqrt(3) * volt);
            }
            $('out-stat4').textContent = finalCurrent.toFixed(1) + ' A';

            if (typeof katex !== 'undefined') {
                const subStr = `Q_c = ${((q1 - q2)/1000).toFixed(2)}kVAR, \\quad C = \\frac{${qc.toFixed(0)}VAR}{2 \\pi (${freq}Hz) (${volt}V)^2} = ${capUf.toFixed(1)}\\mu\\text{F}`;
                katex.render(subStr, latexSub, {throwOnError: false, displayMode: true});
            }

            // Insights
            let insights = [];
            insights.push(`To improve Power Factor from **${currPf}** to **${targetPf}**, you need a correction bank rated for **${(qc/1000).toFixed(2)} kVAR**.`);
            insights.push(`This will safely decrease your phase line current down to **${finalCurrent.toFixed(1)} A**, dropping line transmission thermal losses.`);
            insights.push("Capacitor banks should be connected as close to inductive inductive motor terminals as possible.");

            $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${insights.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-danger me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
        }
    }

    [modeEl, phaseEl, powerEl, powerUnitEl, voltageEl, freqEl, apparentEl, currPFEl, targetPFEl].forEach(el => {
        el.addEventListener('input', calculate);
    });

    modeEl.addEventListener('change', handleModeChange);

    document.querySelectorAll('.pf-preset').forEach(btn => {
        btn.onclick = () => {
            modeEl.value = btn.dataset.mode;
            phaseEl.value = btn.dataset.phase;
            powerEl.value = btn.dataset.power;
            voltageEl.value = btn.dataset.volt;
            if (btn.dataset.apparent) apparentEl.value = btn.dataset.apparent;
            if (btn.dataset.curr) currPFEl.value = btn.dataset.curr;
            if (btn.dataset.target) targetPFEl.value = btn.dataset.target;
            handleModeChange();
        };
    });

    $('pf-reset').onclick = () => {
        modeEl.value = 'basic';
        phaseEl.value = 'single';
        powerEl.value = '10';
        powerUnitEl.value = '1000';
        voltageEl.value = '230';
        freqEl.value = '50';
        apparentEl.value = '12';
        currPFEl.value = '0.75';
        targetPFEl.value = '0.95';
        handleModeChange();
    };

    $('pf-copy-btn').onclick = function() {
        let text = `AC Power Factor correction Specs\n`;
        text += `System Phase: ${phaseEl.options[phaseEl.selectedIndex].text}\n`;
        text += `Real Power (P): ${powerEl.value} kW\n`;
        text += `Voltage: ${voltageEl.value} V\n`;
        if (modeEl.value === 'basic') {
            text += `Apparent Power (S): ${apparentEl.value} kVA\n`;
            text += `Calculated Power Factor: ${$('out-value').textContent}\n`;
        } else {
            text += `Current PF: ${currPFEl.value} -> Target PF: ${targetPFEl.value}\n`;
            text += `Correction Capacitor: ${$('out-value').textContent} ${$('out-unit').textContent}\n`;
            text += `Capacitor kVAR rating: ${$('out-stat2').textContent}\n`;
        }
        text += `Calculated at ToolsHub Industrial`;
        
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; 
            this.innerHTML = '<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    };

    calculate();
});
</script>

<style>
.pf-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 8px 48px rgba(239,68,68,.04); }
.pf-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.pf-rebuilt .calculator-header h5 { margin: 0; font-weight: 900; color: #0f172a; font-size: 1.25rem; }
.pf-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; line-height: 1.5; }
.pf-rebuilt .tool-icon-circle { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
.pf-rebuilt .form-label-custom { font-size: .65rem; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: .4rem; display: block; }
.output-card-themed { background: var(--tool-bg); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.03); transition: all .4s ease; }
.output-hero { border-bottom: 1px solid rgba(0,0,0,.04); }
.output-hero-label { display: block; font-size: .7rem; letter-spacing: 2px; color: #64748b; }
.output-hero-value { font-size: 3rem; font-weight: 900; line-height: 1; letter-spacing: -2px; }
.output-hero-unit { font-size: 1.25rem; font-weight: 800; margin-left: 4px; }
.stat-card { transition: all .3s ease; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,.02); }
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\power-factor-calculator.blade.php ENDPATH**/ ?>