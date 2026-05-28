<div class="container-fluid podcast-storage-rebuilt">
    <div class="row g-4">
        
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(139, 92, 246, 0.1); color:#8b5cf6;">
                        <i class="fas fa-microphone-lines"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">Podcast Storage Calculator</h3>
                        <p class="tool-subtitle">Professional storage forecasting for audio engineers and content creators.</p>
                    </div>
                </div>

                <div class="tool-body-modern">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label-custom">Episode Duration</label>
                            <div class="input-group-custom">
                                <input type="number" id="pod-duration" class="form-control-custom" value="60" min="1">
                                <span class="input-addon">MINS</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Number of Episodes</label>
                            <div class="input-group-custom">
                                <input type="number" id="pod-episodes" class="form-control-custom" value="1" min="1">
                                <span class="input-addon">EPISODES</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Audio Format</label>
                            <select id="pod-format" class="form-select-custom">
                                <option value="wav_16">WAV (16-bit / 44.1kHz)</option>
                                <option value="wav_24">WAV (24-bit / 48kHz)</option>
                                <option value="wav_32">WAV (32-bit / 96kHz)</option>
                                <option value="mp3_320" selected>MP3 (320 kbps)</option>
                                <option value="mp3_128">MP3 (128 kbps)</option>
                                <option value="flac">FLAC Lossless</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Channel Configuration</label>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-toggle-custom active flex-grow-1" data-id="channels" data-value="2">Stereo (2-Ch)</button>
                                <button type="button" class="btn-toggle-custom flex-grow-1" data-id="channels" data-value="1">Mono (1-Ch)</button>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Sample Rate Override</label>
                            <select id="pod-sample-rate" class="form-select-custom">
                                <option value="44100">44.1 kHz (Standard)</option>
                                <option value="48000">48.0 kHz (Video/Pro)</option>
                                <option value="88200">88.2 kHz (High-Res)</option>
                                <option value="96000">96.0 kHz (Studio)</option>
                                <option value="192000">192.0 kHz (Mastering)</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4 border-top pt-4">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-calculate-pro flex-grow-1" style="background:#8b5cf6;" onclick="calculatePodStorage()">
                                    <i class="fas fa-bolt me-2"></i> Calculate Storage Requirements
                                </button>
                                <button type="button" class="btn-reset-pro" onclick="resetPodCalc()">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mt-4 pt-3 border-top">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-magic text-warning me-1"></i>Production Presets:</span>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            <button class="btn-preset-pill" onclick="setPodPreset('mp3_128', 1, 44100)">📻 Standard Mono MP3</button>
                            <button class="btn-preset-pill" onclick="setPodPreset('wav_16', 2, 44100)">💿 CD Quality WAV</button>
                            <button class="btn-preset-pill" onclick="setPodPreset('wav_24', 2, 48000)">🎬 Pro Video Studio</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-12">
            <div class="output-card-themed" id="pod-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5 text-center px-4 border-end">
                        <div class="hero-storage-badge">
                            <span class="hero-label">Total Estimated Storage</span>
                            <h2 class="hero-value" id="final-storage">144.2</h2>
                            <div class="hero-unit-tag" id="final-unit">MB</div>
                            <div class="hero-status-pill mt-3" id="pod-status" style="background:rgba(139,92,246,0.1); color:#8b5cf6;">Ready for Export</div>
                        </div>
                    </div>
                    
                    <div class="col-md-7 px-4">
                        <div class="storage-metrics-container">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted fw-bold">Bandwidth Usage</span>
                                <span class="small fw-bold text-primary" id="bitrate-text">320 kbps</span>
                            </div>
                            <div class="spectrum-bar">
                                <div id="storage-indicator" class="spectrum-indicator" style="background:#8b5cf6;"></div>
                                <div class="spectrum-segments">
                                    <div class="seg" style="width: 20%; background: #10b981;"></div>
                                    <div class="seg" style="width: 30%; background: #3b82f6;"></div>
                                    <div class="seg" style="width: 30%; background: #f59e0b;"></div>
                                    <div class="seg" style="width: 20%; background: #ef4444;"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1 tiny text-muted fw-bold ls-1">
                                <span>LOW</span><span>MEDIUM</span><span>HIGH</span><span>CRITICAL</span>
                            </div>
                        </div>

                        <div class="row g-3 mt-4">
                            <div class="col-6"><div class="stat-mini-card"><span class="sm-label">Per Episode</span><span class="sm-value" id="pod-per-ep">144.2 MB</span></div></div>
                            <div class="col-6"><div class="stat-mini-card"><span class="sm-label">Minutes per GB</span><span class="sm-value" id="pod-min-gb">454 Min</span></div></div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="insights-container-soft bg-light">
                            <h6 class="fw-bold mb-2 small uppercase ls-1"><i class="fas fa-circle-info me-2 text-primary"></i> Technical Summary</h6>
                            <div id="pod-insights" class="small text-muted">
                                Calculations based on standard PCM and MP3 encoding algorithms.
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 p-3 border-top">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <button class="btn d-block mx-auto btn-action-dark py-3 px-5 fw-bold rounded-pill shadow-sm w-100" id="pod-copy-btn" onclick="copyPodReport()">
                                    <i class="fas fa-copy me-2 text-info"></i> Copy Storage Report
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.podcast-storage-rebuilt { font-family: 'Inter', system-ui, sans-serif; }
.tool-card-premium { background: #ffffff; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); }
.tool-header-modern { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }
.tool-title { font-size: 1.5rem; font-weight: 800; color: #1e293b; margin: 0; }
.tool-subtitle { color: #64748b; font-size: 0.95rem; margin: 0; }
.form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; margin-bottom: 0.6rem; display: block; text-transform: uppercase; letter-spacing: 0.5px; }
.btn-toggle-custom { background: #f8fafc; border: 1.5px solid #e2e8f0; padding: 0.85rem 1rem; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.2s; color: #64748b; }
.btn-toggle-custom.active { background: #1e293b; color: white; border-color: #1e293b; }
.form-select-custom { background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; }
.input-group-custom { display: flex; align-items: stretch; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; overflow: hidden; }
.form-control-custom { background: transparent; border: none; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; }
.input-addon { display: flex; align-items: center; background: #f1f5f9; padding: 0 1.25rem; font-size: 0.8rem; font-weight: 700; color: #64748b; }
.btn-calculate-pro { border: none; padding: 1.1rem; border-radius: 16px; color: white; font-weight: 800; cursor: pointer; transition: 0.3s; }
.btn-reset-pro { background: #f1f5f9; border: none; width: 60px; height: 60px; border-radius: 16px; color: #64748b; cursor: pointer; transition: 0.2s; }
.btn-preset-pill { background: #fff; border: 1.5px solid #e2e8f0; padding: 0.6rem 1.25rem; border-radius: 100px; font-weight: 600; font-size: 0.8rem; cursor: pointer; transition: 0.2s; }
.btn-preset-pill:hover { border-color: #8b5cf6; color: #8b5cf6; background: #f5f3ff; }

.output-card-themed { background: #ffffff; border-radius: 32px; padding: 3rem; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 25px 70px rgba(0,0,0,0.06); margin-top: 2rem; }
.hero-storage-badge { padding: 1rem; }
.hero-label { font-size: 0.85rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; display: block; }
.hero-value { font-size: 5rem; font-weight: 900; color: #1e293b; margin: 0.25rem 0; letter-spacing: -4px; line-height: 1; }
.hero-unit-tag { font-size: 1.5rem; font-weight: 800; color: #8b5cf6; letter-spacing: 2px; }
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
function calculatePodStorage() {
    const duration = parseFloat(document.getElementById('pod-duration').value) || 0;
    const episodes = parseFloat(document.getElementById('pod-episodes').value) || 0;
    const format = document.getElementById('pod-format').value;
    const channels = parseInt(document.querySelector('[data-id="channels"].active').dataset.value);
    const sampleRate = parseInt(document.getElementById('pod-sample-rate').value);
    
    if (duration <= 0 || episodes <= 0) return;

    let bytesPerSecond = 0;
    let bitrateLabel = "";
    let bitDepth = 16;

    if (format.startsWith('wav_')) {
        bitDepth = parseInt(format.split('_')[1]);
        bytesPerSecond = sampleRate * (bitDepth / 8) * channels;
        bitrateLabel = Math.round((bytesPerSecond * 8) / 1000) + " kbps";
    } else if (format.startsWith('mp3_')) {
        const kbps = parseInt(format.split('_')[1]);
        bytesPerSecond = (kbps * 1000) / 8;
        bitrateLabel = kbps + " kbps";
    } else if (format === 'flac') {
        // FLAC is usually ~50% of 16-bit WAV
        bytesPerSecond = (sampleRate * (16 / 8) * channels) * 0.55;
        bitrateLabel = "~" + Math.round((bytesPerSecond * 8) / 1000) + " kbps (VBR)";
    }

    const totalSeconds = duration * 60 * episodes;
    const totalBytes = bytesPerSecond * totalSeconds;
    const perEpBytes = bytesPerSecond * (duration * 60);

    let displayVal, displayUnit;
    if (totalBytes >= 1024 * 1024 * 1024) {
        displayVal = (totalBytes / (1024 * 1024 * 1024)).toFixed(2);
        displayUnit = "GB";
    } else {
        displayVal = (totalBytes / (1024 * 1024)).toFixed(1);
        displayUnit = "MB";
    }

    document.getElementById('final-storage').innerText = displayVal;
    document.getElementById('final-unit').innerText = displayUnit;
    document.getElementById('bitrate-text').innerText = bitrateLabel;
    
    // Per Episode
    document.getElementById('pod-per-ep').innerText = perEpBytes >= 1024*1024*1024 
        ? (perEpBytes/(1024*1024*1024)).toFixed(2) + " GB" 
        : (perEpBytes/(1024*1024)).toFixed(1) + " MB";

    // Minutes per GB
    const minsPerGB = Math.round((1024 * 1024 * 1024) / (bytesPerSecond * 60));
    document.getElementById('pod-min-gb').innerText = minsPerGB.toLocaleString() + " Min";

    // Spectrum Indicator (0 to 2000 kbps scale for visualization)
    const totalKbps = (bytesPerSecond * 8) / 1000;
    const pos = Math.min(95, Math.max(5, (totalKbps / 2000) * 100));
    document.getElementById('storage-indicator').style.left = pos + "%";

    // Insights
    let insight = `Your production requires <strong>${displayVal} ${displayUnit}</strong> of storage for ${episodes} episode(s). `;
    if (format.includes('wav')) {
        insight += "Uncompressed WAV provides the highest fidelity but requires significant disk space.";
    } else if (format.includes('mp3')) {
        insight += "MP3 is ideal for distribution, offering a great balance between quality and file size.";
    } else {
        insight += "FLAC provides lossless quality with a reduced file size compared to WAV.";
    }
    document.getElementById('pod-insights').innerHTML = insight;
}

function setPodPreset(format, channels, rate) {
    document.getElementById('pod-format').value = format;
    document.getElementById('pod-sample-rate').value = rate;
    
    document.querySelectorAll('[data-id="channels"]').forEach(b => {
        b.classList.remove('active');
        if(parseInt(b.dataset.value) === channels) b.classList.add('active');
    });
    
    calculatePodStorage();
}

function resetPodCalc() {
    document.getElementById('pod-duration').value = 60;
    document.getElementById('pod-episodes').value = 1;
    document.getElementById('pod-format').value = 'mp3_320';
    document.getElementById('pod-sample-rate').value = 44100;
    document.querySelectorAll('[data-id="channels"]').forEach(b => {
        b.classList.remove('active');
        if(b.dataset.value == "2") b.classList.add('active');
    });
    calculatePodStorage();
}

function copyPodReport() {
    const val = document.getElementById('final-storage').innerText;
    const unit = document.getElementById('final-unit').innerText;
    const bitrate = document.getElementById('bitrate-text').innerText;
    const perEp = document.getElementById('pod-per-ep').innerText;
    const format = document.getElementById('pod-format').options[document.getElementById('pod-format').selectedIndex].text;
    
    const text = `Podcast Storage Report\n━━━━━━━━━━━━━━━━━━━━━━\nTotal Storage: ${val} ${unit}\nPer Episode: ${perEp}\nFormat: ${format}\nBitrate: ${bitrate}\n\nGenerated via ToolsHub`;
    
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('pod-copy-btn');
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i> Report Copied!';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy me-2 text-info"></i> Copy Storage Report', 2000);
    });
}

// UI Triggers
document.querySelectorAll('[data-id="channels"]').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('[data-id="channels"]').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        calculatePodStorage();
    });
});

document.getElementById('pod-format').addEventListener('change', function() {
    // Auto-adjust sample rate for some formats
    if (this.value === 'wav_24') document.getElementById('pod-sample-rate').value = 48000;
    if (this.value === 'wav_32') document.getElementById('pod-sample-rate').value = 96000;
    calculatePodStorage();
});

['pod-duration', 'pod-episodes', 'pod-sample-rate'].forEach(id => {
    document.getElementById(id).addEventListener('input', calculatePodStorage);
});

document.addEventListener('DOMContentLoaded', calculatePodStorage);
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\podcast-storage-calc.blade.php ENDPATH**/ ?>