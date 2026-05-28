<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="v-input" class="form-control tool-textarea mb-4" rows="10" placeholder="id,name,email
1,John Doe,john@example.com
2,Jane Smith,jane@example.com"></textarea>
            
            <div class="p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                <div class="row g-4 align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex flex-wrap gap-4">
                            <div class="d-flex align-items-center gap-2">
                                <label class="small fw-bold text-muted text-uppercase mb-0">Delimiter:</label>
                                <select id="v-sep" class="form-select form-select-sm w-auto">
                                    <option value=",">Comma (,)</option>
                                    <option value=";">Semicolon (;)</option>
                                    <option value="\t">Tab (\t)</option>
                                    <option value="|">Pipe (|)</option>
                                </select>
                            </div>
                            <div class="form-check form-switch mt-1">
                                <input class="form-check-input" type="checkbox" id="v-header" checked>
                                <label class="form-check-label small fw-bold text-muted">Use Header Row</label>
                            </div>
                            <div class="form-check form-switch mt-1">
                                <input class="form-check-input" type="checkbox" id="v-minify">
                                <label class="form-check-label small fw-bold text-muted">Minify Result</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="convert-btn">
                            <i class="fas fa-bolt me-2"></i> Execute Mapping
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
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Mapping Successful</h5>
                        <p class="text-muted small mb-0" id="out-status">Ready for processing</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="copy-summary">
                        <i class="fas fa-copy me-1"></i> Copy JSON
                    </button>
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-4 fw-bold" id="download-btn">
                        <i class="fas fa-download me-1"></i> .JSON
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="p-4 rounded-4 bg-slate-900 border border-slate-800">
                <pre id="out-data" class="text-blue-400 font-monospace small mb-0 overflow-auto" style="max-height: 600px; white-space: pre-wrap; word-break: break-all;"></pre>
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
    
    .form-control, .form-select { border: 1.5px solid var(--border-color); border-radius: 10px; padding: 0.625rem 0.75rem; }
    .font-monospace { font-family: 'JetBrains Mono', 'Fira Code', monospace; }
    
    .bg-slate-900 { background-color: #0f172a; }
    .text-blue-400 { color: #60A5FA; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const inputE = document.getElementById('v-input');
    const sepE = document.getElementById('v-sep');
    const headerE = document.getElementById('v-header');
    const minifyE = document.getElementById('v-minify');
    const outData = document.getElementById('out-data');
    const outWrapper = document.getElementById('out-wrapper');
    const convertBtn = document.getElementById('convert-btn');

    function parseCSV(csv, sep) {
        const rows = csv.split(/\r?\n/).filter(r => r.trim());
        if (rows.length === 0) return [];
        
        const data = rows.map(row => {
            const result = [];
            let current = '';
            let inQuotes = false;
            for (let i = 0; i < row.length; i++) {
                const char = row[i];
                if (char === '"') inQuotes = !inQuotes;
                else if (char === sep && !inQuotes) {
                    result.push(current.trim());
                    current = '';
                } else current += char;
            }
            result.push(current.trim());
            return result;
        });
        return data;
    }

    function transform() {
        const raw = inputE.value.trim();
        if (!raw) return;

        convertBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Mapping...';
        convertBtn.disabled = true;

        setTimeout(() => {
            try {
                const sep = sepE.value === '\\t' ? '\t' : sepE.value;
                const rows = parseCSV(raw, sep);
                if (rows.length === 0) return;

                let result = [];
                if (headerE.checked) {
                    const headers = rows[0];
                    for (let i = 1; i < rows.length; i++) {
                        const obj = {};
                        rows[i].forEach((val, idx) => {
                            if (headers[idx]) {
                                let processedVal = val;
                                if (!isNaN(val) && val !== '') processedVal = parseFloat(val);
                                else if (val.toLowerCase() === 'true') processedVal = true;
                                else if (val.toLowerCase() === 'false') processedVal = false;
                                obj[headers[idx]] = processedVal;
                            }
                        });
                        result.push(obj);
                    }
                } else {
                    result = rows;
                }

                outData.textContent = JSON.stringify(result, null, minifyE.checked ? 0 : 4);
                outWrapper.classList.remove('d-none');
                outWrapper.scrollIntoView({ behavior: 'smooth' });
                document.getElementById('out-status').textContent = `MAPPING SUCCESSFUL: ${result.length} OBJECTS`;
            } catch (e) {
                alert('PARSING ERROR: ' + e.message);
            }
            convertBtn.innerHTML = '<i class="fas fa-bolt me-2"></i> Execute Mapping';
            convertBtn.disabled = false;
        }, 400);
    }

    convertBtn.addEventListener('click', transform);
    document.getElementById('v-clear').addEventListener('click', () => { 
        inputE.value = ''; 
        outWrapper.classList.add('d-none'); 
    });
    
    document.getElementById('v-file').addEventListener('change', e => {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = ev => { inputE.value = ev.target.result; transform(); };
        reader.readAsText(file);
    });

    document.getElementById('copy-summary').addEventListener('click', function(){
        navigator.clipboard.writeText(outData.textContent).then(() => {
            const o = this.innerHTML; 
            this.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
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
        a.href = url; a.download = 'transformed_data.json';
        a.click();
    });
});
</script>

