<div class="row g-4 scientific-rebuilt">
    
    <div class="col-lg-8">
        <div class="calculator-card border-0 shadow-lg overflow-hidden" style="border-radius: 28px; background: #0f172a; color: #f8fafc; border: 1px solid rgba(20, 184, 166, 0.2);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center bg-slate-900/50">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #0D9488, #0f172a); color:#5eead4; width: 50px; height: 50px; border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; border: 1px solid rgba(94, 234, 212, 0.2);">
                    <i class="fas fa-microchip"></i>
                </div>
                <div class="ms-3">
                    <h5 class="fw-bold mb-0 text-teal-400">Scientific Calculator</h5>
                    <p class="text-teal-900 small mb-0 opacity-50">Advanced Scientific & Algebraic Processing</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                
                <div class="p-4 rounded-4 mb-4 bg-slate-950 border border-slate-800 text-end shadow-inner" style="min-height: 140px; background-image: radial-gradient(#1e293b 1px, transparent 1px); background-size: 20px 20px;">
                    <div id="v-exp" class="font-monospace text-teal-600 mb-1" style="font-size: 1.1rem; height: 1.5rem; letter-spacing: 1px;"></div>
                    <div id="v-val" class="display-3 fw-900 text-white font-monospace" style="letter-spacing: -2px;">0</div>
                </div>

                
                <div class="row g-2">
                    
                    <div class="col-3">
                        <div class="vstack gap-2">
                            <button class="btn btn-slate-dark calc-key" data-op="sin">sin</button>
                            <button class="btn btn-slate-dark calc-key" data-op="cos">cos</button>
                            <button class="btn btn-slate-dark calc-key" data-op="tan">tan</button>
                            <button class="btn btn-slate-dark calc-key" data-op="log">log</button>
                            <button class="btn btn-slate-dark calc-key" data-op="sqrt">√</button>
                        </div>
                    </div>
                    
                    <div class="col-9">
                        <div class="grid-keypad">
                            <button class="btn btn-danger-dark calc-key" data-op="clear">AC</button>
                            <button class="btn btn-slate-light calc-key" data-val="(">(</button>
                            <button class="btn btn-slate-light calc-key" data-val=")">)</button>
                            <button class="btn btn-teal-dark calc-key" data-val="/">÷</button>
                            
                            <button class="btn btn-slate calc-key" data-val="7">7</button>
                            <button class="btn btn-slate calc-key" data-val="8">8</button>
                            <button class="btn btn-slate calc-key" data-val="9">9</button>
                            <button class="btn btn-teal-dark calc-key" data-val="*">×</button>
                            
                            <button class="btn btn-slate calc-key" data-val="4">4</button>
                            <button class="btn btn-slate calc-key" data-val="5">5</button>
                            <button class="btn btn-slate calc-key" data-val="6">6</button>
                            <button class="btn btn-teal-dark calc-key" data-val="-">-</button>
                            
                            <button class="btn btn-slate calc-key" data-val="1">1</button>
                            <button class="btn btn-slate calc-key" data-val="2">2</button>
                            <button class="btn btn-slate calc-key" data-val="3">3</button>
                            <button class="btn btn-teal-dark calc-key" data-val="+">+</button>
                            
                            <button class="btn btn-slate calc-key" data-val="0">0</button>
                            <button class="btn btn-slate calc-key" data-val=".">.</button>
                            <button class="btn btn-slate calc-key" data-val="**">^</button>
                            <button class="btn btn-teal calc-key" data-op="equal">=</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4">
        <div class="calculator-card h-100 border-0 shadow-sm" style="border-radius: 28px; background: #fff; border: 1px solid #e2e8f0;">
            <div class="calculator-header p-4 border-bottom d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="fw-bold mb-0">Compute Log</h6>
                    <p class="text-muted small mb-0">Local Session History</p>
                </div>
                <button class="btn btn-sm btn-light rounded-circle" id="clear-hist"><i class="fas fa-trash-alt"></i></button>
            </div>
            <div class="calculator-body p-3 overflow-auto" id="history-log" style="max-height: 500px;">
                <div class="text-center py-5 text-muted small opacity-50">
                    <i class="fas fa-history fa-2x mb-3 d-block"></i>
                    No calculations recorded yet.
                </div>
            </div>
            <div class="p-3 border-top bg-light text-center" style="border-radius: 0 0 28px 28px;">
                <button class="btn btn-outline-teal w-100 py-2 rounded-4 fw-bold small" id="copy-last">
                    <i class="fas fa-copy me-2"></i>Copy Last Result
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const expE = $('v-exp'), valE = $('v-val'), logE = $('history-log');
    let expr = "";
    let history = [];

    function updateLog(e, r){
        history.unshift({e, r});
        logE.innerHTML = history.map((item, idx) => `
            <div class="p-3 rounded-4 bg-light mb-2 border border-slate-100 history-item" style="cursor: pointer;" onclick="document.getElementById('v-val').textContent='${item.r}'; document.getElementById('v-exp').textContent='${item.e}';">
                <div class="small text-muted font-monospace mb-1">${item.e}</div>
                <div class="fw-bold text-dark font-monospace">${item.r}</div>
            </div>
        `).join('');
    }

    document.querySelectorAll('.calc-key').forEach(btn => {
        btn.addEventListener('click', function(){
            const val = this.dataset.val;
            const op = this.dataset.op;

            if(op === 'clear'){
                expr = ""; valE.textContent = "0"; expE.textContent = "";
            } else if(op === 'equal'){
                try {
                    const res = Function('"use strict"; return (' + expr + ')')();
                    const final = Number.isInteger(res) ? res : parseFloat(res.toFixed(8));
                    updateLog(expr, final);
                    valE.textContent = final;
                    expr = final.toString();
                    expE.textContent = "";
                } catch(e) { valE.textContent = "Syntax Error"; }
            } else if(op){
                expr += `Math.${op}(`;
                expE.textContent = expr;
            } else {
                expr += val;
                expE.textContent = expr;
            }
        });
    });

    $('clear-hist').addEventListener('click', () => { history = []; logE.innerHTML = ''; });
    $('copy-last').addEventListener('click', () => {
        navigator.clipboard.writeText(valE.textContent).then(() => {
            const o = $('copy-last').innerHTML; $('copy-last').innerHTML = 'Copied!';
            setTimeout(() => $('copy-last').innerHTML = o, 1500);
        });
    });
});
</script>

<style>
.scientific-rebuilt .calc-key { border-radius: 12px; padding: 1.25rem 0; font-weight: 700; border: none; }
.scientific-rebuilt .grid-keypad { display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.5rem; }
.btn-slate { background: #1e293b; color: #f8fafc; }
.btn-slate-light { background: #334155; color: #f8fafc; }
.btn-slate-dark { background: #0f172a; color: #94a3b8; border: 1px solid #1e293b; }
.btn-teal { background: #14B8A6; color: #fff; }
.btn-teal-dark { background: #0d9488; color: #fff; }
.btn-danger-dark { background: #991b1b; color: #fff; }
.btn-outline-teal { border: 1px solid #14B8A6; color: #14B8A6; }
.text-teal-400 { color: #2dd4bf; }
.text-teal-900 { color: #134e4a; }
.fw-900 { font-weight: 900; }
.history-item:hover { background: #f1f5f9 !important; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\desmos-type-calculator.blade.php ENDPATH**/ ?>