<div class="row g-4 anime-girl-name-generator-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-fuchsia">
            

            <div class="calculator-body">
                <div class="row g-4 mb-4">
                    {{-- Core Niche --}}
                    <div class="col-md-4 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-fuchsia small"><i class="fas fa-heart me-2"></i>Character Soul</h6>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Personality (Dere Type)</label>
                            <select id="ag-personality" class="form-select border-2">
                                <option value="sweet">Sweet & Pure (Deredere)</option>
                                <option value="tsundere">Fiery & Aloof (Tsundere)</option>
                                <option value="mysterious">Quiet & Mysterious (Kuudere)</option>
                                <option value="wild">Wild & Energetic (Genki)</option>
                                <option value="warrior">Strong / Warrior (Kamidere)</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Setting Style</label>
                            <select id="ag-style" class="form-select border-2">
                                <option value="modern">Modern School Life</option>
                                <option value="fantasy">Isekai / Fantasy</option>
                                <option value="scifi">Mecha / Cyberpunk</option>
                            </select>
                        </div>

                    </div>

                    {{-- Advanced Linguistics --}}
                    <div class="col-md-8 ps-md-4 mt-4 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-slate small"><i class="fas fa-language me-2"></i>Kanji Engineering</h6>
                        
                        <div class="row g-3">
                            <div class="col-12 mb-2">
                                <label class="form-label-custom d-flex justify-content-between">
                                    <span>Name Length (Syllables)</span>
                                    <span class="badge bg-slate" id="ag-syllable-val">Melodic (3)</span>
                                </label>
                                <input type="range" class="form-range custom-range-fuchsia" id="ag-syllables" min="2" max="4" step="1" value="3">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Force a specific elemental meaning.">Elemental Meaning</label>
                                <input type="text" id="ag-include" class="form-control" placeholder="e.g. Flower, Moon, Light">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Words to avoid in meaning.">Exclude Meaning</label>
                                <input type="text" id="ag-exclude" class="form-control border-danger-subtle bg-soft-red" placeholder="e.g. Dark, Sad">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-2 pt-4 border-top d-flex flex-wrap gap-3 align-items-center">
                    <button id="gen-btn" class="btn btn-fuchsia px-5 py-3 fw-bold rounded-4 shadow-sm fs-5 text-white">
                        <i class="fas fa-star me-2"></i> Summon Heroines
                    </button>
                    <button class="btn btn-outline-secondary px-4 py-3 fw-bold rounded-4" id="ag-clear"><i class="fas fa-broom me-2"></i>Clear</button>
                    
                    <div class="ms-auto border-start ps-3 d-none d-lg-block">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-fuchsia me-1"></i>Tropes:</span>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border ag-quick" data-p="magical">Magical Girl</button>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border ag-quick" data-p="kuudere">Quiet Kuudere</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed position-relative" style="--tool-color:#d946ef;--tool-bg:#fdf4ff; min-height: 400px; padding-bottom: 8rem;">
            
            <div id="gen-placeholder" class="text-center py-5 d-flex flex-column justify-content-center h-100">
                <div class="opacity-25 mb-4 text-fuchsia"><i class="fas fa-wand-magic-sparkles fa-5x fa-spin-hover"></i></div>
                <h3 class="text-dark fw-black">The Stage is Empty</h3>
                <p class="text-muted fs-5">Configure your heroine's personality above.<br>Your summoned characters will appear here.</p>
            </div>

            <div id="gen-results" class="d-none">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3 border-fuchsia-subtle">
                    <h5 class="fw-black m-0 text-dark d-flex align-items-center">
                        <i class="fas fa-gem text-fuchsia me-2"></i> Summoned Cast
                    </h5>
                    <button class="btn btn-sm btn-dark rounded-pill px-3" id="ag-copy-all"><i class="fas fa-copy me-2"></i>Copy All List</button>
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
                        <h6 class="fw-bold m-0 text-white d-flex align-items-center"><i class="fas fa-heart text-danger me-2"></i> Cast Roster (Vault)</h6>
                        <span class="small text-white-50" id="vault-count">0 saved names</span>
                    </div>
                    <div id="vault-tags" class="d-flex flex-wrap gap-2 mx-4 overflow-hidden" style="max-height: 40px; flex-grow: 1;">
                        <span class="text-white-50 small fst-italic mt-1" id="vault-empty">Click the heart icon on any name to save it to your roster.</span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fw-bold rounded-pill shadow-sm" id="vault-copy"><i class="fas fa-copy text-fuchsia me-1"></i> Copy Roster</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    {{-- ═══════ SEO & EDUCATIONAL SECTION ═══════ --}}
    <div class="col-lg-12 mt-5">
        <div class="p-5 bg-white rounded-4 border shadow-sm article-content">
            <h3 class="fw-black text-dark mb-4"><i class="fas fa-book-open text-fuchsia me-2"></i> Finding the Perfect Heroine Name</h3>
            
            <div class="row g-5">
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">Translating the 'Dere'</h5>
                    <p class="text-muted">In Japanese pop-culture, a character's archetype (their "Dere" type) strongly influences their naming conventions. A <em>Tsundere</em> (fiery/aloof) might have a sharper name containing Kanji for fire or thorns (e.g. Asuka). A <em>Kuudere</em> (quiet/emotionless) often features nature or atmospheric Kanji like Snow (Yuki) or Water (Rei).</p>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">Kanji Reading Syllables</h5>
                    <p class="text-muted">While English names can be long, most traditional Japanese first names range from 2 to 4 syllables. A short 2-syllable name (like <em>Rin</em> or <em>Mei</em>) implies a modern or blunt personality. A longer 4-syllable name implies elegance, tradition, or royalty. Use the length slider to precisely tune the pacing of your character's name.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',function(){
    const $ = id => document.getElementById(id);
    const els = {
        btn: $('gen-btn'), clear: $('ag-clear'), copyAll: $('ag-copy-all'),
        personality: $('ag-personality'), style: $('ag-style'),
        syllables: $('ag-syllables'), inc: $('ag-include'), exclude: $('ag-exclude'),
        sylVal: $('ag-syllable-val'),
        results: $('gen-results'), list: $('gen-list'), ph: $('gen-placeholder'),
        vaultTags: $('vault-tags'), vaultCount: $('vault-count'), vaultEmpty: $('vault-empty'), vaultCopy: $('vault-copy')
    };

    let vault = new Set();

    els.syllables.addEventListener('input', function(){
        const v = parseInt(this.value);
        if(v === 2) els.sylVal.textContent = "Short (2)";
        if(v === 3) els.sylVal.textContent = "Melodic (3)";
        if(v === 4) els.sylVal.textContent = "Elegant (4+)";
    });

    els.clear.addEventListener('click', () => {
        els.inc.value = ''; els.exclude.value = '';
        els.syllables.value = 3; els.sylVal.textContent = "Melodic (3)";
        els.personality.value = 'sweet'; els.style.value = 'modern';
    });

    els.btn.addEventListener('click',function(){
        els.btn.disabled=true;
        els.btn.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Summoning...';
        
        let payload = {
            personality: els.personality.value,
            style: els.style.value,
            syllables: els.syllables.value,
            include: els.inc.value,
            exclude: els.exclude.value
        };

        fetch('{{ route("ai.generate",["type"=>"anime-girl-name"]) }}',{
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
                    col.className = 'col-lg-6 col-md-12';
                    
                    const d=document.createElement('div');
                    const isFav = vault.has(item);
                    d.className=`name-chip p-3 d-flex justify-content-between align-items-center bg-white rounded-4 shadow-sm border border-fuchsia-subtle ${isFav ? 'border-fuchsia bg-fuchsia-soft' : ''}`;
                    
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
                            d.classList.remove('border-fuchsia', 'bg-fuchsia-soft');
                        } else {
                            vault.add(item);
                            icon.className = 'fas fa-heart text-danger';
                            d.classList.add('border-fuchsia', 'bg-fuchsia-soft');
                        }
                        renderVault();
                    });
                    
                    col.appendChild(d);
                    els.list.appendChild(col);
                });
            }
        }).finally(function(){
            els.btn.disabled=false;
            els.btn.innerHTML='<i class="fas fa-star me-2"></i>Summon Heroines';
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
                            p.classList.remove('border-fuchsia', 'bg-fuchsia-soft');
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
    document.querySelectorAll('.ag-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === 'magical') { 
                els.personality.value = 'sweet'; els.style.value = 'fantasy'; els.syllables.value = 3; els.sylVal.textContent = "Melodic (3)";
            } else if (p === 'kuudere') {
                els.personality.value = 'mysterious'; els.style.value = 'scifi'; els.syllables.value = 2; els.sylVal.textContent = "Short (2)";
            }
            els.btn.click();
        });
    });

});
</script>

