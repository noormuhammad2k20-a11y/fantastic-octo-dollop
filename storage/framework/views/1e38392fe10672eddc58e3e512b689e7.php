<div class="row g-4 etsy-business-name-generator-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-rose">
            

            <div class="calculator-body">
                <div class="row g-4 mb-4">
                    
                    <div class="col-md-4 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-rose small"><i class="fas fa-paint-brush me-2"></i>Your Craft</h6>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Shop Niche / Product</label>
                            <select id="et-niche" class="form-select border-2">
                                <option value="jewelry">Jewelry / Accessories</option>
                                <option value="apparel">Apparel / Vintage Clothing</option>
                                <option value="digital">Digital Planners / Prints</option>
                                <option value="home">Candles / Soaps / Home Decor</option>
                                <option value="wood">Woodworking / Furniture</option>
                                <option value="crochet">Crochet / Knitting / Yarn</option>
                                <option value="stickers">Stickers / Stationery</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Brand Vibe</label>
                            <select id="et-vibe" class="form-select border-2">
                                <option value="boho">Boho / Earthy / Natural</option>
                                <option value="cute">Cute / Kawaii / Pastel</option>
                                <option value="minimal">Minimalist / Clean / Modern</option>
                                <option value="witchy">Witchy / Celestial / Dark</option>
                                <option value="luxury">Luxury / Fine Craftsmanship</option>
                            </select>
                        </div>

                    </div>

                    
                    <div class="col-md-8 ps-md-4 mt-4 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-slate small"><i class="fas fa-heart me-2"></i>Heart of the Brand</h6>
                        
                        <div class="row g-3">
                            <div class="col-12 mb-2">
                                <label class="form-label-custom d-flex justify-content-between">
                                    <span>Brand Format</span>
                                    <span class="badge bg-slate" id="et-length-val">The "X & Y" Style</span>
                                </label>
                                <input type="range" class="form-range custom-range-rose" id="et-length" min="1" max="3" step="1" value="2">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Force a word into the name (e.g., your name, or 'Co').">Anchor Word</label>
                                <input type="text" id="et-include" class="form-control" placeholder="e.g. Luna, Studio, Craft">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Words to avoid.">Exclude Words</label>
                                <input type="text" id="et-exclude" class="form-control border-danger-subtle bg-soft-red" placeholder="e.g. Design, Art, Shop">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="mt-2 pt-4 border-top d-flex flex-wrap gap-3 align-items-center">
                    <button id="gen-btn" class="btn btn-rose px-5 py-3 fw-bold rounded-4 shadow-sm fs-5 text-white">
                        <i class="fas fa-magic me-2"></i> Spawn Shop Names
                    </button>
                    <button class="btn btn-outline-secondary px-4 py-3 fw-bold rounded-4" id="et-clear"><i class="fas fa-broom me-2"></i>Clear</button>
                    
                    <div class="ms-auto border-start ps-3 d-none d-lg-block">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-rose me-1"></i>Presets:</span>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border et-quick" data-p="boho">Boho Jewelry</button>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border et-quick" data-p="witchy">Witchy Candles</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed position-relative" style="--tool-color:#e11d48;--tool-bg:#fff1f2; min-height: 400px; padding-bottom: 8rem;">
            
            <div id="gen-placeholder" class="text-center py-5 d-flex flex-column justify-content-center h-100">
                <div class="opacity-25 mb-4 text-rose"><i class="fas fa-store fa-5x fa-spin-hover"></i></div>
                <h3 class="text-dark fw-black">The Storefront is Empty</h3>
                <p class="text-muted fs-5">Configure your craft and brand vibe above.<br>Your beautiful shop names will appear here.</p>
            </div>

            <div id="gen-results" class="d-none">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3 border-rose-subtle">
                    <h5 class="fw-black m-0 text-dark d-flex align-items-center">
                        <i class="fas fa-star text-rose me-2"></i> Boutique Names
                    </h5>
                    <button class="btn btn-sm btn-dark rounded-pill px-3" id="et-copy-all"><i class="fas fa-copy me-2"></i>Copy All List</button>
                </div>
                
                
                <div id="gen-list" class="row g-3">
                    <!-- Names injected here -->
                </div>
            </div>

            
            <div class="vault-floor shadow-lg">
                <div class="container-fluid px-4 py-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="fw-bold m-0 text-white d-flex align-items-center"><i class="fas fa-heart text-danger me-2"></i> Favorites Box</h6>
                        <span class="small text-white-50" id="vault-count">0 saved names</span>
                    </div>
                    <div id="vault-tags" class="d-flex flex-wrap gap-2 mx-4 overflow-hidden" style="max-height: 40px; flex-grow: 1;">
                        <span class="text-white-50 small fst-italic mt-1" id="vault-empty">Click the heart icon on any name to save it to your box.</span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fw-bold rounded-pill shadow-sm" id="vault-copy"><i class="fas fa-copy text-rose me-1"></i> Copy Box</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    
    <div class="col-lg-12 mt-5">
        <div class="p-5 bg-white rounded-4 border shadow-sm article-content">
            <h3 class="fw-black text-dark mb-4"><i class="fas fa-search text-rose me-2"></i> Finding the Perfect Etsy Name</h3>
            
            <div class="row g-5">
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">Availability is Everything</h5>
                    <p class="text-muted">Etsy strictly forbids duplicate shop names, even if the original shop is closed or inactive. Therefore, finding a perfectly short, one-word name (like "Lumina") is almost impossible today. To get around this, our generator utilizes smart, modern suffixes. Try anchoring your shop around words like <em>LuminaStudio, LuminaCollective, or LuminaDesigns</em>.</p>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">The "Noun & Noun" Trend</h5>
                    <p class="text-muted">A massive trend in modern boutique naming is the "Noun & Noun" format (e.g., <em>Fox & Fern, Sage & Moon, Copper & Thread</em>). This instantly communicates an earthy, handmade, or premium vibe without needing to explicitly say "Jewelry Shop." Simply set the Brand Format slider in the generator to "The X & Y Style" to mass-produce these combinations.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',function(){
    const $ = id => document.getElementById(id);
    const els = {
        btn: $('gen-btn'), clear: $('et-clear'), copyAll: $('et-copy-all'),
        niche: $('et-niche'), vibe: $('et-vibe'),
        length: $('et-length'), inc: $('et-include'), exclude: $('et-exclude'),
        lenVal: $('et-length-val'),
        results: $('gen-results'), list: $('gen-list'), ph: $('gen-placeholder'),
        vaultTags: $('vault-tags'), vaultCount: $('vault-count'), vaultEmpty: $('vault-empty'), vaultCopy: $('vault-copy')
    };

    let vault = new Set();

    els.length.addEventListener('input', function(){
        const v = parseInt(this.value);
        if(v === 1) els.lenVal.textContent = "One Word (Abstract)";
        if(v === 2) els.lenVal.textContent = "The 'X & Y' Style";
        if(v === 3) els.lenVal.textContent = "Descriptive + Suffix";
    });

    els.clear.addEventListener('click', () => {
        els.inc.value = ''; els.exclude.value = '';
        els.length.value = 2; els.lenVal.textContent = "The 'X & Y' Style";
        els.niche.value = 'jewelry'; els.vibe.value = 'boho';
    });

    els.btn.addEventListener('click',function(){
        els.btn.disabled=true;
        els.btn.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Spawning...';
        
        let payload = {
            niche: els.niche.value,
            vibe: els.vibe.value,
            length: els.length.value,
            include: els.inc.value,
            exclude: els.exclude.value
        };

        fetch('<?php echo e(route("ai.generate",["type"=>"etsy-shop-name"])); ?>',{
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>'},
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
                    d.className=`name-chip p-3 d-flex justify-content-between align-items-center bg-white rounded-4 shadow-sm border border-rose-subtle ${isFav ? 'border-rose bg-rose-soft' : ''}`;
                    
                    d.innerHTML=`
                        <div class="flex-grow-1 overflow-hidden pe-2" title="${item}">
                            <h6 class="fw-bold mb-0 text-dark" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">${item}</h6>
                        </div>
                        <div class="d-flex gap-1 flex-shrink-0 opacity-target">
                            <button class="btn btn-sm btn-light rounded-circle chip-btn copy-btn" title="Copy">
                                <i class="fas fa-copy text-secondary"></i>
                            </button>
                            <button class="btn btn-sm btn-light rounded-circle chip-btn fav-btn" title="Save Name">
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
                            d.classList.remove('border-rose', 'bg-rose-soft');
                        } else {
                            vault.add(item);
                            icon.className = 'fas fa-heart text-danger';
                            d.classList.add('border-rose', 'bg-rose-soft');
                        }
                        renderVault();
                    });
                    
                    col.appendChild(d);
                    els.list.appendChild(col);
                });
            }
        }).finally(function(){
            els.btn.disabled=false;
            els.btn.innerHTML='<i class="fas fa-magic me-2"></i>Spawn Shop Names';
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
                            p.classList.remove('border-rose', 'bg-rose-soft');
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
    document.querySelectorAll('.et-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === 'boho') { 
                els.niche.value = 'jewelry'; els.vibe.value = 'boho'; els.length.value = 2; els.lenVal.textContent = "The 'X & Y' Style";
            } else if (p === 'witchy') {
                els.niche.value = 'home'; els.vibe.value = 'witchy'; els.length.value = 3; els.lenVal.textContent = "Descriptive + Suffix";
            }
            els.btn.click();
        });
    });

});
</script>

<style>
.etsy-business-name-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(225,29,72,.05)}
.etsy-business-name-generator-rebuilt .border-rose { border-top: 4px solid #e11d48 !important; }
.etsy-business-name-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.etsy-business-name-generator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.etsy-business-name-generator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.etsy-business-name-generator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.etsy-business-name-generator-rebuilt .form-label-custom{font-size:.7rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}

.text-rose { color: #e11d48 !important; }
.bg-rose-soft { background-color: #fff1f2 !important; }
.border-rose { border-color: #e11d48 !important; }
.border-rose-subtle { border-color: #fecdd3 !important; }

.text-slate { color: #475569 !important; }
.bg-slate { background-color: #475569 !important; }
.border-end-md { border-right: 1px dashed #e2e8f0; }

.btn-rose { background: #e11d48; color: white; border: none; transition: 0.3s cubic-bezier(.4,0,.2,1); }
.btn-rose:hover { background: #be123c; color: white; transform: translateY(0); box-shadow: 0 4px 12px rgba(225,29,72,0.2) !important; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); overflow: hidden;}

/* Custom Range */
.custom-range-rose::-webkit-slider-thumb { background: #e11d48; }
.custom-range-rose::-moz-range-thumb { background: #e11d48; }

/* Interactive Chips */
.name-chip { transition: all 0.2s; cursor: default; }
.name-chip:hover { border-color: #e11d48 !important; }
.opacity-target { opacity: 1; }
.name-chip:hover .opacity-target { opacity: 1; }
.chip-btn { width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; padding: 0; transition: 0.2s; border: 1px solid #e2e8f0; }


/* Vault Floor */
.vault-floor { position: absolute; bottom: 0; left: 0; width: 100%; background: #1e293b; border-top: 4px solid #e11d48; z-index: 100; border-bottom-left-radius: 24px; border-bottom-right-radius: 24px; }
.vault-remove:hover { color: #e11d48 !important; }

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
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\etsy-business-name-generator.blade.php ENDPATH**/ ?>