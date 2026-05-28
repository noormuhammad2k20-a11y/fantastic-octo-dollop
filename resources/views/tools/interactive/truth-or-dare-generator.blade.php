<div class="row g-4 tod-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body text-center">
                <div class="mb-4 d-flex justify-content-center gap-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tod-rating" id="rating-clean" value="clean" checked>
                        <label class="form-check-label fw-bold" for="rating-clean">Clean / Kids</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tod-rating" id="rating-teen" value="teen">
                        <label class="form-check-label fw-bold text-warning" for="rating-teen">Teen / Edgy</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tod-rating" id="rating-adult" value="adult">
                        <label class="form-check-label fw-bold text-danger" for="rating-adult">Adult (18+)</label>
                    </div>
                </div>

                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                    <button class="btn btn-primary py-3 px-4 fw-black fs-5 rounded-pill action-btn flex-grow-1 flex-sm-grow-0 shadow-sm" id="btn-truth" style="min-width: 280px; max-width: 100%; background:#3b82f6; border:none; min-width: 160px; letter-spacing: 1px;">TRUTH</button>
                    <button class="btn btn-dark py-3 px-4 fw-black fs-5 rounded-pill action-btn flex-grow-1 flex-sm-grow-0 shadow-sm" id="btn-random" style="min-width: 280px; max-width: 100%; min-width: 120px;" title="Random Choice"><i class="fas fa-dice fs-4"></i></button>
                    <button class="btn btn-danger py-3 px-4 fw-black fs-5 rounded-pill action-btn flex-grow-1 flex-sm-grow-0 shadow-sm" id="btn-dare" style="min-width: 280px; max-width: 100%; background:#ef4444; border:none; min-width: 160px; letter-spacing: 1px;">DARE</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none text-center" id="tod-output-card" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04); padding: 4rem 2rem;">
            <div id="tod-badge" class="badge rounded-pill mb-4 fs-6 px-4 py-2">TRUTH</div>
            <h1 id="tod-prompt" class="fw-black" style="color:#831843; font-size: 2.5rem; line-height: 1.3;">What is your biggest fear?</h1>
        </div>
    </div>
</div>

<style>
.tod-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.tod-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.tod-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.tod-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.tod-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}

.action-btn { transition: transform 0.1s; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
.action-btn:active { transform: scale(0.95); }

.badge-truth { background: #3b82f6; color: white; }
.badge-dare { background: #ef4444; color: white; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const prompts = {
        clean: {
            t: [
                "What is your biggest fear?", "What is your favorite movie?", "Have you ever cheated on a test?",
                "What's the most embarrassing thing you've ever done?", "Who is your secret crush?", 
                "What is your weirdest habit?", "If you could have one superpower, what would it be?"
            ],
            d: [
                "Do 10 pushups.", "Sing the alphabet backwards.", "Let someone draw on your face with a pen.",
                "Speak in an accent for the next 3 rounds.", "Try to lick your elbow.",
                "Do your best dance move right now.", "Eat a spoonful of mustard."
            ]
        },
        teen: {
            t: [
                "Have you ever lied to your parents about where you were?", "Who do you think is the best looking person in this room?",
                "What's the worst rumor you've ever heard about yourself?", "Have you ever snuck out of the house?",
                "What is the most illegal thing you've ever done?"
            ],
            d: [
                "Let someone read your last 3 text messages out loud.", "Post a completely random photo on your social media right now.",
                "Call a random contact in your phone and sing them happy birthday.", "Eat a piece of raw onion.",
                "Let the group give you a new hairstyle."
            ]
        },
        adult: {
            t: [
                "What's your biggest regret in life?", "What is a secret you've never told anyone?",
                "Have you ever stolen anything?", "What is the most inappropriate time you've ever laughed?",
                "If you had to date one person in this room, who would it be?"
            ],
            d: [
                "Show everyone your screen time stats.", "Let the person to your left text anyone from your phone.",
                "Take a shot of a condiment of the group's choosing.", "Empty your wallet/purse and show everyone what's inside.",
                "Tell us the story of your worst date."
            ]
        }
    };

    function showPrompt(type) {
        const rating = document.querySelector('input[name="tod-rating"]:checked').value;
        const list = prompts[rating][type];
        const item = list[Math.floor(Math.random() * list.length)];

        const badge = $('tod-badge');
        badge.textContent = type === 't' ? 'TRUTH' : 'DARE';
        badge.className = 'badge rounded-pill mb-4 fs-6 px-4 py-2 ' + (type === 't' ? 'badge-truth' : 'badge-dare');

        $('tod-prompt').textContent = item;

        $('tod-output-card').classList.remove('d-none');
        $('tod-output-card').classList.remove('animate__animated', 'animate__flipInX');
        void $('tod-output-card').offsetWidth;
        $('tod-output-card').classList.add('animate__animated', 'animate__flipInX');
        
        $('tod-output-card').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    $('btn-truth').addEventListener('click', () => showPrompt('t'));
    $('btn-dare').addEventListener('click', () => showPrompt('d'));
    $('btn-random').addEventListener('click', () => {
        showPrompt(Math.random() > 0.5 ? 't' : 'd');
    });
});
</script>

