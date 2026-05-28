<div class="row g-4 rad-to-deg-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Radians (rad)</label>
                        <div class="input-group input-group-lg">
                            <input type="number" id="rad-input" class="form-control" placeholder="e.g. 1" value="1" step="any">
                            <span class="input-group-text bg-light font-monospace">rad</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2 flex-wrap">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill rad-quick" data-val="3.14159">π (PI)</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill rad-quick" data-val="1.5708">π/2</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill rad-quick" data-val="0.7854">π/4</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill rad-quick" data-val="6.2832">2π</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:300;--tool-color:#c026d3;--tool-bg:rgba(217,70,239,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Degrees (°)</span>
                <div class="output-hero-value" id="out-degree">57.2958°</div>
                <div class="mt-2 text-muted fw-bold" id="out-meta">DMS: 57° 17' 44"</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Radians with π</span><span class="stat-card-value" id="out-pi">—</span></div></div>
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Rotation</span><span class="stat-card-value" id="out-rotation">—</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-shapes me-2 text-fuchsia"></i>Angle Visualization</h6>
            <div class="text-center p-4 bg-white border rounded-3">
                <div id="angle-viz" style="width: 120px; height: 120px; border: 4px solid #f1f5f9; border-radius: 50%; margin: 0 auto; position: relative; background: #fafafa;">
                    <div id="angle-hand" style="width: 2px; height: 50px; background: #c026d3; position: absolute; left: 59px; bottom: 60px; transform-origin: bottom center; transform: rotate(0deg); transition: transform 0.3s ease;"></div>
                </div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Degrees</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('rad-input');
    const outDeg = document.getElementById('out-degree');
    const outMeta = document.getElementById('out-meta');
    const outPi = document.getElementById('out-pi');
    const outRot = document.getElementById('out-rotation');
    const angleHand = document.getElementById('angle-hand');

    function calculate(){
        const rad = parseFloat(input.value);
        if(isNaN(rad)){
            outDeg.textContent = '—';
            outMeta.textContent = '—';
            outPi.textContent = '—';
            outRot.textContent = '—';
            angleHand.style.transform = `rotate(0deg)`;
            return;
        }

        const deg = rad * (180 / Math.PI);
        const piVal = (rad / Math.PI).toFixed(4).replace(/\.?0+$/, '');
        const rot = (rad / (2 * Math.PI)).toFixed(4).replace(/\.?0+$/, '');

        // DMS calculation
        const d = Math.floor(deg);
        const m = Math.floor((deg - d) * 60);
        const s = Math.round(((deg - d) * 60 - m) * 60);

        outDeg.textContent = deg.toFixed(4) + '°';
        outMeta.textContent = `DMS: ${d}° ${m}' ${s}"`;
        outPi.textContent = piVal + 'π';
        outRot.textContent = rot + ' Rotations';
        
        // CSS rotation (3 o'clock is 0 in unit circle, but CSS rotate 0 is 12 o'clock)
        // We adjust to match conventional math visualization (0 rad = horizontal right)
        // In CSS rotate, 90deg is horizontal right. So we subtract the degrees from 90.
        angleHand.style.transform = `rotate(${-deg + 90}deg)`;
    }

    input.addEventListener('input', calculate);

    document.querySelectorAll('.rad-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            input.value = btn.dataset.val;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        if(outDeg.textContent === '—') return;
        navigator.clipboard.writeText(outDeg.textContent);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.rad-to-deg-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.rad-to-deg-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.rad-to-deg-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.rad-to-deg-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.rad-to-deg-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.rad-to-deg-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.rad-to-deg-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.rad-to-deg-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.rad-to-deg-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.rad-to-deg-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

.rad-to-deg-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; }
.rad-to-deg-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.rad-to-deg-rebuilt .stat-card-value { font-size: 1.15rem; font-weight: 700; color: #1e293b; }

@media (max-width: 768px) {
    .rad-to-deg-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\radian-to-degree-converter.blade.php ENDPATH**/ ?>