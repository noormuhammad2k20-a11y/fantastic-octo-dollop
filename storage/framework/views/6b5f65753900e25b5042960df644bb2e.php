<div class="row g-4 random-date-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Start Date</label>
                        <input type="date" id="date-start" class="form-control form-control-lg" value="2000-01-01">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">End Date</label>
                        <input type="date" id="date-end" class="form-control form-control-lg" value="2025-12-31">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Number of Dates</label>
                        <input type="number" id="date-count" class="form-control form-control-lg" value="1" min="1" max="1000">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Date Format</label>
                        <select id="date-format" class="form-select form-select-lg">
                            <option value="YYYY-MM-DD">YYYY-MM-DD (Standard)</option>
                            <option value="MM/DD/YYYY">MM/DD/YYYY (US)</option>
                            <option value="DD/MM/YYYY">DD/MM/YYYY (UK/EU)</option>
                            <option value="MMM D, YYYY">MMM D, YYYY (Formal)</option>
                            <option value="Full">Full Date (Wednesday, April...)</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-info fw-bold text-white py-3 px-5 fw-bold rounded-pill shadow-sm"" id="generate-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-magic me-2"></i>Generate Random Dates
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="date-output-card" style="--tool-hue:200;--tool-color:#0284c7;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Random Date</span>
                <div class="output-hero-value fs-2" id="primary-date">-</div>
                <span class="output-hero-unit" id="date-range-label">Within specified range</span>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-list me-2 text-primary"></i>Generated Results</span>
                    <button class="btn btn-link btn-sm p-0 text-decoration-none" id="download-csv" style="min-width: 280px; max-width: 100%;">Download CSV</button>
                </h6>
                <div class="results-list-container">
                    <div id="results-list" class="row g-2">
                        <!-- Dates here -->
                    </div>
                </div>
            </div>
            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-all" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy All Dates
            </button>
        </div>
    </div>
</div>

<style>
.random-date-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.random-date-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.random-date-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.random-date-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.random-date-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.random-date-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}

.results-list-container {
    max-height: 300px;
    overflow-y: auto;
    padding: 5px;
}

.date-pill {
    background: white;
    border: 1px solid #e2e8f0;
    padding: 10px;
    border-radius: 10px;
    text-align: center;
    font-weight: 600;
    color: #1e293b;
    transition: all 0.2s;
}
.date-pill:hover {
    border-color: #0ea5e9;
    background: #f0f9ff;
    transform: translateY(-2px);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    // Set default dates
    const today = new Date();
    const nextYear = new Date();
    nextYear.setFullYear(today.getFullYear() + 1);
    
    $('date-start').value = today.toISOString().split('T')[0];
    $('date-end').value = nextYear.toISOString().split('T')[0];

    $('generate-btn').addEventListener('click', generateDates);

    function generateDates() {
        const start = new Date($('date-start').value).getTime();
        const end = new Date($('date-end').value).getTime();
        
        if (isNaN(start) || isNaN(end)) {
            alert('Please enter valid start and end dates.');
            return;
        }
        if (start > end) {
            alert('Start date must be before end date.');
            return;
        }

        const count = parseInt($('date-count').value) || 1;
        const format = $('date-format').value;
        const results = [];

        for (let i = 0; i < count; i++) {
            const randomTime = start + Math.random() * (end - start);
            results.push(new Date(randomTime));
        }

        displayResults(results, format);
    }

    function formatDate(date, format) {
        const y = date.getFullYear();
        const m = (date.getMonth() + 1).toString().padStart(2, '0');
        const d = date.getDate().toString().padStart(2, '0');
        const mmm = date.toLocaleString('default', { month: 'short' });
        
        switch(format) {
            case 'YYYY-MM-DD': return `${y}-${m}-${d}`;
            case 'MM/DD/YYYY': return `${m}/${d}/${y}`;
            case 'DD/MM/YYYY': return `${d}/${m}/${y}`;
            case 'MMM D, YYYY': return `${mmm} ${date.getDate()}, ${y}`;
            case 'Full': return date.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            default: return date.toISOString().split('T')[0];
        }
    }

    function displayResults(dates, format) {
        const container = $('results-list');
        container.innerHTML = '';
        
        const formatted = dates.map(d => formatDate(d, format));
        
        $('primary-date').textContent = formatted[0];
        
        formatted.forEach(f => {
            const col = document.createElement('div');
            col.className = 'col-md-4 col-sm-6';
            col.innerHTML = `<div class="date-pill">${f}</div>`;
            container.appendChild(col);
        });

        $('date-output-card').classList.remove('d-none');
        $('date-output-card').scrollIntoView({ behavior: 'smooth' });
    }

    $('copy-all').addEventListener('click', function() {
        const pills = document.querySelectorAll('.date-pill');
        const text = Array.from(pills).map(p => p.textContent).join('\n');
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('download-csv').addEventListener('click', function() {
        const pills = document.querySelectorAll('.date-pill');
        const content = "Date\n" + Array.from(pills).map(p => p.textContent).join('\n');
        const blob = new Blob([content], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'random_dates.csv';
        a.click();
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\random-date-generator.blade.php ENDPATH**/ ?>