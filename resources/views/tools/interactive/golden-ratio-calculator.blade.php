<div class="row g-4 golden-ratio-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 10px 40px rgba(217, 119, 6, 0.08);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-gold" style="background: linear-gradient(135deg, #d97706, #92400e); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-shapes"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#451a03; letter-spacing: -0.5px;">Architectural Harmony (Phi)</h4>
                    <p class="text-muted small mb-0">Apply the divine proportion to your designs using the mathematical constant φ (1.618).</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="p-4 rounded-4 bg-light-gold border-gold-100 border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50 text-warning">Input Dimension</h6>
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label-custom">Enter Value</label>
                                    <div class="input-group">
                                        <input type="number" id="v-input" class="form-control form-control-lg border-0 bg-white shadow-sm rounded-start-3 fw-black h3 mb-0" value="1000">
                                        <select id="v-mode" class="form-select border-0 bg-white shadow-sm rounded-end-3 fw-bold text-warning" style="max-width: 200px;">
                                            <option value="total">Total Length (A+B)</option>
                                            <option value="longer" selected>Longer Part (A)</option>
                                            <option value="shorter">Shorter Part (B)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-custom">Quick Presets</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button class="btn btn-sm btn-white border shadow-sm rounded-3 fw-bold preset-btn" data-val="1920">1920px</button>
                                        <button class="btn btn-sm btn-white border shadow-sm rounded-3 fw-bold preset-btn" data-val="1080">1080px</button>
                                        <button class="btn btn-sm btn-white border shadow-sm rounded-3 fw-bold preset-btn" data-val="100">100%</button>
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
        <div class="output-card-themed" style="--tool-hue: 35; --tool-color: #d97706; --tool-bg: rgba(217, 119, 6, .04);">
            <div class="p-4">
                <div class="row g-4">
                    {{-- Calculated Parts --}}
                    <div class="col-md-6">
                        <div class="vstack gap-3">
                            <div class="p-4 rounded-4 bg-white border shadow-sm">
                                <h6 class="fw-bold small mb-2 uppercase opacity-50">Total Sum (A + B)</h6>
                                <div class="h2 fw-black text-warning mb-0" id="out-total">1618.03</div>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="p-4 rounded-4 bg-white border shadow-sm">
                                        <h6 class="fw-bold small mb-2 uppercase opacity-50">Longer (A)</h6>
                                        <div class="h4 fw-black text-dark mb-0" id="out-longer">1000.00</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-4 rounded-4 bg-white border shadow-sm">
                                        <h6 class="fw-bold small mb-2 uppercase opacity-50">Shorter (B)</h6>
                                        <div class="h4 fw-black text-dark mb-0" id="out-shorter">618.03</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Visual Diagram --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-white border shadow-sm h-100 d-flex flex-column align-items-center justify-content-center">
                            <h6 class="fw-bold small mb-4 uppercase opacity-50 text-center w-100">Geometric Proportion</h6>
                            <div class="golden-rectangle-diagram" style="width: 100%; max-width: 350px; aspect-ratio: 1.618; position: relative;">
                                <div class="rect-total border-gold" style="position: absolute; inset: 0; border: 2px solid #d97706; border-radius: 8px;">
                                    <div class="rect-longer bg-gold-soft border-end-gold" style="position: absolute; left: 0; top: 0; bottom: 0; width: 61.8%; background: rgba(217,119,6,0.1); border-right: 2px dashed #d97706; display: flex; align-items: center; justify-content: center;">
                                        <span class="fw-bold text-warning">A</span>
                                    </div>
                                    <div class="rect-shorter" style="position: absolute; right: 0; top: 0; bottom: 0; width: 38.2%; display: flex; align-items: center; justify-content: center;">
                                        <span class="fw-bold text-muted">B</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <div class="badge bg-gold-soft text-warning px-3 py-2 rounded-pill fw-bold">Mathematical Constant φ ≈ 1.618</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="p-4 bg-white border-top rounded-bottom-5">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button class="btn btn-warning rounded-pill px-4 fw-bold text-white shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-file-invoice-dollar me-2"></i>Copy Ratio breakdown
                        </button>
                        <button class="btn btn-outline-secondary rounded-pill px-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-undo me-2"></i>Reset
                        </button>
                    </div>
                    <div class="text-muted small fw-bold uppercase">
                        Equation: <span class="text-warning">a/b = (a+b)/a = φ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('v-input');
    const mode = document.getElementById('v-mode');
    const outTotal = document.getElementById('out-total');
    const outLonger = document.getElementById('out-longer');
    const outShorter = document.getElementById('out-shorter');
    
    const PHI = (1 + Math.sqrt(5)) / 2;

    function calculate() {
        const val = parseFloat(input.value) || 0;
        const m = mode.value;
        
        let a, b, total;

        if (m === 'total') {
            total = val;
            a = total / PHI;
            b = total - a;
        } else if (m === 'longer') {
            a = val;
            total = a * PHI;
            b = total - a;
        } else {
            b = val;
            a = b * PHI;
            total = a + b;
        }

        outTotal.textContent = total.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        outLonger.textContent = a.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        outShorter.textContent = b.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
    }

    [input, mode].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            input.value = btn.dataset.val;
            calculate();
        });
    });

    document.getElementById('reset-calc').addEventListener('click', () => {
        input.value = 1000;
        mode.value = 'longer';
        calculate();
    });

    document.getElementById('copy-summary').addEventListener('click', function() {
        const text = `Golden Ratio Breakdown\nTotal: ${outTotal.textContent}\nLonger (A): ${outLonger.textContent}\nShorter (B): ${outShorter.textContent}\nφ = 1.618`;
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
.golden-ratio-rebuilt .form-label-custom { font-size:.7rem; font-weight:900; text-transform:uppercase; letter-spacing:1px; color:#d97706; opacity:.7; margin-bottom:8px; display:block; }
.bg-light-gold { background-color: #fffaf0; }
.border-gold-100 { border-color: #fef3c7 !important; }
.bg-gold-soft { background-color: rgba(217, 119, 6, 0.1); }
.fw-black { font-weight: 900; }
.uppercase { text-transform: uppercase; }

.pulse-gold { animation: gold-pulse 3s infinite; }
@keyframes gold-pulse {
    0% { box-shadow: 0 0 0 0 rgba(217, 119, 6, 0.4); }
    70% { box-shadow: 0 0 0 15px rgba(217, 119, 6, 0); }
    100% { box-shadow: 0 0 0 0 rgba(217, 119, 6, 0); }
}

.btn-white { background: #fff; color: #d97706; border: 1px solid #fef3c7; }
.btn-white:hover { background: #d97706; color: #fff; }
</style>

