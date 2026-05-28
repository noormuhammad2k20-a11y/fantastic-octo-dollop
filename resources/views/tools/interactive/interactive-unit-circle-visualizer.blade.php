<div class="max-w-4xl mx-auto space-y-4 font-sans">
    <!-- Input & Output Container -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 border-t-indigo-500">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-compass"></i>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 m-0 leading-tight">Interactive Unit Circle Visualizer</h1>
                <p class="text-sm text-slate-500 m-0">Adjust the angle to instantly view Sine, Cosine, and Tangent outputs.</p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
            <!-- Interactive SVG Visualizer -->
            <div class="relative w-full max-w-[300px] mx-auto aspect-square bg-slate-50 rounded-full border border-slate-200 shadow-inner flex items-center justify-center">
                <svg id="uc-svg" viewBox="-120 -120 240 240" class="w-full h-full overflow-visible" style="touch-action: none; cursor: pointer;">
                    <!-- Grid & Axes -->
                    <line x1="-110" y1="0" x2="110" y2="0" stroke="#cbd5e1" stroke-width="1.5" />
                    <line x1="0" y1="-110" x2="0" y2="110" stroke="#cbd5e1" stroke-width="1.5" />
                    <circle cx="0" cy="0" r="100" fill="none" stroke="#94a3b8" stroke-width="2" stroke-dasharray="4 4" />
                    
                    <!-- Angle Sector -->
                    <path id="uc-arc" d="M 0 0 L 100 0 A 100 100 0 0 0 86.6 -50 Z" fill="rgba(99, 102, 241, 0.15)" />
                    
                    <!-- Point and Line -->
                    <line id="uc-line" x1="0" y1="0" x2="86.6" y2="-50" stroke="#4f46e5" stroke-width="3" />
                    <circle id="uc-point" cx="86.6" cy="-50" r="6" fill="#ef4444" stroke="#fff" stroke-width="2" />
                    
                    <!-- Sine / Cosine projections -->
                    <line id="uc-sin-line" x1="86.6" y1="-50" x2="86.6" y2="0" stroke="#ef4444" stroke-width="2" stroke-dasharray="3 3" />
                    <line id="uc-cos-line" x1="0" y1="0" x2="86.6" y2="0" stroke="#10b981" stroke-width="2" />
                </svg>
            </div>
            
            <!-- Controls & Data Output -->
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Angle (Degrees)</label>
                    <div class="flex items-center gap-3">
                        <input type="range" id="uc-slider" min="0" max="360" value="30" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-indigo-600">
                        <input type="number" id="uc-deg-input" class="w-20 bg-slate-50 border border-slate-200 rounded-xl px-2 py-1.5 text-center font-bold text-slate-800 focus:outline-none focus:border-indigo-500" value="30">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mt-4">
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 text-center">
                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1 text-red-500">Sine (y)</span>
                        <span id="out-uc-sin" class="text-xl font-extrabold text-slate-800">0.5000</span>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 text-center">
                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1 text-emerald-500">Cosine (x)</span>
                        <span id="out-uc-cos" class="text-xl font-extrabold text-slate-800">0.8660</span>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 text-center">
                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Tangent (y/x)</span>
                        <span id="out-uc-tan" class="text-xl font-extrabold text-slate-800">0.5774</span>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 text-center">
                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Radians</span>
                        <span id="out-uc-rad" class="text-xl font-extrabold text-slate-800">0.5236</span>
                    </div>
                </div>
                
                <div class="flex gap-2 mt-4 pt-4 border-t border-slate-100">
                    <button type="button" onclick="setUcAngle(0)" class="flex-1 bg-white border border-slate-200 hover:border-indigo-500 hover:text-indigo-600 text-slate-600 text-xs font-bold py-2 rounded-lg transition-colors">0°</button>
                    <button type="button" onclick="setUcAngle(90)" class="flex-1 bg-white border border-slate-200 hover:border-indigo-500 hover:text-indigo-600 text-slate-600 text-xs font-bold py-2 rounded-lg transition-colors">90°</button>
                    <button type="button" onclick="setUcAngle(180)" class="flex-1 bg-white border border-slate-200 hover:border-indigo-500 hover:text-indigo-600 text-slate-600 text-xs font-bold py-2 rounded-lg transition-colors">180°</button>
                    <button type="button" onclick="setUcAngle(270)" class="flex-1 bg-white border border-slate-200 hover:border-indigo-500 hover:text-indigo-600 text-slate-600 text-xs font-bold py-2 rounded-lg transition-colors">270°</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateUcVisuals(deg) {
    const rad = deg * (Math.PI / 180);
    const cosVal = Math.cos(rad);
    const sinVal = Math.sin(rad);
    
    const px = cosVal * 100;
    const py = -sinVal * 100; // SVG Y is down, so negate

    document.getElementById('uc-line').setAttribute('x2', px);
    document.getElementById('uc-line').setAttribute('y2', py);
    document.getElementById('uc-point').setAttribute('cx', px);
    document.getElementById('uc-point').setAttribute('cy', py);
    
    document.getElementById('uc-sin-line').setAttribute('x1', px);
    document.getElementById('uc-sin-line').setAttribute('y1', py);
    document.getElementById('uc-sin-line').setAttribute('x2', px);
    document.getElementById('uc-sin-line').setAttribute('y2', 0);
    
    document.getElementById('uc-cos-line').setAttribute('x2', px);

    // Arc
    const largeArc = deg > 180 ? 1 : 0;
    document.getElementById('uc-arc').setAttribute('d', `M 0 0 L 100 0 A 100 100 0 ${largeArc} 0 ${px} ${py} Z`);

    // Output Data
    document.getElementById('out-uc-sin').innerText = Math.abs(sinVal) < 1e-10 ? "0.0000" : sinVal.toFixed(4);
    document.getElementById('out-uc-cos').innerText = Math.abs(cosVal) < 1e-10 ? "0.0000" : cosVal.toFixed(4);
    
    if(Math.abs(cosVal) < 1e-10) {
        document.getElementById('out-uc-tan').innerText = "Undefined";
    } else {
        const tanVal = Math.tan(rad);
        document.getElementById('out-uc-tan').innerText = Math.abs(tanVal) > 1e10 ? "Undefined" : tanVal.toFixed(4);
    }
    
    document.getElementById('out-uc-rad').innerText = rad.toFixed(4);
}

