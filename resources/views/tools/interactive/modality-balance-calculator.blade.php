<div class="interactive-tool-container">
    {{-- ════════════ INPUT SECTION ════════════ --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4 p-md-5">
            <h4 class="fw-bold text-dark mb-4"><i class="fas fa-th-large text-accent me-2"></i> Chart Signatures</h4>
            <p class="text-secondary small mb-4">Enter the zodiac signs for each planetary body to calculate your modal balance (Cardinal, Fixed, Mutable).</p>
            
            <div class="row g-4">
                @php
                    $planets = [
                        ['id' => 'sun', 'name' => 'Sun', 'icon' => 'fa-sun'],
                        ['id' => 'moon', 'name' => 'Moon', 'icon' => 'fa-moon'],
                        ['id' => 'mercury', 'name' => 'Mercury', 'icon' => 'fa-brain'],
                        ['id' => 'venus', 'name' => 'Venus', 'icon' => 'fa-heart'],
                        ['id' => 'mars', 'name' => 'Mars', 'icon' => 'fa-fire'],
                        ['id' => 'jupiter', 'name' => 'Jupiter', 'icon' => 'fa-bolt'],
                        ['id' => 'saturn', 'name' => 'Saturn', 'icon' => 'fa-ring'],
                        ['id' => 'ascendant', 'name' => 'Ascendant', 'icon' => 'fa-arrow-up']
                    ];
                    $signs = ['aries', 'taurus', 'gemini', 'cancer', 'leo', 'virgo', 'libra', 'scorpio', 'sagittarius', 'capricorn', 'aquarius', 'pisces'];
                @endphp

                @foreach($planets as $planet)
                    <div class="col-12 col-md-6 col-lg-3">
                        <label class="form-label fw-bold small text-muted text-uppercase letter-spacing-1">
                            <i class="fas {{ $planet['icon'] }} text-accent me-1"></i> {{ $planet['name'] }}
                        </label>
                        <select id="sign-{{ $planet['id'] }}" class="form-select border-0 bg-light rounded-3 shadow-sm py-2">
                            @foreach($signs as $sign)
                                <option value="{{ $sign }}">{{ ucfirst($sign) }}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ════════════ ACTION BAR ════════════ --}}
    <div class="text-center mb-5">
        <button id="btn-calculate" class="btn btn-accent btn-lg px-5 py-3 fw-bold shadow-sm rounded-pill transition-all">
            <i class="fas fa-chart-pie me-2"></i> Analyze Balance
        </button>
    </div>

    {{-- ════════════ RESULT SECTION ════════════ --}}
    <div id="result-card" class="card border-0 shadow-lg rounded-4 d-none">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h4 class="fw-bold text-dark mb-0"><i class="fas fa-balance-scale text-accent me-2"></i> Modal Analysis</h4>
                <button class="btn btn-sm btn-outline-accent rounded-pill px-3" id="btn-copy">
                    <i class="fas fa-copy me-1"></i> Copy Results
                </button>
            </div>

            <div class="row g-4 mb-5">
                {{-- Modality Progress Bars --}}
                <div class="col-12 col-lg-6">
                    <div class="modality-row mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-bold">Cardinal <small class="text-muted fst-italic">(The Starters)</small></span>
                            <span id="pct-cardinal" class="fw-bold text-accent">0%</span>
                        </div>
                        <div class="progress rounded-pill shadow-sm" style="height: 12px; background: #eee;">
                            <div id="bar-cardinal" class="progress-bar bg-accent rounded-pill transition-all" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="modality-row mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-bold">Fixed <small class="text-muted fst-italic">(The Finishers)</small></span>
                            <span id="pct-fixed" class="fw-bold text-accent">0%</span>
                        </div>
                        <div class="progress rounded-pill shadow-sm" style="height: 12px; background: #eee;">
                            <div id="bar-fixed" class="progress-bar bg-accent rounded-pill transition-all" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="modality-row">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-bold">Mutable <small class="text-muted fst-italic">(The Adapters)</small></span>
                            <span id="pct-mutable" class="fw-bold text-accent">0%</span>
                        </div>
                        <div class="progress rounded-pill shadow-sm" style="height: 12px; background: #eee;">
                            <div id="bar-mutable" class="progress-bar bg-accent rounded-pill transition-all" style="width: 0%"></div>
                        </div>
                    </div>
                </div>

                {{-- Dominant Signature --}}
                <div class="col-12 col-lg-6">
                    <div class="p-4 rounded-4 bg-light border h-100 text-center">
                        <h6 class="text-uppercase small fw-bold text-muted mb-3">Dominant Signature</h6>
                        <div id="dominant-title" class="display-6 fw-black text-dark mb-2">-</div>
                        <p id="dominant-desc" class="text-secondary small mb-0">
                            Based on your chart, you have a strong tendency toward [Mode] energy.
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 bg-dark text-white shadow-inner">
                <h5 class="fw-bold mb-3"><i class="fas fa-info-circle text-accent me-2"></i> Interpretation</h5>
                <p id="res-interpretation" class="mb-0 small" style="opacity: 0.9; line-height: 1.6;">
                    Select your planetary placements and click calculate to see your behavioral profile analysis.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    :root { --accent: #ff6b00; }
    .text-accent { color: var(--accent) !important; }
    .btn-accent { background: var(--accent); color: white; border: none; }
    .btn-accent:hover { background: #e65100; color: white; transform: translateY(-2px); }
    .bg-accent { background: var(--accent) !important; }
    .btn-outline-accent { color: var(--accent); border-color: var(--accent); }
    .btn-outline-accent:hover { background: var(--accent); color: white; }
    .fw-black { font-weight: 900; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .transition-all { transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
    .shadow-inner { box-shadow: inset 0 2px 10px rgba(0,0,0,0.1); }
    
    .form-select:focus { box-shadow: none; border-color: var(--accent); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnCalculate = document.getElementById('btn-calculate');
    const resultCard = document.getElementById('result-card');

    const signModes = {
        aries: 'cardinal', taurus: 'fixed', gemini: 'mutable',
        cancer: 'cardinal', leo: 'fixed', virgo: 'mutable',
        libra: 'cardinal', scorpio: 'fixed', sagittarius: 'mutable',
        capricorn: 'cardinal', aquarius: 'fixed', pisces: 'mutable'
    };

    const interpretations = {
        cardinal: "Your chart is dominated by Cardinal energy, making you a natural 'starter' and visionary. You excel at initiating projects, taking the lead, and setting things in motion. However, you may sometimes struggle with following through to the end once the initial excitement wanes.",
        fixed: "With a high concentration of Fixed energy, you are 'The Finisher.' You possess incredible determination, loyalty, and persistence. Once you commit to a path, you see it through to completion. Your challenge lies in being more flexible and embracing change when necessary.",
        mutable: "Your chart reveals a Mutable dominance, defining you as 'The Adapter.' You are versatile, resourceful, and capable of seeing all sides of a situation. You thrive in changing environments and excel at communication. Your growth area is developing more stability and decisiveness."
    };

    btnCalculate.addEventListener('click', function() {
        btnCalculate.innerHTML = '<i class="fas fa-circle-notch fa-spin me-2"></i> Analyzing...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            const counts = { cardinal: 0, fixed: 0, mutable: 0 };
            const ids = ['sun', 'moon', 'mercury', 'venus', 'mars', 'jupiter', 'saturn', 'ascendant'];
            
            ids.forEach(id => {
                const sign = document.getElementById('sign-' + id).value;
                counts[signModes[sign]]++;
            });

            const total = ids.length;
            const pcts = {
                cardinal: Math.round((counts.cardinal / total) * 100),
                fixed: Math.round((counts.fixed / total) * 100),
                mutable: Math.round((counts.mutable / total) * 100)
            };

            // Update Bars
            ['cardinal', 'fixed', 'mutable'].forEach(mode => {
                document.getElementById('pct-' + mode).textContent = pcts[mode] + '%';
                document.getElementById('bar-' + mode).style.width = pcts[mode] + '%';
            });

            // Find dominant
            let dominant = 'cardinal';
            if (counts.fixed > counts[dominant]) dominant = 'fixed';
            if (counts.mutable > counts[dominant]) dominant = 'mutable';

            document.getElementById('dominant-title').textContent = dominant.charAt(0).toUpperCase() + dominant.slice(1);
            document.getElementById('dominant-desc').textContent = `Your chart shows a ${pcts[dominant]}% concentration of ${dominant} energy.`;
            document.getElementById('res-interpretation').textContent = interpretations[dominant];

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth', block: 'center' });

            btnCalculate.innerHTML = '<i class="fas fa-chart-pie me-2"></i> Analyze Balance';
            btnCalculate.disabled = false;
        }, 800);
    });

    document.getElementById('btn-copy').addEventListener('click', function() {
        const text = `Modality Balance:\nCardinal: ${document.getElementById('pct-cardinal').innerText}\nFixed: ${document.getElementById('pct-fixed').innerText}\nMutable: ${document.getElementById('pct-mutable').innerText}\n\nDominant: ${document.getElementById('dominant-title').innerText}\nInterpretation: ${document.getElementById('res-interpretation').innerText}`;
        navigator.clipboard.writeText(text);
        const original = this.innerHTML;
        this.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        setTimeout(() => this.innerHTML = original, 2000);
    });
});
</script>
