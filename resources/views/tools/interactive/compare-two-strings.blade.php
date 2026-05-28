<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Original Version</label>
                    <textarea id="string-1" class="form-control tool-textarea" rows="8" placeholder="Paste the original text here..."></textarea>
                </div>
                <div class="col-lg-6">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Modified Version</label>
                    <textarea id="string-2" class="form-control tool-textarea" rows="8" placeholder="Paste the modified version here..."></textarea>
                </div>
            </div>
            
            <div class="mt-4 p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex flex-wrap gap-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="opt-case">
                                <label class="form-check-label small fw-semibold" for="opt-case">Case Sensitive</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="opt-space" checked>
                                <label class="form-check-label small fw-semibold" for="opt-space">Ignore Extra Spaces</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-compare" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-not-equal me-2"></i> Execute Comparison
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div id="results-container" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-search text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Difference Analysis</h5>
                        <p class="text-muted small mb-0" id="stats-summary">Identification of changes complete</p>
                    </div>
                </div>
                <div class="header-actions">
                    <div id="diff-stats" class="d-flex gap-3 align-items-center px-3 py-2 bg-light rounded-pill border">
                        <span class="text-success small fw-bold"><i class="fas fa-plus-circle me-1"></i> <span id="add-count">0</span></span>
                        <span class="text-danger small fw-bold"><i class="fas fa-minus-circle me-1"></i> <span id="del-count">0</span></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div id="diff-output" class="p-4 rounded-4 bg-white border font-monospace overflow-auto" style="min-height: 200px; white-space: pre-wrap; font-size: 0.95rem; line-height: 1.6;">
                {{-- Diff will be injected here --}}
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
        background: #fff; 
        transition: all 0.3s ease; 
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
    }

    .tool-textarea:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }

    #diff-output ins { background-color: #dcfce7; color: #166534; text-decoration: none; border-radius: 4px; padding: 0 2px; border-bottom: 2px solid #22c55e; }
    #diff-output del { background-color: #fee2e2; color: #991b1b; text-decoration: none; border-radius: 4px; padding: 0 2px; border-bottom: 2px solid #ef4444; }

    .btn-light-custom { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-custom:hover { background: #e2e8f0; color: #1e293b; }

    .transition-all { transition: all 0.2s ease; }
    
    .form-check-input:checked { background-color: var(--primary-color); border-color: var(--primary-color); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const s1 = document.getElementById('string-1');
    const s2 = document.getElementById('string-2');
    const output = document.getElementById('diff-output');
    const results = document.getElementById('results-container');
    const btnCompare = document.getElementById('btn-compare');
    const btnClear = document.getElementById('btn-clear');
    const addCount = document.getElementById('add-count');
    const delCount = document.getElementById('del-count');
    const statsSummary = document.getElementById('stats-summary');
    
    const optCase = document.getElementById('opt-case');
    const optSpace = document.getElementById('opt-space');

    function diff(oldStr, newStr) {
        if (!optCase.checked) {
            // Internal logic uses case-insensitive for matching but preserves original for display
        }
        
        if (optSpace.checked) {
            oldStr = oldStr.replace(/[ ]+/g, ' ');
            newStr = newStr.replace(/[ ]+/g, ' ');
        }

        // Character-level LCS algorithm
        let matrix = Array(oldStr.length + 1).fill().map(() => Array(newStr.length + 1).fill(0));
        for (let i = 1; i <= oldStr.length; i++) {
            for (let j = 1; j <= newStr.length; j++) {
                let match = optCase.checked ? (oldStr[i-1] === newStr[j-1]) : (oldStr[i-1].toLowerCase() === newStr[j-1].toLowerCase());
                if (match) matrix[i][j] = matrix[i-1][j-1] + 1;
                else matrix[i][j] = Math.max(matrix[i-1][j], matrix[i][j-1]);
            }
        }

        let result = [];
        let i = oldStr.length, j = newStr.length;
        let adds = 0, dels = 0;

        while (i > 0 || j > 0) {
            let match = false;
            if (i > 0 && j > 0) {
                match = optCase.checked ? (oldStr[i-1] === newStr[j-1]) : (oldStr[i-1].toLowerCase() === newStr[j-1].toLowerCase());
            }

            if (i > 0 && j > 0 && match) {
                result.unshift(escapeHTML(oldStr[i-1]));
                i--; j--;
            } else if (j > 0 && (i === 0 || matrix[i][j-1] >= matrix[i-1][j])) {
                result.unshift(`<ins>${escapeHTML(newStr[j-1])}</ins>`);
                adds++; j--;
            } else if (i > 0 && (j === 0 || matrix[i][j-1] < matrix[i-1][j])) {
                result.unshift(`<del>${escapeHTML(oldStr[i-1])}</del>`);
                dels++; i--;
            }
        }
        return { html: result.join(''), adds, dels };
    }

    function escapeHTML(str) {
        const p = document.createElement('p');
        p.textContent = str;
        return p.innerHTML;
    }

    btnCompare.addEventListener('click', () => {
        if (!s1.value && !s2.value) return;

        btnCompare.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Scanning...';
        btnCompare.disabled = true;

        setTimeout(() => {
            const res = diff(s1.value, s2.value);
            output.innerHTML = res.html;
            addCount.textContent = res.adds;
            delCount.textContent = res.dels;
            
            const totalChanges = res.adds + res.dels;
            const percent = s1.value.length > 0 ? Math.round((totalChanges / s1.value.length) * 100) : 100;
            statsSummary.textContent = `${totalChanges} total changes detected (${percent}% difference)`;

            results.classList.remove('d-none');
            results.scrollIntoView({ behavior: 'smooth' });
            
            btnCompare.innerHTML = '<i class="fas fa-not-equal me-2"></i> Execute Comparison';
            btnCompare.disabled = false;
        }, 400);
    });

    btnClear.addEventListener('click', () => {
        s1.value = '';
        s2.value = '';
        results.classList.add('d-none');
    });
});
</script>

