<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            
            <div class="p-3 rounded-4 mb-4" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-bolt text-warning me-2"></i>Quick Examples</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 slope-ex" data-x1="1" data-y1="2" data-x2="4" data-y2="6">(1,2) → (4,6)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 slope-ex" data-x1="0" data-y1="0" data-x2="5" data-y2="5">(0,0) → (5,5)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 slope-ex" data-x1="-3" data-y1="4" data-x2="3" data-y2="-2">(-3,4) → (3,-2)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 slope-ex" data-x1="2" data-y1="5" data-x2="2" data-y2="10">Vertical Line</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 slope-ex" data-x1="1" data-y1="3" data-x2="7" data-y2="3">Horizontal Line</button>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px">Point 1 (x₁, y₁)</h6>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">X₁</label>
                                <input type="number" id="slope-x1" class="form-control form-control-lg rounded-3" value="1" step="any" tabindex="1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Y₁</label>
                                <input type="number" id="slope-y1" class="form-control form-control-lg rounded-3" value="2" step="any" tabindex="2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px">Point 2 (x₂, y₂)</h6>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">X₂</label>
                                <input type="number" id="slope-x2" class="form-control form-control-lg rounded-3" value="4" step="any" tabindex="3">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Y₂</label>
                                <input type="number" id="slope-y2" class="form-control form-control-lg rounded-3" value="6" step="any" tabindex="4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Decimal Precision</label>
                    <select id="slope-prec" class="form-select rounded-3">
                        <option value="2">2 places</option>
                        <option value="4" selected>4 places</option>
                        <option value="6">6 places</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Angle Unit</label>
                    <select id="slope-angle-unit" class="form-select rounded-3">
                        <option value="deg" selected>Degrees</option>
                        <option value="rad">Radians</option>
                    </select>
                </div>
            </div>

            <div class="mt-4 p-3 rounded-4" style="background:#eff6ff;border:1.5px solid #bfdbfe">
                <p class="mb-0 small text-secondary"><i class="fas fa-info-circle text-primary me-2"></i>
                    <strong>Slope Formula:</strong> m = (y₂ − y₁) / (x₂ − x₁) — the rate of change between two points.
                </p>
            </div>
        </div>
    </div>

    
    <div class="card tool-card-stacked shadow-sm border-0" id="slope-result-card">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Step-by-Step Solution</h5>
                        <p class="text-muted small mb-0">Line equation, slope, angle & distance</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="slope-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i> Copy Steps</button>
                    <button class="btn btn-dark btn-sm rounded-pill px-3" id="slope-pdf" style="min-width: 280px; max-width: 100%;"><i class="fas fa-file-pdf me-1"></i> Download PDF</button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 mb-4">
                <div class="col-md-5 text-center">
                    <svg id="slope-svg" viewBox="0 0 280 220" width="280" height="220" style="max-width:100%;background:#fafbfc;border-radius:16px;border:1px solid #e5e7eb"></svg>
                </div>
                <div class="col-md-7">
                    <div class="p-4 rounded-4 text-center" style="background:#eff6ff;border:2px solid #bfdbfe">
                        <span class="d-block small fw-bold text-uppercase text-muted mb-1" style="letter-spacing:1px">Slope (m)</span>
                        <div class="display-4 fw-bold" style="color:#2563eb" id="slope-answer">1.3333</div>
                    </div>
                    <div class="row g-3 mt-3">
                        <div class="col-4"><div class="stat-card"><span class="stat-card-label">Angle</span><span class="stat-card-value" id="slope-out-angle">53.13°</span></div></div>
                        <div class="col-4"><div class="stat-card"><span class="stat-card-label">Distance</span><span class="stat-card-value" id="slope-out-dist">5</span></div></div>
                        <div class="col-4"><div class="stat-card"><span class="stat-card-label">Δx, Δy</span><span class="stat-card-value" id="slope-out-deltas">3, 4</span></div></div>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 bg-white border mb-3">
                <h6 class="fw-bold mb-2"><i class="fas fa-function text-primary me-2"></i>Line Equations</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:#f8fafc"><span class="d-block small fw-bold text-muted text-uppercase">Slope-Intercept</span><code class="fs-5" id="slope-eq-si">y = 1.3333x + 0.6667</code></div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:#f8fafc"><span class="d-block small fw-bold text-muted text-uppercase">Point-Slope</span><code class="fs-5" id="slope-eq-ps">y − 2 = 1.3333(x − 1)</code></div>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 bg-light border" id="slope-steps-box">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol text-primary me-2"></i>Solution Steps</h6>
                <div id="slope-steps" class="small text-secondary"></div>
            </div>
        </div>
    </div>
