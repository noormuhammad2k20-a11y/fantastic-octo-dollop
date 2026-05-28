<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Race Distance</label>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-outline-tri active flex-grow-1" data-race="sprint">🏅 Sprint</button>
                        <button type="button" class="btn btn-outline-tri flex-grow-1" data-race="olympic">🏅 Olympic</button>
                        <button type="button" class="btn btn-outline-tri flex-grow-1" data-race="70.3">🏅 Half Ironman</button>
                        <button type="button" class="btn btn-outline-tri flex-grow-1" data-race="140.6">🏅 Full Ironman</button>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">🏊 Swim Pace (/100m)</label>
                        <div class="input-group"><input type="number" id="tri-sw-min" class="form-control form-control-lg" value="2" min="0"><span class="input-group-text bg-light fw-bold">:</span><input type="number" id="tri-sw-sec" class="form-control form-control-lg" value="0" min="0" max="59"></div>
                    </div>
                    <div class="col-md-6"><label class="form-label-custom">🚴 Bike Speed (km/h)</label><input type="number" id="tri-bike" class="form-control form-control-lg rounded-3" value="30" step="0.5" min="1"></div>
                    <div class="col-md-6"><label class="form-label-custom">🏃 Run Pace (/km)</label>
                        <div class="input-group"><input type="number" id="tri-run-min" class="form-control form-control-lg" value="5" min="0"><span class="input-group-text bg-light fw-bold">:</span><input type="number" id="tri-run-sec" class="form-control form-control-lg" value="30" min="0" max="59"></div>
                    </div>
                    <div class="col-md-3"><label class="form-label-custom">T1 (min)</label><input type="number" id="tri-t1" class="form-control form-control-lg rounded-3" value="4" min="0"></div>
                    <div class="col-md-3"><label class="form-label-custom">T2 (min)</label><input type="number" id="tri-t2" class="form-control form-control-lg rounded-3" value="3" min="0"></div>
                </div>
                <div class="mt-3 p-3 bg-light rounded-3 border small text-secondary" id="tri-dist-summary"><i class="fas fa-route text-warning me-1"></i> Sprint: 750m Swim, 20km Bike, 5km Run</div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:25;--tool-color:#c2410c;--tool-bg:rgba(234,88,12,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Total Estimated Time</span>
                <div class="output-hero-value" id="out-tri-total">1h 22m</div>
                <span class="output-hero-unit" id="out-tri-race-label">Sprint Triathlon</span>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>Time by Segment</h6>
            <div class="d-flex flex-column gap-2">
                <div class="segment-bar d-flex align-items-center p-3 rounded-3" style="background:#eff6ff;border-left:5px solid #3b82f6">
                    <i class="fas fa-person-swimming me-3 fs-5" style="color:#3b82f6"></i>
                    <div class="flex-grow-1"><div class="fw-bold">Swim</div><div class="small text-muted" id="out-tri-s-dist">750m</div></div>
                    <div class="fw-bold fs-5" id="out-tri-swim">15:00</div>
                </div>
                <div class="segment-bar d-flex align-items-center p-3 rounded-3" style="background:#f0fdf4;border-left:5px solid #22c55e">
                    <i class="fas fa-person-biking me-3 fs-5" style="color:#22c55e"></i>
                    <div class="flex-grow-1"><div class="fw-bold">Bike</div><div class="small text-muted" id="out-tri-b-dist">20km</div></div>
                    <div class="fw-bold fs-5" id="out-tri-bike">40:00</div>
                </div>
                <div class="segment-bar d-flex align-items-center p-3 rounded-3" style="background:#fffbeb;border-left:5px solid #f59e0b">
                    <i class="fas fa-person-running me-3 fs-5" style="color:#f59e0b"></i>
                    <div class="flex-grow-1"><div class="fw-bold">Run</div><div class="small text-muted" id="out-tri-r-dist">5km</div></div>
                    <div class="fw-bold fs-5" id="out-tri-run">27:30</div>
                </div>
                <div class="segment-bar d-flex align-items-center p-3 rounded-3" style="background:#f8fafc;border-left:5px solid #94a3b8">
                    <i class="fas fa-arrows-rotate me-3 fs-5" style="color:#94a3b8"></i>
                    <div class="flex-grow-1"><div class="fw-bold">Transitions</div><div class="small text-muted">T1 + T2</div></div>
                    <div class="fw-bold fs-5" id="out-tri-trans">7:00</div>
                </div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-pie me-2 text-primary"></i>Time Distribution</h6>
            <div class="progress rounded-pill mb-2" style="height:28px;background:#f1f5f9" id="out-tri-stacked">
                <div class="progress-bar" style="background:#3b82f6" id="out-tri-bar-s">S</div>
                <div class="progress-bar" style="background:#22c55e" id="out-tri-bar-b">B</div>
                <div class="progress-bar" style="background:#f59e0b" id="out-tri-bar-r">R</div>
                <div class="progress-bar" style="background:#94a3b8" id="out-tri-bar-t">T</div>
            </div>

            <div class="mt-4" id="out-tri-insights"></div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="tri-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Race Plan</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    let currentRace='sprint';
    const raceConfig={
        sprint:{swim:750,bike:20,run:5,label:'Sprint Triathlon'},
        olympic:{swim:1500,bike:40,run:10,label:'Olympic Triathlon'},
        '70.3':{swim:1900,bike:90,run:21.1,label:'Half Ironman (70.3)'},
        '140.6':{swim:3800,bike:180,run:42.2,label:'Full Ironman (140.6)'}
    };

    function fmtT(mins){const h=Math.floor(mins/60),m=Math.floor(mins%60),s=Math.round((mins*60)%60);return h>0?`${h}:${m.toString().padStart(2,'0')}:${s.toString().padStart(2,'0')}`:`${m}:${s.toString().padStart(2,'0')}`;}
    function fmtTotal(mins){const h=Math.floor(mins/60),m=Math.round(mins%60);return h>0?`${h}h ${m}m`:`${m}m`;}

    function calculate(){
        const c=raceConfig[currentRace];
        $('out-tri-race-label').textContent=c.label;
        $('tri-dist-summary').innerHTML=`<i class="fas fa-route text-warning me-1"></i> ${c.label}: ${c.swim>=1000?(c.swim/1000).toFixed(1)+'km':c.swim+'m'} Swim, ${c.bike}km Bike, ${c.run}km Run`;
        $('out-tri-s-dist').textContent=c.swim>=1000?(c.swim/1000).toFixed(1)+'km':c.swim+'m';
        $('out-tri-b-dist').textContent=c.bike+'km';
        $('out-tri-r-dist').textContent=c.run+'km';

        const sPace=(parseInt($('tri-sw-min').value)||0)+((parseInt($('tri-sw-sec').value)||0)/60);
        const sTime=(c.swim/100)*sPace;
        const bSpeed=parseFloat($('tri-bike').value)||1;
        const bTime=(c.bike/bSpeed)*60;
        const rPace=(parseInt($('tri-run-min').value)||0)+((parseInt($('tri-run-sec').value)||0)/60);
        const rTime=c.run*rPace;
        const t1=parseFloat($('tri-t1').value)||0, t2=parseFloat($('tri-t2').value)||0;
        const trans=t1+t2;
        const total=sTime+bTime+rTime+trans;

        $('out-tri-total').textContent=fmtTotal(total);
        $('out-tri-swim').textContent=fmtT(sTime);
        $('out-tri-bike').textContent=fmtT(bTime);
        $('out-tri-run').textContent=fmtT(rTime);
        $('out-tri-trans').textContent=fmtT(trans);

        // Stacked bar
        const sp=sTime/total*100, bp=bTime/total*100, rp=rTime/total*100, tp=trans/total*100;
        $('out-tri-bar-s').style.width=sp+'%';$('out-tri-bar-s').textContent=Math.round(sp)+'%';
        $('out-tri-bar-b').style.width=bp+'%';$('out-tri-bar-b').textContent=Math.round(bp)+'%';
        $('out-tri-bar-r').style.width=rp+'%';$('out-tri-bar-r').textContent=Math.round(rp)+'%';
        $('out-tri-bar-t').style.width=tp+'%';$('out-tri-bar-t').textContent=Math.round(tp)+'%';

        const longest=bTime>rTime?(bTime>sTime?'Bike':'Swim'):(rTime>sTime?'Run':'Swim');
        $('out-tri-insights').innerHTML=`<h6 class="fw-bold mb-3"><i class="fas fa-bolt me-2 text-warning"></i>Race Analysis</h6><ul class="list-unstyled mb-0 small text-secondary"><li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Longest segment: <strong>${longest}</strong> (${longest==='Bike'?Math.round(bp):longest==='Run'?Math.round(rp):Math.round(sp)}% of total time)</li><li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Transitions: <strong>${Math.round(tp)}%</strong> of total — fast transitions save valuable minutes!</li><li><i class="fas fa-check-circle text-success me-2"></i>Pacing strategy: Aim for negative splits on the run (faster 2nd half).</li></ul>`;
    }

    document.querySelectorAll('[data-race]').forEach(btn=>{btn.addEventListener('click',()=>{currentRace=btn.dataset.race;document.querySelectorAll('[data-race]').forEach(b=>b.classList.remove('active'));btn.classList.add('active');calculate()})});
    ['tri-sw-min','tri-sw-sec','tri-bike','tri-run-min','tri-run-sec','tri-t1','tri-t2'].forEach(id=>$(id).addEventListener('input',calculate));

    $('tri-copy').addEventListener('click',function(){
        const text=`Triathlon Race Plan (${currentRace.toUpperCase()})\nTotal: ${$('out-tri-total').textContent}\nSwim: ${$('out-tri-swim').textContent} | Bike: ${$('out-tri-bike').textContent} | Run: ${$('out-tri-run').textContent}\n— ToolsHub Performance`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });
    calculate();
});
</script>
<style>
.tri-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.tri-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.tri-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.tri-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.tri-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.tri-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.btn-outline-tri{border:1.5px solid #fed7aa;color:#c2410c;font-weight:600;border-radius:12px;padding:.6rem .75rem;transition:all .2s;font-size:.85rem}
.btn-outline-tri:hover{background:#fff7ed;color:#ea580c;border-color:#fb923c}
.btn-outline-tri.active{background:#ea580c;color:#fff;border-color:#ea580c;box-shadow:0 4px 14px rgba(234,88,12,.2)}
.segment-bar{transition:transform .2s}.segment-bar:hover{transform:translateX(4px)}
</style>

