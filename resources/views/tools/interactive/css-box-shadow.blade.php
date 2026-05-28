<div class="row g-4 box-shadow-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 10px 40px rgba(79, 70, 229, 0.08);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #4f46e5, #3730a3); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e1b4b; letter-spacing: -0.5px;">CSS Depth Architect</h4>
                    <p class="text-muted small mb-0">Design professional box-shadow effects with real-time visual feedback and clean CSS output.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Parameters --}}
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-4 uppercase opacity-50 text-primary">Shadow Parameters</h6>
                            <div class="row g-4">
                                <div class="col-6">
                                    <label class="form-label-custom">Horizontal Offset (<span id="d-h">10</span>px)</label>
                                    <input type="range" class="form-range custom-range" id="v-h" min="-100" max="100" value="10">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Vertical Offset (<span id="d-v">10</span>px)</label>
                                    <input type="range" class="form-range custom-range" id="v-v" min="-100" max="100" value="10">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Blur Radius (<span id="d-b">20</span>px)</label>
                                    <input type="range" class="form-range custom-range" id="v-b" min="0" max="100" value="20">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Spread Radius (<span id="d-s">0</span>px)</label>
                                    <input type="range" class="form-range custom-range" id="v-s" min="-50" max="50" value="0">
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Shadow Opacity (<span id="d-a">0.2</span>)</label>
                                    <input type="range" class="form-range custom-range" id="v-a" min="0" max="1" step="0.01" value="0.2">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Color & Options --}}
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-primary-subtle">
                            <h6 class="fw-bold small mb-3 uppercase text-primary opacity-70">Appearance</h6>
                            <div class="vstack gap-4">
                                <div>
                                    <label class="form-label-custom">Shadow Color</label>
                                    <div class="input-group">
                                        <input type="color" id="v-color" class="form-control form-control-lg border-0 bg-light rounded-3 p-1" style="height: 50px;" value="#000000">
                                    </div>
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center p-3 bg-light rounded-3">
                                    <label class="form-check-label fw-bold small text-muted mb-0">Inset Shadow</label>
                                    <input class="form-check-input" type="checkbox" id="v-inset">
                                </div>
                                <hr class="my-1 opacity-10">
                                <div class="p-3 rounded-3 bg-primary-soft text-center">
                                    <div class="small fw-bold text-primary mb-1 uppercase">Recommended Presets</div>
                                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                                        <button class="btn btn-xs btn-white border preset-btn" data-h="0" data-v="4" data-b="20" data-s="0" data-a="0.1">Soft</button>
                                        <button class="btn btn-xs btn-white border preset-btn" data-h="0" data-v="10" data-b="30" data-s="-5" data-a="0.2">Heavy</button>
                                        <button class="btn btn-xs btn-white border preset-btn" data-h="0" data-v="0" data-b="15" data-s="5" data-a="0.15">Glow</button>
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
        <div class="output-card-themed" style="--tool-hue: 243; --tool-color: #4f46e5; --tool-bg: rgba(79, 70, 229, .04);">
            <div class="p-4">
                <div class="row g-4 align-items-center">
                    {{-- Preview --}}
                    <div class="col-md-6">
                        <div class="preview-area p-5 rounded-4 bg-white border shadow-sm d-flex align-items-center justify-content-center" style="min-height: 300px; background-image: radial-gradient(#e2e8f0 1px, transparent 1px); background-size: 20px 20px;">
                            <div id="preview-box" class="rounded-4 bg-primary text-white d-flex align-items-center justify-content-center fw-black" style="width: 150px; height: 150px; font-size: 1.2rem;">
                                PREVIEW
                            </div>
                        </div>
                    </div>

                    {{-- Code Output --}}
                    <div class="col-md-6">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Generated CSS</h6>
                            <div class="code-output-container position-relative">
                                <pre class="p-4 rounded-4 bg-dark text-white mb-4" style="font-size: 0.9rem; font-family: 'Fira Code', monospace; line-height: 1.6;"><code id="css-code">box-shadow: 10px 10px 20px 0px rgba(0, 0, 0, 0.2);</code></pre>
                                <button class="btn btn-primary btn-sm position-absolute top-0 end-0 mt-3 me-3 rounded-pill px-3" id="copy-css" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-1"></i> Copy
                                </button>
                            </div>
                            
                            <div class="p-3 rounded-4 bg-primary-soft border border-primary-subtle text-primary">
                                <i class="fas fa-info-circle me-2"></i>
                                <span class="small fw-bold">Compatibility: Works in all modern browsers (Chrome, Safari, Firefox, Edge).</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const h = document.getElementById('v-h'), v = document.getElementById('v-v');
    const b = document.getElementById('v-b'), s = document.getElementById('v-s');
    const a = document.getElementById('v-a'), color = document.getElementById('v-color');
    const inset = document.getElementById('v-inset'), preview = document.getElementById('preview-box');
    const cssCode = document.getElementById('css-code');

    function hexToRgb(hex) {
        const r = parseInt(hex.slice(1, 3), 16);
        const g = parseInt(hex.slice(3, 5), 16);
        const b = parseInt(hex.slice(5, 7), 16);
        return `${r}, ${g}, ${b}`;
    }

    function update() {
        const hVal = h.value, vVal = v.value, bVal = b.value, sVal = s.value;
        const aVal = a.value, colorVal = hexToRgb(color.value);
        const insetVal = inset.checked ? 'inset ' : '';
        
        const shadowStr = `${insetVal}${hVal}px ${vVal}px ${bVal}px ${sVal}px rgba(${colorVal}, ${aVal})`;
        
        preview.style.boxShadow = shadowStr;
        cssCode.textContent = `box-shadow: ${shadowStr};\n-webkit-box-shadow: ${shadowStr};\n-moz-box-shadow: ${shadowStr};`;
        
        document.getElementById('d-h').textContent = hVal;
        document.getElementById('d-v').textContent = vVal;
        document.getElementById('d-b').textContent = bVal;
        document.getElementById('d-s').textContent = sVal;
        document.getElementById('d-a').textContent = aVal;
    }

    [h, v, b, s, a, color, inset].forEach(el => el.addEventListener('input', update));

    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            h.value = btn.dataset.h; v.value = btn.dataset.v;
            b.value = btn.dataset.b; s.value = btn.dataset.s;
            a.value = btn.dataset.a;
            update();
        });
    });

    document.getElementById('copy-css').addEventListener('click', function() {
        navigator.clipboard.writeText(cssCode.textContent).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

    update();
});
</script>

<style>
.box-shadow-rebuilt .form-label-custom { font-size:.7rem; font-weight:900; text-transform:uppercase; letter-spacing:1px; color:#4f46e5; opacity:.7; margin-bottom:8px; display:block; }
.bg-primary-soft { background-color: rgba(79, 70, 229, 0.1); }
.fw-black { font-weight: 900; }
.uppercase { text-transform: uppercase; }
.btn-xs { padding: 4px 8px; font-size: 0.7rem; border-radius: 6px; }

.custom-range::-webkit-slider-thumb { background: #4f46e5; border: 3px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.2); }
.custom-range::-moz-range-thumb { background: #4f46e5; border: 3px solid #fff; }

#preview-box { transition: all 0.2s ease-out; }

.btn-white { background: #fff; color: #4f46e5; border: 1px solid #e0e7ff; }
.btn-white:hover { background: #4f46e5; color: #fff; }
</style>

