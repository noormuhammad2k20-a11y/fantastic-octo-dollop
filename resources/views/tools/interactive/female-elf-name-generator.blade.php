<div class="row g-4 female-elf-name-generator-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-emerald">
            

            <div class="calculator-body">
                <div class="row g-4 mb-4">
                    {{-- Core Origin --}}
                    <div class="col-md-4 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-emerald small"><i class="fas fa-leaf me-2"></i>Elven Origin</h6>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Elven Sub-Race</label>
                            <select id="e-subrace" class="form-select border-2">
                                <option value="high">High Elf (Sun/Moon)</option>
                                <option value="wood">Wood Elf (Sylvan)</option>
                                <option value="drow">Drow (Dark Elf)</option>
                                <option value="sea">Sea Elf (Aquatic)</option>
                                <option value="eladrin">Eladrin (Feywild)</option>
                                <option value="half">Half-Elf</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Character Archetype</label>
                            <select id="e-archetype" class="form-select border-2">
                                <option value="noble">Noble / Royal / Diplomat</option>
                                <option value="ranger">Ranger / Hunter / Druid</option>
                                <option value="mage">Mage / Scholar / Cleric</option>
                                <option value="assassin">Assassin / Shadow</option>
                            </select>
                        </div>

                    </div>

                    {{-- Advanced Linguistics --}}
                    <div class="col-md-8 ps-md-4 mt-4 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-slate small"><i class="fas fa-language me-2"></i>Advanced Linguistics</h6>
                        
                        <div class="row g-3">
                            <div class="col-12 mb-2">
                                <label class="form-label-custom d-flex justify-content-between">
                                    <span>Syllable Fluidity</span>
                                    <span class="badge bg-slate" id="e-syllable-val">Melodic (3)</span>
                                </label>
                                <input type="range" class="form-range custom-range-emerald" id="e-syllables" min="2" max="4" step="1" value="3">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Force the name to start with this text.">Starts With (Prefix)</label>
                                <input type="text" id="e-prefix" class="form-control" placeholder="e.g. Syl, Fae, Lir">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Force the name to end with this text.">Ends With (Suffix)</label>
                                <input type="text" id="e-suffix" class="form-control" placeholder="e.g. wen, ria, eth">
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label-custom tooltip-label" title="Words the engine should avoid.">Exclude Words</label>
                                <input type="text" id="e-exclude" class="form-control border-danger-subtle bg-soft-red" placeholder="e.g. dark, leaf, star">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-2 pt-4 border-top d-flex flex-wrap gap-3 align-items-center">
                    <button id="gen-btn" class="btn btn-emerald px-5 py-3 fw-bold rounded-4 shadow-sm fs-5">
                        <i class="fab fa-envira me-2"></i> Conjure Elf Names
                    </button>
                    <button class="btn btn-outline-secondary px-4 py-3 fw-bold rounded-4" id="e-clear"><i class="fas fa-broom me-2"></i>Clear</button>
                    
                    <div class="ms-auto border-start ps-3 d-none d-lg-block">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-emerald me-1"></i>Presets:</span>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border e-quick" data-p="drow">Drow Priestess</button>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border e-quick" data-p="wood">Wood Elf Ranger</button>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border e-quick" data-p="high">High Elf Queen</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed position-relative" style="--tool-color:#10b981;--tool-bg:#f0fdf4; min-height: 400px; padding-bottom: 8rem;">
            
            <div id="gen-placeholder" class="text-center py-5 d-flex flex-column justify-content-center h-100">
                <div class="opacity-25 mb-4 text-emerald"><i class="fas fa-spa fa-5x fa-spin-hover"></i></div>
                <h3 class="text-dark fw-black">The Glade is Silent</h3>
                <p class="text-muted fs-5">Configure the sub-race and archetype above.<br>Your generated Elven names will bloom here.</p>
            </div>

            <div id="gen-results" class="d-none">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3 border-emerald-subtle">
                    <h5 class="fw-black m-0 text-dark d-flex align-items-center">
                        <i class="fas fa-leaf text-emerald me-2"></i> Conjured Elves
                    </h5>
                    <button class="btn btn-sm btn-dark rounded-pill px-3" id="e-copy-all"><i class="fas fa-copy me-2"></i>Copy All List</button>
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
                        <h6 class="fw-bold m-0 text-white d-flex align-items-center"><i class="fas fa-heart text-danger me-2"></i> Elven Vault</h6>
                        <span class="small text-white-50" id="vault-count">0 saved names</span>
                    </div>
                    <div id="vault-tags" class="d-flex flex-wrap gap-2 mx-4 overflow-hidden" style="max-height: 40px; flex-grow: 1;">
                        <span class="text-white-50 small fst-italic mt-1" id="vault-empty">Click the heart icon on any name to save it here.</span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fw-bold rounded-pill shadow-sm" id="vault-copy"><i class="fas fa-copy text-emerald me-1"></i> Copy Vault</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    {{-- ═══════ SEO & EDUCATIONAL SECTION ═══════ --}}
    <div class="col-lg-12 mt-5">
        <div class="p-5 bg-white rounded-4 border shadow-sm article-content">
            <h3 class="fw-black text-dark mb-4"><i class="fas fa-book-open text-emerald me-2"></i> The Sylvan Linguist's Guide</h3>
            
            <div class="row g-5">
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">Phonetics of the Sub-Races</h5>
                    <p class="text-muted">Elven names are meant to sound melodic, deeply connected to nature, or ancient. However, the exact aesthetic shifts heavily depending on the sub-race selected in the generator:</p>
                    <ul class="text-muted small">
                        <li><strong>High Elves (Sun/Moon):</strong> Favor elegant, elongated vowels and soft consonants (e.g., <em>Aeloria, Faen</em>).</li>
                        <li><strong>Wood Elves (Sylvan):</strong> Favor earthier tones, pulling prefixes from flora and fauna (e.g., <em>Sylwen, Briar</em>).</li>
                        <li><strong>Drow (Dark Elves):</strong> Rely on sharp, sibilant sounds. Combining harsh Z's, X's, and apostrophes to indicate underdark dialects (e.g., <em>Xalyth, Viconia</em>).</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">Mastering Elven Suffixes</h5>
                    <p class="text-muted">In traditional fantasy lore (heavily inspired by Tolkien's Sindarin and Quenya), female elven names often utilize specific identifying suffixes. If you want to use the 'Ends With' feature of this tool, try plugging in:</p>
                    <ul class="text-muted small">
                        <li><strong>-wen:</strong> Meaning "maiden" (e.g., <em>Arwen, Morwen</em>).</li>
                        <li><strong>-iel:</strong> Meaning "daughter of" (e.g., <em>Galadriel, Tauriel</em>).</li>
                        <li><strong>-eth:</strong> Meaning "valley" or indicating a softer feminine tone.</li>
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
        btn: $('gen-btn'), clear: $('e-clear'), copyAll: $('e-copy-all'),
        subrace: $('e-subrace'), archetype: $('e-archetype'),
        syllables: $('e-syllables'), prefix: $('e-prefix'), suffix: $('e-suffix'), exclude: $('e-exclude'),
        sylVal: $('e-syllable-val'),
        results: $('gen-results'), list: $('gen-list'), ph: $('gen-placeholder'),
        vaultTags: $('vault-tags'), vaultCount: $('vault-count'), vaultEmpty: $('vault-empty'), vaultCopy: $('vault-copy')
    };

    let vault = new Set();

    els.syllables.addEventListener('input', function(){
        const v = parseInt(this.value);
        if(v === 2) els.sylVal.textContent = "Sharp (2)";
        if(v === 3) els.sylVal.textContent = "Melodic (3)";
        if(v === 4) els.sylVal.textContent = "Ancient (4+)";
    });

    els.clear.addEventListener('click', () => {
        els.prefix.value = ''; els.suffix.value = ''; els.exclude.value = '';
        els.syllables.value = 3; els.sylVal.textContent = "Melodic (3)";
        els.subrace.value = 'high'; els.archetype.value = 'noble';
    });

    els.btn.addEventListener('click',function(){
        els.btn.disabled=true;
        els.btn.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Conjuring Magic...';
        
        let payload = {
            race: 'elf', // Force elf
            gender: 'female', // Force female
            subrace: els.subrace.value,
            archetype: els.archetype.value,
            syllables: els.syllables.value,
            prefix: els.prefix.value,
            suffix: els.suffix.value,
            exclude: els.exclude.value
        };

        fetch('{{ route("ai.generate",["type"=>"female-elf-name"]) }}',{
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
                    d.className=`name-chip p-3 d-flex justify-content-between align-items-center bg-white rounded-4 shadow-sm border border-emerald-subtle ${isFav ? 'border-emerald bg-emerald-soft' : ''}`;
                    
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
                            d.classList.remove('border-emerald', 'bg-emerald-soft');
                        } else {
                            vault.add(item);
                            icon.className = 'fas fa-heart text-danger';
                            d.classList.add('border-emerald', 'bg-emerald-soft');
                        }
                        renderVault();
                    });
                    
                    col.appendChild(d);
                    els.list.appendChild(col);
                });
            }
        }).finally(function(){
            els.btn.disabled=false;
            els.btn.innerHTML='<i class="fab fa-envira me-2"></i>Conjure Elf Names';
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
                            p.classList.remove('border-emerald', 'bg-emerald-soft');
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
    document.querySelectorAll('.e-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === 'drow') { 
                els.subrace.value = 'drow'; els.archetype.value = 'assassin'; els.syllables.value = 2; els.sylVal.textContent = "Sharp (2)";
            } else if (p === 'wood') {
                els.subrace.value = 'wood'; els.archetype.value = 'ranger'; els.syllables.value = 2; els.sylVal.textContent = "Sharp (2)";
            } else if (p === 'high') {
                els.subrace.value = 'high'; els.archetype.value = 'noble'; els.syllables.value = 4; els.sylVal.textContent = "Ancient (4+)";
            }
            els.btn.click();
        });
    });

});
</script>

