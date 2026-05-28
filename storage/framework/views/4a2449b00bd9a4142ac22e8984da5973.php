<?php echo $__env->make('tools.partials.medical-disclaimer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="row g-4 ga-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label-custom">Dating Method</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="ga-method" id="ga-lmp" value="lmp" checked>
                            <label class="btn btn-outline-pink py-3 rounded-start-4" for="ga-lmp"><i class="fas fa-calendar-day me-2"></i>Last period (LMP)</label>
                            <input type="radio" class="btn-check" name="ga-method" id="ga-scan" value="scan">
                            <label class="btn btn-outline-pink py-3 rounded-end-4" for="ga-scan"><i class="fas fa-microscope me-2"></i>Ultrasound Scan</label>
                        </div>
                    </div>

                    <div id="ga-lmp-box" class="col-md-12">
                        <label class="form-label-custom">First Day of Last Period</label>
                        <input type="date" id="ga-lmp-date" class="form-control form-control-lg rounded-3" value="<?php echo e(date('Y-m-d', strtotime('-4 weeks'))); ?>">
                    </div>

                    <div id="ga-scan-box" class="col-md-12 d-none">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label-custom">Scan Date</label>
                                <input type="date" id="ga-scan-date" class="form-control form-control-lg rounded-3" value="<?php echo e(date('Y-m-d')); ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label-custom">Weeks</label>
                                <input type="number" id="ga-scan-w" class="form-control form-control-lg rounded-3" value="8">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label-custom">Days</label>
                                <input type="number" id="ga-scan-d" class="form-control form-control-lg rounded-3" value="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="ga-output-card" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(219,39,119,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Gestational Age</span>
                <div class="output-hero-value" id="out-ga-val" style="font-size:3.5rem">4w 0d</div>
            </div>

            <div class="position-relative mt-4 mb-1 px-4 text-center">
                <span id="out-ga-trim" class="badge rounded-pill px-3 py-2 bg-pink-soft text-pink fw-bold">First Trimester</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Due Date (EDD)</span>
                        <span class="stat-card-value text-pink" id="out-ga-edd">-</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Remaining Time</span>
                        <span class="stat-card-value" id="out-ga-rem">-</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border border-opacity-10 border-pink shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-sparkles me-2 text-pink"></i>Pregnancy Milestone</h6>
                <div id="ga-advice" class="small text-secondary"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="ga-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Pregnancy Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const inputs = ['ga-lmp-date', 'ga-scan-date', 'ga-scan-w', 'ga-scan-d'];
    const methodRadios = document.getElementsByName('ga-method');

    function calculate(){
        const method = document.querySelector('input[name="ga-method"]:checked').value;
        const now = new Date();
        now.setHours(0,0,0,0);

        let totalDays = 0;

        if(method === 'lmp') {
            const lmp = new Date($('ga-lmp-date').value);
            if(isNaN(lmp)) return;
            totalDays = Math.floor((now - lmp) / (1000 * 60 * 60 * 24));
        } else {
            const scan = new Date($('ga-scan-date').value);
            const w = parseInt($('ga-scan-w').value)||0;
            const d = parseInt($('ga-scan-d').value)||0;
            if(isNaN(scan)) return;
            const diff = Math.floor((now - scan) / (1000 * 60 * 60 * 24));
            totalDays = diff + (w * 7) + d;
        }

        if(totalDays < 0) {
            $('out-ga-val').textContent = "Pre-conception";
            return;
        }

        const weeks = Math.floor(totalDays / 7);
        const days = totalDays % 7;
        const remDays = 280 - totalDays;

        $('out-ga-val').textContent = `${weeks}w ${days}d`;
        
        // EDD
        const eddDate = new Date(now);
        eddDate.setDate(now.getDate() + remDays);
        $('out-ga-edd').textContent = eddDate.toLocaleDateString(undefined, { month: 'long', day: 'numeric', year: 'numeric' });

        // Remaining
        if(remDays > 0) {
            $('out-ga-rem').textContent = `${Math.floor(remDays/7)}w ${remDays%7}d`;
        } else {
            $('out-ga-rem').textContent = "Post-term";
        }

        // Trimester & Advice
        let trim = "First", color = "#db2777", advice = "";
        if(weeks >= 27) trim = "Third";
        else if(weeks >= 13) trim = "Second";

        if(weeks < 4) advice = "Early stages. Focus on prenatal vitamins and hydration.";
        else if(weeks < 12) advice = "Baby's vital organs are forming. Morning sickness may be peaking.";
        else if(weeks < 27) advice = "The 'honeymoon' period. You may feel first movements soon.";
        else advice = "Final stretch. Your body is preparing for labor.";

        $('out-ga-trim').textContent = trim + " Trimester";
        $('ga-advice').innerHTML = advice;
    }

    methodRadios.forEach(r => r.addEventListener('change', () => {
        if(r.value === 'lmp') {
            $('ga-lmp-box').classList.remove('d-none');
            $('ga-scan-box').classList.add('d-none');
        } else {
            $('ga-lmp-box').classList.add('d-none');
            $('ga-scan-box').classList.remove('d-none');
        }
        calculate();
    }));

    inputs.forEach(id => $(id).addEventListener('input', calculate));
    
    $('ga-copy').addEventListener('click', function(){
        const text=`Pregnancy Report\nAge: ${$('out-ga-val').textContent}\nDue Date: ${$('out-ga-edd').textContent}\n${$('out-ga-trim').textContent}\n— ToolsHub Family Health`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o, 2000)});
    });

    calculate();
});
</script>

<style>
.ga-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.ga-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.ga-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.ga-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.ga-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.ga-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.ga-calc-rebuilt .btn-outline-pink{color:#db2777;border-color:#db2777}
.ga-calc-rebuilt .btn-outline-pink:hover, .ga-calc-rebuilt .btn-check:checked+.btn-outline-pink{background-color:#db2777;color:#fff}
.bg-pink-soft{background-color:rgba(219,39,119,.1)}
.text-pink{color:#db2777}
.rounded-start-4{border-top-left-radius:1rem !important;border-bottom-left-radius:1rem !important}
.rounded-end-4{border-top-right-radius:1rem !important;border-bottom-right-radius:1rem !important}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\gestational-age-calculator.blade.php ENDPATH**/ ?>