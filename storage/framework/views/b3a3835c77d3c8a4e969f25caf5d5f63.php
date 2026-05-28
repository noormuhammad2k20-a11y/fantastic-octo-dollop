<div class="row g-4 team-name-generator-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-orange">
            

            <div class="calculator-body">
                <div class="row g-4 mb-4">
                    
                    <div class="col-md-4 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-orange small"><i class="fas fa-basketball-ball me-2"></i>Franchise Identity</h6>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">League / Category</label>
                            <select id="tn-category" class="form-select border-2">
                                <option value="sports">Traditional Sports (Pro League)</option>
                                <option value="esports">Esports & Gaming</option>
                                <option value="fantasy">Fantasy Football / Leagues</option>
                                <option value="casual">Casual / Rec League</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Franchise Vibe</label>
                            <select id="tn-vibe" class="form-select border-2">
                                <option value="powerful">Powerful / Aggressive</option>
                                <option value="stealth">Stealthy / Assassins</option>
                                <option value="mythic">Mythological / Ancient</option>
                                <option value="funny">Funny / Pun-Based</option>
                            </select>
                        </div>

                    </div>

                    
                    <div class="col-md-8 ps-md-4 mt-4 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-slate small"><i class="fas fa-map-marker-alt me-2"></i>Localization</h6>
                        
                        <div class="row g-3">
                            <div class="col-12 mb-2">
                                <label class="form-label-custom d-flex justify-content-between">
                                    <span>Brand Format</span>
                                    <span class="badge bg-slate" id="tn-format-val">City + Mascot</span>
                                </label>
                                <input type="range" class="form-range custom-range-orange" id="tn-format" min="1" max="3" step="1" value="2">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Your city or region name.">Geographic Prefix</label>
                                <input type="text" id="tn-include" class="form-control" placeholder="e.g. Chicago, London, Eastside">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Words to avoid in the generation.">Exclude Mascot</label>
                                <input type="text" id="tn-exclude" class="form-control border-danger-subtle bg-soft-red" placeholder="e.g. Eagles, Tigers">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="mt-2 pt-4 border-top d-flex flex-wrap gap-3 align-items-center">
                    <button id="gen-btn" class="btn btn-orange px-5 py-3 fw-bold rounded-4 shadow-sm fs-5 text-white">
                        <i class="fas fa-shield-alt me-2"></i> Draft Team Names
                    </button>
                    <button class="btn btn-outline-secondary px-4 py-3 fw-bold rounded-4" id="tn-clear" style="min-width: 280px; max-width: 100%;"><i class="fas fa-broom me-2"></i>Clear</button>
                    
                    <div class="ms-auto border-start ps-3 d-none d-lg-block">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-gamepad text-orange me-1"></i>Presets:</span>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border tn-quick" data-p="esports">Pro Esports</button>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border tn-quick" data-p="mythic">Mythic Sports</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed position-relative" style="--tool-color:#f97316;--tool-bg:#fff7ed; min-height: 400px; padding-bottom: 8rem;">
            
            <div id="gen-placeholder" class="text-center py-5 d-flex flex-column justify-content-center h-100">
                <div class="opacity-25 mb-4 text-orange"><i class="fas fa-flag fa-5x fa-spin-hover"></i></div>
                <h3 class="text-dark fw-black">The Locker Room is Empty</h3>
                <p class="text-muted fs-5">Configure your league category and vibe above.<br>Your drafted team names will appear here.</p>
            </div>

            <div id="gen-results" class="d-none">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3 border-orange-subtle">
                    <h5 class="fw-black m-0 text-dark d-flex align-items-center">
                        <i class="fas fa-medal text-orange me-2"></i> Draft Results
                    </h5>
                    <button class="btn btn-sm btn-dark rounded-pill px-3" id="tn-copy-all" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Draft Board</button>
                </div>
                
                
                <div id="gen-list" class="row g-3">
                    <!-- Names injected here -->
                </div>
            </div>

            
            <div class="vault-floor shadow-lg">
                <div class="container-fluid px-4 py-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="fw-bold m-0 text-white d-flex align-items-center"><i class="fas fa-clipboard-list text-light me-2"></i> Active Roster (Vault)</h6>
                        <span class="small text-white-50" id="vault-count">0 saved names</span>
                    </div>
                    <div id="vault-tags" class="d-flex flex-wrap gap-2 mx-4 overflow-hidden" style="max-height: 40px; flex-grow: 1;">
                        <span class="text-white-50 small fst-italic mt-1" id="vault-empty">Click the plus icon on any name to sign them to your active roster.</span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fw-bold rounded-pill shadow-sm" id="vault-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy text-orange me-1"></i> Copy Roster</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    
    <div class="col-lg-12 mt-5">
        <div class="p-5 bg-white rounded-4 border shadow-sm article-content">
            <h3 class="fw-black text-dark mb-4"><i class="fas fa-bullhorn text-orange me-2"></i> The Psychology of Franchise Naming</h3>
            
            <div class="row g-5">
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">Traditional Sports vs. Esports</h5>
                    <p class="text-muted">In traditional physical sports, the dominant formula has always been <strong>Location + Plural Mascot</strong> (e.g., <em>Chicago Bulls</em>). However, in digital arenas like Esports, franchises prioritize aggressive, single-word abstract nouns or mythological concepts that sound like powerful weapons or factions (e.g., <em>FaZe, Team Liquid, TSM</em>). Use the 'Geographic Prefix' to immediately anchor a team to a city, or leave it blank for an international esports feel.</p>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">Intimidation Factor</h5>
                    <p class="text-muted">The best team names utilize "plosive" consonants (P, B, T, D, K, G) which subconsciously sound harder and more aggressive to the human ear. A team named "The Titans" inherently sounds more difficult to defeat than a team named "The Swishers". Use our "Powerful/Aggressive" vibe to lean heavily into these hard-sounding linguistic patterns.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',function(){
    const $ = id => document.getElementById(id);
    const els = {
        btn: $('gen-btn'), clear: $('tn-clear'), copyAll: $('tn-copy-all'),
        category: $('tn-category'), vibe: $('tn-vibe'),
        format: $('tn-format'), inc: $('tn-include'), exclude: $('tn-exclude'),
        formatVal: $('tn-format-val'),
        results: $('gen-results'), list: $('gen-list'), ph: $('gen-placeholder'),
        vaultTags: $('vault-tags'), vaultCount: $('vault-count'), vaultEmpty: $('vault-empty'), vaultCopy: $('vault-copy')
    };

    let vault = new Set();

    els.format.addEventListener('input', function(){
        const v = parseInt(this.value);
        if(v === 1) els.formatVal.textContent = "Single Abstract Noun";
        if(v === 2) els.formatVal.textContent = "City + Mascot";
        if(v === 3) els.formatVal.textContent = "Three-Word Phrase";
    });

    els.clear.addEventListener('click', () => {
        els.inc.value = ''; els.exclude.value = '';
        els.format.value = 2; els.formatVal.textContent = "City + Mascot";
        els.category.value = 'sports'; els.vibe.value = 'powerful';
    });

    els.btn.addEventListener('click',function(){
        els.btn.disabled=true;
        els.btn.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Drafting...';
        
        // Add the geographic prefix into the include so the backend respects it 
        // (if it wasn't already handled by the 'include' matching in backend)
        let payload = {
            category: els.category.value,
            vibe: els.vibe.value,
            format: els.format.value,
            include: els.inc.value,
            exclude: els.exclude.value
        };

        fetch('<?php echo e(route("ai.generate",["type"=>"team-name"])); ?>',{
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
                    d.className=`name-chip p-3 d-flex justify-content-between align-items-center bg-white rounded-4 shadow-sm border border-orange-subtle ${isFav ? 'border-primary bg-orange-soft' : ''}`;
                    
                    // Prepend the geographic location if provided
                    const geo = els.inc.value.trim();
                    const finalItem = geo ? `${geo} ${item}` : item;
                    
                    d.innerHTML=`
                        <div class="flex-grow-1 overflow-hidden pe-2" title="${finalItem}">
                            <h6 class="fw-bold mb-0 text-dark" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">${finalItem}</h6>
                        </div>
                        <div class="d-flex gap-1 flex-shrink-0 opacity-target">
                            <button class="btn btn-sm btn-light rounded-circle chip-btn copy-btn" title="Copy">
                                <i class="fas fa-copy text-secondary"></i>
                            </button>
                            <button class="btn btn-sm btn-light rounded-circle chip-btn fav-btn" title="Sign to Roster">
                                <i class="fas fa-${isFav ? 'check' : 'plus'} text-${isFav ? 'primary' : 'secondary'}"></i>
                            </button>
                        </div>
                    `;
                    
                    d.querySelector('.copy-btn').addEventListener('click',function(){
                        navigator.clipboard.writeText(finalItem).then(function(){
                            const icon = d.querySelector('.copy-btn i');
                            icon.className = 'fas fa-check text-success';
                            setTimeout(function(){icon.className = 'fas fa-copy text-secondary';}, 2000);
                        });
                    });

                    d.querySelector('.fav-btn').addEventListener('click',function(){
                        const icon = this.querySelector('i');
                        if(vault.has(finalItem)) {
                            vault.delete(finalItem);
                            icon.className = 'fas fa-plus text-secondary';
                            d.classList.remove('border-primary', 'bg-orange-soft');
                        } else {
                            vault.add(finalItem);
                            icon.className = 'fas fa-check text-primary';
                            d.classList.add('border-primary', 'bg-orange-soft');
                        }
                        renderVault();
                    });
                    
                    col.appendChild(d);
                    els.list.appendChild(col);
                });
            }
        }).finally(function(){
            els.btn.disabled=false;
            els.btn.innerHTML='<i class="fas fa-shield-alt me-2"></i>Draft Team Names';
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
                            p.classList.remove('border-primary', 'bg-orange-soft');
                            p.querySelector('.fav-btn i').className = 'fas fa-plus text-secondary';
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
    document.querySelectorAll('.tn-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === 'esports') { 
                els.category.value = 'esports'; els.vibe.value = 'stealth'; els.format.value = 1; els.formatVal.textContent = "Single Abstract Noun"; els.inc.value = '';
            } else if (p === 'mythic') {
                els.category.value = 'sports'; els.vibe.value = 'mythic'; els.format.value = 2; els.formatVal.textContent = "City + Mascot"; els.inc.value = 'Olympus';
            }
            els.btn.click();
        });
    });

});
</script>

