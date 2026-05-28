<div class="row g-4 tb-modern">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(16, 185, 129, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-emerald" style="background: linear-gradient(135deg, #10B981, #059669); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-square-poll-vertical"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#064e3b; letter-spacing: -0.5px;">Total Bases Architect</h4>
                    <p class="text-muted small mb-0">Quantify offensive production by calculating total bases achieved through the diamond.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Hit Distribution --}}
                    <div class="col-md-3 col-6">
                        <div class="p-4 rounded-4 bg-emerald-50 border border-emerald-100 h-100 text-center">
                            <h6 class="fw-bold small mb-3 uppercase text-emerald-800 opacity-70">Singles (1B)</h6>
                            <input type="number" id="singles" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h4 mb-0 text-center" value="50" min="0">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="p-4 rounded-4 bg-teal-50 border border-teal-100 h-100 text-center">
                            <h6 class="fw-bold small mb-3 uppercase text-teal-800 opacity-70">Doubles (2B)</h6>
                            <input type="number" id="doubles" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h4 mb-0 text-center" value="15" min="0">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="p-4 rounded-4 bg-cyan-50 border border-cyan-100 h-100 text-center">
                            <h6 class="fw-bold small mb-3 uppercase text-cyan-800 opacity-70">Triples (3B)</h6>
                            <input type="number" id="triples" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h4 mb-0 text-center" value="2" min="0">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="p-4 rounded-4 bg-sky-50 border border-sky-100 h-100 text-center">
                            <h6 class="fw-bold small mb-3 uppercase text-sky-800 opacity-70">Home Runs (HR)</h6>
                            <input type="number" id="hr" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h4 mb-0 text-center" value="10" min="0">
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="100" data-d="30" data-t="5" data-hr="20">All-Star Season</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="60" data-d="40" data-t="2" data-hr="45">Power Hitter</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="150" data-d="20" data-t="10" data-hr="5">Contact Specialist</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 150; --tool-color: #10B981; --tool-bg: rgba(16, 185, 129, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL OFFENSIVE BASES</span>
                <div class="output-hero-value display-2 fw-900 my-2 text-emerald-900" id="out-tb">126</div>
                <div class="badge bg-emerald-soft text-emerald px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-hits">77 TOTAL HITS</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Base Contribution Bar --}}
                    <div class="col-12">
                        <h6 class="fw-bold small mb-3 uppercase text-center opacity-50">Base Distribution</h6>
                        <div class="progress rounded-pill shadow-sm overflow-hidden" style="height: 35px;">
                            <div id="bar-1b" class="progress-bar bg-emerald" style="width: 40%" data-bs-toggle="tooltip" title="Singles">1B</div>
                            <div id="bar-2b" class="progress-bar bg-teal" style="width: 24%" data-bs-toggle="tooltip" title="Doubles">2B</div>
                            <div id="bar-3b" class="progress-bar bg-cyan" style="width: 5%" data-bs-toggle="tooltip" title="Triples">3B</div>
                            <div id="bar-hr" class="progress-bar bg-sky" style="width: 31%" data-bs-toggle="tooltip" title="Home Runs">HR</div>
                        </div>
                    </div>

                    <div class="col-md-6 text-center">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-2 uppercase opacity-50">Extra Base Hits (XBH)</h6>
                            <div class="h2 fw-900 mb-0 text-emerald-700" id="stat-xbh">27</div>
                            <small class="text-muted">Hits beyond 1st base</small>
                        </div>
                    </div>

                    <div class="col-md-6 text-center">
                        <div class="p-4 rounded-4 border bg-light h-100">
                            <h6 class="fw-bold small mb-2 uppercase opacity-50">Bases Per Hit</h6>
                            <div class="h2 fw-900 mb-0 text-emerald-700" id="stat-bph">1.64</div>
                            <small class="text-muted">Offensive efficiency</small>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-12 border-top pt-4">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto btn-emerald rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Base Report
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto btn-outline-dark rounded-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Calculator
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
    const sIn = $('singles'), dIn = $('doubles'), tIn = $('triples'), hrIn = $('hr');

    function calculate(){
        const s = parseInt(sIn.value) || 0;
        const d = parseInt(dIn.value) || 0;
        const t = parseInt(tIn.value) || 0;
        const hr = parseInt(hrIn.value) || 0;

        const tb = s + (2 * d) + (3 * t) + (4 * hr);
        const hits = s + d + t + hr;
        const xbh = d + t + hr;
        const bph = hits > 0 ? tb / hits : 0;

        $('out-tb').textContent = tb;
        $('out-hits').textContent = hits + ' TOTAL HITS';
        $('stat-xbh').textContent = xbh;
        $('stat-bph').textContent = bph.toFixed(2);

        if(tb > 0){
            $('bar-1b').style.width = (s / tb * 100) + '%';
            $('bar-2b').style.width = (d * 2 / tb * 100) + '%';
            $('bar-3b').style.width = (t * 3 / tb * 100) + '%';
            $('bar-hr').style.width = (hr * 4 / tb * 100) + '%';
        } else {
            [$('bar-1b'), $('bar-2b'), $('bar-3b'), $('bar-hr')].forEach(b => b.style.width = '0%');
        }
    }

    [sIn, dIn, tIn, hrIn].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            sIn.value = btn.dataset.s;
            dIn.value = btn.dataset.d;
            tIn.value = btn.dataset.t;
            hrIn.value = btn.dataset.hr;
            calculate();
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Baseball Offensive Report\nTotal Bases: ${$('out-tb').textContent}\nHits: ${$('out-hits').textContent}\nXBH: ${$('stat-xbh').textContent}\nBases Per Hit: ${$('stat-bph').textContent}\nGenerated by ToolsHub Sports Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => {
        sIn.value = 50; dIn.value = 15; tIn.value = 2; hrIn.value = 10;
        calculate();
    });

    calculate();
});
</script>

<style>
.tb-modern .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#065f46;opacity:.7;margin-bottom:8px;display:block}
.btn-emerald { background: #10B981; color: #fff; transition: all .3s; }
.btn-emerald:hover { background: #059669; color: #fff; transform: translateY(-2px); }
.bg-emerald-soft { background: #ECFDF5; color: #10B981; }
.bg-emerald-50 { background-color: #f0fdf4; }
.bg-teal-50 { background-color: #f0fdfa; }
.bg-cyan-50 { background-color: #ecfeff; }
.bg-sky-50 { background-color: #f0f9ff; }
.fw-900 { font-weight: 900; }
.pulse-emerald { animation: emerald-pulse 2s infinite; }
@keyframes emerald-pulse { 0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); } 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); } }
</style>


