<div class="row g-4 date-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Start Date</label>
                        <input type="date" id="date-start" class="form-control form-control-lg" value="2000-01-01">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">End Date</label>
                        <input type="date" id="date-end" class="form-control form-control-lg">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Quantity</label>
                        <input type="number" id="date-count" class="form-control form-control-lg" value="10" min="1" max="1000">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Output Format</label>
                        <select id="date-format" class="form-select form-select-lg">
                            <option value="iso" selected>YYYY-MM-DD (ISO)</option>
                            <option value="long">Long Date (e.g. January 1, 2020)</option>
                            <option value="us">MM/DD/YYYY (US)</option>
                            <option value="eu">DD/MM/YYYY (EU)</option>
                        </select>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-primary fw-bold fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="date-generate" style="min-width: 280px; max-width: 100%; background:#ec4899; border:none;">
                    <i class="fas fa-magic me-2"></i>Generate Dates
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="date-output-card" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04); border-color:#fbcfe8;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-list-ol me-2" style="color:#db2777"></i>Random Dates</h5>
                <button class="btn btn-sm btn-outline-dark" id="copy-dates" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i>Copy List</button>
            </div>
            
            <textarea id="date-output" class="form-control bg-white font-monospace" rows="10" readonly></textarea>
        </div>
    </div>
</div>

<style>
.date-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.date-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.date-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.date-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.date-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.date-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.4rem;}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    // Set default end date to today
    const today = new Date();
    $('date-end').value = today.toISOString().split('T')[0];

    $('date-generate').addEventListener('click', function() {
        const startStr = $('date-start').value;
        const endStr = $('date-end').value;
        const count = parseInt($('date-count').value) || 10;
        const format = $('date-format').value;

        if (!startStr || !endStr) {
            alert("Please select both start and end dates.");
            return;
        }

        const startDate = new Date(startStr).getTime();
        const endDate = new Date(endStr).getTime();

        if (startDate > endDate) {
            alert("Start Date must be before End Date.");
            return;
        }

        const dates = [];
        for (let i = 0; i < count; i++) {
            const randomTime = startDate + Math.random() * (endDate - startDate);
            const d = new Date(randomTime);
            
            let formatted = '';
            if (format === 'iso') {
                formatted = d.toISOString().split('T')[0];
            } else if (format === 'long') {
                formatted = d.toLocaleDateString(undefined, { year: 'numeric', month: 'long', day: 'numeric' });
            } else if (format === 'us') {
                formatted = `${String(d.getMonth() + 1).padStart(2,'0')}/${String(d.getDate()).padStart(2,'0')}/${d.getFullYear()}`;
            } else if (format === 'eu') {
                formatted = `${String(d.getDate()).padStart(2,'0')}/${String(d.getMonth() + 1).padStart(2,'0')}/${d.getFullYear()}`;
            }

            dates.push(formatted);
        }

        $('date-output').value = dates.join('\n');
        $('date-output-card').classList.remove('d-none');
        $('date-output-card').scrollIntoView({ behavior: 'smooth' });
    });

    $('copy-dates').addEventListener('click', function() {
        $('date-output').select();
        document.execCommand('copy');
        const o = this.innerHTML;
        this.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\date-generator.blade.php ENDPATH**/ ?>