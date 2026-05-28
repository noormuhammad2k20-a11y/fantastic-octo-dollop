<div class="row g-4 lottery-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Game Type</label>
                        <select id="lotto-game" class="form-select form-select-lg">
                            <option value="powerball" selected>Powerball (US)</option>
                            <option value="mega">Mega Millions (US)</option>
                            <option value="euro">EuroMillions (EU)</option>
                            <option value="custom">Custom Game</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Number of Tickets</label>
                        <input type="number" id="lotto-count" class="form-control form-control-lg" value="1" min="1" max="100">
                    </div>
                </div>

                <div id="custom-lotto-panel" class="row g-3 mt-1 d-none p-3 bg-light border rounded-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Pick how many Main Numbers?</label>
                        <input type="number" id="custom-main-pick" class="form-control" value="5" min="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Main Numbers Pool (1 to X)</label>
                        <input type="number" id="custom-main-pool" class="form-control" value="69" min="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Pick how many Bonus Numbers?</label>
                        <input type="number" id="custom-bonus-pick" class="form-control" value="1" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Bonus Numbers Pool (1 to X)</label>
                        <input type="number" id="custom-bonus-pool" class="form-control" value="26" min="1">
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-warning fw-bold text-dark py-3 px-5 fw-bold rounded-pill shadow-sm"" id="lotto-generate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-magic me-2"></i>Generate Tickets
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="lotto-output-card" style="--tool-hue:40;--tool-color:#d97706;--tool-bg:rgba(245,158,11,.04);">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="fw-bold mb-0"><i class="fas fa-star me-2" style="color:#d97706"></i>Your Lucky Tickets</h5>
                <button class="btn btn-sm btn-outline-dark" id="copy-lotto" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i>Copy All</button>
            </div>
            
            <div id="lotto-tickets-container" class="d-flex flex-column gap-3">
                <!-- Tickets injected here -->
            </div>
        </div>
    </div>
</div>

<style>
.lottery-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.lottery-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.lottery-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.lottery-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.lottery-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.lottery-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}

.lotto-ticket {
    background: white;
    border: 2px dashed #cbd5e1;
    border-radius: 12px;
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
}
.lotto-ball {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: #f1f5f9;
    color: #0f172a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 1.1rem;
    border: 2px solid #cbd5e1;
    box-shadow: inset -2px -2px 5px rgba(0,0,0,0.05);
}
.lotto-ball-bonus {
    background: #fef3c7;
    border-color: #f59e0b;
    color: #b45309;
}
.ticket-number { font-weight: 700; color: #64748b; font-size: 0.9rem; min-width: 80px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    $('lotto-game').addEventListener('change', function() {
        if(this.value === 'custom') {
            $('custom-lotto-panel').classList.remove('d-none');
        } else {
            $('custom-lotto-panel').classList.add('d-none');
        }
    });

    const games = {
        powerball: { mainPick: 5, mainPool: 69, bonusPick: 1, bonusPool: 26 },
        mega: { mainPick: 5, mainPool: 70, bonusPick: 1, bonusPool: 25 },
        euro: { mainPick: 5, mainPool: 50, bonusPick: 2, bonusPool: 12 }
    };

    // Crypto secure random
    function getSecureRandom(min, max) {
        const range = max - min + 1;
        const bytesNeeded = Math.ceil(Math.log2(range) / 8);
        const maxNum = Math.pow(256, bytesNeeded);
        const array = new Uint8Array(bytesNeeded);
        
        let randomValue;
        do {
            window.crypto.getRandomValues(array);
            randomValue = 0;
            for (let i = 0; i < bytesNeeded; i++) {
                randomValue = (randomValue << 8) + array[i];
            }
        } while (randomValue >= maxNum - (maxNum % range));
        
        return min + (randomValue % range);
    }

    function generateSet(pick, pool) {
        const set = new Set();
        while(set.size < pick) {
            set.add(getSecureRandom(1, pool));
        }
        return Array.from(set).sort((a,b) => a-b);
    }

    $('lotto-generate').addEventListener('click', function() {
        const game = $('lotto-game').value;
        const count = parseInt($('lotto-count').value) || 1;
        
        let config;
        if (game === 'custom') {
            config = {
                mainPick: parseInt($('custom-main-pick').value) || 5,
                mainPool: parseInt($('custom-main-pool').value) || 69,
                bonusPick: parseInt($('custom-bonus-pick').value) || 0,
                bonusPool: parseInt($('custom-bonus-pool').value) || 26
            };
        } else {
            config = games[game];
        }

        if (config.mainPick > config.mainPool || config.bonusPick > config.bonusPool) {
            alert('Picks cannot be greater than the pool size.');
            return;
        }

        const container = $('lotto-tickets-container');
        container.innerHTML = '';
        const allTextData = [];

        for(let i=0; i<count; i++) {
            const mainNumbers = generateSet(config.mainPick, config.mainPool);
            const bonusNumbers = generateSet(config.bonusPick, config.bonusPool);
            
            allTextData.push(`Ticket ${i+1}: ` + mainNumbers.join(' ') + (bonusNumbers.length ? ' | ' + bonusNumbers.join(' ') : ''));

            const ticket = document.createElement('div');
            ticket.className = 'lotto-ticket';
            
            let html = `<div class="ticket-number">Ticket #${i+1}</div>`;
            
            mainNumbers.forEach(n => {
                html += `<div class="lotto-ball">${n}</div>`;
            });
            
            if (bonusNumbers.length > 0) {
                html += `<div style="width: 2px; background: #e2e8f0; height: 30px; margin: 0 5px;"></div>`;
                bonusNumbers.forEach(n => {
                    html += `<div class="lotto-ball lotto-ball-bonus">${n}</div>`;
                });
            }
            
            ticket.innerHTML = html;
            container.appendChild(ticket);
        }

        container.dataset.raw = allTextData.join('\n');
        $('lotto-output-card').classList.remove('d-none');
        $('lotto-output-card').scrollIntoView({ behavior: 'smooth' });
    });

    $('copy-lotto').addEventListener('click', function() {
        const text = $('lotto-tickets-container').dataset.raw;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });
});
</script>

