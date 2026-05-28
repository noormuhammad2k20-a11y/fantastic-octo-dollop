<div class="max-w-4xl mx-auto space-y-4 font-sans">
    <!-- Input Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-th-large"></i>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 m-0 leading-tight">GCD & LCM Calculator</h1>
                <p class="text-sm text-slate-500 m-0">Find the Greatest Common Divisor and Least Common Multiple instantly.</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">First Number</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-sky-500 transition-colors">
                    <input type="number" id="glc-num1" class="w-full bg-transparent border-none px-4 py-3 text-xl font-bold text-slate-800 focus:outline-none" value="12" step="1" min="1">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Second Number</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-sky-500 transition-colors">
                    <input type="number" id="glc-num2" class="w-full bg-transparent border-none px-4 py-3 text-xl font-bold text-slate-800 focus:outline-none" value="18" step="1" min="1">
                </div>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100 flex gap-2">
            <button type="button" onclick="calcGlc()" class="flex-grow bg-sky-600 hover:bg-sky-700 text-white text-sm font-bold py-2 px-4 rounded-xl transition-colors">
                <i class="fas fa-bolt me-1"></i> Calculate GCD & LCM
            </button>
            <button type="button" onclick="resetGlc()" class="w-12 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold py-2 rounded-xl transition-colors flex items-center justify-center shrink-0">
                <i class="fas fa-redo"></i>
            </button>
        </div>
    </div>

    <!-- Output Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 border-t-sky-500 transition-colors duration-300">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Greatest Common Divisor (GCD)</span>
                <span id="out-glc-gcd" class="text-4xl md:text-5xl font-extrabold text-sky-600">6</span>
            </div>
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Least Common Multiple (LCM)</span>
                <span id="out-glc-lcm" class="text-4xl md:text-5xl font-extrabold text-sky-600">36</span>
            </div>
        </div>
    </div>
</div>

<script>
function gcd(a, b) {
    return b === 0 ? a : gcd(b, a % b);
}

function lcm(a, b, gcdValue) {
    return (a * b) / gcdValue;
}

function calcGlc() {
    let n1 = Math.abs(parseInt(document.getElementById('glc-num1').value));
    let n2 = Math.abs(parseInt(document.getElementById('glc-num2').value));
    
    if (isNaN(n1) || isNaN(n2) || n1 === 0 || n2 === 0) {
        document.getElementById('out-glc-gcd').innerText = 'Err';
        document.getElementById('out-glc-lcm').innerText = 'Err';
        return;
    }
    
    const g = gcd(n1, n2);
    const l = lcm(n1, n2, g);
    
    document.getElementById('out-glc-gcd').innerText = g;
    document.getElementById('out-glc-lcm').innerText = l;
}

function resetGlc() {
    document.getElementById('glc-num1').value = 12;
    document.getElementById('glc-num2').value = 18;
    calcGlc();
}

['glc-num1', 'glc-num2'].forEach(id => {
    document.getElementById(id).addEventListener('input', calcGlc);
});

document.addEventListener('DOMContentLoaded', calcGlc);
</script>
