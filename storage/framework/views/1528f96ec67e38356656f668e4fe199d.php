<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

<div class="row g-4 db-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body pt-3">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
                <div class="row g-3 mb-3">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Calculation Mode</label>
                        <select id="db-mode" class="form-select form-select-sm rounded-3 shadow-none border-secondary-subtle">
                            <option value="gain" selected>Calculate dB Gain/Loss from Values</option>
                            <option value="value">Calculate Measured Value from dB & Reference</option>
                        </select>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Signal Type</label>
                        <select id="db-type" class="form-select form-select-sm rounded-3 shadow-none border-secondary-subtle">
                            <option value="power" selected>Power (Watts, dBm)</option>
                            <option value="voltage">Voltage / Current (Volts, dBV)</option>
                        </select>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Standard Reference Preset</label>
                        <select id="db-ref-preset" class="form-select form-select-sm rounded-3 shadow-none border-secondary-subtle">
                            <option value="custom" selected>Custom Reference Value</option>
                            <option value="dbm">dBm (Ref: 1 mW / 0.001 W)</option>
                            <option value="dbw">dBW (Ref: 1 W)</option>
                            <option value="dbv">dBV (Ref: 1 V)</option>
                            <option value="dbuv">dBµV (Ref: 1 µV / 1e-6 V)</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3">
                    
                    <div class="col-md-4" id="ref-val-container">
                        <label class="form-label-custom" id="ref-label">Reference Value ($P_{ref}$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="db-ref-val" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="1" step="any" min="1e-12">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold" id="ref-unit">W</span>
                        </div>
                    </div>

                    
                    <div class="col-md-4" id="meas-val-container">
                        <label class="form-label-custom" id="meas-label">Measured Value ($P_{meas}$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="db-meas-val" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="2" step="any" min="1e-12">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold" id="meas-unit">W</span>
                        </div>
                    </div>

                    
                    <div class="col-md-4" id="gain-input-container" style="display: none;">
                        <label class="form-label-custom">Gain / Loss (dB)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="db-gain-val" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="3" step="any">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold">dB</span>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 db-preset" data-mode="gain" data-type="power" data-ref="0.001" data-meas="1" data-preset="dbm">⚡ 1 Watt in dBm (30 dBm)</button>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 db-preset" data-mode="value" data-type="power" data-ref="0.001" data-gain="3" data-preset="dbm">⚡ +3dB Power Increase</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-4" id="db-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:318;--tool-color:#db2777;--tool-bg:rgba(219,39,119,.03);">
            <div class="output-hero py-3 text-center">
                <span class="output-hero-label text-uppercase small fw-bold tracking-wider" id="out-hero-label">Calculated Decibel Level</span>
                <div class="d-flex justify-content-center align-items-baseline gap-1 mt-1">
                    <span class="output-hero-value fw-black text-2xl" id="out-value" style="color:#db2777;">3.01</span>
                    <span class="output-hero-unit text-muted small fw-bold" id="out-unit">dB</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;color:#db2777;">Power Gain / Boost</div>
            </div>

            <div class="row g-2 mt-3">
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Linear Winding Ratio</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-linear-ratio">2.000</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Signal Classification</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-class">Amplification</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Power Equivalent</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-p-equiv">2.00x Power</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Voltage Equivalent</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-v-equiv">1.41x Voltage</span>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-calculator text-danger me-2"></i>Decibel Equation
                </h6>
                <div id="latex-formula" class="my-3 overflow-x-auto text-center py-2" style="font-size: 1.1rem;"></div>
                <div id="latex-substitution" class="small text-secondary overflow-x-auto text-center border-top pt-2"></div>
            </div>

            
            <div class="mt-3 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-stethoscope text-danger me-2"></i>Logarithmic Ratio Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            
            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-2 px-4 fw-bold rounded-pill shadow-sm" id="db-copy-btn" style="min-width: 250px;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Decibel Specifications
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const modeEl = $('db-mode'), typeEl = $('db-type'), presetEl = $('db-ref-preset'),
          refEl = $('db-ref-val'), measEl = $('db-meas-val'), gainEl = $('db-gain-val'),
          refLabel = $('ref-label'), measLabel = $('meas-label'),
          refUnit = $('ref-unit'), measUnit = $('meas-unit'),
          latexF = $('latex-formula'), latexSub = $('latex-substitution');

    function renderMath() {
        if (typeof katex !== 'undefined') {
            const mode = modeEl.value;
            const type = typeEl.value;
            if (mode === 'gain') {
                if (type === 'power') {
                    katex.render("dB = 10 \\log_{10}\\left(\\frac{P_{\\text{meas}}}{P_{\\text{ref}}}\\right)", latexF, {throwOnError: false, displayMode: true});
                } else {
                    katex.render("dB = 20 \\log_{10}\\left(\\frac{V_{\\text{meas}}}{V_{\\text{ref}}}\\right)", latexF, {throwOnError: false, displayMode: true});
                }
            } else {
                if (type === 'power') {
                    katex.render("P_{\\text{meas}} = P_{\\text{ref}} \\times 10^{\\frac{dB}{10}}", latexF, {throwOnError: false, displayMode: true});
                } else {
                    katex.render("V_{\\text{meas}} = V_{\\text{ref}} \\times 10^{\\frac{dB}{20}}", latexF, {throwOnError: false, displayMode: true});
                }
            }
        } else {
            setTimeout(renderMath, 100);
        }
    }

    function handlePresetChange() {
        const preset = presetEl.value;
        if (preset === 'custom') {
            refEl.disabled = false;
            return;
        }

        refEl.disabled = true;
        if (preset === 'dbm') {
            typeEl.value = 'power';
            refEl.value = '0.001';
        } else if (preset === 'dbw') {
            typeEl.value = 'power';
            refEl.value = '1';
        } else if (preset === 'dbv') {
            typeEl.value = 'voltage';
            refEl.value = '1';
        } else if (preset === 'dbuv') {
            typeEl.value = 'voltage';
            refEl.value = '1e-6';
        }
        handleTypeChange();
    }

    function handleTypeChange() {
        const type = typeEl.value;
        const u = type === 'power' ? 'W' : 'V';
        refUnit.textContent = u;
        measUnit.textContent = u;
        
        if (type === 'power') {
            refLabel.innerHTML = 'Reference Power ($P_{ref}$)';
            measLabel.innerHTML = 'Measured Power ($P_{meas}$)';
        } else {
            refLabel.innerHTML = 'Reference Voltage ($V_{ref}$)';
            measLabel.innerHTML = 'Measured Voltage ($V_{meas}$)';
        }
        calculate();
    }

    function handleModeChange() {
        const mode = modeEl.value;
        if (mode === 'gain') {
            $('meas-val-container').style.display = 'block';
            $('gain-input-container').style.display = 'none';
            $('out-hero-label').textContent = 'Calculated Decibel Level';
        } else {
            $('meas-val-container').style.display = 'none';
            $('gain-input-container').style.display = 'block';
            $('out-hero-label').textContent = 'Calculated Measured Value';
        }
        calculate();
    }

    function calculate() {
        const mode = modeEl.value;
        const type = typeEl.value;
        const ref = parseFloat(refEl.value);
        const meas = parseFloat(measEl.value);
        const gain = parseFloat(gainEl.value);

        if (isNaN(ref) || ref <= 0) return;

        renderMath();

        let finalDb = 0;
        let finalMeas = 0;
        let linearRatio = 0;
        let subStr = '';

        const u = type === 'power' ? 'W' : 'V';

        if (mode === 'gain') {
            if (isNaN(meas) || meas <= 0) return;
            linearRatio = meas / ref;
            if (type === 'power') {
                finalDb = 10 * Math.log10(linearRatio);
                subStr = `dB = 10 \\log_{10}\\left(\\frac{${meas}${u}}{${ref}${u}}\\right) = ${finalDb.toFixed(2)}\\text{ dB}`;
            } else {
                finalDb = 20 * Math.log10(linearRatio);
                subStr = `dB = 20 \\log_{10}\\left(\\frac{${meas}${u}}{${ref}${u}}\\right) = ${finalDb.toFixed(2)}\\text{ dB}`;
            }

            // Update UI
            $('out-value').textContent = finalDb.toFixed(2);
            $('out-unit').textContent = presetEl.value !== 'custom' ? `dB${presetEl.value.replace('db', '')}` : 'dB';
        } else {
            if (isNaN(gain)) return;
            if (type === 'power') {
                finalMeas = ref * Math.pow(10, gain / 10);
                linearRatio = finalMeas / ref;
                subStr = `P_{\\text{meas}} = ${ref}${u} \\times 10^{\\frac{${gain}}{10}} = ${finalMeas.toFixed(6)}${u}`;
            } else {
                finalMeas = ref * Math.pow(10, gain / 20);
                linearRatio = finalMeas / ref;
                subStr = `V_{\\text{meas}} = ${ref}${u} \\times 10^{\\frac{${gain}}{20}} = ${finalMeas.toFixed(6)}${u}`;
            }

            // Update UI
            let dispVal = finalMeas;
            let dispUnit = u;
            if (finalMeas < 1e-3) {
                dispVal = finalMeas * 1e6;
                dispUnit = 'µ' + u;
            } else if (finalMeas < 1) {
                dispVal = finalMeas * 1000;
                dispUnit = 'm' + u;
            }

            $('out-value').textContent = dispVal.toFixed(dispVal >= 10 ? 2 : 4);
            $('out-unit').textContent = dispUnit;
        }

        $('out-linear-ratio').textContent = linearRatio.toFixed(3);

        const isGain = linearRatio >= 1;
        $('out-class').textContent = isGain ? 'Amplification' : 'Attenuation';
        $('out-status').textContent = isGain ? 'Signal Gain / Boost' : 'Signal Loss / Drop';

        // Power vs voltage multiplier equivalents
        const pEquiv = type === 'power' ? linearRatio : linearRatio * linearRatio;
        const vEquiv = type === 'voltage' ? linearRatio : Math.sqrt(linearRatio);

        $('out-p-equiv').textContent = `${pEquiv.toFixed(2)}x Power`;
        $('out-v-equiv').textContent = `${vEquiv.toFixed(2)}x Voltage`;

        if (typeof katex !== 'undefined') {
            katex.render(subStr, latexSub, {throwOnError: false, displayMode: true});
        }

        // Insights
        let insights = [];
        if (isGain) {
            insights.push(`Signal is boosted linearly by a factor of **${linearRatio.toFixed(2)}x**.`);
        } else {
            insights.push(`Signal is attenuated. Passive transmission lines and cable losses exhibit attenuation like this.`);
        }
        if (type === 'power' && Math.abs(finalDb - 3) < 0.15) {
            insights.push("Rule of Thumb: A 3 dB change in power represents a near-perfect doubling (gain) or halving (attenuation) of the raw energy.");
        } else if (type === 'voltage' && Math.abs(finalDb - 6) < 0.15) {
            insights.push("Rule of Thumb: A 6 dB change in voltage/current amplitude represents a near-perfect doubling or halving of the waveform amplitude.");
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${insights.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-pink me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    modeEl.addEventListener('change', handleModeChange);
    typeEl.addEventListener('change', handleTypeChange);
    presetEl.addEventListener('change', handlePresetChange);
    [refEl, measEl, gainEl].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.db-preset').forEach(btn => {
        btn.onclick = () => {
            modeEl.value = btn.dataset.mode;
            typeEl.value = btn.dataset.type;
            presetEl.value = btn.dataset.preset || 'custom';
            handlePresetChange();
            handleModeChange();
            refEl.value = btn.dataset.ref;
            if (btn.dataset.meas) measEl.value = btn.dataset.meas;
            if (btn.dataset.gain) gainEl.value = btn.dataset.gain;
            calculate();
        };
    });

    $('db-reset').onclick = () => {
        modeEl.value = 'gain';
        typeEl.value = 'power';
        presetEl.value = 'custom';
        refEl.disabled = false;
        refEl.value = '1';
        measEl.value = '2';
        gainEl.value = '3';
        handleTypeChange();
        handleModeChange();
    };

    $('db-copy-btn').onclick = function() {
        let text = `Decibel Ratio & Gain Specifications\n`;
        text += `Signal Type: ${typeEl.options[typeEl.selectedIndex].text}\n`;
        text += `Reference Level: ${refEl.value} ${refUnit.textContent}\n`;
        if (modeEl.value === 'gain') {
            text += `Measured Level: ${measEl.value} ${measUnit.textContent}\n`;
            text += `Calculated Gain: ${$('out-value').textContent} ${$('out-unit').textContent}\n`;
        } else {
            text += `Applied Gain: ${gainEl.value} dB\n`;
            text += `Calculated Level: ${$('out-value').textContent} ${$('out-unit').textContent}\n`;
        }
        text += `Linear Power Multiplier: ${$('out-p-equiv').textContent}\n`;
        text += `Calculated at ToolsHub Decibel`;
        
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
.db-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 8px 48px rgba(219,39,119,.04); }
.db-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.db-rebuilt .calculator-header h5 { margin: 0; font-weight: 900; color: #0f172a; font-size: 1.25rem; }
.db-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; line-height: 1.5; }
.db-rebuilt .tool-icon-circle { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
.db-rebuilt .form-label-custom { font-size: .65rem; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: .4rem; display: block; }
.output-card-themed { background: var(--tool-bg); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.03); transition: all .4s ease; }
.output-hero { border-bottom: 1px solid rgba(0,0,0,.04); }
.output-hero-label { display: block; font-size: .7rem; letter-spacing: 2px; color: #64748b; }
.output-hero-value { font-size: 3rem; font-weight: 900; line-height: 1; letter-spacing: -2px; }
.output-hero-unit { font-size: 1.25rem; font-weight: 800; margin-left: 4px; }
.stat-card { transition: all .3s ease; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,.02); }
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\decibel-calculator.blade.php ENDPATH**/ ?>