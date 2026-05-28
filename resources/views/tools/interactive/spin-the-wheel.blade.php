<div class="row g-4 wheel-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-4">
                    <!-- Input Section -->
                    <div class="col-md-5">
                        <label class="form-label-custom">Wheel Choices (One per line)</label>
                        <textarea id="wheel-input" class="form-control mb-3 custom-scrollbar" rows="12" placeholder="Pizza&#10;Burger&#10;Sushi&#10;Tacos">Pizza
Burger
Sushi
Tacos
Salad
Pasta</textarea>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span class="small text-muted fw-bold" id="wheel-count">6 Choices</span>
                            <button class="btn btn-sm btn-outline-secondary py-0" id="wheel-clear">Clear</button>
                        </div>
                        
                        <div class="text-center">
                            <button class="btn d-block mx-auto btn-primary py-3 px-5 fw-bold rounded-pill shadow-sm" id="wheel-update" style="background:#ec4899; border:none; min-width: 250px;">
                                <i class="fas fa-sync-alt me-2"></i>Update Wheel
                            </button>
                        </div>
                    </div>

                    <!-- Wheel Section -->
                    <div class="col-md-7 d-flex flex-column align-items-center justify-content-center">
                        <div class="wheel-container position-relative mb-4">
                            <!-- Pointer -->
                            <div class="wheel-pointer"></div>
                            
                            <!-- The Wheel -->
                            <div class="wheel" id="wheel-element">
                                <div class="wheel-inner" id="wheel-inner"></div>
                            </div>
                            
                            <!-- Spin Button Center -->
                            <button class="wheel-spin-btn fw-black fs-4 text-white" id="wheel-spin-btn">SPIN</button>
                        </div>

                        <!-- Result Display -->
                        <div class="alert alert-success d-none w-100 text-center animate__animated animate__tada" id="wheel-result-alert" style="border-radius: 12px; border: 2px solid #a7f3d0; background: #ecfdf5;">
                            <h5 class="mb-1 text-success fw-bold">The Winner Is:</h5>
                            <h2 class="mb-0 fw-black text-dark" id="wheel-result-text">---</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.wheel-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.wheel-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.wheel-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.wheel-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.wheel-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.wheel-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;}

.custom-scrollbar::-webkit-scrollbar { width: 8px; }
.custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 4px; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }

/* Wheel CSS */
.wheel-container {
    width: 320px;
    height: 320px;
    margin: 0 auto;
}
.wheel {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 8px solid #334155;
    position: relative;
    overflow: hidden;
    transition: transform 4s cubic-bezier(0.17, 0.67, 0.12, 0.99); /* Smooth spin ease-out */
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
.wheel-inner {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    position: absolute;
    top: 0; left: 0;
    /* Conic gradient applied via JS */
}
.wheel-pointer {
    position: absolute;
    top: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 0; 
    height: 0; 
    border-left: 20px solid transparent;
    border-right: 20px solid transparent;
    border-top: 35px solid #ef4444; /* Red pointer */
    z-index: 10;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
}
.wheel-spin-btn {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #ec4899;
    border: 4px solid #fff;
    z-index: 5;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    transition: transform 0.1s;
}
.wheel-spin-btn:active {
    transform: translate(-50%, -50%) scale(0.95);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    // Vibrant color palette
    const colors = ['#f43f5e', '#f97316', '#eab308', '#22c55e', '#0ea5e9', '#8b5cf6', '#ec4899', '#14b8a6', '#64748b'];
    
    let choices = [];
    let currentDeg = 0;
    let isSpinning = false;

    function drawWheel() {
        const text = $('wheel-input').value;
        choices = text.split('\n').map(l => l.trim()).filter(l => l.length > 0);
        
        if (choices.length === 0) {
            choices = ['Add', 'Some', 'Choices'];
        }

        $('wheel-count').textContent = `${choices.length} Choices`;
        
        const sliceDeg = 360 / choices.length;
        let gradientStr = 'conic-gradient(';
        
        choices.forEach((c, i) => {
            const color = colors[i % colors.length];
            const startAngle = i * sliceDeg;
            const endAngle = startAngle + sliceDeg;
            gradientStr += `${color} ${startAngle}deg ${endAngle}deg${i === choices.length - 1 ? '' : ','}`;
        });
        gradientStr += ')';

        $('wheel-inner').style.background = gradientStr;
        
        // Add text labels if possible? Complex in pure CSS conic-gradient.
        // We will just use colors for now, and display the result clearly.
        // For a full production canvas wheel we'd use Canvas API, but this pure CSS is extremely fast and lightweight.
        
        $('wheel-result-alert').classList.add('d-none');
        $('wheel-result-alert').classList.remove('animate__tada');
    }

    $('wheel-update').addEventListener('click', drawWheel);
    
    $('wheel-input').addEventListener('input', function() {
        const c = this.value.split('\n').filter(l => l.trim().length > 0).length;
        $('wheel-count').textContent = `${c} Choices`;
    });

    $('wheel-clear').addEventListener('click', function() {
        $('wheel-input').value = '';
        drawWheel();
    });

    $('wheel-spin-btn').addEventListener('click', function() {
        if (isSpinning || choices.length === 0) return;
        isSpinning = true;
        
        $('wheel-result-alert').classList.add('d-none');
        $('wheel-result-alert').classList.remove('animate__tada');

        // Calculate random spin
        const spinSpins = 5 + Math.floor(Math.random() * 5); // 5 to 10 full rotations
        const extraDeg = Math.floor(Math.random() * 360);
        
        currentDeg += (spinSpins * 360) + extraDeg;
        
        $('wheel-element').style.transform = `rotate(${currentDeg}deg)`;

        // Calculate winner
        // The pointer is at 0 degrees (top).
        // Since wheel rotates clockwise, the slice at the top is (360 - (currentDeg % 360))
        setTimeout(() => {
            const actualDeg = currentDeg % 360;
            // The top is pointer. Pointer is at 0/360.
            // If wheel rotates actualDeg, the point at the top was originally at 360 - actualDeg
            let pointerOriginalDeg = 360 - actualDeg;
            if (pointerOriginalDeg === 360) pointerOriginalDeg = 0;
            
            const sliceDeg = 360 / choices.length;
            const winnerIdx = Math.floor(pointerOriginalDeg / sliceDeg);
            
            const winner = choices[winnerIdx];
            
            $('wheel-result-text').textContent = winner;
            $('wheel-result-alert').classList.remove('d-none');
            $('wheel-result-alert').classList.add('animate__tada');
            
            isSpinning = false;
        }, 4000); // Matches transition duration
    });

    // Init
    drawWheel();
});
</script>

