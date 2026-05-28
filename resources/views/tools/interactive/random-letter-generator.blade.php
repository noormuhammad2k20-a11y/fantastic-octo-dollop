<div class="row g-4 random-letter-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Alphabet</label>
                        <select id="letter-alphabet" class="form-select form-select-lg">
                            <option value="english" selected>English (A-Z)</option>
                            <option value="greek">Greek (α-ω)</option>
                            <option value="russian">Russian (а-я)</option>
                            <option value="numbers">Digits (0-9)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Letter Case</label>
                        <select id="letter-case" class="form-select form-select-lg">
                            <option value="upper">Uppercase (ABC)</option>
                            <option value="lower">Lowercase (abc)</option>
                            <option value="mixed">Mixed (aBc)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Number of Letters</label>
                        <input type="number" id="letter-count" class="form-control form-control-lg" value="1" min="1" max="1000">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Separator</label>
                        <select id="letter-sep" class="form-select form-select-lg">
                            <option value="none">None (abc)</option>
                            <option value="space">Space (a b c)</option>
                            <option value="comma">Comma (a, b, c)</option>
                            <option value="newline">New Line</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-success py-3 px-5 fw-bold rounded-pill shadow-sm" id="generate-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-magic me-2"></i>Generate Random Letters
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="letter-output-card" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Primary Result</span>
                <div class="output-hero-value fs-1" id="primary-letter">-</div>
                <span class="output-hero-unit" id="alphabet-label">English Alphabet</span>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-list me-2 text-primary"></i>All Generated Letters</h6>
                <div id="results-display" class="p-3 bg-white border rounded-3 fs-4 fw-bold text-center break-all">
                    <!-- Results here -->
                </div>
            </div>
            
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-dark flex-grow-1 py-3 fw-bold rounded-3" id="copy-all" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy All
                </button>
                <button class="btn btn-outline-dark px-4 py-3 fw-bold rounded-3" id="clear-all" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.random-letter-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.random-letter-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.random-letter-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.random-letter-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.random-letter-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.random-letter-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.break-all { word-break: break-all; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    const alphabets = {
        english: "abcdefghijklmnopqrstuvwxyz",
        greek: "αβγδεζηθικλμνξοπρστυφχψω",
        russian: "абвгдеёжзийклмнопрстуфхцчшщъыьэюя",
        numbers: "0123456789"
    };

    $('generate-btn').addEventListener('click', generateLetters);
    $('clear-all').addEventListener('click', () => $('letter-output-card').classList.add('d-none'));

    function generateLetters() {
        const alphabetKey = $('letter-alphabet').value;
        const caseMode = $('letter-case').value;
        const count = parseInt($('letter-count').value) || 1;
        const sep = $('letter-sep').value;
        
        let source = alphabets[alphabetKey];
        const results = [];

        for (let i = 0; i < count; i++) {
            let char = source[Math.floor(Math.random() * source.length)];
            
            if (alphabetKey !== 'numbers') {
                if (caseMode === 'upper') char = char.toUpperCase();
                else if (caseMode === 'mixed') char = Math.random() < 0.5 ? char.toUpperCase() : char.toLowerCase();
            }
            
            results.push(char);
        }

        $('primary-letter').textContent = results[0];
        $('alphabet-label').textContent = $('letter-alphabet').options[$('letter-alphabet').selectedIndex].text;
        
        let displayStr = "";
        if (sep === 'space') displayStr = results.join(' ');
        else if (sep === 'comma') displayStr = results.join(', ');
        else if (sep === 'newline') displayStr = results.join('<br>');
        else displayStr = results.join('');

        $('results-display').innerHTML = displayStr;
        $('letter-output-card').classList.remove('d-none');
        $('letter-output-card').scrollIntoView({ behavior: 'smooth' });
    }

    $('copy-all').addEventListener('click', function() {
        const text = $('results-display').innerText;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });
});
</script>

