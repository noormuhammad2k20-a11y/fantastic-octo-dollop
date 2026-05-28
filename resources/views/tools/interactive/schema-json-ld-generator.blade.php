<div class="row g-4 schema-json-ld-generator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Schema Type</label>
                    <select id="schema-type" class="form-select form-select-lg rounded-3">
                        <option value="Article">Article</option>
                        <option value="Person">Person</option>
                        <option value="Organization">Organization</option>
                    </select>
                </div>

                <hr class="my-4" style="opacity: 0.1;">

                <!-- Article Fields -->
                <div id="fields-Article" class="schema-fields">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-custom">Article Type</label>
                            <select id="art-type" class="form-select form-select-lg rounded-3">
                                <option value="Article">Article</option>
                                <option value="NewsArticle">News Article</option>
                                <option value="BlogPosting">Blog Posting</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Headline</label>
                            <input type="text" id="art-headline" class="form-control form-control-lg rounded-3" placeholder="Article Headline">
                        </div>
                        <div class="col-12">
                            <label class="form-label-custom">Description</label>
                            <textarea id="art-desc" class="form-control rounded-3" rows="2" placeholder="Brief summary..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Author Name</label>
                            <input type="text" id="art-author" class="form-control form-control-lg rounded-3" placeholder="Jane Doe">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Publisher Name</label>
                            <input type="text" id="art-publisher" class="form-control form-control-lg rounded-3" placeholder="Example Corp">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Image URL</label>
                            <input type="url" id="art-image" class="form-control form-control-lg rounded-3" placeholder="https://example.com/img.jpg">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Date Published</label>
                            <input type="date" id="art-date" class="form-control form-control-lg rounded-3">
                        </div>
                    </div>
                </div>

                <!-- Person Fields -->
                <div id="fields-Person" class="schema-fields" style="display: none;">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-custom">Name</label>
                            <input type="text" id="per-name" class="form-control form-control-lg rounded-3" placeholder="Jane Doe">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Job Title</label>
                            <input type="text" id="per-job" class="form-control form-control-lg rounded-3" placeholder="Software Engineer">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">URL</label>
                            <input type="url" id="per-url" class="form-control form-control-lg rounded-3" placeholder="https://example.com/jane-doe">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Image URL</label>
                            <input type="url" id="per-image" class="form-control form-control-lg rounded-3" placeholder="https://example.com/jane.jpg">
                        </div>
                        <div class="col-12">
                            <label class="form-label-custom">Social Profiles (One URL per line)</label>
                            <textarea id="per-social" class="form-control rounded-3" rows="3" placeholder="https://twitter.com/janedoe&#10;https://linkedin.com/in/janedoe"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Organization Fields -->
                <div id="fields-Organization" class="schema-fields" style="display: none;">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-custom">Organization Name</label>
                            <input type="text" id="org-name" class="form-control form-control-lg rounded-3" placeholder="Example Corp">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Website URL</label>
                            <input type="url" id="org-url" class="form-control form-control-lg rounded-3" placeholder="https://example.com/">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Logo URL</label>
                            <input type="url" id="org-logo" class="form-control form-control-lg rounded-3" placeholder="https://example.com/logo.png">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Contact Phone</label>
                            <input type="text" id="org-phone" class="form-control form-control-lg rounded-3" placeholder="+1-800-555-1234">
                        </div>
                        <div class="col-12">
                            <label class="form-label-custom">Social Profiles (One URL per line)</label>
                            <textarea id="org-social" class="form-control rounded-3" rows="3" placeholder="https://twitter.com/examplecorp&#10;https://linkedin.com/company/examplecorp"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Actions:</span>
                    <button class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold" onclick="generateSchema()">Generate Markup</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-4" onclick="resetApp()">Reset</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-12" id="output-wrapper" style="display: none;">
        <div class="output-card-themed" id="output-card-themed" style="--tool-hue:160;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04);transition:all .4s">
            <div class="output-hero">
                <span class="output-hero-label">JSON-LD Script</span>
            </div>
            <div class="position-relative">
                <pre class="bg-dark text-light p-4 rounded-3 small mb-0 overflow-x-auto shadow-sm" style="word-break: break-all; white-space: pre-wrap;" id="out-code"></pre>
            </div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="action-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Result</button>
        </div>
    </div>
</div>

