<div class="row g-4 bowling-modern">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(71, 85, 105, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-slate" style="background: linear-gradient(135deg, #475569, #1E293B); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-bowling-ball"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#0f172a; letter-spacing: -0.5px;">Bowling Score Architect</h4>
                    <p class="text-muted small mb-0">Professional ten-pin scoring engine with real-time frame-by-frame strike and spare logic.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle mb-0" id="score-table" style="border-radius: 12px; overflow: hidden; border-style: hidden; box-shadow: 0 0 0 1px #e2e8f0;">
                        <thead class="bg-slate-50">
                            <tr>
                                <?php for($i=1; $i<=9; $i++): ?> <th style="width: 9%;">F<?php echo e($i); ?></th> <?php endfor; ?>
                                <th style="width: 14%;">F10</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php for($i=1; $i<=9; $i++): ?>
                                <td class="p-1">
                                    <div class="d-flex gap-1">
                                        <input type="text" class="form-control form-control-sm text-center fw-bold ball-input" data-frame="<?php echo e($i); ?>" data-ball="1" maxlength="1" placeholder="-">
                                        <input type="text" class="form-control form-control-sm text-center fw-bold ball-input" data-frame="<?php echo e($i); ?>" data-ball="2" maxlength="1" placeholder="-">
                                    </div>
                                    <div class="mt-2 small text-muted frame-total" id="frame-<?php echo e($i); ?>-total">0</div>
                                </td>
                                <?php endfor; ?>
                                <td class="p-1">
                                    <div class="d-flex gap-1">
                                        <input type="text" class="form-control form-control-sm text-center fw-bold ball-input" data-frame="10" data-ball="1" maxlength="1" placeholder="-">
                                        <input type="text" class="form-control form-control-sm text-center fw-bold ball-input" data-frame="10" data-ball="2" maxlength="1" placeholder="-">
                                        <input type="text" class="form-control form-control-sm text-center fw-bold ball-input" data-frame="10" data-ball="3" maxlength="1" placeholder="-">
                                    </div>
                                    <div class="mt-2 small text-muted frame-total" id="frame-10-total">0</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-game" data-type="perfect">Perfect Game (300)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-game" data-type="spare">All Spares (150)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-game" data-type="avg">Typical Game (120)</button>
                    <button class="btn btn-outline-danger rounded-pill px-4 fw-bold btn-sm shadow-sm ms-auto" id="clear-board" style="min-width: 280px; max-width: 100%;">Clear Board</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 215; --tool-color: #475569; --tool-bg: rgba(71, 85, 105, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL GAME SCORE</span>
                <div class="output-hero-value display-1 fw-900 my-2 text-slate-900" id="out-score">0</div>
                <div class="badge bg-slate-soft text-slate px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">WAITING FOR FIRST ROLL...</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    <div class="col-md-6 text-center">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-1 uppercase opacity-50">Strikes / Spares</h6>
                            <div class="h3 fw-900 mb-0" id="stat-counts">0 / 0</div>
                        </div>
                    </div>

                    <div class="col-md-6 text-center">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-1 uppercase opacity-50">Max Potential</h6>
                            <div class="h3 fw-900 mb-0" id="stat-max">300</div>
                        </div>
                    </div>

                    
                    <div class="col-12 border-top pt-4">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <button class="btn d-block mx-auto btn-slate rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Final Scorecard
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
    const inputs = document.querySelectorAll('.ball-input');

    function parseRoll(val){
        if(val.toUpperCase() === 'X') return 10;
        if(val === '/') return '/';
        const n = parseInt(val);
        return isNaN(n) ? 0 : n;
    }

    function calculate(){
        let rolls = [];
        let strikeCount = 0;
        let spareCount = 0;

        // Collect rolls
        for(let f=1; f<=10; f++){
            const b1 = $(`score-table`).querySelector(`input[data-frame="${f}"][data-ball="1"]`).value.toUpperCase();
            const b2 = $(`score-table`).querySelector(`input[data-frame="${f}"][data-ball="2"]`).value.toUpperCase();
            
            if(f < 10){
                if(b1 === 'X') { rolls.push(10); strikeCount++; }
                else {
                    const r1 = parseRoll(b1);
                    rolls.push(r1);
                    if(b2 === '/') { rolls.push(10 - r1); spareCount++; }
                    else rolls.push(parseRoll(b2));
                }
            } else {
                // Frame 10 logic
                const b3 = $(`score-table`).querySelector(`input[data-frame="10"][data-ball="3"]`).value.toUpperCase();
                const r1 = b1 === 'X' ? 10 : parseRoll(b1);
                const r2 = b2 === 'X' ? 10 : (b2 === '/' ? 10 - r1 : parseRoll(b2));
                const r3 = b3 === 'X' ? 10 : (b3 === '/' ? 10 - r2 : parseRoll(b3));
                rolls.push(r1, r2, r3);
                if(b1 === 'X') strikeCount++;
                if(b2 === 'X') strikeCount++;
                if(b3 === 'X') strikeCount++;
                if(b2 === '/') spareCount++;
                if(b3 === '/') spareCount++;
            }
        }

        let score = 0;
        let rollIndex = 0;
        let frameScores = [];

        for(let f=0; f<10; f++){
            if(rolls[rollIndex] === 10 && f < 9){ // Strike
                score += 10 + (rolls[rollIndex+1] || 0) + (rolls[rollIndex+2] || 0);
                rollIndex++;
            } else if (f < 9 && (rolls[rollIndex] + rolls[rollIndex+1]) === 10){ // Spare
                score += 10 + (rolls[rollIndex+2] || 0);
                rollIndex += 2;
            } else if (f < 9){
                score += (rolls[rollIndex] || 0) + (rolls[rollIndex+1] || 0);
                rollIndex += 2;
            } else {
                // Frame 10
                score += (rolls[rollIndex] || 0) + (rolls[rollIndex+1] || 0) + (rolls[rollIndex+2] || 0);
            }
            frameScores.push(score);
            $(`frame-${f+1}-total`).textContent = score;
        }

        $('out-score').textContent = score;
        $('stat-counts').textContent = `${strikeCount} X / ${spareCount} /`;
        
        let status = 'IN PROGRESS';
        if(score >= 250) status = 'PRO LEVEL PERFORMANCE!';
        else if(score >= 200) status = 'EXCELLENT GAME!';
        else if(score >= 150) status = 'SOLID SCORE!';
        else if(score > 0) status = 'KEEP ROLLING!';
        $('out-status').textContent = status;
    }

    inputs.forEach(input => {
        input.addEventListener('input', (e) => {
            const val = e.target.value.toUpperCase();
            if(val && !['X', '/', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'].includes(val)){
                e.target.value = '';
            }
            calculate();
            
            // Auto focus next input
            if(e.target.value.length === 1){
                const frame = parseInt(e.target.dataset.frame);
                const ball = parseInt(e.target.dataset.ball);
                let next;
                if(ball === 1 && val !== 'X') next = $(`score-table`).querySelector(`input[data-frame="${frame}"][data-ball="2"]`);
                else if(frame < 10) next = $(`score-table`).querySelector(`input[data-frame="${frame+1}"][data-ball="1"]`);
                else if(frame === 10 && ball < 3) next = $(`score-table`).querySelector(`input[data-frame="10"][data-ball="${ball+1}"]`);
                if(next) next.focus();
            }
        });
    });

    document.querySelectorAll('.quick-game').forEach(btn => {
        btn.addEventListener('click', () => {
            const type = btn.dataset.type;
            inputs.forEach(i => i.value = '');
            if(type === 'perfect'){
                for(let f=1; f<=9; f++) $(`score-table`).querySelector(`input[data-frame="${f}"][data-ball="1"]`).value = 'X';
                $(`score-table`).querySelector(`input[data-frame="10"][data-ball="1"]`).value = 'X';
                $(`score-table`).querySelector(`input[data-frame="10"][data-ball="2"]`).value = 'X';
                $(`score-table`).querySelector(`input[data-frame="10"][data-ball="3"]`).value = 'X';
            } else if(type === 'spare'){
                for(let f=1; f<=10; f++){
                    $(`score-table`).querySelector(`input[data-frame="${f}"][data-ball="1"]`).value = '9';
                    $(`score-table`).querySelector(`input[data-frame="${f}"][data-ball="2"]`).value = '/';
                }
                $(`score-table`).querySelector(`input[data-frame="10"][data-ball="3"]`).value = '9';
            } else {
                for(let f=1; f<=10; f++){
                    $(`score-table`).querySelector(`input[data-frame="${f}"][data-ball="1"]`).value = '6';
                    $(`score-table`).querySelector(`input[data-frame="${f}"][data-ball="2"]`).value = '2';
                }
            }
            calculate();
        });
    });

    $('clear-board').addEventListener('click', () => {
        inputs.forEach(i => i.value = '');
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Bowling Score Report\nTotal Score: ${$('out-score').textContent}\nStatus: ${$('out-status').textContent}\nGenerated by ToolsHub Sports Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    calculate();
});
</script>

<style>
.bg-slate-50 { background-color: #f8fafc; }
.btn-slate { background: #475569; color: #fff; transition: all .3s; }
.btn-slate:hover { background: #1e293b; color: #fff; transform: translateY(-2px); }
.bg-slate-soft { background: #f1f5f9; color: #475569; }
.fw-900 { font-weight: 900; }
.pulse-slate { animation: slate-pulse 2s infinite; }
@keyframes slate-pulse { 0% { box-shadow: 0 0 0 0 rgba(71, 85, 105, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(71, 85, 105, 0); } 100% { box-shadow: 0 0 0 0 rgba(71, 85, 105, 0); } }
.ball-input { border: 1px solid #e2e8f0 ! sharpness; font-size: 0.9rem; padding: 4px; }
.ball-input:focus { border-color: #475569; box-shadow: 0 0 0 2px rgba(71, 85, 105, 0.1); }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\bowling-score-calculator.blade.php ENDPATH**/ ?>