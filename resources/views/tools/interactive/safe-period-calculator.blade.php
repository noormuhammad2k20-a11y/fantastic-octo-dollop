<div class="row g-4 safe-period-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3" id="safe-inputs">
                    <div class="col-md-6">
                        <label class="form-label">First Day of Last Period</label>
                        <input type="date" id="safe-date" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Average Cycle Length (Days)</label>
                        <select id="safe-cycle" class="form-select">
                            <script>
                                for(let i=26; i<=32; i++) {
                                    document.write(`<option value="${i}" ${i===28 ? 'selected' : ''}>${i} days</option>`);
                                }
                            </script>
                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="alert alert-info py-2 small" role="alert">
                        <i class="fas fa-info-circle"></i> The Standard Days Method is only effective for regular cycles between 26 and 32 days.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="result-card d-none" id="safe-result-card" style="padding: 2rem; border-radius: 12px; background: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
            <div class="text-center mb-4">
                <div class="result-label" id="safe-status-pill" style="font-size: 1.25rem; font-weight: 600; padding: 8px 25px; border-radius: 30px; display: inline-block; margin-bottom: 15px;">--</div>
                <p style="font-size: 1.1rem; color: #6c757d; margin-bottom: 0;">Today's Safety Status</p>
            </div>
            
            <div class="row mt-4 text-center g-4">
                <div class="col-md-6">
                    <div class="p-3" style="background: #f0fdf4; border-radius: 10px; border: 1px solid #dcfce3;">
                        <h6 class="text-success mb-2">Safe Window</h6>
                        <div id="safe-window-1" class="fw-bold" style="color: #16a34a;">--</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3" style="background: #fef2f2; border-radius: 10px; border: 1px solid #fee2e2;">
                        <h6 class="text-danger mb-2">Unsafe Window (Fertile)</h6>
                        <div id="safe-window-unsafe" class="fw-bold" style="color: #dc2626;">--</div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="p-3" style="background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                         <h6 class="text-muted mb-2">Post-Fertile Safe Window</h6>
                         <div id="safe-window-2" class="fw-bold" style="color: #475569;">--</div>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-3 border-top text-center">
                <p class="text-muted small"><i class="fas fa-exclamation-triangle text-warning"></i> <strong>Medical Disclaimer:</strong> This method should not be used as a primary form of birth control without medical consultation. Sperm can survive up to 5 days inside the body.</p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const dEl = $('safe-date'), cEl = $('safe-cycle');
    
    // Default to 1 week ago
    let defDate = new Date();
    defDate.setDate(defDate.getDate() - 7);
    dEl.valueAsDate = defDate;
    
    function calculate() {
        if(!dEl.value) return;
        
        let lmp = new Date(dEl.value);
        let cycle = parseInt(cEl.value);
        
        // Unsafe Days = Days 8 to 19 of the cycle (inclusive)
        let unsafeStart = new Date(lmp.getTime() + (7 * 24 * 60 * 60 * 1000));
        let unsafeEnd = new Date(lmp.getTime() + (18 * 24 * 60 * 60 * 1000));
        
        // Safe Window 1 = Days 1 to 7
        let safe1Start = new Date(lmp);
        let safe1End = new Date(lmp.getTime() + (6 * 24 * 60 * 60 * 1000));
        
        // Safe Window 2 = Day 20 to next period
        let safe2Start = new Date(lmp.getTime() + (19 * 24 * 60 * 60 * 1000));
        let safe2End = new Date(lmp.getTime() + ((cycle - 1) * 24 * 60 * 60 * 1000));
        
        let optionsShort = { month: 'short', day: 'numeric' };
        let optionsLong = { month: 'short', day: 'numeric', year: 'numeric' };
        
        $('safe-window-unsafe').innerText = unsafeStart.toLocaleDateString('en-US', optionsShort) + ' - ' + unsafeEnd.toLocaleDateString('en-US', optionsLong);
        $('safe-window-1').innerText = safe1Start.toLocaleDateString('en-US', optionsShort) + ' - ' + safe1End.toLocaleDateString('en-US', optionsLong);
        $('safe-window-2').innerText = safe2Start.toLocaleDateString('en-US', optionsShort) + ' - ' + safe2End.toLocaleDateString('en-US', optionsLong);
        
        // Determine today's status
        let now = new Date();
        now.setHours(0,0,0,0);
        
        const pill = $('safe-status-pill');
        if (now >= unsafeStart && now <= unsafeEnd) {
            pill.innerText = 'UNSAFE / High Risk';
            pill.style.backgroundColor = '#fee2e2';
            pill.style.color = '#dc2626';
        } else {
            pill.innerText = 'SAFE / Low Risk';
            pill.style.backgroundColor = '#dcfce3';
            pill.style.color = '#16a34a';
        }
        
        $('safe-result-card').classList.remove('d-none');
    }
    
    [dEl, cEl].forEach(el => el.addEventListener('input', calculate));
    calculate();
});
</script>
