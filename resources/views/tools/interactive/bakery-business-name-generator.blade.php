<div class="row g-4 bakery-business-name-generator-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-amber">
            

            <div class="calculator-body">
                <div class="row g-4 mb-4">
                    {{-- Core Niche --}}
                    <div class="col-md-4 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-amber small"><i class="fas fa-utensils me-2"></i>Culinary Specialty</h6>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Main Focus</label>
                            <select id="bk-niche" class="form-select border-2">
                                <option value="bread">Artisan Breads / Sourdough</option>
                                <option value="pastry">Pastries / Cakes / Sweets</option>
                                <option value="cafe">Cafe / Coffee & Bakehouse</option>
                                <option value="vegan">Vegan / Gluten-Free Bakery</option>
                                <option value="donut">Donuts / Bagels</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Establishment Vibe</label>
                            <select id="bk-vibe" class="form-select border-2">
                                <option value="cozy">Cozy / Neighborhood / Rustic</option>
                                <option value="french">French / Artisan / Elegant</option>
                                <option value="modern">Modern / Minimalist / Urban</option>
                                <option value="playful">Playful / Punny / Fun</option>
                            </select>
                        </div>

                    </div>

                    {{-- Advanced Linguistics --}}
                    <div class="col-md-8 ps-md-4 mt-4 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-slate small"><i class="fas fa-language me-2"></i>Menu Engineering</h6>
                        
                        <div class="row g-3">
                            <div class="col-12 mb-2">
                                <label class="form-label-custom d-flex justify-content-between">
                                    <span>Brand Style</span>
                                    <span class="badge bg-slate" id="bk-length-val">Descriptive (2-3 Words)</span>
                                </label>
                                <input type="range" class="form-range custom-range-amber" id="bk-length" min="1" max="3" step="1" value="2">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Must include this word.">Signature Ingredient / Word</label>
                                <input type="text" id="bk-include" class="form-control" placeholder="e.g. Flour, Oven, Honey">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Words the engine should avoid.">Exclude Words</label>
                                <input type="text" id="bk-exclude" class="form-control border-danger-subtle bg-soft-red" placeholder="e.g. Bakery, Sweets">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-2 pt-4 border-top d-flex flex-wrap gap-3 align-items-center">
                    <button id="gen-btn" class="btn btn-amber px-5 py-3 fw-bold rounded-4 shadow-sm fs-5 text-white">
                        <i class="fas fa-cookie-bite me-2"></i> Bake Fresh Names
                    </button>
                    <button class="btn btn-outline-secondary px-4 py-3 fw-bold rounded-4" id="bk-clear"><i class="fas fa-broom me-2"></i>Clear</button>
                    
                    <div class="ms-auto border-start ps-3 d-none d-lg-block">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-amber me-1"></i>Recipes:</span>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border bk-quick" data-p="cozy">Cozy Neighborhood Cafe</button>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border bk-quick" data-p="french">French Patisserie</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed position-relative" style="--tool-color:#d97706;--tool-bg:#fffbeb; min-height: 400px; padding-bottom: 8rem;">
            
            <div id="gen-placeholder" class="text-center py-5 d-flex flex-column justify-content-center h-100">
                <div class="opacity-25 mb-4 text-amber"><i class="fas fa-oven fa-5x fa-spin-hover"></i></div>
                <h3 class="text-dark fw-black">The Display Case is Empty</h3>
                <p class="text-muted fs-5">Configure your specialty and vibe above.<br>Your fresh bakery names will appear here.</p>
            </div>

            <div id="gen-results" class="d-none">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3 border-amber-subtle">
                    <h5 class="fw-black m-0 text-dark d-flex align-items-center">
                        <i class="fas fa-bread-slice text-amber me-2"></i> Fresh Out The Oven
                    </h5>
                    <button class="btn btn-sm btn-dark rounded-pill px-3" id="bk-copy-all"><i class="fas fa-copy me-2"></i>Copy All List</button>
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
                        <h6 class="fw-bold m-0 text-white d-flex align-items-center"><i class="fas fa-heart text-danger me-2"></i> Recipe Book (Vault)</h6>
                        <span class="small text-white-50" id="vault-count">0 saved names</span>
                    </div>
                    <div id="vault-tags" class="d-flex flex-wrap gap-2 mx-4 overflow-hidden" style="max-height: 40px; flex-grow: 1;">
                        <span class="text-white-50 small fst-italic mt-1" id="vault-empty">Click the heart icon on any name to save it to your recipe book.</span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fw-bold rounded-pill shadow-sm" id="vault-copy"><i class="fas fa-copy text-amber me-1"></i> Copy Book</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    {{-- ═══════ SEO & EDUCATIONAL SECTION ═══════ --}}
    <div class="col-lg-12 mt-5">
        <div class="p-5 bg-white rounded-4 border shadow-sm article-content">
            <h3 class="fw-black text-dark mb-4"><i class="fas fa-utensils text-amber me-2"></i> The Secret Ingredient to Bakery Names</h3>
            
            <div class="row g-5">
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">Evoking the Senses</h5>
                    <p class="text-muted">A successful bakery name should make the customer's mouth water before they even smell the yeast. The best names utilize sensory words (e.g., <em>Crust, Crumb, Honey, Rise, Whisk</em>). If you want to ensure your name triggers a specific craving, put a sensory word in the <strong>Signature Ingredient</strong> box to force the generator to build around it.</p>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">Local Appeal vs Fancy Aesthetics</h5>
                    <p class="text-muted">Are you selling $2 morning bagels or $15 artisanal tartes? Your vibe determines your customer base. A <strong>Cozy</strong> vibe will generate names like <em>The Rolling Pin</em>, which feels approachable. A <strong>French/Artisan</strong> vibe will generate names utilizing foreign suffixes or elegant minimalist descriptors (e.g., <em>L'Oven, Le Petit Crumb, Flourish</em>) which justify a premium price point.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',function(){
    const $ = id => document.getElementById(id);
    const els = {
        btn: $('gen-btn'), clear: $('bk-clear'), copyAll: $('bk-copy-all'),
        niche: $('bk-niche'), vibe: $('bk-vibe'),
        length: $('bk-length'), inc: $('bk-include'), exclude: $('bk-exclude'),
        lenVal: $('bk-length-val'),
        results: $('gen-results'), list: $('gen-list'), ph: $('gen-placeholder'),
        vaultTags: $('vault-tags'), vaultCount: $('vault-count'), vaultEmpty: $('vault-empty'), vaultCopy: $('vault-copy')
    };

    let vault = new Set();

    els.length.addEventListener('input', function(){
        const v = parseInt(this.value);
        if(v === 1) els.lenVal.textContent = "One Word (Modern)";
        if(v === 2) els.lenVal.textContent = "Descriptive (2-3 Words)";
        if(v === 3) els.lenVal.textContent = "Long / Phrase";
    });

    els.clear.addEventListener('click', () => {
        els.inc.value = ''; els.exclude.value = '';
        els.length.value = 2; els.lenVal.textContent = "Descriptive (2-3 Words)";
        els.niche.value = 'bread'; els.vibe.value = 'cozy';
    });

    els.btn.addEventListener('click',function(){
        els.btn.disabled=true;
        els.btn.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Baking...';
        
        let payload = {
            niche: els.niche.value,
            vibe: els.vibe.value,
            length: els.length.value,
            include: els.inc.value,
            exclude: els.exclude.value
        };

        fetch('{{ route("ai.generate",["type"=>"bakery-name"]) }}',{
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
                    d.className=`name-chip p-3 d-flex justify-content-between align-items-center bg-white rounded-4 shadow-sm border border-amber-subtle ${isFav ? 'border-warning bg-amber-soft' : ''}`;
                    
                    d.innerHTML=`
                        <div class="flex-grow-1 overflow-hidden pe-2" title="${item}">
                            <h6 class="fw-bold mb-0 text-dark" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">${item}</h6>
                        </div>
                        <div class="d-flex gap-1 flex-shrink-0 opacity-target">
                            <button class="btn btn-sm btn-light rounded-circle chip-btn copy-btn" title="Copy">
                                <i class="fas fa-copy text-secondary"></i>
                            </button>
                            <button class="btn btn-sm btn-light rounded-circle chip-btn fav-btn" title="Favorite">
                                <i class="fa${isFav ? 's' : 'r'} fa-heart text-${isFav ? 'danger' : 'secondary'}"></i>
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
                            icon.className = 'far fa-heart text-secondary';
                            d.classList.remove('border-warning', 'bg-amber-soft');
                        } else {
                            vault.add(item);
                            icon.className = 'fas fa-heart text-danger';
                            d.classList.add('border-warning', 'bg-amber-soft');
                        }
                        renderVault();
                    });
                    
                    col.appendChild(d);
                    els.list.appendChild(col);
                });
            }
        }).finally(function(){
            els.btn.disabled=false;
            els.btn.innerHTML='<i class="fas fa-cookie-bite me-2"></i>Bake Fresh Names';
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
                            p.classList.remove('border-warning', 'bg-amber-soft');
                            p.querySelector('.fav-btn i').className = 'far fa-heart text-secondary';
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
    document.querySelectorAll('.bk-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === 'cozy') { 
                els.niche.value = 'cafe'; els.vibe.value = 'cozy'; els.length.value = 2; els.lenVal.textContent = "Descriptive (2-3 Words)";
            } else if (p === 'french') {
                els.niche.value = 'pastry'; els.vibe.value = 'french'; els.length.value = 2; els.lenVal.textContent = "Descriptive (2-3 Words)";
            }
            els.btn.click();
        });
    });

});
</script>

<style>
.bakery-business-name-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(217,119,6,.05)}
.bakery-business-name-generator-rebuilt .border-amber { border-top: 4px solid #d97706 !important; }
.bakery-business-name-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.bakery-business-name-generator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.bakery-business-name-generator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.bakery-business-name-generator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.bakery-business-name-generator-rebuilt .form-label-custom{font-size:.7rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}

.text-amber { color: #d97706 !important; }
.bg-amber-soft { background-color: #fffbeb !important; }
.border-amber { border-color: #d97706 !important; }
.border-amber-subtle { border-color: #fde68a !important; }
.border-warning { border-color: #f59e0b !important; }

.text-slate { color: #475569 !important; }
.bg-slate { background-color: #475569 !important; }
.border-end-md { border-right: 1px dashed #e2e8f0; }

.btn-amber { background: #d97706; color: white; border: none; transition: 0.3s cubic-bezier(.4,0,.2,1); }
.btn-amber:hover { background: #b45309; color: white; transform: translateY(0); box-shadow: 0 4px 12px rgba(217,119,6,0.2) !important; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); overflow: hidden;}

/* Custom Range */
.custom-range-amber::-webkit-slider-thumb { background: #d97706; }
.custom-range-amber::-moz-range-thumb { background: #d97706; }

/* Interactive Chips */
.name-chip { transition: all 0.2s; cursor: default; }
.name-chip:hover { border-color: #e11d48 !important; }
.opacity-target { opacity: 1; }
.name-chip:hover .opacity-target { opacity: 1; }
.chip-btn { width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; padding: 0; transition: 0.2s; border: 1px solid #e2e8f0; }


/* Vault Floor */
.vault-floor { position: absolute; bottom: 0; left: 0; width: 100%; background: #1e293b; border-top: 4px solid #d97706; z-index: 100; border-bottom-left-radius: 24px; border-bottom-right-radius: 24px; }
.vault-remove:hover { color: #d97706 !important; }

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
