<div class="row g-4 btc-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label-custom">Select Your Blood Type</label>
                        <div class="d-flex flex-wrap gap-2" id="btc-types-grid">
                            @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                                <button type="button" class="btn btn-outline-danger flex-grow-1 py-3 fw-bold rounded-3 type-btn {{ $type === 'O+' ? 'active' : '' }}" data-type="{{ $type }}">
                                    {{ $type }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Clinical Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 btc-quick" data-t="O-">🚨 Universal Donor (O-)</button>
                    <button type="button" class="button btn-sm btn-outline-dark rounded-pill px-3 btc-quick" data-t="AB+">💉 Universal Recipient (AB+)</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="btc-theme" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(220,38,38,.06);">
            <div class="output-hero">
                <span class="output-hero-label">COMPATIBILITY PROFILE</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-selected">O+</span>
                    <span class="output-hero-unit">Type</span>
                </div>
                <div class="mt-2 text-muted fw-bold small">Rh Factor Sensitive</div>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-md-6">
                    <div class="stat-card" style="border-color:#dc2626; background: #fff;">
                        <span class="stat-card-label">YOU CAN RECEIVE FROM</span>
                        <div id="out-receive" class="d-flex flex-wrap gap-2 justify-content-center mt-2"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card" style="border-color:#1e293b; background: #fff;">
                        <span class="stat-card-label">YOU CAN DONATE TO</span>
                        <div id="out-donate" class="d-flex flex-wrap gap-2 justify-content-center mt-2"></div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-info-circle text-danger me-2"></i>Medical Implications
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btc-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Compatibility List
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btc-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Profile
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    let selectedType = 'O+';

    const compatibility = {
        'A+': { receive: ['A+', 'A-', 'O+', 'O-'], donate: ['A+', 'AB+'], note: 'A+ is one of the most common blood types.' },
        'A-': { receive: ['A-', 'O-'], donate: ['A+', 'A-', 'AB+', 'AB-'], note: 'A- can donate to both positive and negative A and AB types.' },
        'B+': { receive: ['B+', 'B-', 'O+', 'O-'], donate: ['B+', 'AB+'], note: 'B+ can receive from any B or O type.' },
        'B-': { receive: ['B-', 'O-'], donate: ['B+', 'B-', 'AB+', 'AB-'], note: 'B- is quite rare and valuable for research.' },
        'AB+': { receive: ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'], donate: ['AB+'], note: 'AB+ is the <strong>Universal Recipient</strong>.' },
        'AB-': { receive: ['A-', 'B-', 'AB-', 'O-'], donate: ['AB+', 'AB-'], note: 'AB- is the rarest blood type in many populations.' },
        'O+': { receive: ['O+', 'O-'], donate: ['A+', 'B+', 'AB+', 'O+'], note: 'O+ is the most frequently requested blood type.' },
        'O-': { receive: ['O-'], donate: ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'], note: 'O- is the <strong>Universal Donor</strong>.' }
    };

    function calculate(){
        const data = compatibility[selectedType];
        
        $('out-selected').textContent = selectedType;
        
        $('out-receive').innerHTML = data.receive.map(t => `<span class="badge bg-light text-danger border border-danger-subtle px-3 py-2 rounded-pill">${t}</span>`).join('');
        $('out-donate').innerHTML = data.donate.map(t => `<span class="badge bg-danger text-white px-3 py-2 rounded-pill">${t}</span>`).join('');
        
        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">
            <li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-danger me-2 mt-1"></i><span>${data.note}</span></li>
            <li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-danger me-2 mt-1"></i><span>Always confirm blood type through clinical lab testing before any transfusion.</span></li>
        </ul>`;
    }

    document.querySelectorAll('.type-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            selectedType = btn.dataset.type;
            document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            calculate();
        });
    });

    document.querySelectorAll('.btc-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            selectedType = btn.dataset.t;
            document.querySelectorAll('.type-btn').forEach(b => {
                b.classList.toggle('active', b.dataset.type === selectedType);
            });
            calculate();
        });
    });

    $('btc-copy-btn').addEventListener('click', function(){
        const data = compatibility[selectedType];
        const text = `Blood Type Compatibility Profile (${selectedType})\nReceive From: ${data.receive.join(', ')}\nDonate To: ${data.donate.join(', ')}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Profile Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.btc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(220,38,38,.05)}
.btc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.btc-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.btc-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.btc-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.btc-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.btc-rebuilt .btn-outline-danger{border-color:#dc2626; color:#dc2626; border-width:2.5px}
.btc-rebuilt .btn-outline-danger.active{background-color:#dc2626; border-color:#dc2626; color:#fff}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:2rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .btc-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