<script>
    const typeSel = document.getElementById('schema-type');
    const allFields = document.querySelectorAll('.schema-fields');
    const outWrapper = document.getElementById('output-wrapper');
    const outCode = document.getElementById('out-code');
    
    typeSel.addEventListener('change', function() {
        allFields.forEach(f => f.style.display = 'none');
        document.getElementById('fields-' + this.value).style.display = 'block';
    });
    
    window.generateSchema = function() {
        const type = typeSel.value;
        let schema = {
            "@@context": "https://schema.org",
        };
        
        if(type === 'Article') {
            schema["@@type"] = document.getElementById('art-type').value;
            if(document.getElementById('art-headline').value.trim()) schema["headline"] = document.getElementById('art-headline').value.trim();
            if(document.getElementById('art-desc').value.trim()) schema["description"] = document.getElementById('art-desc').value.trim();
            if(document.getElementById('art-image').value.trim()) schema["image"] = document.getElementById('art-image').value.trim();
            if(document.getElementById('art-date').value.trim()) schema["datePublished"] = document.getElementById('art-date').value.trim();
            if(document.getElementById('art-author').value.trim()) {
                schema["author"] = {
                    "@@type": "Person",
                    "name": document.getElementById('art-author').value.trim()
                };
            }
            if(document.getElementById('art-publisher').value.trim()) {
                schema["publisher"] = {
                    "@@type": "Organization",
                    "name": document.getElementById('art-publisher').value.trim()
                };
            }
        } else if(type === 'Person') {
            schema["@@type"] = "Person";
            if(document.getElementById('per-name').value.trim()) schema["name"] = document.getElementById('per-name').value.trim();
            if(document.getElementById('per-job').value.trim()) schema["jobTitle"] = document.getElementById('per-job').value.trim();
            if(document.getElementById('per-url').value.trim()) schema["url"] = document.getElementById('per-url').value.trim();
            if(document.getElementById('per-image').value.trim()) schema["image"] = document.getElementById('per-image').value.trim();
            
            const socials = document.getElementById('per-social').value.split('\n').map(s=>s.trim()).filter(s=>s);
            if(socials.length > 0) schema["sameAs"] = socials;
            
        } else if(type === 'Organization') {
            schema["@@type"] = "Organization";
            if(document.getElementById('org-name').value.trim()) schema["name"] = document.getElementById('org-name').value.trim();
            if(document.getElementById('org-url').value.trim()) schema["url"] = document.getElementById('org-url').value.trim();
            if(document.getElementById('org-logo').value.trim()) schema["logo"] = document.getElementById('org-logo').value.trim();
            
            if(document.getElementById('org-phone').value.trim()) {
                schema["contactPoint"] = {
                    "@@type": "ContactPoint",
                    "telephone": document.getElementById('org-phone').value.trim(),
                    "contactType": "customer service"
                };
            }
            
            const socials = document.getElementById('org-social').value.split('\n').map(s=>s.trim()).filter(s=>s);
            if(socials.length > 0) schema["sameAs"] = socials;
        }
        
        let tags = [];
        tags.push('<script type="application/ld+json">');
        tags.push(JSON.stringify(schema, null, 2).replace(/@@/g, '@'));
        tags.push('</' + 'script>');
        
        outCode.textContent = tags.join('\n');
        outWrapper.style.display = 'block';
        outWrapper.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    };
    
    window.resetApp = function() {
        document.querySelectorAll('input, textarea').forEach(el => el.value = '');
        document.getElementById('art-type').value = 'Article';
        outWrapper.style.display = 'none';
    };
    
    document.getElementById('action-copy').addEventListener('click', function() {
        const code = outCode.textContent;
        navigator.clipboard.writeText(code).then(()=>{
            const orig = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            this.classList.replace('btn-dark', 'btn-success');
            setTimeout(()=>{
                this.innerHTML = orig;
                this.classList.replace('btn-success', 'btn-dark');
            }, 2000);
        });
    });
</script>

<style>
.schema-json-ld-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.schema-json-ld-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.schema-json-ld-generator-rebuilt .calculator-title{font-size:1.5rem; color:#1e293b}
.schema-json-ld-generator-rebuilt .calculator-header p{font-size:.9rem;color:#64748b}
.schema-json-ld-generator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.schema-json-ld-generator-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:1rem 0;margin-bottom:1rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.break-words { word-wrap: break-word; word-break: break-all; }
</style>