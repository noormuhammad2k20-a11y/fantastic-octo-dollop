<div class="row g-4 number-extractor-rebuilt">
    
    <div class="col-lg-6">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 10px 40px rgba(16, 185, 129, 0.08);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-green" style="background: linear-gradient(135deg, #10b981, #059669); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-hashtag"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#064e3b; letter-spacing: -0.5px;">Number Extractor</h4>
                    <p class="text-muted small mb-0">Identify and pull all numeric digits from any block of text.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label-custom">Source Text</label>
                        <textarea id="v-text" class="form-control border-0 bg-light shadow-none rounded-4 p-3 fw-medium" rows="12" placeholder="Paste your text with numbers here (e.g., Price: $45.99 for 2 items)..."></textarea>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-light border-top rounded-bottom-5">
                <button class="btn d-block mx-auto btn-success rounded-pill fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="extract-btn" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-search me-2"></i>EXTRACT ALL NUMBERS
                </button>
            </div>
        </div>
    </div>

    
    <div class="col-lg-6">
        <div class="output-card-themed h-100" style="--tool-hue: 161; --tool-color: #10b981; --tool-bg: rgba(16, 185, 129, .04);">
            <div class="p-4 h-100 d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold small mb-0 uppercase opacity-50">Extracted Results</h6>
                    <div class="badge bg-green-soft text-green px-3 py-2 rounded-pill fw-bold" id="count-label">0 Found</div>
                </div>
                
                <div class="flex-grow-1 position-relative">
                    <textarea id="v-output" class="form-control border-0 bg-white shadow-sm rounded-4 p-4 fw-medium h-100 font-monospace" rows="12" readonly placeholder="Numeric list will appear here..."></textarea>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-success rounded-pill px-4 fw-bold shadow-sm flex-grow-1" id="copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2"></i>Copy List
                    </button>
                    <button class="btn btn-outline-secondary rounded-pill px-4 fw-bold" id="reset-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-undo me-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const textInput = document.getElementById('v-text');
    const textOutput = document.getElementById('v-output');
    const countLabel = document.getElementById('count-label');
    const extractBtn = document.getElementById('extract-btn');
    const copyBtn = document.getElementById('copy-btn');
    const resetBtn = document.getElementById('reset-btn');

    function process() {
        const text = textInput.value;
        if (!text) {
            textOutput.value = '';
            countLabel.textContent = '0 Found';
            return;
        }

        const matches = text.match(/-?\d+(\.\d+)?/g) || [];
        textOutput.value = matches.join('\n');
        countLabel.textContent = `${matches.length} Found`;
    }

    extractBtn.addEventListener('click', process);

    copyBtn.addEventListener('click', function() {
        if (!textOutput.value) return;
        navigator.clipboard.writeText(textOutput.value).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

    resetBtn.addEventListener('click', () => {
        textInput.value = '';
        textOutput.value = '';
        countLabel.textContent = '0 Found';
    });
});
</script>

<style>
.number-extractor-rebuilt .form-label-custom { font-size:.7rem; font-weight:900; text-transform:uppercase; letter-spacing:1px; color:#10b981; opacity:.7; margin-bottom:8px; display:block; }
.bg-green-soft { background-color: rgba(16, 185, 129, 0.1); }
.text-green { color: #10b981; }
.uppercase { text-transform: uppercase; }
.pulse-green { animation: green-pulse 3s infinite; }
@keyframes green-pulse {
    0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
    70% { box-shadow: 0 0 0 15px rgba(16, 185, 129, 0); }
    100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}
#v-text, #v-output { resize: none; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\number-extractor.blade.php ENDPATH**/ ?>