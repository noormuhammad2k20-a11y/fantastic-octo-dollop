<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

<div class="row g-4 divider-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body pt-3">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
                <div class="row g-3 mb-3">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">What do you want to solve?</label>
                        <select id="divider-mode" class="form-select form-select-sm rounded-3 shadow-none border-secondary-subtle">
                            <option value="vout" selected>Output Voltage (Vout)</option>
                            <option value="r1">Resistor 1 (R1)</option>
                            <option value="r2">Resistor 2 (R2)</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3">
                    
                    <div class="col-md-3" id="vin-container">
                        <label class="form-label-custom">Input Voltage ($V_{in}$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="div-vin" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="12" step="any" min="0.01">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold">V</span>
                        </div>
                    </div>

                    
                    <div class="col-md-3" id="vout-container" style="display: none;">
                        <label class="form-label-custom">Output Voltage ($V_{out}$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="div-vout" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="5" step="any" min="0.01">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold">V</span>
                        </div>
                    </div>

                    
                    <div class="col-md-3" id="r1-container">
                        <label class="form-label-custom">Resistor $R_1$</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="div-r1" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="10" step="any" min="0.1">
                            <select id="div-r1-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 80px;">
                                <option value="1">Ω</option>
                                <option value="1000" selected>kΩ</option>
                                <option value="1000000">MΩ</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-3" id="r2-container">
                        <label class="form-label-custom">Resistor $R_2$</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="div-r2" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="10" step="any" min="0.1">
                            <select id="div-r2-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 80px;">
                                <option value="1">Ω</option>
                                <option value="1000" selected>kΩ</option>
                                <option value="1000000">MΩ</option>
                            </select>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 divider-preset" data-vin="5" data-vout="3.3" data-r1="10" data-r2="20" data-mode="vout">⚡ 5V to 3.3V Logic Level</button>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 divider-preset" data-vin="12" data-vout="5" data-r1="10" data-r2="7.15" data-mode="vout">⚡ 12V to 5V Output</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-4" id="div-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:199;--tool-color:#0284c7;--tool-bg:rgba(2,132,199,.03);">
            <div class="output-hero py-3 text-center">
                <span class="output-hero-label text-uppercase small fw-bold tracking-wider" id="out-hero-label">Calculated Output Voltage</span>
                <div class="d-flex justify-content-center align-items-baseline gap-1 mt-1">
                    <span class="output-hero-value fw-black text-2xl" id="out-value" style="color:#0284c7;">6.00</span>
                    <span class="output-hero-unit text-muted small fw-bold" id="out-unit">V</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;color:#0284c7;">Calculated Successfully</div>
            </div>

            <div class="row g-2 mt-3">
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Divider Current</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-current">0.60 mA</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Power R1</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-pr1">3.60 mW</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Power R2</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-pr2">3.60 mW</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Total Power</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-ptotal">7.20 mW</span>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-calculator text-primary me-2"></i>Divider Equation
                </h6>
                <div id="latex-formula" class="my-3 overflow-x-auto text-center py-2" style="font-size: 1.1rem;"></div>
                <div id="latex-substitution" class="small text-secondary overflow-x-auto text-center border-top pt-2"></div>
            </div>

            
            <div class="mt-3 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-stethoscope text-primary me-2"></i>Divider Circuit Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            
            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-2 px-4 fw-bold rounded-pill shadow-sm" id="div-copy-btn" style="min-width: 250px;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Divider Specifications
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const modeEl = $('divider-mode'), vinEl = $('div-vin'), voutEl = $('div-vout'),
          r1El = $('div-r1'), r1UnitEl = $('div-r1-unit'),
          r2El = $('div-r2'), r2UnitEl = $('div-r2-unit'),
          latexF = $('latex-formula'), latexSub = $('latex-substitution');

    function renderMath() {
        if (typeof katex !== 'undefined') {
            const mode = modeEl.value;
            if (mode === 'vout') {
                katex.render("V_{out} = V_{in} \\times \\frac{R_2}{R_1 + R_2}", latexF, {throwOnError: false, displayMode: true});
            } else if (mode === 'r1') {
                katex.render("R_1 = R_2 \\times \\left( \\frac{V_{in}}{V_{out}} - 1 \\right)", latexF, {throwOnError: false, displayMode: true});
            } else {
                katex.render("R_2 = R_1 \\times \\frac{V_{out}}{V_{in} - V_{out}}", latexF, {throwOnError: false, displayMode: true});
            }
        } else {
            setTimeout(renderMath, 100);
        }
    }

    function formatRes(ohms) {
        if (ohms >= 1e6) return (ohms / 1e6).toFixed(2) + ' MΩ';
        if (ohms >= 1000) return (ohms / 1000).toFixed(2) + ' kΩ';
        return ohms.toFixed(1) + ' Ω';
    }

    function formatCurrent(amps) {
        if (amps < 1e-3) return (amps * 1e6).toFixed(1) + ' µA';
        if (amps < 1) return (amps * 1000).toFixed(2) + ' mA';
        return amps.toFixed(3) + ' A';
    }

    function formatPower(watts) {
        if (watts < 1e-3) return (watts * 1e6).toFixed(1) + ' µW';
        if (watts < 1) return (watts * 1000).toFixed(2) + ' mW';
        return watts.toFixed(3) + ' W';
    }

    function handleModeChange() {
        const mode = modeEl.value;
        if (mode === 'vout') {
            $('vout-container').style.display = 'none';
            $('r1-container').style.display = 'block';
            $('r2-container').style.display = 'block';
            $('out-hero-label').textContent = 'Calculated Output Voltage';
        } else if (mode === 'r1') {
            $('vout-container').style.display = 'block';
            $('r1-container').style.display = 'none';
            $('r2-container').style.display = 'block';
            $('out-hero-label').textContent = 'Calculated Resistor R1';
        } else {
            $('vout-container').style.display = 'block';
            $('r1-container').style.display = 'block';
            $('r2-container').style.display = 'none';
            $('out-hero-label').textContent = 'Calculated Resistor R2';
        }
        calculate();
    }

    function calculate() {
        const mode = modeEl.value;
        const vin = parseFloat(vinEl.value);
        const vout = parseFloat(voutEl.value);
        const r1Val = parseFloat(r1El.value) * parseFloat(r1UnitEl.value);
        const r2Val = parseFloat(r2El.value) * parseFloat(r2UnitEl.value);

        if (isNaN(vin) || vin <= 0) return;

        renderMath();

        let finalR1 = r1Val;
        let finalR2 = r2Val;
        let finalVout = vout;

        if (mode === 'vout') {
            if (isNaN(r1Val) || r1Val <= 0 || isNaN(r2Val) || r2Val <= 0) return;
            finalVout = vin * (r2Val / (r1Val + r2Val));
            
            $('out-value').textContent = finalVout.toFixed(2);
            $('out-unit').textContent = 'V';

            if (typeof katex !== 'undefined') {
                const subStr = `V_{out} = ${vin}V \\times \\frac{${formatRes(r2Val)}}{${formatRes(r1Val)} + ${formatRes(r2Val)}} = ${finalVout.toFixed(2)}V`;
                katex.render(subStr, latexSub, {throwOnError: false, displayMode: true});
            }
        } else if (mode === 'r1') {
            if (isNaN(vout) || vout <= 0 || isNaN(r2Val) || r2Val <= 0) return;
            if (vout >= vin) {
                $('out-value').textContent = '—';
                $('out-insights').innerHTML = '<div class="text-danger small fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>Vout must be strictly less than Vin.</div>';
                return;
            }
            finalR1 = r2Val * ((vin / vout) - 1);
            
            const r1Disp = formatRes(finalR1);
            $('out-value').textContent = r1Disp.split(' ')[0];
            $('out-unit').textContent = r1Disp.split(' ')[1];

            if (typeof katex !== 'undefined') {
                const subStr = `R_1 = ${formatRes(r2Val)} \\times \\left( \\frac{${vin}V}{${vout}V} - 1 \\right) = ${formatRes(finalR1)}`;
                katex.render(subStr, latexSub, {throwOnError: false, displayMode: true});
            }
        } else {
            if (isNaN(vout) || vout <= 0 || isNaN(r1Val) || r1Val <= 0) return;
            if (vout >= vin) {
                $('out-value').textContent = '—';
                $('out-insights').innerHTML = '<div class="text-danger small fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>Vout must be strictly less than Vin.</div>';
                return;
            }
            finalR2 = r1Val * (vout / (vin - vout));

            const r2Disp = formatRes(finalR2);
            $('out-value').textContent = r2Disp.split(' ')[0];
            $('out-unit').textContent = r2Disp.split(' ')[1];

            if (typeof katex !== 'undefined') {
                const subStr = `R_2 = ${formatRes(r1Val)} \\times \\frac{${vout}V}{${vin}V - ${vout}V} = ${formatRes(finalR2)}`;
                katex.render(subStr, latexSub, {throwOnError: false, displayMode: true});
            }
        }

        // Circuit Stats calculations
        const current = vin / (finalR1 + finalR2);
        const pr1 = current * current * finalR1;
        const pr2 = current * current * finalR2;
        const pTotal = vin * current;

        $('out-current').textContent = formatCurrent(current);
        $('out-pr1').textContent = formatPower(pr1);
        $('out-pr2').textContent = formatPower(pr2);
        $('out-ptotal').textContent = formatPower(pTotal);

        // Operational Insights
        let insights = [];
        if (current < 1e-4) {
            insights.push("Very high resistance divider: current draw is low, but the divider output will be highly sensitive to external load impedances.");
        } else if (current > 0.05) {
            insights.push(`High current divider (${formatCurrent(current)}): verify resistor power ratings to prevent overheating.`);
        } else {
            insights.push(`Healthy divider current of ${formatCurrent(current)}. Provides stable logic references for typical MCU inputs.`);
        }
        insights.push("Rule of Thumb: The loading current from your device connected to Vout should be <= 10% of this divider current to maintain voltage accuracy.");

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${insights.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-primary me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    modeEl.addEventListener('change', handleModeChange);
    [vinEl, voutEl, r1El, r1UnitEl, r2El, r2UnitEl].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.divider-preset').forEach(btn => {
        btn.onclick = () => {
            modeEl.value = btn.dataset.mode;
            vinEl.value = btn.dataset.vin;
            voutEl.value = btn.dataset.vout;
            r1El.value = btn.dataset.r1;
            r1UnitEl.value = '1000';
            r2El.value = btn.dataset.r2;
            r2UnitEl.value = '1000';
            handleModeChange();
        };
    });

    $('div-reset').onclick = () => {
        modeEl.value = 'vout';
        vinEl.value = '12';
        voutEl.value = '5';
        r1El.value = '10';
        r1UnitEl.value = '1000';
        r2El.value = '10';
        r2UnitEl.value = '1000';
        handleModeChange();
    };

    $('div-copy-btn').onclick = function() {
        let text = `Voltage Divider Specifications\n`;
        text += `Divider Mode: ${modeEl.options[modeEl.selectedIndex].text}\n`;
        text += `Input Voltage (Vin): ${vinEl.value} V\n`;
        if (modeEl.value !== 'vout') {
            text += `Target Output Voltage (Vout): ${voutEl.value} V\n`;
        }
        text += `R1: ${r1El.value} ${r1UnitEl.options[r1UnitEl.selectedIndex].text}\n`;
        text += `R2: ${r2El.value} ${r2UnitEl.options[r2UnitEl.selectedIndex].text}\n`;
        text += `Calculated Vout: ${$('out-value').textContent} ${$('out-unit').textContent}\n`;
        text += `Divider Current: ${$('out-current').textContent}\n`;
        text += `Total Divider Power: ${$('out-ptotal').textContent}\n`;
        text += `Calculated at ToolsHub Electronics`;
        
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; 
            this.innerHTML = '<i class="fas fa-check me-2"></i>Divider Specs Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    };

    calculate();
});
</script>

<style>
.divider-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 8px 48px rgba(2,132,199,.04); }
.divider-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.divider-rebuilt .calculator-header h5 { margin: 0; font-weight: 900; color: #0f172a; font-size: 1.25rem; }
.divider-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; line-height: 1.5; }
.divider-rebuilt .tool-icon-circle { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
.divider-rebuilt .form-label-custom { font-size: .65rem; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: .4rem; display: block; }
.output-card-themed { background: var(--tool-bg); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.03); transition: all .4s ease; }
.output-hero { border-bottom: 1px solid rgba(0,0,0,.04); }
.output-hero-label { display: block; font-size: .7rem; letter-spacing: 2px; color: #64748b; }
.output-hero-value { font-size: 3rem; font-weight: 900; line-height: 1; letter-spacing: -2px; }
.output-hero-unit { font-size: 1.25rem; font-weight: 800; margin-left: 4px; }
.stat-card { transition: all .3s ease; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,.02); }
</style>