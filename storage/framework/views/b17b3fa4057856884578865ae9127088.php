<div class="row g-4 md-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(59, 130, 246, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #1e293b, #0f172a); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fab fa-markdown"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#0f172a; letter-spacing: -0.5px;">Markdown → HTML Alchemist</h4>
                    <p class="text-muted small mb-0">Transform semantic markdown into production-ready HTML code. Perfect for blog posts and documentation.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-12">
                        <div class="p-4 rounded-4 bg-light border position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold small mb-0 uppercase opacity-50">Markdown Composer</h6>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-white btn-sm shadow-sm rounded-pill px-3 fw-bold" id="v-sample" style="min-width: 280px; max-width: 100%;">LOAD SAMPLE</button>
                                    <button class="btn btn-white btn-sm shadow-sm rounded-pill px-3 fw-bold" id="v-clear" style="min-width: 280px; max-width: 100%;">CLEAR</button>
                                </div>
                            </div>
                            <textarea id="v-input" class="form-control border-0 bg-white shadow-sm rounded-4 p-4 font-monospace small mb-0" rows="12" placeholder="# Hello World\n\nThis is **bold** and this is [a link](https://toolshub.io)." style="resize: vertical;"></textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex gap-2">
                    <button class="btn btn-dark rounded-pill px-5 py-2 fw-bold shadow-lg" id="convert-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-magic me-2"></i>Generate HTML
                    </button>
                    <div class="ms-auto d-flex align-items-center gap-3">
                        <div class="form-check form-switch mt-1">
                            <input class="form-check-input" type="checkbox" id="v-auto" checked>
                            <label class="form-check-label small fw-bold text-muted">Auto-Convert</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="out-wrapper" style="--tool-hue: 210; --tool-color: #3B82F6; --tool-bg: rgba(59, 130, 246, .04); display: none;">
            <div class="p-4 bg-white border-top rounded-4 shadow-sm">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold small mb-0 uppercase opacity-50">Raw HTML Output</h6>
                            <button class="btn btn-blue btn-sm rounded-pill px-4 fw-bold text-white shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">COPY CODE</button>
                        </div>
                        <div class="p-4 rounded-4 bg-slate-900 border border-slate-800">
                            <pre id="out-data" class="text-blue-300 font-monospace small mb-0 overflow-auto" style="max-height: 400px; white-space: pre-wrap; word-break: break-all;"></pre>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Visual Preview</h6>
                        <div id="out-preview" class="p-4 rounded-4 border bg-white overflow-auto shadow-inner" style="max-height: 442px; min-height: 442px;">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const inputE = $('v-input'), outData = $('out-data'), outPreview = $('out-preview'), outWrapper = $('out-wrapper');

    function markdownToHtml(md) {
        let html = md
            .replace(/^# (.*$)/gim, '<h1>$1</h1>')
            .replace(/^## (.*$)/gim, '<h2>$1</h2>')
            .replace(/^### (.*$)/gim, '<h3>$1</h3>')
            .replace(/\*\*(.*)\*\*/gim, '<b>$1</b>')
            .replace(/\*(.*)\*/gim, '<i>$1</i>')
            .replace(/\[([^\]]+)\]\(([^)]+)\)/gim, '<a href="$2" target="_blank">$1</a>')
            .replace(/\n$/gim, '<br />');

        return html.trim();
    }

    function execute() {
        const raw = inputE.value;
        if (!raw) { outWrapper.style.display = 'none'; return; }
        
        const html = markdownToHtml(raw);
        outData.textContent = html;
        outPreview.innerHTML = html;
        outWrapper.style.display = 'block';
    }

    $('convert-btn').addEventListener('click', execute);
    inputE.addEventListener('input', () => { if ($('v-auto').checked) execute(); });

    $('v-sample').addEventListener('click', () => {
        inputE.value = "# ToolsHub Rocks\n\nThis is a sample markdown converted to **HTML**.\n\n## Features\n* Fast\n* Accurate\n* Private\n\nCheck us out at [ToolsHub.io](https://toolshub.io).";
        execute();
    });

    $('v-clear').addEventListener('click', () => { inputE.value = ''; outWrapper.style.display = 'none'; });

    $('copy-summary').addEventListener('click', function(){
        navigator.clipboard.writeText(outData.textContent).then(() => {
            const o = this.innerHTML; this.innerHTML = 'COPIED!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });
});
</script>

<style>
.md-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#0f172a;opacity:.7;margin-bottom:8px;display:block}
.md-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-blue { background: #3B82F6; color: #fff; transition: all .3s; }
.btn-blue:hover { background: #2563EB; color: #fff; transform: translateY(-2px); }
.bg-slate-900 { background-color: #0f172a; }
.text-blue-300 { color: #93c5fd; }
.fw-900 { font-weight: 900; }
.font-monospace { font-family: 'JetBrains Mono', 'Fira Code', monospace; }
#out-preview h1 { font-size: 1.5rem; font-weight: 800; border-bottom: 2px solid #f1f5f9; padding-bottom: 0.5rem; margin-bottom: 1rem; }
#out-preview h2 { font-size: 1.25rem; font-weight: 700; margin-top: 1rem; }
#out-preview a { color: #3b82f6; text-decoration: none; font-weight: 600; }
#out-preview a:hover { text-decoration: underline; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\markdown-to-html-converter.blade.php ENDPATH**/ ?>