<style>
.team-name-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(249,115,22,.05)}
.team-name-generator-rebuilt .border-orange { border-top: 4px solid #f97316 !important; }
.team-name-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.team-name-generator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.team-name-generator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.team-name-generator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.team-name-generator-rebuilt .form-label-custom{font-size:.7rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}

.text-orange { color: #f97316 !important; }
.bg-orange-soft { background-color: #fff7ed !important; }
.border-orange { border-color: #f97316 !important; }
.border-orange-subtle { border-color: #fdba74 !important; }

.text-slate { color: #475569 !important; }
.bg-slate { background-color: #475569 !important; }
.border-end-md { border-right: 1px dashed #e2e8f0; }

.btn-orange { background: #f97316; color: white; border: none; transition: 0.3s cubic-bezier(.4,0,.2,1); }
.btn-orange:hover { background: #ea580c; color: white; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(249,115,22,0.2) !important; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); overflow: hidden;}

/* Custom Range */
.custom-range-orange::-webkit-slider-thumb { background: #f97316; }
.custom-range-orange::-moz-range-thumb { background: #f97316; }

/* Interactive Chips */
.name-chip { transition: all 0.2s; cursor: default; }
.name-chip:hover { border-color: #f97316 !important; transform: translateY(-2px); box-shadow: 0 6px 16px rgba(249,115,22,0.06) !important; }
.opacity-target { opacity: 0; transition: 0.2s; }
.name-chip:hover .opacity-target { opacity: 1; }
.chip-btn { width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; padding: 0; transition: 0.2s; border: 1px solid #e2e8f0; }
.chip-btn:hover { background: #fff7ed; border-color: #fdba74; }

/* Vault Floor */
.vault-floor { position: absolute; bottom: 0; left: 0; width: 100%; background: #0f172a; border-top: 4px solid #f97316; z-index: 100; border-bottom-left-radius: 24px; border-bottom-right-radius: 24px; }
.vault-remove:hover { color: #f97316 !important; }

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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\team-name-generator.blade.php ENDPATH**/ ?>