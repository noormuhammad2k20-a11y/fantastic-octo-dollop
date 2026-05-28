<div class="row g-4 time-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label-custom">Quantity</label>
                        <input type="number" id="time-count" class="form-control form-control-lg" value="10" min="1" max="1000">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Time Format</label>
                        <select id="time-format" class="form-select form-select-lg">
                            <option value="12" selected>12-Hour (AM/PM)</option>
                            <option value="24">24-Hour (Military)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Include</label>
                        <select id="time-include" class="form-select form-select-lg">
                            <option value="hm" selected>Hours & Minutes (HH:MM)</option>
                            <option value="hms">Hours, Mins, Secs (HH:MM:SS)</option>
                        </select>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-warning fw-bold text-dark fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="time-generate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-hourglass-half me-2"></i>Generate Times
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="time-output-card" style="--tool-hue:45;--tool-color:#ca8a04;--tool-bg:rgba(234,179,8,.04); border-color:#fde047;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-history me-2" style="color:#ca8a04"></i>Generated Times</h5>
                <button class="btn btn-sm btn-outline-dark" id="copy-time" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i>Copy Data</button>
            </div>
            
            <div class="row g-3" id="time-grid">
                <!-- Times injected here -->
            </div>
            
            <textarea id="time-raw" class="d-none"></textarea>
        </div>
    </div>
</div>

<style>
.time-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.time-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.time-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.time-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.time-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.time-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.4rem;}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    $('time-generate').addEventListener('click', function() {
        const count = parseInt($('time-count').value) || 10;
        const format = $('time-format').value;
        const inc = $('time-include').value;

        const grid = $('time-grid');
        grid.innerHTML = '';
        let rawText = '';

        for (let i = 0; i < count; i++) {
            let h24 = Math.floor(Math.random() * 24);
            let m = Math.floor(Math.random() * 60);
            let s = Math.floor(Math.random() * 60);

            let hStr, mStr, sStr, ampm;
            mStr = String(m).padStart(2, '0');
            sStr = String(s).padStart(2, '0');

            if (format === '12') {
                ampm = h24 >= 12 ? 'PM' : 'AM';
                let h12 = h24 % 12;
                if (h12 === 0) h12 = 12;
                hStr = String(h12).padStart(2, '0');
            } else {
                hStr = String(h24).padStart(2, '0');
                ampm = '';
            }

            let displayTime = `${hStr}:${mStr}`;
            if (inc === 'hms') displayTime += `:${sStr}`;
            if (ampm) displayTime += ` ${ampm}`;

            rawText += displayTime + '\n';

            // Just show nicely in a grid if less than 50
            if (i < 50) {
                grid.innerHTML += `
                    <div class="col-6 col-md-3">
                        <div class="p-3 bg-white border rounded-3 text-center shadow-sm">
                            <i class="far fa-clock text-warning mb-2 fs-4"></i>
                            <div class="fw-bold font-monospace text-dark fs-5">${displayTime}</div>
                        </div>
                    </div>
                `;
            }
        }
        
        if (count >= 50) {
             grid.innerHTML = `
                <div class="col-12">
                    <div class="alert alert-info border-0"><i class="fas fa-info-circle me-2"></i>Generated ${count} times. Click "Copy Data" to get the full list (grid display hidden for large quantities).</div>
                </div>
             `;
        }

        $('time-raw').value = rawText;
        $('time-output-card').classList.remove('d-none');
        $('time-output-card').scrollIntoView({ behavior: 'smooth' });
    });

    $('copy-time').addEventListener('click', function() {
        $('time-raw').select();
        document.execCommand('copy');
        const o = this.innerHTML;
        this.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\time-generator.blade.php ENDPATH**/ ?>