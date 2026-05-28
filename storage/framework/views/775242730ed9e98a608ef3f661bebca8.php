<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="input-text" class="form-control tool-textarea mb-4" rows="8" placeholder="Paste your long text here..."></textarea>
            
            <div class="p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                <div class="row g-4 align-items-end">
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Characters per Line</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-arrows-left-right text-muted small"></i></span>
                            <input type="number" id="char-limit" class="form-control border-start-0 ps-0" value="80" min="1">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Line Separator</label>
                        <select id="line-separator" class="form-select rounded-3">
                            <option value="\n">New Line (\n)</option>
                            <option value="\n\n">Double New Line</option>
                            <option value="<br>">HTML Break (<br>)</option>
                            <option value="custom">Custom Delimiter</option>
                        </select>
                    </div>
                    <div id="custom-sep-container" class="col-lg-2 col-md-6 d-none">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Custom Delimiter</label>
                        <input type="text" id="custom-separator" class="form-control" placeholder="e.g. |">
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="d-flex flex-wrap gap-3 mb-2 ms-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check-wordbreak" checked>
                                <label class="form-check-label small fw-bold text-dark" for="check-wordbreak">Word Boundary</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="preserve-breaks">
                                <label class="form-check-label small fw-bold text-dark" for="preserve-breaks">Keep Existing</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-process" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-bolt me-2"></i> Process Text
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
                        <i class="fas fa-check-double text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Formatted Result</h5>
                        <p class="text-muted small mb-0" id="stats-text">Lines: 0 | Characters: 0</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" id="btn-undo" disabled title="Undo last change">
                        <i class="fas fa-undo me-1"></i> Undo
                    </button>
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3" id="btn-download" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download me-1"></i> Download
                    </button>
                    <button class="btn btn-success btn-sm rounded-pill px-4" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Result
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="10" readonly placeholder="Result will appear here..."></textarea>
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

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-select { border: 1.5px solid var(--border-color); border-radius: 12px; padding: 0.75rem 1rem; transition: all 0.2s; }
    .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }
    .form-check-input:checked { background-color: var(--primary-color); border-color: var(--primary-color); }

    .transition-all { transition: all 0.2s ease; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const btnProcess = document.getElementById('btn-process');
    const btnClear = document.getElementById('btn-clear');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');
    const btnUndo = document.getElementById('btn-undo');
    const charLimitInput = document.getElementById('char-limit');
    const checkWordBreak = document.getElementById('check-wordbreak');
    const preserveBreaks = document.getElementById('preserve-breaks');
    const lineSeparator = document.getElementById('line-separator');
    const customSeparator = document.getElementById('custom-separator');
    const customSepContainer = document.getElementById('custom-sep-container');
    const statsText = document.getElementById('stats-text');

    let history = [];

    lineSeparator.addEventListener('change', () => {
        if (lineSeparator.value === 'custom') {
            customSepContainer.classList.remove('d-none');
        } else {
            customSepContainer.classList.add('d-none');
        }
    });

    function wrapText(text, limit, wordBreak, preserve) {
        let separator = lineSeparator.value;
        if (separator === 'custom') separator = customSeparator.value || '\n';
        if (separator === '\\n') separator = '\n';
        if (separator === '\\n\\n') separator = '\n\n';

        let paragraphs = preserve ? text.split(/\r?\n/) : [text.replace(/\s+/g, ' ')];
        let result = [];

        paragraphs.forEach(para => {
            if (!para.trim()) {
                result.push('');
                return;
            }

            let words = wordBreak ? para.split(' ') : para.split('');
            let currentLine = "";

            words.forEach(word => {
                let check = wordBreak ? (currentLine.length + word.length + 1) : (currentLine.length + word.length);
                
                if (check <= limit) {
                    currentLine += (wordBreak && currentLine.length > 0 ? " " : "") + word;
                } else {
                    if (currentLine) result.push(currentLine);
                    currentLine = word;
                }
            });
            if (currentLine) result.push(currentLine);
        });

        return result.join(separator);
    }

    function updateStats(text) {
        const lines = text ? text.split(/\r?\n/).length : 0;
        const chars = text ? text.length : 0;
        statsText.textContent = `Lines: ${lines} | Characters: ${chars}`;
    }

    btnProcess.addEventListener('click', () => {
        const text = input.value.trim();
        if (!text) return;
        
        const limit = parseInt(charLimitInput.value);
        if (isNaN(limit) || limit < 1) {
            alert("Please enter a valid character limit.");
            return;
        }

        if (output.value) {
            history.push(output.value);
            btnUndo.disabled = false;
        }

        btnProcess.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing...';
        btnProcess.disabled = true;

        setTimeout(() => {
            try {
                const result = wrapText(text, limit, checkWordBreak.checked, preserveBreaks.checked);
                output.value = result;
                updateStats(result);
            } catch (e) {
                console.error(e);
                output.value = "Error: Text processing failed.";
            }
            btnProcess.innerHTML = '<i class="fas fa-bolt me-2"></i> Process Text';
            btnProcess.disabled = false;
        }, 300);
    });

    btnClear.addEventListener('click', () => { 
        if (input.value) {
            input.value = ''; 
            output.value = ''; 
            updateStats('');
            history = [];
            btnUndo.disabled = true;
        }
    });

    btnUndo.addEventListener('click', () => {
        if (history.length > 0) {
            output.value = history.pop();
            updateStats(output.value);
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
        a.download = `formatted-text-${Date.now()}.txt`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    });
});
</script>



<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\break-line-by-chars.blade.php ENDPATH**/ ?>