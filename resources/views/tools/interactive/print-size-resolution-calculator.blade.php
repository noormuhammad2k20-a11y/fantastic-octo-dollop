<div class="row g-4 print-res-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 10px 40px rgba(16, 185, 129, 0.08);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-green" style="background: linear-gradient(135deg, #10b981, #065f46); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-print"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#064e3b; letter-spacing: -0.5px;">Print Resolution Optimizer</h4>
                    <p class="text-muted small mb-0">Calculate precise physical print dimensions based on pixel density (PPI/DPI).</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="p-4 rounded-4 bg-light-green border-green-100 border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50 text-success">Step 1: Image Specifications</h6>
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <label class="form-label-custom">Width (Pixels)</label>
                                    <input type="number" id="v-px-w" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="3000">
                                </div>
                                <div class="col-sm-4">
                                    <label class="form-label-custom">Height (Pixels)</label>
                                    <input type="number" id="v-px-h" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="2000">
                                </div>
                                <div class="col-sm-4">
                                    <label class="form-label-custom">Target DPI / PPI</label>
                                    <div class="input-group">
                                        <input type="number" id="v-dpi" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="300">
                                        <select id="v-dpi-preset" class="form-select border-0 bg-white shadow-sm rounded-end-3 text-success fw-bold" style="max-width: 120px;">
                                            <option value="300">Pro (300)</option>
                                            <option value="150">Std (150)</option>
                                            <option value="72">Web (72)</option>
                                            <option value="custom">Custom</option>
                                        </select>
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
        <div class="output-card-themed" style="--tool-hue: 161; --tool-color: #10b981; --tool-bg: rgba(16, 185, 129, .04);">
            <div class="p-4">
                <div class="row g-4">
                    {{-- Calculated Dimensions --}}
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-white border shadow-sm mb-3">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Calculated Print Size</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="text-center p-3 bg-light rounded-3">
                                        <span class="small fw-bold opacity-50 uppercase">Inches</span>
                                        <div class="h3 fw-black text-success mb-0" id="out-inches">10.0" x 6.7"</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center p-3 bg-light rounded-3">
                                        <span class="small fw-bold opacity-50 uppercase">Centimeters</span>
                                        <div class="h3 fw-black text-success mb-0" id="out-cm">25.4 x 16.9</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 rounded-4 bg-white border shadow-sm">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Megapixel Count</h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="h4 fw-black text-dark mb-0"><span id="out-mp">6.0</span> Megapixels</div>
                                <div class="badge bg-success text-white px-3 py-2 rounded-pill fw-bold" id="out-quality">Gallery Quality</div>
                            </div>
                        </div>
                    </div>

                    {{-- Quality Meter --}}
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 bg-white border shadow-sm h-100 d-flex flex-column">
                            <h6 class="fw-bold small mb-4 uppercase opacity-50 text-center">Quality Assessment</h6>
                            <div class="quality-meter-container flex-grow-1 d-flex flex-column justify-content-center">
                                <div class="meter-track bg-light rounded-pill overflow-hidden position-relative" style="height: 30px;">
                                    <div id="meter-fill" class="h-100 bg-success transition-all" style="width: 100%;"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2 small fw-bold text-muted uppercase">
                                    <span>Draft</span>
                                    <span>Standard</span>
                                    <span>Premium</span>
                                </div>
                            </div>
                            <div class="mt-4 p-3 rounded-4 bg-green-50 border border-green-100 text-center">
                                <p class="small text-success mb-0 fw-bold" id="out-advice">Ideal for professional large-format photo prints and gallery exhibits.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="p-4 bg-white border-top rounded-bottom-5">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button class="btn btn-success rounded-pill px-4 fw-bold text-white shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-copy me-2"></i>Copy Print Specs
                        </button>
                        <button class="btn btn-outline-secondary rounded-pill px-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-undo me-2"></i>Reset
                        </button>
                    </div>
                    <div class="text-muted small fw-bold uppercase">
                        Pixels: <span id="out-total-px" class="text-success">3,000 x 2,000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const pxW = document.getElementById('v-px-w');
    const pxH = document.getElementById('v-px-h');
    const dpi = document.getElementById('v-dpi');
    const dpiPreset = document.getElementById('v-dpi-preset');
    
    const outInches = document.getElementById('out-inches');
    const outCm = document.getElementById('out-cm');
    const outMP = document.getElementById('out-mp');
    const outQuality = document.getElementById('out-quality');
    const outAdvice = document.getElementById('out-advice');
    const outTotalPx = document.getElementById('out-total-px');
    const meterFill = document.getElementById('meter-fill');

    function calculate() {
        const w = parseFloat(pxW.value) || 0;
        const h = parseFloat(pxH.value) || 0;
        const d = parseFloat(dpi.value) || 72;
        
        const inW = w / d;
        const inH = h / d;
        const cmW = inW * 2.54;
        const cmH = inH * 2.54;
        const mp = (w * h) / 1000000;

        outInches.textContent = `${inW.toFixed(1)}" x ${inH.toFixed(1)}"`;
        outCm.textContent = `${cmW.toFixed(1)} x ${cmH.toFixed(1)}`;
        outMP.textContent = mp.toFixed(1);
        outTotalPx.textContent = `${w.toLocaleString()} x ${h.toLocaleString()}`;

        // Quality Logic
        let quality = 'Draft Quality';
        let advice = 'Low resolution. Best suited for web use or small digital thumbnails.';
        let color = '#ef4444';
        let percent = 20;

        if (d >= 300) {
            quality = 'Gallery Quality';
            advice = 'Professional grade. Sharp enough for gallery prints and high-end publications.';
            color = '#10b981';
            percent = 100;
        } else if (d >= 200) {
            quality = 'High Quality';
            advice = 'Great for marketing materials, brochures, and home photo printing.';
            color = '#10b981';
            percent = 80;
        } else if (d >= 150) {
            quality = 'Standard Quality';
            advice = 'Acceptable for newsprint or large banners viewed from a distance.';
            color = '#f59e0b';
            percent = 50;
        }

        outQuality.textContent = quality;
        outQuality.style.backgroundColor = color;
        outAdvice.textContent = advice;
        outAdvice.style.color = color;
        meterFill.style.width = percent + '%';
        meterFill.style.backgroundColor = color;
    }

    [pxW, pxH, dpi].forEach(el => el.addEventListener('input', calculate));

    dpiPreset.addEventListener('change', () => {
        if (dpiPreset.value !== 'custom') {
            dpi.value = dpiPreset.value;
            calculate();
        }
    });

    document.getElementById('reset-calc').addEventListener('click', () => {
        pxW.value = 3000; pxH.value = 2000; dpi.value = 300; dpiPreset.value = '300';
        calculate();
    });

    document.getElementById('copy-summary').addEventListener('click', function() {
        const text = `Print Resolution Specs\nPixels: ${outTotalPx.textContent}\nDPI: ${dpi.value}\nSize: ${outInches.textContent} (${outCm.textContent} cm)\nQuality: ${outQuality.textContent}`;
        navigator.clipboard.writeText(text).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

    calculate();
});
</script>

<style>
.print-res-rebuilt .form-label-custom { font-size:.7rem; font-weight:900; text-transform:uppercase; letter-spacing:1px; color:#10b981; opacity:.7; margin-bottom:8px; display:block; }
.bg-light-green { background-color: #f0fdf4; }
.border-green-100 { border-color: #dcfce7 !important; }
.bg-green-soft { background-color: rgba(16, 185, 129, 0.1); }
.bg-green-50 { background-color: #f7fff8; }
.fw-black { font-weight: 900; }
.uppercase { text-transform: uppercase; }
.transition-all { transition: all 0.4s ease; }

.pulse-green { animation: green-pulse 3s infinite; }
@keyframes green-pulse {
    0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
    70% { box-shadow: 0 0 0 15px rgba(16, 185, 129, 0); }
    100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}
</style>

