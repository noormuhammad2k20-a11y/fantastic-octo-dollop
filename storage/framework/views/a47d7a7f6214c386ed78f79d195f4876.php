<div class="row g-4 soul-urge-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Full Birth Name</label>
                        <input type="text" id="user-name" class="form-control form-control-lg rounded-3" placeholder="Enter full name exactly as on birth certificate" value="John Doe">
                        <span class="text-muted small">We parse vowels A, E, I, O, U, and 'Y' where applicable.</span>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Actions:</span>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 tool-action-btn" id="btn-calculate">Find My Soul Urge</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 tool-action-btn" id="btn-reset">Reset Fields</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-card" style="--tool-hue:240;--tool-color:#6366f1;--tool-bg:rgba(99,102,241,.04);display:none;">
            <div class="output-hero">
                <span class="output-hero-label">Your Soul Urge Number</span>
                <div class="output-hero-value" id="out-number" style="font-size:3.5rem">0</div>
                <span class="output-hero-unit" id="out-name-display">For John Doe</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Core Vibrational Frequency</span><span class="stat-card-value" id="out-frequency">Master Number</span></div></div>
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Vowels Identified</span><span class="stat-card-value" id="out-vowels">O, E</span></div></div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-scroll me-2 text-primary"></i>Personality Insight</h6>
                <div id="out-description" class="text-secondary leading-relaxed"></div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-sm table-bordered text-center small mb-0">
                    <thead class="table-light"><tr><th>Letter</th><th>Value (Pythagorean)</th><th>Type</th></tr></thead>
                    <tbody id="out-breakdown"></tbody>
                </table>
            </div>

            <div class="mt-4" id="out-advice"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const nameInput=$('user-name'), outputCard=$('output-card');

    const pythagorean={
        'A':1,'B':2,'C':3,'D':4,'E':5,'F':6,'G':7,'H':8,'I':9,
        'J':1,'K':2,'L':3,'M':4,'N':5,'O':6,'P':7,'Q':8,'R':9,
        'S':1,'T':2,'U':3,'V':4,'W':5,'X':6,'Y':7,'Z':8
    };

    const meanings={
        1: "Independent and ambitious. You desire to lead and create your own path. You value individuality and personal achievement above all.",
        2: "Peaceful and diplomatic. You crave harmony, partnership, and emotional connection. You are the 'glue' that holds relationships together.",
        3: "Expressive and creative. You desire to inspire others through art, communication, or joy. You have a deep need for social interaction.",
        4: "Practical and stable. You seek security, order, and foundations. You are dedicated to hard work and building something lasting.",
        5: "Adventurous and free. You desire variety, travel, and sensory experiences. You thrive on change and personal freedom.",
        6: "Nurturing and responsible. You crave a harmonious home life and find fulfillment in serving others. You are a natural caretaker.",
        7: "Introspective and spiritual. You seek truth, knowledge, and inner wisdom. You prefer solitude and deep philosophical thinking.",
        8: "Ambitious and powerful. You desire material success, authority, and financial abundance. You are a natural executive.",
        9: "Humanitarian and selfless. You desire to help the world and possess deep compassion. You seek universal love and understanding.",
        11: "The Visionary. You possess high spiritual intuition and a desire to illuminate others. You are deeply sensitive and prophetic.",
        22: "The Master Builder. You have the desire to turn grand visions into concrete reality. You seek to leave a monumental legacy.",
        33: "The Master Teacher. Your desire is to raise the vibration of humanity through selfless service and profound compassion."
    };

    function isVowel(char, index, str) {
        char = char.toUpperCase();
        if (['A', 'E', 'I', 'O', 'U'].includes(char)) return true;
        if (char === 'Y') {
            // Y is a vowel if it's not the first letter and not next to another vowel
            if (index === 0) return false;
            const prev = str[index - 1].toUpperCase();
            if (['A', 'E', 'I', 'O', 'U'].includes(prev)) return false;
            return true;
        }
        return false;
    }

    function reduce(num) {
        if (num === 11 || num === 22 || num === 33) return num;
        while (num > 9) {
            num = num.toString().split('').reduce((a, b) => parseInt(a) + parseInt(b), 0);
            if (num === 11 || num === 22 || num === 33) return num;
        }
        return num;
    }

    function calculate(){
        const name = nameInput.value.trim();
        if(!name) return;

        let total = 0;
        let foundVowels = [];
        let rows = '';

        for(let i=0; i<name.length; i++) {
            const char = name[i].toUpperCase();
            if(pythagorean[char]) {
                const vowel = isVowel(name[i], i, name);
                if(vowel) {
                    const val = pythagorean[char];
                    total += val;
                    foundVowels.push(char);
                    rows += `<tr class="table-success"><td>${char}</td><td>${val}</td><td>Vowel</td></tr>`;
                } else {
                    rows += `<tr><td>${char}</td><td>-</td><td>Consonant</td></tr>`;
                }
            }
        }

        const result = reduce(total);
        
        $('out-number').textContent = result;
        $('out-name-display').textContent = `For ${name}`;
        $('out-vowels').textContent = [...new Set(foundVowels)].join(', ');
        $('out-frequency').textContent = result > 9 ? 'Master Number' : 'Primary Vibration';
        $('out-description').innerHTML = meanings[result] || "Your soul urge number reflects a unique spiritual frequency.";
        $('out-breakdown').innerHTML = rows;

        outputCard.style.display = 'block';
        outputCard.scrollIntoView({behavior:'smooth', block:'center'});
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        nameInput.value = '';
        outputCard.style.display = 'none';
    });

    nameInput.addEventListener('keypress', (e) => { if(e.key === 'Enter') calculate(); });
});
</script>

<style>
.soul-urge-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.soul-urge-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.soul-urge-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.soul-urge-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.soul-urge-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.soul-urge-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.leading-relaxed { line-height: 1.6; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\soul-urge-number.blade.php ENDPATH**/ ?>