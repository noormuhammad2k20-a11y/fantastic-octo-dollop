<div class="row g-4 hex-cmyk-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 10px 40px rgba(99, 102, 241, 0.08);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-indigo" style="background: linear-gradient(135deg, #6366f1, #4338ca); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-palette"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e1b4b; letter-spacing: -0.5px;">Print-Ready Color Converter</h4>
                    <p class="text-muted small mb-0">Translate digital HEX codes into professional CMYK percentages for offset printing.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="p-4 rounded-4 bg-light-indigo border-indigo-100 border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50 text-indigo">Step 1: Color Selection</h6>
                            <div class="row g-3 align-items-end">
                                <div class="col-md-6">
                                    <label class="form-label-custom">HEX Color Code</label>
                                    <div class="input-group">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-start-3 text-muted fw-bold">#</span>
                                        <input type="text" id="v-hex" class="form-control form-control-lg border-0 bg-white shadow-sm fw-black h3 mb-0" value="6366F1" maxlength="6">
                                        <input type="color" id="v-picker" class="form-control form-control-lg border-0 bg-white shadow-sm rounded-end-3 p-1" style="max-width: 60px; height: auto;" value="#6366f1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap gap-2 mb-1">
                                        <button class="btn btn-sm btn-white border shadow-sm rounded-3 fw-bold preset-btn" data-hex="000000">Black</button>
                                        <button class="btn btn-sm btn-white border shadow-sm rounded-3 fw-bold preset-btn" data-hex="FFFFFF">White</button>
                                        <button class="btn btn-sm btn-white border shadow-sm rounded-3 fw-bold preset-btn" data-hex="FF0000">Red</button>
                                        <button class="btn btn-sm btn-white border shadow-sm rounded-3 fw-bold preset-btn" data-hex="00FF00">Green</button>
                                        <button class="btn btn-sm btn-white border shadow-sm rounded-3 fw-bold preset-btn" data-hex="0000FF">Blue</button>
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
        <div class="output-card-themed" style="--tool-hue: 239; --tool-color: #6366f1; --tool-bg: rgba(99, 102, 241, .04);">
            <div class="p-4">
                <div class="row g-4 align-items-center">
                    {{-- CMYK Breakdown --}}
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-white border shadow-sm">
                            <h6 class="fw-bold small mb-4 uppercase opacity-50">CMYK Percentages</h6>
                            <div class="vstack gap-3">
                                <div class="cmyk-row d-flex align-items-center gap-3">
                                    <div class="badge bg-cyan text-white p-2 rounded-3 fw-bold" style="width: 40px;">C</div>
                                    <div class="progress flex-grow-1" style="height: 12px;">
                                        <div id="bar-c" class="progress-bar bg-cyan" style="width: 58%;"></div>
                                    </div>
                                    <div class="fw-black text-dark" style="width: 50px;" id="out-c">58%</div>
                                </div>
                                <div class="cmyk-row d-flex align-items-center gap-3">
                                    <div class="badge bg-magenta text-white p-2 rounded-3 fw-bold" style="width: 40px;">M</div>
                                    <div class="progress flex-grow-1" style="height: 12px;">
                                        <div id="bar-m" class="progress-bar bg-magenta" style="width: 57%;"></div>
                                    </div>
                                    <div class="fw-black text-dark" style="width: 50px;" id="out-m">57%</div>
                                </div>
                                <div class="cmyk-row d-flex align-items-center gap-3">
                                    <div class="badge bg-yellow text-dark p-2 rounded-3 fw-bold" style="width: 40px;">Y</div>
                                    <div class="progress flex-grow-1" style="height: 12px;">
                                        <div id="bar-y" class="progress-bar bg-yellow" style="width: 0%;"></div>
                                    </div>
                                    <div class="fw-black text-dark" style="width: 50px;" id="out-y">0%</div>
                                </div>
                                <div class="cmyk-row d-flex align-items-center gap-3">
                                    <div class="badge bg-dark text-white p-2 rounded-3 fw-bold" style="width: 40px;">K</div>
                                    <div class="progress flex-grow-1" style="height: 12px;">
                                        <div id="bar-k" class="progress-bar bg-dark" style="width: 5%;"></div>
                                    </div>
                                    <div class="fw-black text-dark" style="width: 50px;" id="out-k">5%</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Visual Swatch --}}
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 bg-white border shadow-sm h-100 d-flex flex-column align-items-center justify-content-center">
                            <h6 class="fw-bold small mb-4 uppercase opacity-50">Color Preview</h6>
                            <div id="swatch" class="color-swatch-large shadow-lg" style="background-color: #6366f1;">
                                <div class="swatch-label">
                                    <span id="out-rgb">RGB: 99, 102, 241</span>
                                </div>
                            </div>
                            <div class="mt-4 vstack gap-2 text-center">
                                <div class="badge bg-indigo-soft text-indigo px-3 py-2 rounded-pill fw-bold" id="out-cmyk-str">cmyk(58%, 57%, 0%, 5%)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="p-4 bg-white border-top rounded-bottom-5">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button class="btn btn-indigo rounded-pill px-4 fw-bold text-white shadow-sm" id="copy-cmyk" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-copy me-2"></i>Copy CMYK
                        </button>
                        <button class="btn btn-outline-secondary rounded-pill px-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-undo me-2"></i>Reset
                        </button>
                    </div>
                    <div class="text-muted small fw-bold uppercase">
                        Mode: <span class="text-indigo">FOGRA39 / Generic CMYK</span>
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
    const swatch = document.getElementById('swatch');
    
    const outC = document.getElementById('out-c');
    const outM = document.getElementById('out-m');
    const outY = document.getElementById('out-y');
    const outK = document.getElementById('out-k');
    
    const barC = document.getElementById('bar-c');
    const barM = document.getElementById('bar-m');
    const barY = document.getElementById('bar-y');
    const barK = document.getElementById('bar-k');
    
    const outRGB = document.getElementById('out-rgb');
    const outCMYKStr = document.getElementById('out-cmyk-str');

    function convert() {
        let hex = hexInput.value.replace('#', '');
        if (hex.length !== 3 && hex.length !== 6) return;
        if (hex.length === 3) {
            hex = hex.split('').map(s => s + s).join('');
        }
        
        const r = parseInt(hex.substring(0, 2), 16);
        const g = parseInt(hex.substring(2, 4), 16);
        const b = parseInt(hex.substring(4, 6), 16);
        
        picker.value = '#' + hex;
        swatch.style.backgroundColor = '#' + hex;
        outRGB.textContent = `RGB: ${r}, ${g}, ${b}`;

        // RGB to CMYK
        let r_p = r / 255;
        let g_p = g / 255;
        let b_p = b / 255;
        
        let k = 1 - Math.max(r_p, g_p, b_p);
        let c = (k === 1) ? 0 : (1 - r_p - k) / (1 - k);
        let m = (k === 1) ? 0 : (1 - g_p - k) / (1 - k);
        let y = (k === 1) ? 0 : (1 - b_p - k) / (1 - k);
        
        c = Math.round(c * 100);
        m = Math.round(m * 100);
        y = Math.round(y * 100);
        k = Math.round(k * 100);

        outC.textContent = c + '%';
        outM.textContent = m + '%';
        outY.textContent = y + '%';
        outK.textContent = k + '%';
        
        barC.style.width = c + '%';
        barM.style.width = m + '%';
        barY.style.width = y + '%';
        barK.style.width = k + '%';
        
        outCMYKStr.textContent = `cmyk(${c}%, ${m}%, ${y}%, ${k}%)`;
    }

    hexInput.addEventListener('input', convert);
    picker.addEventListener('input', () => {
        hexInput.value = picker.value.replace('#', '').toUpperCase();
        convert();
    });

    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            hexInput.value = btn.dataset.hex;
            convert();
        });
    });

    document.getElementById('reset-calc').addEventListener('click', () => {
        hexInput.value = '6366F1';
        convert();
    });

    document.getElementById('copy-cmyk').addEventListener('click', function() {
        navigator.clipboard.writeText(outCMYKStr.textContent).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

    convert();
});
</script>

