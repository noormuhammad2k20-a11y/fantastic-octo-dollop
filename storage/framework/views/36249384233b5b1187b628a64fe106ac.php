<div class="row g-4 moon-sign-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Birth Date</label>
                        <input type="date" id="moon-date-input" class="form-control form-control-lg rounded-3" value="1995-05-15">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Birth Time</label>
                        <input type="time" id="moon-time-input" class="form-control form-control-lg rounded-3" value="12:00">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Birth Location</label>
                        <input type="text" id="moon-loc-input" class="form-control form-control-lg rounded-3" placeholder="City, Country" value="New York, USA">
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Famous Moons:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 moon-quick-action" data-date="1926-06-01" data-time="09:30" data-loc="Los Angeles">Marilyn Monroe</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 moon-quick-action" data-date="1940-10-09" data-time="18:30" data-loc="Liverpool">John Lennon</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 moon-quick-action" data-date="1958-08-29" data-time="22:00" data-loc="Gary, IN">Michael Jackson</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="moon-output-container" style="--tool-hue:260;--tool-color:#8b5cf6;--tool-bg:rgba(139,92,246,.04);transition:all .4s">
            <div class="output-hero">
                <span class="output-hero-label">Lunar Placement</span>
                <div class="output-hero-value" id="moon-out-sign" style="font-size:3.5rem">Leo</div>
                <div class="output-hero-unit" id="moon-out-deg">15° 24'</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-12 col-md-4"><div class="stat-card"><span class="stat-card-label">Element</span><span class="stat-card-value" id="moon-out-elem">-</span></div></div>
                <div class="col-12 col-md-4"><div class="stat-card"><span class="stat-card-label">Modality</span><span class="stat-card-value" id="moon-out-mod">-</span></div></div>
                <div class="col-12 col-md-4"><div class="stat-card"><span class="stat-card-label">Ruling Planet</span><span class="stat-card-value" id="moon-out-ruler">-</span></div></div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-sparkles me-2 text-primary"></i>Emotional Profile</h6>
                <p id="moon-out-desc" class="text-secondary small leading-relaxed mb-0">
                    Your moon sign represents your inner world, your instincts, and how you process emotions.
                </p>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <div class="p-3 rounded-4 bg-light-v2 border">
                        <span class="d-block small fw-bold text-muted text-uppercase mb-2">Inner Needs</span>
                        <div id="moon-out-needs" class="small text-dark fw-bold">-</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded-4 bg-light-v2 border">
                        <span class="d-block small fw-bold text-muted text-uppercase mb-2">Shadow Traits</span>
                        <div id="moon-out-shadow" class="small text-dark fw-bold">-</div>
                    </div>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="moon-copy-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Moon Analysis</button>
        </div>
    </div>
</div>

