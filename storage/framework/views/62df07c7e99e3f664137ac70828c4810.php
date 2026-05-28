<div class="row g-4 birth-finder-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Birth Month</label>
                        <select id="birth-month" class="form-select form-select-lg rounded-3">
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Birth Day</label>
                        <input type="number" id="birth-day" class="form-control form-control-lg rounded-3" value="15" min="1" max="31">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="button" class="btn btn-success w-100 py-3 rounded-3 fw-bold shadow-sm" id="btn-find">Find My Symbols</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-card" style="--tool-hue:150;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);display:none;">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="stat-card p-4 text-center">
                        <span class="stat-card-label">Primary Birthstone</span>
                        <div class="output-hero-value mt-2" id="out-stone" style="font-size:2.5rem;color:#059669">Garnet</div>
                        <span class="text-muted small" id="out-stone-meaning">Protection & Strength</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card p-4 text-center">
                        <span class="stat-card-label">Birth Flower</span>
                        <div class="output-hero-value mt-2" id="out-flower" style="font-size:2.5rem;color:#059669">Carnation</div>
                        <span class="text-muted small" id="out-flower-meaning">Devotion & Love</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-leaf me-2 text-success"></i>Zodiac Association</h6>
                <div id="out-zodiac" class="text-secondary leading-relaxed"></div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Cultural Significance</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-borderless small mb-0">
                        <tbody id="out-details-table"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const monthSel=$('birth-month'), dayInput=$('birth-day'), outputCard=$('output-card');

    const monthlyData = {
        1: { stone: "Garnet", flower: "Carnation", stoneMeaning: "Constancy and Loyalty", flowerMeaning: "Distinction and Divine Love" },
        2: { stone: "Amethyst", flower: "Violet", stoneMeaning: "Sincerity and Peace", flowerMeaning: "Faithfulness and Virtue" },
        3: { stone: "Aquamarine", flower: "Daffodil", stoneMeaning: "Courage and Health", flowerMeaning: "New Beginnings and Rebirth" },
        4: { stone: "Diamond", flower: "Daisy", stoneMeaning: "Innocence and Love", flowerMeaning: "Purity and Loyal Love" },
        5: { stone: "Emerald", flower: "Lily of the Valley", stoneMeaning: "Happiness and Fertility", flowerMeaning: "Humility and Sweetness" },
        6: { stone: "Alexandrite", flower: "Rose", stoneMeaning: "Balance and Joy", flowerMeaning: "Love and Passion" },
        7: { stone: "Ruby", flower: "Larkspur", stoneMeaning: "Nobility and Beauty", flowerMeaning: "Strong Attachment and Lightness" },
        8: { stone: "Peridot", flower: "Gladiolus", stoneMeaning: "Strength and Growth", flowerMeaning: "Strength of Character" },
        9: { stone: "Sapphire", flower: "Aster", stoneMeaning: "Wisdom and Virtue", flowerMeaning: "Love and Daintiness" },
        10: { stone: "Tourmaline", flower: "Marigold", stoneMeaning: "Compassion and Hope", flowerMeaning: "Determination and Passion" },
        11: { stone: "Topaz", flower: "Chrysanthemum", stoneMeaning: "Love and Affection", flowerMeaning: "Optimism and Joy" },
        12: { stone: "Zircon", flower: "Narcissus", stoneMeaning: "Prosperity and Honor", flowerMeaning: "Good Fortune and Success" }
    };

    function getZodiac(m, d) {
        if ((m == 1 && d >= 20) || (m == 2 && d <= 18)) return "Aquarius";
        if ((m == 2 && d >= 19) || (m == 3 && d <= 20)) return "Pisces";
        if ((m == 3 && d >= 21) || (m == 4 && d <= 19)) return "Aries";
        if ((m == 4 && d >= 20) || (m == 5 && d <= 20)) return "Taurus";
        if ((m == 5 && d >= 21) || (m == 6 && d <= 20)) return "Gemini";
        if ((m == 6 && d >= 21) || (m == 7 && d <= 22)) return "Cancer";
        if ((m == 7 && d >= 23) || (m == 8 && d <= 22)) return "Leo";
        if ((m == 8 && d >= 23) || (m == 9 && d <= 22)) return "Virgo";
        if ((m == 9 && d >= 23) || (m == 10 && d <= 22)) return "Libra";
        if ((m == 10 && d >= 23) || (m == 11 && d <= 21)) return "Scorpio";
        if ((m == 11 && d >= 22) || (m == 12 && d <= 21)) return "Sagittarius";
        return "Capricorn";
    }

    function find() {
        const m = parseInt(monthSel.value);
        const d = parseInt(dayInput.value);
        if(isNaN(d) || d < 1 || d > 31) return;

        const data = monthlyData[m];
        const zodiac = getZodiac(m, d);

        $('out-stone').textContent = data.stone;
        $('out-flower').textContent = data.flower;
        $('out-stone-meaning').textContent = data.stoneMeaning;
        $('out-flower-meaning').textContent = data.flowerMeaning;
        
        $('out-zodiac').innerHTML = `<p>As an <strong>${zodiac}</strong> born on the ${d} of ${monthSel.options[monthSel.selectedIndex].text}, your energy is balanced by the ${data.stone}.</p>`;

        $('out-details-table').innerHTML = `
            <tr><td class="fw-bold text-muted" width="140">Sign Element:</td><td>${getElement(zodiac)}</td></tr>
            <tr><td class="fw-bold text-muted">Lucky Day:</td><td>${getLuckyDay(zodiac)}</td></tr>
            <tr><td class="fw-bold text-muted">Aroma:</td><td>${getAroma(m)}</td></tr>
        `;

        outputCard.style.display = 'block';
        outputCard.scrollIntoView({behavior:'smooth', block:'center'});
    }

    function getElement(z) {
        const elMap = {Aries:'Fire', Leo:'Fire', Sagittarius:'Fire', Taurus:'Earth', Virgo:'Earth', Capricorn:'Earth', Gemini:'Air', Libra:'Air', Aquarius:'Air', Cancer:'Water', Scorpio:'Water', Pisces:'Water'};
        return elMap[z];
    }
    function getLuckyDay(z) {
        const dayMap = {Aries:'Tuesday', Taurus:'Friday', Gemini:'Wednesday', Cancer:'Monday', Leo:'Sunday', Virgo:'Wednesday', Libra:'Friday', Scorpio:'Tuesday', Sagittarius:'Thursday', Capricorn:'Saturday', Aquarius:'Saturday', Pisces:'Thursday'};
        return dayMap[z];
    }
    function getAroma(m) {
        const aromas = ["Pine", "Sandalwood", "Rose", "Jasmine", "Lavender", "Honeysuckle", "Lily", "Mint", "Sage", "Apple", "Patchouli", "Frankincense"];
        return aromas[m-1];
    }

    $('btn-find').addEventListener('click', find);
    [monthSel, dayInput].forEach(el => el.addEventListener('change', find));
    
    find();
});
</script>

<style>
.birth-finder-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.birth-finder-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.birth-finder-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.birth-finder-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.birth-finder-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.birth-finder-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.leading-relaxed { line-height: 1.6; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\birthstone-zodiac-flower.blade.php ENDPATH**/ ?>