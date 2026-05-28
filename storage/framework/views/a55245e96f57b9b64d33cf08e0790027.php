<div class="row g-4 joke-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body text-center">
                <div class="mb-4 d-flex justify-content-center gap-3 flex-wrap" id="joke-categories">
                    <button class="btn btn-outline-primary active cat-btn" data-cat="any">Any Joke</button>
                    <button class="btn btn-outline-primary cat-btn" data-cat="dad">Dad Jokes</button>
                    <button class="btn btn-outline-primary cat-btn" data-cat="dev">Programming</button>
                    <button class="btn btn-outline-primary cat-btn" data-cat="pun">Puns</button>
                </div>

                <button class="btn btn-primary py-3 px-5 fw-bold rounded-pill fs-4" id="joke-generate" style="min-width: 280px; max-width: 100%; background:#3b82f6; border:none; box-shadow: 0 4px 15px rgba(59,130,246,.3);">
                    <i class="fas fa-theater-masks me-2"></i>Tell Me A Joke
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none text-center" id="joke-output-card" style="--tool-hue:210;--tool-color:#2563eb;--tool-bg:rgba(59,130,246,.04); border-color:#bfdbfe; padding: 4rem 2rem;">
            
            <div class="mb-4">
                <i class="fas fa-quote-left" style="font-size: 2rem; color: rgba(59,130,246,0.3);"></i>
            </div>
            
            <h2 id="joke-setup" class="fw-bold text-dark mb-4" style="line-height: 1.4;">Why did the chicken cross the road?</h2>
            
            <div id="punchline-container">
                <button class="btn btn-dark rounded-pill px-4" id="btn-reveal" style="min-width: 280px; max-width: 100%;">Reveal Punchline</button>
                <h2 id="joke-punchline" class="fw-black text-primary d-none mt-4 animate__animated animate__zoomIn">To get to the other side!</h2>
            </div>
            
        </div>
    </div>
</div>

<style>
.joke-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.joke-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.joke-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.joke-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.joke-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}

.btn-outline-primary {
    color: #3b82f6;
    border-color: #bfdbfe;
    font-weight: 600;
}
.btn-outline-primary:hover, .btn-outline-primary.active {
    background: #3b82f6;
    color: #fff;
    border-color: #3b82f6;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let selectedCat = 'any';

    const db = {
        dad: [
            { s: "I'm afraid for the calendar.", p: "Its days are numbered." },
            { s: "My wife said I should do lunges to stay in shape.", p: "That would be a big step forward." },
            { s: "Why do fathers take an extra pair of socks when they go golfing?", p: "In case they get a hole in one!" },
            { s: "Singing in the shower is fun until you get soap in your mouth.", p: "Then it's a soap opera." }
        ],
        dev: [
            { s: "Why do programmers prefer dark mode?", p: "Because light attracts bugs." },
            { s: "How many programmers does it take to change a light bulb?", p: "None. It's a hardware problem." },
            { s: "A SQL query goes into a bar, walks up to two tables and asks...", p: "'Can I join you?'" },
            { s: "What's the object-oriented way to become wealthy?", p: "Inheritance." }
        ],
        pun: [
            { s: "I reading a book on anti-gravity.", p: "I just can't put it down." },
            { s: "I told my doctor that I broke my arm in two places.", p: "He told me to stop going to those places." },
            { s: "Did you hear about the guy who invented Lifesavers?", p: "They say he made a mint." },
            { s: "I used to be a baker.", p: "But I couldn't make enough dough." }
        ]
    };

    document.querySelectorAll('.cat-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            selectedCat = this.dataset.cat;
        });
    });

    $('joke-generate').addEventListener('click', function() {
        let cat = selectedCat;
        if (cat === 'any') {
            const keys = Object.keys(db);
            cat = keys[Math.floor(Math.random() * keys.length)];
        }

        const list = db[cat];
        const joke = list[Math.floor(Math.random() * list.length)];

        $('joke-setup').textContent = joke.s;
        $('joke-punchline').textContent = joke.p;
        
        $('joke-punchline').classList.add('d-none');
        $('btn-reveal').classList.remove('d-none');

        $('joke-output-card').classList.remove('d-none');
        $('joke-output-card').classList.remove('animate__animated', 'animate__fadeInUp');
        void $('joke-output-card').offsetWidth;
        $('joke-output-card').classList.add('animate__animated', 'animate__fadeInUp');
        
        $('joke-output-card').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });

    $('btn-reveal').addEventListener('click', function() {
        this.classList.add('d-none');
        $('joke-punchline').classList.remove('d-none');
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\random-joke-generator.blade.php ENDPATH**/ ?>