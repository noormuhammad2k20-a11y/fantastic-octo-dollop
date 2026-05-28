<div class="interactive-tool-grid racine-carree-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Entrez un nombre</label>
                <input type="number" id="input-num" class="form-control-custom" placeholder="e.g. 144" step="any" min="0">
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> <strong>Astuce:</strong> √x est le nombre qui, multiplié par lui-même, donne x.
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Résultat (√x)</span>
            <div class="result-main-value" id="result-sqrt">0</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Carré</span>
                    <span class="stat-value" id="stat-square">0</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Type</span>
                    <span class="stat-value" id="stat-type">--</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copier le résultat
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputNum = document.getElementById('input-num');
    const resultSqrt = document.getElementById('result-sqrt');

    function calculate() {
        const val = parseFloat(inputNum.value);
        if (isNaN(val) || val < 0) {
            resultSqrt.innerText = "Error";
            return;
        }

        const res = Math.sqrt(val);
        resultSqrt.innerText = res % 1 === 0 ? res : res.toFixed(4);
        document.getElementById('stat-square').innerText = val;
        document.getElementById('stat-type').innerText = res % 1 === 0 ? "Parfait" : "Décimal";
    }

    inputNum.addEventListener('input', calculate);

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `Calcul de Racine Carrée:\nNombre: ${inputNum.value}\nRacine: ${resultSqrt.innerText}\nCalculé via ToolsHub Math.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copié!';
            setTimeout(() => { btn.innerHTML = originalText; }, 2000);
        });
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\racine-carree-calculator.blade.php ENDPATH**/ ?>