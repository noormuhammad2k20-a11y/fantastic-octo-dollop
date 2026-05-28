<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4">
        <div class="card-header-v2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3">
                        <i class="fas fa-eye text-primary"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Source Text</h5>
                        <p class="text-muted small mb-0">Enter the text you want to transform into Bionic Reading</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-light-v2 btn-sm" id="btn-clear" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-trash-alt me-1"></i> Clear
                    </button>
                    <button class="btn btn-light-v2 btn-sm" id="btn-sample" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-vial me-1"></i> Sample
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2">
            <textarea id="input-text" class="form-control tool-textarea" rows="8" placeholder="Paste your text here..."></textarea>
            
            <div class="mt-4 p-3 bg-light rounded-3">
                <div class="row align-items-center g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-muted text-uppercase mb-2">Fixation Strength</label>
                        <input type="range" class="form-range" id="fixation-strength" min="1" max="100" value="50">
                    </div>
                    <div class="col-md-6 text-md-end">
                        <button class="btn btn-primary-v2 btn-lg px-5 shadow" id="btn-process" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-magic me-2"></i> Generate Bionic Text
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card tool-card-stacked">
        <div class="card-header-v2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3">
                        <i class="fas fa-bolt text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Bionic Output</h5>
                        <p class="text-muted small mb-0">Optimized for fast cognitive processing</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-primary-v2 btn-sm" id="btn-copy-html" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-code me-1"></i> Copy HTML
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2">
            <div id="output-rendered" class="bionic-preview p-4 border rounded-3 bg-white" style="min-height: 200px; font-size: 1.1rem; line-height: 1.8;">
                <p class="text-muted italic">Transformed text will appear here...</p>
            </div>
        </div>
    </div>
</div>

<style>
    .tool-card-stacked { border: 1px solid #edf2f7; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); background: #fff; }
    .card-header-v2 { padding: 1.25rem 1.5rem; background: #fcfcfd; border-bottom: 1px solid #f1f5f9; }
    .card-body-v2 { padding: 1.5rem; }
    .icon-box { width: 40px; height: 40px; border-radius: 10px; background: #f8fafc; display: flex; align-items: center; justify-content: center; }
    .tool-textarea { border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.25rem; background: #f9fafb; transition: all 0.2s; font-family: 'Inter', sans-serif; }
    .tool-textarea:focus { background: #fff; border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }
    .btn-primary-v2 { background: #4f46e5; color: white; border: none; font-weight: 600; padding: 0.5rem 1rem; border-radius: 8px; }
    .btn-primary-v2:hover { background: #4338ca; }
    .btn-light-v2 { background: #f1f5f9; color: #475569; border: none; font-weight: 600; }
    .bionic-preview b { font-weight: 700; color: #000; }
    .form-range::-webkit-slider-runnable-track { background: #e2e8f0; height: 6px; border-radius: 3px; }
    .form-range::-webkit-slider-thumb { background: #4f46e5; margin-top: -5px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-rendered');
    const btnProcess = document.getElementById('btn-process');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    const btnCopyHtml = document.getElementById('btn-copy-html');
    const fixationSlider = document.getElementById('fixation-strength');

    function generateBionic(text) {
        if (!text) return '';
        const strength = fixationSlider.value / 100;
        
        return text.split(/\s+/).map(word => {
            if (word.length <= 1) return word;
            
            // Handle punctuation at end
            const cleanWord = word.replace(/[.,!?;:()]/g, '');
            const punct = word.substring(cleanWord.length);
            
            const fixationPoint = Math.ceil(cleanWord.length * strength);
            const boldPart = cleanWord.substring(0, fixationPoint);
            const restPart = cleanWord.substring(fixationPoint);
            
            return `<b>${boldPart}</b>${restPart}${punct}`;
        }).join(' ');
    }

    btnProcess.addEventListener('click', () => {
        const text = input.value;
        if (!text) return;

        btnProcess.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Generating...';
        btnProcess.disabled = true;

        setTimeout(() => {
            output.innerHTML = generateBionic(text).replace(/\n/g, '<br>');
            btnProcess.innerHTML = '<i class="fas fa-magic me-2"></i> Generate Bionic Text';
            btnProcess.disabled = false;
        }, 300);
    });

    btnClear.addEventListener('click', () => {
        input.value = '';
        output.innerHTML = '<p class="text-muted italic">Transformed text will appear here...</p>';
    });

    btnSample.addEventListener('click', () => {
        input.value = "Bionic Reading is a new method facilitating the reading process by guiding the eyes through text with artificial fixation points. With this method, the eye is guided through the text and can absorb words more quickly. This helps you to read faster and more focused.";
        btnProcess.click();
    });

    btnCopyHtml.addEventListener('click', () => {
        if (!output.innerHTML) return;
        navigator.clipboard.writeText(output.innerHTML);
        const originalText = btnCopyHtml.innerHTML;
        btnCopyHtml.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        setTimeout(() => btnCopyHtml.innerHTML = originalText, 2000);
    });
    
    // Real-time update if user changes slider after generation
    fixationSlider.addEventListener('input', () => {
        if (input.value && output.innerHTML.includes('<b>')) {
            output.innerHTML = generateBionic(input.value).replace(/\n/g, '<br>');
        }
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\bionic-reading-generator.blade.php ENDPATH**/ ?>