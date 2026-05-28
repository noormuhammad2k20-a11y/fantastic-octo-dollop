<div class="row g-4 state-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Quantity</label>
                        <select id="state-count" class="form-select form-select-lg">
                            <option value="1" selected>1 State</option>
                            <option value="3">3 States</option>
                            <option value="5">5 States</option>
                            <option value="10">10 States</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Include D.C. & Territories?</label>
                        <select id="state-territory" class="form-select form-select-lg">
                            <option value="no" selected>No (50 States Only)</option>
                            <option value="yes">Yes (Inc. D.C. & PR)</option>
                        </select>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-primary fw-bold fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="state-generate" style="min-width: 280px; max-width: 100%; background:#2563eb; border:none;">
                    <i class="fas fa-map-marked-alt me-2"></i>Generate States
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="state-output-card" style="--tool-hue:210;--tool-color:#1d4ed8;--tool-bg:rgba(59,130,246,.04); border-color:#bfdbfe;">
            <div class="row g-3" id="state-grid">
                <!-- States injected here -->
            </div>
        </div>
    </div>
</div>

<style>
.state-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.state-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.state-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.state-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.state-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.state-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.4rem;}

.state-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
}
.state-abbr {
    font-size: 2.5rem;
    font-weight: 900;
    color: #1e40af;
    line-height: 1;
    margin-bottom: 0.5rem;
    font-family: monospace;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const states = [
        { n: 'Alabama', a: 'AL', c: 'Montgomery' }, { n: 'Alaska', a: 'AK', c: 'Juneau' },
        { n: 'Arizona', a: 'AZ', c: 'Phoenix' }, { n: 'Arkansas', a: 'AR', c: 'Little Rock' },
        { n: 'California', a: 'CA', c: 'Sacramento' }, { n: 'Colorado', a: 'CO', c: 'Denver' },
        { n: 'Connecticut', a: 'CT', c: 'Hartford' }, { n: 'Delaware', a: 'DE', c: 'Dover' },
        { n: 'Florida', a: 'FL', c: 'Tallahassee' }, { n: 'Georgia', a: 'GA', c: 'Atlanta' },
        { n: 'Hawaii', a: 'HI', c: 'Honolulu' }, { n: 'Idaho', a: 'ID', c: 'Boise' },
        { n: 'Illinois', a: 'IL', c: 'Springfield' }, { n: 'Indiana', a: 'IN', c: 'Indianapolis' },
        { n: 'Iowa', a: 'IA', c: 'Des Moines' }, { n: 'Kansas', a: 'KS', c: 'Topeka' },
        { n: 'Kentucky', a: 'KY', c: 'Frankfort' }, { n: 'Louisiana', a: 'LA', c: 'Baton Rouge' },
        { n: 'Maine', a: 'ME', c: 'Augusta' }, { n: 'Maryland', a: 'MD', c: 'Annapolis' },
        { n: 'Massachusetts', a: 'MA', c: 'Boston' }, { n: 'Michigan', a: 'MI', c: 'Lansing' },
        { n: 'Minnesota', a: 'MN', c: 'St. Paul' }, { n: 'Mississippi', a: 'MS', c: 'Jackson' },
        { n: 'Missouri', a: 'MO', c: 'Jefferson City' }, { n: 'Montana', a: 'MT', c: 'Helena' },
        { n: 'Nebraska', a: 'NE', c: 'Lincoln' }, { n: 'Nevada', a: 'NV', c: 'Carson City' },
        { n: 'New Hampshire', a: 'NH', c: 'Concord' }, { n: 'New Jersey', a: 'NJ', c: 'Trenton' },
        { n: 'New Mexico', a: 'NM', c: 'Santa Fe' }, { n: 'New York', a: 'NY', c: 'Albany' },
        { n: 'North Carolina', a: 'NC', c: 'Raleigh' }, { n: 'North Dakota', a: 'ND', c: 'Bismarck' },
        { n: 'Ohio', a: 'OH', c: 'Columbus' }, { n: 'Oklahoma', a: 'OK', c: 'Oklahoma City' },
        { n: 'Oregon', a: 'OR', c: 'Salem' }, { n: 'Pennsylvania', a: 'PA', c: 'Harrisburg' },
        { n: 'Rhode Island', a: 'RI', c: 'Providence' }, { n: 'South Carolina', a: 'SC', c: 'Columbia' },
        { n: 'South Dakota', a: 'SD', c: 'Pierre' }, { n: 'Tennessee', a: 'TN', c: 'Nashville' },
        { n: 'Texas', a: 'TX', c: 'Austin' }, { n: 'Utah', a: 'UT', c: 'Salt Lake City' },
        { n: 'Vermont', a: 'VT', c: 'Montpelier' }, { n: 'Virginia', a: 'VA', c: 'Richmond' },
        { n: 'Washington', a: 'WA', c: 'Olympia' }, { n: 'West Virginia', a: 'WV', c: 'Charleston' },
        { n: 'Wisconsin', a: 'WI', c: 'Madison' }, { n: 'Wyoming', a: 'WY', c: 'Cheyenne' }
    ];

    const terrs = [
        { n: 'District of Columbia', a: 'DC', c: 'Washington' },
        { n: 'Puerto Rico', a: 'PR', c: 'San Juan' }
    ];

    $('state-generate').addEventListener('click', function() {
        const count = parseInt($('state-count').value);
        const incTerr = $('state-territory').value === 'yes';

        let pool = [...states];
        if (incTerr) pool = pool.concat(terrs);

        // Shuffle
        for (let i = pool.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [pool[i], pool[j]] = [pool[j], pool[i]];
        }

        const selected = pool.slice(0, count);
        const grid = $('state-grid');
        grid.innerHTML = '';

        let colClass = count === 1 ? 'col-12' : (count === 3 ? 'col-md-4' : 'col-md-6');
        if (count === 10) colClass = 'col-md-4 col-lg-3';

        selected.forEach(s => {
            grid.innerHTML += `
                <div class="${colClass} animate__animated animate__zoomIn">
                    <div class="state-card">
                        <div class="state-abbr">${s.a}</div>
                        <h5 class="fw-bold mb-1 text-dark">${s.n}</h5>
                        <div class="small text-muted">Capital: ${s.c}</div>
                    </div>
                </div>
            `;
        });

        $('state-output-card').classList.remove('d-none');
        $('state-output-card').scrollIntoView({ behavior: 'smooth' });
    });
});
</script>

