<div class="row g-4 destiny-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Full Birth Name</label>
                        <input type="text" id="dest-name" class="form-control form-control-lg rounded-3" placeholder="Enter your full birth name" value="John Fitzgerald Kennedy">
                        <span class="text-muted small">Your full name acts as a vibrational signature for your destiny.</span>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Historic Signatures:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 dest-quick" data-name="Abraham Lincoln">Abraham Lincoln</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 dest-quick" data-name="Eleanor Roosevelt">Eleanor Roosevelt</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 dest-quick" data-name="Martin Luther King">Martin Luther King</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="dest-output-card" style="--tool-hue:40;--tool-color:#f59e0b;--tool-bg:rgba(245,158,11,.04);transition:all .4s">
            <div class="output-hero">
                <span class="output-hero-label">Expression Number</span>
                <div class="output-hero-value" id="out-dest-value" style="font-size:4rem">1</div>
                <div class="badge rounded-pill px-3 py-1 mb-3 d-none" id="out-dest-master" style="background:#fef3c7;color:#92400e;border:1px solid #fde68a;font-size:0.8rem;">
                    <i class="fas fa-crown me-1"></i> MASTER NUMBER
                </div>
                <span class="output-hero-unit" id="out-dest-archetype">The Master Visionary</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-12 col-md-4"><div class="stat-card"><span class="stat-card-label">Outer Expression</span><span class="stat-card-value" id="out-dest-outer">-</span></div></div>
                <div class="col-12 col-md-4"><div class="stat-card"><span class="stat-card-label">Natural Talents</span><span class="stat-card-value" id="out-dest-talents" style="font-size:0.9rem">-</span></div></div>
                <div class="col-12 col-md-4"><div class="stat-card"><span class="stat-card-label">Soul Vibe</span><span class="stat-card-value" id="out-dest-soul" style="font-size:0.9rem">-</span></div></div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-feather-pointed me-2 text-primary"></i>Destiny Interpretation</h6>
                <p id="out-dest-desc" class="text-secondary small leading-relaxed mb-0">
                    Your Expression Number (also known as the Destiny Number) describes the gifts and talents you were born with and the goals you are here to achieve.
                </p>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <div class="p-3 rounded-4 bg-light-v2 border">
                        <span class="d-block small fw-bold text-muted text-uppercase mb-2">Life Mission</span>
                        <div id="out-dest-mission" class="small text-dark fw-bold">-</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded-4 bg-light-v2 border">
                        <span class="d-block small fw-bold text-muted text-uppercase mb-2">Key Challenges</span>
                        <div id="out-dest-challenge" class="small text-dark fw-bold">-</div>
                    </div>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="dest-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Expression Analysis</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const nameEl=$('dest-name');

    const pythagoreanMap = {
        a:1, b:2, c:3, d:4, e:5, f:6, g:7, h:8, i:9,
        j:1, k:2, l:3, m:4, n:5, o:6, p:7, q:8, r:9,
        s:1, t:2, u:3, v:4, w:5, x:6, y:7, z:8
    };

    const destData = {
        1: { title: "The Individualist", talents: "Leading, Creating, Initiating", soul: "Pioneer", mission: "To manifest individuality and lead with courage.", challenge: "Aggression, Ego, Self-doubt", desc: "You are here to stand alone and lead. Your destiny is to be original and courageous in all your endeavors." },
        2: { title: "The Collaborator", talents: "Mediating, Supporting, Loving", soul: "Peacemaker", mission: "To find harmony and build partnerships.", challenge: "Hypersensitivity, Indecision", desc: "Your gifts lie in your sensitivity and ability to work with others. You are the glue that holds teams together." },
        3: { title: "The Communicator", talents: "Writing, Speaking, Creating", soul: "Socialite", mission: "To express joy and inspire through words.", challenge: "Scattered energy, Superficiality", desc: "You have a natural charm and creative flair. Your destiny is to communicate and share your optimistic spirit." },
        4: { title: "The Disciplinarian", talents: "Organizing, Building, Managing", soul: "Worker", mission: "To build a solid foundation for yourself and others.", challenge: "Rigidity, Stubbornness", desc: "You are practical and methodical. Your destiny is to create order and stability in the material world." },
        5: { title: "The Versatile One", talents: "Exploring, Teaching, Communicating", soul: "Free Spirit", mission: "To embrace freedom and facilitate change.", challenge: "Impulsiveness, Restlessness", desc: "You are dynamic and adaptable. Your destiny is to experience the world's variety and teach others through your experiences." },
        6: { title: "The Nurturer", talents: "Healing, Caring, Teaching", soul: "Giver", mission: "To serve family and community with love.", challenge: "Over-responsibility, Meddling", desc: "You find fulfillment in service. Your destiny is to create a beautiful, harmonious environment for those you love." },
        7: { title: "The Intellectual", talents: "Analyzing, Researching, Intuiting", soul: "Sage", mission: "To seek truth and hidden knowledge.", challenge: "Isolation, Cynicism", desc: "You have a brilliant, investigative mind. Your destiny is to look beneath the surface and share your deep insights." },
        8: { title: "The Manager", talents: "Commanding, Organizing, Achieving", soul: "Executive", mission: "To master the material world with integrity.", challenge: "Greed, Misuse of power", desc: "You are a natural leader in business. Your destiny is to handle power and wealth while maintaining spiritual balance." },
        9: { title: "The Humanitarian", talents: "Giving, Creating, Healing", soul: "Universalist", mission: "To serve the global community with compassion.", challenge: "Emotional overwhelm, Perfectionism", desc: "You are an old soul. Your destiny is to serve humanity selflessly and lead with a universal perspective." },
        11: { title: "The Illumined One", talents: "Inspiring, Intuiting, Visioning", soul: "Psychic", mission: "To enlighten others through spiritual vision.", challenge: "Nervous tension, Impracticality", desc: "A Master Number of high vibration. You are here to inspire others and act as a bridge to higher consciousness." },
        22: { title: "The Master Builder", talents: "Manifesting, Planning, Executing", soul: "Architect", mission: "To manifest grand visions for the benefit of humanity.", challenge: "Arrogance, Overwhelming ambition", desc: "The most powerful potential. You can take the loftiest visions and ground them into physical reality on a massive scale." },
        33: { title: "The Master Teacher", talents: "Healing, Loving, Serving", soul: "Avatar", mission: "To heal and uplift humanity through universal love.", challenge: "Self-sacrifice to a fault", desc: "The vibration of unconditional love. You are here to serve as a beacon of hope and a master healer for the world." }
    };

    function reduce(num) {
        if (num === 11 || num === 22 || num === 33) return num;
        while (num > 9) {
            num = String(num).split('').reduce((sum, d) => sum + parseInt(d), 0);
            if (num === 11 || num === 22 || num === 33) break;
        }
        return num;
    }

    function calculate(){
        const name = nameEl.value.toLowerCase().replace(/[^a-z]/g, '');
        if(!name) return;

        let total = 0;
        for(let char of name) {
            total += pythagoreanMap[char] || 0;
        }

        const finalNum = reduce(total);
        const data = destData[finalNum] || destData[reduce(finalNum)];

        $('out-dest-value').textContent = finalNum;
        $('out-dest-archetype').textContent = data.title;
        $('out-dest-outer').textContent = finalNum % 9 || 9;
        $('out-dest-talents').textContent = data.talents;
        $('out-dest-soul').textContent = data.soul;
        $('out-dest-desc').textContent = data.desc;
        $('out-dest-mission').textContent = data.mission;
        $('out-dest-challenge').textContent = data.challenge;

        if([11, 22, 33].includes(finalNum)) {
            $('out-dest-master').classList.remove('d-none');
        } else {
            $('out-dest-master').classList.add('d-none');
        }

        $('dest-output-card').style.opacity = '1';
    }

    nameEl.addEventListener('input', calculate);
    document.querySelectorAll('.dest-quick').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            nameEl.value = btn.dataset.name;
            calculate();
        });
    });

    $('dest-copy').addEventListener('click', function(){
        const text=`Expression Report\nName: ${nameEl.value}\nNumber: ${$('out-dest-value').textContent}\nArchetype: ${$('out-dest-archetype').textContent}\nMission: ${$('out-dest-mission').textContent}\n— ToolsHub Numerology`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML;
            this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.destiny-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.destiny-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.destiny-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.destiny-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.destiny-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.destiny-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.destiny-rebuilt .leading-relaxed{line-height:1.6}
.destiny-rebuilt .bg-light-v2 { background-color: #f8fafc; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\destiny-number.blade.php ENDPATH**/ ?>