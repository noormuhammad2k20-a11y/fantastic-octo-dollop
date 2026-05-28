<div class="row g-4 contact-bridge-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(59, 130, 246, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #3B82F6, #2563EB); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-address-book"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e3a8a; letter-spacing: -0.5px;">Universal CSV to vCard Bridge</h4>
                    <p class="text-muted small mb-0">Bulk convert contact lists from CSV/Excel into standardized vCard (.vcf) files compatible with iPhone, Android, Outlook, and Google Contacts.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <form id="toolForm" action="{{ url('/api/process/' . $tool['slug']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">
                        {{-- Upload Zone --}}
                        <div class="col-md-7">
                            <div class="upload-zone-v2 p-5 rounded-4 border-2 border-dashed text-center h-100 d-flex flex-column align-items-center justify-content-center" id="dropZone" style="background: #f8fafc; border-color: #e2e8f0; transition: all 0.3s;">
                                <div class="icon-stack mb-3">
                                    <i class="fas fa-file-csv fs-1 text-blue opacity-20"></i>
                                    <i class="fas fa-arrow-right mx-3 text-muted"></i>
                                    <i class="fas fa-id-card fs-1 text-primary"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-2">Drop Contact CSV Here</h5>
                                <p class="small text-muted mb-3">Ensure headers include 'Name', 'Email', and 'Phone'</p>
                                <input type="file" name="file" id="fileInput" class="d-none" required>
                                <button type="button" class="btn btn-blue rounded-pill px-4 fw-bold shadow-sm" onclick="document.getElementById('fileInput').click()">Select Contact File</button>
                                <div id="fileDisplay" class="mt-3 badge bg-blue-soft text-blue p-2 d-none"></div>
                            </div>
                        </div>

                        {{-- Configuration --}}
                        <div class="col-md-5">
                            <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-blue">
                                <h6 class="fw-bold small mb-3 uppercase text-blue opacity-70">vCard Configuration</h6>
                                <div class="mb-3">
                                    <label class="form-label-custom">vCard Version</label>
                                    <select name="vcard_version" class="form-select border-0 bg-light rounded-3 fw-bold">
                                        <option value="3.0">Version 3.0 (Universal)</option>
                                        <option value="4.0">Version 4.0 (Modern)</option>
                                        <option value="2.1">Version 2.1 (Legacy)</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label-custom">Output Bundle</label>
                                    <select name="bundle_type" class="form-select border-0 bg-light rounded-3 fw-bold">
                                        <option value="single">Single .vcf file (All contacts)</option>
                                        <option value="zip">ZIP of individual files</option>
                                    </select>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label-custom">Name Format</label>
                                    <select name="name_format" class="form-select border-0 bg-light rounded-3 fw-bold">
                                        <option value="fn">First Last</option>
                                        <option value="ln">Last, First</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-top d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-light rounded-pill px-3 fw-bold btn-sm shadow-sm">
                                <i class="fas fa-download me-2"></i>Sample Contact CSV
                            </button>
                        </div>
                        <button type="submit" class="btn btn-blue rounded-pill px-5 py-3 fw-bold shadow-lg" id="generateBtn" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-user-plus me-2"></i>Convert to vCards
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="results-wrapper" style="--tool-hue: 210; --tool-color: #3B82F6; --tool-bg: rgba(59, 130, 246, .04); display: none;">
            <div class="output-hero text-center py-5">
                <div class="success-icon-wrap mb-3">
                    <div class="tool-icon-circle mx-auto bg-success text-white shadow-lg" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="fas fa-check"></i>
                    </div>
                </div>
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">SYNC READY</span>
                <div class="output-hero-value h2 fw-900 my-2" id="resultMessage">Contacts mapped successfully</div>
                <div class="mt-4">
                    <a href="#" id="downloadBtn" class="btn btn-blue btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg">
                        <i class="fas fa-download me-2"></i>Download vCard File
                    </a>
                </div>
            </div>
        </div>

        {{-- Loader --}}
        <div id="loaderArea" class="p-5 text-center d-none">
            <div class="spinner-grow text-blue" role="status" style="width: 4rem; height: 4rem;"></div>
            <h4 class="fw-bold mt-4 text-blue-900">Parsing Contact Matrix...</h4>
            <p class="text-muted small">Sanitizing phone numbers and mapping vCard fields.</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const form = $('toolForm');
    const fileInput = $('fileInput');
    const display = $('fileDisplay');
    const results = $('results-wrapper');
    const loader = $('loaderArea');
    const btn = $('generateBtn');

    fileInput.addEventListener('change', function(){
        if(this.files[0]){
            display.textContent = 'SELECTED: ' + this.files[0].name.toUpperCase();
            display.classList.remove('d-none');
            $('dropZone').style.borderColor = '#3B82F6';
            $('dropZone').style.background = '#EFF6FF';
        }
    });

    form.addEventListener('submit', function(e){
        e.preventDefault();
        const formData = new FormData(this);
        
        btn.disabled = true;
        loader.classList.remove('d-none');
        results.style.display = 'none';
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            btn.disabled = false;
            loader.classList.add('d-none');
            
            if(data.success){
                results.style.display = 'block';
                $('resultMessage').textContent = data.message || 'Contacts exported to .vcf format';
                let url = data.download_url || (data.results && data.results[0] && data.results[0].download_url);
                if(url){
                    $('downloadBtn').href = url;
                    $('downloadBtn').classList.remove('d-none');
                }
                results.scrollIntoView({ behavior: 'smooth' });
            } else {
                alert(data.message || 'Error parsing contact CSV. Please check column headers.');
            }
        })
        .catch(err => {
            btn.disabled = false;
            loader.classList.add('d-none');
            alert('Data bridge failure. Check your connection.');
        });
    });
});
</script>

<style>
.contact-bridge-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e3a8a;opacity:.7;margin-bottom:8px;display:block}
.btn-blue { background: #3B82F6; color: #fff; transition: all .3s; }
.btn-blue:hover { background: #2563EB; color: #fff; transform: translateY(-2px); }
.text-blue { color: #3B82F6; }
.text-blue-900 { color: #1e3a8a; }
.bg-blue-soft { background: #EFF6FF; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.upload-zone-v2:hover { border-color: #3B82F6 !important; background: #f1f5f9 !important; }
</style>

