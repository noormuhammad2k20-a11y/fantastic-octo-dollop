<div class="row g-4 memento-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0 shadow-lg" style="border-radius: 28px; background: #0f172a; color: #f8fafc;">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #334155, #1e293b); color:#94a3b8; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; border: 1px solid rgba(148, 163, 184, 0.2);">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="letter-spacing: -0.5px;">Memento Mori: Life Horizon Analyst</h4>
                    <p class="text-slate-400 small mb-0">Statistical longevity extraction based on global actuarial data and behavioral modeling.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-slate-900 border border-slate-800 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-slate-500">Actuarial Inputs</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom text-slate-400">Current Age</label>
                                    <input type="number" id="v-age" class="form-control border-0 bg-slate-800 text-white shadow-sm rounded-3 fw-bold h5 mb-0" value="25">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom text-slate-400">Region / Heritage</label>
                                    <select id="v-region" class="form-select border-0 bg-slate-800 text-white shadow-sm rounded-3 fw-bold">
                                        <option value="84">🇯🇵 Japan (84.6 yrs)</option>
                                        <option value="82">🇨🇭 Switzerland (82.9 yrs)</option>
                                        <option value="77" selected>🇺🇸 USA (77.3 yrs)</option>
                                        <option value="71">🇮🇳 India (71.2 yrs)</option>
                                        <option value="54">🇳🇬 Nigeria (54.7 yrs)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom text-slate-400">Biological Sex</label>
                                <div class="btn-group w-100 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                    <input type="radio" class="btn-check" name="v-sex" id="sex-m" value="m" checked>
                                    <label class="btn btn-outline-slate border-slate-800 py-3 small fw-bold" for="sex-m">Male (-3yrs Stat)</label>
                                    <input type="radio" class="btn-check" name="v-sex" id="sex-f" value="f">
                                    <label class="btn btn-outline-slate border-slate-800 py-3 small fw-bold" for="sex-f">Female (+3yrs Stat)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-slate-900 border-slate-800">
                            <h6 class="fw-bold small mb-3 uppercase text-slate-500">Behavioral Vectors</h6>
                            <div class="vstack gap-3">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-slate-300">Daily Exercise (30m+)</label>
                                    <input class="form-check-input" type="checkbox" id="v-ex" checked>
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-slate-300">Smoker / Heavy Nicotine</label>
                                    <input class="form-check-input" type="checkbox" id="v-smoke">
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-slate-300">High Stress Occupation</label>
                                    <input class="form-check-input" type="checkbox" id="v-stress">
                                </div>
                                <hr class="border-slate-800 my-1">
                                <div class="small text-slate-500 italic lh-sm">"Statistics are not fate, but patterns of probability."</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 210; --tool-color: #94a3b8; --tool-bg: rgba(148, 163, 184, .04);">
            <div class="output-hero text-center py-5" style="background: radial-gradient(circle at center, rgba(148, 163, 184, 0.05) 0%, transparent 70%);">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small text-slate-500">PROJECTED LIFE HORIZON</span>
                <div class="output-hero-value display-1 fw-900 my-2 text-slate-800" id="out-expectancy">77</div>
                <div class="badge bg-slate-soft text-slate px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">STATISTICAL MEDIAN</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50 text-slate-600">The Temporal Balance</h6>
                        <div class="row g-2">
                            <div class="col-6"><div class="p-4 rounded-4 bg-slate-50 border border-slate-100 text-center"><div class="h3 fw-900 mb-0" id="out-rem">52</div><div class="small fw-bold text-slate-400 uppercase">Years Remaining</div></div></div>
                            <div class="col-6"><div class="p-4 rounded-4 bg-slate-50 border border-slate-100 text-center"><div class="h3 fw-900 mb-0" id="out-perc">32%</div><div class="small fw-bold text-slate-400 uppercase">Life Completed</div></div></div>
                        </div>
                        <div class="mt-3 p-3 rounded-4 bg-slate-900 text-white shadow-lg">
                            <div class="progress mb-2" style="height: 8px; background: #334155;">
                                <div class="progress-bar bg-slate-400" id="out-prog" style="width: 32%"></div>
                            </div>
                            <div class="d-flex justify-content-between small fw-bold opacity-70">
                                <span>BIRTH</span>
                                <span>THE END</span>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50 text-slate-600">Legacy Command</h6>
                            <div class="p-3 rounded-4 bg-slate-50 border border-slate-100 mb-4">
                                <div class="small fw-bold text-slate-900 mb-1">PROBABILISTIC INSIGHT</div>
                                <div class="small text-muted lh-base" id="out-advice">Lifestyle optimizations could theoretically add up to 8.4 years to your horizon.</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-slate rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-scroll me-2"></i>Copy Life Audit
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Actuary
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
    const ageE = $('v-age'), regE = $('v-region'), exE = $('v-ex'), smokeE = $('v-smoke'), stressE = $('v-stress');

    function calculate(){
        const age = parseFloat(ageE.value) || 0;
        const regionBase = parseFloat(regE.value);
        const isFemale = document.getElementById('sex-f').checked;

        let expect = regionBase;
        
        // Biological adjustments
        if(isFemale) expect += 3.5;
        else expect -= 2.5;

        // Behavioral adjustments
        if(exE.checked) expect += 5.2;
        if(smokeE.checked) expect -= 10.4;
        if(stressE.checked) expect -= 3.1;

        const rem = Math.max(0, expect - age);
        const perc = Math.min(100, (age / expect) * 100);

        $('out-expectancy').textContent = expect.toFixed(1);
        $('out-rem').textContent = rem.toFixed(1);
        $('out-perc').textContent = Math.round(perc) + '%';
        $('out-prog').style.width = perc + '%';

        // Advice
        let adv = "Your statistics are above the global median. Focus on preventative health to maintain this horizon.";
        if(smokeE.checked) adv = "Statistical impact of nicotine is profound. Quitting today could regain approx. 10 years.";
        if(rem < 10) adv = "Horizon approaching median. Every moment is a high-value legacy opportunity.";
        
        $('out-advice').textContent = adv;
        $('out-status').textContent = expect > 80 ? 'HIGH LONGEVITY POTENTIAL' : 'STANDARD STATISTICAL ARC';
    }

    [ageE, regE, exE, smokeE, stressE].forEach(e => e.addEventListener('input', calculate));
    document.querySelectorAll('input[name="v-sex"]').forEach(e => e.addEventListener('change', calculate));

    $('copy-summary').addEventListener('click', function(){
        const txt = `Life Horizon Audit (Actuarial Estimate)\nAge: ${ageE.value}\nExpected Span: ${$('out-expectancy').textContent} Years\nCompleted: ${$('out-perc').textContent}\nRemaining: ${$('out-rem').textContent} Years\nGenerated by Memento Mori Analyst`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Audit Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { ageE.value = 25; calculate(); });

    calculate();
});
</script>

<style>
.memento-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#94a3b8;opacity:.7;margin-bottom:8px;display:block}
.memento-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-slate { background: #334155; color: #fff; transition: all .3s; }
.btn-slate:hover { background: #1e293b; color: #fff; transform: translateY(-2px); }
.btn-outline-slate { color: #94a3b8; border: 1px solid #334155; }
.btn-check:checked + .btn-outline-slate { background: #334155; color: #fff; border-color: #334155; }
.bg-slate-soft { background: #f1f5f9; color: #475569; }
.text-slate-400 { color: #94a3b8; }
.text-slate-300 { color: #cbd5e1; }
.text-slate-600 { color: #475569; }
.bg-slate-900 { background-color: #020617; }
.bg-slate-800 { background-color: #1e293b; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.italic { font-style: italic; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\death-calculator.blade.php ENDPATH**/ ?>