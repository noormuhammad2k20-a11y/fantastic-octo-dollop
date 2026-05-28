<div class="row g-4 dnd-name-generator-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-crimson">
            

            <div class="calculator-body">
                <div class="row g-4 mb-4">
                    {{-- Core Identity --}}
                    <div class="col-md-4 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-crimson small"><i class="fas fa-id-card me-2"></i>Core Identity</h6>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Race / Species</label>
                            <select id="dnd-race" class="form-select border-2">
                                <option value="human">Human</option>
                                <option value="elf">Elf</option>
                                <option value="dwarf">Dwarf</option>
                                <option value="halfling">Halfling</option>
                                <option value="dragonborn">Dragonborn</option>
                                <option value="tiefling">Tiefling</option>
                                <option value="orc">Half-Orc</option>
                                <option value="gnome">Gnome</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Gender Profile</label>
                            <select id="dnd-gender" class="form-select border-2">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="neutral">Neutral/Androgynous</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Character Class</label>
                            <select id="dnd-class" class="form-select border-2 bg-light">
                                <option value="any">Any / Non-Combatant</option>
                                <option value="assassin">Assassin / Rogue</option>
                                <option value="barbarian">Barbarian / Berserker</option>
                                <option value="cleric">Cleric / Priest</option>
                                <option value="fighter">Fighter / Knight</option>
                                <option value="paladin">Paladin / Crusader</option>
                                <option value="warlock">Warlock / Cultist</option>
                                <option value="wizard">Wizard / Sorcerer</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="form-label-custom">Moral Alignment / Vibe</label>
                            <select id="dnd-alignment" class="form-select border-2">
                                <option value="neutral">Neutral / Standard</option>
                                <option value="lawful_good">Lawful Good (Heroic)</option>
                                <option value="chaotic_evil">Chaotic Evil (Savage)</option>
                                <option value="creepy">Eldritch / Creepy</option>
                            </select>
                        </div>
                    </div>

                    {{-- Advanced Linguistics --}}
                    <div class="col-md-8 ps-md-4 mt-4 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-slate small"><i class="fas fa-language me-2"></i>Advanced Linguistics</h6>
                        
                        <div class="row g-3">
                            <div class="col-12 mb-2">
                                <label class="form-label-custom d-flex justify-content-between">
                                    <span>Syllable Length</span>
                                    <span class="badge bg-slate" id="syllable-val">Medium (2-3)</span>
                                </label>
                                <input type="range" class="form-range custom-range-crimson" id="dnd-syllables" min="1" max="3" step="1" value="2">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Force the name to start with this text.">Starts With (Prefix)</label>
                                <input type="text" id="dnd-prefix" class="form-control" placeholder="e.g. Mal, Kor, El">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Force the name to end with this text.">Ends With (Suffix)</label>
                                <input type="text" id="dnd-suffix" class="form-control" placeholder="e.g. zana, thar, ius">
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label-custom tooltip-label" title="Comma separated words or letters the AI should strictly avoid.">Exclude Words / Letters</label>
                                <input type="text" id="dnd-exclude" class="form-control border-danger-subtle bg-soft-red" placeholder="e.g. dark, blood, X, Z">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-2 pt-4 border-top d-flex flex-wrap gap-3 align-items-center">
                    <button id="gen-btn" class="btn btn-crimson px-5 py-3 fw-bold rounded-4 shadow-sm fs-5">
                        <i class="fas fa-dice-d20 me-2"></i> Conjure Names
                    </button>
                    <button class="btn btn-outline-secondary px-4 py-3 fw-bold rounded-4" id="dnd-clear"><i class="fas fa-broom me-2"></i>Clear Filters</button>
                    
                    <div class="ms-auto border-start ps-3 d-none d-lg-block">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-crimson me-1"></i>NPC Presets:</span>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border dnd-quick" data-p="villain">The BBEG</button>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border dnd-quick" data-p="knight">Royal Knight</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed position-relative" style="--tool-color:#dc2626;--tool-bg:#fef2f2; min-height: 400px; padding-bottom: 8rem;">
            
            <div id="gen-placeholder" class="text-center py-5 d-flex flex-column justify-content-center h-100">
                <div class="opacity-25 mb-4 text-crimson"><i class="fas fa-scroll fa-5x fa-spin-hover"></i></div>
                <h3 class="text-dark fw-black">The Tome is Empty</h3>
                <p class="text-muted fs-5">Configure your character's traits and click 'Conjure Names' above.<br>Your generated legends will appear here.</p>
            </div>

            <div id="gen-results" class="d-none">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3 border-danger-subtle">
                    <h5 class="fw-black m-0 text-dark d-flex align-items-center">
                        <i class="fas fa-fire me-2 text-crimson"></i> Conjured Entities
                    </h5>
                    <button class="btn btn-sm btn-dark rounded-pill px-3" id="dnd-copy-all"><i class="fas fa-copy me-2"></i>Copy All List</button>
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
                        <h6 class="fw-bold m-0 text-white d-flex align-items-center"><i class="fas fa-heart text-danger me-2"></i> Favorite Vault</h6>
                        <span class="small text-white-50" id="vault-count">0 saved names</span>
                    </div>
                    <div id="vault-tags" class="d-flex flex-wrap gap-2 mx-4 overflow-hidden" style="max-height: 40px; flex-grow: 1;">
                        <!-- Vault tags injected here -->
                        <span class="text-white-50 small fst-italic mt-1" id="vault-empty">Click the heart icon on any name to save it here.</span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fw-bold rounded-pill shadow-sm" id="vault-copy"><i class="fas fa-copy text-crimson me-1"></i> Copy Vault</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    {{-- ═══════ SEO & EDUCATIONAL SECTION ═══════ --}}
    <div class="col-lg-12 mt-5">
        <div class="p-5 bg-white rounded-4 border shadow-sm article-content">
            <h3 class="fw-black text-dark mb-4"><i class="fas fa-book-open text-crimson me-2"></i> The Architect's Guide to D&D Naming</h3>
            
            <div class="row g-5">
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">How the Logic Engine Works</h5>
                    <p class="text-muted">Our generator does not pull from a static CSV file. It utilizes a programmatic AI prompt matrix. When you select <strong>Race</strong> (e.g., Elf) and <strong>Class</strong> (e.g., Assassin), the engine meshes traditional Elven linguistic rules (fluid vowels, soft consonants) with the harsh, shadowy aesthetic of an Assassin (sibilants, hard stops).</p>
                    <p class="text-muted">When you inject a <strong>Prefix</strong> or manipulate the <strong>Syllable Slider</strong>, the ruleset forces structural boundaries on the generation, ensuring every single name is uniquely synthesized for your campaign instead of recycled.</p>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">Pro-Tips for Dungeon Masters</h5>
                    <ul class="text-muted">
                        <li class="mb-2"><strong>The "Tavern Test":</strong> Can your players actually pronounce the name without stumbling? If a name has more than three syllables, assign them a standard nickname.</li>
                        <li class="mb-2"><strong>Exclude the Tropes:</strong> Use the "Exclude Words" filter to block out overused fantasy syllables like <em>"Dark", "Blood", or "Shadow"</em> to force the engine into generating more obscure, authentic-sounding lore.</li>
                        <li><strong>Alignment Matters:</strong> A Lawful Good Paladin sounds vastly different from a Chaotic Evil Paladin. Toggle the <em>Vibe Selector</em> to instantly shift the phonetic mood.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',function(){
    const $ = id => document.getElementById(id);
    const els = {
        btn: $('gen-btn'), clear: $('dnd-clear'), copyAll: $('dnd-copy-all'),
        race: $('dnd-race'), gender: $('dnd-gender'), charClass: $('dnd-class'), alignment: $('dnd-alignment'),
        syllables: $('dnd-syllables'), prefix: $('dnd-prefix'), suffix: $('dnd-suffix'), exclude: $('dnd-exclude'),
        sylVal: $('syllable-val'),
        results: $('gen-results'), list: $('gen-list'), ph: $('gen-placeholder'),
        vaultTags: $('vault-tags'), vaultCount: $('vault-count'), vaultEmpty: $('vault-empty'), vaultCopy: $('vault-copy')
    };

    let vault = new Set();

    // Syllable slider UI
    els.syllables.addEventListener('input', function(){
        const v = parseInt(this.value);
        if(v === 1) els.sylVal.textContent = "Short (1-2)";
        if(v === 2) els.sylVal.textContent = "Medium (2-3)";
        if(v === 3) els.sylVal.textContent = "Long (4+)";
    });

    els.clear.addEventListener('click', () => {
        els.prefix.value = ''; els.suffix.value = ''; els.exclude.value = '';
        els.syllables.value = 2; els.sylVal.textContent = "Medium (2-3)";
        els.race.value = 'human'; els.charClass.value = 'any'; els.alignment.value = 'neutral'; els.gender.value = 'male';
    });

    els.btn.addEventListener('click',function(){
        els.btn.disabled=true;
        els.btn.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Conjuring Magic...';
        
        let payload = {
            race: els.race.value,
            gender: els.gender.value,
            class: els.charClass.value,
            alignment: els.alignment.value,
            syllables: els.syllables.value,
            prefix: els.prefix.value,
            suffix: els.suffix.value,
            exclude: els.exclude.value
        };

        fetch('{{ route("ai.generate",["type"=>"dnd-name"]) }}',{
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
                    d.className=`name-chip p-3 d-flex justify-content-between align-items-center bg-white rounded-4 shadow-sm border border-danger-subtle ${isFav ? 'border-danger bg-red-soft' : ''}`;
                    
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
                    
                    // Copy
                    d.querySelector('.copy-btn').addEventListener('click',function(){
                        navigator.clipboard.writeText(item).then(function(){
                            const icon = d.querySelector('.copy-btn i');
                            icon.className = 'fas fa-check text-success';
                            setTimeout(function(){icon.className = 'fas fa-copy text-secondary';}, 2000);
                        });
                    });

                    // Heart
                    d.querySelector('.fav-btn').addEventListener('click',function(){
                        const icon = this.querySelector('i');
                        if(vault.has(item)) {
                            vault.delete(item);
                            icon.className = 'far fa-heart text-secondary';
                            d.classList.remove('border-danger', 'bg-red-soft');
                        } else {
                            vault.add(item);
                            icon.className = 'fas fa-heart text-danger';
                            d.classList.add('border-danger', 'bg-red-soft');
                        }
                        renderVault();
                    });
                    
                    col.appendChild(d);
                    els.list.appendChild(col);
                });
            }
        }).finally(function(){
            els.btn.disabled=false;
            els.btn.innerHTML='<i class="fas fa-dice-d20 me-2"></i>Conjure Names';
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
                    // trigger re-render of main list colors if they are visible
                    document.querySelectorAll('.name-chip h6').forEach(h6 => {
                        if(h6.innerText === this.dataset.name) {
                            const p = h6.closest('.name-chip');
                            p.classList.remove('border-danger', 'bg-red-soft');
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

    // Handle Quick Presets
    document.querySelectorAll('.dnd-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === 'villain') { 
                els.race.value = 'tiefling'; els.charClass.value = 'warlock'; els.alignment.value = 'chaotic_evil';
            } else if (p === 'knight') {
                els.race.value = 'dragonborn'; els.charClass.value = 'paladin'; els.alignment.value = 'lawful_good';
            }
            els.btn.click();
        });
    });

});
</script>

