<div class="row g-4 band-name-generator-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-yellow">
            

            <div class="calculator-body">
                <div class="row g-4 mb-4">
                    {{-- Core Niche --}}
                    <div class="col-md-4 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-yellow small"><i class="fas fa-headphones me-2"></i>Musical Identity</h6>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Music Genre</label>
                            <select id="bn-genre" class="form-select border-2">
                                <option value="rock">Rock / Alternative</option>
                                <option value="punk">Punk / Grunge</option>
                                <option value="indie">Indie / Dream Pop</option>
                                <option value="edm">EDM / Electronic</option>
                                <option value="metal">Heavy Metal</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Aesthetic Vibe</label>
                            <select id="bn-vibe" class="form-select border-2">
                                <option value="dark">Dark / Melancholic</option>
                                <option value="neon">Neon / Cyber / Electric</option>
                                <option value="mellow">Mellow / Acoustic / Natural</option>
                                <option value="aggressive">Aggressive / Savage</option>
                            </select>
                        </div>

                    </div>

                    {{-- Advanced Linguistics --}}
                    <div class="col-md-8 ps-md-4 mt-4 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-slate small"><i class="fas fa-microphone me-2"></i>Stage Presence</h6>
                        
                        <div class="row g-3">
                            <div class="col-12 mb-2">
                                <label class="form-label-custom d-flex justify-content-between">
                                    <span>Format Complexity</span>
                                    <span class="badge bg-slate" id="bn-format-val">Short & Punchy</span>
                                </label>
                                <input type="range" class="form-range custom-range-yellow" id="bn-format" min="1" max="3" step="1" value="1">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Must include this specific word.">Must Include Element</label>
                                <input type="text" id="bn-include" class="form-control" placeholder="e.g. Broken, Boys, Club">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom tooltip-label" title="Exclude these words.">Exclude Words</label>
                                <input type="text" id="bn-exclude" class="form-control border-danger-subtle bg-soft-red" placeholder="e.g. The, Band">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-2 pt-4 border-top d-flex flex-wrap gap-3 align-items-center">
                    <button id="gen-btn" class="btn btn-yellow px-5 py-3 fw-bold rounded-4 shadow-sm fs-5 text-dark">
                        <i class="fas fa-play me-2"></i> Drop the Beat
                    </button>
                    <button class="btn btn-outline-secondary px-4 py-3 fw-bold rounded-4" id="bn-clear" style="min-width: 280px; max-width: 100%;"><i class="fas fa-broom me-2"></i>Clear</button>
                    
                    <div class="ms-auto border-start ps-3 d-none d-lg-block">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-compact-disc text-yellow me-1"></i>Presets:</span>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border bn-quick" data-p="punk">Garage Punk</button>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border bn-quick" data-p="edm">Neon EDM</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed position-relative" style="--tool-color:#eab308;--tool-bg:#111827; min-height: 400px; padding-bottom: 8rem;">
            
            <div id="gen-placeholder" class="text-center py-5 d-flex flex-column justify-content-center h-100">
                <div class="opacity-25 mb-4 text-warning"><i class="fas fa-drum fa-5x fa-spin-hover"></i></div>
                <h3 class="text-white fw-black">The Stage is Empty</h3>
                <p class="text-muted fs-5">Configure your musical genre and vibe above.<br>Your setlist of band names will appear here.</p>
            </div>

            <div id="gen-results" class="d-none">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3 border-secondary">
                    <h5 class="fw-black m-0 text-white d-flex align-items-center">
                        <i class="fas fa-music text-warning me-2"></i> Headliners
                    </h5>
                    <button class="btn btn-sm btn-light rounded-pill px-3 fw-bold" id="bn-copy-all" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Setlist</button>
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
                        <h6 class="fw-bold m-0 text-white d-flex align-items-center"><i class="fas fa-ticket-alt text-warning me-2"></i> VIP Access (Vault)</h6>
                        <span class="small text-white-50" id="vault-count">0 saved names</span>
                    </div>
                    <div id="vault-tags" class="d-flex flex-wrap gap-2 mx-4 overflow-hidden" style="max-height: 40px; flex-grow: 1;">
                        <span class="text-white-50 small fst-italic mt-1" id="vault-empty">Click the ticket icon on any name to save it to your VIP pass.</span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-warning fw-bold rounded-pill shadow-sm text-dark" id="vault-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i> Copy VIPs</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    {{-- ═══════ SEO & EDUCATIONAL SECTION ═══════ --}}
    <div class="col-lg-12 mt-5">
        <div class="p-5 bg-white rounded-4 border shadow-sm article-content">
            <h3 class="fw-black text-dark mb-4"><i class="fas fa-fire text-yellow me-2"></i> The Anatomy of a Band Name</h3>
            
            <div class="row g-5">
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">Genre Expectations</h5>
                    <p class="text-muted">A great band name instantly communicates the type of music the audience is about to hear. Heavy Metal bands often rely on brutal nouns and abstract concepts (e.g., <em>Iron Maiden, Megadeth</em>). Indie bands lean toward melancholic nature metaphors or highly specific long phrases (e.g., <em>Death Cab for Cutie, Arctic Monkeys</em>).</p>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold text-slate">The "The" Rule</h5>
                    <p class="text-muted">In the early 2000s, garage rock exploded with a massive wave of "The [Plural Noun]" bands (<em>The Strokes, The White Stripes, The Killers</em>). Today, many electronic and pop artists prefer singular abstract words dropping the "The" entirely (<em>Flume, Halsey, Grimes</em>). Use our 'Format Complexity' slider to switch between classic group formats and solo artistic monikers.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',function(){
    const $ = id => document.getElementById(id);
    const els = {
        btn: $('gen-btn'), clear: $('bn-clear'), copyAll: $('bn-copy-all'),
        genre: $('bn-genre'), vibe: $('bn-vibe'),
        format: $('bn-format'), inc: $('bn-include'), exclude: $('bn-exclude'),
        formatVal: $('bn-format-val'),
        results: $('gen-results'), list: $('gen-list'), ph: $('gen-placeholder'),
        vaultTags: $('vault-tags'), vaultCount: $('vault-count'), vaultEmpty: $('vault-empty'), vaultCopy: $('vault-copy')
    };

    let vault = new Set();

    els.format.addEventListener('input', function(){
        const v = parseInt(this.value);
        if(v === 1) els.formatVal.textContent = "Short & Punchy";
        if(v === 2) els.formatVal.textContent = "The [Plural]s";
        if(v === 3) els.formatVal.textContent = "Long / Phrase";
    });

    els.clear.addEventListener('click', () => {
        els.inc.value = ''; els.exclude.value = '';
        els.format.value = 1; els.formatVal.textContent = "Short & Punchy";
        els.genre.value = 'rock'; els.vibe.value = 'dark';
    });

    els.btn.addEventListener('click',function(){
        els.btn.disabled=true;
        els.btn.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Tuning...';
        
        let payload = {
            genre: els.genre.value,
            vibe: els.vibe.value,
            format: els.format.value,
            include: els.inc.value,
            exclude: els.exclude.value
        };

        fetch('{{ route("ai.generate",["type"=>"band-name"]) }}',{
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
                    col.className = 'col-lg-4 col-md-6';
                    
                    const d=document.createElement('div');
                    const isFav = vault.has(item);
                    d.className=`name-chip p-3 d-flex justify-content-between align-items-center rounded-4 shadow-sm border border-secondary ${isFav ? 'border-warning bg-dark' : 'bg-darker'}`;
                    
                    d.innerHTML=`
                        <div class="flex-grow-1 overflow-hidden pe-2" title="${item}">
                            <h6 class="fw-bold mb-0 ${isFav ? 'text-warning' : 'text-white'}" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">${item}</h6>
                        </div>
                        <div class="d-flex gap-1 flex-shrink-0 opacity-target">
                            <button class="btn btn-sm btn-dark rounded-circle chip-btn copy-btn" title="Copy">
                                <i class="fas fa-copy text-secondary"></i>
                            </button>
                            <button class="btn btn-sm btn-dark rounded-circle chip-btn fav-btn" title="Add to VIP">
                                <i class="fas fa-ticket-alt text-${isFav ? 'warning' : 'secondary'}"></i>
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
                        const h6 = d.querySelector('h6');
                        if(vault.has(item)) {
                            vault.delete(item);
                            icon.className = 'fas fa-ticket-alt text-secondary';
                            d.classList.remove('border-warning');
                            h6.classList.remove('text-warning');
                            h6.classList.add('text-white');
                        } else {
                            vault.add(item);
                            icon.className = 'fas fa-ticket-alt text-warning';
                            d.classList.add('border-warning');
                            h6.classList.remove('text-white');
                            h6.classList.add('text-warning');
                        }
                        renderVault();
                    });
                    
                    col.appendChild(d);
                    els.list.appendChild(col);
                });
            }
        }).finally(function(){
            els.btn.disabled=false;
            els.btn.innerHTML='<i class="fas fa-play me-2"></i>Drop the Beat';
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
                tag.className = 'badge bg-darker text-warning border border-secondary shadow-sm d-flex align-items-center py-2 px-3 fw-bold';
                tag.innerHTML = `${name} <i class="fas fa-times text-muted ms-2 px-1 vault-remove" style="cursor:pointer;" data-name="${name}"></i>`;
                
                tag.querySelector('.vault-remove').addEventListener('click', function(){
                    vault.delete(this.dataset.name);
                    renderVault();
                    document.querySelectorAll('.name-chip h6').forEach(h6 => {
                        if(h6.innerText === this.dataset.name) {
                            const p = h6.closest('.name-chip');
                            p.classList.remove('border-warning');
                            h6.classList.remove('text-warning');
                            h6.classList.add('text-white');
                            p.querySelector('.fav-btn i').className = 'fas fa-ticket-alt text-secondary';
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
            this.innerHTML = '<i class="fas fa-check text-dark me-1"></i> Copied!';
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
            this.innerHTML = '<i class="fas fa-check text-success me-2"></i>Copied!';
            setTimeout(()=>{this.innerHTML = o;}, 2000);
        });
    });

    // Presets
    document.querySelectorAll('.bn-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === 'punk') { 
                els.genre.value = 'punk'; els.vibe.value = 'aggressive'; els.format.value = 2; els.formatVal.textContent = "The [Plural]s";
            } else if (p === 'edm') {
                els.genre.value = 'edm'; els.vibe.value = 'neon'; els.format.value = 1; els.formatVal.textContent = "Short & Punchy";
            }
            els.btn.click();
        });
    });

});
</script>

<style>
.band-name-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(234,179,8,.05)}
.band-name-generator-rebuilt .border-yellow { border-top: 4px solid #eab308 !important; }
.band-name-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.band-name-generator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.band-name-generator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.band-name-generator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.band-name-generator-rebuilt .form-label-custom{font-size:.7rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}

.text-yellow { color: #eab308 !important; }
.bg-yellow-soft { background-color: #fefce8 !important; }
.border-yellow { border-color: #eab308 !important; }

.text-slate { color: #475569 !important; }
.bg-slate { background-color: #475569 !important; }
.border-end-md { border-right: 1px dashed #e2e8f0; }

.btn-yellow { background: #eab308; color: #000; border: none; transition: 0.3s cubic-bezier(.4,0,.2,1); }
.btn-yellow:hover { background: #ca8a04; color: #000; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(234,179,8,0.2) !important; }

.output-card-themed{background:var(--tool-bg);border:1px solid #374151;border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.3); overflow: hidden;}
.bg-darker { background-color: #1f2937 !important; }

/* Custom Range */
.custom-range-yellow::-webkit-slider-thumb { background: #eab308; }
.custom-range-yellow::-moz-range-thumb { background: #eab308; }

/* Interactive Chips */
.name-chip { transition: all 0.2s; cursor: default; }
.name-chip:hover { border-color: #eab308 !important; transform: translateY(-2px); }
.opacity-target { opacity: 0; transition: 0.2s; }
.name-chip:hover .opacity-target { opacity: 1; }
.chip-btn { width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; padding: 0; transition: 0.2s; border: 1px solid #374151; }
.chip-btn:hover { background: #374151; border-color: #4b5563; }

/* Vault Floor */
.vault-floor { position: absolute; bottom: 0; left: 0; width: 100%; background: #000000; border-top: 4px solid #eab308; z-index: 100; border-bottom-left-radius: 24px; border-bottom-right-radius: 24px; }
.vault-remove:hover { color: #eab308 !important; }

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