</div>

<style>
    .tool-card-stacked { border-radius: 24px; background: #fff; }
    .icon-box { width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }
    .step-item { padding: 0.75rem 1rem; background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; margin-bottom: 0.5rem; }
    .step-num { display: inline-flex; width: 28px; height: 28px; border-radius: 50%; background: #3b82f6; color: #fff; align-items: center; justify-content: center; font-weight: 800; font-size: 0.8rem; margin-right: 0.75rem; flex-shrink: 0; }

    @media print {
        .card:not(#slope-result-card), .header-actions, .header-v2, .p-3.rounded-4, .mt-4.p-3.rounded-4, footer, nav, .sidebar { display: none !important; }
        .card#slope-result-card { border: none !important; box-shadow: none !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
        #slope-result-card .display-4 { font-size: 3rem !important; }
        #slope-svg { max-width: 300px !important; margin: 0 auto !important; }
        .step-item { page-break-inside: avoid; border: 1px solid #eee !important; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ids = ['slope-x1','slope-y1','slope-x2','slope-y2'];
    const els = ids.map(id => document.getElementById(id));
    const precE = document.getElementById('slope-prec');
    const angUnitE = document.getElementById('slope-angle-unit');

    function fmt(n) { return parseFloat(n.toFixed(parseInt(precE.value))); }
    function fmtFrac(num, den) { if (den === 1) return `${num}`; if (num === 0) return '0'; return `${num}/${den}`; }
    function gcd(a, b) { a = Math.abs(a); b = Math.abs(b); while(b) { [a,b] = [b, a%b]; } return a; }
    function simplify(n, d) { if (d === 0) return [n, 0]; const g = gcd(n, d); return d < 0 ? [-n/g, -d/g] : [n/g, d/g]; }

    function drawLine(x1, y1, x2, y2) {
        const svg = document.getElementById('slope-svg');
        const pad = 30, w = 220, h = 160;
        const minX = Math.min(x1,x2), maxX = Math.max(x1,x2), minY = Math.min(y1,y2), maxY = Math.max(y1,y2);
        const rx = maxX - minX || 1, ry = maxY - minY || 1;
        const sx = (px) => pad + ((px - minX) / rx) * w;
        const sy = (py) => pad + h - ((py - minY) / ry) * h;
        svg.innerHTML = `
            <line x1="${pad}" y1="${pad+h}" x2="${pad+w}" y2="${pad+h}" stroke="#e5e7eb" stroke-width="1"/>
            <line x1="${pad}" y1="${pad}" x2="${pad}" y2="${pad+h}" stroke="#e5e7eb" stroke-width="1"/>
            <line x1="${sx(x1)}" y1="${sy(y1)}" x2="${sx(x2)}" y2="${sy(y2)}" stroke="#3b82f6" stroke-width="3" stroke-linecap="round"/>
            <line x1="${sx(x1)}" y1="${sy(y1)}" x2="${sx(x2)}" y2="${sy(y1)}" stroke="#f59e0b" stroke-width="1.5" stroke-dasharray="6,3"/>
            <line x1="${sx(x2)}" y1="${sy(y1)}" x2="${sx(x2)}" y2="${sy(y2)}" stroke="#ef4444" stroke-width="1.5" stroke-dasharray="6,3"/>
            <circle cx="${sx(x1)}" cy="${sy(y1)}" r="6" fill="#3b82f6"/>
            <circle cx="${sx(x2)}" cy="${sy(y2)}" r="6" fill="#3b82f6"/>
            <text x="${sx(x1)}" y="${sy(y1)-10}" text-anchor="middle" font-size="11" font-weight="700" fill="#1e293b">(${x1},${y1})</text>
            <text x="${sx(x2)}" y="${sy(y2)-10}" text-anchor="middle" font-size="11" font-weight="700" fill="#1e293b">(${x2},${y2})</text>
            <text x="${sx((x1+x2)/2)}" y="${sy(y1)+16}" text-anchor="middle" font-size="10" font-weight="700" fill="#f59e0b">Δx=${x2-x1}</text>
            <text x="${sx(x2)+14}" y="${sy((y1+y2)/2)}" text-anchor="start" font-size="10" font-weight="700" fill="#ef4444">Δy=${y2-y1}</text>
        `;
    }

    function calculate() {
        const x1 = parseFloat(els[0].value) || 0;
        const y1 = parseFloat(els[1].value) || 0;
        const x2 = parseFloat(els[2].value) || 0;
        const y2 = parseFloat(els[3].value) || 0;
        const dx = x2 - x1, dy = y2 - y1;
        const p = parseInt(precE.value);
        const isRad = angUnitE.value === 'rad';
        const steps = [];

        steps.push({ text: `<strong>Given Points:</strong> P₁(${x1}, ${y1}) and P₂(${x2}, ${y2})` });
        steps.push({ text: `<strong>Calculate Δ:</strong> Δx = x₂ − x₁ = ${x2} − ${x1} = ${dx}, Δy = y₂ − y₁ = ${y2} − ${y1} = ${dy}` });

        let slopeText, slopeVal;
        if (dx === 0) {
            slopeText = 'Undefined (vertical line)';
            slopeVal = Infinity;
            steps.push({ text: `<strong>Slope:</strong> m = Δy / Δx = ${dy} / 0 = <strong>Undefined</strong> (vertical line)` });
        } else {
            const [sn, sd] = simplify(dy, dx);
            slopeVal = dy / dx;
            slopeText = fmt(slopeVal);
            steps.push({ text: `<strong>Slope:</strong> m = Δy / Δx = ${dy} / ${dx} = ${fmtFrac(sn,sd)} = <strong>${slopeText}</strong>` });
        }

        const dist = Math.sqrt(dx*dx + dy*dy);
        steps.push({ text: `<strong>Distance:</strong> d = √(Δx² + Δy²) = √(${dx*dx} + ${dy*dy}) = √${dx*dx+dy*dy} = <strong>${fmt(dist)}</strong>` });

        let angleRad = Math.atan2(dy, dx);
        let angleDeg = angleRad * 180 / Math.PI;
        const angleDisplay = isRad ? fmt(angleRad) + ' rad' : fmt(angleDeg) + '°';
        steps.push({ text: `<strong>Angle of Inclination:</strong> θ = arctan(m) = <strong>${angleDisplay}</strong>` });

        document.getElementById('slope-answer').textContent = dx === 0 ? 'Undefined' : slopeText;
        document.getElementById('slope-out-angle').textContent = angleDisplay;
        document.getElementById('slope-out-dist').textContent = fmt(dist);
        document.getElementById('slope-out-deltas').textContent = `${dx}, ${dy}`;

        if (dx !== 0) {
            const b_intercept = y1 - slopeVal * x1;
            const bSign = b_intercept >= 0 ? '+' : '−';
            const bAbs = fmt(Math.abs(b_intercept));
            document.getElementById('slope-eq-si').textContent = `y = ${slopeText}x ${bSign} ${bAbs}`;
            document.getElementById('slope-eq-ps').textContent = `y − ${y1} = ${slopeText}(x − ${x1})`;
            steps.push({ text: `<strong>Y-Intercept:</strong> b = y₁ − m·x₁ = ${y1} − ${slopeText}·${x1} = <strong>${fmt(b_intercept)}</strong>` });
            steps.push({ text: `<strong>Slope-Intercept Form:</strong> y = ${slopeText}x ${bSign} ${bAbs}` });
        } else {
            document.getElementById('slope-eq-si').textContent = `x = ${x1}`;
            document.getElementById('slope-eq-ps').textContent = `x = ${x1} (vertical)`;
        }

        let html = steps.map((st, i) => `<div class="step-item d-flex align-items-start"><span class="step-num">${i+1}</span><span>${st.text}</span></div>`).join('');
        document.getElementById('slope-steps').innerHTML = html;
        drawLine(x1, y1, x2, y2);
    }

    [...els, precE, angUnitE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.slope-ex').forEach(btn => {
        btn.addEventListener('click', () => {
            els[0].value = btn.dataset.x1; els[1].value = btn.dataset.y1;
            els[2].value = btn.dataset.x2; els[3].value = btn.dataset.y2;
            calculate();
        });
    });

    document.getElementById('slope-reset').addEventListener('click', () => {
        els[0].value=1; els[1].value=2; els[2].value=4; els[3].value=6; calculate();
    });

    document.getElementById('slope-copy').addEventListener('click', function() {
        const title = "Slope Calculation Report\n" + "=".repeat(30) + "\n";
        const answer = `Slope (m): ${document.getElementById('slope-answer').textContent}\n`;
        const eqs = `Equations:\n- SI: ${document.getElementById('slope-eq-si').textContent}\n- PS: ${document.getElementById('slope-eq-ps').textContent}\n`;
        const steps = document.getElementById('slope-steps-box').innerText.replace('Solution Steps', '').trim();
        const text = title + answer + eqs + "\n" + steps + "\n\nGenerated via ToolsHub";
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    document.getElementById('slope-pdf').addEventListener('click', function() {
        window.print();
    });

    calculate();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/tools/interactive/slope-calculator.blade.php ENDPATH**/ ?>