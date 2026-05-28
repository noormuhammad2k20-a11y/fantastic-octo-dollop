<div class="row g-4 water-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Body Weight</label>
                        <div class="input-group">
                            <input type="number" id="w-weight" class="form-control form-control-lg rounded-start-3" value="70">
                            <select id="w-unit" class="form-select form-select-lg rounded-end-3" style="max-width: 100px;">
                                <option value="kg">kg</option>
                                <option value="lb">lbs</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Daily Exercise</label>
                        <div class="input-group">
                            <input type="number" id="w-exercise" class="form-control form-control-lg rounded-start-3" value="30">
                            <span class="input-group-text rounded-end-3 bg-light text-muted fw-bold">mins</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Environmental Climate</label>
                        <select id="w-climate" class="form-select form-select-lg rounded-3">
                            <option value="1.0">Temperate / Indoor (Normal)</option>
                            <option value="1.15">Hot / Humid (Active Sweat)</option>
                            <option value="1.1">Dry / Arid (Dehydration Risk)</option>
                            <option value="0.95">Cold / Alpine (Low Sweat)</option>
                        </select>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Scenarios:</span>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 w-quick" data-weight="75" data-ex="60" data-cl="1.15">🔥 Summer Workout</button>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 w-quick" data-weight="85" data-ex="0" data-cl="1.0">🏢 Sedentary Office</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 w-quick" data-weight="60" data-ex="120" data-cl="1.15">🏃 Marathon Prep</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:200;--tool-color:#0ea5e9;--tool-bg:rgba(14,165,233,.06);">
            <div class="output-hero">
                <span class="output-hero-label">RECOMMENDED DAILY HYDRATION</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-total">3.2</span>
                    <span class="output-hero-unit">Liters / day</span>
                </div>
                <div class="mt-2">
                    <span class="badge rounded-pill px-3 py-2 fw-bold bg-primary" id="out-glasses">~13 Glasses (250ml)</span>
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#0ea5e9; background: rgba(14,165,233,.02);">
                        <span class="stat-card-label">BASE METABOLIC NEED</span>
                        <span class="stat-card-value text-info" id="out-base">2.3 L</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#10b981; background: rgba(16,185,129,.02);">
                        <span class="stat-card-label">EXERCISE ADJUSTMENT</span>
                        <span class="stat-card-value text-success" id="out-ex-adj">+0.5 L</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#f59e0b; background: rgba(245,158,11,.02);">
                        <span class="stat-card-label">CLIMATE SCALING</span>
                        <span class="stat-card-value text-warning" id="out-cl-adj">1.15x</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border">
                <h6 class="fw-bold mb-3"><i class="fas fa-clock me-2 text-primary"></i>Suggested Hydration Schedule</h6>
                <div class="row g-2 text-center">
                    <div class="col-3 border-end">
                        <div class="fw-bold small">Waking</div>
                        <div class="text-primary fw-bold" id="sch-1">500ml</div>
                    </div>
                    <div class="col-3 border-end">
                        <div class="fw-bold small">Morning</div>
                        <div class="text-primary fw-bold" id="sch-2">1.0L</div>
                    </div>
                    <div class="col-3 border-end">
                        <div class="fw-bold small">Afternoon</div>
                        <div class="text-primary fw-bold" id="sch-3">1.0L</div>
                    </div>
                    <div class="col-3">
                        <div class="fw-bold small">Evening</div>
                        <div class="text-secondary fw-bold" id="sch-4">700ml</div>
                    </div>
                </div>
            </div>

            <div class="mt-4" id="out-insights"></div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="water-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Hydration Plan
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="water-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Plan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const weightE = $('w-weight'), unitE = $('w-unit'), exE = $('w-exercise'), climateE = $('w-climate');

    function calculate(){
        let w = parseFloat(weightE.value) || 0;
        const u = unitE.value;
        const ex = parseFloat(exE.value) || 0;
        const cl = parseFloat(climateE.value);
        
        if(w <= 0) return;
        
        // Convert to kg for root calc (33ml per kg)
        const wKg = (u === 'lb') ? w / 2.20462 : w;
        
        const baseL = wKg * 0.033;
        const exAdjL = (ex / 60) * 0.7; // 700ml per hour of exercise
        
        let totalL = (baseL + exAdjL) * cl;
        
        $('out-total').textContent = totalL.toFixed(1);
        $('out-glasses').textContent = `~${Math.ceil(totalL / 0.25)} Glasses (250ml)`;
        $('out-base').textContent = baseL.toFixed(1) + ' L';
        $('out-ex-adj').textContent = '+' + exAdjL.toFixed(1) + ' L';
        $('out-cl-adj').textContent = cl + 'x';

        // Schedule
        $('sch-1').textContent = Math.round((totalL * 0.15) * 1000) + 'ml';
        $('sch-2').textContent = ((totalL * 0.35)).toFixed(1) + 'L';
        $('sch-3').textContent = ((totalL * 0.35)).toFixed(1) + 'L';
        $('sch-4').textContent = Math.round((totalL * 0.15) * 1000) + 'ml';

        // Insights
        const ins = [];
        ins.push(`Your baseline metabolic hydration need is <strong>${baseL.toFixed(1)}L</strong>.`);
        if(ex > 45) ins.push('Intense exercise detected. Consider adding <strong>electrolytes</strong> to your water.');
        if(cl > 1.1) ins.push('Extreme climate stress active. Increase intake if you experience dry mouth or dark urine.');
        
        $('out-insights').innerHTML = `<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Hydration Strategy</h6><ul class="list-unstyled mb-0 small">${ins.map(i=>`<li class="mb-1 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [weightE, unitE, exE, climateE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.w-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            weightE.value = btn.dataset.weight;
            exE.value = btn.dataset.ex;
            climateE.value = btn.dataset.cl;
            calculate();
        });
    });

    $('water-copy-btn').addEventListener('click', function(){
        const text = `Personal Hydration Plan\nDaily Goal: ${$('out-total').textContent} Liters\nBase Need: ${$('out-base').textContent}\nExercise Bonus: ${$('out-ex-adj').textContent}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Plan Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.water-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.water-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.water-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b;letter-spacing:-0.5px}
.water-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b;line-height:1.5}
.water-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.water-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:20px;padding:2rem;box-shadow:0 8px 32px rgba(0,0,0,.06)}
.output-hero{text-align:center;padding:1.5rem 0;border-bottom:1px solid rgba(0,0,0,.05);margin-bottom:1.5rem}
.output-hero-label{display:block;font-size:.75rem;font-weight:800;text-transform:uppercase;letter-spacing:2px;color:#64748b;margin-bottom:0.5rem}
.output-hero-value{font-size:4.5rem;font-weight:900;color:#1e293b;line-height:1;letter-spacing:-2px}
.output-hero-unit{font-size:1.5rem;color:#64748b;font-weight:700;margin-left:5px}
.stat-card{background:#fff;border:2px solid #e5e7eb;border-radius:18px;padding:1.25rem 1rem;text-align:center;transition:all .3s ease;height:100%}
.stat-card-label{display:block;font-size:.65rem;font-weight:800;text-transform:uppercase;color:#94a3b8;letter-spacing:1px;margin-bottom:5px}
.stat-card-value{font-size:1.8rem;font-weight:900;display:block;line-height:1.2}
</style>
