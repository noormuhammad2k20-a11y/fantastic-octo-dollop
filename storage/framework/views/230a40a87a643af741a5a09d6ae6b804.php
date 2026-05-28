<div class="row g-4 diff-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 10px 40px rgba(79, 70, 229, 0.08);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-indigo" style="background: linear-gradient(135deg, #6366f1, #3730a3); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-not-equal"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e1b4b; letter-spacing: -0.5px;">Diff Checker</h4>
                    <p class="text-muted small mb-0">Compare text versions with mathematical precision and professional-grade visual feedback.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border border-slate-200">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50 text-indigo">Original Text (Side A)</h6>
                            <textarea id="v-input-a" class="form-control border-0 bg-white shadow-sm rounded-4 p-4 font-monospace" style="min-height: 300px; font-size: 0.85rem; line-height: 1.6;" placeholder="Paste the original content here..."></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border border-slate-200">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50 text-indigo">Modified Text (Side B)</h6>
                            <textarea id="v-input-b" class="form-control border-0 bg-white shadow-sm rounded-4 p-4 font-monospace" style="min-height: 300px; font-size: 0.85rem; line-height: 1.6;" placeholder="Paste the changed content here..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap align-items-center gap-3">
                    <button class="btn btn-indigo rounded-pill px-5 py-3 fw-bold shadow-sm" id="compare-btn">
                        <i class="fas fa-search me-2"></i>Analyze Differences
                    </button>
                    <div class="form-check form-switch mt-1">
                        <input class="form-check-input" type="checkbox" id="v-ignore-case">
                        <label class="form-check-label small fw-bold text-muted">Ignore Case</label>
                    </div>
                    <div class="ms-auto d-flex gap-2">
                        <button class="btn btn-white border shadow-sm rounded-pill px-4 fw-bold text-muted" id="v-sample">
                            <i class="fas fa-vial me-2"></i>Sample Data
                        </button>
                        <button class="btn btn-light rounded-pill px-4 fw-bold text-muted" id="v-clear">
                            <i class="fas fa-trash-alt me-2"></i>Clear
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="out-wrapper" style="--tool-hue: 243; --tool-color: #4f46e5; --tool-bg: rgba(79, 70, 229, .04); display: none;">
            <div class="p-4 bg-white border-top rounded-4 shadow-sm mt-2">
                
                <div class="row g-4 mb-4 align-items-stretch">
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-indigo-soft border border-indigo-100 h-100 text-center d-flex flex-column justify-content-center">
                            <div class="small fw-bold text-indigo uppercase opacity-60 mb-1">Similarity Score</div>
                            <div class="h2 fw-black text-indigo mb-0" id="out-sim">100%</div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="p-3 bg-white rounded-3 shadow-sm border-start border-success border-4">
                                        <div class="small fw-bold text-success uppercase">Additions</div>
                                        <div class="h4 fw-black mb-0" id="out-add">0</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 bg-white rounded-3 shadow-sm border-start border-danger border-4">
                                        <div class="small fw-bold text-danger uppercase">Deletions</div>
                                        <div class="h4 fw-black mb-0" id="out-del">0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="diff-viewer-container border rounded-4 overflow-hidden shadow-sm">
                    <div class="bg-light p-3 border-bottom d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                            <button class="btn btn-white btn-sm border px-3 fw-bold active-view view-toggle" data-v="split">Split View</button>
                            <button class="btn btn-white btn-sm border px-3 fw-bold view-toggle" data-v="unified">Unified View</button>
                        </div>
                        <div class="small text-muted fw-bold">
                            Total Lines: <span id="out-total">0</span>
                        </div>
                    </div>
                    <div id="diff-content" class="bg-white overflow-auto" style="max-height: 600px;">
                        
                    </div>
                </div>

                
                <div class="mt-4 d-flex justify-content-between align-items-center">
                    <div class="text-muted small fw-bold">
                        <i class="fas fa-shield-alt me-1"></i> Privacy Protected: Analysis happens in-browser
                    </div>
                    <button class="btn btn-indigo rounded-pill px-4 fw-bold shadow-sm" id="copy-report">
                        <i class="fas fa-file-export me-2"></i>Copy Diff Report
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const inputA = document.getElementById('v-input-a');
    const inputB = document.getElementById('v-input-b');
    const outWrapper = document.getElementById('out-wrapper');
    const diffContent = document.getElementById('diff-content');
    const ignoreCase = document.getElementById('v-ignore-case');
    
    let currentView = 'split';

    function escapeHtml(text) {
        return text.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    }

    function analyze() {
        let textA = inputA.value;
        let textB = inputB.value;
        
        if (ignoreCase.checked) {
            textA = textA.toLowerCase();
            textB = textB.toLowerCase();
        }

        const linesA = inputA.value.split(/\r?\n/);
        const linesB = inputB.value.split(/\r?\n/);
        const max = Math.max(linesA.length, linesB.length);
        
        let adds = 0;
        let dels = 0;
        let html = '';

        if (currentView === 'split') {
            html = '<table class="diff-table w-100 font-monospace"><tbody>';
            for (let i = 0; i < max; i++) {
                const a = linesA[i] || '';
                const b = linesB[i] || '';
                let classA = '', classB = '';

                if (a !== b) {
                    if (i >= linesA.length) { classB = 'diff-add'; adds++; }
                    else if (i >= linesB.length) { classA = 'diff-del'; dels++; }
                    else { classA = 'diff-del'; classB = 'diff-add'; adds++; dels++; }
                }

                html += `<tr>
                    <td class="diff-num">${i+1}</td>
                    <td class="diff-line ${classA}">${escapeHtml(a)}</td>
                    <td class="diff-num">${i+1}</td>
                    <td class="diff-line ${classB}">${escapeHtml(b)}</td>
                </tr>`;
            }
            html += '</tbody></table>';
        } else {
            html = '<div class="unified-view font-monospace">';
            for (let i = 0; i < max; i++) {
                const a = linesA[i] || '';
                const b = linesB[i] || '';
                
                if (a === b) {
                    html += `<div class="diff-row"><span class="diff-num">${i+1}</span><span class="diff-line">${escapeHtml(a)}</span></div>`;
                } else {
                    if (i < linesA.length) {
                        html += `<div class="diff-row diff-del"><span class="diff-num">${i+1}</span><span class="diff-line"> - ${escapeHtml(a)}</span></div>`;
                        dels++;
                    }
                    if (i < linesB.length) {
                        html += `<div class="diff-row diff-add"><span class="diff-num">${i+1}</span><span class="diff-line"> + ${escapeHtml(b)}</span></div>`;
                        adds++;
                    }
                }
            }
            html += '</div>';
        }

        diffContent.innerHTML = html;
        outWrapper.style.display = 'block';
        document.getElementById('out-add').textContent = adds;
        document.getElementById('out-del').textContent = dels;
        document.getElementById('out-total').textContent = max;
        
        const sim = max > 0 ? Math.max(0, Math.round(((max - Math.max(adds, dels)) / max) * 100)) : 100;
        document.getElementById('out-sim').textContent = sim + '%';

        outWrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    document.getElementById('compare-btn').addEventListener('click', analyze);

    document.getElementById('v-sample').addEventListener('click', () => {
        inputA.value = "function connect() {\n  const port = 8080;\n  console.log('Connecting...');\n  return true;\n}";
        inputB.value = "function connect() {\n  // Using dynamic port\n  const port = process.env.PORT || 8080;\n  console.log('Establishing connection...');\n  return false;\n}";
        analyze();
    });

    document.getElementById('v-clear').addEventListener('click', () => {
        inputA.value = ''; inputB.value = '';
        outWrapper.style.display = 'none';
    });

    document.querySelectorAll('.view-toggle').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.view-toggle').forEach(b => b.classList.remove('btn-indigo', 'text-white'));
            this.classList.add('btn-indigo', 'text-white');
            currentView = this.dataset.v;
            if (outWrapper.style.display === 'block') analyze();
        });
    });

    document.getElementById('copy-report').addEventListener('click', function() {
        const report = `Diff Report\nSimilarity: ${document.getElementById('out-sim').textContent}\nAdditions: ${document.getElementById('out-add').textContent}\nDeletions: ${document.getElementById('out-del').textContent}`;
        navigator.clipboard.writeText(report).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });
});
</script>

