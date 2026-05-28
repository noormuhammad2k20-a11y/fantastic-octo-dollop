<div class="interactive-tool-grid voltage-drop-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label-custom">Wire Gauge (AWG)</label>
                    <select class="form-control-custom" id="volt-gauge">
                        <option value="1.588">14 AWG</option>
                        <option value="2.525" selected>12 AWG</option>
                        <option value="4.016">10 AWG</option>
                        <option value="6.385">8 AWG</option>
                        <option value="10.15">6 AWG</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Material</label>
                    <select class="form-control-custom" id="volt-mat">
                        <option value="1.72e-8" selected>Copper</option>
                        <option value="2.65e-8">Aluminum</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Voltage (V)</label>
                    <input type="number" class="form-control-custom" id="volt-source" value="120">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Current (Amps)</label>
                    <input type="number" class="form-control-custom" id="volt-amps" value="15">
                </div>
                <div class="col-12">
                    <label class="form-label-custom">One-way Length (ft)</label>
                    <input type="number" class="form-control-custom" id="volt-len" value="50">
                </div>
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Voltage Drop</span>
            <div class="result-main-value" id="volt-drop">2.4V</div>
            
            <div class="result-sub-stats border-top pt-4">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Voltage at Load</span>
                    <span class="stat-value text-accent" id="volt-end">117.6V</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Loss (%)</span>
                    <span class="stat-value" id="volt-perc">2.0%</span>
                </div>
            </div>

            <div id="volt-verdict" class="alert py-2 px-3 small fw-bold mb-4 alert-success">
                Safe (< 3% loss)
            </div>

            <button class="btn d-block mx-auto btn-accent py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-volt" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = ['volt-gauge', 'volt-mat', 'volt-source', 'volt-amps', 'volt-len'];
    const els = {};
    inputs.forEach(id => els[id] = document.getElementById(id));

    function calculate() {
        const areaAWG = parseFloat(els['volt-gauge'].value); // mm2
        const rho = parseFloat(els['volt-mat'].value);
        const V = parseFloat(els['volt-source'].value) || 120;
        const I = parseFloat(els['volt-amps'].value) || 0;
        const L = parseFloat(els['volt-len'].value) || 0;

        // V_drop = (Rho * 2 * L * I) / Area
        // L in meters, Area in m2
        const Lm = L * 0.3048;
        const Am2 = areaAWG * 1e-6;
        
        const drop = (rho * 2 * Lm * I) / Am2;
        const perc = (drop / V) * 100;
        const end = V - drop;

        document.getElementById('volt-drop').innerText = drop.toFixed(1) + "V";
        document.getElementById('volt-end').innerText = end.toFixed(1) + "V";
        document.getElementById('volt-perc').innerText = perc.toFixed(1) + "%";

        const verdict = document.getElementById('volt-verdict');
        verdict.classList.remove('alert-success', 'alert-warning', 'alert-danger');
        if (perc > 5) {
            verdict.innerText = "Danger! (> 5% loss)";
            verdict.classList.add('alert-danger');
        } else if (perc > 3) {
            verdict.innerText = "Caution (> 3% loss)";
            verdict.classList.add('alert-warning');
        } else {
            verdict.innerText = "Safe (< 3% loss)";
            verdict.classList.add('alert-success');
        }
    }

    inputs.forEach(id => els[id].addEventListener('input', calculate));

    document.getElementById('copy-volt').addEventListener('click', function() {
        const text = `Voltage Drop Report:\nSource: ${els['volt-source'].value}V\nDrop: ${document.getElementById('volt-drop').innerText} (${document.getElementById('volt-perc').innerText})\nEnd Voltage: ${document.getElementById('volt-end').innerText}\nCalculated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const orig = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { btn.innerHTML = orig; }, 2000);
        });
    });

    calculate();
});
</script>

