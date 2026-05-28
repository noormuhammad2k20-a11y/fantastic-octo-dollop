<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div id="cu-list" class="mb-4"></div>
            <button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="cu-add"><i class="fas fa-plus-circle me-1"></i> Add Card</button>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Utilization Summary</h5><p class="text-muted small mb-0">Aggregate stats and score impact</p></div>
                </div>
                <div class="header-actions d-flex gap-2"><button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="cu-copy"><i class="fas fa-copy me-1"></i> Copy</button></div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="p-4 rounded-4 d-inline-block" style="background:#faf5ff;border:2px solid #e9d5ff;min-width:220px">
                    <span class="d-block small fw-bold text-uppercase text-muted mb-1" style="letter-spacing:1px">Aggregate Utilization</span>
                    <div class="display-4 fw-bold" style="color:#7c3aed" id="cu-total">0%</div>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Total Limit</span><span class="stat-card-value" id="cu-lim">$0</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Total Balance</span><span class="stat-card-value" id="cu-bal">$0</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Status</span><span class="stat-card-value" id="cu-status">Optimal</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Score Impact</span><span class="stat-card-value" id="cu-impact">Strong</span></div></div>
            </div>
        </div>
    </div>
</div>
<style>.tool-card-stacked{border-radius:16px;background:#fff}.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}.btn-light-v2{background:#f1f5f9;border:none;color:#475569;font-weight:600}.btn-light-v2:hover{background:#e2e8f0;color:#1e293b}.cu-row{padding:1rem;border-radius:12px;background:#f8fafc;border:1px solid #e2e8f0;margin-bottom:0.75rem;}</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var list=document.getElementById('cu-list');
    function createRow(name,limit,bal){
        var row=document.createElement('div');row.className='cu-row';
        row.innerHTML='<div class="row g-3 align-items-center"><div class="col-md-4"><label class="form-label small fw-bold text-secondary mb-1">Card Name</label><input type="text" class="form-control cu-name" value="'+name+'"></div><div class="col-md-3"><label class="form-label small fw-bold text-secondary mb-1">Limit ($)</label><input type="number" class="form-control cu-limit" value="'+limit+'"></div><div class="col-md-3"><label class="form-label small fw-bold text-secondary mb-1">Balance ($)</label><input type="number" class="form-control cu-bal" value="'+bal+'"></div><div class="col-md-2 text-end pt-4"><span class="fw-bold small me-2 cu-pct">0%</span><button class="btn btn-sm btn-outline-danger cu-rm"><i class="fas fa-trash"></i></button></div></div>';
        row.querySelectorAll('input').forEach(function(i){i.addEventListener('input',calc);});
        row.querySelector('.cu-rm').addEventListener('click',function(){if(document.querySelectorAll('.cu-row').length>1){row.remove();calc();}});
        list.appendChild(row);calc();
    }
    function calc(){
        var rows=document.querySelectorAll('.cu-row'),tl=0,tb=0;
        rows.forEach(function(r){
            var lm=parseFloat(r.querySelector('.cu-limit').value)||0,bl=parseFloat(r.querySelector('.cu-bal').value)||0;
            tl+=lm;tb+=bl;
            var u=lm>0?(bl/lm)*100:0;
            r.querySelector('.cu-pct').textContent=u.toFixed(0)+'%';
        });
        var tu=tl>0?(tb/tl)*100:0;
        document.getElementById('cu-total').textContent=Math.round(tu)+'%';
        document.getElementById('cu-lim').textContent='$'+Math.round(tl).toLocaleString();
        document.getElementById('cu-bal').textContent='$'+Math.round(tb).toLocaleString();
        var st='Optimal',imp='Elite';
        if(tu>=60){st='Critical';imp='High Risk';}
        else if(tu>=30){st='Caution';imp='Average';}
        else if(tu>=10){st='Good';imp='Strong';}
        document.getElementById('cu-status').textContent=st;
        document.getElementById('cu-impact').textContent=imp;
    }
    document.getElementById('cu-add').addEventListener('click',function(){createRow('New Card',5000,0);});
    document.getElementById('cu-azeo').addEventListener('click',function(){
        var rows=document.querySelectorAll('.cu-row');
        rows.forEach(function(r,i){r.querySelector('.cu-bal').value=i===0?20:0;});calc();
    });
    document.getElementById('cu-reset').addEventListener('click',function(){
        list.innerHTML='';createRow('Amex Gold',10000,1500);createRow('Chase Sapphire',5000,200);createRow('Discover It',2000,1800);
    });
    document.getElementById('cu-copy').addEventListener('click',function(){
        var t='Credit Utilization Report\n========================\nAggregate: '+document.getElementById('cu-total').textContent+'\nTotal Limit: '+document.getElementById('cu-lim').textContent+'\nTotal Balance: '+document.getElementById('cu-bal').textContent+'\nStatus: '+document.getElementById('cu-status').textContent;
        navigator.clipboard.writeText(t).then(function(){var o=document.getElementById('cu-copy').innerHTML;document.getElementById('cu-copy').innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(function(){document.getElementById('cu-copy').innerHTML=o;},2000);});
    });
    createRow('Amex Gold',10000,1500);createRow('Chase Sapphire',5000,200);createRow('Discover It',2000,1800);
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\credit-utilization-tracker.blade.php ENDPATH**/ ?>