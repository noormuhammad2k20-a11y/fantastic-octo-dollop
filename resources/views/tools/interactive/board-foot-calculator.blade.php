<div class="interactive-tool-grid board-foot-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label-custom">Thickness (in)</label>
                    <input type="number" id="thickness" class="form-control-custom" placeholder="e.g. 1" step="0.25" min="0">
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label-custom">Width (in)</label>
                    <input type="number" id="width" class="form-control-custom" placeholder="e.g. 6" step="0.25" min="0">
                </div>
            </div>

            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Length (ft)</label>
                <input type="number" id="length" class="form-control-custom" placeholder="e.g. 8" step="0.1" min="0">
            </div>

            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Number of Pieces</label>
                <input type="number" id="pieces" class="form-control-custom" value="1" min="1">
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Total Board Feet</span>
            <div class="result-main-value" id="result-bf">0.00</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Per Piece</span>
                    <span class="stat-value" id="stat-per-piece">0.00</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Volume (cu in)</span>
                    <span class="stat-value" id="stat-volume">0.00</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Data
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const thicknessIn = document.getElementById('thickness');
    const widthIn = document.getElementById('width');
    const lengthFt = document.getElementById('length');
    const piecesIn = document.getElementById('pieces');
    const resultBf = document.getElementById('result-bf');
    const statPerPiece = document.getElementById('stat-per-piece');
    const statVolume = document.getElementById('stat-volume');

    function calculateBoardFoot() {
        const t = parseFloat(thicknessIn.value) || 0;
        const w = parseFloat(widthIn.value) || 0;
        const l = parseFloat(lengthFt.value) || 0;
        const p = parseInt(piecesIn.value) || 0;

        // Board foot formula: (Thickness (in) × Width (in) × Length (ft)) / 12
        const bfPerPiece = (t * w * l) / 12;
        const totalBf = bfPerPiece * p;
        const volumeCuIn = (t * w * (l * 12)) * p;

        resultBf.innerText = totalBf.toFixed(2);
        statPerPiece.innerText = bfPerPiece.toFixed(2);
        statVolume.innerText = volumeCuIn.toFixed(0);
    }

    [thicknessIn, widthIn, lengthFt, piecesIn].forEach(el => {
        el.addEventListener('input', calculateBoardFoot);
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `Lumber Board Foot Estimate:\nTotal Board Feet: ${resultBf.innerText}\nPieces: ${piecesIn.value}\nVolume: ${statVolume.innerText} cu in\nCalculated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { btn.innerHTML = originalText; }, 2000);
        });
    });
});
</script>

