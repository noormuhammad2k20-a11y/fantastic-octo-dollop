<div class="row g-4 academy-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(15, 23, 42, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #0F172A, #334155); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#0f172a; letter-spacing: -0.5px;">Academic Performance Architect</h4>
                    <p class="text-muted small mb-0">Transform GPA/CGPA into global percentage benchmarks using regional institutional standards.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Input --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Score Parameters</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Current Cumulative Score</label>
                                <input type="number" id="v-gpa" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h4 mb-0" value="3.8" step="0.01">
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Scale</label>
                                    <select id="v-scale" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold">
                                        <option value="4">4.0 (Standard)</option>
                                        <option value="5">5.0 (Weighted)</option>
                                        <option value="10">10.0 (Global)</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Region/Formula</label>
                                    <select id="v-region" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold">
                                        <option value="standard">Standard Ratio</option>
                                        <option value="india">Indian (CGPA x 9.5)</option>
                                        <option value="germany">Bavarian (Modified)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Context --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-slate">
                            <h6 class="fw-bold small mb-3 uppercase text-slate opacity-70">Honor Classification</h6>
                            <div class="vstack gap-3">
                                <div class="p-3 rounded-3 bg-slate-50 border border-slate-100 d-flex justify-content-between align-items-center">
                                    <span class="small fw-bold text-slate-900">LETTER GRADE</span>
                                    <span class="badge bg-dark text-white" id="out-letter">A</span>
                                </div>
                                <div class="p-3 rounded-3 bg-slate-50 border border-slate-100 d-flex justify-content-between align-items-center">
                                    <span class="small fw-bold text-slate-900">ACADEMIC CLASS</span>
                                    <span class="badge bg-dark text-white" id="out-class">SUMMA CUM LAUDE</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-g="4.0" data-s="4">Perfect 4.0</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-g="9.5" data-s="10">Ivy League Aim</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-g="3.0" data-s="4">Dean's List</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 220; --tool-color: #0F172A; --tool-bg: rgba(15, 23, 42, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">PERCENTAGE EQUIVALENCE</span>
                <div class="output-hero-value display-1 fw-900 my-2 serif-font" id="out-perc">95.0%</div>
                <div class="badge bg-dark-soft text-dark px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">OUTSTANDING PERFORMANCE</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Benchmarks --}}
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">International Conversion Matrix</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="small fw-bold py-2">Global System</th>
                                        <th class="small fw-bold py-2 text-end">Equivalent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td class="py-2 text-muted">US 4.0 Scale</td><td class="py-2 text-end fw-bold" id="tbl-us">0.00</td></tr>
                                    <tr><td class="py-2 text-muted">UK 1st Class (Min)</td><td class="py-2 text-end fw-bold">70%</td></tr>
                                    <tr><td class="py-2 text-muted">German Scale (1.0 Best)</td><td class="py-2 text-end fw-bold" id="tbl-de">0.0</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Profile Summary</h6>
                            <div class="p-3 rounded-4 bg-slate-50 border border-slate-100 mb-4">
                                <div class="small fw-bold text-slate-900 lh-base" id="out-advice">Your performance is in the top 5% of global cohorts. Excellent for graduate admissions.</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-dark rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-export me-2"></i>Copy for Resume/CV
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
    const gpaE = $('v-gpa'), scaleE = $('v-scale'), regionE = $('v-region');

    function calculate(){
        let gpa = parseFloat(gpaE.value) || 0;
        let scale = parseFloat(scaleE.value) || 4;
        let region = regionE.value;

        let perc = (gpa / scale) * 100;
        if(region === 'india' && scale === 10) perc = gpa * 9.5;
        
        // Limits
        perc = Math.min(100, Math.max(0, perc));

        $('out-perc').textContent = perc.toFixed(1) + '%';
        
        // Letter Grade
        let letter = 'F';
        if(perc >= 90) letter = 'A+';
        else if(perc >= 80) letter = 'A';
        else if(perc >= 70) letter = 'B';
        else if(perc >= 60) letter = 'C';
        else if(perc >= 50) letter = 'D';
        $('out-letter').textContent = letter;

        // Honor Class
        let honors = 'PASS';
        if(perc >= 95) honors = 'SUMMA CUM LAUDE';
        else if(perc >= 90) honors = 'MAGNA CUM LAUDE';
        else if(perc >= 85) honors = 'CUM LAUDE';
        else if(perc >= 75) honors = 'FIRST CLASS';
        else if(perc >= 60) honors = 'SECOND CLASS';
        $('out-class').textContent = honors;

        // Matrix
        $('tbl-us').textContent = (perc / 25).toFixed(2);
        let ger = 1 + (3 * (100 - perc) / (100 - 50)); // Modified Bavarian
        $('tbl-de').textContent = Math.min(4, Math.max(1, ger)).toFixed(1);

        let status = 'Standard Performance';
        if(perc >= 90) status = 'Outstanding Distinction';
        else if(perc >= 80) status = 'Excellent Progress';
        $('out-status').textContent = status;

        $('out-advice').textContent = perc >= 80 ? 'Exceptional profile. Highly competitive for global fellowships and Tier-1 universities.' : 'Solid academic standing. Consider highlighting specific module strengths in your CV.';
    }

    [gpaE, scaleE, regionE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => { gpaE.value = btn.dataset.g; scaleE.value = btn.dataset.s; calculate(); });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Academic Report\nGPA: ${gpaE.value}/${scaleE.value}\nPercentage: ${$('out-perc').textContent}\nClassification: ${$('out-class').textContent}\nGenerated by ToolsHub Academy Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Report Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { gpaE.value = 3.8; scaleE.value = 4; calculate(); });

    calculate();
});
</script>

<style>
.academy-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#0f172a;opacity:.7;margin-bottom:8px;display:block}
.academy-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-dark { background: #0F172A; color: #fff; transition: all .3s; }
.btn-dark:hover { background: #1e293b; color: #fff; transform: translateY(-2px); }
.text-slate { color: #334155; }
.bg-slate-50 { background-color: #f8fafc; }
.serif-font { font-family: 'Georgia', serif; font-style: italic; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

