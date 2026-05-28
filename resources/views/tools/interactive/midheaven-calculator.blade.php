<div class="interactive-tool-container">
    {{-- ════════════ INPUT SECTION ════════════ --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4 p-md-5">
            <h4 class="fw-bold text-dark mb-4"><i class="fas fa-briefcase text-accent me-2"></i> Midheaven (MC) Calculator</h4>
            <p class="text-secondary small mb-4">Discover your Midheaven sign to unlock insights into your career path, public reputation, and highest aspirations.</p>
            
            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-uppercase small letter-spacing-1 text-muted">Birth Date</label>
                    <div class="input-group input-group-lg shadow-sm rounded-3 overflow-hidden border">
                        <span class="input-group-text bg-white border-0"><i class="fas fa-calendar-alt text-accent"></i></span>
                        <input type="date" id="midheaven-dob-input" class="form-control border-0 px-3" value="1995-01-01">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-uppercase small letter-spacing-1 text-muted">Birth Time</label>
                    <div class="input-group input-group-lg shadow-sm rounded-3 overflow-hidden border">
                        <span class="input-group-text bg-white border-0"><i class="fas fa-clock text-accent"></i></span>
                        <input type="time" id="midheaven-time-input" class="form-control border-0 px-3" value="12:00">
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <button id="midheaven-btn-calculate" class="btn btn-accent btn-lg px-5 py-3 fw-bold shadow-sm rounded-pill transition-all w-100 w-md-auto">
                    <i class="fas fa-compass me-2"></i> Find Midheaven
                </button>
            </div>
        </div>
    </div>

    {{-- ════════════ RESULT SECTION ════════════ --}}
    <div id="midheaven-result-card" class="card border-0 shadow-lg rounded-4 d-none">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h4 class="fw-bold text-dark mb-0"><i class="fas fa-award text-accent me-2"></i> Public Profile</h4>
                <button class="btn btn-sm btn-outline-accent rounded-pill px-3" id="midheaven-btn-copy">
                    <i class="fas fa-copy me-1"></i> Copy
                </button>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-12 col-md-5">
                    <div class="result-box p-4 rounded-4 bg-light text-center h-100 border">
                        <div class="text-uppercase small fw-bold text-muted mb-2">Midheaven Sign</div>
                        <div id="midheaven-res-sign" class="display-5 fw-black text-dark mb-2">-</div>
                        <div id="midheaven-res-symbol" class="fs-1 mb-2">MC</div>
                        <div class="badge bg-accent px-3 py-2 rounded-pill" id="midheaven-res-element">-</div>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="result-box p-4 rounded-4 bg-white h-100 border shadow-sm">
                        <h5 class="fw-bold text-dark mb-3">Career & Legacy</h5>
                        <p id="midheaven-res-meaning" class="text-secondary mb-0" style="line-height: 1.6;">
                            The Midheaven represents your public image, professional goals, and the impact you wish to leave on the world.
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 bg-dark text-white shadow-inner">
                <h6 class="fw-bold text-accent mb-2 small text-uppercase">The Public Image</h6>
                <p id="midheaven-res-archetype" class="mb-0 small fst-italic" style="opacity: 0.8;">
                    "The professional persona that guides your climb to the summit of your ambitions."
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .interactive-tool-container { --midheaven-accent: #6366f1; }
    .interactive-tool-container .text-accent { color: var(--midheaven-accent) !important; }
    .interactive-tool-container .btn-accent { background: var(--midheaven-accent); color: white; border: none; }
    .interactive-tool-container .btn-accent:hover { background: #4f46e5; color: white; transform: translateY(-2px); }
    .interactive-tool-container .btn-outline-accent { color: var(--midheaven-accent); border-color: var(--midheaven-accent); }
    .interactive-tool-container .btn-outline-accent:hover { background: var(--midheaven-accent); color: white; }
    .interactive-tool-container .fw-black { font-weight: 900; }
    .interactive-tool-container .letter-spacing-1 { letter-spacing: 1px; }
    .interactive-tool-container .transition-all { transition: all 0.3s ease; }
    .interactive-tool-container .shadow-inner { box-shadow: inset 0 2px 10px rgba(0,0,0,0.1); }
</style>

<script>
(function() {
    function initMidheavenCalculator() {
        const btnCalculate = document.getElementById('midheaven-btn-calculate');
        const resultCard = document.getElementById('midheaven-result-card');
        const dobInput = document.getElementById('midheaven-dob-input');
        const timeInput = document.getElementById('midheaven-time-input');

        if (!btnCalculate || !resultCard || !dobInput || !timeInput) return;

        const signs = [
            { name: 'Aries', symbol: '♈', element: 'Fire', meaning: 'You are seen as a pioneer and a risk-taker in your professional life. Your career thrives on initiative and individual drive.', archetype: 'The Dynamic Entrepreneur' },
            { name: 'Taurus', symbol: '♉', element: 'Earth', meaning: 'You build your reputation on reliability and tangible results. Your career path is steady, focused on creating lasting value.', archetype: 'The Value Creator' },
            { name: 'Gemini', symbol: '♊', element: 'Air', meaning: 'Publicly, you are known for your versatility and communication skills. Your career thrives on information and adaptability.', archetype: 'The Versatile Communicator' },
            { name: 'Cancer', symbol: '♋', element: 'Water', meaning: 'You are seen as a nurturing and intuitive leader. Your career path often involves caring for others or deep emotional work.', archetype: 'The Intuitive Leader' },
            { name: 'Leo', symbol: '♌', element: 'Fire', meaning: 'You shine in the public eye. Your career thrives on creative expression and being recognized for your unique talents.', archetype: 'The Creative Star' },
            { name: 'Virgo', symbol: '♍', element: 'Earth', meaning: 'Your reputation is built on precision and helpfulness. You find success through service and meticulous attention to detail.', archetype: 'The Precision Master' },
            { name: 'Libra', symbol: '♎', element: 'Air', meaning: 'You are known for your diplomacy and aesthetic sense in professional circles. Your career thrives on partnerships and harmony.', archetype: 'The Diplomatic Artist' },
            { name: 'Scorpio', symbol: '♏', element: 'Water', meaning: 'You have a powerful, investigative public image. Your career often involves deep research, transformation, or mystery.', archetype: 'The Strategic Investigator' },
            { name: 'Sagittarius', symbol: '♐', element: 'Fire', meaning: 'Known for your honesty and vision, your career path involves expansion, philosophy, or global connections.', archetype: 'The Visionary Voyager' },
            { name: 'Capricorn', symbol: '♑', element: 'Earth', meaning: 'The Midheaven is traditionally linked to Capricorn. You are seen as ambitious, disciplined, and destined for leadership.', archetype: 'The Structured Authority' },
            { name: 'Aquarius', symbol: '♒', element: 'Air', meaning: 'You are seen as a revolutionary or an innovator. Your career path is unconventional and focused on social progress.', archetype: 'The Innovative Maverick' },
            { name: 'Pisces', symbol: '♓', element: 'Water', meaning: 'Publicly, you are known for your imagination and empathy. Your career often involves art, healing, or spiritual pursuits.', archetype: 'The Compassionate Creator' }
        ];

        btnCalculate.addEventListener('click', function() {
            try {
                const dob = dobInput.value;
                const time = timeInput.value;
                if (!dob || !time) {
                    alert('Please provide birth date and time.');
                    return;
                }

                btnCalculate.innerHTML = '<i class="fas fa-circle-notch fa-spin me-2"></i> Mapping Zenith...';
                btnCalculate.disabled = true;

                setTimeout(() => {
                    const date = new Date(`${dob}T${time}`);
                    if (isNaN(date.getTime())) {
                        btnCalculate.innerHTML = '<i class="fas fa-compass me-2"></i> Find Midheaven';
                        btnCalculate.disabled = false;
                        return;
                    }

                    // Midheaven (MC) Calculation
                    // Roughly 90 degrees from Ascendant, or calculated from Sidereal Time.
                    // Simplified: (SunSign + TimeOffset + 10) % 12
                    const day = date.getDate();
                    const month = date.getMonth() + 1;
                    let sunIdx = Math.floor((month - 1) % 12); // Very rough
                    const hours = date.getHours() + (date.getMinutes() / 60);
                    const index = (sunIdx + Math.floor(hours / 2) + 9) % 12;
                    const sign = signs[index];

                    document.getElementById('midheaven-res-sign').textContent = sign.name;
                    document.getElementById('midheaven-res-element').textContent = sign.element;
                    document.getElementById('midheaven-res-meaning').textContent = sign.meaning;
                    document.getElementById('midheaven-res-archetype').textContent = `"${sign.archetype}"`;

                    resultCard.classList.remove('d-none');
                    resultCard.scrollIntoView({ behavior: 'smooth', block: 'center' });

                    btnCalculate.innerHTML = '<i class="fas fa-compass me-2"></i> Find Midheaven';
                    btnCalculate.disabled = false;
                }, 800);
            } catch (error) {
                console.error('Midheaven Calculation Error:', error);
                btnCalculate.disabled = false;
                btnCalculate.innerHTML = '<i class="fas fa-compass me-2"></i> Find Midheaven';
            }
        });

        document.getElementById('midheaven-btn-copy').addEventListener('click', function() {
            const sign = document.getElementById('midheaven-res-sign').innerText;
            const element = document.getElementById('midheaven-res-element').innerText;
            const meaning = document.getElementById('midheaven-res-meaning').innerText;
            const archetype = document.getElementById('midheaven-res-archetype').innerText;
            
            const text = `Midheaven (MC) Sign: ${sign}\nElement: ${element}\nLegacy: ${meaning}\nArchetype: ${archetype}`;
            
            navigator.clipboard.writeText(text).then(() => {
                const original = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
                setTimeout(() => this.innerHTML = original, 2000);
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMidheavenCalculator);
    } else {
        initMidheavenCalculator();
    }
})();
</script>
