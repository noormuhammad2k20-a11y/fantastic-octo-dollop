<div class="row g-4 hex-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Hex A</label>
                        <input type="text" id="hex-a" class="form-control form-control-lg text-uppercase fw-bold" value="A1">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Op</label>
                        <select id="op-sel" class="form-select form-select-lg text-center fw-bold">
                            <option value="add">+</option>
                            <option value="sub">-</option>
                            <option value="mul">×</option>
                            <option value="div">÷</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Hex B</label>
                        <input type="text" id="hex-b" class="form-control form-control-lg text-uppercase fw-bold" value="1F">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Hex Result</span>
                <div class="output-hero-value text-uppercase" id="out-hex">C0</div>
            </div>

            <div class="row g-3 mt-4 text-center">
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">Decimal</div>
                        <div class="fw-bold fs-5" id="out-dec">192</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">Binary</div>
                        <div class="fw-bold fs-6 font-monospace" id="out-bin">1100 0000</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function calculate() {
        const a = $('hex-a').value.trim();
        const b = $('hex-b').value.trim();
        const op = $('op-sel').value;

        const decA = parseInt(a, 16) || 0;
        const decB = parseInt(b, 16) || 0;
        let decRes = 0;

        switch(op) {
            case 'add': decRes = decA + decB; break;
            case 'sub': decRes = decA - decB; break;
            case 'mul': decRes = decA * decB; break;
            case 'div': decRes = decB !== 0 ? Math.floor(decA / decB) : 0; break;
        }

        $('out-hex').textContent = decRes.toString(16).toUpperCase();
        $('out-dec').textContent = decRes;
        
        let bin = decRes.toString(2);
        while (bin.length % 4 !== 0) bin = '0' + bin;
        $('out-bin').textContent = bin.match(/.{4}/g).join(' ');
    }

    ['hex-a','hex-b','op-sel'].forEach(id => $(id).addEventListener('input', calculate));
    calculate();
});
</script>

<style>
.hex-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.hex-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.hex-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.hex-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.hex-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.hex-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>
