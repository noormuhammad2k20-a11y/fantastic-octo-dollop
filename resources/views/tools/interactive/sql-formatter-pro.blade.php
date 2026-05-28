<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="v-input" class="form-control tool-textarea mb-4" rows="10" placeholder="SELECT * FROM users WHERE active = 1 AND created_at > '2023-01-01' ORDER BY name ASC"></textarea>
            
            <div class="p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                <div class="row g-4 align-items-center">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Dialect</label>
                        <select id="v-dialect" class="form-select">
                            <option value="sql" selected>Standard SQL</option>
                            <option value="mysql">MySQL</option>
                            <option value="pg">PostgreSQL</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-wrap gap-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="v-upper" checked>
                                <label class="form-check-label small fw-semibold" for="v-upper">UPPERCASE Keywords</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="v-comma">
                                <label class="form-check-label small fw-semibold" for="v-comma">New Line on Comma</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="prettify-btn" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-magic me-2"></i> Prettify SQL
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
                        <h5 class="mb-0 fw-bold text-dark">Formatted Output</h5>
                        <p class="text-muted small mb-0" id="out-status">SQL Prettified successfully</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy SQL
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="p-4 rounded-4 bg-light border">
                <pre id="out-data" class="text-dark font-monospace small mb-0 overflow-auto" style="max-height: 600px; white-space: pre-wrap; word-break: break-all;"></pre>
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
    
    .form-check-input:checked { background-color: var(--primary-color); border-color: var(--primary-color); }

    .form-control, .form-select { border: 1.5px solid var(--border-color); border-radius: 10px; padding: 0.625rem 0.75rem; }
    .font-monospace { font-family: 'JetBrains Mono', 'Fira Code', monospace; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const inputE = document.getElementById('v-input');
    const upperE = document.getElementById('v-upper');
    const commaE = document.getElementById('v-comma');
    const outData = document.getElementById('out-data');
    const outWrapper = document.getElementById('out-wrapper');
    const btnPrettify = document.getElementById('prettify-btn');
    const btnSample = document.getElementById('v-sample');
    const btnClear = document.getElementById('v-clear');
    const btnCopy = document.getElementById('copy-summary');

    function formatSQL(sql) {
        let res = sql.trim();
        
        // Basic keywords to uppercase
        const keywords = ['SELECT', 'FROM', 'WHERE', 'AND', 'OR', 'ORDER BY', 'GROUP BY', 'LIMIT', 'JOIN', 'LEFT JOIN', 'RIGHT JOIN', 'INNER JOIN', 'ON', 'AS', 'IN', 'BETWEEN', 'INSERT INTO', 'UPDATE', 'DELETE', 'SET', 'VALUES', 'HAVING', 'UNION', 'ALL', 'EXISTS'];
        
        keywords.forEach(kw => {
            const regex = new RegExp('\\b' + kw + '\\b', 'gi');
            res = res.replace(regex, upperE.checked ? kw.toUpperCase() : kw.toLowerCase());
        });

        // Simple indentation logic
        res = res.replace(/\s+/g, ' '); // Normalize spaces
        
        const breakKeywords = ['SELECT', 'FROM', 'WHERE', 'AND', 'OR', 'ORDER BY', 'GROUP BY', 'LIMIT', 'JOIN', 'LEFT JOIN', 'INNER JOIN', 'SET', 'VALUES', 'HAVING', 'UNION'];
        breakKeywords.forEach(kw => {
            const regex = new RegExp('\\b' + (upperE.checked ? kw.toUpperCase() : kw.toLowerCase()) + '\\b', 'g');
            res = res.replace(regex, '\n' + (upperE.checked ? kw.toUpperCase() : kw.toLowerCase()));
        });

        if (commaE.checked) {
            res = res.replace(/,/g, ',\n  ');
        }

        return res.trim();
    }

    btnPrettify.addEventListener('click', () => {
        const raw = inputE.value;
        if (!raw) return;

        btnPrettify.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing...';
        btnPrettify.disabled = true;

        setTimeout(() => {
            const formatted = formatSQL(raw);
            outData.textContent = formatted;
            outWrapper.classList.remove('d-none');
            outWrapper.scrollIntoView({ behavior: 'smooth' });
            
            btnPrettify.innerHTML = '<i class="fas fa-magic me-2"></i> Prettify SQL';
            btnPrettify.disabled = false;
        }, 400);
    });

    btnSample.addEventListener('click', () => {
        inputE.value = "select u.id, u.name, o.total from users u join orders o on u.id = o.user_id where u.active = 1 and o.status = 'paid' order by o.total desc limit 10";
        btnPrettify.click();
    });

    btnClear.addEventListener('click', () => {
        inputE.value = '';
        outWrapper.classList.add('d-none');
    });

    btnCopy.addEventListener('click', function(){
        navigator.clipboard.writeText(outData.textContent).then(() => {
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            this.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => {
                this.innerHTML = originalText;
                this.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>

