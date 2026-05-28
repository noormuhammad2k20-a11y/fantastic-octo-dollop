<div class="row g-4 password-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="output-card-themed mb-4" id="pass-output-card" style="--tool-hue:150;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04); padding: 1.5rem;">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="small text-uppercase fw-bold text-muted">Generated Password</span>
                        <div id="pass-strength" class="badge bg-secondary">Waiting...</div>
                    </div>
                    <div class="d-flex gap-2">
                        <input type="text" id="pass-result" class="form-control form-control-lg fs-3 fw-bold text-center font-monospace bg-white" readonly placeholder="Click Generate">
                        <button class="btn btn-dark px-4 rounded-3" id="pass-copy" title="Copy to Clipboard">
                            <i class="fas fa-copy fs-5"></i>
                        </button>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between mb-2">
                            <label class="form-label-custom mb-0">Password Length</label>
                            <span id="pass-length-val" class="fw-bold fs-5 text-success">16</span>
                        </div>
                        <input type="range" class="form-range custom-range-success" id="pass-length" min="4" max="64" value="16">
                    </div>
                    
                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded-3 border">
                            <div class="form-check form-switch mb-3 custom-switch-success">
                                <input class="form-check-input" type="checkbox" id="pass-upper" checked>
                                <label class="form-check-label fw-bold" for="pass-upper">Uppercase (A-Z)</label>
                            </div>
                            <div class="form-check form-switch custom-switch-success">
                                <input class="form-check-input" type="checkbox" id="pass-lower" checked>
                                <label class="form-check-label fw-bold" for="pass-lower">Lowercase (a-z)</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded-3 border">
                            <div class="form-check form-switch mb-3 custom-switch-success">
                                <input class="form-check-input" type="checkbox" id="pass-num" checked>
                                <label class="form-check-label fw-bold" for="pass-num">Numbers (0-9)</label>
                            </div>
                            <div class="form-check form-switch custom-switch-success">
                                <input class="form-check-input" type="checkbox" id="pass-sym" checked>
                                <label class="form-check-label fw-bold" for="pass-sym">Symbols (!@#$%)</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="bg-light p-3 rounded-3 border">
                            <div class="form-check form-switch custom-switch-success">
                                <input class="form-check-input" type="checkbox" id="pass-exc">
                                <label class="form-check-label fw-bold" for="pass-exc">Exclude Ambiguous Characters (i, l, 1, L, o, 0, O)</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto fw-bold text-white fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="pass-generate" style="min-width: 280px; max-width: 100%; background:#10b981;border:none;">
                        <i class="fas fa-sync-alt me-2"></i>Generate Password
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.password-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.password-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.password-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.password-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.password-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.password-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block}

.custom-range-success::-webkit-slider-thumb { background: #10b981; }
.custom-range-success::-moz-range-thumb { background: #10b981; }
.custom-range-success::-ms-thumb { background: #10b981; }

.custom-switch-success .form-check-input:checked {
    background-color: #10b981;
    border-color: #10b981;
}
.custom-switch-success .form-check-input { width: 3em; height: 1.5em; margin-right: 10px; cursor: pointer; }
.custom-switch-success .form-check-label { cursor: pointer; padding-top: 4px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    $('pass-length').addEventListener('input', function() {
        $('pass-length-val').textContent = this.value;
    });

    const chars = {
        upper: 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        lower: 'abcdefghijklmnopqrstuvwxyz',
        num: '0123456789',
        sym: '!@#$%^&*()_+~`|}{[]:;?><,./-=',
        ambig: 'il1Lo0O'
    };

    $('pass-generate').addEventListener('click', generatePassword);

    function generatePassword() {
        const len = parseInt($('pass-length').value);
        let pool = '';
        if ($('pass-upper').checked) pool += chars.upper;
        if ($('pass-lower').checked) pool += chars.lower;
        if ($('pass-num').checked) pool += chars.num;
        if ($('pass-sym').checked) pool += chars.sym;

        if (pool === '') {
            alert('Please select at least one character type.');
            return;
        }

        if ($('pass-exc').checked) {
            for (let i = 0; i < chars.ambig.length; i++) {
                pool = pool.split(chars.ambig[i]).join('');
            }
        }

        let password = '';
        const array = new Uint32Array(len);
        window.crypto.getRandomValues(array);
        
        for (let i = 0; i < len; i++) {
            password += pool[array[i] % pool.length];
        }

        $('pass-result').value = password;
        updateStrength(password);
    }

    function updateStrength(pwd) {
        const sBtn = $('pass-strength');
        let score = 0;
        if (pwd.length > 8) score++;
        if (pwd.length > 12) score++;
        if (/[A-Z]/.test(pwd)) score++;
        if (/[0-9]/.test(pwd)) score++;
        if (/[^A-Za-z0-9]/.test(pwd)) score++;

        sBtn.className = 'badge';
        if (score <= 2) {
            sBtn.textContent = 'Weak';
            sBtn.classList.add('bg-danger');
        } else if (score <= 4) {
            sBtn.textContent = 'Good';
            sBtn.classList.add('bg-warning', 'text-dark');
        } else {
            sBtn.textContent = 'Strong';
            sBtn.classList.add('bg-success');
        }
    }

    $('pass-copy').addEventListener('click', function() {
        const res = $('pass-result');
        if (!res.value) return;
        res.select();
        document.execCommand('copy');
        const o = this.innerHTML;
        this.innerHTML = '<i class="fas fa-check"></i>';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    // Auto-generate on load
    generatePassword();
});
</script>

