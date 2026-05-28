<div class="row g-4 rnum-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <ul class="nav nav-tabs mb-4" id="rnum-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold text-danger" id="list-tab" data-bs-toggle="tab" data-bs-target="#list-pane" type="button" role="tab">List of Numbers</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold text-danger" id="range-tab" data-bs-toggle="tab" data-bs-target="#range-pane" type="button" role="tab">Number Range</button>
                    </li>
                </ul>

                <div class="tab-content" id="rnum-tab-content">
                    <div class="tab-pane fade show active" id="list-pane" role="tabpanel">
                        <div class="mb-4">
                            <label class="form-label-custom">Numbers to Shuffle (Comma or Newline separated)</label>
                            <textarea id="rnum-input" class="form-control font-monospace" rows="4" placeholder="1, 5, 10, 42, 99..."></textarea>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="range-pane" role="tabpanel">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label-custom">Start Number</label>
                                <input type="number" id="rnum-start" class="form-control form-control-lg" value="1">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom">End Number</label>
                                <input type="number" id="rnum-end" class="form-control form-control-lg" value="10">
                            </div>
                            <div class="col-12">
                                <div class="form-text"><i class="fas fa-info-circle me-1"></i> Generates a sequence from Start to End, then shuffles it.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-danger fw-bold fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="rnum-generate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-random me-2"></i>Shuffle Numbers
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none text-center" id="rnum-output-card" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(239,68,68,.04); border-color:#fca5a5; padding: 3rem 2rem;">
            <div id="rnum-display" class="d-flex flex-wrap justify-content-center gap-2 mb-4">
                <!-- Numbers injected here -->
            </div>
            <button class="btn btn-outline-danger rounded-pill px-4" id="copy-rnum" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Sequence</button>
        </div>
    </div>
</div>

<style>
.rnum-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.rnum-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.rnum-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.rnum-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.rnum-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.rnum-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.4rem;}

.rnum-rebuilt .nav-tabs .nav-link { color: #64748b; border: none; padding: 1rem 1.5rem; }
.rnum-rebuilt .nav-tabs .nav-link.active { background: transparent; border-bottom: 3px solid #ef4444; color: #dc2626 !important; }

.num-badge {
    font-size: 1.5rem;
    padding: 0.5rem 1rem;
    background: #fff;
    border: 2px solid #fee2e2;
    border-radius: 8px;
    color: #b91c1c;
    font-weight: 800;
    font-family: monospace;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    let activeTab = 'list';
    
    $('list-tab').addEventListener('shown.bs.tab', () => activeTab = 'list');
    $('range-tab').addEventListener('shown.bs.tab', () => activeTab = 'range');

    $('rnum-generate').addEventListener('click', function() {
        let nums = [];

        if (activeTab === 'list') {
            const val = $('rnum-input').value;
            if (!val.trim()) {
                alert('Please enter some numbers.');
                return;
            }
            // Split by comma or newline
            const parts = val.split(/[\n,]+/);
            parts.forEach(p => {
                const n = p.trim();
                if (n !== '') nums.push(n); // Keep as string to preserve exact input if desired
            });
        } else {
            const start = parseInt($('rnum-start').value);
            const end = parseInt($('rnum-end').value);
            if (isNaN(start) || isNaN(end)) {
                alert('Please enter valid numbers for the range.');
                return;
            }
            const s = Math.min(start, end);
            const e = Math.max(start, end);
            
            if (e - s > 10000) {
                alert('Range too large. Limit is 10,000 numbers.');
                return;
            }

            for (let i = s; i <= e; i++) {
                nums.push(i);
            }
        }

        if (nums.length === 0) return;

        // Fisher-Yates shuffle
        for (let i = nums.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [nums[i], nums[j]] = [nums[j], nums[i]];
        }

        const container = $('rnum-display');
        container.innerHTML = '';
        container.dataset.raw = nums.join(', ');

        // Only display as badges if less than 100, otherwise just raw text
        if (nums.length <= 100) {
            nums.forEach(n => {
                container.innerHTML += `<div class="num-badge animate__animated animate__zoomIn">${n}</div>`;
            });
        } else {
            container.innerHTML = `
                <div class="alert alert-danger w-100">
                    <i class="fas fa-info-circle me-2"></i>Generated ${nums.length} numbers. Displaying as raw text below due to size.
                </div>
                <textarea class="form-control font-monospace mt-3" rows="8" readonly>${nums.join(', ')}</textarea>
            `;
        }

        $('rnum-output-card').classList.remove('d-none');
        $('rnum-output-card').scrollIntoView({ behavior: 'smooth' });
    });

    $('copy-rnum').addEventListener('click', function() {
        const data = $('rnum-display').dataset.raw;
        navigator.clipboard.writeText(data).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });
});
</script>

