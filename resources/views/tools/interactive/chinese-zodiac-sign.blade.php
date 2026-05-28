<div class="row g-4 chinese-zodiac-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Date of Birth</label>
                        <input type="date" id="dob" class="form-control form-control-lg rounded-3" value="1990-01-27">
                        <span class="text-muted small">Required for accurate Jan/Feb Lunar Year transitions.</span>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="button" class="btn btn-danger w-100 py-3 rounded-3 fw-bold shadow-sm" id="btn-calculate">Reveal My Lunar Destiny</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-card" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(220,38,38,.04);display:none;">
            <div class="output-hero text-center py-4">
                <span class="output-hero-label">Your Chinese Zodiac Sign</span>
                <div class="output-hero-value" id="out-animal" style="font-size:4rem">Horse</div>
                <div class="badge bg-danger text-white px-4 py-2 rounded-pill mt-2 fs-6" id="out-element">Metal Element</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Yin/Yang</span><span class="stat-card-value" id="out-yinyang">Yang</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Lucky Colors</span><span class="stat-card-value" id="out-colors">Gold, White</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Best Match</span><span class="stat-card-value" id="out-match">Tiger, Dog</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Lucky Number</span><span class="stat-card-value" id="out-number">2, 3, 7</span></div></div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-quote-left me-2 text-danger"></i>Personality Profile</h6>
                <div id="out-personality" class="text-secondary leading-relaxed"></div>
            </div>

            <div class="mt-4" id="out-details"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const dobInput=$('dob'), outputCard=$('output-card');

    // Lunar New Year Start Dates (1900 - 2030)
    const lunarNewYears = {
        1980:"1980-02-16", 1981:"1981-02-05", 1982:"1982-01-25", 1983:"1983-02-13", 1984:"1984-02-02", 
        1985:"1985-02-20", 1986:"1986-02-09", 1987:"1987-01-29", 1988:"1988-02-17", 1989:"1989-02-06", 
        1990:"1990-01-27", 1991:"1991-02-15", 1992:"1992-02-04", 1993:"1993-01-23", 1994:"1994-02-10", 
        1995:"1995-01-31", 1996:"1996-02-19", 1997:"1997-02-07", 1998:"1998-01-28", 1999:"1999-02-16", 
        2000:"2000-02-05", 2001:"2001-01-24", 2002:"2002-02-12", 2003:"2003-02-01", 2004:"2004-01-22", 
        2005:"2005-02-09", 2006:"2006-01-29", 2007:"2007-02-18", 2008:"2008-02-07", 2009:"2009-01-26", 
        2010:"2010-02-14", 2011:"2011-02-03", 2012:"2012-01-23", 2013:"2013-02-10", 2014:"2014-01-31", 
        2015:"2015-02-19", 2016:"2016-02-08", 2017:"2017-01-28", 2018:"2018-02-16", 2019:"2019-02-05", 
        2020:"2020-01-25", 2021:"2021-02-12", 2022:"2022-02-01", 2023:"2023-01-22", 2024:"2024-02-10", 
        2025:"2025-01-29"
    };

    const animals = ["Rat", "Ox", "Tiger", "Rabbit", "Dragon", "Snake", "Horse", "Goat", "Monkey", "Rooster", "Dog", "Pig"];
    const elements = ["Metal", "Water", "Wood", "Fire", "Earth"];
    
    const animalData = {
        "Rat": { match: "Dragon, Monkey", color: "Blue, Gold", num: "2, 3", text: "Quick-witted, resourceful, versatile, and kind." },
        "Ox": { match: "Rat, Snake, Rooster", color: "White, Yellow", num: "1, 4", text: "Diligent, dependable, strong, and determined." },
        "Tiger": { match: "Horse, Dog", color: "Blue, Grey", num: "1, 3, 4", text: "Brave, confident, competitive, and charming." },
        "Rabbit": { match: "Goat, Dog, Pig", color: "Red, Pink", num: "3, 4, 6", text: "Quiet, elegant, kind, and responsible." },
        "Dragon": { match: "Rat, Monkey, Rooster", color: "Gold, Silver", num: "1, 6, 7", text: "Confident, intelligent, and enthusiastic." },
        "Snake": { match: "Dragon, Rooster", color: "Black, Red", num: "2, 8, 9", text: "Enigmatic, intelligent, and wise." },
        "Horse": { match: "Tiger, Goat, Dog", color: "Yellow, Green", num: "2, 3, 7", text: "Animated, active, and energetic." },
        "Goat": { match: "Rabbit, Horse, Pig", color: "Brown, Red", num: "2, 7", text: "Calm, gentle, and sympathetic." },
        "Monkey": { match: "Rat, Dragon", color: "White, Gold", num: "4, 9", text: "Sharp, smart, and curious." },
        "Rooster": { match: "Ox, Dragon, Snake", color: "Gold, Brown", num: "5, 7, 8", text: "Observant, hardworking, and courageous." },
        "Dog": { match: "Tiger, Rabbit, Horse", color: "Green, Red", num: "3, 4, 9", text: "Lovely, honest, and prudent." },
        "Pig": { match: "Goat, Rabbit", color: "Yellow, Grey", num: "2, 5, 8", text: "Compassionate, generous, and diligent." }
    };

    function calculate() {
        const dob = new Date(dobInput.value);
        if(isNaN(dob)) return;

        const year = dob.getFullYear();
        const lnyStr = lunarNewYears[year];
        if(!lnyStr) return;

        const lny = new Date(lnyStr);
        let lunarYear = year;
        if(dob < lny) lunarYear = year - 1;

        const animalIdx = (lunarYear - 1900) % 12;
        const animal = animals[animalIdx];
        
        // Element is based on the last digit of the year
        const lastDigit = lunarYear % 10;
        const elementIdx = Math.floor(lastDigit / 2);
        const element = elements[elementIdx];
        
        const isYang = lunarYear % 2 === 0;
        const data = animalData[animal];

        $('out-animal').textContent = animal;
        $('out-element').textContent = `${element} Element`;
        $('out-yinyang').textContent = isYang ? "Yang" : "Yin";
        $('out-colors').textContent = data.color;
        $('out-match').textContent = data.match;
        $('out-number').textContent = data.num;
        $('out-personality').textContent = data.text;

        outputCard.style.display = 'block';
        outputCard.scrollIntoView({behavior:'smooth', block:'center'});
    }

    $('btn-calculate').addEventListener('click', calculate);
    dobInput.addEventListener('change', calculate);
    
    calculate();
});
</script>

<style>
.chinese-zodiac-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.chinese-zodiac-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.chinese-zodiac-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.chinese-zodiac-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.chinese-zodiac-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.chinese-zodiac-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.leading-relaxed { line-height: 1.6; }
</style>
