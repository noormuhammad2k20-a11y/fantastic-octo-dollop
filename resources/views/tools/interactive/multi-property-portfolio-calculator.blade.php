<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-3 mb-4" style="background:#f8fafc;border:1.5px solid #e2e8f0">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-bolt text-warning me-2"></i>Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 mp-quick" data-p="1">Overleveraged (2 Props)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 mp-quick" data-p="2">Stabilized Vet (3 Props)</button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-3 rounded-3 bg-light border">
                        <h6 class="fw-bold small text-uppercase text-muted mb-3" style="letter-spacing:1px">Property 1</h6>
                        <label class="form-label small fw-bold text-secondary mb-1">Asset Value ($)</label>
                        <input type="number" id="p1-val" class="form-control mb-2 mp-in" value="450000" step="1000">
                        <label class="form-label small fw-bold text-secondary mb-1">Remaining Debt ($)</label>
                        <input type="number" id="p1-debt" class="form-control mb-2 mp-in" value="300000" step="1000">
                        <label class="form-label small fw-bold text-secondary mb-1">Monthly NOI ($)</label>
                        <input type="number" id="p1-noi" class="form-control mp-in" value="2500" step="50">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-3 bg-light border">
                        <h6 class="fw-bold small text-uppercase text-muted mb-3" style="letter-spacing:1px">Property 2</h6>
                        <label class="form-label small fw-bold text-secondary mb-1">Asset Value ($)</label>
                        <input type="number" id="p2-val" class="form-control mb-2 mp-in" value="800000" step="1000">
                        <label class="form-label small fw-bold text-secondary mb-1">Remaining Debt ($)</label>
                        <input type="number" id="p2-debt" class="form-control mb-2 mp-in" value="650000" step="1000">
                        <label class="form-label small fw-bold text-secondary mb-1">Monthly NOI ($)</label>
                        <input type="number" id="p2-noi" class="form-control mp-in" value="4800" step="50">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-3 bg-light border">
                        <h6 class="fw-bold small text-uppercase text-muted mb-3" style="letter-spacing:1px">Property 3 (Optional)</h6>
                        <label class="form-label small fw-bold text-secondary mb-1">Asset Value ($)</label>
                        <input type="number" id="p3-val" class="form-control mb-2 mp-in" value="0" step="1000">
                        <label class="form-label small fw-bold text-secondary mb-1">Remaining Debt ($)</label>
                        <input type="number" id="p3-debt" class="form-control mb-2 mp-in" value="0" step="1000">
                        <label class="form-label small fw-bold text-secondary mb-1">Monthly NOI ($)</label>
                        <input type="number" id="p3-noi" class="form-control mp-in" value="0" step="50">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Portfolio Overview</h5><p class="text-muted small mb-0">Equity, income, cap rate, and leverage analysis</p></div>
                </div>
                <div class="header-actions d-flex gap-2"><button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="mp-copy"><i class="fas fa-copy me-1"></i> Copy</button></div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="p-4 rounded-4 d-inline-block" style="background:#f0fdf4;border:2px solid #bbf7d0;min-width:260px">
                    <span class="d-block small fw-bold text-uppercase text-muted mb-1" style="letter-spacing:1px">Total Portfolio Equity</span>
                    <div class="display-4 fw-bold" style="color:#059669" id="mp-equity">$0</div>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Gross Value</span><span class="stat-card-value" id="mp-gross">$0</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Total Debt</span><span class="stat-card-value" id="mp-debt">$0</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Annual NOI</span><span class="stat-card-value" id="mp-noi">$0</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Properties</span><span class="stat-card-value" id="mp-count">0</span></div></div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Blended Cap Rate</span><span class="stat-card-value" id="mp-cap">0%</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Global LTV</span><span class="stat-card-value" id="mp-ltv">0%</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Risk Level</span><span class="stat-card-value" id="mp-risk">—</span></div></div>
            </div>
            <div class="p-3 rounded-3 bg-light border">
                <h6 class="fw-bold mb-2"><i class="fas fa-chess-knight me-2" style="color:#475569"></i>Strategy Insight</h6>
                <p id="mp-tip" class="small text-secondary mb-0">Enter property values above for portfolio analysis.</p>
            </div>
        </div>
    </div>
