<div class="max-w-4xl mx-auto space-y-4 font-sans">
    <!-- Input Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-atom"></i>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 m-0 leading-tight">Scientific Notation Calculator</h1>
                <p class="text-sm text-slate-500 m-0">Convert numbers into scientific and engineering notation instantly.</p>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Enter Value</label>
            <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-pink-500 transition-colors">
                <input type="number" id="snc-input" class="w-full bg-transparent border-none px-4 py-3 text-2xl font-bold text-slate-800 focus:outline-none" value="145000000">
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100 flex gap-2">
            <button type="button" onclick="calcSnc()" class="flex-grow bg-pink-600 hover:bg-pink-700 text-white text-sm font-bold py-2 px-4 rounded-xl transition-colors">
                <i class="fas fa-play me-1"></i> Convert Format
            </button>
            <button type="button" onclick="resetSnc()" class="w-12 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold py-2 rounded-xl transition-colors flex items-center justify-center shrink-0">
                <i class="fas fa-redo"></i>
            </button>
        </div>
    </div>

    <!-- Output Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 border-t-pink-500 transition-colors duration-300">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Scientific Notation</span>
                <span id="out-snc-sci" class="text-2xl md:text-3xl font-extrabold text-pink-600">1.45 × 10⁸</span>
            </div>
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Engineering Notation</span>
                <span id="out-snc-eng" class="text-2xl md:text-3xl font-extrabold text-slate-800">145 × 10⁶</span>
            </div>
            <div class="col-span-1 md:col-span-2 bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">E-Notation Form</span>
                <span id="out-snc-e" class="text-xl font-bold text-slate-800">1.45e+8</span>
            </div>
        </div>
    </div>
</div>

<script>
function toSuperscript(numStr) {
    const chars = {'0':'⁰','1':'¹','2':'²','3':'³','4':'⁴','5':'⁵','6':'⁶','7':'⁷','8':'⁸','9':'⁹','-':'⁻'};
    return numStr.split('').map(c => chars[c] || c).join('');
}

function calcSnc() {
    const val = parseFloat(document.getElementById('snc-input').value);
    if(isNaN(val)) return;

    if(val === 0) {
        document.getElementById('out-snc-sci').innerText = '0 × 10⁰';
        document.getElementById('out-snc-eng').innerText = '0 × 10⁰';
        document.getElementById('out-snc-e').innerText = '0e+0';
        return;
    }

    const sciStr = val.toExponential();
    const [sciCoef, sciExp] = sciStr.split('e');
    const expNum = parseInt(sciExp);
    
    // Scientific
    document.getElementById('out-snc-sci').innerText = `${parseFloat(sciCoef)} × 10${toSuperscript(expNum.toString())}`;
    
    // Engineering
    let engExp = Math.floor(expNum / 3) * 3;
    let engCoef = val / Math.pow(10, engExp);
    document.getElementById('out-snc-eng').innerText = `${parseFloat(engCoef.toFixed(4))} × 10${toSuperscript(engExp.toString())}`;

    // E-notation
    document.getElementById('out-snc-e').innerText = sciStr;
}

function resetSnc() {
    document.getElementById('snc-input').value = 145000000;
    calcSnc();
}

document.getElementById('snc-input').addEventListener('input', calcSnc);
document.addEventListener('DOMContentLoaded', calcSnc);
</script>