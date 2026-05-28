<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

<div class="row g-4 transformer-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body pt-3">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
                <div class="row g-3">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Input Mode</label>
                        <select id="trans-mode" class="form-select form-select-sm rounded-3 shadow-none border-secondary-subtle">
                            <option value="voltage" selected>Voltage Winding Ratio</option>
                            <option value="turns">Number of Turns Ratio</option>
                            <option value="current">Winding Current Ratio</option>
                            <option value="impedance">Winding Impedance Ratio</option>
                        </select>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom" id="primary-label">Primary Voltage ($V_p$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="trans-p" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="120" step="any" min="0.0001">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold" id="primary-unit">V</span>
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom" id="secondary-label">Secondary Voltage ($V_s$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="trans-s" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="12" step="any" min="0.0001">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold" id="secondary-unit">V</span>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 trans-preset" data-mode="voltage" data-p="120" data-s="12">⚡ Step-Down (120V to 12V)</button>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 trans-preset" data-mode="voltage" data-p="12" data-s="120">⚡ Step-Up (12V to 120V)</button>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 trans-preset" data-mode="impedance" data-p="800" data-s="8">⚡ Audio Winding (800Ω to 8Ω)</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-4" id="trans-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="trans-theme" style="--tool-hue:188;--tool-color:#0891b2;--tool-bg:rgba(8,145,178,.03);">
            <div class="output-hero py-3 text-center">
                <span class="output-hero-label text-uppercase small fw-bold tracking-wider">Calculated Turns Ratio (a)</span>
                <div class="d-flex justify-content-center align-items-baseline gap-1 mt-1">
                    <span class="output-hero-value fw-black text-2xl" id="out-value" style="color:#0891b2;">10.000</span>
                    <span class="output-hero-unit text-muted small fw-bold" id="out-unit">: 1</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" style="letter-spacing:1px;color:#0891b2;">
                    <span id="out-class">Step-Down</span> Transformer (<span id="out-status">Step-Down Winding</span>)
                </div>
            </div>

            <div class="row g-2 mt-3">
                <div class="col-4">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Voltage Winding Ratio ($V_p : V_s$)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-volt-ratio">10.000</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Current Winding Ratio ($I_s : I_p$)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-curr-ratio">0.1000</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Impedance Winding Ratio ($Z_p : Z_s$)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-imp-ratio">100.00</span>
                    </div>
                </div>
            </div>

            
            

            
            <div class="mt-3 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-stethoscope text-danger me-2"></i>Winding Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            
            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-2 px-4 fw-bold rounded-pill shadow-sm" id="trans-copy-btn" style="min-width: 250px;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Transformer Specs
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const modeEl = $('trans-mode'), pEl = $('trans-p'), sEl = $('trans-s'),
          pLabel = $('primary-label'), sLabel = $('secondary-label'),
          pUnit = $('primary-unit'), sUnit = $('secondary-unit'),
          latexF = $('latex-formula'), latexSub = $('latex-substitution');

    function renderMath() {
        if (typeof katex !== 'undefined') {
            katex.render("a = \\frac{N_p}{N_s} = \\frac{V_p}{V_s} = \\frac{I_s}{I_p} = \\sqrt{\\frac{Z_p}{Z_s}}", latexF, {throwOnError: false, displayMode: true});
        } else {
            setTimeout(renderMath, 100);
        }
    }

    function handleModeChange() {
        const mode = modeEl.value;
        if (mode === 'voltage') {
            pLabel.innerHTML = 'Primary Voltage ($V_p$)';
            sLabel.innerHTML = 'Secondary Voltage ($V_s$)';
            pUnit.textContent = 'V';
            sUnit.textContent = 'V';
            pEl.value = '120';
            sEl.value = '12';
        } else if (mode === 'turns') {
            pLabel.innerHTML = 'Primary Turns ($N_p$)';
            sLabel.innerHTML = 'Secondary Turns ($N_s$)';
            pUnit.textContent = 'turns';
            sUnit.textContent = 'turns';
            pEl.value = '500';
            sEl.value = '50';
        } else if (mode === 'current') {
            pLabel.innerHTML = 'Primary Current ($I_p$)';
            sLabel.innerHTML = 'Secondary Current ($I_s$)';
            pUnit.textContent = 'A';
            sUnit.textContent = 'A';
            pEl.value = '0.5';
            sEl.value = '5.0';
        } else {
            pLabel.innerHTML = 'Primary Impedance ($Z_p$)';
            sLabel.innerHTML = 'Secondary Impedance ($Z_s$)';
            pUnit.textContent = 'Ω';
            sUnit.textContent = 'Ω';
            pEl.value = '800';
            sEl.value = '8';
        }
        calculate();
    }

    function calculate() {
        const mode = modeEl.value;
        const pVal = parseFloat(pEl.value);
        const sVal = parseFloat(sEl.value);

        if (isNaN(pVal) || pVal <= 0 || isNaN(sVal) || sVal <= 0) {
            return;
        }

        renderMath();

        let a = 0; // Turns ratio
        let latexEq = '';

        if (mode === 'voltage') {
            a = pVal / sVal;
            latexEq = `a = \\frac{${pVal}V}{${sVal}V} = ${a.toFixed(3)}`;
        } else if (mode === 'turns') {
            a = pVal / sVal;
            latexEq = `a = \\frac{${pVal}}{${sVal}} = ${a.toFixed(3)}`;
        } else if (mode === 'current') {
            a = sVal / pVal;
            latexEq = `a = \\frac{${sVal}A}{${pVal}A} = ${a.toFixed(3)}`;
        } else {
            a = Math.sqrt(pVal / sVal);
            latexEq = `a = \\sqrt{\\frac{${pVal}\\Omega}{${sVal}\\Omega}} = ${a.toFixed(3)}`;
        }

        // Volt ratio, current ratio, impedance ratio
        const voltRatio = a;
        const currRatio = 1 / a;
        const impRatio = a * a;

        $('out-value').textContent = a.toFixed(a >= 10 ? 1 : 3);
        $('out-unit').textContent = ': 1';

        $('out-volt-ratio').textContent = voltRatio.toFixed(3);
        $('out-curr-ratio').textContent = currRatio.toFixed(4);
        $('out-imp-ratio').textContent = impRatio.toFixed(2);

        let transClass = 'Step-Down';
        let note = 'Step-Down Winding';
        if (a < 0.999) {
            transClass = 'Step-Up';
            note = 'Step-Up Winding';
        } else if (Math.abs(a - 1) < 0.001) {
            transClass = 'Isolation';
            note = 'Isolation 1:1 Winding';
        }

        $('out-class').textContent = transClass;
        $('out-status').textContent = note;

        if (typeof katex !== 'undefined') {
            katex.render(latexEq, latexSub, {throwOnError: false, displayMode: true});
        }

        // Insights
        let insights = [];
        if (transClass === 'Step-Down') {
            insights.push("Step-down transformer reduces voltage while raising available secondary load current by the reciprocal of the turns ratio.");
        } else if (transClass === 'Step-Up') {
            insights.push("Step-up transformer boosts voltage at the secondary while reducing secondary output load currents.");
        } else {
            insights.push("1:1 Isolation transformer provides electrical galvanic barrier to block high voltage transients and ground loop currents. Useful for medical and test equipment.");
        }
        if (mode === 'impedance') {
            insights.push(`Impedance ratio of ${impRatio.toFixed(1)} means the primary matches inputs at higher signal frequencies safely.`);
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${insights.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-info me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    modeEl.addEventListener('change', handleModeChange);
    [pEl, sEl].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.trans-preset').forEach(btn => {
        btn.onclick = () => {
            modeEl.value = btn.dataset.mode;
            handleModeChange();
            pEl.value = btn.dataset.p;
            sEl.value = btn.dataset.s;
            calculate();
        };
    });

    $('trans-reset').onclick = () => {
        modeEl.value = 'voltage';
        handleModeChange();
    };

    $('trans-copy-btn').onclick = function() {
        let text = `Transformer turns ratio Specs\n`;
        text += `Input Mode: ${modeEl.options[modeEl.selectedIndex].text}\n`;
        text += `Primary: ${pEl.value} ${pUnit.textContent}\n`;
        text += `Secondary: ${sEl.value} ${sUnit.textContent}\n`;
        text += `Turns Winding Ratio: ${$('out-value').textContent} ${$('out-unit').textContent}\n`;
        text += `Voltage Ratio: ${$('out-volt-ratio').textContent}\n`;
        text += `Current Ratio: ${$('out-curr-ratio').textContent}\n`;
        text += `Impedance Winding Ratio: ${$('out-imp-ratio').textContent}\n`;
        text += `Classification: ${$('out-class').textContent}\n`;
        text += `Calculated at ToolsHub Electronics`;
        
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; 
            this.innerHTML = '<i class="fas fa-check me-2"></i>Parameters Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    };

    calculate();
});
</script>

<style>
.transformer-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 8px 48px rgba(8,145,178,.04); }
.transformer-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.transformer-rebuilt .calculator-header h5 { margin: 0; font-weight: 900; color: #0f172a; font-size: 1.25rem; }
.transformer-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; line-height: 1.5; }
.transformer-rebuilt .tool-icon-circle { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
.transformer-rebuilt .form-label-custom { font-size: .65rem; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: .4rem; display: block; }
.output-card-themed { background: var(--tool-bg); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.03); transition: all .4s ease; }
.output-hero { border-bottom: 1px solid rgba(0,0,0,.04); }
.output-hero-label { display: block; font-size: .7rem; letter-spacing: 2px; color: #64748b; }
.output-hero-value { font-size: 3rem; font-weight: 900; line-height: 1; letter-spacing: -2px; }
.output-hero-unit { font-size: 1.25rem; font-weight: 800; margin-left: 4px; }
.stat-card { transition: all .3s ease; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,.02); }
</style>
