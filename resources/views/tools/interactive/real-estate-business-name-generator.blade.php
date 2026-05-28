<div class="row g-4 real-estate-business-name-generator-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-navy">
            

            <div class="calculator-body">
                <div class="row g-4 mb-4">
                    {{-- Core Niche --}}
                    <div class="col-md-4 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-navy small"><i class="fas fa-briefcase me-2"></i>Target Market</h6>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Real Estate Niche</label>
                            <select id="re-niche" class="form-select border-2">
                                <option value="residential">Residential / Homes</option>
                                <option value="commercial">Commercial / Retail</option>
                                <option value="luxury">Luxury / High-End Estates</option>
                                <option value="management">Property Management</option>
                                <option value="industrial">Industrial / Logistics</option>
                                <option value="investing">Real Estate Investing / Flipping</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Brand Aesthetic</label>
                            <select id="re-vibe" class="form-select border-2">
                                <option value="modern">Modern / Sleek / Tech-Forward</option>
                                <option value="traditional">Traditional / Trustworthy / Legacy</option>
                                <option value="elite">Elite / Exclusive / Boutique</option>
                                <option value="local">Local / Community-Focused</option>
                            </select>
                        </div>

                    </div>

                    {{-- Advanced Linguistics --}}
                    <div class="col-md-8 ps-md-4 mt-4 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-slate small"><i class="fas fa-language me-2"></i>Brand Engineering</h6>
                        
                        <div class="row g-3">
                            <div class="col-12 mb-2">
                                <label class="form-label-custom d-flex justify-content-between">
                                    <span>Brand Complexity</span>
                                    <span class="badge bg-slate" id="re-length-val">Catchy (2 Words)</span>
                                </label>
                                <input type="range" class="form-range custom-range-navy" id="re-length" min="1" max="3" step="1" value="2">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Must include this word.">Must Include Element</label>
                                <input type="text" id="re-include" class="form-control" placeholder="e.g. Group, Partners, Vista">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Words the engine should avoid.">Exclude Words</label>
                                <input type="text" id="re-exclude" class="form-control border-danger-subtle bg-soft-red" placeholder="e.g. Realty, Brokers, Homes">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-2 pt-4 border-top d-flex flex-wrap gap-3 align-items-center">
                    <button id="gen-btn" class="btn btn-navy px-5 py-3 fw-bold rounded-4 shadow-sm fs-5 text-white">
                        <i class="fas fa-hammer me-2"></i> Generate Brands
                    </button>
                    <button class="btn btn-outline-secondary px-4 py-3 fw-bold rounded-4" id="re-clear"><i class="fas fa-broom me-2"></i>Clear</button>
                    
                    <div class="ms-auto border-start ps-3 d-none d-lg-block">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-navy me-1"></i>Presets:</span>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border re-quick" data-p="luxury">Modern Luxury Broker</button>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border re-quick" data-p="mgmt">Trustworthy Mgmt</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed position-relative" style="--tool-color:#0f172a;--tool-bg:#f8fafc; min-height: 400px; padding-bottom: 8rem;">
            
            <div id="gen-placeholder" class="text-center py-5 d-flex flex-column justify-content-center h-100">
                <div class="opacity-25 mb-4 text-navy"><i class="fas fa-city fa-5x fa-spin-hover"></i></div>
                <h3 class="text-dark fw-black">The Portfolio is Empty</h3>
                <p class="text-muted fs-5">Configure your market niche and brand vibe above.<br>Your generated firm names will appear here.</p>
            </div>

            <div id="gen-results" class="d-none">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3 border-navy-subtle">
                    <h5 class="fw-black m-0 text-dark d-flex align-items-center">
                        <i class="fas fa-briefcase text-navy me-2"></i> Generated Firms
                    </h5>
                    <button class="btn btn-sm btn-dark rounded-pill px-3" id="re-copy-all"><i class="fas fa-copy me-2"></i>Copy All List</button>
                </div>
                
                {{-- Interactive Grid --}}
                <div id="gen-list" class="row g-3">
                    <!-- Names injected here -->
                </div>
            </div>

            {{-- Sticky Vault Floor --}}
            <div class="vault-floor shadow-lg">
                <div class="container-fluid px-4 py-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="fw-bold m-0 text-white d-flex align-items-center"><i class="fas fa-certificate text-light me-2"></i> Reserved Names (Vault)</h6>
                        <span class="small text-white-50" id="vault-count">0 saved names</span>
                    </div>
                    <div id="vault-tags" class="d-flex flex-wrap gap-2 mx-4 overflow-hidden" style="max-height: 40px; flex-grow: 1;">
                        <span class="text-white-50 small fst-italic mt-1" id="vault-empty">Click the star icon on any name to reserve it here.</span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fw-bold rounded-pill shadow-sm" id="vault-copy"><i class="fas fa-copy text-navy me-1"></i> Copy Vault</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    {{-- ═══════ SEO & EDUCATIONAL SECTION ═══════ --}}
    <div class="col-lg-12 mt-5">
        <div class="p-5 bg-white rounded-4 border shadow-sm article-content">
            <h3 class="fw-black text-dark mb-4"><i class="fas fa-chart-line text-navy me-2"></i> Naming Your Real Estate Firm</h3>
            
            <div class="row g-5">
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">Trust vs. Innovation</h5>
                    <p class="text-muted">In the real estate industry, your name communicates your value proposition before the client ever sees your marketing material:</p>
                    <ul class="text-muted small">
                        <li><strong>Traditional/Trustworthy:</strong> Utilizes strong, grounded nouns (Oak, Stone, Peak) and classic suffixes like <em>Partners, Associates, or Group</em>. It implies stability and longevity.</li>
                        <li><strong>Modern/Tech-Forward:</strong> Utilizes abstract or single-word concepts, often employing unique spelling or removing vowels (e.g., <em>Aura, Nexa, Shift</em>). It implies speed, disruption, and modern marketing.</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">The "Must Include" Strategy</h5>
                    <p class="text-muted">Often, you want your own surname or a localized geographical feature in the brand. Use the <strong>Must Include Element</strong> field to force the AI to build a brand around your specific anchor word (e.g., forcing the word <em>"Colorado"</em> or <em>"Smith"</em>).</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',function(){
    const $ = id => document.getElementById(id);
    const els = {
        btn: $('gen-btn'), clear: $('re-clear'), copyAll: $('re-copy-all'),
        niche: $('re-niche'), vibe: $('re-vibe'),
        length: $('re-length'), inc: $('re-include'), exclude: $('re-exclude'),
        lenVal: $('re-length-val'),
        results: $('gen-results'), list: $('gen-list'), ph: $('gen-placeholder'),
        vaultTags: $('vault-tags'), vaultCount: $('vault-count'), vaultEmpty: $('vault-empty'), vaultCopy: $('vault-copy')
    };

    let vault = new Set();

    els.length.addEventListener('input', function(){
        const v = parseInt(this.value);
        if(v === 1) els.lenVal.textContent = "One Word (Modern)";
        if(v === 2) els.lenVal.textContent = "Catchy (2 Words)";
        if(v === 3) els.lenVal.textContent = "Corporate (3 Words)";
    });

    els.clear.addEventListener('click', () => {
        els.inc.value = ''; els.exclude.value = '';
        els.length.value = 2; els.lenVal.textContent = "Catchy (2 Words)";
        els.niche.value = 'residential'; els.vibe.value = 'modern';
    });

    els.btn.addEventListener('click',function(){
        els.btn.disabled=true;
        els.btn.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Generating...';
        
        let payload = {
            niche: els.niche.value,
            vibe: els.vibe.value,
            length: els.length.value,
            include: els.inc.value,
            exclude: els.exclude.value
        };

        fetch('{{ route("ai.generate",["type"=>"real-estate-name"]) }}',{
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
            body:JSON.stringify(payload)
        })
        .then(r=>r.json()).then(data=>{
            if(data.success){
                els.ph.classList.add('d-none');
                els.results.classList.remove('d-none');
                els.list.innerHTML='';
                
                data.results.forEach(item=>{
                    const col = document.createElement('div');
                    col.className = 'col-md-4 col-sm-6';
                    
                    const d=document.createElement('div');
                    const isFav = vault.has(item);
                    d.className=`name-chip p-3 d-flex justify-content-between align-items-center bg-white rounded-4 shadow-sm border border-navy-subtle ${isFav ? 'border-primary bg-navy-light' : ''}`;
                    
                    d.innerHTML=`
                        <div class="flex-grow-1 overflow-hidden pe-2" title="${item}">
                            <h6 class="fw-bold mb-0 text-dark" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">${item}</h6>
                        </div>
                        <div class="d-flex gap-1 flex-shrink-0 opacity-target">
                            <button class="btn btn-sm btn-light rounded-circle chip-btn copy-btn" title="Copy">
                                <i class="fas fa-copy text-secondary"></i>
                            </button>
                            <button class="btn btn-sm btn-light rounded-circle chip-btn fav-btn" title="Reserve Name">
                                <i class="fa${isFav ? 's' : 'r'} fa-star text-${isFav ? 'primary' : 'secondary'}"></i>
                            </button>
                        </div>
                    `;
                    
                    d.querySelector('.copy-btn').addEventListener('click',function(){
                        navigator.clipboard.writeText(item).then(function(){
                            const icon = d.querySelector('.copy-btn i');
                            icon.className = 'fas fa-check text-success';
                            setTimeout(function(){icon.className = 'fas fa-copy text-secondary';}, 2000);
                        });
                    });

                    d.querySelector('.fav-btn').addEventListener('click',function(){
                        const icon = this.querySelector('i');
                        if(vault.has(item)) {
                            vault.delete(item);
                            icon.className = 'far fa-star text-secondary';
                            d.classList.remove('border-primary', 'bg-navy-light');
                        } else {
                            vault.add(item);
                            icon.className = 'fas fa-star text-primary';
                            d.classList.add('border-primary', 'bg-navy-light');
                        }
                        renderVault();
                    });
                    
                    col.appendChild(d);
                    els.list.appendChild(col);
                });
            }
        }).finally(function(){
            els.btn.disabled=false;
            els.btn.innerHTML='<i class="fas fa-hammer me-2"></i>Generate Brands';
        });
    });

    function renderVault() {
        els.vaultTags.innerHTML = '';
        els.vaultCount.textContent = `${vault.size} saved names`;
        if (vault.size === 0) {
            els.vaultEmpty.classList.remove('d-none');
        } else {
            els.vaultEmpty.classList.add('d-none');
            vault.forEach(name => {
                const tag = document.createElement('span');
                tag.className = 'badge bg-white text-dark border shadow-sm d-flex align-items-center py-2 px-3 fw-bold';
                tag.innerHTML = `${name} <i class="fas fa-times text-muted ms-2 px-1 vault-remove" style="cursor:pointer;" data-name="${name}"></i>`;
                
                tag.querySelector('.vault-remove').addEventListener('click', function(){
                    vault.delete(this.dataset.name);
                    renderVault();
                    document.querySelectorAll('.name-chip h6').forEach(h6 => {
                        if(h6.innerText === this.dataset.name) {
                            const p = h6.closest('.name-chip');
                            p.classList.remove('border-primary', 'bg-navy-light');
                            p.querySelector('.fav-btn i').className = 'far fa-star text-secondary';
                        }
                    });
                });

                els.vaultTags.appendChild(tag);
            });
        }
    }

    els.vaultCopy.addEventListener('click', function(){
        if(vault.size === 0) return;
        navigator.clipboard.writeText(Array.from(vault).join('\n')).then(()=>{
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check text-success me-1"></i> Copied!';
            setTimeout(()=>{this.innerHTML = o;}, 2000);
        });
    });

    els.copyAll.addEventListener('click', function(){
        let allNames = [];
        document.querySelectorAll('.name-chip h6').forEach(h => {
            allNames.push(h.innerText);
        });
        if(allNames.length === 0) return;
        navigator.clipboard.writeText(allNames.join('\n')).then(()=>{
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>{this.innerHTML = o;}, 2000);
        });
    });

    // Presets
    document.querySelectorAll('.re-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === 'luxury') { 
                els.niche.value = 'luxury'; els.vibe.value = 'elite'; els.length.value = 1; els.lenVal.textContent = "One Word (Modern)";
            } else if (p === 'mgmt') {
                els.niche.value = 'management'; els.vibe.value = 'traditional'; els.length.value = 3; els.lenVal.textContent = "Corporate (3 Words)";
            }
            els.btn.click();
        });
    });

});
</script>

