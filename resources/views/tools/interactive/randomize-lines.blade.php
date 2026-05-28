<div class="row g-4 rlines-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label-custom mb-0">Input Lines</label>
                        <span class="small text-muted" id="lines-count">0 Lines</span>
                    </div>
                    <textarea id="rlines-input" class="form-control font-monospace" rows="8" placeholder="Paste your lines here...&#10;Line 1&#10;Line 2&#10;Line 3..."></textarea>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="form-check form-switch custom-switch-warning">
                            <input class="form-check-input" type="checkbox" id="rlines-empty" checked>
                            <label class="form-check-label fw-bold" for="rlines-empty">Remove Empty Lines</label>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" id="rlines-clear" style="min-width: 280px; max-width: 100%;"><i class="fas fa-trash-alt me-1"></i>Clear Input</button>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-warning fw-bold text-dark fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="rlines-generate" style="min-width: 280px; max-width: 100%; background:#eab308; border:none;">
                    <i class="fas fa-random me-2"></i>Randomize Lines
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="rlines-output-card" style="--tool-hue:45;--tool-color:#ca8a04;--tool-bg:rgba(234,179,8,.04); border-color:#fde047;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-stream me-2 text-warning"></i>Shuffled Output</h5>
                <button class="btn btn-sm btn-outline-dark" id="copy-rlines" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i>Copy Output</button>
            </div>
            
            <textarea id="rlines-output" class="form-control bg-white font-monospace" rows="8" readonly></textarea>
        </div>
    </div>
</div>

<style>
.rlines-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.rlines-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.rlines-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.rlines-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.rlines-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.rlines-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;}

.custom-switch-warning .form-check-input:checked {
    background-color: #eab308;
    border-color: #eab308;
}
.custom-switch-warning .form-check-input { width: 3em; height: 1.5em; margin-right: 10px; cursor: pointer; }
.custom-switch-warning .form-check-label { cursor: pointer; padding-top: 4px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    $('rlines-input').addEventListener('input', function() {
        const lines = this.value.split('\n');
        $('lines-count').textContent = `${lines.length} Line(s)`;
    });

    $('rlines-clear').addEventListener('click', function() {
        $('rlines-input').value = '';
        $('lines-count').textContent = '0 Lines';
        $('rlines-output-card').classList.add('d-none');
    });

    $('rlines-generate').addEventListener('click', function() {
        let text = $('rlines-input').value;
        if (!text.trim()) {
            alert('Please enter some lines to randomize.');
            return;
        }

        let lines = text.split('\n');
        
        if ($('rlines-empty').checked) {
            lines = lines.filter(l => l.trim() !== '');
        }

        // Fisher-Yates shuffle
        for (let i = lines.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [lines[i], lines[j]] = [lines[j], lines[i]];
        }

        $('rlines-output').value = lines.join('\n');
        $('rlines-output-card').classList.remove('d-none');
        $('rlines-output-card').scrollIntoView({ behavior: 'smooth' });
    });

    $('copy-rlines').addEventListener('click', function() {
        $('rlines-output').select();
        document.execCommand('copy');
        const o = this.innerHTML;
        this.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });
});
</script>

