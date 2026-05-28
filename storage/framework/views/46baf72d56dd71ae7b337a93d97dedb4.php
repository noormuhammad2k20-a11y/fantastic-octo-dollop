<div class="row g-4 army-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                
                <div class="mb-4">
                    <label class="form-label-custom">Official Presets</label>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-outline-tri rounded-pill flex-grow-1 army-preset" data-g="male" data-h="180" data-n="40" data-w="85">🪖 Active Male (21-27)</button>
                        <button type="button" class="btn btn-outline-tri rounded-pill flex-grow-1 army-preset" data-g="female" data-h="165" data-n="34" data-w="74" data-hi="102">🪖 Active Female (21-27)</button>
                        <button type="button" class="btn btn-outline-tri rounded-pill flex-grow-1 army-preset" data-g="male" data-h="175" data-n="38" data-w="92">🪖 Borderline Case</button>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label-custom">Gender</label>
                        <select id="army-gender" class="form-select form-select-lg rounded-3">
                            <option value="male">♂ Male</option>
                            <option value="female">♀ Female</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label-custom">Age Group</label>
                        <select id="army-age" class="form-select form-select-lg rounded-3">
                            <option value="17">17 - 20</option>
                            <option value="21" selected>21 - 27</option>
                            <option value="28">28 - 39</option>
                            <option value="40">40+</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label-custom">Height (<span class="ua-h">cm</span>)</label>
                        <input type="number" id="army-height" class="form-control form-control-lg rounded-3" value="175" step="0.1">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label-custom">Neck (<span class="ua-h">cm</span>)</label>
                        <input type="number" id="army-neck" class="form-control form-control-lg rounded-3" value="39" step="0.1">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label-custom">Waist (<span class="ua-h">cm</span>)</label>
                        <input type="number" id="army-waist" class="form-control form-control-lg rounded-3" value="88" step="0.1">
                    </div>
                    <div class="col-md-2 d-none" id="army-hip-row">
                        <label class="form-label-custom">Hips (<span class="ua-h">cm</span>)</label>
                        <input type="number" id="army-hips" class="form-control form-control-lg rounded-3" value="100" step="0.1">
                    </div>
                    <div class="col-md-12">
                         <div class="d-flex gap-2 mt-2">
                             <button type="button" class="btn btn-outline-secondary flex-grow-1 active" id="ua-metric" style="min-width: 280px; max-width: 100%;">Metric</button>
                             <button type="button" class="btn btn-outline-secondary flex-grow-1" id="ua-imperial" style="min-width: 280px; max-width: 100%;">Imperial</button>
                         </div>
                    </div>
                </div>

                <div class="mt-4 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-shield-halved text-primary me-1"></i> <strong>Regulation Protocol:</strong> Body fat must be assessed via height/circumference method before a "Fail" is issued on weight standards. SNug fit, not compressing.
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="army-theme" style="--tool-hue:110;--tool-color:#3f6212;--tool-bg:rgba(63,98,18,.05);">
            <div class="output-hero">
                <span class="output-hero-label">Army Body Fat Result</span>
                <div class="output-hero-value" id="out-army-bf">18.2%</div>
                <div class="badge rounded-pill px-4 py-2 mt-2" id="out-army-status" style="background:#ecfdf5;color:#065f46;font-weight:700">Satisfactory Compliance</div>
            </div>

            <div class="row g-3 mt-4 text-center">
                <div class="col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">Age Group Limit</span>
                        <span class="stat-card-value" id="out-army-limit">22%</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">Variance to Limit</span>
                        <span class="stat-card-value" id="out-army-delta">-3.8%</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">ABCP Standing</span>
                        <span class="stat-card-value text-primary" id="out-army-pass">PASS</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border">
                <h6 class="fw-bold mb-3 text-center text-uppercase small letter-spacing-1">Army Readiness Spectrum</h6>
                <div class="progress rounded-pill bg-light" style="height:35px; position:relative; overflow:visible;">
                    <div id="army-ptr" style="position:absolute; top:-10px; width:4px; height:55px; background:#0f172a; z-index:10; border-radius:4px; transition:left 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);"></div>
                    <div id="army-limit-line" style="position:absolute; top:-5px; width:2px; height:45px; background:#b91c1c; z-index:5" title="Max Allowance"></div>
                    <div class="progress-bar w-100 bg-light-success opacity-25" style="background:rgba(63,98,18,.1)"></div>
                </div>
                <div class="d-flex justify-content-between x-small text-muted mt-2 px-1">
                    <span>10% (Minimum)</span>
                    <span class="text-danger fw-bold">Max Allowed</span>
                    <span>35% (Maximum)</span>
                </div>
            </div>

            <div class="mt-4" id="out-army-insights"></div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="army-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Military Record</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    let units = 'metric';

    function calculate(){
        const gender = $('army-gender').value;
        const ageGrp = parseInt($('army-age').value);
        let h = parseFloat($('army-height').value)||0;
        let n = parseFloat($('army-neck').value)||0;
        let w = parseFloat($('army-waist').value)||0;
        let hi = parseFloat($('army-hips').value)||0;

        if(h<=0||n<=0||w<=0) return;

        let h_cm = units==='imperial' ? h*2.54 : h;
        let n_cm = units==='imperial' ? n*2.54 : n;
        let w_cm = units==='imperial' ? w*2.54 : w;
        let hi_cm = units==='imperial' ? hi*2.54 : hi;

        let bf;
        if(gender==='male'){
            bf = 495 / (1.0324 - 0.19077 * Math.log10(w_cm - n_cm) + 0.15456 * Math.log10(h_cm)) - 450;
        } else {
            bf = 495 / (1.29579 - 0.35004 * Math.log10(w_cm + hi_cm - n_cm) + 0.22100 * Math.log10(h_cm)) - 450;
        }

        bf = Math.max(2, Math.min(60, bf));
        $('out-army-bf').textContent = bf.toFixed(1) + '%';
        
        let limit = 0;
        if(gender==='male'){
            if(ageGrp < 21) limit = 20;
            else if(ageGrp < 28) limit = 22;
            else if(ageGrp < 40) limit = 24;
            else limit = 26;
        } else {
            if(ageGrp < 21) limit = 30;
            else if(ageGrp < 28) limit = 32;
            else if(ageGrp < 40) limit = 34;
            else limit = 36;
        }

        $('out-army-limit').textContent = limit + '%';
        const delta = bf - limit;
        $('out-army-delta').textContent = (delta >= 0 ? '+' : '') + delta.toFixed(1) + '%';

        const pass = bf <= limit;
        const statEl = $('out-army-status');
        statEl.textContent = pass ? 'Satisfactory Compliance' : 'Non-Compliant';
        statEl.style.color = pass ? '#065f46' : '#991b1b';
        statEl.style.background = pass ? '#ecfdf5' : '#fee2e2';
        
        $('out-army-pass').textContent = pass ? 'PASS' : 'FAIL';
        $('out-army-pass').style.color = pass ? '#059669' : '#dc2626';

        // Pointer
        let ptrPos = ((bf - 10) / (35 - 10)) * 100;
        $('army-ptr').style.left = Math.max(0, Math.min(100, ptrPos)) + '%';
        
        let limitPos = ((limit - 10) / (35 - 10)) * 100;
        $('army-limit-line').style.left = limitPos + '%';

        $('out-army-insights').innerHTML = `<h6 class="fw-bold mb-3"><i class="fas fa-list-check me-2 text-warning"></i>Readiness Analysis</h6>
            <ul class="list-unstyled mb-0 small text-secondary">
                <li class="mb-2"><i class="fas fa-check-circle ${pass?'text-success':'text-danger'} me-2"></i>Status: <strong>${pass?'PASSING':'FAILING'}</strong>. You are currently <strong>${Math.abs(delta).toFixed(1)}%</strong> ${delta<=0?'under':'over'} the age group limit.</li>
                <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i>Regulation: OPNAVINST 6110.1J criteria for ${gender} aged ${ageGrp}+ is <strong>${limit}%</strong>.</li>
                <li><i class="fas fa-check-circle text-success me-2"></i>Calibration: Measurements should be taken three times and averaged for maximum official fidelity.</li>
            </ul>`;
    }

    $('army-gender').onchange = function(){
        if(this.value==='female') $('army-hip-row').classList.remove('d-none');
        else $('army-hip-row').classList.add('d-none');
        calculate();
    }

    $('ua-metric').onclick = function(){
        if(units==='metric')return; units='metric';
        this.classList.add('active'); $('ua-imperial').classList.remove('active');
        ['army-height','army-neck','army-waist','army-hips'].forEach(id=>{
            if($(id).value) $(id).value = ($(id).value * 2.54).toFixed(1);
        });
        document.querySelectorAll('.ua-h').forEach(e=>e.textContent='cm');
        calculate();
    }
    $('ua-imperial').onclick = function(){
        if(units==='imperial')return; units='imperial';
        this.classList.add('active'); $('ua-metric').classList.remove('active');
        ['army-height','army-neck','army-waist','army-hips'].forEach(id=>{
            if($(id).value) $(id).value = ($(id).value / 2.54).toFixed(1);
        });
        document.querySelectorAll('.ua-h').forEach(e=>e.textContent='in');
        calculate();
    }

    document.querySelectorAll('.army-preset').forEach(btn=>{
        btn.onclick = () => {
            $('army-gender').value = btn.dataset.g;
            $('army-gender').dispatchEvent(new Event('change'));
            $('army-height').value = btn.dataset.h;
            $('army-neck').value = btn.dataset.n;
            $('army-waist').value = btn.dataset.w;
            if(btn.dataset.hi) $('army-hips').value = btn.dataset.hi;
            calculate();
        }
    });

    ['army-height','army-neck','army-waist','army-hips','army-gender','army-age'].forEach(id=>$(id).addEventListener('input',calculate));
    calculate();

    $('army-copy').onclick = function(){
        const text = `Army Body Fat Report\nResult: ${$('out-army-bf').textContent}\nLimit: ${$('out-army-limit').textContent}\nStatus: ${$('out-army-pass').textContent}\n— ToolsHub Fitness`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o,2000);
        });
    }
});
</script>

