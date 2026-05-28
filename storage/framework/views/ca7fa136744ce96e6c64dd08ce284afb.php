<div class="max-w-4xl mx-auto space-y-4 font-sans">
    <!-- Input Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-chart-line"></i>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 m-0 leading-tight">ROI Growth Calculator</h1>
                <p class="text-sm text-slate-500 m-0">Calculate Return on Investment and Annualized Growth Rate instantly.</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Initial Investment ($)</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-emerald-500 transition-colors">
                    <span class="flex items-center px-3 bg-slate-100 text-slate-500 text-sm font-bold border-r border-slate-200"><i class="fas fa-dollar-sign"></i></span>
                    <input type="number" id="roi-initial" class="w-full bg-transparent border-none px-3 py-2 text-slate-800 font-bold focus:outline-none" value="10000" step="100">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Final Value ($)</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-emerald-500 transition-colors">
                    <span class="flex items-center px-3 bg-slate-100 text-slate-500 text-sm font-bold border-r border-slate-200"><i class="fas fa-dollar-sign"></i></span>
                    <input type="number" id="roi-final" class="w-full bg-transparent border-none px-3 py-2 text-slate-800 font-bold focus:outline-none" value="15000" step="100">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Time Period (Years)</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-emerald-500 transition-colors">
                    <input type="number" id="roi-years" class="w-full bg-transparent border-none px-3 py-2 text-slate-800 font-bold focus:outline-none" value="5" step="0.5">
                    <span class="flex items-center px-3 bg-slate-100 text-slate-500 text-sm font-bold border-l border-slate-200">Yrs</span>
                </div>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100 flex flex-wrap gap-2">
            <button type="button" onclick="calcROI()" class="flex-grow bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold py-2 px-4 rounded-xl transition-colors min-w-[140px]">
                <i class="fas fa-bolt me-1"></i> Run Analysis
            </button>
            <button type="button" onclick="setROI(5000, 10000, 7)" class="flex-grow bg-white border border-slate-200 hover:border-emerald-500 hover:bg-emerald-50 text-slate-600 hover:text-emerald-600 text-sm font-bold py-2 px-3 rounded-xl transition-colors">
                Double in 7 Yrs
            </button>
            <button type="button" onclick="setROI(10000, 12500, 1)" class="flex-grow bg-white border border-slate-200 hover:border-emerald-500 hover:bg-emerald-50 text-slate-600 hover:text-emerald-600 text-sm font-bold py-2 px-3 rounded-xl transition-colors">
                +25% in 1 Yr
            </button>
            <button type="button" onclick="resetROI()" class="w-12 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold py-2 rounded-xl transition-colors flex items-center justify-center shrink-0">
                <i class="fas fa-redo"></i>
            </button>
        </div>
    </div>

    <!-- Output Card -->
    <div id="roi-output-card" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 border-t-emerald-500 transition-colors duration-300">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
            <div class="text-center md:border-r border-gray-100 pb-4 md:pb-0 md:pr-4">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Total ROI</span>
                <div class="flex items-baseline justify-center gap-1">
                    <h2 id="out-roi-pct" class="text-4xl md:text-5xl font-extrabold text-emerald-600 tracking-tight m-0">50.00</h2>
                    <span id="out-roi-pct-unit" class="text-xl font-bold text-emerald-600">%</span>
                </div>
                <div id="out-roi-profit" class="inline-block mt-3 px-4 py-1.5 rounded-full text-sm font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                    +$5,000.00 Profit
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3 pl-0 md:pl-2">
                <div class="col-span-2 bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Annualized Return (CAGR)</span>
                    <span id="out-roi-cagr" class="text-xl font-extrabold text-slate-800">8.45%</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Initial Amount</span>
                    <span id="out-roi-init" class="text-base md:text-lg font-bold text-slate-800">$10,000.00</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Final Amount</span>
                    <span id="out-roi-final" class="text-base md:text-lg font-bold text-slate-800">$15,000.00</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function calcROI() {
    const init = parseFloat(document.getElementById('roi-initial').value) || 0;
    const final = parseFloat(document.getElementById('roi-final').value) || 0;
    const years = parseFloat(document.getElementById('roi-years').value) || 0;
    if (init <= 0 || years <= 0) return;

    const profit = final - init;
    const roiTotal = (profit / init) * 100;
    let cagr = final > 0 ? (Math.pow((final / init), (1 / years)) - 1) * 100 : -100;

    const isLoss = profit < 0;
    const colorClass = isLoss ? 'text-red-600' : 'text-emerald-600';
    const bgClass = isLoss ? 'bg-red-50 text-red-700 border-red-100' : 'bg-emerald-50 text-emerald-700 border-emerald-100';
    const borderClass = isLoss ? 'border-t-red-500' : 'border-t-emerald-500';

    document.getElementById('out-roi-pct').innerText = roiTotal.toFixed(2);
    document.getElementById('out-roi-pct').className = `text-4xl md:text-5xl font-extrabold tracking-tight m-0 ${colorClass}`;
    document.getElementById('out-roi-pct-unit').className = `text-xl font-bold ${colorClass}`;
    
    document.getElementById('roi-output-card').className = `bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 transition-colors duration-300 ${borderClass}`;

    const profitEl = document.getElementById('out-roi-profit');
    profitEl.innerText = (isLoss ? '-' : '+') + Math.abs(profit).toLocaleString('en-US', { style: 'currency', currency: 'USD' }) + (isLoss ? ' Loss' : ' Profit');
    profitEl.className = `inline-block mt-3 px-4 py-1.5 rounded-full text-sm font-bold border ${bgClass}`;

    document.getElementById('out-roi-cagr').innerText = cagr.toFixed(2) + '%';
    document.getElementById('out-roi-cagr').className = `text-xl font-extrabold ${colorClass}`;

    document.getElementById('out-roi-init').innerText = init.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
    document.getElementById('out-roi-final').innerText = final.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
}

function setROI(i, f, y) {
    document.getElementById('roi-initial').value = i;
    document.getElementById('roi-final').value = f;
    document.getElementById('roi-years').value = y;
    calcROI();
}

function resetROI() {
    setROI(10000, 15000, 5);
}

['roi-initial', 'roi-final', 'roi-years'].forEach(id => {
    document.getElementById(id).addEventListener('input', calcROI);
});

document.addEventListener('DOMContentLoaded', calcROI);
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\roi-growth-calculator.blade.php ENDPATH**/ ?>