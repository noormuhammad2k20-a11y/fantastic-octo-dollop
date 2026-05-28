<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                <div class="col-md-7">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Birth Identity</h6>
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Exact Birth Date</label>
                                <input type="date" id="in-date" class="form-control form-control-lg rounded-3" value="1990-01-01">
                                <p class="text-muted x-small mt-2 mb-0"><i class="fas fa-info-circle me-1"></i> Required for accurate Lunar New Year boundary check.</p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Gender</label>
                                <select id="in-gender" class="form-select form-select-lg rounded-3">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="unspecified">Unspecified</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="p-4 rounded-4 h-100" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Quick Insights</h6>
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex align-items-center gap-3 p-2 bg-white rounded-3 border">
                                <div class="bg-warning-soft rounded-circle p-2 text-warning" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-moon small"></i>
                                </div>
                                <div class="small fw-bold text-secondary">Lunar-Solis Tracking</div>
                            </div>
                            <div class="d-flex align-items-center gap-3 p-2 bg-white rounded-3 border">
                                <div class="bg-success-soft rounded-circle p-2 text-success" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-leaf small"></i>
                                </div>
                                <div class="small fw-bold text-secondary">5-Element Theory Applied</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-warning btn-lg rounded-pill px-5 shadow-sm transition-all text-dark fw-bold" id="btn-calculate" style="min-width: 280px;">
                    <i class="fas fa-paw me-2"></i> Find My Animal
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-danger-soft">
                        <i class="fas fa-fire-alt text-danger"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Celestial Analysis</h5>
                        <p class="text-muted small mb-0">Your zodiac profile and energetic resonance</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-dark btn-sm rounded-pill px-4 shadow-sm" id="btn-copy">
                        <i class="fas fa-copy me-1"></i> Copy Profile
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 mb-4 align-items-center">
                <div class="col-lg-4 text-center border-end">
                    <div id="out-emoji" class="display-1 mb-2">🐉</div>
                    <div class="h2 fw-black text-dark mb-0" id="out-animal">The Dragon</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1 mt-1" id="out-year-display">Metal Year</p>
                </div>
                <div class="col-lg-8">
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Element</div>
                                <div class="h5 fw-bold mb-0 text-primary" id="out-element">-</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Polarity</div>
                                <div class="h5 fw-bold mb-0" id="out-polarity">-</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Lucky Color</div>
                                <div class="h5 fw-bold mb-0 text-success" id="out-lucky-color">-</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 rounded-4 bg-white border">
                        <h6 class="fw-bold text-dark mb-2">Personality Blueprint</h6>
                        <p id="out-personality" class="text-secondary small leading-relaxed mb-0"></p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-warning-soft border border-warning border-opacity-10 h-100">
                        <h6 class="fw-bold mb-3 small text-uppercase text-warning letter-spacing-1">
                            <i class="fas fa-heart me-2"></i>Lucky Signs
                        </h6>
                        <ul class="list-unstyled mb-0 small text-secondary" id="out-luck-list">
                            <!-- Luck list injected here -->
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-info-soft border border-info border-opacity-10 h-100">
                        <h6 class="fw-bold mb-3 small text-uppercase text-info letter-spacing-1">
                            <i class="fas fa-sync-alt me-2"></i>Career & Wealth
                        </h6>
                        <p id="out-career" class="small text-secondary mb-0"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #f59e0b;
        --warning-soft: #fffbeb;
        --success-soft: #f0fdf4;
        --danger-soft: #fef2f2;
        --info-soft: #f0f9ff;
        --border-color: #e2e8f0;
    }

    .bg-warning-soft { background-color: var(--warning-soft); }
    .bg-success-soft { background-color: var(--success-soft); }
    .bg-danger-soft { background-color: var(--danger-soft); }
    .bg-info-soft { background-color: var(--info-soft); }

    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #eef2f6 !important; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .btn-light-v2 { background: #f8fafc; border: 1px solid #e2e8f0; color: #64748b; font-weight: 600; }
    .form-control-lg, .form-select-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.05rem; padding: 0.7rem 1rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1); outline: none; }
    
    .transition-all { transition: all 0.3s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .x-small { font-size: 0.75rem; }
    .leading-relaxed { line-height: 1.6; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateE = document.getElementById('in-date');
    const genderE = document.getElementById('in-gender');
    const resultCard = document.getElementById('result-card');
    
    const outEmoji = document.getElementById('out-emoji');
    const outAnimal = document.getElementById('out-animal');
    const outYearDisp = document.getElementById('out-year-display');
    const outElement = document.getElementById('out-element');
    const outPolarity = document.getElementById('out-polarity');
    const outLuckyColor = document.getElementById('out-lucky-color');
    const outPersonality = document.getElementById('out-personality');
    const outLuckList = document.getElementById('out-luck-list');
    const outCareer = document.getElementById('out-career');
    const btnCalculate = document.getElementById('btn-calculate');

    // Lunar New Year Start Dates (1900 - 2030 for broad coverage)
    const lunarStarts = {
        1900: "01-31", 1901: "02-19", 1902: "02-08", 1903: "01-29", 1904: "02-16", 1905: "02-04", 1906: "01-25", 1907: "02-13", 1908: "02-02", 1909: "01-22",
        1910: "02-10", 1911: "01-30", 1912: "02-18", 1913: "02-06", 1914: "01-26", 1915: "02-14", 1916: "02-03", 1917: "01-23", 1918: "02-11", 1919: "02-01",
        1920: "02-20", 1921: "02-08", 1922: "01-28", 1923: "02-16", 1924: "02-05", 1925: "01-24", 1926: "02-13", 1927: "02-02", 1928: "01-23", 1929: "02-10",
        1930: "01-30", 1931: "02-17", 1932: "02-06", 1933: "01-26", 1934: "02-14", 1935: "02-04", 1936: "01-24", 1937: "02-11", 1938: "01-31", 1939: "02-19",
        1940: "02-08", 1941: "01-27", 1942: "02-15", 1943: "02-05", 1944: "01-25", 1945: "02-13", 1946: "02-02", 1947: "01-22", 1948: "02-10", 1949: "01-29",
        1950: "02-17", 1951: "02-06", 1952: "01-27", 1953: "02-14", 1954: "02-03", 1955: "01-24", 1956: "02-12", 1957: "01-31", 1958: "02-18", 1959: "02-08",
        1960: "01-28", 1961: "02-15", 1962: "02-05", 1963: "01-25", 1964: "02-13", 1965: "02-02", 1966: "01-21", 1967: "02-09", 1968: "01-30", 1969: "02-17",
        1970: "02-06", 1971: "01-27", 1972: "02-15", 1973: "02-03", 1974: "01-23", 1975: "02-11", 1976: "01-31", 1977: "02-18", 1978: "02-07", 1979: "01-28",
        1980: "02-16", 1981: "02-05", 1982: "01-25", 1983: "02-13", 1984: "02-02", 1985: "01-21", 1986: "02-09", 1987: "01-29", 1988: "02-17", 1989: "02-06",
        1990: "01-27", 1991: "02-15", 1992: "02-04", 1993: "01-23", 1994: "02-10", 1995: "01-31", 1996: "02-19", 1997: "02-07", 1998: "01-28", 1999: "02-16",
        2000: "02-05", 2001: "01-24", 2002: "02-12", 2003: "02-01", 2004: "01-22", 2005: "02-09", 2006: "01-29", 2007: "02-18", 2008: "02-07", 2009: "01-26",
        2010: "02-14", 2011: "02-03", 2012: "01-23", 2013: "02-10", 2014: "01-31", 2015: "02-19", 2016: "02-08", 2017: "01-28", 2018: "02-16", 2019: "02-05",
        2020: "01-25", 2021: "02-12", 2022: "02-01", 2023: "01-22", 2024: "02-10", 2025: "01-29", 2026: "02-17", 2027: "02-06", 2028: "01-26", 2029: "02-13",
        2030: "02-03"
    };

    const animals = ["Rat", "Ox", "Tiger", "Rabbit", "Dragon", "Snake", "Horse", "Goat", "Monkey", "Rooster", "Dog", "Pig"];
    const emojis = ["🐭", "🐮", "🐯", "🐰", "🐲", "🐍", "🐴", "🐑", "🐵", "🐔", "🐶", "🐷"];
    const elements = ["Metal", "Water", "Wood", "Fire", "Earth"];
    
    const details = {
        "Rat": { personality: "Quick-witted, resourceful, versatile, and kind. Rats are leaders, pioneers, and conquerors. They are highly observant and can always find a way out of a problem.", luck: ["Numbers: 2, 3", "Colors: Blue, Gold", "Flowers: Lily"], career: "Success in sales, business, and journalism. Naturally hardworking and frugal." },
        "Ox": { personality: "Diligence, dependability, strength, and determination. Oxen are the stable backbone of any family or business. They are patient and tire easily of drama.", luck: ["Numbers: 1, 4", "Colors: White, Yellow", "Flowers: Tulip"], career: "Excellence in agriculture, engineering, and pharmacy. A steady hand for long-term growth." },
        "Tiger": { personality: "Brave, competitive, unpredictable, and self-confident. Tigers are born leaders who command respect. They are charming and well-liked but often act on impulse.", luck: ["Numbers: 1, 3, 4", "Colors: Blue, Grey, Orange", "Flowers: Yellow Lily"], career: "Advertising, management, and travel. Thrives in high-pressure, exciting roles." },
        "Rabbit": { personality: "Gentle, quiet, elegant, and alert as well as quick, skillful, kind, and patient. Rabbits are faithful to those around them but hesitant to reveal their minds to others.", luck: ["Numbers: 3, 4, 6", "Colors: Pink, Purple", "Flowers: Jasmine"], career: "Education, health care, and medicine. Naturally empathetic and detail-oriented." },
        "Dragon": { personality: "Confident, intelligent, and enthusiastic. Dragons are the most powerful zodiac sign. They are unafraid of challenges and willing to take risks to achieve their goals.", luck: ["Numbers: 1, 6, 7", "Colors: Gold, Silver", "Flowers: bleeding-heart"], career: "Politics, religious leadership, and entrepreneurship. Born to lead on a grand scale." },
        "Snake": { personality: "Enigmatic, intelligent, and wise. Snakes are deep thinkers who follow their intuition. While they appear calm, they are intensely passionate and determined.", luck: ["Numbers: 2, 8, 9", "Colors: Red, Light Yellow", "Flowers: Orchid"], career: "Psychology, research, and high-level strategy. Perfect for roles requiring deep focus." },
        "Horse": { personality: "Animated, active, and energetic. Horses love to be in a crowd. They are independent and crave freedom, often achieving success through their own hard work.", luck: ["Numbers: 2, 3, 7", "Colors: Yellow, Green", "Flowers: Calla Lily"], career: "Public relations, tourism, and performance. Thrives where there is movement and change." },
        "Goat": { personality: "Gentle, mild-mannered, shy, stable, sympathetic, amicable, and brimming with a strong sense of kindheartedness and justice. They are the most creative sign.", luck: ["Numbers: 2, 7", "Colors: Brown, Red", "Flowers: Carnation"], career: "Art, music, and social work. Success through creativity and helping others." },
        "Monkey": { personality: "Witty, intelligent, and has a magnetic personality. Monkeys are mischievous and clever, with a great sense of humor. They can solve almost any problem.", luck: ["Numbers: 4, 9", "Colors: White, Blue", "Flowers: Chrysanthemum"], career: "Banking, science, and technology. Brilliant at systems and analytical thinking." },
        "Rooster": { personality: "Observant, hardworking, resourceful, courageous, and talented. Roosters are very confident in themselves. They are active, amusing, and popular among the crowd.", luck: ["Numbers: 5, 7, 8", "Colors: Gold, Brown", "Flowers: Gladiola"], career: "Hospitality, law, and performance. Great at managing details and presentation." },
        "Dog": { personality: "Loyal, honest, amiable, kind, cautious, and prudent. Dogs will do everything for the person who they think is important. They are the most faithful companions.", luck: ["Numbers: 3, 4, 9", "Colors: Green, Red", "Flowers: Rose"], career: "Security, law enforcement, and counseling. Unwavering loyalty and sense of justice." },
        "Pig": { personality: "Compassionate, generous, and diligent. Pigs have a great sense of responsibility. They are realistic and don't waste time on trifles, focusing on goals.", luck: ["Numbers: 2, 5, 8", "Colors: Yellow, Grey", "Flowers: Marguerite"], career: "Logistics, gastronomy, and finance. Naturally prosperous and dependable in business." }
    };

    function calculate() {
        const dateVal = dateE.value;
        if (!dateVal) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Mapping Stars...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            const birthDate = new Date(dateVal);
            const year = birthDate.getFullYear();
            
            // Adjust year for Lunar New Year
            let lunarYear = year;
            if (lunarStarts[year]) {
                const [m, d] = lunarStarts[year].split('-').map(Number);
                const startOfLunar = new Date(year, m - 1, d);
                if (birthDate < startOfLunar) {
                    lunarYear = year - 1;
                }
            } else if (birthDate.getMonth() < 2) {
                // Fallback for years not in table: Assume Feb 5th average
                const avgStart = new Date(year, 1, 5);
                if (birthDate < avgStart) lunarYear = year - 1;
            }

            // Animal: (Year - 4) % 12
            const animalIndex = (lunarYear - 4) % 12;
            const animal = animals[animalIndex >= 0 ? animalIndex : animalIndex + 12];
            const emoji = emojis[animalIndex >= 0 ? animalIndex : animalIndex + 12];
            
            // Element: Last digit of year (0,1 = Metal, 2,3 = Water, 4,5 = Wood, 6,7 = Fire, 8,9 = Earth)
            const element = elements[Math.floor((lunarYear % 10) / 2)];
            const polarity = lunarYear % 2 === 0 ? "Yang" : "Yin";

            // UI Updates
            outEmoji.textContent = emoji;
            outAnimal.textContent = `The ${animal}`;
            outYearDisp.textContent = `${element} ${animal} Year`;
            outElement.textContent = element;
            outPolarity.textContent = polarity;
            
            const data = details[animal];
            outLuckyColor.textContent = data.luck[1].split(': ')[1].split(',')[0];
            outPersonality.textContent = data.personality;
            outCareer.textContent = data.career;
            
            outLuckList.innerHTML = data.luck.map(l => `<li class="mb-2 d-flex align-items-center"><i class="fas fa-check-circle text-warning me-2"></i><span>${l}</span></li>`).join('');

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth', block: 'center' });

            btnCalculate.innerHTML = '<i class="fas fa-paw me-2"></i> Find My Animal';
            btnCalculate.disabled = false;
        }, 800);
    }

    btnCalculate.addEventListener('click', calculate);

    document.getElementById('btn-reset').addEventListener('click', () => {
        dateE.value = '1990-01-01';
        resultCard.classList.add('d-none');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    document.getElementById('btn-copy').addEventListener('click', function() {
        const text = `Chinese Zodiac Analysis\nAnimal: ${outAnimal.textContent}\nElement: ${outElement.textContent}\nPolarity: ${outPolarity.textContent}\nPersonality: ${outPersonality.textContent}\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-1"></i> Profile Copied!';
            btn.classList.replace('btn-dark', 'btn-success');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-success', 'btn-dark');
            }, 2000);
        });
    });
});
</script>
