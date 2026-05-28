<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="input-text" class="form-control tool-textarea" rows="10" placeholder=".style { color: red; } or function test() { alert('hi'); }"></textarea>
            
            <div class="mt-4 p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label small fw-bold text-secondary">Language</label>
                        <select id="code-type" class="form-select">
                            <option value="auto" selected>Auto-Detect</option>
                            <option value="javascript">JavaScript</option>
                            <option value="css">CSS</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label small fw-bold text-secondary">Indentation</label>
                        <select id="indent-size" class="form-select">
                            <option value="2">2 Spaces</option>
                            <option value="4" selected>4 Spaces</option>
                            <option value="8">8 Spaces</option>
                            <option value="\t">Tab</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label small fw-bold text-secondary">Brace Style</label>
                        <select id="brace-style" class="form-select">
                            <option value="collapse" selected>Collapse</option>
                            <option value="expand">Expand</option>
                            <option value="end-expand">End-Expand</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex flex-column justify-content-end">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="preserve-newlines" checked>
                            <label class="form-check-label small fw-semibold" for="preserve-newlines">Preserve Newlines</label>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-beautify" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-wand-magic-sparkles me-2"></i> Beautify Code
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-magic text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Beautified Result</h5>
                        <p class="text-muted small mb-0" id="stats-text">Clean and formatted code</p>
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
                        <i class="fas fa-copy me-1"></i> Copy Code
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="12" readonly placeholder="Your clean code will appear here..."></textarea>
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
        font-family: 'Fira Code', 'Monaco', 'Consolas', monospace;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .tool-textarea:focus { 
        border-color: var(--primary-color); 
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); 
    }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .transition-all { transition: all 0.2s ease; }
    
    .form-check-input:checked { background-color: var(--primary-color); border-color: var(--primary-color); }

    .form-control, .form-select { border: 1.5px solid var(--border-color); border-radius: 10px; padding: 0.625rem 0.75rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.14.7/beautify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.14.7/beautify-css.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const btnBeautify = document.getElementById('btn-beautify');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');
    const btnUndo = document.getElementById('btn-undo');
    const codeType = document.getElementById('code-type');
    const indentSelect = document.getElementById('indent-size');
    const braceStyle = document.getElementById('brace-style');
    const preserveNewlines = document.getElementById('preserve-newlines');
    const statsText = document.getElementById('stats-text');

    let history = [];

    function processBeautify() {
        const code = input.value;
        if (!code.trim()) return;

        if (output.value) {
            history.push(output.value);
            btnUndo.disabled = false;
        }

        btnBeautify.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Beautifying...';
        btnBeautify.disabled = true;

        setTimeout(() => {
            try {
                const options = {
                    indent_size: indentSelect.value === '\\t' ? 1 : parseInt(indentSelect.value),
                    indent_char: indentSelect.value === '\\t' ? '\t' : ' ',
                    max_preserve_newlines: 2,
                    preserve_newlines: preserveNewlines.checked,
                    brace_style: braceStyle.value,
                    indent_scripts: 'normal'
                };

                let result = '';
                let type = codeType.value;
                
                if (type === 'auto') {
                    // Simple detection: if it has {} and : it's likely CSS, else JS
                    type = (code.includes('{') && code.includes(':') && !code.includes('function')) ? 'css' : 'javascript';
                }

                if (type === 'css') {
                    result = css_beautify(code, options);
                } else {
                    result = js_beautify(code, options);
                }

                output.value = result;
                
                const size = (new Blob([result]).size / 1024).toFixed(2);
                statsText.textContent = `Type: ${type.toUpperCase()} | Size: ${size} KB | Lines: ${result.split('\n').length}`;
            } catch (e) {
                console.error(e);
                output.value = "Error: Code processing failed.";
            }
            btnBeautify.innerHTML = '<i class="fas fa-wand-magic-sparkles me-2"></i> Beautify Code';
            btnBeautify.disabled = false;
        }, 400);
    }

    btnBeautify.addEventListener('click', processBeautify);

    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        statsText.textContent = 'Clean and formatted code';
        history = [];
        btnUndo.disabled = true;
    });

    btnSample.addEventListener('click', () => {
        input.value = "body{background-color:#f0f0f0;font-family:Arial,sans-serif;}h1{color:#333;text-align:center;}function greet(name){if(name){console.log('Hello '+name);}else{console.log('Hello World');}}greet('ToolsHub');";
        processBeautify();
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
        let ext = (codeType.value === 'css' || (codeType.value === 'auto' && statsText.textContent.includes('CSS'))) ? 'css' : 'js';
        const blob = new Blob([output.value], { type: 'text/plain' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `beautified-${Date.now()}.${ext}`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    });
});
</script>


