<div class="row g-4">
    {{-- Input Card --}}
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label-custom mb-0">Select Schema Type</label>
                        <select id="schema-type" class="form-select w-auto rounded-pill px-4 fw-bold border-primary shadow-sm">
                            <option value="Movie">🎬 Movie</option>
                            <option value="Product">📦 Product</option>
                            <option value="Article">📝 Article</option>
                            <option value="SoftwareApplication">💻 Software App</option>
                            <option value="FAQPage">❓ FAQ Page</option>
                            <option value="Service">🛠️ Service</option>
                        </select>
                    </div>
                </div>

                <div id="fields-container" class="row g-4 p-4 rounded-4 mb-4" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    {{-- Dynamic fields --}}
                </div>
                
                <div class="text-end">
                    <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" id="btn-generate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-magic me-2"></i> Generate JSON-LD
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,0.04);">
            <div class="output-header d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-code fs-4 me-2" style="color:#4f46e5"></i>
                    <h6 class="fw-bold mb-0">JSON-LD Output</h6>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-primary" id="btn-download" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download me-1"></i> Download
                    </button>
                    <button class="btn btn-primary btn-sm px-4" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Code
                    </button>
                </div>
            </div>
            
            <textarea id="output-text" class="form-control tool-textarea bg-dark text-info code-font" rows="12" readonly placeholder="Your schema will appear here..."></textarea>
            
            <div class="mt-3 p-3 bg-white rounded-3 border d-flex justify-content-between align-items-center small text-secondary">
                <div><i class="fas fa-info-circle me-1 text-primary"></i> Paste this into your <code>&lt;head&gt;</code> section.</div>
                <div class="badge bg-light text-primary border" id="schema-badge">JSON-LD</div>
            </div>
        </div>
    </div>
</div>