<style>
.female-elf-name-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(16,185,129,.05)}
.female-elf-name-generator-rebuilt .border-emerald { border-top: 4px solid #10b981 !important; }
.female-elf-name-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.female-elf-name-generator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.female-elf-name-generator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.female-elf-name-generator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.female-elf-name-generator-rebuilt .form-label-custom{font-size:.7rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}

.text-emerald { color: #10b981 !important; }
.bg-emerald-soft { background-color: #f0fdf4 !important; }
.border-emerald { border-color: #10b981 !important; }
.border-emerald-subtle { border-color: #a7f3d0 !important; }

.text-slate { color: #475569 !important; }
.bg-slate { background-color: #475569 !important; }
.border-end-md { border-right: 1px dashed #e2e8f0; }

.btn-emerald { background: #10b981; color: white; border: none; transition: 0.3s cubic-bezier(.4,0,.2,1); }
.btn-emerald:hover { background: #059669; color: white; transform: translateY(0); box-shadow: 0 4px 12px rgba(16,185,129,0.2) !important; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); overflow: hidden;}

/* Custom Range */
.custom-range-emerald::-webkit-slider-thumb { background: #10b981; }
.custom-range-emerald::-moz-range-thumb { background: #10b981; }

/* Interactive Chips */
.name-chip { transition: all 0.2s; cursor: default; }
.name-chip:hover { border-color: #e11d48 !important; }
.opacity-target { opacity: 1; }
.name-chip:hover .opacity-target { opacity: 1; }
.chip-btn { width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; padding: 0; transition: 0.2s; border: 1px solid #e2e8f0; }


/* Vault Floor */
.vault-floor { position: absolute; bottom: 0; left: 0; width: 100%; background: #1e293b; border-top: 4px solid #10b981; z-index: 100; border-bottom-left-radius: 24px; border-bottom-right-radius: 24px; }
.vault-remove:hover { color: #10b981 !important; }

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
