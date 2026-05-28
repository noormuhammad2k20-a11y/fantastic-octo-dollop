<div class="interactive-tool-grid square-foot-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div id="rooms-container">
                <div class="room-block mb-3 p-4 border rounded shadow-sm bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="mb-0 fw-bold">Room 1</h6>
                        <button type="button" class="btn btn-link btn-sm link-danger p-0 remove-room" style="min-width: 280px; max-width: 100%; display:none;" title="Remove Room">
                            <i class="fas fa-times-circle fa-lg"></i>
                        </button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-custom">Length (ft)</label>
                            <input type="number" class="form-control-custom length-input" value="12" step="0.1">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Width (ft)</label>
                            <input type="number" class="form-control-custom width-input" value="10" step="0.1">
                        </div>
                    </div>
                    <div class="mt-3 text-end">
                        <span class="text-muted small">Room Area: <span class="room-area fw-bold text-dark">120</span> sq ft</span>
                    </div>
                </div>
            </div>
            
            <button type="button" class="btn d-block mx-auto btn-outline-accent mt-2 py-3 px-5 fw-bold rounded-pill shadow-sm" id="add-room" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-plus-circle me-1"></i> Add Another Room
            </button>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Total Square Footage</span>
            <div class="result-main-value" id="total-sqft">120</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Square Meters</span>
                    <span class="stat-value" id="total-sqm">11.15</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Rooms</span>
                    <span class="stat-value" id="rooms-count">1</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-sqft" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Results
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('rooms-container');
    const totalDisplay = document.getElementById('total-sqft');
    const sqmDisplay = document.getElementById('total-sqm');
    const countDisplay = document.getElementById('rooms-count');

    function calculate() {
        let grandTotal = 0;
        let count = 0;

        document.querySelectorAll('.room-block').forEach(block => {
            count++;
            const l = parseFloat(block.querySelector('.length-input').value) || 0;
            const w = parseFloat(block.querySelector('.width-input').value) || 0;
            const area = l * w;
            block.querySelector('.room-area').innerText = area.toFixed(1);
            grandTotal += area;
        });

        totalDisplay.innerText = grandTotal.toFixed(1);
        sqmDisplay.innerText = (grandTotal * 0.092903).toFixed(2);
        countDisplay.innerText = count;

        const removeBtns = document.querySelectorAll('.remove-room');
        removeBtns.forEach(btn => btn.style.display = count > 1 ? 'block' : 'none');
    }

    document.getElementById('add-room').addEventListener('click', function() {
        const index = document.querySelectorAll('.room-block').length + 1;
        const div = document.createElement('div');
        div.className = 'room-block mb-3 p-4 border rounded shadow-sm bg-white';
        div.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="mb-0 fw-bold">Room ${index}</h6>
                <button type="button" class="btn btn-link btn-sm link-danger p-0 remove-room"><i class="fas fa-times-circle fa-lg"></i></button>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label-custom">Length (ft)</label>
                    <input type="number" class="form-control-custom length-input" value="10" step="0.1">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Width (ft)</label>
                    <input type="number" class="form-control-custom width-input" value="10" step="0.1">
                </div>
            </div>
            <div class="mt-3 text-end">
                <span class="text-muted small">Room Area: <span class="room-area fw-bold text-dark">100</span> sq ft</span>
            </div>
        `;
        container.appendChild(div);
        calculate();
    });

    container.addEventListener('click', function(e) {
        if (e.target.closest('.remove-room')) {
            e.target.closest('.room-block').remove();
            calculate();
        }
    });

    container.addEventListener('input', calculate);

    document.getElementById('copy-sqft').addEventListener('click', function() {
        const text = `Area Estimate:\nTotal Square Feet: ${totalDisplay.innerText}\nTotal Square Meters: ${sqmDisplay.innerText}\nRooms: ${countDisplay.innerText}\nCalculated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const orig = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { btn.innerHTML = orig; }, 2000);
        });
    });

    calculate();
});
</script>

