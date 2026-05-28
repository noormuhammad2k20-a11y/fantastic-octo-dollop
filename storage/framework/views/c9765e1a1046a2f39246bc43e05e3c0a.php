<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4 align-items-end">
                <div class="col-md-8">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Date of Birth</label>
                    <input type="date" id="sat-dob" class="form-control form-control-lg rounded-3" value="1995-01-01">
                </div>
                <div class="col-md-4">
                    <button id="sat-calc" class="btn btn-dark btn-lg w-100 rounded-3 fw-bold"><i class="fas fa-search me-2"></i>Find Saturn Sign</button>
                </div>
            </div>
            <div class="mt-3 p-3 rounded-3" style="background:#f8fafc;border:1.5px solid #e2e8f0">
                <p class="mb-0 small text-secondary"><i class="fas fa-info-circle me-2" style="color:#475569"></i><strong>About Saturn:</strong> Saturn governs discipline, boundaries, and karmic lessons. It stays in each sign for about 2.5 years and reveals where you must work hardest.</p>
            </div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Your Saturn Placement</h5><p class="text-muted small mb-0">Sign, element, and karmic lesson</p></div>
                </div>
                <div class="header-actions d-flex gap-2"><button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="sat-copy"><i class="fas fa-copy me-1"></i> Copy</button></div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Saturn Sign</span><span class="stat-card-value" id="sat-sign">—</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Symbol</span><span class="stat-card-value" id="sat-sym">—</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Element</span><span class="stat-card-value" id="sat-elem">—</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Archetype</span><span class="stat-card-value" id="sat-arch">—</span></div></div>
            </div>
            <div class="p-4 rounded-3 bg-light border">
                <h6 class="fw-bold mb-2"><i class="fas fa-scroll me-2" style="color:#475569"></i>Interpretation</h6>
                <p id="sat-meaning" class="text-secondary mb-0">Select your date of birth and click "Find Saturn Sign" to see your result.</p>
            </div>
        </div>
    </div>
</div>
<style>.tool-card-stacked{border-radius:16px;background:#fff}.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}.btn-light-v2{background:#f1f5f9;border:none;color:#475569;font-weight:600}.btn-light-v2:hover{background:#e2e8f0;color:#1e293b}</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var signs=[
        {n:'Aries',s:'♈',e:'Fire',m:'Your lesson involves balancing individual will with patience. You build strength through controlled action.',a:'Disciplined Warrior'},
        {n:'Taurus',s:'♉',e:'Earth',m:'Mastery through building lasting security. Your challenge is learning the true value of non-material worth.',a:'Patient Architect'},
        {n:'Gemini',s:'♊',e:'Air',m:'Mastery through focused communication and mental discipline. You learn to filter noise for true knowledge.',a:'Serious Scholar'},
        {n:'Cancer',s:'♋',e:'Water',m:'Your lesson is emotional self-reliance. You build maturity by creating your own inner sense of safety.',a:'Protective Pillar'},
        {n:'Leo',s:'♌',e:'Fire',m:'You learn to ground creativity in responsibility. Mastery through authentic, disciplined self-expression.',a:'Sovereign Authority'},
        {n:'Virgo',s:'♍',e:'Earth',m:'Your challenge is perfectionism. Mastery through practical service and attention to health.',a:'Efficient Master'},
        {n:'Libra',s:'♎',e:'Air',m:'You learn the weight of justice and commitment. Mastery through true fairness and balance.',a:'Just Arbitrator'},
        {n:'Scorpio',s:'♏',e:'Water',m:'Your lesson involves power and deep transformation. Strength in vulnerability and self-control.',a:'Intense Strategist'},
        {n:'Sagittarius',s:'♐',e:'Fire',m:'You learn to ground beliefs in reality. Mastery through seeking wisdom rather than just knowledge.',a:'Ethical Explorer'},
        {n:'Capricorn',s:'♑',e:'Earth',m:'Saturn is at home here. Mastery through time, structure, and achieving great social heights.',a:'Master of Time'},
        {n:'Aquarius',s:'♒',e:'Air',m:'Your lesson is finding your place within the collective. Discipline through innovative group work.',a:'Humanitarian Elder'},
        {n:'Pisces',s:'♓',e:'Water',m:'Mastery through spiritual discipline and clear boundaries. You learn to ground dreams in reality.',a:'Grounded Dreamer'}
    ];
    document.getElementById('sat-calc').addEventListener('click',function(){
        var dob=document.getElementById('sat-dob').value;if(!dob)return;
        var d=new Date(dob);if(isNaN(d.getTime()))return;
        var idx=(d.getFullYear()+7)%12,sg=signs[idx];
        document.getElementById('sat-sign').textContent=sg.n;document.getElementById('sat-sym').textContent=sg.s;
        document.getElementById('sat-elem').textContent=sg.e;document.getElementById('sat-arch').textContent=sg.a;
        document.getElementById('sat-meaning').textContent=sg.m;
    });
    document.getElementById('sat-reset').addEventListener('click',function(){
        document.getElementById('sat-dob').value='1995-01-01';
        ['sat-sign','sat-sym','sat-elem','sat-arch'].forEach(function(id){document.getElementById(id).textContent='—';});
        document.getElementById('sat-meaning').textContent='Select your date of birth and click "Find Saturn Sign" to see your result.';
    });
    document.getElementById('sat-copy').addEventListener('click',function(){
        var t='Saturn Sign: '+document.getElementById('sat-sign').textContent+'\nElement: '+document.getElementById('sat-elem').textContent+'\nArchetype: '+document.getElementById('sat-arch').textContent+'\nLesson: '+document.getElementById('sat-meaning').textContent;
        navigator.clipboard.writeText(t).then(function(){var o=document.getElementById('sat-copy').innerHTML;document.getElementById('sat-copy').innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(function(){document.getElementById('sat-copy').innerHTML=o;},2000);});
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\saturn-sign-calculator.blade.php ENDPATH**/ ?>