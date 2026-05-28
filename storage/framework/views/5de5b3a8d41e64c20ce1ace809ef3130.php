<div class="row g-4 art-business-name-generator-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-indigo">
            

            <div class="calculator-body">
                <div class="row g-4 mb-4">
                    
                    <div class="col-md-4 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-indigo small"><i class="fas fa-brush me-2"></i>The Medium</h6>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Creative Medium</label>
                            <select id="a-niche" class="form-select border-2">
                                <option value="fine-art">Fine Art / Painting Gallery</option>
                                <option value="photography">Photography Studio</option>
                                <option value="design">Graphic Design / Agency</option>
                                <option value="pottery">Pottery / Ceramics Workshop</option>
                                <option value="tattoo">Tattoo Parlor / Body Art</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Aesthetic Vibe</label>
                            <select id="a-vibe" class="form-select border-2">
                                <option value="modern">Avant-Garde / Modern</option>
                                <option value="classic">Classic / Renaissance / Fine</option>
                                <option value="minimalist">Minimalist / Clean Studio</option>
                                <option value="urban">Urban / Street / Edgy</option>
                            </select>
                        </div>

                    </div>

                    
                    <div class="col-md-8 ps-md-4 mt-4 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-slate small"><i class="fas fa-language me-2"></i>Brand Architecture</h6>
                        
                        <div class="row g-3">
                            <div class="col-12 mb-2">
                                <label class="form-label-custom d-flex justify-content-between">
                                    <span>Brand Style</span>
                                    <span class="badge bg-slate" id="a-length-val">Descriptive (2 Words)</span>
                                </label>
                                <input type="range" class="form-range custom-range-indigo" id="a-length" min="1" max="3" step="1" value="2">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Must include this word.">Signature Word / Name</label>
                                <input type="text" id="a-include" class="form-control" placeholder="e.g. Canvas, Ink, Studio">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Words the engine should avoid.">Exclude Words</label>
                                <input type="text" id="a-exclude" class="form-control border-danger-subtle bg-soft-red" placeholder="e.g. Art, Pictures, Designs">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="mt-2 pt-4 border-top d-flex flex-wrap gap-3 align-items-center">
                    <button id="gen-btn" class="btn btn-indigo px-5 py-3 fw-bold rounded-4 shadow-sm fs-5 text-white">
                        <i class="fas fa-paint-roller me-2"></i> Paint Canvas
                    </button>
                    <button class="btn btn-outline-secondary px-4 py-3 fw-bold rounded-4" id="a-clear"><i class="fas fa-broom me-2"></i>Clear</button>
                    
                    <div class="ms-auto border-start ps-3 d-none d-lg-block">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-indigo me-1"></i>Presets:</span>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border a-quick" data-p="photo">Minimalist Photo Studio</button>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border a-quick" data-p="tattoo">Urban Tattoo Parlor</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed position-relative" style="--tool-color:#4f46e5;--tool-bg:#eef2ff; min-height: 400px; padding-bottom: 8rem;">
            
            <div id="gen-placeholder" class="text-center py-5 d-flex flex-column justify-content-center h-100">
                <div class="opacity-25 mb-4 text-indigo"><i class="fas fa-fill-drip fa-5x fa-spin-hover"></i></div>
                <h3 class="text-dark fw-black">The Canvas is Blank</h3>
                <p class="text-muted fs-5">Configure your medium and aesthetic above.<br>Your generated studio names will appear here.</p>
            </div>

            <div id="gen-results" class="d-none">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3 border-indigo-subtle">
                    <h5 class="fw-black m-0 text-dark d-flex align-items-center">
                        <i class="fas fa-palette text-indigo me-2"></i> Visionary Brands
                    </h5>
                    <button class="btn btn-sm btn-dark rounded-pill px-3" id="a-copy-all"><i class="fas fa-copy me-2"></i>Copy All List</button>
                </div>
                
                
                <div id="gen-list" class="row g-3">
                    <!-- Names injected here -->
                </div>
            </div>

            
            <div class="vault-floor shadow-lg">
                <div class="container-fluid px-4 py-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="fw-bold m-0 text-white d-flex align-items-center"><i class="fas fa-heart text-danger me-2"></i> Exhibition (Vault)</h6>
                        <span class="small text-white-50" id="vault-count">0 saved names</span>
                    </div>
                    <div id="vault-tags" class="d-flex flex-wrap gap-2 mx-4 overflow-hidden" style="max-height: 40px; flex-grow: 1;">
                        <span class="text-white-50 small fst-italic mt-1" id="vault-empty">Click the heart icon on any name to save it to your exhibition.</span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fw-bold rounded-pill shadow-sm" id="vault-copy"><i class="fas fa-copy text-indigo me-1"></i> Copy Exhibition</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    
    <div class="col-lg-12 mt-5">
        <div class="p-5 bg-white rounded-4 border shadow-sm article-content">
            <h3 class="fw-black text-dark mb-4"><i class="fas fa-cube text-indigo me-2"></i> The Architect of Art Brands</h3>
            
            <div class="row g-5">
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">Minimalism vs Descriptive</h5>
                    <p class="text-muted">In the modern art world, less is often more. High-end galleries and design agencies frequently use single-word abstract nouns (e.g., <em>Aura, Canvas, Shift</em>) or simply the founder's last name followed by "Studio". Set the Brand Style slider to "One Word" to generate these punchy, memorable, and highly-brandable tags.</p>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">The "Exclude Words" Filter</h5>
                    <p class="text-muted">If you are opening an agency, you might want to avoid sounding cliché. By tossing words like <em>Design, Creative, Group, or Media</em> into the Exclude filter, you force the AI to combine unexpected nouns and adjectives. This results in brands that sound poetic and stand out instantly in a crowded market.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',function(){
    const $ = id => document.getElementById(id);
    const els = {
        btn: $('gen-btn'), clear: $('a-clear'), copyAll: $('a-copy-all'),
        niche: $('a-niche'), vibe: $('a-vibe'),
        length: $('a-length'), inc: $('a-include'), exclude: $('a-exclude'),
        lenVal: $('a-length-val'),
        results: $('gen-results'), list: $('gen-list'), ph: $('gen-placeholder'),
        vaultTags: $('vault-tags'), vaultCount: $('vault-count'), vaultEmpty: $('vault-empty'), vaultCopy: $('vault-copy')
    };

    let vault = new Set();

    els.length.addEventListener('input', function(){
        const v = parseInt(this.value);
        if(v === 1) els.lenVal.textContent = "One Word (Abstract)";
        if(v === 2) els.lenVal.textContent = "Descriptive (2 Words)";
        if(v === 3) els.lenVal.textContent = "Full Title / Agency";
    });

    els.clear.addEventListener('click', () => {
        els.inc.value = ''; els.exclude.value = '';
        els.length.value = 2; els.lenVal.textContent = "Descriptive (2 Words)";
        els.niche.value = 'fine-art'; els.vibe.value = 'modern';
    });

    els.btn.addEventListener('click',function(){
        els.btn.disabled=true;
        els.btn.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Painting Canvas...';
        
        let payload = {
            niche: els.niche.value,
            vibe: els.vibe.value,
            length: els.length.value,
            include: els.inc.value,
            exclude: els.exclude.value
        };

        fetch('<?php echo e(route("ai.generate",["type"=>"art-business-name"])); ?>',{
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
                    d.className=`name-chip p-3 d-flex justify-content-between align-items-center bg-white rounded-4 shadow-sm border border-indigo-subtle ${isFav ? 'border-indigo bg-indigo-soft' : ''}`;
                    
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
                            d.classList.remove('border-indigo', 'bg-indigo-soft');
                        } else {
                            vault.add(item);
                            icon.className = 'fas fa-heart text-danger';
                            d.classList.add('border-indigo', 'bg-indigo-soft');
                        }
                        renderVault();
                    });
                    
                    col.appendChild(d);
                    els.list.appendChild(col);
                });
            }
        }).finally(function(){
            els.btn.disabled=false;
            els.btn.innerHTML='<i class="fas fa-paint-roller me-2"></i>Paint Canvas';
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
                            p.classList.remove('border-indigo', 'bg-indigo-soft');
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
    document.querySelectorAll('.a-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === 'photo') { 
                els.niche.value = 'photography'; els.vibe.value = 'minimalist'; els.length.value = 1; els.lenVal.textContent = "One Word (Abstract)";
            } else if (p === 'tattoo') {
                els.niche.value = 'tattoo'; els.vibe.value = 'urban'; els.length.value = 2; els.lenVal.textContent = "Descriptive (2 Words)";
            }
            els.btn.click();
        });
    });

});
</script>

