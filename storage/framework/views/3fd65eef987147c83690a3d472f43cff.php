<div class="row g-4 page-view-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Current Traffic (Monthly)</label>
                        <input type="number" id="pv-current" class="form-control form-control-lg rounded-3" placeholder="10000" min="0" step="100">
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Expected Growth Rate (%)</label>
                        <div class="input-group input-group-lg">
                            <input type="number" id="pv-growth" class="form-control rounded-start-3" placeholder="5" min="-100" step="0.1">
                            <span class="input-group-text rounded-end-3 bg-light">/ month</span>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Time Period</label>
                        <div class="input-group input-group-lg">
                            <input type="number" id="pv-period" class="form-control rounded-start-3" placeholder="12" min="1" step="1">
                            <span class="input-group-text rounded-end-3 bg-light">Months</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill" id="action-calculate" style="background-color: #0ea5e9; border-color: #0ea5e9;"><i class="fas fa-calculator me-2"></i>Calculate Forecast</button>
                    <button class="btn btn-outline-secondary py-3 px-4 fw-bold rounded-pill" id="action-reset"><i class="fas fa-undo"></i></button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-container" style="--tool-hue:199;--tool-color:#0ea5e9;--tool-bg:rgba(14,165,233,.04); display: none;">
            
            <div class="row g-4 text-center mb-4">
                <div class="col-md-6">
                    <div class="p-4 bg-white rounded-4 border shadow-sm h-100">
                        <div class="text-muted fw-bold mb-2 text-uppercase small">Future Monthly Traffic</div>
                        <div class="display-5 fw-bold" style="color: var(--tool-color);" id="out-future">0</div>
                        <div class="mt-2 small text-secondary">After <span id="out-months">12</span> months</div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="p-4 bg-white rounded-4 border shadow-sm h-100">
                        <div class="text-muted fw-bold mb-2 text-uppercase small">Total Traffic Accrued</div>
                        <div class="display-5 fw-bold text-dark" id="out-total">0</div>
                        <div class="mt-2 small text-secondary">Cumulative sum over period</div>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-calendar-alt me-2 text-primary"></i>Month-by-Month Projection</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered text-center small mb-0" id="out-table">
                    <thead class="table-light">
                        <tr>
                            <th>Month</th>
                            <th>Starting Traffic</th>
                            <th>New Traffic Gained</th>
                            <th>Ending Traffic</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="action-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Projection</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    
    const currEl = $('pv-current');
    const growthEl = $('pv-growth');
    const periodEl = $('pv-period');
    
    const outContainer = $('output-container');
    const outFuture = $('out-future');
    const outTotal = $('out-total');
    const outMonths = $('out-months');
    const tbody = document.querySelector('#out-table tbody');
    
    $('action-calculate').addEventListener('click', function() {
        const current = parseFloat(currEl.value) || 0;
        const growth = parseFloat(growthEl.value) || 0;
        const period = parseInt(periodEl.value) || 0;
        
        if(current <= 0 || period <= 0) {
            alert('Please enter a valid current traffic and time period.');
            return;
        }
        
        let total = 0;
        let traffic = current;
        let rows = '';
        
        for(let i=1; i<=period; i++) {
            const start = traffic;
            const gained = start * (growth / 100);
            traffic += gained;
            total += traffic;
            
            rows += `<tr>
                <td>Month ${i}</td>
                <td>${Math.round(start).toLocaleString()}</td>
                <td class="${gained >= 0 ? 'text-success' : 'text-danger'}">${gained >= 0 ? '+' : ''}${Math.round(gained).toLocaleString()}</td>
                <td class="fw-bold">${Math.round(traffic).toLocaleString()}</td>
            </tr>`;
        }
        
        tbody.innerHTML = rows;
        
        outFuture.textContent = Math.round(traffic).toLocaleString();
        outTotal.textContent = Math.round(total).toLocaleString();
        outMonths.textContent = period;
        
        outContainer.style.display = 'block';
        outContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    
    $('action-reset').addEventListener('click', function() {
        currEl.value = '';
        growthEl.value = '';
        periodEl.value = '';
        outContainer.style.display = 'none';
    });

    $('action-copy').addEventListener('click', function() {
        let text = `Page View Forecast (After ${outMonths.textContent} months):\n`;
        text += `Future Monthly Traffic: ${outFuture.textContent}\n`;
        text += `Total Traffic Accrued: ${outTotal.textContent}\n\n`;
        text += `Month\tStarting\tGained\tEnding\n`;
        
        const rows = tbody.querySelectorAll('tr');
        rows.forEach(r => {
            const cols = r.querySelectorAll('td');
            text += `${cols[0].textContent}\t${cols[1].textContent}\t${cols[2].textContent}\t${cols[3].textContent}\n`;
        });
        
        navigator.clipboard.writeText(text).then(()=>{
            const orig = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            this.classList.replace('btn-dark', 'btn-success');
            setTimeout(()=>{
                this.innerHTML = orig;
                this.classList.replace('btn-success', 'btn-dark');
            }, 2000);
        });
    });
});
</script>

<style>
.form-label-custom {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}
.calculator-card {
    background: #fff;
    border-radius: 1.5rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid rgba(0,0,0,0.05);
    overflow: hidden;
}
.calculator-header {
    padding: 2rem 2rem 1.5rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    display: flex;
    align-items: center;
    gap: 1.25rem;
}
.tool-icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}
.calculator-header h4 {
    margin: 0 0 0.25rem 0;
    font-weight: 700;
    color: #111827;
}
.calculator-header p {
    margin: 0;
    color: #6b7280;
    font-size: 0.95rem;
}
.calculator-body {
    padding: 2rem;
}
.output-card-themed {
    background: #fff;
    border-radius: 1.5rem;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid var(--tool-bg);
    border-top: 4px solid var(--tool-color);
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\page-view-calculator.blade.php ENDPATH**/ ?>