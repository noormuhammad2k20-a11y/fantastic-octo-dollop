<div class="row g-4 magic-8-ball-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Ask Your Question</label>
                    <input type="text" id="m8-question" class="form-control form-control-lg" placeholder="Will I win the lottery today?">
                </div>
                <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="m8-shake" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-hand-sparkles me-2"></i>Shake the Ball
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:220;--tool-color:#1e293b;--tool-bg:rgba(15,23,42,.04);">
            <div class="m8-visual-container">
                <div class="m8-ball" id="m8-ball">
                    <div class="m8-window">
                        <div class="m8-triangle" id="m8-answer">ASK ME ANYTHING</div>
                    </div>
                </div>
            </div>

            <div class="output-hero mt-4">
                <span class="output-hero-label">The Oracle Says</span>
                <div class="output-hero-value fs-4" id="m8-text">-</div>
                <span class="output-hero-unit" id="m8-status">Focus on your question</span>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-history me-2 text-secondary"></i>Past Predictions</h6>
                <div id="m8-history" class="small text-muted d-flex flex-column gap-1">
                    <!-- History -->
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.magic-8-ball-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.magic-8-ball-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.magic-8-ball-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.magic-8-ball-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.magic-8-ball-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.magic-8-ball-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}

/* Magic 8 Ball Styling */
.m8-visual-container {
    height: 250px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.m8-ball {
    width: 200px;
    height: 200px;
    background: radial-gradient(circle at 60px 60px, #334155, #000);
    border-radius: 50%;
    position: relative;
    box-shadow: inset -20px -20px 40px rgba(0,0,0,0.5), 0 20px 30px rgba(0,0,0,0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.m8-window {
    width: 100px;
    height: 100px;
    background: #0f172a;
    border: 5px solid #1e293b;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    box-shadow: inset 0 0 20px rgba(0,0,0,0.8);
}

.m8-triangle {
    width: 80px;
    height: 80px;
    background: #1e3a8a;
    clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 15px;
    font-size: 0.6rem;
    font-weight: 800;
    color: #93c5fd;
    line-height: 1.2;
    transition: opacity 1.5s ease;
}

.shaking {
    animation: m8-shake 0.5s infinite;
}

@keyframes m8-shake {
    0% { transform: translate(0,0) rotate(0); }
    25% { transform: translate(5px, 5px) rotate(5deg); }
    50% { transform: translate(-5px, -5px) rotate(-5deg); }
    75% { transform: translate(5px, -5px) rotate(5deg); }
    100% { transform: translate(0,0) rotate(0); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const answers = [
        "It is certain", "It is decidedly so", "Without a doubt", "Yes definitely", "You may rely on it",
        "As I see it, yes", "Most likely", "Outlook good", "Yes", "Signs point to yes",
        "Reply hazy, try again", "Ask again later", "Better not tell you now", "Cannot predict now", "Concentrate and ask again",
        "Don't count on it", "My reply is no", "My sources say no", "Outlook not so good", "Very doubtful"
    ];

    $('m8-shake').addEventListener('click', shakeBall);
    $('m8-ball').addEventListener('click', shakeBall);

    function shakeBall() {
        const ball = $('m8-ball');
        const triangle = $('m8-answer');
        const textDisplay = $('m8-text');
        const question = $('m8-question').value;
        
        ball.classList.add('shaking');
        triangle.style.opacity = '0';
        textDisplay.textContent = 'Thinking...';
        
        setTimeout(() => {
            ball.classList.remove('shaking');
            const result = answers[Math.floor(Math.random() * answers.length)];
            triangle.textContent = result.toUpperCase();
            triangle.style.opacity = '1';
            textDisplay.textContent = result;
            $('m8-status').textContent = "The Oracle has spoken";
            
            if (question) {
                const history = $('m8-history');
                const item = document.createElement('div');
                item.innerHTML = `<strong>Q:</strong> ${question} <br> <strong>A:</strong> ${result}`;
                item.className = 'mb-2 p-2 bg-light rounded';
                history.prepend(item);
            }
        }, 1500);
    }
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\magic-8-ball.blade.php ENDPATH**/ ?>