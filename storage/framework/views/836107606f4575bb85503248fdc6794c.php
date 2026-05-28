<div class="row g-4 saturn-return-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Birth Date</label>
                        <input type="date" id="saturn-ret-date" class="form-control form-control-lg rounded-3" value="1995-01-01">
                        <span class="text-muted small">Your date of birth to calculate the Saturn cycle.</span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Current Location</label>
                        <input type="text" id="saturn-ret-loc" class="form-control form-control-lg rounded-3" placeholder="City, Country" value="London, UK">
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Years:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 saturn-ret-quick" data-date="1980-01-01">Born 1980</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 saturn-ret-quick" data-date="1990-01-01">Born 1990</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 saturn-ret-quick" data-date="2000-01-01">Born 2000</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="saturn-ret-output-card" style="--tool-hue:215;--tool-color:#334155;--tool-bg:rgba(51,65,85,.04);transition:all .4s">
            <div class="output-hero text-center p-4">
                <span class="output-hero-label d-block text-uppercase small fw-bold text-muted mb-2">Next Saturn Return</span>
                <div class="output-hero-value fw-black text-dark mb-1" id="saturn-ret-out-date" style="font-size:3rem">Oct 2024</div>
                <div class="output-hero-unit text-secondary small" id="saturn-ret-out-countdown">In 5 Months, 12 Days</div>
            </div>

            <div class="row g-3 mt-4 text-center">
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-white border shadow-sm">
                        <span class="d-block small fw-bold text-muted text-uppercase mb-1">Cycle</span>
                        <div class="fw-bold text-dark" id="saturn-ret-out-cycle">First Return</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-white border shadow-sm">
                        <span class="d-block small fw-bold text-muted text-uppercase mb-1">Theme</span>
                        <div class="fw-bold text-dark" id="saturn-ret-out-theme">Adulthood</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-white border shadow-sm">
                        <span class="d-block small fw-bold text-muted text-uppercase mb-1">Status</span>
                        <div class="fw-bold text-dark" id="saturn-ret-out-status">Approaching</div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-hourglass-half me-2 text-primary"></i>The Saturnian Window</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-borderless small mb-0">
                        <thead class="text-muted">
                            <tr>
                                <th>Return Cycle</th>
                                <th>Expected Window</th>
                                <th>Key Lesson</th>
                            </tr>
                        </thead>
                        <tbody id="saturn-ret-out-table">
                            <!-- Rows injected here -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4" id="saturn-ret-out-analysis">
                <!-- Analysis injected here -->
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="saturn-ret-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Saturn Report</button>
        </div>
    </div>
</div>

<style>
.saturn-return-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.saturn-return-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.saturn-return-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.saturn-return-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.saturn-return-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.saturn-return-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.saturn-return-calc-rebuilt .leading-relaxed{line-height:1.6}
.saturn-return-calc-rebuilt .bg-primary-soft { background-color: rgba(99,102,241,.08); }
.saturn-return-calc-rebuilt .fw-black { font-weight: 900; }
</style>

