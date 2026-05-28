<div class="row g-4">
    
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="d-flex justify-content-center mb-4">
                    <ul class="nav nav-pills nav-pills-custom p-1 bg-light rounded-pill" id="calcTab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active rounded-pill px-4" id="auto-tab" data-bs-toggle="pill" data-bs-target="#tab-auto">
                                <i class="fas fa-magic me-2"></i> Auto Analyze
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link rounded-pill px-4" id="manual-tab" data-bs-toggle="pill" data-bs-target="#tab-manual">
                                <i class="fas fa-keyboard me-2"></i> Manual Entry
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content mt-4" id="calcTabContent">
                    
                    <div class="tab-pane fade show active" id="tab-auto">
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label-custom mb-0">Source Text</label>
                                <button class="btn btn-sm btn-light-custom" id="btn-sample" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-vial me-1"></i> Sample
                                </button>
                            </div>
                            <textarea id="input-text" class="form-control tool-textarea" rows="10" placeholder="Paste your text here for deep analysis..."></textarea>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm transition-all" onclick="calculateReadability('auto')">
                                <i class="fas fa-microscope me-2"></i> Run Deep Scan
                            </button>
                        </div>
                    </div>
                    
                    
                    <div class="tab-pane fade" id="tab-manual">
                        <div class="row g-4 mb-4">
                            <div class="col-md-4">
                                <label class="form-label-custom">Total Words</label>
                                <input type="number" id="man-words" class="form-control" placeholder="e.g. 500">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-custom">Total Sentences</label>
                                <input type="number" id="man-sentences" class="form-control" placeholder="e.g. 25">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-custom">Total Syllables</label>
                                <input type="number" id="man-syllables" class="form-control" placeholder="e.g. 750">
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm transition-all" onclick="calculateReadability('manual')">
                                <i class="fas fa-equals me-2"></i> Calculate Metrics
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12 d-none" id="results-container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-white border text-center shadow-sm h-100 border-top-primary">
                    <h6 class="fw-bold text-muted small text-uppercase mb-3 letter-spacing-1">Flesch Reading Ease</h6>
                    <h1 class="fw-bold text-primary display-5 mb-2" id="res-flesch">0</h1>
                    <span class="badge rounded-pill bg-primary text-white py-2 px-3" id="label-flesch">Standard</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-white border text-center shadow-sm h-100 border-top-info">
                    <h6 class="fw-bold text-muted small text-uppercase mb-3 letter-spacing-1">Flesch-Kincaid Grade</h6>
                    <h1 class="fw-bold text-info display-5 mb-2" id="res-grade">0</h1>
                    <span class="badge rounded-pill bg-info text-white py-2 px-3">School Level</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-white border text-center shadow-sm h-100 border-top-success">
                    <h6 class="fw-bold text-muted small text-uppercase mb-3 letter-spacing-1">Gunning Fog Index</h6>
                    <h1 class="fw-bold text-success display-5 mb-2" id="res-fog">0</h1>
                    <span class="badge rounded-pill bg-success text-white py-2 px-3" id="label-fog">Professional</span>
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
.nav-pills-custom .nav-link { color: #64748b; font-weight: 700; font-size: 0.9rem; transition: all 0.2s; border: 1px solid transparent; }
.nav-pills-custom .nav-link.active { background: #fff !important; color: #4f46e5 !important; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border-color: #e2e8f0; }
.form-control { border-radius: 12px; border: 1.5px solid #e2e8f0; padding: 0.75rem; transition: all 0.2s; }
.form-control:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79,70,229,0.1); outline: none; }
.border-top-primary { border-top: 4px solid #4f46e5 !important; }
.border-top-info { border-top: 4px solid #0891b2 !important; }
.border-top-success { border-top: 4px solid #16a34a !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    window.calculateReadability = function(mode) {
        const results = document.getElementById('results-container');
        let wordsCount, sentencesCount, syllablesCount, complexWords = 0;

        if (mode === 'auto') {
            const text = document.getElementById('input-text').value.trim();
            if (!text) return;
            
            const sentences = text.split(/[.!?]+/).filter(s => s.trim().length > 0);
            const words = text.split(/\s+/).filter(w => w.trim().length > 0);
            
            sentencesCount = sentences.length || 1;
            wordsCount = words.length || 1;
            syllablesCount = 0;
            
            words.forEach(w => {
                const s = countSyllables(w);
                syllablesCount += s;
                if (s >= 3) complexWords++;
            });
        } else {
            wordsCount = parseInt(document.getElementById('man-words').value) || 1;
            sentencesCount = parseInt(document.getElementById('man-sentences').value) || 1;
            syllablesCount = parseInt(document.getElementById('man-syllables').value) || 1;
            complexWords = Math.round(wordsCount * 0.15); // Approximation
        }

        const asl = wordsCount / sentencesCount;
        const asw = syllablesCount / wordsCount;

        const flesch = 206.835 - (1.015 * asl) - (84.6 * asw);
        const grade = (0.39 * asl) + (11.8 * asw) - 15.59;
        const fog = 0.4 * (asl + (100 * (complexWords / wordsCount)));

        document.getElementById('res-flesch').textContent = Math.round(flesch);
        document.getElementById('res-grade').textContent = Math.max(0, Math.round(grade));
        document.getElementById('res-fog').textContent = fog.toFixed(1);

        let label = "Standard";
        if (flesch >= 90) label = "Very Easy";
        else if (flesch >= 70) label = "Easy";
        else if (flesch >= 50) label = "Standard";
        else if (flesch >= 30) label = "Difficult";
        else label = "Confusing";
        document.getElementById('label-flesch').textContent = label;

        results.classList.remove('d-none');
        results.classList.add('animate__animated', 'animate__fadeIn');
        results.scrollIntoView({ behavior: 'smooth' });
    };

    function countSyllables(word) {
        word = word.toLowerCase().replace(/[^a-z]/g, '');
        if (word.length <= 3) return 1;
        word = word.replace(/(?:[^laeiouy]es|ed|[^laeiouy]e)$/, '');
        word = word.replace(/^y/, '');
        const syllables = word.match(/[aeiouy]{1,2}/g);
        return syllables ? syllables.length : 1;
    }

    const btnSample = document.getElementById('btn-sample');
    if(btnSample) {
        btnSample.addEventListener('click', () => {
            document.getElementById('input-text').value = "The quick brown fox jumps over the lazy dog. This sentence is simple. Complex sentences require advanced comprehension of grammatical structures and vocabulary density.";
            calculateReadability('auto');
        });
    }
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\readability-score-calculator.blade.php ENDPATH**/ ?>