<style>
.hex-cmyk-rebuilt .form-label-custom { font-size:.7rem; font-weight:900; text-transform:uppercase; letter-spacing:1px; color:#6366f1; opacity:.7; margin-bottom:8px; display:block; }
.bg-light-indigo { background-color: #f5f7ff; }
.border-indigo-100 { border-color: #e0e7ff !important; }
.bg-indigo-soft { background-color: rgba(99, 102, 241, 0.1); }
.fw-black { font-weight: 900; }
.uppercase { text-transform: uppercase; }

.bg-cyan { background-color: #06b6d4 !important; }
.bg-magenta { background-color: #d946ef !important; }
.bg-yellow { background-color: #eab308 !important; }

.color-swatch-large {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 8px solid #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.swatch-label {
    background: rgba(0,0,0,0.5);
    color: #fff;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: bold;
    backdrop-filter: blur(4px);
}

.pulse-indigo { animation: indigo-pulse 3s infinite; }
@keyframes indigo-pulse {
    0% { box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.4); }
    70% { box-shadow: 0 0 0 15px rgba(99, 102, 241, 0); }
    100% { box-shadow: 0 0 0 0 rgba(99, 102, 241, 0); }
}

.btn-white { background: #fff; color: #6366f1; border: 1px solid #e0e7ff; }
.btn-white:hover { background: #6366f1; color: #fff; }
</style>

