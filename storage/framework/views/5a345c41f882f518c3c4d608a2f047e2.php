<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">

                <div class="col-md-6 col-lg-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Radius (r)</label>
                    <input type="number" id="in-r" class="form-control form-control-lg rounded-3" value="0" step="any" min="0">
                </div>
                <div class="col-md-6 col-lg-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Height (h)</label>
                    <input type="number" id="in-h" class="form-control form-control-lg rounded-3" value="0" step="any" min="0">
                </div>
                <div class="col-md-6 col-lg-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Unit</label>
                    <select id="in-unit" class="form-select form-select-lg rounded-3">
<option value="mm">mm</option><option value="cm">cm</option><option value="m">m</option><option value="km">km</option><option value="in">in</option><option value="ft">ft</option><option value="yd">yd</option><option value="mi">mi</option>
                    </select>
                </div>
                <div class="col-md-6 col-lg-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Decimal Places</label>
                    <select id="in-precision" class="form-select form-select-lg rounded-3">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2" selected>2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>

            
            <div class="quick-actions-bar mt-4">
                <button type="button" class="qa-btn qa-calculate" id="btn-calculate"><i class="fas fa-calculator me-2"></i>Calculate</button>
                <button type="button" class="qa-btn qa-reset" id="btn-reset"><i class="fas fa-undo me-2"></i>Reset Fields</button>
                
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Calculation Results</h5>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 160px;">
                        <i class="fas fa-copy me-1"></i> Copy Results
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4">

                <div class="col-md-12 text-center">
                    <div class="p-4 rounded-4 bg-light border h-100 d-flex flex-column justify-content-center">
                        <p class="text-muted fw-bold text-uppercase small letter-spacing-1 mb-2">Volume (V)</p>
                        <div class="display-5 fw-bold text-dark mb-0 text-break overflow-x-auto" id="out-vol">0.00</div>
                        <div class="mt-2 text-muted fw-bold unit-display" id="out-vol-unit"></div>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --border-color: #e2e8f0;
    }
    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }
    .tool-card-stacked { border-radius: 24px; background: #fff; }
    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }
    .form-control-lg, .form-select-lg { 
        border: 1.5px solid var(--border-color); 
        border-radius: 12px; 
        font-size: 1.1rem; 
        padding: 0.75rem 1rem; 
    }
    .form-control:focus, .form-select:focus { 
        border-color: var(--primary-color); 
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); 
        outline: none; 
    }
    .letter-spacing-1 { letter-spacing: 1px; }

    /* Quick Actions */
    .quick-actions-bar {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        background: #f8fafc;
        padding: 12px;
        border-radius: 16px;
        border: 1.5px solid #e2e8f0;
    }
    .qa-btn {
        flex: 1;
        min-width: 140px;
        border: none;
        border-radius: 10px;
        padding: 10px 15px;
        font-size: 0.95rem;
        font-weight: 600;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .qa-calculate { background: #4f46e5; color: #fff; }
    .qa-calculate:hover { background: #4338ca; }
    .qa-reset { background: #e2e8f0; color: #475569; }
    .qa-reset:hover { background: #cbd5e1; }
    .qa-copy-formula { background: #ecfdf5; color: #059669; border: 1.5px solid #10b981; }
    .qa-copy-formula:hover { background: #d1fae5; }
    
    .overflow-x-auto { overflow-x: auto; }
    .text-break { word-break: break-word; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (window.MathJax) {
        MathJax.typesetPromise();
    }

    const btnCalc = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopyForm = document.getElementById('btn-copy-formula');
    const btnCopyRes = document.getElementById('btn-copy');
    const resultCard = document.getElementById('result-card');

    function calculate() {
        const prec = parseInt(document.getElementById('in-precision').value);
        const unit = document.getElementById('in-unit').value;
        const baseUnitText = unit === 'none' ? '' : unit;


      const r = parseFloat(document.getElementById('in-r').value);
      const h = parseFloat(document.getElementById('in-h').value);
      if(isNaN(r) || isNaN(h) || r < 0 || h < 0) return;
      const vol = (1/3) * Math.PI * r * r * h;
      document.getElementById('out-vol').textContent = vol.toFixed(prec);
    

        // Apply units
        const outputConfigs = [{"id":"out-vol","label":"Volume (V)","suffixUnit":"cubic units"}];
        
        outputConfigs.forEach((out, index) => {
            const el = document.getElementById(out.id + '-unit');
            if(baseUnitText === '') {
                el.textContent = '';
            } else {
                const suffix = out.suffixUnit;
                if(suffix === 'sq units') el.textContent = 'sq ' + baseUnitText;
                else if(suffix === 'cubic units') el.textContent = 'cubic ' + baseUnitText;
                else if(suffix === 'units') el.textContent = baseUnitText;
                else el.textContent = baseUnitText;
            }
        });

        resultCard.classList.remove('d-none');
        resultCard.scrollIntoView({ behavior: 'smooth' });
    }

    btnCalc.addEventListener('click', calculate);

    btnReset.addEventListener('click', () => {
        document.getElementById('in-r').value = 0;
        document.getElementById('in-h').value = 0;
        document.getElementById('in-unit').value = 'mm';
        document.getElementById('in-precision').value = 2;
        resultCard.classList.add('d-none');
    });

    btnCopyForm.addEventListener('click', function() {
        const formula = `$$V = \frac{1}{3}\pi r^2 h$$`;
        navigator.clipboard.writeText(formula).then(() => {
            const orig = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = orig, 2000);
        });
    });

    btnCopyRes.addEventListener('click', function() {
        const txt = `Volume (V): ${document.getElementById('out-vol').textContent} ${document.getElementById('out-vol-unit').textContent}`;
        navigator.clipboard.writeText(txt).then(() => {
            const orig = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            setTimeout(() => this.innerHTML = orig, 2000);
        });
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\volume-of-a-cone-calculator.blade.php ENDPATH**/ ?>