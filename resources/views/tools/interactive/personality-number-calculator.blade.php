<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4 align-items-end">
                <div class="col-md-8">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Full Birth Name</label>
                    <input type="text" id="pn-name" class="form-control form-control-lg rounded-3" placeholder="e.g. John Michael Doe">
                    <small class="text-muted d-block mt-1">Use the name as it appears on your birth certificate</small>
                </div>
                <div class="col-md-4">
                    <button id="pn-calc" class="btn btn-dark btn-lg w-100 rounded-3 fw-bold"><i class="fas fa-search me-2"></i>Calculate</button>
                </div>
            </div>
            <div class="mt-3 p-3 rounded-3" style="background:#f8fafc;border:1.5px solid #e2e8f0">
                <p class="mb-0 small text-secondary"><i class="fas fa-info-circle me-2" style="color:#6366f1"></i><strong>How it works:</strong> The Personality Number is derived from the <strong>consonants</strong> in your birth name. It reveals the outer mask you wear and the first impression you make.</p>
            </div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Persona Profile</h5><p class="text-muted small mb-0">Your outer self as perceived by others</p></div>
                </div>
                <div class="header-actions d-flex gap-2"><button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="pn-copy"><i class="fas fa-copy me-1"></i> Copy</button></div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="alert alert-danger rounded-3 d-none" id="pn-err"><i class="fas fa-exclamation-triangle me-2"></i><span id="pn-err-msg"></span></div>
            <div class="text-center mb-4">
                <div class="p-4 rounded-4 d-inline-block" style="background:#eef2ff;border:2px solid #c7d2fe;min-width:180px">
                    <span class="d-block small fw-bold text-uppercase text-muted mb-1" style="letter-spacing:1px">Personality Number</span>
                    <div class="display-3 fw-bold" style="color:#4f46e5" id="pn-num">—</div>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Title</span><span class="stat-card-value" id="pn-title">—</span></div></div>
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Archetype</span><span class="stat-card-value" id="pn-arch">—</span></div></div>
            </div>
            <div class="p-4 rounded-3 bg-light border">
                <h6 class="fw-bold mb-2"><i class="fas fa-mask me-2" style="color:#6366f1"></i>Interpretation</h6>
                <p id="pn-meaning" class="text-secondary mb-0">Enter your full birth name above to reveal your personality number.</p>
            </div>
        </div>
    </div>
</div>
<style>.tool-card-stacked{border-radius:16px;background:#fff}.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}.btn-light-v2{background:#f1f5f9;border:none;color:#475569;font-weight:600}.btn-light-v2:hover{background:#e2e8f0;color:#1e293b}</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var cm={a:1,j:1,s:1,b:2,k:2,t:2,c:3,l:3,u:3,d:4,m:4,v:4,e:5,n:5,w:5,f:6,o:6,x:6,g:7,p:7,y:7,h:8,q:8,z:8,i:9,r:9};
    var interp={
        '1':{t:'The Professional Pioneer',m:'Others perceive you as a strong, independent, and ambitious leader. You appear confident and capable.',a:'Independent Leader'},
        '2':{t:'The Gentle Diplomat',m:'You come across as warm, cooperative, and sensitive. People feel comfortable and peaceful around you.',a:'Harmonizer'},
        '3':{t:'The Charismatic Artist',m:'You project a sense of joy, creativity, and social charm. People are drawn to your expressive personality.',a:'Creative Spark'},
        '4':{t:'The Reliable Anchor',m:'Others see you as disciplined, practical, and highly organized. You project stability and trustworthiness.',a:'Steady Foundation'},
        '5':{t:'The Energetic Explorer',m:'You appear versatile, fun-loving, and ready for adventure. People see you as interesting and full of life.',a:'Free Spirit'},
        '6':{t:'The Nurturing Guardian',m:'You project responsibility, warmth, and compassion. People often turn to you for support.',a:'Loving Protector'},
        '7':{t:'The Mysterious Sage',m:'Others perceive you as intellectual, reserved, and spiritually deep. You appear to possess hidden knowledge.',a:'Thoughtful Seeker'},
        '8':{t:'The Authoritative Powerhouse',m:'You project success, competence, and material mastery. People see you as a strong, capable leader.',a:'Confident Achiever'},
        '9':{t:'The Compassionate Visionary',m:'Others see you as selfless, idealistic, and deeply empathetic. You appear driven by higher ideals.',a:'Global Humanitarian'},
        '11':{t:'The Inspiring Idealist',m:'You project intense spiritual energy and intuition. People find you inspiring and slightly otherworldly.',a:'Intuitive Guide'},
        '22':{t:'The Master Architect',m:'You appear as someone with immense practical power and the ability to organize large-scale projects.',a:'Master Builder'},
        '33':{t:'The Healing Teacher',m:'You project a vibration of pure compassion and wisdom. People feel peace and healing in your presence.',a:'Master Teacher'}
    };
    function reduce(n){if([11,22,33].indexOf(n)!==-1)return n;if(n<=9)return n;var s=n.toString().split('').reduce(function(a,b){return a+parseInt(b);},0);return reduce(s);}
    function calc(){
        var name=document.getElementById('pn-name').value.trim().toLowerCase(),errDiv=document.getElementById('pn-err'),errMsg=document.getElementById('pn-err-msg');
        errDiv.classList.add('d-none');
        if(!name){errDiv.classList.remove('d-none');errMsg.textContent='Please enter your full birth name.';return;}
        if(!/[a-z]/i.test(name)){errDiv.classList.remove('d-none');errMsg.textContent='Name must contain at least one letter.';return;}
        var vowels=['a','e','i','o','u'],total=0;
        for(var i=0;i<name.length;i++){var c=name[i];if(cm[c]&&vowels.indexOf(c)===-1)total+=cm[c];}
        if(total===0){errDiv.classList.remove('d-none');errMsg.textContent='No consonants found. Please check your input.';return;}
        var num=reduce(total),data=interp[num.toString()]||interp['1'];
        document.getElementById('pn-num').textContent=num;
        document.getElementById('pn-title').textContent=data.t;
        document.getElementById('pn-arch').textContent=data.a;
        document.getElementById('pn-meaning').textContent=data.m;
    }
    document.getElementById('pn-calc').addEventListener('click',calc);
    document.getElementById('pn-reset').addEventListener('click',function(){
        document.getElementById('pn-name').value='';document.getElementById('pn-err').classList.add('d-none');
        document.getElementById('pn-num').textContent='—';document.getElementById('pn-title').textContent='—';
        document.getElementById('pn-arch').textContent='—';document.getElementById('pn-meaning').textContent='Enter your full birth name above to reveal your personality number.';
    });
    document.getElementById('pn-copy').addEventListener('click',function(){
        var t='Personality Number: '+document.getElementById('pn-num').textContent+'\nTitle: '+document.getElementById('pn-title').textContent+'\nArchetype: '+document.getElementById('pn-arch').textContent+'\nMeaning: '+document.getElementById('pn-meaning').textContent;
        navigator.clipboard.writeText(t).then(function(){var o=document.getElementById('pn-copy').innerHTML;document.getElementById('pn-copy').innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(function(){document.getElementById('pn-copy').innerHTML=o;},2000);});
    });
});
</script>
