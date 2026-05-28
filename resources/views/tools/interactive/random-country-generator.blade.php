<div class="row g-4 country-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Quantity</label>
                        <select id="country-count" class="form-select form-select-lg">
                            <option value="1" selected>1 Country</option>
                            <option value="3">3 Countries</option>
                            <option value="6">6 Countries</option>
                            <option value="12">12 Countries</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Filter by Region</label>
                        <select id="country-region" class="form-select form-select-lg">
                            <option value="any" selected>Any Region</option>
                            <option value="Africa">Africa</option>
                            <option value="Americas">Americas</option>
                            <option value="Asia">Asia</option>
                            <option value="Europe">Europe</option>
                            <option value="Oceania">Oceania</option>
                        </select>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-success fw-bold fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="country-generate" style="min-width: 280px; max-width: 100%; background:#10b981; border:none;">
                    <i class="fas fa-globe me-2"></i>Generate Countries
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="country-output-card" style="--tool-hue:150;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04); border-color:#a7f3d0;">
            <div class="row g-3" id="country-grid">
                <!-- Country cards injected here -->
            </div>
        </div>
    </div>
</div>

<style>
.country-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.country-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.country-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.country-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.country-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.country-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.4rem;}

.country-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 1.5rem;
    text-align: center;
    transition: transform 0.2s, box-shadow 0.2s;
    height: 100%;
}
.country-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}
.country-emoji {
    font-size: 5rem;
    line-height: 1;
    margin-bottom: 0.5rem;
    border-radius: 8px;
}
.country-meta {
    font-size: 0.85rem;
    color: #64748b;
    margin-top: 10px;
    padding-top: 10px;
    border-top: 1px dashed #cbd5e1;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const countries = [
        { n: 'United States', c: 'Washington, D.C.', r: 'Americas', e: '🇺🇸', p: '331 M' },
        { n: 'Canada', c: 'Ottawa', r: 'Americas', e: '🇨🇦', p: '38 M' },
        { n: 'Brazil', c: 'Brasília', r: 'Americas', e: '🇧🇷', p: '212 M' },
        { n: 'Mexico', c: 'Mexico City', r: 'Americas', e: '🇲🇽', p: '128 M' },
        { n: 'United Kingdom', c: 'London', r: 'Europe', e: '🇬🇧', p: '67 M' },
        { n: 'France', c: 'Paris', r: 'Europe', e: '🇫🇷', p: '67 M' },
        { n: 'Germany', c: 'Berlin', r: 'Europe', e: '🇩🇪', p: '83 M' },
        { n: 'Italy', c: 'Rome', r: 'Europe', e: '🇮🇹', p: '60 M' },
        { n: 'Spain', c: 'Madrid', r: 'Europe', e: '🇪🇸', p: '47 M' },
        { n: 'Japan', c: 'Tokyo', r: 'Asia', e: '🇯🇵', p: '125 M' },
        { n: 'China', c: 'Beijing', r: 'Asia', e: '🇨🇳', p: '1.4 B' },
        { n: 'India', c: 'New Delhi', r: 'Asia', e: '🇮🇳', p: '1.38 B' },
        { n: 'South Korea', c: 'Seoul', r: 'Asia', e: '🇰🇷', p: '51 M' },
        { n: 'Egypt', c: 'Cairo', r: 'Africa', e: '🇪🇬', p: '102 M' },
        { n: 'South Africa', c: 'Pretoria', r: 'Africa', e: '🇿🇦', p: '59 M' },
        { n: 'Nigeria', c: 'Abuja', r: 'Africa', e: '🇳🇬', p: '206 M' },
        { n: 'Kenya', c: 'Nairobi', r: 'Africa', e: '🇰🇪', p: '53 M' },
        { n: 'Australia', c: 'Canberra', r: 'Oceania', e: '🇦🇺', p: '25 M' },
        { n: 'New Zealand', c: 'Wellington', r: 'Oceania', e: '🇳🇿', p: '5 M' },
        { n: 'Fiji', c: 'Suva', r: 'Oceania', e: '🇫🇯', p: '896 K' }
    ];

    $('country-generate').addEventListener('click', function() {
        const count = parseInt($('country-count').value);
        const region = $('country-region').value;

        let filtered = region === 'any' ? [...countries] : countries.filter(c => c.r === region);
        
        // If not enough countries in the filtered list, duplicate some or just show what we have
        // But for random gen, we shuffle and slice
        for (let i = filtered.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [filtered[i], filtered[j]] = [filtered[j], filtered[i]];
        }

        const selected = filtered.slice(0, Math.min(count, filtered.length));
        
        const grid = $('country-grid');
        grid.innerHTML = '';

        let colClass = count === 1 ? 'col-12' : (count === 3 ? 'col-md-4' : 'col-md-6 col-lg-4');

        selected.forEach(c => {
            grid.innerHTML += `
                <div class="${colClass} animate__animated animate__zoomIn">
                    <div class="country-card">
                        <div class="country-emoji">${c.e}</div>
                        <h4 class="fw-bold mb-1 text-dark">${c.n}</h4>
                        <div class="fw-bold text-success mb-2">${c.c}</div>
                        <div class="country-meta d-flex justify-content-between">
                            <span><i class="fas fa-globe-africa me-1"></i> ${c.r}</span>
                            <span><i class="fas fa-users me-1"></i> ${c.p}</span>
                        </div>
                    </div>
                </div>
            `;
        });

        $('country-output-card').classList.remove('d-none');
        $('country-output-card').scrollIntoView({ behavior: 'smooth' });
    });
});
</script>

