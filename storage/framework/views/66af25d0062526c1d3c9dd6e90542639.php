<div class="row g-4 blood-type-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3" id="bt-parents-inputs">
                    <div class="col-md-6">
                        <label class="form-label">Mother's Blood Type</label>
                        <select id="bt-mother" class="form-select">
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+" selected>O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Father's Blood Type</label>
                        <select id="bt-father" class="form-select">
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+" selected>O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-secondary btn-quick" data-m="A+" data-f="B+">Mother A+, Father B+</button>
                    <button class="btn btn-sm btn-outline-secondary btn-quick" data-m="O-" data-f="AB+">Mother O-, Father AB+</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="result-card d-none" id="bt-result-card" style="padding: 2rem; border-radius: 12px; background: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.05); text-align: center;">
            <p style="font-size: 1.1rem; color: #6c757d; margin-bottom: 0;">Child's Possible Blood Types</p>
            <div class="result-value" id="bt-result" style="font-size: 2.5rem; font-weight: 800; color: #dc2626; margin: 10px 0;">--</div>
            
            <p class="mt-4 text-muted small"><i class="fas fa-info-circle"></i> These are the biologically possible blood types for the child based on Mendelian genetics.</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const mEl = $('bt-mother'), fEl = $('bt-father');
    
    // Inheritance Rules
    const aboRules = {
        'A,A': ['A', 'O'], 'A,B': ['A', 'B', 'AB', 'O'], 'A,AB': ['A', 'B', 'AB'], 'A,O': ['A', 'O'],
        'B,B': ['B', 'O'], 'B,AB': ['A', 'B', 'AB'], 'B,O': ['B', 'O'],
        'AB,AB': ['A', 'B', 'AB'], 'AB,O': ['A', 'B'],
        'O,O': ['O']
    };
    
    const rhRules = {
        '+,+': ['+', '-'], '+,-': ['+', '-'], '-,+': ['+', '-'], '-,-': ['-']
    };
    
    function calculate() {
        let m = mEl.value;
        let f = fEl.value;
        
        let mABO = m.replace(/[+-]/g, '');
        let mRh = m.includes('+') ? '+' : '-';
        
        let fABO = f.replace(/[+-]/g, '');
        let fRh = f.includes('+') ? '+' : '-';
        
        // Ensure consistent key order
        let aboKey = [mABO, fABO].sort().join(',');
        let rhKey = [mRh, fRh].sort().reverse().join(','); // '+' before '-'
        
        let possibleABO = aboRules[aboKey];
        let possibleRh = rhRules[rhKey] || rhRules['-,-']; // Fallback
        
        let results = [];
        possibleABO.forEach(abo => {
            possibleRh.forEach(rh => {
                results.push(`<span class="badge bg-danger rounded-pill px-3 py-2 m-1" style="font-size:1.2rem;">${abo}${rh}</span>`);
            });
        });
        
        $('bt-result').innerHTML = results.join(' ');
        $('bt-result-card').classList.remove('d-none');
    }
    
    [mEl, fEl].forEach(el => el.addEventListener('change', calculate));
    
    document.querySelectorAll('#bt-parents-inputs .btn-quick, .btn-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            mEl.value = e.target.dataset.m;
            fEl.value = e.target.dataset.f;
            calculate();
        });
    });
    
    calculate();
});
</script><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\blood-type-calculator.blade.php ENDPATH**/ ?>