<script>
(function() {
    function initMoonCalculator() {
        const dateEl = document.getElementById('moon-date-input');
        const timeEl = document.getElementById('moon-time-input');
        const locEl = document.getElementById('moon-loc-input');
        const outputCard = document.getElementById('moon-output-container');

        if (!dateEl || !timeEl || !outputCard) return;

        const signs = [
            { name: "Aries", elem: "Fire", mod: "Cardinal", ruler: "Mars", needs: "Action, Independence, Honesty", shadow: "Impatience, Aggression", desc: "You react with passion and directness. You need emotional excitement and the freedom to pursue your own path." },
            { name: "Taurus", elem: "Earth", mod: "Fixed", ruler: "Venus", needs: "Stability, Comfort, Sensuality", shadow: "Stubbornness, Materialism", desc: "You seek security and physical comfort. Your emotional world is steady, grounded, and deeply appreciative of beauty." },
            { name: "Gemini", elem: "Air", mod: "Mutable", ruler: "Mercury", needs: "Variety, Connection, Knowledge", shadow: "Restlessness, Superficiality", desc: "You process emotions through your mind. You need intellectual stimulation and social interaction to feel balanced." },
            { name: "Cancer", elem: "Water", mod: "Cardinal", ruler: "Moon", needs: "Nurturing, Security, Privacy", shadow: "Moodiness, Clinginess", desc: "The moon is at home here. You are deeply intuitive, protective, and emotionally sensitive to your environment." },
            { name: "Leo", elem: "Fire", mod: "Fixed", ruler: "Sun", needs: "Validation, Creativity, Play", shadow: "Arrogance, Dramatics", desc: "You have a warm, generous heart. You need to feel special and appreciated to feel emotionally secure." },
            { name: "Virgo", elem: "Earth", mod: "Mutable", ruler: "Mercury", needs: "Order, Usefulness, Purity", shadow: "Criticism, Anxiety", desc: "You express care through practical service. You need a structured environment and clear goals to feel at peace." },
            { name: "Libra", elem: "Air", mod: "Cardinal", ruler: "Venus", needs: "Harmony, Partnership, Justice", shadow: "Indecision, People-pleasing", desc: "You seek balance in all relationships. You are emotionally driven by a desire for fairness and aesthetic beauty." },
            { name: "Scorpio", elem: "Water", mod: "Fixed", ruler: "Pluto/Mars", needs: "Depth, Intimacy, Transformation", shadow: "Secrecy, Obsession", desc: "Your emotions are intense and profound. You seek deep truth and are not afraid of the darker aspects of life." },
            { name: "Sagittarius", elem: "Fire", mod: "Mutable", ruler: "Jupiter", needs: "Freedom, Meaning, Optimism", shadow: "Bluntness, Escapism", desc: "You are an emotional adventurer. You need a broad perspective and the space to explore philosophical truths." },
            { name: "Capricorn", elem: "Earth", mod: "Fixed", ruler: "Saturn", needs: "Achievement, Respect, Structure", shadow: "Coldness, Pessimism", desc: "You are emotionally disciplined and ambitious. You find security in building a solid reputation and achieving goals." },
            { name: "Aquarius", elem: "Air", mod: "Fixed", ruler: "Uranus/Saturn", needs: "Uniqueness, Community, Innovation", shadow: "Detachment, Rebellion", desc: "You are emotionally independent and visionary. You value your individuality and connection to the collective." },
            { name: "Pisces", elem: "Water", mod: "Mutable", ruler: "Neptune/Jupiter", needs: "Transcendence, Empathy, Dreams", shadow: "Victimhood, Confusion", desc: "You are highly sensitive and compassionate. Your emotional world is vast, dreamy, and deeply connected to the unseen." }
        ];

        function getMoonSign(dateStr, timeStr) {
            try {
                const date = new Date(dateStr + 'T' + timeStr);
                if (isNaN(date.getTime())) return null;

                const J2000 = new Date('2000-01-01T12:00:00Z');
                const diffDays = (date - J2000) / (1000 * 60 * 60 * 24);
                
                let longitude = (218.316 + 13.176396 * diffDays) % 360;
                if (longitude < 0) longitude += 360;

                const signIndex = Math.floor(longitude / 30);
                const deg = Math.floor(longitude % 30);
                const min = Math.floor(((longitude % 30) - deg) * 60);

                return { sign: signs[signIndex], deg, min };
            } catch (e) {
                return null;
            }
        }

        function calculate(){
            const d = dateEl.value;
            const t = timeEl.value;
            if(!d || !t) return;

            const result = getMoonSign(d, t);
            if (!result) return;
            const s = result.sign;

            document.getElementById('moon-out-sign').textContent = s.name;
            document.getElementById('moon-out-deg').textContent = `${result.deg}° ${result.min}'`;
            document.getElementById('moon-out-elem').textContent = s.elem;
            document.getElementById('moon-out-mod').textContent = s.mod;
            document.getElementById('moon-out-ruler').textContent = s.ruler;
            document.getElementById('moon-out-desc').textContent = s.desc;
            document.getElementById('moon-out-needs').textContent = s.needs;
            document.getElementById('moon-out-shadow').textContent = s.shadow;

            outputCard.style.opacity = '1';
        }

        [dateEl, timeEl, locEl].forEach(e => {
            if(e) e.addEventListener('input', calculate);
        });

        document.querySelectorAll('.moon-quick-action').forEach(btn => {
            btn.addEventListener('click', () => {
                dateEl.value = btn.dataset.date;
                timeEl.value = btn.dataset.time;
                locEl.value = btn.dataset.loc;
                calculate();
            });
        });

        const btnCopy = document.getElementById('moon-copy-btn');
        if (btnCopy) {
            btnCopy.addEventListener('click', function() {
                const sign = document.getElementById('moon-out-sign').textContent;
                const deg = document.getElementById('moon-out-deg').textContent;
                const elem = document.getElementById('moon-out-elem').textContent;
                const text = `Moon Sign Report\nSign: ${sign}\nPlacement: ${deg}\nElement: ${elem}\n— ToolsHub Astrology`;
                
                navigator.clipboard.writeText(text).then(() => {
                    const original = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
                    setTimeout(() => this.innerHTML = original, 2000);
                });
            });
        }

        calculate();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMoonCalculator);
    } else {
        initMoonCalculator();
    }
})();
</script>

<style>
.moon-sign-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.moon-sign-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.moon-sign-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.moon-sign-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.moon-sign-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.moon-sign-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.moon-sign-calc-rebuilt .leading-relaxed{line-height:1.6}
.bg-light-v2 { background-color: #f8fafc; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\moon-sign-calculator.blade.php ENDPATH**/ ?>