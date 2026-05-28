<div class="row g-4 coin-flipper-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Side 1 Label (Heads)</label>
                        <input type="text" id="label-heads" class="form-control form-control-lg" value="Heads">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Side 2 Label (Tails)</label>
                        <input type="text" id="label-tails" class="form-control form-control-lg" value="Tails">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Number of Flips: <span id="flip-count-val">1</span></label>
                        <input type="range" id="flip-count" class="form-range" min="1" max="100" value="1">
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-warning fw-bold text-dark py-3 px-5 fw-bold rounded-pill shadow-sm"" id="flip-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-sync-alt me-2"></i>Flip Coin
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:45;--tool-color:#a16207;--tool-bg:rgba(250,204,21,.04);">
            <div class="coin-container" id="coin-visual">
                <div class="coin" id="coin-element">
                    <div class="side heads">H</div>
                    <div class="side tails">T</div>
                </div>
            </div>

            <div class="output-hero mt-4">
                <span class="output-hero-label">Last Result</span>
                <div class="output-hero-value" id="flip-result">-</div>
                <span class="output-hero-unit" id="flip-stats">Ready to flip</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3">
                    <div class="p-3 bg-white border rounded-3 text-center">
                        <div class="small text-muted text-uppercase fw-bold mb-1">Total</div>
                        <div class="h4 mb-0 fw-black" id="stat-total">0</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 bg-white border rounded-3 text-center">
                        <div class="small text-muted text-uppercase fw-bold mb-1">Heads</div>
                        <div class="h4 mb-0 fw-black text-primary" id="stat-heads">0</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 bg-white border rounded-3 text-center">
                        <div class="small text-muted text-uppercase fw-bold mb-1">Tails</div>
                        <div class="h4 mb-0 fw-black text-danger" id="stat-tails">0</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 bg-white border rounded-3 text-center">
                        <div class="small text-muted text-uppercase fw-bold mb-1">Ratio</div>
                        <div class="h4 mb-0 fw-black" id="stat-ratio">0%</div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-history me-2 text-secondary"></i>Flip History</span>
                    <button class="btn btn-link btn-sm p-0 text-decoration-none" id="clear-history" style="min-width: 280px; max-width: 100%;">Clear</button>
                </h6>
                <div class="history-list d-flex flex-wrap gap-2" id="history-container">
                    <!-- History pills -->
                </div>
            </div>
            
            <button class="btn btn-outline-dark w-100 mt-4" id="copy-history" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Results
            </button>
        </div>
    </div>
</div>

<style>
.coin-flipper-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.coin-flipper-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.coin-flipper-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.coin-flipper-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.coin-flipper-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.coin-flipper-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}

/* Coin Animation */
.coin-container {
    perspective: 1000px;
    width: 120px;
    height: 120px;
    margin: 0 auto;
}
.coin {
    width: 100%;
    height: 100%;
    position: relative;
    transition: transform 1.5s ease-out;
    transform-style: preserve-3d;
}
.coin .side {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    font-weight: 900;
    backface-visibility: hidden;
    border: 8px solid rgba(0,0,0,0.1);
}
.heads {
    background: linear-gradient(135deg, #fbbf24 0%, #d97706 100%);
    color: #78350f;
    transform: rotateY(0deg);
}
.tails {
    background: linear-gradient(135deg, #94a3b8 0%, #475569 100%);
    color: #1e293b;
    transform: rotateY(180deg);
}

.history-list {
    max-height: 120px;
    overflow-y: auto;
    padding: 5px;
}
.result-pill {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
}
.pill-heads { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
.pill-tails { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let headsCount = 0;
    let tailsCount = 0;
    let history = [];

    $('flip-count').addEventListener('input', function() {
        $('flip-count-val').textContent = this.value;
    });

    $('flip-btn').addEventListener('click', flipCoin);
    $('clear-history').addEventListener('click', clearHistory);

    function flipCoin() {
        const count = parseInt($('flip-count').value);
        const headsLabel = $('label-heads').value || 'Heads';
        const tailsLabel = $('label-tails').value || 'Tails';
        const coin = $('coin-element');
        
        // Single flip animation if count is 1
        if (count === 1) {
            const result = Math.random() < 0.5 ? 'heads' : 'tails';
            const rotation = result === 'heads' ? 3600 : 3780; // 10 or 10.5 full rotations
            
            coin.style.transition = 'transform 1s ease-out';
            coin.style.transform = `rotateY(${rotation}deg)`;
            
            setTimeout(() => {
                processResult(result, headsLabel, tailsLabel);
                // Reset rotation for next time without transition
                setTimeout(() => {
                    coin.style.transition = 'none';
                    coin.style.transform = result === 'heads' ? 'rotateY(0deg)' : 'rotateY(180deg)';
                }, 100);
            }, 1000);
        } else {
            // Bulk flip
            for (let i = 0; i < count; i++) {
                const result = Math.random() < 0.5 ? 'heads' : 'tails';
                processResult(result, headsLabel, tailsLabel, true);
            }
            updateStats();
            $('flip-result').textContent = 'Batch Flip';
            $('flip-stats').textContent = `${count} coins tossed`;
        }
    }

    function processResult(result, hLabel, tLabel, isBulk = false) {
        if (result === 'heads') headsCount++; else tailsCount++;
        const label = result === 'heads' ? hLabel : tLabel;
        history.unshift({ result, label });
        
        if (!isBulk) {
            $('flip-result').textContent = label;
            $('flip-stats').textContent = result.toUpperCase();
            updateStats();
        }
        
        renderHistory();
    }

    function updateStats() {
        const total = headsCount + tailsCount;
        $('stat-total').textContent = total;
        $('stat-heads').textContent = headsCount;
        $('stat-tails').textContent = tailsCount;
        $('stat-ratio').textContent = total > 0 ? Math.round((headsCount / total) * 100) + '%' : '0%';
    }

    function renderHistory() {
        const container = $('history-container');
        container.innerHTML = '';
        history.slice(0, 50).forEach(item => {
            const pill = document.createElement('span');
            pill.className = `result-pill pill-${item.result}`;
            pill.textContent = item.label;
            container.appendChild(pill);
        });
    }

    function clearHistory() {
        headsCount = 0;
        tailsCount = 0;
        history = [];
        updateStats();
        renderHistory();
        $('flip-result').textContent = '-';
        $('flip-stats').textContent = 'Ready to flip';
    }

    $('copy-history').addEventListener('click', function() {
        if (history.length === 0) return;
        const text = `Coin Flip Results\nTotal: ${headsCount + tailsCount}\nHeads: ${headsCount}\nTails: ${tailsCount}\nHistory: ${history.map(h => h.label).join(', ')}`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\coin-flipper.blade.php ENDPATH**/ ?>