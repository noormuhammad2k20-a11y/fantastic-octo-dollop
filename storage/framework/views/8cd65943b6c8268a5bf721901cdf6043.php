<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

<div class="row g-4 led-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body pt-3">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
                <div class="row g-3">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Source Voltage ($V_S$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="led-vs" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="9" step="any" min="0.1">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold">V</span>
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">LED Forward Voltage ($V_F$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="led-vf" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="2.0" step="any" min="0.1">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold">V</span>
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">LED Forward Current ($I_F$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="led-if" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="20" step="any" min="0.1">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold">mA</span>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 led-preset" data-vf="2.0" data-if="20" data-color="#e11d48">🔴 Standard Red (2.0V @ 20mA)</button>
                        <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 led-preset" data-vf="3.2" data-if="20" data-color="#16a34a">🟢 Standard Green (3.2V @ 20mA)</button>
                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 led-preset" data-vf="3.2" data-if="20" data-color="#2563eb">🔵 Standard Blue (3.2V @ 20mA)</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-4" id="led-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="led-theme" style="--tool-hue:349;--tool-color:#e11d48;--tool-bg:rgba(225,29,72,.03);">
            <div class="output-hero py-3 text-center">
                <span class="output-hero-label text-uppercase small fw-bold tracking-wider">Calculated Resistance</span>
                <div class="d-flex justify-content-center align-items-baseline gap-1 mt-1">
                    <span class="output-hero-value fw-black text-2xl" id="out-value" style="color:#e11d48;">350</span>
                    <span class="output-hero-unit text-muted small fw-bold" id="out-unit">Ω</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;color:#e11d48;">Ideal Limit Resistor</div>
            </div>

            <div class="row g-2 mt-3">
                <div class="col-6">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Nearest E24 Standard Value</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-e24">360 Ω</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Resistor Power Rating</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-power">140 mW</span>
                    </div>
                </div>
            </div>

            
            

            
            <div class="mt-3 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-stethoscope text-danger me-2"></i>Resistor Power & Safety Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            
            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-2 px-4 fw-bold rounded-pill shadow-sm" id="led-copy-btn" style="min-width: 250px;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Resistor Specifications
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const vsEl = $('led-vs'), vfEl = $('led-vf'), ifEl = $('led-if'),
          latexF = $('latex-formula'), latexSub = $('latex-substitution');

    // E24 values
    const e24Values = [
        1.0, 1.1, 1.2, 1.3, 1.5, 1.6, 1.8, 2.0, 2.2, 2.4, 2.7, 3.0,
        3.3, 3.6, 3.9, 4.3, 4.7, 5.1, 5.6, 6.2, 6.8, 7.5, 8.2, 9.1
    ];

    function getNearestE24(val) {
        if (val <= 0) return 0;
        const exponent = Math.floor(Math.log10(val));
        const normalized = val / Math.pow(10, exponent);
        
        let nearest = e24Values[0];
        let minDiff = Math.abs(normalized - nearest);
        
        for (let i = 1; i < e24Values.length; i++) {
            let diff = Math.abs(normalized - e24Values[i]);
            if (diff < minDiff) {
                minDiff = diff;
                nearest = e24Values[i];
            }
        }
        
        return Math.round(nearest * Math.pow(10, exponent) * 10) / 10;
    }

    function renderMath() {
        if (typeof katex !== 'undefined') {
            katex.render("R_{series} = \\frac{V_S - V_F}{I_F}", latexF, {throwOnError: false, displayMode: true});
        } else {
            setTimeout(renderMath, 100);
        }
    }

    function calculate() {
        const vs = parseFloat(vsEl.value);
        const vf = parseFloat(vfEl.value);
        const currMa = parseFloat(ifEl.value);
        const currAmps = currMa / 1000;

        if (isNaN(vs) || vs <= 0 || isNaN(vf) || vf <= 0 || isNaN(currMa) || currMa <= 0) {
            return;
        }

        if (vf >= vs) {
            $('out-value').textContent = '—';
            $('out-e24').textContent = 'Overvoltage!';
            $('out-power').textContent = '—';
            $('out-insights').innerHTML = '<div class="text-danger small fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>Source Voltage (Vs) must be greater than LED Forward Voltage (Vf).</div>';
            return;
        }

        renderMath();

        const resistance = (vs - vf) / currAmps;
        const e24 = getNearestE24(resistance);
        const powerWatts = (vs - vf) * currAmps;
        const powerMw = powerWatts * 1000;

        $('out-value').textContent = Math.round(resistance);
        $('out-e24').textContent = e24 + ' Ω';

        let pText = '';
        if (powerWatts >= 1) {
            pText = powerWatts.toFixed(2) + ' W';
        } else {
            pText = Math.round(powerMw) + ' mW';
        }
        $('out-power').textContent = pText;

        // Substitution LaTeX
        if (typeof katex !== 'undefined') {
            const subStr = `R_{series} = \\frac{${vs}V - ${vf}V}{${currMa}\\text{mA}} = ${resistance.toFixed(1)}\\Omega`;
            katex.render(subStr, latexSub, {throwOnError: false, displayMode: true});
        }

        // Operational Insights
        let insights = [];
        const requiredPowerRating = powerWatts * 2; // safety factor
        
        let standardRating = '1/4 W (250mW)';
        if (requiredPowerRating > 1.0) standardRating = '2 W';
        else if (requiredPowerRating > 0.5) standardRating = '1 W';
        else if (requiredPowerRating > 0.25) standardRating = '1/2 W (500mW)';

        insights.push(`Calculated power dissipation: ${pText}. For safety margins, select a resistor rated for at least **${standardRating}**.`);
        if (e24 !== Math.round(resistance)) {
            const actualCurrent = ((vs - vf) / e24) * 1000;
            insights.push(`Using E24 standard value ${e24}Ω will shift current slightly to **${actualCurrent.toFixed(1)} mA**.`);
        }
        insights.push("Ensure your LED is connected with correct anode (+) and cathode (-) polarity to avoid reverse breakdown.");

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${insights.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-danger me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [vsEl, vfEl, ifEl].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.led-preset').forEach(btn => {
        btn.onclick = () => {
            vfEl.value = btn.dataset.vf;
            ifEl.value = btn.dataset.if;
            
            // Set dynamic theme hue based on selected LED preset
            const color = btn.dataset.color;
            if (color === '#16a34a') {
                $('led-theme').style.setProperty('--tool-hue', '142');
                $('led-theme').style.setProperty('--tool-color', '#16a34a');
                $('led-theme').style.setProperty('--tool-bg', 'rgba(22,163,74,.03)');
            } else if (color === '#2563eb') {
                $('led-theme').style.setProperty('--tool-hue', '221');
                $('led-theme').style.setProperty('--tool-color', '#2563eb');
                $('led-theme').style.setProperty('--tool-bg', 'rgba(37,99,235,.03)');
            } else {
                $('led-theme').style.setProperty('--tool-hue', '349');
                $('led-theme').style.setProperty('--tool-color', '#e11d48');
                $('led-theme').style.setProperty('--tool-bg', 'rgba(225,29,72,.03)');
            }

            calculate();
        };
    });

    $('led-reset').onclick = () => {
        vsEl.value = '9';
        vfEl.value = '2.0';
        ifEl.value = '20';
        $('led-theme').style.setProperty('--tool-hue', '349');
        $('led-theme').style.setProperty('--tool-color', '#e11d48');
        $('led-theme').style.setProperty('--tool-bg', 'rgba(225,29,72,.03)');
        calculate();
    };

    $('led-copy-btn').onclick = function() {
        let text = `LED Current-Limiting Resistor Specs\n`;
        text += `Source Voltage: ${vsEl.value} V\n`;
        text += `LED Forward Voltage: ${vfEl.value} V\n`;
        text += `LED Forward Current: ${ifEl.value} mA\n`;
        text += `Calculated Resistance: ${$('out-value').textContent} Ω\n`;
        text += `Standard E24 Resistor: ${$('out-e24').textContent}\n`;
        text += `Power Rating Required: ${$('out-power').textContent}\n`;
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
.led-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 8px 48px rgba(225,29,72,.04); }
.led-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.led-rebuilt .calculator-header h5 { margin: 0; font-weight: 900; color: #0f172a; font-size: 1.25rem; }
.led-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; line-height: 1.5; }
.led-rebuilt .tool-icon-circle { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
.led-rebuilt .form-label-custom { font-size: .65rem; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: .4rem; display: block; }
.output-card-themed { background: var(--tool-bg); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.03); transition: all .4s ease; }
.output-hero { border-bottom: 1px solid rgba(0,0,0,.04); }
.output-hero-label { display: block; font-size: .7rem; letter-spacing: 2px; color: #64748b; }
.output-hero-value { font-size: 3rem; font-weight: 900; line-height: 1; letter-spacing: -2px; }
.output-hero-unit { font-size: 1.25rem; font-weight: 800; margin-left: 4px; }
.stat-card { transition: all .3s ease; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,.02); }
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\led-resistor-calculator.blade.php ENDPATH**/ ?>