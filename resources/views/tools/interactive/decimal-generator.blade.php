<div class="row g-4 decimal-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label class="form-label-custom">Min Value</label>
                        <input type="number" id="dec-min" class="form-control form-control-lg" value="0" step="any">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Max Value</label>
                        <input type="number" id="dec-max" class="form-control form-control-lg" value="1" step="any">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Decimal Places</label>
                        <input type="number" id="dec-places" class="form-control form-control-lg" value="4" min="1" max="15">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Quantity</label>
                        <input type="number" id="dec-count" class="form-control form-control-lg" value="10" min="1" max="10000">
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-warning fw-bold text-white fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="dec-generate" style="min-width: 280px; max-width: 100%; background:#f97316; border:none;">
                    <i class="fas fa-random me-2"></i>Generate Decimals
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="dec-output-card" style="--tool-hue:25;--tool-color:#ea580c;--tool-bg:rgba(249,115,22,.04); border-color:#fed7aa;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-list-ol me-2" style="color:#ea580c"></i>Generated Numbers</h5>
                <button class="btn btn-sm btn-outline-dark" id="copy-dec" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i>Copy List</button>
            </div>
            
            <textarea id="dec-output" class="form-control bg-white font-monospace" rows="10" readonly></textarea>
        </div>
    </div>
</div>

<style>
.decimal-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.decimal-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.decimal-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.decimal-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.decimal-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.decimal-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.4rem;}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    $('dec-generate').addEventListener('click', function() {
        let min = parseFloat($('dec-min').value) || 0;
        let max = parseFloat($('dec-max').value) || 1;
        const places = parseInt($('dec-places').value) || 4;
        const count = parseInt($('dec-count').value) || 10;

        if (min > max) {
            [min, max] = [max, min];
            $('dec-min').value = min;
            $('dec-max').value = max;
        }

        if (count > 100000) {
            alert('Please limit to 100,000 numbers.');
            return;
        }

        const nums = [];
        for (let i = 0; i < count; i++) {
            const val = min + (Math.random() * (max - min));
            nums.push(val.toFixed(places));
        }

        $('dec-output').value = nums.join('\n');
        $('dec-output-card').classList.remove('d-none');
        $('dec-output-card').scrollIntoView({ behavior: 'smooth' });
    });

    $('copy-dec').addEventListener('click', function() {
        $('dec-output').select();
        document.execCommand('copy');
        const o = this.innerHTML;
        this.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });
});
</script>

