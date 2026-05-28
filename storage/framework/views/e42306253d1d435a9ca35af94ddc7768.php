<div class="max-w-4xl mx-auto space-y-4 font-sans">
    <!-- Input Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 m-0 leading-tight">Investment Tax Calculator</h1>
                <p class="text-sm text-slate-500 m-0">Estimate your capital gains taxes based on holding period and tax bracket.</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Purchase Price ($)</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-rose-500 transition-colors">
                    <span class="flex items-center px-3 bg-slate-100 text-slate-500 text-sm font-bold border-r border-slate-200"><i class="fas fa-dollar-sign"></i></span>
                    <input type="number" id="itax-purchase" class="w-full bg-transparent border-none px-3 py-2 text-slate-800 font-bold focus:outline-none" value="10000" step="100">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Sale Price ($)</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-rose-500 transition-colors">
                    <span class="flex items-center px-3 bg-slate-100 text-slate-500 text-sm font-bold border-r border-slate-200"><i class="fas fa-dollar-sign"></i></span>
                    <input type="number" id="itax-sale" class="w-full bg-transparent border-none px-3 py-2 text-slate-800 font-bold focus:outline-none" value="15000" step="100">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Holding Period</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-rose-500 transition-colors">
                    <select id="itax-period" class="w-full bg-transparent border-none px-3 py-2 text-slate-800 font-bold focus:outline-none">
                        <option value="short">Short-Term (< 1 Year)</option>
                        <option value="long" selected>Long-Term (> 1 Year)</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Tax Bracket / Rate (%)</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-rose-500 transition-colors">
                    <input type="number" id="itax-rate" class="w-full bg-transparent border-none px-3 py-2 text-slate-800 font-bold focus:outline-none" value="15" step="1">
                    <span class="flex items-center px-3 bg-slate-100 text-slate-500 text-sm font-bold border-l border-slate-200">%</span>
                </div>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100 flex flex-wrap gap-2">
            <button type="button" onclick="calcItax()" class="flex-grow bg-rose-600 hover:bg-rose-700 text-white text-sm font-bold py-2 px-4 rounded-xl transition-colors min-w-[140px]">
                <i class="fas fa-bolt me-1"></i> Calculate Tax
            </button>
            <button type="button" onclick="resetItax()" class="w-12 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold py-2 rounded-xl transition-colors flex items-center justify-center shrink-0">
                <i class="fas fa-redo"></i>
            </button>
        </div>
    </div>

    <!-- Output Card -->
    <div id="itax-output-card" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 border-t-rose-500 transition-colors duration-300">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
            <div class="text-center md:border-r border-gray-100 pb-4 md:pb-0 md:pr-4">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Estimated Tax Owed</span>
                <div class="flex items-baseline justify-center gap-1">
                    <h2 id="out-itax-owed" class="text-4xl md:text-5xl font-extrabold text-rose-600 tracking-tight m-0">$750.00</h2>
                </div>
                <div id="out-itax-type" class="inline-block mt-3 px-4 py-1.5 rounded-full text-sm font-bold bg-rose-50 text-rose-700 border border-rose-100">
                    Long-Term Capital Gains
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3 pl-0 md:pl-2">
                <div class="col-span-2 bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Net Gain (After Tax)</span>
                    <span id="out-itax-net" class="text-xl font-extrabold text-slate-800">$4,250.00</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Total Gross Gain</span>
                    <span id="out-itax-gross" class="text-base md:text-lg font-bold text-slate-800">$5,000.00</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Effective Tax Rate</span>
                    <span id="out-itax-eff" class="text-base md:text-lg font-bold text-slate-800">15.00%</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function calcItax() {
    const buy = parseFloat(document.getElementById('itax-purchase').value) || 0;
    const sell = parseFloat(document.getElementById('itax-sale').value) || 0;
    const rate = parseFloat(document.getElementById('itax-rate').value) || 0;
    const period = document.getElementById('itax-period').value;
    
    if(buy <= 0) return;

    const grossGain = sell - buy;
    const isLoss = grossGain < 0;
    
    let taxOwed = 0;
    let netGain = grossGain;

    if(!isLoss) {
        taxOwed = grossGain * (rate / 100);
        netGain = grossGain - taxOwed;
    }

    const colorClass = isLoss ? 'text-emerald-600' : 'text-rose-600';
    const bgClass = isLoss ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-rose-50 text-rose-700 border-rose-100';

    document.getElementById('out-itax-owed').innerText = taxOwed.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
    document.getElementById('out-itax-owed').className = `text-4xl md:text-5xl font-extrabold tracking-tight m-0 ${isLoss ? 'text-slate-400' : colorClass}`;
    
    document.getElementById('out-itax-type').innerText = isLoss ? 'Capital Loss' : (period === 'long' ? 'Long-Term Capital Gains' : 'Short-Term Capital Gains');
    document.getElementById('out-itax-type').className = `inline-block mt-3 px-4 py-1.5 rounded-full text-sm font-bold border ${isLoss ? 'bg-slate-100 text-slate-600 border-slate-200' : bgClass}`;

    document.getElementById('out-itax-net').innerText = netGain.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
    document.getElementById('out-itax-net').className = `text-xl font-extrabold ${isLoss ? 'text-red-600' : 'text-slate-800'}`;

    document.getElementById('out-itax-gross').innerText = grossGain.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
    document.getElementById('out-itax-eff').innerText = rate.toFixed(2) + '%';
}

function resetItax() {
    document.getElementById('itax-purchase').value = 10000;
    document.getElementById('itax-sale').value = 15000;
    document.getElementById('itax-period').value = 'long';
    document.getElementById('itax-rate').value = 15;
    calcItax();
}

['itax-purchase', 'itax-sale', 'itax-period', 'itax-rate'].forEach(id => {
    document.getElementById(id).addEventListener('input', calcItax);
});

document.addEventListener('DOMContentLoaded', calcItax);
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\investment-tax-calculator.blade.php ENDPATH**/ ?>