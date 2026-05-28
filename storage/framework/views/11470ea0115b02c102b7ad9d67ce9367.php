<div class="row g-4">
    
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label-custom mb-0">Messy Source Text</label>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light-custom" id="btn-sample" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-vial me-1"></i> Sample
                            </button>
                            <button class="btn btn-sm btn-light-custom" id="btn-clear" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-trash-alt me-1"></i> Clear
                            </button>
                        </div>
                    </div>
                    <textarea id="input-text" class="form-control tool-textarea" rows="10" placeholder="Paste your text here..."></textarea>
                </div>

                <div class="options-grid p-4 rounded-4" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <h6 class="form-label-custom mb-3">Cleaning Configuration</h6>
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-4 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="clean-html" checked>
                                    <label class="form-check-label small fw-bold" for="clean-html">Strip HTML</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="clean-emoji">
                                    <label class="form-check-label small fw-bold" for="clean-emoji">Strip Emojis</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="clean-numbers">
                                    <label class="form-check-label small fw-bold" for="clean-numbers">Remove Digits</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="clean-special">
                                    <label class="form-check-label small fw-bold" for="clean-special">Remove Special Chars</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="clean-extra-spaces" checked>
                                    <label class="form-check-label small fw-bold" for="clean-extra-spaces">Normalize Spaces</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="clean-empty-lines">
                                    <label class="form-check-label small fw-bold" for="clean-empty-lines">Remove Blank Lines</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label-custom">Transform Case</label>
                            <select id="case-select" class="form-select">
                                <option value="none" selected>Keep Original Case</option>
                                <option value="lower">lower case</option>
                                <option value="upper">UPPER CASE</option>
                                <option value="title">Title Case</option>
                                <option value="sentence">Sentence case</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6 d-flex align-items-end">
                            <button class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm" id="btn-clean-action" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-broom me-2"></i> Purify Content
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,0.04);">
            <div class="output-header d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-magic fs-4 me-2" style="color:#4f46e5"></i>
                    <h6 class="fw-bold mb-0">Purified Result</h6>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-light-custom" id="btn-undo" disabled>
                        <i class="fas fa-undo"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-primary" id="btn-download" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download me-1"></i> Download
                    </button>
                    <button class="btn btn-primary btn-sm px-4" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy
                    </button>
                </div>
            </div>
            
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="10" readonly placeholder="Clean text will appear here..."></textarea>
            
            <div class="mt-3 p-3 bg-white rounded-3 border d-flex justify-content-between align-items-center small text-secondary">
                <div id="stats-text"><i class="fas fa-info-circle me-1"></i> No changes yet</div>
                <div class="badge bg-light text-primary border" id="clean-status-badge">Ready</div>
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
.tool-textarea { border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 1.25rem; font-family: 'Inter', sans-serif; font-size: 0.95rem; transition: all 0.2s; }
.tool-textarea:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79,70,229,0.1); outline: none; }
.btn-light-custom { background: #f1f5f9; border: none; color: #475569; font-weight: 600; border-radius: 10px; }
.btn-light-custom:hover { background: #e2e8f0; color: #1e293b; }
.output-card-themed { background: var(--tool-bg); border: 1px solid rgba(79,70,229,0.1); border-radius: 24px; padding: 2rem; }
.form-control, .form-select { border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 0.75rem 1rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const btnClean = document.getElementById('btn-clean-action');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');
    const btnUndo = document.getElementById('btn-undo');
    
    const statsText = document.getElementById('stats-text');

    let history = [];

    function clean() {
        let res = input.value;
        if (!res.trim()) {
            output.value = '';
            return;
        }

        if (output.value) {
            history.push(output.value);
            btnUndo.disabled = false;
        }

        const htmlOpt = document.getElementById('clean-html').checked;
        const emojiOpt = document.getElementById('clean-emoji').checked;
        const numOpt = document.getElementById('clean-numbers').checked;
        const specOpt = document.getElementById('clean-special').checked;
        const spaceOpt = document.getElementById('clean-extra-spaces').checked;
        const emptyOpt = document.getElementById('clean-empty-lines').checked;
        const caseMode = document.getElementById('case-select').value;

        if (htmlOpt) res = res.replace(/<[^>]*>?/gm, '');
        if (emojiOpt) res = res.replace(/([\u2700-\u27BF]|[\uE000-\uF8FF]|\uD83C[\uDC00-\uDFFF]|\uD83D[\uDC00-\uDFFF]|[\u2011-\u26FF]|\uD83E[\uDC00-\uDFFF])/g, '');
        if (numOpt) res = res.replace(/[0-9]/g, '');
        if (specOpt) res = res.replace(/[^a-zA-Z0-9\s]/g, '');
        
        if (spaceOpt) {
            res = res.split('\n').map(line => line.replace(/\s+/g, ' ').trim()).join('\n');
        }

        if (emptyOpt) {
            res = res.split('\n').filter(line => line.trim() !== '').join('\n');
        }

        switch(caseMode) {
            case 'lower': res = res.toLowerCase(); break;
            case 'upper': res = res.toUpperCase(); break;
            case 'title': 
                res = res.toLowerCase().split(' ').map(s => s.charAt(0).toUpperCase() + s.substring(1)).join(' ');
                break;
            case 'sentence':
                res = res.toLowerCase().replace(/(^\s*\w|[.!?]\s*\w)/g, c => c.toUpperCase());
                break;
        }

        output.value = res.trim();
        
        const chars = res.length;
        const words = res.trim() ? res.trim().split(/\s+/).length : 0;
        statsText.innerHTML = `<i class="fas fa-check-circle text-success me-1"></i> Words: <strong>${words}</strong> | Chars: <strong>${chars}</strong>`;
        document.getElementById('clean-status-badge').textContent = 'Purified';
    }

    btnClean.addEventListener('click', clean);
    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        statsText.innerHTML = '<i class="fas fa-info-circle me-1"></i> No changes yet';
        document.getElementById('clean-status-badge').textContent = 'Ready';
        history = [];
        btnUndo.disabled = true;
    });

    btnSample.addEventListener('click', () => {
        input.value = "<div>Hello   World! 🚀 123</div> \n\n <p>Special chars: @#$%^&*()</p>\n    This   is   a    messy   string.";
        clean();
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
        const btn = btnCopy;
        const old = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        btn.classList.replace('btn-primary', 'btn-dark');
        setTimeout(() => {
            btn.innerHTML = old;
            btn.classList.replace('btn-dark', 'btn-primary');
        }, 2000);
    });

    btnDownload.addEventListener('click', () => {
        if (!output.value) return;
        const blob = new Blob([output.value], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `cleaned-text-${Date.now()}.txt`;
        a.click();
        URL.revokeObjectURL(url);
    });
});
</script>


<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\text-cleaner.blade.php ENDPATH**/ ?>