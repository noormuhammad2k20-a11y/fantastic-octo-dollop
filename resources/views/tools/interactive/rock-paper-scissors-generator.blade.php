<div class="row g-4 rps-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body text-center">
                <ul class="nav nav-tabs justify-content-center mb-4" id="rps-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold" id="generate-tab" data-bs-toggle="tab" data-bs-target="#generate-pane" type="button" role="tab">Generate Throw</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold" id="play-tab" data-bs-toggle="tab" data-bs-target="#play-pane" type="button" role="tab">Play vs AI</button>
                    </li>
                </ul>

                <div class="tab-content" id="rps-tab-content">
                    <!-- Generator Mode -->
                    <div class="tab-pane fade show active" id="generate-pane" role="tabpanel">
                        <div class="mb-4">
                            <label class="form-label-custom">Game Mode</label>
                            <select id="rps-mode" class="form-select form-select-lg mx-auto" style="max-width: 300px;">
                                <option value="classic" selected>Classic (Rock, Paper, Scissors)</option>
                                <option value="extended">Extended (+ Lizard, Spock)</option>
                            </select>
                        </div>
                        <button class="btn btn-success py-3 px-5 fw-bold rounded-pill fs-4" id="rps-generate" style="min-width: 280px; max-width: 100%; background:#10b981; border:none; box-shadow: 0 4px 15px rgba(16,185,129,.3);">
                            <i class="fas fa-magic me-2"></i>Generate Random Throw
                        </button>
                    </div>
                    
                    <!-- Play Mode -->
                    <div class="tab-pane fade" id="play-pane" role="tabpanel">
                        <h5 class="fw-bold text-dark mb-4">Make Your Choice:</h5>
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <button class="btn btn-outline-dark rps-play-btn" data-choice="rock">
                                <i class="far fa-hand-rock d-block fs-1 mb-2"></i>Rock
                            </button>
                            <button class="btn btn-outline-dark rps-play-btn" data-choice="paper">
                                <i class="far fa-hand-paper d-block fs-1 mb-2"></i>Paper
                            </button>
                            <button class="btn btn-outline-dark rps-play-btn" data-choice="scissors">
                                <i class="far fa-hand-scissors d-block fs-1 mb-2"></i>Scissors
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none text-center" id="rps-output-card" style="--tool-hue:150;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04); border-color:#a7f3d0; padding: 3rem 2rem;">
            
            <div id="gen-output" class="d-none">
                <h5 class="text-muted text-uppercase fw-bold mb-3">Random Throw</h5>
                <div id="gen-icon" class="mb-3" style="font-size: 5rem; color: #10b981;"></div>
                <h1 id="gen-text" class="fw-black text-dark text-uppercase">ROCK</h1>
            </div>

            <div id="play-output" class="d-none">
                <div class="row align-items-center">
                    <div class="col-5">
                        <div class="small text-muted fw-bold text-uppercase mb-2">You</div>
                        <div id="play-user-icon" style="font-size: 4rem; color: #3b82f6;"></div>
                        <h4 id="play-user-text" class="fw-bold mt-2">ROCK</h4>
                    </div>
                    <div class="col-2">
                        <div class="fs-4 fw-black text-muted">VS</div>
                    </div>
                    <div class="col-5">
                        <div class="small text-muted fw-bold text-uppercase mb-2">AI</div>
                        <div id="play-ai-icon" style="font-size: 4rem; color: #ef4444;"></div>
                        <h4 id="play-ai-text" class="fw-bold mt-2">PAPER</h4>
                    </div>
                </div>
                
                <div class="mt-4 pt-4 border-top">
                    <h2 id="play-result" class="fw-black" style="letter-spacing: 2px;">YOU LOSE!</h2>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
.rps-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.rps-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.rps-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.rps-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.rps-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.rps-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;}

.rps-rebuilt .nav-tabs .nav-link { color: #64748b; border: none; padding: 1rem 1.5rem; }
.rps-rebuilt .nav-tabs .nav-link.active { background: transparent; border-bottom: 3px solid #10b981; color: #059669 !important; }

.rps-play-btn {
    width: 120px;
    height: 120px;
    border-radius: 16px;
    border: 2px solid #e2e8f0;
    transition: all 0.2s;
    background: #fff;
}
.rps-play-btn:hover {
    border-color: #10b981;
    color: #10b981;
    transform: translateY(-5px);
    box-shadow: 0 10px 15px -3px rgba(16,185,129,0.2);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const choices = {
        rock: { i: 'fa-hand-rock', w: ['scissors', 'lizard'] },
        paper: { i: 'fa-hand-paper', w: ['rock', 'spock'] },
        scissors: { i: 'fa-hand-scissors', w: ['paper', 'lizard'] },
        lizard: { i: 'fa-hand-lizard', w: ['paper', 'spock'] },
        spock: { i: 'fa-hand-spock', w: ['rock', 'scissors'] }
    };

    function showCard() {
        $('rps-output-card').classList.remove('d-none');
        $('rps-output-card').classList.remove('animate__animated', 'animate__bounceIn');
        void $('rps-output-card').offsetWidth;
        $('rps-output-card').classList.add('animate__animated', 'animate__bounceIn');
        $('rps-output-card').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    // Generator Mode
    $('rps-generate').addEventListener('click', function() {
        const mode = $('rps-mode').value;
        const pool = mode === 'classic' ? ['rock', 'paper', 'scissors'] : Object.keys(choices);
        
        const throwObj = pool[Math.floor(Math.random() * pool.length)];
        
        $('gen-output').classList.remove('d-none');
        $('play-output').classList.add('d-none');

        $('gen-text').textContent = throwObj;
        $('gen-icon').innerHTML = `<i class="far ${choices[throwObj].i}"></i>`;

        showCard();
    });

    // Play Mode
    document.querySelectorAll('.rps-play-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const user = this.dataset.choice;
            const pool = ['rock', 'paper', 'scissors'];
            const ai = pool[Math.floor(Math.random() * pool.length)];

            $('gen-output').classList.add('d-none');
            $('play-output').classList.remove('d-none');

            $('play-user-icon').innerHTML = `<i class="far ${choices[user].i}"></i>`;
            $('play-user-text').textContent = user.toUpperCase();
            
            $('play-ai-icon').innerHTML = `<i class="far ${choices[ai].i}"></i>`;
            $('play-ai-text').textContent = ai.toUpperCase();

            const resObj = $('play-result');
            if (user === ai) {
                resObj.textContent = "IT'S A TIE!";
                resObj.style.color = "#64748b";
            } else if (choices[user].w.includes(ai)) {
                resObj.textContent = "YOU WIN! 🎉";
                resObj.style.color = "#10b981";
            } else {
                resObj.textContent = "YOU LOSE! 💀";
                resObj.style.color = "#ef4444";
            }

            showCard();
        });
    });
});
</script>

