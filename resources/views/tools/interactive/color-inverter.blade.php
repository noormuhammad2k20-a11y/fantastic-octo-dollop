<div class="row g-4 color-inverter-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #111827, #374151); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-adjust"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#111827; letter-spacing: -0.5px;">Universal Color Inverter</h4>
                    <p class="text-muted small mb-0">Generate the perfect negative/complement of any color for accessibility and high-contrast design.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Select Base Color</h6>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-6">
                                    <label class="form-label-custom">HEX Code</label>
                                    <div class="input-group">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-start-3 text-muted fw-bold">#</span>
                                        <input type="text" id="v-hex" class="form-control form-control-lg border-0 bg-white shadow-sm fw-black h3 mb-0" value="111827" maxlength="6">
                                        <input type="color" id="v-picker" class="form-control form-control-lg border-0 bg-white shadow-sm rounded-end-3 p-1" style="max-width: 60px;" value="#111827">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap gap-2">
                                        <button class="btn btn-sm btn-dark rounded-3 px-3 preset-btn" data-hex="000000">Pure Black</button>
                                        <button class="btn btn-sm btn-white border rounded-3 px-3 preset-btn" data-hex="FFFFFF">Pure White</button>
                                        <button class="btn btn-sm btn-primary rounded-3 px-3 preset-btn" data-hex="3B82F6">System Blue</button>
                                        <button class="btn btn-sm btn-danger rounded-3 px-3 preset-btn" data-hex="EF4444">Alert Red</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 220; --tool-color: #111827; --tool-bg: rgba(17, 24, 39, .04);">
            <div class="p-4">
                <div class="row g-4 align-items-center">
                    {{-- Comparison --}}
                    <div class="col-md-12">
                        <div class="d-flex flex-column flex-md-row gap-3">
                            <div class="invert-box flex-grow-1 p-5 rounded-4 border text-center transition-all" id="box-orig" style="background:#111827;">
                                <div class="badge bg-white text-dark mb-2 px-3 py-1 rounded-pill fw-bold small uppercase">Original</div>
                                <div class="h3 fw-black text-white" id="hex-orig">#111827</div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-exchange-alt fa-2x opacity-25"></i>
                            </div>
                            <div class="invert-box flex-grow-1 p-5 rounded-4 border text-center transition-all shadow-lg" id="box-inv" style="background:#EEE7D8;">
                                <div class="badge bg-dark text-white mb-2 px-3 py-1 rounded-pill fw-bold small uppercase">Inverted</div>
                                <div class="h3 fw-black text-dark" id="hex-inv">#EEE7D8</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="p-4 bg-white border-top rounded-bottom-5">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button class="btn btn-dark rounded-pill px-4 fw-bold shadow-sm" id="copy-inv" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-copy me-2"></i>Copy Inverted HEX
                        </button>
                        <button class="btn btn-outline-secondary rounded-pill px-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-undo me-2"></i>Reset
                        </button>
                    </div>
                    <div class="text-muted small fw-bold uppercase" id="out-rgb">
                        RGB: <span class="text-dark">238, 231, 216</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const hexInput = document.getElementById('v-hex');
    const picker = document.getElementById('v-picker');
    const boxOrig = document.getElementById('box-orig');
    const boxInv = document.getElementById('box-inv');
    const hexOrig = document.getElementById('hex-orig');
    const hexInv = document.getElementById('hex-inv');
    const outRgb = document.getElementById('out-rgb');

    function invert() {
        let hex = hexInput.value.replace('#', '');
        if (hex.length !== 3 && hex.length !== 6) return;
        if (hex.length === 3) hex = hex.split('').map(s => s + s).join('');
        
        const r = parseInt(hex.substring(0, 2), 16);
        const g = parseInt(hex.substring(2, 4), 16);
        const b = parseInt(hex.substring(4, 6), 16);
        
        const r_i = 255 - r;
        const g_i = 255 - g;
        const b_i = 255 - b;
        
        const invHex = '#' + [r_i, g_i, b_i].map(x => x.toString(16).padStart(2, '0')).join('').toUpperCase();
        
        picker.value = '#' + hex;
        boxOrig.style.backgroundColor = '#' + hex;
        boxInv.style.backgroundColor = invHex;
        
        hexOrig.textContent = '#' + hex.toUpperCase();
        hexInv.textContent = invHex;
        
        // Dynamic text color for boxes based on brightness
        const brightOrig = (r * 299 + g * 587 + b * 114) / 1000;
        const brightInv = (r_i * 299 + g_i * 587 + b_i * 114) / 1000;
        
        hexOrig.style.color = brightOrig > 128 ? '#000' : '#fff';
        hexInv.style.color = brightInv > 128 ? '#000' : '#fff';
        
        outRgb.innerHTML = `RGB: <span class="text-dark">${r_i}, ${g_i}, ${b_i}</span>`;
    }

    hexInput.addEventListener('input', invert);
    picker.addEventListener('input', () => { hexInput.value = picker.value.replace('#', '').toUpperCase(); invert(); });

    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            hexInput.value = btn.dataset.hex;
            invert();
        });
    });

    document.getElementById('reset-calc').addEventListener('click', () => {
        hexInput.value = '111827';
        invert();
    });

    document.getElementById('copy-inv').addEventListener('click', function() {
        navigator.clipboard.writeText(hexInv.textContent).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

    invert();
});
</script>

<style>
.color-inverter-rebuilt .form-label-custom { font-size:.7rem; font-weight:900; text-transform:uppercase; letter-spacing:1px; color:#111827; opacity:.7; margin-bottom:8px; display:block; }
.fw-black { font-weight: 900; }
.uppercase { text-transform: uppercase; }
.transition-all { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }

.invert-box { border: 4px solid #fff; min-height: 180px; display: flex; flex-direction: column; justify-content: center; }
.invert-box:hover { transform: scale(1.02); }

.btn-white { background: #fff; color: #111827; border: 1px solid #e5e7eb; }
</style>

