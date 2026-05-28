<div class="container-fluid video-storage-rebuilt">
    <div class="row g-4">
        {{-- Input Card --}}
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(239, 68, 68, 0.1); color:#ef4444;">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">Video Frame Storage Calculator</h3>
                        <p class="tool-subtitle">Precision storage and bandwidth forecasting for cinema and broadcast production.</p>
                    </div>
                </div>

                <div class="tool-body-modern">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label-custom">Resolution Preset</label>
                            <select id="vid-res" class="form-select-custom">
                                <option value="7680x4320">8K UHD (7680 x 4320)</option>
                                <option value="3840x2160" selected>4K UHD (3840 x 2160)</option>
                                <option value="1920x1080">1080p Full HD (1920 x 1080)</option>
                                <option value="1280x720">720p HD (1280 x 720)</option>
                                <option value="custom">Custom Resolution</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Frame Rate (FPS)</label>
                            <select id="vid-fps" class="form-select-custom">
                                <option value="23.976">23.976 (Cinema)</option>
                                <option value="24">24 (Standard)</option>
                                <option value="25">25 (PAL)</option>
                                <option value="29.97">29.97 (NTSC)</option>
                                <option value="30" selected>30 (Standard)</option>
                                <option value="50">50 (High)</option>
                                <option value="60">60 (High)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Total Duration</label>
                            <div class="input-group-custom">
                                <input type="number" id="vid-duration" class="form-control-custom" value="10" min="1">
                                <span class="input-addon">MINS</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Format & Compression</label>
                            <select id="vid-format" class="form-select-custom">
                                <optgroup label="Uncompressed">
                                    <option value="raw_444">RAW / Uncompressed (4:4:4)</option>
                                    <option value="raw_422">Uncompressed (4:2:2)</option>
                                </optgroup>
                                <optgroup label="Apple ProRes">
                                    <option value="prores_4444_xq">ProRes 4444 XQ</option>
                                    <option value="prores_4444" selected>ProRes 4444</option>
                                    <option value="prores_422_hq">ProRes 422 HQ</option>
                                    <option value="prores_422">ProRes 422</option>
                                    <option value="prores_422_lt">ProRes 422 LT</option>
                                    <option value="prores_422_proxy">ProRes 422 Proxy</option>
                                </optgroup>
                                <optgroup label="Delivery Codecs">
                                    <option value="h264_hq">H.264 (High Quality)</option>
                                    <option value="h265_hq">H.265 / HEVC (High Quality)</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label-custom">Bit Depth</label>
                            <select id="vid-bitdepth" class="form-select-custom">
                                <option value="8">8-bit (Standard)</option>
                                <option value="10" selected>10-bit (Pro/HDR)</option>
                                <option value="12">12-bit (Cinema)</option>
                            </select>
                        </div>

                        <div class="col-md-3" id="vid-custom-res-row" style="display:none;">
                            <label class="form-label-custom">Width x Height</label>
                            <div class="d-flex gap-2">
                                <input type="number" id="vid-width" class="form-control-custom" placeholder="W" value="3840" style="background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; width:50%; padding:0.5rem;">
                                <input type="number" id="vid-height" class="form-control-custom" placeholder="H" value="2160" style="background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; width:50%; padding:0.5rem;">
                            </div>
                        </div>

                        <div class="col-12 mt-4 border-top pt-4">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-calculate-pro flex-grow-1" style="background:#ef4444;" onclick="calculateVidStorage()">
                                    <i class="fas fa-video me-2"></i> Forecast Data Rate
                                </button>
                                <button type="button" class="btn-reset-pro" onclick="resetVidCalc()">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Action Presets --}}
                    <div class="mt-4 pt-3 border-top">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-camera text-warning me-1"></i>Production Presets:</span>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            <button class="btn-preset-pill" onclick="setVidPreset('3840x2160', 'prores_422_hq', 30)">🎥 4K ProRes HQ</button>
                            <button class="btn-preset-pill" onclick="setVidPreset('7680x4320', 'raw_444', 24)">🌌 8K RAW Cinema</button>
                            <button class="btn-preset-pill" onclick="setVidPreset('1920x1080', 'h264_hq', 60)">🌐 1080p Web Stream</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Results Card --}}
        <div class="col-lg-12">
            <div class="output-card-themed" id="vid-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5 text-center px-4 border-end">
                        <div class="hero-storage-badge">
                            <span class="hero-label">Total Estimated Storage</span>
                            <h2 class="hero-value" id="final-vid-storage">65.4</h2>
                            <div class="hero-unit-tag" id="final-vid-unit">GB</div>
                            <div class="hero-status-pill mt-3" id="vid-status" style="background:rgba(239,68,68,0.1); color:#ef4444;">High Bitrate Content</div>
                        </div>
                    </div>
                    
                    <div class="col-md-7 px-4">
                        <div class="bandwidth-metrics-container">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted fw-bold">Data Bandwidth</span>
                                <span class="small fw-bold text-danger" id="datarate-text">880 Mbps</span>
                            </div>
                            <div class="spectrum-bar">
                                <div id="vid-indicator" class="spectrum-indicator" style="background:#ef4444;"></div>
                                <div class="spectrum-segments">
                                    <div class="seg" style="width: 15%; background: #10b981;"></div>
                                    <div class="seg" style="width: 35%; background: #3b82f6;"></div>
                                    <div class="seg" style="width: 30%; background: #f59e0b;"></div>
                                    <div class="seg" style="width: 20%; background: #ef4444;"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1 tiny text-muted fw-bold ls-1">
                                <span>WEB</span><span>HD</span><span>4K PRO</span><span>8K RAW</span>
                            </div>
                        </div>

                        <div class="row g-3 mt-4">
                            <div class="col-6"><div class="stat-mini-card"><span class="sm-label">Data Rate</span><span class="sm-value" id="vid-mb-sec">110 MB/s</span></div></div>
                            <div class="col-6"><div class="stat-mini-card"><span class="sm-label">Seconds per GB</span><span class="sm-value" id="vid-sec-gb">9.1s</span></div></div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="insights-container-soft bg-light">
                            <h6 class="fw-bold mb-2 small uppercase ls-1"><i class="fas fa-server me-2 text-primary"></i> Hardware Recommendation</h6>
                            <div id="vid-insights" class="small text-muted">
                                Sustained write speeds of <strong>110 MB/s</strong> required. Recommended: SSD or RAID 0.
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 p-3 border-top">
                        <button class="btn d-block mx-auto btn-action-dark py-3 px-5 fw-bold rounded-pill shadow-sm w-100" id="vid-copy-btn" onclick="copyVidReport()">
                            <i class="fas fa-copy me-2 text-info"></i> Copy Production Report
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.video-storage-rebuilt { font-family: 'Inter', system-ui, sans-serif; }
.tool-card-premium { background: #ffffff; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); }
.tool-header-modern { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }
.tool-title { font-size: 1.5rem; font-weight: 800; color: #1e293b; margin: 0; }
.tool-subtitle { color: #64748b; font-size: 0.95rem; margin: 0; }
.form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; margin-bottom: 0.6rem; display: block; text-transform: uppercase; letter-spacing: 0.5px; }
.form-select-custom { background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; }
.input-group-custom { display: flex; align-items: stretch; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; overflow: hidden; }
.form-control-custom { background: transparent; border: none; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; }
.input-addon { display: flex; align-items: center; background: #f1f5f9; padding: 0 1.25rem; font-size: 0.8rem; font-weight: 700; color: #64748b; }
.btn-calculate-pro { border: none; padding: 1.1rem; border-radius: 16px; color: white; font-weight: 800; cursor: pointer; transition: 0.3s; }
.btn-reset-pro { background: #f1f5f9; border: none; width: 60px; height: 60px; border-radius: 16px; color: #64748b; cursor: pointer; transition: 0.2s; }
.btn-preset-pill { background: #fff; border: 1.5px solid #e2e8f0; padding: 0.6rem 1.25rem; border-radius: 100px; font-weight: 600; font-size: 0.8rem; cursor: pointer; transition: 0.2s; }
.btn-preset-pill:hover { border-color: #ef4444; color: #ef4444; background: #fef2f2; }

.output-card-themed { background: #ffffff; border-radius: 32px; padding: 3rem; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 25px 70px rgba(0,0,0,0.06); margin-top: 2rem; }
.hero-storage-badge { padding: 1rem; }
.hero-label { font-size: 0.85rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; display: block; }
.hero-value { font-size: 5rem; font-weight: 900; color: #1e293b; margin: 0.25rem 0; letter-spacing: -4px; line-height: 1; }
.hero-unit-tag { font-size: 1.5rem; font-weight: 800; color: #ef4444; letter-spacing: 2px; }
.hero-status-pill { display: inline-block; padding: 0.6rem 1.5rem; border-radius: 100px; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }

.spectrum-bar { height: 12px; border-radius: 10px; position: relative; margin: 1.5rem 0; background: #f1f5f9; }
.spectrum-segments { position: absolute; width: 100%; height: 100%; display: flex; border-radius: 10px; overflow: hidden; opacity: 0.4; }
.seg { height: 100%; }
.spectrum-indicator { position: absolute; top: -8px; width: 4px; height: 28px; border-radius: 10px; z-index: 2; border: 2px solid white; transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }

.stat-mini-card { background: #f8fafc; padding: 1.25rem; border-radius: 16px; border: 1px solid rgba(0,0,0,0.02); }
.sm-label { display: block; font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.25rem; }
.sm-value { font-size: 1.1rem; font-weight: 800; color: #1e293b; }
.insights-container-soft { background: #fcfcfc; padding: 1.5rem; border-radius: 20px; border: 1px solid #e2e8f0; margin-top: 1.5rem; }
.btn-action-dark { background: #1e293b; color: #fff; border: none; padding: 1.1rem; border-radius: 16px; font-weight: 700; cursor: pointer; transition: 0.2s; }
.btn-action-dark:hover { background: #0f172a; transform: translateY(-2px); }

.ls-1 { letter-spacing: 1px; }
.uppercase { text-transform: uppercase; }
.tiny { font-size: 0.7rem; }
</style>

<script>
function calculateVidStorage() {
    const res = document.getElementById('vid-res').value;
    const fps = parseFloat(document.getElementById('vid-fps').value);
    const duration = parseFloat(document.getElementById('vid-duration').value) || 0;
    const format = document.getElementById('vid-format').value;
    const bitDepth = parseInt(document.getElementById('vid-bitdepth').value);
    
    let width, height;
    if (res === 'custom') {
        width = parseInt(document.getElementById('vid-width').value) || 1920;
        height = parseInt(document.getElementById('vid-height').value) || 1080;
    } else {
        const parts = res.split('x');
        width = parseInt(parts[0]);
        height = parseInt(parts[1]);
    }

    if (duration <= 0) return;

    let mbps = 0;
    
    // Logic for formats
    if (format.startsWith('raw_')) {
        const factor = format === 'raw_444' ? 3 : 2;
        // RAW Calculation: Bits per pixel = BitDepth * factor
        // Bandwidth = W * H * FPS * BitsPerPixel
        mbps = (width * height * fps * bitDepth * factor) / 1000000;
    } else if (format.startsWith('prores_')) {
        // Base ProRes 422 HQ (1080p 24fps 10-bit) is ~220 Mbps
        const baseBitrates = {
            'prores_4444_xq': 500,
            'prores_4444': 330,
            'prores_422_hq': 220,
            'prores_422': 147,
            'prores_422_lt': 102,
            'prores_422_proxy': 45
        };
        const base = baseBitrates[format];
        // Scale by resolution and fps compared to 1080p24
        const scale = (width * height * fps) / (1920 * 1080 * 24);
        mbps = base * scale;
        // Adjust for bit depth (ProRes 4444 is usually 10/12-bit, others 10-bit)
        if (bitDepth === 12 && format.includes('4444')) mbps *= 1.2;
        if (bitDepth === 8) mbps *= 0.8;
    } else if (format === 'h264_hq') {
        // Presets for H.264
        if (width >= 3840) mbps = 60;
        else if (width >= 1920) mbps = 25;
        else mbps = 10;
        mbps *= (fps / 30);
    } else if (format === 'h265_hq') {
        if (width >= 3840) mbps = 35;
        else if (width >= 1920) mbps = 15;
        else mbps = 6;
        mbps *= (fps / 30);
    }

    const totalSeconds = duration * 60;
    const totalBits = mbps * 1000000 * totalSeconds;
    const totalBytes = totalBits / 8;

    let displayVal, displayUnit;
    if (totalBytes >= 1024 * 1024 * 1024 * 1024) {
        displayVal = (totalBytes / (1024 * 1024 * 1024 * 1024)).toFixed(2);
        displayUnit = "TB";
    } else if (totalBytes >= 1024 * 1024 * 1024) {
        displayVal = (totalBytes / (1024 * 1024 * 1024)).toFixed(1);
        displayUnit = "GB";
    } else {
        displayVal = (totalBytes / (1024 * 1024)).toFixed(0);
        displayUnit = "MB";
    }

    document.getElementById('final-vid-storage').innerText = displayVal;
    document.getElementById('final-vid-unit').innerText = displayUnit;
    document.getElementById('datarate-text').innerText = mbps >= 1000 ? (mbps/1000).toFixed(2) + " Gbps" : Math.round(mbps) + " Mbps";
    
    const mbSec = (mbps / 8).toFixed(1);
    document.getElementById('vid-mb-sec').innerText = mbSec + " MB/s";
    document.getElementById('vid-sec-gb').innerText = (1024 / (mbps/8)).toFixed(1) + "s";

    // Spectrum Indicator (0 to 5000 Mbps scale)
    const pos = Math.min(95, Math.max(5, (mbps / 5000) * 100));
    document.getElementById('vid-indicator').style.left = pos + "%";

    // Hardware Insights
    let hardware = "";
    const mbs = mbps / 8;
    if (mbs > 400) hardware = "NVMe SSD or high-performance RAID array required.";
    else if (mbs > 100) hardware = "SATA SSD or 7200 RPM RAID required.";
    else hardware = "Standard 7200 RPM HDD or SD Card (V30+) acceptable.";
    
    document.getElementById('vid-insights').innerHTML = `Sustained write speeds of <strong>${mbSec} MB/s</strong> required for real-time capture. <br>Recommended: ${hardware}`;
}

function setVidPreset(res, format, fps) {
    document.getElementById('vid-res').value = res;
    document.getElementById('vid-format').value = format;
    document.getElementById('vid-fps').value = fps;
    document.getElementById('vid-res').dispatchEvent(new Event('change'));
    calculateVidStorage();
}

function resetVidCalc() {
    document.getElementById('vid-res').value = '3840x2160';
    document.getElementById('vid-format').value = 'prores_4444';
    document.getElementById('vid-fps').value = '30';
    document.getElementById('vid-duration').value = 10;
    document.getElementById('vid-res').dispatchEvent(new Event('change'));
    calculateVidStorage();
}

function copyVidReport() {
    const val = document.getElementById('final-vid-storage').innerText;
    const unit = document.getElementById('final-vid-unit').innerText;
    const datarate = document.getElementById('datarate-text').innerText;
    const mbSec = document.getElementById('vid-mb-sec').innerText;
    const res = document.getElementById('vid-res').options[document.getElementById('vid-res').selectedIndex].text;
    
    const text = `Video Storage Forecast\n━━━━━━━━━━━━━━━━━━━━━━\nTotal Storage: ${val} ${unit}\nResolution: ${res}\nData Rate: ${datarate} (${mbSec})\n\nGenerated via ToolsHub`;
    
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('vid-copy-btn');
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i> Report Copied!';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy me-2 text-info"></i> Copy Production Report', 2000);
    });
}

// UI Triggers
document.getElementById('vid-res').addEventListener('change', function() {
    document.getElementById('vid-custom-res-row').style.display = this.value === 'custom' ? 'block' : 'none';
    calculateVidStorage();
});

['vid-duration', 'vid-format', 'vid-fps', 'vid-bitdepth', 'vid-width', 'vid-height'].forEach(id => {
    document.getElementById(id).addEventListener('input', calculateVidStorage);
});

document.addEventListener('DOMContentLoaded', calculateVidStorage);
</script>
