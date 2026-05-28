<div class="row g-4 inequalities-grapher-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3">Inequality 1</h6>
                        <div class="d-flex gap-2 align-items-center">
                            <span class="fs-5">y</span>
                            <select id="ineq1-op" class="form-select w-auto">
                                <option value="gt">></option>
                                <option value="ge">≥</option>
                                <option value="lt"><</option>
                                <option value="le">≤</option>
                            </select>
                            <input type="number" id="ineq1-m" class="form-control text-center" value="1" style="width:70px">
                            <span>x +</span>
                            <input type="number" id="ineq1-b" class="form-control text-center" value="0" style="width:70px">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3">Inequality 2</h6>
                        <div class="d-flex gap-2 align-items-center">
                            <span class="fs-5">y</span>
                            <select id="ineq2-op" class="form-select w-auto">
                                <option value="lt"><</option>
                                <option value="le" selected>≤</option>
                                <option value="gt">></option>
                                <option value="ge">≥</option>
                            </select>
                            <input type="number" id="ineq2-m" class="form-control text-center" value="-1" style="width:70px">
                            <span>x +</span>
                            <input type="number" id="ineq2-b" class="form-control text-center" value="4" style="width:70px">
                        </div>
                    </div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-draw-polygon me-2"></i>Graph Feasible Region
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:140;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="text-center bg-white p-4 rounded-3 border mb-4">
                <canvas id="graphCanvas" width="500" height="500" class="img-fluid border rounded shadow-sm" style="max-width: 100%; height: auto;"></canvas>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const canvas = $('graphCanvas');
    const ctx = canvas.getContext('2d');

    function draw() {
        const m1 = parseFloat($('ineq1-m').value);
        const b1 = parseFloat($('ineq1-b').value);
        const op1 = $('ineq1-op').value;
        
        const m2 = parseFloat($('ineq2-m').value);
        const b2 = parseFloat($('ineq2-b').value);
        const op2 = $('ineq2-op').value;

        const width = canvas.width;
        const height = canvas.height;
        const scale = 25; // pixels per unit
        const originX = width / 2;
        const originY = height / 2;

        ctx.clearRect(0, 0, width, height);

        // Draw grid
        ctx.strokeStyle = '#e2e8f0';
        ctx.lineWidth = 1;
        for (let x = 0; x <= width; x += scale) {
            ctx.beginPath(); ctx.moveTo(x, 0); ctx.lineTo(x, height); ctx.stroke();
        }
        for (let y = 0; y <= height; y += scale) {
            ctx.beginPath(); ctx.moveTo(0, y); ctx.lineTo(width, y); ctx.stroke();
        }

        // Draw axes
        ctx.strokeStyle = '#64748b';
        ctx.lineWidth = 2;
        ctx.beginPath(); ctx.moveTo(0, originY); ctx.lineTo(width, originY); ctx.stroke();
        ctx.beginPath(); ctx.moveTo(originX, 0); ctx.lineTo(originX, height); ctx.stroke();

        // Shading
        ctx.fillStyle = 'rgba(16, 185, 129, 0.2)';
        for (let px = 0; px < width; px += 2) {
            for (let py = 0; py < height; py += 2) {
                const x = (px - originX) / scale;
                const y = -(py - originY) / scale; // Flip y for canvas

                const val1 = m1 * x + b1;
                const val2 = m2 * x + b2;

                let ok1 = false, ok2 = false;
                if (op1 === 'gt') ok1 = y > val1;
                else if (op1 === 'ge') ok1 = y >= val1;
                else if (op1 === 'lt') ok1 = y < val1;
                else if (op1 === 'le') ok1 = y <= val1;

                if (op2 === 'gt') ok2 = y > val2;
                else if (op2 === 'ge') ok2 = y >= val2;
                else if (op2 === 'lt') ok2 = y < val2;
                else if (op2 === 'le') ok2 = y <= val2;

                if (ok1 && ok2) ctx.fillRect(px, py, 2, 2);
            }
        }

        // Draw lines
        function drawLine(m, b, color, dashed) {
            ctx.strokeStyle = color;
            ctx.lineWidth = 2;
            if (dashed) ctx.setLineDash([5, 5]); else ctx.setLineDash([]);
            
            ctx.beginPath();
            const xMin = -originX / scale;
            const xMax = (width - originX) / scale;
            ctx.moveTo(0, originY - (m * xMin + b) * scale);
            ctx.lineTo(width, originY - (m * xMax + b) * scale);
            ctx.stroke();
        }

        drawLine(m1, b1, '#3b82f6', op1 === 'gt' || op1 === 'lt');
        drawLine(m2, b2, '#ef4444', op2 === 'gt' || op2 === 'lt');

        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    $('btn-calculate').addEventListener('click', draw);
});
</script>

<style>
.inequalities-grapher-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.quick-actions-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; }
.btn-primary-action { background: #1e293b; color: #fff; border: none; border-radius: 14px; padding: 1rem; font-weight: 700; transition: all 0.2s; }
.output-card-themed { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; margin-top: 2rem; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\system-inequalities-grapher.blade.php ENDPATH**/ ?>