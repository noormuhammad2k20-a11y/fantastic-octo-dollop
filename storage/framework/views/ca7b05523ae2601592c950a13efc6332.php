<div class="row g-4 planet-name-generator-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-violet">
            

            <div class="calculator-body">
                <div class="row g-4 mb-4">
                    
                    <div class="col-md-4 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-violet small"><i class="fas fa-satellite me-2"></i>Celestial Class</h6>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Planetary Type</label>
                            <select id="pn-type" class="form-select border-2">
                                <option value="terrestrial">Terrestrial (Earth-like)</option>
                                <option value="gas">Gas Giant (Jovian)</option>
                                <option value="ice">Ice World (Cryogenic)</option>
                                <option value="desert">Desert / Barren</option>
                                <option value="volcanic">Volcanic / Magma</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Atmospheric Viability</label>
                            <select id="pn-vibe" class="form-select border-2">
                                <option value="habitable">Habitable / Thriving</option>
                                <option value="toxic">Toxic / Hostile</option>
                                <option value="dead">Dead / Abandoned</option>
                                <option value="alien">Strange / Unfathomable</option>
                            </select>
                        </div>

                    </div>

                    
                    <div class="col-md-8 ps-md-4 mt-4 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-slate small"><i class="fas fa-space-shuttle me-2"></i>Stellar Registry</h6>
                        
                        <div class="row g-3">
                            <div class="col-12 mb-2">
                                <label class="form-label-custom d-flex justify-content-between">
                                    <span>Nomenclature Style</span>
                                    <span class="badge bg-slate" id="pn-orbit-val">Scientific Alphanumeric</span>
                                </label>
                                <input type="range" class="form-range custom-range-violet" id="pn-orbit" min="1" max="3" step="1" value="2">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Force a specific root word based on alien languages.">Alien Root Syllable</label>
                                <input type="text" id="pn-include" class="form-control" placeholder="e.g. Xar, Vex, Prime">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Words to avoid in the generation.">Exclude Sounds</label>
                                <input type="text" id="pn-exclude" class="form-control border-danger-subtle bg-soft-red" placeholder="e.g. Earth, Sol">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="mt-2 pt-4 border-top d-flex flex-wrap gap-3 align-items-center">
                    <button id="gen-btn" class="btn btn-violet px-5 py-3 fw-bold rounded-4 shadow-sm fs-5 text-white">
                        <i class="fas fa-rocket me-2"></i> Discover Worlds
                    </button>
                    <button class="btn btn-outline-secondary px-4 py-3 fw-bold rounded-4" id="pn-clear"><i class="fas fa-broom me-2"></i>Clear</button>
                    
                    <div class="ms-auto border-start ps-3 d-none d-lg-block">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-meteor text-violet me-1"></i>Presets:</span>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border pn-quick" data-p="earth">Earth-Like</button>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border pn-quick" data-p="death">Hostile World</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed position-relative" style="--tool-color:#8b5cf6;--tool-bg:#f5f3ff; min-height: 400px; padding-bottom: 8rem;">
            
            <div id="gen-placeholder" class="text-center py-5 d-flex flex-column justify-content-center h-100">
                <div class="opacity-25 mb-4 text-violet"><i class="fas fa-satellite-dish fa-5x fa-spin-hover"></i></div>
                <h3 class="text-dark fw-black">No Signal Detected</h3>
                <p class="text-muted fs-5">Configure your planetary scanners above.<br>Your discovered worlds will log here.</p>
            </div>

            <div id="gen-results" class="d-none">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3 border-violet-subtle">
                    <h5 class="fw-black m-0 text-dark d-flex align-items-center">
                        <i class="fas fa-star text-violet me-2"></i> Starmap Log
                    </h5>
                    <button class="btn btn-sm btn-dark rounded-pill px-3" id="pn-copy-all"><i class="fas fa-copy me-2"></i>Copy Galaxy Data</button>
                </div>
                
                
                <div id="gen-list" class="row g-3">
                    <!-- Names injected here -->
                </div>
            </div>

            
            <div class="vault-floor shadow-lg">
                <div class="container-fluid px-4 py-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="fw-bold m-0 text-white d-flex align-items-center"><i class="fas fa-database text-light me-2"></i> Starfleet Registry (Vault)</h6>
                        <span class="small text-white-50" id="vault-count">0 logged worlds</span>
                    </div>
                    <div id="vault-tags" class="d-flex flex-wrap gap-2 mx-4 overflow-hidden" style="max-height: 40px; flex-grow: 1;">
                        <span class="text-white-50 small fst-italic mt-1" id="vault-empty">Click the radar icon to log a planet to your registry.</span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fw-bold rounded-pill shadow-sm" id="vault-copy"><i class="fas fa-copy text-violet me-1"></i> Copy Registry</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    
    <div class="col-lg-12 mt-5">
        <div class="p-5 bg-white rounded-4 border shadow-sm article-content">
            <h3 class="fw-black text-dark mb-4"><i class="fas fa-atom text-violet me-2"></i> Sci-Fi Worldbuilding: Naming Conventions</h3>
            
            <div class="row g-5">
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">Scientific vs Mythological</h5>
                    <p class="text-muted">In science fiction, you find two primary ways to name a planet. <strong>Scientific Nomenclature</strong> usually pairs a constellation or star name with an alphanumeric suffix designating its orbit (e.g., <em>Kepler-186f, LV-426</em>). This implies the planet was discovered by a distant, cold bureaucracy. <strong>Mythological Paternalism</strong> uses ancient earth gods (like Mars, Jupiter) or alien god-concepts (e.g., <em>Arrakis, Coruscant</em>), implying the planet has deep history or native inhabitants.</p>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">Suffix Engineering</h5>
                    <p class="text-muted">The AI engine uses suffix sounds to imply atmospheric traits. Suffixes ending in "-ia" or "-a" (like <em>Pandora, Arcadia</em>) generally sound lush, fertile, and terrestrial. Suffixes ending in harsh consonants like "-ox", "-ix", or "-ar" (like <em>Ragnar, Mygeeto</em>) imply hostile, rocky, or dead environments. Use the <em>Atmospheric Viability</em> dropdown to guide the algorithm.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',function(){
    const $ = id => document.getElementById(id);
    const els = {
        btn: $('gen-btn'), clear: $('pn-clear'), copyAll: $('pn-copy-all'),
        type: $('pn-type'), vibe: $('pn-vibe'),
        orbit: $('pn-orbit'), inc: $('pn-include'), exclude: $('pn-exclude'),
        orbitVal: $('pn-orbit-val'),
        results: $('gen-results'), list: $('gen-list'), ph: $('gen-placeholder'),
        vaultTags: $('vault-tags'), vaultCount: $('vault-count'), vaultEmpty: $('vault-empty'), vaultCopy: $('vault-copy')
    };

    let vault = new Set();

    els.orbit.addEventListener('input', function(){
        const v = parseInt(this.value);
        if(v === 1) els.orbitVal.textContent = "Short Abstract";
        if(v === 2) els.orbitVal.textContent = "Scientific Alphanumeric";
        if(v === 3) els.orbitVal.textContent = "Long / Mythological";
    });

    els.clear.addEventListener('click', () => {
        els.inc.value = ''; els.exclude.value = '';
        els.orbit.value = 2; els.orbitVal.textContent = "Scientific Alphanumeric";
        els.type.value = 'terrestrial'; els.vibe.value = 'habitable';
    });

    els.btn.addEventListener('click',function(){
        els.btn.disabled=true;
        els.btn.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Scanning...';
        
        // Match the backend payload
        let payload = {
            planetType: els.type.value,
            vibe: els.vibe.value,
            orbit: els.orbit.value,
            include: els.inc.value,
            exclude: els.exclude.value
        };

        fetch('<?php echo e(route("ai.generate",["type"=>"planet-name"])); ?>',{
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
                    col.className = 'col-lg-4 col-sm-6';
                    
                    const d=document.createElement('div');
                    const isFav = vault.has(item);
                    d.className=`name-chip p-3 d-flex flex-column justify-content-between bg-white rounded-4 shadow-sm border border-violet-subtle ${isFav ? 'border-violet bg-violet-soft' : ''}`;
                    
                    // Our backend usually returns multiline for planets (Name \n Type \n Desc)
                    // We need to parse it nicely if it has newlines.
                    let parts = item.split('\n');
                    let nameTitle = parts[0] ? parts[0].replace('🪐 ', '') : item;
                    let descHtml = parts.length > 1 ? `<div class="small text-muted mt-2 lh-sm border-top pt-2 opacity-75">${parts.slice(1).join('<br>')}</div>` : '';
                    
                    d.innerHTML=`
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <div class="flex-grow-1 overflow-hidden pe-2" title="${nameTitle}">
                                <h5 class="fw-bold mb-0 text-dark" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;"><i class="fas fa-globe me-1 text-violet opacity-50 small"></i> ${nameTitle}</h5>
                            </div>
                            <div class="d-flex gap-1 flex-shrink-0 opacity-target">
                                <button class="btn btn-sm btn-light rounded-circle chip-btn copy-btn" title="Copy">
                                    <i class="fas fa-copy text-secondary"></i>
                                </button>
                                <button class="btn btn-sm btn-light rounded-circle chip-btn fav-btn" title="Log to Registry">
                                    <i class="fas fa-${isFav ? 'check' : 'satellite-dish'} text-${isFav ? 'violet' : 'secondary'}"></i>
                                </button>
                            </div>
                        </div>
                        ${descHtml}
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
                            icon.className = 'fas fa-satellite-dish text-secondary';
                            d.classList.remove('border-violet', 'bg-violet-soft');
                        } else {
                            vault.add(item);
                            icon.className = 'fas fa-check text-violet';
                            d.classList.add('border-violet', 'bg-violet-soft');
                        }
                        renderVault();
                    });
                    
                    col.appendChild(d);
                    els.list.appendChild(col);
                });
            }
        }).finally(function(){
            els.btn.disabled=false;
            els.btn.innerHTML='<i class="fas fa-rocket me-2"></i>Discover Worlds';
        });
    });

    function renderVault() {
        els.vaultTags.innerHTML = '';
        els.vaultCount.textContent = `${vault.size} logged worlds`;
        if (vault.size === 0) {
            els.vaultEmpty.classList.remove('d-none');
        } else {
            els.vaultEmpty.classList.add('d-none');
            vault.forEach(name => {
                let shortName = name.split('\n')[0].replace('🪐 ', '');
                const tag = document.createElement('span');
                tag.className = 'badge bg-white text-dark border shadow-sm d-flex align-items-center py-2 px-3 fw-bold';
                tag.innerHTML = `${shortName} <i class="fas fa-times text-muted ms-2 px-1 vault-remove" style="cursor:pointer;" data-full="${btoa(unescape(encodeURIComponent(name)))}"></i>`;
                
                tag.querySelector('.vault-remove').addEventListener('click', function(){
                    let rawName = decodeURIComponent(escape(atob(this.dataset.full)));
                    vault.delete(rawName);
                    renderVault();
                    // trigger resync on visually matched cards
                    document.querySelectorAll('.name-chip').forEach(d => {
                        let hTitle = d.querySelector('h5').innerText.trim();
                        let tTitle = rawName.split('\n')[0].replace('🪐 ', '').trim();
                        if(hTitle === tTitle) {
                            d.classList.remove('border-violet', 'bg-violet-soft');
                            d.querySelector('.fav-btn i').className = 'fas fa-satellite-dish text-secondary';
                        }
                    });
                });

                els.vaultTags.appendChild(tag);
            });
        }
    }

    els.vaultCopy.addEventListener('click', function(){
        if(vault.size === 0) return;
        navigator.clipboard.writeText(Array.from(vault).join('\n\n')).then(()=>{
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check text-success me-1"></i> Copied!';
            setTimeout(()=>{this.innerHTML = o;}, 2000);
        });
    });

    els.copyAll.addEventListener('click', function(){
        // the button now reads actual vault? No, it reads all names in dom.
        // Wait, the DOM text contains desc if we just take innerText. Let's rebuild cleanly from data.
        // We didn't save the raw list to a variable in this example, so we'll just extract from DOM.
        let allNames = [];
        document.querySelectorAll('.name-chip').forEach(h => {
             // For planets, take all inner text with newlines
             let title = h.querySelector('h5').innerText;
             let body = h.querySelector('.text-muted') ? h.querySelector('.text-muted').innerText : '';
             allNames.push(title + (body ? '\n' + body : ''));
        });
        if(allNames.length === 0) return;
        navigator.clipboard.writeText(allNames.join('\n\n')).then(()=>{
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>{this.innerHTML = o;}, 2000);
        });
    });

    // Presets
    document.querySelectorAll('.pn-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === 'earth') { 
                els.type.value = 'terrestrial'; els.vibe.value = 'habitable'; els.orbit.value = 3; els.orbitVal.textContent = "Long / Mythological";
            } else if (p === 'death') {
                els.type.value = 'volcanic'; els.vibe.value = 'hostile'; els.orbit.value = 2; els.orbitVal.textContent = "Scientific Alphanumeric";
            }
            els.btn.click();
        });
    });

});
</script>

<style>
.planet-name-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(139,92,246,.05)}
.planet-name-generator-rebuilt .border-violet { border-top: 4px solid #8b5cf6 !important; }
.planet-name-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.planet-name-generator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.planet-name-generator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.planet-name-generator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.planet-name-generator-rebuilt .form-label-custom{font-size:.7rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}

.text-violet { color: #8b5cf6 !important; }
.bg-violet-soft { background-color: #f5f3ff !important; }
.border-violet { border-color: #8b5cf6 !important; }
.border-violet-subtle { border-color: #ddd6fe !important; }

.text-slate { color: #475569 !important; }
.bg-slate { background-color: #475569 !important; }
.border-end-md { border-right: 1px dashed #e2e8f0; }

.btn-violet { background: #8b5cf6; color: white; border: none; transition: 0.3s cubic-bezier(.4,0,.2,1); }
.btn-violet:hover { background: #7c3aed; color: white; transform: translateY(0); box-shadow: 0 4px 12px rgba(139,92,246,0.2) !important; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); overflow: hidden;}

/* Custom Range */
.custom-range-violet::-webkit-slider-thumb { background: #8b5cf6; }
.custom-range-violet::-moz-range-thumb { background: #8b5cf6; }

/* Interactive Chips */
.name-chip { transition: all 0.2s; cursor: default; }
.name-chip:hover { border-color: #e11d48 !important; }
.opacity-target { opacity: 1; }
.name-chip:hover .opacity-target { opacity: 1; }
.chip-btn { width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; padding: 0; transition: 0.2s; border: 1px solid #e2e8f0; }


/* Vault Floor */
.vault-floor { position: absolute; bottom: 0; left: 0; width: 100%; background: #0f172a; border-top: 4px solid #8b5cf6; z-index: 100; border-bottom-left-radius: 24px; border-bottom-right-radius: 24px; }
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
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\planet-name-generator.blade.php ENDPATH**/ ?>