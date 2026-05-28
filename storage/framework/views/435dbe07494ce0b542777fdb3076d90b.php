<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4 align-items-end">
                <div class="col-md-8">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Date of Birth</label>
                    <input type="date" id="venus-dob" class="form-control form-control-lg rounded-3" value="1995-01-01">
                </div>
                <div class="col-md-4">
                    <button id="venus-calc" class="btn btn-dark btn-lg w-100 rounded-3 fw-bold"><i class="fas fa-search me-2"></i>Find Venus Sign</button>
                </div>
            </div>
            <div class="mt-3 p-3 rounded-3" style="background:#f8fafc;border:1.5px solid #e2e8f0">
                <p class="mb-0 small text-secondary"><i class="fas fa-info-circle me-2" style="color:#ec4899"></i><strong>About Venus:</strong> Venus governs love, beauty, pleasure, and values. It reveals how you express affection and what attracts you in relationships.</p>
            </div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Your Venus Placement</h5><p class="text-muted small mb-0">Sign, element, and love style</p></div>
                </div>
                <div class="header-actions d-flex gap-2"><button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="venus-copy"><i class="fas fa-copy me-1"></i> Copy</button></div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Venus Sign</span><span class="stat-card-value" id="venus-sign">—</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Symbol</span><span class="stat-card-value" id="venus-sym">—</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Element</span><span class="stat-card-value" id="venus-elem">—</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Archetype</span><span class="stat-card-value" id="venus-arch">—</span></div></div>
            </div>
            <div class="p-4 rounded-3 bg-light border">
                <h6 class="fw-bold mb-2"><i class="fas fa-scroll me-2" style="color:#ec4899"></i>Interpretation</h6>
                <p id="venus-meaning" class="text-secondary mb-0">Select your date of birth and click "Find Venus Sign" to see your result.</p>
            </div>
        </div>
    </div>
</div>
<style>.tool-card-stacked{border-radius:16px;background:#fff}.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}.btn-light-v2{background:#f1f5f9;border:none;color:#475569;font-weight:600}.btn-light-v2:hover{background:#e2e8f0;color:#1e293b}</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var signs=[
        {n:'Aries',s:'♈',e:'Fire',m:'In love, you are direct, passionate, and impulsive. You enjoy the thrill of the chase and value independence.',a:'Passionate Pioneer'},
        {n:'Taurus',s:'♉',e:'Earth',m:'You value security, loyalty, and sensual pleasure. You are a steady and devoted partner who appreciates beauty.',a:'Sensual Provider'},
        {n:'Gemini',s:'♊',e:'Air',m:'You value mental stimulation, variety, and communication. In love, you are curious, playful, and witty.',a:'Witty Companion'},
        {n:'Cancer',s:'♋',e:'Water',m:'You are deeply emotional, nurturing, and protective. You seek emotional security and a sense of home.',a:'Nurturing Soul'},
        {n:'Leo',s:'♌',e:'Fire',m:'In love, you are generous, dramatic, and warm-hearted. You express affection with grand gestures.',a:'Radiant Heart'},
        {n:'Virgo',s:'♍',e:'Earth',m:'You show love through practical service and attention to detail. You value intelligence and refinement.',a:'Devoted Helper'},
        {n:'Libra',s:'♎',e:'Air',m:'You are the ultimate romantic, seeking harmony, balance, and partnership. You have refined aesthetic taste.',a:'Gracious Romantic'},
        {n:'Scorpio',s:'♏',e:'Water',m:'In love, you are intense, loyal, and transformative. You seek deep emotional and soul-level connections.',a:'Deeply Loyal Partner'},
        {n:'Sagittarius',s:'♐',e:'Fire',m:'You value freedom, adventure, and honesty. You need a partner who shares your quest for growth.',a:'Free-Spirited Idealist'},
        {n:'Capricorn',s:'♑',e:'Earth',m:'You are serious, committed, and practical in love. You value tradition, ambition, and reliability.',a:'Committed Builder'},
        {n:'Aquarius',s:'♒',e:'Air',m:'You value independence, originality, and friendship. You seek a partner who is also your best friend.',a:'Independent Friend'},
        {n:'Pisces',s:'♓',e:'Water',m:'You are romantic, compassionate, and spiritually-minded. You seek a soulmate connection.',a:'Compassionate Dreamer'}
    ];
    document.getElementById('venus-calc').addEventListener('click',function(){
        var dob=document.getElementById('venus-dob').value;if(!dob)return;
        var d=new Date(dob);if(isNaN(d.getTime()))return;
        var idx=(d.getFullYear()+d.getMonth()+d.getDate()+5)%12,sg=signs[idx];
        document.getElementById('venus-sign').textContent=sg.n;document.getElementById('venus-sym').textContent=sg.s;
        document.getElementById('venus-elem').textContent=sg.e;document.getElementById('venus-arch').textContent=sg.a;
        document.getElementById('venus-meaning').textContent=sg.m;
    });
    document.getElementById('venus-reset').addEventListener('click',function(){
        document.getElementById('venus-dob').value='1995-01-01';
        ['venus-sign','venus-sym','venus-elem','venus-arch'].forEach(function(id){document.getElementById(id).textContent='—';});
        document.getElementById('venus-meaning').textContent='Select your date of birth and click "Find Venus Sign" to see your result.';
    });
    document.getElementById('venus-copy').addEventListener('click',function(){
        var t='Venus Sign: '+document.getElementById('venus-sign').textContent+'\nElement: '+document.getElementById('venus-elem').textContent+'\nArchetype: '+document.getElementById('venus-arch').textContent+'\nMeaning: '+document.getElementById('venus-meaning').textContent;
        navigator.clipboard.writeText(t).then(function(){var o=document.getElementById('venus-copy').innerHTML;document.getElementById('venus-copy').innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(function(){document.getElementById('venus-copy').innerHTML=o;},2000);});
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\venus-sign-calculator.blade.php ENDPATH**/ ?>