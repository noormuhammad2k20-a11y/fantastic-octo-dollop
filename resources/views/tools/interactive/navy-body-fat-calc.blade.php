<div class="row g-4 nbf-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Profile Inputs --}}
                    <div class="col-md-3">
                        <label class="form-label-custom">Gender Profile</label>
                        <select id="nbf-gender" class="form-select form-select-lg rounded-3">
                            <option value="male">♂ Male Profile</option>
                            <option value="female">♀ Female Profile</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Height (<span class="unit-h">cm</span>)</label>
                        <input type="number" id="nbf-height" class="form-control form-control-lg rounded-3" value="175" step="0.1">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Neck Circ. (<span class="unit-h">cm</span>)</label>
                        <input type="number" id="nbf-neck" class="form-control form-control-lg rounded-3" value="39" step="0.1">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Abdomen (<span class="unit-h">cm</span>)</label>
                        <input type="number" id="nbf-waist" class="form-control form-control-lg rounded-3" value="88" step="0.1">
                    </div>

                    {{-- Hip row --}}
                    <div class="col-md-3 d-none" id="nbf-hip-row">
                        <label class="form-label-custom">Hips (<span class="unit-h">cm</span>)</label>
                        <input type="number" id="nbf-hip" class="form-control form-control-lg rounded-3" value="100" step="0.1">
                    </div>

                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary px-4 active unit-toggle" data-unit="metric">Metric (cm)</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary px-4 unit-toggle" data-unit="imperial">Imperial (in)</button>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Official Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 nbf-quick" data-g="male" data-h="180" data-n="40" data-w="90">⚓ Navy Male</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 nbf-quick" data-g="female" data-h="165" data-n="35" data-w="75" data-hi="100">⚓ Navy Female</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" id="nbf-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="nbf-theme" style="--tool-hue:220;--tool-color:#1e3a8a;--tool-bg:rgba(30,58,138,.06);">
            <div class="output-hero">
                <span class="output-hero-label">NAVY BODY FAT INDEX</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-nbf">18.2</span>
                    <span class="output-hero-unit">%</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;">Calculating Readiness...</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#1e3a8a; background: #fff;">
                        <span class="stat-card-label">OFFICIAL CATEGORY</span>
                        <span class="stat-card-value" id="out-cat">Fitness</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#1e293b; background: #fff;">
                        <span class="stat-card-label">READINESS STATUS</span>
                        <span class="stat-card-value text-success" id="out-pass">PASS</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#3b82f6; background: #fff;">
                        <span class="stat-card-label">IDEAL TARGET</span>
                        <span class="stat-card-value text-primary" id="out-target">10 - 14%</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-shield-halved text-primary me-2"></i>Regulation Compliance & Analysis
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="nbf-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Readiness Report
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="nbf-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Summary
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const genderE = $('nbf-gender'), heightE = $('nbf-height'),
          neckE = $('nbf-neck'), waistE = $('nbf-waist'), hipE = $('nbf-hip');
    
    let units = 'metric';

    function calculate(){
        const gender = genderE.value;
        let h = parseFloat(heightE.value) || 0;
        let n = parseFloat(neckE.value) || 0;
        let w = parseFloat(waistE.value) || 0;
        let hip = parseFloat(hipE.value) || 0;

        if(h <= 0 || n <= 0 || w <= 0) return;

        let h_cm = (units === 'imperial') ? h * 2.54 : h;
        let n_cm = (units === 'imperial') ? n * 2.54 : n;
        let w_cm = (units === 'imperial') ? w * 2.54 : w;
        let hip_cm = (units === 'imperial') ? hip * 2.54 : hip;

        let bf;
        if(gender === 'male'){
            bf = 495 / (1.0324 - 0.19077 * Math.log10(w_cm - n_cm) + 0.15456 * Math.log10(h_cm)) - 450;
        } else {
            bf = 495 / (1.29579 - 0.35004 * Math.log10(w_cm + hip_cm - n_cm) + 0.22100 * Math.log10(h_cm)) - 450;
        }
        bf = Math.max(2, Math.min(60, bf));

        $('out-nbf').textContent = bf.toFixed(1);
        
        let cat='', status='', color='#1e3a8a', pass='PASS', target='8 - 15%';
        if(gender === 'male'){
            if(bf < 6) { cat='Essential Fat'; status='Very Lean'; color='#1e40af'; }
            else if(bf < 18) { cat='Average/Lean'; status='Satisfactory'; color='#166534'; }
            else if(bf < 25) { cat='Acceptable'; status='Meeting Standards'; color='#854d0e'; }
            else { cat='Over Limit'; status='Needs Improvement'; color='#dc2626'; pass='FAIL'; }
            target = '10 - 16%';
        } else {
            if(bf < 14) { cat='Essential Fat'; status='Very Lean'; color='#1e40af'; }
            else if(bf < 25) { cat='Average/Lean'; status='Satisfactory'; color='#166534'; }
            else if(bf < 32) { cat='Acceptable'; status='Meeting Standards'; color='#854d0e'; }
            else { cat='Over Limit'; status='Needs Improvement'; color='#dc2626'; pass='FAIL'; }
            target = '18 - 25%';
        }

        $('out-status').textContent = status;
        $('out-status').style.color = color;
        $('out-cat').textContent = cat;
        $('out-pass').textContent = pass;
        $('out-pass').style.color = (pass === 'PASS') ? '#166534' : '#dc2626';
        $('out-target').textContent = target;

        // Insights
        const ins = [];
        ins.push(`Evaluation indicates a <strong>${cat}</strong> category for ${gender === 'male' ? 'men' : 'women'}.`);
        ins.push(`Status: <strong>${pass}</strong> according to OPNAVINST 6110.1J criteria.`);
        if(pass === 'FAIL') ins.push('Consistent cardio and metabolic conditioning are recommended to meet naval readiness standards.');
        
        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-primary me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [genderE, heightE, neckE, waistE, hipE].forEach(el => el.addEventListener('input', calculate));

    genderE.addEventListener('change', function(){
        $('nbf-hip-row').classList.toggle('d-none', this.value !== 'female');
        calculate();
    });

    document.querySelectorAll('.unit-toggle').forEach(btn => {
        btn.addEventListener('click', () => {
            if(btn.dataset.unit === units) return;
            const prev = units;
            units = btn.dataset.unit;
            
            document.querySelectorAll('.unit-toggle').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const hF = (units === 'metric') ? 2.54 : 1/2.54;
            [heightE, neckE, waistE, hipE].forEach(el => {
                if(el.value) el.value = (el.value * hF).toFixed(1);
            });
            
            document.querySelectorAll('.unit-h').forEach(e => e.textContent = (units==='metric'?'cm':'in'));
            calculate();
        });
    });

    document.querySelectorAll('.nbf-quick').forEach(btn => {
        btn.onclick = () => {
            units = 'metric';
            document.querySelectorAll('.unit-toggle').forEach(b => b.classList.toggle('active', b.dataset.unit === 'metric'));
            genderE.value = btn.dataset.g;
            genderE.dispatchEvent(new Event('change'));
            heightE.value = btn.dataset.h;
            neckE.value = btn.dataset.n;
            waistE.value = btn.dataset.w;
            if(btn.dataset.hi) hipE.value = btn.dataset.hi;
            calculate();
        };
    });

    $('nbf-reset').onclick = () => {
        heightE.value = 175; neckE.value = 39; waistE.value = 88; calculate();
    };

    $('nbf-copy-btn').onclick = function(){
        const text = `Navy Body Fat Report\nResult: ${$('out-nbf').textContent}%\nCategory: ${$('out-cat').textContent}\nStatus: ${$('out-pass').textContent}\n— ToolsHub Health`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(()=>this.innerHTML=o,2000);
        });
    };

    calculate();
});
</script>

<style>
.nbf-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(30,58,138,.05)}
.nbf-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.nbf-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.nbf-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.nbf-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.nbf-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .nbf-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
