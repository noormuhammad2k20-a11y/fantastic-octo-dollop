<div class="row g-4 audio-optimizer-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Row 1: Bitrate & Duration --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Target Bitrate (kbps)</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="range" id="aud-bitrate-range" class="form-range flex-grow-1" min="32" max="320" step="32" value="128">
                            <div class="input-group" style="width: 120px;">
                                <input type="number" id="aud-bitrate" class="form-control form-control-lg rounded-3" value="128">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Duration</label>
                        <div class="d-flex gap-2">
                            <div class="flex-grow-1">
                                <small class="text-muted d-block mb-1">Minutes</small>
                                <input type="number" id="aud-min" class="form-control form-control-lg rounded-3" value="3" min="0">
                            </div>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block mb-1">Seconds</small>
                                <input type="number" id="aud-sec" class="form-control form-control-lg rounded-3" value="30" min="0" max="59">
                            </div>
                        </div>
                    </div>

                    {{-- Row 2: Sample Rate & Channels --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Sample Rate</label>
                        <select id="aud-sample" class="form-select form-select-lg rounded-3">
                            <option value="44100" selected>44.1 kHz (CD Quality)</option>
                            <option value="48000">48.0 kHz (Professional)</option>
                            <option value="88200">88.2 kHz (High-Res)</option>
                            <option value="96000">96.0 kHz (Studio Master)</option>
                            <option value="192000">192.0 kHz (Audiophile)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Channel Configuration</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-purple flex-grow-1 py-2 fw-bold rounded-3 channel-btn" data-val="1">
                                Mono
                            </button>
                            <button type="button" class="btn btn-outline-purple active flex-grow-1 py-2 fw-bold rounded-3 channel-btn" data-val="2">
                                Stereo
                            </button>
                            <button type="button" class="btn btn-outline-purple flex-grow-1 py-2 fw-bold rounded-3 channel-btn" data-val="6">
                                5.1 Surround
                            </button>
                        </div>
                    </div>

                    {{-- Row 3: Encoding & Extra --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Encoding Mode</label>
                        <div class="card p-3 border-dashed d-flex flex-row align-items-center justify-content-between">
                            <div class="fw-bold text-dark">Constant Bitrate (CBR)</div>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input" type="checkbox" id="aud-vbr">
                                <label class="form-check-label small text-muted ms-2" for="aud-vbr">Variable (VBR)</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Original File Size (Optional)</label>
                        <div class="input-group">
                            <input type="number" id="aud-orig-size" class="form-control form-control-lg rounded-start-3" placeholder="Compare with original">
                            <select id="aud-orig-unit" class="form-select form-select-lg rounded-end-3" style="max-width: 100px;">
                                <option value="mb">MB</option>
                                <option value="gb">GB</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 aud-quick" data-b="128" data-s="44100" data-c="2">📻 Standard Podcast</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 aud-quick" data-b="256" data-s="48000" data-c="2">🎵 High Quality Music</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 aud-quick" data-b="320" data-s="96000" data-c="6">🎬 Cinema Surround</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:280;--tool-color:#a855f7;--tool-bg:rgba(168,85,247,.06);">
            <div class="output-hero">
                <span class="output-hero-label">ESTIMATED FILE SIZE</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-size">24.5</span>
                    <span class="output-hero-unit">MB</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-comp-ratio">Saving ~45% vs Original</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#a855f7; background: rgba(168,85,247,.02);">
                        <span class="stat-card-label">DATA THROUGHPUT</span>
                        <span class="stat-card-value text-purple" id="out-throughput">960 KB/m</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#10b981; background: rgba(16,185,129,.02);">
                        <span class="stat-card-label">BITRATE PER CHANNEL</span>
                        <span class="stat-card-value text-success" id="out-bpc">64 kbps</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#f59e0b; background: rgba(245,158,11,.02);">
                        <span class="stat-card-label">SAMPLING DENSITY</span>
                        <span class="stat-card-value text-warning" id="out-density">Med-High</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-microchip text-purple me-2"></i>Technical Insights & Recommendations
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="aud-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Data Specs
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="aud-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="aud-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Analysis
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const bitrateR = $('aud-bitrate-range'), bitrateI = $('aud-bitrate'),
          minI = $('aud-min'), secI = $('aud-sec'),
          sampleS = $('aud-sample'), vbrS = $('aud-vbr'),
          origSizeI = $('aud-orig-size'), origUnitS = $('aud-orig-unit');
    
    let currentChannels = 2;

    function calculate(){
        let b = parseFloat(bitrateI.value) || 0;
        let m = parseFloat(minI.value) || 0;
        let s = parseFloat(secI.value) || 0;
        let totalSec = (m * 60) + s;
        let isVbr = vbrS.checked;

        if(totalSec <= 0 || b <= 0) return;

        // Size in bits = bitrate * seconds
        // Size in Bytes = (bitrate * 1000 * seconds) / 8
        let sizeBytes = (b * 1000 * totalSec) / 8;
        let sizeMB = sizeBytes / (1024 * 1024);

        if(isVbr) {
            // VBR typically saves 10-15% or fluctuates, we'll show it as an average with a disclaimer
            sizeMB *= 0.95; // Assuming typical optimization
        }

        // Update UI
        $('out-size').textContent = sizeMB.toFixed(2);
        $('out-throughput').textContent = (sizeMB / (totalSec/60)).toFixed(1) + ' MB/min';
        $('out-bpc').textContent = Math.round(b / currentChannels) + ' kbps';

        // Density Logic
        let density = 'Standard';
        const sampleVal = parseInt(sampleS.value);
        if(sampleVal >= 96000) density = 'Ultra High';
        else if(sampleVal >= 48000) density = 'High';
        else if(sampleVal >= 44100) density = 'Consumer';
        else density = 'Low';
        $('out-density').textContent = density;

        // Comparison Logic
        const origSize = parseFloat(origSizeI.value) || 0;
        const compLine = $('out-comp-ratio');
        if(origSize > 0) {
            const origMB = (origUnitS.value === 'gb') ? origSize * 1024 : origSize;
            const diff = origMB - sizeMB;
            const percent = (diff / origMB) * 100;
            if(diff > 0) {
                compLine.innerHTML = `<span class="text-success">Saving ~${percent.toFixed(1)}%</span> vs target original size.`;
                compLine.style.display = 'block';
            } else {
                compLine.innerHTML = `<span class="text-danger">Increase ~${Math.abs(percent).toFixed(1)}%</span> vs target original size.`;
                compLine.style.display = 'block';
            }
        } else {
            compLine.style.display = 'none';
        }

        // Insights
        const ins = [];
        if(b < 96) ins.push("Bitrate is quite low. Recommended for <strong>voice/speech</strong> only.");
        if(b > 256 && sampleVal < 48000) ins.push("High bitrate detected. Consider using <strong>48kHz or higher</strong> for better fidelity.");
        if(isVbr) ins.push("VBR mode active: Size is an <strong>estimated average</strong> based on typical audio complexity.");
        if(currentChannels > 2) ins.push("Surround sound active. Ensure your export codec supports <strong>multi-channel mapping</strong>.");
        if(sizeMB > 500) ins.push("Large file size estimated. Consider <strong>HE-AAC</strong> or lowering bitrate for mobile delivery.");

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-info-circle text-purple me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    // Sync Range and Input
    bitrateR.addEventListener('input', () => { bitrateI.value = bitrateR.value; calculate(); });
    bitrateI.addEventListener('input', () => { bitrateR.value = bitrateI.value; calculate(); });

    [minI, secI, sampleS, vbrS, origSizeI, origUnitS].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.channel-btn').forEach(btn => {
        btn.addEventListener('click', ()=>{
            currentChannels = parseInt(btn.dataset.val);
            document.querySelectorAll('.channel-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            calculate();
        });
    });

    document.querySelectorAll('.aud-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            bitrateR.value = btn.dataset.b;
            bitrateI.value = btn.dataset.b;
            sampleS.value = btn.dataset.s;
            // Channel sync
            currentChannels = parseInt(btn.dataset.c);
            document.querySelectorAll('.channel-btn').forEach(b => {
                b.classList.toggle('active', parseInt(b.dataset.val) === currentChannels);
            });
            calculate();
        });
    });

    $('aud-reset').addEventListener('click', ()=>{
        bitrateR.value = 128;
        bitrateI.value = 128;
        minI.value = 3;
        secI.value = 30;
        sampleS.value = '44100';
        vbrS.checked = false;
        origSizeI.value = '';
        currentChannels = 2;
        document.querySelectorAll('.channel-btn').forEach(b => b.classList.remove('active'));
        document.querySelector('.channel-btn[data-val="2"]').classList.add('active');
        calculate();
    });

    $('aud-copy-btn').addEventListener('click', function(){
        const text = `Audio Optimization Specs\nTarget Bitrate: ${bitrateI.value} kbps\nEstimated Size: ${$('out-size').textContent} MB\nChannels: ${currentChannels}\nSample Rate: ${sampleS.value}Hz\nGenerated by ToolsHub Audio Optimizer`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Specs Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.audio-optimizer-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(168,85,247,.05)}
.audio-optimizer-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.audio-optimizer-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.audio-optimizer-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.audio-optimizer-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.audio-optimizer-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.audio-optimizer-rebuilt .btn-outline-purple{border-color:#a855f7; color:#a855f7; border-width:2.5px}
.audio-optimizer-rebuilt .btn-outline-purple:hover{background-color:rgba(168,85,247,.1); color:#a855f7}
.audio-optimizer-rebuilt .btn-outline-purple.active{background-color:#a855f7; border-color:#a855f7; color:#fff}
.audio-optimizer-rebuilt .border-dashed{border: 2px dashed #e5e7eb; border-radius: 12px; transition: all 0.2s;}
.audio-optimizer-rebuilt .border-dashed:hover{border-color: #a855f7;}
.text-purple { color: #a855f7 !important; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:1.7rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .audio-optimizer-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>

