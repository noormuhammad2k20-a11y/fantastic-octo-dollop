<div class="row g-4 rpg-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Class Preference</label>
                        <select id="rpg-class" class="form-select form-select-lg">
                            <option value="any" selected>Random Class</option>
                            <option value="Fighter">Fighter / Warrior</option>
                            <option value="Wizard">Wizard / Mage</option>
                            <option value="Rogue">Rogue / Thief</option>
                            <option value="Cleric">Cleric / Healer</option>
                            <option value="Ranger">Ranger / Hunter</option>
                            <option value="Paladin">Paladin</option>
                            <option value="Bard">Bard</option>
                            <option value="Barbarian">Barbarian</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Stat Generation Method</label>
                        <select id="rpg-stats" class="form-select form-select-lg">
                            <option value="4d6dl" selected>4d6 Drop Lowest (High Fantasy)</option>
                            <option value="standard">Standard Array (15, 14, 13, 12, 10, 8)</option>
                            <option value="3d6">Classic 3d6 (Gritty)</option>
                        </select>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-primary fw-bold fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="rpg-generate" style="min-width: 280px; max-width: 100%; background:#8b5cf6; border:none;">
                    <i class="fas fa-scroll me-2"></i>Roll Character
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="rpg-output-card" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04); border-color:#ddd6fe; padding: 2rem;">
            
            <div class="text-center mb-4 pb-4 border-bottom">
                <h1 id="char-name" class="fw-black text-dark mb-2" style="font-family: Georgia, serif;">Character Name</h1>
                <h4 id="char-subtitle" class="text-primary mb-3">Level 1 Elf Ranger</h4>
                
                <div class="d-flex justify-content-center gap-2 flex-wrap">
                    <span class="badge bg-light border text-dark fs-6"><i class="fas fa-balance-scale me-1"></i> <span id="char-alignment">Chaotic Good</span></span>
                    <span class="badge bg-light border text-dark fs-6"><i class="fas fa-book me-1"></i> Background: <span id="char-background">Outlander</span></span>
                </div>
            </div>

            <h5 class="fw-bold mb-3"><i class="fas fa-fist-raised me-2 text-primary"></i>Ability Scores</h5>
            <div class="row g-3 mb-4 text-center">
                <div class="col-4 col-md-2">
                    <div class="p-3 bg-white border rounded-3 h-100">
                        <div class="small fw-bold text-muted mb-1">STR</div>
                        <div class="fs-3 fw-black text-dark" id="stat-str">10</div>
                    </div>
                </div>
                <div class="col-4 col-md-2">
                    <div class="p-3 bg-white border rounded-3 h-100">
                        <div class="small fw-bold text-muted mb-1">DEX</div>
                        <div class="fs-3 fw-black text-dark" id="stat-dex">10</div>
                    </div>
                </div>
                <div class="col-4 col-md-2">
                    <div class="p-3 bg-white border rounded-3 h-100">
                        <div class="small fw-bold text-muted mb-1">CON</div>
                        <div class="fs-3 fw-black text-dark" id="stat-con">10</div>
                    </div>
                </div>
                <div class="col-4 col-md-2">
                    <div class="p-3 bg-white border rounded-3 h-100">
                        <div class="small fw-bold text-muted mb-1">INT</div>
                        <div class="fs-3 fw-black text-dark" id="stat-int">10</div>
                    </div>
                </div>
                <div class="col-4 col-md-2">
                    <div class="p-3 bg-white border rounded-3 h-100">
                        <div class="small fw-bold text-muted mb-1">WIS</div>
                        <div class="fs-3 fw-black text-dark" id="stat-wis">10</div>
                    </div>
                </div>
                <div class="col-4 col-md-2">
                    <div class="p-3 bg-white border rounded-3 h-100">
                        <div class="small fw-bold text-muted mb-1">CHA</div>
                        <div class="fs-3 fw-black text-dark" id="stat-cha">10</div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 border rounded-3">
                <h5 class="fw-bold mb-3"><i class="fas fa-quote-left me-2 text-primary"></i>Personality & Flaws</h5>
                <p id="char-quirk" class="text-muted fst-italic mb-0">Has a strange habit of collecting shiny rocks.</p>
            </div>
        </div>
    </div>
</div>

