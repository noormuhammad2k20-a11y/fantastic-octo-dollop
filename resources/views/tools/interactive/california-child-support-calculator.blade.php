<div class="row g-4 child-support-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0" style="border-radius: 30px; background: linear-gradient(145deg, #ffffff, #f0fdfa);">
            <div class="calculator-header px-4 pt-4">
                <div class="tool-icon-circle" style="background:rgba(45,212,191,.1);color:#2dd4bf; width: 50px; height: 50px; border-radius: 15px;">
                    <i class="fas fa-children"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#0f3733; letter-spacing: -0.5px;">California Child Support Planner</h4>
                    <p class="text-muted small mb-0">Estimate monthly guidance based on CA guideline principles for parental net income.</p>
                </div>
            </div>
            <div class="calculator-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="p-3 rounded-4 bg-white border">
                            <label class="form-label-custom mb-2">Your Monthly Net Income</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-transparent border-0 opacity-50">$</span>
                                <input type="number" id="p1-income" class="form-control border-0 bg-transparent ps-0 fw-bold" value="5500">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-4 bg-white border">
                            <label class="form-label-custom mb-2">Other Parent's Net Income</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-transparent border-0 opacity-50">$</span>
                                <input type="number" id="p2-income" class="form-control border-0 bg-transparent ps-0 fw-bold" value="4200">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Timeshare with Child (%)</label>
                        <div class="d-flex align-items-center gap-3 mt-2">
                            <input type="range" class="form-range flex-grow-1 color-teal" id="timeshare" min="0" max="100" value="50">
                            <span class="badge bg-teal-soft text-teal p-2 rounded-3" style="min-width: 50px;" id="timeshare-val">50%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Number of Children</label>
                        <div class="d-flex gap-2 mt-2">
                            <input type="radio" class="btn-check" name="kids" id="k1" value="1" checked>
                            <label class="btn btn-outline-teal rounded-pill px-4" for="k1">1</label>
                            <input type="radio" class="btn-check" name="kids" id="k2" value="2">
                            <label class="btn btn-outline-teal rounded-pill px-4" for="k2">2</label>
                            <input type="radio" class="btn-check" name="kids" id="k3" value="3">
                            <label class="btn btn-outline-teal rounded-pill px-4" for="k3">3+</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-top d-flex gap-2">
                    <button class="btn btn-light rounded-pill px-4 btn-sm fw-bold support-quick" data-p1="3000" data-p2="3000" data-t="50">Equitable Split</button>
                    <button class="btn btn-light rounded-pill px-4 btn-sm fw-bold support-quick" data-p1="8000" data-p2="2000" data-t="20">Primary Custody</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:170;--tool-color:#2dd4bf;--tool-bg:rgba(45,212,191,.04);">
            <div class="output-hero">
                <span class="output-hero-label">ESTIMATED MONTHLY GUIDELINE SUPPORT</span>
                <div class="output-hero-value" id="out-total">$0</div>
                <span class="output-hero-unit">/ month</span>
            </div>
            <div class="row align-items-center mt-4">
                <div class="col-md-7">
                    <div class="p-2">
                        <p class="mt-1 text-muted" id="out-narrative"></p>
                        <div class="stat-mini mt-3">
                            <div class="small text-muted fw-bold">ANNUAL TOTAL</div>
                            <div class="h4 fw-bold mb-0" id="out-annual" style="color:#0d9488">$0</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="m-2 p-4 rounded-5 bg-white shadow-sm border text-center">
                        <div class="small fw-bold text-muted mb-2">FAMILY INCOME RATIO</div>
                        <div class="d-flex justify-content-center align-items-center gap-3">
                            <div class="h3 fw-bold mb-0" id="out-ratio">50:50</div>
                            <div class="small text-muted">You : Other</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-2 mt-4 px-2 pb-2">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="support-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Assessment</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="support-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const p1E = $('p1-income'), p2E = $('p2-income'), tmE = $('timeshare'), tmVal = $('timeshare-val');
    function calculate(){
        let p1 = parseFloat(p1E.value) || 0, p2 = parseFloat(p2E.value) || 0, t = (parseFloat(tmE.value) || 0) / 100;
        let kCount = parseInt(document.querySelector('input[name="kids"]:checked').value);
        tmVal.textContent = Math.round(t*100) + '%';
        const total = p1 + p2; if(total <= 0) return;
        const p1Ratio = (p1 / total) * 100; $('out-ratio').textContent = Math.round(p1Ratio) + ':' + Math.round(100-p1Ratio);
        const kFactors = [0, 0.25, 0.40, 0.50]; const k = kFactors[kCount] || 0.40;
        let support = p1 >= p2 ? k * (p1 - (t * total)) : - (k * (p2 - ((1-t) * total)));
        const absSupport = Math.max(0, Math.abs(support)), direction = support > 0 ? 'You might contribute' : 'You might receive';
        $('out-total').textContent = '$' + Math.round(absSupport).toLocaleString();
        $('out-annual').textContent = '$' + Math.round(absSupport * 12).toLocaleString();
        $('out-narrative').innerHTML = `${direction} <strong>$${Math.round(absSupport).toLocaleString()}</strong> monthly for <strong>${kCount} child${kCount>1?'ren':''}</strong>.`;
    }
    [p1E, p2E, tmE].forEach(e => e.addEventListener('input', calculate));
    document.querySelectorAll('input[name="kids"]').forEach(e => e.addEventListener('change', calculate));
    document.querySelectorAll('.support-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{ p1E.value = btn.dataset.p1; p2E.value = btn.dataset.p2; tmE.value = btn.dataset.t; calculate(); });
    });
    $('support-reset').addEventListener('click', ()=>{ p1E.value = 5500; p2E.value = 4200; tmE.value = 50; document.getElementById('k1').checked = true; calculate(); });
    $('support-copy').addEventListener('click', function(){
        const txt = `CA Child Support Estimate\nMonthly: ${$('out-total').textContent}\nIncome Ratio: ${$('out-ratio').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(txt).then(()=>{ const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000); });
    });
    calculate();
});
</script>
<style>
.child-support-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.child-support-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#0f3733;opacity:.8}
.bg-teal-soft{background:rgba(45,212,191,.15)}
.text-teal{color:#0d9488}
.btn-outline-teal{border:2px solid #2dd4bf;color:#0d9488;font-weight:800}
.btn-check:checked + .btn-outline-teal{background:#2dd4bf;border-color:#2dd4bf;color:#fff}
.stat-mini{background:#fff;padding:1.5rem;border-radius:25px;border:1px solid rgba(0,0,0,.05)}
</style>

