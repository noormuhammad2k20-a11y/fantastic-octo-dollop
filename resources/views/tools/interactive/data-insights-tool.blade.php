@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid data-insights-tool">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Dataset Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-success" id="qa-clean" style="min-width: 280px; max-width: 100%;">Pristine API Dump</button>
                    <button class="qa-btn-component qa-primary" id="qa-std" style="min-width: 280px; max-width: 100%;">Standard CRM Export</button>
                    <button class="qa-btn-component qa-warning" id="qa-mess" style="min-width: 280px; max-width: 100%;">Messy User Inputs</button>
                    <button class="qa-btn-component qa-danger" id="qa-garb" style="min-width: 280px; max-width: 100%;">Legacy DB (Garbage)</button>
                    <button class="qa-btn-component qa-info" id="qa-big" style="min-width: 280px; max-width: 100%;">Big Data (Millions)</button>
                    <button class="qa-btn-component qa-dark" id="qa-small" style="min-width: 280px; max-width: 100%;">Manual Excel Form</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Total Rows (Records)</label>
                    <input type="number" id="rows" class="form-control-custom fw-bold text-primary" value="50000" min="1">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Total Columns (Features)</label>
                    <input type="number" id="cols" class="form-control-custom" value="15" min="1">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Quality Indicators</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-danger">Missing Values (Nulls) %</label>
                    <input type="number" id="nulls" class="form-control-custom" value="5.5" step="0.5" max="100">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-warning">Duplicates %</label>
                    <input type="number" id="dups" class="form-control-custom" value="2.0" step="0.5" max="100">
                </div>
                <!-- Cleaning velocity assumption -->
                <div class="col-md-12 form-group-custom mb-2 mt-2 pt-2 border-top">
                    <label class="form-label-custom text-muted">Data Cleansing Velocity (Cells evaluated / second script)</label>
                    <input type="range" id="vel" class="form-range" min="100" max="5000" value="1000" step="100">
                    <div class="text-center text-muted" style="font-size: 0.8rem;"><span id="vel-disp">1000</span> cells/sec</div>
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #3b82f6;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Data Quality Index (DQI)</span>
                <span id="data-badge" class="status-badge badge-optimal">Production Ready</span>
            </div>
            <h1 class="result-main-value fs-1" id="dqi" style="color: #1d4ed8;">0%</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Usable Records Expected</td><td class="text-end fw-bold fs-6 text-success" id="s-usable">0</td></tr>
                    <tr><td>Discard/Impute Records</td><td class="text-end fw-semibold text-danger" id="s-discard">0</td></tr>
                    <tr><td class="pt-2 border-top">Est. Automated Cleaning Time</td><td class="text-end pt-2 border-top fw-bold text-dark" id="s-time">0s</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Dataset Composition</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-clean" class="enhanced-progress-segment" style="background:#10b981; width:80%;"></div>
                <div id="bar-null" class="enhanced-progress-segment" style="background:#f59e0b; width:15%;"></div>
                <div id="bar-dup" class="enhanced-progress-segment" style="background:#ef4444; width:5%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#10b981;font-weight:bold;">Clean</span>
                <span style="color:#ef4444;font-weight:bold;">Anomalies</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calc() {
        const rows = parseFloat(document.getElementById('rows').value) || 0;
        const cols = parseFloat(document.getElementById('cols').value) || 0;
        const nulls = (parseFloat(document.getElementById('nulls').value) || 0) / 100;
        const dups = (parseFloat(document.getElementById('dups').value) || 0) / 100;
        const vel = parseFloat(document.getElementById('vel').value) || 1000;
        
        document.getElementById('vel-disp').innerText = vel;

        const errorRate = nulls + dups;
        const dqi = Math.max(0, 100 - (errorRate * 100));

        const discarded = Math.floor(rows * Math.min(1, errorRate));
        const usable = rows - discarded;

        const totalCells = rows * cols;
        const computeSeconds = totalCells / vel;
        
        let timeStr = "";
        if(computeSeconds < 60) timeStr = computeSeconds.toFixed(1) + " sec";
        else if (computeSeconds < 3600) timeStr = (computeSeconds/60).toFixed(1) + " min";
        else timeStr = (computeSeconds/3600).toFixed(1) + " hrs";

        let badge = document.getElementById('data-badge');
        let color = '#1d4ed8';
        if(dqi < 60) { badge.innerText = "GARBAGE IN"; badge.className = "status-badge badge-critical"; color='#ef4444'; }
        else if (dqi < 85) { badge.innerText = "NEEDS IMPUTATION"; badge.className = "status-badge badge-warning"; color='#f59e0b'; }
        else if (dqi < 95) { badge.innerText = "ACCEPTABLE"; badge.className = "status-badge badge-info"; color='#0ea5e9'; }
        else { badge.innerText = "PRISTINE DATA"; badge.className = "status-badge badge-optimal"; color='#10b981'; }

        try {
            document.getElementById('dqi').innerText = dqi.toFixed(1) + '%';
            document.getElementById('dqi').style.color = color;
            
            document.getElementById('s-usable').innerText = usable.toLocaleString('en-US');
            document.getElementById('s-discard').innerText = discarded.toLocaleString('en-US');
            document.getElementById('s-time').innerText = timeStr;

            const bClean = dqi;
            const bNull = nulls * 100;
            const bDup = dups * 100;
            
            document.getElementById('bar-clean').style.width = Math.max(0, bClean) + '%';
            document.getElementById('bar-null').style.width = Math.max(0, bNull) + '%';
            document.getElementById('bar-dup').style.width = Math.max(0, bDup) + '%';
        } catch(e) {}
    }
    
    ['rows','cols','nulls','dups','vel'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-clean').addEventListener('click', () => { document.getElementById('rows').value=100000; document.getElementById('cols').value=20; document.getElementById('nulls').value=0.5; document.getElementById('dups').value=0; calc(); });
    document.getElementById('qa-std').addEventListener('click', () => { document.getElementById('rows').value=25000; document.getElementById('cols').value=15; document.getElementById('nulls').value=12; document.getElementById('dups').value=2; calc(); });
    document.getElementById('qa-mess').addEventListener('click', () => { document.getElementById('rows').value=5000; document.getElementById('cols').value=8; document.getElementById('nulls').value=30; document.getElementById('dups').value=15; calc(); });
    document.getElementById('qa-garb').addEventListener('click', () => { document.getElementById('rows').value=500000; document.getElementById('cols').value=45; document.getElementById('nulls').value=45; document.getElementById('dups').value=10; calc(); });
    document.getElementById('qa-big').addEventListener('click', () => { document.getElementById('rows').value=5000000; document.getElementById('cols').value=5; document.getElementById('nulls').value=1; document.getElementById('dups').value=0.1; calc(); });
    document.getElementById('qa-small').addEventListener('click', () => { document.getElementById('rows').value=350; document.getElementById('cols').value=12; document.getElementById('nulls').value=15; document.getElementById('dups').value=5; calc(); });

    calc();
});
</script>

