<div class="row g-4 chess-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Color to Play</label>
                        <select id="chess-color" class="form-select form-select-lg">
                            <option value="any" selected>Any Color</option>
                            <option value="white">White</option>
                            <option value="black">Black</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Difficulty Level</label>
                        <select id="chess-level" class="form-select form-select-lg">
                            <option value="any" selected>Any Level</option>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advanced">Advanced</option>
                        </select>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-dark fw-bold fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="chess-generate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-random me-2"></i>Generate Opening
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="chess-output-card" style="--tool-hue:215;--tool-color:#1e293b;--tool-bg:rgba(15,23,42,.04); border-color:#cbd5e1;">
            <div class="text-center mb-4">
                <div id="chess-color-icon" class="mb-2" style="font-size:3rem;line-height:1;"><i class="fas fa-chess-king text-dark"></i></div>
                <h2 id="chess-name" class="fw-black text-dark mb-1">Opening Name</h2>
                <span id="chess-eco" class="badge bg-secondary mb-3">ECO: A00</span>
                <p id="chess-desc" class="text-muted" style="max-width:600px;margin:0 auto;">Description here.</p>
            </div>

            <div class="bg-white border rounded-3 p-4 text-center">
                <div class="small text-muted fw-bold text-uppercase mb-2">First Moves</div>
                <div id="chess-moves" class="fs-3 fw-bold font-monospace text-primary" style="letter-spacing: 2px;">e4 e5 Nf3 Nc6</div>
            </div>
        </div>
    </div>
</div>

<style>
.chess-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.chess-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.chess-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.chess-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.chess-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.chess-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.4rem;}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const openings = [
        // White - Beginner
        { n: 'Italian Game', c: 'white', l: 'beginner', eco: 'C50', m: '1. e4 e5 2. Nf3 Nc6 3. Bc4', d: 'A classic opening that develops pieces quickly and controls the center. Great for learning basic tactical ideas.' },
        { n: 'Ruy Lopez', c: 'white', l: 'beginner', eco: 'C60', m: '1. e4 e5 2. Nf3 Nc6 3. Bb5', d: 'One of the oldest and most analyzed openings in chess, putting immediate pressure on Black\'s e5 pawn.' },
        { n: 'Queen\'s Gambit', c: 'white', l: 'beginner', eco: 'D06', m: '1. d4 d5 2. c4', d: 'White offers a pawn to gain control of the center. It leads to rich, positional play.' },
        // White - Intermediate
        { n: 'English Opening', c: 'white', l: 'intermediate', eco: 'A10', m: '1. c4', d: 'A flexible, flank opening that often transposes into d4 structures while avoiding many of Black\'s main defenses.' },
        { n: 'Vienna Game', c: 'white', l: 'intermediate', eco: 'C25', m: '1. e4 e5 2. Nc3', d: 'White develops a knight to control the center without blocking the f-pawn, keeping attacking options open.' },
        { n: 'King\'s Gambit', c: 'white', l: 'intermediate', eco: 'C30', m: '1. e4 e5 2. f4', d: 'An aggressive, romantic opening where White sacrifices a pawn to open the f-file and attack the black king.' },
        // White - Advanced
        { n: 'Catalan Opening', c: 'white', l: 'advanced', eco: 'E00', m: '1. d4 d5 2. c4 e6 3. g3', d: 'A highly sophisticated opening combining the Queen\'s Gambit with a kingside fianchetto.' },
        { n: 'Reti Opening', c: 'white', l: 'advanced', eco: 'A04', m: '1. Nf3', d: 'A hypermodern opening that controls the center with pieces rather than pawns from move one.' },
        
        // Black - Beginner
        { n: 'Sicilian Defense', c: 'black', l: 'beginner', eco: 'B20', m: '1. e4 c5', d: 'The most popular and best-scoring response to e4, leading to asymmetrical, fighting positions.' },
        { n: 'French Defense', c: 'black', l: 'beginner', eco: 'C00', m: '1. e4 e6', d: 'A solid, resilient defense that often leads to closed center structures and counterattacks on the queenside.' },
        { n: 'Caro-Kann Defense', c: 'black', l: 'beginner', eco: 'B10', m: '1. e4 c6', d: 'Similar to the French but often allows the light-squared bishop out before closing the structure.' },
        // Black - Intermediate
        { n: 'King\'s Indian Defense', c: 'black', l: 'intermediate', eco: 'E60', m: '1. d4 Nf6 2. c4 g6 3. Nc3 Bg7', d: 'A hypermodern defense where Black allows White a broad pawn center and then attacks it later.' },
        { n: 'Nimzo-Indian Defense', c: 'black', l: 'intermediate', eco: 'E20', m: '1. d4 Nf6 2. c4 e6 3. Nc3 Bb4', d: 'One of the most respected defenses against 1.d4, aiming to control the center with pieces and pin the white knight.' },
        { n: 'Scandinavian Defense', c: 'black', l: 'intermediate', eco: 'B01', m: '1. e4 d5', d: 'Black immediately challenges the center, forcing White to resolve the tension on move 2.' },
        // Black - Advanced
        { n: 'Grünfeld Defense', c: 'black', l: 'advanced', eco: 'D80', m: '1. d4 Nf6 2. c4 g6 3. Nc3 d5', d: 'A sharp hypermodern defense where Black actively fights for the center and creates dynamic imbalances.' },
        { n: 'Pirc Defense', c: 'black', l: 'advanced', eco: 'B07', m: '1. e4 d6 2. d4 Nf6 3. Nc3 g6', d: 'A flexible setup allowing White to build a pawn center, which Black then aims to undermine.' }
    ];

    $('chess-generate').addEventListener('click', function() {
        const color = $('chess-color').value;
        const lvl = $('chess-level').value;

        let filtered = openings;
        if (color !== 'any') filtered = filtered.filter(o => o.c === color);
        if (lvl !== 'any') filtered = filtered.filter(o => o.l === lvl);

        if (filtered.length === 0) {
            // Fallback if combination doesn't exist (though it should)
            filtered = openings;
        }

        const op = filtered[Math.floor(Math.random() * filtered.length)];

        $('chess-name').textContent = op.n;
        $('chess-eco').textContent = `ECO: ${op.eco}`;
        $('chess-desc').textContent = op.d;
        $('chess-moves').textContent = op.m;

        if (op.c === 'white') {
            $('chess-color-icon').innerHTML = '<i class="fas fa-chess-king text-dark"></i>';
        } else {
            $('chess-color-icon').innerHTML = '<i class="fas fa-chess-king text-dark" style="opacity: 0.7;"></i>'; // Representing black piece
        }

        $('chess-output-card').classList.remove('d-none');
        
        $('chess-output-card').classList.remove('animate__animated', 'animate__zoomIn');
        void $('chess-output-card').offsetWidth; // trigger reflow
        $('chess-output-card').classList.add('animate__animated', 'animate__zoomIn');
        
        $('chess-output-card').scrollIntoView({ behavior: 'smooth' });
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\chess-opening-generator.blade.php ENDPATH**/ ?>