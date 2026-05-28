<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="input-text" class="form-control tool-textarea" rows="10" placeholder="<html><body>...</body></html>"></textarea>
            
            <div class="mt-4 p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                <div class="row g-4">
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
                        <label class="form-label small fw-bold text-secondary">Max Wrap</label>
                        <input type="number" id="wrap-line-length" class="form-control" value="0" min="0" placeholder="0 for no wrap">
                    </div>
                    <div class="col-lg-6 col-md-12 d-flex flex-column justify-content-end">
                        <div class="d-flex flex-wrap gap-3 mb-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="indent-inner-html">
                                <label class="form-check-label small fw-semibold" for="indent-inner-html">Indent <head> & <body></label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="wrap-attributes" checked>
                                <label class="form-check-label small fw-semibold" for="wrap-attributes">Wrap Attributes</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="unformatted">
                                <label class="form-check-label small fw-semibold" for="unformatted">Inline Scripts</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-beautify" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-sparkles me-2"></i> Beautify HTML
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
                        <i class="fas fa-magic text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Cleaned HTML Result</h5>
                        <p class="text-muted small mb-0" id="stats-text">Ready for production</p>
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
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="12" readonly placeholder="Your beautified code will appear here..."></textarea>
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
        line-height: 1.5;
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.14.7/beautify-html.min.js"></script>
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
    const indentSelect = document.getElementById('indent-size');
    const wrapLimitInput = document.getElementById('wrap-line-length');
    const indentInnerHtml = document.getElementById('indent-inner-html');
    const wrapAttributes = document.getElementById('wrap-attributes');
    const unformatted = document.getElementById('unformatted');
    const statsText = document.getElementById('stats-text');

    let history = [];

    function processHTML() {
        const html = input.value;
        if (!html.trim()) return;

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
                    preserve_newlines: true,
                    keep_array_indentation: false,
                    break_chained_methods: false,
                    indent_scripts: unformatted.checked ? 'keep' : 'normal',
                    brace_style: "collapse",
                    space_before_conditional: true,
                    unescape_strings: false,
                    jslint_happy: false,
                    end_with_newline: false,
                    wrap_line_length: parseInt(wrapLimitInput.value) || 0,
                    indent_inner_html: indentInnerHtml.checked,
                    comma_first: false,
                    e4x: false,
                    indent_empty_lines: false,
                    wrap_attributes: wrapAttributes.checked ? 'force-expand-multiline' : 'auto'
                };

                const result = html_beautify(html, options);
                output.value = result;
                
                const size = (new Blob([result]).size / 1024).toFixed(2);
                statsText.textContent = `Size: ${size} KB | Lines: ${result.split('\n').length}`;
            } catch (e) {
                console.error(e);
                output.value = "Error: Invalid HTML structure.";
            }
            btnBeautify.innerHTML = '<i class="fas fa-sparkles me-2"></i> Beautify HTML';
            btnBeautify.disabled = false;
        }, 400);
    }

    btnBeautify.addEventListener('click', processHTML);

    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        statsText.textContent = 'Ready for production';
        history = [];
        btnUndo.disabled = true;
    });

    btnSample.addEventListener('click', () => {
        input.value = "<!DOCTYPE html><html><head><title>Sample</title></head><body><div class=\"container\"><h1>Hello World</h1><p>This is a <b>minified</b> snippet of HTML code that needs proper indentation and cleanup.</p><ul><li>Item 1</li><li>Item 2</li><li>Item 3</li></ul><form><input type=\"text\" name=\"user\" placeholder=\"Username\"><button type=\"submit\">Submit</button></form></div><script>console.log('Hello');<\/script></body></html>";
        processHTML();
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
        const blob = new Blob([output.value], { type: 'text/html' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `beautified-${Date.now()}.html`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    });
});
</script>


<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\html-beautifier.blade.php ENDPATH**/ ?>