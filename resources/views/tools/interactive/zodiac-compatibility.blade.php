<div class="row g-4 zodiac-comp-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Your Birth Date</label>
                        <input type="date" id="user-dob" class="form-control form-control-lg rounded-3" value="1995-05-15">
                        <div id="user-sign-label" class="mt-1 small fw-bold text-secondary text-uppercase">Taurus</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Partner's Birth Date</label>
                        <input type="date" id="partner-dob" class="form-control form-control-lg rounded-3" value="1996-08-20">
                        <div id="partner-sign-label" class="mt-1 small fw-bold text-secondary text-uppercase">Leo</div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Relationship Type</label>
                        <select id="rel-type" class="form-select form-select-lg rounded-3">
                            <option value="romantic" selected>❤️ Romantic (Love & Passion)</option>
                            <option value="business">💼 Business (Work & Success)</option>
                            <option value="friendship">🤝 Friendship (Loyalty & Fun)</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="button" class="btn btn-dark w-100 py-3 rounded-3 fw-bold shadow-sm" id="btn-check">Check Compatibility</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-card" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04);display:none;">
            <div class="output-hero">
                <span class="output-hero-label" id="out-rel-label">Romantic Compatibility</span>
                <div class="output-hero-value" id="out-score" style="font-size:4.5rem">0%</div>
                <div class="d-flex align-items-center justify-content-center gap-3 mt-2">
                    <span id="out-user-sign" class="badge bg-white text-dark border px-3 py-2">Taurus</span>
                    <i class="fas fa-plus text-muted small"></i>
                    <span id="out-partner-sign" class="badge bg-white text-dark border px-3 py-2">Leo</span>
                </div>
            </div>

            <div class="position-relative mt-4 mb-2">
                <div class="progress rounded-pill" style="height:16px;background:#f1f5f9"><div id="out-bar" class="progress-bar progress-bar-striped progress-bar-animated rounded-pill" style="width:0%;background:#ec4899;transition:width 1s ease-out"></div></div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Emotional Connection</span><span class="stat-card-value" id="out-emotional">75%</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Communication</span><span class="stat-card-value" id="out-comm">60%</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Overall Match</span><span class="stat-card-value" id="out-overall">Good</span></div></div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-stars me-2 text-primary"></i>Cosmic Assessment</h6>
                <div id="out-description" class="text-secondary leading-relaxed"></div>
            </div>

            <div class="mt-4" id="out-breakdown"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const userDob=$('user-dob'), partnerDob=$('partner-dob'), relType=$('rel-type'), outputCard=$('output-card');

    const signs = [
        {name:'Aries', start:[3,21], end:[4,19], element:'Fire'},
        {name:'Taurus', start:[4,20], end:[5,20], element:'Earth'},
        {name:'Gemini', start:[5,21], end:[6,20], element:'Air'},
        {name:'Cancer', start:[6,21], end:[7,22], element:'Water'},
        {name:'Leo', start:[7,23], end:[8,22], element:'Fire'},
        {name:'Virgo', start:[8,23], end:[9,22], element:'Earth'},
        {name:'Libra', start:[9,23], end:[10,22], element:'Air'},
        {name:'Scorpio', start:[10,23], end:[11,21], element:'Water'},
        {name:'Sagittarius', start:[11,22], end:[12,21], element:'Fire'},
        {name:'Capricorn', start:[12,22], end:[1,19], element:'Earth'},
        {name:'Aquarius', start:[1,20], end:[2,18], element:'Air'},
        {name:'Pisces', start:[2,19], end:[3,20], element:'Water'}
    ];

    function getSign(dateStr) {
        const d = new Date(dateStr);
        const m = d.getMonth() + 1;
        const day = d.getDate();
        return signs.find(s => (m === s.start[0] && day >= s.start[1]) || (m === s.end[0] && day <= s.end[1])) || signs[8];
    }

    const elementMatrix = {
        'Fire': {'Fire': 90, 'Earth': 50, 'Air': 85, 'Water': 40},
        'Earth': {'Fire': 50, 'Earth': 95, 'Air': 55, 'Water': 80},
        'Air': {'Fire': 85, 'Earth': 55, 'Air': 90, 'Water': 45},
        'Water': {'Fire': 40, 'Earth': 80, 'Air': 45, 'Water': 95}
    };

    function check() {
        const userSign = getSign(userDob.value);
        const partnerSign = getSign(partnerDob.value);
        const type = relType.value;

        $('user-sign-label').textContent = userSign.name;
        $('partner-sign-label').textContent = partnerSign.name;

        let baseScore = elementMatrix[userSign.element][partnerSign.element];
        
        // Modifiers based on type
        if(type === 'business') baseScore -= 5;
        if(type === 'friendship') baseScore += 5;
        if(userSign.name === partnerSign.name) baseScore = 98;

        const score = Math.min(Math.max(baseScore, 10), 100);

        $('out-score').textContent = score + '%';
        $('out-bar').style.width = score + '%';
        $('out-user-sign').textContent = userSign.name;
        $('out-partner-sign').textContent = partnerSign.name;
        $('out-rel-label').textContent = type.charAt(0).toUpperCase() + type.slice(1) + ' Compatibility';

        $('out-emotional').textContent = (score - 10) + '%';
        $('out-comm').textContent = (score - 15) + '%';
        $('out-overall').textContent = score > 80 ? 'Excellent' : (score > 60 ? 'Good' : 'Challenging');

        const descriptions = {
            'romantic': score > 80 ? "A soulmate connection. Your elements fuel each other's passion and emotional needs." : (score > 50 ? "A stable relationship that requires open communication to bridge elemental differences." : "An intense attraction that may face friction due to opposing core values."),
            'business': score > 80 ? "A power duo. Your combined strengths ensure strategic success and financial growth." : (score > 50 ? "A functional partnership where clear roles are necessary for productivity." : "Conflict in vision might slow progress; alignment on goals is crucial."),
            'friendship': score > 80 ? "Best friends for life. You understand each other's moods and humor effortlessly." : (score > 50 ? "Loyal companions who enjoy shared activities but have different social needs." : "Casual acquaintances who might find each other's habits confusing at times.")
        };

        $('out-description').innerHTML = `<p><strong>${userSign.name} (${userSign.element})</strong> meets <strong>${partnerSign.name} (${partnerSign.element})</strong>.</p><p>${descriptions[type]}</p>`;

        outputCard.style.display = 'block';
        outputCard.scrollIntoView({behavior:'smooth', block:'center'});
    }

    $('btn-check').addEventListener('click', check);
    [userDob, partnerDob, relType].forEach(el => el.addEventListener('change', check));
    
    check(); // Initial call
});
</script>

<style>
.zodiac-comp-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.zodiac-comp-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.zodiac-comp-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.zodiac-comp-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.zodiac-comp-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.zodiac-comp-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.leading-relaxed { line-height: 1.6; }
</style>
