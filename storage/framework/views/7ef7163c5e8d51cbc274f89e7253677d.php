<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0" style="background: #0f172a; color: #f8fafc;">
        <div class="card-header-v2 border-bottom-0 py-4 px-4" style="background: rgba(255,255,255,0.02);">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background: rgba(79, 70, 229, 0.1); border: 1px solid rgba(79, 70, 229, 0.2);">
                        <i class="fas fa-file-code text-indigo"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-white">YAML → JSON Bridge</h5>
                        <p class="text-slate-400 small mb-0">Deconstruct human-readable YAML into structured JSON</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-slate-800 btn-sm rounded-pill px-3 fw-bold" id="v-sample">
                        <i class="fas fa-vial me-1"></i> Sample
                    </button>
                    <button class="btn btn-slate-800 btn-sm rounded-pill px-3 fw-bold" id="v-clear">
                        <i class="fas fa-trash-alt me-1"></i> Clear
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 px-4 pb-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="v-input" class="form-control tool-textarea-dark mb-4" rows="10" placeholder="project: ToolsHub
version: 1.0
active: true
tags:
  - saas
  - utility"></textarea>
            
            <div class="p-4 rounded-4" style="background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(51, 65, 85, 0.5);">
                <div class="row g-4 align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex flex-wrap gap-4">
                            <div class="form-check form-switch mt-1">
                                <input class="form-check-input" type="checkbox" id="v-minify">
                                <label class="form-check-label small fw-bold text-slate-400">Minify JSON</label>
                            </div>
                            <div class="form-check form-switch mt-1">
                                <input class="form-check-input" type="checkbox" id="v-typed" checked>
                                <label class="form-check-label small fw-bold text-slate-400">Preserve Types</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <button class="btn btn-indigo btn-lg rounded-pill px-5 shadow-sm" id="convert-btn">
                            <i class="fas fa-bolt me-2"></i> Map to JSON
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div id="out-wrapper" class="card tool-card-stacked shadow-sm border-0 d-none" style="background: #0f172a; color: #f8fafc;">
        <div class="card-header-v2 border-bottom-0 py-4 px-4" style="background: rgba(255,255,255,0.02);">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2);">
                        <i class="fas fa-check text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-white">Parsed JSON</h5>
                        <p class="text-slate-400 small mb-0">Structured data object ready for use</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm fw-bold" id="copy-summary">
                        <i class="fas fa-copy me-2"></i> Copy
                    </button>
                    <button class="btn btn-outline-slate btn-sm rounded-pill px-4 fw-bold" id="download-btn">
                        <i class="fas fa-download me-2"></i> .JSON
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 px-4 pb-4">
            <div class="p-4 rounded-4 bg-slate-900 border border-slate-800">
                <pre id="out-data" class="text-indigo font-monospace small mb-0 overflow-auto" style="max-height: 600px; white-space: pre-wrap; word-break: break-all;"></pre>
            </div>
        </div>
    </div>
</div>

