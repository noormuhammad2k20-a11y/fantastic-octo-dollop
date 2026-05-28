<div class="row g-4 animal-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Quantity</label>
                        <select id="animal-count" class="form-select form-select-lg">
                            <option value="1" selected>1 Animal</option>
                            <option value="3">3 Animals</option>
                            <option value="6">6 Animals</option>
                            <option value="12">12 Animals</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Filter by Class</label>
                        <select id="animal-class" class="form-select form-select-lg">
                            <option value="all" selected>All Classes</option>
                            <option value="mammal">Mammals</option>
                            <option value="bird">Birds</option>
                            <option value="reptile">Reptiles & Amphibians</option>
                            <option value="aquatic">Aquatic (Fish & Marine)</option>
                            <option value="bug">Insects & Bugs</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark fw-bold fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="animal-generate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-search me-2"></i>Discover Animals
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="animal-output-card" style="--tool-hue:20;--tool-color:#451a03;--tool-bg:rgba(120,113,108,.05); border-color:#d6d3d1;">
            <div class="row g-3" id="animal-grid">
                <!-- Animal cards injected here -->
            </div>
        </div>
    </div>
</div>

<style>
.animal-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.animal-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.animal-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.animal-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.animal-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.animal-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.4rem;}

.animal-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 1.5rem;
    text-align: center;
    transition: transform 0.2s, box-shadow 0.2s;
    height: 100%;
}
.animal-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}
.animal-emoji {
    font-size: 4rem;
    line-height: 1;
    margin-bottom: 1rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const db = [
        { c: 'mammal', n: 'African Elephant', s: 'Loxodonta africana', e: '🐘', f: 'Elephants can communicate using infrasound.' },
        { c: 'mammal', n: 'Red Panda', s: 'Ailurus fulgens', e: '🐼', f: 'Red pandas use their bushy tails as wraparound blankets in the chilly mountains.' },
        { c: 'mammal', n: 'Tiger', s: 'Panthera tigris', e: '🐅', f: 'No two tigers have the same stripes.' },
        { c: 'mammal', n: 'Kangaroo', s: 'Macropodidae', e: '🦘', f: 'Kangaroos cannot walk backwards.' },
        { c: 'mammal', n: 'Sloth', s: 'Folivora', e: '🦥', f: 'Sloths move so slowly that algae actually grows on their fur.' },
        
        { c: 'bird', n: 'Bald Eagle', s: 'Haliaeetus leucocephalus', e: '🦅', f: 'Their nests can weigh up to a ton.' },
        { c: 'bird', n: 'Penguin', s: 'Spheniscidae', e: '🐧', f: 'Emperor penguins can dive up to 1,850 feet deep.' },
        { c: 'bird', n: 'Flamingo', s: 'Phoenicopteridae', e: '🦩', f: 'Flamingos are pink because of their diet of shrimp and algae.' },
        { c: 'bird', n: 'Peacock', s: 'Pavo cristatus', e: '🦚', f: 'Only the males are called peacocks; females are peahens.' },
        { c: 'bird', n: 'Owl', s: 'Strigiformes', e: '🦉', f: 'Owls can turn their heads 270 degrees.' },

        { c: 'reptile', n: 'Chameleon', s: 'Chamaeleonidae', e: '🦎', f: 'Their eyes can move independently of each other.' },
        { c: 'reptile', n: 'Sea Turtle', s: 'Chelonioidea', e: '🐢', f: 'Some sea turtles can live to be over 100 years old.' },
        { c: 'reptile', n: 'Crocodile', s: 'Crocodylidae', e: '🐊', f: 'Crocodiles have the strongest bite of any animal in the world.' },
        { c: 'reptile', n: 'Snake', s: 'Serpentes', e: '🐍', f: 'Snakes smell with their tongues.' },

        { c: 'aquatic', n: 'Dolphin', s: 'Delphinidae', e: '🐬', f: 'Dolphins use echolocation to navigate and hunt.' },
        { c: 'aquatic', n: 'Great White Shark', s: 'Carcharodon carcharias', e: '🦈', f: 'Sharks have been around longer than trees.' },
        { c: 'aquatic', n: 'Octopus', s: 'Octopoda', e: '🐙', f: 'Octopuses have three hearts and blue blood.' },
        { c: 'aquatic', n: 'Whale', s: 'Cetacea', e: '🐳', f: 'The blue whale is the largest animal known to have ever lived.' },
        { c: 'aquatic', n: 'Blowfish', s: 'Tetraodontidae', e: '🐡', f: 'They inflate their bodies to avoid being eaten.' },

        { c: 'bug', n: 'Honey Bee', s: 'Apis mellifera', e: '🐝', f: 'A single bee will produce only 1/12th of a teaspoon of honey in its lifetime.' },
        { c: 'bug', n: 'Ladybug', s: 'Coccinellidae', e: '🐞', f: 'Ladybugs bleed from their knees when threatened.' },
        { c: 'bug', n: 'Butterfly', s: 'Rhopalocera', e: '🦋', f: 'Butterflies taste with their feet.' },
        { c: 'bug', n: 'Ant', s: 'Formicidae', e: '🐜', f: 'Ants can carry up to 50 times their own body weight.' },
        { c: 'bug', n: 'Spider', s: 'Araneae', e: '🕷️', f: 'Not all spiders spin webs to catch their prey.' }
    ];

    $('animal-generate').addEventListener('click', function() {
        const count = parseInt($('animal-count').value);
        const cls = $('animal-class').value;

        const filtered = cls === 'all' ? [...db] : db.filter(a => a.c === cls);
        
        // Shuffle
        for (let i = filtered.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [filtered[i], filtered[j]] = [filtered[j], filtered[i]];
        }

        const selected = filtered.slice(0, Math.min(count, filtered.length));
        const grid = $('animal-grid');
        grid.innerHTML = '';

        let colClass = count === 1 ? 'col-12' : (count === 3 ? 'col-md-4' : 'col-md-6 col-lg-4');

        selected.forEach(anim => {
            grid.innerHTML += `
                <div class="${colClass}">
                    <div class="animal-card">
                        <div class="animal-emoji">${anim.e}</div>
                        <h4 class="fw-bold mb-1 text-dark">${anim.n}</h4>
                        <div class="small text-muted font-monospace mb-3"><i>${anim.s}</i></div>
                        <div class="p-2 bg-light rounded small text-secondary">
                            <strong>Fun Fact:</strong> ${anim.f}
                        </div>
                    </div>
                </div>
            `;
        });

        $('animal-output-card').classList.remove('d-none');
        $('animal-output-card').scrollIntoView({ behavior: 'smooth' });
    });
});
</script>

