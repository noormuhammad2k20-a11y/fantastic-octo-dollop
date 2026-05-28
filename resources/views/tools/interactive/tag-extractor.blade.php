<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="text-input" class="form-control tool-textarea mb-4" rows="8" placeholder="Paste your HTML code, blog post, or raw text here..."></textarea>
            
            <div class="p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-secondary">Extraction Logic</label>
                        <select id="extract-type" class="form-select">
                            <option value="hashtag" selected>#️⃣ Hashtag Extraction</option>
                            <option value="keyword">🔑 Semantic Keywords</option>
                            <option value="meta">🧬 Meta Tags (SEO)</option>
                            <option value="html-tag">🏷️ Specific HTML Tag</option>
                            <option value="html-attr">🔗 Specific Attribute</option>
                        </select>
                    </div>
                    
                    <div id="extra-param-wrapper" class="col-md-4 d-none">
                        <label class="form-label small fw-bold text-secondary" id="param-label">Tag Name</label>
                        <input type="text" id="extra-param" class="form-control" placeholder="e.g. img">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-secondary">Output Casing</label>
                        <select id="case-select" class="form-select">
                            <option value="none" selected>Original</option>
                            <option value="lower">lowercase</option>
                            <option value="upper">UPPERCASE</option>
                            <option value="capital">Capitalized</option>
                        </select>
                    </div>

                    <div class="col-12 text-center mt-2">
                        <button class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm transition-all" id="btn-extract" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-bolt me-2"></i> Execute Deep Scan
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
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Identified Metadata</h5>
                        <p class="text-muted small mb-0" id="stats-text">Metadata stream ready for export</p>
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
                        <i class="fas fa-copy me-1"></i> Copy Stream
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div id="tag-cloud" class="d-flex flex-wrap gap-2 mb-4 p-3 rounded-4 bg-light border min-h-100">
                <span class="text-muted small">No tags identified yet.</span>
            </div>
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="6" readonly placeholder="Raw extraction result..."></textarea>
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

    .btn-light-custom { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-custom:hover { background: #e2e8f0; color: #1e293b; }

    .min-h-100 { min-height: 100px; }

    .transition-all { transition: all 0.2s ease; }
    
    .form-control, .form-select { border: 1.5px solid var(--border-color); border-radius: 10px; padding: 0.625rem 0.75rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('text-input');
    const output = document.getElementById('output-text');
    const tagCloud = document.getElementById('tag-cloud');
    const btnExtract = document.getElementById('btn-extract');
    const btnClear = document.getElementById('btn-clear');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');
    const btnUndo = document.getElementById('btn-undo');
    
    const extractType = document.getElementById('extract-type');
    const extraParam = document.getElementById('extra-param');
    const paramLabel = document.getElementById('param-label');
    const paramWrapper = document.getElementById('extra-param-wrapper');
    const caseSelect = document.getElementById('case-select');
    const statsText = document.getElementById('stats-text');

    let history = [];

    extractType.addEventListener('change', () => {
        const type = extractType.value;
        if (type === 'html-tag') {
            paramWrapper.classList.remove('d-none');
            paramLabel.textContent = 'Tag Name (e.g. img)';
        } else if (type === 'html-attr') {
            paramWrapper.classList.remove('d-none');
            paramLabel.textContent = 'Attribute (e.g. href)';
        } else {
            paramWrapper.classList.add('d-none');
        }
    });

    function extract() {
        const raw = input.value.trim();
        if (!raw) return;

        if (output.value) {
            history.push(output.value);
            btnUndo.disabled = false;
        }

        btnExtract.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Scanning...';
        btnExtract.disabled = true;

        setTimeout(() => {
            const type = extractType.value;
            let tags = [];

            if (type === 'hashtag') {
                tags = raw.match(/#[a-zA-Z0-9_]+/g) || [];
                tags = tags.map(t => t.slice(1));
            } else if (type === 'meta') {
                const parser = new DOMParser();
                const doc = parser.parseFromString(raw, 'text/html');
                const metas = doc.querySelectorAll('meta[name="keywords"], meta[name="description"], meta[property^="og:"]');
                metas.forEach(m => {
                    const content = m.getAttribute('content');
                    if (content) {
                        if (m.getAttribute('name') === 'keywords') tags.push(...content.split(',').map(s => s.trim()));
                        else tags.push(content);
                    }
                });
            } else if (type === 'html-tag') {
                const tagName = extraParam.value || 'div';
                const parser = new DOMParser();
                const doc = parser.parseFromString(raw, 'text/html');
                const elements = doc.querySelectorAll(tagName);
                elements.forEach(el => tags.push(el.outerHTML));
            } else if (type === 'html-attr') {
                const attrName = extraParam.value || 'href';
                const parser = new DOMParser();
                const doc = parser.parseFromString(raw, 'text/html');
                const elements = doc.querySelectorAll(`[${attrName}]`);
                elements.forEach(el => tags.push(el.getAttribute(attrName)));
            } else {
                // Keywords
                const clean = raw.replace(/[^\w\s]/g, ' ').toLowerCase();
                const words = clean.split(/\s+/).filter(w => w.length >= 4);
                const freq = {};
                words.forEach(w => freq[w] = (freq[w] || 0) + 1);
                tags = Object.keys(freq).sort((a,b) => freq[b] - freq[a]).slice(0, 30);
            }

            // Uniq
            tags = [...new Set(tags)].filter(t => t);

            // Casing
            const casing = caseSelect.value;
            if (casing === 'lower') tags = tags.map(t => t.toLowerCase());
            else if (casing === 'upper') tags = tags.map(t => t.toUpperCase());
            else if (casing === 'capital') tags = tags.map(t => t.charAt(0).toUpperCase() + t.slice(1).toLowerCase());

            output.value = tags.join(', ');
            tagCloud.innerHTML = tags.map(t => `<span class="badge bg-primary-soft text-primary border rounded-pill px-3 py-2 shadow-sm">${t.substring(0, 30)}${t.length > 30 ? '...' : ''}</span>`).join('');
            if (tags.length === 0) tagCloud.innerHTML = '<span class="text-muted small">No tags identified.</span>';
            
            statsText.textContent = `${tags.length} items identified | Scan complete`;

            btnExtract.innerHTML = '<i class="fas fa-bolt me-2"></i> Execute Deep Scan';
            btnExtract.disabled = false;
        }, 400);
    }

    btnExtract.addEventListener('click', extract);

    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        tagCloud.innerHTML = '<span class="text-muted small">No tags identified yet.</span>';
        statsText.textContent = 'Metadata stream ready for export';
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
        a.download = `extracted-metadata-${Date.now()}.txt`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    });
});
</script>

