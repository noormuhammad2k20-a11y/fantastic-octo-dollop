<div class="row g-4 name-randomizer-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Gender</label>
                        <select id="name-gender" class="form-select form-select-lg">
                            <option value="both">Mixed / Both</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Region / Style</label>
                        <select id="name-region" class="form-select form-select-lg">
                            <option value="us" selected>Western (US/UK)</option>
                            <option value="in">Indian</option>
                            <option value="es">Hispanic</option>
                            <option value="fr">French</option>
                            <option value="jp">Japanese</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Include Middle Name</label>
                        <div class="form-check form-switch pt-2">
                            <input class="form-check-input" type="checkbox" id="name-middle">
                            <label class="form-check-label" for="name-middle">Add random middle initial/name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Quantity</label>
                        <input type="number" id="name-count" class="form-control form-control-lg" value="5" min="1" max="100">
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-indigo fw-bold text-white py-3 px-5 fw-bold rounded-pill shadow-sm"" id="generate-btn" style="min-width: 280px; max-width: 100%; background:#6366f1">
                        <i class="fas fa-user-plus me-2"></i>Generate Random Names
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="name-output-card" style="--tool-hue:235;--tool-color:#4f46e5;--tool-bg:rgba(99,102,241,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Primary Result</span>
                <div class="output-hero-value fs-2" id="primary-name">-</div>
                <span class="output-hero-unit" id="name-type-label">Full Name Generated</span>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-users me-2 text-primary"></i>All Generated Names</h6>
                <div id="results-list" class="row g-2">
                    <!-- Names here -->
                </div>
            </div>
            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-all" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy All Names
            </button>
        </div>
    </div>
</div>

<style>
.name-randomizer-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.name-randomizer-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.name-randomizer-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.name-randomizer-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.name-randomizer-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.name-randomizer-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}

.name-pill {
    background: white;
    border: 1px solid #e0e7ff;
    padding: 12px;
    border-radius: 12px;
    font-weight: 700;
    color: #3730a3;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: all 0.2s;
}
.name-pill:hover {
    border-color: #6366f1;
    background: #f5f3ff;
    transform: translateY(-2px);
}
.name-pill i { color: #818cf8; font-size: 0.8rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    const data = {
        us: {
            male: ["James", "John", "Robert", "Michael", "William", "David", "Richard", "Joseph", "Thomas", "Charles"],
            female: ["Mary", "Patricia", "Jennifer", "Linda", "Elizabeth", "Barbara", "Susan", "Jessica", "Sarah", "Karen"],
            last: ["Smith", "Johnson", "Williams", "Brown", "Jones", "Garcia", "Miller", "Davis", "Rodriguez", "Martinez"]
        },
        in: {
            male: ["Aarav", "Arjun", "Vivaan", "Aditya", "Vihaan", "Pranav", "Sai", "Krishna", "Ishan", "Aryan"],
            female: ["Aadhya", "Ananya", "Saanvi", "Diya", "Pari", "Anika", "Riya", "Aavya", "Ira", "Myra"],
            last: ["Sharma", "Verma", "Gupta", "Malhotra", "Kapoor", "Khan", "Singh", "Patel", "Reddy", "Iyer"]
        },
        es: {
            male: ["Santiago", "Mateo", "Juan", "Sebastian", "Alejandro", "Luis", "Diego", "Carlos", "Jose", "Manuel"],
            female: ["Sofia", "Lucia", "Maria", "Isabella", "Valentina", "Camila", "Elena", "Paula", "Martina", "Julia"],
            last: ["Garcia", "Fernandez", "Gonzalez", "Rodriguez", "Lopez", "Martinez", "Sanchez", "Perez", "Gomez", "Martin"]
        },
        fr: {
            male: ["Gabriel", "Louis", "Raphaël", "Arthur", "Jules", "Lucas", "Adam", "Maël", "Hugo", "Léo"],
            female: ["Emma", "Jade", "Louise", "Alice", "Chloé", "Lina", "Mila", "Léa", "Manon", "Rose"],
            last: ["Martin", "Bernard", "Thomas", "Petit", "Robert", "Richard", "Durand", "Dubois", "Moreau", "Laurent"]
        },
        jp: {
            male: ["Haruto", "Riku", "Haru", "Hinata", "Kaito", "Asahi", "Sora", "Reo", "Yuto", "Touma"],
            female: ["Himari", "Akari", "Ichika", "Sara", "Yua", "Mio", "Nico", "Aoi", "Kanna", "Hina"],
            last: ["Sato", "Suzuki", "Takahashi", "Tanaka", "Watanabe", "Ito", "Nakamura", "Kobayashi", "Saito", "Yamamoto"]
        }
    };

    $('generate-btn').addEventListener('click', generateNames);

    function generateNames() {
        const region = $('name-region').value;
        const gender = $('name-gender').value;
        const count = parseInt($('name-count').value) || 1;
        const middle = $('name-middle').checked;
        
        const results = [];
        const pool = data[region];

        for (let i = 0; i < count; i++) {
            let g = gender;
            if (g === 'both') g = Math.random() < 0.5 ? 'male' : 'female';
            
            const first = pool[g][Math.floor(Math.random() * pool[g].length)];
            const last = pool.last[Math.floor(Math.random() * pool.last.length)];
            let full = first;
            
            if (middle) {
                if (region === 'us') {
                    const initials = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                    full += " " + initials[Math.floor(Math.random() * initials.length)] + ".";
                }
            }
            
            full += " " + last;
            results.push({ name: full, gender: g });
        }

        $('primary-name').textContent = results[0].name;
        
        const container = $('results-list');
        container.innerHTML = '';
        results.forEach(res => {
            const col = document.createElement('div');
            col.className = 'col-md-6';
            col.innerHTML = `
                <div class="name-pill">
                    <i class="fas fa-${res.gender === 'male' ? 'mars' : 'venus'}"></i>
                    ${res.name}
                </div>
            `;
            container.appendChild(col);
        });

        $('name-output-card').classList.remove('d-none');
        $('name-output-card').scrollIntoView({ behavior: 'smooth' });
    }

    $('copy-all').addEventListener('click', function() {
        const names = Array.from(document.querySelectorAll('.name-pill')).map(p => p.innerText.trim());
        navigator.clipboard.writeText(names.join('\n')).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\name-randomizer.blade.php ENDPATH**/ ?>