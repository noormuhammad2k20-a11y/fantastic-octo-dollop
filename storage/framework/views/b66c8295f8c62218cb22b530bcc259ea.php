<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="input-text" class="form-control tool-textarea mb-4" rows="8" placeholder="Paste your text or Base64 string here..."></textarea>
            
            <div class="p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <button class="btn btn-primary btn-lg rounded-pill px-4 flex-grow-1 shadow-sm transition-all" id="btn-encode" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-arrow-down me-2"></i> Encode
                            </button>
                            <button class="btn btn-outline-primary btn-lg rounded-pill px-4 flex-grow-1 transition-all" id="btn-decode" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-arrow-up me-2"></i> Decode
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-wrap gap-4 justify-content-md-end">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check-urlsafe">
                                <label class="form-check-label small fw-semibold" for="check-urlsafe">URL Safe</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check-live" checked>
                                <label class="form-check-label small fw-semibold" for="check-live">Live Sync</label>
                            </div>
                        </div>
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
                        <i class="fas fa-code text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Processed Result</h5>
                        <p class="text-muted small mb-0" id="stats-text">Your output is ready for use</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" id="btn-undo" disabled>
                        <i class="fas fa-undo me-1"></i> Undo
                    </button>
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3" id="btn-download" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download me-1"></i> Download
                    </button>
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Result
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <textarea id="output-text" class="form-control tool-textarea bg-white font-monospace" rows="8" readonly placeholder="Result will appear here..."></textarea>
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
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        line-height: 1.6;
    }

    .tool-textarea:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .transition-all { transition: all 0.2s ease; }
    
    .form-check-input:checked { background-color: var(--primary-color); border-color: var(--primary-color); }

    .form-control, .form-select { border: 1.5px solid var(--border-color); border-radius: 10px; padding: 0.625rem 0.75rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const btnEncode = document.getElementById('btn-encode');
    const btnDecode = document.getElementById('btn-decode');
    const btnClear = document.getElementById('btn-clear');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');
    const btnUndo = document.getElementById('btn-undo');
    
    const checkUrlSafe = document.getElementById('check-urlsafe');
    const checkLive = document.getElementById('check-live');
    const statsText = document.getElementById('stats-text');

    let history = [];
    let lastMode = 'encode';

    function encode(str) {
        try {
            let encoded = btoa(unescape(encodeURIComponent(str)));
            if (checkUrlSafe.checked) {
                encoded = encoded.replace(/\+/g, '-').replace(/\//g, '_').replace(/=+$/, '');
            }
            return encoded;
        } catch (e) {
            return "Error: " + e.message;
        }
    }

    function decode(str) {
        try {
            let val = str.trim();
            if (checkUrlSafe.checked) {
                val = val.replace(/-/g, '+').replace(/_/g, '/');
                while (val.length % 4) val += '=';
            }
            return decodeURIComponent(escape(atob(val)));
        } catch (e) {
            return "Error: Invalid Base64 input.";
        }
    }

    function process(mode) {
        if (!input.value) {
            output.value = '';
            return;
        }

        if (output.value && mode !== lastMode) {
            history.push(output.value);
            btnUndo.disabled = false;
        }
        lastMode = mode;

        output.value = (mode === 'encode') ? encode(input.value) : decode(input.value);
        statsText.textContent = `Processing complete | Result size: ${output.value.length} chars`;
    }

    btnEncode.addEventListener('click', () => process('encode'));
    btnDecode.addEventListener('click', () => process('decode'));

    input.addEventListener('input', () => {
        if (checkLive.checked) process(lastMode);
    });

    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        statsText.textContent = 'Your output is ready for use';
        history = [];
        btnUndo.disabled = true;
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
        const blob = new Blob([output.value], { type: 'text/plain' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `base64-export-${Date.now()}.txt`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\base64-encode-decode.blade.php ENDPATH**/ ?>