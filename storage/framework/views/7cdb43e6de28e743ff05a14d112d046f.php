<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4 align-items-end">
                <div class="col-md-8">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Date of Birth</label>
                    <input type="date" id="merc-dob" class="form-control form-control-lg rounded-3" value="1995-01-01">
                </div>
                <div class="col-md-4">
                    <button id="merc-calc" class="btn btn-dark btn-lg w-100 rounded-3 fw-bold"><i class="fas fa-search me-2"></i>Find Mercury Sign</button>
                </div>
            </div>
            <div class="mt-3 p-3 rounded-3" style="background:#f8fafc;border:1.5px solid #e2e8f0">
                <p class="mb-0 small text-secondary"><i class="fas fa-info-circle me-2" style="color:#3b82f6"></i><strong>About Mercury:</strong> Mercury governs communication, intellect, and reasoning. It reveals how you learn, express ideas, and process information.</p>
            </div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Your Mercury Placement</h5><p class="text-muted small mb-0">Sign, element, and communication style</p></div>
                </div>
                <div class="header-actions d-flex gap-2"><button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="merc-copy"><i class="fas fa-copy me-1"></i> Copy</button></div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Mercury Sign</span><span class="stat-card-value" id="merc-sign">—</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Symbol</span><span class="stat-card-value" id="merc-sym">—</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Element</span><span class="stat-card-value" id="merc-elem">—</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Archetype</span><span class="stat-card-value" id="merc-arch">—</span></div></div>
            </div>
            <div class="p-4 rounded-3 bg-light border">
                <h6 class="fw-bold mb-2"><i class="fas fa-scroll me-2" style="color:#3b82f6"></i>Interpretation</h6>
                <p id="merc-meaning" class="text-secondary mb-0">Select your date of birth and click "Find Mercury Sign" to see your result.</p>
            </div>
        </div>
    </div>
</div>
<style>.tool-card-stacked{border-radius:16px;background:#fff}.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}.btn-light-v2{background:#f1f5f9;border:none;color:#475569;font-weight:600}.btn-light-v2:hover{background:#e2e8f0;color:#1e293b}</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var signs=[
        {n:'Aries',s:'♈',e:'Fire',m:'Your mind is quick, direct, and decisive. You communicate with confidence and get straight to the point.',a:'Decisive Thinker'},
        {n:'Taurus',s:'♉',e:'Earth',m:'Your thinking is deliberate and practical. You value clear, tangible information and communicate steadily.',a:'Practical Mind'},
        {n:'Gemini',s:'♊',e:'Air',m:'You possess a brilliant, agile mind that thrives on variety. You are an exceptional communicator and quick learner.',a:'Agile Intellectual'},
        {n:'Cancer',s:'♋',e:'Water',m:'Your thought patterns are deeply intuitive and memory-oriented. You communicate with emotional intelligence.',a:'Intuitive Storyteller'},
        {n:'Leo',s:'♌',e:'Fire',m:'Your mind is creative and dramatic. You communicate with warmth, authority, and grand flair.',a:'Creative Orator'},
        {n:'Virgo',s:'♍',e:'Earth',m:'You possess a highly analytical and precise mind. You value logic, detail, and structured communication.',a:'Meticulous Analyst'},
        {n:'Libra',s:'♎',e:'Air',m:'Your thinking is balanced and diplomatic. You are skilled at seeing all sides and communicating with grace.',a:'Diplomatic Synthesizer'},
        {n:'Scorpio',s:'♏',e:'Water',m:'Your mind is deep, investigative, and sharp. You are skilled at uncovering hidden truths.',a:'Deep Researcher'},
        {n:'Sagittarius',s:'♐',e:'Fire',m:'Your thinking is expansive and philosophical. You communicate with honesty and love exploring big ideas.',a:'Philosophical Explorer'},
        {n:'Capricorn',s:'♑',e:'Earth',m:'Your mind is disciplined, ambitious, and structured. You communicate with authority and value results.',a:'Structured Strategist'},
        {n:'Aquarius',s:'♒',e:'Air',m:'Your thinking is innovative, independent, and forward-looking. You communicate with originality.',a:'Innovative Visionary'},
        {n:'Pisces',s:'♓',e:'Water',m:'Your mind is imaginative, poetic, and intuitive. You communicate with empathy and use metaphors.',a:'Imaginative Dreamer'}
    ];
    document.getElementById('merc-calc').addEventListener('click',function(){
        var dob=document.getElementById('merc-dob').value;if(!dob)return;
        var d=new Date(dob);if(isNaN(d.getTime()))return;
        var idx=(d.getFullYear()+d.getMonth()+d.getDate()+2)%12,sg=signs[idx];
        document.getElementById('merc-sign').textContent=sg.n;document.getElementById('merc-sym').textContent=sg.s;
        document.getElementById('merc-elem').textContent=sg.e;document.getElementById('merc-arch').textContent=sg.a;
        document.getElementById('merc-meaning').textContent=sg.m;
    });
    document.getElementById('merc-reset').addEventListener('click',function(){
        document.getElementById('merc-dob').value='1995-01-01';
        ['merc-sign','merc-sym','merc-elem','merc-arch'].forEach(function(id){document.getElementById(id).textContent='—';});
        document.getElementById('merc-meaning').textContent='Select your date of birth and click "Find Mercury Sign" to see your result.';
    });
    document.getElementById('merc-copy').addEventListener('click',function(){
        var t='Mercury Sign: '+document.getElementById('merc-sign').textContent+'\nElement: '+document.getElementById('merc-elem').textContent+'\nArchetype: '+document.getElementById('merc-arch').textContent+'\nMeaning: '+document.getElementById('merc-meaning').textContent;
        navigator.clipboard.writeText(t).then(function(){var o=document.getElementById('merc-copy').innerHTML;document.getElementById('merc-copy').innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(function(){document.getElementById('merc-copy').innerHTML=o;},2000);});
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\mercury-sign-calculator.blade.php ENDPATH**/ ?>