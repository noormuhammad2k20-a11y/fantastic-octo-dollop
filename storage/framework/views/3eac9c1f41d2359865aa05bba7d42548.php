<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                <div class="col-12">
                    <label class="form-label-custom">Enter Numbers</label>
                    <textarea class="form-control-v2" id="sort-input" rows="4" placeholder="e.g. 50, 12, 89, 1, 34">50, 12, 89, 1, 34</textarea>
                </div>
                <div class="col-md-6 mt-4">
                    <label class="form-label-custom">Order Direction</label>
                    <select class="form-select-v2" id="sort-dir">
                        <option value="asc">Ascending (Smallest to Largest)</option>
                        <option value="desc">Descending (Largest to Smallest)</option>
                    </select>
                </div>
                <div class="col-md-6 mt-4">
                    <label class="form-label-custom">Options</label>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="sort-unique">
                        <label class="form-check-label text-secondary small fw-bold" for="sort-unique">Remove Duplicates</label>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <button class="btn btn-primary rounded-pill px-5 py-2 fw-bold" id="sort-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-sort me-2"></i> Sort Dataset
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card tool-card-stacked shadow-sm border-0" id="sort-result-card" style="display: none;">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981">
                        <i class="fas fa-check"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-dark">Sorted Results</h5>
                </div>
                <div class="header-actions">
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2" id="sort-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-copy me-1"></i> Copy List
                    </button>
                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3" id="sort-pdf" style="min-width: 280px; max-width: 100%;">
                        <i class="far fa-file-pdf me-1"></i> PDF
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="p-4 rounded-4 bg-light border font-monospace text-break" id="sort-output" style="font-size: 1.1rem; line-height: 1.8;">
                <!-- Result here -->
            </div>
            <div class="mt-4 p-3 rounded-4 bg-white border d-flex gap-4">
                <div class="small"><strong>Total Count:</strong> <span id="sort-count">0</span></div>
                <div class="small"><strong>Unique Count:</strong> <span id="sort-u-count">0</span></div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label-custom { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 0.5rem; display: block; }
    .form-control-v2, .form-select-v2 { border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 0.6rem 0.75rem; font-size: 1.1rem; color: #1e293b; width: 100%; transition: all 0.2s; font-weight: 600; }
    .form-control-v2:focus, .form-select-v2:focus { border-color: #3b82f6; box-shadow: 0 0 0 4px rgba(59,130,246,0.1); outline: none; }
    @media print {
        .card:not(#sort-result-card), .header-actions, .header-v2, footer, nav, .sidebar { display: none !important; }
        .card#sort-result-card { border: none !important; box-shadow: none !important; margin: 0 !important; width: 100% !important; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const raw = document.getElementById('sort-input').value;
        let nums = raw.split(/[,\s\n]+/).map(n => parseFloat(n)).filter(n => !isNaN(n));
        
        if (nums.length === 0) return;

        const totalCount = nums.length;
        const uniqueSet = new Set(nums);
        const uniqueCount = uniqueSet.size;

        if (document.getElementById('sort-unique').checked) {
            nums = Array.from(uniqueSet);
        }

        const dir = document.getElementById('sort-dir').value;
        nums.sort((a, b) => dir === 'asc' ? a - b : b - a);

        document.getElementById('sort-output').textContent = nums.join(', ');
        document.getElementById('sort-count').textContent = totalCount;
        document.getElementById('sort-u-count').textContent = uniqueCount;
        document.getElementById('sort-result-card').style.display = 'block';
    }

    document.getElementById('sort-calculate').addEventListener('click', calculate);
    document.getElementById('sort-reset').addEventListener('click', () => {
        document.getElementById('sort-input').value = "50, 12, 89, 1, 34";
        document.getElementById('sort-result-card').style.display = 'none';
    });
    document.getElementById('sort-copy').addEventListener('click', function() {
        navigator.clipboard.writeText(document.getElementById('sort-output').textContent);
        this.innerHTML = 'Copied';
        setTimeout(() => this.innerHTML = '<i class="far fa-copy me-1"></i> Copy List', 2000);
    });
    document.getElementById('sort-pdf').addEventListener('click', () => window.print());
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\sort-numbers-calculator.blade.php ENDPATH**/ ?>