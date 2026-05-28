<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0" style="background: #0f172a; color: #f8fafc;">
        <div class="card-header-v2 border-bottom-0 py-4 px-4" style="background: rgba(255,255,255,0.02);">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background: rgba(14, 165, 233, 0.1); border: 1px solid rgba(14, 165, 233, 0.2);">
                        <i class="fas fa-file-code text-sky"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-white">JSON → YAML Config Bridge</h5>
                        <p class="text-slate-400 small mb-0">Transform API responses into human-readable configuration manifests</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-slate-800 btn-sm rounded-pill px-3 fw-bold" id="v-beautify">
                        <i class="fas fa-magic me-1"></i> Beautify
                    </button>
                    <button class="btn btn-slate-800 btn-sm rounded-pill px-3 fw-bold" id="v-clear">
                        <i class="fas fa-trash-alt me-1"></i> Clear
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 px-4 pb-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="v-input" class="form-control tool-textarea-dark mb-4" rows="10" placeholder='{
  "project": "ToolsHub",
  "version": 2.0,
  "active": true,
  "tags": ["saas", "devops"]
}'></textarea>
            
            <div class="p-4 rounded-4" style="background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(51, 65, 85, 0.5);">
                <div class="row g-4 align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex flex-wrap gap-4">
                            <div class="d-flex align-items-center gap-2">
                                <label class="small fw-bold text-slate-400 text-uppercase mb-0">Indent:</label>
                                <select id="v-indent" class="form-select form-select-sm bg-slate-800 border-slate-700 text-white w-auto">
                                    <option value="2">2 Spaces</option>
                                    <option value="4">4 Spaces</option>
                                </select>
                            </div>
                            <div class="form-check form-switch mt-1">
                                <input class="form-check-input" type="checkbox" id="v-quotes">
                                <label class="form-check-label small fw-bold text-slate-400">Always Quote</label>
                            </div>
                            <div class="form-check form-switch mt-1">
                                <input class="form-check-input" type="checkbox" id="v-markers" checked>
                                <label class="form-check-label small fw-bold text-slate-400">Array Markers</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <button class="btn btn-sky btn-lg rounded-pill px-5 shadow-sm" id="convert-btn">
                            <i class="fas fa-exchange-alt me-2"></i> Map to YAML
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div id="out-wrapper" class="card tool-card-stacked shadow-sm border-0 d-none" style="background: #0f172a; color: #f8fafc;">
        <div class="card-header-v2 border-bottom-0 py-4 px-4" style="background: rgba(255,255,255,0.02);">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2);">
                        <i class="fas fa-check text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-white">Generated YAML</h5>
                        <p class="text-slate-400 small mb-0">Config manifest ready for deployment</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm fw-bold" id="copy-summary">
                        <i class="fas fa-copy me-2"></i> Copy
                    </button>
                    <button class="btn btn-outline-slate btn-sm rounded-pill px-4 fw-bold" id="download-btn">
                        <i class="fas fa-download me-2"></i> .YAML
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 px-4 pb-4">
            <div class="p-4 rounded-4 bg-slate-900 border border-slate-800">
                <pre id="out-data" class="text-sky font-monospace small mb-0 overflow-auto" style="max-height: 600px; white-space: pre-wrap; word-break: break-all;"></pre>
            </div>
        </div>
    </div>
</div>

<style>
    .text-sky { color: #38bdf8 !important; }
    .bg-slate-800 { background-color: #1e293b !important; }
    .btn-slate-800 { background: #1e293b; color: #94a3b8; border: 1px solid #334155; }
    .btn-slate-800:hover { background: #334155; color: #f8fafc; }
    
    .btn-outline-slate { border: 1px solid #334155; color: #94a3b8; }
    .btn-outline-slate:hover { background: #1e293b; color: #f8fafc; }

    .btn-sky { background: #0ea5e9; color: #fff; border: none; }
    .btn-sky:hover { background: #0284c7; }

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
        color: #38bdf8;
        transition: all 0.3s ease; 
        font-family: 'JetBrains Mono', 'Fira Code', monospace;
        font-size: 0.9rem;
        line-height: 1.6;
    }
    .tool-textarea-dark:focus { border-color: #0ea5e9; box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1); background: #0f172a; outline: none; }

    .font-monospace { font-family: 'JetBrains Mono', 'Fira Code', monospace; }
    .transition-all { transition: all 0.2s ease; }
    
    .form-check-input { background-color: #334155; border-color: #475569; }
    .form-check-input:checked { background-color: #0ea5e9; border-color: #0ea5e9; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const inputE = document.getElementById('v-input');
    const indentE = document.getElementById('v-indent');
    const quoteE = document.getElementById('v-quotes');
    const markersE = document.getElementById('v-markers');
    const outData = document.getElementById('out-data');
    const outWrapper = document.getElementById('out-wrapper');
    const convertBtn = document.getElementById('convert-btn');

    function jsonToYaml(obj, depth = 0) {
        let yaml = '';
        const indentStr = ' '.repeat(depth * parseInt(indentE.value));
        
        for (let key in obj) {
            if (obj.hasOwnProperty(key)) {
                let val = obj[key];
                let keyStr = key;
                if (quoteE.checked) keyStr = `"${key}"`;

                if (Array.isArray(val)) {
                    yaml += `${indentStr}${keyStr}:\n`;
                    val.forEach(item => {
                        const marker = markersE.checked ? '- ' : '  ';
                        if (typeof item === 'object' && item !== null) {
                            yaml += `${indentStr}${marker}${jsonToYaml(item, depth + 1).trim().replace(/\n/g, '\n' + indentStr + '  ')}\n`;
                        } else {
                            yaml += `${indentStr}${marker}${item}\n`;
                        }
                    });
                } else if (typeof val === 'object' && val !== null) {
                    yaml += `${indentStr}${keyStr}:\n${jsonToYaml(val, depth + 1)}`;
                } else {
                    let valStr = val;
                    if (typeof val === 'string' && (val.includes('\n') || quoteE.checked)) valStr = `"${val}"`;
                    yaml += `${indentStr}${keyStr}: ${valStr}\n`;
                }
            }
        }
        return yaml;
    }

    convertBtn.addEventListener('click', () => {
        const raw = inputE.value.trim();
        if (!raw) return;

        convertBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Mapping...';
        convertBtn.disabled = true;

        setTimeout(() => {
            try {
                const data = JSON.parse(raw);
                const res = jsonToYaml(data);
                outData.textContent = res;
                outWrapper.classList.remove('d-none');
                outWrapper.scrollIntoView({ behavior: 'smooth' });
            } catch (e) {
                alert('JSON SYNTAX ERROR: ' + e.message);
            }
            convertBtn.innerHTML = '<i class="fas fa-exchange-alt me-2"></i> Map to YAML';
            convertBtn.disabled = false;
        }, 400);
    });

    document.getElementById('v-beautify').addEventListener('click', () => {
        try { inputE.value = JSON.stringify(JSON.parse(inputE.value), null, 4); } catch(e){}
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
        const blob = new Blob([outData.textContent], {type: 'text/yaml'});
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url; a.download = 'config.yaml';
        a.click();
    });
});
</script>

