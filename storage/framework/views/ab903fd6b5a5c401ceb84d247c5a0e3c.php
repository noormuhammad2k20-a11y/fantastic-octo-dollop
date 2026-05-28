<?php echo $__env->make('tools.partials.medical-disclaimer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="row g-4 bf-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Weight</label>
                        <div class="input-group">
                            <input type="number" id="bf-weight" class="form-control form-control-lg rounded-start-3" value="65">
                            <select id="bf-w-unit" class="form-select form-select-lg rounded-end-3" style="max-width:100px">
                                <option value="kg" selected>kg</option>
                                <option value="lb">lb</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Height</label>
                        <div class="input-group">
                            <input type="number" id="bf-height" class="form-control form-control-lg rounded-start-3" value="165">
                            <select id="bf-h-unit" class="form-select form-select-lg rounded-end-3" style="max-width:100px">
                                <option value="cm" selected>cm</option>
                                <option value="in">in</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Age</label>
                        <input type="number" id="bf-age" class="form-control form-control-lg rounded-3" value="30">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Activity Level</label>
                        <select id="bf-activity" class="form-select form-select-lg rounded-3">
                            <option value="1.2" selected>Sedentary (No Exercise)</option>
                            <option value="1.375">Lightly Active (1-3 days/wk)</option>
                            <option value="1.55">Moderately Active (3-5 days/wk)</option>
                            <option value="1.725">Very Active (6-7 days/wk)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Nursing Phase</label>
                        <select id="bf-phase" class="form-select form-select-lg rounded-3">
                            <option value="500" selected>Exclusive (0-6 Months)</option>
                            <option value="400">Exclusive (6-12 Months)</option>
                            <option value="250">Partial Breastfeeding</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="bf-output-card" style="--tool-hue:200;--tool-color:#0ea5e9;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Daily Calorie Target</span>
                <div class="output-hero-value" id="out-bf-val" style="font-size:3.5rem">2,350</div>
                <span class="output-hero-unit">kcal / day</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">BMR Energy</span>
                        <span class="stat-card-value" id="out-bf-bmr">1,400</span>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">Nursing Offset</span>
                        <span class="stat-card-value text-success" id="out-bf-offset">+500</span>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">Hydration Goal</span>
                        <span class="stat-card-value text-primary">3.1 L</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border border-opacity-10 border-info shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-apple-whole me-2 text-info"></i>Nutrition Guidance</h6>
                <div id="bf-advice" class="small text-secondary"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="bf-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Nutrition Plan</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const inputs = ['bf-weight', 'bf-w-unit', 'bf-height', 'bf-h-unit', 'bf-age', 'bf-activity', 'bf-phase'];

    function calculate(){
        let w = parseFloat($('bf-weight').value)||0;
        let h = parseFloat($('bf-height').value)||0;
        const a = parseFloat($('bf-age').value)||0;
        const act = parseFloat($('bf-activity').value);
        const offset = parseFloat($('bf-phase').value);

        if(w<=0 || h<=0 || a<=0) return;

        if($('bf-w-unit').value==='lb') w *= 0.453592;
        if($('bf-h-unit').value==='in') h *= 2.54;

        // BMR (Mifflin-St Jeor for females)
        const bmr = (10 * w) + (6.25 * h) - (5 * a) - 161;
        const tdee = bmr * act;
        const total = tdee + offset;

        $('out-bf-val').textContent = Math.round(total).toLocaleString();
        $('out-bf-bmr').textContent = Math.round(bmr).toLocaleString() + " kcal";
        $('out-bf-offset').textContent = "+" + offset + " kcal";

        let advice = "To maintain milk supply, regular calorie intake is essential. Focus on protein, calcium, and iron-dense foods.";
        if(total < 1800) advice += "<br><br><strong>Note:</strong> Calorie targets below 1,800 kcal may impact milk production. Consult a dietitian if needed.";
        
        $('bf-advice').innerHTML = advice;
    }

    inputs.forEach(id => $(id).addEventListener('input', calculate));
    
    $('bf-copy').addEventListener('click', function(){
        const text=`Postpartum Nutrition Plan\nTarget: ${$('out-bf-val').textContent} kcal/day\nBMR: ${$('out-bf-bmr').textContent}\nNursing Offset: ${$('out-bf-offset').textContent}\n— ToolsHub Health`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o, 2000)});
    });

    calculate();
});
</script>

<style>
.bf-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.bf-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.bf-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.bf-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.bf-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.bf-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\breastfeeding-calorie-calculator.blade.php ENDPATH**/ ?>