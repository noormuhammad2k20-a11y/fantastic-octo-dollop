<div class="row g-4 md-table-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Columns</label>
                        <input type="number" id="tbl-cols" class="form-control form-control-lg rounded-3" value="3" min="1" max="20">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Rows (excluding header)</label>
                        <input type="number" id="tbl-rows" class="form-control form-control-lg rounded-3" value="3" min="1" max="100">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <label class="form-label-custom mb-0">Table Data</label>
                    <button class="btn btn-sm btn-outline-primary rounded-pill px-3" id="action-update-grid"><i class="fas fa-sync-alt me-1"></i>Update Grid</button>
                </div>

                <div class="table-responsive border rounded-3 mb-4">
                    <table class="table table-bordered mb-0" id="tbl-grid">
                        <thead class="table-light" id="tbl-head">
                            <!-- Generated via JS -->
                        </thead>
                        <tbody id="tbl-body">
                            <!-- Generated via JS -->
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill" id="action-generate" style="background-color: #14b8a6; border-color: #14b8a6;"><i class="fas fa-magic me-2"></i>Generate Markdown</button>
                    <button class="btn btn-outline-secondary py-3 px-4 fw-bold rounded-pill" id="action-reset"><i class="fas fa-undo"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-container" style="--tool-hue:173;--tool-color:#14b8a6;--tool-bg:rgba(20,184,166,.04); display: none;">
            
            <h6 class="fw-bold mb-3"><i class="fab fa-markdown me-2" style="color: var(--tool-color);"></i>Markdown Output</h6>
            <div class="position-relative">
                <pre class="bg-dark text-light p-4 rounded-3 small mb-0 overflow-x-auto" style="word-break: break-all; white-space: pre-wrap;" id="out-code"></pre>
            </div>
            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="action-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Markdown</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    
    const colsEl = $('tbl-cols');
    const rowsEl = $('tbl-rows');
    const thead = $('tbl-head');
    const tbody = $('tbl-body');
    
    const outContainer = $('output-container');
    const outCode = $('out-code');
    
    function generateGrid() {
        const cols = parseInt(colsEl.value) || 3;
        const rows = parseInt(rowsEl.value) || 3;
        
        // Preserve data if resizing
        const oldHeaders = Array.from(thead.querySelectorAll('input')).map(i => i.value);
        const oldBodyRows = Array.from(tbody.querySelectorAll('tr')).map(tr => {
            return Array.from(tr.querySelectorAll('input')).map(i => i.value);
        });
        
        let headerHtml = '<tr>';
        for(let c=0; c<cols; c++) {
            const val = oldHeaders[c] !== undefined ? oldHeaders[c] : `Header ${c+1}`;
            headerHtml += `<th class="p-1"><input type="text" class="form-control form-control-sm border-0 fw-bold text-center" value="${val}" placeholder="Header ${c+1}"></th>`;
        }
        headerHtml += '</tr>';
        thead.innerHTML = headerHtml;
        
        let bodyHtml = '';
        for(let r=0; r<rows; r++) {
            bodyHtml += '<tr>';
            for(let c=0; c<cols; c++) {
                const val = (oldBodyRows[r] && oldBodyRows[r][c] !== undefined) ? oldBodyRows[r][c] : `Row ${r+1} Col ${c+1}`;
                bodyHtml += `<td class="p-1"><input type="text" class="form-control form-control-sm border-0" value="${val}"></td>`;
            }
            bodyHtml += '</tr>';
        }
        tbody.innerHTML = bodyHtml;
    }
    
    // Init grid
    generateGrid();
    
    $('action-update-grid').addEventListener('click', generateGrid);
    
    $('action-generate').addEventListener('click', function() {
        const headers = Array.from(thead.querySelectorAll('input')).map(i => i.value.trim());
        const bodyRows = Array.from(tbody.querySelectorAll('tr')).map(tr => {
            return Array.from(tr.querySelectorAll('input')).map(i => i.value.trim());
        });
        
        let md = '| ' + headers.join(' | ') + ' |\n';
        
        let separator = headers.map(() => '---');
        md += '| ' + separator.join(' | ') + ' |\n';
        
        bodyRows.forEach(row => {
            md += '| ' + row.join(' | ') + ' |\n';
        });
        
        outCode.textContent = md;
        outContainer.style.display = 'block';
        outContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    
    $('action-reset').addEventListener('click', function() {
        colsEl.value = '3';
        rowsEl.value = '3';
        thead.innerHTML = '';
        tbody.innerHTML = '';
        generateGrid();
        outContainer.style.display = 'none';
    });
    
    $('action-copy').addEventListener('click', function() {
        const code = outCode.textContent;
        navigator.clipboard.writeText(code).then(()=>{
            const orig = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            this.classList.replace('btn-dark', 'btn-success');
            setTimeout(()=>{
                this.innerHTML = orig;
                this.classList.replace('btn-success', 'btn-dark');
            }, 2000);
        });
    });
});
</script>

<style>
.form-label-custom {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}
.calculator-card {
    background: #fff;
    border-radius: 1.5rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid rgba(0,0,0,0.05);
    overflow: hidden;
}
.calculator-header {
    padding: 2rem 2rem 1.5rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    display: flex;
    align-items: center;
    gap: 1.25rem;
}
.tool-icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}
.calculator-header h4 {
    margin: 0 0 0.25rem 0;
    font-weight: 700;
    color: #111827;
}
.calculator-header p {
    margin: 0;
    color: #6b7280;
    font-size: 0.95rem;
}
.calculator-body {
    padding: 2rem;
}
.output-card-themed {
    background: #fff;
    border-radius: 1.5rem;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid var(--tool-bg);
    border-top: 4px solid var(--tool-color);
}
</style>
