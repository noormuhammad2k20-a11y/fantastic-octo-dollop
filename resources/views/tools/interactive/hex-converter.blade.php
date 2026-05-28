<div class="row g-4 hex-conv-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Input Value</label>
                    <input type="text" id="main-input" class="form-control form-control-lg fw-bold text-center text-uppercase" value="FF">
                </div>
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Input Format</label>
                        <select id="input-type" class="form-select form-select-lg">
                            <option value="16" selected>Hexadecimal (Base 16)</option>
                            <option value="10">Decimal (Base 10)</option>
                            <option value="2">Binary (Base 2)</option>
                            <option value="8">Octal (Base 8)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04);">
            <div class="row g-3 text-center">
                <div class="col-md-12">
                    <div class="p-4 bg-white rounded-4 border shadow-sm mb-3">
                        <span class="form-label-custom text-primary">Hexadecimal</span>
                        <div class="fs-4 fw-bold text-uppercase" id="out-hex">FF</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-4 bg-white rounded-4 border shadow-sm mb-3">
                        <span class="form-label-custom text-success">Decimal</span>
                        <div class="fs-4 fw-bold" id="out-dec">255</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-4 bg-white rounded-4 border shadow-sm">
                        <span class="form-label-custom text-info">Binary</span>
                        <div class="fs-4 fw-bold font-monospace" id="out-bin">1111 1111</div>
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
        const val = $('main-input').value.trim();
        const type = parseInt($('input-type').value);

        if (!val) return;

        try {
            const dec = parseInt(val, type);
            if (isNaN(dec)) return;

            $('out-hex').textContent = dec.toString(16).toUpperCase();
            $('out-dec').textContent = dec;
            
            let bin = dec.toString(2);
            while (bin.length % 4 !== 0) bin = '0' + bin;
            $('out-bin').textContent = bin.match(/.{4}/g).join(' ');
        } catch(e) {}
    }

    ['main-input', 'input-type'].forEach(id => $(id).addEventListener('input', calculate));
    calculate();
});
</script>

<style>
.hex-conv-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.hex-conv-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.hex-conv-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.hex-conv-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.hex-conv-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.hex-conv-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>
