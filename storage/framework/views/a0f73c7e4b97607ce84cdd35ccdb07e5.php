<?php echo $__env->make('tools.partials.medical-disclaimer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="row g-4 preg-cal-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4 justify-content-center text-center">
                    <div class="col-md-7">
                        <label class="form-label-custom">First Day of Last Period (LMP)</label>
                        <input type="date" id="pc-lmp-date" class="form-control form-control-lg rounded-pill px-4 text-center border-2 border-primary-subtle" value="<?php echo e(date('Y-m-d', strtotime('-10 weeks'))); ?>">
                        <p class="mt-2 text-muted small"><i class="fas fa-magic me-1"></i> Interactive timeline updates instantly as you change the date.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="pc-output-card" style="--tool-hue:260;--tool-color:#8b5cf6;--tool-bg:rgba(139,92,246,.04);">
            <div class="output-hero py-4" style="background:linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); color: white; border-radius: 20px 20px 0 0;">
                <div class="d-flex justify-content-between align-items-center px-4">
                    <div class="text-start">
                        <span class="output-hero-label text-white text-opacity-75">Current Stage</span>
                        <div class="output-hero-value text-white" id="out-pc-val" style="font-size:3rem">10 Weeks</div>
                    </div>
                    <div class="text-end">
                        <span class="output-hero-label text-white text-opacity-75">Due Date</span>
                        <div class="fw-bold h4 mb-0" id="out-pc-edd">--</div>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white">
                <div class="row g-4">
                    
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-light border text-center h-100">
                            <h6 class="fw-bold mb-3 text-uppercase small tracking-wider">Growth Comparison</h6>
                            <div class="display-1 mb-2" id="out-pc-icon">🍓</div>
                            <h5 class="fw-bold text-primary mb-2" id="out-pc-size">Strawberry</h5>
                            <p class="small text-secondary mb-0" id="out-pc-desc">Major organs like the Heart and Brain are developing rapidly.</p>
                        </div>
                    </div>

                    
                    <div class="col-md-8">
                        <h6 class="fw-bold mb-4 px-2">Essential Clinical Timeline</h6>
                        <div class="timeline-container ps-2" id="pc-timeline">
                            
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="pc-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Pregnancy Timeline</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const lmpEl = $('pc-lmp-date');

    const milstones = [
        { w: 4, label: "Detection", desc: "Pregnancy can be confirmed via blood/urine test." },
        { w: 8, label: "Heartbeat", desc: "Baby's heart begins to beat. First ultrasound marker." },
        { w: 12, label: "T1 Anatomy", desc: "First trimester complete. Major organs formed." },
        { w: 20, label: "Anatomy Scan", desc: "Mid-pregnancy scan. Gender identification possible." },
        { w: 24, label: "Viability", desc: "Baby has a chance of survival with intensive care." },
        { w: 28, label: "T3 Start", desc: "Third trimester begins. Rapid brain growth." },
        { w: 32, label: "Growth Spur", desc: "Baby is practicing breathing and blinking." },
        { w: 36, label: "Full Term (Early)", desc: "Lungs are almost fully matured." },
        { w: 40, label: "Arrival", desc: "Your estimated due date (EDD)." }
    ];

    const sizes = [
        { w: 4, icon: "📍", name: "Poppy Seed", desc: "A tiny bundle of cells called a blastocyst." },
        { w: 8, icon: "🍇", name: "Raspberry", desc: "Baby has tiny webbed fingers and toes." },
        { w: 12, icon: "🍋", name: "Lemon", desc: "Baby is now moving and starting to make faces." },
        { w: 16, icon: "🥑", name: "Avocado", desc: "Senses are developing; baby can feel light." },
        { w: 20, icon: "🍌", name: "Banana", desc: "Baby is swallowing amniotic fluid to practice digestion." },
        { w: 24, icon: "🌽", name: "Ear of Corn", desc: "Inner ear is formed; baby can hear your heartbeat." },
        { w: 28, icon: "🍆", name: "Eggplant", desc: "Eyelashes are growing and eyes can open." },
        { w: 32, icon: "🥥", name: "Coconut", desc: "The layer of fat under the skin is thickening." },
        { w: 36, icon: "🍈", name: "Honeydew", desc: "Baby is gaining about half a pound per week." },
        { w: 40, icon: "🍉", name: "Watermelon", desc: "Ready to meet the world any day now!" }
    ];

    function calculate(){
        const lmp = new Date(lmpEl.value);
        if(isNaN(lmp)) return;

        const now = new Date();
        now.setHours(0,0,0,0);
        const totalDays = Math.floor((now - lmp) / (1000 * 60 * 60 * 24));
        const weeks = Math.floor(totalDays / 7);

        $('out-pc-val').textContent = `${weeks} Weeks ${totalDays%7}d`;
        
        const eddDate = new Date(lmp);
        eddDate.setDate(lmp.getDate() + 280);
        $('out-pc-edd').textContent = eddDate.toLocaleDateString(undefined, { month: 'short', day: 'numeric', year: 'numeric' });

        // Update Size
        let currentSize = sizes[0];
        for(let s of sizes) { if(weeks >= s.w) currentSize = s; else break; }
        $('out-pc-icon').textContent = currentSize.icon;
        $('out-pc-size').textContent = currentSize.name;
        $('out-pc-desc').textContent = currentSize.desc;

        // Update Timeline
        let timelineHtml = "";
        milstones.forEach(m => {
            const mDate = new Date(lmp);
            mDate.setDate(lmp.getDate() + (m.w * 7));
            const isPast = weeks >= m.w;
            const dateStr = mDate.toLocaleDateString(undefined, { month: 'short', day: 'numeric' });

            timelineHtml += `
            <div class="d-flex align-items-center gap-3 mb-3 ${isPast ? 'opacity-50' : 'fw-bold'}">
                <div class="rounded-circle text-center border ${isPast ? 'bg-light text-muted' : 'bg-primary text-white border-primary'} " style="width:48px; height:48px; line-height:46px; flex-shrink:0;">
                    ${m.w}w
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between border-bottom pb-1">
                        <span>${m.label}</span>
                        <span class="small text-muted">${dateStr}</span>
                    </div>
                </div>
            </div>`;
        });
        $('pc-timeline').innerHTML = timelineHtml;
    }

    lmpEl.addEventListener('input', calculate);
    
    $('pc-copy').addEventListener('click', function(){
        const text=`Pregnancy Milestone Plan\nCurrent: ${$('out-pc-val').textContent}\nDue Date: ${$('out-pc-edd').textContent}\nSize: ${$('out-pc-size').textContent}\n— ToolsHub Family Health`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o, 2000)});
    });

    calculate();
});
</script>

<style>
.preg-cal-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.preg-cal-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.preg-cal-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.preg-cal-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.preg-cal-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.preg-cal-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.preg-cal-rebuilt .output-hero{ transition: all 0.3s; }
.preg-cal-rebuilt .stat-card{ padding: 1rem; background: #f8fafc; border-radius: 12px; }
.preg-cal-rebuilt .stat-card-label{ font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; display: block; margin-bottom: 0.25rem; }
.preg-cal-rebuilt .stat-card-value{ font-size: 1.1rem; font-weight: 800; color: #1e293b; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\pregnancy-calendar.blade.php ENDPATH**/ ?>