<style>
.real-estate-business-name-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(15,23,42,.05)}
.real-estate-business-name-generator-rebuilt .border-navy { border-top: 4px solid #0f172a !important; }
.real-estate-business-name-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.real-estate-business-name-generator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.real-estate-business-name-generator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.real-estate-business-name-generator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.real-estate-business-name-generator-rebuilt .form-label-custom{font-size:.7rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}

.text-navy { color: #0f172a !important; }
.bg-navy-soft { background-color: #f8fafc !important; }
.bg-navy-light { background-color: #f1f5f9 !important; }
.border-navy { border-color: #0f172a !important; }
.border-navy-subtle { border-color: #cbd5e1 !important; }

.text-slate { color: #475569 !important; }
.bg-slate { background-color: #475569 !important; }
.border-end-md { border-right: 1px dashed #e2e8f0; }

.btn-navy { background: #0f172a; color: white; border: none; transition: 0.3s cubic-bezier(.4,0,.2,1); }
.btn-navy:hover { background: #1e293b; color: white; transform: translateY(0); box-shadow: 0 4px 12px rgba(15,23,42,0.2) !important; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); overflow: hidden;}

/* Custom Range */
.custom-range-navy::-webkit-slider-thumb { background: #0f172a; }
.custom-range-navy::-moz-range-thumb { background: #0f172a; }

/* Interactive Chips */
.name-chip { transition: all 0.2s; cursor: default; }
.name-chip:hover { border-color: #e11d48 !important; }
.opacity-target { opacity: 1; }
.name-chip:hover .opacity-target { opacity: 1; }
.chip-btn { width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; padding: 0; transition: 0.2s; border: 1px solid #e2e8f0; }


/* Vault Floor */
.vault-floor { position: absolute; bottom: 0; left: 0; width: 100%; background: #0f172a; border-top: 4px solid #3b82f6; z-index: 100; border-bottom-left-radius: 24px; border-bottom-right-radius: 24px; }
.vault-remove:hover { color: #3b82f6 !important; }

/* Article Content */
.article-content p { line-height: 1.7; font-size: 0.95rem; }

@media (max-width: 768px) {
    .border-end-md { border-right: none; border-bottom: 1px dashed #e2e8f0; padding-bottom: 2rem; }
    .ps-md-4 { padding-left: 0 !important; }
    .pe-md-4 { padding-right: 0 !important; }
    .opacity-target { opacity: 1; }
    .vault-floor { flex-direction: column; padding: 1rem; text-align: center; }
}
</style>
