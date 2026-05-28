<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

<div class="row g-4 timer-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body pt-3">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
                <div class="row g-3">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Timer Mode</label>
                        <select id="timer-mode" class="form-select form-select-sm rounded-3 shadow-none border-secondary-subtle">
                            <option value="astable">Astable (Oscillator / Clock)</option>
                            <option value="monostable">Monostable (One-Shot Pulse)</option>
                        </select>
                    </div>

                    
                    <div class="col-md-4" id="r1-container">
                        <label class="form-label-custom">Resistor $R_1$</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="timer-r1" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="10" step="any" min="0.1">
                            <select id="timer-r1-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 85px;">
                                <option value="1">Ω</option>
                                <option value="1000" selected>kΩ</option>
                                <option value="1000000">MΩ</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-4" id="r2-container">
                        <label class="form-label-custom">Resistor $R_2$</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="timer-r2" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="47" step="any" min="0.1">
                            <select id="timer-r2-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 85px;">
                                <option value="1">Ω</option>
                                <option value="1000" selected>kΩ</option>
                                <option value="1000000">MΩ</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Capacitor $C_1$</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="timer-c1" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="10" step="any" min="0.001">
                            <select id="timer-c1-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 85px;">
                                <option value="1e-12">pF</option>
                                <option value="1e-9">nF</option>
                                <option value="1e-6" selected>µF</option>
                                <option value="1e-3">mF</option>
                            </select>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 timer-preset" data-mode="astable" data-r1="10" data-r2="47" data-c1="10" data-c1unit="1e-6">⚡ Astable Clock (1.3Hz)</button>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 timer-preset" data-mode="monostable" data-r1="100" data-r2="0" data-c1="10" data-c1unit="1e-6">⏱️ Monostable Pulse (1.1s)</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-4" id="timer-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="timer-theme" style="--tool-hue:25;--tool-color:#d97706;--tool-bg:rgba(217,119,6,.03);">
            <div class="output-hero py-3 text-center">
                <span class="output-hero-label text-uppercase small fw-bold tracking-wider" id="out-hero-label">Calculated Frequency</span>
                <div class="d-flex justify-content-center align-items-baseline gap-1 mt-1">
                    <span class="output-hero-value fw-black text-2xl" id="out-value" style="color:#d97706;">1.37</span>
                    <span class="output-hero-unit text-muted small fw-bold" id="out-unit">Hz</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;color:#d97706;">Astable Mode</div>
            </div>

            <div class="row g-2 mt-3" id="astable-stats">
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Duty Cycle</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-duty">54.8%</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Time High ($T_H$)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-th">395 ms</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Time Low ($T_L$)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-tl">325 ms</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Period ($T$)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-period">720 ms</span>
                    </div>
                </div>
            </div>

            
            
            
            <div class="mt-3 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-stethoscope text-danger me-2"></i>Design Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            
            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-2 px-4 fw-bold rounded-pill shadow-sm" id="timer-copy-btn" style="min-width: 250px;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Circuit Parameters
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const modeEl = $('timer-mode'), r1El = $('timer-r1'), r1UnitEl = $('timer-r1-unit'),
          r2El = $('timer-r2'), r2UnitEl = $('timer-r2-unit'), c1El = $('timer-c1'),
          c1UnitEl = $('timer-c1-unit'), latexF = $('latex-formula'), latexSub = $('latex-substitution');

    function formatTime(s) {
        if (s < 1e-6) return (s * 1e9).toFixed(1) + ' ns';
        if (s < 1e-3) return (s * 1e6).toFixed(1) + ' µs';
        if (s < 1) return (s * 1000).toFixed(1) + ' ms';
        return s.toFixed(3) + ' s';
    }

    function formatFreq(hz) {
        if (hz >= 1e6) return (hz / 1e6).toFixed(3) + ' MHz';
        if (hz >= 1000) return (hz / 1000).toFixed(2) + ' kHz';
        return hz.toFixed(2) + ' Hz';
    }

    function renderMath() {
        if (typeof katex !== 'undefined') {
            const mode = modeEl.value;
            if (mode === 'astable') {
                katex.render("f = \\frac{1.44}{(R_1 + 2R_2) \\times C_1}", latexF, {throwOnError: false, displayMode: true});
            } else {
                katex.render("T = 1.1 \\times R_1 \\times C_1", latexF, {throwOnError: false, displayMode: true});
            }
        } else {
            setTimeout(renderMath, 100);
        }
    }

    function calculate() {
        const mode = modeEl.value;
        const r1 = parseFloat(r1El.value) * parseFloat(r1UnitEl.value);
        const r2 = parseFloat(r2El.value) * parseFloat(r2UnitEl.value);
        const c1 = parseFloat(c1El.value) * parseFloat(c1UnitEl.value);

        if (isNaN(r1) || r1 <= 0 || isNaN(c1) || c1 <= 0 || (mode === 'astable' && (isNaN(r2) || r2 <= 0))) {
            return;
        }

        renderMath();

        let insights = [];
        if (mode === 'astable') {
            $('r2-container').style.display = 'block';
            $('astable-stats').style.display = 'flex';
            $('out-hero-label').textContent = 'Calculated Frequency';
            $('out-status').textContent = 'Astable Mode';

            // Astable Mode calculations
            const th = 0.693 * (r1 + r2) * c1;
            const tl = 0.693 * r2 * c1;
            const period = th + tl;
            const freq = 1.44 / ((r1 + 2 * r2) * c1);
            const duty = ((r1 + r2) / (r1 + 2 * r2)) * 100;

            $('out-value').textContent = formatFreq(freq).split(' ')[0];
            $('out-unit').textContent = formatFreq(freq).split(' ')[1];
            $('out-duty').textContent = duty.toFixed(1) + '%';
            $('out-th').textContent = formatTime(th);
            $('out-tl').textContent = formatTime(tl);
            $('out-period').textContent = formatTime(period);

            if (typeof katex !== 'undefined') {
                const subStr = `f = \\frac{1.44}{(${r1El.value}${r1UnitEl.options[r1UnitEl.selectedIndex].text} + 2 \\times ${r2El.value}${r2UnitEl.options[r2UnitEl.selectedIndex].text}) \\times ${c1El.value}${c1UnitEl.options[c1UnitEl.selectedIndex].text} } = ${formatFreq(freq)}`;
                katex.render(subStr, latexSub, {throwOnError: false, displayMode: true});
            }

            // Design Insights
            if (r1 < 1000) {
                insights.push("Low value of R1 can cause high chip current during output discharge. Keep R1 >= 1kΩ.");
            }
            if (duty < 50.1) {
                insights.push("Standard NE555 astable configurations cannot achieve < 50% duty cycle. Try adding a steering diode across R2 if low duty is needed.");
            }
            insights.push("Target C1: Ceramic or Film capacitors are highly recommended for stable oscillations.");
        } else {
            $('r2-container').style.display = 'none';
            $('astable-stats').style.display = 'none';
            $('out-hero-label').textContent = 'Output Pulse Duration';
            $('out-status').textContent = 'Monostable Mode';

            // Monostable Mode calculations
            const t = 1.1 * r1 * c1;
            $('out-value').textContent = formatTime(t).split(' ')[0];
            $('out-unit').textContent = formatTime(t).split(' ')[1];

            if (typeof katex !== 'undefined') {
                const subStr = `T = 1.1 \\times ${r1El.value}${r1UnitEl.options[r1UnitEl.selectedIndex].text} \\times ${c1El.value}${c1UnitEl.options[c1UnitEl.selectedIndex].text} = ${formatTime(t)}`;
                katex.render(subStr, latexSub, {throwOnError: false, displayMode: true});
            }

            if (r1 > 10e6) {
                insights.push("Resistor values > 10MΩ may lead to timing drift due to leakage currents.");
            }
            insights.push("The pulse is triggered on a high-to-low transition of the trigger pin (Pin 2).");
            insights.push(`Pulse duration: ${formatTime(t)} - perfect for timer delays and debouncers.`);
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${insights.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-warning me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    modeEl.addEventListener('change', calculate);
    [r1El, r1UnitEl, r2El, r2UnitEl, c1El, c1UnitEl].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.timer-preset').forEach(btn => {
        btn.onclick = () => {
            modeEl.value = btn.dataset.mode;
            r1El.value = btn.dataset.r1;
            r1UnitEl.value = "1000";
            if (btn.dataset.r2 !== "0") {
                r2El.value = btn.dataset.r2;
                r2UnitEl.value = "1000";
            }
            c1El.value = btn.dataset.c1;
            c1UnitEl.value = btn.dataset.c1unit;
            calculate();
        };
    });

    $('timer-reset').onclick = () => {
        modeEl.value = 'astable';
        r1El.value = '10';
        r1UnitEl.value = '1000';
        r2El.value = '47';
        r2UnitEl.value = '1000';
        c1El.value = '10';
        c1UnitEl.value = '1e-6';
        calculate();
    };

    $('timer-copy-btn').onclick = function() {
        let text = `555 Timer Circuit Parameters\n`;
        text += `Mode: ${modeEl.options[modeEl.selectedIndex].text}\n`;
        text += `R1: ${r1El.value} ${r1UnitEl.options[r1UnitEl.selectedIndex].text}\n`;
        if (modeEl.value === 'astable') {
            text += `R2: ${r2El.value} ${r2UnitEl.options[r2UnitEl.selectedIndex].text}\n`;
            text += `Capacitor C1: ${c1El.value} ${c1UnitEl.options[c1UnitEl.selectedIndex].text}\n`;
            text += `Frequency: ${$('out-value').textContent} ${$('out-unit').textContent}\n`;
            text += `Duty Cycle: ${$('out-duty').textContent}\n`;
            text += `Pulse Period: ${$('out-period').textContent}\n`;
        } else {
            text += `Capacitor C1: ${c1El.value} ${c1UnitEl.options[c1UnitEl.selectedIndex].text}\n`;
            text += `Pulse Duration: ${$('out-value').textContent} ${$('out-unit').textContent}\n`;
        }
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
.timer-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 8px 48px rgba(217,119,6,.04); }
.timer-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.timer-rebuilt .calculator-header h5 { margin: 0; font-weight: 900; color: #0f172a; font-size: 1.25rem; }
.timer-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; line-height: 1.5; }
.timer-rebuilt .tool-icon-circle { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
.timer-rebuilt .form-label-custom { font-size: .65rem; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: .4rem; display: block; }
.output-card-themed { background: var(--tool-bg); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.03); transition: all .4s ease; }
.output-hero { border-bottom: 1px solid rgba(0,0,0,.04); }
.output-hero-label { display: block; font-size: .7rem; letter-spacing: 2px; color: #64748b; }
.output-hero-value { font-size: 3rem; font-weight: 900; line-height: 1; letter-spacing: -2px; }
.output-hero-unit { font-size: 1.25rem; font-weight: 800; margin-left: 4px; }
.stat-card { transition: all .3s ease; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,.02); }
</style>