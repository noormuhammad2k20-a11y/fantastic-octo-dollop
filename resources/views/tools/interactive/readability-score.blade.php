<div class="row g-4">
    {{-- Input Card --}}
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label-custom mb-0">Article or Copy Text</label>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light-custom" id="btn-sample" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-vial me-1"></i> Sample
                            </button>
                            <button class="btn btn-sm btn-light-custom" id="btn-clear" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-trash-alt me-1"></i> Clear
                            </button>
                        </div>
                    </div>
                    <textarea id="text-input" class="form-control tool-textarea" rows="10" placeholder="Paste your content here for instant analysis..."></textarea>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm transition-all" id="btn-analyze" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-chart-line me-2"></i> Run Readability Analysis
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Results Container --}}
    <div class="col-lg-12 d-none" id="results-container">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="row g-0">
                    {{-- Score Panel --}}
                    <div class="col-md-4 text-white p-5 d-flex flex-column align-items-center justify-content-center text-center" style="background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);">
                        <h6 class="text-uppercase small fw-bold mb-3 opacity-75 letter-spacing-1">Flesch Reading Ease</h6>
                        <h1 class="display-1 fw-bold mb-2" id="score-val">0</h1>
                        <div class="badge rounded-pill bg-white text-primary px-4 py-2 fw-bold fs-6 shadow-sm" id="score-label">Standard</div>
                    </div>
                    
                    {{-- Metrics Panel --}}
                    <div class="col-md-8 p-5 bg-white">
                        <div class="row g-4 mb-5">
                            <div class="col-sm-4">
                                <div class="p-3 rounded-4 bg-light border text-center shadow-sm h-100">
                                    <h3 class="fw-bold text-dark mb-1" id="res-grade">8th</h3>
                                    <p class="text-muted small mb-0 text-uppercase fw-bold letter-spacing-1">Grade Level</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="p-3 rounded-4 bg-light border text-center shadow-sm h-100">
                                    <h3 class="fw-bold text-dark mb-1" id="res-time">0m</h3>
                                    <p class="text-muted small mb-0 text-uppercase fw-bold letter-spacing-1">Reading Time</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="p-3 rounded-4 bg-light border text-center shadow-sm h-100">
                                    <h3 class="fw-bold text-dark mb-1" id="res-complex">0%</h3>
                                    <p class="text-muted small mb-0 text-uppercase fw-bold letter-spacing-1">Complex Words</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4 rounded-4" style="background:#f8fafc; border:1px solid #e2e8f0;">
                            <h6 class="fw-bold text-dark mb-4 small text-uppercase letter-spacing-1 d-flex align-items-center">
                                <i class="fas fa-database me-2 text-primary"></i> Detailed Composition
                            </h6>
                            <div class="row g-3">
                                <div class="col-6 col-md-3">
                                    <div class="small text-muted mb-1">Words</div>
                                    <div class="fw-bold text-dark fs-5" id="res-words">0</div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="small text-muted mb-1">Sentences</div>
                                    <div class="fw-bold text-dark fs-5" id="res-sentences">0</div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="small text-muted mb-1">Syllables</div>
                                    <div class="fw-bold text-dark fs-5" id="res-syllables">0</div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="small text-muted mb-1">Characters</div>
                                    <div class="fw-bold text-dark fs-5" id="res-chars">0</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button class="btn btn-outline-primary btn-sm rounded-pill px-4" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-copy me-1"></i> Copy Analysis Summary
                            </button>
                        </div>
                    </div>
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
.tool-textarea { border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 1.25rem; font-family: 'Inter', sans-serif; font-size: 1.1rem; transition: all 0.2s; }
.tool-textarea:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79,70,229,0.1); outline: none; }
.btn-light-custom { background: #f1f5f9; border: none; color: #475569; font-weight: 600; border-radius: 10px; }
.btn-light-custom:hover { background: #e2e8f0; color: #1e293b; }
.letter-spacing-1 { letter-spacing: 1px; }
.display-1 { font-size: 5rem; line-height: 1; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('text-input');
    const btnAnalyze = document.getElementById('btn-analyze');
    const results = document.getElementById('results-container');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    const btnCopy = document.getElementById('btn-copy');
    
    const scoreVal = document.getElementById('score-val');
    const scoreLabel = document.getElementById('score-label');
    const resGrade = document.getElementById('res-grade');
    const resTime = document.getElementById('res-time');
    const resComplex = document.getElementById('res-complex');
    const resWords = document.getElementById('res-words');
    const resSentences = document.getElementById('res-sentences');
    const resSyllables = document.getElementById('res-syllables');
    const resChars = document.getElementById('res-chars');

    function countSyllables(word) {
        word = word.toLowerCase().replace(/[^a-z]/g, '');
        if (word.length <= 3) return 1;
        word = word.replace(/(?:[^laeiouy]es|ed|[^laeiouy]e)$/, '');
        word = word.replace(/^y/, '');
        const syllables = word.match(/[aeiouy]{1,2}/g);
        return syllables ? syllables.length : 1;
    }

    function analyze() {
        const text = input.value.trim();
        if (!text) return;

        btnAnalyze.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing...';
        btnAnalyze.disabled = true;

        setTimeout(() => {
            const sentences = text.split(/[.!?]+/).filter(s => s.trim().length > 0).length || 1;
            const wordsArr = text.split(/\s+/).filter(w => w.trim().length > 0);
            const wordCount = wordsArr.length || 1;
            const charCount = text.length;
            
            let totalSyllables = 0;
            let complexWords = 0;
            
            wordsArr.forEach(w => {
                const s = countSyllables(w);
                totalSyllables += s;
                if (s >= 3) complexWords++;
            });

            const asl = wordCount / sentences;
            const asw = totalSyllables / wordCount;

            // Flesch Reading Ease
            const score = 206.835 - (1.015 * asl) - (84.6 * asw);
            const finalScore = Math.max(0, Math.min(100, Math.round(score)));

            // Grade Level (Approx)
            const grade = 0.39 * asl + 11.8 * asw - 15.59;
            const finalGrade = Math.max(1, Math.round(grade));

            scoreVal.textContent = finalScore;
            resWords.textContent = wordCount.toLocaleString();
            resSentences.textContent = sentences.toLocaleString();
            resSyllables.textContent = totalSyllables.toLocaleString();
            resChars.textContent = charCount.toLocaleString();
            resComplex.textContent = Math.round((complexWords / wordCount) * 100) + '%';
            resTime.textContent = Math.ceil(wordCount / 225) + 'm';
            
            let label = "Standard";
            let gradeStr = finalGrade + "th";
            if (finalGrade === 1) gradeStr = "1st";
            else if (finalGrade === 2) gradeStr = "2nd";
            else if (finalGrade === 3) gradeStr = "3rd";
            else if (finalGrade > 12) gradeStr = "College";

            if (finalScore >= 90) label = "Very Easy";
            else if (finalScore >= 80) label = "Easy";
            else if (finalScore >= 70) label = "Fairly Easy";
            else if (finalScore >= 60) label = "Standard";
            else if (finalScore >= 50) label = "Difficult";
            else if (finalScore >= 30) label = "Very Difficult";
            else label = "Confusing";

            scoreLabel.textContent = label;
            resGrade.textContent = gradeStr;

            results.classList.remove('d-none');
            results.classList.add('animate__animated', 'animate__fadeIn');
            btnAnalyze.innerHTML = '<i class="fas fa-chart-line me-2"></i> Run Readability Analysis';
            btnAnalyze.disabled = false;
            
            results.scrollIntoView({ behavior: 'smooth' });
        }, 600);
    }

    btnAnalyze.addEventListener('click', analyze);
    btnClear.addEventListener('click', () => { input.value = ''; results.classList.add('d-none'); });

    btnSample.addEventListener('click', () => {
        input.value = "The integration of artificial intelligence into daily workflows has fundamentally altered the landscape of modern productivity. While the initial adoption phase presented significant technical hurdles, the subsequent democratization of high-level computational tools has empowered individual creators. Today, complex data analysis and generative creative processes are accessible through intuitive interfaces, reducing the barrier to entry for many professional fields. This paradigm shift requires a continuous commitment to learning and adaptation as the capabilities of autonomous systems continue to expand at an exponential rate.";
        analyze();
    });

    btnCopy.addEventListener('click', () => {
        const summary = `Readability Report\nEase Score: ${scoreVal.textContent}\nGrade Level: ${resGrade.textContent}\nReading Time: ${resTime.textContent}\nComplex Words: ${resComplex.textContent}`;
        navigator.clipboard.writeText(summary);
        const old = btnCopy.innerHTML;
        btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        setTimeout(() => btnCopy.innerHTML = old, 2000);
    });
});
</script>

