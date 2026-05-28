<div class="row g-4 quote-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body text-center">
                <div class="mb-4 d-flex justify-content-center gap-3 flex-wrap" id="quote-categories">
                    <button class="btn btn-outline-primary active cat-btn" data-cat="any">Any Quote</button>
                    <button class="btn btn-outline-primary cat-btn" data-cat="inspirational">Inspirational</button>
                    <button class="btn btn-outline-primary cat-btn" data-cat="tech">Technology</button>
                    <button class="btn btn-outline-primary cat-btn" data-cat="wisdom">Wisdom</button>
                </div>

                <button class="btn btn-primary py-3 px-5 fw-bold rounded-pill fs-4" id="quote-generate" style="min-width: 280px; max-width: 100%; background:#8b5cf6; border:none; box-shadow: 0 4px 15px rgba(139,92,246,.3);">
                    <i class="fas fa-lightbulb me-2"></i>Inspire Me
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none text-center" id="quote-output-card" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04); border-color:#ddd6fe; padding: 4rem 3rem;">
            
            <i class="fas fa-quote-left mb-4" style="font-size: 3rem; color: rgba(139,92,246,0.2);"></i>
            
            <h2 id="quote-text" class="fw-bold text-dark mb-4" style="line-height: 1.5; font-family: Georgia, serif;">"The only way to do great work is to love what you do."</h2>
            
            <h5 id="quote-author" class="text-muted fw-bold text-uppercase" style="letter-spacing: 2px;">— Steve Jobs</h5>
            
            <div class="mt-4 pt-3">
                <button class="btn btn-sm btn-outline-primary rounded-pill px-3" id="copy-quote" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i>Copy Quote</button>
            </div>
        </div>
    </div>
</div>

<style>
.quote-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.quote-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.quote-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.quote-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.quote-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}

.btn-outline-primary {
    color: #8b5cf6;
    border-color: #ddd6fe;
    font-weight: 600;
}
.btn-outline-primary:hover, .btn-outline-primary.active {
    background: #8b5cf6;
    color: #fff;
    border-color: #8b5cf6;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let selectedCat = 'any';

    const db = {
        inspirational: [
            { q: "The only way to do great work is to love what you do.", a: "Steve Jobs" },
            { q: "Believe you can and you're halfway there.", a: "Theodore Roosevelt" },
            { q: "It does not matter how slowly you go as long as you do not stop.", a: "Confucius" },
            { q: "Everything you've ever wanted is on the other side of fear.", a: "George Addair" },
            { q: "Success is not final, failure is not fatal: it is the courage to continue that counts.", a: "Winston Churchill" }
        ],
        tech: [
            { q: "Any fool can write code that a computer can understand. Good programmers write code that humans can understand.", a: "Martin Fowler" },
            { q: "First, solve the problem. Then, write the code.", a: "John Johnson" },
            { q: "Experience is the name everyone gives to their mistakes.", a: "Oscar Wilde" },
            { q: "It's not a bug. It's an undocumented feature!", a: "Anonymous" },
            { q: "Software is a great combination between artistry and engineering.", a: "Bill Gates" }
        ],
        wisdom: [
            { q: "The journey of a thousand miles begins with one step.", a: "Lao Tzu" },
            { q: "In the middle of difficulty lies opportunity.", a: "Albert Einstein" },
            { q: "Life is what happens when you're busy making other plans.", a: "John Lennon" },
            { q: "The only true wisdom is in knowing you know nothing.", a: "Socrates" },
            { q: "Turn your wounds into wisdom.", a: "Oprah Winfrey" }
        ]
    };

    document.querySelectorAll('.cat-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            selectedCat = this.dataset.cat;
        });
    });

    $('quote-generate').addEventListener('click', function() {
        let cat = selectedCat;
        if (cat === 'any') {
            const keys = Object.keys(db);
            cat = keys[Math.floor(Math.random() * keys.length)];
        }

        const list = db[cat];
        const quote = list[Math.floor(Math.random() * list.length)];

        $('quote-text').textContent = `"${quote.q}"`;
        $('quote-author').textContent = `— ${quote.a}`;

        $('quote-output-card').classList.remove('d-none');
        $('quote-output-card').classList.remove('animate__animated', 'animate__fadeIn');
        void $('quote-output-card').offsetWidth;
        $('quote-output-card').classList.add('animate__animated', 'animate__fadeIn');
        
        $('quote-output-card').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });

    $('copy-quote').addEventListener('click', function() {
        const text = `${$('quote-text').textContent} ${$('quote-author').textContent}`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });
});
</script>