<style>
    .text-indigo { color: #818cf8 !important; }
    .bg-slate-800 { background-color: #1e293b !important; }
    .btn-slate-800 { background: #1e293b; color: #94a3b8; border: 1px solid #334155; }
    .btn-slate-800:hover { background: #334155; color: #f8fafc; }
    
    .btn-outline-slate { border: 1px solid #334155; color: #94a3b8; }
    .btn-outline-slate:hover { background: #1e293b; color: #f8fafc; }

    .btn-indigo { background: #6366f1; color: #fff; border: none; }
    .btn-indigo:hover { background: #4f46e5; }

    .tool-card-stacked { border-radius: 24px; }
    .icon-box { 
        width: 48px; 
        height: 48px; 
        border-radius: 14px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 1.25rem;
    }

    .tool-textarea-dark { 
        border: 1.5px solid #334155; 
        border-radius: 16px; 
        padding: 1.25rem; 
        background: #1e293b; 
        color: #a5b4fc;
        transition: all 0.3s ease; 
        font-family: 'JetBrains Mono', 'Fira Code', monospace;
        font-size: 0.9rem;
        line-height: 1.6;
    }
    .tool-textarea-dark:focus { border-color: #6366f1; box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); background: #0f172a; outline: none; }

    .font-monospace { font-family: 'JetBrains Mono', 'Fira Code', monospace; }
    .transition-all { transition: all 0.2s ease; }
    
    .form-check-input { background-color: #334155; border-color: #475569; }
    .form-check-input:checked { background-color: #6366f1; border-color: #6366f1; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const inputE = document.getElementById('v-input');
    const minifyE = document.getElementById('v-minify');
    const typedE = document.getElementById('v-typed');
    const outData = document.getElementById('out-data');
    const outWrapper = document.getElementById('out-wrapper');
    const convertBtn = document.getElementById('convert-btn');

    function yamlToJson(yaml) {
        const lines = yaml.split('\n');
        const root = {};
        const stack = [{ indent: -1, obj: root, isArray: false }];

        lines.forEach(line => {
            if (!line.trim() || line.startsWith('#')) return;
            
            const indent = line.search(/\S/);
            const content = line.trim();
            
            // Pop stack to correct parent level
            while (stack.length > 1 && stack[stack.length - 1].indent >= indent) {
                stack.pop();
            }

            const parent = stack[stack.length - 1].obj;

            if (content.startsWith('- ')) {
                // Array item
                const val = content.substring(2).trim();
                const parentKey = Object.keys(parent).pop();
                if (parentKey && !Array.isArray(parent[parentKey])) {
                    parent[parentKey] = [];
                }
                if (parentKey) {
                    let processedVal = val;
                    if (typedE.checked) {
                        if (val.toLowerCase() === 'true') processedVal = true;
                        else if (val.toLowerCase() === 'false') processedVal = false;
                        else if (!isNaN(val) && val !== '') processedVal = parseFloat(val);
                        else if (val.startsWith('"') && val.endsWith('"')) processedVal = val.slice(1, -1);
                    }
                    parent[parentKey].push(processedVal);
                }
            } else {
                const colonIdx = content.indexOf(':');
                if (colonIdx >= 0) {
                    const key = content.substring(0, colonIdx).trim();
                    const val = content.substring(colonIdx + 1).trim();
                    
                    if (val === '') {
                        parent[key] = {};
                        stack.push({ indent: indent, obj: parent[key], isArray: false });
                    } else {
                        let processedVal = val;
                        if (typedE.checked) {
                            if (val.toLowerCase() === 'true') processedVal = true;
                            else if (val.toLowerCase() === 'false') processedVal = false;
                            else if (!isNaN(val) && val !== '') processedVal = parseFloat(val);
                            else if (val.startsWith('"') && val.endsWith('"')) processedVal = val.slice(1, -1);
                        }
                        parent[key] = processedVal;
                    }
                }
            }
        });
        return root;
    }

    convertBtn.addEventListener('click', () => {
        const raw = inputE.value.trim();
        if (!raw) return;

        convertBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Mapping...';
        convertBtn.disabled = true;

        setTimeout(() => {
            try {
                const res = yamlToJson(raw);
                outData.textContent = JSON.stringify(res, null, minifyE.checked ? 0 : 4);
                outWrapper.classList.remove('d-none');
                outWrapper.scrollIntoView({ behavior: 'smooth' });
            } catch (e) {
                alert('PARSING ERROR: ' + e.message);
            }
            convertBtn.innerHTML = '<i class="fas fa-bolt me-2"></i> Map to JSON';
            convertBtn.disabled = false;
        }, 400);
    });

    document.getElementById('v-sample').addEventListener('click', () => {
        inputE.value = "api: v1\nkind: Deployment\nmetadata:\n  name: toolshub\n  labels:\n    app: web\nspec:\n  replicas: 3";
        convertBtn.click();
    });

    document.getElementById('v-clear').addEventListener('click', () => { 
        inputE.value = ''; 
        outWrapper.classList.add('d-none'); 
    });

    document.getElementById('copy-summary').addEventListener('click', function(){
        navigator.clipboard.writeText(outData.textContent).then(() => {
            const o = this.innerHTML; 
            this.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            this.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => {
                this.innerHTML = o;
                this.classList.replace('btn-dark', 'btn-success');
            }, 1500);
        });
    });

    document.getElementById('download-btn').addEventListener('click', () => {
        const blob = new Blob([outData.textContent], {type: 'application/json'});
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url; a.download = 'data.json';
        a.click();
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\yaml-to-json-converter.blade.php ENDPATH**/ ?>