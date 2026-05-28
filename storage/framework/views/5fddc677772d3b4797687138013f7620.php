<div class="row g-4 smart-quotes-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                
                <div class="mb-4">
                    <label class="form-label-custom">Text to Clean</label>
                    <textarea id="sq-input" class="form-control rounded-3 form-control-lg" rows="8" placeholder="Paste your text with “smart quotes” and ‘apostrophes’ here..."></textarea>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill" id="action-clean" style="background-color: #f59e0b; border-color: #f59e0b;"><i class="fas fa-magic me-2"></i>Remove Smart Quotes</button>
                    <button class="btn btn-outline-secondary py-3 px-4 fw-bold rounded-pill" id="action-reset"><i class="fas fa-undo"></i></button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-container" style="--tool-hue:38;--tool-color:#f59e0b;--tool-bg:rgba(245,158,11,.04); display: none;">
            
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-check-circle me-2" style="color: var(--tool-color);"></i>Cleaned Text</h6>
                <span class="badge bg-secondary" id="out-stats">0 quotes replaced</span>
            </div>
            
            <div class="position-relative">
                <textarea class="form-control rounded-3 bg-white" rows="8" id="out-text" readonly></textarea>
            </div>
            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="action-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Clean Text</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    
    const inputEl = $('sq-input');
    const outContainer = $('output-container');
    const outText = $('out-text');
    const outStats = $('out-stats');
    
    $('action-clean').addEventListener('click', function() {
        let text = inputEl.value;
        if(!text) {
            alert('Please paste some text to clean.');
            return;
        }
        
        // Count replacements
        const matches = text.match(/[“”‘’]/g);
        const count = matches ? matches.length : 0;
        
        // Replace smart quotes
        text = text.replace(/[“”]/g, '"');
        text = text.replace(/[‘’]/g, "'");
        
        outText.value = text;
        outStats.textContent = `${count} quotes replaced`;
        
        outContainer.style.display = 'block';
        outContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    
    $('action-reset').addEventListener('click', function() {
        inputEl.value = '';
        outContainer.style.display = 'none';
    });
    
    $('action-copy').addEventListener('click', function() {
        const text = outText.value;
        navigator.clipboard.writeText(text).then(()=>{
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
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\smart-quotes-remover.blade.php ENDPATH**/ ?>