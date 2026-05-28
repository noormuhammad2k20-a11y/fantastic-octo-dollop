<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-white text-center h-100" style="border: 1.5px solid #e2e8f0;">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Partner 1 Sign</label>
                        <select id="zd-sign1" class="form-select form-select-lg rounded-3">
                            <option value="Aries">♈ Aries (Mar 21 - Apr 19)</option>
                            <option value="Taurus">♉ Taurus (Apr 20 - May 20)</option>
                            <option value="Gemini">♊ Gemini (May 21 - Jun 20)</option>
                            <option value="Cancer">♋ Cancer (Jun 21 - Jul 22)</option>
                            <option value="Leo">♌ Leo (Jul 23 - Aug 22)</option>
                            <option value="Virgo">♍ Virgo (Aug 23 - Sep 22)</option>
                            <option value="Libra">♎ Libra (Sep 23 - Oct 22)</option>
                            <option value="Scorpio" selected>♏ Scorpio (Oct 23 - Nov 21)</option>
                            <option value="Sagittarius">♐ Sagittarius (Nov 22 - Dec 21)</option>
                            <option value="Capricorn">♑ Capricorn (Dec 22 - Jan 19)</option>
                            <option value="Aquarius">♒ Aquarius (Jan 20 - Feb 18)</option>
                            <option value="Pisces">♓ Pisces (Feb 19 - Mar 20)</option>
                        </select>
                    </div>
                </div>

                
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-white text-center h-100" style="border: 1.5px solid #e2e8f0;">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Connection Focus</label>
                        <select id="zd-focus" class="form-select form-select-lg rounded-3">
                            <option value="romance" selected>❤️ Love & Romance</option>
                            <option value="friendship">🤝 Friendship & Fun</option>
                            <option value="business">💼 Professional / Business</option>
                        </select>
                    </div>
                </div>

                
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-white text-center h-100" style="border: 1.5px solid #e2e8f0;">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Partner 2 Sign</label>
                        <select id="zd-sign2" class="form-select form-select-lg rounded-3">
                            <option value="Aries">♈ Aries (Mar 21 - Apr 19)</option>
                            <option value="Taurus">♉ Taurus (Apr 20 - May 20)</option>
                            <option value="Gemini">♊ Gemini (May 21 - Jun 20)</option>
                            <option value="Cancer" selected>♋ Cancer (Jun 21 - Jul 22)</option>
                            <option value="Leo">♌ Leo (Jul 23 - Aug 22)</option>
                            <option value="Virgo">♍ Virgo (Aug 23 - Sep 22)</option>
                            <option value="Libra">♎ Libra (Sep 23 - Oct 22)</option>
                            <option value="Scorpio">♏ Scorpio (Oct 23 - Nov 21)</option>
                            <option value="Sagittarius">♐ Sagittarius (Nov 22 - Dec 21)</option>
                            <option value="Capricorn">♑ Capricorn (Dec 22 - Jan 19)</option>
                            <option value="Aquarius">♒ Aquarius (Jan 20 - Feb 18)</option>
                            <option value="Pisces">♓ Pisces (Feb 19 - Mar 20)</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-magic me-2"></i> Compute Synastry Score
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Synastry Compatibility Index</h5>
                        <p class="text-muted small mb-0">Detailed alignment index of elements, modalities, and polarities</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Astrological Report
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center">
                
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-dark mb-0 font-monospace" id="out-overall">0%</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">Overall Compatibility</p>
                    <div class="mt-2">
                        <span class="badge rounded-pill px-4 py-2 fw-bold text-uppercase" id="out-verdict" style="background-color: #4f46e5; color: #fff;">HARMONIOUS</span>
                    </div>
                </div>

                
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Love & Romance</div>
                                <div class="h5 fw-bold mb-0 text-dark" id="out-love">0%</div>
                                <div class="x-small text-muted fw-bold">Affection depth</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Communication</div>
                                <div class="h5 fw-bold mb-0 text-dark" id="out-comm">0%</div>
                                <div class="x-small text-muted fw-bold">Intellectual connection</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Mutual Trust</div>
                                <div class="h5 fw-bold mb-0 text-dark" id="out-trust">0%</div>
                                <div class="x-small text-muted fw-bold">Stability & Security</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Shared Values</div>
                                <div class="h5 fw-bold mb-0 text-dark" id="out-values">0%</div>
                                <div class="x-small text-muted fw-bold">Life goals harmony</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 p-3 rounded-4 bg-white border">
                        <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 text-center">Elemental Synergy Analysis</h6>
                        <ul class="list-unstyled mb-0 small text-secondary" id="out-insights">
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --danger-soft: #fef2f2;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }
    .bg-danger-soft { background-color: var(--danger-soft); }

    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1.5px solid #e2e8f0; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-control-lg, .form-select-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.05rem; padding: 0.65rem 0.85rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }
    
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .x-small { font-size: 0.75rem; }
    .font-monospace { font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const s1Select = document.getElementById('zd-sign1');
    const s2Select = document.getElementById('zd-sign2');
    const focusSelect = document.getElementById('zd-focus');

    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    const resultCard = document.getElementById('result-card');
    const outOverall = document.getElementById('out-overall');
    const outVerdict = document.getElementById('out-verdict');
    const outLove = document.getElementById('out-love');
    const outComm = document.getElementById('out-comm');
    const outTrust = document.getElementById('out-trust');
    const outValues = document.getElementById('out-values');
    const outInsights = document.getElementById('out-insights');

    // Astrological Attributes
    const zodiacData = {
        Aries: { element: 'Fire', modality: 'Cardinal', polarity: 'Positive' },
        Taurus: { element: 'Earth', modality: 'Fixed', polarity: 'Negative' },
        Gemini: { element: 'Air', modality: 'Mutable', polarity: 'Positive' },
        Cancer: { element: 'Water', modality: 'Cardinal', polarity: 'Negative' },
        Leo: { element: 'Fire', modality: 'Fixed', polarity: 'Positive' },
        Virgo: { element: 'Earth', modality: 'Mutable', polarity: 'Negative' },
        Libra: { element: 'Air', modality: 'Cardinal', polarity: 'Positive' },
        Scorpio: { element: 'Water', modality: 'Fixed', polarity: 'Negative' },
        Sagittarius: { element: 'Fire', modality: 'Mutable', polarity: 'Positive' },
        Capricorn: { element: 'Earth', modality: 'Cardinal', polarity: 'Negative' },
        Aquarius: { element: 'Air', modality: 'Fixed', polarity: 'Positive' },
        Pisces: { element: 'Water', modality: 'Mutable', polarity: 'Negative' }
    };

    function calculate() {
        const sign1 = s1Select.value;
        const sign2 = s2Select.value;
        const focus = focusSelect.value;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing Synastry...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            const data1 = zodiacData[sign1];
            const data2 = zodiacData[sign2];

            let scoreLove = 70;
            let scoreComm = 70;
            let scoreTrust = 70;
            let scoreValues = 70;

            // Element compatibility
            const el1 = data1.element;
            const el2 = data2.element;

            let elementBonus = 0;
            if (el1 === el2) {
                elementBonus = 15; // Same elements are highly compatible
            } else if (
                (el1 === 'Fire' && el2 === 'Air') || (el1 === 'Air' && el2 === 'Fire') ||
                (el1 === 'Earth' && el2 === 'Water') || (el1 === 'Water' && el2 === 'Earth')
            ) {
                elementBonus = 20; // Perfect elemental pairs
            } else if (
                (el1 === 'Fire' && el2 === 'Water') || (el1 === 'Water' && el2 === 'Fire') ||
                (el1 === 'Earth' && el2 === 'Air') || (el1 === 'Air' && el2 === 'Earth')
            ) {
                elementBonus = -20; // Clashing elements
            } else {
                elementBonus = 0; // Neutral pairs
            }

            // Modality compatibility
            let modalityBonus = 0;
            if (data1.modality === data2.modality) {
                modalityBonus = -10; // Same modalities clash / stubborn
            } else if (
                (data1.modality === 'Cardinal' && data2.modality === 'Mutable') ||
                (data1.modality === 'Mutable' && data2.modality === 'Cardinal')
            ) {
                modalityBonus = 10;
            } else {
                modalityBonus = 5;
            }

            // Polarity compatibility
            let polarityBonus = 0;
            if (data1.polarity === data2.polarity) {
                polarityBonus = 10; // Same polarity harmonizes
            }

            // Romance Calculations
            scoreLove = Math.min(99, Math.max(30, 72 + elementBonus + polarityBonus));
            
            // Communication Calculations
            let commMod = 0;
            if (el1 === 'Air' || el2 === 'Air') commMod = 10; // Air signs communicate well
            scoreComm = Math.min(99, Math.max(35, 68 + modalityBonus + commMod));

            // Trust Calculations
            let trustMod = 0;
            if (el1 === 'Earth' || el2 === 'Earth') trustMod = 10; // Earth signs build excellent trust
            if (el1 === 'Water' && el2 === 'Water') trustMod += 10; // Water double bond
            scoreTrust = Math.min(99, Math.max(30, 65 + elementBonus + trustMod));

            // Shared Values
            scoreValues = Math.min(99, Math.max(30, 70 + polarityBonus + (data1.modality === 'Cardinal' ? 5 : 0)));

            // Overall compatibility
            let overall = (scoreLove + scoreComm + scoreTrust + scoreValues) / 4;

            // Focus modifiers
            if (focus === 'romance') {
                overall = (scoreLove * 0.4) + (scoreComm * 0.2) + (scoreTrust * 0.2) + (scoreValues * 0.2);
            } else if (focus === 'friendship') {
                overall = (scoreLove * 0.1) + (scoreComm * 0.4) + (scoreTrust * 0.2) + (scoreValues * 0.3);
            } else {
                overall = (scoreLove * 0.05) + (scoreComm * 0.35) + (scoreTrust * 0.3) + (scoreValues * 0.3);
            }

            overall = Math.round(overall);

            // Verdict
            let verdict = 'NEUTRAL ALIGNMENT';
            let verdictColor = '#f59e0b';
            if (overall >= 85) {
                verdict = 'SOULMATE ALIGNMENT';
                verdictColor = '#ec4899';
            } else if (overall >= 75) {
                verdict = 'HIGHLY COMPATIBLE';
                verdictColor = '#10b981';
            } else if (overall < 55) {
                verdict = 'ELEMENTAL CLASH';
                verdictColor = '#ef4444';
            }

            // Output values
            outOverall.textContent = `${overall}%`;
            outVerdict.textContent = verdict;
            outVerdict.style.backgroundColor = verdictColor;

            outLove.textContent = `${scoreLove}%`;
            outComm.textContent = `${scoreComm}%`;
            outTrust.textContent = `${scoreTrust}%`;
            outValues.textContent = `${scoreValues}%`;

            // Insights builder
            const ins = [];
            ins.push(`Elemental Matchup: <strong>${sign1} (${el1})</strong> combined with <strong>${sign2} (${el2})</strong> yields <strong>${elementBonus >= 15 ? 'harmonious' : (elementBonus < 0 ? 'clashing' : 'neutral')} elemental chemistry</strong>.`);
            ins.push(`Dynamic Polarities: Both partners represent <strong>${data1.polarity === data2.polarity ? 'synchronized' : 'opposite'} polarities</strong>, giving a ${data1.polarity === data2.polarity ? 'fluid mutual vibe' : 'strong initial attraction but different pacing'}.`);
            ins.push(`Modality Dynamics: <strong>${data1.modality}</strong> meets <strong>${data2.modality}</strong>, which creates ${data1.modality === data2.modality ? 'potential control bottlenecks' : 'a beautifully balanced relationship structure'}.`);
            
            if (overall >= 80) {
                ins.push(`Astrological Recommendation: Excellent synastry. Natural synergy makes growth effortless.`);
            } else if (overall >= 60) {
                ins.push(`Astrological Recommendation: Moderate compatibility. Empathy and active communication bridge minor polar gaps.`);
            } else {
                ins.push(`Astrological Recommendation: Challenging match. Focus on mutual values to ground element divergence.`);
            }

            outInsights.innerHTML = ins.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-star text-warning me-2 mt-1"></i><span>${i}</span></li>`).join('');

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-magic me-2"></i> Compute Synastry Score';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculate);

    btnReset.addEventListener('click', function() {
        s1Select.value = 'Scorpio';
        s2Select.value = 'Cancer';
        focusSelect.value = 'romance';
        resultCard.classList.add('d-none');
    });

    btnCopy.addEventListener('click', function() {
        const text = `Astrological Synastry Report\n━━━━━━━━━━━━━━━━━━━━━━\nPartner 1: ${s1Select.value}\nPartner 2: ${s2Select.value}\nRelationship Focus: ${focusSelect.value.toUpperCase()}\nOverall Compatibility: ${outOverall.textContent}\nVerdict: ${outVerdict.textContent}\n━━━━━━━━━━━━━━━━━━━━━━\nLove: ${outLove.textContent} | Comm: ${outComm.textContent}\nTrust: ${outTrust.textContent} | Values: ${outValues.textContent}\n━━━━━━━━━━━━━━━━━━━━━━\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const originalText = btnCopy.innerHTML;
            btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            btnCopy.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => {
                btnCopy.innerHTML = originalText;
                btnCopy.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\advanced-zodiac-compatibility.blade.php ENDPATH**/ ?>