<div class="row g-4">
    
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label-custom mb-0">Source Text</label>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light-custom" id="btn-sample" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-vial me-1"></i> Sample
                            </button>
                            <button class="btn btn-sm btn-light-custom" id="btn-clear" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-trash-alt me-1"></i> Clear
                            </button>
                        </div>
                    </div>
                    <textarea id="input-text" class="form-control tool-textarea" rows="12" placeholder="Paste your text here..."></textarea>
                </div>

                
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 border bg-white text-center shadow-sm">
                            <h3 class="fw-bold text-primary mb-1" id="stat-total">0</h3>
                            <p class="text-muted small mb-0 text-uppercase fw-bold letter-spacing-1">Total Lines</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 border bg-white text-center shadow-sm">
                            <h3 class="fw-bold text-success mb-1" id="stat-non-empty">0</h3>
                            <p class="text-muted small mb-0 text-uppercase fw-bold letter-spacing-1">Non-Empty</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 border bg-white text-center shadow-sm">
                            <h3 class="fw-bold text-info mb-1" id="stat-unique">0</h3>
                            <p class="text-muted small mb-0 text-uppercase fw-bold letter-spacing-1">Unique Lines</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 border bg-white text-center shadow-sm">
                            <h3 class="fw-bold text-warning mb-1" id="stat-avg">0</h3>
                            <p class="text-muted small mb-0 text-uppercase fw-bold letter-spacing-1">Avg Length</p>
                        </div>
                    </div>
                </div>

                
                <div class="p-4 rounded-4" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <h6 class="fw-bold text-dark mb-4 small text-uppercase letter-spacing-1 d-flex align-items-center">
                        <i class="fas fa-chart-pie me-2 text-primary"></i> Extended Analysis
                    </h6>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 bg-white border h-100">
                                <h6 class="fw-bold small mb-3 text-secondary text-uppercase letter-spacing-1">Character Data</h6>
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted">Total Characters</span>
                                    <span class="fw-bold text-dark" id="stat-chars">0</span>
                                </div>
                                <div class="d-flex justify-content-between small">
                                    <span class="text-muted">Total (No Spaces)</span>
                                    <span class="fw-bold text-dark" id="stat-chars-no-space">0</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 bg-white border h-100">
                                <h6 class="fw-bold small mb-3 text-secondary text-uppercase letter-spacing-1">Word & Density</h6>
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted">Total Word Count</span>
                                    <span class="fw-bold text-dark" id="stat-words">0</span>
                                </div>
                                <div class="d-flex justify-content-between small">
                                    <span class="text-muted">Avg Words Per Line</span>
                                    <span class="fw-bold text-dark" id="stat-avg-words">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
.tool-textarea { border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 1.25rem; font-family: 'Inter', sans-serif; font-size: 1.1rem; transition: all 0.2s; }
.tool-textarea:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79,70,229,0.1); outline: none; }
.btn-light-custom { background: #f1f5f9; border: none; color: #475569; font-weight: 600; border-radius: 10px; }
.btn-light-custom:hover { background: #e2e8f0; color: #1e293b; }
.letter-spacing-1 { letter-spacing: 1px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const total = document.getElementById('stat-total');
    const nonEmpty = document.getElementById('stat-non-empty');
    const unique = document.getElementById('stat-unique');
    const avg = document.getElementById('stat-avg');
    
    const chars = document.getElementById('stat-chars');
    const charsNoSpace = document.getElementById('stat-chars-no-space');
    const words = document.getElementById('stat-words');
    const avgWords = document.getElementById('stat-avg-words');
    
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');

    function analyzeLines() {
        const text = input.value;
        const lineArr = text === '' ? [] : text.split(/\r?\n/);
        const totalLines = lineArr.length;
        const filledLines = lineArr.filter(l => l.trim().length > 0);
        const uniqueLines = [...new Set(filledLines)];
        
        const totalChars = text.length;
        const totalCharsNoSpace = text.replace(/\s/g, '').length;
        const wordArr = text.trim() === '' ? [] : text.trim().split(/\s+/);
        
        const avgLen = filledLines.length > 0 ? Math.round(totalChars / filledLines.length) : 0;
        const avgW = filledLines.length > 0 ? (wordArr.length / filledLines.length).toFixed(1) : 0;

        total.textContent = totalLines.toLocaleString();
        nonEmpty.textContent = filledLines.length.toLocaleString();
        unique.textContent = uniqueLines.length.toLocaleString();
        avg.textContent = avgLen.toLocaleString();
        
        chars.textContent = totalChars.toLocaleString();
        charsNoSpace.textContent = totalCharsNoSpace.toLocaleString();
        words.textContent = wordArr.length.toLocaleString();
        avgWords.textContent = avgW;
    }

    input.addEventListener('input', analyzeLines);
    
    btnClear.addEventListener('click', () => {
        input.value = '';
        analyzeLines();
    });

    btnSample.addEventListener('click', () => {
        input.value = "Hello World\n\nThis is a sample text\nWith some unique lines\nAnd some empty lines\n\nHello World\nLine counter is working!";
        analyzeLines();
    });

    // Initial check
    analyzeLines();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\line-counter.blade.php ENDPATH**/ ?>