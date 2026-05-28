<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="input-text" class="form-control tool-textarea mb-4" rows="10" placeholder="Paste your text here..."></textarea>
            
            <div class="text-center">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-find" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-search me-2"></i> Find Longest Line
                </button>
            </div>
        </div>
    </div>

    
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-trophy text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Longest Line Result</h5>
                        <p class="text-muted small mb-0" id="stats-text">The line with the maximum character count</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Result
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="6" readonly placeholder="Longest line will appear here..."></textarea>
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
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .tool-textarea { 
        border: 1.5px solid var(--border-color); border-radius: 16px; 
        padding: 1.25rem; background: #fff; transition: all 0.3s ease; 
        font-family: 'Inter', sans-serif; font-size: 1rem; line-height: 1.6;
    }
    .tool-textarea:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }

    .btn-light-custom { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-custom:hover { background: #e2e8f0; color: #1e293b; }

    .transition-all { transition: all 0.2s ease; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const btnFind = document.getElementById('btn-find');
    const btnClear = document.getElementById('btn-clear');
    const btnCopy = document.getElementById('btn-copy');
    const statsText = document.getElementById('stats-text');

    btnFind.addEventListener('click', () => {
        const text = input.value.trim();
        if (!text) return;

        btnFind.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing...';
        btnFind.disabled = true;

        setTimeout(() => {
            const lines = text.split(/\r?\n/);
            let longest = "";
            let maxLen = -1;

            lines.forEach(line => {
                if (line.length > maxLen) {
                    maxLen = line.length;
                    longest = line;
                }
            });

            output.value = longest;
            statsText.textContent = `Longest line found: ${maxLen} characters`;
            
            btnFind.innerHTML = '<i class="fas fa-search me-2"></i> Find Longest Line';
            btnFind.disabled = false;
            
            output.scrollIntoView({ behavior: 'smooth' });
        }, 300);
    });

    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        statsText.textContent = 'The line with the maximum character count';
    });

    btnCopy.addEventListener('click', () => {
        if (!output.value) return;
        navigator.clipboard.writeText(output.value);
        const originalText = btnCopy.innerHTML;
        btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        setTimeout(() => btnCopy.innerHTML = originalText, 2000);
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\find-longest-line.blade.php ENDPATH**/ ?>