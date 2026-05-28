<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="v-input" class="form-control tool-textarea mb-4" rows="12" placeholder='{!! "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" !!}
<note>
  <to>Tove</to>
  <from>Jani</from>
  <heading>Reminder</heading>
  <body>Don’t forget me this weekend!</body>
</note>'></textarea>
            
            <div class="p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex gap-4">
                            <div class="small fw-bold text-muted">Lines: <span id="v-lines" class="text-primary">0</span></div>
                            <div class="small fw-bold text-muted">Size: <span id="v-size" class="text-primary">0 KB</span></div>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="validate-btn" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-search me-2"></i> Validate XML
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
                    <div class="icon-box me-3" id="v-result-icon-box">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark" id="v-result-title">Validation Result</h5>
                        <p class="text-muted small mb-0" id="v-result-desc">Processing complete</p>
                    </div>
                </div>
                <div class="header-actions">
                    <div id="v-status-badge" class="badge rounded-pill px-3 py-2 fw-bold">IDLE</div>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div id="v-error-details" class="p-4 rounded-4 d-none border">
                <h6 class="fw-bold mb-2">Error Breakdown:</h6>
                <pre id="v-error-text" class="font-monospace small mb-0 overflow-auto" style="white-space: pre-wrap; word-break: break-all;"></pre>
            </div>
            <div id="v-success-details" class="p-4 rounded-4 d-none border bg-success-soft border-success-subtle">
                <div class="d-flex align-items-center gap-3">
                    <i class="fas fa-check-circle text-success fs-4"></i>
                    <div>
                        <h6 class="fw-bold text-success mb-1">Well-Formed XML</h6>
                        <p class="text-success-emphasis small mb-0">Document is structurally sound. All tags are balanced and correctly nested.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --danger-soft: #fef2f2;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }
    .bg-danger-soft { background-color: var(--danger-soft); }

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
    
    .form-check-input:checked { background-color: var(--primary-color); border-color: var(--primary-color); }

    .form-control, .form-select { border: 1.5px solid var(--border-color); border-radius: 10px; padding: 0.625rem 0.75rem; }
    .font-monospace { font-family: 'JetBrains Mono', 'Fira Code', monospace; }
    
    .badge.bg-success { background-color: #10b981 !important; color: #fff !important; }
    .badge.bg-danger { background-color: #ef4444 !important; color: #fff !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const inputE = document.getElementById('v-input');
    const outWrapper = document.getElementById('out-wrapper');
    const validateBtn = document.getElementById('validate-btn');
    const resultIconBox = document.getElementById('v-result-icon-box');
    const resultTitle = document.getElementById('v-result-title');
    const resultDesc = document.getElementById('v-result-desc');
    const statusBadge = document.getElementById('v-status-badge');
    const errorDetails = document.getElementById('v-error-details');
    const errorText = document.getElementById('v-error-text');
    const successDetails = document.getElementById('v-success-details');

    function validate() {
        const raw = inputE.value.trim();
        if (!raw) return;

        validateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Validating...';
        validateBtn.disabled = true;

        setTimeout(() => {
            document.getElementById('v-lines').textContent = raw.split('\n').length;
            document.getElementById('v-size').textContent = (new Blob([raw]).size / 1024).toFixed(2) + ' KB';

            try {
                const parser = new DOMParser();
                const xmlDoc = parser.parseFromString(raw, "application/xml");
                const parserError = xmlDoc.getElementsByTagName("parsererror");

                if (parserError.length > 0) {
                    showError(parserError[0].innerText);
                } else {
                    showSuccess();
                }
            } catch (e) {
                showError(e.message);
            }
            
            validateBtn.innerHTML = '<i class="fas fa-search me-2"></i> Validate XML';
            validateBtn.disabled = false;
        }, 400);
    }

    function showSuccess() {
        statusBadge.textContent = 'VALID';
        statusBadge.className = 'badge bg-success rounded-pill px-3 py-2 fw-bold';
        outWrapper.classList.remove('d-none');
        
        resultIconBox.className = 'icon-box me-3 bg-success-soft text-success';
        resultIconBox.innerHTML = '<i class="fas fa-check"></i>';
        resultTitle.textContent = 'Well-Formed XML';
        resultDesc.textContent = 'Document is structurally sound and valid.';
        
        errorDetails.classList.add('d-none');
        successDetails.classList.remove('d-none');
        outWrapper.scrollIntoView({ behavior: 'smooth' });
    }

    function showError(msg) {
        statusBadge.textContent = 'INVALID';
        statusBadge.className = 'badge bg-danger rounded-pill px-3 py-2 fw-bold';
        outWrapper.classList.remove('d-none');
        
        resultIconBox.className = 'icon-box me-3 bg-danger-soft text-danger';
        resultIconBox.innerHTML = '<i class="fas fa-times"></i>';
        resultTitle.textContent = 'Parsing Error Found';
        resultDesc.textContent = 'We found issues with the XML structure.';
        
        successDetails.classList.add('d-none');
        errorDetails.classList.remove('d-none');
        errorDetails.className = 'p-4 rounded-4 bg-danger-soft border border-danger-subtle';
        errorText.textContent = msg;
        errorText.className = 'font-monospace small mb-0 text-danger-emphasis';
        outWrapper.scrollIntoView({ behavior: 'smooth' });
    }

    validateBtn.addEventListener('click', validate);
    
    document.getElementById('v-clear').addEventListener('click', () => { 
        inputE.value = ''; 
        outWrapper.classList.add('d-none'); 
    });

    document.getElementById('v-beautify').addEventListener('click', () => {
        const raw = inputE.value.trim();
        if (!raw) return;
        try {
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(raw, "application/xml");
            const serializer = new XMLSerializer();
            let xmlString = serializer.serializeToString(xmlDoc);
            
            let formatted = '';
            let reg = /(>)(<)(\/*)/g;
            xmlString = xmlString.replace(reg, '$1\r\n$2$3');
            let pad = 0;
            xmlString.split('\r\n').forEach(node => {
                let indent = 0;
                if (node.match( /.+<\/\w[^>]*>$/ )) indent = 0;
                else if (node.match( /^<\/\w/ )) { if (pad !== 0) pad -= 1; }
                else if (node.match( /^<\w[^>]*[^\/]>.*$/ )) indent = 1;
                else indent = 0;
                formatted += '  '.repeat(pad) + node + '\r\n';
                pad += indent;
            });
            inputE.value = formatted.trim();
        } catch(e){}
    });
});
</script>

