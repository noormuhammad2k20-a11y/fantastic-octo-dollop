<div class="row g-3 ohm-law-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                
                <div class="mb-3">
                    <label class="form-label-custom">Circuit Mode</label>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-custom active flex-grow-1 py-1.5 text-sm" id="ohm-mode-dc" data-mode="dc"><i class="fas fa-battery-full me-1"></i>Direct Current (DC)</button>
                        <button type="button" class="btn btn-outline-custom flex-grow-1 py-1.5 text-sm" id="ohm-mode-ac" data-mode="ac"><i class="fas fa-wave-square me-1"></i>Alternating Current (AC)</button>
                    </div>
                </div>

                
                <div id="ohm-dc-form" class="row g-2">
                    <div class="col-12 mb-1">
                        <div class="p-2 bg-light rounded text-slate-600 text-xxs border"><i class="fas fa-info-circle text-primary me-1"></i>Enter any <strong>two</strong> values to calculate the others.</div>
                    </div>
                    <div class="col-6">
                        <label class="form-label-custom">Voltage ($V$, Volts)</label>
                        <input type="number" id="dc-voltage" class="form-control form-control-sm" placeholder="Leave blank if unknown">
                    </div>
                    <div class="col-6">
                        <label class="form-label-custom">Current ($I$, Amps)</label>
                        <input type="number" id="dc-current" class="form-control form-control-sm" placeholder="Leave blank if unknown">
                    </div>
                    <div class="col-6">
                        <label class="form-label-custom">Resistance ($R$, Ohms)</label>
                        <input type="number" id="dc-resistance" class="form-control form-control-sm" placeholder="Leave blank if unknown">
                    </div>
                    <div class="col-6">
                        <label class="form-label-custom">Power ($P$, Watts)</label>
                        <input type="number" id="dc-power" class="form-control form-control-sm" placeholder="Leave blank if unknown">
                    </div>
                </div>

                
                <div id="ohm-ac-form" class="row g-2 d-none">
                    <div class="col-12 mb-1">
                        <div class="p-2 bg-light rounded text-slate-600 text-xxs border"><i class="fas fa-info-circle text-primary me-1"></i>Calculate total RLC series impedance, power factor, and AC current.</div>
                    </div>
                    <div class="col-6 col-md-4">
                        <label class="form-label-custom">AC Voltage ($V_{rms}$)</label>
                        <input type="number" id="ac-voltage" class="form-control form-control-sm" value="120" min="0.1">
                    </div>
                    <div class="col-6 col-md-4">
                        <label class="form-label-custom">Frequency ($f$, Hz)</label>
                        <input type="number" id="ac-frequency" class="form-control form-control-sm" value="60" min="0.1">
                    </div>
                    <div class="col-6 col-md-4">
                        <label class="form-label-custom">Resistance ($R$, $\Omega$)</label>
                        <input type="number" id="ac-resistance" class="form-control form-control-sm" value="50" min="0.1">
                    </div>
                    <div class="col-6">
                        <label class="form-label-custom">Inductance ($L$, mH)</label>
                        <input type="number" id="ac-inductance" class="form-control form-control-sm" value="100" min="0">
                    </div>
                    <div class="col-6">
                        <label class="form-label-custom">Capacitance ($C$, µF)</label>
                        <input type="number" id="ac-capacitance" class="form-control form-control-sm" value="47" min="0">
                    </div>
                </div>

                
                <div class="mt-3 d-flex flex-wrap gap-1.5 align-items-center">
                    <span class="fw-bold text-xxs text-slate-400 text-uppercase tracking-wider me-1"><i class="fas fa-bolt text-warning me-1"></i>Quick Settings:</span>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 ohm-quick text-xxs" data-type="dc-12v">🚗 12V Car Battery</button>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 ohm-quick text-xxs" data-type="dc-bulb">💡 60W Lamp</button>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 ohm-quick text-xxs" data-type="ac-grid">🔌 AC Grid (120V/60Hz)</button>
                    <button type="button" class="btn btn-xs btn-outline-danger rounded-pill px-2.5 text-xxs ms-auto" id="ohm-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:35;--tool-color:#d97706;--tool-bg:rgba(217, 119, 6, 0.03);">
            <div class="output-hero py-3">
                <span class="output-hero-label text-xxs text-uppercase tracking-widest text-slate-500" id="out-ohm-hero-lbl">Total Impedance / Resistance</span>
                <div class="output-hero-value text-xl font-bold tracking-tight my-1" id="out-ohm-hero-val" style="color:#d97706;">—</div>
                <div class="text-xs text-slate-500" id="out-ohm-hero-sub">—</div>
            </div>

            <div class="row g-2 mt-2">
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5" id="out-ohm-stat1-lbl">Current ($I$)</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-ohm-stat1-val">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5" id="out-ohm-stat2-lbl">Active Power</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-ohm-stat2-val">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5" id="out-ohm-stat3-lbl">Power Factor</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-ohm-stat3-val">—</span>
                    </div>
                </div>
            </div>

            
            <div class="mt-3 p-3 bg-light rounded-3 border text-center">
                <h6 class="fw-bold mb-2 text-xs text-uppercase tracking-wider text-slate-600 text-left"><i class="fas fa-project-diagram me-1"></i>Circuit Schematic</h6>
                <div class="d-flex align-items-center justify-content-center bg-white rounded border py-2" style="height:100px;">
                    <svg id="ohm-schematic" viewBox="0 0 200 80" class="w-100 h-100" style="max-width: 320px;">
                        <!-- Generator / Source -->
                        <circle cx="20" cy="40" r="10" fill="none" stroke="#64748b" stroke-width="1.5"/>
                        <path id="ohm-source-icon" d="M15,40 Q20,32 20,40 T25,40" fill="none" stroke="#64748b" stroke-width="1.5"/>
                        <!-- Lines -->
                        <line x1="20" y1="30" x2="20" y2="15" stroke="#64748b" stroke-width="1.5"/>
                        <line x1="20" y1="15" x2="60" y2="15" stroke="#64748b" stroke-width="1.5"/>
                        <line x1="20" y1="50" x2="20" y2="65" stroke="#64748b" stroke-width="1.5"/>
                        <line x1="20" y1="65" x2="180" y2="65" stroke="#64748b" stroke-width="1.5"/>
                        <!-- Resistor -->
                        <path d="M60,15 L64,10 L68,20 L72,10 L76,20 L80,10 L84,20 L88,15" fill="none" stroke="#ea580c" stroke-width="1.5"/>
                        <!-- Inductor (AC only) -->
                        <path id="ohm-inductor" d="M95,15 Q98,8 101,15 Q104,8 107,15 Q110,8 113,15" fill="none" stroke="#059669" stroke-width="1.5"/>
                        <!-- Capacitor (AC only) -->
                        <g id="ohm-capacitor">
                            <line x1="130" y1="5" x2="130" y2="25" stroke="#06b6d4" stroke-width="2"/>
                            <line x1="135" y1="5" x2="135" y2="25" stroke="#06b6d4" stroke-width="2"/>
                            <line x1="120" y1="15" x2="130" y2="15" stroke="#64748b" stroke-width="1.5"/>
                            <line x1="135" y1="15" x2="145" y2="15" stroke="#64748b" stroke-width="1.5"/>
                        </g>
                        <!-- End connection -->
                        <line x1="88" y1="15" x2="95" y2="15" stroke="#64748b" stroke-width="1.5"/>
                        <line x1="113" y1="15" x2="120" y2="15" stroke="#64748b" stroke-width="1.5"/>
                        <line x1="145" y1="15" x2="180" y2="15" stroke="#64748b" stroke-width="1.5"/>
                        <line x1="180" y1="15" x2="180" y2="65" stroke="#64748b" stroke-width="1.5"/>
                        <!-- Labels -->
                        <text x="20" y="55" font-size="7" font-weight="bold" fill="#64748b" text-anchor="middle" id="schem-v-lbl">V</text>
                        <text x="74" y="28" font-size="7" font-weight="bold" fill="#ea580c" text-anchor="middle">R</text>
                        <text x="104" y="26" font-size="7" font-weight="bold" fill="#059669" text-anchor="middle" id="schem-l-lbl">L</text>
                        <text x="133" y="32" font-size="7" font-weight="bold" fill="#06b6d4" text-anchor="middle" id="schem-c-lbl">C</text>
                    </svg>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-3 py-2 px-4 text-sm fw-bold rounded-pill shadow-sm" id="ohm-copy" style="min-width: 240px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Circuit Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    let mode = 'dc';

    // DC Inputs
    const dcVolts=$('dc-voltage'), dcCurrent=$('dc-current'), dcResist=$('dc-resistance'), dcPower=$('dc-power');
    // AC Inputs
    const acVolts=$('ac-voltage'), acFreq=$('ac-frequency'), acResist=$('ac-resistance'), acInduct=$('ac-inductance'), acCapac=$('ac-capacitance');

    function calculate(){
        if (mode === 'dc') {
            calculateDC();
        } else {
            calculateAC();
        }
    }

    function calculateDC(){
        let v = parseFloat(dcVolts.value);
        let i = parseFloat(dcCurrent.value);
        let r = parseFloat(dcResist.value);
        let p = parseFloat(dcPower.value);

        let activeCount = 0;
        if (!isNaN(v)) activeCount++;
        if (!isNaN(i)) activeCount++;
        if (!isNaN(r)) activeCount++;
        if (!isNaN(p)) activeCount++;

        if (activeCount < 2) return;

        // Perform combinations
        if (!isNaN(v) && !isNaN(i)) {
            r = v / i;
            p = v * i;
        } else if (!isNaN(v) && !isNaN(r)) {
            i = v / r;
            p = (v * v) / r;
        } else if (!isNaN(v) && !isNaN(p)) {
            i = p / v;
            r = (v * v) / p;
        } else if (!isNaN(i) && !isNaN(r)) {
            v = i * r;
            p = i * i * r;
        } else if (!isNaN(i) && !isNaN(p)) {
            v = p / i;
            r = p / (i * i);
        } else if (!isNaN(r) && !isNaN(p)) {
            v = Math.sqrt(p * r);
            i = Math.sqrt(p / r);
        }

        // Display results
        $('out-ohm-hero-lbl').textContent = 'Solved Conductor Resistance ($R$)';
        $('out-ohm-hero-val').textContent = r.toFixed(2) + ' Ω';
        $('out-ohm-hero-sub').textContent = 'Direct Current circuit resolved parameters';

        $('out-ohm-stat1-lbl').textContent = 'Voltage ($V$)';
        $('out-ohm-stat1-val').textContent = v.toFixed(2) + ' V';
        $('out-ohm-stat2-lbl').textContent = 'Current ($I$)';
        $('out-ohm-stat2-val').textContent = i.toFixed(3) + ' A';
        $('out-ohm-stat3-lbl').textContent = 'Power ($P$)';
        $('out-ohm-stat3-val').textContent = p.toFixed(2) + ' W';

        // Update schematic labels
        $('schem-v-lbl').textContent = v.toFixed(1) + ' VDC';
        $('schem-l-lbl').textContent = 'Short';
        $('schem-c-lbl').textContent = 'Open';
    }

    function calculateAC(){
        const V = parseFloat(acVolts.value) || 0;
        const f = parseFloat(acFreq.value) || 0;
        const R = parseFloat(acResist.value) || 0;
        const L = parseFloat(acInduct.value) / 1000 || 0; // mH to H
        const C = parseFloat(acCapac.value) / 1000000 || 0; // µF to F

        if (V <= 0 || f <= 0 || R <= 0) return;

        // XL = 2 * pi * f * L
        const XL = L > 0 ? 2 * Math.PI * f * L : 0;
        // XC = 1 / (2 * pi * f * C)
        const XC = C > 0 ? 1 / (2 * Math.PI * f * C) : 0;

        // Impedance Z = sqrt(R^2 + (XL - XC)^2)
        const Z = Math.sqrt(R*R + (XL - XC)*(XL - XC));

        // AC Current I = V / Z
        const I = V / Z;

        // Phase angle theta = atan((XL - XC) / R)
        const theta_rad = Math.atan((XL - XC) / R);
        const theta_deg = theta_rad * (180 / Math.PI);

        // Power factor cos(theta)
        const PF = Math.cos(theta_rad);

        // Powers
        const S_apparent = V * I; // VA
        const P_active = S_apparent * PF; // Watts
        const Q_reactive = S_apparent * Math.sin(theta_rad); // VAR

        // Display results
        $('out-ohm-hero-lbl').textContent = 'Total AC Impedance ($Z$)';
        $('out-ohm-hero-val').textContent = Z.toFixed(2) + ' Ω';
        $('out-ohm-hero-sub').textContent = `Phase Angle: ${theta_deg.toFixed(2)}° (${XL >= XC ? 'Lagging/Inductive' : 'Leading/Capacitive'})`;

        $('out-ohm-stat1-lbl').textContent = 'AC Current ($I$)';
        $('out-ohm-stat1-val').textContent = I.toFixed(3) + ' A';
        $('out-ohm-stat2-lbl').textContent = 'Real Power ($P$)';
        $('out-ohm-stat2-val').textContent = P_active.toFixed(1) + ' W';
        $('out-ohm-stat3-lbl').textContent = 'Power Factor (PF)';
        $('out-ohm-stat3-val').textContent = PF.toFixed(4);

        // Update schematic labels
        $('schem-v-lbl').textContent = V + ' VAC';
        $('schem-l-lbl').textContent = (L*1000).toFixed(0) + 'mH';
        $('schem-c-lbl').textContent = (C*1000000).toFixed(0) + 'µF';
    }

    // Toggle AC/DC mode
    document.querySelectorAll('[data-mode]').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            mode = btn.dataset.mode;
            document.querySelectorAll('[data-mode]').forEach(b=>b.classList.remove('active'));
            btn.classList.add('active');

            if (mode === 'dc') {
                $('ohm-dc-form').classList.remove('d-none');
                $('ohm-ac-form').classList.add('d-none');
                // Schematic elements toggle
                $('ohm-source-icon').setAttribute('d', 'M12,40 L28,40 M20,32 L20,48'); // DC line source
                $('ohm-inductor').classList.add('d-none');
                $('ohm-capacitor').classList.add('d-none');
            } else {
                $('ohm-dc-form').classList.add('d-none');
                $('ohm-ac-form').classList.remove('d-none');
                $('ohm-source-icon').setAttribute('d', 'M15,40 Q20,32 20,40 T25,40'); // Sine wave
                $('ohm-inductor').classList.remove('d-none');
                $('ohm-capacitor').classList.remove('d-none');
            }
            calculate();
        });
    });

    // Inputs
    [dcVolts, dcCurrent, dcResist, dcPower, acVolts, acFreq, acResist, acInduct, acCapac].forEach(el=>{
        el.addEventListener('input', calculate);
    });

    // Presets
    document.querySelectorAll('.ohm-quick').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            const type = btn.dataset.type;
            if (type === 'dc-12v') {
                mode = 'dc';
                $('ohm-mode-dc').click();
                dcVolts.value = 12;
                dcResist.value = 4;
                dcCurrent.value = '';
                dcPower.value = '';
            } else if (type === 'dc-bulb') {
                mode = 'dc';
                $('ohm-mode-dc').click();
                dcVolts.value = 120;
                dcPower.value = 60;
                dcCurrent.value = '';
                dcResist.value = '';
            } else if (type === 'ac-grid') {
                mode = 'ac';
                $('ohm-mode-ac').click();
                acVolts.value = 120;
                acFreq.value = 60;
                acResist.value = 50;
                acInduct.value = 150;
                acCapac.value = 22;
            }
            calculate();
        });
    });

    $('ohm-reset').addEventListener('click', ()=>{
        [dcVolts, dcCurrent, dcResist, dcPower].forEach(el=>el.value='');
        acVolts.value = 120;
        acFreq.value = 60;
        acResist.value = 50;
        acInduct.value = 100;
        acCapac.value = 47;
        calculate();
    });

    $('ohm-copy').addEventListener('click', function(){
        const text = `Ohm's Law Advanced Report\nMode: ${mode.toUpperCase()}\nImpedance/Resistance: ${$('out-ohm-hero-val').textContent}\nCurrent: ${$('out-ohm-stat1-val').textContent}\nPower: ${$('out-ohm-stat2-val').textContent}\n— ToolsHub Circuits`;
        navigator.clipboard.writeText(text).then(()=>{
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.ohm-law-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1.25rem;
}
.ohm-law-rebuilt .calculator-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.25rem;
}
.ohm-law-rebuilt .tool-icon-circle {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.ohm-law-rebuilt .form-label-custom {
    font-size: 0.75rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 0.25rem;
    display: block;
}
.ohm-law-rebuilt .btn-outline-custom {
    border: 1px solid #e2e8f0;
    color: #64748b;
    font-weight: 600;
    border-radius: 8px;
    transition: all .2s;
    background: #f8fafc;
}
.ohm-law-rebuilt .btn-outline-custom:hover {
    background: #fffbeb;
    color: #d97706;
    border-color: #fde68a;
}
.ohm-law-rebuilt .btn-outline-custom.active {
    background: #d97706;
    color: #fff;
    border-color: #d97706;
}
.ohm-law-rebuilt .btn-xs {
    padding: 0.25rem 0.5rem;
    font-size: 0.7rem;
    border-radius: 9999px;
}
.ohm-law-rebuilt .text-xxs {
    font-size: 0.65rem;
}
.ohm-law-rebuilt .text-xxs.tracking-wider {
    letter-spacing: 0.05em;
}
.ohm-law-rebuilt .stat-card {
    transition: transform 0.2s;
}
.ohm-law-rebuilt .stat-card:hover {
    transform: translateY(-1px);
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\ohm-law-advanced.blade.php ENDPATH**/ ?>