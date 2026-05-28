<div class="interactive-wrapper">
    {{-- Input Card (Sleep Emitter Configuration) --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Mode selector --}}
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-white text-center h-100" style="border: 1.5px solid #e2e8f0;">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Calculation Focus</label>
                        <select id="sl-mode" class="form-select form-select-lg rounded-3">
                            <option value="wakeup" selected>⏰ I want to wake up at...</option>
                            <option value="bedtime">🛌 I want to go to bed at...</option>
                        </select>
                    </div>
                </div>

                {{-- Time selector --}}
                <div class="col-md-5">
                    <div class="p-3 rounded-4 bg-white text-center h-100" style="border: 1.5px solid #e2e8f0;">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Target Clock Time</label>
                        <div class="row g-2 align-items-center">
                            <div class="col-7">
                                <div class="input-group">
                                    <input type="number" id="sl-hour" class="form-control form-control-lg text-center font-monospace rounded-start-3" value="07" min="1" max="12">
                                    <span class="input-group-text border-start-0 border-end-0 bg-white">:</span>
                                    <input type="number" id="sl-minute" class="form-control form-control-lg text-center font-monospace" value="30" min="0" max="59">
                                </div>
                            </div>
                            <div class="col-5">
                                <select id="sl-ampm" class="form-select form-select-lg rounded-3">
                                    <option value="AM" selected>AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Latency buffer --}}
                <div class="col-md-3">
                    <div class="p-3 rounded-4 bg-white text-center h-100" style="border: 1.5px solid #e2e8f0;">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Sleep Latency</label>
                        <div class="input-group">
                            <input type="number" id="sl-latency" class="form-control form-control-lg text-center font-monospace rounded-start-3" value="14" min="0" max="60">
                            <span class="input-group-text rounded-end-3">mins</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-magic me-2"></i> Compute Optimal Sleep Times
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Output Card (Optimal Wake/Sleep Cycles) --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark" id="out-header-title">Optimal Sleep Milestones</h5>
                        <p class="text-muted small mb-0">Calculated in 90-minute REM segments including fall-asleep latency buffers</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Sleep Schedule
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            {{-- REM target milestones list --}}
            <div class="row g-3" id="out-milestones">
                {{-- Injected dynamically --}}
            </div>

            <div class="mt-4 p-4 rounded-4 bg-light border">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">
                    <i class="fas fa-moon text-primary me-2"></i>Circadian Rhythm Health Tips
                </h6>
                <div class="row g-3 small text-secondary">
                    <div class="col-md-6 d-flex align-items-start">
                        <i class="fas fa-circle-notch text-success me-2 mt-1"></i>
                        <span><strong>The 90-Minute Rule:</strong> Waking up in the middle of a sleep cycle causes morning grogginess (sleep inertia). Aim for full cycles.</span>
                    </div>
                    <div class="col-md-6 d-flex align-items-start">
                        <i class="fas fa-circle-notch text-success me-2 mt-1"></i>
                        <span><strong>Consistency is Key:</strong> Try to keep the same sleep and wake times, even on weekends, to stabilize your body clock.</span>
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
    const modeSelect = document.getElementById('sl-mode');
    const hourInput = document.getElementById('sl-hour');
    const minInput = document.getElementById('sl-minute');
    const ampmSelect = document.getElementById('sl-ampm');
    const latencyInput = document.getElementById('sl-latency');

    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    const resultCard = document.getElementById('result-card');
    const outHeaderTitle = document.getElementById('out-header-title');
    const outMilestones = document.getElementById('out-milestones');

    function calculate() {
        const mode = modeSelect.value;
        const hr = parseInt(hourInput.value) || 7;
        const min = parseInt(minInput.value) || 0;
        const ampm = ampmSelect.value;
        const latency = parseInt(latencyInput.value) || 0;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Mapping Sleep Phases...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // Get base time in minutes of the day (24h)
            let hour24 = hr;
            if (ampm === 'PM' && hr < 12) hour24 += 12;
            if (ampm === 'AM' && hr === 12) hour24 = 0;

            const baseMins = hour24 * 60 + min;
            const REM_DURATION = 90; // minutes per REM cycle
            const recommendationItems = [];

            // We generate 6 sleep cycles (1.5h, 3.0h, 4.5h, 6.0h, 7.5h, 9.0h)
            for (let cycles = 1; cycles <= 6; cycles++) {
                const totalMinsOffset = (cycles * REM_DURATION) + latency;
                
                let targetMins = 0;
                if (mode === 'wakeup') {
                    // Subtract cycles backwards to find sleeping times
                    targetMins = (baseMins - totalMinsOffset + 1440) % 1440;
                } else {
                    // Add cycles forwards to find wake up times
                    targetMins = (baseMins + totalMinsOffset) % 1440;
                }

                // Format back to 12h clock
                let outH = Math.floor(targetMins / 60);
                const outM = targetMins % 60;
                let outAMPM = 'AM';

                if (outH >= 12) {
                    outAMPM = 'PM';
                    if (outH > 12) outH -= 12;
                } else if (outH === 0) {
                    outH = 12;
                }

                const timeStr = `${outH.toString().padStart(2, '0')}:${outM.toString().padStart(2, '0')} ${outAMPM}`;
                const hoursSleep = (cycles * 1.5).toFixed(1);

                recommendationItems.push({
                    cycles: cycles,
                    time: timeStr,
                    hours: hoursSleep
                });
            }

            // Render
            outHeaderTitle.textContent = mode === 'wakeup' ? 'Optimal Bedtimes' : 'Optimal Wake Times';
            
            // Reverse so recommended sleeping durations (longer) are highlighted prominently or ranked cleanly
            // 5 and 6 cycles are excellent! Let's display them in a visually stunning list.
            outMilestones.innerHTML = recommendationItems.map(item => {
                let badge = 'SLEEP DEPRIVED';
                let badgeColor = '#ef4444';
                let borderCol = '#ef4444';
                let icon = '<i class="fas fa-exclamation-triangle text-danger"></i>';

                if (item.cycles === 5 || item.cycles === 6) {
                    badge = 'RECOMMENDED (OPTIMAL)';
                    badgeColor = '#10b981';
                    borderCol = '#10b981';
                    icon = '<i class="fas fa-check-circle text-success"></i>';
                } else if (item.cycles === 4) {
                    badge = 'ADEQUATE';
                    badgeColor = '#3b82f6';
                    borderCol = '#3b82f6';
                    icon = '<i class="fas fa-info-circle text-primary"></i>';
                } else {
                    borderCol = '#e2e8f0';
                }

                return `
                    <div class="col-md-6 col-12">
                        <div class="p-3 rounded-4 bg-white h-100" style="border: 2px solid ${borderCol};">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge rounded-pill px-3 py-1 font-monospace fw-bold text-uppercase" style="background-color: ${badgeColor}22; color: ${badgeColor}; font-size: 0.75rem;">${badge}</span>
                                <span class="small text-muted fw-bold">${item.cycles} REM Cycle${item.cycles > 1 ? 's' : ''}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="fw-black mb-0 text-dark font-monospace">${item.time}</h3>
                                <div class="text-end">
                                    <div class="h6 fw-bold mb-0 text-secondary">${item.hours} Hrs</div>
                                    <div class="x-small text-muted">of total sleep</div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-magic me-2"></i> Compute Optimal Sleep Times';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculate);

    btnReset.addEventListener('click', function() {
        modeSelect.value = 'wakeup';
        hourInput.value = '07';
        minInput.value = '30';
        ampmSelect.value = 'AM';
        latencyInput.value = '14';
        resultCard.classList.add('d-none');
    });

    btnCopy.addEventListener('click', function() {
        const text = `Circadian REM Sleep Schedule\n━━━━━━━━━━━━━━━━━━━━━━\nTarget Configuration: ${modeSelect.options[modeSelect.selectedIndex].text} ${hourInput.value}:${minInput.value} ${ampmSelect.value}\nLatency Buffer: ${latencyInput.value} min\n━━━━━━━━━━━━━━━━━━━━━━\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const originalText = btnCopy.innerHTML;
            btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            btnCopy.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => {
                btnCopy.innerHTML = originalText;
                btnCopy.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
