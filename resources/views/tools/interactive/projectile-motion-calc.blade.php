<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-4 mb-4" style="background-color:#f8fafc;border:1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-bolt text-warning me-2"></i>Quick Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 pm-ex" data-v="15" data-a="45" data-h="0" data-g="9.81">🏃 Sprinter</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 pm-ex" data-v="45" data-a="30" data-h="1" data-g="9.81">⚾ Baseball</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 pm-ex" data-v="25" data-a="60" data-h="0" data-g="9.81">🏐 Volleyball</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 pm-ex" data-v="50" data-a="45" data-h="0" data-g="1.62">🌙 Moon Shot</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 pm-ex" data-v="100" data-a="75" data-h="10" data-g="9.81">🎯 Long Range</button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Initial Velocity (m/s)</label>
                    <input type="number" id="pm-velocity" class="form-control form-control-lg rounded-3" value="25" step="0.1" min="0" placeholder="e.g. 25">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Launch Angle (°)</label>
                    <input type="number" id="pm-angle" class="form-control form-control-lg rounded-3" value="45" step="0.1" min="0" max="90" placeholder="0 – 90">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Initial Height (m)</label>
                    <input type="number" id="pm-height" class="form-control form-control-lg rounded-3" value="0" step="0.1" min="0" placeholder="e.g. 0">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Gravity (m/s²)</label>
                    <select id="pm-gravity" class="form-select form-select-lg rounded-3">
                        <option value="9.81">🌍 Earth (9.81)</option>
                        <option value="1.62">🌙 Moon (1.62)</option>
                        <option value="3.71">🔴 Mars (3.71)</option>
                        <option value="24.79">🪐 Jupiter (24.79)</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 p-3 rounded-4" style="background:#eff6ff;border:1.5px solid #bfdbfe">
                <p class="mb-0 small text-secondary"><i class="fas fa-info-circle text-primary me-2"></i>
                    <strong>Formulas:</strong> Range = v₀²sin(2θ)/g &nbsp;|&nbsp; Max Height = h₀ + v₀²sin²(θ)/(2g) &nbsp;|&nbsp; Time = (v₀sinθ + √(v₀sinθ)² + 2gh₀) / g
                </p>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div class="card tool-card-stacked shadow-sm border-0" id="pm-result-card">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Trajectory Results</h5>
                        <p class="text-muted small mb-0">Complete projectile motion analysis</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="pm-copy"><i class="fas fa-copy me-1"></i> Copy</button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="alert alert-danger rounded-4 d-none" id="pm-error" role="alert"><i class="fas fa-exclamation-triangle me-2"></i><span id="pm-error-msg"></span></div>

            {{-- Canvas --}}
            <div class="mb-4 rounded-4 overflow-hidden" style="background:#fafbfc;border:1px solid #e5e7eb;position:relative">
                <canvas id="pm-canvas" style="width:100%;height:280px;display:block"></canvas>
            </div>

            {{-- Result Stats --}}
            <div class="row g-3 mb-4">
                <div class="col-md-4 col-6"><div class="stat-card"><span class="stat-card-label">Horizontal Range</span><span class="stat-card-value" id="pm-r-range">0 m</span></div></div>
                <div class="col-md-4 col-6"><div class="stat-card"><span class="stat-card-label">Max Height</span><span class="stat-card-value" id="pm-r-height">0 m</span></div></div>
                <div class="col-md-4 col-6"><div class="stat-card"><span class="stat-card-label">Flight Time</span><span class="stat-card-value" id="pm-r-time">0 s</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Vx (horizontal)</span><span class="stat-card-value" id="pm-r-vx">0 m/s</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Vy (vertical)</span><span class="stat-card-value" id="pm-r-vy">0 m/s</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Impact Speed</span><span class="stat-card-value" id="pm-r-impact">0 m/s</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Time to Peak</span><span class="stat-card-value" id="pm-r-tpeak">0 s</span></div></div>
            </div>

            {{-- Solution Steps --}}
            <div class="p-4 rounded-4 bg-light border">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol text-primary me-2"></i>Solution Steps</h6>
                <div id="pm-steps" class="small text-secondary"></div>
            </div>
        </div>
    </div>
</div>

