<div class="row g-4 bin-conv-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Input Value</label>
                    <input type="text" id="main-input" class="form-control form-control-lg fw-bold text-center" value="10101010">
                </div>
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Input Format</label>
                        <select id="input-type" class="form-select form-select-lg">
                            <option value="2" selected>Binary (Base 2)</option>
                            <option value="10">Decimal (Base 10)</option>
                            <option value="16">Hexadecimal (Base 16)</option>
                            <option value="8">Octal (Base 8)</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Bit Grouping</label>
                        <select id="bit-group" class="form-select form-select-lg">
                            <option value="0">None</option>
                            <option value="4" selected>4 Bits (1010 1010)</option>
                            <option value="8">8 Bits</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:150;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="row g-3 text-center">
                <div class="col-md-12">
                    <div class="p-4 bg-white rounded-4 border shadow-sm mb-3">
                        <span class="form-label-custom text-primary">Binary (Base 2)</span>
                        <div class="fs-4 fw-bold font-monospace" id="out-bin">0000 0000</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-4 bg-white rounded-4 border shadow-sm mb-3">
                        <span class="form-label-custom text-success">Decimal (Base 10)</span>
                        <div class="fs-4 fw-bold" id="out-dec">0</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-4 bg-white rounded-4 border shadow-sm mb-3">
                        <span class="form-label-custom text-info">Hexadecimal</span>
                        <div class="fs-4 fw-bold text-uppercase" id="out-hex">0</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-4 bg-white rounded-4 border shadow-sm">
                        <span class="form-label-custom text-warning">Octal</span>
                        <div class="fs-4 fw-bold" id="out-oct">0</div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-check me-2 text-primary"></i>Conversion Breakdown</h6>
                <div class="bg-white p-4 rounded-4 border shadow-sm small text-secondary" id="math-steps">
                    Steps...
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function formatBits(bin, group) {
        if (group === '0') return bin;
        const regex = new RegExp(`.{1,${group}}`, 'g');
        return bin.split('').reverse().join('').match(regex).join(' ').split('').reverse().join('');
    }

    function calculate() {
        const val = $('main-input').value.trim();
        const type = parseInt($('input-type').value);
        const group = $('bit-group').value;

        if (!val) return;

        try {
            const dec = parseInt(val, type);
            if (isNaN(dec)) {
                $('out-bin').textContent = 'Invalid';
                return;
            }

            const binRaw = dec.toString(2);
            $('out-bin').textContent = formatBits(binRaw, group);
            $('out-dec').textContent = dec;
            $('out-hex').textContent = dec.toString(16).toUpperCase();
            $('out-oct').textContent = dec.toString(8);

            $('math-steps').innerHTML = `
                <strong>Input Base:</strong> ${type}<br>
                <strong>Decimal Value:</strong> ${dec}<br>
                <strong>Binary Bits:</strong> ${binRaw.length} bits
            `;
        } catch(e) {}
    }

    ['main-input', 'input-type', 'bit-group'].forEach(id => $(id).addEventListener('input', calculate));
    calculate();
});
</script>

<style>
.bin-conv-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.bin-conv-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.bin-conv-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.bin-conv-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.bin-conv-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.bin-conv-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>
