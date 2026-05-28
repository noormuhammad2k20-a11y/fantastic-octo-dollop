<div class="row g-4 cocktail-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Base Spirit</label>
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-outline-danger active spirit-btn" data-spirit="any">Any Spirit</button>
                        <button class="btn btn-outline-danger spirit-btn" data-spirit="vodka">Vodka</button>
                        <button class="btn btn-outline-danger spirit-btn" data-spirit="gin">Gin</button>
                        <button class="btn btn-outline-danger spirit-btn" data-spirit="rum">Rum</button>
                        <button class="btn btn-outline-danger spirit-btn" data-spirit="tequila">Tequila</button>
                        <button class="btn btn-outline-danger spirit-btn" data-spirit="whiskey">Whiskey</button>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-danger fw-bold fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="cocktail-generate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-glass-martini-alt me-2"></i>Mix Me a Drink
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="cocktail-output-card" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(239,68,68,.04); border-color:#fca5a5;">
            <div class="row g-4">
                <div class="col-md-5 text-center d-flex flex-column justify-content-center border-end pe-md-4">
                    <div id="cocktail-icon" class="mb-3" style="font-size: 5rem; color:#dc2626;"><i class="fas fa-glass-whiskey"></i></div>
                    <h2 id="cocktail-name" class="fw-black text-dark mb-2">Margarita</h2>
                    <span id="cocktail-glass" class="badge bg-secondary align-self-center px-3 py-2">Margarita Glass</span>
                </div>
                
                <div class="col-md-7 ps-md-4">
                    <h5 class="fw-bold mb-3"><i class="fas fa-list-ul me-2 text-danger"></i>Ingredients</h5>
                    <ul id="cocktail-ingredients" class="list-group list-group-flush mb-4 bg-transparent border-0">
                        <!-- Ingredients injected here -->
                    </ul>
                    
                    <h5 class="fw-bold mb-3"><i class="fas fa-book-open me-2 text-danger"></i>Instructions</h5>
                    <p id="cocktail-instructions" class="lead fs-6 text-muted mb-0">Shake ingredients with ice.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.cocktail-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.cocktail-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.cocktail-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.cocktail-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.cocktail-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.cocktail-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.8rem;}

.btn-outline-danger { border-radius: 20px; padding: 0.5rem 1.5rem; font-weight: 600; }
.list-group-item { background: transparent !important; padding: 0.5rem 0; border-color: rgba(0,0,0,0.05); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let selectedSpirit = 'any';

    const cocktails = [
        // Vodka
        { s: 'vodka', n: 'Moscow Mule', g: 'Copper Mug', i: ['2 oz Vodka', '4 oz Ginger Beer', '0.5 oz Lime Juice'], d: 'Combine vodka and ginger beer in a copper mug filled with ice. Add lime juice. Stir gently. Garnish with a lime slice.', ic: 'fa-beer' },
        { s: 'vodka', n: 'Cosmopolitan', g: 'Martini Glass', i: ['1.5 oz Vodka Citron', '1 oz Cointreau', '0.5 oz Fresh lime juice', '1 dash Cranberry juice'], d: 'Add all ingredients into a cocktail shaker filled with ice. Shake well and double strain into large cocktail glass. Garnish with a lime wheel.', ic: 'fa-glass-martini-alt' },
        // Gin
        { s: 'gin', n: 'Negroni', g: 'Old Fashioned Glass', i: ['1 oz Gin', '1 oz Campari', '1 oz Sweet Vermouth'], d: 'Stir into glass over ice, garnish and serve.', ic: 'fa-glass-whiskey' },
        { s: 'gin', n: 'Gimlet', g: 'Martini Glass', i: ['2 oz Gin', '0.75 oz Lime Juice', '0.75 oz Simple Syrup'], d: 'Add all ingredients to a shaker with ice. Shake until chilled. Strain into a chilled glass.', ic: 'fa-glass-martini' },
        // Rum
        { s: 'rum', n: 'Mojito', g: 'Highball Glass', i: ['2 oz Light Rum', '1 oz Lime Juice', '2 tsp Sugar', '6 Mint leaves', 'Soda Water'], d: 'Muddle mint leaves with sugar and lime juice. Add a splash of soda water and fill glass with ice. Pour rum and top with soda water.', ic: 'fa-glass-whiskey' },
        { s: 'rum', n: 'Daiquiri', g: 'Cocktail Glass', i: ['2 oz Light Rum', '1 oz Lime Juice', '0.75 oz Simple Syrup'], d: 'Shake all ingredients with ice. Strain into a chilled glass.', ic: 'fa-glass-martini' },
        // Tequila
        { s: 'tequila', n: 'Margarita', g: 'Margarita Glass', i: ['2 oz Tequila', '1 oz Cointreau', '1 oz Lime Juice', 'Salt rim'], d: 'Rub rim of cocktail glass with lime juice. Dip rim in salt. Shake all ingredients with ice, strain into glass.', ic: 'fa-glass-martini-alt' },
        { s: 'tequila', n: 'Paloma', g: 'Highball Glass', i: ['2 oz Tequila', '0.5 oz Lime Juice', 'Grapefruit soda'], d: 'Pour tequila and lime juice into glass over ice. Top with grapefruit soda. Stir gently.', ic: 'fa-glass-whiskey' },
        // Whiskey
        { s: 'whiskey', n: 'Old Fashioned', g: 'Old Fashioned Glass', i: ['2 oz Bourbon', '2 dashes Angostura bitters', '1 Sugar cube', 'Few drops water'], d: 'Place sugar cube in glass, saturate with bitters and water. Muddle until dissolved. Add ice and whiskey. Stir gently.', ic: 'fa-glass-whiskey' },
        { s: 'whiskey', n: 'Whiskey Sour', g: 'Old Fashioned Glass', i: ['2 oz Bourbon', '0.75 oz Lemon Juice', '0.5 oz Simple Syrup', '1 Egg white (optional)'], d: 'Dry shake all ingredients without ice. Add ice and shake again. Strain into glass.', ic: 'fa-glass-whiskey' }
    ];

    document.querySelectorAll('.spirit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.spirit-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            selectedSpirit = this.dataset.spirit;
        });
    });

    $('cocktail-generate').addEventListener('click', function() {
        let filtered = cocktails;
        if (selectedSpirit !== 'any') {
            filtered = cocktails.filter(c => c.s === selectedSpirit);
        }

        const drink = filtered[Math.floor(Math.random() * filtered.length)];

        $('cocktail-name').textContent = drink.n;
        $('cocktail-glass').textContent = drink.g;
        $('cocktail-instructions').textContent = drink.d;
        $('cocktail-icon').innerHTML = `<i class="fas ${drink.ic}"></i>`;

        const ul = $('cocktail-ingredients');
        ul.innerHTML = '';
        drink.i.forEach(ing => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex align-items-center';
            li.innerHTML = `<i class="fas fa-check-circle text-success me-3 small"></i> <span class="fw-bold">${ing}</span>`;
            ul.appendChild(li);
        });

        $('cocktail-output-card').classList.remove('d-none');
        
        // simple animate
        $('cocktail-output-card').classList.remove('animate__animated', 'animate__fadeIn');
        void $('cocktail-output-card').offsetWidth;
        $('cocktail-output-card').classList.add('animate__animated', 'animate__fadeIn');
        
        $('cocktail-output-card').scrollIntoView({ behavior: 'smooth' });
    });
});
</script>