</div>
<style>.tool-card-stacked{border-radius:16px;background:#fff}.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}.btn-light-v2{background:#f1f5f9;border:none;color:#475569;font-weight:600}.btn-light-v2:hover{background:#e2e8f0;color:#1e293b}</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var $=function(id){return document.getElementById(id);};
    var fmtC=function(v){return new Intl.NumberFormat('en-US',{style:'currency',currency:'USD',maximumFractionDigits:0}).format(v);};
    var els={v1:$('p1-val'),d1:$('p1-debt'),n1:$('p1-noi'),v2:$('p2-val'),d2:$('p2-debt'),n2:$('p2-noi'),v3:$('p3-val'),d3:$('p3-debt'),n3:$('p3-noi')};
    function calc(){
        var gv=0,td=0,mn=0,cnt=0;
        function add(v,d,n){var val=parseFloat(v.value)||0,dbt=parseFloat(d.value)||0,noi=parseFloat(n.value)||0;if(val>0){gv+=val;td+=dbt;mn+=noi;cnt++;}}
        add(els.v1,els.d1,els.n1);add(els.v2,els.d2,els.n2);add(els.v3,els.d3,els.n3);
        var eq=gv-td,an=mn*12,cap=gv>0?(an/gv)*100:0,ltv=gv>0?(td/gv)*100:0;
        $('mp-equity').textContent=fmtC(eq);$('mp-gross').textContent=fmtC(gv);$('mp-debt').textContent=fmtC(td);
        $('mp-noi').textContent=fmtC(an);$('mp-count').textContent=cnt;$('mp-cap').textContent=cap.toFixed(2)+'%';
        $('mp-ltv').textContent=ltv.toFixed(1)+'%';
        var risk='Safe';if(ltv>=80)risk='High Risk';else if(ltv>=65)risk='Moderate';
        $('mp-risk').textContent=risk;
        var tip='';
        if(gv===0){tip='Add properties to see portfolio insights.';}
        else if(ltv>85){tip='Your LTV is '+ltv.toFixed(1)+'%. You are over-leveraged. A small drop in values could put equity underwater. Prioritize debt paydown.';}
        else if(eq>1000000&&cap>6){tip='Strong portfolio. '+fmtC(eq)+' equity at '+cap.toFixed(1)+'% cap rate. Consider scaling or holding for legacy wealth.';}
        else{tip='You control '+fmtC(gv)+' in assets yielding '+fmtC(an)+' NOI annually. LTV is '+ltv.toFixed(1)+'% ('+risk.toLowerCase()+').';}
        $('mp-tip').textContent=tip;
    }
    document.querySelectorAll('.mp-in').forEach(function(e){e.addEventListener('input',calc);});
    document.querySelectorAll('.mp-quick').forEach(function(b){b.addEventListener('click',function(){
        var p=this.dataset.p;
        if(p==='1'){els.v1.value=300000;els.d1.value=280000;els.n1.value=1800;els.v2.value=450000;els.d2.value=420000;els.n2.value=2200;els.v3.value=0;els.d3.value=0;els.n3.value=0;}
        else{els.v1.value=500000;els.d1.value=250000;els.n1.value=3500;els.v2.value=800000;els.d2.value=420000;els.n2.value=5000;els.v3.value=350000;els.d3.value=0;els.n3.value=2500;}
        calc();
    });});
    $('mp-reset').addEventListener('click',function(){els.v1.value=450000;els.d1.value=300000;els.n1.value=2500;els.v2.value=800000;els.d2.value=650000;els.n2.value=4800;els.v3.value=0;els.d3.value=0;els.n3.value=0;calc();});
    $('mp-copy').addEventListener('click',function(){
        var t='Portfolio Overview\n=================\nProperties: '+$('mp-count').textContent+'\nGross Value: '+$('mp-gross').textContent+'\nTotal Debt: '+$('mp-debt').textContent+'\nNet Equity: '+$('mp-equity').textContent+'\nAnnual NOI: '+$('mp-noi').textContent+'\nCap Rate: '+$('mp-cap').textContent+'\nGlobal LTV: '+$('mp-ltv').textContent+'\nRisk: '+$('mp-risk').textContent;
        navigator.clipboard.writeText(t).then(function(){var o=$('mp-copy').innerHTML;$('mp-copy').innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(function(){$('mp-copy').innerHTML=o;},2000);});
    });
    calc();
});
</script>
