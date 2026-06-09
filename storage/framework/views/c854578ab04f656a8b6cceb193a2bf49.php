<div class="row g-4 prime-checker-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 10px 40px rgba(139, 92, 246, 0.08);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-purple" style="background: linear-gradient(135deg, #8b5cf6, #5b21b6); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0;">
                    <i class="fas fa-hashtag"></i>
                </div>
                <div class="ms-3 header-text-container">
                    <h4 class="fw-bold mb-0" style="color:#2e1065; letter-spacing: -0.5px;">Primality Intelligence</h4>
                    <p class="text-muted small mb-0">Discover if a number is prime, find its factors, and explore nearby primes instantly.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="p-4 rounded-4 bg-light-purple border-purple-100 border">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 gap-2">
                        <h6 class="fw-bold small uppercase opacity-50 text-purple mb-0">Enter Numbers to Check</h6>
                        <button class="btn btn-sm btn-purple fw-bold rounded-pill px-3 shadow-sm" id="random-num">
                            <i class="fas fa-dice me-1"></i> Randomize All
                        </button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="number" id="v-input-1" class="form-control form-control-lg border-0 bg-white shadow-sm rounded-3 fw-black h3 text-center mb-0 py-3" value="13" placeholder="Num 1">
                        </div>
                        <div class="col-md-4">
                            <input type="number" id="v-input-2" class="form-control form-control-lg border-0 bg-white shadow-sm rounded-3 fw-black h3 text-center mb-0 py-3" value="24" placeholder="Num 2">
                        </div>
                        <div class="col-md-4">
                            <input type="number" id="v-input-3" class="form-control form-control-lg border-0 bg-white shadow-sm rounded-3 fw-black h3 text-center mb-0 py-3" value="37" placeholder="Num 3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 263; --tool-color: #8b5cf6; --tool-bg: rgba(139, 92, 246, .04);">
            <div class="p-4 pb-0">
                <div class="row g-4 mb-4">
                    <!-- Result 1 -->
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-white border shadow-sm h-100 d-flex flex-column" id="result-card-1">
                            <div class="text-center mb-3">
                                <h6 class="fw-bold small uppercase opacity-50 mb-1">Result 1</h6>
                                <div id="status-badge-1" class="fs-3 fw-black mb-1 text-success">PRIME</div>
                                <div class="text-muted small fw-bold uppercase" id="out-desc-1" style="font-size: 0.75rem;">Only divisible by 1 and itself.</div>
                            </div>
                            <div class="mt-auto">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="p-2 bg-light rounded-3 text-center h-100 d-flex flex-column justify-content-center">
                                            <span class="fw-bold opacity-50 uppercase" style="font-size: 0.65rem;">Factors</span>
                                            <div class="h5 fw-black mb-0 text-dark" id="out-factors-1">2</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-2 bg-light rounded-3 text-center h-100 d-flex flex-column justify-content-center">
                                            <span class="fw-bold opacity-50 uppercase" style="font-size: 0.65rem;">Nearest Prime</span>
                                            <div class="h5 fw-black mb-0 text-dark" id="out-near-1">11, 17</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-2 bg-light rounded-3 text-center">
                                            <span class="fw-bold opacity-50 uppercase mb-1 d-block" style="font-size: 0.65rem;">All Divisors</span>
                                            <div class="text-truncate fw-bold text-purple" style="font-size: 0.85rem;" id="out-list-1">1, 13</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Result 2 -->
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-white border shadow-sm h-100 d-flex flex-column" id="result-card-2">
                            <div class="text-center mb-3">
                                <h6 class="fw-bold small uppercase opacity-50 mb-1">Result 2</h6>
                                <div id="status-badge-2" class="fs-3 fw-black mb-1 text-success">PRIME</div>
                                <div class="text-muted small fw-bold uppercase" id="out-desc-2" style="font-size: 0.75rem;">Only divisible by 1 and itself.</div>
                            </div>
                            <div class="mt-auto">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="p-2 bg-light rounded-3 text-center h-100 d-flex flex-column justify-content-center">
                                            <span class="fw-bold opacity-50 uppercase" style="font-size: 0.65rem;">Factors</span>
                                            <div class="h5 fw-black mb-0 text-dark" id="out-factors-2">2</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-2 bg-light rounded-3 text-center h-100 d-flex flex-column justify-content-center">
                                            <span class="fw-bold opacity-50 uppercase" style="font-size: 0.65rem;">Nearest Prime</span>
                                            <div class="h5 fw-black mb-0 text-dark" id="out-near-2">11, 17</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-2 bg-light rounded-3 text-center">
                                            <span class="fw-bold opacity-50 uppercase mb-1 d-block" style="font-size: 0.65rem;">All Divisors</span>
                                            <div class="text-truncate fw-bold text-purple" style="font-size: 0.85rem;" id="out-list-2">1, 13</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Result 3 -->
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 bg-white border shadow-sm h-100 d-flex flex-column" id="result-card-3">
                            <div class="text-center mb-3">
                                <h6 class="fw-bold small uppercase opacity-50 mb-1">Result 3</h6>
                                <div id="status-badge-3" class="fs-3 fw-black mb-1 text-success">PRIME</div>
                                <div class="text-muted small fw-bold uppercase" id="out-desc-3" style="font-size: 0.75rem;">Only divisible by 1 and itself.</div>
                            </div>
                            <div class="mt-auto">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="p-2 bg-light rounded-3 text-center h-100 d-flex flex-column justify-content-center">
                                            <span class="fw-bold opacity-50 uppercase" style="font-size: 0.65rem;">Factors</span>
                                            <div class="h5 fw-black mb-0 text-dark" id="out-factors-3">2</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-2 bg-light rounded-3 text-center h-100 d-flex flex-column justify-content-center">
                                            <span class="fw-bold opacity-50 uppercase" style="font-size: 0.65rem;">Nearest Prime</span>
                                            <div class="h5 fw-black mb-0 text-dark" id="out-near-3">11, 17</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-2 bg-light rounded-3 text-center">
                                            <span class="fw-bold opacity-50 uppercase mb-1 d-block" style="font-size: 0.65rem;">All Divisors</span>
                                            <div class="text-truncate fw-bold text-purple" style="font-size: 0.85rem;" id="out-list-3">1, 13</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="p-4 bg-white border-top rounded-bottom-5">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                        <button class="btn btn-purple rounded-pill px-4 py-2 fw-bold text-white shadow-sm" id="copy-result">
                            <i class="fas fa-copy me-2"></i> Copy Intelligence
                        </button>
                        <button class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-bold" id="reset-calc">
                            <i class="fas fa-undo me-2"></i> Reset
                        </button>
                    </div>
                    <div class="text-muted small fw-bold uppercase text-center">
                        Method: <span class="text-purple">Trial Division</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const inputs = [
        document.getElementById('v-input-1'),
        document.getElementById('v-input-2'),
        document.getElementById('v-input-3')
    ];

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

    function checkIndex(index) {
        const input = inputs[index];
        const val = input.value.trim();
        const statusBadge = document.getElementById('status-badge-' + (index + 1));
        const outDesc = document.getElementById('out-desc-' + (index + 1));
        const outFactors = document.getElementById('out-factors-' + (index + 1));
        const outNear = document.getElementById('out-near-' + (index + 1));
        const outList = document.getElementById('out-list-' + (index + 1));

        if (!val) {
            statusBadge.textContent = "WAITING";
            statusBadge.className = "fs-3 fw-black mb-1 text-muted";
            outDesc.textContent = "Enter a number";
            outFactors.textContent = "-";
            outNear.textContent = "-";
            outList.textContent = "-";
            return;
        }

        const n = parseInt(val);
        if (isNaN(n) || n < 0) {
            statusBadge.textContent = "INVALID";
            statusBadge.className = "fs-3 fw-black mb-1 text-danger";
            outDesc.textContent = "Enter valid positive integer";
            outFactors.textContent = "-";
            outNear.textContent = "-";
            outList.textContent = "-";
            return;
        }

        const prime = isPrime(n);
        const factors = getFactors(n);
        const nearest = findNearest(n);

        if (prime) {
            statusBadge.textContent = "PRIME";
            statusBadge.className = "fs-3 fw-black mb-1 text-success animate__animated animate__pulse";
            outDesc.textContent = "Divisible only by 1 and itself.";
        } else {
            statusBadge.textContent = "COMPOSITE";
            statusBadge.className = "fs-3 fw-black mb-1 text-warning";
            outDesc.textContent = `Divisible by ${factors.length} numbers.`;
        }

        outFactors.textContent = factors.length;
        outList.textContent = factors.join(', ');
        outNear.textContent = nearest.filter(x => x !== null).join(', ');
    }

    function checkAll() {
        checkIndex(0);
        checkIndex(1);
        checkIndex(2);
    }

    inputs.forEach((input, i) => {
        input.addEventListener('input', () => checkIndex(i));
    });

    document.getElementById('random-num').addEventListener('click', () => {
        inputs.forEach(input => {
            input.value = Math.floor(Math.random() * 1000) + 1;
        });
        checkAll();
    });

    document.getElementById('reset-calc').addEventListener('click', () => {
        inputs[0].value = 13;
        inputs[1].value = 24;
        inputs[2].value = 37;
        checkAll();
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        let text = "Number Theory Report:\n";
        inputs.forEach((input, i) => {
            if(input.value) {
                const status = document.getElementById('status-badge-' + (i+1)).textContent;
                const factors = document.getElementById('out-list-' + (i+1)).textContent;
                const nearest = document.getElementById('out-near-' + (i+1)).textContent;
                text += `\nNumber: ${input.value}\nStatus: ${status}\nFactors: ${factors}\nNearest Primes: ${nearest}\n`;
            }
        });
        navigator.clipboard.writeText(text).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

    checkAll();
});
</script>

<style>
.prime-checker-rebuilt .form-label-custom { font-size:.7rem; font-weight:900; text-transform:uppercase; letter-spacing:1px; color:#8b5cf6; opacity:.7; margin-bottom:8px; display:block; }
.bg-light-purple { background-color: #f5f3ff; }
.border-purple-100 { border-color: #ede9fe !important; }
.fw-black { font-weight: 900; }
.uppercase { text-transform: uppercase; }

.btn-purple { background: #8b5cf6; color: #fff; border: none; transition: all 0.2s ease; }
.btn-purple:hover { background: #7c3aed; color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3) !important; }

.pulse-purple { animation: purple-pulse 3s infinite; }
@keyframes purple-pulse {
    0% { box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.4); }
    70% { box-shadow: 0 0 0 15px rgba(139, 92, 246, 0); }
    100% { box-shadow: 0 0 0 0 rgba(139, 92, 246, 0); }
}

/* Responsive adjustments */
@media (max-width: 767.98px) {
    .calculator-header { flex-direction: column; text-align: center; }
    .calculator-header .tool-icon-circle { margin-bottom: 1rem; }
    .calculator-header .ms-3 { margin-left: 0 !important; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/tools/interactive/is-it-a-prime-number.blade.php ENDPATH**/ ?>