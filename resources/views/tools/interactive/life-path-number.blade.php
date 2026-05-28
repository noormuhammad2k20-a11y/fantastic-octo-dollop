<div class="row g-4 life-path-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label-custom">Birth Date</label>
                        <input type="date" id="lp-date" class="form-control form-control-lg rounded-3" value="1990-01-01">
                        <span class="text-muted small">The day you were born defines your primary cosmic vibration.</span>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Include Master Numbers</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="lp-master" checked>
                            <label class="form-check-label small text-muted" for="lp-master">Allow 11, 22, 33</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Check:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 lp-quick" data-date="1961-08-04">Barack Obama</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 lp-quick" data-date="1955-10-28">Bill Gates</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 lp-quick" data-date="1946-06-14">Donald Trump</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="lp-output-card" style="--tool-hue:150;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04);transition:all .4s">
            <div class="output-hero">
                <span class="output-hero-label">Your Life Path Number</span>
                <div class="output-hero-value" id="out-lp-value" style="font-size:4rem">1</div>
                <div class="badge rounded-pill px-3 py-1 mb-3 d-none" id="out-lp-master-badge" style="background:#fef3c7;color:#92400e;border:1px solid #fde68a;font-size:0.8rem;">
                    <i class="fas fa-crown me-1"></i> MASTER NUMBER
                </div>
                <span class="output-hero-unit" id="out-lp-archetype">The Creative Pioneer</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-12 col-md-4"><div class="stat-card"><span class="stat-card-label">Core Essence</span><span class="stat-card-value" id="out-lp-essence">-</span></div></div>
                <div class="col-12 col-md-4"><div class="stat-card"><span class="stat-card-label">Key Strengths</span><span class="stat-card-value" id="out-lp-strengths" style="font-size:0.9rem">-</span></div></div>
                <div class="col-12 col-md-4"><div class="stat-card"><span class="stat-card-label">Compatibility</span><span class="stat-card-value" id="out-lp-comp" style="font-size:0.9rem">-</span></div></div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-scroll me-2 text-primary"></i>Your Cosmic Blueprint</h6>
                <p id="out-lp-desc" class="text-secondary small leading-relaxed mb-0">
                    Your life path number reveals the broad outline of the opportunities, challenges, and lessons you will encounter in this lifetime.
                </p>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <div class="p-3 rounded-4 bg-light-v2 border">
                        <span class="d-block small fw-bold text-muted text-uppercase mb-2">Life Purpose</span>
                        <div id="out-lp-purpose" class="small text-dark fw-bold">-</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded-4 bg-light-v2 border">
                        <span class="d-block small fw-bold text-muted text-uppercase mb-2">Career Path</span>
                        <div id="out-lp-career" class="small text-dark fw-bold">-</div>
                    </div>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="lp-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Life Path Analysis</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const dateEl=$('lp-date'), masterEl=$('lp-master');

    const lpData = {
        1: { title: "The Creative Pioneer", essence: "Leadership", strengths: "Independence, Courage, Innovation", comp: "3, 5, 7", purpose: "To learn self-reliance and manifest unique visions.", career: "Entrepreneur, Executive, Freelancer", desc: "You are a natural leader, designed to be independent and self-motivated. Your path is about developing your individual will." },
        2: { title: "The Diplomatic Partner", essence: "Harmony", strengths: "Empathy, Cooperation, Patience", comp: "2, 4, 8", purpose: "To learn the power of partnership and mediation.", career: "Mediator, Counselor, Artist", desc: "You are the peacemaker. Your path is about finding balance, working behind the scenes, and supporting others." },
        3: { title: "The Joyful Expresser", essence: "Creativity", strengths: "Communication, Charm, Optimism", comp: "1, 5, 7", purpose: "To spread joy and express creative truth.", career: "Writer, Performer, Designer", desc: "You are here to shine and communicate. Your path is about self-expression and uplifting others through your gifts." },
        4: { title: "The Practical Builder", essence: "Stability", strengths: "Order, Reliability, Discipline", comp: "2, 6, 8", purpose: "To build lasting foundations for others.", career: "Engineer, Manager, Architect", desc: "You are the foundation of society. Your path is about hard work, honesty, and turning abstract ideas into concrete reality." },
        5: { title: "The Free Adventurer", essence: "Freedom", strengths: "Adaptability, Curiosity, Dynamism", comp: "1, 3, 7", purpose: "To experience life's variety and embrace change.", career: "Traveler, Marketing, Sales", desc: "You crave freedom and change. Your path is about experiencing all facets of the physical world and learning from them." },
        6: { title: "The Loving Nurturer", essence: "Responsibility", strengths: "Service, Compassion, Home", comp: "2, 4, 8", purpose: "To provide care and beauty to the world.", career: "Teacher, Doctor, Interior Designer", desc: "You are the caretaker. Your path is about family, community service, and creating harmonious environments." },
        7: { title: "The Wise Seeker", essence: "Knowledge", strengths: "Analysis, Intuition, Spirituality", comp: "1, 3, 5", purpose: "To find the deeper meaning of existence.", career: "Researcher, Philosopher, Scientist", desc: "You are the truth-seeker. Your path is about looking within, analyzing mysteries, and developing your strong intuition." },
        8: { title: "The Ambitious Powerhouse", essence: "Achievement", strengths: "Authority, Success, Endurance", comp: "2, 4, 6", purpose: "To master the material world with integrity.", career: "Business Owner, Lawyer, Finance", desc: "You are the manifestor. Your path is about building power and wealth while maintaining karmic and spiritual balance." },
        9: { title: "The Global Humanitarian", essence: "Compassion", strengths: "Selflessness, Idealism, Art", comp: "3, 6, 9", purpose: "To serve humanity and lead with love.", career: "Non-profit, Artist, Teacher", desc: "You are the old soul. Your path is about universal love, letting go of the ego, and leaving the world better than you found it." },
        11: { title: "The Master Messenger", essence: "Inspiration", strengths: "Intuition, Vision, Charisma", comp: "2, 4, 8", purpose: "To enlighten others through spiritual insight.", career: "Spiritual Leader, Artist, Innovator", desc: "The highest intuition. You are a bridge between worlds, here to inspire and transform consciousness." },
        22: { title: "The Master Architect", essence: "Manifestation", strengths: "Practicality, Scale, Vision", comp: "4, 6, 8", purpose: "To manifest grand designs on a global scale.", career: "Global Leader, Philanthropist, CEO", desc: "The most powerful path. You have the vision of an 11 but the practical grounding of a 4 to build empires." },
        33: { title: "The Master Healer", essence: "Universal Love", strengths: "Sacrifice, Compassion, Wisdom", comp: "3, 6, 9", purpose: "To heal and uplift humanity unconditionally.", career: "Humanitarian, Spiritual Teacher, Healer", desc: "The path of 'Christ consciousness'. You are here to serve at the highest level through love and selflessness." }
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
        const dateVal = dateEl.value;
        if(!dateVal) return;

        const [y, m, d] = dateVal.split('-').map(Number);
        const allowMaster = masterEl.checked;

        const rM = reduce(m, allowMaster);
        const rD = reduce(d, allowMaster);
        const rY = reduce(y, allowMaster);
        const finalLP = reduce(rM + rD + rY, allowMaster);

        const data = lpData[finalLP] || lpData[reduce(finalLP, false)];

        $('out-lp-value').textContent = finalLP;
        $('out-lp-archetype').textContent = data.title;
        $('out-lp-essence').textContent = data.essence;
        $('out-lp-strengths').textContent = data.strengths;
        $('out-lp-comp').textContent = data.comp;
        $('out-lp-desc').textContent = data.desc;
        $('out-lp-purpose').textContent = data.purpose;
        $('out-lp-career').textContent = data.career;

        if([11, 22, 33].includes(finalLP)) {
            $('out-lp-master-badge').classList.remove('d-none');
        } else {
            $('out-lp-master-badge').classList.add('d-none');
        }

        $('lp-output-card').style.opacity = '1';
    }

    [dateEl, masterEl].forEach(e=>e.addEventListener('input', calculate));
    document.querySelectorAll('.lp-quick').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            dateEl.value = btn.dataset.date;
            calculate();
        });
    });

    $('lp-copy').addEventListener('click', function(){
        const text=`Life Path Report\nNumber: ${$('out-lp-value').textContent}\nArchetype: ${$('out-lp-archetype').textContent}\nPurpose: ${$('out-lp-purpose').textContent}\n— ToolsHub Numerology`;
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
.life-path-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.life-path-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.life-path-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.life-path-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.life-path-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.life-path-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.life-path-calc-rebuilt .leading-relaxed{line-height:1.6}
.life-path-calc-rebuilt .bg-light-v2 { background-color: #f8fafc; }
</style>
