<div class="row g-4 celtic-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Date of Birth</label>
                        <input type="date" id="dob" class="form-control form-control-lg rounded-3" value="1995-04-20">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="button" class="btn btn-success w-100 py-3 rounded-3 fw-bold shadow-sm" id="btn-reveal">Discover My Sacred Tree</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-card" style="--tool-hue:140;--tool-color:#16a34a;--tool-bg:rgba(34,197,94,.04);display:none;">
            <div class="output-hero text-center py-4">
                <span class="output-hero-label">Your Celtic Tree Sign</span>
                <div class="output-hero-value" id="out-tree" style="font-size:4rem">Willow</div>
                <div class="badge bg-success text-white px-4 py-2 rounded-pill mt-2 fs-6" id="out-dates">Dec 24 - Jan 20</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Ogham Letter</span><span class="stat-card-value" id="out-ogham">Beith</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Animal Link</span><span class="stat-card-value" id="out-animal">Stag</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Ruler</span><span class="stat-card-value" id="out-ruler">Sun</span></div></div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-seedling me-2 text-success"></i>Tree Attributes</h6>
                <div id="out-desc" class="text-secondary leading-relaxed"></div>
            </div>

            <div class="mt-4" id="out-compat">
                <h6 class="fw-bold mb-3 text-dark">Spiritual Compatibility:</h6>
                <div id="compat-list" class="small text-secondary"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const dobInput=$('dob'), outputCard=$('output-card');

    const treeSigns = [
        {name: "Birch (The Achiever)", ogham: "Beith", dates: "Dec 24 - Jan 20", animal: "Stag", ruler: "Sun", desc: "You are a born leader, always reaching for new heights and inspiring others with your ambition.", match: "Willow, Reed"},
        {name: "Rowan (The Thinker)", ogham: "Luis", dates: "Jan 21 - Feb 17", animal: "Dragon", ruler: "Uranus", desc: "Possessing a visionary mind, you are creative and often have profound spiritual insights.", match: "Hawthorn, Elder"},
        {name: "Ash (The Enchanter)", ogham: "Nion", dates: "Feb 18 - Mar 17", animal: "Seahorse", ruler: "Neptune", desc: "You are compassionate, imaginative, and deeply connected to the emotional world.", match: "Willow, Reed"},
        {name: "Alder (The Trailblazer)", ogham: "Fearn", dates: "Mar 18 - Apr 14", animal: "Fox", ruler: "Mars", desc: "A confident and self-reliant spirit, you prefer to forge your own path and lead by example.", match: "Hawthorn, Oak, Birch"},
        {name: "Willow (The Observer)", ogham: "Saille", dates: "Apr 15 - May 12", animal: "Adder", ruler: "Moon", desc: "Highly intuitive and psychic, you possess a deep understanding of the unseen realms.", match: "Birch, Ivy"},
        {name: "Hawthorn (The Illusionist)", ogham: "Huath", dates: "May 13 - Jun 9", animal: "Owl", ruler: "Vulcan", desc: "Versatile and curious, you have an ability to see the world from multiple perspectives.", match: "Rowan, Ash"},
        {name: "Oak (The Stabilizer)", ogham: "Duir", dates: "Jun 10 - Jul 7", animal: "Wren", ruler: "Jupiter", desc: "Strong, protective, and optimistic, you are the foundation upon which others rely.", match: "Ash, Reed, Ivy"},
        {name: "Holly (The Ruler)", ogham: "Tinne", dates: "Jul 8 - Aug 4", animal: "Cat", ruler: "Earth", desc: "Confident and noble, you possess a natural authority and a desire for excellence.", match: "Ash, Elder"},
        {name: "Hazel (The Knower)", ogham: "Coll", dates: "Aug 5 - Sep 1", animal: "Salmon", ruler: "Mercury", desc: "Intelligent, organized, and detail-oriented, you have a thirst for knowledge and precision.", match: "Hawthorn, Rowan"},
        {name: "Vine (The Equalizer)", ogham: "Muin", dates: "Sep 2 - Sep 29", animal: "Swan", ruler: "Venus", desc: "You appreciate beauty, luxury, and balance. You are a diplomat and a lover of the arts.", match: "Willow, Hazel"},
        {name: "Ivy (The Survivor)", ogham: "Gort", dates: "Sep 30 - Oct 27", animal: "Butterfly", ruler: "Saturn", desc: "Resilient and determined, you can overcome any obstacle through perseverance and grace.", match: "Oak, Ash"},
        {name: "Reed (The Inquisitor)", ogham: "Ngetal", dates: "Oct 28 - Nov 24", animal: "Wolf", ruler: "Pluto", desc: "You seek the truth beneath the surface and possess a powerful, investigative mind.", match: "Ash, Oak"},
        {name: "Elder (The Seeker)", ogham: "Ruis", dates: "Nov 25 - Dec 23", animal: "Falcon", ruler: "Saturn", desc: "Wise beyond your years, you value freedom and honesty above all else.", match: "Rowan, Holly"}
    ];

    function reveal() {
        const dob = new Date(dobInput.value);
        if(isNaN(dob)) return;

        const month = dob.getMonth() + 1;
        const day = dob.getDate();
        
        let sign = null;
        if ((month == 12 && day >= 24) || (month == 1 && day <= 20)) sign = treeSigns[0];
        else if ((month == 1 && day >= 21) || (month == 2 && day <= 17)) sign = treeSigns[1];
        else if ((month == 2 && day >= 18) || (month == 3 && day <= 17)) sign = treeSigns[2];
        else if ((month == 3 && day >= 18) || (month == 4 && day <= 14)) sign = treeSigns[3];
        else if ((month == 4 && day >= 15) || (month == 5 && day <= 12)) sign = treeSigns[4];
        else if ((month == 5 && day >= 13) || (month == 6 && day <= 9)) sign = treeSigns[5];
        else if ((month == 6 && day >= 10) || (month == 7 && day <= 7)) sign = treeSigns[6];
        else if ((month == 7 && day >= 8) || (month == 8 && day <= 4)) sign = treeSigns[7];
        else if ((month == 8 && day >= 5) || (month == 9 && day <= 1)) sign = treeSigns[8];
        else if ((month == 9 && day >= 2) || (month == 9 && day <= 29)) sign = treeSigns[9];
        else if ((month == 9 && day >= 30) || (month == 10 && day <= 27)) sign = treeSigns[10];
        else if ((month == 10 && day >= 28) || (month == 11 && day <= 24)) sign = treeSigns[11];
        else sign = treeSigns[12];

        $('out-tree').textContent = sign.name.split(' (')[0];
        $('out-dates').textContent = sign.dates;
        $('out-ogham').textContent = sign.ogham;
        $('out-animal').textContent = sign.animal;
        $('out-ruler').textContent = sign.ruler;
        $('out-desc').textContent = sign.desc;
        $('compat-list').innerHTML = `<p>Strongest resonance with: <strong>${sign.match}</strong></p>`;

        outputCard.style.display = 'block';
        outputCard.scrollIntoView({behavior:'smooth', block:'center'});
    }

    $('btn-reveal').addEventListener('click', reveal);
    dobInput.addEventListener('change', reveal);
    
    reveal();
});
</script>

<style>
.celtic-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.celtic-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.celtic-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.celtic-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.celtic-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.celtic-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.leading-relaxed { line-height: 1.6; }
</style>
