<div class="row g-4 swim-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Total Distance</label>
                        <div class="input-group"><input type="number" id="sw-dist" class="form-control form-control-lg rounded-start-3" value="1500" min="25" step="25"><select id="sw-unit" class="form-select rounded-end-3" style="max-width:90px"><option value="m">m</option><option value="yd">yd</option></select></div>
                    </div>
                    <div class="col-md-4"><label class="form-label-custom">Time (Minutes)</label><input type="number" id="sw-min" class="form-control form-control-lg rounded-3" value="25" min="0"></div>
                    <div class="col-md-4"><label class="form-label-custom">Time (Seconds)</label><input type="number" id="sw-sec" class="form-control form-control-lg rounded-3" value="0" min="0" max="59"></div>
                    <div class="col-md-4"><label class="form-label-custom">Stroke Type</label><select id="sw-stroke" class="form-select form-select-lg rounded-3"><option value="freestyle">Freestyle</option><option value="backstroke">Backstroke</option><option value="breaststroke">Breaststroke</option><option value="butterfly">Butterfly</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Pool Length</label><select id="sw-pool" class="form-select form-select-lg rounded-3"><option value="25">25m (Short Course)</option><option value="50">50m (Long Course)</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Strokes/Length <span class="text-muted small">(SWOLF)</span></label><input type="number" id="sw-spl" class="form-control form-control-lg rounded-3" placeholder="e.g. 20" min="5" max="60"></div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick:</span>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 sw-quick" data-d="100" data-m="1" data-s="30">🏊 100m Sprint</button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 sw-quick" data-d="400" data-m="7" data-s="0">🏊 400m</button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 sw-quick" data-d="1500" data-m="25" data-s="0">🏊 1500m</button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 sw-quick" data-d="3000" data-m="55" data-s="0">🏊 3000m</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:199;--tool-color:#0369a1;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero">
                <span class="output-hero-label" id="out-sw-label">Pace per 100m</span>
                <div class="output-hero-value" id="out-sw-pace">1:40</div>
                <span class="output-hero-unit">minutes per 100 units</span>
            </div>
            <div class="row g-3 mt-3">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Speed</span><span class="stat-card-value" id="out-sw-speed">3.6 km/h</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Total Time</span><span class="stat-card-value" id="out-sw-total">25:00</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Laps</span><span class="stat-card-value" id="out-sw-laps">30</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card" style="border-color:#ef4444"><span class="stat-card-label">Est. Calories</span><span class="stat-card-value text-danger" id="out-sw-cal">—</span></div></div>
            </div>

            <div class="row g-3 mt-3" id="out-sw-swolf-wrap" style="display:none">
                <div class="col-12"><div class="stat-card" style="border-color:#8b5cf6"><span class="stat-card-label">SWOLF Score (lower = better)</span><span class="stat-card-value" style="color:#8b5cf6" id="out-sw-swolf">—</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-table me-2 text-primary"></i>Split Table</h6>
            <div class="table-responsive"><table class="table table-sm table-bordered text-center small mb-0" id="out-sw-splits"><thead class="table-light"><tr><th>Split</th><th>Time</th><th>Cumulative</th></tr></thead><tbody></tbody></table></div>

            <div class="mt-4" id="out-sw-insights"></div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="sw-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Pace Data</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const distEl=$('sw-dist'),unitEl=$('sw-unit'),minEl=$('sw-min'),secEl=$('sw-sec'),strokeEl=$('sw-stroke'),poolEl=$('sw-pool'),splEl=$('sw-spl');
    const metByStroke={freestyle:8,backstroke:7,breaststroke:8.5,butterfly:10};

    function fmtT(s){const m=Math.floor(s/60),sec=Math.round(s%60);return `${m}:${sec.toString().padStart(2,'0')}`;}

    function calculate(){
        const dist=parseFloat(distEl.value)||0, u=unitEl.value;
        const totalSecs=(parseInt(minEl.value)||0)*60+(parseInt(secEl.value)||0);
        const pool=parseInt(poolEl.value)||25, spl=parseInt(splEl.value)||0;
        const stroke=strokeEl.value;
        $('out-sw-label').textContent=`Pace per 100${u}`;

        if(dist<=0||totalSecs<=0) return;
        const pacePerUnit=totalSecs/dist;
        const pace100=pacePerUnit*100;
        const speedMps=dist/(u==='yd'?1.0936:1)/totalSecs;
        const speedKph=(speedMps*3.6).toFixed(1);
        const laps=Math.ceil(dist/pool);
        const calPerMin=metByStroke[stroke]*75/60;// rough 75kg estimate
        const calories=Math.round(calPerMin*(totalSecs/60));

        $('out-sw-pace').textContent=fmtT(pace100);
        $('out-sw-speed').textContent=speedKph+' km/h';
        $('out-sw-total').textContent=fmtT(totalSecs);
        $('out-sw-laps').textContent=laps;
        $('out-sw-cal').textContent=calories;

        // SWOLF
        if(spl>0){
            const timePerPool=totalSecs/laps;
            const swolf=Math.round(timePerPool+spl);
            $('out-sw-swolf').textContent=swolf;
            $('out-sw-swolf-wrap').style.display='';
        } else {
            $('out-sw-swolf-wrap').style.display='none';
        }

        // Splits
        const splitMarks=[50,100,200,400,800,1000,1500].filter(m=>m<=dist);
        $('out-sw-splits').querySelector('tbody').innerHTML=splitMarks.map(m=>{
            return `<tr><td>${m}${u}</td><td class="fw-bold">${fmtT(pacePerUnit*m)}</td><td>${fmtT(pacePerUnit*m)}</td></tr>`;
        }).join('');

        $('out-sw-insights').innerHTML=`<h6 class="fw-bold mb-3"><i class="fas fa-stopwatch me-2 text-primary"></i>Assessment</h6><ul class="list-unstyled mb-0 small text-secondary"><li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Goal Pace: <strong>${fmtT(pace100)} / 100${u}</strong></li><li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Avg Speed: <strong>${speedKph} km/h</strong></li><li><i class="fas fa-check-circle text-success me-2"></i>Consistent pacing is key — negative splits (faster second half) are ideal for races.</li></ul>`;
    }

    [distEl,unitEl,minEl,secEl,strokeEl,poolEl,splEl].forEach(e=>e.addEventListener('input',calculate));
    document.querySelectorAll('.sw-quick').forEach(btn=>{btn.addEventListener('click',()=>{distEl.value=btn.dataset.d;minEl.value=btn.dataset.m;secEl.value=btn.dataset.s;calculate()})});
    $('sw-copy').addEventListener('click',function(){
        const text=`Swimming Pace Report\nDistance: ${distEl.value}${unitEl.value}\nTime: ${$('out-sw-total').textContent}\nPace: ${$('out-sw-pace').textContent}/100${unitEl.value}\n— ToolsHub Aquatic`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });
    calculate();
});
</script>
<style>
.swim-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.swim-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.swim-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.swim-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.swim-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.swim-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\swimming-pace-calculator.blade.php ENDPATH**/ ?>