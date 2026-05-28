<div class="row g-4 list-randomizer-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom d-flex justify-content-between">
                        <span>List Items (One per line)</span>
                        <span id="list-count" class="text-muted fw-normal">0 items</span>
                    </label>
                    <textarea id="list-input" class="form-control" rows="8" placeholder="Item 1&#10;Item 2&#10;Item 3"></textarea>
                </div>
                <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto fw-bold text-white py-3 px-5 fw-bold rounded-pill shadow-sm"" id="list-shuffle" style="min-width: 280px; max-width: 100%; background:#14b8a6">
                        <i class="fas fa-random me-2"></i>Shuffle List
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="list-output-card" style="--tool-hue:170;--tool-color:#0d9488;--tool-bg:rgba(20,184,166,.04);">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="fw-bold mb-0"><i class="fas fa-check-circle me-2" style="color:#0d9488"></i>Shuffled List</h5>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-dark" id="copy-list" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i>Copy</button>
                </div>
            </div>
            
            <textarea id="list-output" class="form-control bg-white" rows="10" readonly></textarea>
        </div>
    </div>
</div>

<style>
.list-randomizer-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.list-randomizer-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.list-randomizer-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.list-randomizer-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.list-randomizer-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.list-randomizer-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    $('list-input').addEventListener('input', function() {
        const list = this.value.split('\n').filter(s => s.trim().length > 0);
        $('list-count').textContent = `${list.length} item${list.length !== 1 ? 's' : ''}`;
    });

    $('list-shuffle').addEventListener('click', function() {
        const list = $('list-input').value.split('\n').filter(s => s.trim().length > 0);
        if (list.length === 0) return;

        // Fisher-Yates
        for (let i = list.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [list[i], list[j]] = [list[j], list[i]];
        }

        $('list-output').value = list.join('\n');
        $('list-output-card').classList.remove('d-none');
        $('list-output-card').scrollIntoView({ behavior: 'smooth' });
    });

    $('copy-list').addEventListener('click', function() {
        $('list-output').select();
        document.execCommand('copy');
        const o = this.innerHTML;
        this.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\list-randomizer.blade.php ENDPATH**/ ?>