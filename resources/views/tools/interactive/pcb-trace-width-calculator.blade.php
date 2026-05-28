<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

<div class="row g-4 pcb-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body pt-3">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
                <div class="row g-3">
                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Target Current ($I$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="pcb-current" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="2.5" step="any" min="0.1">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold">A</span>
                        </div>
                    </div>

                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Temperature Rise ($\Delta T$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="pcb-temprise" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="10" step="any" min="1">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold">°C</span>
                        </div>
                    </div>

                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Copper Thickness ($T$)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="pcb-thickness" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="1.0" step="any" min="0.1">
                            <select id="pcb-thickness-unit" class="form-select rounded-end-3 shadow-none border-secondary-subtle" style="max-width: 80px;">
                                <option value="oz" selected>oz/ft²</option>
                                <option value="mil">mils</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Layer Location</label>
                        <select id="pcb-layer" class="form-select form-select-sm rounded-3 shadow-none border-secondary-subtle">
                            <option value="external" selected>External Layer (Air)</option>
                            <option value="internal">Internal Layer (Substrate)</option>
                        </select>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 pcb-preset" data-curr="1.0" data-temp="10" data-thick="1.0" data-layer="external">📡 Signal External (1A @ 10°C, 1oz)</button>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 pcb-preset" data-curr="5.0" data-temp="20" data-thick="2.0" data-layer="internal">🔌 Power Internal (5A @ 20°C, 2oz)</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-4" id="pcb-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="pcb-theme" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(5,150,105,.03);">
            <div class="output-hero py-3 text-center">
                <span class="output-hero-label text-uppercase small fw-bold tracking-wider">Required Minimum Trace Width</span>
                <div class="d-flex justify-content-center align-items-baseline gap-1 mt-1">
                    <span class="output-hero-value fw-black text-2xl" id="out-value" style="color:#059669;">43.8</span>
                    <span class="output-hero-unit text-muted small fw-bold" id="out-unit">mils</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;color:#059669;">IPC-2221 Compliant</div>
            </div>

            <div class="row g-2 mt-3">
                <div class="col-4">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Trace Width (mm)</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-mm">1.11 mm</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Cross-Sectional Area</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-area">60.3 mil²</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Copper Thickness</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-thick-mils">1.38 mils</span>
                    </div>
                </div>
            </div>

            
            

            
            <div class="mt-3 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-stethoscope text-danger me-2"></i>PCB Thermal Design Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            
            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-2 px-4 fw-bold rounded-pill shadow-sm" id="pcb-copy-btn" style="min-width: 250px;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Trace Parameters
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const currEl = $('pcb-current'), tempEl = $('pcb-temprise'),
          thickEl = $('pcb-thickness'), thickUnitEl = $('pcb-thickness-unit'),
          layerEl = $('pcb-layer'), latexF = $('latex-formula'), latexSub = $('latex-substitution');

    function renderMath() {
        if (typeof katex !== 'undefined') {
            katex.render("A = \\left( \\frac{I}{k \\times \\Delta T^b} \\right)^{\\frac{1}{c}}, \\quad W = \\frac{A}{T}", latexF, {throwOnError: false, displayMode: true});
        } else {
            setTimeout(renderMath, 100);
        }
    }

    function calculate() {
        const current = parseFloat(currEl.value);
        const temp = parseFloat(tempEl.value);
        const thicknessInput = parseFloat(thickEl.value);
        const unit = thickUnitEl.value;
        const layer = layerEl.value;

        if (isNaN(current) || current <= 0 || isNaN(temp) || temp <= 0 || isNaN(thicknessInput) || thicknessInput <= 0) {
            return;
        }

        renderMath();

        // Convert thickness to mils (1 oz = 1.378 mils = 35um)
        const thickness = unit === 'oz' ? thicknessInput * 1.378 : thicknessInput;

        // IPC-2221 constants
        let k, b, c;
        if (layer === 'external') {
            k = 0.048; b = 0.44; c = 0.725;
        } else {
            k = 0.024; b = 0.44; c = 0.725;
        }

        // Calculate Area (A) in mil^2
        const area = Math.pow(current / (k * Math.pow(temp, b)), 1 / c);
        
        // Calculate Width (W) in mils
        const widthMils = area / thickness;
        const widthMm = widthMils * 0.0254;

        $('out-value').textContent = widthMils.toFixed(1);
        $('out-unit').textContent = 'mils';
        
        $('out-mm').textContent = widthMm.toFixed(2) + ' mm';
        $('out-area').textContent = area.toFixed(1) + ' mil²';
        $('out-thick-mils').textContent = thickness.toFixed(2) + ' mils';

        // Substitution LaTeX
        if (typeof katex !== 'undefined') {
            const subStr = `A = \\left( \\frac{${current}A}{${k} \\times ${temp}^{\\;${b}}} \\right)^{\\frac{1}{${c}}} = ${area.toFixed(1)}\\text{ mil}^2, \\quad W = \\frac{${area.toFixed(1)}}{${thickness.toFixed(2)}\\text{ mil}} = ${widthMils.toFixed(1)}\\text{ mils}`;
            katex.render(subStr, latexSub, {throwOnError: false, displayMode: true});
        }

        // Thermal Insights
        let insights = [];
        if (layer === 'internal') {
            insights.push("Internal layer traces dissipate heat less efficiently. They require roughly double the width of external layers for identical current and temperature specifications.");
        } else {
            insights.push("External traces in contact with ambient air cool faster, allowing smaller cross-sectional widths.");
        }
        
        if (temp < 10) {
            insights.push("Strict temperature rise budget (< 10°C) results in conservative, wide traces. Excellent for low-noise precision analogue lines.");
        } else if (temp > 30) {
            insights.push("Warning: Temperature rise > 30°C may affect dielectric FR4 lifespan and cause local trace warping. Use caution.");
        }
        insights.push("Note: For high frequency signals, verify impedance characteristics (typically 50Ω) alongside thermal widths.");

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${insights.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [currEl, tempEl, thickEl, thickUnitEl, layerEl].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.pcb-preset').forEach(btn => {
        btn.onclick = () => {
            currEl.value = btn.dataset.curr;
            tempEl.value = btn.dataset.temp;
            thickEl.value = btn.dataset.thick;
            thickUnitEl.value = 'oz';
            layerEl.value = btn.dataset.layer;
            calculate();
        };
    });

    $('pcb-reset').onclick = () => {
        currEl.value = '2.5';
        tempEl.value = '10';
        thickEl.value = '1.0';
        thickUnitEl.value = 'oz';
        layerEl.value = 'external';
        calculate();
    };

    $('pcb-copy-btn').onclick = function() {
        let text = `PCB Trace Width Specs (IPC-2221)\n`;
        text += `Current Load: ${currEl.value} A\n`;
        text += `Temp Rise Target: ${tempEl.value} °C\n`;
        text += `Copper Thickness: ${thickEl.value} ${thickUnitEl.options[thickUnitEl.selectedIndex].text}\n`;
        text += `Placement Layer: ${layerEl.options[layerEl.selectedIndex].text}\n`;
        text += `Calculated Trace Width: ${$('out-value').textContent} mils (${$('out-mm').textContent})\n`;
        text += `Cross-Sectional Area: ${$('out-area').textContent}\n`;
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
.pcb-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 8px 48px rgba(5,150,105,.04); }
.pcb-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.pcb-rebuilt .calculator-header h5 { margin: 0; font-weight: 900; color: #0f172a; font-size: 1.25rem; }
.pcb-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; line-height: 1.5; }
.pcb-rebuilt .tool-icon-circle { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
.pcb-rebuilt .form-label-custom { font-size: .65rem; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: .4rem; display: block; }
.output-card-themed { background: var(--tool-bg); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.03); transition: all .4s ease; }
.output-hero { border-bottom: 1px solid rgba(0,0,0,.04); }
.output-hero-label { display: block; font-size: .7rem; letter-spacing: 2px; color: #64748b; }
.output-hero-value { font-size: 3rem; font-weight: 900; line-height: 1; letter-spacing: -2px; }
.output-hero-unit { font-size: 1.25rem; font-weight: 800; margin-left: 4px; }
.stat-card { transition: all .3s ease; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,.02); }
</style>