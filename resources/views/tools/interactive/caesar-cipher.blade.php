<div class="row g-4 caesar-cipher-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0 text-white" style="border-radius: 24px; background: #0f172a; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-lg" style="background: linear-gradient(135deg, #6366f1, #4f46e5); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-user-secret"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="letter-spacing: -0.5px;">Caesar Cipher</h4>
                    <p class="text-indigo-300 small mb-0 opacity-70">Encrypt and decrypt messages using the classic substitution cipher.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    <div class="col-md-8">
                        <div class="p-4 rounded-4 bg-white bg-opacity-5 border border-white border-opacity-10 h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50 text-indigo-400">Message to Process</h6>
                            <textarea id="v-input" class="form-control border-0 bg-dark bg-opacity-50 text-white shadow-sm rounded-4 p-4" style="min-height: 200px; font-family: 'Courier New', Courier, monospace;" placeholder="Enter your secret message here..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-white bg-opacity-5 border border-white border-opacity-10 h-100">
                            <h6 class="fw-bold small mb-4 uppercase opacity-50 text-indigo-400">Cipher Key</h6>
                            <div class="mb-4">
                                <label class="form-label small fw-bold mb-3">Shift Value: <span id="d-shift" class="text-indigo-400">13</span></label>
                                <input type="range" class="form-range custom-range" id="v-shift" min="1" max="25" value="13">
                            </div>
                            <div class="vstack gap-2">
                                <button class="btn btn-indigo w-100 fw-bold rounded-3 preset-btn" data-shift="13">Apply ROT13</button>
                                <button class="btn btn-outline-light w-100 fw-bold rounded-3" id="random-shift">Random Shift</button>
                                <button class="btn btn-outline-light w-100 fw-bold rounded-3" id="toggle-mode"><i class="fas fa-lock me-2"></i>Mode: Encrypt</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 239; --tool-color: #6366f1; --tool-bg: rgba(99, 102, 241, .04);">
            <div class="p-4">
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="p-4 rounded-4 bg-white border shadow-sm position-relative">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Transformed Ciphertext</h6>
                            <div class="code-result-wrapper" style="min-height: 150px;">
                                <p id="out-text" class="mb-0 text-dark fw-bold" style="font-family: 'Courier New', Courier, monospace; word-break: break-all; white-space: pre-wrap;">Processed text will appear here...</p>
                            </div>
                            <button class="btn btn-indigo position-absolute top-0 end-0 mt-3 me-3 rounded-pill px-4 fw-bold shadow-sm" id="copy-text">
                                <i class="fas fa-copy me-2"></i>Copy Result
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white border-top rounded-bottom-5">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="badge bg-indigo-soft text-indigo px-3 py-2 rounded-pill fw-bold">Algorithm: Substitution Cipher</div>
                    <div class="text-muted small fw-bold uppercase">
                        Strength: <span class="text-indigo">Classic / Educational</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('v-input');
    const shift = document.getElementById('v-shift');
    const dShift = document.getElementById('d-shift');
    const outText = document.getElementById('out-text');

    let decryptMode = false;

    function process() {
        const text = input.value;
        const s = parseInt(shift.value);
        dShift.textContent = s;
        
        if (!text.trim()) {
            outText.textContent = "Processed text will appear here...";
            return;
        }

        const actualShift = decryptMode ? (26 - s) : s;

        const result = text.split('').map(char => {
            if (char.match(/[a-z]/i)) {
                const code = char.charCodeAt(0);
                let base = (code >= 65 && code <= 90) ? 65 : 97;
                return String.fromCharCode(((code - base + actualShift) % 26) + base);
            }
            return char;
        }).join('');

        outText.textContent = result;
    }

    input.addEventListener('input', process);
    shift.addEventListener('input', process);

    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            shift.value = btn.dataset.shift;
            process();
        });
    });

    document.getElementById('random-shift').addEventListener('click', () => {
        shift.value = Math.floor(Math.random() * 25) + 1;
        process();
    });

    document.getElementById('toggle-mode').addEventListener('click', function() {
        decryptMode = !decryptMode;
        this.innerHTML = decryptMode 
            ? '<i class="fas fa-unlock me-2"></i>Mode: Decrypt'
            : '<i class="fas fa-lock me-2"></i>Mode: Encrypt';
        process();
    });

    document.getElementById('copy-text').addEventListener('click', function() {
        navigator.clipboard.writeText(outText.textContent).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

    process();
});
</script>

<style>
.caesar-cipher-rebuilt .form-label-custom { font-size:.7rem; font-weight:900; text-transform:uppercase; letter-spacing:1px; color:#6366f1; opacity:.7; margin-bottom:8px; display:block; }
.text-indigo-300 { color: #a5b4fc; }
.text-indigo-400 { color: #818cf8; }
.bg-indigo-soft { background-color: rgba(99, 102, 241, 0.1); }
.uppercase { text-transform: uppercase; }

.btn-indigo { background: #4f46e5; color: #fff; border: none; }
.btn-indigo:hover { background: #4338ca; }

.custom-range::-webkit-slider-thumb { background: #6366f1; border: 3px solid #fff; }
</style>

