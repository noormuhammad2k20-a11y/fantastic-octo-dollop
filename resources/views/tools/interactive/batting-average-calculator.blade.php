<div class="row g-4 batting-modern">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(15, 23, 42, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-blue" style="background: linear-gradient(135deg, #1E293B, #334155); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-baseball-bat-ball"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#0f172a; letter-spacing: -0.5px;">Batting Performance Architect</h4>
                    <p class="text-muted small mb-0">Calculate Batting Average (AVG) and On-Base Percentage (OBP) with professional tiering.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Primary Stats --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-slate-50 border border-slate-100 h-100 position-relative overflow-hidden">
                            <div class="position-absolute top-0 end-0 p-3 opacity-10">
                                <i class="fas fa-circle-dot fa-4x rotate-12"></i>
                            </div>
                            <h6 class="fw-bold small mb-3 uppercase text-slate-800 opacity-70">Plate Appearance Basics</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Hits (H)</label>
                                    <input type="number" id="hits" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="150" min="0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">At Bats (AB)</label>
                                    <input type="number" id="at-bats" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="500" min="1">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- On-Base Components --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-blue-50 border border-blue-100 h-100 position-relative overflow-hidden">
                            <div class="position-absolute top-0 end-0 p-3 opacity-10">
                                <i class="fas fa-person-walking-dashed-line fa-4x -rotate-12"></i>
                            </div>
                            <h6 class="fw-bold small mb-3 uppercase text-blue-800 opacity-70">On-Base Components</h6>
                            <div class="row g-3">
                                <div class="col-4">
                                    <label class="form-label-custom">Walks (BB)</label>
                                    <input type="number" id="walks" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="50" min="0">
                                </div>
                                <div class="col-4">
                                    <label class="form-label-custom">HBP</label>
                                    <input type="number" id="hbp" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="5" min="0">
                                </div>
                                <div class="col-4">
                                    <label class="form-label-custom">Sac Flies</label>
                                    <input type="number" id="sf" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold" value="5" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-h="262" data-ab="704" data-bb="49" data-hbp="4" data-sf="3">Ichiro '04 (.372)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-h="197" data-ab="485" data-bb="232" data-hbp="9" data-sf="3">Bonds '04 (.406 AVG / .609 OBP)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-h="185" data-ab="600" data-bb="60" data-hbp="5" data-sf="5">All-Star (.308)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-h="150" data-ab="600" data-bb="45" data-hbp="2" data-sf="3">League Avg (.250)</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 215; --tool-color: #1E293B; --tool-bg: rgba(30, 41, 59, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">PLAYER BATTING GRADE</span>
                <div class="output-hero-value display-2 fw-900 my-2 text-slate-900" id="out-grade">AVERAGE</div>
                <div class="badge bg-slate-900 text-white px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-avg">.300 AVG</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Key Metrics --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border bg-light h-100 text-center position-relative">
                            <h6 class="fw-bold small mb-2 uppercase opacity-50">On-Base Percentage (OBP)</h6>
                            <div class="h2 fw-900 mb-0 text-blue-600" id="out-obp">.350</div>
                            <div class="small fw-bold text-muted mt-1">Plate Discipline Rating</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border bg-light h-100 text-center">
                            <h6 class="fw-bold small mb-2 uppercase opacity-50">Total Plate Appearances</h6>
                            <div class="h2 fw-900 mb-0" id="out-pa">560</div>
                            <div class="small fw-bold text-muted mt-1">Hits / AB Ratio: <span id="out-ratio">150/500</span></div>
                        </div>
                    </div>

                    {{-- Visual Tier Scale --}}
                    <div class="col-12">
                        <h6 class="fw-bold small mb-3 uppercase text-center opacity-50">Batting Average Benchmarks</h6>
                        <div class="position-relative mb-4 pt-2">
                            <div class="progress rounded-pill shadow-sm overflow-hidden" style="height: 12px;">
                                <div class="progress-bar bg-danger" style="width: 20%"></div>
                                <div class="progress-bar bg-warning" style="width: 20%"></div>
                                <div class="progress-bar bg-info" style="width: 20%"></div>
                                <div class="progress-bar bg-primary" style="width: 20%"></div>
                                <div class="progress-bar bg-success" style="width: 20%"></div>
                            </div>
                            <div class="position-absolute top-0" id="avg-marker" style="left: 50%; transform: translateX(-50%); transition: left 0.5s ease;">
                                <div class="bg-dark text-white px-2 py-1 rounded-pill small fw-bold shadow">▼</div>
                            </div>
                            <div class="d-flex justify-content-between mt-2 small fw-bold opacity-50 px-1">
                                <span>.200</span>
                                <span>.250</span>
                                <span>.300</span>
                                <span>.350</span>
                                <span>.400+</span>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-12 border-top pt-4">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto btn-slate-900 rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Hitting Summary
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto btn-outline-dark rounded-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Stats
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
    const inputs = ['hits', 'at-bats', 'walks', 'hbp', 'sf'];

    function calculate(){
        const h = parseInt($('hits').value) || 0;
        const ab = parseInt($('at-bats').value) || 1;
        const bb = parseInt($('walks').value) || 0;
        const hbp = parseInt($('hbp').value) || 0;
        const sf = parseInt($('sf').value) || 0;

        const avg = h / ab;
        const pa = ab + bb + hbp + sf;
        const obp = pa > 0 ? (h + bb + hbp) / pa : 0;

        const format = val => val.toFixed(3).substring(val < 1 ? 1 : 0);

        $('out-avg').textContent = format(avg) + ' AVG';
        $('out-obp').textContent = format(obp);
        $('out-pa').textContent = pa;
        $('out-ratio').textContent = `${h}/${ab}`;

        let grade = '', markerPos = 0;
        if (avg >= .400) { grade = 'LEGENDARY'; markerPos = 90; }
        else if (avg >= .330) { grade = 'ELITE'; markerPos = 75; }
        else if (avg >= .300) { grade = 'ALL-STAR'; markerPos = 60; }
        else if (avg >= .270) { grade = 'ABOVE AVG'; markerPos = 45; }
        else if (avg >= .240) { grade = 'AVERAGE'; markerPos = 30; }
        else { grade = 'BELOW AVG'; markerPos = 10; }

        $('out-grade').textContent = grade;
        $('avg-marker').style.left = markerPos + '%';
    }

    inputs.forEach(id => $(id).addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            $('hits').value = btn.dataset.h;
            $('at-bats').value = btn.dataset.ab;
            $('walks').value = btn.dataset.bb;
            $('hbp').value = btn.dataset.hbp;
            $('sf').value = btn.dataset.sf;
            calculate();
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Hitting Performance Report\nGrade: ${$('out-grade').textContent}\nAVG: ${$('out-avg').textContent} | OBP: ${$('out-obp').textContent}\nRatio: ${$('out-ratio').textContent} (${$('out-pa').textContent} PA)\nGenerated by ToolsHub Sports Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => {
        $('hits').value = 150; $('at-bats').value = 500;
        $('walks').value = 50; $('hbp').value = 5; $('sf').value = 5;
        calculate();
    });

    calculate();
});
</script>

<style>
.batting-modern .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#334155;opacity:.7;margin-bottom:8px;display:block}
.btn-slate-900 { background: #0f172a; color: #fff; transition: all .3s; }
.btn-slate-900:hover { background: #1e293b; color: #fff; transform: translateY(-2px); }
.bg-slate-50 { background-color: #f8fafc; }
.bg-blue-50 { background-color: #f0f9ff; }
.fw-900 { font-weight: 900; }
.pulse-blue { animation: blue-pulse 2s infinite; }
@keyframes blue-pulse { 0% { box-shadow: 0 0 0 0 rgba(30, 41, 59, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(30, 41, 59, 0); } 100% { box-shadow: 0 0 0 0 rgba(30, 41, 59, 0); } }
</style>

