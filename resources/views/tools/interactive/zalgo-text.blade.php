<div class="row g-4">
    {{-- Input Card --}}
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label-custom mb-0">Original Content</label>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light-custom" id="btn-sample" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-vial me-1"></i> Sample
                            </button>
                            <button class="btn btn-sm btn-light-custom" id="btn-clear" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-trash-alt me-1"></i> Clear
                            </button>
                        </div>
                    </div>
                    <textarea id="text-input" class="form-control tool-textarea" rows="4" placeholder="Enter your text here..."></textarea>
                </div>

                <div class="options-grid p-4 rounded-4" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label-custom mb-0">Glitch Intensity</label>
                                <span class="badge bg-danger rounded-pill px-3" id="intensity-val">10</span>
                            </div>
                            <input type="range" class="form-range" id="zalgo-strength" min="1" max="50" value="10">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom d-block">Artifact Positioning</label>
                            <div class="d-flex flex-wrap gap-4 mt-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="zalgo-up" checked>
                                    <label class="form-check-label small fw-bold" for="zalgo-up">Above</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="zalgo-mid" checked>
                                    <label class="form-check-label small fw-bold" for="zalgo-mid">Middle</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="zalgo-down" checked>
                                    <label class="form-check-label small fw-bold" for="zalgo-down">Below</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,0.04);">
            <div class="output-header d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-skull fs-4 me-2" style="color:#ef4444"></i>
                    <h6 class="fw-bold mb-0">Corrupted Result</h6>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary" id="btn-undo" disabled>
                        <i class="fas fa-undo me-1"></i> Undo
                    </button>
                    <button class="btn btn-sm btn-outline-primary" id="btn-download" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download me-1"></i> Download
                    </button>
                    <button class="btn btn-danger btn-sm px-4" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Corruption
                    </button>
                </div>
            </div>
            
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="10" readonly placeholder="The void will manifest here..."></textarea>
            
            <div class="mt-3 p-3 bg-white rounded-3 border d-flex justify-content-between align-items-center small text-secondary">
                <div id="stats-text"><i class="fas fa-info-circle me-1"></i> Manifestation ready</div>
                <div class="badge bg-light text-danger border" id="mode-badge">Void Protocol Active</div>
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
.tool-textarea { border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 1.25rem; font-family: 'Inter', sans-serif; font-size: 1.2rem; line-height: 1.8; transition: all 0.2s; }
.tool-textarea:focus { border-color: #ef4444; box-shadow: 0 0 0 4px rgba(239,68,68,0.1); outline: none; }
.btn-light-custom { background: #f1f5f9; border: none; color: #475569; font-weight: 600; border-radius: 10px; }
.btn-light-custom:hover { background: #e2e8f0; color: #1e293b; }
.output-card-themed { background: var(--tool-bg); border: 1px solid rgba(239,68,68,0.1); border-radius: 24px; padding: 2rem; }
.form-range::-webkit-slider-thumb { background: #ef4444; }
.form-check-input:checked { background-color: #ef4444; border-color: #ef4444; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('text-input');
    const output = document.getElementById('output-text');
    const strength = document.getElementById('zalgo-strength');
    const strengthVal = document.getElementById('intensity-val');
    const up = document.getElementById('zalgo-up');
    const mid = document.getElementById('zalgo-mid');
    const down = document.getElementById('zalgo-down');
    
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');
    const btnUndo = document.getElementById('btn-undo');
    const statsText = document.getElementById('stats-text');

    const zalgo_chars = {
        up: ['\u030d', '\u030e', '\u0304', '\u0305', '\u033f', '\u0311', '\u0306', '\u0310', '\u0352', '\u033e', '\u0341', '\u0343', '\u0344', '\u034a', '\u034b', '\u034c', '\u0303', '\u0302', '\u030c', '\u0350', '\u0300', '\u0301', '\u030b', '\u030f', '\u0312', '\u0313', '\u0314', '\u033d', '\u0309', '\u0363', '\u0364', '\u0365', '\u0366', '\u0367', '\u0368', '\u0369', '\u036a', '\u036b', '\u036c', '\u036d', '\u036e', '\u036f', '\u033e', '\u035b', '\u0346', '\u031a'],
        mid: ['\u0315', '\u031b', '\u0340', '\u0341', '\u0358', '\u0321', '\u0322', '\u0327', '\u0328', '\u0334', '\u0335', '\u0336', '\u034f', '\u035c', '\u035d', '\u035e', '\u035f', '\u0360', '\u0362', '\u0338', '\u0337', '\u0361', '\u0489'],
        down: ['\u0316', '\u0317', '\u0318', '\u0319', '\u031c', '\u031d', '\u031e', '\u031f', '\u0320', '\u0324', '\u0325', '\u0326', '\u0329', '\u032a', '\u032b', '\u032c', '\u032d', '\u032e', '\u032f', '\u0330', '\u0331', '\u0332', '\u0333', '\u0339', '\u033a', '\u033b', '\u033c', '\u0345', '\u0347', '\u0348', '\u0349', '\u034d', '\u034e', '\u0353', '\u0354', '\u0355', '\u0356', '\u0359', '\u035a', '\u0323']
    };

    let history = [];

    function rand(max) { return Math.floor(Math.random() * max); }

    function generate() {
        const text = input.value;
        if (!text) {
            output.value = '';
            statsText.innerHTML = '<i class="fas fa-info-circle me-1"></i> Manifestation ready';
            return;
        }

        const s = parseInt(strength.value);
        let res = '';

        for (let i = 0; i < text.length; i++) {
            res += text[i];
            
            if (up.checked) {
                for (let j = 0; j < s / 2; j++) res += zalgo_chars.up[rand(zalgo_chars.up.length)];
            }
            if (mid.checked) {
                for (let j = 0; j < s / 4; j++) res += zalgo_chars.mid[rand(zalgo_chars.mid.length)];
            }
            if (down.checked) {
                for (let j = 0; j < s / 2; j++) res += zalgo_chars.down[rand(zalgo_chars.down.length)];
            }
        }
        output.value = res;
        statsText.innerHTML = `<i class="fas fa-skull text-danger me-1"></i> Corruption Level: <strong>${s}</strong> | Result Length: <strong>${res.length}</strong>`;
        
        output.classList.add('border-danger');
        setTimeout(() => output.classList.remove('border-danger'), 300);
    }

    [input, strength, up, mid, down].forEach(el => {
        el.addEventListener('input', () => {
            if (el === strength) strengthVal.textContent = strength.value;
            if (output.value && el !== input) {
                history.push(output.value);
                btnUndo.disabled = false;
            }
            generate();
        });
    });

    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        statsText.innerHTML = '<i class="fas fa-info-circle me-1"></i> Manifestation ready';
        history = [];
        btnUndo.disabled = true;
    });

    btnSample.addEventListener('click', () => {
        input.value = "HE COMES FOR THE CODE";
        generate();
    });

    btnUndo.addEventListener('click', () => {
        if (history.length > 0) {
            output.value = history.pop();
            if (history.length === 0) btnUndo.disabled = true;
        }
    });

    btnCopy.addEventListener('click', () => {
        if (!output.value) return;
        navigator.clipboard.writeText(output.value);
        const btn = btnCopy;
        const old = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        btn.classList.replace('btn-danger', 'btn-dark');
        setTimeout(() => {
            btn.innerHTML = old;
            btn.classList.replace('btn-dark', 'btn-danger');
        }, 2000);
    });

    btnDownload.addEventListener('click', () => {
        if (!output.value) return;
        const blob = new Blob([output.value], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `zalgo-${Date.now()}.txt`;
        a.click();
        URL.revokeObjectURL(url);
    });

    // Initial
    btnSample.click();
});
</script>

