<div class="max-w-4xl mx-auto space-y-4 font-sans">
    <!-- Input Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-divide"></i>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 m-0 leading-tight">Fraction to Decimal Converter</h1>
                <p class="text-sm text-slate-500 m-0">Convert any fraction to decimal and percentage precisely.</p>
            </div>
        </div>
        <div class="flex items-center justify-center gap-4 py-6">
            <div class="w-32">
                <input type="number" id="fdc-num" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-center text-2xl font-bold text-slate-800 focus:outline-none focus:border-cyan-500 transition-colors" value="3">
            </div>
            <div class="text-3xl font-light text-slate-400">/</div>
            <div class="w-32">
                <input type="number" id="fdc-den" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-center text-2xl font-bold text-slate-800 focus:outline-none focus:border-cyan-500 transition-colors" value="4">
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100 flex gap-2">
            <button type="button" onclick="calcFdc()" class="flex-grow bg-cyan-600 hover:bg-cyan-700 text-white text-sm font-bold py-2 px-4 rounded-xl transition-colors">
                <i class="fas fa-play me-1"></i> Convert
            </button>
            <button type="button" onclick="setFdc(1, 8)" class="flex-grow bg-white border border-slate-200 hover:border-cyan-500 hover:bg-cyan-50 text-slate-600 hover:text-cyan-600 text-sm font-bold py-2 px-3 rounded-xl transition-colors">
                1/8
            </button>
            <button type="button" onclick="setFdc(5, 16)" class="flex-grow bg-white border border-slate-200 hover:border-cyan-500 hover:bg-cyan-50 text-slate-600 hover:text-cyan-600 text-sm font-bold py-2 px-3 rounded-xl transition-colors">
                5/16
            </button>
            <button type="button" onclick="resetFdc()" class="w-12 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold py-2 rounded-xl transition-colors flex items-center justify-center shrink-0">
                <i class="fas fa-redo"></i>
            </button>
        </div>
    </div>

    <!-- Output Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 border-t-cyan-500 transition-colors duration-300">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
            <div class="text-center md:border-r border-gray-100 pb-4 md:pb-0 md:pr-4">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Decimal Equivalent</span>
                <div class="flex items-baseline justify-center gap-1">
                    <h2 id="out-fdc-dec" class="text-4xl md:text-5xl font-extrabold text-cyan-600 tracking-tight m-0">0.75</h2>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-3 pl-0 md:pl-2">
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Percentage Form</span>
                    <span id="out-fdc-pct" class="text-2xl font-extrabold text-slate-800">75%</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function calcFdc() {
    const num = parseFloat(document.getElementById('fdc-num').value);
    const den = parseFloat(document.getElementById('fdc-den').value);
    
    if(!den || den === 0) {
        document.getElementById('out-fdc-dec').innerText = 'Error';
        document.getElementById('out-fdc-pct').innerText = 'Div/0';
        return;
    }

    const dec = num / den;
    let decStr = dec.toString();
    if(decStr.length > 10) decStr = dec.toFixed(6).replace(/\.?0+$/, '');
    
    const pct = dec * 100;
    let pctStr = pct.toString();
    if(pctStr.length > 10) pctStr = pct.toFixed(4).replace(/\.?0+$/, '');

    document.getElementById('out-fdc-dec').innerText = decStr;
    document.getElementById('out-fdc-pct').innerText = pctStr + '%';
}

function setFdc(n, d) {
    document.getElementById('fdc-num').value = n;
    document.getElementById('fdc-den').value = d;
    calcFdc();
}

function resetFdc() {
    setFdc(3, 4);
}

['fdc-num', 'fdc-den'].forEach(id => {
    document.getElementById(id).addEventListener('input', calcFdc);
});

document.addEventListener('DOMContentLoaded', calcFdc);
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\fraction-to-decimal-converter.blade.php ENDPATH**/ ?>