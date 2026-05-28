<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-3 mb-4" style="background:#f8fafc;border:1.5px solid #e2e8f0">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-bolt text-warning me-2"></i>Common Sequences</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ang-qf" data-val="111">111</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ang-qf" data-val="222">222</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ang-qf" data-val="333">333</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ang-qf" data-val="444">444</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ang-qf" data-val="555">555</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ang-qf" data-val="777">777</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ang-qf" data-val="1111">1111</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ang-qf" data-val="1212">1212</button>
                </div>
            </div>
            <div class="row g-4 align-items-end">
                <div class="col-md-8">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Repeating Sequence</label>
                    <input type="text" id="ang-input" class="form-control form-control-lg rounded-3" placeholder="e.g. 1111, 444, 1212" maxlength="6">
                    <small class="text-muted d-block mt-1">Enter the repeating numbers you've been seeing</small>
                </div>
                <div class="col-md-4">
                    <button id="ang-calc" class="btn btn-dark btn-lg w-100 rounded-3 fw-bold"><i class="fas fa-search me-2"></i>Decode</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Divine Interpretation</h5><p class="text-muted small mb-0">Meaning, vibration, and guidance</p></div>
                </div>
                <div class="header-actions d-flex gap-2"><button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="ang-copy"><i class="fas fa-copy me-1"></i> Copy</button></div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="alert alert-danger rounded-3 d-none" id="ang-err"><i class="fas fa-exclamation-triangle me-2"></i><span id="ang-err-msg"></span></div>
            <div class="row g-3 mb-4">
                <div class="col-md-4 col-6"><div class="stat-card"><span class="stat-card-label">Core Vibration</span><span class="stat-card-value" id="ang-vib">—</span></div></div>
                <div class="col-md-4 col-6"><div class="stat-card"><span class="stat-card-label">Theme</span><span class="stat-card-value" id="ang-title">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Input</span><span class="stat-card-value" id="ang-seq">—</span></div></div>
            </div>
            <div class="p-4 rounded-3 bg-light border mb-3">
                <h6 class="fw-bold mb-2"><i class="fas fa-scroll me-2" style="color:#f59e0b"></i>Meaning</h6>
                <p id="ang-meaning" class="text-secondary mb-0">Enter a number sequence above and click "Decode" to reveal its message.</p>
            </div>
            <div class="p-3 rounded-3" style="background:#fffbeb;border:1.5px solid #fde68a">
                <h6 class="fw-bold mb-2"><i class="fas fa-quote-left me-2" style="color:#f59e0b"></i>Guidance</h6>
                <p id="ang-guidance" class="text-secondary mb-0 fst-italic">Your spiritual guidance will appear here.</p>
            </div>
        </div>
    </div>
