<div class="row g-4 string-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">String Length</label>
                        <input type="number" id="str-length" class="form-control form-control-lg" value="16" min="1" max="256">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Quantity</label>
                        <input type="number" id="str-count" class="form-control form-control-lg" value="10" min="1" max="10000">
                    </div>
                    
                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded-3 border h-100">
                            <label class="form-label-custom mb-3">Character Sets</label>
                            <div class="form-check form-switch mb-2 custom-switch-primary">
                                <input class="form-check-input" type="checkbox" id="str-upper" checked>
                                <label class="form-check-label fw-bold" for="str-upper">Uppercase (A-Z)</label>
                            </div>
                            <div class="form-check form-switch mb-2 custom-switch-primary">
                                <input class="form-check-input" type="checkbox" id="str-lower" checked>
                                <label class="form-check-label fw-bold" for="str-lower">Lowercase (a-z)</label>
                            </div>
                            <div class="form-check form-switch custom-switch-primary">
                                <input class="form-check-input" type="checkbox" id="str-num" checked>
                                <label class="form-check-label fw-bold" for="str-num">Numbers (0-9)</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded-3 border h-100">
                            <label class="form-label-custom mb-2">Custom Characters (Optional)</label>
                            <p class="small text-muted mb-2">Add specific symbols or characters to include in the random pool.</p>
                            <input type="text" id="str-custom" class="form-control" placeholder="e.g. !@#$%^*()_+-=">
                        </div>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-primary fw-bold fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="str-generate" style="min-width: 280px; max-width: 100%; background:#6366f1; border:none;">
                    <i class="fas fa-random me-2"></i>Generate Strings
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="str-output-card" style="--tool-hue:230;--tool-color:#4f46e5;--tool-bg:rgba(99,102,241,.04); border-color:#c7d2fe;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-list-ol me-2 text-primary"></i>Generated Strings</h5>
                <button class="btn btn-sm btn-outline-dark" id="copy-str" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i>Copy List</button>
            </div>
            
            <textarea id="str-output" class="form-control bg-white font-monospace" rows="10" readonly style="letter-spacing: 1px;"></textarea>
        </div>
    </div>
</div>

<style>
.string-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.string-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.string-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.string-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.string-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.string-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;}

.custom-switch-primary .form-check-input:checked {
    background-color: #6366f1;
    border-color: #6366f1;
}
.custom-switch-primary .form-check-input { width: 3em; height: 1.5em; margin-right: 10px; cursor: pointer; }
.custom-switch-primary .form-check-label { cursor: pointer; padding-top: 4px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const chars = {
        upper: 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        lower: 'abcdefghijklmnopqrstuvwxyz',
        num: '0123456789'
    };

    $('str-generate').addEventListener('click', function() {
        const len = parseInt($('str-length').value) || 16;
        const count = parseInt($('str-count').value) || 10;
        
        let pool = '';
        if ($('str-upper').checked) pool += chars.upper;
        if ($('str-lower').checked) pool += chars.lower;
        if ($('str-num').checked) pool += chars.num;
        
        const custom = $('str-custom').value;
        if (custom) pool += custom;

        if (pool === '') {
            alert('Please select at least one character set or add custom characters.');
            return;
        }

        if (count > 100000) {
            alert('Please limit quantity to 100,000 for performance.');
            return;
        }

        // Using standard Math.random for speed with large quantities.
        // (For single cryptographically secure strings, Password Generator tool is recommended).
        const result = [];
        const poolLen = pool.length;
        
        for (let i = 0; i < count; i++) {
            let s = '';
            for (let j = 0; j < len; j++) {
                s += pool[Math.floor(Math.random() * poolLen)];
            }
            result.push(s);
        }

        $('str-output').value = result.join('\n');
        $('str-output-card').classList.remove('d-none');
        $('str-output-card').scrollIntoView({ behavior: 'smooth' });
    });

    $('copy-str').addEventListener('click', function() {
        $('str-output').select();
        document.execCommand('copy');
        const o = this.innerHTML;
        this.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\string-generator.blade.php ENDPATH**/ ?>