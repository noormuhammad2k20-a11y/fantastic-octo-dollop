<div class="row g-4">
    {{-- Input Card --}}
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body text-center">
                <div class="mb-4">
                    <input type="text" id="input-headline" class="form-control form-control-lg rounded-4 py-3 px-4 border-2" placeholder="e.g. How to Build a Premium SaaS Platform in 2024...">
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <button class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm transition-all" id="btn-analyze" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-chart-line me-2"></i> Run Deep Analysis
                    </button>
                    <button class="btn btn-light-custom btn-lg px-4 rounded-pill" id="btn-clear" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-trash-alt me-1"></i> Clear
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Analysis Results --}}
    <div class="col-lg-12 d-none" id="results-container">
        <div class="row g-4 mb-4">
            <div class="col-lg-4">
                <div class="output-card-themed h-100 text-center py-5" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,0.04);">
                    <div class="score-circle mx-auto mb-3" id="score-val">0</div>
                    <h6 class="fw-bold text-secondary text-uppercase letter-spacing-1 small">Overall Impact Score</h6>
                    <div class="mt-2 fw-bold fs-5" id="score-label">Calculating...</div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 h-100 rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-bottom py-3 px-4">
                        <h6 class="mb-0 fw-bold text-dark">Data Metrics Breakdown</h6>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                                <div>
                                    <span class="fw-bold d-block text-dark">Character Count</span>
                                    <small class="text-muted">Optimal: 50-60 chars for SEO</small>
                                </div>
                                <span class="badge rounded-pill bg-primary px-3 py-2" id="res-chars">0</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                                <div>
                                    <span class="fw-bold d-block text-dark">Word Count</span>
                                    <small class="text-muted">Optimal: 6-10 words for reading</small>
                                </div>
                                <span class="badge rounded-pill bg-success px-3 py-2" id="res-words">0</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                                <div>
                                    <span class="fw-bold d-block text-dark">Power Word Ratio</span>
                                    <small class="text-muted">High-impact curiosity triggers</small>
                                </div>
                                <span class="badge rounded-pill bg-warning text-dark px-3 py-2" id="res-power">0</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Suggestions --}}
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-bottom py-3 px-4 d-flex align-items-center">
                <i class="fas fa-lightbulb text-warning me-2"></i>
                <h6 class="mb-0 fw-bold text-dark">Optimization Strategy & Tips</h6>
            </div>
            <div class="card-body p-4">
                <div id="tips-list" class="row g-3">
                    {{-- Tips injected here --}}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2rem; }
.calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2rem; }
.calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.02em; }
.calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; flex-shrink: 0; }
.form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; display: block; }
.btn-light-custom { background: #f1f5f9; border: none; color: #475569; font-weight: 600; border-radius: 10px; }
.btn-light-custom:hover { background: #e2e8f0; color: #1e293b; }
.output-card-themed { background: var(--tool-bg); border: 1px solid rgba(79,70,229,0.1); border-radius: 24px; padding: 2rem; }
.score-circle { width: 120px; height: 120px; border-radius: 50%; border: 10px solid #4f46e5; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: 900; color: #1e293b; transition: all 0.5s ease; }
.tip-box { padding: 1.25rem; border-radius: 16px; background: #f8fafc; border-left: 4px solid #4f46e5; height: 100%; transition: all 0.3s; }
.tip-box:hover { background: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.05); transform: translateX(5px); }
.letter-spacing-1 { letter-spacing: 1px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-headline');
    const btnAnalyze = document.getElementById('btn-analyze');
    const results = document.getElementById('results-container');
    const scoreVal = document.getElementById('score-val');
    const scoreLabel = document.getElementById('score-label');
    const resChars = document.getElementById('res-chars');
    const resWords = document.getElementById('res-words');
    const resPower = document.getElementById('res-power');
    const tipsList = document.getElementById('tips-list');
    const btnClear = document.getElementById('btn-clear');

    const powerWords = ['best', 'free', 'new', 'secret', 'how', 'why', 'easy', 'fast', 'amazing', 'huge', 'proven', 'limited', 'ultimate', 'guaranteed', 'modern', 'premium', 'breakthrough', 'instant'];

    function analyze() {
        const headline = input.value.trim();
        if (!headline) return;

        btnAnalyze.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing...';
        btnAnalyze.disabled = true;

        setTimeout(() => {
            const chars = headline.length;
            const wordArr = headline.split(/\s+/).filter(w => w.length > 0);
            const words = wordArr.length;
            const wordsList = headline.toLowerCase().split(/[^a-z0-9]+/);
            const foundPower = wordsList.filter(w => powerWords.includes(w)).length;

            let score = 40; 
            if (chars >= 50 && chars <= 65) score += 25;
            else if (chars > 30 && chars < 85) score += 15;
            
            if (words >= 6 && words <= 10) score += 20;
            score += (foundPower * 10);
            score = Math.min(score, 100);

            scoreVal.textContent = score;
            resChars.textContent = chars;
            resWords.textContent = words;
            resPower.textContent = foundPower;

            let label = "Needs Work";
            let color = "#ef4444";
            if (score >= 80) { label = "Excellent & Viral"; color = "#10b981"; }
            else if (score >= 60) { label = "Good Impact"; color = "#4f46e5"; }
            else if (score >= 40) { label = "Fair Potential"; color = "#f59e0b"; }

            scoreLabel.textContent = label;
            scoreLabel.style.color = color;
            scoreVal.style.borderColor = color;

            let tips = [];
            if (chars < 45) tips.push("Your headline is a bit short. Add more descriptive context for better SEO visibility.");
            if (chars > 75) tips.push("This headline may be truncated in search results. Keep it between 50-70 characters.");
            if (foundPower === 0) tips.push("Incorporate power words like 'Proven', 'Ultimate', or 'Guaranteed' to drive more clicks.");
            if (words < 5) tips.push("Headlines with 6-10 words usually perform better in capturing human attention.");
            if (headline === headline.toUpperCase()) tips.push("Avoid all-caps headlines. It reduces trust and can feel aggressive to readers.");

            if (tips.length === 0) tips.push("Excellent work! This headline is well-optimized for both search engines and human interest.");

            tipsList.innerHTML = tips.map(t => `
                <div class="col-md-6">
                    <div class="tip-box">
                        <p class="small mb-0 text-muted fw-bold"><i class="fas fa-check-circle text-success me-2"></i>${t}</p>
                    </div>
                </div>
            `).join('');

            results.classList.remove('d-none');
            btnAnalyze.innerHTML = '<i class="fas fa-chart-line me-2"></i> Run Deep Analysis';
            btnAnalyze.disabled = false;
            
            results.classList.add('animate__animated', 'animate__fadeInUp');
            results.scrollIntoView({ behavior: 'smooth' });
        }, 600);
    }

    btnAnalyze.addEventListener('click', analyze);
    input.addEventListener('keypress', (e) => { if (e.key === 'Enter') analyze(); });

    btnClear.addEventListener('click', () => {
        input.value = '';
        results.classList.add('d-none');
    });

    // Sample trigger
    input.value = "How to Create a Premium SaaS Dashboard with Modern Web Tools";
    analyze();
});
</script>