function handleAngleInput(val) {
    let deg = parseFloat(val) || 0;
    deg = deg % 360;
    if (deg < 0) deg += 360;
    document.getElementById('uc-slider').value = deg;
    document.getElementById('uc-deg-input').value = Math.round(deg * 10) / 10;
    updateUcVisuals(deg);
}

function setUcAngle(deg) {
    handleAngleInput(deg);
}

document.getElementById('uc-slider').addEventListener('input', function() {
    handleAngleInput(this.value);
});
document.getElementById('uc-deg-input').addEventListener('input', function() {
    handleAngleInput(this.value);
});

// Interactive SVG clicking
document.getElementById('uc-svg').addEventListener('mousedown', function(e) {
    const updateFromMouse = (event) => {
        const pt = this.createSVGPoint();
        pt.x = event.clientX;
        pt.y = event.clientY;
        const loc = pt.matrixTransform(this.getScreenCTM().inverse());
        let deg = Math.atan2(-loc.y, loc.x) * (180 / Math.PI);
        if (deg < 0) deg += 360;
        handleAngleInput(deg);
    };
    updateFromMouse(e);
    const moveHandler = (evt) => updateFromMouse(evt);
    const upHandler = () => {
        document.removeEventListener('mousemove', moveHandler);
        document.removeEventListener('mouseup', upHandler);
    };
    document.addEventListener('mousemove', moveHandler);
    document.addEventListener('mouseup', upHandler);
});

document.addEventListener('DOMContentLoaded', () => handleAngleInput(30));
</script>
