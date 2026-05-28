<div class="row g-4 celebration-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(236, 72, 153, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm confetti-shake" style="background: linear-gradient(135deg, #EC4899, #F472B6); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-birthday-cake"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#831843; letter-spacing: -0.5px;">Celebration Countdown</h4>
                    <p class="text-muted small mb-0">Synchronize your excitement with a real-time temporal bridge to your next big milestone.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Target Milestone</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Select Birthday Date</label>
                                <input type="date" id="v-date" class="form-control border-0 bg-white shadow-sm rounded-4 p-4 fw-bold h4 mb-0" value="<?php echo e(date('Y-m-d', strtotime('+30 days'))); ?>">
                            </div>
                            <div class="row g-2">
                                <div class="col-6">
                                    <button class="btn btn-white w-100 rounded-pill py-2 small fw-bold shadow-sm quick-load" data-v="<?php echo e(date('Y-m-d', strtotime('+7 days'))); ?>">Next Week</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-white w-100 rounded-pill py-2 small fw-bold shadow-sm quick-load" data-v="<?php echo e(date('Y-m-d', strtotime('+30 days'))); ?>">Next Month</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-pink">
                            <h6 class="fw-bold small mb-3 uppercase text-pink opacity-70">Party Readiness</h6>
                            <div class="vstack gap-3 text-center">
                                <div class="p-3 rounded-4 bg-pink-50 border border-pink-100">
                                    <div class="small fw-bold text-pink-900 mb-1">GIFT PLANNING</div>
                                    <div class="small text-muted" id="out-gift">Time to start browsing!</div>
                                </div>
                                <div class="p-3 rounded-4 bg-pink-50 border border-pink-100">
                                    <div class="small fw-bold text-pink-900 mb-1">MOOD LEVEL</div>
                                    <div class="small text-muted">Building Excitement...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 330; --tool-color: #EC4899; --tool-bg: rgba(236, 72, 153, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TIME TO CELEBRATION</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-days">30</div>
                <div class="badge bg-pink-soft text-pink px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">DAYS REMAINING</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Live Temporal Stream</h6>
                        <div class="row g-2 text-center">
                            <div class="col-3"><div class="p-3 border rounded-3 bg-light"><div class="h5 fw-bold mb-0" id="out-weeks">4</div><div class="small fw-bold opacity-50 uppercase" style="font-size: 0.6rem;">WEEKS</div></div></div>
                            <div class="col-3"><div class="p-3 border rounded-3 bg-light"><div class="h5 fw-bold mb-0" id="out-hours">720</div><div class="small fw-bold opacity-50 uppercase" style="font-size: 0.6rem;">HOURS</div></div></div>
                            <div class="col-3"><div class="p-3 border rounded-3 bg-light"><div class="h5 fw-bold mb-0" id="out-mins">--</div><div class="small fw-bold opacity-50 uppercase" style="font-size: 0.6rem;">MINS</div></div></div>
                            <div class="col-3"><div class="p-3 border rounded-3 bg-light"><div class="h5 fw-bold mb-0" id="out-secs">--</div><div class="small fw-bold opacity-50 uppercase" style="font-size: 0.6rem;">SECS</div></div></div>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Share Joy</h6>
                            <div class="p-3 rounded-4 bg-pink-50 border border-pink-100 mb-4">
                                <div class="small fw-bold text-pink-900 lh-base" id="out-advice">Invite friends now for the best turnout!</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-pink rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-gift me-2"></i>Copy Invitation Link
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Timer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const dateE = $('v-date');
    let timer;

    function update(){
        const target = new Date(dateE.value);
        const now = new Date();
        const diff = target - now;

        if(diff < 0){
            $('out-days').textContent = 'PARTY!';
            $('out-status').textContent = 'IT IS CELEBRATION TIME';
            return;
        }

        const d = Math.floor(diff / (1000 * 60 * 60 * 24));
        const h = Math.floor((diff / (1000 * 60 * 60)) % 24);
        const m = Math.floor((diff / (1000 * 60)) % 60);
        const s = Math.floor((diff / 1000) % 60);

        $('out-days').textContent = d.toLocaleString();
        $('out-weeks').textContent = Math.floor(d / 7);
        $('out-hours').textContent = h;
        $('out-mins').textContent = m;
        $('out-secs').textContent = s;

        // Logic
        if(d < 7) $('out-gift').textContent = "CRITICAL: Buy gifts now!";
        else if(d < 30) $('out-gift').textContent = "Plan your shopping list.";
        else $('out-gift').textContent = "Plenty of time to browse.";

        $('out-advice').textContent = d < 14 ? "Send final reminders to guests!" : "Secure the venue and catering.";
    }

    dateE.addEventListener('input', () => {
        clearInterval(timer);
        update();
        timer = setInterval(update, 1000);
    });

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => { dateE.value = btn.dataset.v; update(); });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `The countdown is ON! 🎂 Only ${$('out-days').textContent} days until the big celebration! Join the hype on ToolsHub.`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Link Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => {
        const d = new Date(); d.setDate(d.getDate() + 30);
        dateE.value = d.toISOString().split('T')[0]; update();
    });

    update();
    timer = setInterval(update, 1000);
});
</script>

<style>
.celebration-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#831843;opacity:.7;margin-bottom:8px;display:block}
.celebration-rebuilt .calculator-card { transition: all 0.3s ease; }
.confetti-shake { animation: shake 0.5s infinite; }
@keyframes shake { 0% { transform: rotate(0); } 25% { transform: rotate(5deg); } 50% { transform: rotate(0); } 75% { transform: rotate(-5deg); } 100% { transform: rotate(0); } }
.btn-pink { background: #EC4899; color: #fff; transition: all .3s; }
.btn-pink:hover { background: #DB2777; color: #fff; transform: translateY(-2px); }
.bg-pink-soft { background: #FDF2F8; color: #EC4899; }
.bg-pink-50 { background-color: #fff9fb; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\birthday-countdown.blade.php ENDPATH**/ ?>