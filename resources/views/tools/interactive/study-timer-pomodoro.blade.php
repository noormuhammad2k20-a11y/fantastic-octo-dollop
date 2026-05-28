<div class="interactive-wrapper">
    {{-- Input Card (Settings & Quick Presets) --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            {{-- Quick Presets --}}
            <div class="p-3 rounded-4 mb-4" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3 letter-spacing-1"><i class="fas fa-magic text-primary me-2"></i>Quick Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-focus="25" data-short="5" data-long="15">🍅 Classic (25/5)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-focus="15" data-short="3" data-long="10">⚡ Short Focus (15/3)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-focus="50" data-short="10" data-long="20">🧠 Deep Focus (50/10)</button>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-3 col-6">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Focus Time (Min)</label>
                    <input type="number" id="input-focus" class="form-control form-control-lg rounded-3" value="25" min="1" max="180">
                </div>
                <div class="col-md-3 col-6">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Short Break (Min)</label>
                    <input type="number" id="input-short" class="form-control form-control-lg rounded-3" value="5" min="1" max="60">
                </div>
                <div class="col-md-3 col-6">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Long Break (Min)</label>
                    <input type="number" id="input-long" class="form-control form-control-lg rounded-3" value="15" min="1" max="90">
                </div>
                <div class="col-md-3 col-6">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Rounds / Cycle</label>
                    <input type="number" id="input-rounds" class="form-control form-control-lg rounded-3" value="4" min="1" max="12">
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-center gap-2 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm transition-all" id="btn-start" style="min-width: 160px;">
                    <i class="fas fa-play me-2"></i> Start Focus
                </button>
                <button class="btn btn-warning btn-lg rounded-pill px-4 shadow-sm transition-all text-white d-none" id="btn-pause" style="min-width: 160px;">
                    <i class="fas fa-pause me-2"></i> Pause
                </button>
                <button class="btn btn-light-v2 btn-lg rounded-pill px-4 transition-all" id="btn-skip" style="min-width: 160px;">
                    <i class="fas fa-forward me-2"></i> Skip Round
                </button>
            </div>
        </div>
    </div>

    {{-- Output Card (Realtime Tracker & Active State) --}}
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-circle-notch text-success" id="state-spinner"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Focus Engine Status</h5>
                        <p class="text-muted small mb-0">Active session statistics & realtime tracker</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy">
                        <i class="fas fa-copy me-1"></i> Copy Session Log
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center">
                {{-- Countdown Timer Column --}}
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-dark mb-0 font-monospace" id="out-timer">25:00</div>
                    <div class="mt-2">
                        <span class="badge rounded-pill px-4 py-2 fw-bold text-uppercase" id="out-badge" style="background-color: #4f46e5; color: #fff;">FOCUSING</span>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted fw-bold text-uppercase d-block mb-1">Session Progress</small>
                        <div class="progress mx-auto" style="height: 8px; border-radius: 4px; max-width: 250px;">
                            <div id="prog-bar" class="progress-bar bg-primary" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>

                {{-- Interactive Analytics Column --}}
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Rounds Done</div>
                                <div class="h4 fw-bold mb-0 text-dark" id="out-completed-rounds">0 / 4</div>
                                <div class="x-small text-muted fw-bold">Until long break</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Total Focus Time</div>
                                <div class="h4 fw-bold mb-0 text-success" id="out-focus-total">0 min</div>
                                <div class="x-small text-muted fw-bold">Total productive time</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 p-3 rounded-4 bg-white border">
                        <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1"><i class="fas fa-list-ul text-primary me-2"></i>Active Session Log</h6>
                        <div class="overflow-y-auto" style="max-height: 110px;" id="out-log-container">
                            <p class="text-muted small mb-0 text-center py-2" id="empty-log-msg">No logs recorded yet. Start the timer to trace your achievements!</p>
                            <ul class="list-unstyled mb-0 d-none" id="log-list" style="font-size: 0.85rem;"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --danger-soft: #fef2f2;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }
    .bg-danger-soft { background-color: var(--danger-soft); }

    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1.5px solid #e2e8f0; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-control-lg, .form-select-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.05rem; padding: 0.65rem 0.85rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }
    
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .x-small { font-size: 0.75rem; }
    .font-monospace { font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inputs
    const fInput = document.getElementById('input-focus');
    const sInput = document.getElementById('input-short');
    const lInput = document.getElementById('input-long');
    const rInput = document.getElementById('input-rounds');

    // Controls
    const btnStart = document.getElementById('btn-start');
    const btnPause = document.getElementById('btn-pause');
    const btnSkip = document.getElementById('btn-skip');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    // Outputs
    const outTimer = document.getElementById('out-timer');
    const outBadge = document.getElementById('out-badge');
    const outRounds = document.getElementById('out-completed-rounds');
    const outFocus = document.getElementById('out-focus-total');
    const progBar = document.getElementById('prog-bar');
    const stateSpinner = document.getElementById('state-spinner');
    
    // Log Elements
    const emptyLogMsg = document.getElementById('empty-log-msg');
    const logList = document.getElementById('log-list');

    // State Variables
    let timerState = 'idle'; // 'idle', 'running', 'paused'
    let currentMode = 'focus'; // 'focus', 'short_break', 'long_break'
    let completedRounds = 0;
    let totalFocusMinutes = 0;
    
    let timeRemaining = 25 * 60; // seconds
    let totalDuration = 25 * 60; // seconds
    let intervalId = null;
    
    const originalTitle = document.title;

    // Web Audio Synthesizer for alerts
    function playAlarm() {
        try {
            const ctx = new (window.AudioContext || window.webkitAudioContext)();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            
            osc.connect(gain);
            gain.connect(ctx.destination);
            
            // Soft pleasant chime tone
            osc.type = 'sine';
            osc.frequency.setValueAtTime(587.33, ctx.currentTime); // D5
            osc.frequency.setValueAtTime(880.00, ctx.currentTime + 0.15); // A5
            
            gain.gain.setValueAtTime(0.3, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.5);
            
            osc.start(ctx.currentTime);
            osc.stop(ctx.currentTime + 0.5);
        } catch (e) {
            console.warn("Web Audio API failed or blocked", e);
        }
    }

    function formatTime(sec) {
        const m = Math.floor(sec / 60);
        const s = sec % 60;
        return `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
    }

    function getSecondsForMode() {
        if (currentMode === 'focus') return (parseInt(fInput.value) || 25) * 60;
        if (currentMode === 'short_break') return (parseInt(sInput.value) || 5) * 60;
        if (currentMode === 'long_break') return (parseInt(lInput.value) || 15) * 60;
        return 25 * 60;
    }

    function updateDisplay() {
        outTimer.textContent = formatTime(timeRemaining);
        const progressPct = (timeRemaining / totalDuration) * 100;
        progBar.style.width = `${progressPct}%`;
        
        // Document title countdown
        const modeLabel = currentMode === 'focus' ? 'Focus' : 'Break';
        document.title = `${formatTime(timeRemaining)} | ${modeLabel} - ToolsHub`;

        // Style and label updates
        const maxRounds = parseInt(rInput.value) || 4;
        outRounds.textContent = `${completedRounds} / ${maxRounds}`;
        outFocus.textContent = `${totalFocusMinutes} min`;

        if (currentMode === 'focus') {
            outBadge.textContent = 'FOCUSING';
            outBadge.style.backgroundColor = '#4f46e5';
            progBar.className = 'progress-bar bg-primary';
            stateSpinner.className = 'fas fa-circle-notch text-primary';
            if (timerState === 'running') {
                stateSpinner.classList.add('fa-spin');
            }
        } else {
            outBadge.textContent = currentMode === 'short_break' ? 'SHORT BREAK' : 'LONG BREAK';
            outBadge.style.backgroundColor = '#10b981';
            progBar.className = 'progress-bar bg-success';
            stateSpinner.className = 'fas fa-mug-hot text-success';
            stateSpinner.classList.remove('fa-spin');
        }
    }

    function logSession(message) {
        emptyLogMsg.classList.add('d-none');
        logList.classList.remove('d-none');
        
        const timestamp = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        const li = document.createElement('li');
        li.className = 'mb-1 d-flex justify-content-between border-bottom pb-1 text-secondary';
        li.innerHTML = `<span><i class="fas fa-check-circle text-success me-2"></i>${message}</span><span class="x-small text-muted">${timestamp}</span>`;
        logList.insertBefore(li, logList.firstChild);
    }

    function switchMode() {
        const maxRounds = parseInt(rInput.value) || 4;

        if (currentMode === 'focus') {
            completedRounds++;
            const completedFocusMin = parseInt(fInput.value) || 25;
            totalFocusMinutes += completedFocusMin;
            logSession(`Completed ${completedFocusMin} min Focus Session!`);
            
            if (completedRounds >= maxRounds) {
                currentMode = 'long_break';
                logSession(`Superb work! Deserved long break started.`);
            } else {
                currentMode = 'short_break';
                logSession(`Focus session finished. Rest standard break.`);
            }
        } else {
            // Break finished
            if (currentMode === 'long_break') {
                completedRounds = 0;
            }
            currentMode = 'focus';
            logSession(`Break complete! Ready to deep focus.`);
        }

        playAlarm();
        timeRemaining = getSecondsForMode();
        totalDuration = timeRemaining;
        
        // Pause by default on transition to give user breath
        pauseTimer();
        updateDisplay();
    }

    function startTimer() {
        if (timerState === 'running') return;
        
        // Lock inputs while active
        fInput.disabled = true;
        sInput.disabled = true;
        lInput.disabled = true;
        rInput.disabled = true;

        timerState = 'running';
        btnStart.classList.add('d-none');
        btnPause.classList.remove('d-none');
        
        updateDisplay();

        intervalId = setInterval(() => {
            if (timeRemaining > 0) {
                timeRemaining--;
                updateDisplay();
            } else {
                clearInterval(intervalId);
                switchMode();
            }
        }, 1000);
    }

    function pauseTimer() {
        timerState = 'paused';
        btnPause.classList.add('d-none');
        btnStart.classList.remove('d-none');
        btnStart.innerHTML = '<i class="fas fa-play me-2"></i> Resume';
        
        if (intervalId) {
            clearInterval(intervalId);
        }
        
        stateSpinner.classList.remove('fa-spin');
    }

    function resetTimer() {
        pauseTimer();
        fInput.disabled = false;
        sInput.disabled = false;
        lInput.disabled = false;
        rInput.disabled = false;

        timerState = 'idle';
        currentMode = 'focus';
        btnStart.innerHTML = '<i class="fas fa-play me-2"></i> Start Focus';
        
        timeRemaining = getSecondsForMode();
        totalDuration = timeRemaining;
        
        document.title = originalTitle;
        updateDisplay();
    }

    btnStart.addEventListener('click', startTimer);
    btnPause.addEventListener('click', pauseTimer);
    
    btnSkip.addEventListener('click', function() {
        if (confirm("Skip the active session? This will advance the timer immediately.")) {
            if (intervalId) clearInterval(intervalId);
            switchMode();
        }
    });

    btnReset.addEventListener('click', function() {
        if (confirm("Reset current sessions and logs back to initial?")) {
            completedRounds = 0;
            totalFocusMinutes = 0;
            logList.innerHTML = '';
            emptyLogMsg.classList.remove('d-none');
            logList.classList.add('d-none');
            resetTimer();
        }
    });

    // Preset Selection
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            fInput.value = btn.dataset.focus;
            sInput.value = btn.dataset.short;
            lInput.value = btn.dataset.long;
            resetTimer();
        });
    });

    // Copy Log Report
    btnCopy.addEventListener('click', function() {
        const logs = Array.from(logList.children).map(li => li.textContent.trim()).join('\n');
        const report = `Pomodoro Focus Report\n━━━━━━━━━━━━━━━━━━━━━━\nTotal Focus Sessions: ${completedRounds}\nTotal Focus Time: ${totalFocusMinutes} minutes\nLogs:\n${logs || 'No logs recorded.'}\n━━━━━━━━━━━━━━━━━━━━━━\nGenerated via ToolsHub.`;
        
        navigator.clipboard.writeText(report).then(() => {
            const originalText = btnCopy.innerHTML;
            btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            btnCopy.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => {
                btnCopy.innerHTML = originalText;
                btnCopy.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });

    // Initial setup
    timeRemaining = getSecondsForMode();
    totalDuration = timeRemaining;
    updateDisplay();
});
</script>
