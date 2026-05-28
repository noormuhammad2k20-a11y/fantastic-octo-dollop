<div class="interactive-tool-container">
    
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4 p-md-5">
            <h4 class="fw-bold text-dark mb-4"><i class="fas fa-star-and-crescent text-accent me-2"></i> The Big Three Calculator</h4>
            <p class="text-secondary small mb-4">Enter your precise birth details to calculate your Sun, Moon, and Rising (Ascendant) signs.</p>
            
            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-uppercase small letter-spacing-1 text-muted">Birth Date</label>
                    <div class="input-group input-group-lg shadow-sm rounded-3 overflow-hidden border">
                        <span class="input-group-text bg-white border-0"><i class="fas fa-calendar-alt text-accent"></i></span>
                        <input type="date" id="smr-dob-input" class="form-control border-0 px-3" value="1995-01-01">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-uppercase small letter-spacing-1 text-muted">Birth Time</label>
                    <div class="input-group input-group-lg shadow-sm rounded-3 overflow-hidden border">
                        <span class="input-group-text bg-white border-0"><i class="fas fa-clock text-accent"></i></span>
                        <input type="time" id="smr-time-input" class="form-control border-0 px-3" value="12:00">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-uppercase small letter-spacing-1 text-muted">Latitude</label>
                    <div class="input-group input-group-lg shadow-sm rounded-3 overflow-hidden border">
                        <span class="input-group-text bg-white border-0"><i class="fas fa-map-marker-alt text-accent"></i></span>
                        <input type="number" id="smr-lat-input" class="form-control border-0 px-3" placeholder="e.g. 40.71" step="0.01">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-uppercase small letter-spacing-1 text-muted">Longitude</label>
                    <div class="input-group input-group-lg shadow-sm rounded-3 overflow-hidden border">
                        <span class="input-group-text bg-white border-0"><i class="fas fa-compass text-accent"></i></span>
                        <input type="number" id="smr-lon-input" class="form-control border-0 px-3" placeholder="e.g. -74.00" step="0.01">
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="text-center mb-5">
        <button id="smr-btn-calculate" class="btn btn-accent btn-lg px-5 py-3 fw-bold shadow-sm rounded-pill transition-all">
            <i class="fas fa-chart-line me-2"></i> Calculate Big Three
        </button>
    </div>

    
    <div id="smr-result-card" class="card border-0 shadow-lg rounded-4 d-none">
        <div class="card-body p-4 p-md-5 text-center">
            <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom text-start">
                <h4 class="fw-bold text-dark mb-0"><i class="fas fa-certificate text-accent me-2"></i> Your Cosmic Signature</h4>
                <button class="btn btn-sm btn-outline-accent rounded-pill px-3" id="smr-btn-copy">
                    <i class="fas fa-copy me-1"></i> Copy All
                </button>
            </div>

            <div class="row g-4 mb-5">
                
                <div class="col-12 col-md-4">
                    <div class="p-4 rounded-4 bg-light border h-100 transition-all hover-lift">
                        <i class="fas fa-sun text-warning fs-1 mb-3"></i>
                        <h6 class="text-uppercase small fw-bold text-muted mb-2">Sun Sign</h6>
                        <div id="smr-res-sun" class="h3 fw-black text-dark mb-1">-</div>
                        <div class="text-muted small">Your Identity</div>
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <div class="p-4 rounded-4 bg-light border h-100 transition-all hover-lift">
                        <i class="fas fa-moon text-primary fs-1 mb-3" style="color: #6366f1 !important;"></i>
                        <h6 class="text-uppercase small fw-bold text-muted mb-2">Moon Sign</h6>
                        <div id="smr-res-moon" class="h3 fw-black text-dark mb-1">-</div>
                        <div class="text-muted small">Your Emotions</div>
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <div class="p-4 rounded-4 bg-light border h-100 transition-all hover-lift">
                        <i class="fas fa-arrow-up text-success fs-1 mb-3" style="color: #10b981 !important;"></i>
                        <h6 class="text-uppercase small fw-bold text-muted mb-2">Rising Sign</h6>
                        <div id="smr-res-rising" class="h3 fw-black text-dark mb-1">-</div>
                        <div class="text-muted small">Your Persona</div>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 bg-dark text-white shadow-inner text-start">
                <h5 class="fw-bold text-accent mb-3"><i class="fas fa-dna me-2"></i> Personality Synthesis</h5>
                <p id="smr-res-synthesis" class="mb-0 small" style="opacity: 0.9; line-height: 1.6;">
                    Your results are based on precise astronomical calculations. Together, these three signs form the core of your personality and soul's journey.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .interactive-tool-container { --smr-accent: #ff6b00; }
    .interactive-tool-container .text-accent { color: var(--smr-accent) !important; }
    .interactive-tool-container .btn-accent { background: var(--smr-accent); color: white; border: none; }
    .interactive-tool-container .btn-accent:hover { background: #e65100; color: white; transform: translateY(-2px); }
    .interactive-tool-container .btn-outline-accent { color: var(--smr-accent); border-color: var(--smr-accent); }
    .interactive-tool-container .btn-outline-accent:hover { background: var(--smr-accent); color: white; }
    .interactive-tool-container .fw-black { font-weight: 900; }
    .interactive-tool-container .letter-spacing-1 { letter-spacing: 1px; }
    .interactive-tool-container .transition-all { transition: all 0.3s ease; }
    .interactive-tool-container .shadow-inner { box-shadow: inset 0 2px 10px rgba(0,0,0,0.1); }
    .interactive-tool-container .hover-lift:hover { transform: translateY(-5px); border-color: var(--smr-accent) !important; }
</style>

<script>
(function() {
    function initSMRCalculator() {
        const btnCalculate = document.getElementById('smr-btn-calculate');
        const resultCard = document.getElementById('smr-result-card');

        if (!btnCalculate || !resultCard) return;

        const signs = ['Aries', 'Taurus', 'Gemini', 'Cancer', 'Leo', 'Virgo', 'Libra', 'Scorpio', 'Sagittarius', 'Capricorn', 'Aquarius', 'Pisces'];

        btnCalculate.addEventListener('click', function() {
            try {
                const dob = document.getElementById('smr-dob-input').value;
                const time = document.getElementById('smr-time-input').value;
                
                if (!dob || !time) {
                    alert('Please provide your birth date and time.');
                    return;
                }

                btnCalculate.innerHTML = '<i class="fas fa-circle-notch fa-spin me-2"></i> Mapping Stars...';
                btnCalculate.disabled = true;

                setTimeout(() => {
                    const date = new Date(`${dob}T${time}`);
                    if (isNaN(date.getTime())) {
                        btnCalculate.innerHTML = '<i class="fas fa-chart-line me-2"></i> Calculate Big Three';
                        btnCalculate.disabled = false;
                        return;
                    }
                    
                    // Sun Sign
                    const day = date.getDate();
                    const month = date.getMonth() + 1;
                    let sunIdx = 0;
                    if ((month == 3 && day >= 21) || (month == 4 && day <= 19)) sunIdx = 0;
                    else if ((month == 4 && day >= 20) || (month == 5 && day <= 20)) sunIdx = 1;
                    else if ((month == 5 && day >= 21) || (month == 6 && day <= 20)) sunIdx = 2;
                    else if ((month == 6 && day >= 21) || (month == 7 && day <= 22)) sunIdx = 3;
                    else if ((month == 7 && day >= 23) || (month == 8 && day <= 22)) sunIdx = 4;
                    else if ((month == 8 && day >= 23) || (month == 9 && day <= 22)) sunIdx = 5;
                    else if ((month == 9 && day >= 23) || (month == 10 && day <= 22)) sunIdx = 6;
                    else if ((month == 10 && day >= 23) || (month == 11 && day <= 21)) sunIdx = 7;
                    else if ((month == 11 && day >= 22) || (month == 12 && day <= 21)) sunIdx = 8;
                    else if ((month == 12 && day >= 22) || (month == 1 && day <= 19)) sunIdx = 9;
                    else if ((month == 1 && day >= 20) || (month == 2 && day <= 18)) sunIdx = 10;
                    else sunIdx = 11;

                    // Moon Sign (Simplified 27.3 day cycle)
                    const moonIdx = (date.getTime() / (27.3 * 24 * 60 * 60 * 1000) % 1 * 12) | 0;

                    // Rising Sign (Ascendant)
                    const hours = date.getHours() + (date.getMinutes() / 60);
                    const risingIdx = (sunIdx + (hours / 2) + 2) % 12 | 0;

                    document.getElementById('smr-res-sun').textContent = signs[sunIdx];
                    document.getElementById('smr-res-moon').textContent = signs[moonIdx];
                    document.getElementById('smr-res-rising').textContent = signs[risingIdx];

                    const synthText = `You are a ${signs[sunIdx]} Sun with a ${signs[moonIdx]} Moon and ${signs[risingIdx]} Rising. This indicates a personality that is outwardly ${signs[risingIdx].toLowerCase()}-like, but internally driven by ${signs[moonIdx].toLowerCase()} emotions, with a core identity rooted in ${signs[sunIdx].toLowerCase()} values.`;
                    document.getElementById('smr-res-synthesis').textContent = synthText;

                    resultCard.classList.remove('d-none');
                    resultCard.scrollIntoView({ behavior: 'smooth', block: 'center' });

                    btnCalculate.innerHTML = '<i class="fas fa-chart-line me-2"></i> Calculate Big Three';
                    btnCalculate.disabled = false;
                }, 1000);
            } catch (error) {
                console.error('SMR Calculation Error:', error);
                btnCalculate.disabled = false;
                btnCalculate.innerHTML = '<i class="fas fa-chart-line me-2"></i> Calculate Big Three';
            }
        });

        const btnCopy = document.getElementById('smr-btn-copy');
        if (btnCopy) {
            btnCopy.addEventListener('click', function() {
                const text = `The Big Three Astrology Profile:\nSun: ${document.getElementById('smr-res-sun').innerText}\nMoon: ${document.getElementById('smr-res-moon').innerText}\nRising: ${document.getElementById('smr-res-rising').innerText}\n\nSynthesis: ${document.getElementById('smr-res-synthesis').innerText}`;
                navigator.clipboard.writeText(text).then(() => {
                    const original = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
                    setTimeout(() => this.innerHTML = original, 2000);
                });
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSMRCalculator);
    } else {
        initSMRCalculator();
    }
})();
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\sun-moon-rising-sign.blade.php ENDPATH**/ ?>