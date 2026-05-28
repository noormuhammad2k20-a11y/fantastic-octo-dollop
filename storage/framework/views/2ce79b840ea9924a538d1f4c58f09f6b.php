<div class="row g-4 prime-checker-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 10px 40px rgba(139, 92, 246, 0.08);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-purple" style="background: linear-gradient(135deg, #8b5cf6, #5b21b6); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-hashtag"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#2e1065; letter-spacing: -0.5px;">Primality Intelligence</h4>
                    <p class="text-muted small mb-0">Discover if a number is prime, find its factors, and explore nearby primes instantly.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="p-4 rounded-4 bg-light-purple border-purple-100 border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50 text-purple">Enter Number</h6>
                            <div class="row g-3">
                                <div class="col-md-9">
                                    <input type="number" id="v-input" class="form-control form-control-lg border-0 bg-white shadow-sm rounded-3 fw-black h1 mb-0 py-3" value="13">
                                </div>
                                <div class="col-md-3">
                                    <div class="vstack gap-2 h-100">
                                        <button class="btn btn-purple h-100 fw-bold rounded-3 shadow-sm" id="random-num" style="min-width: 280px; max-width: 100%;">Random</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 263; --tool-color: #8b5cf6; --tool-bg: rgba(139, 92, 246, .04);">
            <div class="p-4">
                <div class="row g-4">
                    
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 bg-white border shadow-sm h-100 text-center d-flex flex-column justify-content-center">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Verdict</h6>
                            <div id="status-badge" class="display-5 fw-black mb-2 text-success">PRIME</div>
                            <div class="text-muted small fw-bold uppercase" id="out-desc">Only divisible by 1 and itself.</div>
                        </div>
                    </div>

                    
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-white border shadow-sm h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Detailed Intelligence</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="p-3 bg-light rounded-3 text-center">
                                        <span class="small fw-bold opacity-50 uppercase">Factors Found</span>
                                        <div class="h4 fw-black mb-0 text-dark" id="out-factors">2</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 bg-light rounded-3 text-center">
                                        <span class="small fw-bold opacity-50 uppercase">Nearest Prime</span>
                                        <div class="h4 fw-black mb-0 text-dark" id="out-near">11, 17</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-3 bg-light rounded-3">
                                        <span class="small fw-bold opacity-50 uppercase mb-2 d-block">All Divisors</span>
                                        <div class="text-truncate fw-bold text-purple" id="out-list">1, 13</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="p-4 bg-white border-top rounded-bottom-5">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button class="btn btn-purple rounded-pill px-4 fw-bold text-white shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-copy me-2"></i>Copy Intelligence
                        </button>
                        <button class="btn btn-outline-secondary rounded-pill px-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-undo me-2"></i>Reset
                        </button>
                    </div>
                    <div class="text-muted small fw-bold uppercase">
                        Method: <span class="text-purple">Trial Division Algorithm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('v-input');
    const statusBadge = document.getElementById('status-badge');
    const outDesc = document.getElementById('out-desc');
    const outFactors = document.getElementById('out-factors');
    const outNear = document.getElementById('out-near');
    const outList = document.getElementById('out-list');

    function isPrime(n) {
        if (n <= 1) return false;
        if (n <= 3) return true;
        if (n % 2 === 0 || n % 3 === 0) return false;
        for (let i = 5; i * i <= n; i += 6) {
            if (n % i === 0 || n % (i + 2) === 0) return false;
        }
        return true;
    }

    function getFactors(n) {
        let factors = [];
        for (let i = 1; i <= Math.sqrt(n); i++) {
            if (n % i === 0) {
                factors.push(i);
                if (i !== n / i) factors.push(n / i);
            }
        }
        return factors.sort((a, b) => a - b);
    }

    function findNearest(n) {
        let low = n - 1;
        while (low > 1 && !isPrime(low)) low--;
        let high = n + 1;
        while (!isPrime(high)) high++;
        return [low > 1 ? low : null, high];
    }

    function check() {
        const n = parseInt(input.value);
        if (isNaN(n)) return;
        
        if (n < 0) {
            statusBadge.textContent = "INVALID";
            statusBadge.className = "display-5 fw-black mb-2 text-danger";
            return;
        }

        const prime = isPrime(n);
        const factors = getFactors(n);
        const nearest = findNearest(n);

        if (prime) {
            statusBadge.textContent = "PRIME";
            statusBadge.className = "display-5 fw-black mb-2 text-success animate__animated animate__pulse";
            outDesc.textContent = "Only divisible by 1 and itself.";
        } else {
            statusBadge.textContent = "COMPOSITE";
            statusBadge.className = "display-5 fw-black mb-2 text-warning";
            outDesc.textContent = `Divisible by ${factors.length} numbers.`;
        }

        outFactors.textContent = factors.length;
        outList.textContent = factors.join(', ');
        outNear.textContent = nearest.filter(x => x !== null).join(', ');
    }

    input.addEventListener('input', check);

    document.getElementById('random-num').addEventListener('click', () => {
        input.value = Math.floor(Math.random() * 1000) + 1;
        check();
    });

    document.getElementById('reset-calc').addEventListener('click', () => {
        input.value = 13;
        check();
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `Number Theory Report: ${input.value}\nStatus: ${statusBadge.textContent}\nFactors: ${outList.textContent}\nNearest Primes: ${outNear.textContent}`;
        navigator.clipboard.writeText(text).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

    check();
});
</script>

<style>
.prime-checker-rebuilt .form-label-custom { font-size:.7rem; font-weight:900; text-transform:uppercase; letter-spacing:1px; color:#8b5cf6; opacity:.7; margin-bottom:8px; display:block; }
.bg-light-purple { background-color: #f5f3ff; }
.border-purple-100 { border-color: #ede9fe !important; }
.fw-black { font-weight: 900; }
.uppercase { text-transform: uppercase; }

.btn-purple { background: #8b5cf6; color: #fff; border: none; }
.btn-purple:hover { background: #7c3aed; }

.pulse-purple { animation: purple-pulse 3s infinite; }
@keyframes purple-pulse {
    0% { box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.4); }
    70% { box-shadow: 0 0 0 15px rgba(139, 92, 246, 0); }
    100% { box-shadow: 0 0 0 0 rgba(139, 92, 246, 0); }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\is-it-a-prime-number.blade.php ENDPATH**/ ?>