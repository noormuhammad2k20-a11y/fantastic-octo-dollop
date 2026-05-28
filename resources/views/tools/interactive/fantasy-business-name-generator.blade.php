<div class="row g-4 fantasy-business-name-generator-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-purple">
            

            <div class="calculator-body">
                <div class="row g-4 mb-4">
                    {{-- Core Enterprise --}}
                    <div class="col-md-4 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-purple small"><i class="fas fa-sign me-2"></i>The Enterprise</h6>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Industry / Trade</label>
                            <select id="fb-industry" class="form-select border-2">
                                <option value="tavern">Tavern / Inn / Pub</option>
                                <option value="magic">Magic Shop / Arcana</option>
                                <option value="blacksmith">Blacksmith / Armory</option>
                                <option value="apothecary">Apothecary / Alchemy</option>
                                <option value="mercantile">General Mercantile / Trader</option>
                                <option value="guild">Guild / Mercenary Company</option>
                                <option value="brothel">Brothel / Entertainment</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Establishment Vibe</label>
                            <select id="fb-vibe" class="form-select border-2">
                                <option value="cozy">Cozy / Wholesome / Rustic</option>
                                <option value="shady">Shady / Criminal / Low-end</option>
                                <option value="mysterious">Mysterious / Arcane / Weird</option>
                                <option value="luxury">Luxury / High-End / Noble</option>
                                <option value="adventurous">Adventurous / Danger / Heroic</option>
                            </select>
                        </div>

                    </div>

                    {{-- Advanced Linguistics --}}
                    <div class="col-md-8 ps-md-4 mt-4 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-slate small"><i class="fas fa-language me-2"></i>Brand Engineering</h6>
                        
                        <div class="row g-3">
                            <div class="col-12 mb-2">
                                <label class="form-label-custom d-flex justify-content-between">
                                    <span>Brand Complexity (Length)</span>
                                    <span class="badge bg-slate" id="fb-length-val">Catchy (2 Words)</span>
                                </label>
                                <input type="range" class="form-range custom-range-purple" id="fb-length" min="1" max="3" step="1" value="2">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Must include this word.">Must Include Element</label>
                                <input type="text" id="fb-include" class="form-control" placeholder="e.g. Dragon, Rusty, Wand">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Words the engine should avoid.">Exclude Words</label>
                                <input type="text" id="fb-exclude" class="form-control border-danger-subtle bg-soft-red" placeholder="e.g. Magic, Shop, Old">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-2 pt-4 border-top d-flex flex-wrap gap-3 align-items-center">
                    <button id="gen-btn" class="btn btn-purple px-5 py-3 fw-bold rounded-4 shadow-sm fs-5 text-white">
                        <i class="fas fa-hammer me-2"></i> Forge Signboards
                    </button>
                    <button class="btn btn-outline-secondary px-4 py-3 fw-bold rounded-4" id="fb-clear"><i class="fas fa-broom me-2"></i>Clear</button>
                    
                    <div class="ms-auto border-start ps-3 d-none d-lg-block">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-purple me-1"></i>Presets:</span>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border fb-quick" data-p="shady-tavern">Shady Tavern</button>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border fb-quick" data-p="high-magic">High-End Magic Shop</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed position-relative" style="--tool-color:#8b5cf6;--tool-bg:#f5f3ff; min-height: 400px; padding-bottom: 8rem;">
            
            <div id="gen-placeholder" class="text-center py-5 d-flex flex-column justify-content-center h-100">
                <div class="opacity-25 mb-4 text-purple"><i class="fas fa-store-alt fa-5x fa-spin-hover"></i></div>
                <h3 class="text-dark fw-black">The Streets are Empty</h3>
                <p class="text-muted fs-5">Configure the industry and vibe above.<br>Your forged establishment names will appear here.</p>
            </div>

            <div id="gen-results" class="d-none">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3 border-purple-subtle">
                    <h5 class="fw-black m-0 text-dark d-flex align-items-center">
                        <i class="fas fa-sign text-purple me-2"></i> Hanging Signboards
                    </h5>
                    <button class="btn btn-sm btn-dark rounded-pill px-3" id="fb-copy-all"><i class="fas fa-copy me-2"></i>Copy All List</button>
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
                        <h6 class="fw-bold m-0 text-white d-flex align-items-center"><i class="fas fa-heart text-danger me-2"></i> Merchant Ledger (Vault)</h6>
                        <span class="small text-white-50" id="vault-count">0 saved names</span>
                    </div>
                    <div id="vault-tags" class="d-flex flex-wrap gap-2 mx-4 overflow-hidden" style="max-height: 40px; flex-grow: 1;">
                        <span class="text-white-50 small fst-italic mt-1" id="vault-empty">Click the heart icon on any name to record it in the ledger.</span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fw-bold rounded-pill shadow-sm" id="vault-copy"><i class="fas fa-copy text-purple me-1"></i> Copy Ledger</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    {{-- ═══════ SEO & EDUCATIONAL SECTION ═══════ --}}
    <div class="col-lg-12 mt-5">
        <div class="p-5 bg-white rounded-4 border shadow-sm article-content">
            <h3 class="fw-black text-dark mb-4"><i class="fas fa-book-open text-purple me-2"></i> The Dungeon Master's Guide to Commerce</h3>
            
            <div class="row g-5">
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">The "Adjective + Animal" Formula</h5>
                    <p class="text-muted">The most memorable taverns in fantasy literature follow the ancient British pub naming convention: <strong>[Adjective] + [Noun/Animal]</strong>. Think of <em>The Prancing Pony</em>, <em>The Yawning Portal</em>, or <em>The Rusty Dragon</em>. Our generator understands this deeply and will automatically generate a high volume of these when the 'Tavern' industry is selected.</p>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">Subverting Player Expectations</h5>
                    <p class="text-muted">Players assume a magic shop will be called something generic like "Arcane Emporium". If you want to build intrigue, use the <strong>Shady</strong> or <strong>Mysterious</strong> vibe filters. Names like <em>Whisper & Root</em> or <em>The Shadow's Ledger</em> immediately signal to the players that the NPC running the shop might offer illegal goods or dangerous quests.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',function(){
    const $ = id => document.getElementById(id);
    const els = {
        btn: $('gen-btn'), clear: $('fb-clear'), copyAll: $('fb-copy-all'),
        industry: $('fb-industry'), vibe: $('fb-vibe'),
        length: $('fb-length'), inc: $('fb-include'), exclude: $('fb-exclude'),
        lenVal: $('fb-length-val'),
        results: $('gen-results'), list: $('gen-list'), ph: $('gen-placeholder'),
        vaultTags: $('vault-tags'), vaultCount: $('vault-count'), vaultEmpty: $('vault-empty'), vaultCopy: $('vault-copy')
    };

    let vault = new Set();

    els.length.addEventListener('input', function(){
        const v = parseInt(this.value);
        if(v === 1) els.lenVal.textContent = "Minimal (1 Word)";
        if(v === 2) els.lenVal.textContent = "Catchy (2 Words)";
        if(v === 3) els.lenVal.textContent = "Descriptive (3+ Words)";
    });

    els.clear.addEventListener('click', () => {
        els.inc.value = ''; els.exclude.value = '';
        els.length.value = 2; els.lenVal.textContent = "Catchy (2 Words)";
        els.industry.value = 'tavern'; els.vibe.value = 'cozy';
    });

    els.btn.addEventListener('click',function(){
        els.btn.disabled=true;
        els.btn.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Forging Signboards...';
        
        let payload = {
            industry: els.industry.value,
            vibe: els.vibe.value,
            length: els.length.value,
            include: els.inc.value,
            exclude: els.exclude.value
        };

        fetch('{{ route("ai.generate",["type"=>"fantasy-business-name"]) }}',{
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
                    d.className=`name-chip p-3 d-flex justify-content-between align-items-center bg-white rounded-4 shadow-sm border border-purple-subtle ${isFav ? 'border-purple bg-purple-soft' : ''}`;
                    
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
                            d.classList.remove('border-purple', 'bg-purple-soft');
                        } else {
                            vault.add(item);
                            icon.className = 'fas fa-heart text-danger';
                            d.classList.add('border-purple', 'bg-purple-soft');
                        }
                        renderVault();
                    });
                    
                    col.appendChild(d);
                    els.list.appendChild(col);
                });
            }
        }).finally(function(){
            els.btn.disabled=false;
            els.btn.innerHTML='<i class="fas fa-hammer me-2"></i>Forge Signboards';
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
                            p.classList.remove('border-purple', 'bg-purple-soft');
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
    document.querySelectorAll('.fb-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === 'shady-tavern') { 
                els.industry.value = 'tavern'; els.vibe.value = 'shady'; els.length.value = 2; els.lenVal.textContent = "Catchy (2 Words)";
            } else if (p === 'high-magic') {
                els.industry.value = 'magic'; els.vibe.value = 'luxury'; els.length.value = 3; els.lenVal.textContent = "Descriptive (3+ Words)";
            }
            els.btn.click();
        });
    });

});
</script>

