<div class="row g-3 radio-los-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-2">
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label-custom">Transmitter Height ($h_1$, m)</label>
                        <input type="number" id="los-h1" class="form-control form-control-sm" value="30.0" min="0.1" step="any">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label-custom">Receiver Height ($h_2$, m)</label>
                        <input type="number" id="los-h2" class="form-control form-control-sm" value="2.0" min="0.1" step="any">
                    </div>
                    <div class="col-md-6 col-sm-12 mt-2">
                        <label class="form-label-custom">Atmospheric Refraction ($K$-Factor)</label>
                        <select id="los-k-factor" class="form-select form-select-sm">
                            <option value="1.333" selected>Standard Refraction (K = 4/3)</option>
                            <option value="1.0">True Earth Geometry (K = 1.0)</option>
                            <option value="0.667">Sub-Refraction / Humid Air (K = 2/3)</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-12 mt-2">
                        <label class="form-label-custom">Link Frequency ($f$, GHz)</label>
                        <div class="input-group">
                            <input type="number" id="los-freq" class="form-control form-control-sm rounded-start-3" value="5.8" min="0.001" step="any">
                            <span class="input-group-text py-0 px-2 text-xxs">GHz</span>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-3 d-flex flex-wrap gap-1.5 align-items-center">
                    <span class="fw-bold text-xxs text-slate-400 text-uppercase tracking-wider me-1"><i class="fas fa-bolt text-warning me-1"></i>Link Presets:</span>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 los-quick text-xxs" data-h1="35" data-h2="2" data-k="1.333" data-f="2.4">📱 Mobile Tower (2.4 GHz)</button>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 los-quick text-xxs" data-h1="60" data-h2="60" data-k="1.333" data-f="11.0">📡 High-Freq Microwave Link</button>
                    <button type="button" class="btn btn-xs btn-outline-danger rounded-pill px-2.5 text-xxs ms-auto" id="los-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(79, 70, 229, 0.03);">
            <div class="output-hero py-3">
                <span class="output-hero-label text-xxs text-uppercase tracking-widest text-slate-500">Maximum Radio Line of Sight</span>
                <div class="output-hero-value text-xl font-bold tracking-tight my-1" id="out-los-total" style="color:#4f46e5;">—</div>
                <div class="text-xs text-slate-500" id="out-los-coverage">—</div>
            </div>

            <div class="row g-2 mt-2">
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">TX Horizon (d₁)</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-los-d1">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">RX Horizon (d₂)</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-los-d2">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Fresnel Radius (F₁)</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-los-f1">—</span>
                    </div>
                </div>
            </div>

            {{-- SVG Earth Curved Signal Profile --}}
            <div class="mt-3 p-3 bg-light rounded-3 border text-center">
                <h6 class="fw-bold mb-2 text-xs text-uppercase tracking-wider text-slate-600 text-left"><i class="fas fa-eye me-1"></i>Curved Earth Signal Profile</h6>
                <div class="d-flex align-items-center justify-content-center bg-white rounded border py-2" style="height:115px;">
                    <svg id="los-schematic" viewBox="0 0 240 90" class="w-100 h-100" style="max-width: 320px;">
                        <!-- Curved Earth Surface -->
                        <path d="M10 75 Q120 55 230 75" fill="none" stroke="#64748b" stroke-width="2"/>
                        <!-- Transmitter (TX) Tower -->
                        <line x1="40" y1="67" x2="40" y2="40" stroke="#4f46e5" stroke-width="2"/>
                        <circle cx="40" cy="40" r="2.5" fill="#4f46e5"/>
                        <text x="40" y="32" font-size="6.5" font-weight="bold" fill="#4f46e5" text-anchor="middle">TX</text>

                        <!-- Receiver (RX) Tower -->
                        <line x1="200" y1="67" x2="200" y2="52" stroke="#10b981" stroke-width="1.5"/>
                        <circle cx="200" cy="52" r="2" fill="#10b981"/>
                        <text x="200" y="45" font-size="6.5" font-weight="bold" fill="#10b981" text-anchor="middle">RX</text>

                        <!-- Direct line of sight path -->
                        <line x1="40" y1="40" x2="200" y2="52" stroke="rgba(239,68,68,0.4)" stroke-width="1" stroke-dasharray="2 2"/>

                        <!-- Fresnel Zone Ellipse envelope -->
                        <ellipse cx="120" cy="46" rx="80" ry="12" fill="rgba(79,70,229,0.06)" stroke="#818cf8" stroke-width="0.75" stroke-dasharray="3 3"/>
                        <text x="120" y="49" font-size="5.5" fill="#4f46e5" text-anchor="middle">Fresnel Zone (F₁)</text>
                    </svg>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-3 py-2 px-4 text-sm fw-bold rounded-pill shadow-sm" id="los-copy" style="min-width: 240px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy propagation Analysis</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);

    const h1El=$('los-h1');
    const h2El=$('los-h2');
    const kEl=$('los-k-factor');
    const freqEl=$('los-freq');

    function calculate(){
        const h1 = parseFloat(h1El.value) || 0;
        const h2 = parseFloat(h2El.value) || 0;
        const K = parseFloat(kEl.value) || 1.333;
        const f_ghz = parseFloat(freqEl.value) || 1.0;

        if (h1 <= 0 || h2 <= 0) return;

        // d_horizon (km) = 3.57 * sqrt(K * h (m))
        const d1 = 3.57 * Math.sqrt(K * h1);
        const d2 = 3.57 * Math.sqrt(K * h2);
        const d_total = d1 + d2;

        // Fresnel Zone radius (F1 in meters) at midpoint
        const f1_r = 17.32 * Math.sqrt(d_total / (4 * f_ghz));

        // Coverage area approximation
        const covArea = Math.PI * d1 * d1;

        $('out-los-total').textContent = d_total.toFixed(2) + ' km';
        $('out-los-coverage').textContent = `Coverage Footprint: ~${Math.round(covArea).toLocaleString()} km²`;

        $('out-los-d1').textContent = d1.toFixed(2) + ' km';
        $('out-los-d2').textContent = d2.toFixed(2) + ' km';
        $('out-los-f1').textContent = f1_r.toFixed(2) + ' m';
    }

    [h1El, h2El, kEl, freqEl].forEach(el=>{
        el.addEventListener('input', calculate);
    });

    // Quick triggers
    document.querySelectorAll('.los-quick').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            h1El.value = btn.dataset.h1;
            h2El.value = btn.dataset.h2;
            kEl.value = btn.dataset.k;
            freqEl.value = btn.dataset.f;
            calculate();
        });
    });

    $('los-reset').addEventListener('click', ()=>{
        h1El.value = 30.0;
        h2El.value = 2.0;
        kEl.value = 1.333;
        freqEl.value = 5.8;
        calculate();
    });

    $('los-copy').addEventListener('click', function(){
        const text = `Radio Line of Sight Analysis\nTransmitter Height: ${h1El.value} m\nReceiver Height: ${h2El.value} m\nK-Factor: ${kEl.options[kEl.selectedIndex].text}\nFrequency: ${freqEl.value} GHz\nMax Line of Sight: ${$('out-los-total').textContent}\nFresnel Clearance: ${$('out-los-f1').textContent}\n— ToolsHub Propagation`;
        navigator.clipboard.writeText(text).then(()=>{
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.radio-los-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1.25rem;
}
.radio-los-rebuilt .calculator-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.25rem;
}
.radio-los-rebuilt .tool-icon-circle {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.radio-los-rebuilt .form-label-custom {
    font-size: 0.75rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 0.25rem;
    display: block;
}
.radio-los-rebuilt .btn-xs {
    padding: 0.25rem 0.5rem;
    font-size: 0.7rem;
    border-radius: 9999px;
}
.radio-los-rebuilt .text-xxs {
    font-size: 0.65rem;
}
.radio-los-rebuilt .text-xxs.tracking-wider {
    letter-spacing: 0.05em;
}
.radio-los-rebuilt .stat-card {
    transition: transform 0.2s;
}
.radio-los-rebuilt .stat-card:hover {
    transform: translateY(-1px);
}
</style>
