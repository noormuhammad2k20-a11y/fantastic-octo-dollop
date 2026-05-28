<div class="row g-4 iw-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Gender Profile</label>
                        <select id="iw-gender" class="form-select form-select-lg rounded-3">
                            <option value="male">♂ Male Profile</option>
                            <option value="female">♀ Female Profile</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Height (<span class="unit-h">cm</span>)</label>
                        <input type="number" id="iw-height" class="form-control form-control-lg rounded-3" value="175" step="0.1">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Frame Size</label>
                        <select id="iw-frame" class="form-select form-select-lg rounded-3">
                            <option value="0.9">Small Frame (-10%)</option>
                            <option value="1.0" selected>Medium Frame (Std)</option>
                            <option value="1.1">Large Frame (+10%)</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Results System</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary px-4 active unit-toggle" data-unit="metric">Metric (kg)</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary px-4 unit-toggle" data-unit="imperial">Imperial (lb)</button>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Height Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 iw-preset" data-h="180">👨 5'11" (180cm)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 iw-preset" data-h="165">👩 5'5" (165cm)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" id="iw-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="iw-theme" style="--tool-hue:140;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.06);">
            <div class="output-hero">
                <span class="output-hero-label">CLINICAL AVERAGE IBW</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-avg">68.5</span>
                    <span class="output-hero-unit" id="out-unit">kg</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;">Determining Targets...</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-3">
                    <div class="stat-card" style="border-top: 4px solid #10b981; background: #fff;">
                        <span class="stat-card-label">ROBINSON (1983)</span>
                        <span class="stat-card-value" id="out-rob">68.1 kg</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card" style="border-top: 4px solid #06b6d4; background: #fff;">
                        <span class="stat-card-label">MILLER (1983)</span>
                        <span class="stat-card-value" id="out-mil">67.5 kg</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card" style="border-top: 4px solid #1e293b; background: #fff;">
                        <span class="stat-card-label">DEVINE (1974)</span>
                        <span class="stat-card-value" id="out-dev">69.2 kg</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card" style="border-top: 4px solid #6366f1; background: #fff;">
                        <span class="stat-card-label">HAMWI (1964)</span>
                        <span class="stat-card-value" id="out-ham">70.8 kg</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-microscope text-success me-2"></i>Medical Formula Comparison
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="iw-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Weight Metrics
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="iw-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Assessment
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const genderE = $('iw-gender'), hE = $('iw-height'), frameE = $('iw-frame');
    
    let units = 'metric';

    function calculate(){
        const g = genderE.value;
        const frame = parseFloat(frameE.value) || 1.0;
        let h = parseFloat(hE.value) || 0;
        if(h <= 0) return;

        let h_cm = (units === 'imperial') ? h * 2.54 : h;
        let h_in = h_cm / 2.54;
        let over5ft = Math.max(0, h_in - 60);

        let rob, mil, dev, ham;
        if(g === 'male'){
            rob = 52 + (1.9 * over5ft);
            mil = 56.2 + (1.41 * over5ft);
            dev = 50 + (2.3 * over5ft);
            ham = 48 + (2.7 * over5ft);
        } else {
            rob = 49 + (1.7 * over5ft);
            mil = 53.1 + (1.36 * over5ft);
            dev = 45.5 + (2.3 * over5ft);
            ham = 45.5 + (2.2 * over5ft);
        }

        rob *= frame; mil *= frame; dev *= frame; ham *= frame;

        const avg = (rob + mil + dev + ham) / 4;
        const conv = (units === 'imperial') ? 2.20462 : 1;
        const u = units === 'metric' ? ' kg' : ' lb';

        $('out-avg').textContent = (avg * conv).toFixed(1);
        $('out-unit').textContent = (units === 'metric' ? 'kg' : 'lb');
        
        $('out-rob').textContent = (rob * conv).toFixed(1) + u;
        $('out-mil').textContent = (mil * conv).toFixed(1) + u;
        $('out-dev').textContent = (dev * conv).toFixed(1) + u;
        $('out-ham').textContent = (ham * conv).toFixed(1) + u;

        const theme = $('iw-theme');
        theme.style.setProperty('--tool-hue', 140);
        theme.style.setProperty('--tool-color', '#10b981');

        $('out-status').textContent = 'Healthy Projection';
        $('out-status').style.color = '#10b981';

        // Insights
        const ins = [];
        ins.push(`Average Ideal Weight: <strong>${(avg * conv).toFixed(1)}${u}</strong> based on the standard J.D. Devine formula.`);
        ins.push(`Frame Adjustment: Current target includes a <strong>${(frame * 100 - 100).toFixed(0)}%</strong> modifier for bone structure.`);
        ins.push('Note: Ideal weight formulas determine a target based solely on height and are used as clinical starting points.');

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [genderE, hE, frameE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.unit-toggle').forEach(btn => {
        btn.addEventListener('click', () => {
            if(btn.dataset.unit === units) return;
            units = btn.dataset.unit;
            document.querySelectorAll('.unit-toggle').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const hF = (units === 'metric') ? 2.54 : 1/2.54;
            hE.value = (hE.value * hF).toFixed(1);
            
            document.querySelectorAll('.unit-h').forEach(e => e.textContent = (units==='metric'?'cm':'in'));
            calculate();
        });
    });

    document.querySelectorAll('.iw-preset').forEach(btn => {
        btn.onclick = () => {
             units = 'metric';
             document.querySelectorAll('.unit-toggle').forEach(b => b.classList.toggle('active', b.dataset.unit === 'metric'));
             hE.value = btn.dataset.h;
             calculate();
        };
    });

    $('iw-reset').onclick = () => {
        hE.value = 175; calculate();
    };

    $('iw-copy-btn').onclick = function(){
        const text = `Ideal Body Weight (IBW) Report\nAverage Target: ${$('out-avg').textContent} ${$('out-unit').textContent}\nRobinson: ${$('out-rob').textContent}\nHamwi: ${$('out-ham').textContent}\n— ToolsHub Health`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Results Copied!';
            setTimeout(()=>this.innerHTML=o,2000);
        });
    };

    calculate();
});
</script>

<style>
.iw-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(16,185,129,.05)}
.iw-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.iw-calc-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.iw-calc-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.iw-calc-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.iw-calc-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:1.3rem;font-weight:800;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .iw-calc-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\ideal-weight-calculator.blade.php ENDPATH**/ ?>