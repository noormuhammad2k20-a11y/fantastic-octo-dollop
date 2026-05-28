<div class="interactive-tool-grid credit-mix-impact-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <h5 class="mb-3 text-secondary pb-2 border-bottom">Revolving Credit</h5>
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Number of Credit Cards</label>
                <div class="input-group">
                    <button class="btn btn-outline-secondary" type="button" id="cc-minus" style="min-width: 280px; max-width: 100%;"><i class="fas fa-minus"></i></button>
                    <input type="number" id="cc-num" class="form-control-custom text-center border-secondary" value="1" min="0" step="1">
                    <button class="btn btn-outline-secondary" type="button" id="cc-plus" style="min-width: 280px; max-width: 100%;"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            
            <h5 class="mt-4 mb-3 text-secondary pb-2 border-bottom">Installment Loans</h5>
            <div class="row">
                <div class="col-6 mb-2">
                    <div class="form-check form-switch custom-switch-lg align-items-center">
                        <input class="form-check-input" type="checkbox" id="has-auto">
                        <label class="form-check-label fw-bold ms-2 mt-1" for="has-auto">Auto Loan</label>
                    </div>
                </div>
                <div class="col-6 mb-2">
                     <div class="form-check form-switch custom-switch-lg align-items-center">
                        <input class="form-check-input" type="checkbox" id="has-mortgage">
                        <label class="form-check-label fw-bold ms-2 mt-1" for="has-mortgage">Mortgage</label>
                    </div>
                </div>
                <div class="col-6 mb-2">
                     <div class="form-check form-switch custom-switch-lg align-items-center">
                        <input class="form-check-input" type="checkbox" id="has-student">
                        <label class="form-check-label fw-bold ms-2 mt-1" for="has-student">Student Loan</label>
                    </div>
                </div>
                <div class="col-6 mb-2">
                     <div class="form-check form-switch custom-switch-lg align-items-center">
                        <input class="form-check-input" type="checkbox" id="has-personal">
                        <label class="form-check-label fw-bold ms-2 mt-1" for="has-personal">Personal Loan</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <span class="result-label">Credit Mix Score (10% of FICO)</span>
            <h1 class="result-main-value" id="mix-grade" style="color: #059669;">Poor</h1>
            
            <div class="progress-custom mt-4 mb-3" style="height: 10px;">
                <div id="mix-bar" class="progress-bar-custom" style="background: linear-gradient(90deg, #ef4444, #f59e0b, #10b981); width: 25%;"></div>
            </div>
            
            <div class="alert mt-3 text-center border-0 p-2 rounded bg-light" id="mix-suggestion">
                Add an installment loan to improve credit mix.
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calc() {
        const cc = parseInt(document.getElementById('cc-num').value) || 0;
        let installmentTypes = 0;
        if(document.getElementById('has-auto').checked) installmentTypes++;
        if(document.getElementById('has-mortgage').checked) installmentTypes++;
        if(document.getElementById('has-student').checked) installmentTypes++;
        if(document.getElementById('has-personal').checked) installmentTypes++;
        
        let score = 0;
        if(cc > 0) score += 30; // some revolving
        if(cc >= 2 && cc <= 5) score += 20; // optimal revolving
        if(installmentTypes > 0) score += 30; // basic installment
        if(installmentTypes >= 2) score += 20; // diverse installment
        
        // FICO likes seeing a mix of revolving and installment. Max score = 100
        
        let mixGrade = "Poor";
        let msg = "You only have one type of credit. Try diversifying.";
        
        if(score >= 80) { mixGrade = "Excellent"; msg = "Perfect credit mix! You have both revolving and installment accounts."; }
        else if(score >= 50) { mixGrade = "Good"; msg = "Good mix, but adding another installment or revolving account could optimize it further."; }
        else if(score >= 30) { mixGrade = "Fair"; msg = "You need more variety. Consider adding an installment loan if you only have cards."; }
        
        try {
            document.getElementById('mix-grade').innerText = mixGrade;
            document.getElementById('mix-bar').style.width = score + '%';
            document.getElementById('mix-suggestion').innerText = msg;
        } catch(e) {}
    }
    ['cc-num','has-auto','has-mortgage','has-student','has-personal'].forEach(id => document.getElementById(id).addEventListener('change', calc));
    document.getElementById('cc-minus').addEventListener('click', () => { let el=document.getElementById('cc-num'); if(el.value>0) {el.value--; calc();} });
    document.getElementById('cc-plus').addEventListener('click', () => { let el=document.getElementById('cc-num'); el.value++; calc(); });
    calc();
});
</script>
<style>
.custom-switch-lg .form-check-input { width: 3em; height: 1.5em; cursor:pointer;}
</style>

