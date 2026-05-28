<div class="max-w-4xl mx-auto space-y-4 font-sans">
    <!-- Input Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-project-diagram"></i>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 m-0 leading-tight">Coordinate Geometry Calculator</h1>
                <p class="text-sm text-slate-500 m-0">Calculate distance, midpoint, and slope between any two points (X₁,Y₁) and (X₂,Y₂).</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Point 1 -->
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                <span class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-3">Point 1</span>
                <div class="flex items-center gap-3">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-slate-500 mb-1">X₁</label>
                        <input type="number" id="cgc-x1" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-center text-lg font-bold text-slate-800 focus:outline-none focus:border-violet-500" value="0">
                    </div>
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-slate-500 mb-1">Y₁</label>
                        <input type="number" id="cgc-y1" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-center text-lg font-bold text-slate-800 focus:outline-none focus:border-violet-500" value="0">
                    </div>
                </div>
            </div>
            <!-- Point 2 -->
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                <span class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-3">Point 2</span>
                <div class="flex items-center gap-3">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-slate-500 mb-1">X₂</label>
                        <input type="number" id="cgc-x2" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-center text-lg font-bold text-slate-800 focus:outline-none focus:border-violet-500" value="3">
                    </div>
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-slate-500 mb-1">Y₂</label>
                        <input type="number" id="cgc-y2" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-center text-lg font-bold text-slate-800 focus:outline-none focus:border-violet-500" value="4">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100 flex gap-2">
            <button type="button" onclick="calcCgc()" class="flex-grow bg-violet-600 hover:bg-violet-700 text-white text-sm font-bold py-2 px-4 rounded-xl transition-colors">
                <i class="fas fa-play me-1"></i> Analyze Points
            </button>
            <button type="button" onclick="resetCgc()" class="w-12 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold py-2 rounded-xl transition-colors flex items-center justify-center shrink-0">
                <i class="fas fa-redo"></i>
            </button>
        </div>
    </div>

    <!-- Output Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 border-t-violet-500 transition-colors duration-300">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Distance</span>
                <span id="out-cgc-dist" class="text-3xl font-extrabold text-violet-600">5.00</span>
            </div>
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Midpoint</span>
                <span id="out-cgc-mid" class="text-3xl font-extrabold text-violet-600">(1.5, 2.0)</span>
            </div>
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Slope (m)</span>
                <span id="out-cgc-slope" class="text-3xl font-extrabold text-violet-600">1.33</span>
            </div>
        </div>
    </div>
</div>

<script>
function calcCgc() {
    const x1 = parseFloat(document.getElementById('cgc-x1').value) || 0;
    const y1 = parseFloat(document.getElementById('cgc-y1').value) || 0;
    const x2 = parseFloat(document.getElementById('cgc-x2').value) || 0;
    const y2 = parseFloat(document.getElementById('cgc-y2').value) || 0;

    const dx = x2 - x1;
    const dy = y2 - y1;
    
    // Distance
    const dist = Math.sqrt((dx * dx) + (dy * dy));
    document.getElementById('out-cgc-dist').innerText = dist.toFixed(4).replace(/\.?0+$/, '');
    
    // Midpoint
    const midX = (x1 + x2) / 2;
    const midY = (y1 + y2) / 2;
    document.getElementById('out-cgc-mid').innerText = `(${midX.toFixed(2).replace(/\.?0+$/, '')}, ${midY.toFixed(2).replace(/\.?0+$/, '')})`;
    
    // Slope
    let slopeStr = 'Undefined';
    if(dx !== 0) {
        slopeStr = (dy / dx).toFixed(4).replace(/\.?0+$/, '');
    }
    document.getElementById('out-cgc-slope').innerText = slopeStr;
}

function resetCgc() {
    document.getElementById('cgc-x1').value = 0;
    document.getElementById('cgc-y1').value = 0;
    document.getElementById('cgc-x2').value = 3;
    document.getElementById('cgc-y2').value = 4;
    calcCgc();
}

['cgc-x1', 'cgc-y1', 'cgc-x2', 'cgc-y2'].forEach(id => {
    document.getElementById(id).addEventListener('input', calcCgc);
});

document.addEventListener('DOMContentLoaded', calcCgc);
</script>
