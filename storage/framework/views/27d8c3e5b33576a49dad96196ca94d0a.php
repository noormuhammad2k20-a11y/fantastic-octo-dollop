<div class="row g-4 dice-roller-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Number of Dice</label>
                        <input type="number" id="dice-count" class="form-control form-control-lg" value="1" min="1" max="100">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Dice Type</label>
                        <select id="dice-type" class="form-select form-select-lg">
                            <option value="4">D4 (Tetrahedron)</option>
                            <option value="6" selected>D6 (Standard Cube)</option>
                            <option value="8">D8 (Octahedron)</option>
                            <option value="10">D10 (Decahedron)</option>
                            <option value="12">D12 (Dodecahedron)</option>
                            <option value="20">D20 (Icosahedron)</option>
                            <option value="100">D100 (Percentage)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Modifier (+/-)</label>
                        <input type="number" id="dice-mod" class="form-control form-control-lg" value="0">
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-danger py-3 px-5 fw-bold rounded-pill shadow-sm" id="roll-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-dice-three me-2"></i>Roll Dice
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(239,68,68,.04);">
            <div id="dice-visual-container" class="dice-visual-grid mb-4">
                <!-- Visual dice will be injected here -->
            </div>

            <div class="output-hero">
                <span class="output-hero-label">Total Result</span>
                <div class="output-hero-value" id="roll-total">0</div>
                <span class="output-hero-unit" id="roll-formula">Roll to start</span>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-history me-2 text-secondary"></i>Roll History</span>
                    <button class="btn btn-link btn-sm p-0 text-decoration-none" id="clear-history" style="min-width: 280px; max-width: 100%;">Clear</button>
                </h6>
                <div id="history-container" class="history-list d-flex flex-column gap-2">
                    <!-- History rows -->
                </div>
            </div>
            
            <button class="btn btn-outline-dark w-100 mt-4" id="copy-history" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy History
            </button>
        </div>
    </div>
</div>

<style>
.dice-roller-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.dice-roller-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.dice-roller-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.dice-roller-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.dice-roller-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.dice-roller-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}

.dice-visual-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: center;
}

.die-box {
    width: 60px;
    height: 60px;
    background: white;
    border: 2px solid #ef4444;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 900;
    color: #ef4444;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    animation: die-pop 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

@keyframes die-pop {
    0% { transform: scale(0) rotate(-45deg); opacity: 0; }
    100% { transform: scale(1) rotate(0); opacity: 1; }
}

.history-list {
    max-height: 200px;
    overflow-y: auto;
}
.history-row {
    padding: 8px 12px;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 0.9rem;
    display: flex;
    justify-content: space-between;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let history = [];

    $('roll-btn').addEventListener('click', rollDice);
    $('clear-history').addEventListener('click', () => {
        history = [];
        $('history-container').innerHTML = '';
        $('roll-total').textContent = '0';
        $('roll-formula').textContent = 'Roll to start';
        $('dice-visual-container').innerHTML = '';
    });

    function rollDice() {
        const count = parseInt($('dice-count').value) || 1;
        const type = parseInt($('dice-type').value) || 6;
        const mod = parseInt($('dice-mod').value) || 0;
        
        const rolls = [];
        let sum = 0;
        
        for (let i = 0; i < count; i++) {
            const r = Math.floor(Math.random() * type) + 1;
            rolls.push(r);
            sum += r;
        }
        
        const total = sum + mod;
        const formula = `${count}D${type}${mod >= 0 ? '+' : ''}${mod}`;
        
        $('roll-total').textContent = total;
        $('roll-formula').textContent = formula;
        
        renderDice(rolls);
        
        const historyItem = {
            formula: formula,
            rolls: rolls,
            total: total,
            time: new Date().toLocaleTimeString()
        };
        history.unshift(historyItem);
        renderHistory();
    }

    function renderDice(rolls) {
        const container = $('dice-visual-container');
        container.innerHTML = '';
        
        // Limit visual dice to 50 to avoid lag
        rolls.slice(0, 50).forEach(val => {
            const die = document.createElement('div');
            die.className = 'die-box';
            die.textContent = val;
            container.appendChild(die);
        });
        
        if (rolls.length > 50) {
            const more = document.createElement('div');
            more.className = 'die-box border-dashed opacity-50';
            more.textContent = '+';
            container.appendChild(more);
        }
    }

    function renderHistory() {
        const container = $('history-container');
        container.innerHTML = '';
        history.slice(0, 20).forEach(item => {
            const row = document.createElement('div');
            row.className = 'history-row mb-2';
            row.innerHTML = `
                <span class="text-muted small">${item.time}</span>
                <span class="fw-bold">${item.formula}</span>
                <span class="text-secondary small">(${item.rolls.join(', ')})</span>
                <span class="fw-black text-danger">${item.total}</span>
            `;
            container.appendChild(row);
        });
    }

    $('copy-history').addEventListener('click', function() {
        if (history.length === 0) return;
        const text = history.map(h => `${h.time}: ${h.formula} -> ${h.total} (${h.rolls.join(', ')})`).join('\n');
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\dice-roller.blade.php ENDPATH**/ ?>