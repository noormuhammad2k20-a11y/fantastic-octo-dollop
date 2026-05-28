<div class="row g-4 activity-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="mb-4 text-center">
                    <label class="form-label-custom mb-3">Select Category</label>
                    <div class="d-flex flex-wrap justify-content-center gap-2" id="act-filters">
                        <button class="btn btn-outline-pink active act-filter" data-cat="all">All</button>
                        <button class="btn btn-outline-pink act-filter" data-cat="creative">Creative</button>
                        <button class="btn btn-outline-pink act-filter" data-cat="productive">Productive</button>
                        <button class="btn btn-outline-pink act-filter" data-cat="relaxing">Relaxing</button>
                        <button class="btn btn-outline-pink act-filter" data-cat="outdoor">Outdoor</button>
                        <button class="btn btn-outline-pink act-filter" data-cat="social">Social</button>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <button class="btn py-3 px-5 fw-bold rounded-pill text-white fs-5 shadow-sm" id="act-generate" style="min-width: 280px; max-width: 100%; background:#ec4899;border:none;min-width:280px;max-width:100%;">
                        <i class="fas fa-dice me-2"></i>Give me something to do!
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none text-center" id="act-output-card" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04); padding: 3rem 2rem;">
            <div id="act-emoji" style="font-size: 5rem; line-height: 1; margin-bottom: 1rem;">🤔</div>
            <h2 id="act-title" class="fw-black mb-3" style="color:#831843;">Something Fun</h2>
            <p id="act-desc" class="lead text-muted mb-4">A short description of the activity.</p>
            
            <div class="d-flex justify-content-center gap-3">
                <span class="badge bg-white text-dark border px-3 py-2 fs-6 rounded-pill"><i class="far fa-clock me-2 text-pink"></i><span id="act-time">1 hr</span></span>
                <span class="badge bg-white text-dark border px-3 py-2 fs-6 rounded-pill"><i class="fas fa-tag me-2 text-pink"></i><span id="act-cat-label" class="text-capitalize">Creative</span></span>
            </div>
        </div>
    </div>
</div>

<style>
.activity-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.activity-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.activity-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.activity-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.activity-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.activity-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block}

.btn-outline-pink {
    color: #ec4899;
    border-color: #fbcfe8;
    background: #fff;
    font-weight: 600;
    border-radius: 20px;
    padding: 0.5rem 1.5rem;
}
.btn-outline-pink:hover {
    background: #fce7f3;
    color: #db2777;
    border-color: #fbcfe8;
}
.btn-outline-pink.active {
    background: #ec4899;
    color: #fff;
    border-color: #ec4899;
}
.text-pink { color: #ec4899; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let currentCategory = 'all';

    const activities = [
        { c: 'creative', e: '🎨', t: 'Paint or draw something', d: 'Grab a canvas, paper, or digital tablet and let your imagination run wild.', time: '1-2 hrs' },
        { c: 'creative', e: '✍️', t: 'Write a short story', d: 'Write a 500-word flash fiction story about a time traveler.', time: '1 hr' },
        { c: 'creative', e: '🎸', t: 'Learn a new song', d: 'Pick up an instrument and learn the chords to a song you love.', time: '1-2 hrs' },
        { c: 'creative', e: '📸', t: 'Go on a photo walk', d: 'Take a walk around your neighborhood and capture interesting textures and lighting.', time: '1 hr' },
        
        { c: 'productive', e: '🧹', t: 'Declutter your workspace', d: 'Organize your desk, throw away trash, and wipe down your keyboard.', time: '30 mins' },
        { c: 'productive', e: '📚', t: 'Read 20 pages of a book', d: 'Pick up that non-fiction or self-help book you\'ve been meaning to finish.', time: '45 mins' },
        { c: 'productive', e: '💻', t: 'Organize digital files', d: 'Sort out your Downloads folder and delete unused apps.', time: '30 mins' },
        { c: 'productive', e: '🍳', t: 'Meal prep for tomorrow', d: 'Prepare your lunch or chop vegetables in advance to save time.', time: '1 hr' },

        { c: 'relaxing', e: '🧘', t: 'Do a 15-minute meditation', d: 'Find a quiet spot, close your eyes, and focus entirely on your breathing.', time: '15 mins' },
        { c: 'relaxing', e: '🛁', t: 'Take a hot bath', d: 'Add some Epsom salts or a bath bomb, play soft music, and soak.', time: '45 mins' },
        { c: 'relaxing', e: '🎵', t: 'Listen to a new album', d: 'Put on quality headphones and listen to an album from start to finish without distractions.', time: '1 hr' },
        { c: 'relaxing', e: '☕', t: 'Brew a fancy coffee/tea', d: 'Take your time to make a high-quality beverage and enjoy it slowly.', time: '20 mins' },

        { c: 'outdoor', e: '🚶', t: 'Go for a nature walk', d: 'Find a local park or trail and walk without looking at your phone.', time: '1 hr' },
        { c: 'outdoor', e: '🚴', t: 'Go for a bike ride', d: 'Pump up the tires and explore a new route in your city.', time: '1-2 hrs' },
        { c: 'outdoor', e: '🧺', t: 'Have a mini picnic', d: 'Pack some snacks and a blanket, and eat outside in the sun.', time: '1 hr' },
        { c: 'outdoor', e: '🌱', t: 'Do some gardening', d: 'Water the plants, pull out some weeds, or re-pot a houseplant.', time: '45 mins' },

        { c: 'social', e: '📞', t: 'Call an old friend', d: 'Call someone you haven\'t spoken to in over a month just to catch up.', time: '30 mins' },
        { c: 'social', e: '🎲', t: 'Host a board game night', d: 'Invite a few friends over or play online tabletop games.', time: '2-3 hrs' },
        { c: 'social', e: '✉️', t: 'Write a physical letter', d: 'Write a postcard or letter to a family member and mail it.', time: '30 mins' },
        { c: 'social', e: '🤝', t: 'Volunteer online', d: 'Spend some time on a site like FreeRice or doing micro-volunteering.', time: '30 mins' }
    ];

    document.querySelectorAll('.act-filter').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.act-filter').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentCategory = this.dataset.cat;
        });
    });

    $('act-generate').addEventListener('click', function() {
        const filtered = currentCategory === 'all' 
            ? activities 
            : activities.filter(a => a.c === currentCategory);
            
        const randomItem = filtered[Math.floor(Math.random() * filtered.length)];
        
        $('act-emoji').textContent = randomItem.e;
        $('act-title').textContent = randomItem.t;
        $('act-desc').textContent = randomItem.d;
        $('act-time').textContent = randomItem.time;
        $('act-cat-label').textContent = randomItem.c;

        $('act-output-card').classList.remove('d-none');
        $('act-output-card').classList.add('animate__animated', 'animate__fadeIn');
        
        // Remove animation class after it plays so it can play again
        setTimeout(() => {
            $('act-output-card').classList.remove('animate__animated', 'animate__fadeIn');
        }, 1000);
        
        $('act-output-card').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\activity-generator.blade.php ENDPATH**/ ?>