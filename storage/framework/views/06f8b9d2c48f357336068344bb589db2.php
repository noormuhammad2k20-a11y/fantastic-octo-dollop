<div class="row g-4 random-picker-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Enter Choices (One per line)</label>
                    <textarea id="picker-choices" class="form-control" rows="8" placeholder="Pizza&#10;Burger&#10;Sushi&#10;Pasta&#10;Salad"></textarea>
                    <div class="mt-2 d-flex justify-content-between align-items-center">
                        <span class="small text-muted" id="choice-count">0 options detected</span>
                        <button class="btn btn-link btn-sm text-decoration-none p-0" id="load-sample" style="min-width: 280px; max-width: 100%;">Load Sample</button>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Number of Items to Pick</label>
                        <input type="number" id="pick-count" class="form-control form-control-lg" value="1" min="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Pick Mode</label>
                        <select id="pick-mode" class="form-select form-select-lg">
                            <option value="unique">Unique Winners (No duplicates)</option>
                            <option value="allow-duplicates">Allow Duplicates</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-primary py-3 px-5 fw-bold rounded-pill shadow-sm" id="pick-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-random me-2"></i>Pick Random Winner(s)
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="picker-output-card" style="--tool-hue:210;--tool-color:#2563eb;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">The Winner is</span>
                <div class="output-hero-value fs-2" id="picker-winner">Result</div>
                <span class="output-hero-unit" id="picker-stats">Selected from list</span>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2 text-primary"></i>All Selected Items</h6>
                <div id="picker-results-grid" class="d-flex flex-wrap gap-2">
                    <!-- Results here -->
                </div>
            </div>
            
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-dark flex-grow-1 py-3 fw-bold rounded-3" id="copy-results" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Results
                </button>
                <button class="btn btn-outline-dark px-4 py-3 fw-bold rounded-3" id="clear-picker" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.random-picker-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.random-picker-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.random-picker-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.random-picker-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.random-picker-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.random-picker-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}

.winner-pill {
    background: white;
    border: 2px solid #3b82f6;
    color: #1d4ed8;
    padding: 10px 20px;
    border-radius: 12px;
    font-weight: 800;
    font-size: 1.1rem;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    animation: winner-pop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

@keyframes winner-pop {
    0% { transform: scale(0.5); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    $('picker-choices').addEventListener('input', updateCount);
    $('load-sample').addEventListener('click', () => {
        $('picker-choices').value = "Alice\nBob\nCharlie\nDavid\nEve\nFrank\nGrace\nHeidi";
        updateCount();
    });

    function updateCount() {
        const list = $('picker-choices').value.split('\n').filter(s => s.trim().length > 0);
        $('choice-count').textContent = `${list.length} options detected`;
    }

    $('pick-btn').addEventListener('click', pickWinners);
    $('clear-picker').addEventListener('click', () => {
        $('picker-output-card').classList.add('d-none');
    });

    function pickWinners() {
        const list = $('picker-choices').value.split('\n').map(s => s.trim()).filter(s => s.length > 0);
        if (list.length === 0) {
            alert('Please enter some options first.');
            return;
        }

        const count = Math.min(parseInt($('pick-count').value) || 1, 1000);
        const mode = $('pick-mode').value;
        const results = [];
        
        if (mode === 'unique' && count > list.length) {
            alert(`You requested ${count} unique winners, but only have ${list.length} options.`);
            return;
        }

        const workingList = [...list];
        for (let i = 0; i < count; i++) {
            const idx = Math.floor(Math.random() * workingList.length);
            results.push(workingList[idx]);
            if (mode === 'unique') {
                workingList.splice(idx, 1);
            }
        }

        $('picker-winner').textContent = results.length === 1 ? results[0] : `${results[0]} & ${results.length - 1} others`;
        $('picker-stats').textContent = `Randomly selected from ${list.length} items`;
        
        const grid = $('picker-results-grid');
        grid.innerHTML = '';
        results.forEach(res => {
            const pill = document.createElement('div');
            pill.className = 'winner-pill';
            pill.textContent = res;
            grid.appendChild(pill);
        });

        $('picker-output-card').classList.remove('d-none');
        $('picker-output-card').scrollIntoView({ behavior: 'smooth' });
    }

    $('copy-results').addEventListener('click', function() {
        const pills = document.querySelectorAll('.winner-pill');
        const text = Array.from(pills).map(p => p.textContent).join(', ');
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\random-picker.blade.php ENDPATH**/ ?>