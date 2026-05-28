<div class="row g-4 orm-calculator-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Row 1: Weight & Reps --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Weight Lifted</label>
                        <div class="input-group">
                            <input type="number" id="orm-weight" class="form-control form-control-lg rounded-start-3" value="100" min="1" placeholder="Weight">
                            <select id="orm-unit" class="form-select form-select-lg rounded-end-3" style="max-width: 100px;">
                                <option value="lbs">lbs</option>
                                <option value="kg">kg</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Reps Completed</label>
                        <div class="input-group">
                            <input type="number" id="orm-reps" class="form-control form-control-lg rounded-start-3" value="5" min="1" max="30" placeholder="Reps">
                            <span class="input-group-text bg-light rounded-end-3 text-muted fw-bold">Reps</span>
                        </div>
                        <span class="small text-muted mt-1 d-block"><i class="fas fa-info-circle me-1"></i>Most accurate between 1-10 reps.</span>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 orm-quick" data-w="135" data-r="10">Bench (135x10)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 orm-quick" data-w="225" data-r="5">Squat (225x5)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 orm-quick" data-w="315" data-r="3">Deadlift (315x3)</button>
                    <button type="button" class="btn btn-sm btn-outline-primary ms-auto rounded-pill px-3 fw-bold" id="orm-calc-btn" style="min-width: 280px; max-width: 100%;">Calculate 1RM</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:262;--tool-color:#8b5cf6;--tool-bg:rgba(139,92,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">ESTIMATED ONE REP MAX (1RM)</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-orm-val">113</span>
                    <span class="output-hero-unit" id="out-orm-unit">lbs</span>
                </div>
                <div class="mt-2 text-muted fw-bold small">Formula Used: Standard Composite (Epley + Brzycki)</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-12">
                    <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1"><i class="fas fa-percentage text-primary me-2"></i>Percentage Chart </h6>
                </div>
                
                {{-- Percentage Percentiles --}}
                <div class="col-md-3 col-6">
                    <div class="stat-card" style="border-top: 4px solid #ef4444; background: #fff;">
                        <span class="stat-card-label">95% (2 Reps)</span>
                        <span class="stat-card-value text-dark" id="p-95">107</span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card" style="border-top: 4px solid #f97316; background: #fff;">
                        <span class="stat-card-label">90% (3-4 Reps)</span>
                        <span class="stat-card-value text-dark" id="p-90">102</span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card" style="border-top: 4px solid #f59e0b; background: #fff;">
                        <span class="stat-card-label">85% (5-6 Reps)</span>
                        <span class="stat-card-value text-dark" id="p-85">96</span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card" style="border-top: 4px solid #84cc16; background: #fff;">
                        <span class="stat-card-label">80% (7-8 Reps)</span>
                        <span class="stat-card-value text-dark" id="p-80">90</span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card" style="border-top: 4px solid #10b981; background: #fff;">
                        <span class="stat-card-label">75% (9-10 Reps)</span>
                        <span class="stat-card-value text-dark" id="p-75">85</span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card" style="border-top: 4px solid #06b6d4; background: #fff;">
                        <span class="stat-card-label">70% (11-12 Reps)</span>
                        <span class="stat-card-value text-dark" id="p-70">79</span>
                    </div>
                </div>
                 <div class="col-md-3 col-6">
                    <div class="stat-card" style="border-top: 4px solid #3b82f6; background: #fff;">
                        <span class="stat-card-label">65% (13-15 Reps)</span>
                        <span class="stat-card-value text-dark" id="p-65">73</span>
                    </div>
                </div>
                 <div class="col-md-3 col-6">
                    <div class="stat-card" style="border-top: 4px solid #6366f1; background: #fff;">
                        <span class="stat-card-label">60% (16-20 Reps)</span>
                        <span class="stat-card-value text-dark" id="p-60">68</span>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="orm-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy 1RM Split
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="orm-reset" style="min-width: 280px; max-width: 100%;">Reset Fields</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="orm-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Max Check
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const weightE = $('orm-weight'), repsE = $('orm-reps'), unitE = $('orm-unit');
    
    function calculate(){
        let w = parseFloat(weightE.value) || 0;
        let r = parseInt(repsE.value) || 0;
        let unit = unitE.value;
        
        if(w <= 0 || r <= 0) return;
        $('out-orm-unit').textContent = unit;

        let orm = w;
        if(r > 1) {
            // Epley
            let ormEpley = w * (1 + (r / 30));
            // Brzycki
            let ormBrzycki = w * (36 / (37 - r));
            
            // If reps are very high, Brzycki gets unreliable (>10).
            // We use an average of both for a standard composite.
            orm = r <= 10 ? (ormEpley + ormBrzycki) / 2 : ormEpley;
        }

        // Round to nearest whole weight
        orm = Math.round(orm);
        $('out-orm-val').textContent = orm;

        // Calculate Percentages
        $('p-95').textContent = Math.round(orm * 0.95);
        $('p-90').textContent = Math.round(orm * 0.90);
        $('p-85').textContent = Math.round(orm * 0.85);
        $('p-80').textContent = Math.round(orm * 0.80);
        $('p-75').textContent = Math.round(orm * 0.75);
        $('p-70').textContent = Math.round(orm * 0.70);
        $('p-65').textContent = Math.round(orm * 0.65);
        $('p-60').textContent = Math.round(orm * 0.60);
    }

    [weightE, repsE, unitE].forEach(el => el.addEventListener('input', calculate));
    $('orm-calc-btn').addEventListener('click', calculate);

    document.querySelectorAll('.orm-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            weightE.value = btn.dataset.w;
            repsE.value = btn.dataset.r;
            calculate();
        });
    });

    $('orm-reset').addEventListener('click', ()=>{
        weightE.value = 100;
        repsE.value = 5;
        calculate();
    });

    $('orm-copy-btn').addEventListener('click', function(){
        const text = `1RM Calculation\nLift: ${weightE.value}${unitE.value} x ${repsE.value} reps\nEst. 1RM: ${$('out-orm-val').textContent} ${unitE.value}\n80% Working Set: ${$('p-80').textContent}\nGenerated via ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.orm-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(139,92,246,.05)}
.orm-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.orm-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.orm-calculator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.orm-calculator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.orm-calculator-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:1px solid #f1f5f9;border-radius:12px;padding:1.25rem 1rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%; box-shadow: 0 4px 6px rgba(0,0,0,0.02);}
.stat-card:hover { transform: translateY(-3px); }
.stat-card-label{display:block;font-size:.65rem;font-weight:800;text-transform:uppercase;color:#64748b;letter-spacing:0.5px;margin-bottom:4px}
.stat-card-value{font-size:1.4rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .orm-calculator-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