<style>
.fantasy-business-name-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(139,92,246,.05)}
.fantasy-business-name-generator-rebuilt .border-purple { border-top: 4px solid #8b5cf6 !important; }
.fantasy-business-name-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.fantasy-business-name-generator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.fantasy-business-name-generator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.fantasy-business-name-generator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.fantasy-business-name-generator-rebuilt .form-label-custom{font-size:.7rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}

.text-purple { color: #8b5cf6 !important; }
.bg-purple-soft { background-color: #f5f3ff !important; }
.border-purple { border-color: #8b5cf6 !important; }
.border-purple-subtle { border-color: #c4b5fd !important; }

.text-slate { color: #475569 !important; }
.bg-slate { background-color: #475569 !important; }
.border-end-md { border-right: 1px dashed #e2e8f0; }

.btn-purple { background: #8b5cf6; border: none; transition: 0.3s cubic-bezier(.4,0,.2,1); }
.btn-purple:hover { background: #6d28d9; color: white; transform: translateY(0); box-shadow: 0 4px 12px rgba(139,92,246,0.2) !important; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); overflow: hidden;}

/* Custom Range */
.custom-range-purple::-webkit-slider-thumb { background: #8b5cf6; }
.custom-range-purple::-moz-range-thumb { background: #8b5cf6; }

/* Interactive Chips */
.name-chip { transition: all 0.2s; cursor: default; }
.name-chip:hover { border-color: #e11d48 !important; }
.opacity-target { opacity: 1; }
.name-chip:hover .opacity-target { opacity: 1; }
.chip-btn { width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; padding: 0; transition: 0.2s; border: 1px solid #e2e8f0; }


/* Vault Floor */
.vault-floor { position: absolute; bottom: 0; left: 0; width: 100%; background: #1e293b; border-top: 4px solid #8b5cf6; z-index: 100; border-bottom-left-radius: 24px; border-bottom-right-radius: 24px; }
.vault-remove:hover { color: #8b5cf6 !important; }

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
