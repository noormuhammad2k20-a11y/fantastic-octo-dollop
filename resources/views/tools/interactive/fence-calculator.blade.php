<div class="interactive-tool-grid fence-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Total Fence Length (feet)</label>
                <input type="number" id="fence-length" class="form-control-custom fence-in" value="100">
            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label-custom">Post Spacing (ft)</label>
                    <input type="number" id="post-spacing" class="form-control-custom fence-in" value="8">
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label-custom">Picket Width (in)</label>
                    <input type="number" id="picket-width" class="form-control-custom fence-in" value="5.5">
                </div>
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> Calculation includes 1 extra post for the end.
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Fence Posts Needed</span>
            <div class="result-main-value" id="result-posts">14</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Pickets</span>
                    <span class="stat-value" id="stat-pickets">218</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Rails (8ft)</span>
                    <span class="stat-value" id="stat-rails">26</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Material List
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const length = parseFloat(document.getElementById('fence-length').value) || 0;
        const pSpace = parseFloat(document.getElementById('post-spacing').value) || 8;
        const pWidth = parseFloat(document.getElementById('picket-width').value) || 5.5;

        if (length > 0) {
            const posts = Math.ceil(length / pSpace) + 1;
            const pickets = Math.ceil((length * 12) / (pWidth + 0.5)); // 0.5" gap
            const rails = Math.ceil(length / 8) * 2; // Assuming 2 rails per 8ft section

            document.getElementById('result-posts').innerText = posts;
            document.getElementById('stat-pickets').innerText = pickets;
            document.getElementById('stat-rails').innerText = rails;
        } else {
            document.getElementById('result-posts').innerText = "0";
        }
    }

    document.querySelectorAll('.fence-in').forEach(el => {
        el.addEventListener('input', calculate);
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `Fence Material Estimate:\nLength: ${document.getElementById('fence-length').value} ft\nPosts: ${document.getElementById('result-posts').innerText}\nPickets: ${document.getElementById('stat-pickets').innerText}\nRails: ${document.getElementById('stat-rails').innerText}\nCalculated via ToolsHub Construction.`;
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

