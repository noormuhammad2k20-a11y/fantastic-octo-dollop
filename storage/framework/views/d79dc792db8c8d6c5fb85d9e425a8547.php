<div class="interactive-tool-container">
    
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4 p-md-5">
            <h4 class="fw-bold text-dark mb-4"><i class="fas fa-signature text-accent me-2"></i> Name Input</h4>
            <p class="text-secondary small mb-4">Enter your full birth name or business name to analyze its numeric vibration using the Pythagorean system.</p>
            
            <div class="mb-4">
                <label class="form-label fw-semibold text-uppercase small letter-spacing-1 text-muted">Full Name</label>
                <div class="input-group input-group-lg shadow-sm rounded-3 overflow-hidden border">
                    <span class="input-group-text bg-white border-0"><i class="fas fa-user-tag text-accent"></i></span>
                    <input type="text" id="name-input" class="form-control border-0 px-3" placeholder="e.g. John Winston Lennon">
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="p-3 bg-light rounded-3 border">
                        <h6 class="small fw-bold mb-1">Calculation System</h6>
                        <p class="text-muted small mb-0">Pythagorean Numerology (Modern Western)</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="p-3 bg-light rounded-3 border">
                        <h6 class="small fw-bold mb-1">Master Numbers</h6>
                        <p class="text-muted small mb-0">Detects 11, 22, and 33 vibrations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="text-center mb-5">
        <button id="btn-analyze" class="btn btn-accent btn-lg px-5 py-3 fw-bold shadow-sm rounded-pill transition-all">
            <i class="fas fa-magic me-2"></i> Analyze Name
        </button>
    </div>

    
    <div id="result-card" class="card border-0 shadow-lg rounded-4 d-none">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h4 class="fw-bold text-dark mb-0"><i class="fas fa-id-card text-accent me-2"></i> Numerological Profile</h4>
                <button class="btn btn-sm btn-outline-accent rounded-pill px-3" id="btn-copy">
                    <i class="fas fa-copy me-1"></i> Copy Results
                </button>
            </div>

            <div class="row g-4 mb-4 text-center">
                <div class="col-12 col-md-4">
                    <div class="p-4 rounded-4 bg-light border">
                        <h6 class="text-uppercase small fw-bold text-muted mb-2">Expression (Destiny)</h6>
                        <div id="res-expression" class="display-5 fw-black text-accent">-</div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="p-4 rounded-4 bg-light border">
                        <h6 class="text-uppercase small fw-bold text-muted mb-2">Soul Urge</h6>
                        <div id="res-soul" class="display-5 fw-black text-accent">-</div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="p-4 rounded-4 bg-light border">
                        <h6 class="text-uppercase small fw-bold text-muted mb-2">Personality</h6>
                        <div id="res-personality" class="display-5 fw-black text-accent">-</div>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 bg-dark text-white shadow-inner">
                <h5 id="destiny-title" class="fw-bold text-accent mb-2">The Number [N] Energy</h5>
                <p id="res-meaning" class="mb-0 small" style="opacity: 0.9; line-height: 1.6;">
                    Your name analysis results will appear here.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    :root { --accent: #ff6b00; }
    .text-accent { color: var(--accent) !important; }
    .btn-accent { background: var(--accent); color: white; border: none; }
    .btn-accent:hover { background: #e65100; color: white; transform: translateY(-2px); }
    .btn-outline-accent { color: var(--accent); border-color: var(--accent); }
    .btn-outline-accent:hover { background: var(--accent); color: white; }
    .fw-black { font-weight: 900; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .transition-all { transition: all 0.3s ease; }
    .shadow-inner { box-shadow: inset 0 2px 10px rgba(0,0,0,0.1); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('name-input');
    const btnAnalyze = document.getElementById('btn-analyze');
    const resultCard = document.getElementById('result-card');

    const charMap = {
        a:1, j:1, s:1,
        b:2, k:2, t:2,
        c:3, l:3, u:3,
        d:4, m:4, v:4,
        e:5, n:5, w:5,
        f:6, o:6, x:6,
        g:7, p:7, y:7,
        h:8, q:8, z:8,
        i:9, r:9
    };

    const interpretations = {
        '1': "The Leader. You possess strong individuality, ambition, and willpower. You are a pioneer who prefers to lead rather than follow.",
        '2': "The Peacekeeper. You are diplomatic, sensitive, and cooperative. You find your greatest success when working in partnership or supporting others.",
        '3': "The Communicator. You are expressive, joyful, and creative. You have a gift for words and social interaction.",
        '4': "The Builder. You are practical, disciplined, and hardworking. You find security in order, structure, and tradition.",
        '5': "The Adventurer. You are versatile, freedom-loving, and progressive. You thrive on change and exploring new experiences.",
        '6': "The Nurturer. You are responsible, loving, and protective. You find fulfillment in serving your family and community.",
        '7': "The Seeker. You are analytical, spiritual, and introspective. You seek deeper truths and prefer a quiet, contemplative life.",
        '8': "The Powerhouse. You are ambitious, authoritative, and material-minded. You have a natural ability to manage wealth and lead organizations.",
        '9': "The Humanitarian. You are compassionate, idealistic, and selfless. You are driven by a desire to help others and the world.",
        '11': "The Visionary (Master). You possess intense spiritual insight and intuition. You are a 'bridge' between the spiritual and material realms.",
        '22': "The Master Builder. You have the ability to turn large-scale dreams into material reality. You are highly disciplined and capable.",
        '33': "The Master Teacher. You represent pure love and selfless service. You possess a unique vibration of healing and guidance."
    };

    function reduce(num, allowMaster = true) {
        if (allowMaster && [11, 22, 33].includes(num)) return num;
        if (num <= 9) return num;
        const sum = num.toString().split('').reduce((a, b) => a + parseInt(b), 0);
        return reduce(sum, allowMaster);
    }

    btnAnalyze.addEventListener('click', function() {
        const name = input.value.trim().toLowerCase();
        if (!name) {
            alert('Please enter a name first.');
            return;
        }

        btnAnalyze.innerHTML = '<i class="fas fa-circle-notch fa-spin me-2"></i> Analyzing...';
        btnAnalyze.disabled = true;

        setTimeout(() => {
            const vowels = ['a', 'e', 'i', 'o', 'u', 'y'];
            let expTotal = 0;
            let soulTotal = 0;
            let persTotal = 0;

            for (let char of name) {
                if (charMap[char]) {
                    const val = charMap[char];
                    expTotal += val;
                    if (vowels.includes(char)) soulTotal += val;
                    else persTotal += val;
                }
            }

            const expression = reduce(expTotal);
            const soul = reduce(soulTotal);
            const personality = reduce(persTotal);

            document.getElementById('res-expression').textContent = expression;
            document.getElementById('res-soul').textContent = soul;
            document.getElementById('res-personality').textContent = personality;
            document.getElementById('destiny-title').textContent = `The Number ${expression} Energy`;
            document.getElementById('res-meaning').textContent = interpretations[expression.toString()] || interpretations['1'];

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth', block: 'center' });

            btnAnalyze.innerHTML = '<i class="fas fa-magic me-2"></i> Analyze Name';
            btnAnalyze.disabled = false;
        }, 800);
    });

    document.getElementById('btn-copy').addEventListener('click', function() {
        const text = `Name Analysis for: ${input.value}\nExpression: ${document.getElementById('res-expression').innerText}\nSoul Urge: ${document.getElementById('res-soul').innerText}\nPersonality: ${document.getElementById('res-personality').innerText}\n\nMeaning: ${document.getElementById('res-meaning').innerText}`;
        navigator.clipboard.writeText(text);
        const original = this.innerHTML;
        this.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        setTimeout(() => this.innerHTML = original, 2000);
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\name-number-calculator.blade.php ENDPATH**/ ?>