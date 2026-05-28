<div class="row g-4 timeline-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(249, 115, 22, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #F97316, #D946EF); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#431407; letter-spacing: -0.5px;">Timeline Architect</h4>
                    <p class="text-muted small mb-0">High-precision temporal mapping and date interval calculation for project management and personal milestones.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Anchor Points --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Temporal Anchor Points</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Epoch Start (Initial Date)</label>
                                <input type="date" id="v-start" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Target Horizon (End Date)</label>
                                <input type="date" id="v-end" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="{{ date('Y-m-d', strtotime('+30 days')) }}">
                            </div>
                        </div>
                    </div>

                    {{-- Mapping Config --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-orange">
                            <h6 class="fw-bold small mb-3 uppercase text-orange opacity-70">Interval Configuration</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-12">
                                    <label class="form-label-custom">Exclusion Logic</label>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="v-business">
                                        <label class="form-check-label small fw-bold text-muted">Exclude Weekends (Business Days)</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="form-label-custom">Add Years</label>
                                    <input type="number" id="v-add-y" class="form-control border-0 bg-light rounded-3 fw-bold" value="0">
                                </div>
                                <div class="col-4">
                                    <label class="form-label-custom">Add Months</label>
                                    <input type="number" id="v-add-m" class="form-control border-0 bg-light rounded-3 fw-bold" value="0">
                                </div>
                                <div class="col-4">
                                    <label class="form-label-custom">Add Days</label>
                                    <input type="number" id="v-add-d" class="form-control border-0 bg-light rounded-3 fw-bold" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-d="30">30 Day Milestone</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-d="90">Quarterly Horizon</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-y="1">Annual Forecast</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 25; --tool-color: #F97316; --tool-bg: rgba(249, 115, 22, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">CALCULATED INTERVAL</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-days">30</div>
                <div class="badge bg-orange-soft text-orange px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">TOTAL CALENDAR DAYS</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Granular Matrix --}}
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Granular Temporal Matrix</h6>
                        <div class="row g-2">
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light small fw-bold text-center" id="out-weeks">4 Weeks, 2 Days</div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light small fw-bold text-center" id="out-hours">720 Hours</div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light small fw-bold text-center" id="out-minutes">43,200 Minutes</div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light small fw-bold text-center" id="out-seconds">2.5M Seconds</div></div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Event Export</h6>
                            <div class="p-3 rounded-4 bg-orange-50 border border-orange-100 mb-4">
                                <div class="small fw-bold text-orange-900 lh-base" id="out-advice">Target date: {{ date('M d, Y', strtotime('+30 days')) }}</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-orange rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-calendar-check me-2"></i>Copy Temporal Report
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Epoch
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
    const startE = $('v-start'), endE = $('v-end'), bizE = $('v-business'), addYE = $('v-add-y'), addME = $('v-add-m'), addDE = $('v-add-d');

    function calculate(){
        const d1 = new Date(startE.value);
        let d2 = new Date(endE.value);

        // Handle Additions if any values present
        const addY = parseInt(addYE.value) || 0;
        const addM = parseInt(addME.value) || 0;
        const addD = parseInt(addDE.value) || 0;

        if(addY !== 0 || addM !== 0 || addD !== 0){
            d2 = new Date(d1);
            d2.setFullYear(d2.getFullYear() + addY);
            d2.setMonth(d2.getMonth() + addM);
            d2.setDate(d2.getDate() + addD);
            endE.value = d2.toISOString().split('T')[0];
        }

        let diffTime = d2 - d1;
        let diffDays = Math.round(diffTime / (1000 * 60 * 60 * 24));

        if(bizE.checked){
            let count = 0;
            let cur = new Date(d1);
            while(cur < d2){
                cur.setDate(cur.getDate() + 1);
                const day = cur.getDay();
                if(day !== 0 && day !== 6) count++;
            }
            diffDays = count;
            $('out-status').textContent = 'BUSINESS DAYS (MON-FRI)';
        } else {
            $('out-status').textContent = 'TOTAL CALENDAR DAYS';
        }

        $('out-days').textContent = diffDays.toLocaleString();
        $('out-weeks').textContent = `${Math.floor(diffDays/7)} Weeks, ${diffDays%7} Days`;
        $('out-hours').textContent = (diffDays * 24).toLocaleString() + ' Hours';
        $('out-minutes').textContent = (diffDays * 24 * 60).toLocaleString() + ' Minutes';
        $('out-seconds').textContent = (diffDays * 24 * 60 * 60).toLocaleString() + ' Seconds';

        $('out-advice').textContent = `Final Horizon: ${d2.toLocaleDateString('en-US', {month: 'short', day: 'numeric', year: 'numeric'})}`;
    }

    [startE, endE, bizE, addYE, addME, addDE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            const now = new Date();
            if(btn.dataset.d) now.setDate(now.getDate() + parseInt(btn.dataset.d));
            if(btn.dataset.y) now.setFullYear(now.getFullYear() + parseInt(btn.dataset.y));
            endE.value = now.toISOString().split('T')[0];
            calculate();
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Timeline Architect Report\nStart: ${startE.value}\nEnd: ${endE.value}\nInterval: ${$('out-days').textContent} Days\nBreakdown: ${$('out-weeks').textContent}\nGenerated by ToolsHub Timeline Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => {
        startE.value = new Date().toISOString().split('T')[0];
        calculate();
    });

    calculate();
});
</script>

<style>
.timeline-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#431407;opacity:.7;margin-bottom:8px;display:block}
.timeline-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-orange { background: #F97316; color: #fff; transition: all .3s; }
.btn-orange:hover { background: #EA580C; color: #fff; transform: translateY(-2px); }
.bg-orange-soft { background: #FFF7ED; color: #F97316; }
.bg-orange-50 { background-color: #fffaf5; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

