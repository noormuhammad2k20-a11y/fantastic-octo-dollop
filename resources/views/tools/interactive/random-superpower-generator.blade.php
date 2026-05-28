<div class="row g-4 power-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body text-center">
                <div class="mb-4">
                    <label class="form-label-custom">Select Power Tier</label>
                    <div class="d-flex flex-wrap justify-content-center gap-2" id="power-tiers">
                        <button class="btn btn-outline-danger active tier-btn" data-tier="any">Any Power</button>
                        <button class="btn btn-outline-danger tier-btn" data-tier="hero">Heroic (OP)</button>
                        <button class="btn btn-outline-danger tier-btn" data-tier="villain">Villainous (Dark)</button>
                        <button class="btn btn-outline-danger tier-btn" data-tier="useless">Useless (Funny)</button>
                    </div>
                </div>

                <button class="btn btn-danger py-3 px-5 fw-bold rounded-pill fs-4" id="power-generate" style="min-width: 280px; max-width: 100%; background:#ef4444; border:none; box-shadow: 0 4px 15px rgba(239,68,68,.3);">
                    <i class="fas fa-meteor me-2"></i>Discover My Power
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none text-center" id="power-output-card" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(239,68,68,.04); border-color:#fca5a5; padding: 4rem 2rem;">
            
            <div id="power-icon" class="mb-3 animate__animated animate__pulse animate__infinite" style="font-size: 4rem; color: #ef4444;">
                <i class="fas fa-bolt"></i>
            </div>
            
            <h1 id="power-title" class="fw-black text-dark text-uppercase mb-3" style="letter-spacing: 2px;">Telekinesis</h1>
            <p id="power-desc" class="text-secondary fs-5 mx-auto" style="max-width: 600px;">The ability to move and manipulate objects with your mind.</p>
            
            <div class="mt-4">
                <span id="power-badge" class="badge bg-danger px-3 py-2 text-uppercase" style="letter-spacing: 1px;">HEROIC TIER</span>
            </div>
        </div>
    </div>
</div>

<style>
.power-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.power-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.power-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.power-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.power-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.power-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.8rem;}

.btn-outline-danger {
    color: #ef4444;
    border-color: #fca5a5;
    font-weight: 600;
    border-radius: 20px;
    padding: 0.5rem 1.5rem;
}
.btn-outline-danger:hover, .btn-outline-danger.active {
    background: #ef4444;
    color: #fff;
    border-color: #ef4444;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let selectedTier = 'any';

    const db = {
        hero: [
            { t: "Telekinesis", d: "Move and manipulate physical objects purely with the power of your mind.", i: "fa-brain" },
            { t: "Chronokinesis", d: "The ability to slow down, speed up, or completely stop time at will.", i: "fa-hourglass-half" },
            { t: "Energy Projection", d: "Generate and fire concentrated blasts of raw energy from your hands or eyes.", i: "fa-sun" },
            { t: "Regeneration", d: "Instantly heal from any physical injury or illness in seconds.", i: "fa-heartbeat" },
            { t: "Flight", d: "Defy gravity and propel yourself through the air at supersonic speeds.", i: "fa-wind" }
        ],
        villain: [
            { t: "Mind Control", d: "Take complete control over the thoughts and actions of any sentient being.", i: "fa-chess-king" },
            { t: "Necromancy", d: "Summon and command the dead to do your bidding.", i: "fa-skull" },
            { t: "Life Drain", d: "Absorb the vital life force of others to heal yourself and increase your power.", i: "fa-ghost" },
            { t: "Shadow Manipulation", d: "Control darkness and shadows to hide, attack, or travel instantly.", i: "fa-moon" },
            { t: "Decay Touch", d: "Instantly rot, rust, or disintegrate anything you touch with your bare hands.", i: "fa-biohazard" }
        ],
        useless: [
            { t: "Instant Hindsight", d: "The ability to immediately know exactly what you *should* have done in a situation, but only after it's too late.", i: "fa-history" },
            { t: "WiFi Sense", d: "You can sense when a WiFi network is nearby, but you still don't know the password.", i: "fa-wifi" },
            { t: "Levitation (1 inch)", d: "You can float exactly one inch off the ground, but it takes all of your concentration.", i: "fa-shoe-prints" },
            { t: "Color Change", d: "You can change the color of your own hair, but it takes 3 weeks to complete.", i: "fa-palette" },
            { t: "Toaster Communication", d: "You can talk to toasters, but they are incredibly boring conversationalists.", i: "fa-bread-slice" }
        ]
    };

    document.querySelectorAll('.tier-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.tier-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            selectedTier = this.dataset.tier;
        });
    });

    $('power-generate').addEventListener('click', function() {
        let tier = selectedTier;
        if (tier === 'any') {
            const keys = Object.keys(db);
            tier = keys[Math.floor(Math.random() * keys.length)];
        }

        const list = db[tier];
        const power = list[Math.floor(Math.random() * list.length)];

        $('power-title').textContent = power.t;
        $('power-desc').textContent = power.d;
        $('power-icon').innerHTML = `<i class="fas ${power.i}"></i>`;
        
        let badgeColor = 'bg-primary';
        if (tier === 'hero') badgeColor = 'bg-success';
        if (tier === 'villain') badgeColor = 'bg-dark';
        if (tier === 'useless') badgeColor = 'bg-warning text-dark';
        
        $('power-badge').className = `badge px-3 py-2 text-uppercase ${badgeColor}`;
        $('power-badge').textContent = `${tier} TIER`;

        $('power-output-card').classList.remove('d-none');
        
        // Retrigger animation
        const title = $('power-title');
        title.classList.remove('animate__animated', 'animate__flipInX');
        void title.offsetWidth;
        title.classList.add('animate__animated', 'animate__flipInX');
        
        $('power-output-card').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
});
</script>

