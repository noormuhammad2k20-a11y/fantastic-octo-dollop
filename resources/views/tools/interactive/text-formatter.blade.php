<div class="row g-4">
    {{-- Input Card --}}
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label-custom mb-0">Input Content</label>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light-custom" id="btn-sample" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-vial me-1"></i> Sample
                            </button>
                            <button class="btn btn-sm btn-light-custom" id="btn-clear" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-trash-alt me-1"></i> Clear
                            </button>
                        </div>
                    </div>
                    <textarea id="input-text" class="form-control tool-textarea" rows="8" placeholder="Paste your messy text here..."></textarea>
                </div>

                <div class="formatting-options p-4 rounded-4" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <h6 class="fw-bold text-dark mb-3 small text-uppercase letter-spacing-1">Cleaning Controls</h6>
                            <div class="d-flex flex-wrap gap-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="opt-trim" checked>
                                    <label class="form-check-label small fw-bold" for="opt-trim">Trim Lines</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="opt-empty" checked>
                                    <label class="form-check-label small fw-bold" for="opt-empty">Remove Empty Lines</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="opt-spaces" checked>
                                    <label class="form-check-label small fw-bold" for="opt-spaces">Normalize Spaces</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="opt-tags">
                                    <label class="form-check-label small fw-bold" for="opt-tags">Strip HTML Tags</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label-custom">Case Transformation</label>
                            <select id="case-select" class="form-select">
                                <option value="none" selected>Keep Original</option>
                                <option value="upper">UPPERCASE</option>
                                <option value="lower">lowercase</option>
                                <option value="title">Title Case</option>
                                <option value="sentence">Sentence case</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label-custom">Add Prefix</label>
                            <input type="text" id="prefix-input" class="form-control" placeholder="e.g. - ">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label-custom">Add Suffix</label>
                            <input type="text" id="suffix-input" class="form-control" placeholder="e.g. ,">
                        </div>
                        
                        <div class="col-12 text-center mt-2">
                            <button class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm transition-all" id="btn-format" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-magic me-2"></i> Apply Formatting
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,0.04);">
            <div class="output-header d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle fs-4 me-2" style="color:#4f46e5"></i>
                    <h6 class="fw-bold mb-0">Formatted Result</h6>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary" id="btn-undo" disabled>
                        <i class="fas fa-undo me-1"></i> Undo
                    </button>
                    <button class="btn btn-sm btn-outline-primary" id="btn-download" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download me-1"></i> Download
                    </button>
                    <button class="btn btn-primary btn-sm px-4" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Result
                    </button>
                </div>
            </div>
            
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="10" readonly placeholder="Formatted result will appear here..."></textarea>
            
            <div class="mt-3 p-3 bg-white rounded-3 border d-flex justify-content-between align-items-center small text-secondary">
                <div id="stats-text"><i class="fas fa-info-circle me-1"></i> Ready for transformation</div>
                <div class="badge bg-light text-primary border" id="mode-badge">Advanced Mode</div>
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
.form-control, .form-select { border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 0.75rem 1rem; }
.letter-spacing-1 { letter-spacing: 1px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const btnFormat = document.getElementById('btn-format');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');
    const btnUndo = document.getElementById('btn-undo');
    
    const optTrim = document.getElementById('opt-trim');
    const optEmpty = document.getElementById('opt-empty');
    const optSpaces = document.getElementById('opt-spaces');
    const optTags = document.getElementById('opt-tags');
    const caseSelect = document.getElementById('case-select');
    const prefixInput = document.getElementById('prefix-input');
    const suffixInput = document.getElementById('suffix-input');
    const statsText = document.getElementById('stats-text');

    let history = [];

    function applyFormat() {
        let text = input.value;
        if (!text.trim()) return;

        if (output.value) {
            history.push(output.value);
            btnUndo.disabled = false;
        }

        btnFormat.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing...';
        btnFormat.disabled = true;

        setTimeout(() => {
            if (optTags.checked) text = text.replace(/<[^>]*>?/gm, '');
            
            let lines = text.split(/\r?\n/);
            
            if (optTrim.checked) lines = lines.map(l => l.trim());
            if (optEmpty.checked) lines = lines.filter(l => l.length > 0);
            
            const prefix = prefixInput.value;
            const suffix = suffixInput.value;
            if (prefix || suffix) {
                lines = lines.map(l => prefix + l + suffix);
            }

            let result = lines.join('\n');
            
            if (optSpaces.checked) result = result.replace(/[ ]+/g, ' ');
            
            switch(caseSelect.value) {
                case 'upper': result = result.toUpperCase(); break;
                case 'lower': result = result.toLowerCase(); break;
                case 'title': result = result.toLowerCase().replace(/\b\w/g, l => l.toUpperCase()); break;
                case 'sentence': result = result.toLowerCase().replace(/(^\s*\w|[.!?]\s*\w)/g, c => c.toUpperCase()); break;
            }

            output.value = result;
            const words = result.trim() ? result.trim().split(/\s+/).length : 0;
            statsText.innerHTML = `<i class="fas fa-check-circle text-success me-1"></i> Words: <strong>${words}</strong> | Chars: <strong>${result.length}</strong> | Lines: <strong>${lines.length}</strong>`;

            btnFormat.innerHTML = '<i class="fas fa-magic me-2"></i> Apply Formatting';
            btnFormat.disabled = false;
            
            output.classList.add('border-primary');
            setTimeout(() => output.classList.remove('border-primary'), 500);
        }, 300);
    }

    btnFormat.addEventListener('click', applyFormat);

    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        statsText.innerHTML = '<i class="fas fa-info-circle me-1"></i> Ready for transformation';
        history = [];
        btnUndo.disabled = true;
    });

    btnSample.addEventListener('click', () => {
        input.value = "   hello   world   \n\n   this is a   messy   text   with <b>html</b> tags.   \n   another line here.   ";
        applyFormat();
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
        a.download = `formatted-${Date.now()}.txt`;
        a.click();
        URL.revokeObjectURL(url);
    });
});
</script>

