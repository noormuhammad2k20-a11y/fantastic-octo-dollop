<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4 align-items-center justify-content-center">
                <div class="col-md-4">
                    <label class="form-label-custom">Side a</label>
                    <input type="number" step="any" class="form-control-v2" id="hc-a" value="3">
                </div>
                <div class="col-md-4">
                    <label class="form-label-custom">Side b</label>
                    <input type="number" step="any" class="form-control-v2" id="hc-b" value="4">
                </div>
                <div class="col-md-4">
                    <label class="form-label-custom">Hypotenuse c (optional)</label>
                    <input type="number" step="any" class="form-control-v2" id="hc-c" placeholder="Solve for c">
                </div>
                <div class="col-12 mt-4 text-center">
                    <button class="btn btn-primary rounded-pill px-5 py-2 fw-bold" id="hc-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-bolt me-2"></i> Solve Triangle
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div class="card tool-card-stacked shadow-sm border-0" id="hc-result-card" style="display: none;">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981">
                        <i class="fas fa-check"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-dark">Solved Properties</h5>
                </div>
                <div class="header-actions">
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2" id="hc-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-copy me-1"></i> Copy
                    </button>
                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3" id="hc-pdf" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-file-pdf me-1"></i> PDF
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="result-hero p-4 rounded-4 text-center mb-4" style="background: #eef2ff;">
                        <span class="text-indigo small fw-bold text-uppercase" id="hc-label">Hypotenuse (c)</span>
                        <div class="display-3 fw-black text-indigo mb-0" id="hc-answer">5</div>
                    </div>
                    <div id="hc-steps-box">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-stream me-2 text-indigo"></i>Pythagorean Steps</h6>
                        <div id="hc-steps-content"></div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="p-4 bg-white border rounded-4 shadow-sm">
                        <svg viewBox="0 0 100 100" style="max-width: 250px;">
                            <polygon points="10,90 90,90 10,10" fill="rgba(79,70,229,0.1)" stroke="#4f46e5" stroke-width="2" />
                            <text x="50" y="98" font-size="8" fill="#4f46e5" text-anchor="middle">b</text>
                            <text x="2" y="50" font-size="8" fill="#4f46e5" text-anchor="middle">a</text>
                            <text x="60" y="45" font-size="8" fill="#4f46e5" text-anchor="middle" style="transform: rotate(-45deg); transform-origin: 60px 45px;">c</text>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label-custom { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 0.5rem; display: block; }
    .form-control-v2 { border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 0.6rem 0.75rem; font-size: 1.1rem; color: #1e293b; width: 100%; transition: all 0.2s; font-weight: 600; }
    .form-control-v2:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79,70,229,0.1); outline: none; }
    .step-item { display: flex; align-items: flex-start; margin-bottom: 0.75rem; padding: 0.75rem; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; }
    .step-num { width: 24px; height: 24px; background: #4f46e5; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 800; margin-right: 0.75rem; flex-shrink: 0; margin-top: 2px; }
    @media print {
        .card:not(#hc-result-card), .header-actions, .header-v2, footer, nav, .sidebar { display: none !important; }
        .card#hc-result-card { border: none !important; box-shadow: none !important; margin: 0 !important; width: 100% !important; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const aVal = document.getElementById('hc-a').value;
        const bVal = document.getElementById('hc-b').value;
        const cVal = document.getElementById('hc-c').value;

        const a = parseFloat(aVal); const b = parseFloat(bVal); const c = parseFloat(cVal);
        let res, label, steps;

        if (cVal === '' && !isNaN(a) && !isNaN(b)) {
            res = Math.sqrt(a*a + b*b); label = "Hypotenuse (c)";
            steps = `
                <div class="step-item"><span class="step-num">1</span><div><strong>Formula:</strong> c² = a² + b²</div></div>
                <div class="step-item"><span class="step-num">2</span><div><strong>Substitution:</strong> c² = ${a}² + ${b}² = ${a*a} + ${b*b} = ${a*a + b*b}</div></div>
                <div class="step-item"><span class="step-num">3</span><div><strong>Result:</strong> c = √${a*a + b*b} = ${res.toFixed(4)}</div></div>
            `;
        } else if (aVal === '' && !isNaN(c) && !isNaN(b)) {
            if (c <= b) { alert("Hypotenuse must be longer than sides."); return; }
            res = Math.sqrt(c*c - b*b); label = "Side (a)";
            steps = `
                <div class="step-item"><span class="step-num">1</span><div><strong>Formula:</strong> a² = c² - b²</div></div>
                <div class="step-item"><span class="step-num">2</span><div><strong>Substitution:</strong> a² = ${c}² - ${b}² = ${c*c} - ${b*b} = ${c*c - b*b}</div></div>
                <div class="step-item"><span class="step-num">3</span><div><strong>Result:</strong> a = √${c*c - b*b} = ${res.toFixed(4)}</div></div>
            `;
        } else if (bVal === '' && !isNaN(c) && !isNaN(a)) {
            if (c <= a) { alert("Hypotenuse must be longer than sides."); return; }
            res = Math.sqrt(c*c - a*a); label = "Side (b)";
            steps = `
                <div class="step-item"><span class="step-num">1</span><div><strong>Formula:</strong> b² = c² - a²</div></div>
                <div class="step-item"><span class="step-num">2</span><div><strong>Substitution:</strong> b² = ${c}² - ${a}² = ${c*c} - ${a*a} = ${c*c - a*a}</div></div>
                <div class="step-item"><span class="step-num">3</span><div><strong>Result:</strong> b = √${c*c - a*a} = ${res.toFixed(4)}</div></div>
            `;
        } else {
            alert("Please fill in exactly 2 values.");
            return;
        }

        document.getElementById('hc-label').textContent = label;
        document.getElementById('hc-answer').textContent = res.toFixed(4).replace(/\.?0+$/, "");
        document.getElementById('hc-steps-content').innerHTML = steps;
        document.getElementById('hc-result-card').style.display = 'block';
    }

    document.getElementById('hc-calculate').addEventListener('click', calculate);
    document.getElementById('hc-reset').addEventListener('click', () => {
        ['hc-a','hc-b','hc-c'].forEach(id => document.getElementById(id).value = '');
        document.getElementById('hc-result-card').style.display = 'none';
    });
    document.getElementById('hc-copy').addEventListener('click', function() {
        navigator.clipboard.writeText(document.getElementById('hc-result-card').innerText);
        this.innerHTML = 'Copied';
        setTimeout(() => this.innerHTML = '<i class="far fa-copy me-1"></i> Copy', 2000);
    });
    document.getElementById('hc-pdf').addEventListener('click', () => window.print());
});
</script>

