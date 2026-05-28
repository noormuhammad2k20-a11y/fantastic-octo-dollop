<div class="row g-4 word-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Quantity</label>
                        <select id="word-count" class="form-select form-select-lg">
                            <option value="1">1 Word</option>
                            <option value="5" selected>5 Words</option>
                            <option value="10">10 Words</option>
                            <option value="20">20 Words</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Word Type</label>
                        <select id="word-type" class="form-select form-select-lg">
                            <option value="any" selected>Any (Mix)</option>
                            <option value="nouns">Nouns</option>
                            <option value="verbs">Verbs</option>
                            <option value="adjectives">Adjectives</option>
                        </select>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-primary fw-bold fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="word-generate" style="min-width: 280px; max-width: 100%; background:#2563eb; border:none;">
                    <i class="fas fa-random me-2"></i>Generate Words
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none text-center" id="word-output-card" style="--tool-hue:210;--tool-color:#1d4ed8;--tool-bg:rgba(59,130,246,.04); border-color:#bfdbfe; padding: 3rem 2rem;">
            <div id="word-display" class="d-flex flex-wrap justify-content-center gap-3 mb-4">
                <!-- Words injected here -->
            </div>
            <button class="btn btn-outline-primary rounded-pill px-4" id="copy-words" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Words</button>
        </div>
    </div>
</div>

<style>
.word-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.word-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.word-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.word-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.word-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.word-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.4rem;}

.word-badge {
    font-size: 1.5rem;
    padding: 0.75rem 1.5rem;
    background: #fff;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    color: #1e293b;
    font-weight: 800;
    text-transform: lowercase;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const db = {
        nouns: ['apple', 'book', 'car', 'dog', 'elephant', 'flower', 'guitar', 'house', 'island', 'jacket', 'kite', 'lion', 'mountain', 'notebook', 'ocean', 'piano', 'queen', 'river', 'sun', 'tree', 'umbrella', 'village', 'window', 'xylophone', 'yacht', 'zebra', 'computer', 'bottle', 'phone', 'coffee'],
        verbs: ['run', 'jump', 'swim', 'read', 'write', 'sing', 'dance', 'fly', 'drive', 'sleep', 'eat', 'drink', 'laugh', 'cry', 'think', 'play', 'work', 'study', 'build', 'paint', 'travel', 'explore', 'discover', 'create', 'solve', 'teach', 'learn', 'listen', 'speak', 'watch'],
        adjectives: ['happy', 'sad', 'fast', 'slow', 'big', 'small', 'tall', 'short', 'hot', 'cold', 'beautiful', 'ugly', 'smart', 'dumb', 'brave', 'cowardly', 'strong', 'weak', 'rich', 'poor', 'loud', 'quiet', 'bright', 'dark', 'soft', 'hard', 'smooth', 'rough', 'clean', 'dirty']
    };

    $('word-generate').addEventListener('click', function() {
        const count = parseInt($('word-count').value);
        const type = $('word-type').value;

        let pool = [];
        if (type === 'any') {
            pool = [...db.nouns, ...db.verbs, ...db.adjectives];
        } else {
            pool = [...db[type]];
        }

        // Shuffle
        for (let i = pool.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [pool[i], pool[j]] = [pool[j], pool[i]];
        }

        const selected = pool.slice(0, count);
        
        const container = $('word-display');
        container.innerHTML = '';
        container.dataset.raw = selected.join(', ');

        selected.forEach(word => {
            container.innerHTML += `<div class="word-badge animate__animated animate__zoomIn">${word}</div>`;
        });

        $('word-output-card').classList.remove('d-none');
        $('word-output-card').scrollIntoView({ behavior: 'smooth' });
    });

    $('copy-words').addEventListener('click', function() {
        const data = $('word-display').dataset.raw;
        navigator.clipboard.writeText(data).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });
});
</script>

