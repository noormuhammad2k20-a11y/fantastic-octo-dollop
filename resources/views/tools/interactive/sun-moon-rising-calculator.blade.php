<div class="interactive-wrapper">
    {{-- Input Card (Birth Chart Metrics) --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Date and Time Inputs --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Birth Date & Time</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Birth Date</label>
                                <input type="date" id="ast-date" class="form-control form-control-lg rounded-3" value="1995-10-24">
                            </div>
                            <div class="col-7">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Birth Time</label>
                                <div class="input-group">
                                    <input type="number" id="ast-hour" class="form-control form-control-lg rounded-start-3" value="10" min="1" max="12">
                                    <span class="input-group-text border-start-0 border-end-0 bg-white">:</span>
                                    <input type="number" id="ast-minute" class="form-control form-control-lg" value="30" min="0" max="59">
                                </div>
                            </div>
                            <div class="col-5">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">AM/PM</label>
                                <select id="ast-ampm" class="form-select form-select-lg rounded-3">
                                    <option value="AM">AM</option>
                                    <option value="PM" selected>PM</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Location/Timezone Inputs --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">GMT & Location</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">GMT Timezone Offset</label>
                                <select id="ast-timezone" class="form-select form-select-lg rounded-3">
                                    <option value="-12">GMT -12:00 (Kwajalein)</option>
                                    <option value="-8">GMT -08:00 (Pacific Time - US/CA)</option>
                                    <option value="-5">GMT -05:00 (Eastern Time - US/CA)</option>
                                    <option value="0">GMT +00:00 (London / GMT)</option>
                                    <option value="1">GMT +01:00 (Paris / Central Europe)</option>
                                    <option value="3">GMT +03:00 (Moscow / East Africa)</option>
                                    <option value="5.5" selected>GMT +05:30 (India / Mumbai)</option>
                                    <option value="8">GMT +08:00 (Singapore / Beijing)</option>
                                    <option value="10">GMT +10:00 (Sydney / Melbourne)</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Approximate Birth City</label>
                                <input type="text" id="ast-city" class="form-control form-control-lg rounded-3" value="Mumbai" placeholder="e.g. New York, London">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-moon me-2"></i> Compute Birth Chart
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Output Card (Astrological Big Three) --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Your Cosmic Signature</h5>
                        <p class="text-muted small mb-0">The core planetary markers governing your personality archetypes</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Cosmic Profile
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 justify-content-center">
                {{-- Sun Sign Column --}}
                <div class="col-md-4 text-center border-end">
                    <div class="p-3 rounded-4 bg-light border h-100">
                        <div class="icon-box mx-auto mb-2 text-warning" style="background-color: #fffbeb; width: 54px; height: 54px; border-radius: 50%; font-size: 1.5rem;">
                            ☀️
                        </div>
                        <h6 class="text-muted small fw-bold text-uppercase mb-1">Sun Sign</h6>
                        <h4 class="fw-black mb-1 text-dark" id="out-sun">Scorpio</h4>
                        <span class="badge rounded-pill px-3 py-1 font-monospace text-uppercase" id="out-sun-element" style="background-color: #e0f2fe; color: #0369a1;">Water</span>
                        <p class="small text-muted mt-3 mb-0" id="out-sun-desc">Core identity, basic ego, and conscious vitality</p>
                    </div>
                </div>

                {{-- Moon Sign Column --}}
                <div class="col-md-4 text-center border-end">
                    <div class="p-3 rounded-4 bg-light border h-100">
                        <div class="icon-box mx-auto mb-2 text-primary" style="background-color: #eef2ff; width: 54px; height: 54px; border-radius: 50%; font-size: 1.5rem;">
                            🌙
                        </div>
                        <h6 class="text-muted small fw-bold text-uppercase mb-1">Moon Sign</h6>
                        <h4 class="fw-black mb-1 text-dark" id="out-moon">Scorpio</h4>
                        <span class="badge rounded-pill px-3 py-1 font-monospace text-uppercase" id="out-moon-element" style="background-color: #e0f2fe; color: #0369a1;">Water</span>
                        <p class="small text-muted mt-3 mb-0" id="out-moon-desc">Emotional subconscious, inner instincts, and reactions</p>
                    </div>
                </div>

                {{-- Rising Sign Column --}}
                <div class="col-md-4 text-center">
                    <div class="p-3 rounded-4 bg-light border h-100">
                        <div class="icon-box mx-auto mb-2 text-success" style="background-color: #f0fdf4; width: 54px; height: 54px; border-radius: 50%; font-size: 1.5rem;">
                            🌅
                        </div>
                        <h6 class="text-muted small fw-bold text-uppercase mb-1">Rising Sign</h6>
                        <h4 class="fw-black mb-1 text-dark" id="out-rising">Cancer</h4>
                        <span class="badge rounded-pill px-3 py-1 font-monospace text-uppercase" id="out-rising-element" style="background-color: #f0fdf4; color: #15803d;">Water</span>
                        <p class="small text-muted mt-3 mb-0" id="out-rising-desc">Social mask, physical presence, and outer persona</p>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-light border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">
                    <i class="fas fa-sparkles text-warning me-2"></i>Big Three Personality Blueprint
                </h6>
                <div id="out-insights" class="small text-secondary">
                    {{-- Injected dynamically --}}
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
    const dateInput = document.getElementById('ast-date');
    const hourInput = document.getElementById('ast-hour');
    const minInput = document.getElementById('ast-minute');
    const ampmSelect = document.getElementById('ast-ampm');
    const tzSelect = document.getElementById('ast-timezone');
    const cityInput = document.getElementById('ast-city');

    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    const resultCard = document.getElementById('result-card');
    
    const outSun = document.getElementById('out-sun');
    const outSunEl = document.getElementById('out-sun-element');
    const outSunDesc = document.getElementById('out-sun-desc');

    const outMoon = document.getElementById('out-moon');
    const outMoonEl = document.getElementById('out-moon-element');
    const outMoonDesc = document.getElementById('out-moon-desc');

    const outRising = document.getElementById('out-rising');
    const outRisingEl = document.getElementById('out-rising-element');
    const outRisingDesc = document.getElementById('out-rising-desc');

    const outInsights = document.getElementById('out-insights');

    // Zodiac order & elements mapping
    const signs = ['Aries', 'Taurus', 'Gemini', 'Cancer', 'Leo', 'Virgo', 'Libra', 'Scorpio', 'Sagittarius', 'Capricorn', 'Aquarius', 'Pisces'];
    
    const signDetails = {
        Aries: { element: 'Fire', color: '#fef2f2', textCol: '#ef4444', desc: 'Courageous, enthusiastic, pioneering, and passionate.' },
        Taurus: { element: 'Earth', color: '#f0fdf4', textCol: '#15803d', desc: 'Grounded, dependable, sensuous, patient, and persistent.' },
        Gemini: { element: 'Air', color: '#ecfeff', textCol: '#0891b2', desc: 'Expressive, witty, communicative, curious, and adaptable.' },
        Cancer: { element: 'Water', color: '#f0f9ff', textCol: '#0284c7', desc: 'Intuitive, nurturing, protective, emotional, and creative.' },
        Leo: { element: 'Fire', color: '#fffbeb', textCol: '#d97706', desc: 'Charismatic, generous, warm-hearted, artistic, and proud.' },
        Virgo: { element: 'Earth', color: '#f0fdf4', textCol: '#15803d', desc: 'Analytical, practical, reliable, meticulous, and helpful.' },
        Libra: { element: 'Air', color: '#ecfeff', textCol: '#0891b2', desc: 'Diplomatic, artistic, social, harmonious, and fair-minded.' },
        Scorpio: { element: 'Water', color: '#f0f9ff', textCol: '#0284c7', desc: 'Intense, magnetic, passionate, strategic, and deeply transformative.' },
        Sagittarius: { element: 'Fire', color: '#fffbeb', textCol: '#d97706', desc: 'Optimistic, freedom-loving, philosophical, and adventurous.' },
        Capricorn: { element: 'Earth', color: '#f0fdf4', textCol: '#15803d', desc: 'Ambitious, disciplined, structured, patient, and highly practical.' },
        Aquarius: { element: 'Air', color: '#ecfeff', textCol: '#0891b2', desc: 'Innovative, humanitarian, independent, progressive, and intellectual.' },
        Pisces: { element: 'Water', color: '#f0f9ff', textCol: '#0284c7', desc: 'Compassionate, imaginative, artistic, intuitive, and highly spiritual.' }
    };

    function getSunSign(month, day) {
        if ((month == 3 && day >= 21) || (month == 4 && day <= 19)) return 'Aries';
        if ((month == 4 && day >= 20) || (month == 5 && day <= 20)) return 'Taurus';
        if ((month == 5 && day >= 21) || (month == 6 && day <= 20)) return 'Gemini';
        if ((month == 6 && day >= 21) || (month == 7 && day <= 22)) return 'Cancer';
        if ((month == 7 && day >= 23) || (month == 8 && day <= 22)) return 'Leo';
        if ((month == 8 && day >= 23) || (month == 9 && day <= 22)) return 'Virgo';
        if ((month == 9 && day >= 23) || (month == 10 && day <= 22)) return 'Libra';
        if ((month == 10 && day >= 23) || (month == 11 && day <= 21)) return 'Scorpio';
        if ((month == 11 && day >= 22) || (month == 12 && day <= 21)) return 'Sagittarius';
        if ((month == 12 && day >= 22) || (month == 1 && day <= 19)) return 'Capricorn';
        if ((month == 1 && day >= 20) || (month == 2 && day <= 18)) return 'Aquarius';
        return 'Pisces';
    }

    function calculate() {
        const dateStr = dateInput.value;
        const hour = parseInt(hourInput.value) || 12;
        const minute = parseInt(minInput.value) || 0;
        const ampm = ampmSelect.value;
        const offset = parseFloat(tzSelect.value) || 0;

        if (!dateStr) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Mapping Stars...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            const birthDate = new Date(dateStr);
            const y = birthDate.getFullYear();
            const m = birthDate.getMonth() + 1; // 1-indexed
            const d = birthDate.getDate();

            // 1. Sun Sign
            const sunSign = getSunSign(m, d);

            // 2. Moon Sign (Epoch formula calibrated to Jan 1 1970 00:00 UTC Moon at Libra ~175 deg)
            // Convert birth hours to 24h format
            let hour24 = hour;
            if (ampm === 'PM' && hour < 12) hour24 += 12;
            if (ampm === 'AM' && hour === 12) hour24 = 0;
            
            // Adjust to UTC
            const birthDateTimeUTC = new Date(Date.UTC(y, m - 1, d, hour24, minute));
            const epoch = Date.UTC(1970, 0, 1, 0, 0, 0);
            
            const diffMs = birthDateTimeUTC.getTime() - epoch;
            const diffDays = diffMs / (1000 * 60 * 60 * 24);

            // Sidereal Month: 27.321661 days
            const lunarCycle = 27.321661;
            const fullCycles = diffDays / lunarCycle;
            const remainingCycleFraction = fullCycles - Math.floor(fullCycles);
            const moonDegrees = (remainingCycleFraction * 360 + 175) % 360;
            const moonIndex = Math.floor(moonDegrees / 30);
            const moonSign = signs[moonIndex];

            // 3. Rising Sign (Diurnal Offset Sunrise Ascendant calculation)
            // At Sunrise (~06:00 AM local time), Ascendant is exactly Sun Sign.
            // Ascendant advances by 1 sign every 2 hours (15 degrees / hour Earth rotation).
            const sunriseOffsetHours = (hour24 - 6 + 24) % 24;
            const localBirthTimeFraction = sunriseOffsetHours + (minute / 60);
            const shifts = Math.floor(localBirthTimeFraction / 2);
            
            const sunIndex = signs.indexOf(sunSign);
            const risingIndex = (sunIndex + shifts) % 12;
            const risingSign = signs[risingIndex];

            // Style outputs according to elements
            const sunD = signDetails[sunSign];
            const moonD = signDetails[moonSign];
            const risingD = signDetails[risingSign];

            outSun.textContent = sunSign;
            outSunEl.textContent = sunD.element;
            outSunEl.style.backgroundColor = sunD.color;
            outSunEl.style.color = sunD.textCol;
            outSunDesc.innerHTML = `<strong>Active traits</strong>: ${sunD.desc}`;

            outMoon.textContent = moonSign;
            outMoonEl.textContent = moonD.element;
            outMoonEl.style.backgroundColor = moonD.color;
            outMoonEl.style.color = moonD.textCol;
            outMoonDesc.innerHTML = `<strong>Inner instincts</strong>: ${moonD.desc}`;

            outRising.textContent = risingSign;
            outRisingEl.textContent = risingD.element;
            outRisingEl.style.backgroundColor = risingD.color;
            outRisingEl.style.color = risingD.textCol;
            outRisingDesc.innerHTML = `<strong>Outer persona</strong>: ${risingD.desc}`;

            // Build Insights summary
            const insText = `
                <p class="mb-3">You possess a <strong>${sunD.element} Sun</strong>, a <strong>${moonD.element} Moon</strong>, and a <strong>${risingD.element} Rising</strong> sign. This combination blends the active willpower of ${sunSign} with the internal emotional landscape of ${moonSign}, projected outwardly through the social lens of ${risingSign}.</p>
                <ul class="list-unstyled mb-0 row g-2">
                    <li class="col-md-6 mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span><strong>Planetary Balance:</strong> Your cosmic matrix leans towards the <strong>${sunD.element}</strong> element, driving primary life motivations.</span></li>
                    <li class="col-md-6 mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span><strong>Ascendant Dynamic:</strong> Born at <strong>${hour}:${minute.toString().padStart(2, '0')} ${ampm}</strong>, your rising sign represents the immediate energy mask you project in new situations.</span></li>
                </ul>
            `;
            outInsights.innerHTML = insText;

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-moon me-2"></i> Compute Birth Chart';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculate);

    btnReset.addEventListener('click', function() {
        dateInput.value = '1995-10-24';
        hourInput.value = '10';
        minInput.value = '30';
        ampmSelect.value = 'PM';
        tzSelect.value = '5.5';
        cityInput.value = 'Mumbai';
        resultCard.classList.add('d-none');
    });

    btnCopy.addEventListener('click', function() {
        const text = `Cosmic Natal Chart Alignment\n━━━━━━━━━━━━━━━━━━━━━━\nBirth Date: ${dateInput.value}\nBirth Time: ${hourInput.value}:${minInput.value} ${ampmSelect.value} (GMT ${tzSelect.value})\nBirth City: ${cityInput.value}\n━━━━━━━━━━━━━━━━━━━━━━\n☀️ SUN SIGN: ${outSun.textContent} (${outSunEl.textContent})\n🌙 MOON SIGN: ${outMoon.textContent} (${outMoonEl.textContent})\n🌅 RISING SIGN: ${outRising.textContent} (${outRisingEl.textContent})\n━━━━━━━━━━━━━━━━━━━━━━\nGenerated via ToolsHub.`;
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