<style>
.art-business-name-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(79,70,229,.05)}
.art-business-name-generator-rebuilt .border-indigo { border-top: 4px solid #4f46e5 !important; }
.art-business-name-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.art-business-name-generator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.art-business-name-generator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.art-business-name-generator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.art-business-name-generator-rebuilt .form-label-custom{font-size:.7rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}

.text-indigo { color: #4f46e5 !important; }
.bg-indigo-soft { background-color: #eef2ff !important; }
.border-indigo { border-color: #4f46e5 !important; }
.border-indigo-subtle { border-color: #c7d2fe !important; }

.text-slate { color: #475569 !important; }
.bg-slate { background-color: #475569 !important; }
.border-end-md { border-right: 1px dashed #e2e8f0; }

.btn-indigo { background: #4f46e5; color: white; border: none; transition: 0.3s cubic-bezier(.4,0,.2,1); }
.btn-indigo:hover { background: #4338ca; color: white; transform: translateY(0); box-shadow: 0 4px 12px rgba(79,70,229,0.2) !important; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); overflow: hidden;}

/* Custom Range */
.custom-range-indigo::-webkit-slider-thumb { background: #4f46e5; }
.custom-range-indigo::-moz-range-thumb { background: #4f46e5; }

/* Interactive Chips */
.name-chip { transition: all 0.2s; cursor: default; }
.name-chip:hover { border-color: #e11d48 !important; }
.opacity-target { opacity: 1; }
.name-chip:hover .opacity-target { opacity: 1; }
.chip-btn { width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; padding: 0; transition: 0.2s; border: 1px solid #e2e8f0; }


/* Vault Floor */
.vault-floor { position: absolute; bottom: 0; left: 0; width: 100%; background: #1e293b; border-top: 4px solid #4f46e5; z-index: 100; border-bottom-left-radius: 24px; border-bottom-right-radius: 24px; }
.vault-remove:hover { color: #4f46e5 !important; }

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
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\art-business-name-generator.blade.php ENDPATH**/ ?>