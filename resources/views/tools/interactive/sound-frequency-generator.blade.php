<div class="row g-4 sound-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="output-card-themed text-center mb-4 p-5" id="sound-display-card" style="--tool-hue:150;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
                    <div id="freq-animation" class="mb-3 d-flex justify-content-center align-items-end" style="height: 60px; gap: 4px;">
                        <div class="bar" style="height: 10%;"></div>
                        <div class="bar" style="height: 20%;"></div>
                        <div class="bar" style="height: 40%;"></div>
                        <div class="bar" style="height: 20%;"></div>
                        <div class="bar" style="height: 10%;"></div>
                    </div>
                    <div class="d-flex justify-content-center align-items-baseline gap-2">
                        <span id="freq-display" class="fw-black text-dark" style="font-size: 4rem; line-height: 1;">440</span>
                        <span class="fs-4 text-muted fw-bold">Hz</span>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between mb-2">
                            <label class="form-label-custom mb-0">Frequency (Hz)</label>
                            <span class="small text-muted">20 Hz - 20,000 Hz</span>
                        </div>
                        <div class="d-flex gap-3 align-items-center">
                            <input type="number" id="freq-input" class="form-control text-center fw-bold" value="440" min="20" max="20000" style="width: 120px;">
                            <input type="range" id="freq-slider" class="form-range flex-grow-1 custom-range-success" min="20" max="20000" value="440" step="1">
                        </div>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <button class="btn btn-sm btn-outline-secondary freq-preset" data-freq="100">100 Hz</button>
                            <button class="btn btn-sm btn-outline-secondary freq-preset" data-freq="256">256 Hz (C4)</button>
                            <button class="btn btn-sm btn-outline-success freq-preset fw-bold" data-freq="440">440 Hz (A4)</button>
                            <button class="btn btn-sm btn-outline-secondary freq-preset" data-freq="1000">1 kHz</button>
                            <button class="btn btn-sm btn-outline-secondary freq-preset" data-freq="10000">10 kHz</button>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-custom">Waveform Type</label>
                        <select id="wave-type" class="form-select form-select-lg">
                            <option value="sine" selected>Sine (Smooth/Pure)</option>
                            <option value="square">Square (Harsh/Electronic)</option>
                            <option value="sawtooth">Sawtooth (Buzzy/Bright)</option>
                            <option value="triangle">Triangle (Mellow/Flute-like)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Volume</label>
                        <input type="range" id="vol-slider" class="form-range mt-2 custom-range-success" min="0" max="100" value="50">
                    </div>
                </div>

                <div class="d-flex gap-3">
                    <button class="btn d-block mx-auto fw-bold text-white fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-play" style="min-width: 280px; max-width: 100%; background:#10b981;border:none;">
                        <i class="fas fa-play-circle me-2"></i>Play Tone
                    </button>
                    <button class="btn d-block mx-auto btn-dark fw-bold fs-5 d-none py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-stop" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-stop-circle me-2"></i>Stop
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.sound-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.sound-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.sound-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.sound-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.sound-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.sound-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;}

.custom-range-success::-webkit-slider-thumb { background: #10b981; }
.custom-range-success::-moz-range-thumb { background: #10b981; }
.custom-range-success::-ms-thumb { background: #10b981; }

.bar {
    width: 15px;
    background-color: #10b981;
    border-radius: 4px 4px 0 0;
    transition: height 0.1s ease;
    opacity: 0.2;
}

.is-playing .bar {
    opacity: 1;
    animation: bounce 1.2s infinite ease-in-out;
}

.is-playing .bar:nth-child(1) { animation-delay: 0s; }
.is-playing .bar:nth-child(2) { animation-delay: 0.1s; }
.is-playing .bar:nth-child(3) { animation-delay: 0.2s; }
.is-playing .bar:nth-child(4) { animation-delay: 0.1s; }
.is-playing .bar:nth-child(5) { animation-delay: 0s; }

@keyframes bounce {
    0%, 100% { height: 20%; }
    50% { height: 100%; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    let audioCtx = null;
    let oscillator = null;
    let gainNode = null;
    let isPlaying = false;

    function initAudio() {
        if (!audioCtx) {
            audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            gainNode = audioCtx.createGain();
            gainNode.connect(audioCtx.destination);
        }
    }

    function updateDisplay(val) {
        $('freq-display').textContent = val;
        $('freq-input').value = val;
        $('freq-slider').value = val;
    }

    $('freq-slider').addEventListener('input', function() {
        updateDisplay(this.value);
        if (isPlaying && oscillator) {
            oscillator.frequency.setValueAtTime(this.value, audioCtx.currentTime);
        }
    });

    $('freq-input').addEventListener('change', function() {
        let val = parseInt(this.value);
        if (val < 20) val = 20;
        if (val > 20000) val = 20000;
        updateDisplay(val);
        if (isPlaying && oscillator) {
            oscillator.frequency.setValueAtTime(val, audioCtx.currentTime);
        }
    });

    document.querySelectorAll('.freq-preset').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.freq-preset').forEach(b => {
                b.classList.remove('btn-outline-success', 'fw-bold');
                b.classList.add('btn-outline-secondary');
            });
            this.classList.remove('btn-outline-secondary');
            this.classList.add('btn-outline-success', 'fw-bold');
            
            const val = this.dataset.freq;
            updateDisplay(val);
            if (isPlaying && oscillator) {
                oscillator.frequency.setValueAtTime(val, audioCtx.currentTime);
            }
        });
    });

    $('wave-type').addEventListener('change', function() {
        if (isPlaying && oscillator) {
            oscillator.type = this.value;
        }
    });

    $('vol-slider').addEventListener('input', function() {
        if (gainNode) {
            // Convert 0-100 to 0.0 - 1.0 curve (squared for natural volume perception)
            const fraction = parseInt(this.value) / 100;
            gainNode.gain.setValueAtTime(fraction * fraction, audioCtx.currentTime);
        }
    });

    $('btn-play').addEventListener('click', function() {
        initAudio();
        
        if (audioCtx.state === 'suspended') {
            audioCtx.resume();
        }

        if (isPlaying) {
            oscillator.stop();
        }

        oscillator = audioCtx.createOscillator();
        oscillator.type = $('wave-type').value;
        oscillator.frequency.setValueAtTime($('freq-input').value, audioCtx.currentTime);
        
        const volFraction = parseInt($('vol-slider').value) / 100;
        gainNode.gain.setValueAtTime(volFraction * volFraction, audioCtx.currentTime);

        oscillator.connect(gainNode);
        oscillator.start();
        isPlaying = true;

        this.classList.add('d-none');
        $('btn-stop').classList.remove('d-none');
        $('freq-animation').classList.add('is-playing');
    });

    $('btn-stop').addEventListener('click', function() {
        if (isPlaying && oscillator) {
            oscillator.stop();
            isPlaying = false;
        }
        this.classList.add('d-none');
        $('btn-play').classList.remove('d-none');
        $('freq-animation').classList.remove('is-playing');
    });
});
</script>

