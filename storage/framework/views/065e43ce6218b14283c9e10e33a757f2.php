<div class="row g-4 element-balance-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Sun Sign</label>
                        <select id="sun-sign" class="form-select form-select-lg rounded-3">
                            <option value="Aries">Aries (Fire)</option>
                            <option value="Taurus">Taurus (Earth)</option>
                            <option value="Gemini">Gemini (Air)</option>
                            <option value="Cancer">Cancer (Water)</option>
                            <option value="Leo">Leo (Fire)</option>
                            <option value="Virgo">Virgo (Earth)</option>
                            <option value="Libra">Libra (Air)</option>
                            <option value="Scorpio">Scorpio (Water)</option>
                            <option value="Sagittarius">Sagittarius (Fire)</option>
                            <option value="Capricorn">Capricorn (Earth)</option>
                            <option value="Aquarius">Aquarius (Air)</option>
                            <option value="Pisces">Pisces (Water)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Moon Sign</label>
                        <select id="moon-sign" class="form-select form-select-lg rounded-3">
                            <!-- Same options -->
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Ascendant (Rising)</label>
                        <select id="asc-sign" class="form-select form-select-lg rounded-3">
                            <!-- Same options -->
                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="button" class="btn btn-warning w-100 py-3 rounded-3 fw-bold shadow-sm" id="btn-analyze">Analyze My Elements</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-card" style="--tool-hue:30;--tool-color:#ea580c;--tool-bg:rgba(249,115,22,.04);display:none;">
            <div class="output-hero">
                <span class="output-hero-label">Dominant Element</span>
                <div class="output-hero-value" id="out-dominant" style="font-size:3.5rem">Fire</div>
                <span class="output-hero-unit" id="out-percentage">40% Weighted Score</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <h6 class="fw-bold mb-3"><i class="fas fa-chart-pie me-2 text-primary"></i>Distribution Breakdown</h6>
                    <div class="space-y-3" id="out-bars">
                        <!-- Bars will be injected here -->
                    </div>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Elemental Weighting</h6>
                    <div class="small text-secondary">
                        <ul class="list-unstyled">
                            <li class="mb-1"><i class="fas fa-check-circle text-success me-2"></i>Sun Sign: <strong>40% weight</strong></li>
                            <li class="mb-1"><i class="fas fa-check-circle text-success me-2"></i>Moon Sign: <strong>30% weight</strong></li>
                            <li><i class="fas fa-check-circle text-success me-2"></i>Ascendant: <strong>30% weight</strong></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-meteor me-2 text-danger"></i>Elemental Synthesis</h6>
                <div id="out-synthesis" class="text-secondary leading-relaxed small"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const sunSel=$('sun-sign'), moonSel=$('moon-sign'), ascSel=$('asc-sign'), outputCard=$('output-card');

    // Populate Moon and Asc selects
    moonSel.innerHTML = sunSel.innerHTML;
    ascSel.innerHTML = sunSel.innerHTML;

    const elementMap = {
        Aries:'Fire', Leo:'Fire', Sagittarius:'Fire',
        Taurus:'Earth', Virgo:'Earth', Capricorn:'Earth',
        Gemini:'Air', Libra:'Air', Aquarius:'Air',
        Cancer:'Water', Scorpio:'Water', Pisces:'Water'
    };

    const elementColors = { Fire: '#ef4444', Earth: '#16a34a', Air: '#0ea5e9', Water: '#6366f1' };

    function analyze() {
        const sun = elementMap[sunSel.value];
        const moon = elementMap[moonSel.value];
        const asc = elementMap[ascSel.value];

        const scores = { Fire:0, Earth:0, Air:0, Water:0 };
        scores[sun] += 4;
        scores[moon] += 3;
        scores[asc] += 3;

        const total = 10;
        let dominant = 'Fire';
        let max = -1;

        let barsHtml = '';
        Object.keys(scores).forEach(el => {
            const pct = (scores[el] / total) * 100;
            if(pct > max) { max = pct; dominant = el; }

            barsHtml += `
                <div class="mb-3">
                    <div class="d-flex justify-content-between small mb-1"><span>${el}</span><span>${pct}%</span></div>
                    <div class="progress rounded-pill" style="height:10px;background:#f1f5f9">
                        <div class="progress-bar rounded-pill" style="width:${pct}%;background:${elementColors[el]}"></div>
                    </div>
                </div>
            `;
        });

        $('out-dominant').textContent = dominant;
        $('out-dominant').style.color = elementColors[dominant];
        $('out-percentage').textContent = `${max}% Weighted Score`;
        $('out-bars').innerHTML = barsHtml;

        const synthesisMap = {
            Fire: "You possess high vitality, passion, and initiative. You are a natural leader who thrives on action and excitement.",
            Earth: "You are grounded, practical, and dependable. You value stability and have a strong connection to the physical world.",
            Air: "You are intellectual, communicative, and objective. You thrive on ideas, social interaction, and mental stimulation.",
            Water: "You are intuitive, emotional, and sensitive. You possess deep empathy and navigate life through your feelings."
        };

        $('out-synthesis').innerHTML = `<p>${synthesisMap[dominant]}</p><p><strong>Balance Check:</strong> ${checkBalance(scores)}</p>`;

        outputCard.style.display = 'block';
        outputCard.scrollIntoView({behavior:'smooth', block:'center'});
    }

    function checkBalance(s) {
        const missing = Object.keys(s).filter(k => s[k] === 0);
        if(missing.length === 0) return "Your chart shows a healthy representation of all four elements.";
        return `You lack the <strong>${missing.join(' & ')}</strong> element. Consider seeking activities or partners that help ground or inspire these missing energies.`;
    }

    $('btn-analyze').addEventListener('click', analyze);
    [sunSel, moonSel, ascSel].forEach(el => el.addEventListener('change', analyze));
    
    analyze();
});
</script>

<style>
.element-balance-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.element-balance-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.element-balance-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.element-balance-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.element-balance-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.element-balance-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.leading-relaxed { line-height: 1.6; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\element-balance-calculator.blade.php ENDPATH**/ ?>