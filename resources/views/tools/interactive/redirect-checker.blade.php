<div class="row g-4 redirect-checker-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                
                <div class="mb-4">
                    <label class="form-label-custom">URL to Check</label>
                    <input type="url" id="rd-url" class="form-control form-control-lg rounded-3" placeholder="https://example.com/old-page">
                    <div class="small text-muted mt-2"><i class="fas fa-info-circle me-1"></i>Note: Some cross-origin URLs may block client-side checking.</div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill" id="action-check" style="background-color: #ef4444; border-color: #ef4444;"><i class="fas fa-search me-2"></i>Check Redirects</button>
                    <button class="btn btn-outline-secondary py-3 px-4 fw-bold rounded-pill" id="action-reset"><i class="fas fa-undo"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-container" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.04); display: none;">
            
            <h6 class="fw-bold mb-4"><i class="fas fa-map-signs me-2" style="color: var(--tool-color);"></i>Redirect Trace Results</h6>
            
            <div id="rd-results" class="position-relative">
                <!-- Results injected here -->
            </div>
            
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    
    const inputEl = $('rd-url');
    const outContainer = $('output-container');
    const rdResults = $('rd-results');
    const btnCheck = $('action-check');
    
    btnCheck.addEventListener('click', async function() {
        let url = inputEl.value.trim();
        if(!url) {
            alert('Please enter a valid URL.');
            return;
        }
        
        if(!url.startsWith('http://') && !url.startsWith('https://')) {
            url = 'https://' + url;
            inputEl.value = url;
        }
        
        outContainer.style.display = 'block';
        btnCheck.disabled = true;
        btnCheck.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Checking...';
        
        rdResults.innerHTML = `
            <div class="d-flex align-items-center mb-3">
                <div class="me-3"><span class="badge bg-secondary p-2 rounded-circle"><i class="fas fa-play"></i></span></div>
                <div class="flex-grow-1 border p-3 rounded-3 bg-light text-break">
                    <div class="small fw-bold text-muted mb-1">Initial URL</div>
                    <a href="${url}" target="_blank" class="text-decoration-none text-dark">${url}</a>
                </div>
            </div>
            <div class="text-center text-muted mb-3"><i class="fas fa-arrow-down fa-lg"></i></div>
        `;
        
        try {
            const controller = new AbortController();
            const timeoutId = setTimeout(() => controller.abort(), 10000);
            
            const response = await fetch(url, { 
                method: 'GET',
                redirect: 'follow',
                signal: controller.signal
            });
            clearTimeout(timeoutId);
            
            const finalUrl = response.url;
            
            if(finalUrl === url) {
                rdResults.innerHTML += `
                    <div class="d-flex align-items-center">
                        <div class="me-3"><span class="badge bg-success p-2 rounded-circle"><i class="fas fa-check"></i></span></div>
                        <div class="flex-grow-1 border p-3 rounded-3 bg-white text-break shadow-sm" style="border-left: 4px solid #10b981 !important;">
                            <div class="small fw-bold text-success mb-1">200 OK - No Redirect</div>
                            <div class="text-dark">${finalUrl}</div>
                        </div>
                    </div>
                `;
            } else {
                rdResults.innerHTML += `
                    <div class="d-flex align-items-center">
                        <div class="me-3"><span class="badge bg-warning text-dark p-2 rounded-circle"><i class="fas fa-exchange-alt"></i></span></div>
                        <div class="flex-grow-1 border p-3 rounded-3 bg-white text-break shadow-sm" style="border-left: 4px solid #f59e0b !important;">
                            <div class="small fw-bold text-warning mb-1">Redirected To</div>
                            <a href="${finalUrl}" target="_blank" class="text-decoration-none text-dark fw-bold">${finalUrl}</a>
                        </div>
                    </div>
                `;
            }
            
        } catch (error) {
            rdResults.innerHTML += `
                <div class="d-flex align-items-center">
                    <div class="me-3"><span class="badge bg-danger p-2 rounded-circle"><i class="fas fa-times"></i></span></div>
                    <div class="flex-grow-1 border p-3 rounded-3 bg-white text-break shadow-sm" style="border-left: 4px solid #ef4444 !important;">
                        <div class="small fw-bold text-danger mb-1">Error or Blocked</div>
                        <div class="text-dark">Could not trace URL. This usually happens because the target server blocks cross-origin requests (CORS).</div>
                    </div>
                </div>
            `;
        }
        
        btnCheck.disabled = false;
        btnCheck.innerHTML = '<i class="fas fa-search me-2"></i>Check Redirects';
        outContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    
    $('action-reset').addEventListener('click', function() {
        inputEl.value = '';
        outContainer.style.display = 'none';
        rdResults.innerHTML = '';
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
