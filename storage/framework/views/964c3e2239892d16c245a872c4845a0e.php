<div class="row g-4 chord-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Generator Mode</label>
                        <select id="chord-mode" class="form-select form-select-lg">
                            <option value="single">Single Random Chord</option>
                            <option value="progression" selected>Chord Progression (4 Chords)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Complexity</label>
                        <select id="chord-complexity" class="form-select form-select-lg">
                            <option value="basic" selected>Basic (Maj, Min)</option>
                            <option value="intermediate">Intermediate (7ths, Sus)</option>
                            <option value="advanced">Advanced (9ths, Dim, Aug)</option>
                        </select>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-primary fw-bold fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="chord-generate" style="min-width: 280px; max-width: 100%; background:#6366f1; border:none;">
                    <i class="fas fa-music me-2"></i>Generate Chords
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none text-center" id="chord-output-card" style="--tool-hue:230;--tool-color:#4f46e5;--tool-bg:rgba(99,102,241,.04); border-color:#c7d2fe;">
            <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                <i class="fas fa-headphones text-primary fs-4"></i>
                <h5 class="fw-bold mb-0 text-dark">Your Generated Chords</h5>
            </div>
            <p class="text-muted small mb-4">Grab your instrument and try playing this!</p>

            <div id="chord-display" class="d-flex flex-wrap justify-content-center gap-3">
                <!-- Chords injected here -->
            </div>
        </div>
    </div>
</div>

<style>
.chord-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.chord-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.chord-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.chord-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.chord-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.chord-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.4rem;}

.chord-box {
    background: #fff;
    border: 2px solid #e0e7ff;
    border-radius: 16px;
    min-width: 120px;
    height: 120px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    transition: transform 0.2s;
}
.chord-box:hover {
    transform: translateY(-3px);
    border-color: #6366f1;
}
.chord-root {
    font-size: 2.5rem;
    font-weight: 900;
    color: #312e81;
    line-height: 1;
}
.chord-type {
    font-size: 1rem;
    font-weight: 700;
    color: #6366f1;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const roots = ['C', 'C#', 'D', 'Eb', 'E', 'F', 'F#', 'G', 'Ab', 'A', 'Bb', 'B'];
    
    const types = {
        basic: ['', 'm'],
        intermediate: ['', 'm', 'maj7', 'm7', '7', 'sus4', 'sus2'],
        advanced: ['', 'm', 'maj7', 'm7', '7', 'dim', 'aug', '9', 'm9', 'maj9']
    };

    function getRandomChord(complexity) {
        const root = roots[Math.floor(Math.random() * roots.length)];
        const typeList = types[complexity];
        const type = typeList[Math.floor(Math.random() * typeList.length)];
        return { r: root, t: type };
    }

    $('chord-generate').addEventListener('click', function() {
        const mode = $('chord-mode').value;
        const comp = $('chord-complexity').value;
        
        const count = mode === 'single' ? 1 : 4;
        const chords = [];

        for (let i = 0; i < count; i++) {
            chords.push(getRandomChord(comp));
        }

        const container = $('chord-display');
        container.innerHTML = '';

        chords.forEach(c => {
            const html = `
                <div class="chord-box animate__animated animate__zoomIn">
                    <div class="chord-root">${c.r}</div>
                    <div class="chord-type">${c.t}</div>
                </div>
            `;
            container.innerHTML += html;
        });

        $('chord-output-card').classList.remove('d-none');
        $('chord-output-card').scrollIntoView({ behavior: 'smooth' });
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\chord-generator.blade.php ENDPATH**/ ?>