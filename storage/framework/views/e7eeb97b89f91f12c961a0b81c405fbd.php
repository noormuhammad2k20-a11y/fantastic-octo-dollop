<div class="row g-4 restructure-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(37, 99, 235, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #2563EB, #1E40AF); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-file-signature"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e3a8a; letter-spacing: -0.5px;">Loan Restructuring Modeler</h4>
                    <p class="text-muted small mb-0">Evaluate the impact of modified terms, principal forgiveness, and repayment extensions on your debt obligation.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-12">
                        <div class="p-4 rounded-4 bg-light border">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <label class="form-label-custom">Current Principal</label>
                                    <div class="input-group input-group-lg bg-white rounded-3 border">
                                        <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                        <input type="number" id="rest-bal" class="form-control border-0 bg-white fw-bold" value="50000">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-custom">Forgiveness Amount ($)</label>
                                    <div class="input-group input-group-lg bg-white rounded-3 border">
                                        <span class="input-group-text border-0 bg-white opacity-40">-$</span>
                                        <input type="number" id="rest-forgive" class="form-control border-0 bg-white fw-bold text-success" value="0">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-custom">Restructuring Fee</label>
                                    <div class="input-group input-group-lg bg-white rounded-3 border">
                                        <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                        <input type="number" id="rest-fee" class="form-control border-0 bg-white fw-bold text-danger" value="250">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border-top border-4 border-slate h-100 shadow-sm" style="background: #f8fafc;">
                            <h6 class="fw-black text-slate text-uppercase small mb-4 tracking-wider">Baseline: Current Terms</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Current Rate (%)</label>
                                    <input type="number" id="rest-rate-old" class="form-control border-0 bg-white rounded-3 fw-bold" value="8.5">
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Remaining Months</label>
                                    <input type="number" id="rest-term-old" class="form-control border-0 bg-white rounded-3 fw-bold" value="36">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border-top border-4 border-blue h-100 shadow-sm" style="background: #eff6ff;">
                            <h6 class="fw-black text-blue text-uppercase small mb-4 tracking-wider">Target: Modified Terms</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Proposed Rate (%)</label>
                                    <input type="number" id="rest-rate-new" class="form-control border-0 bg-white rounded-3 fw-bold" value="5.5">
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">New Term (Months)</label>
                                    <input type="number" id="rest-term-new" class="form-control border-0 bg-white rounded-3 fw-bold" value="60">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 220; --tool-color: #2563EB; --tool-bg: rgba(37, 99, 235, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">NET COST SAVINGS / (LOSS)</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-net-impact">$0</div>
                <div class="badge bg-blue-soft text-blue px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-pmt-change">Monthly Payment: -$0.00</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">MODIFICATION AUDIT</th>
                                        <th class="text-muted small fw-bold py-3 text-end">CURRENT</th>
                                        <th class="text-muted small fw-bold py-3 text-end text-blue">PROPOSED</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Monthly Obligation</td>
                                        <td class="py-3 text-end" id="tbl-pmt-old">$0</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-pmt-new">$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Total Interest Cost</td>
                                        <td class="py-3 text-end" id="tbl-int-old">$0</td>
                                        <td class="py-3 text-end" id="tbl-int-new">$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">Total Lifetime Cost</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-total-old">$0</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-total-new">$0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold mb-3 uppercase small opacity-50">Impact Breakdown</h6>
                            <div class="p-3 rounded-4 bg-light border mb-3">
                                <div class="d-flex justify-content-between">
                                    <span class="small fw-bold text-muted">Term Extension</span>
                                    <span class="small fw-bold" id="out-term-ext">+0 Months</span>
                                </div>
                            </div>
                            <div class="p-3 rounded-4 bg-light border mb-4">
                                <div class="d-flex justify-content-between">
                                    <span class="small fw-bold text-muted">Principal Change</span>
                                    <span class="small fw-bold" id="out-prin-change">-$0</span>
                                </div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-blue rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Restructuring Profile
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const inputs = ['rest-bal', 'rest-forgive', 'rest-fee', 'rest-rate-old', 'rest-term-old', 'rest-rate-new', 'rest-term-new'];

    function pmt(rate, nper, pv) {
        if(rate === 0) return pv / nper;
        return (pv * rate) / (1 - Math.pow(1 + rate, -nper));
    }

    function calculate(){
        let b = parseFloat($('rest-bal').value) || 0;
        let forg = parseFloat($('rest-forgive').value) || 0;
        let fee = parseFloat($('rest-fee').value) || 0;
        
        let rO = (parseFloat($('rest-rate-old').value) || 0) / 100 / 12;
        let tO = parseFloat($('rest-term-old').value) || 1;
        let rN = (parseFloat($('rest-rate-new').value) || 0) / 100 / 12;
        let tN = parseFloat($('rest-term-new').value) || 1;

        // Current
        let pO = pmt(rO, tO, b);
        let iO = (pO * tO) - b;
        let totalO = b + iO;

        // New
        let netB = (b - forg) + fee;
        let pN = pmt(rN, tN, netB);
        let iN = (pN * tN) - netB;
        let totalN = netB + iN;

        let pmtDiff = pN - pO;
        let costDiff = totalO - totalN; // Positive means savings

        // Update UI
        $('out-net-impact').textContent = (costDiff >= 0 ? '$' : '-$') + Math.abs(Math.round(costDiff)).toLocaleString();
        $('out-net-impact').style.color = costDiff >= 0 ? '#10b981' : '#ef4444';
        $('out-pmt-change').textContent = `Monthly Payment: ${pmtDiff >= 0 ? '+' : '-'}$${Math.abs(pmtDiff.toFixed(2))}`;
        $('out-pmt-change').className = `badge ${pmtDiff <= 0 ? 'bg-blue-soft text-blue' : 'bg-red-soft text-red'} px-4 py-2 rounded-pill fw-bold shadow-sm`;

        $('tbl-pmt-old').textContent = '$' + pO.toFixed(2);
        $('tbl-pmt-new').textContent = '$' + pN.toFixed(2);
        $('tbl-int-old').textContent = '$' + Math.round(iO).toLocaleString();
        $('tbl-int-new').textContent = '$' + Math.round(iN).toLocaleString();
        $('tbl-total-old').textContent = '$' + Math.round(totalO).toLocaleString();
        $('tbl-total-new').textContent = '$' + Math.round(totalN).toLocaleString();

        $('out-term-ext').textContent = (tN - tO) + ' Months';
        $('out-prin-change').textContent = '-$' + forg.toLocaleString();
    }

    inputs.forEach(id => $(id).addEventListener('input', calculate));

    $('reset-calc').addEventListener('click', () => {
        $('rest-bal').value = 50000; $('rest-forgive').value = 0; $('rest-fee').value = 250;
        $('rest-rate-old').value = 8.5; $('rest-term-old').value = 36;
        $('rest-rate-new').value = 5.5; $('rest-term-new').value = 60;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Loan Restructuring Analysis\nNet Impact: ${$('out-net-impact').textContent}\nPayment Change: ${$('out-pmt-change').textContent}\nNew Total Cost: ${$('tbl-total-new').textContent}\nGenerated by ToolsHub Negotiation`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.restructure-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e3a8a;opacity:.7;margin-bottom:8px;display:block}
.restructure-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-blue { background: #2563EB; color: #fff; transition: all .3s; }
.btn-blue:hover { background: #1E40AF; color: #fff; transform: translateY(-2px); }
.text-blue { color: #2563EB; }
.bg-blue-soft { background: #EFF6FF; }
.bg-red-soft { background: #FEF2F2; }
.bg-blue { background-color: #2563EB !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\loan-restructuring-calculator.blade.php ENDPATH**/ ?>