<style>
.army-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 30px rgba(0,0,0,.04)}
.army-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.army-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.army-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.army-calc-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.army-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
.btn-outline-tri{border:1.5px solid #e2e8f0;color:#64748b;font-weight:600;border-radius:12px;padding:.6rem 1rem;transition:all .2s;font-size:.85rem}
.btn-outline-tri:hover{background:#f8fafc;color:#1e293b;border-color:#cbd5e1}
.btn-outline-tri.active{background:#4d7c0f;color:#fff;border-color:#4d7c0f;box-shadow:0 4px 14px rgba(77,124,15,.2)}
.output-card-themed{background:var(--tool-bg);border:2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 48px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:1rem 0}
.output-hero-label{font-size:.8rem;font-weight:800;text-transform:uppercase;letter-spacing:2px;color:#64748b}
.output-hero-value{font-size:4.5rem;font-weight:900;color:var(--tool-color);line-height:1;margin:.5rem 0;letter-spacing:-3px}
.stat-card{background:#fff;border:1px solid #e5e7eb;border-radius:16px;padding:1.25rem;text-align:center;height:100%}
.stat-card-label{display:block;font-size:.7rem;font-weight:700;text-transform:uppercase;color:#94a3b8;letter-spacing:1px;margin-bottom:.5rem}
.stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\army-body-fat-calculator.blade.php ENDPATH**/ ?>