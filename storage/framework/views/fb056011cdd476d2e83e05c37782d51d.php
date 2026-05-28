<div class="row g-4 bin-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Binary A</label>
                        <input type="text" id="bin-a" class="form-control form-control-lg fw-bold" value="10101010">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Op</label>
                        <select id="op-sel" class="form-select form-select-lg text-center fw-bold">
                            <option value="add">+</option>
                            <option value="sub">-</option>
                            <option value="and">AND</option>
                            <option value="or">OR</option>
                            <option value="xor">XOR</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Binary B</label>
                        <input type="text" id="bin-b" class="form-control form-control-lg fw-bold" value="01010101">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="form-label-custom">Bit Mode</label>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary active flex-grow-1" data-bits="8">8-Bit</button>
                        <button class="btn btn-outline-primary flex-grow-1" data-bits="16">16-Bit</button>
                        <button class="btn btn-outline-primary flex-grow-1" data-bits="32">32-Bit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:210;--tool-color:#2563eb;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Binary Result</span>
                <div class="output-hero-value" id="out-bin">11111111</div>
            </div>

            <div class="row g-3 mt-4 text-center">
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">Decimal</div>
                        <div class="fw-bold fs-5" id="out-dec">255</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">Hexadecimal</div>
                        <div class="fw-bold fs-5" id="out-hex">FF</div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-th me-2 text-primary"></i>Bit Visualization</h6>
                <div id="bit-viz" class="d-flex flex-wrap gap-1 justify-content-center bg-white p-3 rounded-3 border"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let bits = 8;

    function calculate() {
        const a = $('bin-a').value.trim();
        const b = $('bin-b').value.trim();
        const op = $('op-sel').value;

        const decA = parseInt(a, 2) || 0;
        const decB = parseInt(b, 2) || 0;
        let decRes = 0;

        switch(op) {
            case 'add': decRes = decA + decB; break;
            case 'sub': decRes = decA - decB; break;
            case 'and': decRes = decA & decB; break;
            case 'or': decRes = decA | decB; break;
            case 'xor': decRes = decA ^ decB; break;
        }

        // Apply bit mask
        const mask = (Math.pow(2, bits) - 1);
        decRes = decRes & mask;

        const binRes = decRes.toString(2).padStart(bits, '0');
        $('out-bin').textContent = binRes;
        $('out-dec').textContent = decRes;
        $('out-hex').textContent = decRes.toString(16).toUpperCase();

        // Visualization
        const viz = $('bit-viz');
        viz.innerHTML = '';
        binRes.split('').forEach(bit => {
            const s = document.createElement('span');
            s.className = `badge ${bit === '1' ? 'bg-primary' : 'bg-light text-dark border'} p-2`;
            s.style.width = '30px';
            s.textContent = bit;
            viz.appendChild(s);
        });
    }

    document.querySelectorAll('[data-bits]').forEach(btn => {
        btn.addEventListener('click', () => {
            bits = parseInt(btn.dataset.bits);
            document.querySelectorAll('[data-bits]').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            calculate();
        });
    });

    ['bin-a','bin-b','op-sel'].forEach(id => $(id).addEventListener('input', calculate));
    
    calculate();
});
</script>

<style>
.bin-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.bin-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.bin-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.bin-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.bin-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.bin-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\binary-calculator.blade.php ENDPATH**/ ?>