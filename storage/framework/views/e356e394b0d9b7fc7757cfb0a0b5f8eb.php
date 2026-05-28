<div class="row g-4 preg-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3" id="preg-inputs">
                    <div class="col-md-6">
                        <label class="form-label">First Day of Last Menstrual Period (LMP)</label>
                        <input type="date" id="preg-date" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Average Cycle Length (Days)</label>
                        <select id="preg-cycle" class="form-select">
                            <!-- Generate options 21 to 35 -->
                            <script>
                                for(let i=21; i<=35; i++) {
                                    document.write(`<option value="${i}" ${i===28 ? 'selected' : ''}>${i} days</option>`);
                                }
                            </script>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-secondary btn-quick" data-weeks="-12" data-c="28">I'm around 12 weeks pregnant</button>
                    <button class="btn btn-sm btn-outline-secondary btn-quick" data-weeks="-20" data-c="28">I'm around 20 weeks pregnant</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="result-card d-none" id="preg-result-card" style="padding: 2rem; border-radius: 12px; background: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.05); text-align: center;">
            <p style="font-size: 1.1rem; color: #6c757d; margin-bottom: 0;">Estimated Due Date</p>
            <div class="result-value" id="preg-result" style="font-size: 3rem; font-weight: 800; color: #ec4899; margin: 10px 0;">--</div>
            
            <div class="mt-4 row text-center">
                <div class="col-4">
                    <div style="font-size: 0.9rem; color: #6b7280;">Estimated Conception</div>
                    <div id="preg-conception" style="font-size: 1.2rem; font-weight: 600; color: #4b5563">--</div>
                </div>
                <div class="col-4" style="border-left: 1px solid #e5e7eb; border-right: 1px solid #e5e7eb;">
                    <div style="font-size: 0.9rem; color: #6b7280;">Current Gestational Age</div>
                    <div id="preg-age" style="font-size: 1.2rem; font-weight: 600; color: #8b5cf6">-- Weeks, -- Days</div>
                </div>
                <div class="col-4">
                    <div style="font-size: 0.9rem; color: #6b7280;">Trimester</div>
                    <div id="preg-trimester" style="font-size: 1.2rem; font-weight: 600; color: #10b981">--</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const dEl = $('preg-date'), cEl = $('preg-cycle');
    
    // Set default to 8 weeks ago
    let defDate = new Date();
    defDate.setDate(defDate.getDate() - 56);
    dEl.valueAsDate = defDate;
    
    function calculate() {
        if(!dEl.value) return;
        
        let lmp = new Date(dEl.value);
        let cycle = parseInt(cEl.value);
        
        // Naegele's rule is based on 28 day cycle: Due = LMP + 280 days.
        // Adjust for cycle length: Due = LMP + 280 + (cycle - 28)
        let daysToAdd = 280 + (cycle - 28);
        
        let due = new Date(lmp.getTime() + (daysToAdd * 24 * 60 * 60 * 1000));
        
        // Conception is approx 266 + (cycle-28) days before due date, OR 14 + (cycle-28) days after LMP
        let conc = new Date(lmp.getTime() + ((14 + (cycle - 28)) * 24 * 60 * 60 * 1000));
        
        // Current age
        let now = new Date();
        now.setHours(0,0,0,0);
        lmp.setHours(0,0,0,0);
        let diffMs = now.getTime() - lmp.getTime();
        let diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
        
        let weeks = Math.floor(diffDays / 7);
        let remainDays = diffDays % 7;
        
        let trimester = '';
        if(diffDays < 0) {
            trimester = 'Not pregnant yet';
            weeks = 0; remainDays = 0;
        } else if(weeks < 13) {
            trimester = 'First Trimester';
        } else if(weeks < 27) {
            trimester = 'Second Trimester';
        } else if(weeks <= 42) {
            trimester = 'Third Trimester';
        } else {
            trimester = 'Post-term';
        }
        
        let options = { month: 'long', day: 'numeric', year: 'numeric' };
        
        $('preg-result').innerText = due.toLocaleDateString('en-US', options);
        $('preg-conception').innerText = conc.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
        
        if(diffDays >= 0 && diffDays <= 300) {
            $('preg-age').innerText = weeks + ' Wks, ' + remainDays + ' Days';
        } else {
            $('preg-age').innerText = 'N/A';
        }
        
        $('preg-trimester').innerText = trimester;
        
        $('preg-result-card').classList.remove('d-none');
    }
    
    [dEl, cEl].forEach(el => el.addEventListener('input', calculate));
    
    document.querySelectorAll('#preg-inputs .btn-quick, .btn-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            let wkStr = e.target.dataset.weeks;
            if(wkStr) {
                let wk = parseInt(wkStr);
                let d = new Date();
                d.setDate(d.getDate() + (wk * 7));
                dEl.valueAsDate = d;
            }
            cEl.value = e.target.dataset.c;
            calculate();
        });
    });
    
    calculate();
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\conception-calculator.blade.php ENDPATH**/ ?>