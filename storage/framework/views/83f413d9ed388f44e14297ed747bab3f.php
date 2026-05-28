<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

<div class="row g-4 impedance-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body pt-3">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
                <div class="row g-3">
                    
                    <div class="col-md-3">
                        <label class="form-label-custom">AC Frequency ($f$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="imp-freq" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="1" step="any" min="0.001">
                            <select id="imp-freq-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 80px;">
                                <option value="1">Hz</option>
                                <option value="1000" selected>kHz</option>
                                <option value="1000000">MHz</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Resistance ($R$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="imp-res" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="50" step="any" min="0.1">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold">Ω</span>
                        </div>
                    </div>

                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Inductance ($L$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="imp-ind" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="10" step="any" min="0">
                            <select id="imp-ind-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 80px;">
                                <option value="1e-6">µH</option>
                                <option value="1e-3" selected>mH</option>
                                <option value="1">H</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Capacitance ($C$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="imp-cap" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="1" step="any" min="0.001">
                            <select id="imp-cap-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 80px;">
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
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 imp-preset" data-freq="1" data-res="10" data-ind="4.7" data-cap="10">📡 Audio Crossover Stage</button>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 imp-preset" data-freq="10" data-res="50" data-ind="1.5" data-cap="0.22">📡 RF Bias Tee (10MHz)</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-4" id="imp-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:243;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,.03);">
            <div class="output-hero py-3 text-center">
                <span class="output-hero-label text-uppercase small fw-bold tracking-wider">Total Impedance Magnitude ($|Z|$)</span>
                <div class="d-flex justify-content-center align-items-baseline gap-1 mt-1">
                    <span class="output-hero-value fw-black text-2xl" id="out-value" style="color:#4f46e5;">112.5</span>
                    <span class="output-hero-unit text-muted small fw-bold" id="out-unit">Ω</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;color:#4f46e5;">AC Steady State</div>
            </div>

            <div class="row g-2 mt-3">
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Inductive Reactance ($X_L$)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-xl">62.8 Ω</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Capacitive Reactance ($X_C$)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-xc">159.2 Ω</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Phase Angle ($\theta$)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-phase">-62.6°</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Resonant Freq ($f_0$)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-resonance">1.59 kHz</span>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-calculator text-primary me-2"></i>Impedance Vector Equation
                </h6>
                <div id="latex-formula" class="my-3 overflow-x-auto text-center py-2" style="font-size: 1.1rem;"></div>
                <div id="latex-substitution" class="small text-secondary overflow-x-auto text-center border-top pt-2"></div>
            </div>

            
            <div class="mt-3 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-stethoscope text-danger me-2"></i>AC Phase Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            
            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-2 px-4 fw-bold rounded-pill shadow-sm" id="imp-copy-btn" style="min-width: 250px;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy AC Impedance Analysis
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const freqEl = $('imp-freq'), freqUnitEl = $('imp-freq-unit'),
          resEl = $('imp-res'), indEl = $('imp-ind'), indUnitEl = $('imp-ind-unit'),
          capEl = $('imp-cap'), capUnitEl = $('imp-cap-unit'),
          latexF = $('latex-formula'), latexSub = $('latex-substitution');

    function formatRes(ohms) {
        if (ohms >= 1e6) return (ohms / 1e6).toFixed(2) + ' MΩ';
        if (ohms >= 1000) return (ohms / 1000).toFixed(2) + ' kΩ';
        return ohms.toFixed(1) + ' Ω';
    }

    function formatFreq(hz) {
        if (hz >= 1e6) return (hz / 1e6).toFixed(3) + ' MHz';
        if (hz >= 1000) return (hz / 1000).toFixed(2) + ' kHz';
        return hz.toFixed(2) + ' Hz';
    }

    function renderMath() {
        if (typeof katex !== 'undefined') {
            katex.render("Z = R + j(X_L - X_C), \\quad |Z| = \\sqrt{R^2 + (X_L - X_C)^2}", latexF, {throwOnError: false, displayMode: true});
        } else {
            setTimeout(renderMath, 100);
        }
    }

    function calculate() {
        const freqVal = parseFloat(freqEl.value);
        const freq = freqVal * parseFloat(freqUnitEl.value);

        const r = parseFloat(resEl.value);

        const indVal = parseFloat(indEl.value);
        const l = indVal * parseFloat(indUnitEl.value);

        const capVal = parseFloat(capEl.value);
        const c = capVal * parseFloat(capUnitEl.value);

        if (isNaN(freq) || freq <= 0 || isNaN(r) || r <= 0 || isNaN(l) || l < 0 || isNaN(c) || c <= 0) {
            return;
        }

        renderMath();

        // Calculate reactances
        const xl = 2 * Math.PI * freq * l;
        const xc = 1 / (2 * Math.PI * freq * c);

        // Impedance magnitude
        const z = Math.sqrt(r * r + (xl - xc) * (xl - xc));
        const phaseDeg = Math.atan2(xl - xc, r) * (180 / Math.PI);

        // Resonant frequency
        const resonance = 1 / (2 * Math.PI * Math.sqrt(l * c));

        $('out-value').textContent = z.toFixed(1);
        $('out-unit').textContent = 'Ω';

        $('out-xl').textContent = formatRes(xl);
        $('out-xc').textContent = formatRes(xc);
        $('out-phase').textContent = phaseDeg.toFixed(1) + '°';
        $('out-resonance').textContent = formatFreq(resonance);

        // Substitution LaTeX
        if (typeof katex !== 'undefined') {
            const subStr = `|Z| = \\sqrt{${r}^2 + (${xl.toFixed(1)} - ${xc.toFixed(1)})^2} = ${z.toFixed(1)}\\Omega`;
            katex.render(subStr, latexSub, {throwOnError: false, displayMode: true});
        }

        // Operational Insights
        let insights = [];
        if (Math.abs(xl - xc) < 0.1) {
            insights.push("Circuit is operating in resonance. Inductive and capacitive reactances cancel out entirely, leaving purely resistive impedance.");
        } else if (xl > xc) {
            insights.push(`Circuit is highly **inductive** (phase angle +${phaseDeg.toFixed(1)}°). Current lags voltage transiently.`);
        } else {
            insights.push(`Circuit is highly **capacitive** (phase angle ${phaseDeg.toFixed(1)}°). Current leads voltage transiently.`);
        }
        
        insights.push(`Resonant frequency of this RLC tank is **${formatFreq(resonance)}**.`);

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${insights.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-primary me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [freqEl, freqUnitEl, resEl, indEl, indUnitEl, capEl, capUnitEl].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.imp-preset').forEach(btn => {
        btn.onclick = () => {
            freqEl.value = btn.dataset.freq;
            freqUnitEl.value = '1000';
            resEl.value = btn.dataset.res;
            indEl.value = btn.dataset.ind;
            indUnitEl.value = '1e-3';
            capEl.value = btn.dataset.cap;
            capUnitEl.value = '1e-6';
            calculate();
        };
    });

    $('imp-reset').onclick = () => {
        freqEl.value = '1';
        freqUnitEl.value = '1000';
        resEl.value = '50';
        indEl.value = '10';
        indUnitEl.value = '1e-3';
        capEl.value = '1';
        capUnitEl.value = '1e-6';
        calculate();
    };

    $('imp-copy-btn').onclick = function() {
        let text = `AC Impedance Analysis Report\n`;
        text += `Excitation Frequency: ${freqEl.value} ${freqUnitEl.options[freqUnitEl.selectedIndex].text}\n`;
        text += `Resistance (R): ${resEl.value} Ω\n`;
        text += `Inductance (L): ${indEl.value} ${indUnitEl.options[indUnitEl.selectedIndex].text}\n`;
        text += `Capacitance (C): ${capEl.value} ${capUnitEl.options[capUnitEl.selectedIndex].text}\n`;
        text += `Impedance magnitude |Z|: ${$('out-value').textContent} Ω\n`;
        text += `Phase Winding Angle: ${$('out-phase').textContent}\n`;
        text += `Resonant Frequency: ${$('out-resonance').textContent}\n`;
        text += `Calculated at ToolsHub Electronics`;
        
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; 
            this.innerHTML = '<i class="fas fa-check me-2"></i>AC Report Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    };

    calculate();
});
</script>

<style>
.impedance-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 8px 48px rgba(79,70,229,.04); }
.impedance-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.impedance-rebuilt .calculator-header h5 { margin: 0; font-weight: 900; color: #0f172a; font-size: 1.25rem; }
.impedance-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; line-height: 1.5; }
.impedance-rebuilt .tool-icon-circle { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
.impedance-rebuilt .form-label-custom { font-size: .65rem; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: .4rem; display: block; }
.output-card-themed { background: var(--tool-bg); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.03); transition: all .4s ease; }
.output-hero { border-bottom: 1px solid rgba(0,0,0,.04); }
.output-hero-label { display: block; font-size: .7rem; letter-spacing: 2px; color: #64748b; }
.output-hero-value { font-size: 3rem; font-weight: 900; line-height: 1; letter-spacing: -2px; }
.output-hero-unit { font-size: 1.25rem; font-weight: 800; margin-left: 4px; }
.stat-card { transition: all .3s ease; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,.02); }
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\impedance-calculator.blade.php ENDPATH**/ ?>