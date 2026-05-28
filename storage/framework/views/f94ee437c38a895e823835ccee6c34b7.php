<div class="max-w-4xl mx-auto space-y-4 font-sans">
    <!-- Input Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-shapes"></i>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 m-0 leading-tight">Trigonometry Calculator</h1>
                <p class="text-sm text-slate-500 m-0">Calculate trigonometric functions instantly.</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Angle Value</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-purple-500 transition-colors">
                    <input type="number" id="tc-angle" class="w-full bg-transparent border-none px-3 py-2 text-slate-800 font-bold focus:outline-none" value="45" step="0.1">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Angle Unit</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-purple-500 transition-colors">
                    <select id="tc-unit" class="w-full bg-transparent border-none px-3 py-2 text-slate-800 font-bold focus:outline-none">
                        <option value="deg" selected>Degrees (°)</option>
                        <option value="rad">Radians (rad)</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100 flex gap-2">
            <button type="button" onclick="calcTc()" class="flex-grow bg-purple-600 hover:bg-purple-700 text-white text-sm font-bold py-2 px-4 rounded-xl transition-colors">
                <i class="fas fa-bolt me-1"></i> Calculate
            </button>
            <button type="button" onclick="resetTc()" class="w-12 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold py-2 rounded-xl transition-colors flex items-center justify-center shrink-0">
                <i class="fas fa-redo"></i>
            </button>
        </div>
    </div>

    <!-- Output Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 border-t-purple-500 transition-colors duration-300">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Sine (sin)</span>
                <span id="out-tc-sin" class="text-xl md:text-2xl font-extrabold text-purple-600">0.7071</span>
            </div>
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Cosine (cos)</span>
                <span id="out-tc-cos" class="text-xl md:text-2xl font-extrabold text-purple-600">0.7071</span>
            </div>
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Tangent (tan)</span>
                <span id="out-tc-tan" class="text-xl md:text-2xl font-extrabold text-purple-600">1.0000</span>
            </div>
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Cosecant (csc)</span>
                <span id="out-tc-csc" class="text-lg font-bold text-slate-800">1.4142</span>
            </div>
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Secant (sec)</span>
                <span id="out-tc-sec" class="text-lg font-bold text-slate-800">1.4142</span>
            </div>
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Cotangent (cot)</span>
                <span id="out-tc-cot" class="text-lg font-bold text-slate-800">1.0000</span>
            </div>
        </div>
    </div>
</div>

<script>
function calcTc() {
    const angle = parseFloat(document.getElementById('tc-angle').value) || 0;
    const isDeg = document.getElementById('tc-unit').value === 'deg';
    
    const rad = isDeg ? angle * (Math.PI / 180) : angle;
    
    const sinVal = Math.sin(rad);
    const cosVal = Math.cos(rad);
    const tanVal = Math.tan(rad);

    const fmt = (v) => {
        if(Math.abs(v) < 1e-10) return "0.0000";
        if(Math.abs(v) > 1e10) return "Undefined";
        return v.toFixed(4);
    };

    document.getElementById('out-tc-sin').innerText = fmt(sinVal);
    document.getElementById('out-tc-cos').innerText = fmt(cosVal);
    document.getElementById('out-tc-tan').innerText = fmt(tanVal);
    
    document.getElementById('out-tc-csc').innerText = fmt(1/sinVal);
    document.getElementById('out-tc-sec').innerText = fmt(1/cosVal);
    document.getElementById('out-tc-cot').innerText = fmt(1/tanVal);
}

function resetTc() {
    document.getElementById('tc-angle').value = 45;
    document.getElementById('tc-unit').value = 'deg';
    calcTc();
}

['tc-angle', 'tc-unit'].forEach(id => {
    document.getElementById(id).addEventListener('input', calcTc);
});

document.addEventListener('DOMContentLoaded', calcTc);
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\trigonometry-calculator.blade.php ENDPATH**/ ?>