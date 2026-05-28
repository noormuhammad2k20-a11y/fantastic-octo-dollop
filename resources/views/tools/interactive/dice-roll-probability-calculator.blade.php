<div class="row g-4 dice-prob-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Number of Dice</label>
                        <input type="number" id="dp-count" class="form-control form-control-lg" value="2" min="1" max="100">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Dice Type (Faces)</label>
                        <select id="dp-faces" class="form-select form-select-lg">
                            <option value="4">D4 (4 faces)</option>
                            <option value="6" selected>D6 (6 faces)</option>
                            <option value="8">D8 (8 faces)</option>
                            <option value="10">D10 (10 faces)</option>
                            <option value="12">D12 (12 faces)</option>
                            <option value="20">D20 (20 faces)</option>
                            <option value="100">D100 (100 faces)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Target Sum</label>
                        <input type="number" id="dp-target" class="form-control form-control-lg" value="7" min="1">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Condition</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-danger active flex-grow-1 cond-btn" data-cond="exact">Exactly</button>
                            <button type="button" class="btn btn-outline-danger flex-grow-1 cond-btn" data-cond="at_least">At Least (≥)</button>
                            <button type="button" class="btn btn-outline-danger flex-grow-1 cond-btn" data-cond="at_most">At Most (≤)</button>
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-danger py-3 px-5 fw-bold rounded-pill shadow-sm" id="dp-calc" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Calculate Probability
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="dp-output-card" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(239,68,68,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Probability</span>
                <div class="output-hero-value fs-1" id="dp-percentage">0.00%</div>
                <span class="output-hero-unit" id="dp-odds">1 in 0</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6">
                    <div class="p-3 bg-white border rounded-3 text-center h-100">
                        <div class="small text-muted mb-1 fw-bold text-uppercase">Winning Combinations</div>
                        <div class="fs-4 fw-black text-danger" id="dp-winning-combos">0</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 bg-white border rounded-3 text-center h-100">
                        <div class="small text-muted mb-1 fw-bold text-uppercase">Total Combinations</div>
                        <div class="fs-4 fw-black" id="dp-total-combos">0</div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-chart-bar me-2 text-danger"></i>Distribution Breakdown</h6>
                <div class="bg-white border rounded-3 p-3">
                    <div class="d-flex justify-content-between text-muted small mb-2 fw-bold">
                        <span>Sum</span>
                        <span>Probability</span>
                    </div>
                    <div id="dp-distribution" style="max-height: 250px; overflow-y: auto;">
                        <!-- Distribution bars -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.dice-prob-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.dice-prob-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.dice-prob-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.dice-prob-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.dice-prob-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.dice-prob-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}

.dist-row { display: flex; align-items: center; gap: 10px; margin-bottom: 6px; }
.dist-label { width: 40px; font-weight: 700; font-size: 0.9rem; text-align: right; }
.dist-bar-bg { flex-grow: 1; background: #f1f5f9; height: 12px; border-radius: 6px; overflow: hidden; }
.dist-bar-fill { height: 100%; background: #ef4444; border-radius: 6px; transition: width 0.5s ease; }
.dist-val { width: 60px; font-size: 0.85rem; font-weight: 600; text-align: left; }
.dist-highlight .dist-bar-fill { background: #10b981; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let condition = 'exact';

    document.querySelectorAll('.cond-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.cond-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            condition = this.dataset.cond;
        });
    });

    $('dp-calc').addEventListener('click', calculateProb);

    function calculateProb() {
        const n = parseInt($('dp-count').value) || 2;
        const faces = parseInt($('dp-faces').value) || 6;
        const target = parseInt($('dp-target').value) || 7;

        if (n > 100) {
            alert('Please limit to 100 dice to avoid browser freezing.');
            return;
        }

        // DP array to calculate probabilities
        // dp[i] = ways to get sum i
        let dp = new Array(n * faces + 1).fill(0);
        dp[0] = 1; // 0 dice = sum 0 (base case)

        for (let i = 1; i <= n; i++) {
            let nextDp = new Array(n * faces + 1).fill(0);
            for (let j = 1; j <= i * faces; j++) {
                for (let k = 1; k <= faces; k++) {
                    if (j - k >= 0) {
                        // Use BigInt for combinations to avoid JS number overflow for large n
                        nextDp[j] = (BigInt(nextDp[j] || 0) + BigInt(dp[j - k] || 0)).toString();
                    }
                }
            }
            dp = nextDp;
        }

        const totalCombos = faces ** n;
        // BigInt total
        let totalBig = 1n;
        for(let i=0; i<n; i++) totalBig *= BigInt(faces);

        let winningBig = 0n;
        const minSum = n;
        const maxSum = n * faces;

        for (let s = minSum; s <= maxSum; s++) {
            const val = BigInt(dp[s] || 0);
            if (condition === 'exact' && s === target) winningBig += val;
            if (condition === 'at_least' && s >= target) winningBig += val;
            if (condition === 'at_most' && s <= target) winningBig += val;
        }

        const prob = Number((Number(winningBig) / Number(totalBig)) * 100);
        let oddsTxt = '1 in ∞';
        if (winningBig > 0n) {
            const odds = Number(totalBig) / Number(winningBig);
            oddsTxt = odds > 1000 ? `1 in ${odds.toExponential(2)}` : `1 in ${odds.toFixed(2)}`;
        }

        $('dp-percentage').textContent = prob.toFixed(4) + '%';
        $('dp-odds').textContent = oddsTxt;
        $('dp-winning-combos').textContent = winningBig.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $('dp-total-combos').textContent = totalBig.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        // Render Distribution
        const distContainer = $('dp-distribution');
        distContainer.innerHTML = '';
        
        let maxProb = 0;
        const probs = [];
        for (let s = minSum; s <= maxSum; s++) {
            const p = Number((Number(dp[s] || 0) / Number(totalBig)) * 100);
            probs.push({ sum: s, prob: p });
            if (p > maxProb) maxProb = p;
        }

        // Filter out near-zero tails if array is huge
        const threshold = 0.001;
        const visibleProbs = probs.length > 50 ? probs.filter(p => p.prob >= threshold) : probs;

        visibleProbs.forEach(item => {
            const row = document.createElement('div');
            
            let isHighlight = false;
            if (condition === 'exact' && item.sum === target) isHighlight = true;
            if (condition === 'at_least' && item.sum >= target) isHighlight = true;
            if (condition === 'at_most' && item.sum <= target) isHighlight = true;

            row.className = `dist-row ${isHighlight ? 'dist-highlight' : ''}`;
            const width = maxProb > 0 ? (item.prob / maxProb * 100) : 0;
            
            row.innerHTML = `
                <div class="dist-label">${item.sum}</div>
                <div class="dist-bar-bg">
                    <div class="dist-bar-fill" style="width: ${width}%"></div>
                </div>
                <div class="dist-val">${item.prob.toFixed(2)}%</div>
            `;
            distContainer.appendChild(row);
        });

        $('dp-output-card').classList.remove('d-none');
        $('dp-output-card').scrollIntoView({ behavior: 'smooth' });
    }
});
</script>

