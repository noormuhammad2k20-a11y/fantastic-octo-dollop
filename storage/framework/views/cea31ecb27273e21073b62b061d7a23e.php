<div class="row g-4">
    
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label-custom mb-0">Target Content</label>
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
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label-custom">Find Text</label>
                            <input type="text" id="find-str" class="form-control" placeholder="What to look for...">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label-custom">Replace With</label>
                            <input type="text" id="replace-str" class="form-control" placeholder="New replacement...">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm" id="btn-process" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-sync me-2"></i> Run
                            </button>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="d-flex flex-wrap gap-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="check-case">
                                    <label class="form-check-label small fw-bold" for="check-case">Case Sensitive</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="check-regex">
                                    <label class="form-check-label small fw-bold" for="check-regex">Regex Pattern</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="check-global" checked>
                                    <label class="form-check-label small fw-bold" for="check-global">Global Replace</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="check-multiline">
                                    <label class="form-check-label small fw-bold" for="check-multiline">Multiline</label>
                                </div>
                            </div>
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
                    <i class="fas fa-check-double fs-4 me-2" style="color:#4f46e5"></i>
                    <h6 class="fw-bold mb-0">Modified Output</h6>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-primary" id="btn-download" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download me-1"></i> Download
                    </button>
                    <button class="btn btn-primary btn-sm px-4" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Result
                    </button>
                </div>
            </div>
            
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="10" readonly placeholder="Result will appear here..."></textarea>
            
            <div class="mt-3 p-3 bg-white rounded-3 border d-flex justify-content-between align-items-center small text-secondary">
                <div id="stats-text"><i class="fas fa-info-circle me-1"></i> Ready for processing</div>
                <div class="badge bg-light text-primary border" id="match-badge">0 Replacements</div>
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
.tool-textarea { border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 1.25rem; font-family: 'Inter', sans-serif; font-size: 1rem; transition: all 0.2s; }
.tool-textarea:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79,70,229,0.1); outline: none; }
.btn-light-custom { background: #f1f5f9; border: none; color: #475569; font-weight: 600; border-radius: 10px; }
.btn-light-custom:hover { background: #e2e8f0; color: #1e293b; }
.output-card-themed { background: var(--tool-bg); border: 1px solid rgba(79,70,229,0.1); border-radius: 24px; padding: 2rem; }
.form-control { border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 0.75rem 1rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const findStr = document.getElementById('find-str');
    const replaceStr = document.getElementById('replace-str');
    const btnProcess = document.getElementById('btn-process');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');
    const statsText = document.getElementById('stats-text');

    function process() {
        const text = input.value;
        const find = findStr.value;
        const replace = replaceStr.value;
        
        if (!text || find === '') {
            output.value = text;
            return;
        }

        try {
            let count = 0;
            const flags = (document.getElementById('check-case').checked ? '' : 'i') + 
                          (document.getElementById('check-global').checked ? 'g' : '') + 
                          (document.getElementById('check-multiline').checked ? 'm' : '');
            
            let regex;
            if (document.getElementById('check-regex').checked) {
                regex = new RegExp(find, flags);
            } else {
                const escaped = find.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                regex = new RegExp(escaped, flags);
            }

            count = (text.match(regex) || []).length;
            const result = text.replace(regex, replace);

            output.value = result;
            document.getElementById('match-badge').textContent = `${count} Replacements`;
            statsText.innerHTML = `<i class="fas fa-check-circle text-success me-1"></i> Successfully replaced <strong>${count}</strong> occurrences.`;
            
            output.classList.add('border-success');
            setTimeout(() => output.classList.remove('border-success'), 500);
        } catch (e) {
            output.value = "Regex Error: " + e.message;
            statsText.innerHTML = `<i class="fas fa-exclamation-triangle text-danger me-1"></i> Invalid search pattern.`;
        }
    }

    btnProcess.addEventListener('click', process);
    
    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        findStr.value = '';
        replaceStr.value = '';
        document.getElementById('match-badge').textContent = '0 Replacements';
        statsText.innerHTML = '<i class="fas fa-info-circle me-1"></i> Ready for processing';
    });

    btnSample.addEventListener('click', () => {
        input.value = "The lazy dog jumps over the fence. The dog is brown.";
        findStr.value = "dog";
        replaceStr.value = "cat";
        process();
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
        a.download = `text-${Date.now()}.txt`;
        a.click();
        URL.revokeObjectURL(url);
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\find-replace-text.blade.php ENDPATH**/ ?>