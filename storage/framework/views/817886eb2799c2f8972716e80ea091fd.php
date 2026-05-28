<div class="row g-4 aspect-ratio-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 10px 40px rgba(79, 70, 229, 0.08);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-blue" style="background: linear-gradient(135deg, #4f46e5, #3730a3); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-expand-arrows-alt"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e1b4b; letter-spacing: -0.5px;">Aspect Ratio Optimizer</h4>
                    <p class="text-muted small mb-0">Define your base ratio and scale resolutions with mathematical precision.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-12">
                        <div class="p-4 rounded-4 bg-light-blue border-blue-100 border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50 text-primary">Step 1: Define Base Ratio</h6>
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <label class="form-label-custom">Base Width (W1)</label>
                                    <div class="input-group">
                                        <input type="number" id="v-w1" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="1920">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="form-label-custom">Base Height (H1)</label>
                                    <div class="input-group">
                                        <input type="number" id="v-h1" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="1080">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="form-label-custom">Quick Presets</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button class="btn btn-sm btn-white border shadow-sm rounded-3 fw-bold preset-btn" data-w="16" data-h="9">16:9</button>
                                        <button class="btn btn-sm btn-white border shadow-sm rounded-3 fw-bold preset-btn" data-w="4" data-h="3">4:3</button>
                                        <button class="btn btn-sm btn-white border shadow-sm rounded-3 fw-bold preset-btn" data-w="1" data-h="1">1:1</button>
                                        <button class="btn btn-sm btn-white border shadow-sm rounded-3 fw-bold preset-btn" data-w="21" data-h="9">21:9</button>
                                        <button class="btn btn-sm btn-white border shadow-sm rounded-3 fw-bold preset-btn" data-w="9" data-h="16">9:16</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 243; --tool-color: #4f46e5; --tool-bg: rgba(79, 70, 229, .04);">
            <div class="p-4">
                <div class="row g-4 align-items-center">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-white border shadow-sm">
                            <h6 class="fw-bold small mb-4 uppercase opacity-50">Step 2: Scale Resolution</h6>
                            <div class="vstack gap-4">
                                <div>
                                    <label class="form-label-custom text-primary">New Width (W2)</label>
                                    <div class="input-group">
                                        <input type="number" id="v-w2" class="form-control form-control-lg border-primary border-2 rounded-3 fw-black text-primary" value="1280">
                                        <span class="input-group-text bg-primary text-white border-0 rounded-end-3">PX</span>
                                    </div>
                                </div>
                                <div class="text-center opacity-25">
                                    <i class="fas fa-link fa-2x"></i>
                                </div>
                                <div>
                                    <label class="form-label-custom text-primary">New Height (H2)</label>
                                    <div class="input-group">
                                        <input type="number" id="v-h2" class="form-control form-control-lg border-primary border-2 rounded-3 fw-black text-primary" value="720">
                                        <span class="input-group-text bg-primary text-white border-0 rounded-end-3">PX</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6 text-center">
                        <div class="preview-container p-4 rounded-4 bg-white border shadow-sm h-100 d-flex flex-column align-items-center justify-content-center">
                            <h6 class="fw-bold small mb-4 uppercase opacity-50">Visual Proportion</h6>
                            <div class="aspect-preview-box shadow-lg" id="preview-box">
                                <div class="preview-info">
                                    <span id="out-ratio">16:9</span>
                                </div>
                            </div>
                            <div class="mt-4 vstack gap-2">
                                <div class="badge bg-primary-soft text-primary px-3 py-2 rounded-pill fw-bold" id="out-label">HD Resolution (720p)</div>
                                <div class="small text-muted" id="out-multiplier">Scale Factor: 0.67x</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="p-4 bg-white border-top rounded-bottom-5">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm" id="copy-res" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-copy me-2"></i>Copy Resolution
                        </button>
                        <button class="btn btn-outline-secondary rounded-pill px-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-undo me-2"></i>Reset
                        </button>
                    </div>
                    <div class="text-muted small fw-bold uppercase">
                        Ratio: <span id="out-float" class="text-primary">1.778:1</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const w1 = document.getElementById('v-w1');
    const h1 = document.getElementById('v-h1');
    const w2 = document.getElementById('v-w2');
    const h2 = document.getElementById('v-h2');
    const preview = document.getElementById('preview-box');
    const outRatio = document.getElementById('out-ratio');
    const outLabel = document.getElementById('out-label');
    const outFloat = document.getElementById('out-float');
    const outMult = document.getElementById('out-multiplier');

    function gcd(a, b) {
        return b ? gcd(b, a % b) : a;
    }

    function update(triggerId) {
        const valW1 = parseFloat(w1.value) || 1;
        const valH1 = parseFloat(h1.value) || 1;
        const ratio = valW1 / valH1;
        
        const common = gcd(valW1, valH1);
        outRatio.textContent = (valW1/common) + ':' + (valH1/common);
        outFloat.textContent = ratio.toFixed(3) + ':1';

        if (triggerId === 'w2' || triggerId === 'w1' || triggerId === 'h1') {
            const valW2 = parseFloat(w2.value) || 0;
            h2.value = Math.round(valW2 / ratio);
        } else if (triggerId === 'h2') {
            const valH2 = parseFloat(h2.value) || 0;
            w2.value = Math.round(valH2 * ratio);
        }

        // Update Multiplier
        const scale = parseFloat(w2.value) / valW1;
        outMult.textContent = `Scale Factor: ${scale.toFixed(2)}x`;

        // Update Label
        let label = 'Custom Resolution';
        const curW = parseInt(w2.value);
        const curH = parseInt(h2.value);
        if (curW === 1920 && curH === 1080) label = 'Full HD (1080p)';
        else if (curW === 1280 && curH === 720) label = 'HD Resolution (720p)';
        else if (curW === 3840 && curH === 2160) label = '4K Ultra HD';
        else if (curW === 2560 && curH === 1440) label = 'QHD (2K)';
        else if (curW === 7680 && curH === 4320) label = '8K Ultra HD';
        outLabel.textContent = label;

        // Update Preview
        let pW = 200;
        let pH = 200 / ratio;
        if (pH > 150) {
            pH = 150;
            pW = 150 * ratio;
        }
        preview.style.width = pW + 'px';
        preview.style.height = pH + 'px';
    }

    [w1, h1, w2, h2].forEach(el => {
        el.addEventListener('input', () => update(el.id.replace('v-', '')));
    });

    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            w1.value = btn.dataset.w;
            h1.value = btn.dataset.h;
            update('w1');
        });
    });

    document.getElementById('reset-calc').addEventListener('click', () => {
        w1.value = 1920; h1.value = 1080;
        w2.value = 1280; h2.value = 720;
        update('w1');
    });

    document.getElementById('copy-res').addEventListener('click', function() {
        const text = `${w2.value} x ${h2.value} (${outRatio.textContent})`;
        navigator.clipboard.writeText(text).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

    update('w1');
});
</script>

