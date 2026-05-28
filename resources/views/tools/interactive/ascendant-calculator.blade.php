<div class="interactive-tool-container">
    {{-- ════════════ INPUT SECTION ════════════ --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4 p-md-5">
            <h4 class="fw-bold text-dark mb-4"><i class="fas fa-sun text-accent me-2"></i> Ascendant (Rising Sign) Finder</h4>
            <p class="text-secondary small mb-4">Discover your Rising sign to understand how you present yourself to the world and how others perceive you.</p>
            
            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-uppercase small letter-spacing-1 text-muted">Birth Date</label>
                    <div class="input-group input-group-lg shadow-sm rounded-3 overflow-hidden border">
                        <span class="input-group-text bg-white border-0"><i class="fas fa-calendar-day text-accent"></i></span>
                        <input type="date" id="ascendant-dob-input" class="form-control border-0 px-3" value="1995-01-01">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-uppercase small letter-spacing-1 text-muted">Birth Time</label>
                    <div class="input-group input-group-lg shadow-sm rounded-3 overflow-hidden border">
                        <span class="input-group-text bg-white border-0"><i class="fas fa-clock text-accent"></i></span>
                        <input type="time" id="ascendant-time-input" class="form-control border-0 px-3" value="12:00">
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <button id="ascendant-btn-calculate" class="btn btn-accent btn-lg px-5 py-3 fw-bold shadow-sm rounded-pill transition-all w-100 w-md-auto">
                    <i class="fas fa-eye me-2"></i> Reveal Ascendant
                </button>
            </div>
        </div>
    </div>

    {{-- ════════════ RESULT SECTION ════════════ --}}
    <div id="ascendant-result-card" class="card border-0 shadow-lg rounded-4 d-none">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h4 class="fw-bold text-dark mb-0"><i class="fas fa-user-circle text-accent me-2"></i> Outer Personality</h4>
                <button class="btn btn-sm btn-outline-accent rounded-pill px-3" id="ascendant-btn-copy">
                    <i class="fas fa-copy me-1"></i> Copy
                </button>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-12 col-md-5">
                    <div class="result-box p-4 rounded-4 bg-light text-center h-100 border">
                        <div class="text-uppercase small fw-bold text-muted mb-2">Rising Sign</div>
                        <div id="ascendant-res-sign" class="display-5 fw-black text-dark mb-2">-</div>
                        <div id="ascendant-res-symbol" class="fs-1 mb-2">ASC</div>
                        <div class="badge bg-accent px-3 py-2 rounded-pill" id="ascendant-res-element">-</div>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="result-box p-4 rounded-4 bg-white h-100 border shadow-sm">
                        <h5 class="fw-bold text-dark mb-3">The Mask You Wear</h5>
                        <p id="ascendant-res-meaning" class="text-secondary mb-0" style="line-height: 1.6;">
                            The Ascendant is the zodiac sign that was rising on the eastern horizon at the exact moment of your birth. It represents your social personality.
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 bg-dark text-white shadow-inner">
                <h6 class="fw-bold text-accent mb-2 small text-uppercase">The First Impression</h6>
                <p id="ascendant-res-archetype" class="mb-0 small fst-italic" style="opacity: 0.8;">
                    "The gateway through which you interact with the world and express your inner self."
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .interactive-tool-container { --ascendant-accent: #10b981; }
    .interactive-tool-container .text-accent { color: var(--ascendant-accent) !important; }
    .interactive-tool-container .btn-accent { background: var(--ascendant-accent); color: white; border: none; }
    .interactive-tool-container .btn-accent:hover { background: #059669; color: white; transform: translateY(-2px); }
    .interactive-tool-container .btn-outline-accent { color: var(--ascendant-accent); border-color: var(--ascendant-accent); }
    .interactive-tool-container .btn-outline-accent:hover { background: var(--ascendant-accent); color: white; }
    .interactive-tool-container .fw-black { font-weight: 900; }
    .interactive-tool-container .letter-spacing-1 { letter-spacing: 1px; }
    .interactive-tool-container .transition-all { transition: all 0.3s ease; }
    .interactive-tool-container .shadow-inner { box-shadow: inset 0 2px 10px rgba(0,0,0,0.1); }
</style>

<script>
(function() {
    function initAscendantCalculator() {
        const btnCalculate = document.getElementById('ascendant-btn-calculate');
        const resultCard = document.getElementById('ascendant-result-card');
        const dobInput = document.getElementById('ascendant-dob-input');
        const timeInput = document.getElementById('ascendant-time-input');

        if (!btnCalculate || !resultCard || !dobInput || !timeInput) return;

        const signs = [
            { name: 'Aries', symbol: '♈', element: 'Fire', meaning: 'You come across as energetic, confident, and direct. You are a person of action who meets challenges head-on.', archetype: 'The Fearless Leader' },
            { name: 'Taurus', symbol: '♉', element: 'Earth', meaning: 'You appear steady, reliable, and calm. People see you as grounded and someone who appreciates quality and comfort.', archetype: 'The Graceful Provider' },
            { name: 'Gemini', symbol: '♊', element: 'Air', meaning: 'You seem curious, talkative, and mentally quick. Your social personality is expressive and multifaceted.', archetype: 'The Clever Communicator' },
            { name: 'Cancer', symbol: '♋', element: 'Water', meaning: 'You appear sensitive, protective, and intuitive. Others often feel a sense of comfort and safety in your presence.', archetype: 'The Protective Caretaker' },
            { name: 'Leo', symbol: '♌', element: 'Fire', meaning: 'You have a magnetic, warm, and dramatic presence. You naturally command attention and express yourself with flair.', archetype: 'The Radiant Performer' },
            { name: 'Virgo', symbol: '♍', element: 'Earth', meaning: 'You come across as intelligent, modest, and analytical. People notice your attention to detail and practical nature.', archetype: 'The Precise Intellectual' },
            { name: 'Libra', symbol: '♎', element: 'Air', meaning: 'You appear charming, diplomatic, and aesthetically pleasing. You have a natural ability to create balance and harmony.', archetype: 'The Harmonious Diplomat' },
            { name: 'Scorpio', symbol: '♏', element: 'Water', meaning: 'You have an intense, mysterious, and powerful presence. Others are often intrigued by your depth and focus.', archetype: 'The Deep Transformer' },
            { name: 'Sagittarius', symbol: '♐', element: 'Fire', meaning: 'You seem optimistic, adventurous, and freedom-loving. You have an expansive personality and a love for exploring.', archetype: 'The Truth-Seeking Voyager' },
            { name: 'Capricorn', symbol: '♑', element: 'Earth', meaning: 'You appear serious, disciplined, and ambitious. Others see you as competent and destined for success.', archetype: 'The Structured Achiever' },
            { name: 'Aquarius', symbol: '♒', element: 'Air', meaning: 'You come across as unique, independent, and intellectually detached. You have a forward-thinking and original presence.', archetype: 'The Individualistic Visionary' },
            { name: 'Pisces', symbol: '♓', element: 'Water', meaning: 'You appear dreamy, compassionate, and sensitive. Others notice your artistic nature and empathetic vibe.', archetype: 'The Spiritual Dreamer' }
        ];

        btnCalculate.addEventListener('click', function() {
            try {
                const dob = dobInput.value;
                const time = timeInput.value;
                if (!dob || !time) {
                    alert('Please provide birth date and time.');
                    return;
                }

                btnCalculate.innerHTML = '<i class="fas fa-circle-notch fa-spin me-2"></i> Calculating Horizon...';
                btnCalculate.disabled = true;

                setTimeout(() => {
                    const date = new Date(`${dob}T${time}`);
                    if (isNaN(date.getTime())) {
                        btnCalculate.innerHTML = '<i class="fas fa-eye me-2"></i> Reveal Ascendant';
                        btnCalculate.disabled = false;
                        return;
                    }

                    // Ascendant (Rising Sign) Calculation
                    const day = date.getDate();
                    const month = date.getMonth() + 1;
                    let sunIdx = Math.floor((month - 1) % 12); // Very rough Sun Sign
                    const hours = date.getHours() + (date.getMinutes() / 60);
                    const index = (sunIdx + Math.floor(hours / 2) + 2) % 12;
                    const sign = signs[index];

                    document.getElementById('ascendant-res-sign').textContent = sign.name;
                    document.getElementById('ascendant-res-element').textContent = sign.element;
                    document.getElementById('ascendant-res-meaning').textContent = sign.meaning;
                    document.getElementById('ascendant-res-archetype').textContent = `"${sign.archetype}"`;

                    resultCard.classList.remove('d-none');
                    resultCard.scrollIntoView({ behavior: 'smooth', block: 'center' });

                    btnCalculate.innerHTML = '<i class="fas fa-eye me-2"></i> Reveal Ascendant';
                    btnCalculate.disabled = false;
                }, 800);
            } catch (error) {
                console.error('Ascendant Calculation Error:', error);
                btnCalculate.disabled = false;
                btnCalculate.innerHTML = '<i class="fas fa-eye me-2"></i> Reveal Ascendant';
            }
        });

        document.getElementById('ascendant-btn-copy').addEventListener('click', function() {
            const sign = document.getElementById('ascendant-res-sign').innerText;
            const element = document.getElementById('ascendant-res-element').innerText;
            const meaning = document.getElementById('ascendant-res-meaning').innerText;
            const archetype = document.getElementById('ascendant-res-archetype').innerText;
            
            const text = `Ascendant (Rising Sign): ${sign}\nElement: ${element}\nPersona: ${meaning}\nArchetype: ${archetype}`;
            
            navigator.clipboard.writeText(text).then(() => {
                const original = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
                setTimeout(() => this.innerHTML = original, 2000);
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAscendantCalculator);
    } else {
        initAscendantCalculator();
    }
})();
</script>
