<div class="row g-4 shoelace-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Polygon Vertices</label>
                    <div id="vertices-container" class="d-flex flex-column gap-2 mb-3">
                        <!-- Points will be added here -->
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" id="add-vertex" style="min-width: 280px; max-width: 100%;"><i class="fas fa-plus me-1"></i> Add Vertex</button>
                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" id="reset-vertices" style="min-width: 280px; max-width: 100%;"><i class="fas fa-undo me-1"></i> Reset</button>
                    </div>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Calculation Precision</label>
                        <select id="precision-sel" class="form-select form-select-lg rounded-3">
                            <option value="2">2 Decimal Places</option>
                            <option value="4">4 Decimal Places</option>
                            <option value="6">6 Decimal Places</option>
                            <option value="0">Whole Numbers</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Coordinate Format</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-brackets-curly"></i></span>
                            <input type="text" class="form-control form-control-lg" placeholder="e.g. (0,0), (4,0), (4,3)" id="bulk-input">
                        </div>
                        <small class="text-muted">Or paste coordinates here</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:245;--tool-color:#4f46e5;--tool-bg:rgba(99,102,241,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Calculated Polygon Area</span>
                <div class="output-hero-value" id="out-area">0</div>
                <span class="output-hero-unit">Square Units</span>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2 text-primary"></i>Step-by-Step Mathematical Solution</h6>
                <div class="bg-white p-4 rounded-4 border shadow-sm">
                    <div id="math-steps" class="small text-secondary">
                        Enter at least 3 vertices to see the calculation steps.
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-solution" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Solution</button>
                </div>
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="download-output" style="min-width: 280px; max-width: 100%;"><i class="fas fa-download me-2"></i>Download Result</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const container = $('vertices-container');
    let vertexCount = 0;

    function createVertexRow(x = 0, y = 0) {
        vertexCount++;
        const row = document.createElement('div');
        row.className = 'vertex-row d-flex gap-2 align-items-center animate__animated animate__fadeIn';
        row.innerHTML = `
            <span class="text-muted fw-bold small" style="width:25px">P${vertexCount}</span>
            <div class="input-group input-group-sm">
                <span class="input-group-text">X</span>
                <input type="number" class="form-control v-x" value="${x}" step="any">
            </div>
            <div class="input-group input-group-sm">
                <span class="input-group-text">Y</span>
                <input type="number" class="form-control v-y" value="${y}" step="any">
            </div>
            <button class="btn btn-link text-danger p-0 remove-v" title="Remove"><i class="fas fa-times-circle"></i></button>
        `;
        container.appendChild(row);
        
        row.querySelectorAll('input').forEach(i => i.addEventListener('input', calculate));
        row.querySelector('.remove-v').addEventListener('click', () => {
            if (document.querySelectorAll('.vertex-row').length > 3) {
                row.remove();
                reindexVertices();
                calculate();
            }
        });
    }

    function reindexVertices() {
        vertexCount = 0;
        document.querySelectorAll('.vertex-row').forEach((row, i) => {
            vertexCount++;
            row.querySelector('.text-muted').textContent = `P${vertexCount}`;
        });
    }

    function calculate() {
        const rows = document.querySelectorAll('.vertex-row');
        const points = Array.from(rows).map(r => ({
            x: parseFloat(r.querySelector('.v-x').value) || 0,
            y: parseFloat(r.querySelector('.v-y').value) || 0
        }));

        if (points.length < 3) {
            $('out-area').textContent = '0';
            $('math-steps').innerHTML = 'Need at least 3 vertices for a polygon.';
            return;
        }

        const precision = parseInt($('precision-sel').value);
        let n = points.length;
        let sum1 = 0;
        let sum2 = 0;
        let stepLines = [];

        stepLines.push(`<strong>1. List coordinates:</strong>`);
        let coordsTable = '<table class="table table-sm table-bordered mt-2 text-center"><thead><tr><th>Point</th><th>X</th><th>Y</th></tr></thead><tbody>';
        points.forEach((p, i) => {
            coordsTable += `<tr><td>P${i+1}</td><td>${p.x}</td><td>${p.y}</td></tr>`;
        });
        // Repeat first point
        coordsTable += `<tr class="table-info"><td>P1 (rep)</td><td>${points[0].x}</td><td>${points[0].y}</td></tr>`;
        coordsTable += '</tbody></table>';
        stepLines.push(coordsTable);

        stepLines.push(`<strong>2. Apply Shoelace Formula:</strong>`);
        stepLines.push(`Area = ½ | (x₁y₂ + x₂y₃ + ... + xₙy₁) - (y₁x₂ + y₂x₃ + ... + yₙx₁) |`);

        let part1Str = [];
        let part2Str = [];

        for (let i = 0; i < n; i++) {
            let j = (i + 1) % n;
            let val1 = points[i].x * points[j].y;
            let val2 = points[i].y * points[j].x;
            sum1 += val1;
            sum2 += val2;
            part1Str.push(`(${points[i].x} × ${points[j].y})`);
            part2Str.push(`(${points[i].y} × ${points[j].x})`);
        }

        let area = Math.abs(sum1 - sum2) / 2;
        
        stepLines.push(`<div class="mt-2">Σ(xᵢyᵢ₊₁) = ${part1Str.join(' + ')} = <strong>${sum1.toFixed(precision)}</strong></div>`);
        stepLines.push(`<div class="mt-1">Σ(yᵢxᵢ₊₁) = ${part2Str.join(' + ')} = <strong>${sum2.toFixed(precision)}</strong></div>`);
        stepLines.push(`<div class="mt-3">Area = ½ | ${sum1.toFixed(precision)} - ${sum2.toFixed(precision)} |</div>`);
        stepLines.push(`Area = ½ | ${(sum1 - sum2).toFixed(precision)} | = <strong>${area.toFixed(precision)}</strong>`);

        $('out-area').textContent = area.toFixed(precision);
        $('math-steps').innerHTML = stepLines.join('<br>');
    }

    $('add-vertex').addEventListener('click', () => {
        createVertexRow();
        calculate();
    });

    $('reset-vertices').addEventListener('click', () => {
        container.innerHTML = '';
        vertexCount = 0;
        initPoints();
        calculate();
    });

    $('precision-sel').addEventListener('change', calculate);

    $('bulk-input').addEventListener('input', function() {
        const val = this.value;
        const regex = /(-?\d+\.?\d*)\s*,\s*(-?\d+\.?\d*)/g;
        let match;
        const newPoints = [];
        while ((match = regex.exec(val)) !== null) {
            newPoints.push({x: parseFloat(match[1]), y: parseFloat(match[2])});
        }
        if (newPoints.length >= 3) {
            container.innerHTML = '';
            vertexCount = 0;
            newPoints.forEach(p => createVertexRow(p.x, p.y));
            calculate();
        }
    });

    $('copy-solution').addEventListener('click', function() {
        const area = $('out-area').textContent;
        const text = `Shoelace Formula Calculation\nArea: ${area} Square Units\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

    $('download-output').addEventListener('click', () => {
        const content = document.querySelector('.shoelace-calc-rebuilt').innerText;
        const blob = new Blob([content], {type: 'text/plain'});
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'polygon-area-calculation.txt';
        a.click();
    });

    function initPoints() {
        createVertexRow(0, 0);
        createVertexRow(4, 0);
        createVertexRow(4, 3);
        createVertexRow(0, 3);
    }

    initPoints();
    calculate();
});
</script>

<style>
.shoelace-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.shoelace-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.shoelace-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.shoelace-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.shoelace-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.shoelace-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }
.vertex-row { border-bottom: 1px dashed #e2e8f0; padding-bottom: 0.5rem; }
.vertex-row:last-child { border-bottom: none; }
.remove-v { font-size: 1.2rem; transition: transform 0.2s; }
.remove-v:hover { transform: scale(1.1); color: #dc3545 !important; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>

