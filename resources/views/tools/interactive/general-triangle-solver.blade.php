<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                <div class="col-md-4">
                    <label class="form-label-custom">Input Configuration</label>
                    <select class="form-select-v2" id="tri-mode">
                        <option value="SSS">SSS (3 Sides)</option>
                        <option value="SAS">SAS (2 Sides, 1 Angle)</option>
                        <option value="ASA">ASA (2 Angles, 1 Side)</option>
                        <option value="AAS">AAS (2 Angles, 1 Side)</option>
                        <option value="SSA">SSA (2 Sides, 1 Angle)</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <div id="tri-inputs-container" class="row g-3">
                        <!-- Inputs injected here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div class="card tool-card-stacked shadow-sm border-0" id="tri-result-card">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(59,130,246,.1);color:#3b82f6">
                        <i class="fas fa-shapes"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-dark">Triangle Properties</h5>
                </div>
                <div class="header-actions">
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2" id="tri-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-copy me-1"></i> Copy Report
                    </button>
                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3" id="tri-pdf" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-file-pdf me-1"></i> PDF
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="row g-3 mb-4" id="tri-outputs">
                        <!-- Dynamic outputs -->
                    </div>
                    
                    <div id="tri-steps-box">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-pencil-alt me-2 text-primary"></i>Mathematical Steps</h6>
                        <div id="tri-steps-content">
                            <!-- Steps injected here -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="p-4 bg-white border rounded-4 shadow-sm">
                        <svg id="tri-svg" viewBox="-10 -10 120 120" style="max-width: 100%; height: auto;">
                            <polygon id="svg-poly" points="0,100 100,100 50,0" fill="rgba(20,184,166,0.1)" stroke="#14b8a6" stroke-width="2" />
                            <text id="txt-a" x="0" y="100" font-size="8" fill="#14b8a6">A</text>
                            <text id="txt-b" x="100" y="100" font-size="8" fill="#14b8a6">B</text>
                            <text id="txt-c" x="50" y="0" font-size="8" fill="#14b8a6">C</text>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label-custom { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 0.5rem; display: block; }
    .form-control-v2, .form-select-v2 { border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 0.6rem 0.75rem; font-size: 1rem; color: #1e293b; width: 100%; transition: all 0.2s; font-weight: 600; }
    .form-control-v2:focus, .form-select-v2:focus { border-color: #14b8a6; box-shadow: 0 0 0 4px rgba(20,184,166,0.1); outline: none; }
    .step-item { display: flex; align-items: flex-start; margin-bottom: 0.75rem; padding: 0.75rem; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; }
    .step-num { width: 22px; height: 22px; background: #14b8a6; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: 800; margin-right: 0.75rem; flex-shrink: 0; margin-top: 2px; }
    .tri-stat { background: #f8fafc; padding: 1rem; border-radius: 12px; border: 1px solid #e2e8f0; text-align: center; }
    .tri-stat-label { font-size: 0.7rem; font-weight: 800; text-transform: uppercase; color: #64748b; display: block; margin-bottom: 0.25rem; }
    .tri-stat-value { font-size: 1.25rem; font-weight: 800; color: #1e293b; }
    
    @media print {
        .card:not(#tri-result-card), .header-actions, .header-v2, footer, nav, .sidebar { display: none !important; }
        .card#tri-result-card { border: none !important; box-shadow: none !important; margin: 0 !important; width: 100% !important; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modeEl = document.getElementById('tri-mode');
    const inputContainer = document.getElementById('tri-inputs-container');
    
    const configs = {
        SSS: ['Side a', 'Side b', 'Side c'],
        SAS: ['Side a', 'Angle γ (C)', 'Side b'],
        ASA: ['Angle α (A)', 'Side c', 'Angle β (B)'],
        AAS: ['Angle α (A)', 'Angle β (B)', 'Side a'],
        SSA: ['Side a', 'Side b', 'Angle α (A)']
    };

    function updateInputs() {
        const mode = modeEl.value;
        const labels = configs[mode];
        inputContainer.innerHTML = labels.map((l, i) => `
            <div class="col-md-4">
                <label class="form-label-custom">${l}</label>
                <input type="number" step="any" class="form-control-v2 tri-input" id="tri-val-${i}" value="${i === 2 ? 10 : 8}">
            </div>
        `).join('');
        
        document.querySelectorAll('.tri-input').forEach(el => el.addEventListener('input', calculate));
        calculate();
    }

    function rad(deg) { return deg * (Math.PI / 180); }
    function deg(rad) { return rad * (180 / Math.PI); }

    function calculate() {
        const mode = modeEl.value;
        const v0 = parseFloat(document.getElementById('tri-val-0').value) || 0;
        const v1 = parseFloat(document.getElementById('tri-val-1').value) || 0;
        const v2 = parseFloat(document.getElementById('tri-val-2').value) || 0;

        let a, b, c, A, B, C;
        let steps = [];

        try {
            if (mode === 'SSS') {
                a = v0; b = v1; c = v2;
                if (a+b <= c || a+c <= b || b+c <= a) throw "Invalid Triangle";
                A = deg(Math.acos((b*b + c*c - a*a) / (2*b*c)));
                B = deg(Math.acos((a*a + c*c - b*b) / (2*a*c)));
                C = 180 - A - B;
                steps.push({t: "Law of Cosines", d: "cos(A) = (b² + c² - a²) / 2bc"});
            } else if (mode === 'SAS') {
                a = v0; C = v1; b = v2;
                c = Math.sqrt(a*a + b*b - 2*a*b*Math.cos(rad(C)));
                A = deg(Math.asin(a * Math.sin(rad(C)) / c));
                B = 180 - A - C;
                steps.push({t: "Law of Cosines", d: "c = √(a² + b² - 2ab cos(C))"});
            } else if (mode === 'ASA') {
                A = v0; c = v1; B = v2;
                C = 180 - A - B;
                a = c * Math.sin(rad(A)) / Math.sin(rad(C));
                b = c * Math.sin(rad(B)) / Math.sin(rad(C));
                steps.push({t: "Law of Sines", d: "a = c sin(A) / sin(C)"});
            } else if (mode === 'AAS') {
                A = v0; B = v1; a = v2;
                C = 180 - A - B;
                b = a * Math.sin(rad(B)) / Math.sin(rad(A));
                c = a * Math.sin(rad(C)) / Math.sin(rad(A));
                steps.push({t: "Angle Sum", d: "C = 180 - A - B"});
            } else if (mode === 'SSA') {
                a = v0; b = v1; A = v2;
                let sinB = b * Math.sin(rad(A)) / a;
                if (sinB > 1) throw "No Solution";
                B = deg(Math.asin(sinB));
                C = 180 - A - B;
                c = a * Math.sin(rad(C)) / Math.sin(rad(A));
                steps.push({t: "Law of Sines", d: "sin(B) = b sin(A) / a"});
            }

            const area = 0.5 * a * b * Math.sin(rad(C));
            const p = a + b + c;

            renderResults({a, b, c, A, B, C, area, p}, steps);
            renderSVG(a, b, C);

        } catch (e) {
            document.getElementById('tri-outputs').innerHTML = `<div class="col-12 text-center text-danger fw-bold">${e}</div>`;
            document.getElementById('tri-steps-content').innerHTML = "";
        }
    }

    function renderResults(res, steps) {
        const fmt = (n) => n.toFixed(3);
        document.getElementById('tri-outputs').innerHTML = `
            <div class="col-4"><div class="tri-stat"><span class="tri-stat-label">Side a</span><div class="tri-stat-value">${fmt(res.a)}</div></div></div>
            <div class="col-4"><div class="tri-stat"><span class="tri-stat-label">Side b</span><div class="tri-stat-value">${fmt(res.b)}</div></div></div>
            <div class="col-4"><div class="tri-stat"><span class="tri-stat-label">Side c</span><div class="tri-stat-value">${fmt(res.c)}</div></div></div>
            <div class="col-4"><div class="tri-stat"><span class="tri-stat-label">Angle A</span><div class="tri-stat-value">${fmt(res.A)}°</div></div></div>
            <div class="col-4"><div class="tri-stat"><span class="tri-stat-label">Angle B</span><div class="tri-stat-value">${fmt(res.B)}°</div></div></div>
            <div class="col-4"><div class="tri-stat"><span class="tri-stat-label">Angle C</span><div class="tri-stat-value">${fmt(res.C)}°</div></div></div>
            <div class="col-6"><div class="tri-stat"><span class="tri-stat-label">Area</span><div class="tri-stat-value">${fmt(res.area)}</div></div></div>
            <div class="col-6"><div class="tri-stat"><span class="tri-stat-label">Perimeter</span><div class="tri-stat-value">${fmt(res.p)}</div></div></div>
        `;
        document.getElementById('tri-steps-content').innerHTML = steps.map((s, i) => `
            <div class="step-item">
                <span class="step-num">${i+1}</span>
                <div><div class="fw-bold small">${s.t}</div><div class="text-secondary small font-monospace">${s.d}</div></div>
            </div>
        `).join('');
    }

    function renderSVG(a, b, C_deg) {
        const C = rad(C_deg);
        // P1 at (0,0), P2 at (a, 0), P3 at (b cos C, b sin C)
        const p1 = {x: 0, y: 0};
        const p2 = {x: a, y: 0};
        const p3 = {x: b * Math.cos(C), y: b * Math.sin(C)};
        
        const coords = [p1, p2, p3];
        const minX = Math.min(...coords.map(p => p.x));
        const maxX = Math.max(...coords.map(p => p.x));
        const minY = Math.min(...coords.map(p => p.y));
        const maxY = Math.max(...coords.map(p => p.y));

        const pad = (maxX - minX) * 0.1 || 1;
        const scale = (val, min, max) => 10 + (val - min) / (max - min) * 80;

        const sx1 = scale(p1.x, minX - pad, maxX + pad);
        const sy1 = 100 - scale(p1.y, minY - pad, maxY + pad);
        const sx2 = scale(p2.x, minX - pad, maxX + pad);
        const sy2 = 100 - scale(p2.y, minY - pad, maxY + pad);
        const sx3 = scale(p3.x, minX - pad, maxX + pad);
        const sy3 = 100 - scale(p3.y, minY - pad, maxY + pad);

        document.getElementById('svg-poly').setAttribute('points', `${sx1},${sy1} ${sx2},${sy2} ${sx3},${sy3}`);
        document.getElementById('txt-a').setAttribute('x', sx1 - 5);
        document.getElementById('txt-a').setAttribute('y', sy1 + 5);
        document.getElementById('txt-b').setAttribute('x', sx2 + 2);
        document.getElementById('txt-b').setAttribute('y', sy2 + 5);
        document.getElementById('txt-c').setAttribute('x', sx3);
        document.getElementById('txt-c').setAttribute('y', sy3 - 5);
    }

    modeEl.addEventListener('change', updateInputs);
    document.getElementById('tri-reset').addEventListener('click', () => { modeEl.value = 'SSS'; updateInputs(); });
    document.getElementById('tri-copy').addEventListener('click', function() {
        const text = `Triangle Solver Report\n${'='.repeat(30)}\nGenerated via ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });
    document.getElementById('tri-pdf').addEventListener('click', () => window.print());

    updateInputs();
});
</script>

