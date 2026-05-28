<div class="max-w-4xl mx-auto space-y-4 font-sans">
    <!-- Input Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-xl bg-fuchsia-50 text-fuchsia-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-square-root-alt"></i>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 m-0 leading-tight">Quadratic Formula Calculator</h1>
                <p class="text-sm text-slate-500 m-0">Solve for the roots of any quadratic equation ax² + bx + c = 0.</p>
            </div>
        </div>
        <div class="flex items-center justify-center gap-3 py-4 md:py-6 flex-wrap">
            <div class="w-24">
                <input type="number" id="qfc-a" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-center text-xl font-bold text-slate-800 focus:outline-none focus:border-fuchsia-500 transition-colors" value="1">
            </div>
            <div class="text-xl font-bold text-slate-600">x² +</div>
            <div class="w-24">
                <input type="number" id="qfc-b" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-center text-xl font-bold text-slate-800 focus:outline-none focus:border-fuchsia-500 transition-colors" value="-3">
            </div>
            <div class="text-xl font-bold text-slate-600">x +</div>
            <div class="w-24">
                <input type="number" id="qfc-c" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-center text-xl font-bold text-slate-800 focus:outline-none focus:border-fuchsia-500 transition-colors" value="2">
            </div>
            <div class="text-xl font-bold text-slate-600">= 0</div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100 flex gap-2">
            <button type="button" onclick="calcQfc()" class="flex-grow bg-fuchsia-600 hover:bg-fuchsia-700 text-white text-sm font-bold py-2 px-4 rounded-xl transition-colors">
                <i class="fas fa-play me-1"></i> Calculate Roots
            </button>
            <button type="button" onclick="resetQfc()" class="w-12 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold py-2 rounded-xl transition-colors flex items-center justify-center shrink-0">
                <i class="fas fa-redo"></i>
            </button>
        </div>
    </div>

    <!-- Output Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 border-t-fuchsia-500 transition-colors duration-300">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Root 1 (x₁)</span>
                <span id="out-qfc-x1" class="text-2xl md:text-3xl font-extrabold text-fuchsia-600">2</span>
            </div>
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Root 2 (x₂)</span>
                <span id="out-qfc-x2" class="text-2xl md:text-3xl font-extrabold text-fuchsia-600">1</span>
            </div>
            <div class="col-span-1 md:col-span-2 text-center mt-2">
                <span id="out-qfc-type" class="inline-block px-4 py-1.5 rounded-full text-sm font-bold bg-fuchsia-50 text-fuchsia-700 border border-fuchsia-100">
                    Two Distinct Real Roots
                </span>
            </div>
        </div>
    </div>
</div>

<script>
function calcQfc() {
    const a = parseFloat(document.getElementById('qfc-a').value);
    const b = parseFloat(document.getElementById('qfc-b').value) || 0;
    const c = parseFloat(document.getElementById('qfc-c').value) || 0;
    
    if(!a || a === 0) {
        document.getElementById('out-qfc-x1').innerText = 'NaN';
        document.getElementById('out-qfc-x2').innerText = 'NaN';
        document.getElementById('out-qfc-type').innerText = "Not a quadratic equation (a cannot be 0)";
        return;
    }

    const discriminant = (b * b) - (4 * a * c);
    let x1, x2, type;

    if (discriminant > 0) {
        const root = Math.sqrt(discriminant);
        x1 = ((-b + root) / (2 * a)).toFixed(4).replace(/\.?0+$/, '');
        x2 = ((-b - root) / (2 * a)).toFixed(4).replace(/\.?0+$/, '');
        type = "Two Distinct Real Roots";
    } else if (discriminant === 0) {
        x1 = (-b / (2 * a)).toFixed(4).replace(/\.?0+$/, '');
        x2 = x1;
        type = "One Real Root (Repeated)";
    } else {
        const real = (-b / (2 * a)).toFixed(4).replace(/\.?0+$/, '');
        const imag = (Math.sqrt(Math.abs(discriminant)) / (2 * a)).toFixed(4).replace(/\.?0+$/, '');
        const rPart = real === "0" ? "" : real;
        x1 = `${rPart} + ${imag}i`;
        x2 = `${rPart} - ${imag}i`;
        type = "Two Complex Roots";
    }

    document.getElementById('out-qfc-x1').innerText = x1;
    document.getElementById('out-qfc-x2').innerText = x2;
    document.getElementById('out-qfc-type').innerText = type;
}

function resetQfc() {
    document.getElementById('qfc-a').value = 1;
    document.getElementById('qfc-b').value = -3;
    document.getElementById('qfc-c').value = 2;
    calcQfc();
}

['qfc-a', 'qfc-b', 'qfc-c'].forEach(id => {
    document.getElementById(id).addEventListener('input', calcQfc);
});

document.addEventListener('DOMContentLoaded', calcQfc);
</script>
