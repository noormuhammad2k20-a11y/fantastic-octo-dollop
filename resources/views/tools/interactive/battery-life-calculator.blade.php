<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

<div class="row g-4 battery-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body pt-3">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
                <div class="row g-3">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Battery Capacity</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="battery-capacity" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="2500" step="any" min="1">
                            <select id="battery-capacity-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 85px;">
                                <option value="1" selected>mAh</option>
                                <option value="1000">Ah</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Device Load Current</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="battery-load" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="150" step="any" min="0.1">
                            <select id="battery-load-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 85px;">
                                <option value="1" selected>mA</option>
                                <option value="1000">A</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom d-flex justify-content-between">
                            <span>De-rating Factor</span>
                            <span id="derating-val" class="fw-bold text-success">70%</span>
                        </label>
                        <input type="range" id="battery-derating" class="form-range" min="10" max="100" value="70">
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 battery-preset" data-cap="2000" data-capunit="1" data-load="50" data-loadunit="1" data-derating="75">🔋 AA Alkaline (Low Load)</button>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 battery-preset" data-cap="5000" data-capunit="1" data-load="1.5" data-loadunit="1000" data-derating="85">🏎️ LiPo 2S (RC Car)</button>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 battery-preset" data-cap="100" data-capunit="1000" data-load="4" data-loadunit="1000" data-derating="60">🏠 Lead Acid Solar (Deep)</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-4" id="battery-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="battery-theme" style="--tool-hue:142;--tool-color:#16a34a;--tool-bg:rgba(22,163,74,.03);">
            <div class="output-hero py-3 text-center">
                <span class="output-hero-label text-uppercase small fw-bold tracking-wider">Estimated Battery Life</span>
                <div class="d-flex justify-content-center align-items-baseline gap-1 mt-1">
                    <span class="output-hero-value fw-black text-2xl" id="out-value" style="color:#16a34a;">11.7</span>
                    <span class="output-hero-unit text-muted small fw-bold" id="out-unit">Hours</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;color:#16a34a;">Optimal Run-time</div>
            </div>

            <div class="row g-2 mt-3">
                <div class="col-4">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Hours</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-hours">11.7 hrs</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Days</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-days">0.49 days</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Weeks</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-weeks">0.07 weeks</span>
                    </div>
                </div>
            </div>

            
            

            
            <div class="mt-3 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-stethoscope text-danger me-2"></i>Discharge Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            
            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-2 px-4 fw-bold rounded-pill shadow-sm" id="battery-copy-btn" style="min-width: 250px;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Run-time Data
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const capacityEl = $('battery-capacity'), capacityUnitEl = $('battery-capacity-unit'),
          loadEl = $('battery-load'), loadUnitEl = $('battery-load-unit'),
          deratingEl = $('battery-derating'), deratingValEl = $('derating-val'),
          latexF = $('latex-formula'), latexSub = $('latex-substitution');

    function renderMath() {
        if (typeof katex !== 'undefined') {
            katex.render("T_{life} = \\frac{Capacity \\times \\eta}{Load}", latexF, {throwOnError: false, displayMode: true});
        } else {
            setTimeout(renderMath, 100);
        }
    }

    function calculate() {
        const capacityVal = parseFloat(capacityEl.value);
        const capacityUnit = parseFloat(capacityUnitEl.value);
        const capacity = capacityVal * capacityUnit; // in mAh

        const loadVal = parseFloat(loadEl.value);
        const loadUnit = parseFloat(loadUnitEl.value);
        const load = loadVal * loadUnit; // in mA

        const derating = parseFloat(deratingEl.value);
        deratingValEl.textContent = derating + '%';

        if (isNaN(capacity) || capacity <= 0 || isNaN(load) || load <= 0) {
            return;
        }

        renderMath();

        // Calculate hours of life
        const hours = (capacity / load) * (derating / 100);
        const days = hours / 24;
        const weeks = days / 7;

        let displayVal = hours;
        let displayUnit = 'Hours';

        if (hours >= 168) {
            displayVal = weeks;
            displayUnit = 'Weeks';
        } else if (hours >= 24) {
            displayVal = days;
            displayUnit = 'Days';
        }

        $('out-value').textContent = displayVal.toFixed(displayVal >= 10 ? 1 : 2);
        $('out-unit').textContent = displayUnit;

        $('out-hours').textContent = hours.toFixed(1) + ' hrs';
        $('out-days').textContent = days.toFixed(2) + ' days';
        $('out-weeks').textContent = weeks.toFixed(2) + ' weeks';

        // Substitution LaTeX
        if (typeof katex !== 'undefined') {
            const capStr = capacityUnit === 1000 ? `${capacityVal}Ah` : `${capacityVal}mAh`;
            const ldStr = loadUnit === 1000 ? `${loadVal}A` : `${loadVal}mA`;
            const subStr = `T_{life} = \\frac{${capStr} \\times ${derating}\\%}{${ldStr}} = ${hours.toFixed(1)}\\text{ Hours}`;
            katex.render(subStr, latexSub, {throwOnError: false, displayMode: true});
        }

        // Discharge Insights
        let insights = [];
        if (derating < 80) {
            insights.push(`De-rating factor of ${derating}% assumes normal temperature operation (25°C). High load rates can reduce this significantly.`);
        } else {
            insights.push(`Highly optimized de-rating. Only lithium batteries (Li-Ion/LiFePO4) typically maintain >= 80% capacity at high currents.`);
        }
        
        if (load > capacity) {
            insights.push("Warning: Load current exceeds capacity (discharge rate > 1C). The battery will undergo rapid depletion and possible thermal stress.");
        }
        insights.push("Peukert's Law: For lead-acid cells, runtime is shorter at high discharge rates than this linear formula suggests.");

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${insights.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [capacityEl, capacityUnitEl, loadEl, loadUnitEl, deratingEl].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.battery-preset').forEach(btn => {
        btn.onclick = () => {
            capacityEl.value = btn.dataset.cap;
            capacityUnitEl.value = btn.dataset.capunit;
            loadEl.value = btn.dataset.load;
            loadUnitEl.value = btn.dataset.loadunit;
            deratingEl.value = btn.dataset.derating;
            calculate();
        };
    });

    $('battery-reset').onclick = () => {
        capacityEl.value = '2500';
        capacityUnitEl.value = '1';
        loadEl.value = '150';
        loadUnitEl.value = '1';
        deratingEl.value = '70';
        calculate();
    };

    $('battery-copy-btn').onclick = function() {
        let text = `Battery Run-time Parameters\n`;
        text += `Capacity: ${capacityEl.value} ${capacityUnitEl.options[capacityUnitEl.selectedIndex].text}\n`;
        text += `Load Current: ${loadEl.value} ${loadUnitEl.options[loadUnitEl.selectedIndex].text}\n`;
        text += `De-rating Efficiency: ${deratingEl.value}%\n`;
        text += `Estimated Battery Life: ${$('out-hours').textContent} (${$('out-days').textContent})\n`;
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
.battery-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 8px 48px rgba(22,163,74,.04); }
.battery-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.battery-rebuilt .calculator-header h5 { margin: 0; font-weight: 900; color: #0f172a; font-size: 1.25rem; }
.battery-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; line-height: 1.5; }
.battery-rebuilt .tool-icon-circle { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
.battery-rebuilt .form-label-custom { font-size: .65rem; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: .4rem; display: block; }
.output-card-themed { background: var(--tool-bg); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.03); transition: all .4s ease; }
.output-hero { border-bottom: 1px solid rgba(0,0,0,.04); }
.output-hero-label { display: block; font-size: .7rem; letter-spacing: 2px; color: #64748b; }
.output-hero-value { font-size: 3rem; font-weight: 900; line-height: 1; letter-spacing: -2px; }
.output-hero-unit { font-size: 1.25rem; font-weight: 800; margin-left: 4px; }
.stat-card { transition: all .3s ease; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,.02); }
</style>