<style>
.diff-rebuilt .form-label-custom { font-size:.7rem; font-weight:900; text-transform:uppercase; letter-spacing:1px; color:#4f46e5; opacity:.7; margin-bottom:8px; display:block; }
.bg-indigo-soft { background: rgba(79, 70, 229, 0.08); }
.text-indigo { color: #4f46e5 !important; }
.fw-black { font-weight: 900; }
.uppercase { text-transform: uppercase; }

.btn-indigo { background: #4f46e5; color: #fff; border: none; }
.btn-indigo:hover { background: #4338ca; }

.btn-white { background: #fff; color: #4f46e5; border: 1px solid #e0e7ff; }

.diff-table { border-collapse: collapse; }
.diff-num { width: 45px; background: #f8fafc; color: #94a3b8; text-align: center; border-right: 1px solid #e2e8f0; font-size: 0.75rem; padding: 4px 0; user-select: none; }
.diff-line { padding: 4px 12px; white-space: pre-wrap; font-size: 0.85rem; line-height: 1.5; border-bottom: 1px solid #f1f5f9; min-height: 1.5rem; }

.diff-add { background-color: #f0fdf4 !important; }
.diff-del { background-color: #fef2f2 !important; }

.unified-view .diff-row { display: flex; border-bottom: 1px solid #f1f5f9; }
.unified-view .diff-line { flex-grow: 1; border-bottom: none; }

.font-monospace { font-family: 'Fira Code', 'JetBrains Mono', monospace !important; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\diff-checker.blade.php ENDPATH**/ ?>