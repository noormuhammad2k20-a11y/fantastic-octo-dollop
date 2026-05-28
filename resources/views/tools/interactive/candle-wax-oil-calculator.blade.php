<div class="row g-4 candle-calculator-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Row 1: Container Quantity and Capacity --}}
                    <div class="col-md-4">
                        <label class="form-label-custom">Number of Containers</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="fas fa-jar"></i></span>
                            <input type="number" id="candle-qty" class="form-control rounded-end-3" value="4" min="1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Container Water Capacity</label>
                        <div class="input-group">
                            <input type="number" id="candle-capacity" class="form-control rounded-start-3" value="8" min="0.1" step="0.1">
                            <span class="input-group-text rounded-end-3 bg-light text-muted fw-bold cap-unit-text">oz</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Weight Unit</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-amber active flex-grow-1 py-2 fw-bold rounded-3 unit-toggle-btn" data-unit="oz">
                                Ounces (oz)
                            </button>
                            <button type="button" class="btn btn-outline-amber flex-grow-1 py-2 fw-bold rounded-3 unit-toggle-btn" data-unit="grams">
                                Grams (g)
                            </button>
                        </div>
                    </div>

                    {{-- Row 2: Scent Load Slider --}}
                    <div class="col-md-6">
                        <label class="form-label-custom d-flex justify-content-between">
                            <span>Target Fragrance Scent Load</span>
                            <span class="fw-bold text-amber" id="scent-load-display">8%</span>
                        </label>
                        <div class="pt-2">
                            <input type="range" id="scent-load" class="form-range" min="3" max="15" step="0.5" value="8">
                            <div class="d-flex justify-content-between small text-muted">
                                <span>3% (Subtle)</span>
                                <span>8% (Standard)</span>
                                <span>12% (Maximum)</span>
                                <span>15% (Extreme)</span>
                            </div>
                        </div>
                    </div>

                    {{-- Row 3: Wax Type Density --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Wax Blend & Density factor</label>
                        <select id="wax-density" class="form-select rounded-3">
                            <option value="0.86" selected>Soy Wax (0.86 Density - EcoSoya / GoldenWax)</option>
                            <option value="0.90">Paraffin Wax (0.90 Density - IGI 4627 / 4630)</option>
                            <option value="0.93">Beeswax (0.93 Density - Natural yellow/white)</option>
                            <option value="0.88">Coconut Blend Wax (0.88 Density - Joy Wax / Ceda Serica)</option>
                        </select>
                    </div>
                </div>

                {{-- Pricing panel --}}
                <div class="row g-3 mt-3 pt-3 border-top">
                    <div class="col-md-6">
                        <label class="form-label-custom">Wax Cost (per lb/kg)</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">$</span>
                            <input type="number" id="wax-price" class="form-control" value="6" step="0.5" min="0">
                            <span class="input-group-text cost-unit-label">per lb</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Fragrance Oil Cost (per oz/g)</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">$</span>
                            <input type="number" id="fragrance-price" class="form-control" value="2.5" step="0.1" min="0">
                            <span class="input-group-text cost-unit-label-small">per oz</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:38;--tool-color:#d97706;--tool-bg:rgba(217,119,6,.04);">
            <div class="output-hero">
                <span class="output-hero-label">TOTAL WAX WEIGHT REQUIRED</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value text-amber" id="out-wax-weight">25.5</span>
                    <span class="output-hero-unit" id="out-wax-unit">oz</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-candle-status">For 4 candles (8 oz capacity each)</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-6 col-md-3 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Fragrance Oil</span>
                        <span class="stat-card-value text-dark" id="out-fragrance-weight">2.0 oz</span>
                    </div>
                </div>
                <div class="col-6 col-md-3 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Total Batch Weight</span>
                        <span class="stat-card-value text-dark" id="out-total-weight">27.5 oz</span>
                    </div>
                </div>
                <div class="col-6 col-md-3 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Estimated Batch Cost</span>
                        <span class="stat-card-value text-dark" id="out-batch-cost">$14.56</span>
                    </div>
                </div>
                <div class="col-6 col-md-3 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Per Candle Cost</span>
                        <span class="stat-card-value text-dark" id="out-candle-cost">$3.64</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-microscope text-amber me-2"></i>Professional Pouring & Scent Throw Insights
                </h6>
                <div id="out-candle-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-2.5 px-4 fw-bold rounded-pill shadow-sm w-100" id="candle-copy-btn">
                        <i class="fas fa-copy me-2 text-amber"></i>Copy Batch Recipe
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="candle-reset">Reset Fields</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-2.5 px-4 fw-bold rounded-pill shadow-sm w-100" id="candle-share-btn">
                        <i class="fas fa-share-alt me-2"></i>Share Batch Formulas
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const qtyE = $('candle-qty'),
          capacityE = $('candle-capacity'),
          scentLoadE = $('scent-load'),
          scentLoadDisplayE = $('scent-load-display'),
          waxDensityE = $('wax-density'),
          waxPriceE = $('wax-price'),
          fragrancePriceE = $('fragrance-price');

    let currentUnit = 'oz';

    function calculateCandle() {
        const qty = parseInt(qtyE.value) || 0;
        const capacity = parseFloat(capacityE.value) || 0;
        const load = parseFloat(scentLoadE.value) || 8;
        const density = parseFloat(waxDensityE.value) || 0.86;
        const waxPrice = parseFloat(waxPriceE.value) || 0;
        const fragPrice = parseFloat(fragrancePriceE.value) || 0;

        scentLoadDisplayE.textContent = `${load}%`;

        if (qty <= 0 || capacity <= 0) {
            $('out-wax-weight').textContent = '0';
            $('out-fragrance-weight').textContent = '0';
            $('out-total-weight').textContent = '0';
            $('out-batch-cost').textContent = '$0.00';
            $('out-candle-cost').textContent = '$0.00';
            return;
        }

        // Calculate total target weight of candle batch mixture (wax + oil)
        // Volume capacity entered by user represents fluid volume of water.
        // Wax density converts water capacity to weight of wax blend.
        const totalMixtureWeight = capacity * density * qty;

        // Calculate Wax vs Fragrance Oil weights using professional ratio:
        // Fragrance load is computed as percentage of the wax weight, not total candle weight.
        // Total Mixture = Wax + (Wax * Load%) = Wax * (1 + Load%)
        const waxWeight = totalMixtureWeight / (1 + (load / 100));
        const fragranceWeight = waxWeight * (load / 100);
        const batchWeightTotal = waxWeight + fragranceWeight;

        // Calculate Batch Costs
        let waxCost = 0;
        let fragranceCost = fragranceWeight * fragPrice;

        if (currentUnit === 'oz') {
            // Wax price is entered per lb (16 oz)
            waxCost = (waxWeight / 16) * waxPrice;
        } else {
            // Wax price is entered per kg (1000g)
            waxCost = (waxWeight / 1000) * waxPrice;
        }

        const totalBatchCost = waxCost + fragranceCost;
        const perCandleCost = totalBatchCost / qty;

        // Format and display
        $('out-wax-weight').textContent = waxWeight.toFixed(1);
        $('out-wax-unit').textContent = currentUnit;
        $('out-fragrance-weight').textContent = `${fragranceWeight.toFixed(1)} ${currentUnit}`;
        $('out-total-weight').textContent = `${batchWeightTotal.toFixed(1)} ${currentUnit}`;
        
        $('out-batch-cost').textContent = `$${totalBatchCost.toFixed(2)}`;
        $('out-candle-cost').textContent = `$${perCandleCost.toFixed(2)}`;
        $('out-candle-status').textContent = `For ${qty} Candle(s) (${capacity} ${currentUnit} capacity each)`;

        // Pouring insights
        const ins = [];
        
        // Scent throw insight
        if (load < 6) {
            ins.push('<strong>Scent Throw</strong>: A low scent load (under 6%) is excellent for sensitive environments, but may give a faint scent throw.');
        } else if (load <= 9) {
            ins.push('<strong>Scent Throw</strong>: Standard fragrance load (6%-9%) offers the optimal balance of hot scent throw and clean burning for soy blends.');
        } else {
            ins.push('<span class="text-warning"><i class="fas fa-exclamation-triangle me-1"></i> <strong>High scent load</strong> (10%+): Verify that your wax can hold this load without oil sweating or soot buildup. Use a robust double-wick if necessary.</span>');
        }

        // Pouring temperature tips
        if (density === 0.86) {
            ins.push('<strong>Pour Temp (Soy)</strong>: Melt soy wax to 185°F (85°C). Add fragrance oil immediately to bind molecules, stir gently for 2 minutes, and pour near 135°F (57°C) into preheated jars.');
        } else if (density === 0.90) {
            ins.push('<strong>Pour Temp (Paraffin)</strong>: Add fragrance oil at 180°F (82°C) and pour hot near 160°F - 170°F (71°C - 77°C) for smooth top finishes.');
        } else if (density === 0.93) {
            ins.push('<strong>Pour Temp (Beeswax)</strong>: Melt to 160°F - 170°F (71°C - 77°C). Pour hot into pre-warmed containers. Cooling too quickly causes beeswax to crack.');
        }

        $('out-candle-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2">${i}</li>`).join('')}</ul>`;
    }

    // Handle Unit Toggles
    document.querySelectorAll('.unit-toggle-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const unit = btn.dataset.unit;
            if (unit === currentUnit) return;

            document.querySelectorAll('.unit-toggle-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Convert inputs
            let currentCap = parseFloat(capacityE.value) || 0;
            let currentFragPrice = parseFloat(fragrancePriceE.value) || 0;

            if (unit === 'grams') {
                capacityE.value = (currentCap * 28.3495).toFixed(0);
                fragrancePriceE.value = (currentFragPrice / 28.3495).toFixed(3);
                document.querySelectorAll('.cap-unit-text').forEach(el => el.textContent = 'g');
                document.querySelectorAll('.cost-unit-label').forEach(el => el.textContent = 'per kg');
                document.querySelectorAll('.cost-unit-label-small').forEach(el => el.textContent = 'per g');
            } else {
                capacityE.value = (currentCap / 28.3495).toFixed(1);
                fragrancePriceE.value = (currentFragPrice * 28.3495).toFixed(2);
                document.querySelectorAll('.cap-unit-text').forEach(el => el.textContent = 'oz');
                document.querySelectorAll('.cost-unit-label').forEach(el => el.textContent = 'per lb');
                document.querySelectorAll('.cost-unit-label-small').forEach(el => el.textContent = 'per oz');
            }

            currentUnit = unit;
            calculateCandle();
        });
    });

    // Listeners
    [qtyE, capacityE, scentLoadE, waxDensityE, waxPriceE, fragrancePriceE].forEach(el => {
        el.addEventListener('input', calculateCandle);
    });

    // Reset Fields
    $('candle-reset').addEventListener('click', () => {
        qtyE.value = 4;
        capacityE.value = currentUnit === 'oz' ? 8 : 220;
        scentLoadE.value = 8;
        waxDensityE.value = 0.86;
        waxPriceE.value = 6;
        fragrancePriceE.value = currentUnit === 'oz' ? '2.5' : '0.088';
        calculateCandle();
    });

    // Copy Specs
    $('candle-copy-btn').addEventListener('click', function(){
        const text = `Candle Batch Recipe Specifications:\n` +
                     `-------------------------------------------\n` +
                     `Total Candles: ${qtyE.value} jars x ${capacityE.value} ${currentUnit} capacity\n` +
                     `Wax Blend Preset Density: ${waxDensityE.value}\n` +
                     `Fragrance scent load percentage: ${scentLoadE.value}%\n` +
                     `-------------------------------------------\n` +
                     `Total Wax Weight Needed: ${$('out-wax-weight').textContent} ${currentUnit}\n` +
                     `Total Fragrance Oil Needed: ${$('out-fragrance-weight').textContent}\n` +
                     `Total Batch Weight: ${$('out-total-weight').textContent}\n` +
                     `Estimated Batch Cost: ${$('out-batch-cost').textContent}\n` +
                     `Calculated via ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied Recipe!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    // Share link simple implementation
    $('candle-share-btn').addEventListener('click', function(){
        const dummyUrl = window.location.href;
        navigator.clipboard.writeText(dummyUrl).then(()=>{
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied URL Link!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculateCandle();
});
</script>

<style>
.candle-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:1.5rem;box-shadow:0 8px 48px rgba(217,119,6,.03)}
.candle-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:1.25rem}
.candle-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.25rem}
.candle-calculator-rebuilt .calculator-header p{margin:0;font-size:0.875rem;color:#64748b;line-height:1.6}
.candle-calculator-rebuilt .tool-icon-circle{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem;flex-shrink:0}
.candle-calculator-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.candle-calculator-rebuilt .btn-outline-amber{border-color:#d97706; color:#d97706; border-width:2.5px}
.candle-calculator-rebuilt .btn-outline-amber.active{background-color:#d97706; border-color:#d97706; color:#fff}
.candle-calculator-rebuilt .btn-outline-amber:hover{background-color:rgba(217,119,6,.1); color:#d97706}
.candle-calculator-rebuilt .btn-outline-amber.active:hover{background-color:#d97706; color:#fff}
.text-amber{color:#d97706!important}
.candle-calculator-rebuilt .form-range::-webkit-slider-thumb{background:#d97706}
.candle-calculator-rebuilt .form-range::-moz-range-thumb{background:#d97706}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:1.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:1.25rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:1rem}
.output-hero-label{display:block;font-size:.75rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:0.5rem}
.output-hero-value{font-size:2.25rem;font-weight:900;line-height:1;letter-spacing:-2px}
.stat-card{border:2.5px solid #f1f5f9;border-radius:16px;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1px;margin-bottom:4px}
.stat-card-value{font-size:1.15rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .candle-calculator-rebuilt .calculator-card { padding: 1rem; }
    .output-card-themed { padding: 1rem; }
    .output-hero-value { font-size: 1.6rem; }
}
</style>
