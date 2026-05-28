<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                <div class="col-md-12">
                    <label class="form-label-custom">Number of Sides (n)</label>
                    <input type="number" class="form-control-v2" id="pd-n" value="6">
                    <p class="text-muted small mt-2">Example: 3=Triangle, 4=Square, 5=Pentagon, 6=Hexagon...</p>
                </div>
                <div class="col-12 mt-4">
                    <button class="btn btn-warning rounded-pill px-5 py-2 fw-bold" id="pd-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-bolt me-2"></i> Count Diagonals
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card tool-card-stacked shadow-sm border-0" id="pd-result-card" style="display: none;">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981">
                        <i class="fas fa-check"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-dark">Diagonals Summary</h5>
                </div>
                <div class="header-actions">
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2" id="pd-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-copy me-1"></i> Copy
                    </button>
                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3" id="pd-pdf" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-file-pdf me-1"></i> PDF
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="result-hero p-4 rounded-4 text-center mb-4" style="background: #fffbeb;">
                        <span class="text-warning small fw-bold text-uppercase">Number of Diagonals (D)</span>
                        <div class="display-3 fw-black text-warning mb-0" id="pd-answer">9</div>
                    </div>
                    <div id="pd-steps-box">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-stream me-2 text-warning"></i>Mathematical Steps</h6>
                        <div id="pd-steps-content"></div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="p-4 bg-white border rounded-4 shadow-sm">
                        <svg id="pd-svg" viewBox="0 0 100 100" style="max-width: 200px;">
                            <!-- Polygon will be drawn here -->
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
    .form-control-v2:focus { border-color: #f59e0b; box-shadow: 0 0 0 4px rgba(245,158,11,0.1); outline: none; }
    .step-item { display: flex; align-items: flex-start; margin-bottom: 0.75rem; padding: 0.75rem; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; }
    .step-num { width: 24px; height: 24px; background: #f59e0b; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 800; margin-right: 0.75rem; flex-shrink: 0; margin-top: 2px; }
    @media print {
        .card:not(#pd-result-card), .header-actions, .header-v2, footer, nav, .sidebar { display: none !important; }
        .card#pd-result-card { border: none !important; box-shadow: none !important; margin: 0 !important; width: 100% !important; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const n = parseInt(document.getElementById('pd-n').value);
        if (isNaN(n) || n < 3) return;

        const d = (n * (n - 3)) / 2;

        document.getElementById('pd-answer').textContent = d;
        
        let steps = `
            <div class="step-item"><span class="step-num">1</span><div><strong>Formula:</strong> D = n(n - 3) / 2</div></div>
            <div class="step-item"><span class="step-num">2</span><div><strong>Substitution:</strong> D = ${n}(${n} - 3) / 2</div></div>
            <div class="step-item"><span class="step-num">3</span><div><strong>Compute:</strong> D = ${n}(${n-3}) / 2 = ${n*(n-3)} / 2 = ${d}</div></div>
        `;
        document.getElementById('pd-steps-content').innerHTML = steps;
        
        drawPolygon(n);
        document.getElementById('pd-result-card').style.display = 'block';
    }

    function drawPolygon(n) {
        if (n > 50) return; // Limit drawing
        const svg = document.getElementById('pd-svg');
        svg.innerHTML = "";
        const center = 50; const radius = 40;
        const points = [];
        
        for (let i = 0; i < n; i++) {
            const angle = (i * 2 * Math.PI) / n - Math.PI / 2;
            const x = center + radius * Math.cos(angle);
            const y = center + radius * Math.sin(angle);
            points.push({x, y});
        }

        // Draw diagonals first
        for (let i = 0; i < n; i++) {
            for (let j = i + 2; j < n; j++) {
                if (i === 0 && j === n - 1) continue;
                const line = document.createElementNS("http://www.w3.org/2000/svg", "line");
                line.setAttribute("x1", points[i].x); line.setAttribute("y1", points[i].y);
                line.setAttribute("x2", points[j].x); line.setAttribute("y2", points[j].y);
                line.setAttribute("stroke", "rgba(245,158,11,0.3)"); line.setAttribute("stroke-width", "0.5");
                svg.appendChild(line);
            }
        }

        // Draw outline
        const poly = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
        poly.setAttribute("points", points.map(p => `${p.x},${p.y}`).join(' '));
        poly.setAttribute("fill", "none"); poly.setAttribute("stroke", "#f59e0b"); poly.setAttribute("stroke-width", "2");
        svg.appendChild(poly);
    }

    document.getElementById('pd-calculate').addEventListener('click', calculate);
    document.getElementById('pd-reset').addEventListener('click', () => {
        document.getElementById('pd-n').value = 6;
        document.getElementById('pd-result-card').style.display = 'none';
    });
    document.getElementById('pd-copy').addEventListener('click', function() {
        navigator.clipboard.writeText(document.getElementById('pd-result-card').innerText);
        this.innerHTML = 'Copied';
        setTimeout(() => this.innerHTML = '<i class="far fa-copy me-1"></i> Copy', 2000);
    });
    document.getElementById('pd-pdf').addEventListener('click', () => window.print());
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\polygon-diagonals-calculator.blade.php ENDPATH**/ ?>