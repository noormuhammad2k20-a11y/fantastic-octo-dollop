<div class="row g-4 emoji-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Quantity</label>
                        <select id="emoji-count" class="form-select form-select-lg">
                            <option value="1">1 Emoji</option>
                            <option value="3" selected>3 Emojis</option>
                            <option value="5">5 Emojis</option>
                            <option value="10">10 Emojis</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Category</label>
                        <select id="emoji-cat" class="form-select form-select-lg">
                            <option value="any" selected>All Categories</option>
                            <option value="smileys">Smileys & Emotion</option>
                            <option value="animals">Animals & Nature</option>
                            <option value="food">Food & Drink</option>
                            <option value="objects">Objects & Symbols</option>
                        </select>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-warning fw-bold text-dark fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="emoji-generate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-magic me-2"></i>Generate Emojis
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none text-center" id="emoji-output-card" style="--tool-hue:45;--tool-color:#ca8a04;--tool-bg:rgba(234,179,8,.04); border-color:#fde047; padding: 4rem 2rem;">
            <div id="emoji-display" class="d-flex flex-wrap justify-content-center gap-3 mb-4" style="font-size: 4rem; line-height: 1;">
                <!-- Emojis injected here -->
            </div>
            <button class="btn btn-outline-dark rounded-pill px-4 mt-2" id="copy-emoji" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Emojis</button>
        </div>
    </div>
</div>

<style>
.emoji-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.emoji-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.emoji-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.emoji-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.emoji-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.emoji-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.4rem;}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const db = {
        smileys: ['😀','😂','😍','😎','🤔','😴','😭','😡','🤯','🥳','🥶','🥵','🤫','🤪','😇','🤩','🤑','🤒','🤮','🤠'],
        animals: ['🐶','🐱','🐭','🐹','🐰','🦊','🐻','🐼','🐨','🐯','🦁','🐮','🐷','🐸','🐵','🐔','🐧','🐦','🐤','🐺'],
        food: ['🍏','🍎','🍐','🍊','🍋','🍌','🍉','🍇','🍓','🍈','🍒','🍑','🥭','🍍','🥥','🥝','🍅','🍆','🥑','🥦','🍕','🍔','🍟','🌭','🍿'],
        objects: ['⌚️','📱','💻','⌨️','🖥','🖨','🖱','🖲','🕹','🗜','💽','💾','💿','📀','📼','📷','📸','📹','🎥','📽']
    };

    $('emoji-generate').addEventListener('click', function() {
        const count = parseInt($('emoji-count').value);
        const cat = $('emoji-cat').value;

        let pool = [];
        if (cat === 'any') {
            Object.values(db).forEach(arr => pool = pool.concat(arr));
        } else {
            pool = [...db[cat]];
        }

        const selected = [];
        for (let i = 0; i < count; i++) {
            selected.push(pool[Math.floor(Math.random() * pool.length)]);
        }

        const container = $('emoji-display');
        container.innerHTML = '';
        container.dataset.raw = selected.join('');

        selected.forEach(em => {
            container.innerHTML += `<span class="animate__animated animate__tada">${em}</span>`;
        });

        $('emoji-output-card').classList.remove('d-none');
        $('emoji-output-card').scrollIntoView({ behavior: 'smooth' });
    });

    $('copy-emoji').addEventListener('click', function() {
        const data = $('emoji-display').dataset.raw;
        navigator.clipboard.writeText(data).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });
});
</script>

