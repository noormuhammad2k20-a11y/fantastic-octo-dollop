<div class="row g-4">
    
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="mb-0">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label-custom mb-0">Input Message</label>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light-custom" id="btn-sample" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-vial me-1"></i> Sample
                            </button>
                            <button class="btn btn-sm btn-light-custom" id="btn-clear" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-trash-alt me-1"></i> Clear
                            </button>
                        </div>
                    </div>
                    <textarea id="input-text" class="form-control tool-textarea" rows="4" placeholder="Type your text here to shrink it..."></textarea>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,0.04);">
            <div class="output-header mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-magic fs-4 me-2" style="color:#4f46e5"></i>
                    <h6 class="fw-bold mb-0">Shrunk Variations</h6>
                </div>
            </div>
            
            <div class="row g-4">
                
                <div class="col-12">
                    <div class="variation-item p-4 rounded-4 border bg-white shadow-sm">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Small Caps Variation</h6>
                                <p class="text-muted small mb-0">Tᴜʀɴs ᴛᴇxᴛ ɪɴᴛᴏ sᴍᴀʟʟᴇʀ ᴄᴀᴘɪᴛᴀʟs</p>
                            </div>
                            <button class="btn btn-primary btn-sm rounded-pill px-4" onclick="copyResult('output-small-caps', this)">
                                <i class="fas fa-copy me-1"></i> Copy
                            </button>
                        </div>
                        <textarea id="output-small-caps" class="form-control tool-textarea bg-light" rows="2" readonly></textarea>
                    </div>
                </div>

                
                <div class="col-12">
                    <div class="variation-item p-4 rounded-4 border bg-white shadow-sm">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Superscript Variation</h6>
                                <p class="text-muted small mb-0">ᵀᵘʳⁿˢ ᵗᵉˣᵗ ⁱⁿᵗᵒ ʰⁱᵍʰᵉʳ ˢᵐᵃˡˡ ᶜʰᵃʳᵃᶜᵗᵉʳˢ</p>
                            </div>
                            <button class="btn btn-primary btn-sm rounded-pill px-4" onclick="copyResult('output-superscript', this)">
                                <i class="fas fa-copy me-1"></i> Copy
                            </button>
                        </div>
                        <textarea id="output-superscript" class="form-control tool-textarea bg-light" rows="2" readonly></textarea>
                    </div>
                </div>

                
                <div class="col-12">
                    <div class="variation-item p-4 rounded-4 border bg-white shadow-sm">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Subscript Variation</h6>
                                <p class="text-muted small mb-0">ₜᵤᵣₙₛ ₜₑₓₜ ᵢₙₜₒ ₗₒwₑᵣ ₛₘₐₗₗ 𝒸ₕₐᵣₐ𝒸ₜₑᵣₛ</p>
                            </div>
                            <button class="btn btn-primary btn-sm rounded-pill px-4" onclick="copyResult('output-subscript', this)">
                                <i class="fas fa-copy me-1"></i> Copy
                            </button>
                        </div>
                        <textarea id="output-subscript" class="form-control tool-textarea bg-light" rows="2" readonly></textarea>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 p-3 bg-white rounded-3 border d-flex justify-content-between align-items-center small text-secondary">
                <div><i class="fas fa-info-circle me-1 text-primary"></i> These variations use Unicode characters compatible with social media.</div>
                <div class="badge bg-light text-primary border">UTF-8</div>
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
.output-card-themed { background: var(--tool-bg); border: 1px solid rgba(79,70,229,0.1); border-radius: 24px; padding: 2rem; }
.variation-item { transition: all 0.2s ease; }
.variation-item:hover { border-color: #4f46e5 !important; transform: translateY(-2px); }
</style>

<script>
window.copyResult = function(id, btn) {
    const el = document.getElementById(id);
    if (!el.value) return;
    navigator.clipboard.writeText(el.value);
    
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
    btn.classList.replace('btn-primary', 'btn-dark');
    setTimeout(() => {
        btn.innerHTML = originalText;
        btn.classList.replace('btn-dark', 'btn-primary');
    }, 2000);
};

document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const outSmallCaps = document.getElementById('output-small-caps');
    const outSuper = document.getElementById('output-superscript');
    const outSub = document.getElementById('output-subscript');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');

    const maps = {
        smallCaps: { 'a': 'ᴀ', 'b': 'ʙ', 'c': 'ᴄ', 'd': 'ᴅ', 'e': 'ᴇ', 'f': 'ꜰ', 'g': 'ɢ', 'h': 'ʜ', 'i': 'ɪ', 'j': 'ᴊ', 'k': 'ᴋ', 'l': 'ʟ', 'm': 'ᴍ', 'n': 'ɴ', 'o': 'ᴏ', 'p': 'ᴘ', 'q': 'ǫ', 'r': 'ʀ', 's': 's', 't': 'ᴛ', 'u': 'ᴜ', 'v': 'ᴠ', 'w': 'ᴡ', 'x': 'x', 'y': 'ʏ', 'z': 'ᴢ' },
        super: { 'a': 'ᵃ', 'b': 'ᵇ', 'c': 'ᶜ', 'd': 'ᵈ', 'e': 'ᵉ', 'f': 'ᶠ', 'g': 'ᵍ', 'h': 'ʰ', 'i': 'ⁱ', 'j': 'ʲ', 'k': 'ᵏ', 'l': 'ˡ', 'm': 'ᵐ', 'n': 'ⁿ', 'o': 'ᵒ', 'p': 'ᵖ', 'r': 'ʳ', 's': 'ˢ', 't': 'ᵗ', 'u': 'ᵘ', 'v': 'ᵛ', 'w': 'ʷ', 'x': 'ˣ', 'y': 'ʸ', 'z': 'ᶻ', '0': '⁰', '1': '¹', '2': '²', '3': '³', '4': '⁴', '5': '⁵', '6': '⁶', '7': '⁷', '8': '⁸', '9': '⁹' },
        sub: { 'a': 'ₐ', 'e': 'ₑ', 'h': 'ₕ', 'i': 'ᵢ', 'j': 'ⱼ', 'k': 'ₖ', 'l': 'ₗ', 'm': 'ₘ', 'n': 'ₙ', 'o': 'ₒ', 'p': 'ₚ', 'r': 'ᵣ', 's': 'ₛ', 't': 'ₜ', 'u': 'ᵤ', 'v': 'ᵥ', 'x': 'ₓ', '0': '₀', '1': '₁', '2': '₂', '3': '₃', '4': '₄', '5': '₅', '6': '₆', '7': '₇', '8': '₈', '9': '₉' }
    };

    function convert(text, map) {
        return text.toLowerCase().split('').map(char => map[char] || char).join('');
    }

    input.addEventListener('input', () => {
        const val = input.value;
        outSmallCaps.value = convert(val, maps.smallCaps);
        outSuper.value = convert(val, maps.super);
        outSub.value = convert(val, maps.sub);
    });

    btnClear.addEventListener('click', () => {
        input.value = '';
        input.dispatchEvent(new Event('input'));
    });

    btnSample.addEventListener('click', () => {
        input.value = "Premium Tool Suite";
        input.dispatchEvent(new Event('input'));
    });

    // Initial
    btnSample.click();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\small-text-generator.blade.php ENDPATH**/ ?>