<style>
.anime-girl-name-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(217,70,239,.05)}
.anime-girl-name-generator-rebuilt .border-fuchsia { border-top: 4px solid #d946ef !important; }
.anime-girl-name-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.anime-girl-name-generator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.anime-girl-name-generator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.anime-girl-name-generator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.anime-girl-name-generator-rebuilt .form-label-custom{font-size:.7rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}

.text-fuchsia { color: #d946ef !important; }
.bg-fuchsia-soft { background-color: #fdf4ff !important; }
.border-fuchsia { border-color: #d946ef !important; }
.border-fuchsia-subtle { border-color: #f5d0fe !important; }

.text-slate { color: #475569 !important; }
.bg-slate { background-color: #475569 !important; }
.border-end-md { border-right: 1px dashed #e2e8f0; }

.btn-fuchsia { background: #d946ef; color: white; border: none; transition: 0.3s cubic-bezier(.4,0,.2,1); }
.btn-fuchsia:hover { background: #c026d3; color: white; transform: translateY(0); box-shadow: 0 4px 12px rgba(217,70,239,0.2) !important; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); overflow: hidden;}

/* Custom Range */
.custom-range-fuchsia::-webkit-slider-thumb { background: #d946ef; }
.custom-range-fuchsia::-moz-range-thumb { background: #d946ef; }

/* Interactive Chips */
.name-chip { transition: all 0.2s; cursor: default; }
.name-chip:hover { border-color: #e11d48 !important; }
.opacity-target { opacity: 1; }
.name-chip:hover .opacity-target { opacity: 1; }
.chip-btn { width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; padding: 0; transition: 0.2s; border: 1px solid #e2e8f0; }


/* Vault Floor */
.vault-floor { position: absolute; bottom: 0; left: 0; width: 100%; background: #1e293b; border-top: 4px solid #d946ef; z-index: 100; border-bottom-left-radius: 24px; border-bottom-right-radius: 24px; }
.vault-remove:hover { color: #d946ef !important; }

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
