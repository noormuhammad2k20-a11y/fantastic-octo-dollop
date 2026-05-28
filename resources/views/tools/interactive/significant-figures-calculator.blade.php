<div class="max-w-4xl mx-auto space-y-4 font-sans">
    <!-- Input Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-microscope"></i>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 m-0 leading-tight">Significant Figures Calculator</h1>
                <p class="text-sm text-slate-500 m-0">Determine the number of significant digits in any given number.</p>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Enter Number</label>
            <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-orange-500 transition-colors">
                <input type="text" id="sfc-input" class="w-full bg-transparent border-none px-4 py-3 text-2xl font-bold text-slate-800 focus:outline-none" value="0.004050" placeholder="e.g. 0.004050">
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100 flex gap-2">
            <button type="button" onclick="calcSfc()" class="flex-grow bg-orange-600 hover:bg-orange-700 text-white text-sm font-bold py-2 px-4 rounded-xl transition-colors">
                <i class="fas fa-bolt me-1"></i> Count Sig Figs
            </button>
            <button type="button" onclick="resetSfc()" class="w-12 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold py-2 rounded-xl transition-colors flex items-center justify-center shrink-0">
                <i class="fas fa-redo"></i>
            </button>
        </div>
    </div>

    <!-- Output Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 border-t-orange-500 transition-colors duration-300">
        <div class="grid grid-cols-1 gap-4 text-center">
            <div class="pb-4">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Significant Figures Count</span>
                <div class="flex items-baseline justify-center gap-1 mt-2">
                    <h2 id="out-sfc-count" class="text-5xl md:text-6xl font-extrabold text-orange-600 tracking-tight m-0">4</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function countSigFigs(str) {
    str = str.trim().toLowerCase();
    if(str === '') return 0;
    if(str.includes('e')) {
        str = str.split('e')[0];
    }
    str = str.replace(/^-/, '');
    
    if(!str.includes('.')) {
        str = str.replace(/^0+/, '');
        return str.replace(/0+$/, '').length; 
    } else {
        str = str.replace(/^0+/, '');
        if(str.startsWith('.')) {
            str = str.substring(1).replace(/^0+/, '');
        } else {
            str = str.replace('.', '');
        }
        return str.length;
    }
}

function calcSfc() {
    const input = document.getElementById('sfc-input').value;
    const count = countSigFigs(input);
    document.getElementById('out-sfc-count').innerText = count === 0 ? '0' : count;
}

function resetSfc() {
    document.getElementById('sfc-input').value = '0.004050';
    calcSfc();
}

document.getElementById('sfc-input').addEventListener('input', calcSfc);
document.addEventListener('DOMContentLoaded', calcSfc);
</script>