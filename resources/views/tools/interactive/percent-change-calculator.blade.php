<div class="max-w-4xl mx-auto space-y-4 font-sans">
    <!-- Input Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-xl bg-lime-50 text-lime-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-percentage"></i>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 m-0 leading-tight">Percent Change Calculator</h1>
                <p class="text-sm text-slate-500 m-0">Calculate the exact percentage increase or decrease between two values.</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Initial Value</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-lime-500 transition-colors">
                    <input type="number" id="pcc-init" class="w-full bg-transparent border-none px-4 py-3 text-xl font-bold text-slate-800 focus:outline-none" value="150">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Final Value</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-lime-500 transition-colors">
                    <input type="number" id="pcc-final" class="w-full bg-transparent border-none px-4 py-3 text-xl font-bold text-slate-800 focus:outline-none" value="210">
                </div>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100 flex gap-2">
            <button type="button" onclick="calcPcc()" class="flex-grow bg-lime-600 hover:bg-lime-700 text-white text-sm font-bold py-2 px-4 rounded-xl transition-colors">
                <i class="fas fa-play me-1"></i> Calculate
            </button>
            <button type="button" onclick="resetPcc()" class="w-12 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold py-2 rounded-xl transition-colors flex items-center justify-center shrink-0">
                <i class="fas fa-redo"></i>
            </button>
        </div>
    </div>

    <!-- Output Card -->
    <div id="pcc-output-card" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 border-t-lime-500 transition-colors duration-300">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
            <div class="text-center md:border-r border-gray-100 pb-4 md:pb-0 md:pr-4">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Percent Change</span>
                <div class="flex items-baseline justify-center gap-1">
                    <h2 id="out-pcc-pct" class="text-4xl md:text-5xl font-extrabold text-lime-600 tracking-tight m-0">+40.00</h2>
                    <span id="out-pcc-unit" class="text-xl font-bold text-lime-600">%</span>
                </div>
                <div id="out-pcc-type" class="inline-block mt-3 px-4 py-1.5 rounded-full text-sm font-bold bg-lime-50 text-lime-700 border border-lime-100">
                    Increase
                </div>
            </div>
            <div class="grid grid-cols-1 gap-3 pl-0 md:pl-2">
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Absolute Difference</span>
                    <span id="out-pcc-diff" class="text-2xl font-extrabold text-slate-800">60.00</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function calcPcc() {
    const i = parseFloat(document.getElementById('pcc-init').value);
    const f = parseFloat(document.getElementById('pcc-final').value);
    
    if(isNaN(i) || isNaN(f)) return;
    if(i === 0) {
        document.getElementById('out-pcc-pct').innerText = '∞';
        document.getElementById('out-pcc-diff').innerText = Math.abs(f).toString();
        return;
    }

    const diff = f - i;
    const pct = (diff / Math.abs(i)) * 100;
    const isInc = diff > 0;
    const isDec = diff < 0;

    const colorClass = isDec ? 'text-red-600' : (isInc ? 'text-lime-600' : 'text-slate-600');
    const bgClass = isDec ? 'bg-red-50 text-red-700 border-red-100' : (isInc ? 'bg-lime-50 text-lime-700 border-lime-100' : 'bg-slate-100 text-slate-600 border-slate-200');
    
    document.getElementById('out-pcc-pct').innerText = (isInc ? '+' : '') + pct.toFixed(2);
    document.getElementById('out-pcc-pct').className = `text-4xl md:text-5xl font-extrabold tracking-tight m-0 ${colorClass}`;
    document.getElementById('out-pcc-unit').className = `text-xl font-bold ${colorClass}`;
    
    document.getElementById('out-pcc-type').innerText = isDec ? 'Decrease' : (isInc ? 'Increase' : 'No Change');
    document.getElementById('out-pcc-type').className = `inline-block mt-3 px-4 py-1.5 rounded-full text-sm font-bold border ${bgClass}`;

    document.getElementById('pcc-output-card').className = `bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 transition-colors duration-300 border-t-${isDec ? 'red' : (isInc ? 'lime' : 'slate')}-500`;

    document.getElementById('out-pcc-diff').innerText = Math.abs(diff).toLocaleString(undefined, { maximumFractionDigits: 4 });
}

function resetPcc() {
    document.getElementById('pcc-init').value = 150;
    document.getElementById('pcc-final').value = 210;
    calcPcc();
}

['pcc-init', 'pcc-final'].forEach(id => {
    document.getElementById(id).addEventListener('input', calcPcc);
});

document.addEventListener('DOMContentLoaded', calcPcc);
</script>
