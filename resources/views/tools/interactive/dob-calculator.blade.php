<div class="row g-4 life-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(59, 130, 246, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #3B82F6, #60A5FA); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-baby"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e3a8a; letter-spacing: -0.5px;">Life Chronicle (DOB) Analyst</h4>
                    <p class="text-muted small mb-0">Discover your exact biological age, planetary alignment, and temporal footprint on Earth.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Birthday --}}
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Original Epoch (Date of Birth)</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Select Your Birth Date</label>
                                <input type="date" id="v-dob" class="form-control border-0 bg-white shadow-sm rounded-4 p-4 fw-bold h4 mb-0" value="2000-01-01">
                            </div>
                            <div class="row g-2">
                                <div class="col-4">
                                    <button class="btn btn-white w-100 rounded-pill py-2 small fw-bold shadow-sm quick-load" data-v="1990-01-01">Gen X/Y</button>
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-white w-100 rounded-pill py-2 small fw-bold shadow-sm quick-load" data-v="2000-01-01">Millennial</button>
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-white w-100 rounded-pill py-2 small fw-bold shadow-sm quick-load" data-v="2010-01-01">Gen Alpha</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Context --}}
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-blue">
                            <h6 class="fw-bold small mb-3 uppercase text-blue opacity-70">Cosmic Profile</h6>
                            <div class="vstack gap-3">
                                <div class="p-3 rounded-3 bg-blue-50 border border-blue-100 d-flex justify-content-between align-items-center">
                                    <span class="small fw-bold text-blue-900">ZODIAC SIGN</span>
                                    <span class="badge bg-blue text-white" id="out-zodiac">CAPRICORN</span>
                                </div>
                                <div class="p-3 rounded-3 bg-blue-50 border border-blue-100 d-flex justify-content-between align-items-center">
                                    <span class="small fw-bold text-blue-900">LIFE STAGE</span>
                                    <span class="badge bg-blue text-white" id="out-stage">ADULTHOOD</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 210; --tool-color: #3B82F6; --tool-bg: rgba(59, 130, 246, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">EXACT BIOLOGICAL AGE</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-age">24</div>
                <div class="badge bg-blue-soft text-blue px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-next">NEXT BIRTHDAY: 302 DAYS</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Metrics Matrix --}}
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Temporal Footprint Matrix</h6>
                        <div class="row g-2">
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">MONTHS</div><div class="h5 fw-bold mb-0" id="out-months">288</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">WEEKS</div><div class="h5 fw-bold mb-0" id="out-weeks">1,252</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">DAYS</div><div class="h5 fw-bold mb-0" id="out-days">8,760</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">HEARTBEATS (EST)</div><div class="h5 fw-bold mb-0" id="out-hearts">1.2B</div></div></div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Life Report</h6>
                            <div class="p-3 rounded-4 bg-blue-50 border border-blue-100 mb-4 text-center">
                                <div class="small fw-bold text-blue-900 mb-1" id="out-day">BORN ON A SATURDAY</div>
                                <div class="small text-muted" id="out-fun">You have lived through 6 Leap Years!</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-blue rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-contract me-2"></i>Copy Chronicle Report
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
    const dobE = $('v-dob');

    function calculate(){
        const dob = new Date(dobE.value);
        const now = new Date();
        if(isNaN(dob.getTime())) return;

        let y = now.getFullYear() - dob.getFullYear();
        let m = now.getMonth() - dob.getMonth();
        let d = now.getDate() - dob.getDate();

        if (m < 0 || (m === 0 && d < 0)) { y--; m += 12; }
        if (d < 0) { m--; const last = new Date(now.getFullYear(), now.getMonth(), 0); d += last.getDate(); }

        $('out-age').textContent = y;
        $('out-months').textContent = (y * 12 + m).toLocaleString();
        
        const diff = Math.abs(now - dob);
        const diffDays = Math.ceil(diff / (1000 * 60 * 60 * 24));
        $('out-days').textContent = diffDays.toLocaleString();
        $('out-weeks').textContent = (diffDays / 7).toFixed(0).toLocaleString();
        $('out-hearts').textContent = ((diffDays * 24 * 60 * 72) / 1e9).toFixed(1) + 'B';

        // Next Bday
        let next = new Date(now.getFullYear(), dob.getMonth(), dob.getDate());
        if(next < now) next.setFullYear(now.getFullYear() + 1);
        const nextDiff = Math.ceil((next - now) / (1000 * 60 * 60 * 24));
        $('out-next').textContent = `NEXT BIRTHDAY: ${nextDiff} DAYS`;

        // Day of Week
        const days = ['SUNDAY', 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY'];
        $('out-day').textContent = `BORN ON A ${days[dob.getDay()]}`;

        // Zodiac
        const zodiacs = [
            {n:'CAPRICORN', d:20}, {n:'AQUARIUS', d:19}, {n:'PISCES', d:20}, {n:'ARIES', d:20}, {n:'TAURUS', d:21}, {n:'GEMINI', d:21},
            {n:'CANCER', d:22}, {n:'LEO', d:22}, {n:'VIRGO', d:23}, {n:'LIBRA', d:23}, {n:'SCORPIO', d:22}, {n:'SAGITTARIUS', d:21}, {n:'CAPRICORN', d:31}
        ];
        const month = dob.getMonth();
        const day = dob.getDate();
        const sign = (day < zodiacs[month].d) ? zodiacs[month].n : zodiacs[month+1].n;
        $('out-zodiac').textContent = sign;

        // Stage
        let stage = 'ADULTHOOD';
        if(y < 3) stage = 'INFANCY';
        else if(y < 13) stage = 'CHILDHOOD';
        else if(y < 20) stage = 'ADOLESCENCE';
        else if(y > 65) stage = 'ELDER';
        $('out-stage').textContent = stage;
    }

    dobE.addEventListener('input', calculate);
    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => { dobE.value = btn.dataset.v; calculate(); });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Life Chronicle Report\nAge: ${$('out-age').textContent} Years\nZodiac: ${$('out-zodiac').textContent}\nDays Lived: ${$('out-days').textContent}\nGenerated by ToolsHub Chronicle Analyst`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Chronicle Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { dobE.value = '2000-01-01'; calculate(); });

    calculate();
});
</script>

<style>
.life-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e3a8a;opacity:.7;margin-bottom:8px;display:block}
.life-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-blue { background: #3B82F6; color: #fff; transition: all .3s; }
.btn-blue:hover { background: #2563EB; color: #fff; transform: translateY(-2px); }
.bg-blue-soft { background: #EFF6FF; color: #3B82F6; }
.bg-blue-50 { background-color: #f8fbff; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

