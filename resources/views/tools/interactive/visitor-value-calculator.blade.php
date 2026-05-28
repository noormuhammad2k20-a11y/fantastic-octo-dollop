<div class="row g-4 visitor-value-calc-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Revenue Generated ($)</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text rounded-start-3 bg-light">$</span>
                            <input type="number" id="vv-revenue" class="form-control rounded-end-3" placeholder="5000" min="0" step="0.01">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Number of Visitors</label>
                        <input type="number" id="vv-visitors" class="form-control form-control-lg rounded-3" placeholder="25000" min="1" step="1">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill" id="action-calculate" style="background-color: #a855f7; border-color: #a855f7;"><i class="fas fa-calculator me-2"></i>Calculate Value</button>
                    <button class="btn btn-outline-secondary py-3 px-4 fw-bold rounded-pill" id="action-reset"><i class="fas fa-undo"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-container" style="--tool-hue:273;--tool-color:#a855f7;--tool-bg:rgba(168,85,247,.04); display: none;">
            
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="p-5 bg-white rounded-4 border shadow-sm">
                        <div class="text-muted fw-bold mb-3 text-uppercase small">Average Revenue Per Visitor (ARPV)</div>
                        <div class="display-3 fw-bold" style="color: var(--tool-color);" id="out-arpv">$0.00</div>
                        <p class="mt-3 text-secondary mb-0">Every time a new user visits your site, they are worth approximately <strong id="out-arpv-text">$0.00</strong> to your business.</p>
                    </div>
                </div>
            </div>
            
            <div class="row g-4 mt-2">
                <div class="col-md-6">
                    <div class="stat-card p-3 border rounded-3 bg-light text-center h-100">
                        <span class="d-block text-muted small fw-bold mb-1">Max Profitable CPC</span>
                        <span class="d-block fw-bold fs-5 text-dark" id="out-cpc">$0.00</span>
                        <span class="d-block small text-muted mt-1">Maximum you should pay per click to break even.</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card p-3 border rounded-3 bg-light text-center h-100">
                        <span class="d-block text-muted small fw-bold mb-1">Revenue per 10k Visitors</span>
                        <span class="d-block fw-bold fs-5 text-dark" id="out-10k">$0.00</span>
                        <span class="d-block small text-muted mt-1">Expected return if traffic scales linearly.</span>
                    </div>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="action-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Results</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    
    const revEl = $('vv-revenue');
    const visEl = $('vv-visitors');
    
    const outContainer = $('output-container');
    const outArpv = $('out-arpv');
    const outArpvText = $('out-arpv-text');
    const outCpc = $('out-cpc');
    const out10k = $('out-10k');
    
    $('action-calculate').addEventListener('click', function() {
        const revenue = parseFloat(revEl.value) || 0;
        const visitors = parseFloat(visEl.value) || 0;
        
        if(visitors <= 0) {
            alert('Please enter a valid number of visitors (greater than 0).');
            return;
        }
        if(revenue < 0) {
            alert('Revenue cannot be negative.');
            return;
        }
        
        const arpv = revenue / visitors;
        const arpvStr = '$' + arpv.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        
        outArpv.textContent = arpvStr;
        outArpvText.textContent = arpvStr;
        outCpc.textContent = arpvStr;
        out10k.textContent = '$' + (arpv * 10000).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        
        outContainer.style.display = 'block';
        outContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    
    $('action-reset').addEventListener('click', function() {
        revEl.value = '';
        visEl.value = '';
        outContainer.style.display = 'none';
    });

    $('action-copy').addEventListener('click', function() {
        let text = `Visitor Value Analysis:\n`;
        text += `Average Revenue Per Visitor (ARPV): ${outArpv.textContent}\n`;
        text += `Max Profitable CPC: ${outCpc.textContent}\n`;
        text += `Revenue per 10k Visitors: ${out10k.textContent}\n`;
        
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
