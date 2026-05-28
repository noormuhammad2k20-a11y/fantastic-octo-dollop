<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                
                <div class="col-lg-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Industrial Categories</h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <button class="btn btn-outline-primary w-100 rounded-3 py-2 fw-bold btn-sm cat-btn active" data-c="length">Length</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-primary w-100 rounded-3 py-2 fw-bold btn-sm cat-btn" data-c="weight">Mass/Weight</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-primary w-100 rounded-3 py-2 fw-bold btn-sm cat-btn" data-c="energy">Energy/Work</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-primary w-100 rounded-3 py-2 fw-bold btn-sm cat-btn" data-c="pressure">Pressure</button>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="v-sci">
                                <label class="form-check-label small fw-bold text-muted" for="v-sci">Enable Scientific Notation (1.0e+X)</label>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-6">
                    <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-primary-subtle">
                        <h6 class="fw-bold small mb-3 uppercase text-primary opacity-70">Extraction Parameters</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-5">
                                <label class="small fw-bold text-muted text-uppercase mb-1 d-block">Source</label>
                                <select id="v-from" class="form-select"></select>
                            </div>
                            <div class="col-2 d-flex align-items-end justify-content-center pb-1">
                                <button class="btn btn-primary-soft rounded-circle shadow-sm" id="v-swap" style="min-width: 280px; max-width: 100%; width: 42px; height: 42px;"><i class="fas fa-exchange-alt"></i></button>
                            </div>
                            <div class="col-5">
                                <label class="small fw-bold text-muted text-uppercase mb-1 d-block">Target</label>
                                <select id="v-to" class="form-select"></select>
                            </div>
                        </div>
                        <div>
                            <label class="small fw-bold text-muted text-uppercase mb-1 d-block">Input Value</label>
                            <input type="number" id="v-val" class="form-control fw-bold fs-4 py-2" value="1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-microchip text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Extraction Results</h5>
                        <p class="text-muted small mb-0" id="out-context">Scientific measurement data</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Result
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center py-5 mb-4 rounded-4 bg-light border">
                <span class="text-uppercase tracking-widest opacity-50 fw-bold small">CONVERTED VALUE</span>
                <div class="display-3 fw-bold my-2 text-primary" id="out-val">1.0000</div>
                <div class="badge bg-primary-soft text-primary px-4 py-2 rounded-pill fw-bold" id="out-unit">METERS</div>
            </div>

            <div class="row g-4">
                <div class="col-lg-7">
                    <h6 class="fw-bold small mb-3 uppercase opacity-50">SI Equivalence Matrix</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless align-middle mb-0">
                            <tbody id="si-table"></tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="p-4 rounded-4 bg-primary-soft border border-primary-subtle">
                        <h6 class="small fw-bold text-primary mb-2 text-uppercase">Analysis Notes</h6>
                        <p class="small text-primary-emphasis mb-0" id="out-notes">Ready for scientific extraction.</p>
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
    .btn-primary-soft { background-color: var(--primary-soft); color: var(--primary-color); border: 1px solid #c7d2fe; }
    .btn-primary-soft:hover { background-color: #e0e7ff; }

    .tool-card-stacked { border-radius: 20px; background: #fff; }

    .icon-box { 
        width: 48px; 
        height: 48px; 
        border-radius: 14px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 1.25rem;
    }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .transition-all { transition: all 0.2s ease; }
    
    .form-control, .form-select { border: 1.5px solid var(--border-color); border-radius: 12px; padding: 0.75rem 1rem; transition: all 0.3s ease; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }

    .cat-btn.active { background-color: var(--primary-color); color: white; border-color: var(--primary-color); }
    .tracking-widest { letter-spacing: 0.15em; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const fromE = document.getElementById('v-from');
    const toE = document.getElementById('v-to');
    const valE = document.getElementById('v-val');
    const sciE = document.getElementById('v-sci');
    const outVal = document.getElementById('out-val');
    const outUnit = document.getElementById('out-unit');
    const siTable = document.getElementById('si-table');
    const outNotes = document.getElementById('out-notes');

    let currentCat = 'length';
    const units = {
        length: {
            meter: 1, km: 1000, cm: 0.01, mm: 0.001, micrometer: 1e-6, nanometer: 1e-9, 
            mile: 1609.34, yard: 0.9144, foot: 0.3048, inch: 0.0254
        },
        weight: {
            kg: 1, g: 0.001, mg: 1e-6, ton: 1000, pound: 0.453592, ounce: 0.0283495, carat: 0.0002
        },
        energy: {
            joule: 1, kj: 1000, calorie: 4.184, kcal: 4184, watt_hour: 3600, btu: 1055.06, ev: 1.60218e-19
        },
        pressure: {
            pascal: 1, bar: 100000, psi: 6894.76, atmosphere: 101325, torr: 133.322
        }
    };

    function populate(){
        fromE.innerHTML = ''; toE.innerHTML = '';
        Object.keys(units[currentCat]).forEach(u => {
            fromE.add(new Option(u.toUpperCase(), u));
            toE.add(new Option(u.toUpperCase(), u));
        });
        toE.selectedIndex = 1;
        calculate();
    }

    function calculate(){
        const v = parseFloat(valE.value) || 0;
        const f = fromE.value;
        const t = toE.value;
        const sci = sciE.checked;

        const fR = units[currentCat][f];
        const tR = units[currentCat][t];
        const res = v * (fR / tR);

        outVal.textContent = sci ? res.toExponential(4) : (res % 1 === 0 ? res.toLocaleString() : res.toFixed(6));
        outUnit.textContent = toE.options[toE.selectedIndex].text;

        // Table
        let tableHtml = '';
        Object.keys(units[currentCat]).slice(0, 5).forEach(k => {
            let kRes = v * (units[currentCat][f] / units[currentCat][k]);
            let kDisp = sci ? kRes.toExponential(4) : kRes.toFixed(4);
            tableHtml += `<tr><td class="py-2 text-muted fw-bold small">${k.toUpperCase()}</td><td class="py-2 text-end fw-bold text-primary">${kDisp}</td></tr>`;
        });
        siTable.innerHTML = tableHtml;

        outNotes.textContent = `Conversion mapped from ${f.toUpperCase()} to ${t.toUpperCase()}. Scientific Unit Ratio: ${(fR/tR).toExponential(4)}`;
    }

    document.querySelectorAll('.cat-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentCat = btn.dataset.c;
            populate();
        });
    });

    [fromE, toE, valE, sciE].forEach(e => e.addEventListener('input', calculate));
    
    document.getElementById('v-swap').addEventListener('click', () => {
        const tmp = fromE.value; 
        fromE.value = toE.value; 
        toE.value = tmp; 
        calculate();
    });

    document.getElementById('copy-summary').addEventListener('click', function(){
        const txt = `${valE.value} ${fromE.value} = ${outVal.textContent} ${toE.value}\nGenerated by ToolsHub Matrix PRO`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; 
            this.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            this.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => {
                this.innerHTML = o;
                this.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });

    document.getElementById('reset-calc').addEventListener('click', () => {
        valE.value = 1; 
        sciE.checked = false; 
        calculate();
    });

    populate();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\unit-converter-pro.blade.php ENDPATH**/ ?>