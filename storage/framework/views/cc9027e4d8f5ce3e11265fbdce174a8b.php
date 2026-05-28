<div class="row g-4">
    
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label-custom mb-0">Source Content</label>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light-custom" id="btn-sample" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-vial me-1"></i> Sample
                            </button>
                            <button class="btn btn-sm btn-light-custom" id="btn-clear" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-trash-alt me-1"></i> Clear
                            </button>
                        </div>
                    </div>
                    <textarea id="text-input" class="form-control tool-textarea" rows="8" placeholder="Paste your text here for deep analysis..."></textarea>
                </div>

                <div class="options-grid p-4 rounded-4 mb-4" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <div class="row g-4 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label-custom">Min Word Length</label>
                            <input type="number" id="min-length" class="form-control" value="3" min="1">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Sort By</label>
                            <select id="sort-by" class="form-select">
                                <option value="freq" selected>Frequency (High-Low)</option>
                                <option value="alpha">Alphabetical (A-Z)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-wrap gap-4 mb-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="exclude-stop" checked>
                                    <label class="form-check-label small fw-bold" for="exclude-stop">Exclude Stop Words</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="case-sensitive">
                                    <label class="form-check-label small fw-bold" for="case-sensitive">Case Sensitive</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm transition-all" id="btn-analyze" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-chart-bar me-2"></i> Run Frequency Scan
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <div id="results-container" class="col-lg-12 d-none">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,0.04);">
            <div class="output-header d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <div class="tool-icon-circle-sm me-3" style="background:rgba(16,185,129,0.1);color:#10b981">
                        <i class="fas fa-table"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Analysis Results</h5>
                        <p class="text-muted small mb-0" id="total-unique">0 unique words identified</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3" id="btn-download" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download me-1"></i> CSV
                    </button>
                    <button class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Table
                    </button>
                </div>
            </div>

            <div class="table-responsive rounded-4 border bg-white overflow-hidden shadow-sm">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 border-0 small text-uppercase fw-bold text-muted" style="width: 80px;">Rank</th>
                            <th class="py-3 border-0 small text-uppercase fw-bold text-muted">Word</th>
                            <th class="py-3 border-0 small text-uppercase fw-bold text-muted text-center">Frequency</th>
                            <th class="px-4 py-3 border-0 small text-uppercase fw-bold text-muted text-end">Density</th>
                        </tr>
                    </thead>
                    <tbody id="freq-body">
                        
                    </tbody>
                </table>
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
.tool-icon-circle-sm { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; }
.form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; display: block; }
.tool-textarea { border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 1.25rem; font-family: 'Inter', sans-serif; font-size: 1.1rem; transition: all 0.2s; }
.tool-textarea:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79,70,229,0.1); outline: none; }
.btn-light-custom { background: #f1f5f9; border: none; color: #475569; font-weight: 600; border-radius: 10px; }
.btn-light-custom:hover { background: #e2e8f0; color: #1e293b; }
.output-card-themed { background: var(--tool-bg); border: 1px solid rgba(79,70,229,0.1); border-radius: 24px; padding: 2rem; }
.table thead th { border-bottom: none; font-size: 0.75rem; }
.table tbody td { border-bottom-color: #f1f5f9; padding: 1rem 0.5rem; }
.form-check-input:checked { background-color: #4f46e5; border-color: #4f46e5; }
.form-control, .form-select { border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 0.75rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('text-input');
    const btnAnalyze = document.getElementById('btn-analyze');
    const results = document.getElementById('results-container');
    const freqBody = document.getElementById('freq-body');
    const totalUnique = document.getElementById('total-unique');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');
    
    const minLenInput = document.getElementById('min-length');
    const sortBySelect = document.getElementById('sort-by');
    const excludeStopCheck = document.getElementById('exclude-stop');
    const caseCheck = document.getElementById('case-sensitive');

    const stopWords = ['the', 'and', 'a', 'to', 'of', 'in', 'is', 'it', 'that', 'for', 'on', 'with', 'as', 'at', 'this', 'by', 'an', 'be', 'are', 'was', 'from', 'or', 'which', 'but', 'not', 'we', 'they', 'you', 'can', 'will', 'have', 'has', 'had', 'been', 'were', 'their', 'our', 'my', 'your'];

    function analyze() {
        const text = input.value.trim();
        if (!text) return;

        btnAnalyze.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing...';
        btnAnalyze.disabled = true;

        setTimeout(() => {
            let words = text.match(/\b(\w+)\b/g) || [];
            if (!caseCheck.checked) {
                words = words.map(w => w.toLowerCase());
            }

            const minLen = parseInt(minLenInput.value) || 1;
            const excludeStop = excludeStopCheck.checked;

            let filteredWords = words.filter(w => {
                const clean = w.toLowerCase();
                if (clean.length < minLen) return false;
                if (excludeStop && stopWords.includes(clean)) return false;
                return true;
            });

            const totalCount = filteredWords.length;
            const freq = {};
            filteredWords.forEach(w => freq[w] = (freq[w] || 0) + 1);

            let sorted = Object.entries(freq);
            if (sortBySelect.value === 'freq') {
                sorted.sort((a, b) => b[1] - a[1]);
            } else {
                sorted.sort((a, b) => a[0].localeCompare(b[0]));
            }

            totalUnique.textContent = `${sorted.length.toLocaleString()} unique words identified`;
            
            freqBody.innerHTML = sorted.slice(0, 50).map(([word, count], i) => {
                const density = ((count / totalCount) * 100).toFixed(1);
                return `
                    <tr>
                        <td class="px-4 text-muted small">#${i + 1}</td>
                        <td class="fw-bold text-dark fs-6">${word}</td>
                        <td class="text-center">
                            <span class="badge bg-primary text-white px-3 py-1 rounded-pill">${count.toLocaleString()}</span>
                        </td>
                        <td class="px-4 text-end text-primary fw-bold">${density}%</td>
                    </tr>
                `;
            }).join('');

            results.classList.remove('d-none');
            results.classList.add('animate__animated', 'animate__fadeInUp');
            btnAnalyze.innerHTML = '<i class="fas fa-chart-bar me-2"></i> Run Frequency Scan';
            btnAnalyze.disabled = false;
            
            results.scrollIntoView({ behavior: 'smooth' });
        }, 500);
    }

    btnAnalyze.addEventListener('click', analyze);
    btnClear.addEventListener('click', () => { input.value = ''; results.classList.add('d-none'); });

    btnSample.addEventListener('click', () => {
        input.value = "The integration of artificial intelligence into daily workflows has fundamentally altered the landscape of modern productivity. While the initial adoption phase presented significant technical hurdles, the subsequent democratization of high-level computational tools has empowered individual creators. Today, complex data analysis and generative creative processes are accessible through intuitive interfaces, reducing the barrier to entry for many professional fields.";
        analyze();
    });

    btnCopy.addEventListener('click', () => {
        const rows = Array.from(freqBody.querySelectorAll('tr')).map(tr => {
            const cells = tr.querySelectorAll('td');
            return `${cells[1].textContent}: ${cells[2].textContent.trim()} (${cells[3].textContent.trim()})`;
        }).join('\n');
        navigator.clipboard.writeText("Word Frequency Report\n------------------\n" + rows);
        const old = btnCopy.innerHTML;
        btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        setTimeout(() => btnCopy.innerHTML = old, 2000);
    });

    btnDownload.addEventListener('click', () => {
        const rows = Array.from(freqBody.querySelectorAll('tr')).map(tr => {
            const cells = tr.querySelectorAll('td');
            return `${cells[1].textContent},${cells[2].textContent.trim()},${cells[3].textContent}`;
        }).join('\n');
        const csv = "Rank,Word,Frequency,Density\n" + rows;
        const blob = new Blob([csv], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `word-frequency-${Date.now()}.csv`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\word-frequency-counter.blade.php ENDPATH**/ ?>