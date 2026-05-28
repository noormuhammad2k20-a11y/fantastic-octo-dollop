<div class="row g-4 spiral-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(168, 85, 247, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #A855F7, #7E22CE); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-biohazard"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#2e1065; letter-spacing: -0.5px;">Debt Spiral Risk Diagnostic</h4>
                    <p class="text-muted small mb-0">Detect if your interest charges are outpacing your payments. Model the "Vortex" effect where debt grows despite regular payments.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Current Debt Vector</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Total Interest-Bearing Debt</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                    <input type="number" id="v-debt" class="form-control border-0 bg-white fw-bold" value="12000">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Weighted Average APR (%)</label>
                                    <input type="number" id="v-apr" class="form-control border-0 bg-white rounded-3 fw-bold" value="24.99">
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-purple">
                            <h6 class="fw-bold small mb-3 uppercase text-purple opacity-70">Payment Velocity</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Planned Monthly Payment</label>
                                <div class="input-group input-group-lg bg-light rounded-3 border">
                                    <span class="input-group-text border-0 bg-light opacity-40">$</span>
                                    <input type="number" id="v-pay" class="form-control border-0 bg-light fw-bold" value="250">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom text-danger">New Monthly Charging ($)</label>
                                    <input type="number" id="v-new" class="form-control border-0 bg-light rounded-3 fw-bold" value="50">
                                    <div class="small text-muted mt-1">Modeling ongoing credit use</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-a="29.99" data-p="300">Default Rate Scenario</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-a="15.00" data-p="500">Consolidation Hope</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 270; --tool-color: #A855F7; --tool-bg: rgba(168, 85, 247, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">SPIRAL TRAJECTORY STATUS</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-status">CRITICAL</div>
                <div class="badge bg-purple-soft text-purple px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-time">Payoff: Never (Growing)</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">MONTHLY DYNAMICS</th>
                                        <th class="text-muted small fw-bold py-3 text-end">VALUES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Interest Generated</td>
                                        <td class="py-3 text-end text-danger" id="tbl-int">$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">New Balance Inflow</td>
                                        <td class="py-3 text-end text-danger" id="tbl-inflow">+$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">Net Principal Reduction</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-net">-$0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4 text-center">
                            <h6 class="fw-bold mb-3 uppercase small opacity-50">Vortex Depth Index</h6>
                            <div class="spiral-meter mx-auto mb-3" id="vortex-container" style="width: 120px; height: 120px; border-radius: 50%; border: 8px solid #f1f5f9; display: flex; align-items: center; justify-content: center; position: relative;">
                                <div id="vortex-fill" style="position: absolute; width: 100%; height: 100%; border-radius: 50%; border: 8px solid transparent; border-top-color: #A855F7; transform: rotate(0deg); transition: all 0.5s;"></div>
                                <span class="fw-black h3 mb-0" id="vortex-pct">0%</span>
                            </div>
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-purple rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-radiation me-2"></i>Copy Spiral Diagnostic
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
    const inputs = ['v-debt', 'v-apr', 'v-pay', 'v-new'];

    function calculate(){
        let debt = parseFloat($('v-debt').value) || 0;
        let apr = (parseFloat($('v-apr').value) || 0) / 100 / 12;
        let pay = parseFloat($('v-pay').value) || 0;
        let newCharges = parseFloat($('v-new').value) || 0;

        let interest = debt * apr;
        let netReduction = pay - (interest + newCharges);
        
        let status = 'HEALTHY'; let col = '#10b981'; let timeStr = 'N/A';
        let vortexPct = 0;

        if(netReduction <= 0) {
            status = 'CRITICAL SPIRAL';
            col = '#991b1b';
            timeStr = 'Never (Debt Growing)';
            vortexPct = 100;
        } else {
            // Predict Time
            let b = debt; let m = 0;
            while(b > 0 && m < 1200) {
                b += (b * apr) + newCharges - pay;
                m++;
            }
            if(m >= 1200) {
                status = 'STAGNANT'; col = '#ef4444';
                timeStr = '99+ Years';
                vortexPct = 90;
            } else {
                status = 'DEFLATIONARY'; col = '#10b981';
                timeStr = `${Math.floor(m/12)}y ${m%12}m`;
                vortexPct = Math.round((interest / pay) * 100);
            }
        }

        // Update UI
        $('out-status').textContent = status;
        $('out-status').style.color = col;
        $('out-time').textContent = `Payoff Time: ${timeStr}`;
        
        $('tbl-int').textContent = '$' + interest.toFixed(2);
        $('tbl-inflow').textContent = '+$' + newCharges.toFixed(2);
        $('tbl-net').textContent = (netReduction >= 0 ? '-' : '+') + '$' + Math.abs(netReduction).toFixed(2);
        $('tbl-net').style.color = netReduction >= 0 ? '#10b981' : '#ef4444';

        $('vortex-pct').textContent = vortexPct + '%';
        $('vortex-fill').style.transform = `rotate(${(vortexPct/100)*360}deg)`;
        $('vortex-fill').style.borderColor = col;
    }

    inputs.forEach(id => $(id).addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            $('v-apr').value = btn.dataset.a;
            $('v-pay').value = btn.dataset.p;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        $('v-debt').value = 12000; $('v-apr').value = 24.99; $('v-pay').value = 250; $('v-new').value = 50;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Debt Spiral Risk Diagnostic\nStatus: ${$('out-status').textContent}\nVortex Intensity: ${$('vortex-pct').textContent}\nNet Reduction: ${$('tbl-net').textContent}\nGenerated by ToolsHub Financial Guard`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.spiral-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#2e1065;opacity:.7;margin-bottom:8px;display:block}
.spiral-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-purple { background: #A855F7; color: #fff; transition: all .3s; }
.btn-purple:hover { background: #7E22CE; color: #fff; transform: translateY(-2px); }
.text-purple { color: #A855F7; }
.bg-purple-soft { background: #FAF5FF; }
.bg-purple { background-color: #A855F7 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\debt-spiral-risk-calculator.blade.php ENDPATH**/ ?>