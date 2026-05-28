<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

<div class="row g-4 rc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body pt-3">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
                <div class="row g-3">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Resistance ($R$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="rc-resistance" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="10" step="any" min="0.1">
                            <select id="rc-resistance-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 85px;">
                                <option value="1">Ω</option>
                                <option value="1000" selected>kΩ</option>
                                <option value="1000000">MΩ</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Capacitance ($C$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="rc-capacitance" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="100" step="any" min="0.001">
                            <select id="rc-capacitance-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 85px;">
                                <option value="1e-12">pF</option>
                                <option value="1e-9">nF</option>
                                <option value="1e-6" selected>µF</option>
                                <option value="1e-3">mF</option>
                                <option value="1">F</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Charging Voltage ($V_0$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="rc-voltage" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="5" step="any" min="0.1">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold">V</span>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 rc-preset" data-res="10" data-cap="1" data-volt="5">⏱️ Standard Debouncer (10ms)</button>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 rc-preset" data-res="100" data-cap="100" data-volt="3.3">⏱️ Long Delay (10s)</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-4" id="rc-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:174;--tool-color:#0d9488;--tool-bg:rgba(13,148,136,.03);">
            <div class="output-hero py-3 text-center">
                <span class="output-hero-label text-uppercase small fw-bold tracking-wider">RC Time Constant ($\tau$)</span>
                <div class="d-flex justify-content-center align-items-baseline gap-1 mt-1">
                    <span class="output-hero-value fw-black text-2xl" id="out-value" style="color:#0d9488;">1.00</span>
                    <span class="output-hero-unit text-muted small fw-bold" id="out-unit">Seconds</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;color:#0d9488;">Charging Transient</div>
            </div>

            <div class="row g-2 mt-3">
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Time Constant ($\tau$)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-tau">1.00 s</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Fully Charged ($5\tau$)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-charge-time">5.00 s</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Cutoff Frequency</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-cutoff">0.16 Hz</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Initial Charge Current</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-init-current">0.50 mA</span>
                    </div>
                </div>
            </div>

            
            

            
            

            
            <div class="mt-3 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-stethoscope text-danger me-2"></i>Circuit Transient Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            
            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-2 px-4 fw-bold rounded-pill shadow-sm" id="rc-copy-btn" style="min-width: 250px;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Transient Analysis
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const resEl = $('rc-resistance'), resUnitEl = $('rc-resistance-unit'),
          capEl = $('rc-capacitance'), capUnitEl = $('rc-capacitance-unit'),
          voltEl = $('rc-voltage'), transientBody = $('transient-table-body'),
          latexF = $('latex-formula'), latexSub = $('latex-substitution');

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

    function formatCurrent(amps) {
        if (amps < 1e-3) return (amps * 1e6).toFixed(1) + ' µA';
        if (amps < 1) return (amps * 1000).toFixed(2) + ' mA';
        return amps.toFixed(3) + ' A';
    }

    function renderMath() {
        if (typeof katex !== 'undefined') {
            katex.render("\\tau = R \\times C, \\quad V(c) = V_0(1 - e^{-t/\\tau})", latexF, {throwOnError: false, displayMode: true});
        } else {
            setTimeout(renderMath, 100);
        }
    }

    function calculate() {
        const res = parseFloat(resEl.value) * parseFloat(resUnitEl.value);
        const cap = parseFloat(capEl.value) * parseFloat(capUnitEl.value);
        const volt = parseFloat(voltEl.value);

        if (isNaN(res) || res <= 0 || isNaN(cap) || cap <= 0 || isNaN(volt) || volt <= 0) {
            return;
        }

        renderMath();

        const tau = res * cap;
        const chargeTime5tau = 5 * tau;
        const cutoffFreq = 1 / (2 * Math.PI * res * cap);
        const initCurrent = volt / res;

        const dispTime = formatTime(tau);
        $('out-value').textContent = dispTime.split(' ')[0];
        $('out-unit').textContent = dispTime.split(' ')[1];

        $('out-tau').textContent = dispTime;
        $('out-charge-time').textContent = formatTime(chargeTime5tau);
        $('out-cutoff').textContent = formatFreq(cutoffFreq);
        $('out-init-current').textContent = formatCurrent(initCurrent);

        // Populate transient table
        const intervals = [
            { tauNum: 1, pctCharge: 63.2, pctDischarge: 36.8 },
            { tauNum: 2, pctCharge: 86.5, pctDischarge: 13.5 },
            { tauNum: 3, pctCharge: 95.0, pctDischarge: 5.0 },
            { tauNum: 4, pctCharge: 98.2, pctDischarge: 1.8 },
            { tauNum: 5, pctCharge: 99.3, pctDischarge: 0.7 }
        ];

        transientBody.innerHTML = '';
        intervals.forEach(step => {
            const stepTime = step.tauNum * tau;
            const chargeVolt = volt * (step.pctCharge / 100);
            const dischargeVolt = volt * (step.pctDischarge / 100);

            const row = `
                <tr>
                    <td class="fw-bold">${step.tauNum}τ</td>
                    <td>${formatTime(stepTime)}</td>
                    <td class="text-success fw-bold">${step.pctCharge}%</td>
                    <td class="text-success">${chargeVolt.toFixed(3)} V</td>
                    <td class="text-danger fw-bold">${step.pctDischarge}%</td>
                    <td class="text-danger">${dischargeVolt.toFixed(3)} V</td>
                </tr>
            `;
            transientBody.insertAdjacentHTML('beforeend', row);
        });

        // Substitution LaTeX
        if (typeof katex !== 'undefined') {
            const subStr = `\\tau = ${resEl.value}${resUnitEl.options[resUnitEl.selectedIndex].text} \\times ${capEl.value}${capUnitEl.options[capUnitEl.selectedIndex].text} = ${dispTime}`;
            katex.render(subStr, latexSub, {throwOnError: false, displayMode: true});
        }

        // Operational Insights
        let insights = [];
        insights.push(`Initial surge current upon switch close is **${formatCurrent(initCurrent)}**. Ensure your switch contact and capacitor ripple current ratings support this transient load.`);
        insights.push("Capacitor is considered essentially 'fully charged' or 'fully discharged' at 5 time constants (5τ).");
        insights.push(`With these parameters, this RC circuit functions as a low-pass filter with a 3dB cutoff frequency of **${formatFreq(cutoffFreq)}**.`);

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${insights.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [resEl, resUnitEl, capEl, capUnitEl, voltEl].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.rc-preset').forEach(btn => {
        btn.onclick = () => {
            resEl.value = btn.dataset.res;
            resUnitEl.value = '1000';
            capEl.value = btn.dataset.cap;
            capUnitEl.value = '1e-6';
            voltEl.value = btn.dataset.volt;
            calculate();
        };
    });

    $('rc-reset').onclick = () => {
        resEl.value = '10';
        resUnitEl.value = '1000';
        capEl.value = '100';
        capUnitEl.value = '1e-6';
        voltEl.value = '5';
        calculate();
    };

    $('rc-copy-btn').onclick = function() {
        let text = `RC Circuit Transient Specifications\n`;
        text += `Resistance (R): ${resEl.value} ${resUnitEl.options[resUnitEl.selectedIndex].text}\n`;
        text += `Capacitance (C): ${capEl.value} ${capUnitEl.options[capUnitEl.selectedIndex].text}\n`;
        text += `Charging Voltage (V0): ${voltEl.value} V\n`;
        text += `Time Constant (tau): ${$('out-tau').textContent}\n`;
        text += `Full Charge Duration (5tau): ${$('out-charge-time').textContent}\n`;
        text += `Low Pass Cutoff: ${$('out-cutoff').textContent}\n`;
        text += `Initial Charge Current: ${$('out-init-current').textContent}\n`;
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
.rc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 8px 48px rgba(13,148,136,.04); }
.rc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.rc-rebuilt .calculator-header h5 { margin: 0; font-weight: 900; color: #0f172a; font-size: 1.25rem; }
.rc-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; line-height: 1.5; }
.rc-rebuilt .tool-icon-circle { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
.rc-rebuilt .form-label-custom { font-size: .65rem; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: .4rem; display: block; }
.output-card-themed { background: var(--tool-bg); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.03); transition: all .4s ease; }
.output-hero { border-bottom: 1px solid rgba(0,0,0,.04); }
.output-hero-label { display: block; font-size: .7rem; letter-spacing: 2px; color: #64748b; }
.output-hero-value { font-size: 3rem; font-weight: 900; line-height: 1; letter-spacing: -2px; }
.output-hero-unit { font-size: 1.25rem; font-weight: 800; margin-left: 4px; }
.stat-card { transition: all .3s ease; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,.02); }
</style>