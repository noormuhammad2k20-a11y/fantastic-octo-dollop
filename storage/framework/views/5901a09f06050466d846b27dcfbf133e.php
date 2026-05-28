<div class="row g-4 email-extractor-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-emerald">
            

            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label-custom">Input Content</label>
                        <textarea class="form-control form-control-lg rounded-3" id="inputText" rows="10" placeholder="Paste your content here... e.g. 'Contact us at john@example.com or support@company.io'" style="font-family: 'Fira Code', monospace; font-size: 0.85rem;"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Options</label>
                        <div class="p-3 rounded-3 bg-light border mb-3">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="opt-unique" checked>
                                <label class="form-check-label small fw-bold text-muted">Remove Duplicates</label>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="opt-sort">
                                <label class="form-check-label small fw-bold text-muted">Sort Alphabetically</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="opt-lower" checked>
                                <label class="form-check-label small fw-bold text-muted">Lowercase All</label>
                            </div>
                        </div>

                        <button id="extractBtn" class="btn btn-emerald w-100 py-3 fw-bold rounded-pill shadow-sm">
                            <i class="fas fa-search me-2"></i>Extract Emails
                        </button>
                        <button id="clearBtn" class="btn btn-outline-secondary w-100 mt-2 py-2 rounded-pill fw-bold">
                            <i class="fas fa-undo me-2"></i>Clear
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12 d-none" id="output-wrapper">
        <div class="output-card-themed" style="--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04);">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <span class="output-hero-label text-emerald">Extraction Complete</span>
                    <div class="d-flex align-items-baseline gap-3">
                        <h2 class="display-4 fw-black text-dark m-0" id="emailCount">0</h2>
                        <span class="text-muted fw-bold">unique emails found</span>
                    </div>
                </div>
                <div class="col-md-4 mt-3 mt-md-0 d-flex justify-content-end gap-2">
                    <button id="copyBtn" class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm">
                        <i class="fas fa-copy me-2"></i>Copy List
                    </button>
                    <button id="downloadBtn" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-bold">
                        <i class="fas fa-download me-2"></i>.TXT
                    </button>
                </div>
            </div>

            <div class="p-4 bg-white rounded-4 border shadow-sm">
                <textarea id="emailsOutput" class="form-control border-0 bg-white" rows="8" readonly style="font-family: 'Fira Code', monospace; font-size: 0.85rem; line-height: 1.8; resize: none;"></textarea>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="p-3 bg-white rounded-3 border text-center">
                        <span class="stat-card-label text-muted">Total Found</span>
                        <span class="stat-card-value" id="stat-total">0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-white rounded-3 border text-center">
                        <span class="stat-card-label text-muted">Duplicates Removed</span>
                        <span class="stat-card-value" id="stat-dupes">0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-white rounded-3 border text-center">
                        <span class="stat-card-label text-muted">Unique Domains</span>
                        <span class="stat-card-value" id="stat-domains">0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const inputText = $('inputText');
    const extractBtn = $('extractBtn');
    const clearBtn = $('clearBtn');
    const emailsOutput = $('emailsOutput');
    const emailCount = $('emailCount');
    const copyBtn = $('copyBtn');
    const downloadBtn = $('downloadBtn');
    const outWrapper = $('output-wrapper');

    let lastResult = '';

    extractBtn.addEventListener('click', function() {
        const text = inputText.value.trim();
        if (!text) return;

        // Client-side regex extraction
        const emailRegex = /[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}/g;
        let matches = text.match(emailRegex) || [];

        const totalFound = matches.length;

        // Apply options
        if ($('opt-lower').checked) {
            matches = matches.map(e => e.toLowerCase());
        }

        if ($('opt-unique').checked) {
            const before = matches.length;
            matches = [...new Set(matches)];
            $('stat-dupes').textContent = before - matches.length;
        } else {
            $('stat-dupes').textContent = '0';
        }

        if ($('opt-sort').checked) {
            matches.sort();
        }

        // Count unique domains
        const domains = new Set(matches.map(e => e.split('@')[1]));

        if (matches.length === 0) {
            emailsOutput.value = 'No email addresses found in the provided text.';
            emailCount.textContent = '0';
            lastResult = '';
        } else {
            lastResult = matches.join('\n');
            emailsOutput.value = lastResult;
            emailCount.textContent = matches.length;
        }

        $('stat-total').textContent = totalFound;
        $('stat-domains').textContent = domains.size;

        outWrapper.classList.remove('d-none');
        outWrapper.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });

    clearBtn.addEventListener('click', function() {
        inputText.value = '';
        outWrapper.classList.add('d-none');
        lastResult = '';
    });

    copyBtn.addEventListener('click', function() {
        if (!lastResult) return;
        navigator.clipboard.writeText(lastResult).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            this.classList.replace('btn-dark', 'btn-success');
            setTimeout(() => {
                this.innerHTML = o;
                this.classList.replace('btn-success', 'btn-dark');
            }, 2000);
        });
    });

    downloadBtn.addEventListener('click', function() {
        if (!lastResult) return;
        const blob = new Blob([lastResult], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url; a.download = 'extracted_emails.txt';
        a.click();
        URL.revokeObjectURL(url);
    });
});
</script>

<style>
.email-extractor-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(16,185,129,.05)}
.email-extractor-rebuilt .border-emerald { border-top: 4px solid #10b981 !important; }
.email-extractor-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.email-extractor-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.email-extractor-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.email-extractor-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.email-extractor-rebuilt .form-label-custom{font-size:.7rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}
.text-emerald { color: #10b981 !important; }
.bg-emerald-soft { background-color: #ecfdf5 !important; }
.btn-emerald { background: #10b981; color: #fff; border: none; }
.btn-emerald:hover { background: #059669; color: #fff; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem}
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:4px}
.stat-card-value{display:block;font-size:1.4rem;font-weight:800;color:#1e293b}
.fw-black { font-weight: 900; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\email-extractor.blade.php ENDPATH**/ ?>