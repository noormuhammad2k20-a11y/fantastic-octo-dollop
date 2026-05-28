<div class="row g-3 reynolds-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-2">
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label-custom">Fluid Medium Preset</label>
                        <select id="rey-preset" class="form-select form-select-sm">
                            <option value="water" selected>💧 Water (20°C)</option>
                            <option value="air">🌬️ Air (20°C)</option>
                            <option value="oil">🛢️ Engine Oil (20°C)</option>
                            <option value="custom">⚙️ Custom Parameters</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label-custom">Flow Velocity ($v$, m/s)</label>
                        <input type="number" id="rey-velocity" class="form-control form-control-sm" value="1.5" min="0.001" step="any">
                    </div>
                    <div class="col-md-6 col-sm-12 mt-2">
                        <label class="form-label-custom">Internal Pipe Diameter ($D$, m)</label>
                        <input type="number" id="rey-diameter" class="form-control form-control-sm" value="0.05" min="0.0001" step="any">
                    </div>
                    <div class="col-md-6 col-sm-12 mt-2">
                        <label class="form-label-custom">Fluid Density ($\rho$, kg/m³)</label>
                        <input type="number" id="rey-density" class="form-control form-control-sm" value="998.2" min="0.01" step="any" readonly>
                    </div>
                    <div class="col-md-6 col-sm-12 mt-2" id="rey-visc-container">
                        <label class="form-label-custom">Dynamic Viscosity ($\mu$, Pa·s)</label>
                        <input type="number" id="rey-viscosity" class="form-control form-control-sm" value="0.001002" min="0.0000001" step="any" readonly>
                    </div>
                </div>

                
                <div class="mt-3 d-flex flex-wrap gap-1.5 align-items-center">
                    <span class="fw-bold text-xxs text-slate-400 text-uppercase tracking-wider me-1"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 rey-quick text-xxs" data-v="0.1" data-d="0.02" data-p="water">💧 Laminar Water (20mm pipe)</button>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 rey-quick text-xxs" data-v="8.0" data-d="0.15" data-p="air">🌬️ Turbulent Air (150mm duct)</button>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 rey-quick text-xxs" data-v="0.5" data-d="0.05" data-p="oil">🛢️ Viscous Oil Flow</button>
                    <button type="button" class="btn btn-xs btn-outline-danger rounded-pill px-2.5 text-xxs ms-auto" id="rey-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:210;--tool-color:#3b82f6;--tool-bg:rgba(59, 130, 246, 0.03);">
            <div class="output-hero py-3">
                <span class="output-hero-label text-xxs text-uppercase tracking-widest text-slate-500">Calculated Reynolds Number</span>
                <div class="output-hero-value text-xl font-bold tracking-tight my-1" id="out-rey-val" style="color:#3b82f6;">—</div>
                <div class="text-xs text-slate-500" id="out-rey-regime">—</div>
            </div>

            <div class="row g-2 mt-2">
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Kinematic Visc ($\nu$)</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-rey-kinematic">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Flow State</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-rey-state">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Critical Velocity</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-rey-critical">—</span>
                    </div>
                </div>
            </div>

            
            <div class="mt-3 p-3 bg-light rounded-3 border text-center">
                <h6 class="fw-bold mb-2 text-xs text-uppercase tracking-wider text-slate-600 text-left"><i class="fas fa-wind me-1"></i>Streamline Flow Dynamics</h6>
                <div class="d-flex align-items-center justify-content-center bg-white rounded border overflow-hidden position-relative" style="height:90px;">
                    <canvas id="rey-flow-canvas" style="width: 100%; height: 100%; display: block;"></canvas>
                    <span class="text-xxs absolute bottom-1 right-2 font-mono opacity-50 text-slate-500" id="rey-flow-lbl">Streamline view</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-3 py-2 px-4 text-sm fw-bold rounded-pill shadow-sm" id="rey-copy" style="min-width: 240px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Flow Analysis</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);

    const presetEl=$('rey-preset');
    const velocityEl=$('rey-velocity');
    const diameterEl=$('rey-diameter');
    const densityEl=$('rey-density');
    const viscosityEl=$('rey-viscosity');
    const canvas = $('rey-flow-canvas');
    const ctx = canvas.getContext('2d');

    const fluidProps = {
        water: { rho: 998.2, mu: 0.001002 },
        air: { rho: 1.204, mu: 0.0000181 },
        oil: { rho: 880, mu: 0.29 },
    };

    let animId = null;
    let offset = 0;

    function initCanvas() {
        const dpr = window.devicePixelRatio || 1;
        const rect = canvas.getBoundingClientRect();
        canvas.width = rect.width * dpr;
        canvas.height = rect.height * dpr;
        ctx.scale(dpr, dpr);
    }

    function calculate(){
        const preset = presetEl.value;
        let rho, mu;

        if (preset === 'custom') {
            densityEl.removeAttribute('readonly');
            viscosityEl.removeAttribute('readonly');
            rho = parseFloat(densityEl.value) || 1000;
            mu = parseFloat(viscosityEl.value) || 0.001;
        } else {
            densityEl.setAttribute('readonly', 'true');
            viscosityEl.setAttribute('readonly', 'true');
            rho = fluidProps[preset].rho;
            mu = fluidProps[preset].mu;
            densityEl.value = rho;
            viscosityEl.value = mu;
        }

        const v = parseFloat(velocityEl.value) || 0;
        const D = parseFloat(diameterEl.value) || 0;

        if (v <= 0 || D <= 0) return;

        // Re = (rho * v * D) / mu
        const Re = (rho * v * D) / mu;
        const nu = mu / rho; // kinematic viscosity

        // Critical velocity for turbulence (Re = 4000)
        const v_crit = (4000 * mu) / (rho * D);

        // Classify regime
        let regime = "";
        let regimeColor = "";
        let badgeClass = "";
        let desc = "";

        if (Re < 2300) {
            regime = "Laminar Flow";
            regimeColor = "#059669";
            badgeClass = "bg-success";
            desc = "Orderly, parallel fluid streams with zero cross-mixing.";
        } else if (Re < 4000) {
            regime = "Transitional Flow";
            regimeColor = "#d97706";
            badgeClass = "bg-warning text-dark";
            desc = "Unstable flow transition with occasional eddy currents.";
        } else {
            regime = "Turbulent Flow";
            regimeColor = "#dc2626";
            badgeClass = "bg-danger";
            desc = "Chaotic vortex loops, high turbulence, and random eddy mix.";
        }

        // Displays
        $('out-rey-val').textContent = Re.toLocaleString(undefined, {maximumFractionDigits: 0});
        $('out-rey-val').style.color = regimeColor;
        $('out-rey-regime').innerHTML = `<span class="badge ${badgeClass} text-xxs px-2 py-0.5 rounded-pill">${regime}</span>`;

        $('out-rey-kinematic').textContent = nu.toExponential(3) + ' m²/s';
        $('out-rey-state').textContent = Re < 2300 ? 'Orderly' : Re < 4000 ? 'Unstable' : 'Chaotic';
        $('out-rey-critical').textContent = v_crit.toFixed(3) + ' m/s';

        // Draw Streamlines animation
        startFlowAnimation(Re);
    }

    function startFlowAnimation(Re) {
        if (animId) cancelAnimationFrame(animId);

        const rect = canvas.getBoundingClientRect();
        const w = rect.width;
        const h = rect.height;

        // Initialize particles
        const particles = [];
        const count = 20;
        for (let i = 0; i < count; i++) {
            particles.push({
                x: Math.random() * w,
                y: 15 + Math.random() * (h - 30),
                v: 1 + Math.random() * 1.5
            });
        }

        function draw() {
            ctx.clearRect(0, 0, w, h);
            ctx.lineWidth = 1.25;

            // Background pipe walls
            ctx.strokeStyle = '#e2e8f0';
            ctx.beginPath();
            ctx.moveTo(0, 5); ctx.lineTo(w, 5);
            ctx.moveTo(0, h - 5); ctx.lineTo(w, h - 5);
            ctx.stroke();

            // Set stroke color based on turbulence
            ctx.strokeStyle = Re < 2300 ? '#3b82f6' : Re < 4000 ? '#ea580c' : '#dc2626';

            particles.forEach(p => {
                ctx.beginPath();
                ctx.moveTo(p.x, p.y);
                
                let curX = p.x;
                let curY = p.y;
                const segments = 25;
                const segLen = w / segments;

                for (let j = 0; j < segments; j++) {
                    curX += segLen;
                    
                    if (Re >= 2300 && Re < 4000) {
                        curY += Math.sin(curX * 0.05 + offset) * 0.4;
                    } else if (Re >= 4000) {
                        curY += Math.sin(curX * 0.15 + offset * 2) * 1.5 + (Math.random() - 0.5) * 1.5;
                    }
                    curY = Math.max(8, Math.min(h - 8, curY));
                    ctx.lineTo(curX, curY);
                }
                ctx.stroke();

                p.x += p.v;
                if (p.x > w) {
                    p.x = -w * 0.3;
                    p.y = 15 + Math.random() * (h - 30);
                }
            });

            offset += Re < 2300 ? 0.05 : Re < 4000 ? 0.15 : 0.4;
            animId = requestAnimationFrame(draw);
        }

        draw();
    }

    presetEl.addEventListener('change', calculate);
    [velocityEl, diameterEl, densityEl, viscosityEl].forEach(el=>{
        el.addEventListener('input', calculate);
    });

    // Presets quick select
    document.querySelectorAll('.rey-quick').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            presetEl.value = btn.dataset.p;
            velocityEl.value = btn.dataset.v;
            diameterEl.value = btn.dataset.d;
            calculate();
        });
    });

    $('rey-reset').addEventListener('click', ()=>{
        presetEl.value = 'water';
        velocityEl.value = 1.5;
        diameterEl.value = 0.05;
        calculate();
    });

    $('rey-copy').addEventListener('click', function(){
        const text = `Reynolds Flow Report\nVelocity: ${velocityEl.value} m/s\nPipe Diameter: ${diameterEl.value} m\nFluid Preset: ${presetEl.options[presetEl.selectedIndex].text}\nReynolds Number: ${$('out-rey-val').textContent}\nRegime: ${$('out-rey-regime').textContent.trim()}\n— ToolsHub Fluids`;
        navigator.clipboard.writeText(text).then(()=>{
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    window.addEventListener('resize', initCanvas);
    initCanvas();
    calculate();
});
</script>

<style>
.reynolds-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1.25rem;
}
.reynolds-rebuilt .calculator-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.25rem;
}
.reynolds-rebuilt .tool-icon-circle {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.reynolds-rebuilt .form-label-custom {
    font-size: 0.75rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 0.25rem;
    display: block;
}
.reynolds-rebuilt .btn-xs {
    padding: 0.25rem 0.5rem;
    font-size: 0.7rem;
    border-radius: 9999px;
}
.reynolds-rebuilt .text-xxs {
    font-size: 0.65rem;
}
.reynolds-rebuilt .text-xxs.tracking-wider {
    letter-spacing: 0.05em;
}
.reynolds-rebuilt .stat-card {
    transition: transform 0.2s;
}
.reynolds-rebuilt .stat-card:hover {
    transform: translateY(-1px);
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\reynolds-number-calc.blade.php ENDPATH**/ ?>