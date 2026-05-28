<div class="interactive-tool-grid cgpa-to-percentage">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Enter CGPA</label>
                <input type="number" id="input-cgpa" class="form-control-custom" placeholder="e.g. 8.5" step="0.01" min="0" max="100">
            </div>

            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Select Maximum GPA Scale</label>
                <select id="max-gpa" class="form-control-custom">
                    <option value="10.0">10.0 Scale (Most Universities)</option>
                    <option value="4.0">4.0 Scale (US Standard)</option>
                    <option value="5.0">5.0 Scale</option>
                    <option value="7.0">7.0 Scale</option>
                </select>
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> <strong>Formula:</strong> (CGPA / Max GPA) × 100
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Percentage Equivalent</span>
            <div class="result-main-value" id="result-percentage">0.00%</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">CGPA</span>
                    <span class="stat-value" id="stat-cgpa">0.0</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Scale</span>
                    <span class="stat-value" id="stat-scale">10.0</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputCgpa = document.getElementById('input-cgpa');
    const maxGpa = document.getElementById('max-gpa');
    const resultPercentage = document.getElementById('result-percentage');
    const statCgpa = document.getElementById('stat-cgpa');
    const statScale = document.getElementById('stat-scale');

    function calculate() {
        const cgpa = parseFloat(inputCgpa.value) || 0;
        const scale = parseFloat(maxGpa.value);
        
        const percentage = scale > 0 ? ((cgpa / scale) * 100).toFixed(2) : "0.00";
        
        resultPercentage.innerText = percentage + "%";
        statCgpa.innerText = cgpa.toFixed(1);
        statScale.innerText = scale.toFixed(1);
    }

    inputCgpa.addEventListener('input', calculate);
    maxGpa.addEventListener('change', calculate);

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `CGPA to Percentage Conversion:\nCGPA: ${statCgpa.innerText} (Scale: ${statScale.innerText})\nPercentage: ${resultPercentage.innerText}\nCalculated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { btn.innerHTML = originalText; }, 2000);
        });
    });

    calculate();
});
</script>

