<div class="row g-4 slope-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Input Method</label>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-outline-success active flex-grow-1" data-mode="two-points">📍 Two Points</button>
                        <button type="button" class="btn btn-outline-success flex-grow-1" data-mode="slope-point">📈 Slope & Point</button>
                    </div>
                </div>

                <div id="mode-two-points" class="mode-section row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Point 1 (x₁, y₁)</label>
                        <div class="input-group">
                            <input type="number" id="x1" class="form-control form-control-lg" value="0" step="any">
                            <input type="number" id="y1" class="form-control form-control-lg" value="0" step="any">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Point 2 (x₂, y₂)</label>
                        <div class="input-group">
                            <input type="number" id="x2" class="form-control form-control-lg" value="4" step="any">
                            <input type="number" id="y2" class="form-control form-control-lg" value="3" step="any">
                        </div>
                    </div>
                </div>

                <div id="mode-slope-point" class="mode-section row g-3 d-none">
                    <div class="col-md-12">
                        <label class="form-label-custom">Slope (m)</label>
                        <input type="number" id="slope-m" class="form-control form-control-lg" value="0.75" step="any">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Point (x₁, y₁)</label>
                        <div class="input-group">
                            <input type="number" id="px" class="form-control form-control-lg" value="0" step="any">
                            <input type="number" id="py" class="form-control form-control-lg" value="0" step="any">
                        </div>
                    </div>
                </div>

                <div class="row mt-4 g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Advanced Options</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="show-fractions">
                            <label class="form-check-label small text-secondary" for="show-fractions">Attempt to show as fractions (e.g. 3/4 instead of 0.75)</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero text-center">
                <span class="output-hero-label">Slope-Intercept Equation</span>
                <div class="output-hero-value" id="out-eqn">y = 0.75x + 0</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">Slope (m)</div>
                        <div class="fw-bold fs-5" id="out-slope">0.75</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">Y-Intercept (b)</div>
                        <div class="fw-bold fs-5" id="out-intercept">0</div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2 text-primary"></i>Solution Steps</h6>
                <div class="bg-white p-4 rounded-4 border shadow-sm">
                    <div id="math-steps" class="small text-secondary">
                        Calculating...
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-plus-circle me-2 text-info"></i>Related Lines</h6>
                <div class="row g-2">
                    <div class="col-md-12">
                        <div class="small text-muted mb-1">Parallel (through origin)</div>
                        <div class="p-2 bg-light rounded border small fw-bold" id="out-parallel">y = 0.75x</div>
                    </div>
                    <div class="col-md-12">
                        <div class="small text-muted mb-1">Perpendicular (through origin)</div>
                        <div class="p-2 bg-light rounded border small fw-bold" id="out-perp">y = -1.33x</div>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-eqn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Equation</button>
                </div>
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="download-result" style="min-width: 280px; max-width: 100%;"><i class="fas fa-download me-2"></i>Download Result</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let currentMode = 'two-points';

    function gcd(a, b) {
        return b ? gcd(b, a % b) : a;
    }

    function toFraction(dec) {
        if (Math.abs(dec % 1) < 1e-9) return dec.toString();
        const len = dec.toString().length - dec.toString().indexOf('.') - 1;
        let denominator = Math.pow(10, Math.min(len, 4));
        let numerator = Math.round(dec * denominator);
        const common = Math.abs(gcd(numerator, denominator));
        return `${numerator / common}/${denominator / common}`;
    }

    function fmt(val) {
        if ($('show-fractions').checked) return toFraction(val);
        return parseFloat(val.toFixed(4)).toString();
    }

    function calculate() {
        let m, b, x1, y1, x2, y2;
        let steps = [];

        if (currentMode === 'two-points') {
            x1 = parseFloat($('x1').value) || 0;
            y1 = parseFloat($('y1').value) || 0;
            x2 = parseFloat($('x2').value) || 0;
            y2 = parseFloat($('y2').value) || 0;

            if (x1 === x2) {
                $('out-eqn').textContent = `x = ${fmt(x1)}`;
                $('out-slope').textContent = 'Undefined';
                $('out-intercept').textContent = 'None';
                $('math-steps').innerHTML = `The line is vertical since x₁ = x₂ = ${x1}.<br>Equation: <strong>x = ${x1}</strong>`;
                return;
            }

            steps.push(`<strong>1. Calculate Slope (m):</strong>`);
            steps.push(`m = (y₂ - y₁) / (x₂ - x₁)`);
            steps.push(`m = (${y2} - ${y1}) / (${x2} - ${x1})`);
            m = (y2 - y1) / (x2 - x1);
            steps.push(`m = ${fmt(m)}`);

            steps.push(`<br><strong>2. Calculate Y-Intercept (b):</strong>`);
            steps.push(`Use point (x₁, y₁): y = mx + b  => b = y - mx`);
            steps.push(`b = ${y1} - (${fmt(m)} × ${x1})`);
            b = y1 - (m * x1);
            steps.push(`b = ${fmt(b)}`);
        } else {
            m = parseFloat($('slope-m').value) || 0;
            x1 = parseFloat($('px').value) || 0;
            y1 = parseFloat($('py').value) || 0;

            steps.push(`<strong>1. Given Slope (m):</strong> ${fmt(m)}`);
            steps.push(`<br><strong>2. Calculate Y-Intercept (b):</strong>`);
            steps.push(`b = y₁ - mx₁`);
            steps.push(`b = ${y1} - (${fmt(m)} × ${x1})`);
            b = y1 - (m * x1);
            steps.push(`b = ${fmt(b)}`);
        }

        const mStr = m === 0 ? '' : (m === 1 ? 'x' : (m === -1 ? '-x' : `${fmt(m)}x`));
        const bSign = b > 0 ? ' + ' : (b < 0 ? ' - ' : '');
        const bAbs = b === 0 ? (m === 0 ? '0' : '') : Math.abs(parseFloat(b.toFixed(4)));
        const bStr = bSign + ($('show-fractions').checked && b !== 0 ? toFraction(Math.abs(b)) : bAbs);
        
        const eqn = `y = ${mStr}${bStr}`.replace('y =  +', 'y = ').replace('y =  -', 'y = -');
        $('out-eqn').textContent = eqn;
        $('out-slope').textContent = fmt(m);
        $('out-intercept').textContent = fmt(b);

        steps.push(`<br><strong>3. Final Equation:</strong>`);
        steps.push(`y = ${fmt(m)}x ${b >= 0 ? '+' : '-'} ${fmt(Math.abs(b))}`);
        $('math-steps').innerHTML = steps.join('<br>');

        $('out-parallel').textContent = `y = ${fmt(m)}x`;
        $('out-perp').textContent = m === 0 ? 'x = 0' : `y = ${fmt(-1/m)}x`;
    }

    document.querySelectorAll('[data-mode]').forEach(btn => {
        btn.addEventListener('click', () => {
            currentMode = btn.dataset.mode;
            document.querySelectorAll('[data-mode]').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.querySelectorAll('.mode-section').forEach(s => s.classList.add('d-none'));
            $(`mode-${currentMode}`).classList.remove('d-none');
            calculate();
        });
    });

    ['x1','y1','x2','y2','slope-m','px','py','show-fractions'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    $('copy-eqn').addEventListener('click', function() {
        navigator.clipboard.writeText($('out-eqn').textContent).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.slope-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.slope-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.slope-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.slope-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.slope-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.slope-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }
.btn-outline-success { border: 1.5px solid #d1fae5; color: #059669; font-weight: 600; border-radius: 12px; padding: .6rem; transition: all 0.2s; }
.btn-outline-success:hover, .btn-outline-success.active { background: #10b981; color: #fff; border-color: #10b981; box-shadow: 0 4px 12px rgba(16,185,129,.2); }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\slope-intercept-form-calculator.blade.php ENDPATH**/ ?>