<style>
.tool-card-stacked{border-radius:24px;background:#fff}
.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}
.btn-light-v2{background:#f1f5f9;border:none;color:#475569;font-weight:600}
.btn-light-v2:hover{background:#e2e8f0;color:#1e293b}
.step-item{padding:.75rem 1rem;background:#fff;border:1px solid #e5e7eb;border-radius:12px;margin-bottom:.5rem}
.step-num{display:inline-flex;width:28px;height:28px;border-radius:50%;background:#3b82f6;color:#fff;align-items:center;justify-content:center;font-weight:800;font-size:.8rem;margin-right:.75rem;flex-shrink:0}
</style>

<script>
document.addEventListener('DOMContentLoaded',function(){
    const vE=document.getElementById('pm-velocity'),aE=document.getElementById('pm-angle'),hE=document.getElementById('pm-height'),gE=document.getElementById('pm-gravity');
    const errDiv=document.getElementById('pm-error'),errMsg=document.getElementById('pm-error-msg');

    function showErr(m){errDiv.classList.remove('d-none');errMsg.textContent=m}
    function hideErr(){errDiv.classList.add('d-none')}
    function f(n){return isFinite(n)?parseFloat(n.toFixed(4)):'—'}

    function calculate(){
        hideErr();
        const v0=parseFloat(vE.value),angleDeg=parseFloat(aE.value),h0=parseFloat(hE.value)||0,g=parseFloat(gE.value)||9.81;

        if(isNaN(v0)||v0<0){showErr('Velocity must be a non-negative number.');return}
        if(isNaN(angleDeg)||angleDeg<0||angleDeg>90){showErr('Angle must be between 0° and 90°.');return}
        if(isNaN(h0)||h0<0){showErr('Initial height must be non-negative.');return}
        if(g<=0){showErr('Gravity must be positive.');return}

        const rad=angleDeg*Math.PI/180;
        const vx=v0*Math.cos(rad);
        const vy=v0*Math.sin(rad);

        // Time of flight: solve h0 + vy*t - 0.5*g*t^2 = 0
        // 0.5g*t^2 - vy*t - h0 = 0 => t = (vy + sqrt(vy^2 + 2*g*h0)) / g
        const disc=vy*vy+2*g*h0;
        let tTotal=0;
        if(disc>=0&&g>0){
            tTotal=(vy+Math.sqrt(disc))/g;
        }
        if(tTotal<0)tTotal=0;

        const range=vx*tTotal;
        const tPeak=vy/g;
        const maxH=h0+(vy*vy)/(2*g);

        // Impact vertical velocity
        const vyImpact=vy-g*tTotal;
        const impactSpeed=Math.sqrt(vx*vx+vyImpact*vyImpact);

        document.getElementById('pm-r-range').textContent=f(range)+' m';
        document.getElementById('pm-r-height').textContent=f(maxH)+' m';
        document.getElementById('pm-r-time').textContent=f(tTotal)+' s';
        document.getElementById('pm-r-vx').textContent=f(vx)+' m/s';
        document.getElementById('pm-r-vy').textContent=f(vy)+' m/s';
        document.getElementById('pm-r-impact').textContent=f(impactSpeed)+' m/s';
        document.getElementById('pm-r-tpeak').textContent=f(tPeak)+' s';

        const steps=[];
        steps.push({text:`<strong>Given:</strong> v₀ = ${v0} m/s, θ = ${angleDeg}°, h₀ = ${h0} m, g = ${g} m/s²`});
        steps.push({text:`<strong>Components:</strong> vx = v₀·cos(θ) = ${f(vx)} m/s, vy = v₀·sin(θ) = ${f(vy)} m/s`});
        steps.push({text:`<strong>Time of flight:</strong> t = (vy + √(vy² + 2gh₀)) / g = (${f(vy)} + √(${f(vy*vy)} + ${f(2*g*h0)})) / ${g} = <strong>${f(tTotal)} s</strong>`});
        steps.push({text:`<strong>Horizontal range:</strong> R = vx × t = ${f(vx)} × ${f(tTotal)} = <strong>${f(range)} m</strong>`});
        steps.push({text:`<strong>Time to peak:</strong> t_peak = vy / g = ${f(vy)} / ${g} = <strong>${f(tPeak)} s</strong>`});
        steps.push({text:`<strong>Max height:</strong> H = h₀ + vy² / (2g) = ${h0} + ${f(vy*vy)} / ${f(2*g)} = <strong>${f(maxH)} m</strong>`});
        steps.push({text:`<strong>Impact speed:</strong> v = √(vx² + vy_impact²) = √(${f(vx*vx)} + ${f(vyImpact*vyImpact)}) = <strong>${f(impactSpeed)} m/s</strong>`});

        document.getElementById('pm-steps').innerHTML=steps.map((s,i)=>`<div class="step-item d-flex align-items-start"><span class="step-num">${i+1}</span><span>${s.text}</span></div>`).join('');

        drawTrajectory(vx,vy,h0,g,tTotal,maxH,range);
    }

    function drawTrajectory(vx,vy,h0,g,tTotal,maxH,range){
        const canvas=document.getElementById('pm-canvas');
        const dpr=window.devicePixelRatio||1;
        const rect=canvas.getBoundingClientRect();
        canvas.width=rect.width*dpr;
        canvas.height=rect.height*dpr;
        const ctx=canvas.getContext('2d');
        ctx.scale(dpr,dpr);
        const W=rect.width,H=rect.height;
        ctx.clearRect(0,0,W,H);

        if(tTotal<=0||range<=0&&maxH<=h0){
            ctx.fillStyle='#94a3b8';ctx.font='14px Inter,sans-serif';ctx.textAlign='center';
            ctx.fillText('No trajectory to display',W/2,H/2);return;
        }

        const pad=50;const plotW=W-2*pad;const plotH=H-2*pad;
        const maxR=Math.max(range,1);const maxHt=Math.max(maxH,h0,1);
        const scX=plotW/maxR;const scY=plotH/maxHt;
        const sc=Math.min(scX,scY);

        // Ground line
        ctx.strokeStyle='#cbd5e1';ctx.lineWidth=1;ctx.setLineDash([4,4]);
        ctx.beginPath();ctx.moveTo(pad,H-pad);ctx.lineTo(W-pad,H-pad);ctx.stroke();ctx.setLineDash([]);

        // Axes labels
        ctx.fillStyle='#94a3b8';ctx.font='11px Inter,sans-serif';ctx.textAlign='center';
        ctx.fillText('Distance (m)',W/2,H-8);
        ctx.save();ctx.translate(12,H/2);ctx.rotate(-Math.PI/2);ctx.fillText('Height (m)',0,0);ctx.restore();

        // Trajectory curve
        ctx.beginPath();ctx.strokeStyle='#3b82f6';ctx.lineWidth=3;
        const N=150;
        for(let i=0;i<=N;i++){
            const t=tTotal*i/N;
            const x=vx*t;
            const y=h0+vy*t-0.5*g*t*t;
            const px=pad+x*sc;
            const py=H-pad-y*sc;
            if(i===0)ctx.moveTo(px,py);else ctx.lineTo(px,py);
        }
        ctx.stroke();

        // Start point
        ctx.fillStyle='#10b981';ctx.beginPath();ctx.arc(pad,H-pad-h0*sc,5,0,Math.PI*2);ctx.fill();
        // End point
        ctx.fillStyle='#ef4444';ctx.beginPath();ctx.arc(pad+range*sc,H-pad,5,0,Math.PI*2);ctx.fill();
        // Peak point
        const tP=vy/g;const peakX=vx*tP;const peakY=maxH;
        ctx.fillStyle='#f59e0b';ctx.beginPath();ctx.arc(pad+peakX*sc,H-pad-peakY*sc,5,0,Math.PI*2);ctx.fill();

        // Labels
        ctx.fillStyle='#1e293b';ctx.font='bold 11px Inter,sans-serif';ctx.textAlign='center';
        ctx.fillText(f(range)+' m',pad+range*sc,H-pad+16);
        ctx.fillText(f(maxH)+' m',pad+peakX*sc,H-pad-peakY*sc-10);
    }

    function f(n){return isFinite(n)?parseFloat(n.toFixed(2)):'—'}

    [vE,aE,hE].forEach(el=>el.addEventListener('input',calculate));
    gE.addEventListener('change',calculate);

    document.querySelectorAll('.pm-ex').forEach(btn=>{btn.addEventListener('click',()=>{
        vE.value=btn.dataset.v;aE.value=btn.dataset.a;hE.value=btn.dataset.h;gE.value=btn.dataset.g;calculate();
    })});

    document.getElementById('pm-reset').addEventListener('click',()=>{vE.value=25;aE.value=45;hE.value=0;gE.value='9.81';calculate()});

    document.getElementById('pm-copy').addEventListener('click',function(){
        const t=`Projectile Motion Results\n${'='.repeat(30)}\nVelocity: ${vE.value} m/s\nAngle: ${aE.value}°\nHeight: ${hE.value} m\nGravity: ${gE.value} m/s²\n\nRange: ${document.getElementById('pm-r-range').textContent}\nMax Height: ${document.getElementById('pm-r-height').textContent}\nFlight Time: ${document.getElementById('pm-r-time').textContent}\nImpact Speed: ${document.getElementById('pm-r-impact').textContent}\n\nGenerated via ToolsHub`;
        navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });

    window.addEventListener('resize',calculate);
    calculate();
});
</script>
