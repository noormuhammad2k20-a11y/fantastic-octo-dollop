<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-4 mb-4" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-bolt text-warning me-2"></i>Quick Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 cone-ex" data-r="5" data-h="10" data-tr="">Full Cone R5 H10</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 cone-ex" data-r="8" data-h="12" data-tr="">Full Cone R8 H12</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 cone-ex" data-r="10" data-h="15" data-tr="4">Truncated R10/4 H15</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 cone-ex" data-r="6" data-h="8" data-tr="3">Truncated R6/3 H8</button>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Cone Type</label>
                    <select id="cone-type" class="form-select form-select-lg rounded-3">
                        <option value="full">Full Cone</option>
                        <option value="truncated">Truncated (Frustum)</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Base Radius (R)</label>
                    <input type="number" id="cone-r" class="form-control form-control-lg rounded-3" value="5" step="any" min="0.1" tabindex="1">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Height (H)</label>
                    <input type="number" id="cone-h" class="form-control form-control-lg rounded-3" value="10" step="any" min="0.1" tabindex="2">
                </div>
                <div class="col-md-3" id="cone-tr-wrap" style="display:none">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Top Radius (r)</label>
                    <input type="number" id="cone-tr" class="form-control form-control-lg rounded-3" value="2" step="any" min="0" tabindex="3">
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Unit</label>
                    <select id="cone-unit" class="form-select rounded-3">
                        <option value="mm">mm</option>
                        <option value="cm" selected>cm</option>
                        <option value="in">inches</option>
                        <option value="m">meters</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Precision</label>
                    <select id="cone-prec" class="form-select rounded-3">
                        <option value="2">2 decimal places</option>
                        <option value="4" selected>4 decimal places</option>
                        <option value="6">6 decimal places</option>
                    </select>
                </div>
            </div>

            <div class="mt-4 p-3 rounded-4" style="background:#fdf2f8;border:1.5px solid #fbcfe8">
                <p class="mb-0 small text-secondary"><i class="fas fa-info-circle me-2" style="color:#ec4899"></i>
                    <strong>Flat Pattern:</strong> Unrolling a cone produces a sector of an annulus (ring). The slant height becomes the radius and the base circumference becomes the arc length.
                </p>
            </div>
        </div>
    </div>

    
    <div class="card tool-card-stacked shadow-sm border-0" id="cone-result-card">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Flat Pattern & Dimensions</h5>
                        <p class="text-muted small mb-0">Visual template with all critical measurements</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="cone-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i> Copy Steps</button>
                    <button class="btn btn-dark btn-sm rounded-pill px-3" id="cone-svg-dl" style="min-width: 280px; max-width: 100%;"><i class="fas fa-download me-1"></i> Download SVG</button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 mb-4">
                <div class="col-md-6 text-center">
                    <div class="p-3 rounded-4" style="background:#fafbfc;border:1px solid #e5e7eb">
                        <h6 class="fw-bold text-uppercase small text-muted mb-2">Flat Pattern Preview</h6>
                        <svg id="cone-svg" viewBox="0 0 400 400" width="400" height="400" style="max-width:100%"></svg>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row g-3">
                        <div class="col-6"><div class="stat-card"><span class="stat-card-label">Slant Height</span><span class="stat-card-value" id="cone-out-slant">11.18</span></div></div>
                        <div class="col-6"><div class="stat-card"><span class="stat-card-label">Arc Angle</span><span class="stat-card-value" id="cone-out-angle">161.08°</span></div></div>
                        <div class="col-6"><div class="stat-card"><span class="stat-card-label">Arc Length</span><span class="stat-card-value" id="cone-out-arc">31.42</span></div></div>
                        <div class="col-6"><div class="stat-card"><span class="stat-card-label">Lateral Area</span><span class="stat-card-value" id="cone-out-lateral">175.93</span></div></div>
                        <div class="col-6"><div class="stat-card"><span class="stat-card-label">Total Area</span><span class="stat-card-value" id="cone-out-total">254.47</span></div></div>
                        <div class="col-6"><div class="stat-card"><span class="stat-card-label">Volume</span><span class="stat-card-value" id="cone-out-vol">261.80</span></div></div>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 bg-light border" id="cone-steps-box">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2" style="color:#ec4899"></i>Solution Steps</h6>
                <div id="cone-steps" class="small text-secondary"></div>
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
    .step-num { display: inline-flex; width: 28px; height: 28px; border-radius: 50%; background: #ec4899; color: #fff; align-items: center; justify-content: center; font-weight: 800; font-size: 0.8rem; margin-right: 0.75rem; flex-shrink: 0; }

    @media print {
        .card:not(#cone-result-card), .header-actions, .header-v2, .p-3.rounded-4, .mt-4.p-3.rounded-4, footer, nav, .sidebar { display: none !important; }
        .card#cone-result-card { border: none !important; box-shadow: none !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
        #cone-svg { max-width: 300px !important; margin: 0 auto !important; }
        .step-item { page-break-inside: avoid; border: 1px solid #eee !important; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeE = document.getElementById('cone-type');
    const rE = document.getElementById('cone-r');
    const hE = document.getElementById('cone-h');
    const trE = document.getElementById('cone-tr');
    const trWrap = document.getElementById('cone-tr-wrap');
    const unitE = document.getElementById('cone-unit');
    const precE = document.getElementById('cone-prec');

    typeE.addEventListener('change', () => {
        trWrap.style.display = typeE.value === 'truncated' ? '' : 'none';
        calculate();
    });

    function fmt(n) { return parseFloat(n.toFixed(parseInt(precE.value))); }
    function u() { return unitE.value; }

    function drawPattern(slant, arcAngleDeg, innerSlant) {
        const svg = document.getElementById('cone-svg');
        const cx = 200, cy = 200;
        const scale = 150 / slant;
        const outerR = slant * scale;
        const innerR = innerSlant ? innerSlant * scale : 0;
        const arcRad = arcAngleDeg * Math.PI / 180;
        const startAngle = -arcRad / 2;
        const endAngle = arcRad / 2;

        function polarToCart(r, angle) { return { x: cx + r * Math.cos(angle - Math.PI/2), y: cy + r * Math.sin(angle - Math.PI/2) }; }

        const outerStart = polarToCart(outerR, startAngle);
        const outerEnd = polarToCart(outerR, endAngle);
        const largeArc = arcAngleDeg > 180 ? 1 : 0;

        let path;
        if (innerR > 0) {
            const innerStart = polarToCart(innerR, startAngle);
            const innerEnd = polarToCart(innerR, endAngle);
            path = `M ${outerStart.x} ${outerStart.y} A ${outerR} ${outerR} 0 ${largeArc} 1 ${outerEnd.x} ${outerEnd.y} L ${innerEnd.x} ${innerEnd.y} A ${innerR} ${innerR} 0 ${largeArc} 0 ${innerStart.x} ${innerStart.y} Z`;
        } else {
            path = `M ${cx} ${cy} L ${outerStart.x} ${outerStart.y} A ${outerR} ${outerR} 0 ${largeArc} 1 ${outerEnd.x} ${outerEnd.y} Z`;
        }

        svg.innerHTML = `
            <path d="${path}" fill="rgba(236,72,153,0.08)" stroke="#ec4899" stroke-width="2.5"/>
            <circle cx="${cx}" cy="${cy}" r="3" fill="#ec4899"/>
            <line x1="${cx}" y1="${cy}" x2="${outerStart.x}" y2="${outerStart.y}" stroke="#94a3b8" stroke-width="1" stroke-dasharray="4,3"/>
            <line x1="${cx}" y1="${cy}" x2="${outerEnd.x}" y2="${outerEnd.y}" stroke="#94a3b8" stroke-width="1" stroke-dasharray="4,3"/>
            <text x="${cx}" y="${cy + outerR/2 + 6}" text-anchor="middle" font-size="11" font-weight="700" fill="#ec4899">${fmt(arcAngleDeg)}°</text>
            <text x="${cx - outerR/2 - 5}" y="${cy - 8}" text-anchor="end" font-size="10" font-weight="700" fill="#64748b">R=${fmt(slant)}</text>
        `;
    }

    function calculate() {
        const R = parseFloat(rE.value) || 0;
        const H = parseFloat(hE.value) || 0;
        const isTruncated = typeE.value === 'truncated';
        const r = isTruncated ? (parseFloat(trE.value) || 0) : 0;
        if (R <= 0 || H <= 0 || (isTruncated && r >= R)) return;

        const steps = [];
        let slantHeight, arcAngle, arcLength, lateralArea, totalArea, volume, innerSlant = 0;

        if (!isTruncated) {
            slantHeight = Math.sqrt(R*R + H*H);
            arcAngle = (R / slantHeight) * 360;
            arcLength = 2 * Math.PI * R;
            lateralArea = Math.PI * R * slantHeight;
            totalArea = lateralArea + Math.PI * R * R;
            volume = (1/3) * Math.PI * R * R * H;

            steps.push({ text: `<strong>Given:</strong> Base Radius R = ${R} ${u()}, Height H = ${H} ${u()}` });
            steps.push({ text: `<strong>Slant Height:</strong> L = √(R² + H²) = √(${R}² + ${H}²) = √${fmt(R*R + H*H)} = <strong>${fmt(slantHeight)} ${u()}</strong>` });
            steps.push({ text: `<strong>Arc Angle:</strong> θ = (R / L) × 360° = (${R} / ${fmt(slantHeight)}) × 360° = <strong>${fmt(arcAngle)}°</strong>` });
            steps.push({ text: `<strong>Arc Length:</strong> 2πR = 2π × ${R} = <strong>${fmt(arcLength)} ${u()}</strong>` });
            steps.push({ text: `<strong>Lateral Surface Area:</strong> πRL = π × ${R} × ${fmt(slantHeight)} = <strong>${fmt(lateralArea)} ${u()}²</strong>` });
            steps.push({ text: `<strong>Total Surface Area:</strong> πRL + πR² = ${fmt(lateralArea)} + ${fmt(Math.PI*R*R)} = <strong>${fmt(totalArea)} ${u()}²</strong>` });
            steps.push({ text: `<strong>Volume:</strong> (1/3)πR²H = (1/3)π × ${R}² × ${H} = <strong>${fmt(volume)} ${u()}³</strong>` });
        } else {
            slantHeight = Math.sqrt((R-r)*(R-r) + H*H);
            const fullSlant = (R * Math.sqrt((R-r)*(R-r) + H*H)) / (R - r);
            innerSlant = fullSlant - slantHeight;
            arcAngle = (R / fullSlant) * 360;
            arcLength = 2 * Math.PI * R;
            lateralArea = Math.PI * (R + r) * slantHeight;
            totalArea = lateralArea + Math.PI * R * R + Math.PI * r * r;
            volume = (1/3) * Math.PI * H * (R*R + r*r + R*r);

            steps.push({ text: `<strong>Given:</strong> Base R = ${R} ${u()}, Top r = ${r} ${u()}, Height H = ${H} ${u()}` });
            steps.push({ text: `<strong>Slant Height:</strong> L = √((R−r)² + H²) = √(${R-r}² + ${H}²) = <strong>${fmt(slantHeight)} ${u()}</strong>` });
            steps.push({ text: `<strong>Full Cone Slant:</strong> L<sub>full</sub> = R × L / (R − r) = <strong>${fmt(fullSlant)} ${u()}</strong>` });
            steps.push({ text: `<strong>Inner Slant:</strong> L<sub>inner</sub> = L<sub>full</sub> − L = <strong>${fmt(innerSlant)} ${u()}</strong>` });
            steps.push({ text: `<strong>Arc Angle:</strong> θ = (R / L<sub>full</sub>) × 360° = <strong>${fmt(arcAngle)}°</strong>` });
            steps.push({ text: `<strong>Lateral Area:</strong> π(R+r)L = <strong>${fmt(lateralArea)} ${u()}²</strong>` });
            steps.push({ text: `<strong>Total Area:</strong> π(R+r)L + πR² + πr² = <strong>${fmt(totalArea)} ${u()}²</strong>` });
            steps.push({ text: `<strong>Volume:</strong> (1/3)πH(R²+r²+Rr) = <strong>${fmt(volume)} ${u()}³</strong>` });
        }

        document.getElementById('cone-out-slant').textContent = fmt(slantHeight) + ' ' + u();
        document.getElementById('cone-out-angle').textContent = fmt(arcAngle) + '°';
        document.getElementById('cone-out-arc').textContent = fmt(arcLength) + ' ' + u();
        document.getElementById('cone-out-lateral').textContent = fmt(lateralArea) + ' ' + u() + '²';
        document.getElementById('cone-out-total').textContent = fmt(totalArea) + ' ' + u() + '²';
        document.getElementById('cone-out-vol').textContent = fmt(volume) + ' ' + u() + '³';

        document.getElementById('cone-steps').innerHTML = steps.map((st, i) =>
            `<div class="step-item d-flex align-items-start"><span class="step-num">${i+1}</span><span>${st.text}</span></div>`
        ).join('');

        const drawSlant = isTruncated ? (R * slantHeight / (R - r)) : slantHeight;
        drawPattern(drawSlant, arcAngle, isTruncated ? innerSlant : 0);
    }

    [rE, hE, trE, unitE, precE].forEach(el => el.addEventListener('input', calculate));
    typeE.addEventListener('change', calculate);

    document.querySelectorAll('.cone-ex').forEach(btn => {
        btn.addEventListener('click', () => {
            rE.value = btn.dataset.r; hE.value = btn.dataset.h;
            if (btn.dataset.tr) { typeE.value = 'truncated'; trE.value = btn.dataset.tr; trWrap.style.display = ''; }
            else { typeE.value = 'full'; trWrap.style.display = 'none'; }
            calculate();
        });
    });

    document.getElementById('cone-reset').addEventListener('click', () => {
        rE.value = 5; hE.value = 10; typeE.value = 'full'; trWrap.style.display = 'none'; calculate();
    });

    document.getElementById('cone-copy').addEventListener('click', function() {
        const title = "Cone Flat Pattern Report\n" + "=".repeat(30) + "\n";
        const stats = `Dimensions:\n- Slant: ${document.getElementById('cone-out-slant').textContent}\n- Angle: ${document.getElementById('cone-out-angle').textContent}\n- Arc: ${document.getElementById('cone-out-arc').textContent}\n`;
        const steps = document.getElementById('cone-steps-box').innerText.replace('Solution Steps', '').trim();
        const text = title + stats + "\n" + steps + "\n\nGenerated via ToolsHub";
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-1"></i> Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    document.getElementById('cone-svg-dl').addEventListener('click', function() {
        window.print();
    });

    calculate();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\cone-flat-pattern-generator.blade.php ENDPATH**/ ?>