<div class="row g-4 destiny-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label-custom">Full Birth Name</label>
                        <input type="text" id="dn-name" class="form-control form-control-lg rounded-3" placeholder="Enter your full birth name" value="John Doe">
                        <span class="text-muted small">Use your full name as it appears on your birth certificate.</span>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Numerology System</label>
                        <select id="dn-system" class="form-select form-select-lg rounded-3">
                            <option value="pythagorean" selected>Pythagorean (Modern)</option>
                            <option value="chaldean">Chaldean (Ancient)</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Names:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 dn-quick" data-name="George Washington">George Washington</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 dn-quick" data-name="Albert Einstein">Albert Einstein</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 dn-quick" data-name="Marie Curie">Marie Curie</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="dn-output-card" style="--tool-hue:240;--tool-color:#6366f1;--tool-bg:rgba(99,102,241,.04);transition:all .4s">
            <div class="output-hero">
                <span class="output-hero-label" id="out-dn-label">Your Destiny Number</span>
                <div class="output-hero-value" id="out-dn-value" style="font-size:4rem">1</div>
                <div class="badge rounded-pill px-3 py-1 mb-3 d-none" id="out-dn-master" style="background:#fef3c7;color:#92400e;border:1px solid #fde68a;font-size:0.8rem;">
                    <i class="fas fa-crown me-1"></i> MASTER NUMBER
                </div>
                <span class="output-hero-unit" id="out-dn-archetype">The Creative Leader</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-12 col-md-4"><div class="stat-card"><span class="stat-card-label">Core Vibration</span><span class="stat-card-value" id="out-dn-vib">-</span></div></div>
                <div class="col-12 col-md-4"><div class="stat-card"><span class="stat-card-label">Key Traits</span><span class="stat-card-value" id="out-dn-traits" style="font-size:0.9rem">-</span></div></div>
                <div class="col-12 col-md-4"><div class="stat-card"><span class="stat-card-label">Lucky Colors</span><span class="stat-card-value" id="out-dn-colors" style="font-size:0.9rem">-</span></div></div>
            </div>

            <div class="mt-4" id="out-dn-analysis">
                <!-- Analysis injected here -->
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="dn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Destiny Analysis</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const nameEl=$('dn-name'), sysEl=$('dn-system');

    const pythagoreanMap = {
        a:1, b:2, c:3, d:4, e:5, f:6, g:7, h:8, i:9,
        j:1, k:2, l:3, m:4, n:5, o:6, p:7, q:8, r:9,
        s:1, t:2, u:3, v:4, w:5, x:6, y:7, z:8
    };

    const chaldeanMap = {
        a:1, i:1, j:1, q:1, y:1,
        b:2, k:2, r:2,
        c:3, g:3, l:3, s:3,
        d:4, m:4, t:4,
        e:5, h:5, n:5, x:5,
        u:6, v:6, w:6,
        o:7, z:7,
        f:8, p:8
    };

    const lpData = {
        1: { title: "The Pioneer", traits: "Independent, Original, Ambitious", colors: "Red, Gold", desc: "You are a natural-born leader, destined to carve your own path and inspire others with your courage and innovation." },
        2: { title: "The Peacemaker", traits: "Cooperative, Diplomatic, Intuitive", colors: "Orange, Silver", desc: "Your destiny is one of harmony and partnership. You excel at bringing people together and finding balance in all things." },
        3: { title: "The Communicator", traits: "Creative, Social, Expressive", colors: "Yellow, Violet", desc: "You are here to express yourself and spread joy. Your creativity and charm are your greatest gifts to the world." },
        4: { title: "The Architect", traits: "Practical, Disciplined, Grounded", colors: "Green, Brown", desc: "You find fulfillment in building lasting structures—whether physical, social, or mental. Your reliability is legendary." },
        5: { title: "The Adventurer", traits: "Dynamic, Curious, Versatile", colors: "Blue, Turquoise", desc: "Your path is one of freedom and constant change. You thrive on new experiences and seek to understand the world's variety." },
        6: { title: "The Nurturer", traits: "Responsible, Compassionate, Loving", colors: "Indigo, Pink", desc: "Your destiny is centered on service, family, and harmony. You are the heartbeat of your community, providing care and beauty." },
        7: { title: "The Seeker", traits: "Analytical, Spiritual, Intellectual", colors: "Purple, White", desc: "You are destined to search for truth and hidden knowledge. Solitude and contemplation are your tools for wisdom." },
        8: { title: "The Powerhouse", traits: "Authoritative, Successful, Balanced", colors: "Grey, Black", desc: "Your path leads to material success and mastery over the physical world, balanced by a deep understanding of karma." },
        9: { title: "The Humanitarian", traits: "Selfless, Creative, Idealistic", colors: "Gold, Rose", desc: "You are an old soul destined to serve humanity. Your compassion knows no bounds, and you lead by universal example." },
        11: { title: "The Master Visionary", traits: "Intuitive, Inspired, Charismatic", colors: "Electric Blue, Silver", desc: "As a Master Number, your path is intense. You are a bridge between the spiritual and physical, here to enlighten others." },
        22: { title: "The Master Builder", traits: "Visionary, Practical, Powerful", colors: "Deep Green, Gold", desc: "You have the potential to manifest grand visions into physical reality on a global scale. You are a master of large-scale systems." },
        33: { title: "The Master Teacher", traits: "Compassionate, Healing, Selfless", colors: "Lavender, Soft Blue", desc: "The highest vibration of service. You are here to heal and uplift humanity through unconditional love and profound wisdom." }
    };

    function reduce(num, allowMaster = true) {
        if (allowMaster && (num === 11 || num === 22 || num === 33)) return num;
        while (num > 9) {
            num = String(num).split('').reduce((sum, d) => sum + parseInt(d), 0);
            if (allowMaster && (num === 11 || num === 22 || num === 33)) break;
        }
        return num;
    }

    function calculate(){
        const name = nameEl.value.toLowerCase().replace(/[^a-z]/g, '');
        const system = sysEl.value;
        if(!name) return;

        const map = system === 'pythagorean' ? pythagoreanMap : chaldeanMap;
        let total = 0;
        for(let char of name) {
            total += map[char] || 0;
        }

        const finalNum = reduce(total, true);
        const data = lpData[finalNum] || lpData[reduce(finalNum, false)];

        $('out-dn-value').textContent = finalNum;
        $('out-dn-archetype').textContent = data.title;
        $('out-dn-vib').textContent = total;
        $('out-dn-traits').textContent = data.traits;
        $('out-dn-colors').textContent = data.colors;

        if([11, 22, 33].includes(finalNum)) {
            $('out-dn-master').classList.remove('d-none');
        } else {
            $('out-dn-master').classList.add('d-none');
        }

        $('out-dn-analysis').innerHTML = `
            <h6 class="fw-bold mb-3"><i class="fas fa-stars me-2 text-primary"></i>Destiny Analysis</h6>
            <p class="text-secondary small leading-relaxed mb-0">${data.desc}</p>
        `;

        $('dn-output-card').style.opacity = '1';
    }

    [nameEl, sysEl].forEach(e=>e.addEventListener('input', calculate));
    document.querySelectorAll('.dn-quick').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            nameEl.value = btn.dataset.name;
            calculate();
        });
    });

    $('dn-copy').addEventListener('click', function(){
        const text=`Destiny Number Report\nName: ${nameEl.value}\nNumber: ${$('out-dn-value').textContent}\nArchetype: ${$('out-dn-archetype').textContent}\nTraits: ${$('out-dn-traits').textContent}\n— ToolsHub Numerology`;
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
.destiny-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.destiny-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.destiny-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.destiny-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.destiny-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.destiny-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.destiny-calc-rebuilt .leading-relaxed{line-height:1.6}
</style>