<style>
.dnd-name-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(220,38,38,.05)}
.dnd-name-generator-rebuilt .border-crimson { border-top: 4px solid #dc2626 !important; }
.dnd-name-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.dnd-name-generator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.dnd-name-generator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.dnd-name-generator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.dnd-name-generator-rebuilt .form-label-custom{font-size:.7rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}

.text-crimson { color: #dc2626 !important; }
.bg-crimson-soft { background-color: #fef2f2 !important; }
.bg-red-soft { background-color: #fef2f2 !important; }

.text-slate { color: #475569 !important; }
.bg-slate { background-color: #475569 !important; }
.border-end-md { border-right: 1px dashed #e2e8f0; }

.btn-crimson { background: #dc2626; color: white; border: none; transition: 0.3s cubic-bezier(.4,0,.2,1); }
.btn-crimson:hover { background: #be123c; color: white; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); overflow: hidden;}

/* Custom Range */
.custom-range-crimson::-webkit-slider-thumb { background: #dc2626; }
.custom-range-crimson::-moz-range-thumb { background: #dc2626; }
.custom-range-crimson::-ms-thumb { background: #dc2626; }

/* Interactive Chips */
.name-chip { transition: all 0.2s; cursor: default; }
.name-chip:hover { border-color: #e11d48 !important; }
.opacity-target { opacity: 1; }
.name-chip:hover .opacity-target { opacity: 1; }
.chip-btn { width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; padding: 0; transition: 0.2s; border: 1px solid #e2e8f0; }


/* Vault Floor */
.vault-floor { position: absolute; bottom: 0; left: 0; width: 100%; background: #1e293b; border-top: 4px solid #dc2626; z-index: 100; border-bottom-left-radius: 24px; border-bottom-right-radius: 24px; }
.vault-remove:hover { color: #dc2626 !important; }

/* Article Content */
.article-content p { line-height: 1.7; font-size: 0.95rem; }
.article-content ul li { font-size: 0.95rem; line-height: 1.6; }

@media (max-width: 768px) {
    .border-end-md { border-right: none; border-bottom: 1px dashed #e2e8f0; padding-bottom: 2rem; }
    .ps-md-4 { padding-left: 0 !important; }
    .pe-md-4 { padding-right: 0 !important; }
    .opacity-target { opacity: 1; } /* Always show buttons on mobile */
    .vault-floor { flex-direction: column; padding: 1rem; text-align: center; }
    
}
</style>
