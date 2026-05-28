<div class="row g-4 bin2dec-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Binary Input</label>
                        <input type="text" id="bin-in" class="form-control form-control-lg fw-bold text-center" value="101010">
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-info rounded-pill px-3" data-val="1111">1111 (15)</button>
                    <button class="btn btn-sm btn-outline-info rounded-pill px-3" data-val="10000000">10000000 (128)</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:200;--tool-color:#0284c7;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Decimal Result (Base 10)</span>
                <div class="output-hero-value" id="out-dec">42</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2 text-primary"></i>Positional Notation Steps</h6>
                <div class="bg-white p-4 rounded-4 border shadow-sm small text-secondary overflow-auto" id="math-steps">
                    Steps...
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function calculate() {
        const bin = $('bin-in').value.trim();
        if (!bin) return;

        const dec = parseInt(bin, 2);
        if (isNaN(dec)) {
            $('out-dec').textContent = 'Invalid Binary';
            return;
        }

        $('out-dec').textContent = dec;

        let steps = [];
        let bits = bin.split('').reverse();
        let terms = [];
        bits.forEach((bit, i) => {
            if (bit === '1') {
                terms.push(`(1 × 2<sup>${i}</sup>)`);
            } else {
                terms.push(`(0 × 2<sup>${i}</sup>)`);
            }
        });
        
        steps.push(`<strong>Expansion:</strong>`);
        steps.push(terms.reverse().join(' + '));
        
        let vals = bits.map((bit, i) => bit === '1' ? Math.pow(2, i) : 0).filter(v => v > 0).reverse();
        steps.push(`<br><strong>Values:</strong>`);
        steps.push(`${vals.join(' + ')} = <strong>${dec}</strong>`);

        $('math-steps').innerHTML = steps.join('<br>');
    }

    $('bin-in').addEventListener('input', calculate);
    document.querySelectorAll('[data-val]').forEach(btn => {
        btn.addEventListener('click', () => { $('bin-in').value = btn.dataset.val; calculate(); });
    });
    calculate();
});
</script>

<style>
.bin2dec-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.bin2dec-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.bin2dec-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.bin2dec-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.bin2dec-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.bin2dec-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>
