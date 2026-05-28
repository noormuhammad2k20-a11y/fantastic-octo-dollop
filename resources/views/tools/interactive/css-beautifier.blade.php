<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="v-input" class="form-control tool-textarea mb-4" rows="10" placeholder=".class { color: red; padding: 10px; }"></textarea>
            
            <div class="p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <label class="small fw-bold text-muted text-uppercase mb-0">Indent:</label>
                            <select id="v-indent" class="form-select w-auto">
                                <option value="2">2 Spaces</option>
                                <option value="4" selected>4 Spaces</option>
                                <option value="tab">Tabs</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-beautify" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-sparkles me-2"></i> Beautify CSS
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div id="out-wrapper" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-magic text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Formatted Stylesheet</h5>
                        <p class="text-muted small mb-0">
                            Lines: <span id="out-lines">0</span> | Size: <span id="out-size">0 B</span>
                        </p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="copy-code" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2"></i> Copy CSS
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="p-4 rounded-4 bg-light border">
                <pre class="m-0"><code id="out-code" class="text-dark font-monospace small" style="white-space: pre-wrap; word-break: break-all;">/* Your beautified CSS will appear here */</code></pre>
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
        font-family: 'JetBrains Mono', 'Fira Code', monospace;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .tool-textarea:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .transition-all { transition: all 0.2s ease; }
    
    .form-check-input:checked { background-color: var(--primary-color); border-color: var(--primary-color); }

    .form-control, .form-select { border: 1.5px solid var(--border-color); border-radius: 10px; padding: 0.625rem 0.75rem; }
    .font-monospace { font-family: 'JetBrains Mono', 'Fira Code', monospace; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('v-input');
    const indentSelect = document.getElementById('v-indent');
    const outCode = document.getElementById('out-code');
    const outLines = document.getElementById('out-lines');
    const outSize = document.getElementById('out-size');
    const outWrapper = document.getElementById('out-wrapper');
    const btnBeautify = document.getElementById('btn-beautify');

    function beautifyCSS(css) {
        if (!css.trim()) return "";
        
        let indent = indentSelect.value === 'tab' ? '\t' : ' '.repeat(parseInt(indentSelect.value));
        let formatted = css
            .replace(/\s*([\{\}\:\;\,])\s*/g, "$1") // Remove unnecessary whitespace
            .replace(/\{/g, " {\n" + indent)
            .replace(/\}/g, "\n}\n")
            .replace(/\;/g, ";\n" + indent)
            .replace(/\,\s*/g, ", ")
            .replace(/\n\s*\n/g, "\n") // Remove double newlines
            .replace(/\s*$/g, "")
            .replace(/\n\s*\}/g, "\n}"); // Fix indentation before closing brace

        // Fix Nested blocks (media queries)
        let lines = formatted.split('\n');
        let level = 0;
        let result = [];
        lines.forEach(line => {
            line = line.trim();
            if (line.endsWith('}')) level--;
            result.push(indent.repeat(Math.max(0, level)) + line);
            if (line.endsWith('{')) level++;
        });

        return result.join('\n').trim();
    }

    function process() {
        const val = input.value;
        if (!val.trim()) {
            outWrapper.classList.add('d-none');
            return;
        }

        btnBeautify.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Beautifying...';
        btnBeautify.disabled = true;

        setTimeout(() => {
            const formatted = beautifyCSS(val);
            outCode.textContent = formatted;
            outLines.textContent = formatted.split('\n').length;
            outSize.textContent = new Blob([formatted]).size + ' B';
            outWrapper.classList.remove('d-none');
            outWrapper.scrollIntoView({ behavior: 'smooth' });
            
            btnBeautify.innerHTML = '<i class="fas fa-sparkles me-2"></i> Beautify CSS';
            btnBeautify.disabled = false;
        }, 400);
    }

    btnBeautify.addEventListener('click', process);

    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            input.value = btn.dataset.code;
            process();
        });
    });

    document.getElementById('clear-input').addEventListener('click', () => {
        input.value = '';
        outWrapper.classList.add('d-none');
    });

    document.getElementById('copy-code').addEventListener('click', function() {
        navigator.clipboard.writeText(outCode.textContent).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            this.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => {
                this.innerHTML = original;
                this.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>