<style>
.rpg-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.rpg-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.rpg-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.rpg-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.rpg-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.rpg-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.4rem;}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const data = {
        names: ['Aelar', 'Thorin', 'Kael', 'Lyra', 'Seraphina', 'Garrick', 'Vex', 'Bram', 'Elara', 'Drogo', 'Sylas', 'Mira', 'Dax'],
        races: ['Human', 'Elf', 'Dwarf', 'Halfling', 'Dragonborn', 'Gnome', 'Half-Orc', 'Tiefling'],
        classes: ['Fighter', 'Wizard', 'Rogue', 'Cleric', 'Ranger', 'Paladin', 'Bard', 'Barbarian', 'Warlock', 'Monk', 'Druid'],
        alignments: ['Lawful Good', 'Neutral Good', 'Chaotic Good', 'Lawful Neutral', 'True Neutral', 'Chaotic Neutral', 'Lawful Evil', 'Neutral Evil', 'Chaotic Evil'],
        backgrounds: ['Acolyte', 'Charlatan', 'Criminal', 'Entertainer', 'Folk Hero', 'Guild Artisan', 'Hermit', 'Noble', 'Outlander', 'Sage', 'Sailor', 'Soldier', 'Urchin'],
        quirks: [
            'Constantly talks to a lucky coin.',
            'Refuses to enter a room first.',
            'Always exaggerates their past heroic deeds.',
            'Has a phobia of small bodies of water.',
            'Apologizes to items before breaking them.',
            'Keeps a journal detailing every meal they eat.',
            'Hates the color yellow with a passion.',
            'Has a suspiciously detailed knowledge of local nobility gossip.'
        ]
    };

    function rollNdX(n, x) {
        let sum = 0;
        const rolls = [];
        for(let i=0; i<n; i++) {
            const r = Math.floor(Math.random() * x) + 1;
            rolls.push(r);
        }
        return rolls;
    }

    function generateStats(method) {
        if (method === 'standard') {
            const arr = [15, 14, 13, 12, 10, 8];
            for (let i = arr.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [arr[i], arr[j]] = [arr[j], arr[i]];
            }
            return arr;
        }

        const stats = [];
        for(let s=0; s<6; s++) {
            if (method === '4d6dl') {
                const rolls = rollNdX(4, 6);
                rolls.sort((a,b)=>a-b);
                stats.push(rolls[1] + rolls[2] + rolls[3]);
            } else {
                // 3d6
                const rolls = rollNdX(3, 6);
                stats.push(rolls[0] + rolls[1] + rolls[2]);
            }
        }
        return stats;
    }

    function pickRandom(arr) {
        return arr[Math.floor(Math.random() * arr.length)];
    }

    $('rpg-generate').addEventListener('click', function() {
        const classPref = $('rpg-class').value;
        const statMethod = $('rpg-stats').value;

        const name = pickRandom(data.names);
        const race = pickRandom(data.races);
        const cls = classPref === 'any' ? pickRandom(data.classes) : classPref;
        const bg = pickRandom(data.backgrounds);
        const align = pickRandom(data.alignments);
        const quirk = pickRandom(data.quirks);
        
        const stats = generateStats(statMethod);
        
        // Minor optimization to put highest stat in primary ability
        let primaryIdx = 0; // STR default
        if (['Wizard'].includes(cls)) primaryIdx = 3; // INT
        if (['Rogue', 'Ranger', 'Monk'].includes(cls)) primaryIdx = 1; // DEX
        if (['Cleric', 'Druid'].includes(cls)) primaryIdx = 4; // WIS
        if (['Bard', 'Paladin', 'Warlock'].includes(cls)) primaryIdx = 5; // CHA
        if (['Barbarian', 'Fighter'].includes(cls)) primaryIdx = 0; // STR

        // Swap highest stat with primary ability
        let maxIdx = 0;
        for(let i=1; i<6; i++) {
            if (stats[i] > stats[maxIdx]) maxIdx = i;
        }
        
        const temp = stats[primaryIdx];
        stats[primaryIdx] = stats[maxIdx];
        stats[maxIdx] = temp;

        $('char-name').textContent = name;
        $('char-subtitle').textContent = `Level 1 ${race} ${cls}`;
        $('char-alignment').textContent = align;
        $('char-background').textContent = bg;
        $('char-quirk').textContent = quirk;

        $('stat-str').textContent = stats[0];
        $('stat-dex').textContent = stats[1];
        $('stat-con').textContent = stats[2];
        $('stat-int').textContent = stats[3];
        $('stat-wis').textContent = stats[4];
        $('stat-cha').textContent = stats[5];

        $('rpg-output-card').classList.remove('d-none');
        
        $('rpg-output-card').classList.remove('animate__animated', 'animate__fadeInUp');
        void $('rpg-output-card').offsetWidth;
        $('rpg-output-card').classList.add('animate__animated', 'animate__fadeInUp');
        
        $('rpg-output-card').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
});
</script>

