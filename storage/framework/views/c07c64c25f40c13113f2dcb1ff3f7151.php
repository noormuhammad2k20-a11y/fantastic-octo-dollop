<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

<div class="row g-4 ohms-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body pt-3">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
                <div class="row g-3">
                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Voltage ($V$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="ohm-v" class="form-control rounded-start-3 shadow-none border-secondary-subtle ohm-input" step="any" placeholder="Enter voltage">
                            <select id="ohm-v-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 80px;">
                                <option value="0.001">mV</option>
                                <option value="1" selected>V</option>
                                <option value="1000">kV</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Current ($I$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="ohm-i" class="form-control rounded-start-3 shadow-none border-secondary-subtle ohm-input" step="any" placeholder="Enter current">
                            <select id="ohm-i-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 80px;">
                                <option value="1e-6">µA</option>
                                <option value="1e-3">mA</option>
                                <option value="1" selected>A</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Resistance ($R$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="ohm-r" class="form-control rounded-start-3 shadow-none border-secondary-subtle ohm-input" step="any" placeholder="Enter resistance">
                            <select id="ohm-r-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 80px;">
                                <option value="1" selected>Ω</option>
                                <option value="1000">kΩ</option>
                                <option value="1000000">MΩ</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Power ($P$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="ohm-p" class="form-control rounded-start-3 shadow-none border-secondary-subtle ohm-input" step="any" placeholder="Enter power">
                            <select id="ohm-p-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 80px;">
                                <option value="1e-3">mW</option>
                                <option value="1" selected>W</option>
                                <option value="1000">kW</option>
                            </select>
                        </div>
                    </div>
                </div>

                
                <div class="mt-3 small text-secondary d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark border" id="inputs-status">Waiting for 2 values...</span>
                    <span class="small text-muted" id="last-edited-info"></span>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 ohm-preset" data-v="12" data-r="2.6" data-mode="vr">🚗 Car Bulb (12V, 2.6Ω)</button>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 ohm-preset" data-v="5" data-i="2.1" data-mode="vi">📱 USB Charger (5V, 2.1A)</button>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 ohm-preset" data-v="230" data-p="2200" data-mode="vp">🏠 Water Heater (230V, 2.2kW)</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-4" id="ohm-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:12;--tool-color:#ea580c;--tool-bg:rgba(234,88,12,.03);">
            <div class="output-hero py-3 text-center">
                <span class="output-hero-label text-uppercase small fw-bold tracking-wider" id="out-hero-label">Ohm's Law Solver Results</span>
                <div class="d-flex justify-content-center align-items-baseline gap-1 mt-1">
                    <span class="output-hero-value fw-black text-2xl" id="out-value" style="color:#ea580c;">—</span>
                    <span class="output-hero-unit text-muted small fw-bold" id="out-unit"></span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;color:#ea580c;">Ohmic Balance</div>
            </div>

            <div class="row g-2 mt-3">
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center" id="card-v">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Voltage ($V$)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-v">—</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center" id="card-i">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Current ($I$)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-i">—</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center" id="card-r">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Resistance ($R$)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-r">—</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center" id="card-p">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Power ($P$)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-p">—</span>
                    </div>
                </div>
            </div>

            
            

            
            <div class="mt-3 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-stethoscope text-danger me-2"></i>Electrical System Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            
            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-2 px-4 fw-bold rounded-pill shadow-sm" id="ohm-copy-btn" style="min-width: 250px;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Ohmic Specs
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const vEl = $('ohm-v'), vUnitEl = $('ohm-v-unit'),
          iEl = $('ohm-i'), iUnitEl = $('ohm-i-unit'),
          rEl = $('ohm-r'), rUnitEl = $('ohm-r-unit'),
          pEl = $('ohm-p'), pUnitEl = $('ohm-p-unit'),
          inputsStatus = $('inputs-status'), lastEditedInfo = $('last-edited-info'),
          latexF = $('latex-formula'), latexSub = $('latex-substitution');

    let history = []; // Keep track of the order of edited inputs

    function trackEdit(el) {
        const id = el.id;
        history = history.filter(item => item !== id);
        if (el.value.trim() !== '') {
            history.push(id);
        }
        if (history.length > 2) {
            history.shift(); // Keep only the 2 most recently edited variables
        }
        updateInputColors();
        calculate();
    }

    function updateInputColors() {
        const inputs = [vEl, iEl, rEl, pEl];
        inputs.forEach(el => {
            el.style.backgroundColor = '';
            el.readOnly = false;
        });

        if (history.length === 2) {
            inputs.forEach(el => {
                if (!history.includes(el.id)) {
                    el.style.backgroundColor = 'rgba(234,88,12,0.04)';
                    el.placeholder = 'Auto-calculated';
                } else {
                    el.style.backgroundColor = '#ffffff';
                }
            });
            inputsStatus.className = "badge bg-success text-white border-0";
            inputsStatus.textContent = "Calculated!";
        } else {
            inputsStatus.className = "badge bg-light text-dark border";
            inputsStatus.textContent = `Waiting for ${2 - history.length} more value(s)...`;
        }
    }

    function formatVal(val, type) {
        if (type === 'v') {
            if (val >= 1000) return (val / 1000).toFixed(2) + ' kV';
            if (val < 1) return (val * 1000).toFixed(1) + ' mV';
            return val.toFixed(2) + ' V';
        }
        if (type === 'i') {
            if (val < 1e-3) return (val * 1e6).toFixed(1) + ' µA';
            if (val < 1) return (val * 1000).toFixed(1) + ' mA';
            return val.toFixed(3) + ' A';
        }
        if (type === 'r') {
            if (val >= 1e6) return (val / 1e6).toFixed(2) + ' MΩ';
            if (val >= 1000) return (val / 1000).toFixed(2) + ' kΩ';
            return val.toFixed(1) + ' Ω';
        }
        if (type === 'p') {
            if (val >= 1000) return (val / 1000).toFixed(2) + ' kW';
            if (val < 1) return (val * 1000).toFixed(1) + ' mW';
            return val.toFixed(2) + ' W';
        }
        return val.toFixed(2);
    }

    function renderMath() {
        if (typeof katex !== 'undefined') {
            katex.render("V = I \\times R, \\quad P = V \\times I = I^2 \\times R = \\frac{V^2}{R}", latexF, {throwOnError: false, displayMode: true});
        } else {
            setTimeout(renderMath, 100);
        }
    }

    function calculate() {
        if (history.length < 2) {
            $('out-value').textContent = '—';
            $('out-unit').textContent = '';
            $('out-v').textContent = '—';
            $('out-i').textContent = '—';
            $('out-r').textContent = '—';
            $('out-p').textContent = '—';
            return;
        }

        renderMath();

        let v = parseFloat(vEl.value) * parseFloat(vUnitEl.value);
        let i = parseFloat(iEl.value) * parseFloat(iUnitEl.value);
        let r = parseFloat(rEl.value) * parseFloat(rUnitEl.value);
        let p = parseFloat(pEl.value) * parseFloat(pUnitEl.value);

        // Find which two are inputs based on history
        const keys = history;
        let subStr = '';

        if (keys.includes('ohm-v') && keys.includes('ohm-i')) {
            r = v / i;
            p = v * i;
            subStr = `R = \\frac{V}{I} = \\frac{${vEl.value}V}{${iEl.value}A} = ${formatVal(r, 'r')}, \\quad P = V \\times I = ${vEl.value}V \\times ${iEl.value}A = ${formatVal(p, 'p')}`;
        } else if (keys.includes('ohm-v') && keys.includes('ohm-r')) {
            i = v / r;
            p = (v * v) / r;
            subStr = `I = \\frac{V}{R} = \\frac{${vEl.value}V}{${rEl.value}\\Omega} = ${formatVal(i, 'i')}, \\quad P = \\frac{V^2}{R} = \\frac{${vEl.value}^2}{${rEl.value}\\Omega} = ${formatVal(p, 'p')}`;
        } else if (keys.includes('ohm-v') && keys.includes('ohm-p')) {
            i = p / v;
            r = (v * v) / p;
            subStr = `I = \\frac{P}{V} = \\frac{${pEl.value}W}{${vEl.value}V} = ${formatVal(i, 'i')}, \\quad R = \\frac{V^2}{P} = \\frac{${vEl.value}^2}{${pEl.value}W} = ${formatVal(r, 'r')}`;
        } else if (keys.includes('ohm-i') && keys.includes('ohm-r')) {
            v = i * r;
            p = i * i * r;
            subStr = `V = I \\times R = ${iEl.value}A \\times ${rEl.value}\\Omega = ${formatVal(v, 'v')}, \\quad P = I^2 \\times R = ${iEl.value}^2 \\times ${rEl.value}\\Omega = ${formatVal(p, 'p')}`;
        } else if (keys.includes('ohm-i') && keys.includes('ohm-p')) {
            v = p / i;
            r = p / (i * i);
            subStr = `V = \\frac{P}{I} = \\frac{${pEl.value}W}{${iEl.value}A} = ${formatVal(v, 'v')}, \\quad R = \\frac{P}{I^2} = \\frac{${pEl.value}W}{${iEl.value}^2} = ${formatVal(r, 'r')}`;
        } else if (keys.includes('ohm-r') && keys.includes('ohm-p')) {
            v = Math.sqrt(p * r);
            i = Math.sqrt(p / r);
            subStr = `V = \\sqrt{P \\times R} = \\sqrt{${pEl.value}W \\times ${rEl.value}\\Omega} = ${formatVal(v, 'v')}, \\quad I = \\sqrt{\\frac{P}{R}} = \\sqrt{\\frac{${pEl.value}W}{${rEl.value}\\Omega}} = ${formatVal(i, 'i')}`;
        }

        if (isNaN(v) || isNaN(i) || isNaN(r) || isNaN(p) || r <= 0 || i <= 0 || v <= 0 || p <= 0) {
            return;
        }

        // Output hero defaults to Power Results
        $('out-value').textContent = p.toFixed(p >= 10 ? 1 : 2);
        $('out-unit').textContent = 'W';

        $('out-v').textContent = formatVal(v, 'v');
        $('out-i').textContent = formatVal(i, 'i');
        $('out-r').textContent = formatVal(r, 'r');
        $('out-p').textContent = formatVal(p, 'p');

        // Set placeholders for non-edited
        if (!keys.includes('ohm-v')) vEl.value = (v / parseFloat(vUnitEl.value)).toFixed(4);
        if (!keys.includes('ohm-i')) iEl.value = (i / parseFloat(iUnitEl.value)).toFixed(4);
        if (!keys.includes('ohm-r')) rEl.value = (r / parseFloat(rUnitEl.value)).toFixed(4);
        if (!keys.includes('ohm-p')) pEl.value = (p / parseFloat(pUnitEl.value)).toFixed(4);

        if (typeof katex !== 'undefined') {
            katex.render(subStr, latexSub, {throwOnError: false, displayMode: true});
        }

        // Insights
        let insights = [];
        insights.push(`Total Power Dissipated: **${formatVal(p, 'p')}**. Ensure the selected resistor power rating is at least double this value for continuous operation.`);
        if (i > 10) {
            insights.push("Warning: Current exceeds 10 Amps. High gauge copper wiring must be used to minimize temperature rises.");
        }
        insights.push(`Calculated Resistance: **${formatVal(r, 'r')}**.`);

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${insights.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-warning me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [vEl, iEl, rEl, pEl].forEach(el => {
        el.addEventListener('input', () => trackEdit(el));
    });

    document.querySelectorAll('.ohm-preset').forEach(btn => {
        btn.onclick = () => {
            ohmReset();
            const mode = btn.dataset.mode;
            if (mode === 'vr') {
                vEl.value = btn.dataset.v;
                vUnitEl.value = '1';
                rEl.value = btn.dataset.r;
                rUnitEl.value = '1';
                history = ['ohm-v', 'ohm-r'];
            } else if (mode === 'vi') {
                vEl.value = btn.dataset.v;
                vUnitEl.value = '1';
                iEl.value = btn.dataset.i;
                iUnitEl.value = '1';
                history = ['ohm-v', 'ohm-i'];
            } else if (mode === 'vp') {
                vEl.value = btn.dataset.v;
                vUnitEl.value = '1';
                pEl.value = btn.dataset.p;
                pUnitEl.value = '1';
                history = ['ohm-v', 'ohm-p'];
            }
            updateInputColors();
            calculate();
        };
    });

    function ohmReset() {
        vEl.value = '';
        vUnitEl.value = '1';
        iEl.value = '';
        iUnitEl.value = '1';
        rEl.value = '';
        rUnitEl.value = '1';
        pEl.value = '';
        pUnitEl.value = '1';
        history = [];
        updateInputColors();
        calculate();
    }

    $('ohm-reset').onclick = ohmReset;

    $('ohm-copy-btn').onclick = function() {
        let text = `Ohm's Law Circuit Report\n`;
        text += `Voltage (V): ${$('out-v').textContent}\n`;
        text += `Current (I): ${$('out-i').textContent}\n`;
        text += `Resistance (R): ${$('out-r').textContent}\n`;
        text += `Power (P): ${$('out-p').textContent}\n`;
        text += `Calculated at ToolsHub Electronics`;
        
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; 
            this.innerHTML = '<i class="fas fa-check me-2"></i>Ohmic Data Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    };

    calculate();
});
</script>

<style>
.ohms-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 8px 48px rgba(234,88,12,.04); }
.ohms-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.ohms-rebuilt .calculator-header h5 { margin: 0; font-weight: 900; color: #0f172a; font-size: 1.25rem; }
.ohms-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; line-height: 1.5; }
.ohms-rebuilt .tool-icon-circle { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
.ohms-rebuilt .form-label-custom { font-size: .65rem; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: .4rem; display: block; }
.output-card-themed { background: var(--tool-bg); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.03); transition: all .4s ease; }
.output-hero { border-bottom: 1px solid rgba(0,0,0,.04); }
.output-hero-label { display: block; font-size: .7rem; letter-spacing: 2px; color: #64748b; }
.output-hero-value { font-size: 3rem; font-weight: 900; line-height: 1; letter-spacing: -2px; }
.output-hero-unit { font-size: 1.25rem; font-weight: 800; margin-left: 4px; }
.stat-card { transition: all .3s ease; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,.02); }
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\ohm-law-calculator.blade.php ENDPATH**/ ?>