<style>
.aspect-ratio-rebuilt .form-label-custom { font-size:.7rem; font-weight:900; text-transform:uppercase; letter-spacing:1px; color:#4f46e5; opacity:.7; margin-bottom:8px; display:block; }
.bg-light-blue { background-color: #f5f7ff; }
.border-blue-100 { border-color: #e0e7ff !important; }
.bg-primary-soft { background-color: rgba(79, 70, 229, 0.1); }
.fw-black { font-weight: 900; }
.uppercase { text-transform: uppercase; }

.aspect-preview-box {
    background: #1e1b4b;
    border: 4px solid #4f46e5;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.preview-info {
    color: #fff;
    font-weight: 900;
    font-size: 1.2rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

.aspect-preview-box::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; height: 50%;
    background: linear-gradient(to bottom, rgba(255,255,255,0.1), transparent);
}

.pulse-blue { animation: blue-pulse 3s infinite; }
@keyframes blue-pulse {
    0% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.4); }
    70% { box-shadow: 0 0 0 15px rgba(79, 70, 229, 0); }
    100% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); }
}

.btn-white { background: #fff; color: #4f46e5; border: 1px solid #e0e7ff; }
.btn-white:hover { background: #4f46e5; color: #fff; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\aspect-ratio-calculator.blade.php ENDPATH**/ ?>