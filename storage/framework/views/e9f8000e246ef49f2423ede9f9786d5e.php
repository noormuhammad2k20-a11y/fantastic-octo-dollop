<div class="row g-4">
    
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label-custom mb-0">Input List (One item per line)</label>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light-custom" id="btn-sample" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-vial me-1"></i> Sample
                            </button>
                            <button class="btn btn-sm btn-light-custom" id="btn-clear" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-trash-alt me-1"></i> Clear
                            </button>
                        </div>
                    </div>
                    <textarea id="input-text" class="form-control tool-textarea" rows="10" placeholder="Item 1&#10;Item 2&#10;Item 3..."></textarea>
                </div>

                <div class="options-grid p-4 rounded-4" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label-custom">Quick Actions</label>
                            <div class="d-flex flex-wrap gap-2">
                                <button class="btn btn-outline-primary btn-sm rounded-pill px-3" onclick="manipulate('sort-az')"><i class="fas fa-sort-alpha-down me-1"></i> Sort A-Z</button>
                                <button class="btn btn-outline-primary btn-sm rounded-pill px-3" onclick="manipulate('sort-za')"><i class="fas fa-sort-alpha-up me-1"></i> Sort Z-A</button>
                                <button class="btn btn-outline-primary btn-sm rounded-pill px-3" onclick="manipulate('reverse')"><i class="fas fa-undo-alt me-1"></i> Reverse</button>
                                <button class="btn btn-outline-primary btn-sm rounded-pill px-3" onclick="manipulate('shuffle')"><i class="fas fa-random me-1"></i> Shuffle</button>
                                <button class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="manipulate('dedupe')"><i class="fas fa-clone me-1"></i> Remove Duplicates</button>
                                <button class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="manipulate('clean')"><i class="fas fa-broom me-1"></i> Remove Empty</button>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label-custom">Prefix</label>
                            <input type="text" id="prefix" class="form-control" placeholder="e.g. - ">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Suffix</label>
                            <input type="text" id="suffix" class="form-control" placeholder="e.g. ,">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Output Format</label>
                            <select id="format-select" class="form-select">
                                <option value="list" selected>Normal List (New Line)</option>
                                <option value="comma">Comma Separated</option>
                                <option value="json">JSON Array</option>
                                <option value="sql">SQL List (IN clause)</option>
                                <option value="php">PHP Array</option>
                                <option value="numbered">Numbered List</option>
                            </select>
                        </div>
                        
                        <div class="col-12 mt-4 text-end">
                            <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" id="btn-process" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-magic me-2"></i> Process and Generate
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
                    <i class="fas fa-check-circle fs-4 me-2" style="color:#4f46e5"></i>
                    <h6 class="fw-bold mb-0">Processed Result</h6>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-light-custom" id="btn-undo" disabled>
                        <i class="fas fa-undo"></i>
                    </button>
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
                <div id="stats-text"><i class="fas fa-info-circle me-1"></i> Ready to process</div>
                <div class="badge bg-light text-primary border" id="item-count-badge">Items: 0</div>
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
    const btnProcess = document.getElementById('btn-process');
    const btnClear = document.getElementById('btn-clear');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');
    const btnUndo = document.getElementById('btn-undo');
    const statsText = document.getElementById('stats-text');

    let history = [];

    window.manipulate = function(action) {
        let items = input.value.split(/\r?\n/).filter(i => i.trim().length > 0);
        if (items.length === 0) return;

        switch(action) {
            case 'sort-az': items.sort((a,b) => a.localeCompare(b)); break;
            case 'sort-za': items.sort((a,b) => b.localeCompare(a)); break;
            case 'reverse': items.reverse(); break;
            case 'shuffle': 
                for (let i = items.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [items[i], items[j]] = [items[j], items[i]];
                }
                break;
            case 'dedupe': items = [...new Set(items)]; break;
            case 'clean': items = items.filter(i => i.trim() !== ''); break;
        }
        input.value = items.join('\n');
        processList();
    };

    function processList() {
        const text = input.value.trim();
        if (!text) {
            output.value = '';
            document.getElementById('item-count-badge').textContent = 'Items: 0';
            return;
        }

        if (output.value) {
            history.push(output.value);
            btnUndo.disabled = false;
        }

        const items = text.split(/\r?\n/).map(i => i.trim()).filter(i => i.length > 0);
        const prefix = document.getElementById('prefix').value;
        const suffix = document.getElementById('suffix').value;
        const format = document.getElementById('format-select').value;

        let processed = items.map(i => prefix + i + suffix);
        let result = '';

        switch(format) {
            case 'list': result = processed.join('\n'); break;
            case 'comma': result = processed.join(', '); break;
            case 'json': result = JSON.stringify(processed, null, 2); break;
            case 'sql': result = `IN ('${processed.join("', '")}')`; break;
            case 'php': result = `['${processed.join("', '")}']`; break;
            case 'numbered': result = processed.map((v,i) => `${i+1}. ${v}`).join('\n'); break;
        }

        output.value = result;
        document.getElementById('item-count-badge').textContent = `Items: ${items.length}`;
        statsText.innerHTML = `<i class="fas fa-check text-success me-1"></i> Processed ${items.length} items successfully.`;
    }

    btnProcess.addEventListener('click', processList);
    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        document.getElementById('item-count-badge').textContent = 'Items: 0';
        statsText.innerHTML = '<i class="fas fa-info-circle me-1"></i> Ready to process';
        history = [];
        btnUndo.disabled = true;
    });

    document.getElementById('btn-sample').addEventListener('click', () => {
        input.value = "Apple\nOrange\nBanana\nCherry\nDate";
        processList();
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
        a.download = `list-${Date.now()}.txt`;
        a.click();
        URL.revokeObjectURL(url);
    });
});
</script>


<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\list-tools.blade.php ENDPATH**/ ?>