</div>
<style>.tool-card-stacked{border-radius:16px;background:#fff}.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}.btn-light-v2{background:#f1f5f9;border:none;color:#475569;font-weight:600}.btn-light-v2:hover{background:#e2e8f0;color:#1e293b}</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var meanings={
        '0':{t:'Infinite Potential',m:'The number 0 represents the beginning of a spiritual journey, oneness, and the void. Trust your intuition and recognize the infinite support available to you.',g:'You are at a point of limitless possibilities. Embrace the unknown.'},
        '1':{t:'New Beginnings',m:'Number 1 is a message that your thoughts are manifesting rapidly. Focus on your desires rather than your fears. A portal of opportunity is opening.',g:'Your thoughts create your reality. Keep them positive and focused.'},
        '2':{t:'Trust & Harmony',m:'Number 2 signifies balance, faith, and patience. Your prayers are being answered, even if results are not visible yet.',g:'Have courage and faith. Everything is unfolding as it should.'},
        '3':{t:'Divine Guidance',m:'Number 3 indicates that Ascended Masters are near you, helping you achieve your purpose. Express your creativity and joy.',g:'You are being supported by high-level spiritual guides. Ask for their help.'},
        '4':{t:'Angelic Protection',m:'Number 4 is a powerful sign that angels are surrounding you, offering support and encouragement. You have inner strength.',g:'You are never alone. The angels are working behind the scenes for you.'},
        '5':{t:'Significant Change',m:'Number 5 heralds major life changes. These shifts are positive and will bring you closer to your soul mission.',g:'Change is necessary for growth. Trust the transformation.'},
        '6':{t:'Material Balance',m:'Number 6 asks you to balance material worries with spiritual focus. Trust that your physical needs will be met.',g:'Shift your focus from "how" to "why." Abundance follows alignment.'},
        '7':{t:'Spiritual Awakening',m:'Number 7 is a sign of good fortune and spiritual enlightenment. You are on the right path.',g:'Your persistence is paying off. Keep listening to your inner wisdom.'},
        '8':{t:'Abundance & Karma',m:'Number 8 signifies that financial or spiritual abundance is on its way. It also reminds you of the law of cause and effect.',g:'Success is coming. Maintain your integrity and continue to work hard.'},
        '9':{t:'Completion & Purpose',m:'Number 9 indicates that a chapter of your life is ending to make way for your true soul mission.',g:'The world needs your unique gifts. Let go of the old to welcome the new.'}
    };
    var composites={
        '1111':{t:'Manifestation Portal',m:'1111 is a high-vibrational wake-up call. A portal of manifestation has opened, and your thoughts are becoming reality at lightning speed.',g:'Focus intensely on what you want right now. The universe is taking a snapshot of your mind.'},
        '1212':{t:'Stepping Stones',m:'1212 indicates you are moving in the right direction. Step out of your comfort zone and pursue your higher calling.',g:'Small steps lead to great distances. Keep moving forward.'},
        '1010':{t:'Spiritual Expansion',m:'1010 is a message of spiritual development and enlightenment. The universe is guiding you toward higher consciousness.',g:'Your soul is ready for a major leap. Stay open to divine inspiration.'}
    };
    function decode(){
        var v=document.getElementById('ang-input').value.trim(),errDiv=document.getElementById('ang-err'),errMsg=document.getElementById('ang-err-msg');
        errDiv.classList.add('d-none');
        if(!v){errDiv.classList.remove('d-none');errMsg.textContent='Please enter a number sequence.';return;}
        if(!/^\d+$/.test(v)){errDiv.classList.remove('d-none');errMsg.textContent='Please enter only digits (0-9).';return;}
        var digit=v[0],data=composites[v]||meanings[digit]||meanings['1'];
        var sum=v.split('').reduce(function(a,b){return a+parseInt(b||0);},0);
        while(sum>9&&sum!==11&&sum!==22&&sum!==33){sum=sum.toString().split('').reduce(function(a,b){return a+parseInt(b);},0);}
        document.getElementById('ang-vib').textContent=sum;
        document.getElementById('ang-title').textContent=data.t;
        document.getElementById('ang-seq').textContent=v;
        document.getElementById('ang-meaning').textContent=data.m;
        document.getElementById('ang-guidance').textContent=data.g;
    }
    document.getElementById('ang-calc').addEventListener('click',decode);
    document.querySelectorAll('.ang-qf').forEach(function(b){b.addEventListener('click',function(){document.getElementById('ang-input').value=this.dataset.val;decode();});});
    document.getElementById('ang-reset').addEventListener('click',function(){
        document.getElementById('ang-input').value='';document.getElementById('ang-err').classList.add('d-none');
        ['ang-vib','ang-title','ang-seq'].forEach(function(id){document.getElementById(id).textContent='—';});
        document.getElementById('ang-meaning').textContent='Enter a number sequence above and click "Decode" to reveal its message.';
        document.getElementById('ang-guidance').textContent='Your spiritual guidance will appear here.';
    });
    document.getElementById('ang-copy').addEventListener('click',function(){
        var t='Angel Number: '+document.getElementById('ang-seq').textContent+'\nTheme: '+document.getElementById('ang-title').textContent+'\nVibration: '+document.getElementById('ang-vib').textContent+'\nMeaning: '+document.getElementById('ang-meaning').textContent+'\nGuidance: '+document.getElementById('ang-guidance').textContent;
        navigator.clipboard.writeText(t).then(function(){var o=document.getElementById('ang-copy').innerHTML;document.getElementById('ang-copy').innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(function(){document.getElementById('ang-copy').innerHTML=o;},2000);});
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\angel-number-calculator.blade.php ENDPATH**/ ?>