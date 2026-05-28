<div class="row g-4 venn-diagram-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Set A Name</label>
                        <input type="text" id="venn-label-a" class="form-control rounded-3" value="Set A">
                        <label class="form-label-custom mt-2">Elements (A)</label>
                        <textarea id="venn-set-a" class="form-control rounded-3" rows="3">1, 2, 3, 4</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Set B Name</label>
                        <input type="text" id="venn-label-b" class="form-control rounded-3" value="Set B">
                        <label class="form-label-custom mt-2">Elements (B)</label>
                        <textarea id="venn-set-b" class="form-control rounded-3" rows="3">3, 4, 5, 6</textarea>
                    </div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-generate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-sync me-2"></i>Generate Diagram
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>
                    
                    <button type="button" class="btn btn-secondary-action" id="btn-svg-export" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:45;--tool-color:#d97706;--tool-bg:rgba(245,158,11,.04);">
            <div class="venn-viz-container d-flex justify-content-center p-4 bg-white rounded-4 border shadow-sm mb-4">
                <svg id="venn-svg" width="500" height="300" viewBox="0 0 500 300">
                    <defs>
                        <filter id="shadow">
                            <feDropShadow dx="0" dy="2" stdDeviation="3" flood-opacity="0.1"/>
                        </filter>
                    </defs>
                    <!-- Circle A -->
                    <circle cx="200" cy="150" r="100" fill="rgba(59, 130, 246, 0.2)" stroke="#3b82f6" stroke-width="2" filter="url(#shadow)"/>
                    <!-- Circle B -->
                    <circle cx="300" cy="150" r="100" fill="rgba(239, 68, 68, 0.2)" stroke="#ef4444" stroke-width="2" filter="url(#shadow)"/>
                    
                    <!-- Labels -->
                    <text x="140" y="50" font-weight="bold" fill="#3b82f6" id="svg-label-a">Set A</text>
                    <text x="320" y="50" font-weight="bold" fill="#ef4444" id="svg-label-b">Set B</text>

                    <!-- Counts -->
                    <text x="150" y="155" text-anchor="middle" id="svg-count-a">0</text>
                    <text x="250" y="155" text-anchor="middle" font-weight="bold" id="svg-count-both">0</text>
                    <text x="350" y="155" text-anchor="middle" id="svg-count-b">0</text>
                </svg>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-card p-3 rounded-3 border bg-white text-center">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Only A</div>
                        <div class="fs-5 fw-bold text-primary" id="out-only-a">{}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-3 rounded-3 border bg-white text-center">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Intersection</div>
                        <div class="fs-5 fw-bold text-dark" id="out-both">{}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-3 rounded-3 border bg-white text-center">
                        <div class="small text-muted mb-1 text-uppercase fw-bold ls-1">Only B</div>
                        <div class="fs-5 fw-bold text-danger" id="out-only-b">{}</div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Mathematical Summary</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-summary" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Set Analysis
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function parseSet(str) {
        return new Set(str.split(/[\s,]+/).filter(x => x !== ''));
    }

    function generate() {
        const setA = parseSet($('venn-set-a').value);
        const setB = parseSet($('venn-set-b').value);
        const labelA = $('venn-label-a').value || 'Set A';
        const labelB = $('venn-label-b').value || 'Set B';

        const intersect = new Set([...setA].filter(x => setB.has(x)));
        const onlyA = new Set([...setA].filter(x => !setB.has(x)));
        const onlyB = new Set([...setB].filter(x => !setA.has(x)));

        // Update SVG
        $('svg-label-a').textContent = labelA;
        $('svg-label-b').textContent = labelB;
        $('svg-count-a').textContent = onlyA.size;
        $('svg-count-both').textContent = intersect.size;
        $('svg-count-b').textContent = onlyB.size;

        // Update Results
        $('out-only-a').textContent = onlyA.size ? Array.from(onlyA).join(', ') : '∅';
        $('out-both').textContent = intersect.size ? Array.from(intersect).join(', ') : '∅';
        $('out-only-b').textContent = onlyB.size ? Array.from(onlyB).join(', ') : '∅';

        let stepsHtml = `<ul>`;
        stepsHtml += `<li><b>Set A (|A|):</b> ${setA.size} elements</li>`;
        stepsHtml += `<li><b>Set B (|B|):</b> ${setB.size} elements</li>`;
        stepsHtml += `<li><b>Overlap (|A ∩ B|):</b> ${intersect.size} elements</li>`;
        stepsHtml += `<li><b>Total Unique Elements (|A ∪ B|):</b> ${setA.size + setB.size - intersect.size}</li>`;
        stepsHtml += `</ul>`;

        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    $('btn-generate').addEventListener('click', generate);
    $('btn-reset').addEventListener('click', () => {
        $('venn-set-a').value = '1, 2, 3, 4';
        $('venn-set-b').value = '3, 4, 5, 6';
        $('output-section').style.display = 'none';
    });

    $('btn-svg-export').addEventListener('click', () => {
        const svgData = $('venn-svg').outerHTML;
        const blob = new Blob([svgData], {type: 'image/svg+xml;charset=utf-8'});
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = 'venn-diagram.svg';
        link.click();
    });
});
</script>

<style>
.venn-diagram-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.venn-diagram-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.venn-diagram-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.venn-diagram-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.venn-diagram-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.venn-diagram-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

.quick-actions-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; }
.btn-primary-action { background: #1e293b; color: #fff; border: none; border-radius: 14px; padding: 1rem; font-weight: 700; transition: all 0.2s; }
.btn-primary-action:hover { background: #0f172a; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.btn-secondary-action { background: #f1f5f9; color: #475569; border: none; border-radius: 14px; padding: 1rem; font-weight: 600; transition: all 0.2s; }
.btn-secondary-action:hover { background: #e2e8f0; color: #1e293b; }

@media (max-width: 768px) {
    .quick-actions-grid { grid-template-columns: 1fr 1fr; }
    .btn-primary-action { grid-column: span 2; }
}

.output-card-themed { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; margin-top: 2rem; }
.venn-viz-container { overflow: visible; }
.venn-viz-container svg { max-width: 100%; height: auto; }
</style>