<script>
(function() {
    function initSaturnReturnCalculator() {
        const dateEl = document.getElementById('saturn-ret-date');
        const locEl = document.getElementById('saturn-ret-loc');
        const resultCard = document.getElementById('saturn-ret-output-card');

        if (!dateEl || !locEl || !resultCard) return;

        const SATURN_ORBIT = 29.457; // years

        function getReturnWindows(birthDateStr) {
            const birth = new Date(birthDateStr);
            const returns = [];
            const themes = ["Foundation & Maturity", "Wisdom & Legacy", "Spirituality & Closure"];
            const lessons = ["Real responsibility", "Life mastery", "Spiritual harvest"];

            for(let i=1; i<=3; i++) {
                const centerDate = new Date(birth.getTime());
                centerDate.setFullYear(birth.getFullYear() + Math.round(i * SATURN_ORBIT));
                
                const start = new Date(centerDate.getTime());
                start.setFullYear(centerDate.getFullYear() - 1);
                
                const end = new Date(centerDate.getTime());
                end.setFullYear(centerDate.getFullYear() + 1);

                returns.push({
                    cycle: i,
                    center: centerDate,
                    start: start,
                    end: end,
                    theme: themes[i-1],
                    lesson: lessons[i-1]
                });
            }
            return returns;
        }

        function calculate() {
            try {
                const bVal = dateEl.value;
                if(!bVal) return;

                const returns = getReturnWindows(bVal);
                const now = new Date();
                
                let nextReturn = returns.find(r => r.end > now) || returns[2];
                const months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
                
                document.getElementById('saturn-ret-out-date').textContent = `${months[nextReturn.center.getMonth()]} ${nextReturn.center.getFullYear()}`;
                document.getElementById('saturn-ret-out-cycle').textContent = nextReturn.cycle === 1 ? "First Return" : (nextReturn.cycle === 2 ? "Second Return" : "Third Return");
                document.getElementById('saturn-ret-out-theme').textContent = nextReturn.theme.split(' ')[0];
                
                let status = "Approaching";
                if(now >= nextReturn.start && now <= nextReturn.end) status = "Active";
                if(now > nextReturn.end) status = "Completed";
                document.getElementById('saturn-ret-out-status').textContent = status;

                // Countdown
                const diff = nextReturn.center - now;
                if(diff > 0) {
                    const d = Math.floor(diff / (1000 * 60 * 60 * 24));
                    const m = Math.floor(d / 30);
                    document.getElementById('saturn-ret-out-countdown').textContent = `In ${m} Months, ${d % 30} Days`;
                } else {
                    document.getElementById('saturn-ret-out-countdown').textContent = "Window Active / Passed";
                }

                // Table
                document.getElementById('saturn-ret-out-table').innerHTML = returns.map(r => `
                    <tr class="${r.cycle === nextReturn.cycle ? 'bg-primary-soft fw-bold' : ''}">
                        <td>${r.cycle}${r.cycle==1?'st':(r.cycle==2?'nd':'rd')} Return</td>
                        <td>${r.start.getFullYear()} - ${r.end.getFullYear()}</td>
                        <td>${r.lesson}</td>
                    </tr>
                `).join('');

                const descriptions = {
                    1: "The first Saturn return occurs in your late 20s. It marks the end of youth and the beginning of true adulthood. It often brings major career shifts, relationship changes, or a feeling of 'getting serious' about life.",
                    2: "The second return in your late 50s is about mastery and legacy. It's a time to review your life's work and decide how you want to spend your elder years.",
                    3: "The third return in your late 80s is a spiritual culmination, a time of profound reflection and passing on wisdom to younger generations."
                };

                document.getElementById('saturn-ret-out-analysis').innerHTML = `
                    <h6 class="fw-bold mb-3"><i class="fas fa-meteor me-2 text-primary"></i>What to Expect</h6>
                    <p class="text-secondary small leading-relaxed mb-0">${descriptions[nextReturn.cycle]}</p>
                `;
            } catch (err) {
                console.error('Saturn Return Calc Error:', err);
            }
        }

        [dateEl, locEl].forEach(e=>e.addEventListener('input', calculate));
        document.querySelectorAll('.saturn-ret-quick').forEach(btn=>{
            btn.addEventListener('click', ()=>{
                dateEl.value = btn.dataset.date;
                calculate();
            });
        });

        document.getElementById('saturn-ret-copy').addEventListener('click', function(){
            const text=`Saturn Return Report\nCycle: ${document.getElementById('saturn-ret-out-cycle').textContent}\nDate: ${document.getElementById('saturn-ret-out-date').textContent}\nStatus: ${document.getElementById('saturn-ret-out-status').textContent}\n— ToolsHub Astrology`;
            navigator.clipboard.writeText(text).then(()=>{
                const o=this.innerHTML;
                this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
                setTimeout(()=>this.innerHTML=o, 2000);
            });
        });

        calculate();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSaturnReturnCalculator);
    } else {
        initSaturnReturnCalculator();
    }
})();
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\saturn-return-calculator.blade.php ENDPATH**/ ?>