<style>
.calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2rem; }
.calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2rem; }
.calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.02em; }
.calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; flex-shrink: 0; }
.form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; display: block; }
.tool-textarea { border: 1.5px solid #1e293b; border-radius: 16px; padding: 1.5rem; background: #0f172a !important; font-family: 'Fira Code', monospace; font-size: 0.9rem; }
.output-card-themed { background: var(--tool-bg); border: 1px solid rgba(79,70,229,0.1); border-radius: 24px; padding: 2rem; }
.form-control, .form-select { border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 0.75rem 1rem; transition: all 0.2s; }
.form-control:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79,70,229,0.1); outline: none; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('schema-type');
    const fieldsContainer = document.getElementById('fields-container');
    const output = document.getElementById('output-text');
    const btnGenerate = document.getElementById('btn-generate');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');

    const schemaFields = {
        Movie: [
            { id: 'name', label: 'Movie Title', placeholder: 'e.g. Inception' },
            { id: 'director', label: 'Director', placeholder: 'e.g. Christopher Nolan' },
            { id: 'datePublished', label: 'Release Date', type: 'date' },
            { id: 'image', label: 'Poster URL', placeholder: 'https://example.com/poster.jpg' },
            { id: 'description', label: 'Plot Summary', type: 'textarea' }
        ],
        Article: [
            { id: 'headline', label: 'Headline', placeholder: 'Enter article title' },
            { id: 'author', label: 'Author Name', placeholder: 'e.g. John Doe' },
            { id: 'publisher', label: 'Publisher', placeholder: 'e.g. ToolsHub' },
            { id: 'datePublished', label: 'Publish Date', type: 'date' },
            { id: 'image', label: 'Feature Image URL', placeholder: 'https://example.com/image.jpg' }
        ],
        Product: [
            { id: 'name', label: 'Product Name', placeholder: 'e.g. iPhone 15' },
            { id: 'brand', label: 'Brand', placeholder: 'e.g. Apple' },
            { id: 'sku', label: 'SKU', placeholder: 'e.g. IP-15-128' },
            { id: 'price', label: 'Price', placeholder: 'e.g. 999.00' },
            { id: 'priceCurrency', label: 'Currency', placeholder: 'USD' }
        ],
        SoftwareApplication: [
            { id: 'name', label: 'App Name', placeholder: 'e.g. ToolsHub Pro' },
            { id: 'operatingSystem', label: 'OS', placeholder: 'e.g. Windows, iOS, Web' },
            { id: 'applicationCategory', label: 'Category', placeholder: 'e.g. Utility' },
            { id: 'price', label: 'Price', placeholder: '0.00' }
        ],
        FAQPage: [
            { id: 'q1', label: 'Question 1', placeholder: 'How does it work?' },
            { id: 'a1', label: 'Answer 1', type: 'textarea' },
            { id: 'q2', label: 'Question 2', placeholder: 'Is it free?' },
            { id: 'a2', label: 'Answer 2', type: 'textarea' }
        ],
        Service: [
            { id: 'name', label: 'Service Name', placeholder: 'e.g. Web Development' },
            { id: 'provider', label: 'Provider Name', placeholder: 'e.g. ToolsHub Agency' },
            { id: 'serviceType', label: 'Service Type', placeholder: 'e.g. Software Development' },
            { id: 'areaServed', label: 'Area Served', placeholder: 'e.g. Worldwide' }
        ]
    };

    function renderFields() {
        const type = typeSelect.value;
        const fields = schemaFields[type];
        if (!fields) return;
        
        fieldsContainer.innerHTML = '';
        fields.forEach(f => {
            const col = document.createElement('div');
            col.className = f.type === 'textarea' ? 'col-12' : 'col-md-6';
            
            let inputHtml = '';
            if (f.type === 'textarea') {
                inputHtml = `<textarea id="field-${f.id}" class="form-control" placeholder="${f.placeholder || ''}" rows="3"></textarea>`;
            } else {
                inputHtml = `<input type="${f.type || 'text'}" id="field-${f.id}" class="form-control" placeholder="${f.placeholder || ''}">`;
            }

            col.innerHTML = `
                <label class="form-label-custom">${f.label}</label>
                ${inputHtml}
            `;
            fieldsContainer.appendChild(col);
        });
        document.getElementById('schema-badge').textContent = type.toUpperCase();
    }

    btnGenerate.addEventListener('click', () => {
        const type = typeSelect.value;
        const fields = schemaFields[type];
        const data = {};
        
        // Use computed properties to avoid @ compiler issues
        data["@" + "context"] = "https://schema.org";
        data["@" + "type"] = type;

        if (type === 'FAQPage') {
            data.mainEntity = [];
            for(let i=1; i<=2; i++) {
                const qEl = document.getElementById(`field-q${i}`);
                const aEl = document.getElementById(`field-a${i}`);
                const q = qEl ? qEl.value : '';
                const a = aEl ? aEl.value : '';
                if(q && a) {
                    data.mainEntity.push({
                        ["@" + "type"]: "Question",
                        "name": q,
                        "acceptedAnswer": { ["@" + "type"]: "Answer", "text": a }
                    });
                }
            }
        } else {
            fields.forEach(f => {
                const el = document.getElementById(`field-${f.id}`);
                if (el && el.value) data[f.id] = el.value;
            });
        }

        output.value = `<script type="application/ld+json">\n${JSON.stringify(data, null, 4)}\n<\/script>`;
        output.classList.add('border-success');
        setTimeout(() => output.classList.remove('border-success'), 1000);
    });

    typeSelect.addEventListener('change', renderFields);
    renderFields();

    btnCopy.addEventListener('click', () => {
        if (!output.value) return;
        navigator.clipboard.writeText(output.value);
        const btn = btnCopy;
        const old = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        btn.classList.replace('btn-primary', 'btn-dark');
        setTimeout(() => {
            btn.innerHTML = old;
            btn.classList.replace('btn-dark', 'btn-primary');
        }, 2000);
    });

    btnDownload.addEventListener('click', () => {
        if (!output.value) return;
        const blob = new Blob([output.value], { type: 'application/ld+json' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `schema-${Date.now()}.jsonld`;
        a.click();
        URL.revokeObjectURL(url);
    });
});
</script>

