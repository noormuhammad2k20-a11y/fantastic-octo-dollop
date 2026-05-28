<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4 align-items-end">
                <div class="col-md-8">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Date of Birth</label>
                    <input type="date" id="jup-dob" class="form-control form-control-lg rounded-3" value="1995-01-01">
                </div>
                <div class="col-md-4">
                    <button id="jup-calc" class="btn btn-dark btn-lg w-100 rounded-3 fw-bold"><i class="fas fa-search me-2"></i>Find Jupiter Sign</button>
                </div>
            </div>
            <div class="mt-3 p-3 rounded-3" style="background:#f8fafc;border:1.5px solid #e2e8f0">
                <p class="mb-0 small text-secondary"><i class="fas fa-info-circle me-2" style="color:#7c3aed"></i><strong>About Jupiter:</strong> Jupiter governs expansion, luck, wisdom, and abundance. It stays in each sign for about 1 year and reveals where you find growth.</p>
            </div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Your Jupiter Placement</h5><p class="text-muted small mb-0">Sign, element, and growth path</p></div>
                </div>
                <div class="header-actions d-flex gap-2"><button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="jup-copy"><i class="fas fa-copy me-1"></i> Copy</button></div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Jupiter Sign</span><span class="stat-card-value" id="jup-sign">—</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Symbol</span><span class="stat-card-value" id="jup-sym">—</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Element</span><span class="stat-card-value" id="jup-elem">—</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Archetype</span><span class="stat-card-value" id="jup-arch">—</span></div></div>
            </div>
            <div class="p-4 rounded-3 bg-light border">
                <h6 class="fw-bold mb-2"><i class="fas fa-scroll me-2" style="color:#7c3aed"></i>Interpretation</h6>
                <p id="jup-meaning" class="text-secondary mb-0">Select your date of birth and click "Find Jupiter Sign" to see your result.</p>
            </div>
        </div>
    </div>
</div>
<style>.tool-card-stacked{border-radius:16px;background:#fff}.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}.btn-light-v2{background:#f1f5f9;border:none;color:#475569;font-weight:600}.btn-light-v2:hover{background:#e2e8f0;color:#1e293b}</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var signs=[
        {n:'Aries',s:'♈',e:'Fire',m:'You find luck through initiative and being a pioneer. Growth comes from leadership and self-reliance.',a:'Courageous Pioneer'},
        {n:'Taurus',s:'♉',e:'Earth',m:'Abundance grows through persistence and building tangible value. Luck in stability and the physical world.',a:'Manifesting Builder'},
        {n:'Gemini',s:'♊',e:'Air',m:'You expand through curiosity, learning, and communication. Luck from networking and diverse interests.',a:'Curious Messenger'},
        {n:'Cancer',s:'♋',e:'Water',m:'Growth is tied to emotional intelligence and nurturing. Luck through family and belonging.',a:'Soulful Nurturer'},
        {n:'Leo',s:'♌',e:'Fire',m:'Luck finds you when expressing creativity and confidence. Expand through leadership.',a:'Radiant Leader'},
        {n:'Virgo',s:'♍',e:'Earth',m:'Growth comes through service and refinement. Luck in organization, health, and meticulous work.',a:'Helpful Craftsman'},
        {n:'Libra',s:'♎',e:'Air',m:'You expand through partnerships and balance. Luck from diplomatic efforts and harmony.',a:'Harmonious Partner'},
        {n:'Scorpio',s:'♏',e:'Water',m:'Growth is deep and transformative. Luck through intense experiences and uncovering truths.',a:'Deep Alchemist'},
        {n:'Sagittarius',s:'♐',e:'Fire',m:'Jupiter is at home here. Luck through travel, philosophy, and seeking ultimate truth.',a:'Philosophical Voyager'},
        {n:'Capricorn',s:'♑',e:'Earth',m:'Growth through discipline and ambition. Luck in long-term goals and social standing.',a:'Ambitious Strategist'},
        {n:'Aquarius',s:'♒',e:'Air',m:'Expand through innovation and social causes. Luck from group efforts and forward thinking.',a:'Visionary Humanitarian'},
        {n:'Pisces',s:'♓',e:'Water',m:'Growth is spiritual and imaginative. Luck through compassion, art, and divine connection.',a:'Compassionate Mystic'}
    ];
    document.getElementById('jup-calc').addEventListener('click',function(){
        var dob=document.getElementById('jup-dob').value;if(!dob)return;
        var d=new Date(dob);if(isNaN(d.getTime()))return;
        var idx=(d.getFullYear()+1)%12,sg=signs[idx];
        document.getElementById('jup-sign').textContent=sg.n;document.getElementById('jup-sym').textContent=sg.s;
        document.getElementById('jup-elem').textContent=sg.e;document.getElementById('jup-arch').textContent=sg.a;
        document.getElementById('jup-meaning').textContent=sg.m;
    });
    document.getElementById('jup-reset').addEventListener('click',function(){
        document.getElementById('jup-dob').value='1995-01-01';
        ['jup-sign','jup-sym','jup-elem','jup-arch'].forEach(function(id){document.getElementById(id).textContent='—';});
        document.getElementById('jup-meaning').textContent='Select your date of birth and click "Find Jupiter Sign" to see your result.';
    });
    document.getElementById('jup-copy').addEventListener('click',function(){
        var t='Jupiter Sign: '+document.getElementById('jup-sign').textContent+'\nElement: '+document.getElementById('jup-elem').textContent+'\nArchetype: '+document.getElementById('jup-arch').textContent+'\nPath: '+document.getElementById('jup-meaning').textContent;
        navigator.clipboard.writeText(t).then(function(){var o=document.getElementById('jup-copy').innerHTML;document.getElementById('jup-copy').innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(function(){document.getElementById('jup-copy').innerHTML=o;},2000);});
    });
});
</script>
