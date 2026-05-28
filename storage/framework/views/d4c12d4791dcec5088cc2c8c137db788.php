<div class="row g-4 prompt-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Select Genre</label>
                    <div class="d-flex flex-wrap gap-2" id="prompt-genres">
                        <button class="btn btn-outline-primary active genre-btn" data-genre="any">Any Genre</button>
                        <button class="btn btn-outline-primary genre-btn" data-genre="scifi">Sci-Fi</button>
                        <button class="btn btn-outline-primary genre-btn" data-genre="fantasy">Fantasy</button>
                        <button class="btn btn-outline-primary genre-btn" data-genre="mystery">Mystery</button>
                        <button class="btn btn-outline-primary genre-btn" data-genre="romance">Romance</button>
                        <button class="btn btn-outline-primary genre-btn" data-genre="horror">Horror</button>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-primary fw-bold fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="prompt-generate" style="min-width: 280px; max-width: 100%; background:#8b5cf6; border:none; box-shadow: 0 8px 20px rgba(139,92,246,0.2);">
                    <i class="fas fa-magic me-2"></i>Inspire Me
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none text-center" id="prompt-output-card" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04); border-color:#ddd6fe; padding: 4rem 2rem;">
            <i class="fas fa-quote-left mb-3" style="font-size: 3rem; color: rgba(139,92,246,0.3);"></i>
            <h2 id="prompt-text" class="fw-black text-dark mb-4" style="line-height: 1.5; font-family: Georgia, serif;">Prompt text goes here.</h2>
            <div class="d-flex justify-content-center gap-2">
                <span id="prompt-badge" class="badge bg-primary px-3 py-2 text-uppercase letter-spacing-1">GENRE</span>
            </div>
        </div>
    </div>
</div>

<style>
.prompt-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.prompt-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.prompt-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.prompt-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.prompt-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.prompt-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.8rem;}

.btn-outline-primary {
    color: #8b5cf6;
    border-color: #ddd6fe;
    background: #fff;
    font-weight: 600;
    border-radius: 20px;
    padding: 0.5rem 1.5rem;
}
.btn-outline-primary:hover {
    background: #f5f3ff;
    color: #7c3aed;
    border-color: #ddd6fe;
}
.btn-outline-primary.active {
    background: #8b5cf6;
    color: #fff;
    border-color: #8b5cf6;
}
.letter-spacing-1 { letter-spacing: 1px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let selectedGenre = 'any';

    const prompts = {
        scifi: [
            "You wake up on a spaceship with no memory of how you got there. The only other occupant is an AI that refuses to speak.",
            "Time travel is real, but it's heavily regulated. You work for the agency that hunts down illegal tourists.",
            "Earth has finally made contact with aliens, but they are terrified of us.",
            "In the future, memories can be uploaded and sold. You just found a memory that doesn't belong to you."
        ],
        fantasy: [
            "A dragon has been attacking the kingdom, but you are the only one who realizes it's actually trying to warn you of a greater threat.",
            "You find a sword in a stone, but pulling it out doesn't make you king. It makes you the villain.",
            "Magic is real, but it drains your life force. You've just discovered a way to use it without consequence.",
            "You are a wizard who is terrible at magic, but you're an excellent con artist."
        ],
        mystery: [
            "A detective is investigating a murder where all the evidence points to a person who has been dead for ten years.",
            "You receive a letter in the mail from yourself, postmarked five years in the future.",
            "Everyone in your small town shares the exact same recurring nightmare.",
            "A famous painting is stolen from a heavily guarded museum, but the thief leaves a forgery that is actually better than the original."
        ],
        romance: [
            "Two rival authors are forced to collaborate on a novel.",
            "You accidentally send a love letter to your boss instead of your crush.",
            "A wedding planner falls for the groom of the wedding she is organizing.",
            "Two people who hate each other get stuck in an elevator for 24 hours."
        ],
        horror: [
            "You buy an old antique mirror. One day, your reflection blinks when you don't.",
            "You are home alone when you hear a knock on the door. You look through the peephole and see... yourself.",
            "Your child tells you about their imaginary friend. Then, you start seeing the friend too.",
            "You inherit an old house in the woods. Every night at midnight, the front door unlocks itself."
        ]
    };

    document.querySelectorAll('.genre-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.genre-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            selectedGenre = this.dataset.genre;
        });
    });

    $('prompt-generate').addEventListener('click', function() {
        let genre = selectedGenre;
        if (genre === 'any') {
            const keys = Object.keys(prompts);
            genre = keys[Math.floor(Math.random() * keys.length)];
        }

        const list = prompts[genre];
        const prompt = list[Math.floor(Math.random() * list.length)];

        $('prompt-text').textContent = prompt;
        $('prompt-badge').textContent = genre;

        $('prompt-output-card').classList.remove('d-none');
        $('prompt-output-card').classList.remove('animate__animated', 'animate__fadeIn');
        void $('prompt-output-card').offsetWidth;
        $('prompt-output-card').classList.add('animate__animated', 'animate__fadeIn');
        
        $('prompt-output-card').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\writing-prompt-generator.blade.php ENDPATH**/ ?>