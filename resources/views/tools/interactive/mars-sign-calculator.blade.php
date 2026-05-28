<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4 align-items-end">
                <div class="col-md-8">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Date of Birth</label>
                    <input type="date" id="mars-dob" class="form-control form-control-lg rounded-3" value="1995-01-01">
                </div>
                <div class="col-md-4">
                    <button id="mars-calc" class="btn btn-dark btn-lg w-100 rounded-3 fw-bold"><i class="fas fa-search me-2"></i>Find Mars Sign</button>
                </div>
            </div>
            <div class="mt-3 p-3 rounded-3" style="background:#f8fafc;border:1.5px solid #e2e8f0">
                <p class="mb-0 small text-secondary"><i class="fas fa-info-circle me-2" style="color:#ef4444"></i><strong>About Mars:</strong> Mars represents your energy, drive, aggression, and how you take action. It governs desire, competition, and physical vitality.</p>
            </div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Your Mars Placement</h5><p class="text-muted small mb-0">Sign, element, and interpretation</p></div>
                </div>
                <div class="header-actions d-flex gap-2"><button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="mars-copy"><i class="fas fa-copy me-1"></i> Copy</button></div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Mars Sign</span><span class="stat-card-value" id="mars-sign">—</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Symbol</span><span class="stat-card-value" id="mars-sym">—</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Element</span><span class="stat-card-value" id="mars-elem">—</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Archetype</span><span class="stat-card-value" id="mars-arch">—</span></div></div>
            </div>
            <div class="p-4 rounded-3 bg-light border">
                <h6 class="fw-bold mb-2"><i class="fas fa-scroll me-2" style="color:#ef4444"></i>Interpretation</h6>
                <p id="mars-meaning" class="text-secondary mb-0">Select your date of birth and click "Find Mars Sign" to see your result.</p>
            </div>
        </div>
    </div>
</div>
<style>.tool-card-stacked{border-radius:16px;background:#fff}.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}.btn-light-v2{background:#f1f5f9;border:none;color:#475569;font-weight:600}.btn-light-v2:hover{background:#e2e8f0;color:#1e293b}</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var signs=[
        {n:'Aries',s:'♈',e:'Fire',m:'Your energy is direct, bold, and pioneering. You take action quickly and prefer to lead from the front.',a:'Fearless Pioneer'},
        {n:'Taurus',s:'♉',e:'Earth',m:'Your drive is steady and persistent. You value security and material results, acting with great endurance.',a:'Patient Builder'},
        {n:'Gemini',s:'♊',e:'Air',m:'Your energy is versatile and mental. You are driven by curiosity and often pursue multiple projects simultaneously.',a:'Clever Messenger'},
        {n:'Cancer',s:'♋',e:'Water',m:'Your actions are guided by emotion and intuition. You act most strongly when emotionally invested.',a:'Protective Nurturer'},
        {n:'Leo',s:'♌',e:'Fire',m:'Your drive is dramatic and creative. You act with passion and desire recognition for your achievements.',a:'Noble Leader'},
        {n:'Virgo',s:'♍',e:'Earth',m:'Your energy is focused on precision and service. You are driven to refine, perfect, and be of practical help.',a:'Efficient Analyst'},
        {n:'Libra',s:'♎',e:'Air',m:'Your actions are balanced and diplomatic. You are driven to find harmony and often act in partnership.',a:'Strategic Diplomat'},
        {n:'Scorpio',s:'♏',e:'Water',m:'Your drive is intense and transformative. You act with depth and are capable of incredible focus and power.',a:'Powerful Catalyst'},
        {n:'Sagittarius',s:'♐',e:'Fire',m:'Your energy is expansive and adventurous. You are driven by a search for meaning, freedom, and truth.',a:'Enthusiastic Explorer'},
        {n:'Capricorn',s:'♑',e:'Earth',m:'Your drive is ambitious and disciplined. You are the master of long-term strategy and authority.',a:'Ambitious Strategist'},
        {n:'Aquarius',s:'♒',e:'Air',m:'Your energy is innovative and independent. You are driven by social progress and unconventional paths.',a:'Progressive Rebel'},
        {n:'Pisces',s:'♓',e:'Water',m:'Your actions are inspired and compassionate. You act based on spiritual ideals and collective empathy.',a:'Inspired Dreamer'}
    ];
    document.getElementById('mars-calc').addEventListener('click',function(){
        var dob=document.getElementById('mars-dob').value;
        if(!dob)return;
        var d=new Date(dob);if(isNaN(d.getTime()))return;
        var idx=(d.getFullYear()+d.getMonth()+d.getDate())%12,sg=signs[idx];
        document.getElementById('mars-sign').textContent=sg.n;
        document.getElementById('mars-sym').textContent=sg.s;
        document.getElementById('mars-elem').textContent=sg.e;
        document.getElementById('mars-arch').textContent=sg.a;
        document.getElementById('mars-meaning').textContent=sg.m;
    });
    document.getElementById('mars-reset').addEventListener('click',function(){
        document.getElementById('mars-dob').value='1995-01-01';
        ['mars-sign','mars-sym','mars-elem','mars-arch'].forEach(function(id){document.getElementById(id).textContent='—';});
        document.getElementById('mars-meaning').textContent='Select your date of birth and click "Find Mars Sign" to see your result.';
    });
    document.getElementById('mars-copy').addEventListener('click',function(){
        var t='Mars Sign: '+document.getElementById('mars-sign').textContent+'\nElement: '+document.getElementById('mars-elem').textContent+'\nArchetype: '+document.getElementById('mars-arch').textContent+'\nMeaning: '+document.getElementById('mars-meaning').textContent;
        navigator.clipboard.writeText(t).then(function(){var o=document.getElementById('mars-copy').innerHTML;document.getElementById('mars-copy').innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(function(){document.getElementById('mars-copy').innerHTML=o;},2000);});
    });
});
</script>
