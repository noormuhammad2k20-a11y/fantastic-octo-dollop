<div class="row g-4 hr-calculator-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Row 1: Age & Resting HR --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Your Age</label>
                        <div class="input-group">
                            <input type="number" id="hr-age" class="form-control form-control-lg rounded-start-3 rounded-end-3" value="30" min="10" max="100" placeholder="Years">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Resting Heart Rate</label>
                        <div class="input-group">
                            <input type="number" id="hr-resting" class="form-control form-control-lg rounded-start-3" value="65" min="30" max="150" placeholder="BPM">
                            <span class="input-group-text bg-light rounded-end-3 text-muted fw-bold">BPM</span>
                        </div>
                        <span class="small text-muted mt-1 d-block"><i class="fas fa-info-circle me-1"></i>Measure immediately after waking up.</span>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 hr-quick" data-a="25" data-r="60">🏃 Elite Athlete (25yo, 60bpm)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 hr-quick" data-a="40" data-r="70">🚶 Average Adult (40yo, 70bpm)</button>
                    <button type="button" class="btn btn-sm btn-outline-primary ms-auto rounded-pill px-3 fw-bold" id="hr-calc-btn" style="min-width: 280px; max-width: 100%;">Calculate Zones</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.04);">
            <div class="output-hero">
                <span class="output-hero-label">MAXIMUM HEART RATE (ESTIMATED)</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-hr-max">190</span>
                    <span class="output-hero-unit">BPM</span>
                </div>
                <div class="mt-2 text-muted fw-bold small">Heart Rate Reserve (HRR): <span id="out-hrr">125</span> BPM</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-12">
                    <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1"><i class="fas fa-chart-bar text-danger me-2"></i>Training Zones (Karvonen)</h6>
                </div>
                
                {{-- Zones --}}
                <div class="col-md-4">
                    <div class="stat-card" style="border-left: 5px solid #64748b; background: #fff;">
                        <span class="stat-card-label text-start">Zone 1: Recovery (50-60%)</span>
                        <span class="stat-card-value text-dark text-start mt-2" id="z1-range">127 - 140 BPM</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-left: 5px solid #3b82f6; background: #fff;">
                        <span class="stat-card-label text-start">Zone 2: Fat Burn (60-70%)</span>
                        <span class="stat-card-value text-dark text-start mt-2" id="z2-range">140 - 152 BPM</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-left: 5px solid #10b981; background: #fff;">
                        <span class="stat-card-label text-start">Zone 3: Aerobic (70-80%)</span>
                        <span class="stat-card-value text-dark text-start mt-2" id="z3-range">152 - 165 BPM</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card" style="border-left: 5px solid #f59e0b; background: #fff;">
                        <span class="stat-card-label text-start">Zone 4: Anaerobic (80-90%)</span>
                        <span class="stat-card-value text-dark text-start mt-2" id="z4-range">165 - 177 BPM</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card" style="border-left: 5px solid #ef4444; background: #fff;">
                        <span class="stat-card-label text-start">Zone 5: VO2 Max (90-100%)</span>
                        <span class="stat-card-value text-danger text-start mt-2" id="z5-range">177 - 190 BPM</span>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="hr-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy HR Zones
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="hr-reset" style="min-width: 280px; max-width: 100%;">Reset Fields</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="hr-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Assessment
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const ageE = $('hr-age'), restingE = $('hr-resting');
    
    function calculate(){
        let age = parseInt(ageE.value) || 0;
        let rhr = parseInt(restingE.value) || 0;
        
        if(age <= 0 || rhr <= 0) return;
        
        // Tanaka Formula is often preferred: 208 - (0.7 * age). Or standard 220 - age.
        // Let's use 220 - age for simplicity, but we can do Tanaka. We'll do Tanaka for "modern" feel, or 220-age. 
        // 220-age is most widely recognized.
        const maxHr = 220 - age;
        const hrr = maxHr - rhr; // Heart Rate Reserve (Karvonen)

        $('out-hr-max').textContent = maxHr;
        $('out-hrr').textContent = hrr;

        // Calculate Zones
        const z1_low = Math.round((hrr * 0.50) + rhr);
        const z1_high = Math.round((hrr * 0.60) + rhr);

        const z2_low = z1_high;
        const z2_high = Math.round((hrr * 0.70) + rhr);

        const z3_low = z2_high;
        const z3_high = Math.round((hrr * 0.80) + rhr);

        const z4_low = z3_high;
        const z4_high = Math.round((hrr * 0.90) + rhr);

        const z5_low = z4_high;
        const z5_high = Math.round((hrr * 1.00) + rhr);

        $('z1-range').textContent = `${z1_low} - ${z1_high} BPM`;
        $('z2-range').textContent = `${z2_low} - ${z2_high} BPM`;
        $('z3-range').textContent = `${z3_low} - ${z3_high} BPM`;
        $('z4-range').textContent = `${z4_low} - ${z4_high} BPM`;
        $('z5-range').textContent = `${z5_low} - ${z5_high} BPM`;
    }

    [ageE, restingE].forEach(el => el.addEventListener('input', calculate));
    $('hr-calc-btn').addEventListener('click', calculate);

    document.querySelectorAll('.hr-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            ageE.value = btn.dataset.a;
            restingE.value = btn.dataset.r;
            calculate();
        });
    });

    $('hr-reset').addEventListener('click', ()=>{
        ageE.value = 30;
        restingE.value = 65;
        calculate();
    });

    $('hr-copy-btn').addEventListener('click', function(){
        const text = `Target Heart Rate Zones\nMax HR: ${$('out-hr-max').textContent} BPM\nZone 2 (Fat Burn): ${$('z2-range').textContent}\nZone 3 (Aerobic): ${$('z3-range').textContent}\nGenerated via ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.hr-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(239,68,68,.05)}
.hr-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.hr-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.hr-calculator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.hr-calculator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.hr-calculator-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:1px solid #f1f5f9;border-radius:12px;padding:1.5rem;text-align:left;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%; box-shadow: 0 4px 6px rgba(0,0,0,0.02);}
.stat-card:hover { transform: translateX(5px); }
.stat-card-label{display:block;font-size:.75rem;font-weight:800;text-transform:uppercase;color:#64748b;letter-spacing:1px;margin-bottom:4px}
.stat-card-value{font-size:1.5rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .hr-calculator-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
