<div class="max-w-4xl mx-auto space-y-4 font-sans">
    <!-- Input Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 m-0 leading-tight">Capital Gains Analyzer</h1>
                <p class="text-sm text-slate-500 m-0">Calculate profit, loss, and ROI of an asset sale instantly.</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Purchase Price per Share ($)</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-teal-500 transition-colors">
                    <span class="flex items-center px-3 bg-slate-100 text-slate-500 text-sm font-bold border-r border-slate-200"><i class="fas fa-dollar-sign"></i></span>
                    <input type="number" id="cga-buy-price" class="w-full bg-transparent border-none px-3 py-2 text-slate-800 font-bold focus:outline-none" value="50" step="0.01">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Sale Price per Share ($)</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-teal-500 transition-colors">
                    <span class="flex items-center px-3 bg-slate-100 text-slate-500 text-sm font-bold border-r border-slate-200"><i class="fas fa-dollar-sign"></i></span>
                    <input type="number" id="cga-sell-price" class="w-full bg-transparent border-none px-3 py-2 text-slate-800 font-bold focus:outline-none" value="75" step="0.01">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Quantity / Shares</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-teal-500 transition-colors">
                    <input type="number" id="cga-shares" class="w-full bg-transparent border-none px-3 py-2 text-slate-800 font-bold focus:outline-none" value="100">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Total Trading Fees ($)</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-teal-500 transition-colors">
                    <span class="flex items-center px-3 bg-slate-100 text-slate-500 text-sm font-bold border-r border-slate-200"><i class="fas fa-dollar-sign"></i></span>
                    <input type="number" id="cga-fees" class="w-full bg-transparent border-none px-3 py-2 text-slate-800 font-bold focus:outline-none" value="10">
                </div>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100 flex gap-2">
            <button type="button" onclick="calcCga()" class="flex-grow bg-teal-600 hover:bg-teal-700 text-white text-sm font-bold py-2 px-4 rounded-xl transition-colors">
                <i class="fas fa-bolt me-1"></i> Analyze Gains
            </button>
            <button type="button" onclick="resetCga()" class="w-12 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold py-2 rounded-xl transition-colors flex items-center justify-center shrink-0">
                <i class="fas fa-redo"></i>
            </button>
        </div>
    </div>

    <!-- Output Card -->
    <div id="cga-output-card" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 border-t-teal-500 transition-colors duration-300">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
            <div class="text-center md:border-r border-gray-100 pb-4 md:pb-0 md:pr-4">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Net Capital Gain</span>
                <div class="flex items-baseline justify-center gap-1">
                    <h2 id="out-cga-gain" class="text-4xl md:text-5xl font-extrabold text-teal-600 tracking-tight m-0">$2,490.00</h2>
                </div>
                <div id="out-cga-roi" class="inline-block mt-3 px-4 py-1.5 rounded-full text-sm font-bold bg-teal-50 text-teal-700 border border-teal-100">
                    +49.80% Return
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3 pl-0 md:pl-2">
                <div class="col-span-2 bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Total Proceed (After Fees)</span>
                    <span id="out-cga-proceed" class="text-xl font-extrabold text-slate-800">$7,490.00</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Total Cost Basis</span>
                    <span id="out-cga-cost" class="text-base md:text-lg font-bold text-slate-800">$5,000.00</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Gross Gain</span>
                    <span id="out-cga-gross" class="text-base md:text-lg font-bold text-slate-800">$2,500.00</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function calcCga() {
    const bPrice = parseFloat(document.getElementById('cga-buy-price').value) || 0;
    const sPrice = parseFloat(document.getElementById('cga-sell-price').value) || 0;
    const shares = parseFloat(document.getElementById('cga-shares').value) || 0;
    const fees = parseFloat(document.getElementById('cga-fees').value) || 0;
    
    if(shares <= 0) return;

    const costBasis = bPrice * shares;
    const proceeds = (sPrice * shares) - fees;
    const grossGain = (sPrice - bPrice) * shares;
    const netGain = proceeds - costBasis;
    
    const roi = costBasis > 0 ? (netGain / costBasis) * 100 : 0;
    const isLoss = netGain < 0;

    const colorClass = isLoss ? 'text-red-600' : 'text-teal-600';
    const bgClass = isLoss ? 'bg-red-50 text-red-700 border-red-100' : 'bg-teal-50 text-teal-700 border-teal-100';

    document.getElementById('out-cga-gain').innerText = (isLoss ? '-' : '') + Math.abs(netGain).toLocaleString('en-US', { style: 'currency', currency: 'USD' });
    document.getElementById('out-cga-gain').className = `text-4xl md:text-5xl font-extrabold tracking-tight m-0 ${colorClass}`;
    
    const roiEl = document.getElementById('out-cga-roi');
    roiEl.innerText = (isLoss ? '' : '+') + roi.toFixed(2) + '% Return';
    roiEl.className = `inline-block mt-3 px-4 py-1.5 rounded-full text-sm font-bold border ${bgClass}`;

    document.getElementById('cga-output-card').className = `bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 transition-colors duration-300 border-t-${isLoss ? 'red' : 'teal'}-500`;

    document.getElementById('out-cga-proceed').innerText = proceeds.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
    document.getElementById('out-cga-cost').innerText = costBasis.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
    document.getElementById('out-cga-gross').innerText = (grossGain < 0 ? '-' : '') + Math.abs(grossGain).toLocaleString('en-US', { style: 'currency', currency: 'USD' });
}

function resetCga() {
    document.getElementById('cga-buy-price').value = 50;
    document.getElementById('cga-sell-price').value = 75;
    document.getElementById('cga-shares').value = 100;
    document.getElementById('cga-fees').value = 10;
    calcCga();
}

['cga-buy-price', 'cga-sell-price', 'cga-shares', 'cga-fees'].forEach(id => {
    document.getElementById(id).addEventListener('input', calcCga);
});

document.addEventListener('DOMContentLoaded', calcCga);
</script>
