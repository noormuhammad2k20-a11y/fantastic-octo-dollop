<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Tank Dimensions --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Tank Dimensions (Inches)</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Tank Width (front-to-back)</label>
                                <input type="number" id="tank-w" class="form-control form-control-lg rounded-3" value="12" min="1" step="0.5">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Tank Length (side-to-side)</label>
                                <input type="number" id="tank-l" class="form-control form-control-lg rounded-3" value="36" min="1" step="0.5">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Substrate Target --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Substrate Configuration</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Bed Depth (inches)</label>
                                <input type="number" id="bed-depth" class="form-control form-control-lg rounded-3" value="2.0" min="0.5" max="6.0" step="0.25">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Substrate Material</label>
                                <select id="substrate-type" class="form-select form-select-lg rounded-3">
                                    <option value="sand" selected>Aquarium Sand (Fine)</option>
                                    <option value="gravel">Aquarium Gravel (Coarse)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Presets --}}
            <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-w="12" data-l="20" data-d="1.5" data-type="sand">
                    10 Gallon Tank (20" x 12", 1.5" Sand)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-w="12" data-l="36" data-d="2" data-type="gravel">
                    30 Gallon Tank (36" x 12", 2" Gravel)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-w="18" data-l="48" data-d="2.5" data-type="sand">
                    55 Gallon Tank (48" x 18", 2.5" Sand)
                </button>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="background-color: #0284c7; border-color: #0284c7;">
                    <i class="fas fa-compress me-2"></i> Calculate Substrate
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background-color: #e0f2fe; color: #0284c7;">
                        <i class="fas fa-weight"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Material Quantity Forecast</h5>
                        <p class="text-muted small mb-0">Total volume and weight results for your order</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="background-color: #0284c7; border-color: #0284c7;">
                        <i class="fas fa-copy me-1"></i> Copy Substrate Specs
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="display-3 fw-bold mb-1" style="color: #0284c7;" id="result-weight-lbs">47.5 lbs</div>
                <p class="text-muted mb-0 fw-bold text-uppercase small letter-spacing-1" id="result-weight-kg">Approximately 21.5 kg</p>
            </div>

            <div class="row g-4">
                {{-- Volume Details --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-box me-2 text-primary"></i>Bed Volume Properties</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Volume (Cubic Inches):</span>
                                <span class="fw-bold text-dark" id="out-vol-in">864.0 cu in</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Volume (Cubic Feet):</span>
                                <span class="fw-bold text-dark" id="out-vol-ft">0.50 cu ft</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Litres / Decimeters³:</span>
                                <span class="fw-bold text-dark" id="out-vol-liters">14.2 Liters</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Shopping Checklist --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-shopping-bag me-2 text-success"></i>Bags Recommendation Checklist</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Standard 10 lb Bags:</span>
                                <span class="fw-bold text-dark" id="out-bags-10">5 Bags</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Standard 20 lb Bags:</span>
                                <span class="fw-bold text-dark" id="out-bags-20">3 Bags</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Extra Buffer Recommended:</span>
                                <span class="fw-bold text-warning">+10% added in values</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }
    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }
    .form-control-lg, .form-select-lg { border: 1.5px solid #cbd5e1; border-radius: 12px; font-size: 1rem; }
    .form-control:focus, .form-select:focus { border-color: #0284c7; box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.1); outline: none; }
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #f1f5f9 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tankWIn = document.getElementById('tank-w');
    const tankLIn = document.getElementById('tank-l');
    const depthIn = document.getElementById('bed-depth');
    const typeIn = document.getElementById('substrate-type');
    const resultCard = document.getElementById('result-card');
    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    function calculateSubstrate() {
        const w = parseFloat(tankWIn.value) || 0;
        const l = parseFloat(tankLIn.value) || 0;
        const depth = parseFloat(depthIn.value) || 0;
        const type = typeIn.value;

        if (w <= 0 || l <= 0 || depth <= 0) {
            alert("Please enter valid width, length, and depth.");
            return;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Measuring Bed Volume...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            const volInches = w * l * depth;
            const volFeet = volInches / 1728;
            const volLiters = volInches * 0.0163871; // Cubic inches to liters

            // Weight calculation: Sand is ~95 lbs/cu ft, Gravel is ~105 lbs/cu ft
            // Adding a standard 10% safety margin so they don't run short
            const density = type === 'sand' ? 95 : 105;
            const rawWeight = volFeet * density;
            const finalWeightLbs = rawWeight * 1.10; // 10% safety padding
            const finalWeightKg = finalWeightLbs / 2.20462;

            // Bag suggestions
            const bags10 = Math.ceil(finalWeightLbs / 10);
            const bags20 = Math.ceil(finalWeightLbs / 20);

            // Populate results
            document.getElementById('result-weight-lbs').innerText = finalWeightLbs.toFixed(1) + " lbs";
            document.getElementById('result-weight-kg').innerText = `Approximately ${finalWeightKg.toFixed(1)} kg (includes 10% buffer)`;

            document.getElementById('out-vol-in').innerText = volInches.toFixed(1) + " cu in";
            document.getElementById('out-vol-ft').innerText = volFeet.toFixed(3) + " cu ft";
            document.getElementById('out-vol-liters').innerText = volLiters.toFixed(1) + " Liters";

            document.getElementById('out-bags-10').innerText = bags10 + (bags10 === 1 ? " Bag" : " Bags");
            document.getElementById('out-bags-20').innerText = bags20 + (bags20 === 1 ? " Bag" : " Bags");

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-compress me-2"></i> Calculate Substrate';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculateSubstrate);

    btnReset.addEventListener('click', () => {
        tankWIn.value = 12;
        tankLIn.value = 36;
        depthIn.value = 2.0;
        typeIn.value = 'sand';
        resultCard.classList.add('d-none');
    });

    // Preset buttons
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            tankWIn.value = this.dataset.w;
            tankLIn.value = this.dataset.l;
            depthIn.value = this.dataset.d;
            typeIn.value = this.dataset.type;
            calculateSubstrate();
        });
    });

    btnCopy.addEventListener('click', function() {
        const weight = document.getElementById('result-weight-lbs').innerText;
        const kg = document.getElementById('result-weight-kg').innerText;
        const in3 = document.getElementById('out-vol-in').innerText;
        const ft3 = document.getElementById('out-vol-ft').innerText;
        const liters = document.getElementById('out-vol-liters').innerText;
        const bags10 = document.getElementById('out-bags-10').innerText;
        const bags20 = document.getElementById('out-bags-20').innerText;

        const text = `AQUARIUM SUBSTRATE CALCULATOR PLAN\n` +
                     `===================================\n` +
                     `Tank Dimensions: ${tankLIn.value}" Length x ${tankWIn.value}" Width\n` +
                     `Target Bed Depth: ${depthIn.value} inches\n` +
                     `Substrate Type: ${typeIn.options[typeIn.selectedIndex].text}\n\n` +
                     `ESTIMATED WEIGHT REQUIRED: ${weight}\n` +
                     `(${kg})\n\n` +
                     `BED VOLUME PROPERTIES:\n` +
                     `- Volume: ${in3} (${ft3} / ${liters})\n` +
                     `SHOPPING RECOMMENDATION:\n` +
                     `- Purchase ${bags10} (10 lb) bags OR ${bags20} (20 lb) bags\n\n` +
                     `Generated via ToolsHub Aquarium Substrate Calculator.`;

        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied Specs!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
