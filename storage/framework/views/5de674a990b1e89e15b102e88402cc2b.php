<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="text-input" class="form-control tool-textarea" rows="12" placeholder="Start typing or paste your text here..."></textarea>
        </div>
    </div>

    
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-chart-pie text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Detailed Analysis</h5>
                        <p class="text-muted small mb-0">Real-time statistics and deep metrics</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3" id="btn-download" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download me-1"></i> Download Stats
                    </button>
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Analysis
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="stat-badge p-4 text-center rounded-4 shadow-sm border">
                        <div class="stat-label small fw-bold text-secondary text-uppercase mb-2">Words</div>
                        <div class="stat-value h2 fw-bold text-dark mb-0" id="count-words">0</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-badge p-4 text-center rounded-4 shadow-sm border">
                        <div class="stat-label small fw-bold text-secondary text-uppercase mb-2">Characters</div>
                        <div class="stat-value h2 fw-bold text-dark mb-0" id="count-chars">0</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-badge p-4 text-center rounded-4 shadow-sm border">
                        <div class="stat-label small fw-bold text-secondary text-uppercase mb-2">Sentences</div>
                        <div class="stat-value h2 fw-bold text-dark mb-0" id="count-sentences">0</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-badge p-4 text-center rounded-4 shadow-sm border">
                        <div class="stat-label small fw-bold text-secondary text-uppercase mb-2">Paragraphs</div>
                        <div class="stat-value h2 fw-bold text-dark mb-0" id="count-paragraphs">0</div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold text-dark mb-3 d-flex align-items-center">
                                <i class="fas fa-book-reader me-2 text-primary"></i> Readability
                            </h6>
                            <div class="mb-3">
                                <label class="small text-muted d-block">Estimated Reading Time</label>
                                <span class="fw-bold text-dark" id="reading-time">0m 0s</span>
                            </div>
                            <div class="mb-3">
                                <label class="small text-muted d-block">Estimated Speaking Time</label>
                                <span class="fw-bold text-dark" id="speaking-time">0m 0s</span>
                            </div>
                            <div>
                                <label class="small text-muted d-block">Readability Level</label>
                                <span class="badge bg-primary-soft text-primary rounded-pill px-3" id="readability-level">Basic</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold text-dark mb-3 d-flex align-items-center">
                                <i class="fas fa-info-circle me-2 text-primary"></i> Complexity
                            </h6>
                            <div class="mb-3">
                                <label class="small text-muted d-block">Unique Words</label>
                                <span class="fw-bold text-dark" id="count-unique">0</span>
                            </div>
                            <div class="mb-3">
                                <label class="small text-muted d-block">Average Word Length</label>
                                <span class="fw-bold text-dark" id="avg-word-len">0.0</span>
                            </div>
                            <div>
                                <label class="small text-muted d-block">Page Count (Est.)</label>
                                <span class="fw-bold text-dark" id="page-count">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold text-dark mb-3 d-flex align-items-center">
                                <i class="fas fa-tags me-2 text-primary"></i> Top Keywords
                            </h6>
                            <div id="keyword-list" class="d-flex flex-wrap gap-2">
                                <span class="text-muted small">Type text to analyze keywords...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }

    .tool-card-stacked { border-radius: 20px; background: #fff; }

    .icon-box { 
        width: 48px; 
        height: 48px; 
        border-radius: 14px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 1.25rem;
    }

    .tool-textarea { 
        border: 1.5px solid var(--border-color); 
        border-radius: 16px; 
        padding: 1.25rem; 
        background: #f9fafb; 
        transition: all 0.3s ease; 
        font-family: 'Inter', sans-serif;
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .tool-textarea:focus { border-color: var(--primary-color); background: #fff; box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }

    .stat-badge { background: #fff; transition: all 0.3s ease; border-color: #f1f5f9 !important; }
    .stat-badge:hover { transform: translateY(-5px); border-color: var(--primary-color) !important; }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .transition-all { transition: all 0.2s ease; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('text-input');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');

    const stats = {
        words: document.getElementById('count-words'),
        chars: document.getElementById('count-chars'),
        sentences: document.getElementById('count-sentences'),
        paragraphs: document.getElementById('count-paragraphs'),
        unique: document.getElementById('count-unique'),
        avgWordLen: document.getElementById('avg-word-len'),
        reading: document.getElementById('reading-time'),
        speaking: document.getElementById('speaking-time'),
        readability: document.getElementById('readability-level'),
        pages: document.getElementById('page-count'),
        keywords: document.getElementById('keyword-list')
    };

    function analyzeText() {
        const text = input.value || '';
        const trimmed = text.trim();
        const wordsArray = trimmed ? trimmed.split(/\s+/) : [];
        const wordsCount = wordsArray.length;
        const charsCount = text.length;
        
        // Basic Counts
        stats.words.textContent = wordsCount.toLocaleString();
        stats.chars.textContent = charsCount.toLocaleString();
        
        const sentencesCount = trimmed ? (trimmed.match(/[.!?]+($|\s)/g) || []).length || (trimmed ? 1 : 0) : 0;
        stats.sentences.textContent = sentencesCount.toLocaleString();
        
        const paragraphsCount = trimmed ? trimmed.split(/\n+/).length : 0;
        stats.paragraphs.textContent = paragraphsCount.toLocaleString();

        // Times
        const readingTime = Math.ceil(wordsCount / 225);
        const speakingTime = Math.ceil(wordsCount / 150);
        stats.reading.textContent = `${readingTime}m ${Math.round((wordsCount/225 % 1) * 60)}s`;
        stats.speaking.textContent = `${speakingTime}m ${Math.round((wordsCount/150 % 1) * 60)}s`;

        // Readability (FK Logic Approximation)
        let level = "Basic";
        if (wordsCount > 0) {
            const avgSentLen = wordsCount / sentencesCount;
            if (avgSentLen > 25) level = "Advanced";
            else if (avgSentLen > 15) level = "Intermediate";
        }
        stats.readability.textContent = level;

        // Complexity
        const uniqueSet = new Set(wordsArray.map(w => w.toLowerCase().replace(/[^a-z0-9]/g, '')));
        stats.unique.textContent = uniqueSet.size.toLocaleString();
        
        const totalWordChars = wordsArray.reduce((acc, word) => acc + word.length, 0);
        stats.avgWordLen.textContent = wordsCount ? (totalWordChars / wordsCount).toFixed(1) : '0.0';
        
        stats.pages.textContent = Math.ceil(wordsCount / 500);

        // Keywords
        if (wordsCount > 5) {
            const freq = {};
            const stopWords = ['the', 'and', 'a', 'to', 'of', 'in', 'is', 'it', 'that', 'for', 'on', 'with', 'as', 'at', 'this', 'by'];
            wordsArray.forEach(w => {
                const word = w.toLowerCase().replace(/[^a-z]/g, '');
                if (word.length > 3 && !stopWords.includes(word)) {
                    freq[word] = (freq[word] || 0) + 1;
                }
            });
            const top = Object.entries(freq).sort((a, b) => b[1] - a[1]).slice(0, 8);
            stats.keywords.innerHTML = top.map(([word, count]) => `<span class="badge bg-white text-dark border rounded-pill px-3 py-2 shadow-sm">${word} (${count})</span>`).join('');
        } else {
            stats.keywords.innerHTML = '<span class="text-muted small">Type more text to analyze...</span>';
        }
    }

    input.addEventListener('input', analyzeText);

    btnClear.addEventListener('click', () => {
        input.value = '';
        analyzeText();
    });

    btnSample.addEventListener('click', () => {
        input.value = "The modern digital landscape is evolving at an unprecedented pace. Organizations are increasingly adopting cloud-native architectures to achieve greater scalability and resilience. By leveraging microservices and serverless computing, developers can focus on delivering value without worrying about infrastructure management. This shift requires a strategic approach to software delivery, emphasizing continuous integration and deployment. As we look towards the future, the integration of artificial intelligence and machine learning will further transform how we interact with technology, creating new opportunities for innovation across all sectors of the economy.";
        analyzeText();
    });

    btnCopy.addEventListener('click', () => {
        const summary = `Content Analysis Summary\n------------------------\nWords: ${stats.words.textContent}\nCharacters: ${stats.chars.textContent}\nSentences: ${stats.sentences.textContent}\nParagraphs: ${stats.paragraphs.textContent}\nReadability: ${stats.readability.textContent}\nUnique Words: ${stats.unique.textContent}`;
        navigator.clipboard.writeText(summary);
        const originalText = btnCopy.innerHTML;
        btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied Analysis!';
        setTimeout(() => btnCopy.innerHTML = originalText, 2000);
    });

    btnDownload.addEventListener('click', () => {
        const summary = `Content Analysis Report\nGenerated on: ${new Date().toLocaleString()}\n\nMETRICS:\nWords: ${stats.words.textContent}\nCharacters: ${stats.chars.textContent}\nSentences: ${stats.sentences.textContent}\nParagraphs: ${stats.paragraphs.textContent}\nReadability: ${stats.readability.textContent}\nUnique Words: ${stats.unique.textContent}\nAvg Word Length: ${stats.avgWordLen.textContent}\nReading Time: ${stats.reading.textContent}`;
        const blob = new Blob([summary], { type: 'text/plain' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `content-analysis-${Date.now()}.txt`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    });

    // Initial analysis
    analyzeText();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\word-counter.blade.php ENDPATH**/ ?>