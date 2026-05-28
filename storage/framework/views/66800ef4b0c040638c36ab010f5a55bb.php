<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label small fw-bold text-secondary">Type</label>
                        <select id="lorem-type" class="form-select">
                            <option value="latin" selected>Classic Latin</option>
                            <option value="english">Standard English</option>
                            <option value="tech">Tech Speak</option>
                            <option value="coffee">Coffee Lover</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label small fw-bold text-secondary">Count</label>
                        <input type="number" id="lorem-count" class="form-control" value="3" min="1" max="100">
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label small fw-bold text-secondary">Unit</label>
                        <select id="lorem-unit" class="form-select">
                            <option value="paragraphs" selected>Paragraphs</option>
                            <option value="sentences">Sentences</option>
                            <option value="words">Words</option>
                            <option value="list">List Items</option>
                        </select>
                    </div>
                    <div class="col-lg-5 col-md-6 d-flex flex-column justify-content-end">
                        <div class="d-flex flex-wrap gap-3 mb-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="start-lorem" checked>
                                <label class="form-check-label small fw-semibold" for="start-lorem">Start with Lorem Ipsum</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="use-html">
                                <label class="form-check-label small fw-semibold" for="use-html">Include HTML Tags</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-generate" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-sync me-2"></i> Generate Text
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-file-alt text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Generated Result</h5>
                        <p class="text-muted small mb-0" id="stats-text">Ready for your layout</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" id="btn-undo" disabled>
                        <i class="fas fa-undo me-1"></i> Undo
                    </button>
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3" id="btn-download" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download me-1"></i> Download
                    </button>
                    <button class="btn btn-success btn-sm rounded-pill px-4" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Text
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="12" readonly placeholder="Your generated text will appear here..."></textarea>
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
        background: #fff; 
        transition: all 0.3s ease; 
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        line-height: 1.6;
    }

    .tool-textarea:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .transition-all { transition: all 0.2s ease; }
    
    .form-check-input:checked { background-color: var(--primary-color); border-color: var(--primary-color); }

    .form-control, .form-select { border: 1.5px solid var(--border-color); border-radius: 10px; padding: 0.625rem 0.75rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const output = document.getElementById('output-text');
    const btnGenerate = document.getElementById('btn-generate');
    const btnClear = document.getElementById('btn-clear');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');
    const btnUndo = document.getElementById('btn-undo');
    const typeSelect = document.getElementById('lorem-type');
    const countInput = document.getElementById('lorem-count');
    const unitSelect = document.getElementById('lorem-unit');
    const startLoremCheck = document.getElementById('start-lorem');
    const useHtmlCheck = document.getElementById('use-html');
    const statsText = document.getElementById('stats-text');

    const dictionary = {
        latin: ["lorem", "ipsum", "dolor", "sit", "amet", "consectetur", "adipiscing", "elit", "sed", "do", "eiusmod", "tempor", "incididunt", "ut", "labore", "et", "dolore", "magna", "aliqua", "enim", "ad", "minim", "veniam", "quis", "nostrud", "exercitation", "ullamco", "laboris", "nisi", "ut", "aliquip", "ex", "ea", "commodo", "consequat"],
        english: ["the", "quick", "brown", "fox", "jumps", "over", "lazy", "dog", "modern", "design", "creative", "solutions", "impactful", "growth", "digital", "transformation", "seamless", "experience", "strategic", "vision", "innovative", "approaches", "scalable", "architecture", "robust", "framework", "agile", "methodology"],
        tech: ["cloud", "native", "serverless", "microservices", "kubernetes", "docker", "deployment", "continuous", "integration", "delivery", "blockchain", "encryption", "latency", "throughput", "bandwidth", "distributed", "systems", "scalability", "abstraction", "polymorphism", "encapsulation", "inheritance"],
        coffee: ["espresso", "cappuccino", "latte", "macchiato", "americano", "ristretto", "arabica", "robusta", "roasting", "grinding", "brewing", "barista", "crema", "frothing", "steaming", "caffeine", "morning", "routine", "aroma", "flavor", "profile", "origin", "altitude"]
    };

    let history = [];

    function generateSentences(words, count) {
        let sentences = [];
        for (let i = 0; i < count; i++) {
            let len = Math.floor(Math.random() * 8) + 6;
            let sentence = [];
            for (let j = 0; j < len; j++) {
                sentence.push(words[Math.floor(Math.random() * words.length)]);
            }
            let s = sentence.join(' ');
            sentences.push(s.charAt(0).toUpperCase() + s.slice(1) + '.');
        }
        return sentences.join(' ');
    }

    function generateText() {
        const type = typeSelect.value;
        const count = parseInt(countInput.value) || 1;
        const unit = unitSelect.value;
        const startLorem = startLoremCheck.checked;
        const useHtml = useHtmlCheck.checked;
        
        if (output.value) {
            history.push(output.value);
            btnUndo.disabled = false;
        }

        btnGenerate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Generating...';
        btnGenerate.disabled = true;

        setTimeout(() => {
            const words = dictionary[type];
            let result = "";

            if (unit === 'paragraphs') {
                let paragraphs = [];
                for (let i = 0; i < count; i++) {
                    let p = generateSentences(words, 4 + Math.floor(Math.random() * 4));
                    if (i === 0 && startLorem && type === 'latin') {
                        p = "Lorem ipsum dolor sit amet. " + p;
                    }
                    paragraphs.push(useHtml ? `<p>${p}</p>` : p);
                }
                result = paragraphs.join(useHtml ? '\n' : '\n\n');
            } else if (unit === 'sentences') {
                result = generateSentences(words, count);
                if (startLorem && type === 'latin') result = "Lorem ipsum dolor sit amet. " + result;
                if (useHtml) result = `<p>${result}</p>`;
            } else if (unit === 'words') {
                let w = [];
                if (startLorem && type === 'latin') w.push("Lorem", "ipsum");
                for (let i = 0; i < count - (startLorem ? 2 : 0); i++) {
                    w.push(words[Math.floor(Math.random() * words.length)]);
                }
                result = w.join(' ');
                if (useHtml) result = `<span>${result}</span>`;
            } else if (unit === 'list') {
                let items = [];
                for (let i = 0; i < count; i++) {
                    let item = words[Math.floor(Math.random() * words.length)];
                    item = item.charAt(0).toUpperCase() + item.slice(1);
                    items.push(useHtml ? `  <li>${item}</li>` : `• ${item}`);
                }
                result = useHtml ? `<ul>\n${items.join('\n')}\n</ul>` : items.join('\n');
            }

            output.value = result;
            const wordCount = result.trim().split(/\s+/).length;
            statsText.textContent = `Words: ${wordCount} | Characters: ${result.length}`;
            btnGenerate.innerHTML = '<i class="fas fa-sync me-2"></i> Generate Text';
            btnGenerate.disabled = false;
        }, 300);
    }

    btnGenerate.addEventListener('click', generateText);

    btnClear.addEventListener('click', () => {
        output.value = '';
        statsText.textContent = 'Ready for your layout';
        history = [];
        btnUndo.disabled = true;
    });

    btnUndo.addEventListener('click', () => {
        if (history.length > 0) {
            output.value = history.pop();
            if (history.length === 0) btnUndo.disabled = true;
        }
    });

    btnCopy.addEventListener('click', () => {
        if (!output.value) return;
        navigator.clipboard.writeText(output.value);
        const originalText = btnCopy.innerHTML;
        btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        btnCopy.classList.replace('btn-success', 'btn-dark');
        setTimeout(() => {
            btnCopy.innerHTML = originalText;
            btnCopy.classList.replace('btn-dark', 'btn-success');
        }, 2000);
    });

    btnDownload.addEventListener('click', () => {
        if (!output.value) return;
        const blob = new Blob([output.value], { type: 'text/plain' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `lorem-ipsum-${Date.now()}.txt`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    });

    // Initial generation
    generateText();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\lorem-ipsum.blade.php ENDPATH**/ ?>