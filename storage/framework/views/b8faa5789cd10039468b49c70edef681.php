<div class="row g-4 kingdom-name-generator-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-gold">
            

            <div class="calculator-body">
                <div class="row g-4 mb-4">
                    
                    <div class="col-md-4 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-gold small"><i class="fas fa-globe-americas me-2"></i>Foundation</h6>
                        
                        <div class="mb-3">
                            <label class="form-label-custom tooltip-label" title="Influences naming conventions (e.g., 'Peak', 'Sands', 'Vale')">Terrain / Biome</label>
                            <select id="k-terrain" class="form-select border-2">
                                <option value="any">Any / varied</option>
                                <option value="mountain">Mountain / Alpine</option>
                                <option value="forest">Deep Forest / Jungle</option>
                                <option value="desert">Desert / Wasteland</option>
                                <option value="coastal">Coastal / Island</option>
                                <option value="sky">Floating / Sky Realm</option>
                                <option value="underground">Subterranean / Underdark</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Government Structure</label>
                            <select id="k-gov" class="form-select border-2">
                                <option value="kingdom">Kingdom / Monarchy</option>
                                <option value="empire">Empire / Imperial</option>
                                <option value="republic">Republic / Democracy</option>
                                <option value="theocracy">Theocracy (Ruled by Faith)</option>
                                <option value="magocracy">Magocracy (Ruled by Mages)</option>
                                <option value="dictatorship">Dictatorship / Tyranny</option>
                            </select>
                        </div>

                        <div>
                            <label class="form-label-custom">Historical Era / Vibe</label>
                            <select id="k-vibe" class="form-select border-2 bg-light">
                                <option value="prosperous">Prosperous / Golden Age</option>
                                <option value="ancient">Ancient / Forgotten</option>
                                <option value="ruined">Ruined / Post-Apocalyptic</option>
                                <option value="corrupt">Corrupt / Gothic / Dark</option>
                                <option value="scifi">Sci-Fi / Cyber / Futuristic</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-8 ps-md-4 mt-4 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-slate small"><i class="fas fa-language me-2"></i>Advanced Linguistics</h6>
                        
                        <div class="row g-3">
                            <div class="col-12 mb-2">
                                <label class="form-label-custom d-flex justify-content-between">
                                    <span>Title Grandeur (Syllables)</span>
                                    <span class="badge bg-slate" id="k-syllable-val">Majestic (2-3)</span>
                                </label>
                                <input type="range" class="form-range custom-range-gold" id="k-syllables" min="1" max="3" step="1" value="2">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Force the realm to start with this text.">Starts With (Prefix)</label>
                                <input type="text" id="k-prefix" class="form-control" placeholder="e.g. Val, Aeg, Nor">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Force the realm to end with this text.">Ends With (Suffix)</label>
                                <input type="text" id="k-suffix" class="form-control" placeholder="e.g. dor, ia, gard">
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label-custom tooltip-label" title="Words the engine should avoid, e.g. 'King', 'Land'">Exclude Words</label>
                                <input type="text" id="k-exclude" class="form-control border-danger-subtle bg-soft-red" placeholder="e.g. land, ville, kingdom">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="mt-2 pt-4 border-top d-flex flex-wrap gap-3 align-items-center">
                    <button id="gen-btn" class="btn btn-gold px-5 py-3 fw-bold rounded-4 shadow-sm fs-5 text-dark">
                        <i class="fas fa-crown me-2"></i> Forge Realm Names
                    </button>
                    <button class="btn btn-outline-secondary px-4 py-3 fw-bold rounded-4" id="k-clear"><i class="fas fa-broom me-2"></i>Clear</button>
                    
                    <div class="ms-auto border-start ps-3 d-none d-lg-block">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-gold me-1"></i>Worldbuilder Presets:</span>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border k-quick" data-p="dark-empire">The Dark Empire</button>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border k-quick" data-p="elf-woods">Ancient Elven Woods</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed position-relative" style="--tool-color:#d97706;--tool-bg:#fffbeb; min-height: 400px; padding-bottom: 8rem;">
            
            <div id="gen-placeholder" class="text-center py-5 d-flex flex-column justify-content-center h-100">
                <div class="opacity-25 mb-4 text-gold"><i class="fas fa-map fa-5x fa-spin-hover"></i></div>
                <h3 class="text-dark fw-black">The Map is Blank</h3>
                <p class="text-muted fs-5">Configure the geography and government structure above.<br>Your generated realms will appear here.</p>
            </div>

            <div id="gen-results" class="d-none">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3 border-warning-subtle">
                    <h5 class="fw-black m-0 text-dark d-flex align-items-center">
                        <i class="fas fa-flag text-gold me-2"></i> Forged Kingdoms
                    </h5>
                    <button class="btn btn-sm btn-dark rounded-pill px-3" id="k-copy-all"><i class="fas fa-copy me-2"></i>Copy All List</button>
                </div>
                
                
                <div id="gen-list" class="row g-3">
                    <!-- Names injected here -->
                </div>
            </div>

            
            <div class="vault-floor shadow-lg">
                <div class="container-fluid px-4 py-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="fw-bold m-0 text-white d-flex align-items-center"><i class="fas fa-heart text-danger me-2"></i> Realm Vault</h6>
                        <span class="small text-white-50" id="vault-count">0 saved names</span>
                    </div>
                    <div id="vault-tags" class="d-flex flex-wrap gap-2 mx-4 overflow-hidden" style="max-height: 40px; flex-grow: 1;">
                        <span class="text-white-50 small fst-italic mt-1" id="vault-empty">Click the heart icon on any name to save it here.</span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fw-bold rounded-pill shadow-sm" id="vault-copy"><i class="fas fa-copy text-gold me-1"></i> Copy Vault</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    
    <div class="col-lg-12 mt-5">
        <div class="p-5 bg-white rounded-4 border shadow-sm article-content">
            <h3 class="fw-black text-dark mb-4"><i class="fas fa-book-open text-gold me-2"></i> Worldbuilder's Guide to Kingdom Naming</h3>
            
            <div class="row g-5">
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">Suffix Typography</h5>
                    <p class="text-muted">Historically, real-world nations derive their names from distinct linguistic suffixes. Depending on the flavor of your fantasy map, you can use the 'Ends With' filter to force cultural consistency across a continent. For example: <strong>-ia</strong> (Roman styling: <em>Valentia</em>), <strong>-stan</strong> (Persian styling meaning 'land of': <em>Kardistan</em>), or <strong>-dor</strong> (Tolkien Elvish: <em>Gondor</em>).</p>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">The Rule of Hard Consonants</h5>
                    <p class="text-muted">If you are generating a <strong>Dictatorship</strong> or an <strong>Underground/Dwarf</strong> realm, you want names that physically snap or sound harsh when spoken. Force the engine to use hard consonants (K, T, R, G, Z) via the Prefix tool. Examples include <em>Karak, Ghol, or Tzorn</em>. Conversely, for a magical floating sky-city, use soft vowels (A, E, L, S) like <em>Aethel, Selune, or Elyria</em>.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',function(){
    const $ = id => document.getElementById(id);
    const els = {
        btn: $('gen-btn'), clear: $('k-clear'), copyAll: $('k-copy-all'),
        terrain: $('k-terrain'), gov: $('k-gov'), vibe: $('k-vibe'),
        syllables: $('k-syllables'), prefix: $('k-prefix'), suffix: $('k-suffix'), exclude: $('k-exclude'),
        sylVal: $('k-syllable-val'),
        results: $('gen-results'), list: $('gen-list'), ph: $('gen-placeholder'),
        vaultTags: $('vault-tags'), vaultCount: $('vault-count'), vaultEmpty: $('vault-empty'), vaultCopy: $('vault-copy')
    };

    let vault = new Set();

    els.syllables.addEventListener('input', function(){
        const v = parseInt(this.value);
        if(v === 1) els.sylVal.textContent = "Short (1-2)";
        if(v === 2) els.sylVal.textContent = "Majestic (2-3)";
        if(v === 3) els.sylVal.textContent = "Epic (4+)";
    });

    els.clear.addEventListener('click', () => {
        els.prefix.value = ''; els.suffix.value = ''; els.exclude.value = '';
        els.syllables.value = 2; els.sylVal.textContent = "Majestic (2-3)";
        els.terrain.value = 'any'; els.gov.value = 'kingdom'; els.vibe.value = 'prosperous';
    });

    els.btn.addEventListener('click',function(){
        els.btn.disabled=true;
        els.btn.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Forging...';
        
        let payload = {
            terrain: els.terrain.value,
            government: els.gov.value,
            vibe: els.vibe.value,
            syllables: els.syllables.value,
            prefix: els.prefix.value,
            suffix: els.suffix.value,
            exclude: els.exclude.value
        };

        fetch('<?php echo e(route("ai.generate",["type"=>"kingdom-name"])); ?>',{
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
                    d.className=`name-chip p-3 d-flex justify-content-between align-items-center bg-white rounded-4 shadow-sm border border-warning-subtle ${isFav ? 'border-warning bg-gold-soft' : ''}`;
                    
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
                            d.classList.remove('border-warning', 'bg-gold-soft');
                        } else {
                            vault.add(item);
                            icon.className = 'fas fa-heart text-danger';
                            d.classList.add('border-warning', 'bg-gold-soft');
                        }
                        renderVault();
                    });
                    
                    col.appendChild(d);
                    els.list.appendChild(col);
                });
            }
        }).finally(function(){
            els.btn.disabled=false;
            els.btn.innerHTML='<i class="fas fa-crown me-2"></i>Forge Realm Names';
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
                            p.classList.remove('border-warning', 'bg-gold-soft');
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
    document.querySelectorAll('.k-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === 'dark-empire') { 
                els.terrain.value = 'mountain'; els.gov.value = 'empire'; els.vibe.value = 'corrupt'; els.syllables.value = 1; els.sylVal.textContent = "Short (1-2)";
            } else if (p === 'elf-woods') {
                els.terrain.value = 'forest'; els.gov.value = 'magocracy'; els.vibe.value = 'ancient'; els.syllables.value = 3; els.sylVal.textContent = "Epic (4+)";
            }
            els.btn.click();
        });
    });

});
</script>

<style>
.kingdom-name-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(217,119,6,.05)}
.kingdom-name-generator-rebuilt .border-gold { border-top: 4px solid #d97706 !important; }
.kingdom-name-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.kingdom-name-generator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.kingdom-name-generator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.kingdom-name-generator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.kingdom-name-generator-rebuilt .form-label-custom{font-size:.7rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}

.text-gold { color: #d97706 !important; }
.bg-gold-soft { background-color: #fffbeb !important; }
.border-warning { border-color: #fcd34d !important; }

.text-slate { color: #475569 !important; }
.bg-slate { background-color: #475569 !important; }
.border-end-md { border-right: 1px dashed #e2e8f0; }

.btn-gold { background: #f59e0b; color: white; border: none; transition: 0.3s cubic-bezier(.4,0,.2,1); }
.btn-gold:hover { background: #d97706; color: white; transform: translateY(0); box-shadow: 0 4px 12px rgba(217,119,6,0.2) !important; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); overflow: hidden;}

/* Custom Range */
.custom-range-gold::-webkit-slider-thumb { background: #d97706; }
.custom-range-gold::-moz-range-thumb { background: #d97706; }

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
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\kingdom-name-generator.blade.php ENDPATH**/ ?>