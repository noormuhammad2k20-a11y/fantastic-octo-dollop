<div class="row g-4 video-data-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Resolution Standard</label>
                        <select id="vid-res" class="form-select form-select-lg rounded-3">
                            <option value="1280,720">720p HD (1280x720)</option>
                            <option value="1920,1080" selected>1080p Full HD (1920x1080)</option>
                            <option value="2048,1080">2K DCI (2048x1080)</option>
                            <option value="3840,2160">4K UHD (3840x2160)</option>
                            <option value="4096,2160">4K DCI (4096x2160)</option>
                            <option value="7680,4320">8K UHD (7680x4320)</option>
                            <option value="12288,6480">12K (12288x6480)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Frame Rate (FPS)</label>
                        <select id="vid-fps" class="form-select form-select-lg rounded-3">
                            <option value="23.976">23.976 (Cinematic Broadcast)</option>
                            <option value="24" selected>24 (Standard Cinematic)</option>
                            <option value="25">25 (PAL / EU Broadcast)</option>
                            <option value="29.97">29.97 (NTSC Broadcast)</option>
                            <option value="30">30 (Standard Digital)</option>
                            <option value="50">50 (High Frame Rate)</option>
                            <option value="60">60 (Action / Smooth)</option>
                            <option value="120">120 (Slow Motion / Gaming)</option>
                        </select>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Bit Depth / Dynamic Range</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-info active flex-grow-1 py-2 fw-bold rounded-3 depth-btn" data-val="8">8-bit</button>
                            <button type="button" class="btn btn-outline-info flex-grow-1 py-2 fw-bold rounded-3 depth-btn" data-val="10">10-bit</button>
                            <button type="button" class="btn btn-outline-info flex-grow-1 py-2 fw-bold rounded-3 depth-btn" data-val="12">12-bit</button>
                            <button type="button" class="btn btn-outline-info flex-grow-1 py-2 fw-bold rounded-3 depth-btn" data-val="16">16-bit</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Chroma Subsampling</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-info flex-grow-1 py-2 fw-bold rounded-3 chroma-btn" data-val="3">4:4:4</button>
                            <button type="button" class="btn btn-outline-info active flex-grow-1 py-2 fw-bold rounded-3 chroma-btn" data-val="2">4:2:2</button>
                            <button type="button" class="btn btn-outline-info flex-grow-1 py-2 fw-bold rounded-3 chroma-btn" data-val="1.5">4:2:0</button>
                        </div>
                    </div>

                    
                    <div class="col-md-12">
                        <label class="form-label-custom">Compression Efficiency</label>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-9">
                                <input type="range" id="vid-comp-range" class="form-range" min="1" max="100" value="1" step="1">
                                <div class="d-flex justify-content-between small text-muted px-1 mt-1">
                                    <span>RAW (1:1)</span>
                                    <span>Compressed (100:1)</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">Ratio</span>
                                    <input type="number" id="vid-comp" class="form-control form-control-lg border-start-0 text-center fw-bold" value="1" min="1" max="1000">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 vid-quick" data-r="1920,1080" data-f="24" data-d="10" data-c="2" data-p="1">🎥 RAW Alexa/RED</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 vid-quick" data-r="3840,2160" data-f="30" data-d="10" data-c="2" data-p="6">🎬 ProRes 422 HQ</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 vid-quick" data-r="3840,2160" data-f="60" data-d="8" data-c="1.5" data-p="50">📱 H.264 High (Stream)</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:200;--tool-color:#0ea5e9;--tool-bg:rgba(14,165,233,.06);">
            <div class="output-hero">
                <span class="output-hero-label">TOTAL DATA THROUGHPUT</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-bps">1.2</span>
                    <span class="output-hero-unit" id="out-bps-unit">Gbps</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-size-hour">Estimated ~540 GB / Hour</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#0ea5e9; background: rgba(14,165,233,.02);">
                        <span class="stat-card-label">DATA PER MINUTE</span>
                        <span class="stat-card-value text-info" id="out-min-size">9.0 GB</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#10b981; background: rgba(16,185,129,.02);">
                        <span class="stat-card-label">UNCOMPRESSED BPS</span>
                        <span class="stat-card-value text-success" id="out-raw-bps">1.2 Gbps</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#f59e0b; background: rgba(245,158,11,.02);">
                        <span class="stat-card-label">STORAGE OVERHEAD</span>
                        <span class="stat-card-value text-warning" id="out-overhead">None (RAW)</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-microchip text-info me-2"></i>Storage Planning & Pipe Requirements
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="vid-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Data Specs
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="vid-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="vid-share-btn" style="min-width: 280px; max-width: 100%;">
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
    const resS = $('vid-res'), fpsS = $('vid-fps'),
          compR = $('vid-comp-range'), compI = $('vid-comp');
    
    let currentDepth = 8;
    let currentChroma = 2;

    function calculate(){
        const res = resS.value.split(',').map(Number);
        const fps = parseFloat(fpsS.value) || 0;
        const ratio = parseFloat(compI.value) || 1;

        if(!res[0] || !fps) return;

        // Bits per frame = Width * Height * Depth * ChromaFactor
        const bitsPerFrame = res[0] * res[1] * currentDepth * currentChroma;
        const rawBps = bitsPerFrame * fps;
        const compressedBps = rawBps / ratio;

        // Format Bits
        function formatBits(b) {
            if(b >= 1000000000) return [(b / 1000000000).toFixed(2), 'Gbps'];
            if(b >= 1000000) return [(b / 1000000).toFixed(1), 'Mbps'];
            return [(b / 1000).toFixed(0), 'Kbps'];
        }

        const [bpsVal, bpsUnit] = formatBits(compressedBps);
        const [rawVal, rawUnit] = formatBits(rawBps);

        // Bytes calculations
        const bytesPerSec = compressedBps / 8;
        const bytesPerMin = bytesPerSec * 60;
        const bytesPerHour = bytesPerSec * 3600;

        function formatBytes(b) {
            if(b >= 1099511627776) return (b / 1099511627776).toFixed(2) + ' TB';
            if(b >= 1073741824) return (b / 1073741824).toFixed(1) + ' GB';
            if(b >= 1048576) return (b / 1048576).toFixed(0) + ' MB';
            return (b / 1024).toFixed(0) + ' KB';
        }

        // Update UI
        $('out-bps').textContent = bpsVal;
        $('out-bps-unit').textContent = bpsUnit;
        $('out-size-hour').textContent = `Estimated ~${formatBytes(bytesPerHour)} / Hour`;
        $('out-min-size').textContent = formatBytes(bytesPerMin);
        $('out-raw-bps').textContent = `${rawVal} ${rawUnit}`;
        
        const overheadPerc = ratio > 1 ? `1:${ratio} Compression` : 'None (RAW)';
        $('out-overhead').textContent = overheadPerc;

        // Insights
        const ins = [];
        if(compressedBps > 500000000) ins.push("Extremely high throughput. Requires <strong>NVMe SSD RAID</strong> or high-speed fiber interfaces.");
        else if(compressedBps > 100000000) ins.push("High bandwidth requirement. Recommended <strong>SATA SSD or Thunderbolt</strong> storage.");
        
        if(currentDepth > 10) ins.push("Deep color active. Ensure your output monitor and pipeline support <strong>HDR10+ or Dolby Vision</strong>.");
        if(currentChroma == 3) ins.push("Full 4:4:4 sampling requires <strong>Dual-link SDI / HDMI 2.1</strong> for hardware monitoring.");
        
        const hoursIn1TB = 1000000000000 / bytesPerHour;
        ins.push(`A 1TB drive will hold approx <strong>${hoursIn1TB.toFixed(1)} hours</strong> of footage at these settings.`);

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-info-circle text-info me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [resS, fpsS].forEach(el => el.addEventListener('input', calculate));
    
    compR.addEventListener('input', () => { compI.value = compR.value; calculate(); });
    compI.addEventListener('input', () => { compR.value = compI.value; calculate(); });

    document.querySelectorAll('.depth-btn').forEach(btn => {
        btn.addEventListener('click', ()=>{
            currentDepth = parseInt(btn.dataset.val);
            document.querySelectorAll('.depth-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            calculate();
        });
    });

    document.querySelectorAll('.chroma-btn').forEach(btn => {
        btn.addEventListener('click', ()=>{
            currentChroma = parseFloat(btn.dataset.val);
            document.querySelectorAll('.chroma-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            calculate();
        });
    });

    document.querySelectorAll('.vid-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            resS.value = btn.dataset.r;
            fpsS.value = btn.dataset.f;
            compI.value = btn.dataset.p;
            compR.value = btn.dataset.p;
            
            currentDepth = parseInt(btn.dataset.d);
            document.querySelectorAll('.depth-btn').forEach(b => b.classList.toggle('active', parseInt(b.dataset.val) === currentDepth));
            
            currentChroma = parseFloat(btn.dataset.c);
            document.querySelectorAll('.chroma-btn').forEach(b => b.classList.toggle('active', parseFloat(b.dataset.val) === currentChroma));
            
            calculate();
        });
    });

    $('vid-reset').addEventListener('click', ()=>{
        resS.value = '1920,1080';
        fpsS.value = '24';
        compI.value = 1;
        compR.value = 1;
        currentDepth = 8;
        currentChroma = 2;
        document.querySelectorAll('.depth-btn').forEach(b => b.classList.remove('active'));
        document.querySelector('.depth-btn[data-val="8"]').classList.add('active');
        document.querySelectorAll('.chroma-btn').forEach(b => b.classList.remove('active'));
        document.querySelector('.chroma-btn[data-val="2"]').classList.add('active');
        calculate();
    });

    $('vid-copy-btn').addEventListener('click', function(){
        const text = `Video Data Specs\nResolution: ${resS.options[resS.selectedIndex].text}\nFrame Rate: ${fpsS.value} fps\nBandwidth: ${$('out-bps').textContent} ${$('out-bps-unit').textContent}\nCompression: ${compI.value}:1\nGenerated by ToolsHub RAW Video Analysis`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Specs Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.video-data-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(14,165,233,.05)}
.video-data-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.video-data-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.video-data-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.video-data-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.video-data-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.video-data-rebuilt .btn-outline-info{border-color:#0ea5e9; color:#0ea5e9; border-width:2.5px}
.video-data-rebuilt .btn-outline-info:hover{background-color:rgba(14,165,233,.1); color:#0ea5e9}
.video-data-rebuilt .btn-outline-info.active{background-color:#0ea5e9; border-color:#0ea5e9; color:#fff}

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:1.5rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .video-data-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\raw-video-data-tool.blade.php ENDPATH**/ ?>